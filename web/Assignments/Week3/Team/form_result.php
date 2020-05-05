<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teach03</title>
</head>
<body>
<p>
    Name: <?php echo $_POST["name"] ?><br>
    Email: <a href=<?php echo "mailto:" .$_POST["email"] ?>><?php echo $_POST["email"] ?></a><br>
    Major: <?php echo $_POST["major"] ?><br>
    Comments:<br><?php echo $_POST["comments"] ?><br>
    Visited Places:
<ul>
    <?php
    $destinations = $_POST["visited"];
    foreach ($destinations as $destination) {
        $dest_clean = htmlspecialchars($destination);
        echo "<li><p>$dest_clean</p></li>";
    }
    ?>
</ul>
</p>
</body>
</html>