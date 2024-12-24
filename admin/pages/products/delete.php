<?php
include '../../session.php'; 
include '../../config/database.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the product to delete the image
    $query = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $imagePath = '../../uploads/' . $product['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image
        }

        // Delete the product from the database
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: index.php?message=Product+deleted+successfully!");
        } else {
            header("Location: index.php?error=Failed+to+delete+product.");
        }
    }
}
?>
