-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Jun 2025 pada 10.49
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
  `angkatan` int(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `id_minat_bakat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `nra`, `angkatan`, `user_id`, `id_minat_bakat`) VALUES
(628, 'Chalya Putri Budiani', 'E1D02310182', 2022, 3, 1),
(629, 'Astrida Berlina Wibowo', 'F1E02310074', 2023, 4, 2),
(630, 'Viona Zulfa Salsabilla', 'C1M02310021', 2024, 5, 3),
(631, 'Farrel Putra Wiana', 'C1N02310027', 2022, 6, 4),
(632, 'Hafana Zahra Berlianty', 'F1E02310078', 2023, 7, 1),
(633, 'Siti Hajar Ibrahim', 'E1D02310149', 2024, 8, 2),
(634, 'Praja Alim Zamzani', 'L1A02310134', 2022, 9, 3),
(635, 'Husniah Azriani', 'A1B022132', 2023, 10, 4),
(636, 'Sahida Najwa', 'J1A02310138', 2024, 11, 1),
(637, 'Nida Khairunisa', 'E1D02310220', 2022, 12, 2),
(638, 'Adelia Anggellina Purnama', 'C1G02310165', 2023, 13, 3),
(639, 'Nadya Permata Murti Puspitaningrum', 'J1A02310072', 2024, 14, 4),
(640, 'Athirah Salsabila', 'C1M02310102', 2022, 15, 1),
(641, 'Audira Haerunnisa', 'C1L02310030', 2023, 16, 2),
(642, 'Hana Athaya Nurhalizah', 'H1A02310165', 2024, 17, 3),
(643, 'Putri Dwi Febbia', 'E1E022042', 2022, 18, 4),
(644, 'Ahmad Aldi', 'D1A02310495', 2023, 19, 1),
(645, 'Zidan Ihlasul Amal', 'E1B022256', 2024, 20, 2),
(646, 'Siti Zulya Fatmi', 'D1A022076', 2022, 21, 3),
(647, 'Nurul Aulia', 'D1A022067', 2023, 22, 4),
(648, 'Arya Qisthi Suryanto', 'D1A02310340', 2024, 23, 1),
(649, 'Laili Julianingsih', 'D1A022041', 2022, 24, 2),
(650, 'Dian Rizki Damayani', 'D1A022019', 2023, 25, 3),
(651, 'Zahwa Azzahra', 'A1B02310240', 2024, 26, 4),
(652, 'Annisa Arsylita', 'C1N02310092', 2022, 27, 1),
(654, 'Muhammad Ridho Azkari', 'F1A021195', 2024, 29, 3),
(655, 'Iga Nabila Ouwan Azzahra', 'C1G022020', 2022, 30, 4),
(656, 'Rifal Gibran', 'A1B02310188', 2023, 31, 1),
(657, 'Alivia Zaliyanti', 'C1M02310001', 2024, 32, 2),
(658, 'Imelda Hartawan', 'F1E02310081', 2022, 33, 3),
(659, 'Putri Siti Rabiah', 'D1A022552', 2023, 34, 4),
(660, 'Annisa Rahma Kusuma', 'B1D022063', 2024, 35, 1),
(661, 'Eva Yolanda', 'D1A022396', 2022, 36, 2),
(662, 'Baiq Nazira Oktaviani', 'A1B02310091', 2023, 37, 3),
(663, 'Yasanti Etenia', 'A1C022294', 2024, 38, 4),
(664, 'Nyayu Dian Fermanu', 'E1B022169', 2022, 39, 1),
(665, 'Maulida Apriana', 'E1B022158', 2023, 40, 2),
(666, 'Dara Anggun Adhna Fika', 'E1S022032', 2024, 41, 3),
(667, 'Deya Kalisdia', 'E1S022005', 2022, 42, 4),
(668, 'Riza Aprilia', 'E1S022015', 2023, 43, 1),
(669, 'Baiq Hanisa Yasmin', 'E1S022028', 2024, 44, 2),
(670, 'Shahinaz Syahira', 'E1S022017', 2022, 45, 3),
(671, 'Ricko Muksalminan Jerowarunikus', 'A0E02310111', 2023, 46, 4),
(672, 'Baiq Inggid Putri Zahwa', 'L1A02310107', 2024, 47, 1),
(673, 'Rahadian Hidayatullah', 'F1A02310114', 2022, 48, 2),
(674, 'Nindya Faninda Putri', 'A1C02310173', 2023, 49, 3),
(675, 'Aulianov Ramadhani', 'L1A02310103', 2024, 50, 4),
(677, 'Rosyidah Nur Hairani', 'E1D022036', 2023, 52, 2),
(679, 'Risa Handayani', 'L1C02310087', 2022, 54, 4),
(680, 'Bunga Gea Varesa', 'J1A02310007', 2023, 55, 1),
(681, 'Arjun Hidayatullah', 'L1B02310071', 2024, 56, 2),
(682, 'Lalu Muhammad Fachrian Surya Lingga', 'F1C02310068', 2022, 57, 3),
(683, 'Nur Shopya Afifaturrahmah', 'G1A022008', 2023, 58, 4),
(684, 'Susan Tiara Nelpiana', 'D1A022295', 2024, 59, 1),
(685, 'Baiq Moza Fatima Dwi Kamalia', 'L1A02310007', 2022, 60, 2),
(686, 'Sandrina Kartikasari Pujiono', 'A1B02310193', 2023, 61, 3),
(687, 'Siti Fatimatuzzakhro', 'E1B02310124', 2024, 62, 4),
(688, 'Heppy Tasya Pibiputri', 'G1E022027', 2022, 63, 1),
(689, 'Lalu Sadad Fathoni', 'G1E02310024', 2023, 64, 2),
(690, 'Mayzania Safitri', 'J1A02310017', 2024, 65, 3),
(691, 'Tri Jannatun Mardiah', 'J1A02310028', 2022, 66, 4),
(692, 'Rahayu Wahida Putri Maulana', 'C1M02310075', 2023, 67, 1),
(693, 'Reinanda Taufara Akbar', 'L1A02310136', 2024, 68, 2),
(694, 'Rendi Setiawan', 'A0E02310074', 2022, 69, 3),
(695, 'Mario Benediktus Rawa Gana', 'E1D02310107', 2023, 70, 4),
(696, 'Keishe Tita Violeta', 'E1C02310084', 2024, 71, 1),
(697, 'Baiq Fitriana Dila', 'J1A02310005', 2022, 72, 2),
(698, 'Diaz Risky Atallah', 'L1B022041', 2023, 73, 3),
(699, 'Ananda Farzana Azzyaty', 'E1D022005', 2024, 74, 4),
(700, 'Annisa Febrina Hidayat', 'E1D022008', 2022, 75, 1),
(701, 'Maya Delfira Putri', 'J1A02310016', 2023, 76, 2),
(702, 'Fatimah Az Zahra', 'F1C022112', 2024, 77, 3),
(703, 'Baiq Dafina Salsabila', 'A1C02310053', 2022, 78, 4),
(704, 'Zyasa Dwinta Khaliesta', 'E1B022186', 2023, 79, 1),
(705, 'Ahmad Reza Mahendra', 'E1A022094', 2024, 80, 2),
(706, 'Nyoman Aldi Pradipta', 'A1B02310179', 2022, 81, 3),
(707, 'Adelia Anatia Safitri', 'D1A02310089', 2023, 82, 4),
(708, 'Ni Nyoman Ayu Mega Lestari', 'C1G022125', 2024, 83, 1),
(709, 'Wilda Aprilianda', 'E1S02310092', 2022, 84, 2),
(710, 'Siti Raehanun', 'L1C022087', 2023, 85, 3),
(711, 'Nilam Saqinah Maharani', 'C1B022016', 2024, 86, 4),
(712, 'Meili Angelina Rahma', 'C1K02310041', 2022, 87, 1),
(713, 'Felicia Melinda Coulina Putri', 'J1A02310009', 2023, 88, 2),
(714, 'Komang Dewi Triendra Hari', 'J1A02310014', 2024, 89, 3),
(715, 'Maria Anastasia Maya Mau', 'J1A02310015', 2022, 90, 4),
(716, 'Yayu Dwi Wahyuni', 'A1A021269', 2023, 91, 1),
(717, 'Radika Dewi A', 'A1A021242', 2024, 92, 2),
(718, 'Witri Widyastuti', 'A1A021255', 2022, 93, 3),
(719, 'Marselena Primasati Utari', 'F1A02310090', 2023, 94, 4),
(720, 'Ni Kadek Gita Sri Persada', 'A1B022184', 2024, 95, 1),
(721, 'Nela Febiola', 'A1B022183', 2022, 96, 2),
(722, 'Ni Nengah Dira Windriani', 'A1B022187', 2023, 97, 3),
(723, 'Asty Murniati', 'E1E022225', 2024, 98, 4),
(724, 'M Algifari', 'E1C022078', 2022, 99, 1),
(725, 'Eki Wahardani', 'A0E02310041', 2023, 100, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(100) NOT NULL,
  `kepala_bidang` varchar(100) NOT NULL,
  `wakil_kepala_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `nama_bidang`, `kepala_bidang`, `wakil_kepala_bidang`) VALUES
