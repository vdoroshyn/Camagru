<?php
  session_start();
  include_once('./phpFuncs/funcValidateUsername.php');
  include_once('./phpFuncs/funcValidatePassword.php');
  include_once('./phpFuncs/funcValidateEmail.php');

  //creating variables for integrating php into html
  $usernameErrors   = array("inputClass" => "field", "inputValue" => "", "errorValue" => "", "errorClass" => "error");
  $emailErrors      = array("inputClass" => "field", "inputValue" => "", "errorValue" => "", "errorClass" => "error");
  $pswdErrors       = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");
  $repeatPswdErrors = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");

  if (isset($_POST['submit'])) {
    /*
    **in case of error, these two fields are preserved
    **for the user to be able to see what is wrong
    */
    $usernameErrors['inputValue'] = htmlentities($_POST['username']);
    $emailErrors['inputValue'] = htmlentities($_POST['email']);

    /*
    **I wanted to make a separate function
    **but it will be a ton of shitcode while passing vars
    */
    $i = 0;

    $i += validateUsername($usernameErrors, htmlentities($_POST['username']));
    $i += validateEmail($emailErrors, htmlentities($_POST['email']));
    $i += validatePassword($pswdErrors, htmlentities($_POST['pswd']));
    $i += validateRepeatPassword($repeatPswdErrors, htmlentities($_POST['pswd']), htmlentities($_POST['repeatPswd']));
    //if all three functions returned true(4) == no errors
    if ($i == 4) {
      include_once('registration.php');
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
	  	    <li class="current"><a href="index.php">Home</a></li>
	  	    <li><a href="./photobooth.php">Photobooth</a></li>
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
	    <form class="registr" action='<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>' method="POST" novalidate>
        <div>
          <span id="signUp">sign up</span>
        </div>
	      <div id="usernameDiv">
	        <input class='<?php echo "{$usernameErrors['inputClass']}"; ?>' name="username" type="text" placeholder="username" value='<?php echo "{$usernameErrors['inputValue']}"; ?>'>
          <span class='<?php echo "{$usernameErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$usernameErrors['errorValue']}"; ?></span>
	      </div>
	      <div id="emailDiv">
	        <input class='<?php echo "{$emailErrors['inputClass']}"; ?>' name="email" type="email" placeholder="email" value='<?php echo "{$emailErrors['inputValue']}"; ?>'>
          <span class='<?php echo "{$emailErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$emailErrors['errorValue']}"; ?></span>
	      </div>
	      <div id="passwordDiv">
	        <input class='<?php echo "{$pswdErrors['inputClass']}"; ?>' name="pswd" type="password" placeholder="password">
          <span class='<?php echo "{$pswdErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$pswdErrors['errorValue']}"; ?></span>
	      </div>
	      <div id="repeatPasswordDiv">
	        <input class='<?php echo "{$repeatPswdErrors['inputClass']}"; ?>' name="repeatPswd" type="password" placeholder="repeat password">
          <span class='<?php echo "{$repeatPswdErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$repeatPswdErrors['errorValue']}"; ?></span>
	      </div>
	      <div>
	      	<button class="btn_1" type="submit" name="submit">submit</button>
	      </div>
        <?php if (!isset($_SESSION['id'])): ?>
          <div>
            <span class="formFieldPadding">Already have an account?</span>
          </div>
          <div>
            <a id="signIn" href="login.php">sign in</a>
          </div>
        <?php endif; ?>
	    </form>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
   <!--  <script src="js/registrationValidation.js"></script> -->
  </body>
</html>
