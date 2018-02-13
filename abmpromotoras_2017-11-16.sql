# ************************************************************
# Sequel Pro SQL dump
# Versión 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.20-0ubuntu0.16.04.1)
# Base de datos: abmpromotoras
# Tiempo de Generación: 2017-11-16 14:13:40 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla clientes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `contacto` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `numerocontacto` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;

INSERT INTO `clientes` (`id`, `nombre`, `contacto`, `numerocontacto`)
VALUES
	(1,'Tigo','Fernando Sanabira','0981232312'),
	(2,'Personal','Maria Vazquez','0971332776');

/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla coordinadores
# ------------------------------------------------------------

DROP TABLE IF EXISTS `coordinadores`;

CREATE TABLE `coordinadores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

LOCK TABLES `coordinadores` WRITE;
/*!40000 ALTER TABLE `coordinadores` DISABLE KEYS */;

INSERT INTO `coordinadores` (`id`, `nombre`, `apellidos`)
VALUES
	(1,'Juan ','Perez'),
	(2,'Maria','Gonzalez');

/*!40000 ALTER TABLE `coordinadores` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla eventos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eventos`;

CREATE TABLE `eventos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `horainicio` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `horafin` varchar(100) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `fecha` varchar(10000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `estado` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `id_cliente` varchar(10000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `costomarca` varchar(10000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `pagopromotora` varchar(10000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `pagocoordinador` varchar(10000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `logistica` varchar(10000) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `nombreevento` varchar(50) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `id_promotora` int(11) DEFAULT NULL,
  `id_coordinador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `eventos` WRITE;
/*!40000 ALTER TABLE `eventos` DISABLE KEYS */;

INSERT INTO `eventos` (`id`, `horainicio`, `horafin`, `fecha`, `estado`, `id_cliente`, `costomarca`, `pagopromotora`, `pagocoordinador`, `logistica`, `nombreevento`, `id_promotora`, `id_coordinador`)
VALUES
	(1,'01:01','01:01','2017-01-01','Pendiente','2','1000','1000','100','Taxi','Concierto',2,2);

/*!40000 ALTER TABLE `eventos` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla promotoras
# ------------------------------------------------------------

DROP TABLE IF EXISTS `promotoras`;

CREATE TABLE `promotoras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `edad` varchar(8) COLLATE latin1_spanish_ci NOT NULL DEFAULT '',
  `estado` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

LOCK TABLES `promotoras` WRITE;
/*!40000 ALTER TABLE `promotoras` DISABLE KEYS */;

INSERT INTO `promotoras` (`id`, `nombre`, `apellidos`, `edad`, `estado`)
VALUES
	(1,'Maria','Perez','21','Libre'),
	(2,'Lorena','Gonzalez','26','Ocupada');

/*!40000 ALTER TABLE `promotoras` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla usuario
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `apellidos` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `dni` varchar(8) COLLATE latin1_spanish_ci NOT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;

INSERT INTO `usuario` (`idusuario`, `nombre`, `apellidos`, `dni`, `estado`)
VALUES
	(1,'Angelo','Uriol','48125800',1),
	(23,'asdf','asdf','asdf',1),
	(24,'sergio','amarila','sadf',1),
	(25,'Angelo','Uriol','48125800',1),
	(26,'asdf','asdf','asdf',1),
	(27,'sergio','amarila','sadf',1),
	(28,'Angelo','Uriol','48125800',1),
	(29,'asdf','asdf','asdf',1),
	(30,'sergio','amarila','sadf',1),
	(31,'Angelo','Uriol','48125800',1),
	(32,'asdf','asdf','asdf',1),
	(33,'sergio','amarila','sadf',1),
	(34,'Angelo','Uriol','48125800',1),
	(35,'asdf','asdf','asdf',1),
	(36,'sergio','amarila','sadf',1),
	(37,'Angelo','Uriol','48125800',1),
	(38,'asdf','asdf','asdf',1),
	(39,'sergio','amarila','sadf',1),
	(40,'Angelo','Uriol','48125800',1),
	(41,'asdf','asdf','asdf',1),
	(42,'sergio','amarila','sadf',0),
	(43,'Angelo','Uriol','48125800',1),
	(44,'asdf','asdf','asdf',1),
	(45,'sergio','amarila','sadf',1),
	(46,'Angelo','Uriol','48125800',1),
	(47,'asdf','asdf','asdf',1),
	(48,'sergio','amarila','sadf',1),
	(49,'Angelo','Uriol','48125800',1),
	(50,'asdf','asdf','asdf',1),
	(51,'sergio','amarila','sadf',1),
	(52,'Angelo','Uriol','48125800',1),
	(53,'asdf','asdf','asdf',1),
	(54,'sergio','amarila','sadf',1),
	(55,'Angelo','Uriol','48125800',1),
	(56,'asdf','asdf','asdf',1),
	(57,'sergio','amarila','sadf',1),
	(58,'Angelo','Uriol','48125800',1),
	(59,'asdf','asdf','asdf',1),
	(60,'sergio','amarila','sadf',1),
	(61,'Angelo','Uriol','48125800',1),
	(62,'asdf','asdf','asdf',1),
	(63,'sergio','amarila','sadf',1),
	(64,'Angelo','Uriol','48125800',1),
	(65,'asdf','asdf','asdf',1),
	(66,'sergio','amarila','sadf',1),
	(67,'Angelo','Uriol','48125800',0),
	(68,'asdf','asdf','asdf',1),
	(69,'sergio','amarila','sadf',1),
	(70,'Angelo','Uriol','48125800',1),
	(71,'asdf','asdf','asdf',1),
	(72,'sergio','amarila','sadf',1),
	(73,'Angelo','Uriol','48125800',1),
	(74,'asdf','asdf','asdf',1),
	(75,'sergio','amarila','sadf',1),
	(76,'Angelo','Uriol','48125800',1),
	(77,'asdf','asdf','asdf',1),
	(78,'sergio','amarila','sadf',1),
	(79,'Angelo','Uriol','48125800',1),
	(80,'asdf','asdf','asdf',1),
	(81,'sergio','amarila','sadf',1),
	(82,'Angelo','Uriol','48125800',1),
	(83,'asdf','asdf','asdf',1),
	(84,'sergio','amarila','sadf',1),
	(85,'Angelo','Uriol','48125800',0),
	(86,'asdf','asdf','asdf',1),
	(87,'sergio','amarila','sadf',1);

/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
