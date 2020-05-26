<?php
    $searchTerm = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);

    require "connectdb.php";
    $db = get_db();

    if (!empty($searchTerm)) {
        $statement = $db->prepare("SELECT * FROM scripture WHERE book LIKE '%:searchTerm%'");
        $statement->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
    } else {
        $statement = $db->prepare("SELECT * FROM scripture");
    }
    $scriptures = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement->execute();
    $statement->closeCursor();

    // $scriptures = $db->query('SELECT * FROM scripture');

?>

<!DOCTYPE html>
<html>
    <head>
	    <title>Scripture List</title>
    </head>
<body>
    <div>
        <h1>Scripture Resources</h1>

    <form action="scriptureView.php" method="GET">
    <input type="text" name="searchTerm">
    <button type="submit">Submit</button>
    </form>
<?php
    var_dump($scriptures);

// Go through each result
    foreach ($scriptures as $row)
    {
	    $book = $row['book'];
	    $chapter = $row['chapter'];
	    $verse = $row['verse'];
	    $content = $row['content'];

        echo "<p>
        <strong>$book $chapter:$verse</strong> - \"$content\"
        <p>";
    }
?>
    </div>
</body>
</html>