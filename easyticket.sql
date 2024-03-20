-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2023 at 03:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easyticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `state_id`, `created_at`, `updated_at`) VALUES
(1, 'Mehsana', 0, '2023-02-21 17:19:11', '2023-02-21 17:19:11'),
(2, 'Ahmedabad', 0, '2023-02-21 17:19:11', '2023-02-21 17:19:11'),
(3, 'Gandhinagar', 0, '2023-02-21 17:19:11', '2023-02-21 17:19:11'),
(4, 'Kalol', 0, '2023-02-21 17:19:11', '2023-02-21 17:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `birthdate` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `birthdate`, `created_at`) VALUES
(1, 'Priyangu', '1995-08-02', '2022-12-19 19:12:59'),
(2, 'Vrund', '2003-09-17', '2022-12-19 19:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `language` text NOT NULL,
  `image` text DEFAULT NULL,
  `rating` decimal(3,1) NOT NULL,
  `duration` time NOT NULL,
  `release_date` date NOT NULL,
  `genre` varchar(300) NOT NULL,
  `trailer_url` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `language`, `image`, `rating`, `duration`, `release_date`, `genre`, `trailer_url`, `created_at`, `updated_at`) VALUES
(1, 'Avatar: The Way of Water', 'hindi,english', 'avatar-the-way-of-water.jpg', '9.0', '03:12:00', '2022-12-16', 'Action,Adventure,Fantasy,Sci-Fi\r\n', 'https://www.youtube.com/watch?v=bS2Uh0B6bqg', '2022-12-21 10:54:12', '2022-12-21 10:54:12'),
(2, 'Cirkus', 'hindi', 'cirkus.jpg', '8.2', '02:22:00', '2022-12-23', 'Comedy,Drama\r\n', NULL, '2022-12-21 11:03:58', '2022-12-21 11:03:58'),
(3, 'Drishyam 2', 'hindi', 'drishyam2.jpg', '8.9', '02:20:00', '2022-11-18', 'Drama,Mystery,Thriller\r\n', NULL, '2022-12-21 11:16:01', '2022-12-21 11:16:01'),
(4, 'Aum Mangalam Singlem\r\n', 'Gujarati', 'aum-mangalam-singlem.jpg', '8.8', '02:54:00', '2022-11-18', 'Comedy,Romantic', 'https://www.youtube.com/watch?v=vtR0Uxxox04&ab', '2022-12-26 08:04:17', '2022-12-26 08:04:17');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tickets_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` int(11) NOT NULL,
  `theaters_id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `capacity` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `theaters_id`, `name`, `capacity`, `created_at`, `updated_at`) VALUES
(1, 1, 'Screen 1', 40, '2023-03-11 11:28:44', '2023-03-11 20:40:10'),
(3, 2, 'Screen 1', 30, '2023-03-12 20:23:39', '2023-03-12 22:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `seat_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `seat_no` int(11) NOT NULL,
  `row` varchar(100) NOT NULL,
  `position` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `price` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`seat_id`, `screen_id`, `seat_no`, `row`, `position`, `type`, `price`) VALUES
