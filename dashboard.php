<?php
include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

/* User security */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

$uid = $_SESSION['user_id'];

/* My registrations count */
$count = mysqli_fetch_assoc(mysqli_query($conn,
    "SELECT COUNT(*) AS total 
     FROM registrations 
     JOIN students ON registrations.student_id = students.id
     WHERE students.user_id = $uid"
))['total'];
?>

<div class="user-box">
    <h2>Student Dashboard</h2>

    <div class="user-card">
        <h3><?php echo $count; ?></h3>
        <p>My Registered Events</p>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
