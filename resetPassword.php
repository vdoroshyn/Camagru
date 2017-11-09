<?php
  session_start();
  //creating variables for integrating php into html
  $pswdErrors =       array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");
  $repeatPswdErrors = array("inputClass" => "field", "errorValue" => "", "errorClass" => "error");

  if (!empty($_GET['code']) && !empty($_GET['email'])) {
  	
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
          <p>enter a new password</p>
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