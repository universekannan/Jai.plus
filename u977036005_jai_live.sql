-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 16, 2025 at 07:10 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u977036005_jai_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_income`
--

CREATE TABLE `admin_income` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_reason_id` int(11) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `widtdrawal_status` varchar(15) NOT NULL DEFAULT '0',
  `message` varchar(200) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_income`
--

INSERT INTO `admin_income` (`id`, `plan_id`, `user_type_id`, `from_id`, `to_id`, `pay_reason_id`, `amount`, `level`, `payment_status`, `widtdrawal_status`, `message`, `log_id`, `created_at`) VALUES
(1, 1, 3, 3, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 11:35:39'),
(2, 1, 3, 5, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 11:36:10'),
(3, 1, 3, 4, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 11:36:59'),
(4, 1, 3, 6, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 11:37:47'),
(5, 1, 3, 7, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 11:38:14'),
(6, 1, 3, 8, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 11:38:38'),
(7, 1, 3, 9, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 12:29:40'),
(8, 1, 3, 10, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 12:30:36'),
(9, 1, 3, 11, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 12:34:28'),
(10, 1, 3, 12, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 12:36:28'),
(11, 1, 3, 13, 1, 3, '50', 1, '1', '0', 'Service Charge', 1, '2025-09-16 12:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `iso2` char(2) NOT NULL,
  `iso3` char(3) NOT NULL,
  `phone_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso2`, `iso3`, `phone_code`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '93'),
(2, 'Albania', 'AL', 'ALB', '355'),
(3, 'Algeria', 'DZ', 'DZA', '213'),
(4, 'Andorra', 'AD', 'AND', '376'),
(5, 'Angola', 'AO', 'AGO', '244'),
(6, 'Argentina', 'AR', 'ARG', '54'),
(7, 'Armenia', 'AM', 'ARM', '374'),
(8, 'Australia', 'AU', 'AUS', '61'),
(9, 'Austria', 'AT', 'AUT', '43'),
(10, 'Azerbaijan', 'AZ', 'AZE', '994'),
(11, 'Bahamas', 'BS', 'BHS', '1-242'),
(12, 'Bahrain', 'BH', 'BHR', '973'),
(13, 'Bangladesh', 'BD', 'BGD', '880'),
(14, 'Belarus', 'BY', 'BLR', '375'),
(15, 'Belgium', 'BE', 'BEL', '32'),
(16, 'Belize', 'BZ', 'BLZ', '501'),
(17, 'Benin', 'BJ', 'BEN', '229'),
(18, 'Bhutan', 'BT', 'BTN', '975'),
(19, 'Bolivia', 'BO', 'BOL', '591'),
(20, 'Bosnia and Herzegovina', 'BA', 'BIH', '387'),
(21, 'Botswana', 'BW', 'BWA', '267'),
(22, 'Brazil', 'BR', 'BRA', '55'),
(23, 'Brunei', 'BN', 'BRN', '673'),
(24, 'Bulgaria', 'BG', 'BGR', '359'),
(25, 'Burkina Faso', 'BF', 'BFA', '226'),
(26, 'Burundi', 'BI', 'BDI', '257'),
(27, 'Cambodia', 'KH', 'KHM', '855'),
(28, 'Cameroon', 'CM', 'CMR', '237'),
(29, 'Canada', 'CA', 'CAN', '1'),
(30, 'Chile', 'CL', 'CHL', '56'),
(31, 'China', 'CN', 'CHN', '86'),
(32, 'Colombia', 'CO', 'COL', '57'),
(33, 'Costa Rica', 'CR', 'CRI', '506'),
(34, 'Croatia', 'HR', 'HRV', '385'),
(35, 'Cuba', 'CU', 'CUB', '53'),
(36, 'Cyprus', 'CY', 'CYP', '357'),
(37, 'Czech Republic', 'CZ', 'CZE', '420'),
(38, 'Denmark', 'DK', 'DNK', '45'),
(39, 'Djibouti', 'DJ', 'DJI', '253'),
(40, 'Dominican Republic', 'DO', 'DOM', '1-809'),
(41, 'Ecuador', 'EC', 'ECU', '593'),
(42, 'Egypt', 'EG', 'EGY', '20'),
(43, 'El Salvador', 'SV', 'SLV', '503'),
(44, 'Estonia', 'EE', 'EST', '372'),
(45, 'Ethiopia', 'ET', 'ETH', '251'),
(46, 'Finland', 'FI', 'FIN', '358'),
(47, 'France', 'FR', 'FRA', '33'),
(48, 'Georgia', 'GE', 'GEO', '995'),
(49, 'Germany', 'DE', 'DEU', '49'),
(50, 'Ghana', 'GH', 'GHA', '233'),
(51, 'Greece', 'GR', 'GRC', '30'),
(52, 'Greenland', 'GL', 'GRL', '299'),
(53, 'Guatemala', 'GT', 'GTM', '502'),
(54, 'Honduras', 'HN', 'HND', '504'),
(55, 'Hong Kong', 'HK', 'HKG', '852'),
(56, 'Hungary', 'HU', 'HUN', '36'),
(57, 'Iceland', 'IS', 'ISL', '354'),
(58, 'India', 'IN', 'IND', '91'),
(59, 'Indonesia', 'ID', 'IDN', '62'),
(60, 'Iran', 'IR', 'IRN', '98'),
(61, 'Iraq', 'IQ', 'IRQ', '964'),
(62, 'Ireland', 'IE', 'IRL', '353'),
(63, 'Israel', 'IL', 'ISR', '972'),
(64, 'Italy', 'IT', 'ITA', '39'),
(65, 'Jamaica', 'JM', 'JAM', '1-876'),
(66, 'Japan', 'JP', 'JPN', '81'),
(67, 'Jordan', 'JO', 'JOR', '962'),
(68, 'Kazakhstan', 'KZ', 'KAZ', '7'),
(69, 'Kenya', 'KE', 'KEN', '254'),
(70, 'Kuwait', 'KW', 'KWT', '965'),
(71, 'Kyrgyzstan', 'KG', 'KGZ', '996'),
(72, 'Laos', 'LA', 'LAO', '856'),
(73, 'Latvia', 'LV', 'LVA', '371'),
(74, 'Lebanon', 'LB', 'LBN', '961'),
(75, 'Libya', 'LY', 'LBY', '218'),
(76, 'Lithuania', 'LT', 'LTU', '370'),
(77, 'Luxembourg', 'LU', 'LUX', '352'),
(78, 'Macau', 'MO', 'MAC', '853'),
(79, 'Malaysia', 'MY', 'MYS', '60'),
(80, 'Maldives', 'MV', 'MDV', '960'),
(81, 'Mali', 'ML', 'MLI', '223'),
(82, 'Malta', 'MT', 'MLT', '356'),
(83, 'Mexico', 'MX', 'MEX', '52'),
(84, 'Moldova', 'MD', 'MDA', '373'),
(85, 'Monaco', 'MC', 'MCO', '377'),
(86, 'Mongolia', 'MN', 'MNG', '976'),
(87, 'Montenegro', 'ME', 'MNE', '382'),
(88, 'Morocco', 'MA', 'MAR', '212'),
(89, 'Mozambique', 'MZ', 'MOZ', '258'),
(90, 'Myanmar', 'MM', 'MMR', '95'),
(91, 'Namibia', 'NA', 'NAM', '264'),
(92, 'Nepal', 'NP', 'NPL', '977'),
(93, 'Netherlands', 'NL', 'NLD', '31'),
(94, 'New Zealand', 'NZ', 'NZL', '64'),
(95, 'Nicaragua', 'NI', 'NIC', '505'),
(96, 'Nigeria', 'NG', 'NGA', '234'),
(97, 'North Korea', 'KP', 'PRK', '850'),
(98, 'Norway', 'NO', 'NOR', '47'),
(99, 'Oman', 'OM', 'OMN', '968'),
(100, 'Pakistan', 'PK', 'PAK', '92'),
(101, 'Panama', 'PA', 'PAN', '507'),
(102, 'Paraguay', 'PY', 'PRY', '595'),
(103, 'Peru', 'PE', 'PER', '51'),
(104, 'Philippines', 'PH', 'PHL', '63'),
(105, 'Poland', 'PL', 'POL', '48'),
(106, 'Portugal', 'PT', 'PRT', '351'),
(107, 'Qatar', 'QA', 'QAT', '974'),
(108, 'Romania', 'RO', 'ROU', '40'),
(109, 'Russia', 'RU', 'RUS', '7'),
(110, 'Saudi Arabia', 'SA', 'SAU', '966'),
(111, 'Serbia', 'RS', 'SRB', '381'),
(112, 'Singapore', 'SG', 'SGP', '65'),
(113, 'Slovakia', 'SK', 'SVK', '421'),
(114, 'Slovenia', 'SI', 'SVN', '386'),
(115, 'Somalia', 'SO', 'SOM', '252'),
(116, 'South Africa', 'ZA', 'ZAF', '27'),
(117, 'South Korea', 'KR', 'KOR', '82'),
(118, 'Spain', 'ES', 'ESP', '34'),
(119, 'Sri Lanka', 'LK', 'LKA', '94'),
(120, 'Sudan', 'SD', 'SDN', '249'),
(121, 'Sweden', 'SE', 'SWE', '46'),
(122, 'Switzerland', 'CH', 'CHE', '41'),
(123, 'Syria', 'SY', 'SYR', '963'),
(124, 'Taiwan', 'TW', 'TWN', '886'),
(125, 'Tajikistan', 'TJ', 'TJK', '992'),
(126, 'Tanzania', 'TZ', 'TZA', '255'),
(127, 'Thailand', 'TH', 'THA', '66'),
(128, 'Tunisia', 'TN', 'TUN', '216'),
(129, 'Turkey', 'TR', 'TUR', '90'),
(130, 'Turkmenistan', 'TM', 'TKM', '993'),
(131, 'Uganda', 'UG', 'UGA', '256'),
(132, 'Ukraine', 'UA', 'UKR', '380'),
(133, 'United Arab Emirates', 'AE', 'ARE', '971'),
(134, 'United Kingdom', 'GB', 'GBR', '44'),
(135, 'United States', 'US', 'USA', '1'),
(136, 'Uruguay', 'UY', 'URY', '598'),
(137, 'Uzbekistan', 'UZ', 'UZB', '998'),
(138, 'Venezuela', 'VE', 'VEN', '58'),
(139, 'Vietnam', 'VN', 'VNM', '84'),
(140, 'Yemen', 'YE', 'YEM', '967'),
(141, 'Zambia', 'ZM', 'ZMB', '260'),
(142, 'Zimbabwe', 'ZW', 'ZWE', '263');

-- --------------------------------------------------------

--
-- Table structure for table `global_regain`
--

CREATE TABLE `global_regain` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_reason_id` int(11) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `widtdrawal_status` varchar(20) NOT NULL DEFAULT '0',
  `global_regain_amount` varchar(20) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `global_regain`
