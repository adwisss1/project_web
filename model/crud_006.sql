-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2025 pada 01.04
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
  `id_sesi_absensi` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status_kehadiran` enum('Hadir','Tidak Hadir','Izin') NOT NULL,
  `status` enum('Hadir','Tidak Hadir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `user_id`, `id_sesi_absensi`, `tanggal`, `status_kehadiran`, `status`) VALUES
(4, 3, 31, '2025-06-12', 'Hadir', 'Hadir'),
(5, 3, 32, '2025-06-13', 'Izin', 'Hadir'),
(6, 3, 33, '2025-06-12', 'Hadir', 'Hadir'),
(7, 3, 34, '2025-06-13', 'Hadir', 'Hadir'),
(8, 2, 35, '2025-06-12', 'Hadir', 'Hadir'),
(9, 2, 36, '2025-06-15', 'Hadir', 'Hadir'),
(10, 2, 37, '2025-06-23', 'Hadir', 'Hadir'),
(11, 2, 38, '2025-06-23', 'Tidak Hadir', 'Hadir'),
(12, 2, 43, '2025-06-23', 'Hadir', 'Hadir'),
(13, 2, 45, '2025-06-24', 'Hadir', 'Hadir'),
(14, 2, 46, '2025-06-22', 'Izin', 'Hadir'),
(15, 354, 47, '2025-06-24', 'Hadir', 'Hadir'),
(16, 354, 50, '2025-07-01', 'Izin', 'Hadir'),
(17, 354, 51, '2025-06-30', 'Hadir', 'Hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nra` varchar(20) NOT NULL,
  `angkatan` int(4) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `nama`, `nra`, `angkatan`, `user_id`) VALUES
