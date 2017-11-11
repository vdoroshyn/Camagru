<?php
  session_start();
  include_once('./phpFuncs/funcValidateUsername.php');
  include_once('./phpFuncs/funcValidatePassword.php');

  //creating variables for integrating php into html
  $usernameErrors   = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");
  $pswdErrors       = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");
  $repeatPswdErrors = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");

  if (isset($_POST['submit'])) {
    /*
    **I wanted to make a separate function
    **but it will be a ton of shitcode while passing vars
    */
    $i = 0;

    $i += validateUsername($usernameErrors, htmlentities($_POST['username']));
    $i += validatePassword($pswdErrors, htmlentities($_POST['pswd']));
    $i += validateRepeatPassword($repeatPswdErrors, htmlentities($_POST['pswd']), htmlentities($_POST['repeatPswd']));
    //if all three functions returned true(3) == no errors
    if ($i == 3) {
      include_once('changingPassword.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Camagru</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="the photo gallery project">
    <meta name="keywords" content="photo, photobooth, selfie, likes">
    <meta name="author" content="vdoroshy">
    <link rel="stylesheet" type="text/css" href="./css/reset.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
  </head>
  <body>
  	<header>
	  	<div id="logo">
	  	  <h1>Camagru</h1>
	  	</div>
	  	<nav>
	  	  <ul>
	  	    <li><a href="./index.php">Home</a></li>
	  	    <li><a href="#">Photobooth</a></li>
	  	    <li><a href="#">Gallery</a></li>
          <?php if (!isset($_SESSION['id'])): ?>
            <li><a class="login-logout" href="login.php">login</a></li>
          <?php else: ?>
            <li><a class="login-logout" href="logout.php">logout</a></li>
          <?php endif; ?>
	  	  </ul>
	  	</nav>
  	</header>

  	<section>
  	  <?php if (!isset($_SESSION['id'])): ?>
        <form action='<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>' method="POST">
          <p>fill in the form</p>
          <p>to reset your password</p>
          <div id="usernameDiv">
	        <input class='<?php echo "{$usernameErrors['inputClass']}"; ?>' name="username" type="text" placeholder="enter your username">
          	<span class='<?php echo "{$usernameErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$usernameErrors['errorValue']}"; ?></span>
	      </div>
          <div id="passwordDiv">
	        <input class='<?php echo "{$pswdErrors['inputClass']}"; ?>' name="pswd" type="password" placeholder="enter a new password">
          	<span class='<?php echo "{$pswdErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$pswdErrors['errorValue']}"; ?></span>
	      </div>
	      <div id="repeatPasswordDiv">
	        <input class='<?php echo "{$repeatPswdErrors['inputClass']}"; ?>' name="repeatPswd" type="password" placeholder="confirm your new password">
            <span class='<?php echo "{$repeatPswdErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$repeatPswdErrors['errorValue']}"; ?></span>
	      </div>
	      <div>
	      	<button class="btn_1" type="submit" name="submit">submit</button>
	      </div>
        </form>
      <?php else: ?>
        <form>
          <p>you are already signed in</p>
        </form>
      <?php endif; ?>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
  </body>
</html>

?>