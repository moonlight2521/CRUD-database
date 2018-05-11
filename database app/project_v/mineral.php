<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['findMineral'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = "SELECT * 
						FROM mineral
						WHERE mineralName = :mName";

			$mName = $_POST['mName'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':mName', $mName, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetchAll();
		
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>		
<?php  
if (isset($_POST['findMineral'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
                    <th>Mineral Id</th>
					<th>Food Name</th>
					<th>Mineral Name</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
                <td><?php echo escape($row["mineral_id"]); ?></td>
				<td><?php echo escape($row["FoodName"]); ?></td>
				<td><?php echo escape($row["MineralName"]); ?></td>
				<td><?php echo escape($row["amount"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 

<h4>Find Minerals in food: </h4>
<form method="post">
	<label for="vitaminName">Mineral Name</label>
	<input type="text" placeholder="ex: Iron" id="mName" name="mName">
	<input type="submit" name="findMineral" value="View Results">
</form>


 <center><a href="index.php">Back to Home</a></center>

<?php require "templates/footer.php"; ?>