-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2025 at 02:16 PM
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
(13, 'مدينة أبها', 'أبها هي مدينة تقع جنوب غرب المملكة العربية السعودية، وهي عاصمة منطقة عسير الإدارية. تُعرف أبها بلقب \"عروس الجبل\" نظرًا لطبيعتها الجبلية ومناخها المعتدل طوال العام، مما يجعلها من أبرز الوجهات السياحية في السعودية', '<p class=\"\\\" msonormal\\\"\"=\"\" align=\"\\\" left\\\"\"=\"\" dir=\"\\\" rtl\\\"\"=\"\" style=\"\\\" text-align:\"=\"\" right;=\"\" margin:=\"\" 0cm=\"\" 0.6pt=\"\" 11.6pt=\"\" 0cm;=\"\" text-indent:=\"\" -0.5pt;\\\"=\"\"><br></p><p class=\"\\\" msonormal\\\"\"=\"\" align=\"\\\" left\\\"\"=\"\" dir=\"\\\" rtl\\\"\"=\"\" style=\"\\\" margin:\"=\"\" 0cm=\"\" -0.45pt=\"\" 10.05pt=\"\" 50.4pt;=\"\" text-indent:=\"\" -0.25pt;=\"\" line-height:=\"\" 14.56px;\\\"=\"\"><img src=\"\\\" ..=\"\" uploads=\"\" services=\"\" 6808ba2bac668.jpg\\\"\"=\"\" style=\"\\\" width:\"=\"\" 100%;\\\"=\"\"><img src=\"../uploads/services/6808baf636e90.jpg\" style=\"width: 100%; float: right;\" class=\"note-float-right\"><br><img src=\"../uploads/services/6808babac3d8a.jpg\" style=\"width: 726.777px; float: right;\" class=\"note-float-right\"></p>', '4839WhatsApp Image 2025-04-18 at 14.33.23_45e05112.jpg', '2025-04-23 10:04:46'),
(14, 'مدينة الخبر', 'الخبر هي مدينة سعودية تقع في المنطقة الشرقية على ساحل الخليج العربي، وتُعد من أبرز المدن الحديثة في المملكة. تتميز الخبر بتخطيطها العمراني المتطور، وشوارعها الواسعة، وكورنيشها الساحر الذي يُعد من أجمل الواجهات البحرية في السعودية', '<p><img src=\"../uploads/services/6808bc0f96d8c.jpg\" style=\"width: 100%;\"><img src=\"../uploads/services/6808bc15dae3e.jpg\" style=\"width: 726.777px;\"><br></p>', '2283WhatsApp Image 2025-04-18 at 14.33.23_45e05112.jpg', '2025-04-23 10:08:25'),
(15, 'مدينة جدة', 'ثاني أكبر مدن المملكة وميناؤها البحري الأهم على البحر الأحمر. تشتهر بجمال كورنيشها، وأسواقها الشعبية، كما أنها بوابة الحجاج إلى مكة', '<p><img src=\"../uploads/services/6808bfbee95d6.jpg\" style=\"width: 100%;\"><img src=\"../uploads/services/6808bfc7ccd97.jpg\" style=\"width: 100%;\"><br></p>', '6003banner.png', '2025-04-23 10:24:16'),
(16, 'مدينة الرياض', 'عاصمة المملكة العربية السعودية، وتُعد القلب السياسي والإداري والمالي للدولة. تتميز الرياض بكونها مدينة حديثة ذات بنية تحتية متطورة، وتضم معالم سياحية وثقافية بارزة', '<p style=\"text-align: right; \"><div style=\"text-align: left; margin-left: 25px;\"><img src=\"../uploads/services/6808bf21bbd45.jpg\" style=\"width: 100%;\"></div><img src=\"../uploads/services/6808b5e49ee01.jpg\" style=\"width: 100%; float: left;\" class=\"note-float-left\"><span style=\"font-family: \" arial=\"\" black\";\"=\"\"><b></b></span></p><p style=\"text-align: right; \"><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p><p><br></p>', '7622', '2025-04-23 10:21:52'),
(17, 'مدينة نيوم', 'نيوم، مدينة مستقبلية شمال غرب السعودية على البحر الأحمر، تجسد رؤية 2030 كمركز عالمي للابتكار والتقنية والاستدامة.', '<p><img src=\"../uploads/services/6808bda8c22dd.jpg\" style=\"width: 100%;\"><img src=\"../uploads/services/6808bdb2606bf.png\" style=\"width: 100%;\"><br></p>', '8654', '2025-04-23 10:15:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
