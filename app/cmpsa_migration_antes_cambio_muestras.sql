-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: cmpsa_migration
-- ------------------------------------------------------
-- Server version	5.5.44-0+deb8u1

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
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agentes`
--

LOCK TABLES `agentes` WRITE;
/*!40000 ALTER TABLE `agentes` DISABLE KEYS */;
INSERT INTO `agentes` VALUES (59,NULL,NULL),(60,NULL,NULL),(64,'2015-05-26 14:22:05','2015-05-26 14:22:05'),(87,'2015-07-24 17:06:33','2015-07-24 17:06:33'),(105,'2015-09-15 14:39:35','2015-09-15 14:39:35'),(126,'2015-11-19 12:33:10','2015-11-25 18:06:07'),(127,'2015-11-25 01:13:16','2015-11-25 01:45:48'),(129,'2015-11-25 16:32:43','2015-11-25 17:19:11'),(130,'2015-11-25 22:01:43','2015-11-25 22:02:09');
/*!40000 ALTER TABLE `agentes` ENABLE KEYS */;
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
  `marca_almacen` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_almacenes_has_transportes_transportes1_idx` (`transporte_id`),
  KEY `fk_almacenes_has_transportes_almacenes1_idx` (`almacen_id`),
  CONSTRAINT `fk_almacenes_has_transportes_almacenes1` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_almacenes_has_transportes_transportes1` FOREIGN KEY (`transporte_id`) REFERENCES `transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `almacen_transportes`
--

LOCK TABLES `almacen_transportes` WRITE;
/*!40000 ALTER TABLE `almacen_transportes` DISABLE KEYS */;
INSERT INTO `almacen_transportes` VALUES (8,59,45,'54131',20.00,NULL,NULL,NULL),(9,50,53,'251478/5451',33.00,NULL,NULL,NULL),(10,59,53,'2015/03578',550.00,NULL,NULL,NULL),(12,50,55,'1234567',85.00,NULL,NULL,'2015-12-03 15:10:04'),(13,58,56,'ad',45.00,'Jamaica 1','2015-12-03 15:03:35','2015-12-03 19:15:52'),(17,50,50,'123',5.00,'Brasil Alta_','2015-12-03 17:31:01','2015-12-03 18:00:16'),(18,58,50,'AB123',30.00,'Colombia robusto plus','2015-12-03 17:59:11','2015-12-03 17:59:11'),(19,50,56,'ARM1234',21.00,'Jamaica 2','2015-12-03 19:15:29','2015-12-03 19:15:29'),(20,58,50,'cuenta4',25.00,'marca2','2015-12-03 19:48:05','2015-12-03 19:48:05');
/*!40000 ALTER TABLE `almacen_transportes` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anticipos`
--

LOCK TABLES `anticipos` WRITE;
/*!40000 ALTER TABLE `anticipos` DISABLE KEYS */;
INSERT INTO `anticipos` VALUES (7,96,17,7183.98,'2017-11-17','2015-11-17 18:32:18','2015-11-24 02:24:08'),(15,97,26,25963.14,'2015-11-24','2015-11-24 02:03:59','2015-11-24 02:24:27'),(16,99,26,2000.00,'2015-11-24','2015-11-24 02:25:38','2015-11-24 02:25:38'),(17,99,26,3000.00,'2015-11-24','2015-11-24 02:26:01','2015-11-24 02:26:01');
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
INSERT INTO `aseguradoras` VALUES (89,NULL,NULL),(90,NULL,NULL),(91,NULL,NULL),(93,NULL,'2015-11-25 01:44:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asociado_comisiones`
--

LOCK TABLES `asociado_comisiones` WRITE;
/*!40000 ALTER TABLE `asociado_comisiones` DISABLE KEYS */;
INSERT INTO `asociado_comisiones` VALUES (1,68,1,'2015-01-01','0000-00-00',NULL,NULL),(3,76,2,'2015-01-01','2015-12-31',NULL,NULL),(4,77,2,'2015-01-01','2015-12-31',NULL,NULL),(5,78,2,'2015-01-01','2015-12-31',NULL,NULL),(6,79,2,'2015-01-01','2015-12-31',NULL,NULL),(7,80,2,'2015-01-01','2015-12-31',NULL,NULL),(8,81,2,'2015-01-01','2015-12-31',NULL,NULL),(9,82,2,'2015-01-01','2015-12-31',NULL,NULL),(10,83,2,'2015-01-01','2015-12-31',NULL,NULL),(15,84,2,'2015-01-01','0000-00-00','2015-11-15 00:09:54','2015-11-15 00:10:25'),(16,75,2,'2016-10-18','2017-02-03','2015-11-18 13:04:01','2015-11-18 13:05:26'),(17,75,2,'2015-01-01','2015-11-30','2015-11-18 13:10:32','2015-11-18 13:10:32');
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
) ENGINE=InnoDB AUTO_INCREMENT=378 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asociado_operaciones`
--

LOCK TABLES `asociado_operaciones` WRITE;
/*!40000 ALTER TABLE `asociado_operaciones` DISABLE KEYS */;
INSERT INTO `asociado_operaciones` VALUES (96,19,78,57,'2015-08-07 23:49:00','2015-08-07 23:49:00'),(97,19,81,206,'2015-08-07 23:49:01','2015-08-07 23:49:01'),(98,19,68,16,'2015-08-07 23:49:01','2015-08-07 23:49:01'),(99,19,79,41,'2015-08-07 23:49:01','2015-08-07 23:49:01'),(191,27,75,20,'2015-08-18 14:40:09','2015-08-18 14:40:09'),(192,27,83,60,'2015-08-18 14:40:09','2015-08-18 14:40:09'),(193,27,84,20,'2015-08-18 14:40:09','2015-08-18 14:40:09'),(194,24,68,10,'2015-08-20 12:50:24','2015-08-20 12:50:24'),(195,24,75,10,'2015-08-20 12:50:25','2015-08-20 12:50:25'),(232,29,68,35,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(233,29,77,47,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(234,29,78,225,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(235,29,79,60,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(236,29,80,150,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(237,29,81,400,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(238,29,82,626,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(239,29,83,314,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(240,29,84,190,'2015-10-08 17:28:12','2015-10-08 17:28:12'),(241,30,76,275,'2015-10-08 17:29:47','2015-10-08 17:29:47'),(242,31,75,469,'2015-10-08 17:39:34','2015-10-08 17:39:34'),(243,31,77,117,'2015-10-08 17:39:34','2015-10-08 17:39:34'),(244,31,82,164,'2015-10-08 17:39:34','2015-10-08 17:39:34'),(246,33,75,20,'2015-10-08 18:33:11','2015-10-08 18:33:11'),(247,33,83,40,'2015-10-08 18:33:11','2015-10-08 18:33:11'),(248,34,82,40,'2015-10-08 18:34:00','2015-10-08 18:34:00'),(249,35,83,20,'2015-10-08 18:37:58','2015-10-08 18:37:58'),(250,35,84,20,'2015-10-08 18:37:58','2015-10-08 18:37:58'),(251,36,82,60,'2015-10-08 18:46:32','2015-10-08 18:46:32'),(252,37,82,60,'2015-10-08 18:46:45','2015-10-08 18:46:45'),(322,44,68,35,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(323,44,77,47,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(324,44,78,225,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(325,44,79,60,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(326,44,80,150,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(327,44,81,400,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(328,44,82,626,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(329,44,83,314,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(330,44,84,190,'2015-10-14 18:37:14','2015-10-14 18:37:14'),(331,43,68,35,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(332,43,77,47,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(333,43,78,225,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(334,43,79,60,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(335,43,80,150,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(336,43,81,400,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(337,43,82,626,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(338,43,83,314,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(339,43,84,190,'2015-10-14 18:37:47','2015-10-14 18:37:47'),(367,45,68,35,'2015-10-15 13:57:05','2015-10-15 13:57:05'),(368,45,77,47,'2015-10-15 13:57:05','2015-10-15 13:57:05'),(369,45,78,225,'2015-10-15 13:57:06','2015-10-15 13:57:06'),(370,45,79,60,'2015-10-15 13:57:06','2015-10-15 13:57:06'),(371,45,80,150,'2015-10-15 13:57:06','2015-10-15 13:57:06'),(372,45,81,400,'2015-10-15 13:57:06','2015-10-15 13:57:06'),(373,45,82,626,'2015-10-15 13:57:06','2015-10-15 13:57:06'),(374,45,83,314,'2015-10-15 13:57:06','2015-10-15 13:57:06'),(375,45,84,190,'2015-10-15 13:57:06','2015-10-15 13:57:06'),(377,32,78,275,'2015-12-01 13:56:49','2015-12-01 13:56:49');
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
INSERT INTO `bancos` VALUES (3,NULL),(4,NULL),(14,NULL),(15,NULL),(16,NULL),(17,NULL),(18,NULL),(26,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calidades`
--

