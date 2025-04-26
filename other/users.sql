-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 05:37 AM
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
-- Database: `vogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`) VALUES
(1, '', '', '$2y$10$dCzvlWadNEkel0bji2FFtuZko/9XvJWizyOyj0I8lC9Cg3RSm3evW'),
(2, '4545', '545@fsf.com', '$2y$10$.q8MAGOUvuFYH5zDUPP8quFvp4iCcoQHas7DprcUN4wr5EQ68kD8G'),
(3, '6868@g.com', '6868@g.com', '$2y$10$30/BUGfJNu049VrQuhR31uodzrBZQWmWI.KIjCLH6vP0RZX/whMSu'),
(4, '333@22.com', '333@22.com', '$2y$10$BeRpfFpWcUWEVffKHmuF2OfapmwbGHkAFO8BV7EnJsKF2AAi.SLd2'),
(5, 'code code code', 'code@code.com', '123456'),
(6, 'فهد علي', 'ifhadii@edu.sa', '$2y$10$OjSGBIyUXaxyn9TjrURD/O1b9tRLEMZ5p2WouKR5BobQMVWyaY4Ha');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
