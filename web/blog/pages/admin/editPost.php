
<?php require $basePath . '/partials/header.php';?>

<?php
var_dump($post);
die;
?>

<form action="<?=$baseURI;?>" method="POST">
    <label id="first"> Post Date:</label><br />
    <input type="date" name="pDate" value="<?php sticky($pDate, $post);?>"><br />

    <label id="first">Post Title:</label><br />
    <input type="text" name="title" value="<?php sticky($title, $post);?>"><br />

    <label id="first">Post Content:</label><br />
    <input type="text" name="body" value="<?php sticky($body, $post);?>"><br />

    <input type="hidden" name="user_id" value="<?=$user['id']?>">

    <input type="hidden" name="post_id" value="<?=$post_id;?>">

    <button type="submit" name="save">Update Post</button>
</form>

<?php require $basePath . '/partials/footer.php';?>