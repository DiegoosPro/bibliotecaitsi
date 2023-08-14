/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - bibliotecaitsi
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bibliotecaitsi` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bibliotecaitsi`;

/*Table structure for table `tab_autores` */

DROP TABLE IF EXISTS `tab_autores`;

CREATE TABLE `tab_autores` (
  `ID_AUTOR` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_AUTOR` varchar(50) DEFAULT NULL,
  `pais_id` int(11) NOT NULL,
  PRIMARY KEY (`ID_AUTOR`,`pais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_autores` */

insert  into `tab_autores`(`ID_AUTOR`,`NOMBRE_AUTOR`,`pais_id`) values (1,'ee',1),(2,'María Gómez',2),(3,'Carlos Rodríguezzzz',3),(20,'EE',1),(21,'diegoeditado',2);

/*Table structure for table `tab_editorial` */

DROP TABLE IF EXISTS `tab_editorial`;

CREATE TABLE `tab_editorial` (
  `ID_EDITORIAL` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_EDITORIAL` varchar(50) DEFAULT NULL,
  `DIRECCION` varchar(50) DEFAULT NULL,
  `TELEFONO_EDITORIAL` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_EDITORIAL`)
) ENGINE=InnoDB AUTO_INCREMENT=33337 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_editorial` */

insert  into `tab_editorial`(`ID_EDITORIAL`,`NOMBRE_EDITORIAL`,`DIRECCION`,`TELEFONO_EDITORIAL`) values (1,'Editorial ABC','Calle Principal 123','123-456-7890'),(2,'Editorial XYZaaq','Avenida Central 456','987-654-3210'),(4,'a','a','1'),(227,'Editorial XYZaaqq','aaeeee','4442');

/*Table structure for table `tab_generos` */

DROP TABLE IF EXISTS `tab_generos`;

CREATE TABLE `tab_generos` (
  `ID_GENERO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_GENERO` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_GENERO`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_generos` */

insert  into `tab_generos`(`ID_GENERO`,`NOMBRE_GENERO`) values (1,'Programación'),(2,'Ciencia Ficción'),(3,'Tecnología');

/*Table structure for table `tab_libros` */

DROP TABLE IF EXISTS `tab_libros`;

CREATE TABLE `tab_libros` (
  `ID_LIBRO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EDITORIAL` int(11) DEFAULT NULL,
  `ID_GENERO` int(11) DEFAULT NULL,
  `ID_MATERIAS` int(11) DEFAULT NULL,
  `ID_AUTOR` int(11) DEFAULT NULL,
  `TITULO` varchar(50) DEFAULT NULL,
  `ANIO_PUBLICACION` date DEFAULT NULL,
  `DISPONIBILIDAD` tinyint(1) DEFAULT NULL,
  `IMAGEN` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_LIBRO`),
  KEY `FK_REFERENCE_1` (`ID_EDITORIAL`),
  KEY `FK_REFERENCE_2` (`ID_GENERO`),
  KEY `FK_REFERENCE_3` (`ID_MATERIAS`),
  KEY `FK_REFERENCE_4` (`ID_AUTOR`),
  CONSTRAINT `FK_REFERENCE_1` FOREIGN KEY (`ID_EDITORIAL`) REFERENCES `tab_editorial` (`ID_EDITORIAL`),
  CONSTRAINT `FK_REFERENCE_2` FOREIGN KEY (`ID_GENERO`) REFERENCES `tab_generos` (`ID_GENERO`),
  CONSTRAINT `FK_REFERENCE_3` FOREIGN KEY (`ID_MATERIAS`) REFERENCES `tab_materias` (`ID_MATERIAS`),
  CONSTRAINT `FK_REFERENCE_4` FOREIGN KEY (`ID_AUTOR`) REFERENCES `tab_autores` (`ID_AUTOR`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_libros` */

insert  into `tab_libros`(`ID_LIBRO`,`ID_EDITORIAL`,`ID_GENERO`,`ID_MATERIAS`,`ID_AUTOR`,`TITULO`,`ANIO_PUBLICACION`,`DISPONIBILIDAD`,`IMAGEN`) values (1,1,1,2,1,'Desarrollo Ágil de Softwarees','2020-01-01',1,'sinimagen.jpeg'),(2,2,3,2,20,'Viaje a las Estrellaszzz','2020-01-01',1,'foto_2.jpg'),(3,2,1,1,1,'Introducción a la Inteligencia Artificialaa','2019-09-20',0,'foto_3.jpg'),(20,NULL,2,2,1,'1','0000-00-00',127,'0'),(21,NULL,2,1,2,'3','0000-00-00',127,'1'),(22,NULL,2,1,1,'20','0000-00-00',127,'1'),(23,NULL,2,1,3,'21','0000-00-00',127,'1'),(25,NULL,1,2,1,'1','0000-00-00',127,'0'),(26,NULL,2,1,3,'1','0000-00-00',127,'1'),(27,4,2,2,1,'21','0000-00-00',127,'1');

/*Table structure for table `tab_materias` */

DROP TABLE IF EXISTS `tab_materias`;

CREATE TABLE `tab_materias` (
  `ID_MATERIAS` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_MATERIA` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_MATERIAS`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_materias` */

insert  into `tab_materias`(`ID_MATERIAS`,`NOMBRE_MATERIA`) values (1,'Ingeniería de Software'),(2,'Bases de Datos'),(3,'Inteligencia Artificial'),(4,'zzsssxx'),(5,'vvvv');

/*Table structure for table `tab_paises` */

DROP TABLE IF EXISTS `tab_paises`;

CREATE TABLE `tab_paises` (
  `pais_id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_nombre` varchar(50) DEFAULT NULL,
  `pais_gentilicio` varchar(50) DEFAULT NULL,
  `pais_activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`pais_id`),
  CONSTRAINT `tab_paises_ibfk_1` FOREIGN KEY (`pais_id`) REFERENCES `tab_autores` (`ID_AUTOR`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_paises` */

insert  into `tab_paises`(`pais_id`,`pais_nombre`,`pais_gentilicio`,`pais_activo`) values (1,'Colombia','Colombiana',1),(2,'Ecuador','Ecuatoriana',1),(3,'Chile','Chilena',1);

/*Table structure for table `tab_perfil` */

DROP TABLE IF EXISTS `tab_perfil`;

CREATE TABLE `tab_perfil` (
  `PER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PER_NOMBRE` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`PER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_perfil` */

insert  into `tab_perfil`(`PER_ID`,`PER_NOMBRE`) values (1,'Administrador'),(2,'Bibliotecario'),(3,'Estudiante');

/*Table structure for table `tab_users` */

DROP TABLE IF EXISTS `tab_users`;

CREATE TABLE `tab_users` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PER_ID` int(11) DEFAULT NULL,
  `USER_USUARIO` varchar(30) DEFAULT NULL,
  `USER_CONTRA` varchar(30) DEFAULT NULL,
  `USER_NOMBRE` varchar(30) DEFAULT NULL,
  `USER_ACTIVO` tinyint(1) DEFAULT NULL,
  `USER_CREATE_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `USER_FOTO` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  KEY `FK_REFERENCE_6` (`PER_ID`),
  CONSTRAINT `FK_REFERENCE_6` FOREIGN KEY (`PER_ID`) REFERENCES `tab_perfil` (`PER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tab_users` */

insert  into `tab_users`(`USER_ID`,`PER_ID`,`USER_USUARIO`,`USER_CONTRA`,`USER_NOMBRE`,`USER_ACTIVO`,`USER_CREATE_AT`,`USER_FOTO`) values (1,1,'admin','admin','DIEGO CACUANGO',1,'2023-08-11 18:59:59','user.png'),(2,2,'pepe','123','ALEX FLORES',1,'2023-08-11 19:00:08','diegos.png');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
