<?php
  require_once('connectvars.php');
  $output = "";
  
  //GET product information
  if (isset($_GET['pid'])) {
	  
	  $product_number = trim($_GET['pid']);
	  
	  $query = "SELECT * FROM products WHERE productCode = '$product_number'";
	  $result = mysqli_query($dbc, $query)
		  or die ("Error querying database => $query");
	  
	  $num_rows = mysqli_num_rows($result);
	  
	  if ($num_rows != 0) {
		  while ($row = mysqli_fetch_array($result)) {
			  $product_code = $row['productCode'];
			  $name = $row['productName'];
			  $product_line = $row['productLine'];
			  $scale = $row['productScale'];
			  $vendor = $row['productVendor'];
			  $description = $row['productDescription'];
			  $buy_price = $row['buyPrice'];
			  
			  $output = "<p>Name: $name</p>
			 	 		 <p>Product Line: $product_line</p>
			  		   	 <p>Product Scale: $scale</p>
			 			 <p>Vendor: $vendor</p>
						 <p>Description: $description</p>
						 <p>Buy Price: $$buy_price</p>";
						
					 }
					 
				 } else { $output = 'No Match Found'; }
	         }
			 
			 require_once("./includes/htmlhead.inc.php"); 
?>
			 <body>
			 	<div id="allbodycontent">
			 		<?php require_once("./includes/header.inc.php"); ?>
	<div>
		<h2><a href="http://lesson5phpclass.epizy.com/classicrss.php">Classic Cars RSS Feed</a></h2>
		<h2><a href="http://lesson5phpclass.epizy.com/shiprss.php">Ships RSS Feed</a></h2>
		<h2><a href="http://lesson5phpclass.epizy.com/trainsrss.php">Trains RSS Feed</a></h2>
		<div>
		<?= $output ?>
		</div>
		
</div>
</div>
</div>
<div id="footer">
<? require_once('./includes/footer.inc.php'); ?>
</div>

</body>

</html>

