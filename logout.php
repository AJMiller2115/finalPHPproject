<?php
  // If the user is logged in, delete the session vars to log them out
  session_start();
  if (isset($_SESSION['username'])) {
    // Delete the session vars by clearing the $_SESSION array
    $_SESSION = array();

    // Delete the session cookie by setting its expiration to an hour ago (3600)
    if (isset($_COOKIE[session_name()])) {      setcookie(session_name(), '', time() - 3600);    }

    // Destroy the session
    session_destroy();
  }

  // Delete the user ID and username cookies by setting their expirations to an hour ago (3600)
  setcookie('username', '', time() - 3600);
  
		echo '<h3>You Have Successfully Logged Out</h3>
			<h4> Please wait to be directed to the home page</h4>';
		
  // Redirect to the home page
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
  $sec = 8;
  header("Refresh:$sec; url=http://www.lesson5php.epizy.com/index.php", true, 303);
 
?>
