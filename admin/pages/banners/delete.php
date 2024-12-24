<?php
include '../../session.php'; 
include '../../config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the banner to delete the image
    $query = $conn->prepare("SELECT image FROM banner WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $banner = $result->fetch_assoc();

    if ($banner) {
        $imagePath = '../../uploads/' . $banner['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the image
        }

        // Delete the banner from the database
        $stmt = $conn->prepare("DELETE FROM banner WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            header("Location: index.php?message=Banner+deleted+successfully!");
        } else {
            header("Location: index.php?error=Failed+to+delete+banner.");
        }
    }
}
?>
