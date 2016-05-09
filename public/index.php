<?php
require_once("../vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as Capsule;

$f3 = Base::instance();

/* Main Config File */
$f3->config("../app/config.ini");
/* Database */
$f3->config("../app/database.ini");
/* Routes */
$f3->config("../app/routes.ini");
/* Settings */
$f3->config("../app/settings.ini");

// Database Connect

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $f3->get('db_host','localhost'),
    'database'  => $f3->get('db_name','social'),
    'username'  => $f3->get('db_user','root'),
    'password'  => $f3->get('db_pass',''),
    'charset'   => 'utf8',
    'collation' => 'utf8_general_ci',
    'prefix'    => $f3->get('db_prefix','senseo_')
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// User Table

// Messages Table

// Friend Request Table

// Friends Table

// Post Table

// Album Table

// Photos Table

// Notification Table

// Share Table

// Likes Table

// Comment Table

$f3->run();