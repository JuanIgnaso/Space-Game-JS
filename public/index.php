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

##Scoreboard page
$app->router->get('/scoreBoard', [app\controllers\GamesController::class, 'scores']);

##Game
$app->router->get('/game', [app\controllers\SiteController::class, 'game']);


##Login/Register
$app->router->get('/register', [app\controllers\AuthController::class, 'register']);
$app->router->post('/register', [app\controllers\AuthController::class, 'register']);
$app->router->get('/login', [app\controllers\AuthController::class, 'login']);
$app->router->post('/login', [app\controllers\AuthController::class, 'login']);

#Guardar Juego
$app->router->get('/saveGame', [app\controllers\GamesController::class, 'saveGame']);
$app->router->post('/saveGame', [app\controllers\GamesController::class, 'saveGame']);

$app->router->get('/logout', [app\controllers\AuthController::class, 'logout']);

/*---------------------------------------------------------*/

$app->run();