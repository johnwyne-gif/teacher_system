<?php
// includes/header.php
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Teacher Profiling System</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="topbar">
  <div class="brand">Teacher Profiling</div>
  <div class="nav-right">
    <?php if(isset($_SESSION['admin'])): ?>
      <span class="user">Hi, <?=htmlspecialchars($_SESSION['admin'])?></span>
      <a class="btn" href="dashboard.php">Dashboard</a>
      <a class="btn" href="logout.php">Logout</a>
    <?php endif; ?>
  </div>
</nav>
<main class="container">