(628, 'Chalya Putri Budiani', 'E1D02310182', 2022, 3),
(629, 'Astrida Berlina Wibowo', 'F1E02310074', 2023, 4),
(630, 'Viona Zulfa Salsabilla', 'C1M02310021', 2024, 5),
(631, 'Farrel Putra Wiana', 'C1N02310027', 2022, 6),
(632, 'Hafana Zahra Berlianty', 'F1E02310078', 2023, 7),
(633, 'Siti Hajar Ibrahim', 'E1D02310149', 2024, 8),
(634, 'Praja Alim Zamzani', 'L1A02310134', 2022, 9),
(635, 'Husniah Azriani', 'A1B022132', 2023, 10),
(636, 'Sahida Najwa', 'J1A02310138', 2024, 11),
(637, 'Nida Khairunisa', 'E1D02310220', 2022, 12),
(638, 'Adelia Anggellina Purnama', 'C1G02310165', 2023, 13),
(639, 'Nadya Permata Murti Puspitaningrum', 'J1A02310072', 2024, 14),
(640, 'Athirah Salsabila', 'C1M02310102', 2022, 15),
(641, 'Audira Haerunnisa', 'C1L02310030', 2023, 16),
(642, 'Hana Athaya Nurhalizah', 'H1A02310165', 2024, 17),
(643, 'Putri Dwi Febbia', 'E1E022042', 2022, 18),
(644, 'Ahmad Aldi', 'D1A02310495', 2023, 19),
(645, 'Zidan Ihlasul Amal', 'E1B022256', 2024, 20),
(646, 'Siti Zulya Fatmi', 'D1A022076', 2022, 21),
(647, 'Nurul Aulia', 'D1A022067', 2023, 22),
(648, 'Arya Qisthi Suryanto', 'D1A02310340', 2024, 23),
(649, 'Laili Julianingsih', 'D1A022041', 2022, 24),
(650, 'Dian Rizki Damayani', 'D1A022019', 2023, 25),
(651, 'Zahwa Azzahra', 'A1B02310240', 2024, 26),
(652, 'Annisa Arsylita', 'C1N02310092', 2022, 27),
(654, 'Muhammad Ridho Azkari', 'F1A021195', 2024, 29),
(655, 'Iga Nabila Ouwan Azzahra', 'C1G022020', 2022, 30),
(656, 'Rifal Gibran', 'A1B02310188', 2023, 31),
(657, 'Alivia Zaliyanti', 'C1M02310001', 2024, 32),
(658, 'Imelda Hartawan', 'F1E02310081', 2022, 33),
(659, 'Putri Siti Rabiah', 'D1A022552', 2023, 34),
(660, 'Annisa Rahma Kusuma', 'B1D022063', 2024, 35),
(661, 'Eva Yolanda', 'D1A022396', 2022, 36),
(662, 'Baiq Nazira Oktaviani', 'A1B02310091', 2023, 37),
(663, 'Yasanti Etenia', 'A1C022294', 2024, 38),
(664, 'Nyayu Dian Fermanu', 'E1B022169', 2022, 39),
(665, 'Maulida Apriana', 'E1B022158', 2023, 40),
(666, 'Dara Anggun Adhna Fika', 'E1S022032', 2024, 41),
(667, 'Deya Kalisdia', 'E1S022005', 2022, 42),
(668, 'Riza Aprilia', 'E1S022015', 2023, 43),
(669, 'Baiq Hanisa Yasmin', 'E1S022028', 2024, 44),
(670, 'Shahinaz Syahira', 'E1S022017', 2022, 45),
(671, 'Ricko Muksalminan Jerowarunikus', 'A0E02310111', 2023, 46),
(672, 'Baiq Inggid Putri Zahwa', 'L1A02310107', 2024, 47),
(673, 'Rahadian Hidayatullah', 'F1A02310114', 2022, 48),
(674, 'Nindya Faninda Putri', 'A1C02310173', 2023, 49),
(675, 'Aulianov Ramadhani', 'L1A02310103', 2024, 50),
(677, 'Rosyidah Nur Hairani', 'E1D022036', 2023, 52),
(679, 'Risa Handayani', 'L1C02310087', 2022, 54),
(680, 'Bunga Gea Varesa', 'J1A02310007', 2023, 55),
(681, 'Arjun Hidayatullah', 'L1B02310071', 2024, 56),
(682, 'Lalu Muhammad Fachrian Surya Lingga', 'F1C02310068', 2022, 57),
(683, 'Nur Shopya Afifaturrahmah', 'G1A022008', 2023, 58),
(684, 'Susan Tiara Nelpiana', 'D1A022295', 2024, 59),
(685, 'Baiq Moza Fatima Dwi Kamalia', 'L1A02310007', 2022, 60),
(686, 'Sandrina Kartikasari Pujiono', 'A1B02310193', 2023, 61),
(687, 'Siti Fatimatuzzakhro', 'E1B02310124', 2024, 62),
(688, 'Heppy Tasya Pibiputri', 'G1E022027', 2022, 63),
(689, 'Lalu Sadad Fathoni', 'G1E02310024', 2023, 64),
(690, 'Mayzania Safitri', 'J1A02310017', 2024, 65),
(691, 'Tri Jannatun Mardiah', 'J1A02310028', 2022, 66),
(692, 'Rahayu Wahida Putri Maulana', 'C1M02310075', 2023, 67),
(693, 'Reinanda Taufara Akbar', 'L1A02310136', 2024, 68),
(694, 'Rendi Setiawan', 'A0E02310074', 2022, 69),
(695, 'Mario Benediktus Rawa Gana', 'E1D02310107', 2023, 70),
(696, 'Keishe Tita Violeta', 'E1C02310084', 2024, 71),
(697, 'Baiq Fitriana Dila', 'J1A02310005', 2022, 72),
(698, 'Diaz Risky Atallah', 'L1B022041', 2023, 73),
(699, 'Ananda Farzana Azzyaty', 'E1D022005', 2024, 74),
(700, 'Annisa Febrina Hidayat', 'E1D022008', 2022, 75),
(701, 'Maya Delfira Putri', 'J1A02310016', 2023, 76),
(702, 'Fatimah Az Zahra', 'F1C022112', 2024, 77),
(703, 'Baiq Dafina Salsabila', 'A1C02310053', 2022, 78),
(704, 'Zyasa Dwinta Khaliesta', 'E1B022186', 2023, 79),
(706, 'Nyoman Aldi Pradipta', 'A1B02310179', 2022, 81),
(707, 'Adelia Anatia Safitri', 'D1A02310089', 2023, 82),
(708, 'Ni Nyoman Ayu Mega Lestari', 'C1G022125', 2024, 83),
(709, 'Wilda Aprilianda', 'E1S02310092', 2022, 84),
(710, 'Siti Raehanun', 'L1C022087', 2023, 85),
(711, 'Nilam Saqinah Maharani', 'C1B022016', 2024, 86),
(712, 'Meili Angelina Rahma', 'C1K02310041', 2022, 87),
(713, 'Felicia Melinda Coulina Putri', 'J1A02310009', 2023, 88),
(714, 'Komang Dewi Triendra Hari', 'J1A02310014', 2024, 89),
(715, 'Maria Anastasia Maya Mau', 'J1A02310015', 2022, 90),
(716, 'Yayu Dwi Wahyuni', 'A1A021269', 2023, 91),
(717, 'Radika Dewi A', 'A1A021242', 2024, 92),
(718, 'Witri Widyastuti', 'A1A021255', 2022, 93),
(719, 'Marselena Primasati Utari', 'F1A02310090', 2023, 94),
(720, 'Ni Kadek Gita Sri Persada', 'A1B022184', 2024, 95),
(721, 'Nela Febiola', 'A1B022183', 2022, 96),
(722, 'Ni Nengah Dira Windriani', 'A1B022187', 2023, 97),
(723, 'Asty Murniati', 'E1E022225', 2024, 98),
(724, 'M Algifari', 'E1C022078', 2022, 99),
(725, 'Eki Wahardani', 'A0E02310041', 2023, 100),
(727, 'nayla anugerah nisa', '112920192', 2024, 466),
(729, '', '', 0, 2),
(730, 'lalu bayu sukma aji', 'f1b023100', 2024, 468),
(732, 'muhammad_aydir', 'AUTO28', 2025, 28),
(733, 'peri_rusdijulianto', 'AUTO51', 2025, 51),
(734, 'm_khairul_tamimi_pranata', 'AUTO53', 2025, 53),
(735, 'ahmad_reza_mahendra', 'AUTO80', 2025, 80),
(736, 'made_rama_adika_putra', 'AUTO101', 2025, 101),
(737, 'winda_lestari_ningsih', 'AUTO102', 2025, 102),
(738, 'alia_ardianti_humairo', 'AUTO103', 2025, 103),
(739, 'lu_luul_jannah', 'AUTO104', 2025, 104),
(740, 'nurul_wahdiah_riz_lestari', 'AUTO105', 2025, 105),
(741, 'tiara_andriani_isnawati', 'AUTO106', 2025, 106),
(742, 'razyka_albani', 'AUTO107', 2025, 107),
(743, 'al_humairah_tsaniatul_fallah', 'AUTO108', 2025, 108),
(744, 'aedia_asri', 'AUTO109', 2025, 109),
(745, 'liza_hanim', 'AUTO110', 2025, 110),
(746, 'amri_aziz', 'AUTO111', 2025, 111),
(747, 'lalu_raja_baehaki', 'AUTO112', 2025, 112),
(748, 'auryn_zultifha_rahmani', 'AUTO113', 2025, 113),
(749, 'kania_putri_rohimatuz_azzahra_hamdani', 'AUTO114', 2025, 114),
(750, 'nadiva_risky_aulia', 'AUTO115', 2025, 115),
(751, 'arnesya_farrelia_nasroh', 'AUTO116', 2025, 116),
(752, 'baiq_suryatami', 'AUTO117', 2025, 117),
(753, 'pita_nopiana', 'AUTO118', 2025, 118),
(754, 'ni_kd_widia_arsita', 'AUTO119', 2025, 119),
(755, 'ni_nyoman_cika_ariani', 'AUTO120', 2025, 120),
(756, 'dina_rahidatul_adiat', 'AUTO121', 2025, 121),
(757, 'mariyana', 'AUTO122', 2025, 122),
(758, 'mardiatul_jannah', 'AUTO123', 2025, 123),
(759, 'nabila', 'AUTO124', 2025, 124),
(760, 'nadia_ananda', 'AUTO125', 2025, 125),
(761, 'melida_susanti', 'AUTO126', 2025, 126),
(762, 'lalu_muhammad_nafi_rabbani', 'AUTO127', 2025, 127),
(763, 'ataya_aulia_maryadi', 'AUTO128', 2025, 128),
(764, 'baiq_annisa_aulia_larasati', 'AUTO129', 2025, 129),
(765, 'rafly_ifti_aljihadi', 'AUTO130', 2025, 130),
(766, 'i_nyoman_laviandra_surya_arimbawa', 'AUTO131', 2025, 131),
(767, 'maedina_junaedi', 'AUTO132', 2025, 132),
(768, 'radia_izzatul_husna', 'AUTO133', 2025, 133),
(769, 'baiq_luthfida_khairunnisa', 'AUTO134', 2025, 134),
(770, 'i_gusti_ayu_maesya_andini', 'AUTO135', 2025, 135),
(771, 'baiq_subbidia_ulfi', 'AUTO136', 2025, 136),
(772, 'danang_setiawan', 'AUTO137', 2025, 137),
(773, 'ismul_azam', 'AUTO138', 2025, 138),
(774, 'lalu_zhafran_farras_rahman', 'AUTO139', 2025, 139),
(775, 'aini_kurniawati', 'AUTO140', 2025, 140),
(776, 'dhea_desvita_juniati', 'AUTO141', 2025, 141),
(777, 'khanza_rayes', 'AUTO142', 2025, 142),
(778, 'arlina_zikria_wulandari', 'AUTO143', 2025, 143),
(779, 'laela_fitriani', 'AUTO144', 2025, 144),
(780, 'salwa_nabila_aulia_rachim', 'AUTO145', 2025, 145),
(781, 'ramadhani_indah_putri_aji', 'AUTO146', 2025, 146),
(782, 'baiq_zaka_an_nisaa', 'AUTO147', 2025, 147),
(783, 'prawira_adji_lamandika', 'AUTO148', 2025, 148),
(784, 'shofia_akmal_samanhudi', 'AUTO149', 2025, 149),
(785, 'rizqika_aprilia', 'AUTO150', 2025, 150),
(786, 'audina_jelita', 'AUTO151', 2025, 151),
(787, 'ayu_hafifah', 'AUTO152', 2025, 152),
(788, 'ni_nyoman_puja_meviyanti', 'AUTO153', 2025, 153),
(789, 'ni_wayan_utari_dewi_yanti', 'AUTO154', 2025, 154),
(790, 'i_gusti_ayu_intan_septiani_putri', 'AUTO155', 2025, 155),
(791, 'candrika_ripasyah', 'AUTO156', 2025, 156),
(792, 'dida_ardani_immawansyah', 'AUTO157', 2025, 157),
(793, 'mutiara_azzahra_kasih', 'AUTO158', 2025, 158),
(794, 'sofia_aulia_citra', 'AUTO159', 2025, 159),
(795, 'dea_sucita_bissaema', 'AUTO160', 2025, 160),
(796, 'eliza_iskayanti', 'AUTO161', 2025, 161),
(797, 'samuel_ezra_christian', 'AUTO162', 2025, 162),
(798, 'kenanga_findi_artifa', 'AUTO163', 2025, 163),
(799, 'miteknikahul_aini', 'AUTO164', 2025, 164),
(800, 'muhamad_iqbal', 'AUTO165', 2025, 165),
(801, 'lalu_abizaar_adhin_bhijannifa', 'AUTO166', 2025, 166),
(802, 'i_gusti_agung_ananta_semeru_tanuwijaya', 'AUTO167', 2025, 167),
(803, 'lalu_aqsha_nayaka_maulana', 'AUTO168', 2025, 168),
(804, 'annisa_purnama_sari', 'AUTO169', 2025, 169),
(805, 'withadarma_seva', 'AUTO170', 2025, 170),
(806, 'suci_ramdiani', 'AUTO171', 2025, 171),
(807, 'siti_sabrina_turatea', 'AUTO172', 2025, 172),
(808, 'nazwa_farahdila', 'AUTO173', 2025, 173),
(809, 'dea_ajeng_saqinah', 'AUTO174', 2025, 174),
(810, 'mariani', 'AUTO175', 2025, 175),
(811, 'fatikamaira_nallea_deefany', 'AUTO176', 2025, 176),
(812, 'gheyzna_scharsza_gheyna', 'AUTO177', 2025, 177),
(813, 'amrani_kania_aerinti', 'AUTO178', 2025, 178),
(814, 'nada_farid_huraibi', 'AUTO179', 2025, 179),
(815, 'amorina_putri_tarizka_wirasetya', 'AUTO180', 2025, 180),
(816, 'ni_kadek_rahayu_ari_ningsih', 'AUTO181', 2025, 181),
(817, 'siti_fatimah', 'AUTO182', 2025, 182),
(818, 'baiq_dende_surya_pertiwi', 'AUTO183', 2025, 183),
(819, 'rendi_christian_ngaba', 'AUTO184', 2025, 184),
(820, 'tifani_alivia_salsabila', 'AUTO185', 2025, 185),
(821, 'erik_koeswanto', 'AUTO186', 2025, 186),
(822, 'mislahul_ihsan_agustira', 'AUTO187', 2025, 187),
(823, 'i_komang_erhardi_pakusadewo_darta', 'AUTO188', 2025, 188),
(824, 'hanum_salsabila_yamin', 'AUTO189', 2025, 189),
(825, 'malikkah_noviya_rizkami_putri', 'AUTO190', 2025, 190),
(826, 'intan_dhea_afninda_ananda', 'AUTO191', 2025, 191),
(827, 'hayatun_nupus', 'AUTO192', 2025, 192),
(828, 'ega_syah_rial', 'AUTO193', 2025, 193),
(829, 'putri_mariani_wulandari', 'AUTO194', 2025, 194),
(830, 'ni_made_dwitya_pratami_putri', 'AUTO195', 2025, 195),
(831, 'rica_salwani', 'AUTO196', 2025, 196),
(832, 'wiwit_aprilia_saputri', 'AUTO197', 2025, 197),
(833, 'baiq_halifa_yudisthia_ningrum', 'AUTO198', 2025, 198),
(834, 'putri_alifia_hoolyan', 'AUTO199', 2025, 199),
(835, 'anantya_salsabilla', 'AUTO200', 2025, 200),
(836, 'dwifa_ratna_azzahra', 'AUTO201', 2025, 201),
(837, 'sesy_alecya', 'AUTO202', 2025, 202),
(838, 'alia_nabila_putri', 'AUTO203', 2025, 203),
(839, 'cindy_natasya_aulia_putri', 'AUTO204', 2025, 204),
(840, 'raquan_mulachela', 'AUTO205', 2025, 205),
(841, 'baiq_najwa_fatiya_winanti', 'AUTO206', 2025, 206),
(842, 'sania_salsabila_mardita', 'AUTO207', 2025, 207),
(843, 'bq_amanda_orien_rahmadina', 'AUTO208', 2025, 208),
(844, 'sufiana_pratita_cahya_auliya', 'AUTO209', 2025, 209),
(845, 'muhammad_ajjibar_akbar', 'AUTO210', 2025, 210),
(846, 'arni_aprillia', 'AUTO211', 2025, 211),
(847, 'ardiatun_wasiah', 'AUTO212', 2025, 212),
(848, 'rani_surya_lestari', 'AUTO213', 2025, 213),
(849, 'salma_firdaus', 'AUTO214', 2025, 214),
(850, 'muhammad_radinal_assidiqi', 'AUTO215', 2025, 215),
(851, 'baiq_nazwa_novita', 'AUTO216', 2025, 216),
(852, 'ni_nyoman_yunita_aswina_putri', 'AUTO217', 2025, 217),
(853, 'rohin_novia_maydi_putri', 'AUTO218', 2025, 218),
(854, 'eka_mutiara_putri_wahyudi', 'AUTO219', 2025, 219),
(855, 'rabiatul_adawiyah', 'AUTO220', 2025, 220),
(856, 'aqillah_deani_alfarosa', 'AUTO221', 2025, 221),
(857, 'yuliana', 'AUTO222', 2025, 222),
(858, 'salwa_nur_amraini', 'AUTO223', 2025, 223),
(859, 'ni_luh_dewi_nitari', 'AUTO224', 2025, 224),
(860, 'agil_rozan_pahlevi', 'AUTO225', 2025, 225),
(861, 'susanti', 'AUTO226', 2025, 226),
(862, 'lubna_rahmatul_apriliani', 'AUTO227', 2025, 227),
(863, 'ardina_amelia', 'AUTO228', 2025, 228),
(864, 'aulia_syahruni', 'AUTO229', 2025, 229),
(865, 'i_made_agus_radhitya_penlaka', 'AUTO230', 2025, 230),
(866, 'baiq_dhifa_isnawati', 'AUTO231', 2025, 231),
(867, 'laela_ulfi_julianti_aisyah', 'AUTO232', 2025, 232),
(868, 'helda_apriani', 'AUTO233', 2025, 233),
(869, 'sabrina_juanita_nitbani', 'AUTO234', 2025, 234),
(870, 'siti_rahmah', 'AUTO235', 2025, 235),
(871, 'valia_alza_rahma', 'AUTO236', 2025, 236),
(872, 'kayla_zahra_yamani', 'AUTO237', 2025, 237),
(873, 'queenina_aulia_hidayat', 'AUTO238', 2025, 238),
(874, 'naomi_nanda_ida_santoso', 'AUTO239', 2025, 239),
(875, 'dinda_fitria', 'AUTO240', 2025, 240),
(876, 'hafizul_fadli', 'AUTO241', 2025, 241),
(877, 'tiara', 'AUTO242', 2025, 242),
(878, 'samsul_hadi', 'AUTO243', 2025, 243),
(879, 'latifahul_amalia', 'AUTO244', 2025, 244),
(880, 'ichal_oktavia_ramdhani', 'AUTO245', 2025, 245),
(881, 'weni_eka_pratiwi', 'AUTO246', 2025, 246),
(882, 'ade_putra', 'AUTO247', 2025, 247),
(883, 'st_aisyah_isyawal', 'AUTO248', 2025, 248),
(884, 'suci_nuraini', 'AUTO249', 2025, 249),
(885, 'irjan_hamdani', 'AUTO250', 2025, 250),
(886, 'i_komang_tegar_agustyawan', 'AUTO251', 2025, 251),
(887, 'ni_komang_ayu_fiorentina', 'AUTO252', 2025, 252),
(888, 'shifa_tsuroyya_zahra', 'AUTO253', 2025, 253),
(889, 'yana_fitri_rahma', 'AUTO254', 2025, 254),
(890, 'febriand_bawa_laksana', 'AUTO255', 2025, 255),
(891, 'irfan_mauliddin', 'AUTO256', 2025, 256),
(892, 'ni_luh_widia_ayu_marsela', 'AUTO257', 2025, 257),
(893, 'putri_zahrani', 'AUTO258', 2025, 258),
(894, 'radit_putra_dwinardi', 'AUTO259', 2025, 259),
(895, 'sabriatin_warohmah', 'AUTO260', 2025, 260),
(896, 'agiskiranti_sirajuddin_putri', 'AUTO261', 2025, 261),
(897, 'baiq_laela_amalia', 'AUTO262', 2025, 262),
(898, 'athila_riefhan', 'AUTO263', 2025, 263),
(899, 'm_abdul_faruk', 'AUTO264', 2025, 264),
(900, 'andra_rahmadani_ saputro', 'AUTO265', 2025, 265),
(901, 'zara_aqila_selvia', 'AUTO266', 2025, 266),
(902, 'agus_supriyanto', 'AUTO267', 2025, 267),
(903, 'eka_selvyana_agustin', 'AUTO268', 2025, 268),
(904, 'muhammad_wardiansyah', 'AUTO269', 2025, 269),
(905, 'indri_agusthreea_rahmi', 'AUTO270', 2025, 270),
(906, 'alfonso_krison_wicaksana', 'AUTO271', 2025, 271),
(907, 'putri_karimatullah', 'AUTO272', 2025, 272),
(908, 'yeni_eriawati', 'AUTO273', 2025, 273),
(909, 'gabriel_christiputro_adi_purmantara', 'AUTO274', 2025, 274),
(910, 'anggun_susi_wardani', 'AUTO275', 2025, 275),
(911, 'nabilla_rati_oktavia', 'AUTO276', 2025, 276),
(912, 'fitri_ayu_nopiyanti', 'AUTO277', 2025, 277),
(913, 'zhidan_hanafi', 'AUTO278', 2025, 278),
(914, 'nurul_khopipah', 'AUTO279', 2025, 279),
(915, 'sumaini', 'AUTO280', 2025, 280),
(916, 'carmia_nathania', 'AUTO281', 2025, 281),
(917, 'rohatul_laeli', 'AUTO282', 2025, 282),
(918, 'muhammad_tio_hendrawan', 'AUTO283', 2025, 283),
(919, 'monca_siti_nayla_syallini', 'AUTO284', 2025, 284),
(920, 'miranti_auliya_bilqist', 'AUTO285', 2025, 285),
(921, 'arya_ramadi_nova_pratama', 'AUTO286', 2025, 286),
(922, 'arfi_syamsu', 'AUTO287', 2025, 287),
(923, 'baiq_astried_maulidina', 'AUTO288', 2025, 288),
(924, 'davina_fairuzellia_nugraha', 'AUTO289', 2025, 289),
(925, 'lalu_wja_alpi_kurnia', 'AUTO290', 2025, 290),
(926, 'reyvaldo_basry', 'AUTO291', 2025, 291),
(927, 'r_dimas_bany_adhiman', 'AUTO292', 2025, 292),
(928, 'syifaul_fadhila', 'AUTO293', 2025, 293),
(929, 'aulia_rizkia_pebriani', 'AUTO294', 2025, 294),
(930, 'arya_genta_sulendra', 'AUTO295', 2025, 295),
(931, 'nabilah_dwiaqilah_sulandari', 'AUTO296', 2025, 296),
(932, 'nadila_dwi_wulandari', 'AUTO297', 2025, 297),
(933, 'ni_made_nanda_amrita_dewi', 'AUTO298', 2025, 298),
(934, 'rahmadin_nur_firdaus', 'AUTO299', 2025, 299),
(935, 'raisa_husgina_pratiwi', 'AUTO300', 2025, 300),
(936, 'ni_kadek_osi_nila_dewi', 'AUTO301', 2025, 301),
(937, 'rosdiana_khairunnisa', 'AUTO302', 2025, 302),
(938, 'suryani', 'AUTO303', 2025, 303),
(939, 'muhammad_ilman_husainy', 'AUTO304', 2025, 304),
(940, 'akhdan_muammar', 'AUTO305', 2025, 305),
(941, 'abi_kiram_awali', 'AUTO306', 2025, 306),
(942, 'imtihan_novita_febrianti', 'AUTO307', 2025, 307),
(943, 'jelita', 'AUTO308', 2025, 308),
(944, 'alin_daniela_safitri', 'AUTO309', 2025, 309),
(945, 'hifzillisan', 'AUTO310', 2025, 310),
(946, 'arieska_milani_putri', 'AUTO311', 2025, 311),
(947, 'i_gusti_ayu_rahayu_devi_komaris', 'AUTO312', 2025, 312),
(948, 'hikmah_nur_islamiah', 'AUTO313', 2025, 313),
(949, 'rabiatun_adawiyah', 'AUTO314', 2025, 314),
(950, 'resti_julia_agustiandini', 'AUTO315', 2025, 315),
(951, 'dewi_rindiani', 'AUTO316', 2025, 316),
(952, 'arvin_farrelo', 'AUTO317', 2025, 317),
(953, 'baiq_larashati', 'AUTO318', 2025, 318),
(954, 'gallen_nathaniel_n', 'AUTO319', 2025, 319),
(955, 'muhammad_lukman_roja', 'AUTO320', 2025, 320),
(956, 'bisma_marfa_diswa', 'AUTO321', 2025, 321),
(957, 'mia_aprianti', 'AUTO322', 2025, 322),
(958, 'dwi_erna_agustina', 'AUTO323', 2025, 323),
(959, 'mushariatin_juliana', 'AUTO324', 2025, 324),
(960, 'winda_pratama_que_sengkey', 'AUTO325', 2025, 325),
(961, 'shofiyatul_jannah', 'AUTO326', 2025, 326),
(962, 'maylina_zahrani', 'AUTO327', 2025, 327),
(963, 'lola_juliarta', 'AUTO328', 2025, 328),
(964, 'farel_aliyavi', 'AUTO329', 2025, 329),
(965, 'dina_haerunnisa', 'AUTO330', 2025, 330),
(966, 'kayla_aisha_nugroho', 'AUTO331', 2025, 331),
(967, 'triana_chintya_devi', 'AUTO332', 2025, 332),
(968, 'mila_ulfayanti', 'AUTO333', 2025, 333),
(969, 'dewa_ayu_anastasya_rahayu', 'AUTO334', 2025, 334),
(970, 'khaela_anjani', 'AUTO335', 2025, 335),
(971, 'lalu_abdul_muhaimin', 'AUTO336', 2025, 336),
(972, 'zahwa_suhandany_alkatiri', 'AUTO337', 2025, 337),
(973, 'luthfa_ramadhini', 'AUTO338', 2025, 338),
(974, 'wafa_meisyah_rani', 'AUTO339', 2025, 339),
(975, 'febry_putri_kayanti', 'AUTO340', 2025, 340),
(976, 'basri_ramadhan', 'AUTO341', 2025, 341),
(977, 'farra_khansa_syadzwina', 'AUTO342', 2025, 342),
(978, 'm_aqila_isna_karinda', 'AUTO343', 2025, 343),
(979, 'ida_ayu_putri_saraswati', 'AUTO344', 2025, 344),
(980, 'ester_veronica_tung', 'AUTO345', 2025, 345),
(981, 'yuna_afrialia_putri', 'AUTO346', 2025, 346),
(982, 'baiq_harliana_anhar', 'AUTO347', 2025, 347),
(983, 'muhammad_fauzan_adika', 'AUTO348', 2025, 348),
(984, 'maslihatul_khoiriyah', 'AUTO349', 2025, 349),
(985, 'meiliza_mustika_perwita', 'AUTO350', 2025, 350),
(986, 'dinda_juliana_novita', 'AUTO351', 2025, 351),
(987, 'maesa_fazlika_dhatina', 'AUTO352', 2025, 352),
(988, 'kezia_setianingtias', 'AUTO353', 2025, 353),
(989, 'saopi', 'AUTO354', 2025, 354),
(990, 'anggita_widiawati', 'AUTO355', 2025, 355),
(991, 'dimas_lukman_hakim', 'AUTO356', 2025, 356),
(992, 'maudy_septi_hania', 'AUTO357', 2025, 357),
(993, 'febri_ardika_maulana', 'AUTO358', 2025, 358),
(994, 'ahdiyat_rescaya_putra', 'AUTO359', 2025, 359),
(995, 'baiq_windy_wulandari', 'AUTO360', 2025, 360),
(996, 'baiq_irnaditha_aysachanara', 'AUTO361', 2025, 361),
(997, 'ni_komang_upik_tria_sasmita', 'AUTO362', 2025, 362),
(998, 'naysa_shalzabila', 'AUTO363', 2025, 363),
(999, 'm_ridho_al_anshari', 'AUTO364', 2025, 364),
(1000, 'riska_amelia', 'AUTO365', 2025, 365),
(1001, 'naufal_ihsanul_islam', 'AUTO366', 2025, 366),
(1002, 'eltha_riddi_cahya', 'AUTO367', 2025, 367),
(1003, 'baiq_putri_andini', 'AUTO368', 2025, 368),
(1004, 'denda_maprina_arayani', 'AUTO369', 2025, 369),
(1005, 'denda_nada_femilia', 'AUTO370', 2025, 370),
(1006, 'zikria_amirussholehah', 'AUTO371', 2025, 371),
(1007, 'putri_ramdani', 'AUTO372', 2025, 372),
(1008, 'azzahra_fira_amalia', 'AUTO373', 2025, 373),
(1009, 'hani_rizka_anwari', 'AUTO374', 2025, 374),
(1010, 'athira_zihni', 'AUTO375', 2025, 375),
(1011, 'maria_oktaviani_gunu_daton', 'AUTO376', 2025, 376),
(1012, 'selvania_natasya', 'AUTO377', 2025, 377),
(1013, 'm_dimas_putra', 'AUTO378', 2025, 378),
(1014, 'alaya_shafa_sakinah', 'AUTO379', 2025, 379),
(1015, 'dwi_fadhilah', 'AUTO380', 2025, 380),
(1016, 'dinda_anjli_putri_ramdani', 'AUTO381', 2025, 381),
(1017, 'moh_saqif_dendi_al_fayyed', 'AUTO382', 2025, 382),
(1018, 'annisah_azzahra', 'AUTO383', 2025, 383),
(1019, 'berly_novita', 'AUTO384', 2025, 384),
(1020, 'elma_aprilia_safira', 'AUTO385', 2025, 385),
(1021, 'ni_luh_putu_resita_paramita_dewi', 'AUTO386', 2025, 386),
(1022, 'sultan_kusuma_jaya', 'AUTO387', 2025, 387),
(1023, 'muhammad_irwan_zulkifli', 'AUTO388', 2025, 388),
(1024, 'melly_herniati', 'AUTO389', 2025, 389),
(1025, 'erti_darminingsi', 'AUTO390', 2025, 390),
(1026, 'ni_luh_devika_bharati_puspa', 'AUTO391', 2025, 391),
(1027, 'dynda_aisyah_syafitri_sholihah', 'AUTO392', 2025, 392),
(1028, 'intan_nurulaini', 'AUTO393', 2025, 393),
(1029, 'fidda_yusairoh', 'AUTO394', 2025, 394),
(1030, 'regina_thabita_alicia', 'AUTO395', 2025, 395),
(1031, 'suryani_apriani', 'AUTO396', 2025, 396),
(1032, 'aliceta_khairunnisa', 'AUTO397', 2025, 397),
(1033, 'hozinatul_azzuro', 'AUTO398', 2025, 398),
(1034, 'afiorenza_saur_mauli_sinurat', 'AUTO399', 2025, 399),
(1035, 'mita_helpiniah', 'AUTO400', 2025, 400),
(1036, 'izzam_hawari', 'AUTO401', 2025, 401),
(1037, 'gusti_ayu_trisna_putri', 'AUTO402', 2025, 402),
(1038, 'odie_hikmal_waladi', 'AUTO403', 2025, 403),
(1039, 'baiq_hanira_septiana', 'AUTO404', 2025, 404),
(1040, 'zian_hartini', 'AUTO405', 2025, 405),
(1041, 'sri_sastra_putri', 'AUTO406', 2025, 406),
(1042, 'nabila_aulia', 'AUTO407', 2025, 407),
(1043, 'baiq_enggardianti', 'AUTO408', 2025, 408),
(1044, 'putu_jenita_ayu_puspayani', 'AUTO409', 2025, 409),
(1045, 'fitriani_hamidah', 'AUTO410', 2025, 410),
(1046, 'anggi_irawan', 'AUTO411', 2025, 411),
(1047, 'baiq_laely_handayani', 'AUTO412', 2025, 412),
(1048, 'qaulan_tsaqila', 'AUTO413', 2025, 413),
(1049, 'warlia_mursida', 'AUTO414', 2025, 414),
(1050, 'moh_fahrizal_fahmi', 'AUTO415', 2025, 415),
(1051, 'moh_gilang_fawwaz_hamid', 'AUTO416', 2025, 416),
(1052, 'vira_rahmawati', 'AUTO417', 2025, 417),
(1053, 'christoforus_titirloloby', 'AUTO418', 2025, 418),
(1054, 'marsa_suprianti', 'AUTO419', 2025, 419),
(1055, 'gizka_octa_ramadhani', 'AUTO420', 2025, 420),
(1056, 'ratna_delisa_nawanggustina', 'AUTO421', 2025, 421),
(1057, 'fadia_fadla', 'AUTO422', 2025, 422),
(1058, 'syafira_ariyani_damayanti', 'AUTO423', 2025, 423),
(1059, 'naswa_aisya_fitri', 'AUTO424', 2025, 424),
(1060, 'lisa_maulida', 'AUTO425', 2025, 425),
(1061, 'muhammad_aulya_alif', 'AUTO426', 2025, 426),
(1062, 'nubuah_marsabila', 'AUTO427', 2025, 427),
(1063, 'ni_luh_jegeg_wulandari', 'AUTO428', 2025, 428),
(1064, 'm_irji_irlian_sandi', 'AUTO429', 2025, 429),
(1065, 'nisa_annur_syafaqoh', 'AUTO430', 2025, 430),
(1066, 'baiq_nawari_lailatussyifa', 'AUTO431', 2025, 431),
(1067, 'aulia_salsabila_zain', 'AUTO432', 2025, 432),
(1068, 'baiq_aulia_maitsa_diantara', 'AUTO433', 2025, 433),
(1069, 'ni_nengah_anggita_purwanti', 'AUTO434', 2025, 434),
(1070, 'bahitsa_naila_azzahra', 'AUTO435', 2025, 435),
(1071, 'alifah_rizki_saputri', 'AUTO436', 2025, 436),
(1072, 'adell_monica', 'AUTO437', 2025, 437),
(1073, 'ni_putu_laura_angelia', 'AUTO438', 2025, 438),
(1074, 'muhammad_fadhil_khairullah', 'AUTO439', 2025, 439),
(1075, 'fabiola_tanaya', 'AUTO440', 2025, 440),
(1076, 'rendra_dwi_amrilian', 'AUTO441', 2025, 441),
(1077, 'ahmad_asrorudin_afandi', 'AUTO442', 2025, 442),
(1078, 'ni_putu_sherly_sepiani_paramita_putri', 'AUTO443', 2025, 443),
(1079, 'muhamad_akbar_dio_sagita', 'AUTO444', 2025, 444),
(1080, 'ni_nyoman_putri_indrayanti_sutari', 'AUTO445', 2025, 445),
(1081, 'cut_zakiyyah_safiatunnisa', 'AUTO446', 2025, 446),
(1082, 'rahmatul_hidayati', 'AUTO447', 2025, 447),
(1083, 'ledina_hikmah_leopani', 'AUTO448', 2025, 448),
(1084, 'baiq_indiana_rizqia_agustina', 'AUTO449', 2025, 449),
(1085, 'maeliana_zalianti', 'AUTO450', 2025, 450),
(1086, 'degha_prayudha_suhendra', 'AUTO451', 2025, 451),
(1087, 'ardiana_soleha', 'AUTO452', 2025, 452),
(1088, 'baiq_dinda_rizquita_andriyani', 'AUTO453', 2025, 453),
(1089, 'robiatul_adawiyah', 'AUTO454', 2025, 454),
(1090, 'taffana_wanda_salsabilla', 'AUTO455', 2025, 455),
(1091, 'rion_farmaditya', 'AUTO456', 2025, 456),
(1092, 'wiya_lara_putri', 'AUTO457', 2025, 457),
(1093, 'baiq_rina_ardianti', 'AUTO458', 2025, 458),
(1094, 'virga_priyanka_septia_wardani', 'AUTO459', 2025, 459),
(1095, 'cahya_fadhillah_azis', 'AUTO460', 2025, 460),
(1096, 'ratul_alvia', 'AUTO461', 2025, 461),
(1097, 'aida_cinta_mentari', 'AUTO462', 2025, 462),
(1098, 'm_arif_aditya', 'AUTO463', 2025, 463),
(1099, 'giorgi_fredrick_maitimu', 'AUTO464', 2025, 464),
(1100, 'olivia_klariza', 'AUTO465', 2025, 465),
(1101, 'alya', 'AUTO467', 2025, 467);

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota_minat_bakat`
--

CREATE TABLE `anggota_minat_bakat` (
  `id` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_minat_bakat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota_minat_bakat`
