-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2025 at 12:30 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm`
--

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
  `id` int(10) UNSIGNED NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `pay_reason_id` int(11) DEFAULT NULL,
  `amount` varchar(10) DEFAULT NULL,
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

INSERT INTO `global_regain` (`id`, `plan_id`, `user_type_id`, `from_id`, `to_id`, `pay_reason_id`, `amount`, `global_regain_amount`, `level`, `payment_status`, `message`, `log_id`, `status`, `created_at`) VALUES
(1, 1, 3, 2, 1, 2, '1', '0', 1, '1', 'Global regain Income', 2, 1, '2025-08-26 12:42:29'),
(2, 2, 3, 2, 1, 2, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL),
(3, 3, 3, 2, 1, 2, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL),
(4, 4, 3, 2, 1, 2, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL),
(5, 5, 3, 2, 1, 2, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL),
(36, 1, 3, 1, 2, 2, '500', '0', 1, '1', 'Global Regain Income (Admin fallback)', 2, 1, '2025-09-08 15:42:34'),
(37, 1, 3, 2, 9, 2, '500', '0', 1, '1', 'Global Regain Income', 9, 0, '2025-09-08 15:42:45'),
(38, 1, 3, 2, 10, 2, '500', '0', 1, '1', 'Global Regain Income', 10, 0, '2025-09-08 15:43:35'),
(39, 1, 3, 2, 11, 2, '500', '0', 1, '1', 'Global Regain Income', 11, 0, '2025-09-08 15:44:13'),
(40, 1, 3, 2, 12, 2, '500', '0', 1, '1', 'Global Regain Income', 12, 0, '2025-09-08 15:44:38'),
(41, 1, 3, 2, 13, 2, '500', '0', 1, '1', 'Global Regain Income', 13, 0, '2025-09-08 15:45:08'),
(42, 1, 3, 2, 13, 4, '0', '1', 1, '1', 'Upgrade Global Rebirth Income', 13, 0, '2025-09-08 15:45:08'),
(43, 1, 3, 2, 1, 5, '0', '1', 1, '1', 'Admin 10% Global Rebirth Income', 13, 0, '2025-09-08 15:45:08'),
(44, 1, 3, 9, 23, 2, '500', '0', 1, '1', 'Global Regain Income', 13, 0, '2025-09-08 15:45:08');

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
  `regain_amount` varchar(20) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `plan_name`, `plan_amount`, `sponser_amount`, `upline_amount`, `regain_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Health', '500', '250', '100', '100', '1', '2025-08-14 14:44:08', '2025-09-06 10:19:16'),
