<?php  include('../includes/server.php'); ?>
<?php include('../includes/errors.php'); ?>
<?php 
session_start();


$db = mysqli_connect('localhost', 'malkhudc_TSM', '1m4a1m2K', 'malkhudc_TSM19');



printTop();

if(isset($_SESSION['userEmail']) && $_SESSION['userPassword'] && $_SESSION['userID']) {

    print 

printloginForm();
   
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

function printloginForm() {
    
print    
    "<div class='well'>\n".
        "<div class='container'>\n".
    "<h2>Are you in a Club</h2>\n".
 "<form method='post' action='clubForm.php' >\n".
     "<input type='hidden' name='userID' userID='userID' value=' ".$_SESSION['userID']."'>\n".
     "<input type='hidden' name='userEmail' userEmail='userEmail' value=' ".$_SESSION['userEmail']."'>\n".

      	
      "<div class='well'>\n".
    "<div class='form-group'>\n".
      "<label for='clubName'>Club Name:</label>\n".
      "<input type='text' class='form-control'  name='clubName' style='height:50px'>\n".
      "</div>\n".
      
      "<div class='form-group'>\n".
      "<label for='clubDescription'>Club Description:</label>\n".
      " <textarea class='form-control 'name='clubDescription'  cols='30' rows='10'>\n".
     " </textarea>\n".
      "</div>\n".
     
     
      
      "<div class='form-group'>\n".
      "<label for='clubEmail'>Club Email:</label>\n".
      "<input type='email' class='form-control'  name='clubEmail' style='height:50px'>\n".
      "</div>\n".
      

    "<div class='container'>\n".
    "<button type='submit' class='btn btn-default' name='btn-club-form'>Submit</button>\n".
    "</div>\n".
    
  	"</div>\n".
  	
"</form>\n".

"</div>\n".
"</div>\n";


    
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


