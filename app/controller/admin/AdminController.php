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

$category_list = Category::all();

$f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm','category_list' => $category_list));
}

public function boards_create_save($f3){
$title = 'AdminCP : Create Boards';

$upload_dir = $this->upload_dir;

$data = $f3->get('POST');
$valid = Validate::is_valid($data, array(
    'name' => 'required|alpha_numeric',
    'slug' => 'required',
	'category_id' => 'required'
));

$board_slug = $data['slug'];

$category_list = Category::all();

if($valid === true) {

$boards = Boards::firstOrNew(["name" => $data['name'],"slug" => $data['slug']]);
$boards->category_id = $data['category_id'];
if($boards->save()) {

$msg = array("success" => true,"msg" => "Board Created.");
} else {
$msg = array("error" => true,"msg" => "Unable to Create Board");
}

if(!file_exists("$upload_dir/$board_slug")){
mkdir("$upload_dir/$board_slug");
}

$f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm','category_list' => $category_list,'msg' => $msg));
} else {
$f3->set('page', array('title'=> $title,'content' => 'admin/boards_create.htm','category_list' => $category_list,'errors' => $valid)); 
}

}

/* Boards Edit */
public function boards_edit($f3,$args){

$board_id = $args['board_id'];

$board = Boards::find($board_id);
	
$board_title = $board->name;

$category_list = Category::all();

$title = 'AdminCP : Editing Boards "'.$board_title.'"';

$f3->set('page', array('title'=> $title,'content' => 'admin/boards_edit.htm','board' => $board,'category_list' => $category_list));
}

public function boards_edit_save($f3,$args){
$title = 'AdminCP : Editing Boards';

$board_id = $args['board_id'];

$data = $f3->get('POST');

$board = Boards::find($board_id);

$board->name = $data['name'];
$board->slug = $data['slug'];
$board->category_id = $data['category_id'];
$board->show_contry_flag = isset($data['show_contry_flag']) ? $data['show_contry_flag']: 0;
if($board->save()) {
$msg = array("success" => true,"msg" => "Board Update.");
} else {
$msg = array("error" => true,"msg" => "Unable to Update Board");
}


$f3->set('page', array('title'=> $title,'content' => 'admin/boards_edit.htm','board' => $board,'category_list' => $category_list,"msg" => $msg));
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

$f3->set('page', array('title'=> $title,'content' => 'admin/bans.htm'));
}

/* Bans Create */
public function bans_create($f3){
$title = 'AdminCP : Ban a User';

$f3->set('page', array('title'=> $title,'content' => 'admin/bans_create.htm'));
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

$settings = array();

// Site Title
$settings['site_title'] = $f3->get('site_title');

// Meta Description 
$settings['site_description'] = $f3->get('site_description');
// Meta Keyword
$settings['site_keyword'] = $f3->get('site_keyword');
// ReCaptcha Key
$settings['recaptcha_key'] = $f3->get('recaptcha_key');
// ReCaptcha Secret Key
$settings['recaptcha_secret'] = $f3->get('recaptcha_secret');
// Maintenance Mode
$settings['maintenance'] = $f3->get('maintenance');
// Enable Https
$settings['https_enable'] = $f3->get('https_enable');
// Enable ReCaptcha
$settings['recaptcha'] = $f3->get('recaptcha');
// Enable Quick Reply
$settings['quick_reply'] = $f3->get('quick_reply');
// Enable Emoji
$settings['emoji'] = $f3->get('emoji');
// Enable BBCodes
$settings['bbcode'] = $f3->get('bbcode');
// Footer Message
$settings['footer'] = $f3->get('footer');

$f3->set('page', array('title'=> $title,'content' => 'admin/settings.htm','settings' => $settings));
}

/* Settings Save */
public function settings_save($f3){
$title = 'AdminCP : Settings';

$app_dir = $f3->get('app_dir');

$data = $f3->get("POST");

// Site Title
$site_title = $data['site_title'];
// Meta Description 
$site_description = $data['site_description'];
// Meta Keyword
$site_keyword = $data['site_keyword'];
// ReCaptcha Key
$recaptcha_key = $data['recaptcha_key'];
// ReCaptcha Secret Key
$recaptcha_secret = $data['recaptcha_secret'];
// Maintenance Mode
$maintenance = isset($data['maintenance']) ? 'true' : 'false';
// Enable Https
$https_enable = isset($data['https_enable']) ? 'true' : 'false';
// Enable ReCaptcha
$recaptcha = isset($data['recaptcha']) ? 'true' : 'false';
// Enable Quick Reply
$quick_reply = isset($data['quick_reply']) ? 'true' : 'false';
// Enable Emoji
$emoji = isset($data['emoji']) ? 'true' : 'false';
// Enable BBCodes
$bbcode = isset($data['bbcode']) ? 'true' : 'false';
// Footer Message
$footer = $data['footer'];

// Saving Data
$content = "; Site Title
site_title = $site_title
; Meta Description 
site_description = $site_description
; Meta Keyword
site_keyword = $site_keyword
; ReCaptcha Key
recaptcha_key = $recaptcha_key
; ReCaptcha Secret Key
recaptcha_secret = $recaptcha_secret
; Maintenance Mode
maintenance = $maintenance
; Enable Https
https_enable = $https_enable
; Enable ReCaptcha
recaptcha = $recaptcha
; Enable Quick Reply
quick_reply = $quick_reply
; Enable Emoji
emoji = $emoji
; Enable BBCodes
bbcode = $bbcode
; Footer Message
footer = $footer";

$destination = "$app_dir/settings.ini";

if(file_put_contents($destination,$content)){
$msg = array("success" => true,"msg" => "Settings has been Saved.");
} else{
$msg = array("error" => true,"msg" => "Unable to update Settings.");
}

$f3->set('page', array('title'=> $title,'content' => 'admin/settings.htm','msg' => $msg));
}

}