<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');
include 'includes/db.php';
include 'includes/header.php';

$res = $conn->query('SELECT i.*, d.Department_Name FROM instructor i LEFT JOIN department d ON i.Department_ID=d.Department_ID ORDER BY i.Last_Name');
?>
<div class="card">
  <h2>Instructor Profiles</h2>

  <?php while($i = $res->fetch_assoc()): ?>
    <div class="profile">

      <!-- LEFT SIDE -->
      <div class="p-left">
        <h3><?=htmlspecialchars($i['Last_Name'].', '.$i['First_Name'])?></h3>
        <p><strong>Department:</strong> <?=htmlspecialchars($i['Department_Name'])?></p>
        <p><strong>Email:</strong> <?=htmlspecialchars($i['Email'])?></p>
        <p><strong>Contact:</strong> <?=htmlspecialchars($i['Contact_Number'])?></p>
        <p><strong>Hired:</strong> <?=htmlspecialchars($i['Date_Hired'])?></p>

        <!-- ACTION BUTTONS -->
        <div class="action-buttons">
          <a href="edit_instructor.php?id=<?=$i['Instructor_ID']?>" class="btn-edit">Edit</a>
          <a href="delete_instructor.php?id=<?=$i['Instructor_ID']?>" class="btn-delete" onclick="return confirmDelete();">Delete</a>
        </div>
      </div>

      <!-- RIGHT SIDE -->
      <div class="p-right">

        <h4>Qualifications</h4>
        <?php
          $q = $conn->query('SELECT * FROM qualification WHERE Instructor_ID='.$i['Instructor_ID']);
          while($qr = $q->fetch_assoc()){
            echo '<p>'.htmlspecialchars($qr['Degree'].' - '.$qr['Institution'].' ('.$qr['Graduation_Year'].')').'</p>';
          }
        ?>

        <h4>Teaching Load</h4>
        <?php
          $t = $conn->query('SELECT * FROM teaching_load WHERE Instructor_ID='.$i['Instructor_ID']);
          while($tr = $t->fetch_assoc()){
            echo '<p>'.htmlspecialchars($tr['Subject_Name'].' — '.$tr['Semester'].' ('.$tr['Academic_Year'].')').'</p>';
          }
        ?>

        <h4>Evaluations</h4>
        <?php
          $e = $conn->query('SELECT * FROM evaluation WHERE Instructor_ID='.$i['Instructor_ID']);
          while($er = $e->fetch_assoc()){
            echo '<p>Rating: '.htmlspecialchars($er['Rating'].' — '.$er['Semester'].' ('.$er['Academic_Year'].')').'</p>';
          }
        ?>

      </div>
    </div>
    <hr>
  <?php endwhile; ?>
</div>

<!-- DELETE CONFIRMATION -->
<script>
function confirmDelete() {
  return confirm("Are you sure you want to delete this instructor? This cannot be undone.");
}
</script>

<?php include 'includes/footer.php'; ?>
