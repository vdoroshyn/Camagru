<?php 
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if ($pdo) {

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = ?");
	$login = htmlentities($_GET['login']);
	$stmt->execute(array($login));
	if ($stmt->rowCount() > 0) {
		echo "the username <strong>{$_GET['login']}</strong> is already in use<br/>";
	}

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = ?");
	$email = htmlentities($_GET['email']);
	$stmt->execute(array($email));
	if ($stmt->rowCount() > 0) {
		echo "the email <strong>{$_GET['email']}</strong> is already in use<br/>";
	}
	// die();
	// $statement = $pdo->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (:Login, :Email, :Password)");
	// $statement->bindParam(':Login', htmlentities($_GET['login']));
	// $statement->bindParam(':Email', htmlentities($_GET['email']));
	// $statement->bindParam(':Password', htmlentities($_GET['password']));
	// $statement->execute();
} //todo else die
?>
