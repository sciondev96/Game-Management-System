-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 26, 2021 at 05:36 AM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `gamers`
--

CREATE TABLE `gamers` (
  `gamerid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phnum` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gamers`
--

INSERT INTO `gamers` (`gamerid`, `name`, `email`, `password`, `phnum`, `privacy`, `platform`) VALUES
('abcxbx', 'abc', 'abc@xbx.com', '1234', '1234567890', 'Yes', 'Xbox'),
('satvikpsn', 'Satvik Singh S', 'satvik@psn.com', '1234', '9449654665', 'Yes', 'PS'),
('satviksngh', 'Satvik', 'satvik@abc.com', 'satvik', '9741469616', 'No', 'Xbox'),
('tedwest', 'Ted', 'ted@abc.com', '1234', '9449654665', 'Yes', 'PS');

-- --------------------------------------------------------

--
-- Table structure for table `ps`
--

CREATE TABLE `ps` (
  `gamerid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bronze` int(2) UNSIGNED NOT NULL,
  `silver` int(2) UNSIGNED NOT NULL,
  `gold` int(1) UNSIGNED NOT NULL,
  `total` int(2) UNSIGNED NOT NULL,
  `platinum` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updatedate` date NOT NULL,
  `rating` int(2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ps`
--

INSERT INTO `ps` (`gamerid`, `name`, `bronze`, `silver`, `gold`, `total`, `platinum`, `updatedate`, `rating`) VALUES
('tedwest', 'Days Gone', 31, 10, 3, 44, 'NO', '2021-01-16', 9),
('tedwest', 'Doom', 35, 12, 3, 50, 'YES', '2021-01-10', 8),
('tedwest', 'Doom Eternal', 30, 10, 0, 40, 'NO', '2021-01-10', 9),
('tedwest', 'Ghost', 35, 10, 2, 47, 'NO', '2021-01-10', 9),
('tedwest', 'God of War', 35, 12, 3, 50, 'YES', '2021-01-10', 10),
('tedwest', 'HZD', 35, 12, 3, 50, 'YES', '2021-01-10', 5),
('tedwest', 'Spiderman', 35, 12, 3, 50, 'YES', '2021-01-14', 10);

-- --------------------------------------------------------

--
-- Table structure for table `xbox`
--

CREATE TABLE `xbox` (
  `gamerid` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gamerscore` int(4) UNSIGNED NOT NULL,
  `completion` decimal(3,0) NOT NULL,
  `updatedate` date NOT NULL,
  `rating` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `xbox`
--

INSERT INTO `xbox` (`gamerid`, `name`, `gamerscore`, `completion`, `updatedate`, `rating`) VALUES
('abcxbx', 'Gid', 50, '5', '2021-01-11', 9),
('satviksngh', 'Doom Eternal', 1000, '100', '2021-01-11', 9),
('satviksngh', 'Fable', 5, '1', '2021-01-10', 8),
('satviksngh', 'Fenyx', 1000, '100', '2021-01-10', 6),
('satviksngh', 'Forza Horizon', 75, '8', '2021-01-10', 8),
('satviksngh', 'Gid', 1000, '100', '2021-01-11', 10),
('satviksngh', 'Halo', 1000, '100', '2021-01-10', 3),
('satviksngh', 'Halo: MCC', 135, '14', '2021-01-11', 7),
('satviksngh', 'Perfect Dark', 950, '95', '2021-01-16', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gamers`
--
ALTER TABLE `gamers`
  ADD PRIMARY KEY (`gamerid`);

--
-- Indexes for table `ps`
--
ALTER TABLE `ps`
  ADD PRIMARY KEY (`gamerid`,`name`);

--
-- Indexes for table `xbox`
--
ALTER TABLE `xbox`
  ADD PRIMARY KEY (`gamerid`,`name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ps`
--
ALTER TABLE `ps`
  ADD CONSTRAINT `ps_ibfk_1` FOREIGN KEY (`gamerid`) REFERENCES `gamers` (`gamerid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `xbox`
--
ALTER TABLE `xbox`
  ADD CONSTRAINT `xbox_ibfk_1` FOREIGN KEY (`gamerid`) REFERENCES `gamers` (`gamerid`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
