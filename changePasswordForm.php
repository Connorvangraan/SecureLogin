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
	$token = $_SESSION['temptoken'];}
	else{
	$token = substr($_POST['token'], 0, -6);}
	
	if (hash_equals($_SESSION['token'], $token)) {

	
	// Use HTTP Strict Transport Security to force client to use secure connections only
	$use_sts = true;

	// iis sets HTTPS to 'off' for non-SSL requests
	if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($use_sts) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    // we are in cleartext at the moment, prevent further execution and output
		die();
	}
	
	

	echo "<form action='changePasswordCheck.php' method='POST'>";
	echo "<pre>";
	echo "<br />Old Password ";
	echo "<input name='oldPassword' type='password' />";
	echo "<br />Password     ";
	echo "<input name='newPassword' type='password' />";
	echo "<br /><input type='submit' value='Change Password'>";
	echo "<input type='hidden' name='token' value=$token";
	echo "</form>";

	
} else {
	echo 'Invalid token';

}

?>