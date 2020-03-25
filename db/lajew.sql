-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2019 at 12:03 PM
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
-- Database: `lajew`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_1` int(11) NOT NULL,
  `parent_2` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` tinytext COLLATE utf8_unicode_ci,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent_1`, `parent_2`, `level`, `deleted`, `slug`, `description`, `active`) VALUES
(1, 'test 0', 0, 0, 0, 0, 'test-0-1', '<p>test 0</p>\r\n', 1),
(5, 'test 01', 1, 0, 1, 0, 'test-01-5', '<p>test 5</p>\r\n', 1),
(6, 'test 011', 1, 5, 2, 0, 'test-011-6', '<p>test 6</p>\r\n', 1),
(7, 'test 012', 1, 5, 2, 0, 'test_012', '<p>test 7</p>\r\n', 1),
(8, 'test 1', 0, 0, 0, 0, 'test_1', '<p>test 10</p>\r\n', 1),
(9, 'test 11', 8, 0, 1, 0, 'test_11', '<p>test 11</p>\r\n', 1),
(10, 'test 111', 8, 9, 2, 1, 'test_111', '<p>test 111</p>\r\n', 1),
(11, 'test 12', 8, 0, 1, 0, 'test_12', '<p>test 12</p>\r\n', 1),
(12, 'test 121', 8, 11, 2, 1, 'test_121', '<p>test 121</p>\r\n', 1),
(13, 'test 2', 0, 0, 0, 1, 'test_2', '<p>test 2</p>\r\n', 1),
(14, 'test 02', 1, 0, 1, 0, 'test-02-14', '<p>test 02</p>\r\n', 1),
(15, 'test 021', 1, 14, 2, 0, 'test_021', '<p>test 021</p>\r\n', 1),
(16, 'test 03', 1, 0, 1, 0, 'test_03', '<p>test 03</p>\r\n', 1),
(17, 'test 031', 1, 16, 2, 0, 'test_031', '', 1),
(18, 'test 2', 0, 0, 0, 0, 'test_2', '', 1),
(19, 'test 21', 18, 0, 1, 0, 'test_21', '', 1),
(20, 'test 22', 18, 0, 1, 0, 'test_22', '', 1),
(21, 'test 3', 0, 0, 0, 0, 'test_3', '', 1),
(22, 'test 011', 1, 5, 2, 0, 'test-011-22', '<p>test 011</p>\r\n', 1),
(23, 'test 100000', 0, 0, 0, 1, 'test-100000-23', '<p>test 100000</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `admin` text COLLATE utf8_unicode_ci NOT NULL,
  `customer` text COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `admin`, `customer`, `order_id`) VALUES
(1, '1', '1', 12),
(2, '1', '1', 13),
(3, '1', '1', 29),
(4, '220 smtp.gmail.com ESMTP u31sm19580426pgn.93 - gsmtp\r\n<br /><pre>hello: 250-smtp.gmail.com at your service, [103.199.62.100]\r\n250-SIZE 35882577\r\n250-8BITMIME\r\n250-AUTH LOGIN PLAIN XOAUTH2 PLAIN-CLIENTTOKEN OAUTHBEARER XOAUTH\r\n250-ENHANCEDSTATUSCODES\r\n250-PIPELINING\r\n250-CHUNKING\r\n250 SMTPUTF8\r\n</pre>Failed to authenticate password. Error: 535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials u31sm19580426pgn.93 - gsmtp\r\n<br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 18 Sep 2019 19:18:17 +0700\r\nFrom: =?UTF-8?Q?X=C3=A1c=20Nh=E1=BA=ADn?= &lt;minhtan17071991@gmail.com&gt;\r\nReturn-Path: &lt;minhtan17071991@gmail.com&gt;\r\nTo: minhtan1707@gmail.com\r\nSubject: =?UTF-8?Q?Trang=20S=E1=BB=A9c=20Lajew?=\r\nReply-To: &lt;minhtan17071991@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: minhtan17071991@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5d822089b86ee@gmail.com&gt;\r\nMime-Version: 1.0\r\n\n\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5d822089b872a&quot;\r\n\r\nThis is a multi-part message in MIME format.\r\nYour email application may not support this format.\r\n\r\n--B_ALT_5d822089b872a\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\nThông tin đặc tiệc\r\nHọ tên: test 4\r\nSố ĐT: 01234564768\r\nThời Gian Đặt: 2019-09-18 19:18:17\r\nSố lượng khách: 5\r\nTổng Giá Đơn Hàng: 310000\r\n\r\n\r\n--B_ALT_5d822089b872a\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n=3Ch3=3ETh=C3=B4ng tin =C4=91=E1=BA=B7c ti=E1=BB=87c=3C/h3=3E\n				=3Cp=3EH=E1=BB=8D t=C3=AAn: test 4=3C/p=3E\n				=3Cp=3ES=E1=BB=91 =C4=90T: 01234564768=3C/p=3E\n				=3Cp=3ETh=E1=BB=9Di Gian =C4=90=E1=BA=B7t: 2019-09-18 19:18:17=3C/p=3E\n				=3Cp=3ES=E1=BB=91 l=C6=B0=E1=BB=A3ng kh=C3=A1ch: 5=3C/p=3E\n				=3Cp=3ET=E1=BB=95ng Gi=C3=A1 =C4=90=C6=A1n H=C3=A0ng: 310000=3C/p=3E\r\n\r\n--B_ALT_5d822089b872a--</pre>', '220 smtp.gmail.com ESMTP u31sm19580426pgn.93 - gsmtp\r\n<br /><pre>hello: 250-smtp.gmail.com at your service, [103.199.62.100]\r\n250-SIZE 35882577\r\n250-8BITMIME\r\n250-AUTH LOGIN PLAIN XOAUTH2 PLAIN-CLIENTTOKEN OAUTHBEARER XOAUTH\r\n250-ENHANCEDSTATUSCODES\r\n250-PIPELINING\r\n250-CHUNKING\r\n250 SMTPUTF8\r\n</pre>Failed to authenticate password. Error: 535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials u31sm19580426pgn.93 - gsmtp\r\n<br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br />Failed to authenticate password. Error: 535-5.7.8 Username and Password not accepted. Learn more at\r\n535 5.7.8  https://support.google.com/mail/?p=BadCredentials u31sm19580426pgn.93 - gsmtp\r\n<br />Unable to send email using PHP SMTP. Your server might not be configured to send mail using this method.<br /><pre>Date: Wed, 18 Sep 2019 19:18:17 +0700\r\nFrom: =?UTF-8?Q?X=C3=A1c=20Nh=E1=BA=ADn?= &lt;minhtan17071991@gmail.com&gt;\r\nReturn-Path: &lt;minhtan17071991@gmail.com&gt;\r\nTo: minhtan17071991@gmail.com\r\nSubject: =?UTF-8?Q?Trang=20S=E1=BB=A9c=20Lajew?=\r\nReply-To: &lt;minhtan17071991@gmail.com&gt;\r\nUser-Agent: CodeIgniter\r\nX-Sender: minhtan17071991@gmail.com\r\nX-Mailer: CodeIgniter\r\nX-Priority: 3 (Normal)\r\nMessage-ID: &lt;5d82208bf014f@gmail.com&gt;\r\nMime-Version: 1.0\r\n\r\n\r\nContent-Type: multipart/alternative; boundary=&quot;B_ALT_5d82208bf01a7&quot;\r\n\r\nThis is a multi-part message in MIME format.\r\nYour email application may not support this format.\r\n\r\n--B_ALT_5d82208bf01a7\r\nContent-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n\r\nThông tin đặc tiệc\r\nHọ tên: test 4\r\nSố ĐT: 01234564768\r\nThời Gian Đặt: 2019-09-18 19:18:17\r\nTổng Số Lượng: 5\r\nTổng Giá Đơn Hàng: 310000\r\n\r\n\r\n--B_ALT_5d82208bf01a7\r\nContent-Type: text/html; charset=UTF-8\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n=3Ch3=3ETh=C3=B4ng tin =C4=91=E1=BA=B7c ti=E1=BB=87c=3C/h3=3E\r\n				=3Cp=3EH=E1=BB=8D t=C3=AAn: test 4=3C/p=3E\r\n				=3Cp=3ES=E1=BB=91 =C4=90T: 01234564768=3C/p=3E\r\n				=3Cp=3ETh=E1=BB=9Di Gian =C4=90=E1=BA=B7t: 2019-09-18 19:18:17=3C/p=3E\r\n				=3Cp=3ET=E1=BB=95ng S=E1=BB=91 L=C6=B0=E1=BB=A3ng: 5=3C/p=3E\r\n				=3Cp=3ET=E1=BB=95ng Gi=C3=A1 =C4=90=C6=A1n H=C3=A0ng: 310000=3C/p=3E\r\n\r\n--B_ALT_5d82208bf01a7--</pre>', 30),
(5, '1', '1', 31),
(6, '1', '1', 32),
(7, '1', '1', 33),
(8, '1', '1', 34),
(9, '1', '1', 35),
(10, '1', '1', 36),
(11, '1', '1', 37),
(12, '1', '1', 39),
(13, '1', '1', 40),
(14, '1', '1', 41),
(15, '1', '1', 42),
(16, '1', '1', 43),
(17, '1', '1', 44),
(18, '1', '1', 46),
(19, '1', '1', 48),
(20, '1', '1', 50),
(21, '1', '1', 51),
(22, '1', '1', 52);

-- --------------------------------------------------------

--
-- Table structure for table `home_banner`
--

CREATE TABLE `home_banner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promotion_id` int(11) DEFAULT NULL,
  `img` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` tinytext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `home_banner`
