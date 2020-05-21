<?php

include("./includes/config.php");

$searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
echo $searchTerm;

require "./includes/dbconnect.php";
$db = get_db();

if (!empty($searchTerm)) {
    //$statement = $db->prepare("SELECT * FROM posts WHERE title LIKE '%:searchTerm%'");
    //$statement->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $statement = $db->prepare("SELECT * FROM posts WHERE title LIKE '%te%'");
} else {
    $statement = $db->prepare("SELECT title FROM posts");
}
	$blogposts = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $statement->execute();
	$statement->closeCursor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("./includes/head.php");?>
</head>

<body>
<header>
        <?php include("./includes/header.php"); ?>
</header>
    
<div class="container" id="main-content">
	<h2>Blog Posts</h2>
	
	<form action="index.php" method="GET">
    <input type="text" name="search">
    <button type="submit">Submit</button>
    </form>

<?php

echo $blogposts;

// Go through each result
foreach ($blogposts as $row)
    {
		$title = $row['title'];
		
        echo "<p><strong>$title</strong><p>";
    }

?>

</div>

    <?php include("./includes/footer.php");?>
</body>
</html>