<?php
$host = "localhost:3307";
$user = "root";
$pass = "";        
$db   = "kmggpdb";  

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
