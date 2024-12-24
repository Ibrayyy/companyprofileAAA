<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../brand.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<title>MSI - PT. Alfa Artha Andhaya</title>

<div class="back-button">
  <button onclick="goBack()">← Back</button>
</div>

<script>
  function goBack() {
    window.history.back(); // Kembali ke halaman sebelumnya
  }
</script>

<section class="brand2">
  <div class="logo-msi">
    <img src="../assets/logoMSI.png" alt="MSI Logo">
  </div>
</section>

<main>
  <section class="brand-info">
    <p>
      MSI is a leading brand in gaming and technology, offering high-quality products such as motherboards, 
      graphics cards, and gaming laptops. As an official partner, PT. Alfa Artha Andhaya is proud to present 
      MSI's range of products with superior performance, premium design, and the latest technology. Discover 
      the best MSI products with official warranty and reliable after-sales service at PT. Alfa Artha Andhaya.
    </p>
  </section>


  <section class="product-section">
    <!-- Filter Section -->
    <div class="filter-section">
      <select id="brandFilter">
        <option value="MSI">MSI</option>
      </select>
      <select id="categoryFilter">
        <option value="all">All Categories</option>
        <option value="Gaming Gear">Gaming Gear</option>
        <option value="Storage">Storage</option>
        <option value="PC Case">PC Case</option>
      </select>
    </div>
    <!-- Product List -->
    <div class="product-scroll-container">
      <div class="product-card" data-brand="MSI" data-category="PC Case" onclick="showProductDetails('msi700l')">
        <img src="../assets/MSI-MEG-MAESTRO.png" alt="MSI MEG MAESTRO 700L">
        <div class="product-info">
          <h2>MSI MEG MAESTRO 700L PZ M-ATX PC Casing [NO FAN]</h2>
          <p>Rp8.830.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="darkFlash" data-category="PSU" onclick="showProductDetails('darkFlash750')">
        <img src="../assets/darkFlash-psu.png" alt="darkFlash PMT 750">
        <div class="product-info">
          <h2>darkFlash UPT 750W Gold Full Modular Power Supply White</h2>
          <p>Rp1.320.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="Acer" data-category="Storage" onclick="showProductDetails('acerHT100')">
        <img src="../assets/acer-ht100.jpg" alt="ACER HT100 DDR4">
        <div class="product-info">
          <h2>ACER HT100 DDR4 3200 U-DIMM HEATSINK [Desktop RAM] - 8GB</h2>
          <p>Rp299.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="predator" data-category="Storage" onclick="showProductDetails('predatorhermes')">
        <img src="../assets/predator-hermes.png" alt="predator-hermes">
        <div class="product-info">
          <h2>PREDATOR HERMES DDR5 7200 MHz RGB U-DIMM [Desktop RAM] - Hitam, 32GB KIT</h2>
          <p>Rp3.356.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="Transcend" data-category="Storage" onclick="showProductDetails('transcend25')">
        <img src="../assets/ts25.png" alt="transcend2.5">
        <div class="product-info">
          <h2>Transcend 2.5" SSD/HDD Enclosure Kit [TS0GSJ25CK3]</h2>
          <p>Rp300.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="MSI" data-category="Gaming Gear" onclick="showProductDetails('msivigor')">
        <img src="../assets/msivigor.png" alt="msivigor">
        <div class="product-info">
          <h2>MSI KEYBOARD VIGOR GK41 - DUSK - GAMING KEYBOARD</h2>
          <p>Rp1.320.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="darkFlash" data-category="PC Case" onclick="showProductDetails('darkFlashal390b')">
        <img src="../assets/dfal390.png" alt="darkFlash AL390">
        <div class="product-info">
          <h2>darkFlash AL390 M-ATX PC Casing [WITH 1 RAINBOW FAN] - Hitam</h2>
          <p>Rp360.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="Acer" data-category="Storage" onclick="showProductDetails('acerfa2004tb')">
        <img src="../assets/acerfa200.png" alt="Acer FA 200 4TB">
        <div class="product-info">
          <h2>ACER FA200 M.2 NVMe PCIe Gen4 x4 SSD - 4TB</h2>
          <p>Rp3.890.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="predator" data-category="Storage" onclick="showProductDetails('predatorgm70004tb')">
        <img src="../assets/predatorgm700045b.png" alt="predator gm7000 5tb">
        <div class="product-info">
          <h2>PREDATOR GM7000 M.2 NVMe PCIe Gen4 x4 SSD [WITH DRAM CACHE] FREE HEATSINK - 4TB</h2>
          <p>Rp4.798.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="Transcend" data-category="Storage" onclick="showProductDetails('tsSSDESD2tb')">
        <img src="../assets/tsSSDESD2tb.png" alt="darkFlash PMT 750">
        <div class="product-info">
          <h2>Transcend External SSD ESD330C [USB Type-C Only] - 2TB</h2>
          <p>Rp2.751.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="darkFlash" data-category="Gaming Gear" onclick="showProductDetails('darkFlashMousePadFlex100')">
        <img src="../assets/darkFlashMousePadFlex100.png" alt="darkFlash MousePad ">
        <div class="product-info">
          <h2>darkFlash FLEX900 RGB XXL Gaming Mousepad [90x40 cm]</h2>
          <p>Rp198.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="darkFlash" data-category="PSU" onclick="showProductDetails('darkFlash750')">
        <img src="../assets/darkFlash-psu.png" alt="darkFlash PMT 750">
        <div class="product-info">
          <h2>darkFlash UPT 750W Gold Full Modular Power Supply White</h2>
          <p>Rp1.320.000</p>
        </div>
      </div>
      <div class="product-card" data-brand="darkFlash" data-category="PSU" onclick="showProductDetails('darkFlash750')">
        <img src="../assets/darkFlash-psu.png" alt="darkFlash PMT 750">
        <div class="product-info">
          <h2>darkFlash UPT 750W Gold Full Modular Power Supply White</h2>
          <p>Rp1.320.000</p>
        </div>
      </div>
    </div>
</main>

<!-- Pop-up untuk Deskripsi Produk -->
<div id="product-details" class="product-details hidden">
  <button onclick="hideProductDetails()">Back</button>
  <div class="product-details-content">
    <!-- Deskripsi produk akan diperbarui melalui JavaScript -->
  </div>
</div>

<script src="../product.js"></script>
<?php include '../includes/footer.php'; ?>