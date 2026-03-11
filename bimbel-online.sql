/*
SQLyog Enterprise
MySQL - 8.0.30 : Database - bimbel-online
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bimbel-online` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `bimbel-online`;

/*Table structure for table `hasil_belajar` */

CREATE TABLE `hasil_belajar` (
  `hasil_id` int unsigned NOT NULL AUTO_INCREMENT,
  `siswa_id` int unsigned NOT NULL,
  `pengajar_id` int unsigned NOT NULL,
  `program_id` int unsigned NOT NULL,
  `mata_pelajaran` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `tanggal` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`hasil_id`),
  KEY `hasil_belajar_siswa_id_foreign` (`siswa_id`),
  KEY `hasil_belajar_pengajar_id_foreign` (`pengajar_id`),
  KEY `hasil_belajar_program_id_foreign` (`program_id`),
  CONSTRAINT `hasil_belajar_pengajar_id_foreign` FOREIGN KEY (`pengajar_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_belajar_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program_bimbel` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `hasil_belajar_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `hasil_belajar` */

/*Table structure for table `jadwal` */

CREATE TABLE `jadwal` (
  `jadwal_id` int unsigned NOT NULL AUTO_INCREMENT,
  `hari` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam_mulai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam_selesai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`jadwal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal` */

/*Table structure for table `kelas_bimbel` */

CREATE TABLE `kelas_bimbel` (
  `kelas_id` int unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int unsigned NOT NULL,
  `jadwal_id` int unsigned NOT NULL,
  `pengajar_id` int unsigned NOT NULL,
  `kuota` tinyint unsigned NOT NULL DEFAULT '5',
  `terisi` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kelas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kelas_bimbel` */

/*Table structure for table `migrations` */

CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`version`,`class`,`group`,`namespace`,`time`,`batch`) values 
(1,'2025-04-24-114555','App\\Database\\Migrations\\CreateUserTable','default','App',1755917432,1),
(2,'2025-04-24-114635','App\\Database\\Migrations\\CreateProgramBimbelTable','default','App',1755917432,1),
(3,'2025-04-24-114722','App\\Database\\Migrations\\CreateJadwalTable','default','App',1755917432,1),
(4,'2025-04-24-114752','App\\Database\\Migrations\\CreateNoRekeningTable','default','App',1755917432,1),
(5,'2025-04-24-114825','App\\Database\\Migrations\\CreateSiswaDiterimaPtnTable','default','App',1755917432,1),
(6,'2025-04-24-114846','App\\Database\\Migrations\\CreateTransaksiTable','default','App',1755917432,1),
(7,'2025-04-29-012114','App\\Database\\Migrations\\CreatePasswordResetTable','default','App',1755917432,1),
(8,'2026-03-10-000001','App\\Database\\Migrations\\CreateHasilBelajarTable','default','App',1773158508,2),
(9,'2026-03-11-000001','App\\Database\\Migrations\\AlterUserAddTingkat','default','App',1773200685,3),
(10,'2026-03-11-000002','App\\Database\\Migrations\\CreateKelasBimbelTable','default','App',1773200685,3),
(11,'2026-03-11-000003','App\\Database\\Migrations\\AlterTransaksiAddKelasJadwal','default','App',1773200685,3),
(12,'2026-03-11-000004','App\\Database\\Migrations\\AlterUserAddJabatan','default','App',1773202378,4);

/*Table structure for table `no_rekening` */

