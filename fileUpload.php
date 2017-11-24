<?php
	session_start();

	echo $_FILES['file']['name'] ."<br/>";
    echo $_FILES['file']['tmp_name']."<br/>";
    echo $_FILES['file']['size']."<br/>";
    echo $_FILES['file']['type']."<br/>";
?>