<?php
include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit;
}

$events = mysqli_query($conn,"
SELECT events.*, categories.category_name
FROM events
JOIN categories ON events.category_id = categories.id
");
?>

<div class="user-box">
<h2>Available Events</h2>

<table class="user-table">
<tr>
<th>Event</th><th>Category</th><th>Date</th><th>Venue</th><th>Action</th>
</tr>

<?php while($e=mysqli_fetch_assoc($events)){ ?>
<tr>
<td><?= $e['event_name'] ?></td>
<td><?= $e['category_name'] ?></td>
<td><?= $e['event_date'] ?></td>
<td><?= $e['venue'] ?></td>
<td>
<a href="register_event.php?event_id=<?= $e['id'] ?>" class="btn">Register</a>
</td>
</tr>
<?php } ?>
</table>
</div>

<?php include("../includes/footer.php"); ?>
