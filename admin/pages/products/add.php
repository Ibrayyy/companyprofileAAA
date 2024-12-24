<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<h2>Add New Product</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']); // CKEditor value
    $price = floatval($_POST['price']);
    $stock_status = $_POST['stock_status'];
    $category_id = intval($_POST['category_id']);
    $brand_id = intval($_POST['brand_id']);
    $link_tokopedia = trim($_POST['link_tokopedia']);
    $link_blibli = trim($_POST['link_blibli']);
    $link_shopee = trim($_POST['link_shopee']);
    $image = $_FILES['image'];

    // Server-side validation
    $errors = [];
    if (empty($name)) $errors[] = "Product name is required.";
    if ($price <= 0) $errors[] = "Price must be a positive number.";
    if (empty($category_id)) $errors[] = "Please select a category.";
    if (empty($brand_id)) $errors[] = "Please select a brand.";
    if ($image['error'] === 4) $errors[] = "Product image is required.";
    elseif (!in_array(pathinfo($image['name'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png'])) {
        $errors[] = "Invalid image format. Only JPG, JPEG, and PNG are allowed.";
    }

    if (empty($errors)) {
        $target = '../../uploads/' . basename($image['name']);
        if (move_uploaded_file($image['tmp_name'], $target)) {
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock_status, category_id, brand_id, image, link_tokopedia, link_blibli, link_shopee) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdsisssss", $name, $description, $price, $stock_status, $category_id, $brand_id, $image['name'], $link_tokopedia, $link_blibli, $link_shopee);

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
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="brand_id">Brand</label>
        <select name="brand_id" id="brand_id" class="form-control" required>
            <option value="">Select Brand</option>
            <?php
            $brands = $conn->query("SELECT * FROM brands");
            while ($brand = $brands->fetch_assoc()) {
                echo "<option value='{$brand['id']}'>{$brand['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control" required>
            <option value="">Select Category</option>
            <?php
            $categories = $conn->query("SELECT * FROM categories");
            while ($category = $categories->fetch_assoc()) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" name="price" id="price" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stock_status">Stock Status</label>
        <select name="stock_status" id="stock_status" class="form-control" required>
            <option value="Available">Available</option>
            <option value="Out of Stock">Out of Stock</option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="link_tokopedia">Tokopedia Link</label>
        <input type="url" name="link_tokopedia" id="link_tokopedia" class="form-control">
    </div>
    <div class="form-group">
        <label for="link_blibli">Blibli Link</label>
        <input type="url" name="link_blibli" id="link_blibli" class="form-control">
    </div>
    <div class="form-group">
        <label for="link_shopee">Shopee Link</label>
        <input type="url" name="link_shopee" id="link_shopee" class="form-control">
    </div>
    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" name="image" id="image" class="form-control-file" required>
        <small>Allowed file formats: JPG, JPEG, PNG.</small>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<!-- Tambahkan CKEditor -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description');
</script>

<?php include '../../includes/footer.php'; ?>