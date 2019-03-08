<?php


namespace App;

use App\View\View;

class Router
{
    /** @var RouteHandler[] */
    private $handlers = [];

    /**
     * @param $path
     * @param $callback
     * @return $this
     */
    public function get($path, $callback): Router
    {
        $this->handlers[] = new RouteHandler($path, $callback);
        return $this;
    }

    public function dispatch()
    {
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        foreach ($this->handlers as $handler) {
            if ($handler->match($urlPath)) {
                return $this->invokeCallback($handler);
            }
        }
        return new Response('Page not found', 404);
    }

    /**
     * @param RouteHandler $handler
     * @return Response|mixed
     */
    private function invokeCallback(RouteHandler $handler)
    {
        $callback = $handler->getCallback();
        if (is_string($callback)) {
            $callback = function () use ($callback) {
                list ($className, $handler) = explode('@', $callback);
                return (new $className())->{$handler}();
            };
        }

        $data = $callback();
        if ($data instanceof View) {
            $data->render();
            return new Response('');
        }
        return $data instanceof Response ? $data : new Response($data);
    }
}