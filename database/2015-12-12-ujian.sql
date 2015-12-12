-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 12 Des 2015 pada 11.24
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data untuk tabel `ujian`
--

INSERT INTO `ujian` (`id`, `tgl`, `judul`, `pointbenar`, `pointsalah`, `pointkosong`, `tipe`, `jumlahsoal`, `tipejawaban`, `status`, `idmapel`, `petunjuk`, `tipeujian`, `listening`, `user`) VALUES
(36, '2015-10-30', 'Tipe 1', '10', '0', '0', 'random', '10', 'a,b,c,d,e', 'enabled', '5', '', 'latihan', '', 'admin'),
(37, '2015-10-30', 'Tipe 2', '10', '0', '0', 'random', '10', 'a,b,c,d,e', 'enabled', '5', '', '', '', 'admin'),
(39, '2015-12-10', 'Ujian SIM C', '10', '0', '0', 'random', '10', 'a,b,c', 'disabled', '14', '', 'latihan', '', 'admin'),
(41, '2015-12-12', 'Listening Part 1', '10', '0', '0', 'random', '10', 'a,b,c,d,e', 'disabled', '7', '', 'latihan', 'Listening UN Bahasa Inggris 2012 1.mp3', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
