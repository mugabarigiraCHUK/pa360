-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 19, 2010 at 08:58 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `pa360ino`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE IF NOT EXISTS `alamat` (
  `ID_ALAMAT` int(11) NOT NULL AUTO_INCREMENT,
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `NAMA_ALAMAT` varchar(100) DEFAULT NULL,
  `KODE_POS` int(11) DEFAULT NULL,
  `KODE_AREA` int(11) DEFAULT NULL,
  `KOTA` varchar(30) DEFAULT NULL,
  `PROPINSI` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_ALAMAT`,`KODE_KARYAWAN`),
  KEY `KODE_KARYAWAN` (`KODE_KARYAWAN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`ID_ALAMAT`, `KODE_KARYAWAN`, `NAMA_ALAMAT`, `KODE_POS`, `KODE_AREA`, `KOTA`, `PROPINSI`) VALUES
(1, 'K001', 'JLN SEMOLOWARU NO 124', 25, 555, 'JATIM', 'JATIM'),
(1, 'K012', 'JLN UJUNG KULON NO55', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K013', 'JLN KENJERAN', 555, 25, 'SURABAYA', ''),
(1, 'K014', 'JLN NYAMPLUNGAN NO 45', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K015', 'JLN SEMAMPIR 20', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'k016', 'JLN IMAM BONJOL', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K017', 'jln php no 69', 555, 25, 'MADIUN', 'JATIM'),
(1, 'k018', 'JLN IMANUDIN NO 90', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'k019', 'JLN SEMAMPIR UTARA 123', 5555, 25, 'SUARABAYA', 'JATIM'),
(1, 'K020', 'JLN IRIAN NO 90', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K021', 'JLN AHMAD YANI  NO80', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K022', 'JLN PANJANG JIWO NO 67', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'k023', 'JLN SEDATI', 555, 25, 'SUARABAYA', 'JATIM'),
(1, 'K024', 'JLN GEJAYAN NO 34', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K025', 'JLN TRINGGILIS NO 78', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K026', 'JLN KUNIR  NO 67', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K027', 'JLN KEDINDING 23', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K028', 'JLN BILITON NO 98', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K029', 'JLN SIWALANKERTO NO 76', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K030', 'JLN SWEDESI NO 78', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K031', 'jln sidosermo no 90', 555, 25, 'SURABAY', 'JATIM'),
(1, 'k032', 'JLN SIDOSERMO AIRDAS 34', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K033', 'JLN KEDITI 34', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K034', 'JLN KETINTANG NO 87', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K035', 'JLN SUDIRMAN NO 23', 555, 25, 'KEDIRI', 'JATIM'),
(1, 'K036', 'JLN AHMAD YANI 40', 555, 25, 'SURABAYA', 'JATIM'),
(1, 'K037', 'JLN SLAMET NO 34', 555, 31, 'surabaya', 'jatim'),
(2, 'K002', 'JLN SENGSARA NO 3', 555, 25, 'SURABAYA', 'JATIM'),
(3, 'K003', 'JLN URIP NO 34', 555, 25, 'SURABAYA', 'JATIM'),
(4, 'k004', 'JLN KENJERAN NO 3000', 555, 25, 'SURABAYA', 'JATIM'),
(5, 'k005', 'JLN SEMAMPIR vA', 555, 25, 'SURABAYA', 'JATIM'),
(6, 'K006', 'JLN SIDOSERMO 34', 555, 25, 'SURABAYA', 'JATIM'),
(7, 'K007', 'JLN GIANYAR NO 454', 555, 25, 'SURABAYA', 'JATIM'),
(8, 'K008', 'JLN KEMBANG JEPUN 20', 555, 25, 'SURABAYA', 'JATIM'),
(9, 'k009', 'JLN MANDALA 23', 555, 25, 'SURABAYA', 'JATIM'),
(10, 'k010', 'JLN KUNIR NO 32', 555, 25, 'SURABAYA', 'JATIM'),
(11, 'K011', 'JLN IKAN KERAPU BAKAR WEENAK TENAN ', 555, 25, 'SURABAYA', 'JATIM'),
(29, '4343434', '1232131221', 11, 11, '21321', '21321'),
(30, '4343434', 'xxxxxxxxxx', 0, 0, '', ''),
(32, '4343434', 'www', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_level`
--

CREATE TABLE IF NOT EXISTS `bobot_level` (
  `ID_BOBOT_LEVEL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERIODE` varchar(50) NOT NULL,
  `ID_LEVEL` varchar(50) NOT NULL,
  `NAMA_LEVEL` varchar(50) DEFAULT NULL,
  `DESKRIPSI` text,
  `BOBOT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_BOBOT_LEVEL`),
  KEY `ID_PERIODE` (`ID_PERIODE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `bobot_level`
--

INSERT INTO `bobot_level` (`ID_BOBOT_LEVEL`, `ID_PERIODE`, `ID_LEVEL`, `NAMA_LEVEL`, `DESKRIPSI`, `BOBOT`) VALUES
(7, 'jan - 2010', 'HZ1', 'Horizontal 1', '', 20),
(8, 'jan - 2010', 'HZ2', 'Horizontal 2', '', 20),
(9, 'jan - 2010', 'HZ3', 'Horizontal 3', '', 20),
(10, 'jan - 2010', 'HZ4', 'Horizontal 4', '', 20),
(11, 'jan - 2010', 'HZ5', 'Horizontal 5', '', 20),
(12, 'jan - 2010', 'VC1', 'Vertical 1', '', 20),
(13, 'jan - 2010', 'VC2', 'Vertical 2', '', 20),
(14, 'jan - 2010', 'VC3', 'Vertical 3', '', 20),
(15, 'jan - 2010', 'VC4', 'Vertical 4', '', 20),
(16, 'jan - 2010', 'VC5', 'Vertical 5', '', 20),
(17, 'feb-2010', 'HZ1', 'Horizontal 1', '', 35),
(18, 'feb-2010', 'HZ2', 'Horizontal 2', '', 33),
(19, 'feb-2010', 'HZ3', 'Horizontal 3', '', 33),
(20, 'feb-2010', 'VC1', 'Vertical 1', '', 33),
(21, 'feb-2010', 'VC2', 'Vertical 2', '', 33),
(22, 'feb-2010', 'VC3', 'Vertical 3', '', 33);

-- --------------------------------------------------------

--
-- Table structure for table `data_department`
--

CREATE TABLE IF NOT EXISTS `data_department` (
  `ID_DEPARTMENT` varchar(10) NOT NULL,
  `NAMA_DEPARTMENT` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_DEPARTMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_department`
--

INSERT INTO `data_department` (`ID_DEPARTMENT`, `NAMA_DEPARTMENT`) VALUES
('DEP000', 'STIKOM'),
('DEP001', 'HUMAS'),
('DEP002', 'SEKRETARIS'),
('DEP003', 'PRODI S1 SISTEM INFORMASI'),
('DEP004', 'PRODI S1 SISTEM KOMPUTER'),
('DEP005', 'PRODI DIII MULTIMEDIA'),
('DEP006', 'PRODI DIII MI'),
('DEP007', 'PRODI DIII KPK'),
('DEP008', 'LK'),
('DEP009', 'BAGIAN PPM'),
('DEP010', 'BAGIAN PUS'),
('DEP011', 'BAGIAN AU'),
('DEP012', 'BAGIAN AAK'),
('DEP013', 'BAGIAN PPTI'),
('DEP014', 'BAGIAN PSDM'),
('DEP015', 'BAGIAN PENMARU'),
('DEP016', 'BAGIAN KMHS'),
('DEP017', 'SSI'),
('DEP018', 'BAGIAN BD'),
('DEP019', 'KENDALI MUTU'),
('DEP020', 'PRODI DIII KGC');

-- --------------------------------------------------------

--
-- Table structure for table `data_divisi`
--

CREATE TABLE IF NOT EXISTS `data_divisi` (
  `ID_DIVISI` varchar(10) NOT NULL,
  `NAMA_DIVISI` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_DIVISI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_divisi`
--

INSERT INTO `data_divisi` (`ID_DIVISI`, `NAMA_DIVISI`) VALUES
('DIV000', 'STIKOM'),
('DIV001', 'PPKF'),
('DIV002', 'SDPC'),
('DIV003', 'SEKSII PENGEMBANGAN LAB'),
('DIV004', 'SEKSI ADMINISRASI'),
('DIV005', 'SEKSI KEUANGAN'),
('DIV006', 'SEKSI TEKNISI'),
('DIV007', 'SEKSI PENGADAAN'),
('DIV008', 'SEKSI PERAWATAN PERALATAN'),
('DIV009', 'SEKSI RUMAH TANGGA'),
('DIV010', 'SEKSI FRONT OFFICE'),
('DIV011', 'SEKSI BACK OFFICE'),
('DIV012', 'SEKSI PENGEMBANGAN JARINGAN'),
('DIV013', 'SEKSI PENGEMBANGAN SI'),
('DIV014', 'KEGITAN MAHASISWA'),
('DIV015', 'SCC'),
('DIV016', 'PPS');

-- --------------------------------------------------------

--
-- Table structure for table `data_golongan`
--

CREATE TABLE IF NOT EXISTS `data_golongan` (
  `ID_GOLONGAN` varchar(10) NOT NULL,
  `NAMA_GOLONGAN` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_GOLONGAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_golongan`
--

INSERT INTO `data_golongan` (`ID_GOLONGAN`, `NAMA_GOLONGAN`) VALUES
('GOL001', 'A1'),
('GOL002', 'A II'),
('GOL003', 'A III'),
('GOL004', 'B 1'),
('GOL005', 'B II');

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

CREATE TABLE IF NOT EXISTS `data_jabatan` (
  `ID_JABATAN` varchar(10) NOT NULL,
  `NAMA_JABATAN` varchar(50) DEFAULT NULL,
  `LEVEL_JABATAN` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_JABATAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`ID_JABATAN`, `NAMA_JABATAN`, `LEVEL_JABATAN`) VALUES
('JAB001', 'KETUA STIKOM', '1.1'),
('JAB002', 'WAKIL KETUA I', '2.1'),
('JAB003', 'WAKIL KETUA II', '2.2'),
('JAB004', 'WAKIL KETUA III', '2.3'),
('JAB005', 'KEPALA BAGIAN HUMAS', '3.1'),
('JAB006', 'SEKERTARIS', '3.2'),
('JAB007', 'KETUA PROGRAM STUDI SI SISTEM INFORMASI', '4.1'),
('JAB008', 'KETUA PROGRAM STUDI SK', '4.2'),
('JAB009', 'KETUA  STUDI DIII MANAJEMEN INFORMATIKA', '4.3'),
('JAB010', 'KETUA STUDI DIII KOMPUTER MULTIMEDIA', '4.4'),
('JAB011', 'KETUA KOMPUTER AKUNTANSI', '4.5'),
('JAB012', 'KETUA DIII KOMPUTER GRAFIS DAN CETAK', '4.6'),
('JAB013', 'KETUA DIII KOMPUTERISASI  PERKANTORAN', '4.7'),
('JAB014', 'KEPALA BAGIAN LK', '4.8'),
('JAB015', 'KEPALA BAGIAN PPM', '4.9'),
('JAB016', 'KEPALA BAGIAN PUS', '4.10'),
('JAB017', 'SEKSI PUS', '4.11'),
('JAB018', 'SEKSI BAGIAN AU', '4.12'),
('JAB019', 'SEKSI BAGIAN AAK', '4.13'),
('JAB020', 'SEKSI BAGIAN PPTI', '4.14'),
('JAB021', 'SEKSI BAGIAN PSDM', '4.15'),
('JAB022', 'SEKSI BAGIAN PENMARU', '4.16'),
('JAB023', 'SEKSI BAGIAN KMHS', '4.17'),
('JAB024', 'SEKSI BAGIAN SSI', '4.18'),
('JAB025', 'SEKSI BAGIAN BD', '4.19'),
('JAB026', 'SEKSI BAGIAN KENDALI MUTU', '4.20'),
('JAB027', 'SEKSI PPKF', '5.1'),
('JAB028', 'SEKSI PENGEMBANGAN LAB', '5.2'),
('JAB029', 'SEKSI KEUANGAN', '5.3'),
('JAB030', 'SEKSI FRONT OFFICE', '5.4'),
('JAB031', 'SEKSI PENGEMBANGAN JARINGAN', '5.5'),
('JAB032', 'SEKSI KEGIATAN MHS', '5.6'),
('JAB033', 'SEKSI PPS', '5.7'),
('JAB034', 'SEKSI SDPC', '6.1'),
('JAB035', 'SEKSI ADMINISTRASI', '6.2'),
('JAB036', 'SEKSI TEKNISI', '6.3'),
('JAB037', 'SEKSI BACK OFFICE', '6.4'),
('JAB038', 'SEKSI PENGEMBANGAN SI', '6.5'),
('JAB039', 'SEKSI SCC', '6.6');

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan`
--

CREATE TABLE IF NOT EXISTS `data_karyawan` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `NAMA_KARYAWAN` varchar(50) DEFAULT NULL,
  `TEMPAT_LAHIR` varchar(50) DEFAULT NULL,
  `TANGGAL_LAHIR` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `JENIS_KELAMIN` varchar(20) DEFAULT NULL,
  `GOLONGAN_DARAH` varchar(2) DEFAULT NULL,
  `STATUS` varchar(30) DEFAULT NULL,
  `AGAMA` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `TANGGAL_MASUK` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TANGGAL_KELUAR` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ID_STATUS_KARYAWAN` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`),
  KEY `ID_STATUS_KARYAWAN` (`ID_STATUS_KARYAWAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_karyawan`
--

INSERT INTO `data_karyawan` (`KODE_KARYAWAN`, `NAMA_KARYAWAN`, `TEMPAT_LAHIR`, `TANGGAL_LAHIR`, `JENIS_KELAMIN`, `GOLONGAN_DARAH`, `STATUS`, `AGAMA`, `EMAIL`, `TANGGAL_MASUK`, `TANGGAL_KELUAR`, `ID_STATUS_KARYAWAN`) VALUES
('4343434', 'MUSA', '', '0000-00-00 00:00:00', '1', '', 'BK', 'B', 'freezyoff@gmaill.com', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'STAT001'),
('K001', 'Jangkung, MBA', 'yogjakarta', '0000-00-00 00:00:00', '0', 'B', 'K', 'K', 'JANGKUNG@YAHOO.CO.ID', '2008-01-31 00:00:00', '0000-00-00 00:00:00', 'STAT001'),
('K002', 'SUDARSONO, MBA', 'KALIMANTAN', '0000-00-00 00:00:00', '0', 'O', 'K', 'I', 'SUDAR@YAHOO.CO.ID', '2002-01-31 00:00:00', '0000-00-00 00:00:00', NULL),
('K003', 'SUDARMANTO, MMT', 'JAKARTA', '0000-00-00 00:00:00', '0', 'B', 'K', 'H', 'SUDAR@GMAIL.COM', '2006-02-02 00:00:00', '0000-00-00 00:00:00', NULL),
('K004', 'MANZUR SAMANA, SKOM', 'KUPANG', '0000-00-00 00:00:00', '0', 'AB', 'DJ', 'I', 'P@YAHOO.CO.ID', '2002-05-17 00:00:00', '0000-00-00 00:00:00', NULL),
('K005', 'ENDANG WIDYASTUTI, S.E.', 'BALI', '1980-02-07 00:00:00', '1', 'O', 'BK', 'I', 'ENDANG@GMAIL.COM', '2009-12-02 00:00:00', '0000-00-00 00:00:00', NULL),
('K006', 'SITI ADAWIYA, SKOM,MMT', 'KEFAMENANU', '1981-04-30 00:00:00', '1', 'AB', 'K', 'I', 'R@YAHOO.CO.ID', '2002-09-14 00:00:00', '0000-00-00 00:00:00', NULL),
('K007', 'I PUTU AGUS SWATIKA, M.KOM', 'BALI', '0000-00-00 00:00:00', '0', 'B', 'BK', 'H', 'AGUS@YAHOO.COM', '2006-02-02 00:00:00', '0000-00-00 00:00:00', NULL),
('K008', 'TJI HOK HOO,S.T,M,SC', 'JEPANG', '0000-00-00 00:00:00', '0', 'AB', 'K', 'B', 'TJI@GMAIL.COM', '2002-05-16 00:00:00', '0000-00-00 00:00:00', NULL),
('K009', 'A.B. TJANDRARINI,S.SI,M,SC', 'JOMBANG', '1985-05-10 00:00:00', '1', 'B', 'K', 'I', 'RINI@YAHOO.CO.ID', '2001-06-08 00:00:00', '0000-00-00 00:00:00', NULL),
('K010', 'IR. HARDMAN BUDIARJO', 'SURABAYA', '0000-00-00 00:00:00', '0', 'B', 'BK', 'H', 'Y@YAHOO.COM', '2002-02-16 00:00:00', '0000-00-00 00:00:00', NULL),
('K011', 'A.B TJANDRA, MKOM', 'KEDIRI', '0000-00-00 00:00:00', '0', 'B', 'K', 'H', 'CANDRA@YAHOO.OCM', '2002-05-17 00:00:00', '0000-00-00 00:00:00', NULL),
('K012', 'KRISTIAN S.WATIMENA', 'UJUNG PANDANG', '0000-00-00 00:00:00', '0', 'A', 'K', 'I', 'IIN@YAHOO.CO.ID', '2001-02-01 00:00:00', '0000-00-00 00:00:00', NULL),
('K013', 'GITA NURSINTQ', 'LAMONGAN', '1974-06-07 00:00:00', '1', 'AB', 'BK', 'I', 'GITA@YAHOO.COM', '2001-02-09 00:00:00', '0000-00-00 00:00:00', NULL),
('K014', 'PANCA RAHARDIYANTO,SKOM', 'SIDOARJA', '1979-02-01 00:00:00', '0', 'B', 'K', 'I', 'PANCA@YAHOO.CO.ID', '2002-05-17 00:00:00', '0000-00-00 00:00:00', NULL),
('K015', 'SOENDORO HERLAMBANG, SKOM', 'LAMPUNG', '0000-00-00 00:00:00', '0', 'B', 'K', 'K', 'DORO@YAHOO.COM', '2002-02-07 00:00:00', '0000-00-00 00:00:00', NULL),
('K016', 'TRI SAGIRANI, SKOM', 'KEFAMENANU', '0000-00-00 00:00:00', '0', 'AB', 'K', 'K', 'TRI@YAHOO.CO.ID', '2009-12-04 00:00:00', '0000-00-00 00:00:00', NULL),
('K017', 'TUTUT WIRJAYANTO,SKOM', 'MADIUN', '1991-01-31 00:00:00', '0', 'B', 'K', 'I', 'TUTUT@GMAIL.COM', '2001-02-09 00:00:00', '0000-00-00 00:00:00', NULL),
('K018', 'TOMMY SANDS WUNGKAR, M.H', 'MATARAM', '0000-00-00 00:00:00', '0', 'AB', 'K', 'I', 'WUNGKAR@GMAIL.COM', '2005-05-12 00:00:00', '0000-00-00 00:00:00', NULL),
('K019', 'JANUAR WIBOW, ST,M.M', 'LAMONGAN', '0000-00-00 00:00:00', '0', 'B', 'K', 'K', 'JANUAR@YAHOO.CO.ID', '2006-04-04 00:00:00', '0000-00-00 00:00:00', NULL),
('K020', 'DRS ABDUL HALIMSAYAH', 'AMBON', '0000-00-00 00:00:00', '0', 'AB', 'K', 'I', 'HALIM@GMAIL.COM', '2001-05-17 00:00:00', '0000-00-00 00:00:00', NULL),
('K021', 'PANTJAWATI SUDAR, SKOM', 'SURABAYA', '0000-00-00 00:00:00', '1', 'AB', 'K', 'I', 'PANCA@YAHOO.CO.ID', '2009-12-02 00:00:00', '0000-00-00 00:00:00', NULL),
('K022', 'BUDI HERMAWAN, SKOM', 'SIDOARJO', '0000-00-00 00:00:00', '0', 'B', 'K', 'I', 'HER@YAHOO.CO.ID', '2009-12-06 00:00:00', '0000-00-00 00:00:00', NULL),
('K023', 'JUSAK IRAWAN, PH,D', 'BLITAR', '1981-06-13 00:00:00', '0', 'B', 'K', 'I', 'JUSAK@YAHOO.CO.ID', '2009-12-01 00:00:00', '0000-00-00 00:00:00', NULL),
('K024', 'IRWANSYAH, SKOM', 'MATARAM', '0000-00-00 00:00:00', '1', 'A', 'K', 'I', 'IR@YAHOO.CO.ID', '2009-12-06 00:00:00', '0000-00-00 00:00:00', NULL),
('K025', 'SRIMULYANI', 'JAKARTA', '0000-00-00 00:00:00', '1', 'O', 'K', 'I', 'SRI@YAHOO.CO.ID', '2009-12-18 00:00:00', '2009-12-10 00:00:00', NULL),
('K026', 'HERMANSYAH,SKOM', 'MALANG', '0000-00-00 00:00:00', '0', 'AB', 'BK', 'H', 'HER@YAHOO.CO.ID', '2009-12-05 00:00:00', '0000-00-00 00:00:00', NULL),
('K027', 'IVAN ORDINARY, SKOM', 'BANDUNG', '0000-00-00 00:00:00', '0', 'B', 'K', 'I', 'IVAN@YAHOO.COM', '2008-02-01 00:00:00', '0000-00-00 00:00:00', NULL),
('K028', 'RAMLAN, SE', 'YOGYAKARTA', '2008-05-06 00:00:00', '0', 'O', 'K', 'I', 'RAMLAN@YAHOO.CO.ID', '2002-02-01 00:00:00', '0000-00-00 00:00:00', NULL),
('K029', 'AMIR,SKOM', 'JOMBANG', '1987-09-25 00:00:00', '0', 'AB', 'K', 'I', 'AMIR@YAHOO.CO.ID', '2002-05-09 00:00:00', '0000-00-00 00:00:00', NULL),
('K030', 'MUHAMMAD RIZAL,SE', 'SURABAYA', '1980-08-14 00:00:00', '0', 'A', 'K', 'I', 'RIZAL@YAHOO.CO.ID', '2002-01-31 00:00:00', '0000-00-00 00:00:00', NULL),
('K031', 'RIFKA ZAENAL ,SE', 'PADANG', '2007-05-17 00:00:00', '0', 'B', 'BK', 'B', 'RIFKA@YAHOO.CO.ID', '2008-05-08 00:00:00', '0000-00-00 00:00:00', NULL),
('k032', 'MUHAMMAD IMAM KADAFI,SKOM', 'KEFAMENANU', '1980-05-15 00:00:00', '0', 'B', 'K', 'I', 'IMAM@YAHOO.CO.ID', '2007-05-10 00:00:00', '0000-00-00 00:00:00', NULL),
('K033', 'HASNA,SE', 'KUPANG', '1993-05-06 00:00:00', '1', 'A', 'K', 'I', 'HASNA@YAHOO.CO.ID', '2008-05-08 00:00:00', '0000-00-00 00:00:00', NULL),
('K034', 'AMELDA,SKOM', 'KEDIRI', '1980-04-08 00:00:00', '1', 'AB', 'K', 'I', 'MELDA@YAHOO.COM', '2007-05-17 00:00:00', '0000-00-00 00:00:00', NULL),
('K035', 'WAHYU NOVIASTONO, SE', 'ATAMBUA', '1987-05-06 00:00:00', '0', 'B', 'K', 'I', 'WAHYU@YAHOO.CO.ID', '2010-01-01 00:00:00', '0000-00-00 00:00:00', NULL),
('K036', 'ASSEGAF, SP', 'KEDIRI', '0000-00-00 00:00:00', '0', 'A', 'K', 'I', 'ASEE@YAHOO.CO.ID', '2010-01-13 00:00:00', '0000-00-00 00:00:00', NULL),
('K037', 'IBNU RUSI, SKOM', 'BONTANG', '1980-04-14 00:00:00', '0', 'B', 'K', 'I', 'j@yahoo.co.id', '2010-01-07 00:00:00', '0000-00-00 00:00:00', NULL),
('xxxx', 'xxxxx', '', '0000-00-00 00:00:00', '0', 'A', 'BK', 'B', 'Fsdsd@asdsd.h', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'STAT001');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE IF NOT EXISTS `data_user` (
  `user_nama` varchar(10) NOT NULL,
  `user_password` varchar(50) NOT NULL COMMENT 'pake md5',
  `user_tipe` int(11) NOT NULL COMMENT '1=administrator, 2=user biasa',
  PRIMARY KEY (`user_nama`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`user_nama`, `user_password`, `user_tipe`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1),
('K001', '73e8b30aba2d0cf27b323a487cfec25e', 2),
('K002', 'bebc31106d79fcd3fa764015cc1e92a1', 2),
('K003', 'dfb5667bdff4741b8e14285ec97dbff8', 2),
('K004', '798e8344ad321b98dd90b9ea688dcd4c', 2),
('K005', '051171820bcd17d2f757bb1c01ab5734', 2),
('K006', 'e71a4976855867ccd08c643d491ee9d1', 2),
('K007', '4bed23525ccf4b9d760dd7c1664a9ad9', 2),
('K008', '489a13fb16d71aa2cb295c2d2349125b', 2),
('K009', 'ddb4f2a9c26b2af786450671e30b15f0', 2),
('K010', '1c88202962d5145dcdb589e7fb3d7425', 2),
('K011', 'cdebffc5d8564fe5470d35fef477ff14', 2),
('K012', '77b87459fe4254f013753da0598ee35e', 2),
('K013', '80453c5c2a94e624c457130870b2373d', 2),
('K014', '1bcc68d7830cb4daca6cc0f2b23555d3', 2),
('K015', '05120e2999da94e3d6fceea99b1c7f69', 2),
('K016', 'bb96fac1f1a16610473501e1dccecd2b', 2),
('K024', '2a38da524c47a16474e6021818534f35', 2),
('K025', 'd15a640279bdbb329622c2a33fe85619', 2),
('K031', 'd29806fcf2501d5242ef19903711a9cd', 2),
('K032', '465d985843d4c5037640792a3387b352', 2),
('K037', 'f9d25fadb08bf371a9d6d1fa40f9fbae', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dep_divisi_jabatan`
--

CREATE TABLE IF NOT EXISTS `dep_divisi_jabatan` (
  `ID_DEP_DIV_JAB` int(11) NOT NULL AUTO_INCREMENT,
  `ID_JABATAN` varchar(10) DEFAULT NULL,
  `ID_DIVISI` varchar(10) DEFAULT NULL,
  `ID_DEPARTMENT` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_DEP_DIV_JAB`),
  KEY `ID_DEPARTMENT` (`ID_DEPARTMENT`),
  KEY `ID_DIVISI` (`ID_DIVISI`),
  KEY `ID_JABATAN` (`ID_JABATAN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dep_divisi_jabatan`
--

INSERT INTO `dep_divisi_jabatan` (`ID_DEP_DIV_JAB`, `ID_JABATAN`, `ID_DIVISI`, `ID_DEPARTMENT`) VALUES
(1, 'JAB004', 'DIV000', 'DEP001'),
(2, 'JAB001', 'DIV000', 'DEP000'),
(3, 'JAB007', 'DIV002', 'DEP001');

-- --------------------------------------------------------

--
-- Table structure for table `deskripsi_bobot`
--

CREATE TABLE IF NOT EXISTS `deskripsi_bobot` (
  `NILAI` int(11) NOT NULL,
  `ID_DETAIL_KRITERIA` int(11) NOT NULL,
  `DESKRIPSI` text,
  PRIMARY KEY (`NILAI`,`ID_DETAIL_KRITERIA`),
  KEY `ID_DETAIL_KRITERIA` (`ID_DETAIL_KRITERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deskripsi_bobot`
--

INSERT INTO `deskripsi_bobot` (`NILAI`, `ID_DETAIL_KRITERIA`, `DESKRIPSI`) VALUES
(1, 1, 'sangat buruk, tidak bertanggung jawab'),
(1, 2, 'sangat buruk, tidak bertanggung jawab'),
(1, 3, 'sangat buruk, tidak bertanggung jawab'),
(1, 4, 'sangat buruk, tidak bertanggung jawab'),
(1, 5, 'sangat buruk, tidak bertanggung jawab'),
(1, 6, 'sangat buruk, tidak bertanggung jawab'),
(1, 7, 'sangat buruk, tidak bertanggung jawab'),
(1, 8, 'sangat buruk, tidak bertanggung jawab'),
(1, 9, 'sangat buruk, tidak bertanggung jawab'),
(1, 10, 'sangat buruk, tidak bertanggung jawab'),
(1, 11, 'sangat buruk, tidak bertanggung jawab'),
(2, 1, 'sangat buruk'),
(2, 2, 'sangat buruk'),
(2, 3, 'sangat buruk'),
(2, 4, 'sangat buruk'),
(2, 5, 'sangat buruk'),
(2, 6, 'sangat buruk'),
(2, 7, 'sangat buruk'),
(2, 8, 'sangat buruk'),
(2, 9, 'sangat buruk'),
(2, 10, 'sangat buruk'),
(2, 11, 'sangat buruk'),
(3, 1, 'sangat buruk'),
(3, 2, 'sangat buruk'),
(3, 3, 'sangat buruk'),
(3, 4, 'sangat buruk'),
(3, 5, 'sangat buruk'),
(3, 6, 'sangat buruk'),
(3, 7, 'sangat buruk'),
(3, 8, 'sangat buruk'),
(3, 9, 'sangat buruk'),
(3, 10, 'sangat buruk'),
(3, 11, 'sangat buruk'),
(4, 1, 'buruk'),
(4, 2, 'buruk'),
(4, 3, 'buruk'),
(4, 4, 'buruk'),
(4, 5, 'buruk'),
(4, 6, 'buruk'),
(4, 7, 'buruk'),
(4, 8, 'buruk'),
(4, 9, 'buruk'),
(4, 10, 'buruk'),
(4, 11, 'buruk'),
(5, 1, 'kurang sekali'),
(5, 2, 'kurang sekali'),
(5, 3, 'kurang sekali'),
(5, 4, 'kurang sekali'),
(5, 5, 'kurang sekali'),
(5, 6, 'kurang sekali'),
(5, 7, 'kurang sekali'),
(5, 8, 'kurang sekali'),
(5, 9, 'kurang sekali'),
(5, 10, 'kurang sekali'),
(5, 11, 'kurang sekali'),
(6, 1, 'kurang'),
(6, 2, 'kurang'),
(6, 3, 'kurang'),
(6, 4, 'kurang'),
(6, 5, 'kurang'),
(6, 6, 'kurang'),
(6, 7, 'kurang'),
(6, 8, 'kurang'),
(6, 9, 'kurang'),
(6, 10, 'kurang'),
(6, 11, 'kurang'),
(7, 1, 'cukup'),
(7, 2, 'cukup'),
(7, 3, 'cukup'),
(7, 4, 'cukup'),
(7, 5, 'cukup'),
(7, 6, 'cukup'),
(7, 7, 'cukup'),
(7, 8, 'cukup'),
(7, 9, 'cukup'),
(7, 10, 'cukup'),
(7, 11, 'cukup'),
(8, 1, 'baik'),
(8, 2, 'baik'),
(8, 3, 'baik'),
(8, 4, 'baik'),
(8, 5, 'baik'),
(8, 6, 'baik'),
(8, 7, 'baik'),
(8, 8, 'baik'),
(8, 9, 'baik'),
(8, 10, 'baik'),
(8, 11, 'baik'),
(9, 1, 'sangat baik'),
(9, 2, 'sangat baik'),
(9, 3, 'sangat baik'),
(9, 4, 'sangat baik'),
(9, 5, 'sangat baik'),
(9, 6, 'sangat baik'),
(9, 7, 'sangat baik'),
(9, 8, 'sangat baik'),
(9, 9, 'sangat baik'),
(9, 10, 'sangat baik'),
(9, 11, 'sangat baik'),
(10, 1, 'MANTAP'),
(10, 2, 'MANTAP'),
(10, 3, 'MANTAP'),
(10, 4, 'MANTAP'),
(10, 5, 'MANTAP'),
(10, 6, 'MANTAP'),
(10, 7, 'MANTAP'),
(10, 8, 'MANTAP'),
(10, 9, 'MANTAP'),
(10, 10, 'MANTAP'),
(10, 11, 'MANTAP');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kriteria`
--

CREATE TABLE IF NOT EXISTS `detail_kriteria` (
  `ID_DETAIL_KRITERIA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_KRITERIA` int(11) NOT NULL,
  `NAMA_DETAIL_KRITERIA` varchar(50) DEFAULT NULL,
  `DESKRIPSI` text,
  `BOBOT` double DEFAULT NULL,
  PRIMARY KEY (`ID_DETAIL_KRITERIA`),
  KEY `ID_KRITERIA` (`ID_KRITERIA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `detail_kriteria`
--

INSERT INTO `detail_kriteria` (`ID_DETAIL_KRITERIA`, `ID_KRITERIA`, `NAMA_DETAIL_KRITERIA`, `DESKRIPSI`, `BOBOT`) VALUES
(1, 1, 'KUALITAS', 'nilai 1 = sangat buruk, tidak bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 70),
(2, 1, 'KUANTITAS', 'nilai 1 = sangat buruk, tidak  \n          bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 30),
(3, 2, 'PENGETAHUAN + SKILL', 'nilai 1 = sangat buruk, tidak bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 30),
(4, 2, 'TANGGUNG JAWAB', 'nilai 1 = sangat buruk, tidak bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 35),
(5, 2, 'KOMUNIKASI DAN KERJASAMA', 'nilai 1 = sangat buruk, tidak  \n          bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 35),
(6, 3, 'MOTIVASI', 'nilai 1 = sangat buruk, tidak  \n          bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 45),
(7, 3, 'DISIPLIN', 'nilai 1 = sangat buruk, tidak  \n          bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 55),
(8, 4, 'PLANNING', 'nilai 1 = sangat buruk, tidak bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 25),
(9, 4, 'ORGANIZING', 'nilai 1 = sangat buruk, tidak bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 25),
(10, 4, 'ACTUATING', 'nilai 1 = sangat buruk, tidak  \n          bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 25),
(11, 4, 'CONTROLING', 'nilai 1 = sangat buruk, tidak  \n          bertanggung jawab\nnilai 2 = sangat buruk\nnilai 3 = sangat \nnilai 4 = buruk  \nnilai 5 = kurang sekali\nnilai 6 = kurang\nnilai 7 = cukup\nnilai 8 = baik\nnilai 9 = sangat baik\nnilai 10 = mantap', 25);

-- --------------------------------------------------------

--
-- Table structure for table `detil_bobot_level`
--

CREATE TABLE IF NOT EXISTS `detil_bobot_level` (
  `ID_DETIL_BOBOT_LEVEL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_KRITERIA` int(11) NOT NULL,
  `ID_BOBOT_LEVEL` int(11) NOT NULL,
  `BOBOT` double DEFAULT NULL,
  PRIMARY KEY (`ID_DETIL_BOBOT_LEVEL`),
  KEY `ID_KRITERIA` (`ID_KRITERIA`),
  KEY `ID_BOBOT_LEVEL` (`ID_BOBOT_LEVEL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `detil_bobot_level`
--

INSERT INTO `detil_bobot_level` (`ID_DETIL_BOBOT_LEVEL`, `ID_KRITERIA`, `ID_BOBOT_LEVEL`, `BOBOT`) VALUES
(2, 1, 7, 35),
(3, 2, 7, 0),
(4, 3, 7, 0),
(5, 4, 7, 65),
(6, 1, 17, 0),
(7, 2, 17, 0),
(8, 3, 17, 0),
(9, 4, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_penilaian`
--

CREATE TABLE IF NOT EXISTS `kriteria_penilaian` (
  `ID_KRITERIA` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_KRITERIA` varchar(50) DEFAULT NULL,
  `DESKRIPSI` text,
  PRIMARY KEY (`ID_KRITERIA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kriteria_penilaian`
--

INSERT INTO `kriteria_penilaian` (`ID_KRITERIA`, `NAMA_KRITERIA`, `DESKRIPSI`) VALUES
(1, 'HASIL KERJA', ''),
(2, 'KUALITAS PERSONAL', ''),
(3, 'KEMAUAN / ATTITUDE', ''),
(4, 'KUALITAS MANAJERIAL', '');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_akhir`
--

CREATE TABLE IF NOT EXISTS `nilai_akhir` (
  `KODE_DINILAI` int(11) NOT NULL AUTO_INCREMENT,
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `ID_DEP_DIV_JAB` int(11) NOT NULL,
  `ID_PERIODE` varchar(50) NOT NULL,
  `NILAI_AKHIR` double DEFAULT NULL,
  PRIMARY KEY (`KODE_DINILAI`),
  KEY `ID_PERIODE` (`ID_PERIODE`),
  KEY `KODE_KARYAWAN` (`KODE_KARYAWAN`,`ID_DEP_DIV_JAB`),
  KEY `ID_DEP_DIV_JAB` (`ID_DEP_DIV_JAB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nilai_akhir`
--

INSERT INTO `nilai_akhir` (`KODE_DINILAI`, `KODE_KARYAWAN`, `ID_DEP_DIV_JAB`, `ID_PERIODE`, `NILAI_AKHIR`) VALUES
(5, 'K001', 2, 'jan - 2010', 0),
(6, 'xxxx', 3, 'jan - 2010', 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_kinerja`
--

CREATE TABLE IF NOT EXISTS `nilai_per_kinerja` (
  `ID_NILAI_PER_KINERJA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_DETAIL_KRITERIA` int(11) NOT NULL,
  `ID_NILAI_PER_KRITERIA` int(11) NOT NULL,
  `NILAI` double DEFAULT NULL,
  PRIMARY KEY (`ID_NILAI_PER_KINERJA`),
  KEY `ID_DETAIL_KRITERIA` (`ID_DETAIL_KRITERIA`),
  KEY `ID_NILAI_PER_KRITERIA` (`ID_NILAI_PER_KRITERIA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `nilai_per_kinerja`
--


-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_kriteria`
--

CREATE TABLE IF NOT EXISTS `nilai_per_kriteria` (
  `ID_NILAI_PER_KRITERIA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_NILAI_PER_PENILAI` int(11) NOT NULL,
  `ID_DETIL_BOBOT_LEVEL` int(11) DEFAULT NULL,
  `NILAI` double DEFAULT NULL,
  PRIMARY KEY (`ID_NILAI_PER_KRITERIA`),
  KEY `ID_DETIL_BOBOT_LEVEL` (`ID_DETIL_BOBOT_LEVEL`),
  KEY `ID_NILAI_PER_PENILAI` (`ID_NILAI_PER_PENILAI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `nilai_per_kriteria`
--


-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_penilai`
--

CREATE TABLE IF NOT EXISTS `nilai_per_penilai` (
  `ID_NILAI_PER_PENILAI` int(11) NOT NULL AUTO_INCREMENT,
  `KODE_DINILAI` int(11) DEFAULT NULL,
  `KODE_PENILAI` int(11) DEFAULT NULL,
  `ID_BOBOT_LEVEL` int(11) DEFAULT NULL,
  `NILAI` double DEFAULT NULL,
  PRIMARY KEY (`ID_NILAI_PER_PENILAI`),
  KEY `ID_BOBOT_LEVEL` (`ID_BOBOT_LEVEL`),
  KEY `KODE_PENILAI` (`KODE_PENILAI`),
  KEY `KODE_DINILAI` (`KODE_DINILAI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `nilai_per_penilai`
--

INSERT INTO `nilai_per_penilai` (`ID_NILAI_PER_PENILAI`, `KODE_DINILAI`, `KODE_PENILAI`, `ID_BOBOT_LEVEL`, `NILAI`) VALUES
(5, 5, 1, 7, 0),
(6, 6, 1, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilai`
--

CREATE TABLE IF NOT EXISTS `penilai` (
  `KODE_PENILAI` int(11) NOT NULL AUTO_INCREMENT,
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `ID_DEP_DIV_JAB` int(11) NOT NULL,
  PRIMARY KEY (`KODE_PENILAI`),
  KEY `KODE_KARYAWAN` (`KODE_KARYAWAN`,`ID_DEP_DIV_JAB`),
  KEY `ID_DEP_DIV_JAB` (`ID_DEP_DIV_JAB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `penilai`
--

INSERT INTO `penilai` (`KODE_PENILAI`, `KODE_KARYAWAN`, `ID_DEP_DIV_JAB`) VALUES
(1, '4343434', 1),
(2, 'K001', 2);

-- --------------------------------------------------------

--
-- Table structure for table `relasi_div_jab_din`
--

CREATE TABLE IF NOT EXISTS `relasi_div_jab_din` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `TANGGAL_MENJABAT` date DEFAULT NULL,
  `TANGGAL_BERHENTI` date DEFAULT NULL,
  `ID_DEP_DIV_JAB` int(11) NOT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`ID_DEP_DIV_JAB`),
  KEY `ID_DEP_DIV_JAB` (`ID_DEP_DIV_JAB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi_div_jab_din`
--

INSERT INTO `relasi_div_jab_din` (`KODE_KARYAWAN`, `TANGGAL_MENJABAT`, `TANGGAL_BERHENTI`, `ID_DEP_DIV_JAB`) VALUES
('4343434', '0000-00-00', '0000-00-00', 1),
('K001', '2010-01-05', '0000-00-00', 2),
('xxxx', '2010-01-24', '0000-00-00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `relasi_golongan`
--

CREATE TABLE IF NOT EXISTS `relasi_golongan` (
  `ID_GOLONGAN` varchar(10) NOT NULL,
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `TANGGAL_MENJABAT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TANGGAL_BERHENTI` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_GOLONGAN`,`KODE_KARYAWAN`),
  KEY `KODE_KARYAWAN` (`KODE_KARYAWAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi_golongan`
--

INSERT INTO `relasi_golongan` (`ID_GOLONGAN`, `KODE_KARYAWAN`, `TANGGAL_MENJABAT`, `TANGGAL_BERHENTI`) VALUES
('GOL001', '4343434', '2010-01-20 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `setting_periode`
--

CREATE TABLE IF NOT EXISTS `setting_periode` (
  `ID_PERIODE` varchar(50) NOT NULL,
  `PERIODE_AWAL` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `PERIODE_AKHIR` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `BOBOT_VERTIKAL` int(11) DEFAULT NULL,
  `BOBOT_HORIZONTAL` int(11) DEFAULT NULL,
  `LEVEL_VERTIKAL` int(11) DEFAULT NULL,
  `LEVEL_HORIZONTAL` int(11) DEFAULT NULL,
  `BATAS_AWAL_PENILAIAN` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `BATAS_AKHIR_PENILAIAN` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID_PERIODE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_periode`
--

INSERT INTO `setting_periode` (`ID_PERIODE`, `PERIODE_AWAL`, `PERIODE_AKHIR`, `BOBOT_VERTIKAL`, `BOBOT_HORIZONTAL`, `LEVEL_VERTIKAL`, `LEVEL_HORIZONTAL`, `BATAS_AWAL_PENILAIAN`, `BATAS_AKHIR_PENILAIAN`) VALUES
('feb-2010', '2010-02-01 00:00:00', '2010-02-28 00:00:00', 50, 50, 3, 3, '2010-03-01 00:00:00', '2010-03-31 00:00:00'),
('jan - 2010', '2010-01-01 00:00:00', '2010-01-31 00:00:00', 50, 50, 5, 5, '2010-02-01 00:00:00', '2010-02-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `status_karyawan`
--

CREATE TABLE IF NOT EXISTS `status_karyawan` (
  `ID_STATUS_KARYAWAN` varchar(10) NOT NULL,
  `NAMA_STATUS` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_STATUS_KARYAWAN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_karyawan`
--

INSERT INTO `status_karyawan` (`ID_STATUS_KARYAWAN`, `NAMA_STATUS`) VALUES
('STAT001', 'AKTIF'),
('STAT002', 'NON AKTIF'),
('STAT003', 'CUTI'),
('STAT004', 'STUDI BANDING KE EROPA'),
('STAT005', 'STUDI BANDING KE YOGYAKARTA'),
('STAT006', 'CUTI HAMIL');

-- --------------------------------------------------------

--
-- Table structure for table `telpon`
--

CREATE TABLE IF NOT EXISTS `telpon` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `NO_TELPON` int(11) NOT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`NO_TELPON`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telpon`
--

INSERT INTO `telpon` (`KODE_KARYAWAN`, `NO_TELPON`) VALUES
('4343434', 123),
('k001', 2147483647),
('K002', 93289823),
('K003', 94993993),
('k004', 938493),
('k005', 777777),
('K006', 98989898),
('K007', 32432423),
('K008', 93249385),
('k009', 8543893),
('k010', 328493453),
('K011', 375843785),
('K013', 39454305),
('K014', 394934543),
('K015', 93894359),
('k016', 787534843),
('K017', 866798888),
('k018', 89437854),
('k019', 44444),
('K020', 332435435),
('K037', 824839438);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`KODE_KARYAWAN`) REFERENCES `data_karyawan` (`KODE_KARYAWAN`);

--
-- Constraints for table `bobot_level`
--
ALTER TABLE `bobot_level`
  ADD CONSTRAINT `bobot_level_ibfk_1` FOREIGN KEY (`ID_PERIODE`) REFERENCES `setting_periode` (`ID_PERIODE`);

--
-- Constraints for table `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD CONSTRAINT `data_karyawan_ibfk_1` FOREIGN KEY (`ID_STATUS_KARYAWAN`) REFERENCES `status_karyawan` (`ID_STATUS_KARYAWAN`);

--
-- Constraints for table `dep_divisi_jabatan`
--
ALTER TABLE `dep_divisi_jabatan`
  ADD CONSTRAINT `dep_divisi_jabatan_ibfk_1` FOREIGN KEY (`ID_DEPARTMENT`) REFERENCES `data_department` (`ID_DEPARTMENT`),
  ADD CONSTRAINT `dep_divisi_jabatan_ibfk_2` FOREIGN KEY (`ID_DIVISI`) REFERENCES `data_divisi` (`ID_DIVISI`),
  ADD CONSTRAINT `dep_divisi_jabatan_ibfk_3` FOREIGN KEY (`ID_JABATAN`) REFERENCES `data_jabatan` (`ID_JABATAN`);

--
-- Constraints for table `deskripsi_bobot`
--
ALTER TABLE `deskripsi_bobot`
  ADD CONSTRAINT `deskripsi_bobot_ibfk_1` FOREIGN KEY (`ID_DETAIL_KRITERIA`) REFERENCES `detail_kriteria` (`ID_DETAIL_KRITERIA`);

--
-- Constraints for table `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  ADD CONSTRAINT `detail_kriteria_ibfk_1` FOREIGN KEY (`ID_KRITERIA`) REFERENCES `kriteria_penilaian` (`ID_KRITERIA`);

--
-- Constraints for table `detil_bobot_level`
--
ALTER TABLE `detil_bobot_level`
  ADD CONSTRAINT `detil_bobot_level_ibfk_1` FOREIGN KEY (`ID_KRITERIA`) REFERENCES `kriteria_penilaian` (`ID_KRITERIA`),
  ADD CONSTRAINT `detil_bobot_level_ibfk_2` FOREIGN KEY (`ID_BOBOT_LEVEL`) REFERENCES `bobot_level` (`ID_BOBOT_LEVEL`);

--
-- Constraints for table `nilai_akhir`
--
ALTER TABLE `nilai_akhir`
  ADD CONSTRAINT `nilai_akhir_ibfk_4` FOREIGN KEY (`ID_DEP_DIV_JAB`) REFERENCES `relasi_div_jab_din` (`ID_DEP_DIV_JAB`),
  ADD CONSTRAINT `nilai_akhir_ibfk_1` FOREIGN KEY (`ID_PERIODE`) REFERENCES `setting_periode` (`ID_PERIODE`),
  ADD CONSTRAINT `nilai_akhir_ibfk_2` FOREIGN KEY (`KODE_KARYAWAN`, `ID_DEP_DIV_JAB`) REFERENCES `relasi_div_jab_din` (`KODE_KARYAWAN`, `ID_DEP_DIV_JAB`),
  ADD CONSTRAINT `nilai_akhir_ibfk_3` FOREIGN KEY (`KODE_KARYAWAN`) REFERENCES `relasi_div_jab_din` (`KODE_KARYAWAN`);

--
-- Constraints for table `nilai_per_kinerja`
--
ALTER TABLE `nilai_per_kinerja`
  ADD CONSTRAINT `nilai_per_kinerja_ibfk_1` FOREIGN KEY (`ID_DETAIL_KRITERIA`) REFERENCES `detail_kriteria` (`ID_DETAIL_KRITERIA`),
  ADD CONSTRAINT `nilai_per_kinerja_ibfk_2` FOREIGN KEY (`ID_NILAI_PER_KRITERIA`) REFERENCES `nilai_per_kriteria` (`ID_NILAI_PER_KRITERIA`);

--
-- Constraints for table `nilai_per_kriteria`
--
ALTER TABLE `nilai_per_kriteria`
  ADD CONSTRAINT `nilai_per_kriteria_ibfk_1` FOREIGN KEY (`ID_DETIL_BOBOT_LEVEL`) REFERENCES `detil_bobot_level` (`ID_DETIL_BOBOT_LEVEL`),
  ADD CONSTRAINT `nilai_per_kriteria_ibfk_2` FOREIGN KEY (`ID_NILAI_PER_PENILAI`) REFERENCES `nilai_per_penilai` (`ID_NILAI_PER_PENILAI`);

--
-- Constraints for table `nilai_per_penilai`
--
ALTER TABLE `nilai_per_penilai`
  ADD CONSTRAINT `nilai_per_penilai_ibfk_1` FOREIGN KEY (`ID_BOBOT_LEVEL`) REFERENCES `bobot_level` (`ID_BOBOT_LEVEL`),
  ADD CONSTRAINT `nilai_per_penilai_ibfk_2` FOREIGN KEY (`KODE_PENILAI`) REFERENCES `penilai` (`KODE_PENILAI`),
  ADD CONSTRAINT `nilai_per_penilai_ibfk_3` FOREIGN KEY (`KODE_DINILAI`) REFERENCES `nilai_akhir` (`KODE_DINILAI`);

--
-- Constraints for table `penilai`
--
ALTER TABLE `penilai`
  ADD CONSTRAINT `penilai_ibfk_3` FOREIGN KEY (`ID_DEP_DIV_JAB`) REFERENCES `relasi_div_jab_din` (`ID_DEP_DIV_JAB`),
  ADD CONSTRAINT `penilai_ibfk_1` FOREIGN KEY (`KODE_KARYAWAN`, `ID_DEP_DIV_JAB`) REFERENCES `relasi_div_jab_din` (`KODE_KARYAWAN`, `ID_DEP_DIV_JAB`),
  ADD CONSTRAINT `penilai_ibfk_2` FOREIGN KEY (`KODE_KARYAWAN`) REFERENCES `relasi_div_jab_din` (`KODE_KARYAWAN`);

--
-- Constraints for table `relasi_div_jab_din`
--
ALTER TABLE `relasi_div_jab_din`
  ADD CONSTRAINT `relasi_div_jab_din_ibfk_1` FOREIGN KEY (`KODE_KARYAWAN`) REFERENCES `data_karyawan` (`KODE_KARYAWAN`),
  ADD CONSTRAINT `relasi_div_jab_din_ibfk_2` FOREIGN KEY (`ID_DEP_DIV_JAB`) REFERENCES `dep_divisi_jabatan` (`ID_DEP_DIV_JAB`);

--
-- Constraints for table `relasi_golongan`
--
ALTER TABLE `relasi_golongan`
  ADD CONSTRAINT `relasi_golongan_ibfk_1` FOREIGN KEY (`KODE_KARYAWAN`) REFERENCES `data_karyawan` (`KODE_KARYAWAN`),
  ADD CONSTRAINT `relasi_golongan_ibfk_2` FOREIGN KEY (`ID_GOLONGAN`) REFERENCES `data_golongan` (`ID_GOLONGAN`);

--
-- Constraints for table `telpon`
--
ALTER TABLE `telpon`
  ADD CONSTRAINT `telpon_ibfk_1` FOREIGN KEY (`KODE_KARYAWAN`) REFERENCES `data_karyawan` (`KODE_KARYAWAN`);
