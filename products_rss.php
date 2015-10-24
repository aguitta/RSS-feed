<?php 
	header('Content-Type: text/xml'); 
	echo '<?xml version="1.0" encoding="utf-8"?>'; 
	$builddate = gmdate(DATE_RSS, time()); 

	if(isset($_GET['product_type'])) {
		$product = $_GET['product_type'];
	} // end if
?>


<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<title><?php echo $product; ?> RSS</title>
		<atom:link href="http://<?= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ?>?product_type=<?php echo $product; ?>" rel ="self" type="application/rss+xml" />
		<description>RSS Feed</description>
		<link>http://test.ishabagha.com/</link>
		<lastBuildDate><?php echo $builddate; ?></lastBuildDate>
		<language>en-us</language>
			
		<?php
		require_once("includes/database_connection.php");

		$query = "SELECT productCode, productName, productLine, productScale, productVendor, productDescription, buyPrice FROM products WHERE `productLine` = '$product'";
		$result = mysqli_query($dbc, $query)
			or die(mysqli_error($dbc));

		  		while ($row = mysqli_fetch_array($result)) { 
		  			$product_code = $row['productCode'];
		  			$product_name = $row['productName'];
		  			$product_line = $row['productLine'];
					$product_scale = $row['productScale'];
					$product_vendor = $row['productVendor'];
					$product_description = $row['productDescription'];
					$buy_price = $row['buyPrice'];
					$date_added = $row['dateAdded'];
			
					$pubdate = date(DATE_RSS, strtotime($date_added))
		?>

				<item>
    				<title><?php echo $product_name; ?></title>   					
    				<link>http://test.ishabagha.com/classic_cars/product_description.php?pid=<?php echo $product_code; ?></link>
    				<guid isPermaLink="false">http://test.ishabagha.com/classic_cars/product_description.php<?php echo $product_code; ?></guid>
    				<description><?php echo $product_line. '; ' .$product_code. '; ' .$product_name. '; '. '; '.$product_scale. '; ' .$product_vendor. '; ' .$product_description. ' $' .$buy_price; ?></description>
					<pubDate><?php echo $builddate; ?></pubDate>						
    			</item>
    		<?php
    			} // end while ($row = mysqli_fetch_array($result)
    		?>
	</channel>
</rss>