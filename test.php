<?php
require_once 'koneksi.php';

$sql = "INSERT INTO users (nama, email, password) VALUES ('Tes User', 'tes@email.com', '12345')";
if (mysqli_query($conn, $sql)) {
    echo "✅ BERHASIL SIMPAN DATA!";
} else {
    echo "❌ GAGAL: " . mysqli_error($conn);
}
?>
