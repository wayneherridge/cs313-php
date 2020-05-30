<?php
function sticky($field)
{
    if (isset($_POST[$field])) {
        return $_POST[$field];
    } else {
        return "";
    }
}

function auth()
{
    if (isset($_SESSION['user'])) {
        return $_SESSION['user'];
    } else {
        return false;
    }
}

function guest()
{
    if (!isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

function protect($role = 'user')
{
    $user = auth();
    if (!$user) {
        header("Location: {$baseURI}sign-in");
        exit; // we always include a die after redirects.
    }
    if (!$user['is_admin'] && $role === 'admin') {
        die('This action is not authorized');
    }
    return $user;
} 