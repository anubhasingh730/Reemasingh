<?php
include '../config/db.php';

$event = $_GET['event'];
$category = $_GET['category'];

$stmt = $conn->prepare(
    "SELECT image_path FROM gallery WHERE event_name = ? AND category = ?"
);
$stmt->bind_param("ss", $event, $category);
$stmt->execute();
$result = $stmt->get_result();
?>

<h3 class="text-center"><?= ucfirst($event) ?> Photos</h3>

<div class="container d-flex flex-wrap">
<?php while($img = $result->fetch_assoc()): ?>
    <div class="m-2">
        <img src="../<?= $img['image_path'] ?>"
             width="220" height="160"
             style="object-fit:cover;border-radius:8px;">
    </div>
<?php endwhile; ?>
</div>