(2, 'Happiness', '2000', '1000', '400', '400', '1', '2025-08-14 14:45:22', '2025-09-06 10:20:11'),
(3, 'Envirolment', '5000', '2500', '1000', '1000', '1', '2025-08-14 14:45:55', '2025-09-06 10:20:57'),
(4, 'Spritnal', '7000', '3500', '1400', '1400', '1', '2025-08-14 14:46:22', '2025-09-06 10:21:36'),
(5, 'Economical', '9000', '4500', '1800', '1800', '1', '2025-08-14 14:46:52', '2025-09-06 10:23:37');

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
(1, 1, 3, 2, 1, 4, '25', 1, '1', '0', 'Referral Upgrade Bonus', 2, '2025-09-08 15:42:34'),
(2, 1, 3, 2, 1, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 2, '2025-09-08 15:42:34'),
(3, 1, 3, 2, 1, 5, '25', 1, '1', '0', 'Admin Bonus Upgrade', 2, '2025-09-08 15:42:34'),
(4, 1, 3, 9, 2, 4, '25', 1, '1', '0', 'Referral Upgrade Bonus', 9, '2025-09-08 15:42:44'),
(5, 1, 3, 9, 2, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 9, '2025-09-08 15:42:45'),
(6, 1, 3, 9, 1, 5, '25', 1, '1', '0', 'Admin Bonus Upgrade', 9, '2025-09-08 15:42:45'),
(7, 1, 3, 10, 9, 4, '25', 1, '1', '0', 'Referral Upgrade Bonus', 10, '2025-09-08 15:43:35'),
(8, 1, 3, 10, 9, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 10, '2025-09-08 15:43:35'),
(9, 1, 3, 10, 1, 5, '25', 1, '1', '0', 'Admin Bonus Upgrade', 10, '2025-09-08 15:43:35'),
(10, 1, 3, 11, 10, 4, '25', 1, '1', '0', 'Referral Upgrade Bonus', 11, '2025-09-08 15:44:13'),
(11, 1, 3, 11, 10, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 11, '2025-09-08 15:44:13'),
(12, 1, 3, 11, 1, 5, '25', 1, '1', '0', 'Admin Bonus Upgrade', 11, '2025-09-08 15:44:13'),
(13, 1, 3, 12, 11, 4, '25', 1, '1', '0', 'Referral Upgrade Bonus', 12, '2025-09-08 15:44:38'),
(14, 1, 3, 12, 11, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 12, '2025-09-08 15:44:38'),
(15, 1, 3, 12, 1, 5, '25', 1, '1', '0', 'Admin Bonus Upgrade', 12, '2025-09-08 15:44:38'),
(16, 1, 3, 13, 12, 4, '25', 1, '1', '0', 'Referral Upgrade Bonus', 13, '2025-09-08 15:45:08'),
(17, 1, 3, 13, 12, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 13, '2025-09-08 15:45:08'),
(18, 1, 3, 13, 1, 5, '25', 1, '1', '0', 'Admin Bonus Upgrade', 13, '2025-09-08 15:45:08'),
(19, 1, 3, 23, 2, 4, '25', 1, '1', '0', 'Referral Upgrade Bonus', 13, '2025-09-08 15:45:08'),
(20, 1, 3, 23, 2, 1, '250', 1, '1', '0', 'Referral Sponsor Income', 13, '2025-09-08 15:45:08'),
(21, 1, 3, 23, 1, 5, '25', 1, '1', '0', 'Admin Bonus Upgrade', 13, '2025-09-08 15:45:08');

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
(1, 1, 3, 2, 1, 3, '500', 1, '1', 'Upline Sponsor', 2, '2025-09-08 15:42:34'),
(2, 1, 3, 2, 1, 3, '50', 1, '1', 'Upline Sponsor Income', 2, '2025-09-08 15:42:34'),
(3, 1, 3, 2, 1, 5, '50', 1, '1', 'Admin 10% Upline Upgrade', 2, '2025-09-08 15:42:34'),
(4, 1, 3, 9, 2, 3, '500', 1, '1', 'Upline Sponsor', 9, '2025-09-08 15:42:45'),
(5, 1, 3, 9, 2, 3, '50', 1, '1', 'Upline Sponsor Income', 9, '2025-09-08 15:42:45'),
(6, 1, 3, 9, 2, 5, '50', 1, '1', 'Admin 10% Upline Upgrade', 9, '2025-09-08 15:42:45'),
(7, 1, 3, 10, 9, 3, '500', 1, '1', 'Upline Sponsor', 10, '2025-09-08 15:43:35'),
(8, 1, 3, 10, 9, 3, '50', 1, '1', 'Upline Sponsor Income', 10, '2025-09-08 15:43:35'),
(9, 1, 3, 10, 9, 5, '50', 1, '1', 'Admin 10% Upline Upgrade', 10, '2025-09-08 15:43:35'),
(10, 1, 3, 11, 10, 3, '500', 1, '1', 'Upline Sponsor', 11, '2025-09-08 15:44:13'),
(11, 1, 3, 11, 10, 3, '50', 1, '1', 'Upline Sponsor Income', 11, '2025-09-08 15:44:13'),
(12, 1, 3, 11, 10, 5, '50', 1, '1', 'Admin 10% Upline Upgrade', 11, '2025-09-08 15:44:13'),
(13, 1, 3, 12, 11, 3, '500', 1, '1', 'Upline Sponsor', 12, '2025-09-08 15:44:38'),
(14, 1, 3, 12, 11, 3, '50', 1, '1', 'Upline Sponsor Income', 12, '2025-09-08 15:44:38'),
(15, 1, 3, 12, 11, 5, '50', 1, '1', 'Admin 10% Upline Upgrade', 12, '2025-09-08 15:44:38'),
(16, 1, 3, 13, 12, 3, '500', 1, '1', 'Upline Sponsor', 13, '2025-09-08 15:45:08'),
(17, 1, 3, 13, 12, 3, '50', 1, '1', 'Upline Sponsor Income', 13, '2025-09-08 15:45:08'),
(18, 1, 3, 13, 12, 5, '50', 1, '1', 'Admin 10% Upline Upgrade', 13, '2025-09-08 15:45:08'),
(19, 1, 3, 23, 2, 3, '500', 1, '1', 'Upline Sponsor', 13, '2025-09-08 15:45:08'),
(20, 1, 3, 23, 2, 3, '50', 1, '1', 'Upline Sponsor Income', 13, '2025-09-08 15:45:08'),
(21, 1, 3, 23, 2, 5, '50', 1, '1', 'Admin 10% Upline Upgrade', 13, '2025-09-08 15:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `global_id` int(11) DEFAULT NULL,
  `referral_id` int(10) DEFAULT NULL,
  `user_type_id` int(10) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(10) DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpassword` varchar(20) DEFAULT NULL,
  `wallet` varchar(10) DEFAULT NULL,
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
  `fcm_token` varchar(200) DEFAULT NULL,
  `theme` varchar(10) DEFAULT NULL,
  `referral_code` varchar(30) DEFAULT NULL,
  `global_rebirth_amount` varchar(10) DEFAULT NULL,
  `upgrade` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `global_id`, `referral_id`, `user_type_id`, `name`, `user_name`, `email`, `email_verified_at`, `password`, `cpassword`, `wallet`, `status`, `phone`, `whatsapp_number`, `address`, `wallet_address`, `remember_token`, `photo`, `created_at`, `updated_at`, `plan_id`, `message`, `fcm_token`, `theme`, `referral_code`, `global_rebirth_amount`, `upgrade`) VALUES
(1, 1, NULL, 1, 'Admin', 'TFC1000', 'tfc@gmail.com', NULL, '$2y$10$w3UCJFqhijngNBLVU1cwmecl3TvpwmdLVgHGnjtG7WOmlhkOzkrFy', '12345678', '800.45', 1, '9876543210', NULL, NULL, '0x7509dEb5a6367E094BA35ac8f8F7b2c1997654f7', NULL, 'upload/profile_photo/1.png', '2025-08-14 16:43:22', '2025-09-08 10:15:08', 5, 'Nonvisitor', 'eK7FIO_zthVCNgi6MjfvCR:APA91bEvoDpqYrhIXNUSH5eZio-obveHbeY52srANxuK44xIENuiYtzYGGTsNLrZSRy-iGckPwcir9PZYt_tauxazpHH6rks_LoJdfxLr_hFAFUR0b_XCLk', 'bg-theme13', NULL, '319000', '33275'),
(2, 2, 1, 3, 'Testing1', 'TFC1001', 'testing090@gmail.com', NULL, '$2y$10$eNkqNTUsTWo6YaOE1a.OyemJbN.mQzAC5EQTSn2nRmKhl6QgRRYF2', '12345678', NULL, 1, '918565987834', '918565987834', NULL, '1234567qwertyukl;', NULL, 'upload/profile_photo/user.png', '2025-09-06 06:16:18', '2025-09-08 10:15:08', 1, 'Nonvisitor', NULL, NULL, NULL, '2000', '150'),
(9, 9, 2, 3, 'Akil', 'TFC1002', 'akil@gmail.com', NULL, '$2y$10$n4oZZmePiJzCQ28q1icopu8JugCqHL1KVhrPNfAOV30Bv3uP75N32', '12345678', NULL, 1, '918825456445', '918825456445', NULL, '123456789qwertyuio', NULL, 'upload/profile_photo/user.png', '2025-09-08 04:09:04', '2025-09-08 10:15:08', 1, 'Nonvisitor', NULL, NULL, NULL, '500', '75'),
(10, NULL, 9, 3, 'Joshua', 'TFC1009', 'joshua@gmail.com', NULL, '$2y$10$lsIOE60jSoMdqXgMUJ1M7ualWcgtCTNfhqaKCHYJYD8w67Ki/hzq.', '12345678', NULL, 1, '919876543212', '919876543212', NULL, '123456789qwertyuio', NULL, 'upload/profile_photo/user.png', '2025-09-08 04:32:10', '2025-09-08 10:14:13', 1, 'Nonvisitor', NULL, NULL, NULL, '0', '75'),
(11, 11, 10, 3, 'Ajay', 'TFC1010', 'ajay@gmail.com', NULL, '$2y$10$4WLVcrQea.JqYDRnJ7PALuRUd0Qh89cdETv.u5ZG07j.zzNaCn4jS', '12345678', NULL, 1, '918789789878', '918789789878', NULL, '123456789asdfghjklzxcvbnm,', NULL, 'upload/profile_photo/user.png', '2025-09-08 04:39:19', '2025-09-08 10:14:38', 1, 'Nonvisitor', NULL, NULL, NULL, '0', '75'),
(12, 12, 11, 3, 'Jesin', 'TFC1011', 'jesin@gmail.com', NULL, '$2y$10$OQJl4t8snfVHGsvnpXFJDeooRVSfWK0LVv3qBo1B4ekWZGxEc6D/i', '12345678', NULL, 1, '919090909090', '919090909090', NULL, '1234567dftyudcvbnm', NULL, 'upload/profile_photo/user.png', '2025-09-08 04:43:42', '2025-09-08 10:15:08', 1, 'Nonvisitor', NULL, NULL, NULL, '0', '75'),
(13, 13, 12, 3, 'Suriya', 'TFC1012', 'suriya@gmail.com', NULL, '$2y$10$hTOrvq3HPgNbE2LOnA0fwuLZ0br/VwWpkbTo/xaX4q791yScLKUPi', '12345678', NULL, 1, '919878987898', '919878987898', NULL, 'asdfghj2345678', NULL, 'upload/profile_photo/user.png', '2025-09-08 04:49:30', '2025-09-08 10:15:08', 1, 'Nonvisitor', NULL, NULL, NULL, '0', '0'),
(23, NULL, 2, 4, 'Global - Rebirth', 'TFC1014', 'testing090@gmail.com', NULL, '', NULL, NULL, 1, '918565987834', NULL, NULL, NULL, NULL, 'upload/profile_photo/user.png', '2025-09-08 10:15:08', '2025-09-08 10:15:08', 1, 'Nonvisitor', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_plan`
--

CREATE TABLE `user_plan` (
  `id` int(11) NOT NULL,
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
(6, 2, 1, '500', '2025-09-08 10:12:34', 2),
(7, 9, 1, '500', '2025-09-08 10:12:44', 9),
(8, 10, 1, '500', '2025-09-08 10:13:35', 10),
(9, 11, 1, '500', '2025-09-08 10:14:13', 11),
(10, 12, 1, '500', '2025-09-08 10:14:38', 12),
(11, 13, 1, '500', '2025-09-08 10:15:08', 13),
(12, 23, 1, '500', '2025-09-08 10:15:08', 13),
(13, 23, 1, '500', '2025-09-08 10:15:08', 13);

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
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `global_regain`
--
ALTER TABLE `global_regain`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sponser_income`
--
ALTER TABLE `sponser_income`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `upline_income`
--
ALTER TABLE `upline_income`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_plan`
--
ALTER TABLE `user_plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `withdrawal`
--
ALTER TABLE `withdrawal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
