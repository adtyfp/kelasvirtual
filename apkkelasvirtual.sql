-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2025 at 06:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apkkelasvirtual`
--

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `id` int NOT NULL,
  `nama_folder` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`id`, `nama_folder`, `tanggal`, `created_at`) VALUES
(33, 'Hubungan Internasional', NULL, '2025-07-14 17:51:55'),
(34, 'Ekonomi Politik Internasional ', NULL, '2025-07-15 13:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `durasi` int NOT NULL,
  `deskripsi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`id`, `judul`, `durasi`, `deskripsi`, `created_at`) VALUES
(3, 'Kuis online', 30, 'kerjakan lah', '2025-07-12 04:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int NOT NULL,
  `folder_id` int DEFAULT NULL,
  `nama_materi` varchar(255) DEFAULT NULL,
  `nama_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `is_bookmarked` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `folder_id`, `nama_materi`, `nama_file`, `created_at`, `is_bookmarked`) VALUES
(13, 33, 'Sejarah Ekonomi Internasional', '6874e2e67d67c.jpeg', '2025-07-14 17:58:46', 0),
(14, 33, 'Informasi Hubungan Internasional', '6875d20b20fdd.png', '2025-07-15 10:59:07', 0),
(15, 33, 'Sejarah Ekonomi Internasional', '6875d2af911b2.png', '2025-07-15 11:01:51', 1),
(16, 34, 'Bagaimana kondisi ekonomi internasional ', '6875f1ef56588.jpg', '2025-07-15 13:15:11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `isi_pesan` text,
  `jenis_pesan` enum('text','image','audio') DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `tipe` enum('pesan','pengumuman') NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `user_id`, `judul`, `isi`, `tipe`, `is_read`, `created_at`, `gambar`) VALUES
(1, NULL, 'Jadwal Maintenance Sistem', 'Kami akan melakukan maintenance server pada hari Minggu, 20 Juli 2025 pukul 01.00–03.00 WIB. Selama waktu tersebut, sistem tidak dapat diakses.', 'pengumuman', 0, '2025-07-15 14:55:16', NULL),
(2, NULL, 'Peluncuran Fitur Baru', 'Kami telah menambahkan fitur \"Forum Diskusi\" di setiap kursus. Silakan gunakan untuk berbagi dan bertanya dengan sesama peserta.', 'pengumuman', 0, '2025-07-15 14:55:16', NULL),
(3, NULL, 'Diskon Akhir Tahun', 'Dapatkan diskon hingga 30% untuk semua kelas individu mulai tanggal 20–31 Desember 2025. Jangan lewatkan!', 'pengumuman', 0, '2025-07-15 14:55:16', NULL),
(4, 7, 'Pembayaran Berhasil', 'Pembayaran Anda untuk paket \"Langganan Bulanan - Premium\" telah kami terima. Selamat belajar!', 'pesan', 0, '2025-07-15 14:55:31', NULL),
(5, 7, 'Sertifikat Siap Diunduh', 'Sertifikat untuk kelas \"Public Speaking & Komunikasi\" sudah tersedia di halaman profil Anda.', 'pesan', 0, '2025-07-15 14:55:31', NULL),
(6, 7, 'Penjadwalan Ulang Webinar', 'Webinar yang semula dijadwalkan tanggal 18 Juli telah dipindahkan ke 20 Juli 2025 pukul 19.00 WIB.', 'pesan', 0, '2025-07-15 14:55:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `score` int NOT NULL,
  `correct_answers` int NOT NULL,
  `total_questions` int NOT NULL,
  `time_spent` float NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `user_id`, `score`, `correct_answers`, `total_questions`, `time_spent`, `created_at`) VALUES
(1, 1, 114, 4, 5, 90, '2025-07-17 05:04:18'),
(2, 1, 167, 5, 5, 2, '2025-07-17 05:06:31'),
(3, 1, 129, 4, 5, 3, '2025-07-17 05:07:29'),
(4, 1, 155, 5, 5, 77, '2025-07-17 05:37:28'),
(5, 1, 119, 4, 5, 7, '2025-07-17 05:39:17'),
(6, 1, 124, 4, 5, 8, '2025-07-17 05:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_pembayaran`
--

CREATE TABLE `transaksi_pembayaran` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `produk` varchar(100) DEFAULT NULL,
  `paket_tier` varchar(50) DEFAULT NULL,
  `id_transaksi` varchar(50) DEFAULT NULL,
  `no_seri_produk` varchar(50) DEFAULT NULL,
  `total_harga` int DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_pembayaran`
--

INSERT INTO `transaksi_pembayaran` (`id`, `user_id`, `produk`, `paket_tier`, `id_transaksi`, `no_seri_produk`, `total_harga`, `metode_pembayaran`, `created_at`) VALUES
(25, 1, 'Langganan Bulanan Kelas Virtual', 'Regular', 'TRX202507150558542019', 'NS77AE470E07', 150000, 'Dana', '2025-07-15 12:58:54'),
(26, 1, 'Langganan Tahunan Kelas Virtual', 'Elite', 'TRX202507150559147553', 'NSA8C7877346', 1499000, 'OVO', '2025-07-15 12:59:14'),
(27, 1, 'Kelas Individu - Desain Grafis Dasar', 'Desain Grafis Dasar', 'TRX202507150559297926', 'NSC123D90AF9', 600000, 'Dana', '2025-07-15 12:59:29'),
(28, 1, 'Kelas Individu - Public Speaking', 'Public Speaking & Komunikasi', 'TRX202507150559462232', 'NSC0FDBB9764', 750000, 'Dana', '2025-07-15 12:59:46'),
(29, 1, 'Langganan Bulanan Kelas Virtual', 'Premium', 'TRX202507150615404101', 'NS0DCD69FD6F', 199000, 'Dana', '2025-07-15 13:15:40'),
(30, 1, 'E-Book - Ebook Tematik', 'E-Book Tematik', 'TRX202507150727072364', 'NS3011B3A9D0', 600000, 'Indomart', '2025-07-15 14:27:07'),
(31, 1, 'E-Book - Tematik', 'E-Book Tematik', 'TRX202507150728282465', 'NS2742C72F00', 600000, 'Dana', '2025-07-15 14:28:28'),
(32, 1, 'Modul - Kursus', 'Modul Lengkap Kursus', 'TRX202507150728407110', 'NS539E24DECC', 600000, 'LinkAja', '2025-07-15 14:28:40'),
(33, 1, 'Mini -Workshop', 'Mini Workshop', 'TRX202507150744439875', 'NSCB6D39A649', 60000, 'Dana', '2025-07-15 14:44:43'),
(34, 1, 'Webinar -Umum', 'Webinar Umum', 'TRX202507150745096981', 'NS56728C2AE1', 80000, 'OVO', '2025-07-15 14:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id` int NOT NULL,
  `nama_tugas` varchar(255) DEFAULT NULL,
  `mata_kuliah` varchar(100) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_uploaded` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id`, `nama_tugas`, `mata_kuliah`, `deadline`, `file`, `created_at`, `is_uploaded`) VALUES
