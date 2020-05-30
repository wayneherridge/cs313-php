<?php
error_reporting(E_ALL);

session_start();

require __DIR__ . '/core/dbconnect.php';
require __DIR__ . '/functions.php';

$basePath = __DIR__ . '/';

$url = explode('index.php', $_SERVER['PHP_SELF']);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$action = trim(str_replace($url[0], "", $uri));

// Subfolder
$baseURI = $url[0];

if (empty($action)) {
    $action = '/';
}

$db = getDB();

switch ($action) {
    case '/':
    case 'home':
        $title = "Home";
        require 'pages/home.php';
        exit;
        break;
    case 'add-post':
        $title = "Add Post";
        require 'pages/admin/addPost.php';
        exit;
        break;
    case 'sign-up':
        $title = "Sign Up";
        require 'pages/signUp.php';
        exit;
        break;
    case 'sign-in':
        $title = "Sign In";
        require 'pages/signIn.php';
        exit;
        break;
    case 'sign-out':
        session_destroy();
        header('Location: ' . $baseURI);
        exit;
        break;
    case 'view-post':
        $title = "View Post";
        require 'pages/post.php';
        exit;
        break;
    default:
        echo '404: Page not found.';
        exit;
        break;
}