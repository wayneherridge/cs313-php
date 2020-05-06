<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <?php
        $_SESSION['cart']=array();
        array_push($_SESSION['cart'],'apple','mango','banana');

        echo "No. of items in the cart = ".sizeof($_SESSION['cart'])." <a href=empty-cart.php>Empty Cart</a><br>";
        
    ?>
</body>
</html>