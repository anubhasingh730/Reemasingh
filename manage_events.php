<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

include("../includes/header.php");
include("../includes/navbar.php");

/* Categories */
$cats = mysqli_query($conn, "SELECT * FROM categories");

/* Add event */
if (isset($_POST['add'])) {
    $cid   = $_POST['category_id'];
    $name  = $_POST['event_name'];
    $date  = $_POST['event_date'];
    $venue = $_POST['venue'];

    mysqli_query($conn, "INSERT INTO events (category_id,event_name,event_date,venue)
                         VALUES ('$cid','$name','$date','$venue')");
    header("Location: manage_events.php");
    exit;
}

/* Delete event */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM events WHERE id=$id");
    header("Location: manage_events.php");
    exit;
}

$events = mysqli_query($conn, "
    SELECT events.*, categories.category_name 
    FROM events 
    JOIN categories ON events.category_id = categories.id
");
?>

<div class="admin-container">

    <h2 class="admin-title">Manage Events</h2>

    <!-- Add Event Form -->
    <div class="card">
        <h3>Add New Event</h3>

        <form method="post" class="admin-form">
            <select name="category_id" required>
                <option value="">Select Category</option>
                <?php while($c=mysqli_fetch_assoc($cats)){ ?>
                    <option value="<?= $c['id'] ?>"><?= $c['category_name'] ?></option>
                <?php } ?>
            </select>

            <input type="text" name="event_name" placeholder="Event Name" required>
            <input type="date" name="event_date" required>
            <input type="text" name="venue" placeholder="Venue" required>

            <button type="submit" name="add" class="btn-primary">Add Event</button>
        </form>
    </div>

    <!-- Event List -->
    <div class="card">
        <h3>All Events</h3>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php while($e=mysqli_fetch_assoc($events)){ ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= $e['event_name'] ?></td>
                    <td><?= $e['category_name'] ?></td>
                    <td><?= date("d M Y", strtotime($e['event_date'])) ?></td>
                    <td><?= $e['venue'] ?></td>
                    <td>
                        <a href="?delete=<?= $e['id'] ?>" 
                           class="btn-danger"
                           onclick="return confirm('Delete this event?')">
                           Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

<?php include("../includes/footer.php"); ?>

