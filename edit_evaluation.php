<?php include 'includes/db.php'; $id=$_GET['id']; $e=$conn->query("SELECT * FROM evaluation WHERE Evaluation_ID=$id")->fetch_assoc(); ?>
<form method='post' action='update_evaluation.php'>
<input type='hidden' name='id' value='<?= $e['Evaluation_ID'] ?>'>
Semester:<input name='Semester' value='<?= $e['Semester'] ?>'>
Year:<input name='Academic_Year' value='<?= $e['Academic_Year'] ?>'>
Rating:<input name='Rating' value='<?= $e['Rating'] ?>'>
<button>Save</button></form>