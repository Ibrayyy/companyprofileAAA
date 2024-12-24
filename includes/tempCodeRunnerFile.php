<?php
// Pastikan base_url sudah didefinisikan sebelumnya dalam aplikasi atau file konfigurasi.
// Konfigurasi koneksi ke database
$host = 'localhost'; // Atau bisa diubah dengan IP address atau nama host server database
$dbname = 'aaa'; // Ganti dengan nama database yang sesuai
$username = 'root'; // Ganti dengan username yang sesuai
$password = ''; // Ganti dengan password yang sesuai

// Membuat koneksi
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Koneksi gagal: ' . $e->getMessage();
}
?>