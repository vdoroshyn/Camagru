var poro1 = document.getElementById('poro1');
var video = document.querySelector('video');

poro1.onmousedown = function(e) {
	poro1.ondragstart = function() {
  		return false;
	};
	poro1.style.position = 'absolute';
	moveAt(e);

	poro1.style.zIndex = 1000;

	function moveAt(e) {
		poro1.style.left = e.pageX - poro1.offsetWidth / 2 + 'px';
		poro1.style.right = e.pageY - poro1.offsetHeight / 2 + 'px';
	}

	document.onmousemove = function(e) {
		moveAt(e);
	}

	poro1.onmouseup = function() {
		document.onmousemove = null;
		poro1.onmouseup = null;
	}
}