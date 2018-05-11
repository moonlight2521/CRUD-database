<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['findMacro'])) {
	try {	
		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		
		$sql = "SELECT * 
						FROM macronutrient
						WHERE MacroName = :mName";

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
if (isset($_POST['findMacro'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
                    <th>Macro Id</th>
					<th>Food Name</th>
					<th>Mineral Name</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
                <td><?php echo escape($row["macro_id"]); ?></td>
				<td><?php echo escape($row["FoodName"]); ?></td>
				<td><?php echo escape($row["MacroName"]); ?></td>
				<td><?php echo escape($row["amount"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['health_issues']); ?>.</blockquote>
	<?php } 
} ?> 

<h4>Find Macronutrient in food: </h4>
<form method="post">
	<label for="vitaminName">Macronutrient Name</label>
	<input type="text" placeholder="ex: Sugar" id="mName" name="mName">
	<input type="submit" name="findMacro" value="View Results">
</form>


 <center><a href="index.php">Back to Home</a></center>

<?php require "templates/footer.php"; ?>