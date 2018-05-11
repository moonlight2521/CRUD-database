<?php

/**
 * 
 * Use an HTML form to create a new entry in the users table
 * Sourses:
 * https://www.w3schools.com/ -- information look up 
 * https://www.taniarascia.com/ -- how to set  up php and database
 * https://stackoverflow.com/  -- for troubleshooting
 * 
 */

if (isset($_POST['submit'])) {
	require "../config.php";
	require "../common.php";

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_user = array(
			"firstname" => $_POST['firstname'],
			"lastname"  => $_POST['lastname'],
			"email"     => $_POST['email'],
			"age"       => $_POST['age'],
			"health_issues"  => $_POST['health_issues']
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"users",
				implode(", ", array_keys($new_user)),
				":" . implode(", :", array_keys($new_user))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_user);
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php include "templates/header.php"; ?><h2>Add a user</h2>

<form method="post">
	<label for="firstname">First Name</label>
	<input type="text" name="firstname" id="firstname">
	<label for="lastname">Last Name</label>
	<input type="text" name="lastname" id="lastname">
	<label for="email">Email Address</label>
	<input type="text" name="email" id="email">
	<label for="age">Age</label>
	<input type="text" name="age" id="age">
	<label for="health issues">Health Issues</label>
	<input type="text" name="health_issues" id="health_issues">
	<input type="submit" name="submit" value="Submit">
</form>

<center><a href="index.php">Back to Home</a></center>

<?php include "templates/footer.php"; ?>