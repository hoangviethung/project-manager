-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 06:18 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gazebo`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `leader` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leader` (`leader`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `group`
--

TRUNCATE TABLE `group`;
--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`, `description`, `leader`, `is_active`, `last_update`) VALUES
(1, 'Nhóm 1', NULL, 1, 1, '2020-04-08 10:06:09'),
(2, 'Nhóm 1', NULL, 1, 1, '2020-04-08 10:07:12'),
(3, 'Nhóm 3', NULL, 1, 1, '2020-04-08 10:09:55'),
(4, 'Nhóm 4', NULL, 1, 1, '2020-04-08 10:11:39'),
(5, '', NULL, 1, 1, '2020-04-08 10:30:49'),
(6, 'Nhóm 5', NULL, 1, 1, '2020-04-08 10:39:20'),
(7, 'Nhóm 6', NULL, 1, 1, '2020-04-08 10:41:59'),
(8, 'nhóm 7', NULL, 1, 1, '2020-04-08 10:42:41'),
(9, 'nhóm 8', NULL, 1, 1, '2020-04-08 10:42:50'),
(10, 'Nhóm 9', NULL, 1, 1, '2020-04-08 10:43:08'),
(11, 'Nhóm 10', NULL, 1, 1, '2020-04-08 10:43:58'),
(12, 'nhóm 11', NULL, 1, 1, '2020-04-08 10:44:52'),
(13, 'Nhóm 12', NULL, 1, 1, '2020-04-08 10:50:55'),
(14, 'Nhóm 13', NULL, 1, 1, '2020-04-11 09:15:58'),
(15, 'nhóm 14', NULL, 1, 1, '2020-04-10 22:43:36'),
(16, 'Nhóm 15', NULL, 2, 1, '2020-04-08 11:31:28'),
(17, 'Nhóm 16', NULL, 2, 1, '2020-04-08 11:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `group_announcement`
--

DROP TABLE IF EXISTS `group_announcement`;
CREATE TABLE IF NOT EXISTS `group_announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `group_id` (`group_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `group_announcement`
--

TRUNCATE TABLE `group_announcement`;
--
-- Dumping data for table `group_announcement`
--

INSERT INTO `group_announcement` (`id`, `title`, `description`, `created_by`, `created_at`, `is_active`, `group_id`) VALUES
(1, 'Test Thông báo 1', 'Thông báo 1 nhóm 14', 1, '2020-04-10 22:35:35', 1, 15),
(4, 'Thông báo 2', 'Ngày 11/04 nộp GD3.\nTất cả chú ý.', 1, '2020-04-10 22:43:36', 1, 15),
(5, 'Thông báo nhóm 13', 'Test thông báo cho nhóm 13.\nTest xuống hàng.\n- Test Thêm ', 1, '2020-04-10 22:47:49', 1, 14),
(6, 'Thông báo 2 nhóm 13', 'Test thông báo.<br> test xuống hàng<br>xuống hàng 2', 1, '2020-04-10 22:48:49', 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `group_detail`
--

DROP TABLE IF EXISTS `group_detail`;
CREATE TABLE IF NOT EXISTS `group_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_lead` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `is_confirmed` int(11) NOT NULL DEFAULT '0',
  `token` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date_confirmed` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `is_lead` (`is_lead`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `group_detail`
--

TRUNCATE TABLE `group_detail`;
--
-- Dumping data for table `group_detail`
--

INSERT INTO `group_detail` (`id`, `group_id`, `user_id`, `is_lead`, `date_added`, `is_confirmed`, `token`, `date_confirmed`) VALUES
(1, 1, 1, 1, '2020-04-08 10:06:09', 1, '0', '2020-04-08 10:06:09'),
(2, 2, 1, 1, '2020-04-08 10:07:12', 1, '0', '2020-04-08 10:07:12'),
(3, 3, 1, 1, '2020-04-08 10:09:55', 1, '0', '2020-04-08 10:09:55'),
(4, 4, 1, 1, '2020-04-08 10:11:39', 1, '0', '2020-04-08 10:11:39'),
(5, 5, 1, 1, '2020-04-08 10:30:49', 1, '0', '2020-04-08 10:30:49'),
(6, 6, 1, 1, '2020-04-08 10:39:20', 1, '0', '2020-04-08 10:39:20'),
(7, 7, 1, 1, '2020-04-08 10:41:59', 1, '0', '2020-04-08 10:41:59'),
(8, 8, 1, 1, '2020-04-08 10:42:41', 1, '0', '2020-04-08 10:42:41'),
(9, 9, 1, 1, '2020-04-08 10:42:50', 1, '0', '2020-04-08 10:42:50'),
(10, 10, 1, 1, '2020-04-08 10:43:08', 1, '0', '2020-04-08 10:43:08'),
(11, 11, 1, 1, '2020-04-08 10:43:58', 1, '0', '2020-04-08 10:43:58'),
(12, 12, 1, 1, '2020-04-08 10:44:52', 1, '0', '2020-04-08 10:44:52'),
(13, 13, 1, 1, '2020-04-08 10:50:55', 1, '0', '2020-04-08 10:50:55'),
(14, 14, 1, 1, '2020-04-08 11:11:03', 1, '0', '2020-04-08 11:11:03'),
(15, 15, 1, 1, '2020-04-08 11:11:10', 1, '0', '2020-04-08 11:11:10'),
(16, 16, 1, 0, '2020-04-08 11:31:28', 1, '0', '2020-04-08 11:31:28'),
(17, 17, 1, 0, '2020-04-08 11:31:42', 1, '0', '2020-04-08 11:31:42'),
(18, 15, 2, 0, '2020-04-08 11:31:42', 1, '', '2020-04-08 11:31:42'),
(19, 15, 6, 0, '2020-04-09 16:03:19', 1, '0Ag4dr7vLTPdamA3R0hxMxcM1Pwfgm', NULL),
(20, 15, 10, 0, '2020-04-09 17:09:36', 1, 'A75N6IYRbTlw0rZGTLNFAC0Bk8yzgY', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `leader` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `project`
--

TRUNCATE TABLE `project`;
--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `created_at`, `created_by`, `is_active`, `group_id`, `description`, `leader`, `last_update`) VALUES
(1, 'Project 1', '2020-04-09 11:24:08', 1, 0, 15, NULL, 1, '2020-04-09 11:24:08'),
(2, 'Project 1', '2020-04-09 11:24:23', 1, 0, 15, NULL, 1, '2020-04-09 11:24:23'),
(3, 'Project 1', '2020-04-09 11:25:08', 1, 0, 15, NULL, 1, '2020-04-09 11:25:08'),
(4, 'Project 2', '2020-04-09 11:26:12', 1, 1, 15, NULL, 1, '2020-04-09 17:05:41'),
(5, 'Project 3', '2020-04-09 11:37:36', 1, 1, 15, NULL, 1, '2020-04-10 08:37:57'),
(6, 'project 4', '2020-04-09 14:25:08', 1, 1, 15, 'project 4 test', 1, '2020-04-10 12:24:42'),
(7, 'Project 1 group 13', '2020-04-11 09:15:58', 1, 1, 14, 'Test peoject 1 group 13', 1, '2020-04-11 10:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_detail`
--

DROP TABLE IF EXISTS `project_detail`;
CREATE TABLE IF NOT EXISTS `project_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_lead` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `project_detail`
--

TRUNCATE TABLE `project_detail`;
--
-- Dumping data for table `project_detail`
--

INSERT INTO `project_detail` (`id`, `project_id`, `user_id`, `is_lead`, `date_added`) VALUES
(1, 3, 1, 1, '2020-04-09 11:25:08'),
(3, 5, 1, 1, '2020-04-09 11:37:36'),
(23, 5, 1, 1, '2020-04-09 11:25:08'),
(24, 4, 1, 1, '2020-04-09 11:25:08'),
(25, 6, 1, 1, '2020-04-09 11:25:08'),
(26, 5, 2, 0, '2020-04-10 08:36:56'),
(27, 5, 6, 0, '2020-04-10 08:37:57'),
(28, 6, 2, 0, '2020-04-10 09:17:17'),
(29, 6, 6, 0, '2020-04-10 09:17:17'),
(30, 7, 1, 1, '2020-04-11 09:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `project_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` datetime DEFAULT NULL,
  `assigner` int(11) NOT NULL,
  `assignee` int(11) NOT NULL,
  `report_to` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `project_id` (`project_id`),
  KEY `assigner` (`assigner`),
  KEY `assignee` (`assignee`),
  KEY `report_to` (`report_to`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `task`
--

TRUNCATE TABLE `task`;
--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `status`, `project_id`, `description`, `created_at`, `last_update`, `assigner`, `assignee`, `report_to`, `category_id`, `is_active`) VALUES
(6, 'Task 1 P4', 1, 6, 'test task 1 project 4', '2020-04-10 04:16:53', '2020-04-13 09:10:07', 1, 1, 1, 0, 1),
(7, 'Task 2 P4', 0, 6, 'test task 2 project 4', '2020-04-10 05:24:42', '2020-04-10 12:24:42', 1, 0, 1, 0, 1),
(8, 'Task 1 project 1 group 13', 0, 7, 'test Task 1 project 1 group 13', '2020-04-11 02:17:49', '2020-04-11 09:17:49', 1, 0, 1, 0, 1),
(9, 'Task 2 P13', 1, 7, '', '2020-04-11 03:16:00', '2020-04-12 12:40:41', 1, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_category`
--

DROP TABLE IF EXISTS `task_category`;
CREATE TABLE IF NOT EXISTS `task_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `task_category`
--

TRUNCATE TABLE `task_category`;
-- --------------------------------------------------------

--
-- Table structure for table `task_category_group`
--

DROP TABLE IF EXISTS `task_category_group`;
CREATE TABLE IF NOT EXISTS `task_category_group` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `project_id` (`project_id`),
  KEY `project_id_2` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `task_category_group`
--

TRUNCATE TABLE `task_category_group`;
-- --------------------------------------------------------

--
-- Table structure for table `task_comment`
--

DROP TABLE IF EXISTS `task_comment`;
CREATE TABLE IF NOT EXISTS `task_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_edited` int(11) NOT NULL,
  `original_comment` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `task_comment`
--

TRUNCATE TABLE `task_comment`;
--
-- Dumping data for table `task_comment`
--

INSERT INTO `task_comment` (`id`, `description`, `created_by`, `task_id`, `created_at`, `is_active`, `is_edited`, `original_comment`) VALUES
(2, '<p>Test Comment 1</p>\r\n', 1, 6, '2020-04-13 08:29:33', 1, 0, NULL),
(3, '<p>Comment 2</p>\r\n', 1, 6, '2020-04-13 08:29:49', 1, 0, NULL),
(4, '<p>Comment 3</p>\r\n', 1, 6, '2020-04-13 08:36:03', 1, 0, NULL),
(5, '', 1, 6, '2020-04-13 08:37:16', 1, 0, NULL),
(6, '', 1, 6, '2020-04-13 09:06:48', 1, 0, NULL),
(7, '', 1, 6, '2020-04-13 09:09:35', 1, 0, NULL),
(8, '', 1, 6, '2020-04-13 09:10:06', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_comment_file`
--

DROP TABLE IF EXISTS `task_comment_file`;
CREATE TABLE IF NOT EXISTS `task_comment_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `task_comment_file`
--

TRUNCATE TABLE `task_comment_file`;
--
-- Dumping data for table `task_comment_file`
--

INSERT INTO `task_comment_file` (`id`, `file`, `comment_id`) VALUES
(1, '', 2),
(2, '1586941802_22007454_1788114924562817_5132896168709656978_n.jpg', 3),
(3, '1586942176_6512_4.png', 4),
(4, '1586942249_ccp1.png', 5),
(5, '1586942249_ccp2.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

DROP TABLE IF EXISTS `task_status`;
CREATE TABLE IF NOT EXISTS `task_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `task_status`
--

TRUNCATE TABLE `task_status`;
-- --------------------------------------------------------

--
-- Table structure for table `task_status_group`
--

DROP TABLE IF EXISTS `task_status_group`;
CREATE TABLE IF NOT EXISTS `task_status_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `status` (`status`),
  KEY `project_id_2` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `task_status_group`
--

TRUNCATE TABLE `task_status_group`;
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Truncate table before insert `user`
--

TRUNCATE TABLE `user`;
--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `password`, `display_name`, `is_active`, `avatar`) VALUES
(0, 'default', 'default', '123456789', 'default', 1, NULL),
(1, 'admin', 'admin@test.com', '123456789', 'Admin', 1, NULL),
(2, 'test_user', 'test@test.com', '123456789', 'Test User', 1, NULL),
(5, 'user_1', 'user_1@test.com', '123456789', 'User 1', 1, NULL),
(6, 'user_2', 'user_2@test.com', '123456789', 'User 2', 1, NULL),
(7, 'user_3', 'user_3@test.com', '123456789', 'User 3', 1, NULL),
(8, 'user_4', 'user_4@test.com', '123456789', 'User 4', 1, NULL),
(9, 'user_5', 'user_5@test.com', '123456789', 'User 5', 1, NULL),
(10, 'user_6', 'user_6@test.com', '123456789', 'User 6', 1, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`leader`) REFERENCES `user` (`id`);

--
-- Constraints for table `group_announcement`
--
ALTER TABLE `group_announcement`
  ADD CONSTRAINT `group_announcement_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `group_announcement_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);

--
-- Constraints for table `group_detail`
--
ALTER TABLE `group_detail`
  ADD CONSTRAINT `group_detail_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `group_detail_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`);

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`);

--
-- Constraints for table `project_detail`
--
ALTER TABLE `project_detail`
  ADD CONSTRAINT `project_detail_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `project_detail_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`assigner`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`assignee`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`report_to`) REFERENCES `user` (`id`);

--
-- Constraints for table `task_category_group`
--
ALTER TABLE `task_category_group`
  ADD CONSTRAINT `task_category_group_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `task_category_group_ibfk_2` FOREIGN KEY (`category`) REFERENCES `task_category` (`id`);

--
-- Constraints for table `task_comment`
--
ALTER TABLE `task_comment`
  ADD CONSTRAINT `task_comment_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `task_comment_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`);

--
-- Constraints for table `task_status_group`
--
ALTER TABLE `task_status_group`
  ADD CONSTRAINT `task_status_group_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `task_status_group_ibfk_2` FOREIGN KEY (`status`) REFERENCES `task_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
