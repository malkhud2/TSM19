<?php  include('../includes/server.php'); ?>
<?php include('../includes/errors.php'); ?>
<?php
session_start();


printTop();

if(isset($_SESSION['userEmail']) && $_SESSION['userPassword']) {

 
$conn = dbConnect();
printloginForm($conn);
$conn->close();
   
}

    

  else {
          
    print "<div class='well'>\n";
    print "<section>\n";
    print "    <div class='container'>\n";
    print "<br>It appears you are not logged in.\n";
    print "<br>Try to log in again.  Click: <a href='./login.php'>here</a> \n";
    print        "</div>\n";
    print"</section>\n";
    print"</div> \n";
  }

  


printBottom();


function dbConnect()
{
$servername = "localhost";
$username = "malkhudc_TSM";
$password = "1m4a1m2K";
$dbname = "malkhudc_TSM19";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
return $conn;
} //end of function

function printTop() {
    print
    "<!DOCTYPE html> \n".
"<html lang='en'> \n".
"<head> \n".
    
    "<!--<meta name='viewport' content='width=device-width'>-->\n".
    "<title>reverME</title>\n".
    "<meta charset='utf-8'>\n".
  "<meta name='viewport' content='width=device-width, initial-scale=1'>\n".
  "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>\n".
  "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>\n".
  "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>\n".
     "<link rel='stylesheet' href='../CSS/TSMstyle.css' type='text/css' /> \n" .
     "<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>\n".
"<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>\n".
"<script src='//code.jquery.com/jquery-1.11.1.min.js'></script>\n".

"</head>  \n".

"<body>\n".
  
   " <header>\n".
        "<div class='row'>\n".
            "<div>\n".
                "<img class='img-responsive' src='../Images/reverME.png' alt='Chania' width='460' height='345'>\n".
            "</div>\n".
         " </div>\n".
    "</header> \n".
            "<nav class='navbar navbar-inverse'>\n".
  "<div class='container-fluid'>\n".
    "<div class='navbar-header'>\n".
      "<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#myNavbar'>\n".
        "<span class='icon-bar'></span>\n".
        "<span class='icon-bar'></span>\n".
        "<span class='icon-bar'></span> \n".                       
      "</button>\n".
      "<a class='navbar-brand' href='http://malkhud2.create.stedwards.edu/TSM19/homepage.php'>referME</a>\n".
    "</div>\n".
    "<div class='collapse navbar-collapse' id='myNavbar'>\n".
      "<ul class='nav navbar-nav'>\n".
      "</ul>\n".
      "<ul class='nav navbar-nav navbar-right'>\n".
        "<li><a href='http://malkhud2.create.stedwards.edu/TSM19/Profile/userProfile.php'><span class='glyphicon glyphicon-user'></span> User Profile</a></li>\n".
         "<li><a href='http://malkhud2.create.stedwards.edu/TSM19/logout.php'><span class='glyphicon glyphicon-log-out'></span> logout</a></li>\n".
      "</ul>\n".
    "</div>\n".
  "</div>\n".
"</nav>\n";



    }
    

function printloginForm($conn)
{
$userEmail = $_SESSION['userEmail'];

$sql = "SELECT * FROM user where userEmail='{$userEmail}'";

if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
 
echo "<div class='container' style='padding-top: 60px;'>";
  echo "<div class='row'>";
    echo "<div class='col-md-4 col-sm-6 col-xs-12'>";
     echo  "<div class='text-center'>";
 echo "<img src='http://malkhud2.create.stedwards.edu/TSM19/Images/reverME.png' width='300' height='300' class='img-circle'>";
      echo"</div>";
    echo "</div>";
echo"<div class='col-md-8 col-sm-6 col-xs-12 personal-info'>";
     echo "<div class='alert alert-info alert-dismissable'>";
       echo "<a class='panel-close close' data-dismiss='alert'>×</a>";
      echo  "<i class='fa fa-coffee'></i>Welcome <strong>{$userEmail}</strong>. to your profile.</div>";

        while($row = mysqli_fetch_array($result)){

echo "<form class='form-horizontal' role='form'>";
        echo "<div class='form-group'>";
         echo "<label class='col-lg-3 control-label'>First name:</label>";
         echo "<div class='col-lg-8'>";
         echo   "<input class='form-control' value=" . $row['userFirstName'] . " type='text'>";
         echo "</div>";
      echo  "</div>";
      echo "<form class='form-horizontal' role='form'>";
        echo "<div class='form-group'>";
         echo "<label class='col-lg-3 control-label'>Last Name:</label>";
         echo "<div class='col-lg-8'>";
         echo   "<input class='form-control' value=" . $row['userLastName'] . " type='text'>";
         echo "</div>";
      echo  "</div>";
           echo "<form class='form-horizontal' role='form'>";
        echo "<div class='form-group'>";
         echo "<label class='col-lg-3 control-label'>Email:</label>";
         echo "<div class='col-lg-8'>";
         echo   "<input class='form-control' value=" . $row['userEmail'] . " type='text'>";
         echo "</div>";
      echo  "</div>";
           echo "<form class='form-horizontal' role='form'>";
        echo "<div class='form-group'>";
         echo "<label class='col-lg-3 control-label'>University:</label>";
         echo "<div class='col-lg-8'>";
         echo   "<input class='form-control' value=" . $row['userUniversity'] . " type='text'>";
         echo "</div>";
      echo  "</div>";
           echo "<form class='form-horizontal' role='form'>";
        echo "<div class='form-group'>";
         echo "<label class='col-lg-3 control-label'>Major:</label>";
         echo "<div class='col-lg-8'>";
         echo   "<input class='form-control' value=" . $row['userMajor'] . " type='text'>";
         echo "</div>";
      echo  "</div>";
        echo "<div class='form-group'>";
          echo "<label class='col-md-3 control-label'></label>";
          echo "<div class='col-md-8'>";
            echo"<li> <a href='http://malkhud2.create.stedwards.edu/TSM19/Profile/userProfile1.php'  class='btn btn-primary'> Tutor Form </a></li>";
                    echo"<li> <a href='http://malkhud2.create.stedwards.edu/TSM19/Profile/userProfile2.php'  class='btn btn-primary'> Club Form </a></li>";
       echo   "</div>";
     echo   "</div>";
   echo   "</form>";
  echo  "</div>";
 echo "</div>";
echo"</div>";

        }

        
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
}



function printBottom() {

    print
    "</br>\n".
       "<footer class='container-fluid text-center'> \n".
  "<p>referME, 2018-2019, ST.EDWARDS.EDU</p>\n".
"</footer>\n".
        "</body> \n".
        "</html> \n";
}


?>


