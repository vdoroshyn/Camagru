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
          <div class="camera-place">
            <img id="cameraImg" src="img/camera.png" alt="camera-img">
            <form style="border:solid white 3px" enctype="multipart/form-data">
              <input type="file" name="file"/>
              <button id="fileUpload" type="submit" name="upload">upload</button>
            </form>
          </div>
          <!-- <video id="video" width="640" height="480" autoplay></video> -->
          <canvas id="canvas" width="640" height="480" hidden></canvas>
          
          <button class="photo-button" disabled type="submit" name="submit">caption this</button>

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
        <aside class="booth-aside" style="border:solid white 3px height:680px">

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
    <script src="js/photobooth.js"></script>
    <script>
      //showing thumbnails of previous taken photos when the page is loaded
      getThumbnails();
    </script>
    <script>

      // Trigger photo take
      document.querySelector('.photo-button').addEventListener("click", function(event) {
        // Elements for taking the snapshot
        var canvas = document.getElementById('canvas');
        var ctx = canvas.getContext('2d');
        var vid = document.getElementById('stream');
        var poro = "nothing";

        var elem = document.querySelector('.video-attr');
        for (var i = 0; i < elem.children.length; ++i) {
          var id = elem.children[i].id;
          if (id == "poro1" || id == "poro2" || id == "poro3") {
            //getting the id of the poro to use in getElementById
            poro = id;
            break;
          }
        }
        if (poro === "nothing") {
          event.preventDefault();
          return;
        }

        var camDiv = document.querySelector('.camera-place');
        var camDivCoords = camDiv.getBoundingClientRect();
        var poroImg = document.getElementById(poro);
        var poroImgCoords = poroImg.getBoundingClientRect();
        var dx = poroImgCoords.left - camDivCoords.left;
        var dy = poroImgCoords.top - camDivCoords.top;
        ctx.drawImage(vid, 0, 0, 640, 480);
        ctx.drawImage(poroImg, dx, dy, 150, 150);
        //calling the saveImg function right after the canvas drawImage
        saveImg();
        //showing thumbnails of previous taken photos after the button click
        getThumbnails();
      });
    </script>
    <script>
      document.getElementById('cameraImg').addEventListener("click", function(event) {
        var div = document.querySelector('.camera-place');

        while (div.firstChild) {
          div.removeChild(div.firstChild);
        }
        // TODO camera should not give errors when the user is logged out!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // TODO error message if no camera!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        
        // if camera can be accessed, create a video node in html and start video stream
        if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
          // Not adding `{ audio: true }` since we only want video now
          navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
              var video = document.createElement('video');

              video.style.width = "640px";
              video.style.height = "480px";
              video.id = "stream";
              video.autoplay = true;
              video.src = window.URL.createObjectURL(stream);
              video.play();
              div.appendChild(video);
          });
        }
      });

      // document.getElementById('fileUpload').addEventListener("click", function(event) {
      //     var xhr = new XMLHttpRequest();

      //     xhr.onreadystatechange = function() {
      //       if (this.readyState == 4 && this.status == 200) {        
      //         console.log(this.responseText);
      //       }
      //     }
      //     xhr.open("POST", "fileUpload.php", true);
      //     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      //     // xhr.send("dataUrl=" + dataUrl);
      //     xhr.send();
      // });
    </script>
  </body>
</html>
