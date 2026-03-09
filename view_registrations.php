
<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

/* Delete registration */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM registrations WHERE id='$id'");
    header("Location: view_registrations.php");
}

/* Fetch registrations */
$query = mysqli_query($conn,"
SELECT registrations.id, registrations.student_name, registrations.branch, registrations.year, events.event_name
FROM registrations
JOIN events ON registrations.event_id = events.id
ORDER BY registrations.id DESC
");
?>

<?php include("../includes/header.php"); ?>
<?php include("../includes/navbar.php"); ?>

<div class="admin-box">

<h2>Student Registrations</h2>

<table class="admin-table">

<tr>
<th>S.No.</th>
<th>Student Name</th>
<th>Event</th>
<th>Branch</th>
<th>Year</th>
<th>Action</th>
</tr>

<?php 
$count = 1;
if(mysqli_num_rows($query) > 0){
while($row=mysqli_fetch_assoc($query)){ ?>

<tr>
<td><?php echo $count++; ?></td>
<td><?php echo $row['student_name']; ?></td>
<td><?php echo $row['event_name']; ?></td>
<td><?php echo $row['branch']; ?></td>
<td><?php echo $row['year']; ?></td>

<td>
<a href="?delete=<?php echo $row['id']; ?>" 
class="btn-danger"
onclick="return confirm('Delete this registration?')">
Delete
</a>
</td>

</tr>

<?php } 
}else{ ?>

<tr>
<td colspan="6">No registrations found</td>
</tr>

<?php } ?>

</table>

</div>

<?php include("../includes/footer.php");
