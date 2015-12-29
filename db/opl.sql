/*
SQLyog Ultimate v10.42 
MySQL - 5.5.16 : Database - opl
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`opl` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `opl`;

/*Table structure for table `agreement_opl` */

DROP TABLE IF EXISTS `agreement_opl`;

CREATE TABLE `agreement_opl` (
  `id_agreement` int(11) NOT NULL AUTO_INCREMENT,
  `pemeriksa` varchar(50) DEFAULT NULL,
  `komite` varchar(50) DEFAULT NULL,
  `user` varchar(50) NOT NULL,
  KEY `id_agreement` (`id_agreement`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `agreement_opl` */

insert  into `agreement_opl`(`id_agreement`,`pemeriksa`,`komite`,`user`) values (21,'2','3','1'),(25,'2','3','5'),(32,'2','3','7'),(33,'1','3','6'),(34,'2','3','7'),(35,'2','3','8');

/*Table structure for table `akses_opl` */

DROP TABLE IF EXISTS `akses_opl`;

CREATE TABLE `akses_opl` (
  `no_opl_temp` varchar(1000) NOT NULL,
  `username` varchar(1000) NOT NULL,
  `nilai` int(11) NOT NULL,
  `tgl_penilaian` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `akses_opl` */

insert  into `akses_opl`(`no_opl_temp`,`username`,`nilai`,`tgl_penilaian`) values ('1/2015-10-15 12:56:18/1','2',0,''),('5/2015-10-30 08:06:06/1','1',1,'2015-11-15 10:11:52'),('5/2015-10-30 08:05:44/2','1',0,'');

/*Table structure for table `circle_group` */

DROP TABLE IF EXISTS `circle_group`;

CREATE TABLE `circle_group` (
  `id_cg` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cg` varchar(100) DEFAULT NULL,
  `id_sub_dep` int(11) DEFAULT NULL,
  KEY `id_cg` (`id_cg`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `circle_group` */

insert  into `circle_group`(`id_cg`,`nama_cg`,`id_sub_dep`) values (1,'MATRIX',6),(2,'AVATAR',12),(3,'RISING STAR',1),(4,'METAMORPHOSIS',13),(5,'NON CG FNP',18),(6,'GEMASD',18),(7,'MACGYVER',13),(8,'SUPERBIN',13),(9,'SAUBERPRO',22),(10,'CEPOT WARRIORS',19),(11,'SKF',20),(12,'CEPOT WARRIORS',21),(13,'BIODEGRADABLE',27),(14,'SPATULA',28),(15,'AMALGAM',29),(16,'SALT',30),(17,'EFFERVESCENT',31),(18,'SHINNING',32),(19,'PLANNER',16),(20,'NON CG PND',13),(21,'HORENSO',18),(22,'HYBRID',18),(23,'U-VESPA',18),(24,'RMPM',23),(25,'RMPM',24),(26,'RMPM',25),(27,'FINISH GOOD',26);

/*Table structure for table `departmen` */

DROP TABLE IF EXISTS `departmen`;

CREATE TABLE `departmen` (
  `id_dep` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dep` varchar(100) DEFAULT NULL,
  KEY `id_dep` (`id_dep`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `departmen` */

insert  into `departmen`(`id_dep`,`nama_dep`) values (1,'MNF'),(2,'IOS'),(3,'FAIT'),(4,'PRD'),(5,'ENG'),(6,'WHS'),(7,'QA'),(8,'HRGA');

/*Table structure for table `detail_opl` */

DROP TABLE IF EXISTS `detail_opl`;

CREATE TABLE `detail_opl` (
  `no_step` int(11) NOT NULL,
  `no_opl_temp` varchar(1000) NOT NULL,
  `gambar` varchar(1000) NOT NULL,
  `keterangan` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `detail_opl` */

insert  into `detail_opl`(`no_step`,`no_opl_temp`,`gambar`,`keterangan`) values (1,'1/2015-10-15 12:56:18/1','cetar 1.jpg','sss'),(1,'5/2015-10-15 13:47:37/1','Membeli baju baru 1.jpg','d'),(1,'5/2015-10-16 14:55:13/1','Giant Swing 1.jpg','giant swing'),(1,'1/2015-10-16 15:03:53/2','Meriang 1.jpg','werr'),(1,'1/2015-10-16 15:10:44/1','Kukuruyuk 1.jpg','swe'),(1,'5/2015-10-16 16:05:33/1','ddd 1.jpg','xcss'),(1,'5/2015-10-16 16:08:20/2','Seblak Batagor 1.jpg','a'),(1,'6/2015-10-20 10:13:45/1','Hamburger 1.jpg','wahahah'),(1,'5/2015-10-29 07:48:56/1','Membuat tempe 1.jpg','lalala'),(1,'5/2015-10-30 08:02:13/2','Apel 1.jpg','apel adalah'),(1,'5/2015-10-30 08:02:45/2','Brenuk 1.jpg','brenuk adalah'),(1,'5/2015-10-30 08:03:13/2','Ceri 1.jpg','ceri adalah'),(1,'5/2015-10-30 08:03:36/1','Duren 1.jpg','duren adalah'),(1,'5/2015-10-30 08:04:04/1','Enau 1.jpg','enau adalah'),(1,'5/2015-10-30 08:04:33/1','Fanta 1.jpg','fanta adalah'),(1,'5/2015-10-30 08:04:54/1','gula 1.jpg','apel adalah'),(1,'5/2015-10-30 08:05:15/1','Hitam 1.jpg','apel adalah'),(1,'5/2015-10-30 08:05:44/2','ikan 1.jpg','ikan adalah'),(1,'5/2015-10-30 08:06:06/1','Jambu 1.jpg','apel adalah'),(1,'5/2015-10-30 08:06:50/2','Kambing 1.jpg','c'),(1,'5/2015-10-30 14:43:47/1','Sirsak 1.jpg','fd'),(1,'1/2015-10-30 14:59:09/1','kelapa 1.jpg','frg'),(1,'1/2015-10-30 15:04:57/1','Sendal 1.jpg','hhk'),(1,'1/2015-11-08 14:14:50/1','Kembang 1.jpg','fj'),(1,'7/2015-11-09 19:43:20/1','Asin 1.jpg','fg'),(1,'8/2015-11-10 08:56:47/1','Lap 1.jpg','fggg'),(1,'1/2015-11-10 15:40:15/1','Y 1.jpg','dfsh');

/*Table structure for table `jabatan` */

DROP TABLE IF EXISTS `jabatan`;

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(200) DEFAULT NULL,
  KEY `id_jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;

/*Data for the table `jabatan` */

insert  into `jabatan`(`id_jabatan`,`nama_jabatan`) values (3,'Application & Development Support'),(4,'Bin Filling Forklift Operator'),(5,'Bin Filling Operator'),(6,'Bin Washing Forklift Operator'),(7,'Bin Washing Helper'),(8,'Bin Washing Operator'),(9,'Blending & Dumping Circle Administration'),(10,'Blending & Dumping Circle Leader'),(11,'Blending Forklift Operator'),(12,'Blending Helper'),(13,'Blending Operator'),(14,'Can Filling Operator'),(15,'Can Packing Helper'),(16,'Can Packing Operator'),(17,'CIP Operator'),(18,'Cleaning Service'),(19,'Compounding Operator'),(20,'Depalletizer Helper'),(21,'Document Controller'),(22,'Drier Circle Administration'),(23,'Drier Circle Leader'),(24,'Drier Continous Cleaner'),(25,'Drier Group Leader'),(26,'Drier Roving Operator'),(27,'Driver'),(28,'Dry Sachet Circle Administration'),(29,'Dry Sachet Circle Leader'),(30,'Dry Sachet Group Leader'),(31,'Dumping Forklift Operator'),(32,'Dumping Helper'),(33,'Dumping Operator'),(34,'Eductor Helper'),(35,'Eductor Operator'),(36,'Electrical Technician'),(37,'Engineering Administration'),(38,'Engineering Analyst'),(39,'Evaporator Operator'),(40,'Fat Blend & Mixing Circle Leader '),(41,'Filling & Packing Coordinator'),(42,'Filling & Packing Supervisor'),(43,'Finance & Accounting Junior Staff'),(44,'Finance & Accounting Staff'),(45,'Finance & Accounting Supervisor'),(46,'Gardener'),(47,'General Affair Administration '),(48,'General Affair Staff'),(49,'HRD Administration'),(50,'HVAC Helper'),(51,'HVAC Technician'),(52,'Improvement Administration'),(53,'IT Infrastructure & Security Management'),(54,'IT Staff'),(55,'IT Supervisor'),(56,'Komandan'),(57,'Komandan Regu'),(58,'Maintenance System Supervisor'),(59,'Mechanic Helper'),(60,'Mechanical Leader'),(61,'Mechanical Technician'),(62,'Operational Maintenance Supervisor'),(63,'Payroll & Secretary'),(64,'Planner'),(65,'PPIC Administration'),(66,'PPIC Staff'),(67,'Process & Drier Supervisor'),(68,'Processing Operator'),(69,'Production Administration'),(70,'Production Staff'),(71,'Production Store Helper'),(72,'Purchasing Administration'),(73,'Purchasing Staff'),(74,'Purchasing Supervisor'),(75,'QA Admin'),(76,'QA Staff'),(77,'QC Chemphys Analyst'),(78,'QC Chemphys Group Leader'),(79,'QC Chemphys Supervisor'),(80,'QC In Line Analyst'),(81,'QC In Line Coordinator'),(82,'QC In Line Group Leader'),(83,'QC Incoming Analyst'),(84,'QC Inline Field'),(85,'QC Instrument Analyst'),(86,'QC Microbiology Analyst'),(87,'QC Microbiology Field'),(88,'QC Microbiology Supervisor'),(89,'Receptionist'),(90,'Recruitment & Learning Development Staff'),(91,'Roving & Cleaner Helper'),(92,'Sachet Filling Operator'),(93,'Sachet Packing Helper'),(94,'Sachet Packing Operator'),(95,'Sachet Roving & Cleaner Helper'),(96,'Security'),(97,'Store Keeper'),(98,'System Coordinator'),(99,'System Inspector'),(100,'Tipping Forklift Operator'),(101,'Tipping Operator'),(102,'Tote Bin Washing Circle Leader'),(103,'TPM Staff'),(104,'Utility Leader'),(105,'Utility Operator'),(106,'Warehouse Administration'),(107,'Warehouse FG Assistant'),(108,'Warehouse FG Checker'),(109,'Warehouse FG Forklift Operator'),(110,'Warehouse FG Helper'),(111,'Warehouse FG Staff'),(112,'Warehouse PM Assistant'),(113,'Warehouse PM Checker'),(114,'Warehouse PM Staff'),(115,'Warehouse RM Major Checker'),(116,'Warehouse RM Major Forklift Operator'),(117,'Warehouse RM Major Helper'),(118,'Warehouse RM Major Preparator'),(119,'Warehouse RM Major Staff'),(120,'Warehouse RM Minor Assistant'),(121,'Warehouse RM Minor Helper'),(122,'Warehouse RM Minor Preparator'),(123,'Warehouse RM Minor Staff'),(124,'Wet Canning Circle Administration'),(125,'Wet Canning Circle Leader'),(126,'Wet Canning Group Leader'),(127,'Wet Sachet Circle Administration'),(128,'Wet Sachet Circle Leader'),(129,'Wet Sachet Group Leader'),(130,'WWTP Operator'),(131,'');

/*Table structure for table `komentar` */

DROP TABLE IF EXISTS `komentar`;

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_komentar` varchar(1000) DEFAULT NULL,
  `isi_komentar` mediumtext,
  `id_problem` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_komentar`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `komentar` */

insert  into `komentar`(`id_komentar`,`tgl_komentar`,`isi_komentar`,`id_problem`,`username`) values (1,'2015-10-29 15:05:54','desa itu teh?',0,'5'),(3,'2015-10-29 15:10:57','da',0,'5'),(4,'2015-10-29 15:15:45','grdd',0,'5'),(5,'2015-10-29 15:18:29','asa',0,'5'),(6,'2015-10-29 15:57:45','ad',0,'5'),(7,'2015-11-16 07:16:45','diakibatkan',0,'5');

/*Table structure for table `komite` */

DROP TABLE IF EXISTS `komite`;

CREATE TABLE `komite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `komite` */

insert  into `komite`(`id`,`username`) values (12,'3');

/*Table structure for table `level` */

DROP TABLE IF EXISTS `level`;

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  KEY `id_level` (`id_level`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `level` */

insert  into `level`(`id_level`,`nama_level`) values (1,'creator'),(2,'koordinator'),(3,'administrator');

/*Table structure for table `opl` */

DROP TABLE IF EXISTS `opl`;

CREATE TABLE `opl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_opl_temp` varchar(1000) NOT NULL,
  `no_opl` varchar(1000) NOT NULL,
  `tgl_pembuatan` date NOT NULL,
  `jenis_opl` int(11) NOT NULL,
  `tema_opl` varchar(1000) NOT NULL,
  `id_agreement` int(11) NOT NULL,
  `status` varchar(500) NOT NULL,
  `tgl_approve_pemeriksa` date NOT NULL,
  `tgl_approve_komite` date NOT NULL,
  `tgl_approve_koordinator` date NOT NULL,
  `tgl_reject` date NOT NULL,
  `alasan_koreksi_pemeriksa` varchar(100) NOT NULL,
  `alasan_koreksi_komite` varchar(500) NOT NULL,
  `alasan_koreksi_koordinator` varchar(500) NOT NULL,
  `tgl_koreksi_pemeriksa` date NOT NULL,
  `tgl_koreksi_komite` date NOT NULL,
  `tgl_koreksi_koordinator` date NOT NULL,
  `alasan_reject_pemeriksa` varchar(500) NOT NULL,
  `alasan_reject_komite` varchar(500) NOT NULL,
  `alasan_reject_koordinator` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

/*Data for the table `opl` */

insert  into `opl`(`id`,`no_opl_temp`,`no_opl`,`tgl_pembuatan`,`jenis_opl`,`tema_opl`,`id_agreement`,`status`,`tgl_approve_pemeriksa`,`tgl_approve_komite`,`tgl_approve_koordinator`,`tgl_reject`,`alasan_koreksi_pemeriksa`,`alasan_koreksi_komite`,`alasan_koreksi_koordinator`,`tgl_koreksi_pemeriksa`,`tgl_koreksi_komite`,`tgl_koreksi_koordinator`,`alasan_reject_pemeriksa`,`alasan_reject_komite`,`alasan_reject_koordinator`) values (7,'1/2015-10-15 12:56:18/1','OPL/K/FAIT/MATRIX/1/2015','2015-10-15',1,'cetar',21,'7','2015-10-15','2015-10-15','2015-10-15','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(18,'5/2015-10-15 13:47:37/1','OPL/K/FAIT/MATRIX/2/2015','2015-10-15',1,'Membeli baju baru',25,'7','2015-10-15','2015-10-15','2015-10-15','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(23,'5/2015-10-16 14:55:13/1','OPL/K/FAIT/MATRIX/3/2015','2015-10-16',1,'Giant Swing',25,'7','2015-10-16','2015-10-16','2015-10-16','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(24,'1/2015-10-16 15:03:53/2','OPL/T/FAIT/MATRIX/1/2015','2015-10-16',2,'Meriang',21,'7','2015-10-16','2015-10-16','2015-10-16','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(25,'1/2015-10-16 15:10:44/1','OPL/K/FAIT/MATRIX/4/2015','2015-10-16',1,'Kukuruyuk',21,'7','2015-10-16','2015-10-16','2015-10-16','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(27,'5/2015-10-16 16:05:33/1','OPL/K/FAIT/MATRIX/5/2015','2015-10-16',1,'ddd',25,'7','2015-10-16','2015-10-16','2015-10-16','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(28,'5/2015-10-16 16:08:20/2','OPL/T/FAIT/MATRIX/2/2015','2015-10-16',2,'Seblak Batagor',25,'7','2015-10-16','2015-10-16','2015-10-16','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(29,'6/2015-10-20 10:13:45/1','OPL/K/HRGA/EFFERVESCENT/1/2015','2015-10-20',1,'Hamburger',33,'7','2015-10-20','2015-10-20','2015-10-20','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(30,'5/2015-10-29 07:48:56/1','OPL/K/FAIT/MATRIX/6/2015','2015-10-29',1,'Membuat tempe',25,'7','2015-10-29','2015-10-29','2015-10-29','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(31,'5/2015-10-30 08:02:13/2','','2015-10-30',2,'Apel',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(32,'5/2015-10-30 08:02:45/2','','2015-10-30',2,'Brenuk',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(33,'5/2015-10-30 08:03:13/2','','2015-10-30',2,'Ceri',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(34,'5/2015-10-30 08:03:36/1','','2015-10-30',1,'Duren',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(35,'5/2015-10-30 08:04:04/1','','2015-10-30',1,'Enau',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(36,'5/2015-10-30 08:04:33/1','','2015-10-30',1,'Fanta',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(37,'5/2015-10-30 08:04:54/1','','2015-10-30',1,'gula',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(38,'5/2015-10-30 08:05:15/1','','2015-10-30',1,'Hitam',25,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(39,'5/2015-10-30 08:05:44/2','','2015-10-30',2,'ikan',25,'2','0000-00-00','0000-00-00','0000-00-00','0000-00-00','scssdddd','','','2015-11-08','0000-00-00','0000-00-00','','',''),(40,'5/2015-10-30 08:06:06/1','OPL/K/FAIT/MATRIX/10/2015','2015-10-30',1,'Jambu',25,'7','2015-11-08','2015-11-08','2015-11-15','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(41,'5/2015-10-30 08:06:50/2','OPL/T/FAIT/MATRIX/3/2015','2015-10-30',2,'Kambing',25,'7','2015-10-30','2015-10-30','2015-10-30','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(42,'5/2015-10-30 14:43:47/1','OPL/K/FAIT/MATRIX/7/2015','2015-10-30',1,'Sirsak',25,'7','2015-10-30','2015-10-30','2015-10-30','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(43,'1/2015-10-30 14:59:09/1','OPL/K/FAIT/MATRIX/8/2015','2015-10-30',1,'kelapa',21,'7','2015-10-30','2015-10-30','2015-10-30','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(44,'1/2015-10-30 15:04:57/1','OPL/K/FAIT/MATRIX/9/2015','2015-10-30',1,'Sendal',21,'7','2015-10-30','2015-10-30','2015-10-30','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(45,'1/2015-11-08 14:14:50/1','','2015-11-08',1,'Kembang',21,'8','0000-00-00','0000-00-00','0000-00-00','2015-11-08','','','','0000-00-00','0000-00-00','0000-00-00','eee','',''),(46,'7/2015-11-09 19:43:20/1','','2015-11-09',1,'Asin',34,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(47,'8/2015-11-10 08:56:47/1','','2015-11-10',1,'Lap',35,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','',''),(48,'1/2015-11-10 15:40:15/1','','2015-11-10',1,'Y',21,'1','0000-00-00','0000-00-00','0000-00-00','0000-00-00','','','','0000-00-00','0000-00-00','0000-00-00','','','');

/*Table structure for table `pemeriksa` */

DROP TABLE IF EXISTS `pemeriksa`;

CREATE TABLE `pemeriksa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `pemeriksa` */

insert  into `pemeriksa`(`id`,`username`) values (15,'2'),(16,'1');

/*Table structure for table `problem` */

DROP TABLE IF EXISTS `problem`;

CREATE TABLE `problem` (
  `id_problem` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_pembuatan` varchar(1000) DEFAULT NULL,
  `tema_problem` varchar(100) DEFAULT NULL,
  `isi_problem` varchar(1000) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_problem`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `problem` */

insert  into `problem`(`id_problem`,`tgl_pembuatan`,`tema_problem`,`isi_problem`,`username`) values (1,'2015-10-29 11:32:36','A','A','5'),(2,'2015-11-16 07:16:28','print','kenapa print berwarna orang?','5');

/*Table structure for table `score` */

DROP TABLE IF EXISTS `score`;

CREATE TABLE `score` (
  `nama_user` varchar(50) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `id_cg` int(11) DEFAULT NULL,
  `id_sub_dep` int(11) DEFAULT NULL,
  `id_dep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `score` */

insert  into `score`(`nama_user`,`score`,`id_cg`,`id_sub_dep`,`id_dep`) values ('Merio Aji Prasetyo',4,1,6,3),('Sulastri',4,1,6,3),('Moch Nurzen Ismail',1,17,31,8);

/*Table structure for table `sub_dep` */

DROP TABLE IF EXISTS `sub_dep`;

CREATE TABLE `sub_dep` (
  `id_sub_dep` int(11) NOT NULL AUTO_INCREMENT,
  `nama_sub_dep` varchar(100) DEFAULT NULL,
  `id_dep` int(11) DEFAULT NULL,
  KEY `id_sub_dep` (`id_sub_dep`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

/*Data for the table `sub_dep` */

insert  into `sub_dep`(`id_sub_dep`,`nama_sub_dep`,`id_dep`) values (1,'BPSD',2),(6,'FAIT-IT',3),(12,'FAIT-FA',3),(13,'PND',4),(16,'PPIC',1),(17,'I2C',1),(18,'FNP',4),(19,'ELECTRICAL',5),(20,'STORE KEEPER',5),(21,'MECHANICAL',5),(22,'UTILITY',5),(23,'RM',6),(24,'PM',6),(25,'DISPENSING',6),(26,'FINISH GOOD',6),(27,'MICROBIOLOGY',7),(28,'INLINE',7),(29,'CHEMPYS',7),(30,'HR TRAINING',8),(31,'HRGA',8),(32,'PURCHASING',8),(33,'PPIC',1);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `inisial` varchar(10) DEFAULT NULL,
  `id_level` int(11) DEFAULT NULL,
  `id_cg` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `ext` varchar(100) DEFAULT NULL,
  `foto` varchar(500) DEFAULT NULL,
  `Status` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`fullname`,`inisial`,`id_level`,`id_cg`,`id_jabatan`,`email`,`ext`,`foto`,`Status`) values (17,'admin','admin','administrator','ADM',3,NULL,NULL,NULL,NULL,NULL,1),(28,'1','1','Merio Aji Prasetyo','MAP',1,1,3,'merioaji@kalbenutritionals.com','723','1.jpg',1),(29,'2','2','Akhmad Makhali','AMI',1,1,55,'akhmadmakhali@kalbenutritionals.com','720','2.jpg',1),(30,'3','3','Putri Puspita Sari','PPS',1,2,43,'putripuspita@kalbenutritionals.com','714','3.jpg',1),(31,'4','4','Koordinator','',2,1,3,'','','4.jpg',1),(32,'5','5','Sulastri','SUL',1,1,54,'sulastri_45ajah@gmail.com','085691168565','5.jpg',1),(33,'6','6','Moch Nurzen Ismail','MNI',1,17,19,'moch_noerzen@yahoo.com','079966','6.jpg',1),(34,'7','7','Saepul','SAO',1,1,14,'saepul@gmail.com','085623455728','7.jpg',1),(35,'8','8','Novan','NOV',1,17,6,'novan@gmail.com','079966','8.jpg',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
