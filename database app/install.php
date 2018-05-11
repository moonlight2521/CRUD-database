
<?php

/**
 * Open a connection via PDO to create a
 * new database and table with structure.
 *
 */

require "config.php";

try {
	$connection = new PDO("mysql:host=127.0.0.1", $username, $password, $options);
	$sql = file_get_contents("project_v/data/init.sql");
	$connection->exec($sql);
	
	echo "Database and table users created successfully.";
} catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}