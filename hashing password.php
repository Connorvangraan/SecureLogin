<?php
	$password = 'password';
	$hash = crypt($password);
	echo($hash);
	
	$user_input="password";
	if (hash_equals($hash, crypt($user_input, $hash)))
	{
		echo ("password accepted");
	}

?>