-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2014 at 10:29 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `ent`
--

CREATE TABLE IF NOT EXISTS `ent` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_file_id` int(12) DEFAULT NULL,
  `created` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=206 ;

--
-- Dumping data for table `ent`
--

INSERT INTO `ent` (`id`, `name`, `description`, `content_file_id`, `created`, `modified`) VALUES
(10, 'Afghanistan', 'Country of Afghanistan', NULL, '1401035326', NULL),
(11, 'Albania', 'Country of Albania', NULL, '1401035326', NULL),
(12, 'Algeria', 'Country of Algeria', NULL, '1401035326', NULL),
(13, 'Andorra', 'Country of Andorra', NULL, '1401035326', NULL),
(14, 'Angola', 'Country of Angola', NULL, '1401035326', NULL),
(15, 'Antigua & Deps', 'Country of Antigua & Deps', NULL, '1401035326', NULL),
(16, 'Argentina', 'Country of Argentina', NULL, '1401035326', NULL),
(17, 'Armenia', 'Country of Armenia', NULL, '1401035327', NULL),
(18, 'Australia', 'Country of Australia', NULL, '1401035327', NULL),
(19, 'Austria', 'Country of Austria', NULL, '1401035327', NULL),
(20, 'Azerbaijan', 'Country of Azerbaijan', NULL, '1401035327', NULL),
(21, 'Bahamas', 'Country of Bahamas', NULL, '1401035327', NULL),
(22, 'Bahrain', 'Country of Bahrain', NULL, '1401035327', NULL),
(23, 'Bangladesh', 'Country of Bangladesh', NULL, '1401035327', NULL),
(24, 'Barbados', 'Country of Barbados', NULL, '1401035327', NULL),
(25, 'Belarus', 'Country of Belarus', NULL, '1401035327', NULL),
(26, 'Belgium', 'Country of Belgium', NULL, '1401035327', NULL),
(27, 'Belize', 'Country of Belize', NULL, '1401035327', NULL),
(28, 'Benin', 'Country of Benin', NULL, '1401035327', NULL),
(29, 'Bhutan', 'Country of Bhutan', NULL, '1401035327', NULL),
(30, 'Bolivia', 'Country of Bolivia', NULL, '1401035327', NULL),
(31, 'Bosnia Herzegovina', 'Country of Bosnia Herzegovina', NULL, '1401035327', NULL),
(32, 'Botswana', 'Country of Botswana', NULL, '1401035327', NULL),
(33, 'Brazil', 'Country of Brazil', NULL, '1401035327', NULL),
(34, 'Brunei', 'Country of Brunei', NULL, '1401035327', NULL),
(35, 'Bulgaria', 'Country of Bulgaria', NULL, '1401035327', NULL),
(36, 'Burkina', 'Country of Burkina', NULL, '1401035327', NULL),
(37, 'Burundi', 'Country of Burundi', NULL, '1401035327', NULL),
(38, 'Cambodia', 'Country of Cambodia', NULL, '1401035327', NULL),
(39, 'Cameroon', 'Country of Cameroon', NULL, '1401035327', NULL),
(40, 'Canada', 'Country of Canada', NULL, '1401035328', NULL),
(41, 'Cape Verde', 'Country of Cape Verde', NULL, '1401035328', NULL),
(42, 'Central African Rep', 'Country of Central African Rep', NULL, '1401035328', NULL),
(43, 'Chad', 'Country of Chad', NULL, '1401035328', NULL),
(44, 'Chile', 'Country of Chile', NULL, '1401035328', NULL),
(45, 'China', 'Country of China', NULL, '1401035328', NULL),
(46, 'Colombia', 'Country of Colombia', NULL, '1401035328', NULL),
(47, 'Comoros', 'Country of Comoros', NULL, '1401035328', NULL),
(48, 'Congo', 'Country of Congo', NULL, '1401035328', NULL),
(49, 'Congo {Democratic Rep}', 'Country of Congo {Democratic Rep}', NULL, '1401035328', NULL),
(50, 'Costa Rica', 'Country of Costa Rica', NULL, '1401035328', NULL),
(51, 'Croatia', 'Country of Croatia', NULL, '1401035328', NULL),
(52, 'Cuba', 'Country of Cuba', NULL, '1401035328', NULL),
(53, 'Cyprus', 'Country of Cyprus', NULL, '1401035328', NULL),
(54, 'Czech Republic', 'Country of Czech Republic', NULL, '1401035328', NULL),
(55, 'Denmark', 'Country of Denmark', NULL, '1401035328', NULL),
(56, 'Djibouti', 'Country of Djibouti', NULL, '1401035328', NULL),
(57, 'Dominica', 'Country of Dominica', NULL, '1401035328', NULL),
(58, 'Dominican Republic', 'Country of Dominican Republic', NULL, '1401035328', NULL),
(59, 'East Timor', 'Country of East Timor', NULL, '1401035328', NULL),
(60, 'Ecuador', 'Country of Ecuador', NULL, '1401035328', NULL),
(61, 'Egypt', 'Country of Egypt', NULL, '1401035328', NULL),
(62, 'El Salvador', 'Country of El Salvador', NULL, '1401035328', NULL),
(63, 'Equatorial Guinea', 'Country of Equatorial Guinea', NULL, '1401035328', NULL),
(64, 'Eritrea', 'Country of Eritrea', NULL, '1401035329', NULL),
(65, 'Estonia', 'Country of Estonia', NULL, '1401035329', NULL),
(66, 'Ethiopia', 'Country of Ethiopia', NULL, '1401035329', NULL),
(67, 'Fiji', 'Country of Fiji', NULL, '1401035329', NULL),
(68, 'Finland', 'Country of Finland', NULL, '1401035329', NULL),
(69, 'France', 'Country of France', NULL, '1401035329', NULL),
(70, 'Gabon', 'Country of Gabon', NULL, '1401035329', NULL),
(71, 'Gambia', 'Country of Gambia', NULL, '1401035329', NULL),
(72, 'Georgia', 'Country of Georgia', NULL, '1401035329', NULL),
(73, 'Germany', 'Country of Germany', NULL, '1401035329', NULL),
(74, 'Ghana', 'Country of Ghana', NULL, '1401035329', NULL),
(75, 'Greece', 'Country of Greece', NULL, '1401035329', NULL),
(76, 'Grenada', 'Country of Grenada', NULL, '1401035329', NULL),
(77, 'Guatemala', 'Country of Guatemala', NULL, '1401035329', NULL),
(78, 'Guinea', 'Country of Guinea', NULL, '1401035329', NULL),
(79, 'Guinea-Bissau', 'Country of Guinea-Bissau', NULL, '1401035329', NULL),
(80, 'Guyana', 'Country of Guyana', NULL, '1401035329', NULL),
(81, 'Haiti', 'Country of Haiti', NULL, '1401035329', NULL),
(82, 'Honduras', 'Country of Honduras', NULL, '1401035329', NULL),
(83, 'Hungary', 'Country of Hungary', NULL, '1401035329', NULL),
(84, 'Iceland', 'Country of Iceland', NULL, '1401035329', NULL),
(85, 'India', 'Country of India', NULL, '1401035329', NULL),
(86, 'Indonesia', 'Country of Indonesia', NULL, '1401035329', NULL),
(87, 'Iran', 'Country of Iran', NULL, '1401035330', NULL),
(88, 'Iraq', 'Country of Iraq', NULL, '1401035330', NULL),
(89, 'Ireland {Republic}', 'Country of Ireland {Republic}', NULL, '1401035330', NULL),
(90, 'Israel', 'Country of Israel', NULL, '1401035330', NULL),
(91, 'Italy', 'Country of Italy', NULL, '1401035330', NULL),
(92, 'Ivory Coast', 'Country of Ivory Coast', NULL, '1401035330', NULL),
(93, 'Jamaica', 'Country of Jamaica', NULL, '1401035330', NULL),
(94, 'Japan', 'Country of Japan', NULL, '1401035330', NULL),
(95, 'Jordan', 'Country of Jordan', NULL, '1401035330', NULL),
(96, 'Kazakhstan', 'Country of Kazakhstan', NULL, '1401035330', NULL),
(97, 'Kenya', 'Country of Kenya', NULL, '1401035330', NULL),
(98, 'Kiribati', 'Country of Kiribati', NULL, '1401035330', NULL),
(99, 'Korea North', 'Country of Korea North', NULL, '1401035330', NULL),
(100, 'Korea South', 'Country of Korea South', NULL, '1401035330', NULL),
(101, 'Kosovo', 'Country of Kosovo', NULL, '1401035330', NULL),
(102, 'Kuwait', 'Country of Kuwait', NULL, '1401035330', NULL),
(103, 'Kyrgyzstan', 'Country of Kyrgyzstan', NULL, '1401035330', NULL),
(104, 'Laos', 'Country of Laos', NULL, '1401035330', NULL),
(105, 'Latvia', 'Country of Latvia', NULL, '1401035330', NULL),
(106, 'Lebanon', 'Country of Lebanon', NULL, '1401035330', NULL),
(107, 'Lesotho', 'Country of Lesotho', NULL, '1401035330', NULL),
(108, 'Liberia', 'Country of Liberia', NULL, '1401035330', NULL),
(109, 'Libya', 'Country of Libya', NULL, '1401035331', NULL),
(110, 'Liechtenstein', 'Country of Liechtenstein', NULL, '1401035331', NULL),
(111, 'Lithuania', 'Country of Lithuania', NULL, '1401035331', NULL),
(112, 'Luxembourg', 'Country of Luxembourg', NULL, '1401035331', NULL),
(113, 'Macedonia', 'Country of Macedonia', NULL, '1401035331', NULL),
(114, 'Madagascar', 'Country of Madagascar', NULL, '1401035331', NULL),
(115, 'Malawi', 'Country of Malawi', NULL, '1401035331', NULL),
(116, 'Malaysia', 'Country of Malaysia', NULL, '1401035331', NULL),
(117, 'Maldives', 'Country of Maldives', NULL, '1401035331', NULL),
(118, 'Mali', 'Country of Mali', NULL, '1401035331', NULL),
(119, 'Malta', 'Country of Malta', NULL, '1401035331', NULL),
(120, 'Marshall Islands', 'Country of Marshall Islands', NULL, '1401035331', NULL),
(121, 'Mauritania', 'Country of Mauritania', NULL, '1401035331', NULL),
(122, 'Mauritius', 'Country of Mauritius', NULL, '1401035331', NULL),
(123, 'Mexico', 'Country of Mexico', NULL, '1401035331', NULL),
(124, 'Micronesia', 'Country of Micronesia', NULL, '1401035331', NULL),
(125, 'Moldova', 'Country of Moldova', NULL, '1401035331', NULL),
(126, 'Monaco', 'Country of Monaco', NULL, '1401035331', NULL),
(127, 'Mongolia', 'Country of Mongolia', NULL, '1401035331', NULL),
(128, 'Montenegro', 'Country of Montenegro', NULL, '1401035331', NULL),
(129, 'Morocco', 'Country of Morocco', NULL, '1401035331', NULL),
(130, 'Mozambique', 'Country of Mozambique', NULL, '1401035331', NULL),
(131, 'Myanmar, {Burma}', 'Country of Myanmar, {Burma}', NULL, '1401035331', NULL),
(132, 'Namibia', 'Country of Namibia', NULL, '1401035332', NULL),
(133, 'Nauru', 'Country of Nauru', NULL, '1401035332', NULL),
(134, 'Nepal', 'Country of Nepal', NULL, '1401035332', NULL),
(135, 'Netherlands', 'Country of Netherlands', NULL, '1401035332', NULL),
(136, 'New Zealand', 'Country of New Zealand', NULL, '1401035332', NULL),
(137, 'Nicaragua', 'Country of Nicaragua', NULL, '1401035332', NULL),
(138, 'Niger', 'Country of Niger', NULL, '1401035332', NULL),
(139, 'Nigeria', 'Country of Nigeria', NULL, '1401035332', NULL),
(140, 'Norway', 'Country of Norway', NULL, '1401035332', NULL),
(141, 'Oman', 'Country of Oman', NULL, '1401035332', NULL),
(142, 'Pakistan', 'Country of Pakistan', NULL, '1401035332', NULL),
(143, 'Palau', 'Country of Palau', NULL, '1401035332', NULL),
(144, 'Panama', 'Country of Panama', NULL, '1401035332', NULL),
(145, 'Papua New Guinea', 'Country of Papua New Guinea', NULL, '1401035332', NULL),
(146, 'Paraguay', 'Country of Paraguay', NULL, '1401035332', NULL),
(147, 'Peru', 'Country of Peru', NULL, '1401035332', NULL),
(148, 'Philippines', 'Country of Philippines', NULL, '1401035332', NULL),
(149, 'Poland', 'Country of Poland', NULL, '1401035332', NULL),
(150, 'Portugal', 'Country of Portugal', NULL, '1401035332', NULL),
(151, 'Qatar', 'Country of Qatar', NULL, '1401035332', NULL),
(152, 'Romania', 'Country of Romania', NULL, '1401035332', NULL),
(153, 'Russian Federation', 'Country of Russian Federation', NULL, '1401035332', NULL),
(154, 'Rwanda', 'Country of Rwanda', NULL, '1401035333', NULL),
(155, 'St Kitts & Nevis', 'Country of St Kitts & Nevis', NULL, '1401035333', NULL),
(156, 'St Lucia', 'Country of St Lucia', NULL, '1401035333', NULL),
(157, 'Saint Vincent & the Grenadines', 'Country of Saint Vincent & the Grenadines', NULL, '1401035333', NULL),
(158, 'Samoa', 'Country of Samoa', NULL, '1401035333', NULL),
(159, 'San Marino', 'Country of San Marino', NULL, '1401035333', NULL),
(160, 'Sao Tome & Principe', 'Country of Sao Tome & Principe', NULL, '1401035333', NULL),
(161, 'Saudi Arabia', 'Country of Saudi Arabia', NULL, '1401035333', NULL),
(162, 'Senegal', 'Country of Senegal', NULL, '1401035333', NULL),
(163, 'Serbia', 'Country of Serbia', NULL, '1401035333', NULL),
(164, 'Seychelles', 'Country of Seychelles', NULL, '1401035333', NULL),
(165, 'Sierra Leone', 'Country of Sierra Leone', NULL, '1401035333', NULL),
(166, 'Singapore', 'Country of Singapore', NULL, '1401035333', NULL),
(167, 'Slovakia', 'Country of Slovakia', NULL, '1401035333', NULL),
(168, 'Slovenia', 'Country of Slovenia', NULL, '1401035333', NULL),
(169, 'Solomon Islands', 'Country of Solomon Islands', NULL, '1401035333', NULL),
(170, 'Somalia', 'Country of Somalia', NULL, '1401035333', NULL),
(171, 'South Africa', 'Country of South Africa', NULL, '1401035333', NULL),
(172, 'South Sudan', 'Country of South Sudan', NULL, '1401035333', NULL),
(173, 'Spain', 'Country of Spain', NULL, '1401035333', NULL),
(174, 'Sri Lanka', 'Country of Sri Lanka', NULL, '1401035333', NULL),
(175, 'Sudan', 'Country of Sudan', NULL, '1401035333', NULL),
(176, 'Suriname', 'Country of Suriname', NULL, '1401035333', NULL),
(177, 'Swaziland', 'Country of Swaziland', NULL, '1401035333', NULL),
(178, 'Sweden', 'Country of Sweden', NULL, '1401035334', NULL),
(179, 'Switzerland', 'Country of Switzerland', NULL, '1401035334', NULL),
(180, 'Syria', 'Country of Syria', NULL, '1401035334', NULL),
(181, 'Taiwan', 'Country of Taiwan', NULL, '1401035334', NULL),
(182, 'Tajikistan', 'Country of Tajikistan', NULL, '1401035334', NULL),
(183, 'Tanzania', 'Country of Tanzania', NULL, '1401035334', NULL),
(184, 'Thailand', 'Country of Thailand', NULL, '1401035334', NULL),
(185, 'Togo', 'Country of Togo', NULL, '1401035334', NULL),
(186, 'Tonga', 'Country of Tonga', NULL, '1401035334', NULL),
(187, 'Trinidad & Tobago', 'Country of Trinidad & Tobago', NULL, '1401035334', NULL),
(188, 'Tunisia', 'Country of Tunisia', NULL, '1401035334', NULL),
(189, 'Turkey', 'Country of Turkey', NULL, '1401035334', NULL),
(190, 'Turkmenistan', 'Country of Turkmenistan', NULL, '1401035334', NULL),
(191, 'Tuvalu', 'Country of Tuvalu', NULL, '1401035334', NULL),
(192, 'Uganda', 'Country of Uganda', NULL, '1401035334', NULL),
(193, 'Ukraine', 'Country of Ukraine', NULL, '1401035334', NULL),
(194, 'United Arab Emirates', 'Country of United Arab Emirates', NULL, '1401035334', NULL),
(195, 'United Kingdom', 'Country of United Kingdom', NULL, '1401035334', NULL),
(196, 'United States', 'Country of United States', NULL, '1401035334', NULL),
(197, 'Uruguay', 'Country of Uruguay', NULL, '1401035334', NULL),
(198, 'Uzbekistan', 'Country of Uzbekistan', NULL, '1401035334', NULL),
(199, 'Vanuatu', 'Country of Vanuatu', NULL, '1401035334', NULL),
(200, 'Vatican City', 'Country of Vatican City', NULL, '1401035334', NULL),
(201, 'Venezuela', 'Country of Venezuela', NULL, '1401035335', NULL),
(202, 'Vietnam', 'Country of Vietnam', NULL, '1401035335', NULL),
(203, 'Yemen', 'Country of Yemen', NULL, '1401035335', NULL),
(204, 'Zambia', 'Country of Zambia', NULL, '1401035335', NULL),
(205, 'Zimbabwe', 'Country of Zimbabwe', NULL, '1401035335', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ent_rel`
--

