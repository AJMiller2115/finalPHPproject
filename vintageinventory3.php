<?php
  require_once('connectvars.php');

		$query = " SELECT * FROM products WHERE `productLine` = 'Vintage Cars' ORDER BY productName LIMIT 10 OFFSET 20 ";

	$result = mysqli_query($dbc, $query)
		or die ('Error querying database');
	
	   require_once("./includes/htmlhead.inc.php");

?>


<body>
	<div id="allbodycontent">
		<?= require_once("./includes/header.inc.php"); ?>
	
	<h1>Vintage Car Inventory</h1>
			<div id="page">
			<a href="vintageinventory.php">Page 1</a>&nbsp&nbsp<a href="vintageinventory2.php">Page 2</a>&nbsp&nbsp<a href="vintageinventory3.php">Page 3</a>
		</div>
	
	<table border = "1">
		<tr>
			<td>Product Line</td>
			<td>Name</td>
			<td>Vendor</td>
			<td>Description</td>
			<td>Price</td>
		</tr>

<?php
	$row_count = 1;

		while ($row = mysqli_fetch_array($result)) {
			$productLine = $row['productLine'];
			$productName = $row['productName'];
			$productVendor = $row['productVendor'];
			$productDescription = $row['productDescription'];
			$buyPrice = $row['buyPrice'];
			
	$row_count++;	
	
	if ($row_count%2 == 0) {	
	
		echo "<tr>
				<td bgcolor='#857F74'>$productLine</td>
				<td bgcolor='#857F74'>$productName</td>
				<td bgcolor='#857F74'>$productVendor</td>
				<td bgcolor='#857F74'>$productDescription</td>
				<td bgcolor='#857F74'>$buyPrice</td>
				</tr>";
		} else {
			
			echo "<tr>
				<td>$productLine</td>
				<td>$productName</td>
				<td>$productVendor</td>
				<td>$productDescription</td>
				<td>$buyPrice</td>
				</tr>";			
		}	
} 

?>
	</table>			
</div>
</div>
<div id="footer">
<? require_once('./includes/footer.inc.php'); ?>
</div>	
</body>
</html>

	<?php
	mysqli_close($dbc);
	?>