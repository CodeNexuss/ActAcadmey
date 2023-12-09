-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2020 at 11:11 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Udify`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `attempt_id` int(11) DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `q_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `q_score` decimal(5,1) DEFAULT NULL,
  `r_score` decimal(5,1) DEFAULT NULL,
  `is_correct` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `quiz_id`, `question_id`, `user_id`, `attempt_id`, `answer`, `q_type`, `q_score`, `r_score`, `is_correct`) VALUES
(1, 40, 2, 3, 1, '4', 'radio', '2.0', '2.0', 1),
(2, 40, 7, 3, 1, 'Deniel Frog', 'text', '5.0', '4.0', 1),
(3, 40, 4, 3, 1, '9', 'radio', '3.0', '3.0', 1),
(4, 40, 8, 3, 1, '[\"14\",\"17\"]', 'checkbox', '3.0', '3.0', 1),
(5, 40, 9, 3, 1, 'Drawing and Art', 'text', '2.0', '0.0', 0),
(6, 39, 11, 3, 3, '[\"18\"]', 'checkbox', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `assignment_submissions`
--

DROP TABLE IF EXISTS `assignment_submissions`;
CREATE TABLE `assignment_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `text_submission` longtext COLLATE utf8mb4_unicode_ci,
  `earned_numbers` decimal(8,2) DEFAULT NULL,
  `instructors_note` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_evaluated` tinyint(4) DEFAULT '0',
  `evaluated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assignment_submissions`
--

INSERT INTO `assignment_submissions` (`id`, `user_id`, `course_id`, `assignment_id`, `instructor_id`, `text_submission`, `earned_numbers`, `instructors_note`, `status`, `is_evaluated`, `evaluated_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 17, 1, '<blockquote>\r\n<p><strong>Lorem ipsum dolor sit amet,</strong> consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. <em><u>Duis aute irure dolor in reprehenderit</u></em> in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n</blockquote>', '8.00', '<p><strong>Duis aute irure dolor in reprehenderit in voluptate velit ess</strong>e cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>', 'submitted', 1, '2020-05-01 04:41:51', '2020-04-30 12:40:58', '2020-05-01 04:41:51'),
(2, 3, 1, 17, NULL, '<p>200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc. Updated</p>', NULL, NULL, 'submitted', 0, NULL, '2020-05-27 21:05:55', '2020-05-27 21:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `belongs_course_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `assignment_submission_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `media_id` int(11) DEFAULT NULL,
  `hash_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `course_id`, `belongs_course_id`, `content_id`, `assignment_submission_id`, `user_id`, `media_id`, `hash_id`) VALUES
(1, NULL, 1, 8, NULL, 1, 1, 'wkagk6xabj4ez0982263ecequlvv5ns9'),
(2, NULL, 1, 8, NULL, 1, 2, '9mdjy8uorvq34098226vyeishsffgnuf'),
(3, NULL, 1, 8, NULL, 1, 3, 'l1zqbq58wb6zf098226j91wzdgzajeav'),
(4, NULL, 1, 9, NULL, 1, 2, '8zlha1cpiuvmz1729508tsmqsbgdan7a'),
(5, NULL, 1, 9, NULL, 1, 3, 'jaasxneughh0w172950rbd2prtcwdrqb'),
(7, NULL, 1, 17, NULL, 1, 3, 'mimwmmgija4tp183725twfj2zye1ogoz'),
(8, NULL, 1, 17, NULL, 1, 2, 'rkljevpfhtqas188881mdpxkia8wiihq'),
(9, NULL, NULL, NULL, 1, 1, 7, 'mf98qurkrdsmt278629hztsxcrfjgzvc'),
(10, NULL, NULL, NULL, 1, 1, 1, '3u7er3tvgt0v22786292fvpscv09binw'),
(11, NULL, NULL, NULL, 1, 1, 3, 'y4cggrukwh9jr2786298jdaz2lhcicly'),
(12, NULL, 3, 19, NULL, 1, 8, 'cunixlodrvegr765659sbzlyy1iqnykb'),
(13, NULL, 10, 28, NULL, 6, 19, 'aqwiu9g2l9led297531be2v8o4o21beu'),
(14, NULL, 10, 28, NULL, 6, 20, 'lnvzewr1ocv5f297531oukyakmch5sxi'),
(15, NULL, 10, 30, NULL, 6, 20, 'awb0gwlx2i1tw297641tzsipm3xh760o'),
(16, NULL, NULL, NULL, 2, 3, 17, 'xvqe2l9vq3op3613584a83xenpln4fgr');

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

DROP TABLE IF EXISTS `attempts`;
CREATE TABLE `attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reviewer_id` int(11) DEFAULT NULL,
  `questions_limit` int(11) DEFAULT NULL,
  `total_answered` int(11) DEFAULT NULL,
  `total_scores` decimal(5,1) DEFAULT NULL,
  `earned_scores` decimal(5,1) DEFAULT NULL,
  `passing_percent` int(11) DEFAULT NULL,
  `earned_percent` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quiz_gradable` tinyint(4) DEFAULT '0',
  `is_reviewed` tinyint(4) DEFAULT '0',
  `ended_at` timestamp NULL DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `passed` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `course_id`, `quiz_id`, `user_id`, `reviewer_id`, `questions_limit`, `total_answered`, `total_scores`, `earned_scores`, `passing_percent`, `earned_percent`, `status`, `quiz_gradable`, `is_reviewed`, `ended_at`, `reviewed_at`, `passed`, `created_at`, `updated_at`) VALUES
(1, 11, 40, 3, 5, 5, 5, '15.0', '12.0', 60, 80, 'finished', 1, 1, '2020-05-20 19:12:27', '2020-05-21 09:03:07', 1, '2020-05-19 18:31:24', '2020-05-21 09:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(11) DEFAULT '0',
  `thumbnail_id` int(11) DEFAULT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `step` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `slug`, `category_id`, `thumbnail_id`, `icon_class`, `step`, `status`) VALUES
(1, 1, 'Development', 'development', 0, NULL, 'la-terminal', 0, 1),
(2, 1, 'Web Development', 'web-development', 1, NULL, 'la-internet-explorer', 1, 1),
(3, 1, 'Data Science', 'data-science', 1, NULL, 'la-database', 1, 1),
(4, 1, 'Business', 'business', 0, NULL, 'la-bar-chart', 0, 1),
(5, 1, 'Finance', 'finance', 4, NULL, 'la-wallet', 1, 1),
(6, 1, 'Programming Languages', 'programming-languages', 1, NULL, 'la-code', 1, 1),
(7, 1, 'PHP', 'php', 6, NULL, '0', 2, 1),
(8, 1, 'Python', 'python', 6, NULL, '0', 2, 1),
(9, 1, 'Finance & Accounting', 'finance-accounting', 0, NULL, 'la-wallet', 0, 1),
(10, 1, 'IT & Software', 'it-software', 0, NULL, 'la-tv', 0, 1),
(11, 1, 'Office Productivity', 'office-productivity', 0, NULL, 'la-clipboard-list', 0, 1),
(12, 1, 'Personal Development', 'personal-development', 0, NULL, 'la-book-reader', 0, 1),
(13, 1, 'Design', 'design', 0, NULL, 'la-pencil-ruler', 0, 1),
(14, 1, 'Marketing', 'marketing', 0, NULL, 'la-bullseye', 0, 1),
(15, 1, 'Lifestyle', 'lifestyle', 0, NULL, 'la-person-booth', 0, 1),
(16, 1, 'Photography', 'photography', 0, NULL, 'la-camera-retro', 0, 1),
(17, 1, 'Health & Fitness', 'health-fitness', 0, NULL, 'la-heartbeat', 0, 1),
(18, 1, 'Music', 'music', 0, NULL, 'la-music', 0, 1),
(19, 1, 'Entrepreneurship', 'entrepreneurship', 4, NULL, '0', 1, 1),
(20, 1, 'Communications', 'communications', 4, NULL, '0', 1, 1),
(21, 1, 'Management', 'management', 4, NULL, '0', 1, 1),
(22, 1, 'Sales', 'sales', 4, NULL, '0', 1, 1),
(23, 1, 'Strategy', 'strategy', 4, NULL, '0', 1, 1),
(24, 1, 'Operations', 'operations', 4, NULL, '0', 1, 1),
(25, 1, 'Project Management', 'project-management', 4, NULL, '0', 1, 1),
(26, 1, 'Business Law', 'business-law', 4, NULL, '0', 1, 1),
(27, 1, 'Data & Analytics', 'data-analytics', 4, NULL, '0', 1, 1),
(28, 1, 'Home Business', 'home-business', 4, NULL, '0', 1, 1),
(29, 1, 'Human Resources', 'human-resources', 4, NULL, '0', 1, 1),
(30, 1, 'Industry', 'industry', 4, NULL, '0', 1, 1),
(31, 1, 'Media', 'media', 4, NULL, '0', 1, 1),
(32, 1, 'Real Estate', 'real-estate', 4, NULL, '0', 1, 1),
(33, 1, 'Other', 'other', 4, NULL, '0', 1, 1),
(34, 1, 'Mobile Apps', 'mobile-apps', 1, NULL, '0', 1, 1),
(35, 1, 'Game Development', 'game-development', 1, NULL, '0', 1, 1),
(36, 1, 'Databases', 'databases', 1, NULL, '0', 1, 1),
(37, 1, 'Software Testing', 'software-testing', 1, NULL, '0', 1, 1),
(40, 1, 'Java', 'java', 6, NULL, NULL, 2, 1),
(47, 1, 'Software Engineering', 'software-engineering', 1, NULL, '0', 1, 1),
(48, 1, 'Development Tools', 'development-tools', 1, NULL, '0', 1, 1),
(49, 1, 'E-Commerce', 'e-commerce', 1, NULL, '0', 1, 1),
(50, 1, 'Accounting & Bookkeeping', 'accounting-bookkeeping', 9, NULL, '0', 1, 1),
(51, 1, 'Compliance', 'compliance', 9, NULL, '0', 1, 1),
(52, 1, 'Cryptocurrency & Blockchain', 'cryptocurrency-blockchain', 9, NULL, '0', 1, 1),
(53, 1, 'Economics', 'economics', 9, NULL, '0', 1, 1),
(54, 1, 'Finance', 'finance-1', 9, NULL, '0', 1, 1),
(55, 1, 'Finance Cert & Exam Prep', 'finance-cert-exam-prep', 9, NULL, '0', 1, 1),
(56, 1, 'Financial Modeling & Analysis', 'financial-modeling-analysis', 9, NULL, '0', 1, 1),
(57, 1, 'Investing & Trading', 'investing-trading', 9, NULL, '0', 1, 1),
(68, 1, 'Money Management Tools', 'money-management-tools', 9, NULL, '0', 1, 1),
(69, 1, 'Taxes', 'taxes', 9, NULL, '0', 1, 1),
(70, 1, 'Other Finance & Economics', 'other-finance-economics', 9, NULL, '0', 1, 1),
(71, 1, 'IT Certification', 'it-certification', 10, NULL, '0', 1, 1),
(72, 1, 'Network & Security', 'network-security', 10, NULL, '0', 1, 1),
(73, 1, ' Hardware', 'hardware', 10, NULL, NULL, 1, 1),
(75, 1, ' PLC', 'plc', 73, NULL, NULL, 2, 1),
(76, 1, ' Arduino', 'arduino', 73, NULL, NULL, 2, 1),
(77, 1, ' Microcontroller', 'microcontroller', 73, NULL, NULL, 2, 1),
(78, 1, ' Electronics', 'electronics', 73, NULL, NULL, 2, 1),
(79, 1, ' Raspberry Pi', 'raspberry-pi', 73, NULL, NULL, 2, 1),
(80, 1, ' Embedded Systems', 'embedded-systems', 73, NULL, NULL, 2, 1),
(81, 1, ' Embedded C', 'embedded-c', 73, NULL, NULL, 2, 1),
(82, 1, ' SCADA', 'scada', 73, NULL, NULL, 2, 1),
(83, 1, ' FPGA', 'fpga', 73, NULL, NULL, 2, 1),
(84, 1, 'Operating Systems', 'operating-systems', 10, NULL, '0', 1, 1),
(85, 1, 'Other', 'other-1', 10, NULL, '0', 1, 1),
(86, 1, 'Microsoft', 'microsoft', 11, NULL, '0', 1, 1),
(87, 1, 'Apple', 'apple', 11, NULL, '0', 1, 1),
(88, 1, 'Google', 'google', 11, NULL, '0', 1, 1),
(89, 1, 'SAP', 'sap', 11, NULL, '0', 1, 1),
(90, 1, 'Oracle', 'oracle', 11, NULL, '0', 1, 1),
(91, 1, 'Personal Transformation', 'personal-transformation', 12, NULL, '0', 1, 1),
(92, 1, 'Productivity', 'productivity', 12, NULL, '0', 1, 1),
(93, 1, 'Leadership', 'leadership', 12, NULL, '0', 1, 1),
(94, 1, 'Personal Finance', 'personal-finance', 12, NULL, '0', 1, 1),
(95, 1, 'Career Development', 'career-development', 12, NULL, '0', 1, 1),
(96, 1, 'Parenting & Relationships', 'parenting-relationships', 12, NULL, '0', 1, 1),
(97, 1, 'Happiness', 'happiness', 12, NULL, '0', 1, 1),
(98, 1, 'Religion & Spirituality', 'religion-spirituality', 12, NULL, '0', 1, 1),
(99, 1, 'Personal Brand Building', 'personal-brand-building', 12, NULL, '0', 1, 1),
(100, 1, 'Creativity', 'creativity', 12, NULL, '0', 1, 1),
(101, 1, 'Influence', 'influence', 12, NULL, '0', 1, 1),
(102, 1, 'Self Esteem', 'self-esteem', 12, NULL, '0', 1, 1),
(103, 1, 'Stress Management', 'stress-management', 12, NULL, '0', 1, 1),
(104, 1, 'Memory & Study Skills', 'memory-study-skills', 12, NULL, '0', 1, 1),
(105, 1, 'Motivation', 'motivation', 12, NULL, '0', 1, 1),
(106, 1, 'Other', 'other-2', 12, NULL, '0', 1, 1),
(107, 1, 'Web Design', 'web-design', 13, NULL, '0', 1, 1),
(108, 1, 'Graphic Design', 'graphic-design', 13, NULL, '0', 1, 1),
(109, 1, 'Design Tools', 'design-tools', 13, NULL, '0', 1, 1),
(110, 1, 'User Experience', 'user-experience', 13, NULL, '0', 1, 1),
(111, 1, 'Game Design', 'game-design', 13, NULL, '0', 1, 1),
(112, 1, 'Design Thinking', 'design-thinking', 13, NULL, '0', 1, 1),
(113, 1, '3D & Animation', '3d-animation', 13, NULL, '0', 1, 1),
(114, 1, 'Fashion', 'fashion', 13, NULL, '0', 1, 1),
(115, 1, 'Architectural Design', 'architectural-design', 13, NULL, '0', 1, 1),
(116, 1, 'Interior Design', 'interior-design', 13, NULL, '0', 1, 1),
(117, 1, 'Digital Marketing', 'digital-marketing', 14, NULL, '0', 1, 1),
(118, 1, 'Search Engine Optimization', 'search-engine-optimization', 14, NULL, '0', 1, 1),
(119, 1, 'Social Media Marketing', 'social-media-marketing', 14, NULL, '0', 1, 1),
(120, 1, 'Branding', 'branding', 14, NULL, '0', 1, 1),
(121, 1, 'Marketing Fundamentals', 'marketing-fundamentals', 14, NULL, '0', 1, 1),
(122, 1, 'Analytics & Automation', 'analytics-automation', 14, NULL, '0', 1, 1),
(123, 1, 'Public Relations', 'public-relations', 14, NULL, '0', 1, 1),
(124, 1, 'Advertising', 'advertising', 14, NULL, '0', 1, 1),
(125, 1, 'Video & Mobile Marketing', 'video-mobile-marketing', 14, NULL, '0', 1, 1),
(126, 1, 'Content Marketing', 'content-marketing', 14, NULL, '0', 1, 1),
(127, 1, 'Growth Hacking', 'growth-hacking', 14, NULL, '0', 1, 1),
(128, 1, 'Affiliate Marketing', 'affiliate-marketing', 14, NULL, '0', 1, 1),
(129, 1, 'Product Marketing', 'product-marketing', 14, NULL, '0', 1, 1),
(130, 1, 'Arts & Crafts', 'arts-crafts', 15, NULL, '0', 1, 1),
(131, 1, 'Food & Beverage', 'food-beverage', 15, NULL, '0', 1, 1),
(132, 1, 'Beauty & Makeup', 'beauty-makeup', 15, NULL, '0', 1, 1),
(133, 1, 'Travel', 'travel', 15, NULL, '0', 1, 1),
(134, 1, 'Gaming', 'gaming', 15, NULL, '0', 1, 1),
(135, 1, 'Home Improvement', 'home-improvement', 15, NULL, '0', 1, 1),
(136, 1, 'Pet Care & Training', 'pet-care-training', 15, NULL, '0', 1, 1),
(144, 1, 'Fitness', 'fitness', 17, NULL, '0', 1, 1),
(145, 1, 'General Health', 'general-health', 17, NULL, '0', 1, 1),
(146, 1, 'Sports', 'sports', 17, NULL, '0', 1, 1),
(147, 1, 'Nutrition', 'nutrition', 17, NULL, '0', 1, 1),
(148, 1, 'Yoga', 'yoga', 17, NULL, '0', 1, 1),
(149, 1, 'Mental Health', 'mental-health', 17, NULL, '0', 1, 1),
(150, 1, 'Dieting', 'dieting', 17, NULL, '0', 1, 1),
(151, 1, 'Self Defense', 'self-defense', 17, NULL, '0', 1, 1),
(152, 1, 'Safety & First Aid', 'safety-first-aid', 17, NULL, '0', 1, 1),
(153, 1, 'Dance', 'dance', 17, NULL, '0', 1, 1),
(154, 1, 'Meditation', 'meditation', 17, NULL, '0', 1, 1),
(155, 1, 'Digital Photography', 'digital-photography', 16, NULL, '0', 1, 1),
(156, 1, 'Photography Fundamentals', 'photography-fundamentals', 16, NULL, '0', 1, 1),
(157, 1, 'Portraits', 'portraits', 16, NULL, '0', 1, 1),
(158, 1, 'Photography Tools', 'photography-tools', 16, NULL, '0', 1, 1),
(159, 1, 'Commercial Photography', 'commercial-photography', 16, NULL, '0', 1, 1),
(160, 1, 'Video Design', 'video-design', 16, NULL, '0', 1, 1),
(161, 1, ' React', 'react', 2, NULL, NULL, 2, 1),
(162, 1, ' Angular', 'angular', 2, NULL, NULL, 2, 1),
(163, 1, ' CSS', 'css', 2, NULL, NULL, 2, 1),
(164, 1, ' Node.Js', 'nodejs', 2, NULL, NULL, 2, 1),
(165, 1, ' WordPress', 'wordpress', 2, NULL, NULL, 2, 1),
(167, 1, 'Machine Learning', 'machine-learning', 3, NULL, NULL, 2, 1),
(168, 1, ' Deep Learning', 'deep-learning', 3, NULL, NULL, 2, 1),
(169, 1, ' Data Analysis', 'data-analysis', 3, NULL, NULL, 2, 1),
(170, 1, ' Artificial Intelligence', 'artificial-intelligence', 3, NULL, NULL, 2, 1),
(171, 1, ' R', 'r', 3, NULL, NULL, 2, 1),
(172, 1, ' TensorFlow', 'tensorflow', 3, NULL, NULL, 2, 1),
(173, 1, ' Neural Networks', 'neural-networks', 3, NULL, NULL, 2, 1),
(174, 1, 'Android Development', 'android-development', 34, NULL, NULL, 2, 1),
(175, 1, ' iOS Development', 'ios-development', 34, NULL, NULL, 2, 1),
(176, 1, ' Google Flutter', 'google-flutter', 34, NULL, NULL, 2, 1),
(177, 1, ' Swift', 'swift', 34, NULL, NULL, 2, 1),
(178, 1, ' React Native', 'react-native', 34, NULL, NULL, 2, 1),
(179, 1, ' Dart Programming Language', 'dart-programming-language', 34, NULL, NULL, 2, 1),
(180, 1, ' Mobile Development', 'mobile-development', 34, NULL, NULL, 2, 1),
(181, 1, ' Kotlin', 'kotlin', 34, NULL, NULL, 2, 1),
(182, 1, ' Ionic', 'ionic', 34, NULL, NULL, 2, 1),
(183, 1, 'C#', 'c', 6, NULL, NULL, 2, 1),
(184, 1, ' C++', 'c-1', 6, NULL, NULL, 2, 1),
(185, 1, ' React', 'react-1', 6, NULL, NULL, 2, 1),
(186, 1, ' JavaScript', 'javascript', 6, NULL, NULL, 2, 1),
(187, 1, ' C', 'c-2', 6, NULL, NULL, 2, 1),
(188, 1, ' Spring Framework', 'spring-framework', 6, NULL, NULL, 2, 1),
(189, 1, ' Go Programming Language', 'go-programming-language', 6, NULL, NULL, 2, 1),
(190, 1, 'Unity', 'unity', 35, NULL, NULL, 2, 1),
(191, 1, ' C#', 'c-3', 35, NULL, NULL, 2, 1),
(192, 1, ' Game Development Fundamentals', 'game-development-fundamentals', 35, NULL, NULL, 2, 1),
(193, 1, ' Unreal Engine', 'unreal-engine', 35, NULL, NULL, 2, 1),
(194, 1, ' 3D Game Development', '3d-game-development', 35, NULL, NULL, 2, 1),
(195, 1, ' C++', 'c-4', 35, NULL, NULL, 2, 1),
(196, 1, ' 2D Game Development', '2d-game-development', 35, NULL, NULL, 2, 1),
(197, 1, ' Unreal Engine Blueprints', 'unreal-engine-blueprints', 35, NULL, NULL, 2, 1),
(198, 1, ' Mobile Game Development', 'mobile-game-development', 35, NULL, NULL, 2, 1),
(199, 1, 'SQL', 'sql', 36, NULL, NULL, 2, 1),
(200, 1, ' MySQL', 'mysql', 36, NULL, NULL, 2, 1),
(201, 1, ' Oracle SQL', 'oracle-sql', 36, NULL, NULL, 2, 1),
(202, 1, ' Oracle Certification', 'oracle-certification', 36, NULL, NULL, 2, 1),
(203, 1, ' MongoDB', 'mongodb', 36, NULL, NULL, 2, 1),
(204, 1, ' Apache Kafka', 'apache-kafka', 36, NULL, NULL, 2, 1),
(205, 1, ' SQL Server', 'sql-server', 36, NULL, NULL, 2, 1),
(206, 1, ' Database Management', 'database-management', 36, NULL, NULL, 2, 1),
(207, 1, ' Database Programming', 'database-programming', 36, NULL, NULL, 2, 1),
(216, 1, 'Selenium WebDriver', 'selenium-webdriver', 37, NULL, NULL, 2, 1),
(217, 1, ' Java - Testing', 'java-testing', 37, NULL, NULL, 2, 1),
(218, 1, ' Selenium Testing Framework', 'selenium-testing-framework', 37, NULL, NULL, 2, 1),
(219, 1, ' Automation Testing', 'automation-testing', 37, NULL, NULL, 2, 1),
(220, 1, ' API Testing', 'api-testing', 37, NULL, NULL, 2, 1),
(221, 1, ' REST Assured', 'rest-assured', 37, NULL, NULL, 2, 1),
(222, 1, ' Python - Testing', 'python-testing', 37, NULL, NULL, 2, 1),
(223, 1, ' Automation', 'automation', 37, NULL, NULL, 2, 1),
(224, 1, 'AWS Certification', 'aws-certification', 47, NULL, NULL, 2, 1),
(225, 1, ' Professional Scrum Master (PSM)', 'professional-scrum-master-psm', 47, NULL, NULL, 2, 1),
(226, 1, ' Interviewing Skills', 'interviewing-skills', 47, NULL, NULL, 2, 1),
(227, 1, ' Kubernetes', 'kubernetes', 47, NULL, NULL, 2, 1),
(228, 1, ' Python', 'python-1', 47, NULL, NULL, 2, 1),
(229, 1, ' Agile', 'agile', 47, NULL, NULL, 2, 1),
(230, 1, ' Microservices', 'microservices', 47, NULL, NULL, 2, 1),
(231, 1, ' Big Data', 'big-data', 47, NULL, NULL, 2, 1),
(232, 1, 'Docker', 'docker', 48, NULL, NULL, 2, 1),
(233, 1, ' Kubernetes', 'kubernetes-1', 48, NULL, NULL, 2, 1),
(234, 1, ' Git', 'git', 48, NULL, NULL, 2, 1),
(235, 1, ' DevOps', 'devops', 48, NULL, NULL, 2, 1),
(236, 1, ' Jenkins', 'jenkins', 48, NULL, NULL, 2, 1),
(237, 1, ' JIRA', 'jira', 48, NULL, NULL, 2, 1),
(238, 1, ' AWS Certification', 'aws-certification-1', 48, NULL, NULL, 2, 1),
(239, 1, ' Confluence', 'confluence', 48, NULL, NULL, 2, 1),
(240, 1, 'WooCommerce', 'woocommerce', 49, NULL, NULL, 2, 1),
(241, 1, ' .NET', 'net', 49, NULL, NULL, 2, 1),
(242, 1, ' WordPress for Ecommerce', 'wordpress-for-ecommerce', 49, NULL, NULL, 2, 1),
(243, 1, ' Shopify', 'shopify', 49, NULL, NULL, 2, 1),
(244, 1, ' Dropshipping', 'dropshipping', 49, NULL, NULL, 2, 1),
(245, 1, ' Online Business', 'online-business', 49, NULL, NULL, 2, 1),
(246, 1, ' WordPress', 'wordpress-1', 49, NULL, NULL, 2, 1),
(247, 1, ' Magento', 'magento', 49, NULL, NULL, 2, 1),
(248, 1, 'Financial Analysis', 'financial-analysis-1', 5, NULL, NULL, 2, 1),
(249, 1, ' Investing', 'investing-1', 5, NULL, NULL, 2, 1),
(250, 1, ' Stock Trading', 'stock-trading-1', 5, NULL, NULL, 2, 1),
(251, 1, ' Finance Fundamentals', 'finance-fundamentals', 5, NULL, NULL, 2, 1),
(252, 1, ' Financial Modeling', 'financial-modeling', 5, NULL, NULL, 2, 1),
(253, 1, ' Forex', 'forex-1', 5, NULL, NULL, 2, 1),
(254, 1, ' Excel', 'excel', 5, NULL, NULL, 2, 1),
(255, 1, ' Accounting', 'accounting', 5, NULL, NULL, 2, 1),
(256, 1, 'Business Fundamentals', 'business-fundamentals', 19, NULL, NULL, 2, 1),
(257, 1, ' Dropshipping', 'dropshipping-1', 19, NULL, NULL, 2, 1),
(258, 1, ' Amazon FBA', 'amazon-fba', 19, NULL, NULL, 2, 1),
(259, 1, ' Entrepreneurship Fundamentals', 'entrepreneurship-fundamentals', 19, NULL, NULL, 2, 1),
(260, 1, ' Business Strategy', 'business-strategy', 19, NULL, NULL, 2, 1),
(261, 1, ' Business Plan', 'business-plan', 19, NULL, NULL, 2, 1),
(262, 1, ' Blogging', 'blogging', 19, NULL, NULL, 2, 1),
(263, 1, ' Startup', 'startup', 19, NULL, NULL, 2, 1),
(264, 1, ' Shopify', 'shopify-1', 19, NULL, NULL, 2, 1),
(265, 1, 'Sales Skills', 'sales-skills', 22, NULL, NULL, 2, 1),
(266, 1, ' B2B Sales', 'b2b-sales', 22, NULL, NULL, 2, 1),
(267, 1, ' LinkedIn', 'linkedin', 22, NULL, NULL, 2, 1),
(268, 1, ' Business Development', 'business-development', 22, NULL, NULL, 2, 1),
(269, 1, ' Presentation Skills', 'presentation-skills', 22, NULL, NULL, 2, 1),
(270, 1, ' Lead Generation', 'lead-generation', 22, NULL, NULL, 2, 1),
(271, 1, ' Cold Email', 'cold-email', 22, NULL, NULL, 2, 1),
(272, 1, ' Cold Calling', 'cold-calling', 22, NULL, NULL, 2, 1),
(273, 1, ' Dropshipping', 'dropshipping-2', 22, NULL, NULL, 2, 1),
(274, 1, 'WordPress Design', 'wordpress-design', 107, NULL, NULL, 2, 1),
(275, 1, ' Photoshop', 'photoshop', 107, NULL, NULL, 2, 1),
(276, 1, ' HTML', 'html', 107, NULL, NULL, 2, 1),
(277, 1, ' Web Design Business', 'web-design-business', 107, NULL, NULL, 2, 1),
(278, 1, ' HTML5', 'html5', 107, NULL, NULL, 2, 1),
(279, 1, ' User Interface', 'user-interface', 107, NULL, NULL, 2, 1),
(280, 1, ' Landing Page Optimization', 'landing-page-optimization', 107, NULL, NULL, 2, 1),
(281, 1, 'Photoshop', 'photoshop-1', 108, NULL, NULL, 2, 1),
(282, 1, ' Drawing', 'drawing', 108, NULL, NULL, 2, 1),
(283, 1, ' Adobe Illustrator', 'adobe-illustrator', 108, NULL, NULL, 2, 1),
(284, 1, ' Digital Painting', 'digital-painting', 108, NULL, NULL, 2, 1),
(285, 1, ' Figure Drawing', 'figure-drawing', 108, NULL, NULL, 2, 1),
(286, 1, ' Logo Design', 'logo-design', 108, NULL, NULL, 2, 1),
(287, 1, ' Design Theory', 'design-theory', 108, NULL, NULL, 2, 1),
(288, 1, 'Accounting', 'accounting-1', 50, NULL, NULL, 2, 1),
(289, 1, ' Finance Fundamentals', 'finance-fundamentals-1', 50, NULL, NULL, 2, 1),
(290, 1, ' Financial Accounting', 'financial-accounting', 50, NULL, NULL, 2, 1),
(291, 1, ' Bookkeeping', 'bookkeeping', 50, NULL, NULL, 2, 1),
(292, 1, ' Financial Statement', 'financial-statement', 50, NULL, NULL, 2, 1),
(293, 1, ' SAP FICO', 'sap-fico', 50, NULL, NULL, 2, 1),
(294, 1, ' Xero', 'xero', 50, NULL, NULL, 2, 1),
(295, 1, ' Startup', 'startup-1', 50, NULL, NULL, 2, 1),
(296, 1, ' Cost Accounting', 'cost-accounting', 50, NULL, NULL, 2, 1),
(297, 1, 'Microeconomics', 'microeconomics', 53, NULL, NULL, 2, 1),
(298, 1, ' Macroeconomics', 'macroeconomics', 53, NULL, NULL, 2, 1),
(299, 1, ' Entrepreneurship Fundamentals', 'entrepreneurship-fundamentals-1', 53, NULL, NULL, 2, 1),
(300, 1, ' Personal Finance', 'personal-finance-1', 53, NULL, NULL, 2, 1),
(301, 1, ' Regression Analysis', 'regression-analysis', 53, NULL, NULL, 2, 1),
(302, 1, ' Finance Fundamentals', 'finance-fundamentals-2', 53, NULL, NULL, 2, 1),
(303, 1, ' Political Science', 'political-science', 53, NULL, NULL, 2, 1),
(304, 1, ' College Admissions', 'college-admissions', 53, NULL, NULL, 2, 1),
(305, 1, 'Personal Finance', 'personal-finance-2', 54, NULL, NULL, 2, 1),
(306, 1, ' Investment Banking', 'investment-banking', 54, NULL, NULL, 2, 1),
(307, 1, ' CFA', 'cfa', 54, NULL, NULL, 2, 1),
(308, 1, ' Finance Fundamentals', 'finance-fundamentals-3', 54, NULL, NULL, 2, 1),
(309, 1, ' Financial Management', 'financial-management', 54, NULL, NULL, 2, 1),
(310, 1, ' Excel', 'excel-1', 54, NULL, NULL, 2, 1),
(311, 1, ' Corporate Finance', 'corporate-finance', 54, NULL, NULL, 2, 1),
(312, 1, ' Financial Analysis', 'financial-analysis-2', 54, NULL, NULL, 2, 1),
(313, 1, ' Company Valuation', 'company-valuation', 54, NULL, NULL, 2, 1),
(314, 1, 'Yoga for Kids', 'yoga-for-kids', 148, NULL, NULL, 2, 1),
(315, 1, ' Pranayama', 'pranayama', 148, NULL, NULL, 2, 1),
(316, 1, ' Chair Yoga', 'chair-yoga', 148, NULL, NULL, 2, 1),
(317, 1, ' Teacher Training', 'teacher-training', 148, NULL, NULL, 2, 1),
(318, 1, ' Kundalini', 'kundalini', 148, NULL, NULL, 2, 1),
(319, 1, ' Meditation', 'meditation-1', 148, NULL, NULL, 2, 1),
(320, 1, ' Face Yoga', 'face-yoga', 148, NULL, NULL, 2, 1),
(321, 1, ' Back Pain', 'back-pain', 148, NULL, NULL, 2, 1),
(322, 1, 'Makeup Artistry', 'makeup-artistry', 132, NULL, NULL, 2, 1),
(323, 1, ' Beauty', 'beauty', 132, NULL, NULL, 2, 1),
(324, 1, ' Skincare', 'skincare', 132, NULL, NULL, 2, 1),
(325, 1, ' Cosmetics', 'cosmetics', 132, NULL, NULL, 2, 1),
(326, 1, ' Nail Art', 'nail-art', 132, NULL, NULL, 2, 1),
(327, 1, ' Hair Styling', 'hair-styling', 132, NULL, NULL, 2, 1),
(328, 1, ' Facial Massage', 'facial-massage', 132, NULL, NULL, 2, 1),
(329, 1, ' Herbalism', 'herbalism', 132, NULL, NULL, 2, 1),
(330, 1, ' Cupping Therapy', 'cupping-therapy', 132, NULL, NULL, 2, 1),
(331, 1, 'Business Branding', 'business-branding', 120, NULL, NULL, 2, 1),
(332, 1, ' YouTube Audience Growth', 'youtube-audience-growth', 120, NULL, NULL, 2, 1),
(333, 1, ' YouTube Marketing', 'youtube-marketing', 120, NULL, NULL, 2, 1),
(334, 1, ' Personal Branding', 'personal-branding', 120, NULL, NULL, 2, 1),
(335, 1, ' Marketing Strategy', 'marketing-strategy', 120, NULL, NULL, 2, 1),
(336, 1, ' Brand Management', 'brand-management', 120, NULL, NULL, 2, 1),
(337, 1, ' Freelance Writing', 'freelance-writing', 120, NULL, NULL, 2, 1),
(338, 1, ' Graphic Design', 'graphic-design-1', 120, NULL, NULL, 2, 1),
(339, 1, ' Blogging', 'blogging-1', 120, NULL, NULL, 2, 1),
(340, 1, 'Google Ads (Adwords)', 'google-ads-adwords', 124, NULL, NULL, 2, 1),
(341, 1, ' Facebook Ads', 'facebook-ads', 124, NULL, NULL, 2, 1),
(342, 1, ' Mailchimp', 'mailchimp', 124, NULL, NULL, 2, 1),
(343, 1, ' Email Marketing', 'email-marketing', 124, NULL, NULL, 2, 1),
(344, 1, ' PPC Advertising', 'ppc-advertising', 124, NULL, NULL, 2, 1),
(345, 1, ' Google Ads (AdWords) Certification', 'google-ads-adwords-certification', 124, NULL, NULL, 2, 1),
(346, 1, ' Instagram Marketing', 'instagram-marketing', 124, NULL, NULL, 2, 1),
(347, 1, ' Google Analytics', 'google-analytics', 124, NULL, NULL, 2, 1),
(348, 1, ' YouTube Marketing', 'youtube-marketing-1', 124, NULL, NULL, 2, 1),
(349, 1, 'Event Planning', 'event-planning', 123, NULL, NULL, 2, 1),
(350, 1, ' Media Training', 'media-training', 123, NULL, NULL, 2, 1),
(351, 1, ' Startup', 'startup-2', 123, NULL, NULL, 2, 1),
(352, 1, ' Podcasting', 'podcasting', 123, NULL, NULL, 2, 1),
(353, 1, ' Fashion', 'fashion-1', 123, NULL, NULL, 2, 1),
(354, 1, ' Public Speaking', 'public-speaking', 123, NULL, NULL, 2, 1),
(355, 1, ' Freelance Consulting', 'freelance-consulting', 123, NULL, NULL, 2, 1),
(356, 1, ' Copywriting', 'copywriting', 123, NULL, NULL, 2, 1),
(357, 1, 'Google Analytics', 'google-analytics-1', 122, NULL, NULL, 2, 1),
(358, 1, ' Google Analytics Individual Qualification (IQ)', 'google-analytics-individual-qualification-iq', 122, NULL, NULL, 2, 1),
(359, 1, ' Data Analysis', 'data-analysis-1', 122, NULL, NULL, 2, 1),
(360, 1, ' SQL', 'sql-1', 122, NULL, NULL, 2, 1),
(361, 1, ' Marketing Analytics', 'marketing-analytics', 122, NULL, NULL, 2, 1),
(362, 1, ' Google Tag Manager', 'google-tag-manager', 122, NULL, NULL, 2, 1),
(363, 1, ' Marketing Strategy', 'marketing-strategy-1', 122, NULL, NULL, 2, 1),
(364, 1, ' Marketing Automation', 'marketing-automation', 122, NULL, NULL, 2, 1),
(365, 1, ' ActiveCampaign', 'activecampaign', 122, NULL, NULL, 2, 1),
(366, 1, 'YouTube Marketing', 'youtube-marketing-2', 125, NULL, NULL, 2, 1),
(367, 1, ' Video Creation', 'video-creation', 125, NULL, NULL, 2, 1),
(368, 1, ' PowerPoint', 'powerpoint', 125, NULL, NULL, 2, 1),
(369, 1, ' Video Marketing', 'video-marketing', 125, NULL, NULL, 2, 1),
(370, 1, ' Live Streaming', 'live-streaming', 125, NULL, NULL, 2, 1),
(371, 1, ' App Marketing', 'app-marketing', 125, NULL, NULL, 2, 1),
(372, 1, ' YouTube Audience Growth', 'youtube-audience-growth-1', 125, NULL, NULL, 2, 1),
(373, 1, ' App Store Optimization', 'app-store-optimization', 125, NULL, NULL, 2, 1),
(374, 1, ' Webinar', 'webinar', 125, NULL, NULL, 2, 1),
(375, 1, 'Copywriting', 'copywriting-1', 126, NULL, NULL, 2, 1),
(376, 1, ' Writing', 'writing', 126, NULL, NULL, 2, 1),
(377, 1, ' Content Writing', 'content-writing', 126, NULL, NULL, 2, 1),
(378, 1, ' Blogging', 'blogging-2', 126, NULL, NULL, 2, 1),
(379, 1, ' Storytelling', 'storytelling', 126, NULL, NULL, 2, 1),
(380, 1, ' Marketing Strategy', 'marketing-strategy-2', 126, NULL, NULL, 2, 1),
(381, 1, ' Podcasting', 'podcasting-1', 126, NULL, NULL, 2, 1),
(382, 1, ' WordPress Content', 'wordpress-content', 126, NULL, NULL, 2, 1),
(383, 1, 'Digital Marketing', 'digital-marketing-1', 127, NULL, NULL, 2, 1),
(384, 1, ' Marketing Strategy', 'marketing-strategy-3', 127, NULL, NULL, 2, 1),
(385, 1, ' App Marketing', 'app-marketing-1', 127, NULL, NULL, 2, 1),
(386, 1, ' SEO', 'seo', 127, NULL, NULL, 2, 1),
(387, 1, ' Social Media Marketing', 'social-media-marketing-1', 127, NULL, NULL, 2, 1),
(388, 1, ' Website Traffic', 'website-traffic', 127, NULL, NULL, 2, 1),
(389, 1, ' Economics', 'economics-1', 127, NULL, NULL, 2, 1),
(390, 1, ' Marketing Psychology', 'marketing-psychology', 127, NULL, NULL, 2, 1),
(391, 1, 'ClickBank', 'clickbank', 128, NULL, NULL, 2, 1),
(392, 1, ' Amazon Affiliate Marketing', 'amazon-affiliate-marketing', 128, NULL, NULL, 2, 1),
(393, 1, ' Marketing Strategy', 'marketing-strategy-4', 128, NULL, NULL, 2, 1),
(394, 1, ' SEO', 'seo-1', 128, NULL, NULL, 2, 1),
(395, 1, ' Teespring', 'teespring', 128, NULL, NULL, 2, 1),
(396, 1, ' CPA Marketing', 'cpa-marketing', 128, NULL, NULL, 2, 1),
(397, 1, ' Business Development', 'business-development-1', 128, NULL, NULL, 2, 1),
(398, 1, ' Passive Income', 'passive-income', 128, NULL, NULL, 2, 1),
(399, 1, 'Amazon Kindle', 'amazon-kindle', 129, NULL, NULL, 2, 1),
(400, 1, ' Selling on Amazon', 'selling-on-amazon', 129, NULL, NULL, 2, 1),
(401, 1, ' Product Management', 'product-management', 129, NULL, NULL, 2, 1),
(402, 1, ' Marketing Plan', 'marketing-plan', 129, NULL, NULL, 2, 1),
(403, 1, ' Meditation', 'meditation-2', 129, NULL, NULL, 2, 1),
(404, 1, ' Voice-Over', 'voice-over', 129, NULL, NULL, 2, 1),
(405, 1, ' Self-Publishing', 'self-publishing', 129, NULL, NULL, 2, 1),
(406, 1, ' Copywriting', 'copywriting-2', 129, NULL, NULL, 2, 1),
(407, 1, ' E-Commerce', 'e-commerce-1', 129, NULL, NULL, 2, 1),
(408, 1, 'Google Ads (Adwords)', 'google-ads-adwords-1', 117, NULL, NULL, 2, 1),
(409, 1, ' Social Media Marketing', 'social-media-marketing-2', 117, NULL, NULL, 2, 1),
(410, 1, ' Google Ads (AdWords) Certification', 'google-ads-adwords-certification-1', 117, NULL, NULL, 2, 1),
(411, 1, ' Marketing Strategy', 'marketing-strategy-5', 117, NULL, NULL, 2, 1),
(412, 1, ' Internet Marketing', 'internet-marketing', 117, NULL, NULL, 2, 1),
(413, 1, ' Google Analytics', 'google-analytics-2', 117, NULL, NULL, 2, 1),
(414, 1, ' Email Marketing', 'email-marketing-1', 117, NULL, NULL, 2, 1),
(415, 1, ' Business Strategy', 'business-strategy-1', 117, NULL, NULL, 2, 1),
(416, 1, 'SEO', 'seo-2', 118, NULL, NULL, 2, 1),
(417, 1, ' WordPress', 'wordpress-2', 118, NULL, NULL, 2, 1),
(418, 1, ' Local SEO', 'local-seo', 118, NULL, NULL, 2, 1),
(419, 1, ' SEO Audit', 'seo-audit', 118, NULL, NULL, 2, 1),
(420, 1, ' Keyword Research', 'keyword-research', 118, NULL, NULL, 2, 1),
(421, 1, ' Link Building', 'link-building', 118, NULL, NULL, 2, 1),
(422, 1, ' Google Ads (Adwords)', 'google-ads-adwords-2', 118, NULL, NULL, 2, 1),
(423, 1, ' Google my Business', 'google-my-business', 118, NULL, NULL, 2, 1),
(424, 1, ' YouTube Marketing', 'youtube-marketing-3', 118, NULL, NULL, 2, 1),
(425, 1, 'Instagram Marketing', 'instagram-marketing-1', 119, NULL, NULL, 2, 1),
(426, 1, ' Facebook Ads', 'facebook-ads-1', 119, NULL, NULL, 2, 1),
(427, 1, ' Facebook Marketing', 'facebook-marketing', 119, NULL, NULL, 2, 1),
(428, 1, ' PPC Advertising', 'ppc-advertising-1', 119, NULL, NULL, 2, 1),
(429, 1, ' Social Media Management', 'social-media-management', 119, NULL, NULL, 2, 1),
(430, 1, ' LinkedIn', 'linkedin-1', 119, NULL, NULL, 2, 1),
(431, 1, ' YouTube Audience Growth', 'youtube-audience-growth-2', 119, NULL, NULL, 2, 1),
(432, 1, ' Pinterest Marketing', 'pinterest-marketing', 119, NULL, NULL, 2, 1),
(433, 1, 'Copywriting', 'copywriting-3', 121, NULL, NULL, 2, 1),
(434, 1, ' Marketing Strategy', 'marketing-strategy-6', 121, NULL, NULL, 2, 1),
(435, 1, ' Event Planning', 'event-planning-1', 121, NULL, NULL, 2, 1),
(436, 1, ' Sales Skills', 'sales-skills-1', 121, NULL, NULL, 2, 1),
(437, 1, ' Persuasion', 'persuasion', 121, NULL, NULL, 2, 1),
(438, 1, ' Presentation Skills', 'presentation-skills-1', 121, NULL, NULL, 2, 1),
(439, 1, ' Marketing Plan', 'marketing-plan-1', 121, NULL, NULL, 2, 1),
(440, 1, ' Career Coaching', 'career-coaching', 121, NULL, NULL, 2, 1),
(441, 1, ' Neuromarketing', 'neuromarketing', 121, NULL, NULL, 2, 1),
(442, 1, 'Drawing', 'drawing-1', 130, NULL, NULL, 2, 1),
(443, 1, ' Sketching', 'sketching', 130, NULL, NULL, 2, 1),
(444, 1, ' Watercolor Painting', 'watercolor-painting', 130, NULL, NULL, 2, 1),
(445, 1, ' Pencil Drawing', 'pencil-drawing', 130, NULL, NULL, 2, 1),
(446, 1, ' Portraiture', 'portraiture', 130, NULL, NULL, 2, 1),
(447, 1, ' Figure Drawing', 'figure-drawing-1', 130, NULL, NULL, 2, 1),
(448, 1, ' Painting', 'painting', 130, NULL, NULL, 2, 1),
(449, 1, ' Acrylic Painting', 'acrylic-painting', 130, NULL, NULL, 2, 1),
(450, 1, ' Procreate Digital Illustration App', 'procreate-digital-illustration-app', 130, NULL, NULL, 2, 1),
(451, 1, 'Sourdough Bread Baking', 'sourdough-bread-baking', 131, NULL, NULL, 2, 1),
(452, 1, ' Bread Baking', 'bread-baking', 131, NULL, NULL, 2, 1),
(453, 1, ' Cooking', 'cooking', 131, NULL, NULL, 2, 1),
(454, 1, ' Wine', 'wine', 131, NULL, NULL, 2, 1),
(455, 1, ' Baking', 'baking', 131, NULL, NULL, 2, 1),
(456, 1, ' Bartending', 'bartending', 131, NULL, NULL, 2, 1),
(457, 1, ' Gluten Free Cooking and Baking', 'gluten-free-cooking-and-baking', 131, NULL, NULL, 2, 1),
(458, 1, ' Pastry', 'pastry', 131, NULL, NULL, 2, 1),
(459, 1, ' Pizza', 'pizza', 131, NULL, NULL, 2, 1),
(460, 1, 'Dog Training', 'dog-training', 136, NULL, NULL, 2, 1),
(461, 1, ' Dog Behavior', 'dog-behavior', 136, NULL, NULL, 2, 1),
(462, 1, ' Dog Care', 'dog-care', 136, NULL, NULL, 2, 1),
(463, 1, ' Cat Behavior', 'cat-behavior', 136, NULL, NULL, 2, 1),
(464, 1, ' Pet Training', 'pet-training', 136, NULL, NULL, 2, 1),
(465, 1, ' Pet Care', 'pet-care', 136, NULL, NULL, 2, 1),
(466, 1, ' Animal Reiki', 'animal-reiki', 136, NULL, NULL, 2, 1),
(467, 1, ' Animal Nutrition', 'animal-nutrition', 136, NULL, NULL, 2, 1),
(468, 1, ' Horsemanship', 'horsemanship', 136, NULL, NULL, 2, 1),
(469, 1, 'Gardening', 'gardening', 135, NULL, NULL, 2, 1),
(470, 1, ' Electricity', 'electricity', 135, NULL, NULL, 2, 1),
(471, 1, ' Electrical Wiring', 'electrical-wiring', 135, NULL, NULL, 2, 1),
(472, 1, ' Home Repair', 'home-repair', 135, NULL, NULL, 2, 1),
(473, 1, ' Feng Shui', 'feng-shui', 135, NULL, NULL, 2, 1),
(474, 1, ' Woodworking', 'woodworking', 135, NULL, NULL, 2, 1),
(475, 1, ' Aquaculture', 'aquaculture', 135, NULL, NULL, 2, 1),
(476, 1, ' Garden Design', 'garden-design', 135, NULL, NULL, 2, 1),
(477, 1, ' Decluttering', 'decluttering', 135, NULL, NULL, 2, 1),
(478, 1, 'eSports', 'esports', 134, NULL, NULL, 2, 1),
(479, 1, ' Poker', 'poker', 134, NULL, NULL, 2, 1),
(480, 1, ' Chess', 'chess', 134, NULL, NULL, 2, 1),
(481, 1, ' Twitch', 'twitch', 134, NULL, NULL, 2, 1),
(482, 1, ' League of Legends', 'league-of-legends', 134, NULL, NULL, 2, 1),
(483, 1, ' Rubik\'s Cube', 'rubiks-cube', 134, NULL, NULL, 2, 1),
(484, 1, ' Live Streaming', 'live-streaming-1', 134, NULL, NULL, 2, 1),
(485, 1, ' Open Broadcaster', 'open-broadcaster', 134, NULL, NULL, 2, 1),
(486, 1, 'Travel Writing', 'travel-writing', 133, NULL, NULL, 2, 1),
(487, 1, ' Writing', 'writing-1', 133, NULL, NULL, 2, 1),
(488, 1, ' Journaling', 'journaling', 133, NULL, NULL, 2, 1),
(489, 1, ' Digital Nomad', 'digital-nomad', 133, NULL, NULL, 2, 1),
(490, 1, ' Airbnb Hosting', 'airbnb-hosting', 133, NULL, NULL, 2, 1),
(491, 1, ' Travel Hacking', 'travel-hacking', 133, NULL, NULL, 2, 1),
(492, 1, ' Travel Tips', 'travel-tips', 133, NULL, NULL, 2, 1),
(493, 1, ' iMovie', 'imovie', 133, NULL, NULL, 2, 1),
(494, 1, ' Mac Basics', 'mac-basics', 133, NULL, NULL, 2, 1),
(495, 1, 'Writing', 'writing-2', 20, NULL, NULL, 2, 1),
(496, 1, ' Communication Skills', 'communication-skills', 20, NULL, NULL, 2, 1),
(497, 1, ' Public Speaking', 'public-speaking-1', 20, NULL, NULL, 2, 1),
(498, 1, ' Presentation Skills', 'presentation-skills-2', 20, NULL, NULL, 2, 1),
(499, 1, ' Fiction Writing', 'fiction-writing', 20, NULL, NULL, 2, 1),
(500, 1, ' Business Writing', 'business-writing', 20, NULL, NULL, 2, 1),
(501, 1, ' Email Etiquette', 'email-etiquette', 20, NULL, NULL, 2, 1),
(502, 1, ' Storytelling', 'storytelling-1', 20, NULL, NULL, 2, 1),
(503, 1, ' Novel Writing', 'novel-writing', 20, NULL, NULL, 2, 1),
(504, 1, 'Product Management', 'product-management-1', 21, NULL, NULL, 2, 1),
(505, 1, ' Leadership', 'leadership-1', 21, NULL, NULL, 2, 1),
(506, 1, ' Management Skills', 'management-skills', 21, NULL, NULL, 2, 1),
(507, 1, ' Business Process Management', 'business-process-management', 21, NULL, NULL, 2, 1),
(508, 1, ' Risk Management', 'risk-management', 21, NULL, NULL, 2, 1),
(509, 1, ' Agile', 'agile-1', 21, NULL, NULL, 2, 1),
(510, 1, ' ISO 9001', 'iso-9001', 21, NULL, NULL, 2, 1),
(511, 1, ' Quality Management', 'quality-management', 21, NULL, NULL, 2, 1),
(512, 1, ' Accounting', 'accounting-2', 21, NULL, NULL, 2, 1),
(513, 1, 'Digital Marketing', 'digital-marketing-2', 23, NULL, NULL, 2, 1),
(514, 1, ' Business Strategy', 'business-strategy-2', 23, NULL, NULL, 2, 1),
(515, 1, ' Excel', 'excel-2', 23, NULL, NULL, 2, 1),
(516, 1, ' Financial Modeling', 'financial-modeling-1', 23, NULL, NULL, 2, 1),
(517, 1, ' Forex', 'forex-2', 23, NULL, NULL, 2, 1),
(518, 1, ' Business Model', 'business-model', 23, NULL, NULL, 2, 1),
(519, 1, ' Swing Trading', 'swing-trading', 23, NULL, NULL, 2, 1),
(520, 1, ' Innovation', 'innovation', 23, NULL, NULL, 2, 1),
(521, 1, ' Management Consulting', 'management-consulting', 23, NULL, NULL, 2, 1),
(522, 1, 'Supply Chain', 'supply-chain', 24, NULL, NULL, 2, 1),
(523, 1, ' Six Sigma', 'six-sigma', 24, NULL, NULL, 2, 1),
(524, 1, ' Six Sigma Green Belt', 'six-sigma-green-belt', 24, NULL, NULL, 2, 1),
(525, 1, ' Quality Management', 'quality-management-1', 24, NULL, NULL, 2, 1),
(526, 1, ' Robotic Process Automation', 'robotic-process-automation', 24, NULL, NULL, 2, 1),
(527, 1, ' Lean Six Sigma Green Belt', 'lean-six-sigma-green-belt', 24, NULL, NULL, 2, 1),
(528, 1, ' UiPath', 'uipath', 24, NULL, NULL, 2, 1),
(529, 1, ' Six Sigma Yellow Belt', 'six-sigma-yellow-belt', 24, NULL, NULL, 2, 1),
(530, 1, ' Six Sigma Black Belt', 'six-sigma-black-belt', 24, NULL, NULL, 2, 1),
(531, 1, 'PMP', 'pmp', 25, NULL, NULL, 2, 1),
(532, 1, ' PMBOK', 'pmbok', 25, NULL, NULL, 2, 1),
(533, 1, ' Agile', 'agile-2', 25, NULL, NULL, 2, 1),
(534, 1, ' Scrum', 'scrum', 25, NULL, NULL, 2, 1),
(535, 1, ' CAPM', 'capm', 25, NULL, NULL, 2, 1),
(536, 1, ' PMI-ACP', 'pmi-acp', 25, NULL, NULL, 2, 1),
(537, 1, ' Microsoft Project', 'microsoft-project', 25, NULL, NULL, 2, 1),
(538, 1, ' Risk Management', 'risk-management-1', 25, NULL, NULL, 2, 1),
(539, 1, 'Law', 'law', 26, NULL, NULL, 2, 1),
(540, 1, ' Contract Law', 'contract-law', 26, NULL, NULL, 2, 1),
(541, 1, ' GDPR', 'gdpr', 26, NULL, NULL, 2, 1),
(542, 1, ' LGPD Lei Geral de Proteção de Dados', 'lgpd-lei-geral-de-protecao-de-dados', 26, NULL, NULL, 2, 1),
(543, 1, ' Contract Negotiation', 'contract-negotiation', 26, NULL, NULL, 2, 1),
(544, 1, ' Patent', 'patent', 26, NULL, NULL, 2, 1),
(545, 1, ' Intellectual Property', 'intellectual-property', 26, NULL, NULL, 2, 1),
(546, 1, ' Healthcare IT', 'healthcare-it', 26, NULL, NULL, 2, 1),
(547, 1, 'SQL', 'sql-2', 27, NULL, NULL, 2, 1),
(548, 1, ' Microsoft Power BI', 'microsoft-power-bi', 27, NULL, NULL, 2, 1),
(549, 1, ' Business Analysis', 'business-analysis', 27, NULL, NULL, 2, 1),
(550, 1, ' Tableau', 'tableau', 27, NULL, NULL, 2, 1),
(551, 1, ' Business Intelligence', 'business-intelligence', 27, NULL, NULL, 2, 1),
(552, 1, ' MySQL', 'mysql-1', 27, NULL, NULL, 2, 1),
(553, 1, ' Data Modeling', 'data-modeling', 27, NULL, NULL, 2, 1),
(554, 1, ' Data Analysis', 'data-analysis-2', 27, NULL, NULL, 2, 1),
(555, 1, ' Big Data', 'big-data-1', 27, NULL, NULL, 2, 1),
(556, 1, 'Amazon FBA', 'amazon-fba-1', 28, NULL, NULL, 2, 1),
(557, 1, ' Dropshipping', 'dropshipping-3', 28, NULL, NULL, 2, 1),
(558, 1, ' Shopify Dropshipping', 'shopify-dropshipping', 28, NULL, NULL, 2, 1),
(559, 1, ' Blogging', 'blogging-3', 28, NULL, NULL, 2, 1),
(560, 1, ' Online Business', 'online-business-1', 28, NULL, NULL, 2, 1),
(561, 1, ' Transcription', 'transcription', 28, NULL, NULL, 2, 1),
(562, 1, ' Passive Income', 'passive-income-1', 28, NULL, NULL, 2, 1),
(563, 1, ' Counseling', 'counseling', 28, NULL, NULL, 2, 1),
(564, 1, 'Recruiting', 'recruiting', 29, NULL, NULL, 2, 1),
(565, 1, ' Emotional Intelligence', 'emotional-intelligence', 29, NULL, NULL, 2, 1),
(566, 1, ' Instructional Design', 'instructional-design', 29, NULL, NULL, 2, 1),
(567, 1, ' Conflict Management', 'conflict-management', 29, NULL, NULL, 2, 1),
(568, 1, ' Hiring', 'hiring', 29, NULL, NULL, 2, 1),
(569, 1, ' Talent Management', 'talent-management', 29, NULL, NULL, 2, 1),
(570, 1, ' Agile', 'agile-3', 29, NULL, NULL, 2, 1),
(571, 1, ' Entrepreneurship Fundamentals', 'entrepreneurship-fundamentals-2', 29, NULL, NULL, 2, 1),
(572, 1, 'Oil and Gas Industry', 'oil-and-gas-industry', 30, NULL, NULL, 2, 1),
(573, 1, ' Electrical Engineering', 'electrical-engineering', 30, NULL, NULL, 2, 1),
(574, 1, ' Piping', 'piping', 30, NULL, NULL, 2, 1),
(575, 1, ' EPLAN Electric P8', 'eplan-electric-p8', 30, NULL, NULL, 2, 1),
(576, 1, ' Life Coach Training', 'life-coach-training', 30, NULL, NULL, 2, 1),
(577, 1, ' Pharmacy', 'pharmacy', 30, NULL, NULL, 2, 1),
(578, 1, ' Solar Energy', 'solar-energy', 30, NULL, NULL, 2, 1),
(579, 1, ' Manufacturing', 'manufacturing', 30, NULL, NULL, 2, 1),
(580, 1, ' Chemical engineering', 'chemical-engineering', 30, NULL, NULL, 2, 1),
(581, 1, 'Screenwriting', 'screenwriting', 31, NULL, NULL, 2, 1),
(582, 1, ' Podcasting', 'podcasting-2', 31, NULL, NULL, 2, 1),
(583, 1, ' Audiobook Creation', 'audiobook-creation', 31, NULL, NULL, 2, 1),
(584, 1, ' Journalism', 'journalism', 31, NULL, NULL, 2, 1),
(585, 1, ' Amazon Kindle', 'amazon-kindle-1', 31, NULL, NULL, 2, 1),
(586, 1, ' SEO', 'seo-3', 31, NULL, NULL, 2, 1),
(587, 1, ' After Effects', 'after-effects', 31, NULL, NULL, 2, 1),
(588, 1, ' Motion Graphics', 'motion-graphics', 31, NULL, NULL, 2, 1),
(589, 1, ' Scrivener', 'scrivener', 31, NULL, NULL, 2, 1),
(590, 1, 'Real Estate Investing', 'real-estate-investing', 32, NULL, NULL, 2, 1),
(591, 1, ' Construction', 'construction', 32, NULL, NULL, 2, 1),
(592, 1, ' Financial Modeling', 'financial-modeling-2', 32, NULL, NULL, 2, 1),
(593, 1, ' Mortgage', 'mortgage', 32, NULL, NULL, 2, 1),
(594, 1, ' Airbnb Hosting', 'airbnb-hosting-1', 32, NULL, NULL, 2, 1),
(595, 1, ' Property Management', 'property-management', 32, NULL, NULL, 2, 1),
(596, 1, ' Real Estate Marketing', 'real-estate-marketing', 32, NULL, NULL, 2, 1),
(597, 1, ' House Buying', 'house-buying', 32, NULL, NULL, 2, 1),
(598, 1, 'QuickBooks Online', 'quickbooks-online', 33, NULL, NULL, 2, 1),
(599, 1, ' PowerPoint', 'powerpoint-1', 33, NULL, NULL, 2, 1),
(600, 1, ' Grant Writing', 'grant-writing', 33, NULL, NULL, 2, 1),
(601, 1, ' Freelance Writing', 'freelance-writing-1', 33, NULL, NULL, 2, 1),
(602, 1, ' Procurement', 'procurement', 33, NULL, NULL, 2, 1),
(603, 1, ' Supply Chain', 'supply-chain-1', 33, NULL, NULL, 2, 1),
(604, 1, ' Investing', 'investing-2', 33, NULL, NULL, 2, 1),
(605, 1, ' Stock Trading', 'stock-trading-2', 33, NULL, NULL, 2, 1),
(606, 1, ' Akka', 'akka', 33, NULL, NULL, 2, 1),
(607, 1, 'Photoshop', 'photoshop-2', 109, NULL, NULL, 2, 1),
(608, 1, ' After Effects', 'after-effects-1', 109, NULL, NULL, 2, 1),
(609, 1, ' Procreate Digital Illustration App', 'procreate-digital-illustration-app-1', 109, NULL, NULL, 2, 1),
(610, 1, ' Adobe Illustrator', 'adobe-illustrator-1', 109, NULL, NULL, 2, 1),
(611, 1, ' Video Editing', 'video-editing', 109, NULL, NULL, 2, 1),
(612, 1, ' Digital Art', 'digital-art', 109, NULL, NULL, 2, 1),
(613, 1, ' Affinity Designer', 'affinity-designer', 109, NULL, NULL, 2, 1),
(614, 1, ' AutoCAD', 'autocad', 109, NULL, NULL, 2, 1),
(615, 1, ' Adobe Premiere', 'adobe-premiere', 109, NULL, NULL, 2, 1),
(616, 1, 'User Experience Design', 'user-experience-design', 110, NULL, NULL, 2, 1),
(617, 1, ' User Interface', 'user-interface-1', 110, NULL, NULL, 2, 1),
(618, 1, ' Adobe XD', 'adobe-xd', 110, NULL, NULL, 2, 1),
(619, 1, ' Figma', 'figma', 110, NULL, NULL, 2, 1),
(620, 1, ' Web Design', 'web-design-1', 110, NULL, NULL, 2, 1),
(621, 1, ' Product Design', 'product-design', 110, NULL, NULL, 2, 1),
(622, 1, ' Mobile App Design', 'mobile-app-design', 110, NULL, NULL, 2, 1),
(623, 1, ' Prototyping', 'prototyping', 110, NULL, NULL, 2, 1),
(624, 1, ' Usability Testing', 'usability-testing', 110, NULL, NULL, 2, 1),
(625, 1, 'Pixel Art', 'pixel-art', 111, NULL, NULL, 2, 1),
(626, 1, ' Unity', 'unity-1', 111, NULL, NULL, 2, 1),
(627, 1, ' Digital Painting', 'digital-painting-1', 111, NULL, NULL, 2, 1),
(628, 1, ' Blender', 'blender', 111, NULL, NULL, 2, 1),
(629, 1, ' Game Development Fundamentals', 'game-development-fundamentals-1', 111, NULL, NULL, 2, 1),
(630, 1, ' Unreal Engine', 'unreal-engine-1', 111, NULL, NULL, 2, 1),
(631, 1, ' VFX Visual Effects', 'vfx-visual-effects', 111, NULL, NULL, 2, 1),
(632, 1, ' Drawing', 'drawing-2', 111, NULL, NULL, 2, 1),
(633, 1, 'Marketing Plan', 'marketing-plan-2', 112, NULL, NULL, 2, 1),
(634, 1, ' SOLIDWORKS', 'solidworks', 112, NULL, NULL, 2, 1),
(635, 1, ' Gamification', 'gamification', 112, NULL, NULL, 2, 1),
(636, 1, ' Drawing', 'drawing-3', 112, NULL, NULL, 2, 1),
(637, 1, ' PowerPoint', 'powerpoint-2', 112, NULL, NULL, 2, 1),
(638, 1, ' AutoCAD Electrical', 'autocad-electrical', 112, NULL, NULL, 2, 1),
(639, 1, ' VLSI', 'vlsi', 112, NULL, NULL, 2, 1),
(640, 1, ' Innovation', 'innovation-1', 112, NULL, NULL, 2, 1),
(641, 1, 'Blender', 'blender-1', 113, NULL, NULL, 2, 1),
(642, 1, ' After Effects', 'after-effects-2', 113, NULL, NULL, 2, 1),
(643, 1, ' Motion Graphics', 'motion-graphics-1', 113, NULL, NULL, 2, 1),
(644, 1, ' 3ds Max', '3ds-max', 113, NULL, NULL, 2, 1),
(645, 1, ' Fusion 360', 'fusion-360', 113, NULL, NULL, 2, 1),
(646, 1, ' zBrush', 'zbrush', 113, NULL, NULL, 2, 1),
(647, 1, ' Maya', 'maya', 113, NULL, NULL, 2, 1),
(648, 1, ' Character Design', 'character-design', 113, NULL, NULL, 2, 1),
(649, 1, ' SOLIDWORKS', 'solidworks-1', 113, NULL, NULL, 2, 1),
(650, 1, 'Fashion Design', 'fashion-design', 114, NULL, NULL, 2, 1),
(651, 1, ' Adobe Illustrator', 'adobe-illustrator-2', 114, NULL, NULL, 2, 1),
(652, 1, ' Sewing', 'sewing', 114, NULL, NULL, 2, 1),
(653, 1, ' Illustration', 'illustration', 114, NULL, NULL, 2, 1),
(654, 1, ' T-Shirt Design', 't-shirt-design', 114, NULL, NULL, 2, 1),
(655, 1, ' Marvelous Designer', 'marvelous-designer', 114, NULL, NULL, 2, 1),
(656, 1, ' Jewelry Design', 'jewelry-design', 114, NULL, NULL, 2, 1),
(657, 1, ' Photoshop', 'photoshop-3', 114, NULL, NULL, 2, 1),
(658, 1, 'AutoCAD', 'autocad-1', 115, NULL, NULL, 2, 1),
(659, 1, ' Revit', 'revit', 115, NULL, NULL, 2, 1),
(660, 1, ' ARCHICAD', 'archicad', 115, NULL, NULL, 2, 1),
(661, 1, ' SketchUp', 'sketchup', 115, NULL, NULL, 2, 1),
(662, 1, ' Landscape Architecture', 'landscape-architecture', 115, NULL, NULL, 2, 1),
(663, 1, ' Blender', 'blender-2', 115, NULL, NULL, 2, 1),
(664, 1, ' Photorealistic Rendering', 'photorealistic-rendering', 115, NULL, NULL, 2, 1),
(665, 1, ' LEED', 'leed', 115, NULL, NULL, 2, 1),
(666, 1, 'Color Theory', 'color-theory', 116, NULL, NULL, 2, 1),
(667, 1, ' SketchUp', 'sketchup-1', 116, NULL, NULL, 2, 1),
(668, 1, ' Lighting Design', 'lighting-design', 116, NULL, NULL, 2, 1),
(669, 1, ' HVAC', 'hvac', 116, NULL, NULL, 2, 1),
(670, 1, ' Mechanical Engineering', 'mechanical-engineering', 116, NULL, NULL, 2, 1),
(671, 1, ' Piping', 'piping-1', 116, NULL, NULL, 2, 1),
(672, 1, ' Blender', 'blender-3', 116, NULL, NULL, 2, 1),
(673, 1, ' Minimalist Lifestyle', 'minimalist-lifestyle', 116, NULL, NULL, 2, 1),
(674, 1, 'Anti-Money Laundering', 'anti-money-laundering', 51, NULL, NULL, 2, 1),
(675, 1, ' Risk Management', 'risk-management-2', 51, NULL, NULL, 2, 1),
(676, 1, ' IFRS', 'ifrs', 51, NULL, NULL, 2, 1),
(677, 1, ' Internal Auditing', 'internal-auditing', 51, NULL, NULL, 2, 1),
(678, 1, ' Finance Fundamentals', 'finance-fundamentals-4', 51, NULL, NULL, 2, 1),
(679, 1, ' Accounting', 'accounting-3', 51, NULL, NULL, 2, 1),
(680, 1, ' PCI DSS', 'pci-dss', 51, NULL, NULL, 2, 1),
(681, 1, ' Identity Security', 'identity-security', 51, NULL, NULL, 2, 1),
(682, 1, ' Financial Risk Manager (FRM)', 'financial-risk-manager-frm', 51, NULL, NULL, 2, 1),
(683, 1, 'Cryptocurrency', 'cryptocurrency', 52, NULL, NULL, 2, 1),
(684, 1, ' Bitcoin', 'bitcoin', 52, NULL, NULL, 2, 1),
(685, 1, ' Blockchain', 'blockchain', 52, NULL, NULL, 2, 1),
(686, 1, ' Day Trading', 'day-trading-1', 52, NULL, NULL, 2, 1),
(687, 1, ' Technical Analysis', 'technical-analysis-1', 52, NULL, NULL, 2, 1),
(688, 1, ' Bitcoin Trading', 'bitcoin-trading', 52, NULL, NULL, 2, 1),
(689, 1, ' Algorithmic Trading', 'algorithmic-trading', 52, NULL, NULL, 2, 1),
(690, 1, ' Blender', 'blender-4', 52, NULL, NULL, 2, 1),
(691, 1, ' Ethereum', 'ethereum', 52, NULL, NULL, 2, 1),
(692, 1, 'CFA', 'cfa-1', 55, NULL, NULL, 2, 1),
(693, 1, ' Certified Management Accountant (CMA)', 'certified-management-accountant-cma', 55, NULL, NULL, 2, 1),
(694, 1, ' Financial Management', 'financial-management-1', 55, NULL, NULL, 2, 1),
(695, 1, ' Financial Markets', 'financial-markets', 55, NULL, NULL, 2, 1),
(696, 1, ' Quantitative Finance', 'quantitative-finance', 55, NULL, NULL, 2, 1),
(697, 1, ' ACCA', 'acca', 55, NULL, NULL, 2, 1),
(698, 1, ' Stock Trading', 'stock-trading-3', 55, NULL, NULL, 2, 1),
(699, 1, ' Company Valuation', 'company-valuation-1', 55, NULL, NULL, 2, 1),
(700, 1, ' Fixed Income Securities', 'fixed-income-securities', 55, NULL, NULL, 2, 1),
(701, 1, 'Financial Analysis', 'financial-analysis-3', 56, NULL, NULL, 2, 1),
(702, 1, ' Financial Modeling', 'financial-modeling-3', 56, NULL, NULL, 2, 1),
(703, 1, ' Finance Fundamentals', 'finance-fundamentals-5', 56, NULL, NULL, 2, 1),
(704, 1, ' Excel', 'excel-3', 56, NULL, NULL, 2, 1),
(705, 1, ' Investing', 'investing-3', 56, NULL, NULL, 2, 1),
(706, 1, ' Python', 'python-2', 56, NULL, NULL, 2, 1),
(707, 1, ' Accounting', 'accounting-4', 56, NULL, NULL, 2, 1),
(708, 1, ' Investment Banking', 'investment-banking-1', 56, NULL, NULL, 2, 1),
(709, 1, ' CFA', 'cfa-2', 56, NULL, NULL, 2, 1),
(710, 1, 'Stock Trading', 'stock-trading-4', 57, NULL, NULL, 2, 1),
(711, 1, ' Investing', 'investing-4', 57, NULL, NULL, 2, 1),
(712, 1, ' Technical Analysis', 'technical-analysis-2', 57, NULL, NULL, 2, 1),
(713, 1, ' Forex', 'forex-3', 57, NULL, NULL, 2, 1),
(714, 1, ' Financial Analysis', 'financial-analysis-4', 57, NULL, NULL, 2, 1),
(715, 1, ' Day Trading', 'day-trading-2', 57, NULL, NULL, 2, 1),
(716, 1, ' Options Trading', 'options-trading-1', 57, NULL, NULL, 2, 1),
(717, 1, ' Financial Trading', 'financial-trading-1', 57, NULL, NULL, 2, 1),
(718, 1, ' Stock Options', 'stock-options-1', 57, NULL, NULL, 2, 1),
(719, 1, 'QuickBooks Online', 'quickbooks-online-1', 68, NULL, NULL, 2, 1),
(720, 1, ' Excel', 'excel-4', 68, NULL, NULL, 2, 1),
(721, 1, ' Financial Modeling', 'financial-modeling-4', 68, NULL, NULL, 2, 1),
(722, 1, ' Excel Analytics', 'excel-analytics', 68, NULL, NULL, 2, 1),
(723, 1, ' QuickBooks Pro', 'quickbooks-pro', 68, NULL, NULL, 2, 1),
(724, 1, ' Xero', 'xero-1', 68, NULL, NULL, 2, 1),
(725, 1, ' SAP FICO', 'sap-fico-1', 68, NULL, NULL, 2, 1),
(726, 1, ' Financial Accounting', 'financial-accounting-1', 68, NULL, NULL, 2, 1),
(727, 1, ' QuickBooks', 'quickbooks', 68, NULL, NULL, 2, 1),
(728, 1, 'Tax Preparation', 'tax-preparation', 69, NULL, NULL, 2, 1),
(729, 1, ' Goods and Services Tax', 'goods-and-services-tax', 69, NULL, NULL, 2, 1),
(730, 1, ' Personal Finance', 'personal-finance-3', 69, NULL, NULL, 2, 1),
(731, 1, ' QuickBooks Online', 'quickbooks-online-2', 69, NULL, NULL, 2, 1),
(732, 1, ' Accounting', 'accounting-5', 69, NULL, NULL, 2, 1),
(733, 1, ' Finance Fundamentals', 'finance-fundamentals-6', 69, NULL, NULL, 2, 1),
(734, 1, ' Value Added Tax (VAT)', 'value-added-tax-vat', 69, NULL, NULL, 2, 1),
(735, 1, ' Law', 'law-1', 69, NULL, NULL, 2, 1),
(736, 1, ' Financial Planning', 'financial-planning', 69, NULL, NULL, 2, 1),
(737, 1, 'PowerPoint', 'powerpoint-3', 70, NULL, NULL, 2, 1),
(738, 1, ' Passive Income', 'passive-income-2', 70, NULL, NULL, 2, 1),
(739, 1, ' Financial Planning', 'financial-planning-1', 70, NULL, NULL, 2, 1),
(740, 1, ' Coaching', 'coaching', 70, NULL, NULL, 2, 1),
(741, 1, ' Personal Finance', 'personal-finance-4', 70, NULL, NULL, 2, 1),
(742, 1, ' Finance Fundamentals', 'finance-fundamentals-7', 70, NULL, NULL, 2, 1),
(743, 1, ' Online Business', 'online-business-2', 70, NULL, NULL, 2, 1),
(744, 1, ' AdSense', 'adsense', 70, NULL, NULL, 2, 1),
(745, 1, ' Debt', 'debt', 70, NULL, NULL, 2, 1),
(746, 1, 'Pilates', 'pilates', 144, NULL, NULL, 2, 1),
(747, 1, ' Home Workout', 'home-workout', 144, NULL, NULL, 2, 1),
(748, 1, ' Teacher Training', 'teacher-training-1', 144, NULL, NULL, 2, 1),
(749, 1, ' Muscle Building', 'muscle-building', 144, NULL, NULL, 2, 1),
(750, 1, ' Kettlebell', 'kettlebell', 144, NULL, NULL, 2, 1),
(751, 1, ' Stretching Exercise', 'stretching-exercise', 144, NULL, NULL, 2, 1),
(752, 1, ' Testosterone', 'testosterone', 144, NULL, NULL, 2, 1),
(753, 1, ' Posture', 'posture', 144, NULL, NULL, 2, 1),
(754, 1, 'Herbalism', 'herbalism-1', 145, NULL, NULL, 2, 1),
(755, 1, ' Massage', 'massage', 145, NULL, NULL, 2, 1),
(756, 1, ' Aromatherapy', 'aromatherapy', 145, NULL, NULL, 2, 1),
(757, 1, ' Acupressure', 'acupressure', 145, NULL, NULL, 2, 1),
(758, 1, ' Essential Oil', 'essential-oil', 145, NULL, NULL, 2, 1),
(759, 1, ' Reflexology', 'reflexology', 145, NULL, NULL, 2, 1),
(760, 1, ' Tai Chi', 'tai-chi', 145, NULL, NULL, 2, 1),
(761, 1, ' Qi Gong', 'qi-gong', 145, NULL, NULL, 2, 1),
(762, 1, ' Health', 'health', 145, NULL, NULL, 2, 1),
(763, 1, 'Sport Psychology', 'sport-psychology', 146, NULL, NULL, 2, 1),
(764, 1, ' Soccer', 'soccer', 146, NULL, NULL, 2, 1),
(765, 1, ' Sports Coaching', 'sports-coaching', 146, NULL, NULL, 2, 1),
(766, 1, ' Tennis', 'tennis', 146, NULL, NULL, 2, 1),
(767, 1, ' Golf', 'golf', 146, NULL, NULL, 2, 1),
(768, 1, ' Martial Arts', 'martial-arts', 146, NULL, NULL, 2, 1),
(769, 1, ' Running', 'running', 146, NULL, NULL, 2, 1),
(770, 1, ' Fitness', 'fitness-1', 146, NULL, NULL, 2, 1),
(771, 1, ' Inline Skating', 'inline-skating', 146, NULL, NULL, 2, 1),
(772, 1, 'Health Coaching', 'health-coaching', 147, NULL, NULL, 2, 1),
(773, 1, ' Dieting', 'dieting-1', 147, NULL, NULL, 2, 1),
(774, 1, ' Sports Nutrition', 'sports-nutrition', 147, NULL, NULL, 2, 1),
(775, 1, ' Vegan Cooking', 'vegan-cooking', 147, NULL, NULL, 2, 1),
(776, 1, ' Ketogenic Diet', 'ketogenic-diet', 147, NULL, NULL, 2, 1),
(777, 1, ' Gut Health', 'gut-health', 147, NULL, NULL, 2, 1),
(778, 1, ' Fasting', 'fasting', 147, NULL, NULL, 2, 1),
(779, 1, ' Weight Loss', 'weight-loss', 147, NULL, NULL, 2, 1),
(780, 1, 'CBT', 'cbt', 149, NULL, NULL, 2, 1),
(781, 1, ' Art Therapy', 'art-therapy', 149, NULL, NULL, 2, 1),
(782, 1, ' Hypnotherapy', 'hypnotherapy', 149, NULL, NULL, 2, 1),
(783, 1, ' Medical Terminology', 'medical-terminology', 149, NULL, NULL, 2, 1),
(784, 1, ' Neuroplasticity', 'neuroplasticity', 149, NULL, NULL, 2, 1),
(785, 1, ' Anxiety Management', 'anxiety-management', 149, NULL, NULL, 2, 1),
(786, 1, ' Childhood Trauma Healing', 'childhood-trauma-healing', 149, NULL, NULL, 2, 1),
(787, 1, ' PTSD', 'ptsd', 149, NULL, NULL, 2, 1),
(788, 1, 'Weight Loss', 'weight-loss-1', 150, NULL, NULL, 2, 1),
(789, 1, ' Ketogenic Diet', 'ketogenic-diet-1', 150, NULL, NULL, 2, 1),
(790, 1, ' Ketosis', 'ketosis', 150, NULL, NULL, 2, 1),
(791, 1, ' Psychology', 'psychology', 150, NULL, NULL, 2, 1),
(792, 1, ' Nutrition', 'nutrition-1', 150, NULL, NULL, 2, 1),
(793, 1, ' Fasting', 'fasting-1', 150, NULL, NULL, 2, 1),
(794, 1, ' Positive Psychology', 'positive-psychology', 150, NULL, NULL, 2, 1);
INSERT INTO `categories` (`id`, `user_id`, `category_name`, `slug`, `category_id`, `thumbnail_id`, `icon_class`, `step`, `status`) VALUES
(795, 1, ' Gluten Free Cooking and Baking', 'gluten-free-cooking-and-baking-1', 150, NULL, NULL, 2, 1),
(796, 1, 'Self-Defense', 'self-defense-1', 151, NULL, NULL, 2, 1),
(797, 1, ' Close Combat', 'close-combat', 151, NULL, NULL, 2, 1),
(798, 1, ' Tai Chi', 'tai-chi-1', 151, NULL, NULL, 2, 1),
(799, 1, ' Martial Arts', 'martial-arts-1', 151, NULL, NULL, 2, 1),
(800, 1, ' Boxing', 'boxing', 151, NULL, NULL, 2, 1),
(801, 1, ' Wing Chun', 'wing-chun', 151, NULL, NULL, 2, 1),
(802, 1, ' Krav Maga', 'krav-maga', 151, NULL, NULL, 2, 1),
(803, 1, ' Muay Thai', 'muay-thai', 151, NULL, NULL, 2, 1),
(804, 1, ' Brazilian Jiu-Jitsu', 'brazilian-jiu-jitsu', 151, NULL, NULL, 2, 1),
(805, 1, 'First Aid', 'first-aid', 152, NULL, NULL, 2, 1),
(806, 1, ' Herbalism', 'herbalism-2', 152, NULL, NULL, 2, 1),
(807, 1, ' Survival Skills', 'survival-skills', 152, NULL, NULL, 2, 1),
(808, 1, ' Personal Emergency Preparedness', 'personal-emergency-preparedness', 152, NULL, NULL, 2, 1),
(809, 1, ' OSHA', 'osha', 152, NULL, NULL, 2, 1),
(810, 1, ' Workplace Health and Safety', 'workplace-health-and-safety', 152, NULL, NULL, 2, 1),
(811, 1, ' Microbiology', 'microbiology', 152, NULL, NULL, 2, 1),
(812, 1, ' Food Safety', 'food-safety', 152, NULL, NULL, 2, 1),
(813, 1, ' Mental Health', 'mental-health-1', 152, NULL, NULL, 2, 1),
(814, 1, 'Hip Hop Dancing', 'hip-hop-dancing', 153, NULL, NULL, 2, 1),
(815, 1, ' Belly Dancing', 'belly-dancing', 153, NULL, NULL, 2, 1),
(816, 1, ' Salsa Dancing', 'salsa-dancing', 153, NULL, NULL, 2, 1),
(817, 1, ' Ballet', 'ballet', 153, NULL, NULL, 2, 1),
(818, 1, ' Poi Spinning', 'poi-spinning', 153, NULL, NULL, 2, 1),
(819, 1, ' Bachata', 'bachata', 153, NULL, NULL, 2, 1),
(820, 1, ' Breakdancing', 'breakdancing', 153, NULL, NULL, 2, 1),
(821, 1, ' Street Dance', 'street-dance', 153, NULL, NULL, 2, 1),
(822, 1, 'Energy Healing', 'energy-healing', 154, NULL, NULL, 2, 1),
(823, 1, ' Mindfulness', 'mindfulness', 154, NULL, NULL, 2, 1),
(824, 1, ' Psychic', 'psychic', 154, NULL, NULL, 2, 1),
(825, 1, ' Chakra', 'chakra', 154, NULL, NULL, 2, 1),
(826, 1, ' Reiki', 'reiki', 154, NULL, NULL, 2, 1),
(827, 1, ' Addiction Recovery', 'addiction-recovery', 154, NULL, NULL, 2, 1),
(828, 1, ' Crystal Energy', 'crystal-energy', 154, NULL, NULL, 2, 1),
(829, 1, ' Stress Management', 'stress-management-1', 154, NULL, NULL, 2, 1),
(830, 1, 'AWS Certification', 'aws-certification-2', 71, NULL, NULL, 2, 1),
(831, 1, ' AWS Certified Solutions Architect - Associate', 'aws-certified-solutions-architect-associate', 71, NULL, NULL, 2, 1),
(832, 1, ' Microsoft Certification', 'microsoft-certification', 71, NULL, NULL, 2, 1),
(833, 1, ' Cisco CCNA', 'cisco-ccna', 71, NULL, NULL, 2, 1),
(834, 1, ' CompTIA A+', 'comptia-a', 71, NULL, NULL, 2, 1),
(835, 1, ' CCNA 200-301', 'ccna-200-301', 71, NULL, NULL, 2, 1),
(836, 1, ' AWS Certified Developer - Associate', 'aws-certified-developer-associate', 71, NULL, NULL, 2, 1),
(837, 1, ' AWS Certified Cloud Practitioner', 'aws-certified-cloud-practitioner', 71, NULL, NULL, 2, 1),
(838, 1, ' CompTIA Security+', 'comptia-security', 71, NULL, NULL, 2, 1),
(839, 1, 'Ethical Hacking', 'ethical-hacking', 72, NULL, NULL, 2, 1),
(840, 1, ' Cyber Security', 'cyber-security', 72, NULL, NULL, 2, 1),
(841, 1, ' Network Security', 'network-security-1', 72, NULL, NULL, 2, 1),
(842, 1, ' CompTIA Security+', 'comptia-security-1', 72, NULL, NULL, 2, 1),
(843, 1, ' Penetration Testing', 'penetration-testing', 72, NULL, NULL, 2, 1),
(844, 1, ' IT Networking Fundamentals', 'it-networking-fundamentals', 72, NULL, NULL, 2, 1),
(845, 1, ' CompTIA Network+', 'comptia-network', 72, NULL, NULL, 2, 1),
(846, 1, ' Cisco CCNA', 'cisco-ccna-1', 72, NULL, NULL, 2, 1),
(847, 1, ' Kubernetes', 'kubernetes-2', 72, NULL, NULL, 2, 1),
(848, 1, 'Linux', 'linux', 84, NULL, NULL, 2, 1),
(849, 1, ' Windows Server', 'windows-server', 84, NULL, NULL, 2, 1),
(850, 1, ' Linux Administration', 'linux-administration', 84, NULL, NULL, 2, 1),
(851, 1, ' Shell Scripting', 'shell-scripting', 84, NULL, NULL, 2, 1),
(852, 1, ' Active Directory', 'active-directory', 84, NULL, NULL, 2, 1),
(853, 1, ' PowerShell', 'powershell', 84, NULL, NULL, 2, 1),
(854, 1, ' VMware Vsphere', 'vmware-vsphere', 84, NULL, NULL, 2, 1),
(855, 1, ' LPIC-1: Linux Administrator', 'lpic-1-linux-administrator', 84, NULL, NULL, 2, 1),
(856, 1, ' System Center Configuration', 'system-center-configuration', 84, NULL, NULL, 2, 1),
(857, 1, 'DevOps', 'devops-1', 85, NULL, NULL, 2, 1),
(858, 1, ' Kubernetes', 'kubernetes-3', 85, NULL, NULL, 2, 1),
(859, 1, ' Python', 'python-3', 85, NULL, NULL, 2, 1),
(860, 1, ' Docker', 'docker-1', 85, NULL, NULL, 2, 1),
(861, 1, ' AWS Certification', 'aws-certification-3', 85, NULL, NULL, 2, 1),
(862, 1, ' AWS Certified Solutions Architect - Professional', 'aws-certified-solutions-architect-professional', 85, NULL, NULL, 2, 1),
(863, 1, ' Ansible', 'ansible', 85, NULL, NULL, 2, 1),
(864, 1, ' Microsoft Azure', 'microsoft-azure', 85, NULL, NULL, 2, 1),
(865, 1, ' Algorithms', 'algorithms', 85, NULL, NULL, 2, 1),
(866, 1, 'Instruments', 'instruments', 18, NULL, '0', 1, 1),
(867, 1, 'Production', 'production', 18, NULL, '0', 1, 1),
(868, 1, 'Music Fundamentals', 'music-fundamentals', 18, NULL, '0', 1, 1),
(869, 1, 'Vocal', 'vocal', 18, NULL, '0', 1, 1),
(870, 1, 'Music Techniques', 'music-techniques', 18, NULL, '0', 1, 1),
(871, 1, 'Music Software', 'music-software', 18, NULL, '0', 1, 1),
(872, 1, 'Piano', 'piano', 866, NULL, NULL, 2, 1),
(873, 1, ' Guitar', 'guitar', 866, NULL, NULL, 2, 1),
(874, 1, ' Keyboard Instrument', 'keyboard-instrument', 866, NULL, NULL, 2, 1),
(875, 1, ' Fingerstyle Guitar', 'fingerstyle-guitar', 866, NULL, NULL, 2, 1),
(876, 1, ' Ukulele', 'ukulele', 866, NULL, NULL, 2, 1),
(877, 1, ' Harmonica', 'harmonica', 866, NULL, NULL, 2, 1),
(878, 1, ' Bass Guitar', 'bass-guitar', 866, NULL, NULL, 2, 1),
(879, 1, ' Drums', 'drums', 866, NULL, NULL, 2, 1),
(880, 1, ' Violin', 'violin', 866, NULL, NULL, 2, 1),
(881, 1, 'Music Production', 'music-production', 867, NULL, NULL, 2, 1),
(882, 1, ' Logic Pro X', 'logic-pro-x', 867, NULL, NULL, 2, 1),
(883, 1, ' Ableton Live', 'ableton-live', 867, NULL, NULL, 2, 1),
(884, 1, ' Music Mixing', 'music-mixing', 867, NULL, NULL, 2, 1),
(885, 1, ' Audio Production', 'audio-production', 867, NULL, NULL, 2, 1),
(886, 1, ' FL Studio', 'fl-studio', 867, NULL, NULL, 2, 1),
(887, 1, ' Music Composition', 'music-composition', 867, NULL, NULL, 2, 1),
(888, 1, ' Game Music', 'game-music', 867, NULL, NULL, 2, 1),
(889, 1, ' Sound Design', 'sound-design', 867, NULL, NULL, 2, 1),
(890, 1, 'Music Theory', 'music-theory', 868, NULL, NULL, 2, 1),
(891, 1, ' Music Composition', 'music-composition-1', 868, NULL, NULL, 2, 1),
(892, 1, ' Electronic Music', 'electronic-music', 868, NULL, NULL, 2, 1),
(893, 1, ' Songwriting', 'songwriting', 868, NULL, NULL, 2, 1),
(894, 1, ' Blues Guitar', 'blues-guitar', 868, NULL, NULL, 2, 1),
(895, 1, ' Reading Music', 'reading-music', 868, NULL, NULL, 2, 1),
(896, 1, ' Piano Chords', 'piano-chords', 868, NULL, NULL, 2, 1),
(897, 1, ' ABRSM', 'abrsm', 868, NULL, NULL, 2, 1),
(898, 1, ' Piano', 'piano-1', 868, NULL, NULL, 2, 1),
(899, 1, 'Singing', 'singing', 869, NULL, NULL, 2, 1),
(900, 1, ' Voice Training', 'voice-training', 869, NULL, NULL, 2, 1),
(901, 1, ' Voice Acting', 'voice-acting', 869, NULL, NULL, 2, 1),
(902, 1, ' Rapping', 'rapping', 869, NULL, NULL, 2, 1),
(903, 1, ' Voice-Over', 'voice-over-1', 869, NULL, NULL, 2, 1),
(904, 1, ' Yoga', 'yoga-1', 869, NULL, NULL, 2, 1),
(905, 1, ' Raga Music', 'raga-music', 869, NULL, NULL, 2, 1),
(906, 1, ' Breathing Techniques', 'breathing-techniques', 869, NULL, NULL, 2, 1),
(907, 1, ' Carnatic Music', 'carnatic-music', 869, NULL, NULL, 2, 1),
(908, 1, 'Music Composition', 'music-composition-2', 870, NULL, NULL, 2, 1),
(909, 1, ' Acoustic Guitar', 'acoustic-guitar', 870, NULL, NULL, 2, 1),
(910, 1, ' Reading Music', 'reading-music-1', 870, NULL, NULL, 2, 1),
(911, 1, ' Guitar', 'guitar-1', 870, NULL, NULL, 2, 1),
(912, 1, ' DJ', 'dj', 870, NULL, NULL, 2, 1),
(913, 1, ' Music Theory', 'music-theory-1', 870, NULL, NULL, 2, 1),
(914, 1, ' Guitar Chords', 'guitar-chords', 870, NULL, NULL, 2, 1),
(915, 1, ' Fingerstyle Guitar', 'fingerstyle-guitar-1', 870, NULL, NULL, 2, 1),
(916, 1, ' Songwriting', 'songwriting-1', 870, NULL, NULL, 2, 1),
(917, 1, 'FL Studio', 'fl-studio-1', 871, NULL, NULL, 2, 1),
(918, 1, ' Ableton Live', 'ableton-live-1', 871, NULL, NULL, 2, 1),
(919, 1, ' Logic Pro X', 'logic-pro-x-1', 871, NULL, NULL, 2, 1),
(920, 1, ' Music Production', 'music-production-1', 871, NULL, NULL, 2, 1),
(921, 1, ' GarageBand', 'garageband', 871, NULL, NULL, 2, 1),
(922, 1, ' Pro Tools', 'pro-tools', 871, NULL, NULL, 2, 1),
(923, 1, ' DJ', 'dj-1', 871, NULL, NULL, 2, 1),
(924, 1, ' Cubase', 'cubase', 871, NULL, NULL, 2, 1),
(925, 1, ' Xfer Serum', 'xfer-serum', 871, NULL, NULL, 2, 1),
(926, 1, 'Excel', 'excel-5', 86, NULL, NULL, 2, 1),
(927, 1, ' Excel VBA', 'excel-vba', 86, NULL, NULL, 2, 1),
(928, 1, ' Excel Formulas and Functions', 'excel-formulas-and-functions', 86, NULL, NULL, 2, 1),
(929, 1, ' Data Analysis', 'data-analysis-3', 86, NULL, NULL, 2, 1),
(930, 1, ' PowerPoint', 'powerpoint-4', 86, NULL, NULL, 2, 1),
(931, 1, ' Pivot Tables', 'pivot-tables', 86, NULL, NULL, 2, 1),
(932, 1, ' Microsoft Word', 'microsoft-word', 86, NULL, NULL, 2, 1),
(933, 1, ' Microsoft Power BI', 'microsoft-power-bi-1', 86, NULL, NULL, 2, 1),
(934, 1, ' Microsoft Access', 'microsoft-access', 86, NULL, NULL, 2, 1),
(935, 1, 'iMovie', 'imovie-1', 87, NULL, NULL, 2, 1),
(936, 1, ' Apple Keynote', 'apple-keynote', 87, NULL, NULL, 2, 1),
(937, 1, ' Mac Basics', 'mac-basics-1', 87, NULL, NULL, 2, 1),
(938, 1, ' macOS', 'macos', 87, NULL, NULL, 2, 1),
(939, 1, ' Numbers For Mac', 'numbers-for-mac', 87, NULL, NULL, 2, 1),
(940, 1, ' Mac Pages', 'mac-pages', 87, NULL, NULL, 2, 1),
(941, 1, ' Microsoft Word', 'microsoft-word-1', 87, NULL, NULL, 2, 1),
(942, 1, ' Microsoft Office 365', 'microsoft-office-365', 87, NULL, NULL, 2, 1),
(943, 1, ' PowerPoint', 'powerpoint-5', 87, NULL, NULL, 2, 1),
(944, 1, 'Google Sheets', 'google-sheets', 88, NULL, NULL, 2, 1),
(945, 1, ' Google Drive', 'google-drive', 88, NULL, NULL, 2, 1),
(946, 1, ' Google Apps', 'google-apps', 88, NULL, NULL, 2, 1),
(947, 1, ' Excel', 'excel-6', 88, NULL, NULL, 2, 1),
(948, 1, ' Gmail Productivity', 'gmail-productivity', 88, NULL, NULL, 2, 1),
(949, 1, ' G Suite', 'g-suite', 88, NULL, NULL, 2, 1),
(950, 1, ' Google Docs', 'google-docs', 88, NULL, NULL, 2, 1),
(951, 1, ' Python', 'python-4', 88, NULL, NULL, 2, 1),
(952, 1, ' Google Classroom', 'google-classroom', 88, NULL, NULL, 2, 1),
(953, 1, 'SAP ABAP', 'sap-abap', 89, NULL, NULL, 2, 1),
(954, 1, ' SAP MM', 'sap-mm', 89, NULL, NULL, 2, 1),
(955, 1, ' SAP S/4HANA', 'sap-s4hana', 89, NULL, NULL, 2, 1),
(956, 1, ' SAP Financial Accounting', 'sap-financial-accounting', 89, NULL, NULL, 2, 1),
(957, 1, ' SAP SD', 'sap-sd', 89, NULL, NULL, 2, 1),
(958, 1, ' Supply Chain', 'supply-chain-2', 89, NULL, NULL, 2, 1),
(959, 1, ' SAP HCM', 'sap-hcm', 89, NULL, NULL, 2, 1),
(960, 1, ' SAP FICO', 'sap-fico-2', 89, NULL, NULL, 2, 1),
(961, 1, 'Oracle Database', 'oracle-database', 90, NULL, NULL, 2, 1),
(962, 1, ' Pl/SQL', 'plsql', 90, NULL, NULL, 2, 1),
(963, 1, ' Oracle SQL', 'oracle-sql-1', 90, NULL, NULL, 2, 1),
(964, 1, ' Database Administration', 'database-administration', 90, NULL, NULL, 2, 1),
(965, 1, ' Oracle Fusion HCM', 'oracle-fusion-hcm', 90, NULL, NULL, 2, 1),
(966, 1, ' SQL', 'sql-3', 90, NULL, NULL, 2, 1),
(967, 1, ' Oracle Primavera', 'oracle-primavera', 90, NULL, NULL, 2, 1),
(968, 1, ' Project Planning', 'project-planning', 90, NULL, NULL, 2, 1),
(969, 1, ' Oracle Business Intelligence', 'oracle-business-intelligence', 90, NULL, NULL, 2, 1),
(970, 1, 'Life Coach Training', 'life-coach-training-1', 91, NULL, NULL, 2, 1),
(971, 1, ' Reiki', 'reiki-1', 91, NULL, NULL, 2, 1),
(972, 1, ' Neuro-Linguistic Programming', 'neuro-linguistic-programming', 91, NULL, NULL, 2, 1),
(973, 1, ' Energy Healing', 'energy-healing-1', 91, NULL, NULL, 2, 1),
(974, 1, ' Neuroscience', 'neuroscience', 91, NULL, NULL, 2, 1),
(975, 1, ' Meditation', 'meditation-3', 91, NULL, NULL, 2, 1),
(976, 1, ' Personal Development', 'personal-development-1', 91, NULL, NULL, 2, 1),
(977, 1, 'Personal Productivity', 'personal-productivity', 92, NULL, NULL, 2, 1),
(978, 1, ' Time Management', 'time-management', 92, NULL, NULL, 2, 1),
(979, 1, ' Speed Reading', 'speed-reading', 92, NULL, NULL, 2, 1),
(980, 1, ' Focus Mastery', 'focus-mastery', 92, NULL, NULL, 2, 1),
(981, 1, ' Visual Thinking', 'visual-thinking', 92, NULL, NULL, 2, 1),
(982, 1, ' Goal Setting', 'goal-setting', 92, NULL, NULL, 2, 1),
(983, 1, ' Organization', 'organization', 92, NULL, NULL, 2, 1),
(984, 1, ' PowerShell', 'powershell-1', 92, NULL, NULL, 2, 1),
(985, 1, ' English Language', 'english-language', 92, NULL, NULL, 2, 1),
(986, 1, 'Management Skills', 'management-skills-1', 93, NULL, NULL, 2, 1),
(987, 1, ' Manager Training', 'manager-training', 93, NULL, NULL, 2, 1),
(988, 1, ' Public Speaking', 'public-speaking-2', 93, NULL, NULL, 2, 1),
(989, 1, ' Communication Skills', 'communication-skills-1', 93, NULL, NULL, 2, 1),
(990, 1, ' Conflict Management', 'conflict-management-1', 93, NULL, NULL, 2, 1),
(991, 1, ' Emotional Intelligence', 'emotional-intelligence-1', 93, NULL, NULL, 2, 1),
(992, 1, ' Team Building', 'team-building', 93, NULL, NULL, 2, 1),
(993, 1, ' Italian Language', 'italian-language', 93, NULL, NULL, 2, 1),
(994, 1, 'Stock Trading', 'stock-trading', 94, NULL, NULL, 2, 1),
(995, 1, ' Technical Analysis', 'technical-analysis', 94, NULL, NULL, 2, 1),
(996, 1, ' Forex', 'forex', 94, NULL, NULL, 2, 1),
(997, 1, ' Day Trading', 'day-trading', 94, NULL, NULL, 2, 1),
(998, 1, ' Options Trading', 'options-trading', 94, NULL, NULL, 2, 1),
(999, 1, ' Stock Options', 'stock-options', 94, NULL, NULL, 2, 1),
(1000, 1, ' Value Investing', 'value-investing', 94, NULL, NULL, 2, 1),
(1001, 1, ' Financial Trading', 'financial-trading', 94, NULL, NULL, 2, 1),
(1002, 1, 'Resume and CV Writing', 'resume-and-cv-writing', 95, NULL, NULL, 2, 1),
(1003, 1, ' Interviewing Skills', 'interviewing-skills-1', 95, NULL, NULL, 2, 1),
(1004, 1, ' LinkedIn', 'linkedin-2', 95, NULL, NULL, 2, 1),
(1005, 1, ' Life Coach Training', 'life-coach-training-2', 95, NULL, NULL, 2, 1),
(1006, 1, ' Job Search', 'job-search', 95, NULL, NULL, 2, 1),
(1007, 1, ' Personal Networking', 'personal-networking', 95, NULL, NULL, 2, 1),
(1008, 1, ' Soft Skills', 'soft-skills', 95, NULL, NULL, 2, 1),
(1009, 1, ' Shopify Dropshipping', 'shopify-dropshipping-1', 95, NULL, NULL, 2, 1),
(1010, 1, ' Career Coaching', 'career-coaching-1', 95, NULL, NULL, 2, 1),
(1011, 1, 'Parenting', 'parenting', 96, NULL, NULL, 2, 1),
(1012, 1, ' Neuroscience', 'neuroscience-1', 96, NULL, NULL, 2, 1),
(1013, 1, ' Relationship Building', 'relationship-building', 96, NULL, NULL, 2, 1),
(1014, 1, ' Life Coach Training', 'life-coach-training-3', 96, NULL, NULL, 2, 1),
(1015, 1, ' Dating', 'dating', 96, NULL, NULL, 2, 1),
(1016, 1, ' Child Psychology', 'child-psychology', 96, NULL, NULL, 2, 1),
(1017, 1, ' Counseling', 'counseling-1', 96, NULL, NULL, 2, 1),
(1018, 1, ' Early Childhood Education', 'early-childhood-education', 96, NULL, NULL, 2, 1),
(1019, 1, ' Love', 'love', 96, NULL, NULL, 2, 1),
(1020, 1, 'Life Coach Training', 'life-coach-training-4', 97, NULL, NULL, 2, 1),
(1021, 1, ' CBT', 'cbt-1', 97, NULL, NULL, 2, 1),
(1022, 1, ' Positive Psychology', 'positive-psychology-1', 97, NULL, NULL, 2, 1),
(1023, 1, ' Mindfulness', 'mindfulness-1', 97, NULL, NULL, 2, 1),
(1024, 1, ' Law of Attraction', 'law-of-attraction', 97, NULL, NULL, 2, 1),
(1025, 1, ' Childhood Trauma Healing', 'childhood-trauma-healing-1', 97, NULL, NULL, 2, 1),
(1026, 1, ' Habits', 'habits', 97, NULL, NULL, 2, 1),
(1027, 1, ' Psychology', 'psychology-1', 97, NULL, NULL, 2, 1),
(1028, 1, 'Psychic', 'psychic-1', 98, NULL, NULL, 2, 1),
(1029, 1, ' Spirituality', 'spirituality', 98, NULL, NULL, 2, 1),
(1030, 1, ' Tarot Reading', 'tarot-reading', 98, NULL, NULL, 2, 1),
(1031, 1, ' Shamanism', 'shamanism', 98, NULL, NULL, 2, 1),
(1032, 1, ' Mediumship', 'mediumship', 98, NULL, NULL, 2, 1),
(1033, 1, ' Spiritual Healing', 'spiritual-healing', 98, NULL, NULL, 2, 1),
(1034, 1, ' Crystal Energy', 'crystal-energy-1', 98, NULL, NULL, 2, 1),
(1035, 1, ' Past Lives', 'past-lives', 98, NULL, NULL, 2, 1),
(1036, 1, ' Reiki', 'reiki-2', 98, NULL, NULL, 2, 1),
(1037, 1, 'Personal Branding', 'personal-branding-1', 99, NULL, NULL, 2, 1),
(1038, 1, ' French Language', 'french-language', 99, NULL, NULL, 2, 1),
(1039, 1, ' LinkedIn', 'linkedin-3', 99, NULL, NULL, 2, 1),
(1040, 1, ' Body Language', 'body-language', 99, NULL, NULL, 2, 1),
(1041, 1, ' Writing a Book', 'writing-a-book', 99, NULL, NULL, 2, 1),
(1042, 1, ' Business Branding', 'business-branding-1', 99, NULL, NULL, 2, 1),
(1043, 1, ' Digital Marketing', 'digital-marketing-3', 99, NULL, NULL, 2, 1),
(1044, 1, ' Career Development', 'career-development-1', 99, NULL, NULL, 2, 1),
(1045, 1, ' Business Communication', 'business-communication', 99, NULL, NULL, 2, 1),
(1046, 1, 'Creative Writing', 'creative-writing', 100, NULL, NULL, 2, 1),
(1047, 1, ' Art Therapy', 'art-therapy-1', 100, NULL, NULL, 2, 1),
(1048, 1, ' Screenwriting', 'screenwriting-1', 100, NULL, NULL, 2, 1),
(1049, 1, ' Writing', 'writing-3', 100, NULL, NULL, 2, 1),
(1050, 1, ' Writing a Book', 'writing-a-book-1', 100, NULL, NULL, 2, 1),
(1051, 1, ' Storytelling', 'storytelling-2', 100, NULL, NULL, 2, 1),
(1052, 1, ' Watercolor Painting', 'watercolor-painting-1', 100, NULL, NULL, 2, 1),
(1053, 1, ' Drawing', 'drawing-4', 100, NULL, NULL, 2, 1),
(1054, 1, ' Aromatherapy', 'aromatherapy-1', 100, NULL, NULL, 2, 1),
(1055, 1, 'Confidence', 'confidence', 101, NULL, NULL, 2, 1),
(1056, 1, ' Public Speaking', 'public-speaking-3', 101, NULL, NULL, 2, 1),
(1057, 1, ' Body Language', 'body-language-1', 101, NULL, NULL, 2, 1),
(1058, 1, ' Voice Training', 'voice-training-1', 101, NULL, NULL, 2, 1),
(1059, 1, ' Negotiation', 'negotiation', 101, NULL, NULL, 2, 1),
(1060, 1, ' Communication Skills', 'communication-skills-2', 101, NULL, NULL, 2, 1),
(1061, 1, ' Persuasion', 'persuasion-1', 101, NULL, NULL, 2, 1),
(1062, 1, ' Entrepreneurship Fundamentals', 'entrepreneurship-fundamentals-3', 101, NULL, NULL, 2, 1),
(1063, 1, ' Presentation Skills', 'presentation-skills-3', 101, NULL, NULL, 2, 1),
(1064, 1, 'Confidence', 'confidence-1', 102, NULL, NULL, 2, 1),
(1065, 1, ' Self-Esteem', 'self-esteem-1', 102, NULL, NULL, 2, 1),
(1066, 1, ' Neuro-Linguistic Programming', 'neuro-linguistic-programming-1', 102, NULL, NULL, 2, 1),
(1067, 1, ' Social Skills', 'social-skills', 102, NULL, NULL, 2, 1),
(1068, 1, ' Art for Kids', 'art-for-kids', 102, NULL, NULL, 2, 1),
(1069, 1, ' Drawing', 'drawing-5', 102, NULL, NULL, 2, 1),
(1070, 1, ' Dance', 'dance-1', 102, NULL, NULL, 2, 1),
(1071, 1, ' Anxiety Management', 'anxiety-management-1', 102, NULL, NULL, 2, 1),
(1072, 1, ' Personal Development', 'personal-development-2', 102, NULL, NULL, 2, 1),
(1073, 1, 'Anxiety Management', 'anxiety-management-2', 103, NULL, NULL, 2, 1),
(1074, 1, ' Emotional Intelligence', 'emotional-intelligence-2', 103, NULL, NULL, 2, 1),
(1075, 1, ' Anger Management', 'anger-management', 103, NULL, NULL, 2, 1),
(1076, 1, ' Resilience', 'resilience', 103, NULL, NULL, 2, 1),
(1077, 1, ' Conflict Management', 'conflict-management-2', 103, NULL, NULL, 2, 1),
(1078, 1, ' EFT', 'eft', 103, NULL, NULL, 2, 1),
(1079, 1, ' Meditation', 'meditation-4', 103, NULL, NULL, 2, 1),
(1080, 1, ' Mindfulness', 'mindfulness-2', 103, NULL, NULL, 2, 1),
(1081, 1, 'Memory', 'memory', 104, NULL, NULL, 2, 1),
(1082, 1, ' Speed Reading', 'speed-reading-1', 104, NULL, NULL, 2, 1),
(1083, 1, ' Learning Strategies', 'learning-strategies', 104, NULL, NULL, 2, 1),
(1084, 1, ' Study Skills', 'study-skills', 104, NULL, NULL, 2, 1),
(1085, 1, ' Focus Mastery', 'focus-mastery-1', 104, NULL, NULL, 2, 1),
(1086, 1, ' Mind Mapping', 'mind-mapping', 104, NULL, NULL, 2, 1),
(1087, 1, ' Learning Disability', 'learning-disability', 104, NULL, NULL, 2, 1),
(1088, 1, ' Mental Math', 'mental-math', 104, NULL, NULL, 2, 1),
(1089, 1, ' Personal Development', 'personal-development-3', 104, NULL, NULL, 2, 1),
(1090, 1, 'Neuroplasticity', 'neuroplasticity-1', 105, NULL, NULL, 2, 1),
(1091, 1, ' Procrastination', 'procrastination', 105, NULL, NULL, 2, 1),
(1092, 1, ' Neuroscience', 'neuroscience-2', 105, NULL, NULL, 2, 1),
(1093, 1, ' Personal Success', 'personal-success', 105, NULL, NULL, 2, 1),
(1094, 1, ' Confidence', 'confidence-2', 105, NULL, NULL, 2, 1),
(1095, 1, ' Neuro-Linguistic Programming', 'neuro-linguistic-programming-2', 105, NULL, NULL, 2, 1),
(1096, 1, ' Mindset', 'mindset', 105, NULL, NULL, 2, 1),
(1097, 1, ' Christianity', 'christianity', 105, NULL, NULL, 2, 1),
(1098, 1, 'Tantra', 'tantra', 106, NULL, NULL, 2, 1),
(1099, 1, ' Freight Broker', 'freight-broker', 106, NULL, NULL, 2, 1),
(1100, 1, ' Fibonacci Trading', 'fibonacci-trading', 106, NULL, NULL, 2, 1),
(1101, 1, ' English Pronunciation', 'english-pronunciation', 106, NULL, NULL, 2, 1),
(1102, 1, ' American Accent', 'american-accent', 106, NULL, NULL, 2, 1),
(1103, 1, ' French Language', 'french-language-1', 106, NULL, NULL, 2, 1),
(1104, 1, ' Astrology', 'astrology', 106, NULL, NULL, 2, 1),
(1105, 1, ' Car Repair', 'car-repair', 106, NULL, NULL, 2, 1),
(1106, 1, ' Voice-Over', 'voice-over-2', 106, NULL, NULL, 2, 1),
(1107, 1, 'Photography', 'photography-1', 155, NULL, NULL, 2, 1),
(1108, 1, ' iPhone Photography', 'iphone-photography', 155, NULL, NULL, 2, 1),
(1109, 1, ' DSLR', 'dslr', 155, NULL, NULL, 2, 1),
(1110, 1, ' Adobe Lightroom', 'adobe-lightroom', 155, NULL, NULL, 2, 1),
(1111, 1, ' Affinity Photo', 'affinity-photo', 155, NULL, NULL, 2, 1),
(1112, 1, ' Photoshop', 'photoshop-4', 155, NULL, NULL, 2, 1),
(1113, 1, ' Night Photography', 'night-photography', 155, NULL, NULL, 2, 1),
(1114, 1, ' Portrait Photography', 'portrait-photography', 155, NULL, NULL, 2, 1),
(1115, 1, 'Photography', 'photography-2', 156, NULL, NULL, 2, 1),
(1116, 1, ' Affinity Photo', 'affinity-photo-1', 156, NULL, NULL, 2, 1),
(1117, 1, ' Photography Composition', 'photography-composition', 156, NULL, NULL, 2, 1),
(1118, 1, ' DSLR', 'dslr-1', 156, NULL, NULL, 2, 1),
(1119, 1, ' Digital Photography', 'digital-photography-1', 156, NULL, NULL, 2, 1),
(1120, 1, ' Filmmaking', 'filmmaking', 156, NULL, NULL, 2, 1),
(1121, 1, ' Landscape Photography', 'landscape-photography', 156, NULL, NULL, 2, 1),
(1122, 1, ' Photography Lighting', 'photography-lighting', 156, NULL, NULL, 2, 1),
(1123, 1, ' GIMP', 'gimp', 156, NULL, NULL, 2, 1),
(1124, 1, 'Portrait Photography', 'portrait-photography-1', 157, NULL, NULL, 2, 1),
(1125, 1, ' Photoshop Retouching', 'photoshop-retouching', 157, NULL, NULL, 2, 1),
(1126, 1, ' Posing', 'posing', 157, NULL, NULL, 2, 1),
(1127, 1, ' Photography Lighting', 'photography-lighting-1', 157, NULL, NULL, 2, 1),
(1128, 1, ' Family Portrait Photography', 'family-portrait-photography', 157, NULL, NULL, 2, 1),
(1129, 1, ' Photography', 'photography-3', 157, NULL, NULL, 2, 1),
(1130, 1, ' Photoshop', 'photoshop-5', 157, NULL, NULL, 2, 1),
(1131, 1, ' Cameras', 'cameras', 157, NULL, NULL, 2, 1),
(1132, 1, ' Nik Software', 'nik-software', 157, NULL, NULL, 2, 1),
(1133, 1, 'Adobe Lightroom', 'adobe-lightroom-1', 158, NULL, NULL, 2, 1),
(1134, 1, ' Photoshop', 'photoshop-6', 158, NULL, NULL, 2, 1),
(1135, 1, ' Image Editing', 'image-editing', 158, NULL, NULL, 2, 1),
(1136, 1, ' Affinity Photo', 'affinity-photo-2', 158, NULL, NULL, 2, 1),
(1137, 1, ' Photoshop Retouching', 'photoshop-retouching-1', 158, NULL, NULL, 2, 1),
(1138, 1, ' Cameras', 'cameras-1', 158, NULL, NULL, 2, 1),
(1139, 1, ' Photography', 'photography-4', 158, NULL, NULL, 2, 1),
(1140, 1, ' Drone Photography', 'drone-photography', 158, NULL, NULL, 2, 1),
(1141, 1, ' DSLR', 'dslr-2', 158, NULL, NULL, 2, 1),
(1142, 1, 'Real Estate Photography', 'real-estate-photography', 159, NULL, NULL, 2, 1),
(1143, 1, ' Architecture Photography', 'architecture-photography', 159, NULL, NULL, 2, 1),
(1144, 1, ' Photography Business', 'photography-business', 159, NULL, NULL, 2, 1),
(1145, 1, ' Wedding Photography', 'wedding-photography', 159, NULL, NULL, 2, 1),
(1146, 1, ' Food Photography', 'food-photography', 159, NULL, NULL, 2, 1),
(1147, 1, ' Photography', 'photography-5', 159, NULL, NULL, 2, 1),
(1148, 1, ' Product Photography', 'product-photography', 159, NULL, NULL, 2, 1),
(1149, 1, ' Stock Footage', 'stock-footage', 159, NULL, NULL, 2, 1),
(1150, 1, ' Photoshop', 'photoshop-7', 159, NULL, NULL, 2, 1),
(1151, 1, 'Video Editing', 'video-editing-1', 160, NULL, NULL, 2, 1),
(1152, 1, ' Adobe Premiere', 'adobe-premiere-1', 160, NULL, NULL, 2, 1),
(1153, 1, ' Video Production', 'video-production', 160, NULL, NULL, 2, 1),
(1154, 1, ' Filmmaking', 'filmmaking-1', 160, NULL, NULL, 2, 1),
(1155, 1, ' DaVinci Resolve', 'davinci-resolve', 160, NULL, NULL, 2, 1),
(1156, 1, ' Videography', 'videography', 160, NULL, NULL, 2, 1),
(1157, 1, ' Final Cut Pro', 'final-cut-pro', 160, NULL, NULL, 2, 1),
(1158, 1, ' Color Grading', 'color-grading', 160, NULL, NULL, 2, 1),
(1159, 1, ' Cinematography', 'cinematography', 160, NULL, NULL, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `completes`
--

DROP TABLE IF EXISTS `completes`;
CREATE TABLE `completes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `completed_course_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `content_id` int(11) DEFAULT NULL,
  `completed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `completes`
--

INSERT INTO `completes` (`id`, `user_id`, `completed_course_id`, `course_id`, `content_id`, `completed_at`) VALUES
(1, 1, NULL, 1, 8, '2020-05-02 11:01:52'),
(3, 1, NULL, 1, 14, '2020-05-02 12:06:56'),
(7, 1, 1, NULL, NULL, '2020-05-02 21:16:50'),
(13, 2, NULL, 1, 6, '2020-05-11 06:10:10'),
(15, 3, 8, NULL, NULL, '2020-05-11 10:39:02'),
(17, 3, NULL, 1, 5, '2020-05-11 10:43:14'),
(18, 3, NULL, 1, 6, '2020-05-11 10:43:16'),
(19, 3, NULL, 11, 35, '2020-05-21 08:32:33'),
(20, 3, NULL, 11, 40, '2020-05-21 09:03:07'),
(21, 1, NULL, 1, 17, '2020-05-21 12:24:11'),
(26, 1, NULL, 1, 9, '2020-05-21 13:10:34'),
(27, 1, NULL, 1, 15, '2020-05-21 13:11:24'),
(28, 3, NULL, 1, 9, '2020-05-21 13:28:31'),
(29, 3, NULL, 8, 24, '2020-05-21 13:35:43'),
(31, 3, NULL, 1, 14, '2020-05-21 16:16:50'),
(32, 3, NULL, 1, 17, '2020-05-27 21:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `video_src` text COLLATE utf8mb4_unicode_ci,
  `video_time` int(11) DEFAULT NULL,
  `item_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_preview` tinyint(4) DEFAULT '0',
  `status` tinyint(4) DEFAULT '0',
  `sort_order` tinyint(4) DEFAULT '0',
  `options` text COLLATE utf8mb4_unicode_ci,
  `quiz_gradable` tinyint(4) DEFAULT NULL,
  `unlock_date` timestamp NULL DEFAULT NULL,
  `unlock_days` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`id`, `user_id`, `course_id`, `section_id`, `title`, `slug`, `text`, `video_src`, `video_time`, `item_type`, `is_preview`, `status`, `sort_order`, `options`, `quiz_gradable`, `unlock_date`, `unlock_days`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Variable in PHP (YouTube)', 'variable-in-php-youtube', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '{\"source\":\"youtube\",\"html5_video_id\":null,\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":\"https:\\/\\/www.youtube.com\\/watch?v=qESk52ai8jY\",\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"15\",\"secs\":\"26\"}}', 926, 'lecture', 1, 1, 8, NULL, NULL, NULL, NULL, '2020-04-23 05:55:52', '2020-05-13 17:18:42'),
(2, 1, 1, 2, 'Arrays', 'arrays', '<p>This is long description of an arrays updated</p>', '{\"source\":\"vimeo\",\"html5_video_id\":null,\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":\"https:\\/\\/vimeo.com\\/213274323\",\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"2\",\"secs\":\"20\"}}', 140, 'lecture', NULL, 1, 11, NULL, NULL, NULL, NULL, '2020-04-24 04:38:24', '2020-05-13 17:18:42'),
(5, 1, 1, 1, 'Course Overview', 'course-overview', '<p>This is the greatest lorrem-ipsum site amet.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Thank you for reading...</p>', '{\"source\":\"html5\",\"html5_video_id\":\"1\",\"html5_video_poster_id\":\"2\",\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":\"2\",\"runtime\":{\"hours\":\"00\",\"mins\":\"00\",\"secs\":\"29\"}}', 29, 'lecture', NULL, 1, 1, NULL, NULL, NULL, NULL, '2020-04-24 05:55:57', '2020-05-13 17:18:42'),
(6, 1, 1, 1, 'Local Development tools', 'local-development-tools', '<p>The tools required you to development and running PHP script.</p>', '{\"source\":\"external_url\",\"html5_video_id\":null,\"html5_video_poster_id\":null,\"source_external_url\":\"http:\\/\\/clips.vorwaerts-gmbh.de\\/big_buck_bunny.ogv\",\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 60, 'lecture', 1, 1, 2, NULL, NULL, NULL, NULL, '2020-04-24 05:57:13', '2020-05-13 17:18:42'),
(7, 1, 1, 2, 'Embeded Video (Vimeo)', 'embeded-video-vimeo', '<p>Lecture description of Embeded Video</p>', '{\"source\":\"embedded\",\"html5_video_id\":null,\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":\"<iframe src=\\\"https:\\/\\/player.vimeo.com\\/video\\/75744441\\\" width=\\\"640\\\" height=\\\"360\\\" frameborder=\\\"0\\\" allow=\\\"autoplay; fullscreen\\\" allowfullscreen><\\/iframe>\\r\\n<p><a href=\\\"https:\\/\\/vimeo.com\\/75744441\\\">Yoga Flow<\\/a> from <a href=\\\"https:\\/\\/vimeo.com\\/user5663731\\\">Dylan Glynn<\\/a> on <a href=\\\"https:\\/\\/vimeo.com\\\">Vimeo<\\/a>.<\\/p>\",\"runtime\":{\"hours\":\"00\",\"mins\":\"00\",\"secs\":\"37\"}}', 37, 'lecture', NULL, 1, 7, NULL, NULL, NULL, NULL, '2020-04-26 03:51:42', '2020-05-13 17:18:42'),
(8, 1, 1, 2, 'Embedded Slide', 'embedded-slide', '<p>This is content of embedded slide</p>', '{\"source\":\"embedded\",\"html5_video_id\":null,\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":\"<iframe src=\\\"\\/\\/www.slideshare.net\\/slideshow\\/embed_code\\/key\\/cvzARUM4Wm5TZV\\\" width=\\\"595\\\" height=\\\"485\\\" frameborder=\\\"0\\\" marginwidth=\\\"0\\\" marginheight=\\\"0\\\" scrolling=\\\"no\\\" style=\\\"border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;\\\" allowfullscreen> <\\/iframe> <div style=\\\"margin-bottom:5px\\\"> <strong> <a href=\\\"\\/\\/www.slideshare.net\\/fabpot\\/dependency-injection-with-php-53\\\" title=\\\"Dependency Injection with PHP 5.3\\\" target=\\\"_blank\\\">Dependency Injection with PHP 5.3<\\/a> <\\/strong> from <strong><a href=\\\"https:\\/\\/www.slideshare.net\\/fabpot\\\" target=\\\"_blank\\\">Fabien Potencier<\\/a><\\/strong> <\\/div>\",\"runtime\":{\"hours\":\"00\",\"mins\":\"00\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 6, NULL, NULL, NULL, NULL, '2020-04-26 04:13:03', '2020-05-13 17:18:42'),
(9, 1, 1, 1, 'Lecture based on only Text', 'lecture-based-on-only-text', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, 'lecture', NULL, 1, 3, NULL, NULL, NULL, NULL, '2020-04-26 05:06:54', '2020-05-13 17:18:42'),
(14, 1, 1, 1, 'Lecture Another', 'lecture-another', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</strong> Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', NULL, NULL, 'lecture', NULL, 1, 4, NULL, NULL, NULL, NULL, '2020-04-26 05:24:53', '2020-05-13 17:18:42'),
(15, 1, 1, 1, 'The ultimate lecture opening form', 'the-ultimate-lecture-opening-form', '<p><strong>There are many variations of p</strong>assages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, <em>making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, 'lecture', 0, 1, 5, NULL, NULL, NULL, NULL, '2020-04-26 05:25:49', '2020-05-13 17:18:42'),
(16, 1, 1, 2, 'Create a script that can count all items from a specific table', 'create-a-script-that-can-count-all-items-from-a-specific-table', '<p><strong><em>There are many variations of passage</em>s </strong>of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>', NULL, NULL, 'assignment', 0, 1, 9, '{\"time_duration\":{\"time_value\":\"1\",\"time_type\":\"weeks\"},\"total_number\":\"10\",\"pass_number\":\"5\",\"upload_attachment_limit\":\"1\",\"upload_attachment_size_limit\":\"5\"}', NULL, NULL, NULL, '2020-04-29 06:08:00', '2020-05-13 17:18:42'),
(17, 1, 1, 2, 'Create a script that can count all items from a table', 'create-a-script-that-can-count-all-items-from-a-table', '<p><strong><em>There are many variations of passage</em>s </strong>of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc. Updated</p>', NULL, NULL, 'assignment', 0, 1, 10, '{\"time_duration\":{\"time_value\":\"1\",\"time_type\":\"weeks\"},\"total_number\":\"10\",\"pass_number\":\"5\",\"upload_attachment_limit\":\"3\",\"upload_attachment_size_limit\":\"3\"}', NULL, NULL, NULL, '2020-04-29 06:08:45', '2020-05-13 17:18:42'),
(19, 1, 3, 4, 'Practical example, what you will learn in this example.', 'practical-example-what-you-will-learn-in-this-example', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '{\"source\":\"html5\",\"html5_video_id\":null,\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"00\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 1, NULL, NULL, NULL, NULL, '2020-05-06 05:46:26', '2020-05-06 05:47:39'),
(22, 1, 5, 6, 'Ot should Delted', 'ot-should-delted', NULL, NULL, NULL, 'lecture', 0, 1, 1, NULL, NULL, NULL, NULL, '2020-05-08 05:29:44', '2020-05-08 05:29:44'),
(23, 1, 5, 6, 'Another Should ge tdelte', 'another-should-ge-tdelte', NULL, NULL, NULL, 'lecture', 0, 1, 2, NULL, NULL, NULL, NULL, '2020-05-08 05:29:56', '2020-05-08 05:29:56'),
(24, 1, 8, 7, 'Installation', 'installation', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, 'lecture', NULL, 1, 1, NULL, NULL, NULL, 7, '2020-05-11 10:38:48', '2020-07-31 21:54:32'),
(25, 4, 9, 8, 'Introduction', 'introduction', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, 'lecture', 0, 1, 1, NULL, NULL, NULL, NULL, '2020-05-11 15:13:29', '2020-05-11 15:13:29'),
(26, 4, 9, 8, 'Genuinely Compelling and Straightforward Skincare Plans', 'genuinely-compelling-and-straightforward-skincare-plans', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', NULL, 0, 'lecture', 0, 1, 2, NULL, NULL, NULL, NULL, '2020-05-11 15:14:28', '2020-05-11 15:14:28'),
(27, 6, 10, 9, 'Course Introduction', 'course-introduction', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '{\"source\":\"html5\",\"html5_video_id\":\"20\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"00\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 1, NULL, NULL, NULL, NULL, '2020-05-12 09:14:45', '2020-05-12 09:26:43'),
(28, 6, 10, 9, 'Submit the application that you built after learning this application.', 'submit-the-application-that-you-built-after-learning-this-application', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, NULL, 'assignment', 0, 1, 2, '{\"time_duration\":{\"time_value\":\"0\",\"time_type\":\"weeks\"},\"total_number\":\"10\",\"pass_number\":\"5\",\"upload_attachment_limit\":\"2\",\"upload_attachment_size_limit\":\"5\"}', NULL, NULL, NULL, '2020-05-12 09:32:11', '2020-05-12 09:32:11'),
(29, 6, 10, 9, 'What is Angular?', 'what-is-angular', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', NULL, 0, 'lecture', 1, 1, 3, NULL, NULL, NULL, NULL, '2020-05-12 09:32:42', '2020-05-12 09:32:49'),
(30, 6, 10, 9, 'The Course Structure', 'the-course-structure', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 4, NULL, NULL, NULL, NULL, '2020-05-12 09:33:47', '2020-05-12 09:34:01'),
(31, 6, 10, 10, 'Understanding Angular Error Messages', 'understanding-angular-error-messages', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"20\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"00\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 5, NULL, NULL, NULL, NULL, '2020-05-12 09:35:30', '2020-05-12 09:35:46'),
(32, 6, 10, 10, 'Debugging Code in the Browser Using Sourcemaps', 'debugging-code-in-the-browser-using-sourcemaps', '<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', 1, 1, 6, NULL, NULL, NULL, NULL, '2020-05-12 09:36:15', '2020-05-12 09:36:25'),
(33, 6, 10, 10, 'Using Augury to Dive into Angular Apps', 'using-augury-to-dive-into-angular-apps', '<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"20\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 7, NULL, NULL, NULL, NULL, '2020-05-12 09:36:42', '2020-05-12 09:37:11'),
(34, 5, 11, 11, 'Introduction', 'introduction-1', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, 0, 'lecture', 0, 1, 1, NULL, NULL, NULL, NULL, '2020-05-17 15:07:04', '2020-05-17 15:07:04'),
(35, 5, 11, 11, 'Learn how to get a guaranteed win out of this course!', 'learn-how-to-get-a-guaranteed-win-out-of-this-course', '<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, 0, 'lecture', 1, 1, 2, NULL, NULL, NULL, NULL, '2020-05-17 15:15:03', '2020-05-17 15:15:03'),
(36, 5, 11, 11, 'What are important to draw first', 'what-are-important-to-draw-first', '<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 3, NULL, NULL, NULL, NULL, '2020-05-17 15:20:09', '2020-05-17 15:20:09'),
(37, 5, 11, 12, 'Adding the details to eye', 'adding-the-details-to-eye', '<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', NULL, 0, 'lecture', 1, 1, 4, NULL, NULL, NULL, NULL, '2020-05-17 15:21:12', '2020-05-17 15:21:12'),
(38, 5, 11, 12, 'Make animation eye', 'make-animation-eye', '<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 5, NULL, NULL, NULL, NULL, '2020-05-17 15:21:34', '2020-05-17 15:21:34'),
(39, 5, 11, 12, 'Practice Test one', 'practice-test-one', '<p>The quiz is for only testing purpose, it will not affect on the grading. Updated</p>', NULL, 0, 'quiz', 0, 1, 6, '{\"time_limit\":\"30\",\"passing_score\":\"10\",\"questions_limit\":\"10\"}', NULL, NULL, NULL, '2020-05-17 16:01:17', '2020-05-27 20:37:01'),
(40, 5, 11, 12, 'Practice test two', 'practice-test-two', '<p>Answers all of the questions</p>', NULL, 0, 'quiz', 0, 1, 7, '{\"show_time\":\"1\",\"time_limit\":\"30\",\"passing_score\":\"60\",\"questions_limit\":\"5\"}', 1, NULL, NULL, '2020-05-17 16:59:44', '2020-05-19 15:00:19');
INSERT INTO `contents` (`id`, `user_id`, `course_id`, `section_id`, `title`, `slug`, `text`, `video_src`, `video_time`, `item_type`, `is_preview`, `status`, `sort_order`, `options`, `quiz_gradable`, `unlock_date`, `unlock_days`, `created_at`, `updated_at`) VALUES
(41, 5, 12, 13, 'Introduction to the Course', 'introduction-to-the-course', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', 1, 1, 1, NULL, NULL, NULL, NULL, '2020-05-27 11:30:55', '2020-05-27 11:31:17'),
(42, 5, 12, 13, 'Introduction to Cloud Computing', 'introduction-to-cloud-computing', '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', 1, 1, 2, NULL, NULL, NULL, NULL, '2020-05-27 11:33:09', '2020-05-27 11:33:09'),
(43, 5, 12, 13, 'Cloud Computing Models', 'cloud-computing-models', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 3, NULL, NULL, NULL, NULL, '2020-05-27 11:33:35', '2020-05-27 11:33:35'),
(44, 5, 12, 13, 'Architecture of Cloud Environments', 'architecture-of-cloud-environments', '<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 4, NULL, NULL, NULL, NULL, '2020-05-27 11:34:03', '2020-05-27 11:34:21'),
(45, 5, 12, 13, 'On-Demand & Self Service - Characteristics of Cloud', 'on-demand-self-service-characteristics-of-cloud', '<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 5, NULL, NULL, NULL, NULL, '2020-05-27 11:34:42', '2020-05-27 11:34:58'),
(46, 5, 12, 14, 'Introduction to Amazon Web Services', 'introduction-to-amazon-web-services', '<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?</p>', NULL, 0, 'lecture', 1, 1, 6, NULL, NULL, NULL, NULL, '2020-05-27 11:35:53', '2020-05-27 11:35:53'),
(47, 5, 12, 14, 'AWS Global Infrastructure', 'aws-global-infrastructure', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 7, NULL, NULL, NULL, NULL, '2020-05-27 11:36:09', '2020-05-27 11:36:09'),
(48, 5, 12, 14, 'Setting up Labs', 'setting-up-labs', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 8, NULL, NULL, NULL, NULL, '2020-05-27 11:36:28', '2020-05-27 11:36:28'),
(49, 5, 12, 14, 'Setting up SSH Client', 'setting-up-ssh-client', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 9, NULL, NULL, NULL, NULL, '2020-05-27 11:36:45', '2020-05-27 11:36:45'),
(50, 5, 12, 14, 'Overview of Key Based Authentication', 'overview-of-key-based-authentication', '<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 10, NULL, NULL, NULL, NULL, '2020-05-27 11:37:07', '2020-05-27 11:37:07'),
(51, 5, 12, 14, 'Launching First EC2 Instance', 'launching-first-ec2-instance', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 11, NULL, NULL, NULL, NULL, '2020-05-27 11:37:36', '2020-05-27 11:37:36'),
(52, 5, 12, 14, 'Document - Basic Commands', 'document-basic-commands', NULL, '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 12, NULL, NULL, NULL, NULL, '2020-05-27 11:37:56', '2020-05-27 11:38:17'),
(53, 5, 12, 14, 'Browser Based SSH Connection', 'browser-based-ssh-connection', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"00\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 13, NULL, NULL, NULL, NULL, '2020-05-27 11:38:40', '2020-05-27 11:38:52'),
(54, 5, 12, 15, 'AWS Budgets', 'aws-budgets', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 14, NULL, NULL, NULL, NULL, '2020-05-27 11:39:27', '2020-05-27 11:39:27'),
(55, 5, 12, 15, 'AWS Well-Architected Framework', 'aws-well-architected-framework', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', NULL, 0, 'lecture', 1, 1, 15, NULL, NULL, NULL, NULL, '2020-05-27 11:39:45', '2020-05-27 11:39:45'),
(56, 5, 12, 15, 'AWS Personal Health Dashboard', 'aws-personal-health-dashboard', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 16, NULL, NULL, NULL, NULL, '2020-05-27 11:40:02', '2020-05-27 11:40:15'),
(57, 5, 12, 16, 'Amazon Partner Network (APN)', 'amazon-partner-network-apn', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":null,\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 17, NULL, NULL, NULL, NULL, '2020-05-27 11:40:51', '2020-05-27 11:40:59'),
(58, 5, 12, 16, 'Understanding Shared Responsibility Model', 'understanding-shared-responsibility-model', '<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 18, NULL, NULL, NULL, NULL, '2020-05-27 11:41:14', '2020-05-27 11:41:14'),
(59, 5, 12, 16, 'Understanding principle of least privilage', 'understanding-principle-of-least-privilage', '<p>t vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 19, NULL, NULL, NULL, NULL, '2020-05-27 11:41:32', '2020-05-27 11:41:32'),
(60, 5, 12, 17, 'Overview of Cloud Practitioner Exam', 'overview-of-cloud-practitioner-exam', '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 20, NULL, NULL, NULL, NULL, '2020-05-27 11:42:35', '2020-05-27 11:42:49'),
(61, 5, 12, 17, 'Important Pointers - Domain 1', 'important-pointers-domain-1', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 21, NULL, NULL, NULL, NULL, '2020-05-27 11:43:11', '2020-05-27 11:43:11'),
(62, 5, 12, 17, 'Important Pointers - Domain 2', 'important-pointers-domain-2', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 22, NULL, NULL, NULL, NULL, '2020-05-27 11:43:26', '2020-05-27 11:43:26'),
(63, 5, 13, 18, 'Developing People, Leading Teams & Managing Processes', 'developing-people-leading-teams-managing-processes', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', 1, 1, 1, NULL, NULL, NULL, NULL, '2020-05-27 12:00:53', '2020-05-27 12:01:09'),
(64, 5, 13, 18, 'Two Self-Assessments', 'two-self-assessments', '<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 2, NULL, NULL, NULL, NULL, '2020-05-27 12:02:55', '2020-05-27 12:02:55');
INSERT INTO `contents` (`id`, `user_id`, `course_id`, `section_id`, `title`, `slug`, `text`, `video_src`, `video_time`, `item_type`, `is_preview`, `status`, `sort_order`, `options`, `quiz_gradable`, `unlock_date`, `unlock_days`, `created_at`, `updated_at`) VALUES
(65, 5, 13, 18, 'What is Management, Leadership and Process?', 'what-is-management-leadership-and-process', '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 3, NULL, NULL, NULL, NULL, '2020-05-27 12:03:15', '2020-05-27 12:03:15'),
(66, 5, 13, 19, 'Essential Horizontal Communication', 'essential-horizontal-communication', '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 4, NULL, NULL, NULL, NULL, '2020-05-27 12:03:59', '2020-05-27 12:03:59'),
(67, 5, 13, 19, 'Essential Vertical Communication', 'essential-vertical-communication', '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 5, NULL, NULL, NULL, NULL, '2020-05-27 12:04:21', '2020-05-27 12:04:21'),
(68, 5, 13, 19, 'Delegation and Assigning Tasks', 'delegation-and-assigning-tasks', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 6, NULL, NULL, NULL, NULL, '2020-05-27 12:04:37', '2020-05-27 12:04:37'),
(69, 5, 13, 19, 'Stay Safe! Stay in Bounds!', 'stay-safe-stay-in-bounds', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 7, NULL, NULL, NULL, NULL, '2020-05-27 12:04:57', '2020-05-27 12:04:57'),
(70, 5, 13, 20, 'Improving Human Performance', 'improving-human-performance', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"runtime\":{\"hours\":\"00\",\"mins\":\"1\",\"secs\":\"00\"}}', 0, 'lecture', NULL, 1, 8, NULL, NULL, NULL, NULL, '2020-05-27 12:05:38', '2020-05-27 12:05:55'),
(71, 5, 13, 20, 'A Model for Basic Skills Training', 'a-model-for-basic-skills-training', '<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 9, NULL, NULL, NULL, NULL, '2020-05-27 12:06:16', '2020-05-27 12:06:16'),
(72, 5, 13, 20, 'An Example of Skill Training', 'an-example-of-skill-training', '<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 10, NULL, NULL, NULL, NULL, '2020-05-27 12:06:34', '2020-05-27 12:06:34'),
(73, 5, 13, 21, 'The Hierarchy of Motivation', 'the-hierarchy-of-motivation', '<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 11, NULL, NULL, NULL, NULL, '2020-05-27 12:07:04', '2020-05-27 12:07:04'),
(74, 5, 13, 21, 'The Power of Purpose', 'the-power-of-purpose', '<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', NULL, 0, 'lecture', NULL, 1, 12, NULL, NULL, NULL, NULL, '2020-05-27 12:07:27', '2020-05-27 12:07:27'),
(75, 5, 13, 21, 'Social Motivation and Creating The Bonds of Trust', 'social-motivation-and-creating-the-bonds-of-trust', '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 13, NULL, NULL, NULL, NULL, '2020-05-27 12:07:47', '2020-05-27 12:07:47'),
(76, 5, 13, 21, 'Motivation and Organization Life Cycles', 'motivation-and-organization-life-cycles', '<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', NULL, 0, 'lecture', NULL, 1, 14, NULL, NULL, NULL, NULL, '2020-05-27 12:08:06', '2020-05-27 12:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_code` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_decimals` int(11) DEFAULT NULL,
  `iso2` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iso3` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `continent_code` char(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `calling_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `currency_code`, `currency_symbol`, `currency_decimals`, `iso2`, `iso3`, `continent_code`, `name`, `calling_code`, `flag`) VALUES
(1, '004', 'AFN', '؋', 2, 'AF', 'AFG', 'AS', 'Afghanistan', '93', 'AF.png'),
(2, '008', 'ALL', 'Lek', 2, 'AL', 'ALB', 'EU', 'Albania', '355', 'AL.png'),
(3, '010', '', '', 2, 'AQ', 'ATA', 'AN', 'Antarctica', '672', 'AQ.png'),
(4, '012', 'DZD', 'DZD', 2, 'DZ', 'DZA', 'AF', 'Algeria', '213', 'DZ.png'),
(5, '016', 'USD', '$', 2, 'AS', 'ASM', 'OC', 'American Samoa', '1', 'AS.png'),
(6, '020', 'EUR', '€', 2, 'AD', 'AND', 'EU', 'Andorra', '376', 'AD.png'),
(7, '024', 'AOA', 'Kz', 2, 'AO', 'AGO', 'AF', 'Angola', '244', 'AO.png'),
(8, '028', 'XCD', '$', 2, 'AG', 'ATG', 'NA', 'Antigua and Barbuda', '1', 'AG.png'),
(9, '031', 'AZN', 'ман', 2, 'AZ', 'AZE', 'AS', 'Azerbaijan', '994', 'AZ.png'),
(10, '032', 'ARS', '$', 2, 'AR', 'ARG', 'SA', 'Argentina', '54', 'AR.png'),
(11, '036', 'AUD', '$', 2, 'AU', 'AUS', 'OC', 'Australia', '61', 'AU.png'),
(12, '040', 'EUR', '€', 2, 'AT', 'AUT', 'EU', 'Austria', '43', 'AT.png'),
(13, '044', 'BSD', '$', 2, 'BS', 'BHS', 'NA', 'Bahamas', '1', 'BS.png'),
(14, '048', 'BHD', 'BHD', 3, 'BH', 'BHR', 'AS', 'Bahrain', '973', 'BH.png'),
(15, '050', 'BDT', 'BDT', 2, 'BD', 'BGD', 'AS', 'Bangladesh', '880', 'BD.png'),
(16, '051', 'AMD', 'AMD', 2, 'AM', 'ARM', 'AS', 'Armenia', '374', 'AM.png'),
(17, '052', 'BBD', '$', 2, 'BB', 'BRB', 'NA', 'Barbados', '1', 'BB.png'),
(18, '056', 'EUR', '€', 2, 'BE', 'BEL', 'EU', 'Belgium', '32', 'BE.png'),
(19, '060', 'BMD', '$', 2, 'BM', 'BMU', 'NA', 'Bermuda', '1', 'BM.png'),
(20, '064', 'BTN', 'BTN', 2, 'BT', 'BTN', 'AS', 'Bhutan', '975', 'BT.png'),
(21, '068', 'BOB', '$b', 2, 'BO', 'BOL', 'SA', 'Bolivia, Plurinational State of', '591', 'BO.png'),
(22, '070', 'BAM', 'KM', 2, 'BA', 'BIH', 'EU', 'Bosnia and Herzegovina', '387', 'BA.png'),
(23, '072', 'BWP', 'P', 2, 'BW', 'BWA', 'AF', 'Botswana', '267', 'BW.png'),
(24, '074', '', 'kr', 2, 'BV', 'BVT', 'AN', 'Bouvet Island', '47', 'BV.png'),
(25, '076', 'BRL', 'R$', 2, 'BR', 'BRA', 'SA', 'Brazil', '55', 'BR.png'),
(26, '084', 'BZD', 'BZ$', 2, 'BZ', 'BLZ', 'NA', 'Belize', '501', 'BZ.png'),
(27, '086', 'USD', '$', 2, 'IO', 'IOT', 'AS', 'British Indian Ocean Territory', '246', 'IO.png'),
(28, '090', 'SBD', '$', 2, 'SB', 'SLB', 'OC', 'Solomon Islands', '677', 'SB.png'),
(29, '092', 'USD', '$', 2, 'VG', 'VGB', 'NA', 'Virgin Islands, British', '1', 'VG.png'),
(30, '096', 'BND', '$', 2, 'BN', 'BRN', 'AS', 'Brunei Darussalam', '673', 'BN.png'),
(31, '100', 'BGN', 'лв', 2, 'BG', 'BGR', 'EU', 'Bulgaria', '359', 'BG.png'),
(32, '104', 'MMK', 'K', 2, 'MM', 'MMR', 'AS', 'Myanmar', '95', 'MM.png'),
(33, '108', 'BIF', 'BIF', 0, 'BI', 'BDI', 'AF', 'Burundi', '257', 'BI.png'),
(34, '112', 'BYR', 'p.', 2, 'BY', 'BLR', 'EU', 'Belarus', '375', 'BY.png'),
(35, '116', 'KHR', '៛', 2, 'KH', 'KHM', 'AS', 'Cambodia', '855', 'KH.png'),
(36, '120', 'XAF', 'FCF', 0, 'CM', 'CMR', 'AF', 'Cameroon', '237', 'CM.png'),
(37, '124', 'CAD', '$', 2, 'CA', 'CAN', 'NA', 'Canada', '1', 'CA.png'),
(38, '132', 'CVE', 'CVE', 2, 'CV', 'CPV', 'AF', 'Cape Verde', '238', 'CV.png'),
(39, '136', 'KYD', '$', 2, 'KY', 'CYM', 'NA', 'Cayman Islands', '1', 'KY.png'),
(40, '140', 'XAF', 'CFA', 0, 'CF', 'CAF', 'AF', 'Central African Republic', '236', 'CF.png'),
(41, '144', 'LKR', '₨', 2, 'LK', 'LKA', 'AS', 'Sri Lanka', '94', 'LK.png'),
(42, '148', 'XAF', 'XAF', 0, 'TD', 'TCD', 'AF', 'Chad', '235', 'TD.png'),
(43, '152', 'CLP', 'CLP', 0, 'CL', 'CHL', 'SA', 'Chile', '56', 'CL.png'),
(44, '156', 'CNY', '¥', 2, 'CN', 'CHN', 'AS', 'China', '86', 'CN.png'),
(45, '158', 'TWD', 'NT$', 2, 'TW', 'TWN', 'AS', 'Taiwan, Province of China', '886', 'TW.png'),
(46, '162', 'AUD', '$', 2, 'CX', 'CXR', 'AS', 'Christmas Island', '61', 'CX.png'),
(47, '166', 'AUD', '$', 2, 'CC', 'CCK', 'AS', 'Cocos (Keeling) Islands', '61', 'CC.png'),
(48, '170', 'COP', '$', 2, 'CO', 'COL', 'SA', 'Colombia', '57', 'CO.png'),
(49, '174', 'KMF', 'KMF', 0, 'KM', 'COM', 'AF', 'Comoros', '269', 'KM.png'),
(50, '175', 'EUR', '€', 2, 'YT', 'MYT', 'AF', 'Mayotte', '262', 'YT.png'),
(51, '178', 'XAF', 'FCF', 0, 'CG', 'COG', 'AF', 'Congo', '242', 'CG.png'),
(52, '180', 'CDF', 'CDF', 2, 'CD', 'COD', 'AF', 'Congo, the Democratic Republic of the', '243', 'CD.png'),
(53, '184', 'NZD', '$', 2, 'CK', 'COK', 'OC', 'Cook Islands', '682', 'CK.png'),
(54, '188', 'CRC', '₡', 2, 'CR', 'CRI', 'NA', 'Costa Rica', '506', 'CR.png'),
(55, '191', 'HRK', 'kn', 2, 'HR', 'HRV', 'EU', 'Croatia', '385', 'HR.png'),
(56, '192', 'CUP', '₱', 2, 'CU', 'CUB', 'NA', 'Cuba', '53', 'CU.png'),
(57, '196', 'EUR', 'CYP', 2, 'CY', 'CYP', 'AS', 'Cyprus', '357', 'CY.png'),
(58, '203', 'CZK', 'Kč', 2, 'CZ', 'CZE', 'EU', 'Czech Republic', '420', 'CZ.png'),
(59, '204', 'XOF', 'XOF', 0, 'BJ', 'BEN', 'AF', 'Benin', '229', 'BJ.png'),
(60, '208', 'DKK', 'kr', 2, 'DK', 'DNK', 'EU', 'Denmark', '45', 'DK.png'),
(61, '212', 'XCD', '$', 2, 'DM', 'DMA', 'NA', 'Dominica', '1', 'DM.png'),
(62, '214', 'DOP', 'RD$', 2, 'DO', 'DOM', 'NA', 'Dominican Republic', '1', 'DO.png'),
(63, '218', 'USD', '$', 2, 'EC', 'ECU', 'SA', 'Ecuador', '593', 'EC.png'),
(64, '222', 'SVC', '$', 2, 'SV', 'SLV', 'NA', 'El Salvador', '503', 'SV.png'),
(65, '226', 'XAF', 'FCF', 2, 'GQ', 'GNQ', 'AF', 'Equatorial Guinea', '240', 'GQ.png'),
(66, '231', 'ETB', 'ETB', 2, 'ET', 'ETH', 'AF', 'Ethiopia', '251', 'ET.png'),
(67, '232', 'ERN', 'Nfk', 2, 'ER', 'ERI', 'AF', 'Eritrea', '291', 'ER.png'),
(68, '233', 'EUR', 'kr', 2, 'EE', 'EST', 'EU', 'Estonia', '372', 'EE.png'),
(69, '234', 'DKK', 'kr', 2, 'FO', 'FRO', 'EU', 'Faroe Islands', '298', 'FO.png'),
(70, '238', 'FKP', '£', 2, 'FK', 'FLK', 'SA', 'Falkland Islands (Malvinas)', '500', 'FK.png'),
(71, '239', '', '£', 2, 'GS', 'SGS', 'AN', 'South Georgia and the South Sandwich Islands', '44', 'GS.png'),
(72, '242', 'FJD', '$', 2, 'FJ', 'FJI', 'OC', 'Fiji', '679', 'FJ.png'),
(73, '246', 'EUR', '€', 2, 'FI', 'FIN', 'EU', 'Finland', '358', 'FI.png'),
(74, '248', 'EUR', NULL, NULL, 'AX', 'ALA', 'EU', 'Åland Islands', '358', NULL),
(75, '250', 'EUR', '€', 2, 'FR', 'FRA', 'EU', 'France', '33', 'FR.png'),
(76, '254', 'EUR', '€', 2, 'GF', 'GUF', 'SA', 'French Guiana', '594', 'GF.png'),
(77, '258', 'XPF', 'XPF', 0, 'PF', 'PYF', 'OC', 'French Polynesia', '689', 'PF.png'),
(78, '260', 'EUR', '€', 2, 'TF', 'ATF', 'AN', 'French Southern Territories', '33', 'TF.png'),
(79, '262', 'DJF', 'DJF', 0, 'DJ', 'DJI', 'AF', 'Djibouti', '253', 'DJ.png'),
(80, '266', 'XAF', 'FCF', 0, 'GA', 'GAB', 'AF', 'Gabon', '241', 'GA.png'),
(81, '268', 'GEL', 'GEL', 2, 'GE', 'GEO', 'AS', 'Georgia', '995', 'GE.png'),
(82, '270', 'GMD', 'D', 2, 'GM', 'GMB', 'AF', 'Gambia', '220', 'GM.png'),
(83, '275', NULL, '₪', 2, 'PS', 'PSE', 'AS', 'Palestinian Territory, Occupied', '970', 'PS.png'),
(84, '276', 'EUR', '€', 2, 'DE', 'DEU', 'EU', 'Germany', '49', 'DE.png'),
(85, '288', 'GHS', '¢', 2, 'GH', 'GHA', 'AF', 'Ghana', '233', 'GH.png'),
(86, '292', 'GIP', '£', 2, 'GI', 'GIB', 'EU', 'Gibraltar', '350', 'GI.png'),
(87, '296', 'AUD', '$', 2, 'KI', 'KIR', 'OC', 'Kiribati', '686', 'KI.png'),
(88, '300', 'EUR', '€', 2, 'GR', 'GRC', 'EU', 'Greece', '30', 'GR.png'),
(89, '304', 'DKK', 'kr', 2, 'GL', 'GRL', 'NA', 'Greenland', '299', 'GL.png'),
(90, '308', 'XCD', '$', 2, 'GD', 'GRD', 'NA', 'Grenada', '1', 'GD.png'),
(91, '312', 'EUR ', '€', 2, 'GP', 'GLP', 'NA', 'Guadeloupe', '590', 'GP.png'),
(92, '316', 'USD', '$', 2, 'GU', 'GUM', 'OC', 'Guam', '1', 'GU.png'),
(93, '320', 'GTQ', 'Q', 2, 'GT', 'GTM', 'NA', 'Guatemala', '502', 'GT.png'),
(94, '324', 'GNF', 'GNF', 0, 'GN', 'GIN', 'AF', 'Guinea', '224', 'GN.png'),
(95, '328', 'GYD', '$', 2, 'GY', 'GUY', 'SA', 'Guyana', '592', 'GY.png'),
(96, '332', 'HTG', 'G', 2, 'HT', 'HTI', 'NA', 'Haiti', '509', 'HT.png'),
(97, '334', '', '$', 2, 'HM', 'HMD', 'AN', 'Heard Island and McDonald Islands', '61', 'HM.png'),
(98, '336', 'EUR', '€', 2, 'VA', 'VAT', 'EU', 'Holy See (Vatican City State)', '39', 'VA.png'),
(99, '340', 'HNL', 'L', 2, 'HN', 'HND', 'NA', 'Honduras', '504', 'HN.png'),
(100, '344', 'HKD', '$', 2, 'HK', 'HKG', 'AS', 'Hong Kong', '852', 'HK.png'),
(101, '348', 'HUF', 'Ft', 2, 'HU', 'HUN', 'EU', 'Hungary', '36', 'HU.png'),
(102, '352', 'ISK', 'kr', 0, 'IS', 'ISL', 'EU', 'Iceland', '354', 'IS.png'),
(103, '356', 'INR', '₹', 2, 'IN', 'IND', 'AS', 'India', '91', 'IN.png'),
(104, '360', 'IDR', 'Rp', 2, 'ID', 'IDN', 'AS', 'Indonesia', '62', 'ID.png'),
(105, '364', 'IRR', '﷼', 2, 'IR', 'IRN', 'AS', 'Iran, Islamic Republic of', '98', 'IR.png'),
(106, '368', 'IQD', 'IQD', 3, 'IQ', 'IRQ', 'AS', 'Iraq', '964', 'IQ.png'),
(107, '372', 'EUR', '€', 2, 'IE', 'IRL', 'EU', 'Ireland', '353', 'IE.png'),
(108, '376', 'ILS', '₪', 2, 'IL', 'ISR', 'AS', 'Israel', '972', 'IL.png'),
(109, '380', 'EUR', '€', 2, 'IT', 'ITA', 'EU', 'Italy', '39', 'IT.png'),
(110, '384', 'XOF', 'XOF', 0, 'CI', 'CIV', 'AF', 'Côte d\'Ivoire', '225', 'CI.png'),
(111, '388', 'JMD', '$', 2, 'JM', 'JAM', 'NA', 'Jamaica', '1', 'JM.png'),
(112, '392', 'JPY', '¥', 0, 'JP', 'JPN', 'AS', 'Japan', '81', 'JP.png'),
(113, '398', 'KZT', 'лв', 2, 'KZ', 'KAZ', 'AS', 'Kazakhstan', '7', 'KZ.png'),
(114, '400', 'JOD', 'JOD', 2, 'JO', 'JOR', 'AS', 'Jordan', '962', 'JO.png'),
(115, '404', 'KES', 'KES', 2, 'KE', 'KEN', 'AF', 'Kenya', '254', 'KE.png'),
(116, '408', 'KPW', '₩', 2, 'KP', 'PRK', 'AS', 'Korea, Democratic People\'s Republic of', '850', 'KP.png'),
(117, '410', 'KRW', '₩', 0, 'KR', 'KOR', 'AS', 'Korea, Republic of', '82', 'KR.png'),
(118, '414', 'KWD', 'KWD', 3, 'KW', 'KWT', 'AS', 'Kuwait', '965', 'KW.png'),
(119, '417', 'KGS', 'лв', 2, 'KG', 'KGZ', 'AS', 'Kyrgyzstan', '996', 'KG.png'),
(120, '418', 'LAK', '₭', 0, 'LA', 'LAO', 'AS', 'Lao People\'s Democratic Republic', '856', 'LA.png'),
(121, '422', 'LBP', '£', 2, 'LB', 'LBN', 'AS', 'Lebanon', '961', 'LB.png'),
(122, '426', 'LSL', 'L', 2, 'LS', 'LSO', 'AF', 'Lesotho', '266', 'LS.png'),
(123, '428', 'EUR', 'Ls', 2, 'LV', 'LVA', 'EU', 'Latvia', '371', 'LV.png'),
(124, '430', 'LRD', '$', 2, 'LR', 'LBR', 'AF', 'Liberia', '231', 'LR.png'),
(125, '434', 'LYD', 'LYD', 3, 'LY', 'LBY', 'AF', 'Libya', '218', 'LY.png'),
(126, '438', 'CHF', 'CHF', 2, 'LI', 'LIE', 'EU', 'Liechtenstein', '423', 'LI.png'),
(127, '440', 'EUR', 'Lt', 2, 'LT', 'LTU', 'EU', 'Lithuania', '370', 'LT.png'),
(128, '442', 'EUR', '€', 2, 'LU', 'LUX', 'EU', 'Luxembourg', '352', 'LU.png'),
(129, '446', 'MOP', 'MOP', 2, 'MO', 'MAC', 'AS', 'Macao', '853', 'MO.png'),
(130, '450', 'MGA', 'MGA', 2, 'MG', 'MDG', 'AF', 'Madagascar', '261', 'MG.png'),
(131, '454', 'MWK', 'MK', 2, 'MW', 'MWI', 'AF', 'Malawi', '265', 'MW.png'),
(132, '458', 'MYR', 'RM', 2, 'MY', 'MYS', 'AS', 'Malaysia', '60', 'MY.png'),
(133, '462', 'MVR', 'Rf', 2, 'MV', 'MDV', 'AS', 'Maldives', '960', 'MV.png'),
(134, '466', 'XOF', 'XOF', 0, 'ML', 'MLI', 'AF', 'Mali', '223', 'ML.png'),
(135, '470', 'EUR', 'MTL', 2, 'MT', 'MLT', 'EU', 'Malta', '356', 'MT.png'),
(136, '474', 'EUR', '€', 2, 'MQ', 'MTQ', 'NA', 'Martinique', '596', 'MQ.png'),
(137, '478', 'MRO', 'UM', 2, 'MR', 'MRT', 'AF', 'Mauritania', '222', 'MR.png'),
(138, '480', 'MUR', '₨', 2, 'MU', 'MUS', 'AF', 'Mauritius', '230', 'MU.png'),
(139, '484', 'MXN', '$', 2, 'MX', 'MEX', 'NA', 'Mexico', '52', 'MX.png'),
(140, '492', 'EUR', '€', 2, 'MC', 'MCO', 'EU', 'Monaco', '377', 'MC.png'),
(141, '496', 'MNT', '₮', 2, 'MN', 'MNG', 'AS', 'Mongolia', '976', 'MN.png'),
(142, '498', 'MDL', 'MDL', 2, 'MD', 'MDA', 'EU', 'Moldova, Republic of', '373', 'MD.png'),
(143, '499', 'EUR', '€', 2, 'ME', 'MNE', 'EU', 'Montenegro', '382', 'ME.png'),
(144, '500', 'XCD', '$', 2, 'MS', 'MSR', 'NA', 'Montserrat', '1', 'MS.png'),
(145, '504', 'MAD', 'MAD', 2, 'MA', 'MAR', 'AF', 'Morocco', '212', 'MA.png'),
(146, '508', 'MZN', 'MT', 2, 'MZ', 'MOZ', 'AF', 'Mozambique', '258', 'MZ.png'),
(147, '512', 'OMR', '﷼', 3, 'OM', 'OMN', 'AS', 'Oman', '968', 'OM.png'),
(148, '516', 'NAD', '$', 2, 'NA', 'NAM', 'AF', 'Namibia', '264', 'NA.png'),
(149, '520', 'AUD', '$', 2, 'NR', 'NRU', 'OC', 'Nauru', '674', 'NR.png'),
(150, '524', 'NPR', '₨', 2, 'NP', 'NPL', 'AS', 'Nepal', '977', 'NP.png'),
(151, '528', 'EUR', '€', 2, 'NL', 'NLD', 'EU', 'Netherlands', '31', 'NL.png'),
(152, '531', 'ANG', NULL, NULL, 'CW', 'CUW', 'NA', 'Curaçao', '599', NULL),
(153, '533', 'AWG', 'ƒ', 2, 'AW', 'ABW', 'NA', 'Aruba', '297', 'AW.png'),
(154, '534', 'ANG', NULL, NULL, 'SX', 'SXM', 'NA', 'Sint Maarten (Dutch part)', '721', NULL),
(155, '535', 'USD', NULL, NULL, 'BQ', 'BES', 'NA', 'Bonaire, Sint Eustatius and Saba', '599', NULL),
(156, '540', 'XPF', 'XPF', 0, 'NC', 'NCL', 'OC', 'New Caledonia', '687', 'NC.png'),
(157, '548', 'VUV', 'Vt', 0, 'VU', 'VUT', 'OC', 'Vanuatu', '678', 'VU.png'),
(158, '554', 'NZD', '$', 2, 'NZ', 'NZL', 'OC', 'New Zealand', '64', 'NZ.png'),
(159, '558', 'NIO', 'C$', 2, 'NI', 'NIC', 'NA', 'Nicaragua', '505', 'NI.png'),
(160, '562', 'XOF', 'XOF', 0, 'NE', 'NER', 'AF', 'Niger', '227', 'NE.png'),
(161, '566', 'NGN', '₦', 2, 'NG', 'NGA', 'AF', 'Nigeria', '234', 'NG.png'),
(162, '570', 'NZD', '$', 2, 'NU', 'NIU', 'OC', 'Niue', '683', 'NU.png'),
(163, '574', 'AUD', '$', 2, 'NF', 'NFK', 'OC', 'Norfolk Island', '672', 'NF.png'),
(164, '578', 'NOK', 'kr', 2, 'NO', 'NOR', 'EU', 'Norway', '47', 'NO.png'),
(165, '580', 'USD', '$', 2, 'MP', 'MNP', 'OC', 'Northern Mariana Islands', '1', 'MP.png'),
(166, '581', 'USD', '$', 2, 'UM', 'UMI', 'OC', 'United States Minor Outlying Islands', '1', 'UM.png'),
(167, '583', 'USD', '$', 2, 'FM', 'FSM', 'OC', 'Micronesia, Federated States of', '691', 'FM.png'),
(168, '584', 'USD', '$', 2, 'MH', 'MHL', 'OC', 'Marshall Islands', '692', 'MH.png'),
(169, '585', 'USD', '$', 2, 'PW', 'PLW', 'OC', 'Palau', '680', 'PW.png'),
(170, '586', 'PKR', '₨', 2, 'PK', 'PAK', 'AS', 'Pakistan', '92', 'PK.png'),
(171, '591', 'PAB', 'B/.', 2, 'PA', 'PAN', 'NA', 'Panama', '507', 'PA.png'),
(172, '598', 'PGK', 'PGK', 2, 'PG', 'PNG', 'OC', 'Papua New Guinea', '675', 'PG.png'),
(173, '600', 'PYG', 'Gs', 0, 'PY', 'PRY', 'SA', 'Paraguay', '595', 'PY.png'),
(174, '604', 'PEN', 'S/.', 2, 'PE', 'PER', 'SA', 'Peru', '51', 'PE.png'),
(175, '608', 'PHP', 'Php', 2, 'PH', 'PHL', 'AS', 'Philippines', '63', 'PH.png'),
(176, '612', 'NZD', '$', 2, 'PN', 'PCN', 'OC', 'Pitcairn', '649', 'PN.png'),
(177, '616', 'PLN', 'zł', 2, 'PL', 'POL', 'EU', 'Poland', '48', 'PL.png'),
(178, '620', 'EUR', '€', 2, 'PT', 'PRT', 'EU', 'Portugal', '351', 'PT.png'),
(179, '624', 'XOF', 'XOF', 0, 'GW', 'GNB', 'AF', 'Guinea-Bissau', '245', 'GW.png'),
(180, '626', 'USD', '$', 2, 'TL', 'TLS', 'AS', 'Timor-Leste', '670', 'TL.png'),
(181, '630', 'USD', '$', 2, 'PR', 'PRI', 'NA', 'Puerto Rico', '1', 'PR.png'),
(182, '634', 'QAR', '﷼', 2, 'QA', 'QAT', 'AS', 'Qatar', '974', 'QA.png'),
(183, '638', 'EUR', '€', 2, 'RE', 'REU', 'AF', 'Réunion', '262', 'RE.png'),
(184, '642', 'RON', 'lei', 2, 'RO', 'ROU', 'EU', 'Romania', '40', 'RO.png'),
(185, '643', 'RUB', 'руб', 2, 'RU', 'RUS', 'EU', 'Russian Federation', '7', 'RU.png'),
(186, '646', 'RWF', 'RWF', 0, 'RW', 'RWA', 'AF', 'Rwanda', '250', 'RW.png'),
(187, '652', 'EUR', NULL, NULL, 'BL', 'BLM', 'NA', 'Saint Barthélemy', '590', NULL),
(188, '654', 'SHP', '£', 2, 'SH', 'SHN', 'AF', 'Saint Helena, Ascension and Tristan da Cunha', '290', 'SH.png'),
(189, '659', 'XCD', '$', 2, 'KN', 'KNA', 'NA', 'Saint Kitts and Nevis', '1', 'KN.png'),
(190, '660', 'XCD', '$', 2, 'AI', 'AIA', 'NA', 'Anguilla', '1', 'AI.png'),
(191, '662', 'XCD', '$', 2, 'LC', 'LCA', 'NA', 'Saint Lucia', '1', 'LC.png'),
(192, '663', 'EUR', NULL, NULL, 'MF', 'MAF', 'NA', 'Saint Martin (French part)', '590', NULL),
(193, '666', 'EUR', '€', 2, 'PM', 'SPM', 'NA', 'Saint Pierre and Miquelon', '508', 'PM.png'),
(194, '670', 'XCD', '$', 2, 'VC', 'VCT', 'NA', 'Saint Vincent and the Grenadines', '1', 'VC.png'),
(195, '674', 'EUR ', '€', 2, 'SM', 'SMR', 'EU', 'San Marino', '378', 'SM.png'),
(196, '678', 'STD', 'Db', 2, 'ST', 'STP', 'AF', 'Sao Tome and Principe', '239', 'ST.png'),
(197, '682', 'SAR', '﷼', 2, 'SA', 'SAU', 'AS', 'Saudi Arabia', '966', 'SA.png'),
(198, '686', 'XOF', 'XOF', 0, 'SN', 'SEN', 'AF', 'Senegal', '221', 'SN.png'),
(199, '688', 'RSD', NULL, NULL, 'RS', 'SRB', 'EU', 'Serbia', '381', NULL),
(200, '690', 'SCR', '₨', 2, 'SC', 'SYC', 'AF', 'Seychelles', '248', 'SC.png'),
(201, '694', 'SLL', 'Le', 2, 'SL', 'SLE', 'AF', 'Sierra Leone', '232', 'SL.png'),
(202, '702', 'SGD', '$', 2, 'SG', 'SGP', 'AS', 'Singapore', '65', 'SG.png'),
(203, '703', 'EUR', 'Sk', 2, 'SK', 'SVK', 'EU', 'Slovakia', '421', 'SK.png'),
(204, '704', 'VND', '₫', 2, 'VN', 'VNM', 'AS', 'Viet Nam', '84', 'VN.png'),
(205, '705', 'EUR', '€', 2, 'SI', 'SVN', 'EU', 'Slovenia', '386', 'SI.png'),
(206, '706', 'SOS', 'S', 2, 'SO', 'SOM', 'AF', 'Somalia', '252', 'SO.png'),
(207, '710', 'ZAR', 'R', 2, 'ZA', 'ZAF', 'AF', 'South Africa', '27', 'ZA.png'),
(208, '716', 'ZWL', 'Z$', 2, 'ZW', 'ZWE', 'AF', 'Zimbabwe', '263', 'ZW.png'),
(209, '724', 'EUR', '€', 2, 'ES', 'ESP', 'EU', 'Spain', '34', 'ES.png'),
(210, '728', 'SSP', NULL, NULL, 'SS', 'SSD', 'AF', 'South Sudan', '211', NULL),
(211, '729', 'SDG', NULL, NULL, 'SD', 'SDN', 'AF', 'Sudan', '249', NULL),
(212, '732', 'MAD', 'MAD', 2, 'EH', 'ESH', 'AF', 'Western Sahara', '212', 'EH.png'),
(213, '740', 'SRD', '$', 2, 'SR', 'SUR', 'SA', 'Suriname', '597', 'SR.png'),
(214, '744', 'NOK', 'kr', 2, 'SJ', 'SJM', 'EU', 'Svalbard and Jan Mayen', '47', 'SJ.png'),
(215, '748', 'SZL', 'SZL', 2, 'SZ', 'SWZ', 'AF', 'Swaziland', '268', 'SZ.png'),
(216, '752', 'SEK', 'kr', 2, 'SE', 'SWE', 'EU', 'Sweden', '46', 'SE.png'),
(217, '756', 'CHF', 'CHF', 2, 'CH', 'CHE', 'EU', 'Switzerland', '41', 'CH.png'),
(218, '760', 'SYP', '£', 2, 'SY', 'SYR', 'AS', 'Syrian Arab Republic', '963', 'SY.png'),
(219, '762', 'TJS', 'TJS', 2, 'TJ', 'TJK', 'AS', 'Tajikistan', '992', 'TJ.png'),
(220, '764', 'THB', '฿', 2, 'TH', 'THA', 'AS', 'Thailand', '66', 'TH.png'),
(221, '768', 'XOF', 'XOF', 0, 'TG', 'TGO', 'AF', 'Togo', '228', 'TG.png'),
(222, '772', 'NZD', '$', 2, 'TK', 'TKL', 'OC', 'Tokelau', '690', 'TK.png'),
(223, '776', 'TOP', 'T$', 2, 'TO', 'TON', 'OC', 'Tonga', '676', 'TO.png'),
(224, '780', 'TTD', 'TT$', 2, 'TT', 'TTO', 'NA', 'Trinidad and Tobago', '1', 'TT.png'),
(225, '784', 'AED', 'AED', 2, 'AE', 'ARE', 'AS', 'United Arab Emirates', '971', 'AE.png'),
(226, '788', 'TND', 'TND', 3, 'TN', 'TUN', 'AF', 'Tunisia', '216', 'TN.png'),
(227, '792', 'TRY', '₺', 2, 'TR', 'TUR', 'AS', 'Turkey', '90', 'TR.png'),
(228, '795', 'TMT', 'm', 2, 'TM', 'TKM', 'AS', 'Turkmenistan', '993', 'TM.png'),
(229, '796', 'USD', '$', 2, 'TC', 'TCA', 'NA', 'Turks and Caicos Islands', '1', 'TC.png'),
(230, '798', 'AUD', '$', 2, 'TV', 'TUV', 'OC', 'Tuvalu', '688', 'TV.png'),
(231, '800', 'UGX', 'UGX', 0, 'UG', 'UGA', 'AF', 'Uganda', '256', 'UG.png'),
(232, '804', 'UAH', '₴', 2, 'UA', 'UKR', 'EU', 'Ukraine', '380', 'UA.png'),
(233, '807', 'MKD', 'ден', 2, 'MK', 'MKD', 'EU', 'Macedonia, the former Yugoslav Republic of', '389', 'MK.png'),
(234, '818', 'EGP', '£', 2, 'EG', 'EGY', 'AF', 'Egypt', '20', 'EG.png'),
(235, '826', 'GBP', '£', 2, 'GB', 'GBR', 'EU', 'United Kingdom', '44', 'GB.png'),
(236, '831', 'GGP (GG2)', NULL, NULL, 'GG', 'GGY', 'EU', 'Guernsey', '44', NULL),
(237, '832', 'JEP (JE2)', NULL, NULL, 'JE', 'JEY', 'EU', 'Jersey', '44', NULL),
(238, '833', 'IMP (IM2)', NULL, NULL, 'IM', 'IMN', 'EU', 'Isle of Man', '44', NULL),
(239, '834', 'TZS', 'TZS', 2, 'TZ', 'TZA', 'AF', 'Tanzania, United Republic of', '255', 'TZ.png'),
(240, '840', 'USD', '$', 2, 'US', 'USA', 'NA', 'United States', '1', 'US.png'),
(241, '850', 'USD', '$', 2, 'VI', 'VIR', 'NA', 'Virgin Islands, U.S.', '1', 'VI.png'),
(242, '854', 'XOF', 'XOF', 0, 'BF', 'BFA', 'AF', 'Burkina Faso', '226', 'BF.png'),
(243, '858', 'UYU', '$U', 0, 'UY', 'URY', 'SA', 'Uruguay', '598', 'UY.png'),
(244, '860', 'UZS', 'лв', 2, 'UZ', 'UZB', 'AS', 'Uzbekistan', '998', 'UZ.png'),
(245, '862', 'VEF', 'Bs', 2, 'VE', 'VEN', 'SA', 'Venezuela, Bolivarian Republic of', '58', 'VE.png'),
(246, '876', 'XPF', 'XPF', 0, 'WF', 'WLF', 'OC', 'Wallis and Futuna', '681', 'WF.png'),
(247, '882', 'WST', 'WS$', 2, 'WS', 'WSM', 'OC', 'Samoa', '685', 'WS.png'),
(248, '887', 'YER', '﷼', 2, 'YE', 'YEM', 'AS', 'Yemen', '967', 'YE.png'),
(249, '894', 'ZMW', 'ZK', 2, 'ZM', 'ZMB', 'AF', 'Zambia', '260', 'ZM.png');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL,
  `second_category_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `benefits` text COLLATE utf8mb4_unicode_ci,
  `requirements` text COLLATE utf8mb4_unicode_ci,
  `price_plan` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(16,2) DEFAULT NULL,
  `sale_price` decimal(16,2) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `is_presale` tinyint(4) DEFAULT '0',
  `launch_at` timestamp NULL DEFAULT NULL,
  `thumbnail_id` int(11) DEFAULT NULL,
  `video_src` text COLLATE utf8mb4_unicode_ci,
  `total_video_time` int(11) DEFAULT NULL,
  `require_enroll` tinyint(4) DEFAULT '1',
  `require_login` tinyint(4) DEFAULT '1',
  `total_lectures` tinyint(4) DEFAULT '0',
  `total_assignments` tinyint(4) DEFAULT '0',
  `total_quiz` tinyint(4) DEFAULT '0',
  `rating_value` decimal(3,2) DEFAULT '0.00',
  `rating_count` tinyint(4) DEFAULT '0',
  `five_star_count` tinyint(4) DEFAULT '0',
  `four_star_count` tinyint(4) DEFAULT '0',
  `three_star_count` tinyint(4) DEFAULT '0',
  `two_star_count` tinyint(4) DEFAULT '0',
  `one_star_count` tinyint(4) DEFAULT '0',
  `is_featured` int(4) DEFAULT NULL,
  `featured_at` timestamp NULL DEFAULT NULL,
  `is_popular` int(4) DEFAULT NULL,
  `popular_added_at` timestamp NULL DEFAULT NULL,
  `last_updated_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `user_id`, `category_id`, `parent_category_id`, `second_category_id`, `title`, `slug`, `short_description`, `description`, `benefits`, `requirements`, `price_plan`, `price`, `sale_price`, `level`, `status`, `is_presale`, `launch_at`, `thumbnail_id`, `video_src`, `total_video_time`, `require_enroll`, `require_login`, `total_lectures`, `total_assignments`, `total_quiz`, `rating_value`, `rating_count`, `five_star_count`, `four_star_count`, `three_star_count`, `two_star_count`, `one_star_count`, `is_featured`, `featured_at`, `is_popular`, `popular_added_at`, `last_updated_at`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, 6, 'PHP For beginners - become master of PHP', 'php-for-beginners-become-master-of-php', 'Everything you need to know about PHP, becomes nob to the pro programmer, example project included.', '<p>Lorem ipsum dolor sit amet, per ridens delectus intellegat cu. Legere graeco dolorem no vim, vix ea atqui graeco intellegat. Cu singulis aliquando has, odio quodsi admodum eos at. Cum erat decore detraxit ad. Ius diam oratio putent in, ut vel vidit expetendis intellegebat.</p>\r\n\r\n<p>No vel iriure vocibus placerat, vis at agam semper accusam. Eum ut aliquam rationibus, eu ius unum pericula imperdiet. Vis ne quod veniam. No singulis aliquando cum, in ubique quidam commune mei. Ut per scaevola voluptatum voluptatibus, cu petentium incorrupte mel. Et quo nihil soluta accumsan, no mei augue denique detracto, ut simul recteque hendrerit mea.</p>\r\n\r\n<p>Qui tritani recteque in, ut sint officiis signiferumque ius, nam minim appellantur ei. Clita recusabo consectetuer vix ei, eu ius eius modus qualisque, eum at soleat dicunt necessitatibus. Nec dolore diceret ei, eu mel quodsi principes reprehendunt. Cu nihil quando praesent vis. Eu usu illud legimus feugait, nec laudem contentiones ex. Equidem efficiendi nec in, in debitis vituperata eam.</p>\r\n\r\n<p>At mel consul labitur. Facilis fastidii ut duo, pro at blandit probatus eleifend, principes vulputate vix ad. Vivendum perpetua principes te mea, similique incorrupte reprehendunt quo at. Ea vel nisl minim ponderum. Qui et eligendi dissentiet, verterem accommodare nec an.</p>\r\n\r\n<p>Ut pri homero ceteros, sed posse inani comprehensam eu. Te ignota euripidis aliquando ius, eos no sonet tacimates interpretaris. Vis ut virtute accusamus, mel repudiandae delicatissimi ex, sed quot novum et. Qui iisque bonorum insolens an. Viderer pertinax quo cu, et per nullam oporteat, his ut magna summo nulla.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, per ridens delectus intellegat cu. Legere graeco dolorem no vim, vix ea atqui graeco intellegat. Cu singulis aliquando has, odio quodsi admodum eos at. Cum erat decore detraxit ad. Ius diam oratio putent in, ut vel vidit expetendis intellegebat.</p>\r\n\r\n<p>No vel iriure vocibus placerat, vis at agam semper accusam. Eum ut aliquam rationibus, eu ius unum pericula imperdiet. Vis ne quod veniam. No singulis aliquando cum, in ubique quidam commune mei. Ut per scaevola voluptatum voluptatibus, cu petentium incorrupte mel. Et quo nihil soluta accumsan, no mei augue denique detracto, ut simul recteque hendrerit mea.</p>\r\n\r\n<p>Qui tritani recteque in, ut sint officiis signiferumque ius, nam minim appellantur ei. Clita recusabo consectetuer vix ei, eu ius eius modus qualisque, eum at soleat dicunt necessitatibus. Nec dolore diceret ei, eu mel quodsi principes reprehendunt. Cu nihil quando praesent vis. Eu usu illud legimus feugait, nec laudem contentiones ex. Equidem efficiendi nec in, in debitis vituperata eam.</p>\r\n\r\n<p>At mel consul labitur. Facilis fastidii ut duo, pro at blandit probatus eleifend, principes vulputate vix ad. Vivendum perpetua principes te mea, similique incorrupte reprehendunt quo at. Ea vel nisl minim ponderum. Qui et eligendi dissentiet, verterem accommodare nec an.</p>\r\n\r\n<p>Ut pri homero ceteros, sed posse inani comprehensam eu. Te ignota euripidis aliquando ius, eos no sonet tacimates interpretaris. Vis ut virtute accusamus, mel repudiandae delicatissimi ex, sed quot novum et. Qui iisque bonorum insolens an. Viderer pertinax quo cu, et per nullam oporteat, his ut magna summo nulla.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, per ridens delectus intellegat cu. Legere graeco dolorem no vim, vix ea atqui graeco intellegat. Cu singulis aliquando has, odio quodsi admodum eos at. Cum erat decore detraxit ad. Ius diam oratio putent in, ut vel vidit expetendis intellegebat.</p>\r\n\r\n<p>No vel iriure vocibus placerat, vis at agam semper accusam. Eum ut aliquam rationibus, eu ius unum pericula imperdiet. Vis ne quod veniam. No singulis aliquando cum, in ubique quidam commune mei. Ut per scaevola voluptatum voluptatibus, cu petentium incorrupte mel. Et quo nihil soluta accumsan, no mei augue denique detracto, ut simul recteque hendrerit mea.</p>\r\n\r\n<p>Qui tritani recteque in, ut sint officiis signiferumque ius, nam minim appellantur ei. Clita recusabo consectetuer vix ei, eu ius eius modus qualisque, eum at soleat dicunt necessitatibus. Nec dolore diceret ei, eu mel quodsi principes reprehendunt. Cu nihil quando praesent vis. Eu usu illud legimus feugait, nec laudem contentiones ex. Equidem efficiendi nec in, in debitis vituperata eam.</p>\r\n\r\n<p>At mel consul labitur. Facilis fastidii ut duo, pro at blandit probatus eleifend, principes vulputate vix ad. Vivendum perpetua principes te mea, similique incorrupte reprehendunt quo at. Ea vel nisl minim ponderum. Qui et eligendi dissentiet, verterem accommodare nec an.</p>\r\n\r\n<p>Ut pri homero ceteros, sed posse inani comprehensam eu. Te ignota euripidis aliquando ius, eos no sonet tacimates interpretaris. Vis ut virtute accusamus, mel repudiandae delicatissimi ex, sed quot novum et. Qui iisque bonorum insolens an. Viderer pertinax quo cu, et per nullam oporteat, his ut magna summo nulla.</p>', 'You will be able to create your own CMS (Like WordPress, Joomla, Drupal)\r\nHow to run PHP code on to server\r\nYou will learn how to use Databases\r\nYou will learn MySQL\r\nObject Oriented Programming\r\nYou will learn how to launch your application online\r\nHow to use forms to submit data to databases\r\nHow to use AJAX to submit data to the server without refreshing the page\r\nYou will learn about PHP security\r\nYou will learn about sessions\r\nPassword hashing\r\nEmail sending\r\nYou will learn to use composer (PHP package manager)\r\nYou will learn to create clean URL\'s and remove the .php from files\r\nYou will learn to use bootstrap by getting experience from the project\r\nYou will learn to debug your code\r\nYou will learn to create pagination\r\nYou will code refactoring\r\nYou will learn to debug (fix your code)\r\nYou will learn to use an API to bring data from a database to a graphical interface\r\nThere is so much more and my hands are just tired of typing :)', 'HTML knowledge\r\nCSS Knowledge\r\nBrowser Run Knowledge\r\nSome terminal usage will be great', 'paid', '199.00', '99.00', 2, 1, 0, NULL, 8, '{\"source\":\"html5\",\"html5_video_id\":\"1\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null,\"live_class\":{\"schedule\":\"2020-06-20 03:58:52\",\"note_to_student\":\"You need to take this lesson in one sitting.\",\"zoom_meeting_id\":\"71242505461\",\"zoom_meeting_password\":\"2PUiUN\"}}', 1192, 1, 1, 9, 2, 0, '4.67', 3, 2, 1, 0, 0, 0, 1, '2020-05-16 10:26:43', 1, '2020-05-16 10:25:46', '2020-06-12 18:04:43', '2020-05-15 23:33:01', '2020-04-22 12:48:25', '2020-06-17 22:41:42'),
(3, 1, 206, 1, 36, 'AWS Certified Engineer - 2020', 'aws-certified-engineer-2020', 'Want to pass the AWS Solutions Architect - Associate Exam? Want to become Amazon Web Services Certified? Do this course!', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>&nbsp;</p>', 'Pass the AWS Certified Solutions Architect - Associate 2020 Exam\r\nDesign Highly Resilient and Scaleable Websites on AWS\r\nBecome Intimately Familiar With The AWS Platform\r\nBecome Amazon Certified\r\nBecome A Cloud Guru', 'You will need to set up an AWS Account (you can use the free tier for this course)\r\nYour own domain name (optional, but recommended)\r\nA Windows, Linux or Mac PC/Laptop', 'free', NULL, NULL, 2, 1, 0, NULL, 12, NULL, 0, 1, 1, 1, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, 1, '2020-05-16 09:56:40', 1, '2020-05-16 09:56:14', '2020-05-09 15:14:27', '2020-05-15 23:33:01', '2020-05-06 05:42:47', '2020-05-16 09:56:40'),
(8, 1, 8, 1, 6, 'Python 3: Deep Dive', 'python-3-deep-dive', 'Functions and Functional Programming, Variables, Closures, Decorators, Modules and Packages', '<p><strong>Contrary to popular belief, Lorem Ipsum is not si</strong>mply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>', 'An in-depth look at variables, memory, namespaces and scopes\r\nA deep dive into Python\'s memory management and optimizations\r\nIn-depth understanding and advanced usage of Python\'s numerical data types (Booleans, Integers, Floats, Decimals, Fractions, Complex Numbers)\r\nAdvanced Boolean expressions and operators\r\nAdvanced usage of callables including functions, lambdas and closures\r\nFunctional programming techniques such as map, reduce, filter, and partials\r\nCreate advanced decorators, including parametrized decorators, class decorators, and decorator classes\r\nAdvanced decorator applications such as memoization and single dispatch generic functions\r\nUse and understand Python\'s complex Module and Package system\r\nIdiomatic Python and best practices\r\nUnderstand Python\'s compile-time and run-time and how this affects your code\r\nAvoid common pitfalls', 'Basic introductory knowledge of Python programming (variables, conditional statements, loops, functions, lists, tuples, dictionaries, classes).\r\nYou will need Python 3.6 or above, and a development environment of your choice (command line, PyCharm, Jupyter, etc.)', 'paid', '9.99', '199.00', 3, 1, 0, NULL, 11, '{\"live_class\":{\"schedule\":\"2020-06-17 03:58:52\",\"note_to_student\":\"You need to take this lesson in one sitting.\",\"zoom_meeting_id\":\"71111443464\",\"zoom_meeting_password\":\"4iwKBb\"}}', 0, 1, 1, 1, 0, 0, '3.00', 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, NULL, '2020-05-29 22:33:13', '2020-05-16 10:08:10', '2020-05-08 13:31:38', '2020-06-16 22:15:53'),
(9, 4, 323, 15, 132, 'DIY Skincare :: Magnificence for Maturing and Dry Skin', 'diy-skincare-magnificence-for-maturing-and-dry-skin', 'Make simple custom made, successful, common skin health management for the most astounding solid skin utilizing home grown cures and herbalism', '<p>There are such a significant number of advantages to making your own facial skincare you&#39;ll ask why you didn&#39;t begin sooner! It&#39;s simpler than you might suspect and anybody can do it. This course gives all of you the abilities you have to make a total custom made facial skincare routine for extreme magnificence.&nbsp;</p>\r\n\r\n<p>You will learn point by point data about creation, utilizing and putting away your skincare manifestations including chemicals, steam, veil, toner and cream. You will likewise realize what else you can accomplish for extreme excellence and brilliant wellbeing.&nbsp;</p>\r\n\r\n<p>Course benefits:&nbsp;</p>\r\n\r\n<p>Maintain a strategic distance from dangerous synthetic concoctions of business items&nbsp;</p>\r\n\r\n<p>Taylor your skincare to your careful needs&nbsp;</p>\r\n\r\n<p>Make delicate chemicals that don&#39;t strip useful oils&nbsp;</p>\r\n\r\n<p>Find the astonishing methods fundamental for excellence and putting your best self forward&nbsp;</p>\r\n\r\n<p>Make shining, brilliant skin&nbsp;</p>\r\n\r\n<p>Profoundly feed the skin for long haul benefits&nbsp;</p>\r\n\r\n<p>The course offers:&nbsp;</p>\r\n\r\n<p>Gaining from an expert formulator of characteristic plant skincare&nbsp;</p>\r\n\r\n<p>Information to make total every day and week by week regimens of astounding quality skincare&nbsp;</p>\r\n\r\n<p>Simple bit by bit directions to figure for develop or dry skin types&nbsp;</p>\r\n\r\n<p>Nitty gritty straightforward plans in pdf position&nbsp;</p>\r\n\r\n<p>Comprehension of the most useful and viable elements for incredible excellence&nbsp;</p>\r\n\r\n<p>This course is stuffed with bits of knowledge from long stretches of understanding. You will never discover preferred skincare over what you can make yourself. It will be fresher, far unrivaled or more all, sheltered and solid. You can tailor to your own particular develop, harmed or dry skin type needs.&nbsp;</p>\r\n\r\n<p>This course accentuates recuperating botanicals. Botanicals offer significant sustenance all around. The restorative business is getting on. Organizations huge and little are receiving plant-based details and returning to plant fixings that have been utilized with extraordinary adequacy for a considerable length of time. However what you pay at the counter to a great extent takes care of the tremendous expenses for advertising, protection, organization and retail overhead. Keep away from the costs, additives and regularly hazardous synthetic substances by making your own skincare in affectionately healthy little groups.&nbsp;</p>\r\n\r\n<p>A couple of long stretches of kitchen fun will give all your healthy skin requirements for two to a half year.&nbsp;</p>\r\n\r\n<p>Making skincare in your own kitchen truly is fun and it&#39;s innovative. In particular, you&#39;ll be profoundly thinking about yourself every single time you utilize your own manifestations.&nbsp;</p>\r\n\r\n<p>Select now for the best skin of your life!</p>', 'Taylor your skincare to your definite needs \r\nMake delicate chemicals that don\'t strip advantageous oils \r\nFind the astonishing strategies basic for putting your best self forward \r\nMake shining, brilliant skin \r\nProfoundly feed the skin for long haul benefits \r\nMaintain a strategic distance from perilous synthetic substances of business brands', NULL, 'free', NULL, NULL, 1, 1, 0, NULL, 18, NULL, 0, 1, 1, 2, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, 1, '2020-05-16 00:15:39', 1, '2020-05-16 09:56:14', '2020-05-11 15:14:28', '2020-05-15 23:33:01', '2020-05-11 15:11:06', '2020-05-16 09:56:14'),
(10, 6, 162, 1, 2, 'Angular - The Complete Guide', 'angular-the-complete-guide', 'Ace Angular 9 (once in the past \"Rakish 2\") and manufacture amazing, responsive web applications with the replacement of Angular.js', '<p>This course begins without any preparation, you neither need to know Angular 1 nor Angular 2!&nbsp;</p>\r\n\r\n<p>Precise 9 basically is the most recent variant of Angular 2, you will take in this astounding structure from the beginning in this course!&nbsp;</p>\r\n\r\n<p>Join the most far reaching, famous and top of the line Angular seminar on Udemy and advantage from a demonstrated course idea as well as from an immense network also!&nbsp;</p>\r\n\r\n<p>From Setup to Deployment, this course covers everything! You&#39;ll gain proficiency with about Components, Directives, Services, Forms, Http Access, Authentication, Optimizing an Angular App with Modules and Offline Compilation and considerably more - and at long last: You&#39;ll figure out how to send an application!&nbsp;</p>\r\n\r\n<p>In any case, that is not all! This course will likewise tell you the best way to utilize the Angular CLI and highlight a total venture, which permits you to rehearse the things learned all through the course!&nbsp;</p>\r\n\r\n<p>Also, in the event that you do stall out, you profit by a very quick and benevolent help - both through direct informing or conversation. You have my assertion! ;- )&nbsp;</p>\r\n\r\n<p>Precise is one of the most present day, execution proficient and ground-breaking frontend systems you can learn starting today. It permits you to manufacture extraordinary web applications which offer marvelous client encounters! Get familiar with all the essentials you have to know to begin creating Angular applications immediately.&nbsp;</p>\r\n\r\n<p>Hear what my understudies need to state&nbsp;</p>\r\n\r\n<p>Completely fabulous instructional exercise arrangement. I can&#39;t thank you enough. The quality is top of the line and your presentational aptitudes are top notch. Keep up this astounding work. You truly rock!﻿&nbsp;- Paul Whitehouse&nbsp;</p>\r\n\r\n<p>The educator, Max, is exceptionally energetic and locks in. He works superbly of clarifying what he&#39;s doing and why instead of having understudies quite recently copy his coding. Max was likewise exceptionally receptive to questions. I would suggest this course and any others that he offers. Much appreciated, Max!&nbsp;</p>\r\n\r\n<p>As an individual new to both JavaScript and Angular 2 I discovered this course amazingly supportive on the grounds that Max works admirably of clarifying all the significant ideas driving the code. Max has an extraordinary instructing capacity to concentrate on what his crowd needs to comprehend.&nbsp;</p>\r\n\r\n<p>This Course utilizes TypeScript&nbsp;</p>\r\n\r\n<p>TypeScript is the fundamental language utilized by the authority Angular group and the language you&#39;ll for the most part observe in Angular instructional exercises. It&#39;s a superset to JavaScript and makes composing Angular applications extremely simple. Utilizing it guarantees, that you will have the most ideal groundwork for making Angular applications. Look at the free recordings for more data.&nbsp;</p>\r\n\r\n<p>TypeScript information is, in any case, not required - fundamental JavaScript information is sufficient.&nbsp;</p>\r\n\r\n<p>Why Angular?&nbsp;</p>\r\n\r\n<p>Rakish is the following serious deal. Being the replacement of the overwhelmingly effective Angular.js structure&#39;s will undoubtedly shape the eventual fate of frontend improvement along these lines. The incredible highlights and capacities of Angular permit you to make perplexing, adjustable, present day, responsive and easy to use web applications.&nbsp;</p>\r\n\r\n<p>Rakish 9 just is the most recent rendition of the Angular system and essentially an update to Angular 2.&nbsp;</p>\r\n\r\n<p>Precise is quicker than Angular 1 and offers a considerably more adaptable and secluded improvement approach. In the wake of taking this course you&#39;ll have the option to completely exploit each one of those highlights and begin creating marvelous applications right away.&nbsp;</p>\r\n\r\n<p>Because of the extraordinary contrasts between Angular 1 and Angular (=Angular 9) you don&#39;t have to know anything about Angular.js to have the option to profit by this course and construct your fates ventures with Angular.&nbsp;</p>\r\n\r\n<p>Get a profound comprehension of how to make Angular applications&nbsp;</p>\r\n\r\n<p>This course will show all of you the basics modules, orders, segments, databinding, directing, HTTP access and substantially more! We will take a great deal of profound plunges and each segment is upheld up with a genuine undertaking. All models exhibit the highlights Angular offers and how to apply them accurately.&nbsp;</p>\r\n\r\n<ul>\r\n	<li>Explicitly you will learn:&nbsp;</li>\r\n	<li>Which engineering Angular employments&nbsp;</li>\r\n	<li>Step by step instructions to utilize TypeScript to compose Angular applications&nbsp;</li>\r\n	<li>About orders and parts, including the formation of custom mandates/segments&nbsp;</li>\r\n	<li>How databinding functions&nbsp;</li>\r\n	<li>About steering and taking care of route&nbsp;</li>\r\n	<li>What Pipes are and how to utilize them&nbsp;</li>\r\n</ul>\r\n\r\n<p>The most effective method to get to the Web (for example Serene servers)&nbsp;</p>\r\n\r\n<p>What reliance infusion is and how to utilize it&nbsp;</p>\r\n\r\n<p>The most effective method to utilize Modules in Angular&nbsp;</p>\r\n\r\n<p>The most effective method to enhance your (greater) Angular Application&nbsp;</p>\r\n\r\n<p>A prologue to NgRx and complex state the board&nbsp;</p>\r\n\r\n<p>We will manufacture a significant venture in this course with the goal that you can rehearse all ideas&nbsp;</p>\r\n\r\n<p>thus considerably more!&nbsp;</p>\r\n\r\n<p>Pay once, advantage a lifetime!&nbsp;</p>\r\n\r\n<p>Try not to lose whenever, increase an edge and begin growing at this point!&nbsp;</p>\r\n\r\n<p>Who this course is for:&nbsp;</p>\r\n\r\n<p>Newcomer just as experienced frontend designers keen on learning an advanced JavaScript structure&nbsp;</p>\r\n\r\n<p>This course is for everybody keen on learning a best in class frontend JavaScript structure&nbsp;</p>\r\n\r\n<p>Taking this course will empower you to be among the first to increase an extremely strong comprehension of Angular</p>', 'Create present day, perplexing, responsive and adaptable web applications with Angular 9 \r\n\r\nCompletely comprehend the engineering behind an Angular application and how to utilize it \r\n\r\nUtilize the increased, profound comprehension of the Angular essentials to rapidly set up yourself as a frontend designer \r\n\r\nMake single-page applications with one of the most present day JavaScript systems out there', 'HTML JS knowledge\r\nLaptop and Browsers', 'paid', '29.00', NULL, 3, 1, 0, NULL, 19, '{\"source\":\"html5\",\"html5_video_id\":\"20\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null}', 0, 1, 1, 6, 1, 0, '0.00', 0, 0, 0, 0, 0, 0, 1, '2020-05-16 09:56:40', 1, '2020-05-16 00:09:49', '2020-05-12 09:37:11', '2020-05-15 23:33:01', '2020-05-12 09:10:57', '2020-05-16 09:56:40'),
(11, 5, 282, 13, 108, 'The Ultimate Drawing Course - Beginner to Advanced', 'the-ultimate-drawing-course-beginner-to-advanced', 'Draw whatever you want, you will learn the details technique of modern drawing, make wow to anyone.', '<p>Join over 260,000&nbsp;learning students and start gaining the drawing skills you&#39;ve always wanted.</p>\r\n\r\n<p>The Ultimate Drawing Course will show you how to create advanced art that will stand up as professional work. This course will enhance or give you skills in the world of drawing - or your money back</p>\r\n\r\n<p>The course is your track to obtaining drawing skills like you always knew you should have! Whether for your own projects or to draw for other people.</p>\r\n\r\n<p>This course will take you from having little knowledge in drawing to creating advanced art and having a deep understanding of drawing fundamentals.</p>\r\n\r\n<p>So what else is in it for you?</p>\r\n\r\n<p><strong>You&rsquo;ll create&nbsp;over 50&nbsp;different projects in this course that will take you from beginner to expert!</strong></p>\r\n\r\n<p>You&rsquo;ll gain instant access to all 11 sections of the course.</p>\r\n\r\n<p>The course is setup to quickly take you through step by step, the process of drawing in many different styles. It will equip you with the knowledge to create stunning designs and illustrations!</p>\r\n\r\n<p><strong>Don&rsquo;t believe me? I offer you a full money-back guarantee within the first 30 days of purchasing the course.</strong></p>\r\n\r\n<p>Here&rsquo;s what you get with the course:</p>\r\n\r\n<p>You&rsquo;ll get access to the11&nbsp;sections of the course that will teach you the fundamentals of drawing from the ground up. The course is supported with over 11 hours of clear content that I walk you through each step of the way.</p>\r\n\r\n<p>All at your fingers tips instantly.</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>The course starts with the basics. You will get an in depth understanding of the fundamentals of drawing. Fundamentals are the most important part of creating professional art. You will learn everything from line fundamentals all the way up to highlight and shadows.</p>\r\n	</li>\r\n	<li>\r\n	<p>Next you&rsquo;ll learn how perspective works and how to incorporate it into your art. You will be learning 1, 2, and 3 point perspective.</p>\r\n	</li>\r\n	<li>\r\n	<p>Once you&rsquo;ve learned perspective you are going to learn how to create texture and apply it to your drawings.</p>\r\n	</li>\r\n	<li>\r\n	<p>Then you are going to learn how to draw from life. Observing life and drawing it is a very important skill when it comes to art.</p>\r\n	</li>\r\n	<li>\r\n	<p>At this point you&rsquo;ll be ready to start drawing the human face. We will spend a whole section learning how to draw the human face from different angles.</p>\r\n	</li>\r\n	<li>\r\n	<p>Next you&rsquo;re going to learn how to draw the human figure.</p>\r\n	</li>\r\n	<li>\r\n	<p>Lastly you will gain access to the bonus section where I&rsquo;ll teach you how I draw animation styled characters step by step.</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>Over the 7 chapters you will learn:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>How to draw an eye</p>\r\n	</li>\r\n	<li>\r\n	<p>Line fundamentals</p>\r\n	</li>\r\n	<li>\r\n	<p>Shape and form fundamental</p>\r\n	</li>\r\n	<li>\r\n	<p>How to use value and contrast</p>\r\n	</li>\r\n	<li>\r\n	<p>Space and perspective</p>\r\n	</li>\r\n	<li>\r\n	<p>Still life drawing</p>\r\n	</li>\r\n	<li>\r\n	<p>Creating texture</p>\r\n	</li>\r\n	<li>\r\n	<p>Drawing the human face</p>\r\n	</li>\r\n	<li>\r\n	<p>Drawing the human figure</p>\r\n	</li>\r\n	<li>\r\n	<p>Drawing animation styled art</p>\r\n	</li>\r\n</ul>\r\n\r\n<p>What else will you get?</p>\r\n\r\n<p>- Personal contact with me, the course tutor</p>\r\n\r\n<p>- Lifetime access to course materials</p>\r\n\r\n<p>- Understanding of how professional art is created</p>\r\n\r\n<p>- Quizzes and exercise work sheets</p>\r\n\r\n<p>This all comes under one convenient easy to use platform. Plus you will get fast, friendly, responsive support on the Udemy Q&amp;A section of the course or direct message.</p>\r\n\r\n<p>I will be here for you&nbsp;every step of the way!</p>\r\n\r\n<p><strong>So what are you waiting for? Sign up now and change your art world today!</strong></p>\r\n\r\n<p>Who this course is for:</p>\r\n\r\n<ul>\r\n	<li>Students wanting to learn how to draw</li>\r\n	<li>Students willing to put in a couple hours to learn how to draw</li>\r\n	<li>Students willing to take action and start drawing amazing artwork</li>\r\n	<li>Students wanting to add another skill to their tool belt</li>\r\n</ul>', 'Draw objects out of your head\r\nDraw realistic light and shadow\r\nUnderstand the fundamentals of art\r\nDraw perspective drawings\r\nDraw the human face and figure', 'Paper\r\nPencil\r\nEraser\r\nRuler\r\nMotivation to learn!', 'paid', '99.00', '9.99', 1, 1, 0, NULL, 26, '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null}', 0, 1, 1, 5, 0, 2, '0.00', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, '2020-05-27 20:37:01', '2020-05-17 15:24:29', '2020-05-17 15:00:39', '2020-05-27 20:37:01'),
(12, 5, 224, 1, 47, 'AWS Certified Cloud Practitioner 2020', 'aws-certified-cloud-practitioner-2020', 'Analyze aws from scratch from one of the top rated guides within the international.', '<p>This course is designed from absolute scratch and is meant for people who intend to begin their journey into aws and give the aws cloud practitioner certification. With easy to apprehend motion pictures, devoted exam training section, and 300+ practice questions, this path is all that is needed to advantage the aws cloud practitioner certification. With more than sixty five,000+ college students on-board, join us into the amazing adventure on aws. Who this path is for:<br />\r\nthose proceeding to advantage aws certified cloud practitioner certification<br />\r\npeople who want to gain high degree review of amazon web services</p>', 'You will have high level overview on what AWS Cloud is all about.\r\nYou will be ready to give the AWS Cloud Practitioner certification exam.', NULL, 'paid', '129.00', '29.00', 1, 1, 0, NULL, 33, '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null}', 0, 1, 1, 22, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, 1, '2020-05-27 11:49:25', NULL, NULL, '2020-05-27 11:43:26', '2020-05-27 11:49:00', '2020-05-27 11:28:08', '2020-05-27 11:49:25'),
(13, 5, 986, 12, 93, 'Management Skills: New Manager Training in Essential Skills', 'management-skills-new-manager-training-in-essential-skills', 'Control abilities certification in growing humans, leading groups & process development', '<p><strong>The assignment:&nbsp;</strong></p>\r\n\r\n<p>maximum new managers have the technical skills to be triumphant. What they regularly lack is the skill of managing, motivating and growing their personnel. This direction will provide the ones capabilities which can be vital for your achievement as a supervisor. This direction is organized round three critical blocks of skills: first, managing and motivating people; 2nd, leading high acting groups; and third, engaging their human beings within the continuous improvement of labor approaches. If a you could master those competencies your success is actually guaranteed. The lessons in this direction are strongly encouraged through the trainer&#39;s widespread heritage in lean control and in growing excessive appearing teams. The route is ideally suited for brand new managers in corporations trying to expand lean way of life. It is also perfect for young entrepreneurs who are simply beginning their adventure as managers. The teacher has forty five years of revel in schooling managers and building a subculture of teamwork at organizations like honda, shell oil, corning, honeywell and many others. Movement-mastering:</p>\r\n\r\n<p>this path is dependent to facilitate the connection between the brand new manager and a instruct. There are 13 physical activities that ask the scholar to place the instructions to paintings with their group or practice with their teach. The trainer employs an &quot;action-learning&quot; model, spotting that the first-class mastering occurs from making use of the lessons to the student&#39;s actual paintings scenario, and from receiving comments from a coach. It&#39;s far meant as a complete model and curriculum for new managers. Recognition and celebration:</p>\r\n\r\n<p>while you whole this course, you may get hold of a certificate completion from udemy. But, this is a worrying direction and you&#39;re requested to demonstrate competence in dealing with human beings, teams and processes. The teacher believes that you deserve greater recognition. If you whole the assignments and send a portfolio of completed assignments to the teacher you may be identified with a inexperienced belt certification by using the institute for leadership excellence; and, the author will send you ebook copies of his 3 most latest books on education, crew management, and developing lean company and lifestyle. You deserve it! Be aware: this course duplicates plenty of the cloth inside the instructor&#39;s famous crew leadership course. However, there&#39;s new material for brand new managers on worker area, communication and struggle decision. On this route the teacher speaks to the wishes and enjoy of newly promoted managers and marketers. I lately acquired the subsequent message from one of my college students who just completed this path:&nbsp;</p>\r\n\r\n<p>&quot;right morning larry. I simply finished your course and i did depart a review however just desired to message you, to tell you, thanks for the direction. I stated at the evaluation but the corporation i paintings for went from a complete zoo to a respectable vicinity to work in just beneath 2 months and it changed into particularly due to this direction and your info. People have complemented me on the high-quality task i&#39;ve been doing and i do owe it to you so thanks! I will be doing all of your different path and you should keep doing greater publications due to the fact you&#39;re a first rate trainer!&quot; kevin mohammed</p>\r\n\r\n<p><strong>who this path is for:</strong></p>\r\n\r\n<ul>\r\n	<li>new managers or currently promoted managers who want to analyze the primary competencies of dealing with people, leading groups and improving paintings tactics. Any manager wanting to improve their people control abilities.</li>\r\n</ul>', 'Motivate your employees and create high engagement and empowerment.\r\nProvide specific job training for your team members..\r\nLead teams to become high performing teams engaged in continuous improvement.\r\nUnderstand and develop \"lean management\" problem-solving and process improvement.\r\nResolve conflicts with others and among team members.', 'There are no requirements for this course other than the desire to become a highly successful manager.', 'paid', '119.00', '15.00', 1, 1, 0, NULL, 34, '{\"source\":\"html5\",\"html5_video_id\":\"27\",\"html5_video_poster_id\":null,\"source_external_url\":null,\"source_youtube\":null,\"source_vimeo\":null,\"source_embedded\":null}', 0, 1, 1, 14, 0, 0, '0.00', 0, 0, 0, 0, 0, 0, 1, '2020-05-27 12:09:10', NULL, NULL, '2020-05-27 12:08:06', '2020-05-27 12:09:04', '2020-05-27 11:53:43', '2020-05-27 12:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `course_user`
--

DROP TABLE IF EXISTS `course_user`;
CREATE TABLE `course_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `permissions` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_user`
--

INSERT INTO `course_user` (`id`, `course_id`, `user_id`, `permissions`, `added_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 1, NULL, NULL),
(4, 4, 1, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 6, 1, NULL, NULL),
(7, 7, 1, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 9, 4, NULL, NULL),
(10, 10, 6, NULL, '2020-05-12 09:10:57'),
(12, 10, 5, NULL, '2020-05-12 13:31:38'),
(13, 11, 5, NULL, '2020-05-17 15:00:39'),
(14, 11, 6, NULL, '2020-05-17 15:23:00'),
(15, 12, 5, NULL, '2020-05-27 11:28:08'),
(16, 12, 6, NULL, '2020-05-27 11:47:34'),
(17, 13, 5, NULL, '2020-05-27 11:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

DROP TABLE IF EXISTS `discussions`;
CREATE TABLE `discussions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT '0',
  `content_id` int(11) DEFAULT '0',
  `instructor_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `discussion_id` int(11) DEFAULT '0',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `replied` tinyint(4) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`id`, `course_id`, `content_id`, `instructor_id`, `user_id`, `discussion_id`, `title`, `message`, `replied`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 0, 3, 0, 'Will it run into python compiler', 'Hi\r\n\r\nI learned a lot from the <a  href=\"https://google.com\">google.com</a> and my compiler running fine, my question is if your solution work on the my current compiler too?\r\n\r\nBest Regards', 0, '2020-05-17 10:04:37', '2020-05-17 10:04:37'),
(2, 1, 9, 0, 3, 0, 'Cound not understood th pie lesson, from where the digits comes?', 'I\'m lost here, form the didigst comes to my code, and I can\'t conterate there. Let me know if I could adopt this.\r\n', 1, '2020-05-17 10:41:17', '2020-05-17 11:52:48'),
(3, 1, 9, 0, 1, 2, NULL, 'Hi McAlister\r\n\r\nHope you doing great, the topic you understand is actually easy, I always easily solve it, just skip it and it will be no more issue for you.\r\n\r\nHope you my answer will help you to continue learning.', 0, '2020-05-17 11:52:48', '2020-05-17 11:52:48'),
(4, 1, 9, 0, 1, 2, NULL, 'As I said above, You must learn a lot more from this course.\r\nCheck all of the attachments.', 0, '2020-05-17 12:09:10', '2020-05-17 12:09:10'),
(5, 1, 9, 0, 3, 2, NULL, 'Ok mam, I understood.\r\n\r\nI learned a lot and I comes in this discussion that, you have poor knowledge about this course. huh!', 0, '2020-05-17 12:18:12', '2020-05-17 12:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

DROP TABLE IF EXISTS `earnings`;
CREATE TABLE `earnings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `instructor_amount` decimal(16,2) DEFAULT NULL,
  `admin_amount` decimal(16,2) DEFAULT NULL,
  `instructor_share` decimal(16,2) DEFAULT NULL,
  `admin_share` decimal(16,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `earnings`
--

INSERT INTO `earnings` (`id`, `instructor_id`, `course_id`, `payment_id`, `payment_status`, `amount`, `instructor_amount`, `admin_amount`, `instructor_share`, `admin_share`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 4, 'success', '20.00', '16.00', '4.00', '80.00', '20.00', '2020-05-06 12:44:26', '2020-05-06 12:44:26'),
(2, 1, 2, 4, 'success', '20.00', '16.00', '4.00', '80.00', '20.00', '2020-05-06 12:44:26', '2020-05-06 12:44:26'),
(3, 1, 1, 4, 'success', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-06 12:44:26', '2020-05-06 12:44:26'),
(4, 1, 2, 5, 'success', '20.00', '16.00', '4.00', '80.00', '20.00', '2020-05-06 12:55:05', '2020-05-06 12:55:05'),
(5, 1, 1, 7, 'pending', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-06 15:33:19', '2020-05-06 15:33:19'),
(7, 1, 1, 9, 'initial', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 05:54:31', '2020-05-07 05:54:31'),
(8, 1, 1, 10, 'initial', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 05:55:39', '2020-05-07 05:55:39'),
(9, 1, 1, 11, 'declined', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 05:56:30', '2020-05-07 05:56:30'),
(10, 1, 1, 12, 'initial', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 06:24:10', '2020-05-07 06:24:10'),
(11, 1, 1, 13, 'initial', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 06:25:31', '2020-05-07 06:25:31'),
(12, 1, 1, 14, 'failed', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 06:28:10', '2020-05-07 06:28:10'),
(13, 1, 1, 15, 'initial', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 09:20:02', '2020-05-07 09:20:02'),
(14, 1, 1, 16, 'initial', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 09:21:30', '2020-05-07 09:21:30'),
(15, 1, 1, 17, 'onhold', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-07 10:37:32', '2020-05-07 10:37:32'),
(16, 1, 1, 18, 'success', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-08 10:26:27', '2020-05-08 10:26:27'),
(17, 1, 1, 19, 'success', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-11 06:08:51', '2020-05-11 06:08:51'),
(18, 1, 1, 20, 'success', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-11 07:10:58', '2020-05-11 07:10:58'),
(19, 1, 8, 21, 'success', '199.00', '159.20', '39.80', '80.00', '20.00', '2020-05-11 10:36:35', '2020-05-11 10:36:35'),
(20, 1, 1, 22, 'success', '99.00', '79.20', '19.80', '80.00', '20.00', '2020-05-11 10:42:01', '2020-05-11 10:42:01'),
(21, 5, 11, 23, 'success', '9.99', '7.99', '2.00', '80.00', '20.00', '2020-05-19 16:21:42', '2020-05-19 16:21:42'),
(22, 5, 12, 24, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:31:16', '2020-08-03 19:31:16'),
(23, 5, 12, 25, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:31:34', '2020-08-03 19:31:34'),
(24, 5, 12, 26, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:31:43', '2020-08-03 19:31:43'),
(25, 5, 12, 27, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:31:56', '2020-08-03 19:31:56'),
(26, 5, 12, 28, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:32:30', '2020-08-03 19:32:30'),
(27, 5, 12, 29, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:32:38', '2020-08-03 19:32:38'),
(28, 5, 12, 30, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:32:53', '2020-08-03 19:32:53'),
(29, 5, 12, 31, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:33:00', '2020-08-03 19:33:00'),
(30, 5, 12, 32, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:33:11', '2020-08-03 19:33:11'),
(31, 5, 12, 33, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:33:33', '2020-08-03 19:33:33'),
(32, 5, 12, 34, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:34:50', '2020-08-03 19:34:50'),
(33, 5, 12, 35, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:39:46', '2020-08-03 19:39:46'),
(34, 5, 12, 36, 'initial', '29.00', '23.20', '5.80', '80.00', '20.00', '2020-08-03 19:43:02', '2020-08-03 19:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

DROP TABLE IF EXISTS `enrolls`;
CREATE TABLE `enrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `course_price` decimal(16,2) DEFAULT NULL,
  `payment_id` int(11) DEFAULT '0',
  `status` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `enrolled_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`id`, `course_id`, `user_id`, `course_price`, `payment_id`, `status`, `enrolled_at`) VALUES
(13, 1, 1, '99.00', 7, 'pending', '2020-05-06 15:33:19'),
(15, 1, 1, '99.00', 9, 'initial', '2020-05-07 05:54:31'),
(17, 1, 1, '99.00', 11, 'declined', '2020-05-07 05:56:30'),
(18, 1, 1, '99.00', 12, 'initial', '2020-05-07 06:24:10'),
(19, 1, 1, '99.00', 13, 'initial', '2020-05-07 06:25:31'),
(20, 1, 1, '99.00', 14, 'failed', '2020-05-07 15:13:15'),
(21, 1, 1, '99.00', 15, 'initial', '2020-05-07 09:20:02'),
(22, 1, 1, '99.00', 16, 'initial', '2020-05-07 09:21:30'),
(23, 1, 1, '99.00', 17, 'onhold', '2020-05-07 20:50:54'),
(24, 1, 1, '99.00', 18, 'success', '2020-05-08 10:26:27'),
(26, 1, 2, '99.00', 20, 'success', '2020-05-11 07:10:58'),
(27, 8, 3, '199.00', 21, 'success', '2020-05-11 10:36:35'),
(28, 1, 3, '99.00', 22, 'success', '2020-05-11 10:42:01'),
(29, 11, 3, '9.99', 23, 'success', '2020-05-19 16:21:42'),
(30, 12, 1, '29.00', 24, 'initial', '2020-08-03 19:31:16'),
(31, 12, 1, '29.00', 25, 'initial', '2020-08-03 19:31:34'),
(32, 12, 1, '29.00', 26, 'initial', '2020-08-03 19:31:43'),
(33, 12, 1, '29.00', 27, 'initial', '2020-08-03 19:31:56'),
(34, 12, 1, '29.00', 28, 'initial', '2020-08-03 19:32:30'),
(35, 12, 1, '29.00', 29, 'initial', '2020-08-03 19:32:38'),
(36, 12, 1, '29.00', 30, 'initial', '2020-08-03 19:32:53'),
(37, 12, 1, '29.00', 31, 'initial', '2020-08-03 19:33:00'),
(38, 12, 1, '29.00', 32, 'initial', '2020-08-03 19:33:11'),
(39, 12, 1, '29.00', 33, 'initial', '2020-08-03 19:33:33'),
(40, 12, 1, '29.00', 34, 'initial', '2020-08-03 19:34:50'),
(41, 12, 1, '29.00', 35, 'initial', '2020-08-03 19:39:46'),
(42, 12, 1, '29.00', 36, 'initial', '2020-08-03 19:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `user_id`, `name`, `title`, `alt_text`, `slug`, `slug_ext`, `file_size`, `mime_type`, `metadata`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'SampleVideo_1280x720_5mb.mp4', NULL, NULL, 'samplevideo-1280x720-5mb', 'samplevideo-1280x720-5mb.mp4', '5253880', 'video/mp4', '{\"filesize\":5253880,\"mime_type\":\"video\\/mp4\",\"length\":30,\"length_formatted\":\"0:30\",\"width\":1280,\"height\":720,\"fileformat\":\"mp4\",\"dataformat\":\"quicktime\",\"audio\":{\"dataformat\":\"mp4\",\"codec\":\"ISO\\/IEC 14496-3 AAC\",\"sample_rate\":48000,\"channels\":2,\"bits_per_sample\":16,\"lossless\":false,\"channelmode\":\"stereo\"},\"created_timestamp\":0}', 0, '2020-04-25 13:02:43', '2020-04-25 13:02:43'),
(2, 1, 'learning.jpg', NULL, NULL, 'learning', 'learning.jpg', '199291', 'image/jpeg', NULL, 0, '2020-04-25 13:23:47', '2020-04-25 13:23:47'),
(3, 1, 'disnep.png', NULL, NULL, 'disnep', 'disnep.png', '10989', 'image/png', NULL, 0, '2020-04-28 11:45:01', '2020-04-28 11:45:01'),
(7, 1, 'attachment-assignment-1.zip', NULL, NULL, 'attachment-assignment-1', 'attachment-assignment-1.zip', '1426', 'application/zip', NULL, 0, '2020-04-30 14:03:21', '2020-04-30 14:03:21'),
(8, 1, 'women-holding-phone.jpg', NULL, NULL, 'women-holding-phone', 'women-holding-phone.jpg', '63271', 'image/jpeg', NULL, 0, '2020-05-01 09:59:14', '2020-05-01 09:59:14'),
(11, 1, 'python.jpg', NULL, NULL, 'python', 'python.jpg', '45856', 'image/jpeg', NULL, 0, '2020-05-09 14:35:03', '2020-05-09 14:35:03'),
(12, 1, 'AWS-banner.jpg', NULL, NULL, 'aws-banner', 'aws-banner.jpg', '47130', 'image/jpeg', NULL, 0, '2020-05-09 14:35:55', '2020-05-09 14:35:55'),
(14, 1, 'photo-portrait.jpg', NULL, NULL, 'photo-portrait', 'photo-portrait.jpg', '80734', 'image/jpeg', NULL, 0, '2020-05-10 07:04:47', '2020-05-10 07:04:47'),
(17, 3, 'handsome-4133131_640.jpg', NULL, NULL, 'handsome-4133131-640', 'handsome-4133131-640.jpg', '28632', 'image/jpeg', NULL, 0, '2020-05-11 10:58:46', '2020-05-11 10:58:46'),
(18, 4, 'beauty-skin.jpg', NULL, NULL, 'beauty-skin', 'beauty-skin.jpg', '18906', 'image/jpeg', NULL, 0, '2020-05-11 15:10:55', '2020-05-11 15:10:55'),
(19, 6, 'angular.jpg', NULL, NULL, 'angular', 'angular.jpg', '15043', 'image/jpeg', NULL, 0, '2020-05-12 09:10:20', '2020-05-12 09:10:20'),
(20, 6, 'SampleVideo_1280x720_5mb.mp4', NULL, NULL, 'samplevideo-1280x720-5mb', 'samplevideo-1280x720-5mb.mp4', '5253880', 'video/mp4', '{\"filesize\":5253880,\"mime_type\":\"video\\/mp4\",\"length\":30,\"length_formatted\":\"0:30\",\"width\":1280,\"height\":720,\"fileformat\":\"mp4\",\"dataformat\":\"quicktime\",\"audio\":{\"dataformat\":\"mp4\",\"codec\":\"ISO\\/IEC 14496-3 AAC\",\"sample_rate\":48000,\"channels\":2,\"bits_per_sample\":16,\"lossless\":false,\"channelmode\":\"stereo\"},\"created_timestamp\":0}', 0, '2020-04-25 13:02:43', '2020-04-25 13:02:43'),
(21, 6, 'albert-dera-ILip77SbmOE-unsplash.jpg', NULL, NULL, 'albert-dera-ilip77sbmoe-unsplash', 'albert-dera-ilip77sbmoe-unsplash.jpg', '132710', 'image/jpeg', NULL, 0, '2020-05-12 09:40:57', '2020-05-12 09:40:57'),
(22, 1, 'online-learning.jpg', NULL, NULL, 'online-learning', 'online-learning.jpg', '159203', 'image/jpeg', NULL, 0, '2020-05-16 20:20:39', '2020-05-16 20:20:39'),
(23, 1, 'man-using-stylus.jpg', NULL, NULL, 'man-using-stylus', 'man-using-stylus.jpg', '128057', 'image/jpeg', NULL, 0, '2020-05-16 21:19:12', '2020-05-16 21:19:12'),
(24, 1, 'table-lamp-reading.jpg', NULL, NULL, 'table-lamp-reading', 'table-lamp-reading.jpg', '155193', 'image/jpeg', NULL, 0, '2020-05-16 23:52:41', '2020-05-16 23:52:41'),
(25, 1, 'six-woman-standing-and-siting-inside-the-room-1181622.jpg', NULL, NULL, 'six-woman-standing-and-siting-inside-the-room-1181622', 'six-woman-standing-and-siting-inside-the-room-1181622.jpg', '207630', 'image/jpeg', NULL, 0, '2020-05-16 23:55:16', '2020-05-16 23:55:16'),
(26, 5, 'drawing.jpg', NULL, NULL, 'drawing', 'drawing.jpg', '31780', 'image/jpeg', NULL, 0, '2020-05-17 14:59:35', '2020-05-17 14:59:35'),
(27, 5, 'SampleVideo_1280x720_5mb.mp4', NULL, NULL, 'samplevideo-1280x720-5mb', 'samplevideo-1280x720-5mb.mp4', '5253880', 'video/mp4', '{\"filesize\":5253880,\"mime_type\":\"video\\/mp4\",\"length\":30,\"length_formatted\":\"0:30\",\"width\":1280,\"height\":720,\"fileformat\":\"mp4\",\"dataformat\":\"quicktime\",\"audio\":{\"dataformat\":\"mp4\",\"codec\":\"ISO\\/IEC 14496-3 AAC\",\"sample_rate\":48000,\"channels\":2,\"bits_per_sample\":16,\"lossless\":false,\"channelmode\":\"stereo\"},\"created_timestamp\":0}', 0, '2020-04-25 13:02:43', '2020-04-25 13:02:43'),
(28, 5, 'monalisa.jpg', NULL, NULL, 'monalisa', 'monalisa.jpg', '98886', 'image/jpeg', NULL, 0, '2020-05-18 11:48:52', '2020-05-18 11:48:52'),
(29, 5, 'Cinderella_castle.jpg', NULL, NULL, 'cinderella-castle', 'cinderella-castle.jpg', '76324', 'image/jpeg', NULL, 0, '2020-05-18 19:41:48', '2020-05-18 19:41:48'),
(30, 5, 'painitinghijibiji.jpg', NULL, NULL, 'painitinghijibiji', 'painitinghijibiji.jpg', '146448', 'image/jpeg', NULL, 0, '2020-05-19 11:51:50', '2020-05-19 11:51:50'),
(31, 5, 'covid-19-2-1140x450-1.jpg', NULL, NULL, 'covid-19-2-1140x450-1', 'covid-19-2-1140x450-1.jpg', '74081', 'image/jpeg', NULL, 0, '2020-05-19 14:23:32', '2020-05-19 14:23:32'),
(32, 1, 'logo.png', NULL, NULL, 'logo', 'logo.png', '21464', 'image/png', NULL, 0, '2020-05-22 19:03:24', '2020-05-22 19:03:24'),
(33, 5, 'aws-learn.jpg', NULL, NULL, 'aws-learn', 'aws-learn.jpg', '23945', 'image/jpeg', NULL, 0, '2020-05-27 11:25:35', '2020-05-27 11:25:35'),
(34, 5, 'businesswomen-businesswoman-interview-meeting-70292.jpg', NULL, NULL, 'businesswomen-businesswoman-interview-meeting-70292', 'businesswomen-businesswoman-interview-meeting-70292.jpg', '32136', 'image/jpeg', NULL, 0, '2020-05-27 11:59:48', '2020-05-27 11:59:48'),
(35, 1, 'signature.png', NULL, NULL, 'signature', 'signature.png', '84192', 'image/png', NULL, 0, '2020-06-05 22:49:43', '2020-06-05 22:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2017_11_25_103526_create_media_table', 1),
(24, '2019_08_19_000000_create_failed_jobs_table', 1),
(25, '2020_04_13_155306_create_options_table', 1),
(26, '2020_04_14_053128_create_countries_table', 1),
(28, '2020_04_19_150640_create_courses_table', 1),
(29, '2020_04_19_185837_create_sections_table', 1),
(30, '2020_04_20_160323_create_course_user_table', 1),
(33, '2020_04_25_091439_create_enrolls_table', 3),
(38, '2020_04_28_172856_create_attachments_table', 4),
(39, '2020_04_30_173643_create_assignment_submissions_table', 5),
(46, '2020_05_01_175907_create_categories_table', 6),
(48, '2020_05_02_113246_create_contents_table', 7),
(50, '2020_05_02_144441_create_completes_table', 8),
(54, '2020_05_05_204608_create_payments_table', 9),
(55, '2020_05_06_140733_create_earnings_table', 9),
(56, '2020_05_10_175048_create_reviews_table', 10),
(57, '2020_05_14_005447_create_wishlist_table', 11),
(59, '2020_05_15_164207_create_withdraws_table', 12),
(60, '2020_05_17_012150_create_posts_table', 13),
(63, '2020_05_17_143030_create_discussions_table', 14),
(66, '2020_05_18_233630_create_questions_table', 15),
(67, '2020_05_18_234745_create_question_options_table', 15),
(72, '2020_05_19_234606_create_attempts_table', 16),
(78, '2020_05_20_043510_create_answers_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_key` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `option_key`, `option_value`) VALUES
(1, 'default_storage', 'public'),
(2, 'date_format', 'd/m/Y'),
(3, 'time_format', 'H:i'),
(4, 'site_name', 'Udify'),
(5, 'site_title', 'Udify'),
(6, 'email_address', 'udify@gmail.com'),
(7, 'default_timezone', 'Asia/Dhaka'),
(8, 'date_format_custom', 'd/m/Y'),
(9, 'time_format_custom', 'H:i'),
(10, 'enable_stripe', '1'),
(11, 'stripe_test_mode', '1'),
(12, 'paypal_receiver_email', 'MerchantKennethNBoyd@teleworm.us'),
(13, 'stripe_test_secret_key', 'sk_test_tJeAdA1KbhiYV8I8bfPmJcOL'),
(14, 'stripe_test_publishable_key', 'pk_test_P3TFmKrvT7l29Zpyy1f4pwk8'),
(15, 'stripe_live_secret_key', NULL),
(16, 'stripe_live_publishable_key', NULL),
(17, 'enable_paypal', '1'),
(18, 'enable_paypal_sandbox', '1'),
(19, 'current_theme', 'bluetheme'),
(20, 'copyright_text', '[copyright_sign] [year] [site_name], All rights reserved.'),
(21, 'enable_social_login', '1'),
(22, 'enable_facebook_login', '1'),
(23, 'enable_google_login', '1'),
(24, 'fb_app_id', '807346162754117'),
(25, 'fb_app_secret', '6b93030d5c4f2715aa9d02be93256fbd'),
(26, 'google_client_id', '62019812075-0sp3u7h854tp7aknl1m8q7ens0pm4im0.apps.googleusercontent.com'),
(27, 'google_client_secret', 'xK8SHn-ds4GJtVSL95ExTzw3'),
(35, 'currency_position', 'left'),
(36, 'currency_sign', 'USD'),
(37, 'payment_gateway_direct-bank-transfer', '{\"enabled\":\"1\",\"title\":\"Direct Bank Transfer\",\"description\":\"Pay via direct bank transfer to process your order\",\"instructions\":\"Please transfer your fund using following Bank Account\\r\\n\\r\\nBank Name: Bank Asia\\r\\nBranch: Mirpur circle 10\\r\\nA\\/C No: 079878765545354\",\"gateway_save_btn\":null}'),
(38, 'payment_gateway_cod', '{\"enabled\":\"1\",\"title\":\"Cash on delivery\",\"description\":\"Pay upon delivery\",\"instructions\":\"Pay upon delivery to the delivery man\",\"gateway_save_btn\":null}'),
(45, 'allowed_file_types', 'jpeg,png,jpg,pdf,zip,doc,docx,xls,ppt,mp4'),
(46, 'is_preview', '1'),
(47, 'admin_share', '20'),
(48, 'instructor_share', '80'),
(49, 'charge_fees_name', 'Payment gateway charge'),
(50, 'charge_fees_amount', '4'),
(51, 'charge_fees_type', 'percent'),
(52, 'enable_charge_fees', '1'),
(53, 'enable_instructors_earning', '1'),
(55, 'bank_gateway', 'json_encode_value_{\"enable_bank_transfer\":\"1\",\"bank_name\":null,\"bank_swift_code\":null,\"account_number\":null,\"branch_name\":null,\"branch_address\":null,\"account_name\":null,\"iban\":null}'),
(56, 'enable_offline_payment', '1'),
(57, 'site_url', 'http://localhost/udify'),
(59, 'withdraw_methods', 'json_encode_value_{\"bank_transfer\":{\"enable\":\"1\",\"min_withdraw_amount\":\"100\",\"notes\":\"Please note that it takes approximately 2 to 7 days to process your withdraw via bank transfer. Sometimes it may take longer. If you do not receive withdrawal after 7 days, please contact our customer support. Updated\"},\"echeck\":{\"enable\":\"1\",\"min_withdraw_amount\":\"50\"},\"paypal\":{\"enable\":\"1\",\"min_withdraw_amount\":\"50\"}}'),
(60, 'lms_settings', 'json_encode_value_{\"enable_discussion\":\"1\"}'),
(62, 'active_plugins', '{\"3\":\"MultiInstructor\",\"4\":\"StudentsProgress\",\"5\":\"Certificate\",\"6\":\"LiveClass\",\"7\":\"Mollie\"}'),
(63, 'site_logo', '32'),
(64, 'terms_of_use_page', '7'),
(65, 'privacy_policy_page', '8'),
(66, 'about_us_page', '3'),
(67, 'cookie_alert', 'json_encode_value_{\"enable\":\"1\",\"message\":\"By using Udify you accept our cookies and agree to our privacy policy, including cookie policy. {privacy_policy_url}\"}'),
(68, 'social_login', 'json_encode_value_{\"facebook\":{\"enable\":\"1\",\"app_id\":\"292155035510814\",\"app_secret\":\"de1a21d48afe669dda21626fdf638832\"},\"google\":{\"enable\":\"1\",\"client_id\":\"586033023574-3m025n2jei2eldgdqf7ic2r7rh58oj86.apps.googleusercontent.com\",\"client_secret\":\"Pd6fUp5FFmXUt-M0Prdc2fFy\"},\"twitter\":{\"enable\":\"1\",\"consumer_key\":\"iXy8T2reBWP42aD60rXdtUf8R\",\"consumer_secret\":\"SEYSr2AFVaVfH56xPZerEZxBW7gGgZOE2CT8jdoq32BbuL7Zv3\"},\"linkedin\":{\"enable\":\"1\",\"client_id\":\"86iampeb7c62rw\",\"client_secret\":\"Gyb9naxKvOR6wM8i\"}}'),
(69, 'enable_rtl', '0'),
(70, 'certificate', 'json_encode_value_{\"authorise_name\":\"Natalia Doe\",\"company_name\":\"Udify\",\"signature_id\":\"35\"}'),
(71, 'liveclass', 'json_encode_value_{\"zoom_api_key\":\"X9Op5D9_S2eVbJCjs5beaQ\",\"secret_key\":\"0KlSVCtXujMcdVcrDG0wSD067yDezW37qGRn\"}'),
(72, 'amazon_key', NULL),
(73, 'amazon_key', 'AKIAJMADXZZTTEYFJCKA'),
(74, 'amazon_secret', NULL),
(75, 'amazon_secret', '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'),
(76, 'amazon_region', NULL),
(77, 'amazon_region', 'us-east-1'),
(78, 'bucket', NULL),
(79, 'bucket', 'udify'),
(80, 'enable_mollie', '1'),
(81, 'mollie_api_key', 'test_F5zUxSUVWgsanWG4SCnJKe7bb9R5VM');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `total_amount` decimal(8,2) DEFAULT NULL,
  `fees_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fees_amount` decimal(8,2) DEFAULT NULL,
  `fees_total` decimal(8,2) DEFAULT NULL,
  `fees_type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('initial','pending','onhold','success','failed','declined','dispute','expired') COLLATE utf8mb4_unicode_ci DEFAULT 'initial',
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_month` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_exp_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id_or_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local_transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_created` int(11) DEFAULT NULL,
  `bank_swift_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `email`, `user_id`, `amount`, `total_amount`, `fees_name`, `fees_amount`, `fees_total`, `fees_type`, `payment_method`, `status`, `currency`, `token_id`, `card_last4`, `card_id`, `card_brand`, `card_country`, `card_exp_month`, `card_exp_year`, `client_ip`, `charge_id_or_token`, `payer_email`, `description`, `local_transaction_id`, `payment_created`, `bank_swift_code`, `account_number`, `branch_name`, `branch_address`, `account_name`, `iban`, `payment_note`, `created_at`, `updated_at`) VALUES
(4, 'John Doe', 'admin@demo.com', 1, '119.00', '123.76', 'Payment gateway charge', '4.00', '4.76', 'percent', 'stripe', 'success', 'USD', NULL, '4242', 'card_1GfsE3IdV7MTb07Ggn3pvxMI', 'Visa', NULL, '4', '2022', NULL, 'ch_1GfsEJIdV7MTb07G4PGpO8HE', NULL, 'Udify\'s course enrolment', NULL, 1588790667, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-06 12:44:26', '2020-05-06 12:44:26'),
(5, 'John Doe', 'admin@demo.com', 1, '20.00', '20.80', 'Payment gateway charge', '4.00', '0.80', 'percent', 'stripe', 'success', 'USD', NULL, '4242', 'card_1GfsOaIdV7MTb07GnbWKEVox', 'Visa', NULL, '2', '2022', NULL, 'ch_1GfsOcIdV7MTb07GZ7LLGMRg', NULL, 'Udify\'s course enrolment', NULL, 1588791306, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-06 12:55:05', '2020-05-06 12:55:05'),
(6, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'pending', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1588800478YE3GOP', NULL, 'DIIEY', '2343245345', 'Rome street', 'rome, t445,ste', 'JOHN Doe', 'DBasdfa', NULL, '2020-05-06 15:27:58', '2020-05-06 15:27:58'),
(7, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'bank_transfer', 'pending', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_15888007995KW0RR', NULL, 'DIIEY', '2343245345', 'Rome street', 'rome, t445,ste', 'JOHN Doe', 'DBasdfa', NULL, '2020-05-06 15:33:19', '2020-05-06 15:33:19'),
(9, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1588852471ARPQFZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 05:54:31', '2020-05-07 05:54:31'),
(10, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1588852539XKNP6U', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 05:55:39', '2020-05-07 05:55:39'),
(11, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'declined', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_15888525905QM6KY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 05:56:30', '2020-05-07 14:58:53'),
(12, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1588854250YZE6LX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 06:24:10', '2020-05-07 06:24:10'),
(13, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1588854331CNFJGP', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 06:25:31', '2020-05-07 06:25:31'),
(14, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'failed', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_15888544901LFVM9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 06:28:10', '2020-05-07 09:13:15'),
(15, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'pending', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1588864802CEA5YY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 09:20:02', '2020-05-08 11:03:16'),
(16, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, NULL, NULL, NULL, NULL, 'paypal', 'pending', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_15888648907FXV57', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-07 09:21:30', '2020-05-08 11:03:16'),
(17, 'John Doe', 'admin@demo.com', 1, '102.96', NULL, 'Payment gateway charge', '4.00', '3.96', 'percent', 'offline', 'onhold', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1588869452HANIMB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'I will go to your office, and I will make cash payments over the cash counter.', '2020-05-07 10:37:32', '2020-05-07 14:55:32'),
(18, 'John Doe', 'admin@demo.com', 1, '99.00', '102.96', 'Payment gateway charge', '4.00', '3.96', 'percent', 'stripe', 'success', 'USD', NULL, '4242', 'card_1GgZ1oIdV7MTb07GklMGaWWL', 'Visa', NULL, '4', '2022', NULL, 'ch_1GgZ1pIdV7MTb07GAqMKXQxP', NULL, 'Udify\'s course enrolment', NULL, 1588955185, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-08 10:26:27', '2020-05-08 10:26:27'),
(19, 'Rosie T. Pena', 'RosieTPena@jourrapide.com', 2, '102.96', NULL, 'Payment gateway charge', '4.00', '3.96', 'percent', 'offline', 'success', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1589198931EY1TMA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'I will pay through bank directly', '2020-05-11 06:08:51', '2020-05-11 06:09:26'),
(20, 'Rosie T. Pena', 'RosieTPena@jourrapide.com', 2, '102.96', NULL, 'Payment gateway charge', '4.00', '3.96', 'percent', 'offline', 'success', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_15892026589EPI1Q', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'I will pay through bank account.', '2020-05-11 07:10:58', '2020-05-11 07:20:45'),
(21, 'Sean J. McAlister', 'SeanJMcAlister@dayrep.com', 3, '206.96', NULL, 'Payment gateway charge', '4.00', '7.96', 'percent', 'offline', 'success', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1589214995TGH9MQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Come to my office, I will pay directly with the card.', '2020-05-11 10:36:35', '2020-05-11 10:37:09'),
(22, 'Sean J. McAlister', 'SeanJMcAlister@dayrep.com', 3, '102.96', NULL, 'Payment gateway charge', '4.00', '3.96', 'percent', 'offline', 'success', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_158921532107FY5W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Payment will be sent your PayPal soon.', '2020-05-11 10:42:01', '2020-05-11 10:42:57'),
(23, 'Sean J. McAlister', 'student@demo.com', 3, '9.99', '10.39', 'Payment gateway charge', '4.00', '0.40', 'percent', 'stripe', 'success', 'USD', NULL, '4242', 'card_1GkYBqIdV7MTb07Gv9WKVSbS', 'Visa', NULL, '12', '2022', NULL, 'ch_1GkYCEIdV7MTb07G4UMEgGQb', NULL, 'Udify\'s course enrolment', NULL, 1589905298, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-19 16:21:42', '2020-05-19 16:21:42'),
(24, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483076FIFGKH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:31:16', '2020-08-03 19:31:16'),
(25, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_15964830941XLALB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:31:34', '2020-08-03 19:31:34'),
(26, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483103OER054', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:31:43', '2020-08-03 19:31:43'),
(27, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483116KHNDXB', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:31:56', '2020-08-03 19:31:56'),
(28, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483150EOZTQM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:32:30', '2020-08-03 19:32:30'),
(29, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483158HZROF9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:32:38', '2020-08-03 19:32:38'),
(30, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483173ICRD8G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:32:53', '2020-08-03 19:32:53'),
(31, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483180YLFELT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:33:00', '2020-08-03 19:33:00'),
(32, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483191OQIY6W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:33:11', '2020-08-03 19:33:11'),
(33, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483213VSIXL6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:33:33', '2020-08-03 19:33:33'),
(34, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483290PTWR1C', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:34:50', '2020-08-03 19:34:50'),
(35, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483586BFQSNN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:39:46', '2020-08-03 19:39:46'),
(36, 'Margaret B. Davis', 'admin@demo.com', 1, '30.16', NULL, 'Payment gateway charge', '4.00', '1.16', 'percent', 'mollie', 'initial', 'USD', 'tr_fFjtr3g63K', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TRAN_1596483782DH5PNQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-08-03 19:43:02', '2020-08-03 19:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_content` longtext COLLATE utf8mb4_unicode_ci,
  `feature_image` int(11) DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `slug`, `post_content`, `feature_image`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'How to boost your online course to maximum potential students?', 'how-to-boost-your-online-course-to-maximum-potential-students', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 22, 'post', '1', '2020-05-16 20:03:36', '2020-05-16 21:05:53'),
(3, 1, 'About us', 'about-us', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>', NULL, 'page', '1', '2020-05-16 20:57:56', '2020-05-16 21:05:38'),
(4, 1, 'Marketing functions and how to apply it to your courses', 'marketing-functions-and-how-to-apply-it-to-your-courses', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>', 23, 'post', '1', '2020-05-16 21:19:17', '2020-05-16 21:19:17'),
(5, 1, 'Why you should keep developing your skills at these days', 'why-you-should-keep-developing-your-skills-at-these-days', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n\r\n<p>&quot;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&quot;</p>\r\n\r\n<h3>Section 1.10.32 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', 24, 'post', '1', '2020-05-16 23:53:13', '2020-05-16 23:53:13'),
(6, 1, 'What is PHP OOP, your most unanswered common questions, let\'s discuss', 'what-is-php-oop-your-most-unanswered-common-questions-lets-discuss', '<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?&quot;</p>\r\n\r\n<h3>Section 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot;, written by Cicero in 45 BC</h3>\r\n\r\n<p>&quot;At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.&quot;</p>\r\n\r\n<h3>1914 translation by H. Rackham</h3>\r\n\r\n<p>&quot;On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.&quot;</p>', 25, 'post', '1', '2020-05-16 23:55:27', '2020-05-16 23:55:27'),
(7, 1, 'Terms of Use', 'terms-of-use', '<p><strong>1. Acknowledgment THE USE OF LOREM IPSUM TERMS AND CONDITIONS&nbsp;</strong></p>\r\n\r\n<p>Your entrance to and utilization of Lorem Ipsum (the application) is subject only to these Terms and Conditions. You won&#39;t utilize the application for any reason that is unlawful or disallowed by these Terms and Conditions. By utilizing the application you are completely tolerating the terms, conditions, and disclaimers contained in this notification. On the off chance that you don&#39;t acknowledge these Terms and Conditions you should promptly quit utilizing the application.&nbsp;</p>\r\n\r\n<p><strong>2. Charge card DETAILS&nbsp;</strong></p>\r\n\r\n<p>All Lorem Ipsum buys are overseen by the individual App Stores (Apple, Google Windows), and Lorem Ipsum will never store your charge card data or make it accessible to any outsiders. Any buying data gave will be given legitimately from you to the particular App Store and you will be dependent upon their Mastercard arrangements.&nbsp;</p>\r\n\r\n<p><strong>3. Lawful ADVICE&nbsp;</strong></p>\r\n\r\n<p>The substance of Lorem Ipsum application doesn&#39;t establish guidance and ought not to be depended upon in making or abstaining from settling on, any choice.&nbsp;</p>\r\n\r\n<p>All material contained on Lorem Ipsum is given with no or guarantee of any sort. You utilize the material on Lorem Ipsum at your own watchfulness&nbsp;</p>\r\n\r\n<p><strong>4. CHANGE OF USE&nbsp;</strong></p>\r\n\r\n<p>Lorem Ipsum maintains whatever authority is needed to:&nbsp;</p>\r\n\r\n<p>4.1 change or evacuate (briefly or for all time) the application or any piece of it without notice and you affirm that Lorem Ipsum will not be obligated to you for any such change or expulsion and.&nbsp;</p>\r\n\r\n<p>4.2 change these Terms and Conditions whenever, and you proceeded with utilization of the application following any progressions will be esteemed to be your acknowledgment of such change.&nbsp;</p>\r\n\r\n<p>5. Connections TO THIRD PARTY APPS AND WEBSITES&nbsp;</p>\r\n\r\n<p>Lorem Ipsum application may incorporate connects to outsider applications and sites that are controlled and kept up by others. Any connection to different applications and sites isn&#39;t an underwriting of such and you recognize and concur that we are not liable for the substance or accessibility of any such applications and sites.&nbsp;</p>\r\n\r\n<p><strong>6. COPYRIGHT&nbsp;</strong></p>\r\n\r\n<p>6.1 All copyright, exchange imprints, and all other protected innovation rights in the application and its substance (counting without confinement the application structure, content, designs and all product and source codes associated with the application) are possessed by or authorized to Lorem Ipsum or in any case utilized by Lorem Ipsum as allowed by law.&nbsp;</p>\r\n\r\n<p>6.2 In getting to the application you concur that you will get to the substance exclusively for your own, non-business use. None of the substances might be downloaded, replicated, duplicated, transmitted, put away, sold or disseminated without the earlier composed assent of the copyright holder. This prohibits the downloading, replicating, and additionally printing of pages of the application for individual, non-business home utilize as it were.&nbsp;</p>\r\n\r\n<p><strong>7. Connections TO AND FROM OTHER APPS AND WEBSITES&nbsp;</strong></p>\r\n\r\n<p>7.1 Throughout this application you may discover connections to outsider applications. The arrangement of a connection to such an application doesn&#39;t imply that we underwrite that application. In the event that you visit any application through a connection in this application you do as such at your own hazard.&nbsp;</p>\r\n\r\n<p>7.2 Any gathering wishing to connect to this application is qualified for doing so given that the conditions underneath are watched:&nbsp;</p>\r\n\r\n<p>(a) You don&#39;t look to infer that we are supporting the administrations or results of another gathering except if this has been concurred with us recorded as a hard copy;&nbsp;</p>\r\n\r\n<p>(b) You don&#39;t distort your relationship with this application; and&nbsp;</p>\r\n\r\n<p>(c) The application from which you connect to this application doesn&#39;t contain hostile or in any case dubious substance or, substance that encroaches any licensed innovation rights or different privileges of an outsider.&nbsp;</p>\r\n\r\n<p>7.3 By connecting to this application in break of our terms, you will repay us for any misfortune or harm endured to this application because of such connecting.&nbsp;</p>\r\n\r\n<p><strong>8. DISCLAIMERS AND LIMITATION OF LIABILITY&nbsp;</strong></p>\r\n\r\n<p>8.1 The application is given on an AS IS and AS AVAILABLE premise with no portrayal or underwriting made and without guarantee of any sort whether express or suggested, including however not restricted to the inferred guarantees of acceptable quality, readiness for a specific reason, non-encroachment, similarity, security and precision.&nbsp;</p>\r\n\r\n<p>8.2 To the degree allowed by law, Lorem Ipsum won&#39;t be subject for any circuitous or weighty misfortune or harm whatever (counting without constraint loss of business, opportunity, information, benefits) emerging out of or regarding the utilization of the application.&nbsp;</p>\r\n\r\n<p>8.3 Lorem Ipsum makes no guarantee that the usefulness of the application will be continuous or blunder free, that deformities will be remedied or that the application or the server that makes it accessible are liberated from infections or whatever else which might be hurtful or damaging.&nbsp;</p>\r\n\r\n<p>8.4 Nothing in these Terms and Conditions will be understood in order to reject or breaking point the obligation of Lorem Ipsum for death or individual injury because of the carelessness of Lorem Ipsum or that of its workers or specialists.&nbsp;</p>\r\n\r\n<p><strong>9. Repayment&nbsp;</strong></p>\r\n\r\n<p>You consent to repay and hold Lorem Ipsum and its representatives and specialists innocuous from and against all liabilities, lawful charges, harms, misfortunes, costs and different costs corresponding to any cases or activities brought against Lorem Ipsum emerging out of any break by you of these Terms and Conditions or different liabilities emerging out of your utilization of this application.&nbsp;</p>\r\n\r\n<p><strong>10. SEVERANCE&nbsp;</strong></p>\r\n\r\n<p>On the off chance that any of these Terms and Conditions ought to be resolved to be invalid, illicit or unenforceable in any capacity whatsoever by any court of skilled locale then such Term or Condition will be cut off and the rest of the Terms and Conditions will endure and stay in full power and impact and keep on being authoritative and enforceable.&nbsp;</p>\r\n\r\n<p><strong>11. WAIVER&nbsp;</strong></p>\r\n\r\n<p>In the event that you break these Conditions of Use and we make no move, we will in any case be qualified to utilize our privileges and cures in whatever other circumstance where you penetrate these Conditions of Use.&nbsp;</p>\r\n\r\n<p><strong>12. Administering LAW&nbsp;</strong></p>\r\n\r\n<p>These Terms and Conditions will be administered by and translated as per the law of and you, therefore, submit to the select purview of the courts.</p>', NULL, 'page', '1', '2020-05-23 09:29:53', '2020-05-23 09:29:53'),
(8, 1, 'Privacy Policy', 'privacy-policy', '<p><strong>What data do we gather?&nbsp;</strong></p>\r\n\r\n<p>We gather data from you when you react to an overview.&nbsp;</p>\r\n\r\n<p>Google, as an outsider seller, utilizes treats to serve promotions on your site. Google&#39;s utilization of the DART treat empowers it to serve promotions to your clients dependent on their visit to your locales and different destinations on the Internet. Clients may quit the utilization of the DART treat by visiting the Google advertisement and substance organize security arrangement..&nbsp;</p>\r\n\r\n<p><strong>What do we utilize your data for?&nbsp;</strong></p>\r\n\r\n<p>Any of the data we gather from you might be utilized in one of the accompanying ways:&nbsp;</p>\r\n\r\n<p>To improve our site&nbsp;</p>\r\n\r\n<p>(we constantly endeavor to improve our site contributions dependent on the data and criticism we get from you)&nbsp;</p>\r\n\r\n<p><strong>Do we use treats?&nbsp;</strong></p>\r\n\r\n<p>Truly (Cookies are little documents that a website or its specialist organization moves to your PCs hard drive through your Web program (on the off chance that you permit) that empowers the destinations or specialist co-ops frameworks to perceive your program and catch and recollect certain data&nbsp;</p>\r\n\r\n<p>We use treats to arrange total information about site traffic and site communication so we can offer better site encounters and instruments later on. We may contract with outsider specialist co-ops to help us in better understanding our site guests. These specialist organizations are not allowed to utilize the data gathered for our sake but to assist us with directing and improve our business.&nbsp;</p>\r\n\r\n<p><strong>Do we unveil any data to outside gatherings?&nbsp;</strong></p>\r\n\r\n<p>We don&#39;t sell, exchange, or in any case move to outside gatherings your by and by recognizable data. This does exclude confided in outsiders who help us in working our site, directing our business, or overhauling you, inasmuch as those gatherings consent to keep this data classified. We may likewise discharge your data when we accept discharge is fitting to consent to the law, implement our site strategies, or ensure our own or others rights, property, or wellbeing. Be that as it may, non-by and by recognizable guest data might be given to different gatherings to promoting, publicizing, or different employments.&nbsp;</p>\r\n\r\n<p><strong>Outsider connections&nbsp;</strong></p>\r\n\r\n<p>Sporadically, at our carefulness, we may incorporate or offer outsider items or administrations on our site. These outsider locales have isolated and free protection approaches. We in this way have no duty or obligation for the substance and exercises of these connected locales. In any case, we try to secure the respectability of our site and welcome any input about these destinations.&nbsp;</p>\r\n\r\n<p><strong>California Online Privacy Protection Act Compliance&nbsp;</strong></p>\r\n\r\n<p>Since we esteem your security we have played it safe to be in consistence with the California Online Privacy Protection Act. We in this way won&#39;t disperse your own data to outside gatherings without your assent.&nbsp;</p>\r\n\r\n<p><strong>Childrens Online Privacy Protection Act Compliance&nbsp;</strong></p>\r\n\r\n<p>We are in consistence with the prerequisites of COPPA (Childrens Online Privacy Protection Act), we don&#39;t gather any data from anybody under 13 years old. Our site, items and administrations are totally coordinated to individuals who are in any event 13 years of age or more seasoned.&nbsp;</p>\r\n\r\n<p><strong>Online Privacy Policy Only&nbsp;</strong></p>\r\n\r\n<p>This online security strategy applies just to data gathered through our site and not to data gathered disconnected.&nbsp;</p>\r\n\r\n<p><strong>Terms and Conditions&nbsp;</strong></p>\r\n\r\n<p>If it&#39;s not too much trouble likewise visit our Terms and Conditions segment building up the utilization, disclaimers, and confinements of obligation overseeing the utilization of our site at terms and conditions.&nbsp;</p>\r\n\r\n<p><strong>Your Consent&nbsp;</strong></p>\r\n\r\n<p>By utilizing our site, you agree to our security strategy.&nbsp;</p>\r\n\r\n<p><strong>Changes to our Privacy Policy&nbsp;</strong></p>\r\n\r\n<p>On the off chance that we choose to change our protection approach, we will post those progressions on this page, or potentially update the Privacy Policy alteration date beneath.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', NULL, 'page', '1', '2020-05-23 09:55:51', '2020-05-23 09:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` decimal(5,1) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_id`, `quiz_id`, `title`, `image_id`, `type`, `score`, `sort_order`) VALUES
(2, 5, 40, 'What is the name of this mysterious painting?', 28, 'radio', '2.0', 3),
(3, 5, 40, 'Which modern American Icon turned his sketches into an animated and theme park empire?', 29, 'radio', '2.0', 1),
(4, 5, 40, 'Who made a series of paintings of water lilies?', NULL, 'radio', '3.0', 2),
(7, 5, 40, 'Write the name who painted, \"The Starry Night\"?', 30, 'text', '5.0', 6),
(8, 5, 40, 'After Lock Down, what you will do first?', NULL, 'checkbox', '3.0', 7),
(9, 5, 40, 'What is the name of first industry?', NULL, 'text', '2.0', 8),
(10, 5, 40, 'Explain about the corona virus (COVID19)', 31, 'textarea', '10.0', 9),
(11, 5, 39, 'Who made the first CGI movie?', 33, 'checkbox', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

DROP TABLE IF EXISTS `question_options`;
CREATE TABLE `question_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `d_pref` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'text',
  `is_correct` tinyint(4) DEFAULT '0',
  `sort_order` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `title`, `image_id`, `d_pref`, `is_correct`, `sort_order`) VALUES
(1, 2, 'Merinda Lisa', NULL, 'text', 0, 2),
(2, 2, 'Lisa Lisa', NULL, 'text', 0, 3),
(3, 2, 'Miara Lisa', NULL, 'text', 0, 4),
(4, 2, 'Monalisa', NULL, 'text', 1, 1),
(5, 3, 'Walt Disney', NULL, 'text', 1, 1),
(6, 3, 'Roy Disney', NULL, 'text', 0, 2),
(7, 3, 'Andru Disney', NULL, 'text', 0, 3),
(8, 3, 'No Disney', NULL, 'text', 0, 4),
(9, 4, 'Bruce Wayne', NULL, 'text', 1, 1),
(10, 4, 'Klark Kent', NULL, 'text', 0, 2),
(11, 4, 'Walt Karret', NULL, 'text', 0, 3),
(12, 4, 'Diana', NULL, 'text', 0, 4),
(14, 8, 'Get a Job', NULL, 'text', 1, 1),
(15, 8, 'I will get a pet', NULL, 'text', 0, 2),
(16, 8, 'Nothing', NULL, 'text', 0, 3),
(17, 8, 'Will fall in love', NULL, 'text', 1, 4),
(18, 11, 'christopher nolan', NULL, 'text', 1, 1),
(19, 11, 'Jonathan Nolan', NULL, 'text', 0, 2),
(20, 11, 'Ema Nolan', NULL, 'text', 0, 3),
(21, 11, 'Hardy Nolan', NULL, 'text', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `review_id` int(11) DEFAULT '0',
  `review` text COLLATE utf8mb4_unicode_ci,
  `rating` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `course_id`, `review_id`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 'Extremely succinct course to be acquainted with insights. This truly assists with understanding the nuts and bolts and underscore to go further. A genuine decent hands-on for amateurs that need to comprehend measurements in a clever yet clear manner. I suggest.', 4, 1, '2020-05-10 13:45:00', '2020-05-11 04:53:34'),
(3, 2, 1, 0, 'The astonishing course, yet by the end, it leaves a feeling of deficiency that there ought to be all the more perusing and handy material additionally a few recordings could be progressively logical.', 5, 1, '2020-05-11 06:10:51', '2020-05-11 06:10:51'),
(4, 3, 8, 0, 'The astonishing course, yet by the end, it leaves a feeling of deficiency that there ought to be all the more perusing and handy material additionally a few recordings could be progressively logical. \r\n\r\nSome lacks on her voice. need an improvement', 3, 1, '2020-05-11 10:40:06', '2020-05-11 10:40:11'),
(5, 3, 1, 0, 'As a non-experienced in advanced showcasing, I adored taking this course and seeing all the key parts of each computerized stage/instrument. The educator is truly clear and clarifies effectively, setting aside the effort to truly share what he encountered, which is vital to make this course stand apart versus others. \r\n\r\nI would take it again and I will get back here each time I have an uncertainty since I\'m certain I\'ll locate the correct data.', 5, 1, '2020-05-11 10:45:11', '2020-05-11 10:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `section_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unlock_date` timestamp NULL DEFAULT NULL,
  `unlock_days` tinyint(4) DEFAULT NULL,
  `sort_order` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `course_id`, `section_name`, `unlock_date`, `unlock_days`, `sort_order`) VALUES
(1, 1, 'Introduction', NULL, NULL, 0),
(2, 1, 'Data Type and Variable', NULL, NULL, 1),
(4, 3, 'Introduction', NULL, NULL, 0),
(6, 5, 'Anotehr Intr', NULL, NULL, 0),
(7, 8, 'Introduction in Python', NULL, NULL, 0),
(8, 9, 'Skincare Overview', NULL, NULL, 0),
(9, 10, 'Getting started', NULL, NULL, 0),
(10, 10, 'Debugging', NULL, NULL, 0),
(11, 11, 'Getting started with drawing', NULL, NULL, 0),
(12, 11, 'Draw a realistic eye with animation', NULL, NULL, 0),
(13, 12, 'Fundamentals of Cloud Computing Platform', NULL, NULL, 0),
(14, 12, 'Understanding Core AWS Services', NULL, NULL, 0),
(15, 12, 'Billing & Support Services', NULL, NULL, 0),
(16, 12, 'Security Aspect', NULL, NULL, 0),
(17, 12, 'Exam Preparation', NULL, NULL, 0),
(18, 13, 'Introduction to the Essential Skills', NULL, NULL, 0),
(19, 13, 'Responsibilities: Communication, Boundaries and Delegation', NULL, NULL, 0),
(20, 13, 'Developing Employee Skills', NULL, NULL, 0),
(21, 13, 'Motivating Your Team Members', NULL, NULL, 0),
(22, 3, 'Deep in dive', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `photo` int(11) DEFAULT NULL,
  `job_title` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `options` text COLLATE utf8mb4_unicode_ci,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` tinyint(4) DEFAULT '0',
  `provider_user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `gender`, `company_name`, `country_id`, `address`, `address_2`, `city`, `zip_code`, `postcode`, `website`, `phone`, `date_of_birth`, `photo`, `job_title`, `about_me`, `options`, `user_type`, `active_status`, `provider_user_id`, `provider`, `remember_token`, `reset_token`, `created_at`, `updated_at`) VALUES
(1, 'Margaret B. Davis', 'admin@demo.com', NULL, '$2y$10$052gJj2HaeEROwsPm8itO.lWexeqZYvfxwo0ugBIVR6IFV0MMAAoq', 'male', NULL, 240, '4379 Hiddenview Drive', 'Philadelphia', 'PA', '19103', NULL, NULL, '215-935-3877', NULL, 14, 'Team Leader | AWS Certified Solutions Architect & Certified Developer | NodeJS Developer', 'Hey, my name\'s Margaret B. Davis. I am the originator of Great Courses Place, an exceptionally experienced AWS Cloud Arrangements Designer and an effective IT teacher. I\'ve been working in IT for more than 20 years in an assortment of jobs going from help to design. In the course of the most recent 15 years, I have primarily filled in as an Arrangements Engineer in the frameworks incorporation space structuring answers for big business associations. \r\n\r\nMy involvement with IT has included working with virtualization and distributed computing since it\'s initiation. In my latest counseling job I filled in as an Endeavor Engineer structuring Half breed IT and Advanced Change arrangements. \r\n\r\nI have consistently appreciated gaining IT affirmations and they have helped me massively with moving upwards all through my profession. Nowadays, my enthusiasm is to help other people to accomplish their vocation objectives through top to bottom AWS affirmation preparing assets. \r\n\r\nThat is the reason I began digitalcloud.training - to give affirmation preparing assets to Amazon Web Administrations (AWS) accreditations that speak to a greater standard than is in any case accessible in the market.', '{\"social\":{\"website\":\"#\",\"twitter\":\"#\",\"facebook\":\"#\",\"linkedin\":\"#\",\"youtube\":\"#\",\"instagram\":\"#\"},\"enrolled_courses\":[1],\"wishlists\":[3,8,9,10],\"withdraw_preference\":{\"method\":\"bank_transfer\",\"bank_transfer\":{\"account_name\":\"Margaret B. Davis\",\"account_number\":\"5456657684534\",\"bank_name\":\"New York Bank LTD.\",\"iban\":\"NUSABL\",\"swift\":\"NYESWTI\"},\"echeck\":{\"physical_address\":\"439 Riverside Drive\\r\\nAtlanta, GA 30346\"},\"paypal\":{\"paypal_email\":\"john@doe.com\"}},\"completed_courses\":{\"1\":{\"percent\":45,\"content_ids\":[9,15]}}}', 'admin', 1, NULL, NULL, NULL, 'R3yMaFRq0Bjn9T0l2XBqhDM1RRhfAn0L', NULL, '2020-08-03 19:43:02'),
(2, 'Rosie T. Pena', 'RosieTPena@jourrapide.com', NULL, '$2y$10$JJGpZLlr0UuQI36.vgGvi.8FL8sL/Vzj1AFosPVNIc3XzsVhxYR7W', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '{\"enrolled_courses\":[1]}', 'student', 1, NULL, NULL, NULL, NULL, '2020-05-11 06:08:06', '2020-05-13 17:24:23'),
(3, 'Sean J. McAlister', 'student@demo.com', NULL, '$2y$10$GkbJVywowvG6ZKKWBkYw3uHLR/CQ4tgPL10mA3ODMAYGcnNS.Cf5a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, NULL, NULL, '{\"enrolled_courses\":[8,1,11],\"social\":{\"website\":null,\"twitter\":null,\"facebook\":null,\"linkedin\":null,\"youtube\":null,\"instagram\":null},\"completed_courses\":{\"1\":{\"percent\":45,\"content_ids\":[5,6,9,14,17]},\"8\":{\"percent\":100,\"content_ids\":[24]},\"11\":{\"percent\":43,\"content_ids\":[35,40]}}}', 'student', 1, NULL, NULL, NULL, NULL, '2020-05-11 10:35:27', '2020-06-14 06:38:13'),
(4, 'Wade C. Nelson', 'wade@nelson.com', NULL, '$2y$10$Q8bppapKttEP7kAy2fOHqObimT0MmTWQ8iDs7Np2ZMGQn8dIcQtLK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'instructor', 1, NULL, NULL, NULL, NULL, '2020-05-11 14:53:45', '2020-05-26 23:20:51'),
(5, 'Bessie M. Artz', 'instructor@demo.com', NULL, '$2y$10$5/I0t8FMJjEnZggO3OOqTOLkcuopWm/.BeNVKHt3e4NU8MIvzmfAW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Best Selling Instructor, Author & Leadership Coach', 'I\'m currently showing in excess of eighty thousand understudies in excess of 170 nations on Udemy, is the writer of eleven books, and has forty years of experience talking with significant partnerships. A few of his seminars on the executives and authority are top of the line courses in their classification and have been embraced by significant organizations as a major aspect of their initiative turn of events and lean culture implementaton process. \r\n\r\nFor as long as forty years he has attempted to improve the presentation of associations and the abilities of their pioneers. His aptitude is gotten from hands on experience making change in the way of life of several associations. \r\n\r\nHe started his work in youth detainment facilities in the wake of perceiving that the learning framework in the association had precisely something contrary to its expected impact – expanding, instead of diminishing, broken conduct. For a long time he attempted to update the jail framework by building up the primary free-economy behind jail dividers, where every detainee needed to pay lease, keep up a financial records, and pay for all that he wanted. This was his first hierarchical change. \r\n\r\nHe has been counseling, composing and talking about business association and culture since 1973. Following ten years with another counseling firm, he shaped his own firm, the Miller Howard Consulting Group in 1983. In 1998 he offered his firm to Towers Perrin, a global human asset counseling firm and turned into a Principal of that firm. In 1999 he left that firm to concentrate on solo counseling ventures. \r\n\r\nHe and his firm were one of the early defenders of group based administration and worked with numerous customers to actualize Team Management from the senior official group to remember each level and each worker for the association. The Team Management process made an organization of business administrators, with each worker concentrated on consistent improvement of business execution. Notwithstanding coordinating the general change process, Mr. Mill operator by and by instructed the senior supervisory group of a significant number of his customers. \r\n\r\nThe usage of Team Management prompted the acknowledgment that the entire arrangement of the association should have been upgraded to make arrangement so all frameworks, structure, abilities, style and images bolster similar objectives and culture. From this acknowledgment he built up the procedure of Whole System Architecture that is a high inclusion technique for reexamining the entirety of the frameworks, structures and culture of the association. Among his counseling customers have been 3M, Corning, Shell Oil Company, Amoco and Texaco, Shell Chemicals, Air Canada and Varig Airlines, Eastman Chemicals, Xerox, Harris Corporation, McDonald\'s and Chick-fil-A, Merck and Upjohn Pharmaceuticals, United Technologies, Metropolitan Life and Landmark Communications.', '{\"social\":{\"website\":null,\"twitter\":null,\"facebook\":null,\"linkedin\":null,\"youtube\":null,\"instagram\":null},\"withdraw_preference\":{\"method\":\"paypal\",\"bank_transfer\":{\"account_name\":null,\"account_number\":null,\"bank_name\":null,\"iban\":null,\"swift\":null},\"echeck\":{\"physical_address\":null},\"paypal\":{\"paypal_email\":\"john@doe.com\"}}}', 'instructor', 1, NULL, NULL, NULL, NULL, '2020-05-12 08:51:31', '2020-06-04 20:40:09'),
(6, 'Arnold J. Kim', 'ArnoldJKim@teleworm.us', NULL, '$2y$10$rEMMIHE9M9.OG/jGX/Oer./cFMtrJbA09J7tJhcNNkvw2FznS3XNK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, 'Professional Web Developer | Instructor', 'Experience as (Web) Developer \r\n\r\nBeginning at 13 years old I learned constantly new programming abilities and dialects. Early I began making sites for companions and for no particular reason too. Other than web improvement I likewise investigated Python and other non-web-just dialects. This enthusiasm has since kept going and lead to my choice of filling in as an independent web designer and advisor. The achievement and fun I have in this activity is huge and truly keeps that energy burningly alive. \r\n\r\nBeginning web improvement on the backend (PHP with Laravel, NodeJS, Python) I likewise turned out to be increasingly more of a frontend designer utilizing present day systems like React, Angular or VueJS 2 out of a great deal of activities. I love the two universes these days! \r\n\r\nAs a self-trained designer I got the opportunity to expand my perspective by examining Business Administration where I hold a Master\'s certificate. That empowered me to work in a significant system consultancy just as a bank. While realizing, that I appreciate advancement m', '{\"social\":{\"website\":\"#\",\"twitter\":\"#\",\"facebook\":\"#\",\"linkedin\":\"#\",\"youtube\":\"#\",\"instagram\":\"#\"}}', 'instructor', 1, NULL, NULL, NULL, NULL, '2020-05-12 08:56:30', '2020-05-26 23:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `course_id`, `user_id`) VALUES
(1, 3, 1),
(3, 8, 1),
(4, 9, 1),
(5, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

DROP TABLE IF EXISTS `withdraws`;
CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(16,2) DEFAULT NULL,
  `method_data` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `user_id`, `amount`, `method_data`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '100.00', '{\"method_name\":\"Bank Transfer\",\"desc\":\"Get your payment directly into your bank account\",\"admin_form_fields\":{\"enable\":\"1\",\"min_withdraw_amount\":\"100\",\"notes\":\"Please note that it takes approximately 2 to 7 days to process your withdraw via bank transfer. Sometimes it may take longer. If you do not receive withdrawal after 7 days, please contact our customer support. Updated\"},\"form_fields\":{\"account_name\":{\"type\":\"text\",\"label\":\"Account Name\",\"value\":\"Margaret B. Davis\"},\"account_number\":{\"type\":\"text\",\"label\":\"Account Number\",\"value\":\"5456657684534\"},\"bank_name\":{\"type\":\"text\",\"label\":\"Bank Name\",\"value\":\"New York Bank LTD.\"},\"iban\":{\"type\":\"text\",\"label\":\"IBAN\",\"value\":\"NUSABL\"},\"swift\":{\"type\":\"text\",\"label\":\"BIC \\/ SWIFT\",\"value\":\"NYESWTI\"}},\"method_key\":\"bank_transfer\"}', 'Withdraw to my bank account', 'rejected', '2020-05-15 15:36:33', '2020-05-15 20:21:53'),
(4, 1, '50.00', '{\"method_name\":\"E-Check\",\"form_fields\":{\"physical_address\":{\"type\":\"textarea\",\"label\":\"Your Physical Address\",\"desc\":\"We will send you an E-Check to this address directly.\",\"value\":\"439 Riverside Drive\\r\\nAtlanta, GA 30346\"}},\"method_key\":\"echeck\",\"admin_form_fields\":{\"enable\":\"1\",\"min_withdraw_amount\":\"50\"}}', 'Pay my E-Check as soon as possible', 'pending', '2020-05-15 17:23:04', '2020-05-15 17:23:04'),
(5, 1, '70.00', '{\"method_name\":\"PayPal\",\"form_fields\":{\"paypal_email\":{\"type\":\"email\",\"label\":\"PayPal E-Mail Address\",\"desc\":\"Your earning will be send to this PayPal Account\",\"value\":\"john@doe.com\"}},\"method_key\":\"paypal\",\"admin_form_fields\":{\"enable\":\"1\",\"min_withdraw_amount\":\"50\"}}', 'Send to my PayPal', 'approved', '2020-05-15 20:29:25', '2020-05-15 20:29:49'),
(6, 1, '300.00', '{\"method_name\":\"Bank Transfer\",\"desc\":\"Get your payment directly into your bank account\",\"admin_form_fields\":{\"enable\":\"1\",\"min_withdraw_amount\":\"100\",\"notes\":\"Please note that it takes approximately 2 to 7 days to process your withdraw via bank transfer. Sometimes it may take longer. If you do not receive withdrawal after 7 days, please contact our customer support. Updated\"},\"form_fields\":{\"account_name\":{\"type\":\"text\",\"label\":\"Account Name\",\"value\":\"Margaret B. Davis\"},\"account_number\":{\"type\":\"text\",\"label\":\"Account Number\",\"value\":\"5456657684534\"},\"bank_name\":{\"type\":\"text\",\"label\":\"Bank Name\",\"value\":\"New York Bank LTD.\"},\"iban\":{\"type\":\"text\",\"label\":\"IBAN\",\"value\":\"NUSABL\"},\"swift\":{\"type\":\"text\",\"label\":\"BIC \\/ SWIFT\",\"value\":\"NYESWTI\"}},\"method_key\":\"bank_transfer\"}', 'To My Bank Account, for personal expense.', 'approved', '2020-05-15 20:30:31', '2020-05-15 20:30:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completes`
--
ALTER TABLE `completes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_user`
--
ALTER TABLE `course_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `assignment_submissions`
--
ALTER TABLE `assignment_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1160;

--
-- AUTO_INCREMENT for table `completes`
--
ALTER TABLE `completes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `course_user`
--
ALTER TABLE `course_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