LOCK TABLES `calidades` WRITE;
/*!40000 ALTER TABLE `calidades` DISABLE KEYS */;
INSERT INTO `calidades` VALUES (5,0,2,'Huila Excelso Criba 16','2015-03-12 23:59:58','2015-04-11 00:41:36'),(6,1,1,'N.Y.4, MTGB Duro limpio EA Process','2015-03-13 00:06:32','2015-03-17 15:29:24'),(8,0,1,'N.Y.4, 17/18,Duro Limpio','2015-03-16 10:31:51','2015-03-16 15:05:13'),(9,0,8,'AA Top','2015-03-16 10:37:26','2015-03-16 16:08:06'),(10,0,12,'S.H.G. Criba 16 Up','2015-03-16 10:37:59','2015-03-16 15:06:12'),(11,1,NULL,'Colombia/Brasil/Uganda( 30%,30%,40%)','2015-03-16 10:38:58','2015-03-16 17:58:04'),(12,0,14,'Robusta Criba 18 Limpio','2015-03-16 17:34:38','2015-03-17 09:59:03'),(23,0,1,'N.Y.4,17/18,Strictly Soft,Fine Roast','2015-03-16 23:05:51','2015-03-17 10:00:44'),(24,0,20,'Sidamo Grado 2','2015-03-16 23:06:57','2015-03-17 10:00:59'),(25,1,14,'Robusta Grado 2 (5%) EA Process','2015-03-17 12:00:42','2015-03-17 12:00:42'),(27,1,NULL,'Central American Blend','2015-08-11 15:12:26','2015-10-16 10:53:20'),(28,0,2,'Supremo Criba 17/18','2015-10-08 17:18:14','2015-10-16 10:55:51'),(29,0,2,'Supremo Criba 18','2015-10-08 17:31:09','2015-10-16 10:55:32'),(30,0,25,'HG \"Montecristo\"','2015-10-08 17:42:46','2015-10-08 17:42:46'),(32,0,23,'SHB EP Fancy 16 Arriba','2015-10-08 17:53:30','2015-10-16 10:54:54'),(37,0,2,'Excelso Criba 16','2015-10-16 10:56:48','2015-10-16 10:56:48'),(38,0,4,'AA Plus','2015-10-16 10:59:15','2015-10-16 10:59:15'),(39,0,23,'SHB Tarrazú','2015-10-16 11:00:43','2015-10-16 11:00:43'),(40,1,1,'N.Y.2/3,17/18,Duro Limpio Cloruro Metileno','2015-10-16 11:03:22','2015-10-16 11:03:22'),(41,1,NULL,'Grado 2 5% Cloruro de Metileno','2015-10-16 11:03:52','2015-10-16 11:03:52');
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
  `nombre` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telefono1` varchar(45) DEFAULT NULL,
  `telefono2` varchar(45) DEFAULT NULL,
  `funcion` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`empresa_id`),
  KEY `fk_contactos_empresas1_idx` (`empresa_id`),
  CONSTRAINT `fk_contactos_empresas1` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (6,3,'Juan Carlos Castro','','','','responsable cuenta','2015-02-17 15:25:01','2015-02-17 15:25:01'),(8,18,'Toto Cutugno','toto@libero.it','666 55 44 33','777 88 99 00','cantautor','2015-02-17 21:42:49','2015-02-17 23:59:22'),(13,50,'Camilo Sesto','','666554433','','Peluquero','2015-03-10 13:25:07','2015-05-05 16:12:28'),(15,18,'Pablo Iglesias','pabloiglesias@podemos.es','913241201','','Cofundador','2015-03-24 13:10:36','2015-04-07 15:03:34'),(18,40,'persona','correo@correos.es','3423423424','453452522','funcionando','2015-04-07 17:45:55','2015-04-07 17:46:05'),(23,16,'','pepito@movistar.com','','','','2015-05-07 22:10:09','2015-05-07 22:10:09'),(25,16,'','lacosa@loes.com','','','','2015-05-07 22:10:36','2015-05-07 22:10:36'),(26,47,'Jesús','empleadojesus@gmail.com','913341568','','Empleado','2015-05-28 20:39:44','2015-05-28 20:39:44'),(28,64,'Juan José','juanjo@importente.org','','','','2015-05-30 12:26:05','2015-05-30 12:26:05'),(29,39,'Ada Colau','adacolau@bcn.org','938521478','','Activista','2015-05-30 12:33:51','2015-08-29 00:55:54'),(30,40,'Pedro','unomas@carla.es','633354547','','jefe - Tráfico','2015-06-02 13:24:53','2015-06-02 13:24:53'),(31,40,'Pedro','unomas@carla.es','633354547','','jefe - Tráfico','2015-06-02 13:24:56','2015-06-02 13:24:56'),(32,38,'Jaun','Juan@gerente.com','93622255','','Gerente','2015-07-23 20:44:29','2015-07-23 20:44:29'),(34,89,'Michael','michaael@dorf.de','34625457','','Boss','2015-08-24 18:26:46','2015-08-24 18:26:46'),(35,95,'Francisco López','FLopez.mad@mscspain.com','91 436 39 40','696 092 262','Director Importación','2015-09-22 10:35:16','2015-09-22 12:25:07'),(36,95,'Iratxe Martín','IMartin.mad@mscspain.com','91 436 39 40','','Dpto. Importación','2015-09-22 12:07:24','2015-09-22 14:26:22'),(40,96,'Albert Sancerni','IBC.ASANCERNI@cma-cgm.com','93 551 94 26','','Agente de Importación','2015-10-15 12:24:28','2015-10-15 12:24:28'),(41,96,'Juan Carlos Almodovar','IBR.JALMODOVAR@cma-cgm.com','91 417 07 47','672 384 485','Director Importación','2015-10-15 12:26:08','2015-10-15 12:26:08'),(42,98,'Berta Ferragut','berta.ferragut@evgebcn.com','93 390 58 05','','Agente de Importación','2015-10-15 13:08:55','2015-10-15 13:08:55'),(43,98,'Josean Molina','josean.molina@evgebcn.com','93 390 58 03','','Agente de Importación','2015-10-15 13:10:10','2015-10-15 13:10:10'),(44,97,'Roberto del Moral','roberto.delmoral@hamburgsud.com','93 467 18 99','','Agente de Importación','2015-10-15 13:22:58','2015-10-15 13:22:58'),(45,68,'Camilo Sesto','camilo@tralala.es','','','cirujano plástico','2015-11-04 17:31:26','2015-11-04 17:31:26'),(48,4,'Gonzalo','','','','','2015-11-18 12:57:18','2015-11-18 12:57:18'),(49,16,'Andrea','','','','','2015-11-19 13:26:39','2015-11-19 13:26:39'),(50,126,'loli','','','','','2015-11-30 12:32:12','2015-11-30 12:32:12');
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
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contrato_embalajes`
--

