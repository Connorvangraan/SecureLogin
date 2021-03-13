<html>
  <head>
    <title> Recaptcha </title>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
  </head>
  <body>
    <h1>Recaptcha</h1>
    <form id="comment_form" action="recaptchacheck.php" method="post">
      <input type="email" placeholder="Type your email" size="40"><br><br>
      <input type="submit" name="submit" value="Post comment"><br><br>
      <div class="g-recaptcha" data-sitekey="6Le__QgaAAAAAIhbVgef8K7y6reK_IzWHIT9Tg8g"></div>
    </form>
  </body>
</html>