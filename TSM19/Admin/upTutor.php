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

function returnTutorForm($conn)
{
	$sql = "SELECT * FROM tutorForm";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
    		// output data of each row
    		while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["tutorFormID"]. " - is Approved: " . $row["isApproved"]. " " . "<br>";
  		  }
	} else {
    		echo "0 results";
		}

}//end of function



function UpdatetutorForm($conn, $tutorFormID)
{
if(isset($_GET['approve'])){
    
    $the_tform_id = ($_GET['approve']);

$sql = "UPDATE tutorForm SET isApproved='1' WHERE tutorFormID=$the_tform_id";


if (mysqli_query($conn, $sql)) {
header('location: getTutorForm.php?Record updated successfully');
} else {
echo "Error updating record: " . mysqli_error($conn);
}
}
}

function RejecttutorForm($conn, $tutorFormID)
{
if(isset($_GET['reject'])){
    
    $the_tform_id = ($_GET['reject']);

$sql = "UPDATE tutorForm SET NotApproved='1' WHERE tutorFormID=$the_tform_id";


if (mysqli_query($conn, $sql)) {
header('location: getTutorForm.php?Record updated successfully');
} else {
echo "Error updating record: " . mysqli_error($conn);
}
}
}

$conn= dbConnect();


UpdatetutorForm($conn, $tutorFormID);
RejecttutorForm($conn, $tutorFormID);

$conn->close();




?>

