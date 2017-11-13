<?php
  session_start();
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
	  	    <li class="current"><a href="./photobooth.php">Photobooth</a></li>
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
      <?php if (isset($_SESSION['id'])): ?>
  	  <main>
        <div class="video-attr" style="border:solid white 3px">
          <video id="video" width="640" height="480" autoplay></video>
          <form action="" method="post">
            <input type="file" name="file"/>
            <button type="submit" name="upload">upload</button>
          </form>
          <button class="btn_1 photo-button" type="submit" name="submit">caption</button>
          <div class="super-img">
            <div style="border:solid white 3px">
              <p>test</p>
            </div>
            <div style="border:solid white 3px">
              <p>test</p>
            </div>
            <div style="border:solid white 3px">
              <p>test</p>
            </div>
          </div>
        </div>
        <aside style="border:solid white 3px">
          <p>a nice column of text</p>
        </aside>
      </main>
      <?php else: ?>
        <form>
          <img class="padding-bottom" src="./img/stop.png" alt="stop sign">
          <p>you should be logged in</p>
          <p>to access camera features</p>
        </form>
      <?php endif; ?>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
    <script>
      // Grab elements, create settings, etc.
      var video = document.getElementById('video');

      // Get access to the camera!
      if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
          // Not adding `{ audio: true }` since we only want video now
          navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
              video.src = window.URL.createObjectURL(stream);
              video.play();
          });
      }
    </script>
  </body>
</html>
