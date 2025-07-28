<?php
// 1. Atur error reporting untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 2. Pastikan session start di awal
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Gunakan path absolut untuk require
$rootDir = realpath(__DIR__ . '/..');
require_once __DIR__ . '/koneksi.php';

// 4. Validasi user login
if (!isset($_SESSION['user_id'])) {
    header("HTTP/1.1 401 Unauthorized");
    exit(json_encode(['error' => 'Anda harus login terlebih dahulu']));
}

// 5. Hanya terima request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 405 Method Not Allowed");
    exit(json_encode(['error' => 'Method tidak diizinkan']));
}

// Validasi task_id
if (empty($_POST['task_id']) || !is_numeric($_POST['task_id'])) {
    $_SESSION['error'] = "ID Tugas tidak valid";
    header("Location: tugas.php");
    exit();
}

// Validasi file
if (empty($_FILES['file']['name'])) {
    $_SESSION['error'] = "File tugas harus diupload";
    header("Location: input-tugas.php?task_id=".$_POST['task_id']);
    exit();
}


// 7. Proses upload file
try {
    $user_id = $_SESSION['user_id'];
    $task_id = (int)$_POST['task_id'];
    
    // Validasi file upload
    if (empty($_FILES['file']['name'])) {
        throw new Exception("File harus diupload");
    }

    $uploadDir = $rootDir . '/uploads/';
    if (!file_exists($uploadDir)) {
        if (!mkdir($uploadDir, 0755, true)) {
            throw new Exception("Gagal membuat folder upload");
        }
    }

    // Generate nama file unik
    $fileName = time() . '_' . basename($_FILES['file']['name']);
    $filePath = $uploadDir . $fileName;

    // Pindahkan file
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        throw new Exception("Gagal menyimpan file");
    }

    // 8. Mulai transaksi database
    $koneksi->begin_transaction();

    try {
        // Simpan ke tabel tugas
        $stmt = $koneksi->prepare("INSERT INTO tugas (user_id, nama_tugas, mata_kuliah, deadline, file) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $koneksi->error);
        }
        
        $stmt->bind_param("issss", 
            $user_id,
            $_POST['nama_tugas'],
            $_POST['mata_kuliah'],
            $_POST['deadline'],
            $fileName
        );

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Update status di tugashome
        $update = $koneksi->prepare("UPDATE tugashome SET status = 'selesai', updated_at = NOW() WHERE id = ? AND user_id = ?");
        if (!$update) {
            throw new Exception("Prepare update failed: " . $koneksi->error);
        }

        $update->bind_param("ii", $task_id, $user_id);
        if (!$update->execute()) {
            throw new Exception("Execute update failed: " . $update->error);
        }

        // Commit transaksi
        $koneksi->commit();

        // 9. Response sukses
        $_SESSION['success'] = "Tugas berhasil dikumpulkan!";
        header("Location: tugas.php?success=1");
        exit();

    } catch (Exception $e) {
        $koneksi->rollback();
        throw $e;
    }

} catch (Exception $e) {
    // 10. Error handling
    error_log("Error in proses-tugas.php: " . $e->getMessage());
    $_SESSION['error'] = "Gagal mengumpulkan tugas: " . $e->getMessage();
    header("Location: kumpulkan.php?task_id=" . ($_POST['task_id'] ?? ''));
    exit();
}
?>
