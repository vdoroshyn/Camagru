<?php

include('database.php');

try {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	if ($pdo) {
		echo "connected";
	}


} catch (PDOException $ex) {
	echo "Connection failed: " . $ex->getMessage();//TODO
}


?>