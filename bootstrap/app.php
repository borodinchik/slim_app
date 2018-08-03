<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Validation\Validator;
use Respect\Validation\Validator as v;

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

//Validator

$container['validator'] = function ($container)
{
    return new Validator;
};

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

$container['auth'] = function ($container)
{
    return new \App\Auth\Auth();
};


v::with('App\\Rules\\');


require __DIR__ . '/../routes/web.php';


