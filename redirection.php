<?php 
	session_start();
	
	if (hash_equals($_SESSION['token'], $_SESSION['temptoken'])) {
	if( isset($_POST['details']) ) {
		unset($_POST['details']);
		header('Location: showUserDetails.php');
	}
	else if( isset($_POST['change']) ) {
		unset($_POST['change']);
		header('Location: changePasswordForm.php');
	}
	else{
		header('Location: complexLoginForm.php');}
		
	}


?>