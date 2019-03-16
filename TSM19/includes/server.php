<?php

$userID = "";
$userEmail = "";
$userFristName = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'malkhudc_TSM', '1m4a1m2K', 'malkhudc_TSM19');


function clean($string) {


return htmlentities($string);


}



function redirect($location){


return header("Location: {$location}");

}


function set_message($message) {


	if(!empty($message)){


		$_SESSION['message'] = $message;

	}else {

		$message = "";

	}


}



function display_message(){


	if(isset($_SESSION['message'])) {


		echo $_SESSION['message'];

		unset($_SESSION['message']);

	}



}



function token_generator(){


$token = $_SESSION['token'] =  md5(uniqid(mt_rand(), true));

return $token;


}


function validation_errors($error_message) {

$error_message = <<<DELIMITER

<div class="alert alert-danger alert-dismissible" role="alert">
  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  	<strong>Warning!</strong> $error_message
 </div>
DELIMITER;

return $error_message;
		


}



function email_exists($userEmail) {

	$sql = "SELECT userID FROM user WHERE userEmail = '$userEmail'";

	$result = query($sql);

	if(row_count($result) == 1 ) {

		return true;

	} else {


		return false;

	}



}



function send_email($userEmail, $subject, $msg, $headers){
		    return mail($userEmail, $subject, $msg, $headers);
		}

////////////////////////////////////// REGISTER USER ////////////////////////////////////////////////
////////////////////////////////////// REGISTER USER ////////////////////////////////////////////////
////////////////////////////////////// REGISTER USER ////////////////////////////////////////////////

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $userFirstName = mysqli_real_escape_string($db, $_POST['userFirstName']);
  $userLastName = mysqli_real_escape_string($db, $_POST['userLastName']);
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
  $userMajor = mysqli_real_escape_string($db, $_POST['userMajor']);
  $userUniversity = mysqli_real_escape_string($db, $_POST['userUniversity']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  
  if (empty($userFirstName)) { array_push($errors, "First Name is required"); }
  if (empty($userLastName)) { array_push($errors, "Last Name is required"); }
  if (empty($userEmail)) { array_push($errors, "Email is required"); }
  if (empty($userMajor)) { array_push($errors, "Major is required"); }
  if (empty($userUniversity)) { array_push($errors, " University Name is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match"); 
      }
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM user WHERE userEmail='$userEmail'  LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['userEmail'] === $userEmail) {
      array_push($errors, "email already exists");
    }

  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$userPassword = md5($password_1);//encrypt the password before saving in the database
    $validationCode = md5($userFirstName . microtime());
  	$query = "INSERT INTO user ( userFirstName, userLastName, userEmail, validationCode, userMajor, userUniversity, userPassword, userRole, isActive) 
  			  VALUES( '$userFirstName', '$userLastName','$userEmail', '$validationCode', '$userMajor','$userUniversity', '$userPassword', 'User', 0 )";
  	mysqli_query($db, $query);
  	
  	
  		$subject = "Activate Account";
		$msg = " Please click the link below to activate your Account
		http://malkhud2.create.stedwards.edu/TSM19/includes/activate.php?userEmail=$userEmail&code=$validationCode
		";

		$headers = "From: noreply@referme.com";

		
	   send_email($userEmail, $subject, $msg, $headers);
		
  	$_SESSION['userEmail'] = $userEmail;
  	$_SESSION['userID'] = $userID;
  	$_SESSION['success'] = "You are now logged in";
  	   redirect("login.php");
  }
}


////////////////////////////////////// TUTOR FORM ////////////////////////////////////////////////
////////////////////////////////////// TUTOR FORM ////////////////////////////////////////////////
////////////////////////////////////// TUTOR FORM ////////////////////////////////////////////////
////////////////////////////////////// TUTOR FORM ////////////////////////////////////////////////

if (isset($_POST['btn-tutor-form'])) {
  $TheuserID = mysqli_real_escape_string($db, $_POST['userID']);
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
  $tutorGPA = mysqli_real_escape_string($db, $_POST['tutorGPA']);
  $tutorSkills = mysqli_real_escape_string($db, $_POST['tutorSkills']);

  if (empty($tutorGPA)) { array_push($errors, "GPA is required"); }
  if (empty($tutorSkills)) { array_push($errors, "SKILL is required"); }
   

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {

  	$query = "INSERT INTO tutorForm (tutorGPA, tutorPostDate, tutorSkills, isApproved, notApproved, userID) 
  			  VALUES('$tutorGPA', now(), '$tutorSkills', 0, 0, (SELECT userID FROM user WHERE user.userID='$TheuserID'))";
  	mysqli_query($db, $query);
  	
  	
  	    $subject = "Tutor Form";
		$msg = " Your Tutor Form Has Been Made, Wite For Admins to Aprrove It. You can log in useing this link.
        http://malkhud2.create.stedwards.edu/TSM19/homepage.php
		";
		
		$headers = "From: noreply@referme.com";

		
	    send_email($userEmail, $subject, $msg, $headers);
	   
  	$_SESSION['tutorGPA'] = $tutorGPA;
  	$_SESSION['success'] = "Tour Request has been send, wait for aprove";
        redirect("../homepage.php");
  }
}

