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

if(isset($_GET['bookID']) && ($_GET['userID'])){
    $the_book_id = ($_GET['bookID']);
    $the_userID = ($_GET['userID']);
$sql = "select * FROM book, user where book.bookID=$the_book_id AND book.userID=$the_userID LIMIT 1";



if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
 
echo "<div class='container' style='padding-top: 60px;'>";
  echo "<div class='row'>";

    echo "</div>";
echo"<div class='col-md-8 col-sm-6 col-xs-12 personal-info'>";
     echo "<div class='alert alert-info alert-dismissable'>";
       echo "<a class='panel-close close' data-dismiss='alert'>×</a>";
      echo  "<i class='fa fa-coffee'></i>You can pay by <strong>Cash</strong> and on campus only</div>";

        while($row = mysqli_fetch_array($result)){

 
     echo "<div class='media'>";
    echo "<div class='media-left'>\n";
     echo "<img src='http://malkhud2.create.stedwards.edu/TSM19/Club/clubImg/5.png' class='media-object' style='width:80px'>\n";
    echo  "</div>";
    echo "</br>\n";
    echo "<div class='media-body'>\n";
     echo "<h4 class='media-heading'>Book ID:</h4>\n";
     echo "" . $row['bookID'] ."";
    echo  "</div>";
    echo "</br>\n";
    echo "<div class='media-body'>\n";
     echo "<h4 class='media-heading'>Book Title:</h4>\n";
     echo ""  . $row['bookTitle'] ."";
    echo  "</div>";
            echo "</br>\n";


    
    echo "<div class='media-body'>\n";
     echo "<h4 class='media-heading'>Book ISBN:</h4>\n";
     echo "" . $row['bookISBN'] ."";
    echo  "</div>";
        echo "</br>\n";

    echo "<div class='media-body'>\n";
     echo "<h4 class='media-heading'>Book Price:</h4>\n";
     echo "" . $row['bookPrice'] ."";
    echo  "</div>";
            echo "</br>\n";

     echo "<div class='media-body'>\n";
     echo "<h4 class='media-heading'>Post Date:</h4>\n";
     echo "" . $row['bookPostDate'] ."";
    echo  "</div>";
        echo "</br>\n";
        
             echo "<div class='media-body'>\n";
     echo "<h4 class='media-heading'>More Information:</h4>\n";
     echo "" . $row['bookDescription'] ."";
    echo  "</div>";
        echo "</br>\n";
            echo "<div class='media-body'>\n";
     echo "<h4 class='media-heading'>Book Post:</h4>\n";
     echo "<img src='bookImg/".$row['bookImage']."' style='width:500px'>";
    echo  "</div>";

  echo  "</div>";
  
                    echo "</br>";
                    echo "<li> <a href='http://malkhud2.create.stedwards.edu/TSM19/Book/book.php' class='btn btn-danger'> Back </a></li>";

                  }


              echo"</div>";
    echo "</div>";
      echo"</div>";
    echo "</div>";


        
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
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







