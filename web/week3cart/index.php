<?php
// Report All PHP Errors
error_reporting(E_ALL);

// Session start
session_start();

// Currency symbol, you can change it
$currency = "$";

$msg = "";
$v = "1.0";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Week 3 PHP Shopping Cart">
    <meta name="author" content="Wayne Herridge">

    <title>PHP Shopping Cart</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

	<script language="Javascript">
	<!-- Allows only numeric chars -->
	function isNumberKey(evt)
	{
		var charCode=(evt.which)?evt.which:event.keyCode
		if(charCode>31&&(charCode<48||charCode>57))
		return false;return true;
	}
	</script>

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

    <div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">PHP Shopping Cart</a>

        </div>
        <div class="collapse navbar-collapse">
		<li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-8">
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

			<!-- Products List W/Thumbs -->
			<div class="row">
				<!-- Product 1 -->
				<div class="col-xs-6 col-md-3">
					<div class="thumbnail text-center">
						<img src="https://placehold.it/150x150" class="img-responsive" alt="One Shoe">
						<div class="caption text-center">
							<h3>One Shoe</h3>
							<span class="label label-warning">2.10 <?php echo $currency;?></span>
						</div>
						<form action="?" method="post">
							<div class = "input-group">
							<input class="form-control" name="quantity" type="text" onkeypress="return isNumberKey(event)" maxlength="2" value="1">
							<span class = "input-group-btn"><input type="submit" class="btn btn-success" type="button" value="Add To Basket"></span>
							</div>
							<input type="hidden" name="item" value="One Shoe" />
							<input type="hidden" name="price" value="2.10" />
						</form>
					</div>
				</div>
				<!-- Product 2 -->
				<div class="col-xs-6 col-md-3">
					<div class="thumbnail text-center">
						<img src="https://placehold.it/150x150" class="img-responsive" alt="Second Shoe">
						<div class="caption text-center">
							<h3>Second Shoe</h3>
							<span class="label label-warning">2.20 <?php echo $currency;?></span>
						</div>
						<form action="?" method="post">
							<div class = "input-group">
							<input class="form-control" name="quantity" type="text" onkeypress="return isNumberKey(event)" maxlength="2" value="1">
							<span class = "input-group-btn"><input type="submit" class="btn btn-success" type="button" value="Add To Basket"></span>
							</div>
							<input type="hidden" name="item" value="Second Shoe" />
							<input type="hidden" name="price" value="2.20" />
						</form>
					</div>
				</div>
				<!-- Product 3 -->
				<div class="col-xs-6 col-md-3">
					<div class="thumbnail text-center">
						<img src="https://placehold.it/150x150" class="img-responsive" alt="Piece of Paper">
						<div class="caption text-center">
							<h3>Piece of Paper</h3>
							<span class="label label-warning">2.30 <?php echo $currency;?></span>
						</div>
						<form action="?" method="post">
							<div class = "input-group">
							<input class="form-control" name="quantity" type="text" onkeypress="return isNumberKey(event)" maxlength="2" value="1">
							<span class = "input-group-btn"><input type="submit" class="btn btn-success" type="button" value="Add To Basket"></span>
							</div>
							<input type="hidden" name="item" value="Piece of Paper" />
							<input type="hidden" name="price" value="2.30" />
						</form>
					</div>
				</div>
				<!-- Product 4 -->
				<div class="col-xs-6 col-md-3">
					<div class="thumbnail text-center">
						<img src="https://placehold.it/150x150" class="img-responsive" alt="Used Eraser">
						<div class="caption text-center">
							<h3>Used Eraser</h3>
							<span class="label label-warning">2.40 <?php echo $currency;?></span>
						</div>
						<form action="?" method="post">
							<div class = "input-group">
							<input class="form-control" name="quantity" type="text" onkeypress="return isNumberKey(event)" maxlength="2" value="1">
							<span class = "input-group-btn"><input type="submit" class="btn btn-success" type="button" value="Add To Basket"></span>
							</div>
							<input type="hidden" name="item" value="Used Eraser" />
							<input type="hidden" name="price" value="2.40" />
						</form>
					</div>
				</div>
			</div>
          </div><!--/row-->
        </div><!--/span-->

        <div class="col-xs-6 col-sm-4" id="sidebar" role="navigation">
          <div class="sidebar-nav">
			<?php
			// If cart is empty
			if (!isset($_SESSION['cart']) || (count($_SESSION['cart']) == 0)) {
			?>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</h3>
				  </div>
				  <div class="panel-body">Your cart is empty..</div>
				</div>
			<?php
			// If cart is not empty
			} else {
			?>
				<div class="panel panel-default">
					<div class="panel-heading" style="margin-bottom:0;">
						<h3 class="panel-title"><span class="glyphicon glyphicon-shopping-cart"></span> My Cart</h3>
					</div>
					<div class="table-responsive">
					<table class="table">
						<tr class="tableactive"><th>Product</th><th>Price</th><th>Qty.</th><th>Tot.</th></tr>
						<?php
						// List cart items
						// We store order detail in HTML
						$OrderDetail = '
						<table border=1 cellpadding=8 cellspacing=8>
							<thead>
								<tr>
									<th>Product</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>';

						// Equal total to 0
						$total = 0;

						// For finding session elements line number
						$linenumber = 0;

						// Run loop for cart array
						foreach($_SESSION['cart'] as $item)
						{
							// Don't list items with 0 qty
							if($item['quantity']!=0) {

							// For calculating total values with decimals
							$pricedecimal = str_replace(",",".",$item['unitprice']);
							$qtydecimal = str_replace(",",".",$item['quantity']);

							$pricedecimal = (float)$pricedecimal;
							$qtydecimal = (float)$qtydecimal;
							$qtydecimaltotal = $qtydecimaltotal + $qtydecimal;

							$totaldecimal = $pricedecimal*$qtydecimal;

							// We store order detail in HTML
							$OrderDetail .= "<tr><td>".$item['item']."</td><td>".$item['unitprice']." ".$currency."</td><td>".$item['quantity']."</td><td>".$totaldecimal." ".$currency."</td></tr>";

							// Write cart to screen
							echo
							"
							<tr class='tablerow'>
								<td><a href=\"?remove=".$linenumber."\" class=\"btn btn-danger btn-xs\" onclick=\"return confirm('Are you sure?')\">X</a> ".$item['item']."</td>
								<td>".$item['unitprice']." ".$currency."</td>
								<td>".$item['quantity']."</td>
								<td>".$totaldecimal." ".$currency."</td>
							</tr>
							";

							// Total
							$total += $totaldecimal;

							}
							$linenumber++;
						}

						// We store order detail in HTML
						$OrderDetail .= "<tr><td>Total</td><td></td><td></td><td>".$total." ".$currency."</td></tr></tbody></table>";

						?>
						<tr class='tableactive'>
							<td><a href='?clear' class='btn btn-danger btn-xs' onclick="return confirm('Are you sure?')">Empty Cart</a></td>
							<td><a href='?cart' class='btn btn-danger btn-xs' onclick="return confirm('Are you sure?')">View Cart</a></td>
							<td class='text-right'>Total</td>
							<td><?php echo $qtydecimaltotal;?></td>
							<td><?php echo $total;?> <?php echo $currency;?></td>
						</tr>
					</table>
					</div>
				</div>
				<!-- // Cart -->

				<!-- Address -->
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-phone-alt"></span> Address</h3>
				  </div>
				  <div class="panel-body">
					<form role="form" method="post" action="?pay">
					  <div class="form-group">
						<label for="inputEmail1">Name</label>
						<div>
						  <input type="text" name="name" class="form-control" id="inputEmail1" placeholder="Name">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputEmail2">Email</label>
						<div>
						  <input type="email" name="email" class="form-control" id="inputEmail2" placeholder="mail@domain.com">
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputEmail3">Phone</label>
						<div>
						  <input type="text" name="phone" class="form-control" id="inputEmail3" placeholder="Phone" onkeypress="return isNumberKey(event)" >
						</div>
					  </div>
					  <div class="form-group">
						<label for="inputEmail4">Address</label>
						<div>
						  <textarea class="form-control" name="address" id="inputEmail4" style="height:50px;"></textarea>
						</div>
					  </div>
					  <div class="form-group">
						<label for="optionsRadios1">Payment</label>
						<div style="margin-top: 6px;">
							<select class="form-control selectEleman" name="payment">
							  <option value="Credit Card">Credit Card</option>
							  <option value="Debit Card">Debit Card</option>
							  <option value="PayPal">PayPal</option>

							</select>
						</div>
					  </div>
					  <div class="form-group">
						<div>
						  <button type="submit" class="btn btn-success pull-right">Send Order</button>
						  <button type="submit" class="btn btn-success pull-right">Continue Shopping</button>
						</div>
					  </div>
					<input type="hidden" name="total" value="<?php echo $total;?>">
					<input type="hidden" name="OrderDetail" value="<?php echo htmlentities($OrderDetail);?>">
					</form>
				  </div>
				</div>
			<?php } # End Cart Listing ?>
          </div><!--/.well -->
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
			<p>&copy; <?php echo date("Y"); ?> Wayne Herridge</p>
      </footer>

    </div><!--/.container-->

	<div id="modal-cart" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<p class="text-center" id="myDialogText"></p>
				</div>
			</div>
		</div>
	</div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
	<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<?php if($msg != "") { echo $msg; } ?>

  </body>
</html>