////////////////////////////////////// NEW BOOK ////////////////////////////////////////////////
////////////////////////////////////// NEW BOOK ////////////////////////////////////////////////
////////////////////////////////////// NEW BOOK ////////////////////////////////////////////////

// $msg = "";

if (isset($_POST['new_book'])) {
  // receive all input values from the form
  $TheuserID = mysqli_real_escape_string($db, $_POST['userID']);
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
  $bookTitle = mysqli_real_escape_string($db, $_POST['bookTitle']);
  $bookISBN = mysqli_real_escape_string($db, $_POST['bookISBN']);
  $bookPrice = mysqli_real_escape_string($db, $_POST['bookPrice']);
  $bookDescription = mysqli_real_escape_string($db, $_POST['bookDescription']);
  
    $target = "bookImg/".basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];


  if (empty($bookTitle)) { array_push($errors, "Title is required"); }
  if (empty($bookISBN)) { array_push($errors, "ISBN is required"); }
  if (empty($bookPrice)) { array_push($errors, "Price is required"); }
  if (empty($bookDescription)) { array_push($errors, "Info is required"); }

  	$query = "INSERT INTO book(bookTitle, bookISBN, bookPrice, bookPostDate, bookImage, bookDescription, userID) 
  			  VALUE ('$bookTitle', '$bookISBN', '$bookPrice', now(), '$image', '$bookDescription', (SELECT userID FROM user WHERE user.userID='$TheuserID'))";
  	mysqli_query($db, $query);
  	
  	    $subject = "Your book ad has been added";
		$msg = " Please click this link to go to the homepage:
		http://malkhud2.create.stedwards.edu/TSM19/homepage.php
		";

		$headers = "From: noreply@referme.com";
		
		send_email($userEmail, $subject, $msg, $headers);

		
  	  	$_SESSION['bookTitle'] = $bookTitle;
  	  	
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
            	set_message("<p class='bg-success text-center'>Please check your email or spam folder for activation link</p>");

	            redirect("book.php?New-Ad-Made-Successfully");

        } else {
            $msg = " There was a problem uploading image";
        }
    }

////////////////////////////////////// NEW TUTOR ////////////////////////////////////////////////
////////////////////////////////////// NEW TUTOR ////////////////////////////////////////////////
////////////////////////////////////// NEW TUTOR ////////////////////////////////////////////////

//  This is for Tutor ==>

if (isset($_POST['new_tutor'])) {
   $TheuserID = mysqli_real_escape_string($db, $_POST['userID']);

  // receive all input values from the form
  $tutoringTime = mysqli_real_escape_string($db, $_POST['tutoringTime']);
  $tutoringDate = mysqli_real_escape_string($db, $_POST['tutoringDate']);
  $tutoringLocation = mysqli_real_escape_string($db, $_POST['tutoringLocation']);
  $tutoringDuration = mysqli_real_escape_string($db, $_POST['tutoringDuration']);
  $tutoringCourse = mysqli_real_escape_string($db, $_POST['tutoringCourse']);

  
  if (empty($tutoringCourse)) { array_push($errors, "Course is required"); }
  if (empty($tutoringTime)) { array_push($errors, "Time is required"); }
  if (empty($tutoringDate)) { array_push($errors, "Date is required"); }
  if (empty($tutoringLocation)) { array_push($errors, "Location is required"); }
if (empty($tutoringDuration)) { array_push($errors, "Duration is required"); }
  
  $user_check_query = "SELECT * FROM tutoringRequest WHERE tutoringRequestID='$tutoringRequestID'  LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['tutoringRequestID'] === $tutoringRequestID) {
      array_push($errors, "ID already exists");
    }

  }

  if (count($errors) == 0) {

  	$query = "INSERT INTO tutoringRequest (tutoringTime,  tutoringDate, tutoringLocation, tutoringDuration, tutoringCourse, userID) 
  			  VALUES('$tutoringTime', '$tutoringDate', '$tutoringLocation', '$tutoringDuration', '$tutoringCourse', (SELECT userID FROM user WHERE user.userID='$TheuserID'))";
  	mysqli_query($db, $query);
  	
  	  	$subject = "Your Form has been submitted";
		$msg =  " Please wait for us to look at your form, whaile you wait use this link to our homepage. :)
		http://malkhud2.create.stedwards.edu/TSM19/homepage.php
		";

		$headers = "From: noreply@referme.com";

		
	   send_email($userEmail, $subject, $msg, $headers);
  	$_SESSION['tutoringRequestID'] = $tutoringRequestID;
 
  	$_SESSION['success'] = "you add a new Tutor post";
  	redirect("../homepage.php");
  }
}



