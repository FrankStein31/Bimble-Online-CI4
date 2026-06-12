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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `hasil_belajar` */

insert  into `hasil_belajar`(`hasil_id`,`siswa_id`,`pengajar_id`,`program_id`,`mata_pelajaran`,`nilai`,`catatan`,`tanggal`,`created_at`,`updated_at`) values 
(2,8,7,10,'Matematika',95.00,'pelajari lagi','2026-03-11','2026-03-11 14:06:44','2026-03-11 14:06:44'),
(3,4,7,10,'Matematika',50.00,'belajar','2026-03-11','2026-03-11 14:08:23','2026-03-11 14:08:23'),
(4,2,5,2,'indo',80.00,'sip','2026-03-11','2026-03-11 14:35:44','2026-03-11 14:35:44'),
(5,2,10,1,'Matematika Dasar SD',89.00,'bagus bgt','2026-06-06','2026-06-06 08:17:35','2026-06-06 08:22:52'),
(6,2,5,2,'Bahasa Indonesia SD',100.00,'ok','2026-06-06','2026-06-06 08:18:29','2026-06-06 08:18:29');

/*Table structure for table `jadwal` */

CREATE TABLE `jadwal` (
  `jadwal_id` int unsigned NOT NULL AUTO_INCREMENT,
  `hari` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam_mulai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jam_selesai` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`jadwal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `jadwal` */

insert  into `jadwal`(`jadwal_id`,`hari`,`jam_mulai`,`jam_selesai`,`created_at`,`updated_at`) values 
(47,'Senin','08:00','10:00',NULL,NULL),
(48,'Senin','10:30','12:30',NULL,NULL),
(49,'Senin','14:00','16:00',NULL,NULL),
(50,'Selasa','08:00','10:00',NULL,NULL),
(51,'Selasa','10:30','12:30',NULL,NULL),
(52,'Selasa','14:00','16:00',NULL,NULL),
(53,'Rabu','08:00','10:00',NULL,NULL),
(54,'Rabu','10:30','12:30',NULL,NULL),
(55,'Kamis','08:00','10:00',NULL,NULL),
(56,'Kamis','14:00','16:00',NULL,NULL),
(57,'Jumat','08:00','10:00',NULL,NULL),
(58,'Jumat','14:00','16:00',NULL,NULL),
(59,'Sabtu','08:00','10:00',NULL,NULL),
(60,'Sabtu','10:30','12:30',NULL,NULL),
(61,'Sabtu','14:00','16:00',NULL,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `kelas_bimbel` */

insert  into `kelas_bimbel`(`kelas_id`,`program_id`,`jadwal_id`,`pengajar_id`,`kuota`,`terisi`,`created_at`,`updated_at`) values 
(4,10,48,7,5,2,'2026-03-11 08:09:51','2026-03-11 08:29:37'),
(5,2,47,5,5,1,'2026-03-11 14:11:41','2026-03-11 14:11:41'),
(6,9,52,7,5,1,'2026-03-12 04:06:57','2026-03-12 04:06:57'),
(7,5,50,6,5,1,'2026-03-12 04:13:25','2026-03-12 04:13:25'),
(8,6,51,6,5,1,'2026-03-12 04:14:35','2026-03-12 04:14:35'),
(9,8,49,7,5,2,'2026-05-20 02:00:07','2026-06-06 14:27:01'),
(10,1,47,10,5,1,'2026-05-20 04:05:11','2026-06-06 07:56:34'),
(11,7,49,7,5,1,'2026-06-06 14:25:39','2026-06-06 14:25:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(12,'2026-03-11-000004','App\\Database\\Migrations\\AlterUserAddJabatan','default','App',1773202378,4),
(13,'2026-03-11-000005','App\\Database\\Migrations\\CreateProgramJadwalTable','default','App',1773210365,5),
(14,'2026-03-12-000001','App\\Database\\Migrations\\AlterTransaksiAddMidtrans','default','App',1773286572,6);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10,'Persiapan UTBK','2 jam/pertemuan','SMA','12',350000.00,'Program intensif persiapan UTBK untuk masuk PTN',NULL,NULL),
(33,'coba','1','SMA','10',730000.00,'cobaaaaaa','2026-04-29 08:54:11','2026-04-29 08:54:11');

/*Table structure for table `program_jadwal` */

CREATE TABLE `program_jadwal` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int unsigned NOT NULL,
  `jadwal_id` int unsigned NOT NULL,
  `urutan` tinyint NOT NULL DEFAULT '1' COMMENT '1=Pertemuan ke-1, 2=ke-2, 3=ke-3 dalam seminggu',
  PRIMARY KEY (`id`),
  KEY `program_jadwal_jadwal_id_foreign` (`jadwal_id`),
  KEY `program_id_jadwal_id` (`program_id`,`jadwal_id`),
  CONSTRAINT `program_jadwal_jadwal_id_foreign` FOREIGN KEY (`jadwal_id`) REFERENCES `jadwal` (`jadwal_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `program_jadwal_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program_bimbel` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `program_jadwal` */

insert  into `program_jadwal`(`id`,`program_id`,`jadwal_id`,`urutan`) values 
(1,1,47,1),
(2,1,53,2),
(3,1,57,3),
(4,2,47,1),
(5,2,53,2),
(6,2,57,3),
(7,3,48,1),
(8,3,54,2),
(9,3,57,3),
(10,4,50,1),
(11,4,55,2),
(12,4,59,3),
(13,5,50,1),
(14,5,55,2),
(15,5,60,3),
(16,6,51,1),
(17,6,56,2),
(18,6,60,3),
(19,7,49,1),
(20,7,52,2),
(21,7,61,3),
(22,8,49,1),
(23,8,58,2),
(24,8,61,3),
(25,9,52,1),
(26,9,58,2),
(27,9,61,3),
(28,10,48,1),
(29,10,51,2),
(30,10,61,3),
(34,33,61,1),
(35,33,58,2),
(36,33,56,3);

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
(7,'Bima Sakti','Hukum','Universitas Indonesia','2024','siswa_1780729546.jpeg',NULL,'2026-06-06 07:05:46'),
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
  `midtrans_order_id` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `metode_bayar` enum('manual','midtrans') COLLATE utf8mb4_general_ci DEFAULT 'manual',
  `status` enum('pending','lunas','ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`transaksi_id`),
  KEY `transaksi_user_id_foreign` (`user_id`),
  KEY `transaksi_program_id_foreign` (`program_id`),
  CONSTRAINT `transaksi_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `program_bimbel` (`program_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `transaksi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaksi` */

insert  into `transaksi`(`transaksi_id`,`user_id`,`program_id`,`jadwal_id`,`kelas_id`,`pengajar_id`,`tagihan`,`photo_bukti`,`midtrans_order_id`,`metode_bayar`,`status`,`created_at`,`updated_at`) values 
(7,8,10,48,4,7,350000.00,'1773215594_5bb425a149e07507ba18.jpeg',NULL,'manual','lunas','2026-03-11 07:53:14','2026-03-11 08:09:51'),
(8,4,10,48,4,7,350000.00,'1773217749_ac0bc43a33920ffa5f88.jpeg',NULL,'manual','lunas','2026-03-11 08:29:09','2026-03-11 08:29:37'),
(9,2,2,47,5,5,120000.00,'1773238266_d727460f59008a7d9e0e.jpeg','BIMBEL-2-2-1781009201','midtrans','lunas','2026-03-11 14:11:06','2026-06-09 19:47:06'),
(10,8,9,52,6,7,230000.00,NULL,'BIMBEL-8-9-1773288228','midtrans','lunas','2026-03-12 04:03:48','2026-03-12 04:06:57'),
(11,3,5,50,7,6,190000.00,NULL,'BIMBEL-3-5-1773288552','midtrans','lunas','2026-03-12 04:09:12','2026-03-12 04:13:25'),
(12,3,6,51,8,6,170000.00,NULL,'BIMBEL-3-6-1773288862','midtrans','lunas','2026-03-12 04:14:22','2026-03-12 04:14:35'),
(13,4,8,49,9,7,230000.00,NULL,'BIMBEL-4-8-1779242377','midtrans','lunas','2026-05-20 01:59:37','2026-05-20 02:00:07'),
(14,2,1,47,10,10,150000.00,NULL,'BIMBEL-2-1-1779249879','midtrans','lunas','2026-05-20 04:04:39','2026-05-20 04:05:11'),
(16,8,8,49,9,7,230000.00,'1780730680_d5c7f3ea314114c93a67.jpeg',NULL,'manual','lunas','2026-06-06 14:24:40','2026-06-06 14:27:01'),
(17,8,7,49,11,7,250000.00,NULL,'BIMBEL-8-7-1780730724','midtrans','lunas','2026-06-06 14:25:24','2026-06-06 14:25:39');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`nama`,`nomor_hp`,`email`,`role`,`tingkat`,`jabatan`,`password`,`photo`,`created_at`,`updated_at`) values 
(1,'Administrator','081234567890','admin@gmail.com','admin',NULL,NULL,'$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,NULL,NULL),
(2,'Andi Setiawan','081234567891','sd@gmail.com','siswa','SD',NULL,'$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,NULL,NULL),
(3,'Budi Santoso','081234567892','smp@gmail.com','siswa','SMP',NULL,'$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,NULL,NULL),
(4,'Siti Aminah','081234567893','sma@gmail.com','siswa','SMA',NULL,'$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,NULL,NULL),
(5,'Ahmad Rahman','081234567894','sdp@gmail.com','pengajar',NULL,'SD','$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,NULL,NULL),
(6,'Dewi Sartika','081234567895','smpp@gmail.com','pengajar',NULL,'SMP','$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,NULL,NULL),
(7,'Rini Pratiwi','081234567896','smap@gmail.com','pengajar',NULL,'SMA','$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,NULL,NULL),
(8,'frankie','08883866931','sma2@gmail.com','siswa','SMA',NULL,'$2y$10$JOk6c7pzkqPGgct9DxwufuPYQxwYiRMNtjKv/dim8b1Thfu8MvixW',NULL,'2026-03-11 05:52:04','2026-03-11 05:52:04'),
(9,'Frankie Steinlie','08883866931','frankie.steinlie@gmail.com','admin','SD',NULL,'$2y$12$2QPUna.nl4JfPWBlFzisKuKoDA2YEMlQGOk7kSmz7M/DtqvozWHCC',NULL,'2026-06-06 07:33:32','2026-06-06 07:33:46'),
(10,'sd','08883866931','sdp1@gmail.com','pengajar',NULL,'SD','$2y$12$XsRO/XowyGVf.r591BgFJOZloTxBf9zppVzB6C5n5C21jnq9qGuGi',NULL,'2026-06-06 07:52:18','2026-06-06 07:52:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

/* ============================================================
   DUMMY DATA: Fill all guru slots (for testing manual plotting)
   All 11 programs get a kelas_bimbel with terisi = kuota = 5
   so any new registration cannot auto-assign and requires
   admin to manually plot the teacher.
   ============================================================ */

/* Step 1: Fill all existing kelas_bimbel to max capacity */
UPDATE `kelas_bimbel` SET `terisi` = `kuota`;

/* Step 2: Create kelas_bimbel for programs that don't have one yet */
INSERT INTO `kelas_bimbel` (`kelas_id`,`program_id`,`jadwal_id`,`pengajar_id`,`kuota`,`terisi`,`created_at`,`updated_at`) VALUES
(12, 3,  48, 10, 5, 5, '2026-06-12 00:00:00','2026-06-12 00:00:00'),  /* IPA Terpadu SD       → pengajar SD  (user 10) */
(13, 4,  50,  6, 5, 5, '2026-06-12 00:00:00','2026-06-12 00:00:00'),  /* Matematika SMP       → pengajar SMP (user 6)  */
(14, 6,  51,  6, 5, 5, '2026-06-12 00:00:00','2026-06-12 00:00:00'),  /* Bahasa Inggris SMP   → pengajar SMP (user 6)  */
(15, 7,  49,  7, 5, 5, '2026-06-12 00:00:00','2026-06-12 00:00:00'),  /* Matematika SMA IPA   → pengajar SMA (user 7)  */
(16, 9,  52,  7, 5, 5, '2026-06-12 00:00:00','2026-06-12 00:00:00'),  /* Kimia SMA            → pengajar SMA (user 7)  */
(17, 10, 48,  7, 5, 5, '2026-06-12 00:00:00','2026-06-12 00:00:00'),  /* Persiapan UTBK       → pengajar SMA (user 7)  */
(18, 33, 61,  7, 5, 5, '2026-06-12 00:00:00','2026-06-12 00:00:00');  /* coba (SMA)           → pengajar SMA (user 7)  */

/* Step 3: Create matching lunas transactions for the new kelas */
INSERT INTO `transaksi` (`transaksi_id`,`user_id`,`program_id`,`jadwal_id`,`kelas_id`,`pengajar_id`,`tagihan`,`photo_bukti`,`midtrans_order_id`,`metode_bayar`,`status`,`created_at`,`updated_at`) VALUES
(20, 2,  3,  48, 12, 10, 140000.00, NULL, 'BIMBEL-2-3-DUMMY',  'midtrans', 'lunas', '2026-06-12 00:00:00','2026-06-12 00:00:00'),
(21, 3,  4,  50, 13,  6, 200000.00, NULL, 'BIMBEL-3-4-DUMMY',  'midtrans', 'lunas', '2026-06-12 00:00:00','2026-06-12 00:00:00'),
(22, 3,  6,  51, 14,  6, 170000.00, NULL, 'BIMBEL-3-6-DUMMY',  'midtrans', 'lunas', '2026-06-12 00:00:00','2026-06-12 00:00:00'),
(23, 4,  7,  49, 15,  7, 250000.00, NULL, 'BIMBEL-4-7-DUMMY',  'midtrans', 'lunas', '2026-06-12 00:00:00','2026-06-12 00:00:00'),
(24, 4,  9,  52, 16,  7, 230000.00, NULL, 'BIMBEL-4-9-DUMMY',  'midtrans', 'lunas', '2026-06-12 00:00:00','2026-06-12 00:00:00'),
(25, 4, 10,  48, 17,  7, 350000.00, NULL, 'BIMBEL-4-10-DUMMY', 'midtrans', 'lunas', '2026-06-12 00:00:00','2026-06-12 00:00:00'),
(26, 8, 33,  61, 18,  7, 730000.00, NULL, 'BIMBEL-8-33-DUMMY', 'midtrans', 'lunas', '2026-06-12 00:00:00','2026-06-12 00:00:00');

/* ============================================================
   SUMMARY: All programs now fully booked (5/5)

   SD  (pengajar: Ahmad Rahman=5, sd=10):
     Program 1  Matematika Dasar SD    → kelas 10, pengajar 10
     Program 2  Bahasa Indonesia SD    → kelas 5,  pengajar 5
     Program 3  IPA Terpadu SD         → kelas 12, pengajar 10

   SMP (pengajar: Dewi Sartika=6):
     Program 4  Matematika SMP         → kelas 13, pengajar 6
     Program 5  IPA SMP                → kelas 7,  pengajar 6
     Program 6  Bahasa Inggris SMP     → kelas 14, pengajar 6

   SMA (pengajar: Rini Pratiwi=7):
     Program 7  Matematika SMA IPA     → kelas 15, pengajar 7
     Program 8  Fisika SMA             → kelas 9,  pengajar 7
     Program 9  Kimia SMA              → kelas 16, pengajar 7
     Program 10 Persiapan UTBK         → kelas 17, pengajar 7
     Program 33 coba (SMA)             → kelas 18, pengajar 7

   → Any new student registration will fail auto-assign
   → Admin must use the 🎯 Plotting button to manually assign
   ============================================================ */
