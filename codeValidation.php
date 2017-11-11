<?php

require_once('connectToDatabase.php');
require('config/database.php');

//sanitizing variables the code will work with
$code     = htmlentities($_POST['code']);
$username = htmlentities($_POST['username']);

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `verification_code` = :Code AND `username` = :Username");
	$stmt->bindParam(':Code', $code);
	$stmt->bindParam(':Username', $username);
	$stmt->execute();

	if ($stmt->rowCount() == 0) {
		$fieldErrors['errorValue'] = "check the validity of inserted data";
		$fieldErrors['inputClass'] = "field invalid-field";
		$fieldErrors['errorClass'] = "error active-error";
	}
} else {
	echo "no connection with the database<br/>";
	die();
}

if ($fieldErrors['errorValue'] == "") {
	$stmt = $pdo->prepare("UPDATE `users`
						   SET `confirmed_email` = 1, `verification_code` = 0
						   WHERE `username` = :Username");
	$stmt->bindParam(':Username', $username);
	$stmt->execute();
	header('Location: thankYou.php');
}

?>
