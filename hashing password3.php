<?php
	echo 'Argon21 hash: ' . password_hash("ComputerSecurity", PASSWORD_ARGON2I);
	
	$time = 0.4;
	$cost = 15;
	
	$password = "password";
	
	do{
		$start = microtime(true);
		$cost++;
		password_hash($password, PASSWORD_ARGON2I, ["cost" => $cost]);
		$end = microtime(true);}
	while (($end - $start) < $time);
	
	echo "\n Cost found:" . $cost;
	
?>