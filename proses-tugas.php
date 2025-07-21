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

        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
    }

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO tugas (user_id, nama_tugas, mata_kuliah, deadline, file, is_uploaded) VALUES (?, ?, ?, ?, ?, 1)");
    $stmt->bind_param("issss", $user_id, $nama_tugas, $mata_kuliah, $deadline, $file_name);

    if ($stmt->execute()) {
        header("Location: kumpulkan.php?status=berhasil");
        exit();
    } else {
        echo "Gagal menyimpan tugas: " . $stmt->error;
    }

    $stmt->close();
}
?>
