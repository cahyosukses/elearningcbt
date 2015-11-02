-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 02 Nov 2015 pada 13.05
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `elearningcbt`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data untuk tabel `soal`
--

INSERT INTO `soal` (`id`, `ujian`, `soal`, `pilihan`, `kunci`, `files`) VALUES
(6, 36, 'Diketahuireaksi : CaCO<sub>3</sub> (s)+ 2HCl (aq) &rarr;CaCl<sub>2</sub> (aq)+ H<sub>2</sub>O (l)+ CO<sub>2</sub> (g)\r\nJika 5 gram batu kapur direaksikan dengan asam klorida encer, maka pada keadaan RTP akan diperoleh gas CO<sub>2&nbsp;</sub>sebanyak &hellip; <br />(Ar : Ca = 40 , Cl = 35,5 , O = 16 , C = 12 dan H = 1)', '1,20 dm<sup>3</sup>#2,40 dm<sup>3</sup>#4,80 dm<sup>3</sup>#6,00 dm<sup>3</sup>#12,0 dm<sup>3</sup>', 'a', ''),
(7, 36, 'Bila data entalpi pembentukan standar:\r\nC<sub>3</sub>H<sub>8</sub> (g) = &ndash; 104 kJ mol<sup>&ndash;1<br /></sup>CO<sub>2</sub> (g) = &ndash; 394 kJ mol<sup>&ndash;1<br /></sup>H<sub>2</sub>O (g) = &ndash; 286 kJ mol<sup>&ndash;1</sup>\r\nmaka harga &Delta;H reaksi :&nbsp; C<sub>3</sub>H<sub>8</sub>(g) + 5O<sub>2</sub>(g) &rarr; 3CO<sub>2</sub>(g) + 4H<sub>2</sub>O(l) adalah &hellip;\r\n', '&ndash;1.024 kJ#&ndash;1.121 kJ#&ndash;1.134 kJ#&ndash;2.222 kJ#&ndash;2.232 kJ', 'd', ''),
(8, 36, 'Reaksi : N<sub>2 </sub>(g)+ 3H<sub>2</sub> (g) &hArr;2NH<sub>3</sub> (g)&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; âˆ†H = &ndash; 22 kkal Pernyataan di bawahini yang mengakibatkan pergeseran kesetimbangan ke arah kanan untuk reaksi di atas adalah &hellip;', 'Kenaikan suhu#Pengurangan Tekanan#penambahan volume#penambahan katalis#penurunan suhu', 'e', ''),
(9, 36, 'Larutan garam berikut &nbsp;yang bersifat basaadalah &hellip;', 'NaCl#Na<sub>2</sub>SO<sub>4</sub>#CH<sub>3</sub>COONa#NaI#NH<sub>4</sub>Cl', 'c', ''),
(10, 36, 'Diketahui :\r\nKsp Ag<sub>2</sub>CO<sub>3</sub>= 8 &times;10<sup>&ndash;12<br /></sup>Ksp Ag<sub>2</sub>S = 8 &times;10<sup>&ndash;</sup><sup>15<br /></sup>KspAgCl = 2 &times;10<sup>&ndash;10<br /></sup>Ksp Ag<sub>3</sub>PO<sub>4</sub>= 1 &times;10<sup>&ndash;18<br /></sup>Urutan kelarutan garam-garam tersebut diatas dari &nbsp;yang &nbsp;kecilke yang besar adalah &hellip;', 'AgCl &ndash; Ag<sub>2</sub>S&ndash; Ag<sub>3</sub>PO<sub>4</sub>&ndash; Ag<sub>2</sub>CO<sub>3</sub>#Ag<sub>2</sub>S &ndash; AgCl &ndash; Ag<sub>3</sub>PO<sub>4</sub>&ndash; Ag<sub>2</sub>CO<sub>3</sub>#Ag<sub>2</sub>CO<sub>3</sub>&ndash; Ag<sub>3</sub>PO<sub>4</sub>&ndash; AgCl &ndash; Ag<sub>2</sub>S#Ag<sub>2</sub>S &ndash; Ag<sub>3</sub>PO<sub>4</sub>&ndash; Ag<sub>2</sub>CO<sub>3</sub>&ndash; AgCl#AgCl &ndash; Ag<sub>2</sub>S &ndash; Ag<sub>2</sub>CO<sub>3</sub>&ndash; Ag<sub>3</sub>PO', 'a', ''),
(11, 36, 'Reaksi berikut :\r\n3Br<sub>2</sub> (g)+ aOH<sup>&ndash;</sup>(aq) &rarr;bBrO<sub>3</sub><sup>&ndash;</sup>(aq) + cBr<sup>&ndash;</sup>(aq) + dH<sub>2</sub>O(l)\r\nHarga koefisien a, b, c, d supaya reaksi di atas setara adalah &hellip;\r\n', '<span>2, 2, 5 dan 1</span>#6, 1, 5 dan 3#6, 5, 1 dan 3#5, 6, 3 dan 1#4, 1, 5 dan 2', 'b', ''),
(12, 36, 'Diketahui potensial elektroda :\r\nAg<sup>+</sup>(aq) + e&nbsp; &rarr;Ag(s)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E<sup>o</sup> = + 0,80 volt\r\nMn<sup>2+</sup>(aq) + 2e &rarr;Mg(s)&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E<sup>o</sup> = &ndash; 2,34 volt\r\nIn<sup>3+</sup>(aq) + 3e&nbsp; &rarr;In(s)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E<sup>o</sup> = &ndash; 0,34 volt\r\nMn<sup>2+</sup>(aq)+ 2e &rarr;Mn(s)&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; E<sup>o</sup> = &ndash; 1,20 volt\r\nDua set setengah sel di bawah ini yang mempunyai nilai E<sup>o</sup>sel = 2 volt adalah .&hellip;', 'Mg | Mg<sup>2+</sup> ||Ag<sup>+</sup> | Ag#Ag | Ag<sup>+</sup> || Mg<sup>2+</sup> | Mg#Mn | Mn<sup>2+</sup> || In<sup>3+</sup> | In#Mn | Mn<sup>2+</sup> || Mg<sup>2+</sup> | Mg#Ag | Ag<sup>+</sup> || In<sup>3+</sup> | In', 'c', ''),
(13, 36, 'Karbohidrat &nbsp;yang &nbsp;termasuk kelompok disakarida adalah .&hellip;', 'sukrosa#amilum#galaktosa#glukosa#selulosa', 'd', ''),
(14, 36, 'Fase terdispersi dan medium pendispersi dari buih adalah .&hellip;', 'Cair dalam gas#Padat dalam gas#Gas dalam cair#Padat dalam padat#gas dalam padat', 'c', ''),
(15, 36, '<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\nData pengamatan daya hantar listrik beberapa larutandalam air sebagai berikut :\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\nLarutan\r\n</td>\r\n<td>\r\nLampumenyala\r\n</td>\r\n<td>\r\nPengamatan lain\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nP\r\n</td>\r\n<td>\r\nredup\r\n</td>\r\n<td>\r\nadagelembung\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nQ\r\n</td>\r\n<td>\r\nterang\r\n</td>\r\n<td>\r\nadagelembung\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nR\r\n</td>\r\n<td>\r\n-\r\n</td>\r\n<td>\r\nadagelembung\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nS\r\n</td>\r\n<td>\r\nTerang\r\n</td>\r\n<td>\r\nadagelembung\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\nT\r\n</td>\r\n<td>\r\n-\r\n</td>\r\n<td>\r\n-\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\nYang tergolong larutan elektrolit lemah dan non elektrolit adalah larutan &hellip;.', 'Q dan R#P dan T#Q dan T#T dan P#Semua Salah', 'b', ''),
(16, 37, 'Mangannomor atomnya 24. Dalam system periodic manganterletak pada golongan &hellip; dan periode &hellip;.', 'V A dan 4#V Bdan 4#VI B dan 4#VI B dan3#VI A dan 4', 'c', ''),
(17, 37, 'Unsur P dengan nomor atom 15 dan unsur Cl dengan nomor atom 17 pembentuk senyawa PCl<sub>3</sub>, &nbsp;yang bentuk molekulnya adalah &hellip;', 'segitiga planar#bipiramida trigonal#piramida trigonal#tetrahedron#bujursangkar', 'c', ''),
(18, 37, 'Jika 11,2 gram Fe (Ar = 56) habis bereaksi dengan oksigen (Ar = 16) menurut persamaan reaksi :\r\n4Fe(s) + 3O<sub>2</sub>(g) &rarr; 2Fe<sub>2</sub>O<sub>3</sub>(s)\r\nMaka massa zat hasil reaksi adalah &hellip;', '16 gram#20 gram#24 gram#30 gram#32 gram', 'a', ''),
(19, 37, 'Diketahuireaksi :\r\n<ol>\r\n<li>CH<sub>3</sub>&ndash;CH<sub>2</sub>&ndash;CH<sub>2</sub>CH<sub>3</sub> + Cl<sub>2</sub> &rarr;CH<sub>3</sub>&ndash;CH<sub>2</sub>&ndash;CH<sub>2</sub>&ndash;CH<sub>2</sub>Cl + HCl</li>\r\n<li>CH<sub>3</sub>&ndash;CH<sub>2</sub>&ndash;CH=CH<sub>2</sub> + HCl &rarr;CH<sub>3</sub>&ndash;CH<sub>2</sub>&ndash;CHCl&ndash;CH<sub>3</sub></li>\r\n<li>H<sub>3</sub>C&ndash;&ndash;CH<sub>2</sub>Br &rarr;H<sub>2</sub>C=CH<sub>2</sub>+ HBr</li>\r\n</ol>\r\n&nbsp;Jenis reaksi (1) dan (2) di atas berturut- turut adalah &hellip;', 'substitusi, eliminasi dan adisi#adisi, eliminasi dan substitusi#adisi, substitusi dan eliminasi#oksidasi, adisi dan eliminasi#substitusi, adisi dan eliminasi', 'e', ''),
(20, 37, 'Jika arus sebesar 10 ampere dialirkan selama 15 menit ke dalam larutan tembaga (II) sulfat, maka massa Cu yang diendapkan pada katoda adalah&hellip;.(Ar Cu = 63,5)', '1,66 gram#1,69 gram#2,36 gram#2,96 gram#3,66 gram', 'd', ''),
(21, 37, 'Data percobaanlajureaksidiperolehdarireaksi :\r\n&nbsp;A + B &rarr;C&nbsp; sebagaiberikut :\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\nNomorPercobaan\r\n</td>\r\n<td>\r\n[A] M\r\n</td>\r\n<td>\r\n[B] M\r\n</td>\r\n<td>\r\nLajuReaksi (M/detik)\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n1\r\n</td>\r\n<td>\r\n0,01\r\n</td>\r\n<td>\r\n0,20\r\n</td>\r\n<td>\r\n0,02\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n2\r\n</td>\r\n<td>\r\n0,02\r\n</td>\r\n<td>\r\n0,20\r\n</td>\r\n<td>\r\n0,08\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n3\r\n</td>\r\n<td>\r\n0,03\r\n</td>\r\n<td>\r\n0,20\r\n</td>\r\n<td>\r\n0,18\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n4\r\n</td>\r\n<td>\r\n0,03\r\n</td>\r\n<td>\r\n0,40\r\n</td>\r\n<td>\r\n0,36\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\nRumus laju reaksinya adalah &hellip;', '&nbsp;V = k [A]<sup>2</sup>[B]#&nbsp;V = k [A] [B]<sup>2</sup>#&nbsp;V = k [A] [B]#V = k [A]<sup>2</sup>[B]<sup>2</sup>#V = k [A]<sup>3</sup>[B]', 'a', ''),
(22, 37, 'Untuk membuat larutan penyangga dengan pH = 5, maka ke dalam 40 mL larutan 0,1 M asam asetat ( Ka =10<sup>-5</sup>) harus ditambahkan larutan NaOH 0,2 M sebanyak ....', '50 mL#40 mL#30 mL#20 mL#10 mL', 'e', ''),
(23, 37, 'Larutan berikut yang membentuk garam yang terhidrolisis parsial adalah&hellip; .', '100 cm<sup>3</sup> CH<sub>3</sub>COOH 0,1 M dan 100 cm<sup>3</sup>NaOH 0,1 M#100 cm<sup>3</sup> CH<sub>3</sub>COOH 0,2 M dan 100 cm<sup>3</sup>NaOH 0,1 M#100 cm<sup>3</sup> CH<sub>3</sub>COOH 0,1 M dan 100 cm<sup>3</sup>NaOH 0,2 M#100 cm<sup>3</sup> NH<sub>3</sub>(aq) 0,5 M dan 100 cm<sup>3</sup>HCl 0,1 M#100 cm<sup>3</sup>NaOH (aq) 0,1 M dan 100 cm<sup>3</sup>HCl 0,1 M', 'a', ''),
(24, 37, 'Larutan 40 mL NaOH 0,1 M dicampur dengan 60 mL larutan HCl 0,05 M. Untuk menetralkan campuran ini dibutuhkan H<sub>2</sub>SO<sub>4</sub> 0,05 M sebanyak ....', '20 mL#15 mL#10 mL#5 mL#1 mL', 'c', ''),
(25, 37, 'Senyawa-senyawa dengan rumus :\r\nCH<sub>3</sub>COOCH<sub>2</sub>CH<sub>3 </sub>, CH<sub>3</sub>OCH<sub>2</sub>CH<sub>3</sub> dan CH<sub>3</sub>COCH<sub>2</sub>CH<sub>3</sub> berturut-turut merupakan &hellip;', 'keton &ndash; ester &ndash; eter#ester &ndash; eter &ndash; keton#keton &ndash; eter - ester#eter &ndash; keton - ester#eter &ndash; ester &ndash; keton', 'b', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
