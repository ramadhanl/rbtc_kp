/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.17 : Database - qonimax
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`qonimax` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `qonimax`;

/*Table structure for table `daftar_film` */

DROP TABLE IF EXISTS `daftar_film`;

CREATE TABLE `daftar_film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `sinopsis` varchar(255) DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `awal_tayang` date DEFAULT NULL,
  `akhir_tayang` date DEFAULT NULL,
  `kualitas` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `daftar_film` */

insert  into `daftar_film`(`id_film`,`judul`,`sinopsis`,`durasi`,`kategori`,`awal_tayang`,`akhir_tayang`,`kualitas`,`rating`) values (1,'IN THE HEART OF THE SEA','Pada bulan Agustus 1819 sebuah tim yang terdiri dari 21 orang menggunakan kapal penangkap ikan paus berlayar untuk belajar hal baru di luar sana. Namun kapal tersebut diserang oleh sesuatu yang tidak dapat dipercaya oleh siapapun, Paus ukuran raksasa meny',121,' Action, Adventure, Biography','2015-12-05','2015-12-31','imax',8),(2,'POINT BREAK','Agen FBI, Johnny Utah (Luke Bracey) mendapat tugas untuk menyamar ke sebuah organisasi berbahaya. Keahlian Johnny beraksi olahraga ekstrem membuatnya dengan mudah masuk ke dalam kelompok yang dipimpin oleh Bodhi (Edgar Ramirez).',113,' Action, Crime, Sport','2015-12-05','2015-12-31','hd',6);

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `teater` int(11) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `sisa_kursi` int(11) DEFAULT NULL,
  `id_film` int(11) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `jadwal` */

insert  into `jadwal`(`id_jadwal`,`teater`,`jam_mulai`,`jam_selesai`,`sisa_kursi`,`id_film`,`tipe`) values (1,1,'13:30:00','16:00:00',100,1,'2d'),(2,1,'16:00:00','18:30:00',100,1,'2d'),(3,1,'18:30:00','21:00:00',100,1,'2d'),(4,1,'21:00:00','23:30:00',100,1,'2d'),(5,2,'13:30:00','16:00:00',100,2,'2d'),(6,2,'16:00:00','18:30:00',100,2,'2d'),(7,2,'18:30:00','21:00:00',100,2,'2d'),(8,2,'21:00:00','23:30:00',100,2,'2d');

/*Table structure for table `kursi` */

DROP TABLE IF EXISTS `kursi`;

CREATE TABLE `kursi` (
  `id_kursi` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) DEFAULT NULL,
  `no_kursi` varchar(2) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_kursi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kursi` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `privilege` varchar(255) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`username`,`password`,`name`,`privilege`,`saldo`) values ('qonita','qonita','Qonita Luthfia Sutino','umum',200000);

/*Table structure for table `user_reviews` */

DROP TABLE IF EXISTS `user_reviews`;

CREATE TABLE `user_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_film` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `tanggal_review` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `user_reviews` */

insert  into `user_reviews`(`id`,`id_film`,`user`,`rating`,`review`,`tanggal_review`) values (1,1,'qonita',8,'bagus gan','2015-12-08'),(2,2,'qonita',6,'ga suka genre begini','2015-12-08');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
