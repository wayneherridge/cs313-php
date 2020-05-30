<?php
error_reporting(E_ALL);

session_start();

require __DIR__ . '/core/dbconnect.php';
require __DIR__ . '/functions.php';

$basePath = __DIR__ . '/';

$url = explode('index.php', $_SERVER['PHP_SELF']);

// Subfolder
$baseURI = $url[0];

// URI (For Router)
$uri = $url[1];

if (empty($uri)) {
    $uri = '/';
}

$db = getDB();

switch ($uri) {
    case '/':
    case '/home':
        $title = "Home";
        require '/pages/home.php';
        exit;
        break;
    case '/add-post':
        $title = "Add Post";
        require '/pages/admin/addPost.php';
        break;
    case '/sign-up':
        $title = "Sign Up";
        require '/pages/signUp.php';
        break;
    case '/sign-in':
        $title = "Sign In";
        require '/pages/signIn.php';
        break;
    case '/sign-out':
        session_destroy();
        header('Location: ' . $baseURI);
        break;
    case '/view-post':
        $title = "View Post";
        require '/pages/post.php';
        break;
    default:
        echo '404: Page not found.';
        break;
}