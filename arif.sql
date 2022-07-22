-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 22, 2022 at 01:16 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arif`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `c2` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `umur` varchar(100) NOT NULL,
  `retur` varchar(100) NOT NULL,
  `harga` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `barcode`, `nama`, `c2`, `stok`, `umur`, `retur`, `harga`) VALUES
(1, 'P001', '23456789', 'Sabun Mandi', 32456, 20, '20', '10', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

DROP TABLE IF EXISTS `keranjang`;
CREATE TABLE IF NOT EXISTS `keranjang` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `barang_id` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `barang_id`, `jumlah`) VALUES
(1, 1, 5),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `faktur` varchar(50) NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `faktur`, `pelanggan`, `tgl`, `total`) VALUES
(2, 'IN-00001', 'Pelanggan A', '2022-07-22', 140000),
(3, 'IN-00002', 'Pelanggan B', '2022-07-22', 140000);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  `result` enum('VICTORY','DEFEAT') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `amount`, `result`) VALUES
(1, 41.2553, 'VICTORY'),
(2, 41.2553, 'VICTORY'),
(3, 32.0624, 'DEFEAT');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

DROP TABLE IF EXISTS `suplier`;
CREATE TABLE IF NOT EXISTS `suplier` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `hp` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `kode`, `nama`, `alamat`, `email`, `hp`) VALUES
(1, 'S001', 'Teguh', 'Kendal', 'teguh@gmail.com', '09876543000');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

DROP TABLE IF EXISTS `train`;
CREATE TABLE IF NOT EXISTS `train` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kill` int(10) NOT NULL,
  `assist` int(10) NOT NULL,
  `kd` int(10) NOT NULL,
  `senjata` enum('M416','AKM','UMP','SCARL') NOT NULL,
  `score` int(10) NOT NULL,
  `result` enum('VICTORY','DEFEAT') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`id`, `kill`, `assist`, `kd`, `senjata`, `score`, `result`) VALUES
(11, 14, 4, 2, 'M416', 40, 'VICTORY'),
(12, 13, 6, 1, 'M416', 40, 'VICTORY'),
(13, 12, 4, 1, 'M416', 31, 'DEFEAT');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `barang_id` int(5) NOT NULL,
  `suplier_id` int(5) DEFAULT NULL,
  `penjualan_id` int(5) DEFAULT NULL,
  `tgl` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  `pembelian` text,
  `hpp` text,
  `saldo` text,
  `type` enum('pembelian','penjualan') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `barang_id`, `suplier_id`, `penjualan_id`, `tgl`, `status`, `pembelian`, `hpp`, `saldo`, `type`) VALUES
(1, 1, 1, NULL, '2022-07-17', '1', '{\"jumlah\":\"10\",\"satuan\":\"Pcs\",\"harga\":\"10000\"}', NULL, NULL, 'pembelian'),
(2, 1, 1, NULL, '2022-07-17', '0', '{\"jumlah\":\"3\",\"satuan\":\"Dus\",\"harga\":\"130000\"}', NULL, NULL, 'pembelian');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Panitia A', 'panitia', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Kepala Desa', 'kades', '21232f297a57a5a743894a0e4a801fc3');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
