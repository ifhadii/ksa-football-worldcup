-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 10:32 AM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', 'admin', '2025-04-26 03:03:16'),
(2, 'iadmin_fahad', 'admin@ifhadii.com', '123456', '2025-04-26 04:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_title` varchar(500) NOT NULL,
  `city_desc` varchar(1000) NOT NULL,
  `city_detail` text NOT NULL,
  `ufile` varchar(1000) NOT NULL,
  `upadated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_title`, `city_desc`, `city_detail`, `ufile`, `upadated_at`) VALUES
(48, 'الرياض', 'الرياضالرياضالرياضالرياض', '', '', '2025-04-26 00:09:12'),
(49, 'الرياض', 'الرياضالرياضالرياضالرياض', '', '', '2025-04-26 00:14:04'),
(50, 'الرياض', 'الرياضالرياضالرياضالرياض', '', '', '2025-04-26 00:15:41');

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
(34, 48, 'الرياضالرياضالرياضالرياض', '2924f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:09:12'),
(35, 48, 'الرياضالرياضالرياضالرياض', '2292f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:09:12'),
(36, 48, 'الرياضالرياضالرياضالرياض', '5057f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:09:12'),
(37, 49, 'الرياضالرياضالرياضالرياض', '883f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:14:04'),
(38, 49, 'الرياضالرياضالرياضالرياض', '1830f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:14:04'),
(39, 49, 'الرياضالرياضالرياضالرياض', '1203f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:14:04'),
(40, 50, 'الرياضالرياضالرياضالرياض', '1584f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:15:41'),
(41, 50, 'الرياضالرياضالرياضالرياض', '383f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:15:41'),
(42, 50, 'الرياضالرياضالرياضالرياض', '2186f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'الرياضالرياضالرياض', '2025-04-26 00:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `city_hotels`
--

CREATE TABLE `city_hotels` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `port_title` varchar(500) NOT NULL,
  `port_desc` varchar(1000) NOT NULL,
  `port_detail` varchar(2000) NOT NULL,
  `ufile` varchar(1000) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `xfile` varchar(1000) NOT NULL,
  `ufile` varchar(1000) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `xfile`, `ufile`, `updated_at`) VALUES
(1, '5465logo.png', '1472logo.png', '2025-04-21 13:11:56');

-- --------------------------------------------------------

--
-- Table structure for table `siteconfig`
--

