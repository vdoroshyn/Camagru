<?php

if (!empty($_GET['code']) && !empty($_GET['email'])) {

	require_once('connectToDatabase.php');
	require('config/database.php');

	//preparing variables the code will work with
	$email = htmlentities($_GET['email']);
	$code = htmlentities($_GET['code']);

	$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	if ($pdo) {

		$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `reset_email_code` = :Code AND `email` = :Email");
		$stmt->bindParam(':Code', $code);
		$stmt->bindParam(':Email', $email);
		$stmt->execute();
//todo 0 the code
		if ($stmt->rowCount() != 0) {
			header('Location: resetPassword.php');
			die();
		}
	} else {
		echo "no connection with the database<br/>";
		die();
	}
}
/*
**the page will redirect before this occurs
**that's why no if
*/
header('Location: index.php');
die();

?>
