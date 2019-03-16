<?php  include('../includes/errors.php'); ?>
<?php
$userId = "";
$userEmail = "";
$userFristName = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'malkhudc_TSM', '1m4a1m2K', 'malkhudc_TSM19');



if (isset($_POST['login_user'])) {
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
  $userPassword = mysqli_real_escape_string($db, $_POST['userPassword']);
  

  if (empty($userEmail)) {
  	array_push($errors, "Username is required");
  }
  if (empty($userPassword)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$userPassword = md5($userPassword);
  	$query = "SELECT * FROM user WHERE userEmail='$userEmail' AND userPassword='$userPassword' AND userRole='Admin'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  session_start();
  	  $_SESSION['Email'] = $userEmail;
  	  $_SESSION['Password'] = $userPassword;
  	  $_SESSION['role'] = $userRole;
  	  $_SESSION['success'] = "You are now logged in";
  	  print header('location: index.php?loginSuccessfully');
  	  
  	}else {
  		array_push($errors, "Wrong user_name/password combination");
  	}
  }
}

?>