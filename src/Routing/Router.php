<?php


namespace App\Routing;

use App\Routing\Exception\RouteNotFoundException;

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
        throw new RouteNotFoundException();
    }

    /**
     * @param RouteHandler $handler
     * @return mixed
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

        return $callback();
    }
}