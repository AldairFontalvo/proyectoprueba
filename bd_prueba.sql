/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.7.24 : Database - bd_prueba
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bd_prueba` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `bd_prueba`;

/*Table structure for table `ma_automoviles` */

DROP TABLE IF EXISTS `ma_automoviles`;

CREATE TABLE `ma_automoviles` (
  `Auto_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Auto_name` char(100) DEFAULT NULL,
  `Auto_modelo` char(100) DEFAULT NULL,
  `Auto_marca` char(100) DEFAULT NULL,
  `Auto_departamento` char(100) DEFAULT NULL,
  `fechacreate` datetime DEFAULT NULL,
  `fechaUpdate` datetime DEFAULT NULL,
  PRIMARY KEY (`Auto_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `ma_automoviles` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
