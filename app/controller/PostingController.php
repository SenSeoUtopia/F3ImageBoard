<?php
use Intervention\Image\ImageManagerStatic as Image;

class PostingController extends Controller{

protected $tpl = null;

/* Ajax Posting Topic */

public function posting_topic($f3){

$options = ['cost' => 12, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];	

$secret = $f3->get('recaptcha_secret');	

$recaptcha = new ReCaptcha\ReCaptcha($secret);

$ip = $f3->get('IP');

$board_id = $f3->get('GET.board_id');

$post_content = $f3->get('GET.message');

$get_recaptcha_response = $f3->get('POST.g-recaptcha-response');



}


/* Ajax Posting Reply */

public function posting_reply($f3,$args){

if(empty($args['board_slug']) ) {
return Response::json(array("Invalid Call"));
}

if(empty($args['thread_id']) ) {
return Response::json(array("Invalid Thread Call"));
}

$data = $f3->get("POST");

$files = $f3->get("FILES.upfile");

$status = 200;

$rules = array(
"message" => "required"
);

$valid = Validate::is_valid($data, $rules);

if($valid === true) {

$options = ['cost' => 12, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)];	
	
$secret = $f3->get('recaptcha_secret');	

$ip = $f3->get('IP');

/* Get FORM data */

$user_id = 0;

$user_name = !empty($data['user_name']) ? trim($data['user_name']) : 'Anonymous';

$board_slug = $args['board_slug'];

$board_id = Boards::where('slug',$board_slug)->first()->id;

$thread_id = $args['thread_id'];

$post_content = empty($data['message']) ? null : trim($data['message']);

$password = $data['password'];

$get_recaptcha_response = $data['g-recaptcha-response'];

/* Captcha Check */
$recaptcha = new ReCaptcha\ReCaptcha($secret);

/* Check Post Exists */
$post_check = Posts::where(array("user_id" => $user_id,"thread_id" => $thread_id,"content" => $post_content, "ip" => $ip))->count();

if($post_check > 0){

/* Post Exists Return Error */

$msg = array("error" => true,"msg" => "You have Already made same Reply.");

} else {

if(isset($files)){

$errors = "";

$file_name = $files['name'];
$file_size = $files['size'];
$file_tmp = $files['tmp_name'];
$file_type = $files['type'];
$file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
$expensions = array("jpeg","jpg","png");
    
if(in_array($file_ext,$expensions)=== false){
$errors = "extension not allowed, please choose a JPEG or PNG file.";
}
    
if(empty($errors)==true){

$upload_dir = $this->upload_dir;

$org_file_name = preg_replace('/\s+/', '_', $file_name); // Original Name
list($width, $height) = getimagesize($file_tmp);
$file_pixels = $width.'x'.$height;
$fileName = time().$org_file_name; // renaming image

/* Move File Path */
$destination = "$upload_dir/$board_slug/$thread_id/$fileName";
$thumb_destination = "$upload_dir/$board_slug/$thread_id/thumb/$fileName";


if(move_uploaded_file($file_tmp,$destination)){

/* Insert new data */
$posts = new Posts;

$posts->user_id = 0;
$posts->user_name = isset($user_name) ? $user_name : 'Anonymous';
$posts->is_thread = 0;
$posts->board_id = $board_id;
$posts->thread_id = $thread_id;
$posts->content = nl2br(htmlspecialchars($post_content));
$posts->password = isset($password) ? password_hash($password, PASSWORD_BCRYPT, $options) : '';
$posts->ip = $ip;
$posts->save();

$post_id = $posts->id;

$photos = Photos::firstorNew(["original_name" => $org_file_name]);
$photos->file_name = $fileName;
$photos->size = $file_size;
$photos->pixels = $file_pixels;
$photos->board_id = $board_id;
$photos->thread_id = $thread_id;
$photos->post_id = $post_id;
$photos->save();

Image::configure(array('driver' => 'imagick'));
$img = Image::make($destination);

$img->resize(150, null, function ($constraint) {
$constraint->aspectRatio();
});

$img->save($thumb_destination);


} else {
$msg = array("error" => true,"msg" => "Unable to Upload Image.");
}

$msg = array("success" => true,"msg" => "You've Commented Successfully.");
} else {
$msg = array("error" => true,"msg" => $errors);
}
} else {

/* Insert new data */
$posts = new Posts;

$posts->user_id = 0;
$posts->user_name = isset($user_name) ? $user_name : 'Anonymous';
$posts->is_thread = 0;
$posts->board_id = $board_id;
$posts->thread_id = $thread_id;
$posts->content = nl2br(htmlspecialchars($post_content));
$posts->password = isset($password) ? password_hash($password, PASSWORD_BCRYPT, $options) : '';
$posts->ip = $ip;
$posts->save();

$post_id = $posts->id;
	
$msg = array("success" => true,"msg" => "You've Commented Successfully.");
}

}

} else {
$msg = array("error" => true,"msg" => $valid);
}

return Response::json($msg,$status);
}



/* Admin Posting */


public function admin_posting(){






	
}

}