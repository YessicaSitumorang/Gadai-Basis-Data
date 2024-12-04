-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2024 at 01:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `senyum_sukacita`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_produk` int NOT NULL,
  `rincian_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_barang` enum('Kendaraan','Elektronik') COLLATE utf8mb4_general_ci NOT NULL,
  `taksiran` int NOT NULL,
  `label_barang` enum('Gadai','Lelang') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_produk`, `rincian_barang`, `jenis_barang`, `taksiran`, `label_barang`) VALUES
(1, 'Laptop Lenovo Legion 5i, 512GB SSD, RAM 16GB', 'Elektronik', 16000000, 'Lelang'),
(2, 'iPhone 11, 128GB', 'Elektronik', 8000000, 'Gadai'),
(3, 'iPad Pro M2 Chip (2022), 256GB', 'Elektronik', 14000000, 'Gadai'),
(4, 'Macbook Air 2022 M2 8/512GB Space Gray', 'Elektronik', 20000000, 'Gadai'),
(5, 'iPad mini 6 Wifi Only, 256GB Pink', 'Elektronik', 8000000, 'Gadai'),
(7, 'KULKAS 2 PINTU HITACHI 225LT HRTN5255MFXID', 'Elektronik', 18000000, 'Gadai'),
(22, ' LG GN-B222SQIB Kulkas 2 Pintu 225L Smart Inverter', 'Elektronik', 5200000, 'Gadai'),
(23, 'Honda Vario 125', 'Kendaraan', 23000000, 'Gadai');

-- --------------------------------------------------------

--
-- Table structure for table `detail_data_karyawan`
--

CREATE TABLE `detail_data_karyawan` (
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_data_karyawan`
--

INSERT INTO `detail_data_karyawan` (`nama`, `password`, `nik`, `alamat`, `jenis_kelamin`) VALUES
('Agung Rotama Sibarani', 'agung', '1211031709930004', 'Jl. Kopiraya V, Medan Tuntungan', 'Laki-laki'),
('Mariani', 'mariani', '1271016108710002', 'Jl. Ayahanda No.132, Sei Putih', 'Perempuan'),
('Simon Juanda PN. Simarmata', 'simon', '1271040201890007', 'Jl. Menteng  II GG Jermal II No.14, Medan Denai', 'Laki-laki');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_pegawai` int NOT NULL,
  `no_hp` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `gaji` int NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_pegawai`, `no_hp`, `gaji`, `nik`) VALUES
(19001, '082351929399', 3000000, '1271016108710002'),
(19002, '082356478965', 3000000, '1271040201890007'),
(19003, '089349672345', 3000000, '1211031709930004');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli_lelang`
--

CREATE TABLE `pembeli_lelang` (
  `id_pembeli` int NOT NULL,
  `id_produk` int NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(14) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli_lelang`
--

INSERT INTO `pembeli_lelang` (`id_pembeli`, `id_produk`, `nik`, `no_hp`, `nama`) VALUES
(1, 1, '1212024804030001', '0822772768998', 'P DIDDIY');

-- --------------------------------------------------------

--
-- Table structure for table `penggadai`
--

CREATE TABLE `penggadai` (
  `id_penggadai` int NOT NULL,
  `id_produk` int NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(14) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `no_kwitansi` int NOT NULL,
  `jlh_pinjaman` int NOT NULL,
  `tgl_jatuh_tempo` date NOT NULL,
  `id_produk` int NOT NULL,
  `id_pegawai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `detail_data_karyawan`
--
ALTER TABLE `detail_data_karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `pembeli_lelang`
--
ALTER TABLE `pembeli_lelang`
  ADD PRIMARY KEY (`id_pembeli`),
  ADD UNIQUE KEY `nomor` (`id_produk`);

--
-- Indexes for table `penggadai`
--
ALTER TABLE `penggadai`
  ADD PRIMARY KEY (`nik`),
  ADD UNIQUE KEY `nomor` (`id_produk`),
  ADD KEY `index` (`id_penggadai`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`no_kwitansi`),
  ADD KEY `id_produk` (`id_produk`) USING BTREE,
  ADD KEY `id_pegawai` (`id_pegawai`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19004;

--
-- AUTO_INCREMENT for table `pembeli_lelang`
--
ALTER TABLE `pembeli_lelang`
  MODIFY `id_pembeli` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penggadai`
--
ALTER TABLE `penggadai`
  MODIFY `id_penggadai` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `no_kwitansi` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `detail_data_karyawan` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembeli_lelang`
--
ALTER TABLE `pembeli_lelang`
  ADD CONSTRAINT `pembeli_lelang_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `barang` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penggadai`
--
ALTER TABLE `penggadai`
  ADD CONSTRAINT `penggadai_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `barang` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `barang` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `karyawan` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
