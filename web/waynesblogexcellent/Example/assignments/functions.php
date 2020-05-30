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
        header("Location: {$baseURI}sign-in");
        exit;
    }
}

function guest()
{
    if (isset($_SESSION['user'])) {
        return false;
    } else {
        header("Location: {$baseURI}/");
        exit;
    }
}

function protect()
{
    $user = auth();
    if (!$user['is_admin']) {
        header("Location: {$baseURI}sign-in");
        exit; // we always include a die after redirects.
    }
    return $user;
}