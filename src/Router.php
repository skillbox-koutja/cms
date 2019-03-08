<?php


namespace App;

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
                return $handler();
            }
        }
        return new Response('Page not found', 404);
    }
}