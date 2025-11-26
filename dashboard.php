<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');
include 'includes/header.php';
?>
<div class="grid">
  <a class="card-link" href="add_instructor.php">Add Instructor + Qualification</a>
  <a class="card-link" href="add_teaching_load.php">Assign Teaching Load</a>
  <a class="card-link" href="add_evaluation.php">Add Evaluation</a>
  <a class="card-link" href="view_instructor.php">View Instructor Profiles</a>
</div>
<?php include 'includes/footer.php'; ?>
