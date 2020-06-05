<?php
function sticky($new, $old = null)
{
    if (!empty($new)) {
        return $new;
    }
    if (isset($old)) {
        return $old;
    }
    return "";
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
    if (!isAdmin()) {
        return header('Location: ' . $baseURI . '/');
        exit;
    }
    return $user;
}

function isAdmin()
{
    $user = auth();
    if (!$user) {
        return false;
    }
    if (!$user['admin']) {
        return false;
    }
    return $user;
}
