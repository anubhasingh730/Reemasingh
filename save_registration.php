<?php
session_start();
include '../config/db.php';

$student_id = $_SESSION['user_id'];   // login user id

$name = $_POST['name'];
$branch = $_POST['branch'];
$year = $_POST['year'];
$event_id = $_POST['event_id'];

$sql = "INSERT INTO registrations (student_id,event_id, student_name, branch, year)
VALUES ('$student_id','$event_id','$name','$branch','$year')";

mysqli_query($conn,$sql);

header("Location: my_events.php");
?>