<?php
session_start();
require_once('../config/db.php'); 
include('../includes/header.php');
include('../includes/navbar.php');

$upload_msg = "";
$delete_msg = "";

// Handle Delete
if(isset($_GET['delete']) && $_GET['delete'] != "") {
    $del_path = "../uploads/gallery/" . $_GET['delete'];
    if(file_exists($del_path)) {
        unlink($del_path);
        $delete_msg = "Image deleted successfully!";
    } else {
        $delete_msg = "File not found!";
    }
}

// Handle Multiple Image Upload
if(isset($_POST['upload'])) {
    $folder = $_POST['folder'];
    $files = $_FILES['images'];

    if(!empty($files['name'][0])) {
        $target_dir = "../uploads/gallery/" . $folder . "/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0777, true);

        $success_count = 0;
        $fail_count = 0;

        for($i=0; $i<count($files['name']); $i++) {
            $filename = basename($files['name'][$i]);
            $target_file = $target_dir . $filename;
            if(move_uploaded_file($files['tmp_name'][$i], $target_file)) {

    $success_count++;

    // Save image in database
    $category = ucfirst($folder); 
    mysqli_query($conn,"INSERT INTO gallery(image_path,category) VALUES('$filename','$category')");
}
             else {
                $fail_count++;
            }
        }
        $upload_msg = "$success_count images uploaded successfully";
        if($fail_count > 0) $upload_msg .= ", $fail_count failed";
    } else {
        $upload_msg = "Please select images!";
    }
}

// Load all images
$folders = ["sports","cultural","academic"];
$images = [];

foreach($folders as $f) {
    $path = "../uploads/gallery/".$f."/";
    if(is_dir($path)) {
        $files = scandir($path);
        foreach($files as $img) {
            if($img != "." && $img != "..") {
                $images[] = [
                    "folder" => $f,
                    "file" => $img
                ];
            }
        }
    }
}
?>

<div class="container mt-4">
    <h2>Manage Gallery</h2>

    <!-- Messages -->
    <?php if($upload_msg != "") echo '<div class="alert alert-info">'.$upload_msg.'</div>'; ?>
    <?php if($delete_msg != "") echo '<div class="alert alert-danger">'.$delete_msg.'</div>'; ?>

    <!-- Multiple Upload Form -->
    <form method="POST" enctype="multipart/form-data" class="mb-4">
        <div class="row">
            <div class="col-md-3">
                <select name="folder" class="form-select" required>
                    <option value="">Select Folder</option>
                    <option value="sports">Sports</option>
                    <option value="cultural">Cultural</option>
                    <option value="academic">Academic</option>
                </select>
            </div>
            <div class="col-md-5">
                <input type="file" name="images[]" class="form-control" accept="image/*" multiple id="imageInput" required>
            </div>
            <div class="col-md-4">
                <button type="submit" name="upload" class="btn btn-primary">Upload Images</button>
            </div>
        </div>

        <!-- Preview -->
        <div class="row mt-3" id="previewContainer"></div>
    </form>

    <!-- Display Existing Gallery -->
<div class="row">
    <?php foreach($images as $img): ?>
        <div class="col-md-3 col-sm-4 col-6 mb-4">  <!-- responsive columns -->
            <div class="card">
                <img src="../uploads/gallery/<?php echo $img['folder']."/".$img['file']; ?>" class="card-img-top" style="height:180px; object-fit:cover;">
                <div class="card-body text-center p-2">
                    <p class="card-text mb-2" style="font-size:14px;"><?php echo ucfirst($img['folder']); ?></p>
                    <a href="manage_gallery.php?delete=<?php echo $img['folder']."/".$img['file']; ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>



<?php include('../includes/footer.php'); ?>

<!-- JS for Image Preview -->
<script>
document.getElementById('imageInput').addEventListener('change', function(){
    const previewContainer = document.getElementById('previewContainer');
    previewContainer.innerHTML = '';
    const files = this.files;

    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function(e){
            const col = document.createElement('div');
            col.classList.add('col-md-2', 'mb-3');
            col.innerHTML = `<img src="${e.target.result}" class="img-fluid" style="height:100px; object-fit:cover;">`;
            previewContainer.appendChild(col);
        }
        reader.readAsDataURL(file);
    });
});
</script>
