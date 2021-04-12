-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 10:51 PM
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
-- Database: `_server97830a1`
--

-- --------------------------------------------------------

--
-- Table structure for table `prin23422ting_queue21314`
--

CREATE TABLE `prin23422ting_queue21314` (
  `num` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `wait_time` int(11) NOT NULL,
  `insertion_time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prin23422ting_queue21314`
--

INSERT INTO `prin23422ting_queue21314` (`num`, `u_id`, `p_id`, `time`, `wait_time`, `insertion_time`) VALUES
(0, 1724, 3, 35, 3, '02:44:41'),
(1, 1822, 1, 20, 34, '02:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `print43er_details234c23452`
--

CREATE TABLE `print43er_details234c23452` (
  `printer_id` int(11) NOT NULL,
  `printer_name` varchar(100) NOT NULL,
  `given_name` varchar(100) NOT NULL,
  `port` varchar(30) NOT NULL,
  `time_one_pg` float NOT NULL,
  `driver_name` varchar(200) NOT NULL,
  `current_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `print43er_details234c23452`
--

INSERT INTO `print43er_details234c23452` (`printer_id`, `printer_name`, `given_name`, `port`, `time_one_pg`, `driver_name`, `current_status`) VALUES
(1, 'printer_one', 'NAC Printer', 'nai', 1, 'nai', 1),
(2, 'printer_two', 'SAC Printer', 'nai', 1.5, 'nai', 1),
(3, 'printer_three', 'Loung', 'nai', 2, 'nai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `printe3242342r_status234232077`
--

CREATE TABLE `printe3242342r_status234232077` (
  `printer_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `required_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printe3242342r_status234232077`
--

INSERT INTO `printe3242342r_status234232077` (`printer_id`, `u_id`, `required_time`) VALUES
(1, 17222, 20),
(2, 0, 43),
(3, 0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `printer_status_code`
--

CREATE TABLE `printer_status_code` (
  `s_code` int(11) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `printer_status_code`
--

INSERT INTO `printer_status_code` (`s_code`, `status`) VALUES
(0, 'offline'),
(1, 'online'),
(2, 'printing stopped');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prin23422ting_queue21314`
--
ALTER TABLE `prin23422ting_queue21314`
  ADD UNIQUE KEY `num` (`num`),
  ADD UNIQUE KEY `u_id` (`u_id`),
  ADD KEY `printer_details_link2` (`p_id`);

--
-- Indexes for table `print43er_details234c23452`
--
ALTER TABLE `print43er_details234c23452`
  ADD PRIMARY KEY (`printer_id`),
  ADD UNIQUE KEY `given_name` (`given_name`),
  ADD KEY `printer_staus_relation` (`current_status`);

--
-- Indexes for table `printe3242342r_status234232077`
--
ALTER TABLE `printe3242342r_status234232077`
  ADD PRIMARY KEY (`printer_id`);

--
-- Indexes for table `printer_status_code`
--
ALTER TABLE `printer_status_code`
  ADD PRIMARY KEY (`s_code`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prin23422ting_queue21314`
--
ALTER TABLE `prin23422ting_queue21314`
  ADD CONSTRAINT `printer_details_link2` FOREIGN KEY (`p_id`) REFERENCES `print43er_details234c23452` (`printer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `print43er_details234c23452`
--
ALTER TABLE `print43er_details234c23452`
  ADD CONSTRAINT `printer_staus_relation` FOREIGN KEY (`current_status`) REFERENCES `printer_status_code` (`s_code`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `printe3242342r_status234232077`
--
ALTER TABLE `printe3242342r_status234232077`
  ADD CONSTRAINT `printer_details_link1` FOREIGN KEY (`printer_id`) REFERENCES `print43er_details234c23452` (`printer_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
