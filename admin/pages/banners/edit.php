

<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>
<h2>Edit Banner</h2>

<?php
$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM banner WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$banner = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $new_image = $_FILES['image']['name'];
    $imageFileType = strtolower(pathinfo($new_image, PATHINFO_EXTENSION)); // Get file extension
    $target = '../../uploads/' . basename($new_image);
    $allowedExtensions = ['jpg', 'jpeg', 'png'];

    // If a new image is uploaded, validate it
    if ($new_image) {
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "<div class='alert alert-danger'>Invalid file format. Only JPG, JPEG, and PNG are allowed.</div>";
            $image = $banner['image']; // Keep old image
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $image = $new_image;
            } else {
                echo "<div class='alert alert-danger'>Failed to upload new image.</div>";
                $image = $banner['image']; // Keep old image
            }
        }
    } else {
        $image = $banner['image']; // Keep old image if no new image is uploaded
    }

    $stmt = $conn->prepare("UPDATE banner SET name=?, description=?, image=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $description, $image, $id);

    if ($stmt->execute()) {
        header("Location: index.php?message=Product+updated+successfully!");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Banner Name</label>
        <input type="text" name="name" id="name" value="<?php echo $banner['name']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"><?php echo $banner['description']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Banner Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
        <p>Current Image: <img src="../../uploads/<?php echo $banner['image']; ?>" width="100"></p>
        <small class="text-muted">Only image files are allowed: PNG, JPG, JPEG.</small>
    </div>
    
    <button type="submit" class="btn btn-success">Update</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<?php include '../../includes/footer.php'; ?>
