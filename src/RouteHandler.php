<?php


namespace App;

class RouteHandler
{
    private $path;

    private $callback;

    public function __construct($path, $callback)
    {
        $this->path = $path;
        $this->callback = $callback;
    }

    public function match($path)
    {
        return $this->path === $path;
    }

    /**
     * @return mixed
     */
    public function getCallback()
    {
        return $this->callback;
    }
}