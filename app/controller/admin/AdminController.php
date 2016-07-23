<?php

class AdminController extends Controller {

protected $tpl = "admincp.htm";

function dashboard($f3){

$active_menu = $f3->get('PATH');

$title = 'AdminCP';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));

}


/* Boards List */
function boards($f3){

$title = 'AdminCP : Manage Boards';

$boards = Boards::all();

$f3->set('page', array('title'=> $title,'content' => 'admin/boards.htm','boards_list' => $boards));

}

/* Boards Create */
public function boards_create($f3){
$title = 'AdminCP : Create Boards';

$f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm'));
}

public function boards_create_save($f3){
$title = 'AdminCP : Create Boards';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Boards Edit */
public function boards_edit($f3,$args){

$board_slug = $args['board_slug'];

$board = Boards::where("slug",$board_slug)->first();
	
$board_title = $board->name;

$category_list = Category::all();

$title = 'AdminCP : Editing Boards "'.$board_title.'"';

$f3->set('page', array('title'=> $title,'content' => 'admin/boards_edit.htm','board' => $board,'category_list' => $category_list));
}

public function boards_edit_save($f3,$args){
$title = 'AdminCP : Editing Boards';

$f3->set('page', array('title'=> $title,'content' => 'admin/boards_edit.htm','board' => $board,'category_list' => $category_list));
}

/* Boards Delete */
public function boards_delete($f3){
$title = 'AdminCP : Boards Removed';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Threads List */
public function threads($f3){
$title = 'AdminCP : Threads List';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Threads Create */
public function threads_create($f3){
$title = 'AdminCP : Thread Create';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function threads_create_save($f3){
$title = 'AdminCP : Thread Create';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Threads Edit */
public function threads_edit_save($f3,$args){
$title = 'AdminCP : Editing Thread';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Threads Delete */
public function threads_delete($f3){
$title = 'AdminCP : Editing Thread';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Posts List */
public function posts($f3){
$title = 'AdminCP : Posts Lists';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Posts Create */
public function posts_create($f3){
$title = 'AdminCP : Post Create';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function posts_create_save($f3){
$title = 'AdminCP : Post Create';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Posts Edit */
public function posts_edit($f3){
$title = 'AdminCP : Post Editing';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function posts_edit_save($f3){
$title = 'AdminCP : Post Editing';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Posts Delete */
public function posts_delete($f3){
$title = 'AdminCP : Post Removed';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Photos List */
public function photos($f3){
$title = 'AdminCP : Photos';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Photos Create */
public function photos_create($f3){
$title = 'AdminCP : Photos Create';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Photos Edit */
public function photos_edit($f3){
$title = 'AdminCP : Photos Editing';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Photos Delete */
public function photos_delete($f3){
$title = 'AdminCP : Photos Removed';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Reports List */
public function reports($f3){
$title = 'AdminCP : Reports';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Reports Create */
public function reports_create($f3){
$title = 'AdminCP : Report Create';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Reports Edit */
public function reports_edit($f3){
$title = 'AdminCP : Report Editing';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function reports_edit_save($f3){
$title = 'AdminCP : Report Editing';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Reports Delete */
public function reports_delete($f3){
$title = 'AdminCP : Report Removed';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Bans List */
public function bans($f3){
$title = 'AdminCP : Bans List';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Bans Create */
public function bans_create($f3){
$title = 'AdminCP : Ban a User';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function bans_create_save($f3){
$title = 'AdminCP : Ban a User';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Bans Edit */
public function bans_edit($f3){
$title = 'AdminCP : Viewing Ban';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

public function bans_edit_save($f3){
$title = 'AdminCP : Viewing Ban';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Bans Delete */
public function bans_delete($f3){
$title = 'AdminCP : Ban Removed';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

/* Settings */
public function settings($f3){
$title = 'AdminCP : Settings';

$f3->set('page', array('title'=> $title,'content' => 'admin/settings.htm'));
}

/* Settings Save */
public function settings_save($f3){
$title = 'AdminCP : Settings';

$f3->set('page', array('title'=> $title,'content' => 'admin/dashboard.htm'));
}

}