<?php
session_start ();

$items = array (
        'A123' => array (
                'name' => 'Item1',
                'desc' => 'Item 1 description...',
                'price' => 1000 
        ),
        'B456' => array (
                'name' => 'Item40',
                'desc' => 'Item40 description...',
                'price' => 2500 
        ),
        'Z999' => array (
                'name' => 'Item999',
                'desc' => 'Item999 description...',
                'price' => 9999 
        ) 
);

if (! isset ( $_SESSION ['cart'] )) {
    $_SESSION ['cart'] = array ();
}

// Add
if (isset ( $_POST ["buy"] )) {
    // Check the item is not already in the cart
    if (!in_array($_POST ["buy"], $_SESSION['cart'])) {
        // Add new item to cart
        $_SESSION ['cart'][] = $_POST["buy"];
    }
} 

// Delete Item
else if (isset ( $_POST ['delete'] )) { // a remove button has been clicked
    // Remove the item from the cart
    if (false !== $key = array_search($_POST['delete'], $_SESSION['cart'])) {
        unset($_SESSION['cart'][$key]);
    }
} 

// Empty Cart
else if (isset ( $_POST ["delete"] )) { // remove item from cart
    unset ( $_SESSION ['cart'] );
}

?>
<form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
    <?php
        foreach ( $items as $ino => $item ) {
            $title = $item ['name'];
            $desc = $item ['desc'];
            $price = $item ['price'];

            echo " <p>$title</p>";
            echo " <p>$desc</p>";
            echo "<p>\$$price</p>";

            if ($_SESSION ['cart'] == $ino) {
                echo '<img src="carticon.png">';
                echo "<p><button type='submit' name='delete' value='$ino'>Remove</button></p>";
            } else {
                echo "<button type='submit' name='buy' value='$ino'>Buy</button> ";
            }
        }
    ?>
</form>

<?php
if (isset ( $_SESSION ["cart"] )) {
    ?>

<form action='(omitted link)'
target='_blank' method='post'
enctype='application/x-www-form-urlencoded'>
<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    <?php

    $total = 0;
    foreach ( $_SESSION ["cart"] as $i ) {
        ?>
    <tr>
        <td>
            <?php echo($_SESSION["cart"]); ?> <!--Item name-->
        </td>
        <td>price<?php echo($_SESSION["price"][$i] ); ?>
            <!--Item cost-->
        </td>
        <td><button type='submit' name='delete' value='$ino'>Remove</button>
            </p></td>
    </tr>
    <?php
        $total = + $_SESSION ["amounts"] [$i];
    }
    $_SESSION ["total"] = $total;
    ?>
    <tr>
        <td colspan="2">Total: $<?php echo($total); ?></td>
        <td><input type='submit' value='Checkout' /></td>
    </tr>
    <tr>
        <td><button type='submit' name='clear'>Clear cart</button></td>
    </tr>
</table>
</form>
<?php  } ?>