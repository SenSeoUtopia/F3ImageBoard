<?php

class AjaxController extends Controller
{

    protected $tpl = null;

    public function template_loader($file_name, $posts)
    {

        $f3 = Base::instance();
        $f3->set("posts", $posts);

        $preview = Template::instance();
        $preview->filter('crop', 'Helper::instance()->crop');
        $preview->filter('remove_tags', 'Helper::instance()->remove_tags');
        $preview->filter('remove_slash', 'Helper::instance()->remove_slash');
        $preview->filter('remove_spaces', 'Helper::instance()->remove_spaces');
        $preview->filter('remove_execute_code', 'Helper::instance()->remove_execute_code');
        $preview->filter('remove_white_spaces', 'Helper::instance()->remove_white_spaces');
        $preview->filter('replace_data', 'Helper::instance()->replace_data');
        $preview->filter('country_flag', 'Helper::instance()->country_flag');
        return $preview->render($file_name);
    }

    /* Set Users Settings */
    public function set_settings(Base $f3, $args)
    {

        $settings = $f3->get("GET");

        // Thread Watcher
        $thread_watcher = isset($settings['thread_watcher']) ? true : false;
        // Auto Loader
        $thread_watcher = isset($settings['thread_watcher']) ? true : false;
        // Updated Sound
        $thread_watcher = isset($settings['updater_sound']) ? true : false;
        // Quick Reply
        $thread_watcher = isset($settings['quick_reply']) ? true : false;
        // Show Spoiler Images
        $thread_watcher = isset($settings['thread_watcher']) ? true : false;
        // Show Quote by
        $thread_watcher = isset($settings['thread_watcher']) ? true : false;
        // Show Thread Stats
        $thread_watcher = isset($settings['thread_watcher']) ? true : false;
        //
        $thread_watcher = isset($settings['thread_watcher']) ? true : false;

        $thread_watcher = isset($settings['thread_watcher']) ? true : false;

        $thread_watcher = isset($settings['thread_watcher']) ? true : false;

        $thread_watcher = isset($settings['thread_watcher']) ? true : false;

        $thread_watcher = isset($settings['thread_watcher']) ? true : false;

        $thread_watcher = isset($settings['thread_watcher']) ? true : false;

        $thread_watcher = isset($settings['thread_watcher']) ? true : false;

        $thread_watcher = isset($settings['thread_watcher']) ? true : false;


        return Response::json($settings);
    }


    /* Get Selected Post Data */
    public function get_post(Base $f3, $args)
    {
        $post_id = $args['post_id'];

        $posts = Posts::findorFail($post_id);

        return Response::json($posts);
    }

    /* Ajax Delete Post */
    public function post_delete(Base $f3)
    {

        $ip = $f3->get("IP");

        $upload_dir = $this->upload_dir;
        $file = new File();
        $msg = null;
        $post_id = $f3->get("GET.post_id");

        if (empty($post_id)) {
            $msg = array("error" => true, "msg" => "Unable to Delete Selected Post");
            echo Response::json($msg);
            return Response::json($msg);
        }

        $post_expire_time = $f3->exists("max_post_delete_time") ? $f3->get("max_post_delete_time") : 600;

        if (isset($post_id)) {

            $today = time();

            foreach ($post_id as $post_number) {

                $post = Posts::where("id",$post_number)->where("ip",$ip)->first();

                if ($post) {

                    $expire_time = strtotime($post->created_at) + $post_expire_time;

                    if ($today > $expire_time) {
                        $msg = array("error" => true, "msg" => "You cannot delete a post this old.");
                    }

                    $success = true;

                    if ($post->photos->count()) {

                        $photos = $post->photos;

                        foreach ($photos as $photo) {
                            $file_name = $photo->file_name;

                            $board_slug = $photo->boards->slug;

                            $thread_id = $post->thread_id;

                            $file_path = "$upload_dir/$board_slug/$thread_id/$file_name";

                            $file_path_thumb = "$upload_dir/$board_slug/$thread_id/thumb/$file_name";
                            $file->delete($file_path_thumb);
                            $success = $file->delete($file_path);
                        }

                    }


                    if ($success) {
                        if ($post->delete()) {
                            $msg = array("success" => true, "msg" => "Your Message has been deleted. :)");
                        }
                    } else {
                        $msg = array("error" => true, "msg" => "Unable to Delete Selected Post because file is not deleted.");
                    }

                } else {
                    $msg = array("error" => true, "msg" => "Unable to Delete Selected Post");
                }

            }


        } else {
            $msg = array("error" => true, "msg" => "Unable to Delete Selected Post");
        }


        echo Response::json($msg);
        return Response::json($msg);
    }


    /* Loading Post Data */
    public function post_loader(Base $f3, $args)
    {

        $board_slug = $args['board_slug'];

        $boards = Boards::where('slug', $board_slug)->first();

        $board_title = $boards->name;

        $board_slug = $boards->slug;

        $board_id = $boards->id;

        $threads = Threads::find($args['thread_id']);

        $thread_id = $threads->id;

        $post_id = $f3->get('GET.post_id');

        $results = Posts::with('photos')->where('thread_id', $thread_id)->where("board_id", $board_id)->where('id', '>', $post_id)->get();

        $f3->set('home_url', $this->home_url);
        $f3->set('page', array(
            'board_slug' => $board_slug,
            'thread_id' => $thread_id,
            'post_list' => $results
        ));

        $post_array = array("success" => true);
        foreach ($results as $posts) {
            $post_array["posts"][] = array(
                "id" => $posts->id,
                'board_slug' => $board_slug,
                'thread_id' => $thread_id,
                "html" => $this->template_loader("ajax.htm", $posts)
            );
        }

        $json_data = null;

        if ($results->isEmpty()) {
            $json_data = array("success" => false, "msg" => "No New Posts.");
        } else {
            $json_data = $post_array;
        }

        echo Response::json($json_data);
        return Response::json($json_data);
    }

    /* Emoji List */
    public function emoji(Base $f3)
    {
        $keyword = $f3->get("GET.q");
        $emoji = Emoji::all();

        echo Response::json($emoji);
        return $emoji;
    }

    public function report(Base $f3, $args)
    {

        $data = $f3->get("POST");

        $post_id = $data["post_id"];

        $ip = $f3->get("IP");

        if (!$post_id) {
            $json_data = array("success" => false, "msg" => "Invalid reported post");
        } else {
            $report = Reports::firstorNew(["post_id" => $post_id]);
            $report->reason = $data["reason"];
            $report->ip = $ip;

            if ($report->save()) {
                $json_data = array("success" => true, "msg" => "Post has been Reported");
            } else {
                $json_data = array("success" => true, "msg" => "Unable to report Post.");
            }
        }

        echo Response::json($json_data);
        return Response::json($json_data);
    }
}