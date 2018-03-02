<?php
error_reporting(E_ALL); ini_set("display_errors", 1);

spl_autoload_register(function ($class_name) {
    include str_replace("\\", "/", $class_name) . ".php";
});


$route = new Core\Route();
include 'App/route.php';
$route->run();