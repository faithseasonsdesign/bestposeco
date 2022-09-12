<?php
	
	session_start();
	require("connection.php");
	
	$_SESSION['pId'] = "";
	
	$adminPortalUsername = $_SESSION['username'];
	
	//access the admin information
	$sql = "SELECT * FROM $tblNameTwo WHERE email = '$adminPortalUsername';";
	$query = mysqli_query($connection,$sql);
	$results = mysqli_num_rows($query);
	if($results>0){
		while($admin = mysqli_fetch_assoc($query)){
			$adminName = $admin['fullname'];
		}
	}
	else{
		echo("<script>alert('failed to retrieve the admin info')</script>");
	}
	//fetchProducts
	$productSql = "SELECT * FROM $tblNameOne";
	$productQuery = mysqli_query($connection,$productSql);
	$productResults = mysqli_num_rows($productQuery);
	$numOfProducts = "";
	if($productResults<0){
		$numOfProducts = "You have $productResults Products ";
	}
	else{
		$numOfProducts = "You have $productResults products in your store ";
	}
	
	if(isset($_POST['editBtn'])){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			header( "refresh:0;url=http://localhost//best//editProduct.php" );
			$_SESSION['pId'] = $_POST['pId'];
			echo($_POST['pId']);			
		}
	}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<title>Admin : <?php echo($adminName) ?></title>
  </head>
  <body>
    
	<!--coding for the navigation bar start here-->
	<div class="navigation-wrapper container-fluid">
		<div class="container d-flex align-items-center inner-nav-wrapper">
			<div class="container logo-wrapper">
				<img alt="best pos solutions logo" src="images/best.png" class="img-fluid mx-auto logo" height="20"/>
			</div>
			<div class="container-fluid d-flex flex-column flex-sm-column flex-md-row align-items-center justify-content-center justify-content-sm-center justify-content-md-end nav-items-wrapper text-white">
				<li class="d-block">
					<a href="index.html" class="text-white">Home</a>
				</li>
				<li class="d-block">
					<a href="addProducts.php" class="text-white">Add Product</a>
				</li>
				<li class="d-block">
					<a href="login.php" class="text-white">Login</a>
				</li>
				<li class="d-block">
					<a href="#" class="text-white">Logout</a>
				</li>
			</div>
		</div>
	</div>
	<!--coding for the navigation bar ended here-->
	
	
	<!--employee section start here-->
	<div class="employee-section contanainer-fluid employee-bg-img bg-image">
		<div class="employee-child-section employee-mask py-5 d-flex align-items-center flex-column" style="position:relative">
			<h1 class="text-white">
				Welcome back <?php echo($adminName) ?>
			</h1>
			<h3 class="text-white">
				<?php echo($numOfProducts) ?>
			</h3>
			<!--load all the products in here-->
			
		</div>
	</div>
	<!--employee section ended here-->
	
	<!--products section coding start here-->
	<div class="products-section container-fluid">
		<div class="container products-child-section py-5">
			<div class="products-content py-5">
				<div class="row mt-4 product-row">
					<?php
						$productSql = "SELECT * FROM $tblNameOne";
						$productQuery = mysqli_query($connection,$productSql);
						$productResults = mysqli_num_rows($productQuery);
						if($productResults>0){
							while($product = mysqli_fetch_assoc($productQuery)){
								$productImage = $product['productImage'];
					?>
						<div class="col-12 col-sm-12 col-md-12 col-lg-4">
							<div class="card d-flex h-100">
								<div class="card-body text-center">
									<img src="<?php echo($productImage)?>" class="img-fluid mx-auto" alt="" />
									<h4 class="text-center"><?php echo($product['productName']) ?></h4>
									<h4 style="font-weight:800" class="text-center">
										<?php echo($product['productPrice']) ?>
									</h4>
								</div>
								<form class="text-center py-3" action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">
									<input name="pId" type="hidden" value="<?php echo($product['productId']) ?>" />
									<input type="submit" value="Edit" name="editBtn"  class="btn btn-lg text-white px-4" style="font-weight:700;background-color:#0049d5;border-radius:0px !important" />
								</form>
							</div>
						</div>
					<?php
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<!--products section coding ended here-->
	
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	<script src="js/style.js"></script>
  </body>
</html>