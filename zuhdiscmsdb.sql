-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 04:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zuhdiscmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `username` text NOT NULL,
  `unitID` int(11) NOT NULL,
  `password` text NOT NULL,
  `password_encrypt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `status`, `username`, `unitID`, `password`, `password_encrypt`) VALUES
(1, 1, 'admin', 0, '', '$2y$10$Es6fGXSs7Y9XdvFHZgyCUuq4Og5aX5fW6wkvpPLY.oFwtoF4KN2QS'),
(2, 0, 'gama', 1, 'admin', '$2y$10$QInjfpLVOyZxc0c.JHVQ2OPJfQ0UhuZPFwUmMeV9cCyl2muFjp8q6'),
(5, 0, 'amin', 2, 'admin', '$2y$10$pZJsVNTkMKrgSEhpYH19q.qojwVPbOOxxv8SKz4Fxu8dylDuxtZ2e'),
(6, 0, 'mal', 3, 'admin', '$2y$10$U/B5Y5Jjtz9dydpf3NEvJOCFKmbMlZGzyoiwEJnsY6LUsye5BX.y6'),
(8, 0, 'fairuz', 1, 'admin', '$2y$10$fjbPwNIQTxr1Y0RO95IqHuZZzHiQKNGH.DfDYPlh7aeFF8.lLWfVe'),
(9, 0, 'dee', 1, 'admin', '$2y$10$iYSQaIyK8noVMKNMph4KS.XmZqcbgPGG8g0dmEBz9R4tfHOU52xUK');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE `pc` (
  `pcID` int(10) UNSIGNED NOT NULL,
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
  `catatan` text NOT NULL,
  `unitID` int(10) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pc`
--

-- INSERT INTO `pc` (`pcID`, `nama_penuh`, `jawatan_gred`, `jenis_kakitangan`, `jenis_komputer`, `umur_komputer`, `jenis_processor`, `saiz_ram`, `jenis_sistem`, `antivirus`, `ipv4_address`, `catatan`, `unitID`) VALUES
-- (1, 'a', '', 'PC PERSEKUTUAN', 'aset', '3', 'i5', '6', '64BIT', '', '', '', 3),
-- (3, 'Demo 1', '', 'PC PERSEKUTUAN', 'ASET', '6', ' ', '8', '32BIT', '', '172.27.20.98', '', 2),
-- (34, 'azmi', '', 'PC NEGERI', 'aset', '3', 'i3', '6', '64BIT', '', '255.255.255.1', '', 1),
-- (39, 'AIZA', '', 'PC PERSEKUTUAN', 'ASET', '1', 'i7', '6', '64BIT', '', '', '', 3),
-- (40, 'atalia', '', 'PC PERSEKUTUAN', 'aset', '2', 'i5', '6', '64BIT', '', '255.255.254.2', '', 1),
-- (42, 'YESRA', '', 'PC PERSEKUTUAN', 'PROJEK', '1', 'i7', '8', '64BIT', '', '99.9.54.8', '', 2),
-- (44, 'amzan', '', 'PC NEGERI', 'projek', '1', 'i5', '6', '64BIT', '', '', '', 1),
-- (45, 'hasnila', '', 'PC PERSEKUTUAN', 'projek', '5', 'i5', '4', '64BIT', '', '', '', 2),
-- (46, 'antonio', 'AK6', 'PC PERSEKUTUAN', 'aset', '1', 'i5', '6', '64BIT', '', '', '', 1),
-- (47, 'BELLA', 'G', 'PC NEGERI', 'ASET', '2', 'i3', '2', '64BIT', '', '', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unitID` int(11) NOT NULL,
  `nama` text NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit`
--

-- INSERT INTO `unit` (`id`, `nama`, `unitCode`) VALUES
-- (1, 'PENTADBIRAN DAN KEWANGAN', 'gysVJ'),
-- (2, 'ARKITEK', 'EUubk'),
-- (3, 'PENDANG', 'cpiXY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`pcID`),
  -- ADD KEY `pc_FK` (`unitID`);

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
  MODIFY `adminID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pc`
--
ALTER TABLE `pc`
  MODIFY `pcID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pc`
--
ALTER TABLE `pc`
  ADD CONSTRAINT `pc_FK` FOREIGN KEY (`unitID`) REFERENCES `unit` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
