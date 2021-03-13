<?php
	session_start();
	
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	
	
	$servername='localhost';
	$username="root";
	$db="restaurant";
	$rootPassword="";
	
	$conn = new mysqli($servername, $username, $rootPassword, $db);
	
	$token = substr($_POST['token'], 0, -3);
	
	echo $token . '<br />';
	echo $_SESSION['token']. '<br />';
	echo strlen($token) . '<br />';
	echo strlen($_SESSION['token']) . '<br />';
	
	$useraccess = false;
	if (hash_equals($_SESSION['token'], $token)) {
		if (hash_equals($_POST['etoken'], $_SESSION['emailtoken'])){
			$useraccess = true;
		}
		else{
	       echo 'Code invalid';}
			
	
	if ($useraccess === true){
		$userQuery = "SELECT customer_ID, Customername, CustomerEmailAddress, DateOfBirth, Address 
				  FROM customer
				  WHERE username=?";
				  
		if ($stmt = $conn->prepare($userQuery)){
		$hashed = password_hash($_SESSION['password'],PASSWORD_BCRYPT);
		$stmt->bind_param("s",$_SESSION['husername']);
		$stmt->execute();
		$stmt->bind_result($id,$name,$email,$dob,$address);
		while($stmt->fetch()){
			$_SESSION['ID'] = $id;
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			$_SESSION['dob'] = $dob;
			$_SESSION['address'] = $address;
			
			header('Location: profilePage.php');
			
			}
	}
	echo 'end';
	}}
	 else {
		echo 'Invalid token';
	}


?>