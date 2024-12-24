<?php
include '../../session.php'; // Pastikan ini paling atas
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>
<link rel="stylesheet" href="/aaafrontend/style.css">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="h2-box">
<h2>Manage Categories</h2>
</div>

<a href="add.php" class="btn btn-primary mb-3">Add New Category</a>

<!-- Form Pencarian dan Sorting -->
<form method="GET" class="mb-3">
    <div class="row g-2">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <input type="text" name="search" class="form-control" placeholder="Search categories..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <select name="sort" class="form-control">
                <option value="">Sort by Name</option>
                <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : '' ?>>A-Z</option>
            </select>
        </div>
        <div class="col-lg-4 col-md-12">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<?php
// Query dasar
$query = "SELECT * FROM categories WHERE 1=1";

// Tambahkan filter pencarian jika ada
if (!empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $query .= " AND (name LIKE '%$search%' OR description LIKE '%$search%')";
}

// Tambahkan sorting berdasarkan input
if (!empty($_GET['sort']) && $_GET['sort'] == 'asc') {
    $query .= " ORDER BY name ASC";
} else {
    $query .= " ORDER BY id DESC"; // Default sorting jika tidak ada pilihan
}

// Eksekusi query
$result = $conn->query($query);
?>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Tampilkan data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['description']}</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <a href='#' 
                               class='btn btn-danger btn-sm delete-btn' 
                               data-id='{$row['id']}' 
                               data-name='{$row['name']}'>Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<style>
.table {
    border-collapse: collapse;
    width: 100%;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
    background-color: #f9f9f9; /* Warna dasar tabel */
    border: 1px solid #ddd; /* Garis luar */
}

.table thead {
    background-color: #9CC455; /* Warna header tabel */
    color: white; /* Warna teks header */
}

.table th, .table td {
    padding: 12px 15px;
    border: 1px solid #ddd; 
        border-color: #69af00;
        border-width: 3px;/* Garis antar sel */
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2; /* Warna baris genap */
}

.table tbody tr:hover {
    background-color: #ddd; /* Warna saat kursor di atas baris */
}

/* Responsif untuk perangkat kecil */
@media (max-width: 768px) {
    .table {
        font-size: 14px;
    }

    .table th, .table td {
        padding: 8px 10px;
    }
}

/* Responsif untuk HP */
@media (max-width: 576px) {
    .h2-box {
        font-size: 18px;
        text-align: center; /* Pastikan judul berada di tengah */
    }

    .table {
        font-size: 12px;
    }

    .table-responsive {
        overflow-x: auto; /* Pastikan tabel tidak meluap */
    }
}
</style>

<script>
    // SweetAlert untuk tombol hapus
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Mencegah tindakan default
            const categoryId = this.getAttribute('data-id'); // Ambil ID kategori
            const categoryName = this.getAttribute('data-name'); // Ambil nama kategori

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete category \"${categoryName}\". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke file delete.php dengan ID
                    window.location.href = `delete.php?id=${categoryId}`;
                }
            });
        });
    });
</script>

<?php include '../../includes/footer.php'; ?>
