<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	//getting the commeter id
	$loggedUser = $_SESSION['id'];
	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :LoggedUser");
	$stmt->bindParam(':LoggedUser', $loggedUser);
	$stmt->execute();
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$userId = $row['id'];
	}

	//getting the photo id here
	$path = $_POST['path'];
	$stmt = $pdo->prepare("SELECT * FROM `photos` WHERE `photo_name` = :Name");
	$stmt->bindParam(':Name', $path);
	$stmt->execute();
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$photoId = $row['id'];
	}
	$stmt = $pdo->prepare("SELECT * FROM `likes` WHERE `user_id` = $userId AND `photo_id` = $photoId");
	$stmt->execute();
	/*
	**if something is found in the db - the user had the like on this photo
	**so it is a dislike, if not - it is a like
	*/
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$stmt = $pdo->prepare("DELETE FROM `likes` WHERE `user_id` = $userId AND `photo_id` = $photoId");
		$stmt->execute();
		echo "dislike";
	} else {
		$stmt = $pdo->prepare("INSERT INTO `likes` (`user_id`, `photo_id`) VALUES ($userId, $photoId)");
		$stmt->execute();
		echo "like";
	}

} else {
	echo "no connection with the database<br/>";
	die();
}

?>