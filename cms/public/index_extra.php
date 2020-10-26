<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require dirname(__DIR__).'/config/bootstrap.php';

$router = new \App\Router();

$router->get('/', \App\Controller::class . '@index');
$router->get('/about', \App\Controller::class . '@about');
$router->get('/personal/messages/show', \App\Controller::class . '@personalMessagesShow');

$application = new \App\Application($router);

$application->run();
