<?php

namespace Cupcake\Controllers;

class Controller
{


    public function __construct()
    {
    }

    protected function renderView($name, $data = [])
    {
        $file = "../Views/" . $name;

        if (file_exists($file)) {
            compact($data);
            require_once $file;
        }
    }
}
