-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 10:40 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(3, 'admin1', 'admin@xx.com', '123456', '2025-04-29 21:01:22'),
(4, 'fahad', 'fa@fahad.com', '123456', '2025-04-29 21:45:03'),
(6, 'john_doe', 'john.doe@example.com', 'SecurePass123!', '2025-04-29 21:45:55'),
(7, 'jane_smith', 'jane.smith@example.com', 'P@ssw0rd2025', '2025-04-29 21:45:55'),
(8, 'michael_j', 'michael.j@example.com', 'Admin@1234', '2025-04-29 21:45:55'),
(9, 'sarah_k', 'sarah.k@example.com', 'S@rahPass99', '2025-04-29 21:45:55'),
(10, 'david_w', 'david.w@example.com', 'D@vidAdmin22', '2025-04-29 21:45:55'),
(11, 'lisa_m', 'lisa.m@example.com', 'L!saSecure33', '2025-04-29 21:45:55'),
(12, 'robert_t', 'robert.t@example.com', 'R0bert#2025', '2025-04-29 21:45:55'),
(13, 'emily_g', 'emily.g@example.com', 'E$milyPass1', '2025-04-29 21:45:55'),
(14, 'thomas_b', 'thomas.b@example.com', 'T0mAdmin!', '2025-04-29 21:45:55'),
(15, 'olivia_h', 'olivia.h@example.com', '0livia@Pass', '2025-04-29 21:45:55'),
(18, 'f1', 'f1@s.com', '123456', '2025-04-29 22:45:20'),
(19, 'fahad ali', 'fahad1@sss.com', '123456', '2025-05-01 07:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `chatbot_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(65, 'الرياض', ' عاصمة المملكة العربية السعودية، تُعد مركزًا سياسيًا وإداريًا وماليًا متطورًا', '', '', '2025-04-26 11:31:38'),
(66, 'جدة', 'ثاني أكبر مدينة في المملكة، تعتبر بوابة الحجاج إلى مكة وتتميز بكورنيشها الرائع', '', '', '2025-05-01 11:08:47'),
(67, 'أبها', 'مدينة جبلية عاصمة منطقة عسير، تتميز بمناخ معتدل وطبيعة الساحرة', '', '', '2025-05-01 13:48:38'),
(68, 'الخبر', 'مدينة ساحلية تقع في المنطقة الشرقية، تتميز بكورنيشها الجميل والمرافق الحديثة.', '', '', '2025-04-26 12:05:44'),
(69, 'نيوم', 'مدينة مبتكرة ضمن رؤية السعودية 2030، تهدف لتكون مركزًا عالميًا للابتكار', '', '', '2025-04-26 12:08:33');

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
(62, 65, 'الطريف', '111788138d5e-a74d-4fa5-978e-63f3b6b4c853.jpg', 'موقع أثري تاريخي', '2025-04-26 11:31:38'),
(63, 65, 'مركز الملك عبدالله المالي', '6514a57e100d-f191-441c-b03e-75adc551a0cc.jpg', 'مركز مالي ضخم وعصري', '2025-04-26 11:31:39'),
(64, 65, 'منحدر حافة العالم', '4340f33804f9-792f-40b1-85ce-f3a1db7609a5.jpg', 'منطقة طبيعية ذات مناظر خلابة', '2025-04-26 11:31:39'),
(65, 65, 'بوليفارد رياض سيتي', '6243c7a31a06-dd67-4d34-89e3-e77c9cec1736.jpg', 'وجهة ترفيهية وثقافية حديثة', '2025-04-26 11:31:39'),
(66, 65, 'ساوندستورم', '678e16debcf-46c6-42c4-8e38-bf9046267871.jpg', 'مهرجان موسيقي عالمي', '2025-04-26 11:31:39'),
(67, 65, 'برج المملكة', '910455e0cbd2-a4e5-4329-80f6-d6e8daeb0922.jpg', 'أحد أطول المباني في المملكة', '2025-04-26 11:31:39'),
(68, 66, 'حي البلد', '99072bd4babc-813a-471b-83ad-34e31a554dc7.jpg', 'حي تاريخي يحتفظ بعبق التراث', '2025-04-26 11:40:00'),
(69, 66, 'واجهة جدة البحرية', '3644fd8610b-7faa-43db-a421-1cd6bf2dcbc2.jpg', 'مكان سياحي ساحلي مع الكثير من الأنشطة', '2025-04-26 11:40:00'),
(70, 66, 'كورنيش جدة', '42305c804b89-3d6a-4626-9744-021410c3b26a.jpg', 'ممشى جميل على البحر', '2025-04-26 11:40:00'),
(71, 66, 'المسجد العائم', '575168d08e98-59b5-40ad-9687-037dd739e595.jpg', 'مسجد مميز بني فوق الماء', '2025-04-26 11:40:00'),
(72, 67, 'متحف فاطمة لتراث المرأة العسيرية', '7860f0d844cc-e18b-497d-b5d1-c42773fb2f32.jpg', 'متحف يبرز التراث المحلي', '2025-04-26 12:02:47'),
(73, 67, 'منتزه السحاب', '7072e701c241-7345-4dc4-91b6-128c6cff8de4.jpg', 'منتزه سياحي جبلي مع إطلالات رائعة', '2025-04-26 12:02:47'),
(74, 67, 'حديقة أبو خيال', '4681933df1d2-09c8-40e0-8e26-cb9a07cb92b5.jpg', 'حديقة طبيعية في قلب أبها', '2025-04-26 12:02:47'),
(75, 68, 'ساحل مدينة الخبر', '170095f06fa6-ad60-47d7-a763-9a84b2dd2326.jpg', 'شواطئ رملية جميلة', '2025-04-26 12:05:44'),
(76, 68, 'كورنيش الخبر', '5231c0d731f7-1273-40e5-9057-08dea56f15f4.jpg', 'ممشى ممتد على البحر مع أماكن ترفيهية', '2025-04-26 12:05:44'),
(77, 68, 'إثراء', '6527d69888a1-8cd8-4c2a-9399-ef40d6c6cc7a.jpg', 'مركز ثقافي وفني مميز', '2025-04-26 12:05:44'),
(78, 69, 'سندالة', '3632c454bd97-cf6b-4d4c-a049-871c37669c23.jpg', 'وجهة سياحية على البحر الأحمر', '2025-04-26 12:08:33'),
(79, 69, 'الشواطئ البكر', '113034007372-3210-4549-9a81-06e5552a9611.jpg', ' شواطئ طبيعية', '2025-04-26 12:08:33'),
(80, 69, 'تروجينا (Trojena)', '60318b07ae12-83ec-49a4-bf11-2884827032e0.png', 'مدينة جبلية ترفيهية ضمن مشروع نيوم', '2025-04-26 12:08:33');

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

--
-- Dumping data for table `city_hotels`
--

INSERT INTO `city_hotels` (`id`, `city_id`, `hotel_name`, `description`, `image`, `created_at`) VALUES
(6, 65, 'فندق حياة ريجنسي الرياض العليا', NULL, NULL, '2025-04-26 11:31:39'),
(7, 65, 'فندق الريتز كارلتون', NULL, NULL, '2025-04-26 11:31:39'),
(8, 65, 'فندق فورسيزونز', NULL, NULL, '2025-04-26 11:31:39'),
(9, 66, 'فندق روزوود جدة', NULL, NULL, '2025-04-26 11:40:00'),
(10, 66, 'فندق والدورف أستوريا', NULL, NULL, '2025-04-26 11:40:00'),
(11, 66, 'فندق هيلتون جدة', NULL, NULL, '2025-04-26 11:40:00'),
(12, 67, 'فندق بلو إن', NULL, NULL, '2025-04-26 12:02:47'),
(13, 67, 'فندق قصر أبها', NULL, NULL, '2025-04-26 12:02:47'),
(14, 67, 'فندق شفا أبها', NULL, NULL, '2025-04-26 12:02:47'),
(15, 68, 'فندق الميريديان الخبر', NULL, NULL, '2025-04-26 12:05:44'),
(16, 68, 'فندق سوفيتل الخبر الكورنيش', NULL, NULL, '2025-04-26 12:05:44'),
(17, 68, 'فندق موفنبيك الخبر', NULL, NULL, '2025-04-26 12:05:44'),
(18, 69, 'من المتوقع تطوير مجموعة من الفنادق الفاخرة ضمن مشروع نيوم', NULL, NULL, '2025-04-26 12:08:33');

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

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `port_title`, `port_desc`, `port_detail`, `ufile`, `updated_at`) VALUES
(7, 'استضافة حفل الافتتاح المبهر في الرياض', 'حفل عالمي في استاد الرياض بحضور قادة وفنانينعروض ثقافية وتقنيات مبهرة', ' يهدف هذا الحدث إلى تقديم صورة مشرقة عن المملكة وقدرتها التنظيمية. سيكون انطلاقة مميزة للبطولة ويعكس شغف المملكة بكرة القدم والترحيب بالزوار', '827778-142719-ksa-national-day1_700x400.jpeg', '2025-04-29 21:05:06'),
(8, ' تنظيم مهرجان ثقافي عالمي في جدة التاريخية', 'مهرجان ثقافي في جدة التاريخية طوال البطولة. معارض، حرف، أمسيات، أزياء، ومطاعم', 'يهدف هذا المهرجان إلى تعريف الزوار بالتراث الثقافي الغني للمملكة في أجواء احتفالية', '8354111451-احتفالات-السعوديين-باليوم-الوطني-الـ-90.webp', '2025-04-29 21:05:36'),
(9, 'كرة القدم من أجل المستقبل في نيوم', 'مبادرة عالمية في نيوم تركز على التنمية المستدامة والاندماج ودعم الشباب', 'تهدف هذه المبادرة إلى إظهار دور المملكة في استخدام الرياضة للتغيير الإيجابي وربط استضافة كأس العالم برؤية المملكة للمستقبل المستدام', '5040نيوم-1-1.webp', '2025-05-01 13:49:30'),
(10, ' فعاليات ترفيهية كبرى بالمدن المستضيفة', 'مناطق مشجعين واسعة في المدن المستضيفة. شاشات عملاقة، عروض فنية، ألعاب', 'هدف هذه الفعاليات إلى توفير تجربة ممتعة وحماسية للجماهير القادمة من جميع أنحاء العالم وخلق أجواء احتفالية مصاحبة للمباريات في المدن السعودية', '51052500962.jpg', '2025-04-29 21:07:09'),
(11, 'الرياضات الإلكترونية المصاحبة لكأس العالم في الدرعية', 'بطولة عالمية للرياضات الإلكترونية في الدرعية بالتزامن مع كأس العالم', 'يهدف هذا الحدث إلى استغلال شعبية الرياضات الإلكترونية وربطها بفعاليات كأس العالم، وجذب جمهور جديد والتعريف بالدرعية كوجهة تاريخية حديثة', '6732__-الإلكترونية،-ا-تاريخ-قطاع-الألعاب-والرياضات-الإلكترونية__ssict_1200_800.webp', '2025-04-29 21:08:48'),
(13, ' برنامج تطوعي واسع النطاق بمشاركة شباب سعودي وعالمي', 'برنامج تطوعي يشارك فيه شباب سعودي وعالمي في تنظيم الفعاليات', ' يهدف هذا البرنامج إلى تعزيز المشاركة المجتمعية والتبادل الثقافي بين الشباب، وتوفير تجربة قيمة للمتطوعين تساهم في تطوير مهاراتهم وبناء جسور التواصل بين الثقافات', '867inner-banner.webp', '2025-04-29 21:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `message` varchar(300) NOT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `ufile` varchar(1000) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `message`, `name`, `position`, `ufile`, `updated_at`) VALUES
(7, 'تجربة كأس العالم في السعودية كانت استثنائية بكل المقاييس. التنظيم كان على مستوى عالمي، والروح الرياضية بين الجماهير كانت رائعة. المملكة قدمت استضافة مميزة، والفعاليات كانت تليق بحجم الحدث', 'فهد السبيعي', 'مشجع رياضي', '680c806321955.jpg', '2025-04-26 06:42:43'),
(9, 'كأس العالم في السعودية كان لحظة تاريخية. المملكة أظهرت للعالم قدرتها على تنظيم أكبر الأحداث الرياضية. كل شيء كان منظم بدقة، والشعب السعودي كان مضيافًا، والاحتفالات كانت ممتعة للغاية', 'نورة الحربي', ' إعلامية', '680c8233c748b.jpg', '2025-04-26 06:50:27'),
(10, 'كلما أتذكر كأس العالم في السعودية، أتذكر كيف كانت المملكة فخورة باستضافة هذا الحدث الكبير. من الملاعب الحديثة إلى التقنيات المتقدمة، كل شيء كان مرتب بشكل يعكس تطور كبرى مدن المملكة.', 'عبد الله القحطاني', 'مهندس', '680c826f26179.jpg', '2025-04-26 06:51:27'),
(11, 'كلما أتذكر كأس العالم في السعودية، أتذكر كيف كانت المملكة فخورة باستضافة هذا الحدث الكبير. من الملاعب الحديثة إلى التقنيات المتقدمة، كل شيء كان مرتب بشكل يعكس تطور كبرى مدن المملكة.', 'عبد الله القحطاني', 'مهندس', '680c8274a25b8.jpg', '2025-04-26 06:51:32'),
(12, 'الرياضة في السعودية أظهرت لنا جانبًا جديدًا من حب الوطن والإنجازات. كأس العالم في السعودية ما كان مجرد مباراة، كان مناسبة لترسيخ مكانة المملكة في قلب العالم الرياضي. كنا فخورين بكل التفاصيل', 'سارة الزهراني', 'طالبّة', '680c828d66256.jpg', '2025-04-26 06:51:57'),
(13, 'كأس العالم في السعودية كان نقطة تحول كبيرة في مسيرة الرياضة المحلية. رؤية المملكة 2030 حققت نجاحًا كبيرًا، وتنظيم كأس العالم في بلادنا كان بمثابة خطوة عملاقة نحو مستقبل مشرق للرياضة.', 'يوسف المالكي', 'رجل أعمال', '680c82a96ea8c.jpg', '2025-04-26 06:52:25'),
(21, 'الرياضة في السعودية أظهرت لنا جانبًا جديدًا من حب الوطن والإنجازات. كأس العالم في السعودية ما كان مجرد مباراة، كان مناسبة لترسيخ مكانة المملكة في قلب العالم الرياضي. كنا فخورين بكل التفاصيل', 'فهد مكين', 'محلل نظم', '6815294f1279a.jpg', '2025-05-02 20:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `transfer_id` int(11) NOT NULL,
  `type` enum('car','bus','train','') NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `capacity` int(11) NOT NULL,
  `availability` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `role`) VALUES
(6, 'فهد علي', 'ifhadii@edu.sa', '$2y$10$L5w.bHu3VlM1IcJPDg5BOuJIpFT61b0Lp5otQgmvufAc.W3ych/Fi', 'user'),
(8, 'fahad', 'admin@fa.com', '$2y$10$QGlBkDJBuQ4qqUN4DGDB0eNM0E6qA9IvUoMmu3pmsRp6R7XUN442W', 'user'),
(10, 'fahad1', 'fahad1@s.com', '$2y$10$Sl4coYM9.ft05wgz3C0dHuWSPWwfZcEZEs2rsrahxw7SxYeGBzJMO', 'user'),
(12, 'fahad ali', 'ifhadii@one.sa', '$2y$10$80Xwq/8I2imFhS0PPAKe/.H5aDI4Uic4AcEl7XKll1ysxyYSSJKUS', 'admin'),
(14, 'أحمد محمد', 'ahmed.admin@gmail.com', '$2y$10$9I3YbLpNxVZQwQWkDvJQwO7XmRkz0fY1hG2uK9nLl3BvJ5T6yH7dS', 'admin'),
(15, 'سارة خالد', 'sara.admin@gmail.com', '$2y$10$2Tk7mV9sRrN1XpF5qH8rE.1LbYc3M9dW2uJ4nKl5vB6yH7fD8gS', 'admin'),
(16, 'علي حسن', 'ali.admin@gmail.com', '$2y$10$7Nm8lK9jRtF3XwD2vH5sE.4MbYc6N9eW2uJ4nKl5vB6yH7fD8gS', 'admin'),
(17, 'نورة عبدالله', 'nora.admin@gmail.com', '$2y$10$3Pq4rK9tYuI2XwE1vH5sD.5NcYf7M9eW2uJ4nKl5vB6yH7fD8gS', 'admin'),
(18, 'محمد سعيد', 'mohammed.admin@gmail.com', '$2y$10$8Lk9mN0oPqR2S3T4uV5wX.6ZcXf7M9eW2uJ4nKl5vB6yH7fD8gS', 'admin'),
(19, 'لينا فارس', 'lina.admin@gmail.com', '$2y$10$1Qw2eR3tY4uI5oP6a7sD.9KjLmN0oP1q2R3tY4uI5oP6a7sD8f', 'admin'),
(20, 'خالد ناصر', 'khaled.admin@gmail.com', '$2y$10$4XcV5bN6mQ7wE8rT9yU0i.1ZaXc3V4bN6mQ7wE8rT9yU0i1Z2x', 'admin'),
(21, 'هبة راشد', 'heba.admin@gmail.com', '$2y$10$5Yd6eF8gH9iJ0kL1mN2oP.3QrS4tU5vW6xY7zA8B9C0D1E2F3G', 'admin'),
(22, 'طارق وليد', 'tariq.admin@gmail.com', '$2y$10$6Zf7gH8iJ9kL0mN1oP2qR.4Ss5tU6vW7xY8zA9B0C1D2E3F4G', 'admin'),
(23, 'ياسمين كمال', 'yasmin.admin@gmail.com', '$2y$10$7Ag8hB9iC0D1E2F3G4H5j.6KkL7mN8oP9qR0sT1uV2wX3yZ4a', 'admin'),
(24, 'محمود علي', 'mahmoud.user@gmail.com', '$2y$10$Sl4coYM9.ft05wgz3C0dHuWSPWwfZcEZEs2rsrahxw7SxYeGBzJMO', 'user'),
(25, 'سلمى أحمد', 'salma.user@gmail.com', '$2y$10$80Xwq/8I2imFhS0PPAKe/.H5aDI4Uic4AcEl7XKll1ysxyYSSJKUS', 'user'),
(26, 'يوسف خالد', 'yousef.user@gmail.com', '$2y$10$L5w.bHu3VlM1IcJPDg5BOuJIpFT61b0Lp5otQgmvufAc.W3ych/Fi', 'user'),
(27, 'أميرة محمد', 'amira.user@gmail.com', '$2y$10$QGlBkDJBuQ4qqUN4DGDB0eNM0E6qA9IvUoMmu3pmsRp6R7XUN442W', 'user'),
(28, 'نادر سامي', 'nader.user@gmail.com', '$2y$10$Sl4coYM9.ft05wgz3C0dHuWSPWwfZcEZEs2rsrahxw7SxYeGBzJMO', 'user'),
(29, 'ريم فاروق', 'reem.user@gmail.com', '$2y$10$80Xwq/8I2imFhS0PPAKe/.H5aDI4Uic4AcEl7XKll1ysxyYSSJKUS', 'user'),
(30, 'وسام نبيل', 'wessam.user@gmail.com', '$2y$10$L5w.bHu3VlM1IcJPDg5BOuJIpFT61b0Lp5otQgmvufAc.W3ych/Fi', 'user'),
(31, 'هديل عمر', 'hadeel.user@gmail.com', '$2y$10$QGlBkDJBuQ4qqUN4DGDB0eNM0E6qA9IvUoMmu3pmsRp6R7XUN442W', 'user'),
(32, 'باسل وائل', 'basel.user@gmail.com', '$2y$10$Sl4coYM9.ft05wgz3C0dHuWSPWwfZcEZEs2rsrahxw7SxYeGBzJMO', 'user'),
(33, 'دانا رامي', 'dana.user@gmail.com', '$2y$10$80Xwq/8I2imFhS0PPAKe/.H5aDI4Uic4AcEl7XKll1ysxyYSSJKUS', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `review`
--
ALTER TABLE `review`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `city_cards`
--
ALTER TABLE `city_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `city_hotels`
--
ALTER TABLE `city_hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
