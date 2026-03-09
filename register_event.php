<?php
session_start();
include '../config/db.php';

if(!isset($_GET['event_id'])){
    echo "Invalid Event";
    exit();
}

$event_id = $_GET['event_id'];
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="container mt-5">

<h3>Event Registration Form</h3>

<form method="POST" action="save_registration.php">

<input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

<div class="mb-3">
<label>Student Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label>Branch</label>
<input type="text" name="branch" class="form-control" required>
</div>

<div class="mb-3">
<label>Year</label>
<select name="year" class="form-control">
<option>1st Year</option>
<option>2nd Year</option>
<option>3rd Year</option>
</select>
</div>

<button type="submit" class="btn btn-success">
Submit Registration
</button>

</form>

</div>

<?php include '../includes/footer.php'; ?>