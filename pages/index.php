<?php include '../includes/header.php'; ?>
<?php
// Sertakan koneksi database
include '../admin/config/database.php';

// Query untuk mengambil data banner
$query = "SELECT * FROM banner";
$result = mysqli_query($conn, $query);

// Simpan data banner dalam array
$banners = [];
while ($row = mysqli_fetch_assoc($result)) {
  $banners[] = $row;
}

?>
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

<title>Home - PT. Alfa Artha Andhaya</title>
<!-- Carousel Section -->
<section class="carousel">
  <div class="carousel-container">
    <?php foreach ($banners as $index => $banner): ?>
      <!-- Pastikan untuk menambahkan path folder 'admin/uploads' sebelum nama file gambar -->
      <img src="../admin/uploads/<?php echo $banner['image']; ?>"
        alt="<?php echo htmlspecialchars($banner['name']); ?>"
        class="slide <?php echo $index === 0 ? 'active' : ''; ?>">
    <?php endforeach; ?>
  </div>
  <div class="carousel-indicators">
    <?php foreach ($banners as $index => $banner): ?>
      <span class="dot <?php echo $index === 0 ? 'active' : ''; ?>" data-slide="<?php echo $index; ?>"></span>
    <?php endforeach; ?>
  </div>

  <button class="prev"> ⮘ </button>
  <button class="next"> ⮚ </button>
</section>

<script>
  let currentIndex = 0;
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
      dots[i].classList.toggle('active', i === index);
    });
  }

  document.querySelector('.next').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % slides.length;
    showSlide(currentIndex);
  });

  document.querySelector('.prev').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    showSlide(currentIndex);
  });

  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      currentIndex = index;
      showSlide(currentIndex);
    });
  });
</script>

<!-- About Us Section -->
<section class="about-us">
  <div class="about-us-container">
    <img src="../assets/ABOUT US.png" alt="About Us Image" class="about-us-image">
    <div class="about-us-text">
      <h2>ABOUT US</h2>
      <p>
        PT Alfa Artha Andhaya is an IT distribution company established since 2003,
        delivering products from top brands such as MSI, darkFlash, Transcend, Acer Official Lisence
        and Predator. With branches in various major cities in Indonesia, we are committed to
        providing the best service for customers and maintaining environmental sustainability.
      </p>
      <button onclick="window.location.href='../pages/aboutus.php'">Read More</button>
    </div>
  </div>
</section>

<!-- Brands Section -->
<section class="brands">
  <h2>BRANDS</h2>
  <div class="brands-slider">
    <button class="brands-prev" aria-label="Previous">&#10094;</button>
    <div class="brands-slider-container">
      <?php foreach ($brands as $brand): ?>
        <div class="brand-slide">
          <a href="detail.php?brand=<?php echo urlencode(strtolower($brand['name'])); ?>">
            <img src="../admin/uploads/<?php echo $brand['image']; ?>" alt="<?php echo htmlspecialchars($brand['name']); ?>">
          </a>
        </div>
      <?php endforeach; ?>
    </div>
    <button class="brands-next" aria-label="Next">&#10095;</button>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const brandsSliderContainer = document.querySelector('.brands-slider-container');
    const brandsPrevButton = document.querySelector('.brands-prev');
    const brandsNextButton = document.querySelector('.brands-next');
    const brandSlides = document.querySelectorAll('.brand-slide');

    let currentBrandIndex = 0;
    const totalBrandSlides = brandSlides.length;

    // Fungsi untuk memperbarui posisi slide
    function updateBrandSlidePosition() {
      brandsSliderContainer.style.transform = `translateX(-${currentBrandIndex * 100}%)`;
    }

    // Tombol Previous
    brandsPrevButton.addEventListener('click', () => {
      currentBrandIndex = (currentBrandIndex - 1 + totalBrandSlides) % totalBrandSlides;
      updateBrandSlidePosition();
    });

    // Tombol Next
    brandsNextButton.addEventListener('click', () => {
      currentBrandIndex = (currentBrandIndex + 1) % totalBrandSlides;
      updateBrandSlidePosition();
    });

    // Set posisi awal
    updateBrandSlidePosition();
  });
</script>

<!-- Contact Us Section -->
<section class="contactus">
  <h2>Contact Us</h2>
  <div class="contact-bubble">
    <div class="contact-info">
      <p><i class="fas fa-map-marker-alt"></i> Ruko Harco Mangga Dua Blok G No. 8 Jakarta Pusat</p>
      <p><i class="fas fa-phone-alt"></i> 021-6220-111</p>
      <p><i class="fas fa-envelope"></i> support@a-tri.com</p>
      <div class="working-hours">
        <p><i class="fa-solid fa-clock"></i> Monday - Friday:</p>
        <p>09.00 - 17.00 WIB</p>
      </div>
      <div class="working-hours">
        <p><i class="fa-solid fa-clock"></i> Saturday:</p>
        <p>09.00 - 14.00 WIB</p>
      </div>
      <button onclick="window.location.href='../pages/aboutus.php#contact-us'">Contact Us</button>
    </div>
    <div class="contact-map">
      <iframe id="map-embed"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.952846393918!2d106.82694187355305!3d-6.137037860163055!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5f9b9da03d3%3A0xa62547839c44bc5f!2sPT.%20Alfa%20Artha%20Andhaya!5e0!3m2!1sid!2sid!4v1731922090958!5m2!1sid!2sid"
        width="350" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>
</section>

<?php include '../includes/footer.php'; ?>