-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2022 at 12:18 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(5) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `role`) VALUES
(1, 'admin@admin', '12345678', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(5) UNSIGNED NOT NULL,
  `no_kamar` int(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_kamar` varchar(100) NOT NULL,
  `status_kamar` enum('tidak terisi','terisi') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `no_kamar`, `gambar`, `deskripsi`, `harga_kamar`, `status_kamar`) VALUES
(13, 101, '1660591817_87ef3b8af9f7c5d30350.jpeg', '1 Kamar Mandi, 1 Dapur, 1 Kasur, 1 TV', '150000', 'terisi'),
(14, 102, '1660591843_a0e7f15f489c7783cdaa.jpeg', '1 Kamar Mandi, 1 Dapur, 1 Kasur, 1 TV', '150000', 'tidak terisi'),
(15, 103, '1660591878_01278f69520b4ff567d5.jpeg', '1 Kamar Mandi, 1 Dapur, 1 Kasur, 1 TV', '150000', 'tidak terisi'),
(16, 104, '1660591891_18200d90e32c36048cd8.jpeg', '1 Kamar Mandi, 1 Dapur, 1 Kasur, 1 TV', '150000', 'tidak terisi'),
(17, 105, '1660591906_4038149a508040426096.jpeg', '1 Kamar Mandi, 1 Dapur, 1 Kasur, 1 TV', '150000', 'tidak terisi');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(5) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `handphone` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2022-08-11-202721', 'App\\Database\\Migrations\\Admin', 'default', 'App', 1660251301, 1),
(2, '2022-08-11-202737', 'App\\Database\\Migrations\\Pengeluaran', 'default', 'App', 1660251301, 1),
(3, '2022-08-11-202745', 'App\\Database\\Migrations\\User', 'default', 'App', 1660251301, 1),
(4, '2022-08-11-202748', 'App\\Database\\Migrations\\Kamar', 'default', 'App', 1660251301, 1),
(5, '2022-08-11-202808', 'App\\Database\\Migrations\\Order', 'default', 'App', 1660251898, 2),
(6, '2022-08-11-202822', 'App\\Database\\Migrations\\Cicilan', 'default', 'App', 1660251898, 2),
(8, '2022-08-11-211133', 'App\\Database\\Migrations\\UpdateFieldCicilan', 'default', 'App', 1660252638, 3),
(9, '2022-08-11-210518', 'App\\Database\\Migrations\\Transaksi', 'default', 'App', 1660253231, 4),
(10, '2022-08-11-212733', 'App\\Database\\Migrations\\DeleteCicilTable', 'default', 'App', 1660253272, 5),
(11, '2022-08-12-050503', 'App\\Database\\Migrations\\AddAdminFieldROle', 'default', 'App', 1660280815, 6),
(12, '2022-08-12-050636', 'App\\Database\\Migrations\\AddUserFieldRole', 'default', 'App', 1660280815, 6),
(13, '2022-08-14-045058', 'App\\Database\\Migrations\\Pembayaran', 'default', 'App', 1660453025, 7),
(14, '2022-08-14-045742', 'App\\Database\\Migrations\\TransactionUpdateTable', 'default', 'App', 1660453304, 8),
(15, '2022-08-14-064210', 'App\\Database\\Migrations\\DeleteTablePembayaranAndTransaksi', 'default', 'App', 1660459379, 9),
(16, '2022-08-14-064425', 'App\\Database\\Migrations\\UpdateColumnOrderTable', 'default', 'App', 1660459677, 10),
(17, '2022-08-14-064914', 'App\\Database\\Migrations\\Pembayaran', 'default', 'App', 1660460784, 11),
(18, '2022-08-14-085845', 'App\\Database\\Migrations\\UpdateOrderTable', 'default', 'App', 1660467622, 12);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_kamar` int(100) UNSIGNED NOT NULL,
  `id_user` int(100) UNSIGNED NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `durasi_sewa` int(25) NOT NULL,
  `nominal_pembayaran` varchar(100) NOT NULL,
  `status_pembayaran` enum('belum bayar','lunas','menyicil','menunggu verifikasi') NOT NULL DEFAULT 'belum bayar',
  `terakhir_pembayaran` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(100) UNSIGNED NOT NULL,
  `id_order` int(100) UNSIGNED NOT NULL,
  `pembayaran` varchar(100) NOT NULL,
  `nama_pengirim` varchar(100) NOT NULL,
  `nomor_rekening` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(5) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `jenis_pengeluaran` enum('listrik','air','internet','kebersihan','lain-lain') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id_kamar_foreign` (`id_kamar`),
  ADD KEY `order_id_user_foreign` (`id_user`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembayaran_id_order_foreign` (`id_order`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_id_kamar_foreign` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `member` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_id_order_foreign` FOREIGN KEY (`id_order`) REFERENCES `order` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
