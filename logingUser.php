<?php 

require_once('connectToDatabase.php');
require('config/database.php');
//getting and sanitizing variables to work with them throughout the whole file
$username = htmlentities($_POST['username']);
$pswd = htmlentities($_POST['pswd']);

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :Username");
	$stmt->bindParam(':Username', $username);
	$stmt->execute();
	//if the username is not in the database
	if ($stmt->rowCount() == 0) {
		$fieldErrors['errorValue'] = "check the validity of inserted data";
	    $fieldErrors['inputClass'] = "field invalid-field";
	    $fieldErrors['errorClass'] = "error active-error";
	} else if ($stmt->rowCount() == 1) {

		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		//if the user's email is not confirmed
		if (password_verify($pswd, $user['password']) && $user['confirmed_email'] != 1) {
			header('Location: enterCode.php');
			die();//might need to resend the code too
		} else if (!password_verify($pswd, $user['password'])) {
			$fieldErrors['errorValue'] = "check the validity of inserted data";
		    $fieldErrors['inputClass'] = "field invalid-field";
		    $fieldErrors['errorClass'] = "error active-error";
		}
	}
} else {
	echo "no connection with the database<br/>";
	die();
}

if ($fieldErrors['errorValue'] == "") {
	$_SESSION['id'] = $username;
	header('Location: index.php');
}

?>