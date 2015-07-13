-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: cmpsa_migration
-- ------------------------------------------------------
-- Server version	5.5.43-0+deb7u1-log

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
  CONSTRAINT `fk_agentes_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agentes`
--

LOCK TABLES `agentes` WRITE;
/*!40000 ALTER TABLE `agentes` DISABLE KEYS */;
INSERT INTO `agentes` VALUES (64,'2015-05-26 14:22:05','2015-05-26 14:22:05');
/*!40000 ALTER TABLE `agentes` ENABLE KEYS */;
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
  CONSTRAINT `fk_almacenes_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
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
-- Table structure for table `aseguradoras`
--

DROP TABLE IF EXISTS `aseguradoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aseguradoras` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_aseguradoras_empresas1_idx` (`id`),
  CONSTRAINT `fk_aseguradoras_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aseguradoras`
--

LOCK TABLES `aseguradoras` WRITE;
/*!40000 ALTER TABLE `aseguradoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `aseguradoras` ENABLE KEYS */;
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
  CONSTRAINT `fk_asociados_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asociados`
--

LOCK TABLES `asociados` WRITE;
/*!40000 ALTER TABLE `asociados` DISABLE KEYS */;
/*!40000 ALTER TABLE `asociados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banco_pruebas`
--

DROP TABLE IF EXISTS `banco_pruebas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banco_pruebas` (
  `id` int(11) NOT NULL,
  `bic` char(11) DEFAULT NULL,
  `cuenta_cliente_1` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_bancos_pruebas_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banco_pruebas`
--

LOCK TABLES `banco_pruebas` WRITE;
/*!40000 ALTER TABLE `banco_pruebas` DISABLE KEYS */;
INSERT INTO `banco_pruebas` VALUES (3,'BBVAESMM','01824572420000074739'),(4,'BSCHESMM','1490-0100-92-0001235'),(14,'',''),(15,'BSABESBBXXX','00815760340001359645'),(16,'',''),(17,'',''),(18,'BMARES2MXXX',''),(26,'BKBKESMM','01289404030100074446');
/*!40000 ALTER TABLE `banco_pruebas` ENABLE KEYS */;
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
  `descripcion` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`descafeinado`,`pais_id`,`descripcion`) USING BTREE,
  KEY `fk_calidades_paises1_idx` (`pais_id`),
  KEY `descripcion` (`descripcion`),
  KEY `descafeinado` (`descafeinado`),
  CONSTRAINT `fk_calidades_paises1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calidades`
--

