<?php
  require_once('connectvars.php');
  header('Content-Type: text/xml');
  echo '<?xml version="1.0" encoding="utf-8"?>';
  $builddate = gmdate(DATE_RSS, time());
?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
	<channel>
		<atom:link href="http://<?= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ?>" rel="self" type="application/rss+xml" />
		<title>Vintage Cars and Trains RSS</title>
		<link>http://phpclass.epizy.com/news.php</link>
		<description>Vintage Cars and Trains RSS feed</description>
		<lastBuildDate><?= $builddate ?></lastBuildDate>
		<language>en-us</language>
<?php
	$query = " SELECT * FROM products WHERE `productLine` = 'Ships' ORDER BY productName DESC LIMIT 10 ";

	$result = mysqli_query($dbc, $query)
		or die ('Error querying database');

	while ($newArray = mysqli_fetch_array($result)) {
		$product_code = $newArray[productCode];
		$name = $newArray[productName];
		$product_line = $newArray[productLine];
		$scale = $newArray[productScale];
		$vendor = $newArray[productVendor];
		$description = $newArray[productDescription];
		$buy_price = $newArray[buyPrice];
		$build_time = $newArray[buildTime];
		
		$pubdate = date(DATE_RSS, strtotime($buildTime));
?>
  
  <item>
	  <title><?php echo "$product_code - $name"; ?></title>
	  <description><?= $description ?></description>
	  <link>http://phpclass.epizy.com/product.php?pid=<?= $product_code ?></link>
	  <guid isPermaLink="false">http://phpclass.epizy.com/product.php?pid=<?= $product_code ?></guid>
	  <pubDate><?= $pubdate ?></pubDate>
  </item>

<?php
}
?>
</channel>
</rss>