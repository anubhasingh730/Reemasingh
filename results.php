<?php
include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

if(isset($_POST['add'])){
    mysqli_query($conn,"INSERT INTO results(event_id,student_id,position)
    VALUES('".$_POST['event']."','".$_POST['student']."','".$_POST['position']."')");
}

$events = mysqli_query($conn,"SELECT * FROM events");
$students = mysqli_query($conn,"SELECT students.id, users.name FROM students JOIN users ON students.user_id=users.id");
?>

<div class="admin-box">
<h2>Declare Results</h2>

<form method="post" class="admin-form">
<select name="event"><?php while($e=mysqli_fetch_assoc($events)){ ?><option value="<?= $e['id'] ?>"><?= $e['event_name'] ?></option><?php } ?></select>
<select name="student"><?php while($s=mysqli_fetch_assoc($students)){ ?><option value="<?= $s['id'] ?>"><?= $s['name'] ?></option><?php } ?></select>
<input type="text" name="position" placeholder="Position (1st,2nd)">
<button name="add">Save</button>
</form>
</div>

<?php include("../includes/footer.php"); ?>
