<?php
include '../../session.php';
include '../../config/database.php';


$id = $_GET['id'];
$result = $conn->query("SELECT image FROM brands WHERE id = $id");
$row = $result->fetch_assoc();
unlink('../../uploads/' . $row['image']);

$stmt = $conn->prepare("DELETE FROM brands WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php");
} else {
    echo "Error: " . $conn->error;
}
?>
