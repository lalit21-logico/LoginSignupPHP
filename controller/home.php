<?php
require_once "controller.php";

class Home extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $data['title'] = 'Home page';

        $this->view('index', $data);
    }
}
