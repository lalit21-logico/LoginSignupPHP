<?php

require_once 'controller/HomeController.php';
session_start();

$foo = new HomeController();
$foo->index();
