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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avales`
--

LOCK TABLES `avales` WRITE;
/*!40000 ALTER TABLE `avales` DISABLE KEYS */;
INSERT INTO `avales` VALUES (1,'Hugo Dueñez','calle #1292','8711223529','laptop','1_Hugo Dueñez','1_Hugo Dueñez','soltero','2022-07-14 20:37:31','2022-07-14 20:37:31'),(2,'Maria Gomez','calle #1292','8711223529','bocina','2_Maria Gomez','2_Maria Gomez','soltera','2022-07-14 20:39:42','2022-07-14 20:39:42'),(3,'Juan Lopez','calle #1292','8711223529','celular','3_Juan Lopez','3_Juan Lopez','soltera','2022-07-14 20:42:06','2022-07-14 20:42:06'),(4,'Alondra Juarez','calle #1292','8711223529','refrigerador','4_Alondra Juarez','4_Alondra Juarez','casada','2022-07-14 20:45:09','2022-07-14 20:45:09');
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
INSERT INTO `clientes` VALUES (1,'Diego Dueñez','calle #8888','8711223529','celular','1_Diego Dueñez','1_Diego Dueñez','soltero',2,3,18,'2022-07-14 20:36:03','2022-07-14 20:36:03'),(2,'Hector Perez','calle #111','8711223529','celular y refrigerador','2_Hector Perez','2_Hector Perez','casado',1,1,1,'2022-07-14 20:39:42','2022-07-14 20:39:42'),(3,'Luis Perez','calle #6556','8711223529','television','3_Luis Perez','3_Luis Perez','casado y con dos hijos',2,3,18,'2022-07-14 20:40:50','2022-07-14 20:40:50');
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
INSERT INTO `colocadoras` VALUES (1,'Juanita Perez','Calle #555','8711223529',1,1,1,'2022-06-18 17:06:42','2022-06-18 17:06:42'),(4,'Maria Ramirez','calle #123','8711223529',1,2,5,'2022-06-18 18:12:15','2022-06-18 18:12:15'),(5,'Isabel Perez','calle #567','8711223529',1,2,4,'2022-06-18 18:13:46','2022-06-18 18:13:46'),(6,'Mariana Jimenez','calle #123','8711223529',1,2,4,'2022-06-18 18:15:25','2022-06-18 18:15:25'),(7,'Adriana Villa','calle #8918','8711223529',1,14,11,'2022-06-18 18:16:52','2022-06-18 18:16:52'),(8,'Daniela Salazar','calle #923','8711223529',1,4,8,'2022-06-18 18:19:01','2022-06-18 18:19:01'),(9,'Karen Montes','calle #4884849','8711223529',1,4,8,'2022-06-18 18:21:00','2022-06-18 18:21:00'),(10,'Ana Gonzalez','calle #93828','8711223529',1,4,7,'2022-06-18 18:23:04','2022-06-18 18:23:04'),(11,'Kendra Perez','calle #9299','8711223529',1,4,7,'2022-06-18 18:24:45','2022-06-18 18:24:45'),(12,'Luisa Torres','calle #1234','8711223529',1,15,10,'2022-06-18 18:30:44','2022-06-18 18:30:44'),(13,'Alejandra Duarte','calle #567','8711223529',1,15,15,'2022-06-23 15:41:48','2022-06-23 15:41:48'),(14,'Ejemplo Dos','calle #8918','8711223529',1,4,9,'2022-06-23 15:42:20','2022-06-23 15:42:20'),(15,'Nueva Colocadora','calle #2822','8711223529',1,17,13,'2022-06-23 17:13:18','2022-06-23 17:13:18'),(16,'Judith Salazar','calle #8787','8711223529',1,17,13,'2022-06-24 20:20:13','2022-06-24 20:20:13'),(17,'Maria Ramirez','calle #9919','8711223529',1,1,2,'2022-07-07 18:53:19','2022-07-07 18:53:19'),(18,'Mariana Perez','calle torreon','8711223529',1,2,3,'2022-07-07 20:28:29','2022-07-07 20:28:29');
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
  `descripcion` varchar(500) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_abonos`
--

LOCK TABLES `configuracion_abonos` WRITE;
/*!40000 ALTER TABLE `configuracion_abonos` DISABLE KEYS */;
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
  `cantidad` int(11) NOT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_multa`
--

LOCK TABLES `configuracion_multa` WRITE;
/*!40000 ALTER TABLE `configuracion_multa` DISABLE KEYS */;
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
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_semanas`
--

