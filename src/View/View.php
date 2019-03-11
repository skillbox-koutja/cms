<?php

namespace App\View;

class View implements Renderable
{

    private $template;
    private $data;

    public function __construct($template, $data)
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function render()
    {
        $path = VIEW_DIR . DIRECTORY_SEPARATOR . str_replace('.', DIRECTORY_SEPARATOR, $this->template) . '.php';
        if (!file_exists($path)) {
            throw new \InvalidArgumentException('Not found template ' . $this->template);
        }

        extract($this->data ?? []);
        require $path;
    }
}
