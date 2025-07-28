<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'apkkelasvirtual';

// Koneksi MySQLi
$koneksi = new mysqli($host, $user, $pass, $db);

if ($koneksi->connect_error) {
    die("Koneksi MySQLi gagal: " . $koneksi->connect_error);
}

// Koneksi PDO (opsional)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}

date_default_timezone_set('Asia/Jakarta');
?>
