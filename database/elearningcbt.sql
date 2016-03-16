-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Mar 2016 pada 10.31
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elearningcbt`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `actions`
--

DROP TABLE IF EXISTS `actions`;
CREATE TABLE IF NOT EXISTS `actions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `modul` varchar(20) NOT NULL DEFAULT '',
  `posisi` int(1) NOT NULL DEFAULT '0',
  `order` int(3) NOT NULL DEFAULT '0',
  `modul_id` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `modul_id` (`modul_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data untuk tabel `actions`
--

INSERT INTO `actions` (`id`, `modul`, `posisi`, `order`, `modul_id`) VALUES
(35, 'news', 1, 0, 32),
(36, 'news', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(30) NOT NULL DEFAULT '',
  `url` varchar(60) NOT NULL DEFAULT '',
  `mod` int(1) NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL,
  `parent` int(2) NOT NULL DEFAULT '0',
  `icon` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=105 ;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `menu`, `url`, `mod`, `ordering`, `parent`, `icon`) VALUES
(5, 'Master', '#', 0, 6, 0, 'icon_drive'),
(8, 'Menus', 'menu', 1, 1, 4, ''),
(14, 'Admin User', 'user', 1, 1, 2, ''),
(96, 'E-Learning', '#', 0, 7, 0, 'icon_box-checked'),
(2, 'Settings', '#', 0, 2, 0, ' icon_tools'),
(77, 'Kelas', 'kelas', 1, 1, 5, ''),
(79, 'Siswa', 'importsiswa', 1, 2, 5, ''),
(84, 'Mata Pelajaran', 'mapel', 1, 3, 5, ''),
(101, 'Setting E-Learning', 'settingwebsite', 1, 2, 2, ''),
(100, 'Latihan Ujian', 'ujian', 1, 4, 96, ''),
(99, 'Pengumuman Sekolah', 'pengumuman', 1, 3, 96, ''),
(103, 'File Manager', 'filemanager', 1, 4, 5, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `infoguru`
--

DROP TABLE IF EXISTS `infoguru`;
CREATE TABLE IF NOT EXISTS `infoguru` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `guru` varchar(255) NOT NULL,
  `statusemail` enum('tampilkan','sembunyikan') NOT NULL,
  `statustelp` enum('tampilkan','sembunyikan') NOT NULL,
  `email` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `intrusions`
--

DROP TABLE IF EXISTS `intrusions`;
CREATE TABLE IF NOT EXISTS `intrusions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `page` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `impact` int(11) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `intrusions`
--

INSERT INTO `intrusions` (`id`, `name`, `value`, `page`, `ip`, `impact`, `created`) VALUES
(1, 'judul', 'ibrahimovic-hamil-delapan-bulan-3-6-2', '/auracms2.3/article-9-ibrahimovic-hamil-delapan-bulan-3-6-2.html', 'local/unknown', 7, '2010-08-28 04:00:00'),
(2, '_SERVER.DOCUMENT_ROOT', 'http://94.199.51.7/readme.txt?', '/?_SERVER[DOCUMENT_ROOT]=http://94.199.51.7/readme.txt?', '94.199.51.7', 5, '2013-04-17 00:41:17'),
(3, '_ult', 'sec=web&slk=web&pos=3&linkstr=http%3A%2F%2Fppikom.com%2Farticle-cara-mengkrimping-kabel-rj45-dan-urutan-warna-kabel-straight-amp-cross.html', '/article-cara-mengkrimping-kabel-rj45-dan-urutan-warna-kabel-straight-amp-cross.html?_ult=sec%3Dweb%26slk%3Dweb%26pos%3D3%26linkstr%3Dhttp%253A%252F%252Fppikom.com%252Farticle-cara-mengkrimping-kabel-rj45-dan-urutan-warna-kabel-straight-amp-cross.html', '50.57.206.196', 15, '2013-06-20 15:11:19'),
(4, '_SERVER.DOCUMENT_ROOT', 'data://text/plain;base64,U0hFTExfTU9KTk9fUFJPQk9WQVRK?', '/?_SERVER[DOCUMENT_ROOT]=data://text/plain;base64,U0hFTExfTU9KTk9fUFJPQk9WQVRK?', '79.135.239.234', 10, '2013-09-09 06:15:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

DROP TABLE IF EXISTS `kelas`;
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(25, 'XII-IPA1'),
(26, 'XII-IPA2'),
(27, 'XII-IPA3'),
(28, 'XII-IPA4'),
(29, 'XII-IPA5'),
(30, 'XII-IPA6'),
(31, 'XII-IPS1'),
(32, 'XII-IPS2'),
(33, 'XII-IPS3'),
(34, 'XII-IPS4'),
(35, 'XII-SC');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_isi`
--

DROP TABLE IF EXISTS `kelas_isi`;
CREATE TABLE IF NOT EXISTS `kelas_isi` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(255) NOT NULL,
  `siswa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siswa` (`siswa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1065 ;

--
-- Dumping data untuk tabel `kelas_isi`
--

INSERT INTO `kelas_isi` (`id`, `kelas`, `siswa`) VALUES
(1, '25', 'siswa12'),
(752, '25', '16613'),
(753, '25', '16622'),
(754, '25', '16624'),
(755, '25', '16639'),
(756, '25', '16645'),
(757, '25', '16662'),
(758, '25', '16672'),
(759, '25', '16680'),
(760, '25', '16685'),
(761, '25', '16690'),
(762, '25', '16704'),
(763, '25', '16713'),
(764, '25', '16717'),
(765, '25', '16725'),
(766, '25', '16744'),
(767, '25', '16745'),
(768, '25', '16753'),
(769, '25', '16757'),
(770, '25', '16758'),
(771, '25', '16764'),
(772, '25', '16772'),
(773, '25', '16790'),
(774, '25', '16798'),
(775, '25', '16826'),
(776, '25', '16828'),
(777, '25', '16852'),
(778, '25', '16855'),
(779, '25', '16861'),
(780, '25', '16863'),
(781, '25', '16879'),
(782, '25', '16907'),
(783, '25', '16923'),
(784, '25', '16924'),
(785, '25', '16928'),
(786, '26', '16628'),
(787, '26', '16634'),
(788, '26', '16640'),
(789, '26', '16646'),
(790, '26', '16653'),
(791, '26', '16663'),
(792, '26', '16674'),
(793, '26', '16682'),
(794, '26', '16684'),
(795, '26', '16688'),
(796, '26', '16698'),
(797, '26', '16706'),
(798, '26', '16711'),
(799, '26', '16716'),
(800, '26', '16719'),
(801, '26', '16722'),
(802, '26', '16727'),
(803, '26', '16743'),
(804, '26', '16760'),
(805, '26', '16763'),
(806, '26', '16769'),
(807, '26', '16782'),
(808, '26', '16784'),
(809, '26', '16788'),
(810, '26', '16825'),
(811, '26', '16833'),
(812, '26', '16844'),
(813, '26', '16850'),
(814, '26', '16867'),
(815, '26', '16876'),
(816, '26', '16892'),
(817, '26', '16896'),
(818, '26', '16897'),
(819, '26', '16913'),
(820, '27', '16620'),
(821, '27', '16625'),
(822, '27', '16630'),
(823, '27', '16658'),
(824, '27', '16668'),
(825, '27', '16673'),
(826, '27', '16681'),
(827, '27', '16694'),
(828, '27', '16707'),
(829, '27', '16751'),
(830, '27', '16755'),
(831, '27', '16768'),
(832, '27', '16779'),
(833, '27', '16781'),
(834, '27', '16791'),
(835, '27', '16797'),
(836, '27', '16804'),
(837, '27', '16806'),
(838, '27', '16809'),
(839, '27', '16822'),
(840, '27', '16832'),
(841, '27', '16838'),
(842, '27', '16841'),
(843, '27', '16842'),
(844, '27', '16848'),
(845, '27', '16849'),
(846, '27', '16875'),
(847, '27', '16880'),
(848, '27', '16894'),
(849, '27', '16898'),
(850, '27', '16903'),
(851, '27', '16909'),
(852, '27', '16916'),
(853, '27', '16918'),
(854, '27', '16921'),
(855, '28', '16619'),
(856, '28', '16629'),
(857, '28', '16635'),
(858, '28', '16661'),
(859, '28', '16683'),
(860, '28', '16686'),
(861, '28', '16693'),
(862, '28', '16696'),
(863, '28', '16697'),
(864, '28', '16705'),
(865, '28', '16715'),
(866, '28', '16721'),
(867, '28', '16736'),
(868, '28', '16739'),
(869, '28', '16766'),
(870, '28', '16774'),
(871, '28', '16787'),
(872, '28', '16796'),
(873, '28', '16815'),
(874, '28', '16830'),
(875, '28', '16835'),
(876, '28', '16840'),
(877, '28', '16846'),
(878, '28', '16868'),
(879, '28', '16874'),
(880, '28', '16891'),
(881, '28', '16900'),
(882, '28', '16902'),
(883, '28', '16904'),
(884, '28', '16915'),
(885, '28', '16917'),
(886, '28', '16922'),
(887, '28', '16927'),
(888, '28', '16929'),
(889, '29', '16632'),
(890, '29', '16636'),
(891, '29', '16638'),
(892, '29', '16641'),
(893, '29', '16652'),
(894, '29', '16655'),
(895, '29', '16671'),
(896, '29', '16676'),
(897, '29', '16687'),
(898, '29', '16712'),
(899, '29', '16730'),
(900, '29', '16731'),
(901, '29', '16737'),
(902, '29', '16750'),
(903, '29', '16773'),
(904, '29', '16777'),
(905, '29', '16778'),
(906, '29', '16793'),
(907, '29', '16794'),
(908, '29', '16807'),
(909, '29', '16811'),
(910, '29', '16824'),
(911, '29', '16843'),
(912, '29', '16847'),
(913, '29', '16851'),
(914, '29', '16853'),
(915, '29', '16856'),
(916, '29', '16862'),
(917, '29', '16878'),
(918, '29', '16881'),
(919, '29', '16906'),
(920, '29', '16908'),
(921, '29', '16912'),
(922, '29', '16919'),
(923, '31', '16623'),
(924, '31', '16633'),
(925, '31', '16644'),
(926, '31', '16647'),
(927, '31', '16649'),
(928, '31', '16665'),
(929, '31', '16670'),
(930, '31', '16703'),
(931, '31', '16709'),
(932, '31', '16723'),
(933, '31', '16732'),
(934, '31', '16740'),
(935, '31', '16749'),
(936, '31', '16762'),
(937, '31', '16770'),
(938, '31', '16775'),
(939, '31', '16786'),
(940, '31', '16802'),
(941, '31', '16805'),
(942, '31', '16816'),
(943, '31', '16820'),
(944, '31', '16834'),
(945, '31', '16864'),
(946, '31', '16870'),
(947, '31', '16884'),
(948, '31', '16895'),
(949, '31', '16899'),
(950, '31', '16901'),
(951, '31', '16910'),
(952, '31', '16925'),
(953, '31', '16926'),
(954, '32', '16614'),
(955, '32', '16617'),
(956, '32', '16621'),
(957, '32', '16626'),
(958, '32', '16637'),
(959, '32', '16651'),
(960, '32', '16656'),
(961, '32', '16659'),
(962, '32', '16675'),
(963, '32', '16678'),
(964, '32', '16700'),
(965, '32', '16718'),
(966, '32', '16726'),
(967, '32', '16729'),
(968, '32', '16734'),
(969, '32', '16747'),
(970, '32', '16759'),
(971, '32', '16765'),
(972, '32', '16789'),
(973, '32', '16799'),
(974, '32', '16808'),
(975, '32', '16813'),
(976, '32', '16819'),
(977, '32', '16845'),
(978, '32', '16854'),
(979, '32', '16858'),
(980, '32', '16859'),
(981, '32', '16873'),
(982, '32', '16886'),
(983, '32', '16890'),
(984, '32', '16893'),
(985, '32', '16930'),
(986, '33', '16618'),
(987, '33', '16631'),
(988, '33', '16654'),
(989, '33', '16660'),
(990, '33', '16666'),
(991, '33', '16667'),
(992, '33', '16679'),
(993, '33', '16695'),
(994, '33', '16710'),
(995, '33', '16714'),
(996, '33', '16735'),
(997, '33', '16742'),
(998, '33', '16746'),
(999, '33', '16748'),
(1000, '33', '16761'),
(1001, '33', '16771'),
(1002, '33', '16776'),
(1003, '33', '16792'),
(1004, '33', '16803'),
(1005, '33', '16812'),
(1006, '33', '16817'),
(1007, '33', '16821'),
(1008, '33', '16823'),
(1009, '33', '16829'),
(1010, '33', '16836'),
(1011, '33', '16866'),
(1012, '33', '16872'),
(1013, '33', '16882'),
(1014, '33', '16883'),
(1015, '33', '16889'),
(1016, '33', '16920'),
(1017, '34', '16616'),
(1018, '34', '16627'),
(1019, '34', '16642'),
(1020, '34', '16648'),
(1021, '34', '16650'),
(1022, '34', '16669'),
(1023, '34', '16677'),
(1024, '34', '16689'),
(1025, '34', '16691'),
(1026, '34', '16699'),
(1027, '34', '16701'),
(1028, '34', '16708'),
(1029, '34', '16728'),
(1030, '34', '16741'),
(1031, '34', '16752'),
(1032, '34', '16754'),
(1033, '34', '16767'),
(1034, '34', '16783'),
(1035, '34', '16785'),
(1036, '34', '16800'),
(1037, '34', '16810'),
(1038, '34', '16814'),
(1039, '34', '16818'),
(1040, '34', '16831'),
(1041, '34', '16839'),
(1042, '34', '16857'),
(1043, '34', '16860'),
(1044, '34', '16865'),
(1045, '34', '16885'),
(1046, '34', '16888'),
(1047, '34', '16911'),
(1048, '34', '16914'),
(1049, '35', '16643'),
(1050, '35', '16692'),
(1051, '35', '16702'),
(1052, '35', '16720'),
(1053, '35', '16733'),
(1054, '35', '16738'),
(1055, '35', '16756'),
(1056, '35', '16795'),
(1057, '35', '16801'),
(1058, '35', '16827'),
(1059, '35', '16837'),
(1060, '35', '16869'),
(1061, '35', '16871'),
(1062, '35', '16877'),
(1063, '35', '16887'),
(1064, '25', 'kelas12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kursus_setting`
--

DROP TABLE IF EXISTS `kursus_setting`;
CREATE TABLE IF NOT EXISTS `kursus_setting` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `guru` varchar(255) NOT NULL,
  `mapel` varchar(255) NOT NULL,
  `tahun` varchar(255) NOT NULL,
  `kelas` varchar(512) NOT NULL,
  `judul` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

DROP TABLE IF EXISTS `mapel`;
CREATE TABLE IF NOT EXISTS `mapel` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `mapel` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`id`, `mapel`, `icon`) VALUES
(5, 'KIMIA', '98dce83da57b0395e163467c9dae521b.jpg'),
(6, 'BAHASA INDONESIA', 'c16a5320fa475530d9583c34fd356ef5.jpg'),
(7, 'BAHASA INGGRIS', '6ea9ab1baa0efb9e19094440c317e21b.jpg'),
(8, 'MATEMATIKA', '9a1158154dfa42caddbd0694a4e9bdc8.jpg'),
(9, 'FISIKA', 'b53b3a3d6ab90ce0268229151c9bde11.jpg'),
(10, 'BIOLOGI', 'f899139df5e1059396431415e770c6dd.jpg'),
(11, 'GEOGRAFI', '43ec517d68b6edd3015b3edc9a11367b.jpg'),
(12, 'EKONOMI', '8613985ec49eb8f757ae6439e879bb2a.jpg'),
(13, 'SOSIOLOGI', 'e2ef524fbf3d9fe611d5a8e90fefdc9c.jpg'),
(14, 'UJIAN SIM', 'ea5d2f1c4608232e07d3aa3d998e5135.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel_icon`
--

DROP TABLE IF EXISTS `mapel_icon`;
CREATE TABLE IF NOT EXISTS `mapel_icon` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `mapel_icon`
--

INSERT INTO `mapel_icon` (`id`, `icon`) VALUES
(1, 'icon01.jpg'),
(2, 'icon02.jpg'),
(3, 'icon03.jpg'),
(4, 'icon04.jpg'),
(5, 'icon05.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

DROP TABLE IF EXISTS `materi`;
CREATE TABLE IF NOT EXISTS `materi` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `pertemuan` int(3) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `materi` varchar(255) NOT NULL,
  `guru` varchar(255) NOT NULL,
  `idkursus` varchar(512) NOT NULL,
  `konten` text NOT NULL,
  `kelas` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `menu` varchar(50) NOT NULL DEFAULT '',
  `url` varchar(127) NOT NULL DEFAULT '',
  `published` int(1) NOT NULL DEFAULT '0',
  `ordering` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `menu`, `url`, `published`, `ordering`) VALUES
(1, 'Home', 'index.php', 1, 1),
(2, 'Interaktif', '#', 1, 4),
(22, 'Selebriti', 'category-selebriti.html', 1, 5),
(19, 'Links', 'links.html', 1, 3),
(24, 'TEKNOLOGI', 'category-teknologi.html', 1, 7),
(23, 'Hukum', 'category-hukum.html', 1, 6),
(25, 'SOSIAL', 'category-sosial.html', 1, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_guru`
--

DROP TABLE IF EXISTS `menu_guru`;
CREATE TABLE IF NOT EXISTS `menu_guru` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(2) NOT NULL,
  `parent` int(4) NOT NULL DEFAULT '0',
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data untuk tabel `menu_guru`
--

INSERT INTO `menu_guru` (`id`, `menu`, `url`, `ordering`, `parent`, `icon`) VALUES
(2, 'Ubah Password', 'admin.php?pilih=ubahpassword&mod=yes', 1, 1, ''),
(1, 'Akun', '#', 1, 0, 'icon_profile'),
(26, 'Photo', 'admin.php?pilih=user&mod=yes&aksi=photo', 3, 1, ''),
(25, 'Profil', 'admin.php?pilih=user&mod=yes&aksi=profil', 2, 1, ''),
(23, 'E-Learning', '#', 1, 0, 'icon_box-checked'),
(24, 'Latihan Ujian', 'admin.php?pilih=ujian&mod=yes', 2, 23, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_siswa`
--

DROP TABLE IF EXISTS `menu_siswa`;
CREATE TABLE IF NOT EXISTS `menu_siswa` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(2) NOT NULL,
  `parent` int(4) NOT NULL DEFAULT '0',
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `menu_siswa`
--

INSERT INTO `menu_siswa` (`id`, `menu`, `url`, `ordering`, `parent`, `icon`) VALUES
(2, 'Ubah Password', 'admin.php?pilih=ubahpassword&mod=yes', 1, 1, ''),
(1, 'Akun', '#', 1, 0, 'icon_profile'),
(18, 'Latihan Ujian', 'admin.php?pilih=ujian&mod=yes', 3, 19, ''),
(19, 'E-Learning', '#', 1, 0, 'icon_box-checked');

-- --------------------------------------------------------

--
-- Struktur dari tabel `modul`
--

DROP TABLE IF EXISTS `modul`;
CREATE TABLE IF NOT EXISTS `modul` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `modul` varchar(30) NOT NULL DEFAULT '',
  `isi` text NOT NULL,
  `setup` varchar(50) NOT NULL DEFAULT '',
  `posisi` tinyint(2) NOT NULL DEFAULT '0',
  `published` int(1) NOT NULL DEFAULT '0',
  `ordering` int(5) NOT NULL DEFAULT '0',
  `type` enum('block','module') NOT NULL DEFAULT 'module',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data untuk tabel `modul`
--

INSERT INTO `modul` (`id`, `modul`, `isi`, `setup`, `posisi`, `published`, `ordering`, `type`) VALUES
(1, 'Terbaru', 'mod/news/terakhir.php', '', 1, 1, 3, 'module'),
(2, 'Statistik Situs', 'mod/statistik/stat.php', '', 1, 1, 6, 'module'),
(3, 'Polling', 'mod/polling/polling.php', '', 1, 0, 99, 'module'),
(4, 'Kalender', 'mod/calendar/calendar.php', '', 1, 0, 100, 'module'),
(5, 'Pesan Singkat', 'mod/shoutbox/shoutboxview.php', '', 1, 0, 99, 'module'),
(6, 'Random Links', 'mod/random_link/randomlink.php', '', 1, 0, 100, 'module'),
(7, 'Top Download', 'mod/top_download/topdl.php', '', 1, 0, 99, 'module'),
(8, 'Login', 'mod/login/login.php', '', 1, 0, 99, 'module'),
(10, 'ip logs', 'mod/phpids/ids.php', '', 1, 0, 99, 'module'),
(17, 'Social Widget', 'mod/socialwidget/socialwidget.php', '', 1, 0, 99, 'module'),
(18, 'Follow Us', 'mod/socialurl/socialurl.php', '', 1, 0, 99, 'module'),
(22, 'Follow Kami di Twitter', '<script type="text/javascript" charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>\r\n<script type="text/javascript">\r\nnew TWTR.Widget({\r\n  version: 2,\r\n  type: ''profile'',\r\n  rpp: 4,\r\n  interval: 30000,\r\n  width: 300,\r\n  height: 250,\r\n  theme: {\r\n    shell: {\r\n      background: ''#1E7DC1'',\r\n      color: ''#ffffff''\r\n    },\r\n    tweets: {\r\n      background: ''#ffffff'',\r\n      color: ''#333333'',\r\n      links: ''#eb0707''\r\n    }\r\n  },\r\n  features: {\r\n    scrollbar: true,\r\n    loop: false,\r\n    live: false,\r\n    behavior: ''default''\r\n  }\r\n}).render().setUser(''ppikomkutisari'').start();\r\n</script>', '', 1, 0, 99, 'block'),
(29, 'Apa itu RWD', '<div align="center">\r\n<a href="#"><img src="images/rwd-kecil.jpg"></a>\r\n</div>', '', 1, 1, 5, 'block'),
(32, 'Terpopuler', 'mod/news/terpopuler.php', '', 1, 1, 2, 'module'),
(31, 'Pencarian', 'mod/pencarian/pencarian.php', '', 1, 1, 1, 'module');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengumuman_sekolah`
--

DROP TABLE IF EXISTS `pengumuman_sekolah`;
CREATE TABLE IF NOT EXISTS `pengumuman_sekolah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL DEFAULT '',
  `konten` text NOT NULL,
  `user` varchar(30) NOT NULL DEFAULT '',
  `tgl` date NOT NULL DEFAULT '0000-00-00',
  `hits` int(250) NOT NULL DEFAULT '0',
  `seftitle` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `pengumuman_sekolah`
--

INSERT INTO `pengumuman_sekolah` (`id`, `judul`, `konten`, `user`, `tgl`, `hits`, `seftitle`) VALUES
(1, 'Pengumuman 1XA', '<p><span>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</span></p>', 'admin', '2014-09-01', 0, 'pengumuman-1xa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertemuan`
--

DROP TABLE IF EXISTS `pertemuan`;
CREATE TABLE IF NOT EXISTS `pertemuan` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `pertemuan` varchar(512) NOT NULL,
  `idkursus` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `pertemuan`
--

INSERT INTO `pertemuan` (`id`, `pertemuan`, `idkursus`) VALUES
(1, 'Chapter 1', '5'),
(2, 'Chapter 2', '5'),
(3, 'Chapter 3', '5'),
(4, 'Chapter 4', '5'),
(5, 'Chapter 5', '5'),
(8, 'Pertemuan 1', '15'),
(9, 'Pertemuan1', '14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sensor`
--

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE IF NOT EXISTS `sensor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `word` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `sensor`
--

INSERT INTO `sensor` (`id`, `word`) VALUES
(1, 'Kontol'),
(2, 'Anjing'),
(3, 'Anjeng'),
(4, 'anjrit'),
(5, 'memek'),
(6, 'tempek'),
(7, 'Bangsat'),
(8, 'fuck'),
(9, 'eSDeCe');

-- --------------------------------------------------------

--
-- Struktur dari tabel `situs`
--

DROP TABLE IF EXISTS `situs`;
CREATE TABLE IF NOT EXISTS `situs` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `email_master` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `judul_situs` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `url_situs` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `slogan` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `description` text COLLATE latin1_general_ci NOT NULL,
  `keywords` text COLLATE latin1_general_ci NOT NULL,
  `maxkonten` int(2) NOT NULL DEFAULT '5',
  `maxadmindata` int(2) NOT NULL DEFAULT '5',
  `maxdata` int(2) NOT NULL DEFAULT '5',
  `maxgalleri` int(2) NOT NULL DEFAULT '4',
  `widgetshare` int(2) NOT NULL DEFAULT '0',
  `theme` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'penilaiansikap',
  `author` text COLLATE latin1_general_ci NOT NULL,
  `alamatkantor` text COLLATE latin1_general_ci NOT NULL,
  `publishwebsite` int(1) NOT NULL DEFAULT '1',
  `publishnews` int(2) NOT NULL,
  `maxgalleridata` int(11) NOT NULL,
  `widgetkomentar` int(2) NOT NULL DEFAULT '1',
  `widgetpenulis` int(2) NOT NULL DEFAULT '2',
  `semester` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tahun ajaran` int(50) NOT NULL,
  `tampilan` enum('table','icon') COLLATE latin1_general_ci NOT NULL DEFAULT 'table',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `situs`
--

INSERT INTO `situs` (`id`, `email_master`, `judul_situs`, `url_situs`, `slogan`, `description`, `keywords`, `maxkonten`, `maxadmindata`, `maxdata`, `maxgalleri`, `widgetshare`, `theme`, `author`, `alamatkantor`, `publishwebsite`, `publishnews`, `maxgalleridata`, `widgetkomentar`, `widgetpenulis`, `semester`, `tahun ajaran`, `tampilan`) VALUES
(1, 'admin@admin.com', 'Latihan UN CBT', 'http://localhost/elearningcbt/', 'Slogan / Motto Sekolah', 'Latihan UN CBT', 'surabaya,indonesia', 5, 50, 10, 4, 3, 'elearning', '', '<span>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</span>', 1, 1, 12, 1, 2, '', 0, 'icon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soal`
--

DROP TABLE IF EXISTS `soal`;
CREATE TABLE IF NOT EXISTS `soal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ujian` int(10) NOT NULL,
  `soal` text NOT NULL,
  `pilihan` text NOT NULL,
  `kunci` enum('a','b','c','d','e') NOT NULL,
  `files` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id`, `ujian`, `soal`, `pilihan`, `kunci`, `files`) VALUES
(26, 39, '<span>Fungsi Marka jalan adalah :</span><br /><span>a. Untuk memberi batas jalan agar jalan terlihat jelas oleh pemakai&nbsp;</span><span>jalan Yang sedang berlalu lintas dijalan.</span><br /><span>b. Untuk menambah dan mengurangi kecepatan pemakai jalan yang Berlalu lintas dijalan.</span><br /><span>c. Untuk mengatur lalu lintas atau memperingatkan atau menuntun</span><span>&nbsp;Pemakai jalan dalam berlalu lintas di jalan</span>', 'A#B#C', 'c', ''),
(27, 39, '<span>Yang bukan merupakan Marka Lambang adalah :</span><br /><span>a. Segi tiga</span><br /><span>b. Gambar</span><br /><span>c. Panas</span>', 'A#B#C', 'c', ''),
(28, 39, '<span><span>&nbsp;&nbsp;</span></span><span>Rambu dengan warna dasar kuning dengan lambang atau tulisan&nbsp;Berwarna hitam merupakan<br />a. Rambu petunjuk&nbsp;<br />b. Rambu peringatan<br />c. Rambu perintah</span>', 'A#B#C', 'a', ''),
(29, 39, '<span>Garis ganda yang terdiri dari garis utuh dan garis putus-putus</span><span>&nbsp;termasuk :</span><br /><span>a. Marka membujur</span><br /><span>b. Marka melintang</span><br /><span>c. Marka serong</span>', 'A#B#C', 'a', ''),
(30, 39, '<span>Anda berjalan dengan kecepatan kurang lebih 30 km per jam mendekati persimpangan yang diatur oleh lampu lalu lintas. Ketika lampu berubah dari warna hijau ke kuning, apa yang anda lakukan.</span><br /><span>a. Berhenti</span><br /><span>b. Jalan terus</span><br /><span>c. Bersiap-siap berhenti karena belum melewati garis berhenti</span>', 'A#B#C', 'c', ''),
(31, 39, '<span><span></span></span><span>Apabila anda ingin berpindah jalur dengan aman, maka anda harus&nbsp;<br />a. Memberikan isyarat secara jelas dan tepat waktunya dengan<br />&nbsp; &nbsp; menggunakan petunjuk arah<br />b. Yakin bahwa tidak membahayakan pemakai jalan lain<br />c. Kedua jawaban diatas benar</span>', 'A#B#C', 'c', ''),
(32, 39, '<span>Pengemudi diharuskan memberikan isyarat dengan petunjuk arah yang berkedip pada waktu :</span><br /><span>a. Akan berjalan atau akan mengubah arah ke kanan</span><br /><span>b. Akan berjalan atau akan berhenti</span><br /><span>c. Akan merubah arah ke kiri atau ke kanan.</span>', 'A#B#C', 'c', ''),
(33, 39, '<span>Teknik mengemudikan sepeda motor yang baik pada saat</span><span>&nbsp;gerakan membelok adalah :&nbsp;</span><br /><span>a. Menambah kecepatan pada jarak pendek sebelum mencapai&nbsp;</span><span>tikungan</span><br /><span>b. Memiringkan sepeda motor kearah pusat tikungan dan tetap&nbsp;</span><span>dalam&nbsp;posisi tegak</span><br /><span>c. Memiringkan sepeda motor dan pengemudi kearah pusat</span><span>&nbsp;tikungan&nbsp;yang sesuai dengan kecepatan dan ketajaman tikungan</span>', 'A#B#C', 'c', ''),
(34, 39, '<span>Apa kegunaan bahu jalan&nbsp;</span><br /><span>a. Untuk pejalan Kaki</span><br /><span>b. Untuk berhenti dan parkir</span><br /><span>c. Untuk berhenti dalam keadaan darurat</span>', 'A#B#C', 'b', ''),
(35, 39, '<span>Apa kegunaan helm ?&nbsp;</span><br /><span>a. Untuk melindungi pandangan pengendara, melindungi&nbsp;</span><span>pengendara&nbsp;dari Panas dan hujan</span><br /><span>b. Untuk melindungi kepala dari benturan atau gesekan yang</span><span>&nbsp;mengakibatkan luka di kepala</span><br /><span>c. Untuk menambah penampilan pengendara dan merupakan</span><span>&nbsp;kelengkapan bagi sepeda motor</span>', 'A#B#C', 'b', ''),
(37, 42, 'Perhatikan dengan cermat beberapa pernyataan berikut ini:<br />1. Memaparkan sesuatu hal apa adanya<br />2. Tidak menghakimi benar salahnya suatu hal<br />3. Menggunakan data-data sekunder<br />4. Peneliti bisa mengurangi kesalahan yang diteliti<br />Dari pernyataan-pernyataan tersebut yang merupakan ciri sosiologi ditunjukkan dengan nomor&hellip;.', '1 dan 2#1 dan 3#2 dan 3#2 dan 4#3 dan 4', 'a', ''),
(38, 42, 'Semua hasil observasi dalam sosiologi disusun secara sistematis supaya orang yang membaca dapat memahami pemikiran para tokoh atau pemikiran penulis. Hal ini menunjukkan bahwa sosiologi sebagai ilmu pengetahuan memiliki ciri&hellip;.', 'Empiris<br /><br />#Kategoris<br /><br />#Kumulatif<br /><br />#Teoritis<br /><br />#Nonetis', 'd', ''),
(39, 42, 'Dilakukan sebuah penelitian mengenai manfaat sebuah terminal dengan cara melakukan pengamatan sekilas dan wawancara dengan masyarakat sekitar. Metode yang dilakukan untuk mengumpulkan data tersebut adalah&hellip;./>', 'Observasi dan dokumentasi<br /><br />#Angket dan observasi<br /><br />#Dokumentasi dan wawancara<br /><br />#Observasi dan wawancara<br /><br />#Dokumentasi dan kuesioner', 'd', ''),
(40, 42, 'Rini seorang pelajar mengadakan suatu riset mendalam untuk mencari solusi atas permasalahan sosial di sekitar tempat tinggalnya. Dalam kasus tersebut, merupakan kegunaan sosiologi dalam&hellip;.', 'Pembangunan<br /><br />#Masyarakat luas<br /><br />#Lingkungan<br /><br />#Penelitian<br /><br />#Pemecahan masalah', 'e', ''),
(41, 42, 'Maraknya kasus korupsi yang tidak pernah mendapat sanksi yang tegas menyebabkan penyimpangan itu tumbuh subur di hampir semua lapisan masyarakat. Ini termasuk masalah sosial yang didorong oleh faktor&hellip;.', 'Psikologi<br /><br />#Sosiologi<br /><br />#Biologi<br /><br />#Politik<br /><br />#Budaya', 'e', ''),
(42, 42, 'Sebagai seorang artis yang punya jadwal mengisi acara di banyak tempat, selalu membawa Ipad untuk membantu mengingat jadwal kerja dan berbagai hal yang berkaitan dengan keperluan show-nya. Ini menunjukkan bahwa Ipad baginya memiliki nilai....', 'Vital<br /><br />#Logika<br /><br />#Material<br /><br />#Estetika<br /><br />#Spiritual', 'a', ''),
(43, 42, 'Perilaku berjabat tangan saat bertemu teman atau sahabat, menghormati orang yang lebih tua, makan dengan tangan kanan, berpakaian bagus pada waktu pesta serta berjalan kaki di jalur kiri merupakan contoh dari norma&hellip;.', 'Sosial<br /><br />#Tata kelakuan<br /><br />#Custom<br /><br />#Kelaziman<br /><br />#Folkways', 'b', ''),
(44, 42, 'Perhatikan data-data berikut ini!<br />1. Tahap penerimaan kolektif (generalized other)<br />2. Tahap persiapan (preparatory stage)<br />3. Tahap siap bertindak (game stage)<br />4. Tahap meniru (play stage)<br />Tahapan sosialisasi dalam pembentukan kepribadian dari awal sampai terakhir yang benar ditunjukkan dengan nomor&hellip;.', '2, 4, 3, dan 1<br /><br />#2, 4, 1, dan 3<br /><br />#4, 2, 3, dan 1<br /><br />#4, 3, 2, dan 1<br /><br />#3, 4, 1, dan 2', 'a', ''),
(45, 42, 'Setiap hari siswa SMAK Frateran Surabaya harus sampai di sekolah sebelum pukul 06.45 pagi. Tahapan keteraturan sosial yang terjadi adalah&hellip;.', 'Keajegan<br /><br />#Pola<br /><br />#Order<br /><br />#Tertib sosial<br /><br />#Norma sosial', 'a', ''),
(46, 42, 'Perhatikan data berikut ini!<br />1.Lembaga bersifat formal<br />2.Memiliki kurikulum<br />3.Berbentuk klasikal<br />4.Berfungsi untuk melestarikan kebudayaan antargenerasi<br />Ciri-ciri di atas merupakan karakteristik media sosialisasi&hellip;.', 'Peer group<br /><br />#Media massa<br /><br />#Masyarakat umum<br /><br />#Sekolah<br /><br />#Keluarga', 'd', ''),
(47, 42, 'Setelah melihat iklan di televise, Rizky ingin membeli salah satu produk shampoo tersebut dengan harapan rambutnya dapat menjadi kuat dan tebal seperti model yang memperagakan iklan tersebut. Faktor yang mempengaruhi interaksi sosial pada kasus tersebut adalah&hellip;.', 'Identifikasi<br /><br />#Sugesti<br /><br />#Simpati<br /><br />#Empati<br /><br />#Motivasi', 'b', ''),
(48, 42, 'Seorang investor asing ingin membangun perusahaan asing di Indonesia. Ia bekerjasama dengan pengusaha yang ada di Indonesia. Modal usaha berasal dari modal masing-masing yang digabungkan bersama untuk membangun perusahaan. Usaha investor asing ini dikenal dengan istilah&hellip;.', 'Bargaining<br /><br />#Cooptation<br /><br />#Joint venture<br /><br />#Coalition<br /><br />#Accommodation', 'c', ''),
(50, 42, 'Seorang balita diberitakan telah mengonsumsi rokok setiap hari sejak ia berusia 3 tahun. Balita tersebut awalnya mencoba dari Sang Kakek yang juga gemar mengonsumsi rokok. Sekarang balita tersebut selalu menangis dan mengalami ketergantungan mengonsumsi rokok. Kejadian tersebu merupakan bentuk penyimpangan yang disebabkan oleh&hellip;.', 'Gaya hidup konsumtif<br /><br />#Gangguan jiwa atau mental<br /><br />#Dorongan ekonomi keluarga<br /><br />#Pengaruh pergaulan yang tidak baik<br /><br />#Sosialisasi keluarga yang tidak sempurna', 'e', ''),
(51, 42, 'Kasus bom Bali yang menewaskan banyak orang jika ditinjau dari jumlah individunya termasuk dalam penyimpangan&hellip;.', 'Individu<br /><br />#Kelompok<br /><br />#Institusi<br /><br />#Primer<br /><br />#Formal', 'b', ''),
(52, 42, 'Fungsi pengendalian sosial bagi pelaku pelanggaran melalui jalan gossip atau desas-desus yang beredar di masyarakat adalah&hellip;.', 'Menimbulkan rasa takut dengan menggunakan ancaman sanksi dan kekuasaan#Menciptakan sistem hukum<br /><br />#Memberikan hukuman bagi pelaku pelanggaran<br /><br />#Mempertebal keyakinan masyarakat tentang kebaikan norma<br /><br />#Mengembangkan rasa malu bila melakukan pelanggaran', 'e', ''),
(53, 42, 'Beberapa kasus yang dapat ditemukan di kota-kota besar adalah masalah anak jalanan. Beberapa anak jalanan di kota besar menunjukkan adanya ketergantungan mengonsumsi lem, dengan cara dihirup. Efek samping yang timbul adalah adanya rasa tenang untuk sementara waktu, tetapi hal ini dapat merusak jaringan otak dan paru-paru si pengguna. Lembaga berikut ini berperan menanggulangi masalah tersebut secara preventif, kecuali&hellip;.', 'Lembaga agama<br /><br />#Lembaga keluarga<br /><br />#Lembaga pendidikan&nbsp;<br /><br />#Lembaga pengadilan<br /><br />#Lembaga media massa', 'd', ''),
(54, 42, 'Perhatikan variabel berikut!<br />1. Lapisan-lapisan sosial atau stratifikasi sosial<br />2. Lembaga-lembaga sosial atau institusi sosial<br />3. Kaidah-kaidah atau norma-norma sosial<br />4. Kesenjangan sosial<br />5. Integrasi sosial<br />Unsur-unsur pokok struktur sosial ditunjukkan oleh nomor&hellip;.', '1, 2, dan 3<br /><br />#1, 2, dan 4<br /><br />#1, 3, dan 5<br /><br />#2, 4, dan 5<br /><br />#3, 4, dan 5', 'a', ''),
(55, 42, 'Tawuran pelajar di Jakarta sudah sangat meresahkan warga.<br />Faktor utama yang melatarbelakangi terjadinya tawuran pelajar adalah&hellip;.', 'Kesenjangan fasilitas pendidikan yang diberikan kepada setiap pelajar<br /><br />#Kurangnya kebersamaan antarpelajar<br /><br />#Sikap in-group dan out-group yang terinternalisasi dalam diri setiap pelajar<br /><br />#Tidak adanya interaksi yang terjalin antarpelajar<br /><br />#Kurangnya pengetahuan para pelajar terhadap dampak tawuran', 'c', ''),
(56, 42, 'Bentuk akomodasi secara majority rule terdapat pada peristiwa&hellip;.', 'Perselisihan antara dua kelompok sosial dapat terhenti ketika salah satu kelompok memutuskan mengalah<br /><br />#Pertentangan dalam diskusi dapat diatasi dengan cara pengambilan suara<br /><br />#Konflik antarsuku bangsa dapat diselesaikan dengan forum komunikasi antarsuku bangsa<br /><br />#Konflik antara suami dan istri diselesaikan melalui pengadilan agama<br /><br />#Perselisihan antara dua selebritas diselesaikan melalui jalur hukum', 'b', ''),
(57, 42, 'Partai Ketela pada periode yang lalu memperoleh suara 55% dari seluruh warga desa yang memilih. Akan tetapi, pada tahun 2013 partai ketela hanya memperoleh 35%. Kondisi ini menunjukkan bahwa partai politik tersebut mengalami&hellip;.', 'Social role<br /><br />#Social sinking<br /><br />#Social mobility<br /><br />#Social climbing<br /><br />#Social stratification', 'b', ''),
(58, 42, 'Dena yang berasal dari keluarga kurang mampu mempunyai cita-cita menjadi pengacara. Oleh karena itu Dena berusaha mengajukan beasiswa ke kampusnya supaya kuliahnya bisa terselesaikan. Dengan demikian, Dena mempunyai peluang untuk menjadi pengacara. Saluran mobilitas yang digunakan Dena adalah&hellip;.', 'Lembaga pemerintah<br /><br />#Organisasi profesi<br /><br />#Lembaga pendidikan<br /><br />#Organisasi politik<br /><br />#Organisasi kedokteran', 'c', ''),
(59, 42, 'Sekelompok manusia disatukan atas dasar ikatan profesi yang sama, hubungan sosialnya bersifat kontraktual, dan memiliki kepentingan atau tujuan tertentu yang bersifat sementara, misalnya IDI, PERI, dan PWI. Contoh tersebut menggambarkan kesatuan sosial yang berbentuk&hellip;.', 'Gemeinschaft<br /><br />#Gesselschaft<br /><br />#Primary group<br /><br />#In group<br /><br />#Paguyuban', 'b', ''),
(60, 42, 'Di Jakarta sering terjadi aksi demonstrasi yang dilakukan oleh kelompok buruh yang menuntut kenaikan gaji. Ketika hari buruh tiba, para buruh akan berkerumun membentuk suatu kelompok untuk melakukan demonstrasi. Penyebab terbentuknya kelompok pada kaum buruh yang berdemonstrasi adalah&hellip;.', 'Terjadinya pertemuan secara fisik<br /><br />#Persamaan kepentingan dan tujuan<br /><br />#Keinginan mendapat simpati pemerintah<br /><br />#Keinginan untuk menyatu dengan kelompok lain<br /><br />#Keinginan untuk berhubungan dengan manusia lain', 'b', ''),
(61, 42, 'Dominasi kelompok satu terhadap kelompok lain semakin membuat masyarakat multikultural rentan mengalami konflik. Upaya meminimalkan terjadinya konflik dapat dilakukan dengan cara&hellip;.', 'Meningkatkan sikap toleransi serta penghormatan terhadap kaum minoritas agar terjadi keharmonisan<br /><br />#Menyeimbangkan jumlah kelompok minoritas dengan mayoritas agar tidak terjadi dominasi<br /><br />#Melemahkan kekuatan kelompok dominan agar tidak ada kesenjangan kekuatan<br /><br />#Memberikan ruang tersendiri agar kaum minoritas tidak merasa didominasi<br /><br />#Memberikan semangat agar moral kelompok minoritas terangkat', 'a', ''),
(62, 42, 'Perhatikan pernyataan-pernyataan berikut!<br />1.Pembangunan jembatan dapat menghubungkan desa-desa yang terisolasi<br />2.Penemuan alat komunikasi yang mempermudah interaksi luar daerah<br />3.Penggalakan kembali program bike to work untuk menjaga lingkungan<br />4.Pembangunan jalan tol dapat memperlancar arus lalu lintas<br />Pernyataan di atas termasuk perubahan&hellip;.', 'Progres#Revolusi #Evolusi #Regres #Lambat', 'a', ''),
(63, 43, 'Dalam perkembangan masyarakat ditemukan bahwa penyimpangan tidak hanya terjadi karena faktor lingkungan tetapi juga disebabkan oleh sifat manusia yang memiliki bibit untuk menyimpang. Hal ini menyebabkan adanya perkembangan teori dalam kajian perilaku menyimpang. Sebagai salah satu ilmu pengetahuan hal ini menunjukkan bahwa sosiologi memiliki ciri....', 'Empiris #Teoritis #Kumulatif #Nonetis #Metodologis', 'c', ''),
(64, 43, 'Departemen Kajian Sosiologi Universitas Airlangga menyerahkan hasil temuannya yang ,menyatakan bahwa lebih dari 80% warga menghendaki agar Kebun Binatang Surabaya tidak ditutup atau dipindah karena merupakan ikon kota Surabaya. Dengan demikian diharapkan Pemkot akan segera menyelamatkan keberadaan KBS ini. Ini menunjukkan bahwa sosiologi memiliki fungsi....', 'Guru # Ahli riset #Konsultan kebijakan #Teknisi  #Penyalur/mediator aspirasi', 'c', ''),
(65, 43, 'Indonesia dan Malaysia pernah terlibat konflik dimana Malaysia mengklaim lagu Rasa Sayange dan Reog Ponorogo sebagai salah satu warisan karya nenek moyangnya. Ini termasuk masalah sosial yang didorong faktor...', 'Ekonomi #Budaya #Biologis #Sosial #Politik', 'b', ''),
(66, 43, 'Dalam mengatasi masalah kemiskinan pemerintah menciptakan iklim usaha yang mampu mendorong pengembangan UMKM secara sistematik, mandiri, dan berkelanjutan. Ini merupakan upaya pada aspek....', 'Struktural  #Pendidikan  #Kebudayaan  #Ekonomi  #Sosial', 'd', ''),
(67, 43, 'Sebagai seorang Ustad yang punya jadwal mengisi acara dakwah di banyak tempat, Ustad Solmed selalu membawa Ipad untuk membantu mengingat jadwal dakwah dan menyimpan semua isi dakwah yang pernah disampaikannya. Ini menunjukkan bahwa Ipad baginya memiliki nilai....', 'Vital #Logika #Material#Estetika #Spiritual', 'a', ''),
(68, 43, 'Dalam tahapan keteraturan sosial, keselarasan tindakan masyarakat dengan nilai dan norma sosial yang berlaku di masyarakat, disebut....', 'Pola #Order #Keajegan #Keteraturan sosial #Tertib sosial', 'e', ''),
(69, 43, 'Edi diterima di SMA favorit di kotanya. Pada tahap awal, ia mengalami proses adaptasi yang didahului dengan mengganti pakaian putih biru menjadi putih abu-abu. Berdasarkan tahapannya, proses adaptasi tersebut merupakan bentuk sosialisasi yang bersifat...', 'Represif #Sekunder #Informal #Formal #Primer', 'd', ''),
(70, 43, 'Ketika kita lahir masih belum mengenal tata sopan santun. Melalui proses sosialisasi, individu belajar untuk menjadi pribadi yang baik dalam berperilaku. Menjadi pribadi seperti yang dimaksudkan pada uraian tersebut merupakan...', 'Tujuan sosialisasi#Bentuk sosialisasi#Tahap sosialisasi#Tipe sosialisasi#Agen sosialisasi', 'a', ''),
(71, 43, 'Cermati hal-hal berikut ini!<br />1. Menanamkan nilai dan norma yang dianut masyarakat<br />2. Membentuk kemampuan beradaptasi dengan lingkungan yang luas<br />3. Sarana pemenuhan kebutuhan hidup individu dan kelompok<br />4. Sebagai dasar pembentukan kepribadian seseorang<br />Berdasarkan pernyataan tersebut di atas yang termasuk peran sosialisasi sekunder dan sosialisasi primer adalah...', '1 dan 2#1 dan 3#1 dan 4#2 dan 3# 3 dan 4', 'c', ''),
(72, 43, 'Pada masa remaja individu yang sedang melakukan pencarian jati diri sebagian besar melakukan proses imitasi terhadap tokoh idolanya yang sering mereka lihat melalui visualisasi televisi baik dalah hal tata rambut hingga fashionnya. Ini menunjukkan bahwa pada masa remaja sosialisasi individu lebih banyak dipengaruhi oleh media...', 'Keluarga#Teman sebaya#Sekolah#Media massa#Lingkungan kerja', 'd', ''),
(73, 43, 'Interaksi sosial dapat terjadi karena beberapa hal berikut ini, kecuali...', 'Jumlah pelaku yang lebih dari satu orang#Diwariskan melalui proses belajar#Adanya komunikasi antarpelaku dengan menggunakan symbol atau lambang#Adanya suatu dimensi waktu meliputi masa lalu, masa kini, dan masa yang akan datang#Adanya tujuan yang hendak dicapai', 'b', ''),
(74, 43, 'Sutandyo terkesima dengan ceramah dari salah seorang pemuka agama. Ia beranggapan semua hal yang dikatakan oleh pemuka agama tersebut benar dan sesuai dengan realitas. Interaksi tersebut dipengaruhi oleh faktor...', 'Simpati#Identifikasi#Imitasi#Empati#Sugesti', 'e', ''),
(75, 43, 'Amin dan Amir terlibat perselisihan menyangkut pembagian harta warisan peninggalan Ayah mereka. Amin dan Amir sama &ndash; sama menginginkan bagian yang lebih besar. Setelah beberapa waktu, mereka akhirnya bersedia saling mengurangi tuntutannya serta membagi rata harta warisan tersebut. Bentuk akomodasi yang dilakukan oleh Amin dan Amir dalam upaya meredakan perselisihan di antara mereka adalah &hellip;', 'toleransi#kompromi#musyawarah mufakat#mediasi#konsiliasi', 'b', ''),
(76, 43, 'Salah satu daya tarik wisata rohani di Surabaya adalah keberadaan Masjid Cheng Ho yang memiliki perpaduan arsitektur Timur Tengah dengan arsitektur Cina, dan ini menjadi salah satu ikon kebanggaan masyarakat Surabaya. Hal ini menunjukkan bahwa masyarakat Surabaya mengalami interaksi sosial bentuk....', 'Akomodasi#Akulturasi#Asimilasi#Asosiatif#Koalisi', 'b', ''),
(77, 43, 'Tim SAR (Search And Rescue) dan relawan memberikan bantuan dalam pencarian anggota masyarakat yang menjadi korban musibah tanah longsor. Hubungan interaksi antara regu penolong dengan masyarakat yang mengalami bencana tersebut berbentuk...<br /><br />', 'Kontravensi#Disosiatif#Kompetisi#Oposisi#Kerjasama', 'e', ''),
(78, 43, 'Seorang anak perempuan menjadi tomboy dan berperilaku menyimpang dengan mengikuti geng motor yang suka tawuran. Ia menjadi demikian karena di rumah ia tidak mendapatkan kasih sayang secara utuh. Ibunya pergi meninggalkan rumah karena tidak tahan dengan perlakuan kasar ayahnya. Berdasarkan kasus tersebut dapat disimpulkan bahwa penyimpangan terjadi karena...<br /><br /><br /><br /><br />', 'Adanya sosialisasi dari nilai-nilai sub kebudayaan yang menyimpang#Ikatan sosial yang berlainan#Sosialisasi yang tidak sempurna# Proses belajar yang menyimpang#Ketegangan antara kebudayaan dan struktur sosial', 'c', ''),
(79, 43, 'Perhatikan perilaku menyimpang berikut!<br />1. Meminta sumbangan untuk menyantuni yatim piatu<br />2. Menerobos lampu merah di persimpangan jalan raya<br />3. memacu motor dengan kecepatan tinggi (ngebut) di sirkuit balap<br />4. Membuat contekan sebelum dilaksanakan ulangan akhir semester<br />Contoh di atas yang termasuk penyimpangan sekunder adalah...<br /><br />', '1 dan 2#1 dan 3#2 dan 3#2 dan 4#3 dan 4', 'd', ''),
(80, 43, 'Proses sosialisasi tidak sempurna merupakan salah satu faktor penyebab terjadinya perilaku menyimpang. Pada lembaga primer, sosialisasi tidak sempurna seringkali terjadi karena...', 'Perceraian suami istri#Pertentangan agen sosialisasi#Pergolakan dalam lingkungan kerja#Perseteruan staf dalam lingkungan kerja#Perbedaan pendapat dalam membuat keputusan', 'a', ''),
(81, 43, 'Dalam menyelesaikan kasus di masyarakat yang berwenang mengajukan tuntutan hukum adalah...', 'Polisi#Pengadilan#Pengadilan adat/masyarakat#Keluarga#Kejaksaan', 'e', ''),
(82, 43, 'Suatu perusahaan membutuhkan karyawan baru dengan kualifikasi: wanita usia maksimal 29 tahun, lulusan S1 Sosiologi, IPK minimal 3,00 dan menguasai program Microsoft Office. Berdasarkan kualifikasi tersebut perusahaan menerima pekerjanya berdasarkan bentuk...', 'Stratifikasi sosial dan diferensiasi sosial#Diferensiasi sosial dan primordialisme#Primordialisme dan stratifikasi sosial#Etnosentrisme dan diferensiasi sosial#Sektarian dan primordialisme', 'a', ''),
(83, 43, 'Perhatikan beberapa faktor sosial berikut ini!<br />1. Keinginan untuk melihat daerah lain<br />2. Merasa telah puas dengan keadaan yang ada sekarang<br />3. Individu yang berada di lapisan atas terbatas<br />4. Keterbelakangan sistem pendidikan<br />Yang merupakan faktor penghambat mobilitas sosial adalah...', '1 dan 2#1 dan 3#2 dan 3#2 dan 4#3 dan 4', 'd', ''),
(84, 43, 'Prita dituduh mencemarkan nama baik salah satu rumah sakit ternama. Dia dijerat UU Informasi dan Transaksi Elektronik karena mengirim e-mail berisi keluh kesahnya tentang kesalahan diagnosis rumah sakit tersebut. Dari kasus ini nampak bahwa penyebab konfliknya adalah..', 'Perbedaan kepentingan kedua belah pihak#Kondisi yang saling bertolak belakang#Perbedaan prinsip dari kedua belah pihak#Pengaruh kultur kerja dan profesionalisme#Pengaruh teknologi komunikasi internet', 'a', ''),
(85, 43, 'Berikut ini adalah bentuk kedudukan yang didapat seseorang dari pemberian suatu kelompok di dalam kehidupan masyarakatnya karena jasa, dalam kaitannya dengan mobilitas sosial adalah...', 'Social status#Ascribed status#Achieved status#Assigned status#Alternative status', 'd', ''),
(86, 43, 'Dalam mobilitas sosial vertikal antargenerasi dapat menimbulkan konflik generasi, hal ini disebabkan oleh...<br /><br /><br /><br /><br />', 'Generasi muda mengambil alih kepemimpinan generasi tua#Anak muda berhasil menjadi pelopor pembangunan di desa#Seorang anak dari keluarga sederhana menjadi sarjana#Anak pengrajin mengembangkan usaha orang tuanya# Anak pegawai rendahan bekerja sebagai pramuniaga', 'a', ''),
(87, 43, 'Gino bersikeras tidak mau bergabung dengan kelompok Toni. Gino memilih dimarahi oleh guru dan tidak mendapat nilai dalam pelajaran Ekonomi. Dari peristiwa tersebut dapat diketahui bahwa...', 'Sikap in-group Gino belum begitu kuat#Gino memiliki perasaan out-group terhadap kelompok Toni#Sikap out-group Toni menghalangi masuknya Gino ke kelompoknya#Sikap in-group Toni membuat Gino enggan masuk ke kelompoknya#Gino memiliki rasa out-group terhadap mata pelajaran Ekonomi', 'b', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kalender`
--

DROP TABLE IF EXISTS `tbl_kalender`;
CREATE TABLE IF NOT EXISTS `tbl_kalender` (
  `judul` varchar(255) NOT NULL DEFAULT '',
  `isi` text NOT NULL,
  `waktu_mulai` date NOT NULL DEFAULT '0000-00-00',
  `waktu_akhir` date NOT NULL DEFAULT '0000-00-00',
  `background` varchar(10) NOT NULL DEFAULT '#d1d1d1',
  `color` varchar(10) NOT NULL DEFAULT '',
  `id` int(12) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `tbl_kalender`
--

INSERT INTO `tbl_kalender` (`judul`, `isi`, `waktu_mulai`, `waktu_akhir`, `background`, `color`, `id`) VALUES
('Jadwal TJK Community', 'Jadwal TJK Community\r\n- Jumat 5 April 2013 jam 6 Sore di Ploso gg 10 Sby ', '2013-04-05', '2013-04-05', '#d1d1d1', '#999999', 1),
('Jadwal Grafis Community', 'Jadwal Grafis Community\r\n- Sabtu 6 April 2013 Jam 2 Siang di Kutisari Sby', '2013-04-06', '2013-04-06', '#d1d1d1', '#999999', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `topik`
--

DROP TABLE IF EXISTS `topik`;
CREATE TABLE IF NOT EXISTS `topik` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `topik` varchar(60) NOT NULL DEFAULT '',
  `ket` text NOT NULL,
  `parentid` int(2) NOT NULL DEFAULT '0',
  `seftitle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data untuk tabel `topik`
--

INSERT INTO `topik` (`id`, `topik`, `ket`, `parentid`, `seftitle`) VALUES
(46, 'Teknologi', 'Teknologi', 0, 'teknologi'),
(47, 'Sosial', 'Sosial', 0, 'sosial'),
(43, 'Selebriti', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n</head>\r\n<body>\r\n<p>Berisi Berita dan Perkembangan dari Selebriti Terbaru</p>\r\n</body>\r\n</html>', 0, 'selebriti'),
(44, 'Hukum', '<p>Seputar Berita tentang HUKUM dan KRIMINAL yang terjadi di sekitar kita</p>', 0, 'hukum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas`
--

DROP TABLE IF EXISTS `tugas`;
CREATE TABLE IF NOT EXISTS `tugas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `ket` text NOT NULL,
  `tglmulai` date NOT NULL,
  `tglakhir` date NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugaskomentar`
--

DROP TABLE IF EXISTS `tugaskomentar`;
CREATE TABLE IF NOT EXISTS `tugaskomentar` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `tugassiswa` int(5) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `komentar` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tugaskomentar`
--

INSERT INTO `tugaskomentar` (`id`, `tgl`, `tugassiswa`, `nama`, `kelas`, `komentar`) VALUES
(3, '2014-11-03', 1, 'komen2', 'komen2', 'komen2'),
(4, '2014-11-03', 1, 'komen3', 'komen3', 'komen3'),
(5, '2014-11-03', 1, 'adad', 'asdasd', '<span>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</span>'),
(6, '2014-11-04', 2, 'asd', 'asdasd', 'asdad asdadsa');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugassiswa`
--

DROP TABLE IF EXISTS `tugassiswa`;
CREATE TABLE IF NOT EXISTS `tugassiswa` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tugas` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `file` varchar(512) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujian`
--

DROP TABLE IF EXISTS `ujian`;
CREATE TABLE IF NOT EXISTS `ujian` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pointbenar` varchar(5) NOT NULL DEFAULT '0',
  `pointsalah` varchar(5) NOT NULL DEFAULT '0',
  `pointkosong` varchar(5) NOT NULL DEFAULT '0',
  `tipe` enum('urut','random') NOT NULL DEFAULT 'random',
  `jumlahsoal` varchar(4) NOT NULL DEFAULT '10',
  `tipejawaban` varchar(255) NOT NULL DEFAULT '5',
  `status` enum('enabled','disabled') NOT NULL DEFAULT 'enabled',
  `idmapel` varchar(5) NOT NULL,
  `petunjuk` text NOT NULL,
  `tipeujian` enum('latihan','ujian') NOT NULL DEFAULT 'latihan',
  `listening` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id`, `tgl`, `judul`, `pointbenar`, `pointsalah`, `pointkosong`, `tipe`, `jumlahsoal`, `tipejawaban`, `status`, `idmapel`, `petunjuk`, `tipeujian`, `listening`, `user`) VALUES
(39, '2015-12-10', 'Ujian SIM C', '10', '0', '0', 'random', '10', 'a,b,c', 'disabled', '14', '', 'latihan', '', 'admin'),
(42, '2016-03-12', 'SOSIOLOGI KODE 01', '4', '0', '0', 'random', '25', 'a,b,c,d,e', 'enabled', '13', '', '', '', 'admin'),
(43, '2016-03-16', 'SOSIOLOGI KODE 02', '4', '0', '0', 'random', '25', 'a,b,c,d,e', 'disabled', '13', '', '', '', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujiannilai`
--

DROP TABLE IF EXISTS `ujiannilai`;
CREATE TABLE IF NOT EXISTS `ujiannilai` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tgl` date NOT NULL,
  `jam` time NOT NULL,
  `mapel` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `nilai` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data untuk tabel `ujiannilai`
--

INSERT INTO `ujiannilai` (`id`, `tgl`, `jam`, `mapel`, `user`, `nilai`) VALUES
(21, '2015-11-06', '00:00:00', '5', 'admin', '30'),
(22, '2015-11-06', '00:00:00', '5', 'admin', '10'),
(27, '2015-11-06', '08:28:20', '5', 'octhan', '30'),
(28, '2015-11-06', '08:28:52', '5', 'octhan', '40'),
(29, '2015-11-06', '08:35:11', '5', 'siswa12', '10'),
(30, '2015-11-06', '08:38:25', '5', 'siswa12', '0'),
(31, '2015-11-06', '08:39:31', '5', 'siswa12', '40'),
(32, '2015-11-23', '09:30:30', '5', 'admin', '40'),
(33, '2015-11-23', '09:32:25', '5', 'kelas12', '0'),
(34, '2015-12-10', '10:56:24', '14', 'admin', '80'),
(35, '2015-12-10', '11:01:56', '14', 'admin', '0'),
(36, '2015-12-14', '11:29:55', '7', 'admin', '0'),
(37, '2015-12-14', '11:35:12', '7', 'admin', '0'),
(38, '2015-12-14', '11:35:50', '7', 'admin', '0'),
(39, '2015-12-14', '11:40:42', '7', 'admin', '0'),
(40, '2016-03-11', '09:21:33', '7', 'admin', '0'),
(41, '2016-03-12', '11:07:23', '13', 'admin', '0'),
(42, '2016-03-14', '07:27:20', '13', 'admin', '12'),
(43, '2016-03-14', '07:43:47', '13', 'admin', '0'),
(44, '2016-03-14', '10:05:26', '13', 'admin', '0'),
(45, '2016-03-16', '09:21:17', '13', 'admin', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ujiansetting`
--

DROP TABLE IF EXISTS `ujiansetting`;
CREATE TABLE IF NOT EXISTS `ujiansetting` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `petunjuk` text NOT NULL,
  `waktu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `ujiansetting`
--

INSERT INTO `ujiansetting` (`id`, `petunjuk`, `waktu`) VALUES
(1, '<p>- Waktu akan berjalan setelah peserta mengklik tombol Mulai<br />- Peserta Mengklik langsung Soal kemudian menjawab langsung dengan memilih pilihan jawaban yang terdapat pada Soal<br />- Apabila peserta melakukan refresh / menekan F5 maka semua jawaban akan hilang tetapi waktu masih tetap berjalan.<br />- Peserta masih dapat mengerjakan Soal yang sebelumnya telah terbuka dengan mengklik Soal yang dikehendaki.<br />- Peserta dinyatakan selesai mengerjakan soal apabila telah mengklik tombol Selesai atau otomatis selesai ketika Waktu/Timer telah habis.<br />- Selamat Mengerjakan</p>', '3600');

-- --------------------------------------------------------

--
-- Struktur dari tabel `useraura`
--

DROP TABLE IF EXISTS `useraura`;
CREATE TABLE IF NOT EXISTS `useraura` (
  `UserId` int(15) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL DEFAULT '',
  `password` text NOT NULL,
  `level` enum('Siswa','Guru','Administrator') NOT NULL DEFAULT 'Siswa',
  `tipe` varchar(250) NOT NULL DEFAULT 'aktif',
  `is_online` int(5) NOT NULL DEFAULT '0',
  `last_ping` text NOT NULL,
  `start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `exp` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `nama` varchar(512) NOT NULL,
  `photo` varchar(512) NOT NULL,
  `statusemail` enum('tampilkan','sembunyikan') NOT NULL DEFAULT 'sembunyikan',
  `statustelp` enum('tampilkan','sembunyikan') NOT NULL DEFAULT 'sembunyikan',
  `email` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `mapel` varchar(5) NOT NULL,
  PRIMARY KEY (`UserId`),
  UNIQUE KEY `user` (`user`),
  UNIQUE KEY `user_2` (`user`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2443 ;

--
-- Dumping data untuk tabel `useraura`
--

INSERT INTO `useraura` (`UserId`, `user`, `password`, `level`, `tipe`, `is_online`, `last_ping`, `start`, `exp`, `nama`, `photo`, `statusemail`, `statustelp`, `email`, `telp`, `mapel`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'aktif', 1, '2016-03-16 07:13:58', '2010-08-27 00:00:00', '2034-08-27 00:00:00', 'Administrator', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(68, 'superadmin', 'b11d5ece6353d17f85c5ad30e0a02360', 'Administrator', 'aktif', 1, '2014-09-12 13:44:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2442, 'octhan', '37aa4898d80f16db336cd3c8f585661b', 'Administrator', 'aktif', 0, '2015-11-06 08:19:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Octhan Setyawan, S.Si. ', '', 'sembunyikan', 'sembunyikan', '', '', ''),
(1381, 'siswa12', '380a0238d4eeb7ebbf6445d1541865c2', 'Siswa', 'aktif', 1, '2015-11-06 08:30:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'siswa12', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2096, '16613', 'f95008d294f277e432261d458fe91c76', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Adrian Reynardi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2097, '16622', 'dae43844e99e2120bb9f2e00b05d7ca3', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Alysha Junita Iskandar', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2098, '16624', '784ff39684c7a23cfa09e77719256e20', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anastasia Hanny Irawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2099, '16639', '9b77e252a999cab18512f3db1a414ddf', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Antony Kurniawan Soemardi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2100, '16645', '3169b89e40818e5575ab0ab87b38d2a5', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bela Chrestella Harjanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2101, '16662', 'f7084c8dc72521fe9b1cd695464554a2', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christian Wicaksana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2102, '16672', 'f9eaa8a65bb8e62b3e6d27979b4c6815', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Clara Sciffi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2103, '16680', '36426b22b500b98b3a5eb4d11c81d974', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Daniel Liaw', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2104, '16685', 'f37baa052ef9fff7d5671e655907c6f2', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Devina', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2105, '16690', '82d6d16e08359f7efcaabde5c946c10e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Edbert Christian Wenata', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2106, '16704', '3ecd2cd951c997ec03d1e428c7f15687', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Evania', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2107, '16713', 'cca1984970cb6fe586716e732df9fb0d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Felia Irawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2108, '16717', '3f8dcd6ba8c3eafe3d3d0dce39c0460b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ferdinandus Yonata', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2109, '16725', '0f4f778e61d44558c6f448a9cd313b08', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gabrielle Agnes Thalia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2110, '16744', '21b9a07cb47f707a02489fd5e3b882bd', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Herlin ', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2111, '16745', 'dc4781e4d7949791a2c973340de4a010', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hermawan Adinata', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2112, '16753', '1577e5ef0c7cf5fea7ec297c0d4adc36', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ivana Angela', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2113, '16757', '44e8c3e9d4a9b627e1c2d22b92d048f6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Janssen Sugiarto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2114, '16758', '8e3a470dfb7d426c470e8e9bdf44df13', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jasmine Chiquita Yusuf', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2115, '16764', '1785cff273aedbd875c814b46928ad7f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jessica Olivia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2116, '16772', '0e06126ea56b3f361e310860d06dc790', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jonathan Koesuma', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2117, '16790', '22f9e2d5502451ace279d693de6ef609', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Saputra Khosasi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2118, '16798', '7081a9ee5d50032dc5537accf39da060', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kristoforus Wesley', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2119, '16826', 'f1248ade4381b326436757a0b5266088', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Michelle Juventia Hokgiono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2120, '16828', '131799f66a96ee034181e8a54b4c0b49', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Monica Chandra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2121, '16852', '65ddc1f88e46d28edac152bdb47193e0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ratna Juwita Sari', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2122, '16855', 'e7da6f05f908822fcb5796464baf196b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Reynardo Kevin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2123, '16861', '23d3743ad75e4470e7ff7129351a9541', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ruth Sonia Rosa Sianipar', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2124, '16863', 'fe33b4901179d6118f8859c27426e45b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Satrio Shianata Wetangky', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2125, '16879', '4b22a8375108a514ef8340e01c2e1af4', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Steven', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2126, '16907', '47cc8fbdaeacd8c1d9fe325b11e0287e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vu Yansen', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2127, '16923', '512844c25cd1c9af079ba08f868eb637', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yohanes Ezra Daniel S', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2128, '16924', 'ea2af5ea4aabdca1d9ded27f252b8e41', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yuni Dewi Susanti', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2129, '16928', 'f042fe2d8c2e42a80c9cb8ffc652d914', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Felicia Layrensius', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2130, '16628', 'fe0d8e0451d08fc7206d99b1b71d7bde', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Andreas Prasetyo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2131, '16634', 'bd6c2fd1ded9513bc167f856167cf5dc', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Angelia Fredella', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2132, '16640', 'd1aae872c07c10af8bc9918fdb28c28c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Apriandi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2133, '16646', '99e9ed2e0253ae5f4b421592cf6ca2de', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Benedictus Mahareshi Wisjnu Wicaksono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2134, '16653', '1e5d71d3eda9d819ce132431c0b928db', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Callista Jeslyn', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2135, '16663', 'b0ea65d0755634f5b2400f9925ad392b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christian Willy Iskandar', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2136, '16674', 'cb054b2d984d93292e66d1e19d6e4655', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Clarence Adiputra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2137, '16682', 'a728f25dd7e2fd0c61730a517cb5659e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'David Tjandra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2138, '16684', 'c0daa585594b41bea3aeaf7af2a12e29', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Desy Natalia Kristiani', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2139, '16688', '8d7aaf355a23f5c7a1d4a6c4d07193ab', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dina Tinezia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2140, '16698', '47aea24ee4f77d9109518129a3d9c222', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Emanuela Greta Hartandyo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2141, '16706', '0b1a888bc5720fc6b2a1585f802f6964', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Evita Yamin Suwito', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2142, '16711', '2da909b30de3798807581c1c14e0161c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Faustina Angel', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2143, '16716', 'f749025817f607fff3160d1e5244a9f6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fennita Soeyoso Gondo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2144, '16719', '735618b34fba373bd967813620ba0417', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fiona Audrey Eugenius', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2145, '16722', 'f9d81ff01aec9a8625983fe8f5c382f0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gabriel Aprilia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2146, '16727', '6876925aadb300b04d29c8cb3427d8da', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gadmon Hans Prajogo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2147, '16743', '21eca1b8f66e8247daca8dd2fecd844c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Henry Sintan Sutanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2148, '16760', '042b1cd756a6b6b7c3517cd63eea2325', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jeremy Renaldi Halim', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2149, '16763', 'b8c06480a3e0c575506bbd1e7e5cf02d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jessica Oktaviani Tanandjaja', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2150, '16769', '48229fd6aa4328151e40bda429d8e182', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Johanes Jefferson Siswanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2151, '16782', 'faa1f47d99384715608f21292313ab25', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kelvin Gunawan Hartono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2152, '16784', '506e185dccf97ea9082b991ab2556d9d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kenny Adi Chitra Limanjaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2153, '16788', '948ba1dc8cc4cc26e5d9d4f358660c2d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Hadi Winata', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2154, '16825', '1e5ae5c4ebcc2cadb8a09909f3731c35', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Michael Ivan Reinald', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2155, '16833', 'b1553ff2787f1055807a8058fe1f8d99', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Moses Setiady', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2156, '16844', '916c389b30d9307cfa88f78e037eed17', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Novilia Gandi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2157, '16850', 'efee1278c6172f7361d1900617faede2', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Pollen Sandro Ongkowijoyo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2158, '16867', '72c288a828485e5b1d4c52910d106734', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Silvia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2159, '16876', 'b294fccdfe95bc7f7dd813216a821a76', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stella Gracia Laksmana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2160, '16892', '0a187866618ca3049030ec5014860ae8', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vanessa Velancia Prajogo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2161, '16896', '1f5bb9b79cb995f65aa9f6d649c5f49f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vellicia Quinnita Wijaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2162, '16897', 'e91358846c5b47cfd46866b21d9f7da3', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vergina Natasha', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2163, '16913', '9005e22c1f6a91269cfaf51aedb6e83b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Willy Christian Suyono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2164, '16620', '8462aabd1f45abacfa90cb0f15b8199e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Alvin Fabian', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2165, '16625', 'abff833e69ceda5b038c0f2b98d71525', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anastasia Tertiara Diva Intani', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2166, '16630', 'c2e2a6521fbf5aab3693d9dd7ca9cb1e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Andrew Sofian', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2167, '16658', 'ded693405194bd811d9dde0e3cf270e8', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christabella Panggabean', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2168, '16668', '143f1e6c0c94814481445e0352cd626c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cindy Baby Lesmana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2169, '16673', '1b58db3880e247fb67c3b8b57d6d1912', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Clara Tanazal', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2170, '16681', 'e746ec9d02541b374a9aead8fdb941fe', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Darmadi Soetjahja', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2171, '16694', '8aa71aee354f4cae862cabcf498ae1f6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Elizabeth Geraldine Calista', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2172, '16707', '40d1075be60b9feb074947fb019cc6b4', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'F.X. Adhika Wicaksana Putra Zihono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2173, '16751', 'a91f5b7694960ec78204af05f421a699', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Irvan Ferdinand', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2174, '16755', 'eefbed3864900fbf045a269dd8bd4c8e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ivania Budi Cendika', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2175, '16768', 'ead8e65817265dd1346c3d2b2ba251c5', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Johan Witono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2176, '16779', '2caba685d55ef0854e19c297cf95df35', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kathryn Immanuel Wahyudi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2177, '16781', '18dabb99ce171ea5a317521425d5c206', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kelvin Christianto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2178, '16791', 'e9d3e114b1cf19de5ae8d014512350c2', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Susanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2179, '16797', '703aea31975f2fa45fdb3e4a8e378ad1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kristoforus Ryan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2180, '16804', 'c752a2fef40ec94d00999635f7599f25', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lia Indrawati', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2181, '16806', 'd6da0257d11fb247f4a607bae48f69d1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lisa Juliet', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2182, '16809', 'e98aebc54e5513e88b2014574d209255', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Malvin Manuel Mulyadi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2183, '16822', 'feddfedc98490ed7e123db392f076fa1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Melissa Fransisca Chandra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2184, '16832', '030869ecc70e997804feed92f3a8fbdc', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Monika Evelin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2185, '16838', '24c754ea4f5945ac0c266fb32e497918', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Natashia Liliani Laksmana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2186, '16841', 'a80c49e34cbf3a1eb1dab16597789c02', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nathanael Setyohadi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2187, '16842', '352aadcdb01b30bdbd6c5f13d27ed9b5', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nico Cristian Andresia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2188, '16848', 'cb11a12474e34b83e38e06d2ef1b2830', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Peni Tiewanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2189, '16849', '8be64f5ea8bd4076c00a9b0fea49189c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Peter Suseno', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2190, '16875', '92bdee4b02b1dab018f526948437d3d6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stella Agrippina', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2191, '16880', '3a6cd33291178d268ef37b305c3f8c0e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Steven Benedictus Darmono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2192, '16894', '3551e8036c7244b6222b029f97a1d5b4', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vania Clara Angela', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2193, '16898', '22811ee19846217512507785e74d12cc', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vernando Yosua Ginantha', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2194, '16903', 'aff9f10fb217690e970068c85ca78c49', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vincent Putra Wikarsa', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2195, '16909', 'bad815642779b6e483ae2e3ace29e419', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Wibisono Saputro', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2196, '16916', 'a7974b664364f1655de4ae0484a7bcaf', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yenni Kurniaputri', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2197, '16918', 'c10059c0ac08e46e083e38750387f953', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yeyen Ramadhani Ningtias', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2198, '16921', '98795443cdbf0375dd946728e2f4e51a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yohana Agustina', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2199, '16619', 'e4c072e019448100c4f7c2059729f050', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aloisius Calvin Mazzarello', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2200, '16629', 'f829eaa5d93d1460a25680acc00f8b57', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Andreas Setriyono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2201, '16635', '32cfe1632e63ffeea8bd9f57d652cc34', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Angella Octavia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2202, '16661', '579c06a09a6114c5553f04d12df29e6a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christian Robby  Hartono Putra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2203, '16683', '55c57ba9cf3a2b8b3fb3fbd1bad32141', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dennis Harnandi Lukito', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2204, '16686', '07401aaff3da03b55ec7be2c6a6e5691', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Devino Vega Armando', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2205, '16693', '2e970f99fa7f2805d8be0cc8a73f770f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Edwin Hendrawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2206, '16696', 'c746ed54345cbcf402dfe35fa8d9b010', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Elyan Geovani Wijaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2207, '16697', 'd0bfcb426cd8154f5350db5a73e29b4d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Emanuela Adinna', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2208, '16705', 'b30aaacaa1c07542cee83f65004cfba6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Evelyn Setiadarma', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2209, '16715', '0199289fa8c8a6c025c5df1c04485588', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Felisia Cahyani Pangestu', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2210, '16721', '6226c5b0f6a9b68f3dee542ab5c34545', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fransiska Sianne', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2211, '16736', '5a2a44703e98c359e5e7bf6db01b3a15', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gratianus Gerry', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2212, '16739', '0fc163f5d52156860e72d1993e30ed6a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Handrianto Mulyono P.W.', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2213, '16766', 'bdd5ce7ae365c29e6499ac1aa858235c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jessica Widjaja', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2214, '16774', '00126b47d5502dfb7d01f750ad23d813', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Joshua Axel Limandjaja', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2215, '16787', '1e53b79716f96e36c06132ddb9cd53d9', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Ekyra Khowidiyantho', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2216, '16796', 'a979ca72826d945a5ac992029145141c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kresna Vincent Philbert', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2217, '16815', '339e2f61ba171de04b12646bb30b329b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mariani  ', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2218, '16830', '0672340d6136be227ea1cbc63fa221b2', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Monica Kerren Angel', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2219, '16835', '40ace1babb133e1ea17f09932dd2e508', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Naomi Belinda May Arbai', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2220, '16840', '304cdd05f67e3dd4379b3474d7109575', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nathanael Andrew H.S.', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2221, '16846', '2bed57b5e7da7db0be5cd65a00bf6405', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Olyvia Mega', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2222, '16868', 'd5eb74205aad313dd6361a1089c4e424', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Silvia Triyanti Luis', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2223, '16874', '8a5bfb060ee1f97ecba56d60c049b52d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stefhani', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2224, '16891', 'eb1daa7f2b5068f7127382b1eae924b7', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Valensia Elke Filia Referina Nurak', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2225, '16900', '54d303c9ddc2a43df23563254885d936', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vianney Agustina', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2226, '16902', '19d68f6ca8cc5e2a52ade5516d359e52', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vincent', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2227, '16904', 'b92d0fcbc8d2624a2ea66907feb8d8de', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vincentius Kevin Listyo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2228, '16915', '5f8a451fe4917f0a5c7d39ff14660f94', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Windriyanto Korintus Bagaspatih', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2229, '16917', '64933557e9c872deb3784326e0ab19b0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yessidora', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2230, '16922', '7a1bc993c84aa757a165fbc2984ae42f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yohanes Alim Budiarto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2231, '16927', 'be4188c0d0d914d4f54684b7b79fc726', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Zerlina Avissa Chandra Dewi Widodo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2232, '16929', '4b31cbd7ab8fbbd7f8a510d3bda60c66', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ester Indo Sien Simu', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2233, '16632', '07cdd403268d6f173eff1fc8dac04d63', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Angela Pricilla Cahyadi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2234, '16636', 'f295553be4c2f4e76f6d15d3dc22e9dd', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anita Caroline', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2235, '16638', 'b3432faaca931632a24fc96b3d1c71ef', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anthony Reinaldo Riyaldi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2236, '16641', '82429353edda060e9bf4c01c1e70602e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Astricia Wirana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2237, '16652', '8d9538d163f6009cec27b8e61cbdd981', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bryant Hebert Ongkojoyo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2238, '16655', '791427014ac440583f48f02159b233e6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Calvin Cahyadi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2239, '16671', '5d4e2809bba49effaa7e5ca4202d043e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Clara Bella Jessica Arijaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2240, '16676', 'a5ee6457150a2d96a0015872541956c3', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Claudia Wina Andrea', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2241, '16687', '12e369da0630f39bda204840c316a6ed', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Diana Setyawati Puteri', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2242, '16712', '8344cdd7d8077edf2d22f574cf23dc8f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Febrian Anthoni', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2243, '16730', '6d80fca29ede446759da7bf81c4a1b1e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Geraldo Christo Cahyono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2244, '16731', '76c1922dbf7e6b9d65c1c0d06e8f9118', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gillian Stefanny Fung Chandra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2245, '16737', '68b3d03d38ad88126ede9cee289b6661', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gregorius Michael Marvin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2246, '16750', '8dd87392f8dd35f1dc9d2cfe656a83b9', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Irene Alvania', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2247, '16773', '1f689175473dcc4f921a76933e45bbb5', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jonathan Tandijono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2248, '16777', 'fbb277905c67ac8f363f7a22e50eb95b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jusak Prasetio Tanuraharja', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2249, '16778', '1170017b40d1ba28394ebc44158dae8a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kadek Aling Indrawati', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2250, '16793', '3a3ac2ab1c65f0a2dc7087b57062470e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Theodore', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2251, '16794', '5770c1ead6a03018e70d0ffe8e50e86a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kian Raynaldi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2252, '16807', '8694959cf2d53e57681d8fdc472468d6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Luke Wongso', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2253, '16811', '9dbc59f98f5e213ac6967df00e1e1e06', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Maria Angelia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2254, '16824', '589bc0d3a8cfeace553b6869205e0172', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Michael Alfian Camdesus Jondar', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2255, '16843', 'c0b9031eabb6c34699a6427622186cdc', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nico Gerry', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2256, '16847', 'a5e4edb22210b2b92b75baac5ed3c40a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Patricia Monique Gunawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2257, '16851', 'b803f0a4e6b8514f2dab43eaca581b05', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Prastya  Aldo Trisna Wijaya R.', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2258, '16853', '775a46e8c6d09ce5548db66cc249435c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ratna Permatasari', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2259, '16856', 'a5148ecf1c9f85aadcf0e2feb881df73', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ribka Kinanti Maharani Kassa', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2260, '16862', '3550284cdc2575eae68335f00870aaab', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Saferiana Friska Dian Arif', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2261, '16878', 'dfe0c74a3f265edd7b90e43990e70b00', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stephanie Angeline', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2262, '16881', '1c52486ff0b2a44fbfefeb15d21f53ae', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Steven Christian', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2263, '16906', '068190eec8a5bd9ac8b4634d95e97307', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vivian Wijaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2264, '16908', 'a1395df0a1abc218eb63b3addbdd1693', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Wahyu Trisna Ardi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2265, '16912', '81e68999106d6798eca552cbb9337751', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'William Herdiyanto Subandi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2266, '16919', 'e8ac54cbe87fabc82b852e38d18ddfc4', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yngwie Ursula Halim', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2267, '16623', 'e21878f9417743f70159ddb95bfb6997', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Amadeus Kevin Milan Prassale', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2268, '16633', '9274a5a0ee8785f893c95ac9420bfecf', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Angela Priscila Montolalu', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2269, '16644', '30b791a885974b40f58ca90a28ec695d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Axel Beny Putra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2270, '16647', 'b338e58b59a9ca0892d2f528f6ae2ae4', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Benjamin Chandra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2271, '16649', 'bd896f3dbc16b0042625fbf0a8ab8b3a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Billy Sanata Setyo Handiko', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2272, '16665', 'c881617af0ae19b38dd0546548cd53ad', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christine', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2273, '16670', '5b18e1a3e2092783aea4b1aa4a894d8a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cindy Junita', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2274, '16703', 'a1018bd684f0c6a62f01999a180e764b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Eugenius Timothy Halim', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2275, '16709', '3b58f125c880970b774c467f1c1c521e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fanny Lie Jaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2276, '16723', '68e3029766c319b18533206bed2ef83f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gabriele Leonna Benitta Mustamu', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2277, '16732', 'a19ea80272498982151686c2a8a81385', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Giovani', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2278, '16740', '65b9046124d9251a093cb5df709a6e2e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hani Mirakel', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2279, '16749', '37907ce5f65a8f731092bdf0a2b4bb35', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ingrid Meliana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2280, '16762', 'b3bf6193684f3983bb8642c8add75a4a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jessica Changda', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2281, '16770', '742d3c2a7ceaa6143597415ae49551d0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Johanna Lyvia Wohon', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2282, '16775', 'd7ce5233d2702b91fbbe0cf16b19f573', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Joshua Martin Chandra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2283, '16786', '4bc336b15417584fcec3e7dcc531d836', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Audry Ian Putra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2284, '16802', '03cdc6b841ba0131764711e5f1f4e47d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Leonardo Hendrawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2285, '16805', '9c99222b30e0425ea2f141f9e364d793', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lily Sugiarto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2286, '16816', '2adee3823fe0b1c49ce2b4124cdcecda', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mario Suyanta Chandra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2287, '16820', '9e18189975e5454f9335f3f1a17e0aa9', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Melia Christie', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2288, '16834', 'db11330cfb0a32a0e9b8e8b6c4bdc711', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nancy Cassia Sukmana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2289, '16864', '37d454532975b012c01edbd3bdffdae0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sean Yonathan Tanjung', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2290, '16870', '6a58d9ef674a31d1d5205a2e5429f603', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stefani Dewi Anggraini', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2291, '16884', '96ddc5dc8fec52547e2b998e85bd2628', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Theresia Jeanita', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2292, '16895', '21eb2cde1194b85163cbd079f5962edf', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vania Marlin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2293, '16899', '987c0be797a10daacfccda01dcb95604', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Verren Valencia Adrian', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2294, '16901', '0181dbcc3606f670bbe50f984967f358', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Victorya Alyssa Dewi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2295, '16910', '9f2101dd2222c9e8a3ec8d116da3b40a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Willhelmus Sandy Beoang', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2296, '16925', '750ed96f0d56d3346cda66d24bc0cbd5', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yustinus Dwi Prasetiyo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2297, '16926', '521eae94653641ec7be496db736ce3f6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yvonne Audrey Purnomo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2298, '16614', '7f9f3bdfd5974f2c11e9d6cd27c5f9f7', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aemelia Agatha', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2299, '16617', 'fade9da1bfe1c47c92f4ac38c11d0d1b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aldo Kesuma Karman', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2300, '16621', '1a5ee1ff6e413deb105e03f4bc5be351', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Alvina Sukadi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2301, '16626', '6ac8a357a461cc06579759bbdf12a39b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Andre Jayadi Sanjaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2302, '16637', '1309167cce18f6973a67a702d7b799fe', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anthony Evan Augusta', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2303, '16651', 'a6585f71fb9fd3d7782eace9cce70e07', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Brigita Stella Claudia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2304, '16656', 'dc7b367cfb9b38b3558bd127ad5c6696', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Celyne', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2305, '16659', '8339611181c6b2622eec0551fbd4d298', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christandy Adriel', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2306, '16675', '1098f40d613dcadb0486a71293cb6e31', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Clarence Finley Limantara', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2307, '16678', '15adc2044e61b45cd27d78ed5869434e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Damon Otto Gunarsa', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2308, '16700', '29282505fa1675d9c26d7ad4868b8727', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Eric San Fokalie', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2309, '16718', 'ead97089aae476d362a942d978947c32', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Feronia Nerissa', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2310, '16726', 'e863fb23a124570677ebdd1933876020', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gabrielle Vincentia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2311, '16729', '6e25278211d4f0aae930c0b1813cb3c6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Geovany Ivan Ananda Purnama', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2312, '16734', '4664965ba7a274dfbd20c33b5d05f253', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gracella Widjaya Pranata', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2313, '16747', 'f440bd64078a15691c260eedf190347a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Indahwati', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2314, '16759', 'a53d6030bd33042eb57382fe05023cd9', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jeanifer Kartika', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2315, '16765', 'c61f09172291b2268d13e1b8b8301e43', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jessica Velania Tanujaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2316, '16789', '34f9679482b481012016f1f5c8b977f0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Ryan ', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2317, '16799', '9a2241c2015fb98771d97a9828db1d73', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Laikito Wijaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2318, '16808', '2d2959e82e89b669b329c2926d32839f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lydia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2319, '16813', '4542d2e436ceac357ad7d9073a2c1665', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Maria Eva Sazmita', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2320, '16819', 'c0b3cb0842f9f8148f618c587b48d5ba', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Meilindah Gunawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2321, '16845', '0da0df5d34d8b9e9d12500dc7d343b5f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Olivia Christine Natalie', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2322, '16854', 'c05da36fcd17a89df6a5a64da2f933b4', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Reynaldo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2323, '16858', 'fa12ab68091d74718e2b3fabfcb8e2b1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Richard Delfs Lainama', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2324, '16859', '9300f7b7b99d92c0acf83ea618010e16', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Robert Djohari', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2325, '16873', '528eb47b936c737fcfdec8b5f6aa3dd0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stefanny Amelia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2326, '16886', '9dd28afc29684433c16b3855ae3cb9b6', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Thesia Aprillia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2327, '16890', '247c0a953f3a082b83443b3dfccedffb', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Trifena Liaw', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2328, '16893', '29da4aac5068b8bb36121391799925fa', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Vania Cindy', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2329, '16930', '62d7cfaa9f6b9ccf1bb85607bb6e7a13', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Arya Sanjaya Dharmaputra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2330, '16618', '2a3500f75bcde2b99b4999f34133a1d2', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ali', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2331, '16631', '8e225b8af6194ce00a5867fc85840757', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Andy Satria Gunawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2332, '16654', 'f277a0bf09ceeb7f90508c05044d3714', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Calvin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2333, '16660', 'd1034754ea4408f8b65822b590dfae7e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christella Gabriel Purwanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2334, '16666', '9c70dd4481954baba1aedcb963e91211', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christon Kurniawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2335, '16667', '67ded051d660fb05d7ad125986ddbf2d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cicely Alvina Liyanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2336, '16679', '05ed40159ccfbe2f7830d1c8701c5a54', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Daniel Andy Stefanus', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2337, '16695', '07be74f1a1b5e0a89a5f78ce1725a7eb', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Elly Aniwati', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2338, '16710', '5f7020a8356d965f6c2fb42887d3df0f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Farenza', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2339, '16714', 'a69d15dcf6d76d9d056662a38a11392d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Felicia Francisca Sabara', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2340, '16735', '4a3b13045573c232c0d6cc56e10f8f45', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Graciela Adelia Go', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2341, '16742', '3c26e81100f278a7b622b2b1f30d8bae', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hendri Sutanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2342, '16746', '93f8e322bb6adffeeb33a85d95c52316', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Imelda Sutanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2343, '16748', '484e01517b1395d6f8cce27fcc459cbf', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ine Maria Almasihana Ipi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2344, '16761', 'dec91085de9ca1d81110ab53c6ba700b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jessica Alviany Angkasa P.', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2345, '16771', '482a276004b304c760a6987e5704db04', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jonathan Julius Kurniawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2346, '16776', '789bbd3eb51e7315cf9995306bb399f5', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Juan Ginola', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2347, '16792', 'f796ccd346e70859193bb1a60812d685', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin Susanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2348, '16803', '6eda0403281df4b9a24d37790828effb', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Leony Gunawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2349, '16812', '1560fe0e80c19847a91c22e69d5036f1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Maria Clarita Hariono', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2350, '16817', '5eea6fd7b02448c35fd405cfe823d128', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Martinus Maximillian Sunur', '', 'sembunyikan', 'sembunyikan', '', '', '0');
INSERT INTO `useraura` (`UserId`, `user`, `password`, `level`, `tipe`, `is_online`, `last_ping`, `start`, `exp`, `nama`, `photo`, `statusemail`, `statustelp`, `email`, `telp`, `mapel`) VALUES
(2351, '16821', '1d5988d346d89a4e49e0b43c0f0d28d0', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Meliana Hartanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2352, '16823', 'afd53be629a8800e6447030f2e0961f7', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Melissa Wong', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2353, '16829', 'd958bc7285c14d6f775973d6d723d17b', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Monica Emily Wiyanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2354, '16836', 'cff815dabb3555cf1df47388baa32b84', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Nastasia Nolia Seva', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2355, '16866', '180a2a0cd826ab55eefc878446dbf891', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Shefry Frajonsky Simatauw', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2356, '16872', 'b5bca31df27b12cf9866fed9492a93ba', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stefanie Grace Metekohy', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2357, '16882', 'c180ea799253b0c26e08ab015ef89510', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Supriyanto Freddy', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2358, '16883', 'e8db6ebd8c4a86f982cd94bb49534ef3', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Theresia Dharma', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2359, '16889', 'c31b43829c7b4afe91ff4c0797247a76', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tiffany Samantha Dermawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2360, '16920', 'd40176e2795b1a99dc59620ac92a54c3', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Yoan Christian Sigit', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2361, '16616', '129faba692a0380b8c8fdc5fc01be8c1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Albert Carswell Gianto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2362, '16627', '0a9f1e65f58217963050ce14588e84f8', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Andrean Arcellino', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2363, '16642', 'f563f708bcb697a865cb29220f8158d1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aurelia Bevelin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2364, '16648', '8b43e1b8dd88fb9f6c99eb66f448a04c', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Berliana Nurannisa Kusuma Liu', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2365, '16650', 'cb1bc074b72dca1191308e9adc6792cd', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Brandone Koresy Thenny', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2366, '16669', 'a6dd1cdf6f9693dcf11c4450fab0e3f2', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cindy Indriyo ', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2367, '16677', '4adad48d42922db4295e8b7327fbbbf1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Cylvani Meiliana Hoarisan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2368, '16689', 'b8e60c2aec9d6135c765749b2e3bb99e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dionisius Revan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2369, '16691', '413d1c02fadc3d07904bbc992b2e9195', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Edelweis Atmajaya', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2370, '16699', '197e211074370064b2aff27ac8fd441d', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Emilia Stephani', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2371, '16701', 'cea64a883d35e5409c4bc81bdaedd55e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Eric Vincent', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2372, '16708', 'bf34e4c28fa03210f476777d37953134', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fanny Chinthia Purnomo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2373, '16728', '0501b4e3f17a759d1ac23462859567a7', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Geovanny Patricia Harianto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2374, '16741', '50b302ba631ec0a326431ea788874774', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Helena Tiffani Marie Jiewandana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2375, '16752', '66a168785ed58b2b5955cea85954d669', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Irving Williem Herly', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2376, '16754', '8a7c03958cbbbb5d374f4be72690ca7e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ivana Meliana', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2377, '16767', 'ad20360c1ad60f8f5d9223a28907d7ba', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Jessica Yosiana Angelia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2378, '16783', '7fbf2d8e7b84e90fd9e2698db2d22362', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kelvin Putra Soebagio', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2379, '16785', '5f1db7a13730fea2764ea1c0a3de2939', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kevin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2380, '16800', '0eeb5caaa2b554a8f2d508db44adb6dc', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Laurensia Bella', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2381, '16810', '49f2772fac96f92458c85ad52a644b1e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Marco Napolion', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2382, '16814', 'cefa4e5ffdb1f7c3a39e51f105a83109', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mariana Lieny Rusly', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2383, '16818', 'fec82acb7f6b4e8672bda38f9a7ddad3', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Mega Laurencia Oktaviani Yanuar', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2384, '16831', 'a0a052b2340749617466e56d7b8e74ef', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Monica Levina', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2385, '16839', '7068f5c7fb43d165180107a27beb6020', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Natasia Lie', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2386, '16857', 'de86bf257b1445bb65bb6c3c70b7ab24', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Richard', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2387, '16860', 'c47e6fcb58178824f37f28daba24a9a3', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Rudolf Immanuel Notohardjo', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2388, '16865', '414187419105b06734cd36adead79115', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Shanice Shania', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2389, '16885', '09107278fa56f05fb32b090efcdc8401', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Theresia Lahosa Adelin', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2390, '16888', 'a59c0ab76aec5a243f0c50fa6a5f36a7', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tiffany Immanuelia Nugraha', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2391, '16911', 'fb5c77496f3d3e72161c712f87005a6a', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'William Eka Putra', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2392, '16914', 'a3c5e98cbfa4ee6526dd52b58feff672', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Wimar Jeconiah', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2393, '16643', '1ceb3ad80c6675f705c7fef98012e9e1', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aurelia Lidwina Tanadi', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2394, '16692', 'ef05e93f3eb69985c3dcc58b11aac369', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Edison Lawby', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2395, '16702', '4981ae91bd5293b2c04ece22f1f685df', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Ervin Febriani', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2396, '16720', '91827a3c081a31153f16b3e86e3263fd', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Flouren Hartawan', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2397, '16733', '851612d3c194dc64724360831ff04bf8', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Giovanni Chang', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2398, '16738', 'b789f8b46e397e93b70a79f59d7424cb', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hadi Siswanto', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2399, '16756', 'a5460fe6c23289fddcfe66efe033ae08', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'James Michael', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2400, '16795', 'be4fb9f874bd9128410e7a0c88360139', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Kiki Melisa', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2401, '16801', '43901482383126ddc74f082188471c7e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Lauwrencia Bernades Rosalve', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2402, '16827', '1be8d57459a63a3275d039fa93ca5a1e', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Modista Garsia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2403, '16837', '052efaa17161f1e1044249e7efc5b17f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Natasha Sabella', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2404, '16869', 'b1491b673670aeae2dbf8827ba87a758', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Sintia Bela', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2405, '16871', '386a1940efd5c4d0c584523e580653b4', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stefani Patricia', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2406, '16877', 'a90f92d5609224ee7112c1f5d99f7e5f', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stella Matutina Septania', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2407, '16887', 'c87a29375d7d9eb63b5316cd73aa3229', 'Siswa', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Tiffanny Angeline', '', 'sembunyikan', 'sembunyikan', '', '', '0'),
(2413, 'kelas12', '4fecc680d4779fc32a2a12903b46e4a8', 'Siswa', 'aktif', 1, '2015-11-24 11:03:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'kelas12', '', 'sembunyikan', 'sembunyikan', '', '', ''),
(2414, 'cbt03', '217f77948a1fe62ec677b65041acf359', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Drs. Y. Panji Dwi Riyanto', '', 'sembunyikan', 'sembunyikan', '', '', '6'),
(2415, 'cbt12', '9786ab92ab8b9262a4e23703461cdeed', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'B. Widi Krismantari , S.Pd. ', '', 'sembunyikan', 'sembunyikan', '', '', '6'),
(2416, 'cbt23', '0685f4e78dccef0b9903bd4080e80dc2', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Th. Estiningtyas Utami , S.Pd. ', '', 'sembunyikan', 'sembunyikan', '', '', '6'),
(2417, 'cbt38', 'ba181ab510ee415b423928977d53b275', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aloisius Rabata Edhi Siswanto, S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '6'),
(2418, 'cbt22', 'b59696ffcaf1da563b4b0c22cd2b4f87', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dra. Theresia Lilyana ', '', 'sembunyikan', 'sembunyikan', '', '', '7'),
(2419, 'cbt34', '2cba56db2f234439dcda6778b35acd4e', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'A. Gatot Wibawanto, S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '7'),
(2420, 'cbt10', '490dc541a6be7d4fed8c6ccbebc243d8', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dra.C. Sunarni', '', 'sembunyikan', 'sembunyikan', '', '', '7'),
(2421, 'cbt33', '87ead5ce129b4b4cf614b1be0878d298', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Anastasia Lelyana Tuhuleruw, S.Pd. ', '', 'sembunyikan', 'sembunyikan', '', '', '7'),
(2422, 'cbt07', 'b742a079a3c70f741b9e33d755d93c02', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Dra. Rosula Sri Pamungkas Yudoretno', '', 'sembunyikan', 'sembunyikan', '', '', '8'),
(2423, 'cbt15', 'b6b9dd05462a0b854ee316d9caeb1bf3', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Y.B. Andik Adi Cahyono , S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '8'),
(2424, 'cbt19', '697bd211de157a1c4ea97b0459ab2952', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Stephanus Sulistyantoro , M.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '8'),
(2425, 'cbt37', '76e0d809a571b2328eaf4e76761ed8c6', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Resti Citranintyas, S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '8'),
(2426, 'cbt44', '5115abf6fb2347691aa106cb49b999d6', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Bayu Adhiwibowo, S. Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '8'),
(2427, 'cbt13', 'e05aa2968dd92cd68dc45de6bb65eb1e', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'M.V. Meliana Pantouw , S.Pd., S.H., M.Kn.', '', 'sembunyikan', 'sembunyikan', '', '', '9'),
(2428, 'cbt14', '888ccfb8c6732e7a4219c4c6a90d4d40', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Laurensius Wahyudiarjo , S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '9'),
(2429, 'cbt43', 'dfc1412581a06ab01120d434018466ef', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Theresia Anata, S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '9'),
(2430, 'cbt16', '5ef80ebc0db63bf38e228bbb1c7b2ef4', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Hendrika Dwi Hendrastuti, S.Si.', '', 'sembunyikan', 'sembunyikan', '', '', '10'),
(2431, 'cbt20', 'df79d0ac2c505deca05c70c7f2b9a00c', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Veronica Ervina Pudjiastuti , S.Si. ', '', 'sembunyikan', 'sembunyikan', '', '', '10'),
(2432, 'cbt36', '951175531260ec173a47cb0778a0170a', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christina Handoyo S.Si.', '', 'sembunyikan', 'sembunyikan', '', '', '10'),
(2433, 'cbt24', 'a20a6984e9e5253b46f4408106439618', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Flaviana Emmi Dwi Astuti, S.T. ', '', 'sembunyikan', 'sembunyikan', '', '', '5'),
(2434, 'cbt35', 'da8c529985f2935e626746e182d68ce0', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Fransiska Martanti, S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '5'),
(2435, 'cbt08', 'bd7185008943c97779db5c1c77d3399e', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Drs. Bernadus Edy Gunarso', '', 'sembunyikan', 'sembunyikan', '', '', '11'),
(2436, 'cbt40', '9d10646f8c23057870b2ca2e71db10dd', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Albertus Bambang Ariantoko, S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '11'),
(2437, 'cbt18', '0eed7579e5944117599ca2ee35a0e1ef', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christina Kustindarti , S.Pd., CFP', '', 'sembunyikan', 'sembunyikan', '', '', '12'),
(2438, 'cbt25', 'f32e7f9dda01a3e1b19967549e63bf65', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Markus Tri Wibowo , S.Pd. ', '', 'sembunyikan', 'sembunyikan', '', '', '12'),
(2439, 'cbt28', '3f4de3f5dbdeeb2771ce03a613288361', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Albertus Prihayudi Purnawijaya , S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '12'),
(2440, 'cbt21', 'd9129a4cb014e62b3863664577ae7406', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Eva Renanthya Grimaldi, S.Sos. ', '', 'sembunyikan', 'sembunyikan', '', '', '13'),
(2441, 'cbt32', '977cba6f8aa1466ca5b81ee6ab93fd94', 'Guru', 'aktif', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Erlina Thomas Novita, S.Pd.', '', 'sembunyikan', 'sembunyikan', '', '', '13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usercounter`
--

DROP TABLE IF EXISTS `usercounter`;
CREATE TABLE IF NOT EXISTS `usercounter` (
  `id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `usercounter`
--

INSERT INTO `usercounter` (`id`, `ip`, `counter`, `hits`) VALUES
(1, '::1-157.56.92.173-208.115.111.66-180.76.6.233-66.249.64.6-36.73.229.186-', 0, 746);

-- --------------------------------------------------------

--
-- Struktur dari tabel `useronline`
--

DROP TABLE IF EXISTS `useronline`;
CREATE TABLE IF NOT EXISTS `useronline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ipanda` (`ipanda`),
  KEY `timevisit` (`timevisit`),
  KEY `ipproxy` (`ipproxy`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Dumping data untuk tabel `useronline`
--

INSERT INTO `useronline` (`id`, `ipproxy`, `host`, `ipanda`, `proxyserver`, `timevisit`) VALUES
(95, '127.0.0.1', 'localhost', '127.0.0.1', '', 1321091831);

-- --------------------------------------------------------

--
-- Struktur dari tabel `useronlineday`
--

DROP TABLE IF EXISTS `useronlineday`;
CREATE TABLE IF NOT EXISTS `useronlineday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ipanda` (`ipanda`),
  KEY `timevisit` (`timevisit`),
  KEY `ipproxy` (`ipproxy`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5597 ;

--
-- Dumping data untuk tabel `useronlineday`
--

INSERT INTO `useronlineday` (`id`, `ipproxy`, `host`, `ipanda`, `proxyserver`, `timevisit`) VALUES
(5596, '::1', 'nafisah-PC', '::1', '', 1406996355);

-- --------------------------------------------------------

--
-- Struktur dari tabel `useronlinemonth`
--

DROP TABLE IF EXISTS `useronlinemonth`;
CREATE TABLE IF NOT EXISTS `useronlinemonth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipproxy` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `ipanda` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `timevisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `ipanda` (`ipanda`),
  KEY `timevisit` (`timevisit`),
  KEY `ipproxy` (`ipproxy`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3871 ;

--
-- Dumping data untuk tabel `useronlinemonth`
--

INSERT INTO `useronlinemonth` (`id`, `ipproxy`, `host`, `ipanda`, `proxyserver`, `timevisit`) VALUES
(3870, '::1', 'nafisah-PC', '::1', '', 1406996355);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
