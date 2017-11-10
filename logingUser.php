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
		$pswdErrors['errorValue'] = "check the validity of inserted data";
	    $pswdErrors['inputClass'] = "field invalid-field";
	    $pswdErrors['errorClass'] = "error active-error";
	    $usernameErrors['inputClass'] = "field invalid-field";
	} else if ($stmt->rowCount() == 1) {

		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		//if the user's email is not confirmed
		if (password_verify($pswd, $user['password']) && $user['confirmed_email'] != 1) {
			header('Location: enterCode.php');
			die();
		} else if (!password_verify($pswd, $user['password'])) {
			$pswdErrors['errorValue'] = "check the validity of inserted data";
		    $pswdErrors['inputClass'] = "field invalid-field";
		    $pswdErrors['errorClass'] = "error active-error";
		    $usernameErrors['inputClass'] = "field invalid-field";
		}
	}
} else {
	echo "no connection with the database<br/>";
	die();
}

if ($pswdErrors['errorValue'] == "") {
	$_SESSION['id'] = $username;
	header('Location: index.php');//to
}

?>