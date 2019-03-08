<?php

namespace App;

class Controller
{
    public function home()
    {
        return new View\View(
            'index',
            [
                'title' => 'Index page'
            ]
        );
    }

    public function about()
    {
        return 'About page';
    }

    public function personalMessagesShow()
    {
        return new View\View(
            'personal.messages.show',
            [
                'title' => 'Personal messages show'
            ]
        );
    }
}
