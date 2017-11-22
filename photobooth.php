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
          <canvas id="canvas" width="640" height="480" hidden></canvas>
          <form style="border:solid white 3px" action="fileUpload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file"/>
            <button type="submit" name="upload">upload</button>
          </form>
          <button class="photo-button" disabled type="submit" name="submit">caption this</button>

<!--           <form method="post" name="imgForm">
            <input name="hidden_data" id="hidden_data" type="hidden"/>
          </form> -->

          <div class="img-boxes">
            <div class="box">
              <img id="poro1" src="img/poro1.png" alt="poro1" onmousedown="poroMove(event)">
            </div>
            <div class="box">
              <img id="poro2" src="img/poro2.png" alt="poro2" onmousedown="poroMove(event)">
            </div>
            <div class="box">
              <img id="poro3" src="img/poro3.png" alt="poro3" onmousedown="poroMove(event)">
            </div>
          </div>
        </div>
        <aside class="booth-aside" style="border:solid white 3px">
          <!-- <canvas id="canvas" width="640" height="480"></canvas> -->
        </aside>
      </main>
      <?php else: ?>
        <form class="registr">
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
      // TODO camera should not give errors when the user is logged out!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
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
    <script>
      // Elements for taking the snapshot
      var canvas = document.getElementById('canvas');
      var ctx = canvas.getContext('2d');
      var video = document.getElementById('video');
      // var dataURL = canvas.toDataURL();
      // console.log(dataURL);



      // Trigger photo take
      document.querySelector('.photo-button').addEventListener("click", function(event) {
        var poro = "nothing";

        var elem = document.querySelector('.video-attr');
        for (var i = 0; i < elem.children.length; ++i) {
          var id = elem.children[i].id;
          if (id == "poro1" || id == "poro2" || id == "poro3") {
            poro = id;
            break;
          }
        }
        if (poro === "nothing") {
          event.preventDefault();
          return;
        }

        var poroImg = document.getElementById(poro);
        var left = parseInt(poroImg.style.left);
        var top = parseInt(poroImg.style.top);

        ctx.drawImage(video, 0, 0, 640, 480);
        ctx.drawImage(poroImg, (left - 379), (top - 211), 150, 150);
        //calling the saveImg function right after the canvas drawImage
        saveImg();
      });

      function saveImg() {
        var imgData = document.getElementById('canvas');
        var dataUrl = canvas.toDataURL();

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {        
            console.log(this.responseText);
          }
        }
        xhr.open("POST", "captionImg.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("dataUrl=" + dataUrl);
      }
    </script>
    <script>
      //showing thumbnails of previous taken photos
      var aside = document.getElementsByTagName('aside')[0];

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var arr = JSON.parse(this.responseText);

          for(var i = 0; i < arr.length; ++i) {
            var img = document.createElement('img');
            img.src = arr[i];
            img.style.height = "240px";
            img.style.width = "320px";
            aside.appendChild(img);
          }
        }
      }
      xhr.open("GET", "getThumbnails.php", true);
      xhr.send();

    </script>
    <script src="js/photobooth.js"></script>
  </body>
</html>
