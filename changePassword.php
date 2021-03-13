<?php
	session_start();
	$servername='localhost';
	$username="root";
	$db="restaurant";
	$rootPassword="";
	
	// Create connection
	$conn = new mysqli($servername, $username, $rootPassword, $db);
	
	// Values come from user entry in webform
	$username = $_SESSION['user'];
	echo($username);
	$password = $_SESSION['password'];
	echo($password );
	$ID = $_SESSION["ID"];
	echo($ID);
	
	echo "<br />Old Password ";
	echo "<input name='oldPassword' type='password' />";
	echo "<br />Password   ";
	echo "<input name='newPassword' type='password' />";
	echo "<br /><input type='submit' value='Submit'>";
		
	//Check connection
	if ($conn -> connect_error){
		die("Connectivity failed, sorry lads: " . $conn->connect_error);
	}
	
	// query
	$userQuery = "SELECT * FROM customer";
	$userResult = $conn-> query($userQuery);
	
	echo "<table border='1'>";
	
	
	/*
    $result = mysqli_query($conn, "SELECT *from customer WHERE customer_ID='" . $_SESSION["ID"] . "'");
    $row = mysqli_fetch_array($result);
    if ($password == $row["Password"]) {
        mysqli_query($conn, "UPDATE customer set password='" . $_POST["newPassword"] . "' WHERE customer_ID='" . $_SESSION["ID"] . "'");
        echo ("Password Changed");
    } else{
        $message = "Current Password is not correct";
	}*/

?>

