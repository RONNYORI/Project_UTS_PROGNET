/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - db_sekolah
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_sekolah` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_sekolah`;

/*Table structure for table `tb_jurusan` */

DROP TABLE IF EXISTS `tb_jurusan`;

CREATE TABLE `tb_jurusan` (
  `kode_jurusan` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jurusan` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`kode_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_jurusan` */

insert  into `tb_jurusan`(`kode_jurusan`,`nama_jurusan`) values 
('BHS','Bahasa Inggris'),
('IPA','Ilmu Pengetahuan Alam'),
('IPS','Ilmu Pengetahuan Sosial'),
('TKJ','Teknik Komputer & Jaringan'),
('YPG','Yapping');

/*Table structure for table `tb_siswa_siswi` */

DROP TABLE IF EXISTS `tb_siswa_siswi`;

CREATE TABLE `tb_siswa_siswi` (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `nisn` char(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nama_siswa` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `jurusan` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_wali` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status_pelajar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_siswa`),
  UNIQUE KEY `unique_nisn` (`nisn`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_siswa_siswi` */

insert  into `tb_siswa_siswi`(`id_siswa`,`nisn`,`nama_siswa`,`jurusan`,`alamat`,`email`,`telp_wali`,`status_pelajar`) values 
(12,'245920140054','Ni Putu Devina Laura Aoki','TKJ','Tukad Badung ','nomisma83@gmail.com','0898989898',1),
(17,'123346545534','Arya','YPG','waresrdthsc','adobefinance090@gmail.com','123456543',4);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
