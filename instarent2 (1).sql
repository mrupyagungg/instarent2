-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 09:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instarent2`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama_akun` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kategori` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `posisi_d_c` enum('d','k') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `saldo_awal` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama_akun`, `kategori`, `posisi_d_c`, `saldo_awal`) VALUES
(101, 'Kas', 'Harta', 'd', 0),
(102, 'Bank', 'Aktiva', 'd', 0),
(103, 'Peralatan', 'Aktiva', 'd', 0),
(104, 'Perlengkapan', 'Aktiva', 'd', 0),
(401, 'Pendapatan Sewa', 'Pendapatan', '', 0),
(402, 'Pendapatan Lain-lain', '', '', 0),
(501, 'Beban Pengiriman', 'Beban', 'd', 0),
(502, 'Beban Listrik', 'Beban', 'd', 0),
(503, 'Beban Air', 'Beban', 'd', 0),
(504, 'Beban Utilitas', 'beban', 'd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengeluaran`
--

CREATE TABLE `jenis_pengeluaran` (
  `id_jenis_pengeluaran` varchar(20) NOT NULL,
  `nama_jenis_pengeluaran` varchar(64) NOT NULL,
  `id_akun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_pengeluaran`
--

INSERT INTO `jenis_pengeluaran` (`id_jenis_pengeluaran`, `nama_jenis_pengeluaran`, `id_akun`) VALUES
('JPN-002', 'gaji', 501),
('JPN-003', 'listrik', 502),
('JPN-004', 'Beban Utilitas', 504),
('JPN-005', 'Beban Kasir', 501);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `posisi` enum('d','k') NOT NULL,
  `reff` varchar(20) NOT NULL,
  `transaksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id`, `tanggal`, `id_akun`, `nominal`, `posisi`, `reff`, `transaksi`) VALUES
(1, '2024-08-26', 101, 100000, 'd', 'PMS-001', 'Kas'),
(2, '2024-08-26', 401, 100000, 'k', 'PMS-001', 'Pendapatan Sewa'),
(3, '2024-08-26', 502, 50000, 'd', 'PNG-001', 'Beban Listrik'),
(4, '2024-08-26', 101, 50000, 'k', 'PNG-001', 'Kas'),
(7, '2024-09-10', 101, 400000, 'd', 'PMS-002', 'Kas'),
(8, '2024-09-10', 401, 400000, 'k', 'PMS-002', 'Pendapatan Sewa'),
(9, '2024-09-10', 503, 100000, 'd', 'PNG-002', 'Beban Air'),
(10, '2024-09-10', 101, 100000, 'k', 'PNG-002', 'Kas'),
(13, '2024-09-13', 101, 200000, 'd', 'PMS-003', 'Kas'),
(14, '2024-09-13', 401, 200000, 'k', 'PMS-003', 'Pendapatan Sewa'),
(15, '2024-09-13', 502, 250000, 'd', 'PNG-003', 'Beban Listrik'),
(16, '2024-09-13', 101, 250000, 'k', 'PNG-003', 'Kas'),
(17, '2024-09-13', 101, 600000, 'd', 'PMS-004', 'Kas'),
(18, '2024-09-13', 401, 600000, 'k', 'PMS-004', 'Pendapatan Sewa'),
(19, '2024-09-13', 502, 50000, 'd', 'PNG-004', 'Beban Listrik'),
(20, '2024-09-13', 101, 50000, 'k', 'PNG-004', 'Kas'),
(27, '2024-09-14', 501, 1000000, 'd', 'PNG-003', 'Beban Pengiriman'),
(28, '2024-09-14', 101, 1000000, 'k', 'PNG-003', 'Kas'),
(29, '2024-09-14', 101, 1000000, 'd', 'PMS-005', 'Kas'),
(30, '2024-09-14', 401, 1000000, 'k', 'PMS-005', 'Pendapatan Sewa'),
(31, '2024-09-15', 101, 1000000, 'd', 'PMS-006', 'Kas'),
(32, '2024-09-15', 401, 1000000, 'k', 'PMS-006', 'Pendapatan Sewa'),
(34, '2024-09-15', 101, 2500000, 'k', 'PNG-004', 'Kas'),
(35, '2024-09-15', 504, 2400000, 'd', 'PNG-005', 'Beban Utilitas'),
(36, '2024-09-15', 101, 2400000, 'k', 'PNG-005', 'Kas'),
(37, '2025-01-15', 101, 600000, 'd', 'PMS-002', 'Kas'),
(38, '2025-01-15', 401, 600000, 'k', 'PMS-002', 'Pendapatan Sewa'),
(39, '2025-01-17', 101, 300000, 'd', 'PMS-003', 'Kas'),
(40, '2025-01-17', 401, 300000, 'k', 'PMS-003', 'Pendapatan Sewa'),
(41, '2025-01-25', 101, 1000000, 'd', 'PMS-004', 'Kas'),
(42, '2025-01-25', 401, 1000000, 'k', 'PMS-004', 'Pendapatan Sewa'),
(43, '2025-01-25', 101, 50000, 'd', 'PMS-005', 'Kas'),
(44, '2025-01-25', 401, 50000, 'k', 'PMS-005', 'Pendapatan Sewa'),
(45, '2025-02-05', 101, 3000000, 'd', 'PMS-002', 'Kas'),
(46, '2025-02-05', 401, 3000000, 'k', 'PMS-002', 'Pendapatan Sewa'),
(47, '2025-02-06', 101, 3000000, 'd', 'PMS-003', 'Kas'),
(48, '2025-02-06', 401, 3000000, 'k', 'PMS-003', 'Pendapatan Sewa'),
(49, '2025-02-06', 101, 500000, 'd', 'PMS-004', 'Kas'),
(50, '2025-02-06', 401, 500000, 'k', 'PMS-004', 'Pendapatan Sewa'),
(51, '2025-02-06', 101, 20000, 'd', 'PMS-005', 'Kas'),
(52, '2025-02-06', 401, 20000, 'k', 'PMS-005', 'Pendapatan Sewa'),
(53, '2025-02-09', 101, 1000000, 'd', 'PMS-006', 'Kas'),
(54, '2025-02-09', 401, 1000000, 'k', 'PMS-006', 'Pendapatan Sewa'),
(55, '2025-02-09', 101, 1000000, 'd', 'PMS-007', 'Kas'),
(56, '2025-02-09', 401, 1000000, 'k', 'PMS-007', 'Pendapatan Sewa'),
(57, '2025-02-09', 101, 500000, 'd', 'PMS-008', 'Kas'),
(58, '2025-02-09', 401, 500000, 'k', 'PMS-008', 'Pendapatan Sewa'),
(59, '2025-02-09', 101, 25000, 'd', 'PMS-009', 'Kas'),
(60, '2025-02-09', 401, 25000, 'k', 'PMS-009', 'Pendapatan Sewa'),
(61, '2025-02-09', 101, 1000000, 'd', 'PMS-010', 'Kas'),
(62, '2025-02-09', 401, 1000000, 'k', 'PMS-010', 'Pendapatan Sewa'),
(63, '2025-02-09', 101, 40000, 'd', 'PMS-011', 'Kas'),
(64, '2025-02-09', 401, 40000, 'k', 'PMS-011', 'Pendapatan Sewa'),
(65, '2025-02-09', 101, 60000, 'd', 'PMS-012', 'Kas'),
(66, '2025-02-09', 401, 60000, 'k', 'PMS-012', 'Pendapatan Sewa'),
(67, '2025-02-09', 101, 600000, 'd', 'PMS-013', 'Kas'),
(68, '2025-02-09', 401, 600000, 'k', 'PMS-013', 'Pendapatan Sewa'),
(69, '2025-02-09', 101, 100000, 'd', 'PMS-014', 'Kas'),
(70, '2025-02-09', 401, 100000, 'k', 'PMS-014', 'Pendapatan Sewa'),
(71, '2025-02-09', 101, 50000, 'd', 'PMS-015', 'Kas'),
(72, '2025-02-09', 401, 50000, 'k', 'PMS-015', 'Pendapatan Sewa'),
(73, '2025-02-09', 101, 50000, 'd', 'PMS-006', 'Kas'),
(74, '2025-02-09', 401, 50000, 'k', 'PMS-006', 'Pendapatan Sewa'),
(75, '2025-02-09', 101, 500000, 'd', 'PMS-007', 'Kas'),
(76, '2025-02-09', 401, 500000, 'k', 'PMS-007', 'Pendapatan Sewa'),
(77, '2025-02-09', 101, 25000, 'd', 'PMS-008', 'Kas'),
(78, '2025-02-09', 401, 25000, 'k', 'PMS-008', 'Pendapatan Sewa'),
(79, '2025-02-09', 101, 600000, 'd', 'PMS-009', 'Kas'),
(80, '2025-02-09', 401, 600000, 'k', 'PMS-009', 'Pendapatan Sewa'),
(81, '2025-02-09', 101, 40000, 'd', 'PMS-010', 'Kas'),
(82, '2025-02-09', 401, 40000, 'k', 'PMS-010', 'Pendapatan Sewa'),
(83, '2025-02-09', 101, 1000000, 'd', 'PMS-005', 'Kas'),
(84, '2025-02-09', 401, 1000000, 'k', 'PMS-005', 'Pendapatan Sewa'),
(85, '2025-02-09', 101, 1000000, 'd', 'PMS-006', 'Kas'),
(86, '2025-02-09', 401, 1000000, 'k', 'PMS-006', 'Pendapatan Sewa'),
(87, '2025-02-09', 101, 50000, 'd', 'PMS-007', 'Kas'),
(88, '2025-02-09', 401, 50000, 'k', 'PMS-007', 'Pendapatan Sewa'),
(89, '2025-02-09', 101, 40000, 'd', 'PMS-008', 'Kas'),
(90, '2025-02-09', 401, 40000, 'k', 'PMS-008', 'Pendapatan Sewa'),
(91, '2025-02-09', 101, 20000, 'd', 'PMS-009', 'Kas'),
(92, '2025-02-09', 401, 20000, 'k', 'PMS-009', 'Pendapatan Sewa'),
(93, '2025-02-09', 101, 80000, 'd', 'PMS-010', 'Kas'),
(94, '2025-02-09', 401, 80000, 'k', 'PMS-010', 'Pendapatan Sewa'),
(95, '2025-02-09', 101, 600000, 'd', 'PMS-011', 'Kas'),
(96, '2025-02-09', 401, 600000, 'k', 'PMS-011', 'Pendapatan Sewa'),
(97, '2025-02-09', 101, 60000, 'd', 'PMS-012', 'Kas'),
(98, '2025-02-09', 401, 60000, 'k', 'PMS-012', 'Pendapatan Sewa'),
(99, '2025-02-12', 101, 25000, 'd', 'PMS-013', 'Kas'),
(100, '2025-02-12', 401, 25000, 'k', 'PMS-013', 'Pendapatan Sewa'),
(101, '2025-02-12', 101, 60000, 'd', 'PMS-014', 'Kas'),
(102, '2025-02-12', 401, 60000, 'k', 'PMS-014', 'Pendapatan Sewa'),
(103, '2025-02-12', 101, 20000, 'd', 'PMS-015', 'Kas'),
(104, '2025-02-12', 401, 20000, 'k', 'PMS-015', 'Pendapatan Sewa'),
(105, '2025-02-12', 101, 20000, 'd', 'PMS-005', 'Kas'),
(106, '2025-02-12', 401, 20000, 'k', 'PMS-005', 'Pendapatan Sewa'),
(107, '2025-02-12', 101, 40000, 'd', 'PMS-006', 'Kas'),
(108, '2025-02-12', 401, 40000, 'k', 'PMS-006', 'Pendapatan Sewa'),
(109, '2025-02-12', 101, 500000, 'd', 'PMS-007', 'Kas'),
(110, '2025-02-12', 401, 500000, 'k', 'PMS-007', 'Pendapatan Sewa'),
(111, '2025-02-12', 101, 20000, 'd', 'PMS-008', 'Kas'),
(112, '2025-02-12', 401, 20000, 'k', 'PMS-008', 'Pendapatan Sewa'),
(113, '2025-02-12', 101, 40000, 'd', 'PMS-009', 'Kas'),
(114, '2025-02-12', 401, 40000, 'k', 'PMS-009', 'Pendapatan Sewa'),
(115, '2025-02-12', 101, 40000, 'd', 'PMS-010', 'Kas'),
(116, '2025-02-12', 401, 40000, 'k', 'PMS-010', 'Pendapatan Sewa'),
(117, '2025-02-12', 101, 20000, 'd', 'PMS-001', 'Kas'),
(118, '2025-02-12', 401, 20000, 'k', 'PMS-001', 'Pendapatan Sewa'),
(119, '2025-02-12', 101, 20000, 'd', 'PMS-002', 'Kas'),
(120, '2025-02-12', 401, 20000, 'k', 'PMS-002', 'Pendapatan Sewa'),
(121, '2025-02-12', 101, 20000, 'd', 'PMS-003', 'Kas'),
(122, '2025-02-12', 401, 20000, 'k', 'PMS-003', 'Pendapatan Sewa'),
(123, '2025-02-12', 101, 75000, 'd', 'PMS-004', 'Kas'),
(124, '2025-02-12', 401, 75000, 'k', 'PMS-004', 'Pendapatan Sewa'),
(125, '2025-02-12', 101, 1000000, 'd', 'PMS-005', 'Kas'),
(126, '2025-02-12', 401, 1000000, 'k', 'PMS-005', 'Pendapatan Sewa'),
(127, '2025-02-12', 101, 60000, 'd', 'PMS-006', 'Kas'),
(128, '2025-02-12', 401, 60000, 'k', 'PMS-006', 'Pendapatan Sewa'),
(129, '2025-02-12', 101, 900000, 'd', 'PMS-007', 'Kas'),
(130, '2025-02-12', 401, 900000, 'k', 'PMS-007', 'Pendapatan Sewa'),
(131, '2025-02-12', 101, 20000, 'd', 'PMS-008', 'Kas'),
(132, '2025-02-12', 401, 20000, 'k', 'PMS-008', 'Pendapatan Sewa'),
(133, '2025-02-12', 101, 60000, 'd', 'PMS-009', 'Kas'),
(134, '2025-02-12', 401, 60000, 'k', 'PMS-009', 'Pendapatan Sewa'),
(135, '2025-02-12', 101, 60000, 'd', 'PMS-010', 'Kas'),
(136, '2025-02-12', 401, 60000, 'k', 'PMS-010', 'Pendapatan Sewa'),
(137, '2025-02-12', 101, 1500000, 'd', 'PMS-011', 'Kas'),
(138, '2025-02-12', 401, 1500000, 'k', 'PMS-011', 'Pendapatan Sewa'),
(139, '2025-02-12', 101, 20000, 'd', 'PMS-012', 'Kas'),
(140, '2025-02-12', 401, 20000, 'k', 'PMS-012', 'Pendapatan Sewa'),
(141, '2025-02-12', 101, 20000, 'd', 'PMS-013', 'Kas'),
(142, '2025-02-12', 401, 20000, 'k', 'PMS-013', 'Pendapatan Sewa'),
(143, '2025-03-12', 502, 250000, 'd', 'PNG-006', 'Beban Listrik'),
(144, '2025-03-12', 101, 250000, 'k', 'PNG-006', 'Kas'),
(145, '2025-03-24', 101, 300000, 'd', 'PMS-014', 'Kas'),
(146, '2025-03-24', 401, 300000, 'k', 'PMS-014', 'Pendapatan Sewa'),
(147, '2025-03-24', 501, 3000000, 'd', 'PNG-007', 'Beban Pengiriman'),
(148, '2025-03-24', 101, 3000000, 'k', 'PNG-007', 'Kas'),
(149, '2025-03-27', 101, 500000, 'd', 'PMS-015', 'Kas'),
(150, '2025-03-27', 401, 500000, 'k', 'PMS-015', 'Pendapatan Sewa'),
(151, '2025-04-24', 101, 50000, 'd', 'PMS-016', 'Kas'),
(152, '2025-04-24', 401, 50000, 'k', 'PMS-016', 'Pendapatan Sewa'),
(153, '2025-04-27', 101, 55000, 'd', 'PMS-017', 'Kas'),
(154, '2025-04-27', 401, 55000, 'k', 'PMS-017', 'Pendapatan Sewa'),
(155, '2025-04-27', 101, 20000, 'd', 'PMS-018', 'Kas'),
(156, '2025-04-27', 401, 20000, 'k', 'PMS-018', 'Pendapatan Sewa'),
(157, '2025-04-27', 101, 825000, 'd', 'PMS-019', 'Kas'),
(158, '2025-04-27', 401, 825000, 'k', 'PMS-019', 'Pendapatan Sewa'),
(159, '2025-04-27', 101, 1800000, 'd', 'PMS-020', 'Kas'),
(160, '2025-04-27', 401, 1800000, 'k', 'PMS-020', 'Pendapatan Sewa'),
(161, '2025-05-01', 101, 275000, 'd', 'PMS-021', 'Kas'),
(162, '2025-05-01', 401, 275000, 'k', 'PMS-021', 'Pendapatan Sewa'),
(163, '2025-05-01', 101, 600000, 'd', 'PMS-022', 'Kas'),
(164, '2025-05-01', 401, 600000, 'k', 'PMS-022', 'Pendapatan Sewa'),
(165, '2025-05-01', 101, 100000, 'd', 'PMS-023', 'Kas'),
(166, '2025-05-01', 401, 100000, 'k', 'PMS-023', 'Pendapatan Sewa'),
(167, '2025-05-01', 101, 3825000, 'd', 'PMS-024', 'Kas'),
(168, '2025-05-01', 401, 3825000, 'k', 'PMS-024', 'Pendapatan Sewa');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `kode_kendaraan` varchar(20) NOT NULL,
  `jenis_kendaraan` varchar(20) NOT NULL,
  `nama_kendaraan` varchar(100) NOT NULL,
  `merk_kendaraan` varchar(20) NOT NULL,
  `tahun_kendaraan` varchar(5) NOT NULL,
  `warna_kendaraan` varchar(20) NOT NULL,
  `harga_sewa_kendaraan` double NOT NULL,
  `gambar_kendaraan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `kode_kendaraan`, `jenis_kendaraan`, `nama_kendaraan`, `merk_kendaraan`, `tahun_kendaraan`, `warna_kendaraan`, `harga_sewa_kendaraan`, `gambar_kendaraan`) VALUES
(1, 'KND-001', 'Motor', 'Beat', 'honda', '2019', 'Merah', 20000, '1728240205_4752d6768cbabb489756.jpeg'),
(2, 'KND-002', 'Mobil', 'Avanza', 'toyota', '2023', 'Silver', 300000, '1728238360_357509b2414050f62687.jpg'),
(3, 'KND-003', 'Motor', 'Vario 150', 'honda', '2020', 'Hitam', 25000, '1728240114_12c9ad11ceada66d5b45.jpg'),
(11, 'KND-004', 'Mobil', 'Innova ', 'Toyota', '2021', 'Hitam', 500000, '1737789076_6ecabf6de0fde170ea80.png'),
(16, 'KND-005', 'Motor', 'ZX-25', 'Kawasaki', '2023', 'Hijau', 800000, '1739460550_ae98f45d85556b8d44bd.png'),
(17, 'KND-006', 'Motor', 'All New PCX', 'Honda', '2023', 'Merah', 55000, '1739461298_d9d29073d01bc2c40f1f.png'),
(18, 'KND-007', 'Mobil', 'HRV Turbo', 'Honda', '2022', 'Putih', 750000, '1739541821_c14b2a9041ad28ecaa9d.jpg'),
(19, 'KND-008', 'Mobil', 'Jazz RS', 'Honda', '2021', 'Merah', 425000, '1739541904_ed6d4f699f99930bb086.jpeg'),
(20, 'KND-009', 'Mobil', 'All New Avanza', 'Toyota', '2023', 'Silver', 500000, '1739541998_254061eb6368bb368816.png'),
(21, 'KND-010', 'Mobil', 'NEW RUSH TRD', 'Toyota', '2023', 'Merah', 500000, '1739542083_4ab6a409d8ac62d8f02b.png'),
(22, 'KND-011', 'Mobil', 'SIGRA DELUX', 'Daihatsu', '2022', 'Orange', 350000, '1739542313_3730cab4850fa44c59ba.jpg'),
(23, 'KND-012', 'Mobil', 'MITSUBISHI  L300 (BOX)', 'Mitsubishi', '2020', 'Hitam', 325000, '1739542448_8097559a0c84322423b6.png'),
(24, 'KND-013', 'Mobil', 'ALPHARD', 'Toyota', '2018', 'Silver', 330000, '1739542514_3d70aaf07bed3f4734c9.jpg'),
(25, 'KND-014', 'Motor', 'VESPA SPRINT S', 'Piaggio', '2023', 'Biru', 235000, '1739542608_90c345bb2c1b7023156b.jpeg'),
(26, 'KND-015', 'Motor', ' VESPA PRIMAVERA', 'Piaggio', '2023', 'Tosca', 235000, '1739542678_0d6c69745860e1b351a4.jpeg'),
(27, 'KND-016', 'Motor', 'N-MAX', 'Yamaha', '2019', 'Hitam', 175000, '1739542752_c705326e8bccbc2faccd.jpeg'),
(28, 'KND-017', 'Motor', 'X-MAX', 'Yamaha', '2024', 'Hitam', 275000, '1739542834_df2ea94ac9737e2cd668.jpeg'),
(29, 'KND-018', 'Motor', 'PCX', 'Honda', '2024', 'Merah', 175000, '1739542888_f5e3f3a0d134f7761e99.png'),
(30, 'KND-019', 'Motor', 'ALL NEW VARIO 160', 'Honda', '2024', 'Putih', 150000, '1739542990_3c0bf73dafcc8630d69e.jpeg'),
(31, 'KND-020', 'Motor', 'GENIO', 'Honda', '2022', 'Hitam', 100000, '1739543070_931e3ebb7ea99291c2d7.png'),
(32, 'KND-021', 'Motor', 'SCOOPY', 'Honda', '2024', 'Hitam', 125000, '1739543156_bb8ed06ce36cfbf96d5f.png'),
(33, 'KND-022', 'Motor', 'YZF R-25', 'Yamaha', '2025', 'Merah', 600000, '1739543265_9978dc1ce5b869ae8103.png'),
(34, 'KND-023', 'Motor', 'CBR 150', 'Honda', '2022', 'Orange', 500000, '1739543418_e221d01feb5ecda6385a.png');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `kode_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_telp_pelanggan` varchar(15) NOT NULL,
  `email_pelanggan` varchar(50) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `jenis_kelamin_pelanggan` varchar(10) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `kode_pelanggan`, `nama_pelanggan`, `no_telp_pelanggan`, `email_pelanggan`, `alamat_pelanggan`, `jenis_kelamin_pelanggan`, `user_id`) VALUES
(9, 'PLGN-001', 'Prilly Latuconsina', '081904050707', 'prili@gmail.com', 'buah batu', 'Perempuan', NULL),
(11, 'PLGN-002', 'Happy asmara', '081904050709', 'happy@gmail.com', 'buah batuu', 'Perempuan', NULL),
(12, 'PLGN-003', 'Rafly', '081904050709', 'prili@gmail.com', 'bandung', 'Laki-laki', NULL),
(46, 'PLGN-009', 'prabowo1', '081904050707', 'p1@gmail.com', 'buabr', 'Laki-laki', NULL),
(47, 'PLGN-010', 'prabowo', '081904050707', 'prabowo@gmail.com', 'saddase', 'Laki-laki', NULL),
(64, 'PLGN-011', 'prabo321wo', '081904050707', 'pra321bowo@gmail.com', 'Buah Batu', 'Laki-laki', NULL),
(65, 'PLGN-012', 'prabowo123', '081904050707', 'pra3bowo@gmail.com', 'Buah Batu', 'Laki-laki', NULL),
(66, 'PLGN-013', 'prabowo32', '081904050707', 'prabowo32@gmail.com', 'Buah Batu', 'Perempuan', NULL),
(67, 'PLGN-014', 'prabowo32321', '081904050707', 'prabowo32321@gmail.com', 'Buah Batu', 'Perempuan', NULL),
(74, 'PLGN-015', 'mrupyagung', '081904050707', 'gogo@gmail.com', 'Buah Batu', 'Laki-laki', NULL),
(75, 'PLGN-016', 'alfa', '081904050707', 'alfa@gmail.com', 'Buah Batu', 'Laki-laki', NULL),
(76, 'PLGN-017', 'angel', '081904050700', 'angel@gmail.com', 'Buah Batu', 'Perempuan', NULL),
(77, 'PLGN-018', 'beta', '081904050707', 'b@gmail.com', 'Buah Batu', 'Laki-laki', NULL),
(78, 'PLGN-019', 'mrupyagungp', '081904050707', 'mrupyagung@gmail.com', 'Buah Batu', 'Laki-laki', NULL),
(79, 'PLGN-020', 'naruto', '081904050707', 'naruto@gmail.com', 'Buah Batu', 'Laki-laki', NULL),
(80, 'PLGN-021', 'Mrupypratama', '081904050707', 'agung@gmail.com', 'bojongsoang', 'Laki-laki', 22);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `kode_pemesanan` varchar(20) DEFAULT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `lama_pemesanan` int(11) NOT NULL,
  `total_harga` text NOT NULL,
  `jaminan_identitas` text NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'lunas',
  `tanggal_pemesanan` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `kode_pemesanan`, `tanggal_awal`, `tanggal_akhir`, `lama_pemesanan`, `total_harga`, `jaminan_identitas`, `pelanggan_id`, `kendaraan_id`, `status`, `tanggal_pemesanan`, `created_at`, `updated_at`, `user_id`) VALUES
(88, 'PMS-001', '2025-02-12', '2025-02-13', 1, '20000', '1739367061.png', 75, 1, 'lunas', '2025-02-12', '2025-02-12 13:31:01', '2025-02-12 16:02:14', NULL),
(89, 'PMS-002', '2025-02-12', '2025-02-13', 1, '20000', '1739368055.png', 75, 1, 'lunas', '2025-02-12', '2025-02-12 13:47:35', '2025-02-12 16:02:11', NULL),
(90, 'PMS-003', '2025-02-12', '2025-02-13', 1, '20000', '1739368338.png', 75, 1, 'lunas', '2025-02-12', '2025-02-12 13:52:18', '2025-02-12 16:02:09', NULL),
(91, 'PMS-004', '2025-02-12', '2025-02-15', 3, '75000', '1739369382.png', 75, 3, 'lunas', '2025-02-12', '2025-02-12 14:09:42', '2025-02-12 16:02:05', NULL),
(92, 'PMS-005', '2025-02-12', '2025-02-14', 2, '1000000', '1739370156.png', 75, 11, 'lunas', '2025-02-12', '2025-02-12 14:22:36', '2025-02-12 16:02:03', NULL),
(93, 'PMS-006', '2025-02-12', '2025-02-15', 3, '60000', '1739371303.png', 75, 1, 'lunas', '2025-02-12', '2025-02-12 14:41:43', '2025-02-12 16:02:00', NULL),
(94, 'PMS-007', '2025-02-12', '2025-02-15', 3, '900000', '1739372179.png', 75, 2, 'lunas', '2025-02-12', '2025-02-12 14:56:19', '2025-02-12 16:01:57', NULL),
(95, 'PMS-008', '2025-02-12', '2025-02-13', 1, '20000', '1739373272.png', 75, 1, 'lunas', '2025-02-12', '2025-02-12 15:14:32', '2025-02-12 16:01:54', NULL),
(96, 'PMS-009', '2025-02-12', '2025-02-15', 3, '60000', '1739373296.png', 75, 1, 'lunas', '2025-02-12', '2025-02-12 15:14:56', '2025-02-12 16:01:51', NULL),
(97, 'PMS-010', '2025-02-12', '2025-02-15', 3, '60000', '1739374034.png', 76, 1, 'lunas', '2025-02-12', '2025-02-12 15:27:14', '2025-02-12 15:59:16', NULL),
(98, 'PMS-011', '2025-02-12', '2025-02-15', 3, '1500000', '1739375828.png', 76, 11, 'lunas', '2025-02-12', '2025-02-12 15:57:08', '2025-02-12 15:59:13', NULL),
(99, 'PMS-012', '2025-02-12', '2025-02-13', 1, '20000', '1739376016.png', 76, 1, 'lunas', '2025-02-12', '2025-02-12 16:00:16', '2025-02-12 16:00:16', NULL),
(100, 'PMS-013', '2025-02-12', '2025-02-13', 1, '20000', '1739376049.png', 76, 1, 'lunas', '2025-02-12', '2025-02-12 16:00:49', '2025-02-12 16:00:49', NULL),
(101, 'PMS-014', '2025-03-24', '2025-03-26', 2, '300000', '1742821541.jpeg', 77, 30, 'lunas', '2025-03-24', '2025-03-24 13:05:41', '2025-03-24 13:05:41', NULL),
(102, 'PMS-015', '2025-03-28', '2025-03-29', 1, '500000', '1743052522.jpg', 77, 20, 'lunas', '2025-03-27', '2025-03-27 05:15:22', '2025-03-27 05:15:22', NULL),
(103, 'PMS-016', '2025-04-24', '2025-04-26', 2, '50000', '1745486316.jpg', 78, 3, 'lunas', '2025-04-24', '2025-04-24 09:18:36', '2025-04-24 09:18:36', NULL),
(104, 'PMS-017', '2025-04-27', '2025-04-28', 1, '55000', '1745719010.png', 78, 17, 'lunas', '2025-04-27', '2025-04-27 01:56:50', '2025-04-27 01:56:50', NULL),
(105, 'PMS-018', '2025-04-27', '2025-04-28', 1, '20000', '1745746205.jpg', 78, 1, 'lunas', '2025-04-27', '2025-04-27 09:30:05', '2025-04-27 09:30:05', NULL),
(106, 'PMS-019', '2025-04-27', '2025-04-30', 3, '825000', '1745746327.png', 78, 28, 'lunas', '2025-04-27', '2025-04-27 09:32:07', '2025-04-27 09:32:07', NULL),
(107, 'PMS-020', '2025-04-27', '2025-04-30', 3, '1800000', '1745747669.jpg', 79, 33, 'lunas', '2025-04-27', '2025-04-27 09:54:29', '2025-04-27 09:54:29', NULL),
(108, 'PMS-021', '2025-05-01', '2025-05-02', 1, '275000', '1746072151.png', 79, 28, 'lunas', '2025-05-01', '2025-05-01 04:02:31', '2025-05-01 04:02:31', NULL),
(109, 'PMS-022', '2025-05-01', '2025-05-02', 1, '600000', '1746075176.jpg', 79, 33, 'lunas', '2025-05-01', '2025-05-01 04:52:56', '2025-05-01 04:52:56', NULL),
(110, 'PMS-023', '2025-05-01', '2025-05-02', 1, '100000', '1746075660.png', 79, 31, 'lunas', '2025-05-01', '2025-05-01 05:01:00', '2025-05-01 11:21:32', 21),
(111, 'PMS-024', '2025-05-01', '2025-05-10', 9, '3825000', '1746101823.jpg', 80, 19, 'lunas', '2025-05-01', '2025-05-01 12:17:03', '2025-05-01 12:17:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `jenis_pengeluaran_id` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `kode_transaksi`, `akun_id`, `jenis_pengeluaran_id`, `tanggal`, `jumlah`, `keterangan`) VALUES
(9, 'PNG-001', 501, 'JPN-002', '2024-09-13', 500000, 'beban gaji'),
(11, 'PNG-002', 501, 'JPN-002', '2024-09-14', 1000000, 'beban gaji'),
(12, 'PNG-003', 501, 'JPN-002', '2024-09-14', 1000000, 'beban gaji'),
(13, 'PNG-004', 502, 'JPN-003', '2024-09-15', 2500000, 'beban gaji'),
(14, 'PNG-005', 504, 'JPN-004', '2024-09-15', 2400000, 'Beban utilitas'),
(15, 'PNG-006', 502, 'JPN-003', '2025-03-12', 250000, 'SERVICE AC'),
(16, 'PNG-007', 501, 'JPN-002', '2025-03-24', 3000000, 'gaji karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `password`, `user_created_at`, `user_id`, `role`) VALUES
('admin', 'admin@admin.com', '$2y$10$DYBY7OmAUUNQJ2m7u3eLYu1PA94u5Qh0HBWByJM/v4tlAMd50DCja', '2024-10-06 08:03:37', 7, 1),
('Jokowi', 'joko@gmail.com', '$2y$10$IMbDfNamvSlEvEaFKABVmOiwVYf9.PtrR92cSUbou2IOT8LWxoTza', '2024-10-06 08:34:45', 9, 1),
('elouis', 'el@gmail.com', '$2y$10$J9lZyQlCiti02Ci6SFwqTupjGrFOhQ/4Ree1vTKIrFcuoAAstBdqC', '2024-10-16 20:38:30', 12, 0),
('mrupyagung', 'gogo@gmail.com', '$2y$10$E0GU2YqmvrG/Gfb20o85VemctiJkwky/AR9mtvgYGJhkocCQ/aBsi', '2025-01-11 13:50:16', 13, 0),
('andre', 'andre@gmail.com', '$2y$10$wMRjLGomHFRpSJRk5N4XNOgx0EgRiwBb5z2/fGq4o/mQ3wdrX.joq', '2025-01-13 10:56:56', 14, 0),
('rafly', 'r@gmail.com', '$2y$10$lp8aovp/meg5Whwx7tawEeLKgL4x6EnR.wsAhX/6HVNfxm/sJk/kW', '2025-01-15 12:14:51', 15, 0),
('prabowo', 'prabowo@gmail.com', '$2y$10$cYUtGTe.ExZQI6Q9Dy4PsuZ0BRuuO06VJXzGFBqu6hl0Vk7UKyUN6', '2025-01-15 12:21:50', 16, 0),
('alfa', 'alfa@gmail.com', '$2y$10$DKzwEMqh9g8AN8oHbcWIGOzDIwIFfkASvNSUQMV2JXzyVbKQEPFgu', '2025-02-04 01:46:44', 17, 0),
('angel', 'angel@gmail.com', '$2y$10$ImH/5OuQF/z0Rx/55JA3rOvvtj1yG1VfgxX1XMF5COK4bimHW7DPq', '2025-02-12 15:26:28', 18, 0),
('beta', 'b@gmail.com', '$2y$10$2D/3xThLJItHJX90NOecr.tSmRRBhn7cvlDkEX./3cnxnpvPKz89m', '2025-03-24 13:04:40', 19, 0),
('mrupyagungp', 'mrupyagung@gmail.com', '$2y$10$7HBtSINaGUM46nmCiL6Y0.FQ1Be0x8HCVfq5TLI5yQQRZsP24FLyG', '2025-04-24 09:06:20', 20, 0),
('naruto', 'naruto@gmail.com', '$2y$10$HkHtm2RRvzIWQVRK2DAt4.UXGSQs1dL/nh.kUrnO/c8fjfdOTEx9e', '2025-04-27 09:53:38', 21, 0),
('Mrupypratama', 'agung@gmail.com', '$2y$10$UtkHra0XHYtqmWVofPw/ZONLsvUkTxoPT9VedtBbg7pWH4bKPfuq2', '2025-05-01 12:10:57', 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `v_waktu`
--

CREATE TABLE `v_waktu` (
  `waktu` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `jenis_pengeluaran`
--
ALTER TABLE `jenis_pengeluaran`
  ADD PRIMARY KEY (`id_jenis_pengeluaran`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurnal_akun_id` (`id_akun`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `kode_kendaraan` (`kode_kendaraan`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `kode_pelanggan` (`kode_pelanggan`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD UNIQUE KEY `kode_pemesanan` (`kode_pemesanan`),
  ADD KEY `fk_pemesanan_kendaraan` (`kendaraan_id`),
  ADD KEY `fk_pemesanan_pelanggan` (`pelanggan_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengeluaran_akun_id` (`akun_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `jurnal_akun_id` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `fk_pemesanan_kendaraan` FOREIGN KEY (`kendaraan_id`) REFERENCES `kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemesanan_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id_pelanggan`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_akun_id` FOREIGN KEY (`akun_id`) REFERENCES `akun` (`id_akun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