(1, 'Gerak', 'Budi Santoso', 'Lina Kartika'),
(2, 'Suara', 'Teguh Saputra', 'Siti Aisyah'),
(3, 'Terapan', 'Indra Wijaya', 'Dewi Ambarwati');

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
-- Struktur dari tabel `jadwal_kondisional`
--

CREATE TABLE `jadwal_kondisional` (
  `id` int(11) NOT NULL,
  `id_minat_bakat` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_kondisional`
--

INSERT INTO `jadwal_kondisional` (`id`, `id_minat_bakat`, `tanggal`, `jam`, `keterangan`) VALUES
(1, 1, '2025-05-25', '14:00:00', 'Latihan tambahan untuk Tari Tradisional'),
(2, 3, '2025-05-27', '16:30:00', 'Latihan khusus persiapan kompetisi Modern Dance'),
(3, 5, '2025-06-01', '10:00:00', 'Workshop akting untuk Teater'),
(4, 7, '2025-06-03', '13:00:00', 'Pengambilan footage dokumentasi untuk Videografi'),
(5, 10, '2025-06-05', '15:30:00', 'Latihan intensif persiapan konser Musik Band');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_latihan`
--

CREATE TABLE `jadwal_latihan` (
  `id` int(11) NOT NULL,
  `bidang_minat` varchar(100) NOT NULL,
  `jam` time NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_latihan`
--

INSERT INTO `jadwal_latihan` (`id`, `bidang_minat`, `jam`, `tanggal`) VALUES
(1, 'Tari Tradisional', '15:00:00', NULL),
(2, 'Modern Dance', '16:30:00', NULL),
(3, 'Kontemporer', '18:00:00', NULL),
(4, 'Requested', '14:00:00', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_rutin`
--

CREATE TABLE `jadwal_rutin` (
  `id` int(11) NOT NULL,
  `id_minat_bakat` int(11) NOT NULL,
  `durasi_latihan` int(11) NOT NULL,
  `mentor` varchar(100) NOT NULL,
  `id_bidang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_rutin`
--

INSERT INTO `jadwal_rutin` (`id`, `id_minat_bakat`, `durasi_latihan`, `mentor`, `id_bidang`) VALUES
(8, 1, 2, 'Budi Santoso', 1),
(9, 2, 3, 'Siti Aisyah', 1),
(10, 3, 2, 'Rizky Pratama', 1),
(11, 5, 2, 'Indra Wijaya', 3),
(12, 6, 2, 'Dewi Ambarwati', 3),
(13, 7, 2, 'Teguh Saputra', 3),
(14, 8, 2, 'Lina Kartika', 3),
(15, 10, 3, 'Aldi Ramadhan', 2),
(16, 11, 2, 'Rina Putri', 2),
(17, 12, 2, 'Farhan Malik', 2);

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
  `id_minat_bakat` int(11) NOT NULL,
  `id_bidang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `minat_bakat`
--

INSERT INTO `minat_bakat` (`nama_minat_bakat`, `enrollment_key`, `id_minat_bakat`, `id_bidang`) VALUES
('Tari Tradisional', 'TRAD2025', 1, 1),
('Modern Dance', 'MD2025', 2, 1),
('Kontemporer', 'KONT2025', 3, 1),
('Requested', 'REQ2025', 4, 1),
('Teater', 'TEAT2025', 5, 3),
('Fotografi', 'PHOTO2025', 6, 3),
('Videografi', 'VIDEO2025', 7, 3),
('Make Up Artist', 'MUA2025', 8, 3),
('Lukis', 'ART2025', 9, 3),
('Musik Band', 'BAND2025', 10, 2),
('Vokal', 'VOCAL2025', 11, 2),
('Alat Musik', 'INSTR2025', 12, 2);

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
-- Struktur dari tabel `program_kerja`
--

CREATE TABLE `program_kerja` (
  `id` int(11) NOT NULL,
  `nama_program` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `pj_pengurus` int(11) DEFAULT NULL,
  `ketua_panitia` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal_selesai_agenda` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `program_kerja`
--

INSERT INTO `program_kerja` (`id`, `nama_program`, `tanggal_mulai`, `tanggal_selesai`, `deskripsi`, `pj_pengurus`, `ketua_panitia`, `status`, `tanggal_selesai_agenda`) VALUES
(1, 'Pelatihan Dasar', '2024-07-01', '2024-07-05', 'Pelatihan dasar untuk anggota baru.', NULL, NULL, 'Perencanaan', NULL),
(2, 'Festival Seni', '2024-08-10', '2024-08-12', 'Festival seni tahunan.', NULL, NULL, 'Perencanaan', NULL),
(3, 'Pengabdian Masyarakat', '2024-09-01', '2024-09-03', 'Kegiatan sosial di desa binaan.', NULL, NULL, 'Perencanaan', NULL),
(4, 'Workshop Musik', '2024-10-15', '2024-10-16', 'Workshop musik bersama mentor nasional.', NULL, NULL, 'Perencanaan', NULL),
(5, 'Lomba Tari', '2024-11-20', '2024-11-21', 'Lomba tari antar sekolah.', NULL, NULL, 'Perencanaan', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress_proker`
--

CREATE TABLE `progress_proker` (
  `id` int(11) NOT NULL,
  `id_program` int(11) NOT NULL,
  `laporan` text DEFAULT NULL,
  `tanggal_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `progress_proker`
--

INSERT INTO `progress_proker` (`id`, `id_program`, `laporan`, `tanggal_update`) VALUES
(1, 2, 'FAN AEHFIJJF', '2025-06-02 22:10:13'),
(2, 2, 'FAN AEHFIJJF', '2025-06-02 22:13:39'),
(3, 2, 'kknca;sh AJSIJfaJS DO', '2025-06-02 22:13:47'),
(4, 2, 'asncAJSN JADJAMDakndia ', '2025-06-02 22:15:11'),
(5, 1, 'annajya', '2025-06-02 22:26:17');

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
(2, 'jenita', 'jenita_123', 'anggota'),
(3, 'chalya_putri_budiani', 'E1D02310182', 'anggota'),
(4, 'astrida_berlina_wibowo', 'F1E02310074', 'anggota'),
(5, 'viona_zulfa_salsabilla', 'C1M02310021', 'anggota'),
(6, 'farrel_putra_wiana', 'C1N02310027', 'anggota'),
(7, 'hafana_zahra_berlianty', 'F1E02310078', 'anggota'),
(8, 'siti_hajar_ibrahim', 'E1D02310149', 'anggota'),
(9, 'praja_alim_zamzani', 'L1A02310134', 'anggota'),
(10, 'husniah_azriani', 'A1B022132', 'anggota'),
(11, 'sahida_najwa', 'J1A02310138', 'anggota'),
(12, 'nida_khairunisa', 'E1D02310220', 'anggota'),
(13, 'adelia_anggellina_purnama', 'C1G02310165', 'anggota'),
(14, 'nadya_permata_murti_puspitaningrum', 'J1A02310072', 'anggota'),
(15, 'athirah_salsabila', 'C1M02310102', 'anggota'),
(16, 'audira_haerunnisa', 'C1L02310030', 'anggota'),
(17, 'hana_athaya_nurhalizah', 'H1A02310165', 'anggota'),
(18, 'putri_dwi_febbia', 'E1E022042', 'anggota'),
(19, 'ahmad_aldi', 'D1A02310495', 'anggota'),
(20, 'zidan_ihlasul_amal', 'E1B022256', 'anggota'),
(21, 'siti_zulya_fatmi', 'D1A022076', 'anggota'),
(22, 'nurul_aulia', 'D1A022067', 'anggota'),
(23, 'arya_qisthi_suryanto', 'D1A02310340', 'anggota'),
(24, 'laili_julianingsih', 'D1A022041', 'anggota'),
(25, 'dian_rizki_damayani', 'D1A022019', 'anggota'),
(26, 'zahwa_azzahra', 'A1B02310240', 'anggota'),
(27, 'annisa_arsylita', 'C1N02310092', 'anggota'),
(28, 'muhammad_aydir', '', 'anggota'),
(29, 'muhammad_ridho_azkari', 'F1A021195', 'anggota'),
(30, 'iga_nabila_ouwan_azzahra', 'C1G022020', 'anggota'),
(31, 'rifal_gibran', 'A1B02310188', 'anggota'),
(32, 'alivia_zaliyanti', 'C1M02310001', 'anggota'),
(33, 'imelda_hartawan', 'F1E02310081', 'anggota'),
(34, 'putri_siti_rabiah', 'D1A022552', 'anggota'),
(35, 'annisa_rahma_kusuma', 'B1D022063', 'anggota'),
(36, 'eva_yolanda', 'D1A022396', 'anggota'),
(37, 'baiq_nazira_oktaviani', 'A1B02310091', 'anggota'),
(38, 'yasanti_etenia', 'A1C022294', 'anggota'),
(39, 'nyayu_dian_fermanu', 'E1B022169', 'anggota'),
(40, 'maulida_apriana', 'E1B022158', 'anggota'),
(41, 'dara_anggun_adhna_fika', 'E1S022032', 'anggota'),
(42, 'deya_kalisdia', 'E1S022005', 'anggota'),
(43, 'riza_aprilia', 'E1S022015', 'anggota'),
(44, 'baiq_hanisa_yasmin', 'E1S022028', 'anggota'),
(45, 'shahinaz_syahira', 'E1S022017', 'anggota'),
(46, 'ricko_muksalminan_jerowarunikus', 'A0E02310111', 'anggota'),
(47, 'baiq_inggid_putri_zahwa', 'L1A02310107', 'anggota'),
(48, 'rahadian_hidayatullah', 'F1A02310114', 'anggota'),
(49, 'nindya_faninda_putri', 'A1C02310173', 'anggota'),
(50, 'aulianov_ramadhani', 'L1A02310103', 'anggota'),
(51, 'peri_rusdijulianto', '', 'anggota'),
(52, 'rosyidah_nur_hairani', 'E1D022036', 'anggota'),
(53, 'm_khairul_tamimi_pranata', '', 'anggota'),
(54, 'risa_handayani', 'L1C02310087', 'anggota'),
(55, 'bunga_gea_varesa', 'J1A02310007', 'anggota'),
(56, 'arjun_hidayatullah', 'L1B02310071', 'anggota'),
(57, 'lalu_muhammad_fachrian_surya_lingga', 'F1C02310068', 'anggota'),
(58, 'nur_shopya_afifaturrahmah', 'G1A022008', 'anggota'),
(59, 'susan_tiara_nelpiana', 'D1A022295', 'anggota'),
(60, 'baiq_moza_fatima_dwi_kamalia', 'L1A02310007', 'anggota'),
(61, 'sandrina_kartikasari_pujiono', 'A1B02310193', 'anggota'),
(62, 'siti_fatimatuzzakhro', 'E1B02310124', 'anggota'),
(63, 'heppy_tasya_pibiputri', 'G1E022027', 'anggota'),
(64, 'lalu_sadad_fathoni', 'G1E02310024', 'anggota'),
(65, 'mayzania_safitri', 'J1A02310017', 'anggota'),
(66, 'tri_jannatun_mardiah', 'J1A02310028', 'anggota'),
(67, 'rahayu_wahida_putri_maulana', 'C1M02310075', 'anggota'),
(68, 'reinanda_taufara_akbar', 'L1A02310136', 'anggota'),
(69, 'rendi_setiawan', 'A0E02310074', 'anggota'),
(70, 'mario_benediktus_rawa_gana', 'E1D02310107', 'anggota'),
(71, 'keishe_tita_violeta', 'E1C02310084', 'anggota'),
(72, 'baiq_fitriana_dila', 'J1A02310005', 'anggota'),
(73, 'diaz_risky_atallah', 'L1B022041', 'anggota'),
(74, 'ananda_farzana_azzyaty', 'E1D022005', 'anggota'),
(75, 'annisa_febrina_hidayat', 'E1D022008', 'anggota'),
(76, 'maya_delfira_putri', 'J1A02310016', 'anggota'),
(77, 'fatimah_az_zahra', 'F1C022112', 'anggota'),
(78, 'baiq_dafina_salsabila', 'A1C02310053', 'anggota'),
(79, 'zyasa_dwinta_khaliesta', 'E1B022186', 'anggota'),
(80, 'ahmad_reza_mahendra', 'E1A022094', 'anggota'),
(81, 'nyoman_aldi_pradipta', 'A1B02310179', 'anggota'),
(82, 'adelia_anatia_safitri', 'D1A02310089', 'anggota'),
(83, 'ni_nyoman_ayu_mega_lestari', 'C1G022125', 'anggota'),
(84, 'wilda_aprilianda', 'E1S02310092', 'anggota'),
(85, 'siti_raehanun', 'L1C022087', 'anggota'),
(86, 'nilam_saqinah_maharani', 'C1B022016', 'anggota'),
(87, 'meili_angelina_rahma', 'C1K02310041', 'anggota'),
(88, 'felicia_melinda_coulina_putri', 'J1A02310009', 'anggota'),
(89, 'komang_dewi_triendra_hari', 'J1A02310014', 'anggota'),
(90, 'maria_anastasia_maya_mau', 'J1A02310015', 'anggota'),
(91, 'yayu_dwi_wahyuni', 'A1A021269', 'anggota'),
(92, 'radika_dewi_a', 'A1A021242', 'anggota'),
(93, 'witri_widyastuti', 'A1A021255', 'anggota'),
(94, 'marselena_primasati_utari', 'F1A02310090', 'anggota'),
(95, 'ni_kadek_gita_sri_persada', 'A1B022184', 'anggota'),
(96, 'nela_febiola', 'A1B022183', 'anggota'),
(97, 'ni_nengah_dira_windriani', 'A1B022187', 'anggota'),
(98, 'asty_murniati', 'E1E022225', 'anggota'),
(99, 'm_algifari', 'E1C022078', 'anggota'),
(100, 'eki_wahardani', 'A0E02310041', 'anggota'),
(101, 'made_rama_adika_putra', 'J1A02310065', 'anggota'),
(102, 'winda_lestari_ningsih', 'E1E02310055', 'anggota'),
(103, 'alia_ardianti_humairo', 'F1E02310019', 'anggota'),
(104, 'lu_luul_jannah', 'E1B022077', 'anggota'),
(105, 'nurul_wahdiah_riz_lestari', 'D1A022544', 'anggota'),
(106, 'tiara_andriani_isnawati', 'A1B02310055', 'anggota'),
(107, 'razyka_albani', 'A1B02310040', 'anggota'),
(108, 'al_humairah_tsaniatul_fallah', 'E1B02310038', 'anggota'),
(109, 'aedia_asri', 'C1L022019', 'anggota'),
(110, 'liza_hanim', 'E1D02310208', 'anggota'),
(111, 'amri_aziz', 'E1C022040', 'anggota'),
(112, 'lalu_raja_baehaki', 'A1A021111', 'anggota'),
(113, 'auryn_zultifha_rahmani', 'J1A022033', 'anggota'),
(114, 'kania_putri_rohimatuz_azzahra_hamdani', 'F1D02310065', 'anggota'),
(115, 'nadiva_risky_aulia', 'F1A02310103', 'anggota'),
(116, 'arnesya_farrelia_nasroh', 'G1C02310001', 'anggota'),
(117, 'baiq_suryatami', 'A0C02310027', 'anggota'),
(118, 'pita_nopiana', 'F1A02310184', 'anggota'),
(119, 'ni_kd_widia_arsita', 'F1E02310011', 'anggota'),
(120, 'ni_nyoman_cika_ariani', 'A1B02310171', 'anggota'),
(121, 'dina_rahidatul_adiat', 'D1A022020', 'anggota'),
(122, 'mariyana', 'A1B022164', 'anggota'),
(123, 'mardiatul_jannah', 'A1B022162', 'anggota'),
(124, 'nabila', 'A1B022175', 'anggota'),
(125, 'nadia_ananda', 'A1B022178', 'anggota'),
(126, 'melida_susanti', 'A1B022166', 'anggota'),
(127, 'lalu_muhammad_nafi_rabbani', 'E1S02310109', 'anggota'),
(128, 'ataya_aulia_maryadi', 'G1A02310032', 'anggota'),
(129, 'baiq_annisa_aulia_larasati', 'G1A02310012', 'anggota'),
(130, 'rafly_ifti_aljihadi', 'E1S02310079', 'anggota'),
(131, 'i_nyoman_laviandra_surya_arimbawa', 'L1B02310080', 'anggota'),
(132, 'maedina_junaedi', 'A1A022026', 'anggota'),
(133, 'radia_izzatul_husna', 'A1B022194', 'anggota'),
(134, 'baiq_luthfida_khairunnisa', 'F1D022037', 'anggota'),
(135, 'i_gusti_ayu_maesya_andini', 'E1R02310014', 'anggota'),
(136, 'baiq_subbidia_ulfi', 'L1C022036', 'anggota'),
(137, 'danang_setiawan', '', 'anggota'),
(138, 'ismul_azam', 'E1C02310167', 'anggota'),
(139, 'lalu_zhafran_farras_rahman', 'F1D021050', 'anggota'),
(140, 'aini_kurniawati', 'G1C022015', 'anggota'),
(141, 'dhea_desvita_juniati', 'E1B022138', 'anggota'),
(142, 'khanza_rayes', 'C1G022201', 'anggota'),
(143, 'arlina_zikria_wulandari', '', 'anggota'),
(144, 'laela_fitriani', '', 'anggota'),
(145, 'salwa_nabila_aulia_rachim', 'A1C022042', 'anggota'),
(146, 'ramadhani_indah_putri_aji', 'A1C02310110', 'anggota'),
(147, 'baiq_zaka_an_nisaa', 'A1A021187', 'anggota'),
(148, 'prawira_adji_lamandika', 'C1G02310141', 'anggota'),
(149, 'shofia_akmal_samanhudi', 'F1A022032', 'anggota'),
(150, 'rizqika_aprilia', 'F1A022027', 'anggota'),
(151, 'audina_jelita', 'F1D02310039', 'anggota'),
(152, 'ayu_hafifah', 'D1A022104', 'anggota'),
(153, 'ni_nyoman_puja_meviyanti', 'D1A02310254', 'anggota'),
(154, 'ni_wayan_utari_dewi_yanti', 'D1A02310257', 'anggota'),
(155, 'i_gusti_ayu_intan_septiani_putri', 'L1C02310054', 'anggota'),
(156, 'candrika_ripasyah', 'A0C022082', 'anggota'),
(157, 'dida_ardani_immawansyah', 'L1B02310030', 'anggota'),
(158, 'mutiara_azzahra_kasih', '', 'anggota'),
(159, 'sofia_aulia_citra', 'A1C02310124', 'anggota'),
(160, 'dea_sucita_bissaema', 'E1F022080', 'anggota'),
(161, 'eliza_iskayanti', 'J1A021030', 'anggota'),
(162, 'samuel_ezra_christian', 'H1B02310049', 'anggota'),
(163, 'kenanga_findi_artifa', 'A1B02310134', 'anggota'),
(164, 'miteknikahul_aini', 'D1A02310044', 'anggota'),
(165, 'muhamad_iqbal', '', 'anggota'),
(166, 'lalu_abizaar_adhin_bhijannifa', 'E1A022113', 'anggota'),
(167, 'i_gusti_agung_ananta_semeru_tanuwijaya', 'F1A02310069', 'anggota'),
(168, 'lalu_aqsha_nayaka_maulana', 'F1D02310069', 'anggota'),
(169, 'annisa_purnama_sari', 'E1C022043', 'anggota'),
(170, 'withadarma_seva', 'L1B02310061', 'anggota'),
(171, 'suci_ramdiani', 'E1C022122', 'anggota'),
(172, 'siti_sabrina_turatea', 'D1A02310292', 'anggota'),
(173, 'nazwa_farahdila', 'A1B02310029', 'anggota'),
(174, 'dea_ajeng_saqinah', 'D1A021120', 'anggota'),
(175, 'mariani', '', 'anggota'),
(176, 'fatikamaira_nallea_deefany', 'L1B02310033', 'anggota'),
(177, 'gheyzna_scharsza_gheyna', 'L1B02310035', 'anggota'),
(178, 'amrani_kania_aerinti', 'L1B02310024', 'anggota'),
(179, 'nada_farid_huraibi', 'A1B02310160', 'anggota'),
(180, 'amorina_putri_tarizka_wirasetya', 'L1B022027', 'anggota'),
(181, 'ni_kadek_rahayu_ari_ningsih', 'A1B02310261', 'anggota'),
(182, 'siti_fatimah', 'L1C019109', 'anggota'),
(183, 'baiq_dende_surya_pertiwi', 'E1D022067', 'anggota'),
(184, 'rendi_christian_ngaba', 'A1B02310270', 'anggota'),
(185, 'tifani_alivia_salsabila', 'L1A02310091', 'anggota'),
(186, 'erik_koeswanto', 'L1C022154', 'anggota'),
(187, 'mislahul_ihsan_agustira', 'L1B021054', 'anggota'),
(188, 'i_komang_erhardi_pakusadewo_darta', 'A1B02310121', 'anggota'),
(189, 'hanum_salsabila_yamin', 'J1A02310052', 'anggota'),
(190, 'malikkah_noviya_rizkami_putri', 'G1C02310040', 'anggota'),
(191, 'intan_dhea_afninda_ananda', 'L1B022120', 'anggota'),
(192, 'hayatun_nupus', 'J1A02310055', 'anggota'),
(193, 'ega_syah_rial', 'E1C021226', 'anggota'),
(194, 'putri_mariani_wulandari', 'A1A022231', 'anggota'),
(195, 'ni_made_dwitya_pratami_putri', 'C1G02310137', 'anggota'),
(196, 'rica_salwani', 'E1D022231', 'anggota'),
(197, 'wiwit_aprilia_saputri', 'A1A022247', 'anggota'),
(198, 'baiq_halifa_yudisthia_ningrum', 'L1B022006', 'anggota'),
(199, 'putri_alifia_hoolyan', 'E1E02310149', 'anggota'),
(200, 'anantya_salsabilla', 'C1G022007', 'anggota'),
(201, 'dwifa_ratna_azzahra', 'A1B022116', 'anggota'),
(202, 'sesy_alecya', 'C1G022151', 'anggota'),
(203, 'alia_nabila_putri', 'D1A022095', 'anggota'),
(204, 'cindy_natasya_aulia_putri', 'F1D02310109', 'anggota'),
(205, 'raquan_mulachela', 'L1B02310013', 'anggota'),
(206, 'baiq_najwa_fatiya_winanti', 'C1G02310005', 'anggota'),
(207, 'sania_salsabila_mardita', 'G1E022044', 'anggota'),
(208, 'bq_amanda_orien_rahmadina', 'A1B021271', 'anggota'),
(209, 'sufiana_pratita_cahya_auliya', 'G1E022082', 'anggota'),
(210, 'muhammad_ajjibar_akbar', 'A1B02310295', 'anggota'),
(211, 'arni_aprillia', 'C1G02310064', 'anggota'),
(212, 'ardiatun_wasiah', 'E1Q02310063', 'anggota'),
(213, 'rani_surya_lestari', 'C1G02310144', 'anggota'),
(214, 'salma_firdaus', 'F1A022194', 'anggota'),
(215, 'muhammad_radinal_assidiqi', 'A1B02310155', 'anggota'),
(216, 'baiq_nazwa_novita', 'A1B02310092', 'anggota'),
(217, 'ni_nyoman_yunita_aswina_putri', 'A1B02310031', 'anggota'),
(218, 'rohin_novia_maydi_putri', 'E1S020064', 'anggota'),
(219, 'eka_mutiara_putri_wahyudi', 'E1F022085', 'anggota'),
(220, 'rabiatul_adawiyah', '', 'anggota'),
(221, 'aqillah_deani_alfarosa', 'E1B02310042', 'anggota'),
(222, 'yuliana', '', 'anggota'),
(223, 'salwa_nur_amraini', 'E1E022180', 'anggota'),
(224, 'ni_luh_dewi_nitari', 'D1A02310252', 'anggota'),
(225, 'agil_rozan_pahlevi', 'D1A02310321', 'anggota'),
(226, 'susanti', '', 'anggota'),
(227, 'lubna_rahmatul_apriliani', 'F1E02310043', 'anggota'),
(228, 'ardina_amelia', 'F1F02310039', 'anggota'),
(229, 'aulia_syahruni', 'D1A022010', 'anggota'),
(230, 'i_made_agus_radhitya_penlaka', 'F1E02310034', 'anggota'),
(231, 'baiq_dhifa_isnawati', 'E1B022199', 'anggota'),
(232, 'laela_ulfi_julianti_aisyah', 'A1A022099', 'anggota'),
(233, 'helda_apriani', 'E1E022109', 'anggota'),
(234, 'sabrina_juanita_nitbani', 'L1B02310054', 'anggota'),
(235, 'siti_rahmah', 'E1D022156', 'anggota'),
(236, 'valia_alza_rahma', 'E1D02410159', 'anggota'),
(237, 'kayla_zahra_yamani', 'H1B02410037', 'anggota'),
(238, 'queenina_aulia_hidayat', 'E1E02410166', 'anggota'),
(239, 'naomi_nanda_ida_santoso', 'D1A02410246', 'anggota'),
(240, 'dinda_fitria', 'F1A02410057', 'anggota'),
(241, 'hafizul_fadli', 'E1D02310088', 'anggota'),
(242, 'tiara', '', 'anggota'),
(243, 'samsul_hadi', '', 'anggota'),
(244, 'latifahul_amalia', 'E1E02410255', 'anggota'),
(245, 'ichal_oktavia_ramdhani', 'E1D02410098', 'anggota'),
(246, 'weni_eka_pratiwi', 'F1A02410037', 'anggota'),
(247, 'ade_putra', 'E1C02410001', 'anggota'),
(248, 'st_aisyah_isyawal', 'F1A022035', 'anggota'),
(249, 'suci_nuraini', 'A0E02410071', 'anggota'),
(250, 'irjan_hamdani', 'E1D02410237', 'anggota'),
(251, 'i_komang_tegar_agustyawan', 'A0E02310050', 'anggota'),
(252, 'ni_komang_ayu_fiorentina', 'D1A02410255', 'anggota'),
(253, 'shifa_tsuroyya_zahra', 'A1B02310195', 'anggota'),
(254, 'yana_fitri_rahma', 'E1E02310188', 'anggota'),
(255, 'febriand_bawa_laksana', 'L1A02310053', 'anggota'),
(256, 'irfan_mauliddin', 'D1C02410093', 'anggota'),
(257, 'ni_luh_widia_ayu_marsela', 'A1C02410172', 'anggota'),
(258, 'putri_zahrani', 'A1B02310182', 'anggota'),
(259, 'radit_putra_dwinardi', 'A1C02410177', 'anggota'),
(260, 'sabriatin_warohmah', 'A1C02410181', 'anggota'),
(261, 'agiskiranti_sirajuddin_putri', 'D1C02410002', 'anggota'),
(262, 'baiq_laela_amalia', 'A0D02410092', 'anggota'),
(263, 'athila_riefhan', 'F1B02410039', 'anggota'),
(264, 'm_abdul_faruk', 'E1C02410023', 'anggota'),
(265, 'andra_rahmadani_ saputro', 'D1C02410082', 'anggota'),
(266, 'zara_aqila_selvia', 'E1C02310135', 'anggota'),
(267, 'agus_supriyanto', 'E1R02410031', 'anggota'),
(268, 'eka_selvyana_agustin', 'F1A02410148', 'anggota'),
(269, 'muhammad_wardiansyah', 'E1S022122', 'anggota'),
(270, 'indri_agusthreea_rahmi', 'A0C02310039', 'anggota'),
(271, 'alfonso_krison_wicaksana', 'D1A02410005', 'anggota'),
(272, 'putri_karimatullah', 'L1A022075', 'anggota'),
(273, 'yeni_eriawati', 'J1A02410085', 'anggota'),
(274, 'gabriel_christiputro_adi_purmantara', 'D1A02410366', 'anggota'),
(275, 'anggun_susi_wardani', 'A1A02410002', 'anggota'),
(276, 'nabilla_rati_oktavia', 'A0D02310130', 'anggota'),
(277, 'fitri_ayu_nopiyanti', 'E1D02310083', 'anggota'),
(278, 'zhidan_hanafi', 'D1C02410077', 'anggota'),
(279, 'nurul_khopipah', 'E1C02310114', 'anggota'),
(280, 'sumaini', 'D1B02410028', 'anggota'),
(281, 'carmia_nathania', 'D1A02410020', 'anggota'),
(282, 'rohatul_laeli', 'E1B02410025', 'anggota'),
(283, 'muhammad_tio_hendrawan', 'A0E02410053', 'anggota'),
(284, 'monca_siti_nayla_syallini', 'A0E02410048', 'anggota'),
(285, 'miranti_auliya_bilqist', 'D1A02410213', 'anggota'),
(286, 'arya_ramadi_nova_pratama', 'F1B02310040', 'anggota'),
(287, 'arfi_syamsu', 'D1A02410339', 'anggota'),
(288, 'baiq_astried_maulidina', 'D1A02410125', 'anggota'),
(289, 'davina_fairuzellia_nugraha', 'D1A02410023', 'anggota'),
(290, 'lalu_wja_alpi_kurnia', 'C1K021040', 'anggota'),
(291, 'reyvaldo_basry', 'A1B02310187', 'anggota'),
(292, 'r_dimas_bany_adhiman', 'A1B02310039', 'anggota'),
(293, 'syifaul_fadhila', 'E1E02310180', 'anggota'),
(294, 'aulia_rizkia_pebriani', 'E1E02310006', 'anggota'),
(295, 'arya_genta_sulendra', 'D1C02410028', 'anggota'),
(296, 'nabilah_dwiaqilah_sulandari', 'A1B02410146', 'anggota'),
(297, 'nadila_dwi_wulandari', 'D1A02310246', 'anggota'),
(298, 'ni_made_nanda_amrita_dewi', 'D1C02410063', 'anggota'),
(299, 'rahmadin_nur_firdaus', 'D1A02410075', 'anggota'),
(300, 'raisa_husgina_pratiwi', 'D1A02410076', 'anggota'),
(301, 'ni_kadek_osi_nila_dewi', 'E1C02410109', 'anggota'),
(302, 'rosdiana_khairunnisa', 'F1A022028', 'anggota'),
(303, 'suryani', '', 'anggota'),
(304, 'muhammad_ilman_husainy', 'C1M02410129', 'anggota'),
(305, 'akhdan_muammar', 'E1S02410098', 'anggota'),
(306, 'abi_kiram_awali', 'C1G02410047', 'anggota'),
(307, 'imtihan_novita_febrianti', 'D1A02410475', 'anggota'),
(308, 'jelita', '', 'anggota'),
(309, 'alin_daniela_safitri', 'D1B02410035', 'anggota'),
(310, 'hifzillisan', 'E1F02410042', 'anggota'),
(311, 'arieska_milani_putri', 'E1S02310099', 'anggota'),
(312, 'i_gusti_ayu_rahayu_devi_komaris', 'D1A02410159', 'anggota'),
(313, 'hikmah_nur_islamiah', 'D1A02410157', 'anggota'),
(314, 'rabiatun_adawiyah', 'L1B02310012', 'anggota'),
(315, 'resti_julia_agustiandini', 'L1B02310014', 'anggota'),
(316, 'dewi_rindiani', 'L1B02310029', 'anggota'),
(317, 'arvin_farrelo', 'L1B02310001', 'anggota'),
(318, 'baiq_larashati', '', 'anggota'),
(319, 'gallen_nathaniel_n', 'L1B02310034', 'anggota'),
(320, 'muhammad_lukman_roja', 'C1B02410011', 'anggota'),
(321, 'bisma_marfa_diswa', 'E1E02410223', 'anggota'),
(322, 'mia_aprianti', 'D1A02410211', 'anggota'),
(323, 'dwi_erna_agustina', 'E1D02310075', 'anggota'),
(324, 'mushariatin_juliana', 'D1A02310240', 'anggota'),
(325, 'winda_pratama_que_sengkey', 'D1B02410099', 'anggota'),
(326, 'shofiyatul_jannah', 'A0D02410070', 'anggota'),
(327, 'maylina_zahrani', 'D1A02310219', 'anggota'),
(328, 'lola_juliarta', 'E1E02410127', 'anggota'),
(329, 'farel_aliyavi', 'C1G02410185', 'anggota'),
(330, 'dina_haerunnisa', 'E1D02310073', 'anggota'),
(331, 'kayla_aisha_nugroho', 'D1A02310187', 'anggota'),
(332, 'triana_chintya_devi', 'A1C02410124', 'anggota'),
(333, 'mila_ulfayanti', 'L1C02310071', 'anggota'),
(334, 'dewa_ayu_anastasya_rahayu', 'D1C02410036', 'anggota'),
(335, 'khaela_anjani', 'E1D02310198', 'anggota'),
(336, 'lalu_abdul_muhaimin', 'E1S02410115', 'anggota'),
(337, 'zahwa_suhandany_alkatiri', 'D1A02310429', 'anggota'),
(338, 'luthfa_ramadhini', 'D1A02310211', 'anggota'),
(339, 'wafa_meisyah_rani', 'E1D02310255', 'anggota'),
(340, 'febry_putri_kayanti', 'F1F02410057', 'anggota'),
(341, 'basri_ramadhan', 'B1D02310084', 'anggota'),
(342, 'farra_khansa_syadzwina', 'D1A02410146', 'anggota'),
(343, 'm_aqila_isna_karinda', 'F1E02410076', 'anggota'),
(344, 'ida_ayu_putri_saraswati', 'A1B02410109', 'anggota'),
(345, 'ester_veronica_tung', 'A1B02410093', 'anggota'),
(346, 'yuna_afrialia_putri', 'A0D02310152', 'anggota'),
(347, 'baiq_harliana_anhar', 'D1A02410129', 'anggota'),
(348, 'muhammad_fauzan_adika', 'E1S02410016', 'anggota'),
(349, 'maslihatul_khoiriyah', 'F1B02410065', 'anggota'),
(350, 'meiliza_mustika_perwita', 'F1B02410066', 'anggota'),
(351, 'dinda_juliana_novita', 'E1S022103', 'anggota'),
(352, 'maesa_fazlika_dhatina', 'C1G02410014', 'anggota'),
(353, 'kezia_setianingtias', 'D1C02410047', 'anggota'),
(354, 'saopi', 'E1C02310123', 'anggota'),
(355, 'anggita_widiawati', 'E1E02310211', 'anggota'),
(356, 'dimas_lukman_hakim', 'D1C02410037', 'anggota'),
(357, 'maudy_septi_hania', 'E1D02310211', 'anggota'),
(358, 'febri_ardika_maulana', 'F1A02410065', 'anggota'),
(359, 'ahdiyat_rescaya_putra', 'D1A02310095', 'anggota'),
(360, 'baiq_windy_wulandari', 'D1D02410005', 'anggota'),
(361, 'baiq_irnaditha_aysachanara', 'E1E02410220', 'anggota'),
(362, 'ni_komang_upik_tria_sasmita', 'A1B02310168', 'anggota'),
(363, 'naysa_shalzabila', 'D1A02410478', 'anggota'),
(364, 'm_ridho_al_anshari', 'F1A02310085', 'anggota'),
(365, 'riska_amelia', 'J1B022135', 'anggota'),
(366, 'naufal_ihsanul_islam', 'F1D02310084', 'anggota'),
(367, 'eltha_riddi_cahya', 'E1C02310062', 'anggota'),
(368, 'baiq_putri_andini', 'A1C022203', 'anggota'),
(369, 'denda_maprina_arayani', 'E1C02310056', 'anggota'),
(370, 'denda_nada_femilia', 'A0C02410113', 'anggota'),
(371, 'zikria_amirussholehah', 'J1B02310094', 'anggota'),
(372, 'putri_ramdani', 'L1C02310084', 'anggota'),
(373, 'azzahra_fira_amalia', 'A0D02410091', 'anggota'),
(374, 'hani_rizka_anwari', 'C1G02410192', 'anggota'),
(375, 'athira_zihni', 'E1C02310047', 'anggota'),
(376, 'maria_oktaviani_gunu_daton', 'A1C02410088', 'anggota'),
(377, 'selvania_natasya', 'J1A02410145', 'anggota'),
(378, 'm_dimas_putra', 'D1A02310405', 'anggota'),
(379, 'alaya_shafa_sakinah', 'D1A02410325', 'anggota'),
(380, 'dwi_fadhilah', 'E1E02310088', 'anggota'),
(381, 'dinda_anjli_putri_ramdani', 'E1E02310086', 'anggota'),
(382, 'moh_saqif_dendi_al_fayyed', 'F1D02410122', 'anggota'),
(383, 'annisah_azzahra', 'D1B02410036', 'anggota'),
(384, 'berly_novita', 'D1B02410108', 'anggota'),
(385, 'elma_aprilia_safira', 'E1D02310185', 'anggota'),
(386, 'ni_luh_putu_resita_paramita_dewi', 'E1D02410027', 'anggota'),
(387, 'sultan_kusuma_jaya', 'F1D02310139', 'anggota'),
(388, 'muhammad_irwan_zulkifli', 'E1S02310062', 'anggota'),
(389, 'melly_herniati', 'E1C02410103', 'anggota'),
(390, 'erti_darminingsi', 'E1E02310234', 'anggota'),
(391, 'ni_luh_devika_bharati_puspa', 'A1B02410264', 'anggota'),
(392, 'dynda_aisyah_syafitri_sholihah', 'D1C02410087', 'anggota'),
(393, 'intan_nurulaini', 'E1S02310050', 'anggota'),
(394, 'fidda_yusairoh', 'E1E02310239', 'anggota'),
(395, 'regina_thabita_alicia', 'J1A02410075', 'anggota'),
(396, 'suryani_apriani', 'E1C02310194', 'anggota'),
(397, 'aliceta_khairunnisa', 'D1B02410003', 'anggota'),
(398, 'hozinatul_azzuro', 'E1S02310046', 'anggota'),
(399, 'afiorenza_saur_mauli_sinurat', 'A1C02410198', 'anggota'),
(400, 'mita_helpiniah', 'A0C02310045', 'anggota'),
(401, 'izzam_hawari', 'A1C02410192', 'anggota'),
(402, 'gusti_ayu_trisna_putri', 'L1B02310004', 'anggota'),
(403, 'odie_hikmal_waladi', 'L1B02310011', 'anggota'),
(404, 'baiq_hanira_septiana', 'E1A02310037', 'anggota'),
(405, 'zian_hartini', 'A0C02410131', 'anggota'),
(406, 'sri_sastra_putri', 'A0E02310083', 'anggota'),
(407, 'nabila_aulia', 'A1B02410031', 'anggota'),
(408, 'baiq_enggardianti', 'L1A02310106', 'anggota'),
(409, 'putu_jenita_ayu_puspayani', 'D1A02410274', 'anggota'),
(410, 'fitriani_hamidah', 'D1A02310155', 'anggota'),
(411, 'anggi_irawan', 'D1A02310475', 'anggota'),
(412, 'baiq_laely_handayani', 'E1E02310078', 'anggota'),
(413, 'qaulan_tsaqila', 'A1C02310106', 'anggota'),
(414, 'warlia_mursida', 'H1A02310125', 'anggota'),
(415, 'moh_fahrizal_fahmi', 'A1C02310202', 'anggota'),
(416, 'moh_gilang_fawwaz_hamid', 'D1A021496', 'anggota'),
(417, 'vira_rahmawati', '', 'anggota'),
(418, 'christoforus_titirloloby', 'D1A02310131', 'anggota'),
(419, 'marsa_suprianti', 'L1A02310063', 'anggota'),
(420, 'gizka_octa_ramadhani', 'A1C02410016', 'anggota'),
(421, 'ratna_delisa_nawanggustina', 'J1A02310136', 'anggota'),
(422, 'fadia_fadla', 'E1E02310235', 'anggota'),
(423, 'syafira_ariyani_damayanti', 'L1A02310088', 'anggota'),
(424, 'naswa_aisya_fitri', 'G1B02310053', 'anggota'),
(425, 'lisa_maulida', 'A0D02410048', 'anggota'),
(426, 'muhammad_aulya_alif', 'D1C02410101', 'anggota'),
(427, 'nubuah_marsabila', 'A1B02410267', 'anggota'),
(428, 'ni_luh_jegeg_wulandari', 'A1B02410153', 'anggota'),
(429, 'm_irji_irlian_sandi', 'E1E02310125', 'anggota'),
(430, 'nisa_annur_syafaqoh', 'G1E02310049', 'anggota'),
(431, 'baiq_nawari_lailatussyifa', 'L1C02310039', 'anggota'),
(432, 'aulia_salsabila_zain', 'E1E02310073', 'anggota'),
(433, 'baiq_aulia_maitsa_diantara', 'H1A02410162', 'anggota'),
(434, 'ni_nengah_anggita_purwanti', 'G1D02310042', 'anggota'),
(435, 'bahitsa_naila_azzahra', 'D1A02410124', 'anggota'),
(436, 'alifah_rizki_saputri', 'F1D02310103', 'anggota'),
(437, 'adell_monica', 'E1D02410164', 'anggota'),
(438, 'ni_putu_laura_angelia', 'D1A02410258', 'anggota'),
(439, 'muhammad_fadhil_khairullah', 'E1Q02310037', 'anggota'),
(440, 'fabiola_tanaya', 'D1C02410005', 'anggota'),
(441, 'rendra_dwi_amrilian', 'A0E02310075', 'anggota'),
(442, 'ahmad_asrorudin_afandi', 'C1G02410049', 'anggota'),
(443, 'ni_putu_sherly_sepiani_paramita_putri', 'A1B02410266', 'anggota'),
(444, 'muhamad_akbar_dio_sagita', 'A0E02310108', 'anggota'),
(445, 'ni_nyoman_putri_indrayanti_sutari', 'F1E02410084', 'anggota'),
(446, 'cut_zakiyyah_safiatunnisa', 'D1A02410134', 'anggota'),
(447, 'rahmatul_hidayati', 'H1B02410017', 'anggota'),
(448, 'ledina_hikmah_leopani', 'D1A02310204', 'anggota'),
(449, 'baiq_indiana_rizqia_agustina', 'D1A02410130', 'anggota'),
(450, 'maeliana_zalianti', 'G1B02310039', 'anggota'),
(451, 'degha_prayudha_suhendra', 'A0E02410024', 'anggota'),
(452, 'ardiana_soleha', 'E1E02410064', 'anggota'),
(453, 'baiq_dinda_rizquita_andriyani', 'A1B02410078', 'anggota'),
(454, 'robiatul_adawiyah', '', 'anggota'),
(455, 'taffana_wanda_salsabilla', 'A1C022287', 'anggota'),
(456, 'rion_farmaditya', 'C1N02310052', 'anggota'),
(457, 'wiya_lara_putri', 'E1E022331', 'anggota'),
(458, 'baiq_rina_ardianti', 'A1B02310094', 'anggota'),
(459, 'virga_priyanka_septia_wardani', 'A1B02310282', 'anggota'),
(460, 'cahya_fadhillah_azis', 'A1C02410140', 'anggota'),
(461, 'ratul_alvia', 'C1G02310145', 'anggota'),
(462, 'aida_cinta_mentari', 'E1D02310048', 'anggota'),
(463, 'm_arif_aditya', 'E1D02410204', 'anggota'),
(464, 'giorgi_fredrick_maitimu', 'A0E02410028', 'anggota'),
(465, 'olivia_klariza', 'A1C02410105', 'anggota');

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
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

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
-- Indeks untuk tabel `jadwal_kondisional`
--
ALTER TABLE `jadwal_kondisional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_minat_bakat` (`id_minat_bakat`);

--
-- Indeks untuk tabel `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jadwal_rutin`
--
ALTER TABLE `jadwal_rutin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_minat_bakat` (`id_minat_bakat`),
  ADD KEY `fk_bidang_rutin` (`id_bidang`);

--
-- Indeks untuk tabel `materi_latihan`
--
ALTER TABLE `materi_latihan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `minat_bakat`
--
ALTER TABLE `minat_bakat`
  ADD PRIMARY KEY (`id_minat_bakat`),
  ADD KEY `fk_bidang` (`id_bidang`);

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
-- Indeks untuk tabel `program_kerja`
--
ALTER TABLE `program_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pj_pengurus` (`pj_pengurus`),
  ADD KEY `fk_ketua_panitia` (`ketua_panitia`);

--
-- Indeks untuk tabel `progress_proker`
--
ALTER TABLE `progress_proker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_program` (`id_program`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=726;

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT untuk tabel `jadwal_kondisional`
--
ALTER TABLE `jadwal_kondisional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jadwal_latihan`
--
ALTER TABLE `jadwal_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal_rutin`
--
ALTER TABLE `jadwal_rutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `materi_latihan`
--
ALTER TABLE `materi_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `minat_bakat`
--
ALTER TABLE `minat_bakat`
  MODIFY `id_minat_bakat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT untuk tabel `program_kerja`
--
ALTER TABLE `program_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `progress_proker`
--
ALTER TABLE `progress_proker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

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
-- Ketidakleluasaan untuk tabel `jadwal_kondisional`
--
ALTER TABLE `jadwal_kondisional`
  ADD CONSTRAINT `fk_minat_bakat` FOREIGN KEY (`id_minat_bakat`) REFERENCES `minat_bakat` (`id_minat_bakat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_rutin`
--
ALTER TABLE `jadwal_rutin`
  ADD CONSTRAINT `fk_bidang_rutin` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `jadwal_rutin_ibfk_1` FOREIGN KEY (`id_minat_bakat`) REFERENCES `minat_bakat` (`id_minat_bakat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `minat_bakat`
--
ALTER TABLE `minat_bakat`
  ADD CONSTRAINT `fk_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `partisipasi`
--
ALTER TABLE `partisipasi`
  ADD CONSTRAINT `partisipasi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `program_kerja`
--
ALTER TABLE `program_kerja`
  ADD CONSTRAINT `fk_ketua_panitia` FOREIGN KEY (`ketua_panitia`) REFERENCES `anggota` (`id`),
  ADD CONSTRAINT `fk_pj_pengurus` FOREIGN KEY (`pj_pengurus`) REFERENCES `pengurus` (`id_pengurus`);

--
-- Ketidakleluasaan untuk tabel `progress_proker`
--
ALTER TABLE `progress_proker`
  ADD CONSTRAINT `progress_proker_ibfk_1` FOREIGN KEY (`id_program`) REFERENCES `program_kerja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
