-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 08:22 AM
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
-- Table structure for table `deactivated_users`
--

CREATE TABLE `deactivated_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `desk_fields`
--

CREATE TABLE `desk_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `space_id` int(11) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `hours` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desk_fields`
--

INSERT INTO `desk_fields` (`id`, `space_id`, `duration`, `price`, `hours`, `created_at`, `updated_at`) VALUES
(38, 27, '1 hour - 2 hours', 80.00, NULL, '2025-01-07 22:43:54', '2025-01-07 22:43:54'),
(39, 28, '1 hour - 2 hours', 80.00, NULL, '2025-01-07 23:01:02', '2025-01-07 23:01:02'),
(40, 28, '3 hours - 5 hours', 130.00, NULL, '2025-01-07 23:01:21', '2025-01-07 23:01:21'),
(41, 28, '6 hours - 8 hours', 180.00, NULL, '2025-01-07 23:01:37', '2025-01-07 23:01:37'),
(42, 27, '3 hours - 5 hours', 130.00, NULL, '2025-01-07 23:02:10', '2025-01-07 23:02:10'),
(43, 27, '6 hours - 8 hours', 180.00, NULL, '2025-01-07 23:02:15', '2025-01-07 23:02:15'),
(44, 27, '1 hour', 80.00, NULL, '2025-01-07 23:26:04', '2025-01-07 23:26:04');

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
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `space_id` int(11) NOT NULL,
  `save_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `operating_hours_from` time DEFAULT NULL,
  `operating_hours_to` time DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
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
  `telephone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `postal` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `tables` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `meeting_rooms` int(11) DEFAULT NULL,
  `virtual_offices` int(11) DEFAULT NULL,
  `measurement_unit` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `header_image` varchar(255) DEFAULT NULL,
  `additional_images` longtext DEFAULT NULL,
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
  `free_pass_details` varchar(255) DEFAULT NULL,
  `averageRating` double(8,2) DEFAULT 0.00,
  `price` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `list_space_tbl`
--

INSERT INTO `list_space_tbl` (`id`, `role`, `coworking_space_name`, `coworking_space_address`, `space_name`, `type_of_space`, `description`, `opening_date`, `available_days_from`, `available_days_to`, `exceptions`, `operating_hours_from`, `operating_hours_to`, `email`, `phone`, `instagram`, `facebook`, `contact_no`, `basics`, `seats`, `equipment`, `facilities`, `accessibility`, `perks`, `location`, `telephone`, `country`, `unit`, `postal`, `city`, `latitude`, `longitude`, `tables`, `capacity`, `meeting_rooms`, `virtual_offices`, `measurement_unit`, `size`, `header_image`, `additional_images`, `pay_online`, `credit_cards`, `eWallet`, `desk_fields`, `meeting_fields`, `virtual_service`, `membership`, `membership_duration`, `membership_price`, `short_term`, `free_pass`, `short_term_details`, `free_pass_details`, `averageRating`, `price`, `user_id`, `created_at`, `updated_at`) VALUES
(27, 'Owner', 'GoztSpace', 'Manila', 'GoztSpace', 'Coworking', 'GoztSpace is a dynamic and inspiring coworking space designed to fuel creativity, collaboration, and productivity.', '2025-01-08', 'Monday', 'Saturday', 'sunday', '08:00:00', '23:00:00', 'GoztSpace@gmail.com', '02456789', 'GoztSpace', 'GoztSpace', '0951891181', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Lounge Chairs\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\",\\\"Whiteboards\\\",\\\"Scanner\\\",\\\"Sockets\\\"]\"', '\"[\\\"Lounge Area\\\"]\"', '\"[\\\"Restrooms\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Snacks\\/Drinks Available for Purchase\\\",\\\"Free Coffee\\\",\\\"Free Tea\\\"]\"', 'Ermita GoztSpace', '02456789', 'Philippines', '2', '1045', 'Manila', '14.585440020726827', '120.98411239119609', 50, 100, 2, 1, 'feet', 200, 'uploads/header/1736318552.jpg', '[\"uploads\\/additional_images\\/1736318552_Interiors of a modern coworking space.jpg\",\"uploads\\/additional_images\\/1736318552_1727936422.png\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 350, 'disable', 'disable', 'none', 'none', 0.00, NULL, 7, '2025-01-08 06:42:32', '2025-01-08 06:42:32'),
(28, 'Owner', 'ThinkTank Collective', 'Manila', 'ThinkTank Collective', 'Coworking', 'ThinkTank Collective is more than just a coworking space—it\'s a dynamic hub for visionaries, innovators, and collaborators.', '2025-01-08', 'Monday', 'Saturday', 'sunday', '08:00:00', '23:00:00', 'ThinkTankCollective@gmail.co', '02456742', 'ThinkTank Collective', 'ThinkTank Collective', '0951894476', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Lounge Chairs\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\",\\\"Whiteboards\\\",\\\"Scanner\\\",\\\"Photocopier\\\",\\\"Sockets\\\"]\"', '\"[\\\"Lounge Area\\\"]\"', '\"[\\\"Restrooms\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Snacks\\/Drinks Available for Purchase\\\",\\\"Free Coffee\\\",\\\"Free Tea\\\"]\"', 'ThinkTank Collective', '02456742', 'Philippines', '1', '1007', 'Manila', '14.588177781553783', '120.9845247942576', 55, 120, 3, 3, 'meters', 300, 'uploads/header/1736319639.jpg', '[\"uploads\\/additional_images\\/1736319639_Workspace Of The Week - The Hive Collingwood Coworking Offices, Melbourne_.jpg\",\"uploads\\/additional_images\\/1736319639_intimate space.jpg\"]', 'no', 'yes', 'yes', NULL, NULL, 'no', 'no', 3, 350, 'disable', 'disable', 'none', 'none', 0.00, NULL, 7, '2025-01-08 07:00:39', '2025-01-08 07:00:39');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_fields`
--

