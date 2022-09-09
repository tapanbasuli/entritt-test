-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2022 at 06:01 AM
-- Server version: 5.7.38
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notebrai_entritt_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_02_17_131838_create_table_users', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referral_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `referral_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmation` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `referral_id`, `email`, `phone`, `password`, `gender`, `dob`, `referral_code`, `confirmation`, `created_at`, `updated_at`) VALUES
(1, 'Imdadul Haque', NULL, 'imdadulhaque.bt@gmail.com', '9564636035', '$2y$10$5gQ5km/UOdflijzEpe8Kc.ggq.B1f1CnwF0wdjeY7c3RHplDMlnGq', 'Male', '2022-02-18', '1NEA1H', 1, '2022-02-18 12:17:00', '2022-02-18 12:17:00'),
(2, 'Imdadul Haque', 1, 'imdadulhaque.rex@gmail.com', '9564636036', '$2y$10$EBn4qmWRNPZsVbw96uU66ee.zjF9uR7otbj2fvDjlZwngIeJ79Sq.', 'Female', '2022-02-18', '7ROS7T', 1, '2022-02-18 12:21:01', '2022-02-18 12:21:01'),
(3, 'Imdadul Haque', NULL, 'imdadul.rex@gmail.com', '9564636034', '$2y$10$hOP6sAL.KFpYZc2bBiKIN.Sizn8gqw3Vivh2MMjNAs0zrSD5rbRoe', 'Female', '2022-02-22', 'HQAY3A', 1, '2022-02-18 12:27:11', '2022-02-18 12:27:11'),
(4, 'Tapan', 3, 'tapan@notebrains.com', '9126338684', '$2y$10$Gm6hfNVU0q/XYHXtcRnUS.YcoQPjlB5kFdPOK/pgnNI3xBHjG1HYy', 'Male', '2022-02-18', 'AIPWTG', 1, '2022-02-18 12:33:26', '2022-02-18 12:33:26'),
(5, 'Imdadul Haque', NULL, 'ueuueur@gmail.com', '9564636038', '$2y$10$kW0thhFpLpIamrmwxMsxEuz7mkk0XBV5VLc3voI.ZcA8Ckk0hFi9m', 'Male', '2022-02-18', 'FCABG1', 1, '2022-02-18 13:03:31', '2022-02-18 13:03:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referral_code` (`referral_code`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
