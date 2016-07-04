<?php

class MainController extends Controller{

public function style($f3){

$style = $f3->exists('POST.style') ? $f3->get('POST.style') : 'style';

$get_style = array("style","Yotsuba","YotsubaBlue","Futaba","Burichan","Tomorrow","Photon");

if(in_array($style,$get_style)){
$expire = strtotime("+1 day");

$f3->set("COOKIE.style",$style,$expire);

return Response::json(array('success' => true,'msg' => 'Style Applied'));
} else {
return Response::json(array('success' => false,'msg' => 'Invalid Style Name'));
}

}

function render($f3, $args){

$title = "Home";

$board_list = Category::all();

$post_list = Posts::orderBy('created_at','desc')->take('10')->get();
$photo_list = Photos::orderBy('created_at','desc')->take('10')->get();

$total_size = formatSizeUnits(dirSize($this->upload_dir));

$f3->set("category_list",$board_list);
$f3->set("post_list",$post_list);
$f3->set("photo_list",$photo_list);

$f3->set('page', array('title'=> $title,'content' => 'home.htm','board_list' => $board_list,'total_size' => $total_size));
}
	
/* Board View */
function board_view($f3, $args){

$board_slug = $args['board_slug'];

$board_list = Boards::where('slug',$board_slug)->first();

$board_title = $board_list->name;
$board_slug = $board_list->slug;

$title = "/$board_slug/ - $board_title";

$board_header_title = "/$board_slug/ - $board_title";

$f3->set('page', array('title'=> $title,'board_slug' => $board_slug,'board_title' => $board_header_title,'content' => 'threads.htm','board_list' => $board_list));
}

/* Thread View*/
public function thread_view($f3,$args){

$site_key = $f3->get("recaptcha_key");

$board_slug = $args['board_slug'];

$boards = Boards::where('slug',$board_slug)->first();

$board_title = $boards->name;

$board_slug = $boards->slug;

$board_id = $boards->id;

$threads = Threads::find($args['thread_id']);

$thread_id = $threads->id;
$thread_title = $threads->name;

$title = "/$board_slug/ - $board_title - Thread #$thread_id $thread_title";

$post_list = Posts::where(array('board_id' => $board_id, 'thread_id' => $thread_id))->get();

$total_poster = $post_list->groupBy("ip")->count();

$total_images = Photos::total_images($thread_id);

$total_reply = $post_list->count();

$board_header_title = "/$board_slug/ - $board_title";

$f3->set('page', array('title'=> $title,'content' => 'posts.htm','board_slug' => $board_slug,'board_title' => $board_header_title,'thread_id' => $thread_id, 'post_list' => $post_list,'thread_id' => $thread_id,'total_posters' => $total_poster,'total_images' => $total_images,'total_posts' => $total_reply));
}

}