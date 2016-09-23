<?php

class InstallController extends BaseController{

protected $tpl = "install.htm";

public function intro($f3){

$f3->set("page",array('content' => 'install/home.htm','title' => 'Installation'));
}

public function check_permission($f3){

$app_dir = $this->app_dir;

$public_dir = $this->public_dir;

// Curl
$check_curl = function_exists('curl_init') ? true :  false;
$check_curl_msg = ($check_curl) ? "<i class=\"icon-ok\"></i> Installed" : "<i class=\"icon-cross\"></i> Not Installed";

// Check php > 5.4
$php_check = (version_compare(PHP_VERSION, '5.5.0', '>'))  ? true :  false;
$check_php_msg = ($php_check) ? "<i class=\"icon-ok\"></i> Good" : "<i class=\"icon-cross\"></i>  Its OK.";

// Mysqli Enable
$check_mysqli = function_exists('mysqli_connect') ? true :  false;

$check_mysqli_msg = ($check_mysqli) ? "<i class=\"icon-ok\"></i> Installed" : "<i class=\"icon-cross\"></i> Not Installed";

// GD Library 
$check_gd = (extension_loaded('gd') && function_exists('gd_info'))  ? true :  false;

$check_gd_msg = ($check_gd) ? "<i class=\"icon-ok\"></i> Installed" : "<i class=\"icon-cross\"></i> Not Installed";

// Check mbstring
$check_mbstring = extension_loaded('mbstring')  ? true :  false;
$check_mbstring_msg = ($check_mbstring) ? "<i class=\"icon-ok\"></i> Installed" : "<i class=\"icon-cross\"></i> Not Installed";

// Check mycrypt
$check_mycrypt = function_exists("mcrypt_encrypt") ? true :  false;
$check_mycrypt_msg = ($check_mycrypt) ? "<i class=\"icon-ok\"></i> Installed" : "<i class=\"icon-cross\"></i> Not Installed";

// Check App Folder

$check_app_dir = is_writable($app_dir)  ? true : false;

$check_app = ($check_app_dir) ? "<i class=\"icon-ok\"></i> Writeable" : "<i class=\"icon-cross\"></i> Fix Permission";

// Check Public Folder

$public_check = is_writable($public_dir) ? true : false;

$public = ($public_check) ? "<i class=\"icon-ok\"></i> Writeable" : "<i class=\"icon-cross\"></i> Fix Permission";

// Check Configure file

$config_check = is_writable("$app_dir/config.ini") ? true : false;

$config = ($config_check) ? "<i class=\"icon-ok\"></i> Writeable" : "<i class=\"icon-cross\"></i> Fix Permission";

$success = false;

if($php_check && $check_curl && $check_gd && $check_mysqli && $check_mbstring && $check_mycrypt && $check_app && $public_check && $config_check){
$success = true;
}

$f3->set("page",array(
'content' => 'install/permission.htm',
'title' => 'Checking Permission',
'success' => $success,
'check_php' => $php_check,
'check_php_msg' => $check_php_msg,
'check_curl' => $check_curl,
'check_curl_msg' => $check_curl_msg,
'check_gd' => $check_gd,
'check_gd_msg' => $check_gd_msg,
'check_mbstring' => $check_mbstring,
'check_mbstring_msg' => $check_mbstring_msg,
'check_mycrypt' => $check_mycrypt,
'check_mycrypt_msg' => $check_mycrypt_msg,
'check_mysqli' => $check_mysqli,
'check_mysqli_msg' => $check_mysqli_msg,
'app_check' => $check_app_dir,
'check_app_folder' => $check_app,
'public_check' => $public_check,
'public_folder' => $public,
'config_check' => $config_check,
'config_file' => $config
));
}


// Database Setting
public function database($f3){

$f3->set("page",array('content' => 'install/database.htm','title' => 'Configure Database','validator' => true));
}

public function database_check($f3){

$db_host = $f3->exists('POST.db_host') ? $f3->get('POST.db_host') : 'localhost';
$db_name = $f3->get('POST.db_name');
$db_user = $f3->exists('POST.db_user') ? $f3->get('POST.db_user') : 'root';
$db_pass = $f3->get('POST.db_pass');

$app_dir = $this->app_dir;

$file_path = "$app_dir/database.ini";

$content = "
; Set Installed
installed = true

; Database Settings
db_dns = mysql:host=$db_host;dbname=
db_host = $db_host
db_name = $db_name
db_user = $db_user
db_pass = $db_pass
";

$erro = null;
if(!file_put_contents($file_path,$content)){
$error = "Unable to save Configuration check file permission.";
}

// Connect Database
try {
$db = new DB\SQL($f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));
$f3->reroute("/install/database/load");
} catch (PDOException $e) {
$msg = "Error establishing a database connection";
}

$f3->set("page",array('content' => 'install/database.htm','title' => 'Configure Database','msg' => $msg,'errors' => $error,'validator' => true));
}

// Loading Tables
public function database_load($f3){

// Connect Database
try {
$db = new DB\SQL($f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));
} catch (PDOException $e) {
$msg = "Error establishing a database connection";
}

$app_dir = $this->app_dir;

$db_file = "$app_dir/db.sql";

$op_data = '';
$lines = file($db_file);
foreach ($lines as $line)
{
    if (substr($line, 0, 2) == '--' || $line == '')//This IF Remove Comment Inside SQL FILE
    {
        continue;
    }
    $op_data .= $line;
    if (substr(trim($line), -1, 1) == ';')//Breack Line Upto ';' NEW QUERY
    {
        $db->query($op_data);
        $op_data = '';
    }
}
$msg = "Table Created ";

$f3->set("page",array('content' => 'install/database_done.htm','title' => 'Database Created','msg' => $msg));
}

// Create Administrator Account
public function create_admin($f3){

$f3->set("page",array('content' => 'install/admin_create.htm','title' => 'Administrator Account Create','validator' => true));
}

public function create_admin_process($f3){

// Connect Database
try {
$db = new DB\SQL($f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));
} catch (PDOException $e) {
$msg = "Error establishing a database connection";
}


$user_name = $f3->get('POST.user_name');

$email = $f3->get('POST.email');

$password = password_hash($f3->get('POST.password'), PASSWORD_DEFAULT);

$active = 1;

$is_admin = 1;

$user = new Users($db);
$user->user_name = $user_name;
$user->email = $email;
$user->password = $password;
$user->active = $active;
$user->is_admin = $is_admin;

if($user->save()){
$f3->reroute("/install/finish");
}

$errors = "Unable to create Administrator Account";

$f3->set("page",array('content' => 'install/admin_create.htm','title' => 'Administrator Account Create','errors' => $errors,'validator' => true));
}

// Finishing
public function finish($f3){

$f3->set("page",array('content' => 'install/complete.htm','title' => 'Installation Completed'));
}

   
}