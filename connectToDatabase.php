<?php

include('config/database.php');

function returnPDO($DB_DSN, $DB_USER, $DB_PASSWORD) {
	try {
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		// set the PDO error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	} catch(PDOException $ex) {
		echo "Cannot connect to the database: " . $ex->getMessage();
		return NULL;
	}
}
?>