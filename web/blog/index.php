<?php
$uri = $_SERVER['REQUEST_URI'];

// require '/core/dbconnect.php';

// $db = dbconnect();

switch ($uri) {
    case '/':
        $msg = "Hello World!";
        require 'pages/home.php';
        exit;
        break;
    case '/about':
        $msg = "About World!";
        require 'pages/about.php';
        break;
}