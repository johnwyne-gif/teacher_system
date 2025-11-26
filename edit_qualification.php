<?php
include 'includes/db.php';
$id=$_GET['id'];
$q=$conn->query("SELECT * FROM qualification WHERE Qualification_ID=$id")->fetch_assoc();
?>
<form method='post' action='update_qualification.php'>
<input type='hidden' name='id' value='<?= $q['Qualification_ID'] ?>'>
Degree:<input name='Degree' value='<?= $q['Degree'] ?>'>
Institution:<input name='Institution' value='<?= $q['Institution'] ?>'>
Graduation:<input name='Graduation_Year' value='<?= $q['Graduation_Year'] ?>'>
<button>Save</button></form>