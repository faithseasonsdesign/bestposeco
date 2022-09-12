<?php

	$hostname = "localhost";
	$username = "root";
	$password = "";
	$dbName = "bestpos";
	$tblNameOne = "products";
	$tblNameTwo = "admins";
	
	$connection = mysqli_connect($hostname,$username,$password,$dbName);
	
	if($connection){
		//echo("<script>alert('connection to the server and databases established successfuly')</script>");
	}
	else{
		echo("<script>alert('failed to establish connection to the server and database')</script>");
	}

?>