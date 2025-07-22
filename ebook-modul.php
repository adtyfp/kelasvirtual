<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Book & Modul</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
            * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #F9E9F7;
            color: #333;
        }

        .header {
            background-color: #3d7bff;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            flex-grow: 1;
        }

        .back-button,
        .search-icon {
            color: white;
            font-size: 20px;
        }

        .container {
            max-width: 450px;
            margin: 0 auto;
            padding: 20px 15px;
        }

        .pricing-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .thumbnail {
            background-color: #D9D9D9;
            height: 120px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-placeholder {
            position: absolute;
            font-weight: 500;
            color: #555;
            z-index: 1;
        }

        .card-content {
            padding: 15px;
        }

        .package-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #514F4F;
        }

        .features-list {
            list-style: none;
            margin-bottom: 15px;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }

        .feature-icon {
            margin-right: 10px;
            color: #4CAF50;
        }

        .bonus-icon {
            color: #FF5722;
            margin-right: 10px;
        }

        .price-action-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .price-amount {
            font-size: 18px;
            font-weight: 700;
            color: #D13704;
        }

        .buy-button {
            padding: 10px 30px;
            background-color: #3d7bff;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .buy-button:hover {
            background-color:rgb(36, 72, 151);
        }
  </style>
</head>

<body>
  <header class="header">
    <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i></a>
    <h1 class="header-title">E-Book & Modul</h1>
    <i class="fas fa-search search-icon"></i>
  </header>

  <main class="container">

    <!-- E-Book Tematik -->
    <div class="product-card">
      <div class="thumbnail">
        <img src="https://via.placeholder.com/450x120" alt="Desain Grafis Dasar">
        <div class="thumbnail-placeholder">Thumbnail Produk</div>
      </div>
      <div class="card-content">
        <h2 class="product-title">E-Book Tematik</h2>
        <ul class="features-list">
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Format PDF</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Topik: Desain, Public Speaking,
            Leadership, Produktivitas, dll</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Dilengkapi ilustrasi dan tips praktis
          </li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Cocok untuk belajar cepat dan ringkas
          </li>
        </ul>
        <div class="price-action-container">
          <div>
            <div class="price-label">Mulai dari</div>
            <div class="price-amount">Rp600.000</div>
          </div>
          <a href="metode-pembayaran.php?paket=tematik" class="buy-button">Beli</a>
        </div>
      </div>
    </div>

    <!-- Modul Lengkap Kursus -->
    <div class="product-card">
      <div class="thumbnail">
        <img src="https://via.placeholder.com/450x120" alt="Desain Grafis Dasar">
        <div class="thumbnail-placeholder">Thumbnail Produk</div>
      </div>
      <div class="card-content">
        <h2 class="product-title">Modul Lengkap Kursus</h2>
        <ul class="features-list">
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Materi terstruktur sesuai kurikulum
            kursus</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Ada latihan soal, tugas praktik, dan
            pembahasan</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Disusun oleh mentor profesional</li>
          <li class="feature-item"><i class="fas fa-check-circle feature-icon"></i>Dapat sertifikat mandiri setelah
            menyelesaikan modul & ujian online</li>
        </ul>
        <div class="price-action-container">
          <div>
            <div class="price-label">Mulai dari</div>
            <div class="price-amount">Rp600.000</div>
          </div>
          <a href="metode-pembayaran.php?paket=kursus" class="buy-button">Beli</a>
        </div>
      </div>
    </div>

  </main>
</body>

</html>
