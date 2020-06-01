<?php require $basePath . '/partials/header.php';?>
<form action="<?=$baseURI;?>edit-post" method="POST">
    <label id="first"> Post Date:</label><br />
    <input type="date" name="pDate" value="<?php echo sticky($pDate, $post['pdate']); ?>"><br />

    <label id="first">Post Title:</label><br />
    <input type="text" name="title" value="<?php echo sticky($title, $post['title']); ?>"><br />

    <label id="first">Post Content:</label><br />
    <input type="text" name="body" value="<?php echo sticky($body, $post['body']); ?>"><br />

    <input type="hidden" name="user_id" value="<?=$user['id']?>">

    <input type="hidden" name="post_id" value="<?=$post['post_id'];?>">

    <button type="submit" name="save">Update Post</button>
</form>
<?php require $basePath . '/partials/footer.php';?>