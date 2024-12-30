-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2024 at 11:36 AM
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
-- Database: `farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `price` decimal(65,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `username`, `product_id`, `contact_info`, `booking_date`, `status`, `price`) VALUES
(1, 1, 'ismael', 8, '0700750061', '2024-12-23 04:29:10', 'cancelled', 6000.000),
(2, 1, 'ismael', 10, '0700750061', '2024-12-23 05:05:47', 'confirmed', 30000.000),
(3, 1, 'ismael', 7, '0700750061', '2024-12-24 16:19:46', 'pending', 500.000),
(4, 1, 'ismael', 9, '0700750061', '2024-12-24 16:31:18', 'pending', 80000.000),
(5, 1, 'ismael', 8, '0700750061', '2024-12-25 07:03:38', 'pending', 6000.000);

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `officer_id` int(11) NOT NULL,
  `officer_name` varchar(255) NOT NULL,
  `officer_specialty` varchar(255) NOT NULL,
  `officer_contact` varchar(255) DEFAULT NULL,
  `officer_email` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_contact` varchar(255) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `officer_id`, `officer_name`, `officer_specialty`, `officer_contact`, `officer_email`, `user_id`, `user_name`, `user_contact`, `booking_date`, `booking_time`, `status`) VALUES
(15, 3, 'bogere magret', 'crop and animal specialist', '0700750061', 'bogere@gmail.com', 1, 'ismael', '0700750061', '2024-12-19', '11:46:00', 'pending'),
(16, 3, 'bogere magret', 'crop and animal specialist', '0700750061', 'bogere@gmail.com', 1, 'ismael', '0700750061', '2024-12-27', '11:51:00', 'pending'),
(17, 3, 'bogere magret', 'crop and animal specialist', '0700750061', 'bogere@gmail.com', 1, 'ismael', '0700750061', '2024-12-29', '14:51:00', 'pending'),
(18, 3, 'bogere magret', 'crop and animal specialist', '0700750061', 'bogere@gmail.com', 1, 'ismael', '0700750061', '2024-12-27', '14:52:00', 'pending'),
(19, 3, 'bogere magret', 'crop and animal specialist', '0700750061', 'bogere@gmail.com', 1, 'ismael', '0700750061', '2024-12-26', '11:02:00', 'pending'),
(20, 3, 'bogere magret', 'crop and animal specialist', '0700750061', 'bogere@gmail.com', 1, 'ismael', '0700750061', '2024-12-26', '16:05:00', 'pending'),
(21, 3, 'bogere magret', 'crop and animal specialist', '0700750061', 'bogere@gmail.com', 1, 'ismael', '0700750061', '2024-12-27', '17:05:00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `officers`
--

CREATE TABLE `officers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `specialty` varchar(255) NOT NULL,
  `experience` int(11) NOT NULL,
  `qualifications` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officers`
--

INSERT INTO `officers` (`id`, `name`, `specialty`, `experience`, `qualifications`, `photo`, `contact`, `email`) VALUES
(3, 'bogere magret', 'crop and animal specialist', 7, 'Bachelors of science in agrobusiness', 'uploads/avatar-4.png', '0700750061', 'bogere@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `price`) VALUES
(7, 'mangoes', 'cool', 'uploads/1734852383_mango1.JPG', 500.00),
(8, 'coffes', 'cool and bridght red ', 'uploads/1734858709_close-up-cherries-tree_1048944-18609448.jpg', 6000.00),
(9, 'turkey', 'african turkey 10kg', 'uploads/1734858757_close-up-view-bust-turkey-with-red-mucus-black-feathers_463209-45.avif', 80000.00),
(10, 'chicken', '2kg chicken african type', 'uploads/1734859044_portrait-rooster_181624-21975.avif', 30000.00),
(11, 'cattle', 'bull of 250kg', 'uploads/1734860309_longhorn-steers_181624-15020.avif', 2700000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `district` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('1','0','','') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `district`, `password`, `created_at`, `role`) VALUES
(1, 'ismael', 'ismaelkihagama@gmail.com', '0700750061', 'kaliro', '827ccb0eea8a706c4c34a16891f84e7b', '2024-12-21 18:20:21', '0'),
(2, 'abu', 'abu@gmail.com', '0700750061', 'kampala', 'c20ad4d76fe97759aa27a0c99bff6710', '2024-12-21 18:28:29', '0'),
(4, 'angela', 'angela@gmail.com', '0700750060', 'kamuli', '81dc9bdb52d04dc20036dbd8313ed055', '2024-12-22 07:13:33', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `officer_id` (`officer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `officers`
--
ALTER TABLE `officers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `officers`
--
ALTER TABLE `officers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`officer_id`) REFERENCES `officers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