(991, 1, 1, 'A', 'Left', 'CLASSIC', '100'),
(992, 1, 2, 'A', 'Left', 'CLASSIC', '100'),
(993, 1, 3, 'A', 'Left', 'CLASSIC', '100'),
(994, 1, 4, 'A', 'Left', 'CLASSIC', '100'),
(995, 1, 5, 'A', 'Left', 'CLASSIC', '100'),
(996, 1, 6, 'A', 'Left', 'CLASSIC', '100'),
(997, 1, 7, 'A', 'Left', 'CLASSIC', '100'),
(998, 1, 8, 'A', 'Left', 'CLASSIC', '100'),
(999, 1, 9, 'A', 'Left', 'CLASSIC', '100'),
(1000, 1, 10, 'A', 'Left', 'CLASSIC', '100'),
(1001, 1, 11, 'A', 'Right', 'CLASSIC', '100'),
(1002, 1, 12, 'A', 'Right', 'CLASSIC', '100'),
(1003, 1, 13, 'A', 'Right', 'CLASSIC', '100'),
(1004, 1, 14, 'A', 'Right', 'CLASSIC', '100'),
(1005, 1, 15, 'A', 'Right', 'CLASSIC', '100'),
(1006, 1, 16, 'A', 'Right', 'CLASSIC', '100'),
(1007, 1, 17, 'A', 'Right', 'CLASSIC', '100'),
(1008, 1, 18, 'A', 'Right', 'CLASSIC', '100'),
(1009, 1, 19, 'A', 'Right', 'CLASSIC', '100'),
(1010, 1, 20, 'A', 'Right', 'CLASSIC', '100'),
(1011, 1, 1, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1012, 1, 2, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1013, 1, 3, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1014, 1, 4, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1015, 1, 5, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1016, 1, 6, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1017, 1, 7, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1018, 1, 8, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1019, 1, 9, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1020, 1, 10, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1021, 1, 11, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1022, 1, 12, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1023, 1, 13, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1024, 1, 14, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1025, 1, 15, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1026, 1, 16, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1027, 1, 17, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1028, 1, 18, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1029, 1, 19, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1030, 1, 20, 'B', 'Right', 'CLASSIC PLUS', '150'),
(1051, 3, 1, 'A', 'Left', 'CLASSIC', '100'),
(1052, 3, 2, 'A', 'Left', 'CLASSIC', '100'),
(1053, 3, 3, 'A', 'Left', 'CLASSIC', '100'),
(1054, 3, 4, 'A', 'Left', 'CLASSIC', '100'),
(1055, 3, 5, 'A', 'Left', 'CLASSIC', '100'),
(1056, 3, 6, 'A', 'Left', 'CLASSIC', '100'),
(1057, 3, 7, 'A', 'Left', 'CLASSIC', '100'),
(1058, 3, 8, 'A', 'Left', 'CLASSIC', '100'),
(1059, 3, 9, 'A', 'Left', 'CLASSIC', '100'),
(1060, 3, 10, 'A', 'Left', 'CLASSIC', '100'),
(1061, 3, 11, 'A', 'Right', 'CLASSIC', '100'),
(1062, 3, 12, 'A', 'Right', 'CLASSIC', '100'),
(1063, 3, 13, 'A', 'Right', 'CLASSIC', '100'),
(1064, 3, 14, 'A', 'Right', 'CLASSIC', '100'),
(1065, 3, 15, 'A', 'Right', 'CLASSIC', '100'),
(1066, 3, 16, 'A', 'Right', 'CLASSIC', '100'),
(1067, 3, 17, 'A', 'Right', 'CLASSIC', '100'),
(1068, 3, 18, 'A', 'Right', 'CLASSIC', '100'),
(1069, 3, 19, 'A', 'Right', 'CLASSIC', '100'),
(1070, 3, 20, 'A', 'Right', 'CLASSIC', '100'),
(1071, 3, 1, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1072, 3, 2, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1073, 3, 3, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1074, 3, 4, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1075, 3, 5, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1076, 3, 6, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1077, 3, 7, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1078, 3, 8, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1079, 3, 9, 'B', 'Left', 'CLASSIC PLUS', '150'),
(1080, 3, 10, 'B', 'Left', 'CLASSIC PLUS', '150');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `setting_name` varchar(500) NOT NULL,
  `settings_value` text NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `setting_name`, `settings_value`, `is_active`, `created_at`) VALUES
(1, 'website name', 'easy ticket', 1, '2022-12-23 12:29:45');

-- --------------------------------------------------------

--
-- Table structure for table `showtimes`
--

