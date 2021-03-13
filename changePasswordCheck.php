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
	
	$servername='localhost';
	$username="root";
	$db="restaurant";
	$rootPassword="";
	
	$conn = new mysqli($servername, $username, $rootPassword, $db);
	
	$username = $_SESSION['username'];
	$hashedusername = $_SESSION['husername'];
	$password = $_POST['oldPassword'];
	$ID = $_SESSION["ID"];	
		

	if ($conn -> connect_error){
		die("Connectivity failed, sorry lads: " . $conn->connect_error);
	}
	
	$userQuery = "SELECT * FROM customer";
	$userResult = $conn-> query($userQuery);
	
	echo "<table border='1'>";
	
	$useraccess=false;
	$userQuery = "SELECT password FROM customer WHERE username = ?";
	if ($stmt = $conn->prepare($userQuery)){
		$stmt->bind_param("s",$hashedusername);
		$stmt->execute();
		$stmt->bind_result($foundpassword);
		while($stmt->fetch()){
			if ( password_verify($password, $foundpassword)){
				$useraccess=true;
		}
		}
	}
	
	$newpassword = password_hash($_POST["newPassword"],PASSWORD_DEFAULT);
	if ($useraccess === true){
		$userQuery = "UPDATE customer SET password = ? WHERE username=?";
		if ($stmt = $conn->prepare($userQuery)){
		$stmt->bind_param("ss",$newpassword ,$hashedusername);
		$stmt->execute();
		echo 'Password successfully changed';
		echo "<form action='complexLoginForm.php' method='POST'>";
		echo "<br /><input type='submit' value='Back'>";
		echo "</form>";
	}}
	else{
		echo 'Password could not be changed';
		echo "<form action='changePasswordForm.php' method='POST'>";
		echo "<br /><input type='submit' value='Try again'>";
		echo "<input type='hidden' name='token' value=$token";
		echo "</form>";}}
	else {
	echo 'Invalid token';}
	

?>

