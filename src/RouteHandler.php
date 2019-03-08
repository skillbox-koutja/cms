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
     * @return Response
     */
    public function __invoke()
    {
        return $this->invokeCallback();
    }

    /**
     * @return Response
     */
    private function invokeCallback()
    {
        if (is_string($this->callback)) {
            $callback = function () {
                list ($className, $handler) = explode('@', $this->callback);
                return (new $className())->{$handler}();
            };
        } else {
            $callback = $this->callback;
        }
        $data = $callback();
        return $data instanceof Response ? $data : new Response($data);
    }
}