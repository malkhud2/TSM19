<?php  include('includes/server.php'); ?>
<?php include('includes/errors.php'); ?>
<?php 


printTop();
 printloginForm();
 



   
printBottom();



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
  "<link rel='stylesheet' href='./CSS/TSMstyle.css' type='text/css' /> \n" .
"</head>  \n".

"<body>\n".
  
   " <header>\n".
        "<div class='row'>\n".
            "<div>\n".
                "<img class='img-responsive' src='./Images/reverME.png' alt='Chania' width='460' height='345'>\n".
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
        "<li><a href='http://malkhud2.create.stedwards.edu/TSM19/register.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>\n".
        "<li><a href='http://malkhud2.create.stedwards.edu/TSM19/login.php'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>\n".
      "</ul>\n".
    "</div>\n".
  "</div>\n".
"</nav>\n";

    }




function printloginForm() {
    
print    
    "<div class='well'>\n".

"<div class='container'>\n".
 "<form class='form' method='post' action='login.php' >\n".
      	"<h2>Login </h2>\n".
             "<div class='well'>\n".
    "<div class='form-group'>\n".
      "<label for='userEmail'>Email:</label>\n".
      "<input type='email' class='form-control'  placeholder='Enter email' name='userEmail' style='height:50px'>\n".
      "</div>\n".
    "<div class='form-group'>\n".
      "<label for='userPassword'>Password:</label>\n".
      "<input type='password' class='form-control'  placeholder='Enter password' name='userPassword' style='height:50px'>\n".
    "</div>\n".
    "</div>\n".
    
    "<button type='submit' class='btn btn-primary' name='login_user'>Submit</button>\n".
    "<br />\n".
    "<br />\n".
    "<p> Not yet a member? <a href='register.php'>Sign up</a></p>\n".
  	"<p> Forgot your <a href='forgotPassword.php'>Password</a></p>\n".
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





    

    
            



