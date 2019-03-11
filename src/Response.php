<?php


namespace App;


class Response
{
    private $content;

    private $code;

    public function __construct($content, $code = 200)
    {
        $this->content = $content;
        $this->code = $code;
    }

    public function __toString(): string
    {
        http_response_code($this->code);
        return $this->content;
    }
}