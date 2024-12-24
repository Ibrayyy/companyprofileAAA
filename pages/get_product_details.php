<?php
include '../admin/config/database.php'; // Koneksi ke database

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    $query = "SELECT p.*, b.name AS brand_name, c.name AS category_name 
              FROM products p 
              JOIN brands b ON p.brand_id = b.id 
              JOIN categories c ON p.category_id = c.id 
              WHERE p.id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // Format data untuk dikirim ke frontend
        $product['links'] = [
            'shopee' => $product['link_shopee'],
            'tokopedia' => $product['link_tokopedia'],
            'blibli' => $product['link_blibli']
        ];
        echo json_encode($product);
    } else {
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>