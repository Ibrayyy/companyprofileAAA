<?php
include '../../session.php'; 
include '../../config/database.php';


$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $conn->error;
}
?>
