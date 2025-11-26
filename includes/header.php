<?php
// includes/header.php
if (session_status() == PHP_SESSION_NONE) session_start();

// Detect current page
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Teacher Profiling System</title>
<link rel="stylesheet" href="assets/style.css">

<style>
/* Active Button Highlight */
.nav-right .btn.active {
    background-color: #2563eb !important;
    color: #fff !important;
    font-weight: 600;
    box-shadow: 0 0 10px rgba(37,99,235,0.4);
}
</style>

</head>
<body>
<nav class="topbar">
  <div class="brand">Teacher Profiling</div>
  <div class="nav-right">
    <?php if(isset($_SESSION['admin'])): ?>

      <span class="user">Hi, <?=htmlspecialchars($_SESSION['admin'])?></span>

      <a class="btn <?= ($current_page=='add_instructor.php' ? 'active' : '') ?>" 
         href="add_instructor.php">Instructor + Qualification</a>

      <a class="btn <?= ($current_page=='add_teaching_load.php' ? 'active' : '') ?>" 
         href="add_teaching_load.php">Teaching Load</a>

      <a class="btn <?= ($current_page=='add_evaluation.php' ? 'active' : '') ?>" 
         href="add_evaluation.php">Evaluation</a>

      <a class="btn <?= ($current_page=='dashboard.php' ? 'active' : '') ?>" 
         href="dashboard.php">Dashboard</a>

      <a class="btn <?= ($current_page=='view_instructor.php' ? 'active' : '') ?>" 
         href="view_instructor.php">View Instructors</a>

      <a class="btn <?= ($current_page=='logout.php' ? 'active' : '') ?>" 
         href="logout.php">Logout</a>
      
    <?php endif; ?>
  </div>
</nav>

<main class="container">
