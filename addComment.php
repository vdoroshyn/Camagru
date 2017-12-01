<?php
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

$loggedUser = $_SESSION['id'];

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	// $stmt = $pdo->prepare("INSERT INTO `comments` (`photo_id`, `comment_text`, `commenter_id`, `owner_id`,)
	// 						VALUES (:PhotoId, :CommentText, :CommenterId, :OwnerId)");
	// $stmt->bindParam(':PhotoId', 7);
	// $stmt->bindParam(':CommentText', "huy nana");
	// $stmt->bindParam(':CommenterId', 1);
	// $stmt->bindParam(':OwnerId', 1);
	// $stmt->execute();


	// $success = json_encode($photos);
	// echo $success ? $success : '';
	echo "huy nana";
} else {
	echo "no connection with the database<br/>";
	die();
}

?>
