<?php
session_start();
include("../config/db.php");

$category = $_GET['category'];

$query = mysqli_query($conn,"SELECT * FROM gallery WHERE category='$category'");

include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container">

<h2 style="text-align:center;margin-bottom:30px;"><?php echo $category; ?> Gallery</h2>

<div class="insta-gallery">

<?php 
if(mysqli_num_rows($query)>0){
while($row=mysqli_fetch_assoc($query)){
?>

<div class="insta-item">
<img src="../uploads/gallery/<?php echo strtolower($row['category']); ?>/<?php echo $row['image_path']; ?>">
</div>

<?php } } else { ?>

<p>No photos available.</p>

<?php } ?>

</div>

</div>

<?php include("../includes/footer.php"); ?>
