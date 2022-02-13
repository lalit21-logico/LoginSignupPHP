<?php

class Controller
{

    public function view($view, $data = [])
    {
        if (file_exists('../LSS/views/' . $view . '.php')) {
            require_once '../LSS/views/' . $view . '.php';
        } else {
            die("View does not exists.");
        }
    }
}
