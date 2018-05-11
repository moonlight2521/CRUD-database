<?php

/**
 * Function to query information based on a parameter.
 *
 */

if (isset($_POST['submit'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		if($_POST['last']){
		$sql = "SELECT * 
						FROM users
						WHERE lastname = :lastname";

			$lastName = $_POST['last'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':lastname', $lastName, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetchAll();
		}
		if($_POST['id']){
			$sql = "SELECT * 
							FROM users
							WHERE id = :id";

				$id = $_POST['id'];
				$statement = $connection->prepare($sql);
				$statement->bindParam(':id', $id, PDO::PARAM_STR);
				$statement->execute();
		
				$result = $statement->fetchAll();
		}
		if($_POST['first']){
			$sql = "SELECT * 
							FROM users
							WHERE firstname = :firstname";

				$firstName = $_POST['first'];
				$statement = $connection->prepare($sql);
				$statement->bindParam(':firstname', $firstName, PDO::PARAM_STR);
				$statement->execute();
		
				$result = $statement->fetchAll();
		}
		if($_POST['health_issues']){
			$sql = "SELECT * 
							FROM users
							WHERE health_issues = :health_issues";

				$health_issues = $_POST['health_issues'];
				$statement = $connection->prepare($sql);
				$statement->bindParam(':health_issues', $health_issues, PDO::PARAM_STR);
				$statement->execute();
		
				$result = $statement->fetchAll();
		}

		if($_POST['age']){
				$sql = "SELECT * 
								FROM users
								WHERE age = :age";
	
					$age = $_POST['age'];
					$statement = $connection->prepare($sql);
					$statement->bindParam(':age', $age, PDO::PARAM_STR);
					$statement->execute();
			
					$result = $statement->fetchAll();
		}
		
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email Address</th>
					<th>Age</th>
					<th>Health Issues</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["firstname"]); ?></td>
				<td><?php echo escape($row["lastname"]); ?></td>
				<td><?php echo escape($row["email"]); ?></td>
				<td><?php echo escape($row["age"]); ?></td>
				<td><?php echo escape($row["health_issues"]); ?></td>
				<td><?php echo escape($row["date"]); ?> </td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find user based on: </h2>
<form method="post">
	<label for="user_id">User Id</label>
	<input type="text" id="id" name="id">
	<input type="submit" name="submit" value="View Results">
</form>

<form method="post">
	<label for="user_name">User Last Name</label>
	<input type="text" id="last" name="last">
	<input type="submit" name="submit" value="View Results">
</form>

<form method="post">
	<label for="user_name">User First Name</label>
	<input type="text" id="first" name="first">
	<input type="submit" name="submit" value="View Results">
</form>

 <form method="post">
 	<label for="health_issues">Health Issues</label>
 	<input type="text" id="health_issues" name="health_issues">
 	<input type="submit" name="submit" value="View Results">
 </form>

 <form method="post">
 	<label for="health_issues">Age</label>
 	<input type="text" id="age" name="age">
 	<input type="submit" name="submit" value="View Results">
 </form>
 <center><a href="index.php">Back to Home</a></center>

<?php require "templates/footer.php"; ?>