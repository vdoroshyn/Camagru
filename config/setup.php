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
	$pdo->exec("DROP TABLE IF EXISTS `photos`");
	$pdo->exec("DROP TABLE IF EXISTS `comments`");
	$pdo->exec("DROP TABLE IF EXISTS `likes`");
	//create tables to be used
	$pdo->exec("CREATE TABLE IF NOT EXISTS `users`(
		id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		username CHAR(8) NOT NULL,
		email VARCHAR(100) NOT NULL,
		password VARCHAR(255) NOT NULL,
		confirmed_email INT NOT NULL DEFAULT 0,
		verification_code BIGINT NOT NULL DEFAULT 0,
		reset_email_code BIGINT NOT NULL DEFAULT 0)
		");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `photos`(
		id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		username CHAR(8) NOT NULL,
		photo_name CHAR(46) NOT NULL,
		time_stamp TIMESTAMP)
		");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `comments`(
		id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		photo_id INT UNSIGNED NOT NULL,
		comment_text VARCHAR(1000) NOT NULL,
		commenter_id INT UNSIGNED NOT NULL,
		owner_id INT UNSIGNED NOT NULL,
		time_stamp TIMESTAMP)
		");
	$pdo->exec("CREATE TABLE IF NOT EXISTS `likes`(
		user_id INT UNSIGNED NOT NULL,
		photo_id INT UNSIGNED NOT NULL)
		");
} catch (PDOException $ex) {
	echo "Connection failed: " . $ex->getMessage();
}

?>