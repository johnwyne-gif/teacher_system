<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');
include 'includes/header.php';
?>
<!-- Dashboard Background -->
<div class="dashboard-background"></div>

<div class="dashboard-container">

    <!-- Logo & Title -->
    <div class="dashboard-header">
        <img src="assets/images/adfc_logo.png" alt="ADFC Logo" class="adfc-logo">
        <div class="header-text">
            <h1>Teacher Profiling System</h1>
            <p>Asian Development Foundation College</p>
        </div>
    </div>

    <!-- Navigation Cards -->
    <div class="grid">
        <a class="card-link" href="add_instructor.php">Add Instructor + Qualification</a>
        <a class="card-link" href="add_teaching_load.php">Assign Teaching Load</a>
        <a class="card-link" href="add_evaluation.php">Add Evaluation</a>
        <a class="card-link" href="view_instructor.php">View Instructor Profiles</a>
    </div>

</div>

<?php include 'includes/footer.php'; ?>
