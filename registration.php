<?php 
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$inputValue['login'] = $_GET['login'];
	$inputValue['email'] = $_GET['email'];
	$inputValue['pswd'] = $_GET['password'];
	$inputValue['repeatPswd'] = $_GET['repeatPassword'];

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :Login");
	$login = htmlentities($_GET['login']);
	$stmt->bindParam(':Login', $login);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		$errorValue['login'] = "the username is already in use";
		$errorClass['login'] = "error active-error";
		$inputClass['login'] = "field invalid-field";
	}

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :Email");
	$email = htmlentities($_GET['email']);
	$stmt->bindParam(':Email', $email);
	$stmt->execute();
	if ($stmt->rowCount() > 0) {
		$errorValue['email'] = "the email is already in use";
		$errorClass['email'] = "error active-error";
		$inputClass['email'] = "field invalid-field";
	}
	
} else {
	echo "no connection with the database<br/>";
	die();
}
if ($errorValue['login'] == "" && $errorValue['email'] == "") {
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
	//clearing input values for the fields to be empty
	$inputValue['login'] = "";
	$inputValue['email'] = "";
	$inputValue['pswd'] = "";
	$inputValue['repeatPswd'] = "";
	//clearing the POST array
	header('Location: index.php');
	die();
}
?>