LOCK TABLES `contrato_embalajes` WRITE;
/*!40000 ALTER TABLE `contrato_embalajes` DISABLE KEYS */;
INSERT INTO `contrato_embalajes` VALUES (93,58,2,20,862.50,'2015-08-11 21:10:06','2015-08-11 21:10:06'),(119,65,4,2200,70.00,'2015-10-08 16:28:10','2015-10-08 16:28:10'),(120,66,4,275,70.00,'2015-10-08 17:22:57','2015-10-08 17:22:57'),(122,67,4,750,70.00,'2015-10-08 17:38:15','2015-10-08 17:38:15'),(123,68,2,20,862.50,'2015-10-08 17:46:42','2015-10-08 17:46:42'),(125,69,5,275,69.00,'2015-10-08 17:56:07','2015-10-08 17:56:07'),(126,70,1,960,60.00,'2015-10-08 18:01:18','2015-10-08 18:01:18'),(127,71,2,100,1000.00,'2015-10-08 18:17:40','2015-10-08 18:17:40'),(128,72,2,100,1000.00,'2015-10-08 18:36:48','2015-10-08 18:36:48'),(137,77,4,2200,70.00,'2015-10-14 17:37:23','2015-10-14 17:37:23'),(139,78,4,2200,70.00,'2015-10-14 18:26:23','2015-10-14 18:26:23'),(141,79,4,2200,70.00,'2015-10-14 18:32:43','2015-10-14 18:32:43'),(144,31,2,80,1000.00,'2015-10-15 14:01:27','2015-10-15 14:01:27'),(145,31,1,320,60.00,'2015-10-15 14:01:27','2015-10-15 14:01:27'),(146,80,2,180,1000.00,'2015-11-10 12:36:45','2015-11-10 12:36:45'),(154,63,2,180,1000.00,'2015-12-05 01:39:04','2015-12-05 01:39:04');
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
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
INSERT INTO `contratos` VALUES (31,38,1,12,1,'CO-7096202',265.00,'2015-03-01',99200,10,NULL,NULL,'2015-03-01',1,'','2015-10-15 14:01:27','2015-07-21 14:04:18'),(58,47,2,10,2,'CO-7168501',3.00,'2016-03-01',17250,1,NULL,9,'2015-12-01',0,NULL,'2015-08-11 21:10:06','2015-08-10 13:55:23'),(63,43,2,8,2,'14/S/00340/C',0.00,'2015-03-01',180000,11,NULL,NULL,'2015-03-01',0,'','2015-12-05 01:39:03','2015-08-18 14:33:34'),(65,45,2,5,2,'SC-44221',9.50,'2016-03-01',154000,9,18,6,'2016-01-01',0,'','2015-10-08 16:28:10','2015-10-08 16:26:40'),(66,38,2,28,2,'CO-7141101',14.00,'2016-03-01',19250,1,18,6,'2016-01-01',0,'','2015-10-08 17:22:57','2015-10-08 17:22:57'),(67,115,2,29,1,'BM-8800461',16.00,'2016-03-01',52500,3,18,6,'2016-01-01',0,'','2015-10-08 17:38:15','2015-10-08 17:32:58'),(68,38,2,30,1,'CO-7141001',3.00,'2016-03-01',17250,1,17,6,'2016-01-01',0,'','2015-10-08 17:46:41','2015-10-08 17:46:41'),(69,116,2,32,5,'ZZ-1582416',NULL,'2016-05-01',18975,0,NULL,6,'2016-03-01',0,'','2015-10-08 17:56:07','2015-10-08 17:55:34'),(70,118,2,8,2,'415560078',-21.00,'2016-03-01',57600,3,NULL,6,'2016-01-01',0,'','2015-10-08 18:01:18','2015-10-08 18:01:18'),(71,118,2,8,2,'415560077',-21.00,'2016-03-01',100000,6,NULL,NULL,'2016-01-01',0,'','2015-10-08 18:17:40','2015-10-08 18:17:40'),(72,88,2,8,2,'S-34670',-21.00,'2016-03-01',100000,6,NULL,NULL,'2016-01-01',0,'','2015-10-08 18:36:48','2015-10-08 18:36:48'),(77,45,2,5,2,'SC-44222',9.50,'2016-03-01',154000,9,18,6,'2016-02-01',0,'','2015-10-14 17:37:23','2015-10-14 17:36:09'),(78,45,2,5,2,'SC-44223',9.50,'2016-05-01',154000,9,18,6,'2016-03-01',0,'','2015-10-14 18:26:22','2015-10-14 18:25:43'),(79,45,2,5,2,'SC-44224',9.50,'2016-05-01',154000,9,18,6,'2016-04-01',0,'','2015-10-14 18:32:43','2015-10-14 18:32:24'),(80,43,2,8,2,'14/S/00340/C###',-15.50,'2015-03-01',180000,11,NULL,NULL,'2015-01-01',0,'','2015-11-10 12:36:44','2015-11-10 12:36:44'),(83,41,3,27,4,'difer',0.00,'2015-01-01',NULL,NULL,NULL,NULL,'2016-01-01',0,'','2015-12-05 01:43:59','2015-12-05 01:43:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (3,'BBVA','BBVA','Paseo Castellana, 108','','Madrid',3,'918652010','','57200005','01824572420000074739','BBVAESMMXXX',NULL,NULL,'2015-10-15 14:28:45'),(4,'Santander','Santander','Serrano, 21','28012','Madrid',3,NULL,'A-39000013','57200011',NULL,NULL,NULL,'2015-02-13 18:51:30','2015-02-17 15:13:25'),(14,'La Caixa','Caixa','','','',3,NULL,NULL,'57200002',NULL,NULL,NULL,'2015-02-17 14:57:48','2015-02-17 14:57:48'),(15,'Sabadell','Sabadell','','','',3,NULL,NULL,'57200003','00815760340001359645',NULL,NULL,'2015-02-17 14:59:17','2015-02-24 11:57:16'),(16,'Deutsche Bank','Deutsche Bank','','','',3,NULL,NULL,'57200006',NULL,NULL,NULL,'2015-02-17 15:05:12','2015-02-17 15:06:25'),(17,'Banco Popular Español','Popular','','','',3,NULL,NULL,'57200007',NULL,NULL,NULL,'2015-02-17 15:10:30','2015-02-17 15:10:30'),(18,'Banca March','March','','28000','',3,NULL,NULL,'57200009',NULL,NULL,NULL,'2015-02-17 15:11:11','2015-05-26 15:26:57'),(26,'Bankinter','Bankinter','','','',3,'',NULL,'57200010',NULL,NULL,NULL,'2015-02-24 11:59:17','2015-05-26 15:30:32'),(36,'Icona Café SA','Icona','','','',3,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:26:57','2015-03-10 11:26:57'),(37,'Louis Dreyfus Commodities España ','Dreyfus España','','','',3,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:39:25','2015-03-10 11:45:29'),(38,'Coprocafé Ibérica S.A.','Coprocafé','','','',3,'','','','','MESHXXX',NULL,'2015-03-10 11:39:46','2015-09-22 12:39:32'),(39,'C.Dorman Limited','Dorman','','','',8,'','','','','',NULL,'2015-03-10 11:43:30','2015-08-29 00:47:31'),(40,'Louis Dreyfus Commodities Brasil','Dreyfus Brasil','','','',1,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:45:06','2015-03-10 11:45:06'),(41,'List & Beisler GmbH','Beisler','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:49:34','2015-03-10 11:49:34'),(43,'Olam International Ltd','Olam','','','',10,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:54:18','2015-03-10 11:54:18'),(44,'Mercon Coffee Corporation','Mercon','','','',11,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:57:06','2015-03-10 11:57:06'),(45,'Coffein Compagnie Dr. Erich Scheele GmbH & Co','Coffein','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 11:59:26','2015-03-10 11:59:26'),(46,'Outspan Brasil Ltda','Outspan','','','',1,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 12:01:15','2015-03-10 12:01:15'),(47,'Exportadora Atlantic S.A.','Atlantic','','','',12,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 12:03:17','2015-03-10 12:03:17'),(48,'InterAmerican Coffee GmbH','InterAmerican','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-03-10 12:05:28','2015-03-10 12:05:28'),(50,'Almacenes Viorvi SA','Viorvi','','','Barcelona',3,'987654321',NULL,NULL,NULL,NULL,NULL,'2015-03-10 12:51:59','2015-03-10 13:29:35'),(58,'Almacén  BIT','BIT','','','Barcelona',3,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:18:29','2015-05-05 16:10:39'),(59,'Molenbergnatie','Molenbergnatie','','','Barcelona',3,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:19:45','2015-05-05 16:11:16'),(60,'Pacorini','Pacorini','','','Gijón',3,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:20:25','2015-05-05 16:11:45'),(61,'Almacén Europa','Europa','','','',9,'',NULL,NULL,NULL,NULL,NULL,'2015-04-08 17:20:57','2015-04-08 17:20:57'),(64,'Coma y Ribas','Coma','c/ Obradors, 7','08130','Santa Perpètua de Mogoda',3,'933021414',NULL,NULL,NULL,NULL,NULL,'2015-05-26 14:22:04','2015-05-26 14:22:04'),(68,'Germán De Erausquin, S.A.','Erausquin','Urgel, 37 1º - 3ª','08011','Barcelona',3,'933255640','ESA-08259368','43401006','',NULL,NULL,'2015-07-08 02:55:15','2015-07-14 12:45:22'),(75,'Cafés Baqué, S.L.U.','Baqué','P.Ind. Sta. Apolonia - U.A.I., 2-2','48215','Iurreta',3,'946215610','ESB-95445508','43401007','',NULL,NULL,'2015-07-14 12:40:47','2015-07-14 12:46:08'),(76,'Juan Iriondo, S.A.','Iriondo','Pol. Ugaldetxo - C/ Zuaznabar, 49','20180','Oiartzun',3,'943491642','ESA-20063954','43401010','',NULL,NULL,'2015-07-14 12:48:24','2015-07-14 12:50:49'),(77,'Rodriguez y Mateus, S.L.U.','Mateus','Alfonso Gómez, 15','28037','Madrid',3,'913271216','ESB-28577799','43401011','',NULL,NULL,'2015-07-14 12:50:14','2015-07-14 12:50:14'),(78,'Cafés la Brasileña, S.A.','Brasileña','Oñate, 12','01013','Vitoria',3,'945265000','ESA-01016450','43401013','',NULL,NULL,'2015-07-14 12:52:19','2015-07-14 12:52:19'),(79,'Cafés Orus, S.A.','Orus','Ctra. Logroño - P.I. Portazgo - 101-102-83','50011','Zaragoza',3,'976347272','ESA-50004860','43401014','',NULL,NULL,'2015-07-14 12:54:01','2015-07-14 12:54:01'),(80,'U.N.I.C. , S.L.','Unic','Sancho de Avila, 73-75','08018','Barcelona',3,'933006007','ESB-08266009','43401015','',NULL,NULL,'2015-07-14 12:55:26','2015-07-14 12:55:26'),(81,'Café Dromedario, S.A.','Dromedario','Recta de Heras, s/nº.','39792','Heras',3,'942540725','ESA-39000690','43401019','',NULL,NULL,'2015-07-14 12:56:52','2015-07-14 12:56:52'),(82,'Cafento Norte, S.L.','Cafento','Pol.Ind. La Curiscada - Entrada Sur.','33877','Tineo',3,'902117218','ESB-33019688','43401024','',NULL,NULL,'2015-07-14 12:58:26','2015-07-14 12:58:26'),(83,'Tupinamba, S.A.','Tupinamba','Domenech Pascual, 3 - P.I. Can Misser','08360','Canet de Mar',3,'937943110','ESA-58476961','43401031','',NULL,NULL,'2015-07-14 13:00:16','2015-07-14 13:00:16'),(84,'La Ind. Levantina de Cafés Durbán, S.L.','Durbán','Ctra. Valencia - Ademuz, Km.11','46980','Paterna',3,'961320998','ESB-46012506','43401038','',NULL,NULL,'2015-07-14 13:01:52','2015-08-18 14:41:22'),(87,'Fernando Flores Barcelona S.L.','Flores','Av. Diagonal, 618 5°B','08021','Barcelona',3,'932290352','B-58284779','','',NULL,NULL,'2015-07-24 17:06:33','2015-07-24 17:06:33'),(88,'Louis Dreyfus Commodities Suisse SA','Dreyfus Suiza','29, route del l\'Aéroport - PO Box 236','1215','Geneva 15',10,'+41227992700','','','',NULL,NULL,'2015-07-25 14:32:58','2015-07-25 14:32:58'),(89,'Zurich Gmbh','Zurich','C/ Pluton','28777','Basel',6,'963963','','','',NULL,NULL,'2015-07-27 14:48:22','2015-08-24 18:25:06'),(90,'ALLIANZ, COMPAÑIA DE SEGUROS Y REASEGUROS, SO','Allianz','','','',9,'902232629','','','',NULL,NULL,'2015-07-27 14:49:04','2015-07-27 14:49:04'),(91,'Axa Seguros Generales, S. A. de seguros y reaseguros','Axa','','','Madrid',3,'971767700','','','','',NULL,'2015-07-27 14:49:25','2015-08-25 12:59:52'),(93,'Euromutua de seguros y reaseguros a prima fija','Euromutua','','','Basel',10,'12345','','','21000889430200119212','',NULL,'2015-07-27 14:50:00','2015-11-25 01:44:15'),(95,'MEDITERRANEAN SHIPPING COMPANY ESPAÑA, S.L.U.','MSC','','28020','MADRID',3,'91 436 39 40','B98261944','41003023','00810166140001563062','MESHXXX',NULL,'2015-08-19 18:17:54','2015-09-22 13:57:57'),(96,'CMA CGM IBERICA S.A.U.','CMA CGM','','08040','Barcelona',3,'93 319 68 00','ESA83728279','41003061','00815084040001469249','BSABESBB','http://elpais.com','2015-08-19 18:18:21','2015-11-13 17:26:30'),(97,'Hamburg Sud Iberia, S.A.','Hamburg Sud','','08008','Barcelona',3,'93 467 18 99','A41271263','41003037','00190020964010189003','DEUTESBBXXX',NULL,'2015-08-19 18:19:08','2015-10-15 13:34:48'),(98,'Agencia Marítima Española Evge, S.A.','Marfret','','08003','Barcelona',3,'93 390 58 00','A08115362','41003024','21000889430200119212','CAIXESBBXXX',NULL,'2015-08-19 18:19:29','2015-10-15 13:20:19'),(99,'WEC','WEC','','','',3,'','','','',NULL,NULL,'2015-08-19 18:20:01','2015-09-08 13:01:53'),(100,'Maersk Line Shipping','Maersk','','','',3,'','','','',NULL,NULL,'2015-09-08 13:00:08','2015-09-08 13:00:08'),(101,'K-LINE','K-LINE','','','',3,'','','','',NULL,NULL,'2015-09-08 13:28:37','2015-09-08 13:28:37'),(102,'NYK Line','NYK Line','','','',3,'','','','',NULL,NULL,'2015-09-08 13:29:16','2015-09-08 13:29:16'),(103,'Happag Lloyd','Happag Lloyd','','','',3,'','','','',NULL,NULL,'2015-09-08 13:29:42','2015-09-08 13:29:42'),(104,'HYUNDAI','HYUNDAI','','','',3,'','','','',NULL,NULL,'2015-09-08 13:30:00','2015-09-08 13:30:00'),(105,'Masiques','Masiques','','','',9,'','','','',NULL,NULL,'2015-09-15 14:39:33','2015-09-15 14:39:33'),(115,'Bernhard Rothfos GmbH','Rothfos','Coffee Plaza-Am Sandtorpark 4','DE-20457','Hamburgo',9,'','','','','',NULL,'2015-10-08 17:37:49','2015-10-08 17:37:49'),(116,'Bernhard Rothfos Intercafé AG','Rothfos Suiza','Bahnhofstrasse, 22','CH-6301','Zug',10,'','','','','',NULL,'2015-10-08 17:50:08','2015-10-08 17:52:02'),(118,'Ecom Agroindustrial Corp. Ltd.','Esteve','Avenue Ettienne Guillermin, 16','CH-1009','Pully',10,'','','','','',NULL,'2015-10-08 17:59:25','2015-10-08 17:59:25'),(126,'asd','asd SL','','','',9,'','','','','','','2015-11-19 12:33:10','2015-11-25 18:06:07'),(127,'Circuletica SL','Circu','','','',23,'618557588','','',NULL,'B652458745',NULL,'2015-11-25 01:13:15','2015-11-25 01:45:48'),(129,'tadad','taratatatoooooooooo','','','',3,'','','','21000889430200119212','','','2015-11-25 16:32:43','2015-11-25 17:19:11'),(130,'tresbolllos','','','','',36,'','','','','','tresbol.es','2015-11-25 22:01:43','2015-11-25 22:02:09');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facturas` (
  `factura_id` int(11) NOT NULL AUTO_INCREMENT,
  `asociado_operacion_id` int(11) NOT NULL,
  `referencia` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`factura_id`),
  KEY `fk_facturas_asociado_operaciones1_idx` (`asociado_operacion_id`),
  CONSTRAINT `fk_facturas_asociado_operaciones1` FOREIGN KEY (`asociado_operacion_id`) REFERENCES `asociado_operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