LOCK TABLES `calidades` WRITE;
/*!40000 ALTER TABLE `calidades` DISABLE KEYS */;
INSERT INTO `calidades` VALUES (5,0,2,'Huila Excelso Criba 16','2015-03-12 23:59:58','2015-04-11 00:41:36'),(6,1,1,'N.Y.4, MTGB Duro limpio EA Process','2015-03-13 00:06:32','2015-03-17 15:29:24'),(8,0,1,'N.Y.4, 17/18,Duro Limpio','2015-03-16 10:31:51','2015-03-16 15:05:13'),(9,0,8,'AA Top','2015-03-16 10:37:26','2015-03-16 16:08:06'),(10,0,12,'S.H.G. Criba 16 Up','2015-03-16 10:37:59','2015-03-16 15:06:12'),(11,1,NULL,'Colombia/Brasil/Uganda( 30%,30%,40%)','2015-03-16 10:38:58','2015-03-16 17:58:04'),(12,0,14,'Robusta Criba 18 Limpio','2015-03-16 17:34:38','2015-03-17 09:59:03'),(23,0,1,'N.Y.4,17/18,Strictly Soft,Fine Roast','2015-03-16 23:05:51','2015-03-17 10:00:44'),(24,0,20,'Sidamo Grado 2','2015-03-16 23:06:57','2015-03-17 10:00:59'),(25,1,14,'Robusta Grado 2 (5%) EA Process','2015-03-17 12:00:42','2015-03-17 12:00:42');
/*!40000 ALTER TABLE `calidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `pais_id` int(11) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `cif` varchar(45) DEFAULT NULL,
  `codigo_contable` varchar(45) DEFAULT NULL,
  `cuenta_bancaria` varchar(45) DEFAULT NULL,
  `nombre_contacto1` varchar(45) DEFAULT NULL,
  `tfno_contacto1` varchar(45) DEFAULT NULL,
  `email_contacto1` varchar(45) DEFAULT NULL,
  `nombre_contacto2` varchar(45) DEFAULT NULL,
  `tfno_contacto2` varchar(45) DEFAULT NULL,
  `email_contacto2` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresas_paises1_idx` (`pais_id`),
  KEY `nombre` (`nombre`),
  CONSTRAINT `fk_empresas_paises13` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactos`
--

LOCK TABLES `contactos` WRITE;
/*!40000 ALTER TABLE `contactos` DISABLE KEYS */;
INSERT INTO `contactos` VALUES (3,4,'Emilio Botín','emilio@listafalciani.com','653306436','918695233','Golfista','2015-02-13 18:55:11','2015-02-17 23:41:31'),(6,3,'Juan Carlos Castro','','','','responsable cuenta','2015-02-17 15:25:01','2015-02-17 15:25:01'),(8,18,'Toto Cutugno','toto@libero.it','666 55 44 33','777 88 99 00','cantautor','2015-02-17 21:42:49','2015-02-17 23:59:22'),(9,26,'Lola Flores','','','','Cantaora','2015-02-24 12:30:26','2015-02-24 12:30:26'),(11,3,'Jordi Évole','','','','tocapelotas','2015-02-24 22:36:33','2015-02-24 22:36:33'),(13,50,'Camilo Sesto','','666554433','','Peluquero','2015-03-10 13:25:07','2015-05-05 16:12:28'),(15,18,'Pablo Iglesias','pabloiglesias@podemos.es','913241201','','Cofundador','2015-03-24 13:10:36','2015-04-07 15:03:34'),(18,40,'persona','correo@correos.es','3423423424','453452522','funcionando','2015-04-07 17:45:55','2015-04-07 17:46:05'),(19,3,'hola','hola@hola.com','1548721','157892118','que tal','2015-04-09 13:54:40','2015-04-09 13:54:40'),(22,63,'Manu Chao','','666554433','','Flautista','2015-04-24 17:42:59','2015-04-24 17:42:59'),(23,16,'','pepito@movistar.com','','','','2015-05-07 22:10:09','2015-05-07 22:10:09'),(25,16,'','lacosa@loes.com','','','','2015-05-07 22:10:36','2015-05-07 22:10:36'),(26,47,'Jesús','empleadojesus@gmail.com','913341568','','Empleado','2015-05-28 20:39:44','2015-05-28 20:39:44'),(27,63,'Chulito Camacho','camacho@chulito.com','36565875218','','Cantante','2015-05-30 12:23:17','2015-05-30 12:23:17'),(28,64,'Juan José','juanjo@importente.org','','','','2015-05-30 12:26:05','2015-05-30 12:26:05'),(29,39,'Ada Colau','adacolau@bcn.org','938521478','','Activista','2015-05-30 12:33:51','2015-05-30 12:33:51'),(30,40,'Pedro','unomas@carla.es','633354547','','jefe - Tráfico','2015-06-02 13:24:53','2015-06-02 13:24:53'),(31,40,'Pedro','unomas@carla.es','633354547','','jefe - Tráfico','2015-06-02 13:24:56','2015-06-02 13:24:56');
/*!40000 ALTER TABLE `contactos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contratos`
--

DROP TABLE IF EXISTS `contratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contratos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(45) DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL,
  `incoterm_id` int(11) NOT NULL,
  `calidad_id` int(11) NOT NULL,
  `si_diferencial` tinyint(1) DEFAULT NULL,
  `diferencial` decimal(5,2) DEFAULT NULL,
  `si_londres` tinyint(1) DEFAULT NULL,
  `opciones` decimal(5,2) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_contratos_proveedores1_idx` (`proveedor_id`),
  KEY `fk_contratos_incoterms1_idx` (`incoterm_id`),
  KEY `fk_contratos_calidades1_idx` (`calidad_id`),
  CONSTRAINT `fk_contratos_calidades1` FOREIGN KEY (`calidad_id`) REFERENCES `calidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_incoterms1` FOREIGN KEY (`incoterm_id`) REFERENCES `incoterms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_contratos_proveedores1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratos`
--

LOCK TABLES `contratos` WRITE;
/*!40000 ALTER TABLE `contratos` DISABLE KEYS */;
INSERT INTO `contratos` VALUES (2,'001',38,1,9,NULL,4.00,0,3.00,NULL,NULL),(3,'001',38,1,9,NULL,4.00,0,3.00,NULL,NULL),(4,'017/17',40,2,24,NULL,2.00,0,2.00,NULL,NULL);
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
  `peso` decimal(10,0) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embalajes`
--

LOCK TABLES `embalajes` WRITE;
/*!40000 ALTER TABLE `embalajes` DISABLE KEYS */;
INSERT INTO `embalajes` VALUES (1,'saco 60kg',60,NULL,NULL),(2,'big bag',1000,NULL,NULL),(3,'saco 69kg',69,NULL,NULL),(4,'saco 70kg',70,NULL,NULL);
/*!40000 ALTER TABLE `embalajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `embalajes_lotes`
--

