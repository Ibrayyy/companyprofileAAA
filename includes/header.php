<?php
// Pastikan base_url sudah didefinisikan sebelumnya dalam aplikasi atau file konfigurasi.
$base_url = 'http://localhost/aaafrontend/'; 
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  
<!-- Header -->
<header>
  <div class="navbar">
    <div class="logo">
      <img src="../assets/logo.png" alt="Logo" width="40px">
      </a>
    </div>
    <nav>
      <ul>
      <li><a href="../pages/index.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">Home</a></li>
      <li><a href="../pages/product.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'product.php') echo 'active'; ?>">Product</a></li>
      <li><a href="../pages/brand.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'brand.php') echo 'active'; ?>">Brand</a></li>
      <li><a href="../pages/aboutus.php" class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'aboutus.php') echo 'active'; ?>">About Us</a></li>

      </ul>
    </nav>
    <div class="navbar-icons">
      <button id="btn-search" class="btn-search">
        <i class="fa-solid fa-magnifying-glass"></i>
      </button>
      <button id="btn-login" class="btn-login">Login</button>
    </div>
  </div>
</header>

<!-- JavaScript -->
<script>
  // Aktifkan tautan menu yang diklik
 // Aktifkan tautan menu yang diklik
const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault(); // Mencegah refresh halaman jika kelas 'active' diubah

    // Hapus kelas 'active' dari semua link dengan transisi animasi
    navLinks.forEach(nav => {
      nav.classList.remove('active');
      nav.style.opacity = 0; // Efek hilang secara perlahan
      setTimeout(() => {
        nav.style.opacity = 1; // Efek muncul kembali
      }, 300); // Delay sesuai durasi transisi
    });

    // Tambahkan kelas 'active' pada link yang diklik
    link.classList.add('active');

    // Pindahkan ke halaman yang dituju dengan delay animasi
    setTimeout(() => {
      window.location.href = link.getAttribute('href');
    }, 300); // Delay sesuai durasi transisi
  });
});

  
</script>

<!-- Pop-up Search -->
<div id="searchPopup" class="search-popup">
  <div class="search-content">
    <h2>Search Products</h2>
    <input type="text" id="searchInput" placeholder="Enter product name or category...">
    <button id="searchButton">Search</button>
    <button id="closeSearch" class="close-button">Close</button>
    <p id="noResultsMessage" style="display: none; color: red;">Product not found.</p>
  </div>
</div>

<style>
/* Pop-up untuk pencarian */
.search-popup {
  display: none;  /* Awalnya sembunyikan pop-up */
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

/* Konten pop-up */
.search-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 10px;
  width: 400px;
  box-shadow: 0 4px 8px rgba(47, 255, 0, 0.2);
  text-align: center;
}

/* Search Input */
#searchInput {
  width: 100%;
  padding: 10px 15px;
  font-size: 16px;
  border: 1px solid #ddd;
  border-radius: 5px;
  margin-bottom: 15px;
  box-sizing: border-box;
  transition: border-color 0.3s, box-shadow 0.3s;
}

#searchInput:focus {
  outline: none;
  border-color: #69AF00;
  box-shadow: 0 0 5px rgba(105, 175, 0, 0.7);
}

/* Tombol pencarian */
#searchButton {
  background-color:#69AF00;
  color: white;
  padding: 8px 16px;
  font-size: 14px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
}

#searchButton:hover {
  background-color:rgb(13, 103, 1);
  transform: scale(1.05);
}

/* Tombol tutup */
.close-button {
  background-color:rgb(255, 25, 0);
  color: white;
  padding: 8px 16px;
  font-size: 14px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  margin-top: 10px;
  transition: background-color 0.3s, transform 0.2s;
}

.close-button:hover {
  background-color: #c0392b;
  transform: scale(1.05);
}
</style>


<script>
// JavaScript
// JavaScript
const btnSearch = document.getElementById('btn-search');
const searchPopup = document.getElementById('searchPopup');
const closeSearch = document.getElementById('closeSearch');
const searchInput = document.getElementById('searchInput');
const searchButton = document.getElementById('searchButton');

// Tambahkan elemen pesan jika tidak ada hasil
const noResultsMessage = document.createElement('p');
noResultsMessage.id = 'noResultsMessage';
noResultsMessage.textContent = 'Product not found.';
noResultsMessage.style.color = 'red';
noResultsMessage.style.display = 'none';
searchPopup.querySelector('.search-content').appendChild(noResultsMessage);

// Tampilkan pop-up search
btnSearch.addEventListener('click', () => {
  searchPopup.style.display = 'flex';
  noResultsMessage.style.display = 'none'; // Sembunyikan pesan jika sebelumnya ditampilkan
});

// Sembunyikan pop-up search
closeSearch.addEventListener('click', () => {
  searchPopup.style.display = 'none';
});

// Fungsi pencarian produk
searchButton.addEventListener('click', () => {
  const keyword = searchInput.value.toLowerCase().trim();
  const products = document.querySelectorAll('.product-card'); // Produk di halaman saat ini
  let found = false;

  if (products.length > 0) {
    // Jika produk ada di halaman saat ini, lakukan filter langsung
    products.forEach(product => {
      const productName = product.querySelector('h2').textContent.toLowerCase();
      const productCategory = product.getAttribute('data-category').toLowerCase();

      if (productName.includes(keyword) || productCategory.includes(keyword)) {
        product.style.display = 'block'; // Tampilkan produk yang sesuai
        found = true;
      } else {
        product.style.display = 'none'; // Sembunyikan produk yang tidak sesuai
      }
    });

    if (!found) {
      noResultsMessage.style.display = 'block'; // Tampilkan pesan jika tidak ada hasil
    } else {
      noResultsMessage.style.display = 'none'; // Sembunyikan pesan jika ada hasil
    }

    searchPopup.style.display = 'none'; // Tutup pop-up setelah pencarian
  } else {
    // Jika tidak ada produk di halaman, redirect ke halaman lain
    if (keyword) {
      window.location.href = `../pages/product.php?search=${encodeURIComponent(keyword)}`;
    } else {
      alert('Please enter a keyword to search.');
    }
  }
});

// Tambahkan event listener untuk tekan "Enter"
searchInput.addEventListener('keypress', (event) => {
  if (event.key === 'Enter') {
    event.preventDefault(); // Mencegah submit default
    searchButton.click(); // Klik tombol search secara otomatis
  }
});

// Tangkap query string dari URL untuk filter otomatis
window.addEventListener('DOMContentLoaded', () => {
  const urlParams = new URLSearchParams(window.location.search);
  const searchKeyword = urlParams.get('search');

  if (searchKeyword) {
    const keyword = searchKeyword.toLowerCase().trim();
    const products = document.querySelectorAll('.product-card');
    let found = false;

    products.forEach(product => {
      const productName = product.querySelector('h2').textContent.toLowerCase();
      const productCategory = product.getAttribute('data-category').toLowerCase();

      if (productName.includes(keyword) || productCategory.includes(keyword)) {
        product.style.display = 'block'; // Tampilkan produk yang sesuai
        found = true;
      } else {
        product.style.display = 'none'; // Sembunyikan produk yang tidak sesuai
      }
    });

    if (!found) {
      noResultsMessage.style.display = 'block'; // Tampilkan pesan jika tidak ada hasil
    }
  }
});


  // Tombol Login
  const loginBtn = document.getElementById('btn-login');
  loginBtn.addEventListener('click', () => {
    window.open('../admin/index.php', '_blank');
  });
</script>
</body>
</html>
