<?php  include('../includes/server.php'); ?>
<?php
session_start();

printTop();

if(isset($_SESSION['userEmail']) && $_SESSION['userPassword'] && $_SESSION['userID']) {

    print 
printtutorForm();
viewForm();
        

        
    }

  else{
    print "<div class='well'>\n";
    print "<section>\n";
    print "    <div class='container'>\n";
    print "<br>It appears you Don't have accses To this page.\n";
    print "<br>Try to log in again Click: <a href='../login.php'>here</a> \n";
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
    "<!--<link rel='stylesheet' href='../CSS//TSMstyle.css'>-->\n".
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
    
    
function printtutorForm() {
    
print    

    "<div class='container'>\n".
          "<a type='submit' class='btn btn-danger' href='../homepage.php'>Homepage</a>\n".

"</div>\n".
"</br>".

    "<div class='container'>\n".
    "<div class='contentTutor'>\n".
        "<h3>Request Tutor</h3>\n".
            "<form method='post' action='tutor_new_post.php' >\n".
"<button type='submit' class='btn btn-primary' name='new_ad'>Request Tutor</button>\n".
"</form>\n".
"</div>\n";


    
}

function viewForm() {
    
print    
    "<div class='contentTutor'>\n".
        "<h3>View Requests</h3>\n".
            "<form method='post' action='tutorLookAtForm.php' >\n".
"<button type='submit' class='btn btn-primary' name='new_ad'>View Requests</button>\n".
"</div>\n".
"</form>\n".
"</div>\n".
"</br>";


    
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