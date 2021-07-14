-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 06, 2021 at 10:07 AM
-- Server version: 5.7.29-log
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feature`
--

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` int(11) NOT NULL,
  `value` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `value`, `title`) VALUES
(1, '-12:00', '(GMT -12:00) Eniwetok, Kwajalein'),
(2, '-11:00', '(GMT -11:00) Midway Island, Samoa'),
(3, '-10:00', '(GMT -10:00) Hawaii'),
(4, '-09:50', '(GMT -9:30) Taiohae'),
(5, '-09:00', '(GMT -9:00) Alaska'),
(6, '-08:00', '(GMT -8:00) Pacific Time (US &amp; Canada)'),
(7, '-07:00', '(GMT -7:00) Mountain Time (US &amp; Canada)'),
(8, '-06:00', '(GMT -6:00) Central Time (US &amp; Canada), Mexico City'),
(9, '-05:00', '(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima'),
(10, '-04:50', '(GMT -4:30) Caracas'),
(11, '-04:00', '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz'),
(12, '-03:50', '(GMT -3:30) Newfoundland'),
(13, '-03:00', '(GMT -3:00) Brazil, Buenos Aires, Georgetown'),
(14, '-02:00', '(GMT -2:00) Mid-Atlantic'),
(15, '-01:00', '(GMT -1:00) Azores, Cape Verde Islands'),
(16, '+00:00', '(GMT) Western Europe Time, London, Lisbon, Casablanca'),
(17, '+01:00', '(GMT +1:00) Brussels, Copenhagen, Madrid, Paris'),
(18, '+02:00', '(GMT +2:00) Kaliningrad, South Africa'),
(19, '+03:00', '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg'),
(20, '+03:50', '(GMT +3:30) Tehran'),
(21, '+04:00', '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi'),
(22, '+04:50', '(GMT +4:30) Kabul'),
(23, '+05:00', '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent'),
(24, '+05:50', '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi'),
(25, '+05:75', '(GMT +5:45) Kathmandu, Pokhar'),
(26, '+06:00', '(GMT +6:00) Almaty, Dhaka, Colombo'),
(27, '+06:50', '(GMT +6:30) Yangon, Mandalay'),
(28, '+07:00', '(GMT +7:00) Bangkok, Hanoi, Jakarta'),
(29, '+08:00', '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong'),
(30, '+08:75', '(GMT +8:45) Eucla'),
(31, '+09:00', '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk'),
(32, '+09:50', '(GMT +9:30) Adelaide, Darwin'),
(33, '+10:00', '(GMT +10:00) Eastern Australia, Guam, Vladivostok'),
(34, '+10:50', '(GMT +10:30) Lord Howe Island'),
(35, '+11:00', '(GMT +11:00) Magadan, Solomon Islands, New Caledonia'),
(36, '+11:50', '(GMT +11:30) Norfolk Island'),
(37, '+12:00', '(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka'),
(38, '+12:75', '(GMT +12:45) Chatham Islands'),
(39, '+13:00', '(GMT +13:00) Apia, Nukualofa'),
(40, '+14:00', '(GMT +14:00) Line Islands, Tokelau');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
