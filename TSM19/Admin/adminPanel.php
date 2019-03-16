<?php  include('css/css.php'); ?>
<?php




$connection = mysqli_connect('localhost', 'malkhudc_TSM', '1m4a1m2K', 'malkhudc_TSM19');



$query = "SELECT * FROM tutorForm";
    $selectTutorForm = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($selectTutorForm)) {
    $tutorFormID = $row['tutorFormID'];
    $tutorGPA = $row['tutorGPA'];
    $tutorPostDate = $row['tutorPostDate'];
    $tutorSkills = $row['tutorSkills'];
    
    echo "<table id='t01'>
<tr>
<th>ID</th>
<th>GPA</th>
<th>Date & Time</th>
<th>SKILL</th>
<th>Accept</th>
<th>Reject</th>
</tr>";

    echo "<tr>";
    echo "<td>{$tutorFormID}</td>";
    echo "<td>{$tutorGPA}</td>";
    echo "<td>{$tutorPostDate}</td>";
    echo "<td>{$tutorSkills}</td>";
    echo '<td><a href="upTutor.php?tutorFormID=' . $row['tutorFormID'] . '">Accept</a></td>';
    echo '<td><a href="upTutor.php?tutorFormID=' . $row['tutorFormID'] . '">Reject</a></td>';
    echo "</tr>";


}
    
    echo "</table>";
    
    
    

?>
