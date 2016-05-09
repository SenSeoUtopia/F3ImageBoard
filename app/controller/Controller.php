<?php

class Controller {

protected $f3;
protected $db;
protected $tpl = 'base.htm';
protected $home_url;

function __construct() {

$f3=Base::instance();
$this->f3=$f3;
$this->home_url = $this->f3->get('SCHEME').'://'.$this->f3->get('HOST').$this->f3->get('BASE');

try {
$db=new DB\SQL(
$f3->get('db_dns') . $f3->get('db_name'),
$f3->get('db_user'),
$f3->get('db_pass')
);
} catch (PDOException $e) {
echo "<h1>Error establishing a database connection</h1>";
exit;
}

$this->db=$db;
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

// Check Login
$get_auth = $f3->get('SESSION.user');

if($get_auth){

$f3->set('logged_in',true);

$f3->set('users',$get_auth);	

}


if(isset($this->tpl)){
/* Register Filters */
$preview = Template::instance();
$preview->filter('crop','Helper::instance()->crop');
$preview->filter('striptags','Helper::instance()->striptags');
$preview->filter('remove_slash','Helper::instance()->remove_slash');
$preview->filter('remove_spaces','Helper::instance()->remove_spaces');
$preview->filter('remove_white_spaces','Helper::instance()->remove_white_spaces');
$preview->filter('replace_data','Helper::instance()->replace_data');
echo $preview->render($this->tpl);

}

}

}