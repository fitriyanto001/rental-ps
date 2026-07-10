-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for rental_ps

-- Dumping structure for table rental_ps.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.cache: ~0 rows (approximately)

-- Dumping structure for table rental_ps.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.cache_locks: ~0 rows (approximately)

-- Dumping structure for table rental_ps.consoles
CREATE TABLE IF NOT EXISTS `consoles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('PS4','PS5') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('tersedia','aktif','rusak','offline') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.consoles: ~4 rows (approximately)
INSERT INTO `consoles` (`id`, `name`, `type`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'PS4 - 01', 'PS4', 'tersedia', '2026-06-17 20:53:17', '2026-07-09 04:17:13'),
	(2, 'PS4 - 02', 'PS4', 'tersedia', '2026-06-17 20:53:17', '2026-06-19 09:32:48'),
	(3, 'PS4 - 03', 'PS4', 'tersedia', '2026-06-17 20:53:17', '2026-06-17 20:53:17'),
	(4, 'PS5 - 01', 'PS5', 'tersedia', '2026-06-17 20:53:17', '2026-06-17 20:53:17');

-- Dumping structure for table rental_ps.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table rental_ps.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.jobs: ~0 rows (approximately)

-- Dumping structure for table rental_ps.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.job_batches: ~0 rows (approximately)

-- Dumping structure for table rental_ps.members
CREATE TABLE IF NOT EXISTS `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_percentage` int NOT NULL DEFAULT '10',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.members: ~3 rows (approximately)
INSERT INTO `members` (`id`, `name`, `phone`, `discount_percentage`, `created_at`, `updated_at`) VALUES
	(1, 'Fitriyanto (Pemilik)', '08888888888', 100, '2026-07-09 03:37:53', '2026-07-09 04:36:12'),
	(2, 'Budi Santoso', '081234567891', 15, '2026-07-09 03:37:53', '2026-07-09 03:37:53'),
	(3, 'Firda Handayani', '081234567892', 90, '2026-07-09 03:37:53', '2026-07-09 04:35:43');

-- Dumping structure for table rental_ps.menu_kantin
CREATE TABLE IF NOT EXISTS `menu_kantin` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Tersedia',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.menu_kantin: ~7 rows (approximately)
INSERT INTO `menu_kantin` (`id`, `nama_menu`, `kategori`, `harga`, `stok`, `status`, `created_at`, `updated_at`) VALUES
	(1, '🍜 Indomie Goreng', 'Makanan', 8000, 20, 'Tersedia', '2026-07-09 03:11:50', '2026-07-09 03:11:50'),
	(2, '🍜 Indomie Goreng + Telur', 'Makanan', 10000, 15, 'Tersedia', '2026-07-09 03:11:50', '2026-07-09 04:23:41'),
	(3, '🥤 Es Teh Manis', 'Minuman', 3000, 50, 'Tersedia', '2026-07-09 03:11:50', '2026-07-09 03:11:50'),
	(4, '☕ Kopi Hitam', 'Minuman', 5000, 30, 'Tersedia', '2026-07-09 03:11:50', '2026-07-09 03:11:50'),
	(5, '☕ Kopi Susu', 'Minuman', 6000, 25, 'Tersedia', '2026-07-09 03:11:50', '2026-07-09 03:11:50'),
	(6, '🍟 Kentang Goreng', 'Makanan', 7000, 10, 'Tersedia', '2026-07-09 03:11:50', '2026-07-09 03:11:50'),
	(7, '🥔 Keripik Singkong', 'Makanan', 4000, 0, 'Habis', '2026-07-09 03:11:50', '2026-07-09 03:20:13');

-- Dumping structure for table rental_ps.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.migrations: ~13 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_06_18_032851_create_consoles_table', 1),
	(5, '2026_06_18_033000_create_members_table', 1),
	(6, '2026_06_18_033124_create_rentals_table', 1),
	(7, '2026_06_18_045135_create_transactions_table', 1),
	(8, '2026_07_09_000001_create_menu_kantin_table', 2),
	(9, '2026_07_09_000002_create_transaction_food_table', 2),
	(10, '2026_07_09_000003_add_kantin_fields_to_transactions_table', 2),
	(11, '2026_07_09_000004_add_member_to_transactions_table', 3),
	(12, '2026_07_09_000005_create_shifts_table', 4),
	(13, '2026_07_09_000006_add_shift_to_transactions_table', 4);

-- Dumping structure for table rental_ps.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table rental_ps.rentals
CREATE TABLE IF NOT EXISTS `rentals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `console_id` bigint unsigned NOT NULL,
  `member_id` bigint unsigned DEFAULT NULL,
  `billing_type` enum('paket','open_billing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_hours` int NOT NULL DEFAULT '0',
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL,
  `actual_end_time` datetime DEFAULT NULL,
  `checkout_scenario` enum('A','B') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rental_cost` int NOT NULL DEFAULT '0',
  `status` enum('berjalan','selesai','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'berjalan',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rentals_console_id_foreign` (`console_id`),
  KEY `rentals_member_id_foreign` (`member_id`),
  CONSTRAINT `rentals_console_id_foreign` FOREIGN KEY (`console_id`) REFERENCES `consoles` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `rentals_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.rentals: ~0 rows (approximately)

-- Dumping structure for table rental_ps.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.sessions: ~1 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('QSU67Nqz9cGAeTvNqzJvK7VZlndsynvUW3YUDJtq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI3eWxSYkxDSVNtWWFtNGdLZG5nWjl4dUJBemNackQzUGNHb0dqUGxsIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9kYXNoYm9hcmQiLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9', 1783594582);

-- Dumping structure for table rental_ps.shifts
CREATE TABLE IF NOT EXISTS `shifts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kasir_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_buka` timestamp NOT NULL,
  `jam_tutup` timestamp NULL DEFAULT NULL,
  `status` enum('buka','tutup') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'buka',
  `total_transaksi` int NOT NULL DEFAULT '0',
  `total_rental` bigint NOT NULL DEFAULT '0',
  `total_kantin` bigint NOT NULL DEFAULT '0',
  `total_diskon` bigint NOT NULL DEFAULT '0',
  `grand_total` bigint NOT NULL DEFAULT '0',
  `catatan_handover` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.shifts: ~1 rows (approximately)
INSERT INTO `shifts` (`id`, `kasir_name`, `jam_buka`, `jam_tutup`, `status`, `total_transaksi`, `total_rental`, `total_kantin`, `total_diskon`, `grand_total`, `catatan_handover`, `created_at`, `updated_at`) VALUES
	(1, 'Fitri', '2026-07-09 04:17:58', '2026-07-09 04:33:11', 'tutup', 0, 0, 0, 0, 0, NULL, '2026-07-09 04:17:58', '2026-07-09 04:33:11');

-- Dumping structure for table rental_ps.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `console_id` bigint unsigned NOT NULL,
  `renter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NOT NULL,
  `total_price` int NOT NULL,
  `total_rental` int NOT NULL DEFAULT '0',
  `total_kantin` int NOT NULL DEFAULT '0',
  `diskon` int NOT NULL DEFAULT '0',
  `grand_total` int NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_bayar',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` bigint unsigned DEFAULT NULL,
  `shift_id` bigint unsigned DEFAULT NULL,
  `kasir_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_console_id_foreign` (`console_id`),
  KEY `transactions_member_id_foreign` (`member_id`),
  KEY `transactions_shift_id_foreign` (`shift_id`),
  CONSTRAINT `transactions_console_id_foreign` FOREIGN KEY (`console_id`) REFERENCES `consoles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transactions_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL,
  CONSTRAINT `transactions_shift_id_foreign` FOREIGN KEY (`shift_id`) REFERENCES `shifts` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.transactions: ~25 rows (approximately)
INSERT INTO `transactions` (`id`, `console_id`, `renter_name`, `duration`, `total_price`, `total_rental`, `total_kantin`, `diskon`, `grand_total`, `status`, `created_at`, `updated_at`, `member_id`, `shift_id`, `kasir_name`) VALUES
	(1, 1, 'user1', 4, 25000, 0, 0, 0, 0, 'belum_bayar', '2026-06-17 21:16:21', '2026-06-17 21:16:21', NULL, NULL, NULL),
	(2, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-17 21:20:07', '2026-06-17 21:20:07', NULL, NULL, NULL),
	(3, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-17 21:23:42', '2026-06-17 21:23:42', NULL, NULL, NULL),
	(4, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-17 21:29:03', '2026-06-17 21:29:03', NULL, NULL, NULL),
	(5, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-17 21:46:14', '2026-06-17 21:46:14', NULL, NULL, NULL),
	(6, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-17 21:48:07', '2026-06-17 21:48:07', NULL, NULL, NULL),
	(7, 1, 'user1', 0, 0, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 01:13:57', '2026-06-19 01:13:57', NULL, NULL, NULL),
	(8, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 01:16:36', '2026-06-19 01:16:36', NULL, NULL, NULL),
	(9, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 01:21:38', '2026-06-19 01:21:38', NULL, NULL, NULL),
	(10, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 01:29:04', '2026-06-19 01:29:04', NULL, NULL, NULL),
	(11, 2, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 01:30:30', '2026-06-19 01:30:30', NULL, NULL, NULL),
	(12, 2, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 01:30:31', '2026-06-19 01:30:31', NULL, NULL, NULL),
	(13, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 09:32:59', '2026-06-19 09:32:59', NULL, NULL, NULL),
	(14, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 09:38:04', '2026-06-19 09:38:04', NULL, NULL, NULL),
	(15, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 09:39:54', '2026-06-19 09:39:54', NULL, NULL, NULL),
	(16, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 09:49:02', '2026-06-19 09:49:02', NULL, NULL, NULL),
	(17, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 09:49:46', '2026-06-19 09:49:46', NULL, NULL, NULL),
	(18, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 09:56:50', '2026-06-19 09:56:50', NULL, NULL, NULL),
	(19, 1, 'user1', 1, 8000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 10:01:15', '2026-06-19 10:01:15', NULL, NULL, NULL),
	(20, 1, 'anto', 2, 15000, 0, 0, 0, 0, 'belum_bayar', '2026-06-19 10:20:27', '2026-06-19 10:20:27', NULL, NULL, NULL),
	(21, 1, 'User01', 2, 15000, 0, 0, 0, 0, 'belum_bayar', '2026-07-09 02:56:34', '2026-07-09 02:56:34', NULL, NULL, NULL),
	(22, 1, 'User01', 1, 8000, 8000, 0, 0, 8000, 'lunas', '2026-07-09 02:58:52', '2026-07-09 03:18:07', NULL, NULL, NULL),
	(23, 1, 'User-01', 1, 8000, 8000, 0, 0, 8000, 'lunas', '2026-07-09 03:21:19', '2026-07-09 03:22:42', NULL, NULL, NULL),
	(24, 1, 'Fitriyanto', 1, 17200, 8000, 10000, 800, 17200, 'lunas', '2026-07-09 03:42:42', '2026-07-09 03:43:06', 1, NULL, NULL),
	(25, 1, 'User01', 1, 8000, 8000, 0, 0, 8000, 'lunas', '2026-07-09 04:16:58', '2026-07-09 04:17:13', NULL, NULL, NULL);

-- Dumping structure for table rental_ps.transaction_food
CREATE TABLE IF NOT EXISTS `transaction_food` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaction_id` bigint unsigned NOT NULL,
  `menu_kantin_id` bigint unsigned NOT NULL,
  `qty` int NOT NULL,
  `harga` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_food_transaction_id_foreign` (`transaction_id`),
  KEY `transaction_food_menu_kantin_id_foreign` (`menu_kantin_id`),
  CONSTRAINT `transaction_food_menu_kantin_id_foreign` FOREIGN KEY (`menu_kantin_id`) REFERENCES `menu_kantin` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transaction_food_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.transaction_food: ~1 rows (approximately)
INSERT INTO `transaction_food` (`id`, `transaction_id`, `menu_kantin_id`, `qty`, `harga`, `subtotal`, `created_at`, `updated_at`) VALUES
	(1, 24, 2, 1, 10000, 10000, '2026-07-09 03:43:06', '2026-07-09 03:43:06');

-- Dumping structure for table rental_ps.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table rental_ps.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Fitriyanto', 'admin@ajisps.com', NULL, '$2y$12$ZFhH945kgnX1UgRT1m/QRe0WPQqX9FPfIm37o5GQda4xxLrh7hn5q', 'k6g2QKrZnxU6PX857aAJtRwRoZ5oimBVeTGaZC0nn5O1uO8NAOi1d2lj3iBW', '2026-07-09 04:23:42', '2026-07-09 04:23:42'),
	(2, 'Fitriyanto', 'fitri@yanto.com', NULL, '$2y$12$hObMGn73PWcbyGms.y2fm.5Rhm86mYQcAb5I4thdR2.VbDiRLm.HK', NULL, '2026-07-09 04:29:41', '2026-07-09 04:30:06'),
	(3, 'Dosen Penilai / Tamu', 'tamu@ajisps.com', NULL, '$2y$12$sX/doLZbnwpxC7nRacUMA..HHarL8RRy2W5YqZdBZsU8sYCMv1k9C', NULL, '2026-07-09 04:30:06', '2026-07-09 04:30:06');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;