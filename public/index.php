<?php

use juanignaso\phpmvc\framework\Usuario;

require_once __DIR__ . '/../vendor/autoload.php';

//Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use juanignaso\phpmvc\framework\Application;

//Configurations
$config = [
    'userClass' => Usuario::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

//Create instance of the application
$app = new Application(dirname(__DIR__), $config);

#Define the routes here
/*
$app->router->['http request(get/post)']('/url',controller::class,'method')
*/
/*---------------------------------------------------------*/

##Home page
$app->router->get('/', [app\controllers\SiteController::class, 'home']);

/*---------------------------------------------------------*/

$app->run();