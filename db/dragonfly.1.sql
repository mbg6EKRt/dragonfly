-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2013 at 12:56 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dragonfly`
--

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `file` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `path` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `created` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `modified` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=45 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `name`, `description`, `file`, `path`, `type`, `size`, `created`, `modified`) VALUES
(43, 'just.married.jpg', NULL, 'just.married.jpg', 'modules/sites/files', 'image/jpeg', 198953, '1341767513', NULL),
(44, 'just.married.jpg', NULL, 'just.married.jpg', 'modules/sites/files', 'image/jpeg', 198953, '1341768265', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `parent` int(12) NOT NULL DEFAULT '0',
  `label` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon` int(12) DEFAULT NULL,
  `site` int(12) DEFAULT NULL,
  `task` int(12) DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `created` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent`, `label`, `icon`, `site`, `task`, `link`, `created`, `modified`) VALUES
(58, 0, 'Admin Menu', NULL, NULL, NULL, NULL, '1322073658', NULL),
(59, 58, 'Add Site', NULL, NULL, 17, NULL, '1322074415', NULL),
(60, 58, 'Add Module', NULL, NULL, 22, NULL, '1322167413', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE IF NOT EXISTS `meta` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `keywords` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `indexed` tinyint(1) DEFAULT NULL COMMENT 'Index content',
  `follow` tinyint(1) DEFAULT NULL COMMENT 'Follow links',
  `cache` tinyint(1) DEFAULT NULL COMMENT 'Should content be cached',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=165 ;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`id`, `title`, `keywords`, `description`, `author`, `copyright`, `indexed`, `follow`, `cache`) VALUES
(1, 'Admin Dashboard', NULL, 'The admin dashboard', 'Dragonfly', 'Dragonfly', NULL, NULL, NULL),
(2, 'Lite', 'content management, webbuilder', 'The main WebBuilder website', 'Robin Stoker', 'Robin Stoker 2013', 1, 1, 1),
(10, 'Lite Domain Test', NULL, 'Testing the domain functionality', 'Michael Dwoodley', NULL, 1, 1, 1),
(11, 'Forums', 'WebBuilder Forums Keywords', 'WebBuilder Forums Description', 'WebBuilder', 'Robin Stoker', 1, 1, 1),
(35, 'gfdgfdgfd', NULL, 'gfdgfdgfdgfd', NULL, NULL, NULL, NULL, NULL),
(36, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(37, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(38, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(39, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(40, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(41, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(42, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(43, 'gfdsg', NULL, 'fdsgfdsgfds', NULL, NULL, NULL, NULL, NULL),
(44, 'fdsafdsaf', NULL, 'dsafdsafdsafdsa', 'fdsafdsafdsa', NULL, NULL, NULL, NULL),
(45, 'fdsafdsaf', NULL, 'dsafdsafdsafdsa', 'fdsafdsafdsa', NULL, NULL, NULL, NULL),
(46, 'Fifth fifth', NULL, 'Gncgncgcgn', NULL, NULL, NULL, NULL, NULL),
(47, 'Fifth fifth', NULL, 'Gncgncgcgn', NULL, NULL, NULL, NULL, NULL),
(48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, NULL, NULL, 'hgfhdhgfdhfd', NULL, NULL, NULL, NULL, NULL),
(80, NULL, NULL, 'hgfhdhgfdhfd', NULL, NULL, NULL, NULL, NULL),
(81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'fdfd', NULL, 'sfdsfdsfdsfds', 'fdsfdsfds', 'fdsfds', NULL, NULL, NULL),
(83, 'fdfd', NULL, 'sfdsfdsfdsfds', 'fdsfdsfds', 'fdsfds', NULL, NULL, NULL),
(84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'vcxvcxvcx', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'WebBernet Life', NULL, 'Description', NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, NULL, NULL, 'ghghjkghk', 'ghjghjk', NULL, NULL, NULL, NULL),
(92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'gfdgfd', NULL, 'gfdgfdgfdgfd', NULL, NULL, NULL, NULL, NULL),
(98, 'jhgfjhg', NULL, 'jhfgjhfg', 'jhfgjhfgjh', NULL, NULL, NULL, NULL),
(99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, NULL, NULL, 'Hdoscbvidnciskcso', NULL, NULL, NULL, NULL, NULL),
(143, NULL, NULL, 'Ncosnvuf', NULL, NULL, NULL, NULL, NULL),
(144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 'Jdobndkd', 'Vedferdvd,vrdvrssvt,very mulga,czaeyoda,ethic crew,', 'Ncdid.  Do doe o e e define FDA I''d on', 'Djdmdmd djdisow', 'Jendndnd. Ddkdosk', 1, 1, 1),
(146, 'Rigs gdsvj', NULL, 'Dumvduokb ther kogcsd.  Kobfdn. Hjkdsgjo.', NULL, NULL, NULL, NULL, NULL),
(147, 'Sibhkll', NULL, 'Boorsxhitdgkpphv', 'Jogecnkhv', NULL, 1, 1, 1),
(148, 'YMAA South Africa', 'Kung-fu, Thai Chi, Power Yoga, Kettleball', 'Yang''s Martial Arts Academy', 'YMAA South Africa', 'YMAA', 1, 1, 1),
(149, 'test save permissions', 'nbvnbv', 'nvnbvcnbvc', 'nbvnbvcnb', 'nbvcnbvc', NULL, NULL, NULL),
(150, 'fdsfdsfds', NULL, 'fdfds', 'fdsfds', 'fdsfds', NULL, NULL, NULL),
(151, 'fdsfdsfds', NULL, 'fdfds', 'fdsfds', 'fdsfds', NULL, NULL, NULL),
(152, 'fdsfdsfds', NULL, 'fdfds', 'fdsfds', 'fdsfds', NULL, NULL, NULL),
(153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE IF NOT EXISTS `module` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namespace` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `folder`, `file`, `namespace`, `class`, `access`, `created`, `modified`) VALUES
(11, 'Sites', 'sites', 'mod.sites.php', 'b7a01bbc136a8b8c8ee85ae03743e61456513e66', 'sites', 'public', '1320857535', NULL),
(12, 'Modules', 'modules', 'mod.modules.php', 'd7fe1772f9d314b150786179a6c79ce6252800f2', 'modules', 'public', '1320857549', NULL),
(13, 'Tasks', 'tasks', 'mod.tasks.php', 'b80ec46a8d75653d6a1d5f563f0ba0132feaaaaa', 'tasks', 'public', '1320857556', NULL),
(14, 'Pages', 'pages', 'mod.pages.php', 'a1e56b1719819be07494b142bdac61ecc1b8685b', 'pages', 'public', '1320857636', NULL),
(15, 'Themes', 'themes', 'mod.pages.php', 'b6e652365a32f6a8b58c8c967e06b122da3b185c', 'themes', 'public', '1320862491', NULL),
(53, 'Dashboard', 'dashboard', 'mod.dashboard.php', 'cc3bd702dd8950297dcb450b56c47710c05ddd38', 'dashboard', 'public', '1321472161', NULL),
(56, 'Menu', 'menu', 'mod.menu.php', 'b65573df2fb6bd349278d490c1fd3749eea79f33', 'menu', 'public', '1321566423', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `site_id` int(12) NOT NULL DEFAULT '0',
  `module_id` int(12) NOT NULL DEFAULT '0',
  `task_id` int(12) NOT NULL DEFAULT '0',
  `user_id` int(12) NOT NULL DEFAULT '0',
  `user_group_id` int(12) NOT NULL DEFAULT '0',
  `object_id` int(12) NOT NULL DEFAULT '0',
  `object_table` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`site_id`, `module_id`, `task_id`, `user_id`, `user_group_id`, `object_id`, `object_table`) VALUES
