<?php

include("./includes/config.php");

$searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

require "./includes/dbconnect.php";
$db = get_db();

if (!empty($searchTerm)) {
    $statement = $db->prepare("SELECT * FROM posts WHERE title LIKE '%:searchTerm%'");
    $statement->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
} else {
    $statement = $db->prepare("SELECT title FROM posts");
}
    $statement->execute();
	$blogposts = $statement->fetchAll(PDO::FETCH_ASSOC);
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
    <button type="submit">Search</button>
    </form>

<?php

// Go through each result
foreach ($blogposts as $row)
    {
		$title = $row['title'];
		
        echo "<p><a href='details.php?post=$title'><strong>$title</strong></a><p>";
    }

?>

</div>

    <?php include("./includes/footer.php");?>
</body>
</html>