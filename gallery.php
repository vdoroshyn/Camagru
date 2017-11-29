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
	  	    <li><a href="./photobooth.php">Photobooth</a></li>
	  	    <li class="current"><a href="./gallery.php">Gallery</a></li>
          <?php if (!isset($_SESSION['id'])): ?>
            <li><a class="login-logout" href="login.php">login</a></li>
          <?php else: ?>
            <li><a class="login-logout" href="logout.php">logout</a></li>
          <?php endif; ?>
	  	  </ul>
	  	</nav>
  	</header>

  	<section>
      <main class="gallery-main">
        <button class="btn-gallery" type="submit" name="loadMore">load more photos</button>
      </main>
  	</section>

  	<footer>
  	  <p>Copyright &copy; 2017 vdoroshy</p>
  	</footer>
    <script>
      document.getElementsByTagName('button')[0].addEventListener('click', loadMorePhotos, true);
      getGalleryPhotos();

      var offset = 0;

      function getGalleryPhotos() {
      var main = document.getElementsByTagName('main')[0];

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var photos = JSON.parse(this.responseText);
          var btn = document.getElementsByTagName('button')[0];

          for(var i = 0; i < photos.length; ++i) {
            var photo = document.createElement('img');
            photo.src = photos[i];
            photo.classList.add('gallery-photos');
            photo.addEventListener('click', showPhoto, true);
            main.insertBefore(photo, btn);
          }
        }
      }
      xhr.open("GET", "getGalleryPhotos.php?offset=" + offset, true);
      xhr.send();
    }

    function loadMorePhotos() {
      offset += 4;

      getGalleryPhotos();
    }


    function showPhoto() {
      let body = document.getElementsByTagName('body')[0];

      var blurBackground = document.createElement('div');

      blurBackground.classList.add('blurred-background');
      blurBackground.addEventListener('click', removeBlur, true);

      var div = document.createElement('div');
      div.classList.add('photo-place');
      blurBackground.appendChild(div);

      body.appendChild(blurBackground);
    }

    function removeBlur() {
      let body = document.getElementsByTagName('body')[0];

      for (let i = 0; i < body.children.length; ++i) {
        let child = body.children[i];
        if (child.tagName === "DIV") {
          body.removeChild(child);
        }
      }
    }
    </script>
  </body>
</html>
