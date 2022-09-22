-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 22, 2022 at 02:17 AM
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
(48, 'BRG-002', 1, '54321', 'Tempe', 2, 18, '2', '2', 7000, 205, 18),
(47, 'BRG-001', 1, '12345', 'Telur', 2, 17, '2', '2', 5000, 204, 15);

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
(33, 47, 25, 'IN-00001', 2, 5000, '1'),
(34, 47, 26, 'IN-00002', 5, 6000, '0'),
(35, 47, 27, 'IN-00003', 3, 10000, '0'),
(36, 48, 27, 'IN-00003', 5, 6000, '0');

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
(5, 122, 47, 3, '0'),
(6, 123, 47, 5, '1'),
(7, 124, 47, 2, '0'),
(8, 124, 48, 4, '0');

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
(25, 1, 'IN-00001', '2022-08-31'),
(26, 1, 'IN-00002', '2022-08-31'),
(27, 1, 'IN-00003', '2022-09-21');

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
(124, 1, 'OUT-00003', '2022-09-21', 76000),
(123, 1, 'OUT-00002', '2022-08-31', 50000),
(122, 1, 'OUT-00001', '2022-08-31', 30000);

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
(204, 47, NULL, 'Awal-001', '2022-08-26', '0', NULL, NULL, '{\"jumlah\":\"20\",\"harga\":\"5000\"}', 'awal', '0', '0'),
(205, 48, NULL, 'Awal-001', '2022-08-26', '0', NULL, NULL, '{\"jumlah\":\"18\",\"harga\":\"7000\"}', 'awal', '0', '0'),
(206, 49, NULL, 'Awal-001', '2022-08-31', '0', NULL, NULL, '{\"jumlah\":\"3\",\"harga\":\"3\"}', 'awal', '0', '0'),
(207, 47, NULL, 'IN-00001', '2022-08-31', '0', '{\"jumlah\":\"2\",\"harga\":\"5000\"}', NULL, '{\"jumlah\":\"2\",\"harga\":\"5000\"}', 'pembelian', '0', '0'),
(208, 47, 123, 'OUT-00002', '2022-08-31', '0', NULL, '{\"jumlah\":\"5\",\"harga\":\"5000\"}', '{\"jumlah\":\"5\",\"harga\":\"5000\"}', 'penjualan', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(1, 'Panitia A', 'panitia', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'Kepala Desa', 'admin', '21232f297a57a5a743894a0e4a801fc3');

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `detail_keluar`
--
ALTER TABLE `detail_keluar`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `penyimpanan`
--
ALTER TABLE `penyimpanan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
