<?php
use Rest\Controllers\MainController;

//Include file with includes
include ('includes.php');

//Get method, route, and data and pass them to main controller
new MainController(
    $_SERVER['REQUEST_METHOD'],
    $_GET['route'],
    file_get_contents('php://input')
);