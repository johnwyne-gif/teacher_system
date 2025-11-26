<?php
include 'includes/db.php';

if (!isset($_GET['id'])) {
    header("Location: view_instructor.php");
    exit();
}

$id = intval($_GET['id']);

// Delete qualifications
$conn->query("DELETE FROM qualification WHERE Instructor_ID = $id");

// Delete teaching load
$conn->query("DELETE FROM teaching_load WHERE Instructor_ID = $id");

// Delete evaluations
$conn->query("DELETE FROM evaluation WHERE Instructor_ID = $id");

// Delete instructor
$conn->query("DELETE FROM instructor WHERE Instructor_ID = $id");

header("Location: view_instructor.php?msg=deleted");
exit();
?>
