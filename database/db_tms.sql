-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2020 at 03:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `class`, `birthdate`, `email`, `phone`) VALUES
('C030318077', 'M. Iqbal Effendi', '5C', '2000-04-21', 'iqbaleff214@gmail.com', '082153342175');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` varchar(15) NOT NULL,
  `toolbox` varchar(15) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `manufacture` varchar(255) NOT NULL,
  `material` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL,
  `type` varchar(255) NOT NULL,
  `unit` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `toolbox`, `description`, `manufacture`, `material`, `status`, `type`, `unit`) VALUES
('9012345675', '0123456787', 'TUF Gaming F15', 'ASUSTeK Computer Inc.', 'Intel Core i9 8?core 2,3 GHz, Turbo Boost hingga 4,8 GHz, dengan cache L3 bersama sebesar 16 MB', 'Available', 'Laptop', 'pcs'),
('9012345677', '0123456787', 'TUF Gaming FX505DD/DT/DU', 'ASUSTeK Computer Inc.', 'AMD® Ryzen™ 7 3750H Processor, DDR4 2400MHz SDRAM, 2 x SO-DIMM socket for expansion, total up to 32 GB SDRAM, Dual-channel, NVIDIA® GeForce® GTX 1050, with 3GB GDDR5 VRAM', 'Available', 'Laptop', 'pcs'),
('9012345678', NULL, 'PRIME A520M-A', 'ASUSTeK Computer Inc.', 'ads', 'Available', 'Laptop', 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `toolbox`
--

CREATE TABLE `toolbox` (
  `id` varchar(15) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `status` varchar(15) NOT NULL DEFAULT '',
  `note` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toolbox`
--

INSERT INTO `toolbox` (`id`, `description`, `status`, `note`) VALUES
('0123456787', 'TUF Gaming Collection', 'Available', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `employee` varchar(15) NOT NULL,
  `equipment` varchar(15) NOT NULL,
  `booking_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `employee`, `equipment`, `booking_date`, `return_date`, `status`) VALUES
(9, 'C030318077', '9012345675', '2020-09-22', '2020-09-22', 'Good'),
(10, 'C030318077', '9012345678', '2020-09-22', '2020-09-22', 'Good'),
(11, 'C030318077', '9012345675', '2020-09-23', '2020-09-23', 'Good'),
(12, 'C030318077', '9012345677', '2020-09-23', '2020-09-23', 'Good'),
(13, 'C030318077', '9012345678', '2020-09-23', '2020-09-23', 'Good'),
(14, 'C030318077', '9012345675', '2020-09-23', '2020-09-23', 'Good'),
(15, 'C030318077', '9012345677', '2020-09-23', '2020-09-23', 'Good');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toolbox`
--
ALTER TABLE `toolbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
