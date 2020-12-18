-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2020 at 05:42 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `_asd568`
--

CREATE TABLE `_asd568` (
  `ttl` int(11) NOT NULL,
  `eky` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `is_online` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `_user711qd9m`
--

CREATE TABLE `_user711qd9m` (
  `id` varchar(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `page_left` int(11) NOT NULL,
  `total_printed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