////////////////////////////////////// CLUB IMAGE ////////////////////////////////////////////////
////////////////////////////////////// CLUB IMAGE ////////////////////////////////////////////////
////////////////////////////////////// CLUB IMAGE ////////////////////////////////////////////////
$msg = "";

if (isset($_POST['new_club'])) {
  $TheuserID = mysqli_real_escape_string($db, $_POST['userID']);
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);

  $target = "clubImg/".basename($_FILES['image']['name']);

        
        // GET ALL THE SUBMITTED DATA FROM THE FORM
        $image = $_FILES['image']['name'];

        $query = "INSERT INTO club (clubImage, clubFormID, userID) VALUE ('$image', (SELECT clubFormID FROM clubForm WHERE clubForm.clubFormID='1'), (SELECT userID FROM user WHERE user.userID='$TheuserID'))";
        mysqli_query($db, $query); 
        
        $subject = "Your Ad has been uplode";
		$msg =  " Please wait for us to look at your form, while you wait use this link to our homepage. :)
		http://malkhud2.create.stedwards.edu/TSM19/homepage.php
		";

		$headers = "From: noreply@referme.com";

		
	   send_email($userEmail, $subject, $msg, $headers);
	   
	   
        $_SESSION['clubImage'] = $clubImage;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
            	set_message("<p class='bg-success text-center'>Please check your email or spam folder for activation link</p>");

	            redirect("club.php");

        } else {
            $msg = " There was a problem uploading image";
        }
    }

############################



////////////////////////////////////// NEW EVENT ////////////////////////////////////////////////
////////////////////////////////////// NEW EVENT ////////////////////////////////////////////////
////////////////////////////////////// NEW EVENT ////////////////////////////////////////////////


if (isset($_POST['new_event'])) {
  // receive all input values from the form
  $TheuserID = mysqli_real_escape_string($db, $_POST['userID']);
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
  $eventTitle = mysqli_real_escape_string($db, $_POST['eventTitle']);
  $eventDate = mysqli_real_escape_string($db, $_POST['eventDate']);
  $eventDescription = mysqli_real_escape_string($db, $_POST['eventDescription']);

    $target = "eventImg/".basename($_FILES['image']['name']);
    $image = $_FILES['image']['name'];
        
        
  if (empty($eventTitle)) {array_push($errors,  "event title is require");}
  if (empty($eventDate)) { array_push($errors, "event location is required"); }
  if (empty($eventDescription)) { array_push($errors, "event info is required"); }
  

  	$query = "INSERT INTO event (eventTitle, eventDate, eventDescription, eventImage, userID) 
  			  VALUES('$eventTitle', '$eventDate', '$eventDescription', '$image', (SELECT userID FROM user WHERE user.userID='$TheuserID'))";
  	mysqli_query($db, $query);
  	
  	$subject = "Your event ad has been added";
		$msg = " Please click this link to go to the homepage:
		http://malkhud2.create.stedwards.edu/TSM19/homepage.php
		";

		$headers = "From: noreply@referme.com";
		
		send_email($userEmail, $subject, $msg, $headers);

		
  	$_SESSION['eventTitle'] = $eventTitle;
  	
   if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
            	set_message("<p class='bg-success text-center'>Please check your email or spam folder for activation link</p>");

	            redirect("event.php");

        } else {
            $msg = " There was a problem uploading image";
        }
    }


////////////////////////////////////// LOGIN USER ////////////////////////////////////////////////
////////////////////////////////////// LOGIN USER ////////////////////////////////////////////////
////////////////////////////////////// LOGIN USER ////////////////////////////////////////////////


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
  	

  	$query = "SELECT * FROM user WHERE userEmail='$userEmail' AND userPassword='$userPassword'";

  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	    
  	    $sql="select userID, userRole from user WHERE userEmail='$userEmail' LIMIT 1";

        $result = $db->query($sql);

        if ($result->num_rows > 0) {
// output data of each row
        while($row = $result->fetch_assoc()) {
         $the_userID = $row['userID'];
         $the_userRole = $row['userRole'];
  	  session_start();
  	  $_SESSION['userID'] = $the_userID;
  	  $_SESSION['userEmail'] = $userEmail;
  	  $_SESSION['userPassword'] = $userPassword;
  	  $_SESSION['userRole'] = $the_userRole;
  	  $_SESSION['success'] = "You are now logged in";
}

  	  header('location: homepage.php?loginSuccessfully');
  	  
  	}else {
  	  $message =  "Wrong user_name/password combination";
 echo "<script type='text/javascript'>alert('$message');</script>";
  	}
  	    
  	}       
  	
  }
}


