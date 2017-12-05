<?php

require_once('connectToDatabase.php');
require('config/database.php');
//preparing variables the code will work with
$email = htmlentities($_POST['email']);

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

  $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :Email");
  $stmt->bindParam(':Email', $email);
  $stmt->execute();
  /*
  **for security reasons, the message will always be the same
  **in cases when the email is in the db or not
  */
  if ($stmt->rowCount() == 0) {
    header('Location: checkYourEmail.php');
    die();
  } else {
    //generating a random verification code
    $verif_code = random_int(0, PHP_INT_MAX);
    //updating the user table with verif_code
    $stmt = $pdo->prepare("UPDATE `users`
                   SET `reset_email_code` = :VerifCode
                   WHERE `email` = :Email");
    $stmt->bindParam(':VerifCode', $verif_code);
    $stmt->bindParam(':Email', $email);
    $stmt->execute();
    //sending the link to the email
    $subject = "reset password";
    //setting the email to show html content
    $headers = "MIME-Version: 1.0\r\n"; 
    $headers .= "Content-type: text/html; charset=utf-8\r\n"; 

    //getting the path to the file on the server
    $fullPath = explode('/', $_SERVER['PHP_SELF']);
    $i = count($fullPath) - 2;
    $msg = "To reset your password follow this link: http://localhost:8080/" . "{$fullPath[$i]}" . "/checkingEmailLink.php?code={$verif_code}&email={$email}";

    mail($email, $subject, $msg, $headers);
    header('Location: checkYourEmail.php');
  }
} else {
  echo "no connection with the database<br/>";
  die();
}

?>