CREATE TABLE `no_rekening` (
  `rekening_id` int unsigned NOT NULL AUTO_INCREMENT,
  `bank` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `no_rek` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`rekening_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `no_rekening` */

insert  into `no_rekening`(`rekening_id`,`bank`,`no_rek`,`nama`,`created_at`,`updated_at`) values 
(1,'Bank BCA','1234567890','Bimbel Cerdas Mandiri',NULL,NULL),
(2,'Bank Mandiri','9876543210','Bimbel Cerdas Mandiri',NULL,NULL),
(3,'Bank BRI','5555666677','Bimbel Cerdas Mandiri',NULL,NULL),
(4,'Bank BNI','1111222233','Bimbel Cerdas Mandiri',NULL,NULL),
(5,'Bank BSI','7777888899','Bimbel Cerdas Mandiri',NULL,NULL);

/*Table structure for table `password_resets` */

CREATE TABLE `password_resets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `password_resets` */

insert  into `password_resets`(`id`,`email`,`token`,`created_at`,`expired_at`) values 
(1,'abit@gmail.com','1f7ef4a2358f71fa7378f5f1d26b1b722ae2b2732f993d2ea1cb6ab26c71c993','2025-09-15 05:46:02','2025-09-15 06:46:02');

/*Table structure for table `program_bimbel` */

CREATE TABLE `program_bimbel` (
  `program_id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `durasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tingkat` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kelas` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `program_bimbel` */

insert  into `program_bimbel`(`program_id`,`nama_program`,`durasi`,`tingkat`,`kelas`,`harga`,`keterangan`,`created_at`,`updated_at`) values 
(1,'Matematika Dasar SD','2 jam/pertemuan','SD','1-6',150000.00,'Program bimbingan belajar matematika untuk siswa SD kelas 1-6',NULL,NULL),
(2,'Bahasa Indonesia SD','1.5 jam/pertemuan','SD','1-6',120000.00,'Program bimbingan belajar bahasa Indonesia untuk siswa SD',NULL,NULL),
(3,'IPA Terpadu SD','2 jam/pertemuan','SD','4-6',140000.00,'Program bimbingan belajar IPA untuk siswa SD kelas 4-6',NULL,NULL),
(4,'Matematika SMP','2.5 jam/pertemuan','SMP','7-9',200000.00,'Program bimbingan belajar matematika untuk siswa SMP',NULL,NULL),
(5,'IPA SMP','2.5 jam/pertemuan','SMP','7-9',190000.00,'Program bimbingan belajar IPA untuk siswa SMP (Fisika, Kimia, Biologi)',NULL,NULL),
(6,'Bahasa Inggris SMP','2 jam/pertemuan','SMP','7-9',170000.00,'Program bimbingan belajar bahasa Inggris untuk siswa SMP',NULL,NULL),
(7,'Matematika SMA IPA','3 jam/pertemuan','SMA','10-12',250000.00,'Program bimbingan belajar matematika untuk siswa SMA jurusan IPA',NULL,NULL),
(8,'Fisika SMA','2.5 jam/pertemuan','SMA','10-12',230000.00,'Program bimbingan belajar fisika untuk siswa SMA',NULL,NULL),
(9,'Kimia SMA','2.5 jam/pertemuan','SMA','10-12',230000.00,'Program bimbingan belajar kimia untuk siswa SMA',NULL,NULL),
(10,'Persiapan UTBK','4 jam/pertemuan','SMA','12',350000.00,'Program intensif persiapan UTBK untuk masuk PTN',NULL,NULL);

/*Table structure for table `siswa_diterima_ptn` */

CREATE TABLE `siswa_diterima_ptn` (
  `siswa_id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prodi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_kampus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_diterima` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`siswa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `siswa_diterima_ptn` */

insert  into `siswa_diterima_ptn`(`siswa_id`,`nama_siswa`,`prodi`,`nama_kampus`,`tahun_diterima`,`photo`,`created_at`,`updated_at`) values 
(1,'Andi Prasetyo','Teknik Informatika','Institut Teknologi Bandung','2023',NULL,NULL,NULL),
(2,'Maya Sari','Kedokteran','Universitas Gadjah Mada','2023',NULL,NULL,NULL),
(3,'Rizky Firmansyah','Teknik Elektro','Institut Teknologi Sepuluh Nopember','2023',NULL,NULL,NULL),
(4,'Putri Indah','Farmasi','Universitas Indonesia','2022',NULL,NULL,NULL),
(5,'Dani Ramadhan','Teknik Mesin','Institut Teknologi Bandung','2022',NULL,NULL,NULL),
(6,'Sari Melati','Psikologi','Universitas Padjadjaran','2022',NULL,NULL,NULL),
(7,'Bima Sakti','Hukum','Universitas Indonesia','2024',NULL,NULL,NULL),
(8,'Lestari Wulandari','Akuntansi','Universitas Gadjah Mada','2024',NULL,NULL,NULL),
(9,'Fajar Nugroho','Teknik Sipil','Institut Teknologi Sepuluh Nopember','2024',NULL,NULL,NULL),
(10,'Indira Sari','Ilmu Komunikasi','Universitas Padjadjaran','2021',NULL,NULL,NULL);

/*Table structure for table `transaksi` */

CREATE TABLE `transaksi` (
  `transaksi_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `program_id` int unsigned NOT NULL,
  `jadwal_id` int unsigned DEFAULT NULL,
  `kelas_id` int unsigned DEFAULT NULL,
  `pengajar_id` int unsigned DEFAULT NULL,
  `tagihan` decimal(10,2) NOT NULL,
  `photo_bukti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('pending','lunas','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`),
  KEY `transaksi_user_id_foreign` (`user_id`),
  KEY `transaksi_program_id_foreign` (`program_id`),
  CONSTRAINT `transaksi_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program_bimbel` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaksi` */

/*Table structure for table `user` */

CREATE TABLE `user` (
  `user_id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tingkat` enum('SD','SMP','SMA') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` enum('SD','SMP','SMA') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`nama`,`nomor_hp`,`email`,`role`,`tingkat`,`jabatan`,`password`,`photo`,`created_at`,`updated_at`) values 
(1,'Administrator','081234567890','admin@gmail.com','admin',NULL,NULL,'$2y$10$XsOCcWRYNPFE39eLTV6y7Ok8L2GHcUzh1bbWAREYCdFWHo21zv9o6',NULL,NULL,NULL),
(2,'Andi Setiawan','081234567891','siswa@gmail.com','siswa','SD',NULL,'$2y$10$1x.pjnYTTgZS.qicXFhAi.t1KaEVFvggkhHuoFCcQrHq9WGE0TPdy',NULL,NULL,NULL),
(3,'Budi Santoso','081234567892','budi@gmail.com','siswa','SMP',NULL,'$2y$10$HqoBZ2pTxsCquainhrui6uAu.tbHxyulDqdeIi3/zizdd99nO4uAS',NULL,NULL,NULL),
(4,'Siti Aminah','081234567893','siti@gmail.com','siswa','SMA',NULL,'$2y$10$MU5NA5P7jI726hk1uu500ewf9FY/Q3jwIM94HoyR65mbqrEMucz4e',NULL,NULL,NULL),
(5,'Ahmad Rahman','081234567894','ahmad@gmail.com','pengajar',NULL,'SD','$2y$10$AfrdVdpxHE6Z9S1Haon7yeJF0fbopd4isSLc8TkTeuGb3xKNejBKK',NULL,NULL,NULL),
(6,'Dewi Sartika','081234567895','dewi@gmail.com','pengajar',NULL,'SMP','$2y$10$P7W4bdWoYyfFeSjmkV0.cuVuuSz2ZbpjIOkyQPVL.Kt6G0TF.N6jy',NULL,NULL,NULL),
(7,'Rini Pratiwi','081234567896','rini@gmail.com','pengajar',NULL,'SMA','$2y$10$GS027MIMdAi2/avOcjVpfOUQKmDyPYh92XKFPg4mUYGJOPL9ouGa6',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
