<?php
/**********************************************************
* File: viewScriptures.php
***********************************************************/

$searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

require "dbConnect.php";
$db = get_db();

if (!empty($searchTerm)) {
    $statement = $db->prepare('SELECT * FROM scripture WHERE content LIKE ?');
    $statement->execute(array('%'.$searchTerm.'%'));
} else {
    $statement = $db->prepare("SELECT book, chapter, verse, content FROM scripture");
	$statement->execute();
}
	$scriptures = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->closeCursor();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Scripture List</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand navbar-light" href="index.php">Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link <?php if ($CURRENT_PAGE == "Index") {?>active<?php }?>" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
	  <li class="nav-item active">
        <a class="nav-link <?php if ($CURRENT_PAGE == "About") {?>active<?php }?>" href="showTopics.php">Show Topics </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link <?php if ($CURRENT_PAGE == "About") {?>active<?php }?>" href="topicEntry.php">Topic Entry </a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="index.php" method="GET">
      <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<div>

<h1>Scripture Resources</h1>

<?php



foreach ($scriptures as $row)
    {

	$book = $row['book'];
	$chapter = $row['chapter'];
	$verse = $row['verse'];
	$content = $row['content'];

	echo "<p><strong>$book $chapter:$verse</strong> - \"$content\"<p>";
}

?>

</div>

	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>