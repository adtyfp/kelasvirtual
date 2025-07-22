<?php
require_once 'koneksi.php';

try {
    // Gunakan prepared statement agar aman dari SQL Injection
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

    // Contoh data dummy
    $stmt->execute([
        'name'     => 'Tes User',
        'email'    => 'tes@email.com',
        'password' => password_hash('12345', PASSWORD_BCRYPT)
    ]);

    echo "✅ BERHASIL SIMPAN DATA!";
} catch (PDOException $e) {
    echo "❌ GAGAL SIMPAN: " . $e->getMessage();
}
?>
