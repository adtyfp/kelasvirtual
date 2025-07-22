<?php
session_start(); // Memulai session

// Cek apakah user sudah login (opsional, tergantung kebutuhan)
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login atau tampilkan pesan
    header("Location: login.php");
    exit();
}
// koneksi
$host = 'shortline.proxy.rlwy.net';
$port = 16491; // <- ini penting!
$user = 'root';
$password = 'BzqBvkxgNYrBiaaQClzRvJvsRPXfKvyz';
$database = 'railway';

$koneksi = new mysqli($host, $user, $password, $database, $port);


// Ambil hanya tugas dari sistem (bukan hasil upload user)
$tugasResult = $koneksi->query("SELECT * FROM tugashome WHERE is_uploaded = 0 ORDER BY deadline ASC");
while ($row = $tugasResult->fetch_assoc()) {
    $tugas[] = $row;
}

$kuisResult = $koneksi->query("SELECT * FROM kuis ORDER BY id DESC");
while ($row = $kuisResult->fetch_assoc()) {
    $kuis[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas - Edukasi Mobile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            padding-bottom: 70px;
        }

        .header {
            background-color: #3d7bff   ;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title {
            font-weight: 700;
            font-size: 18px;
            flex-grow: 1;
            text-align: center;
        }

        .header-icon {
            font-size: 20px;
            cursor: pointer;
            padding: 5px;
        }

        .tab-menu {
            display: flex;
            background-color: white;
            border-bottom: 1px solid #e0e0e0;
            position: relative;
            overflow: hidden;
        }

        .tab {
            flex: 1;
            text-align: center;
            padding: 15px 0;
            font-weight: 500;
            cursor: pointer;
            position: relative;
            color: #7f8c8d;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .tab.active {
            color: #f39c12;
        }

        .tab-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 50%;
            background-color: #f39c12;
            border-radius: 3px 3px 0 0;
            transition: all 0.3s ease;
        }

        .content-container {
            position: relative;
            overflow: hidden;
            min-height: 300px;
        }

        .content {
            position: absolute;
            width: 100%;
            padding: 15px;
            transition: all 0.4s ease;
            top: 0;
            left: 0;
            opacity: 0;
            pointer-events: none;
        }

        .content.active {
            opacity: 1;
            pointer-events: auto;
            position: relative;
        }

        .task-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .task-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
            color: #2c3e50;
            padding-right: 80px;
        }

        .progress-container {
            margin-bottom: 15px;
        }

        .progress-bar {
            height: 6px;
            background-color: #ecf0f1;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 5px;
        }

        .progress {
            height: 100%;
            background-color:rgb(39, 176, 48);
            width: 45%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 12px;
            font-weight: 500;
            color: #f44336;
        }

        .submit-btn {
            display: inline-block;
            padding: 6px 12px;
            background-color: #f39c12 ;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .submit-btn:hover {
            background-color:rgb(249, 183, 76);
            transform: scale(1.05);
        }

        .due-date {
            display: flex;
            align-items: center;
            margin-top: 15px;
            font-size: 12px;
            color: #7f8c8d;
        }

        .due-date i {
            margin-right: 5px;
            color:rgb(0, 0, 0);
        }

        .quiz-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .quiz-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        .quiz-status-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .quiz-status-badge.belum {
            color: #f44336;
            /* Merah */
        }

        .quiz-status-badge.selesai {
            color: #4caf50;
            /* Hijau */
        }

        .quiz-duration {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: #7f8c8d;
        }

        .quiz-duration i {
            margin-right: 5px;
            color:rgb(0, 0, 0);
        }

      
