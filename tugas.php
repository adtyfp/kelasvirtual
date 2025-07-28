<?php
session_start(); // Memulai session

// Cek apakah user sudah login (opsional, tergantung kebutuhan)
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login atau tampilkan pesan
    header("Location: login.php");
    exit();
}
// koneksi
$koneksi = new mysqli("localhost", "root", "", "apkkelasvirtual");

$tugas = [];
$kuis = [];

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
        background-color: #3d7bff;
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
        color: #ffc400;
    }

    .tab-indicator {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 3px;
        width: 50%;
        background-color: #ffc400;
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

    .task-progress {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        padding: 15px;
        margin-bottom: 15px;
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .progress-label {
        font-size: 16px;
        font-weight: 500;
        color: #333;
    }

    .progress-value {
        font-size: 15px;
        font-weight: 600;
        color: #4CAF50;
    }

    .progress-bar {
        background-color: #f0f0f0;
        border-radius: 8px;
        height: 12px;
        width: 100%;
        overflow: hidden;
    }

    .progress {
        background: linear-gradient(90deg, #4CAF50, #81C784);
        height: 100%;
        border-radius: 8px;
        transition: width 0.3s ease;
    }

    .status-container {
    position: absolute;
    top: 15px;
    right: 15px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    z-index: 2;
}
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        font-size: 12px;
        font-weight: 500;
        padding: 3px 8px;
        border-radius: 12px;
    }
/* Late tag styling */
    .late-tag {
        background-color: #FFEBEE;
        color: #C62828;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
    }

    .late-tag i {
        margin-right: 5px;
        font-size: 10px;
    }

    .status-badge.belum {
        background-color: #ffeeee;
        color: #f44336;
    }

    .status-badge.selesai {
        background-color: #eeffee;
        color: #4caf50;
    }

    .submit-btn {
        display: inline-block;
        padding: 8px 16px;
        background-color: #ffc400;
        color: white;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 15px;
        width: 100%;
    }

    .submit-btn:hover {
        background-color: #d6962a;
        transform: translateY(-2px);
    }

    .submit-btn:disabled,
    .btn-submitted {
        background-color: #9e9e9e !important;
        cursor: not-allowed;
        opacity: 0.8;
    }

    .submit-btn:disabled:hover,
    .btn-submitted:hover {
        background-color: #9e9e9e !important;
        transform: none;
    }

    .due-date {
        display: flex;
        align-items: center;
        margin-top: 10px;
        font-size: 12px;
        color: #7f8c8d;
        padding: 8px 0;
        justify-content: center;
        border-top: 1px solid #f0f0f0;
    }

    .due-date i {
        margin-right: 5px;
        color: #000;
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
        padding: 3px 8px;
        border-radius: 12px;
    }

    .quiz-status-badge.belum {
        background-color: #ffeeee;
        color: #f44336;
    }

    .quiz-status-badge.selesai {
        background-color: #eeffee;
        color: #4caf50;
    }

    .quiz-duration {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #7f8c8d;
    }

    .quiz-duration i {
        margin-right: 5px;
        color: #000;
    }

    .bottom-nav {
        position: fixed;
        bottom: 15px;
        left: 0;
        right: 0;
        width: calc(100% - 30px);
        margin: 0 auto;
        height: 63px;
        background: white;
        display: flex;
        justify-content: space-around;
        align-items: center;
        z-index: 1000;
        border-radius: 15px;
        box-shadow: 0 -2px 20px rgba(0, 0, 0, 0.1);
        padding: 0 15px;
    }

    .bottom-nav .nav-item {
        flex: 0 1 auto;
        text-align: center;
        color: #515151;
        font-size: 11px;
        text-decoration: none;
        position: relative;
        padding-top: 3px;
        min-width: 50px;
    }

    .bottom-nav .nav-item:nth-child(2) {
        margin-right: 35px;
    }

    .bottom-nav .nav-item:nth-child(4) {
        margin-left: 35px;
    }

    .bottom-nav .nav-item i {
        font-size: 16px;
        display: block;
        margin-bottom: 2px;
    }

    .bottom-nav .nav-item.active,
    .bottom-nav .nav-item.active i {
        color: #ffc400;
        font-weight: 600;
    }

    .nav-logo-wrapper {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        background: transparent;
        width: 85px;
        height: 50px;
        border-radius: 18%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 1001;
    }

    .nav-logo-wrapper .nav-logo {
        display: block;
        width: 80px;
        height: 45px;
        background: white;
        border-radius: 18%;
        padding: 8px;
        overflow: hidden;
    }

    .nav-logo-wrapper .nav-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Animations */
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

    /* New styles for late submission */
    .late-badge {
        background-color: #fff3e0;
        color: #e65100;
        padding: 3px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
        margin-left: 10px;
        display: inline-flex;
        align-items: center;
    }

    .late-badge i {
        margin-right: 3px;
    }
</style>
</head>
<body>

<div class="header">
    <div class="header-title">Tugas</div>
    <div class="header-icon" onclick="window.location.href='riwayat_tugas.php'" title="Riwayat Tugas">
            <i class="fas fa-history"></i>
        </div>
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
