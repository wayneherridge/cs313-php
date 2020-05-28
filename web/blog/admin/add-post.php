<?php 

include("includes/config.php");

require "./includes/dbconnect.php";
$db = get_db();

$query = "INSERT INTO posts VALUES ('$_POST[pdate]','$_POST[title]',
'$_POST[body]')";
$result = pg_query($query); 

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
	<h2>Add Post</h2>

    <form action="add-post.php" method="post"> 
    <label id="first"> Post Date:</label><br/>
    <input type="date" name="pdate"><br/>

    <label id="first">Post Title:</label><br/>
    <input type="text" name="title"><br/>

    <label id="first">Post Content:</label><br/>
    <input type="text" name="body"><br/>

    <button type="submit" name="save">Add Post</button>

</form>

</div>

    <?php include("includes/footer.php");?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>