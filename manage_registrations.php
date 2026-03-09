<?php
include("../config/db.php");

$query="SELECT events.event_name,registrations.student_name,registrations.branch,registrations.year
FROM registrations
JOIN events ON events.id=registrations.event_id";

$result=mysqli_query($conn,$query);
?>

<table border="1">

<tr>
<th>Event</th>
<th>Name</th>
<th>Branch</th>
<th>Year</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result))
{
?>

<tr>
<td><?php echo $row['event_name']; ?></td>
<td><?php echo $row['student_name']; ?></td>
<td><?php echo $row['branch']; ?></td>
<td><?php echo $row['year']; ?></td>
</tr>

<?php } ?>

</table>