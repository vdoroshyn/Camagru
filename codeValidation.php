<?php

require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `verification_code` = :Code AND `username` = :Username");
	$code = htmlentities($_GET['code']);
	$username = htmlentities($_GET['username']);
	$stmt->bindParam(':Code', $code);
	$stmt->bindParam(':Username', $username);
	$stmt->execute();

	if ($stmt->rowCount() == 0) {
		$codeErrors['errorValue'] = "check the validity of inserted data";
		$codeErrors['inputClass'] = "field invalid-field";
		$codeErrors['errorClass'] = "error active-error";
	}
} else {
	echo "no connection with the database<br/>";
	die();
}

if ($codeErrors['errorValue'] == "") {
	$stmt = $pdo->prepare("UPDATE `users`
						   SET `confirmed_email` = 1, `verification_code` = 0
						   WHERE `username` = :Username");
	$username = htmlentities($_GET['username']);
	$stmt->bindParam(':Username', $username);
	$stmt->execute();
	header('Location: thankYou.php');
}

?>
