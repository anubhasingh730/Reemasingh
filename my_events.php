<?php
session_start();
include '../config/db.php';
include("../includes/header.php");
include("../includes/navbar.php");


$query = mysqli_query($conn,"
SELECT events.*
FROM registrations
JOIN events ON registrations.event_id = events.id
");

?>

<table class="table">

<tr>
<th>Event</th>
<th>Venue</th>
<th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($query)){ ?>

<tr>
<td><?php echo $row['event_name']; ?></td>
<td><?php echo $row['venue']; ?></td>
<td><?php echo $row['event_date']; ?></td>
</tr>

<?php } ?>

</table>