--

INSERT INTO `anggota_minat_bakat` (`id`, `id_anggota`, `id_minat_bakat`) VALUES
(1, 628, 1),
(2, 628, 2),
(3, 629, 2),
(4, 629, 3),
(5, 630, 3),
(6, 630, 1),
(7, 631, 4),
(8, 631, 2),
(9, 632, 1),
(10, 632, 3),
(11, 633, 2),
(12, 633, 4),
(13, 634, 3),
(14, 634, 1),
(15, 635, 4),
(16, 635, 2),
(17, 636, 1),
(18, 636, 4),
(19, 637, 2),
(20, 637, 1),
(21, 638, 3),
(22, 638, 2),
(23, 639, 4),
(24, 639, 3),
(25, 640, 1),
(26, 640, 2),
(27, 641, 2),
(28, 641, 3),
(29, 642, 3),
(30, 642, 4),
(31, 643, 4),
(32, 643, 1),
(33, 644, 1),
(34, 644, 2),
(35, 645, 2),
(36, 645, 3),
(37, 646, 3),
(38, 646, 4),
(39, 647, 4),
(40, 647, 1),
(41, 648, 1),
(42, 648, 3),
(43, 649, 2),
(44, 649, 4),
(45, 650, 3),
(46, 650, 1),
(47, 651, 4),
(48, 651, 2),
(49, 652, 1),
(50, 652, 2),
(51, 654, 3),
(52, 654, 3),
(53, 655, 4),
(54, 655, 1),
(55, 656, 1),
(56, 656, 3),
(57, 657, 2),
(58, 657, 2),
(59, 658, 3),
(60, 658, 2),
(61, 659, 4),
(62, 659, 3),
(63, 660, 1),
(64, 660, 4),
(65, 661, 2),
(66, 661, 3),
(67, 662, 3),
(68, 662, 1),
(69, 663, 4),
(70, 663, 2),
(71, 664, 1),
(72, 664, 2),
(73, 665, 2),
(74, 665, 4),
(75, 666, 3),
(76, 666, 1),
(77, 667, 4),
(78, 667, 3),
(79, 668, 1),
(80, 668, 4),
(81, 669, 2),
(82, 669, 1),
(83, 670, 3),
(84, 670, 2),
(85, 671, 4),
(86, 671, 1),
(87, 672, 1),
(88, 672, 3),
(89, 673, 2),
(90, 673, 4),
(91, 674, 3),
(92, 674, 2),
(93, 675, 4),
(94, 675, 3),
(95, 677, 2),
(96, 677, 1),
(97, 679, 4),
(98, 679, 2),
(99, 680, 1),
(100, 680, 2),
(101, 681, 2),
(102, 681, 3),
(103, 682, 3),
(104, 682, 4),
(105, 683, 4),
(106, 683, 1),
(107, 684, 1),
(108, 684, 2),
(109, 685, 2),
(110, 685, 3),
(111, 686, 3),
(112, 686, 1),
(113, 687, 4),
(114, 687, 2),
(115, 688, 1),
(116, 688, 3),
(117, 689, 2),
(118, 689, 4),
(119, 690, 3),
(120, 690, 2),
(121, 691, 4),
(122, 691, 1),
(123, 692, 1),
(124, 692, 4),
(125, 693, 2),
(126, 693, 3),
(127, 694, 3),
(128, 694, 1),
(129, 695, 4),
(130, 695, 2),
(131, 696, 1),
(132, 696, 2),
(133, 697, 2),
(134, 697, 3),
(135, 698, 3),
(136, 698, 4),
(137, 699, 4),
(138, 699, 1),
(139, 700, 1),
(140, 700, 3),
(141, 701, 2),
(142, 701, 4),
(143, 702, 3),
(144, 702, 1),
(145, 703, 4),
(146, 703, 2),
(147, 704, 1),
(148, 704, 2),
(151, 706, 3),
(152, 706, 4),
(153, 707, 4),
(154, 707, 1),
(155, 708, 1),
(156, 708, 3),
(157, 709, 2),
(158, 709, 4),
(159, 710, 3),
(160, 710, 2),
(161, 711, 4),
(162, 711, 1),
(163, 712, 1),
(164, 712, 2),
(165, 713, 2),
(166, 713, 3),
(167, 714, 3),
(168, 714, 4),
(169, 715, 4),
(170, 715, 2),
(171, 716, 1),
(172, 716, 3),
(173, 717, 2),
(174, 717, 1),
(175, 718, 3),
(176, 718, 2),
(177, 719, 4),
(178, 719, 1),
(179, 720, 1),
(180, 720, 4),
(181, 721, 2),
(182, 721, 3),
(183, 722, 3),
(184, 722, 1),
(185, 723, 4),
(186, 723, 2),
(187, 724, 1),
(188, 724, 2),
(189, 725, 2),
(190, 725, 4),
(191, 727, 1),
(192, 727, 3),
(193, 729, 1),
(194, 729, 2),
(195, 730, 11),
(196, 729, 9),
(197, 989, 1);

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
  `id_book` int(11) NOT NULL,
  `nama_client` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `jenis_talent` varchar(50) NOT NULL,
  `jumlah_talent` int(11) NOT NULL,
  `tanggal_acara` date NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `durasi` int(11) NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluasi`
--

CREATE TABLE `evaluasi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `umpan_balik` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `evaluasi`
--

