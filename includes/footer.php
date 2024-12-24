
<!-- ======= Footer ======= -->

<?php
// Sertakan koneksi database
include '../admin/config/database.php';

// Query untuk mengambil data merek dari tabel brands
$query = "SELECT * FROM brands";
$result = mysqli_query($conn, $query);

// Simpan data brands dalam array
$brands = [];
while ($row = mysqli_fetch_assoc($result)) {
    $brands[] = $row;
}
?>
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Garis di Atas Footer -->
<div class="footer-top-border"></div>

<!-- Footer -->
<footer>
  <div class="wrapper">
    <!-- Logo Perusahaan di Tengah -->
    <div class="footer-company-logo">
      <img src="../assets/logo.png" alt="Company Logo">
    </div>
    <div class="footer-content">
      <!-- Section Brands -->
      <div class="footer-brand-logos">
        <p>Brands</p>
        <div class="footer-brands-grid">
          <?php if (!empty($brands)): ?>
            <?php foreach ($brands as $brand): ?>
              <div class="footer-brand-logo">
                <img src="../admin/uploads/<?php echo $brand['image']; ?>" alt="<?php echo htmlspecialchars($brand['name']); ?> Brand">
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No brands available</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Section Contact Information -->
      <div>
        <p>Contact Information</p>
        <ul>
          <li>📞 0274-6239-1111</li>
          <li>📱 0821-0009-0007</li>
          <li><a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=CllgCJTNqQVzDFvqjTSwtKFFhvVzGcGTJLCXQSVwRBsksrnqmkCtdFPrrZTXLqsWxrWCXGNPFXB&"
            >✉️ support@a-tri.com</a></li>
          <li><a href="https://maps.app.goo.gl/4YEVXimEcm6nWAAY8">🏢 Ruko Harco Mangga Dua Blok G No. 8 Jakarta Pusat 10730</a></li>
        </ul>
      </div>

      <!-- Section Quick Links -->
      <div>
        <p>Quick Links</p>
        <ul>
          <li><a href="/aaafrontend/pages/index.php">Home</a></li>
          <li><a href="/aaafrontend/pages/brand.php">Brands</a></li>
          <li><a href="/aaafrotend/pages/product.php">Our Products</a></li>
          <li><a href="/aaafrontend/pages/aboutus.php">About Us</a></li>
          <li><a href="/aaafrontend/pages/faq.php">FAQ</a></li>
          <li><a href="/aaafrontend/pages/#btn-search">Search</a></li>
        </ul>
      </div>

      <!-- Section Social Media -->
      <div>
        <p>Social Media</p>
        <ul>
          <li><i class="fa-brands fa-instagram"></i> <a href="https://www.instagram.com/alfa.artha.andhaya/?hl=en">Instagram</a></li>
          <li><i class="fa-brands fa-facebook"></i><a href="https://www.facebook.com/atrig8/">Facebook</a></li>
          <li><i class="fa-brands fa-youtube"></i><a href="https://www.youtube.com/@pt.alfaarthaandhaya">Youtube</a></li>
          <li><i class="fa-brands fa-tiktok"></i><a href="https://www.tiktok.com/@alfaarthaandhaya">Tiktok</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Footer Bottom -->
  <div class="footer-bottom">
    <p>&copy; Copyright © 2024 AlfaArthaAndhaya. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