(9, 0, 0, 0, 66, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `folder` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default` tinyint(1) DEFAULT NULL,
  `default_task` int(12) DEFAULT NULL,
  `default_layout` int(12) DEFAULT NULL,
  `domain` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_id` int(12) DEFAULT NULL,
  `logo_file_id` int(12) DEFAULT NULL,
  `access` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=133 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `folder`, `default`, `default_task`, `default_layout`, `domain`, `meta_id`, `logo_file_id`, `access`, `created`, `modified`) VALUES
(8, 'Lite', 'g4ud9so3i5', NULL, 41, 46, 'webbuilder.co.za', 2, NULL, 'public', '1320787207', '1363852143'),
(9, 'Admin', 'pc6r9wi4hd', NULL, 55, 49, NULL, 1, NULL, 'rights', '1320787263', '1367543443'),
(64, 'WebBuilder Forums', 'h27si6odsn', NULL, 41, 46, 'www.webbuilder.co.za', 11, NULL, 'login', '1324058349', '1363896180'),
(124, 'YMAA South Africa', 'fy3pbiccy7nm8', 1, 41, 46, 'www.ymaasa.co.za', 148, NULL, 'public', '1363892197', '1363894921'),
(131, 'gresgsgdeeeeeeeeeeee', 'l3e0kqhk799htaa', NULL, 55, 49, NULL, 163, NULL, 'public', '1368469849', '1368469941'),
(132, 'ewqewqewq', 'fnimvfbh6ctdr', NULL, 55, 49, NULL, 164, NULL, 'public', '1368470349', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site__module`
--

CREATE TABLE IF NOT EXISTS `site__module` (
  `site_id` int(12) NOT NULL,
  `module_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `site__module`
--

INSERT INTO `site__module` (`site_id`, `module_id`) VALUES
(64, 14),
(9, 53),
(64, 56),
(0, 14),
(0, 56),
(0, 14),
(0, 56),
(0, 56),
(0, 56),
(0, 56),
(8, 56),
(8, 14),
(9, 56),
(9, 12),
(9, 14),
(9, 11),
(9, 13),
(9, 15),
(124, 56),
(124, 14);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `module_id` int(12) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `task` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `module_id`, `name`, `task`, `access`, `created`, `modified`) VALUES
(16, 11, 'Site List', 'AdminList', 'public', '1320863861', NULL),
(17, 11, 'Add Site', 'add', 'public', '1320863861', NULL),
(18, 11, 'Edit Site', 'edit', 'public', '1320863861', NULL),
(19, 11, 'Save Site', 'save', 'public', '1320863861', NULL),
(20, 11, 'Delete Sites', 'delete', 'public', '1320863861', NULL),
(21, 12, 'Module List', 'AdminList', 'public', '1320863960', NULL),
(22, 12, 'Add Module', 'add', 'public', '1320863960', NULL),
(23, 12, 'Edit Module', 'edit', 'public', '1320863960', NULL),
(24, 12, 'Save Module', 'save', 'public', '1320863960', NULL),
(25, 12, 'Delete Modules', 'delete', 'public', '1320863960', NULL),
(26, 13, 'Task List', 'AdminList', 'public', '1320864013', NULL),
(27, 13, 'Add Task', 'add', 'public', '1320864013', NULL),
(28, 13, 'Edit Task', 'edit', 'public', '1320864013', NULL),
(29, 13, 'Save Task', 'save', 'public', '1320864013', NULL),
(30, 13, 'Delete Task', 'delete', 'public', '1320864013', NULL),
(31, 15, 'Theme List', 'AdminList', 'public', '1320864073', NULL),
(32, 15, 'Add Theme', 'add', 'public', '1320864073', NULL),
(33, 15, 'Edit Theme', 'edit', 'public', '1320864073', NULL),
(34, 15, 'Save Theme', 'save', 'public', '1320864073', NULL),
(35, 15, 'Delete Theme', 'delete', 'public', '1320864073', NULL),
(36, 14, 'Page List', 'AdminList', 'public', '1320864222', NULL),
(37, 14, 'Add Page', 'add', 'public', '1320864222', NULL),
(38, 14, 'Edit Page', 'edit', 'public', '1320864222', NULL),
(39, 14, 'Save Page', 'save', 'public', '1320864222', NULL),
(40, 14, 'Delete Page', 'delete', 'public', '1320864222', NULL),
(41, 14, 'Display Page', 'display', 'public', '1320864222', NULL),
(55, 53, 'Dashboard', 'dashboard', 'public', '1321472306', NULL),
(57, 56, 'Display', 'display', 'public', '1321566754', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `folder` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(12) NOT NULL,
  `modified` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `name`, `folder`, `created`, `modified`) VALUES
