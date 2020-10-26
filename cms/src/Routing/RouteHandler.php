<?php

namespace App\Routing;

class RouteHandler
{
    private string $path;

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
