<?php

namespace App;

use App\Routing\Exception\RouteNotFoundException;
use App\Routing\Router;
use App\View\Renderable;

class Application
{
    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        try {
            $response = $this->createResponse();
        } catch (RouteNotFoundException $e) {
            $response = $this->notFoundPageResponse();
        }

        echo $response;
    }

    private function createResponse()
    {
        $result = $this->router->dispatch();
        if ($result instanceof Renderable) {
            ob_start();
            $result->render();
            $content = ob_get_clean();
            $result = new Response($content);
        }
        return $result instanceof Response ? $result : new Response($result);
    }

    private function notFoundPageResponse()
    {
        return new Response('Page not found', 404);
    }
}