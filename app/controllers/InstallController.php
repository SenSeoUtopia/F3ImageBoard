<?php
use Illuminate\Database\Capsule\Manager as Capsule;	
use Illuminate\Database\Schema\Blueprint;


class InstallController extends BaseController{

	protected $tpl = "install.htm";

	public function intro(Base $f3){

		$f3->set("page",array('content' => 'install/home.htm','title' => 'Installation'));
	}

	public function check_permission(Base $f3){

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
	public function database(Base $f3){

		$f3->set("page",array('content' => 'install/database.htm','title' => 'Configure Database','validator' => true));
	}

	public function database_check(Base $f3){

		$db_host = $f3->exists('POST.db_host') ? $f3->get('POST.db_host') : 'localhost';
		$db_name = $f3->get('POST.db_name');
		$db_user = $f3->exists('POST.db_user') ? $f3->get('POST.db_user') : 'root';
		$db_pass = $f3->get('POST.db_pass');
		$db_prefix = $f3->exists('POST.db_prefix') ? $f3->get('POST.db_prefix') : 'senseo_';

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
			db_prefix = $db_prefix
			";

		$erro = null;
		if(!file_put_contents($file_path,$content)){
			$error = "Unable to save Configuration check file permission.";
		}

		// Connect Database
        try {
            $db = new DB\SQL("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
            $f3->reroute("/install/database/load");
        } catch (PDOException $e) {
            $msg = "Error establishing a database connection";
        }

		$f3->set("page",array('content' => 'install/database.htm','title' => 'Configure Database','msg' => $msg,'errors' => $error,'validator' => true));
	}

	// Loading Tables
	public function database_load(Base $f3){

		// Users
		Capsule::schema()->create('users', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('user_name');
			$table->text('password');
			$table->text('email');
			$table->string('activation_code')->nullable();			
			$table->tinyInteger('active')->nullable();
			$table->tinyInteger('is_admin')->nullable();			
			$table->timestamps();
		});

		// Boards
		Capsule::schema()->create('categories', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('title');
			$table->timestamps();
		});		
		
		// Boards
		Capsule::schema()->create('boards', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('name');
			$table->string('slug');
			$table->integer('category_id')->unsigned()->nullable();
            $table->tinyInteger('show_contry_flag')->nullable();
			$table->timestamps();
		});


		// Threads
		Capsule::schema()->create('threads', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->string('name');
			$table->integer('board_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
		});
		
		// Posts
		Capsule::schema()->create('posts', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->boolean('is_thread');
			$table->boolean('spoiler')->nullable();
            $table->integer('board_id')->unsigned();
			$table->integer('thread_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->text('content')->nullable();
			$table->string('user_name')->nullable();
			$table->string('password')->nullable();
			$table->string('ip');
			$table->timestamps();
		});		

		
		// Photos
		Capsule::schema()->create('photos', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->integer('board_id')->unsigned();			
			$table->integer('thread_id')->unsigned();
			$table->integer('post_id')->unsigned();
			$table->text('file_name');
			$table->text('original_name');
			$table->integer('size');
			$table->string('pixels');			
			$table->timestamps();
		});

		
		// Bans
		Capsule::schema()->create('bans', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('ip');
			$table->string('reason')->nullable();
			$table->tinyInteger('remove');
			$table->timestamps();
		});		
		

		// Reports		
		Capsule::schema()->create('reports', function (Blueprint $table) {
			$table->increments('id')->unsigned();
			$table->integer('post_id')->unsigned();
			$table->string('ip');
			$table->timestamps();
		});		
		
		
		// Roles
		Capsule::schema()->create('roles', function ($table) {
			$table->increments('id')->unsigned();
			$table->string('title');
			$table->timestamps();
		});

		// User Roles
		Capsule::schema()->create('role_user', function ($table) {
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('role_id')->unsigned();
			$table->timestamps();
		});		
		
		
		/*  Add Foreign Keys */
		
		// Threads
		Capsule::schema()->table('threads', function (Blueprint $table) {
			$table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
		});
		
		// Posts
		Capsule::schema()->table('posts', function (Blueprint $table) {			
			$table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
			$table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
		});		

		
		// Photos
		Capsule::schema()->table('photos', function (Blueprint $table) {	
			$table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
		});
		
		
		$msg = "Table Created ";

		$f3->set("page",array('content' => 'install/database_done.htm','title' => 'Database Created','msg' => $msg));
	}

	// Create Administrator Account
	public function create_admin(Base $f3){

		$f3->set("page",array('content' => 'install/admin_create.htm','title' => 'Administrator Account Create','validator' => true));
	}

	public function create_admin_process(Base $f3){

		// Connect Database
		try {
			$db = new DB\SQL($f3->get('db_dns') . $f3->get('db_name'), $f3->get('db_user'), $f3->get('db_pass'));
		} catch (PDOException $e) {
			$msg = "Error establishing a database connection";
		}

		$db_host = $f3->get('db_host','localhost');
		$db_name = $f3->get('db_name','social');
		$db_user = $f3->get('db_user','root');
		$db_pass = $f3->get('db_pass','');
		$db_prefix = $f3->get('db_prefix','senseo_');

		/* Database */
		$capsule = new Capsule;

		$capsule->addConnection(array(
		'driver'    => 'mysql',
		'host'      => $db_host,
		'database'  => $db_name,
		'username'  => $db_user,
		'password'  => $db_pass,
		'charset'   => 'utf8',
		'collation' => 'utf8_general_ci',
		'prefix'    => $db_prefix
        ));

		$capsule->setAsGlobal();
		$capsule->bootEloquent();

		$user_name = $f3->get('POST.user_name');

		$email = $f3->get('POST.email');

		$password = password_hash($f3->get('POST.password'), PASSWORD_DEFAULT);

		$active = 1;

		$is_admin = 1;

		$user = User::firstOrNew(["email" => $email]);
		$user->user_name = $user_name;
		$user->password = $password;
		$user->activation_code = "";
		$user->active = $active;
		$user->is_admin = $is_admin;

		if($user->save()){
			$f3->reroute("/install/finish");
		}

		$errors = "Unable to create Administrator Account";

		$f3->set("page",array('content' => 'install/admin_create.htm','title' => 'Administrator Account Create','errors' => $errors,'validator' => true));
	}

	// Finishing
	public function finish(Base $f3){

		$f3->set("page",array('content' => 'install/complete.htm','title' => 'Installation Completed'));
	}


}