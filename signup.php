<?php require_once("./includes/htmlhead.inc.php"); ?>
<body>
	<div id="allbodycontent">

<?php
  require_once('connectvars.php');
 

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
	$fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	$email = mysqli_real_escape_string($dbc, trim($_POST['email']));
	

    if (!empty($username) && !empty($password1) && !empty($password2) && !empty($fname) && !empty($lname) && !empty($email) && ($password1 == $password2)) {
        $query = "SELECT * FROM employees WHERE username = '$username'";
        $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 0) {
          // The username is unique, so insert the data into the database
		  $query = "INSERT INTO employees (lname, fname, username, password, email) 
		  VALUES ('$lname', '$fname', '$username', md5('$password1'), '$email')";
		  mysqli_query($dbc, $query);

		  // Confirm success with the user
		  echo '<p>Your new account has been successfully created. <a href="login.php">Log In Here</a></p>';

		  exit();
		  } else {

		  // An account already exists for this username, so display an error message
		  echo '<p>An account already exists for this username. Please use a different username.</p>';
		  $username = "";
		  }
	  }
  }

  ?>
	<h2>Wistful Autos, Inc.</h2>
  <p>Please fill out the form to sign up</p>
  <form class="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="fname">First Name:</label>
      <input type="text" id="username" name="fname" value="<?= $fname ?>" ><br>
      <label for="lname">Last Name:</label>
      <input type="text" id="lastname" name="lname" value="<?= $lname ?>" ><br>
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" value="<?= $email ?>" ><br>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?= $username ?>" ><br>
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" ><br>
      <label for="password2">Password (retype):</label>
      <input type="password" id="password2" name="password2" ><br>
    </fieldset>
    <input type="submit" value="Sign Up" name="submit" >
  </form>
</div>
</div>
<div id="footer">
<? require_once('./includes/footer.inc.php'); ?>
</div>

</body> 
</html>
