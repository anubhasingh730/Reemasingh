<?php
session_start();
include("../config/db.php");

include("../includes/header.php");
include("../includes/navbar.php");
?>

<div class="container">

<h2 style="text-align:center;margin-bottom:30px;">Previous Year Event Gallery</h2>

<div style="display:flex;justify-content:center;gap:40px;flex-wrap:wrap;">

<a href="gallery_category.php?category=Sports" style="text-decoration:none;">
<div style="width:220px;height:120px;background:#4CAF50;color:white;
display:flex;align-items:center;justify-content:center;
border-radius:10px;font-size:22px;font-weight:bold;">
Sports
</div>
</a>

<a href="gallery_category.php?category=Cultural" style="text-decoration:none;">
<div style="width:220px;height:120px;background:#9C27B0;color:white;
display:flex;align-items:center;justify-content:center;
border-radius:10px;font-size:22px;font-weight:bold;">
Cultural
</div>
</a>

<a href="gallery_category.php?category=Academic" style="text-decoration:none;">
<div style="width:220px;height:120px;background:#2196F3;color:white;
display:flex;align-items:center;justify-content:center;
border-radius:10px;font-size:22px;font-weight:bold;">
Academic
</div>
</a>

</div>

</div>

<?php include("../includes/footer.php"); ?>



