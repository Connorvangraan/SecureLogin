<?php
	if(isset($_SESSION)){
		session_destroy();
	}
	session_start();
	
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	$token = bin2hex(random_bytes(24));
	
	
	#$_SESSION['key'] = bin2hex(random_bytes(24));
	#$token = hash_hmac('sha256', $_SERVER['REQUEST_TIME'], $_SESSION['key']); 
	$_SESSION["token"] = $token;
	
	echo "<pre>";
	echo "<form action='complexLoginCheck.php' method='POST'>";
	echo "Username ";
	echo "<input name='txtUsername' type='text' />";
	echo "<br />Password";
	echo " <input name='txtPassword' type='password' />";
	echo "<br /><input type='submit' value='Login'>";
	echo "<input type='hidden' name='token' value=$token";
	echo "</form>";

	

	?>