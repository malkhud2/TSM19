<?php  include('../includes/server.php'); ?>
<?php
session_start();
$db = mysqli_connect('localhost', 'malkhudc_TSM', '1m4a1m2K', 'malkhudc_TSM19');


printTop();

if(isset($_SESSION['userEmail']) && $_SESSION['userPassword'] && $_SESSION['userID'] && $_SESSION['userRole'] == 'Tutor') {


     
$conn = dbConnect();
open();
returnTutorForm($conn);
close();
$conn->close();
}


  else {
          
    print "<div class='well'>\n";
    print "<section>\n";
    print "    <div class='container'>\n";
    print "<br><h3>It appears you are not logged in, or you don't have permission to view this page </h3> \n";
    print "<br><h3>Try to log in again <a href='../login.php'>login</a>, or go back to <a href='../homepage.php'>Homepage</a></h3>  \n";
    print        "</div>\n";
    print"</section>\n";
    print"</div> \n";
  }
  
  
   
printBottom();



function printTop() {
    print
    "<!DOCTYPE html> \n".
"<html lang='en'> \n".
"<head> \n".
    
    "<!--<meta name='viewport' content='width=device-width'>-->\n".
    "<title>reverME</title>\n".
    "<!--<link rel='stylesheet' href='../CSS/TSMstyle.css'>-->\n".
    "<meta charset='utf-8'>\n".
  "<meta name='viewport' content='width=device-width, initial-scale=1'>\n".
  "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>\n".
    "<link rel='stylesheet' type='text/css' href='http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css'>\n".
  "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>\n".
  "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>\n".
    "<script src='http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js'></script>\n".

  "<link rel='stylesheet' href='../CSS//TSMstyle.css' type='text/css' /> \n" .
"</head>  \n".

"<body>\n".
  
   " <header>\n".
"<div class='row'>\n".
"<div>\n".
                "<img class='img-responsive' src='../Images/reverME.png' alt='Chania' width='460' height='345'>\n".
            "</div>\n".
         " </div>\n".
         
         "<script type='text/javascript' class='init'>
		   $(document).ready(function() {
			   $('#tutor').DataTable();
		   });
		</script>\n".
	
		"<style>
			h1 { 
				padding-top: 25px;
				padding-bottom: 25px;
				border: 1.5px solid;
				border-radius: 25px;
				align: center;
				background-color: #c9daea;
			}
			
		</style>\n".
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
        "<li><a href='http://malkhud2.create.stedwards.edu/TSM19/logout.php'><span class='glyphicon glyphicon-log-out'></span> logout</a></li>\n".
      "</ul>\n".
      
"</div>\n".

"</div>\n".
"</nav>\n";

    }
    

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



function open(){
    print
        "<div class='col-md-10 col-md-offset-1'>\n".
        "<div class='container'>\n".
    "<input class='btn btn-primary' type='button' value='Refresh Page For New Requests' onClick='location.href=location.href'>\n".
      "<a type='submit' class='btn btn-danger' href='tutor.php'>Go Back</a>\n".
    "<h2 align='center'>Tutor Requests</h2>\n";
}

function close(){
    print

    "</div>\n".
    "</br>\n";
}




function returnTutorForm($conn)
{
$sql = "SELECT * FROM tutoringRequest, user where tutoringRequest.userID = user.userID ORDER BY tutoringRequestID DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $tutoringRequestID = $row['tutoringRequestID'];
    $tutoringCourse = $row['tutoringCourse'];
    $tutoringTime = $row['tutoringTime'];
    $tutoringDate = $row['tutoringDate'];
    $tutoringDuration = $row['tutoringDuration'];
    $tutoringLocation = $row['tutoringLocation'];
    $userID = $row['userID'];
    
    
    
    echo  

"<div class='content'>\n".
"<img src='http://malkhud2.create.stedwards.edu/TSM19/Images/new.png' width='42' height='42'>\n".
"<h3>New Request</h3>\n";



    
    echo        

     "$tutoringDate : ";
     

    $links = array();
    $parts = explode(',', $row['tutoringCourse']);
    foreach ($parts as $tag )
    {
        $links[] = "<a href='t-".$tag."'>".$tag."</a>";

    }
    echo implode(", ", $links);
    echo '</p>';
    
echo 

 "</br>\n".
     "<a type='submit' class='btn btn-primary' href='viewTutor.php?tutoringRequestID=$tutoringRequestID&userID=$userID'>View Request</a>\n".


 "</br>\n".
 "</div>\n";



}
}
}


function printBottom() {

    print
       "<footer class='container-fluid text-center'> \n".
  "<p>referME, 2018-2019, ST.EDWARDS.EDU</p>\n".
"</footer>\n".
        "</body> \n".
        "</html> \n";
}


?>


	
