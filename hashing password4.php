<?php

	$cost = 9;
	$new = [
	'options' => ['cost' => 11],
	'algo' => PASSWORD_DEFAULT,
	'hash' => null];
	
	$password = 'CherryBomb75';
	
	$hashed = password_hash($password, PASSWORD_DEFAULT, ['cost' => $cost]);
	echo($hashed);
	echo("\n");
	
	if (password_verify($password, $hashed) === true){
		if (password_needs_rehash($hashed, $new['algo'], $new['options']) === true){
			$newhash = password_hash($password, $new['algo'], $new['options']);
			echo ($newhash);
			echo ("\n");
			print_r (password_get_info($newhash));
		}
	}
	
?>