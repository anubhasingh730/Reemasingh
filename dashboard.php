
<?php
session_start();
include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

/* Total Registrations */
$reg_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM registrations");
$reg_data = mysqli_fetch_assoc($reg_query);
$regs = $reg_data['total'];

/* Total Students */
$student_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='student'");
$student_data = mysqli_fetch_assoc($student_query);
$students = $student_data['total'];

/* Total Events */
$event_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM events");
$event_data = mysqli_fetch_assoc($event_query);
$events = $event_data['total'];
?>

<div class="admin-box">

<h2>Admin Dashboard</h2>

<div class="card-grid">

<a href="view_registrations.php" style="text-decoration:none;">
<div class="dashboard-card">
<h3>Total Registrations</h3>
<p><?php echo $regs; ?></p>
</div>
</a>

<div class="dashboard-card">
<h3>Total Students</h3>
<p><?php echo $students; ?></p>
</div>

<div class="dashboard-card">
<h3>Total Events</h3>
<p><?php echo $events; ?></p>
</div>

</div>

</div>

<?php include("../includes/footer.php"); ?>
