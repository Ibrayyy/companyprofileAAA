<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'config/database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta dan Style -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('../assets/bg.png'); /* Ganti dengan path gambar Anda */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        header {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 10;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .login-container {
            background-color: white;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 500px; 
            max-width: 90%;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #69AF00;
        }

        .login-container p {
            text-align: center;
            color: #666;
        }

        .login-container .form-group label {
            display: block;
            margin-bottom: 10px;
            color: #000000;
        }

        .login-container .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #69AF00;
            color: white;
            border: black;
            border-style: double;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .login-container button:hover {
            opacity: 0.9;
        }

        /* Media Queries untuk Responsivitas */
        @media (max-width: 768px) {
            .login-container {
                padding: 15px 20px;
            }
            .login-container h2 {
                font-size: 20px;
            }
            .login-container button {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 10px 15px;
            }
            .login-container h2 {
                font-size: 18px;
            }
            .login-container input,
            .login-container button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="../assets/logo.png" alt="Logo" class="logo">
    </header>
    <div class="container login-container">
        <div class="card login-card border-0">
            <div class="card-body">
                <h2 class="card-title text-center">Admin Login</h2>
                <p class="text-muted text-center">Welcome back Admin! Please login to your account.</p>
                <!-- Pesan Error -->
                <?php if ($error): ?>
                    <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

