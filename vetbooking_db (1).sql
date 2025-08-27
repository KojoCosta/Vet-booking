-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 06:48 AM
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
-- Database: `vetbooking_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pet_id` bigint(20) UNSIGNED NOT NULL,
  `vet_id` bigint(20) UNSIGNED NOT NULL,
  `scheduled_at` datetime NOT NULL,
  `status` enum('pending','confirmed','canceled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `pet_id`, `vet_id`, `scheduled_at`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 47, '2025-08-30 21:25:00', 'confirmed', 'Dull', '2025-08-25 04:21:23', '2025-08-26 18:33:16'),
(2, 3, 47, '2025-09-25 15:00:00', 'confirmed', 'Vacination', '2025-08-25 14:14:49', '2025-08-26 20:14:40'),
(3, 2, 47, '2025-09-04 13:01:00', 'confirmed', 'Broken Leg', '2025-08-26 21:13:41', '2025-08-27 00:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_reactions`
--

CREATE TABLE `appointment_reactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','approved','declined') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_reactions`
--

INSERT INTO `appointment_reactions` (`id`, `appointment_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, '2025-08-26 20:44:06', '2025-08-26 20:44:06', 'approved'),
(2, 2, '2025-08-26 20:44:27', '2025-08-26 20:44:27', 'declined'),
(3, 3, '2025-08-26 22:01:31', '2025-08-27 00:20:30', 'approved');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_08_18_161308_create_owners_table', 1),
(6, '2025_08_18_161414_create_pets_table', 1),
(7, '2025_08_18_161547_create_veterinarians_table', 1),
(8, '2025_08_18_161610_create_appointments_table', 1),
(9, '2025_08_19_190639_add_role_and_profile_to_users_table', 1),
(10, '2025_08_21_043954_create_appointment_reactions_table', 1),
(11, '2025_08_21_053154_add_appointment_id_to_appointment_reactions', 1),
(12, '2025_08_22_070747_drop_name_email_from_owners_table', 1),
(13, '2025_08_22_072735_drop_name_email_from_veterinarians_table', 1),
(14, '2025_08_23_125506_add_status_to_appointment_reactions_table', 2),
(15, '2025_08_23_134208_add_vet_name_to_veterinarians_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`id`, `user_id`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(63, 87, '20664499', 'AK-07-551', '2025-08-24 15:42:00', '2025-08-24 15:42:00');

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
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `sex` enum('male','female') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `owner_id`, `name`, `species`, `breed`, `birthdate`, `sex`, `created_at`, `updated_at`) VALUES
(1, 63, 'Johnson', 'Cat', 'Russian', '2023-06-01', 'male', '2025-08-25 03:15:23', '2025-08-25 03:15:23'),
(2, 63, 'Korea', 'Dog', 'German Sherpherd', '2021-03-06', 'female', '2025-08-25 03:25:17', '2025-08-25 03:25:17'),
(3, 63, 'Counter', 'Dog', 'German Shepherd', '2023-12-04', 'male', '2025-08-25 14:13:26', '2025-08-25 14:13:26');

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
  `role` varchar(255) NOT NULL DEFAULT 'owner',
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `veterinarian_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `owner_id`, `veterinarian_id`) VALUES
(1, 'Dr. Emiliano Kohler DDS', 'brooks.bernier@example.org', '2025-08-22 07:38:58', '$2y$10$S6q.PayIfdCEYVokQwIjCen4O3zZxY0Ur2wRfUZhEPJD87qUGh04a', '9vHrGBPntlvRoun5UXLBAxtbyo8qNWF6z6RRBQEBFSaP5KPr6vxaDOG9lwu4', '2025-08-22 07:38:59', '2025-08-23 11:21:11', 'admin', NULL, NULL),
(86, 'Super Admin', 'admin@vetbook.com', NULL, '$2y$10$t56YDl4..TAaD/IPs2uEZ.yCjJWp.wuyOt0K9ioqVwuOFxuUYluJK', NULL, '2025-08-24 15:40:32', '2025-08-24 15:40:32', 'admin', NULL, NULL),
(87, 'Super Owner', 'owners@vetbook.com', NULL, '$2y$10$246pR.U2QkfV5jGL7/mhbu6zPu5kp6hveSIjtvC9T19ZERPYVxOcW', NULL, '2025-08-24 15:42:00', '2025-08-24 15:42:00', 'owner', NULL, NULL),
(88, 'Super Veterinarian', 'vets@vetbook.com', NULL, '$2y$10$FMmjfALUCx.5ZW5BRjlAcOFAttokbvGHV84U15ayRiYmkxBAbTLhW', NULL, '2025-08-24 15:43:27', '2025-08-24 15:43:27', 'veterinarian', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `veterinarians`
--

CREATE TABLE `veterinarians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vet_name` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `license_number` varchar(255) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `veterinarians`
--

INSERT INTO `veterinarians` (`id`, `vet_name`, `user_id`, `phone`, `license_number`, `specialization`, `created_at`, `updated_at`) VALUES
(47, 'Dr. Vets', 88, '40326599', 'LIC-2025-001', 'General Care', '2025-08-24 15:43:27', '2025-08-24 15:43:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_pet_id_foreign` (`pet_id`),
  ADD KEY `appointments_vet_id_foreign` (`vet_id`);

--
-- Indexes for table `appointment_reactions`
--
ALTER TABLE `appointment_reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointment_reactions_appointment_id_foreign` (`appointment_id`);

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
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owners_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_owner_id_foreign` (`owner_id`),
  ADD KEY `users_veterinarian_id_foreign` (`veterinarian_id`);

--
-- Indexes for table `veterinarians`
--
ALTER TABLE `veterinarians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `veterinarians_license_number_unique` (`license_number`),
  ADD KEY `veterinarians_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment_reactions`
--
ALTER TABLE `appointment_reactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `owners`
--
ALTER TABLE `owners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `veterinarians`
--
ALTER TABLE `veterinarians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_pet_id_foreign` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_vet_id_foreign` FOREIGN KEY (`vet_id`) REFERENCES `veterinarians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `appointment_reactions`
--
ALTER TABLE `appointment_reactions`
  ADD CONSTRAINT `appointment_reactions_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `owners`
--
ALTER TABLE `owners`
  ADD CONSTRAINT `owners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `owners` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_veterinarian_id_foreign` FOREIGN KEY (`veterinarian_id`) REFERENCES `veterinarians` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `veterinarians`
--
ALTER TABLE `veterinarians`
  ADD CONSTRAINT `veterinarians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
