<?php require $basePath . '/partials/header.php';?>

<div>
    <h3><?=$blogpost['title'];?></h3>
    <p><sub><?=$blogpost['pdate'];?></sub></p>
    <p><?=$blogpost['body'];?></p>

    <?php if (auth()): ?>

    <form action="<?=$baseURI;?>add-comment" method="POST">

        <label id="first">Comment:</label><br />
        <input type="text" name="body"><br />

        <input type="hidden" name="post_id" value="<?=$post_id?>">

        <button type="submit" name="save">Add Comment</button>
    </form><br />

    <?php endif;?>

    <a href="<?=$baseURI?>" class="btn btn-primary btn-sm">View All Posts</a>

    <?php if (isAdmin()): ?>
    <a href="<?=$baseURI;?>edit-post?p=<?=$blogpost['post_id'];?>" class="btn btn-primary btn-sm">Edit Post</a>
    <form action="<?=$baseURI;?>delete-post" method="POST">
        <input type="hidden" name="post_id" value="<?=$blogpost['post_id'];?>">
        <input type="submit" class="btn btn-danger btn-sm" value="Delete Post">
    </form>
    <?php endif;?>

    <?php foreach ($comments as $comment): ?>
    <div class="card">
        <div class="card-body">
            <p><?=$comment['body'];?></p>
            <form action="<?=$baseURI;?>delete-comment" method="POST">
                <input type="hidden" value="<?=$comment['comment_id'];?>" name="comment_id">
                <input type="hidden" name="post_id" value="<?=$blogpost['post_id'];?>">
                <?php if (isAdmin()): ?>
                <input type="submit" class="btn btn-danger btn-sm" value="Delete Comment">
                <?php endif;?>
            </form>
        </div>
    </div>
    <?php endforeach;?>
</div>

<?php require $basePath . '/partials/footer.php';?>