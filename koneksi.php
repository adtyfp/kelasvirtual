<?php
$host = 'shortline.proxy.rlwy.net'; // Perhatikan typo di 'proxy' sebelumnya
$db = 'railway';
$user = 'root';
$pass = 'BzqBvkxgNYrBiaaQClzRvJvsRPXfKvyz';
$charset = 'utf8mb4';
$port = 3306;

// Opsi tambahan untuk koneksi
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_TIMEOUT            => 10, // Timeout dalam detik
];

try {
    // Format DSN dengan port yang ditentukan
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
    
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Test koneksi sederhana
    $pdo->query("SELECT 1");
    
    // Jika sampai sini, koneksi berhasil
    // echo "Koneksi berhasil!"; // Bisa di-comment setelah testing
} catch (PDOException $e) {
    // Tampilkan pesan error yang lebih informatif
    $error_message = "Koneksi gagal: " . $e->getMessage() . "\n";
    $error_message .= "Pastikan:\n";
    $error_message .= "- Host, port, dan credential benar\n";
    $error_message .= "- Database service sedang berjalan\n";
    $error_message .= "- Koneksi internet stabil\n";
    $error_message .= "- Firewall mengizinkan koneksi ke port $port";
    
    die($error_message);
}
?>
