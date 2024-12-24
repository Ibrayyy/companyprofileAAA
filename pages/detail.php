<?php include '../includes/header.php'; ?>
<link rel="stylesheet" href="../brand.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<title>Detail Brand - PT. Alfa Artha Andhaya</title>

<div class="back-button">
  <button onclick="goBack()">← Back</button>
</div>

<script>
  function goBack() {
    window.history.back(); // Kembali ke halaman sebelumnya
  }
</script>

<?php
// Sertakan koneksi database
include '../admin/config/database.php';

// Ambil nama brand dari URL
$brandName = strtolower($_GET['brand']);

// Ambil data brand berdasarkan nama
$queryBrand = "SELECT * FROM brands WHERE LOWER(name) = ?";
$stmtBrand = $conn->prepare($queryBrand);
$stmtBrand->bind_param("s", $brandName);
$stmtBrand->execute();
$brand = $stmtBrand->get_result()->fetch_assoc();

// Ambil produk berdasarkan brand_id yang statusnya Available
$queryProducts = "SELECT p.*, c.name AS category_name FROM products p 
                  INNER JOIN categories c ON p.category_id = c.id 
                  WHERE p.brand_id = ? AND p.stock_status = 'Available'";
$stmtProducts = $conn->prepare($queryProducts);
$stmtProducts->bind_param("i", $brand['id']);
$stmtProducts->execute();
$products = $stmtProducts->get_result()->fetch_all(MYSQLI_ASSOC);

?>

<section class="brand2">
  <div class="logoTS">
    <img src="../admin/uploads/<?php echo $brand['image']; ?>" alt="<?php echo htmlspecialchars($brand['name']); ?>">
  </div>
</section>

<main>
  <section class="brand-info">
    <p><?php echo htmlspecialchars($brand['description']); ?></p>
  </section>
  <section class="product-section">
    <div class="filter-section">
      <select id="categoryFilter" onchange="filterProducts()">
        <option value="all">All Categories</option>
        <?php
        // Ambil kategori dari database
        $categories = $conn->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
        foreach ($categories as $category): ?>
          <option value="<?= htmlspecialchars($category['id']) ?>">
            <?= htmlspecialchars($category['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="product-scroll-container">
      <?php foreach ($products as $product): ?>
        <div class="product-card" data-category="<?= htmlspecialchars($product['category_id']) ?>" onclick="showProductDetails(<?= $product['id'] ?>)">
          <img src="../admin/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
          <div class="product-info">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p>Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<!-- Pop-up untuk Deskripsi Produk -->
<div id="product-details" class="product-details hidden">
  <button onclick="hideProductDetails()">Back</button>
  <div class="product-details-content"></div>
</div>

<script>
  // Filter Products
  function filterProducts() {
    const categoryFilter = document.getElementById('categoryFilter').value;
    const products = document.querySelectorAll('.product-card');

    products.forEach(product => {
      const category = product.getAttribute('data-category');

      // Tampilkan produk jika kategori sesuai atau jika "All Categories" dipilih
      product.style.display = (categoryFilter === 'all' || category === categoryFilter) ? 'block' : 'none';
    });
  }

  // Show Product Details
  function showProductDetails(productId) {
    const detailsContainer = document.getElementById('product-details');
    const detailsContent = detailsContainer.querySelector('.product-details-content');

    fetch(`get_product_details.php?id=${productId}`)
      .then(response => response.json())
      .then(product => {
        if (product) {
          detailsContent.innerHTML = `
                    <h2>${product.name}</h2>
                    <p>Harga: Rp${product.price.toLocaleString()}</p>
                    <p>${product.description}</p>
                    ${generateProductLinks(product)}
                `;
          detailsContainer.classList.remove('hidden');
        }
      })
      .catch(error => console.error('Error fetching product details:', error));
  }

  // Generate Product Links
  function generateProductLinks(product) {
    let html = '<div class="product-links"><p>Shopping at:</p>';
    if (product.link_shopee) {
      html += `<a href="${product.link_shopee}" target="_blank">
                    <img src="/aaafrontend/assets/shopee.png" alt="Shopee" class="shop-logo">
                 </a>`;
    }
    if (product.link_tokopedia) {
      html += `<a href="${product.link_tokopedia}" target="_blank">
                    <img src="/aaafrontend/assets/Tokopedia.png" alt="Tokopedia" class="shop-logo">
                 </a>`;
    }
    if (product.link_blibli) {
      html += `<a href="${product.link_blibli}" target="_blank">
                    <img src="/aaafrontend/assets/blibli.png" alt="Blibli" class="shop-logo">
                 </a>`;
    }
    html += '</div>';
    return html;
  }

  // Hide Product Details
  function hideProductDetails() {
    const detailsContainer = document.getElementById('product-details');
    detailsContainer.classList.add('hidden');
  }
</script>

<style>


    </style>

<?php include '../includes/footer.php'; ?>