function addPoro(child, num) {
	child.style.position = 'static';
	var imgBox = document.querySelector('.img-boxes').children[num];
	imgBox.appendChild(child);
}

function poroMove(event) {
	//checking whether poro are allowed to move
	var isAllowedToMove = document.querySelector('.camera-place');
	if (isAllowedToMove.children[0].id != "stream" && isAllowedToMove.children[0].id != "uploadedImg") {
		return;
	}
	//making the button clickable
	document.querySelector('.photo-button').disabled = false;
	//getting the variable
	var poro = document.getElementById(event.target.id);
	var elem = document.querySelector('.video-attr');
	var streamDiv = document.querySelector('.camera-place');
	var streamDivCoords = streamDiv.getBoundingClientRect();
	//checking whether other poros are not in position
	for (var i = 0; i < elem.children.length; ++i) {
		var child = elem.children[i];

		switch(child.id) {
			case 'poro1':
			{
				addPoro(child, 0);
				break;
			}
			case 'poro2':
			{
				addPoro(child, 1);
				break;
			}
			case 'poro3':
			{
				addPoro(child, 2);
				break;
			}
		}

		// if (child.id == "poro1") {
		// 	child.style.position = 'static';
		// 	var imgBox = document.querySelector('.img-boxes').children[0];
		// 	imgBox.appendChild(child);
		// } else if (child.id == "poro2") {
		// 	child.style.position = 'static';
		// 	var imgBox = document.querySelector('.img-boxes').children[1];
		// 	imgBox.appendChild(child);
		// } else if (child.id == "poro3") {
		// 	child.style.position = 'static';
		// 	var imgBox = document.querySelector('.img-boxes').children[2];
		// 	imgBox.appendChild(child);
		// }
	}
	//removing html drag
	poro.ondragstart = function() {
  		return false;
	};

	poro.style.position = 'absolute';
	moveAt(event);
	elem.appendChild(poro);
	//move function
	function moveAt(event) {
		poro.style.left = event.pageX - poro.offsetWidth / 2 + 'px';
		poro.style.top = event.pageY - poro.offsetHeight / 2 + 'px';
		var left = parseInt(poro.style.left);
		var top = parseInt(poro.style.top);
		var right = left + 150;
		var bottom = top + 150;

		if (left < streamDivCoords.left) {
			poro.style.left = streamDivCoords.left + 'px';
		}
		if (streamDivCoords.top > top) {
			poro.style.top = streamDivCoords.top + 'px';
		}
		if (streamDivCoords.right < right) {
			poro.style.left = (streamDivCoords.right - 150) + 'px'; 
		}
		if (streamDivCoords.bottom < bottom) {
			poro.style.top = (streamDivCoords.bottom - 150) + 'px'; 
		}
	}

	document.onmousemove = function(event) {
		moveAt(event);
	}

	onmouseup = function() {
		document.onmousemove = null;
		poro.onmouseup = null;
	}
}
/*
function getThumbnails() {
	//showing thumbnails of previous taken photos
	var aside = document.getElementsByTagName('aside')[0];
	while (aside.firstChild) {
    	aside.removeChild(aside.firstChild);
	}
	// document.querySelector('.booth-aside').style.overflow = "auto";
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
}
*/
function getThumbnails() {
	//showing thumbnails of previous taken photos
	var aside = document.getElementsByTagName('aside')[0];
	while (aside.firstChild) {
    	aside.removeChild(aside.firstChild);
	}
	// document.querySelector('.booth-aside').style.overflow = "auto";
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
	    var images = JSON.parse(this.responseText);

	    for(var i = 0; i < images.length; ++i) {
	  	  var thumbnail = document.createElement('div');
	      thumbnail.style.backgroundImage = "url(" + images[i] + ")";
	      thumbnail.classList.add('thumbnail');
	      aside.appendChild(thumbnail);
	    }
	  }
	}
	xhr.open("GET", "getThumbnails.php", true);
	xhr.send();
}

function saveImg() {
	var imgData = document.getElementById('canvas');
	var dataUrl = canvas.toDataURL();

	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {        
	    console.log(this.responseText);
	    window.location.reload(true);
	  }
	}
	xhr.open("POST", "captionImg.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("dataUrl=" + dataUrl);
}