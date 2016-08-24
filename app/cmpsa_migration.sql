-- MySQL dump 10.13  Distrib 5.5.50, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cmpsa_migration
-- ------------------------------------------------------
-- Server version	5.5.50-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `agentes`
--

DROP TABLE IF EXISTS `agentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_agentes_empresas` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agentes`
--

LOCK TABLES `agentes` WRITE;
/*!40000 ALTER TABLE `agentes` DISABLE KEYS */;
INSERT INTO `agentes` VALUES (59,NULL,NULL),(60,NULL,NULL),(64,'2015-05-26 14:22:05','2015-05-26 14:22:05'),(87,'2015-07-24 17:06:33','2015-07-24 17:06:33'),(105,'2015-09-15 14:39:35','2015-09-15 14:39:35');
/*!40000 ALTER TABLE `agentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `almacen_repartos`
--

DROP TABLE IF EXISTS `almacen_repartos`;
/*!50001 DROP VIEW IF EXISTS `almacen_repartos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `almacen_repartos` (
  `id` tinyint NOT NULL,
  `cuenta_almacen` tinyint NOT NULL,
  `cantidad_cuenta` tinyint NOT NULL,
  `asociado_id` tinyint NOT NULL,
  `porcentaje_embalaje_asociado` tinyint NOT NULL,
  `sacos_asignados` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `almacen_transporte_asociados`
--

DROP TABLE IF EXISTS `almacen_transporte_asociados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen_transporte_asociados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asociado_id` int(11) NOT NULL,
  `almacen_transporte_id` int(11) NOT NULL,
  `sacos_asignados` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_table1_asociados1_idx` (`asociado_id`),
  KEY `fk_table1_almacen_transportes1_idx` (`almacen_transporte_id`),
  CONSTRAINT `fk_table1_almacen_transportes1` FOREIGN KEY (`almacen_transporte_id`) REFERENCES `almacen_transportes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_table1_asociados1` FOREIGN KEY (`asociado_id`) REFERENCES `asociados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen_transporte_asociados`
--

LOCK TABLES `almacen_transporte_asociados` WRITE;
/*!40000 ALTER TABLE `almacen_transporte_asociados` DISABLE KEYS */;
INSERT INTO `almacen_transporte_asociados` VALUES (43,68,17,1,'2016-06-16 11:31:37','2016-06-16 11:31:37'),(44,78,17,4,'2016-06-16 11:31:37','2016-06-16 11:31:37'),(45,81,17,6,'2016-06-16 11:31:37','2016-06-16 11:31:37'),(48,79,18,29,'2016-06-16 12:27:12','2016-06-16 12:27:12'),(50,75,20,10,'2016-06-17 10:57:42','2016-06-17 10:57:42'),(51,75,21,1,'2016-06-17 11:10:29','2016-06-17 11:10:29'),(118,78,24,3,'2016-06-20 16:54:59','2016-06-20 16:54:59'),(134,68,27,7,'2016-06-20 17:21:26','2016-06-20 17:21:26'),(135,77,27,3,'2016-06-20 17:21:26','2016-06-20 17:21:26'),(136,78,27,18,'2016-06-20 17:21:26','2016-06-20 17:21:26'),(137,79,27,9,'2016-06-20 17:21:27','2016-06-20 17:21:27'),(138,80,27,21,'2016-06-20 17:21:27','2016-06-20 17:21:27'),(139,81,27,41,'2016-06-20 17:21:27','2016-06-20 17:21:27'),(154,78,30,2,'2016-06-23 10:08:29','2016-06-23 10:08:29'),(155,68,23,13,'2016-06-23 10:33:55','2016-06-23 10:33:55'),(156,77,23,4,'2016-06-23 10:33:56','2016-06-23 10:33:56'),(157,78,23,10,'2016-06-23 10:33:56','2016-06-23 10:33:56'),(158,79,23,3,'2016-06-23 10:33:56','2016-06-23 10:33:56'),(159,80,23,7,'2016-06-23 10:33:56','2016-06-23 10:33:56'),(160,81,23,18,'2016-06-23 10:33:56','2016-06-23 10:33:56'),(161,82,23,28,'2016-06-23 10:33:57','2016-06-23 10:33:57'),(162,83,23,14,'2016-06-23 10:33:57','2016-06-23 10:33:57'),(163,84,23,9,'2016-06-23 10:33:57','2016-06-23 10:33:57'),(192,68,44,1,'2016-06-24 18:28:47','2016-06-24 18:28:47'),(193,77,44,4,'2016-06-24 18:28:47','2016-06-24 18:28:47'),(194,78,44,10,'2016-06-24 18:28:48','2016-06-24 18:28:48'),(195,81,44,10,'2016-06-24 18:28:48','2016-06-24 18:28:48'),(207,68,45,5,'2016-06-24 18:47:36','2016-06-24 18:47:36'),(208,77,45,2,'2016-06-24 18:47:37','2016-06-24 18:47:37'),(209,78,45,14,'2016-06-24 18:47:37','2016-06-24 18:47:37'),(210,81,45,19,'2016-06-24 18:47:37','2016-06-24 18:47:37'),(211,68,46,22,'2016-07-28 13:31:26','2016-07-28 13:31:26'),(212,78,46,78,'2016-07-28 13:31:26','2016-07-28 13:31:26'),(213,79,46,56,'2016-07-28 13:31:26','2016-07-28 13:31:26'),(214,81,46,244,'2016-07-28 13:31:26','2016-07-28 13:31:26'),(233,68,47,1,'2016-08-01 13:16:03','2016-08-01 13:16:03'),(234,77,47,1,'2016-08-01 13:16:03','2016-08-01 13:16:03'),(235,78,47,5,'2016-08-01 13:16:04','2016-08-01 13:16:04'),(236,79,47,1,'2016-08-01 13:16:04','2016-08-01 13:16:04'),(237,80,47,4,'2016-08-01 13:16:04','2016-08-01 13:16:04'),(238,81,47,10,'2016-08-01 13:16:04','2016-08-01 13:16:04'),(239,82,47,15,'2016-08-01 13:16:05','2016-08-01 13:16:05'),(240,83,47,8,'2016-08-01 13:16:05','2016-08-01 13:16:05'),(241,84,47,5,'2016-08-01 13:16:05','2016-08-01 13:16:05'),(242,82,42,3,'2016-08-01 19:02:01','2016-08-01 19:02:01'),(243,79,19,1,'2016-08-01 19:44:09','2016-08-01 19:44:09'),(245,82,48,120,'2016-08-01 19:49:41','2016-08-01 19:49:41'),(249,75,49,0,'2016-08-02 13:20:50','2016-08-02 13:20:50'),(250,83,49,54,'2016-08-02 13:20:50','2016-08-02 13:20:50'),(251,84,49,18,'2016-08-02 13:20:50','2016-08-02 13:20:50');
/*!40000 ALTER TABLE `almacen_transporte_asociados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `almacen_transportes`
--

DROP TABLE IF EXISTS `almacen_transportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacen_transportes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen_id` int(11) NOT NULL,
  `transporte_id` int(11) NOT NULL,
  `cuenta_almacen` varchar(45) DEFAULT NULL,
  `cantidad_cuenta` decimal(5,2) DEFAULT NULL,
  `peso_bruto` decimal(8,2) DEFAULT NULL,
  `marca_almacen` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_almacenes_has_transportes_transportes1_idx` (`transporte_id`),
  KEY `fk_almacenes_has_transportes_almacenes1_idx` (`almacen_id`),
  CONSTRAINT `fk_almacenes_has_transportes_almacenes1` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_almacenes_has_transportes_transportes1` FOREIGN KEY (`transporte_id`) REFERENCES `transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen_transportes`
--

LOCK TABLES `almacen_transportes` WRITE;
/*!40000 ALTER TABLE `almacen_transportes` DISABLE KEYS */;
INSERT INTO `almacen_transportes` VALUES (12,50,80,'2015/05021',2.00,2000.00,'002/1145/0658','2016-04-26 11:24:52','2016-06-15 15:19:24'),(17,59,98,'MOL1',10.00,10000.00,'85/4785','2016-06-16 11:31:28','2016-06-16 11:31:28'),(18,58,106,'BIT12',30.00,30000.00,'821/54132','2016-06-16 12:26:39','2016-06-16 12:26:39'),(19,60,106,'Pac456',3.00,210.00,'528784/2154','2016-06-16 12:43:12','2016-06-16 12:43:12'),(20,61,108,'RKO85',10.00,700.00,'','2016-06-17 10:57:31','2016-06-17 10:57:31'),(21,58,114,'BIT64',2.00,2000.00,'88525/6614','2016-06-17 11:10:18','2016-06-17 11:11:05'),(23,61,115,'85HTY',95.00,95000.00,'','2016-06-17 12:51:05','2016-06-17 12:51:05'),(24,58,82,'BIT34T',2.00,140.00,'88/88','2016-06-20 16:54:44','2016-06-20 17:04:46'),(27,60,116,'PACO12',100.00,7000.00,'RRR/55324','2016-06-20 17:07:42','2016-06-20 17:07:42'),(30,61,84,'Eur',2.00,2000.00,'222/222','2016-06-23 10:08:12','2016-06-23 10:08:12'),(42,58,95,'ere',4.00,280.00,'','2016-06-23 13:27:55','2016-06-23 13:41:35'),(44,58,117,'Bit_117_1',25.00,25000.00,'159/584','2016-06-24 18:28:23','2016-06-24 18:28:23'),(45,59,117,'Molen_117_2',40.00,40000.00,'852/963','2016-06-24 18:46:56','2016-06-24 18:46:56'),(46,61,119,'Euro125',400.00,24000.00,'','2016-07-28 13:31:00','2016-07-28 13:31:00'),(47,59,78,'Molen43',50.00,35000.00,'','2016-08-01 13:15:54','2016-08-01 13:15:54'),(48,58,88,'bit22',115.00,120000.00,'123/123','2016-08-01 19:49:27','2016-08-01 19:51:17'),(49,60,80,'Paco897',90.00,90000.00,'213123/2131','2016-08-02 13:19:47','2016-08-02 13:19:47');
/*!40000 ALTER TABLE `almacen_transportes` ENABLE KEYS */;
UNLOCK TABLES;
ALTER DATABASE `cmpsa_migration` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`cmpsa`@`localhost`*/ /*!50003 TRIGGER `cmpsa_migration`.`almacen_transportes_AFTER_INSERT` AFTER INSERT ON `almacen_transportes` FOR EACH ROW BEGIN INSERT INTO almacen_transporte_asociados (almacen_transporte_id, asociado_id, sacos_asignados, created, modified ) SELECT a.id, a.asociado_id, a.sacos_asignados, NOW(), NOW() FROM almacen_repartos a WHERE a.id=NEW.id ; END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `cmpsa_migration` CHARACTER SET utf8 COLLATE utf8_general_ci ;

--
-- Table structure for table `almacenes`
--

DROP TABLE IF EXISTS `almacenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `almacenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_almacenes_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacenes`
--

LOCK TABLES `almacenes` WRITE;
/*!40000 ALTER TABLE `almacenes` DISABLE KEYS */;
INSERT INTO `almacenes` VALUES (50,'2015-03-10 12:52:00','2015-03-10 13:29:35'),(58,'2015-04-08 17:18:29','2015-05-05 16:10:39'),(59,'2015-04-08 17:19:46','2015-05-05 16:11:17'),(60,'2015-04-08 17:20:25','2015-05-05 16:11:45'),(61,'2015-04-08 17:20:57','2015-04-08 17:20:57');
/*!40000 ALTER TABLE `almacenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anticipos`
--

DROP TABLE IF EXISTS `anticipos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anticipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asociado_operacion_id` int(11) NOT NULL,
  `banco_id` int(11) NOT NULL,
  `importe` decimal(8,2) NOT NULL,
  `fecha_conta` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_anticipos_bancos1_idx` (`banco_id`),
  KEY `fk_anticipos_asociado_operaciones1_idx` (`asociado_operacion_id`),
  CONSTRAINT `fk_anticipos_asociado_operaciones1` FOREIGN KEY (`asociado_operacion_id`) REFERENCES `asociado_operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_anticipos_bancos1` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anticipos`
--

LOCK TABLES `anticipos` WRITE;
/*!40000 ALTER TABLE `anticipos` DISABLE KEYS */;
INSERT INTO `anticipos` VALUES (1,191,26,57893.06,'2015-11-26','2015-11-26 01:01:58','2016-07-19 13:12:13'),(2,192,26,2000.00,'2015-11-26','2015-11-26 14:07:46','2016-07-19 16:26:26'),(3,377,26,3000.00,'2015-11-26','2015-11-26 14:16:06','2015-11-26 14:20:51'),(4,193,26,5000.00,'2015-11-26','2015-11-26 14:32:36','2016-07-19 16:31:24'),(6,508,3,1000.01,'2016-07-20','2016-07-21 00:01:01','2016-07-25 23:39:16'),(8,192,26,171000.00,'2016-07-26','2016-07-26 17:55:49','2016-07-26 17:55:49'),(9,192,26,679.15,'2016-07-26','2016-07-26 17:56:23','2016-07-26 17:56:23'),(10,193,26,52893.06,'2016-07-26','2016-07-26 17:56:48','2016-07-26 17:57:24');
/*!40000 ALTER TABLE `anticipos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aseguradoras`
--

DROP TABLE IF EXISTS `aseguradoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aseguradoras` (
  `id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_aseguradoras_empresas` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aseguradoras`
--

LOCK TABLES `aseguradoras` WRITE;
/*!40000 ALTER TABLE `aseguradoras` DISABLE KEYS */;
INSERT INTO `aseguradoras` VALUES (89,NULL,NULL),(90,NULL,NULL),(91,NULL,NULL),(93,NULL,NULL);
/*!40000 ALTER TABLE `aseguradoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asociado_comisiones`
--

DROP TABLE IF EXISTS `asociado_comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asociado_comisiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asociado_id` int(11) NOT NULL,
  `comision_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asociados_has_comisiones_comisiones1_idx` (`comision_id`),
  KEY `fk_asociados_has_comisiones_asociados1_idx` (`asociado_id`),
  CONSTRAINT `fk_asociados_has_comisiones_asociados1` FOREIGN KEY (`asociado_id`) REFERENCES `asociados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asociados_has_comisiones_comisiones1` FOREIGN KEY (`comision_id`) REFERENCES `comisiones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asociado_comisiones`
--

LOCK TABLES `asociado_comisiones` WRITE;
/*!40000 ALTER TABLE `asociado_comisiones` DISABLE KEYS */;
INSERT INTO `asociado_comisiones` VALUES (1,68,1,'2015-01-01','0000-00-00',NULL,NULL),(2,75,2,'2015-01-01','0000-00-00',NULL,NULL),(3,76,2,'2015-01-01','2015-12-31',NULL,NULL),(4,77,2,'2015-01-01','2015-12-31',NULL,NULL),(5,78,2,'2015-01-01','2015-12-31',NULL,NULL),(6,79,2,'2015-01-01','2015-12-31',NULL,NULL),(7,80,2,'2015-01-01','2015-12-31',NULL,NULL),(8,81,2,'2015-01-01','2015-12-31',NULL,NULL),(9,82,2,'2015-01-01','2015-12-31',NULL,NULL),(10,83,2,'2015-01-01','2015-12-31',NULL,NULL),(11,84,2,'2015-01-01','2015-12-31','2015-11-13 14:42:20','2015-11-13 14:42:20');
/*!40000 ALTER TABLE `asociado_comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asociado_operaciones`
--

DROP TABLE IF EXISTS `asociado_operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asociado_operaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operacion_id` int(11) NOT NULL,
  `asociado_id` int(11) NOT NULL,
  `cantidad_embalaje_asociado` mediumint(9) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asociados_has_linea_contratos_asociados1_idx` (`asociado_id`),
  KEY `fk_asociados_has_linea_contratos_linea_contratos1_idx` (`operacion_id`),
  CONSTRAINT `fk_asociado_linea_contratos_asociados1` FOREIGN KEY (`asociado_id`) REFERENCES `asociados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asociado_linea_contratos_linea_contratos1` FOREIGN KEY (`operacion_id`) REFERENCES `operaciones` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=545 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asociado_operaciones`
--

LOCK TABLES `asociado_operaciones` WRITE;
/*!40000 ALTER TABLE `asociado_operaciones` DISABLE KEYS */;
INSERT INTO `asociado_operaciones` VALUES (191,27,75,20,'2015-08-18 14:40:09','2015-08-18 14:40:09'),(192,27,83,60,'2015-08-18 14:40:09','2015-08-18 14:40:09'),(193,27,84,20,'2015-08-18 14:40:09','2015-08-18 14:40:09'),(245,32,78,275,'2015-10-08 17:57:10','2015-10-08 17:57:10'),(246,33,75,20,'2015-10-08 18:33:11','2015-10-08 18:33:11'),(247,33,83,40,'2015-10-08 18:33:11','2015-10-08 18:33:11'),(248,34,82,40,'2015-10-08 18:34:00','2015-10-08 18:34:00'),(249,35,83,20,'2015-10-08 18:37:58','2015-10-08 18:37:58'),(250,35,84,20,'2015-10-08 18:37:58','2015-10-08 18:37:58'),(251,36,82,60,'2015-10-08 18:46:32','2015-10-08 18:46:32'),(331,43,68,35,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(332,43,77,47,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(333,43,78,225,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(334,43,79,60,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(335,43,80,150,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(336,43,81,400,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(337,43,82,626,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(338,43,83,314,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(339,43,84,190,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(377,46,68,17,'2015-11-13 13:18:32','2015-11-13 13:18:32'),(378,46,78,125,'2015-11-13 13:18:32','2015-11-13 13:18:32'),(379,46,81,190,'2015-11-13 13:18:32','2015-11-13 13:18:32'),(461,55,68,17,'2016-04-26 15:21:09','2016-04-26 15:21:09'),(462,55,77,7,'2016-04-26 15:21:09','2016-04-26 15:21:09'),(463,55,78,125,'2016-04-26 15:21:09','2016-04-26 15:21:09'),(464,55,81,170,'2016-04-26 15:21:09','2016-04-26 15:21:09'),(476,63,82,20,'2016-04-26 15:32:21','2016-04-26 15:32:21'),(477,53,68,67,'2016-04-26 15:44:30','2016-04-26 15:44:30'),(478,53,77,27,'2016-04-26 15:44:30','2016-04-26 15:44:30'),(479,53,78,175,'2016-04-26 15:44:30','2016-04-26 15:44:30'),(480,53,79,85,'2016-04-26 15:44:30','2016-04-26 15:44:30'),(481,53,80,205,'2016-04-26 15:44:30','2016-04-26 15:44:30'),(482,53,81,401,'2016-04-26 15:44:30','2016-04-26 15:44:30'),(483,64,68,35,'2016-04-26 17:06:18','2016-04-26 17:06:18'),(484,64,78,125,'2016-04-26 17:06:18','2016-04-26 17:06:18'),(485,64,79,90,'2016-04-26 17:06:18','2016-04-26 17:06:18'),(486,64,81,390,'2016-04-26 17:06:18','2016-04-26 17:06:18'),(487,65,84,20,'2016-04-26 18:04:13','2016-04-26 18:04:13'),(488,66,82,120,'2016-04-26 18:12:09','2016-04-26 18:12:09'),(489,49,75,132,'2016-04-26 18:14:33','2016-04-26 18:14:33'),(490,49,76,50,'2016-04-26 18:14:33','2016-04-26 18:14:33'),(491,49,77,58,'2016-04-26 18:14:33','2016-04-26 18:14:33'),(492,49,80,5,'2016-04-26 18:14:33','2016-04-26 18:14:33'),(493,60,75,30,'2016-04-26 18:48:01','2016-04-26 18:48:01'),(494,60,79,60,'2016-04-26 18:48:01','2016-04-26 18:48:01'),(495,60,80,60,'2016-04-26 18:48:01','2016-04-26 18:48:01'),(496,60,81,50,'2016-04-26 18:48:01','2016-04-26 18:48:01'),(497,60,83,158,'2016-04-26 18:48:01','2016-04-26 18:48:01'),(498,60,84,125,'2016-04-26 18:48:02','2016-04-26 18:48:02'),(499,62,82,48,'2016-04-26 18:49:29','2016-04-26 18:49:29'),(500,45,68,35,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(501,45,77,94,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(502,45,78,225,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(503,45,79,70,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(504,45,80,150,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(505,45,81,400,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(506,45,82,626,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(507,45,83,314,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(508,45,84,190,'2016-04-26 18:56:33','2016-04-26 18:56:33'),(510,67,75,96,'2016-04-26 19:10:58','2016-04-26 19:10:58'),(520,44,68,35,'2016-05-06 11:58:23','2016-05-06 11:58:23'),(521,44,77,47,'2016-05-06 11:58:23','2016-05-06 11:58:23'),(522,44,78,225,'2016-05-06 11:58:23','2016-05-06 11:58:23'),(523,44,79,60,'2016-05-06 11:58:24','2016-05-06 11:58:24'),(524,44,80,150,'2016-05-06 11:58:24','2016-05-06 11:58:24'),(525,44,81,400,'2016-05-06 11:58:24','2016-05-06 11:58:24'),(526,44,82,626,'2016-05-06 11:58:24','2016-05-06 11:58:24'),(527,44,83,314,'2016-05-06 11:58:24','2016-05-06 11:58:24'),(528,44,84,190,'2016-05-06 11:58:24','2016-05-06 11:58:24'),(533,68,79,80,'2016-06-16 13:21:34','2016-06-16 13:21:34'),(534,71,68,2000,'2016-06-27 23:20:38','2016-06-27 23:20:38'),(535,71,75,500,'2016-06-27 23:20:38','2016-06-27 23:20:38'),(536,72,68,50,'2016-07-06 00:16:32','2016-07-06 00:16:32'),(537,73,76,1000,'2016-07-06 00:29:45','2016-07-06 00:29:45'),(538,74,77,20,'2016-07-06 00:30:33','2016-07-06 00:30:33'),(539,75,82,30,'2016-07-06 00:32:00','2016-07-06 00:32:00'),(540,31,75,469,'2016-07-29 16:56:33','2016-07-29 16:56:33'),(541,31,77,117,'2016-07-29 16:56:33','2016-07-29 16:56:33'),(542,31,82,164,'2016-07-29 16:56:33','2016-07-29 16:56:33'),(544,57,83,34,'2016-08-01 19:34:46','2016-08-01 19:34:46');
/*!40000 ALTER TABLE `asociado_operaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asociados`
--

DROP TABLE IF EXISTS `asociados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asociados` (
  `id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_asociados_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asociados`
--

LOCK TABLES `asociados` WRITE;
/*!40000 ALTER TABLE `asociados` DISABLE KEYS */;
INSERT INTO `asociados` VALUES (68,'2015-07-08 02:55:16','2015-07-14 12:45:22'),(75,'2015-07-14 12:40:48','2015-07-14 12:46:08'),(76,'2015-07-14 12:48:24','2015-07-14 12:50:49'),(77,'2015-07-14 12:50:15','2015-07-14 12:50:15'),(78,'2015-07-14 12:52:19','2015-07-14 12:52:19'),(79,'2015-07-14 12:54:02','2015-07-14 12:54:02'),(80,'2015-07-14 12:55:27','2015-07-14 12:55:27'),(81,'2015-07-14 12:56:53','2015-07-14 12:56:53'),(82,'2015-07-14 12:58:27','2015-07-14 12:58:27'),(83,'2015-07-14 13:00:16','2015-07-14 13:00:16'),(84,'2015-07-14 13:01:53','2015-08-18 14:41:23');
/*!40000 ALTER TABLE `asociados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bancos`
--

DROP TABLE IF EXISTS `bancos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bancos` (
  `id` int(11) NOT NULL,
  `cuenta_cliente_1` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_bancos_pruebas_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bancos`
--

LOCK TABLES `bancos` WRITE;
/*!40000 ALTER TABLE `bancos` DISABLE KEYS */;
INSERT INTO `bancos` VALUES (3,NULL),(4,NULL),(14,NULL),(15,NULL),(16,NULL),(17,NULL),(18,NULL),(26,NULL),(86,'');
/*!40000 ALTER TABLE `bancos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `calidad_nombres`
--

DROP TABLE IF EXISTS `calidad_nombres`;
/*!50001 DROP VIEW IF EXISTS `calidad_nombres`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `calidad_nombres` (
  `id` tinyint NOT NULL,
  `nombre` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `calidades`
--

DROP TABLE IF EXISTS `calidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descafeinado` tinyint(1) unsigned zerofill NOT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `descripcion` varchar(80) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`descafeinado`,`pais_id`,`descripcion`) USING BTREE,
  KEY `fk_calidades_paises1_idx` (`pais_id`),
  KEY `descripcion` (`descripcion`),
  KEY `descafeinado` (`descafeinado`),
  CONSTRAINT `fk_calidades_paises1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calidades`
--

LOCK TABLES `calidades` WRITE;
/*!40000 ALTER TABLE `calidades` DISABLE KEYS */;
INSERT INTO `calidades` VALUES (5,0,2,'Huila Excelso Criba 16','2015-03-12 23:59:58','2015-04-11 00:41:36'),(6,1,1,'N.Y.4, MTGB Duro limpio EA Process','2015-03-13 00:06:32','2015-03-17 15:29:24'),(8,0,1,'N.Y.4, 17/18,Duro Limpio','2015-03-16 10:31:51','2015-03-16 15:05:13'),(9,0,8,'AA Top','2015-03-16 10:37:26','2015-03-16 16:08:06'),(10,0,12,'S.H.G. Criba 16 Up','2015-03-16 10:37:59','2015-03-16 15:06:12'),(11,1,NULL,'Colombia/Brasil/Uganda( 30%,30%,40%)','2015-03-16 10:38:58','2015-03-16 17:58:04'),(12,0,14,'Robusta Criba 18 Limpio','2015-03-16 17:34:38','2015-03-17 09:59:03'),(23,0,1,'N.Y.4,17/18,Strictly Soft,Fine Roast','2015-03-16 23:05:51','2015-03-17 10:00:44'),(24,0,20,'Sidamo Grado 2','2015-03-16 23:06:57','2015-03-17 10:00:59'),(25,1,14,'Robusta Grado 2 (5%) EA Process','2015-03-17 12:00:42','2015-03-17 12:00:42'),(27,1,NULL,'Central American Blend','2015-08-11 15:12:26','2015-10-16 10:53:20'),(28,0,2,'Supremo Criba 17/18','2015-10-08 17:18:14','2015-10-16 10:55:51'),(29,0,2,'Supremo Criba 18','2015-10-08 17:31:09','2015-10-16 10:55:32'),(30,0,25,'HG \"Montecristo\"','2015-10-08 17:42:46','2015-10-08 17:42:46'),(32,0,23,'SHB EP Fancy 16 Arriba','2015-10-08 17:53:30','2015-10-16 10:54:54'),(37,0,2,'Excelso Criba 16','2015-10-16 10:56:48','2015-10-16 10:56:48'),(38,0,4,'AA Plus','2015-10-16 10:59:15','2015-10-16 10:59:15'),(39,0,23,'SHB Tarrazú','2015-10-16 11:00:43','2015-10-16 11:00:43'),(40,1,1,'N.Y.2/3,17/18,Duro Limpio, Cloruro Metileno','2015-10-16 11:03:22','2015-10-20 09:47:46'),(41,1,14,'Robusta Grado 2 (5%) Cloruro de Metileno','2015-10-16 11:03:52','2015-10-19 12:19:07'),(42,0,1,'N.Y.4,M.T.G.B.Duro Limpio','2015-10-19 11:45:35','2015-10-19 11:45:35'),(43,0,1,'Grinders 100 defectos,Criba 13+,Bebida Dura','2015-10-19 11:49:09','2015-10-19 12:14:32'),(44,0,2,'Nariño Supremo Criba 17/18 El Tambo','2015-10-19 11:51:01','2015-10-19 13:31:48'),(45,0,4,'AA FAQ','2015-10-19 11:52:01','2015-10-19 11:52:01'),(46,0,8,'AA Plus','2015-10-19 11:52:29','2015-10-19 11:52:29'),(47,0,8,'AA FAQ','2015-10-19 11:53:37','2015-10-19 11:53:37'),(48,0,8,'AB Top','2015-10-19 11:53:57','2015-10-19 11:53:57'),(49,0,8,'AB Plus','2015-10-19 11:54:14','2015-10-19 11:54:14'),(51,0,14,'Robusta Grado 2, 5%','2015-10-19 11:57:26','2015-10-19 11:57:26'),(52,0,14,'Robusta Grado 1,Criba 16','2015-10-19 11:58:19','2015-10-19 11:58:19'),(53,0,20,'Yirgacheffe Grado 2','2015-10-19 11:59:48','2015-10-19 11:59:48'),(54,0,1,'N.Y.2,Criba 19, Duro Limpio','2015-10-19 12:01:52','2015-10-19 12:01:52'),(55,0,1,'N.Y.2,Criba 19,Strictly Soft,Fine Roast','2015-10-19 12:02:38','2015-10-19 12:02:38'),(56,1,NULL,'Arábica Otros Suaves Criba 16','2015-10-19 12:03:45','2016-07-28 20:03:55'),(57,1,2,'Supremo Criba 17/18','2015-10-19 12:05:39','2015-10-19 12:05:39'),(58,0,12,'S.H.B. Criba 17/18,Ocotal','2015-10-19 12:16:46','2015-10-19 12:16:46'),(59,0,12,'S.H.G. Criba 19','2015-10-19 12:17:14','2015-10-19 12:17:14'),(60,0,12,'S.H.G. Criba 17/18,Lapa','2015-10-19 12:18:01','2015-10-19 12:18:01'),(61,0,24,'S.H.B. Criba 16','2015-10-19 12:28:46','2015-10-19 12:28:46'),(62,0,24,'S.H.B. Genuino Antigua','2015-10-19 12:29:16','2015-10-19 12:29:16'),(63,0,24,'S.H.B. Tipo Antigua','2015-10-19 12:29:45','2015-10-20 10:05:48'),(64,0,26,'Cherry AB Criba 17','2015-10-19 12:31:13','2015-10-19 12:31:13'),(65,0,26,'Cherry AA Criba 18','2015-10-19 12:31:59','2015-10-19 12:31:59'),(66,0,26,'Plantación A Criba 17','2015-10-19 12:32:32','2015-10-19 12:32:32'),(67,0,26,'Plantación AA Criba 18','2015-10-19 12:32:57','2015-10-19 12:32:57'),(68,0,26,'Parchment Criba 18','2015-10-19 12:33:50','2015-10-19 12:33:50'),(69,0,26,'Kaapi Royal Criba 17','2015-10-19 12:34:20','2015-10-19 12:58:29'),(70,0,19,'Java Lavado Jampit','2015-10-19 12:35:17','2015-10-19 12:35:17'),(71,0,19,'Java Lavado Blawan','2015-10-19 12:35:36','2015-10-19 12:35:36'),(72,0,19,'Java Lavado Pancur','2015-10-19 12:35:59','2015-10-19 12:35:59'),(73,0,34,'Blue Mountain Grado 1','2015-10-19 12:38:48','2015-10-19 12:38:48'),(74,0,19,'Sumatra Kopi Luwak','2015-10-19 12:46:19','2015-10-19 12:57:53'),(75,0,36,'Robusta Criba 18','2015-10-19 13:01:06','2015-10-19 13:01:06'),(76,0,36,'Robusta Standard (Criba 15)','2015-10-19 13:01:42','2015-10-19 13:01:42'),(77,0,36,'Robusta Criba 12','2015-10-19 13:02:05','2015-10-19 13:02:05'),(78,0,36,'Robusta Lavado Criba 18','2015-10-19 13:02:33','2015-10-19 13:02:33'),(79,0,14,'Robusta Criba 18 Wet Polished','2015-10-19 13:04:18','2015-10-19 13:04:18'),(80,0,14,'Robusta Criba 18 Dep Lam','2015-10-19 13:05:40','2015-10-19 13:05:40'),(81,0,37,'Sigri A','2015-10-19 13:12:56','2015-10-19 13:12:56'),(82,0,1,'Conilón N.Y.5/6, Criba 13 +','2015-10-19 13:15:35','2015-10-19 13:15:35'),(83,0,38,'Lavado S.H.G.','2015-10-19 13:20:12','2015-10-19 13:20:12'),(84,0,39,'Lavado S.H.G.','2015-10-19 13:20:43','2015-10-19 13:20:43'),(85,0,40,'Lavado AA','2015-10-19 13:21:17','2015-10-19 13:21:17'),(86,1,1,'N.Y.4,17/18,Duro Limpio,EA Process','2015-10-19 13:23:31','2015-10-19 13:23:31'),(87,0,36,'Robusta B.H.P. 11/99','2015-10-20 10:07:14','2015-10-20 10:08:26'),(88,0,23,'','2015-11-25 13:38:58','2015-11-25 13:38:58');
/*!40000 ALTER TABLE `calidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canal_compras`
--

DROP TABLE IF EXISTS `canal_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canal_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `divisa` varchar(10) DEFAULT NULL,
  `si_diferencial` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canal_compras`
--

LOCK TABLES `canal_compras` WRITE;
/*!40000 ALTER TABLE `canal_compras` DISABLE KEYS */;
INSERT INTO `canal_compras` VALUES (1,'Londres','$/Tm',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'New-York','¢/Lb',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'Precio fijo (€/Tm)','€/Tm',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'Precio fijo (¢/Lb)','¢/Lb',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'Precio fijo ($/Tm)','$/Tm',0,'2015-07-21 14:40:12','2015-07-21 14:40:12');
/*!40000 ALTER TABLE `canal_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comisiones`
--

DROP TABLE IF EXISTS `comisiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comisiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(9,8) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comisiones`
--

LOCK TABLES `comisiones` WRITE;
/*!40000 ALTER TABLE `comisiones` DISABLE KEYS */;
INSERT INTO `comisiones` VALUES (1,0.15000000,'2015-10-21 23:30:33','2015-10-21 23:30:33'),(2,0.02409930,'2015-10-23 22:37:40','2015-10-23 22:37:40');
/*!40000 ALTER TABLE `comisiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactos`
--

DROP TABLE IF EXISTS `contactos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `funcion` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`empresa_id`),
  KEY `fk_contactos_empresas1_idx` (`empresa_id`),
  KEY `fk_contactos_departamentos1_idx` (`departamento_id`),
  CONSTRAINT `fk_contactos_departamentos1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contactos_empresas1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (3,4,3,'Emilio Botín','emilio@listafalciani.com','653306436','918695233','Golfista','2015-02-13 18:55:11','2015-02-17 23:41:31'),(6,3,3,'Juan Carlos Castro','','','','responsable cuenta','2015-02-17 15:25:01','2015-02-17 15:25:01'),(8,18,NULL,'Toto Cutugno','toto@libero.it','666 55 44 33','777 88 99 00','cantautor','2015-02-17 21:42:49','2015-02-17 23:59:22'),(13,50,NULL,'Camilo Sesto','','666554433','','Peluquero','2015-03-10 13:25:07','2015-05-05 16:12:28'),(15,18,4,'Pablo Iglesias','pabloiglesias@podemos.es','913241201','','Cofundador','2015-03-24 13:10:36','2015-04-07 15:03:34'),(18,40,NULL,'persona','correo@correos.es','3423423424','453452522','funcionando','2015-04-07 17:45:55','2015-04-07 17:46:05'),(23,16,4,'','pepito@movistar.com','','','','2015-05-07 22:10:09','2015-05-07 22:10:09'),(25,16,4,'','lacosa@loes.com','','','','2015-05-07 22:10:36','2015-05-07 22:10:36'),(26,47,NULL,'Jesús','empleadojesus@gmail.com','913341568','','Empleado','2015-05-28 20:39:44','2015-05-28 20:39:44'),(28,64,NULL,'Juan José','juanjo@importente.org','','','','2015-05-30 12:26:05','2015-05-30 12:26:05'),(29,39,NULL,'Ada Colau','adacolau@bcn.org','938521478','','Activista','2015-05-30 12:33:51','2015-08-29 00:55:54'),(30,40,4,'Pedro','unomas@carla.es','633354547','','jefe - Tráfico','2015-06-02 13:24:53','2015-06-02 13:24:53'),(31,40,NULL,'Pedro','unomas@carla.es','633354547','','jefe - Tráfico','2015-06-02 13:24:56','2015-06-02 13:24:56'),(32,38,NULL,'Jaun','Juan@gerente.com','93622255','','Gerente','2015-07-23 20:44:29','2015-07-23 20:44:29'),(34,89,NULL,'Michael','michaael@dorf.de','34625457','','Boss','2015-08-24 18:26:46','2015-08-24 18:26:46'),(35,95,NULL,'Francisco López','FLopez.mad@mscspain.com','91 436 39 40','696 092 262','Director Importación','2015-09-22 10:35:16','2015-09-22 12:25:07'),(36,95,NULL,'Iratxe Martín','IMartin.mad@mscspain.com','91 436 39 40','','Dpto. Importación','2015-09-22 12:07:24','2015-09-22 14:26:22'),(40,96,4,'Albert Sancerni','IBC.ASANCERNI@cma-cgm.com','93 551 94 26','','Agente de Importación','2015-10-15 12:24:28','2016-02-11 16:09:05'),(41,96,NULL,'Juan Carlos Almodovar','IBR.JALMODOVAR@cma-cgm.com','91 417 07 47','672 384 485','Director Importación','2015-10-15 12:26:08','2015-10-15 12:26:08'),(42,98,NULL,'Berta Ferragut','berta.ferragut@evgebcn.com','93 390 58 05','','Agente de Importación','2015-10-15 13:08:55','2015-10-15 13:08:55'),(43,98,NULL,'Josean Molina','josean.molina@evgebcn.com','93 390 58 03','','Agente de Importación','2015-10-15 13:10:10','2015-10-15 13:10:10'),(44,97,NULL,'Roberto del Moral','roberto.delmoral@hamburgsud.com','93 467 18 99','','Agente de Importación','2015-10-15 13:22:58','2015-10-15 13:22:58'),(47,3,NULL,'Pedro','','','','','2015-11-17 12:07:54','2015-11-17 12:07:54'),(49,93,4,'Carlos Jesús','carlos.jesus@euromutua.es','913597048','','Gerente','2016-03-14 13:32:27','2016-03-14 13:32:27'),(52,64,3,'Terelu','','','','cabeza','2016-07-28 20:25:10','2016-07-28 20:25:10'),(53,78,4,'Juan','distribucion@brasilenia.com','','','Distribución','2016-07-29 13:54:22','2016-07-29 13:54:22'),(54,75,4,'Perico','circuletica@gmail.com','','','Importante','2016-07-29 14:36:33','2016-07-29 14:36:33'),(56,83,4,'Tupi','nolose@gmail.rc','','','Capataz','2016-07-29 17:32:13','2016-07-29 17:32:13');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contrato_embalajes`
--

DROP TABLE IF EXISTS `contrato_embalajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contrato_embalajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL,
  `embalaje_id` int(11) NOT NULL,
  `cantidad_embalaje` smallint(6) NOT NULL,
  `peso_embalaje_real` decimal(7,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_embalajes_has_contratos_contratos1_idx` (`contrato_id`),
  KEY `fk_embalajes_has_contratos_embalajes1_idx` (`embalaje_id`),
  CONSTRAINT `fk_embalajes_has_contratos_contratos1` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_embalajes_has_contratos_embalajes1` FOREIGN KEY (`embalaje_id`) REFERENCES `embalajes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato_embalajes`
--

LOCK TABLES `contrato_embalajes` WRITE;
/*!40000 ALTER TABLE `contrato_embalajes` DISABLE KEYS */;
INSERT INTO `contrato_embalajes` VALUES (125,69,5,275,69.00,'2015-10-08 17:56:07','2015-10-08 17:56:07'),(127,71,2,100,1000.00,'2015-10-08 18:17:40','2015-10-08 18:17:40'),(128,72,2,100,1000.00,'2015-10-08 18:36:48','2015-10-08 18:36:48'),(137,77,4,2200,70.00,'2015-10-14 17:37:23','2015-10-14 17:37:23'),(139,78,4,2200,70.00,'2015-10-14 18:26:23','2015-10-14 18:26:23'),(141,79,4,2200,70.00,'2015-10-14 18:32:43','2015-10-14 18:32:43'),(146,80,1,332,60.00,'2015-11-13 13:16:03','2015-11-13 13:16:03'),(152,81,1,960,60.00,'2016-04-26 14:59:27','2016-04-26 14:59:27'),(158,84,2,60,960.00,'2016-04-26 15:30:50','2016-04-26 15:30:50'),(159,86,2,48,1000.00,'2016-04-26 15:31:33','2016-04-26 15:31:33'),(160,82,1,225,60.00,'2016-04-26 15:33:53','2016-04-26 15:33:53'),(161,83,1,319,60.00,'2016-04-26 15:34:40','2016-04-26 15:34:40'),(163,87,1,640,60.00,'2016-04-26 17:06:53','2016-04-26 17:06:53'),(164,88,2,20,999.00,'2016-04-26 17:49:55','2016-04-26 17:49:55'),(165,89,2,120,999.00,'2016-04-26 18:07:30','2016-04-26 18:07:30'),(166,85,1,483,60.00,'2016-04-26 18:16:48','2016-04-26 18:16:48'),(167,91,1,100,60.00,'2016-05-10 14:05:30','2016-05-10 14:05:30'),(168,67,4,750,70.00,'2016-05-17 15:58:43','2016-05-17 15:58:43'),(170,63,2,180,1000.00,'2016-06-21 14:47:00','2016-06-21 14:47:00'),(171,92,1,10000,60.00,'2016-06-27 23:05:38','2016-06-27 23:05:38'),(172,93,2,20,1000.00,'2016-06-27 23:14:35','2016-06-27 23:14:35'),(173,94,1,3000,60.00,'2016-06-27 23:19:30','2016-06-27 23:19:30'),(174,96,2,100,1000.00,'2016-07-05 23:56:15','2016-07-05 23:56:15'),(175,96,1,2000,60.00,'2016-07-05 23:56:15','2016-07-05 23:56:15');
/*!40000 ALTER TABLE `contrato_embalajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `incoterm_id` int(11) NOT NULL,
  `calidad_id` int(11) NOT NULL,
  `canal_compra_id` int(11) NOT NULL,
  `referencia` varchar(45) NOT NULL,
  `diferencial` decimal(6,2) DEFAULT NULL,
  `posicion_bolsa` date DEFAULT NULL,
  `peso_comprado` mediumint(9) DEFAULT NULL,
  `lotes_contrato` mediumint(9) DEFAULT NULL,
  `puerto_carga_id` int(11) DEFAULT NULL,
  `puerto_destino_id` int(11) DEFAULT NULL,
  `fecha_transporte` date DEFAULT NULL COMMENT 'Fecha de embarque o entrega segun si_entrega',
  `si_entrega` tinyint(1) unsigned zerofill DEFAULT NULL COMMENT '0 = contratos.fecha es de embarque / 1 = contratos.fecha es de entrega',
  `comentario` text,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `referencia_UNIQUE` (`referencia`),
  KEY `fk_contratos_proveedores1_idx` (`proveedor_id`),
  KEY `fk_contratos_incoterms1_idx` (`incoterm_id`),
  KEY `fk_contratos_calidades1_idx` (`calidad_id`),
  KEY `fk_contratos_canal_compras1_idx` (`canal_compra_id`),
  KEY `fk_contratos_puertos1_idx` (`puerto_destino_id`),
  KEY `fk_contratos_puertos2_idx` (`puerto_carga_id`),
  CONSTRAINT `fk_contratos_calidades1` FOREIGN KEY (`calidad_id`) REFERENCES `calidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_canal_compras1` FOREIGN KEY (`canal_compra_id`) REFERENCES `canal_compras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_incoterms1` FOREIGN KEY (`incoterm_id`) REFERENCES `incoterms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_proveedores1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_puertos1` FOREIGN KEY (`puerto_destino_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_puertos2` FOREIGN KEY (`puerto_carga_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
INSERT INTO `contratos` VALUES (63,43,2,8,2,'14/S/00340/C',-15.50,'2015-03-01',180000,11,NULL,NULL,'2015-01-01',0,'','2016-06-21 14:47:00','2015-08-18 14:33:34'),(67,115,2,29,2,'BM-8800461',16.00,'2016-03-01',52500,3,18,6,'2016-01-01',0,'','2016-05-17 15:58:43','2015-10-08 17:32:58'),(69,116,2,32,5,'ZZ-1582416',NULL,'2016-05-01',18975,0,NULL,6,'2016-03-01',0,'','2015-10-08 17:56:07','2015-10-08 17:55:34'),(71,118,2,8,2,'415560077',-21.00,'2016-03-01',100000,6,NULL,NULL,'2016-01-01',0,'','2015-10-08 18:17:40','2015-10-08 18:17:40'),(72,88,2,8,2,'S-34670',-21.00,'2016-03-01',100000,6,NULL,NULL,'2016-01-01',0,'','2015-10-08 18:36:48','2015-10-08 18:36:48'),(77,45,2,5,2,'SC-44222',9.50,'2016-03-01',154000,9,18,6,'2016-02-01',0,'','2015-10-14 17:37:23','2015-10-14 17:36:09'),(78,45,2,5,2,'SC-44223',9.50,'2016-05-01',154000,9,18,6,'2016-03-01',0,'','2015-10-14 18:26:22','2015-10-14 18:25:43'),(79,45,2,5,2,'SC-44224',9.50,'2016-05-01',154000,9,18,6,'2016-04-01',0,'','2015-10-14 18:32:43','2015-10-14 18:32:24'),(80,45,3,56,2,'PRUEBA',20.00,'2015-01-01',19920,2,NULL,NULL,'2015-07-31',1,'','2015-11-13 13:16:03','2015-11-13 13:16:03'),(81,118,2,8,2,'415560084',-21.00,'2016-05-01',57600,3,12,6,'2016-04-01',0,'','2016-04-26 14:59:27','2016-04-26 14:18:32'),(82,45,5,57,2,'SC-44506',36.00,'2016-05-01',13500,1,NULL,6,'2016-05-01',1,'','2016-04-26 15:33:53','2016-04-26 14:30:03'),(83,38,5,27,2,'CO-7139303',21.00,'2016-05-01',19140,1,NULL,6,'2016-05-01',1,'','2016-04-26 15:34:40','2016-04-26 15:10:11'),(84,118,2,8,2,'415560083',-21.00,'2016-05-01',57600,3,12,NULL,'2016-04-01',0,'','2016-04-26 15:30:50','2016-04-26 15:21:13'),(85,38,5,11,2,'CO-7140605',-4.00,'2016-05-01',28980,2,NULL,6,'2016-05-01',1,'','2016-04-26 18:16:48','2016-04-26 15:22:36'),(86,45,5,11,2,'SC-44500',-4.00,'2016-05-01',48000,3,NULL,9,'2016-05-01',1,'','2016-04-26 15:31:32','2016-04-26 15:29:45'),(87,38,1,12,1,'CO-7139504',180.00,'2016-05-01',38400,4,NULL,6,'2016-05-01',1,'','2016-04-26 17:06:52','2016-04-26 17:03:10'),(88,38,1,12,1,'CO-7141304',180.00,'2016-05-01',19980,2,NULL,6,'2016-05-01',1,'','2016-04-26 17:49:55','2016-04-26 17:49:55'),(89,38,1,12,1,'CO-7141204',185.00,'2016-05-01',119880,12,NULL,9,'2016-05-01',1,'','2016-04-26 18:07:30','2016-04-26 18:05:47'),(90,38,5,82,3,'ejemplo',0.00,'2016-07-01',6000,NULL,NULL,6,'2016-06-01',1,'','2016-04-27 14:17:54','2016-04-27 14:17:54'),(91,38,5,82,3,'16/16000',0.00,'2016-01-01',6000,NULL,NULL,6,'2016-06-01',1,'','2016-05-10 14:05:30','2016-05-10 14:05:30'),(92,45,2,5,1,'col_hui',210.00,'2016-09-01',600000,NULL,18,NULL,'2016-07-01',0,'','2016-06-27 23:05:37','2016-06-27 23:05:37'),(93,40,1,8,2,'bra_cif',23.00,'2017-01-01',20000,NULL,NULL,6,'2017-03-01',1,'','2016-06-27 23:14:35','2016-06-27 23:14:35'),(94,44,1,12,5,'fijo_viet',0.00,'2017-01-01',180000,20,27,NULL,'2017-07-01',1,'','2016-06-27 23:19:30','2016-06-27 23:19:30'),(96,38,2,44,1,'prueba resta 2 emb',NULL,'2016-01-01',220000,NULL,18,NULL,'2016-08-01',0,'','2016-07-05 23:56:15','2016-07-05 23:56:15');
/*!40000 ALTER TABLE `contratos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `criba_ponderadas`
--

DROP TABLE IF EXISTS `criba_ponderadas`;
/*!50001 DROP VIEW IF EXISTS `criba_ponderadas`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `criba_ponderadas` (
  `id` tinyint NOT NULL,
  `criba20` tinyint NOT NULL,
  `criba19` tinyint NOT NULL,
  `criba18` tinyint NOT NULL,
  `criba17` tinyint NOT NULL,
  `criba16` tinyint NOT NULL,
  `criba15` tinyint NOT NULL,
  `criba14` tinyint NOT NULL,
  `criba13` tinyint NOT NULL,
  `criba12` tinyint NOT NULL,
  `criba_media` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `cuenta_contables`
--

DROP TABLE IF EXISTS `cuenta_contables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cuenta_contables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(8) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numero_UNIQUE` (`numero`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cuenta_contables`
--

LOCK TABLES `cuenta_contables` WRITE;
/*!40000 ALTER TABLE `cuenta_contables` DISABLE KEYS */;
INSERT INTO `cuenta_contables` VALUES (1,70001010,'venta','2016-02-28 16:32:11','2016-02-28 16:35:01'),(2,70101010,'venta','2016-02-28 16:32:38','2016-02-28 16:32:38'),(3,70503021,'venta','2016-02-28 16:35:29','2016-02-28 16:35:29'),(4,70504021,'venta','2016-02-28 16:35:51','2016-02-28 16:35:51'),(5,47700010,'iva','2016-02-28 16:36:25','2016-02-28 16:36:25'),(6,47700021,'iva','2016-02-28 16:36:49','2016-02-28 16:36:49');
/*!40000 ALTER TABLE `cuenta_contables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
INSERT INTO `departamentos` VALUES (1,'contabilidad','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'calidad','0000-00-00 00:00:00','0000-00-00 00:00:00'),(3,'compras','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'tráfico','0000-00-00 00:00:00','0000-00-00 00:00:00'),(5,'informática','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `embalajes`
--

DROP TABLE IF EXISTS `embalajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `embalajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `peso_embalaje` decimal(6,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embalajes`
--

LOCK TABLES `embalajes` WRITE;
/*!40000 ALTER TABLE `embalajes` DISABLE KEYS */;
INSERT INTO `embalajes` VALUES (1,'sacos 60kg',60.00,'2015-07-05 22:23:20','2015-07-05 22:23:20'),(2,'bigbags',NULL,'2015-07-05 22:23:20','2015-07-05 22:23:20'),(4,'sacos 70kg',70.00,'2015-07-05 22:23:20','2015-07-05 22:23:20'),(5,'sacos 69kg',69.00,'2015-07-05 22:23:20','2015-07-05 22:23:20'),(6,'barriles Jamaica',NULL,'2015-07-21 13:20:59','2015-07-21 13:20:59');
/*!40000 ALTER TABLE `embalajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `nombre_corto` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `cif` varchar(45) DEFAULT NULL,
  `codigo_contable` varchar(45) DEFAULT NULL,
  `cuenta_bancaria` varchar(45) DEFAULT NULL,
  `bic` varchar(15) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  UNIQUE KEY `nombre_corto_UNIQUE` (`nombre_corto`),
  KEY `fk_empresas_paises1_idx` (`pais_id`),
  KEY `nombre` (`nombre`),
  CONSTRAINT `fk_empresas_paises140` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (3,'BBVA','BBVA','Paseo Castellana, 108','','Madrid',3,'918652010','','57200005','01824572420000074739','BBVAESMMXXX',NULL,NULL,'2015-10-15 14:28:45'),(4,'Santander','Santander','Serrano, 21','28012','Madrid',3,NULL,'A-39000013','57200011',NULL,NULL,NULL,'2015-02-13 18:51:30','2015-02-17 15:13:25'),(14,'La Caixa','Caixa','','','',3,NULL,NULL,'57200002',NULL,NULL,NULL,'2015-02-17 14:57:48','2015-02-17 14:57:48'),(15,'Sabadell','Sabadell','','','',3,NULL,NULL,'57200003','00815760340001359645',NULL,NULL,'2015-02-17 14:59:17','2015-02-24 11:57:16'),(16,'Deutsche Bank','Deutsche Bank','','','',3,NULL,NULL,'57200006',NULL,NULL,NULL,'2015-02-17 15:05:12','2015-02-17 15:06:25'),(17,'Banco Popular Español','Popular','','','',3,NULL,NULL,'57200007',NULL,NULL,NULL,'2015-02-17 15:10:30','2015-02-17 15:10:30'),(18,'Banca March','March','','28000','',3,NULL,NULL,'57200009',NULL,NULL,NULL,'2015-02-17 15:11:11','2015-05-26 15:26:57'),(26,'Bankinter','Bankinter','','','',3,'',NULL,'57200010',NULL,NULL,NULL,'2015-02-24 11:59:17','2015-05-26 15:30:32'),(36,'Icona Café SA','Icona','','','',3,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:26:57','2015-03-10 11:26:57'),(37,'Louis Dreyfus Commodities España ','Dreyfus España','','','',3,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:39:25','2015-03-10 11:45:29'),(38,'Coprocafé Ibérica S.A.','Coprocafé','','','',3,'','','','','MESHXXX',NULL,'2015-03-10 11:39:46','2015-09-22 12:39:32'),(39,'C.Dorman Limited','Dorman','','','',8,'','','','','',NULL,'2015-03-10 11:43:30','2015-08-29 00:47:31'),(40,'Louis Dreyfus Commodities Brasil','Dreyfus Brasil','','','',1,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:45:06','2015-03-10 11:45:06'),(41,'List & Beisler GmbH','Beisler','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:49:34','2015-03-10 11:49:34'),(43,'Olam International Ltd','Olam','','','',10,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:54:18','2015-03-10 11:54:18'),(44,'Mercon Coffee Corporation','Mercon','','','',11,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:57:06','2015-03-10 11:57:06'),(45,'Coffein Compagnie Dr. Erich Scheele GmbH & Co','Coffein','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:59:26','2015-03-10 11:59:26'),(47,'Exportadora Atlantic S.A.','Atlantic','','','',12,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 12:03:17','2015-03-10 12:03:17'),(48,'InterAmerican Coffee GmbH','InterAmerican','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 12:05:28','2015-03-10 12:05:28'),(50,'Almacenes Viorvi SA','Viorvi','','','Barcelona',3,'987654321',NULL,NULL,NULL,NULL,NULL,'2015-03-10 12:51:59','2015-03-10 13:29:35'),(58,'Almacén  BIT','BIT','','','Barcelona',3,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:18:29','2015-05-05 16:10:39'),(59,'Molenbergnatie','Molenbergnatie','','','Barcelona',3,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:19:45','2015-05-05 16:11:16'),(60,'Pacorini','Pacorini','','','Gijón',3,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:20:25','2015-05-05 16:11:45'),(61,'Almacén Europa','Europa','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:20:57','2015-04-08 17:20:57'),(64,'Coma y Ribas','Coma','c/ Obradors, 7','08130','Santa Perpètua de Mogoda',3,'933021414',NULL,NULL,NULL,NULL,NULL,'2015-05-26 14:22:04','2015-05-26 14:22:04'),(68,'Germán De Erausquin, S.A.','Erausquin','Urgel, 37 1º - 3ª','08011','Barcelona',3,'933255640','ESA-08259368','43401006','',NULL,NULL,'2015-07-08 02:55:15','2015-07-14 12:45:22'),(75,'Cafés Baqué, S.L.U.','Baqué','P.Ind. Sta. Apolonia - U.A.I., 2-2','48215','Iurreta',3,'946215610','ESB-95445508','43401007','',NULL,NULL,'2015-07-14 12:40:47','2015-07-14 12:46:08'),(76,'Juan Iriondo, S.A.','Iriondo','Pol. Ugaldetxo - C/ Zuaznabar, 49','20180','Oiartzun',3,'943491642','ESA-20063954','43401010','',NULL,NULL,'2015-07-14 12:48:24','2015-07-14 12:50:49'),(77,'Rodriguez y Mateus, S.L.U.','Mateus','Alfonso Gómez, 15','28037','Madrid',3,'913271216','ESB-28577799','43401011','',NULL,NULL,'2015-07-14 12:50:14','2015-07-14 12:50:14'),(78,'Cafés la Brasileña, S.A.','Brasileña','Oñate, 12','01013','Vitoria',3,'945265000','ESA-01016450','43401013','',NULL,NULL,'2015-07-14 12:52:19','2015-07-14 12:52:19'),(79,'Cafés Orus, S.A.','Orus','Ctra. Logroño - P.I. Portazgo - 101-102-83','50011','Zaragoza',3,'976347272','ESA-50004860','43401014','',NULL,NULL,'2015-07-14 12:54:01','2015-07-14 12:54:01'),(80,'U.N.I.C. , S.L.','Unic','Sancho de Avila, 73-75','08018','Barcelona',3,'933006007','ESB-08266009','43401015','',NULL,NULL,'2015-07-14 12:55:26','2015-07-14 12:55:26'),(81,'Café Dromedario, S.A.','Dromedario','Recta de Heras, s/nº.','39792','Heras',3,'942540725','ESA-39000690','43401019','',NULL,NULL,'2015-07-14 12:56:52','2015-07-14 12:56:52'),(82,'Cafento Norte, S.L.','Cafento','Pol.Ind. La Curiscada - Entrada Sur.','33877','Tineo',3,'902117218','ESB-33019688','43401024','',NULL,NULL,'2015-07-14 12:58:26','2015-07-14 12:58:26'),(83,'Tupinamba, S.A.','Tupinamba','Domenech Pascual, 3 - P.I. Can Misser','08360','Canet de Mar',3,'937943110','ESA-58476961','43401031','',NULL,NULL,'2015-07-14 13:00:16','2015-07-14 13:00:16'),(84,'La Ind. Levantina de Cafés Durbán, S.L.','Durbán','Ctra. Valencia - Ademuz, Km.11','46980','Paterna',3,'961320998','ESB-46012506','43401038','',NULL,NULL,'2015-07-14 13:01:52','2015-08-18 14:41:22'),(86,'Banco Bilbao Vizcaya','BBVA Frances','','','',3,'','','','',NULL,NULL,'2015-07-22 18:20:17','2015-07-22 18:50:48'),(87,'Fernando Flores Barcelona S.L.','Flores','Av. Diagonal, 618 5°B','08021','Barcelona',3,'932290352','B-58284779','','',NULL,NULL,'2015-07-24 17:06:33','2015-07-24 17:06:33'),(88,'Louis Dreyfus Commodities Suisse SA','Dreyfus Suiza','29, route del l\'Aéroport - PO Box 236','1215','Geneva 15',10,'+41227992700','','','',NULL,NULL,'2015-07-25 14:32:58','2015-07-25 14:32:58'),(89,'Zurich Gmbh','Zurich','C/ Pluton','28777','Basel',6,'963963','','','',NULL,NULL,'2015-07-27 14:48:22','2015-08-24 18:25:06'),(90,'ALLIANZ, COMPAÑIA DE SEGUROS Y REASEGUROS, SO','Allianz','','','',9,'902232629','','','',NULL,NULL,'2015-07-27 14:49:04','2015-07-27 14:49:04'),(91,'Axa Seguros Generales, S. A. de seguros y reaseguros','Axa','','','Madrid',3,'971767700','','','','',NULL,'2015-07-27 14:49:25','2015-08-25 12:59:52'),(93,'Euromutua de seguros y reaseguros a prima fija','Euromutua','','','Basel',10,'12345','','','','',NULL,'2015-07-27 14:50:00','2015-08-25 12:58:49'),(95,'MEDITERRANEAN SHIPPING COMPANY ESPAÑA, S.L.U.','MSC','','28020','MADRID',3,'91 436 39 40','B98261944','41003023','00810166140001563062','MESHXXX',NULL,'2015-08-19 18:17:54','2015-09-22 13:57:57'),(96,'CMA CGM IBERICA S.A.U.','CMA CGM','','08040','Barcelona',3,'93 319 68 00','ESA83728279','41003061','00815084040001469249','BSABESBB',NULL,'2015-08-19 18:18:21','2015-10-15 12:22:29'),(97,'Hamburg Sud Iberia, S.A.','Hamburg Sud','','08008','Barcelona',3,'93 467 18 99','A41271263','41003037','00190020964010189003','DEUTESBBXXX',NULL,'2015-08-19 18:19:08','2015-10-15 13:34:48'),(98,'Agencia Marítima Española Evge, S.A.','Marfret','','08003','Barcelona',3,'93 390 58 00','A08115362','41003024','21000889430200119212','CAIXESBBXXX',NULL,'2015-08-19 18:19:29','2015-10-15 13:20:19'),(99,'WEC','WEC','','','',3,'','','','',NULL,NULL,'2015-08-19 18:20:01','2015-09-08 13:01:53'),(100,'Maersk Line Shipping','Maersk','','','',3,'','','','',NULL,NULL,'2015-09-08 13:00:08','2015-09-08 13:00:08'),(101,'K-LINE','K-LINE','','','',3,'','','','',NULL,NULL,'2015-09-08 13:28:37','2015-09-08 13:28:37'),(102,'NYK Line','NYK Line','','','',3,'','','','',NULL,NULL,'2015-09-08 13:29:16','2015-09-08 13:29:16'),(103,'Happag Lloyd','Happag Lloyd','','','',3,'','','','',NULL,NULL,'2015-09-08 13:29:42','2015-09-08 13:29:42'),(104,'HYUNDAI','HYUNDAI','','','',3,'','','','',NULL,NULL,'2015-09-08 13:30:00','2015-09-08 13:30:00'),(105,'Masiques','Masiques','','','',9,'','','','',NULL,NULL,'2015-09-15 14:39:33','2015-09-15 14:39:33'),(115,'Bernhard Rothfos GmbH','Rothfos','Coffee Plaza-Am Sandtorpark 4','DE-20457','Hamburgo',9,'','','','','',NULL,'2015-10-08 17:37:49','2015-10-08 17:37:49'),(116,'Bernhard Rothfos Intercafé AG','Rothfos Suiza','Bahnhofstrasse, 22','CH-6301','Zug',10,'','','','','',NULL,'2015-10-08 17:50:08','2015-10-08 17:52:02'),(118,'Ecom Agroindustrial Corp. Ltd.','Esteve','Avenue Ettienne Guillermin, 16','CH-1009','Pully',10,'','','','','',NULL,'2015-10-08 17:59:25','2015-10-08 17:59:25'),(119,'Kuehene + Nagel','Kuehene + Nagel','','','',3,'','','','','',NULL,'2015-10-19 15:07:15','2015-10-19 15:07:15'),(123,'Caca en Lata SL','Atresmedia','Pza Sol 5','28739','villavieja del lozoya',25,'+34618557588','','','','','','2016-07-29 12:54:28','2016-07-29 13:15:27');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factura_lineas`
--

DROP TABLE IF EXISTS `factura_lineas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factura_lineas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factura_id` int(11) NOT NULL,
  `tipo_iva_id` int(11) NOT NULL,
  `concepto` varchar(45) NOT NULL,
  `importe` decimal(8,2) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_factura_lineas_facturas1_idx` (`factura_id`),
  KEY `fk_factura_lineas_tipo_ivas1_idx` (`tipo_iva_id`),
  CONSTRAINT `fk_factura_lineas_facturas1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_factura_lineas_tipo_ivas1` FOREIGN KEY (`tipo_iva_id`) REFERENCES `tipo_ivas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='esta tabla detalla todas las lineas de una misma factura';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factura_lineas`
--

LOCK TABLES `factura_lineas` WRITE;
/*!40000 ALTER TABLE `factura_lineas` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura_lineas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturaciones`
--

DROP TABLE IF EXISTS `facturaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturaciones` (
  `id` int(11) NOT NULL,
  `cuenta_venta_id` int(11) NOT NULL,
  `cuenta_iva_id` int(11) NOT NULL,
  `fecha_factura` date DEFAULT NULL,
  `precio_dolar_tm` decimal(10,6) NOT NULL,
  `cambio_dolar_euro` decimal(6,4) NOT NULL,
  `peso_facturacion` decimal(6,0) NOT NULL,
  `flete_pagado` decimal(6,2) DEFAULT NULL,
  `gastos_bancarios_pagados` decimal(6,2) DEFAULT NULL,
  `despacho_pagado` decimal(6,2) DEFAULT NULL,
  `seguro_pagado` decimal(6,2) DEFAULT NULL,
  `peso_medio_saco` decimal(6,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_facturaciones_cuenta_bancarias1_idx` (`cuenta_venta_id`),
  KEY `fk_facturaciones_cuenta_contables1_idx` (`cuenta_iva_id`),
  CONSTRAINT `fk_facturaciones_cuenta_bancarias1` FOREIGN KEY (`cuenta_venta_id`) REFERENCES `cuenta_contables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_facturaciones_cuenta_contables1` FOREIGN KEY (`cuenta_iva_id`) REFERENCES `cuenta_contables` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_facturacion_operaciones1` FOREIGN KEY (`id`) REFERENCES `operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturaciones`
--

LOCK TABLES `facturaciones` WRITE;
/*!40000 ALTER TABLE `facturaciones` DISABLE KEYS */;
INSERT INTO `facturaciones` VALUES (27,1,5,'2016-07-29',3432.598000,1.3289,2000,0.00,0.00,0.00,0.00,20.00,'2016-07-29 02:11:24','2016-07-29 02:11:24');
/*!40000 ALTER TABLE `facturaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa_id` int(11) NOT NULL,
  `facturacion_id` int(11) DEFAULT NULL,
  `numero` varchar(45) NOT NULL,
  `fecha` date DEFAULT NULL,
  `concepto` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_facturas_facturaciones1_idx` (`facturacion_id`),
  KEY `fk_facturas_empresas1_idx` (`empresa_id`),
  CONSTRAINT `fk_facturas_empresas1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_facturas_facturaciones1` FOREIGN KEY (`facturacion_id`) REFERENCES `facturaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facturas`
--

LOCK TABLES `facturas` WRITE;
/*!40000 ALTER TABLE `facturas` DISABLE KEYS */;
/*!40000 ALTER TABLE `facturas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financiaciones`
--

DROP TABLE IF EXISTS `financiaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `financiaciones` (
  `id` int(11) NOT NULL,
  `banco_id` int(11) NOT NULL,
  `tipo_iva_id` int(11) NOT NULL,
  `tipo_iva_comision_id` int(11) NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `precio_euro_kilo` decimal(8,6) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_financiaciones_operaciones1_idx` (`id`),
  KEY `fk_financiaciones_bancos1_idx1` (`banco_id`),
  KEY `fk_financiaciones_ivas1_idx` (`tipo_iva_id`),
  KEY `fk_financiaciones_tipo_ivas1_idx` (`tipo_iva_comision_id`),
  CONSTRAINT `fk_financiaciones_bancos1` FOREIGN KEY (`banco_id`) REFERENCES `bancos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_financiaciones_ivas1` FOREIGN KEY (`tipo_iva_id`) REFERENCES `tipo_ivas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_financiaciones_operaciones1` FOREIGN KEY (`id`) REFERENCES `operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_financiaciones_tipo_ivas1` FOREIGN KEY (`tipo_iva_comision_id`) REFERENCES `tipo_ivas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financiaciones`
--

LOCK TABLES `financiaciones` WRITE;
/*!40000 ALTER TABLE `financiaciones` DISABLE KEYS */;
INSERT INTO `financiaciones` VALUES (27,26,3,4,'2015-11-13',2.604993,'2015-10-20 02:00:54','2015-11-13 13:42:13'),(45,3,3,4,'2016-07-21',2.716558,'2016-07-21 00:02:19','2016-07-21 00:02:19'),(46,26,3,4,'2015-11-13',3.230705,'2015-11-13 14:42:58','2015-11-13 14:42:58'),(53,3,3,4,'2016-07-19',2.113312,'2016-07-19 16:35:29','2016-07-19 16:35:29');
/*!40000 ALTER TABLE `financiaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `flete_contratos`
--

DROP TABLE IF EXISTS `flete_contratos`;
/*!50001 DROP VIEW IF EXISTS `flete_contratos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `flete_contratos` (
  `flete_id` tinyint NOT NULL,
  `contrato_id` tinyint NOT NULL,
  `naviera_id` tinyint NOT NULL,
  `puerto_carga_id` tinyint NOT NULL,
  `puerto_destino_id` tinyint NOT NULL,
  `embalaje_id` tinyint NOT NULL,
  `precio_flete` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `flete_fecha_hoy`
--

DROP TABLE IF EXISTS `flete_fecha_hoy`;
/*!50001 DROP VIEW IF EXISTS `flete_fecha_hoy`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `flete_fecha_hoy` (
  `flete_id` tinyint NOT NULL,
  `fecha_inicio` tinyint NOT NULL,
  `fecha_fin` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `fletes`
--

DROP TABLE IF EXISTS `fletes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fletes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naviera_id` int(11) NOT NULL,
  `puerto_carga_id` int(11) NOT NULL,
  `puerto_destino_id` int(11) NOT NULL,
  `embalaje_id` int(11) DEFAULT NULL,
  `peso_contenedor_tm` decimal(8,2) DEFAULT NULL COMMENT 'en Tm',
  `contrato` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_fletes_navieras1_idx` (`naviera_id`),
  KEY `fk_fletes_puertos1_idx` (`puerto_carga_id`),
  KEY `fk_fletes_puertos2_idx` (`puerto_destino_id`),
  KEY `fk_fletes_embalajes1_idx` (`embalaje_id`),
  CONSTRAINT `fk_fletes_embalajes1` FOREIGN KEY (`embalaje_id`) REFERENCES `embalajes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fletes_navieras1` FOREIGN KEY (`naviera_id`) REFERENCES `navieras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fletes_puertos1` FOREIGN KEY (`puerto_carga_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_fletes_puertos2` FOREIGN KEY (`puerto_destino_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fletes`
--

LOCK TABLES `fletes` WRITE;
/*!40000 ALTER TABLE `fletes` DISABLE KEYS */;
INSERT INTO `fletes` VALUES (1,95,12,6,1,19.20,NULL,'2015-08-19 21:19:32','2015-08-25 11:59:44'),(2,95,13,6,1,19.20,NULL,'2015-08-19 21:43:51','2015-08-19 21:43:51'),(3,95,14,6,1,19.20,NULL,'2015-08-19 21:44:31','2015-08-19 21:44:31'),(4,96,12,6,1,19.20,'CL002736294CO-4-001','2015-08-19 21:55:31','2016-04-26 13:04:50'),(5,96,13,6,1,19.20,'CL002736294CO-4-001','2015-08-19 22:04:43','2016-04-26 12:58:25'),(6,97,12,6,1,19.20,'LESQ5008949','2015-08-19 22:06:37','2016-04-26 13:25:19'),(7,97,13,6,1,19.20,'LESQ5008949','2015-08-19 22:07:08','2016-04-26 13:20:40'),(8,97,14,6,1,19.20,NULL,'2015-08-19 22:08:24','2015-08-19 22:08:24'),(9,95,12,9,2,20.00,NULL,'2015-08-19 22:11:02','2015-08-19 22:11:02'),(10,95,13,9,2,20.00,NULL,'2015-08-19 22:11:30','2015-08-19 22:11:30'),(11,95,14,9,2,20.00,NULL,'2015-08-19 22:12:01','2015-08-19 22:12:01'),(12,96,12,9,2,20.00,'CL002736294CO-4-002','2015-08-19 22:12:38','2016-04-26 13:10:17'),(13,96,13,9,2,20.00,'CL002736294CO-4-002','2015-08-19 22:12:58','2016-04-26 13:01:07'),(14,96,14,6,2,20.00,'CL002736294CO-4-001','2015-08-19 22:13:36','2016-04-26 13:02:30'),(15,96,15,6,5,18.97,'QIBR008081','2015-08-19 22:15:42','2016-04-26 13:12:06'),(16,96,15,9,NULL,19.25,NULL,'2015-08-19 23:22:15','2015-08-19 23:22:15'),(17,96,16,6,5,18.97,'QIBR008081','2015-08-19 23:23:17','2016-04-26 13:14:42'),(18,96,16,9,NULL,19.25,NULL,'2015-08-19 23:23:49','2015-08-19 23:23:49'),(19,96,17,6,2,20.00,'QIBR008081','2015-08-19 23:24:25','2016-04-26 13:17:53'),(20,96,17,9,2,20.00,'QIBR008081','2015-08-19 23:24:49','2016-04-26 13:18:46'),(21,98,18,6,4,19.25,NULL,'2015-08-19 23:25:37','2015-08-20 18:00:00'),(22,95,19,6,4,19.25,NULL,'2015-08-19 23:26:08','2015-08-20 18:00:33'),(23,96,20,6,NULL,NULL,NULL,'2015-08-19 23:26:43','2015-08-19 23:26:43'),(24,96,20,9,NULL,NULL,NULL,'2015-08-19 23:27:01','2015-08-19 23:27:01'),(25,96,21,9,NULL,NULL,NULL,'2015-08-19 23:27:25','2015-08-19 23:27:25'),(26,95,22,6,1,19.20,NULL,'2015-08-19 23:28:06','2015-11-05 10:58:09'),(27,99,23,6,1,19.20,NULL,'2015-08-19 23:28:28','2015-08-20 18:01:32'),(28,99,24,6,1,19.20,NULL,'2015-08-19 23:28:51','2015-08-20 18:01:46'),(29,95,25,6,1,19.20,NULL,'2015-08-20 18:09:10','2015-08-20 18:09:10'),(30,95,25,9,2,20.00,NULL,'2015-08-20 18:09:43','2015-11-05 10:56:17'),(31,95,26,6,1,19.20,NULL,'2015-08-20 18:10:15','2015-08-20 18:10:15'),(32,95,26,9,2,20.00,NULL,'2015-08-20 18:10:43','2015-11-05 10:54:54'),(33,95,27,6,1,19.20,NULL,'2015-08-20 18:11:54','2015-08-20 18:11:54'),(34,95,27,9,2,21.00,NULL,'2015-08-20 18:12:18','2015-08-20 18:12:18'),(35,95,12,6,2,20.00,NULL,'2015-09-01 13:20:49','2015-10-15 14:53:31'),(36,96,14,6,1,19.20,'CL002736294CO-4-001','2015-09-08 10:47:55','2016-04-26 13:03:31'),(38,95,13,6,2,20.00,NULL,'2015-10-15 15:13:11','2015-10-15 15:13:11'),(39,95,14,6,2,20.00,NULL,'2015-10-15 15:24:13','2015-10-15 15:24:13'),(40,95,17,9,2,20.00,NULL,'2015-11-04 15:59:07','2015-11-04 16:00:29'),(41,95,22,9,2,20.00,NULL,'2015-11-05 11:00:26','2015-11-05 11:02:14'),(42,95,23,6,1,19.20,NULL,'2015-11-05 11:08:12','2015-11-05 11:08:35'),(43,95,23,9,2,20.00,NULL,'2015-11-05 11:09:48','2015-11-05 11:09:48'),(44,95,24,6,1,19.20,NULL,'2015-11-05 11:11:35','2015-11-05 11:11:35'),(45,95,24,9,2,20.00,NULL,'2015-11-05 11:11:50','2015-11-05 11:11:50'),(46,97,12,6,2,20.00,'LESQ5008949','2016-04-26 13:26:49','2016-04-26 13:28:05'),(47,97,13,6,2,20.00,'LESQ5008949','2016-04-26 13:28:40','2016-04-26 13:28:40');
/*!40000 ALTER TABLE `fletes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incoterms`
--

DROP TABLE IF EXISTS `incoterms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `incoterms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) DEFAULT NULL,
  `si_flete` tinyint(1) DEFAULT NULL,
  `si_seguro` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incoterms`
--

LOCK TABLES `incoterms` WRITE;
/*!40000 ALTER TABLE `incoterms` DISABLE KEYS */;
INSERT INTO `incoterms` VALUES (1,'CIF',0,0,'2015-07-21 13:15:34','2015-07-21 13:15:34'),(2,'FOB',1,1,NULL,'2015-08-05 17:03:58'),(3,'IN STORE',0,0,NULL,'2015-08-05 17:04:13'),(4,'FOT ',NULL,NULL,NULL,NULL),(5,'IN STORE DESPACHADO',NULL,NULL,NULL,NULL),(6,'FOT DESPACHADO',NULL,NULL,NULL,NULL),(12,'TROL',NULL,NULL,'2016-06-29 16:02:02','2016-06-29 16:02:02'),(15,'jjjj',NULL,NULL,'2016-06-30 15:07:58','2016-06-30 15:07:58');
/*!40000 ALTER TABLE `incoterms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea_muestras`
--

DROP TABLE IF EXISTS `linea_muestras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linea_muestras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `muestra_id` int(11) NOT NULL,
  `operacion_id` int(11) DEFAULT NULL,
  `almacen_transporte_id` int(11) DEFAULT NULL,
  `referencia_proveedor` varchar(45) DEFAULT NULL,
  `sacos` mediumint(9) DEFAULT NULL,
  `humedad` varchar(45) DEFAULT NULL,
  `tueste` varchar(45) DEFAULT NULL,
  `apreciacion_bebida` text,
  `defecto` text,
  `observaciones` text,
  `si_facturado` tinyint(1) unsigned zerofill DEFAULT NULL,
  `dato_factura` varchar(45) DEFAULT NULL,
  `criba20` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba19` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba13p` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba18` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba12p` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba17` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba11p` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba16` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba10p` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba15` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba9p` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba14` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba8p` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba13` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `criba12` decimal(3,1) unsigned zerofill DEFAULT NULL COMMENT '	',
  `ref` text,
  `a` varchar(45) DEFAULT NULL,
  `observacion_externa` text,
  `atn` varchar(45) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL COMMENT '	\n	',
  PRIMARY KEY (`id`),
  KEY `fk_linea_muestra_muestras1_idx` (`muestra_id`),
  KEY `fk_linea_muestras_almacen_transportes1_idx` (`almacen_transporte_id`),
  KEY `fk_linea_muestras_operaciones1_idx` (`operacion_id`),
  CONSTRAINT `fk_linea_muestras_almacen_transportes1` FOREIGN KEY (`almacen_transporte_id`) REFERENCES `almacen_transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_linea_muestras_operaciones1` FOREIGN KEY (`operacion_id`) REFERENCES `operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_linea_muestra_muestras1` FOREIGN KEY (`muestra_id`) REFERENCES `muestras` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea_muestras`
--

LOCK TABLES `linea_muestras` WRITE;
/*!40000 ALTER TABLE `linea_muestras` DISABLE KEYS */;
INSERT INTO `linea_muestras` VALUES (29,50,27,12,'s-3456',250,'12,0','BUENO','1ªPRUEBA\r\n9 TAZAS DURO LIMPIO\r\n1 TAZA FONDO RIADO\r\n2ªPRUEBA\r\n10 TAZAS DURO LIMPIO','N.Y.4, 30 DEFECTOS EN 300 GRS','',NULL,NULL,NULL,NULL,NULL,NULL,07.4,52.6,05.6,32.3,NULL,02.1,NULL,NULL,NULL,NULL,NULL,'Entrega Junio 2016','Marta','Entregado el mejor café','Carlos de Erausquin','2016-06-15 14:25:12','2016-04-26 09:54:08'),(31,52,NULL,NULL,'S-345',550,'11,5','FINO','10 TAZAS PROBADAS\r\nACIDEZ MEDIA\r\nCUERPO MEDIO\r\nSUAVES Y LIMPIAS TODAS LAS TAZAS\r\n(más limpias con Fairy)','6 SEGUN TABLA DE N.Y.','ACEPTADA',0,'',NULL,NULL,NULL,50.0,NULL,40.0,NULL,10.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-29 14:33:05','2016-04-26 10:00:10'),(32,50,27,12,'',250,'12,5','fino','Acidez: mucha\r\nCuerpo: poco\r\nLeve suavidad uniforme','3,5%\r\nImpurezas: 0,3%','',NULL,NULL,19.0,10.0,19.0,10.0,05.0,20.0,02.0,10.0,NULL,05.0,NULL,NULL,NULL,NULL,NULL,'qweqw','qe','qe','qe','2016-07-27 19:52:43','2016-05-10 14:25:56'),(34,54,27,12,'No hay',30,'Suficiente','Claro','Fresca','A penas','Pocas',0,'',50.0,20.0,10.0,05.0,01.0,NULL,NULL,02.0,02.0,NULL,02.0,02.0,02.0,02.0,02.0,NULL,NULL,NULL,NULL,'2016-06-24 18:59:13','2016-06-24 18:59:13');
/*!40000 ALTER TABLE `linea_muestras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca_almacenes`
--

DROP TABLE IF EXISTS `marca_almacenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca_almacenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `almacen_transporte_id` int(11) NOT NULL,
  `muestra_id` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `cantidad_marca` decimal(5,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_marca_almacenes_muestras1_idx` (`muestra_id`),
  KEY `fk_marca_almacenes_almacenes_transportes1_idx` (`almacen_transporte_id`),
  CONSTRAINT `fk_marca_almacenes_muestras1` FOREIGN KEY (`muestra_id`) REFERENCES `muestras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca_almacenes`
--

LOCK TABLES `marca_almacenes` WRITE;
/*!40000 ALTER TABLE `marca_almacenes` DISABLE KEYS */;
/*!40000 ALTER TABLE `marca_almacenes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `muestras`
--

DROP TABLE IF EXISTS `muestras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `muestras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) DEFAULT NULL,
  `calidad_id` int(11) DEFAULT NULL,
  `contrato_id` int(11) DEFAULT NULL COMMENT 'hay contrato_id si es\nembarque o entrega\n(tipo 2 o 3)',
  `muestra_embarque_id` int(11) DEFAULT NULL,
  `registro` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `aprobado` tinyint(1) unsigned zerofill DEFAULT NULL,
  `incidencia` text,
  `tipo_id` int(1) unsigned NOT NULL,
  `si_sample` tinyint(1) unsigned zerofill DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_muestras_calidades1_idx` (`calidad_id`),
  KEY `fk_muestras_proveedores1_idx` (`proveedor_id`),
  KEY `fk_muestras_contratos1_idx` (`contrato_id`),
  KEY `fk_muestras_muestras1_idx` (`muestra_embarque_id`),
  KEY `referencia` (`registro`),
  CONSTRAINT `fk_muestras_calidades1` FOREIGN KEY (`calidad_id`) REFERENCES `calidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_contratos1` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_muestras1` FOREIGN KEY (`muestra_embarque_id`) REFERENCES `muestras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_proveedores1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muestras`
--

LOCK TABLES `muestras` WRITE;
/*!40000 ALTER TABLE `muestras` DISABLE KEYS */;
INSERT INTO `muestras` VALUES (50,43,8,63,NULL,1,'2016-04-26 00:00:00',1,'',3,NULL,'2016-04-26 09:51:28','2016-04-26 10:47:59'),(52,115,5,NULL,NULL,1,'2016-04-26 00:00:00',0,'PROPUESTA PARA SUSTITUCION RETRASO DE EMBARQUE MARZO',1,1,'2016-04-26 09:58:49','2016-04-26 09:58:49'),(53,88,8,72,NULL,2,'2016-04-26 00:00:00',1,'',1,0,'2016-04-26 10:05:27','2016-04-26 10:05:27'),(54,43,8,63,NULL,2,'2016-06-24 00:00:00',1,'',3,NULL,'2016-06-24 18:58:21','2016-06-24 18:58:21');
/*!40000 ALTER TABLE `muestras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navieras`
--

DROP TABLE IF EXISTS `navieras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `navieras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_navieras_empresas` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navieras`
--

LOCK TABLES `navieras` WRITE;
/*!40000 ALTER TABLE `navieras` DISABLE KEYS */;
INSERT INTO `navieras` VALUES (95,'2015-08-19 18:17:54','2015-09-22 13:57:57'),(96,'2015-08-19 18:18:21','2015-10-15 12:22:29'),(97,'2015-08-19 18:19:08','2015-10-15 13:34:48'),(98,'2015-08-19 18:19:29','2015-10-15 13:20:19'),(99,'2015-08-19 18:20:01','2015-09-08 13:01:53'),(100,'2015-09-08 13:00:08','2015-09-08 13:00:08'),(101,'2015-09-08 13:28:37','2015-09-08 13:28:37'),(102,'2015-09-08 13:29:16','2015-09-08 13:29:16'),(103,'2015-09-08 13:29:43','2015-09-08 13:29:43'),(104,'2015-09-08 13:30:00','2015-09-08 13:30:00'),(119,'2015-10-19 15:07:15','2015-10-19 15:07:15');
/*!40000 ALTER TABLE `navieras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `operacion_retiradas`
--

DROP TABLE IF EXISTS `operacion_retiradas`;
/*!50001 DROP VIEW IF EXISTS `operacion_retiradas`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `operacion_retiradas` (
  `id` tinyint NOT NULL,
  `retirada_id` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `operacion_saco_pendientes`
--

DROP TABLE IF EXISTS `operacion_saco_pendientes`;
/*!50001 DROP VIEW IF EXISTS `operacion_saco_pendientes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `operacion_saco_pendientes` (
  `id` tinyint NOT NULL,
  `total_cuentas` tinyint NOT NULL,
  `total_asignados` tinyint NOT NULL,
  `sin_asignar` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `operaciones`
--

DROP TABLE IF EXISTS `operaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL,
  `embalaje_id` int(11) NOT NULL,
  `puerto_carga_id` int(11) DEFAULT NULL,
  `puerto_destino_id` int(11) DEFAULT NULL,
  `referencia` varchar(15) NOT NULL,
  `lotes_operacion` mediumint(9) DEFAULT NULL,
  `fecha_pos_fijacion` date DEFAULT NULL,
  `precio_fijacion` decimal(6,2) DEFAULT NULL,
  `precio_compra` decimal(6,2) DEFAULT NULL,
  `precio_directo_euro` decimal(8,6) DEFAULT NULL COMMENT 'Usado cuando sobre café de un contrato y se ve directamente en euros. entonces no hay ni cambio, ni gastos.',
  `opciones` decimal(6,2) DEFAULT NULL,
  `cambio_dolar_euro` decimal(6,4) DEFAULT NULL,
  `flete` decimal(8,2) DEFAULT NULL,
  `forfait` decimal(8,2) DEFAULT NULL,
  `seguro` decimal(8,2) DEFAULT NULL,
  `gastos_bancarios` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `flete_total` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `despacho_aduana` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `seguro_total` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `peso_pagado` decimal(8,2) DEFAULT NULL,
  `observaciones` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linea_contratos_contratos1_idx` (`contrato_id`),
  KEY `fk_linea_contratos_embalajes1_idx` (`embalaje_id`),
  KEY `fk_operaciones_puertos1_idx` (`puerto_destino_id`),
  KEY `fk_operaciones_puertos2_idx` (`puerto_carga_id`),
  CONSTRAINT `fk_linea_contratos_embalajes1` FOREIGN KEY (`embalaje_id`) REFERENCES `embalajes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operaciones_contratos` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_operaciones_puertos1` FOREIGN KEY (`puerto_destino_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operaciones_puertos2` FOREIGN KEY (`puerto_carga_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones`
--

LOCK TABLES `operaciones` WRITE;
/*!40000 ALTER TABLE `operaciones` DISABLE KEYS */;
INSERT INTO `operaciones` VALUES (27,63,2,NULL,0,'15/006',6,'2015-08-01',171.20,171.20,NULL,0.00,1.3289,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2015-08-18 14:40:09','2016-04-26 14:21:11'),(31,67,4,18,6,'test',2,'2015-08-21',130.10,125.00,NULL,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2015-10-08 17:39:34','2016-07-29 16:56:33'),(32,69,5,NULL,6,'',NULL,'2015-09-11',NULL,NULL,NULL,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-08 17:57:10','2015-10-08 17:57:10'),(33,71,2,NULL,6,'',4,'2015-08-21',130.10,125.00,NULL,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-08 18:33:11','2015-10-08 18:33:11'),(34,71,2,NULL,9,'',2,'2015-08-21',130.10,125.00,NULL,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-08 18:34:00','2015-10-08 18:34:00'),(35,72,2,NULL,6,'',2,'2015-08-21',130.10,125.00,NULL,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-08 18:37:58','2015-10-08 18:37:58'),(36,72,2,NULL,9,'',4,'2015-10-21',130.10,125.00,NULL,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-08 18:46:32','2015-10-08 18:46:32'),(43,77,4,18,6,'',9,'2015-08-24',126.55,125.00,NULL,0.00,1.1100,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,'2015-10-14 17:36:09','2015-10-14 18:37:47'),(44,78,4,18,6,'SC-44223#1',9,'2015-09-09',126.10,122.00,NULL,0.00,1.1014,30.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2015-10-14 18:25:44','2016-05-06 11:58:23'),(45,79,4,18,6,'16/047',9,'2015-09-21',122.40,122.40,NULL,0.00,1.1092,30.39,49.00,0.70,NULL,NULL,NULL,NULL,NULL,'','2015-10-14 18:32:24','2016-04-26 18:56:33'),(46,80,1,NULL,NULL,'',NULL,'2015-11-01',141.05,NULL,NULL,0.00,1.0990,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,NULL,'2015-11-13 13:16:43','2015-11-13 13:18:32'),(49,82,1,NULL,6,'16/049',1,'2015-09-21',122.40,122.40,NULL,0.00,1.1098,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'Faltarían 20 sacos para la distribución de esta ficha, que cogeremos del contrato CO-5180901','2016-04-26 14:33:32','2016-04-26 18:14:33'),(53,81,1,12,6,'16/044',3,'2015-09-21',122.40,122.40,NULL,0.00,1.1092,38.33,49.00,0.70,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 15:10:06','2016-04-26 15:44:30'),(55,83,1,NULL,6,'16/050',1,'2015-09-21',122.40,122.40,NULL,0.00,1.1098,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 15:21:09','2016-04-26 15:21:09'),(57,84,2,12,6,'31/16017',2,'2015-09-21',122.40,122.40,NULL,0.00,1.1092,0.00,49.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 15:22:54','2016-08-01 19:34:46'),(60,85,1,NULL,6,'16/051',2,'2015-09-21',122.40,122.40,NULL,0.00,1.1098,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 15:27:51','2016-04-26 18:48:01'),(62,86,2,NULL,9,'24/16042',3,'2015-09-21',122.40,122.40,NULL,0.00,1.1098,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 15:31:17','2016-04-26 18:49:29'),(63,84,2,12,9,'24/16036',1,'2015-09-21',122.40,122.40,NULL,0.00,1.1092,50.55,49.00,0.70,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 15:32:21','2016-04-26 15:32:21'),(64,87,1,NULL,6,'16/052',4,'2015-12-01',1535.00,1535.00,NULL,0.00,1.1098,0.00,49.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 17:06:18','2016-04-26 17:06:18'),(65,88,2,NULL,6,'38/16002',2,'2015-12-01',1535.00,1535.00,NULL,0.00,1.1098,0.00,49.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 18:04:13','2016-04-26 18:04:13'),(66,89,2,NULL,9,'24/16043',12,'2015-12-01',1535.00,1535.00,NULL,0.00,1.1098,0.00,49.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-04-26 18:12:09','2016-04-26 18:12:09'),(67,79,4,18,6,'16/16018*1',NULL,'2015-09-21',122.40,122.40,NULL,0.00,1.0270,30.39,49.00,0.70,NULL,NULL,NULL,NULL,NULL,'Primer parcial de esta ficha. La cantidad total se completa con el sobrante de la ficha 16/034.','2016-04-26 19:09:00','2016-04-26 19:10:58'),(68,91,1,NULL,6,'16/16100',NULL,'2016-05-01',2300.00,2300.00,NULL,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-05-10 14:06:28','2016-06-16 13:21:34'),(71,94,1,NULL,NULL,'viet007',10,NULL,NULL,NULL,5.000000,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-06-27 23:20:38','2016-06-27 23:20:38'),(72,96,2,18,NULL,'chou',NULL,'2016-07-01',NULL,NULL,NULL,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-07-06 00:16:32','2016-07-06 00:16:32'),(73,96,1,18,NULL,'sacoz',NULL,'2016-07-01',NULL,NULL,NULL,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-07-06 00:29:45','2016-07-06 00:29:45'),(74,96,2,18,NULL,'20b',NULL,'2016-07-01',NULL,NULL,NULL,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-07-06 00:30:33','2016-07-06 00:30:33'),(75,96,2,18,NULL,'cafen30',NULL,'2016-07-01',NULL,NULL,NULL,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,'','2016-07-06 00:32:00','2016-07-06 00:32:00');
/*!40000 ALTER TABLE `operaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `iso3166` varchar(2) DEFAULT NULL,
  `prefijo_tfno` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  KEY `index2` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Brasil','br',55,'2015-02-06 22:47:29','2015-03-10 12:10:41'),(2,'Colombia','co',NULL,'2015-02-06 22:47:41','2015-02-06 22:47:41'),(3,'España','es',34,'2015-02-07 01:05:18','2015-02-24 23:58:34'),(4,'Tanzania','tz',NULL,'2015-02-07 01:05:31','2015-02-07 01:05:31'),(5,'Francia','fr',33,'2015-02-10 14:24:25','2015-02-24 23:58:23'),(6,'Bélgica','be',32,'2015-03-10 11:15:17','2015-03-10 12:09:41'),(7,'Perú','pe',NULL,'2015-03-10 11:30:38','2015-03-10 11:30:38'),(8,'Kenia','ke',NULL,'2015-03-10 11:42:13','2015-03-10 11:42:13'),(9,'Alemania','de',49,'2015-03-10 11:48:52','2015-03-10 12:10:18'),(10,'Suiza','ch',NULL,'2015-03-10 11:53:43','2015-03-10 11:53:43'),(11,'Estados Unidos','us',NULL,'2015-03-10 11:56:32','2015-03-10 11:56:32'),(12,'Nicaragua','ni',NULL,'2015-03-10 12:02:39','2015-03-10 12:02:39'),(14,'Vietnam','vn',NULL,'2015-03-16 16:31:16','2015-03-16 16:31:16'),(19,'Indonesia','',NULL,'2015-03-16 22:56:37','2015-03-16 22:56:37'),(20,'Etiopía','et',NULL,'2015-03-16 23:06:40','2015-08-18 14:51:16'),(21,'Italia','it',NULL,'2015-03-23 22:58:05','2015-03-23 22:58:05'),(22,'Rusia','',NULL,'2015-03-24 12:57:30','2015-03-24 12:57:30'),(23,'Costa Rica','cr',NULL,'2015-08-18 14:45:09','2015-08-18 14:45:09'),(24,'Guatemala','gt',NULL,'2015-08-18 14:46:10','2015-08-18 14:46:10'),(25,'Honduras','hn',NULL,'2015-08-18 14:47:42','2015-08-18 14:47:42'),(26,'India','in',NULL,'2015-08-20 18:05:21','2015-08-20 18:05:21'),(27,'Congo','',NULL,'2015-10-15 13:41:12','2015-10-15 13:41:12'),(28,'Senegal','',NULL,'2015-10-15 13:43:52','2015-10-15 13:43:52'),(30,'Noruega','',NULL,'2015-10-15 16:14:39','2015-10-15 16:14:39'),(32,'Suecia','',NULL,'2015-10-15 16:31:45','2015-10-15 16:31:45'),(34,'Jamaica','',NULL,'2015-10-19 12:36:35','2015-10-19 12:36:35'),(36,'Uganda','',NULL,'2015-10-19 13:00:18','2015-10-19 13:00:18'),(37,'Papúa Nueva Guinea','',NULL,'2015-10-19 13:12:22','2015-10-19 13:12:22'),(38,'Méjico','',NULL,'2015-10-19 13:18:54','2015-10-19 13:18:54'),(39,'Panamá','',NULL,'2015-10-19 13:19:10','2015-10-19 13:19:10'),(40,'Zimbabwe','',NULL,'2015-10-19 13:19:30','2015-10-19 13:19:30'),(41,'Europa','',NULL,'2015-10-29 16:57:22','2015-10-29 16:57:22'),(42,'Ruanda','11',NULL,'2015-11-17 12:02:53','2015-11-17 12:02:53');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peso_contenedores`
--

DROP TABLE IF EXISTS `peso_contenedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `peso_contenedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peso_contenedores`
--

LOCK TABLES `peso_contenedores` WRITE;
/*!40000 ALTER TABLE `peso_contenedores` DISABLE KEYS */;
/*!40000 ALTER TABLE `peso_contenedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `peso_facturaciones`
--

DROP TABLE IF EXISTS `peso_facturaciones`;
/*!50001 DROP VIEW IF EXISTS `peso_facturaciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `peso_facturaciones` (
  `operacion_id` tinyint NOT NULL,
  `asociado_id` tinyint NOT NULL,
  `cantidad_embalaje_asociado` tinyint NOT NULL,
  `total_embalaje_retirado` tinyint NOT NULL,
  `total_peso_retirado` tinyint NOT NULL,
  `sacos_pendientes` tinyint NOT NULL,
  `peso_pendiente` tinyint NOT NULL,
  `peso_total` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `peso_operaciones`
--

DROP TABLE IF EXISTS `peso_operaciones`;
/*!50001 DROP VIEW IF EXISTS `peso_operaciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `peso_operaciones` (
  `id` tinyint NOT NULL,
  `contrato_id` tinyint NOT NULL,
  `cantidad_embalaje` tinyint NOT NULL,
  `peso` tinyint NOT NULL,
  `peso_retirado` tinyint NOT NULL,
  `peso_embalaje_retirado` tinyint NOT NULL,
  `peso_entrada` tinyint NOT NULL,
  `peso_embalaje_entrada` tinyint NOT NULL,
  `peso_pagado` tinyint NOT NULL,
  `peso_embalaje_pagado` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `precio_actual_fletes`
--

DROP TABLE IF EXISTS `precio_actual_fletes`;
/*!50001 DROP VIEW IF EXISTS `precio_actual_fletes`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `precio_actual_fletes` (
  `id` tinyint NOT NULL,
  `flete_id` tinyint NOT NULL,
  `fecha_inicio` tinyint NOT NULL,
  `fecha_fin` tinyint NOT NULL,
  `coste_contenedor_dolar` tinyint NOT NULL,
  `precio_dolar` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `precio_flete_contratos`
--

DROP TABLE IF EXISTS `precio_flete_contratos`;
/*!50001 DROP VIEW IF EXISTS `precio_flete_contratos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `precio_flete_contratos` (
  `contrato_id` tinyint NOT NULL,
  `puerto_carga_id` tinyint NOT NULL,
  `puerto_destino_id` tinyint NOT NULL,
  `flete_id` tinyint NOT NULL,
  `embalaje_id` tinyint NOT NULL,
  `precio_flete` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `precio_flete_operaciones`
--

DROP TABLE IF EXISTS `precio_flete_operaciones`;
/*!50001 DROP VIEW IF EXISTS `precio_flete_operaciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `precio_flete_operaciones` (
  `id` tinyint NOT NULL,
  `contrato_id` tinyint NOT NULL,
  `puerto_carga_id` tinyint NOT NULL,
  `puerto_destino_id` tinyint NOT NULL,
  `flete_id` tinyint NOT NULL,
  `embalaje_id` tinyint NOT NULL,
  `precio_flete` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `precio_flete_toneladas`
--

DROP TABLE IF EXISTS `precio_flete_toneladas`;
/*!50001 DROP VIEW IF EXISTS `precio_flete_toneladas`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `precio_flete_toneladas` (
  `id` tinyint NOT NULL,
  `flete_id` tinyint NOT NULL,
  `fecha_inicio` tinyint NOT NULL,
  `fecha_fin` tinyint NOT NULL,
  `coste_contenedor_dolar` tinyint NOT NULL,
  `precio_dolar` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `precio_fletes`
--

DROP TABLE IF EXISTS `precio_fletes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `precio_fletes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flete_id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `coste_contenedor_dolar` decimal(6,2) DEFAULT NULL COMMENT 'en $/contenedor',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_precio_fletes_fletes1_idx` (`flete_id`),
  CONSTRAINT `fk_precio_fletes_fletes1` FOREIGN KEY (`flete_id`) REFERENCES `fletes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio_fletes`
--

LOCK TABLES `precio_fletes` WRITE;
/*!40000 ALTER TABLE `precio_fletes` DISABLE KEYS */;
INSERT INTO `precio_fletes` VALUES (8,4,'2014-09-30','2015-12-31',1000.00,'2015-08-25 01:13:46','2016-02-16 12:19:09'),(9,5,'2014-09-30','2015-12-31',1000.00,'2015-08-25 01:14:28','2016-02-16 12:14:05'),(10,6,'2014-09-30','2015-12-31',1000.00,'2015-08-25 01:15:21','2016-02-23 10:57:32'),(11,7,'2014-09-30','2015-12-31',1000.00,'2015-08-25 01:16:21','2016-02-23 10:59:20'),(12,8,'2014-09-30','2015-12-31',1000.00,'2015-08-25 01:16:57','2016-04-26 13:23:53'),(17,1,'2015-06-02','2015-09-30',811.00,'2015-09-08 10:22:12','2015-09-08 10:22:12'),(18,2,'2015-06-02','2015-09-30',811.00,'2015-09-08 10:23:36','2015-09-08 10:23:36'),(19,3,'2015-06-02','2015-09-30',811.00,'2015-09-08 10:27:35','2015-09-08 10:27:35'),(20,9,'2015-06-02','2015-09-30',1036.00,'2015-09-08 10:31:07','2015-09-08 10:31:07'),(21,10,'2015-06-02','2015-09-30',1036.00,'2015-09-08 10:31:37','2015-09-08 10:31:37'),(22,11,'2015-06-02','2015-09-30',1036.00,'2015-09-08 10:32:05','2015-09-08 10:32:05'),(24,3,'2015-10-01','2015-12-31',736.00,'2015-09-22 10:23:44','2015-09-22 10:23:44'),(25,21,'2015-08-13','2015-12-31',585.00,'2015-10-15 14:16:44','2015-10-15 14:17:22'),(26,29,'2015-10-01','2015-10-31',723.00,'2015-10-15 14:25:37','2015-10-15 14:25:37'),(27,31,'2015-10-01','2015-10-31',913.00,'2015-10-15 14:26:27','2015-10-15 14:26:27'),(28,35,'2015-10-01','2015-12-31',736.00,'2015-10-15 14:53:04','2015-10-15 14:53:04'),(29,2,'2015-10-01','2015-12-31',736.00,'2015-10-15 14:57:45','2015-10-15 14:57:45'),(30,1,'2015-10-01','2015-12-31',736.00,'2015-10-15 15:01:37','2015-10-15 15:01:37'),(31,38,'2015-10-01','2015-12-31',736.00,'2015-10-15 15:13:51','2015-10-15 15:13:51'),(32,39,'2015-10-01','2015-12-31',736.00,'2015-10-15 15:24:42','2015-10-15 15:24:42'),(33,9,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:25:47','2015-10-15 15:25:47'),(34,11,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:26:31','2015-10-15 15:26:31'),(35,13,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:27:00','2015-10-15 15:27:00'),(36,10,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:28:03','2015-10-15 15:28:03'),(37,19,'2015-10-01','2015-12-31',1137.00,'2015-11-03 16:24:18','2015-11-03 16:32:26'),(38,20,'2015-10-01','2015-12-31',1537.00,'2015-11-03 16:26:33','2015-11-03 16:30:48'),(39,40,'2015-11-01','2015-11-30',2062.00,'2015-11-04 16:01:28','2015-11-04 16:01:28'),(40,31,'2015-11-01','2015-11-30',733.00,'2015-11-05 10:53:38','2015-11-05 10:53:38'),(41,32,'2015-11-01','2015-11-30',933.00,'2015-11-05 10:54:17','2015-11-05 10:54:17'),(42,29,'2015-11-01','2015-11-30',543.00,'2015-11-05 10:55:51','2015-11-05 10:55:51'),(43,30,'2015-11-01','2015-11-30',743.00,'2015-11-05 10:56:48','2015-11-05 10:56:48'),(44,26,'2015-11-01','2015-11-30',1201.00,'2015-11-05 10:57:32','2015-11-05 10:59:15'),(45,41,'2015-11-01','2015-11-30',1401.00,'2015-11-05 11:01:00','2015-11-05 11:01:00'),(46,33,'2015-11-01','2015-11-30',1200.00,'2015-11-05 11:04:16','2015-11-05 11:04:16'),(47,34,'2015-11-01','2015-11-30',1300.00,'2015-11-05 11:05:26','2015-11-05 11:05:26'),(48,42,'2015-11-01','2015-11-30',1126.00,'2015-11-05 11:09:00','2015-11-05 11:09:00'),(49,43,'2015-11-01','2015-11-30',1426.00,'2015-11-05 11:10:27','2015-11-05 11:10:27'),(50,44,'2015-11-01','2015-11-30',1036.00,'2015-11-05 11:12:27','2015-11-12 16:22:45'),(51,45,'2015-11-01','2015-11-30',1336.00,'2015-11-05 11:13:04','2015-11-05 11:13:04'),(52,33,'2015-12-01','2015-12-31',2200.00,'2015-11-12 13:39:02','2015-11-12 13:39:02'),(54,1,'2016-01-01','2016-06-30',736.00,'2016-02-16 11:58:50','2016-02-16 11:58:50'),(55,3,'2016-01-01','2016-06-30',736.00,'2016-02-16 11:59:34','2016-02-16 11:59:34'),(56,2,'2016-01-01','2016-06-30',736.00,'2016-02-16 12:00:04','2016-02-16 12:00:04'),(57,38,'2016-01-01','2016-06-30',736.00,'2016-02-16 12:00:51','2016-02-16 12:00:51'),(58,39,'2016-01-01','2016-06-30',736.00,'2016-02-16 12:01:24','2016-02-16 12:01:24'),(59,35,'2016-01-01','2016-06-30',736.00,'2016-02-16 12:02:41','2016-02-16 12:02:41'),(60,10,'2016-01-01','2016-06-30',1011.00,'2016-02-16 12:03:36','2016-02-16 12:03:36'),(61,11,'2016-01-01','2016-06-30',1011.00,'2016-02-16 12:04:03','2016-02-16 12:04:03'),(62,9,'2016-01-01','2016-06-30',1011.00,'2016-02-16 12:04:41','2016-02-16 12:04:41'),(64,5,'2016-01-01','2016-03-31',660.00,'2016-02-16 12:11:01','2016-02-16 12:11:01'),(65,4,'2016-01-01','2016-03-31',660.00,'2016-02-16 12:22:27','2016-02-16 12:22:27'),(66,36,'2015-01-01','2016-03-31',1485.00,'2016-02-23 10:45:09','2016-02-23 10:45:09'),(67,14,'2016-01-01','2016-03-31',1485.00,'2016-02-23 10:45:53','2016-02-23 10:54:52'),(68,6,'2016-01-01','2016-04-30',712.00,'2016-02-23 10:50:01','2016-02-23 11:00:08'),(69,7,'2016-01-01','2016-04-30',712.00,'2016-02-23 10:59:36','2016-02-23 10:59:36'),(70,21,'2016-01-01','2016-06-30',585.00,'2016-02-23 11:16:27','2016-02-23 11:16:27'),(71,15,'2016-01-01','2016-03-31',1117.00,'2016-02-23 11:26:33','2016-02-23 11:30:28'),(72,17,'2016-01-01','2016-03-31',1116.00,'2016-02-23 11:29:27','2016-02-23 11:29:27'),(73,20,'2016-01-01','2016-03-31',1577.00,'2016-02-23 11:32:28','2016-02-23 11:57:07'),(74,19,'2016-01-01','2016-03-31',1118.00,'2016-02-23 11:44:36','2016-02-23 11:44:36'),(75,44,'2016-01-01','2016-03-31',1141.00,'2016-02-23 11:54:14','2016-02-23 11:54:14'),(76,5,'2016-04-01','2016-06-30',612.00,'2016-04-26 12:59:25','2016-04-26 12:59:25'),(77,13,'2016-04-01','2016-06-30',837.00,'2016-04-26 13:01:35','2016-04-26 13:01:35'),(78,14,'2016-04-01','2016-06-30',1462.00,'2016-04-26 13:03:01','2016-04-26 13:03:01'),(79,36,'2016-04-01','2016-06-30',1462.00,'2016-04-26 13:03:54','2016-04-26 13:03:54'),(80,4,'2016-04-01','2016-06-30',612.00,'2016-04-26 13:05:06','2016-04-26 13:05:06'),(81,12,'2016-04-01','2016-06-30',837.00,'2016-04-26 13:10:38','2016-04-26 13:10:38'),(82,15,'2016-04-01','2016-06-30',1177.00,'2016-04-26 13:12:32','2016-04-26 13:14:04'),(83,17,'2016-04-01','2016-06-30',1177.00,'2016-04-26 13:16:26','2016-04-26 13:16:26'),(84,19,'2016-04-01','2016-06-30',1177.00,'2016-04-26 13:18:15','2016-04-26 13:18:15'),(85,20,'2016-04-01','2016-06-30',1577.00,'2016-04-26 13:19:14','2016-04-26 13:19:14'),(86,7,'2016-04-30','2016-06-30',712.00,'2016-04-26 13:24:32','2016-04-26 13:24:32'),(87,6,'2016-04-30','2016-06-30',712.00,'2016-04-26 13:25:36','2016-04-26 13:25:36'),(88,46,'2016-04-01','2016-06-30',712.00,'2016-04-26 13:27:13','2016-04-26 13:27:13'),(89,47,'2016-04-01','2016-06-30',712.00,'2016-04-26 13:28:55','2016-04-26 13:28:55'),(90,35,'2015-01-01','2015-09-30',720.00,'2016-06-21 15:06:26','2016-06-21 15:06:47');
/*!40000 ALTER TABLE `precio_fletes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `precio_operaciones`
--

DROP TABLE IF EXISTS `precio_operaciones`;
/*!50001 DROP VIEW IF EXISTS `precio_operaciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `precio_operaciones` (
  `id` tinyint NOT NULL,
  `precio_divisa` tinyint NOT NULL,
  `precio_divisa_tonelada` tinyint NOT NULL,
  `divisa` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `precio_total_operaciones`
--

DROP TABLE IF EXISTS `precio_total_operaciones`;
/*!50001 DROP VIEW IF EXISTS `precio_total_operaciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `precio_total_operaciones` (
  `id` tinyint NOT NULL,
  `precio_divisa_tonelada` tinyint NOT NULL,
  `divisa` tinyint NOT NULL,
  `precio_euro_tonelada` tinyint NOT NULL,
  `seguro_euro_tonelada` tinyint NOT NULL,
  `precio_euro_kilo_total` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_proveedores_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (36,'2015-03-10 11:26:58','2015-03-10 11:26:58'),(37,'2015-03-10 11:39:25','2015-03-10 11:45:29'),(38,'2015-03-10 11:39:47','2015-09-22 12:39:32'),(39,'2015-03-10 11:43:30','2015-08-29 00:47:31'),(40,'2015-03-10 11:45:07','2015-03-10 11:45:07'),(41,'2015-03-10 11:49:34','2015-03-10 11:49:34'),(43,'2015-03-10 11:54:19','2015-03-10 11:54:19'),(44,'2015-03-10 11:57:06','2015-03-10 11:57:06'),(45,'2015-03-10 11:59:27','2015-03-10 11:59:27'),(47,'2015-03-10 12:03:18','2015-03-10 12:03:18'),(48,'2015-03-10 12:05:28','2015-03-10 12:05:28'),(88,'2015-07-25 14:32:58','2015-07-25 14:32:58'),(115,'2015-10-08 17:37:49','2015-10-08 17:37:49'),(116,'2015-10-08 17:50:08','2015-10-08 17:52:02'),(118,'2015-10-08 17:59:25','2015-10-08 17:59:25'),(123,'2016-07-29 12:54:28','2016-07-29 13:15:27');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puertos`
--

DROP TABLE IF EXISTS `puertos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `puertos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `pais_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  KEY `fk_puertos_paises1_idx` (`pais_id`),
  CONSTRAINT `fk_puertos_paises1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puertos`
--

LOCK TABLES `puertos` WRITE;
/*!40000 ALTER TABLE `puertos` DISABLE KEYS */;
INSERT INTO `puertos` VALUES (1,'Venecia',9,'2015-06-15 13:05:17','2015-07-09 18:47:38'),(2,'Marsella',5,'2015-06-15 13:05:27','2015-06-15 13:05:27'),(3,'San Petesburgo',22,'2015-06-15 13:05:39','2015-06-15 13:05:39'),(5,'Burdeos',9,'2015-07-17 19:12:12','2015-07-17 19:12:12'),(6,'Barcelona',3,'2015-07-17 19:14:47','2016-07-29 13:12:00'),(7,'Bilbao',3,'2015-07-17 19:14:57','2015-07-17 19:15:02'),(8,'Santander',3,'2015-07-17 19:15:07','2015-07-17 19:15:21'),(9,'Gijón',3,'2015-07-25 14:16:11','2015-07-25 14:16:11'),(11,'Trieste',21,'2015-07-28 11:08:34','2015-07-28 11:08:34'),(12,'Santos',1,'2015-08-18 14:43:13','2015-08-18 14:43:13'),(13,'Rio',1,'2015-08-18 14:43:26','2015-08-18 14:43:26'),(14,'Salvador',1,'2015-08-18 14:43:39','2015-08-18 14:43:39'),(15,'Pto. Limón',23,'2015-08-18 14:45:29','2015-08-18 14:45:29'),(16,'Sto. Tomás Castilla',24,'2015-08-18 14:46:40','2015-08-18 14:46:40'),(17,'Pto. Cortés',25,'2015-08-18 14:48:11','2015-08-18 14:48:11'),(18,'Cartagena',2,'2015-08-18 14:48:49','2015-08-18 14:48:49'),(19,'Buenaventura',2,'2015-08-18 14:49:07','2015-08-18 14:49:07'),(20,'Managua',12,'2015-08-18 14:49:49','2015-08-18 14:49:49'),(21,'Matagalpa',12,'2015-08-18 14:50:00','2015-08-18 14:50:00'),(22,'Djibuti',20,'2015-08-18 14:51:33','2015-08-18 14:51:33'),(23,'Mombasa',8,'2015-08-18 14:51:54','2015-08-20 18:08:08'),(24,'Dar Salaam',4,'2015-08-18 14:52:22','2015-08-18 14:52:22'),(25,'Cochin',26,'2015-08-20 18:05:47','2015-08-20 18:05:47'),(26,'Mangalore',26,'2015-08-20 18:06:04','2015-08-20 18:06:04'),(27,'Ho Chi Minh',14,'2015-08-20 18:06:34','2015-08-20 18:06:34');
/*!40000 ALTER TABLE `puertos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `reparto_operacion_asociados`
--

DROP TABLE IF EXISTS `reparto_operacion_asociados`;
/*!50001 DROP VIEW IF EXISTS `reparto_operacion_asociados`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `reparto_operacion_asociados` (
  `id` tinyint NOT NULL,
  `asociado_id` tinyint NOT NULL,
  `porcentaje_embalaje_asociado` tinyint NOT NULL,
  `peso_asociado` tinyint NOT NULL,
  `precio_asociado` tinyint NOT NULL,
  `iva` tinyint NOT NULL,
  `comision` tinyint NOT NULL,
  `iva_comision` tinyint NOT NULL,
  `total_anticipo` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `resto_contratos`
--

DROP TABLE IF EXISTS `resto_contratos`;
/*!50001 DROP VIEW IF EXISTS `resto_contratos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `resto_contratos` (
  `id` tinyint NOT NULL,
  `peso_restante` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `resto_contratos2`
--

DROP TABLE IF EXISTS `resto_contratos2`;
/*!50001 DROP VIEW IF EXISTS `resto_contratos2`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `resto_contratos2` (
  `id` tinyint NOT NULL,
  `peso_restante` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `resto_lotes_contratos`
--

DROP TABLE IF EXISTS `resto_lotes_contratos`;
/*!50001 DROP VIEW IF EXISTS `resto_lotes_contratos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `resto_lotes_contratos` (
  `id` tinyint NOT NULL,
  `lotes_restantes` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `retiradas`
--

DROP TABLE IF EXISTS `retiradas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retiradas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `embalaje_retirado` int(6) DEFAULT NULL,
  `peso_retirado` decimal(8,2) DEFAULT NULL,
  `fecha_retirada` date NOT NULL,
  `asociado_id` int(11) NOT NULL,
  `almacen_transporte_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `operacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_retiradas_asociados1_idx` (`asociado_id`),
  KEY `fk_retiradas_almacen_transportes1_idx` (`almacen_transporte_id`),
  CONSTRAINT `fk_retiradas_almacen_transportes1` FOREIGN KEY (`almacen_transporte_id`) REFERENCES `almacen_transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retiradas_asociados1` FOREIGN KEY (`asociado_id`) REFERENCES `asociados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retiradas`
--

LOCK TABLES `retiradas` WRITE;
/*!40000 ALTER TABLE `retiradas` DISABLE KEYS */;
INSERT INTO `retiradas` VALUES (4,15,900.00,'2016-06-17',68,23,'2016-06-17 12:54:25','2016-06-17 12:54:25',45),(5,1,69.00,'2016-06-17',75,21,'2016-06-17 13:43:28','2016-06-17 13:43:28',67),(6,5,300.00,'2016-08-01',78,45,'2016-08-01 18:20:01','2016-08-01 18:20:01',55);
/*!40000 ALTER TABLE `retiradas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguros`
--

DROP TABLE IF EXISTS `seguros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguros` (
  `id` int(11) NOT NULL,
  `fecha_seguro` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguros`
--

LOCK TABLES `seguros` WRITE;
/*!40000 ALTER TABLE `seguros` DISABLE KEYS */;
INSERT INTO `seguros` VALUES (1,'2015-01-01 00:00:00',NULL,NULL);
/*!40000 ALTER TABLE `seguros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_ivas`
--

DROP TABLE IF EXISTS `tipo_ivas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_ivas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_ivas`
--

LOCK TABLES `tipo_ivas` WRITE;
/*!40000 ALTER TABLE `tipo_ivas` DISABLE KEYS */;
INSERT INTO `tipo_ivas` VALUES (1,'superreducido','2015-10-20 01:57:57','2015-10-20 01:57:57'),(3,'reducido','2015-10-31 13:20:17','2015-10-31 13:20:10'),(4,'general','2015-10-31 13:20:17','2015-10-31 13:20:17');
/*!40000 ALTER TABLE `tipo_ivas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transportes`
--

DROP TABLE IF EXISTS `transportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naviera_id` int(11) DEFAULT NULL,
  `agente_id` int(11) DEFAULT NULL,
  `operacion_id` int(11) NOT NULL,
  `puerto_destino_id` int(11) DEFAULT NULL,
  `puerto_carga_id` int(11) DEFAULT NULL,
  `aseguradora_id` int(11) DEFAULT NULL,
  `cantidad_embalaje` int(11) DEFAULT NULL,
  `fecha_entradamerc` date DEFAULT NULL,
  `fecha_carga` date DEFAULT NULL,
  `fecha_prevista` date DEFAULT NULL,
  `fecha_llegada` date DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_enviodoc` date DEFAULT NULL,
  `fecha_despacho_op` date DEFAULT NULL,
  `fecha_vencimiento_seg` date DEFAULT NULL,
  `fecha_reclamacion` date DEFAULT NULL,
  `fecha_limite_retirada` date DEFAULT NULL,
  `fecha_reclamacion_factura` date DEFAULT NULL,
  `nombre_vehiculo` varchar(45) NOT NULL,
  `matricula` varchar(45) NOT NULL,
  `observaciones` text,
  `fecha_seguro` date DEFAULT NULL,
  `coste_seguro` decimal(8,2) DEFAULT NULL,
  `suplemento_seguro` varchar(30) DEFAULT NULL,
  `peso_factura` decimal(8,2) DEFAULT NULL,
  `peso_neto` decimal(8,2) DEFAULT NULL,
  `peritacion` decimal(8,2) DEFAULT NULL,
  `averia` decimal(8,2) DEFAULT NULL,
  `modified` datetime DEFAULT NULL COMMENT '\n',
  `created` datetime DEFAULT NULL,
  `linea` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transportes_navieras1_idx` (`naviera_id`),
  KEY `fk_transportes_agentes1_idx` (`agente_id`),
  KEY `fk_transportes_operaciones1_idx` (`operacion_id`),
  KEY `fk_transportes_aseguradoras1_idx` (`aseguradora_id`),
  KEY `fk_transportes_puertos1_idx` (`puerto_destino_id`),
  KEY `fk_transportes_puertos2_idx` (`puerto_carga_id`),
  CONSTRAINT `fk_transportes_agentes1` FOREIGN KEY (`agente_id`) REFERENCES `agentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transportes_navieras1` FOREIGN KEY (`naviera_id`) REFERENCES `navieras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transportes_operaciones1` FOREIGN KEY (`operacion_id`) REFERENCES `operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transportes_puertos1` FOREIGN KEY (`puerto_destino_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportes`
--

LOCK TABLES `transportes` WRITE;
/*!40000 ALTER TABLE `transportes` DISABLE KEYS */;
INSERT INTO `transportes` VALUES (78,98,87,43,6,18,89,550,NULL,'2016-02-28',NULL,NULL,'2016-03-16',NULL,NULL,NULL,'2016-03-17',NULL,NULL,'ERATO','COCTG1600360','LLEGADA PREVISTA A BARCELONA 25/03/16\r\n\r\nDOC.CARMEN',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-07-28 17:11:37','2016-03-17 13:46:37',1),(80,95,64,27,6,13,89,100,'2015-02-17','2015-01-18',NULL,'2015-02-12','2015-01-28','2015-02-10','2015-02-19',NULL,'2016-04-26',NULL,NULL,'MSC CADIZ','MSCURS360528','','2015-01-18',NULL,'156-3',NULL,100000.00,NULL,NULL,'2016-04-26 11:18:21','2016-04-26 11:18:21',1),(82,NULL,NULL,32,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-04-26',NULL,NULL,'asdasdas','dasdasd','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-04-26 12:02:41','2016-04-26 11:44:23',3),(84,NULL,NULL,32,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-04-26',NULL,NULL,'ytry','ry','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-04-26 12:02:22','2016-04-26 12:02:22',4),(87,NULL,NULL,62,6,NULL,NULL,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ALM.VIORVI','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-14 13:55:15','2016-06-14 13:55:15',1),(88,101,105,66,6,27,NULL,120,'2016-05-09','2016-04-02',NULL,'2016-05-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'PACO','VNSG125369','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-14 13:57:43','2016-06-14 13:57:43',1),(91,NULL,NULL,46,6,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'a','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-15 12:27:22','2016-06-15 12:27:22',2),(92,NULL,59,46,6,23,NULL,50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'kh72','','',NULL,NULL,NULL,3000.00,NULL,NULL,NULL,'2016-06-15 12:30:51','2016-06-15 12:30:51',12345),(93,NULL,NULL,46,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'lolala','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-15 12:38:05','2016-06-15 12:38:05',4),(94,NULL,NULL,46,NULL,NULL,NULL,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'esto es prueba','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-15 12:38:41','2016-06-15 12:38:41',6),(95,NULL,NULL,66,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Transporto','585 RJC','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-15 12:44:45','2016-06-15 12:44:45',2),(98,NULL,59,46,6,23,NULL,50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'kh72122','','',NULL,NULL,NULL,3000.00,NULL,NULL,NULL,'2016-06-15 12:56:46','2016-06-15 12:56:46',1),(104,NULL,NULL,46,NULL,NULL,NULL,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'kalimba','','',NULL,NULL,NULL,595.00,NULL,NULL,NULL,'2016-06-15 13:44:55','2016-06-15 13:44:55',6),(105,NULL,NULL,34,NULL,NULL,NULL,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Transpi','REJ634','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-15 14:16:22','2016-06-15 14:16:22',1),(106,NULL,64,68,7,NULL,NULL,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'STORE1','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-16 12:20:54','2016-06-16 12:20:54',1),(107,NULL,87,68,9,NULL,NULL,25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Store2','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-16 12:22:54','2016-06-16 12:22:54',2),(108,96,59,67,8,6,NULL,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Transp1','GTR123','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-17 10:56:59','2016-06-17 10:56:59',1),(109,95,59,67,6,5,NULL,5,NULL,'2016-01-01',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'858Tran','DE12','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-17 11:00:25','2016-06-17 11:00:25',2),(110,95,105,67,6,6,NULL,2,'2017-03-03','2017-03-03','2018-03-03','2018-03-04','2017-03-03','2017-04-03','2015-04-04',NULL,NULL,NULL,NULL,'Trnas858','585RJO','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-17 11:02:00','2016-06-17 11:02:00',3),(111,NULL,NULL,67,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Trans21','MAT21','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-17 11:03:01','2016-06-17 11:03:01',4),(112,NULL,NULL,67,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Trans221','MAT231','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-17 11:04:05','2016-06-17 11:04:05',5),(113,NULL,NULL,67,NULL,NULL,NULL,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Tra','RJO00','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-17 11:05:44','2016-06-17 11:05:44',6),(114,NULL,NULL,67,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'RR','TT','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-17 11:06:55','2016-06-17 11:06:55',7),(115,97,60,45,9,6,91,100,'2016-01-03','2016-01-02','2016-02-02','2017-03-01','2016-03-02','2015-02-03','2015-02-02',NULL,NULL,NULL,NULL,'TransOP','BL4131','','2015-01-02',NULL,'20',NULL,NULL,NULL,NULL,'2016-06-17 11:40:18','2016-06-17 11:40:18',1),(116,97,64,53,9,19,NULL,200,'2018-12-30','2017-01-02','2016-01-02','2016-02-02','2016-03-04','2016-03-02','2015-01-01',NULL,NULL,NULL,NULL,'STAR1º','MATRI1','',NULL,NULL,'',NULL,NULL,NULL,NULL,'2016-06-20 17:06:23','2016-06-20 17:06:23',1),(117,NULL,59,55,6,NULL,NULL,80,NULL,NULL,'2015-02-01',NULL,'2015-01-02','2016-01-01','2016-01-02',NULL,NULL,'2015-02-01','2016-02-01','Instore1','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-06-24 18:24:26','2016-06-24 18:24:26',1),(118,NULL,64,49,8,NULL,NULL,200,NULL,NULL,NULL,NULL,'2016-07-04','2016-08-16','2016-09-08',NULL,NULL,'2017-06-08',NULL,'RJC','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-28 12:26:07','2016-07-28 12:26:07',1),(119,96,60,64,7,19,NULL,500,'2015-01-01','2015-01-01','2015-01-01','2015-01-01','2015-01-01','2015-01-01','2015-01-01',NULL,NULL,'2015-01-01','2015-01-01','RCJ!32','3123MAT','Todo es una prueba\r\n',NULL,NULL,NULL,31500.00,NULL,NULL,NULL,'2016-07-28 12:27:58','2016-07-28 12:27:58',1);
/*!40000 ALTER TABLE `transportes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'eric','$2a$10$jMEHuvLhJj6sb/3FOCDfRuMIwL.DSXK1yvY4TtxHuOFGefITC7qAK','admin','2016-06-29 23:44:46','2016-06-29 23:44:46'),(2,'rodolfo','$2a$10$9yzrFh7mpXEqwBSCghTeVuGuqmwhJ/JeHcrYwEfU9RipDOYJl5p/O','admin','2016-06-29 23:47:15','2016-06-29 23:47:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `departamento_id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `funcion` varchar(45) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_departamentos1_idx` (`departamento_id`),
  CONSTRAINT `fk_usuarios_departamentos1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (8,2,'Carlos Erausquin',NULL,NULL,'cerausquinr@cmpsa.com','','','',NULL,'2016-06-14 11:57:25','2016-06-14 11:57:25'),(9,2,'Mar Fernández',NULL,NULL,'marfernandez@cmpsa.com','','','',NULL,'2016-06-14 11:57:45','2016-06-14 11:57:45'),(10,4,'Yolanda Ordóñez',NULL,NULL,'yolandaordonez@cmpsa.com','','','',NULL,'2016-06-14 11:58:20','2016-06-14 11:58:20'),(12,4,'Carmen Villar',NULL,NULL,'mvillarm@cmpsa.com','','','',NULL,'2016-06-14 11:58:49','2016-06-14 11:58:49'),(13,5,'Eric Van Buggenhaut','eric','$2a$10$gNizQfpmIAWhFiu9HZ2aJeZtRWsurJ/BnG57it70.gNe6ubGIW8uy','eric@circuletica.org','618557588','','','admin',NULL,'2016-07-04 15:00:21'),(14,5,'Rodolfo Gonzalez','rodolfo','$2a$10$9yzrFh7mpXEqwBSCghTeVuGuqmwhJ/JeHcrYwEfU9RipDOYJl5p/O','rodol@circuletica.org',NULL,NULL,NULL,'admin',NULL,NULL),(15,1,'Admin CMPSA','admin','$2a$10$JhloLRQawsHdfG1k7o1uBOwb0xJaHjw5AlEL1gUZvrEmr/2gPm9cK','','','','Admin aplicación gestión','admin','2016-07-04 14:49:42','2016-07-04 14:49:42');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `valor_iva_comisiones`
--

DROP TABLE IF EXISTS `valor_iva_comisiones`;
/*!50001 DROP VIEW IF EXISTS `valor_iva_comisiones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `valor_iva_comisiones` (
  `financiacion_id` tinyint NOT NULL,
  `tipo_iva_id` tinyint NOT NULL,
  `nombre` tinyint NOT NULL,
  `valor` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `valor_iva_financiaciones`
--

DROP TABLE IF EXISTS `valor_iva_financiaciones`;
/*!50001 DROP VIEW IF EXISTS `valor_iva_financiaciones`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `valor_iva_financiaciones` (
  `financiacion_id` tinyint NOT NULL,
  `tipo_iva_id` tinyint NOT NULL,
  `nombre` tinyint NOT NULL,
  `valor` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `valor_tipo_ivas`
--

DROP TABLE IF EXISTS `valor_tipo_ivas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `valor_tipo_ivas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_iva_id` int(11) NOT NULL,
  `valor` decimal(4,2) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_valor_tipo_ivas_tipo_ivas1_idx` (`tipo_iva_id`),
  CONSTRAINT `fk_valor_tipo_ivas_tipo_ivas1` FOREIGN KEY (`tipo_iva_id`) REFERENCES `tipo_ivas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valor_tipo_ivas`
--

LOCK TABLES `valor_tipo_ivas` WRITE;
/*!40000 ALTER TABLE `valor_tipo_ivas` DISABLE KEYS */;
INSERT INTO `valor_tipo_ivas` VALUES (1,1,3.00,'1993-01-01','1994-12-31',NULL,'2015-10-31 13:38:05'),(2,1,4.00,'1995-01-01','2015-12-31','2015-10-31 13:33:53','2015-10-31 13:33:53'),(3,3,10.00,'2012-09-01',NULL,'2015-10-31 13:34:45','2015-10-31 13:34:45'),(4,3,8.00,'2010-07-01','2012-08-31','2015-10-31 13:37:03','2015-10-31 13:37:03'),(5,4,21.00,'2012-09-01',NULL,'2015-10-31 13:39:28','2015-10-31 13:39:28'),(6,4,18.00,'2010-06-01','2012-08-31','2015-10-31 13:40:54','2015-10-31 13:40:54'),(7,1,5.00,'2016-01-01','2016-12-31','2015-11-01 00:10:29','2015-11-01 00:10:29');
/*!40000 ALTER TABLE `valor_tipo_ivas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'cmpsa_migration'
--
/*!50003 DROP FUNCTION IF EXISTS `precioFleteDolarTonelada` */;
ALTER DATABASE `cmpsa_migration` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`cmpsa`@`localhost` FUNCTION `precioFleteDolarTonelada`(flete_id INT(11), fecha DATE) RETURNS decimal(6,2)
    READS SQL DATA
    DETERMINISTIC
begin         DECLARE precio decimal(6,2);                  SELECT ROUND(p.coste_contenedor_dolar / f.peso_contenedor_tm,                         2) INTO precio                  FROM fletes f LEFT JOIN precio_fletes p ON f.id=p.flete_id                  WHERE f.id = flete_id AND          ((p.`fecha_inicio` <= fecha)                     AND ((p.`fecha_fin` > fecha)                     OR ISNULL(p.`fecha_fin`)))         ;         return precio;         end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `cmpsa_migration` CHARACTER SET utf8 COLLATE utf8_general_ci ;
/*!50003 DROP FUNCTION IF EXISTS `total_asociado_financiacion` */;
ALTER DATABASE `cmpsa_migration` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`cmpsa`@`localhost` FUNCTION `total_asociado_financiacion`(operacion_id INT(11), asociado_id INT(11)) RETURNS decimal(8,2)
    READS SQL DATA
    DETERMINISTIC
begin DECLARE total decimal(8,2); SELECT sum(a.importe) into total FROM asociado_operaciones ao LEFT JOIN anticipos a ON ao.id=a.asociado_operacion_id WHERE ao.operacion_id = operacion_id AND ao.asociado_id = asociado_id ; return total; end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `cmpsa_migration` CHARACTER SET utf8 COLLATE utf8_general_ci ;
/*!50003 DROP FUNCTION IF EXISTS `VALOR_COMISION_ASOCIADO` */;
ALTER DATABASE `cmpsa_migration` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`cmpsa`@`localhost` FUNCTION `VALOR_COMISION_ASOCIADO`(asociado_id INT(11), fecha DATE) RETURNS decimal(9,8)
    READS SQL DATA
    DETERMINISTIC
begin
DECLARE valor decimal(9,8);
SELECT c.valor into valor
FROM asociado_comisiones a LEFT JOIN comisiones c ON (a.comision_id = c.id)
WHERE a.asociado_id = asociado_id and
        ((a.`fecha_inicio` <= fecha)
            AND ((a.`fecha_fin` > fecha)
            OR ISNULL(a.`fecha_fin`)))
;
return valor;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `cmpsa_migration` CHARACTER SET utf8 COLLATE utf8_general_ci ;
/*!50003 DROP FUNCTION IF EXISTS `valor_iva_comision` */;
ALTER DATABASE `cmpsa_migration` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`cmpsa`@`192.168.2.35` FUNCTION `valor_iva_comision`(tipo_iva_id INT(11), fecha DATE) RETURNS decimal(4,2)
    READS SQL DATA
    DETERMINISTIC
begin
DECLARE valor decimal(4,2);
SELECT v.valor into valor
FROM valor_tipo_ivas v
WHERE v.tipo_iva_id = tipo_iva_id
	AND((v.`fecha_inicio` <= fecha)
            AND ((v.`fecha_fin` > fecha)
            OR ISNULL(v.`fecha_fin`)))
;
return valor;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `cmpsa_migration` CHARACTER SET utf8 COLLATE utf8_general_ci ;
/*!50003 DROP FUNCTION IF EXISTS `valor_iva_financiacion` */;
ALTER DATABASE `cmpsa_migration` CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`cmpsa`@`192.168.2.35` FUNCTION `valor_iva_financiacion`(financiacion_id INT(11)) RETURNS decimal(4,2)
    READS SQL DATA
    DETERMINISTIC
begin
DECLARE valor decimal(4,2);
SELECT v.valor into valor
FROM financiaciones f LEFT JOIN valor_tipo_ivas v ON (f.tipo_iva_id = v.tipo_iva_id)
WHERE f.id = financiacion_id and
  ((v.`fecha_inicio` <= f.fecha_vencimiento)
            AND ((v.`fecha_fin` > f.fecha_vencimiento)
            OR ISNULL(v.`fecha_fin`)))
;
return valor;
end ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
ALTER DATABASE `cmpsa_migration` CHARACTER SET utf8 COLLATE utf8_general_ci ;

--
-- Final view structure for view `almacen_repartos`
--

/*!50001 DROP TABLE IF EXISTS `almacen_repartos`*/;
/*!50001 DROP VIEW IF EXISTS `almacen_repartos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `almacen_repartos` AS select `a`.`id` AS `id`,`a`.`cuenta_almacen` AS `cuenta_almacen`,`a`.`cantidad_cuenta` AS `cantidad_cuenta`,`ao`.`asociado_id` AS `asociado_id`,round(((`ao`.`cantidad_embalaje_asociado` / (select ifnull(sum(`ao`.`cantidad_embalaje_asociado`),0) from `asociado_operaciones` `ao` where (`ao`.`operacion_id` = `t`.`operacion_id`))) * 100),2) AS `porcentaje_embalaje_asociado`,round(((((`ao`.`cantidad_embalaje_asociado` / (select ifnull(sum(`ao`.`cantidad_embalaje_asociado`),0) from `asociado_operaciones` `ao` where (`ao`.`operacion_id` = `t`.`operacion_id`))) * 100) * `a`.`cantidad_cuenta`) / 100),0) AS `sacos_asignados` from ((`almacen_transportes` `a` left join `transportes` `t` on((`a`.`transporte_id` = `t`.`id`))) left join `asociado_operaciones` `ao` on((`t`.`operacion_id` = `ao`.`operacion_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `calidad_nombres`
--

/*!50001 DROP TABLE IF EXISTS `calidad_nombres`*/;
/*!50001 DROP VIEW IF EXISTS `calidad_nombres`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `calidad_nombres` AS select `c`.`id` AS `id`,(case when isnull(`c`.`pais_id`) then concat(replace(replace(`c`.`descafeinado`,0,''),1,'Descafeinado '),'Blend','-',`c`.`descripcion`) else concat(replace(replace(`c`.`descafeinado`,0,''),1,'Descafeinado '),`p`.`nombre`,'-',`c`.`descripcion`) end) AS `nombre` from (`calidades` `c` left join `paises` `p` on((`c`.`pais_id` = `p`.`id`))) order by (case when isnull(`c`.`pais_id`) then concat(replace(replace(`c`.`descafeinado`,0,''),1,'Descafeinado '),'Blend','-',`c`.`descripcion`) else concat(replace(replace(`c`.`descafeinado`,0,''),1,'Descafeinado '),`p`.`nombre`,'-',`c`.`descripcion`) end) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `criba_ponderadas`
--

/*!50001 DROP TABLE IF EXISTS `criba_ponderadas`*/;
/*!50001 DROP VIEW IF EXISTS `criba_ponderadas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `criba_ponderadas` AS select `linea_muestras`.`id` AS `id`,`linea_muestras`.`criba20` AS `criba20`,`linea_muestras`.`criba19` AS `criba19`,(coalesce(`linea_muestras`.`criba13p`,0) + coalesce(`linea_muestras`.`criba18`,0)) AS `criba18`,(coalesce(`linea_muestras`.`criba12p`,0) + coalesce(`linea_muestras`.`criba17`,0)) AS `criba17`,(coalesce(`linea_muestras`.`criba11p`,0) + coalesce(`linea_muestras`.`criba16`,0)) AS `criba16`,(coalesce(`linea_muestras`.`criba10p`,0) + coalesce(`linea_muestras`.`criba15`,0)) AS `criba15`,(coalesce(`linea_muestras`.`criba9p`,0) + coalesce(`linea_muestras`.`criba14`,0)) AS `criba14`,(coalesce(`linea_muestras`.`criba8p`,0) + coalesce(`linea_muestras`.`criba13`,0)) AS `criba13`,`linea_muestras`.`criba12` AS `criba12`,(((((((((0.2 * coalesce(`linea_muestras`.`criba20`,0)) + (0.19 * coalesce(`linea_muestras`.`criba19`,0))) + (0.18 * (coalesce(`linea_muestras`.`criba13p`,0) + coalesce(`linea_muestras`.`criba18`,0)))) + (0.17 * (coalesce(`linea_muestras`.`criba12p`,0) + coalesce(`linea_muestras`.`criba17`,0)))) + (0.16 * (coalesce(`linea_muestras`.`criba11p`,0) + coalesce(`linea_muestras`.`criba16`,0)))) + (0.15 * (coalesce(`linea_muestras`.`criba10p`,0) + coalesce(`linea_muestras`.`criba15`,0)))) + (0.14 * (coalesce(`linea_muestras`.`criba9p`,0) + coalesce(`linea_muestras`.`criba14`,0)))) + (0.13 * (coalesce(`linea_muestras`.`criba8p`,0) + coalesce(`linea_muestras`.`criba13`,0)))) + (0.12 * coalesce(`linea_muestras`.`criba12`,0))) AS `criba_media` from `linea_muestras` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `flete_contratos`
--

/*!50001 DROP TABLE IF EXISTS `flete_contratos`*/;
/*!50001 DROP VIEW IF EXISTS `flete_contratos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `flete_contratos` AS select `fletes`.`id` AS `flete_id`,`contratos`.`id` AS `contrato_id`,`fletes`.`naviera_id` AS `naviera_id`,`fletes`.`puerto_carga_id` AS `puerto_carga_id`,`fletes`.`puerto_destino_id` AS `puerto_destino_id`,`fletes`.`embalaje_id` AS `embalaje_id`,`precioFleteDolarTonelada`(`fletes`.`id`,`contratos`.`fecha_transporte`) AS `precio_flete` from (`fletes` join `contratos`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `flete_fecha_hoy`
--

/*!50001 DROP TABLE IF EXISTS `flete_fecha_hoy`*/;
/*!50001 DROP VIEW IF EXISTS `flete_fecha_hoy`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `flete_fecha_hoy` AS select `precio_flete_toneladas`.`flete_id` AS `flete_id`,`precio_flete_toneladas`.`fecha_inicio` AS `fecha_inicio`,`precio_flete_toneladas`.`fecha_fin` AS `fecha_fin` from `precio_flete_toneladas` where ((`precio_flete_toneladas`.`fecha_inicio` <= cast(now() as date)) and ((`precio_flete_toneladas`.`fecha_fin` > cast(now() as date)) or isnull(`precio_flete_toneladas`.`fecha_fin`))) group by `precio_flete_toneladas`.`flete_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `operacion_retiradas`
--

/*!50001 DROP TABLE IF EXISTS `operacion_retiradas`*/;
/*!50001 DROP VIEW IF EXISTS `operacion_retiradas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `operacion_retiradas` AS select `operaciones`.`id` AS `id`,`retiradas`.`id` AS `retirada_id` from (((`operaciones` left join `transportes` on((`operaciones`.`id` = `transportes`.`operacion_id`))) left join `almacen_transportes` on((`transportes`.`id` = `almacen_transportes`.`transporte_id`))) left join `retiradas` on((`retiradas`.`almacen_transporte_id` = `almacen_transportes`.`id`))) where (`retiradas`.`id` is not null) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `operacion_saco_pendientes`
--

/*!50001 DROP TABLE IF EXISTS `operacion_saco_pendientes`*/;
/*!50001 DROP VIEW IF EXISTS `operacion_saco_pendientes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `operacion_saco_pendientes` AS select `o`.`id` AS `id`,sum(`ati`.`cantidad_cuenta`) AS `total_cuentas`,sum(`ata`.`sacos_asignados`) AS `total_asignados`,(sum(`ati`.`cantidad_cuenta`) - sum(`ata`.`sacos_asignados`)) AS `sin_asignar` from (((`operaciones` `o` left join `transportes` `t` on((`t`.`operacion_id` = `o`.`id`))) left join `almacen_transportes` `ati` on((`ati`.`transporte_id` = `t`.`id`))) left join `almacen_transporte_asociados` `ata` on((`ata`.`almacen_transporte_id` = `ati`.`id`))) group by `o`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `peso_facturaciones`
--

/*!50001 DROP TABLE IF EXISTS `peso_facturaciones`*/;
/*!50001 DROP VIEW IF EXISTS `peso_facturaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `peso_facturaciones` AS select `ao`.`operacion_id` AS `operacion_id`,`ao`.`asociado_id` AS `asociado_id`,`ao`.`cantidad_embalaje_asociado` AS `cantidad_embalaje_asociado`,ifnull(sum(`r`.`embalaje_retirado`),0) AS `total_embalaje_retirado`,ifnull(sum(`r`.`peso_retirado`),0) AS `total_peso_retirado`,(`ao`.`cantidad_embalaje_asociado` - ifnull(sum(`r`.`embalaje_retirado`),0)) AS `sacos_pendientes`,((`ao`.`cantidad_embalaje_asociado` - ifnull(sum(`r`.`embalaje_retirado`),0)) * `f`.`peso_medio_saco`) AS `peso_pendiente`,(ifnull(sum(`r`.`peso_retirado`),0) + ((`ao`.`cantidad_embalaje_asociado` - ifnull(sum(`r`.`embalaje_retirado`),0)) * `f`.`peso_medio_saco`)) AS `peso_total` from ((`asociado_operaciones` `ao` left join `retiradas` `r` on(((`r`.`asociado_id` = `ao`.`asociado_id`) and ((`r`.`operacion_id` = `ao`.`operacion_id`) or (`r`.`operacion_id` = NULL))))) left join `facturaciones` `f` on((`ao`.`operacion_id` = `f`.`id`))) group by `ao`.`operacion_id`,`ao`.`asociado_id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `peso_operaciones`
--

/*!50001 DROP TABLE IF EXISTS `peso_operaciones`*/;
/*!50001 DROP VIEW IF EXISTS `peso_operaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `peso_operaciones` AS select `o`.`id` AS `id`,`o`.`contrato_id` AS `contrato_id`,(select ifnull(sum(`ao`.`cantidad_embalaje_asociado`),0) from `asociado_operaciones` `ao` where (`ao`.`operacion_id` = `o`.`id`)) AS `cantidad_embalaje`,((select ifnull(sum(`ao`.`cantidad_embalaje_asociado`),0) from `asociado_operaciones` `ao` where (`ao`.`operacion_id` = `o`.`id`)) * (select `ce`.`peso_embalaje_real` from `contrato_embalajes` `ce` where ((`ce`.`contrato_id` = `o`.`contrato_id`) and (`ce`.`embalaje_id` = `o`.`embalaje_id`)))) AS `peso`,(select sum(`r`.`peso_retirado`) from `retiradas` `r` where (`r`.`operacion_id` = `o`.`id`)) AS `peso_retirado`,(select (sum(`r`.`peso_retirado`) / sum(`r`.`embalaje_retirado`)) from `retiradas` `r` where (`r`.`operacion_id` = `o`.`id`)) AS `peso_embalaje_retirado`,(select sum(`atr`.`peso_bruto`) from (`almacen_transportes` `atr` left join `transportes` `t` on((`atr`.`transporte_id` = `t`.`id`))) where (`t`.`operacion_id` = `o`.`id`)) AS `peso_entrada`,(select (sum(`atr`.`peso_bruto`) / sum(`atr`.`cantidad_cuenta`)) from (`almacen_transportes` `atr` left join `transportes` `t` on((`atr`.`transporte_id` = `t`.`id`))) where (`t`.`operacion_id` = `o`.`id`)) AS `peso_embalaje_entrada`,`o`.`peso_pagado` AS `peso_pagado`,(`o`.`peso_pagado` / (select sum(`t`.`cantidad_embalaje`) from `transportes` `t` where (`t`.`operacion_id` = `o`.`id`))) AS `peso_embalaje_pagado` from `operaciones` `o` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `precio_actual_fletes`
--

/*!50001 DROP TABLE IF EXISTS `precio_actual_fletes`*/;
/*!50001 DROP VIEW IF EXISTS `precio_actual_fletes`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_actual_fletes` AS select `p`.`id` AS `id`,`p`.`flete_id` AS `flete_id`,`p`.`fecha_inicio` AS `fecha_inicio`,`p`.`fecha_fin` AS `fecha_fin`,`p`.`coste_contenedor_dolar` AS `coste_contenedor_dolar`,`p`.`precio_dolar` AS `precio_dolar` from (`precio_flete_toneladas` `p` join `flete_fecha_hoy` `f` on(((`p`.`flete_id` = `f`.`flete_id`) and (`p`.`fecha_inicio` = `f`.`fecha_inicio`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `precio_flete_contratos`
--

/*!50001 DROP TABLE IF EXISTS `precio_flete_contratos`*/;
/*!50001 DROP VIEW IF EXISTS `precio_flete_contratos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_flete_contratos` AS select `c`.`id` AS `contrato_id`,`c`.`puerto_carga_id` AS `puerto_carga_id`,`c`.`puerto_destino_id` AS `puerto_destino_id`,`f`.`id` AS `flete_id`,`f`.`embalaje_id` AS `embalaje_id`,`precioFleteDolarTonelada`(`f`.`id`,`c`.`fecha_transporte`) AS `precio_flete` from (`contratos` `c` join `fletes` `f`) where (((`c`.`puerto_carga_id` is not null) and (`c`.`puerto_destino_id` is not null) and (`c`.`puerto_carga_id` = `f`.`puerto_carga_id`) and (`c`.`puerto_destino_id` = `f`.`puerto_destino_id`)) or (isnull(`c`.`puerto_carga_id`) and (`c`.`puerto_destino_id` = `f`.`puerto_destino_id`)) or (isnull(`c`.`puerto_destino_id`) and (`c`.`puerto_carga_id` = `f`.`puerto_carga_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `precio_flete_operaciones`
--

/*!50001 DROP TABLE IF EXISTS `precio_flete_operaciones`*/;
/*!50001 DROP VIEW IF EXISTS `precio_flete_operaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_flete_operaciones` AS select `o`.`id` AS `id`,`p`.`contrato_id` AS `contrato_id`,`p`.`puerto_carga_id` AS `puerto_carga_id`,`p`.`puerto_destino_id` AS `puerto_destino_id`,`p`.`flete_id` AS `flete_id`,`p`.`embalaje_id` AS `embalaje_id`,`p`.`precio_flete` AS `precio_flete` from (`operaciones` `o` left join `precio_flete_contratos` `p` on(((`o`.`contrato_id` = `p`.`contrato_id`) and (`o`.`embalaje_id` = `p`.`embalaje_id`)))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `precio_flete_toneladas`
--

/*!50001 DROP TABLE IF EXISTS `precio_flete_toneladas`*/;
/*!50001 DROP VIEW IF EXISTS `precio_flete_toneladas`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_flete_toneladas` AS select `p`.`id` AS `id`,`p`.`flete_id` AS `flete_id`,`p`.`fecha_inicio` AS `fecha_inicio`,`p`.`fecha_fin` AS `fecha_fin`,`p`.`coste_contenedor_dolar` AS `coste_contenedor_dolar`,round((`p`.`coste_contenedor_dolar` / `f`.`peso_contenedor_tm`),2) AS `precio_dolar` from (`precio_fletes` `p` join `fletes` `f`) where (`p`.`flete_id` = `f`.`id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `precio_operaciones`
--

/*!50001 DROP TABLE IF EXISTS `precio_operaciones`*/;
/*!50001 DROP VIEW IF EXISTS `precio_operaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`192.168.2.35` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_operaciones` AS select `o`.`id` AS `id`,((`o`.`precio_fijacion` + `co`.`diferencial`) + `o`.`opciones`) AS `precio_divisa`,(case when (`ca`.`divisa` = '¢/Lb') then (((`o`.`precio_fijacion` + `co`.`diferencial`) + `o`.`opciones`) * 22.04623) else ((`o`.`precio_fijacion` + `co`.`diferencial`) + `o`.`opciones`) end) AS `precio_divisa_tonelada`,(case when (substr(`ca`.`divisa`,1,1) = '¢') then '$' else substr(`ca`.`divisa`,1,1) end) AS `divisa` from ((`operaciones` `o` join `contratos` `co`) join `canal_compras` `ca`) where ((`o`.`contrato_id` = `co`.`id`) and (`co`.`canal_compra_id` = `ca`.`id`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `precio_total_operaciones`
--

/*!50001 DROP TABLE IF EXISTS `precio_total_operaciones`*/;
/*!50001 DROP VIEW IF EXISTS `precio_total_operaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`192.168.2.35` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_total_operaciones` AS select `o`.`id` AS `id`,round(`p`.`precio_divisa_tonelada`,4) AS `precio_divisa_tonelada`,`p`.`divisa` AS `divisa`,round(((`p`.`precio_divisa_tonelada` + `o`.`flete`) / coalesce(`o`.`cambio_dolar_euro`,1)),4) AS `precio_euro_tonelada`,round((((`p`.`precio_divisa_tonelada` + `o`.`flete`) / coalesce(`o`.`cambio_dolar_euro`,1)) * (`o`.`seguro` / 100)),4) AS `seguro_euro_tonelada`,coalesce(`o`.`precio_directo_euro`,round((((((`p`.`precio_divisa_tonelada` + `o`.`flete`) / coalesce(`o`.`cambio_dolar_euro`,1)) * (1 + (`o`.`seguro` / 100))) + `o`.`forfait`) / 1000),6)) AS `precio_euro_kilo_total` from (`operaciones` `o` join `precio_operaciones` `p`) where (`o`.`id` = `p`.`id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `reparto_operacion_asociados`
--

/*!50001 DROP TABLE IF EXISTS `reparto_operacion_asociados`*/;
/*!50001 DROP VIEW IF EXISTS `reparto_operacion_asociados`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `reparto_operacion_asociados` AS select `o`.`id` AS `id`,`ao`.`asociado_id` AS `asociado_id`,round(((`ao`.`cantidad_embalaje_asociado` / (select ifnull(sum(`ao`.`cantidad_embalaje_asociado`),0) from `asociado_operaciones` `ao` where (`ao`.`operacion_id` = `o`.`id`))) * 100),2) AS `porcentaje_embalaje_asociado`,(`ao`.`cantidad_embalaje_asociado` * (select `ce`.`peso_embalaje_real` from `contrato_embalajes` `ce` where ((`ce`.`contrato_id` = `o`.`contrato_id`) and (`ce`.`embalaje_id` = `o`.`embalaje_id`)))) AS `peso_asociado`,round(((`ao`.`cantidad_embalaje_asociado` * (select `ce`.`peso_embalaje_real` from `contrato_embalajes` `ce` where ((`ce`.`contrato_id` = `o`.`contrato_id`) and (`ce`.`embalaje_id` = `o`.`embalaje_id`)))) * (select `f`.`precio_euro_kilo` from `financiaciones` `f` where (`f`.`id` = `o`.`id`))),2) AS `precio_asociado`,round(((((`ao`.`cantidad_embalaje_asociado` * (select `ce`.`peso_embalaje_real` from `contrato_embalajes` `ce` where ((`ce`.`contrato_id` = `o`.`contrato_id`) and (`ce`.`embalaje_id` = `o`.`embalaje_id`)))) * (select `f`.`precio_euro_kilo` from `financiaciones` `f` where (`f`.`id` = `o`.`id`))) * (select `v`.`valor` from `valor_iva_financiaciones` `v` where (`v`.`financiacion_id` = `f`.`id`))) / 100),2) AS `iva`,round(((`ao`.`cantidad_embalaje_asociado` * (select `ce`.`peso_embalaje_real` from `contrato_embalajes` `ce` where ((`ce`.`contrato_id` = `o`.`contrato_id`) and (`ce`.`embalaje_id` = `o`.`embalaje_id`)))) * `VALOR_COMISION_ASOCIADO`(`ao`.`asociado_id`,`f`.`fecha_vencimiento`)),2) AS `comision`,round(((((`ao`.`cantidad_embalaje_asociado` * (select `ce`.`peso_embalaje_real` from `contrato_embalajes` `ce` where ((`ce`.`contrato_id` = `o`.`contrato_id`) and (`ce`.`embalaje_id` = `o`.`embalaje_id`)))) * `VALOR_COMISION_ASOCIADO`(`ao`.`asociado_id`,`f`.`fecha_vencimiento`)) * `valor_iva_comision`(`f`.`tipo_iva_comision_id`,`f`.`fecha_vencimiento`)) / 100),2) AS `iva_comision`,`total_asociado_financiacion`(`f`.`id`,`ao`.`asociado_id`) AS `total_anticipo` from ((`operaciones` `o` join `asociado_operaciones` `ao`) join `financiaciones` `f`) where ((`ao`.`operacion_id` = `o`.`id`) and (`o`.`id` = `f`.`id`)) order by `o`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `resto_contratos`
--

/*!50001 DROP TABLE IF EXISTS `resto_contratos`*/;
/*!50001 DROP VIEW IF EXISTS `resto_contratos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `resto_contratos` AS select `contratos`.`id` AS `id`,(`contratos`.`peso_comprado` - (select ifnull(sum(`peso_operaciones`.`peso`),0) from `peso_operaciones` where (`peso_operaciones`.`contrato_id` = `contratos`.`id`))) AS `peso_restante` from `contratos` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `resto_contratos2`
--

/*!50001 DROP TABLE IF EXISTS `resto_contratos2`*/;
/*!50001 DROP VIEW IF EXISTS `resto_contratos2`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `resto_contratos2` AS select `contratos`.`id` AS `id`,(`contratos`.`peso_comprado` - (select ifnull(sum(`peso_operaciones`.`peso`),0) from `peso_operaciones` where (`peso_operaciones`.`contrato_id` = `contratos`.`id`))) AS `peso_restante` from `contratos` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `resto_lotes_contratos`
--

/*!50001 DROP TABLE IF EXISTS `resto_lotes_contratos`*/;
/*!50001 DROP VIEW IF EXISTS `resto_lotes_contratos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `resto_lotes_contratos` AS select `contratos`.`id` AS `id`,(`contratos`.`lotes_contrato` - (select ifnull(sum(`operaciones`.`lotes_operacion`),0) from `operaciones` where (`operaciones`.`contrato_id` = `contratos`.`id`))) AS `lotes_restantes` from `contratos` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `valor_iva_comisiones`
--

/*!50001 DROP TABLE IF EXISTS `valor_iva_comisiones`*/;
/*!50001 DROP VIEW IF EXISTS `valor_iva_comisiones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `valor_iva_comisiones` AS select `f`.`id` AS `financiacion_id`,`v`.`tipo_iva_id` AS `tipo_iva_id`,`t`.`nombre` AS `nombre`,`v`.`valor` AS `valor` from ((`financiaciones` `f` join `tipo_ivas` `t`) join `valor_tipo_ivas` `v`) where ((`f`.`tipo_iva_comision_id` = `t`.`id`) and (`t`.`id` = `v`.`tipo_iva_id`) and (`v`.`fecha_inicio` <= `f`.`fecha_vencimiento`) and ((`v`.`fecha_fin` > `f`.`fecha_vencimiento`) or isnull(`v`.`fecha_fin`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `valor_iva_financiaciones`
--

/*!50001 DROP TABLE IF EXISTS `valor_iva_financiaciones`*/;
/*!50001 DROP VIEW IF EXISTS `valor_iva_financiaciones`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `valor_iva_financiaciones` AS select `f`.`id` AS `financiacion_id`,`v`.`tipo_iva_id` AS `tipo_iva_id`,`t`.`nombre` AS `nombre`,`v`.`valor` AS `valor` from ((`financiaciones` `f` join `tipo_ivas` `t`) join `valor_tipo_ivas` `v`) where ((`f`.`tipo_iva_id` = `t`.`id`) and (`t`.`id` = `v`.`tipo_iva_id`) and (`v`.`fecha_inicio` <= `f`.`fecha_vencimiento`) and ((`v`.`fecha_fin` > `f`.`fecha_vencimiento`) or isnull(`v`.`fecha_fin`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-03 14:35:26
