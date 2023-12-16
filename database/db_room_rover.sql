-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2023 at 08:59 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_room_rover`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `username` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  `user_type` varchar(99) NOT NULL COMMENT 'owner\r\nboarder'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `session_id`, `username`, `password`, `user_type`) VALUES
(1, '', 'owner', '72122ce96bfec66e2396d2e25225d70a', 'owner'),
(2, '', 'boarder', '941765071f4c67cfe31a20e329257d46', 'boarder'),
(3, '', 'try', 'try', 'owner'),
(4, 'gg8qkt7oc0argq1palg6lsqhhv', 'Example', '0a52730597fb4ffa01fc117d9e71e3a9', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `g_lastname` varchar(99) NOT NULL,
  `g_middlename` varchar(99) NOT NULL,
  `g_firstname` varchar(99) NOT NULL,
  `g_address` varchar(99) NOT NULL,
  `lastname` varchar(99) NOT NULL,
  `middlename` varchar(99) NOT NULL,
  `firstname` varchar(99) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(99) NOT NULL,
  `contact_no` varchar(99) NOT NULL,
  `email` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `session_id`, `g_lastname`, `g_middlename`, `g_firstname`, `g_address`, `lastname`, `middlename`, `firstname`, `age`, `gender`, `contact_no`, `email`) VALUES
(1, 'gg8qkt7oc0argq1palg6lsqhhv', 'Example', 'Example', 'Example', 'Example', 'Example', 'Example', 'Example', 12, 'male', '12346546321`34', 'Example@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
