<?php

include("config.php");

$post_id = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT);

require "dbConnect.php";

$db = get_db();

$statement = $db->prepare('SELECT * FROM posts WHERE post_id = :id');

$statement->execute([':id' => $post_id]);

$blogposts = $statement->fetchAll(PDO::FETCH_ASSOC);
    
$statement->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head.php");?>
</head>

<body>
<header>
        <?php include("includes/header.php"); ?>
</header>
    
<div class="container" id="main-content">
	<h2>Blog Details</h2>
    
<?php
    foreach ($blogposts as $row)
    {
        
        echo "<h3><strong>{$row['title']}</strong></h3>";
        echo "<p><strong>{$row['body']}</strong><p>";
        echo "<p><strong>{$row['pdate']}</strong><p>";

        echo "<p><a href='index.php'>Back to Posts</a><p>";
    }

?>


</div>

    <?php include("includes/footer.php");?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>