////////////////////////////////////// BTN CLUB FORM ////////////////////////////////////////////////
////////////////////////////////////// BTN CLUB FORM ////////////////////////////////////////////////
////////////////////////////////////// BTN CLUB FORM ////////////////////////////////////////////////


if (isset($_POST['btn-club-form'])) {
  $clubName = mysqli_real_escape_string($db, $_POST['clubName']);
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
  $clubDescription = mysqli_real_escape_string($db, $_POST['clubDescription']);
  $clubEmail = mysqli_real_escape_string($db, $_POST['clubEmail']);
  $TheuserID = mysqli_real_escape_string($db, $_POST['userID']);

  if (empty($clubName)) {array_push($errors,  "club name is require");}
  if (empty($clubDescription)) { array_push($errors, "club descruption is required"); }
  if (empty($clubEmail)) { array_push($errors, "club email is required"); }
    
  $user_check_query = "SELECT * FROM clubForm WHERE clubName='$clubName'  LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['clubName'] === $clubName) {
      array_push($errors, "email already exists");
    }

  }
  
if (count($errors) == 0) {

  	$query = "INSERT INTO clubForm (clubName, clubDescription, clubEmail, clubPostDate, userID, isApproved, NotApproved) 
  			  VALUES('$clubName', '$clubDescription', '$clubEmail', now(), (SELECT userID FROM user WHERE user.userID='$TheuserID'), 0, 0)";
  	mysqli_query($db, $query);
  	
  	 $subject = "Your Form has been submitted";
		$msg =  " Please wait for us to look at your form, whaile you wait use this link to our homepage. :)
		http://malkhud2.create.stedwards.edu/TSM19/homepage.php
		";

		$headers = "From: noreply@referme.com";

		
	   send_email($userEmail, $subject, $msg, $headers);
	   
  	$_SESSION['clubName'] = $clubName;
  	$_SESSION['success'] = "Tour Request has been send, wait for aprove";
  	header('location: ../homepage.php');
  }
}



////////////////////////////////////// RESET PASSWORD ////////////////////////////////////////////////
////////////////////////////////////// RESET PASSWORD ////////////////////////////////////////////////
////////////////////////////////////// RESET PASSWORD ////////////////////////////////////////////////

if (isset($_POST['rest_password'])) {
  $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

if (empty($userEmail)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match"); }
	
  if (count($errors) == 0) {
  	$userPassword = md5($password_1);
  	$query = "UPDATE user SET userPassword='$userPassword' where userEmail='$userEmail'";
  	$results = mysqli_query($db, $query);
  	
  	  header('location: login.php');
}

}
////////////////////////////////////// ACTIVATE USER ////////////////////////////////////////////////
////////////////////////////////////// ACTIVATE USER ////////////////////////////////////////////////
////////////////////////////////////// ACTIVATE USER ////////////////////////////////////////////////

function activate_user($db, $query) {


	if($_SERVER['REQUEST_METHOD'] == "GET") {


		if(isset($_GET['userEmail'])) {


			$userEmail = mysqli_real_escape_string($db, $_GET['userEmail']);

			$validationCode = mysqli_real_escape_string($db, $_GET['code']);


			$query = "SELECT userID FROM user WHERE userEmail = '".($_GET['userEmail'])."' AND validationCode = '".($_GET['code'])."' ";
			$result = mysqli_query($db, $query);
			

			if(mysqli_num_rows($result) == 1) {

			$query2 = "UPDATE user SET isActive = 1, validationCode = 0 WHERE userEmail = '".($userEmail)."' AND validationCode = '".($validationCode)."' ";
			$result2 = mysqli_query($db, $query2);

			set_message("<p class='alert alert-success'>Your account has been activated please login</p>");

			redirect("../login.php");


		} else {

			set_message("<p class='alert alert-danger'>Sorry Your account could not be activated </p>");

			redirect("../login.php");


			}




		} 


	}



} 

function email_user($db, $query) {


	if($_SERVER['REQUEST_METHOD'] == "GET") {


		if(isset($_GET['userEmail'])) {


			$userEmail = mysqli_real_escape_string($db, $_GET['userEmail']);

			$query = "SELECT userID FROM user WHERE userEmail = '".($_GET['userEmail'])."'";
			$result = mysqli_query($db, $query);
			

			if(mysqli_num_rows($result) == 1) {

			set_message("<p class='alert alert-success'>Your account has been activated please login</p>");

			redirect("../login.php");


		} else {

			set_message("<p class='alert alert-danger'>Sorry Your account could not be activated </p>");

			redirect("../login.php");


			}




		} 


	}



} 


?>