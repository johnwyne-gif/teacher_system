<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');
include 'includes/db.php';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ins = intval($_POST['instructor']);
    $sub = $conn->real_escape_string($_POST['subject']);
    $sem = $conn->real_escape_string($_POST['semester']);
    $ay = $conn->real_escape_string($_POST['ay']);
    $conn->query("INSERT INTO teaching_load (Instructor_ID, Subject_Name, Semester, Academic_Year)
        VALUES ($ins, '$sub', '$sem', '$ay')");
    $success = 'Assigned subject to instructor.';
}
include 'includes/header.php';
?>
<div class="card">
  <h2>Assign Teaching Load</h2>
  <?php if($success) echo '<p class="success">'.htmlspecialchars($success).'</p>'; ?>
  <form method="post" class="form">
    <label>Instructor</label>
    <select name="instructor">
      <?php $res = $conn->query('SELECT Instructor_ID, First_Name, Last_Name FROM instructor');
        while($r = $res->fetch_assoc()){
          echo '<option value="'.$r['Instructor_ID'].'">'.htmlspecialchars($r['Last_Name'].', '.$r['First_Name']).'</option>';
        }
      ?>
    </select>
    <label>Subject Name</label><input name="subject" required>
    <label>Semester</label><select name="semester"><option>1st</option><option>2nd<option>3rd</option><option>4th</option>/option></select>
    <label>Academic Year</label><input name="ay" placeholder="2024-2025">
    <button class="btn primary" type="submit">Assign</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