--

INSERT INTO `global_regain` (`id`, `plan_id`, `user_type_id`, `from_id`, `to_id`, `pay_reason_id`, `amount`, `widtdrawal_status`, `global_regain_amount`, `level`, `payment_status`, `message`, `log_id`, `status`, `created_at`) VALUES
(1, 1, 3, 2, 1, 2, '100', '1', '0', 1, '1', 'Global regain Income', 1, 0, '2025-08-26 12:42:29'),
(2, 2, 3, 2, 1, 2, '200', '1', '0', NULL, NULL, NULL, NULL, 0, NULL),
(3, 3, 3, 2, 1, 2, '400', '1', '0', NULL, NULL, NULL, NULL, 0, NULL),
(4, 4, 3, 2, 1, 2, '600', '1', '0', NULL, NULL, NULL, NULL, 0, NULL),
(5, 5, 3, 2, 1, 2, '800', '1', '0', NULL, NULL, NULL, NULL, 0, NULL),
(6, 6, 3, 2, 1, 2, '1000', '1', '0', 1, '1', 'Global Regain Income', 4, 0, '2025-09-15 17:41:08'),
(7, 7, 3, 2, 1, 2, '1200', '1', '0', 1, '1', 'Global Regain Income', 4, 0, '2025-09-15 17:41:55'),
(8, 8, 3, 2, 1, 2, '1400', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 10:54:33'),
(9, 9, 3, 2, 1, 2, '1600', '1', '0', 0, NULL, 'Global Regain Income', NULL, 0, NULL),
(10, 1, 3, 2, 3, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 11:35:38'),
(11, 1, 3, 2, 5, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 11:36:10'),
(12, 1, 3, 2, 4, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 11:36:59'),
(13, 1, 3, 2, 6, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 11:37:47'),
(14, 1, 3, 2, 7, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 11:38:14'),
(15, 1, 3, 3, 8, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 11:38:38'),
(16, 1, 3, 3, 9, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 12:29:40'),
(17, 1, 3, 3, 10, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 12:30:36'),
(18, 1, 3, 3, 11, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 12:34:28'),
(19, 1, 3, 3, 12, 2, '100', '1', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 12:36:28'),
(20, 1, 3, 4, 13, 2, '100', '0', '0', 1, '1', 'Global Regain Income', 1, 0, '2025-09-16 12:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_reason_id` int(11) DEFAULT NULL,
  `amount` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_reason`
--

CREATE TABLE `payment_reason` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_reason`
--

INSERT INTO `payment_reason` (`id`, `name`) VALUES
(1, 'Sponser'),
(2, 'Global Rebirth'),
(3, 'Upline Sponser'),
(4, 'Upgrade'),
(5, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `plan_name` varchar(20) DEFAULT NULL,
  `plan_amount` varchar(20) DEFAULT NULL,
  `sponser_amount` varchar(20) DEFAULT NULL,
  `upline_amount` varchar(20) DEFAULT NULL,
  `upgrade_amount` varchar(20) DEFAULT NULL,
  `regain_amount` varchar(20) DEFAULT NULL,
  `service_amount` int(11) NOT NULL DEFAULT 0,
  `status` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `plan_amount`, `sponser_amount`, `upline_amount`, `upgrade_amount`, `regain_amount`, `service_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HAPPINESS', '500', '50', '20', NULL, '20', 10, '1', '2025-08-14 14:44:08', '2025-09-15 10:02:32'),
(2, 'HEALTH', '1000', '50', '20', NULL, '20', 10, '1', '2025-08-14 14:45:22', '2025-09-15 10:02:48'),
(3, 'WEALTH', '2000', '50', '20', NULL, '20', 10, '1', '2025-08-14 14:45:55', '2025-09-15 10:03:19'),
(4, 'SOCIAL', '3000', '50', '20', NULL, '20', 10, '1', '2025-08-14 14:46:22', '2025-09-15 10:03:39'),
(5, 'SPIRITUAL', '4000', '50', '20', NULL, '20', 10, '1', '2025-08-14 14:46:52', '2025-09-15 10:04:00'),
(6, 'HAPPINESS +', '5000', '50', '20', NULL, '20', 10, '1', '2025-09-15 10:04:35', NULL),
(7, 'HEALTH +', '6000', '50', '20', NULL, '20', 10, '1', '2025-09-15 10:05:11', NULL),
(8, 'WEALTH +', '7000', '50', '20', NULL, '20', 10, '1', '2025-09-15 10:05:51', NULL),
(9, 'SOCIAL +', '9000', '50', '20', NULL, '20', 10, '1', '2025-09-15 10:07:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_payment_request`
--

CREATE TABLE `plan_payment_request` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plan_payment_request`
--

INSERT INTO `plan_payment_request` (`id`, `plan_id`, `amount`, `user_id`, `image`, `status`, `created_at`) VALUES
(1, 1, '500', 3, 'uploads/payments/1758002725_Screenshot (8).png', 1, '2025-09-16 11:35:38'),
(2, 1, '500', 5, 'uploads/payments/1758002762_Screenshot (9).png', 1, '2025-09-16 11:36:10'),
(3, 1, '500', 4, 'uploads/payments/1758002812_masalaspices_1755775032.png', 1, '2025-09-16 11:36:59'),
(4, 1, '500', 6, 'uploads/payments/1758002845_Screenshot (6).png', 1, '2025-09-16 11:37:47'),
(5, 1, '500', 7, 'uploads/payments/1758002882_Screenshot (6).png', 1, '2025-09-16 11:38:14'),
(6, 1, '500', 8, 'uploads/payments/1758002910_Screenshot (8).png', 1, '2025-09-16 11:38:38'),
(7, 1, '500', 9, 'uploads/payments/1758005965_Screenshot (16).png', 1, '2025-09-16 12:29:40'),
(8, 1, '500', 10, 'uploads/payments/1758006029_Screenshot (14).png', 1, '2025-09-16 12:30:36'),
(9, 1, '500', 11, 'uploads/payments/1758006170_Screenshot (14).png', 1, '2025-09-16 12:34:28'),
(10, 1, '500', 12, 'uploads/payments/1758006328_Screenshot (12).png', 1, '2025-09-16 12:36:28'),
(11, 1, '500', 13, 'uploads/payments/1758006477_Screenshot (16).png', 1, '2025-09-16 12:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`) VALUES
(1, 'name', 'Tourist Family club', '2025-08-11 09:45:06'),
(2, 'keyword', 'Tourist Family club', '2025-08-11 09:45:06'),
(3, 'metadata', 'Tourist Family club', '2025-08-11 09:45:06'),
(4, 'description', 'Tourist Family club', '2025-08-11 09:45:06'),
(5, 'favicon', 'upload/settings/favicon_1748686209.png', '2025-05-31 15:40:09'),
(6, 'logo', 'upload/settings/logo_1748686209.png', '2025-05-31 15:40:09'),
(7, 'share_image', 'upload/settings/share_image_1748686209.png', '2025-05-31 15:40:09'),
(8, 'email', 'tfc@gmail.com', '2025-08-11 09:45:06'),
(9, 'phone', '+91 9876543210', '2025-08-11 09:45:06'),
(10, 'address', 'Tourist Family club', '2025-08-11 09:45:06'),
(11, 'map', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d505474.78745464043!2d77.25062500000001!3d8.20056!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b04fe851f632f0b%3A0xed4ca2bcce3a7b91!2sAnakuzhi%20Asan%20-%20Dr.%20Gunam%20Hospital!5e0!3m2!1sen!2sin!4v1748685016767!5m2!1sen!2sin\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2025-08-11 09:45:06'),
(12, 'facebook', 'https://www.facebook.com/', '2025-08-11 09:45:06'),
(13, 'youtube', 'https://www.youtube.com/@ANAKUZHIASAN', '2025-08-11 09:45:06'),
(14, 'instagram', 'https://www.instagram.com/', '2025-08-11 09:45:06'),
(15, 'thread', 'https://www.threads.com/?hl=en', '2025-08-11 09:45:06'),
(16, 'bussiness_area', 'South India, Nagercoil', '2025-08-11 09:45:06'),
(17, 'website_url', 'https://dooron.co/', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sponser_income`
--

CREATE TABLE `sponser_income` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_reason_id` int(11) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `widtdrawal_status` varchar(15) NOT NULL DEFAULT '0',
  `message` varchar(200) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sponser_income`
--

INSERT INTO `sponser_income` (`id`, `plan_id`, `user_type_id`, `from_id`, `to_id`, `pay_reason_id`, `amount`, `level`, `payment_status`, `widtdrawal_status`, `message`, `log_id`, `created_at`) VALUES
(1, 1, 3, 3, 2, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 11:35:38'),
(2, 1, 3, 5, 4, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 11:36:10'),
(3, 1, 3, 4, 3, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 11:36:59'),
(4, 1, 3, 6, 5, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 11:37:47'),
(5, 1, 3, 7, 6, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 11:38:14'),
(6, 1, 3, 8, 7, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 11:38:38'),
(7, 1, 3, 9, 8, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 12:29:40'),
(8, 1, 3, 10, 9, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 12:30:36'),
(9, 1, 3, 11, 10, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 12:34:28'),
(10, 1, 3, 12, 11, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 12:36:28'),
(11, 1, 3, 13, 12, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 1, '2025-09-16 12:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `upline_income`
--

CREATE TABLE `upline_income` (
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_reason_id` int(11) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `payment_status` varchar(20) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `upline_income`
--

INSERT INTO `upline_income` (`id`, `plan_id`, `user_type_id`, `from_id`, `to_id`, `pay_reason_id`, `amount`, `level`, `payment_status`, `message`, `log_id`, `created_at`) VALUES
(1, 1, 3, 3, 2, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 11:35:38'),
(2, 1, 3, 5, 4, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 11:36:10'),
(3, 1, 3, 4, 3, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 11:36:59'),
(4, 1, 3, 6, 5, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 11:37:47'),
(5, 1, 3, 7, 6, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 11:38:14'),
(6, 1, 3, 8, 7, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 11:38:38'),
(7, 1, 3, 9, 8, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 12:29:40'),
(8, 1, 3, 10, 9, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 12:30:36'),
(9, 1, 3, 11, 10, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 12:34:28'),
(10, 1, 3, 12, 11, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 12:36:28'),
(11, 1, 3, 13, 12, 3, '100', 1, '1', 'Upline Sponsor', 1, '2025-09-16 12:38:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `global_id` int(11) DEFAULT NULL,
  `referral_id` int(10) DEFAULT NULL,
  `user_type_id` int(10) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(10) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpassword` varchar(20) DEFAULT NULL,
  `wallet` varchar(10) DEFAULT '0',
  `status` int(11) DEFAULT 1,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `wallet_address` varchar(50) DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(200) DEFAULT 'upload/profile_photo/user.png',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_id` int(11) DEFAULT 0,
  `message` varchar(20) DEFAULT 'Nonvisitor',
  `bankBranch` varchar(50) DEFAULT NULL,
  `bankName` varchar(50) DEFAULT NULL,
  `aadharNo` varchar(50) DEFAULT NULL,
  `accountNo` int(50) DEFAULT NULL,
  `fcm_token` varchar(200) DEFAULT NULL,
  `ifscCode` varchar(30) DEFAULT NULL,
  `pancardNo` varchar(50) DEFAULT NULL,
  `theme` varchar(10) DEFAULT NULL,
  `referral_code` varchar(30) DEFAULT NULL,
  `global_rebirth_amount` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `global_id`, `referral_id`, `user_type_id`, `name`, `user_name`, `email`, `email_verified_at`, `password`, `cpassword`, `wallet`, `status`, `phone`, `whatsapp_number`, `address`, `wallet_address`, `remember_token`, `photo`, `created_at`, `updated_at`, `plan_id`, `message`, `bankBranch`, `bankName`, `aadharNo`, `accountNo`, `fcm_token`, `ifscCode`, `pancardNo`, `theme`, `referral_code`, `global_rebirth_amount`) VALUES
(1, 1, NULL, 1, 'Admin', 'JP0999', 'jaiplus@gmail.com', NULL, '$2y$10$w3UCJFqhijngNBLVU1cwmecl3TvpwmdLVgHGnjtG7WOmlhkOzkrFy', '12345678', '550', 1, '1234567890', NULL, NULL, '0x7509dEb5a6367E094BA35ac8f8F7b2c1997654f7', NULL, 'upload/profile_photo/1.png', '2025-08-14 16:43:22', '2025-09-16 12:38:07', 9, 'Nonvisitor', NULL, NULL, NULL, NULL, 'eK7FIO_zthVCNgi6MjfvCR:APA91bEvoDpqYrhIXNUSH5eZio-obveHbeY52srANxuK44xIENuiYtzYGGTsNLrZSRy-iGckPwcir9PZYt_tauxazpHH6rks_LoJdfxLr_hFAFUR0b_XCLk', NULL, NULL, NULL, NULL, '0'),
(2, 2, 1, 3, 'Arul', 'JP1000', 'arul@gmail.com', NULL, '$2y$10$Z6dg9EJGplG80BOBknMwX.6EgBfbvvzuWzu.Ulq1IfM2M/6irlrh.', '12345678', '2850', 1, '916381654512', '916381654512', NULL, 'Adfh', NULL, 'upload/profile_photo/user.png', '2025-09-11 07:01:08', '2025-09-16 11:38:14', 9, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(3, 3, 2, 3, 'demo1', 'JP1001', 'demo1@gmail.com', NULL, '$2y$10$EVFvFnRnU7uqOjB9TY7gz.QTkpm7oJYXt5LpwVIUr403r8SCMQEc.', '12345678', '850', 1, '8745632689', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 11:10:20', '2025-09-16 12:36:28', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(4, 4, 3, 3, 'DEMO2', 'JP1002', 'demo2@gmail.com', NULL, '$2y$10$RgGd8Mgkvi0PSrbTmefnYuR1hz/wSV0N3LKYT1pfPa0PCLZAEQmU6', '12345678', '350', 1, '9047736314', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 11:17:58', '2025-09-16 12:38:07', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100'),
(5, NULL, 4, 3, 'Testing', 'JP1003', 'testing12@gmail.com', NULL, '$2y$10$q8YPWwTV4J0Qww2qF/6tZeeBcl1dAWUW10R/9iNeakCpa.SZgfSdO', '12345678', '350', 1, '7565987834', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 11:19:20', '2025-09-16 11:37:47', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, 5, 3, 'Testing2', 'JP1004', 'testing2@gmail.com', NULL, '$2y$10$DvXDHpL8FjIX5RTPnLsimOg7ub1qGdIGf36LY8sjWLE6huRVmiwiK', '12345678', '350', 1, '9565987834', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 11:20:40', '2025-09-16 11:38:14', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, NULL, 6, 3, 'Test3', 'JP1005', 'test3@gmail.com', NULL, '$2y$10$RVkFcio18ZIXOVcBo5TrZuE1PDj0Zlc8EBYaGGHN88JRdO4K3j6xu', '12345678', '350', 1, '1234567890', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 11:22:02', '2025-09-16 11:38:38', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, 7, 3, 'Test4', 'JP1006', 'test4@gmail.com', NULL, '$2y$10$4AePEWRHnUXK2bHsOD0pPOWrHNt0e/Gf9..K0x4sg857Pdc9Rj8/u', '12345678', '350', 1, '9089909090', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 11:23:11', '2025-09-16 12:29:40', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, NULL, 8, 3, 'Test5', 'JP1007', 'test5@gmail.com', NULL, '$2y$10$Px3KI0Y1xhWS6pWcqzHAVOJCU2jXtFBvuH1CrquGlDrZCEOcKM5f6', '12345678', '350', 1, '1234567821', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 12:29:14', '2025-09-16 12:30:36', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, NULL, 9, 3, 'Test6', 'JP1008', 'test6@gmail.com', NULL, '$2y$10$kJWk/5vFkc7MZ5H4geId4ukkkORrcA9v5L1OFI7t09NTFc6fyURai', '12345678', '350', 1, '9898989898', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 12:30:19', '2025-09-16 12:34:28', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, 10, 3, 'Test7', 'JP1009', 'test7@gmail.com', NULL, '$2y$10$MKHbX4KT2Pfvk.mczjqqhuRw0BtKwN8oSQoEDzBy6F7Sa/92bzu.K', '12345678', '350', 1, '1234567897', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 12:32:28', '2025-09-16 12:36:28', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, 11, 3, 'Test8', 'JP1010', 'test8@gmail.com', NULL, '$2y$10$lBw0v9CDfiAKz6g98Ms7OOipuh455BTbyM.5qa/l8SNb3qe4q3THu', '12345678', '350', 1, '1234567676', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 12:35:17', '2025-09-16 12:38:07', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, 12, 3, 'Test9', 'JP1011', 'test9@gmail.com', NULL, '$2y$10$jwKwaPg7sU4McbSES8eN3u0fI3beYzwqEa8pAbS6K3fTaJ8piiYNy', '12345678', '0', 1, '8797898909', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-16 12:37:45', '2025-09-16 12:38:07', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_plan`
--

CREATE TABLE `user_plan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `amount` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_plan`
--

INSERT INTO `user_plan` (`id`, `user_id`, `plan_id`, `amount`, `created_at`, `created_by`) VALUES
(1, 1, 1, '500', '2025-09-08 10:09:56', 1),
(2, 1, 2, '2000', '2025-09-08 10:10:38', 1),
(3, 1, 3, '5000', '2025-09-08 10:10:41', 1),
(4, 1, 4, '7000', '2025-09-08 10:10:44', 1),
(5, 1, 5, '9000', '2025-09-08 10:10:46', 1),
(6, 1, 6, '5000', '2025-09-15 10:04:35', 1),
(7, 1, 7, '6000', '2025-09-15 10:05:11', 1),
(8, 1, 8, '7000', '2025-09-15 10:05:51', 1),
(9, 1, 9, '9000', '2025-09-15 10:07:00', 1),
(10, 2, 1, '500', '2025-09-16 11:11:10', 1),
(11, 2, 2, '1000', '2025-09-16 11:11:36', 1),
(12, 2, 3, '2000', '2025-09-16 11:11:55', 1),
(13, 2, 4, '3000', '2025-09-16 11:12:19', 1),
(14, 2, 5, '4000', '2025-09-16 11:12:44', 1),
(15, 2, 6, '5000', '2025-09-16 11:13:05', 1),
(16, 2, 7, '6000', '2025-09-16 11:13:24', 1),
(17, 2, 8, '7000', '2025-09-16 11:13:44', 1),
(18, 2, 9, '9000', '2025-09-16 11:14:04', 1),
(19, 3, 1, '500', '2025-09-16 11:35:38', 1),
(20, 5, 1, '500', '2025-09-16 11:36:10', 1),
(21, 4, 1, '500', '2025-09-16 11:36:59', 1),
(22, 6, 1, '500', '2025-09-16 11:37:47', 1),
(23, 7, 1, '500', '2025-09-16 11:38:14', 1),
(24, 8, 1, '500', '2025-09-16 11:38:38', 1),
(25, 9, 1, '500', '2025-09-16 12:29:40', 1),
(26, 10, 1, '500', '2025-09-16 12:30:36', 1),
(27, 11, 1, '500', '2025-09-16 12:34:28', 1),
(28, 12, 1, '500', '2025-09-16 12:36:28', 1),
(29, 13, 1, '500', '2025-09-16 12:38:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `usertype_name` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `usertype_name`, `status`) VALUES
(1, 'admin', 1),
(2, 'users', 1),
(3, 'Seller', 1),
(4, 'buyer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(15) NOT NULL,
  `user_id` int(20) DEFAULT NULL,
  `wallet_amount` varchar(20) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `created_at` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `wallet_amount`, `status`, `type`, `created_at`) VALUES
(1, 2, '500', '1', 'sponser_income', '2025-09-08 16:28:01'),
(2, 1, '250', '1', 'sponser_income', '2025-09-08 16:29:36'),
(3, 2, '500', '1', 'sponser_income', '2025-09-09 14:06:24'),
(4, 2, '500', '1', 'global_regain', '2025-09-16 12:08:42'),
(5, 2, '500', '1', 'global_regain', '2025-09-16 12:12:42'),
(6, 2, '500', '1', 'global_regain', '2025-09-16 12:26:14'),
(7, 2, '500', '1', 'global_regain', '2025-09-16 12:28:40'),
(8, 2, '500', '1', 'global_regain', '2025-09-16 12:31:22'),
(9, 2, '500', '1', 'global_regain', '2025-09-16 12:35:03'),
(10, 2, '500', '1', 'global_regain', '2025-09-16 12:38:14'),
(11, 3, '500', '1', 'global_regain', '2025-09-16 12:39:26');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal`
--

CREATE TABLE `withdrawal` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `tds_amount` decimal(10,2) NOT NULL,
  `youwillget` double(8,2) NOT NULL,
  `withdrawal_amount` decimal(10,2) NOT NULL,
  `new_balance` decimal(10,2) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `transfer_password` varchar(20) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal`
--

INSERT INTO `withdrawal` (`id`, `from_id`, `to_id`, `tds_amount`, `youwillget`, `withdrawal_amount`, `new_balance`, `status`, `message`, `transfer_password`, `time`, `created_at`, `updated_at`, `log_id`) VALUES
(1, 1, 1, 0.00, 0.00, 50.00, 1000.45, '2', 'TEST', NULL, NULL, '2025-09-08 16:29:54', '2025-09-08 16:30:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_income`
--
ALTER TABLE `admin_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_regain`
--
ALTER TABLE `global_regain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_reason`
--
ALTER TABLE `payment_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_payment_request`
--
ALTER TABLE `plan_payment_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponser_income`
--
ALTER TABLE `sponser_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upline_income`
--
ALTER TABLE `upline_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_plan`
--
ALTER TABLE `user_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdrawal`
--
ALTER TABLE `withdrawal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_income`
--
ALTER TABLE `admin_income`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `global_regain`
--
ALTER TABLE `global_regain`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_reason`
--
ALTER TABLE `payment_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `plan_payment_request`
--
ALTER TABLE `plan_payment_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sponser_income`
--
ALTER TABLE `sponser_income`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `upline_income`
--
ALTER TABLE `upline_income`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_plan`
--
ALTER TABLE `user_plan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