--

INSERT INTO `home_banner` (`id`, `name`, `promotion_id`, `img`, `active`, `deleted`, `link`, `description`) VALUES
(1, 'test', NULL, '1567241188_slide_1.jpg', 1, 0, '', ''),
(2, 'test 2', NULL, '1567241196_slide_2.jpg', 1, 0, '', ''),
(3, 'test 3', NULL, '1567241204_slide_3.jpg', 1, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `total_quantity` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `delivered` int(11) NOT NULL DEFAULT '0',
  `paid` int(11) DEFAULT '0',
  `cancelled` int(11) NOT NULL DEFAULT '0',
  `order_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_code`, `user_id`, `customer_name`, `address`, `phone`, `email`, `note`, `total_quantity`, `total_price`, `delivered`, `paid`, `cancelled`, `order_at`) VALUES
(29, '1568125600-29', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '09012345567', 'minhtan17071991@gmail.com', NULL, 5, 360000, 0, 0, 0, '2019-09-10 21:26:40'),
(30, '1568809097-30', NULL, 'test 4', 'test 3', '01234564768', 'minhtan17071991@gmail.com', NULL, 5, 310000, 0, 0, 0, '2019-09-18 19:18:17'),
(31, '1568809241-31', NULL, 'test 4', 'test 3', '01234564768', 'minhtan17071991@gmail.com', NULL, 5, 310000, 0, 0, 0, '2019-09-18 19:20:41'),
(32, '1568809377-32', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '0056465456', 'minhtan17071991@gmail.com', NULL, 3, 150000, 0, 0, 0, '2019-09-18 19:22:57'),
(33, '1568809695-33', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '0056465456', 'minhtan17071991@gmail.com', NULL, 3, 150000, 0, 0, 0, '2019-09-18 19:28:15'),
(34, '1568811122-34', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01236456789', 'nvthuan.1307@gmail.com', NULL, 2, 100000, 0, 0, 0, '2019-09-18 19:52:02'),
(35, '1568811505-35', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'nvthuan.1307@gmail.com', NULL, 2, 100000, 1, 1, 0, '2019-09-18 19:58:25'),
(36, '1568812158-36', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '0123456478', 'minhtan17071991@gmail.com', NULL, 2, 100000, 0, 0, 0, '2019-09-18 20:09:18'),
(37, '1568812333-37', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'minhtan17071991@gmail.com', NULL, 3, 150000, 0, 0, 0, '2019-09-18 20:12:13'),
(38, NULL, NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'minhtan17071991@gmail.com', NULL, 2, 100000, 0, 0, 0, '2019-09-18 20:13:05'),
(39, '1568812439-39', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'minhtan17071991@gmail.com', NULL, 2, 100000, 0, 0, 0, '2019-09-18 20:13:59'),
(40, '1568812666-40', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'nvthuan.1307@gmail.com', NULL, 5, 400000, 0, 0, 0, '2019-09-18 20:17:46'),
(41, '1568812815-41', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '0056465456', 'minhtan1991@gmail.com', NULL, 3, 250000, 0, 0, 0, '2019-09-18 20:20:15'),
(42, '1568814227-42', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '0056465456', 'minhtan17071991@gmail.com', NULL, 4, 300000, 0, 0, 0, '2019-09-18 20:43:47'),
(43, '1568814349-43', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '0123456478', 'minhtan17071991@gmail.com', NULL, 5, 400000, 0, 0, 0, '2019-09-18 20:45:49'),
(44, '1568814531-44', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'minhtan17071991@gmail.com', NULL, 5, 250000, 0, 0, 0, '2019-09-18 20:48:51'),
(45, NULL, NULL, 'test 4', 'test 3', '0123456478', 'minhtan17071991@gmail.com', NULL, 2, 200000, 0, 0, 0, '2019-09-27 17:57:18'),
(46, '1569581891-46', NULL, 'Tân Nguyễn', 'test', '0056465456', 'minhtan17071991@gmail.com', NULL, 2, 200000, 0, 0, 0, '2019-09-27 17:58:11'),
(47, '1569582643-47', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '0123456478', 'minhtan17071991@gmail.com', NULL, 3, 300000, 0, 0, 0, '2019-09-27 18:10:43'),
(48, '1569582698-48', NULL, 'Tân Nguyễn', 'test 10', '0123456478', 'minhtan17071991@gmail.com', NULL, 3, 300000, 0, 0, 0, '2019-09-27 18:11:38'),
(49, '1569582773-49', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'nvthuan.1307@gmail.com', NULL, 2, 100000, 0, 0, 0, '2019-09-27 18:12:53'),
(50, '1569582872-50', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'nvthuan.1307@gmail.com', NULL, 2, 100000, 0, 0, 0, '2019-09-27 18:14:32'),
(51, '1569582959-51', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'nvthuan.1307@gmail.com', NULL, 4, 400000, 0, 0, 0, '2019-09-27 18:15:59'),
(52, '1569583051-52', NULL, 'Tân Nguyễn', '135/18 NCV, Bình Thạnh', '01234564768', 'minhtan17071991@gmail.com', NULL, 5, 400000, 0, 0, 0, '2019-09-27 18:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `name`, `product_id`, `order_id`, `quantity`, `price`, `slug`) VALUES
(29, '', 1, 29, 2, 30000, ''),
(30, '', 2, 29, 3, 100000, ''),
(31, '', 1, 30, 2, 50000, ''),
(32, '', 3, 30, 3, 70000, ''),
(33, '', 1, 31, 2, 50000, ''),
(34, '', 3, 31, 3, 70000, ''),
(35, '', 1, 32, 3, 50000, ''),
(36, '', 1, 33, 3, 50000, ''),
(37, '', 1, 34, 2, 50000, ''),
(38, '', 1, 35, 2, 50000, ''),
(39, '', 1, 36, 2, 50000, ''),
(40, '', 1, 37, 3, 50000, ''),
(41, 'Test Sp 1', 1, 39, 2, 50000, ''),
(42, 'Test Sp 1', 1, 40, 2, 50000, ''),
(43, 'Test Sp 2', 2, 40, 3, 100000, ''),
(44, 'Test Sp 2', 2, 41, 2, 100000, ''),
(45, 'Test Sp 1', 1, 41, 1, 50000, ''),
(46, 'Test Sp 1', 1, 42, 2, 50000, ''),
(47, 'Test Sp 2', 2, 42, 2, 100000, ''),
(48, 'Test Sp 1', 1, 43, 2, 50000, ''),
(49, 'Test Sp 2', 2, 43, 3, 100000, ''),
(50, 'Test Sp 1', 1, 44, 5, 50000, ''),
(51, 'Test Sp 2', 2, 46, 2, 100000, 'test_sp_2'),
(52, 'Test Sp 2', 2, 47, 3, 100000, 'test_sp_2'),
(53, 'Test Sp 2', 2, 48, 3, 100000, 'test_sp_2'),
(54, 'Test Sp 1', 1, 49, 2, 50000, 'test_sp_1'),
(55, 'Test Sp 1', 1, 50, 2, 50000, 'test_sp_1'),
(56, 'Test Sp 2', 2, 51, 4, 100000, 'test_sp_2'),
(57, 'Test Sp 1', 1, 52, 2, 50000, 'test_sp_1'),
(58, 'Test Sp 2', 2, 52, 3, 100000, 'test_sp_2');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `discount_price` int(11) DEFAULT NULL,
  `sale` int(11) NOT NULL DEFAULT '0',
  `new` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img4` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img5` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `category_1` int(11) DEFAULT NULL,
  `category_2` int(11) DEFAULT NULL,
  `category_3` int(11) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `remained` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `discount_price`, `sale`, `new`, `slug`, `img1`, `img2`, `img3`, `img4`, `img5`, `category`, `category_1`, `category_2`, `category_3`, `deleted`, `remained`) VALUES
(1, 'Test Sp 1', 50000, '<p>test sp 1</p>\r\n', 30000, 1, 1, 'test_sp_1', '1569853654_1567699842_sp81.jpg', '1567699842_sp2.jpg', '1567699842_sp4.jpg', '1567699842_sp8.jpg', '1567699843_sp9.jpg', 6, NULL, NULL, NULL, 0, 0),
(2, 'Test Sp 2', 100000, '<p>test sp 2</p>\r\n', 0, 0, 1, 'test_sp_2', '1569854103_1568998812_sp10111.jpg', '1567699822_sp2.jpg', '1567699822_sp3.jpg', '1567699823_sp4.jpg', '1567699823_sp6.jpg', 6, NULL, NULL, NULL, 0, 1),
(3, 'Test sp 3', 70000, '<p>Test sp 3</p>\r\n', 0, 0, 1, 'test_sp_3', '1569854127_1567370324_sp2.jpg', '1568998812_sp10.jpg', '1568998812_sp11.jpg', '1568998812_sp16.jpg', '1568998812_sp15.jpg', 9, NULL, NULL, NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_image_detail`
--

CREATE TABLE `product_image_detail` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `main` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_image_detail`
--

INSERT INTO `product_image_detail` (`id`, `product_id`, `image_file`, `deleted`, `main`) VALUES
(51, '1', '1569850441_08d954339dc27a9c23d3.jpg', 1, 0),
(52, '1', '1569850441_5555.jpg', 1, 0),
(53, '1', '1569850441_67723111_371842796862782_1311836458494984192_n.jpg', 1, 0),
(54, '1', '1569850441_71339291_2455359507890746_6302457863671382016_n.jpg', 1, 0),
(55, '1', '1569852467_67723111_371842796862782_1311836458494984192_n.jpg', 1, 0),
(56, '2', '1569852700_1568998812_sp10.jpg', 1, 0),
(57, '1', '1569852714_1567699843_sp9.jpg', 0, 0),
(58, '1', '1569852714_1568998812_sp8.jpg', 0, 0),
(59, '1', '1569852714_1568998812_sp11.jpg', 0, 0),
(60, '1', '1569852714_1568998812_sp15.jpg', 0, 0),
(61, '1', '1569852714_1568998812_sp16.jpg', 0, 0),
(62, '1', '1569852714_1568998812_sp101.jpg', 0, 0),
(63, '2', '1569852900_1567699842_sp2.jpg', 0, 0),
(64, '2', '1569852900_1567699842_sp4.jpg', 0, 0),
(65, '2', '1569852900_1567699842_sp8.jpg', 0, 0),
(66, '2', '1569852900_1567699843_sp91.jpg', 0, 0),
(67, '2', '1569852900_1568998812_sp81.jpg', 0, 0),
(68, '3', '1569852989_1567369763_sp16.jpg', 0, 0),
(69, '3', '1569852989_1567369764_sp1.jpg', 0, 0),
(70, '3', '1569852989_1567369764_sp2.jpg', 0, 0),
(71, '3', '1569852989_1567369784_sp1.jpg', 0, 0),
(72, '3', '1569853037_1567699823_sp4.jpg', 0, 0),
(73, '1', '1569853639_1567369748_sp16.jpg', 0, 0),
(74, '1', '1569853654_1567699842_sp81.jpg', 0, 1),
(75, '2', '1569854037_1568998812_sp1011.jpg', 1, 0),
(76, '2', '1569854103_1568998812_sp10111.jpg', 0, 1),
(77, '3', '1569854127_1567370324_sp2.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `full_name`, `email`, `phone`, `role`, `deleted`) VALUES
(1, 'admin', '12345678', 'admin', 'admin@admin.com', 'admin', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `category` ADD FULLTEXT KEY `description` (`description`);
ALTER TABLE `category` ADD FULLTEXT KEY `name` (`name`,`description`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banner`
--
ALTER TABLE `home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `product` ADD FULLTEXT KEY `description` (`description`);
ALTER TABLE `product` ADD FULLTEXT KEY `name` (`name`,`description`);

--
-- Indexes for table `product_image_detail`
--
ALTER TABLE `product_image_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `home_banner`
--
ALTER TABLE `home_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_image_detail`
--
ALTER TABLE `product_image_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
