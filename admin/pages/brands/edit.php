<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<h2>Edit Brand</h2>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM brands WHERE id = $id");
$brand = $result->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $newImage = $_FILES['image'];

    $errors = [];
    if (empty($name)) $errors[] = "Brand name is required.";
    if ($newImage['error'] !== 4 && !in_array(pathinfo($newImage['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
        $errors[] = "Invalid image format. Only JPG, JPEG, and PNG are allowed.";
    }

    if (empty($errors)) {
        if ($newImage['error'] !== 4) {
            $target = '../../uploads/' . basename($newImage['name']);
            if (move_uploaded_file($newImage['tmp_name'], $target)) {
                unlink('../../uploads/' . $brand['image']);
                $stmt = $conn->prepare("UPDATE brands SET name = ?, description = ?, image = ? WHERE id = ?");
                $stmt->bind_param("sssi", $name, $description, $newImage['name'], $id);
            }
        } else {
            $stmt = $conn->prepare("UPDATE brands SET name = ?, description = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $description, $id);
        }

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
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
        <input type="text" name="name" id="name" value="<?= $brand['name']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"><?= $brand['description']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Brand Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
        <img src="../../uploads/<?= $brand['image']; ?>" alt="<?= $brand['name']; ?>" width="50">
        <small>Allowed file formats: JPG, JPEG, PNG.</small>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<?php include '../../includes/footer.php'; ?>