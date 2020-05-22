<?php

include("./includes/config.php");

$searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

require "./includes/dbconnect.php";
$db = get_db();

if (!empty($searchTerm)) {
    $statement = $db->prepare('SELECT * FROM posts WHERE title LIKE ?');
    //$statement->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $statement->execute(array('%'.$searchTerm.'%'));
} else {
    $statement = $db->prepare("SELECT * FROM posts");
    $statement->execute();
}

    //$statement->execute();
	$blogposts = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();
    
    $date = DateTime::createFromFormat('Y-m-d', $_POST['pdate']);
    $pdate_new = $date->format('m-d-Y');

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

<?php

// Go through each result
foreach ($blogposts as $row)
    {	

        echo "<p><a href='details.php?post={$row['post_id']}'><strong>{$row['title']}</strong></a><p>";
        echo "<p>{$row['pdate']}<p>";

    }

?>

</div>

    <?php include("./includes/footer.php");?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>