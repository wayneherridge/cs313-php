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