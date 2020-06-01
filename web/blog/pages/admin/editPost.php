<?php
$user = protect();

$user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
$pDate = filter_input(INPUT_POST, 'pDate', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($pDate) || empty($title) || empty($body)) {
        $message = "Missing Input";
    }

    $query = $db->prepare('UPDATE posts (user_id, pDate, title, body) VALUES (:user_id, :pDate, :title, :body)');

    $query->execute([':user_id' => $user_id, ':pDate' => $pDate, ':title' => $title, ':body' => $body]);

    $result = $query->rowCount();

    $query->closeCursor();

    if ($result) {
        header('Location: ' . $baseURI);
    }
}

?>
<?php require $basePath . '/partials/header.php';?>
<form action="<?=$baseURI;?>edit-post" method="POST">
    <label id="first"> Post Date:</label><br />
    <input type="date" name="pDate" value="<?php sticky($pDate);?>"><br />

    <label id="first">Post Title:</label><br />
    <input type="text" name="title" value="<?php sticky($title);?>"><br />

    <label id="first">Post Content:</label><br />
    <input type="text" name="body" value="<?php sticky($body);?>"><br />

    <input type="hidden" name="user_id" value="<?=$user['id']?>">

    <button type="submit" name="save">Update Post</button>
</form>
<?php require $basePath . '/partials/footer.php';?>