<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$username = $_SESSION['id'];
	$photos = [];
	$stmt = $pdo->prepare("SELECT `photo_name` FROM `photos` WHERE `username` = :Username ORDER BY `time_stamp` DESC");
	$stmt->bindParam(':Username', $username);
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$photos[] = $row['photo_name'];
	}
	$success = json_encode($photos);
	echo $success ? $success : '';
} else {
	echo "no connection with the database<br/>";
	die();
}

?>