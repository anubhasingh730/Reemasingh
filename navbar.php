<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?> 

<div class="navbar">
    <a href="/Reemasingh/index.php">Home</a>
    

    <?php if(isset($_SESSION['user_id'])): ?>

        <?php if($_SESSION['role'] == 'admin'): ?>
            <a href="/Reemasingh/admin/dashboard.php">Admin Dashboard</a>
            <a href="/Reemasingh/admin/manage_events.php">Manage Events</a>
            <a href="/Reemasingh/admin/manage_categories.php">Categories</a>
            <a href="/Reemasingh/admin/manage_gallery.php">Manage Gallery</a>

        <?php else: ?>
            <a href="/Reemasingh/user/dashboard.php">Dashboard</a>
            <a href="/Reemasingh/user/view_events.php">View Events</a>
            <a href="/Reemasingh/user/my_events.php">My Events</a>
            <a href="/Reemasingh/user/gallery.php">Previous Year Gallery</a>

        <?php endif; ?>

        <a href="/Reemasingh/logout.php">Logout</a>

    <?php else: ?>

        <a href="/Reemasingh/login.php">Login</a>
        <a href="/Reemasingh/register.php">Register</a>

    <?php endif; ?>
</div>
