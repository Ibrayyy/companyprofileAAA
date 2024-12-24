<?php
include '../../session.php'; // Pastikan ini paling atas
include '../../config/database.php';

?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: index.php?message=User +deleted+successfully!");
    } else {
        header("Location: index.php?error=Error+deleting+user.");
    }
} else {
    header("Location: index.php?error=No+user+id+provided.");
}
?>