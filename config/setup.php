<?php

include('database.php');

try {
	$pdo = new PDO($DB_DSN_CREATE, $DB_USER, $DB_PASSWORD);
	// set the PDO error mode to exception
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->exec("CREATE DATABASE IF NOT EXISTS `camagru`");

} catch (PDOException $ex) {
	echo "Database was not created: " . $ex->getMessage();//TODO
}

try {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//drop tables;
	$pdo->exec("DROP TABLE IF EXISTS `users`");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `users`(
		username CHAR(8) NOT NULL,
		email VARCHAR(100) NOT NULL,
		password VARCHAR(255) NOT NULL,
		id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		confirmed_email INT NOT NULL DEFAULT 0,
		verification_code INT NOT NULL DEFAULT 0)
		");

} catch (PDOException $ex) {
	echo "Connection failed: " . $ex->getMessage();
}

?>