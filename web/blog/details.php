<?php

include("./includes/config.php");

$post_id = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT);

require "./includes/dbconnect.php";

$db = get_db();

$statement = $db->prepare('SELECT * FROM posts WHERE id = :id');

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
		$body = $row['body'];
		
        echo "<p><a href='index.php?post=$body'><strong>$body</strong></a><p>";
    }

?>


</div>

    <?php include("includes/footer.php");?>
</body>
</html>