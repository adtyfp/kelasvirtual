<?php
session_start();
require_once 'koneksi.php';

// Redirect jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data user
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user) {
    die("User tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $note = $_POST['note'] ?? '';

    // Upload foto jika ada
    $profilePicture = $user['profile_picture'];
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetPath)) {
            if (!empty($user['profile_picture']) && $user['profile_picture'] !== 'default.jpg') {
                @unlink($uploadDir . $user['profile_picture']);
            }
            $profilePicture = $filename;
        }
    }

    // Update semua kolom
    $stmt = $pdo->prepare("UPDATE users SET 
        name = ?, note = ?, profile_picture = ?,
        first_name = ?, last_name = ?, address1 = ?, address2 = ?,
        city = ?, state = ?, zip = ?, country = ?,
        phone_number = ?, telegram_username = ?
        WHERE id = ?");

    $stmt->execute([
        $name,
        $note,
        $profilePicture,
        $_POST['first_name'] ?? '',
        $_POST['last_name'] ?? '',
        $_POST['address1'] ?? '',
        $_POST['address2'] ?? '',
        $_POST['city'] ?? '',
        $_POST['state'] ?? '',
        $_POST['zip'] ?? '',
        $_POST['country'] ?? '',
        $_POST['phone_number'] ?? '',
        $_POST['telegram_username'] ?? '',
        $_SESSION['user_id']
    ]);

    header("Location: profile.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Pengguna</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="css/profile.css">
  <style>
    /* CSS dari sebelumnya tetap sama */
  </style>
</head>

<body>
  <div class="profile-container">
    <!-- Header Gradient -->
    <div class="profile-header"></div>

    <!-- Foto Profil -->
    <div class="profile-picture">
      <?php if ($user['profile_picture'] && file_exists('uploads/' . $user['profile_picture'])): ?>
        <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile Picture">
      <?php else: ?>
        <i class="fas fa-user"></i>
      <?php endif; ?>
    </div>

    <!-- Info Pengguna -->
    <div class="profile-info">
      <h1><?= htmlspecialchars($user['name']) ?></h1>
      <p><?= htmlspecialchars($user['email']) ?></p>
    </div>

    <!-- Tombol Aksi -->
    <div class="action-buttons">
      <button class="btn-edit" onclick="openModal()">Edit Profile</button>
      <button class="btn-activity" onclick="location.href='aktivitas.php'">Aktivitas</button>
      <button class="btn-logout" onclick="logout()">Log Out</button>
    </div>

    <!-- Section Note -->
    <div class="note-section">
      <h2>Catatan</h2>
      <p><?= $user['note'] ? nl2br(htmlspecialchars($user['note'])) : 'Tidak ada catatan' ?>
      </p>
    </div>

<!-- Personal Detail -->
<div class="personal-details-section">
  <h2>Detail Pribadi</h2>

  <div class="detail-item">
    <div class="detail-label">Nama Depan</div>
    <div class="detail-value"><?= htmlspecialchars($user['first_name'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">Nama Belakang</div>
    <div class="detail-value"><?= htmlspecialchars($user['last_name'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">Alamat 1</div>
    <div class="detail-value"><?= htmlspecialchars($user['address1'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">Alamat 2</div>
    <div class="detail-value"><?= htmlspecialchars($user['address2'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">Kota</div>
    <div class="detail-value"><?= htmlspecialchars($user['city'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">Provinsi</div>
    <div class="detail-value"><?= htmlspecialchars($user['state'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">ZIP</div>
    <div class="detail-value"><?= htmlspecialchars($user['zip'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">Negara</div>
    <div class="detail-value"><?= htmlspecialchars($user['country'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label">Nomor Telp</div>
    <div class="detail-value"><?= htmlspecialchars($user['phone_number'] ?? '') ?></div>
  </div>

  <div class="detail-item">
    <div class="detail-label"> Username Telegram</div>
    <div class="detail-value"><?= htmlspecialchars($user['telegram_username'] ?? '') ?></div>
  </div>
</div>

  <!-- Modal Edit Profile -->
<div id="editModal" class="modal" style="display:none;">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Edit Profil</h2>
      <span class="close" onclick="closeModal()">&times;</span>
    </div>
    
    <div class="modal-body">
      <form method="POST" enctype="multipart/form-data">

        <!-- Informasi Utama -->
        <div class="form-section">
          <h3>Informasi Utama</h3>
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
          </div>

          <div class="form-group">
            <label for="profile_picture">Foto Profil</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
          </div>

          <div class="form-group">
            <label for="note">Catatan</label>
            <textarea id="note" name="note" rows="4"><?= htmlspecialchars($user['note']) ?></textarea>
          </div>
        </div>

        <!-- Detail Pribadi -->
        <div class="form-section">
          <h3>Detail Personal</h3>

          <div class="form-row">
            <div class="form-group">
              <label for="first_name">Nama Depan</label>
              <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label for="last_name">Nama Belakang</label>
              <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
            </div>
          </div>

          <div class="form-group">
            <label for="address1">Alamat 1</label>
            <input type="text" id="address1" name="address1" value="<?= htmlspecialchars($user['address1'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="address2">Alamat 2</label>
            <input type="text" id="address2" name="address2" value="<?= htmlspecialchars($user['address2'] ?? '') ?>">
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="city">Kota</label>
              <input type="text" id="city" name="city" value="<?= htmlspecialchars($user['city'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label for="state">Provinsi</label>
              <input type="text" id="state" name="state" value="<?= htmlspecialchars($user['state'] ?? '') ?>">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="zip">Kode Pos</label>
              <input type="text" id="zip" name="zip" value="<?= htmlspecialchars($user['zip'] ?? '') ?>">
            </div>
            <div class="form-group">
              <label for="country">Negara</label>
              <select id="country" name="country">
                <option value="Indonesia" <?= ($user['country'] === 'Indonesia') ? 'selected' : '' ?>>Indonesia</option>
                <option value="Malaysia" <?= ($user['country'] === 'Malaysia') ? 'selected' : '' ?>>Malaysia</option>
                <option value="Singapore" <?= ($user['country'] === 'Singapore') ? 'selected' : '' ?>>Singapore</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="phone_number">Nomor Telepon</label>
            <input type="tel" id="phone_number" name="phone_number" value="<?= htmlspecialchars($user['phone_number'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="telegram_username">Telegram Username</label>
            <input type="text" id="telegram_username" name="telegram_username" value="<?= htmlspecialchars($user['telegram_username'] ?? '') ?>">
          </div>
        </div>

        <div class="form-actions">
          <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
          <button type="submit" class="btn-submit">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

    <!-- bottom nav -->
    <nav class="bottom-nav">
      <a href="index.php" id="nav-beranda" class="nav-item">
        <i class="fas fa-home"></i>
        <span>Beranda</span>
      </a>
      <a href="tugas.php" id="nav-tugas" class="nav-item">
        <i class="fas fa-tasks"></i>
        <span>Tugas</span>
      </a>

      <div class="nav-logo-wrapper">
        <a href="index.php" class="nav-logo">
          <img src="asset/kelas.png" alt="Kelas Virtual">
        </a>
      </div>

      <a href="pesan.php" id="nav-pesan" class="nav-item">
        <i class="fas fa-comment-alt"></i>
        <span>Pesan</span>
      </a>
      <a href="profile.php" id="nav-profil" class="nav-item">
        <i class="fas fa-user"></i>
        <span>Profile</span>
      </a>
    </nav>

<script>
// Logout Function
function logout() {
  if (confirm("Apakah Anda yakin ingin keluar?")) {
    window.location.href = 'logout.php';
  }
}

// Modal Functions
function openModal() {
  document.getElementById("editModal").style.display = "flex";
  document.body.style.overflow = "hidden"; // Prevent body scrolling
}

function closeModal() {
  document.getElementById("editModal").style.display = "none";
  document.body.style.overflow = "auto"; // Restore body scrolling
}

// Close modal when clicking outside
window.onclick = function(event) {
  const modal = document.getElementById("editModal");
  if (event.target === modal) {
    closeModal();
  }
}

// Close modal with ESC key
document.addEventListener('keydown', function(event) {
  const modal = document.getElementById("editModal");
  if (event.key === "Escape" && modal.style.display === "flex") {
    closeModal();
  }
});

// Highlight current page in navigation
const currentPage = window.location.pathname.split("/").pop();

document.querySelectorAll(".bottom-nav .nav-item").forEach((link) => {
  if (link.getAttribute("href").includes(currentPage)) {
    link.classList.add("active");
  } else {
    link.classList.remove("active");
  }
});

// File upload preview (optional enhancement)
document.getElementById('profile_picture').addEventListener('change', function(e) {
  const file = e.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
      // You can show preview here if needed
      console.log("File selected:", file.name);
    };
    reader.readAsDataURL(file);
  }
});
</script>
</body>

</html>
