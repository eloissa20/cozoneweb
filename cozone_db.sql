-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2024 at 09:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cozone_db`
--

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
-- Table structure for table `list_space_tbl`
--

CREATE TABLE `list_space_tbl` (
  `id` int(11) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `coworking_space_name` varchar(255) DEFAULT NULL,
  `coworking_space_address` varchar(255) DEFAULT NULL,
  `space_name` varchar(255) DEFAULT NULL,
  `type_of_space` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `opening_date` date DEFAULT NULL,
  `available_days_from` varchar(255) DEFAULT NULL,
  `available_days_to` varchar(255) DEFAULT NULL,
  `exceptions` varchar(255) DEFAULT NULL,
  `operating_hours_from` varchar(255) DEFAULT NULL,
  `operating_hours_to` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `basics` varchar(255) DEFAULT NULL,
  `seats` varchar(255) DEFAULT NULL,
  `equipment` varchar(255) DEFAULT NULL,
  `facilities` varchar(255) DEFAULT NULL,
  `accessibility` varchar(255) DEFAULT NULL,
  `perks` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `tables` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `meeting_rooms` int(11) DEFAULT NULL,
  `virtual_offices` int(11) DEFAULT NULL,
  `measurement_unit` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `header_image` varchar(255) DEFAULT NULL,
  `additional_images` varchar(255) DEFAULT NULL,
  `pay_online` varchar(255) DEFAULT NULL,
  `credit_cards` varchar(255) DEFAULT NULL,
  `eWallet` varchar(255) DEFAULT NULL,
  `desk_fields` varchar(255) DEFAULT NULL,
  `meeting_fields` varchar(255) DEFAULT NULL,
  `virtual_service` varchar(255) DEFAULT NULL,
  `membership` varchar(255) DEFAULT NULL,
  `membership_duration` int(11) DEFAULT NULL,
  `membership_price` int(11) DEFAULT NULL,
  `short_term` varchar(255) DEFAULT NULL,
  `free_pass` varchar(255) DEFAULT NULL,
  `short_term_details` varchar(255) DEFAULT NULL,
  `free_pass_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_space_tbl`
--

INSERT INTO `list_space_tbl` (`id`, `role`, `coworking_space_name`, `coworking_space_address`, `space_name`, `type_of_space`, `description`, `opening_date`, `available_days_from`, `available_days_to`, `exceptions`, `operating_hours_from`, `operating_hours_to`, `email`, `phone`, `instagram`, `facebook`, `contact_no`, `basics`, `seats`, `equipment`, `facilities`, `accessibility`, `perks`, `location`, `telephone`, `country`, `unit`, `postal`, `city`, `tables`, `capacity`, `meeting_rooms`, `virtual_offices`, `measurement_unit`, `size`, `header_image`, `additional_images`, `pay_online`, `credit_cards`, `eWallet`, `desk_fields`, `meeting_fields`, `virtual_service`, `membership`, `membership_duration`, `membership_price`, `short_term`, `free_pass`, `short_term_details`, `free_pass_details`) VALUES
(1, 'Owner', 'test', 'test', 'test', 'Coworking', 'test', '2024-10-04', '2024-10-04', NULL, NULL, '2024-10-04', NULL, 'test', 'test', 'test', 'test', 'test', '\"[]\"', '\"[\\\"Couches\\\",\\\"Beanbag\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'test', 'test', 'test', 'test', 'test', 'test', 1, 1, 1, 1, 'feet', 1, 'uploads/header/1727936422.png', NULL, 'yes', 'undefined', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'disable', 'test', NULL),
(2, 'Owner', 'test', 'test', 'test', 'Coworking', 'test', '2024-10-05', '2024-10-06', NULL, NULL, '2024-10-07', NULL, 'test', '696969', 'test', 'test', '09611915869', '\"[]\"', '\"[\\\"Beanbag\\\"]\"', '\"[\\\"Printer\\\"]\"', '\"[\\\"Kitchen\\\"]\"', '\"[\\\"Parking\\\"]\"', '\"[\\\"Free Drinking Water\\\"]\"', 'Manila', '696969', 'Philippines', 'Unit69', '6969', 'Etivac', 2, 3, 4, 5, 'meters', 10, 'uploads/header/1728009958.png', NULL, 'yes', 'undefined', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"hours\\\":\\\"2\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"10\\\",\\\"price\\\":\\\"1500\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 2, 1500, 'enable', 'disable', 'testing lang', NULL),
(3, 'Owner', 'test', 'test', 'Anywhere', 'Coworking', 'asdasdasd', '2024-10-04', 'Monday', 'Sunday', 'saturday', '1', '2', 'coworker@example.com', '6966966996', 'coworker', 'coworker', '69696969', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Beanbag\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\"]\"', '\"[\\\"Kitchen\\\"]\"', '\"[\\\"Parking\\\"]\"', '\"[\\\"Free Drinking Water\\\"]\"', 'Manila', '123123', 'Philippines', '69', '1234', 'BGC', 1, 1, 1, 1, 'meters', 5, 'uploads/header/1728027364.jpg', NULL, 'yes', 'undefined', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"3\\\",\\\"price\\\":\\\"1500\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1500, 'enable', 'disable', 'Sheesh', NULL),
(4, 'Owner', 'Cozone', 'Manila', 'Cozone', 'Coworking', 'Cozone', '2024-10-05', 'Monday', 'Sunday', 'saturday', '1', '3', 'coworker@example.com', '096969696', 'test', 'test', '096969696', '\"[\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Beanbag\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[\\\"Free Drinking Water\\\",\\\"Free Snacks\\\"]\"', 'Manila', '09696969', 'Philippines', '689', '6546', 'Mandaluyong', 1, 1, 1, 1, 'meters', 25, 'uploads/header/1728027832.jpg', NULL, 'yes', 'undefined', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'disable', 'sheesh', NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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
  `user_type` int(11) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Client User', 'client@example.com', NULL, '$2y$12$RFt//iAx.dzG35GlCCm7V.Vxs7TCARhva39nUz20sIk00AHP0DelG', 1, NULL, '2024-09-23 23:06:36', '2024-09-23 23:06:36'),
(2, 'Coworker User', 'coworker@example.com', NULL, '$2y$12$bD0pxWBLxrvw.4nDo3Yhw.7H.9Xn3.GJJIOHX8S/ZJQzJozE68lp2', 2, NULL, '2024-09-23 23:06:36', '2024-09-23 23:06:36'),
(3, 'Admin User', 'admin@example.com', NULL, '$2y$12$oagFg4vt6NEMPwuIMA81I.lQYy8GRokVvb981br//LDV27dt/sUVm', 3, NULL, '2024-09-23 23:06:36', '2024-09-23 23:06:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `list_space_tbl`
--
ALTER TABLE `list_space_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_space_tbl`
--
ALTER TABLE `list_space_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
