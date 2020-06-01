<?php
$user = protect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Post ID :: POST
    $post_id = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
    $pDate = filter_input(INPUT_POST, 'pDate', FILTER_SANITIZE_STRING);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

    if (empty($pDate) || empty($title) || empty($body)) {
        $message = "Missing Input";
    }

    $query = $db->prepare('UPDATE posts (pDate, title, body) VALUES (:pDate, :title, :body) WHERE post_id = :post_id');

    $query->execute([':post_id' => $post_id, ':pDate' => $pDate, ':title' => $title, ':body' => $body]);

    $result = $query->rowCount();

    $query->closeCursor();

    if ($result) {
        header('Location: ' . $baseURI);
    }
} else {
    // Post ID :: GET
    $post_id = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);
}

// Get the Post from the DB
$query = $db->prepare('SELECT * FROM posts WHERE post_id = :post_id');
$query->execute(['post_id' => $post_id]);

$post = $query->fetch(PDO::FETCH_ASSOC);

$query->closeCursor();

?>
<?php require $basePath . '/partials/header.php';?>

<form action="<?=$baseURI;?>" method="POST">
    <label id="first"> Post Date:</label><br />
    <input type="date" name="pDate" value="<?php sticky($pDate, $post); ?>"><br />

    <label id="first">Post Title:</label><br />
    <input type="text" name="title" value="<?php sticky($title, $post);?>"><br />

    <label id="first">Post Content:</label><br />
    <input type="text" name="body" value="<?php sticky($body);?>"><br />

    <input type="hidden" name="user_id" value="<?=$user['id']?>">

    <input type="hidden" name="post_id" value="<?=$post_id;?>">

    <button type="submit" name="save">Update Post</button>
</form>

<?php require $basePath . '/partials/footer.php';?>