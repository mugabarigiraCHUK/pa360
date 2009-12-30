-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 30, 2009 at 07:56 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ta360`
--

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

DROP TABLE IF EXISTS `alamat`;
CREATE TABLE IF NOT EXISTS `alamat` (
  `ID_ALAMAT` varchar(10) NOT NULL,
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `NAMA_ALAMAT` varchar(100) DEFAULT NULL,
  `KODE_POS` int(11) DEFAULT NULL,
  `KODE_AREA` int(11) DEFAULT NULL,
  `KOTA` varchar(30) DEFAULT NULL,
  `PROPINSI` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_ALAMAT`,`KODE_KARYAWAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`ID_ALAMAT`, `KODE_KARYAWAN`, `NAMA_ALAMAT`, `KODE_POS`, `KODE_AREA`, `KOTA`, `PROPINSI`) VALUES
('1', 'MUSA', 'sss', 232, 0, '', ''),
('2', 'indra', 'xxxx', 0, 0, '', ''),
('1', 'indra', 'dddd', 0, 0, '', ''),
('1', '002', 'jl. sumatra 23 surabaya', 60342, 34, 'surabaya', 'jatim');

-- --------------------------------------------------------

--
-- Table structure for table `bobot_level`
--

DROP TABLE IF EXISTS `bobot_level`;
CREATE TABLE IF NOT EXISTS `bobot_level` (
  `ID_PERIODE` varchar(10) NOT NULL,
  `ID_LEVEL` varchar(10) NOT NULL,
  `NAMA_LEVEL` varchar(50) DEFAULT NULL,
  `DESKRIPSI` varchar(50) NOT NULL,
  `BOBOT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_PERIODE`,`ID_LEVEL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_level`
--

INSERT INTO `bobot_level` (`ID_PERIODE`, `ID_LEVEL`, `NAMA_LEVEL`, `DESKRIPSI`, `BOBOT`) VALUES
('PE1', 'HZ2', 'Horizontal 2', '', 33),
('PE1', 'HZ3', 'Horizontal 3', '', 33),
('PE2', 'HZ4', 'Horizontal 4', '', 20),
('PE1', 'VC2', 'Vertical 2', 'sadsadasd', 33),
('PE2', 'VC3', 'Vertical 3', '', 20),
('PE1', 'VC1', 'Vertical 1', '', 33),
('PE2', 'HZ3', 'Horizontal 3', '', 20),
('PE2', 'VC1', 'Vertical 1', '', 20),
('PE2', 'HZ1', 'Horizontal 1', '', 20),
('PE1', 'HZ1', 'Horizontal 1', 'sadsad', 33),
('PE2', 'HZ2', 'Horizontal 2', '', 20),
('PE2', 'VC2', 'Vertical 2', '', 20),
('PE1', 'VC3', 'Vertical 3', '', 33),
('PE2', 'VC4', 'Vertical 4', '', 20),
('PE2', 'HZ5', 'Horizontal 5', '', 20),
('PE2', 'VC5', 'Vertical 5', '', 20);

-- --------------------------------------------------------

--
-- Table structure for table `data_department`
--

DROP TABLE IF EXISTS `data_department`;
CREATE TABLE IF NOT EXISTS `data_department` (
  `ID_DEPARTMENT` varchar(10) NOT NULL,
  `NAMA_DEPARTMENT` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_DEPARTMENT`),
  UNIQUE KEY `STOR_81_PK` (`ID_DEPARTMENT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_department`
--

INSERT INTO `data_department` (`ID_DEPARTMENT`, `NAMA_DEPARTMENT`) VALUES
('342', 'HRD'),
('252', 'INVENTORY'),
('123', 'KEUANGAN');

-- --------------------------------------------------------

--
-- Table structure for table `data_divisi`
--

DROP TABLE IF EXISTS `data_divisi`;
CREATE TABLE IF NOT EXISTS `data_divisi` (
  `ID_DIVISI` varchar(10) NOT NULL,
  `NAMA_DIVISI` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_DIVISI`),
  UNIQUE KEY `STOR_82_PK` (`ID_DIVISI`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_divisi`
--

INSERT INTO `data_divisi` (`ID_DIVISI`, `NAMA_DIVISI`) VALUES
('23', 'KEBAKARAN'),
('12321', 'sdsadsa'),
('asdxc2', '21sads'),
('adsad', 'asds sadas');

-- --------------------------------------------------------

--
-- Table structure for table `data_golongan`
--

DROP TABLE IF EXISTS `data_golongan`;
CREATE TABLE IF NOT EXISTS `data_golongan` (
  `ID_GOLONGAN` varchar(10) NOT NULL,
  `NAMA_GOLONGAN` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_GOLONGAN`),
  UNIQUE KEY `STOR_83_PK` (`ID_GOLONGAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_golongan`
--

INSERT INTO `data_golongan` (`ID_GOLONGAN`, `NAMA_GOLONGAN`) VALUES
('23', 'A1'),
('dsfg', 'A2'),
('656', 'B1');

-- --------------------------------------------------------

--
-- Table structure for table `data_jabatan`
--

DROP TABLE IF EXISTS `data_jabatan`;
CREATE TABLE IF NOT EXISTS `data_jabatan` (
  `ID_JABATAN` varchar(10) NOT NULL,
  `NAMA_JABATAN` varchar(50) DEFAULT NULL,
  `LEVEL_JABATAN` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID_JABATAN`),
  UNIQUE KEY `STOR_84_PK` (`ID_JABATAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_jabatan`
--

INSERT INTO `data_jabatan` (`ID_JABATAN`, `NAMA_JABATAN`, `LEVEL_JABATAN`) VALUES
('cxzc', 'MENTRI KETENAGAKERJAAN', '1.1'),
('cvxewr3', 'KEPALA GUDANG', '2.2'),
('23232ds', 'KEPALA PENJUALAN', '2.1'),
('zcxzew32', 'sadsax', '2.3');

-- --------------------------------------------------------

--
-- Table structure for table `data_karyawan`
--

DROP TABLE IF EXISTS `data_karyawan`;
CREATE TABLE IF NOT EXISTS `data_karyawan` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `NAMA_KARYAWAN` varchar(50) DEFAULT NULL,
  `TEMPAT_LAHIR` varchar(50) DEFAULT NULL,
  `TANGGAL_LAHIR` date DEFAULT NULL,
  `JENIS_KELAMIN` int(11) DEFAULT NULL,
  `GOLONGAN_DARAH` varchar(5) DEFAULT NULL,
  `STATUS` varchar(30) DEFAULT NULL,
  `AGAMA` varchar(50) DEFAULT NULL,
  `EMAIL` varchar(30) DEFAULT NULL,
  `TANGGAL_MASUK` date DEFAULT NULL,
  `TANGGAL_KELUAR` date DEFAULT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`),
  UNIQUE KEY `STOR_80_PK` (`KODE_KARYAWAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_karyawan`
--

INSERT INTO `data_karyawan` (`KODE_KARYAWAN`, `NAMA_KARYAWAN`, `TEMPAT_LAHIR`, `TANGGAL_LAHIR`, `JENIS_KELAMIN`, `GOLONGAN_DARAH`, `STATUS`, `AGAMA`, `EMAIL`, `TANGGAL_MASUK`, `TANGGAL_KELUAR`) VALUES
('MUSA', 'MUSA', 'SURABAYA', '0000-00-00', 0, 'A', 'BK', 'B', 'sad@.asdsd', '2009-12-16', '0000-00-00'),
('indra', 'eko cahyono', '', '2009-12-20', 0, 'A', 'BK', 'B', 'asdsd@sad.jk', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

DROP TABLE IF EXISTS `data_user`;
CREATE TABLE IF NOT EXISTS `data_user` (
  `user_nama` varchar(10) NOT NULL,
  `user_password` varchar(50) NOT NULL COMMENT 'pake md5',
  `user_tipe` int(11) NOT NULL COMMENT '1=administrator, 2=user biasa',
  PRIMARY KEY (`user_nama`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`user_nama`, `user_password`, `user_tipe`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dep_divisi_jabatan`
--

DROP TABLE IF EXISTS `dep_divisi_jabatan`;
CREATE TABLE IF NOT EXISTS `dep_divisi_jabatan` (
  `ID_DEP_DIV_JAB` varchar(25) NOT NULL,
  `ID_JABATAN` varchar(10) NOT NULL,
  `ID_DIVISI` varchar(10) NOT NULL,
  `ID_DEPARTMENT` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_DEP_DIV_JAB`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dep_divisi_jabatan`
--

INSERT INTO `dep_divisi_jabatan` (`ID_DEP_DIV_JAB`, `ID_JABATAN`, `ID_DIVISI`, `ID_DEPARTMENT`) VALUES
('0.68984300', 'zcxzew32', 'asdxc2', '252'),
('0.56439600', 'zcxzew32', 'asdxc2', '252'),
('0.31542100', 'cxzc', '23', '252'),
('0.68946300', 'cxzc', '23', '252'),
('0.84582500', 'zcxzew32', '23', '342'),
('0.15848400', 'zcxzew32', '23', '342'),
('0.05029100', 'zcxzew32', '23', '342'),
('0.25248900', 'zcxzew32', '23', '342'),
('0.00242600', '23232ds', '12321', '342'),
('0.71875800 1262156259', 'cxzc', 'asdxc2', '342'),
('0.73438300 1262155511', 'cxzc', 'adsad', '252'),
('0.15861200 1262154152', '23232ds', '12321', '342'),
('0.03511400 1262155189', '23232ds', '12321', '342'),
('0.50289100 1262155189', '23232ds', '12321', '342'),
('0.45548300 1262155207', '23232ds', '12321', '342'),
('0.50228900 1262155475', '23232ds', '12321', '342'),
('0.73624500 1262155511', '23232ds', '12321', '342'),
('0.23767400 1262156216', '23232ds', '12321', '252'),
('0.23652500 1262156234', '23232ds', '12321', '252'),
('0.72130400 1262156259', '23232ds', '12321', '252'),
('0.72357100 1262156259', 'zcxzew32', 'asdxc2', '123');

-- --------------------------------------------------------

--
-- Table structure for table `deskripsi_bobot`
--

DROP TABLE IF EXISTS `deskripsi_bobot`;
CREATE TABLE IF NOT EXISTS `deskripsi_bobot` (
  `NILAI` int(11) NOT NULL,
  `ID_DETAIL_KRITERIA` varchar(10) NOT NULL,
  `DESKRIPSI` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`NILAI`,`ID_DETAIL_KRITERIA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deskripsi_bobot`
--

INSERT INTO `deskripsi_bobot` (`NILAI`, `ID_DETAIL_KRITERIA`, `DESKRIPSI`) VALUES
(4, '123', '----'),
(8, '2scxzcx', '---'),
(2, '23xawg', 'as a ds sas as a'),
(1, '23xawg', 'asd asd 12sd '),
(10, '23xawg', ' dasd 3 '),
(7, '1222', 'ds fsd fd '),
(4, '1222', 'd sad sad sads '),
(8, 'em', '132159419'),
(6, '12', 'asdsa dsa '),
(5, '1222', 'ffffffffff'),
(1, '1232xxx', 'asdsad');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kriteria`
--

DROP TABLE IF EXISTS `detail_kriteria`;
CREATE TABLE IF NOT EXISTS `detail_kriteria` (
  `ID_DETAIL_KRITERIA` varchar(10) NOT NULL,
  `ID_KRITERIA` varchar(10) DEFAULT NULL,
  `NAMA_DETAIL_KRITERIA` varchar(50) DEFAULT NULL,
  `DESKRIPSI` varchar(100) DEFAULT NULL,
  `BOBOT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_DETAIL_KRITERIA`),
  UNIQUE KEY `STOR_393_PK` (`ID_DETAIL_KRITERIA`),
  KEY `RELATION_119_FK` (`ID_KRITERIA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_kriteria`
--

INSERT INTO `detail_kriteria` (`ID_DETAIL_KRITERIA`, `ID_KRITERIA`, `NAMA_DETAIL_KRITERIA`, `DESKRIPSI`, `BOBOT`) VALUES
('23xawg', 'asd', 'Hard Skill', 'asdsadsad', 6),
('em', 'sd', 'Gotong Royong', 'sudah hilang rasa gotong royong', 26),
('1222', 'sd', 'Sof Skill', 'sofware', 26),
('2scxzcx', 'asd', 'Team Work', 'Kemampuan kerja sama', 25),
('123', 'asd', 'Soft Skill', 'asdasdsa sa ', 23),
('321', 'sd', 'sdsadsad', 'sadsads', 6),
('1232xxx', 'sd', '12321', 'aasdsad', 10),
('12', 'sd', 'sad', 'asdsad', 30);

-- --------------------------------------------------------

--
-- Table structure for table `detil_bobot_level`
--

DROP TABLE IF EXISTS `detil_bobot_level`;
CREATE TABLE IF NOT EXISTS `detil_bobot_level` (
  `ID_PERIODE` varchar(10) NOT NULL,
  `ID_LEVEL` varchar(10) NOT NULL,
  `ID_KRITERIA` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_PERIODE`,`ID_LEVEL`,`ID_KRITERIA`),
  KEY `FK_REF_11229` (`ID_KRITERIA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_bobot_level`
--

INSERT INTO `detil_bobot_level` (`ID_PERIODE`, `ID_LEVEL`, `ID_KRITERIA`) VALUES
('PE1', 'HZ1', 'asd'),
('PE1', 'HZ1', 'sd'),
('PE1', 'HZ2', 'asd'),
('PE1', 'HZ2', 'sd'),
('PE1', 'HZ3', 'asd'),
('PE1', 'HZ3', 'sd'),
('PE1', 'VC1', 'asd'),
('PE1', 'VC1', 'sd'),
('PE1', 'VC2', 'asd'),
('PE1', 'VC2', 'sd'),
('PE1', 'VC3', 'asd'),
('PE1', 'VC3', 'sd'),
('PE2', 'HZ1', 'asd'),
('PE2', 'HZ1', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `detil_status_karyawan`
--

DROP TABLE IF EXISTS `detil_status_karyawan`;
CREATE TABLE IF NOT EXISTS `detil_status_karyawan` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `ID_STATUS_KARYAWAN` varchar(10) NOT NULL,
  `TGL_UPDATE_STATUS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`KODE_KARYAWAN`,`ID_STATUS_KARYAWAN`,`TGL_UPDATE_STATUS`),
  KEY `FK_REF_10792` (`ID_STATUS_KARYAWAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detil_status_karyawan`
--

INSERT INTO `detil_status_karyawan` (`KODE_KARYAWAN`, `ID_STATUS_KARYAWAN`, `TGL_UPDATE_STATUS`) VALUES
('001', 'asdsa', '2009-12-30 16:20:41'),
('indra', '12', '2009-12-29 15:35:21'),
('indra', 'asdsa', '2009-12-29 15:35:26'),
('MUSA', '12', '2009-12-29 17:59:20'),
('MUSA', '2131', '2009-12-29 15:35:30'),
('MUSA', 'asdsa', '2009-12-29 17:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_penilaian`
--

DROP TABLE IF EXISTS `kriteria_penilaian`;
CREATE TABLE IF NOT EXISTS `kriteria_penilaian` (
  `ID_KRITERIA` varchar(10) NOT NULL,
  `NAMA_KRITERIA` varchar(50) DEFAULT NULL,
  `DESKRIPSI` varchar(100) DEFAULT NULL,
  `BOBOT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_KRITERIA`),
  UNIQUE KEY `STOR_395_PK` (`ID_KRITERIA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria_penilaian`
--

INSERT INTO `kriteria_penilaian` (`ID_KRITERIA`, `NAMA_KRITERIA`, `DESKRIPSI`, `BOBOT`) VALUES
('asd', 'Intelligence', 'ke tololan', 45),
('sd', 'Empathy', 'toleransi', 55);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_akhir`
--

DROP TABLE IF EXISTS `nilai_akhir`;
CREATE TABLE IF NOT EXISTS `nilai_akhir` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `ID_PERIODE` varchar(10) NOT NULL,
  `NILAI_AKHIR` double DEFAULT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`ID_PERIODE`),
  UNIQUE KEY `RELATION_298_PK` (`KODE_KARYAWAN`,`ID_PERIODE`),
  KEY `RELATION_298_FK2` (`KODE_KARYAWAN`),
  KEY `RELATION_298_FK` (`ID_PERIODE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_akhir`
--


-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_kinerja`
--

DROP TABLE IF EXISTS `nilai_per_kinerja`;
CREATE TABLE IF NOT EXISTS `nilai_per_kinerja` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `PENILAI` varchar(10) NOT NULL,
  `ID_PERIODE` varchar(10) NOT NULL,
  `ID_DEP_DIV_JAB` varchar(25) NOT NULL,
  `ID_DETAIL_KRITERIA` varchar(10) NOT NULL,
  `NILAI` double DEFAULT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`PENILAI`,`ID_PERIODE`,`ID_DEP_DIV_JAB`,`ID_DETAIL_KRITERIA`),
  UNIQUE KEY `RELATION_201_PK` (`KODE_KARYAWAN`,`ID_DETAIL_KRITERIA`),
  KEY `RELATION_201_FK2` (`KODE_KARYAWAN`),
  KEY `RELATION_201_FK` (`ID_DETAIL_KRITERIA`),
  KEY `FK_REF_11432` (`ID_PERIODE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_per_kinerja`
--


-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_kriteria`
--

DROP TABLE IF EXISTS `nilai_per_kriteria`;
CREATE TABLE IF NOT EXISTS `nilai_per_kriteria` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `PENILAI` varchar(10) NOT NULL,
  `ID_PERIODE` varchar(10) NOT NULL,
  `ID_DEP_DIV_JAB` varchar(25) NOT NULL,
  `ID_KRITERIA` varchar(10) NOT NULL,
  `ID_LEVEL` varchar(10) NOT NULL,
  `NILAI` double DEFAULT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`PENILAI`,`ID_PERIODE`,`ID_DEP_DIV_JAB`,`ID_KRITERIA`,`ID_LEVEL`),
  UNIQUE KEY `RELATION_202_PK` (`KODE_KARYAWAN`,`ID_KRITERIA`),
  KEY `RELATION_202_FK2` (`KODE_KARYAWAN`),
  KEY `RELATION_202_FK` (`ID_KRITERIA`),
  KEY `FK_REF_11429` (`ID_PERIODE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_per_kriteria`
--


-- --------------------------------------------------------

--
-- Table structure for table `nilai_per_penilai`
--

DROP TABLE IF EXISTS `nilai_per_penilai`;
CREATE TABLE IF NOT EXISTS `nilai_per_penilai` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `PENILAI` varchar(10) NOT NULL,
  `ID_PERIODE` varchar(10) NOT NULL,
  `ID_DEP_DIV_JAB` varchar(25) NOT NULL,
  `ID_NILAI_PER_PENILAI` varchar(25) NOT NULL,
  `ID_LEVEL` varchar(10) NOT NULL,
  `NILAI` double DEFAULT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`PENILAI`,`ID_PERIODE`,`ID_DEP_DIV_JAB`,`ID_NILAI_PER_PENILAI`,`ID_LEVEL`),
  KEY `FK_REF_11209` (`ID_PERIODE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai_per_penilai`
--

INSERT INTO `nilai_per_penilai` (`KODE_KARYAWAN`, `PENILAI`, `ID_PERIODE`, `ID_DEP_DIV_JAB`, `ID_NILAI_PER_PENILAI`, `ID_LEVEL`, `NILAI`) VALUES
('MUSA', 'indra', 'PE1', '0.73438300 1262155511', '0.60938300 1262159037', 'VC1', 0),
('MUSA', 'indra', 'PE1', '0.73438300 1262155511', '0.45684600 1262161794', 'VC2', 0),
('MUSA', 'indra', 'PE1', '0.73438300 1262155511', '0.19122100 1262161810', 'VC3', 0),
('MUSA', 'indra', 'PE1', '0.73438300 1262155511', '0.61309600 1262161838', 'HZ1', 0),
('MUSA', 'indra', 'PE1', '0.73438300 1262155511', '0.78497100 1262161847', 'HZ2', 0),
('MUSA', 'indra', 'PE1', '0.73438300 1262155511', '0.80059600 1262161855', 'HZ3', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penilai`
--

DROP TABLE IF EXISTS `penilai`;
CREATE TABLE IF NOT EXISTS `penilai` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `ID_PERIODE` varchar(10) NOT NULL,
  `ID_DEP_DIV_JAB` varchar(25) NOT NULL,
  `ID_LEVEL` varchar(10) NOT NULL,
  `STATUS_PENILAIAN` varchar(10) NOT NULL COMMENT 'vertical atau horizontal',
  PRIMARY KEY (`KODE_KARYAWAN`,`ID_PERIODE`,`ID_DEP_DIV_JAB`,`ID_LEVEL`),
  KEY `RELATION_204_FK2` (`KODE_KARYAWAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilai`
--

INSERT INTO `penilai` (`KODE_KARYAWAN`, `ID_PERIODE`, `ID_DEP_DIV_JAB`, `ID_LEVEL`, `STATUS_PENILAIAN`) VALUES
('indra', 'PE1', '0.72130400 1262156259', 'VC1', 'VC'),
('indra', 'PE1', '0.72357100 1262156259', 'VC2', 'VC'),
('indra', 'PE1', '0.72357100 1262156259', 'VC3', 'VC'),
('indra', 'PE1', '0.71875800 1262156259', 'HZ1', 'HZ'),
('indra', 'PE1', '0.71875800 1262156259', 'HZ2', 'HZ'),
('indra', 'PE1', '0.71875800 1262156259', 'HZ3', 'HZ'),
('MUSA', 'PE1', '0.73624500 1262155511', 'VC1', 'VC'),
('MUSA', 'PE1', '0.73624500 1262155511', 'VC2', 'VC'),
('MUSA', 'PE1', '0.73624500 1262155511', 'VC3', 'VC');

-- --------------------------------------------------------

--
-- Table structure for table `relasi_div_jab_din`
--

DROP TABLE IF EXISTS `relasi_div_jab_din`;
CREATE TABLE IF NOT EXISTS `relasi_div_jab_din` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `TANGGAL_MENJABAT` date DEFAULT NULL,
  `TANGGAL_BERHENTI` date DEFAULT NULL,
  `ID_DEP_DIV_JAB` varchar(25) NOT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`ID_DEP_DIV_JAB`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi_div_jab_din`
--

INSERT INTO `relasi_div_jab_din` (`KODE_KARYAWAN`, `TANGGAL_MENJABAT`, `TANGGAL_BERHENTI`, `ID_DEP_DIV_JAB`) VALUES
('MUSA', '0000-00-00', '0000-00-00', '0.73624500 1262155511'),
('indra', '0000-00-00', '0000-00-00', '0.71875800 1262156259'),
('MUSA', '0000-00-00', '0000-00-00', '0.73438300 1262155511'),
('indra', '0000-00-00', '0000-00-00', '0.72130400 1262156259'),
('indra', '0000-00-00', '0000-00-00', '0.72357100 1262156259');

-- --------------------------------------------------------

--
-- Table structure for table `relasi_golongan`
--

DROP TABLE IF EXISTS `relasi_golongan`;
CREATE TABLE IF NOT EXISTS `relasi_golongan` (
  `ID_GOLONGAN` varchar(10) NOT NULL,
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `TANGGAL_MENJABAT` date DEFAULT NULL,
  `TANGGAL_BERHENTI` date DEFAULT NULL,
  PRIMARY KEY (`ID_GOLONGAN`,`KODE_KARYAWAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relasi_golongan`
--

INSERT INTO `relasi_golongan` (`ID_GOLONGAN`, `KODE_KARYAWAN`, `TANGGAL_MENJABAT`, `TANGGAL_BERHENTI`) VALUES
('23', 'indra', '0000-00-00', '0000-00-00'),
('656', 'MUSA', '2009-12-31', '0000-00-00'),
('dsfg', 'indra', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `setting_periode`
--

DROP TABLE IF EXISTS `setting_periode`;
CREATE TABLE IF NOT EXISTS `setting_periode` (
  `ID_PERIODE` varchar(10) NOT NULL,
  `PERIODE_AWAL` date DEFAULT NULL,
  `PERIODE_AKHIR` date DEFAULT NULL,
  `BOBOT_VERTIKAL` int(11) DEFAULT NULL,
  `BOBOT_HORIZONTAL` int(11) DEFAULT NULL,
  `LEVEL_VERTIKAL` int(11) DEFAULT NULL,
  `LEVEL_HORIZONTAL` int(11) DEFAULT NULL,
  `BATAS_AWAL_PENILAIAN` date DEFAULT NULL,
  `BATAS_AKHIR_PENILAIAN` date DEFAULT NULL,
  PRIMARY KEY (`ID_PERIODE`),
  UNIQUE KEY `STOR_1445_PK` (`ID_PERIODE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting_periode`
--

INSERT INTO `setting_periode` (`ID_PERIODE`, `PERIODE_AWAL`, `PERIODE_AKHIR`, `BOBOT_VERTIKAL`, `BOBOT_HORIZONTAL`, `LEVEL_VERTIKAL`, `LEVEL_HORIZONTAL`, `BATAS_AWAL_PENILAIAN`, `BATAS_AKHIR_PENILAIAN`) VALUES
('PE1', '2009-01-01', '2009-12-31', 50, 50, 3, 3, '2009-01-10', '2009-12-31'),
('PE2', '2009-07-01', '2009-12-31', 50, 50, 5, 5, '2009-07-01', '2009-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `status_karyawan`
--

DROP TABLE IF EXISTS `status_karyawan`;
CREATE TABLE IF NOT EXISTS `status_karyawan` (
  `ID_STATUS_KARYAWAN` varchar(10) NOT NULL,
  `NAMA_STATUS` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_STATUS_KARYAWAN`),
  UNIQUE KEY `STATUS_KARYAWAN_PK` (`ID_STATUS_KARYAWAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_karyawan`
--

INSERT INTO `status_karyawan` (`ID_STATUS_KARYAWAN`, `NAMA_STATUS`) VALUES
('asdsa', 'Aktif'),
('12', 'Cuti'),
('2131', 'Non Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `telpon`
--

DROP TABLE IF EXISTS `telpon`;
CREATE TABLE IF NOT EXISTS `telpon` (
  `KODE_KARYAWAN` varchar(10) NOT NULL,
  `NO_TELPON` varchar(20) NOT NULL,
  PRIMARY KEY (`KODE_KARYAWAN`,`NO_TELPON`),
  UNIQUE KEY `TELPON_PK` (`NO_TELPON`),
  KEY `RELATION_220_FK` (`KODE_KARYAWAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telpon`
--

INSERT INTO `telpon` (`KODE_KARYAWAN`, `NO_TELPON`) VALUES
('indra', '111'),
('indra', '2222'),
('MUSA', '123'),
('MUSA', '23');
