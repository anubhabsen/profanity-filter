<?php
	$host = 'localhost';
	$username = 'root';
	$password = 'root';
	$db_name = 'profane';
	if(!@$connection = mysqli_connect($host, $username, $password, $db_name))
		die("Unable to connect to the database \'profane\'");
?>
