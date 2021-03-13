<?php
	session_start();
	
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/autoload.php';
	
	$token = substr($_POST['token'], 0, -6);
	
	if (hash_equals($_SESSION['token'], $token)) {


		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';

		$mail->Mailer = "smtp";

		$mail->Host       = "smtp.gmail.com"; 
		$mail->SMTPDebug = 0;                    
		$mail->SMTPAuth   = true;                
		$mail->Port       = 587;                    
		$mail->Username   = "authenticatesignin@gmail.com"; 
		$mail->Password   = "Cherrybomb74";       
		$mail->SMTPOptions = array(
                  'ssl' => array(
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                      'allow_self_signed' => true
                  )
              );
		$mail->From = "authenticatesignin@gmail.com";
		$mail->SetFrom("authenticatesignin@gmail.com ", "Sign In Authentication");
		$mail->addAddress($_SESSION['email']);

		$etoken = bin2hex(random_bytes(4));
		$_SESSION['emailtoken'] = $etoken;
		#echo ($etoken);
		$mail->isHTML(true);                                  
		$mail->Subject = 'Sign In Token';
		$mail->Body    = 'Please use the following token to signin to the resturant page: <br/>' . '<b>' . $etoken . '</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	try {
		$mail->send();
	} catch (Exception $e) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}

	echo "<form action='emailCheck.php' method='POST'>";
	echo "<br /> We have emailed you a verification code, please enter it here: <br/>";
	echo "<input name='etoken' type='text' />";
	echo "<input type='hidden' name='token' value=$token";
	echo "<br /><input type='submit' value='Submit'>";
	echo "</form>";
	echo "<form action='complexLoginForm.php' method='POST'>";
	echo "<br /><input type='submit' value='Back'>";
	echo "</form>";
	
	} else {
		echo 'Invalid token';
	}


?>