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
  aside.appendChild(newComment);
  aside.appendChild(btn);


  body.appendChild(blurBackground);
}

function removeBlur(event) {

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

function addComment() {
  var input = document.querySelector('.gallery-popup-new-comment');
  //getting the url and cutting it to get the img name
  var path = document.getElementsByTagName('img')[0].src;
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
      comments.appendChild(elem);
    }
  }
  xhr.open("POST", "addComment.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("input=" + input.value + "&path=" + path);
}

