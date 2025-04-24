-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 23 أبريل 2025 الساعة 16:57
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `welcomecup`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `updated_at`) VALUES
(1, 'admin', 'admin', '2022-07-13 11:00:19');

-- --------------------------------------------------------

--
-- بنية الجدول `city`
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
-- إرجاع أو استيراد بيانات الجدول `city`
--

INSERT INTO `city` (`id`, `city_title`, `city_desc`, `city_detail`, `ufile`, `upadated_at`) VALUES
(13, 'مدينة أبها', 'أبها هي مدينة تقع جنوب غرب المملكة العربية السعودية، وهي عاصمة منطقة عسير الإدارية. تُعرف أبها بلقب \"عروس الجبل\" نظرًا لطبيعتها الجبلية ومناخها المعتدل طوال العام، مما يجعلها من أبرز الوجهات السياحية في السعودية', '<p class=\"\\\" msonormal\\\"\"=\"\" align=\"\\\" left\\\"\"=\"\" dir=\"\\\" rtl\\\"\"=\"\" style=\"\\\" text-align:\"=\"\" right;=\"\" margin:=\"\" 0cm=\"\" 0.6pt=\"\" 11.6pt=\"\" 0cm;=\"\" text-indent:=\"\" -0.5pt;\\\"=\"\"><br></p><p class=\"\\\" msonormal\\\"\"=\"\" align=\"\\\" left\\\"\"=\"\" dir=\"\\\" rtl\\\"\"=\"\" style=\"\\\" margin:\"=\"\" 0cm=\"\" -0.45pt=\"\" 10.05pt=\"\" 50.4pt;=\"\" text-indent:=\"\" -0.25pt;=\"\" line-height:=\"\" 14.56px;\\\"=\"\"><img src=\"\\\" ..=\"\" uploads=\"\" services=\"\" 6808ba2bac668.jpg\\\"\"=\"\" style=\"\\\" width:\"=\"\" 100%;\\\"=\"\"><img src=\"../uploads/services/6808baf636e90.jpg\" style=\"width: 100%; float: right;\" class=\"note-float-right\"><br><img src=\"../uploads/services/6808babac3d8a.jpg\" style=\"width: 726.777px; float: right;\" class=\"note-float-right\"></p>', '4839WhatsApp Image 2025-04-18 at 14.33.23_45e05112.jpg', '2025-04-23 10:04:46'),
(14, 'مدينة الخبر', 'الخبر هي مدينة سعودية تقع في المنطقة الشرقية على ساحل الخليج العربي، وتُعد من أبرز المدن الحديثة في المملكة. تتميز الخبر بتخطيطها العمراني المتطور، وشوارعها الواسعة، وكورنيشها الساحر الذي يُعد من أجمل الواجهات البحرية في السعودية', '<p><img src=\"../uploads/services/6808bc0f96d8c.jpg\" style=\"width: 100%;\"><img src=\"../uploads/services/6808bc15dae3e.jpg\" style=\"width: 726.777px;\"><br></p>', '2283WhatsApp Image 2025-04-18 at 14.33.23_45e05112.jpg', '2025-04-23 10:08:25'),
(15, 'مدينة جدة', 'ثاني أكبر مدن المملكة وميناؤها البحري الأهم على البحر الأحمر. تشتهر بجمال كورنيشها، وأسواقها الشعبية، كما أنها بوابة الحجاج إلى مكة', '<p><img src=\"../uploads/services/6808bfbee95d6.jpg\" style=\"width: 100%;\"><img src=\"../uploads/services/6808bfc7ccd97.jpg\" style=\"width: 100%;\"><br></p>', '6003banner.png', '2025-04-23 10:24:16'),
(16, 'مدينة الرياض', 'عاصمة المملكة العربية السعودية، وتُعد القلب السياسي والإداري والمالي للدولة. تتميز الرياض بكونها مدينة حديثة ذات بنية تحتية متطورة، وتضم معالم سياحية وثقافية بارزة', '<p style=\"text-align: right; \"><div style=\"text-align: left; margin-left: 25px;\"><img src=\"../uploads/services/6808bf21bbd45.jpg\" style=\"width: 100%;\"></div><img src=\"../uploads/services/6808b5e49ee01.jpg\" style=\"width: 100%; float: left;\" class=\"note-float-left\"><span style=\"font-family: \" arial=\"\" black\";\"=\"\"><b></b></span></p><p style=\"text-align: right; \"><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p>', '7622', '2025-04-23 10:21:52'),
(17, 'مدينة نيوم', 'نيوم، مدينة مستقبلية شمال غرب السعودية على البحر الأحمر، تجسد رؤية 2030 كمركز عالمي للابتكار والتقنية والاستدامة.', '<p><img src=\"../uploads/services/6808bda8c22dd.jpg\" style=\"width: 100%;\"><img src=\"../uploads/services/6808bdb2606bf.png\" style=\"width: 100%;\"><br></p>', '8654', '2025-04-23 10:15:25');

