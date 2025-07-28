<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil Dosen</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
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

    .header-icon {
      font-size: 20px;
    }

    .header-icon a {
      color: white;
      text-decoration: none;
    }

    .header-title {
      font-weight: 700;
      font-size: 20px;
      flex-grow: 1;
      text-align: center;
      margin-right: 20px;
    }

    .container {
      padding: 16px;
    }

    .card {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      padding: 20px;
      margin-bottom: 20px;
      text-align: center;
    }

    .card img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 12px;
    }

    .card h3 {
      font-size: 16px;
      margin: 0;
    }

    .card p {
      margin: 4px 0;
      font-size: 14px;
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
      margin-bottom: 6px;
      color: #333;
    }

    .section p {
      font-size: 14px;
      text-align: justify;
      color: #444;
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
  color: #444;
  margin-bottom: 6px;
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
      <img src="asset/image.png" alt="Foto Dosen">
      <h3>Andrias Darmayadi, S.IP, M.Si, Ph.D</h3>
      <p><strong>NIDN:</strong> 0406087702</p>
      <p><strong>Pendidikan:</strong> </p>
      <p><strong>Tanggal Lahir:</strong>- </p>
      <p><strong>Jabatan Fungsional:</strong> Dosen Pembimbing</p>
      <p><strong>Bidang Pendidikan:</strong> Humbungan Internasional</p>
    </div>

    <!-- Latar Belakang -->
    <div class="section">
      <h3>Latar Belakang</h3>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </p>
    </div>

<!-- Prestasi -->
<div class="section">
  <h3>Prestasi</h3>

  <div class="achievement-card">
    <img src="asset/sukmalindo.jpg" alt="Sukmalindo 2019">
    <div class="achievement-content">
      <h4>Sukmalindo 2019</h4>
      <p>Juara 1 & Juara 2 - Kategori Beregu Campuran & Ganda Putra</p>
      <div class="badges">
        <span class="badge blue">Internasional</span>
        <span class="badge gray">Uncategorized</span>
        <span class="badge green">2019</span>
      </div>
    </div>
  </div>

  <div class="achievement-card">
    <img src="asset/asean.jpg" alt="ASEAN University Games 2018">
    <div class="achievement-content">
      <h4>ASEAN University Games 2018</h4>
      <p>Juara 3 - Kategori Beregu Putra</p>
      <div class="badges">
        <span class="badge blue">Internasional</span>
        <span class="badge gray">Uncategorized</span>
        <span class="badge green">2018</span>
      </div>
    </div>
  </div>

  <div class="achievement-card">
    <img src="asset/pencak1.jpg" alt="Pencak Silat PPS 2018">
    <div class="achievement-content">
      <h4>Pencak Silat Terbuka PPS Pakubumi Cup IV 2018</h4>
      <p>Juara III Tanding Kelas H Putra - Kategori Tanding Kelas H Putra - Perorangan</p>
      <div class="badges">
        <span class="badge blue">Internasional</span>
        <span class="badge gray">Uncategorized</span>
        <span class="badge green">2018</span>
      </div>
    </div>
  </div>

  <div class="achievement-card">
    <img src="asset/pencak2.jpg" alt="Pencak Silat PPS 2018">
    <div class="achievement-content">
      <h4>Pencak Silat Terbuka PPS Pakubumi Cup IV 2018</h4>
      <p>Juara I Seni Tunggal Dewasa Putri - Kategori Tunggal Dewasa Putri - Perorangan</p>
      <div class="badges">
        <span class="badge blue">Internasional</span>
        <span class="badge gray">Uncategorized</span>
        <span class="badge green">2018</span>
      </div>
    </div>
  </div>
</div>


  </div>

</body>
</html>
