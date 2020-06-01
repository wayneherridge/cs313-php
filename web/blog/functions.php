<?php
function sticky($new, $old)
{
    if (empty($new)) {
        return $new;
    } else if (isset($old)) {
        return $old;
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

function protect()
{
    // Get the Authenticated User
    $user = auth();
    if (!$user) {
        return header('Location: ' . $baseURI . '/');
        exit;
    }
    if (!$user['admin']) {
        return header('Location: ' . $baseURI . '/');
        exit;
    }
    return $user;
}