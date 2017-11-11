<?php 
require_once('connectToDatabase.php');
require('config/database.php');

//preparing variables the code will work with
$username   = htmlentities($_POST['username']);
$email      = htmlentities($_POST['email']);
$pswd       = htmlentities($_POST['password']);
$repeatPswd = htmlentities($_POST['repeatPassword']);

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

	$usernameErrors['inputValue']   = $username;
	$emailErrors['inputValue']      = $email;
	$pswdErrors['inputValue']       = $pswd;
	$repeatPdwdErrors['inputValue'] = $repeatPswd;

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :Username");
	$stmt->bindParam(':Username', $username);
	$stmt->execute();
	//filling in html with necessary errors and classes in case of error
	if ($stmt->rowCount() > 0) {
		$usernameErrors['errorValue'] = "the username is already taken";
		$usernameErrors['errorClass'] = "error active-error";
		$usernameErrors['inputClass'] = "field invalid-field";
	}

	$stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :Email");
	$stmt->bindParam(':Email', $email);
	$stmt->execute();
	//filling in html with necessary errors and classes in case of error
	if ($stmt->rowCount() > 0) {
		$emailErrors['errorValue'] = "the email is already taken";
		$emailErrors['errorClass'] = "error active-error";
		$emailErrors['inputClass'] = "field invalid-field";
	}

} else {
	echo "no connection with the database<br/>";
	die();
}

if ($usernameErrors['errorValue'] == "" && $emailErrors['errorValue'] == "") {
	$stmt = $pdo->prepare("INSERT INTO `users` (`username`, `email`, `password`, `verification_code`) VALUES (:Username, :Email, :Password, :VerifCode)");
	//variables were sanitized in the beginning of the file

	//hashing the password
	$pswd_hash = password_hash($pswd, PASSWORD_DEFAULT);
	//generating a random verification code
	$verif_code = random_int(0, PHP_INT_MAX);
	//binding params
	$stmt->bindParam(':Username', $username);
	$stmt->bindParam(':Email', $email);
	$stmt->bindParam(':Password', $pswd_hash);
	$stmt->bindParam(':VerifCode', $verif_code);
	$stmt->execute();
	//sending the code to the email
	$subject = "Camagru registration";
	$msg = "please copy this code <" . $verif_code . "> and paste it in on the website";
	mail($email, $subject, $msg);
	//clearing input values for the fields to be empty
	$usernameErrors['inputValue']   = "";
	$emailErrors['inputValue']      = "";
	$pswdErrors['inputValue']       = "";
	$repeatPdwdErrors['inputValue'] = "";
	//clearing the POST array
	header('Location: enterCode.php');
	die();
}
?>
