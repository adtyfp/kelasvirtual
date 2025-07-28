<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Pastikan parameter yang diterima sesuai
$task_id = (int)($_GET['task_id'] ?? 0);  // Ubah dari 'id' ke 'task_id'
$nama_tugas = htmlspecialchars($_GET['nama'] ?? '');
$mata_kuliah = htmlspecialchars($_GET['matkul'] ?? '');
$deadline = htmlspecialchars($_GET['deadline'] ?? '');

if ($task_id === 0) {
    $_SESSION['error'] = "ID Tugas tidak valid";
    header("Location: tugas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #fbeeff;
      padding: 20px;
      max-width: 500px;
      margin: auto;
    }

    h2 {
      color: #9c27b0;
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    select,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .submit-btn {
      background: #9c27b0;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
    }

    .submit-btn:hover {
      background: #7b1fa2;
    }
  </style>
</head>
<body>
  <div class="input-tugas-container">
    <h2>Kumpulkan Tugas</h2>

    <?php if (isset($_SESSION['error'])): ?>
      <div class="alert error"><?= $_SESSION['error'] ?></div>
      <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="proses-tugas.php" method="POST" enctype="multipart/form-data" id="formTugas">
      <input type="hidden" name="task_id" value="<?= $task_id ?>">
      
      <div class="form-group">
        <label>Nama Tugas</label>
        <input type="text" value="<?= $nama_tugas ?>" readonly>
        <input type="hidden" name="nama_tugas" value="<?= $nama_tugas ?>">
      </div>

      <div class="form-group">
        <label>Mata Kuliah</label>
        <input type="text" value="<?= $mata_kuliah ?>" readonly>
        <input type="hidden" name="mata_kuliah" value="<?= $mata_kuliah ?>">
      </div>

      <div class="form-group">
        <label>Deadline</label>
        <input type="text" value="<?= $deadline ?>" readonly>
        <input type="hidden" name="deadline" value="<?= $deadline ?>">
      </div>

      <div class="form-group">
        <label for="file">File Tugas (PDF/DOC/JPEG/PNG)</label>
        <input type="file" id="file" name="file" required accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
      </div>

      <button type="submit" class="submit-btn">Kumpulkan Tugas</button>
    </form>
  </div>

  <script>
  // Validasi sebelum submit
  document.getElementById('formTugas').addEventListener('submit', function(e) {
      const fileInput = document.getElementById('file');
      if (fileInput.files.length === 0) {
          alert('Silakan pilih file terlebih dahulu!');
          e.preventDefault();
          return false;
      }
      
      const allowedTypes = ['application/pdf', 'application/msword', 
          'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
          'image/jpeg', 'image/png'];
      
      if (!allowedTypes.includes(fileInput.files[0].type)) {
          alert('Hanya file PDF, DOC, JPEG, atau PNG yang diizinkan!');
          e.preventDefault();
          return false;
      }
      
      return true;
  });
  </script>
</body>
</html>
