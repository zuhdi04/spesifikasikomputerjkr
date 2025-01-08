-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 09:36 AM
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
  `id` int(10) UNSIGNED NOT NULL,
  `username` text NOT NULL,
  `area` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `area`, `password`) VALUES
(1, 'admin', '', '$2y$10$Es6fGXSs7Y9XdvFHZgyCUuq4Og5aX5fW6wkvpPLY.oFwtoF4KN2QS');

-- --------------------------------------------------------

--
-- Table structure for table `pc`
--

CREATE TABLE `pc` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_penuh` text NOT NULL,
  `bahagian_cawangan_daerah` text NOT NULL,
  `jawatan_gred` text NOT NULL,
  `jenis_kakitangan` text NOT NULL,
  `jenis_komputer` text NOT NULL,
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

INSERT INTO `pc` (`id`, `nama_penuh`, `bahagian_cawangan_daerah`, `jawatan_gred`, `jenis_kakitangan`, `jenis_komputer`, `umur_komputer`, `jenis_processor`, `saiz_ram`, `jenis_sistem`, `antivirus`, `ipv4_address`, `catatan`) VALUES
(1, 'a', '', '', 'PC NEGERI', '', '', '', '2', '', '', '', ''),
(2, 'b', '', '', 'PC NEGERI', '', '', ' ', '2', ' ', '', '', ''),
(3, 'Demo 1', '', '', 'PC PERSEKUTUAN', 'ASET', '6', ' ', '8', '32BIT', '', '172.27.20.98', ''),
(6, 'name', '', '', 'PC NEGERI', '', '', ' ', '2', ' ', '', '', ''),
(7, 'SIGMA', '', '', 'PC NEGERI', '', '', ' ', '2', ' ', '', '', ''),
(8, 'er', 'er', 'er', 'PC PERSEKUTUAN', 'er', '8', 'i5', '4', '64BIT', 'er', 'er', 'er'),
(10, 'gf', '', '', 'PC NEGERI', '', '', '', '2', '', '', '', ''),
(11, 'boy', '', '', 'PC NEGERI', '', '', '', '2', '', '', '', ''),
(12, 'rizz', '', '', 'PC NEGERI', '', '', '', '2', '', '', '', ''),
(24, 'sa', '', '', 'PC NEGERI', '', '', '', '2', '', '', '', ''),
(26, 'sad', '', '', 'PC NEGERI', '', '', '', '2', '', '', '', ''),
(27, 'man', '', '', 'PC PERSEKUTUAN', '', '', 'i5', '8', '32BIT', '', '', ''),
(28, 'jasmine', '', '', 'PC NEGERI', '', '', 'on', '8', '64BIT', '', '', ''),
(29, 'hary', '', '', 'PC NEGERI', '', '', 'i3', '4', '32BIT', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pc`
--
ALTER TABLE `pc`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pc`
--
ALTER TABLE `pc`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
