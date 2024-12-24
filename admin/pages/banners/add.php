
<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>
<h2>Add New Banner</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $target = '../../uploads/' . basename($image);
    $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION)); // Get file extension

    // Valid extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    // Check if file is allowed
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "<div class='alert alert-danger'>Invalid file format. Only JPG, JPEG, and PNG are allowed.</div>";
    } else {
        // Upload file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $stmt = $conn->prepare("INSERT INTO banner (name, description, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $description, $image);

            if ($stmt->execute()) {
                header('Location: index.php');
                exit;
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Failed to upload image.</div>";
        }
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Banner Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Banner Image</label>
        <input type="file" name="image" id="image" class="form-control-file" required>
        <!-- Menampilkan pemberitahuan jenis format -->
        <small class="text-muted">Only image files are allowed: PNG, JPG, JPEG. 1920 x 1080px</small>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<?php include '../../includes/footer.php'; ?>
