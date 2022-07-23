-- MariaDB dump 10.19  Distrib 10.4.21-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: proyecto_cobranza
-- ------------------------------------------------------
-- Server version	10.4.21-MariaDB

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
-- Table structure for table `adonis_schema`
--

DROP TABLE IF EXISTS `adonis_schema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adonis_schema` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  `migration_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adonis_schema`
--

LOCK TABLES `adonis_schema` WRITE;
/*!40000 ALTER TABLE `adonis_schema` DISABLE KEYS */;
INSERT INTO `adonis_schema` VALUES (1,'database/migrations/1655567718077_avales',1,'2022-06-20 20:33:18'),(2,'database/migrations/1655567718077_clientes',2,'2022-06-20 20:35:54'),(3,'database/migrations/1655567718077_comprobantes',3,'2022-06-20 20:40:32'),(4,'database/migrations/1655567718077_garantias',4,'2022-06-20 20:42:02');
/*!40000 ALTER TABLE `adonis_schema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adonis_schema_versions`
--

DROP TABLE IF EXISTS `adonis_schema_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adonis_schema_versions` (
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adonis_schema_versions`
--

LOCK TABLES `adonis_schema_versions` WRITE;
/*!40000 ALTER TABLE `adonis_schema_versions` DISABLE KEYS */;
INSERT INTO `adonis_schema_versions` VALUES (2);
/*!40000 ALTER TABLE `adonis_schema_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avales`
--

DROP TABLE IF EXISTS `avales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `garantias` varchar(999) DEFAULT NULL,
  `carpeta_comprobantes` varchar(250) DEFAULT NULL,
  `carpeta_garantias` varchar(250) DEFAULT NULL,
  `otras_referencias` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avales`
--

LOCK TABLES `avales` WRITE;
/*!40000 ALTER TABLE `avales` DISABLE KEYS */;
INSERT INTO `avales` VALUES (1,'Alondra Juarez','calle #2222','8711223529','television','1_Alondra Juarez','1_Alondra Juarez','casada','2022-07-20 22:05:30','2022-07-20 22:05:30'),(2,'Alberto Escobedo','calle #1292','8711223529','refrigerador','2_Alberto Escobedo','2_Alberto Escobedo','casado','2022-07-20 22:13:35','2022-07-20 22:13:35'),(3,'Vianey Lopez','calle #1292','8711223529','ss','3_Vianey Lopez','3_Vianey Lopez','cc','2022-07-20 22:15:31','2022-07-20 22:15:31'),(4,'Alondra Juarez','calle #1292','8711223529','celular','4_Alondra Juarez','4_Alondra Juarez','casada','2022-07-21 14:24:58','2022-07-21 14:24:58'),(5,'Vianey Lopez','calle #1292','8711223529','celular','5_Vianey Lopez','5_Vianey Lopez','Casada','2022-07-21 14:52:00','2022-07-21 14:52:00'),(6,'Alondra Juarez','calle #1292','8711223529','celular','6_Alondra Juarez','6_Alondra Juarez','casada','2022-07-21 15:03:46','2022-07-21 15:03:46'),(7,'Alondra Juarez','calle #4442','8711223529','cel\r\npantalla \r\ncel','7_Alondra Juarez','7_Alondra Juarez','vive fte a la iglesia ','2022-07-21 15:57:34','2022-07-21 15:57:34'),(8,'Hugo Dueñez','calle #1292','8711223529','celular','8_Hugo Dueñez','8_Hugo Dueñez','casado','2022-07-21 17:07:53','2022-07-21 17:07:53'),(9,'Alondra Juarez','asads','8711223529','as','9_Alondra Juarez','9_Alondra Juarez','sas','2022-07-21 17:19:19','2022-07-21 17:19:19'),(10,'dd','sdds','123','sd','10_dd','10_dd','sdsx','2022-07-21 17:21:09','2022-07-21 17:21:09'),(11,'Alondra Juarez','calle #1292','8711223529','celular','11_Alondra Juarez','11_Alondra Juarez','Casada','2022-07-21 17:30:38','2022-07-21 17:30:38'),(12,'sas','sas','8711223529','asa','12_sas','12_sas','asas','2022-07-21 17:36:34','2022-07-21 17:36:34'),(13,'Alberto Escobedo','calle #2222','8711223529','asas','13_Alberto Escobedo','13_Alberto Escobedo','asas','2022-07-21 17:52:45','2022-07-21 17:52:45'),(14,'asd','sas','8711223529','asa','14_asd','14_asd','saas','2022-07-21 17:54:33','2022-07-21 17:54:33'),(15,'asa','sasas','1','sas','15_asa','15_asa','sasa','2022-07-21 17:56:36','2022-07-21 17:56:36'),(16,'ssa','asas','8711223529','asa','16_ssa','16_ssa','asas','2022-07-21 17:57:59','2022-07-21 17:57:59'),(17,'Alondra Juarez','calle #2222','8711223529','sas','17_Alondra Juarez','17_Alondra Juarez','asa','2022-07-21 18:00:39','2022-07-21 18:00:39'),(18,'Alberto Escobedo','calle #1292','123','asas','18_Alberto Escobedo','18_Alberto Escobedo','asa','2022-07-21 18:07:58','2022-07-21 18:07:58'),(19,'asas','asa','2','sasa','19_asas','19_asas','asa','2022-07-21 18:26:20','2022-07-21 18:26:20'),(20,'Alberto Escobedos','sasa','8711223529','asas','20_Alberto Escobedos','20_Alberto Escobedos','saas','2022-07-21 18:44:48','2022-07-21 18:44:48'),(21,'sds','as','8711223529','sas','21_sds','21_sds','asa','2022-07-21 20:31:58','2022-07-21 20:31:58'),(22,'ss','asa','8711223529','asa','22_ss','22_ss','as','2022-07-21 20:36:47','2022-07-21 20:36:47'),(23,'Alondra Juarez','calle #1292','8711223529','csc','23_Alondra Juarez','23_Alondra Juarez','cscs','2022-07-21 20:44:51','2022-07-21 20:44:51'),(24,'asa','asa','8711223529','as','24_asa','24_asa','asa','2022-07-21 21:26:01','2022-07-21 21:26:01'),(25,'dsd','dsdd','3','sds','25_dsd','25_dsd','sds','2022-07-23 16:14:20','2022-07-23 16:14:20');
/*!40000 ALTER TABLE `avales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `garantias` varchar(999) DEFAULT NULL,
  `carpeta_comprobantes` varchar(250) DEFAULT NULL,
  `carpeta_garantias` varchar(250) DEFAULT NULL,
  `otras_referencias` longtext DEFAULT NULL,
  `ruta_id` int(10) DEFAULT NULL,
  `poblacion_id` int(10) DEFAULT NULL,
  `colocadora_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Diego Dueñez','calle #111','8711223529','celular','1_Diego Dueñez','1_Diego Dueñez','casado',1,2,17,'2022-07-20 22:05:30','2022-07-20 22:05:30'),(2,'Eduardo Corona','calle #191001','8711223529','celular','2_Eduardo Corona','2_Eduardo Corona','casado',1,2,17,'2022-07-21 14:52:00','2022-07-21 14:52:00'),(3,'Kevin Perez','calle #9191','8711223529','cel \r\npantalla\r\ntanque de gas','3_Kevin Perez','3_Kevin Perez','vive fte al campo',1,1,1,'2022-07-21 15:57:34','2022-07-21 15:57:34');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `colocadoras`
--

DROP TABLE IF EXISTS `colocadoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colocadoras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `ruta_id` int(10) unsigned DEFAULT NULL,
  `poblacion_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `colocadoras_ruta_id_foreign` (`ruta_id`),
  KEY `colocadoras_poblacion_id_foreign` (`poblacion_id`),
  CONSTRAINT `colocadoras_poblacion_id_foreign` FOREIGN KEY (`poblacion_id`) REFERENCES `poblaciones` (`id`),
  CONSTRAINT `colocadoras_ruta_id_foreign` FOREIGN KEY (`ruta_id`) REFERENCES `rutas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colocadoras`
--

LOCK TABLES `colocadoras` WRITE;
/*!40000 ALTER TABLE `colocadoras` DISABLE KEYS */;
INSERT INTO `colocadoras` VALUES (1,'Juanita Perez','Calle #555','8711223529',1,1,1,'2022-06-18 17:06:42','2022-06-18 17:06:42'),(17,'Maria Ramirez','calle #9919','8711223529',1,1,2,'2022-07-07 18:53:19','2022-07-07 18:53:19');
/*!40000 ALTER TABLE `colocadoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_abonos`
--

DROP TABLE IF EXISTS `configuracion_abonos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_abonos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `tipo_cantidad` varchar(50) NOT NULL,
  `de` varchar(500) DEFAULT NULL,
  `por_cada` varchar(500) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_abonos`
--

LOCK TABLES `configuracion_abonos` WRITE;
/*!40000 ALTER TABLE `configuracion_abonos` DISABLE KEYS */;
INSERT INTO `configuracion_abonos` VALUES (6,10,'%','Monto prestado',NULL,'10% De Monto prestado',1),(7,80,'$',NULL,'1000','$80 Por cada $1000',1);
/*!40000 ALTER TABLE `configuracion_abonos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_multa`
--

DROP TABLE IF EXISTS `configuracion_multa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_multa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` double(10,2) NOT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_multa`
--

LOCK TABLES `configuracion_multa` WRITE;
/*!40000 ALTER TABLE `configuracion_multa` DISABLE KEYS */;
INSERT INTO `configuracion_multa` VALUES (1,200.00,1);
/*!40000 ALTER TABLE `configuracion_multa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_semanas`
--

DROP TABLE IF EXISTS `configuracion_semanas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_semanas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cantidad` int(11) NOT NULL,
  `interes` int(11) NOT NULL,
  `tipo_abono` int(11) NOT NULL,
  `semana_renovacion` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_semanas`
--

LOCK TABLES `configuracion_semanas` WRITE;
/*!40000 ALTER TABLE `configuracion_semanas` DISABLE KEYS */;
INSERT INTO `configuracion_semanas` VALUES (1,15,40,6,10,1),(2,20,55,7,15,1);
/*!40000 ALTER TABLE `configuracion_semanas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleados`
--

DROP TABLE IF EXISTS `empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `perfil_id` int(10) unsigned DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `empleados_perfil_id_foreign` (`perfil_id`),
  CONSTRAINT `empleados_perfil_id_foreign` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Arturo Herrera','aherrera','$2y$10$Eww7hiKr3fqLKgg9TICCkuo4obUzUsB1eafX7he1RzxOl8FZxUAZq',2,1,'2022-06-15 18:36:50','2022-06-15 18:36:50'),(17,'Javier Ramirez','jramirez','$2y$10$IDt8RU9/l7jCStvKeyVZZ.PVP/fDIq7mrih6AGLWJFxF54CqdgOuq',2,1,'2022-07-20 21:43:54','2022-07-20 21:43:54'),(18,'Eduardo Villa','evilla','$2y$10$1oN6ewttmgFL6TekmNIcDOK0722ji2S0J.NecoVoQwJj9taygGmLi',2,1,'2022-07-20 21:45:54','2022-07-20 21:45:54');
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garantias`
--

DROP TABLE IF EXISTS `garantias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `garantias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_garantia` varchar(255) DEFAULT NULL,
  `url_imagen` varchar(255) DEFAULT NULL,
  `cliente_id` int(10) unsigned DEFAULT NULL,
  `aval_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `garantias_cliente_id_foreign` (`cliente_id`),
  KEY `garantias_aval_id_foreign` (`aval_id`),
  CONSTRAINT `garantias_aval_id_foreign` FOREIGN KEY (`aval_id`) REFERENCES `avales` (`id`),
  CONSTRAINT `garantias_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garantias`
--

LOCK TABLES `garantias` WRITE;
/*!40000 ALTER TABLE `garantias` DISABLE KEYS */;
INSERT INTO `garantias` VALUES (1,'Celular','resources/garantias/938377.png',1,NULL,'2022-06-20 20:48:58','2022-06-20 20:48:58'),(2,'Bocina','resources/garantias/92736.png',NULL,1,'2022-06-20 20:48:58','2022-06-20 20:48:58'),(3,'Refrigerador','resources/garantias/9fdfd.png',5,NULL,'2022-06-22 18:36:53','2022-06-22 18:36:53'),(4,'Mueble','resources/garantias/45gf.png',NULL,2,'2022-06-22 18:37:08','2022-06-22 18:37:08');
/*!40000 ALTER TABLE `garantias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_modulo` varchar(250) NOT NULL,
  `status` int(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prestamo_id` int(11) DEFAULT NULL,
  `cantidad_esperada_pago` decimal(10,2) DEFAULT NULL,
  `cantidad_normal_pagada` decimal(10,2) DEFAULT NULL,
  `cantidad_multa` decimal(10,2) DEFAULT NULL,
  `cantidad_pendiente` decimal(10,2) DEFAULT 0.00,
  `cantidad_total_pagada` decimal(10,2) DEFAULT NULL,
  `concepto` varchar(500) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_pago_realizada` date DEFAULT NULL,
  `folio` int(11) DEFAULT NULL,
  `semana` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-07-30',NULL,NULL,1,0,1,'2022-07-23 11:15:10'),(2,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-08-06',NULL,NULL,2,0,1,'2022-07-23 11:15:10'),(3,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-08-13',NULL,NULL,3,0,1,'2022-07-23 11:15:10'),(4,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-08-20',NULL,NULL,4,0,1,'2022-07-23 11:15:10'),(5,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-08-27',NULL,NULL,5,0,1,'2022-07-23 11:15:10'),(6,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-09-03',NULL,NULL,6,0,1,'2022-07-23 11:15:10'),(7,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-09-10',NULL,NULL,7,0,1,'2022-07-23 11:15:10'),(8,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-09-17',NULL,NULL,8,0,1,'2022-07-23 11:15:10'),(9,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-09-24',NULL,NULL,9,0,1,'2022-07-23 11:15:10'),(10,1,500.00,500.00,0.00,0.00,500.00,'pago 500','2022-10-01','2022-07-23',9898989,10,7000,1,'2022-07-23 11:15:00'),(11,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-10-08',NULL,NULL,11,0,1,'2022-07-23 11:15:10'),(12,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-10-15',NULL,NULL,12,0,1,'2022-07-23 11:15:10'),(13,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-10-22',NULL,NULL,13,0,1,'2022-07-23 11:15:10'),(14,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-10-29',NULL,NULL,14,0,1,'2022-07-23 11:15:10'),(15,1,500.00,500.00,0.00,0.00,500.00,NULL,'2022-11-05',NULL,NULL,15,0,1,'2022-07-23 11:15:10'),(16,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-07-30',NULL,NULL,1,12000,0,'2022-07-23 11:15:10'),(17,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-06',NULL,NULL,2,12000,0,'2022-07-23 11:15:10'),(18,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-13',NULL,NULL,3,12000,0,'2022-07-23 11:15:10'),(19,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-20',NULL,NULL,4,12000,0,'2022-07-23 11:15:10'),(20,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-27',NULL,NULL,5,12000,0,'2022-07-23 11:15:10'),(21,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-03',NULL,NULL,6,12000,0,'2022-07-23 11:15:10'),(22,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-10',NULL,NULL,7,12000,0,'2022-07-23 11:15:10'),(23,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-17',NULL,NULL,8,12000,0,'2022-07-23 11:15:10'),(24,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-24',NULL,NULL,9,12000,0,'2022-07-23 11:15:10'),(25,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-01',NULL,NULL,10,12000,0,'2022-07-23 11:15:10'),(26,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-08',NULL,NULL,11,12000,0,'2022-07-23 11:15:10'),(27,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-15',NULL,NULL,12,12000,0,'2022-07-23 11:15:10'),(28,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-22',NULL,NULL,13,12000,0,'2022-07-23 11:15:10'),(29,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-29',NULL,NULL,14,12000,0,'2022-07-23 11:15:10'),(30,2,800.00,0.00,0.00,0.00,0.00,NULL,'2022-11-05',NULL,NULL,15,12000,0,'2022-07-23 11:15:10');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(255) DEFAULT NULL,
  `tipo_perfil` varchar(45) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'administrador','usuario','2022-06-15 15:09:13','2022-06-15 15:09:13'),(2,'cobrador','empleado','2022-06-15 19:23:50','2022-06-15 19:23:50'),(3,'secretario','usuario','2022-06-30 16:45:54','2022-06-30 16:45:54'),(4,'otro','usuario','2022-07-06 19:36:18','2022-07-06 19:36:18');
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles_modulos`
--

DROP TABLE IF EXISTS `perfiles_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfiles_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `perfil_id` int(11) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles_modulos`
--

LOCK TABLES `perfiles_modulos` WRITE;
/*!40000 ALTER TABLE `perfiles_modulos` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfiles_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poblaciones`
--

DROP TABLE IF EXISTS `poblaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poblaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_poblacion` varchar(255) DEFAULT NULL,
  `primer_hora_limite` time NOT NULL,
  `segunda_hora_limite` time NOT NULL,
  `primer_dia_cobro` varchar(45) DEFAULT NULL,
  `monto_multa` decimal(10,2) NOT NULL,
  `grupo` int(11) DEFAULT 1,
  `ruta_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poblaciones`
--

LOCK TABLES `poblaciones` WRITE;
/*!40000 ALTER TABLE `poblaciones` DISABLE KEYS */;
INSERT INTO `poblaciones` VALUES (1,'Poblacion1','14:00:00','18:59:59','Lunes',50.00,1,1,'2022-07-06 17:27:54','2022-07-06 17:27:54'),(2,'Poblacion2','10:00:00','14:30:00','Lunes',50.00,1,1,'2022-07-07 17:32:20','2022-07-07 17:32:20'),(3,'Hormiguero','15:00:00','18:59:59','Martes',50.00,1,2,'2022-07-07 20:27:54','2022-07-07 20:27:54');
/*!40000 ALTER TABLE `poblaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `direccion_cliente` varchar(255) DEFAULT NULL,
  `telefono_cliente` varchar(255) DEFAULT NULL,
  `ruta_id` int(10) DEFAULT NULL,
  `poblacion_id` int(10) DEFAULT NULL,
  `colocadora_id` int(10) DEFAULT NULL,
  `aval_id` int(10) DEFAULT NULL,
  `monto_prestado` double(10,2) NOT NULL,
  `monto_prestado_intereses` double(10,2) DEFAULT 0.00,
  `pago_semanal` double(10,2) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `modalidad_semanas` int(10) DEFAULT 15,
  `numero_tarjeton` int(11) DEFAULT 0,
  `status` int(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamos`
--

LOCK TABLES `prestamos` WRITE;
/*!40000 ALTER TABLE `prestamos` DISABLE KEYS */;
INSERT INTO `prestamos` VALUES (1,1,'calle #111','8711223529',1,2,17,25,5000.00,0.00,500.00,'2022-07-23',1,12345,2,'2022-07-23 16:14:20','2022-07-23 11:15:10'),(2,1,'calle #111','8711223529',1,2,17,25,8000.00,0.00,800.00,'2022-07-23',1,4567876,0,'2022-07-23 16:15:09','2022-07-23 11:15:09');
/*!40000 ALTER TABLE `prestamos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutas`
--

DROP TABLE IF EXISTS `rutas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_ruta` varchar(255) DEFAULT NULL,
  `empleado_id` int(10) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas`
--

LOCK TABLES `rutas` WRITE;
/*!40000 ALTER TABLE `rutas` DISABLE KEYS */;
INSERT INTO `rutas` VALUES (1,'R1',1,1,'2022-07-06 17:27:03','2022-07-06 17:27:03');
/*!40000 ALTER TABLE `rutas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rutas_empleados`
--

DROP TABLE IF EXISTS `rutas_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rutas_empleados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta_id` int(11) DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas_empleados`
--

LOCK TABLES `rutas_empleados` WRITE;
/*!40000 ALTER TABLE `rutas_empleados` DISABLE KEYS */;
INSERT INTO `rutas_empleados` VALUES (12,1,1),(13,1,17);
/*!40000 ALTER TABLE `rutas_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) DEFAULT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `perfil_id` int(10) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Diego Dueñez','diego03',1,'$2y$10$SuXZ7k7.FZZtXc56XhxoHuzgjMMrj3HW3Nj0un6JojK5iq6tswxXW',1,'2022-06-13 16:56:23','2022-06-13 16:56:23');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-23 13:58:22
