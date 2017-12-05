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
		$commenterId = $row['id'];
	}
	//getting the photo id here
	$path = $_POST['path'];
	$stmt = $pdo->prepare("SELECT * FROM `photos` WHERE `photo_name` = :Name");
	$stmt->bindParam(':Name', $path);
	$stmt->execute();
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$photoId = $row['id'];
		$owner = $row['username'];
	}
	//getting the owner id
	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :Owner");
	$stmt->bindParam(':Owner', $owner);
	$stmt->execute();
	if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$ownerId = $row['id'];
		$ownerEmail = $row['email'];
		$notifications = $row['notifications'];
	}

	//sanitizing the comment
	$comment = $_POST['input'];
	//appending the user to the comment
	$comment = $loggedUser . ": " . $comment;

	$stmt = $pdo->prepare("INSERT INTO `comments` (`photo_id`, `comment_text`, `commenter_id`, `owner_id`)
							VALUES (:PhotoId, :CommentText, :CommenterId, :OwnerId)");
	$stmt->bindParam(':PhotoId', $photoId);
	$stmt->bindParam(':CommentText', $comment);
	$stmt->bindParam(':CommenterId', $commenterId);
	$stmt->bindParam(':OwnerId', $ownerId);
	$stmt->execute();

	if ($notifications == 1) {
		//message via the email when there is a new comment only when the notifications property allows it
		$subject = "you have a new comment";
		//getting the path to the file on the server
		$fullPath = explode('/', $_SERVER['PHP_SELF']);
		$i = count($fullPath) - 2;
		$msg = "There is a new comment on one of your photos. Check it http://localhost:8080/" . "{$fullPath[$i]}" . "/gallery.php"
		. " If you do not want to receive notifications - follow this link: http://localhost:8080/" . "{$fullPath[$i]}"
		. "/turnOffNotifications.php?id={$ownerId}";
		mail($ownerEmail, $subject, $msg);
	}
	echo $comment;
} else {
	echo "no connection with the database<br/>";
	die();
}
?>