DROP TABLE IF EXISTS `embalajes_lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `embalajes_lotes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `embalaje_id` int(10) NOT NULL,
  `lote_id` int(10) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_embalajes_has_lotes_lotes1_idx` (`lote_id`),
  KEY `fk_embalajes_has_lotes_embalajes1_idx` (`embalaje_id`),
  CONSTRAINT `fk_embalajes_has_lotes_embalajes1` FOREIGN KEY (`embalaje_id`) REFERENCES `embalajes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_embalajes_has_lotes_lotes1` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `embalajes_lotes`
--

LOCK TABLES `embalajes_lotes` WRITE;
/*!40000 ALTER TABLE `embalajes_lotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `embalajes_lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `cp` varchar(45) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `pais_id` int(11) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `cif` varchar(45) DEFAULT NULL,
  `codigo_contable` varchar(45) DEFAULT NULL,
  `cuenta_bancaria` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `bic` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_empresas_paises1_idx` (`pais_id`),
  KEY `nombre` (`nombre`),
  CONSTRAINT `fk_empresas_paises140` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (3,'BBVA','Paseo Castellana, 108','','Madrid',3,'918652010','','57200005','',NULL,'2015-03-10 11:41:32',NULL),(4,'Santander','Serrano, 21','28012','Madrid',3,NULL,'A-39000013','57200011','','2015-02-13 18:51:30','2015-02-17 15:13:25',NULL),(5,'BBVA','Castellana, 200','28010','Madrid',1,NULL,'B-236497','','','2015-02-14 00:11:00','2015-02-14 00:11:00',NULL),(6,'Santander','Serrano, 14','28012','Madrid',3,NULL,'','','','2015-02-14 00:11:54','2015-02-14 00:11:54',NULL),(7,'Santander','Serrano, 21','28012','Madrid',3,NULL,'','','','2015-02-14 00:16:22','2015-02-14 00:16:22',NULL),(8,'Santander','Serrano, 21','28012','Madrid',3,NULL,'','','','2015-02-14 00:17:25','2015-02-14 00:17:25',NULL),(9,'Santander','Serrano, 21','28012','Madrid',1,NULL,'','','','2015-02-14 00:20:16','2015-02-14 00:20:16',NULL),(10,'Bankia','Pza Castilla, 1','28005','Madrid',3,NULL,'A-39004562','','','2015-02-16 17:44:22','2015-02-16 17:44:22',NULL),(11,'Bankia','Pza Castilla, 1','28005','Madrid',3,NULL,'A-39004562','','','2015-02-16 17:45:40','2015-02-16 17:45:40',NULL),(12,'kkk','Prado','28005','Albacete',3,NULL,'B265311','','','2015-02-16 17:48:46','2015-02-17 15:31:48',NULL),(13,'La Caixa','Diagonal, 231','45007','Barcelona',3,NULL,'A-39666666','','','2015-02-16 17:51:04','2015-02-16 17:51:04',NULL),(14,'La Caixa','','','',3,NULL,'','57200002','','2015-02-17 14:57:48','2015-02-17 14:57:48',NULL),(15,'Sabadell','','','',3,NULL,'','57200003','00815760340001359645','2015-02-17 14:59:17','2015-02-24 11:57:16',NULL),(16,'Deutsche Bank','','','',3,NULL,'','57200006','','2015-02-17 15:05:12','2015-02-17 15:06:25',NULL),(17,'Banco Popular Español','','','',3,NULL,'','57200007','','2015-02-17 15:10:30','2015-02-17 15:10:30',NULL),(18,'Banca March','','28000','',3,'','','57200009','','2015-02-17 15:11:11','2015-05-26 15:26:57',NULL),(19,'Bankinter','','','',3,NULL,'','57200010','0128-9404-03-0100074','2015-02-17 15:12:18','2015-02-17 15:12:18',NULL),(20,'ggg','','','',3,NULL,'','','0182-4572-42-0000074','2015-02-18 23:11:52','2015-02-18 23:11:52',NULL),(21,'hhhh','','','',2,NULL,'','','0182-4572-42-0000074','2015-02-18 23:18:57','2015-02-18 23:18:57',NULL),(22,'Banco Vaticano','','','',1,NULL,'','','20770338793100254321','2015-02-20 17:56:23','2015-02-22 01:01:43',NULL),(23,'Barclay','','','',3,NULL,'','','20770338793100254321','2015-02-21 00:13:00','2015-02-21 00:13:00',NULL),(24,'Barclay','','','',3,NULL,'','','20770338793100254321','2015-02-21 00:13:33','2015-02-21 00:13:33',NULL),(25,'Barclay','','','',3,NULL,'','','20770338793100254321','2015-02-21 00:16:38','2015-02-21 00:16:38',NULL),(26,'Bankinter','','','',3,'','','57200010','','2015-02-24 11:59:17','2015-05-26 15:30:32',NULL),(27,'kk','','','',NULL,NULL,'','','00815760340001359645','2015-02-27 14:10:01','2015-02-27 14:10:01',NULL),(36,'Icona Café SA','','','',3,'','','','','2015-03-10 11:26:57','2015-03-10 11:26:57',NULL),(37,'Louis Dreyfus Commodities España ','','','',3,'','','','','2015-03-10 11:39:25','2015-03-10 11:45:29',NULL),(38,'Coprocafé Ibérica S.A.','','','',3,'','','','','2015-03-10 11:39:46','2015-03-10 11:39:46',NULL),(39,'C.Dorman Limited','','','',8,'','','','','2015-03-10 11:43:30','2015-03-10 11:43:30',NULL),(40,'Louis Dreyfus Commodities Brasil','','','',1,'','','','','2015-03-10 11:45:06','2015-03-10 11:45:06',NULL),(41,'List & Beisler GmbH','','','',9,'','','','','2015-03-10 11:49:34','2015-03-10 11:49:34',NULL),(43,'Olam International Ltd','','','',10,'','','','','2015-03-10 11:54:18','2015-03-10 11:54:18',NULL),(44,'Mercon Coffee Corporation','','','',11,'','','','','2015-03-10 11:57:06','2015-03-10 11:57:06',NULL),(45,'Coffein Compagnie Dr. Erich Scheele GmbH & Co','','','',9,'','','','','2015-03-10 11:59:26','2015-03-10 11:59:26',NULL),(46,'Outspan Brasil Ltda','','','',1,'','','','','2015-03-10 12:01:15','2015-03-10 12:01:15',NULL),(47,'Exportadora Atlantic S.A.','','','',12,'','','','','2015-03-10 12:03:17','2015-03-10 12:03:17',NULL),(48,'InterAmerican Coffee GmbH','','','',9,'','','','','2015-03-10 12:05:28','2015-03-10 12:05:28',NULL),(50,'Almacenes Viorvi SA','','','Barcelona',3,'987654321','','','','2015-03-10 12:51:59','2015-03-10 13:29:35',NULL),(58,'Almacén  BIT','','','Barcelona',3,'','','','','2015-04-08 17:18:29','2015-05-05 16:10:39',NULL),(59,'Molenbergnatie','','','Barcelona',3,'','','','','2015-04-08 17:19:45','2015-05-05 16:11:16',NULL),(60,'Pacorini','','','Gijón',3,'','','','','2015-04-08 17:20:25','2015-05-05 16:11:45',NULL),(61,'Almacén Europa','','','',9,'','','','','2015-04-08 17:20:57','2015-04-08 17:20:57',NULL),(63,'Turulu','','28995632','Paris',5,'','','','','2015-04-24 17:41:30','2015-05-30 12:45:28',NULL),(64,'Coma y Ribas','c/ Obradors, 7','08130','Santa Perpètua de Mogoda',3,'933021414','','','','2015-05-26 14:22:04','2015-05-26 14:22:04',NULL);
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
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
INSERT INTO `incoterms` VALUES (1,'CIF',NULL,NULL),(2,'FOB',NULL,NULL),(3,'IN STORE',NULL,NULL),(4,'FOT ',NULL,NULL),(5,'IN STORE DESPACHADO',NULL,NULL),(6,'FOT DESPACHADO',NULL,NULL);
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
  `marca` varchar(45) DEFAULT NULL,
  `numero_sacos` varchar(45) DEFAULT NULL,
  `referencia_proveedor` varchar(45) DEFAULT NULL,
  `referencia_almacen` varchar(45) DEFAULT NULL,
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
  PRIMARY KEY (`id`,`muestra_id`),
  KEY `fk_linea_muestra_muestras1_idx` (`muestra_id`),
  CONSTRAINT `fk_linea_muestra_muestras1` FOREIGN KEY (`muestra_id`) REFERENCES `muestras` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea_muestras`
--

LOCK TABLES `linea_muestras` WRITE;
/*!40000 ALTER TABLE `linea_muestras` DISABLE KEYS */;
INSERT INTO `linea_muestras` VALUES (1,1,'Hacienda Sao Tomé','240','5576/15','4365432/CM12','85%','suave','ninguno',10.0,20.0,05.0,05.0,15.0,05.0,05.0,05.0,05.0,05.0,05.0,05.0,NULL,NULL,NULL,'Sabor a café','2015-03-19 00:19:01','2015-03-19 00:19:01'),(3,1,'002/1848/1111111','20 Big bags','345','00030000/934','12,3%','ffffffffffff','black and broken beans: 4,5%',NULL,NULL,04.0,25.0,02.0,26.0,03.0,30.0,NULL,10.0,NULL,NULL,NULL,NULL,NULL,'Acidez media alta\r\ncuerpo medio bajo\r\nleve suavidad todas las tazas\r\n1 Taza fermentada\r\n1 Taza sucia\r\n1 Taza fenol\r\n','2015-03-24 15:17:53','2015-03-24 15:17:53'),(4,1,'Príncipe Azul','50','14/37/654','12/09','85%','suave','Una taza riada\r\nManchas de aceite\r\nPar de granos azules',10.0,10.5,09.5,11.0,09.0,20.0,08.5,01.5,02.8,07.2,NULL,10.0,NULL,NULL,NULL,'','2015-03-26 01:03:59','2015-05-29 16:24:05'),(5,1,'test','','','','mucha','','',10.0,10.5,09.5,11.0,09.0,20.0,08.5,01.5,02.8,07.2,00.0,10.0,NULL,NULL,NULL,'','2015-03-26 01:11:04','2015-05-26 12:46:05'),(8,6,'010/0076/0003','2500','13-99402/00','CA/254','11,3','FINO FINO','6 SEGUN TABLA DE NUEVA YORK EN 300 GRS\r\nFOREIGN MATTERS:0,1%',NULL,NULL,NULL,17.3,02.5,30.1,02.8,20.5,NULL,17.0,NULL,09.8,NULL,NULL,NULL,'ACIDEZ MEDIA ALTA\r\nCUERPOMEDIO ALTO\r\nMUY SUAVE Y LIMPIO\r\nSABOR AFRUTADO UNIFORME','2015-03-27 13:48:25','2015-05-26 13:39:41'),(12,10,'010/0076/0003','250','LB 3456','C/C 15/2345','11,7','FINO','12 DEFECTOS SEGUN TABLA DE NUEVA YORK EN 300 GRS',NULL,NULL,NULL,NULL,NULL,35.7,12.7,20.1,06.7,20.8,01.3,02.7,NULL,NULL,NULL,'ACIDEZ MEDIA ALTA\r\nCUERPO MEDIO ALTO\r\nMUY SUAVES TODAS LAS TAZAS\r\nLEVE SABOR A FRUTADO UNIFORME\r\n1 TAZA SABOR  CITRICO\r\n1 TAZA SABOR A VERDE','2015-04-07 13:46:02','2015-04-07 13:54:22'),(13,10,'010/0076/0004','500','LB 3457','C/C 15/2346','11,7','FINO','3 DEFECTOS SEGUN TABLA DE NUEVA YORK',NULL,NULL,NULL,NULL,15.0,35.5,10.0,35.5,NULL,03.0,NULL,01.0,NULL,NULL,NULL,'ACIDEZ MEDIA ALTA\r\nCUERPO MEDIO ALTO\r\nSUAVES Y LIMPIAS TODAS\r\nLAS TAZAS\r\nAFRUTADO\r\nPERFUMADO','2015-04-07 15:30:00','2015-04-07 15:30:00'),(14,10,'010/0076/0005','750','LB 3458','C/C 15/2347','11,8','FINO','6 DEFECTOS SEGUN TABLADE NUEVA YORK\r\nFOREIGN MATTERS:0,2%\r\nSIN DEFECTOS CAPITALES',NULL,NULL,NULL,NULL,NULL,40.3,01.1,40.2,02.2,10.0,NULL,06.2,NULL,NULL,NULL,'ACIDEZ MEDIA ALTA\r\nCUERPO ALTO\r\nMUY SUAVE,PERFUMADO\r\nSABOR AFRUTADO\r\n\r\n','2015-04-07 15:34:15','2015-04-07 16:28:30'),(15,10,'010/0076/0006','750','LB 3459','C/C 15/2348','11,3','FINO','3 SEGUN TABLE DE N.Y. EN 300 GRS\r\nFOREIGN MATTERS:3%\r\nPIEDRAS:2,0%\r\nGREEN BEANS:8%\r\n',NULL,NULL,NULL,NULL,NULL,35.5,11.0,35.5,11.0,07.0,NULL,NULL,NULL,NULL,NULL,'ACIDEZ MEDIA ALTA\r\nCUERPO MEDIO\r\nSUAVES TODAS LAS TAZS\r\nAFRUTADO\r\n1 TAZA SABOR VERDE\r\n1 TAZA SUCIA\r\n1 TAZA FRUITY','2015-04-07 16:38:42','2015-04-07 16:38:42');
/*!40000 ALTER TABLE `linea_muestras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contrato_id` int(11) NOT NULL,
  `fecha_pos_fijacion` date DEFAULT NULL,
  `precio_fijacion` decimal(5,2) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_lotes_contratos1_idx` (`contrato_id`),
  CONSTRAINT `fk_lotes_contratos1` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
