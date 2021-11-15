-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2021 at 06:36 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skb`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_invoice`
--

CREATE TABLE `payment_invoice` (
  `payment_invoice_id` int(11) NOT NULL,
  `invoice_id` varchar(25) NOT NULL,
  `payment_invoice_tgl` date NOT NULL,
  `payment_invoice_nominal` varchar(25) NOT NULL,
  `payment_invoice_jenis` varchar(25) NOT NULL,
  `payment_invoice_keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_invoice`
--

INSERT INTO `payment_invoice` (`payment_invoice_id`, `invoice_id`, `payment_invoice_tgl`, `payment_invoice_nominal`, `payment_invoice_jenis`, `payment_invoice_keterangan`) VALUES
(7, '4-SKB-06-2021', '2021-07-31', '1500000', 'Tunai', 'cicilan 1'),
(8, '1-SKB-07-2021', '2021-08-03', '22034100', 'Tunai', 'sss'),
(9, '4-SKB-06-2021', '2021-08-03', '2000000', 'Tunai', ''),
(10, '1-SKB-06-2021', '2021-08-03', '5000000', 'Transfer', ''),
(11, '1-SKB-06-2021', '2021-08-03', '5000000', 'Transfer', ''),
(12, '1-SKB-06-2021', '2021-08-03', '5000000', 'Transfer', 'Lunas ya');

-- --------------------------------------------------------

--
-- Table structure for table `payment_jo`
--

CREATE TABLE `payment_jo` (
  `payment_jo_id` int(11) NOT NULL,
  `payment_jo_nominal` int(11) NOT NULL,
  `payment_jo_jenis` varchar(25) NOT NULL,
  `payment_jo_tgl` date NOT NULL,
  `payment_jo_keterangan` text NOT NULL,
  `jo_id` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_jo`
--

INSERT INTO `payment_jo` (`payment_jo_id`, `payment_jo_nominal`, `payment_jo_jenis`, `payment_jo_tgl`, `payment_jo_keterangan`, `jo_id`) VALUES
(3, 500000, 'Transfer', '2021-06-20', 'pelunasan transfer', '000008'),
(5, 1000000, 'Tunai', '2021-06-19', '', '000008'),
(6, 1000000, 'Tunai', '2021-06-19', '', '000010'),
(7, 250000, 'Tunai', '2021-07-21', '', '000010'),
(9, 2500000, 'Tunai', '2021-07-25', '', '000011'),
(11, 2500000, 'Tunai', '2021-07-31', '', '000012'),
(12, 2000000, 'Tunai', '2021-07-31', '', '000013'),
(13, 500000, 'Transfer', '2021-07-31', '', '000013'),
(14, 20000000, 'Tunai', '2021-08-04', 'lunas ya', '000015'),
(15, 20000000, 'Tunai', '2021-08-05', 'cus lunas', '000016');

-- --------------------------------------------------------

--
-- Table structure for table `payment_upah`
--

CREATE TABLE `payment_upah` (
  `payment_upah_id` int(11) NOT NULL,
  `payment_upah_nominal` int(11) NOT NULL,
  `payment_upah_tgl` date NOT NULL,
  `payment_upah_keterangan` text NOT NULL,
  `payment_upah_jenis` varchar(25) NOT NULL,
  `pembayaran_upah_id` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_upah`
--

INSERT INTO `payment_upah` (`payment_upah_id`, `payment_upah_nominal`, `payment_upah_tgl`, `payment_upah_keterangan`, `payment_upah_jenis`, `pembayaran_upah_id`) VALUES
(5, 100000, '2021-06-18', '', 'Tunai', '5-GAJI-06-2021'),
(6, 150000, '2021-06-21', 'ok', 'Tunai', '5-GAJI-06-2021'),
(7, 500000, '2021-06-19', 'nyici', 'Tunai', '4-GAJI-06-2021'),
(8, 350000, '2021-06-19', 'lunas', 'Transfer', '4-GAJI-06-2021'),
(9, 1000000, '2021-07-15', '', 'Tunai', '3-GAJI-06-2021'),
(10, 100000, '2021-07-15', '', 'Tunai', '3-GAJI-06-2021'),
(11, 1650000, '2021-07-15', '\r\n', 'Tunai', '3-GAJI-06-2021'),
(12, 1000000, '2021-08-05', 'Lunas ya\r\n', 'Tunai', '1-GAJI-08-2021'),
(13, 1000000, '2021-08-07', '', 'Transfer', '2-GAJI-08-2021');

-- --------------------------------------------------------

--
-- Table structure for table `skb_akun`
--

CREATE TABLE `skb_akun` (
  `akun_id` int(11) NOT NULL,
  `akun_name` varchar(25) NOT NULL,
  `akun_role` varchar(25) NOT NULL,
  `akun_akses` text NOT NULL,
  `akses` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_akun`
--

INSERT INTO `skb_akun` (`akun_id`, `akun_name`, `akun_role`, `akun_akses`, `akses`) VALUES
(26, 'Super user', 'Super User', '', '["1","1","1","1","1","1","1","1","1","1","1","1",null,"1","1","1","1","1","1","1","1"]'),
(27, 'Operator', 'Operator', '', '["1","1","1","1","1","1","1","1","1","1","1","1",null,"1","1","1","1","1","1","1","0"]'),
(28, 'Supervisor New', 'Supervisor', '', '["1","1","1","1","1","1","1","1","1","1","1","1",null,"1","1","1","1","1","1","1","1"]');

-- --------------------------------------------------------

--
-- Table structure for table `skb_bon`
--

CREATE TABLE `skb_bon` (
  `bon_id` varchar(25) NOT NULL,
  `bon_nominal` int(11) NOT NULL,
  `bon_jenis` varchar(25) NOT NULL,
  `bon_tanggal` date NOT NULL,
  `bon_keterangan` text NOT NULL,
  `supir_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pembayaran_upah_id` varchar(50) DEFAULT NULL,
  `status_hapus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_bon`
--

INSERT INTO `skb_bon` (`bon_id`, `bon_nominal`, `bon_jenis`, `bon_tanggal`, `bon_keterangan`, `supir_id`, `user`, `pembayaran_upah_id`, `status_hapus`) VALUES
('1-BON-06-2021', 200000, 'Pengajuan', '2021-06-14', 'buat traktir doi', 23, 'Supervisor New(13-06-2021 15:08:13)', '-', 'YES'),
('1-BON-07-2021', 750000, 'Pembayaran', '2021-07-15', '', 23, 'Supervisor New(15-07-2021 12:30:16)', '-', 'YES'),
('1-BON-08-2021', 500000, 'Pengajuan', '2021-08-05', 'bon ya', 30, 'Supervisor New(05-08-2021 11:56:38)', '-', 'NO'),
('10-BON-06-2021', 250000, 'Pengajuan', '2021-06-16', 'ok', 23, 'Supervisor New(16-06-2021 18:36:39)', '-', ''),
('11-BON-06-2021', 200000, 'Pengajuan', '2021-06-16', 'ok', 25, 'Supervisor New(16-06-2021 18:41:29)', '-', ''),
('12-BON-06-2021', 1000000, 'Pengajuan', '2021-06-17', 'ok\r\n', 23, 'Supervisor New(16-06-2021 19:37:35)', '-', ''),
('13-BON-06-2021', 250000, 'Potong Gaji', '2021-06-16', 'Potongan Kasbon Dari Pembayaran Gaji', 23, 'Supervisor New(16-06-2021 19:44:55)', '4-GAJI-06-2021', ''),
('2-BON-06-2021', 0, 'Pengajuan', '2021-06-17', 'ok', 25, 'Supervisor New(13-06-2021 23:55:17)', '-', 'NO'),
('2-BON-07-2021', 100000, 'Potong Gaji', '2021-07-15', '', 25, 'Supervisor New(15-07-2021 12:31:10)', '-', 'NO'),
('2-BON-08-2021', 600000, 'Pembayaran', '2021-08-07', 'lunas bon', 30, 'Supervisor New(07-08-2021 10:45:30)', '-', 'NO'),
('3-BON-06-2021', 600000, 'Pengajuan', '2021-06-15', 'ok', 24, 'Supervisor New(14-06-2021 21:42:06)', '-', 'NO'),
('3-BON-07-2021', 500000, 'Pengajuan', '2021-07-15', 'ok', 25, 'Supervisor New(15-07-2021 19:19:41)', '-', 'NO'),
('3-BON-08-2021', 200000, 'Pengajuan', '2021-08-19', 'utang ye', 30, 'Supervisor New(19-08-2021 22:23:44)', '-', 'YES'),
('4-BON-06-2021', 1000000, 'Pembatalan JO', '2021-06-15', 'Pembatalan JO', 27, 'Supervisor New(15-06-2021 09:04:45)', '-', 'YES'),
('4-BON-07-2021', 500000, 'Potong Gaji', '2021-07-15', 'Potongan Kasbon Dari Pembayaran Gaji', 25, 'Supervisor New(15-07-2021 19:26:13)', '1-GAJI-07-2021', 'YES'),
('5-BON-06-2021', 500000, 'Pembatalan JO', '2021-06-15', 'Pembatalan JO', 23, 'Supervisor New(15-06-2021 09:52:52)', '-', 'YES'),
('5-BON-07-2021', 500000, 'Potong Gaji', '2021-07-15', 'Potongan Kasbon Dari Pembayaran Gaji', 25, 'Supervisor New(15-07-2021 19:28:17)', '1-GAJI-07-2021', 'NO'),
('6-BON-06-2021', 400000, 'Potong Gaji', '2021-06-15', 'Potongan Kasbon Dari Pembayaran Gaji', 25, 'Supervisor New(15-06-2021 09:54:38)', '5-GAJI-06-2021', 'NO'),
('6-BON-07-2021', 100000, 'Potong Gaji', '2021-07-25', 'Potongan Kasbon Dari Pembayaran Gaji', 23, 'Supervisor New(25-07-2021 08:22:14)', '2-GAJI-07-2021', 'YES'),
('7-BON-06-2021', 300000, 'Pembayaran', '2021-06-16', 'bayar', 23, 'Supervisor New(15-06-2021 09:54:57)', '-', 'YES'),
('8-BON-06-2021', 0, 'Pembatalan JO', '2021-06-15', 'Pembatalan JO', 27, 'Supervisor New(15-06-2021 16:49:27)', '-', ''),
('9-BON-06-2021', 0, 'Pembatalan JO', '2021-06-15', 'Pembatalan JO', 27, 'Supervisor New(15-06-2021 16:49:38)', '-', '');

-- --------------------------------------------------------

--
-- Table structure for table `skb_customer`
--

CREATE TABLE `skb_customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_alamat` text NOT NULL,
  `customer_kontak_person` varchar(50) NOT NULL,
  `customer_telp` varchar(20) NOT NULL,
  `customer_keterangan` text NOT NULL,
  `status_hapus` varchar(5) NOT NULL,
  `validasi` varchar(10) NOT NULL,
  `validasi_edit` varchar(10) NOT NULL,
  `validasi_delete` varchar(10) NOT NULL,
  `temp_customer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_customer`
--

INSERT INTO `skb_customer` (`customer_id`, `customer_name`, `customer_alamat`, `customer_kontak_person`, `customer_telp`, `customer_keterangan`, `status_hapus`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_customer`) VALUES
(33, 'PT.GulaKu', 'Jalan Soekarno', 'Aldi', '0897123456', 'Perusahaan Pabrik Gula', 'NO', 'ACC', 'ACC', 'ACC', ''),
(34, 'PT.Rumah Kayu', 'Jalan Arif Rahman Hakim', 'Johan', '0897612371236', 'OK', 'NO', 'ACC', 'ACC', 'ACC', ''),
(35, 'PT.Gink', 'way pangubuan', 'mas budi', '0896868787', 'ok', 'No', 'ACC', 'Pending', 'ACC', '{"customer_name":"PT.Gink","customer_alamat":"way pangubuan","customer_kontak_person":"mas budia","customer_telp":"0896868787","customer_keterangan":"ok"}'),
(39, 'PT.Gardantara', 'jalan pulau damara', 'yanto', '08962913791327', 'ok', 'NO', 'ACC', 'ACC', 'ACC', ''),
(42, 'SMAN 12 BDLa', '', '', '', '', 'No', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Table structure for table `skb_invoice`
--

CREATE TABLE `skb_invoice` (
  `invoice_kode` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tanggal_invoice` date NOT NULL,
  `batas_pembayaran` varchar(25) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `ppn` int(11) NOT NULL,
  `status_bayar` varchar(25) NOT NULL,
  `total_tonase` int(11) NOT NULL,
  `invoice_keterangan` text NOT NULL,
  `user_invoice` varchar(50) NOT NULL,
  `tanggal_batas_pembayaran` date DEFAULT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_invoice`
--

INSERT INTO `skb_invoice` (`invoice_kode`, `customer_id`, `tanggal_invoice`, `batas_pembayaran`, `grand_total`, `total`, `ppn`, `status_bayar`, `total_tonase`, `invoice_keterangan`, `user_invoice`, `tanggal_batas_pembayaran`, `sisa`) VALUES
('1-SKB-06-2021', 33, '2021-06-09', '14', 15000000, 15000000, 0, 'Lunas', 5000, 'ok', 'Supervisor New(13-06-2021 14:46:42)', '2021-06-23', 0),
('1-SKB-07-2021', 34, '2021-07-31', '14', 22034100, 20031000, 2003100, 'Lunas', 27, '', 'Supervisor New(31-07-2021 12:49:16)', '2021-08-14', 0),
('1-SKB-08-2021', 33, '2021-08-23', '12', 203500, 185000, 18500, 'Belum Lunas', 45, 'bayar', 'Supervisor New(23-08-2021 09:48:26)', '2021-09-04', 203500),
('4-SKB-06-2021', 33, '2021-06-15', '7', 3500000, 3500000, 0, 'Lunas', 7000, 'ok', 'Supervisor New(15-06-2021 09:53:30)', '2021-06-22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `skb_job_order`
--

CREATE TABLE `skb_job_order` (
  `Jo_id` varchar(7) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `mobil_no` varchar(20) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `muatan` varchar(50) NOT NULL,
  `asal` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `uang_jalan` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `uang_jalan_bayar` int(11) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_muat` date DEFAULT NULL,
  `tanggal_bongkar` date DEFAULT NULL,
  `tonase` int(11) DEFAULT NULL,
  `keterangan` text,
  `upah` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `status_upah` varchar(25) NOT NULL,
  `pembayaran_upah_id` varchar(25) NOT NULL,
  `tagihan` varchar(20) NOT NULL,
  `total_tagihan` int(11) NOT NULL DEFAULT '0',
  `user` varchar(50) NOT NULL,
  `user_closing` varchar(50) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `jenis_tambahan` varchar(25) DEFAULT NULL,
  `nominal_tambahan` int(11) DEFAULT NULL,
  `uang_total` int(11) NOT NULL,
  `biaya_lain` int(11) DEFAULT NULL,
  `tipe_tonase` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_job_order`
--

INSERT INTO `skb_job_order` (`Jo_id`, `invoice_id`, `mobil_no`, `supir_id`, `muatan`, `asal`, `tujuan`, `uang_jalan`, `sisa`, `uang_jalan_bayar`, `tanggal_surat`, `tanggal_muat`, `tanggal_bongkar`, `tonase`, `keterangan`, `upah`, `status`, `status_upah`, `pembayaran_upah_id`, `tagihan`, `total_tagihan`, `user`, `user_closing`, `customer_id`, `jenis_tambahan`, `nominal_tambahan`, `uang_total`, `biaya_lain`, `tipe_tonase`) VALUES
('000001', '1-SKB-06-2021', 'BE 1111 AA', 23, 'Gula', 'Lampung', 'Medan', 3500000, 3500000, 0, '2021-06-13', '2021-06-14', '2021-06-15', 5000, '<br>ok<br>ok', 500000, 'Sampai Tujuan', 'Belum Dibayar', '1-GAJI-06-2021', '3000', 15000000, 'Supervisor New(13-06-2021 13:02:37)', 'Supervisor New(13-06-2021 14:41:58)', 33, 'Tidak Ada', 0, 3500000, 200000, ''),
('000002', '1-SKB-07-2021', 'BE 1233 AA', 25, 'bahan makan', 'lampung', 'serpong', 2500000, 2500000, 0, '2021-06-13', '2021-06-08', '2021-06-06', 10, '<br>ok', 1000000, 'Sampai Tujuan', 'Belum Dibayar', '1-GAJI-07-2021', '2000', 20000000, 'Supervisor New(13-06-2021 13:16:13)', 'Supervisor New(13-06-2021 14:33:36)', 34, 'Tambahan', 500000, 3000000, 200000, ''),
('000003', '4-SKB-06-2021', 'BE 1233 AA', 23, 'Gula', 'Jakarta', 'Lampung', 1500000, 1500000, 0, '2021-06-13', '2021-06-16', '2021-06-16', 7000, 'ok<br>', 1000000, 'Sampai Tujuan', 'Sudah Dibayar', '3-GAJI-06-2021', '500', 3500000, 'Supervisor New(13-06-2021 23:58:13)', 'Supervisor New(13-06-2021 23:59:06)', 33, 'Potongan', 500000, 1000000, 100000, ''),
('000004', '1-SKB-08-2021', 'BE 1111 AA', 23, 'tebu', 'medan', 'lampung', 2000000, 2000000, 0, '2021-06-14', '2021-06-13', '2021-06-16', 25, '<br>ok', 1500000, 'Sampai Tujuan', 'Belum Dibayar', '3-GAJI-06-2021', '5000', 125000, 'Supervisor New(14-06-2021 09:45:02)', 'Supervisor New(14-06-2021 09:45:34)', 33, NULL, 0, 2000000, 250000, ''),
('000006', '', 'BE 4242', 23, 'Komputer', 'Lampung', 'Jakarta', 1500000, 1500000, 500000, '2021-06-15', NULL, '0000-00-00', 0, 'hati hari<br>ok', 500000, 'Dibatalkan', 'Belum Dibayar', '', '1000000', 0, 'Supervisor New(15-06-2021 09:51:22)', 'Supervisor New(15-06-2021 09:52:52)', 35, NULL, 0, 1500000, 0, ''),
('000007', '1-SKB-08-2021', 'BE 1111 AA', 25, 'Gula', 'Lampung', 'Medan', 3500000, 3500000, 0, '2021-06-15', '2021-06-16', '2021-06-17', 20, 'ok<br>', 500000, 'Sampai Tujuan', 'Sudah Dibayar', '5-GAJI-06-2021', '3000', 60000, 'Supervisor New(15-06-2021 09:52:43)', 'Supervisor New(16-06-2021 11:23:25)', 33, 'Tidak Ada', 0, 3500000, 100000, ''),
('000008', '', 'BE 1111 AA', 23, 'Gula', 'Jakarta', 'Lampung', 1500000, 0, 0, '2021-06-16', '2021-06-16', '2021-06-19', 20, 'hati hati<br>ok', 1000000, 'Sampai Tujuan', 'Sudah Dibayar', '4-GAJI-06-2021', '5000000', 100000000, 'Supervisor New(15-06-2021 22:13:59)', 'Supervisor New(16-06-2021 11:38:16)', 33, 'Tambahan', 500000, 2000000, 150000, ''),
('000009', '', 'BE 1233 AA', 23, 'Gula', 'Jakarta', 'Lampung', 1500000, 1500000, 0, '2021-06-19', '2021-07-20', '2021-07-21', 100, 'ok<br>', 1000000, 'Sampai Tujuan', 'Belum Dibayar', '2-GAJI-07-2021', '5000000', 500000000, 'Supervisor New(19-06-2021 13:50:48)', 'Supervisor New(19-07-2021 18:35:09)', 33, NULL, 0, 1500000, 100000, ''),
('000010', '', 'BE 4242 AA', 27, 'Gula', 'Jakarta', 'Lampung', 1500000, 0, 0, '2021-06-19', '2021-06-29', '2021-06-30', 1000, 'ok<br>===', 1000000, 'Sampai Tujuan', 'Belum Dibayar', '', '5000000', 2147483647, 'Supervisor New(19-06-2021 15:54:53)', 'Supervisor New(19-07-2021 18:41:02)', 33, 'Tidak Ada', 0, 1500000, 1000000, 'Ritase'),
('000011', '', 'BE 4242 AA', 23, 'bahan makan', 'lampung', 'serpong', 2500000, 0, 0, '2021-07-19', '2021-07-05', '2021-07-12', 10, '<br>ok', 1000000, 'Sampai Tujuan', 'Belum Dibayar', '', '2000', 20000, 'Supervisor New(19-07-2021 23:25:55)', 'Supervisor New(25-07-2021 10:15:36)', 34, NULL, 0, 2500000, 100000, ''),
('000012', '1-SKB-07-2021', 'BE 1234 AA', 24, 'Bahan Dapur', 'Jakarta', 'Serpong', 1500000, 0, 0, '2021-07-25', NULL, NULL, NULL, 'ok', 1500000, 'Dalam Perjalanan', 'Belum Dibayar', '', '5000000', 1000, 'Supervisor New(25-07-2021 11:05:05)', 'Supervisor New(31-07-2021 12:48:40)', 34, 'Tambahan', 1000000, 2500000, NULL, 'Ritase'),
('000013', '1-SKB-07-2021', 'BE 4242 AA', 27, 'bahan makan', 'lampung', 'serpong', 2500000, 0, 0, '2021-08-06', NULL, NULL, NULL, 'mantappp', 1000000, 'Dalam Perjalanan', 'Belum Dibayar', '', '2000', 30000, 'Supervisor New(31-07-2021 12:35:30)', 'Supervisor New(31-07-2021 12:48:24)', 34, 'Potongan', 1000000, 1500000, NULL, 'Tonase'),
('000014', '', 'BE 4483 AI', 24, 'Gula', 'Jakarta', 'Lampung', 1500000, 1000000, 0, '2021-08-01', NULL, '0000-00-00', 0, 'hati-hati', 1000000, 'Dalam Perjalanan', 'Belum Dibayar', '', '5000000', 0, 'Supervisor New(01-08-2021 10:55:53)', '', 33, 'Potongan', 500000, 1000000, 0, 'Ritase'),
('000015', '', 'BE 1233 AA', 30, 'gula', 'lampung', 'medan', 20000000, 0, 0, '2021-08-04', '2021-08-04', '2021-08-13', 50, 'dia===<br>Aman', 1000000, 'Sampai Tujuan', 'Belum Dibayar', '1-GAJI-08-2021', '5000000', 100000, 'Supervisor New(04-08-2021 09:36:01)', 'Supervisor New(04-08-2021 09:44:14)', 34, 'Tidak Ada', 0, 20000000, 500000, 'Ritase'),
('000016', '', 'BE 1233 AA', 30, 'gula', 'lampung', 'medan', 20000000, 0, 0, '2021-08-06', '2021-08-07', '2021-08-08', 20, 'berangkat===<br>cus', 1000000, 'Sampai Tujuan', 'Belum Dibayar', '2-GAJI-08-2021', '5000000', 250000, 'Supervisor New(06-08-2021 01:04:14)', 'Supervisor New(06-08-2021 01:08:01)', 34, 'Tidak Ada', 0, 20000000, 0, 'Ritase');

-- --------------------------------------------------------

--
-- Table structure for table `skb_kosongan`
--

CREATE TABLE `skb_kosongan` (
  `kosongan_id` int(11) NOT NULL,
  `kosongan_dari` varchar(50) NOT NULL,
  `kosongan_ke` varchar(50) NOT NULL,
  `kosongan_uang` varchar(25) NOT NULL,
  `status_hapus` varchar(5) NOT NULL,
  `validasi` varchar(10) NOT NULL,
  `validasi_edit` varchar(10) NOT NULL,
  `validasi_delete` varchar(10) NOT NULL,
  `temp_kosongan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_kosongan`
--

INSERT INTO `skb_kosongan` (`kosongan_id`, `kosongan_dari`, `kosongan_ke`, `kosongan_uang`, `status_hapus`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_kosongan`) VALUES
(7, 'Jakarta', 'Lampung', '1500000', 'NO', 'ACC', 'ACC', 'ACC', ''),
(8, 'Lampung', 'Palembang', '750000', 'NO', 'ACC', 'ACC', 'ACC', '0'),
(9, 'bandung ', 'jakarta', '1000000', 'NO', 'ACC', 'ACC', 'ACC', ''),
(10, 'lampung', 'metro', '500000', 'NO', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Table structure for table `skb_merk_kendaraan`
--

CREATE TABLE `skb_merk_kendaraan` (
  `merk_id` int(11) NOT NULL,
  `merk_nama` varchar(50) NOT NULL,
  `merk_type` varchar(50) NOT NULL,
  `merk_jenis` varchar(50) NOT NULL,
  `merk_dump` varchar(5) NOT NULL,
  `status_hapus` varchar(10) NOT NULL,
  `validasi` varchar(10) NOT NULL,
  `validasi_edit` varchar(10) NOT NULL,
  `validasi_delete` varchar(10) NOT NULL,
  `temp_merk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_merk_kendaraan`
--

INSERT INTO `skb_merk_kendaraan` (`merk_id`, `merk_nama`, `merk_type`, `merk_jenis`, `merk_dump`, `status_hapus`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_merk`) VALUES
(8, 'Hino', 'HI123', 'Engkel(Sedang)', 'Ya', 'NO', 'ACC', 'ACC', 'ACC', ''),
(9, 'Hino', 'HI999', 'Tronton(Besar)', 'Tidak', 'NO', 'ACC', 'ACC', 'ACC', ''),
(10, 'Hino', 'HI123Wing', 'Wing', 'Ya', 'NO', 'ACC', 'ACC', 'ACC', ''),
(11, 'Isuzu', 'IS321', 'Pick Up', 'Tidak', 'NO', 'ACC', 'ACC', 'ACC', ''),
(12, 'SAN', 'S123', 'Container', 'Tidak', 'YES', 'ACC', 'Pending', 'ACC', ''),
(13, 'ISUZU', 'ZU123', 'Box', 'Ya', 'NO', 'ACC', 'ACC', 'ACC', ''),
(14, 'yamaha', 'jupiter', 'motor', 'Tidak', 'NO', 'ACC', 'Pending', 'ACC', '{"merk_nama":"yamaha","merk_type":"jupiter","merk_jenis":"motorwqe","merk_dump":"Tidak"}'),
(16, 'HINOasda', 'ASN123dasd', 'Pick Upsdasdasd', 'Ya', 'YES', 'ACC', 'ACC', 'ACC', ''),
(20, 'Hino', 'AWS123', 'Engkel(Sedang)', 'Ya', 'NO', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Table structure for table `skb_mobil`
--

CREATE TABLE `skb_mobil` (
  `mobil_no` varchar(20) NOT NULL,
  `mobil_jenis` varchar(50) DEFAULT NULL,
  `mobil_max_load` int(11) DEFAULT NULL,
  `status_jalan` varchar(25) DEFAULT NULL,
  `status_hapus` varchar(15) DEFAULT NULL,
  `mobil_keterangan` varchar(255) DEFAULT NULL,
  `merk_id` int(11) DEFAULT NULL,
  `mobil_merk` varchar(20) DEFAULT NULL,
  `mobil_type` varchar(20) DEFAULT NULL,
  `mobil_dump` varchar(20) DEFAULT NULL,
  `mobil_tahun` int(4) DEFAULT NULL,
  `mobil_berlaku` date DEFAULT NULL,
  `mobil_pajak` date DEFAULT NULL,
  `validasi` varchar(10) DEFAULT NULL,
  `mobil_kir` varchar(25) DEFAULT NULL,
  `mobil_berlaku_kir` date DEFAULT NULL,
  `mobil_ijin_bongkar` varchar(25) DEFAULT NULL,
  `mobil_berlaku_ijin_bongkar` date DEFAULT NULL,
  `file_foto` varchar(50) DEFAULT NULL,
  `file_stnk` varchar(50) DEFAULT NULL,
  `mobil_stnk` varchar(25) DEFAULT NULL,
  `validasi_edit` varchar(10) DEFAULT NULL,
  `validasi_delete` varchar(10) DEFAULT NULL,
  `temp_mobil` text,
  `mobil_usaha` varchar(25) DEFAULT NULL,
  `mobil_berlaku_usaha` date DEFAULT NULL,
  `mobil_bpkb` varchar(25) DEFAULT NULL,
  `mobil_no_rangka` varchar(25) DEFAULT NULL,
  `mobil_no_mesin` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_mobil`
--

INSERT INTO `skb_mobil` (`mobil_no`, `mobil_jenis`, `mobil_max_load`, `status_jalan`, `status_hapus`, `mobil_keterangan`, `merk_id`, `mobil_merk`, `mobil_type`, `mobil_dump`, `mobil_tahun`, `mobil_berlaku`, `mobil_pajak`, `validasi`, `mobil_kir`, `mobil_berlaku_kir`, `mobil_ijin_bongkar`, `mobil_berlaku_ijin_bongkar`, `file_foto`, `file_stnk`, `mobil_stnk`, `validasi_edit`, `validasi_delete`, `temp_mobil`, `mobil_usaha`, `mobil_berlaku_usaha`, `mobil_bpkb`, `mobil_no_rangka`, `mobil_no_mesin`) VALUES
('198767/BE 9999 AA', 'Engkel(Sedang)', NULL, 'Tidak Jalan', 'YES', '', 0, 'Hino', 'HI123', 'Ya', 2019, '2021-07-09', '2021-07-09', 'ACC', 'kir12345', '2021-07-10', 'bongkar54321', '2021-07-10', '1366_768_21027243.jpg', '____soon_____by_sonyrootkit-d4s0wlb1.jpg', 'BE 9999 AA', 'ACC', 'ACC', '', 'usaha123456789', '2021-12-03', 'BPKB54321', 'Rangka54321', 'Mesin'),
('198768/BE 4444 AA', 'Box', NULL, 'Tidak Jalan', 'YES', 'ok', 13, 'ISUZU', 'ZU123', 'Ya', 2014, '2021-07-10', '2024-07-10', 'ACC', '', '0000-00-00', '', '0000-00-00', '____soon_____by_sonyrootkit-d4s0wlb4.jpg', '', 'BE 4444 AA', 'ACC', 'ACC', NULL, 'Usaha4444', '0000-00-00', 'BPKB12345', 'Rangka4444', 'Mesin4444'),
('BE 0000', 'Wing', NULL, 'Tidak Jalan', 'NO', '', NULL, 'Hino', 'HI123Wing', 'Ya', 0, '0000-00-00', '0000-00-00', 'ACC', '', '0000-00-00', '', '0000-00-00', 'a.PNG', '', '', 'ACC', 'ACC', '', '', '0000-00-00', '', '', ''),
('BE 1111 AA', 'Engkel(Sedang)', 20, 'Tidak Jalan', 'NO', '', NULL, 'Hino', 'AWS123', 'Ya', 2011, '2021-07-07', '2021-07-10', 'ACC', '123123', '2021-06-26', '123123123', '2021-06-07', 'youtube_(3).png', 'Screenshot_(33)1.png', '123132131111', 'ACC', 'ACC', '', '', '0000-00-00', '', 'rang', 'mes'),
('BE 1233 AA', 'Wing', 10, 'Tidak Jalan', 'NO', '', 10, 'Hino', 'HI123Wing', 'Ya', 2015, '2021-05-04', '2024-05-04', 'ACC', '1235465689', '2021-05-28', '98765432', '2021-06-05', '1366_768_371028005.jpg', '1366_768_4010342491.jpg', 'BE 1233 AA', 'ACC', 'ACC', '', 'usaha123', '2021-06-11', '987654321bpkb', 'rangka1234', 'mesin12345'),
('BE 1234 AA', 'Engkel(Sedang)', 5, 'Jalan', 'NO', 'asli ini sumpah d ah', 8, 'Hino', 'HI123', 'Ya', 2018, '2021-09-29', '2023-09-29', 'ACC', '1111111111', '2021-07-20', '11111111111', '2021-09-29', 'IMG-20210521-WA0010.jpg', '51NC-nfQX7L__SX450_.jpg', 'AA 4321 EB', 'ACC', 'ACC', '', '', NULL, '', '', ''),
('BE 4242 AA', 'Engkel(Sedang)', NULL, 'Jalan', 'NO', '', 0, 'Hino', 'HI123', 'Ya', 0, '0000-00-00', '0000-00-00', 'ACC', '', '0000-00-00', '', '0000-00-00', '', '', '', 'ACC', 'ACC', '', '', '0000-00-00', '', '', ''),
('BE 4483 AI', 'Engkel(Sedang)', 10, 'Jalan', 'NO', '', 20, 'Hino', 'AWS123', 'Ya', 2010, '2021-06-04', '2021-06-04', 'ACC', '123456789', '2021-05-13', '987654321', '2021-05-24', '10304976_581663835289391_8525918023028630103_n.jpg', '10534679_526855500747972_52995802302640849_n.jpg', '12345654', 'ACC', 'ACC', '', '', '0000-00-00', '', '', ''),
('BE9999', 'Pick Up', NULL, 'Tidak Jalan', 'NO', '', 11, 'Isuzu', 'IS321', 'Tidak', 0, '0000-00-00', '0000-00-00', 'ACC', '', '0000-00-00', '', '0000-00-00', '', '', '', 'ACC', 'ACC', NULL, '', '0000-00-00', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `skb_paketan`
--

CREATE TABLE `skb_paketan` (
  `paketan_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `paketan_uj` varchar(25) NOT NULL,
  `paketan_tagihan` varchar(25) NOT NULL,
  `paketan_gaji` varchar(25) NOT NULL,
  `paketan_tonase` varchar(25) NOT NULL,
  `paketan_gaji_rumusan` varchar(25) NOT NULL,
  `paketan_keterangan` text NOT NULL,
  `ritase` varchar(10) NOT NULL,
  `paketan_status_hapus` varchar(10) NOT NULL,
  `validasi_paketan` varchar(10) NOT NULL,
  `paketan_data_rute` text NOT NULL,
  `validasi_paketan_edit` varchar(10) NOT NULL,
  `validasi_paketan_delete` varchar(10) NOT NULL,
  `temp_paketan` text NOT NULL,
  `data_rute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_paketan`
--

INSERT INTO `skb_paketan` (`paketan_id`, `customer_id`, `jenis_mobil`, `paketan_uj`, `paketan_tagihan`, `paketan_gaji`, `paketan_tonase`, `paketan_gaji_rumusan`, `paketan_keterangan`, `ritase`, `paketan_status_hapus`, `validasi_paketan`, `paketan_data_rute`, `validasi_paketan_edit`, `validasi_paketan_delete`, `temp_paketan`, `data_rute`) VALUES
(10, 0, 'Engkel(Sedang)', '2250000', '', '1500000', '0', '0', 'ok', 'Ritase', 'NO', 'Ditolak', '[{"customer":"-","dari":"Lampung","ke":"Palembang","muatan":"Kosongan"},{"customer":"customer_name","dari":"Jakarta","ke":"Lampung","muatan":"Gula"}]', 'ACC', 'ACC', '', 'k8,r20'),
(11, 0, 'Engkel(Sedang)', '2250000', '', '1500000', '0', '0', 'ok', 'Ritase', 'NO', 'ACC', '[{"customer":"-","dari":"Lampung","ke":"Palembang","muatan":"Kosongan"},{"customer":"PT.GulaKu","dari":"Jakarta","ke":"Lampung","muatan":"Gula"}]', 'ACC', 'ACC', '', 'k8,r20'),
(12, 0, 'Pick Up', '5000000', '', '2000000', '0', '0', 'ok update', 'Ritase', 'NO', 'ACC', '[{"customer":"PT.GulaKu","dari":"Jakarta","ke":"Lampung","muatan":"Gula"},{"customer":"-","dari":"Lampung","ke":"Palembang","muatan":"Kosongan"},{"customer":"PT.Rumah Kayu","dari":"lampung","ke":"serpong","muatan":"bahan makan"}]', 'ACC', 'ACC', '', 'r20,k8,r22'),
(13, 0, 'Pick Up', '6000000', '', '1000000', '0', '0', 'ok', 'Ritase', 'YES', 'ACC', '[{"customer":"PT.GulaKu","dari":"Lampung","ke":"Medan","muatan":"Gula"},{"customer":"-","dari":null,"ke":null,"muatan":"Kosongan"},{"customer":"PT.Rumah Kayu","dari":"lampung","ke":"serpong","muatan":"bahan makan"}]', 'ACC', 'ACC', '', 'r21,k8,r22'),
(14, 0, 'Pick Up', '2250000', '', '1000000', '0', '0', 'ok', 'Ritase', 'NO', 'ACC', '[{"customer":"PT.GulaKu","dari":"Jakarta","ke":"Lampung","muatan":"Gula"},{"customer":"-","dari":"Lampung","ke":"Palembang","muatan":"Kosongan"}]', 'ACC', 'ACC', '', 'r20,k8'),
(15, 0, 'Engkel(Sedang)', '7500000', '', '0', '10', '4000000', 'ok', 'Ritase', 'NO', 'ACC', '[{"customer":"PT.Rumah Kayu","dari":"lampung","ke":"serpong","muatan":"bahan makan"},{"customer":"-","dari":"Jakarta","ke":"Lampung","muatan":"Kosongan"},{"customer":"PT.GulaKu","dari":"Lampung","ke":"Medan","muatan":"Gula"}]', 'ACC', 'ACC', '', 'r22,k7,r21'),
(16, 0, 'Engkel(Sedang)', '7500000', '', '2500000', '0', '0', 'ok', 'Ritase', 'NO', 'ACC', '[{"customer":"PT.Rumah Kayu","dari":"lampung","ke":"serpong","muatan":"bahan makan"},{"customer":"-","dari":"Jakarta","ke":"Lampung","muatan":"Kosongan"},{"customer":"PT.GulaKu","dari":"Lampung","ke":"Medan","muatan":"Gula"}]', 'ACC', 'ACC', '', 'r22,k7,r21');

-- --------------------------------------------------------

--
-- Table structure for table `skb_pembayaran_upah`
--

CREATE TABLE `skb_pembayaran_upah` (
  `pembayaran_upah_id` varchar(25) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `pembayaran_upah_nominal` int(11) NOT NULL,
  `pembayaran_upah_tanggal` date NOT NULL,
  `pembayaran_upah_bonus` int(11) NOT NULL,
  `pembayaran_upah_bon` int(11) NOT NULL,
  `pembayaran_upah_total` int(11) NOT NULL,
  `user_upah` varchar(50) NOT NULL,
  `bulan_kerja` varchar(50) NOT NULL,
  `pembayaran_upah_status` varchar(15) NOT NULL,
  `keterangan` text NOT NULL,
  `sisa` varchar(25) NOT NULL,
  `nopol` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_pembayaran_upah`
--

INSERT INTO `skb_pembayaran_upah` (`pembayaran_upah_id`, `supir_id`, `pembayaran_upah_nominal`, `pembayaran_upah_tanggal`, `pembayaran_upah_bonus`, `pembayaran_upah_bon`, `pembayaran_upah_total`, `user_upah`, `bulan_kerja`, `pembayaran_upah_status`, `keterangan`, `sisa`, `nopol`) VALUES
('1-GAJI-06-2021', 23, 500000, '2021-06-13', 250000, 0, 750000, 'Supervisor New(13-06-2021 15:02:51)', 'x-2021', 'Belum Lunas', '', '750000', ''),
('1-GAJI-07-2021', 25, 1000000, '2021-07-15', 0, 500000, 500000, 'Supervisor New(15-07-2021 19:28:17)', 'x-2021', 'Belum Lunas', '', '500000', ''),
('1-GAJI-08-2021', 30, 1000000, '2021-08-04', 0, 0, 1000000, 'Supervisor New(04-08-2021 14:57:10)', 'Agustus-2021', 'Lunas', '', '0', 'BE 1233 AA'),
('2-GAJI-07-2021', 23, 1000000, '2021-07-31', 111111, 0, 1111111, 'Supervisor New(25-07-2021 08:33:56)', 'Juli-2021', 'Belum Lunas', 'ok<br>', '1111111', 'BE 1233 AA'),
('2-GAJI-08-2021', 30, 1000000, '2021-08-06', 0, 0, 1000000, 'Supervisor New(06-08-2021 01:09:03)', 'Agustus-2021', 'Lunas', '', '0', 'BE 1233 AA'),
('3-GAJI-06-2021', 23, 2500000, '2021-06-14', 250000, 0, 2750000, 'Supervisor New(14-06-2021 00:03:16)', 'Juni-2021', 'Lunas', '', '0', ''),
('4-GAJI-06-2021', 23, 1000000, '2021-06-13', 100000, 250000, 850000, 'Supervisor New(14-06-2021 10:08:50)', 'x-2021', 'Lunas', 'ok', '0', ''),
('5-GAJI-06-2021', 25, 500000, '2021-06-15', 250000, 500000, 250000, 'Supervisor New(15-06-2021 09:54:24)', 'x-2021', 'Lunas', '', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `skb_rute`
--

CREATE TABLE `skb_rute` (
  `rute_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rute_dari` varchar(50) NOT NULL,
  `rute_ke` varchar(50) NOT NULL,
  `rute_muatan` varchar(50) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `rute_uj_engkel` int(20) NOT NULL,
  `rute_tagihan` int(20) NOT NULL,
  `rute_gaji_engkel` int(20) DEFAULT NULL,
  `rute_status_hapus` varchar(5) NOT NULL,
  `validasi_rute` varchar(10) NOT NULL,
  `rute_keterangan` text NOT NULL,
  `ritase` varchar(25) DEFAULT NULL,
  `validasi_rute_edit` varchar(10) NOT NULL,
  `validasi_rute_delete` varchar(10) NOT NULL,
  `temp_rute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_rute`
--

INSERT INTO `skb_rute` (`rute_id`, `customer_id`, `rute_dari`, `rute_ke`, `rute_muatan`, `jenis_mobil`, `rute_uj_engkel`, `rute_tagihan`, `rute_gaji_engkel`, `rute_status_hapus`, `validasi_rute`, `rute_keterangan`, `ritase`, `validasi_rute_edit`, `validasi_rute_delete`, `temp_rute`) VALUES
(20, 33, 'Jakarta', 'Lampung', 'Gula', 'Engkel(Sedang)', 1500000, 5000000, 1000000, 'NO', 'ACC', 'ok', 'Ritase', 'ACC', 'ACC', ''),
(21, 33, 'Lampung', 'Medan', 'Gula', 'Box', 3500000, 3000, 500000, 'NO', 'ACC', 'ok', 'Tonase', 'ACC', 'ACC', ''),
(22, 34, 'lampung', 'serpong', 'bahan makan', 'Engkel(Sedang)', 2500000, 2000, 1000000, 'NO', 'ACC', 'ok', 'Tonase', 'ACC', 'ACC', ''),
(23, 35, 'lampung', 'metro', 'komputer', 'Pick Up', 1000000, 3000000, 500000, 'YES', 'ACC', 'ok', 'Ritase', 'ACC', 'ACC', ''),
(25, 33, 'medan', 'lampung', 'tebu', 'Pick Up', 2000000, 5000, 1500000, 'NO', 'ACC', 'ok', 'Tonase', 'ACC', 'ACC', ''),
(26, 34, 'Jakarta', 'Serpong', 'Bahan Dapur', 'Engkel(Sedang)', 1500000, 5000000, 250000, 'NO', 'ACC', 'ok', 'Ritase', 'ACC', 'ACC', ''),
(27, 35, 'Lampung', 'Jakarta', 'Komputer', 'Box', 1500000, 1000000, 500000, 'NO', 'ACC', 'asdsa', 'Tonase', 'ACC', 'ACC', ''),
(29, 34, 'lampung', 'medan', 'gula', 'Wing', 20000000, 5000000, 1000000, 'NO', 'ACC', 'asdasd', 'Ritase', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Table structure for table `skb_supir`
--

CREATE TABLE `skb_supir` (
  `supir_id` int(11) NOT NULL,
  `supir_name` varchar(50) NOT NULL,
  `supir_kasbon` int(11) DEFAULT NULL,
  `status_jalan` varchar(25) DEFAULT NULL,
  `status_hapus` varchar(15) DEFAULT NULL,
  `supir_alamat` text,
  `supir_telp` varchar(15) DEFAULT NULL,
  `supir_keterangan` text,
  `supir_ktp` varchar(20) DEFAULT NULL,
  `supir_sim` varchar(20) DEFAULT NULL,
  `supir_panggilan` varchar(25) DEFAULT NULL,
  `status_aktif` varchar(25) DEFAULT NULL,
  `supir_tgl_aktif` date DEFAULT NULL,
  `supir_tgl_nonaktif` date DEFAULT NULL,
  `supir_tgl_lahir` date DEFAULT NULL,
  `supir_tempat_lahir` varchar(50) DEFAULT NULL,
  `file_foto` varchar(50) DEFAULT NULL,
  `file_sim` varchar(50) DEFAULT NULL,
  `file_ktp` varchar(50) DEFAULT NULL,
  `darurat_nama` varchar(50) DEFAULT NULL,
  `darurat_telp` varchar(15) DEFAULT NULL,
  `darurat_referensi` varchar(100) DEFAULT NULL,
  `supir_tgl_sim` date DEFAULT NULL,
  `validasi` varchar(25) DEFAULT NULL,
  `validasi_edit` varchar(10) DEFAULT NULL,
  `validasi_delete` varchar(10) DEFAULT NULL,
  `temp_supir` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skb_supir`
--

INSERT INTO `skb_supir` (`supir_id`, `supir_name`, `supir_kasbon`, `status_jalan`, `status_hapus`, `supir_alamat`, `supir_telp`, `supir_keterangan`, `supir_ktp`, `supir_sim`, `supir_panggilan`, `status_aktif`, `supir_tgl_aktif`, `supir_tgl_nonaktif`, `supir_tgl_lahir`, `supir_tempat_lahir`, `file_foto`, `file_sim`, `file_ktp`, `darurat_nama`, `darurat_telp`, `darurat_referensi`, `supir_tgl_sim`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_supir`) VALUES
(23, 'Aldi Indrawan', 1000000, 'Tidak Jalan', 'NO', 'jalan pulau damar', '089612123331', 'baru', '1231223123121', '2141413123123', 'ALDI', 'Aktif', '2021-04-25', NULL, '1998-11-12', 'bandar lampunf', '1366_768_401034249.jpg', '1366_768_371028005.jpg', '____soon_____by_sonyrootkit-d4s0wlb.jpg', 'ferawati', '0987987990979', 'sodara', '2024-05-13', 'ACC', 'ACC', 'ACC', ''),
(24, 'Dwiki Martin Prasetya', 600000, 'Jalan', 'NO', 'Jalan Way pangubuan', '0895620408193', 'ok aja', '123456789', '1281391419211111', 'Dwiki', 'Aktif', '2021-04-25', NULL, '1998-10-10', 'Panjang', '1366_768_4010342491.jpg', '6920543-fresh-water-wallpaper.jpg', '1366_768_461038188.jpg', 'Windy aja', '08131121231213', 'istrinya', '2021-06-09', 'ACC', 'ACC', 'ACC', ''),
(25, 'Galih Pratamaaaa', 100000, 'Tidak Jalan', 'NO', 'jalan ikan unyuuuuu', '089672364737777', 'ok', '1234567890', '987654321', 'Lilih', 'Aktif', '2021-04-25', NULL, '1998-10-15', 'Teluk Betunggggg', 'gambus.png', 'IMG-20210530-WA0000.jpg', 'bende.jpg', 'sukoiaaa', '0989678689aaa', 'ibunyaaaaa', '2021-05-10', 'ACC', 'ACC', 'ACC', ''),
(27, 'yoppi', 0, 'Jalan', 'NO', 'bandar lampung', '089713123139', 'baru', '21324436547365', '123245323414', 'ipoy', 'Aktif', '2021-06-10', NULL, '1998-07-07', 'bandar lampung', '1366_768_4010342492.jpg', '1366_768_411023568.jpg', '1366_768_171028393.jpg', 'ookiiii', '9174120931', 'bapak', '2021-07-07', 'ACC', 'ACC', 'ACC', ''),
(30, 'Dia', 0, 'Tidak Jalan', 'NO', '', '', '', '', '', '', 'Aktif', '0000-00-00', NULL, '0000-00-00', '', '', '', '', '', '', '', '0000-00-00', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status_aktif` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `akun_id`, `username`, `password`, `status_aktif`) VALUES
(23, 26, 'super user', '8a56b1c7a24d848d910cc97dad3474ec95b174a3', 'Tidak Aktif'),
(24, 27, 'operator', 'fe96dd39756ac41b74283a9292652d366d73931f', 'Tidak Aktif'),
(25, 26, 'super user', '8a56b1c7a24d848d910cc97dad3474ec95b174a3', 'Tidak Aktif'),
(26, 28, 'supervisor', '0f4d09e43d208d5e9222322fbc7091ceea1a78c3', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_invoice`
--
ALTER TABLE `payment_invoice`
  ADD PRIMARY KEY (`payment_invoice_id`);

--
-- Indexes for table `payment_jo`
--
ALTER TABLE `payment_jo`
  ADD PRIMARY KEY (`payment_jo_id`);

--
-- Indexes for table `payment_upah`
--
ALTER TABLE `payment_upah`
  ADD PRIMARY KEY (`payment_upah_id`);

--
-- Indexes for table `skb_akun`
--
ALTER TABLE `skb_akun`
  ADD PRIMARY KEY (`akun_id`);

--
-- Indexes for table `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD PRIMARY KEY (`bon_id`),
  ADD KEY `supir_id` (`supir_id`);

--
-- Indexes for table `skb_customer`
--
ALTER TABLE `skb_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD PRIMARY KEY (`invoice_kode`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD PRIMARY KEY (`Jo_id`),
  ADD KEY `mobil_no` (`mobil_no`),
  ADD KEY `supir_id` (`supir_id`);

--
-- Indexes for table `skb_kosongan`
--
ALTER TABLE `skb_kosongan`
  ADD PRIMARY KEY (`kosongan_id`);

--
-- Indexes for table `skb_merk_kendaraan`
--
ALTER TABLE `skb_merk_kendaraan`
  ADD PRIMARY KEY (`merk_id`);

--
-- Indexes for table `skb_mobil`
--
ALTER TABLE `skb_mobil`
  ADD PRIMARY KEY (`mobil_no`);

--
-- Indexes for table `skb_paketan`
--
ALTER TABLE `skb_paketan`
  ADD PRIMARY KEY (`paketan_id`);

--
-- Indexes for table `skb_pembayaran_upah`
--
ALTER TABLE `skb_pembayaran_upah`
  ADD PRIMARY KEY (`pembayaran_upah_id`);

--
-- Indexes for table `skb_rute`
--
ALTER TABLE `skb_rute`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indexes for table `skb_supir`
--
ALTER TABLE `skb_supir`
  ADD PRIMARY KEY (`supir_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `akun_id` (`akun_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_invoice`
--
ALTER TABLE `payment_invoice`
  MODIFY `payment_invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `payment_jo`
--
ALTER TABLE `payment_jo`
  MODIFY `payment_jo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `payment_upah`
--
ALTER TABLE `payment_upah`
  MODIFY `payment_upah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `skb_akun`
--
ALTER TABLE `skb_akun`
  MODIFY `akun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `skb_customer`
--
ALTER TABLE `skb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `skb_kosongan`
--
ALTER TABLE `skb_kosongan`
  MODIFY `kosongan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `skb_merk_kendaraan`
--
ALTER TABLE `skb_merk_kendaraan`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `skb_paketan`
--
ALTER TABLE `skb_paketan`
  MODIFY `paketan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `skb_rute`
--
ALTER TABLE `skb_rute`
  MODIFY `rute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `skb_supir`
--
ALTER TABLE `skb_supir`
  MODIFY `supir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD CONSTRAINT `skb_bon_ibfk_1` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`);

--
-- Constraints for table `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD CONSTRAINT `skb_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`);

--
-- Constraints for table `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD CONSTRAINT `skb_job_order_ibfk_2` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`akun_id`) REFERENCES `skb_akun` (`akun_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
