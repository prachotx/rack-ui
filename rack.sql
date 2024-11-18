-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 09:03 PM
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
-- Database: `rack`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `rack_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `depth` double(8,2) NOT NULL,
  `long` double(8,2) NOT NULL,
  `height` double(8,2) NOT NULL,
  `row_position` int(11) NOT NULL,
  `column_position` int(11) NOT NULL,
  `support_weight` double(8,2) NOT NULL,
  `remain_height` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `code`, `rack_id`, `depth`, `long`, `height`, `row_position`, `column_position`, `support_weight`, `remain_height`, `created_at`, `updated_at`) VALUES
(37, 'A1-01-01', 30, 120.00, 200.00, 50.00, 1, 1, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-15 17:59:32'),
(38, 'A1-01-02', 30, 120.00, 200.00, 50.00, 1, 2, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-15 22:01:29'),
(39, 'A1-01-03', 30, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:36:56', '2024-11-13 06:36:56'),
(40, 'A1-02-01', 30, 120.00, 200.00, 50.00, 2, 1, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-13 08:48:16'),
(41, 'A1-02-02', 30, 120.00, 200.00, 50.00, 2, 2, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-14 09:41:58'),
(42, 'A1-02-03', 30, 120.00, 200.00, 50.00, 2, 3, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-14 10:24:01'),
(43, 'A1-03-01', 30, 120.00, 200.00, 50.00, 3, 1, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-13 08:33:20'),
(44, 'A1-03-02', 30, 120.00, 200.00, 50.00, 3, 2, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-13 08:34:45'),
(45, 'A1-03-03', 30, 120.00, 200.00, 50.00, 3, 3, 200.00, 50.00, '2024-11-13 06:36:56', '2024-11-13 08:44:43'),
(46, 'A2-01-01', 31, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:37:43', '2024-11-13 06:37:43'),
(47, 'A2-01-02', 31, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:37:43', '2024-11-13 06:37:43'),
(48, 'A2-01-03', 31, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:37:43', '2024-11-13 06:37:43'),
(49, 'A2-02-01', 31, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:37:43', '2024-11-13 06:37:43'),
(50, 'A2-02-02', 31, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:37:43', '2024-11-13 06:37:43'),
(51, 'A2-02-03', 31, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:37:43', '2024-11-13 06:37:43'),
(52, 'A2-03-01', 31, 120.00, 200.00, 50.00, 3, 1, 200.00, 50.00, '2024-11-13 06:37:43', '2024-11-15 18:14:29'),
(53, 'A2-03-02', 31, 120.00, 200.00, 50.00, 3, 2, 200.00, 50.00, '2024-11-13 06:37:43', '2024-11-14 10:13:54'),
(54, 'A2-03-03', 31, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:37:43', '2024-11-13 06:37:43'),
(55, 'A3-01-01', 32, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(56, 'A3-01-02', 32, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(57, 'A3-01-03', 32, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(58, 'A3-02-01', 32, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(59, 'A3-02-02', 32, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(60, 'A3-02-03', 32, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(61, 'A3-03-01', 32, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(62, 'A3-03-02', 32, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(63, 'A3-03-03', 32, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:41:20', '2024-11-13 06:41:20'),
(64, 'A4-01-01', 33, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(65, 'A4-01-02', 33, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(66, 'A4-01-03', 33, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(67, 'A4-02-01', 33, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(68, 'A4-02-02', 33, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(69, 'A4-02-03', 33, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(70, 'A4-03-01', 33, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(71, 'A4-03-02', 33, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(72, 'A4-03-03', 33, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:41:27', '2024-11-13 06:41:27'),
(73, 'A5-01-01', 34, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(74, 'A5-01-02', 34, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(75, 'A5-01-03', 34, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(76, 'A5-02-01', 34, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(77, 'A5-02-02', 34, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(78, 'A5-02-03', 34, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(79, 'A5-03-01', 34, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(80, 'A5-03-02', 34, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(81, 'A5-03-03', 34, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:41:35', '2024-11-13 06:41:35'),
(82, 'A6-01-01', 35, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(83, 'A6-01-02', 35, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(84, 'A6-01-03', 35, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(85, 'A6-02-01', 35, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(86, 'A6-02-02', 35, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(87, 'A6-02-03', 35, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(88, 'A6-03-01', 35, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(89, 'A6-03-02', 35, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(90, 'A6-03-03', 35, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:41:41', '2024-11-13 06:41:41'),
(91, 'A7-01-01', 36, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(92, 'A7-01-02', 36, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(93, 'A7-01-03', 36, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(94, 'A7-02-01', 36, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(95, 'A7-02-02', 36, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(96, 'A7-02-03', 36, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(97, 'A7-03-01', 36, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(98, 'A7-03-02', 36, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(99, 'A7-03-03', 36, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:41:50', '2024-11-13 06:41:50'),
(100, 'A8-01-01', 37, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(101, 'A8-01-02', 37, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(102, 'A8-01-03', 37, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(103, 'A8-02-01', 37, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(104, 'A8-02-02', 37, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(105, 'A8-02-03', 37, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(106, 'A8-03-01', 37, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(107, 'A8-03-02', 37, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(108, 'A8-03-03', 37, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:41:56', '2024-11-13 06:41:56'),
(109, 'A9-01-01', 38, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(110, 'A9-01-02', 38, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(111, 'A9-01-03', 38, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(112, 'A9-02-01', 38, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(113, 'A9-02-02', 38, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(114, 'A9-02-03', 38, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(115, 'A9-03-01', 38, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(116, 'A9-03-02', 38, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(117, 'A9-03-03', 38, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:42:03', '2024-11-13 06:42:03'),
(118, 'A10-01-01', 39, 120.00, 200.00, 50.00, 1, 1, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(119, 'A10-01-02', 39, 120.00, 200.00, 50.00, 1, 2, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(120, 'A10-01-03', 39, 120.00, 200.00, 50.00, 1, 3, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(121, 'A10-02-01', 39, 120.00, 200.00, 50.00, 2, 1, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(122, 'A10-02-02', 39, 120.00, 200.00, 50.00, 2, 2, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(123, 'A10-02-03', 39, 120.00, 200.00, 50.00, 2, 3, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(124, 'A10-03-01', 39, 120.00, 200.00, 50.00, 3, 1, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(125, 'A10-03-02', 39, 120.00, 200.00, 50.00, 3, 2, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10'),
(126, 'A10-03-03', 39, 120.00, 200.00, 50.00, 3, 3, 200.00, 100.00, '2024-11-13 06:42:10', '2024-11-13 06:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'New Ebba', '2024-06-20 04:14:13', '2024-06-20 04:14:13'),
(2, 'Keelingstad', '2024-06-20 04:14:13', '2024-06-20 04:14:13'),
(3, 'Kuvalischester', '2024-06-20 04:14:13', '2024-06-20 04:14:13'),
(4, 'O\'Reillyshire', '2024-06-20 04:14:14', '2024-06-20 04:14:14'),
(5, 'Lake Amalia', '2024-06-20 04:14:14', '2024-06-20 04:14:14'),
(6, 'Maureenmouth', '2024-06-20 04:14:14', '2024-06-20 04:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `check_outs`
--

CREATE TABLE `check_outs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `out_date` date NOT NULL,
  `code` varchar(255) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `out_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approve_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('draft','confirm','approve','cancel','reject') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `check_outs`
--

INSERT INTO `check_outs` (`id`, `out_date`, `code`, `remark`, `out_user_id`, `approve_user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '2024-11-09', 'CO-0000000001', '333', 1, NULL, 'cancel', '2024-11-09 04:04:40', '2024-11-13 08:01:59'),
(2, '2024-11-13', 'CO-0000000002', '1', 1, NULL, 'cancel', '2024-11-13 08:02:31', '2024-11-13 08:33:12'),
(3, '2024-11-13', 'CO-0000000003', '111', 1, NULL, 'approve', '2024-11-13 08:33:42', '2024-11-13 08:37:59'),
(4, '2024-11-13', 'CO-0000000004', '0093', 1, NULL, 'approve', '2024-11-13 08:45:04', '2024-11-13 08:46:18'),
(5, '2024-11-13', 'CO-0000000005', '321', 1, NULL, 'approve', '2024-11-13 08:48:27', '2024-11-15 18:14:42'),
(6, '2024-11-16', 'CO-0000000006', '3214', 1, NULL, 'approve', '2024-11-15 18:14:52', '2024-11-15 18:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `check_out_details`
--

CREATE TABLE `check_out_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `check_out_id` bigint(20) UNSIGNED NOT NULL,
  `packing_detail_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `check_out_details`
--

INSERT INTO `check_out_details` (`id`, `check_out_id`, `packing_detail_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 3, 80, 100, '2024-11-13 08:36:45', '2024-11-13 08:36:45'),
(2, 3, 81, 100, '2024-11-13 08:37:45', '2024-11-13 08:37:45'),
(3, 4, 82, 100, '2024-11-13 08:45:08', '2024-11-13 08:45:08'),
(4, 5, 84, 100, '2024-11-13 08:48:30', '2024-11-13 08:48:30'),
(5, 6, 83, 100, '2024-11-15 18:14:56', '2024-11-15 18:14:56'),
(6, 6, 85, 100, '2024-11-15 18:14:59', '2024-11-15 18:14:59'),
(7, 6, 87, 100, '2024-11-15 18:15:02', '2024-11-15 18:15:02');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Mobile Rack', '2024-06-20 04:14:13', '2024-06-20 04:15:53'),
(2, 'Selective Rack', '2024-06-20 04:14:13', '2024-06-20 04:16:02'),
(3, 'Gibson Mission', '2024-06-20 04:14:14', '2024-06-20 04:14:14'),
(4, 'Kemmer Cliffs', '2024-06-20 04:14:14', '2024-06-20 04:14:14'),
(5, 'America Club', '2024-06-20 04:14:14', '2024-06-20 04:14:14'),
(6, 'Garnett Ferry', '2024-06-20 04:14:14', '2024-06-20 04:14:14'),
(7, 'Reichel Estates', '2024-06-20 04:14:14', '2024-06-20 04:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(131, '2014_10_12_000000_create_users_table', 1),
(132, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(133, '2014_10_12_100000_create_password_resets_table', 1),
(134, '2019_08_19_000000_create_failed_jobs_table', 1),
(135, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(136, '2024_01_24_121204_add_role_to_users_table', 1),
(137, '2024_02_01_015833_create_branchs_table', 1),
(138, '2024_02_01_015952_add_branch_to_users_table', 1),
(139, '2024_06_11_111455_create_locations_table', 1),
(140, '2024_06_12_013321_create_racks_table', 1),
(141, '2024_06_12_070150_create_pallets_table', 1),
(142, '2024_06_12_070218_create_pallet_types_table', 1),
(143, '2024_06_12_073516_create_blocks_table', 1),
(144, '2024_06_13_082704_create_product_types_table', 1),
(145, '2024_06_13_084940_create_products_table', 1),
(146, '2024_06_18_031730_add_name_to_racks_table', 1),
(147, '2024_06_18_130517_create_process_pallets_table', 1),
(148, '2024_06_19_153744_create_packings_table', 1),
(149, '2024_06_19_153801_create_packing_details_table', 1),
(150, '2024_06_19_153831_create_check_outs_table', 1),
(151, '2024_06_19_153838_create_check_out_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packings`
--

CREATE TABLE `packings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pack_date` date NOT NULL,
  `code` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `pack_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approve_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('draft','confirm','approve','cancel','reject') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packings`
--

INSERT INTO `packings` (`id`, `pack_date`, `code`, `remark`, `pack_user_id`, `approve_user_id`, `status`, `created_at`, `updated_at`) VALUES
(55, '2024-11-13', 'PK-0000000055', '001', 1, NULL, 'cancel', '2024-11-13 06:37:22', '2024-11-13 06:38:53'),
(56, '2024-11-13', 'PK-0000000056', '1', 1, 1, 'approve', '2024-11-13 06:42:21', '2024-11-13 08:33:35'),
(57, '2024-11-13', 'PK-0000000057', '111', 1, NULL, 'cancel', '2024-11-13 08:34:33', '2024-11-13 08:34:54'),
(58, '2024-11-13', 'PK-0000000058', '111', 1, 1, 'approve', '2024-11-13 08:34:35', '2024-11-13 08:34:59'),
(59, '2024-11-13', 'PK-0000000059', '322', 1, 1, 'approve', '2024-11-13 08:44:23', '2024-11-13 08:44:48'),
(60, '2024-11-13', 'PK-0000000060', '883', 1, NULL, 'approve', '2024-11-13 08:47:51', '2024-11-13 11:19:54'),
(61, '2024-11-14', 'PK-0000000061', '111', 1, 1, 'approve', '2024-11-14 09:41:42', '2024-11-14 11:40:47'),
(62, '2024-11-15', 'PK-0000000062', '321', 1, NULL, 'confirm', '2024-11-14 10:13:45', '2024-11-14 10:13:58'),
(63, '2024-11-15', 'PK-0000000063', '3213', 1, NULL, 'approve', '2024-11-14 10:23:50', '2024-11-14 11:34:50'),
(64, '2024-11-15', 'PK-0000000064', '6665', 1, NULL, 'draft', '2024-11-14 11:42:52', '2024-11-14 11:42:52'),
(65, '2024-11-16', 'PK-0000000065', '3423', 1, NULL, 'confirm', '2024-11-15 17:59:19', '2024-11-15 17:59:37'),
(66, '2024-11-16', 'PK-0000000066', '3423', 1, NULL, 'confirm', '2024-11-15 18:00:25', '2024-11-15 18:14:33'),
(67, '2024-11-16', 'PK-0000000067', '5451', 1, NULL, 'confirm', '2024-11-15 22:01:17', '2024-11-15 22:02:23'),
(68, '2024-11-16', 'PK-0000000068', '5555', 1, NULL, 'draft', '2024-11-15 22:24:19', '2024-11-15 22:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `packing_details`
--

CREATE TABLE `packing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `packing_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `block_id` bigint(20) DEFAULT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `remain_quantity` int(11) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packing_details`
--

INSERT INTO `packing_details` (`id`, `packing_id`, `product_id`, `block_id`, `ref_no`, `quantity`, `remain_quantity`, `remark`, `created_at`, `updated_at`) VALUES
(79, 55, 1, NULL, '001', 100, 100, NULL, '2024-11-13 06:37:26', '2024-11-13 06:37:26'),
(80, 56, 1, 43, '001', 100, 0, NULL, '2024-11-13 06:42:27', '2024-11-13 08:37:59'),
(81, 56, 1, 43, '003', 100, 0, NULL, '2024-11-13 08:33:24', '2024-11-13 08:37:59'),
(82, 58, 1, 44, '003', 100, 0, NULL, '2024-11-13 08:34:40', '2024-11-13 08:46:18'),
(83, 59, 1, 45, '001', 100, 0, NULL, '2024-11-13 08:44:37', '2024-11-15 18:15:07'),
(84, 60, 1, 40, '001', 100, 0, NULL, '2024-11-13 08:48:10', '2024-11-15 18:14:42'),
(85, 61, 1, 41, '001', 100, 0, NULL, '2024-11-14 09:41:49', '2024-11-15 18:15:07'),
(86, 62, 1, 53, '001', 100, 100, NULL, '2024-11-14 10:13:50', '2024-11-14 10:13:54'),
(87, 63, 1, 42, '001', 100, 0, NULL, '2024-11-14 10:23:56', '2024-11-15 18:15:07'),
(88, 64, 1, NULL, '001', 100, 100, NULL, '2024-11-14 11:42:56', '2024-11-14 11:42:56'),
(89, 65, 1, 37, '001', 100, 100, NULL, '2024-11-15 17:59:24', '2024-11-15 17:59:32'),
(90, 66, 1, 52, '321', 100, 100, NULL, '2024-11-15 18:00:33', '2024-11-15 18:14:29'),
(91, 67, 1, 38, '321', 100, 100, NULL, '2024-11-15 22:01:22', '2024-11-15 22:01:29'),
(92, 68, 1, NULL, '5552', 100, 100, NULL, '2024-11-15 22:25:53', '2024-11-15 22:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'authToken', 'e25eb5af19269958a959a1a4f632bc92f7b5f4010afbcf404623a35bc4675c26', '[\"*\"]', NULL, NULL, '2024-11-14 10:27:53', '2024-11-14 10:27:53'),
(2, 'App\\Models\\User', 1, 'authToken', '505da6572c6be7d5c0476796907a9821d2f1a05f65a42114c664c499350ee291', '[\"*\"]', NULL, NULL, '2024-11-14 10:32:50', '2024-11-14 10:32:50'),
(3, 'App\\Models\\User', 1, 'authToken', 'e1d68def64b218cdeac144e3ba3bb221ba652eb7ef3ab7d049bdbe633a75e22a', '[\"*\"]', NULL, NULL, '2024-11-14 10:34:21', '2024-11-14 10:34:21'),
(4, 'App\\Models\\User', 1, 'authToken', 'e8179827116defb70b3fa591827f61dc183edf6cea26ff76148cb98f5353669f', '[\"*\"]', NULL, NULL, '2024-11-14 10:35:02', '2024-11-14 10:35:02'),
(5, 'App\\Models\\User', 1, 'authToken', 'd56d25f3145b86593c6beabdc998f6a7165a66425662e23a875ff694c878d493', '[\"*\"]', NULL, NULL, '2024-11-14 10:36:40', '2024-11-14 10:36:40'),
(6, 'App\\Models\\User', 1, 'authToken', 'd9836249ff735a5038ca235500d09a70dd1075b5cff7c663535e91728f607709', '[\"*\"]', NULL, NULL, '2024-11-14 10:42:27', '2024-11-14 10:42:27'),
(7, 'App\\Models\\User', 1, 'authToken', 'b1454caf4a1d422969998e8c7483d7493548517a718625ea64db8bc0c91dae9e', '[\"*\"]', NULL, NULL, '2024-11-14 10:42:28', '2024-11-14 10:42:28'),
(8, 'App\\Models\\User', 1, 'authToken', '9cdcc330c6819bc48b291dbbb43e36b84b6ba2a2e7429bd09e7b9c287cde4b86', '[\"*\"]', NULL, NULL, '2024-11-14 10:47:51', '2024-11-14 10:47:51'),
(9, 'App\\Models\\User', 1, 'authToken', '959ffb27ba16c17fcf493e973e42f644b6caef4491655d608c846b275cd58ed5', '[\"*\"]', NULL, NULL, '2024-11-14 10:47:59', '2024-11-14 10:47:59'),
(10, 'App\\Models\\User', 1, 'authToken', '2750e62d598893847b24128ab0c857f5a22e8ba275e504c871ff43b8fcb318d5', '[\"*\"]', NULL, NULL, '2024-11-14 10:48:04', '2024-11-14 10:48:04'),
(11, 'App\\Models\\User', 1, 'authToken', '91a889450363f10513629bf6c736cdd73da1c4a6c016a2c11c3cedf22dba4d8c', '[\"*\"]', NULL, NULL, '2024-11-14 10:48:46', '2024-11-14 10:48:46'),
(12, 'App\\Models\\User', 1, 'authToken', '49bc434eedbc00133ebbc6c2704d4c3ea927c731cee7c82ee66cb0ed6bd6100a', '[\"*\"]', NULL, NULL, '2024-11-14 10:49:04', '2024-11-14 10:49:04'),
(13, 'App\\Models\\User', 1, 'authToken', '0cfc6bf378c21043290eda6769b85a5478d267b7860b04b5da835feedb25cd04', '[\"*\"]', NULL, NULL, '2024-11-14 10:51:19', '2024-11-14 10:51:19'),
(14, 'App\\Models\\User', 1, 'authToken', '0c92f6772809e61cfcf1fc5836711ede891698d1d8670152ad336c6b8562e9a6', '[\"*\"]', NULL, NULL, '2024-11-14 10:52:09', '2024-11-14 10:52:09'),
(15, 'App\\Models\\User', 1, 'authToken', '3e4a04947e8087d4b4306abc92bccd0b938406290c9ce2630e4383d968e0738d', '[\"*\"]', NULL, NULL, '2024-11-14 10:53:22', '2024-11-14 10:53:22'),
(16, 'App\\Models\\User', 1, 'authToken', '253fcd72ac313ee4c99b5ba73254f8e9c57705fcefeeca0930eda8e45f2ec816', '[\"*\"]', NULL, NULL, '2024-11-14 10:53:23', '2024-11-14 10:53:23'),
(17, 'App\\Models\\User', 1, 'authToken', '260eb682bf895472a0c68c2c93b5a40a263af8f59858a42d1ca23509a380b69a', '[\"*\"]', NULL, NULL, '2024-11-14 10:53:24', '2024-11-14 10:53:24'),
(18, 'App\\Models\\User', 1, 'authToken', '7a1e5c3564e2c934d1f96e278deaefe872273b966028eb829d3ac20e59a72328', '[\"*\"]', NULL, NULL, '2024-11-14 10:54:41', '2024-11-14 10:54:41'),
(19, 'App\\Models\\User', 1, 'authToken', 'a3198e82f78f8fd215cc27c7b0f321ec00711050fa1586e0bbb89e34798b976a', '[\"*\"]', NULL, NULL, '2024-11-14 10:54:48', '2024-11-14 10:54:48'),
(20, 'App\\Models\\User', 1, 'authToken', '8da3855869f31847436b54f53284c607c265e8085a9772884795fcd931d934b2', '[\"*\"]', NULL, NULL, '2024-11-14 10:54:53', '2024-11-14 10:54:53'),
(21, 'App\\Models\\User', 1, 'authToken', 'bbf24d0616663b0394e549380b1060cb188a6381c396f09b41721ad65115d40d', '[\"*\"]', NULL, NULL, '2024-11-14 10:55:03', '2024-11-14 10:55:03'),
(22, 'App\\Models\\User', 1, 'authToken', '39bd87a18eaf2a44b13ae161481fc2a33f6b7a26ddd897deeee524ffa650c9f1', '[\"*\"]', NULL, NULL, '2024-11-14 10:55:47', '2024-11-14 10:55:47'),
(23, 'App\\Models\\User', 1, 'authToken', '4cb91fe9c7e6e35e734144829dfea7b5d689cbc3ebd1e43e688ac04c2d29c4a0', '[\"*\"]', NULL, NULL, '2024-11-14 10:55:56', '2024-11-14 10:55:56'),
(24, 'App\\Models\\User', 1, 'authToken', '7d5ca59c5ce4b52a2f1257eb5794333403b5b77b2fb85807fa3850adf84707be', '[\"*\"]', NULL, NULL, '2024-11-14 11:10:59', '2024-11-14 11:10:59'),
(25, 'App\\Models\\User', 1, 'authToken', '9ab96c39d64ee19306e82cd4e609b29b63d5d78c068c495edfd5c705b22ad8de', '[\"*\"]', NULL, NULL, '2024-11-14 11:11:00', '2024-11-14 11:11:00'),
(26, 'App\\Models\\User', 1, 'authToken', 'fb25b12b4234370a8da695326947a63e9c2ebbd249b19615a50350191f6ce918', '[\"*\"]', NULL, NULL, '2024-11-14 11:11:01', '2024-11-14 11:11:01'),
(27, 'App\\Models\\User', 1, 'authToken', '28198382f55adbc146c859ad56ab22a9842bdee273664159bafa3087c3dd152b', '[\"*\"]', NULL, NULL, '2024-11-14 11:11:02', '2024-11-14 11:11:02'),
(28, 'App\\Models\\User', 1, 'authToken', '0404d800ef966e16d71a174edc29025d2b882baed930177fb4045828281b89d8', '[\"*\"]', NULL, NULL, '2024-11-14 11:11:03', '2024-11-14 11:11:03'),
(29, 'App\\Models\\User', 1, 'authToken', 'db7dc827f547c87e55da4b0a4e448c609851397b00671abb9d37c30d0c57440e', '[\"*\"]', NULL, NULL, '2024-11-14 11:11:03', '2024-11-14 11:11:03'),
(30, 'App\\Models\\User', 1, 'authToken', 'c79e6f39d304adaf4f71d201a5c56ae7df4c696013c735494110e608c7b9a203', '[\"*\"]', NULL, NULL, '2024-11-15 22:00:54', '2024-11-15 22:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `product_type_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `ref_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `product_type_id`, `ref_id`, `created_at`, `updated_at`) VALUES
(1, 'SHAFT', 'TCP6061', 1, 3259, '2024-06-20 11:35:31', '2024-06-20 11:35:31'),
(2, 'LATCH_SHAFT', 'CPT5604', 1, 2743, '2024-06-20 11:37:27', '2024-06-20 11:37:27'),
(3, 'Plastic Tray 50 Locks.Mat : Pet 0.50 mm. [ 192x250x20 mm ]', 'TRAY50.192*250*20', 2, 9735, '2024-06-20 11:40:21', '2024-06-20 11:40:21'),
(4, 'LDPE Roll Size : 3cmx0.05mm.', 'LDPE3x0.05', 2, 17227, '2024-06-20 11:41:38', '2024-06-20 11:41:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Production', '2024-06-20 11:31:19', '2024-06-20 11:31:19'),
(2, 'Purchase', '2024-06-20 11:31:19', '2024-06-20 11:31:19'),
(3, 'Other', '2024-06-20 11:31:46', '2024-06-20 11:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `racks`
--

CREATE TABLE `racks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `rows` int(11) NOT NULL,
  `columns` int(11) NOT NULL,
  `depth` double(8,2) NOT NULL,
  `status` enum('draft','confirm','disable') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `racks`
--

INSERT INTO `racks` (`id`, `name`, `location_id`, `rows`, `columns`, `depth`, `status`, `created_at`, `updated_at`) VALUES
(30, 'A1', 2, 3, 3, 120.00, 'confirm', '2024-11-13 06:36:54', '2024-11-13 06:36:56'),
(31, 'A2', 2, 3, 3, 120.00, 'confirm', '2024-11-13 06:37:41', '2024-11-13 06:37:43'),
(32, 'A3', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:41:19', '2024-11-13 06:41:20'),
(33, 'A4', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:41:25', '2024-11-13 06:41:27'),
(34, 'A5', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:41:32', '2024-11-13 06:41:35'),
(35, 'A6', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:41:39', '2024-11-13 06:41:41'),
(36, 'A7', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:41:48', '2024-11-13 06:41:50'),
(37, 'A8', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:41:55', '2024-11-13 06:41:56'),
(38, 'A9', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:42:01', '2024-11-13 06:42:03'),
(39, 'A10', 1, 3, 3, 120.00, 'confirm', '2024-11-13 06:42:08', '2024-11-13 06:42:10');

-- --------------------------------------------------------

--
-- Table structure for table `report_items`
--

CREATE TABLE `report_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report_items`
--

INSERT INTO `report_items` (`id`, `product_code`, `quantity`, `status`, `comment`, `created_at`) VALUES
(4, 'test', '100', 'ggez', 'เทสๆ', '2024-11-14 19:34:27'),
(5, 'test1', '69', 'ggez', 'เทสๆ', '2024-11-14 19:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `branch_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `branch_id`) VALUES
(1, 'Alana Krajcik', 'admin@test.com', '2024-06-20 04:14:14', '$2y$12$xdslXzEvc8hBblxPCaUCV.z5uEgS3Svz.R2adH8lH.Xu90uAVEviG', 'uAr58VkxiBkAdjZ8MHdlGlDPRm59pkwK2op8oxAysnkbWKDSFpJT5amL9SuU', '2024-06-20 04:14:14', '2024-06-20 04:14:14', 'admin', 4),
(2, 'Rogers Homenick III', 'david.emmerich@example.net', '2024-06-20 04:14:14', '$2y$12$xdslXzEvc8hBblxPCaUCV.z5uEgS3Svz.R2adH8lH.Xu90uAVEviG', '8up43sdQEg', '2024-06-20 04:14:14', '2024-06-20 04:14:14', 'staff', 5),
(3, 'Dr. Kailee Renner V', 'admin@example.org', '2024-06-20 04:14:14', '$2y$12$xdslXzEvc8hBblxPCaUCV.z5uEgS3Svz.R2adH8lH.Xu90uAVEviG', '14DdXlEFAa', '2024-06-20 04:14:14', '2024-06-20 04:14:14', 'admin', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_outs`
--
ALTER TABLE `check_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_out_details`
--
ALTER TABLE `check_out_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packings`
--
ALTER TABLE `packings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packing_details`
--
ALTER TABLE `packing_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `racks`
--
ALTER TABLE `racks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_items`
--
ALTER TABLE `report_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `check_outs`
--
ALTER TABLE `check_outs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `check_out_details`
--
ALTER TABLE `check_out_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `packings`
--
ALTER TABLE `packings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `packing_details`
--
ALTER TABLE `packing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `racks`
--
ALTER TABLE `racks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `report_items`
--
ALTER TABLE `report_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
