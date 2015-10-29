-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 29 Okt 2015 pada 07.49
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
(5, 'Master', '#', 0, 6, 0, 'plugins.png'),
(8, 'Menus', 'menu', 1, 1, 4, ''),
(14, 'Admin User', 'user', 1, 1, 2, ''),
(96, 'Kursus', '#', 0, 7, 0, 'posts.png'),
(2, 'Settings', '#', 0, 2, 0, 'settings.png'),
(10, 'Ganti Password', 'gantipassword', 1, 1, 2, ''),
(77, 'Kelas', 'kelas', 1, 1, 5, ''),
(79, 'Siswa', 'importsiswa', 1, 2, 5, ''),
(84, 'Mata Pelajaran', 'mapel', 1, 3, 5, ''),
(101, 'Setting E-Learning', 'settingwebsite', 1, 2, 2, ''),
(100, 'Latihan Ujian', 'ujian', 1, 4, 96, ''),
(99, 'Pengumuman Sekolah', 'pengumuman', 1, 3, 96, ''),
(103, 'File Manager', 'filemanager', 1, 4, 5, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
