-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `global_tongue`
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1), 
(4, '2023_08_13_192658_create_courses_table', 1),
(5, '2023_08_27_120623_create_units_table', 1) ,
(6, '2023_08_30_214119_create_lessons_table', 1),
(7, '2023_08_31_231946_create_exercises_table', 1),
(8, '2023_09_06_215103_create_level_table', 1),
(9, '2023_09_07_220228_create_tips_table', 1),
(10, '2023_09_12_230403_create_progress_table', 1);

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
-- --------------------------------------------------------


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
(3, 'Tinsaye', 'tinsaye@gmail.com', '2020-12-15 11:29:03','2020-12-15','beginner','free', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rs6yUe6frs', '2020-12-15 11:29:03', '2020-12-15 11:29:03');


--  -----------------------------------------------------
 CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Created By Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `courses` (`id`, `name`, `description`,  `level`,`type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Course 1', 'Course 1 Description',   'beginner','free', 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),

-- --------------------------------------------------------

 CREATE TABLE IF NOT EXISTS `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,

  `name` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Created By Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `levels` (`id`, `course_id`, `name`, `description`, `tag`, `level`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Level 1', 'Level 1 Description', 'Level 1 Tag', 'beginner', 'free', 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),


-- --------------------------------------------------------
CREATE TABLE  IF NOT EXISTS `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,

  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Created By Admin',

  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 

INSERT INTO `units` (`id`, `course_id`, `level_id`, `unit_name`, `unit_title`, `unit_description`, `unit_image`,  `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Unit 1', 'Unit 1 Title', 'Unit 1 Description', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `exercises`(
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,

  `exercise_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `choices` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incorrect_hint` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correct_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT 1 COMMENT 'Created By Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `exercises` (`id`, `course_id`, `level_id`, `unit_id`, `lesson_id`, `exercise_type`, `instruction`, `question`, `image`, `voice`, `choices`, `incorrect_hint`, `correct_answer`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 'multiple_choice', 'Instruction', 'Question', NULL, NULL, 'Choices', 'Incorrect Hint', 'Correct Answer', 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),

-- --------------------------------------------------------
CREATE TABLE  IF NOT EXISTS `lessons`(
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) UNSIGNED NOT NULL,

  `lesson_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesson_cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT 1 COMMENT 'Created By Admin',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lessons` (`id`, `course_id`, `level_id`, `unit_id`, `lesson_title`, `lesson_type`, `lesson_cover`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Lesson 1', 'video', NULL, 1, '2020-12-15 11:29:03', '2020-12-15 11:29:03'),


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
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_user_id_foreign` (`user_id`);

ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`)
  ADD KEY `levels_user_id_foreign` (`user_id`);




ALTER TABLE `units`
  ADD PRIMARY KEY (`id`)
  ADD KEY `units_user_id_foreign` (`user_id`);


ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`)
  ADD KEY `lessons_user_id_foreign` (`user_id`);

ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`)
  ADD KEY `exercises_user_id_foreign` (`user_id`);
--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);
 

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;


ALTER TABLE `lessons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
ALTER TABLE `exercises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
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

  ALTER TABLE `levels`
  ADD CONSTRAINT `levels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
   ALTER TABLE `units`
  ADD CONSTRAINT `units_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
   ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

  ALTER TABLE `exercises`
  ADD CONSTRAINT `exercises_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
  

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
