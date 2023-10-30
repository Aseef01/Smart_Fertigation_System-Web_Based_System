-- Adminer 4.8.1 MySQL 5.7.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) NOT NULL,
  `line_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postcode` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `addresses`;
INSERT INTO `addresses` (`id`, `users_id`, `line_1`, `line_2`, `postcode`, `city`, `state`, `created_at`, `updated_at`) VALUES
(1,	1,	'NO 137, JALAN CHABANG EMPAT MERANTI,',	'KAMPUNG CHABANG EMPAT,',	'16210',	'TUMPAT',	'Terengganu',	NULL,	NULL),
(2,	2,	'NO 137, JALAN CHABANG EMPAT MERANTI,',	'KAMPUNG CHABANG EMPAT,',	'',	'',	'KELANTAN',	NULL,	NULL),
(4,	4,	'',	'',	'',	'',	'',	NULL,	NULL);

DROP TABLE IF EXISTS `data_sensors`;
CREATE TABLE `data_sensors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `devices_id` bigint(20) NOT NULL,
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `data_sensors`;

DROP TABLE IF EXISTS `devices`;
CREATE TABLE `devices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `users_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `devices_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `devices`;
INSERT INTO `devices` (`id`, `users_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3,	1,	'9747654084_device-1',	NULL,	'2023-10-11 13:15:17',	'2023-10-11 13:15:17'),
(4,	2,	'5076665263_device-1',	NULL,	'2023-10-11 13:32:32',	'2023-10-11 13:32:32');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `failed_jobs`;

DROP TABLE IF EXISTS `inputs`;
CREATE TABLE `inputs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `devices_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `inputs`;
INSERT INTO `inputs` (`id`, `devices_id`, `name`, `duration`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3,	3,	'Baja',	0,	1,	NULL,	'2023-10-11 13:16:28',	'2023-10-11 13:16:28'),
(4,	3,	'Baja',	0,	1,	NULL,	'2023-10-11 13:19:07',	'2023-10-11 13:19:07'),
(5,	4,	'Sulam',	0,	0,	NULL,	'2023-10-11 13:33:16',	'2023-10-11 13:33:16');

DROP TABLE IF EXISTS `limit_sensors`;
CREATE TABLE `limit_sensors` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `devices_id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `limit_sensors`;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_reset_tokens_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2023_08_21_164526_create_inputs_table',	1),
(6,	'2023_08_27_132018_create_devices_table',	1),
(7,	'2023_08_27_151457_create_data_sensors_table',	1),
(8,	'2023_09_07_000613_create_limit_sensors_table',	1),
(9,	'2023_09_07_000743_create_schedules_table',	1),
(10,	'2023_10_07_133416_create_addresses_table',	1);

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `password_reset_tokens`;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `personal_access_tokens`;
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1,	'App\\Models\\User',	1,	'authToken',	'1ec1b22946ce83627f1663ec5d549c8a71a6647b97d55be8fdf7f553494cc372',	'[\"*\"]',	NULL,	NULL,	'2023-10-07 16:06:32',	'2023-10-07 16:06:32'),
(2,	'App\\Models\\User',	2,	'authToken',	'784869d61bdc3ac729e0b48d5d87f2d57ce789e2030efcdf52d11c3071b24b54',	'[\"*\"]',	NULL,	NULL,	'2023-10-07 16:06:59',	'2023-10-07 16:06:59'),
(3,	'App\\Models\\User',	1,	'authToken',	'3f909e8e8f392e702fb1f31656b271f111e47827eba1227a35e5307ce6ff17f7',	'[\"*\"]',	NULL,	NULL,	'2023-10-07 16:17:01',	'2023-10-07 16:17:01'),
(4,	'App\\Models\\User',	4,	'authToken',	'de7bc94f04047fa73128488b7fee93b46a63737707442dc9750d2f4e8cb4f2fc',	'[\"*\"]',	NULL,	NULL,	'2023-10-11 14:41:39',	'2023-10-11 14:41:39'),
(5,	'App\\Models\\User',	5,	'authToken',	'88a82ba006c54eec092f38b0824a7aba7a2349391b28e5bdb4e3f1d43fe3227e',	'[\"*\"]',	NULL,	NULL,	'2023-10-13 16:30:26',	'2023-10-13 16:30:26'),
(6,	'App\\Models\\User',	6,	'authToken',	'0815f495191f77f6684dc03a2fdb46d22b4690f68e2298e85f731c707bb13a42',	'[\"*\"]',	NULL,	NULL,	'2023-10-13 16:39:17',	'2023-10-13 16:39:17');

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `devices_id` bigint(20) NOT NULL,
  `inputs_id` bigint(20) NOT NULL,
  `datetime` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` bigint(20) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `schedules`;
INSERT INTO `schedules` (`id`, `devices_id`, `inputs_id`, `datetime`, `duration`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2,	1,	1,	'2023-09-07 19:24',	0,	'Sulam',	0,	'2023-10-07 16:18:19',	'2023-10-07 16:18:19'),
(3,	1,	1,	'2023-09-07 19:24',	0,	'Sulam',	0,	'2023-10-07 16:18:20',	'2023-10-07 16:18:20'),
(6,	3,	3,	'2023-09-07 19:24',	0,	'Sulam',	0,	'2023-10-13 16:40:00',	'2023-10-13 16:40:00'),
(7,	3,	3,	'2023-09-07 19:24',	0,	'Sulam',	0,	'2023-10-13 16:40:02',	'2023-10-13 16:40:02');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `apikey` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `user_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png',
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `duration` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_apikey_unique` (`apikey`),
  UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

TRUNCATE `users`;
INSERT INTO `users` (`id`, `apikey`, `title`, `full_name`, `username`, `roles`, `user_image`, `phone_number`, `gender`, `age`, `location`, `status`, `duration`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'9747654084',	'Mr.',	'Muhammad Syamil Bin Zainal Abidin',	NULL,	'user',	'user.png',	'0199896697',	NULL,	NULL,	'NO 137, JALAN CHABANG EMPAT MERANTI, KAMPUNG CHABANG EMPAT, 16210 TUMPAT Terengganu',	'active',	NULL,	'muhammadsyamil123@gmail.com',	NULL,	'$2y$10$Sa9ptLn3ctiCsGlr.X8k4.FphtRl/YZ9LXoTENarP.09bNyq8d88e',	NULL,	'2023-10-07 16:06:32',	'2023-10-07 16:06:32'),
(2,	'5076665263',	'Mr.',	'Ahmad Aseef Bin Zainal Abidin',	NULL,	'user',	'user.png',	'01165157010',	NULL,	NULL,	'NO 137, JALAN CHABANG EMPAT MERANTI, KAMPUNG CHABANG EMPAT,   KELANTAN',	'active',	NULL,	'ahmadaseef05@gmail.com',	NULL,	'$2y$10$C8g112hx/wjXKuetyKLAIO3SOoaujYZ7KtJHiNYz5aTK3RGLRHbue',	NULL,	'2023-10-07 16:06:59',	'2023-10-07 16:06:59'),
(4,	'2819368645',	'Ms.',	'Ahmad Aseef Bin Zainal Abidin',	NULL,	'admin',	'user.png',	'0199896692',	NULL,	NULL,	'    ',	'active',	NULL,	'ahmadaseef02@gmail.com',	NULL,	'$2y$10$Yg0pmFVscSzt1.aI8M7.H.AbkTIx3Iiae2oLLWErf2mhG/rrcLcsm',	NULL,	'2023-10-11 14:41:39',	'2023-10-11 14:41:39');

-- 2023-10-14 13:46:28
