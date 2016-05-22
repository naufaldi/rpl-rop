-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2015 at 06:58 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crud_oop`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE IF NOT EXISTS `bahan_baku` (
  `id_bah` int(50) NOT NULL AUTO_INCREMENT,
  `nama_bah` varchar(50) DEFAULT NULL,
  `harga_bah` varchar(70) DEFAULT NULL,
  `biaya_pesan_bah` varchar(70) DEFAULT NULL,
  `pemasok_bah` varchar(70) DEFAULT NULL,
  `stok_bah` int(50) DEFAULT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_bah`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bah`, `nama_bah`, `harga_bah`, `biaya_pesan_bah`, `pemasok_bah`, `stok_bah`, `tanggal_pesan`) VALUES
(6, 'Cat', '70000', '15000', 'PT Cat Indo', 500, '2015-12-10 05:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE IF NOT EXISTS `biodata` (
  `id_pro` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_pro` varchar(50) NOT NULL,
  `jumlah_pro` int(50) NOT NULL,
  `kodeproduk_pro` int(50) NOT NULL,
  `namaproduk_pro` varchar(150) NOT NULL,
  PRIMARY KEY (`id_pro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id_pro`, `tanggal_pro`, `jumlah_pro`, `kodeproduk_pro`, `namaproduk_pro`) VALUES
(11, '12-02-2015', 800, 15023, 'Meja');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `level`) VALUES
('admin', 'admin', 'admin'),
('petugas', 'petugas', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `reorderpoint`
--

CREATE TABLE IF NOT EXISTS `reorderpoint` (
  `id_rop` int(9) NOT NULL AUTO_INCREMENT,
  `leadtime` varchar(50) DEFAULT NULL,
  `safetystock` varchar(50) DEFAULT NULL,
  `averageusage` varchar(50) DEFAULT NULL,
  `reorderpoint` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rop`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `reorderpoint`
--

INSERT INTO `reorderpoint` (`id_rop`, `leadtime`, `safetystock`, `averageusage`, `reorderpoint`, `tanggal`) VALUES
(14, '89', '7777', '100', '786600', '2015-12-10 03:19:19'),
(18, '4', '5000', '5', '25020', '2015-12-10 02:14:55'),
(23, '898', '989', '889', '1677543', '2015-12-10 03:18:49');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
