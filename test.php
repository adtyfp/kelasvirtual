<?php
require_once 'koneksi.php';

try {
    // Gunakan prepared statement agar aman dari SQL Injection
    $stmt = $pdo->prepare("INSERT INTO users (name, email, nim, note, password) VALUES (:name, :email, :nim, :note, :password)");

    // Contoh data dummy
    $stmt->execute([
        'name'     => 'Tes User',
        'email'    => 'tes@email.com',
        'nim'    => '11223344',
        'note'    => '11223344',
        'password' => password_hash('12345', PASSWORD_BCRYPT)
    ]);

    echo "✅ BERHASIL SIMPAN DATA!";
} catch (PDOException $e) {
    echo "❌ GAGAL SIMPAN: " . $e->getMessage();
}
?>