CREATE TABLE IF NOT EXISTS `ent_rel` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `id1` int(12) DEFAULT NULL,
  `id2` int(12) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content_file_id` int(12) DEFAULT NULL,
  `created` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ent_rel`
--

INSERT INTO `ent_rel` (`id`, `id1`, `id2`, `name`, `description`, `content_file_id`, `created`, `modified`) VALUES
(1, 1, 2, 'Google develops the Android operating system.', 'Currently on version 4, the OS really comes into own on devices like the S4.', NULL, '1377214267', NULL),
(2, 2, 3, 'Android was used on Samsung phones and tablets.', 'Samsung used Android for the operating system of their smart phones and tablets.', NULL, '1377214267', NULL),
(3, 4, 1, 'Google Maps is a mapping product developed by Google.', 'It displays a map and allows users to get directions, see a street view, see places nearby and draw custom shapes and routes.', NULL, '1377214503', NULL),
(4, 1, 5, 'Google Calendar is developed by google.', 'Allows for scheduling and team coordination and much more. Integrates with GMail.', NULL, '1377275888', NULL),
(5, 5, 3, 'Google Calendar is featured on some Samsung devices.', 'The app integrates with all your online items.', NULL, '1377276188', NULL),
(6, 3, 2, 'Samsung proprietary Android apps.', 'Samsung devices that use Android come with a host of Android apps exclusive to Samsung devices. From a Samsung only app store with additional apps to video, music and more.', NULL, '1377276905', NULL),
(7, 6, 2, 'The Samsung Galaxy S4 uses Android for the OS.', NULL, NULL, '1399665669', NULL),
(8, 6, 3, 'The Galaxy S4 is manufactured by Samsung.', NULL, NULL, '1399665669', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=181 ;

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
(164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(172, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

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
(56, 'Menu', 'menu', 'mod.menu.php', 'b65573df2fb6bd349278d490c1fd3749eea79f33', 'menu', 'public', '1321566423', NULL),
(57, 'Entity', 'entity', 'mod.entity.php', 'adc4b25ee284f0780e39bc7a63393381dcd6eea0', 'entity', 'public', '1400091921', NULL);

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
(9, 0, 0, 0, 66, 0, ''),
(9, 0, 0, 0, 68, 0, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=125 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `folder`, `default`, `default_task`, `default_layout`, `domain`, `meta_id`, `logo_file_id`, `access`, `created`, `modified`) VALUES
(8, 'Lite', 'g4ud9so3i5', NULL, 41, 46, 'webbuilder.co.za', 2, NULL, 'public', '1320787207', '1363852143'),
(9, 'Admin', 'pc6r9wi4hd', NULL, 55, 49, NULL, 1, NULL, 'rights', '1320787263', '1380908680'),
(64, 'WebBuilder Forums', 'h27si6odsn', NULL, 41, 46, 'www.webbuilder.co.za', 11, NULL, 'login', '1324058349', '1363896180'),
(124, 'YMAA South Africa', 'fy3pbiccy7nm8', 1, 41, 46, 'www.ymaasa.co.za', 148, NULL, 'public', '1363892197', '1363894921');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

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
(57, 56, 'Display', 'display', 'public', '1321566754', NULL),
(58, 57, 'Entity List', 'AdminList', 'public', '1400095488', NULL),
(59, 57, 'Add Entity', 'add', 'public', '1400417564', NULL),
(60, 57, 'Save Entity', 'save', 'public', '1400420198', NULL),
(61, 57, 'Edit Entity', 'edit', 'public', '1400924275', NULL),
(62, 57, 'Delete Entity', 'delete', 'public', '1400924275', NULL);

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foreignid` int(12) NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pk` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`id`, `foreignid`, `url`, `table`, `pk`) VALUES
(1, 8, 'Lite', 'site', 'id'),
(2, 9, 'Admin', 'site', 'id'),
(3, 17, 'Add-Site', 'task', 'id'),
(4, 19, 'Save-Site', 'task', 'id'),
(5, 16, 'Sites-Admin', 'task', 'id'),
(6, 55, 'Dashboard', 'task', 'id'),
(7, 64, 'Forums', 'site', 'id'),
(8, 18, 'Edit-Site', 'task', 'id'),
(9, 20, 'Delete-Site', 'task', 'id'),
(10, 41, 'page', 'task', 'id'),
(11, 11, 'Sites', 'module', 'id'),
(12, 14, 'Pages', 'module', 'id'),
(13, 124, 'YMAASA', 'site', 'id'),
(14, 21, 'Modules-Admin', 'task', 'id'),
(15, 57, 'Entity', 'module', 'id'),
(16, 58, 'Entity-Admin', 'task', 'id'),
(17, 59, 'Add-Entity', 'task', 'id'),
(18, 60, 'Save-Entity', 'task', 'id'),
(19, 61, 'Edit-Entity', 'task', 'id'),
(20, 62, 'Delete-Entity', 'task', 'id');

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
(65, 'admin', 'robin@stoker.co.za', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1409257670, 0, NULL);

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
