<?php
  require_once('connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['fname'])) {
    if (isset($_POST['submit'])) {

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT username FROM employees WHERE username = '$user_username' AND password = MD5('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          $_SESSION['fname'] = $row['fname'];
          $_SESSION['username'] = $row['username'];
          setcookie('fname', $row['fname'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $home_url);
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Enter a valid username and password to log in.';
        }
      }
    }
  }
   require_once("./includes/htmlhead.inc.php");
?>

	
		
<body>
	<div id="allbodycontent">
  <h3>Wistful Autos</h3>

<?php

  if (empty($_SESSION['fname'])) {
    echo '<p>' . $error_msg . '</p>';
?>

  <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Employee Log In</legend>
      <label for="username">Username:</label>
      <input type="text" name="username" value="<?php if (!empty($username)) echo $username; ?>" ><br>
      <label for="password">Password:</label>
      <input type="password" name="password">
    </fieldset>
    <input type="submit" value="Log In" name="submit">
  </form>
  <a href="./index.php">Return Home</a>

<?php
  }
  else {
    // successful log-in
	require_once("./includes/header.inc.php");
    echo('<p>Welcome ' . $_SESSION['username'] . '!</p>');
  }
?>
</div>
<div id="footer">
<? require_once('./includes/footer.inc.php'); ?>
</div>
</body>
</html>
