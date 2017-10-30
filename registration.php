<?php 
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if ($pdo) {

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :Login");
	$login = htmlentities($_GET['login']);
	$stmt->bindParam(':Login', $login);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		$credentials['login'] = "the username is already in use";
		// echo "the username <strong>{$_GET['login']}</strong> is already in use<br/>";
	}

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :Email");
	$email = htmlentities($_GET['email']);
	$stmt->bindParam(':Email', $email);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		$credentials['email'] = "the email is already in use";
		// echo "the email <strong>{$_GET['email']}</strong> is already in use<br/>";
	}
	// die();
	
} else {
	echo "no connection with the database<br/>";
	die();
}
if ($credentials['login'] == "" && $credentials['email'] == "") {
	$stmt = $pdo->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (:Login, :Email, :Password)");
	//sanitizing the user input
	$login = htmlentities($_GET['login']);
	$email = htmlentities($_GET['email']);
	$pswd = htmlentities($_GET['password']);
	//binding params
	$stmt->bindParam(':Login', $login);
	$stmt->bindParam(':Email', $email);
	$stmt->bindParam(':Password', $pswd);
	$stmt->execute();
}
?>
