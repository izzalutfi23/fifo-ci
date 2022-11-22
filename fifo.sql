-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 18, 2022 at 05:14 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fifo`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(5) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `suplier_id` int(5) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `c2` int(10) NOT NULL,
  `stok` int(10) NOT NULL,
  `umur` varchar(100) NOT NULL,
  `retur` varchar(100) NOT NULL,
  `harga` int(20) NOT NULL,
  `trx_id` int(5) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `suplier_id`, `barcode`, `nama`, `c2`, `stok`, `umur`, `retur`, `harga`, `trx_id`, `qty`) VALUES
(53, 'BRG-003', 3, '5678', 'Sepeda', 2, 8, '4', '4', 20000, 212, 8),
(51, 'BRG-001', 1, '12345', 'Sabun', 2, 22, '3', '3', 10000, 210, 14),
(52, 'BRG-002', 1, '54321', 'Sampo', 2, 21, '4', '4', 15000, 211, 15);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(5) NOT NULL,
  `barang_id` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` int(5) NOT NULL,
  `barang_id` int(5) NOT NULL,
  `pembelian_id` int(5) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id`, `barang_id`, `pembelian_id`, `faktur`, `jumlah`, `harga`, `status`) VALUES
(37, 51, 28, 'IN-00001', 3, 15000, '1'),
(38, 52, 28, 'IN-00001', 6, 17000, '1'),
(39, 51, 29, 'IN-00002', 5, 20000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `detail_keluar`
--

CREATE TABLE `detail_keluar` (
  `id` int(5) NOT NULL,
  `penjualan_id` int(5) NOT NULL,
  `barang_id` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `detail_keluar`
--

INSERT INTO `detail_keluar` (`id`, `penjualan_id`, `barang_id`, `jumlah`, `status`) VALUES
(9, 125, 51, 4, '1'),
(10, 126, 51, 2, '1'),
(11, 126, 52, 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(5) NOT NULL,
  `barang_id` int(5) NOT NULL,
  `jumlah` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(5) NOT NULL,
  `suplier_id` int(5) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `suplier_id`, `faktur`, `tgl`) VALUES
(28, 1, 'IN-00001', '2022-11-15'),
(29, 1, 'IN-00002', '2022-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(5) NOT NULL,
  `toko_id` int(5) NOT NULL,
  `faktur` varchar(50) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `toko_id`, `faktur`, `tgl`, `total`) VALUES
(126, 1, 'OUT-00002', '2022-11-17', 190000),
(125, 1, 'OUT-00001', '2022-11-17', 80000);

-- --------------------------------------------------------

--
-- Table structure for table `penyimpanan`
--

CREATE TABLE `penyimpanan` (
  `id` int(5) NOT NULL,
  `barang_id` int(5) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(10) NOT NULL,
  `rak` varchar(50) NOT NULL,
  `line` varchar(50) NOT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `id` int(5) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `hp` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id`, `kode`, `nama`, `alamat`, `email`, `hp`) VALUES
(1, 'S001', 'Teguh', 'Kendal', 'teguh@gmail.com', '09876543000'),
(3, 'SP-256353', 'Akbar', 'Semarang', 'akbar@gmail.com', '06543245');

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(5) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `kode`, `nama`, `alamat`, `telepon`, `email`) VALUES
(1, 'TK-001', 'Toko 1', 'Mlagen', '086787656765', 'toko1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(5) NOT NULL,
  `barang_id` int(5) NOT NULL,
  `penjualan_id` int(5) DEFAULT NULL,
  `faktur` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  `pembelian` text,
  `hpp` text,
  `saldo` text,
  `type` enum('pembelian','penjualan','awal') NOT NULL,
  `terpakai` enum('0','1') NOT NULL DEFAULT '0',
  `status_simpan` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `barang_id`, `penjualan_id`, `faktur`, `tgl`, `status`, `pembelian`, `hpp`, `saldo`, `type`, `terpakai`, `status_simpan`) VALUES
(218, 51, 125, 'OUT-00001', '2022-11-17', '0', NULL, '{\"jumlah\":\"4\",\"harga\":\"10000\"}', '{\"jumlah\":\"4\",\"harga\":\"10000\"}', 'penjualan', '0', '0'),
(217, 52, 126, 'OUT-00002', '2022-11-17', '0', NULL, '{\"jumlah\":\"5\",\"harga\":\"15000\"}', '{\"jumlah\":\"5\",\"harga\":\"15000\"}', 'penjualan', '0', '0'),
(216, 51, 126, 'OUT-00002', '2022-11-17', '0', NULL, '{\"jumlah\":\"2\",\"harga\":\"10000\"}', '{\"jumlah\":\"2\",\"harga\":\"10000\"}', 'penjualan', '0', '0'),
(215, 51, NULL, 'IN-00002', '2022-11-17', '0', '{\"jumlah\":\"5\",\"harga\":\"20000\"}', NULL, '{\"jumlah\":\"5\",\"harga\":\"20000\"}', 'pembelian', '0', '0'),
(210, 51, NULL, 'Awal-001', '2022-11-17', '0', NULL, NULL, '{\"jumlah\":\"20\",\"harga\":\"10000\"}', 'awal', '0', '0'),
(211, 52, NULL, 'Awal-001', '2022-11-17', '0', NULL, NULL, '{\"jumlah\":\"20\",\"harga\":\"15000\"}', 'awal', '0', '0'),
(212, 53, NULL, 'Awal-001', '2022-11-17', '0', NULL, NULL, '{\"jumlah\":\"8\",\"harga\":\"20000\"}', 'awal', '0', '0'),
(213, 51, NULL, 'IN-00001', '2022-11-17', '0', '{\"jumlah\":\"3\",\"harga\":\"15000\"}', NULL, '{\"jumlah\":\"3\",\"harga\":\"15000\"}', 'pembelian', '0', '0'),
(214, 52, NULL, 'IN-00001', '2022-11-17', '0', '{\"jumlah\":\"6\",\"harga\":\"17000\"}', NULL, '{\"jumlah\":\"6\",\"harga\":\"17000\"}', 'pembelian', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super-admin','admin','operator','manager') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role`) VALUES
(7, 'Operator', 'operator', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'operator'),
(3, 'Super Admin', 'super', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'super-admin'),
(6, 'Admin', 'admin', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'admin'),
(8, 'Manager', 'manager', '5ebe2294ecd0e0f08eab7690d2a6ee69', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_keluar`
--
ALTER TABLE `detail_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyimpanan`
--
ALTER TABLE `penyimpanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `detail_keluar`
--
ALTER TABLE `detail_keluar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `penyimpanan`
--
ALTER TABLE `penyimpanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
