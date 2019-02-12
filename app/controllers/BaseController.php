<?php

class BaseController {

protected $f3;
protected $base_dir;
protected $cover_dir;
protected $app_dir;
protected $public_dir;
protected $home_url;
protected $tpl;

function __construct() {

$f3 = Base::instance();
$this->f3 = $f3;

$this->home_url = $f3->get('SCHEME').'://'.$f3->get('HOST').$f3->get('BASE');

// Base Dir
$this->base_dir = $f3->get('base_dir');

// Covers Dir
$this->cover_dir = "/home/Raws/Manga/cover";

// App Dir
$this->app_dir = $f3->get('app_dir');

// Public Path
$this->public_dir = $f3->get('public_dir');
}


// Show Error
function error($f3){
$f3->status(404);	
echo Template::instance()->render('error.htm');
exit;
}

// Set Data
function afterroute($f3) {
$site_title = $f3->get('site_title');
$active_menu = $f3->get('PATH');
$home_url = $this->home_url;
$f3->set('site_title',$site_title);
$f3->set('home_url',$home_url);
$f3->set('active_menu',$active_menu);
$maintenance = $f3->get('maintenance');
if($maintenance){
$f3->status(503);
echo Template::instance()->render('503.htm');
exit;
}


if(isset($this->tpl)){
/* Register Filters */
$preview = Template::instance();
$preview->filter('crop','Helper::instance()->crop');
$preview->filter('striptags','Helper::instance()->striptags');
$preview->filter('remove_slash','Helper::instance()->remove_slash');
$preview->filter('remove_spaces','Helper::instance()->remove_spaces');

$detect = new Mobile_Detect;

if ( $detect->isMobile() ) {
echo $preview->render('mobile/'.$this->tpl);
} else {
echo $preview->render($this->tpl);
}	

}

}

}