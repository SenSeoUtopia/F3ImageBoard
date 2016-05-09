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

public function posting_reply($f3){
	

$options = ['cost' => 12, 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),];	
	

$secret = $f3->get('recaptcha_secret');	

$ip = $f3->get('IP');

/* Get FORM data */

$user_id = 0;

$user_name = $f3->get('GET.user_name');

$board_id = $f3->get('GET.board_id');

$thread_id = $f3->get('GET.thread_id');

$post_content = $f3->get('GET.message');

$password = $f3->get('GET.password');

$files = Web::instance()->receive(NULL,false,true);

$get_recaptcha_response = $f3->get('POST.g-recaptcha-response');


/* Captcha Check */
$recaptcha = new ReCaptcha\ReCaptcha($secret);

/* Check Post Exists */
$post_check = new Posts($this->db);

$post_check->check_posts_exists($user_id,$post_content, $ip);

if($post_check > 0){

/* Post Exists Return Error */

$msg = "<div class='alert alert-danger'><span class='icon-cross'></span> You have Already made same Reply.</div>";

} else {

/* Insert new data */
$posts = new Posts;

$posts->user_id = 0;
$posts->user_name = isset($user_name) ? $user_name : 'Anonymous';
$posts->is_thread = 0;
$posts->board_id = $board_id;
$posts->thread_id = $thread_id;
$posts->content = nl2br(htmlspecialchars($content));
$posts->password = isset($password) ? password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options) : '';
$posts->img = 0;
$posts->ip = $ip;
$posts->save();

$post_id = $posts->id;

/* Check if has Images */
if(isset($files) && !empty($files)){
	

	
	
}
	
}

return Response::json();
}



/* Admin Posting */


public function admin_posting(){






	
}

}