INSERT INTO `lotes` VALUES (1,2,'2015-06-09',3.00,NULL,NULL);
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `muestras`
--

DROP TABLE IF EXISTS `muestras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `muestras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `referencia` varchar(45) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `aprobado` tinyint(1) unsigned zerofill DEFAULT NULL,
  `incidencia` text,
  `calidad_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `tipo` int(1) unsigned NOT NULL,
  `operacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_muestras_calidades1_idx` (`calidad_id`),
  KEY `fk_muestras_proveedores1_idx` (`proveedor_id`),
  KEY `fk_muestras_almacenes1_idx` (`almacen_id`),
  KEY `referencia` (`referencia`),
  KEY `fk_muestras_operaciones1_idx` (`operacion_id`),
  CONSTRAINT `fk_muestras_operaciones1` FOREIGN KEY (`operacion_id`) REFERENCES `operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_almacenes1` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_calidades1` FOREIGN KEY (`calidad_id`) REFERENCES `calidades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_muestras_proveedores1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muestras`
--

LOCK TABLES `muestras` WRITE;
/*!40000 ALTER TABLE `muestras` DISABLE KEYS */;
INSERT INTO `muestras` VALUES (1,'104/17','2015-03-13 18:37:00',1,'',5,38,50,'2015-03-14 01:23:07','2015-03-14 01:23:07',1,0),(4,'15/027','2015-03-26 00:00:00',1,'El café ha llegado a puerto',9,39,50,'2015-03-26 12:48:01','2015-03-26 12:48:01',1,0),(6,'15/031','2015-03-27 00:00:00',0,'Muestra de embarque llegada antes del embarque',24,40,50,'2015-03-27 13:43:17','2015-04-14 00:42:02',1,0),(10,'15/003','2014-04-07 00:00:00',1,'MUESTRA APROBADA RECIBIDA DESDE ALMACEN EN ALMENIA\r\nEL CAFE LLEGARA AL ALACEN DEL SOCIO\r\nCAFE MU BUENO + INTRO\r\nCAFE MEJOR\r\n',24,41,50,'2015-04-07 13:40:59','2015-04-27 01:01:06',1,0),(14,'007/007','2015-04-26 00:00:00',0,'',10,43,60,'2015-04-26 19:04:48','2015-04-26 19:04:48',1,0),(15,'008/008','2015-04-26 00:00:00',0,'',6,48,61,'2015-04-26 19:39:44','2015-04-26 19:39:44',1,0),(16,'123/456','2015-04-26 00:00:00',0,'',25,46,61,'2015-04-26 23:43:14','2015-04-26 23:46:00',1,0),(17,'000/111','2015-05-08 00:00:00',1,'',9,36,59,'2015-05-08 16:48:02','2015-05-08 16:48:02',2,0),(18,'001/001/001','2015-05-08 00:00:00',1,'',6,47,58,'2015-05-08 17:24:47','2015-05-08 17:24:47',3,0),(19,'69/69','2014-05-08 00:00:00',1,'',5,41,58,'2015-05-08 17:25:34','2015-05-08 17:25:34',2,0);
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
  CONSTRAINT `fk_navieras_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navieras`
