<?Php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Selected Items</title>
</head>
<body>
    <?Php
        $item=$_POST['item'];
        while (list ($key1,$val1) = @each ($item)) {
            //echo "$key1 , $val1,<br>";
            unset($_SESSION['cart'][$val1]);
        }

        echo "No. of Items in the cart = ".sizeof($_SESSION['cart'])." <br>";
        echo "<form method=post action=''>";
        while (list ($key, $val) = each ($_SESSION['cart'])) { 
        echo " <input type=checkbox name=item[] value='$key'>  $key -> $val <br>"; 
        }
        echo "<input type=submit value=Remove></form>";
    ?>
    
    <a href=cart.php>Cart adding</a> . <a href=show-cart.php>Display Items</a> .<a href=remove-items.php>Remove Item</a>
</body>
</html>