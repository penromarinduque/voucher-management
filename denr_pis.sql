-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2017 at 07:34 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `denr_pis`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail_log`
--

CREATE TABLE `audit_trail_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action_type` varchar(20) NOT NULL,
  `window_page` varchar(50) NOT NULL,
  `window_type` varchar(5) NOT NULL,
  `module_code` varchar(50) NOT NULL,
  `remarks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `audit_trail_log`
--

INSERT INTO `audit_trail_log` (`id`, `user_id`, `date_action`, `action_type`, `window_page`, `window_type`, `module_code`, `remarks`) VALUES
(1, 1, '2017-08-09 02:56:56', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(2, 1, '2017-08-09 07:50:01', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(3, 1, '2017-08-09 08:07:55', 'ADD', 'Division', 'TM', 'PIS', 'Added Division Office of the PENRO'),
(4, 1, '2017-08-09 08:08:17', 'ADD', 'Division', 'TM', 'PIS', 'Added Division Management Services Division'),
(5, 1, '2017-08-09 08:08:54', 'ADD', 'Division', 'TM', 'PIS', 'Added Division Technical Services Division'),
(6, 1, '2017-08-09 08:09:19', 'ADD', 'Division', 'TM', 'PIS', 'Added Division Protected Area'),
(7, 1, '2017-08-09 08:11:50', 'ADD', 'Section', 'TM', 'PIS', 'Added Section Conservation & Development Section'),
(8, 1, '2017-08-09 08:12:14', 'ADD', 'Section', 'TM', 'PIS', 'Added Section Regulation & Enforcement Section'),
(9, 1, '2017-08-09 09:01:25', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator'),
(10, 1, '2017-08-09 09:05:03', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(11, 1, '2017-08-09 09:05:29', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator'),
(12, 1, '2017-08-09 09:42:04', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(13, 1, '2017-08-09 09:46:37', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(14, 1, '2017-08-09 10:17:01', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(15, 1, '2017-08-09 10:17:06', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator'),
(16, 1, '2017-08-09 10:28:28', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator'),
(17, 1, '2017-08-15 06:25:08', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(18, 1, '2017-08-15 06:26:55', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Forest Management & Conservation Unit'),
(19, 1, '2017-08-15 06:27:14', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Biodiversity Conservation Unit'),
(20, 1, '2017-08-15 06:27:36', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Coastal Resource & Foreshore Management Unit'),
(21, 1, '2017-08-15 06:28:10', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Surveillance & Intelligence Unit'),
(22, 1, '2017-08-15 06:28:33', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Forest & Water Resource Utilization Unit'),
(23, 1, '2017-08-15 06:29:01', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Compliance, Monitoring & Investigation Unit'),
(24, 1, '2017-08-15 06:29:28', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Licenses, Patents & Deeds Unit'),
(25, 1, '2017-08-15 06:29:45', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Wildlife Resource Permitting Unit'),
(26, 1, '2017-08-15 06:29:59', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Survey & Mapping Unit'),
(27, 1, '2017-08-15 06:31:15', 'ADD', 'Section', 'TM', 'PIS', 'Added Section Administrative Section'),
(28, 1, '2017-08-15 06:31:39', 'ADD', 'Section', 'TM', 'PIS', 'Added Section Planning & Management Section'),
(29, 1, '2017-08-15 06:41:29', 'ADD', 'Section', 'TM', 'PIS', 'Added Section Finance Section'),
(30, 1, '2017-08-15 06:44:11', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Personnel Unit'),
(31, 1, '2017-08-15 06:44:26', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Cashiering Unit'),
(32, 1, '2017-08-15 06:44:39', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit General Services Unit'),
(33, 1, '2017-08-15 06:44:53', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Records Management Unit'),
(34, 1, '2017-08-15 06:45:13', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Planning & Programming Unit'),
(35, 1, '2017-08-15 08:47:15', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(36, 1, '2017-08-15 08:47:49', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Monitoring & Evaluation Unit'),
(37, 1, '2017-08-15 08:48:12', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Information & Communication Technology Unit'),
(38, 1, '2017-08-15 08:48:25', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Accounting Unit'),
(39, 1, '2017-08-15 08:48:36', 'ADD', 'Unit', 'TM', 'PIS', 'Added Unit Budget Unit'),
(40, 1, '2017-08-15 08:50:10', 'ADD', 'Position', 'TM', 'PIS', 'Added Position PENR Officer'),
(41, 1, '2017-08-15 08:50:50', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Chief, Technical Services Division'),
(42, 1, '2017-08-15 08:51:08', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Chief, Management Services Division'),
(43, 1, '2017-08-15 08:51:37', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Supervising ECOMS/ Protected Area Superintendent'),
(44, 1, '2017-08-15 08:52:08', 'EDIT', 'Position', 'TM', 'PIS', 'Modified Position OIC, PENR Officer'),
(45, 1, '2017-08-15 08:52:19', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Accountant III'),
(46, 1, '2017-08-15 08:52:28', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Planning Officer III'),
(47, 1, '2017-08-15 08:52:40', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Supervising Ecosystems Management Specialist'),
(48, 1, '2017-08-15 08:53:16', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Engineer II'),
(49, 1, '2017-08-15 08:53:26', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Information System Analyst II'),
(50, 1, '2017-08-15 08:53:37', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Community Development Officer II'),
(51, 1, '2017-08-15 08:53:57', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Land Management Officer II'),
(52, 1, '2017-08-15 08:54:08', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Ecosystems Management Specialist II'),
(53, 1, '2017-08-15 08:54:21', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Administrative Aide VI'),
(54, 1, '2017-08-15 08:54:34', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Administrative Officer IV'),
(55, 1, '2017-08-15 08:54:43', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Utility Worker II'),
(56, 1, '2017-08-15 08:54:53', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Administrative Officer I'),
(57, 1, '2017-08-15 08:55:01', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Credit Officer I'),
(58, 1, '2017-08-15 08:55:10', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Administrative Assistant I'),
(59, 1, '2017-08-15 08:55:24', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Planning Officer I'),
(60, 1, '2017-08-15 09:01:05', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Administrative Assistant II'),
(61, 1, '2017-08-15 09:01:16', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Senior Ecosystems Management Specialist'),
(62, 1, '2017-08-15 09:01:25', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Forester II'),
(63, 1, '2017-08-15 09:01:33', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Forest Technician II'),
(64, 1, '2017-08-15 09:02:19', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Mathematician Aide II'),
(65, 1, '2017-08-15 09:02:30', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Forester I'),
(66, 1, '2017-08-15 09:02:45', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Forest Technician I'),
(67, 1, '2017-08-15 09:02:54', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Forest Ranger'),
(68, 1, '2017-08-15 09:03:05', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Special Investigator I'),
(69, 1, '2017-08-15 09:03:19', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Land Management Officer I'),
(70, 1, '2017-08-15 09:03:29', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Land Management Inspector'),
(71, 1, '2017-08-15 09:03:48', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Utility Worker I'),
(72, 1, '2017-08-15 09:03:57', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Engineering Aide'),
(73, 1, '2017-08-15 09:04:08', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Park Maintenance Foreman'),
(74, 1, '2017-08-15 09:05:33', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(75, 1, '2017-08-15 09:07:20', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee felyariola'),
(76, 1, '2017-08-15 09:12:20', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(77, 1, '2017-08-16 00:45:25', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(78, 1, '2017-08-16 00:53:09', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(79, 1, '2017-08-16 00:53:35', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(80, 1, '2017-08-16 05:42:34', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(81, 1, '2017-08-16 06:33:57', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(82, 1, '2017-08-16 06:34:18', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(83, 1, '2017-08-16 06:34:38', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(84, 1, '2017-08-16 06:34:41', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(85, 1, '2017-08-16 06:34:46', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(86, 1, '2017-08-16 06:35:58', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(87, 1, '2017-08-16 06:36:14', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(88, 1, '2017-08-16 06:38:35', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(89, 1, '2017-08-16 06:38:45', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(90, 1, '2017-08-16 06:41:56', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(91, 1, '2017-08-16 06:41:56', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee admin'),
(92, 1, '2017-08-16 07:29:37', 'ADD', 'Travel Order', 'ACT', 'PIS', 'Added Travel Order TRV#000005'),
(93, 1, '2017-08-16 08:39:09', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(94, 1, '2017-08-16 08:45:18', 'APPROVE', 'Travel Order Approval', 'ACT', 'PIS', 'Approved Travel Order 1'),
(95, 1, '2017-08-16 08:58:42', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee niloalcober'),
(96, 1, '2017-08-16 09:02:27', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee efrendelosreyes'),
(97, 1, '2017-08-16 09:09:15', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee gemdelosreyes'),
(98, 1, '2017-08-16 09:24:45', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee tonydiaz'),
(99, 1, '2017-08-16 09:30:07', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee randyestrella'),
(100, 1, '2017-08-16 09:32:17', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee maloulastra'),
(101, 1, '2017-08-16 09:33:50', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee alethbundoc'),
(102, 9, '2017-08-16 09:34:59', 'LOGIN', 'Login', 'O', 'LOG', 'Login as User/Employee'),
(103, 1, '2017-08-16 09:43:08', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Administrative Aide IV'),
(104, 1, '2017-08-16 09:44:35', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee rommmariposque'),
(105, 1, '2017-08-16 09:45:39', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee lorenapernia'),
(106, 1, '2017-08-16 09:46:45', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee sallyrioveros'),
(107, 1, '2017-08-16 09:47:33', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee roderickvillanueva'),
(108, 1, '2017-08-16 09:47:48', 'EDIT', 'Division', 'TM', 'PIS', 'Modified Division Protected Area Office'),
(109, 1, '2017-08-16 09:51:15', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee leopoldolucernas'),
(110, 1, '2017-08-16 09:52:23', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee chandaosicos'),
(111, 1, '2017-08-16 09:53:40', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee randypantoja'),
(112, 1, '2017-08-16 10:05:18', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Forester III'),
(113, 1, '2017-08-16 10:05:59', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee florencepastoral'),
(114, 1, '2017-08-16 10:07:24', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee oliverminay'),
(115, 1, '2017-08-16 10:08:36', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee arlenejamilla'),
(116, 1, '2017-08-16 10:09:57', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee verniemonterey'),
(117, 1, '2017-08-16 10:11:41', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee ernestopizarra'),
(118, 1, '2017-08-16 10:12:37', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee terencerecto'),
(119, 1, '2017-08-16 10:13:44', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee jameelbronce'),
(120, 1, '2017-08-16 10:16:30', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee michaelmaranan'),
(121, 1, '2017-08-16 10:17:40', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee dannycortiguerra'),
(122, 1, '2017-08-16 10:18:26', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee jeanbronce'),
(123, 1, '2017-08-16 10:19:12', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee anidelfeliciano'),
(124, 1, '2017-08-16 10:20:39', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee rickypereda'),
(125, 1, '2017-08-16 10:28:42', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee juliusmanoos'),
(126, 1, '2017-08-16 10:30:22', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee lucyricafrente'),
(127, 1, '2017-08-16 10:33:06', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee sherwinvillavicencio'),
(128, 1, '2017-08-16 10:34:46', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee jhonnamedenilla'),
(129, 1, '2017-08-16 10:36:55', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee drewaldovino'),
(130, 1, '2017-08-16 10:37:54', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee felyariola'),
(131, 1, '2017-08-16 10:39:03', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee bessieconstantino'),
(132, 1, '2017-08-16 10:42:39', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee noeldifuntorum'),
(133, 1, '2017-08-16 10:43:48', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee mariceldonato'),
(134, 1, '2017-08-16 10:45:19', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee jundeefandialan'),
(135, 1, '2017-08-16 10:45:41', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee leopoldolucernas'),
(136, 1, '2017-08-16 10:46:39', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee erickaladeras'),
(137, 1, '2017-08-16 10:47:53', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee anthonylasic'),
(138, 1, '2017-08-16 10:48:09', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee erickaladeras'),
(139, 1, '2017-08-16 10:48:26', 'EDIT', 'User', 'TM', 'PIS', 'Modified User/Employee jundeefandialan'),
(140, 1, '2017-08-16 10:49:55', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee brianleano'),
(141, 1, '2017-08-16 10:51:04', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee francolivelo'),
(142, 1, '2017-08-16 10:52:31', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee andrewmagculang'),
(143, 1, '2017-08-16 10:53:28', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee dannymartinez'),
(144, 1, '2017-08-16 10:54:24', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee heidyoyong'),
(145, 1, '2017-08-16 10:55:28', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee mayparreno'),
(146, 1, '2017-08-16 10:56:58', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee jopastoral'),
(147, 1, '2017-08-16 10:57:50', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee corapelaez'),
(148, 1, '2017-08-16 10:58:50', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee woweeperegrin'),
(149, 1, '2017-08-16 10:59:58', 'ADD', 'Position', 'TM', 'PIS', 'Added Position Ecosystems Management Specialist I'),
(150, 1, '2017-08-16 11:00:36', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee alvinpergis'),
(151, 1, '2017-08-16 11:01:34', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee lindarellis'),
(152, 1, '2017-08-16 11:02:27', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee lorelynsaet'),
(153, 1, '2017-08-16 11:03:36', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee michaelsualog'),
(154, 1, '2017-08-16 11:04:44', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee carlowatiwat'),
(155, 1, '2017-08-16 11:06:08', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee aymeehdiaz'),
(156, 1, '2017-08-16 11:07:11', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee cynthialozano'),
(157, 1, '2017-08-16 11:09:13', 'ADD', 'User', 'TM', 'PIS', 'Registered User/Employee lornajamola'),
(158, 1, '2017-08-16 11:09:19', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator'),
(159, 56, '2017-08-16 11:09:32', 'LOGIN', 'Login', 'O', 'LOG', 'Login as System Administrator'),
(160, 1, '2017-08-18 02:28:27', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator'),
(161, 1, '2017-08-18 02:28:33', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(162, 1, '2017-08-18 02:30:27', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator'),
(163, 34, '2017-08-18 02:30:33', 'LOGIN', 'Login', 'O', 'LOG', 'Login as User/Employee'),
(164, 34, '2017-08-18 02:31:06', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as User/Employee'),
(165, 1, '2017-09-03 08:51:10', 'LOGIN', 'Login', 'O', 'LOG', 'Login as Super Administrator'),
(166, 1, '2017-09-03 10:44:29', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 2'),
(167, 1, '2017-09-03 10:44:30', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 1'),
(168, 1, '2017-09-03 10:50:05', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 54'),
(169, 1, '2017-09-03 10:50:05', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 55'),
(170, 1, '2017-09-03 10:50:05', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 50'),
(171, 1, '2017-09-03 10:50:05', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 4'),
(172, 1, '2017-09-03 12:08:40', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 54'),
(173, 1, '2017-09-03 12:08:40', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 55'),
(174, 1, '2017-09-03 12:08:40', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 50'),
(175, 1, '2017-09-03 12:08:40', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 4'),
(176, 1, '2017-09-03 12:36:24', 'EDIT', 'Travel Order', 'ACT', 'PIS', 'Modified Travel Order TRV#000005'),
(177, 1, '2017-09-03 13:30:37', 'EDIT', 'Position', 'TM', 'PIS', 'Modified Position Accountant III'),
(178, 1, '2017-09-03 13:30:54', 'EDIT', 'Position', 'TM', 'PIS', 'Modified Position Accountant III'),
(179, 1, '2017-09-03 14:12:15', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 54'),
(180, 1, '2017-09-03 14:12:15', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 55'),
(181, 1, '2017-09-03 14:12:15', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 50'),
(182, 1, '2017-09-03 14:12:23', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 54'),
(183, 1, '2017-09-03 14:18:40', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 54'),
(184, 1, '2017-09-03 14:18:40', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 55'),
(185, 1, '2017-09-03 14:18:41', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 50'),
(186, 1, '2017-09-03 14:18:41', 'ADD', 'Travel Order Signatory', 'AM', 'PIS', 'Added Travel Order Signatory 4'),
(187, 1, '2017-09-03 14:26:51', 'EDIT', 'Travel Order', 'ACT', 'PIS', 'Modified Travel Order TRV#000005'),
(188, 1, '2017-09-03 14:27:02', 'EDIT', 'Travel Order', 'ACT', 'PIS', 'Modified Travel Order TRV#000005'),
(189, 1, '2017-09-03 14:43:14', 'RECOMMEND', 'Travel Order Approval', 'ACT', 'PIS', 'Recommended Travel Order 1'),
(190, 1, '2017-09-03 14:43:35', 'APPROVE', 'Travel Order Approval', 'ACT', 'PIS', 'Approved Travel Order 1'),
(191, 1, '2017-09-03 14:44:24', 'RECOMMEND', 'Travel Order Approval', 'ACT', 'PIS', 'Recommended Travel Order 1'),
(192, 1, '2017-09-03 14:45:36', 'RECOMMEND', 'Travel Order Approval', 'ACT', 'PIS', 'Recommended Travel Order 1'),
(193, 1, '2017-09-03 14:47:05', 'APPROVE', 'Travel Order Approval', 'ACT', 'PIS', 'Approved Travel Order 1'),
(194, 1, '2017-09-03 15:03:51', 'RECOMMEND', 'Travel Order Approval', 'ACT', 'PIS', 'Recommended Travel Order 1'),
(195, 1, '2017-09-03 15:04:06', 'APPROVE', 'Travel Order Approval', 'ACT', 'PIS', 'Approved Travel Order 1'),
(196, 1, '2017-09-03 15:30:42', 'RECOMMEND', 'Travel Order Approval', 'ACT', 'PIS', 'Recommended Travel Order 1'),
(197, 1, '2017-09-03 15:31:25', 'APPROVE', 'Travel Order Approval', 'ACT', 'PIS', 'Approved Travel Order 1'),
(198, 1, '2017-09-03 15:45:52', 'LOGOUT', 'Logout', 'O', 'LOG', 'Logout as Super Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `civil_service_eligibility`
--

CREATE TABLE `civil_service_eligibility` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `career_service` varchar(200) DEFAULT 'N/A',
  `rating` varchar(10) DEFAULT 'N/A',
  `examination_date` varchar(20) DEFAULT 'N/A',
  `examination_place` varchar(200) DEFAULT 'N/A',
  `license_number` varchar(50) DEFAULT 'N/A',
  `license_date_validity` varchar(20) DEFAULT 'N/A',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `educational_background`
--

CREATE TABLE `educational_background` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `level` varchar(100) DEFAULT 'N/A',
  `school_name` varchar(200) DEFAULT 'N/A',
  `basic_education_degree_course` varchar(200) DEFAULT 'N/A',
  `poa_from` varchar(5) DEFAULT 'N/A',
  `poa_to` varchar(5) DEFAULT 'N/A',
  `highest_level_units_earned` varchar(100) DEFAULT 'N/A',
  `year_graduated` varchar(5) DEFAULT 'N/A',
  `scholarship_academic_honors_received` varchar(100) DEFAULT 'N/A',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_division`
--

CREATE TABLE `employee_division` (
  `id` int(11) NOT NULL,
  `division` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_division`
--

INSERT INTO `employee_division` (`id`, `division`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Office of the PENRO', 1, '2017-08-09 08:07:54', NULL, NULL),
(2, 'Management Services Division', 1, '2017-08-09 08:08:17', NULL, NULL),
(3, 'Technical Services Division', 1, '2017-08-09 08:08:54', NULL, NULL),
(4, 'Protected Area Office', 1, '2017-08-09 08:09:19', 1, '2017-08-16 09:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `employee_position`
--

CREATE TABLE `employee_position` (
  `id` int(11) NOT NULL,
  `position_title` varchar(100) NOT NULL,
  `position_description` varchar(300) NOT NULL,
  `position_type` varchar(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_position`
--

INSERT INTO `employee_position` (`id`, `position_title`, `position_description`, `position_type`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'OIC, PENR Officer', 'OIC, PENR Officer', '1', 1, '2017-08-15 08:50:10', 1, '2017-09-03 13:20:14'),
(2, 'Chief, Technical Services Division', 'Chief, Technical Services Division', '2', 1, '2017-08-15 08:50:50', NULL, '2017-09-03 13:20:16'),
(3, 'Chief, Management Services Division', 'Chief, Management Services Division', '2', 1, '2017-08-15 08:51:08', NULL, '2017-09-03 13:20:22'),
(4, 'Supervising ECOMS/ Protected Area Superintendent', 'Supervising ECOMS/ Protected Area Superintendent', '2', 1, '2017-08-15 08:51:37', NULL, '2017-09-03 13:20:26'),
(5, 'Accountant III', 'Accountant III', '3', 1, '2017-08-15 08:52:19', 1, '2017-09-03 13:30:53'),
(6, 'Planning Officer III', 'Planning Officer III', '3', 1, '2017-08-15 08:52:28', NULL, '2017-09-03 13:20:06'),
(7, 'Supervising Ecosystems Management Specialist', 'Supervising Ecosystems Management Specialist', '3', 1, '2017-08-15 08:52:40', NULL, '2017-09-03 13:20:06'),
(8, 'Engineer II', 'Engineer II', '3', 1, '2017-08-15 08:53:16', NULL, '2017-09-03 13:20:06'),
(9, 'Information System Analyst II', 'Information System Analyst II', '3', 1, '2017-08-15 08:53:26', NULL, '2017-09-03 13:20:06'),
(10, 'Community Development Officer II', 'Community Development Officer II', '3', 1, '2017-08-15 08:53:37', NULL, '2017-09-03 13:20:06'),
(11, 'Land Management Officer II', 'Land Management Officer II', '3', 1, '2017-08-15 08:53:57', NULL, '2017-09-03 13:20:06'),
(12, 'Ecosystems Management Specialist II', 'Ecosystems Management Specialist II', '3', 1, '2017-08-15 08:54:08', NULL, '2017-09-03 13:20:06'),
(13, 'Administrative Aide VI', 'Administrative Aide VI', '3', 1, '2017-08-15 08:54:21', NULL, '2017-09-03 13:20:06'),
(14, 'Administrative Officer IV', 'Administrative Officer IV', '3', 1, '2017-08-15 08:54:34', NULL, '2017-09-03 13:20:06'),
(15, 'Utility Worker II', 'Utility Worker II', '3', 1, '2017-08-15 08:54:43', NULL, '2017-09-03 13:20:06'),
(16, 'Administrative Officer I', 'Administrative Officer I', '3', 1, '2017-08-15 08:54:53', NULL, '2017-09-03 13:20:06'),
(17, 'Credit Officer I', 'Credit Officer I', '3', 1, '2017-08-15 08:55:01', NULL, '2017-09-03 13:20:06'),
(18, 'Administrative Assistant I', 'Administrative Assistant I', '3', 1, '2017-08-15 08:55:10', NULL, '2017-09-03 13:20:06'),
(19, 'Planning Officer I', 'Planning Officer I', '3', 1, '2017-08-15 08:55:24', NULL, '2017-09-03 13:20:06'),
(20, 'Administrative Assistant II', 'Administrative Assistant II', '3', 1, '2017-08-15 09:01:05', NULL, '2017-09-03 13:20:06'),
(21, 'Senior Ecosystems Management Specialist', 'Senior Ecosystems Management Specialist', '3', 1, '2017-08-15 09:01:16', NULL, '2017-09-03 13:20:06'),
(22, 'Forester II', 'Forester II', '3', 1, '2017-08-15 09:01:25', NULL, '2017-09-03 13:20:06'),
(23, 'Forest Technician II', 'Forest Technician II', '3', 1, '2017-08-15 09:01:33', NULL, '2017-09-03 13:20:06'),
(24, 'Mathematician Aide II', 'Mathematician Aide II', '3', 1, '2017-08-15 09:02:19', NULL, '2017-09-03 13:20:06'),
(25, 'Forester I', 'Forester I', '3', 1, '2017-08-15 09:02:30', NULL, '2017-09-03 13:20:06'),
(26, 'Forest Technician I', 'Forest Technician I', '3', 1, '2017-08-15 09:02:45', NULL, '2017-09-03 13:20:06'),
(27, 'Forest Ranger', 'Forest Ranger', '3', 1, '2017-08-15 09:02:54', NULL, '2017-09-03 13:20:06'),
(28, 'Special Investigator I', 'Special Investigator I', '3', 1, '2017-08-15 09:03:05', NULL, '2017-09-03 13:20:06'),
(29, 'Land Management Officer I', 'Land Management Officer I', '3', 1, '2017-08-15 09:03:19', NULL, '2017-09-03 13:20:06'),
(30, 'Land Management Inspector', 'Land Management Inspector', '3', 1, '2017-08-15 09:03:29', NULL, '2017-09-03 13:20:06'),
(31, 'Utility Worker I', 'Utility Worker I', '3', 1, '2017-08-15 09:03:48', NULL, '2017-09-03 13:20:06'),
(32, 'Engineering Aide', 'Engineering Aide', '3', 1, '2017-08-15 09:03:57', NULL, '2017-09-03 13:20:06'),
(33, 'Park Maintenance Foreman', 'Park Maintenance Foreman', '3', 1, '2017-08-15 09:04:08', NULL, '2017-09-03 13:20:06'),
(34, 'Administrative Aide IV', 'Administrative Aide IV', '3', 1, '2017-08-16 09:43:08', NULL, '2017-09-03 13:20:06'),
(35, 'Forester III', 'Forester III', '3', 1, '2017-08-16 10:05:18', NULL, '2017-09-03 13:20:06'),
(36, 'Ecosystems Management Specialist I', 'Ecosystems Management Specialist I', '3', 1, '2017-08-16 10:59:58', NULL, '2017-09-03 13:20:06');

-- --------------------------------------------------------

--
-- Table structure for table `employee_section`
--

CREATE TABLE `employee_section` (
  `id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_section`
--

INSERT INTO `employee_section` (`id`, `division_id`, `section`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 3, 'Conservation & Development Section', 1, '2017-08-09 08:11:50', NULL, NULL),
(2, 3, 'Regulation & Enforcement Section', 1, '2017-08-09 08:12:14', NULL, NULL),
(3, 2, 'Administrative Section', 1, '2017-08-15 06:31:15', NULL, NULL),
(4, 2, 'Planning & Management Section', 1, '2017-08-15 06:31:39', NULL, NULL),
(5, 2, 'Finance Section', 1, '2017-08-15 06:41:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_unit`
--

CREATE TABLE `employee_unit` (
  `id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_unit`
--

INSERT INTO `employee_unit` (`id`, `division_id`, `section_id`, `unit`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 3, 1, 'Forest Management & Conservation Unit', 1, '2017-08-15 06:26:55', NULL, NULL),
(2, 3, 1, 'Biodiversity Conservation Unit', 1, '2017-08-15 06:27:14', NULL, NULL),
(3, 3, 1, 'Coastal Resource & Foreshore Management Unit', 1, '2017-08-15 06:27:36', NULL, NULL),
(4, 3, 2, 'Surveillance & Intelligence Unit', 1, '2017-08-15 06:28:10', NULL, NULL),
(5, 3, 2, 'Forest & Water Resource Utilization Unit', 1, '2017-08-15 06:28:33', NULL, NULL),
(6, 3, 2, 'Compliance, Monitoring & Investigation Unit', 1, '2017-08-15 06:29:01', NULL, NULL),
(7, 3, 2, 'Licenses, Patents & Deeds Unit', 1, '2017-08-15 06:29:28', NULL, NULL),
(8, 3, 2, 'Wildlife Resource Permitting Unit', 1, '2017-08-15 06:29:45', NULL, NULL),
(9, 3, 2, 'Survey & Mapping Unit', 1, '2017-08-15 06:29:59', NULL, NULL),
(10, 2, 3, 'Personnel Unit', 1, '2017-08-15 06:44:11', NULL, NULL),
(11, 2, 3, 'Cashiering Unit', 1, '2017-08-15 06:44:26', NULL, NULL),
(12, 2, 3, 'General Services Unit', 1, '2017-08-15 06:44:39', NULL, NULL),
(13, 2, 3, 'Records Management Unit', 1, '2017-08-15 06:44:53', NULL, NULL),
(14, 2, 4, 'Planning & Programming Unit', 1, '2017-08-15 06:45:13', NULL, NULL),
(15, 2, 4, 'Monitoring & Evaluation Unit', 1, '2017-08-15 08:47:49', NULL, NULL),
(16, 2, 4, 'Information & Communication Technology Unit', 1, '2017-08-15 08:48:12', NULL, NULL),
(17, 2, 5, 'Accounting Unit', 1, '2017-08-15 08:48:25', NULL, NULL),
(18, 2, 5, 'Budget Unit', 1, '2017-08-15 08:48:36', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `family_background`
--

CREATE TABLE `family_background` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `spouse_lname` varchar(30) DEFAULT 'N/A',
  `spouse_fname` varchar(30) DEFAULT 'N/A',
  `spouse_mname` varchar(30) DEFAULT 'N/A',
  `spouse_xname` varchar(15) DEFAULT 'N/A',
  `spouse_occupation` varchar(100) DEFAULT 'N/A',
  `spouse_business_name` varchar(200) DEFAULT 'N/A',
  `spouse_business_address` varchar(200) DEFAULT 'N/A',
  `spouse_phone_no` varchar(30) DEFAULT 'N/A',
  `father_lname` varchar(30) DEFAULT 'N/A',
  `father_fname` varchar(30) DEFAULT 'N/A',
  `father_mname` varchar(30) DEFAULT 'N/A',
  `father_xname` varchar(30) DEFAULT 'N/A',
  `mother_maiden_name` varchar(50) DEFAULT 'N/A',
  `mother_lname` varchar(30) DEFAULT 'N/A',
  `mother_fname` varchar(30) DEFAULT 'N/A',
  `mother_mname` varchar(30) DEFAULT 'N/A',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `family_background_children`
--

CREATE TABLE `family_background_children` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `child_name` varchar(200) NOT NULL,
  `child_bdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form_no`
--

CREATE TABLE `form_no` (
  `id` int(11) NOT NULL,
  `form_text` varchar(10) NOT NULL,
  `form_no` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_no`
--

INSERT INTO `form_no` (`id`, `form_text`, `form_no`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'TRV#', '000006', 1, '2017-06-20 13:04:56', 1, '2017-08-16 07:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `form_signatory`
--

CREATE TABLE `form_signatory` (
  `id` int(11) NOT NULL,
  `signatory` int(11) NOT NULL,
  `signatory_type` varchar(1) NOT NULL,
  `signatory_division` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_signatory`
--

INSERT INTO `form_signatory` (`id`, `signatory`, `signatory_type`, `signatory_division`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 54, 'A', 1, 1, '2017-09-03 14:18:40', NULL, NULL),
(2, 55, 'R', 3, 1, '2017-09-03 14:18:40', NULL, NULL),
(3, 50, 'R', 2, 1, '2017-09-03 14:18:41', NULL, NULL),
(4, 4, 'R', 4, 1, '2017-09-03 14:18:41', NULL, '2017-09-03 14:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `learning_development`
--

CREATE TABLE `learning_development` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `learning_title` varchar(200) DEFAULT NULL,
  `inclusive_date_from` date DEFAULT NULL,
  `inclusive_date_to` date DEFAULT NULL,
  `number_of_hours` varchar(20) DEFAULT NULL,
  `type_id` varchar(25) DEFAULT NULL,
  `conducted_by` varchar(200) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `other_information`
--

CREATE TABLE `other_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `special_skills_hobbies` varchar(200) DEFAULT NULL,
  `non_academic_distinction` varchar(200) DEFAULT NULL,
  `membership` varchar(200) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE `personal_information` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(100) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `civil_status` varchar(50) DEFAULT NULL,
  `height` decimal(18,2) DEFAULT NULL,
  `weight` decimal(18,0) DEFAULT NULL,
  `blood_type` varchar(5) DEFAULT NULL,
  `gsis_no` varchar(25) DEFAULT NULL,
  `pagibig_no` varchar(25) DEFAULT NULL,
  `philhealth_no` varchar(25) DEFAULT NULL,
  `sss_no` varchar(25) DEFAULT NULL,
  `tin_no` varchar(25) DEFAULT NULL,
  `agency_emp_no` varchar(25) DEFAULT NULL,
  `citizenship_filipino` varchar(1) DEFAULT NULL,
  `citizenship_dual` varchar(1) DEFAULT NULL,
  `by_birth` varchar(1) DEFAULT NULL,
  `by_naturalization` varchar(1) DEFAULT NULL,
  `indicated_country` varchar(50) DEFAULT NULL,
  `res_house_block_lot` varchar(50) DEFAULT 'N/A',
  `res_street` varchar(50) DEFAULT 'N/A',
  `res_subdivision` varchar(50) DEFAULT NULL,
  `res_barangay` varchar(50) DEFAULT NULL,
  `res_municipality` varchar(50) DEFAULT NULL,
  `res_province` varchar(50) DEFAULT NULL,
  `res_zip_code` varchar(5) DEFAULT NULL,
  `per_house_block_lot` varchar(50) DEFAULT 'N/A',
  `per_street` varchar(50) DEFAULT 'N/A',
  `per_subdivision` varchar(50) DEFAULT NULL,
  `per_barangay` varchar(50) DEFAULT NULL,
  `per_municipality` varchar(50) DEFAULT NULL,
  `per_province` varchar(50) DEFAULT NULL,
  `per_zip_code` varchar(5) DEFAULT NULL,
  `tel_no` varchar(15) DEFAULT 'N/A',
  `mobile_no` varchar(15) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `system_setting`
--

CREATE TABLE `system_setting` (
  `id` int(11) NOT NULL,
  `sys_title` varchar(200) DEFAULT NULL,
  `sys_sub_title` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_no` varchar(50) DEFAULT NULL,
  `contact_person` varchar(50) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `tin_no` varchar(25) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_order`
--

CREATE TABLE `travel_order` (
  `id` int(11) NOT NULL,
  `order_no` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `signature` varchar(1) NOT NULL,
  `approval_status` varchar(1) NOT NULL,
  `date_filling` date NOT NULL,
  `station` varchar(50) NOT NULL,
  `salary` decimal(18,2) NOT NULL,
  `division` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `departure_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `destination` varchar(200) NOT NULL,
  `purpose_of_travel` varchar(200) NOT NULL,
  `per_diems_allowed` decimal(18,2) DEFAULT NULL,
  `assistantor_allowed` decimal(18,2) DEFAULT NULL,
  `appropriation` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `recommender` int(11) NOT NULL,
  `approver` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `recommended_by` int(11) DEFAULT NULL,
  `recommended_at` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel_order`
--

INSERT INTO `travel_order` (`id`, `order_no`, `user_id`, `position_id`, `signature`, `approval_status`, `date_filling`, `station`, `salary`, `division`, `section`, `unit`, `departure_date`, `arrival_date`, `destination`, `purpose_of_travel`, `per_diems_allowed`, `assistantor_allowed`, `appropriation`, `remarks`, `recommender`, `approver`, `created_by`, `created_at`, `updated_by`, `updated_at`, `recommended_by`, `recommended_at`, `approved_by`, `approved_at`) VALUES
(1, 'TRV#000005', 1, 9, '1', '2', '2017-08-16', 'PENRO Marinduque', '8000.00', 2, 4, 16, '2017-08-16', '2017-08-19', 'Manila', 'To attend ICT Training', '800.00', NULL, NULL, NULL, 50, 54, 1, '2017-08-16 07:29:37', 1, '2017-09-03 15:31:25', 1, '2017-09-02 16:00:00', 1, '2017-09-02 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `xname` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '3',
  `user_status` int(11) NOT NULL DEFAULT '1',
  `user_division` int(11) DEFAULT NULL,
  `user_section` int(11) DEFAULT NULL,
  `user_unit` int(11) DEFAULT NULL,
  `user_position` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `mname`, `lname`, `xname`, `email`, `user_type`, `user_status`, `user_division`, `user_section`, `user_unit`, `user_position`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$qoK1YUEhsD8CggOmW82BD.kWR6cXPAxc/bes/kqXRxA7lFWZVQaO2', 'Mark Ryan', 'Soriano', 'Lozada', NULL, 'ryelozada@gmail.com', 1, 1, 2, 4, 16, 9, '9dJf80k3KlQuxqqM603dDSpsyWEDYbAZLLYpI0PZw0Ub1emwOTeG3iohcIhJ', NULL, '2017-08-16 06:41:56'),
(2, 'felyariola', '$2y$10$DvxYIlqIbUdFjevQqg8Is.WKpxP8uisojeBpfJ3ERj7HP.BOsjcN.', 'Felisa', 'Regencia', 'Ariola', NULL, 'ariolafhely@gmail.com', 3, 1, 1, NULL, NULL, 13, NULL, NULL, '2017-08-16 10:37:54'),
(3, 'niloalcober', '$2y$10$EO5mFxUzmCH1F8rhW9k9UOBK.U7Q4042fkxi/.ejn.dUNR4CHjVy.', 'Nilo', 'Luz', 'Alcober', NULL, 'niloalcober@yahoo.com', 3, 1, 2, 3, 12, 16, NULL, NULL, NULL),
(4, 'efrendelosreyes', '$2y$10$MW0UADVNImtk5l7zeVVQ/eL8v0Ke8QEAIFGG/LyUYC.RehZwYaBIu', 'Efren', 'Labayug', 'Delos Reyes', NULL, 'tiron_10@yahoo.com', 3, 1, 4, NULL, NULL, 4, NULL, NULL, NULL),
(5, 'gemdelosreyes', '$2y$10$dir45fZWDC2S4boiQTdpc.yFQgSlFItUqw55QpD9oQYu/vgGy25l2', 'Gemma', 'Palparan', 'Delos Reyes', NULL, 'gpdelosreyes@yahoo.com.ph', 3, 1, 2, 4, 14, 6, NULL, NULL, NULL),
(6, 'tonydiaz', '$2y$10$X7NEwAd1zC94Nt.BrwAnSezV47tJByZXBnRlxTpAgbAAV4tKsuYn.', 'Simeon', 'Revilla', 'Diaz', NULL, 'diaz_simone@yahoo.com', 3, 1, 3, 2, 7, 11, NULL, NULL, NULL),
(7, 'randyestrella', '$2y$10$/vtGIwNFp4xnMEDAEbvYauMhXsA8hIWoSbAfM1zmvDxPYui.CAOoe', 'Randy', 'Nepomuceno', 'Estrella', NULL, 'randyestrella08@gmail.com', 3, 1, 3, 2, 4, 27, NULL, NULL, NULL),
(8, 'maloulastra', '$2y$10$08X3w1GQq8s2Or2WLZ7t1eFZWJkNp6gkVQJfWVAP0EuMVNGQ4pj4W', 'Maria Lourdes', 'Pedernal', 'Lastra', NULL, 'marialourdespedernallastra@gmail.com', 3, 1, 3, 2, 7, 29, NULL, NULL, NULL),
(9, 'alethbundoc', '$2y$10$nx4O.acuvt780bhVcanfvulZRL.RQjonrkgGZWsO33VndZfaKGgx6', 'Aleth', 'Casareo', 'Bundoc', NULL, 'alethbundoc@yahoo.com', 3, 1, 3, 1, 1, 10, NULL, NULL, NULL),
(10, 'rommmariposque', '$2y$10$QYHdyc4DzYE.rLBj3o8Ft.9N/6VyB0gcZzdohgD6MOw74nZv9Nt9y', 'Romm', 'Lotilla', 'Mariposque', NULL, 'romm214@yahoo.com', 3, 1, 1, NULL, NULL, 34, NULL, NULL, NULL),
(11, 'lorenapernia', '$2y$10$wXEy.rBZ5bvKyWVFAvJfNeSTWIFYbYHaU6NlUafbEo/E1GmEAd1au', 'Lorena', 'Regencia', 'Pernia', NULL, 'jarrenpernia05@gmail.com', 3, 1, 3, 2, 7, 13, NULL, NULL, NULL),
(12, 'sallyrioveros', '$2y$10$TM.bLzlDe7vuHci40nVHNuQkKtS3RiqXe82YDnYUPl58BVvSQtQTy', 'Rosalina', 'Rey', 'Rioveros', NULL, 'sally.rey.rioveros@gmail.com', 3, 1, 2, 3, 13, 27, NULL, NULL, NULL),
(13, 'roderickvillanueva', '$2y$10$D508LrntDnADjujyrAWLDewU/B/fUebhTOCBPl1szztJFysSeKpcS', 'Roderick', 'Sotto', 'Villanueva', NULL, 'roderick.sotto.villanueva@gmail.com', 3, 1, 4, NULL, NULL, 33, NULL, NULL, NULL),
(14, 'leopoldolucernas', '$2y$10$au.9GUlyioWCvbeb15/nk.4lV2CFmzTRxObD7NKkxXmZO4Uv6XGBm', 'Leopoldo', 'Gurango', 'Lucernas, Jr.', NULL, 'leopoldo.lucernas.jr@gmail.com', 3, 1, 3, 2, 4, 27, NULL, NULL, '2017-08-16 10:45:41'),
(15, 'chandaosicos', '$2y$10$g75bSgPePsI38zcaGQR1L.RQZ2EPgDnsKkyX1Z4TAZTpePIb4IATi', 'Nonita', 'Marquez', 'Osicos', NULL, 'osicosnonita@yahoo.com', 3, 1, 2, 5, 17, 13, NULL, NULL, NULL),
(16, 'randypantoja', '$2y$10$0t15jk0UiQGgHHXaDsboAuBzDVqiBt0jXYczXFl0XxMdJPNEbJrLa', 'Randy', 'Rogayan', 'Pantoja', NULL, 'pantojarandy879@yahoo.com', 3, 1, 3, 1, 2, 26, NULL, NULL, NULL),
(17, 'florencepastoral', '$2y$10$21z8Hb0d5cXndiL0Z3gTieNfqN0.syN.Q1wF31lAD7AU5GnMLZZ4S', 'Florencio', 'Frias', 'Pastoral', NULL, 'florenciopastoral@gmail.com', 3, 1, 3, 2, NULL, 35, NULL, NULL, NULL),
(18, 'oliverminay', '$2y$10$aQ5DRsCPJu5i.K2cfwnZuO6m3uQtYkW6bS0UwUBJV56jDQBPMxUCm', 'Oliver', 'Ricamara', 'Minay', NULL, 'minayoliver@yahoo.com', 3, 1, 3, 1, 3, 23, NULL, NULL, NULL),
(19, 'arlenejamilla', '$2y$10$Uu0PBJCnFMKB5JtSAbVHzOliqFFgLDKe7kK7aFWN3ei6h3V/d3m4i', 'Arlene', 'Ambrocio', 'Jamilla', NULL, 'arlene.a.jamilla@gmail.com', 3, 1, 2, 5, 17, 20, NULL, NULL, NULL),
(20, 'verniemonterey', '$2y$10$EQpKuHpg6lRPjGLB.CaF.etZH3UzYQ.fzcnpd0qD4QAL.X.kCQx7.', 'Lionel Vernie', 'Restar', 'Monterey', NULL, 'lvrmonterey@gmail.com', 3, 1, 3, 2, 7, 30, NULL, NULL, NULL),
(21, 'ernestopizarra', '$2y$10$SEhky/wKYHgnyzs95oaUXe3QKvQBrxHiKamRAnLZSdGv9jqiSRmI6', 'Ernesto', 'Regencia', 'Pizarra', NULL, 'ernesto.pizarra@gmail.com', 3, 1, 3, 2, 6, 27, NULL, NULL, NULL),
(22, 'terencerecto', '$2y$10$3PbwolAlpc6ZFK0V7B363.v57CzT2clE4588SGnhUsUf6G5mtHzMq', 'Emeterio', 'Murillo', 'Recto', NULL, 'emeterio_recto@yahoo.com', 3, 1, 3, 1, NULL, 21, NULL, NULL, NULL),
(23, 'jameelbronce', '$2y$10$5cBAxN2geqJbxGEPZLgQi.ij19WcWWBoFn.FBpsed2tpp7X4DKzkK', 'Jerahmeel', 'Lucas', 'Bronce', NULL, 'jameel.bronce@gmail.com', 3, 1, 3, 2, 4, 27, NULL, NULL, NULL),
(24, 'michaelmaranan', '$2y$10$N1ZUFC4tPuyE8DTO6Vmh0ORD2LrlOWwo/wTMA8KwnWbTtRqDkc5WS', 'Michael Joseph', 'Adonis', 'Maranan', NULL, 'michaeljosephxandrix@gmail.com', 3, 1, 3, 2, 5, 27, NULL, NULL, NULL),
(25, 'dannycortiguerra', '$2y$10$hWOENNu2A.UCTt/7Jh0j6OfXud6zoHc0pLQ7iADnO6KNQj5VtA1pi', 'Danilo', 'Gapaz', 'Cotiguerra', NULL, 'danny.cortiguerra@gmail.com', 3, 1, 2, 3, 11, 16, NULL, NULL, NULL),
(26, 'jeanbronce', '$2y$10$F.rtIFzyKKfin.aFxYQA4eUEMNKbWxVxITjFVIiuIgdgnhVUfoiJG', 'Jeannie', 'Lucas', 'Bronce', NULL, 'jean.bronce@gmail.com', 3, 1, 4, NULL, NULL, 12, NULL, NULL, NULL),
(27, 'anidelfeliciano', '$2y$10$aHt1cq6aIfq6lvVMcoxJlOE3G3xjW/ULe9UvCzo37qJVYhXrK1cdy', 'Anidel', 'Mayangitan', 'Feliciano', NULL, 'anidelfeliciano10@gmail.com', 3, 1, 2, 5, 18, 14, NULL, NULL, NULL),
(28, 'rickypereda', '$2y$10$0Ij8lMGqaNmdn7rf0evfN.UcTWRfec5Uv21AXC1T9MI5AWJ9KAQ2W', 'Ricky', 'De Luna', 'Pereda', NULL, 'rickypereda26@gmail.com', 3, 1, 3, 1, 1, 26, NULL, NULL, NULL),
(29, 'juliusmanoos', '$2y$10$7wk69ptkjwQ0zsCAg4FRYOMfODwlqrEphA.zMDkQMzciSjlEba4ia', 'Julius Mark', 'Lazo', 'Manoos', NULL, 'juliusmark313@gmail.com', 3, 1, 4, NULL, NULL, 26, NULL, NULL, NULL),
(30, 'lucyricafrente', '$2y$10$pjT3/PF.c68CLcCYv8KbKetRUHleI/SDscIoTg71UvpNnK7VOFtES', 'Luciana', 'Macdon', 'Ricafrente', NULL, 'lucymacdonr@gmail.com', 3, 1, 3, 2, 7, 28, NULL, NULL, NULL),
(31, 'sherwinvillavicencio', '$2y$10$erMQQrea5p4IIKaYDibSkunEJla0BgeZ6H5aDNMBfteVCEeT2EL.u', 'Sherwin', 'Pastrana', 'Villavicencio', NULL, 'sherwin.p.villavicencio@gmail.com', 3, 1, 4, NULL, NULL, 27, NULL, NULL, NULL),
(32, 'jhonnamedenilla', '$2y$10$TSCvD53m0mq61gBjegX5L.K6By9r/ijj.KDpB46Jp8EHHMvUMWCGO', 'Jhonna Liza', 'San Juan', 'Medenilla', NULL, 'jhoemz1415@gmail.com', 3, 1, 2, 4, 15, 19, NULL, NULL, NULL),
(33, 'drewaldovino', '$2y$10$PtsMvSFuRaHksJ.mfgr.DepiUsN1AX457ND47pq6m1bQHeWQeks3y', 'Andrew', 'Euden', 'Aldovino', NULL, 'dreweuden17@gmail.com', 3, 1, 2, 3, 11, 17, NULL, NULL, NULL),
(34, 'bessieconstantino', '$2y$10$ULpQB/dhG49RLwOdnshAneV50Fgk5mi7wL6RY8sq/0na7nrRAuqoW', 'Blesilda', 'Jamola', 'Constantino', NULL, 'tiger31774@gmail.com', 3, 1, 4, NULL, NULL, 13, 'apQYRd0dkXsBxKUdqNi4JiYyIcixbxkGKWgcenzmIEh8WuiPBDeAaBvb44Ej', NULL, NULL),
(35, 'noeldifuntorum', '$2y$10$hpUpEjLO6lsyBjR/vvk80e.j8lmQXAk48m3KKYUFBSyUk4vOkNWNq', 'Noel', 'Madalang', 'Difuntorum', NULL, 'noeldifuntorum@yahoo.com', 3, 1, 3, 2, NULL, 25, NULL, NULL, NULL),
(36, 'mariceldonato', '$2y$10$tPdOBv4VU14HmmBhJflg6.4t9WDPjD6rBEwDsG7YGRykp/BAs1w8S', 'Maricel', 'Cirilo', 'Donato', NULL, 'mariceldonato1966@gmail.com', 3, 1, 3, 2, 6, 23, NULL, NULL, NULL),
(37, 'jundeefandialan', '$2y$10$Z6UUNrGBlCb9ZqX6lhqeFuLr7CwWBpdZTrhrk.Z9zOIVsXpyG.QO2', 'Florante', 'Gruezo', 'Fandialan, Jr.', NULL, 'jundee.fandialan@gmail.com', 3, 1, 3, 2, 6, 27, NULL, NULL, '2017-08-16 10:48:26'),
(38, 'erickaladeras', '$2y$10$wVFXuCsBMc1MCVfJM4ffMe0rBiE0eLv59fEyBLektuN/3XjxPAeY.', 'Ericka', 'Mabutot', 'Laderas', NULL, 'erickaladeras@gmail.com', 3, 1, 2, 5, 18, 13, NULL, NULL, '2017-08-16 10:48:09'),
(39, 'anthonylasic', '$2y$10$oTupMbOSFkn8imI4gMo70O2vQ.Sx/vyToHgot.0BSE4cJ52b0nlSC', 'Anthony', 'Mapacpac', 'Lasic', NULL, 'tonyLSC@yahoo.com', 3, 1, 3, 2, 7, 30, NULL, NULL, NULL),
(40, 'brianleano', '$2y$10$/v3ADTqu/LmGU8y1MCPOyuELpx0xYaY9f7CHMxmQ.YpISGJ/i4vam', 'Brian Iñigo', 'Fiedalan', 'Leaño', NULL, 'brianinigo.leano@yahoo.com', 3, 1, 3, 1, 3, 26, NULL, NULL, NULL),
(41, 'francolivelo', '$2y$10$Ir7ZdXWnlOA0X4ardLJRYep.IWspadEU2nBLuOuDTFhsLoARfPFqu', 'Franco Baltazar', 'Azagra', 'Livelo', NULL, 'francolivelo@yahoo.com', 3, 1, 3, 1, 1, 26, NULL, NULL, NULL),
(42, 'andrewmagculang', '$2y$10$V9NTUW3DSWDo5Jtn6eR2H.S0kBx7jjpjrvQDPUjEq3KyFAU.gAZk6', 'John Andrew', 'Moreno', 'Magculang', NULL, 'johnpipoy_23@yahoo.com', 3, 1, 3, 1, 3, 26, NULL, NULL, NULL),
(43, 'dannymartinez', '$2y$10$bE7LdL5QbQYSFcjr4Saeh.eiVtuO7eJ24zDdHxy.z660CX4mZWDr2', 'Danilo', 'Lopez', 'Martinez', NULL, 'danilolopezmartinez8186@gmail.com', 3, 1, 3, 1, 2, 25, NULL, NULL, NULL),
(44, 'heidyoyong', '$2y$10$h4E5rdKKnhkO0HlJGOz4Y.8HcDbTNimUePN/inp7krWB2.WOb6PzO', 'Heidy', 'Leal', 'Oyong', NULL, 'heidyoyong@gmail.com', 3, 1, 1, NULL, NULL, 13, NULL, NULL, NULL),
(45, 'mayparreno', '$2y$10$bTqR2yZnhODPpTnzxaeRkORhJaLb2t8vcMcT3nna0DNK7siD/9xzK', 'Laarni May', 'Rilles', 'Parreño', NULL, 'laarniparreno@gmail.com', 3, 1, 3, 2, 7, 30, NULL, NULL, NULL),
(46, 'jopastoral', '$2y$10$HAsXOBdg8brWGEo0uRF/kuIeQy3enzf3TRBSFapRZq/ww4Ret5ZCq', 'Jocelyn', 'Pereyra', 'Pastoral', NULL, 'jo.pastoral1964@gmail.com', 3, 1, 2, 3, 11, 18, NULL, NULL, NULL),
(47, 'corapelaez', '$2y$10$Bu8s5YjlJTDP62aYo3gBdekNgC4F/ROg/ESDrDT7d2JJNkTkylUZ6', 'Corazon', 'Revilla', 'Pelaez', NULL, 'mrcsred@gmail.com', 3, 1, 3, 1, 2, 26, NULL, NULL, NULL),
(48, 'woweeperegrin', '$2y$10$cSMgRiIJ8x/dI0hdMA3pRu1nR3YXuLuV5g.ba2c1GAccZHAzWUTJu', 'Almer', 'Labay', 'Peregrin', NULL, 'wowee.peregrin@gmail.com', 3, 1, 4, NULL, NULL, 27, NULL, NULL, NULL),
(49, 'alvinpergis', '$2y$10$MFG40fHhsBnww6dnNmpvp.9i5Ll8Ot./.OT37YyK2fByA7yTafOS6', 'Alvin', 'De Luna', 'Pergis', NULL, 'baztaqlavq49@gmail.com', 3, 1, 4, NULL, NULL, 36, NULL, NULL, NULL),
(50, 'lindarellis', '$2y$10$c0f0L.m.G7khkF41kv6ZsuH69cIId7CsDGdwjnd/aORAnCFROXS8e', 'Erlinda', 'Manzano', 'Rellis', NULL, 'glenda1426@yahoo.com.ph', 3, 1, 2, NULL, NULL, 3, NULL, NULL, NULL),
(51, 'lorelynsaet', '$2y$10$Ym8OFp3OpBFP49tJxxs.nO8JUkuJcHtbe94Mk0r3oxZX8Q3juwxce', 'Lorelyn', 'Pamfilo', 'Saet', NULL, 'lorelynsaet@yahoo.com', 3, 1, 2, 5, 17, 5, NULL, NULL, NULL),
(52, 'michaelsualog', '$2y$10$eaAe7pNUQTEYEpXT7a6pjuIABacBsLbkDZevnjmCYMtoR/FvndSOO', 'Michael Vencint', 'Manuavo', 'Sualog', NULL, 'maykelbensint68@gmail.com', 3, 1, 3, 2, 5, 26, NULL, NULL, NULL),
(53, 'carlowatiwat', '$2y$10$tXkQpckeE1.3zS04bTw7OejwdAzx/eis49s5s2HWiMzGGGFwBYHja', 'Carlo', 'Maac', 'Watiwat', NULL, 'carlowatiwat@yahoo.com', 3, 1, 3, 1, 1, 23, NULL, NULL, NULL),
(54, 'aymeehdiaz', '$2y$10$cIFsq22Xb83qdZZzLBq3neCUw0ySEfRktQ8LHCP9MU4Z/QVlMmEnS', 'Imelda', 'Mendoza', 'Diaz', NULL, 'aymeeh_diaz@yahoo.com', 3, 1, 1, NULL, NULL, 1, NULL, NULL, NULL),
(55, 'cynthialozano', '$2y$10$J0vdcK40XWfyAWoBRUpKNuvMFOg3jNN6XR.AboNy6lIZ07A9jv/cC', 'Cynthia', 'U', 'Lozano', NULL, 'cynthiaulozano@yahoo.com', 3, 1, 3, NULL, NULL, 2, NULL, NULL, NULL),
(56, 'lornajamola', '$2y$10$Hjv68ca/.9h6AUeLXNvYyu4kBBv0ox3WHwBLGdfqxNWlVelM2Nabe', 'Lorna', 'Constantino', 'Jamola', NULL, 'lornajamola@yahoo.com', 2, 1, 2, 3, 10, 15, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `voluntary_work`
--

CREATE TABLE `voluntary_work` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name_address_org` varchar(200) DEFAULT NULL,
  `inclusive_date_from` date DEFAULT NULL,
  `inclusive_date_to` date DEFAULT NULL,
  `number_of_hours` varchar(20) DEFAULT NULL,
  `position_nature_work` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE `work_experience` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `inclusive_date_from` date DEFAULT '0000-00-00',
  `inclusive_date_to` date DEFAULT '0000-00-00',
  `position_title` varchar(200) DEFAULT 'N/A',
  `department_agency_office_company` varchar(200) DEFAULT 'N/A',
  `monthly_salary` decimal(18,2) DEFAULT '0.00',
  `salary_job_pay_grade` varchar(10) DEFAULT 'N/A',
  `appointment_status` varchar(30) DEFAULT 'N/A',
  `government_service` varchar(1) DEFAULT 'N',
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_trail_log`
--
ALTER TABLE `audit_trail_log`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `civil_service_eligibility`
--
ALTER TABLE `civil_service_eligibility`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `educational_background`
--
ALTER TABLE `educational_background`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `employee_division`
--
ALTER TABLE `employee_division`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_position`
--
ALTER TABLE `employee_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_section`
--
ALTER TABLE `employee_section`
  ADD PRIMARY KEY (`id`,`division_id`);

--
-- Indexes for table `employee_unit`
--
ALTER TABLE `employee_unit`
  ADD PRIMARY KEY (`id`,`division_id`,`section_id`);

--
-- Indexes for table `family_background`
--
ALTER TABLE `family_background`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `family_background_children`
--
ALTER TABLE `family_background_children`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `form_no`
--
ALTER TABLE `form_no`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_signatory`
--
ALTER TABLE `form_signatory`
  ADD PRIMARY KEY (`id`,`signatory`);

--
-- Indexes for table `learning_development`
--
ALTER TABLE `learning_development`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_information`
--
ALTER TABLE `other_information`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `system_setting`
--
ALTER TABLE `system_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_order`
--
ALTER TABLE `travel_order`
  ADD PRIMARY KEY (`id`,`order_no`,`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voluntary_work`
--
ALTER TABLE `voluntary_work`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `work_experience`
--
ALTER TABLE `work_experience`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_trail_log`
--
ALTER TABLE `audit_trail_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
--
-- AUTO_INCREMENT for table `civil_service_eligibility`
--
ALTER TABLE `civil_service_eligibility`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `educational_background`
--
ALTER TABLE `educational_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee_division`
--
ALTER TABLE `employee_division`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_position`
--
ALTER TABLE `employee_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `employee_section`
--
ALTER TABLE `employee_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employee_unit`
--
ALTER TABLE `employee_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `family_background`
--
ALTER TABLE `family_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `family_background_children`
--
ALTER TABLE `family_background_children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `form_no`
--
ALTER TABLE `form_no`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `form_signatory`
--
ALTER TABLE `form_signatory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `learning_development`
--
ALTER TABLE `learning_development`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `other_information`
--
ALTER TABLE `other_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_setting`
--
ALTER TABLE `system_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `travel_order`
--
ALTER TABLE `travel_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `voluntary_work`
--
ALTER TABLE `voluntary_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `work_experience`
--
ALTER TABLE `work_experience`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
