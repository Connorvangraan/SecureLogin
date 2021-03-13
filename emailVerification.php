<?php
	session_start();
	
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	
	$token = bin2hex(random_bytes(24));
	$_SESSION['token'] = $token;
	
	$_SESSION['username'] = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
	$_SESSION['husername'] = hash('sha256',$_POST['username']);
	$_SESSION['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$_SESSION['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL); 
	$_SESSION['dob']  = $_POST['dob'];
	$_SESSION['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
	$_SESSION['password']= $_POST['password']; 
	
	$_SESSION['useraccess']=true;
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
	
	
	    $email;
		$comment;
		$captcha;
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }
        if(isset($_POST['comment'])){
          $comment=$_POST['comment'];
        }
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo 'Check the the captcha form <br/>';
		  echo "<form action='registerationForm.php' method='POST'>";
		  echo "<br /><input type='submit' value='Back'>";
		  echo "<input type='hidden' name='token' value=$token";
		  echo "</form>";
          exit;
        }
        $secretKey = "6Le__QgaAAAAABzL8M8AeslqUX9IDeGEqVhMGDn9";
        $ip = $_SERVER['REMOTE_ADDR'];
        $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
        $response = file_get_contents($url);
        $responseKeys = json_decode($response,true);
        if($responseKeys["success"]) {
                
	
	
	
	$servername='localhost';
	$username="root";
	$db="restaurant";
	$rootPassword="";
	$conn = new mysqli($servername, $username, $rootPassword, $db);
	
	if ($conn -> connect_error){
		die("Connectivity failed, sorry lads: " . $conn->connect_error);
	}
	
	$useraccess = true;
	$userQuery = "SELECT username FROM customer WHERE username = ?";
	$hashedusername = $_SESSION['husername'];
	if ($stmt = $conn->prepare($userQuery)){
		$stmt->bind_param("s",$hashedusername);
		$stmt->execute();
		$stmt->bind_result($foundpassword);
		while($stmt->fetch()){
			$_SESSION['useraccess'] = false;
		}
	}
	
	
	
	if (!preg_match("#[0-9]+#", $_SESSION['password']) || !preg_match("#[a-zA-Z]+#", $_SESSION['password'])) {
        echo "Password must include at least one number!";
		echo "<form action='registerationForm.php' method='POST'>";
		echo "<br /><input type='submit' value='Back'>";
		echo "<input type='hidden' name='token' value=$token";
		echo "</form>";
    }
	
	else if ($_SESSION['useraccess']){

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
	#echo $etoken;
	$mail->isHTML(true);                                 
	$mail->Subject = 'Email Verification';
	$mail->Body    = 'Please use the following code to verify your email for the restaurant: <br/>' . '<b>' . $etoken . '</b>';
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	try {
		$mail->send();
	} catch (Exception $e) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}

	echo "<form action='registerationFormCheck.php' method='POST'>";
	echo "<br /> We have emailed you a verification code, please enter it here: <br />";
	echo "<input name='etoken' type='text' />";
	echo "<input type='hidden' name='token' value=$token";
	echo "</form>";
	echo "<form action='complexLoginForm.php' method='POST'>";
	echo "<br /><input type='submit' value='Next'>";
	echo "<input type='hidden' name='token' value=$token";
	echo "</form>";
	
	} else if (!$_SESSION['useraccess']){
		echo 'Username taken';
		echo "<form action='registerationForm.php' method='POST'>";
		echo "<br /><input type='submit' value='Back'>";
		echo "<input type='hidden' name='token' value=$token";
		echo "</form>";
	}
        } else {
                echo 'Captcha failed';
				echo "<form action='registerationForm.php' method='POST'>";
				echo "<br /><input type='submit' value='Back'>";
				echo "<input type='hidden' name='token' value=$token";
				echo "</form>";
        }

?>