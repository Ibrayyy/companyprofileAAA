<?php
include '../../session.php'; // Pastikan ini paling atas
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="/aaafrontend/style.css">

<div class="h2-box text-center">
    <h2>Manage Products</h2>
</div>

<a href="add.php" class="btn btn-primary mb-3">Add New Product</a>

<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4 mb-2">
            <input type="text" name="search" class="form-control" placeholder="Search products..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
        </div>
        <div class="col-md-4 mb-2">
            <select name="sort" class="form-control">
                <option value="">Sort by</option>
                <option value="name_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'name_asc' ? 'selected' : '' ?>>Name (A-Z)</option>
                <option value="name_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'name_desc' ? 'selected' : '' ?>>Name (Z-A)</option>
                <option value="price_asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_asc' ? 'selected' : '' ?>>Price (Low-High)</option>
                <option value="price_desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'price_desc' ? 'selected' : '' ?>>Price (High-Low)</option>
            </select>
        </div>
        <div class="col-md-4 mb-2">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Brand</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock Status</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "
                SELECT p.*, b.name AS brand_name, c.name AS category_name 
                FROM products p
                JOIN brands b ON p.brand_id = b.id
                JOIN categories c ON p.category_id = c.id
                WHERE 1=1
            ";

            // Pencarian
            if (!empty($_GET['search'])) {
                $search = $conn->real_escape_string($_GET['search']);
                $query .= " AND (p.name LIKE '%$search%' OR b.name LIKE '%$search%' OR c.name LIKE '%$search%')";
            }

            // Sorting
            if (!empty($_GET['sort'])) {
                switch ($_GET['sort']) {
                    case 'name_asc':
                        $query .= " ORDER BY p.name ASC";
                        break;
                    case 'name_desc':
                        $query .= " ORDER BY p.name DESC";
                        break;
                    case 'price_asc':
                        $query .= " ORDER BY p.price ASC";
                        break;
                    case 'price_desc':
                        $query .= " ORDER BY p.price DESC";
                        break;
                    default:
                        $query .= " ORDER BY p.id DESC";
                }
            } else {
                $query .= " ORDER BY p.id DESC";
            }

            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['brand_name']) . "</td>
                        <td>" . htmlspecialchars($row['category_name']) . "</td>
                        <td>" . htmlspecialchars($row['price']) . "</td>
                        <td>" . htmlspecialchars($row['stock_status']) . "</td>
                        <td><img src='../../uploads/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "' width='50'></td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                            <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}' data-name='" . htmlspecialchars($row['name']) . "'>Delete</button>
                        </td>
                      </tr>";
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
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const productId = this.dataset.id;
            const productName = this.dataset.name;

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete product "${productName}". This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `delete.php?id=${productId}`;
                }
            });
        });
    });
</script>

<?php include '../../includes/footer.php'; ?>
