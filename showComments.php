<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$id = htmlentities($_GET['id']);

	$stmt = $pdo->prepare("SELECT * FROM `comments` WHERE `photo_id` = :Id ORDER BY `time_stamp` DESC");
	$stmt->bindParam(':Id', $id);
	$stmt->execute();
	//creating an empty array to store every result from the database search
	$comments = [];
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$comments[] = $row['comment_text'];
	}
	$success = json_encode($comments);
	echo $success ? $success : '';
} else {
	echo "no connection with the database<br/>";
	die();
}

?>