LOCK TABLES `configuracion_semanas` WRITE;
/*!40000 ALTER TABLE `configuracion_semanas` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
INSERT INTO `empleados` VALUES (1,'Arturo Herrera','aherrera','$2y$10$Eww7hiKr3fqLKgg9TICCkuo4obUzUsB1eafX7he1RzxOl8FZxUAZq',2,1,'2022-06-15 18:36:50','2022-06-15 18:36:50'),(2,'Juan Gomez','jgomez','$2y$10$SuXZ7k7.FZZtXc56XhxoHuzgjMMrj3HW3Nj0un6JojK5iq6tswxXW',2,1,'2022-06-15 19:24:34','2022-06-15 19:24:34'),(3,'Diego Dueñez','dduenez','$2y$10$qaXfZ82YGm8XvsH9kAlHJOmjwxr6hhqqHlrXpe/w8WSP2sY7/Zn7a',2,1,'2022-06-15 19:51:18','2022-06-15 19:51:18'),(10,'Luis Medina','lmedina','$2y$10$/q7X.ATuLMTSKxowR8nn1.AkY1jNwXTqkT3vU2CkMWS.iDH/KSxnO',2,1,'2022-06-17 19:51:53','2022-06-17 19:51:53'),(11,'Raul Salvador','rsalvador','$2y$10$ihup8DMcP9doeEu4HxGOm.nFJuzdpc3ytZZ6KdksaPKSOwlu/FnN2',2,1,'2022-06-18 17:57:29','2022-06-18 17:57:29'),(12,'Diego Mora','dmora','$2y$10$NP/6Q488kFxsWmUB8B0FIe4oVBJFWd9ar0JZjl2quEjtmbY8bcB0S',2,1,'2022-06-23 15:50:29','2022-06-23 15:50:29'),(13,'Diego Villa','dvilla','$2y$10$m2gclajuNksBHMDcfTSKY.j2vlb35JmM8t7XUOIlpbNPDMO/HKlMy',2,1,'2022-06-23 17:11:40','2022-06-23 17:11:40'),(14,'Armando Hernandez','ahernandez','$2y$10$kl7LAtCu09f1O.BqDv8YkOq.3frSbr.XNFkY0dEsVl7dEoz3xrQWm',2,1,'2022-06-24 20:20:40','2022-06-24 20:20:40'),(15,'Javier Mora','jmora','$2y$10$yWNvhrKpeNTf8t9BKaKUueN0yttV2Tn.Acu30xRIaUlhb8Fm2Sa1i',2,1,'2022-06-24 20:22:02','2022-06-24 20:22:02'),(16,'Luis Perez','lperez','$2y$10$xHHp7o4YcMlAo5QJKT1iEeMZMY2GvEMPbfBUAttMflT0ANKRzDK4e',2,1,'2022-06-30 15:50:03','2022-06-30 15:50:03');
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
  `folio` int(11) DEFAULT 0,
  `status` int(1) DEFAULT 0,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `semana` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-07-21',NULL,0,0,'2022-07-14 15:37:31',NULL),(2,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-07-28',NULL,0,0,'2022-07-14 15:37:31',NULL),(3,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-04',NULL,0,0,'2022-07-14 15:37:31',NULL),(4,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-11',NULL,0,0,'2022-07-14 15:37:31',NULL),(5,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-18',NULL,0,0,'2022-07-14 15:37:31',NULL),(6,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-25',NULL,0,0,'2022-07-14 15:37:32',NULL),(7,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-01',NULL,0,0,'2022-07-14 15:37:32',NULL),(8,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-08',NULL,0,0,'2022-07-14 15:37:32',NULL),(9,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-15',NULL,0,0,'2022-07-14 15:37:32',NULL),(10,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-22',NULL,0,0,'2022-07-14 15:37:32',NULL),(11,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-29',NULL,0,0,'2022-07-14 15:37:32',NULL),(12,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-06',NULL,0,0,'2022-07-14 15:37:32',NULL),(13,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-13',NULL,0,0,'2022-07-14 15:37:32',NULL),(14,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-20',NULL,0,0,'2022-07-14 15:37:32',NULL),(15,1,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-27',NULL,0,0,'2022-07-14 15:37:32',NULL),(16,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-07-21',NULL,0,0,'2022-07-14 15:39:42',NULL),(17,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-07-28',NULL,0,0,'2022-07-14 15:39:42',NULL),(18,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-08-04',NULL,0,0,'2022-07-14 15:39:42',NULL),(19,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-08-11',NULL,0,0,'2022-07-14 15:39:42',NULL),(20,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-08-18',NULL,0,0,'2022-07-14 15:39:42',NULL),(21,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-08-25',NULL,0,0,'2022-07-14 15:39:42',NULL),(22,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-09-01',NULL,0,0,'2022-07-14 15:39:42',NULL),(23,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-09-08',NULL,0,0,'2022-07-14 15:39:42',NULL),(24,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-09-15',NULL,0,0,'2022-07-14 15:39:42',NULL),(25,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-09-22',NULL,0,0,'2022-07-14 15:39:42',NULL),(26,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-09-29',NULL,0,0,'2022-07-14 15:39:42',NULL),(27,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-10-06',NULL,0,0,'2022-07-14 15:39:42',NULL),(28,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-10-13',NULL,0,0,'2022-07-14 15:39:42',NULL),(29,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-10-20',NULL,0,0,'2022-07-14 15:39:42',NULL),(30,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-10-27',NULL,0,0,'2022-07-14 15:39:42',NULL),(31,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-11-03',NULL,0,0,'2022-07-14 15:39:42',NULL),(32,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-11-10',NULL,0,0,'2022-07-14 15:39:42',NULL),(33,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-11-17',NULL,0,0,'2022-07-14 15:39:42',NULL),(34,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-11-24',NULL,0,0,'2022-07-14 15:39:42',NULL),(35,2,720.00,0.00,0.00,0.00,0.00,NULL,'2022-12-01',NULL,0,0,'2022-07-14 15:39:42',NULL),(36,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-07-21',NULL,0,0,'2022-07-14 15:42:06',NULL),(37,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-07-28',NULL,0,0,'2022-07-14 15:42:06',NULL),(38,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-08-04',NULL,0,0,'2022-07-14 15:42:06',NULL),(39,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-08-11',NULL,0,0,'2022-07-14 15:42:06',NULL),(40,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-08-18',NULL,0,0,'2022-07-14 15:42:06',NULL),(41,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-08-25',NULL,0,0,'2022-07-14 15:42:06',NULL),(42,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-09-01',NULL,0,0,'2022-07-14 15:42:06',NULL),(43,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-09-08',NULL,0,0,'2022-07-14 15:42:06',NULL),(44,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-09-15',NULL,0,0,'2022-07-14 15:42:06',NULL),(45,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-09-22',NULL,0,0,'2022-07-14 15:42:06',NULL),(46,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-09-29',NULL,0,0,'2022-07-14 15:42:06',NULL),(47,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-10-06',NULL,0,0,'2022-07-14 15:42:06',NULL),(48,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-10-13',NULL,0,0,'2022-07-14 15:42:06',NULL),(49,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-10-20',NULL,0,0,'2022-07-14 15:42:06',NULL),(50,3,600.00,0.00,0.00,0.00,0.00,NULL,'2022-10-27',NULL,0,0,'2022-07-14 15:42:06',NULL),(51,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-07-21',NULL,0,0,'2022-07-14 15:45:09',NULL),(52,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-07-28',NULL,0,0,'2022-07-14 15:45:09',NULL),(53,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-04',NULL,0,0,'2022-07-14 15:45:09',NULL),(54,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-11',NULL,0,0,'2022-07-14 15:45:09',NULL),(55,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-18',NULL,0,0,'2022-07-14 15:45:09',NULL),(56,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-08-25',NULL,0,0,'2022-07-14 15:45:09',NULL),(57,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-01',NULL,0,0,'2022-07-14 15:45:09',NULL),(58,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-08',NULL,0,0,'2022-07-14 15:45:09',NULL),(59,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-15',NULL,0,0,'2022-07-14 15:45:09',NULL),(60,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-22',NULL,0,0,'2022-07-14 15:45:09',NULL),(61,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-09-29',NULL,0,0,'2022-07-14 15:45:09',NULL),(62,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-06',NULL,0,0,'2022-07-14 15:45:09',NULL),(63,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-13',NULL,0,0,'2022-07-14 15:45:09',NULL),(64,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-20',NULL,0,0,'2022-07-14 15:45:09',NULL),(65,4,800.00,0.00,0.00,0.00,0.00,NULL,'2022-10-27',NULL,0,0,'2022-07-14 15:45:09',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamos`
--

LOCK TABLES `prestamos` WRITE;
/*!40000 ALTER TABLE `prestamos` DISABLE KEYS */;
INSERT INTO `prestamos` VALUES (1,1,'calle #8888','8711223529',2,3,18,1,8000.00,0.00,800.00,'2022-07-14',15,12345,0,'2022-07-14 20:37:31','2022-07-14 15:37:31'),(2,2,'calle #111','8711223529',1,1,1,2,9000.00,0.00,720.00,'2022-07-14',20,3456,0,'2022-07-14 20:39:42','2022-07-14 15:39:42'),(4,3,'calle #6556','8711223529',2,3,18,4,8000.00,0.00,800.00,'2022-07-14',15,898989,0,'2022-07-14 20:45:09','2022-07-14 15:45:09');
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
INSERT INTO `rutas` VALUES (1,'R1',1,1,'2022-07-06 17:27:03','2022-07-06 17:27:03'),(2,'R2',1,1,'2022-07-07 20:27:13','2022-07-07 20:27:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rutas_empleados`
--

LOCK TABLES `rutas_empleados` WRITE;
/*!40000 ALTER TABLE `rutas_empleados` DISABLE KEYS */;
INSERT INTO `rutas_empleados` VALUES (2,1,1),(3,1,15),(4,1,11),(5,2,16),(6,2,14);
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
INSERT INTO `users` VALUES (1,'Diego Dueñez','diego03',1,'$2y$10$SuXZ7k7.FZZtXc56XhxoHuzgjMMrj3HW3Nj0un6JojK5iq6tswxXW',1,'2022-06-13 16:56:23','2022-06-13 16:56:23'),(3,'Diego Dueñez','diego05',1,'$2y$10$Vvfd/0sm5OmN1Z4CMznyGewHh9Xe7daYM2m3uYoqa0LJPIBGinC9G',1,'2022-06-13 20:43:30','2022-06-13 20:43:30'),(19,'Diego Dueñez','diego06',1,'$2y$10$SB8/zX5.VbQImBEiV1y7HeppXB.KIj5OaGVleMYAzha8lFupXMJJG',1,'2022-06-13 20:54:30','2022-06-13 20:54:30'),(23,'Diego Dueñez','dduenez',1,'$2y$10$lRRKhrzCuRn3.g4X5khpne86BdrqW20qi0ILFoIi5p5lCgtVTDW2i',1,'2022-06-14 17:15:49','2022-06-14 17:15:49'),(24,'Otro Usuario','ousuario',1,'$2y$10$MZ4KPNb5Xtg7IVM5yUDCM.p5F7KjVmklEmWQR5ZflGYMq2DG82nYS',1,'2022-06-14 17:30:07','2022-06-14 17:30:07'),(43,'Nuevo Usuario','nusuario',3,'$2y$10$VoXYpvFo4mvwLIVTejEkieHsetOv5uy8mfqry2FvaZSczyxxch8uO',1,'2022-06-23 16:13:41','2022-06-23 16:13:41'),(44,'Cobrador','cobrador',3,'$2y$10$h65NWRhXvGpPJ.ub7gk6eeFg1gx6QNhMbmO7u/qWI1VMku2ZyAFHS',1,'2022-06-23 16:14:01','2022-06-23 16:14:01'),(45,'Christian Lopéz','clopez',1,'$2y$10$zfQVM0m4jicjRO5sChAVd.NbTc6sAeQNDAxVicVDRjKS7xxgX1Oom',1,'2022-06-23 16:15:25','2022-06-23 16:15:25'),(46,'Francisco Escobedo','fescobedo',1,'$2y$10$7aReu/Sjz3bU1HESO.GhDeRvMRuYDdYUH9i9CSjjxX3arhYcjjNE6',1,'2022-06-23 16:17:08','2022-06-23 16:17:08'),(47,'Ariadna Vargas','avargas',1,'$2y$10$X1SeFx0b1HSf0FNYYt.wwOlKwQ7nQs9ya3FHCJvtzbkyCyz0GnwdW',1,'2022-06-23 16:17:32','2022-06-23 16:17:32'),(48,'Gerardo Arteaga','garteaga',1,'$2y$10$KWk36zOhbdpjl7MBYu/Gc.rxNCUh8AigT5seXqi8o7BFrJiiAbrKu',1,'2022-06-24 20:32:51','2022-06-24 20:32:51'),(49,'Mariana Lopéz','mlopez',1,'$2y$10$3elZCxJdKuUIIaTzgikTvupkyxnn6OCyZ2VKTqspqKY8ssjnvqp..',1,'2022-07-05 16:03:31','2022-07-05 16:03:31'),(50,'Mario rivera','mrivera',1,'$2y$10$Rmhbd6VU4FLvs2ISVDaaN.X9T3Q4m/XRA2YuHKU6Kd2WfHK5cR.Na',1,'2022-07-13 18:40:33','2022-07-13 18:40:33');
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

-- Dump completed on 2022-07-14 15:53:05
