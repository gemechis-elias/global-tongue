-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2020 at 02:44 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_basic_crud`
--

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
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1), 
(9, '2023_08_13_192658_create_courses_table', 1),
(10, '2023_08_27_120623_create_units_table', 1) ,
(11, '2023_08_30_214119_create_lessons_table' 1);

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
 CREATE TABLE IF NOT EXISTS `courses` (
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Created By Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `courses` (`course_id`, `name`, `description`, `tag`, `level`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Course 1', 'Course 1 Description', 'tag1', 'beginner', 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(2, 'Course 2', 'Course 2 Description', 'tag2', 'intermediate', 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),



CREATE TABLE  IF NOT EXISTS `units` (
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_lessons` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 

CREATE TABLE  IF NOT EXISTS `lessons`(
  `lessons_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Created By Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `units` (`unit_id`, `course_id`, `unit_name`, `unit_title`, `unit_description`, `unit_image`, `no_of_lessons`, `created_at`, `updated_at`) VALUES
(1, 1, 'Unit 1', 'Unit 1 Title', 'Unit 1 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(2, 1, 'Unit 2', 'Unit 2 Title', 'Unit 2 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(3, 1, 'Unit 3', 'Unit 3 Title', 'Unit 3 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(4, 1, 'Unit 4', 'Unit 4 Title', 'Unit 4 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(5, 1, 'Unit 5', 'Unit 5 Title', 'Unit 5 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(6, 2, 'Unit 1', 'Unit 1 Title', 'Unit 1 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(7, 2, 'Unit 2', 'Unit 2 Title', 'Unit 2 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(8, 2, 'Unit 3', 'Unit 3 Title', 'Unit 3 Description', NULL, 5, '2020-12-15 11:29:03', '2020-12-15 11:29:03') 

-- --------------------------------------------------------

INSERT INTO `lessons`(
  `lesson_id`, `unit_id`, `course_id`, `lesson_title`, `lesson_type`, `lesson_cover`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Lesson 1', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(2, 1, 1, 'Lesson 2', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(3, 1, 1, 'Lesson 3', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(4, 1, 1, 'Lesson 4', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(5, 1, 1, 'Lesson 5', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(6, 2, 1, 'Lesson 1', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(7, 2, 1, 'Lesson 2', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(8, 2, 1, 'Lesson 3', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(9, 2, 1, 'Lesson 4', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(10, 2, 1, 'Lesson 5', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'
)

--
-- Table structure for table `users`
--


CREATE TABLE IF NOT EXISTS  `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subscription_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_registered` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 
--
-- Dumping data for table `admins`
-- 
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `birthdate`,`level`,`subscription_type`, `password`, `remember_token`, `date_registered`, `updated_at`) VALUES
(1, 'Gemechis Elias', 'gemechis@gmail.com', NULL,'2020-12-15','beginner','free', '$2y$10$jdG3GU42lMN5ZI2OiExOiOW16D9E9IWLEyfVRonczCtGv9uwgiAEK', NULL, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(2, 'Amanuel Abebe', 'aman@gmail.com', '2020-12-15 11:29:03','2020-12-15','beginner','free', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'LkbWggOXQM', '2020-12-15 11:29:03', '2020-12-15 11:29:03'),
(3, 'Tinsaye', 'tinsaye@gmail.com', '2020-12-15 11:29:03','2020-12-15','beginner','free', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rs6yUe6frs', '2020-12-15 11:29:03', '2020-12-15 11:29:03'),

-- Indexes for dumped tables
--

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
 
-- 
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`),
  ADD KEY `course_id` (`course_id`);

ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lesson_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `course_id` (`course_id`);
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
 
--
ALTER TABLE `courses`
  MODIFY `course_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

ALTER TABLE `units`
  MODIFY `unit_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
ALTER TABLE `lessons`
  MODIFY `lesson_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
 

--
-- Constraints for dumped tables
--

--
 
--
  ALTER TABLE `courses`
  ADD CONSTRAINT `courses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

   ALTER TABLE `units`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
   ALTER TABLE `lessons`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`),
  ADD CONSTRAINT `unit_id` FOREIGN KEY (`unit_id`) REFERENCES `units` (`unit_id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
