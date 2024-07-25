-- --------------------------------------------------------
-- Host:                         iix400.cloudhost.id
-- Server version:               10.5.25-MariaDB-cll-lve-log - MariaDB Server
-- Server OS:                    Linux
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


-- Dumping database structure for fzcbbghb_db_bimbingan
CREATE DATABASE IF NOT EXISTS `fzcbbghb_db_bimbingan` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci */;
USE `fzcbbghb_db_bimbingan`;

-- Dumping structure for table fzcbbghb_db_bimbingan.berita_acara
CREATE TABLE IF NOT EXISTS `berita_acara` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `gelombang` int(11) NOT NULL,
  `tanggal_awal` varchar(255) NOT NULL,
  `tanggal_akhir` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.berita_acara: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.cache: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.cache_locks: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_prodi` varchar(255) NOT NULL,
  `nidn` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` bigint(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.dosen: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.jobs: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.job_batches: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` bigint(20) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.mahasiswa: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.mhs_bimbingan_ta
CREATE TABLE IF NOT EXISTS `mhs_bimbingan_ta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` char(1) NOT NULL,
  `ta_1` int(11) NOT NULL DEFAULT 0,
  `ta_2` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `no_hp` bigint(20) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama_pembimbing` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.mhs_bimbingan_ta: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.migrations: ~16 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_07_24_163128_mahasiswa', 1),
	(5, '2024_07_24_164339_dosen', 1),
	(6, '2024_07_24_164711_ref_prodi', 1),
	(7, '2024_07_24_165530_ref_kuota', 1),
	(8, '2024_07_24_165559_ref_fakultas', 1),
	(9, '2024_07_24_165622_tesis', 1),
	(10, '2024_07_24_165646_ref_pembayaran', 1),
	(11, '2024_07_24_165740_ref_sks', 1),
	(12, '2024_07_24_165803_berita_acara', 1),
	(13, '2024_07_24_165850_mhs_bimbingan_ta', 1),
	(14, '2024_07_24_170106_ref_bab', 1),
	(15, '2024_07_24_170150_ref_kategori_bab', 1),
	(16, '2024_07_24_170215_ta', 1),
	(17, '2024_07_24_182558_penelitian', 1);

-- Dumping structure for table fzcbbghb_db_bimbingan.ref_bab
CREATE TABLE IF NOT EXISTS `ref_bab` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `id_kategori` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ref_bab: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.ref_fakultas
CREATE TABLE IF NOT EXISTS `ref_fakultas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_fak` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ref_fakultas: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.ref_kategori_bab
CREATE TABLE IF NOT EXISTS `ref_kategori_bab` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ref_kategori_bab: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.ref_kuota
CREATE TABLE IF NOT EXISTS `ref_kuota` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nip` varchar(255) NOT NULL,
  `sisa_kuota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ref_kuota: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.ref_pembayaran
CREATE TABLE IF NOT EXISTS `ref_pembayaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ref_pembayaran: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.ref_prodi
CREATE TABLE IF NOT EXISTS `ref_prodi` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_prodi` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kode_fak` char(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ref_prodi: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.ref_sks
CREATE TABLE IF NOT EXISTS `ref_sks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) NOT NULL,
  `total_sks` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ref_sks: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.sessions: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.ta
CREATE TABLE IF NOT EXISTS `ta` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_ta` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `nota_pembimbing` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.ta: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.tesis
CREATE TABLE IF NOT EXISTS `tesis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `abstrak` varchar(255) NOT NULL,
  `translate` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.tesis: ~0 rows (approximately)

-- Dumping structure for table fzcbbghb_db_bimbingan.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nim` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table fzcbbghb_db_bimbingan.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
