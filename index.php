<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>KMGGP Events</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include("includes/navbar.php"); ?>

<!-- SLIDER -->
<div class="slider">
    <div class="slides">
        <img src="assets/images/slide1.jpeg">
        <img src="assets/images/slide2.jpeg">
        <img src="assets/images/slide3.jpeg">
        <img src="assets/images/slide4.jpeg">
        <img src="assets/images/slide5.jpeg">
        <img src="assets/images/slide6.jpeg">
        <img src="assets/images/slide7.jpeg">
    </div>
</div>

<div class="home-content">
    <h1>Welcome to KMGGP Event Management System</h1>
    <p>Manage Sports, Cultural & Academic events easily</p>

    <?php if(!isset($_SESSION['user_id'])){ ?>
        <a href="login.php" class="btn">Login</a>
        <a href="register.php" class="btn">Register</a>
    <?php } ?>
</div>

<script src="assets/js/script.js"></script>
</body>
</html>
