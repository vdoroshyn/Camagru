<?php

require_once('connectToDatabase.php');
require('config/database.php');
//preparing variables the code will work with
$username   = htmlentities($_POST['username']);
$pswd       = htmlentities($_POST['pswd']);
$repeatPswd = htmlentities($_POST['repeatPswd']);

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

  $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :Username AND `reset_email_code` != -1");
  $stmt->bindParam(':Username', $username);
  $stmt->execute();
  /*
  **for security reasons, the message will always be the same
  **in cases when the email is in the db or not
  */
  if ($stmt->rowCount() == 0) {
    $usernameErrors['inputClass'] = "field invalid-field";
    $pswdErrors['inputClass'] = "field invalid-field";
    $repeatPswdErrors['inputClass'] = "field invalid-field";
    $repeatPswdErrors['errorClass'] = "error active-error";
    $repeatPswdErrors['errorValue'] = "check the validity of inserted data";
  } else {
    //hashing the password
	$pswd_hash = password_hash($pswd, PASSWORD_DEFAULT);
    //updating the user table with the new password and resetting the code to 0
    $stmt = $pdo->prepare("UPDATE `users`
                   SET `password` = :Password, `reset_email_code` = 0
                   WHERE `username` = :Username");
    $stmt->bindParam(':Password', $pswd_hash);
    $stmt->bindParam(':Username', $username);
    $stmt->execute();
    
    header('Location: thankYouPasswordReset.php');
  }
} else {
  echo "no connection with the database<br/>";
  die();
}
