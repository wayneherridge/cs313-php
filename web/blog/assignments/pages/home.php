<?php
$searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

if (!empty($searchTerm)) {
    $statement = $db->prepare('SELECT * FROM posts WHERE title LIKE ?');
    $statement->execute(array('%' . $searchTerm . '%'));
} else {
    $statement = $db->prepare("SELECT * FROM posts");
    $statement->execute();
}
$blogposts = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();
?>
<?php require $basePath . '/partials/header.php';?>

<?php foreach ($blogposts as $post): ?>
<div>
    <h3><?=$post['title'];?></h3>
    <p><?=$post['body'];?></p>
    <a href="<?=$baseURI?>view-post?p=<?=$post['post_id']?>">View</a>
</div>
<?php endforeach;?>

<?php require $basePath . '/partials/footer.php';