(44, 'Admin', 'admin', 1321467413, NULL),
(45, 'Lite', 'lite', 1321467413, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `theme_layout`
--

CREATE TABLE IF NOT EXISTS `theme_layout` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(12) NOT NULL,
  `modified` int(12) DEFAULT NULL,
  `theme_id` int(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dumping data for table `theme_layout`
--

INSERT INTO `theme_layout` (`id`, `name`, `file`, `created`, `modified`, `theme_id`) VALUES
(46, 'General', 'index.html', 1321467713, NULL, 45),
(47, 'Login', 'login.html', 1321467713, NULL, 45),
(48, 'News', 'news.html', 1321467713, NULL, 45),
(49, 'General', 'index.html', 1321467868, NULL, 44),
(50, 'Login', 'login.html', 1321467868, NULL, 44);

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(12) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pk` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`id`, `url`, `table`, `pk`) VALUES
(8, 'Lite', 'site', 'id'),
(9, 'Admin', 'site', 'id'),
(17, 'Add-Site', 'task', 'id'),
(19, 'Save-Site', 'task', 'id'),
(16, 'Sites-Admin', 'task', 'id'),
(55, 'Dashboard', 'task', 'id'),
(64, 'Forums', 'site', 'id'),
(18, 'Edit-Site', 'task', 'id'),
(20, 'Delete-Site', 'task', 'id'),
(41, 'page', 'task', 'id'),
(11, 'Sites', 'module', 'id'),
(14, 'Pages', 'module', 'id'),
(124, 'YMAASA', 'site', 'id'),
(131, 'gresgsgdeeeeeeeeeeee', 'site', 'id'),
(132, 'ewqewqewq', 'site', 'id');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastlogin` int(10) DEFAULT NULL,
  `created` int(10) NOT NULL,
  `modified` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nick`, `email`, `password`, `lastlogin`, `created`, `modified`) VALUES
(65, 'admin', 'robin@stoker.co.za', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1368470349, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` int(10) NOT NULL,
  `modified` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=69 ;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`, `created`, `modified`) VALUES
(66, 'Super Administrators', 1367540974, 1367540974),
(67, 'Content Administrators', 1367540999, 1367540999),
(68, 'Website Users', 1367540999, 1367540999);

-- --------------------------------------------------------

--
-- Table structure for table `user__user_group`
--

CREATE TABLE IF NOT EXISTS `user__user_group` (
  `user_id` int(12) NOT NULL,
  `user_group_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user__user_group`
--

INSERT INTO `user__user_group` (`user_id`, `user_group_id`) VALUES
(65, 66);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
