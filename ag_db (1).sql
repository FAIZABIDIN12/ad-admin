-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 08:41 AM
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
(2, '123', 'ready', 'tess'),
(3, '345', '', ''),
(4, '344', '', ''),
(5, '543', '', ''),
(7, '77777', NULL, NULL);

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
(7, '2024-04-20', '2024-05-04', 1, 2, 'rosyad', '81918582908', 'belum lunas', 'BOOKING'),
(8, '2024-04-19', '2024-04-22', 1, 2, 'rosyad', '81918582908', 'lunas', 'DONE');

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
  `harga` decimal(10,2) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `tgl_reservasi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservasi`
--

INSERT INTO `reservasi` (`id_reservasi`, `nama`, `jumlah_orang`, `jumlah_kamar`, `id_kamar`, `harga`, `checkin`, `checkout`, `tgl_reservasi`) VALUES
(32, 'faiz abidin', 32, 2, 0, 233.00, '0000-00-00', '0000-00-00', '2024-04-17 08:13:53'),
(33, 'faiz abidin', 32, 2, 0, 233.00, '0000-00-00', '0000-00-00', '2024-04-18 03:22:15'),
(34, 'faiz abidin', 32, 2, 0, 233.00, '0000-00-00', '0000-00-00', '2024-04-18 03:26:20'),
(35, 'faiz abidin', 32, 2, 0, 233.00, '0000-00-00', '0000-00-00', '2024-04-18 07:34:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`);

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
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
