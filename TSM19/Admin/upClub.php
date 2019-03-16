<?php



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



function UpdateClubForm($conn, $clubFormID)
{
    if(isset($_GET['approve'])){
    
    $the_club = ($_GET['approve']);
    
$sql = "UPDATE clubForm SET isApproved ='1' WHERE clubFormID=$the_club";
//1


if (mysqli_query($conn, $sql)) {
header('location: getClubForm.php?Record updated successfully');
} else {
echo "Error updating record: " . mysqli_error($conn);
}
}
}

function RejectClubForm($conn, $clubFormID)
{
if(isset($_GET['reject'])){
    
    $the_club = ($_GET['reject']);

$sql = "UPDATE clubForm SET NotApproved='1' WHERE clubFormID=$the_club";


if (mysqli_query($conn, $sql)) {
header('location: getClubForm.php?Record updated successfully');
} else {
echo "Error updating record: " . mysqli_error($conn);
}
}
}

$conn= dbConnect();

UpdateClubForm($conn, $clubFormID);

RejectClubForm($conn, $clubFormID);






?>

