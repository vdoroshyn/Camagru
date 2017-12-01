<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	//getting the offset param and sanitizing it
	//after that cast to an int is necessary
	$offset = htmlentities($_GET['offset']);
	$offset = intval($offset);
	$username = $_SESSION['id'];
	$photos = [];
	//no bindParam because offset and limit are not parts of standard MySQL
	$stmt = $pdo->prepare("SELECT * FROM `photos` ORDER BY `time_stamp` DESC LIMIT 4 OFFSET {$offset}");
	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$photos[] = $row['photo_name'];
		$photos[] = $row['id'];
	}
	$success = json_encode($photos);
	echo $success ? $success : '';
} else {
	echo "no connection with the database<br/>";
	die();
}

?>