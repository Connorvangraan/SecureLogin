<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
//require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer();

// Settings
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';

$mail->Mailer = "smtp";

$mail->Host       = "smtp.gmail.com"; // SMTP server example
$mail->SMTPDebug = 2;                    // enables SMTP debug information (for testing)
$mail->SMTPSecure = "tls";
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "authenticatesignin@gmail.com"; // SMTP account username example
$mail->Password   = "Cherrybomb74";        // SMTP account password example
$mail->SMTPOptions = array(
                  'ssl' => array(
                      'verify_peer' => false,
                      'verify_peer_name' => false,
                      'allow_self_signed' => true
                  )
              );
$mail->From = "authenticatesignin@gmail.com";
$mail->SetFrom("authenticatesignin@gmail.com ", "Sign In Authentication");
$mail->addAddress("connor.vangraan@gmail.com");

#connor.vangraan@gmail.com
#bekah.justice11@gmail.com

$token = bin2hex(random_bytes(24));

// Content
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = 'Sign In Token';
$mail->Body    = 'Please use the following token to signin to the resturant page: <br/>' . '<b>' . $token . '</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

try {
		$mail->send();
		echo "Message has been sent successfully";
	} catch (Exception $e) {
		echo "Mailer Error: " . $mail->ErrorInfo;
	}



?>