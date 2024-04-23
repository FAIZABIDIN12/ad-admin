-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 10:26 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('super_admin','admin','front_office') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(11) NOT NULL,
  `no_kamar` varchar(20) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `no_kamar`, `status`, `keterangan`) VALUES
(2, '001', 'Ready', 'djasdnjas'),
(3, '002', 'Ready', ''),
(4, '003', 'Ready', ''),
(5, '004', 'Ready', ''),
(7, '005', 'Ready', 'as'),
(8, '006', 'Ready', ''),
(9, '007', 'Ready', ''),
(10, '008', 'Ready', ''),
(11, '009', NULL, NULL),
(12, '010', 'Ready', ''),
(13, '011', NULL, NULL),
(14, '012', NULL, NULL),
(15, '013', NULL, NULL),
(16, '014', NULL, NULL),
(17, '015', NULL, NULL),
(18, '016', NULL, NULL),
(19, '017', NULL, NULL),
(20, '018', NULL, NULL),
(21, '019', NULL, NULL),
(22, '020', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kas`
--

CREATE TABLE `kas` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` enum('cr','db') DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kas`
--

INSERT INTO `kas` (`id`, `keterangan`, `tanggal`, `jenis`, `nominal`) VALUES
(7, 'fasfasaaaaaaaaaaaaaaa', '2024-04-23', 'cr', 3432),
(8, 'fasfasaaaaaaaaaaaaaaa', '2024-04-23', 'db', 343234534);

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `komplain` text NOT NULL,
  `status` enum('slesai','proses','no-action') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komplain`
--

INSERT INTO `komplain` (`id`, `nama`, `komplain`, `status`) VALUES
(13, 'afdsf', 'dsfsdfsd', 'no-action');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `tanggal_checkin` date DEFAULT NULL,
  `tanggal_checkout` date DEFAULT NULL,
  `jumlah_kamar` int(11) DEFAULT NULL,
  `jumlah_orang` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `status_pembayaran` varchar(20) DEFAULT NULL,
  `status_pemesanan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `tanggal_checkin`, `tanggal_checkout`, `jumlah_kamar`, `jumlah_orang`, `nama_pemesan`, `no_hp`, `status_pembayaran`, `status_pemesanan`) VALUES
(7, '2024-04-20', '2024-05-04', 33, 2, 'rosyad', '81918582908', 'belum lunas', 'BATAL'),
(8, '2024-04-19', '2024-04-22', 1, 2, 'rosyadaaa', '81918582908', 'lunas', 'DONE'),
(9, '2024-04-22', '2024-04-23', 2, 2, 'rosyad', '081918582908', 'lunas', 'BOOKING'),
(10, '2024-04-23', '2024-04-24', 2, 2, 'rosyad', '081918582908', 'lunas', 'BOOKING');

-- --------------------------------------------------------

--
-- Table structure for table `reservasi`
--

CREATE TABLE `reservasi` (
  `id_reservasi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `jumlah_kamar` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `tgl_reservasi` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_order` enum('done','checkin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `nama`, `jumlah_orang`, `jumlah_kamar`, `id_kamar`, `harga`, `checkin`, `checkout`, `tgl_reservasi`, `status_order`) VALUES
(47, 'sadas', 2, 2, 2, 3, '2024-04-22', '2024-04-22', '2024-04-22 08:05:15', 'done'),
(49, 'asdasf', 2, 3, 2, 343, '2024-04-22', '2024-04-22', '2024-04-22 08:16:18', 'done'),
(50, 'asfasf', 3, 3, 2, 3, '2024-04-22', '2024-04-22', '2024-04-22 08:18:23', 'done'),
(51, 'dian', 3, 2, 2, 400000, '2024-04-23', '2024-04-23', '2024-04-23 06:01:58', 'done'),
(52, 'dian', 3, 2, 2, 400000, '2024-04-23', '2024-04-23', '2024-04-23 06:22:20', 'done'),
(53, 'fsdfsdfsd', 3, 2, 2, 3, '2024-04-23', '2024-04-23', '2024-04-23 06:43:33', 'done'),
(54, 'fsdfsdfsd', 3, 2, 2, 3, '2024-04-23', '2024-04-23', '2024-04-23 07:47:25', 'done');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `kas`
--
ALTER TABLE `kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`),
  ADD KEY `id_kamar` (`id_kamar`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `kas`
--
ALTER TABLE `kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `komplain`
--
ALTER TABLE `komplain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
