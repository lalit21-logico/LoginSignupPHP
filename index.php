<?php

require_once 'controller/HomeController.php';
require_once 'controller/AdminController.php';
session_start();
$BASE_URL = "http://localhost";
$foo = new HomeController($BASE_URL);
$act = isset($_GET['act']) ? $_GET['act'] : "a";
if ($act == "adminUpdate") {
    $foo = new AdminController($BASE_URL);
}
if (substr($_SERVER['REQUEST_URI'], 0, 10) === "/LSS/admin") {
    $foo = new AdminController($BASE_URL);
}

$foo->index();



// <?php

// require_once 'controller/HomeController.php';
// require_once 'controller/AdminController.php';
// session_start();
// $BASE_URL = "http://localhost";
// $act = $_SERVER['REQUEST_URI'];
// echo $act;
// if (substr($act, 0, 10) === "/LSS/admin") {
//     $foo = new AdminController($BASE_URL);
//     $foo->index();
// } else {
//     $foo = new HomeController($BASE_URL);
//     $foo->index();
// }
