<?php
  session_start();
  //creating variables for integrating php into html
  $inputValue = array("login" => "", "email" => "", "pswd" => "", "repeatPswd" => "");
  $errorValue = array("login" => "", "email" => "", "pswd" => "", "repeatPswd" => "");
  $errorClass = array("login" => "error", "email" => "error", "pswd" => "error", "repeatPswd" => "error");
  $inputClass = array("login" => "field", "email" => "field", "pswd" => "field", "repeatPswd" => "field");

  if (!empty($_POST['login']) &&
      !empty($_POST['email']) &&
      !empty($_POST['password']) &&
      !empty($_POST['repeatPassword'])
      ) {
    include_once('registration.php');
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
	    <form action='<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>' method="POST" novalidate>
        <div>
          <span id="signUp">sign up</span>
        </div>
	      <div id="loginDiv">
	        <input class='<?php echo "{$inputClass['login']}"; ?>' name="login" type="text" placeholder="login" value='<?php echo "{$inputValue['login']}"; ?>'>
          <span class='<?php echo "{$errorClass['login']}"; ?>' aria-live="polite"><?php echo "{$errorValue['login']}"; ?></span>
	      </div>
	      <div id="emailDiv">
	        <input class='<?php echo "{$inputClass['email']}"; ?>' name="email" type="email" placeholder="email" value='<?php echo "{$inputValue['email']}"; ?>'>
          <span class='<?php echo "{$errorClass['email']}"; ?>' aria-live="polite"><?php echo "{$errorValue['email']}"; ?></span>
	      </div>
	      <div id="passwordDiv">
	        <input class='<?php echo "{$inputClass['pswd']}"; ?>' name="password" type="password" placeholder="password" value='<?php echo "{$inputValue['pswd']}"; ?>'>
          <span class='<?php echo "{$errorClass['pswd']}"; ?>' aria-live="polite"><?php echo "{$errorValue['pswd']}"; ?></span>
	      </div>
	      <div id="repeatPasswordDiv">
	        <input class='<?php echo "{$inputClass['repeatPswd']}"; ?>' name="repeatPassword" type="password" placeholder="repeat password" value='<?php echo "{$inputValue['repeatPswd']}"; ?>'>
          <span class='<?php echo "{$errorClass['repeatPswd']}"; ?>' aria-live="polite"><?php echo "{$errorValue['repeatPswd']}"; ?></span>
	      </div>
	      <div>
	      	<button class="btn_1" type="submit" name="submit">submit</button> <!-- todo name="submit" -->
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
    <script src="js/registrationValidation.js"></script>
  </body>
</html>
