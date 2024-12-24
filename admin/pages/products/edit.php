<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<h2>Edit Product</h2>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = $id");
$product = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $stock_status = $_POST['stock_status'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $link_tokopedia = trim($_POST['link_tokopedia']);
    $link_shopee = trim($_POST['link_shopee']);
    $link_blibli = trim($_POST['link_blibli']);
    $newImage = $_FILES['image']['name'];

    // Validasi server-side
    $errors = [];
    if (empty($name)) $errors[] = "Product name is required.";
    if (!is_numeric($price) || $price <= 0) $errors[] = "Price must be a valid positive number.";
    if (empty($category_id) || !is_numeric($category_id)) $errors[] = "Category is required.";
    if (empty($brand_id) || !is_numeric($brand_id)) $errors[] = "Brand is required.";

    // Validasi URL jika diisi
    if (!empty($link_tokopedia) && !filter_var($link_tokopedia, FILTER_VALIDATE_URL)) {
        $errors[] = "Tokopedia link must be a valid URL.";
    }
    if (!empty($link_shopee) && !filter_var($link_shopee, FILTER_VALIDATE_URL)) {
        $errors[] = "Shopee link must be a valid URL.";
    }
    if (!empty($link_blibli) && !filter_var($link_blibli, FILTER_VALIDATE_URL)) {
        $errors[] = "Blibli link must be a valid URL.";
    }

    // Validasi file jika ada file baru
    if (!empty($newImage)) {
        $target = '../../uploads/' . basename($newImage);
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = strtolower(pathinfo($newImage, PATHINFO_EXTENSION));

        if (!in_array($imageExtension, $allowedExtensions)) {
            $errors[] = "Only JPG, JPEG, and PNG files are allowed.";
        }
        if ($_FILES['image']['size'] > 2000000) {
            $errors[] = "Image size should not exceed 2MB.";
        }
    }

    if (empty($errors)) {
        if (!empty($newImage)) {
            // Upload file baru
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                // Hapus file lama
                if (!empty($product['image'])) {
                    unlink('../../uploads/' . $product['image']);
                }
                $stmt = $conn->prepare(
                    "UPDATE products 
                     SET name = ?, description = ?, price = ?, stock_status = ?, category_id = ?, brand_id = ?, 
                         image = ?, link_tokopedia = ?, link_shopee = ?, link_blibli = ? 
                     WHERE id = ?"
                );
                $stmt->bind_param(
                    "ssdsisssssi",
                    $name,
                    $description,
                    $price,
                    $stock_status,
                    $category_id,
                    $brand_id,
                    $newImage,
                    $link_tokopedia,
                    $link_shopee,
                    $link_blibli,
                    $id
                );
            } else {
                echo "<div class='alert alert-danger'>Failed to upload the image.</div>";
            }
        } else {
            $stmt = $conn->prepare(
                "UPDATE products 
                 SET name = ?, description = ?, price = ?, stock_status = ?, category_id = ?, brand_id = ?, 
                     link_tokopedia = ?, link_shopee = ?, link_blibli = ? 
                 WHERE id = ?"
            );
            $stmt->bind_param(
                "ssdsissssi",
                $name,
                $description,
                $price,
                $stock_status,
                $category_id,
                $brand_id,
                $link_tokopedia,
                $link_shopee,
                $link_blibli,
                $id
            );
        }

        if ($stmt->execute()) {
            header("Location: index.php?message=Product+updated+successfully!");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>{$error}</div>";
        }
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']); ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="brand_id">Brand</label>
        <select name="brand_id" id="brand_id" class="form-control" required>
            <option value="">Select Brand</option>
            <?php
            $brands = $conn->query("SELECT * FROM brands");
            while ($brand = $brands->fetch_assoc()) {
                $selected = $product['brand_id'] == $brand['id'] ? 'selected' : '';
                echo "<option value='{$brand['id']}' {$selected}>{$brand['name']}</option>";
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
                $selected = $product['category_id'] == $category['id'] ? 'selected' : '';
                echo "<option value='{$category['id']}' {$selected}>{$category['name']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" id="price" value="<?= htmlspecialchars($product['price']); ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="stock_status">Stock Status</label>
        <select name="stock_status" id="stock_status" class="form-control" required>
            <option value="Available" <?= $product['stock_status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
            <option value="Out of Stock" <?= $product['stock_status'] == 'Out of Stock' ? 'selected' : ''; ?>>Out of Stock</option>
        </select>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"><?= htmlspecialchars($product['description']); ?></textarea>
    </div>
    <div class="form-group">
        <label for="link_tokopedia">Tokopedia Link</label>
        <input type="url" name="link_tokopedia" id="link_tokopedia" value="<?= htmlspecialchars($product['link_tokopedia']); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="link_shopee">Shopee Link</label>
        <input type="url" name="link_shopee" id="link_shopee" value="<?= htmlspecialchars($product['link_shopee']); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="link_blibli">Blibli Link</label>
        <input type="url" name="link_blibli" id="link_blibli" value="<?= htmlspecialchars($product['link_blibli']); ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" name="image" id="image" class="form-control-file">
        <?php if (!empty($product['image'])) : ?>
            <small>Current image: <?= htmlspecialchars($product['image']); ?></small>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success">Save Changes</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<!-- Tambahkan CKEditor -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description');
</script>

<?php include '../../includes/footer.php'; ?>