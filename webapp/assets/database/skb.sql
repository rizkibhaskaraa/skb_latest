-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2021 pada 05.02
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
-- Struktur dari tabel `skb_akun`
--

CREATE TABLE `skb_akun` (
  `akun_id` int(11) NOT NULL,
  `akun_name` varchar(25) NOT NULL,
  `akun_role` varchar(25) NOT NULL,
  `akun_akses` text NOT NULL,
  `akses` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_akun`
--

INSERT INTO `skb_akun` (`akun_id`, `akun_name`, `akun_role`, `akun_akses`, `akses`) VALUES
(26, 'Supervisor', 'Super User', '', '[\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"]'),
(27, 'Operator', 'Operator', '', '[\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\",\"1\"]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_bon`
--

CREATE TABLE `skb_bon` (
  `bon_id` int(11) NOT NULL,
  `bon_nominal` int(11) NOT NULL,
  `bon_jenis` varchar(25) NOT NULL,
  `bon_tanggal` datetime NOT NULL,
  `bon_keterangan` text NOT NULL,
  `supir_id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_bon`
--

INSERT INTO `skb_bon` (`bon_id`, `bon_nominal`, `bon_jenis`, `bon_tanggal`, `bon_keterangan`, `supir_id`, `user`) VALUES
(1, 1500000, 'Pengajuan', '2021-05-02 00:34:05', 'ok', 23, 'Operator'),
(2, 500000, 'Potong Gaji', '2021-05-02 00:53:00', 'Potongan Kasbon Dari Pembayaran Gaji', 23, ''),
(3, 500000, 'Potong Gaji', '2021-05-02 00:55:43', 'Potongan Kasbon Dari Pembayaran Gaji', 23, ''),
(4, 500000, 'Potong Gaji', '2021-05-02 00:56:02', 'Potongan Kasbon Dari Pembayaran Gaji', 23, ''),
(5, 2250000, 'Pembatalan JO', '2021-05-04 22:26:51', 'Pembatalan JO', 23, ''),
(6, 2250000, 'Pembatalan JO', '2021-05-04 22:27:20', 'Pembatalan JO', 23, ''),
(7, 1000000, 'Potong Gaji', '2021-05-04 23:04:00', 'Potongan Kasbon Dari Pembayaran Gaji', 23, ''),
(8, 2000000, 'Pembayaran', '2021-05-05 11:32:29', 'ok', 23, 'Operator'),
(9, 500000, 'Potong Gaji', '2021-05-05 11:37:28', 'Potongan Kasbon Dari Pembayaran Gaji', 23, ''),
(10, 1500000, 'Pembatalan JO', '2021-05-05 14:58:46', 'Pembatalan JO', 23, ''),
(11, 2500000, 'Potong Gaji', '2021-05-05 17:23:08', 'Potongan Kasbon Dari Pembayaran Gaji', 23, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_customer`
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
-- Dumping data untuk tabel `skb_customer`
--

INSERT INTO `skb_customer` (`customer_id`, `customer_name`, `customer_alamat`, `customer_kontak_person`, `customer_telp`, `customer_keterangan`, `status_hapus`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_customer`) VALUES
(33, 'PT.GulaKu', 'Jalan Soekarno', 'Aldi', '0897123456', 'Perusahaan Pabrik Gula', 'No', 'ACC', 'ACC', 'ACC', ''),
(34, 'PT.Rumah Kayu', 'Jalan Arif Rahman Hakim', 'Johan', '0897612371236', 'OK', 'NO', 'ACC', 'ACC', 'ACC', ''),
(35, 'PT.Gink', 'way pangubuan', 'mas budi', '0896868787', 'ok', 'No', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_invoice`
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
  `user_invoice` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_invoice`
--

INSERT INTO `skb_invoice` (`invoice_kode`, `customer_id`, `tanggal_invoice`, `batas_pembayaran`, `grand_total`, `total`, `ppn`, `status_bayar`, `total_tonase`, `invoice_keterangan`, `user_invoice`) VALUES
('1-PT.Rumah Kayu-04-2021', 34, '2021-05-04', '14', 5500000, 5000000, 500000, 'Belum Lunas', 10, 'ok', 'Supervisor'),
('111-PT.GulaKu-04-2021', 33, '2021-05-05', '14', 5000000, 5000000, 0, 'Belum Lunas', 10, 'ok', 'Supervisor'),
('1213-PT.Rumah Kayu-04-2021', 34, '2021-05-05', '14', 16500000, 15000000, 1500000, 'Belum Lunas', 29, 'ok', 'Supervisor'),
('2-PT.GulaKu-04-2021', 33, '2021-05-05', '30', 33000000, 30000000, 3000000, 'Lunas', 39, 'ok', 'Supervisor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_job_order`
--

CREATE TABLE `skb_job_order` (
  `Jo_id` varchar(7) NOT NULL,
  `parent_Jo_id` varchar(7) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `mobil_no` varchar(20) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `muatan` varchar(50) NOT NULL,
  `asal` varchar(50) NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `uang_jalan` int(11) NOT NULL,
  `uang_jalan_bayar` int(11) NOT NULL,
  `terbilang` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tanggal_bongkar` date NOT NULL,
  `tonase` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `upah` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `bonus` int(11) NOT NULL,
  `status_upah` varchar(25) NOT NULL,
  `pembayaran_upah_id` int(11) NOT NULL,
  `tagihan` varchar(20) NOT NULL,
  `kosongan_id` varchar(10) NOT NULL,
  `uang_kosongan` varchar(20) DEFAULT NULL,
  `paketan_id` int(11) DEFAULT NULL,
  `user` varchar(50) NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_job_order`
--

INSERT INTO `skb_job_order` (`Jo_id`, `parent_Jo_id`, `invoice_id`, `mobil_no`, `supir_id`, `muatan`, `asal`, `tujuan`, `uang_jalan`, `uang_jalan_bayar`, `terbilang`, `tanggal_surat`, `tanggal_bongkar`, `tonase`, `keterangan`, `upah`, `status`, `bonus`, `status_upah`, `pembayaran_upah_id`, `tagihan`, `kosongan_id`, `uang_kosongan`, `paketan_id`, `user`, `customer_id`) VALUES
('0000001', 'y', '2-PT.GulaKu-04-2021', 'BE 4483 AI', 25, 'Gula', 'Lampung', 'Medan', 3500000, 4250000, ' Tiga Juta Lima Ratus  Ribu  Rupiah', '2021-05-05', '2021-05-04', 10, 'ok<br>ok', 2500000, 'Sampai Tujuan', 0, 'Sudah Dibayar', 45, '10000000', '8', '750000', 0, 'Supervisor', 33),
('0000002', 'x', '', 'BE 1234 AA', 24, '', '', '', 4750000, 4750000, ' Empat Juta Tujuh Ratus Lima Puluh  Ribu  Rupiah', '2021-05-08', '2021-05-04', 10, 'ok<br>ok', 2500000, 'Sampai Tujuan', 0, 'Sudah Dibayar', 44, '', '0', '0', 12, 'Supervisor', NULL),
('0000003', '0000002', '2-PT.GulaKu-04-2021', 'BE 1234 AA', 24, 'Gula', 'Lampung', 'Jakarta', 1500000, 0, '0', '2021-05-08', '2021-05-04', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '0', '0', 0, 'Supervisor', 33),
('0000004', '0000002', '1-PT.Rumah Kayu-04-2021', 'BE 1234 AA', 24, 'bahan makan', 'serpong', 'lampung', 2500000, 0, '0', '2021-05-08', '2021-05-04', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '8', '750000', 0, 'Supervisor', 34),
('0000005', 'x', '', 'BE 1233 AA', 23, '', '', '', 2250000, 2250000, ' Dua Juta Dua Ratus Lima Puluh  Ribu  Rupiah', '2021-05-05', '0000-00-00', 0, 'ok', 1000000, 'Dibatalkan', 0, 'Belum Dibayar', 0, '', '0', '0', 14, 'Supervisor', NULL),
('0000006', '0000005', '', 'BE 1233 AA', 23, 'Gula', 'Lampung', 'Jakarta', 1500000, 0, '0', '2021-05-05', '0000-00-00', 0, 'ok', 0, 'Dibatalkan', 0, 'Belum Dibayar', 0, '5000000', '8', '750000', 0, 'Supervisor', 33),
('0000007', 'x', '', 'BE 1233 AA', 23, '', '', '', 2250000, 2250000, ' Dua Juta Dua Ratus Lima Puluh  Ribu  Rupiah', '2021-05-05', '2021-05-04', 10, 'ok<br>ok', 1000000, 'Sampai Tujuan', 0, 'Sudah Dibayar', 46, '', '0', '0', 14, 'Supervisor', NULL),
('0000008', '0000007', '111-PT.GulaKu-04-2021', 'BE 1233 AA', 23, 'Gula', 'Lampung', 'Jakarta', 1500000, 0, '0', '2021-05-05', '2021-05-04', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '8', '750000', 0, 'Supervisor', 33),
('0000009', 'y', '1213-PT.Rumah Kayu-04-2021', 'BE 1234 AA', 23, 'bahan makan', 'lampung', 'serpong', 2500000, 3250000, ' Dua Juta Lima Ratus  Ribu  Rupiah', '2021-05-06', '2021-05-05', 10, 'ok<br>sisa 5-5-2020<br>mantap', 1000000, 'Sampai Tujuan', 0, 'Sudah Dibayar', 47, '5000000', '8', '750000', 0, 'Supervisor', 34),
('0000010', 'x', '', 'BE 1234 AA', 23, '', '', '', 7500000, 7500000, ' Tujuh Juta Lima Ratus  Ribu  Rupiah', '2021-05-06', '2021-05-05', 9, 'jalan jalan<br>ok', 2500000, 'Sampai Tujuan', 0, 'Sudah Dibayar', 48, '', '0', '0', 16, 'Supervisor', NULL),
('0000011', '0000010', '1213-PT.Rumah Kayu-04-2021', 'BE 1234 AA', 23, 'bahan makan', 'serpong', 'lampung', 2500000, 0, '0', '2021-05-06', '2021-05-05', 9, 'jalan jalan', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '0', '0', 0, 'Supervisor', 34),
('0000012', '0000010', '2-PT.GulaKu-04-2021', 'BE 1234 AA', 23, 'Gula', 'Medan', 'Lampung', 3500000, 0, '0', '2021-05-06', '2021-05-05', 9, 'jalan jalan', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '10000000', '7', '1500000', 0, 'Supervisor', 33),
('0000013', 'y', '', 'BE 1234 AA', 23, 'Gula', 'Jakarta', 'Lampung', 1500000, 1500000, ' Satu Juta Lima Ratus  Ribu  Rupiah', '2021-05-06', '0000-00-00', 0, 'ok', 1000000, 'Dibatalkan', 0, 'Belum Dibayar', 0, '5000000', '0', '0', 0, 'Supervisor', 33),
('0000014', 'x', '', 'BE 1233 AA', 24, '', '', '', 5000000, 5000000, ' Lima Juta  Rupiah', '2021-05-05', '2021-05-05', 10, 'ok<br>ok<br>ok', 2000000, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '', '0', '0', 12, 'Supervisor', NULL),
('0000015', '0000014', '2-PT.GulaKu-04-2021', 'BE 1233 AA', 24, 'Gula', 'Lampung', 'Jakarta', 1500000, 0, '0', '2021-05-05', '2021-05-05', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '0', '0', 0, 'Supervisor', 33),
('0000016', '0000014', '1213-PT.Rumah Kayu-04-2021', 'BE 1233 AA', 24, 'bahan makan', 'serpong', 'lampung', 2500000, 0, '0', '2021-05-05', '2021-05-05', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '8', '750000', 0, 'Supervisor', 34),
('0000017', 'y', '', 'BE 1234 AA', 23, 'bahan makan', 'lampung', 'serpong', 2500000, 4000000, ' Dua Juta Lima Ratus  Ribu  Rupiah', '2021-05-06', '2021-05-05', 10, 'ok<br>ok', 1000000, 'Sampai Tujuan', 0, 'Sudah Dibayar', 48, '5000000', '7', '1500000', 0, 'Supervisor', 34),
('0000018', 'x', '', 'BE 1233 AA', 23, '', '', '', 2250000, 2250000, ' Dua Juta Dua Ratus Lima Puluh  Ribu  Rupiah', '2021-05-06', '2021-05-05', 10, 'ok<br>ok<br>ok', 1000000, 'Sampai Tujuan', 0, 'Sudah Dibayar', 48, '', '0', '0', 14, 'Supervisor', NULL),
('0000019', '0000018', '', 'BE 1233 AA', 23, 'Gula', 'Lampung', 'Jakarta', 1500000, 0, '0', '2021-05-06', '2021-05-05', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '8', '750000', 0, 'Supervisor', 33),
('0000020', 'x', '', 'BE 1234 AA', 24, '', '', '', 7500000, 7500000, ' Tujuh Juta Lima Ratus  Ribu  Rupiah', '2021-05-12', '2021-05-05', 10, 'ok<br>ok', 2500000, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '', '0', '0', 16, 'Supervisor', NULL),
('0000021', '0000020', '', 'BE 1234 AA', 24, 'bahan makan', 'serpong', 'lampung', 2500000, 0, '0', '2021-05-12', '2021-05-05', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '5000000', '0', '0', 0, 'Supervisor', 34),
('0000022', '0000020', '', 'BE 1234 AA', 24, 'Gula', 'Medan', 'Lampung', 3500000, 0, '0', '2021-05-12', '2021-05-05', 10, 'ok', 0, 'Sampai Tujuan', 0, 'Belum Dibayar', 0, '10000000', '7', '1500000', 0, 'Supervisor', 33),
('0000023', 'y', '', 'BE 1233 AA', 25, 'komputer', 'lampung', 'metro', 1000000, 1000000, ' Satu Juta  Rupiah', '2021-05-06', '0000-00-00', 0, 'ok', 500000, 'Dalam Perjalanan', 0, 'Belum Dibayar', 0, '3000000', '0', '0', 0, 'Supervisor', 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_kosongan`
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
-- Dumping data untuk tabel `skb_kosongan`
--

INSERT INTO `skb_kosongan` (`kosongan_id`, `kosongan_dari`, `kosongan_ke`, `kosongan_uang`, `status_hapus`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_kosongan`) VALUES
(7, 'Jakarta', 'Lampung', '1500000', 'NO', 'ACC', 'ACC', 'ACC', ''),
(8, 'Lampung', 'Palembang', '750000', 'NO', 'ACC', 'ACC', 'ACC', '0'),
(9, 'bandung ', 'jakarta', '1000000', 'NO', 'ACC', 'ACC', 'ACC', ''),
(10, 'lampung', 'metro', '500000', 'NO', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_merk_kendaraan`
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
-- Dumping data untuk tabel `skb_merk_kendaraan`
--

INSERT INTO `skb_merk_kendaraan` (`merk_id`, `merk_nama`, `merk_type`, `merk_jenis`, `merk_dump`, `status_hapus`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_merk`) VALUES
(8, 'Hino', 'HI123', 'Engkel(Sedang)', 'Ya', 'NO', 'ACC', 'ACC', 'ACC', ''),
(9, 'Hino', 'HI999', 'Tronton(Besar)', 'Tidak', 'NO', 'ACC', 'ACC', 'ACC', ''),
(10, 'Hino', 'HI123Wing', 'Wing', 'Ya', 'NO', 'ACC', 'ACC', 'ACC', ''),
(11, 'Isuzu', 'IS321', 'Pick Up', 'Tidak', 'NO', 'ACC', 'ACC', 'ACC', ''),
(12, 'SAN', 'S123', 'Container', 'Tidak', 'YES', 'ACC', 'Pending', 'ACC', ''),
(13, 'ISUZUuu', 'ZU12344', 'Box', 'Tidak', 'NO', 'ACC', 'ACC', 'ACC', ''),
(14, 'yamaha', 'jupiter', 'motor', 'Tidak', 'NO', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_mobil`
--

CREATE TABLE `skb_mobil` (
  `mobil_no` varchar(20) NOT NULL,
  `mobil_jenis` varchar(50) NOT NULL,
  `mobil_max_load` int(11) NOT NULL,
  `status_jalan` varchar(25) NOT NULL,
  `status_hapus` varchar(15) NOT NULL,
  `mobil_keterangan` varchar(255) NOT NULL,
  `merk_id` int(11) NOT NULL,
  `mobil_merk` varchar(20) NOT NULL,
  `mobil_type` varchar(20) NOT NULL,
  `mobil_dump` varchar(20) NOT NULL,
  `mobil_tahun` int(4) NOT NULL,
  `mobil_berlaku` date DEFAULT NULL,
  `mobil_pajak` date DEFAULT NULL,
  `validasi` varchar(10) NOT NULL,
  `mobil_kir` varchar(25) NOT NULL,
  `mobil_berlaku_kir` date DEFAULT NULL,
  `mobil_ijin_bongkar` varchar(25) NOT NULL,
  `mobil_berlaku_ijin_bongkar` date DEFAULT NULL,
  `file_foto` varchar(50) NOT NULL,
  `file_stnk` varchar(50) NOT NULL,
  `mobil_stnk` varchar(25) NOT NULL,
  `validasi_edit` varchar(10) NOT NULL,
  `validasi_delete` varchar(10) NOT NULL,
  `temp_mobil` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_mobil`
--

INSERT INTO `skb_mobil` (`mobil_no`, `mobil_jenis`, `mobil_max_load`, `status_jalan`, `status_hapus`, `mobil_keterangan`, `merk_id`, `mobil_merk`, `mobil_type`, `mobil_dump`, `mobil_tahun`, `mobil_berlaku`, `mobil_pajak`, `validasi`, `mobil_kir`, `mobil_berlaku_kir`, `mobil_ijin_bongkar`, `mobil_berlaku_ijin_bongkar`, `file_foto`, `file_stnk`, `mobil_stnk`, `validasi_edit`, `validasi_delete`, `temp_mobil`) VALUES
('BE 1233 AA', 'Pick Up', 10, 'Jalan', 'YES', 'ok', 11, 'Isuzu', 'IS321', 'Tidak', 2015, '2021-05-04', '2024-05-04', 'ACC', '1235465689', '2021-05-28', '98765432', '2021-06-05', '1366_768_371028005.jpg', '1366_768_4010342491.jpg', 'BE 1233 AA', 'ACC', 'ACC', ''),
('BE 1234 AA', 'Engkel(Sedang)', 5, 'Tidak Jalan', 'NO', 'mobil baru dan lama', 8, 'Hino', 'HI123', 'Ya', 2018, '2021-09-29', '2023-09-29', 'ACC', '987654321', '2021-07-20', '123456789', '2021-09-29', '1366_768_401034249.jpg', '1366_768_441025280.jpg', 'AA 4321 EB', 'ACC', 'ACC', ''),
('BE 4483 AI', 'Box', 10, 'Tidak Jalan', 'NO', 'oik', 13, 'ISUZUuu', 'ZU12344', 'Tidak', 2010, '2021-06-04', '2021-06-04', 'ACC', '123456789', '2021-05-13', '987654321', '2021-05-24', '1366_768_171028393.jpg', '____soon_____by_sonyrootkit-d4s0wlb.jpg', '12345654', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_paketan`
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
-- Dumping data untuk tabel `skb_paketan`
--

INSERT INTO `skb_paketan` (`paketan_id`, `customer_id`, `jenis_mobil`, `paketan_uj`, `paketan_tagihan`, `paketan_gaji`, `paketan_tonase`, `paketan_gaji_rumusan`, `paketan_keterangan`, `ritase`, `paketan_status_hapus`, `validasi_paketan`, `paketan_data_rute`, `validasi_paketan_edit`, `validasi_paketan_delete`, `temp_paketan`, `data_rute`) VALUES
(10, 0, 'Engkel(Sedang)', '2250000', '', '1500000', '0', '0', 'ok', 'Ritase', 'NO', 'Ditolak', '[{\"customer\":\"-\",\"dari\":\"Lampung\",\"ke\":\"Palembang\",\"muatan\":\"Kosongan\"},{\"customer\":\"customer_name\",\"dari\":\"Jakarta\",\"ke\":\"Lampung\",\"muatan\":\"Gula\"}]', 'ACC', 'ACC', '', 'k8,r20'),
(11, 0, 'Engkel(Sedang)', '2250000', '', '1500000', '0', '0', 'ok', 'Ritase', 'NO', 'ACC', '[{\"customer\":\"-\",\"dari\":\"Lampung\",\"ke\":\"Palembang\",\"muatan\":\"Kosongan\"},{\"customer\":\"PT.GulaKu\",\"dari\":\"Jakarta\",\"ke\":\"Lampung\",\"muatan\":\"Gula\"}]', 'ACC', 'ACC', '', 'k8,r20'),
(12, 0, 'Pick Up', '5000000', '', '2000000', '0', '0', 'ok update', 'Ritase', 'NO', 'ACC', '[{\"customer\":\"PT.GulaKu\",\"dari\":\"Jakarta\",\"ke\":\"Lampung\",\"muatan\":\"Gula\"},{\"customer\":\"-\",\"dari\":\"Lampung\",\"ke\":\"Palembang\",\"muatan\":\"Kosongan\"},{\"customer\":\"PT.Rumah Kayu\",\"dari\":\"lampung\",\"ke\":\"serpong\",\"muatan\":\"bahan makan\"}]', 'ACC', 'ACC', '', 'r20,k8,r22'),
(13, 0, 'Pick Up', '6000000', '', '1000000', '0', '0', 'ok', 'Ritase', 'YES', 'ACC', '[{\"customer\":\"PT.GulaKu\",\"dari\":\"Lampung\",\"ke\":\"Medan\",\"muatan\":\"Gula\"},{\"customer\":\"-\",\"dari\":null,\"ke\":null,\"muatan\":\"Kosongan\"},{\"customer\":\"PT.Rumah Kayu\",\"dari\":\"lampung\",\"ke\":\"serpong\",\"muatan\":\"bahan makan\"}]', 'ACC', 'ACC', '', 'r21,k8,r22'),
(14, 0, 'Pick Up', '2250000', '', '1000000', '0', '0', 'ok', 'Ritase', 'NO', 'ACC', '[{\"customer\":\"PT.GulaKu\",\"dari\":\"Jakarta\",\"ke\":\"Lampung\",\"muatan\":\"Gula\"},{\"customer\":\"-\",\"dari\":\"Lampung\",\"ke\":\"Palembang\",\"muatan\":\"Kosongan\"}]', 'ACC', 'ACC', '', 'r20,k8'),
(15, 0, 'Engkel(Sedang)', '7500000', '', '0', '10', '4000000', 'ok', 'Ritase', 'NO', 'ACC', '[{\"customer\":\"PT.Rumah Kayu\",\"dari\":\"lampung\",\"ke\":\"serpong\",\"muatan\":\"bahan makan\"},{\"customer\":\"-\",\"dari\":\"Jakarta\",\"ke\":\"Lampung\",\"muatan\":\"Kosongan\"},{\"customer\":\"PT.GulaKu\",\"dari\":\"Lampung\",\"ke\":\"Medan\",\"muatan\":\"Gula\"}]', 'ACC', 'ACC', '', 'r22,k7,r21'),
(16, 0, 'Engkel(Sedang)', '7500000', '', '2500000', '0', '0', 'ok', 'Ritase', 'NO', 'ACC', '[{\"customer\":\"PT.Rumah Kayu\",\"dari\":\"lampung\",\"ke\":\"serpong\",\"muatan\":\"bahan makan\"},{\"customer\":\"-\",\"dari\":\"Jakarta\",\"ke\":\"Lampung\",\"muatan\":\"Kosongan\"},{\"customer\":\"PT.GulaKu\",\"dari\":\"Lampung\",\"ke\":\"Medan\",\"muatan\":\"Gula\"}]', 'ACC', 'ACC', '', 'r22,k7,r21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_pembayaran_upah`
--

CREATE TABLE `skb_pembayaran_upah` (
  `pembayaran_upah_id` int(11) NOT NULL,
  `supir_id` int(11) NOT NULL,
  `pembayaran_upah_nominal` int(11) NOT NULL,
  `pembayaran_upah_tanggal` date NOT NULL,
  `pembayaran_upah_bonus` int(11) NOT NULL,
  `pembayaran_upah_bon` int(11) NOT NULL,
  `pembayaran_upah_total` int(11) NOT NULL,
  `user_upah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_pembayaran_upah`
--

INSERT INTO `skb_pembayaran_upah` (`pembayaran_upah_id`, `supir_id`, `pembayaran_upah_nominal`, `pembayaran_upah_tanggal`, `pembayaran_upah_bonus`, `pembayaran_upah_bon`, `pembayaran_upah_total`, `user_upah`) VALUES
(42, 1, 21321, '2021-05-11', 21321, 321312, 321321, '213'),
(43, 23, 1000000, '2021-05-02', 0, 0, 1000000, 'Operator'),
(44, 24, 2500000, '2021-05-04', 1000000, 0, 3500000, 'Supervisor'),
(45, 25, 2500000, '2021-05-04', 0, 0, 2500000, 'Supervisor'),
(46, 23, 1000000, '2021-05-04', 2000000, 1000000, 2000000, 'Supervisor'),
(47, 23, 1000000, '2021-05-05', 150000, 500000, 650000, 'Operator'),
(48, 23, 4500000, '2021-05-05', 150000, 2500000, 2150000, 'Supervisor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_rute`
--

CREATE TABLE `skb_rute` (
  `rute_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rute_dari` varchar(50) NOT NULL,
  `rute_ke` varchar(50) NOT NULL,
  `rute_muatan` varchar(50) NOT NULL,
  `jenis_mobil` varchar(50) NOT NULL,
  `rute_uj_engkel` int(20) NOT NULL,
  `rute_uj_tronton` int(20) NOT NULL,
  `rute_tagihan` int(20) NOT NULL,
  `rute_gaji_engkel` int(20) DEFAULT NULL,
  `rute_gaji_tronton` int(20) DEFAULT NULL,
  `rute_gaji_engkel_rumusan` int(20) DEFAULT NULL,
  `rute_gaji_tronton_rumusan` int(11) DEFAULT NULL,
  `rute_status_hapus` varchar(5) NOT NULL,
  `rute_tonase` varchar(8) NOT NULL,
  `validasi_rute` varchar(10) NOT NULL,
  `rute_keterangan` text NOT NULL,
  `ritase` varchar(25) NOT NULL,
  `validasi_rute_edit` varchar(10) NOT NULL,
  `validasi_rute_delete` varchar(10) NOT NULL,
  `temp_rute` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_rute`
--

INSERT INTO `skb_rute` (`rute_id`, `customer_id`, `rute_dari`, `rute_ke`, `rute_muatan`, `jenis_mobil`, `rute_uj_engkel`, `rute_uj_tronton`, `rute_tagihan`, `rute_gaji_engkel`, `rute_gaji_tronton`, `rute_gaji_engkel_rumusan`, `rute_gaji_tronton_rumusan`, `rute_status_hapus`, `rute_tonase`, `validasi_rute`, `rute_keterangan`, `ritase`, `validasi_rute_edit`, `validasi_rute_delete`, `temp_rute`) VALUES
(20, 33, 'Jakarta', 'Lampung', 'Gula', 'Engkel(Sedang)', 1500000, 0, 5000000, 1000000, NULL, 0, NULL, 'NO', '0', 'ACC', 'ok', 'Ritase', 'ACC', 'ACC', ''),
(21, 33, 'Lampung', 'Medan', 'Gula', 'Box', 3500000, 0, 10000000, 0, NULL, 2500000, NULL, 'NO', '10', 'ACC', 'ok', 'Ritase', 'ACC', 'ACC', ''),
(22, 34, 'lampung', 'serpong', 'bahan makan', 'Engkel(Sedang)', 2500000, 0, 5000000, 1000000, NULL, 0, NULL, 'NO', '0', 'ACC', 'ok', 'Ritase', 'ACC', 'ACC', ''),
(23, 35, 'lampung', 'metro', 'komputer', 'Pick Up', 1000000, 0, 3000000, 500000, NULL, 0, NULL, 'NO', '0', 'ACC', 'ok', 'Ritase', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `skb_supir`
--

CREATE TABLE `skb_supir` (
  `supir_id` int(11) NOT NULL,
  `supir_name` varchar(50) NOT NULL,
  `supir_kasbon` int(11) NOT NULL,
  `status_jalan` varchar(25) NOT NULL,
  `status_hapus` varchar(15) NOT NULL,
  `supir_alamat` text NOT NULL,
  `supir_telp` varchar(15) NOT NULL,
  `supir_keterangan` text NOT NULL,
  `supir_ktp` varchar(20) NOT NULL,
  `supir_sim` varchar(20) NOT NULL,
  `supir_panggilan` varchar(25) NOT NULL,
  `status_aktif` varchar(25) NOT NULL,
  `supir_tgl_aktif` date DEFAULT NULL,
  `supir_tgl_nonaktif` date DEFAULT NULL,
  `supir_tgl_lahir` date DEFAULT NULL,
  `supir_tempat_lahir` varchar(50) NOT NULL,
  `file_foto` varchar(50) NOT NULL,
  `file_sim` varchar(50) NOT NULL,
  `file_ktp` varchar(50) NOT NULL,
  `darurat_nama` varchar(50) NOT NULL,
  `darurat_telp` varchar(15) NOT NULL,
  `darurat_referensi` varchar(100) NOT NULL,
  `supir_tgl_sim` date DEFAULT NULL,
  `validasi` varchar(25) NOT NULL,
  `validasi_edit` varchar(10) NOT NULL,
  `validasi_delete` varchar(10) NOT NULL,
  `temp_supir` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `skb_supir`
--

INSERT INTO `skb_supir` (`supir_id`, `supir_name`, `supir_kasbon`, `status_jalan`, `status_hapus`, `supir_alamat`, `supir_telp`, `supir_keterangan`, `supir_ktp`, `supir_sim`, `supir_panggilan`, `status_aktif`, `supir_tgl_aktif`, `supir_tgl_nonaktif`, `supir_tgl_lahir`, `supir_tempat_lahir`, `file_foto`, `file_sim`, `file_ktp`, `darurat_nama`, `darurat_telp`, `darurat_referensi`, `supir_tgl_sim`, `validasi`, `validasi_edit`, `validasi_delete`, `temp_supir`) VALUES
(23, 'Aldi Indrawan', 0, 'Tidak Jalan', 'NO', 'jalan pulau damar', '089612123331', 'baru', '1231223123121', '2141413123123', 'ALDI', 'Aktif', '2021-04-25', NULL, '1998-11-12', 'bandar lampunf', '1366_768_401034249.jpg', '1366_768_371028005.jpg', '____soon_____by_sonyrootkit-d4s0wlb.jpg', 'ferawati', '0987987990979', 'sodara', '2024-05-13', 'ACC', 'ACC', 'ACC', ''),
(24, 'Dwiki Martin Prasetya', 0, 'Tidak Jalan', 'NO', 'Jalan Way pangubuan', '0895620408193', 'ok aja', '123456789', '1281391419211111', 'Dwiki', 'Aktif', '2021-04-25', NULL, '1998-10-10', 'Panjang', '1366_768_4010342491.jpg', '6920543-fresh-water-wallpaper.jpg', '1366_768_461038188.jpg', 'Windy aja', '08131121231213', 'istrinya', '2021-09-09', 'ACC', 'ACC', 'ACC', ''),
(25, 'Galih Pratama', 0, 'Jalan', 'NO', 'jalan ikan unyu', '089672364737', 'ok', '1234567890', '987654321', 'Lilih', 'Aktif', '2021-04-25', NULL, '1998-10-10', 'Teluk Betung', '1366_768_21027243.jpg', '____soon_____by_sonyrootkit-d4s0wlb1.jpg', '1366_768_210272431.jpg', 'sukoi', '0989678689', 'ibunya', '2022-10-10', 'ACC', 'ACC', 'ACC', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `akun_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `akun_id`, `username`, `password`) VALUES
(23, 26, 'supervisor', '0f4d09e43d208d5e9222322fbc7091ceea1a78c3'),
(24, 27, 'operator', 'fe96dd39756ac41b74283a9292652d366d73931f');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `skb_akun`
--
ALTER TABLE `skb_akun`
  ADD PRIMARY KEY (`akun_id`);

--
-- Indeks untuk tabel `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD PRIMARY KEY (`bon_id`),
  ADD KEY `supir_id` (`supir_id`);

--
-- Indeks untuk tabel `skb_customer`
--
ALTER TABLE `skb_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indeks untuk tabel `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD PRIMARY KEY (`invoice_kode`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indeks untuk tabel `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD PRIMARY KEY (`Jo_id`),
  ADD KEY `mobil_no` (`mobil_no`),
  ADD KEY `supir_id` (`supir_id`);

--
-- Indeks untuk tabel `skb_kosongan`
--
ALTER TABLE `skb_kosongan`
  ADD PRIMARY KEY (`kosongan_id`);

--
-- Indeks untuk tabel `skb_merk_kendaraan`
--
ALTER TABLE `skb_merk_kendaraan`
  ADD PRIMARY KEY (`merk_id`);

--
-- Indeks untuk tabel `skb_mobil`
--
ALTER TABLE `skb_mobil`
  ADD PRIMARY KEY (`mobil_no`);

--
-- Indeks untuk tabel `skb_paketan`
--
ALTER TABLE `skb_paketan`
  ADD PRIMARY KEY (`paketan_id`);

--
-- Indeks untuk tabel `skb_pembayaran_upah`
--
ALTER TABLE `skb_pembayaran_upah`
  ADD PRIMARY KEY (`pembayaran_upah_id`);

--
-- Indeks untuk tabel `skb_rute`
--
ALTER TABLE `skb_rute`
  ADD PRIMARY KEY (`rute_id`);

--
-- Indeks untuk tabel `skb_supir`
--
ALTER TABLE `skb_supir`
  ADD PRIMARY KEY (`supir_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `akun_id` (`akun_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `skb_akun`
--
ALTER TABLE `skb_akun`
  MODIFY `akun_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `skb_bon`
--
ALTER TABLE `skb_bon`
  MODIFY `bon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `skb_customer`
--
ALTER TABLE `skb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `skb_kosongan`
--
ALTER TABLE `skb_kosongan`
  MODIFY `kosongan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `skb_merk_kendaraan`
--
ALTER TABLE `skb_merk_kendaraan`
  MODIFY `merk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `skb_paketan`
--
ALTER TABLE `skb_paketan`
  MODIFY `paketan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `skb_pembayaran_upah`
--
ALTER TABLE `skb_pembayaran_upah`
  MODIFY `pembayaran_upah_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `skb_rute`
--
ALTER TABLE `skb_rute`
  MODIFY `rute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `skb_supir`
--
ALTER TABLE `skb_supir`
  MODIFY `supir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `skb_bon`
--
ALTER TABLE `skb_bon`
  ADD CONSTRAINT `skb_bon_ibfk_1` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`);

--
-- Ketidakleluasaan untuk tabel `skb_invoice`
--
ALTER TABLE `skb_invoice`
  ADD CONSTRAINT `skb_invoice_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `skb_customer` (`customer_id`);

--
-- Ketidakleluasaan untuk tabel `skb_job_order`
--
ALTER TABLE `skb_job_order`
  ADD CONSTRAINT `skb_job_order_ibfk_1` FOREIGN KEY (`mobil_no`) REFERENCES `skb_mobil` (`mobil_no`),
  ADD CONSTRAINT `skb_job_order_ibfk_2` FOREIGN KEY (`supir_id`) REFERENCES `skb_supir` (`supir_id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`akun_id`) REFERENCES `skb_akun` (`akun_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
