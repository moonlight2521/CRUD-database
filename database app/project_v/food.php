<?php require "templates/header.php"; ?>

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
		
		$sql = "SELECT * 
						FROM food
						WHERE FoodName = :foodName";

			$foodName = $_POST['foodName'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':foodName', $foodName, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetchAll();

		
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>		
<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>Food Name</th>
					<th>Type</th>
					<th>Seasons</th>
					<th>Cost</th>
					<th>Storage</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["FoodName"]); ?></td>
				<td><?php echo escape($row["Type"]); ?></td>
				<td><?php echo escape($row["Seasons"]); ?></td>
				<td><?php echo escape($row["Cost"]); ?></td>
				<td><?php echo escape($row["Storage"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 
<?php
if (isset($_POST['findVitamin'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = "SELECT DISTINCT foodName, vitaminName, amount
						FROM food NATURAL JOIN vitamin
						WHERE vitaminName = :vName";

			$vName = $_POST['vName'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':vName', $vName, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetchAll();

		
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>		
<?php  
if (isset($_POST['findVitamin'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>Food Name</th>
					<th>Vitamin Name</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["foodName"]); ?></td>
				<td><?php echo escape($row["vitaminName"]); ?></td>
				<td><?php echo escape($row["amount"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 

<?php


if (isset($_POST['findType'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = "SELECT FoodName, FoodType, Seasons
						FROM food 
						where (Seasons != 'All seasons') 
                        and FoodType = :foodtype";
			$foodtype = $_POST['foodtype'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':foodtype', $foodtype, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetchAll();

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>
		
<?php  
if (isset($_POST['findType'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>Food Name</th>
					<th>Type</th>
					<th>Seasons</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["FoodName"]); ?></td>
				<td><?php echo escape($row["FoodType"]); ?></td>
				<td><?php echo escape($row["Seasons"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 
<?php
if (isset($_POST['findPrice'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = "SELECT FoodName, FoodType, Cost
						FROM food 
						where cost < :price";
			$price = $_POST['price'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':price', $price, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetchAll();

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>
		
<?php  
if (isset($_POST['findPrice'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>Food Name</th>
					<th>Type</th>
					<th>Cost</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["FoodName"]); ?></td>
				<td><?php echo escape($row["FoodType"]); ?></td>
				<td><?php echo escape($row["Cost"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 

<h4>Find Food Item based on: </h4>
<form method="post">
	<label for="foodName">Food Name</label>
	<input type="text" placeholder="ex: apple" id="foodName" name="foodName">
	<input type="submit" name="submit" value="View Results">
</form>

<h4>Find food that contains distinct vitamin: </h4>
<form method="post">
	<label for="vitaminName">Vitamin Name</label>
	<input type="text" placeholder="ex: Vitamin D" id="vName" name="vName">
	<input type="submit" name="findVitamin" value="View Results">
</form>

<h4>See seasonal base on type (fruit or vegetable): </h4>
<form method="post">
	<label for="typeName">Type:</label>
	<input type="text" placeholder="ex: fruit" id="foodtype" name="foodtype">
	<input type="submit" name="findType" value="View Results">
</form>

<h4>show food items under price of: </h4>
<form method="post">
	<label for="price">Price:</label>
	<input type="text" placeholder="ex: 5" id="price" name="price">
	<input type="submit" name="findPrice" value="View Results">
</form>


 <center><a href="index.php">Back to Home</a></center>

<?php require "templates/footer.php"; ?>