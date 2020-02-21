-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 10:02 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `muacm`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `created_by`, `body`, `published_on`) VALUES
(5, 3, 'emrul1', 'CVCV BNM,.', '2020-01-08 08:12:42'),
(6, 3, 'emrul1', 'DSFDGFGYHUJKM', '2020-01-08 08:12:47'),
(7, 3, 'emrul1', '\\AASDS', '2020-01-08 08:12:51'),
(8, 3, 'emrul1', 'SXDCFGNJMHV', '2020-01-08 08:20:28'),
(9, 3, 'emrul', 'now now', '2020-01-08 08:22:20'),
(10, 3, 'emrul', 'a\\fsgdhfthg\r\nwfwegwsergetrfg 24wedf2w3egrw3rg &lt;b&gt;efgwrvg&lt;/b&gt;', '2020-01-08 08:23:05'),
(11, 4, 'emrul', '&lt;i&gt;ok&lt;/i&gt;', '2020-01-08 11:39:00'),
(12, 4, 'emrul', '[i]gthg[/i]', '2020-01-08 11:39:13'),
(13, 4, 'emrul', '[h1]ok[/h1]', '2020-01-08 11:42:31'),
(14, 4, 'emrul', '[i][h1]wesff[/h1][/i]', '2020-01-08 11:43:42'),
(15, 4, 'emrul', '[ul][li]edrg[/li][li]wefef[/li][/ul]', '2020-01-08 11:45:17'),
(16, 6, 'emrul', 'okay vai', '2020-01-08 15:03:31'),
(17, 7, 'emrul', 'hju', '2020-01-08 15:29:54'),
(18, 7, 'emrul', 'okay friend', '2020-01-08 15:30:04'),
(19, 8, 'aaman', 'sdfghjikl\r\n', '2020-01-12 07:42:02'),
(20, 8, 'rafat', 'kitaba', '2020-01-12 07:42:28'),
(21, 5, 'emrul', 'okay', '2020-01-21 06:33:45'),
(22, 5, 'emrul', 'hello', '2020-01-21 06:33:53'),
(23, 15, 'emrul', 'swdrwe', '2020-01-22 06:09:08'),
(24, 15, 'emrul', 'sedf', '2020-01-22 06:28:16'),
(25, 15, 'emrul', 'sfefw', '2020-01-22 06:29:11'),
(26, 15, 'emrul1', 'okay', '2020-01-22 06:31:46'),
(27, 14, 'emrul', 'okay', '2020-01-31 18:18:02'),
(28, 24, 'emrul1', 'wrr wrer wrr wrr wrrr tttewsw rrwr rwr w', '2020-02-01 15:18:39'),
(29, 18, 'emrul', 'et\r\n', '2020-02-05 19:18:38'),
(30, 24, 'emrul', 'sretr wre', '2020-02-05 19:34:37'),
(31, 24, 'aaman', 'w', '2020-02-05 21:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` mediumtext NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `body`, `published_on`, `update_on`, `created_by`) VALUES
(14, 'This is to test the editor', '[b]this is bold[/b]\r\n[i]this is italic[/i]\r\n[h1]this is h1[/h1]\r\n[h2]this is h2[/h2]\r\n[h3]this is h3[/h3]\r\n[h4]this is h4[/h4]\r\n[h5]this is h5[/h5]\r\n[ul]\r\n[li]this is unordered list 1[/li]\r\n[li]this is unordered list 2[/li]\r\n[/ul]\r\n[ol]\r\n[li]this is ordered list 1[/li]\r\n[li]this is ordered list 2[/li]\r\n[/ol]\r\n[url](link)[http://www.google.com](text)[this is google][/url]', '2020-01-13 04:04:03', '2020-01-31 07:58:07', 'rafat'),
(16, 'Image', '[img](src)[http://localhost/muacm/assets/images/profile/emrul_1578843735.jpg](text)[][/img]', '2020-01-21 05:51:15', '2020-01-21 05:51:15', 'emrul'),
(19, '4efr', 'awer', '2020-02-01 15:05:13', '2020-02-01 15:05:13', 'emrul1');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `body` longtext NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `blog_id`, `created_by`, `body`, `published_on`) VALUES
(5, 3, 'emrul1', 'CVCV BNM,.', '2020-01-08 08:12:42'),
(6, 3, 'emrul1', 'DSFDGFGYHUJKM', '2020-01-08 08:12:47'),
(7, 3, 'emrul1', '\\AASDS', '2020-01-08 08:12:51'),
(8, 3, 'emrul1', 'SXDCFGNJMHV', '2020-01-08 08:20:28'),
(9, 3, 'emrul', 'now now', '2020-01-08 08:22:20'),
(10, 3, 'emrul', 'a\\fsgdhfthg\r\nwfwegwsergetrfg 24wedf2w3egrw3rg &lt;b&gt;efgwrvg&lt;/b&gt;', '2020-01-08 08:23:05'),
(11, 4, 'emrul', '&lt;i&gt;ok&lt;/i&gt;', '2020-01-08 11:39:00'),
(12, 4, 'emrul', '[i]gthg[/i]', '2020-01-08 11:39:13'),
(13, 4, 'emrul', '[h1]ok[/h1]', '2020-01-08 11:42:31'),
(14, 4, 'emrul', '[i][h1]wesff[/h1][/i]', '2020-01-08 11:43:42'),
(15, 4, 'emrul', '[ul][li]edrg[/li][li]wefef[/li][/ul]', '2020-01-08 11:45:17'),
(16, 6, 'emrul', 'okay vai', '2020-01-08 15:03:31'),
(17, 7, 'emrul', 'hju', '2020-01-08 15:29:54'),
(18, 7, 'emrul', 'okay friend', '2020-01-08 15:30:04'),
(19, 8, 'aaman', 'sdfghjikl\r\n', '2020-01-12 07:42:02'),
(20, 8, 'rafat', 'kitaba', '2020-01-12 07:42:28'),
(21, 19, 'emrul', 'aef\r\n', '2020-02-01 15:06:49'),
(22, 19, 'emrul', '', '2020-02-01 15:06:51'),
(23, 19, 'emrul', 'qdqwd', '2020-02-01 15:09:30'),
(24, 19, 'emrul', '', '2020-02-01 15:09:53');

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE `contests` (
  `name` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `duration` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `registration_deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `details` longtext NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `standings` varchar(5000) NOT NULL,
  `problems` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contests`
--

INSERT INTO `contests` (`name`, `created_on`, `start_on`, `duration`, `id`, `registration_deadline`, `details`, `created_by`, `standings`, `problems`) VALUES
('Intra Metropolitan University Junior Programming Contest 2017', '2020-02-01 07:15:53', '2017-07-25 08:10:00', 240, 4, '2017-07-24 17:59:00', '', '', 'https://toph.co/c/mu-intra-junior-2017', 'https://toph.co/problems/contests/mu-intra-junior-2017'),
('MU Tech Fest Programming Contest 2017 (Junior)', '2020-02-01 07:21:26', '2017-11-16 04:05:00', 300, 5, '2017-11-15 17:59:00', '', '', 'https://toph.co/c/mu-tech-fest-2017-j', 'https://toph.co/problems/contests/mu-tech-fest-2017-j'),
('MU Tech Fest Programming Contest 2017 (Senior)', '2020-02-01 07:21:26', '2017-11-16 04:05:00', 300, 6, '2017-11-15 17:59:00', '', '', 'https://toph.co/c/mu-tech-fest-2017-s', 'https://toph.co/problems/contests/mu-tech-fest-2017-s'),
('Intra Metropolitan University Junior Programming Contest Spring 2019', '2020-02-01 07:50:08', '2019-03-28 04:15:00', 325, 7, '2019-03-27 17:59:00', '', '', 'https://toph.co/c/intra-mu-junior-spring-2019', 'https://toph.co/problems/contests/intra-mu-junior-spring-2019'),
('Intra Metropolitan University Junior Programming Contest Summer 2019', '2020-02-01 07:57:38', '2019-07-27 04:20:00', 210, 8, '2019-07-26 17:59:00', '', '', 'https://toph.co/c/intra-mu-summer-2019-j', 'https://toph.co/problems/contests/intra-mu-summer-2019-j');

-- --------------------------------------------------------

--
-- Table structure for table `contest_participants`
--

CREATE TABLE `contest_participants` (
  `id` int(11) NOT NULL,
  `contest_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `department` varchar(5) NOT NULL,
  `batch` int(11) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contest_participants`
--

INSERT INTO `contest_participants` (`id`, `contest_id`, `username`, `phone`, `department`, `batch`, `registered_on`) VALUES
(1, 1, 'aaman', '01732736598', 'CSE', 52, '2020-01-12 13:49:13'),
(2, 1, 'emrul', '01732736598', 'CSE', 38, '2020-01-12 14:42:27'),
(3, 1, 'rafat', '01732736598', 'CSE', 38, '2020-01-12 14:43:47'),
(4, 3, 'aaman', '01715718099', 'CSE', 38, '2020-01-28 16:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mentor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_on`, `mentor`) VALUES
(1, 'Group #1', '2020-01-22 07:00:08', 'rafat');

-- --------------------------------------------------------

--
-- Table structure for table `group_chat`
--

CREATE TABLE `group_chat` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `sender` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_chat`
--

INSERT INTO `group_chat` (`id`, `group_id`, `sender`, `body`, `created_on`) VALUES
(61, 1, 'rafat', 'hello', '2020-01-22 07:53:15'),
(62, 1, 'aaman', 'hello boss', '2020-01-22 08:03:15'),
(63, 1, 'rafat', 'swr wr', '2020-02-01 15:32:23'),
(64, 1, 'emrul', '                   a', '2020-02-05 19:24:04');

-- --------------------------------------------------------

--
-- Table structure for table `group_participants`
--

CREATE TABLE `group_participants` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_participants`
--

INSERT INTO `group_participants` (`id`, `group_id`, `username`, `created_on`) VALUES
(3, 1, 'emrul', '2020-01-22 07:44:33'),
(5, 1, 'aaman', '2020-01-22 07:47:06'),
(9, 1, 'rabel', '2020-01-31 06:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `helpful`
--

CREATE TABLE `helpful` (
  `id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `liked_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `helpful`
--

INSERT INTO `helpful` (`id`, `answer_id`, `created_by`, `liked_by`) VALUES
(4, 25, 'emrul', 'emrul1'),
(5, 28, 'emrul1', 'emrul'),
(6, 28, 'emrul1', 'aaman'),
(7, 30, 'emrul', 'aaman'),
(8, 31, 'aaman', 'emrul');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `summary` varchar(1000) NOT NULL,
  `body` mediumtext NOT NULL,
  `photo` varchar(10000) NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(100) NOT NULL,
  `updated_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `summary`, `body`, `photo`, `published_on`, `updated_on`, `created_by`, `updated_by`) VALUES
(1, 'Success in ICPC Dhaka Regional 2019', 'Metropolitan University ranked in 30th position in ICPC Dhaka Regional 2019', 'Metropolitan University ranked in 30th position in ICPC Dhaka Regional 2019', 'assets/images/icpc.jpg', '2019-12-25 11:45:30', '2019-12-25 11:46:45', 'emrul', '');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id` int(11) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `total_team` int(11) NOT NULL,
  `total_team_from_mu` int(11) NOT NULL,
  `best_rank` int(11) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `standings` varchar(5000) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id`, `name`, `total_team`, `total_team_from_mu`, `best_rank`, `type`, `standings`, `year`) VALUES
(1, 'CUET NCPC 2017', 150, 1, 114, 'ncpc', 'https://algo.codemarshal.org/contests/ncpc-2017/standings', 2017),
(2, 'IUBAT NCPC 2018', 149, 2, 34, 'ncpc', 'https://algo.codemarshal.org/contests/ncpc18/standings', 2018),
(3, 'ICPC Dhaka Regional 2014', 135, 1, 58, 'icpc', 'https://algo.codemarshal.org/contests/acm-icpc-2014-dhaka-live/standings', 2014),
(4, 'ICPC Dhaka Regional 2015', 122, 1, 97, 'icpc', 'https://algo.codemarshal.org/contests/icpcdhaka2015/standings', 2015),
(5, 'ICPC Dhaka Regional 2016', 125, 1, 53, 'icpc', 'https://algo.codemarshal.org/contests/ICPCDH2016/standings', 2016),
(6, 'ICPC Dhaka Regional 2017', 150, 2, 93, 'icpc', 'https://algo.codemarshal.org/contests/icpc-dhaka-17/standings', 2017),
(7, 'ICPC Dhaka Regional 2018', 298, 4, 93, 'icpc', 'https://algo.codemarshal.org/contests/icpc-dhaka-18/standings', 2108),
(8, 'ICPC Dhaka Regional 2019', 190, 2, 30, 'icpc', 'https://algo.codemarshal.org/contests/icpc-dhaka-19-onsite-main/standings', 2019),
(9, 'UAP NCPC 2016', 119, 1, 89, 'ncpc', 'https://algo.codemarshal.org/contests/ncpc-uap-2016/standings', 2016),
(10, 'SUST Inter-University Programming Contest 2015', 111, 7, 64, 'iupc', 'https://algo.codemarshal.org/contests/sustiupc2015/standings', 2015),
(11, 'LU Inter-University Programming Contest 2017', 53, 16, 5, 'iupc', 'https://toph.co/c/lu-inter-2017/standings', 2017),
(12, 'SUST CSE Carnival 2017', 161, 7, 43, 'iupc', 'https://toph.co/c/sust-inter-2017', 2017),
(13, 'NEUB Junior Inter-University Programming Contest 2017', 42, 2, 16, 'iupc', 'https://toph.co/c/neub-j-inter-2017/standings', 2017),
(14, 'IUT 9th ICT Fest 2017 Programming Contest', 117, 1, 76, 'iupc', 'https://toph.co/c/iut-ict-fest-2017/standings', 2017),
(15, 'SUB-Banglalion Inter-University Programming Contest 2018', 112, 2, 58, 'iupc', 'https://toph.co/c/banglalion-sub-iupc-2018/standings', 2018),
(16, 'Cybernauts NPC 2018', 133, 1, 108, 'iupc', 'https://toph.co/c/cybernauts-npc-2018/standings', 2018),
(17, 'LU National ICT Fest Programming Contest 2018', 90, 7, 38, 'iupc', 'https://toph.co/c/lu-ict-fest-2018/standings', 2018),
(18, 'National Girls Programming Contest 2018', 1, 105, 31, 'iupc', 'https://algo.codemarshal.org/contests/ngpc18/standings', 2018),
(19, 'BUET CSE Fest 2019 Inter-University Programming Contest', 111, 2, 49, 'iupc', 'https://toph.co/c/buet-cse-fest-2019-iupc/standings', 2019),
(20, 'SUB Inter-University Programming Contest 2019', 109, 2, 23, 'iupc', 'https://algo.codemarshal.org/contests/sub_iupc_19/standings', 2019),
(21, 'BUP Inter-University Programming Contest 2019', 95, 2, 13, 'iupc', 'https://algo.codemarshal.org/contests/bup-iupc-19/standings', 2019),
(22, 'SUST Inter-University Programming Contest 2019', 161, 11, 24, 'iupc', 'https://toph.co/c/sust-iupc-2019/standings', 2019),
(23, 'LU CSE Carnival Inter-University Programming Contest 2019', 70, 5, 17, 'iupc', 'https://toph.co/c/lu-cse-carnival-iupc-2019/standings', 2019),
(24, 'Ada Lovelace National Girls\' Programming Contest 2020', 59, 1, 1, 'iupc', 'https://toph.co/c/ada-lovelace-ngpc-2020/standings', 2020),
(25, 'National Girls\' Programming Contest 2019', 143, 3, 36, 'iupc', 'https://toph.co/c/ngpc-2019/standings', 2019),
(26, 'National Girls\' Programming Contest 2017', 117, 2, 17, 'iupc', 'https://algo.codemarshal.org/contests/ngpc2017/standings', 2017);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` mediumtext NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `body`, `published_on`, `update_on`, `created_by`) VALUES
(7, 'order', '[h3]Order[/h3]\r\n[ol]\r\n[li]1[/li]\r\n[li]2[/li]\r\n[li]3[/li]\r\n[li]4[/li]\r\n[li]5[/li]\r\n[/ol]\r\n[br]\r\n[i]ok[/i]', '2020-01-08 15:28:39', '2020-01-21 06:39:06', 'emrul'),
(14, 'This is to test the editor', '[b]this is bold[/b]\r\n[i]this is italic[/i]\r\n[h1]this is h1[/h1]\r\n[h2]this is h2[/h2]\r\n[h3]this is h3[/h3]\r\n[h4]this is h4[/h4]\r\n[h5]this is h5[/h5]\r\n[ul]\r\n[li]this is unordered list 1[/li]\r\n[li]this is unordered list 2[/li]\r\n[/ul]\r\n[ol]\r\n[li]this is ordered list 1[/li]\r\n[li]this is ordered list 2[/li]\r\n[/ol]\r\n[url](link)[www.google.com](text)[this is google][/url]', '2020-01-13 04:04:03', '2020-01-13 04:04:03', 'rafat'),
(15, 'ef', 'seft', '2020-01-31 13:36:41', '2020-01-31 13:36:41', 'admin'),
(17, 'ewfr', 'edfqe3f', '2020-01-31 13:37:02', '2020-01-31 13:37:02', 'admin'),
(18, '6', '6', '2020-01-31 13:37:17', '2020-01-31 13:37:17', 'admin'),
(19, '7', '7', '2020-01-31 13:37:22', '2020-01-31 13:37:22', 'admin'),
(20, '8', '8', '2020-01-31 13:37:28', '2020-01-31 13:37:28', 'admin'),
(21, '9', '9', '2020-01-31 13:37:33', '2020-01-31 13:37:33', 'admin'),
(22, '10', '10', '2020-01-31 13:37:41', '2020-01-31 13:37:41', 'admin'),
(23, '11', '11', '2020-01-31 13:37:49', '2020-01-31 13:37:49', 'admin'),
(24, 'werrt', 'awedww ewrt werrt et etr te', '2020-02-01 15:14:13', '2020-02-01 15:17:46', 'emrul1');

-- --------------------------------------------------------

--
-- Table structure for table `recovery`
--

CREATE TABLE `recovery` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recovery`
--

INSERT INTO `recovery` (`id`, `username`, `code`, `created_on`) VALUES
(1, 'emrul', 'MFLkWbd9z7K8', '2020-02-05 23:57:19'),
(2, 'emrul', 'aCsDUvhHoxi6', '2020-02-05 23:57:43'),
(3, 'emrul', 'uCSYnF2clzTW', '2020-02-05 23:59:21'),
(4, 'emrul', 'yubo3x9eG85i', '2020-02-05 23:59:32'),
(5, 'emrul', 'c9husrtU6gEq', '2020-02-06 00:00:21'),
(6, 'emrul', 'wB6ZcnjTqM5L', '2020-02-06 00:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `coach` varchar(5000) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `start_on` timestamp NULL DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `public` int(11) NOT NULL,
  `problems` varchar(50000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `coach`, `created_on`, `start_on`, `duration`, `public`, `problems`) VALUES
(6, 'Task #1', 'emrul1', '2020-01-02 09:54:45', '2020-01-04 06:45:00', 300, 1, '{\"status\":\"OK\",\"result\":[{\"oj\":\"Codeforces\",\"pid\":\"34\",\"idx\":\"C\",\"name\":\"Page Numbers\",\"url\":\"https://codeforces.com/problemset/problem/34/C\"},{\"oj\":\"UVa\",\"pid\":\"10100\",\"idx\":\"\",\"name\":\"Longest Match\",\"url\":\"1041\"},{\"oj\":\"Codeforces\",\"pid\":\"798\",\"idx\":\"D\",\"name\":\"Mike and distribution\",\"url\":\"https://codeforces.com/problemset/problem/798/D\"}]}'),
(9, 'Task #3', 'rafat', '2020-01-28 08:08:38', '2020-02-18 07:59:00', 400, 1, '{\"status\":\"OK\",\"result\":[{\"oj\":\"Codeforces\",\"pid\":\"1\",\"idx\":\"A\",\"name\":\"Theatre Square\",\"url\":\"https://codeforces.com/problemset/problem/1/A\"},{\"oj\":\"Codeforces\",\"pid\":\"1\",\"idx\":\"B\",\"name\":\"Spreadsheets\",\"url\":\"https://codeforces.com/problemset/problem/1/B\"},{\"oj\":\"Codeforces\",\"pid\":\"1\",\"idx\":\"C\",\"name\":\"Ancient Berland Circus\",\"url\":\"https://codeforces.com/problemset/problem/1/C\"}]}'),
(10, 'oijnmk', 'emrul1', '2020-02-01 10:04:47', '2018-12-31 19:00:00', 890, 0, '{\"status\":\"OK\",\"result\":[]}'),
(11, 'Task #3', 'emrul1', '2020-02-01 10:06:25', '2019-12-31 18:00:00', 50, 1, '{\"status\":\"OK\",\"result\":[{\"oj\":\"Codeforces\",\"pid\":\"2\",\"idx\":\"B\",\"name\":\"The least round way\",\"url\":\"https://codeforces.com/problemset/problem/2/B\"}]}'),
(12, 'Teask Test', 'rafat', '2020-02-03 15:40:35', '2020-12-31 19:00:00', 300, 0, '{\"status\":\"OK\",\"result\":[{\"oj\":\"Codeforces\",\"pid\":\"1\",\"idx\":\"B\",\"name\":\"Spreadsheets\",\"url\":\"https://codeforces.com/problemset/problem/1/B\"},{\"oj\":\"Codeforces\",\"pid\":\"456765\",\"idx\":\"B\",\"name\":\"             \",\"url\":\"https://codeforces.com/problemset/problem/456765/B\"}]}'),
(13, 'efgf', 'rafat', '2020-02-03 15:43:48', '2019-12-31 19:00:00', 444, 0, '{\"status\":\"OK\",\"result\":[]}'),
(14, 'ert', 'rafat', '2020-02-03 15:45:55', '2019-12-31 19:00:00', 45653, 0, '{\"status\":\"OK\",\"result\":[]}'),
(15, 'wefces', 'rafat', '2020-02-03 15:46:37', '2019-12-31 18:00:00', 345, 0, '{\"status\":\"OK\",\"result\":[{\"oj\":\"Codeforces\",\"pid\":\"456765\",\"idx\":\"B\",\"name\":\"             \",\"url\":\"https://codeforces.com/problemset/problem/456765/B\"}]}'),
(16, '3fgf', 'rafat', '2020-02-03 15:48:36', '2019-12-31 19:00:00', 34567, 0, '{\"status\":\"OK\",\"result\":[]}');

-- --------------------------------------------------------

--
-- Table structure for table `task_announcements`
--

CREATE TABLE `task_announcements` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `body` varchar(50000) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `published_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_announcements`
--

INSERT INTO `task_announcements` (`id`, `task_id`, `body`, `created_by`, `published_on`, `updated_on`) VALUES
(1, 6, 'dfrgthj', 'emrul1', '2020-01-09 12:06:10', '0000-00-00 00:00:00'),
(2, 6, '[b]test[/b] [i]announcements[/i]', 'emrul1', '2020-01-09 12:22:17', '0000-00-00 00:00:00'),
(3, 7, '[b]test[/b]', 'emrul1', '2020-01-28 08:06:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `task_participants`
--

CREATE TABLE `task_participants` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_participants`
--

INSERT INTO `task_participants` (`id`, `task_id`, `username`, `created_on`) VALUES
(1, 6, 'emrul', '2020-01-10 13:14:43'),
(2, 6, 'aaman', '2020-01-11 13:10:19'),
(3, 8, 'emrul', '2020-01-12 07:48:44'),
(4, 6, 'rabel', '2020-01-16 07:21:21'),
(6, 8, 'emrul2', '2020-01-22 07:24:09'),
(7, 7, 'aaman', '2020-01-28 07:59:16'),
(8, 7, 'rabel', '2020-01-28 09:06:37'),
(9, 7, 'rafat', '2020-01-28 09:06:37'),
(10, 9, 'aaman', '2020-01-28 13:43:03'),
(11, 8, 'nasif', '2020-01-28 14:50:07'),
(12, 8, 'aaman', '2020-01-28 14:50:07'),
(14, 7, 'nasif', '2020-01-28 14:51:14'),
(15, 7, 'fahim', '2020-01-28 14:51:14'),
(16, 7, 'emrul', '2020-01-28 14:51:37'),
(17, 6, 'rafat', '2020-01-28 14:59:26'),
(18, 9, 'emrul', '2020-01-28 15:07:30'),
(19, 9, 'rabel', '2020-01-28 15:07:30'),
(20, 9, 'ashik123', '2020-01-28 15:07:30'),
(21, 11, 'emrul', '2020-02-04 16:17:14');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `member1` varchar(200) NOT NULL,
  `member2` varchar(200) NOT NULL,
  `member3` varchar(200) NOT NULL,
  `coach` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `member1`, `member2`, `member3`, `coach`, `name`, `created_on`) VALUES
(1, 'nasif', 'aaman', 'fahim', 'emrul1', 'TEAM X', '2020-01-09 16:12:42'),
(2, 'nasif', 'aaman', 'fahim', 'emrul1', 'TEAM X1', '2020-01-09 16:12:42'),
(6, 'aaman', 'rabel', 'rafat', 'emrul1', 'team tut tut', '2020-01-09 17:09:34'),
(8, 'emrul', 'rafat', 'aaman', 'emrul1', 'Team #2', '2020-01-16 05:16:48'),
(9, 'rabel', 'emrul', 'nasif', 'emrul1', 'wd', '2020-02-05 20:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `team_chat`
--

CREATE TABLE `team_chat` (
  `id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `sender` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team_chat`
--

INSERT INTO `team_chat` (`id`, `team_id`, `sender`, `body`, `created_on`) VALUES
(1, 6, 'emrul1', 'sss', '2020-01-10 14:32:06'),
(2, 6, 'emrul1', 'sss', '2020-01-10 14:45:34'),
(3, 6, 'emrul1', 'ss', '2020-01-10 15:00:41'),
(4, 6, 'emrul1', 'sss', '2020-01-10 15:00:45'),
(5, 6, 'emrul1', 'kitaa', '2020-01-10 15:46:47'),
(6, 6, 'emrul1', 'vala ni', '2020-01-10 15:47:32'),
(7, 6, 'emrul1', 'jika', '2020-01-10 15:48:11'),
(8, 6, 'emrul1', 'dhur hala', '2020-01-10 15:48:28'),
(9, 6, 'emrul1', 'wwwwwwwwwwwwwwww', '2020-01-10 15:50:06'),
(10, 6, 'emrul1', 'sdsdsd', '2020-01-10 15:55:41'),
(11, 6, 'emrul1', 'awaw', '2020-01-10 15:58:32'),
(12, 6, 'emrul1', 'yeessss', '2020-01-10 16:00:20'),
(13, 6, 'emrul1', 'nooo', '2020-01-10 16:00:41'),
(14, 6, 'aaman', 'boo boo', '2020-01-10 16:03:40'),
(15, 6, 'emrul1', 'lo lo', '2020-01-10 16:05:12'),
(16, 6, 'aaman', 'kutu', '2020-01-10 18:17:59'),
(17, 6, 'emrul1', 'oka', '2020-01-10 18:28:09'),
(18, 6, 'emrul1', 'ok ok', '2020-01-10 18:41:45'),
(19, 6, 'emrul1', 'mew mew', '2020-01-10 18:42:42'),
(20, 6, 'aaman', 'ss', '2020-01-11 13:25:07'),
(21, 6, 'aaman', 'sdsdsd', '2020-01-11 13:25:17'),
(22, 6, 'aaman', 'emrul', '2020-01-11 13:25:30'),
(23, 6, 'aaman', 'hello how are you', '2020-01-11 13:52:04'),
(24, 6, 'aaman', 'are you fine', '2020-01-11 13:52:14'),
(25, 6, 'aaman', 'good', '2020-01-11 13:52:41'),
(26, 6, 'aaman', 'esas', '2020-01-11 14:02:43'),
(27, 6, 'aaman', 'asasas', '2020-01-11 14:03:34'),
(28, 6, 'emrul1', 'hello rafat', '2020-01-11 14:15:00'),
(29, 6, 'rafat', 'hi emrul', '2020-01-11 14:15:08'),
(30, 6, 'emrul1', 'vala ni', '2020-01-11 14:16:44'),
(31, 6, 'rafat', 'oy rebah', '2020-01-11 14:16:52'),
(32, 6, 'emrul1', 'lol', '2020-01-11 14:17:00'),
(33, 6, 'emrul1', 'okay', '2020-01-11 14:20:25'),
(34, 6, 'emrul1', 'no no', '2020-01-11 14:20:32'),
(35, 6, 'rafat', 'hehe', '2020-01-11 14:20:47'),
(36, 6, 'rafat', 'ktaba emrul', '2020-01-11 14:22:10'),
(37, 6, 'emrul1', 'kitaba rafat', '2020-01-11 14:22:20'),
(38, 6, 'rafat', 'vala ni? ', '2020-01-11 14:22:32'),
(39, 6, 'emrul1', 'oy vala', '2020-01-11 14:22:42'),
(40, 6, 'rafat', 'hi there ', '2020-01-11 14:25:24'),
(41, 6, 'rafat', 'hi there ', '2020-01-11 14:25:25'),
(42, 6, 'rafat', 'hi there ', '2020-01-11 14:25:27'),
(43, 6, 'rafat', 'Kita', '2020-01-11 14:25:32'),
(44, 6, 'emrul1', 'kita ba', '2020-01-11 14:25:38'),
(45, 6, 'emrul1', 'now', '2020-01-11 14:29:17'),
(46, 6, 'emrul1', 'now', '2020-01-11 14:34:46'),
(47, 6, 'emrul1', 'hello', '2020-01-11 14:35:01'),
(48, 6, 'rafat', 'kitaba', '2020-01-11 14:50:51'),
(49, 6, 'emrul1', 'hello', '2020-01-11 14:52:36'),
(50, 6, 'rafat', 'pikaboo', '2020-01-11 14:52:48'),
(51, 6, 'emrul1', 'no no', '2020-01-11 14:53:52'),
(52, 6, 'emrul1', 'lo lo ', '2020-01-11 14:56:27'),
(53, 6, 'rafat', 'hello emrul', '2020-01-11 14:56:46'),
(54, 6, 'emrul1', 'hello', '2020-01-11 14:56:55'),
(55, 6, 'aaman', 'okay', '2020-01-11 17:31:36'),
(56, 6, 'aaman', 'hello rafat', '2020-01-12 07:37:58'),
(57, 6, 'rafat', 'bala aso ni?', '2020-01-12 07:38:12'),
(58, 6, 'emrul1', 'www.google.com check this', '2020-01-13 06:33:04'),
(59, 8, 'emrul1', 'hello', '2020-01-16 07:20:24'),
(60, 8, 'emrul1', 'kita khobor', '2020-01-16 07:20:35'),
(61, 8, 'emrul', 'hello', '2020-01-25 05:16:46'),
(62, 6, 'aaman', 'okay vai', '2020-01-28 07:05:46'),
(63, 8, 'emrul1', 'okay', '2020-02-01 10:17:51'),
(64, 8, 'emrul', '                         ', '2020-02-05 17:08:12'),
(65, 8, 'emrul', '', '2020-02-05 17:08:25'),
(66, 8, 'emrul', '', '2020-02-05 17:08:25'),
(67, 8, 'emrul', '', '2020-02-05 17:08:25'),
(68, 8, 'emrul', '', '2020-02-05 17:08:25'),
(69, 8, 'emrul', '', '2020-02-05 17:08:25'),
(70, 8, 'emrul', '', '2020-02-05 17:08:26'),
(71, 8, 'emrul', '', '2020-02-05 17:08:26'),
(72, 8, 'emrul', '', '2020-02-05 17:08:26'),
(73, 8, 'emrul', '', '2020-02-05 17:08:26'),
(74, 8, 'emrul', 'dfgd', '2020-02-05 19:22:44'),
(75, 9, 'emrul1', 'hello all', '2020-02-05 20:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `password` varchar(32000) NOT NULL,
  `role` varchar(12) NOT NULL DEFAULT 'user',
  `codeforces` varchar(100) NOT NULL,
  `codechef` varchar(100) NOT NULL,
  `uva` varchar(100) NOT NULL,
  `spoj` varchar(100) NOT NULL,
  `lightoj` varchar(100) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `topcoder` varchar(100) NOT NULL,
  `toph` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(5000) NOT NULL DEFAULT 'assets/images/default.png',
  `verification_code` varchar(500) NOT NULL,
  `joined_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `CFrating` int(11) NOT NULL DEFAULT '0',
  `CFmaxRating` int(11) NOT NULL DEFAULT '0',
  `CCrating` int(11) NOT NULL DEFAULT '0',
  `CCmaxRating` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `student_id`, `password`, `role`, `codeforces`, `codechef`, `uva`, `spoj`, `lightoj`, `is_active`, `topcoder`, `toph`, `email`, `verified`, `photo`, `verification_code`, `joined_on`, `CFrating`, `CFmaxRating`, `CCrating`, `CCmaxRating`) VALUES
(1, 'Emrul Chowdhury', 'emrul', '161-115-004', '4badaee57fed5610012a296273158f5f', 'user', 'Mr_Emrul', 'emrul_mu', '', '', '', 1, '', '', 'emrul.cse@metrouni.edu.bd', 1, 'assets/images/profile/emrul_1578843735.jpg', '', '2020-02-05 20:56:35', 0, 0, 0, 0),
(2, 'Emrul Chowdhury', 'emrul1', '161-115-004', '4badaee57fed5610012a296273158f5f', 'coach', '', '', '', '', '', 1, '', '', 'emrul.cse@metrouni.edu.bd', 1, 'assets/images/profile/emrul1_1579675377.jpg', '', '2020-01-25 07:50:14', 0, 0, 0, 0),
(3, 'Islam Rafat', 'rafat', '', '4badaee57fed5610012a296273158f5f', 'mentor', 'rafat', '', '', '', '', 1, '', '', 'emrul.cse@metrouni.edu.bd', 1, 'assets/images/profile/rafat_1578897150.jpg', '', '2020-01-28 15:47:42', 0, 0, 0, 0),
(4, 'Rabel Ahmed', 'rabel', '151-115-001', '4badaee57fed5610012a296273158f5f', 'user', 'Rabel.c', 'rabel', '', '', '', 1, '', '', 'emrul.cse@metrouni.edu.bd', 1, 'assets/images/default.png', '', '2020-01-28 06:51:03', 1187, 1383, 1466, 1500),
(5, 'Aaman', 'aaman', '163-115-121', '4badaee57fed5610012a296273158f5f', 'user', 'Decayed', 'aaman007', '', '', '', 1, '', '', 'aaman@metrouni.edu.bd', 1, 'assets/images/default.png', '', '2020-02-01 06:43:34', 1583, 1688, 1867, 1867),
(6, 'Nasif', 'nasif', '181-115-001', '4badaee57fed5610012a296273158f5f', 'user', '', '', '', '', '', 1, '', '', '', 1, 'assets/images/default.png', '', '2020-02-01 09:48:11', 0, 0, 0, 0),
(7, 'Fahim', 'fahim', '171-115-005', '4badaee57fed5610012a296273158f5f', 'user', 'Fahim_Ahmed_Shojib', 'fahim_786', '', '', '', 1, '', '', 'fahim@mucpc.com', 1, 'assets/images/default.png', '', '2020-01-28 06:51:16', 1531, 1531, 1882, 1882),
(11, 'Mohammed Majharul Islam', 'Mohammed', '161-115-111', '4badaee57fed5610012a296273158f5f', 'user', 'Rafat', '', '', '', '', 1, '', '', 'rafatislam.syl@gmail.com', 1, 'assets/images/default.png', '1578894429Nyi4cAmZuv5I', '2020-01-28 06:51:18', 1502, 1725, 0, 0),
(18, 'Emrul Chowdhury', 'admin', '', '4badaee57fed5610012a296273158f5f', 'admin', '', '', '', '', '', 1, '', '', 'emrul.chy@gmail.com', 1, 'assets/images/default.png', '', '2020-02-04 15:55:10', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contests`
--
ALTER TABLE `contests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contest_participants`
--
ALTER TABLE `contest_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_chat`
--
ALTER TABLE `group_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_participants`
--
ALTER TABLE `group_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `helpful`
--
ALTER TABLE `helpful`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recovery`
--
ALTER TABLE `recovery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_announcements`
--
ALTER TABLE `task_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_participants`
--
ALTER TABLE `task_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_chat`
--
ALTER TABLE `team_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `contests`
--
ALTER TABLE `contests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contest_participants`
--
ALTER TABLE `contest_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `group_chat`
--
ALTER TABLE `group_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `group_participants`
--
ALTER TABLE `group_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `helpful`
--
ALTER TABLE `helpful`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `recovery`
--
ALTER TABLE `recovery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `task_announcements`
--
ALTER TABLE `task_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_participants`
--
ALTER TABLE `task_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team_chat`
--
ALTER TABLE `team_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
