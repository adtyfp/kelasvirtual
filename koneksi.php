<?php
$host     = "shortline.proxy.rlwy.net";  // HOST dari Railway
$port     = 16491;                        // PORT dari Railway
$database = "railway";                   // NAMA DATABASE
$username = "root";                      // USERNAME
$password = "ISI_PASSWORD_KAMU";         // PASSWORD dari Railway

// --- MYSQLI ---
$conn = mysqli_connect($host, $username, $password, $database, $port);
if (!$conn) {
    die("Koneksi MySQLi Gagal: " . mysqli_connect_error());
}

// --- PDO ---
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi PDO berhasil";
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}
?>
