// rename this function and split it into several!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
function createPopup(event) {
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
  photo.src = event.target.src;
  photo.dataset.id = event.target.dataset.id;
  photo.classList.add('gallery-popup-img');
  photo.addEventListener('dblclick', likeDislike, true);
  var btnDiv = document.createElement('div');
  btnDiv.classList.add('gallery-popup-btn-div');



  var likes = document.createElement('button');
  likes.classList.add('gallery-popup-buttons');
  likes.addEventListener('click', likeDislike, true);
  showLikes(likes, photo.dataset.id);

  var delPhoto = document.createElement('button');  
  delPhoto.classList.add('gallery-popup-buttons');
  delPhoto.textContent = "delete this photo";
  //passing the photo id as param
  delPhoto.addEventListener('click', function() { deletePhoto(photo.dataset.id); }, true);

  btnDiv.appendChild(likes);
  btnDiv.appendChild(delPhoto);
  main.appendChild(photo);
  main.appendChild(btnDiv);


  var comments = document.createElement('div');
  var newComment = document.createElement('textarea')
  var btn = document.createElement('button');

  comments.classList.add('gallery-popup-comments');
  newComment.classList.add('gallery-popup-new-comment');
  btn.classList.add('gallery-popup-submit-comment');
  btn.addEventListener('click', addComment, true);
  btn.textContent = "submit";

  newComment.name = "newComment";
  newComment.maxLength = "1000";
  aside.appendChild(comments);
  showComments(comments, photo.dataset.id);
  aside.appendChild(newComment);
  aside.appendChild(btn);

  body.appendChild(blurBackground);
}

function showComments(parent, id) {

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var comments = JSON.parse(this.responseText);

      for(var i = 0; i < comments.length; ++i) {
        var div = document.createElement('div');
        div.classList.add('gallery-popup-old-comment');
        div.textContent = comments[i];
        parent.appendChild(div);
      }
    }
  }
  xhr.open("GET", "showComments.php?id=" + id, true);
  xhr.send();
}

function showLikes(parent, id) {

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      parent.textContent = this.responseText + " likes";
    }
  }
  xhr.open("GET", "showLikes.php?id=" + id, true);
  xhr.send();
}

function removePopup(event) {
  let body = document.getElementsByTagName('body')[0];

  for (let i = 0; i < body.children.length; ++i) {
    let child = body.children[i];
    if (child.tagName === "DIV") {
      body.removeChild(child);
    }
  }
}

function removeBlur(event) {

  if (!event.target.classList.contains('blurred-background')) {
    return;
  }
  removePopup();
}

function addComment() {
  var popup = document.querySelector('.blurred-background');
  var input = popup.querySelector('.gallery-popup-new-comment');
  //getting the url and cutting it to get the img name
  var path = popup.getElementsByTagName('img')[0].src;
  var path = "userImages/" + path.split('/').pop();

  if (input.value == "") {
    return;
  }
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var comments = document.querySelector('.gallery-popup-comments');

      var elem = document.createElement('div');
      elem.classList.add('gallery-popup-old-comment');
      elem.textContent = this.responseText;
      //making the textarea blank
      input.value = "";
      comments.insertBefore(elem, comments.firstChild);
    }
  }
  xhr.open("POST", "addComment.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("input=" + input.value + "&path=" + path);
}

function likeDislike() {
  var popup = document.querySelector('.blurred-background');
  //getting the url and cutting it to get the img name
  var path = popup.getElementsByTagName('img')[0].src;
  var path = "userImages/" + path.split('/').pop();

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var likeBtn = popup.getElementsByTagName('button')[0];
      var num = parseInt(likeBtn.textContent);
      if (this.responseText === "like") {
        num += 1;
      } else if (this.responseText === "dislike") {
        num -= 1;
      }
      likeBtn.textContent = num + " likes";
    }
  }
  xhr.open("POST", "likeDislike.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("path=" + path);
}

function removePhotoFromGallery(id) {
  var images = document.querySelectorAll('.gallery-photos');
  for (var i = 0; i < images.length; i++) {
    if (images[i].dataset.id === id) {
      images[i].remove();
      break ;
    }
  }
}

function deletePhoto(id) {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText !== "success") {
        alert(this.responseText);
        return;
      }
      removePopup();
      removePhotoFromGallery(id);
    }
  }
  xhr.open("POST", "deletePhoto.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("id=" + id);
}
