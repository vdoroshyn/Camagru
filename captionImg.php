<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

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
	$username = $_SESSION['id'];
	$randFileName = uniqid($username, true);
	$fileName = $upload_dir . $randFileName . ".png";
	/*
	**adding the file name and the user to the database;
	*/
	$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	if ($pdo) {

		$stmt = $pdo->prepare("INSERT INTO `photos` (`username`, `photo_name`) VALUES (:Username, :FileName)");
		$stmt->bindParam(':Username', $username);
		$stmt->bindParam(':FileName', $fileName);
		$stmt->execute();

	} else {
		echo "no connection with the database<br/>";
		die();
	}
	/*
	**creating a file on the server;
	*/
	$success = file_put_contents($fileName, $data);
	echo ($success !== false) ? $fileName : 'There was an error. Please try again later';
} else {
	echo "An error has occurred";
}
?>