-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 02:01 PM
-- Server version: 10.4.28-MariaDB
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
  `hours` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `desk_fields`
--

INSERT INTO `desk_fields` (`id`, `space_id`, `duration`, `price`, `hours`, `created_at`, `updated_at`) VALUES
(1, 1, '1 hour - 2 hours', 3000.00, '3', '2024-12-02 16:15:01', '2024-12-02 21:30:32'),
(31, 2, '1 hour - 2 hours', 2000.00, '1', '2024-12-02 22:15:03', '2024-12-02 22:15:03'),
(32, 2, '3 hours - 4 hours', 5000.00, '2', '2024-12-02 22:15:03', '2024-12-02 22:15:03'),
(35, 24, '3 hours - 4 hours', 23.00, '3', '2024-12-03 18:43:14', '2024-12-03 18:43:14'),
(36, 24, '1 hour - 2 hours', 23.00, '3', '2024-12-03 18:43:24', '2024-12-03 18:43:24');

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
(1, 'Owner', 'Cozone Branch 1', 'Manila', 'test', 'coworking', 'test', '2024-10-04', '2024-10-04', NULL, NULL, '00:00:00', NULL, 'example@example.com', 'test', 'test', 'test', 'test', '[\"Air Conditioned\"]', '[\"Couches\",\"Beanbag\"]', '[\"Printer\",\"Projector\"]', '[]', '[]', '[]', 'test', 'test', 'test', 'test', 'test', 'test', '14.796127603627053', '-239.01855660865183', 1, 1, 1, 1, 'feet', 1, 'uploads/header/1727936422.png', '[\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 1.png\"]', 'yes', NULL, 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'disable', 'test', NULL, 3.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-08 13:34:19'),
(2, 'Owner', 'Cozone branch 2', 'Quezon City', 'test', 'coworking', 'test', '2024-10-05', '2024-10-06', NULL, NULL, '00:00:00', NULL, 'coworker@example.com', '696969', 'test', 'test', '09611915869', '[]', '[\"Beanbag\"]', '[\"Printer\"]', '[\"Kitchen\"]', '[\"Parking\"]', '[\"Free Drinking Water\"]', 'Manila', '696969', 'Philippines', 'Unit69', '6969', 'Etivac', '14.638814970444251', '-238.9622497558594', 2, 3, 4, 5, 'meters', 10, 'uploads/header/1728009958.png', '[\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 1.png\"]', 'yes', NULL, 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"hours\\\":\\\"2\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"10\\\",\\\"price\\\":\\\"1500\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 2, 1500, 'enable', 'disable', 'testing lang', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(5, 'Owner', 'CoconutZone', 'Manila', 'CoconutZone', 'coworking', 'Space', '2024-10-20', 'Monday', 'Friday', NULL, '00:00:00', '00:00:00', 'coworker@example.com', '09465465465', 'coworker@example.com', 'coworker@example.com', '09465465465', '[\"Wifi\"]', '[\"Couches\",\"Modular Seating\",\"Lounge Chairs\"]', '[\"Printer\"]', '[\"Kitchen\"]', '[\"Parking\"]', '[\"Free Drinking Water\"]', 'Manila', '094654654654', 'Philippines', '69', '6969', 'Manila', '14.820969310079446', '121.127424265625', 1, 69, 1, 1, 'meters', 25, 'uploads/header/1731573248.jpg', '[\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 1.png\"]', 'yes', NULL, 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"][\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 2500, 'enable', 'disable', 'enable', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(7, 'Owner', 'Cozone', 'Manila', 'Cozone', 'Coworking', 'this is a test', '2024-10-18', '1', '2', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123123', 'coworker@example.com', 'coworker@example.com', '123123', '\"[\\\"Wifi\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\"]\"', '\"[\\\"Snacks\\/Drinks Available for Purchase\\\"]\"', 'Manila', '12345678', 'Philippines', '69floor', '6969', 'Manila', '14.595406584858075', '120.98955717160743', 1, 1, 0, 0, 'feet', 1, 'uploads/header/1729132421.jpg', NULL, 'yes', 'undefined', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"11\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'disable', 'enable', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(8, 'Owner', 'Image', 'Image', 'test', 'Coworking', 'test', '2024-10-22', 'Monday', 'Friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123456', 'coworker@example.com', 'coworker@example.com', '123456', '\"[\\\"Wifi\\\"]\"', '\"[\\\"Beanbag\\\"]\"', '\"[\\\"Printer\\\"]\"', '\"[\\\"Shower Areas\\\"]\"', '\"[\\\"Restrooms\\\"]\"', '\"[]\"', 'Caloocan', '123123', 'Philippines', '69th', '6969', 'Caloocan', '14.91122735139868', '121.039533640625', 1, 1, 1, 1, 'feet', 1, 'uploads/header/1729478562.png', '[]', 'yes', 'undefined', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'disable', 'enable', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(9, 'Owner', 'Cozone', 'Manila', 'Cozone', 'Coworking', 'asadasdasdasd', '2024-10-22', 'Monday', 'Friday', 'undefined', '00:00:00', '00:00:00', 'coworker@example.com', '123456', 'coworker@example.com', 'coworker@example.com', '132456', '\"[\\\"Air Conditioned\\\"]\"', '\"[\\\"Beanbag\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'Manila', '1213456', 'Philippines', '69', '6969', 'Pasig', '14.601524837407839', '121.04873657226562', 1, 1, 1, 1, 'feet', 1, 'uploads/header/1729479203.png', '[\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1729479203_MANAGE LIST SPACE - 1.png\"]', 'yes', 'undefined', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'enable', 'Enable', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(10, 'Owner', 'test', 'test', 'test', 'Coworking', 'test', '2024-10-23', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123', 'coworker@example.com', 'coworker@example.com', '132', '\"[\\\"Wifi\\\"]\"', '\"[\\\"Couches\\\"]\"', '\"[\\\"Printer\\\",\\\"Computers\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'Manila', '123132', 'Philippines', '69', '12345', 'etivac', '14.730673630905592', '121.00657465625', 1, 1, 1, 1, 'feet', 1, 'uploads/header/1729479678.png', '[\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1729479678_MANAGE LIST SPACE - 1.png\"]', 'yes', '', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'enable', 'Enable', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(11, 'Owner', 'coworker', 'Manila', 'Testing Cozone Price', 'coworking', 'asdasdasdasd', '2024-11-12', 'Monday', 'Sunday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '131313213', 'coworker@example.com', 'coworker@example.com', '46546546546546546', '[\"Wifi\"]', '[\"Couches\"]', '[]', '[]', '[]', '[]', 'Taguig', '32131313132', 'Philippines', '69', '6969', 'Manila', '14.523383632809347', '121.0560131328125', 1, 1, 1, 1, 'feet', 1, 'uploads/header/1731562606.png', '[\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1731562697_MANAGE LIST SPACE - 1.png\"]', 'yes', 'yes', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 1, 1, 'enable', 'disable', 'edit', '1', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(12, 'Admin', 'EDIT', 'desk and meets', 'EDIT', 'sample1', 'edit', '2024-11-14', 'monday', 'friday', 'monday', '00:00:00', '00:00:00', 'coworker@example.com', '123123', 'coworker@example.com', 'coworker@example.com', '123123123', '[\"Wifi\"]', '[\"Beanbag\",\"Ergonomic Chairs\"]', '[\"Printer\",\"Projector\"]', '[\"Kitchen\",\"Personal Lockers\"]', '[]', '[\"Free Drinking Water\",\"Free Snacks\"]', 'Manila', '123123', 'Philippines', '1231', '123123', 'manila', '14.509144353358405', '-239.00756835937503', 1, 1, 1, 1, 'inches', 1, 'uploads/header/1730860862.png', '[\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1730860862_MANAGE LIST SPACE - 1.png\"]', 'yes', 'no', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"duration\\\":\\\"2\\\",\\\"price\\\":\\\"2\\\",\\\"hours\\\":\\\"2\\\"}\",\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"duration\\\":\\\"2\\\",\\\"price\\\":\\\"2\\\",\\\"hours\\\":\\\"2\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"numPeople\\\":\\\"2\\\",\\\"price\\\":\\\"2\\\",\\\"hours\\\":\\\"2\\\"}\"]', 'yes', 'no', 1, 2, 'enable', NULL, 'Edit test', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(13, 'Owner', 'jsonencoding', 'kahit saan', 'jsonencode', 'coworking', 'jsonencode', '2024-11-16', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '13213213', 'coworker@example.com', 'coworker@example.com', '123132132', '[\"Wifi\",\"Air Conditioned\",\"Power Backup\"]', '[\"Couches\",\"Beanbag\",\"Ergonomic Chairs\"]', '[\"Printer\",\"Projector\",\"Whiteboards\"]', '[\"Kitchen\",\"Personal Lockers\"]', '[\"Parking\",\"Restrooms\"]', '[\"Free Drinking Water\",\"Free Snacks\",\"Vending Machine\"]', 'manila', '123123', 'manila', '123', '123', 'manila', '14.778481901484252', '121.0889721171875', 2, 2, 2, 2, 'feet', 1, 'uploads/header/1731641043.png', '[\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 8.png\",\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 7.png\",\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1731641043_MANAGE LIST SPACE - 1.png\"]', 'yes', 'no', 'no', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'yes', 1, 1, 'enable', 'disable', 'asdasd', NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(14, 'Owner', 'Cozone Cafe', 'Muñoz Nueva Ecija', 'Cozone Cafe', 'Coworking', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '2024-12-04', 'Monday', 'Friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '8700', 'coworker@example.com', 'coworker@example.com', '09265481369', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Beanbag\\\",\\\"Counter Height Bar Stools\\\"]\"', '\"[\\\"Projector\\\",\\\"Laptops\\\",\\\"Sockets\\\"]\"', '\"[\\\"Kitchen\\\",\\\"Shower Areas\\\",\\\"Nap Room\\\"]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\",\\\"Accessible Workstations\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Free Snacks\\\",\\\"Snacks\\/Drinks Available for Purchase\\\",\\\"Free Coffee\\\",\\\"Free Tea\\\"]\"', 'Hatdog Street', '8700', 'Philippines', 'ground floor', '3119', 'Science City of Muñoz', '15.707784051413723', '120.90441397220417', 2, 10, 2, 0, 'meters', 10, 'uploads/header/1733122790.jpg', '[\"uploads\\/additional_images\\/1733122790_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733122790_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733122790_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733122790_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733122790_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733122790_MANAGE LIST SPACE - 1.png\"]', 'yes', 'yes', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1000\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"10\\\",\\\"price\\\":\\\"1500\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'yes', 5, 10000, 'enable', 'enable', 'yes oh no yes', 'basta libre', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(15, 'Owner', 'fields', 'fields', 'fields', 'Coworking', 'fields', '2024-12-17', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123213', 'fields', 'fields', '123123', '\"[\\\"Air Conditioned\\\"]\"', '\"[\\\"Lounge Chairs\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'fields', '123123', 'fields', '12', '123123', 'fields', '14.868757680698113', '121.09446528125', 2, 20, 2, 2, 'feet', 25, 'uploads/header/1733125343.jpg', '[\"uploads\\/additional_images\\/1733125343_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733125343_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733125343_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733125343_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733125343_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733125343_MANAGE LIST SPACE - 1.png\"]', 'no', 'no', 'no', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"duration\\\":\\\"2\\\",\\\"price\\\":\\\"2\\\",\\\"hours\\\":\\\"2\\\"}\",\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"duration\\\":\\\"2\\\",\\\"price\\\":\\\"2\\\",\\\"hours\\\":\\\"2\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'no', 'no', 1, 2, 'disable', 'disable', NULL, NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(16, 'Owner', 'test', 'test', 'test', 'Coworking', 'asdasdasd', '2024-12-11', 'Monday', 'Friday', 'undefined', '00:00:00', '00:00:00', 'kennethbasinga12@yahoo.com', '123123', 'tests', 'test', '123123', '\"[\\\"Air Conditioned\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '123123', '123123', '123123', '123123', '123123', 'adasd', '14.84220989009698', '121.0120678203125', 1, 2, 3, 4, 'feet', 23, 'uploads/header/1733125637.jpg', '[\"uploads\\/additional_images\\/1733125637_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733125637_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733125637_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733125637_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733125637_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733125637_MANAGE LIST SPACE - 1.png\"]', 'no', 'no', 'no', 'null', 'null', 'yes', 'yes', 123, 123, 'disable', 'disable', NULL, NULL, 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(17, 'Owner', 'test', 'test', 'test', 'Coworking', 'test', '2024-12-17', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123123', 'test', 'test', '123123', '\"[\\\"Wifi\\\"]\"', '\"[\\\"Couches\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'test', '123', 'test', '123', '123', 'test', '14.815658839381713', '120.984602', 2, 2, 2, 1, 'meters', 10, 'uploads/header/1733126516.jpg', '[\"uploads\\/additional_images\\/1733126516_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733126516_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733126516_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733126516_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733126516_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733126516_MANAGE LIST SPACE - 1.png\"]', 'no', 'no', 'no', '[]', '[]', 'no', 'no', 123, 123, 'disable', 'disable', 'asd', 'asd', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(18, 'Owner', 'test', 'test', 'test', 'Coworking', 'test', '2024-12-11', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123', 'test', 'test', '123', '\"[\\\"Air Conditioned\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'test', 'test', 'test', 'test', 'test', 'test', '14.805037507451178', '120.9681225078125', 2, 2, 2, 1, 'meters', 123, 'uploads/header/1733127296.jpg', '[\"uploads\\/additional_images\\/1733127296_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733127296_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733127296_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733127296_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733127296_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733127296_MANAGE LIST SPACE - 1.png\"]', 'no', 'no', 'no', '[]', '[]', 'no', 'no', 123, 123, 'enable', 'enable', '123', '123', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(19, 'Owner', 'test', 'test', 'test', 'Coworking', 'test', '2024-12-12', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123123', 'coworker@example.com', 'coworker@example.com', '123123', '\"[\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'asdasd', '1', 'test', '1', '1', 'asdasd', '14.773170390434956', '121.0010814921875', 2, 2, 2, 1, 'meters', 123, 'uploads/header/1733127831.jpg', '[\"uploads\\/additional_images\\/1733127831_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733127831_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733127831_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733127831_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733127831_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733127831_MANAGE LIST SPACE - 1.png\"]', 'no', 'no', 'no', '[]', '[]', 'no', 'no', 1, 1, 'disable', 'disable', '1', '1', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(20, 'Owner', 'asdasd', 'Purok Maligaya 2', 'asdasd', 'Coworking', 'asdasd', '2024-12-18', 'asdad', 'asdasd', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123', 'asd', 'asd', '123', '\"[\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'asdasd', '123', 'asdasd', '123123', '123', 'asdasdasd', '14.91122735139868', '121.00657465625', 2, 2, 2, 1, 'meters', 1, 'uploads/header/1733128017.jpg', '[\"uploads\\/additional_images\\/1733128017_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733128017_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733128017_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733128017_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733128017_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733128017_MANAGE LIST SPACE - 1.png\"]', 'no', 'no', 'no', 'null', 'null', 'no', 'no', 123, 123, 'disable', 'disable', '23', '123123', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(21, 'Owner', 'test', 'test', 'test', 'Coworking', 'test', '2024-12-12', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123', 'test', 'test', '123', '\"[\\\"Air Conditioned\\\"]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', '\"[]\"', 'test', '123', 'test', '123', '123', 'test', '14.762546978820195', '121.05051996875', 2, 2, 2, 1, 'meters', 2, 'uploads/header/1733129058.jpg', '[]', 'no', 'no', 'no', 'null', 'null', 'yes', 'yes', 123, 123, 'disable', 'disable', '123', '123', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43'),
(24, 'Owner', 'maptest', 'ggs', 'testtsts', 'Coworking', 'asdasd', '2024-12-13', 'monday', 'friday', 'tuesday', '00:00:00', '00:00:00', 'coworker@example.com', '123123', 'coworker@example.com', 'coworker@example.com', '123123', '\"[\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\"]\"', '\"[\\\"Printer\\\"]\"', '\"[\\\"Kitchen\\\"]\"', '\"[\\\"Parking\\\"]\"', '\"[\\\"Free Drinking Water\\\"]\"', 'asdasd', '12313', 'Philippines', '12', '123', 'asasd', '14.877769053371143', '-238.90869140625003', 1, 1, 1, 1, 'feet', 2, 'uploads/header/1733216624.jpg', '[\"uploads\\/additional_images\\/1733216624_MANAGE LIST SPACE - 6.png\",\"uploads\\/additional_images\\/1733216624_MANAGE LIST SPACE - 5.png\",\"uploads\\/additional_images\\/1733216624_MANAGE LIST SPACE - 4.png\",\"uploads\\/additional_images\\/1733216624_MANAGE LIST SPACE - 3.png\",\"uploads\\/additional_images\\/1733216624_MANAGE LIST SPACE - 2.png\",\"uploads\\/additional_images\\/1733216624_MANAGE LIST SPACE - 1.png\"]', 'yes', 'yes', 'yes', 'null', 'null', 'yes', 'yes', 23, 123, 'enable', 'enable', 'asdads', 'asdasd', 0.00, NULL, 2, '2024-12-04 14:46:43', '2024-12-04 14:46:43');

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

--
-- Dumping data for table `meeting_fields`
--

INSERT INTO `meeting_fields` (`id`, `space_id`, `num_people`, `price`, `hours`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 231.00, '1', '2024-12-02 21:24:14', '2024-12-02 21:27:20'),
(3, 1, 1, 32.00, '2', '2024-12-02 21:24:14', '2024-12-02 21:24:23'),
(4, 24, 13, 23.00, '3', '2024-12-03 18:44:18', '2024-12-03 18:44:18');

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

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `space_id`, `transaction_id`, `subject`, `content`, `url`, `type`, `isRead`, `created_at`, `updated_at`) VALUES
(58, 1, 1, 50, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2024-12-10 05:01:00', '2024-12-10 05:01:00');

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

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `user_id`, `cowork_id`, `review_id`, `reply`, `created_at`, `updated_at`) VALUES
(5, 1, 1, 7, 'dada', '2024-12-07 22:59:22', '2024-12-07 22:59:22'),
(6, 1, 1, 8, 'test reply to test test 2', '2024-12-07 23:09:43', '2024-12-07 23:09:43'),
(7, 1, 1, 8, 'test reply to test test 2', '2024-12-07 23:13:18', '2024-12-07 23:13:18'),
(8, 1, 1, 8, 'dada', '2024-12-07 23:13:35', '2024-12-07 23:13:35');

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

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `cowork_id`, `rating`, `review_body`, `created_at`, `updated_at`) VALUES
(2, 1, 2, 4, 'not bad', '2024-10-21 16:41:14', '2024-10-21 16:41:14'),
(5, 1, 5, 1, 'ewwww', '2024-10-21 16:42:22', '2024-10-21 16:42:22'),
(7, 1, 1, 4, 'test tes', '2024-12-07 22:08:27', '2024-12-07 22:08:27'),
(8, 4, 1, 2, 'test test 2', '2024-12-07 23:04:41', '2024-12-07 23:04:41');

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

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `space_id`, `reservation_date`, `hours`, `guests`, `name`, `email`, `company`, `contact`, `arrival_time`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(50, 1, 1, '2024-12-10', '3', 1, 'Client User', 'client@example.com', 'test', '09274137512', '09:00:00', 3000.00, 'gcash', 'PENDING', '2024-12-10 05:00:48', '2024-12-10 05:01:00');

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
(1, 'Client User', 'client@example.com', NULL, '$2y$12$RFt//iAx.dzG35GlCCm7V.Vxs7TCARhva39nUz20sIk00AHP0DelG', 1, NULL, '2024-09-23 23:06:36', '2024-12-08 06:20:13', '09274137512', '2002-06-12', 'Male', 'P. Silvino Street, Santo Cristo Sur, CITY OF GAPAN, NUEVA ECIJA'),
(2, 'Coworker User', 'coworker@example.com', NULL, '$2y$12$bD0pxWBLxrvw.4nDo3Yhw.7H.9Xn3.GJJIOHX8S/ZJQzJozE68lp2', 2, NULL, '2024-09-23 23:06:36', '2024-09-23 23:06:36', NULL, NULL, NULL, NULL),
(3, 'Admin User', 'admin@example.com', NULL, '$2y$12$oagFg4vt6NEMPwuIMA81I.lQYy8GRokVvb981br//LDV27dt/sUVm', 3, NULL, '2024-09-23 23:06:36', '2024-09-23 23:06:36', NULL, NULL, NULL, NULL),
(4, 'Kenneth Basinga', 'basingakenneth@gmail.com', NULL, '$2y$12$B0Khp7joZQI.hn9l1.LkWuBVVbRy6N3bqCMaHAKgHiaDOmWJ5hgnm', 2, NULL, '2024-12-03 18:12:04', '2024-12-03 18:12:04', NULL, NULL, NULL, NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
