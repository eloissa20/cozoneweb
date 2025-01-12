-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 08:56 AM
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
(47, 1, '1 hour - 2 hours', 60.00, NULL, '2025-01-10 01:50:40', '2025-01-10 01:50:40'),
(48, 1, '3 hours - 5 hours', 150.00, NULL, '2025-01-10 01:50:40', '2025-01-10 01:50:40'),
(49, 1, '6 hours - 8 hours', 190.00, NULL, '2025-01-10 01:50:40', '2025-01-10 01:50:40'),
(50, 1, '9 hours - 12 hours', 250.00, NULL, '2025-01-10 01:50:40', '2025-01-10 01:50:40'),
(51, 2, '1 hour - 2 hours', 100.00, NULL, '2025-01-10 02:07:59', '2025-01-10 02:07:59'),
(52, 2, '3 hours - 5 hours', 180.00, NULL, '2025-01-10 02:07:59', '2025-01-10 02:07:59'),
(53, 2, '6 hours - 8 hours', 270.00, NULL, '2025-01-10 02:07:59', '2025-01-10 02:07:59'),
(54, 2, '9 hours - 12 hours', 320.00, NULL, '2025-01-10 02:07:59', '2025-01-10 02:07:59'),
(55, 25, '1 hour - 2 hours', 150.00, NULL, '2025-01-10 02:20:27', '2025-01-10 02:20:27'),
(56, 25, '3 hours - 5 hours', 280.00, NULL, '2025-01-10 02:20:27', '2025-01-10 02:20:27'),
(57, 25, '6 hours - 8 hours', 350.00, NULL, '2025-01-10 02:20:27', '2025-01-10 02:20:27'),
(58, 25, '9 hours - 12 hours', 460.00, NULL, '2025-01-10 02:20:27', '2025-01-10 02:20:27'),
(59, 26, '1 hour - 2 hours', 80.00, NULL, '2025-01-10 02:29:38', '2025-01-10 02:29:38'),
(60, 26, '3 hours - 5 hours', 150.00, NULL, '2025-01-10 02:29:38', '2025-01-10 02:29:38'),
(61, 26, '6 hours - 8 hours', 270.00, NULL, '2025-01-10 02:29:38', '2025-01-10 02:29:38'),
(62, 26, '9 hours - 12 hours', 350.00, NULL, '2025-01-10 02:29:38', '2025-01-10 02:29:38'),
(63, 27, '1 hour - 2 hours', 100.00, NULL, '2025-01-10 02:34:01', '2025-01-10 02:34:01'),
(64, 27, '3 hours - 5 hours', 180.00, NULL, '2025-01-10 02:34:01', '2025-01-10 02:34:01'),
(65, 27, '6 hours - 8 hours', 250.00, NULL, '2025-01-10 02:34:01', '2025-01-10 02:34:01'),
(66, 27, '9 hours - 12 hours', 320.00, NULL, '2025-01-10 02:34:01', '2025-01-10 02:34:01'),
(67, 28, '1 hour - 2 hours', 90.00, NULL, '2025-01-10 02:38:20', '2025-01-10 02:38:20'),
(68, 28, '3 hours - 5 hours', 175.00, NULL, '2025-01-10 02:38:20', '2025-01-10 02:38:20'),
(69, 28, '6 hours - 8 hours', 250.00, NULL, '2025-01-10 02:38:20', '2025-01-10 02:38:20'),
(70, 28, '9 hours - 12 hours', 320.00, NULL, '2025-01-10 02:38:20', '2025-01-10 02:38:20'),
(71, 29, '1 hour - 2 hours', 100.00, NULL, '2025-01-10 02:48:33', '2025-01-10 02:48:33'),
(72, 29, '3 hours - 5 hours', 180.00, NULL, '2025-01-10 02:48:33', '2025-01-10 02:48:33'),
(73, 29, '6 hours - 8 hours', 250.00, NULL, '2025-01-10 02:48:33', '2025-01-10 02:48:33'),
(74, 29, '9 hours - 12 hours', 320.00, NULL, '2025-01-10 02:48:33', '2025-01-10 02:48:33'),
(75, 30, '1 hour - 2 hours', 60.00, NULL, '2025-01-10 02:51:46', '2025-01-10 02:51:46'),
(76, 30, '3 hours - 5 hours', 150.00, NULL, '2025-01-10 02:51:46', '2025-01-10 02:51:46'),
(77, 30, '6 hours - 8 hours', 190.00, NULL, '2025-01-10 02:51:46', '2025-01-10 02:51:46'),
(78, 30, '9 hours - 12 hours', 250.00, NULL, '2025-01-10 02:51:46', '2025-01-10 02:51:46'),
(79, 31, '1 hour - 2 hours', 75.00, NULL, '2025-01-10 07:20:31', '2025-01-10 07:20:31'),
(80, 31, '3 hours - 5 hours', 160.00, NULL, '2025-01-10 07:20:31', '2025-01-10 07:20:31'),
(81, 31, '6 hours - 8 hours', 200.00, NULL, '2025-01-10 07:20:31', '2025-01-10 07:20:31'),
(82, 31, '9 hours - 12 hours', 280.00, NULL, '2025-01-10 07:20:31', '2025-01-10 07:20:31'),
(83, 32, '1 hour - 2 hours', 100.00, NULL, '2025-01-10 07:27:55', '2025-01-10 07:27:55'),
(84, 32, '3 hours - 5 hours', 180.00, NULL, '2025-01-10 07:27:55', '2025-01-10 07:27:55'),
(85, 32, '6 hours - 8 hours', 250.00, NULL, '2025-01-10 07:27:55', '2025-01-10 07:27:55'),
(86, 32, '9 hours - 12 hours', 350.00, NULL, '2025-01-10 07:27:55', '2025-01-10 07:27:55');

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

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `space_id`, `save_on`, `created_at`, `updated_at`) VALUES
(7, 9, 27, '2025-01-10 11:10:48', '2025-01-10 03:10:48', '2025-01-10 03:10:48'),
(8, 12, 1, '2025-01-10 15:10:20', '2025-01-10 07:10:20', '2025-01-10 07:10:20'),
(9, 12, 25, '2025-01-10 15:10:24', '2025-01-10 07:10:24', '2025-01-10 07:10:24'),
(10, 12, 26, '2025-01-10 15:10:25', '2025-01-10 07:10:25', '2025-01-10 07:10:25');

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
  `meeting_rooms` int(11) NOT NULL,
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
(1, 'Owner', 'CoSphere', 'Manila City', 'CoSphere', 'Coworking', 'Step into CoSphere, a shared workspace blending modern amenities, inspiring design, and a vibrant community. Join visionaries and change-makers where ideas flow naturally. At CoSphere, it’s more than a desk—it’s a space for endless possibilities.', '2025-01-01', 'Monday', 'Saturday', 'sunday', '08:00:00', '00:00:00', 'cosphere@gmail.com', '0001-235-0215', 'CoSphere', 'CoSphere', '+63 1234567890', '[\"Wifi\",\"Air Conditioned\",\"Power Backup\"]', '[\"Couches\",\"Beanbag\",\"Counter Height Bar Stools\"]', '[\"Printer\",\"Projector\",\"Whiteboards\",\"Sockets\"]', '[\"Kitchen\"]', '[\"Parking\",\"Restrooms\"]', '[\"Free Drinking Water\",\"Vending Machine\",\"Snacks\\/Drinks Available for Purchase\",\"Free Coffee\",\"Free Tea\"]', 'CoSphere', '0001-235-0215', 'Philippines', '1', '1001', 'Manila', '14.587461534065175', '-239.0151730356446', 10, 25, 1, 1, 'feet', 10500, 'uploads/header/1736502580.jpg', '[\"uploads\\/additional_images\\/1736502580_coworking_space2.jpg\",\"uploads\\/additional_images\\/1736502580_coworking_space3.jpg\",\"uploads\\/additional_images\\/1736502580_coworking_space4.jpg\"]', 'yes', 'yes', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\",\"{\\\"numPeople\\\":\\\"1\\\",\\\"price\\\":\\\"1\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 3, 2500, 'disable', 'disable', 'none', 'none', 0.00, NULL, 2, '2024-12-04 14:46:43', '2025-01-10 15:12:18'),
(2, 'Owner', 'ThinkWorks', 'Quezon City', 'ThinkWorks', 'Coworking', 'ThinkWorks is a forward-thinking workspace that combines innovation, collaboration, and creativity. Join a community that drives success and transforms ambitions into reality.', '2024-12-01', 'Monday', 'Sunday', 'saturday', '09:00:00', '23:00:00', 'thinkworks@gmail.com', '0001-235-0215', 'ThinkWorks', 'ThinkWorks', '+63 1234567890', '[\"Wifi\",\"Air Conditioned\"]', '[\"Couches\",\"Beanbag\",\"Lounge Chairs\"]', '[\"Printer\",\"Whiteboards\",\"Scanner\",\"Computers\"]', '[\"Kitchen\",\"Personal Lockers\",\"Lounge Area\"]', '[\"Parking\",\"Restrooms\",\"Adjustable Lighting\"]', '[\"Free Drinking Water\",\"Vending Machine\",\"Snacks\\/Drinks Available for Purchase\"]', 'Manila', '0001-235-0215', 'Philippines', '2', '1002', 'Quezon', '14.638814970444251', '-238.9622497558594', 20, 50, 2, 2, 'feet', 18500, 'uploads/header/1736503622.jpg', '[\"uploads\\/additional_images\\/1736503622_coworking_space6.jpg\",\"uploads\\/additional_images\\/1736503622_coworking_space7.jpg\",\"uploads\\/additional_images\\/1736503622_coworking_space8.jpg\"]', 'yes', 'yes', 'yes', '[\"{\\\"duration\\\":\\\"1\\\",\\\"price\\\":\\\"100\\\",\\\"hours\\\":\\\"2\\\"}\"]', '[\"{\\\"numPeople\\\":\\\"10\\\",\\\"price\\\":\\\"1500\\\",\\\"hours\\\":\\\"1\\\"}\"]', 'yes', 'no', 2, 1500, 'disable', 'disable', 'none', 'none', 0.00, NULL, 2, '2024-12-04 14:46:43', '2025-01-10 10:26:51'),
(25, 'Owner', 'BrainSpace', 'Taguig City', 'BrainSpace', 'Coworking', 'A hub for intellectuals and innovators, offering inspiring work areas, private pods, and brainstorming zones designed to fuel creative thinking.', '2024-11-04', 'Monday', 'Sunday', 'tuesday', '10:00:00', '03:00:00', 'brainspace@gmail.com', '0001-235-0215', 'BrainSpace', 'BrainSpace', '+63 1234567890', '[\"Wifi\",\"Air Conditioned\",\"Power Backup\"]', '[\"Couches\",\"Beanbag\",\"Modular Seating\",\"Lounge Chairs\",\"Floor Cushions\"]', '[\"Printer\",\"Projector\",\"Whiteboards\",\"Computers\",\"Laptops\",\"Sockets\"]', '[\"Kitchen\",\"Personal Lockers\",\"Shower Areas\",\"Nap Room\"]', '[\"Parking\",\"Restrooms\",\"Accessible Workstations\"]', '[\"Free Drinking Water\",\"Snacks\\/Drinks Available for Purchase\",\"Free Coffee\",\"Free Tea\"]', 'BrainSpace', '0001-235-0215', 'Philippines', '1', '1009', 'Taguig', '14.533793278615493', '121.05156764569966', 25, 75, 3, 3, 'feet', 25500, 'uploads/header/1736504320.jpg', '[\"uploads\\/additional_images\\/1736504320_coworking_space10.jpg\",\"uploads\\/additional_images\\/1736504320_coworking_space11.jpg\",\"uploads\\/additional_images\\/1736504320_coworking_space12.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 4000, 'disable', 'disable', NULL, NULL, 0.00, NULL, 5, '2025-01-10 10:18:40', '2025-01-10 10:26:21'),
(26, 'Owner', 'ThinkTank Hub', 'Makati City', 'ThinkTank Hub', 'Coworking', 'The go-to destination for deep thinkers and problem-solvers, featuring modern meeting rooms, collaborative spaces, and quiet corners for solo work.', '2024-08-20', 'Monday', 'Sunday', 'thursday', '08:30:00', '02:30:00', 'thinktank@gmail.com', '0001-235-0215', 'ThinkTank Hub', 'ThinkTank Hub', '+63 1234567890', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Beanbag\\\",\\\"Lounge Chairs\\\",\\\"Floor Cushions\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\",\\\"Scanner\\\",\\\"Sockets\\\"]\"', '\"[\\\"Kitchen\\\",\\\"Personal Lockers\\\",\\\"Nap Room\\\"]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Vending Machine\\\",\\\"Snacks\\/Drinks Available for Purchase\\\"]\"', 'ThinkTank Hub', '0001-235-0215', 'Philippines', '3', '1009', 'Manila', '14.563477306607933', '121.02039051381962', 20, 80, 2, 3, 'feet', 20000, 'uploads/header/1736504767.jpg', '[\"uploads\\/additional_images\\/1736504767_coworking_space14.jpg\",\"uploads\\/additional_images\\/1736504767_coworking_space15.jpg\",\"uploads\\/additional_images\\/1736504767_coworking_space16.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 3500, 'disable', 'disable', NULL, NULL, 0.00, NULL, 5, '2025-01-10 10:26:07', '2025-01-10 10:26:07'),
(27, 'Owner', 'WorkHaven', 'Pasay City', 'WorkHaven', 'Desk Space', 'A serene, well-equipped haven for freelancers and teams seeking focus, comfort, and a productive vibe, complete with ergonomic furniture and calming decor.', '2024-07-30', 'Monday', 'Saturday', 'friday', '10:30:00', '04:00:00', 'workhaven@gmail.com', '0001-235-0215', 'WorkHaven', 'WorkHaven', '+63 1234567890', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Beanbag\\\",\\\"Ergonomic Chairs\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\",\\\"Whiteboards\\\"]\"', '\"[\\\"Personal Lockers\\\",\\\"Shower Areas\\\"]\"', '\"[\\\"Parking\\\",\\\"Adjustable Lighting\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Vending Machine\\\",\\\"Snacks\\/Drinks Available for Purchase\\\"]\"', 'WorkHaven', '0001-235-0215', 'Philippines', '3', '1009', 'Manila', '14.534567037110119', '120.98267865177841', 10, 50, 2, 3, 'feet', 13500, 'uploads/header/1736505213.jpg', '[\"uploads\\/additional_images\\/1736505213_coworking_space13.jpg\",\"uploads\\/additional_images\\/1736505213_coworking_space14.jpg\",\"uploads\\/additional_images\\/1736505213_coworking_space15.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 2800, 'disable', 'disable', NULL, NULL, 0.00, NULL, 6, '2025-01-10 10:33:33', '2025-01-10 10:33:33'),
(28, 'Owner', 'Hive Mind', 'Manila City', 'Hive Mind', 'Desk Space', 'An energetic space buzzing with collaboration and ideas. Ideal for networking, team synergy, and shared innovation.', '2024-10-17', 'Tuesday', 'Sunday', 'monday', '07:30:00', '00:00:00', 'hivemind@gmail.com', '0001-235-0215', 'Hive Mind', 'Hive Mind', '+63 1234567890', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\",\\\"Power Backup\\\"]\"', '\"[\\\"Beanbag\\\",\\\"Ergonomic Chairs\\\"]\"', '\"[\\\"Projector\\\",\\\"Photocopier\\\",\\\"Sockets\\\"]\"', '\"[\\\"Kitchen\\\",\\\"Nap Room\\\"]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Vending Machine\\\",\\\"Free Coffee\\\"]\"', 'Hive Mind', '0001-235-0215', 'Philippines', '2', '1009', 'Manila', '14.589944800633363', '120.98236027332742', 10, 45, 2, 1, 'feet', 13500, 'uploads/header/1736505465.jpg', '[\"uploads\\/additional_images\\/1736505465_coworking_space5.jpg\",\"uploads\\/additional_images\\/1736505465_coworking_space7.jpg\",\"uploads\\/additional_images\\/1736505465_coworking_space8.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 1300, 'disable', 'disable', NULL, NULL, 0.00, NULL, 6, '2025-01-10 10:37:45', '2025-01-10 10:37:45'),
(29, 'Owner', 'Meet & Work', 'Makati City', 'Meet & Work', 'Meeting Room', 'Designed for professionals on the go, with flexible desk options and well-equipped meeting rooms, fostering productivity and connections.', '2024-09-25', 'Monday', 'Saturday', 'sunday', '10:30:00', '23:00:00', 'meetandwork@gmail.com', '0001-235-0215', 'Meet & Work', 'Meet & Work', '+63 1234567890', '[\"Wifi\",\"Air Conditioned\",\"Power Backup\"]', '[\"Modular Seating\",\"Lounge Chairs\"]', '[\"Printer\",\"Projector\",\"Whiteboards\",\"Scanner\",\"Photocopier\",\"Computers\",\"Laptops\",\"Sockets\"]', '[\"Personal Lockers\",\"Lounge Area\"]', '[\"Parking\",\"Restrooms\",\"Accessible Workstations\"]', '[\"Free Drinking Water\",\"Vending Machine\",\"Snacks\\/Drinks Available for Purchase\",\"Free Coffee\"]', 'Meet & Work', '0001-235-0215', 'Philippines', '2', '1009', 'Manila', '14.559260529608', '121.02272713127766', 5, 50, 3, 2, 'feet', 15500, 'uploads/header/1736506042.jpg', '[\"uploads\\/additional_images\\/1736506042_coworking_space1.jpg\",\"uploads\\/additional_images\\/1736506042_coworking_space3.jpg\",\"uploads\\/additional_images\\/1736506042_coworking_space4.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 2500, 'disable', 'disable', 'none', 'none', 0.00, NULL, 7, '2025-01-10 10:47:22', '2025-01-10 16:33:36'),
(30, 'Owner', 'Worktopia', 'Taguig City', 'Worktopia', 'Coworking', 'The ultimate work paradise where convenience meets creativity, offering everything from hot desks to private suites in a sleek, modern setting.', '2024-05-15', 'Monday', 'Saturday', 'sunday', '10:30:00', '00:30:00', 'worktopia@gmail.com', '0001-235-0215', 'Worktopia', 'Worktopia', '+63 1234567890', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\",\\\"Power Backup\\\"]\"', '\"[\\\"Couches\\\",\\\"Ergonomic Chairs\\\",\\\"Modular Seating\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\",\\\"Whiteboards\\\",\\\"Scanner\\\"]\"', '\"[\\\"Personal Lockers\\\"]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\",\\\"Accessible Workstations\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Vending Machine\\\",\\\"Snacks\\/Drinks Available for Purchase\\\"]\"', 'Worktopia', '0001-235-0215', 'Philippines', '1', '1009', 'Manila', '14.551842396348478', '121.04873095335536', 4, 50, 3, 2, 'feet', 12500, 'uploads/header/1736506286.jpg', '[\"uploads\\/additional_images\\/1736506286_coworking_space7.jpg\",\"uploads\\/additional_images\\/1736506286_coworking_space15.jpg\",\"uploads\\/additional_images\\/1736506286_coworking_space2.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 3500, 'disable', 'disable', NULL, NULL, 0.00, NULL, 7, '2025-01-10 10:51:26', '2025-01-10 10:51:26'),
(31, 'Owner', 'CoNest', 'Pasay City', 'CoNest', 'Coworking', 'A cozy, community-driven coworking nest that provides flexible workspaces, perfect for startups and digital nomads looking for a supportive environment.', '2023-10-10', 'Monday', 'Saturday', 'sunday', '08:00:00', '23:00:00', 'conest@gmail.com', '0001-235-0215', 'CoNest', 'CoNest', '+63 1234567890', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Counter Height Bar Stools\\\"]\"', '\"[\\\"Printer\\\",\\\"Whiteboards\\\",\\\"Sockets\\\"]\"', '\"[\\\"Kitchen\\\"]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Free Coffee\\\"]\"', 'Conest', '0001-235-0215', 'Philippines', '2', '1009', 'Manila', '14.532459351687622', '120.98315181931093', 20, 60, 3, 3, 'feet', 14550, 'uploads/header/1736522401.jpg', '[\"uploads\\/additional_images\\/1736522401_coworking_space8.jpg\",\"uploads\\/additional_images\\/1736522401_coworking_space9.jpg\",\"uploads\\/additional_images\\/1736522401_coworking_space12.jpg\",\"uploads\\/additional_images\\/1736522401_coworking_space2.jpg\",\"uploads\\/additional_images\\/1736522401_coworking_space4.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 3500, 'disable', 'disable', NULL, NULL, 0.00, NULL, 13, '2025-01-10 15:20:01', '2025-01-10 15:20:01'),
(32, 'Owner', 'Desktination', 'Quezon City', 'Desktination', 'Desk Space', 'Your ideal work destination, complete with scenic views, high-speed internet, and premium amenities for a seamless workflow experience.', '2023-01-24', 'Tuesday', 'Sunday', 'monday', '06:30:00', '00:30:00', 'desktination@gmail.com', '0001-235-0215', 'Desktination', 'Desktination', '+63 1234567890', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Ergonomic Chairs\\\"]\"', '\"[\\\"Printer\\\",\\\"Whiteboards\\\",\\\"Scanner\\\",\\\"Computers\\\",\\\"Sockets\\\"]\"', '\"[\\\"Kitchen\\\",\\\"Personal Lockers\\\"]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\",\\\"Accessible Workstations\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Vending Machine\\\",\\\"Snacks\\/Drinks Available for Purchase\\\"]\"', 'Desktination', '0001-235-0215', 'Philippines', '3', '1009', 'Manila', '14.649985205000537', '121.07479101416175', 30, 80, 3, 2, 'feet', 25530, 'uploads/header/1736522856.jpg', '[\"uploads\\/additional_images\\/1736522856_coworking_space9.jpg\",\"uploads\\/additional_images\\/1736522856_coworking_space13.jpg\",\"uploads\\/additional_images\\/1736522856_coworking_space14.jpg\",\"uploads\\/additional_images\\/1736522856_coworking_space1.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 2800, 'disable', 'disable', NULL, NULL, 0.00, NULL, 13, '2025-01-10 15:27:36', '2025-01-10 15:27:36'),
(35, 'Owner', 'CollabNation', 'Mandaluyong City', 'CollabNation', NULL, 'Built for collaboration, this vibrant space has open work areas, team lounges, and innovation zones for professionals and creatives alike.', '2024-06-12', 'Monday', 'Sunday', 'friday', '08:30:00', '02:30:00', 'collabnation@gmail.com', NULL, 'CollabNation', 'CollabNation', '+63 1234567890', '\"[\\\"Wifi\\\",\\\"Air Conditioned\\\"]\"', '\"[\\\"Couches\\\",\\\"Ergonomic Chairs\\\",\\\"Modular Seating\\\",\\\"Lounge Chairs\\\"]\"', '\"[\\\"Printer\\\",\\\"Projector\\\",\\\"Whiteboards\\\",\\\"Scanner\\\",\\\"Photocopier\\\",\\\"Sockets\\\"]\"', '\"[\\\"Kitchen\\\",\\\"Personal Lockers\\\",\\\"Nap Room\\\",\\\"Lounge Area\\\"]\"', '\"[\\\"Parking\\\",\\\"Restrooms\\\",\\\"Accessible Workstations\\\"]\"', '\"[\\\"Free Drinking Water\\\",\\\"Vending Machine\\\",\\\"Snacks\\/Drinks Available for Purchase\\\",\\\"Free Coffee\\\",\\\"Free Tea\\\"]\"', 'CollabNation', NULL, 'Philippines', '1', '1009', 'Mandaluyong', '14.585169616787086', '121.05666438562281', 10, 50, 3, 3, 'feet', 25520, 'uploads/header/1736667162.jpg', '[\"uploads\\/additional_images\\/1736667162_coworking_space22.jpg\",\"uploads\\/additional_images\\/1736667162_coworking_space23.jpg\",\"uploads\\/additional_images\\/1736667162_coworking_space24.jpg\"]', 'yes', 'yes', 'yes', NULL, NULL, 'yes', 'no', 3, 2100, 'disable', 'disable', NULL, NULL, 0.00, NULL, 15, '2025-01-12 07:32:42', '2025-01-12 07:32:42');

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
(8, 1, 10, 1500.00, '1 hour - 2 hours', '2025-01-10 01:51:38', '2025-01-10 01:51:38'),
(9, 1, 5, 1000.00, '1 hour - 2 hours', '2025-01-10 01:51:38', '2025-01-10 01:51:38'),
(10, 2, 10, 2800.00, '1 hour - 3 hours', '2025-01-10 02:08:41', '2025-01-10 02:09:59'),
(11, 2, 5, 1500.00, '1 hour - 2 hours', '2025-01-10 02:08:41', '2025-01-10 02:10:02'),
(12, 2, 3, 800.00, '1 hour - 2 hours', '2025-01-10 02:08:41', '2025-01-10 02:10:05'),
(13, 25, 10, 2500.00, '1 hour - 2 hours', '2025-01-10 02:21:42', '2025-01-10 02:21:42'),
(14, 25, 5, 1800.00, '1 hour - 2 hours', '2025-01-10 02:21:42', '2025-01-10 02:21:42'),
(15, 26, 10, 2300.00, '1 hour - 2 hours', '2025-01-10 02:29:57', '2025-01-10 02:29:57'),
(16, 26, 5, 1500.00, '1 hour - 2 hours', '2025-01-10 02:29:57', '2025-01-10 02:29:57'),
(17, 27, 10, 1200.00, '1 hour - 2 hours', '2025-01-10 02:34:21', '2025-01-10 02:34:21'),
(18, 27, 5, 1000.00, '1 hour - 2 hours', '2025-01-10 02:34:21', '2025-01-10 02:34:21'),
(19, 28, 10, 1400.00, '1 hour - 3 hours', '2025-01-10 02:38:51', '2025-01-10 02:38:51'),
(20, 28, 5, 1000.00, '1 hour - 2 hours', '2025-01-10 02:38:51', '2025-01-10 02:38:51'),
(21, 29, 10, 1200.00, '1 hour - 3 hours', '2025-01-10 02:47:41', '2025-01-10 02:47:41'),
(22, 29, 5, 1000.00, '1 hour - 2 hours', '2025-01-10 02:47:41', '2025-01-10 02:47:41'),
(23, 29, 7, 1100.00, '1 hour - 2 hours', '2025-01-10 02:48:05', '2025-01-10 02:48:05'),
(24, 30, 10, 1500.00, '1 hour - 3 hours', '2025-01-10 02:52:18', '2025-01-10 02:52:18'),
(25, 30, 7, 1200.00, '1 hour - 2 hours', '2025-01-10 02:52:18', '2025-01-10 02:52:18'),
(26, 30, 5, 1000.00, '1 hour - 2 hours', '2025-01-10 02:52:18', '2025-01-10 02:52:18'),
(27, 31, 10, 1500.00, '1 hour - 2 hours', '2025-01-10 07:21:13', '2025-01-10 07:21:13'),
(28, 31, 10, 1800.00, '3 hours - 5 hours', '2025-01-10 07:21:13', '2025-01-10 07:21:13'),
(29, 32, 10, 2500.00, '2 hours - 4 hours', '2025-01-10 07:28:28', '2025-01-10 07:28:28'),
(30, 32, 7, 1800.00, '1 hour - 2 hours', '2025-01-10 07:28:28', '2025-01-10 07:28:28'),
(31, 32, 5, 1500.00, '1 hour - 2 hours', '2025-01-10 07:28:28', '2025-01-10 07:28:28');

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
(66, 8, 1, 57, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-10 02:58:11', '2025-01-10 02:58:11'),
(67, 9, 27, 58, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-10 03:08:26', '2025-01-10 03:08:26'),
(68, 8, 1, 57, 'Reservation Completed', 'Your reservation is completed.', '', 'USER', 0, '2025-01-10 07:12:28', '2025-01-10 07:12:28'),
(69, 9, 27, 58, 'Reservation Confirmed', 'Your reservation is confirmed.', '', 'USER', 0, '2025-01-10 07:31:14', '2025-01-10 07:31:14'),
(70, 8, 1, 57, 'Reservation Confirmed', 'Your reservation is confirmed.', '', 'USER', 0, '2025-01-10 07:31:35', '2025-01-10 07:31:35'),
(71, 12, 1, 59, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-11 08:43:34', '2025-01-11 08:43:34'),
(72, 12, 1, 59, 'Reservation Completed', 'Your reservation is completed.', '', 'USER', 0, '2025-01-11 08:44:43', '2025-01-11 08:44:43'),
(73, 12, 25, 60, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-11 08:46:50', '2025-01-11 08:46:50'),
(74, 12, 25, 60, 'Reservation Confirmed', 'Your reservation is confirmed.', '', 'USER', 0, '2025-01-11 08:47:44', '2025-01-11 08:47:44'),
(75, 9, 27, 61, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-11 08:56:18', '2025-01-11 08:56:18'),
(76, 9, 27, 61, 'Reservation Confirmed', 'Your reservation is confirmed.', '', 'USER', 0, '2025-01-11 08:59:33', '2025-01-11 08:59:33'),
(77, 10, 32, 62, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-11 09:01:58', '2025-01-11 09:01:58'),
(78, 10, 31, 63, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-11 09:03:17', '2025-01-11 09:03:17'),
(79, 10, 32, 62, 'Reservation Completed', 'Your reservation is completed.', '', 'USER', 0, '2025-01-11 09:05:45', '2025-01-11 09:05:45'),
(80, 10, 31, 63, 'Reservation Confirmed', 'Your reservation is confirmed.', '', 'USER', 0, '2025-01-11 09:05:55', '2025-01-11 09:05:55'),
(81, 11, 28, 64, 'Reservation Pending', 'Your reservation is pending.', '', 'USER', 0, '2025-01-11 09:21:37', '2025-01-11 09:21:37');

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

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `space_id`, `reservation_date`, `hours`, `guests`, `name`, `email`, `company`, `contact`, `arrival_time`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(57, 8, 1, '2025-01-15', '1 hour - 2 hours', 1, 'Angel Cyrhen Recaña', 'angellittlecyrhen@gmail.com', 'NA', '09432648843', '10:00:00', 60.00, 'gcash', 'CONFIRMED', '2025-01-10 02:57:58', '2025-01-10 02:58:11'),
(58, 9, 27, '2025-01-27', '6 hours - 8 hours', 1, 'Jay-Ann Angela Balatero', 'jayannbalatero@gmail.com', 'TUP', '09605233822', '10:00:00', 250.00, 'gcash', 'CONFIRMED', '2025-01-10 03:08:03', '2025-01-10 03:08:26'),
(59, 12, 1, '2025-01-10', '9 hours - 12 hours', 1, 'Tara Caguiat', 'taracaguiat456@gmail.com', 'TUP', '09761515952', '08:00:00', 250.00, 'gcash', 'COMPLETED', '2025-01-11 08:43:28', '2025-01-11 08:43:34'),
(60, 12, 25, '2025-01-18', '3 hours - 5 hours', 1, 'Tara Caguiat', 'taracaguiat456@gmail.com', 'TUP', '09761515952', '14:30:00', 280.00, 'gcash', 'CONFIRMED', '2025-01-11 08:46:45', '2025-01-11 08:46:50'),
(61, 9, 27, '2025-01-20', '3 hours - 5 hours', 1, 'Jay-Ann Angela Balatero', 'jayannbalatero@gmail.com', 'TUP', '09605233822', '13:30:00', 180.00, 'gcash', 'CONFIRMED', '2025-01-11 08:56:13', '2025-01-11 08:56:18'),
(62, 10, 32, '2025-01-07', '3 hours - 5 hours', 1, 'Eloissa Andal', 'mariaeloissaandal@gmail.com', 'TUP', '09562817944', '10:00:00', 180.00, 'cash', 'COMPLETED', '2025-01-11 09:01:55', '2025-01-11 09:01:58'),
(63, 10, 31, '2025-01-30', '6 hours - 8 hours', 1, 'Eloissa Andal', 'mariaeloissaandal@gmail.com', 'TUP', '09562817944', '09:00:00', 200.00, 'gcash', 'CONFIRMED', '2025-01-11 09:03:12', '2025-01-11 09:03:17'),
(64, 11, 28, '2025-01-17', '9 hours - 12 hours', 1, 'Signet Enriquez', 'signetenriquez@gmail.com', 'TUP', '09165227475', '07:30:00', 320.00, 'gcash', 'PENDING', '2025-01-11 09:21:31', '2025-01-11 09:21:37');

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
(5, 'Coworker User', 'coworker1@example.com', NULL, '$2y$12$nIgGHeJApUgFEpg3Tt7SS.jG6JF2Pq76qoIB9GYRRhvy04iHzhDAC', 2, NULL, '2025-01-10 02:12:29', '2025-01-10 02:12:29', NULL, NULL, NULL, NULL),
(6, 'Coworker User', 'coworker2@example.com', NULL, '$2y$12$1lvq/UtbirrjuciJ5ywvpeI3iVwVAQ78TWEAf3VwGzTeJxRFamvVC', 2, NULL, '2025-01-10 02:30:37', '2025-01-10 02:30:37', NULL, NULL, NULL, NULL),
(7, 'Coworker User', 'coworker3@example.com', NULL, '$2y$12$ui/XfwR46Lk314do2aKsbeNFHrahArqZB26mDLk3FP/F8eYRFWH22', 2, NULL, '2025-01-10 02:43:43', '2025-01-10 02:43:43', NULL, NULL, NULL, NULL),
(8, 'Client User', 'angellittlecyrhen@gmail.com', NULL, '$2y$12$vqL1g8rYdT8SJkPhkQH8Vurj4F9oCUOvM6fwF8Y4qloDOp0i9CdZy', 1, NULL, '2025-01-10 02:56:00', '2025-01-10 02:57:09', '09432648843', '2002-09-03', 'Female', 'North Daang Hari, Taguig City'),
(9, 'Client User', 'jayannbalatero@gmail.com', NULL, '$2y$12$qeZabj9EFy/eFNSR7r.FKej70AkKUTDpt17UXJaNEfXoQLP2W3FvS', 1, NULL, '2025-01-10 02:59:47', '2025-01-10 03:17:06', '09605233822', '2002-01-31', 'Female', 'Dasmarinas City Cavite'),
(10, 'Client User', 'mariaeloissaandal@gmail.com', NULL, '$2y$12$GQ6jeP86JpbemIIaHR..B.YbOw/cw8X08ay8cmGzQFOiTv/sRM02a', 1, NULL, '2025-01-10 03:12:02', '2025-01-10 03:14:21', '09562817944', '2003-02-20', 'Female', 'Antipolo City'),
(11, 'Client User', 'signetenriquez@gmail.com', NULL, '$2y$12$zpaO7REAsyN9UgfXwdbJ/OnhR0/TCEJWuV3Jvuscg7CN2tHgVCTIK', 1, NULL, '2025-01-10 03:15:22', '2025-01-10 03:16:29', '09165227475', '2004-05-19', 'Female', 'Marikina City'),
(12, 'Tara Caguiat', 'taracaguiat456@gmail.com', NULL, '$2y$12$WeNyCdApXmQmpGH0fvFr3OJ/qpsD1PJD93FFOmvycatS92zO1PX0m', 1, NULL, '2025-01-10 06:49:23', '2025-01-10 07:08:21', '09761515952', '2002-07-25', 'Female', 'Manila City'),
(13, 'Coworker User', 'coworker4@example.com', NULL, '$2y$12$BHQj5Y9s8F4dhDloEpLHqee75g5XJ9eLmaDJ4BNDiV77PvEO5.vpS', 2, NULL, '2025-01-10 07:16:34', '2025-01-10 07:16:34', NULL, NULL, NULL, NULL),
(15, 'Coworker User', 'coworker5@example.com', NULL, '$2y$12$K3ZF.hXz8vDILvqI.AHKzu2Eq79rLiLIKGwpCXyuemNLukXNm26ZK', 2, NULL, '2025-01-11 23:13:49', '2025-01-11 23:13:49', NULL, NULL, NULL, NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `list_space_tbl`
--
ALTER TABLE `list_space_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `meeting_fields`
--
ALTER TABLE `meeting_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
