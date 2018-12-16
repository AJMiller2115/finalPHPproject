<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['fname'])) {
    if (isset($_COOKIE['fname']) && isset($_COOKIE['username'])) {
      $_SESSION['fname'] = $_COOKIE['fname'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
   require_once("./includes/htmlhead.inc.php");
?>

<body>
	<div id="allbodycontent">
<?php
  require_once('connectvars.php');

  // Generate the navigation menu
  if (isset($_SESSION['username'])) {
    echo '<a href="logout.php">Logout (' . $_SESSION['username'] . ')</a>';
	require_once("./includes/header.inc.php"); 
  }
  else {
    echo '<h2>Wistful Autos Inc.</h2>
			<p><a href="login.php">Employee Log In</a></p>
    		<p><a href="signup.php">Register</a></p>
			<p><a href="classicrss.php">Classic Cars News Feed</p>
			<p><a href="shipsrss.php">Ships News Feed</p>
			<p><a href="trainsrss.php">Trains News Feed</p>';
  }
?>
</div>

<div id="footer">
<? require_once('./includes/footer.inc.php'); ?>
</div>

</body> 
</html>
