<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

//in case the user is not logged in
if (!isset($_SESSION['id'])) {
	echo "you are not logged in";
	return;
}

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	
	$loggedUser = htmlentities($_SESSION['id']);
	
	//getting the photo information here
	$photoId = htmlentities($_POST['id']);
	$stmt = $pdo->prepare("SELECT * FROM `photos` WHERE `id` = :PhotoId");
	$stmt->bindParam(':PhotoId', $photoId);
	$stmt->execute();
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$username = $row['username'];
		$path = $row['photo_name'];
	}
	//if the user is not the photo owner
	if ($loggedUser != $username) {
		echo "you are not permitted to delete this photo";
		return;
	}
	/*
	**need to clear all the information about the photo
	**likes, comments, and photos tables as well as the photo in the folder
	*/
	if (file_exists($path)) {
		unlink($path);
	}
	$stmt = $pdo->prepare("DELETE FROM `photos` WHERE `id` = :PhotoId");
	$stmt->bindParam(':PhotoId', $photoId);
	$stmt->execute();

	$stmt = $pdo->prepare("DELETE FROM `likes` WHERE `photo_id` = :PhotoId");
	$stmt->bindParam(':PhotoId', $photoId);
	$stmt->execute();

	$stmt = $pdo->prepare("DELETE FROM `comments` WHERE `photo_id` = :PhotoId");
	$stmt->bindParam(':PhotoId', $photoId);
	$stmt->execute();
	
	echo "success";

} else {
	echo "no connection with the database<br/>";
	die();
}

?>