.bottom-nav {
  position: fixed;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 55px; /* Dikurangi dari 70px */
  background:  linear-gradient( #73a5f0 0%, #124fd3 100%);
  display: flex;
  justify-content: space-around;
  align-items: center;
  z-index: 1000;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
  box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
  padding: 0 15px; /* Tambah padding samping */
}

.bottom-nav .nav-item {
  flex: 0 1 auto; /* Ubah dari flex: 1 agar tidak mengambil ruang penuh */
  text-align: center;
  color: white;
  font-size: 11px; /* Dikurangi dari 12px */
  text-decoration: none;
  position: relative;
  padding-top: 3px; /* Dikurangi dari 5px */
  min-width: 50px; /* Dikurangi dari 60px */
}

/* Atur jarak khusus untuk ikon yang berada di samping logo */
.bottom-nav .nav-item:nth-child(2) { /* Tugas (sebelum logo) */
  margin-right: 35px; /* Dikurangi dari 40px */
}

.bottom-nav .nav-item:nth-child(4) { /* Pesan (setelah logo) */
  margin-left: 35px; /* Dikurangi dari 40px */
}

.bottom-nav .nav-item i {
  font-size: 16px; /* Dikurangi dari 18px */
  display: block;
  margin-bottom: 2px;
}

/* Active link */
.bottom-nav .nav-item.active,
.bottom-nav .nav-item.active i {
  color: #ffc400;
  font-weight: semibold;
}

/* Logo tengah */
.nav-logo-wrapper {
  position: absolute;
  top: -25px; /* Disesuaikan dari -30px */
  left: 50%;
  transform: translateX(-50%);
  background: #2196F3;
  width: 55px; /* Dikurangi dari 65px */
  height: 55px; /* Dikurangi dari 65px */
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  z-index: 1001; /* Pastikan logo di atas ikon */
}

.nav-logo-wrapper .nav-logo {
  display: block;
  width: 50px; /* Dikurangi dari 60px */
  height: 50px; /* Dikurangi dari 60px */
  background: white;
  border-radius: 50%;
  padding: 8px; /* Dikurangi dari 10px */
  overflow: hidden;
}

.nav-logo-wrapper .nav-logo img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}

/* Alternative: Jika ingin menggunakan CSS Grid untuk kontrol yang lebih presisi */
/*
.bottom-nav {
  display: grid;
  grid-template-columns: 1fr 1fr 80px 1fr 1fr;
  gap: 10px;
  padding: 0 20px;
}

.nav-logo-wrapper {
  grid-column: 3;
  position: relative;
  top: -30px;
}
*/

        /* Slide Animations */
        .slide-in-left {
            animation: slideInLeft 0.4s forwards;
        }

        .slide-out-left {
            animation: slideOutLeft 0.4s forwards;
        }

        .slide-in-right {
            animation: slideInRight 0.4s forwards;
        }

        .slide-out-right {
            animation: slideOutRight 0.4s forwards;
        }

        @keyframes slideInLeft {
            from {
                transform: translateX(-100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(-100%);
                opacity: 0;
            }
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
    </style>
</head>
<body>

<div class="header">
    <div class="header-title">Tugas</div>
    <div class="header-icon" onclick="refreshPage()"><i class="fas fa-sync-alt"></i></div>
</div>

<div class="tab-menu">
    <div class="tab active" onclick="switchTab('tugas')">Tugas</div>
    <div class="tab" onclick="switchTab('kuis')">Kuis</div>
    <div class="tab-indicator"></div>
</div>

<div class="content-container">
    <div class="content content-tugas active" id="tugasContent">
        <?php include 'konten/konten-tugas.php'; ?>
    </div>

    <div class="content content-kuis" id="kuisContent">
        <?php include 'konten/konten-kuis.php'; ?>
    </div>
</div>

<nav class="bottom-nav">
    <a href="index.php" class="nav-item"><i class="fas fa-home"></i><span>Beranda</span></a>
    <a href="tugas.php" class="nav-item active"><i class="fas fa-tasks"></i><span>Tugas</span></a>
    <div class="nav-logo-wrapper"><a href="index.php" class="nav-logo"><img src="asset/kelas.png" alt="Kelas Virtual"></a></div>
    <a href="pesan.php" class="nav-item"><i class="fas fa-comment-alt"></i><span>Pesan</span></a>
    <a href="profile.php" class="nav-item"><i class="fas fa-user"></i><span>Profil</span></a>
</nav>

<script>
    function switchTab(tabName) {
        const tabs = document.querySelectorAll('.tab');
        const tabIndicator = document.querySelector('.tab-indicator');
        const tugasContent = document.getElementById('tugasContent');
        const kuisContent = document.getElementById('kuisContent');

        tabs.forEach(tab => tab.classList.remove('active'));
        const activeTab = document.querySelector(`.tab[onclick*="${tabName}"]`);
        if (activeTab) activeTab.classList.add('active');

        tugasContent.classList.remove('active');
        kuisContent.classList.remove('active');

        if (tabName === 'tugas') {
            tabIndicator.style.transform = 'translateX(0)';
            tugasContent.classList.add('active');
        } else {
            tabIndicator.style.transform = 'translateX(100%)';
            kuisContent.classList.add('active');
        }
    }

    function goBack() {
        window.history.back();
    }

    function refreshPage() {
        location.reload();
    }

    function startQuiz(id) {
        window.location.href = 'mulai-kuis.php?id=' + id;
    }
</script>
</body>
</html>