INSERT INTO `evaluasi` (`id`, `user_id`, `umpan_balik`, `created_at`, `updated_at`) VALUES
(2, 644, 'anjay', '2025-06-03 10:36:52', '2025-06-03 14:58:15'),
(4, 652, 'cfksDn[ jf[oc0', '2025-06-03 10:49:04', '2025-06-03 11:34:01'),
(5, 700, 'nACN?JLB jlDBvjls FNcelKFbKEF', '2025-06-03 14:50:22', NULL),
(11, 628, 'hj,acsbCH SCJNSV', '2025-06-07 04:07:14', '2025-06-21 03:07:04'),
(12, 630, 'znv djowa\'M', '2025-06-08 05:42:23', NULL),
(13, 632, 'aFWKChn akw\"qwi', '2025-06-10 02:54:14', NULL),
(14, 634, 'nayla ga pernah latihan', '2025-06-21 00:49:23', '2025-06-30 03:50:19'),
(16, 629, 'nkasnfks', '2025-06-21 03:07:16', NULL),
(17, 631, 'tingkatkan lagi performa dalam tampil', '2025-06-21 03:13:25', '2025-06-21 13:22:41'),
(18, 636, 'njsndfk', '2025-06-23 01:25:04', NULL),
(19, 637, 'uuuuuuuuuuu cupuuuuuuuuu', '2025-06-30 03:50:36', NULL);

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
(3, 5, '2025-06-01', '10:00:00', 'Workshop akting untuk Teater'),
(4, 7, '2025-06-03', '13:00:00', 'Pengambilan footage dokumentasi untuk Videografi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_rutin`
--

CREATE TABLE `jadwal_rutin` (
  `id` int(11) NOT NULL,
  `id_minat_bakat` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam` time NOT NULL,
  `durasi_latihan` int(11) NOT NULL,
  `mentor` varchar(100) NOT NULL,
  `id_bidang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jadwal_rutin`
--

INSERT INTO `jadwal_rutin` (`id`, `id_minat_bakat`, `hari`, `jam`, `durasi_latihan`, `mentor`, `id_bidang`) VALUES
(8, 1, 'Senin', '17:00:00', 3, 'Budi Santoso', 1),
(9, 2, 'Selasa', '17:00:00', 3, 'Siti Aisyah', 1),
(10, 3, 'Rabu', '18:00:00', 2, 'Rizky Pratama', 1),
(11, 5, 'Kamis', '19:00:00', 2, 'Indra Wijaya', 3),
(12, 6, 'Jumat', '20:00:00', 2, 'Dewi Ambarwati', 3),
(13, 7, 'Sabtu', '21:00:00', 2, 'Teguh Saputra', 3),
(14, 8, 'Minggu', '22:00:00', 2, 'Lina Kartika', 3),
(15, 10, 'Senin', '16:30:00', 3, 'Aldi Ramadhan', 2),
(16, 11, 'Selasa', '17:30:00', 2, 'Rina Putri', 2),
(17, 12, 'Rabu', '18:30:00', 2, 'Farhan Malik', 2);

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
(2, 'Modern Dance', 1, 'fgujjjj', 'Teknik freestyle dan ritme', '999'),
(3, 'Kontemporer', 1, NULL, 'Eksplorasi gerak tubuh', NULL),
(4, 'Requested', 1, NULL, 'Koreografi sesuai permintaan', NULL),
(7, 'Kontemporer', 1, NULL, 'Eksplorasi gerak tubuh', 'https://docs.google.com/example3'),
(8, 'Requested', 1, NULL, 'Koreografi sesuai permintaan', NULL),
(10, 'Tari Tradisional', 12, 'belajar cara agem bali', 'agem', '\"https://www.youtube.com/embed/DApr5zWiO_s?si=R-reTG_Q7fPvgRJs\" '),
(13, 'Modern Dance', 5, 'belajar dasar dasarnua', 'waking', 'e');

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
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `minat_bakat` varchar(100) NOT NULL,
  `waktu_daftar` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `nama`, `no_hp`, `jurusan`, `nim`, `minat_bakat`, `waktu_daftar`) VALUES
(1, 'baiq altania dinda eka putri', '08787676545', 'teknik informatika', 'f1d0218888888', 'Modern Dance', '2025-06-13 09:38:31'),
(2, 'nela', '08787676545', 'teknik informatika', 'f1d0218888888', 'Tari Tradisional', '2025-06-13 09:39:41'),
(3, 'x', 'z', 'w', 'r', 'Tari Tradisional', '2025-06-23 10:57:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL
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
  `kontak` int(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `nama_pengurus`, `nim`, `angkatan`, `jabatan`, `kontak`, `user_id`) VALUES
(1, 'Andi Wijaya', '999', 2021, 'Ketua', 2147483640, NULL),
(2, 'Budi Santoso', '2002234568', 2021, 'Wakil Ketua', 2147483647, NULL),
(3, 'Citra Dewi', '2003234569', 2022, 'Sekretaris', 2147483647, NULL),
(4, 'Dewi Lestari', '2004234570', 2023, 'Bendahara', 2147483647, NULL),
(5, 'adelia', 'f1d02310006', 2023, 'wakil kepala bidang gerak', 818987, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `telepon` varchar(30) NOT NULL,
  `item` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `durasi` int(11) NOT NULL,
  `waktu_submit` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `nama`, `email`, `nama_kegiatan`, `telepon`, `item`, `tanggal`, `durasi`, `waktu_submit`) VALUES
(1, 'adel', 'baiqdelia02@gmail.com', 'resepsi', '087861530994', 'properti_tari', '2025-06-21', 2, '2025-06-13 09:05:22'),
(2, 'lincon', 'baiqdelia01@gmail.com', 'pembukaan blablabla', '098976543', 'selendang_bali', '2025-06-24', 2, '2025-06-23 10:41:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `portofolio`
--

CREATE TABLE `portofolio` (
  `id_portofolio` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `portofolio`
--

INSERT INTO `portofolio` (`id_portofolio`, `judul`, `deskripsi`, `link`) VALUES
(1, 'Penampilan Tari Kreasi Wonderlandddd', 'Penampilan tari Saman oleh 17 penari Sanggar Birama pada acara NIGHT WITH SENBUD', 'https://www.youtube.com/embed/ExvZZSnNfus?si=QIpSW4X0I35xCN5-'),
(2, 'Bajidor Kahot', 'PENAMPILAN TARI BAJIDOR KAHOT YANG PERNAH DITAMPILKAN DI ACARA NASIONAL UNIVERSITAS MATARAM.', 'https://www.youtube.com/embed/Jsra3dmpxL8?si=XFzmPRHl0F3MS1Gf'),
(3, 'Dance dalam kegiatan Night with Senbud', 'Tim modern dance Sanggar Birama berhasil menampilkan penampilan terbaik dalam kegiatan Night with Senbud.', 'https://www.youtube.com/embed/975NucnQTXY?si=FB5Y82kCDBvEqK7_'),
(4, 'MEGA crew', 'Mega crew dance persembahan sanggar BIRAMA.', 'https://www.youtube.com/embed/o1g1qpeh834?si=4MpFkOvDvmu4QoXo'),
(5, 'video gogo rancah', 'video garapan anggota ukmu seni budaya \"Alief Shota\" yg mengangkat budaya daerah ntb', 'https://www.youtube.com/embed/EDPvyqzq9iY?si=n1cIaPOnEOLtrvVm');

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
(1, 'Pelatihan Dasar Anggota', '2024-07-01', '2024-07-05', 'Pelatihan dasar untuk anggota baru.', 1, 720, 'Perencanaan', '0000-00-00'),
(2, 'Festival Seni', '2024-08-10', '2024-08-12', 'Festival seni tahunan.', 2, 727, 'Perencanaan', '0000-00-00'),
(5, 'Lomba Tari', '2024-11-20', '2024-11-21', 'Lomba tari antar sekolah.', 5, NULL, 'Perencanaan', NULL),
(6, 'bersih bersih sekret', '2025-02-02', '2025-12-12', 'berish bersih dah', 4, 640, 'berjalan', '2025-12-31');

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
(5, 1, 'AAU\r\n', '2025-06-23 10:31:58'),
(6, 1, 'yuiojj', '2025-06-30 10:50:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sesi_absensi`
--

CREATE TABLE `sesi_absensi` (
  `id` int(11) NOT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `nama_sesi` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` enum('dibuka','ditutup') NOT NULL DEFAULT 'ditutup'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sesi_absensi`
--

INSERT INTO `sesi_absensi` (`id`, `id_jadwal`, `nama_sesi`, `tanggal`, `status`) VALUES
(33, 9, 'Absensi Rutin', '2025-06-12', 'ditutup'),
(34, 9, 'Absensi Rutin', '2025-06-13', 'ditutup'),
(44, 4, 'Absensi Kondisional', '2025-06-24', 'ditutup'),
(45, 9, 'Absensi Rutin', '2025-06-24', 'ditutup'),
(46, 9, 'Absensi Rutin', '2025-06-22', 'ditutup'),
(48, 9, 'Absensi Rutin', '2025-06-26', 'dibuka'),
(49, 8, 'Absensi Rutin', '2025-07-01', 'ditutup'),
(50, 8, 'Absensi Rutin', '2025-07-01', 'ditutup'),
(51, 8, 'Absensi Rutin', '2025-06-30', 'dibuka');

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
(1, 'tim tari bajidor kahott', 'Penari yang menampilkan tarian tradisional khas daerah jawa bali bajidor kahot, dengan beberapa varian jumlah penari yang dapat di sesuaikan dengan kebutuhan anda'),
(2, 'modern dance', 'penari hip hop dengan musik modern dan beat cepat'),
(3, 'band birama satu', 'band birama dengan susunan: gitar, bass, keyboard, vocal, drum'),
(4, 'vocal solo', 'penyanyi laki-laki atau perempuan yang siap di minta nyanyi lagu apapun'),
(5, 'paket 10 penari gandrung', 'tarian gandrung dibawakan oleh 10 orang penari'),
(7, 'band birama satu', 'yyyy');

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
(465, 'olivia_klariza', 'A1C02410105', 'anggota'),
(466, 'nayla', '$2y$10$aDCvgjfTlPhl65Il6Ff2c.b4Kp9HwZq.jSYhJuRfqpEg8MX8T2bjC', 'anggota'),
(467, 'alya', '$2y$10$qb8VlRXy1H4BdasJM6Oz7.kqlPlgLDSPpo.epIuwQ4qiNGFDUDG56', 'anggota'),
(468, 'lalu bayu sukma aji', '$2y$10$UpXaK48K2B15BlfFDBZcPuIsn0t/CIB/MGph/eMdygyez8wrefMNi', 'anggota');

--
-- Trigger `users`
--
DELIMITER $$
CREATE TRIGGER `after_insert_user_anggota` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.role = 'anggota' THEN
        INSERT INTO anggota (nama, nra, angkatan, user_id)
        VALUES (NEW.username, '', YEAR(CURDATE()), NEW.id);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert_user_pengurus` AFTER INSERT ON `users` FOR EACH ROW BEGIN
    IF NEW.role = 'pengurus' THEN
        INSERT INTO pengurus (nama_pengurus, nim, angkatan, jabatan, kontak, user_id)
        VALUES (NEW.username, '', YEAR(CURDATE()), '', 0, NEW.id);
    END IF;
END
$$
DELIMITER ;

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
-- Indeks untuk tabel `anggota_minat_bakat`
--
ALTER TABLE `anggota_minat_bakat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_minat_bakat` (`id_minat_bakat`);

--
-- Indeks untuk tabel `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indeks untuk tabel `book_talent`
--
ALTER TABLE `book_talent`
  ADD PRIMARY KEY (`id_book`);

--
-- Indeks untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user` (`user_id`);

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
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`);

--
-- Indeks untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`);

--
-- Indeks untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  ADD PRIMARY KEY (`id_portofolio`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1102;

--
-- AUTO_INCREMENT untuk tabel `anggota_minat_bakat`
--
ALTER TABLE `anggota_minat_bakat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT untuk tabel `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `book_talent`
--
ALTER TABLE `book_talent`
  MODIFY `id_book` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `inventaris`
--
ALTER TABLE `inventaris`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `jadwal_kondisional`
--
ALTER TABLE `jadwal_kondisional`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jadwal_rutin`
--
ALTER TABLE `jadwal_rutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `materi_latihan`
--
ALTER TABLE `materi_latihan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `portofolio`
--
ALTER TABLE `portofolio`
  MODIFY `id_portofolio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `program_kerja`
--
ALTER TABLE `program_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `progress_proker`
--
ALTER TABLE `progress_proker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sesi_absensi`
--
ALTER TABLE `sesi_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `sewa_barang`
--
ALTER TABLE `sewa_barang`
  MODIFY `id_sewa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `talent`
--
ALTER TABLE `talent`
  MODIFY `id_talent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=469;

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
-- Ketidakleluasaan untuk tabel `anggota_minat_bakat`
--
ALTER TABLE `anggota_minat_bakat`
  ADD CONSTRAINT `anggota_minat_bakat_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `anggota_minat_bakat_ibfk_2` FOREIGN KEY (`id_minat_bakat`) REFERENCES `minat_bakat` (`id_minat_bakat`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD CONSTRAINT `fk_evaluasi_anggota` FOREIGN KEY (`user_id`) REFERENCES `anggota` (`id`) ON DELETE CASCADE;

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
