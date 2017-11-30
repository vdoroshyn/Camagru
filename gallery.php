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
            photo.addEventListener('click', createPopup, true);
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

// rename this function and split it into several!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    function createPopup() {
      let body = document.getElementsByTagName('body')[0];

      var blurBackground = document.createElement('div');

      blurBackground.classList.add('blurred-background');
      blurBackground.addEventListener('click', removeBlur, false);

      var container = document.createElement('div');
      container.classList.add('photo-place');
      blurBackground.appendChild(container);
      //creating the page structure
      var aside = document.createElement('aside');
      var main = document.createElement('main');
      main.classList.add('gallery-popup-main');
      aside.classList.add('gallery-popup-aside');

      container.appendChild(main);
      container.appendChild(aside);


      var photo = document.createElement('img');
      photo.src = "userImages/vdoroshy5a1d76399c53c7.52486228.png";
      photo.classList.add('gallery-popup-img');
      var btnDiv = document.createElement('div');
      btnDiv.classList.add('gallery-popup-btn-div');



      var likes = document.createElement('button');
      likes.classList.add('gallery-popup-buttons');
      likes.textContent = "0 likes";

      var delPhoto = document.createElement('button');  
      delPhoto.classList.add('gallery-popup-buttons');
      delPhoto.textContent = "delete this photo";

      btnDiv.appendChild(likes);
      btnDiv.appendChild(delPhoto);
      main.appendChild(photo);
      main.appendChild(btnDiv);


      var comment = document.createElement('div');
      var newComment = document.createElement('textarea')
      var btn = document.createElement('button');

      comment.classList.add('gallery-popup-comments');
      newComment.classList.add('gallery-popup-new-comment');
      btn.classList.add('gallery-popup-submit-comment');
      btn.textContent = "submit";

      newComment.name = "newComment";
      newComment.maxLength = "1000";
      newComment.cols = "40";
      newComment.rows = "30";
      aside.appendChild(comment);
      aside.appendChild(newComment);
      aside.appendChild(btn);


      body.appendChild(blurBackground);
    }

    function removeBlur(event) {

      console.log(event.target);
      if (!event.target.classList.contains('blurred-background')) {
        return;
      }
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
