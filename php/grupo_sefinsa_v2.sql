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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avales`
--

LOCK TABLES `avales` WRITE;
/*!40000 ALTER TABLE `avales` DISABLE KEYS */;
INSERT INTO `avales` VALUES (1,'Hugo Dueñez','calle #1292','8711223529','celular','1_Hugo Dueñez','1_Hugo Dueñez','sd','2022-07-27 15:27:50','2022-07-27 15:27:50'),(2,'Alondra Juarez','calle #1292','8711223529','celular','2_Alondra Juarez','2_Alondra Juarez','casada','2022-07-27 16:34:18','2022-07-27 16:34:18'),(3,'Vianey Lopez','calle #1292','8711223529','television','3_Vianey Lopez','3_Vianey Lopez','casada','2022-07-28 14:44:23','2022-07-28 14:44:23'),(4,'Kelly Vazquez','calle #1292','8711223529','celular','4_Kelly Vazquez','4_Kelly Vazquez','casada','2022-07-28 17:13:37','2022-07-28 17:13:37'),(5,'Vianey Lopez','calle #1292','8711223529','television','5_Vianey Lopez','5_Vianey Lopez','soltero','2022-07-28 21:06:47','2022-07-28 21:06:47'),(6,'Saul Salas','calle #1292','8711223529','television','6_Saul Salas','6_Saul Salas','soltero','2022-07-28 21:07:45','2022-07-28 21:07:45'),(7,'Alondra Juarez','calle #1292','8711223529','television','7_Alondra Juarez','7_Alondra Juarez','casada','2022-07-28 21:09:33','2022-07-28 21:09:33'),(8,'Alondra Juarez','calle #1292','23','television','8_Alondra Juarez','8_Alondra Juarez','casada','2022-07-28 21:11:14','2022-07-28 21:11:14'),(9,'Saul Salas','calle #1292','8711223529','television','9_Saul Salas','9_Saul Salas','soltero','2022-07-28 21:12:06','2022-07-28 21:12:06'),(10,'Maria Gomez','calle #1292','8711223529','celular','10_Maria Gomez','10_Maria Gomez','casada','2022-07-28 23:05:16','2022-07-28 23:05:16'),(11,'Hugo Dueñez','calle #1292','8711223529','television','11_Hugo Dueñez','11_Hugo Dueñez','casado','2022-07-29 20:40:25','2022-07-29 20:40:25'),(12,'Maria Gomez','calle #1292','8711223529','sds','12_Maria Gomez','12_Maria Gomez','casada','2022-07-29 20:43:03','2022-07-29 20:43:03'),(13,'Alberto Escobedo','calle #1292','8711223529','as','13_Alberto Escobedo','13_Alberto Escobedo','casado','2022-07-29 20:44:48','2022-07-29 20:44:48'),(14,'Vianey Lopez','calle #1292','8711223529','television','14_Vianey Lopez','14_Vianey Lopez','soltera','2022-07-29 20:51:34','2022-07-29 20:51:34'),(15,'Vianey Lopez','calle #1292','8711223529','asa','15_Vianey Lopez','15_Vianey Lopez','asa','2022-07-29 21:02:51','2022-07-29 21:02:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Diego Dueñez','calle #111','8711223529','celular','1_Diego Dueñez','1_Diego Dueñez','casado',1,2,17,'2022-07-20 22:05:30','2022-07-20 22:05:30'),(2,'Eduardo Corona','calle #191001','8711223529','celular','2_Eduardo Corona','2_Eduardo Corona','casado',1,2,17,'2022-07-21 14:52:00','2022-07-21 14:52:00'),(3,'Kevin Perez','calle #9191','8711223529','cel \r\npantalla\r\ntanque de gas','3_Kevin Perez','3_Kevin Perez','vive fte al campo',1,1,1,'2022-07-21 15:57:34','2022-07-21 15:57:34'),(4,'Mario Rivera','calle #111','8711223529','celular','4_Mario Rivera','4_Mario Rivera','casado',1,4,19,'2022-07-28 23:05:16','2022-07-28 23:05:16'),(5,'Francisco Escobedo','calle #111','8711223529','celular','5_Francisco Escobedo','5_Francisco Escobedo','soltero',1,1,1,'2022-07-29 20:40:25','2022-07-29 20:40:25'),(6,'Mireya Esquivel','calle #191001','8711223529','celular','6_Mireya Esquivel','6_Mireya Esquivel','casada',1,4,19,'2022-07-29 20:51:34','2022-07-29 20:51:34');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colocadoras`
--

