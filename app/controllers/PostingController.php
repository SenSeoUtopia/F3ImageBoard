<?php

use Intervention\Image\ImageManagerStatic as Image;

class PostingController extends Controller
{

    protected $tpl = null;

    /*
     * Ajax Posting
     */
    public function posting_topic(Base $f3, $args)
    {

        $home_url = $this->home_url;

        $ip = $f3->get('IP');

        $errors = null;
        $success = null;

        /*
         * Chcek bans
         */
        $ban = Bans::check_ban($ip);
        if ($ban) {
            $errors = array("error" => true, "msg" => "You're Banned.");
            echo Response::json($errors);
            return $errors;
        }

        /*
         * Check ReCaptcha
         */

        $get_recaptcha_response = $f3->get('POST.g-recaptcha-response');

        $enable_recaptcha = Settings::get_settings('enable_recaptcha');

        $secret = Settings::get_settings('recaptcha_secret');

        $recaptcha = new ReCaptcha\ReCaptcha($secret);

        $resp = $recaptcha->verify($get_recaptcha_response, $ip);

        // ReCaptcha
        if ($enable_recaptcha) {
            if (!$resp->isSuccess()) {
                $errors = array("error" => true, "msg" => "Invalid Captcha");
                echo Response::json($errors);
                return Response::json($errors);
            }

        } // End of ReCaptcha

        $data = $f3->get("POST");

        $files = $f3->get("FILES.upload_file");

        $user_name = empty($data['user_name']) ? 'Anonymous' : trim($data['user_name']);

        $board_slug = $args['board_slug'];

        $board_id = Boards::where('slug', $board_slug)->first()->id;

        $post_content = empty($data['message']) ? null : trim($data['message']);

        $password = empty($data['password']) ? '' : $data['password'];

        $thread_title = $data['subject'];

        if (isset($files)) {

            $file_name = $files['name'];
            $file_size = $files['size'];
            $file_tmp = $files['tmp_name'];
            $file_type = $files['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name_only = pathinfo($file_name, PATHINFO_FILENAME);
            $expensions = array("jpeg", "jpg", "png", "mp4", "webm", "mp3");
            $file_hash = md5_file($file_tmp);
            $image_ext = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $expensions) === false) {
                $errors = "extension not allowed, please choose a JPEG or PNG file to create a Thread.";
            }

            /**
             * Check Duplicates Files
             */
            $duplicate_file = Photos::check_duplicate($file_hash);

            if ($duplicate_file) {
                $errors = "Duplicate file exists.";
            }

            if (empty($errors) == true) {

                $upload_dir = $this->upload_dir;

                $org_file_name = $file_name; // Original Name
                $new_file_name = $file_name_only . "_" . $file_hash;
                $fileName = "$new_file_name.$file_ext"; // renaming image


                // Thread Create
                $thread = Threads::firstorNew(['name' => $thread_title]);
                $thread->user_id = 0;
                $thread->board_id = $board_id;
                $thread->save();

                $thread_id = $thread->id;

                /* Move File Path */
                $board_dir = "$upload_dir/$board_slug/";
                $destination_dir = "$upload_dir/$board_slug/$thread_id/";
                $thumb_destination_dir = "$upload_dir/$board_slug/$thread_id/thumb/";
                $destination = "$upload_dir/$board_slug/$thread_id/$fileName";
                $thumb_destination = "$upload_dir/$board_slug/$thread_id/thumb/$fileName";

                if (!file_exists($board_dir)) {
                    mkdir($board_dir);
                }
                if (!file_exists($destination_dir)) {
                    mkdir($destination_dir);
                }
                if (!file_exists($thumb_destination_dir)) {
                    mkdir($thumb_destination_dir);
                }


                if (move_uploaded_file($file_tmp, $destination)) {

                    $driver = $f3->get("photo_library");

                    $getID3 = new getID3;

                    $file_data = $getID3->analyze($destination);

                    $file_pixels = $file_data['video']['resolution_x'] . "x" . $file_data['video']['resolution_y'];

                    $driver = $f3->get("photo_library");

                    if ($driver === "imagick") {
                        $driver = extension_loaded("imagick") ? "imagick" : "gd";
                    } else {
                        $driver = "gd";
                    }

                    Image::configure(array('driver' => $driver));

                    if (in_array($file_ext, $image_ext)) {
                        $photo_type = "image";

                        $img = Image::make($destination);

                        $img->resize(250, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $img->save($thumb_destination);
                    } else {

                        $video_file_name = $file_name_only . "_" . $file_hash;
                        $image_destination = "$upload_dir/$board_slug/$thread_id/$video_file_name.jpg";
                        $thumb_destination = "$upload_dir/$board_slug/$thread_id/thumb/$video_file_name.jpg";

                        /**
                         * $ffmpeg = FFMpeg\FFMpeg::create(array(
                         * 'ffmpeg.binaries' => '/usr/bin/ffmpeg',
                         * 'ffprobe.binaries' => '/usr/bin/ffprobe'
                         * ));
                         */
                        $ffmpeg = FFMpeg\FFMpeg::create();

                        if (preg_match("/audio/i", $file_type)) {
                            $photo_type = "audio";
                        } else {
                            $photo_type = "video";

                            $video = $ffmpeg->open($destination);

                            $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));

                            $frame->save($image_destination);

                            $img = Image::make($image_destination);

                            $img->resize(250, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });

                            $img->save($thumb_destination);

                            unlink($image_destination);
                        }

                    }


                    /* Post Create */
                    $post = Posts::firstorNew(["content" => $post_content, "ip" => $ip, "thread_id" => $thread_id]);
                    $post->is_thread = 1;
                    $post->board_id = $board_id;
                    $post->user_id = 0;
                    $post->has_file = true;
                    $post->user_name = $user_name;
                    $post->password = isset($password) ? password_hash($password, PASSWORD_BCRYPT) : '';
                    $post->save();

                    $post_id = $post->id;

                    $photos = Photos::firstorNew(["original_name" => $org_file_name, "board_id" => $board_id, "thread_id" => $thread_id]);
                    $photos->file_name = $fileName;
                    $photos->file_name_only = $new_file_name;
                    $photos->file_hash = $file_hash;
                    $photos->photo_type = $photo_type;
                    $photos->op_img = true;
                    $photos->size = $file_size;
                    $photos->file_type = $file_type;
                    $photos->pixels = $file_pixels;
                    $photos->post_id = $post_id;
                    $photos->save();

                } else {
                    $msg = array("error" => true, "msg" => "Unable to Upload Image.");
                }

