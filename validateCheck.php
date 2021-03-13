<?php
	
	$servername='localhost';
	$username="root";
	$db="restaurant";
	$rootPassword="";
	
	// Create connection
	$conn = new mysqli($servername, $username, $rootPassword, $db);
	
	// Values come from user entry in webform
	$username = $_POST['txtUsername'];
	$hashedusername = hash('sha256',$username);
	$password = $_POST['txtPassword'];
	
	//Check connection
	if ($conn -> connect_error){
		die("Connectivity failed, sorry lads: " . $conn->connect_error);
	}
	
	$useraccess = false;
	$userQuery = "SELECT username FROM customer WHERE username = ?";
	
	if ($stmt = $conn->prepare($userQuery)){
		$stmt->bind_param("s",$hashedusername);
		$stmt->execute();
		$stmt->bind_result($foundpassword);
		while($stmt->fetch()){
			echo "Username taken";
		}
	}
	
	
	if (!preg_match("#[0-9]+#", $password)) {
        echo "Password must include at least one number!";
    }
    if (!preg_match("#[a-zA-Z]+#", $password)) {
        echo "Password must include at least one letter!";
    }
	
	
	
	
	


?>