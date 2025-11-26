<?php
include 'includes/db.php';

$id = intval($_POST['id']);

$Last = $_POST['Last_Name'];
$First = $_POST['First_Name'];
$Middle = $_POST['Middle_Name'];
$Gender = $_POST['Gender'];
$Birth = $_POST['Birth_Date'];
$Email = $_POST['Email'];
$Contact = $_POST['Contact_Number'];
$Address = $_POST['Address'];
$Dept = $_POST['Department_ID'];
$Hired = $_POST['Date_Hired'];

$sql = "
UPDATE instructor SET
    Last_Name = '$Last',
    First_Name = '$First',
    Middle_Name = '$Middle',
    Gender = '$Gender',
    Birth_Date = '$Birth',
    Email = '$Email',
    Contact_Number = '$Contact',
    Address = '$Address',
    Department_ID = '$Dept',
    Date_Hired = '$Hired'
WHERE Instructor_ID = $id
";

$conn->query($sql);

header("Location: view_instructor.php?msg=updated");
exit();
?>
