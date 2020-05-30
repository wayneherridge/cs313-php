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

    <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?=$post['title'];?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?=$post['pDate'];?></h6>
    <p class="card-text"><?=$post['body'];?></p>
    <a href="<?=$baseURI?>view-post?p=<?=$post['post_id']?>" class="card-link">View Post</a>
  </div>
</div>

<!-- <div>
    <h3><?=$post['title'];?></h3>
    <p><?=$post['pDate'];?></p>
    <p><?=$post['body'];?></p>
    <a href="<?=$baseURI?>view-post?p=<?=$post['post_id']?>" class="btn btn-primary">View Post</a>
</div> -->
<?php endforeach;?>

<?php require $basePath . '/partials/footer.php';