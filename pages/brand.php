<?php include '../includes/header.php'; ?>
<?php
// Sertakan koneksi database
include '../admin/config/database.php';

// Query untuk mengambil data brands
$query = "SELECT * FROM brands";
$result = mysqli_query($conn, $query);

// Simpan data brand dalam array
$brands = [];
while ($row = mysqli_fetch_assoc($result)) {
    $brands[] = $row;
}
?>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>Brand - PT. Alfa Artha Andhaya</title>

<!-- Brands Section -->
<section class="brand">
    <h2>BRANDS</h2>
    <div class="brands-container">
        <?php foreach ($brands as $brand): ?>
            <div class="brand-item">
                <a href="detail.php?brand=<?php echo urlencode(strtolower($brand['name'])); ?>">
                    <img src="../admin/uploads/<?php echo $brand['image']; ?>" alt="<?php echo htmlspecialchars($brand['name']); ?>">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include '../includes/footer.php'; ?>