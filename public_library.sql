-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2020 at 09:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `public_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `username` varchar(15) NOT NULL,
  `message` text DEFAULT NULL,
  `date_sent` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`username`, `message`, `date_sent`) VALUES
('mark12', 'awts gege', '2020-11-05 14:22:43'),
('bong123', 'wewewe', '2020-11-05 15:26:36'),
('bong123', 'fawef', '2020-11-05 17:06:10'),
('bong123', 'last try', '2020-11-05 17:57:50'),
('mark12', 'last try nge', '2020-11-05 17:58:03'),
('bong123', 'samina mina eh eh', '2020-11-05 17:58:54'),
('mark12', 'samina mina eh eh', '2020-11-05 17:58:56'),
('bong123', 'waka wak eh eh', '2020-11-05 17:59:14'),
('mark12', 'waka wak eh eh', '2020-11-05 17:59:15'),
('bong123', 'lats last last', '2020-11-05 18:14:32'),
('mark12', 'lats last last', '2020-11-05 18:14:33'),
('bong123', 'dfs', '2020-11-05 18:15:21'),
('mark12', 'sdw', '2020-11-05 18:15:50'),
('bong123', 'awe', '2020-11-05 18:19:06'),
('mark12', 'awe', '2020-11-05 18:19:07'),
('bong123', 'lastlasltalastlalstlalst', '2020-11-05 18:20:58'),
('mark12', 'lastlasltalastlalstlalst', '2020-11-05 18:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone_number`, `username`, `password`, `type`) VALUES
(1, 'Cindy Skambarlo', '+639487776822', 'cindy', '1234', 1),
(2, 'Mark Carinomikori', '+639487776849', 'mark12', '4321', 0),
(26, 'James Reid', '+639194199422', 'james01', '123321', 0),
(29, 'Bong Go', '+639055195218', 'bong123', 'gogogo!', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
