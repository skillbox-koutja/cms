<?php

namespace App;

use App\Routing\Router;
use App\View\Renderable;

class Application
{
    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        try {
            $response = $this->createResponse();
        } catch (\Throwable $e) {
            $response = $this->renderException($e);
        }

        echo $response;
    }

    private function createResponse()
    {
        $result = $this->router->dispatch();
        if ($result instanceof Renderable) {
            return $this->renderResponse($result);
        }
        return $result instanceof Response ? $result : new Response($result);
    }

    private function renderResponse(Renderable $renderable): Response
    {
        ob_start();
        $renderable->render();
        $content = ob_get_clean();
        return new Response($content);
    }

    private function renderException(\Throwable $e)
    {
        if ($e instanceof Renderable) {
            return $this->renderResponse($e);
        }
        return new Response($e->getMessage(), $e->getCode());
    }
}
