<?php
session_start();
include("config/db.php");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email' AND password='$password'"
    );

    if(mysqli_num_rows($query) == 1){
        $row = mysqli_fetch_assoc($query);

        // ✅ SESSION SET
        $_SESSION['user_id']    = $row['id'];
        $_SESSION['student_id'] = $row['id'];  
        $_SESSION['role']       = $row['role'];

        // ✅ REDIRECT
        if($row['role'] == 'admin'){
            header("Location: admin/dashboard.php");
        } else {
            header("Location: user/dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="form-box">
    <h2>Login</h2>

    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>

</body>
</html>
