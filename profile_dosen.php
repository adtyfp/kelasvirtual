<?php
require_once 'koneksi.php';

// Ambil ID dosen dari URL
$dosen_id = $_GET['id'] ?? 0;

// Ambil data dosen
$stmt = $koneksi->prepare("SELECT * FROM profil_dosen WHERE id = ?");
$stmt->bind_param("i", $dosen_id);
$stmt->execute();
$result = $stmt->get_result();
$dosen = $result->fetch_assoc();

// Jika data dosen tidak ditemukan
if (!$dosen) {
    echo "<h2 style='padding: 20px; color: red;'>Data dosen tidak ditemukan.</h2>";
    exit();
}

// Ambil data prestasi dosen
$stmt2 = $koneksi->prepare("SELECT * FROM prestasi_dosen WHERE dosen_id = ?");
$stmt2->bind_param("i", $dosen_id);
$stmt2->execute();
$prestasi = $stmt2->get_result();

// Fungsi aman
function safe($val, $fallback = '-') {
    return isset($val) && $val !== '' ? htmlspecialchars($val) : $fallback;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Dosen</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f5f6fa;
    }

    .header {
      background-color: #3d7bff;
      color: white;
      padding: 15px 20px;
      display: flex;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 100;
    }

    .header-icon a {
      color: white;
      text-decoration: none;
      font-size: 20px;
    }

    .header-title {
      flex-grow: 1;
      text-align: center;
      font-weight: bold;
      font-size: 20px;
      margin-right: 20px;
    }

    .container {
      padding: 16px;
    }

    .card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }

    .card img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 12px;
    }

    .card p {
      font-size: 14px;
      margin: 4px 0;
      color: #555;
    }

    .section {
      background: white;
      padding: 16px;
      border-radius: 12px;
      margin-bottom: 16px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .section h3 {
      font-size: 16px;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .section p {
      font-size: 14px;
      color: #444;
      text-align: justify;
    }

    .achievement-card {
      display: flex;
      align-items: flex-start;
      background: #fff;
      padding: 12px;
      margin: 12px 0;
      border-bottom: 1px solid #e0e0e0;
    }

    .achievement-card img {
      width: 80px;
      height: 80px;
      object-fit: cover;
      margin-right: 16px;
      border-radius: 4px;
    }

    .achievement-content {
      flex: 1;
    }

    .achievement-content h4 {
      font-size: 15px;
      font-weight: bold;
      margin: 0 0 4px;
    }

    .achievement-content p {
      font-size: 13px;
      margin: 0 0 6px;
      color: #444;
    }

    .badges {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
    }

    .badge {
      font-size: 12px;
      padding: 4px 10px;
      border-radius: 4px;
      color: white;
      font-weight: 600;
    }

    .badge.blue {
      background-color: #3498db;
    }

    .badge.gray {
      background-color: #7f8c8d;
    }

    .badge.green {
      background-color: #1abc9c;
    }

    @media (max-width: 600px) {
      .header-title {
        font-size: 18px;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <div class="header-icon">
      <a href="index.php"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="header-title">Profil Dosen</div>
  </div>

  <!-- Konten -->
  <div class="container">

    <!-- Kartu Profil -->
    <div class="card">
      <img src="assets2/<?= safe($dosen['foto'], 'default.jpg') ?>" alt="Foto Dosen">
      <h3><?= safe($dosen['nama']) ?></h3>
      <p><strong>NIDN:</strong> <?= safe($dosen['nidn']) ?></p>
      <p><strong>Pendidikan:</strong> <?= safe($dosen['pendidikan']) ?></p>
      <p><strong>Tanggal Lahir:</strong> <?= safe($dosen['tanggal_lahir']) ?></p>
      <p><strong>Jabatan Fungsional:</strong> <?= safe($dosen['jabatan']) ?></p>
      <p><strong>Bidang Pendidikan:</strong> <?= safe($dosen['bidang_pendidikan']) ?></p>
    </div>

    <!-- Latar Belakang -->
    <div class="section">
      <h3>Latar Belakang</h3>
      <p><?= nl2br(safe($dosen['latar_belakang'])) ?></p>
    </div>

    <!-- Prestasi -->
    <div class="section">
      <h3>Prestasi</h3>
      <?php if ($prestasi && $prestasi->num_rows > 0): ?>
        <?php while ($row = $prestasi->fetch_assoc()): ?>
          <div class="achievement-card">
            <img src="uploads/<?= safe($row['gambar'], 'default.jpg') ?>" alt="<?= safe($row['judul']) ?>">
            <div class="achievement-content">
              <h4><?= safe($row['judul']) ?></h4>
              <p><?= safe($row['deskripsi']) ?></p>
              <div class="badges">
                <span class="badge blue"><?= safe($row['kategori1']) ?></span>
                <span class="badge gray"><?= safe($row['kategori2']) ?></span>
                <span class="badge green"><?= safe($row['tahun']) ?></span>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="text-align: center; color: #888;">Belum ada data prestasi.</p>
      <?php endif; ?>
    </div>

  </div>
</body>
</html>
