<?php
$post_id = filter_input(INPUT_GET, 'p', FILTER_SANITIZE_NUMBER_INT);

if (empty($post_id)) {
    die('Post does not exist');
}

$query = $db->prepare('SELECT * FROM posts WHERE post_id = :post_id');

$query->execute([':post_id' => $post_id]);

$blogpost = $query->fetch(PDO::FETCH_ASSOC);

$query->closeCursor();
?>
<?php require $basePath . '/partials/header.php';?>

<div>
    <h3><?=$blogpost['title'];?></h3>
    <p><?=$blogpost['pdate'];?></p>
    <p><?=$blogpost['body'];?></p>

    <a href="<?=$baseURI?>">View All Posts</a>

</div>

<?php require $basePath . '/partials/footer.php';