CREATE TABLE `showtimes` (
  `id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `price_factor` decimal(3,0) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `showtimes`
--

INSERT INTO `showtimes` (`id`, `screen_id`, `movie_id`, `price_factor`, `start_time`, `end_time`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 3, '51', '2022-12-23 08:00:00', '2022-12-23 10:30:00', 1, '2022-12-23 11:22:47', '2022-12-23 11:22:47'),
(5, 4, 3, '0', '2022-12-23 10:45:00', '2022-12-23 13:05:00', 1, '2022-12-23 11:24:07', '2022-12-23 11:24:07'),
(6, 5, 3, '0', '2022-12-23 13:00:58', '2022-12-23 13:00:58', 1, '2022-12-23 13:00:58', '2022-12-23 13:00:58'),
(7, 6, 3, '0', '2022-12-23 13:00:58', '2022-12-23 13:00:58', 1, '2022-12-23 13:00:58', '2022-12-23 13:00:58'),
(8, 7, 3, '0', '2022-12-23 13:06:29', '2022-12-23 13:06:29', 1, '2022-12-23 13:06:29', '2022-12-23 13:06:29'),
(9, 8, 3, '0', '2022-12-23 13:06:29', '2022-12-23 13:06:29', 1, '2022-12-23 13:06:29', '2022-12-23 13:06:29'),
(10, 1, 1, '0', '2022-12-23 11:00:00', '2022-12-23 14:30:00', 1, '2022-12-23 13:15:39', '2022-12-23 13:15:39'),
(11, 9, 4, '0', '2022-12-26 08:00:00', '2022-12-26 10:56:00', 1, '2022-12-26 08:15:22', '2022-12-26 08:15:22'),
(12, 10, 4, '0', '2022-12-26 11:00:00', '2022-12-26 13:56:00', 1, '2022-12-26 08:15:22', '2022-12-26 08:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `theaters`
--

CREATE TABLE `theaters` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `phone_no` decimal(10,0) DEFAULT NULL,
  `city_id` int(11) NOT NULL,
  `address` varchar(300) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theaters`
--

INSERT INTO `theaters` (`id`, `name`, `phone_no`, `city_id`, `address`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Wide Angle', '9925008038', 1, 'uma-shivam residency, G/404, opp. Wide angle, Mehsana, Gujarat 384002', 1, '2022-12-23 10:15:42', '2022-12-23 10:15:42'),
(2, 'PVR: Motera', '9928822911', 2, '4D Square Mall, Visat - Gandhinagar Highway, Ahmedabad, Gujarat 380005, India\r\n', 1, '2022-12-23 12:10:55', '2022-12-23 12:10:55'),
(3, 'Newfangled Miniplex', '9876543211', 2, '312, 3 Floor, North Plaza, Motera, Near 4D Square Mall, Ahmedabad, Gujarat 380005, India\r\n', 1, '2022-12-23 12:21:32', '2022-12-23 12:21:32'),
(4, 'INOX', '1234567899', 3, 'Near Adalaj, Gandhinagar Sarkhej Highway, Near Tri Mandir, Gandhinagar, Gujarat 380055, India\r\n', 1, '2022-12-23 12:27:04', '2022-12-23 12:27:04'),
(5, 'INOX: Gandhinagar,Adalaj', '7228967060', 4, 'Near Adalaj, Gandhinagar Sarkhej Highway, Near Tri Mandir, Gandhinagar, Gujarat 380055, India\r\n', 1, '2022-12-26 07:56:29', '2022-12-26 07:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `showtime_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `payment_id` int(11) UNSIGNED NOT NULL,
  `seat_number` text NOT NULL,
  `show_date` date NOT NULL,
  `price` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `showtime_id`, `movie_id`, `payment_id`, `seat_number`, `show_date`, `price`, `created_at`, `updated_at`) VALUES
(1, 2, 10, 1, 1, 'A9,A10,A12,A11', '2023-02-28', '720', '2023-02-28 09:05:12', '2023-02-28 09:05:12'),
(2, 2, 10, 1, 1234, 'B6,B5,B4,D5,D6,D7', '2023-02-28', '1080', '2023-02-28 09:05:00', '2023-02-28 09:05:00'),
(3, 2, 10, 1, 1234, 'A2,A3,A4', '2023-02-28', '540', '2023-02-28 09:05:04', '2023-02-28 09:05:04'),
(4, 2, 10, 1, 1234, 'A1,A2,A3,A16,A19,A20,A12,A13,A14,A15,A17', '2023-03-12', '1100', '2023-03-11 17:02:50', '2023-03-11 17:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_type` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `user_type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Vrund Patel', 'vrundpatel@gmail.com', NULL, 'admin', '$2y$10$NUJeGcpzVovAMN6JlkcUzu2m/Zey59zMiSnbyiY4e0Ebwaby0jPO.', NULL, '2023-02-27 12:09:33', '2023-02-27 12:09:33'),
(3, 'Meet Patel', 'meetpatel@gmail.com', NULL, 'user', '$2y$10$NUJeGcpzVovAMN6JlkcUzu2m/Zey59zMiSnbyiY4e0Ebwaby0jPO.', NULL, '2023-02-28 12:09:33', '2023-02-28 12:09:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theaters_id` (`theaters_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`seat_id`),
  ADD KEY `screen_id` (`screen_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `screen_id` (`screen_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `theaters`
--
ALTER TABLE `theaters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `showtime_id` (`showtime_id`);

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
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `seat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1081;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `showtimes`
--
ALTER TABLE `showtimes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `theaters`
--
ALTER TABLE `theaters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `screens`
--
ALTER TABLE `screens`
  ADD CONSTRAINT `screens_ibfk_1` FOREIGN KEY (`theaters_id`) REFERENCES `theaters` (`id`);

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_ibfk_1` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`);

--
-- Constraints for table `showtimes`
--
ALTER TABLE `showtimes`
  ADD CONSTRAINT `showtimes_ibfk_1` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`),
  ADD CONSTRAINT `showtimes_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`);

--
-- Constraints for table `theaters`
--
ALTER TABLE `theaters`
  ADD CONSTRAINT `theaters_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`showtime_id`) REFERENCES `showtimes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