--

LOCK TABLES `navieras` WRITE;
/*!40000 ALTER TABLE `navieras` DISABLE KEYS */;
INSERT INTO `navieras` VALUES (63,'2015-04-24 17:41:31','2015-05-30 12:45:28'),(64,'2015-05-30 12:25:22','2015-05-30 12:25:22');
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
  `referencia` varchar(15) DEFAULT NULL,
  `cantidad` decimal(10,0) DEFAULT NULL,
  `packing` varchar(45) DEFAULT NULL,
  `si_fob` tinyint(1) DEFAULT NULL,
  `flete` decimal(10,0) DEFAULT NULL,
  `seguro` decimal(10,0) DEFAULT NULL,
  `cambio_dolar_euro` decimal(10,0) DEFAULT NULL,
  `forfait` decimal(10,0) DEFAULT NULL,
  `fecha_embarque` datetime DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `naviera_id` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `agente_id` int(11) NOT NULL,
  `almacen_id` int(11) NOT NULL,
  `fecha_seguro` datetime DEFAULT NULL,
  `puerto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`contrato_id`),
  UNIQUE KEY `referencia_UNIQUE` (`referencia`),
  KEY `fk_operaciones_navieras1_idx` (`naviera_id`),
  KEY `fk_operaciones_agentes1_idx` (`agente_id`),
  KEY `fk_operaciones_almacenes1_idx` (`almacen_id`),
  KEY `fk_operaciones_contratos1_idx` (`contrato_id`),
  KEY `fk_operaciones_puertos1_idx` (`puerto_id`),
  CONSTRAINT `fk_operaciones_agentes1` FOREIGN KEY (`agente_id`) REFERENCES `agentes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operaciones_almacenes1` FOREIGN KEY (`almacen_id`) REFERENCES `almacenes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operaciones_contratos1` FOREIGN KEY (`contrato_id`) REFERENCES `contratos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operaciones_navieras1` FOREIGN KEY (`naviera_id`) REFERENCES `navieras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_operaciones_puertos1` FOREIGN KEY (`puerto_id`) REFERENCES `puertos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operaciones`
--

LOCK TABLES `operaciones` WRITE;
/*!40000 ALTER TABLE `operaciones` DISABLE KEYS */;
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
  `prefijo_tfno` varchar(10) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index2` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'Brasil','br','55','2015-02-06 22:47:29','2015-03-10 12:10:41'),(2,'Colombia','co','','2015-02-06 22:47:41','2015-02-06 22:47:41'),(3,'España','es','34','2015-02-07 01:05:18','2015-02-24 23:58:34'),(4,'Tanzania','tz','','2015-02-07 01:05:31','2015-02-07 01:05:31'),(5,'Francia','fr','33','2015-02-10 14:24:25','2015-02-24 23:58:23'),(6,'Bélgica','be','32','2015-03-10 11:15:17','2015-03-10 12:09:41'),(7,'Perú','pe','','2015-03-10 11:30:38','2015-03-10 11:30:38'),(8,'Kenia','ke','','2015-03-10 11:42:13','2015-03-10 11:42:13'),(9,'Alemania','de','49','2015-03-10 11:48:52','2015-03-10 12:10:18'),(10,'Suiza','ch','','2015-03-10 11:53:43','2015-03-10 11:53:43'),(11,'Estados Unidos','us','','2015-03-10 11:56:32','2015-03-10 11:56:32'),(12,'Nicaragua','ni','','2015-03-10 12:02:39','2015-03-10 12:02:39'),(14,'Vietnam','vn','','2015-03-16 16:31:16','2015-03-16 16:31:16'),(19,'Indonesia','','','2015-03-16 22:56:37','2015-03-16 22:56:37'),(20,'Etiopia','','','2015-03-16 23:06:40','2015-03-16 23:06:40'),(21,'Italia','it','','2015-03-23 22:58:05','2015-03-23 22:58:05'),(22,'Rusia','','','2015-03-24 12:57:30','2015-03-24 12:57:30');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

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
  CONSTRAINT `fk_proveedores_empresas1` FOREIGN KEY (`id`) REFERENCES `empresas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (36,'2015-03-10 11:26:58','2015-03-10 11:26:58'),(37,'2015-03-10 11:39:25','2015-03-10 11:45:29'),(38,'2015-03-10 11:39:47','2015-03-10 11:39:47'),(39,'2015-03-10 11:43:30','2015-03-10 11:43:30'),(40,'2015-03-10 11:45:07','2015-03-10 11:45:07'),(41,'2015-03-10 11:49:34','2015-03-10 11:49:34'),(43,'2015-03-10 11:54:19','2015-03-10 11:54:19'),(44,'2015-03-10 11:57:06','2015-03-10 11:57:06'),(45,'2015-03-10 11:59:27','2015-03-10 11:59:27'),(46,'2015-03-10 12:01:15','2015-03-10 12:01:15'),(47,'2015-03-10 12:03:18','2015-03-10 12:03:18'),(48,'2015-03-10 12:05:28','2015-03-10 12:05:28');
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
  KEY `fk_puertos_paises1_idx` (`pais_id`),
  CONSTRAINT `fk_puertos_paises1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puertos`
--

LOCK TABLES `puertos` WRITE;
/*!40000 ALTER TABLE `puertos` DISABLE KEYS */;
/*!40000 ALTER TABLE `puertos` ENABLE KEYS */;
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
  `aseguradora_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_seguros_aseguradoras1_idx` (`aseguradora_id`),
  CONSTRAINT `fk_seguros_aseguradoras1` FOREIGN KEY (`aseguradora_id`) REFERENCES `aseguradoras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguros`
--

LOCK TABLES `seguros` WRITE;
/*!40000 ALTER TABLE `seguros` DISABLE KEYS */;
/*!40000 ALTER TABLE `seguros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transportes`
--

DROP TABLE IF EXISTS `transportes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transportes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seguro_id` int(11) NOT NULL,
  `fecha_carga` datetime DEFAULT NULL,
  `fecha_llegada` datetime DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `fecha_enviodoc` datetime DEFAULT NULL,
  `fecha_entradamerc` datetime DEFAULT NULL,
  `fecha_despacho_op` datetime DEFAULT NULL,
  `fecha_vencimiento_seg` datetime DEFAULT NULL,
  `fecha_reclamacion` datetime DEFAULT NULL,
  `fecha_limite_retirada` datetime DEFAULT NULL,
  `fecha_reclamacion_factura` datetime DEFAULT NULL,
  `barco` varchar(45) DEFAULT NULL,
  `billingoflanding` varchar(45) DEFAULT NULL,
  `observaciones` text,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `operacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transportes_seguros1_idx` (`seguro_id`),
  KEY `fk_transportes_operaciones1_idx` (`operacion_id`),
  CONSTRAINT `fk_transportes_operaciones1` FOREIGN KEY (`operacion_id`) REFERENCES `operaciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transportes_seguros1` FOREIGN KEY (`seguro_id`) REFERENCES `seguros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transportes`
--

LOCK TABLES `transportes` WRITE;
/*!40000 ALTER TABLE `transportes` DISABLE KEYS */;
/*!40000 ALTER TABLE `transportes` ENABLE KEYS */;
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
/*!50013 DEFINER=`cmpsa`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `calidad_nombres` AS select `calidades`.`id` AS `id`,concat(replace(replace(`calidades`.`descafeinado`,0,''),1,'Descafeinado '),`paises`.`nombre`,' ',`calidades`.`descripcion`) AS `nombre` from (`calidades` join `paises`) where (`calidades`.`pais_id` = `paises`.`id`) */;
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-06-09 15:10:26
