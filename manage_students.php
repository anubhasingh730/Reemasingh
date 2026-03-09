<?php
include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$data = mysqli_query($conn, "
    SELECT users.id, users.name, users.email 
    FROM users WHERE role='student'
");
?>

<div class="admin-box">
<h2>Registered Students</h2>

<table class="admin-table">
<tr><th>ID</th><th>Name</th><th>Email</th></tr>
<?php while($r=mysqli_fetch_assoc($data)){ ?>
<tr>
<td><?= $r['id'] ?></td>
<td><?= $r['name'] ?></td>
<td><?= $r['email'] ?></td>
</tr>
<?php } ?>
</table>
</div>

<?php include("../includes/footer.php"); ?>
