-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 10:48 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";




-- --------------------------------------------------------

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `leader` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(14, 'Nhóm 13', NULL, 1, 1, '2020-04-08 11:11:03'),
(15, 'nhóm 14', NULL, 1, 1, '2020-04-09 14:25:08'),
(16, 'Nhóm 15', NULL, 2, 1, '2020-04-08 11:31:28'),
(17, 'Nhóm 16', NULL, 2, 1, '2020-04-08 11:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `group_announcement`
--

DROP TABLE IF EXISTS `group_announcement`;
CREATE TABLE `group_announcement` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_detail`
--

DROP TABLE IF EXISTS `group_detail`;
CREATE TABLE `group_detail` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_lead` int(11) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `is_confirmed` int(11) NOT NULL DEFAULT '0',
  `token` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date_confirmed` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(18, 15, 2, 0, '2020-04-08 11:31:42', 1, '', '2020-04-08 11:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `leader` int(11) NOT NULL,
  `last_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `created_at`, `created_by`, `is_active`, `group_id`, `description`, `leader`, `last_update`) VALUES
(1, 'Project 1', '2020-04-09 11:24:08', 1, 1, 15, NULL, 1, '2020-04-09 11:24:08'),
(2, 'Project 1', '2020-04-09 11:24:23', 1, 0, 15, NULL, 1, '2020-04-09 11:24:23'),
(3, 'Project 1', '2020-04-09 11:25:08', 1, 0, 15, NULL, 1, '2020-04-09 11:25:08'),
(4, 'Project 2', '2020-04-09 11:26:12', 1, 1, 15, NULL, 1, '2020-04-09 11:26:12'),
(5, 'Project 3', '2020-04-09 11:37:36', 1, 1, 15, NULL, 1, '2020-04-09 11:37:36'),
(6, 'project 4', '2020-04-09 14:25:08', 1, 1, 15, 'project 4 test', 1, '2020-04-09 14:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `project_detail`
--

DROP TABLE IF EXISTS `project_detail`;
CREATE TABLE `project_detail` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_lead` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_detail`
--

INSERT INTO `project_detail` (`id`, `project_id`, `user_id`, `is_lead`, `date_added`) VALUES
(1, 3, 1, 1, '2020-04-09 11:25:08'),
(2, 4, 1, 1, '2020-04-09 11:26:12'),
(3, 5, 1, 1, '2020-04-09 11:37:36'),
(4, 6, 1, 1, '2020-04-09 14:25:08');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE `task` (
  `id` int(11) NOT NULL,
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
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_category`
--

DROP TABLE IF EXISTS `task_category`;
CREATE TABLE `task_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_category_group`
--

DROP TABLE IF EXISTS `task_category_group`;
CREATE TABLE `task_category_group` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_comment`
--

DROP TABLE IF EXISTS `task_comment`;
CREATE TABLE `task_comment` (
  `id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `is_edited` int(11) NOT NULL,
  `original_comment` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_comment_reply`
--

DROP TABLE IF EXISTS `task_comment_reply`;
CREATE TABLE `task_comment_reply` (
  `id` int(11) NOT NULL,
  `original_comment` int(11) NOT NULL,
  `reply_comment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

DROP TABLE IF EXISTS `task_status`;
CREATE TABLE `task_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_status_group`
--

DROP TABLE IF EXISTS `task_status_group`;
CREATE TABLE `task_status_group` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `email`, `password`, `display_name`, `is_active`, `avatar`) VALUES
(1, 'admin', 'admin@test.com', '123456789', 'Admin', 1, NULL),
(2, 'test_user', 'test@test.com', '123456789', 'Test User', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leader` (`leader`);

--
-- Indexes for table `group_announcement`
--
ALTER TABLE `group_announcement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_id` (`group_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `group_detail`
--
ALTER TABLE `group_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `is_lead` (`is_lead`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `project_detail`
--
ALTER TABLE `project_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `assigner` (`assigner`),
  ADD KEY `assignee` (`assignee`),
  ADD KEY `report_to` (`report_to`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `task_category`
--
ALTER TABLE `task_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `task_category_group`
--
ALTER TABLE `task_category_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `project_id_2` (`project_id`);

--
-- Indexes for table `task_comment`
--
ALTER TABLE `task_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `task_id` (`task_id`);

--
-- Indexes for table `task_comment_reply`
--
ALTER TABLE `task_comment_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_status_group`
--
ALTER TABLE `task_status_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `status` (`status`),
  ADD KEY `project_id_2` (`project_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `group_announcement`
--
ALTER TABLE `group_announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_detail`
--
ALTER TABLE `group_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_detail`
--
ALTER TABLE `project_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_category`
--
ALTER TABLE `task_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_comment`
--
ALTER TABLE `task_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_comment_reply`
--
ALTER TABLE `task_comment_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_status_group`
--
ALTER TABLE `task_status_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
