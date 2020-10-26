<?php

namespace App\Exception;

use App\View;

class NotFoundException extends HttpException implements View\Renderable
{
    public function __construct(
        $message = "Not Found",
        $code = 404,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        (new View\View(
            'not_found',
            [
                'title' => 'Oops! An Error Occurred',
                'message' => $this->message,
                'code' => 0 === $this->code ? 500 : $this->code,
            ]
        ))
            ->render();
    }
}
