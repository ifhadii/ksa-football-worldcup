-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 12:52 AM
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
-- Table structure for table `city_cards`
--

CREATE TABLE `city_cards` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `place_name` varchar(255) NOT NULL,
  `place_image` varchar(255) NOT NULL,
  `place_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city_cards`
--

INSERT INTO `city_cards` (`id`, `city_id`, `place_name`, `place_image`, `place_description`, `created_at`) VALUES
(6, 37, 'الطريف', '948388138d5e-a74d-4fa5-978e-63f3b6b4c853.jpg', 'موقع أثري تاريخي في الدرعية، القلب التاريخي للمملكة ومسجل في قائمة اليونسكو للتراث العالمي', '2025-04-25 22:41:25'),
(7, 37, 'مركز الملك عبدالله المالي', '9282a57e100d-f191-441c-b03e-75adc551a0cc.jpg', ' الوجهة المالية الرائدة في الرياض التي تعزز مكانة المملكة كمركز اقتصادي إقليمي.', '2025-04-25 22:41:25'),
(8, 37, 'منحدر حافة العالم', '2047f33804f9-792f-40b1-85ce-f3a1db7609a5.jpg', 'تشكيل صخري مذهل شمال الرياض يقدم مناظر طبيعية خلابة ومغامرات لا تُنسى', '2025-04-25 22:41:25'),
(9, 37, 'ساوندستورم', '2239e16debcf-46c6-42c4-8e38-bf9046267871.jpg', 'أكبر مهرجان موسيقي في المنطقة يجمع نجوم العالم في حفلات أسطورية وسط العاصمة', '2025-04-25 22:41:26'),
(10, 37, 'بوليفارد رياض سيتي', '7478c7a31a06-dd67-4d34-89e3-e77c9cec1736.jpg', 'الوجهة الترفيهية الأبرز في العاصمة، تجمع بين التسوق الفاخر والمطاعم العالمية والفعاليات', '2025-04-25 22:41:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city_cards`
--
ALTER TABLE `city_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city_cards`
--
ALTER TABLE `city_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city_cards`
--
ALTER TABLE `city_cards`
  ADD CONSTRAINT `city_cards_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
