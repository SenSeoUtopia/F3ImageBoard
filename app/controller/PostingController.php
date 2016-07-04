<?php

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

$valid = Validate::is_valid($data, array(
"message" => "required",
"g-recaptcha-response" => "required"
));

$status = 200;

if($valid === true) {

$options = ['cost' => 12, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)];	
	
$secret = $f3->get('recaptcha_secret');	

$ip = $f3->get('IP');

/* Get FORM data */

$user_id = 0;

$user_name = !empty($data['user_name']) ? $data['user_name'] : 'Anonymous';

$board_id = Boards::where('slug',$args['board_slug'])->first()->id;

$thread_id = $args['thread_id'];

$post_content =$data['message'];

$password = $data['password'];

$files = $f3->get("FILES");

$get_recaptcha_response = $data['g-recaptcha-response'];

/* Captcha Check */
$recaptcha = new ReCaptcha\ReCaptcha($secret);

/* Check Post Exists */
$post_check = Posts::where(array("user_id" => $user_id,"thread_id" => $thread_id,"content" => $post_content, "ip" => $ip))->count();

if($post_check > 0){

/* Post Exists Return Error */

$msg = array("success" => false,"msg" => "You have Already made same Reply.");

$status = 400;

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

} else {
$msg = array("success" => false,"msg" => " You have entered an incorrect CAPTCHA.");
}

return Response::json($msg);
}



/* Admin Posting */


public function admin_posting(){






	
}

}