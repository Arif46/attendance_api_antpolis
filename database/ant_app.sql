-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 10:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ant_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved_a` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved_s` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `attendance_date`, `check_in`, `check_out`, `status`, `is_approved_a`, `is_approved_s`) VALUES
(1, 1, '2020-05-15 18:00:00.000000', '23:28:28', '23:28:30', 'Meeting Late', 0, 1),
(2, 2, '2020-05-15 18:00:00.000000', '23:28:28', '23:28:30', 'Meeting Late', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_logs`
--

CREATE TABLE `attendance_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved_a` tinyint(1) NOT NULL DEFAULT 0,
  `is_approved_s` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendance_logs`
--

INSERT INTO `attendance_logs` (`id`, `user_id`, `attendance_date`, `check_in`, `check_out`, `status`, `is_approved_a`, `is_approved_s`) VALUES
(1, 1, '2020-05-16 17:29:06.486500', '23:28:28', '23:28:30', NULL, 0, 1),
(2, 1, '2020-05-16 19:15:40.000000', '01:15:38', '01:15:40', NULL, 0, 0),
(3, 1, '2020-05-16 19:15:47.000000', '01:15:43', '01:15:47', NULL, 0, 0),
(4, 1, '2020-05-16 19:15:56.000000', '01:15:54', '01:15:56', NULL, 0, 0),
(5, 1, '2020-05-16 19:16:03.000000', '01:15:59', '01:16:03', NULL, 0, 0),
(6, 1, '2020-05-17 10:03:39.000000', '16:03:37', '16:03:39', NULL, 0, 0),
(7, 1, '2020-05-17 10:03:43.000000', '16:03:41', '16:03:43', NULL, 0, 0),
(8, 1, '2020-05-17 10:03:45.000000', '16:03:45', NULL, NULL, 0, 0),
(9, 1, '2020-05-18 19:47:16.000000', '01:47:14', '01:47:16', NULL, 0, 0),
(10, 1, '2020-05-18 20:15:29.000000', '02:15:27', '02:15:29', NULL, 0, 0),
(11, 1, '2020-05-18 20:15:33.000000', '02:15:31', '02:15:33', NULL, 0, 0),
(12, 1, '2020-05-18 22:19:23.000000', '04:10:06', '04:19:23', NULL, 0, 0),
(13, 1, '2020-05-18 22:19:42.000000', '04:19:38', '04:19:42', NULL, 0, 0),
(14, 1, '2020-05-18 22:19:48.000000', '04:19:45', '04:19:48', NULL, 0, 0),
(15, 1, '2020-05-18 22:21:46.000000', '04:21:30', '04:21:46', NULL, 0, 0),
(16, 1, '2020-05-18 22:36:54.000000', '04:36:51', '04:36:54', NULL, 0, 0),
(17, 1, '2020-05-18 22:37:00.000000', '04:36:57', '04:37:00', NULL, 0, 0),
(18, 1, '2020-05-18 22:37:09.000000', '04:37:05', '04:37:09', NULL, 0, 0),
(19, 1, '2020-05-18 22:37:14.000000', '04:37:12', '04:37:14', NULL, 0, 0),
(20, 1, '2020-05-18 22:37:22.000000', '04:37:19', '04:37:22', NULL, 0, 0),
(21, 1, '2020-05-18 22:37:31.000000', '04:37:26', '04:37:31', NULL, 0, 0),
(22, 1, '2020-05-19 19:43:54.000000', '01:43:52', '01:43:54', NULL, 0, 0),
(23, 1, '2020-05-19 19:44:33.000000', '01:44:31', '01:44:33', NULL, 0, 0),
(24, 1, '2020-05-19 19:44:36.000000', '01:44:34', '01:44:36', NULL, 0, 0),
(25, 1, '2020-05-19 19:47:21.000000', '01:47:19', '01:47:21', NULL, 0, 0),
(26, 1, '2020-05-19 21:36:34.000000', '01:47:23', '03:36:34', NULL, 0, 0),
(27, 1, '2020-05-19 21:37:11.000000', '03:37:07', '03:37:11', NULL, 0, 0),
(33, 1, '2020-05-22 22:37:18.000000', '04:37:18', NULL, NULL, 0, 0),
(34, 1, '2020-05-29 23:16:13.000000', '05:16:13', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `created_at`, `updated_at`) VALUES
(1, 'gdfg', '2020-05-19 18:46:00', '2020-05-19 18:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `designation_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_brands`
--

CREATE TABLE `lead_brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_brand_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_brand_facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_brand_instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_brand_linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_brand_youTube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_brand_comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_brand_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_company_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_brand_services`
--

CREATE TABLE `lead_brand_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_brand_id` int(10) UNSIGNED NOT NULL,
  `lead_product_or_service_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_companies`
--

CREATE TABLE `lead_companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_company_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_industries`
--

CREATE TABLE `lead_industries` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_industry_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_product_or_services`
--

CREATE TABLE `lead_product_or_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_product_or_service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_lead_product_or_service` tinyint(4) NOT NULL,
  `lead_sub_industry_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_sub_industries`
--

CREATE TABLE `lead_sub_industries` (
  `id` int(10) UNSIGNED NOT NULL,
  `lead_sub_industry_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_industry_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2020_04_14_020945_create_companies_table', 1),
(5, '2020_04_14_020950_create_departments_table', 1),
(6, '2020_04_14_020955_create_sub_departments_table', 1),
(7, '2020_04_14_020958_create_designations_table', 1),
(8, '2020_04_20_113106_create_lead_industries_table', 1),
(9, '2020_04_20_113441_create_lead_sub_industries_table', 1),
(10, '2020_04_20_113521_create_lead_companies_table', 1),
(11, '2020_04_20_113544_create_lead_brands_table', 1),
(12, '2020_04_21_102944_create_lead_product_or_services_table', 1),
(13, '2020_04_21_203236_create_lead_brand_services_table', 1),
(14, '2020_04_26_160719_create_user_information_table', 1),
(15, '2020_05_01_195010_create_permission_tables', 1),
(16, '2020_05_04_212456_create_attendance_logs_table', 1),
(17, '2020_05_07_074521_create_attendances_table', 1),
(18, '2020_05_10_021140_create_old_attendances_table', 1),
(19, '2020_05_16_224803_create_remarks_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `old_attendances`
--

CREATE TABLE `old_attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isApproved_a` tinyint(1) NOT NULL DEFAULT 0,
  `isApproved_s` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id_receiver` int(10) UNSIGNED DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id_sender` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`id`, `user_id_receiver`, `subject`, `description`, `user_id_sender`, `created_at`, `updated_at`) VALUES
(9, 1, 'profile', 'rtyrt', 1, '2020-05-18 23:13:28', '2020-05-18 23:13:28'),
(10, 3, 'profile', 'rtyrt', 1, '2020-05-18 23:13:31', '2020-05-18 23:13:31'),
(11, 1, 'profile', 'rtyrt', 1, '2020-05-18 23:13:34', '2020-05-18 23:13:34'),
(12, 1, 'profile', 'afasdadadas', 1, '2020-05-18 23:13:39', '2020-05-18 23:13:39'),
(13, 1, 'profile', 'dasdasda', 1, '2020-05-18 23:13:43', '2020-05-18 23:13:43'),
(14, 1, 'profile', 'dasdasdadfadfa', 1, '2020-05-18 23:13:46', '2020-05-18 23:13:46'),
(15, 1, 'profile', 'dasdasdadfadfaasdasd', 1, '2020-05-18 23:13:48', '2020-05-18 23:13:48'),
(16, 1, 'profile', 'dasdasdadfadfaasdasddfaf', 1, '2020-05-18 23:13:52', '2020-05-18 23:13:52'),
(17, 1, 'profile', 'dasdasdadfadfaasdasddfaf', 1, '2020-05-18 23:13:53', '2020-05-18 23:13:53'),
(18, 1, 'profile', 'fdsfsd', 1, '2020-05-18 23:27:07', '2020-05-18 23:27:07'),
(19, 3, 'dfd', 'dsfds', 1, '2020-05-19 20:04:10', '2020-05-19 20:04:10'),
(20, 1, 'cc', 'cc', 1, '2020-05-19 21:33:42', '2020-05-19 21:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', NULL, NULL),
(2, 'admin', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_departments`
--

CREATE TABLE `sub_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `sub_department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_person_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_person_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discord_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '$2y$12$H48o62uiywd1m.uo4MCS.O5hFWnGkUf/I8PwWzsYhF0baa0alp2Am',
  `is_approved` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `personal_email`, `mobile_number`, `gender`, `present_address`, `permanent_address`, `fb_username`, `emergency_person_name`, `emergency_person_relation`, `emergency_number`, `discord_id`, `blood_group`, `dob`, `photo`, `identification_number`, `identification_photo`, `identification_type`, `medical_condition`, `email_verified_at`, `password`, `is_approved`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nahid', 'Hasan', 'Limon', 'check@gmail.com', 'is_approved', '455', 'female', 'dfgdf', 'gdfgdfg', 'dff', 'gdfg', 'gfdg', 'dfg', 'dfgdf', '0+', '1990-08-30', 'b05f3f621fa751832ebf57a847d32827f78eec0b.PNG', 'rtytr', '5dd243d4bb8b0a6d0a503c5399b14fc099b3fb50.PNG', 'birth certificate', 'rttr', NULL, '$2y$12$H48o62uiywd1m.uo4MCS.O5hFWnGkUf/I8PwWzsYhF0baa0alp2Am', 0, NULL, NULL, '2020-05-19 21:32:28'),
(3, 'c', 'c', 'c', 'check2@gmail.com', 'is_approved2', '455', 'male', 'dfgdf', 'gdfgdfg', 'dff', 'gdfg', 'gfdg', 'dfg', 'dfgdf', '0+', '2006-04-06', 'b05f3f621fa751832ebf57a847d32827f78eec0b.PNG', 'rtytr', '5dd243d4bb8b0a6d0a503c5399b14fc099b3fb50.PNG', 'birth certificate', 'rttr', NULL, '$2y$12$H48o62uiywd1m.uo4MCS.O5hFWnGkUf/I8PwWzsYhF0baa0alp2Am', 0, NULL, NULL, '2020-05-19 21:32:30');

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `financial_information` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`financial_information`)),
  `work_experience` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`work_experience`)),
  `educational_qualification` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`educational_qualification`)),
  `skill` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`skill`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`id`, `user_id`, `financial_information`, `work_experience`, `educational_qualification`, `skill`, `created_at`, `updated_at`) VALUES
(1, 1, '{\"personal_bank_name\":\"dfg\",\"personal_bank_account_name\":\"dfgfg\",\"personal_bank_account_number\":\"fdgdf\",\"personal_bank_branch_name\":\"dfgdf\",\"personal_bank_branch_routing_number\":\"dgd\",\"bkash_account_number\":\"df\",\"bkash_account_type\":\"personal\"}', '[{\"title\":\"dfgfd\",\"company\":\"gfdg\",\"joinDate\":\"2020-05-22\",\"LeftDate\":\"2020-05-20\"}]', '[{\"degree\":\"MSC\",\"programOrGroup\":\"dfgd\",\"institution\":\"dfg\",\"gpa\":\"dg\",\"major\":\"dfgd\",\"minor\":\"fg\",\"passingDate\":\"2020-05-12\"},{\"degree\":\"BBA\",\"programOrGroup\":\"dge\",\"institution\":\"erte\",\"gpa\":\"rter\",\"major\":\"tert\",\"minor\":\"erter\",\"passingDate\":\"2020-05-05\"}]', '[{\"name\":\"gdfg\",\"category\":\"dfgdf\",\"workspace\":\"YES\",\"profeciency\":\"Beginner\"},{\"name\":\"fgfd\",\"category\":\"fdgd\",\"workspace\":\"YES\",\"profeciency\":\"Advanced\"}]', '2020-05-17 09:29:43', '2020-05-17 10:03:00'),
(2, 3, '{\"personal_bank_name\":\"dfg\",\"personal_bank_account_name\":\"dfgfg\",\"personal_bank_account_number\":\"fdgdf\",\"personal_bank_branch_name\":\"dfgdf\",\"personal_bank_branch_routing_number\":\"dgd\",\"bkash_account_number\":\"df\",\"bkash_account_type\":\"personal\"}', NULL, NULL, NULL, '2020-05-19 19:40:32', '2020-05-19 19:40:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_company_id_foreign` (`company_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_sub_department_id_foreign` (`sub_department_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_brands`
--
ALTER TABLE `lead_brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_brands_lead_company_id_foreign` (`lead_company_id`);

--
-- Indexes for table `lead_brand_services`
--
ALTER TABLE `lead_brand_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_brand_services_lead_brand_id_foreign` (`lead_brand_id`),
  ADD KEY `lead_brand_services_lead_product_or_service_id_foreign` (`lead_product_or_service_id`);

--
-- Indexes for table `lead_companies`
--
ALTER TABLE `lead_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_industries`
--
ALTER TABLE `lead_industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_product_or_services`
--
ALTER TABLE `lead_product_or_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_product_or_services_lead_sub_industry_id_foreign` (`lead_sub_industry_id`);

--
-- Indexes for table `lead_sub_industries`
--
ALTER TABLE `lead_sub_industries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_sub_industries_lead_industry_id_foreign` (`lead_industry_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `old_attendances`
--
ALTER TABLE `old_attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sub_departments`
--
ALTER TABLE `sub_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_departments_department_id_foreign` (`department_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_personal_email_unique` (`personal_email`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attendance_logs`
--
ALTER TABLE `attendance_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_brands`
--
ALTER TABLE `lead_brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_brand_services`
--
ALTER TABLE `lead_brand_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_companies`
--
ALTER TABLE `lead_companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_industries`
--
ALTER TABLE `lead_industries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_product_or_services`
--
ALTER TABLE `lead_product_or_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_sub_industries`
--
ALTER TABLE `lead_sub_industries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `old_attendances`
--
ALTER TABLE `old_attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_departments`
--
ALTER TABLE `sub_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_sub_department_id_foreign` FOREIGN KEY (`sub_department_id`) REFERENCES `sub_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_brands`
--
ALTER TABLE `lead_brands`
  ADD CONSTRAINT `lead_brands_lead_company_id_foreign` FOREIGN KEY (`lead_company_id`) REFERENCES `lead_companies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_brand_services`
--
ALTER TABLE `lead_brand_services`
  ADD CONSTRAINT `lead_brand_services_lead_brand_id_foreign` FOREIGN KEY (`lead_brand_id`) REFERENCES `lead_brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lead_brand_services_lead_product_or_service_id_foreign` FOREIGN KEY (`lead_product_or_service_id`) REFERENCES `lead_product_or_services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_product_or_services`
--
ALTER TABLE `lead_product_or_services`
  ADD CONSTRAINT `lead_product_or_services_lead_sub_industry_id_foreign` FOREIGN KEY (`lead_sub_industry_id`) REFERENCES `lead_sub_industries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lead_sub_industries`
--
ALTER TABLE `lead_sub_industries`
  ADD CONSTRAINT `lead_sub_industries_lead_industry_id_foreign` FOREIGN KEY (`lead_industry_id`) REFERENCES `lead_industries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_departments`
--
ALTER TABLE `sub_departments`
  ADD CONSTRAINT `sub_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