INSERT INTO `financiaciones` VALUES (19,26,3,4,'2015-11-10',1.883107,NULL,'2015-11-17 22:49:26'),(27,3,3,4,'2011-11-10',2.600000,'2015-11-10 12:46:56','2015-11-17 23:30:52'),(30,3,3,4,'2015-12-01',2.887531,'2015-12-01 12:12:45','2015-12-01 12:12:45');
/*!40000 ALTER TABLE `financiaciones` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fletes`
--

LOCK TABLES `fletes` WRITE;
/*!40000 ALTER TABLE `fletes` DISABLE KEYS */;
INSERT INTO `fletes` VALUES (1,95,12,6,1,19.20,'2015-08-19 21:19:32','2015-08-25 11:59:44'),(2,95,13,6,1,19.20,'2015-08-19 21:43:51','2015-08-19 21:43:51'),(3,95,14,6,1,19.20,'2015-08-19 21:44:31','2015-08-19 21:44:31'),(4,96,12,6,1,19.20,'2015-08-19 21:55:31','2015-08-19 21:55:31'),(6,97,12,6,1,19.20,'2015-08-19 22:06:37','2015-08-19 22:06:37'),(7,97,13,6,1,19.20,'2015-08-19 22:07:08','2015-08-19 22:07:08'),(8,97,14,6,1,19.20,'2015-08-19 22:08:24','2015-08-19 22:08:24'),(9,95,12,9,2,20.00,'2015-08-19 22:11:02','2015-08-19 22:11:02'),(10,95,13,9,2,20.00,'2015-08-19 22:11:30','2015-08-19 22:11:30'),(11,95,14,9,2,20.00,'2015-08-19 22:12:01','2015-08-19 22:12:01'),(12,96,12,9,2,20.00,'2015-08-19 22:12:38','2015-08-19 22:12:38'),(13,96,13,9,2,20.00,'2015-08-19 22:12:58','2015-08-19 22:12:58'),(14,96,14,6,2,20.00,'2015-08-19 22:13:36','2015-08-19 22:13:36'),(15,96,15,6,5,18.97,'2015-08-19 22:15:42','2015-08-20 17:58:30'),(16,96,15,9,NULL,19.25,'2015-08-19 23:22:15','2015-08-19 23:22:15'),(17,96,16,6,5,18.97,'2015-08-19 23:23:17','2015-08-20 17:59:06'),(18,96,16,9,NULL,19.25,'2015-08-19 23:23:49','2015-08-19 23:23:49'),(19,96,17,6,5,18.97,'2015-08-19 23:24:25','2015-08-20 17:59:23'),(20,96,17,9,NULL,19.25,'2015-08-19 23:24:49','2015-08-19 23:24:49'),(21,98,18,6,4,19.25,'2015-08-19 23:25:37','2015-08-20 18:00:00'),(22,95,19,6,4,19.25,'2015-08-19 23:26:08','2015-08-20 18:00:33'),(23,96,20,6,NULL,NULL,'2015-08-19 23:26:43','2015-08-19 23:26:43'),(24,96,20,9,NULL,NULL,'2015-08-19 23:27:01','2015-08-19 23:27:01'),(25,96,21,9,NULL,NULL,'2015-08-19 23:27:25','2015-08-19 23:27:25'),(26,95,22,6,NULL,19.20,'2015-08-19 23:28:06','2015-08-19 23:28:06'),(27,99,23,6,1,19.20,'2015-08-19 23:28:28','2015-08-20 18:01:32'),(28,99,24,6,1,19.20,'2015-08-19 23:28:51','2015-08-20 18:01:46'),(29,95,25,6,1,19.20,'2015-08-20 18:09:10','2015-08-20 18:09:10'),(30,95,25,9,2,21.00,'2015-08-20 18:09:43','2015-08-20 18:09:43'),(31,95,26,6,1,19.20,'2015-08-20 18:10:15','2015-08-20 18:10:15'),(32,95,26,9,2,21.00,'2015-08-20 18:10:43','2015-08-20 18:10:43'),(35,95,12,6,2,20.00,'2015-09-01 13:20:49','2015-10-15 14:53:31'),(36,96,14,6,1,19.20,'2015-09-08 10:47:55','2015-09-08 10:47:55'),(38,95,13,6,2,20.00,'2015-10-15 15:13:11','2015-10-15 15:13:11'),(39,95,14,6,2,20.00,'2015-10-15 15:24:13','2015-10-15 15:24:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incoterms`
--

LOCK TABLES `incoterms` WRITE;
/*!40000 ALTER TABLE `incoterms` DISABLE KEYS */;
INSERT INTO `incoterms` VALUES (1,'CIF',0,0,'2015-07-21 13:15:34','2015-07-21 13:15:34'),(2,'FOB',1,1,NULL,'2015-08-05 17:03:58'),(3,'IN STORE',0,0,NULL,'2015-08-05 17:04:13'),(4,'FOT ',NULL,NULL,NULL,NULL),(5,'IN STORE DESPACHADO',NULL,NULL,NULL,NULL),(6,'FOT DESPACHADO',NULL,NULL,NULL,NULL);
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
  `referencia_proveedor` varchar(45) DEFAULT NULL,
  `humedad` varchar(45) DEFAULT NULL,
  `tueste` varchar(45) DEFAULT NULL,
  `defecto` text,
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
  `criba12` decimal(3,1) unsigned zerofill DEFAULT NULL,
  `apreciacion_bebida` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `almacen_transporte_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linea_muestra_muestras1_idx` (`muestra_id`),
  KEY `fk_linea_muestras_almacen_transportes1_idx` (`almacen_transporte_id`),
  CONSTRAINT `fk_linea_muestras_almacen_transportes1` FOREIGN KEY (`almacen_transporte_id`) REFERENCES `almacen_transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_linea_muestra_muestras1` FOREIGN KEY (`muestra_id`) REFERENCES `muestras` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea_muestras`
--

LOCK TABLES `linea_muestras` WRITE;
/*!40000 ALTER TABLE `linea_muestras` DISABLE KEYS */;
INSERT INTO `linea_muestras` VALUES (1,1,'5576/15','85%','suave','ninguno',10.0,20.0,05.0,05.0,15.0,05.0,05.0,05.0,05.0,05.0,05.0,05.0,NULL,NULL,NULL,'Sabor a café','2015-03-19 00:19:01','2015-03-19 00:19:01',0),(3,1,'345','12,3%','ffffffffffff','black and broken beans: 4,5%',NULL,NULL,04.0,25.0,02.0,26.0,03.0,30.0,NULL,10.0,NULL,NULL,NULL,NULL,NULL,'Acidez media alta\r\ncuerpo medio bajo\r\nleve suavidad todas las tazas\r\n1 Taza fermentada\r\n1 Taza sucia\r\n1 Taza fenol\r\n','2015-03-24 15:17:53','2015-03-24 15:17:53',0),(4,1,'14/37/654','85%','suave','Una taza riada\r\nManchas de aceite\r\nPar de granos azules',10.0,10.5,09.5,11.0,09.0,20.0,08.5,01.5,02.8,07.2,NULL,10.0,NULL,NULL,NULL,'','2015-03-26 01:03:59','2015-05-29 16:24:05',0),(5,1,'','mucha','','',10.0,10.5,09.5,11.0,09.0,20.0,08.5,01.5,02.8,07.2,00.0,10.0,NULL,NULL,NULL,'','2015-03-26 01:11:04','2015-05-26 12:46:05',0),(8,6,'13-99402/00','11,3','FINO FINO','6 SEGUN TABLA DE NUEVA YORK EN 300 GRS\r\nFOREIGN MATTERS:0,1%',NULL,NULL,NULL,17.3,02.5,30.1,02.8,20.5,NULL,17.0,NULL,09.8,NULL,NULL,NULL,'ACIDEZ MEDIA ALTA\r\nCUERPOMEDIO ALTO\r\nMUY SUAVE Y LIMPIO\r\nSABOR AFRUTADO UNIFORME','2015-03-27 13:48:25','2015-05-26 13:39:41',0),(18,10,'','','','',NULL,NULL,NULL,NULL,33.3,33.3,33.3,00.1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','2015-11-27 13:19:06','2015-11-27 13:19:06',0),(19,22,'','','','',10.0,50.0,20.0,20.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','2015-12-01 12:57:33','2015-12-01 12:57:33',8),(20,22,'xxxxxx','alta','','',20.0,NULL,NULL,NULL,30.0,50.0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','2015-12-06 01:25:12','2015-12-06 01:48:03',8);
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
  `proveedor_id` int(11) NOT NULL,
  `calidad_id` int(11) NOT NULL,
  `operacion_id` int(11) DEFAULT NULL,
  `referencia` varchar(45) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `aprobado` tinyint(1) unsigned zerofill DEFAULT NULL,
  `incidencia` text,
  `tipo` int(1) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_muestras_calidades1_idx` (`calidad_id`),
  KEY `fk_muestras_proveedores1_idx` (`proveedor_id`),
  KEY `referencia` (`referencia`),
  KEY `fk_muestras_operaciones1_idx` (`operacion_id`),
  CONSTRAINT `fk_muestras_calidades1` FOREIGN KEY (`calidad_id`) REFERENCES `calidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_operaciones1` FOREIGN KEY (`operacion_id`) REFERENCES `operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_proveedores1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muestras`
--

LOCK TABLES `muestras` WRITE;
/*!40000 ALTER TABLE `muestras` DISABLE KEYS */;
INSERT INTO `muestras` VALUES (1,38,5,NULL,'104/17','2015-03-13 18:37:00',1,'',1,'2015-03-14 01:23:07','2015-03-14 01:23:07'),(4,39,9,NULL,'15/027','2015-03-26 00:00:00',1,'El café ha llegado a puerto',1,'2015-03-26 12:48:01','2015-03-26 12:48:01'),(6,40,24,NULL,'15/031','2015-03-27 00:00:00',0,'Muestra de embarque llegada antes del embarque',1,'2015-03-27 13:43:17','2015-04-14 00:42:02'),(10,41,24,NULL,'15/003','2014-04-07 00:00:00',1,'MUESTRA APROBADA RECIBIDA DESDE ALMACEN EN ALMENIA\r\nEL CAFE LLEGARA AL ALACEN DEL SOCIO\r\nCAFE MU BUENO + INTRO\r\nCAFE MEJOR\r\n',1,'2015-04-07 13:40:59','2015-09-15 15:28:59'),(14,43,10,NULL,'007/007','2015-04-26 00:00:00',0,'',1,'2015-04-26 19:04:48','2015-04-26 19:04:48'),(15,48,6,NULL,'008/008','2015-04-26 00:00:00',0,'Pues no me gusta',1,'2015-04-26 19:39:44','2015-09-09 12:44:25'),(16,46,25,NULL,'123/456','2015-04-26 00:00:00',0,'',1,'2015-04-26 23:43:14','2015-04-26 23:46:00'),(17,36,9,NULL,'000/111','2015-05-08 00:00:00',1,'',2,'2015-05-08 16:48:02','2015-07-01 16:34:53'),(18,47,6,NULL,'001/001/001','2015-05-08 00:00:00',1,'',3,'2015-05-08 17:24:47','2015-05-08 17:24:47'),(19,41,5,NULL,'69/69','2014-05-08 00:00:00',1,'',2,'2015-05-08 17:25:34','2015-07-01 16:35:30'),(20,39,28,NULL,'OF12234','2015-10-15 00:00:00',0,'',1,'2015-10-15 13:24:16','2015-10-15 13:24:16'),(21,41,39,NULL,'llllllllllllllll','2015-10-29 00:00:00',1,'Todo bien',1,'2015-10-29 16:07:01','2015-10-29 16:07:01'),(22,38,28,27,'llllllllllll','2015-11-30 00:00:00',1,'',2,'2015-11-30 23:48:58','2015-11-30 23:48:58'),(23,38,28,30,'12345','2015-12-01 00:00:00',0,'',2,'2015-12-01 12:10:57','2015-12-01 12:10:57');
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
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navieras`
--

LOCK TABLES `navieras` WRITE;
/*!40000 ALTER TABLE `navieras` DISABLE KEYS */;
INSERT INTO `navieras` VALUES (95,'2015-08-19 18:17:54','2015-09-22 13:57:57'),(96,'2015-08-19 18:18:21','2015-11-13 17:26:30'),(97,'2015-08-19 18:19:08','2015-10-15 13:34:48'),(98,'2015-08-19 18:19:29','2015-10-15 13:20:19'),(99,'2015-08-19 18:20:01','2015-09-08 13:01:53'),(100,'2015-09-08 13:00:08','2015-09-08 13:00:08'),(101,'2015-09-08 13:28:37','2015-09-08 13:28:37'),(102,'2015-09-08 13:29:16','2015-09-08 13:29:16'),(103,'2015-09-08 13:29:43','2015-09-08 13:29:43'),(104,'2015-09-08 13:30:00','2015-09-08 13:30:00');
/*!40000 ALTER TABLE `navieras` ENABLE KEYS */;
UNLOCK TABLES;

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
  `referencia` varchar(15) NOT NULL,
  `lotes_operacion` mediumint(9) DEFAULT NULL,
  `fecha_pos_fijacion` date DEFAULT NULL,
  `precio_fijacion` decimal(6,2) DEFAULT NULL,
  `precio_compra` decimal(6,2) DEFAULT NULL,
  `opciones` decimal(6,2) NOT NULL,
  `cambio_dolar_euro` decimal(6,4) DEFAULT NULL,
  `flete` decimal(8,2) NOT NULL,
  `forfait` decimal(8,2) NOT NULL,
  `seguro` decimal(8,2) NOT NULL,
  `gastos_bancarios` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `flete_total` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `despacho_aduana` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `seguro_total` decimal(8,2) unsigned zerofill DEFAULT NULL,
  `puerto_carga_id` int(11) DEFAULT NULL,
  `puerto_destino_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones`
--

LOCK TABLES `operaciones` WRITE;
/*!40000 ALTER TABLE `operaciones` DISABLE KEYS */;
INSERT INTO `operaciones` VALUES (19,31,1,'15/028',2,'2015-01-14',1986.00,1986.00,0.00,1.2273,0.00,49.00,0.00,000000.00,000000.00,000000.00,000000.00,NULL,0,NULL,'2015-07-21 20:23:31','2015-08-07 23:49:00'),(24,58,2,'15/059',NULL,'2015-08-01',NULL,NULL,0.00,NULL,0.00,0.00,0.00,000000.00,000000.00,000000.00,000000.00,NULL,0,NULL,'2015-08-11 14:38:52','2015-08-20 12:50:24'),(27,63,2,'15/006',6,'2015-08-01',171.20,171.20,0.00,1.3289,0.00,0.00,0.85,NULL,NULL,NULL,NULL,NULL,0,'','2015-08-18 14:40:09','2015-08-18 14:40:09'),(29,65,4,'',9,'2015-08-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,18,6,NULL,'2015-10-08 17:25:56','2015-10-08 17:28:12'),(30,66,4,'',1,'2016-08-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,18,6,NULL,'2015-10-08 17:29:47','2015-10-08 17:29:47'),(31,67,4,'',3,'2015-08-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,18,6,NULL,'2015-10-08 17:39:34','2015-10-08 17:39:34'),(32,69,5,'#sacos69',NULL,'2015-09-11',NULL,NULL,0.00,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,6,NULL,'2015-10-08 17:57:10','2015-12-01 13:56:49'),(33,71,2,'',4,'2015-08-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,6,NULL,'2015-10-08 18:33:11','2015-10-08 18:33:11'),(34,71,2,'',2,'2015-08-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,9,NULL,'2015-10-08 18:34:00','2015-10-08 18:34:00'),(35,72,2,'',2,'2015-08-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,6,NULL,'2015-10-08 18:37:58','2015-10-08 18:37:58'),(36,72,2,'',4,'2015-10-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,9,NULL,'2015-10-08 18:46:32','2015-10-08 18:46:32'),(37,72,2,'',4,'2015-10-21',130.10,125.00,0.00,1.1002,0.00,0.00,0.00,NULL,NULL,NULL,NULL,NULL,9,NULL,'2015-10-08 18:46:45','2015-10-08 18:46:45'),(43,77,4,'',9,'2015-08-24',126.55,125.00,0.00,1.1100,0.00,0.00,0.00,NULL,NULL,NULL,NULL,18,6,NULL,'2015-10-14 17:36:09','2015-10-14 18:37:47'),(44,78,4,'',9,'2015-09-09',126.10,122.00,0.00,1.1014,0.00,0.00,0.00,NULL,NULL,NULL,NULL,18,6,NULL,'2015-10-14 18:25:44','2015-10-14 18:37:13'),(45,79,4,'',9,'2015-09-21',122.40,122.40,0.00,1.1100,0.00,0.00,0.00,NULL,NULL,NULL,NULL,18,6,NULL,'2015-10-14 18:32:24','2015-10-15 13:57:05');
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
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Brasil','br',55,'2015-02-06 22:47:29','2015-03-10 12:10:41'),(2,'Colombia','co',NULL,'2015-02-06 22:47:41','2015-02-06 22:47:41'),(3,'España','es',34,'2015-02-07 01:05:18','2015-02-24 23:58:34'),(4,'Tanzania','tz',NULL,'2015-02-07 01:05:31','2015-02-07 01:05:31'),(5,'Francia','fr',33,'2015-02-10 14:24:25','2015-02-24 23:58:23'),(6,'Bélgica','be',32,'2015-03-10 11:15:17','2015-03-10 12:09:41'),(7,'Perú','pe',NULL,'2015-03-10 11:30:38','2015-03-10 11:30:38'),(8,'Kenia','ke',NULL,'2015-03-10 11:42:13','2015-03-10 11:42:13'),(9,'Alemania','de',49,'2015-03-10 11:48:52','2015-03-10 12:10:18'),(10,'Suiza','ch',NULL,'2015-03-10 11:53:43','2015-03-10 11:53:43'),(11,'Estados Unidos','us',NULL,'2015-03-10 11:56:32','2015-03-10 11:56:32'),(12,'Nicaragua','ni',NULL,'2015-03-10 12:02:39','2015-03-10 12:02:39'),(14,'Vietnam','vn',NULL,'2015-03-16 16:31:16','2015-03-16 16:31:16'),(19,'Indonesia','',NULL,'2015-03-16 22:56:37','2015-03-16 22:56:37'),(20,'Etiopía','et',NULL,'2015-03-16 23:06:40','2015-08-18 14:51:16'),(21,'Italia','it',NULL,'2015-03-23 22:58:05','2015-03-23 22:58:05'),(22,'Rusia','',NULL,'2015-03-24 12:57:30','2015-03-24 12:57:30'),(23,'Costa Rica','cr',NULL,'2015-08-18 14:45:09','2015-08-18 14:45:09'),(24,'Guatemala','gt',NULL,'2015-08-18 14:46:10','2015-08-18 14:46:10'),(25,'Honduras','hn',NULL,'2015-08-18 14:47:42','2015-08-18 14:47:42'),(26,'India','in',NULL,'2015-08-20 18:05:21','2015-08-20 18:05:21'),(27,'Congo','',NULL,'2015-10-15 13:41:12','2015-10-15 13:41:12'),(28,'Senegal','',NULL,'2015-10-15 13:43:52','2015-10-15 13:43:52'),(29,'Mongolia','',NULL,'2015-10-15 16:13:48','2015-10-15 16:13:48'),(30,'Noruega','',NULL,'2015-10-15 16:14:39','2015-10-15 16:14:39'),(32,'Suecia','',NULL,'2015-10-15 16:31:45','2015-10-15 16:31:45'),(34,'Argentina','ar',54,'2015-11-18 12:56:51','2015-11-18 12:56:51'),(35,'Chile','cl',NULL,'2015-11-19 11:30:04','2015-11-19 11:30:04'),(36,'Agfanistan','',NULL,'2015-11-19 13:33:53','2015-11-19 13:33:53'),(37,'Chequia',NULL,NULL,NULL,NULL);
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
  `peso` tinyint NOT NULL
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `precio_fletes`
--

LOCK TABLES `precio_fletes` WRITE;
/*!40000 ALTER TABLE `precio_fletes` DISABLE KEYS */;
INSERT INTO `precio_fletes` VALUES (8,4,'2014-09-30',NULL,1000.00,'2015-08-25 01:13:46','2015-08-25 01:13:46'),(10,6,'2014-09-30',NULL,1000.00,'2015-08-25 01:15:21','2015-08-25 01:15:21'),(11,7,'2014-09-30',NULL,1000.00,'2015-08-25 01:16:21','2015-08-25 01:16:21'),(12,8,'2014-09-30',NULL,1000.00,'2015-08-25 01:16:57','2015-08-25 01:16:57'),(17,1,'2015-06-02','2015-09-30',811.00,'2015-09-08 10:22:12','2015-09-08 10:22:12'),(18,2,'2015-06-02','2015-09-30',811.00,'2015-09-08 10:23:36','2015-09-08 10:23:36'),(19,3,'2015-06-02','2015-09-30',811.00,'2015-09-08 10:27:35','2015-09-08 10:27:35'),(20,9,'2015-06-02','2015-09-30',1036.00,'2015-09-08 10:31:07','2015-09-08 10:31:07'),(21,10,'2015-06-02','2015-09-30',1036.00,'2015-09-08 10:31:37','2015-09-08 10:31:37'),(22,11,'2015-06-02','2015-09-30',1036.00,'2015-09-08 10:32:05','2015-09-08 10:32:05'),(24,3,'2015-10-01','2015-12-31',736.00,'2015-09-22 10:23:44','2015-09-22 10:23:44'),(25,21,'2015-08-13','2015-12-31',585.00,'2015-10-15 14:16:44','2015-10-15 14:17:22'),(26,29,'2015-10-01','2015-10-31',723.00,'2015-10-15 14:25:37','2015-10-15 14:25:37'),(27,31,'2015-10-01','2015-10-31',913.00,'2015-10-15 14:26:27','2015-10-15 14:26:27'),(28,35,'2015-10-01','2015-12-31',736.00,'2015-10-15 14:53:04','2015-10-15 14:53:04'),(29,2,'2015-10-01','2015-12-31',736.00,'2015-10-15 14:57:45','2015-10-15 14:57:45'),(30,1,'2015-10-01','2015-12-31',736.00,'2015-10-15 15:01:37','2015-10-15 15:01:37'),(31,38,'2015-10-01','2015-12-31',736.00,'2015-10-15 15:13:51','2015-10-15 15:13:51'),(32,39,'2015-10-01','2015-12-31',736.00,'2015-10-15 15:24:42','2015-10-15 15:24:42'),(33,9,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:25:47','2015-10-15 15:25:47'),(34,11,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:26:31','2015-10-15 15:26:31'),(35,13,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:27:00','2015-10-15 15:27:00'),(36,10,'2015-10-01','2015-12-31',1011.00,'2015-10-15 15:28:03','2015-10-15 15:28:03');
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
  `divisa` tinyint NOT NULL,
  `precio_dolar_tonelada` tinyint NOT NULL
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
  `precio_dolar_tonelada` tinyint NOT NULL,
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
INSERT INTO `proveedores` VALUES (36,'2015-03-10 11:26:58','2015-03-10 11:26:58'),(37,'2015-03-10 11:39:25','2015-03-10 11:45:29'),(38,'2015-03-10 11:39:47','2015-09-22 12:39:32'),(39,'2015-03-10 11:43:30','2015-08-29 00:47:31'),(40,'2015-03-10 11:45:07','2015-03-10 11:45:07'),(41,'2015-03-10 11:49:34','2015-03-10 11:49:34'),(43,'2015-03-10 11:54:19','2015-03-10 11:54:19'),(44,'2015-03-10 11:57:06','2015-03-10 11:57:06'),(45,'2015-03-10 11:59:27','2015-03-10 11:59:27'),(46,'2015-03-10 12:01:15','2015-03-10 12:01:15'),(47,'2015-03-10 12:03:18','2015-03-10 12:03:18'),(48,'2015-03-10 12:05:28','2015-03-10 12:05:28'),(88,'2015-07-25 14:32:58','2015-07-25 14:32:58'),(115,'2015-10-08 17:37:49','2015-10-08 17:37:49'),(116,'2015-10-08 17:50:08','2015-10-08 17:52:02'),(118,'2015-10-08 17:59:25','2015-10-08 17:59:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puertos`
--

LOCK TABLES `puertos` WRITE;
/*!40000 ALTER TABLE `puertos` DISABLE KEYS */;
INSERT INTO `puertos` VALUES (1,'Venecia',9,'2015-06-15 13:05:17','2015-07-09 18:47:38'),(2,'Marsella',5,'2015-06-15 13:05:27','2015-06-15 13:05:27'),(3,'San Petesburgo',22,'2015-06-15 13:05:39','2015-06-15 13:05:39'),(5,'Burdeos',9,'2015-07-17 19:12:12','2015-07-17 19:12:12'),(6,'Barcelona',3,'2015-07-17 19:14:47','2015-07-17 19:14:47'),(7,'Bilbao',3,'2015-07-17 19:14:57','2015-07-17 19:15:02'),(8,'Santander',3,'2015-07-17 19:15:07','2015-07-17 19:15:21'),(9,'Gijón',3,'2015-07-25 14:16:11','2015-07-25 14:16:11'),(11,'Trieste',21,'2015-07-28 11:08:34','2015-07-28 11:08:34'),(12,'Santos',1,'2015-08-18 14:43:13','2015-08-18 14:43:13'),(13,'Rio',1,'2015-08-18 14:43:26','2015-08-18 14:43:26'),(14,'Salvador',1,'2015-08-18 14:43:39','2015-08-18 14:43:39'),(15,'Pto. Limón',23,'2015-08-18 14:45:29','2015-08-18 14:45:29'),(16,'Sto. Tomás Castilla',24,'2015-08-18 14:46:40','2015-08-18 14:46:40'),(17,'Pto. Cortés',25,'2015-08-18 14:48:11','2015-08-18 14:48:11'),(18,'Cartagena',2,'2015-08-18 14:48:49','2015-08-18 14:48:49'),(19,'Buenaventura',2,'2015-08-18 14:49:07','2015-08-18 14:49:07'),(20,'Managua',12,'2015-08-18 14:49:49','2015-08-18 14:49:49'),(21,'Matagalpa',12,'2015-08-18 14:50:00','2015-08-18 14:50:00'),(22,'Djibuti',20,'2015-08-18 14:51:33','2015-08-18 14:51:33'),(23,'Mombasa',8,'2015-08-18 14:51:54','2015-08-20 18:08:08'),(24,'Dar Salaam',4,'2015-08-18 14:52:22','2015-08-18 14:52:22'),(25,'Cochin',26,'2015-08-20 18:05:47','2015-08-20 18:05:47'),(26,'Mangalore',26,'2015-08-20 18:06:04','2015-08-20 18:06:04'),(27,'Ho Chi Minh',14,'2015-08-20 18:06:34','2015-08-20 18:06:34'),(28,'Santiago',35,'2015-11-19 12:46:00','2015-11-19 12:46:00'),(29,'Cadiz',3,'2015-11-19 12:51:06','2015-11-19 12:51:06'),(31,'Hamburg',9,'2015-11-19 12:54:24','2015-11-19 12:54:24'),(35,'Lima',7,'2015-11-19 13:01:28','2015-11-19 13:01:28');
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
  `cantidad_retirada` int(11) DEFAULT NULL,
  `fecha_retirada` date DEFAULT NULL,
  `asociado_id` int(11) NOT NULL,
  `almacen_transporte_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_retiradas_asociados1_idx` (`asociado_id`),
  KEY `fk_retiradas_almacen_transportes1_idx` (`almacen_transporte_id`),
  CONSTRAINT `fk_retiradas_almacen_transportes1` FOREIGN KEY (`almacen_transporte_id`) REFERENCES `almacen_transportes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_retiradas_asociados1` FOREIGN KEY (`asociado_id`) REFERENCES `asociados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retiradas`
--

LOCK TABLES `retiradas` WRITE;
/*!40000 ALTER TABLE `retiradas` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_ivas`
--

LOCK TABLES `tipo_ivas` WRITE;
/*!40000 ALTER TABLE `tipo_ivas` DISABLE KEYS */;
INSERT INTO `tipo_ivas` VALUES (1,'superreducido','2015-10-31 13:20:17','2015-10-31 13:20:02'),(3,'reducido','2015-10-31 13:20:17','2015-10-31 13:20:10'),(4,'general','2015-10-31 13:20:17','2015-10-31 13:20:17');
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
  `suplemento_seguro` varchar(45) DEFAULT NULL,
  `peso_factura` decimal(8,2) DEFAULT NULL,
  `peso_neto` decimal(8,2) DEFAULT NULL,
  `averia` decimal(8,2) DEFAULT NULL,
  `modified` datetime DEFAULT NULL COMMENT '\n',
  `created` datetime DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportes`
--

LOCK TABLES `transportes` WRITE;
/*!40000 ALTER TABLE `transportes` DISABLE KEYS */;
INSERT INTO `transportes` VALUES (45,96,59,27,NULL,NULL,90,30,NULL,'2015-02-02',NULL,'2015-01-02',NULL,NULL,NULL,NULL,NULL,NULL,'Titanicq','MRC4569872423','El barco vendrá antes de tiempo. Esten atentos ¡¡IMPORTANTE!!','2015-03-02',NULL,NULL,NULL,NULL,NULL,'2015-11-26 14:31:11','2015-08-21 10:22:44'),(50,97,60,19,NULL,NULL,NULL,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Titanic','M354342','',NULL,NULL,'',NULL,NULL,NULL,'2015-12-03 15:36:52','2015-09-23 09:21:50'),(51,103,64,19,NULL,NULL,89,NULL,NULL,'2016-05-03',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Periquito','HJA987654','',NULL,5000.00,NULL,NULL,NULL,NULL,'2015-09-23 09:22:27','2015-09-23 09:22:27'),(52,98,60,19,NULL,NULL,90,NULL,NULL,'2015-02-03',NULL,NULL,'2016-02-03',NULL,NULL,NULL,NULL,NULL,'La Casa','POI984834872','',NULL,85000.00,NULL,NULL,NULL,NULL,'2015-09-23 11:00:43','2015-09-23 09:28:08'),(53,95,64,27,NULL,NULL,89,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Buquebus','MRC987','',NULL,NULL,NULL,NULL,NULL,NULL,'2015-11-18 19:44:55','2015-11-18 17:33:02'),(54,97,59,32,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Buque colonia','TRE852963','',NULL,NULL,NULL,NULL,NULL,NULL,'2015-11-19 12:15:34','2015-11-19 12:15:34'),(55,95,60,24,7,6,89,23,'2015-03-01','2014-01-01','2014-01-01','2014-01-01','2014-01-01','2014-03-05',NULL,'2014-01-01','2014-01-02','2014-01-01','Solidaridad','RRR09876','','2015-03-02',1500.00,'150.00',2500.00,2550.00,20.00,'2015-11-26 12:52:45','2015-11-26 12:52:45'),(56,95,NULL,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'a','a','',NULL,NULL,NULL,NULL,NULL,NULL,'2015-11-30 13:05:51','2015-11-30 13:05:51');
/*!40000 ALTER TABLE `transportes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `valor_tipo_ivas`
--

LOCK TABLES `valor_tipo_ivas` WRITE;
/*!40000 ALTER TABLE `valor_tipo_ivas` DISABLE KEYS */;
INSERT INTO `valor_tipo_ivas` VALUES (1,1,3.00,'1993-01-01','1994-12-31',NULL,'2015-11-19 00:51:05'),(2,1,4.00,'1995-01-01',NULL,'2015-10-31 13:33:53','2015-11-19 00:51:55'),(3,3,10.00,'2012-09-01',NULL,'2015-10-31 13:34:45','2015-10-31 13:34:45'),(4,3,8.00,'2010-07-01','2012-08-31','2015-10-31 13:37:03','2015-10-31 13:37:03'),(5,4,21.00,'2012-09-01',NULL,'2015-10-31 13:39:28','2015-10-31 13:39:28'),(6,4,18.00,'2010-06-01','2012-08-31','2015-10-31 13:40:54','2015-10-31 13:40:54');
/*!40000 ALTER TABLE `valor_tipo_ivas` ENABLE KEYS */;
UNLOCK TABLES;

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
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `peso_operaciones` AS select `operaciones`.`id` AS `id`,`operaciones`.`contrato_id` AS `contrato_id`,(select ifnull(sum(`asociado_operaciones`.`cantidad_embalaje_asociado`),0) from `asociado_operaciones` where (`asociado_operaciones`.`operacion_id` = `operaciones`.`id`)) AS `cantidad_embalaje`,((select ifnull(sum(`asociado_operaciones`.`cantidad_embalaje_asociado`),0) from `asociado_operaciones` where (`asociado_operaciones`.`operacion_id` = `operaciones`.`id`)) * (select `contrato_embalajes`.`peso_embalaje_real` from `contrato_embalajes` where ((`contrato_embalajes`.`contrato_id` = `operaciones`.`contrato_id`) and (`contrato_embalajes`.`embalaje_id` = `operaciones`.`embalaje_id`)))) AS `peso` from `operaciones` */;
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
/*!50013 DEFINER=`cmpsa`@`192.168.2.35` SQL SECURITY DEFINER */
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
/*!50013 DEFINER=`cmpsa`@`192.168.2.35` SQL SECURITY DEFINER */
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
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_operaciones` AS select `o`.`id` AS `id`,((`o`.`precio_fijacion` + `co`.`diferencial`) + `o`.`opciones`) AS `precio_divisa`,`ca`.`divisa` AS `divisa`,(case when (`ca`.`divisa` = '¢/Lb') then (((`o`.`precio_fijacion` + `co`.`diferencial`) + `o`.`opciones`) * 22.04623) else ((`o`.`precio_fijacion` + `co`.`diferencial`) + `o`.`opciones`) end) AS `precio_dolar_tonelada` from ((`operaciones` `o` join `contratos` `co`) join `canal_compras` `ca`) where ((`o`.`contrato_id` = `co`.`id`) and (`co`.`canal_compra_id` = `ca`.`id`)) */;
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
/*!50013 DEFINER=`cmpsa`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `precio_total_operaciones` AS select `o`.`id` AS `id`,round(`p`.`precio_dolar_tonelada`,4) AS `precio_dolar_tonelada`,round(((`p`.`precio_dolar_tonelada` + `o`.`flete`) / `o`.`cambio_dolar_euro`),4) AS `precio_euro_tonelada`,round((((`p`.`precio_dolar_tonelada` + `o`.`flete`) / `o`.`cambio_dolar_euro`) * (`o`.`seguro` / 100)),4) AS `seguro_euro_tonelada`,round((((((`p`.`precio_dolar_tonelada` + `o`.`flete`) / `o`.`cambio_dolar_euro`) * (1 + (`o`.`seguro` / 100))) + `o`.`forfait`) / 1000),6) AS `precio_euro_kilo_total` from (`operaciones` `o` join `precio_operaciones` `p`) where (`o`.`id` = `p`.`id`) */;
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
/*!50013 DEFINER=`cmpsa`@`192.168.2.35` SQL SECURITY DEFINER */
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

-- Dump completed on 2015-12-08 21:27:12
