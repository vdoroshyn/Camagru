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
            main.insertBefore(photo, btn);
          }
          //addButton();
        }
      }
      xhr.open("GET", "getGalleryPhotos.php?offset=" + offset, true);
      xhr.send();
    }

    // function addButton() {
    //   var btn = document.createElement('button');
    //   let main = document.getElementsByTagName('main')[0];

    //   btn.type = "submit";
    //   btn.classList.add('btn-gallery');
    //   btn.name = "loadMore";
    //   btn.textContent = "load more photos";
    //   btn.addEventListener('click', loadMorePhotos, true);
    //   main.appendChild(btn);
    // }

    function loadMorePhotos() {
      offset += 4;

      // var main = document.getElementsByTagName('main')[0];
      // while (main.firstChild) {
      //   main.removeChild(main.firstChild);
      // }
      getGalleryPhotos();
    }

    getGalleryPhotos();
    </script>
  </body>
</html>
