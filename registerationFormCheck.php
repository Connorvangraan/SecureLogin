<?php
	session_start();
	
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	
	$token = substr($_POST['token'], 0, -6);
	
	if (hash_equals($_SESSION['token'], $token)) {
		if (hash_equals($_POST['etoken'], $_SESSION['emailtoken'])){
			$useraccess = true;
		}
			
	
	if ($useraccess === true){
		$servername = "localhost";
		$rootuser="root";
		$db="restaurant";
		$rootpassword ="";
		$conn = new mysqli($servername, $rootuser, $rootpassword, $db);
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$hashedusername = $_SESSION['husername'];
		$name = $_SESSION['name'];
		$email = $_SESSION['email']; 
		$dob  = $_SESSION['dob'];
		$address = $_SESSION['address'];
		$userpassword = $_SESSION['password']; 
		$encryptedpassword = password_hash($userpassword,PASSWORD_BCRYPT); #,['cost'=>8]

		$userQuery = "INSERT INTO customer (Username, Password, CustomerName, CustomerEmailAddress, DateOfBirth, Address) Values('$hashedusername', '$encryptedpassword', '$name', '$email', '$dob', '$address')";

		if ($conn->query($userQuery) == TRUE){
			echo "Registration Successful";
			echo "<form action='complexLoginForm.php' method='POST'>";
			echo "<br /><input type='submit' value='Back'>";
			echo "</form>";}
		else{
			echo "Registration Failed";}
	}
	else {
		echo 'Invalid token';
	}}
	else{
		echo 'Invalid Verification Code';
	}
	






 


?>

