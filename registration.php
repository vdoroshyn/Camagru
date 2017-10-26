<?php 
session_start();
require_once('connectToDatabase.php');
require('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);

if ($pdo) {

	// $select = $pdo->prepare("SELECT * FROM `users`");
	$result = $pdo->query("SELECT * FROM `users`");
	foreach ($result as $row) {
		if ($_GET['login'] === $row[0]) {
			echo "the username <strong>{$_GET['login']}</strong> is already in use<br/>";
		}
		if ($_GET['email'] === $row[1]) {
			echo "the email <strong>{$_GET['email']}</strong> is already in use<br/>";
		}
		// echo "$row[0] - $row[1] - $row[2] - $row[3] - $row[4]";
		// echo "<br/>";
	}
	die();

	$statement = $pdo->prepare("INSERT INTO `users` (`username`, `email`, `password`) VALUES (:Login, :Email, :Password)");
	$statement->bindParam(':Login', htmlentities($_GET['login']));
	$statement->bindParam(':Email', htmlentities($_GET['email']));
	$statement->bindParam(':Password', htmlentities($_GET['password']));
	$statement->execute();
}
header("Location: index.php");
die();

?>
