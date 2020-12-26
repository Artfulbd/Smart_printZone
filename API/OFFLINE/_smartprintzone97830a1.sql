-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2020 at 08:34 PM
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
  `id` varchar(11) NOT NULL,
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
('1722231042', 'Schedule_Fall2020', '2020-12-26 01:35:53', 1, 1, 1, 'w');

-- --------------------------------------------------------

--
-- Table structure for table `_user711qd9m`
--

CREATE TABLE `_user711qd9m` (
  `id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `page_left` int(11) NOT NULL DEFAULT 200,
  `total_printed` int(11) NOT NULL DEFAULT 0,
  `pending` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `_user711qd9m`
--

INSERT INTO `_user711qd9m` (`id`, `name`, `status`, `page_left`, `total_printed`, `pending`) VALUES
('1721277042', 'Fahad Rahman Amik', 1, 200, 0, 0),
('1721616042', 'Junaer Adib', 1, 200, 0, 0),
('1722231042', 'Md. Ariful Haque', 1, 200, 0, 1),
('1822231042', 'Akhandanand Tripathi', 1, 200, 0, 0),
('1922231042', 'Rajpal Yadhap', 0, 200, 0, 0);

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
  ADD CONSTRAINT `_pending5cq71rd_fk0` FOREIGN KEY (`id`) REFERENCES `_user711qd9m` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
