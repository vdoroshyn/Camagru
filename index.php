<?php
  session_start();
  //creating variables for integrating php into html
  $inputValue = array("login" => "", "email" => "", "pswd" => "", "repeatPswd" => "");
  $errorValue = array("login" => "", "email" => "", "pswd" => "", "repeatPswd" => "");
  $errorClass = array("login" => "error", "email" => "error", "pswd" => "error", "repeatPswd" => "error");
  $inputClass = array("login" => "field", "email" => "field", "pswd" => "field", "repeatPswd" => "field");

  if (!empty($_GET['login']) &&
      !empty($_GET['email']) &&
      !empty($_GET['password']) &&
      !empty($_GET['repeatPassword'])
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
	  	    <li class="current"><a href="#">Login</a></li>
	  	    <li><a href="#">Photobooth</a></li>
	  	    <li><a href="#">Gallery</a></li>
	  	  </ul>
	  	</nav>
  	</header>

  	<section>
	    <form action="index.php" method="get" novalidate>
        <div>
          <span id="signUp">sign up</span>
        </div>
	      <div id="loginDiv">
	        <input class="field" name="login" type="text" placeholder="login">
          <span class="error" aria-live="polite"></span>
	      </div>
	      <div id="emailDiv">
	        <input class='<?php echo "{$inputClass['email']}"; ?>' name="email" type="email" placeholder="email" value='<?php echo "{$inputValue['email']}"; ?>'>
          <span class='<?php echo "{$errorClass['email']}"; ?>' aria-live="polite"><?php echo "{$errorValue['email']}"; ?></span>
	      </div>
	      <div id="passwordDiv">
	        <input class="field" name="password" type="password" placeholder="password">
          <span class="error" aria-live="polite"></span>
	      </div>
	      <div id="repeatPasswordDiv">
	        <input class="field" name="repeatPassword" type="password" placeholder="repeat password">
          <span class="error" aria-live="polite"></span>
	      </div>
	      <div>
	      	<button class="btn_1" type="submit">submit</button>
	      </div>
        <div>
	        <span id="haveAccount">Already have an account?</span>
        </div>
        <div>
          <a id="signIn" href="#">sign in</a>
        </div>

	    </form>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
    <script src="js/registrationValidation.js"></script>
  </body>
</html>