(3, 'sosiologi', 'sad', '2025-07-10', NULL, '2025-07-14 06:59:19', 0),
(9, 'kelas visual', 'Ekonomi Politik', '2025-07-17', '68786c548725f_materi_6874c85cd7a66.png', '2025-07-17 03:21:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tugashome`
--

CREATE TABLE `tugashome` (
  `id` int NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `deskripsi` text,
  `deadline` datetime NOT NULL,
  `mata_kuliah` varchar(100) DEFAULT NULL,
  `dibuat_oleh` int DEFAULT NULL,
  `dibuat_pada` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_uploaded` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tugashome`
--

INSERT INTO `tugashome` (`id`, `nama_tugas`, `deskripsi`, `deadline`, `mata_kuliah`, `dibuat_oleh`, `dibuat_pada`, `is_uploaded`) VALUES
(1, 'Tugas 1 - HTML Dasar', 'Buat halaman profil pribadi dengan HTML.', '2025-07-20 23:59:00', 'Web Programming', 1, '2025-07-14 06:38:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nim` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nim`, `note`, `password`, `profile_picture`) VALUES
(1, 'Maya', 'Adtyfp123@gmail.com', '1234567890', 'semoga sukses\r\n', '$2y$10$AY9vFZW6Ug8N/iZAc3mf0.CztAF6K5itp1mJF9/BXX/sKflS0O8rW', '68786c9dba1c1_WhatsApp Image 2025-04-18 at 09.47.05_631e326a copy.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_transaksi` (`id_transaksi`),
  ADD UNIQUE KEY `no_seri_produk` (`no_seri_produk`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugashome`
--
ALTER TABLE `tugashome`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tugashome`
--
ALTER TABLE `tugashome`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
