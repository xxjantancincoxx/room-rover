-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 03:55 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `password` varchar(255) NOT NULL,
  `user_type` varchar(99) NOT NULL COMMENT 'owner\r\nboarder'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `session_id`, `username`, `password`, `user_type`) VALUES
(1, 'e8pell9nhiqr1iatshvs9s5au7', 'owner1', '4ef5ba0c918c537fadba2ada54e3dd68', 'owner'),
(2, '0c98d43h5a3ju4h9efi3735art', 'juan', 'f5737d25829e95b9c234b7fa06af8736', 'boarder'),
(3, 'vtg4jb2pupaq07qgo13jiibqlr', 'boarder', '941765071f4c67cfe31a20e329257d46', 'boarder'),
(4, 'j1cc3em4kbngs1ul3diil5ga1a', 'hatdog', '52059d00dc42fb8972f17b778ba9dd27', 'owner'),
(5, 'v27f4tdvhdb3laeh6bpdctinai', 'hekhok', '05c8f409f3d728b816f6b224e9f4e6b5', 'owner'),
(6, 'jvsls98tom0igo69e55mj0bglk', 'test1', '$2y$10$MPsg1W7bROtOOmnsBS3Q3eSrKNIsj9HLZlqHWta8a1CS/8s4lb1Fm', 'owner'),
(7, 'ngiu51atlt9ogtu1df3s9e0qkt', 'test12', '60474c9c10d7142b7508ce7a50acf414', 'owner');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `ewallet` varchar(255) DEFAULT NULL,
  `e_accountName` varchar(255) DEFAULT NULL,
  `e_accountNumber` varchar(255) DEFAULT NULL,
  `referenceNo` varchar(255) DEFAULT NULL,
  `amountPaid` decimal(10,2) DEFAULT NULL,
  `rs_id` int(11) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `uid`, `ewallet`, `e_accountName`, `e_accountNumber`, `referenceNo`, `amountPaid`, `rs_id`, `payment_date`) VALUES
(2, 3, 'GCash', 'jun', '121213131', '1313131', 2000.00, 2, '2023-12-12 14:08:33'),
(3, 3, 'GCash', 'sam', '097776262', '181173137', 12000.00, 3, '2023-12-12 14:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `listing_id`, `review_text`, `rating`, `created_at`) VALUES
(3, 3, 7, 'Ayos', 5, '2023-12-12 13:35:25'),
(4, 3, 8, 'Hakdog', 3, '2023-12-12 14:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_listings`
--

CREATE TABLE `tbl_listings` (
  `listing_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `e_wallet` varchar(20) NOT NULL,
  `qr_pic` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `rooms_Available` int(9) NOT NULL,
  `owner_id` int(13) NOT NULL,
  `price` int(13) NOT NULL,
  `is_aircon` int(1) NOT NULL,
  `free_water_electric` int(1) NOT NULL,
  `free_wifi` int(1) NOT NULL,
  `own_cr` int(1) NOT NULL,
  `pic` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_listings`
--

INSERT INTO `tbl_listings` (`listing_id`, `name`, `e_wallet`, `qr_pic`, `location`, `rooms_Available`, `owner_id`, `price`, `is_aircon`, `free_water_electric`, `free_wifi`, `own_cr`, `pic`, `date_added`) VALUES
(7, 'Infinity Castle', '09876817620', 'QR1SAMPLE.jpg', 'Tacloban City', 93, 1, 3000, 1, 1, 1, 1, 'B-house-1.jpg', 'December 12, 2023'),
(8, 'Sample house', '098876524', 'QR1SAMPLE.jpg', 'Carigara Leyte', 10, 1, 5000, 1, 1, 1, 1, 'Walking catfish.jpg', 'December 12, 2023');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reservations`
--

CREATE TABLE `tbl_reservations` (
  `rs_id` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `num_Rooms` int(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `date_created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reservations`
--

INSERT INTO `tbl_reservations` (`rs_id`, `lid`, `uid`, `num_Rooms`, `status`, `date_created`) VALUES
(2, 7, 3, 3, 1, 'December 12, 2023'),
(3, 7, 3, 4, 0, 'December 12, 2023');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `g_lastname` varchar(99) DEFAULT NULL,
  `g_middlename` varchar(99) DEFAULT NULL,
  `g_firstname` varchar(99) DEFAULT NULL,
  `g_address` varchar(99) DEFAULT NULL,
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
(1, 'e8pell9nhiqr1iatshvs9s5au7', NULL, NULL, NULL, NULL, 'owner', 'O', 'Owen', 25, 'male', '09063988756', 'cust@gmail.com'),
(2, '0c98d43h5a3ju4h9efi3735art', 'Juan', 'D', 'Cruz', 'Carigara, Leyte', 'Jan', 'J', 'Juan', 23, 'male', '09063988729', 'sampol@gmail.com'),
(3, 'vtg4jb2pupaq07qgo13jiibqlr', 'junnix', 'junnix', 'junnix', 'Carigara, Leyte', 'test', 'w', 'test', 24, 'male', '09063988756', 'sampol@gmail.com'),
(4, 'j1cc3em4kbngs1ul3diil5ga1a', NULL, NULL, NULL, NULL, 'JOHNSina', 'J', 'JOHN', 23, 'Choose...', '98768990', 'NN@GMAIL.CON'),
(5, 'v27f4tdvhdb3laeh6bpdctinai', NULL, NULL, NULL, NULL, 'JOHNSina', 'J', 'JOHN', 24, 'male', '09063988757', 'NN@GMAIL.CON'),
(6, 'jvsls98tom0igo69e55mj0bglk', NULL, NULL, NULL, NULL, 'cust', 'J', 'customer', 24, 'male', '09063988757', 'admin@test.com'),
(7, 'ngiu51atlt9ogtu1df3s9e0qkt', NULL, NULL, NULL, NULL, 'test', 'A', 'tessat', 23, 'male', '097762625517', 'test1223@test.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `payment_ibfk_1` (`rs_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reviews_ibfk_2` (`listing_id`);

--
-- Indexes for table `tbl_listings`
--
ALTER TABLE `tbl_listings`
  ADD PRIMARY KEY (`listing_id`);

--
-- Indexes for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  ADD PRIMARY KEY (`rs_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_listings`
--
ALTER TABLE `tbl_listings`
  MODIFY `listing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_reservations`
--
ALTER TABLE `tbl_reservations`
  MODIFY `rs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`rs_id`) REFERENCES `tbl_reservations` (`rs_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `tbl_listings` (`listing_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
