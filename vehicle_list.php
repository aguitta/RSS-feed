<?php
require_once("includes/database_connection.php");

	$product="";
	$product_types = array("Planes", "Trains", "Motorcycles");	

	if(isset($_GET['product_type'])) {
		$product = $_GET['product_type'];
	} 
	
	else {
	} // end else	

	$query = "SELECT productCode, productName, productLine, productScale, productVendor, productDescription, buyPrice FROM products WHERE `productLine` = '$product'";
	$result = mysqli_query($dbc, $query)
		or die(mysqli_error($dbc));
?>

<!DOCTYPE html>
<html>
  <head>
	 <meta charset='utf-8'>
 	  <title>RSS</title>
 	  <link type="text/css" rel="stylesheet" href="classic_cars.css" />
  </head>

  <body>

   <h1>Vehicle RSS Feed</h1>

    <?php
   		foreach ($product_types as $line) {
    		echo "<a href='products_rss.php?product_type=$line'>$line</a><br>";
		}
	?>
	
  </body>
</html>