<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

require_once 'bootstrap.php';

$router = new \App\Router();

$router->get('/', function () {
    return new App\View\View('index', ['title' => 'Index page']);
});
$router->get('/about', function () {
    return 'About page';
});
$router->get('/personal/messages/show', function () {
    return new App\View\View(
        'personal.messages.show',
        [
            'title' => 'Personal messages show'
        ]);
});

$application = new \App\Application($router);

$application->run();
