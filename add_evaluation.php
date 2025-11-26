<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');
include 'includes/db.php';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ins = intval($_POST['instructor']);
    $sem = $conn->real_escape_string($_POST['semester']);
    $ay = $conn->real_escape_string($_POST['ay']);
    $rating = floatval($_POST['rating']);
    $conn->query("INSERT INTO evaluation (Instructor_ID, Semester, Academic_Year, Rating)
        VALUES ($ins, '$sem', '$ay', $rating)");
    $success = 'Evaluation saved.';
}
include 'includes/header.php';
?>
<div class="card">
  <h2>Add Evaluation</h2>
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
    <label>Semester</label><select name="semester"><option>1st</option><option>2nd</option></select>
    <label>Academic Year</label><input name="ay" placeholder="2024-2025">
    <label>Rating (0-5)</label><input name="rating" type="number" step="0.01" min="0" max="5" required>
    <button class="btn primary" type="submit">Save Evaluation</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
