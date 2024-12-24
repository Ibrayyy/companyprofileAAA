<?php
include '../../session.php'; // Pastikan ini paling atas
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>
<link rel="stylesheet" href="/aaafrontend/style.css">

<div class="h2-box">
    <h2>Manage Banners</h2>
</div>

<a href="add.php" class="btn btn-primary mb-3">Add New Banner</a>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Form Pencarian dan Sorting -->
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search banners..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        </div>
        <div class="col-md-4">
            <select name="sort" class="form-control">
                <option value="">Sort by Name</option>
                <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : '' ?>>A-Z</option>
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

<?php
// Query dasar
$query = "SELECT * FROM banner WHERE 1=1";

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
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Tampilkan data
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['description']) . "</td>
                    <td><img src='../../uploads/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' width='100'></td>
                    <td>
                        <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}' data-name='" . htmlspecialchars($row['name']) . "'>Delete</button>
                    </td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</div>

<style>
.h2-box {
    font-size: 24px;
    margin: 20px 0;
    text-align: center;
}

.table {
    border-collapse: collapse;
    width: 100%;
    margin: 20px 0;
    font-size: 16px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
}

.table th, .table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

.table thead {
    background-color: #9CC455;
    color: white;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

.table tbody tr:hover {
    background-color: #ddd;
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

@media (max-width: 576px) {
    .h2-box {
        font-size: 18px;
    }

    .table {
        display: block;
        overflow-x: auto;
        font-size: 12px;
    }

    .table th, .table td {
        display: block;
        text-align: right;
        padding: 10px;
        border: none;
        position: relative;
    }

    .table th {
        display: none;
    }

    .table td::before {
        content: attr(data-label);
        font-weight: bold;
        text-transform: uppercase;
        position: absolute;
        left: 10px;
        top: 10px;
        text-align: left;
    }

    .table tbody tr {
        border-bottom: 2px solid #ddd;
        margin-bottom: 10px;
        display: block;
    }
}
</style>

<script>
    // Fungsi untuk menangani tombol delete dengan SweetAlert
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const bannerId = this.dataset.id; // Ambil ID banner
            const bannerName = this.dataset.name; // Ambil nama banner

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete the banner "${bannerName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect ke delete.php dengan ID
                    window.location.href = `delete.php?id=${bannerId}`;
                }
            });
        });
    });
</script>

<?php include '../../includes/footer.php'; ?>
