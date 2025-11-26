<?php
session_start();
if (!isset($_SESSION['admin'])) header('Location: index.php');

include 'includes/db.php';
include 'includes/header.php';

if (!isset($_GET['id'])) header("Location: view_instructor.php");

$id = intval($_GET['id']);
$res = $conn->query("SELECT * FROM instructor WHERE Instructor_ID = $id");
$inst = $res->fetch_assoc();

$dept = $conn->query("SELECT * FROM department");
?>
<div class="card">
    <h2>Edit Instructor</h2>

    <form method="POST" action="update_instructor.php">

        <input type="hidden" name="id" value="<?=$inst['Instructor_ID']?>">

        <div class="two-column-form">

            <div class="left-column">

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="Last_Name" value="<?=$inst['Last_Name']?>" required>
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="First_Name" value="<?=$inst['First_Name']?>" required>
                </div>

                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="Middle_Name" value="<?=$inst['Middle_Name']?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Gender</label>
                        <select name="Gender">
                            <option <?=$inst['Gender']=='Male'?'selected':''?>>Male</option>
                            <option <?=$inst['Gender']=='Female'?'selected':''?>>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Birth Date</label>
                        <input type="date" name="Birth_Date" value="<?=$inst['Birth_Date']?>">
                    </div>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="Email" value="<?=$inst['Email']?>">
                </div>

                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="Contact_Number" value="<?=$inst['Contact_Number']?>">
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea name="Address"><?=$inst['Address']?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Department</label>
                        <select name="Department_ID">
                            <?php while($d = $dept->fetch_assoc()): ?>
                                <option value="<?=$d['Department_ID']?>" 
                                    <?=$d['Department_ID']==$inst['Department_ID']?'selected':''?>>
                                    <?=$d['Department_Name']?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Date Hired</label>
                        <input type="date" name="Date_Hired" value="<?=$inst['Date_Hired']?>">
                    </div>
                </div>

            </div>
        </div>

        <div class="submit-row">
            <button type="submit" class="save-btn">Update Instructor</button>
        </div>

    </form>
</div>

<?php include 'includes/footer.php'; ?>
