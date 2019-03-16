<?php  include('../includes/server.php'); ?>
<?php include('../includes/errors.php'); ?>
<?php 
session_start();


printTop();

if(isset($_SESSION['userEmail']) && $_SESSION['userPassword']) {

     

open();

$conn = dbConnect();

returnBookForm($conn);

$conn->close();

close();
   
}

    

  else {
          
    print "<div class='well'>\n";
    print "<section>\n";
    print "    <div class='container'>\n";
    print "<br>It appears you are not logged in.\n";
    print "<br>Try to log in again.  Click: <a href='../login.php'>here</a> \n";
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
  "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>\n".
  "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>\n".
  "<link rel='stylesheet' href='../CSS//TSMstyle.css' type='text/css' /> \n" .
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
        "<li><a href='http://malkhud2.create.stedwards.edu/TSM19/logout.php'><span class='glyphicon glyphicon-log-out'></span> logout</a></li>\n".
      "</ul>\n".
    "</div>\n".
  "</div>\n".
"</nav>\n";

    }
    



function printbookForm() {
    
print    
"<div class='well'>\n".
    "<div class='container'>\n".
        "<h2>New book Ad</h2>\n".
            "<form method='post' action='book_new_post.php' >\n".
"<button type='submit' class='btn btn-primary' name='new_ad'>New Book Ad</button>\n".
"</div>\n".
"</form>\n".
"</div>\n";


    
}

function open(){
    print
    
    "<div class='col-md-10 col-md-offset-1'>".
        "<div class='container'>\n".
    "<input class='btn btn-primary' type='button' value='Refresh Page For New Events' onClick='location.href=location.href'>\n".
    "</br>\n".
    "<form method='post' action='book_new_post.php' >\n".
    "<button type='submit' class='btn btn-primary' name='new_ad'>Add New Book</button>\n".
    "</form>\n".
     "<li> <a href='http://malkhud2.create.stedwards.edu/TSM19/homepage.php' class='btn btn-danger'> Homepage </a></li>".

    "</br>\n".
    "<h1 align='center'> All books Ad</h1>".
    "</div>\n".
    "</div>\n".
    "<div class='container'>\n";
}




function close(){
    print
     
        "</div>\n".

    "</div>\n".
    "</br>\n";
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



function returnBookForm($conn)
{

$sql = "SELECT * FROM book, user where book.userID = user.userID ORDER BY bookID DESC ";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $bookID = $row['bookID'];
    $bookTitle = $row['bookTitle'];
    $bookISBN = $row['bookISBN'];
    $bookPrice = $row['bookPrice'];
    $bookPostDate = $row['bookPostDate'];
    $bookDescription = $row['bookDescription'];
    $bookImage = $row['bookImage'];
    $userID = $row['userID'];
    
    echo
"<div class='bookphoto'>\n".
"<img src='http://malkhud2.create.stedwards.edu/TSM19/Images/new.png' width='42' height='42'>\n".
"<h3>New book Ad</h3>\n";
    
    
    echo        
    '<p>Book Name: ';

    

    $links = array();
    $parts = explode(',', $row['bookTitle']);
    foreach ($parts as $tag )
    {
        $links[] = "<a href='t-".$tag."'>".$tag."</a>";

    }
    echo implode(", ", $links);
    echo '</p>';
    
    echo

 "</br>\n".
     "<a type='submit' class='btn btn-primary' href='viewBook.php?bookID=$bookID&userID=$userID'>View Book</a>".
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





    

    
            



