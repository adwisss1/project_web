-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Bulan Mei 2025 pada 07.55
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
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status_kehadiran` enum('Hadir','Tidak Hadir','Izin') NOT NULL,
  `status` enum('Hadir','Tidak Hadir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nra` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_minat_bakat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `nra`, `user_id`, `id_minat_bakat`) VALUES
(1, '', '', 2, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `book_talent`
--

CREATE TABLE `book_talent` (
  `id` int(11) NOT NULL,
  `jenis_talent` varchar(50) NOT NULL,
  `jumlah_talent` int(10) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `lokasi-acara` varchar(100) NOT NULL,
  `durasi_acara` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluasi`
--

CREATE TABLE `evaluasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kehadiran` int(11) DEFAULT 0,
  `performa` text DEFAULT NULL,
  `umpan_balik` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventaris`
--

CREATE TABLE `inventaris` (
  `id_item` int(11) NOT NULL,
  `nama_item` varchar(100) NOT NULL,
  `harga_sewa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `inventaris`
--

INSERT INTO `inventaris` (`id_item`, `nama_item`, `harga_sewa`) VALUES
(1, 'Kostum Tari Kembang Sembah/set', 300000),
(2, 'Kostum Tari Gandrung/set', 350000),
(3, 'Properti Payung Tari/pcs', 50000),
(4, 'Kostum Tari Bajidor Kahot/set', 300000),
(5, 'Kipas Bajidor', 30000),
(6, 'Sewa Kain Batik Panjang', 30000),
(7, 'Kostum Tari Kembang Sembah/set', 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_latihan`
--

CREATE TABLE `jadwal_latihan` (
  `id` int(11) NOT NULL,
  `bidang_minat` varchar(100) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_latihan`
--

INSERT INTO `jadwal_latihan` (`id`, `bidang_minat`, `hari`, `jam`) VALUES
(1, 'Tari Tradisional', 'Senin', '15:00:00'),
(2, 'Modern Dance', 'Rabu', '16:30:00'),
(3, 'Kontemporer', 'Jumat', '18:00:00'),
(4, 'Requested', 'Sabtu', '14:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi_latihan`
--

CREATE TABLE `materi_latihan` (
  `id` int(11) NOT NULL,
  `bidang_minat` varchar(100) NOT NULL,
  `minggu` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `materi` text NOT NULL,
  `link_materi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi_latihan`
--

INSERT INTO `materi_latihan` (`id`, `bidang_minat`, `minggu`, `deskripsi`, `materi`, `link_materi`) VALUES
(1, 'Tari Tradisional', 1, NULL, 'Gerakan dasar tari Jawa', NULL),
(2, 'Modern Dance', 1, NULL, 'Teknik freestyle dan ritme', NULL),
(3, 'Kontemporer', 1, NULL, 'Eksplorasi gerak tubuh', NULL),
(4, 'Requested', 1, NULL, 'Koreografi sesuai permintaan', NULL),
(5, 'Tari Tradisional', 1, NULL, 'Gerakan dasar tari Jawa', 'https://youtu.be/example1'),
(6, 'Modern Dance', 1, NULL, 'Teknik freestyle dan ritme', 'https://drive.google.com/example2'),
(7, 'Kontemporer', 1, NULL, 'Eksplorasi gerak tubuh', 'https://docs.google.com/example3'),
(8, 'Requested', 1, NULL, 'Koreografi sesuai permintaan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `minat_bakat`
--

CREATE TABLE `minat_bakat` (
  `nama_minat_bakat` varchar(100) NOT NULL,
  `enrollment_key` varchar(50) NOT NULL,
  `id_minat_bakat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `minat_bakat`
--

INSERT INTO `minat_bakat` (`nama_minat_bakat`, `enrollment_key`, `id_minat_bakat`) VALUES
('Tari Tradisional', 'TRAD2025', 1),
('Modern Dance', 'MD2025', 2),
('Kontemporer', 'KONT2025', 3),
('Requested', 'REQ2025', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `partisipasi`
--

CREATE TABLE `partisipasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `status` enum('Terdaftar','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL,
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
(1, 'Andi Wijaya', '2001234567', 2020, 'Ketua', 2147483647),
(2, 'Budi Santoso', '2002234568', 2021, 'Wakil Ketua', 2147483647),
(3, 'Citra Dewi', '2003234569', 2022, 'Sekretaris', 2147483647),
(4, 'Dewi Lestari', '2004234570', 2023, 'Bendahara', 2147483647),
(5, 'adelia', 'f1d02310006', 2023, 'wakil kepala bidang gerak', 818987);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi_absensi`
--

CREATE TABLE `sesi_absensi` (
  `id` int(11) NOT NULL,
  `status` enum('dibuka','ditutup') NOT NULL DEFAULT 'ditutup'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sesi_absensi`
--

INSERT INTO `sesi_absensi` (`id`, `status`) VALUES
(1, 'ditutup');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sewa_barang`
--

CREATE TABLE `sewa_barang` (
  `id_sewa` int(11) NOT NULL,
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
  `id_talent` int(11) NOT NULL,
  `jenis_talent` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `talent`
--

INSERT INTO `talent` (`id_talent`, `jenis_talent`, `keterangan`) VALUES
(1, 'Penari Tradisional ', 'Penari yang menampilkan tarian tradisional khas daerah.'),
(2, 'modern dance', 'penari hip hop dengan musik modern dan beat cepat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('anggota','pengurus') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'adel', 'wakabid_gerak', 'pengurus'),
(2, 'jenita', 'jenita_123', 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nra` (`nra`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `book_talent`
--
ALTER TABLE `book_talent`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  ADD PRIMARY KEY (`id_item`);

--
-- Indeks untuk tabel `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `materi_latihan`
--
ALTER TABLE `materi_latihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `minat_bakat`
--
ALTER TABLE `minat_bakat`
  ADD PRIMARY KEY (`id_minat_bakat`);

--
-- Indeks untuk tabel `partisipasi`
--
ALTER TABLE `partisipasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- Indeks untuk tabel `sesi_absensi`
--
ALTER TABLE `sesi_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sewa_barang`
--
ALTER TABLE `sewa_barang`
  ADD PRIMARY KEY (`id_sewa`);

--
-- Indeks untuk tabel `talent`
--
ALTER TABLE `talent`
  ADD PRIMARY KEY (`id_talent`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `book_talent`
--
ALTER TABLE `book_talent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `materi_latihan`
--
ALTER TABLE `materi_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `minat_bakat`
--
ALTER TABLE `minat_bakat`
  MODIFY `id_minat_bakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `partisipasi`
--
ALTER TABLE `partisipasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sesi_absensi`
--
ALTER TABLE `sesi_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `sewa_barang`
--
ALTER TABLE `sewa_barang`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `talent`
--
ALTER TABLE `talent`
  MODIFY `id_talent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD CONSTRAINT `evaluasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `partisipasi`
--
ALTER TABLE `partisipasi`
  ADD CONSTRAINT `partisipasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
