function poroMove(event) {
	//getting the variable
	var poro = document.getElementById(event.target.id);
	var elem = document.querySelector('.video-attr');
	var elemCoords = elem.getBoundingClientRect();
	//checking whether other poros are not in position
	for (var i = 0; i < elem.children.length; ++i) {
		var child = elem.children[i];
		if (child.id == "poro1") {
			child.style.position = 'static';
			var imgBox = document.querySelector('.img-boxes').children[0];
			imgBox.appendChild(child);
		} else if (child.id == "poro2") {
			child.style.position = 'static';
			var imgBox = document.querySelector('.img-boxes').children[1];
			imgBox.appendChild(child);
		} else if (child.id == "poro3") {
			child.style.position = 'static';
			var imgBox = document.querySelector('.img-boxes').children[2];
			imgBox.appendChild(child);
		}
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

		if (left < elemCoords.left) {
			poro.style.left = elemCoords.left + 'px';
		}
		if (elemCoords.top > top) {
			poro.style.top = elemCoords.top + 'px';
		}
		if (elemCoords.right < right) {
			poro.style.left = (elemCoords.right - 150) + 'px'; 
		}
		//bottom limit is calculated thru top
		if (elemCoords.top + 480 < bottom) {
			poro.style.top = (elemCoords.top + 480 - 150) + 'px'; 
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
