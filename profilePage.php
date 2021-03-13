<?php
	session_start();
	
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	
	$token = $_SESSION['token'];
	$_SESSION['temptoken'] = $_SESSION['token'];
	
	echo "<br /> Hello " . $_SESSION['name'];
	echo "<br /> Welcome to the website";
			
	echo "<form action='redirection.php' method='POST'>";
	echo "<br /><input type='submit' name=details value='See Details'>";
	echo "<input type='hidden' name='token' value=$token";
	echo "</form>";

	echo "<form action='redirection.php' method='POST'>";
	echo "<br /><input type='submit' name=change value='Change Password'>";
	echo "<input type='hidden' name='token' value=$token";
	echo "</form>";
			
	echo "<form action='redirection.php' name=back method='POST'>";
	echo "<br /><input type='submit' value='Sign out'>";
	echo "</form>";


?>