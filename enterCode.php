<?php
  session_start();
  include_once('./phpFuncs/funcValidateTwoFields.php');
  
  //creating variables for integrating php into html
  $fieldErrors = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");

  if (isset($_POST['submit'])) {
    if (areTwoFieldsEmpty($fieldErrors, htmlentities($_POST['code']), htmlentities($_POST['username']))) {
      include_once('codeValidation.php');
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
	  	    <li><a href="./photobooth.php">Photobooth</a></li>
	  	    <li><a href="./gallery.php">Gallery</a></li>
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
  	    <form class="registr" action='<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>' method="POST">
          <div class="boldText">
            <span class="formFieldPadding">enter your username</span> <!-- wtf -->
          </div>
          <div class="boldText">
            <span class="formFieldPadding">and the code sent to your email</span> <!-- wtf -->
          </div>
          <div id="codePadding" class="boldText">
            <span class="formFieldPadding">to complete the registration</span>
          </div>
          <div id="usernameDiv">
            <input class='<?php echo "{$fieldErrors['inputClass']}"; ?>' name="username" type="text" placeholder="enter your username" value="">
          </div>
          <div id="codeDiv">
            <input class='<?php echo "{$fieldErrors['inputClass']}"; ?>' name="code" type="text" placeholder="enter your code" value="">
            <span class='<?php echo "{$fieldErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$fieldErrors['errorValue']}"; ?></span>
          </div>
          <div>
            <button class="btn_1" type="submit" name="submit">submit</button>
          </div>
        </form>
      <?php else: ?>
        <form class="registr">
          <p>you are already registered</p>
        </form>
      <?php endif; ?>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
  </body>
</html>
