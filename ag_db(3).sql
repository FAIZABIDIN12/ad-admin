-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2024 at 09:00 AM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ag_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `checkin` datetime NOT NULL,
  `checkout` datetime DEFAULT NULL,
  `checkout_plan` datetime DEFAULT NULL,
  `jml_orang` int NOT NULL,
  `id_room` int UNSIGNED NOT NULL,
  `rate` int NOT NULL,
  `bayar` int NOT NULL,
  `metode_bayar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `status_order` enum('checkin','done') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'checkin',
  `front_office` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `nama`, `no_hp`, `checkin`, `checkout`, `checkout_plan`, `jml_orang`, `id_room`, `rate`, `bayar`, `metode_bayar`, `keterangan`, `status_order`, `front_office`) VALUES
(2, 'Faiz Suherman', '08923801212', '2024-04-30 00:00:00', '2024-04-30 00:00:00', '2024-05-01 00:00:00', 0, 5, 100000, 100000, 'cash', '', 'done', 1),
(3, 'Agung Suhaili', '082123123123', '2024-04-30 00:00:00', '2024-04-30 00:00:00', '2024-05-02 00:00:00', 2, 5, 111111, 11111, 'transfer', '', 'done', 1),
(4, 'faiz kurohap', '0851233', '2024-04-30 00:00:00', '2024-04-30 00:00:00', '2024-05-01 00:00:00', 1, 6, 150000, 20000, 'transfer', '', 'done', 1),
(5, 'Fayz', '0821565', '2024-05-02 00:00:00', '2024-05-02 00:00:00', '2024-05-03 00:00:00', 2, 11, 1500000, 1500000, 'cash', '', 'done', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(9, '2024-04-30-020300', 'App\\Database\\Migrations\\User', 'default', 'App', 1714447982, 1),
(10, '2024-04-30-020315', 'App\\Database\\Migrations\\Room', 'default', 'App', 1714447982, 1),
(11, '2024-04-30-021307', 'App\\Database\\Migrations\\Reservation', 'default', 'App', 1714447982, 1),
(12, '2024-04-30-021321', 'App\\Database\\Migrations\\Checkin', 'default', 'App', 1714447982, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int UNSIGNED NOT NULL,
  `tgl` datetime NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_checkin` datetime NOT NULL,
  `tgl_checkout` datetime NOT NULL,
  `jml_orang` int NOT NULL,
  `jml_kamar` int NOT NULL,
  `rate` int NOT NULL,
  `bayar` int NOT NULL,
  `kurang_bayar` int NOT NULL,
  `metode_bayar` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `status_bayar` enum('lunas','belum_lunas') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'belum_lunas',
  `status_order` enum('book','cancel','checkin','done') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'book',
  `front_office` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `tgl`, `nama`, `no_hp`, `tgl_checkin`, `tgl_checkout`, `jml_orang`, `jml_kamar`, `rate`, `bayar`, `kurang_bayar`, `metode_bayar`, `keterangan`, `status_bayar`, `status_order`, `front_office`) VALUES
(1, '2024-04-30 07:18:28', 'faiz kurohap', '', '2024-05-01 00:00:00', '2024-05-02 00:00:00', 2, 1, 100000, 100000, 0, 'cash', '', 'belum_lunas', 'book', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int UNSIGNED NOT NULL,
  `no_kamar` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `no_kamar`, `status`, `keterangan`) VALUES
(5, '001', NULL, NULL),
(6, '002', NULL, NULL),
(7, '003', NULL, NULL),
(8, '004', NULL, NULL),
(9, '005', NULL, NULL),
(10, '006', NULL, NULL),
(11, '007', NULL, NULL),
(12, '008', NULL, NULL),
(13, '009', NULL, NULL),
(14, '010', NULL, NULL),
(15, '011', NULL, NULL),
(16, '012', NULL, NULL),
(17, '013', NULL, NULL),
(18, '014', NULL, NULL),
(19, '015', NULL, NULL),
(20, '016', NULL, NULL),
(21, '017', NULL, NULL),
(22, '018', NULL, NULL),
(23, '019', NULL, NULL),
(24, '020', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('super_admin','admin','front_office','accounting') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'front_office'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(1, 'rosyad', 'rosyad', '$2y$10$oGwtiL6Vbq0uCODgp16Ky.EtbpExX2Xj0lUqNlxKiuE4JkPBUf6Ka', 'super_admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkin_id_room_foreign` (`id_room`),
  ADD KEY `checkin_front_office_foreign` (`front_office`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_front_office_foreign` (`front_office`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_kamar` (`no_kamar`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `checkin_front_office_foreign` FOREIGN KEY (`front_office`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `checkin_id_room_foreign` FOREIGN KEY (`id_room`) REFERENCES `room` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_front_office_foreign` FOREIGN KEY (`front_office`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
