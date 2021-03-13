<?php
	session_start();
	
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	
	if (isset($_SESSION['temptoken'])){
	$token = $_SESSION['temptoken'];
	echo $token;}
	else{
	$token = substr($_POST['token'], 0, -6);}
	
	if (hash_equals($_SESSION['token'], $token)) {
	$username = $_SESSION['user'];
	$id = $_SESSION['ID'];
	$name = $_SESSION['name'];
	$email = $_SESSION['email'];
	$dob = $_SESSION['dob'];
	$address = $_SESSION['address'];
	
	echo "User details";
	echo '<br> Username: ' . $username . '</br>';
	echo '<br> ID: ' . $id . '</br>';
	echo '<br> Name:' . $name . '</br>';
	echo '<br> Email:' . $email . '</br>';
	echo '<br> Date of Birth: ' . $dob . '</br>';
	echo '<br> Address: ' . $address . '</br>';
	echo "<form action='profilePage.php' method='POST'>";
	echo "<br /><input type='submit' value='Back'>";
	echo "</form>";
	} else{
	echo 'Invalid token';}
?>