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

    <?php if (!auth()): ?>

    <a href="<?=$baseURI?>" class="btn btn-primary btn-sm">View All Posts</a>
    <?php else: ?>

    <form action="<?=$baseURI;?>view-post" method="POST">
        <label id="first"> Comment Date:</label><br />
        <input type="date" name="cdate" value="<?php echo sticky($cdate, $comments['cdate']); ?>"><br />

        <label id="first">Comment:</label><br />
        <input type="text" name="body" value="<?php echo sticky($body, $comments['body']); ?>"><br />

        <input type="hidden" name="comment_id" value="<?=$comments['comment_id']?>">

        <input type="hidden" name="post_id" value="<?=$post_id;?>">
        <input type="hidden" name="comment_id" value="<?=$comment_id;?>">
        <button type="submit" name="save">Add Comment</button>
    </form><br />
    <a href="<?=$baseURI?>" class="btn btn-primary btn-sm">View All Posts</a>
    <a href="<?=$baseURI?>edit-post?p=<?=$blogpost['post_id']?>" class="btn btn-primary btn-sm">Edit Post</a>
    <a href="<?=$baseURI?>delete-post?p=<?=$blogpost['post_id']?>" class="btn btn-primary btn-sm">Delete Post</a>
    <?php endif;?>

</div>

<?php require $basePath . '/partials/footer.php';