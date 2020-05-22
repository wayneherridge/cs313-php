<?php

include("./includes/config.php");

$post_id = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT);

require "./includes/dbconnect.php";

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
</body>
</html>