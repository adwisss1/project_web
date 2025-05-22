-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2025 pada 17.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_006`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username_admin` varchar(10) NOT NULL,
  `password_admin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username_admin`, `password_admin`) VALUES
('adel1', 'adel123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_talent`
--

CREATE TABLE `book_talent` (
  `id` int(10) NOT NULL,
  `jenis_talent` varchar(50) NOT NULL,
  `jumlah_talent` int(10) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `lokasi-acara` varchar(100) NOT NULL,
  `durasi_acara` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `id_item` varchar(10) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inventaris`
--

INSERT INTO `inventaris` (`id_item`, `nama_item`, `harga_sewa`) VALUES
('inven1', 'Kostum Tari Kembang Sembah/set', 300000),
('inven2', 'Kostum Tari Gandrung/set', 350000),
('inven3', 'Properti Payung Tari/pcs', 50000),
('inven4', 'Kostum Tari Bajidor Kahot/set', 300000),
('inven5', 'Kipas Bajidor', 30000),
('inven6', 'Sewa Kain Batik Panjang', 30000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` varchar(10) NOT NULL,
  `nama_pengurus` text NOT NULL,
  `nim` varchar(20) NOT NULL,
  `angkatan` int(10) NOT NULL,
  `jabatan` text NOT NULL,
  `kontak` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `nama_pengurus`, `nim`, `angkatan`, `jabatan`, `kontak`) VALUES
('p1', 'Andi Wijaya', '2001234567', 2020, 'Ketua', 2147483647),
('p2', 'Budi Santoso', '2002234568', 2021, 'Wakil Ketua', 2147483647),
('p3', 'Citra Dewi', '2003234569', 2022, 'Sekretaris', 2147483647),
('p4', 'Dewi Lestari', '2004234570', 2023, 'Bendahara', 2147483647);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sewa_barang`
--

CREATE TABLE `sewa_barang` (
  `id_sewa` varchar(10) NOT NULL,
  `nama_penyewa` varchar(50) NOT NULL,
  `email_penyewa` varchar(50) NOT NULL,
  `nama_kegiatan_penyewa` varchar(50) NOT NULL,
  `telepon_penyewa` int(15) NOT NULL,
  `item_disewa` varchar(20) NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `durasi_sewa` int(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `talent`
--

CREATE TABLE `talent` (
  `id_talent` varchar(10) NOT NULL,
  `jenis_talent` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `talent`
--

INSERT INTO `talent` (`id_talent`, `jenis_talent`, `keterangan`) VALUES
('', 'Penari Tradisional ', 'Penari yang menampilkan tarian tradisional khas daerah.'),
('', 'modern dance', 'penari hip hop dengan musik modern dan beat cepat');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
