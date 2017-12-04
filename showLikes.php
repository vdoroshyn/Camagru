<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$photo_id = htmlentities($_GET['id']);

	$stmt = $pdo->prepare("SELECT * FROM `likes` WHERE `photo_id` = :PhotoId");
	$stmt->bindParam(':PhotoId', $photo_id);
	$stmt->execute();

	echo $stmt->rowCount();
} else {
	echo "no connection with the database<br/>";
	die();
}

?>
