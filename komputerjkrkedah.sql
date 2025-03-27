-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2025 at 04:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `komputerjkrkedah`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(10) UNSIGNED NOT NULL,
  `unitID` int(10) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `password_encrypt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `unitID`, `status`, `username`, `password`, `password_encrypt`) VALUES
(0, NULL, 1, 'admin', '', '$2y$10$Es6fGXSs7Y9XdvFHZgyCUuq4Og5aX5fW6wkvpPLY.oFwtoF4KN2QS'),
(1, 1, 0, 'kulim', 'admin', '$2y$10$QInjfpLVOyZxc0c.$2y$10$UyVm7XTYQkvROisOqKDZj.omZa3egbOFg5qzMaCpZhV/H47ejWFK6'),
(2, 2, 0, 'pendang', 'admin', '$2y$10$QLsPI9Y8GzyQLBOUxPYrH.9ExU1oLk1UNha0qTRsfPiAsg1G1nJjW'),
(3, 3, 0, 'kewpen', 'admin', '$2y$10$3HZWJzCbVNIO3VIEMMBMdeIDbGVONR5gooQKawpp6ovj0v6vHhcCm');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE `pc` (
  `pcID` int(10) UNSIGNED NOT NULL,
  `unitID` int(10) UNSIGNED DEFAULT NULL,
  `nama_penuh` text NOT NULL,
  `jawatan_gred` text NOT NULL,
  `jenis_kakitangan` text NOT NULL,
  `jenis_komputer` text NOT NULL,
  `tarikhtamat` text NOT NULL,
  `umur_komputer` text NOT NULL,
  `jenis_processor` text NOT NULL,
  `saiz_ram` text NOT NULL,
  `jenis_sistem` text NOT NULL,
  `antivirus` text NOT NULL,
  `ipv4_address` text NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pc`
--

INSERT INTO `pc` (`pcID`, `unitID`, `nama_penuh`, `jawatan_gred`, `jenis_kakitangan`, `jenis_komputer`, `tarikhtamat`, `umur_komputer`, `jenis_processor`, `saiz_ram`, `jenis_sistem`, `antivirus`, `ipv4_address`, `catatan`) VALUES
(1, 2, 'a', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unitID` int(10) UNSIGNED NOT NULL,
  `nama` text NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unitID`, `nama`, `code`) VALUES
(1, 'KULIM', '67e36a1684'),
(2, 'PENDANG', '67e36afb84'),
(3, 'PENTADBIRAN DAN KEWANGAN', '67e3739fa3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD KEY `admin_FK` (`unitID`);

--
-- Indexes for table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`pcID`),
  ADD KEY `pc_FK` (`unitID`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unitID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pc`
--
ALTER TABLE `pc`
  MODIFY `pcID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unitID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_FK` FOREIGN KEY (`unitID`) REFERENCES `unit` (`unitID`) ON UPDATE CASCADE;

--
-- Constraints for table `pc`
--
ALTER TABLE `pc`
  ADD CONSTRAINT `pc_FK` FOREIGN KEY (`unitID`) REFERENCES `unit` (`unitID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
