
<?php require "templates/header.php"; ?>

<h2>Update user e-mail: </h2>

<form method="post">
    <label for="user_name">User ID: </label>
    <input type="text" placeholder="User Id:" id="id" name="id">
    <label for="user_name"></label>
	<input type="text" placeholder="Update User's email to:" id="email" name="email">
	<input type="submit" name="Update" value="Update">
</form>

<h2>Update user Age: </h2>

<form method="post">
	<label for="user_name">User ID</label>
    <input type="text" placeholder="User Id:" id="id" name="id">
    <label for="user_name">Update User's Age</label>
	<input type="text" placeholder="Update User's age to:" id="age" name="age">
	<input type="submit" name="Update" value="Update">
</form>

<h2>Update user Health Issues: </h2>

<form method="post">
    <label for="user_name">User ID</label>
    <input type="text" placeholder="User Id:" id="id" name="id">
	<label for="user_name">User's Health Issues</label>
	<input type="text" placeholder="Update health issues to:" id="health_issues" name="health_issues">
	<input type="submit" name="Update" value="Update">
</form>

<?php


if (isset($_POST['Update'])) {
	try {	
		require "../config.php";
		require "../common.php";
        $connection = new PDO($dsn, $username, $password, $options);
        if($_POST['email']){
            $email = $_POST['email'];
            $id = $_POST['id'];
            $sql = "UPDATE users SET email='$email' WHERE id=$id";

            $statement = $connection->prepare($sql);
		    $statement->execute($new_user);
            }
            if($_POST['age']){
                $age = $_POST['age'];
                $id = $_POST['id'];
                $sql = "UPDATE users SET age='$age' WHERE id=$id";
    
                $statement = $connection->prepare($sql);
                $statement->execute($new_user); 
            } 
            if($_POST['health_issues']){
                $health_issues = $_POST['health_issues'];
                $id = $_POST['id'];
                $sql = "UPDATE users SET health_issues='$health_issues' WHERE id=$id";
    
                $statement = $connection->prepare($sql);
                $statement->execute($new_user);
            }
         
	} catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();	
	}
}
?>

<?php

if (isset($_POST['submit'])){
	try {	
		require "../config.php";
		require "../common.php";
        $connection = new PDO($dsn, $username, $password, $options);
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
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>

<h3>Check update based on Id: </h3>

<form method="post">
	<label for="user_name">User ID</label>
	<input type="text" placeholder="User Id" id="id" name="id">
	<input type="submit" name="submit" value="View Results">
</form>


<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h4>Results</h4>
		<table>
			<thead>
				<tr>
					<th>ID#</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email Address</th>
					<th>Age</th>
					<th>Health Issues</th>
					<th>Date Modified</th>
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

<center><a href="index.php">Back to Home</a></center>

<?php require "templates/footer.php"; ?>