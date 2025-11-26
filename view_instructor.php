<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');
include 'includes/db.php';
include 'includes/header.php';

// Handle search input
$search = '';
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

// Build SQL with case-insensitive search
$sql = "SELECT i.*, d.Department_Name 
        FROM instructor i 
        LEFT JOIN department d 
        ON i.Department_ID = d.Department_ID";

if (!empty($search)) {
    $s = strtolower($conn->real_escape_string($search));
    $sql .= " WHERE LOWER(i.First_Name) LIKE '%$s%'
              OR LOWER(i.Last_Name) LIKE '%$s%'
              OR LOWER(i.Middle_Name) LIKE '%$s%'";
}

$sql .= " ORDER BY i.Last_Name";

$res = $conn->query($sql);
?>

<style>
/* Wrapper */
.search-wrapper {
    margin-bottom: 22px;
}

/* Search Bar with Icon */
.search-container {
    position: relative;
    display: inline-block;
}

.search-container .search-box {
    width: 320px;
    padding: 12px 16px 12px 42px;  /* space for icon */
    border-radius: 12px;
    border: 1px solid #cdd2da;
    font-size: 15px;
    outline: none;
    transition: 0.2s;
    background-color: #fff;
}

.search-container .search-box:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 8px rgba(59,130,246,0.35);
}

/* Search Icon */
.search-container::before {
    content: "🔍";
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    opacity: 0.7;
}

/* Search Button */
.search-btn {
    padding: 12px 20px;
    border-radius: 12px;
    background-color: #2563eb;
    color: white;
    font-size: 15px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: .2s;
}

.search-btn:hover {
    background-color: #1e4fd6;
}
</style>

<div class="card">
  <h2>Instructor Profiles</h2>

  <!-- SEARCH BAR -->
  <div class="search-wrapper">
      <form method="GET" action="view_instructor.php" style="display:flex;gap:10px;align-items:center;">
          
          <div class="search-container">
              <input 
                type="text"
                name="search"
                class="search-box"
                placeholder="Search instructor name..."
                value="<?= htmlspecialchars($search) ?>"
              >
          </div>

          <button type="submit" class="search-btn">Search</button>

      </form>
  </div>

  <?php while($i = $res->fetch_assoc()): ?>
    <div class="profile">

      <!-- LEFT -->
      <div class="p-left">
        <h3><?=htmlspecialchars($i['Last_Name'].', '.$i['First_Name'])?></h3>
        <p><strong>Department:</strong> <?=htmlspecialchars($i['Department_Name'])?></p>
        <p><strong>Email:</strong> <?=htmlspecialchars($i['Email'])?></p>
        <p><strong>Contact:</strong> <?=htmlspecialchars($i['Contact_Number'])?></p>
        <p><strong>Hired:</strong> <?=htmlspecialchars($i['Date_Hired'])?></p>

        <div class="action-buttons">
          <a href="edit_instructor.php?id=<?=$i['Instructor_ID']?>" class="btn-edit">Edit</a>
          <a href="delete_instructor.php?id=<?=$i['Instructor_ID']?>" class="btn-delete" onclick="return confirmDelete();">Delete</a>
        </div>
      </div>

      <!-- RIGHT -->
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
          $e = $conn->query("
              SELECT DISTINCT Rating, Semester, Academic_Year
              FROM evaluation 
              WHERE Instructor_ID = ".$i['Instructor_ID']."
              ORDER BY Academic_Year DESC, Semester ASC
          ");

          if ($e->num_rows == 0) {
              echo "<p>No evaluations recorded.</p>";
          } else {
              while ($er = $e->fetch_assoc()) {
                  echo '<p>Rating: <strong>'.htmlspecialchars($er['Rating']).'</strong> — '
                       .htmlspecialchars($er['Semester']).' ('
                       .htmlspecialchars($er['Academic_Year']).')</p>';
              }
          }
        ?>
      </div>

    </div>
    <hr>
  <?php endwhile; ?>
</div>

<script>
function confirmDelete() {
  return confirm("Are you sure you want to delete this instructor?");
}
</script>

<?php include 'includes/footer.php'; ?>