-- --------------------------------------------------------

--
-- بنية الجدول `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `port_title` varchar(500) NOT NULL,
  `port_desc` varchar(1000) NOT NULL,
  `port_detail` varchar(2000) NOT NULL,
  `ufile` varchar(1000) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `event`
--

INSERT INTO `event` (`id`, `port_title`, `port_desc`, `port_detail`, `ufile`, `updated_at`) VALUES
(5, 'ttttttttttttttttttttttttttttttttttt', 'tttttttttttttttttttttttttttttttttttttttt', 'ttttttttttttttttttttttttttttt', '9471banner.png', '2025-04-21 20:34:37'),
(6, 'Portfolio Title Must Be More Than 5 Char Length. Portfolio Detail Must Be More Than 15 Char Length.', '55555555555555555555555555555555555555', '555555555555555555555555555555555555', '1642banner.png', '2025-04-21 20:38:06');

-- --------------------------------------------------------

--
-- بنية الجدول `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `xfile` varchar(1000) NOT NULL,
  `ufile` varchar(1000) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `logo`
--

INSERT INTO `logo` (`id`, `xfile`, `ufile`, `updated_at`) VALUES
(1, '5465logo.png', '1472logo.png', '2025-04-21 13:11:56');

-- --------------------------------------------------------

--
-- بنية الجدول `siteconfig`
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
-- إرجاع أو استيراد بيانات الجدول `siteconfig`
--

INSERT INTO `siteconfig` (`id`, `site_keyword`, `site_desc`, `site_title`, `site_about`, `site_footer`, `follow_text`, `site_url`, `updated_at`) VALUES
(1, 'Church, Marketing', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit nihil tenetur minus quidem est deserunt molestias accusamus harum ullam tempore debitis et, expedita, repellat delectus aspernatur neque itaque qui quod.', 'Vogue Website', ' Young coders can use events to coordinate timing and communication between different sprites or pieces of their story. For instance, the when _ key pressed block is an event that starts code whenever the corresponding key on the keyboard is pressed.', '© 2024 All Rights Reserved', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit nihil tenetur minus quidem est deserunt molestias.', 'http://localhost:8080/vogue/', '2025-04-20 23:44:22');

-- --------------------------------------------------------

--
-- بنية الجدول `sitecontact`
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
-- إرجاع أو استيراد بيانات الجدول `sitecontact`
--

INSERT INTO `sitecontact` (`id`, `phone1`, `phone2`, `email1`, `email2`, `longitude`, `latitude`, `updated_at`) VALUES
(1, '+89 (0) 2354 5470091', '+89 (0) 2354 5470091', 'mail@company.com', 'mail@company.com', '7.099737483', '7.63734634', '2022-07-15 11:05:25');

-- --------------------------------------------------------

--
-- بنية الجدول `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `fa` varchar(150) NOT NULL,
  `social_link` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `social`
--

INSERT INTO `social` (`id`, `name`, `fa`, `social_link`) VALUES
(1, 'Facebook', 'fa-facebook', 'https://facebook.com/faithyemi'),
(2, 'Instagram', 'fa-instagram', 'https://instagram.com/faith_awolu');

-- --------------------------------------------------------

--
-- بنية الجدول `testimony`
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
-- إرجاع أو استيراد بيانات الجدول `testimony`
--

INSERT INTO `testimony` (`id`, `message`, `name`, `position`, `ufile`, `updated_at`) VALUES
(2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.', 'Yasmin Akter', 'Founder, Themeland', '5110avatar-2.png', '2022-07-17 19:41:45'),
(3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.', 'Md. Arham', 'CEO, Themeland', '4068avatar-3.png', '2022-07-17 19:48:56'),
(4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum obcaecati dignissimos quae quo ad iste ipsum officiis deleniti asperiores sit.', 'Junaid Hasan', 'CEO, Themeland', '5842avatar-1.png', '2022-07-17 19:50:39');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`) VALUES
(1, '', '', '$2y$10$dCzvlWadNEkel0bji2FFtuZko/9XvJWizyOyj0I8lC9Cg3RSm3evW'),
(2, '4545', '545@fsf.com', '$2y$10$.q8MAGOUvuFYH5zDUPP8quFvp4iCcoQHas7DprcUN4wr5EQ68kD8G'),
(3, '6868@g.com', '6868@g.com', '$2y$10$30/BUGfJNu049VrQuhR31uodzrBZQWmWI.KIjCLH6vP0RZX/whMSu'),
(4, '333@22.com', '333@22.com', '$2y$10$BeRpfFpWcUWEVffKHmuF2OfapmwbGHkAFO8BV7EnJsKF2AAi.SLd2'),
(5, 'code code code', 'code@code.com', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
