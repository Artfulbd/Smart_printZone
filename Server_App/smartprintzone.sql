-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2020 at 11:39 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

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
  `reqType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printdata`
--

INSERT INTO `printdata` (`nsuId`, `fileName`, `reqType`) VALUES
(1721277041, '1721277041_Lec.txt', 'online'),
(1721277042, '1721277042_Lec.txt', 'offline'),
(1721277043, '1721277043_Lec.txt', 'online'),
(1721277044, '1721277044_Lec.txt', 'offline'),
(1721277045, '1721277045_Lec.txt', 'online'),
(1721277046, '1721277046_Lec.ppt', 'offline'),
(1721277047, '1721277047_Lec.ppt', 'online'),
(1721277048, '1721277048_Lec.ppt', 'offline'),
(1721277049, '1721277049_Lec.ppt', 'online'),
(1721277050, '1721277050_Lec.ppt', 'offline'),
(1721277051, '1721277051_Lec.ppt', 'online'),
(1721277052, '1721277052_Lec.ppt', 'offline'),
(1721277053, '1721277053_Lec.ppt', 'online'),
(1721277054, '1721277054_Lec.docx', 'offline'),
(1721277055, '1721277055_Lec.docx', 'online'),
(1721277056, '1721277056_Lec.docx', 'offline'),
(1721277057, '1721277057_Lec.docx', 'online'),
(1721277058, '1721277058_Lec.docx', 'offline'),
(1721277059, '1721277059_Lec.docx', 'online'),
(1722231042, '1721277060_Lec.docx', 'offline');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `nsuId` int(11) NOT NULL,
  `studentName` varchar(255) DEFAULT NULL,
  `rfidNo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`nsuId`, `studentName`, `rfidNo`) VALUES
(1721277041, 'Abigail', 'abcd41'),
(1721277042, 'Amik', 'abcd42'),
(1721277043, 'Alison', 'abcd43'),
(1721277044, 'Amanda', 'abcd44'),
(1721277045, 'Amelia', 'abcd45'),
(1721277046, 'Amy', 'abcd46'),
(1721277047, 'Andrea', 'abcd47'),
(1721277048, 'Angela', 'abcd48'),
(1721277049, 'Anna', 'abcd49'),
(1721277050, 'Anne', 'abcd50'),
(1721277051, 'Audrey', 'abcd51'),
(1721277052, 'Ava', 'abcd52'),
(1721277053, 'Bella', 'abcd53'),
(1721277054, 'Bernadette', 'abcd54'),
(1721277055, 'Carol', 'abcd55'),
(1721277056, 'Caroline', 'abcd56'),
(1721277057, 'Carolyn', 'abcd57'),
(1721277058, 'Chloe', 'abcd58'),
(1721277059, 'Claire', 'abcd59'),
(1722231042, 'Artful', 'abcd60');

-- --------------------------------------------------------

--
-- Table structure for table `trace`
--

CREATE TABLE `trace` (
  `id` int(11) NOT NULL,
  `pgCount` int(11) NOT NULL,
  `accntStatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
