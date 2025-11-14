/*
SQLyog Ultimate v12.4.3 (64 bit)
MySQL - 8.0.30 : Database - db_simplecrud
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_simplecrud` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_simplecrud`;

/*Table structure for table `tb_motor` */

DROP TABLE IF EXISTS `tb_motor`;

CREATE TABLE `tb_motor` (
  `id_motor` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_motor` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_motor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_motor` */

insert  into `tb_motor`(`id_motor`,`nama_motor`) values 
('H-A160','Honda ADV 160'),
('H-ADV','Honda ADV 160'),
('H-BSY','Honda Beat Sporty'),
('H-CBR','Honda CBR 150'),
('H-CBX','Honda CB150X'),
('H-CRY','Honda CRF Rally'),
('H-FRZ','Honda Forza'),
('H-GNO','Honda Genio'),
('H-GWG','Honda Gold Wing 1800'),
('H-MKY','Honda Monkey'),
('H-PCX','Honda PCX 160'),
('H-SNC','Honda Sonic'),
('H-SOY','Honda Scoopy'),
('H-SPR','Honda Supra GTR'),
('H-SPX','Honda Supra-X'),
('H-STT','Honda Beat Streat'),
('H-SYO','Honda Stylo'),
('H-VRO','Honda Vario 125'),
('H-VRZ','Honda Verza 150'),
('Y-APA','Yamaha Alpha'),
('Y-ARX','Yamaha Aerox'),
('Y-FGO','Yamaha FreeGO 125'),
('Y-FNO','Yamaha Fino'),
('Y-FZO','Yamaha Fazzio'),
('Y-GAR','Yamaha Gear 155'),
('Y-GFO','Yamaha Grand Filano'),
('Y-GUA','Yamaha Ultima'),
('Y-LLX','Yamaha Lexi Lx 155'),
('Y-MM3','Yamaha Mio M3'),
('Y-NMAX','Yamaha NMAX 155'),
('Y-R15','Yamaha R15'),
('Y-R25','Yamaha R25'),
('Y-RDE','Yamaha X-Ride 125'),
('Y-XAX','Yamaha Xmax 250'),
('Y-XS1','Yamaha XSR-155'),
('Y-XSR','Yamaha XSR 155'),
('Z-ACS','Suzuki Acces 125'),
('Z-BRT','Suzuki Burgman Street'),
('Z-NEX','Suzuki Nex II'),
('Z-NSF','Suzuki Satria New'),
('Z-VTS','Suzuki V-Strom 250');

/*Table structure for table `tb_provinsi` */

DROP TABLE IF EXISTS `tb_provinsi`;

CREATE TABLE `tb_provinsi` (
  `id_provinsi` smallint NOT NULL AUTO_INCREMENT,
  `nama_provinsi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_provinsi` */

insert  into `tb_provinsi`(`id_provinsi`,`nama_provinsi`) values 
(1,'Bali,denpasar'),
(2,'Nusa Tenggara Timur'),
(3,'Nusa Tenggara Barat'),
(4,'Jawa Timur'),
(5,'Jawa Tengah'),
(6,'Jawa Barat'),
(8,'Aceh'),
(9,'Banten'),
(10,'Bengkulu'),
(11,'Daerah Istimewa Yogyakarta'),
(12,'Daerah Kusus Ibu Kota Jakarta'),
(13,'Gorontalo'),
(14,'Jambi'),
(16,'Kamimantan Barat'),
(17,'Kalimantan Timur'),
(18,'Kalimantan Utara'),
(19,'Kalimantan Tengah'),
(20,'Kalimantan Selatan'),
(21,'Kepulauan Bangka Belitung'),
(22,'Kepulauan Riau'),
(23,'Lampung'),
(24,'Maluku'),
(25,'Maluku Utara'),
(26,'Papua'),
(27,'Papua Barat'),
(28,'Papua Pegunungan'),
(29,'Papua Selatan'),
(30,'Papua Tengah'),
(31,'Riau'),
(32,'Sulawesi Barat'),
(33,'Sulawesi Selatan'),
(34,'Sulawesi Tengah'),
(35,'Sulawesi Tenggara'),
(36,'Sulawesi Utara '),
(37,'Sumatra Barat'),
(38,'Sumatra Selatan'),
(39,'Sumatra Utara');

/*Table structure for table `tb_transaksi` */

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int NOT NULL AUTO_INCREMENT,
  `nama_customer` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `id_motor` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `provinsi` smallint NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `status_transaksi` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Pending, 2=Selesai, 3=Dibatalkan',
  PRIMARY KEY (`id_transaksi`),
  KEY `FK_transaksi_motor` (`id_motor`),
  KEY `FK_transaksi_provinsi` (`provinsi`),
  CONSTRAINT `FK_transaksi_motor` FOREIGN KEY (`id_motor`) REFERENCES `tb_motor` (`id_motor`) ON UPDATE CASCADE,
  CONSTRAINT `FK_transaksi_provinsi` FOREIGN KEY (`provinsi`) REFERENCES `tb_provinsi` (`id_provinsi`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_transaksi` */

insert  into `tb_transaksi`(`id_transaksi`,`nama_customer`,`id_motor`,`alamat`,`provinsi`,`email`,`telp`,`status_transaksi`) values 
(3,'miki','Y-XSR','Jalan Tukad Batanghari',4,'miki@gmail.com','0812324325463',2),
(4,'edo','H-ADV','Jalan Tukad Fuar',2,'edoi@gmail.com','08123456445424',2),
(5,'aril','Y-NMAX','Dekat Rumah',3,'aril@gmail.com','0812564543535',2),
(6,'Carlos ','Y-NMAX','Jalan Sesetan',2,'carlos@gmail.com','081222111333',2),
(8,'Yemi','H-PCX','Jalan Sesetan ,gg linga murti,Denpasar Selatan',2,'yemi@gmail.com','081337889945',2),
(9,'Ridus','H-PCX','Jalan Sesetan ,gg linga murti,Denpasar Selatan',2,'yemi@gmail.com','081337889945',1),
(10,'Ridus','H-GNO','Jalan Sesetan ,gg linga murti,Denpasar Selatan',2,'yemi@gmail.com','081337889945',1),
(11,'San Wangu','H-MKY','Jalan Sesetan ,gg linga murti,Denpasar Selatan',2,'yemi@gmail.com','081337889945',2),
(12,'Beril','Y-R25','Jalan Tukad Pulet , Panjer Denpasar Selatan Bali',1,'berilmcb@gmail.com','0816543993',2),
(13,'Ridus','H-SYO','Jalan Tukadbatanghari',1,'ridus@gmail.com','082222678846',2),
(14,'Joys','H-SYO','Jalan Sesetan ,gg linga murti,Denpasar Selatan',2,'yemi@gmail.com','081337889945',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
