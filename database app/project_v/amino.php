<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['findAmino'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = "SELECT * 
						FROM aminoAcid
						WHERE AminoName = :aName";

			$aName = $_POST['aName'];
			$statement = $connection->prepare($sql);
			$statement->bindParam(':aName', $aName, PDO::PARAM_STR);
			$statement->execute();
	
			$result = $statement->fetchAll();
		
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();	
	}
}
?>		
<?php  
if (isset($_POST['findAmino'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
                    <th>Amino Id</th>
					<th>Food Name</th>
					<th>Amino Name</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
                <td><?php echo escape($row["amino_id"]); ?></td>
				<td><?php echo escape($row["FoodName"]); ?></td>
				<td><?php echo escape($row["AminoName"]); ?></td>
				<td><?php echo escape($row["amount"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 

<h4>Find Amino Acid in food: </h4>
<form method="post">
	<label for="aminoName">Amino Acid Name</label>
	<input type="text" placeholder="ex: Serine" id="aName" name="aName">
	<input type="submit" name="findAmino" value="View Results">
</form>


 <center><a href="index.php">Back to Home</a></center>

<?php require "templates/footer.php"; ?>