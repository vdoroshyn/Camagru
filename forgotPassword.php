<?php
  session_start();
  include_once('./phpFuncs/funcValidateEmail.php');

  $emailErrors = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");

  if (isset($_POST['submit'])) {
  	if (validateEmail($emailErrors, htmlentities($_POST['email']))) {
      include_once('resettingPassword.php');
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
          <div>
            <span>to reser the password</span>
          </div>
          <div>
            <span>please enter your email</span>
          </div>
          <div id="emailDiv">
            <input class='<?php echo "{$emailErrors['inputClass']}"; ?>' name="email" type="text" placeholder="enter your email" value="">
            <span class='<?php echo "{$emailErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$emailErrors['errorValue']}"; ?></span>
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