CREATE TABLE `meeting_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `space_id` int(11) NOT NULL,
  `num_people` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `hours` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 2),
(6, '2024_10_04_151816_update_table_users', 2),
(7, '2024_10_05_064043_create_transactions_table', 2),
(8, '2024_10_05_122844_create_favorites_table', 2),
(9, '2024_10_17_140015_create_reviews_table', 3),
(13, '2024_10_29_122718_create_deactivated_users_table', 4),
(15, '2024_11_14_131340_add_average_rating_on_list_space_tbl', 6),
(19, '2024_11_04_060745_add_to_list_space_tbl', 8),
(20, '2024_11_14_133622_add_created_at_and_updated_at_on_list_space_tbl', 9),
(21, '2024_11_14_160544_add_notification_table', 10),
(22, '2024_11_21_033503_create_reply_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `space_id` int(11) NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `subject` text NOT NULL DEFAULT '',
  `content` text NOT NULL DEFAULT '',
  `url` text NOT NULL DEFAULT '',
  `type` varchar(255) NOT NULL DEFAULT 'USER',
  `isRead` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cowork_id` int(11) NOT NULL,
  `review_id` bigint(20) UNSIGNED NOT NULL,
  `reply` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cowork_id` int(11) NOT NULL,
  `rating` int(10) UNSIGNED NOT NULL,
  `review_body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `space_id` int(11) NOT NULL,
  `reservation_date` date NOT NULL,
  `hours` varchar(255) NOT NULL,
  `guests` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `arrival_time` time NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('PENDING','CONFIRMED','COMPLETED','FAILED','REFUNDED') NOT NULL DEFAULT 'PENDING',
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
  `user_type` int(11) NOT NULL DEFAULT 2,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`, `contact`, `birthday`, `gender`, `address`) VALUES
(3, 'Admin User', 'admin@example.com', NULL, '$2y$12$oagFg4vt6NEMPwuIMA81I.lQYy8GRokVvb981br//LDV27dt/sUVm', 3, NULL, '2024-09-23 23:06:36', '2024-09-23 23:06:36', NULL, NULL, NULL, NULL),
(7, 'GoztSpace', 'GoztSpace@gmail.com', NULL, '$2y$12$PF.vsrXgD5dGZaTvb8YGOOzhQims1/grrLWOBQSa26PYyNyXwiTp6', 2, NULL, '2025-01-07 22:32:52', '2025-01-07 22:32:52', NULL, NULL, NULL, NULL),
(8, 'Maria Eloissa Andal', 'andalmariaeloissa@gmail.com', NULL, '$2y$12$TJ6Ka2ixdZ0GMfHtcsVPcOiXFBA8kIhkQGmDGQXkRP7hFPCXAl5Y6', 1, NULL, '2025-01-07 22:46:53', '2025-01-07 22:46:53', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deactivated_users`
--
ALTER TABLE `deactivated_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `deactivated_users_email_unique` (`email`);

--
-- Indexes for table `desk_fields`
--
ALTER TABLE `desk_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desk_fields_ibfk_1` (`space_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `favorites_space_id_unique` (`space_id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`);

--
-- Indexes for table `list_space_tbl`
--
ALTER TABLE `list_space_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_space_tbl_user_id_foreign` (`user_id`);

--
-- Indexes for table `meeting_fields`
--
ALTER TABLE `meeting_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_fields_ibfk_1` (`space_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`),
  ADD KEY `notifications_space_id_foreign` (`space_id`),
  ADD KEY `notifications_transaction_id_foreign` (`transaction_id`);

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
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_user_id_foreign` (`user_id`),
  ADD KEY `replies_cowork_id_foreign` (`cowork_id`),
  ADD KEY `replies_review_id_foreign` (`review_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_cowork_id_foreign` (`cowork_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_space_id_foreign` (`space_id`);

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
-- AUTO_INCREMENT for table `deactivated_users`
--
ALTER TABLE `deactivated_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `desk_fields`
--
ALTER TABLE `desk_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `list_space_tbl`
--
ALTER TABLE `list_space_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `meeting_fields`
--
ALTER TABLE `meeting_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `desk_fields`
--
ALTER TABLE `desk_fields`
  ADD CONSTRAINT `desk_fields_ibfk_1` FOREIGN KEY (`space_id`) REFERENCES `list_space_tbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `list_space_tbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `list_space_tbl`
--
ALTER TABLE `list_space_tbl`
  ADD CONSTRAINT `list_space_tbl_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `meeting_fields`
--
ALTER TABLE `meeting_fields`
  ADD CONSTRAINT `meeting_fields_ibfk_1` FOREIGN KEY (`space_id`) REFERENCES `list_space_tbl` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `list_space_tbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_cowork_id_foreign` FOREIGN KEY (`cowork_id`) REFERENCES `list_space_tbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_cowork_id_foreign` FOREIGN KEY (`cowork_id`) REFERENCES `list_space_tbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `list_space_tbl` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
