<?Php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empty Cart</title>
</head>
<body>
    <?Php
        while (list ($key, $val) = each ($_SESSION['cart'])) { 
            //echo "$key -> $val <br>"; 
            unset($_SESSION['cart'][$key]);
        }

        echo "No. of Items in the cart = ".sizeof($_SESSION['cart'])." <br>";

    ?>
</body>
</html>