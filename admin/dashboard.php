<?php
include './session.php'; // Harus paling atas
include './config/database.php'; // Jika database diperlukan
include './includes/header.php'; 
include './includes/sidebar.php'; 
?>

<link rel="stylesheet" href="../style.css">

<!-- Header dalam kotak -->
<div class="h2-box text-center">
    <h2>Welcome to PT AAA Admin Dashboard</h2>
</div>

<!-- Konten dashboard -->
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <a href="pages/categories/index.php" class="card"> <!-- Tautan ke halaman categories -->
                <div class="card-body">
                    <h5>Total Categories :</h5>
                    <p class="display-4">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total FROM categories");
                        echo $result->fetch_assoc()['total'];
                        ?>
                    </p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <a href="pages/brands/index.php" class="card"> <!-- Tautan ke halaman brands -->
                <div class="card-body">
                    <h5>Total Brands :</h5>
                    <p class="display-4">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total FROM brands");
                        echo $result->fetch_assoc()['total'];
                        ?>
                    </p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <a href="pages/products/index.php" class="card"> <!-- Tautan ke halaman products -->
                <div class="card-body">
                    <h5>Total Products :</h5>
                    <p class="display-4">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total FROM products");
                        echo $result->fetch_assoc()['total'];
                        ?>
                    </p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <a href="pages/banners/index.php" class="card"> <!-- Tautan ke halaman banners -->
                <div class="card-body">
                    <h5>Total Banners :</h5>
                    <p class="display-4">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total FROM banner");
                        echo $result->fetch_assoc()['total'];
                        ?>
                    </p>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <a href="pages/users/index.php" class="card"> <!-- Tautan ke halaman users -->
                <div class="card-body">
                    <h5>Total Users :</h5>
                    <p class="display-4">
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total FROM users");
                        echo $result->fetch_assoc()['total'];
                        ?>
                    </p>
                </div>
            </a>
        </div>
    </div>
</div>

<style>
/* Warna dan gaya untuk kotak (card) */
.card {
  background-color: #f1f8e9; /* Warna latar kotak (hijau pucat) */
  border: 2px solid #69af00; /* Border dengan warna hijau */
  border-radius: 10px; /* Sudut membulat */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
  transition: transform 0.2s, box-shadow 0.3s; /* Animasi saat hover */
}

.card:hover {
  transform: scale(1.05); /* Sedikit membesar saat hover */
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Bayangan lebih tebal saat hover */
}

/* Gaya untuk bagian body card */
.card-body {
  padding: 20px; /* Jarak di dalam kotak */
  text-align: center; /* Teks di tengah */
}

.card-body h5 {
  font-size: 18px; /* Ukuran teks heading */
  color: #69af00; /* Warna teks hijau */
}

.card-body p {
  font-size: 36px; /* Ukuran angka besar */
  font-weight: bold;
  color: #333; /* Warna teks angka */
}

/* Header di atas */
.h2-box {
  margin: 30px 0;
  padding: 10px;
  background-color: #f8f9fa;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
  .card-body p {
    font-size: 24px; /* Ukuran angka lebih kecil di layar kecil */
  }

  .card-body h5 {
    font-size: 16px; /* Ukuran teks heading lebih kecil di layar kecil */
  }
}
</style>

<?php include './includes/footer.php'; ?>
