<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT AAA Admin Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #69AF00;
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .btn {
            color: white;
        }
        .navbar-custom .btn:hover {
            color: #69AF00;
            background-color: white;
            border-color: #69AF00;
        }
    </style>
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-custom">
    <div class="ml-auto">
        <a class="btn btn-primary mr-2" href="/aaafrontend/pages/index.php">User View</a>
        <!-- Tambahkan ID pada tombol logout -->
        <a id="logoutButton" class="btn btn-danger" >Logout</a>
    </div>
</nav>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutButton').addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to log out.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, log out',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke logout.php untuk memproses logout
                window.location.href = '/aaafrontend/admin/logout.php';
            }
        });
    });
</script>
</body>
</html>
