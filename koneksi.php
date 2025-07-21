<?php
$host     = "shortline.proxy.rlwy.net";
$port     = 16491;
$database = "a264133_cma24meo"; // <== pakai ini!
$username = "root";
$password = "PASSWORD_RAILWAY_KAMU";

$conn = mysqli_connect($host, $username, $password, $database, $port);
if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}
?>
