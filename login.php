<?php
  session_start();
  include_once('./phpFuncs/funcValidateTwoFields.php');

  $fieldErrors =  array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");

  if (isset($_POST['submit'])) {
    if (areTwoFieldsEmpty($fieldErrors, htmlentities($_POST['username']), htmlentities($_POST['pswd']))) {
      include_once('logingUser.php');
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
      <?php if (!isset($_SESSION['id'])): ?>
        <form action='<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>' method="POST">
          <div>
            <p>login with your credentials</p>
          </div>
          <div id="usernameDiv">
            <input class='<?php echo "{$fieldErrors['inputClass']}"; ?>' name="username" type="text" placeholder="username" value="">
          </div>
          <div id="passwordDiv">
            <input class='<?php echo "{$fieldErrors['inputClass']}"; ?>' name="pswd" type="password" placeholder="password" value="">
            <span class='<?php echo "{$fieldErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$fieldErrors['errorValue']}"; ?></span>
          </div>
          <div>
            <button class="btn_1" type="submit" name="submit">submit</button>
          </div>
          <div>
            <span>forgot your password?</span>
          </div>
          <div>
            <a id="signIn" href="forgotPassword.php">click here to reset</a>
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
