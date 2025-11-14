-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_sekolah
CREATE DATABASE IF NOT EXISTS `db_sekolah` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `db_sekolah`;

-- Dumping structure for table db_sekolah.tb_sekolah
CREATE TABLE IF NOT EXISTS `tb_siswa_siswi` (
  `id_siswa` int(11) NOT NULL AUTO_INCREMENT,
  `nisn` char(12) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama_siswa` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `jurusan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_wali` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status_pelajar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_siswa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sekolah.tb_sekolah: ~0 rows (approximately)

-- Dumping structure for table db_sekolah.tb_jurusan
CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `kode_jurusan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jurusan` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_simplecrud.tb_prodi: ~9 rows (approximately)
INSERT INTO `tb_jurusan` (`kode_jurusan`, `nama_jurusan`) VALUES
	('IPA', 'Ilmu Pengetahuan Alam'),
  	('IPS', 'Ilmu Pengetahuan Sosial'),
     ('BHS', 'Bahasa');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
