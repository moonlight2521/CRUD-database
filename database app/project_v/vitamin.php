<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['findVitamin'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = "SELECT * 
						FROM vitamin
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
                    <th>Vitamin Id</th>
					<th>Food Name</th>
					<th>Vitamin Name</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
                <td><?php echo escape($row["vitamin_id"]); ?></td>
				<td><?php echo escape($row["FoodName"]); ?></td>
				<td><?php echo escape($row["VitaminName"]); ?></td>
				<td><?php echo escape($row["amount"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 

<h4>Find Vitamin in food: </h4>
<form method="post">
	<label for="vitaminName">Vitamin Name</label>
	<input type="text" placeholder="ex: Vitamin D" id="vName" name="vName">
	<input type="submit" name="findVitamin" value="View Results">
</form>


 <center><a href="index.php">Back to Home</a></center>

<?php require "templates/footer.php"; ?>