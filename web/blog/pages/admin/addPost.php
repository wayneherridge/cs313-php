<?php require $basePath . '/partials/header.php';?>
<form action="<?=$baseURI;?>add-post" method="POST">
    <label id="first"> Post Date:</label><br />
    <input type="date" name="pDate" value="<?php echo sticky($pDate); ?>"><br />

    <label id="first">Post Title:</label><br />
    <input type="text" name="title" value="<?php echo sticky($title); ?>"><br />

    <label id="first">Post Content:</label><br />
    <input type="text" name="body" value="<?php echo sticky($body); ?>"><br />

    <input type="hidden" name="user_id" value="<?=$user['id']?>">

    <button type="submit" name="save">Add Post</button>
</form>
<?php require $basePath . '/partials/footer.php';?>