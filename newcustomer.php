<?php require_once("./includes/htmlhead.inc.php"); ?>
<body>
	<div id="allbodycontent">
		<?php require_once("./includes/header.inc.php"); ?>
  <h3>New Customer Entry</h3>

<?php
  require_once('connectvars.php');
 
  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $customer = mysqli_real_escape_string($dbc, trim($_POST['customer']));
	$lname = mysqli_real_escape_string($dbc, trim($_POST['lname']));
	$fname = mysqli_real_escape_string($dbc, trim($_POST['fname']));
	$phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
	$address = mysqli_real_escape_string($dbc, trim($_POST['address']));
	$city = mysqli_real_escape_string($dbc, trim($_POST['city']));
	$state = mysqli_real_escape_string($dbc, trim($_POST['state']));
	$zip = mysqli_real_escape_string($dbc, trim($_POST['zip']));
	$country = mysqli_real_escape_string($dbc, trim($_POST['country']));
	$salerep = mysqli_real_escape_string($dbc, trim($_POST['salerep']));
	$creditLimit = mysqli_real_escape_string($dbc, trim($_POST['creditLimit']));

    if (!empty($customer) && !empty($lname) && !empty($fname) && !empty($phone) && !empty($salerep) && !empty($creditLimit)) {
        $query = "SELECT * FROM customers WHERE customer = '$customer'";
        $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 0) {
          // The username is unique, so insert the data into the database
		  $query = "INSERT INTO customers (customer, lname, fname, phone, address, city, state, zip, country, salerep, creditLimit) 
		  VALUES ('$customer','$lname', '$fname', '$phone', '$address', '$city', '$state', '$zip', '$country', '$salerep', '$creditLimit')";
		  mysqli_query($dbc, $query);

		  // Confirm success with the user
		  echo '<p>Customer Entry Successful</p>';

		  exit();
		  } else {

		  // An account already exists for this username, so display an error message
		  echo '<p class="error">An account already exists for this customer</p>';
		  $customer = "";
		  }
	  }
  }

  ?>
	
  <form class="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Form</legend>
      <label for="customer">Customer:</label>
      <input type="text" id="customer" name="customer" value="<?= $customer ?>" ><br>  
      <label for="fname">Contact First Name:</label>
      <input type="text" id="fname" name="fname" value="<?= $fname ?>" ><br>
      <label for="lname">Contact Last Name:</label>
      <input type="text" id="lname" name="lname" value="<?= $lname ?>" ><br>
      <label for="phone">Phone:</label>
      <input type="text" id="phone" name="phone" value="<?= $phone ?>" ><br>
      <label for="address">Address:</label>
      <input type="text" id="address" name="address" value="<?= $address ?>" ><br>
      <label for="city">City:</label>
      <input type="text" id="city" name="city" value="<?= $city ?>" ><br>
      <label for="state">State:</label>
      <input type="text" id="state" name="state" value="<?= $state ?>" ><br>
      <label for="zip">Zip:</label>
      <input type="text" id="zip" name="zip" value="<?= $zip ?>" ><br>
      <label for="country">Country:</label>
      <input type="text" id="country" name="country" value="<?= $country ?>" ><br>
      <label for="salerep">Sales Rep ID:</label>
      <input type="text" id="salerep" name="salerep" value="<?= $salerep ?>" ><br>
      <label for="creditLimit">Credit Limit:</label>
      <input type="text" id="creditLimit" name="creditLimit" value="<?= $creditLimit ?>" ><br>  
    </fieldset>
    <input type="submit" value="Register" name="submit" >
  </form>
</div>
</div>

<div id="footer">
<? require_once('./includes/footer.inc.php'); ?>
</div>

</body> 
</html>
