<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Controllers\UserController;

session_start();

require __DIR__ . '/../vendor/autoload.php';


$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'slim_app_com',
            'username' => 'vladymyr',
            'password' => 'password',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]
    ]
]);

$container = $app->getContainer();

/* 
* Eloquent settings 
*/
$capsule = new Capsule;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {

    return $capsule;
};

//controller container

$container['UserController'] = function ($container) {
    return new UserController($container);
};

require __DIR__ . '/../routes/web.php';


