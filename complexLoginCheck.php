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
	
	// Create connection
	$conn = new mysqli($servername, $username, $rootPassword, $db);
	
	// Values come from user entry in webform
	$username = $_POST['txtUsername'];
	$hashedusername = hash('sha256',$username);
	$password = $_POST['txtPassword'];
	$_SESSION['user'] = $username;
	$_SESSION['password'] = $password;
	$_SESSION['huser'] = $hashedusername;
	
	//Check connection
	if ($conn -> connect_error){
		die("Connectivity failed, sorry lads: " . $conn->connect_error);
	}
	
	$useraccess = false;
	$userQuery = "SELECT password FROM customer WHERE username = ?";
	
	if ($stmt = $conn->prepare($userQuery)){
		$stmt->bind_param("s",$hashedusername);
		$stmt->execute();
		$stmt->bind_result($foundpassword);
		while($stmt->fetch()){
			if ( password_verify($password, $foundpassword)){
				echo "Login Successful!";
				$useraccess=true;
		}
		}
	}
	
	if ($useraccess === true){
		$userQuery = "SELECT CustomerEmailAddress
				  FROM customer
				  WHERE username=?";
				  
		if ($stmt = $conn->prepare($userQuery)){
		$hashed = password_hash($password,PASSWORD_BCRYPT);
		$stmt->bind_param("s",$hashedusername);
		$stmt->execute();
		$stmt->bind_result($email);
		while($stmt->fetch()){
			$_SESSION['email']=$email;
		}
		echo "<form action='emailForm.php' method='POST'>";
		echo "<br /><input type='submit' value='Next'>";
		echo "<input type='hidden' name='token' value=$token";
		echo "</form>";
		
	}
	}
	else {
	echo 'Password or username not found';
	echo "<form action='complexLoginForm.php' method='POST'>";
	echo "<br /><input type='submit' value='Back'>";
	echo "</form>";
	}
	} else {
		echo 'Invalid token';
}

?>