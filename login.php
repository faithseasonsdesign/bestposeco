<?php


	session_start();
	$_SESSION['username'] = "";
	
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
	
	if(isset($_POST['loginBtn'])){
		if($_SERVER['REQUEST_METHOD']=="POST"){
			$adminUsername = protected_data($_POST['username']);
			$adminPassword = protected_data($_POST['password']);
			
			if(empty($adminUsername) || empty($adminPassword)){
				//one of the input fields is empty 
				$formColor = "bg-danger";
				$errorMsg = "Please fill on the input fields";
				if(empty($adminUsername)){
					$usernameError = "you cannot leave the username input field empty";
				}
				if(empty($adminPassword)){
					$passwordError = "you cannot leave the password input field empty";
				}
			}
			else{
				//all inputs fields are filled check if the credentials are correct
				$sql = "SELECT * FROM $tblNameTwo WHERE email='$adminUsername' AND adminPassword='$adminPassword';";
				$query = mysqli_query($connection,$sql);
				$results = mysqli_num_rows($query);
				if($results>0){
					//user exist redirect them to another page
					header( "refresh:3;url=http://localhost//best//adminPortal.php" );
					$_SESSION['username'] = $adminUsername;
					$errorMsg = "re-directing you in 3 seconds";
					$formColor = "bg-success";
					
				}
				else{
					//the user does not exist so they cant log-in
					$errorMsg = "failed to log in please check if the credentials are correct";
					$formColor = "bg-danger";
				}
			}
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
					<a href="#" class="text-white">Products</a>
				</li>
				<li class="d-block">
					<a href="#" class="text-white">Pricing</a>
				</li>
				<li class="d-block">
					<a href="#" class="text-white">Rentals</a>
				</li>
				<li class="d-block">
					<a href="login.php" class="text-white">Login</a>
				</li>
				<li class="d-block">
					<a href="#" class="text-white">Contact</a>
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
				<form style="background-image: linear-gradient(to left, #10A3D4 , #0049d5 , #004ee5 , #10A3D4);" class="col-12 col-sm-12 col-md-4 py-5 d-flex flex-column" action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">
					<h2 class="text-white text-center">Login</h2>
					<input value="<?php echo($adminUsername) ?>" type="text" name="username" placeholder="username/email" class="py-3 mt-2 text-center" />
					<h6 class="text-white"><?php echo($usernameError) ?></h6>
					<input value="<?php echo($adminPassword) ?>" type="password" name="password" placeholder="username/email" class="py-3 mt-2 text-center" />
					<h6 class="text-white"><?php echo($passwordError) ?></h6>
					<button type="submit" class="btn btn-md mt-3 text-white py-3 font-weight-bold" style="background-color:black" name="loginBtn">
						Login
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