CREATE TABLE `siteconfig` (
  `id` int(11) NOT NULL,
  `site_keyword` varchar(1000) NOT NULL,
  `site_desc` varchar(500) NOT NULL,
  `site_title` varchar(300) NOT NULL,
  `site_about` varchar(1000) NOT NULL,
  `site_footer` varchar(1000) NOT NULL,
  `follow_text` varchar(1000) NOT NULL,
  `site_url` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siteconfig`
--

INSERT INTO `siteconfig` (`id`, `site_keyword`, `site_desc`, `site_title`, `site_about`, `site_footer`, `follow_text`, `site_url`, `updated_at`) VALUES
(1, 'Church, Marketing', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit nihil tenetur minus quidem est deserunt molestias accusamus harum ullam tempore debitis et, expedita, repellat delectus aspernatur neque itaque qui quod.', 'Vogue Website', ' Young coders can use events to coordinate timing and communication between different sprites or pieces of their story. For instance, the when _ key pressed block is an event that starts code whenever the corresponding key on the keyboard is pressed.', '© 2024 All Rights Reserved', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit nihil tenetur minus quidem est deserunt molestias.', 'http://localhost:8080/vogue/', '2025-04-20 23:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `sitecontact`
--

CREATE TABLE `sitecontact` (
  `id` int(11) NOT NULL,
  `phone1` varchar(150) NOT NULL,
  `phone2` varchar(150) NOT NULL,
  `email1` varchar(100) NOT NULL,
  `email2` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `latitude` varchar(150) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sitecontact`
--

INSERT INTO `sitecontact` (`id`, `phone1`, `phone2`, `email1`, `email2`, `longitude`, `latitude`, `updated_at`) VALUES
(1, '+89 (0) 2354 5470091', '+89 (0) 2354 5470091', 'mail@company.com', 'mail@company.com', '7.099737483', '7.63734634', '2022-07-15 11:05:25');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `fa` varchar(150) NOT NULL,
  `social_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `name`, `fa`, `social_link`) VALUES
(1, 'Facebook', 'fa-facebook', 'https://facebook.com/faithyemi'),
(2, 'Instagram', 'fa-instagram', 'https://instagram.com/faith_awolu');

-- --------------------------------------------------------

--
-- Table structure for table `testimony`
--

CREATE TABLE `testimony` (
  `id` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `ufile` varchar(1000) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimony`
--

INSERT INTO `testimony` (`id`, `message`, `name`, `position`, `ufile`, `updated_at`) VALUES
(7, 'تجربة كأس العالم في السعودية كانت استثنائية بكل المقاييس. التنظيم كان على مستوى عالمي، والروح الرياضية بين الجماهير كانت رائعة. المملكة قدمت استضافة مميزة، والفعاليات كانت تليق بحجم الحدث', 'فهد السبيعي', 'مشجع رياضي', '680c806321955.jpg', '2025-04-26 06:42:43'),
(8, 'تجربة كأس العالم في السعودية كانت استثنائية بكل المقاييس. التنظيم كان على مستوى عالمي، والروح الرياضية بين الجماهير كانت رائعة. المملكة قدمت استضافة مميزة، والفعاليات كانت تليق بحجم الحدث', 'فهد السبيعي', 'مشجع رياضي', '680c807cb969d.png', '2025-04-26 06:43:08'),
(9, 'كأس العالم في السعودية كان لحظة تاريخية. المملكة أظهرت للعالم قدرتها على تنظيم أكبر الأحداث الرياضية. كل شيء كان منظم بدقة، والشعب السعودي كان مضيافًا، والاحتفالات كانت ممتعة للغاية', 'نورة الحربي', ' إعلامية', '680c8233c748b.jpg', '2025-04-26 06:50:27'),
(10, 'كلما أتذكر كأس العالم في السعودية، أتذكر كيف كانت المملكة فخورة باستضافة هذا الحدث الكبير. من الملاعب الحديثة إلى التقنيات المتقدمة، كل شيء كان مرتب بشكل يعكس تطور كبرى مدن المملكة.', 'عبد الله القحطاني', 'مهندس', '680c826f26179.jpg', '2025-04-26 06:51:27'),
(11, 'كلما أتذكر كأس العالم في السعودية، أتذكر كيف كانت المملكة فخورة باستضافة هذا الحدث الكبير. من الملاعب الحديثة إلى التقنيات المتقدمة، كل شيء كان مرتب بشكل يعكس تطور كبرى مدن المملكة.', 'عبد الله القحطاني', 'مهندس', '680c8274a25b8.jpg', '2025-04-26 06:51:32'),
(12, 'الرياضة في السعودية أظهرت لنا جانبًا جديدًا من حب الوطن والإنجازات. كأس العالم في السعودية ما كان مجرد مباراة، كان مناسبة لترسيخ مكانة المملكة في قلب العالم الرياضي. كنا فخورين بكل التفاصيل', 'سارة الزهراني', 'طالبّة', '680c828d66256.jpg', '2025-04-26 06:51:57'),
(13, 'كأس العالم في السعودية كان نقطة تحول كبيرة في مسيرة الرياضة المحلية. رؤية المملكة 2030 حققت نجاحًا كبيرًا، وتنظيم كأس العالم في بلادنا كان بمثابة خطوة عملاقة نحو مستقبل مشرق للرياضة.', 'يوسف المالكي', 'رجل أعمال', '680c82a96ea8c.jpg', '2025-04-26 06:52:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `is_admin`) VALUES
(6, 'فهد علي', 'ifhadii@edu.sa', '$2y$10$L5w.bHu3VlM1IcJPDg5BOuJIpFT61b0Lp5otQgmvufAc.W3ych/Fi', 0),
(8, 'fahad_admin', 'admin@fa.com', '$2y$10$QGlBkDJBuQ4qqUN4DGDB0eNM0E6qA9IvUoMmu3pmsRp6R7XUN442W', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_cards`
--
ALTER TABLE `city_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `city_hotels`
--
ALTER TABLE `city_hotels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siteconfig`
--
ALTER TABLE `siteconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sitecontact`
--
ALTER TABLE `sitecontact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimony`
--
ALTER TABLE `testimony`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `city_cards`
--
ALTER TABLE `city_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `city_hotels`
--
ALTER TABLE `city_hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sitecontact`
--
ALTER TABLE `sitecontact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimony`
--
ALTER TABLE `testimony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city_cards`
--
ALTER TABLE `city_cards`
  ADD CONSTRAINT `city_cards_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `city_hotels`
--
ALTER TABLE `city_hotels`
  ADD CONSTRAINT `city_hotels_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
