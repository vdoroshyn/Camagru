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
      <?php if (isset($_SESSION['id'])): ?>
  	  <main class="camera-main">
        <div class="video-attr">
          <div class="camera-place">
            <p>enable the camera</p>
            <img id="cameraImg" src="img/camera.png" alt="camera-img">
            <p>or upload your own image</p>
            <input class="input-border" type="file" id="getFile" name="userFile"/>
          </div>
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
        <aside class="booth-aside">

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
        // var vid = document.getElementById('stream');
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
        //checking whether I have a video or an uploaded photo
        var checkVars = document.querySelector('.camera-place');
        //video segment
        if (checkVars.children[0].id == "stream") {
          var vid = document.getElementById('stream');
          ctx.drawImage(vid, 0, 0, 640, 480);
          ctx.drawImage(poroImg, dx, dy, 150, 150);
          //calling the saveImg function right after the canvas drawImage
          saveImg();
          //showing thumbnails of previous taken photos after the button click
          getThumbnails();
        } 
        //image segment
        else if (checkVars.children[0].id == "uploadedImg") {
          var background = document.querySelector('.user-uploaded-img').style.backgroundImage;
          background = background.substring(5, background.length - 2);
          var img = new Image();
          img.onload = function() {
            ctx.drawImage(img, 0, 0, 640, 480);
            ctx.drawImage(poroImg, dx, dy, 150, 150);
            //calling the saveImg function right after the canvas drawImage
            saveImg();
            //showing thumbnails of previous taken photos after the button click
            getThumbnails();
          }
          img.src = background;
        }
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

      document.getElementById('getFile').addEventListener('change', readFile, true);

      function readFile() {
        //getting the user uploaded file and creating a fileReader
        var file = document.getElementById('getFile').files[0];
        var reader = new FileReader();
        //deleting all elements of the camera-place div
        var div = document.querySelector('.camera-place');
        while (div.firstChild) {
          div.removeChild(div.firstChild);
        }
        if (file.type !== "image/png" && file.type !== "image/jpeg" && file.type !== "image/gif") {
          var p = document.createElement('p');
          p.textContent = "you should upload an image";
          div.appendChild(p);
          var input = document.createElement('input');
          input.classList.add('input-border');
          input.type = "file";
          input.id = "getFile";
          input.name = "userFile";
          input.onchange = readFile;
          div.appendChild(input);
          return;
        } 
        reader.onloadend = function() {
          var elem = document.createElement('div');
          elem.id = "uploadedImg";
          elem.classList.add('user-uploaded-img');
          elem.style.backgroundImage = "url(" + reader.result + ")";
          div.appendChild(elem);
        }
        if (file) {
          reader.readAsDataURL(file);
        }
      }
    </script>
  </body>
</html>
