<html>
<body>

<?php 
session_start();
include('connectToDatabase.php');
include('config/database.php');

$pdo = returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD);
if ($pdo) {
	$id = NULL;

	$statement = $pdo->prepare("INSERT INTO `users` VALUES(:Login, :Email, :Password, :ID)");
	$statement->bindParam(':Login', $_GET['login']);
	$statement->bindParam(':Email', $_GET['email']);
	$statement->bindParam(':Password', $_GET['password']);
	$statement->bindParam(':ID', $id);
	$statement->execute();
}
?>

</body>
</html>