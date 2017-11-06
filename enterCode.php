<?php
  session_start();

  $codeErrors = array("inputValue" => "", "inputClass" => "field", "errorValue" => "", "errorClass" => "error");
  if (isset($_GET['code']) && $_GET['code'] != "" && !empty($_GET['username'])) {
    include_once('codeValidation.php');
  } else { //todo
      if (isset($_GET['code']) && isset($_GET['username'])) {
      $codeErrors['errorValue'] = "fill in the fields";
      $codeErrors['inputClass'] = "field invalid-field";
      $codeErrors['errorClass'] = "error active-error";
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
	  	  </ul>
	  	</nav>
  	</header>

  	<section>
	    <form action='<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>' method="get">
        <div class="boldText">
          <span class="formFieldPadding">enter your username</span> <!-- wtf -->
        </div>
        <div class="boldText">
          <span class="formFieldPadding">and the code sent to your email</span> <!-- wtf -->
        </div>
        <div id="codePadding" class="boldText">
          <span class="formFieldPadding">to complete the registration</span>
        </div>
        <div id="loginDiv">
          <input class='<?php echo "{$codeErrors['inputClass']}"; ?>' name="username" type="text" placeholder="enter your username" value="">
        </div>
        <div id="codeDiv">
          <input class='<?php echo "{$codeErrors['inputClass']}"; ?>' name="code" type="text" placeholder="enter your code" value="">
          <span class='<?php echo "{$codeErrors['errorClass']}"; ?>' aria-live="polite"><?php echo "{$codeErrors['errorValue']}"; ?></span>
        </div>
        <div>
          <button class="btn_1" type="submit">submit</button>
        </div>
      </form>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
  </body>
</html>
