<?php
  // Define database connection constants
  define('HOST', 'sql100.epizy.com');
  define('DBUSER', 'epiz_22937773');
  define('PWD', 'BkFGAYBE6ryPTKZ');
  define('DBNAME', 'epiz_22937773_php');
  
$dbc = 0;

$dbc = mysqli_connect(HOST, DBUSER, PWD, DBNAME)
	or die ('Cannot connect to database');
?>
