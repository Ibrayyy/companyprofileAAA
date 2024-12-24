<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<h2>Add New Brand</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $image = $_FILES['image'];

    // Server-side validation
    $errors = [];
    if (empty($name)) $errors[] = "Brand name is required.";
    if ($image['error'] === 4) $errors[] = "Brand image is required.";
    elseif (!in_array(pathinfo($image['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
        $errors[] = "Invalid image format. Only JPG, JPEG, and PNG are allowed.";
    }

    if (empty($errors)) {
        $target = '../../uploads/' . basename($image['name']);
        if (move_uploaded_file($image['tmp_name'], $target)) {
            $stmt = $conn->prepare("INSERT INTO brands (name, description, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $description, $image['name']);
            if ($stmt->execute()) {
                header('Location: index.php');
                exit;
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Failed to upload image.</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Brand Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Brand Image</label>
        <input type="file" name="image" id="image" class="form-control-file" required>
        <small>Allowed file formats: JPG, JPEG, PNG.</small>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<?php include '../../includes/footer.php'; ?>
