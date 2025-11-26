<?php include 'includes/db.php'; $id=$_GET['id']; $t=$conn->query("SELECT * FROM teaching_load WHERE TeachingLoad_ID=$id")->fetch_assoc(); ?>
<form method='post' action='update_teaching_load.php'>
<input type='hidden' name='id' value='<?= $t['TeachingLoad_ID'] ?>'>
Subject:<input name='Subject_Name' value='<?= $t['Subject_Name'] ?>'>
Semester:<input name='Semester' value='<?= $t['Semester'] ?>'>
Year:<input name='Academic_Year' value='<?= $t['Academic_Year'] ?>'>
<button>Save</button></form>