<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  	<title>Camagru</title>
  	<meta charset="utf-8">
 <!--  	<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
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
      var offset = 0;
      document.getElementsByTagName('button')[0].addEventListener('click', loadMorePhotos, true);
      getGalleryPhotos();

      function getGalleryPhotos() {
      var main = document.getElementsByTagName('main')[0];

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var photos = JSON.parse(this.responseText);
          var btn = document.getElementsByTagName('button')[0];

          for(var i = 0; i < photos.length; i += 2) {
            var photo = document.createElement('img');
            //JSON.parse returned an array with photo url, photo id
            photo.src = photos[i];
            photo.dataset.id = photos[i + 1];
            photo.classList.add('gallery-photos');
            photo.addEventListener('click', createPopup, true);
            main.insertBefore(photo, btn);
          }
          //if there are no photos in the gallery, show a message
          if (main.children.length == 1) {
            var p = document.createElement('p');
            p.textContent = "there are no photos";
            p.classList.add('no-photos-error');
            main.appendChild(p);
            return;
          }
        }
      }
      xhr.open("GET", "getGalleryPhotos.php?offset=" + offset, true);
      xhr.send();
    }

    function loadMorePhotos() {
      offset += 4;

      //remove the error message if the user removed all photos on the page and asks to load more
      var main = document.getElementsByTagName('main')[0];

      for (var i = 0; i < main.children.length; ++i) {
        var child = main.children[i];
        if (child.classList.contains('no-photos-error')) {
          main.removeChild(child);
          break;
        }
      }
      getGalleryPhotos();
    }

    </script>
    <script src="js/galleryPopup.js"></script>
  </body>
</html>
