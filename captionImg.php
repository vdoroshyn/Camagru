<?php
	// if (!empty($_POST))
	// 	print_r($_POST);
	// else
	// 	echo "empty";

	if (!empty($_POST['dataUrl'])) {
		$upload_dir = "upload/";
		$img = $_POST['dataUrl'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = $upload_dir . mktime() . ".png";
		$success = file_put_contents($file, $data);
		echo ($success !== false) ? $file : 'There was an error. Please try again later';
	} else {
		echo "An error has occurred";
	}
?>