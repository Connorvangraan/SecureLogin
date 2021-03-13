



<html>
  <head>
  <?php
	$https = true;
	if ($https && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
		header('Strict-Transport-Security: max-age=31536000');
	} elseif ($https) {
		header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
		die();
	}
	
	if(isset($_SESSION)){
		session_destroy();
	}
	
	?>
    <title> Sign Up </title>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  </head>
  <body>
    <h1>Sign Up</h1>
    <form id="comment_form" action="emailVerification.php" method="post"> <!--registerationFormCheck.php--> 
	  <input type="text" placeholder="Name" name = 'name' size="40"><br><br>
	  <input type="email" placeholder="Email" name='email' size="40"><br><br>
	  <input type="text" placeholder="Address" name='address' size="40"><br><br>
      <input type="date" placeholder="Date" name='dob' size="40"><br><br>
	  <input type="text" placeholder="Username" name='username' size="40"><br><br>
	  <input type="password" placeholder="Password" name='password' size="40"><br><br>
      <input type="submit" name="submit" value="Submit"><br><br>
      <div class="g-recaptcha" data-sitekey="6Le__QgaAAAAAIhbVgef8K7y6reK_IzWHIT9Tg8g"></div>
    </form>
  </body>
</html>


