<?php
$servername = "shortline.proxy.rlwy.net"; // hostname dari Railway
$port = 16491;                            // port dari Railway
$database = "railway";                   // nama database di Railway
$username = "root";                      // username dari Railway
$password = "BzqBvkxgNYrBiaaQClzRvJvsRPXfKvyz"; // ganti dengan password yang benar

// Koneksi MySQLi
$conn = mysqli_connect($servername, $username, $password, $database, $port);
if (!$conn) {
    die("Koneksi MySQLi gagal: " . mysqli_connect_error());
}

// Koneksi PDO
try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}
?>
