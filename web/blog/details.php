<?php

include("./includes/config.php");

$searchTerm = filter_input(INPUT_GET, 'post', FILTER_SANITIZE_STRING);

require "./includes/dbconnect.php";
$db = get_db();

if (isset($searchTerm)) {
    $statement = $db->prepare("SELECT * FROM posts WHERE title LIKE '%$searchTerm%'");
    //$statement->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
}
    $statement->execute();
	$blogposts = $statement->fetchAll(PDO::FETCH_ASSOC);
    
	$statement->closeCursor();

    echo $searchTerm;

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
    // foreach ($blogposts as $row)
    // {
    //     $body = $row['body'];
		
    //     echo "<p><a href='index.php'><strong>$body</strong></a><p>";
    // }

?>

</div>

    <?php include("includes/footer.php");?>
</body>
</html>