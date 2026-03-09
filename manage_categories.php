<?php
include("../config/db.php");
include("../includes/header.php");
include("../includes/navbar.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

/* Add category */
if (isset($_POST['add'])) {
    $name = $_POST['category_name'];
    mysqli_query($conn, "INSERT INTO categories(category_name) VALUES('$name')");
}

/* Delete category */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM categories WHERE id=$id");
}

$data = mysqli_query($conn, "SELECT * FROM categories");
?>

<div class="admin-box">
    <h2>Manage Categories</h2>

    <form method="post" class="admin-form">
        <input type="text" name="category_name" placeholder="Category Name" required>
        <button name="add">Add Category</button>
    </form>

    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($data)){ ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['category_name'] ?></td>
            <td>
                <a href="?delete=<?= $row['id'] ?>" class="btn-danger">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

<?php include("../includes/footer.php"); ?>
