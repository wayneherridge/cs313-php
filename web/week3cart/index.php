<?Php
echo "<br><br><br><a href=cart.php>Cart with Products after adding</a> . <a href=cart-display.php>Display Items</a> . <a href=cart-remove.php>Remove Item by Selection</a> . <a href=cart-remove-all.php>Remove all Items</a> . <a href=cart-add.php>Add Product by User</a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.php">Store</a></li>
            <li><a href="cart.php">View Cart</a></li>
        </ul>
    </nav>

<main>
    <?Php
        //$_SESSION['cart']=array(); // Declaring session array
        $_SESSION['cart']=array(array("product"=>"apple","quantity"=>2),
        array("product"=>"Orange","quantity"=>4),
        array("product"=>"Banana","quantity"=>5),
        array("product"=>"Mango","quantity"=>7),
        ); 
        //$_SESSION['cart'][]=$a;

        //array_push($_SESSION['cart'],$a); // Items added to cart

        echo "Number of Items in the cart = ".sizeof($_SESSION['cart']);
        require 'menu.php';
    ?>
    </main>
</body>
</html>