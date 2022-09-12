<?php


	session_start();
	//$_SESSION['username'] = "";
	
	require("connection.php");
	
	function protected_data($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	
	$adminUsername = ""; $usernameError = "";
	$adminPassword = ""; $passwordError = "";
	$errorMsg = "";
	$formColor = "";
	$formDisplay = "";
	
	$productName = "";
	$productPrice = "";
	$productAvailability = "";
	
	
	if(isset($_POST['addBtn'])){
		if($_SERVER['REQUEST_METHOD']== 'POST'){
			
			$productName = protected_data($_POST['productName']);
			$productPrice = protected_data($_POST['productPrice']);
			$productAvailability = protected_data($_POST['productAvailability']);
			
			//image info start
			$fileOne  = $_FILES['imageOne'];
			$fileOneName = $_FILES['imageOne']["name"];
			$fileOneTmpName = $_FILES['imageOne']["tmp_name"];
			$fileOneType = $_FILES['imageOne']["type"];
			
			$fileOneExt = explode(".",$fileOneName);
			$fileOneActualExt =strtolower(end($fileOneExt));
			
			$allowedExtensions = array("jpg","jpeg","png");
			
			//images info ended
			
			if(!empty($fileOneName)){
				//you choose an image
				
				if(in_array($fileOneActualExt,$allowedExtensions)){
					//echo("dope the file is allowed<br>");
					//image one
					$imageOneNewName = uniqid('',true)."." . $fileOneActualExt;
					$fileOneDestination = 'uploads/' ."$imageOneNewName";				
					//check if we uploaded image successfuly
					if(move_uploaded_file($fileOneTmpName,$fileOneDestination)){
						$errorMsg = "uploaded images successfuly";
						$formColor = "bg-success";
						
						//upload to the database
						
						$imageOne = protected_data($fileOneDestination);
						
						$sql = "INSERT INTO $tblNameOne(productName,productPrice,productImage,productAvailability) VALUES('$productName','$productPrice','$imageOne','$productAvailability');";
						$query = mysqli_query($connection,$sql);
						//$results = mysqli_num_rows($query);
						if($query){
							header( "refresh:1;url=http://localhost//best//adminPortal.php" );
							echo("product update successfuly redirecting you<br>");
						}
						else{
							//failed to upload
							echo("failed to upload the product<br>");
						}
					}
					else{
						//failed to upload the image
						echo("failed to upload the image<br>");
					}
				}
				else{
					echo("only jpg jpeg and png files allowed <br>");
				}
				
			}
			else{
				echo("please make sure you chose images for all the fields<br>");
			}			
			//uploading of images ended
			
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
    <title>BEST POS SOLUTIONS</title>
	<title>Login</title>
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
					<a href="adminPortal.php" class="text-white">Admin portal</a>
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
			<!--form error message-->
			<div class="col-12 col-sm-12 col-md-4 text-white <?php echo($formColor) ?> py-3">
				<h6><?php echo($errorMsg) ?></h6>
				
			</div>
			<!--form error message-->
			<div class="employee-content container d-flex justify-content-center">
				<form enctype="multipart/form-data" style="background-image: linear-gradient(to left, #10A3D4 , #0049d5 , #004ee5 , #10A3D4);" class="col-12 col-sm-12 col-md-4 py-5 d-flex flex-column" action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">
					<h2 class="text-white text-center">Add Product</h2>
					<input value="<?php echo($productName) ?>" type="text" name="productName" placeholder="product name" class="py-3 mt-2 text-center" required />
					<input value="<?php echo($productPrice) ?>" type="text" name="productPrice" placeholder="product price" class="py-3 mt-2 text-center" required />
					<input value="<?php echo($productAvailability) ?>" type="text" name="productAvailability" placeholder="product availability" class="py-3 mt-2 text-center" required />
					<h4 class="text-white text-center mt-3">
						Product Image
					</h4>
					<input class="mt-3 text-center" type="file" name="imageOne" value="" />
					<button type="submit" class="btn btn-md mt-3 text-white py-3 font-weight-bold" style="background-color:black" name="addBtn">
						Add Product
					</button>
				</form>
			</div>
		</div>
	</div>
	<!--employee section ended here-->
	
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	<script src="js/style.js"></script>
  </body>
</html>