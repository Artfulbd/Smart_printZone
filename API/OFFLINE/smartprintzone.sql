-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 08:32 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartprintzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `printdata`
--

CREATE TABLE `printdata` (
  `nsuId` int(11) DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `page` int(11) NOT NULL DEFAULT 1,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printdata`
--

INSERT INTO `printdata` (`nsuId`, `fileName`, `page`, `available`) VALUES
(1721277041, '1721277041_Lec.txt', 1, 1),
(1721277042, '1721277042_Lec.txt', 1, 1),
(1721277043, '1721277043_Lec.txt', 1, 1),
(1721277059, '1721277059_Lec.docx', 1, 1),
(1721277042, '1721277042_New Text Document.txt', 1, 1),
(1721277042, '1721277042_TestFile.txt', 1, 1),
(1722231042, '1722231042_TestFile.txt', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `nsuId` int(11) NOT NULL,
  `studentName` varchar(50) DEFAULT NULL,
  `rfidNo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`nsuId`, `studentName`, `rfidNo`) VALUES
(1721277041, 'Abigail', '1F5F7D4'),
(1721277042, 'Amik', 'E6F8CF7'),
(1721277043, 'Alison', '815BDD5'),
(1721277059, 'Claire', '36817DF7'),
(1722231042, 'Artful', '716C75D5'),
(1722231043, 'Bob', '511ED5');

-- --------------------------------------------------------

--
-- Table structure for table `trace`
--

CREATE TABLE `trace` (
  `id` int(11) NOT NULL,
  `pgCount` int(11) NOT NULL,
  `accountStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trace`
--

INSERT INTO `trace` (`id`, `pgCount`, `accountStatus`) VALUES
(1721277041, 200, 1),
(1721277042, 200, 1),
(1721277043, 200, 1),
(1721277059, 200, 1),
(1722231042, 150, 1),
(1722231043, 120, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `printdata`
--
ALTER TABLE `printdata`
  ADD KEY `nsuId` (`nsuId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`nsuId`),
  ADD UNIQUE KEY `nsuId` (`nsuId`);

--
-- Indexes for table `trace`
--
ALTER TABLE `trace`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `printdata`
--
ALTER TABLE `printdata`
  ADD CONSTRAINT `printdata_ibfk_1` FOREIGN KEY (`nsuId`) REFERENCES `student` (`nsuId`) ON DELETE CASCADE;

--
-- Constraints for table `trace`
--
ALTER TABLE `trace`
  ADD CONSTRAINT `trace_ibfk_1` FOREIGN KEY (`id`) REFERENCES `student` (`nsuId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
