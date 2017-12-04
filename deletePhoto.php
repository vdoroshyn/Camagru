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

	
	$loggedUser = $_SESSION['id'];
	
	//getting the photo information here
	$photoId = $_POST['id'];
	$stmt = $pdo->prepare("SELECT * FROM `photos` WHERE `id` = :PhotoId");
	$stmt->bindParam(':PhotoId', $photoId);
	$stmt->execute();
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$username = $row['username'];
	}
	//if the user is not the photo owner
	if ($loggedUser != $username) {
		echo "you are not permitted to delete this photo";
		return;
	}
	$stmt = $pdo->prepare("DELETE FROM `photos` WHERE `id` = :PhotoId AND `username` = :Username");
	$stmt->bindParam(':PhotoId', $photoId);
	$stmt->bindParam(':Username', $username);
	$stmt->execute();
	echo "success";

} else {
	echo "no connection with the database<br/>";
	die();
}

?>

<!-- DELETE EVERYTHING CONNETCTED WITH THE PHOTO (likes, comments, the image from the folder) -->