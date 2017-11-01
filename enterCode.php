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
	  	    <li><a href="./index.php">Login</a></li>
	  	    <li><a href="#">Photobooth</a></li>
	  	    <li><a href="#">Gallery</a></li>
	  	  </ul>
	  	</nav>
  	</header>

  	<section>
	    <form>
        <div class="boldText">
          <span class="formFieldPadding">enter the code sent to your email</span> <!-- wtf -->
        </div>
        <div id="codePadding" class="boldText">
          <span class="formFieldPadding">to complete the registration</span>
        </div>
        <div>
          <input class="field" name="code" type="text" placeholder="enter your code" value="">
          <span class="error" aria-live="polite"></span>
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
