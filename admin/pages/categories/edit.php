<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<h2>Edit Category</h2>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM categories WHERE id = $id");
$category = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (empty($name)) {
        echo "<div class='alert alert-danger'>Category name is required.</div>";
    } else {
        $stmt = $conn->prepare("UPDATE categories SET name = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $description, $id);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }
}
?>

<form method="POST">
    <div class="form-group">
        <label for="name">Category Name</label>
        <input type="text" name="name" id="name" value="<?= $category['name']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"><?= $category['description']; ?></textarea>
</div>
    <button type="submit" class="btn btn-success">Update</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<?php include '../../includes/footer.php'; ?>
