<?php
ob_start();
include '../../session.php';
include '../../config/database.php';
include '../../includes/header.php';
include '../../includes/sidebar.php';
?>

<h2>Edit User</h2>

<?php
$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($email)) {
        echo "<div class='alert alert-danger'>Username and email are required.</div>";
    } else {
        // Jika password diisi, update password
        if (!empty($password)) {
            $stmt = $conn->prepare("UPDATE users SET username=?, password=?, email=? WHERE id=?");
            $stmt->bind_param("sssi", $username, $password, $email, $id);
        } else {
            // Jika password tidak diisi, update tanpa mengubah password
            $stmt = $conn->prepare("UPDATE users SET username=?, email=? WHERE id=?");
            $stmt->bind_param("ssi", $username, $email, $id);
        }

        if ($stmt->execute()) {
            header("Location: index.php?message=User +updated+successfully!");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
        }
    }
}
?>

<form method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password (leave blank to keep the current password)</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class ="btn btn-success">Update</button>
    <button type="button" class="btn btn-danger" onclick="window.location.href='index.php'">Cancel</button>
</form>

<?php include '../../includes/footer.php'; ?>