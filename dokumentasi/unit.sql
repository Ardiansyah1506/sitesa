-- --------------------------------------------------------
-- Host:                         psidevel.dinus.ac.id
-- Server version:               5.6.51 - MySQL Community Server (GPL)
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


-- Dumping database structure for ami
CREATE DATABASE IF NOT EXISTS `ami` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ami`;

-- Dumping structure for table ami.m_unit
CREATE TABLE IF NOT EXISTS `m_unit` (
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(45) NOT NULL,
  `idStrata` int(11) NOT NULL DEFAULT '0' COMMENT '0: tidak ada strata, kaya upt',
  `fakultas` varchar(45) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `idAuditee` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8;

-- Dumping data for table ami.m_unit: ~63 rows (approximately)
INSERT INTO `m_unit` (`created_at`, `updated_at`, `deleted_at`, `id`, `kode`, `idStrata`, `fakultas`, `nama`, `idAuditee`) VALUES
	('2024-07-02 20:21:32', NULL, NULL, 41, 'A11', 3, 'Ilmu Komputer', 'Teknik Informatika - S1', '3'),
	('2024-07-22 08:39:25', NULL, NULL, 72, 'A11', 3, 'Ilmu Komputer', 'Teknik Informatika - S1', '103,104'),
	('2024-07-22 08:39:25', NULL, NULL, 73, 'A12', 3, 'Ilmu Komputer', 'Sistem Informasi - S1', '105,106'),
	('2024-07-22 08:39:25', NULL, NULL, 74, 'A14', 3, 'Ilmu Komputer', 'Desain Komunikasi Visual - S1', '107,108'),
	('2024-07-22 08:39:25', NULL, NULL, 75, 'A22', 1, 'Ilmu Komputer', 'Teknik Informatika - D3', '109'),
	('2024-07-22 08:39:25', NULL, NULL, 76, 'B12', 3, 'Ekonomi & Bisnis', 'Akuntansi - S1', '110,111'),
	('2024-07-22 08:39:25', NULL, NULL, 77, 'C11', 3, 'Ilmu Budaya', 'Bahasa Inggris - S1', '112,113'),
	('2024-07-22 08:39:25', NULL, NULL, 78, 'C12', 3, 'Ilmu Budaya', 'Sastra Jepang - S1', '114,115'),
	('2024-07-22 08:39:25', NULL, NULL, 79, 'D11', 3, 'Kesehatan', 'Kesehatan Masyarakat - S1', '116,117'),
	('2024-07-22 08:39:25', NULL, NULL, 80, 'D22', 1, 'Kesehatan', 'Rekam Medik & Info. Kes. - D3', '118,119'),
	('2024-07-22 08:39:25', NULL, NULL, 81, 'E11', 3, 'Teknik', 'Teknik Elektro - S1', '120,121'),
	('2024-07-22 08:39:26', NULL, NULL, 82, 'E12', 3, 'Teknik', 'Teknik Industri - S1', '122,123'),
	('2024-07-22 08:39:26', NULL, NULL, 83, 'A24', 1, 'Ilmu Komputer', 'Broadcasting - D3', '124'),
	('2024-07-22 08:39:26', NULL, NULL, 84, 'P31', 4, 'Ilmu Komputer', 'Magister Teknik Informatika - S2', '125'),
	('2024-07-22 08:39:26', NULL, NULL, 85, 'P32', 4, 'Ekonomi & Bisnis', 'Magister Manajemen - S2', '126'),
	('2024-07-22 08:39:26', NULL, NULL, 86, 'B11', 3, 'Ekonomi & Bisnis', 'Manajemen - S1', '127,128'),
	('2024-07-22 08:39:26', NULL, NULL, 87, 'A16', 2, 'Ilmu Komputer', 'Film dan Televisi - SST', '129'),
	('2024-07-22 08:39:26', NULL, NULL, 88, 'A17', 2, 'Ilmu Komputer', 'Animasi - SST', '130'),
	('2024-07-22 08:39:26', NULL, NULL, 89, 'C13', 2, 'Ilmu Budaya', 'Pengelolaan Perhotelan - S.Tr.', '131'),
	('2024-07-22 08:39:26', NULL, NULL, 90, 'D12', 3, 'Kesehatan', 'Kesehatan Lingkungan - S1', '132,133'),
	('2024-07-22 08:39:26', NULL, NULL, 91, 'E13', 3, 'Teknik', 'Teknik Biomedis - S1', '134,135'),
	('2024-07-22 08:39:26', NULL, NULL, 92, 'A15', 3, 'Ilmu Komputer', 'Ilmu Komunikasi - S1', '136,137'),
	('2024-07-22 08:39:26', NULL, NULL, 93, 'P41', 5, 'Ilmu Komputer', 'Program Doktor Ilmu Komputer - S3', '138'),
	('2024-07-22 08:39:26', NULL, NULL, 94, 'F11', 3, 'Ilmu Komputer', 'Teknik Informatika Kampus Kediri - S1', '139,140'),
	('2024-07-22 08:39:26', NULL, NULL, 95, 'F12', 3, 'Ilmu Komputer', 'Sistem Informasi Kampus Kediri - S1', '141'),
	('2024-07-22 08:39:26', NULL, NULL, 96, 'F13', 3, 'Ekonomi & Bisnis', 'Manajemen Kampus Kediri - S1', '142'),
	('2024-07-22 08:39:26', NULL, NULL, 97, 'F14', 3, 'Ilmu Komputer', 'Desain Komunikasi Visual Kampus Kediri - S1', '143'),
	('2024-07-22 08:39:27', NULL, NULL, 98, 'A18', 3, 'Ilmu Komputer', 'PJJ Informatika - S1', '144,144'),
	('2024-07-22 08:39:27', NULL, NULL, 99, 'P42', 5, 'Ekonomi & Bisnis', 'Program Doktor Manajemen - S3', '145'),
	('2024-07-22 08:39:27', NULL, NULL, 100, 'K11', 3, 'Kedokteran', 'Kedokteran - S1', '146,140'),
	('2024-07-22 08:39:27', NULL, NULL, 101, 'P33', 4, 'Ekonomi & Bisnis', 'Magister Akuntansi - S2', '147,140'),
	('2024-07-22 08:39:27', NULL, NULL, 102, 'P34', 4, 'Kesehatan', 'Magister Kesehatan Masyarakat - S2', '148'),
	('2024-07-23 01:43:44', NULL, NULL, 103, 'A11', 3, 'Ilmu Komputer', 'Teknik Informatika - S1', '103,104'),
	('2024-07-23 01:43:44', NULL, NULL, 104, 'A12', 3, 'Ilmu Komputer', 'Sistem Informasi - S1', '105,106'),
	('2024-07-23 01:43:45', NULL, NULL, 105, 'A14', 3, 'Ilmu Komputer', 'Desain Komunikasi Visual - S1', '107,108'),
	('2024-07-23 01:43:45', NULL, NULL, 106, 'A22', 1, 'Ilmu Komputer', 'Teknik Informatika - D3', '109'),
	('2024-07-23 01:43:46', NULL, NULL, 107, 'B12', 3, 'Ekonomi & Bisnis', 'Akuntansi - S1', '110,111'),
	('2024-07-23 01:43:47', NULL, NULL, 108, 'C11', 3, 'Ilmu Budaya', 'Bahasa Inggris - S1', '112,113'),
	('2024-07-23 01:43:47', NULL, NULL, 109, 'C12', 3, 'Ilmu Budaya', 'Sastra Jepang - S1', '114,115'),
	('2024-07-23 01:43:48', NULL, NULL, 110, 'D11', 3, 'Kesehatan', 'Kesehatan Masyarakat - S1', '116,117'),
	('2024-07-23 01:43:48', NULL, NULL, 111, 'D22', 1, 'Kesehatan', 'Rekam Medik & Info. Kes. - D3', '118,119'),
	('2024-07-23 01:43:49', NULL, NULL, 112, 'E11', 3, 'Teknik', 'Teknik Elektro - S1', '120,121'),
	('2024-07-23 01:43:49', NULL, NULL, 113, 'E12', 3, 'Teknik', 'Teknik Industri - S1', '122,123'),
	('2024-07-23 01:43:49', NULL, NULL, 114, 'A24', 1, 'Ilmu Komputer', 'Broadcasting - D3', '124'),
	('2024-07-23 01:43:50', NULL, NULL, 115, 'P31', 4, 'Ilmu Komputer', 'Magister Teknik Informatika - S2', '125'),
	('2024-07-23 01:43:50', NULL, NULL, 116, 'P32', 4, 'Ekonomi & Bisnis', 'Magister Manajemen - S2', '126'),
	('2024-07-23 01:43:50', NULL, NULL, 117, 'B11', 3, 'Ekonomi & Bisnis', 'Manajemen - S1', '127,128'),
	('2024-07-23 01:43:51', NULL, NULL, 118, 'A16', 2, 'Ilmu Komputer', 'Film dan Televisi - SST', '129'),
	('2024-07-23 01:43:51', NULL, NULL, 119, 'A17', 2, 'Ilmu Komputer', 'Animasi - SST', '130'),
	('2024-07-23 01:43:51', NULL, NULL, 120, 'C13', 2, 'Ilmu Budaya', 'Pengelolaan Perhotelan - S.Tr.', '131'),
	('2024-07-23 01:43:52', NULL, NULL, 121, 'D12', 3, 'Kesehatan', 'Kesehatan Lingkungan - S1', '132,133'),
	('2024-07-23 01:43:52', NULL, NULL, 122, 'E13', 3, 'Teknik', 'Teknik Biomedis - S1', '134,135'),
	('2024-07-23 01:43:53', NULL, NULL, 123, 'A15', 3, 'Ilmu Komputer', 'Ilmu Komunikasi - S1', '136,137'),
	('2024-07-23 01:43:53', NULL, NULL, 124, 'P41', 5, 'Ilmu Komputer', 'Program Doktor Ilmu Komputer - S3', '138'),
	('2024-07-23 01:43:53', NULL, NULL, 125, 'F11', 3, 'Ilmu Komputer', 'Teknik Informatika Kampus Kediri - S1', '139,140'),
	('2024-07-23 01:43:54', NULL, NULL, 126, 'F12', 3, 'Ilmu Komputer', 'Sistem Informasi Kampus Kediri - S1', '141'),
	('2024-07-23 01:43:54', NULL, NULL, 127, 'F13', 3, 'Ekonomi & Bisnis', 'Manajemen Kampus Kediri - S1', '142'),
	('2024-07-23 01:43:54', NULL, NULL, 128, 'F14', 3, 'Ilmu Komputer', 'Desain Komunikasi Visual Kampus Kediri - S1', '143'),
	('2024-07-23 01:43:55', NULL, NULL, 129, 'A18', 3, 'Ilmu Komputer', 'PJJ Informatika - S1', '144,144'),
	('2024-07-23 01:43:55', NULL, NULL, 130, 'P42', 5, 'Ekonomi & Bisnis', 'Program Doktor Manajemen - S3', '145'),
	('2024-07-23 01:43:55', NULL, NULL, 131, 'K11', 3, 'Kedokteran', 'Kedokteran - S1', '146,140'),
	('2024-07-23 01:43:56', NULL, NULL, 132, 'P33', 4, 'Ekonomi & Bisnis', 'Magister Akuntansi - S2', '147,140'),
	('2024-07-23 01:43:56', NULL, NULL, 133, 'P34', 4, 'Kesehatan', 'Magister Kesehatan Masyarakat - S2', '148');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