LOCK TABLES `colocadoras` WRITE;
/*!40000 ALTER TABLE `colocadoras` DISABLE KEYS */;
INSERT INTO `colocadoras` VALUES (1,'Juanita Perez','Calle #555','8711223529',1,1,1,'2022-06-18 17:06:42','2022-06-18 17:06:42'),(17,'Maria Ramirez','calle #9919','8711223529',1,1,2,'2022-07-07 18:53:19','2022-07-07 18:53:19'),(19,'Luisa Perez','calle #567','8711223529',1,1,4,'2022-07-28 23:04:21','2022-07-28 23:04:21');
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
INSERT INTO `configuracion_multa` VALUES (1,50.00,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'Perfiles',1),(2,'Usuarios',1),(3,'Empleados',1),(4,'Rutas',1),(5,'Poblaciones',1),(6,'Colocadoras',1),(7,'Clientes',1),(8,'Prestamos',1),(9,'Pagos',1),(10,'Configuraciones',1);
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
  `balance` decimal(10,2) DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-08-05',NULL,NULL,1,10500.00,0,'2022-07-29 15:51:34'),(2,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-08-12',NULL,NULL,2,10500.00,0,'2022-07-29 15:51:34'),(3,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-08-19',NULL,NULL,3,10500.00,0,'2022-07-29 15:51:34'),(4,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-08-26',NULL,NULL,4,10500.00,0,'2022-07-29 15:51:34'),(5,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-09-02',NULL,NULL,5,10500.00,0,'2022-07-29 15:51:34'),(6,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-09-09',NULL,NULL,6,10500.00,0,'2022-07-29 15:51:34'),(7,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-09-16',NULL,NULL,7,10500.00,0,'2022-07-29 15:51:35'),(8,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-09-23',NULL,NULL,8,10500.00,0,'2022-07-29 15:51:35'),(9,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-09-30',NULL,NULL,9,10500.00,0,'2022-07-29 15:51:35'),(10,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-10-07',NULL,NULL,10,10500.00,0,'2022-07-29 15:51:35'),(11,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-10-14',NULL,NULL,11,10500.00,0,'2022-07-29 15:51:35'),(12,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-10-21',NULL,NULL,12,10500.00,0,'2022-07-29 15:51:35'),(13,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-10-28',NULL,NULL,13,10500.00,0,'2022-07-29 15:51:35'),(14,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-11-04',NULL,NULL,14,10500.00,0,'2022-07-29 15:51:35'),(15,1,700.00,0.00,0.00,0.00,0.00,NULL,'2022-11-11',NULL,NULL,15,10500.00,0,'2022-07-29 15:51:35'),(16,2,640.00,640.00,0.00,0.00,640.00,'abono 640','2022-08-05','2022-07-30',6675,1,12160.00,1,'2022-07-29 17:13:15'),(17,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-08-12',NULL,NULL,2,12160.00,0,'2022-07-29 17:13:15'),(18,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-08-19',NULL,NULL,3,12160.00,0,'2022-07-29 17:13:15'),(19,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-08-26',NULL,NULL,4,12160.00,0,'2022-07-29 17:13:15'),(20,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-09-02',NULL,NULL,5,12160.00,0,'2022-07-29 17:13:15'),(21,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-09-09',NULL,NULL,6,12160.00,0,'2022-07-29 17:13:15'),(22,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-09-16',NULL,NULL,7,12160.00,0,'2022-07-29 17:13:15'),(23,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-09-23',NULL,NULL,8,12160.00,0,'2022-07-29 17:13:15'),(24,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-09-30',NULL,NULL,9,12160.00,0,'2022-07-29 17:13:15'),(25,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-10-07',NULL,NULL,10,12160.00,0,'2022-07-29 17:13:15'),(26,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-10-14',NULL,NULL,11,12160.00,0,'2022-07-29 17:13:15'),(27,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-10-21',NULL,NULL,12,12160.00,0,'2022-07-29 17:13:15'),(28,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-10-28',NULL,NULL,13,12160.00,0,'2022-07-29 17:13:15'),(29,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-11-04',NULL,NULL,14,12160.00,0,'2022-07-29 17:13:15'),(30,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-11-11',NULL,NULL,15,12160.00,0,'2022-07-29 17:13:15'),(31,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-11-18',NULL,NULL,16,12160.00,0,'2022-07-29 17:13:15'),(32,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-11-25',NULL,NULL,17,12160.00,0,'2022-07-29 17:13:15'),(33,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-12-02',NULL,NULL,18,12160.00,0,'2022-07-29 17:13:15'),(34,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-12-09',NULL,NULL,19,12160.00,0,'2022-07-29 17:13:15'),(35,2,640.00,0.00,0.00,0.00,0.00,NULL,'2022-12-16',NULL,NULL,20,12160.00,0,'2022-07-29 17:13:15');
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'administrador','usuario','2022-06-15 15:09:13','2022-06-15 15:09:13'),(2,'cobrador','usuario','2022-06-15 19:23:50','2022-06-15 19:23:50'),(3,'secretario','empleado','2022-06-30 16:45:54','2022-06-30 16:45:54'),(8,'unperfil','usuario','2022-07-25 18:21:31','2022-07-25 18:21:31'),(9,'mario','usuario','2022-07-28 22:30:10','2022-07-28 22:30:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles_modulos`
--

LOCK TABLES `perfiles_modulos` WRITE;
/*!40000 ALTER TABLE `perfiles_modulos` DISABLE KEYS */;
INSERT INTO `perfiles_modulos` VALUES (11,5,2),(12,5,4),(59,4,5),(60,4,9),(61,4,10),(62,6,1),(63,6,7),(64,6,8),(65,7,2),(131,3,4),(134,2,7),(137,8,3),(138,8,4),(139,8,7),(140,8,10),(169,9,2),(170,9,3),(171,9,6),(172,1,1),(173,1,2),(174,1,3),(175,1,4),(176,1,5),(177,1,6),(178,1,7),(179,1,8),(180,1,9),(181,1,10);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poblaciones`
--

LOCK TABLES `poblaciones` WRITE;
/*!40000 ALTER TABLE `poblaciones` DISABLE KEYS */;
INSERT INTO `poblaciones` VALUES (1,'Poblacion1','14:00:00','18:59:59','Lunes',50.00,1,1,'2022-07-06 17:27:54','2022-07-06 17:27:54'),(2,'Poblacion2','10:00:00','14:30:00','Lunes',50.00,1,1,'2022-07-07 17:32:20','2022-07-07 17:32:20'),(4,'Hormiguero','17:00:00','23:59:59','Lunes',50.00,67,1,'2022-07-28 23:03:20','2022-07-28 23:03:20');
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
  `grupo_poblacion` int(11) DEFAULT 0,
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
INSERT INTO `prestamos` VALUES (1,6,'calle #191001','8711223529',1,4,19,14,67,7000.00,0.00,700.00,'2022-07-29',1,12234,0,'2022-07-29 20:51:34','2022-07-29 15:51:34'),(2,2,'calle #191001','8711223529',1,2,17,15,1,8000.00,0.00,640.00,'2022-07-29',2,5665,0,'2022-07-29 21:02:51','2022-07-29 16:02:51');
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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Diego Dueñez','diego03',1,'$2y$10$SuXZ7k7.FZZtXc56XhxoHuzgjMMrj3HW3Nj0un6JojK5iq6tswxXW',1,'2022-06-13 16:56:23','2022-06-13 16:56:23'),(51,'Mario Rivera','mrivera',1,'$2y$10$SuXZ7k7.FZZtXc56XhxoHuzgjMMrj3HW3Nj0un6JojK5iq6tswxXW',1,'2022-07-27 18:54:14','2022-07-27 18:54:14'),(52,'Mario Rivera','mrivera2',9,'$2y$10$/ERTEq0.ESyxfmWFw59rDe9I5KysOrHbTNfKZ2L7q3DOsT3RKzbMO',1,'2022-07-28 22:31:18','2022-07-28 22:31:18');
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

-- Dump completed on 2022-07-29 17:39:52
