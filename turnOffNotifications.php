<?php
require_once('connectToDatabase.php');
require('config/database.php');
//preparing the variable the code will work with
$id = htmlentities($_GET['id']);

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {

  $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :Id");
  $stmt->bindParam(':Id', $id);
  $stmt->execute();
  
  if ($stmt->rowCount() == 1) {
    $stmt = $pdo->prepare("UPDATE `users` SET `notifications` = 0 WHERE `id` = :Id");
    $stmt->bindParam(':Id', $id);
    $stmt->execute();
    echo "success";
  } else {
    echo "there was an error";
  }
} else {
  echo "no connection with the database<br/>";
  die();
}
