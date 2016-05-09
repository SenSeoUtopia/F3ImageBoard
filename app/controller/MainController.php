<?php

class MainController extends Controller{

function render($f3, $args){

$board_list = Category::all();

$f3->set("category_list",$board_list);

$f3->set('page', array('title'=> $title,'content' => 'home.htm','board_list' => $board_list));
}
	
/* Board View */
function board_view($f3, $args){

$board_slug = $args['board_slug'];

$board_list = Boards::where('slug',$board_slug)->first();

$title = "/$board_slug/ - ".$board_list->name;

$f3->set('page', array('title'=> $title,'content' => 'threads.htm','board_list' => $board_list));
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

$f3->set('page', array('title'=> $title,'content' => 'posts.htm','post_list' => $post_list,'thread_id' => $thread_id,'total_posters' => $total_poster,'total_images' => $total_images,'total_posts' => $total_reply));
}

}