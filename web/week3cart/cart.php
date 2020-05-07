<?php
    session_start();
    $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

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
        </div><!--/.well -->
    </div><!--/span-->
</div><!--/row-->            

</body>
</html>