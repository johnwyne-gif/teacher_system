<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');
include 'includes/db.php';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lname = $conn->real_escape_string($_POST['lname']);
    $fname = $conn->real_escape_string($_POST['fname']);
    $mname = $conn->real_escape_string($_POST['mname']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $birth = $conn->real_escape_string($_POST['birth']);
    $email = $conn->real_escape_string($_POST['email']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $address = $conn->real_escape_string($_POST['address']);
    $dept = intval($_POST['department']);
    $hired = $conn->real_escape_string($_POST['hired']);

    $conn->query("INSERT INTO instructor
        (Last_Name, First_Name, Middle_Name, Gender, Birth_Date, Email, Contact_Number, Address, Department_ID, Date_Hired)
        VALUES ('$lname','$fname','$mname','$gender','$birth','$email','$contact','$address',$dept,'$hired')");
    $ins_id = $conn->insert_id;

    // qualification (single entry on this form)
    $degree = $conn->real_escape_string($_POST['degree']);
    $insti = $conn->real_escape_string($_POST['institution']);
    $grad = intval($_POST['grad_year']);
    if ($ins_id) {
        $conn->query("INSERT INTO qualification (Instructor_ID, Degree, Institution, Graduation_Year)
            VALUES ($ins_id, '$degree', '$insti', $grad)");
        $success = 'Instructor and qualification saved.';
    }
}
include 'includes/header.php';
?>
<div class="card">
  <h2>Add Instructor + Qualification</h2>
  <?php if($success) echo '<p class="success">'.htmlspecialchars($success).'</p>'; ?>
  <form method="POST" class="two-column-form">

    <div class="left-column">

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lname" required>
        </div>

        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="fname" required>
        </div>

        <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="mname">
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Gender</label>
                <select name="gender">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>

            <div class="form-group">
                <label>Birth Date</label>
                <input type="date" name="birth">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email">
            </div>

            <div class="form-group">
                <label>Contact</label>
                <input type="text" name="contact">
            </div>
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address"></textarea>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Department</label>
                <select name="department">
                    <?php
                    $dept = $conn->query("SELECT * FROM department");
                    while ($d = $dept->fetch_assoc()) {
                        echo "<option value='{$d['Department_ID']}'>{$d['Department_Name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Date Hired</label>
                <input type="date" name="hired">
            </div>
        </div>

    </div>

    <div class="right-column">
        <h3 class="section-title">Educational Background</h3>

        <div class="form-group">
            <label>Degree</label>
            <input type="text" name="degree">
        </div>

        <div class="form-group">
            <label>Institution</label>
            <input type="text" name="institution">
        </div>

        <div class="form-group">
            <label>Graduation Year</label>
            <input type="number" name="grad_year">
        </div>

        <p class="note">You can add more qualifications later from the profile page.</p>
    </div>

    <div class="full-row">
        <button class="btn primary" type="submit">Save Instructor</button>
    </div>

</form>
</div>
<?php include 'includes/footer.php'; ?>
