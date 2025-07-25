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
      <img src="asset/Desain tanpa judul.png" alt="Foto Dosen">
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
      <p>Belum ada data prestasi yang ditampilkan.</p>
    </div>

  </div>

</body>
</html>
