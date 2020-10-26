<?php

use App\Application;
use App\Controller;
use App\Routing\Router;

error_reporting(E_ALL);
ini_set('display_errors', true);

require dirname(__DIR__).'/config/bootstrap.php';

$router = new Router();

$router->get('/', Controller::class . '@index');
$router->get('/about', Controller::class . '@about');
$router->get('/personal/messages/show', Controller::class . '@personalMessagesShow');

$application = new Application($router);

$application->run();
