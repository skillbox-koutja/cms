<?php


namespace App;


class Response
{
    private $data;

    private $code;

    public function __construct($data, $code = 200)
    {
        $this->data = $data;
        $this->code = $code;
    }

    public function __toString()
    {
        http_response_code($this->code);
        return $this->data;
    }
}