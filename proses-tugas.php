<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id     = $_SESSION['user_id'];
    $nama_tugas  = trim($_POST['nama_tugas'] ?? '');
    $mata_kuliah = trim($_POST['mata_kuliah'] ?? '');
    $deadline    = trim($_POST['deadline'] ?? '');
    $file_name   = '';

    // Upload file jika ada
    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $original_name = $_FILES['file']['name'];
        $file_ext = pathinfo($original_name, PATHINFO_EXTENSION);
        $file_name = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9\._-]/', '', $original_name);
        $target_file = $upload_dir . $file_name;

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            die("Gagal mengupload file");
        }
    }

    try {
        // Simpan ke database menggunakan PDO
        $stmt = $pdo->prepare("INSERT INTO tugas (user_id, nama_tugas, mata_kuliah, deadline, file, is_uploaded) 
                              VALUES (:user_id, :nama_tugas, :mata_kuliah, :deadline, :file, 1)");
        
        $stmt->execute([
            ':user_id' => $user_id,
            ':nama_tugas' => $nama_tugas,
            ':mata_kuliah' => $mata_kuliah,
            ':deadline' => $deadline,
            ':file' => $file_name
        ]);

        header("Location: kumpulkan.php?status=berhasil");
        exit();
    } catch (PDOException $e) {
        die("Gagal menyimpan tugas: " . $e->getMessage());
    }
}
?>
