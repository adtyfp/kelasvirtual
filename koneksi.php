<?php
// Ganti dengan detail dari Railway → tab "Variables"
$servername = "mysql-railway.internal"; // hostname (gunakan nilai dari MYSQLHOST jika berbeda)
$database   = "a264133_cma24meo";       // nama database dari MYSQLDATABASE
$username   = "root";                   // username dari MYSQLUSER
$password   = "BzqBvkxgNYrBiaaQClzRvJvsRPXfKvyz"; // password dari MYSQLPASSWORD
$port       = 3306;                     // default port (atau ganti jika Railway memberi port khusus)

// ----- KONEKSI MENGGUNAKAN MYSQLI -----
$conn = mysqli_connect($servername, $username, $password, $database, $port);

// Cek koneksi mysqli
if (!$conn) {
    die("Koneksi MySQLi Gagal: " . mysqli_connect_error());
}

// ----- KONEKSI MENGGUNAKAN PDO -----
try {
    $pdo = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi PDO berhasil";
} catch (PDOException $e) {
    die("Koneksi PDO gagal: " . $e->getMessage());
}
?>
