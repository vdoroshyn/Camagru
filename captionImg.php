<?php
	session_start();
	// if (!empty($_POST))
	// 	print_r($_POST);
	// else
	// 	echo "empty";

	if (!empty($_POST['dataUrl'])) {

		$upload_dir = "userImages/";
		//checking whether the directory exists and creatin one if not
		if(!is_dir($upload_dir)) {
			mkdir($upload_dir);
		}
		$img = $_POST['dataUrl'];
		$img = str_replace('data:image/png;base64,', '', $img);
		/*
		**If you want to save data that is derived from a Javascript canvas.toDataURL() function,
		**you have to convert blanks into plusses. If you do not do that, the decoded data is corrupted.
		*/
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		/*
		**creating a random filename with the username and uniqid();
		*/
		$prefix = $_SESSION['id'];
		$randFileName = uniqid($prefix, true);
		$fileName = $upload_dir . $randFileName . ".png";
		/*
		**creating a file on the server;
		*/
		$success = file_put_contents($fileName, $data);
		echo ($success !== false) ? $fileName : 'There was an error. Please try again later';
	} else {
		echo "An error has occurred";
	}
?>