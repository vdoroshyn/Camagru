<?php
  session_start();

  $usernameErrors = array("inputClass" => "field");
  $pswdErrors =  array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");

  if (!empty($_GET['username']) && !empty($_GET['pswd'])) {
    include_once('logingUser.php');
  } else {
    if (isset($_GET['username']) && isset($_GET['pswd'])) {
      $pswdErrors['errorValue'] = "fill in the fields";
      $pswdErrors['inputClass'] = "field invalid-field";
      $pswdErrors['errorClass'] = "error active-error";
      $usernameErrors['inputClass'] = "field invalid-field";
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
	  	    <li class="current"><a href="./index.php">Home</a></li>
	  	    <li><a href="#">Photobooth</a></li>
	  	    <li><a href="#">Gallery</a></li>
	  	  </ul>
	  	</nav>
  	</header>

  	<section>
	    <form action='<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>' method="get">
        <div>
          <p>login with your credentials</p>
        </div>
        <div id="loginDiv">
          <input class='<?php echo "{$usernameErrors['inputClass']}"; ?>' name="username" type="text" placeholder="login" value="">
        </div>
        <div id="passwordDiv">
          <input class='<?php echo "{$pswdErrors['inputClass']}"; ?>' name="pswd" type="password" placeholder="password" value="">
          <span class='<?php echo "{$pswdErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$pswdErrors['errorValue']}"; ?></span>
        </div>
        <div>
          <button class="btn_1" type="submit">submit</button>
        </div>
        <div>
          <span>forgot your password?</span>
        </div>
        <div>
          <a id="signIn" href="#">click here to reset</a>
        </div>
      </form>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
  </body>
</html>
