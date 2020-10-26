<?php

use App\Application;
use App\Routing;
use App\View;

error_reporting(E_ALL);
ini_set('display_errors', true);

require dirname(__DIR__).'/config/bootstrap.php';

$router = new Routing\Router();

$router->get('/', function () {
    return new View\View('index', ['title' => 'Index page']);
});
$router->get('/about', function () {
    return 'About page';
});
$router->get('/personal/messages/show', function () {
    return new View\View(
        'personal.messages.show',
        [
            'title' => 'Personal messages show'
        ]);
});

$application = new Application($router);

$application->run();
