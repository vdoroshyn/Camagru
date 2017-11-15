var poro1 = document.getElementById('poro1');
var elem = document.querySelector('.video-attr');
var elemCoords = elem.getBoundingClientRect();

poro1.onmousedown = function(event) {
	//removing doubling of the img
	poro1.ondragstart = function() {
  		return false;
	};

	poro1.style.position = 'absolute';
	moveAt(event);
	elem.appendChild(poro1);
	poro1.style.zIndex = 1000;

	function moveAt(event) {
		poro1.style.left = event.pageX - poro1.offsetWidth / 2 + 'px';
		poro1.style.top = event.pageY - poro1.offsetHeight / 2 + 'px';
		var left = parseInt(poro1.style.left);
		var top = parseInt(poro1.style.top);
		var right = left + 150;
		var bottom = top + 150;

		if (left < elemCoords.left) {
			poro1.style.left = elemCoords.left + 'px';
		}
		if (elemCoords.top > top) {
			poro1.style.top = elemCoords.top + 'px';
		}
		if (elemCoords.right < right) {
			poro1.style.left = (elemCoords.right - 150) + 'px'; 
		}
		if (elemCoords.bottom < bottom) {
			poro1.style.top = (elemCoords.bottom - 150) + 'px'; 
		}
	}

	document.onmousemove = function(event) {
		moveAt(event);
	}

	poro1.onmouseup = function() {
		document.onmousemove = null;
		poro1.onmouseup = null;
	}
}



var poro2 = document.getElementById('poro2');

poro2.onmousedown = function(event) {

	for (var i = 0; i < elem.children.length; ++i) {
		if (elem.children[i] == "poro1") {
			var imgBoxes = document.querySelector('.img-boxes');
			imgBoxes.children[0].appendChild(elem.children[i]);
			elem.removeChild(elem.children[i]);
		}
	}

	//removing doubling of the img
	poro2.ondragstart = function() {
  		return false;
	};

	poro2.style.position = 'absolute';
	moveAt(event);
	elem.appendChild(poro2);
	poro2.style.zIndex = 1000;

	function moveAt(event) {
		poro2.style.left = event.pageX - poro2.offsetWidth / 2 + 'px';
		poro2.style.top = event.pageY - poro2.offsetHeight / 2 + 'px';
		var left = parseInt(poro2.style.left);
		var top = parseInt(poro2.style.top);
		var right = left + 150;
		var bottom = top + 150;

		if (left < elemCoords.left) {
			poro2.style.left = elemCoords.left + 'px';
		}
		if (elemCoords.top > top) {
			poro2.style.top = elemCoords.top + 'px';
		}
		if (elemCoords.right < right) {
			poro2.style.left = (elemCoords.right - 150) + 'px'; 
		}
		if (elemCoords.bottom < bottom) {
			poro2.style.top = (elemCoords.bottom - 150) + 'px'; 
		}
	}

	document.onmousemove = function(event) {
		moveAt(event);
	}

	poro2.onmouseup = function() {
		document.onmousemove = null;
		poro2.onmouseup = null;
	}
}
/*
** I do not need it for now
var poro3 = document.getElementById('poro3');

poro3.onmousedown = function(event) {
	//removing doubling of the img
	poro3.ondragstart = function() {
  		return false;
	};

	poro3.style.position = 'absolute';
	moveAt(event);
	elem.appendChild(poro3);
	poro3.style.zIndex = 1000;

	function moveAt(event) {
		poro3.style.left = event.pageX - poro3.offsetWidth / 2 + 'px';
		poro3.style.top = event.pageY - poro3.offsetHeight / 2 + 'px';
		var left = parseInt(poro3.style.left);
		var top = parseInt(poro3.style.top);
		var right = left + 150;
		var bottom = top + 150;

		if (left < elemCoords.left) {
			poro3.style.left = elemCoords.left + 'px';
		}
		if (elemCoords.top > top) {
			poro3.style.top = elemCoords.top + 'px';
		}
		if (elemCoords.right < right) {
			poro3.style.left = (elemCoords.right - 150) + 'px'; 
		}
		if (elemCoords.bottom < bottom) {
			poro3.style.top = (elemCoords.bottom - 150) + 'px'; 
		}
	}

	document.onmousemove = function(event) {
		moveAt(event);
	}

	poro3.onmouseup = function() {
		document.onmousemove = null;
		poro3.onmouseup = null;
	}
}
*/
// poro3.onmousedown = function(event) {
// 	//removing doubling of the img
// 	poro3.ondragstart = function() {
//   		return false;
// 	};

// 	poro3.style.position = 'absolute';
// 	moveAt(event);
// 	elem.appendChild(poro3);
// 	poro3.style.zIndex = 1000;

// 	function moveAt(event) {
// 		poro3.style.left = event.pageX - poro3.offsetWidth / 2 + 'px';
// 		poro3.style.top = event.pageY - poro3.offsetHeight / 2 + 'px';
// 	}

// 	document.onmousemove = function(event) {
// 		moveAt(event);
// 	}

// 	poro3.onmouseup = function() {
// 		document.onmousemove = null;
// 		poro3.onmouseup = null;
// 	}
// }

// function allowDrop(event) {
// 	event.preventDefault();
// }

// function drag(event) {
// 	event.dataTransfer.setData("text", event.target.id);
// }

// function drop(event) {
// 	event.preventDefault();
// 	var data = event.dataTransfer.getData("text");
// 	event.target.appendChild(document.getElementById(data));
// }
