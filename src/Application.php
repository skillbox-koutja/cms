<?php


namespace App;


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
        echo $this->router->dispatch();
    }
}