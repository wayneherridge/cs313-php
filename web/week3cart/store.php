<?php
    $currency = "$";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Week 3 - PHP Shopping Cart">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>PHP Shopping Cart</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/pricing/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/pricing.css" rel="stylesheet">
  </head>

  <body>

<?php
  // Add item to cart
	if (empty($_POST['item']) || empty($_POST['price']) || empty($_POST['quantity']))
	{ } else {

		# Take values
		$price = $_POST['price'];
		$item = $_POST['item'];
		$quantity = $_POST['quantity'];
		$uniquid = rand();
		$exist = false;
		$count = 0;
		// If SESSION Generated?
		if($_SESSION['cart']!="")
		{
			// Look for item
			foreach($_SESSION['cart'] as $product)
			{
				// Yes we found it
				if($item == $product['item']) {
					$exist = true;
					break;
				}
				$count++;
			}
		}
		// If we found same item
		if($exist)
		{
			// Update quantity
			$_SESSION['cart'][$count]['quantity'] += $quantity;
			// Write down the message and then we open in modal at the bottom
			$msg = "
			<script type=\"text/javascript\">
				$(document).ready(function(){
					$('#myDialogText').text('".$item." quantity updated..');
					$('#modal-cart').modal('show');
				});
			</script>
			";

		} else {

			// If item not found, insert new item
			$mycartrow = array(
				'item' => $item,
				'unitprice' => $price,
				'quantity' => $quantity,
				'id' => $uniquid
			);

			// If session does not exist, create one
			if (!isset($_SESSION['cart']))
				$_SESSION['cart'] = array();

			// Add item to cart
			$_SESSION['cart'][] = $mycartrow;

			// Write down the message and then we open in modal at the bottom
			$msg = "
			<script type=\"text/javascript\">
				$(document).ready(function(){
					$('#myDialogText').text('".$item." added to your cart');
					$('#modal-cart').modal('show');
				});
			</script>
			";

		}
	}

	// Clear cart
	if(isset($_GET["clear"]))
	{
		session_unset();
		session_destroy();
		$msg = "
		<script type=\"text/javascript\">
			$(document).ready(function(){
				$('#myDialogText').text('Your cart is empty now..');
				$('#modal-cart').modal('show');
			});
		</script>
		";
	}

	// Remove item from cart (Updating quantity to 0)
	$remove = isset($_GET['remove']) ? $_GET['remove'] : '';
	if($remove!="")
	{
		$_SESSION['cart'][$_GET["remove"]]['quantity'] = 0;
	}
	?>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal">PHP Shopping Cart</h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="store.php">Browse Items</a>
        <a class="p-2 text-dark" href="cart.php">View Cart</a>
      </nav>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">My PHP Store</h1>
      <p class="lead">Choose what you would like to purchase</p>
    </div>


<div class="container">
<div class="row">
    <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</button>
          </p>

          <div class="col-sm-13">
			<?php if(isset($_GET["pay"])) { ?>
			<div class="panel panel-success">
			  <div class="panel-heading"><span class="glyphicon glyphicon-shopping-cart"></span> Well done!</div>
			  <div class="panel-body">
				Payment options for <b><?php echo $_POST["payment"];?>
				<br><br>
				<b>Order Details</b>
				<br><br>
				<?php echo $_POST["OrderDetail"];?>
			  </div>
			</div>
			<?php } ?>

      <div class="card-deck mb-3 text-center">
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">Red Shoes</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><?php echo $currency;?>20</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Size  : UK 6</li>
              <li>Color : Red</li>
            </ul>
            <form action="?" method="post">
				<div class = "input-group">
				    <input class="form-control" name="quantity" type="text" onkeypress="return isNumberKey(event)" maxlength="2" value="1">
				    <span class = "input-group-btn"><input type="submit" class="btn btn-success" type="button" value="Add To Basket"></span>
				</div>
					<input type="hidden" name="item" value="Red Shoes" />
					<input type="hidden" name="price" value="20.00" />
			</form>
          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">iPhone 20</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><?php echo $currency;?>5000</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Cameras : 20</li>
              <li>Zoom    : 30x</li>
            </ul>
            <form action="?" method="post">
				<div class = "input-group">
				    <input class="form-control" name="quantity" type="text" onkeypress="return isNumberKey(event)" maxlength="2" value="1">
				    <span class = "input-group-btn"><input type="submit" class="btn btn-success" type="button" value="Add To Basket"></span>
				</div>
					<input type="hidden" name="item" value="iPhone 20" />
					<input type="hidden" name="price" value="5000.00" />
			</form>          </div>
        </div>
        <div class="card mb-4 box-shadow">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal">VE Day Coin</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title"><?php echo $currency;?>100</h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Size  : British 50 pence</li>
              <li>Value : $100</li>
            </ul>
            <form action="?" method="post">
				<div class = "input-group">
				    <input class="form-control" name="quantity" type="text" onkeypress="return isNumberKey(event)" maxlength="2" value="1">
				    <span class = "input-group-btn"><input type="submit" class="btn btn-success" type="button" value="Add To Basket"></span>
				</div>
					<input type="hidden" name="item" value="VE Day Coin" />
					<input type="hidden" name="price" value="100.00" />
			</form>          </div>
        </div>
      </div>

      <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
          <div class="col-12 col-md">
            <small class="d-block mb-3 text-muted">Wayne Herridge</small>
            <small class="d-block mb-3 text-muted">&copy; 2020</small>
          </div>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
</div>
</div>
  </body>
</html>
