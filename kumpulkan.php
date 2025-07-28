<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$task_id = (int)($_GET['task_id'] ?? 0);

// Ambil data tugas
$stmt = $koneksi->prepare("SELECT * FROM tugashome WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $task_id, $_SESSION['user_id']);
$stmt->execute();
$tugas = $stmt->get_result()->fetch_assoc();

if (!$tugas) {
    $_SESSION['error'] = "Tugas tidak ditemukan";
    header("Location: tugas.php");
    exit();
}

// Cek apakah sudah dikumpulkan
$submitted_stmt = $koneksi->prepare("SELECT * FROM tugas WHERE nama_tugas = ? AND mata_kuliah = ? AND user_id = ?");
$submitted_stmt->bind_param("ssi", $tugas['nama_tugas'], $tugas['mata_kuliah'], $_SESSION['user_id']);
$submitted_stmt->execute();
$is_submitted = $submitted_stmt->get_result()->num_rows > 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tugas UI</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #fbeeff;
      color: #333;
      padding-bottom: 80px;
    }

    .header {
      background: #3d7bff;
      color: white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 16px;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .header h1 {
      font-size: 18px;
      font-weight: 600;
      flex: 1;
      text-align: center;
    }

    .header i:first-child {
      font-size: 18px;
    }

    .header-icons {
      display: flex;
      gap: 15px;
    }

    .content {
      padding: 16px;
    }

    .card {
      background: white;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin-bottom: 16px;
    }

    .thumbnail {
      height: 120px;
      background: #ccc;
      border-radius: 8px 8px 0 0;
      overflow: hidden;
    }

    .thumbnail img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .thumbnail-icon {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
      color: white;
      background: #3d7bff;
    }

    .card-content {
      padding: 12px 16px;
    }

    .card-content h2 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 6px;
    }

    .card-content p {
      font-size: 14px;
      color: #666;
      margin: 2px 0;
    }

    .deadline-bar {
      background: #ffe1bb;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 13px;
      color: #444;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 10px;
    }

    .fab {
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 50px;
      height: 50px;
      background: #3d7bff;
      color: white;
      border: none;
      border-radius: 50%;
      font-size: 22px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      z-index: 20;
      cursor: pointer;
    }

        .alert {
      padding: 10px;
      margin: 10px 0;
      border-radius: 4px;
    }
    .alert.success {
      background-color: #dff0d8;
      color: #3c763d;
    }
    .alert.error {
      background-color: #f2dede;
      color: #a94442;
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="header">
  <a href="tugas.php"><i class="fas fa-arrow-left"></i></a>
  <h1>Kumpulkan Tugas</h1>
  <div class="header-icons">
    <i class="fas fa-search"></i>
  </div>
</header>

<!-- Main Content -->
<main class="content">
    <?php if (isset($_SESSION['success'])): ?>
      <div class="alert success"><?= $_SESSION['success'] ?></div>
      <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

  <!-- Task Details -->
  <div class="card">
    <div class="card-content">
      <h2><?= htmlspecialchars($tugas['nama_tugas'] ?? 'N/A') ?></h2>
      <p><i class="fas fa-book"></i> Mata Kuliah: <?= htmlspecialchars($tugas['mata_kuliah'] ?? 'N/A') ?></p>
      <p><i class="fas fa-calendar-alt"></i> Deadline: <?= isset($tugas['deadline']) ? date('d M Y', strtotime($tugas['deadline'])) : 'N/A' ?></p>
      <div class="submission-status <?= $is_submitted ? 'submitted' : 'not-submitted' ?>">
        <i class="fas <?= $is_submitted ? 'fa-check-circle' : 'fa-exclamation-circle' ?>"></i>
        <?= $is_submitted ? 'Tugas sudah dikumpulkan' : 'Tugas belum dikumpulkan' ?>
      </div>
    </div>
  </div>

  <!-- Submitted Files -->
  <?php
  $file_stmt = $koneksi->prepare("SELECT * FROM tugas WHERE nama_tugas = ? AND mata_kuliah = ? AND user_id = ?");
  $file_stmt->bind_param("ssi", $tugas['nama_tugas'], $tugas['mata_kuliah'], $_SESSION['user_id']);
  $file_stmt->execute();
  $files = $file_stmt->get_result();
  
  if ($files->num_rows > 0): ?>
    <h3 style="margin: 16px 0 8px; font-size: 16px;">File Terkumpul:</h3>
    <?php while($file = $files->fetch_assoc()): ?>
      <div class="card">
        <div class="card-content">
          <a href="uploads/<?= htmlspecialchars($file['file']) ?>" target="_blank">
            <i class="fas fa-file-download"></i> <?= htmlspecialchars($file['file']) ?>
          </a>
          <p style="font-size: 12px; color: #666; margin-top: 4px;">
            Dikumpulkan: <?= date('d M Y H:i', strtotime($file['submitted_at'])) ?>
          </p>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p style="text-align: center; color: #999; margin-top: 20px;">Belum ada file dikumpulkan</p>
  <?php endif; ?>
</main>

<!-- Add Button -->
<?php if (!$is_submitted): ?>
<button class="fab" onclick="window.location.href='input-tugas.php?task_id=<?= $task_id ?>&nama=<?= urlencode($tugas['nama_tugas']) ?>&matkul=<?= urlencode($tugas['mata_kuliah']) ?>&deadline=<?= urlencode($tugas['deadline']) ?>'">
  <i class="fas fa-plus"></i>
</button>
<?php endif; ?>
</body>
</html>
