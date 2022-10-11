-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Okt 2022 um 08:44
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `laravel_ipa_test_2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `color_id`, `created_at`, `updated_at`) VALUES
(2, 1, 'Second category', 2, '2022-09-13 05:18:21', '2022-09-13 05:18:21'),
(4, 2, 'Tennis', 2, '2022-09-20 04:41:11', '2022-09-20 04:41:11'),
(5, 2, 'Basketball', 1, '2022-09-20 04:41:30', '2022-09-20 04:41:30'),
(6, 2, 'Shoeball', 1, '2022-09-20 04:41:49', '2022-09-20 04:47:06'),
(7, 2, 'Blarns Ball', 4, '2022-10-10 09:55:20', '2022-10-10 09:55:20');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `colors`
--

INSERT INTO `colors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'red', NULL, NULL),
(2, 'blue', NULL, NULL),
(3, 'green', NULL, NULL),
(4, 'yellow', NULL, NULL),
(5, 'pink', NULL, NULL),
(6, 'orange', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `failed_jobs`
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
-- Tabellenstruktur für Tabelle `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_06_074401_create_colors_table', 1),
(6, '2022_09_06_075013_create_categories_table', 1),
(7, '2022_09_06_082456_create_types_table', 1),
(8, '2022_09_06_082704_create_trophies_table', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'authToken', '017722edd0b21d6038cb8d95c13803b5c77d69ab8cd0c1a1ec2969455330365e', '[\"*\"]', '2022-09-20 10:35:42', '2022-09-07 06:28:19', '2022-09-20 10:35:42'),
(2, 'App\\Models\\User', 2, 'authToken', '086d66b94a7a7c24a3587f673ceb5f7cae5cbc4111c315d4cd122a1624d3b8cd', '[\"*\"]', NULL, '2022-09-19 12:01:29', '2022-09-19 12:01:29'),
(3, 'App\\Models\\User', 2, 'authToken', '54b5e32bd905b0d0a05780b6d9d67e121fc7404e16e44c58f4d95d49b78dfb75', '[\"*\"]', NULL, '2022-09-19 12:03:30', '2022-09-19 12:03:30'),
(4, 'App\\Models\\User', 2, 'authToken', '7aacfbab0e13d4da079875198c57d28d4ef284d5e070de88e80a480385a6a5b7', '[\"*\"]', '2022-10-10 09:55:20', '2022-09-20 04:33:32', '2022-10-10 09:55:20'),
(5, 'App\\Models\\User', 1, 'authToken', '96ddd89d010dc27cc62736ae52286570c60f4cc30e673711fa4608b03d00a8e4', '[\"*\"]', NULL, '2022-10-10 09:47:07', '2022-10-10 09:47:07');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `trophies`
--

CREATE TABLE `trophies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ranking` int(11) NOT NULL,
  `date` date NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `oponent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `club_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `trophies`
--

INSERT INTO `trophies` (`id`, `user_id`, `type_id`, `title`, `ranking`, `date`, `category_id`, `place`, `oponent`, `score`, `price`, `club_name`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'sdf', 6, '2004-12-12', NULL, '1', 'sdfas', '12', 34, 'sdfa', 'image/KAPyIMoXwMuQeiSfkHC9FhVVzWyHFuC7dd8zY27H.jpg', '2022-09-07 10:42:42', '2022-09-07 10:42:42'),
(2, 1, 1, 'Bloober', 5, '2003-12-12', 2, '1', 'sdfas', '12', 34, 'sdfa', 'image/OAJJy91kC3UXcSXOtLayMVXqHKqHpYX0nRFaDSq3.jpg', '2022-09-13 06:34:11', '2022-09-20 10:34:38'),
(3, 1, 1, 'Bloober', 8, '2002-12-12', 2, 'Uganda', 'sdfas', '12', 500, 'Joombo', 'image/xmaxZ0NcF8L1jf30hH9AcbgZAYZUQKVvZjGllvpJ.jpg', '2022-09-13 06:46:46', '2022-09-20 10:34:53'),
(4, 1, 2, 'Bloober', 5, '2001-12-12', NULL, 'Poland', 'sdfas', '12', 500, 'Joombo', 'image/gcrFQpFC2Vg5cZ6Y2MiBMXUJlVdAuD37vQTRyar1.jpg', '2022-09-13 06:54:17', '2022-09-20 10:19:30'),
(6, 2, 1, 'Test Tournament 2', 1, '2003-01-01', 4, 'Test Place', 'Test Guys', '3/2', 50, 'Test Club', 'image/XWz37wXBFpMM5T1z2Yi3zHYRUqU3hC5mNFSiX47O.jpg', '2022-09-20 06:58:15', '2022-09-20 06:58:15'),
(7, 2, 1, 'Test 3', 1, '2001-01-01', 4, 'Test Place 2', 'Test Guys 2', '4/3', 60, 'Test Club 2', 'image/1jKB3UAB2GezLCWWV94DhngrRZSoj1DHeE7qlrAc.jpg', '2022-09-20 09:54:40', '2022-09-20 09:54:40');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `types`
--

INSERT INTO `types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Trophäe', NULL, NULL),
(2, 'Medallie', NULL, NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Bob Smith', 'bob@smith.com', NULL, '$2y$10$7hj98Y93DRxrAsm4EB.LW.EoGPodi0o4gv2WMPanrzxK69jvysc5q', NULL, '2022-09-07 06:28:19', '2022-09-07 06:28:19'),
(2, 'Test User', 'test@user.com', NULL, '$2y$10$Lfbxe13nArS7hMCDSrSzqOgByuYSw4oR58VuEZxR3o9LJs2qeIKH2', NULL, '2022-09-19 12:01:29', '2022-09-19 12:01:29');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indizes für die Tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indizes für die Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indizes für die Tabelle `trophies`
--
ALTER TABLE `trophies`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT für Tabelle `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `trophies`
--
ALTER TABLE `trophies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
