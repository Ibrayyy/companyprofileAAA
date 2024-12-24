<?php
// Header dan koneksi database
include '../includes/header.php';
include '../admin/config/database.php';


// Ambil data produk dengan join ke tabel brands dan categories
$query = "
    SELECT p.*, b.name AS brand_name, c.name AS category_name
    FROM products p 
    JOIN brands b ON p.brand_id = b.id 
    JOIN categories c ON p.category_id = c.id
    WHERE p.stock_status = 'Available'  -- Hanya ambil produk yang tersedia
";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Ambil data brand untuk filter
$brands = $conn->query("SELECT * FROM brands")->fetch_all(MYSQLI_ASSOC);

// Ambil data kategori untuk filter
$categories = $conn->query("SELECT * FROM categories")->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product - PT. Alfa Artha Andhaya</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <div class="our-product">
        <h1>OUR PRODUCT</h1>

        <!-- Filter Section -->
        <div class="filter-section">
            <select id="brandFilter" onchange="filterProducts()">
                <option value="all">All Brands</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= htmlspecialchars($brand['name']) ?>">
                        <?= htmlspecialchars($brand['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select id="categoryFilter" onchange="filterProducts()">
                <option value="all">All Categories</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= htmlspecialchars($category['name']) ?>">
                        <?= htmlspecialchars($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <!-- Product List -->
    <div class="product-scroll-container" id="productContainer">
        <?php foreach ($products as $product): ?>
            <div class="product-card"
                data-brand="<?= htmlspecialchars($product['brand_name']) ?>"
                data-category="<?= htmlspecialchars($product['category_name']) ?>"
                onclick="showProductDetails(<?= $product['id'] ?>)">
                <img src="../admin/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <div class="product-info">
                    <h2><?= htmlspecialchars($product['name']) ?></h2>
                    <p>Rp<?= number_format($product['price'], 0, ',', '.') ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Product Details Pop-up -->
    <div id="product-details" class="product-details hidden">
        <button onclick="hideProductDetails()">Back</button>
        <div class="product-details-content"></div>
    </div>

    <!-- Footer Tengah -->
<div class="footer-middle">
  <p>Visit the Marketplace platform below:</p>
  <div class="ecommerce-brands">
    <div class="brand-card">
      <img src="../assets/Atri-OS.png" alt="Alfa Artha Andhaya Official Store">
      <p>Alfa Artha Andhaya</p>
      <div class="platform-links">
        <a href="https://www.tokopedia.com/alfaatri?source=universe&st=product">
          <img src="../assets/Tokopedia.png" alt="Tokopedia"> Tokopedia
        </a>
        <a href="https://www.blibli.com/merchant/alfa-artha-andhaya-official-store/AAA-60021?pickupPointCode=PP-3034267&fbbActivated=false">
          <img src="../assets/blibli.png" alt="Blibli"> Blibli
        </a>
      </div>
    </div>
    <div class="brand-card">
      <img src="../assets/TS-OS.png" alt="Transcend Official Store">
      <p>Transcend</p>
      <div class="platform-links">
        <a href="https://shopee.co.id/transcendofficial?entryPoint=ShopBySearch&searchKeyword=transcend">
          <img src="../assets/shopee.png" alt="Shopee"> Shopee
        </a>
        <a href="https://www.tokopedia.com/transcendind">
          <img src="../assets/Tokopedia.png" alt="Tokopedia"> Tokopedia
        </a>
        <a href="https://www.blibli.com/merchant/transcend-official-store/TRI-60028?pickupPointCode=PP-3046711&fbbActivated=false">
          <img src="../assets/blibli.png" alt="Blibli"> Blibli
        </a>
      </div>
    </div>
    <div class="brand-card">
      <img src="../assets/DF-OS.png" alt="darkFlash Official Store">
      <p>darkFlash</p>
      <div class="platform-links">
        <a href="https://shopee.co.id/darkflash.ind?entryPoint=ShopBySearch&searchKeyword=darkflash">
          <img src="../assets/shopee.png" alt="Shopee"> Shopee
        </a>
        <a href="https://www.tokopedia.com/darkflashstore">
          <img src="../assets/Tokopedia.png" alt="Tokopedia"> Tokopedia
        </a>
        <a href="https://www.blibli.com/merchant/darkflash-official-store/DFA-60021?pickupPointCode=PP-3033554&fbbActivated=false">
          <img src="../assets/blibli.png" alt="Blibli"> Blibli
        </a>
      </div>
    </div>
    <div class="brand-card">
      <img src="../assets/logoACER.png" alt="Acer Official Lisence">
      <p>Acer Official Lisence</p>
      <div class="platform-links">
        </a>
        <a href="https://tokopedia.link/B3FCJ1QThPb">
        <img src="../assets/Tokopedia.png" alt="Tokopedia"> Tokopedia
        </a>
      </div>
    </div>
  </div>
</div>

    <script>
        // Filter Products
        function filterProducts() {
            const brandFilter = document.getElementById('brandFilter').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const brand = product.getAttribute('data-brand').toLowerCase();
                const category = product.getAttribute('data-category').toLowerCase();

                product.style.display = (brandFilter === 'all' || brand === brandFilter) &&
                    (categoryFilter === 'all' || category === categoryFilter) ?
                    'block' : 'none';
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
                    ${generateProductLinks(product.links)}
                `;
                        detailsContainer.classList.remove('hidden');
                    }
                })
                .catch(error => console.error('Error fetching product details:', error));
        }

        // Hide Product Details
        function hideProductDetails() {
            document.getElementById('product-details').classList.add('hidden');
        }

        // Generate Product Links
        function generateProductLinks(links) {
            let html = '<div class="product-links"><p>Shopping at:</p>';
            if (links.shopee) {
                html += `<a href="${links.shopee}" target="_blank">
                    <img src="/aaafrontend/assets/shopee.png" alt="Shopee" class="shop-logo">
                 </a>`;
            }
            if (links.tokopedia) {
                html += `<a href="${links.tokopedia}" target="_blank">
                    <img src="/aaafrontend/assets/Tokopedia.png" alt="Tokopedia" class="shop-logo">
                 </a>`;
            }
            if (links.blibli) {
                html += `<a href="${links.blibli}" target="_blank">
                    <img src="/aaafrontend/assets/blibli.png" alt="Blibli" class="shop-logo">
                 </a>`;
            }
            html += '</div>';
            return html;
        }
    </script>
    
    <style>
  .hidden {
    display: none;
  }

  .product-details {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 20px;
    overflow-y: auto;
    height: 70vh;
    width: 100px;
}

/* Scrollbar Styling */
.product-details::-webkit-scrollbar {
    width: 12px; /* Lebar scrollbar */
}

.product-details::-webkit-scrollbar-track {
    background: #1a1a1a; /* Warna latar track scrollbar */
}

.product-details::-webkit-scrollbar-thumb {
    background-color: #69AF00; /* Warna scrollbar */
    border-radius: 10px; /* Membuat ujung scrollbar membulat */
    border: 2px solid #1a1a1a; /* Membuat efek tepi */
}

/* Untuk Firefox */
.product-details {
    scrollbar-color: #69AF00 #1a1a1a; /* (Warna thumb, Warna track) */
    scrollbar-width: thin; /* Lebar scrollbar menjadi lebih tipis */
}
    </style>

    <?php include '../includes/footer.php'; ?>
</body>

</html>