                $success = true;

                $msg = array("success" => true, "msg" => "Your Thread has been Created Successfully.");
            } else {
                $msg = array("error" => true, "msg" => $errors);
            }
        }


        if ($success) {

            $thread_url = "$home_url/$board_slug/thread/$thread_id/$thread_title";

            $msg = array("success" => true, "msg" => "Your Thread has been Created Successfully.", "thread_url" => $thread_url);

        }

        echo Response::json($msg);
    }


    /* Ajax Posting Reply */

    public function posting_reply(Base $f3, $args)
    {

        if (empty($args['board_slug'])) {
            return Response::json(array("Invalid Call"));
        }

        if (empty($args['thread_id'])) {
            return Response::json(array("Invalid Thread Call"));
        }

        $data = $f3->get("POST");

        $files = $f3->get("FILES.upload_file");

        if (empty($data['message']) && empty($files)) {
            $json_data = array("error" => true, "msg" => "Message or File Required");
            echo Response::json($json_data);
            return Response::json($json_data);
        }

        $enable_recaptcha = Settings::get_settings('enable_recaptcha');

        $secret = Settings::get_settings('recaptcha_secret');

        $ip = $f3->get('IP');

        $get_recaptcha_response = $data["g-recaptcha-response"];

        $recaptcha = new ReCaptcha\ReCaptcha($secret);

        $resp = $recaptcha->verify($get_recaptcha_response, $ip);

        // ReCaptcha
        if ($enable_recaptcha) {
            if (!$resp->isSuccess()) {
                $errors = array("error" => true, "msg" => "Invalid Captcha");
                echo Response::json($errors);
                return Response::json($errors);
            }

        } // End of ReCaptcha

        /*
         * Chcek bans
         */
        $ban = Bans::check_ban($ip);
        if ($ban) {
            $errors = array("error" => true, "msg" => "You're Banned.");
            echo Response::json($errors);
            return Response::json($errors);
        }

        /* Get FORM data */

        $user_id = 0;

        $user_name = empty($data['user_name']) ? 'Anonymous' : trim($data['user_name']);

        $board_slug = $args['board_slug'];

        $board_id = Boards::where('slug', $board_slug)->first()->id;

        $thread_id = $args['thread_id'];

        $post_content = empty($data['message']) ? null : trim($data['message']);

        $password = empty($data['password']) ? null : trim($data['password']);

        if (isset($files)) {
            $spoiler = empty($data["spoiler"]) ? null : 1;
        }

        /* Check Post Exists */
        if (isset($files)) {

            $errors = "";

            $file_name = $files['name'];
            $file_size = $files['size'];
            $file_tmp = $files['tmp_name'];
            $file_type = $files['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name_only = pathinfo($file_name, PATHINFO_FILENAME);
            $expensions = array("jpeg", "jpg", "png", "mp4", "webm", "mp3");
            $file_hash = md5_file($file_tmp);
            $image_ext = array("jpeg", "jpg", "png");

            if (in_array($file_ext, $expensions) === false) {
                $errors = "extension not allowed, please choose a JPEG or PNG or MP4 or WEBM file.";
            }

            /**
             * Check Duplicates Files
             */
            $duplicate_file = Photos::check_duplicate($file_hash);

            if ($duplicate_file) {
                $errors = "Duplicate file exists.";
            }

            /**
             * Process Files
             */

            if (empty($errors) == true) {

                $upload_dir = $this->upload_dir;

                $org_file_name = $file_name; // Original Name
                $new_file_name = $file_name_only . "_" . $file_hash;
                $fileName = "$new_file_name.$file_ext"; // renaming image

                /* Move File Path */
                $destination = "$upload_dir/$board_slug/$thread_id/$fileName";
                $thumb_destination = "$upload_dir/$board_slug/$thread_id/thumb/$fileName";

                $getID3 = new getID3;

                $file_data = $getID3->analyze($file_tmp);

                $file_pixels = $file_data['video']['resolution_x'] . "x" . $file_data['video']['resolution_y'];

                $driver = $f3->get("photo_library");

                if ($driver === "imagick") {
                    $driver = extension_loaded("imagick") ? "imagick" : "gd";
                } else {
                    $driver = "gd";
                }

                Image::configure(array('driver' => $driver));

                if (in_array($file_ext, $image_ext)) {
                    $photo_type = "image";

                    $img = Image::make($file_tmp);

                    $img->resize(250, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $img->save($thumb_destination);
                } else {

                    $video_file_name = $file_name_only . "_" . $file_hash;
                    $image_destination = "$upload_dir/$board_slug/$thread_id/$video_file_name.jpg";
                    $thumb_destination = "$upload_dir/$board_slug/$thread_id/thumb/$video_file_name.jpg";

                    /**
                     * $ffmpeg = FFMpeg\FFMpeg::create(array(
                     * 'ffmpeg.binaries' => '/usr/bin/ffmpeg',
                     * 'ffprobe.binaries' => '/usr/bin/ffprobe'
                     * ));
                     */
                    $ffmpeg = FFMpeg\FFMpeg::create();

                    if (preg_match("/audio/i", $file_type)) {
                        $photo_type = "audio";
                    } else {
                        $photo_type = "video";

                        $video = $ffmpeg->open($file_tmp);

                        $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(2));

                        $frame->save($image_destination);

                        $img = Image::make($image_destination);

                        $img->resize(250, null, function ($constraint) {
                            $constraint->aspectRatio();
                        });

                        $img->save($thumb_destination);

                        unlink($image_destination);
                    }

                }

                if (move_uploaded_file($file_tmp, $destination)) {

                    /* Insert new data */
                    $posts = new Posts;

                    $posts->user_id = 0;
                    $posts->user_name = isset($user_name) ? $user_name : 'Anonymous';
                    $posts->is_thread = 0;
                    if (isset($spoiler)) $posts->spoiler = $spoiler;
                    $posts->board_id = $board_id;
                    $posts->thread_id = $thread_id;
                    $posts->has_file = 1;
                    $posts->content = isset($post_content) ? htmlspecialchars($post_content) : null;
                    $posts->password = isset($password) ? password_hash($password, PASSWORD_BCRYPT) : null;
                    $posts->ip = $ip;
                    $posts->save();

                    $post_id = $posts->id;

                    $photos = Photos::firstorNew(["original_name" => $org_file_name, "board_id" => $board_id, "thread_id" => $thread_id]);
                    $photos->file_name = $fileName;
                    $photos->file_name_only = $new_file_name;
                    $photos->file_hash = $file_hash;
                    $photos->file_type = $file_type;
                    $photos->photo_type = $photo_type;
                    $photos->size = $file_size;
                    $photos->pixels = $file_pixels;
                    $photos->post_id = $post_id;
                    $photos->save();


                } else {
                    $msg = array("error" => true, "msg" => "Unable to Upload Image.");
                }

                $msg = array("success" => true, "msg" => "You've Commented Successfully.");
            } else {
                $msg = array("error" => true, "msg" => $errors);
            }


        } else {

            /**
             * Check Duplicate post
             */
            $check_duplicate_post = Posts::check_duplicate($board_id,$thread_id,$ip,$post_content);

            if($check_duplicate_post){
                $msg = array("error" => false, "msg" => "You've posted duplicate post.");
            } else {

                /* Insert new data */
                $posts = Posts::firstOrNew(['board_id' => $board_id, 'thread_id' => $thread_id, 'content' => htmlspecialchars($post_content),'ip' => $ip]);
                $posts->user_id = 0;
                $posts->user_name = isset($user_name) ? $user_name : 'Anonymous';
                $posts->password = isset($password) ? password_hash($password, PASSWORD_BCRYPT) : '';
                $posts->save();

//				$post_id = $posts->id;

                $msg = array("success" => true, "msg" => "You've Commented Successfully.");
            }
        }

        echo Response::json($msg);
    }


    /**
     * @param $files
     */
    private function process_files($files)
    {

        $f3 = $this->f3;

        $error = null;

        /* Check Post Exists */
        if (count($files) > 0) {

            foreach ($files as $file){

                $file_name = $file['name'];
                $file_size = $file['size'];
                $file_tmp = $file['tmp_name'];
                $file_type = $file['type'];
                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $file_name_only = pathinfo($file_name, PATHINFO_FILENAME);
                $expensions = array("jpeg", "jpg", "png", "mp4", "webm", "mp3");
                $file_hash = md5_file($file_tmp);
            }

        } else {
            $file_name = $files['name'];
            $file_size = $files['size'];
            $file_tmp = $files['tmp_name'];
            $file_type = $files['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name_only = pathinfo($file_name, PATHINFO_FILENAME);
            $expensions = array("jpeg", "jpg", "png", "mp4", "webm", "mp3");
            $file_hash = md5_file($file_tmp);
        }

    }

}