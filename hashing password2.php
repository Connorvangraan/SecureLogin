<?php
	$time = 0.05;
	$cost = 8;
	
	do{
		$cost++;
		$start = microtime(true);
		password_hash("password", PASSWORD_BCRYPT, ["cost" => $cost]);
		$end = microtime(true);
	}
	while (($end - $start) < $time);
	
	echo ("Appropriate cost: ".$cost);

?>