<?php 
$currentPage = $_SERVER['PHP_SELF']; // Ambil path lengkap PHP_SELF
?>

<div class="d-flex">
    <!-- Sidebar -->
    <nav id="sidebar" class="sidebar text-white p-3" style="background-color: #69AF00; min-width: 250px; min-height: 100vh; overflow-y: auto; word-wrap: break-word;">
        <!-- Logo -->
        <div class="text-center mb-4">
            <img src="/aaafrontend/assets/logo.png" alt="Logo" style="max-width: 100%; height: auto; width: 150px;">
        </div>
        <ul class="nav flex-column">
            <li class="nav-item <?= str_contains($currentPage, '/aaafrontend/admin/dashboard.php') && !str_contains($currentPage, 'categories') && !str_contains($currentPage, 'brands') ? 'active' : '' ?>">
                <a class="nav-link text-white" href="/aaafrontend/admin/dashboard.php">Admin Dashboard</a>
            </li>
            <li class="nav-item <?= str_contains($currentPage, 'categories') ? 'active' : '' ?>">
                <a class="nav-link text-white" href="/aaafrontend/admin/pages/categories/index.php">Manage Categories</a>
            </li>
            <li class="nav-item <?= str_contains($currentPage, 'brands') ? 'active' : '' ?>">
                <a class="nav-link text-white" href="/aaafrontend/admin/pages/brands/index.php">Manage Brands</a>
            </li>
            <li class="nav-item <?= str_contains($currentPage, 'products') ? 'active' : '' ?>">
                <a class="nav-link text-white" href="/aaafrontend/admin/pages/products/index.php">Manage Products</a>
            </li>
            <li class="nav-item <?= str_contains($currentPage, 'banners') ? 'active' : '' ?>">
                <a class="nav-link text-white" href="/aaafrontend/admin/pages/banners/index.php">Manage Banners</a>
            </li>
            <li class="nav-item <?= str_contains($currentPage, 'users') ? 'active' : '' ?>">
                <a class="nav-link text-white" href="/aaafrontend/admin/pages/users/index.php">Manage Users</a>
            </li>
        </ul>
    </nav>

    <main class="flex-grow-1 p-4">
        <!-- Button to toggle sidebar -->
        <button id="toggleSidebar" class="btn btn-primary mb-3">☰</button>
        
        <!-- Your main content goes here -->

<style>
    .nav-item.active .nav-link {
        font-weight: bold;
        background-color: rgba(0, 255, 4, 0.31); /* Bisa diganti dengan warna lain sesuai desain */
        color: white;
    }

    /* Styling untuk menyembunyikan sidebar */
    #sidebar.hidden {
        display: none; /* Sembunyikan sidebar */
    }
    #sidebar.visible {
    transform: translateX(0); /* Sidebar muncul */
    opacity: 1;
    }

    #sidebar.visible + #mainContent {
        margin-left: 250px;
    }

    @media (max-width: 768px) {
        #sidebar {
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            bottom: 0;
            transform: translateX(-250px);
            transition: transform 0.3s ease;
        }

        #sidebar.visible {
            transform: translateX(0);
        }

        #toggleSidebar {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1100;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleButton = document.getElementById('toggleSidebar');

    // Secara default sidebar tersembunyi
    sidebar.classList.add('hidden'); // Sidebar tersembunyi saat halaman dimuat

    toggleButton.addEventListener('click', () => {
        // Toggle sidebar (menampilkan/menyembunyikan)
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('visible');

        // Menyesuaikan teks tombol berdasarkan status sidebar
        if (sidebar.classList.contains('visible')) {
            toggleButton.innerHTML = '✖ Close Sidebar'; // Ubah teks tombol menjadi "Close Sidebar"
        } else {
            toggleButton.innerHTML = '☰ Open Sidebar'; // Ubah teks tombol menjadi "Open Sidebar"
        }
    });
});
</script>
