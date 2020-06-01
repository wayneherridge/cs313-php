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

    $query = $db->prepare('INSERT INTO posts (user_id, pDate, title, body) VALUES (:user_id, :pDate, :title, :body)');

    $query->execute([':user_id' => $user_id, ':pDate' => $pDate, ':title' => $title, ':body' => $body]);

    $result = $query->rowCount();

    $query->closeCursor();

    if ($result) {
        header('Location: ' . $baseURI);
    }
}

?>
<?php require $basePath . '/partials/header.php';?>
<form action="<?=$baseURI;?>delete-post" method="POST">
    <h3><?=$blogpost['title'];?></h3>
    <p><?=$blogpost['pdate'];?></p>
    <p><?=$blogpost['body'];?></p>

    <button type="submit" name="delete">Confirm Delete</button>
</form>
<?php require $basePath . '/partials/footer.php';?>