-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 07, 2022 at 06:08 PM
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
-- Database: `beny`
--

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
(1, 11, 'VICTORY'),
(2, 10.6301, 'VICTORY'),
(3, 13.5277, 'DEFEAT');

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
(1, 'Panitia', 'panitia', 'd32b1673837a6a45f795c13ea67ec79e'),
(2, 'Kepala Desa', 'kades', '0cfa66469d25bd0d9e55d7ba583f9f2f');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
