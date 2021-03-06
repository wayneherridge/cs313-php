<?php
error_reporting(E_ALL);

session_start();

require __DIR__ . '/core/dbconnect.php';
require __DIR__ . '/functions.php';

$basePath = __DIR__ . '/';

$url = explode('index.php', $_SERVER['PHP_SELF']);
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$action = trim(str_replace($url[0], "", $uri), '/');

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

        // Post
        $post_id = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);

        if (empty($post_id)) {
            die('Post does not exist');
        }

        $query = $db->prepare('SELECT * FROM posts WHERE post_id = :post_id');

        $query->execute([':post_id' => $post_id]);

        $blogpost = $query->fetch(PDO::FETCH_ASSOC);

        // Comments
        $query->closeCursor();

        $query = $db->prepare('SELECT * FROM comments WHERE post_id = :post_id');

        $query->execute([':post_id' => $post_id]);

        $comments = $query->fetchAll(PDO::FETCH_ASSOC);

        $query->closeCursor();

        require 'pages/post.php';
        exit;
        break;
    case 'add-post':
        $title = "Add Post";

        $user = protect();

        // Process Form
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $pDate = filter_input(INPUT_POST, 'pDate', FILTER_SANITIZE_STRING);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (empty($pDate) || empty($title) || empty($body)) {
                    $message = "Missing Input";
                    require 'pages/admin/addPost.php';
                    exit;
                }

                $query = $db->prepare('INSERT INTO posts (user_id, pdate, title, body) VALUES (:user_id, :pDate, :title, :body)');

                $query->execute([':user_id' => $user_id, ':pDate' => $pDate, ':title' => $title, ':body' => $body]);

                $result = $query->rowCount();

                $query->closeCursor();

                if ($result) {
                    header('Location: ' . $baseURI);
                }
            }
        }
        // Display Form
        require 'pages/admin/addPost.php';
        exit;
        break;
    case 'edit-post':
        $title = "Edit Post";

        $user = protect();

        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
        $pDate = filter_input(INPUT_POST, 'pDate', FILTER_SANITIZE_STRING);
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process Form

            // Post ID :: POST
            $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);

            if (empty($pDate) || empty($title) || empty($body)) {
                $query = $db->prepare('SELECT * FROM posts WHERE post_id = :post_id');
                $query->execute(['post_id' => $post_id]);

                $post = $query->fetch(PDO::FETCH_ASSOC);

                $query->closeCursor();

                $message = "Missing Input";
                require 'pages/admin/editPost.php';
                exit;
            }

            $query = $db->prepare('UPDATE posts SET pdate = :pDate, title = :title, body = :body WHERE post_id = :post_id');

            $query->execute([':post_id' => $post_id, ':pDate' => $pDate, ':title' => $title, ':body' => $body]);

            $result = $query->rowCount();

            $query->closeCursor();

            if ($result) {
                header('Location: ' . $baseURI);
                exit;
            }

        } else {
            // Post ID:: Get
            $post_id = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
        }

        // Get the Post from the DB
        $query = $db->prepare('SELECT * FROM posts WHERE post_id = :post_id');
        $query->execute(['post_id' => $post_id]);

        $post = $query->fetch(PDO::FETCH_ASSOC);

        $query->closeCursor();

        // Display Form
        require 'pages/admin/editPost.php';
        exit;
        break;
    case 'delete-post':
        $user = protect();

        $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);

        if (empty($post_id)) {
            header('Location: ' . $baseURI);
            exit;
        }

        $query = $db->prepare('DELETE FROM posts WHERE post_id = :post_id');
        $query->execute(['post_id' => $post_id]);

        $result = $query->rowCount();

        $query->closeCursor();

        if ($result) {
            require '/pages/view-post?p=' . $post_id;
            exit;
        }

        header('Location: ' . $baseURI);
        exit;
        break;
    case 'add-comment':
        $user = auth();
        if (!auth()) {
            return header('Location: ' . $baseURI . '/login');
            exit;
        }

        $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
        $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

        if (empty($body)) {
            $message = 'Please enter a valid comment.';
            require 'pages/view-post?p=' . $post_id;
            exit;
        }

        $query = $db->prepare('INSERT INTO comments (post_id, body) VALUES (:post_id, :body)');

        $query->execute([
            'post_id' => $post_id,
            'body' => $body,
        ]);

        $result = $query->rowCount();

        $query->closeCursor();

        header('Location: ' . $baseURI . 'view-post?p=' . $post_id);
        exit;
        break;
    case 'delete-comment':
        $user = protect();

        $comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_NUMBER_INT);
        $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);

        $query = $db->prepare('DELETE FROM comments WHERE comment_id = :comment_id');
        $query->execute([':comment_id' => $comment_id]);

        $query->closeCursor();

        header('Location: ' . $baseURI . 'view-post?p=' . $post_id);
        exit;
        break;
    default:
        echo '404: Page not found.';
        exit;
        break;
}