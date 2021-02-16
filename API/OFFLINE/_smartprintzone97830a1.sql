-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 05:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `_smartprintzone97830a1`
--

-- --------------------------------------------------------

--
-- Table structure for table `creadentials`
--

CREATE TABLE `creadentials` (
  `type` varchar(50) NOT NULL,
  `dir` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creadentials`
--

INSERT INTO `creadentials` (`type`, `dir`) VALUES
('size', '2048'),
('hidden', 'E:\\Testing\\NewDir'),
('temp', 'E:\\Testing\\NSU PDF'),
('server', '\\\\DESKTOP-5RNDV53\\ServerFolder');

-- --------------------------------------------------------

--
-- Table structure for table `_asd568`
--

CREATE TABLE `_asd568` (
  `ttl` varchar(20) NOT NULL,
  `eky` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_asd568`
--

INSERT INTO `_asd568` (`ttl`, `eky`) VALUES
('app_activation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `_cread96a4f3p`
--

CREATE TABLE `_cread96a4f3p` (
  `setting_id` tinyint(4) NOT NULL,
  `max_file_count` tinyint(4) NOT NULL,
  `max_size_total` double NOT NULL,
  `server_dir` varchar(100) NOT NULL,
  `hidden_dir` varchar(100) NOT NULL,
  `temp_dir` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_cread96a4f3p`
--

INSERT INTO `_cread96a4f3p` (`setting_id`, `max_file_count`, `max_size_total`, `server_dir`, `hidden_dir`, `temp_dir`) VALUES
(1, 6, 30000, '\\\\DESKTOP-5RNDV53\\ServerFolder', 'E:\\Testing\\NewDir', 'E:\\Testing\\NSU PDF');

-- --------------------------------------------------------

--
-- Table structure for table `_pending5cq71rd`
--

CREATE TABLE `_pending5cq71rd` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `time` datetime NOT NULL,
  `pg_count` int(11) NOT NULL,
  `size` double NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `source` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_pending5cq71rd`
--

INSERT INTO `_pending5cq71rd` (`id`, `file_name`, `time`, `pg_count`, `size`, `is_online`, `source`) VALUES
(1721277, 'Lecture', '2021-02-16 22:47:23', 80, 731, 0, 'DESKTOP-5RNDV53'),
(1721277, 'Schedule_Spring2021', '2021-02-16 22:47:26', 1, 200, 0, 'DESKTOP-5RNDV53');

-- --------------------------------------------------------

--
-- Table structure for table `_user711qd9m`
--

CREATE TABLE `_user711qd9m` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `page_left` mediumint(9) NOT NULL DEFAULT 200,
  `total_printed` int(11) NOT NULL DEFAULT 0,
  `pending` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_user711qd9m`
--

INSERT INTO `_user711qd9m` (`id`, `name`, `status`, `page_left`, `total_printed`, `pending`) VALUES
(1721277, 'Fahad Rahman Amik', 1, 200, 0, 2),
(1721616, 'Junaer Adib', 1, 200, 0, 0),
(1722231, 'Md. Ariful Haque', 1, 200, 0, 0),
(1822231, 'Akhandanand Tripathi', 1, 200, 0, 0),
(1922231, 'Rajpal Yadhap', 0, 200, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creadentials`
--
ALTER TABLE `creadentials`
  ADD PRIMARY KEY (`type`),
  ADD UNIQUE KEY `dir` (`dir`);

--
-- Indexes for table `_asd568`
--
ALTER TABLE `_asd568`
  ADD PRIMARY KEY (`ttl`);

--
-- Indexes for table `_cread96a4f3p`
--
ALTER TABLE `_cread96a4f3p`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `_pending5cq71rd`
--
ALTER TABLE `_pending5cq71rd`
  ADD PRIMARY KEY (`id`,`file_name`);

--
-- Indexes for table `_user711qd9m`
--
ALTER TABLE `_user711qd9m`
  ADD PRIMARY KEY (`id`,`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `_cread96a4f3p`
--
ALTER TABLE `_cread96a4f3p`
  MODIFY `setting_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `_pending5cq71rd`
--
ALTER TABLE `_pending5cq71rd`
  ADD CONSTRAINT `_pending5cq71rd_fk0` FOREIGN KEY (`id`) REFERENCES `_user711qd9m` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
