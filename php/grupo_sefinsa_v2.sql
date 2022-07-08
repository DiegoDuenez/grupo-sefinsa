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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avales`
--

LOCK TABLES `avales` WRITE;
/*!40000 ALTER TABLE `avales` DISABLE KEYS */;
INSERT INTO `avales` VALUES (1,'Alberto Escobedo','calle #1292','8711223529','Laptop','1_Alberto Escobedo','1_Alberto Escobedo','Soltero','2022-07-06 17:29:10','2022-07-06 17:29:10'),(2,'Hugo Dueñez','calle #1292','8711223529','Pantalla','2_Hugo Dueñez','2_Hugo Dueñez','Soltero','2022-07-06 17:34:47','2022-07-06 17:34:47'),(3,'Julio Gonzalez','calle #1292','8711223529','Celular','3_Julio Gonzalez','3_Julio Gonzalez','Casado','2022-07-06 17:40:27','2022-07-06 17:40:27'),(4,'Melisa Rojas','calle #4442','8711223529','Celular','4_Melisa Rojas','4_Melisa Rojas','Soltera','2022-07-06 17:42:05','2022-07-06 17:42:05'),(7,'Vianey Lopez','calle #1292','8711223529','Celular','7_Vianey Lopez','7_Vianey Lopez','Soltera','2022-07-06 20:34:58','2022-07-06 20:34:58'),(8,'Julio Medina','calle #2334','8711223529','refrigerador','8_Julio Medina','8_Julio Medina','Soltero','2022-07-06 20:41:27','2022-07-06 20:41:27'),(9,'Ernesto Reyes','calle #2334','8711223529','Refrigerador','9_Ernesto Reyes','9_Ernesto Reyes','Casado','2022-07-07 14:42:08','2022-07-07 14:42:08'),(10,'Kevin Lopez','calle #1110','8711223529','Laptop','10_Kevin Lopez','10_Kevin Lopez','Casado','2022-07-07 15:15:38','2022-07-07 15:15:38'),(11,'Eduardo Mejia','calle #2334','8711223529','Refrigerador','11_Eduardo Mejia','11_Eduardo Mejia','Casado y dos hijos','2022-07-07 15:17:35','2022-07-07 15:17:35'),(12,'Andrea Perez','calle #2222','8711223529','Celular','12_Andrea Perez','12_Andrea Perez','Soltera','2022-07-07 15:22:29','2022-07-07 15:22:29'),(13,'Julio Medina','calle #0010','8711223529','laptop','13_Julio Medina','13_Julio Medina','casado','2022-07-07 16:38:02','2022-07-07 16:38:02'),(14,'Sofia Sosa','calle #2334','8711223529','Television','14_Sofia Sosa','14_Sofia Sosa','Soltera','2022-07-07 17:56:41','2022-07-07 17:56:41'),(17,'Armando Perez','calle #1292','8711223529','Celular','17_Armando Perez','17_Armando Perez','Soltero','2022-07-07 18:17:15','2022-07-07 18:17:15'),(18,'Vianey Lopez','calle #1292','8711223529','laptop','18_Vianey Lopez','18_Vianey Lopez','Casada','2022-07-07 18:59:19','2022-07-07 18:59:19'),(19,'Vianey Lopez','calle #1292','8711223529','laptop','19_Vianey Lopez','19_Vianey Lopez','Casada','2022-07-07 18:59:27','2022-07-07 18:59:27'),(20,'Karen Mena','calle #2222','8711223529','Refrigerador','20_Karen Mena','20_Karen Mena','2 hijos','2022-07-07 19:47:08','2022-07-07 19:47:08'),(21,'Luisa Sosa','calle #7171','8711223529','Refrigerador','21_Luisa Sosa','21_Luisa Sosa','Casada','2022-07-07 19:51:33','2022-07-07 19:51:33'),(22,'Pedro Sola','calle #2222','8711223529','Refrigerador','22_Pedro Sola','22_Pedro Sola','Soltero','2022-07-07 19:58:15','2022-07-07 19:58:15'),(23,'Saul Salas','calle #2222','8711223529','Laptop','23_Saul Salas','23_Saul Salas','Casada','2022-07-07 20:02:06','2022-07-07 20:02:06'),(24,'Eduardo Mena','calle #1292','8711223529','Celular','24_Eduardo Mena','24_Eduardo Mena','Casado','2022-07-07 20:08:30','2022-07-07 20:08:30'),(25,'Alondra Juarez','calle #1292','8711223529','Celular','25_Alondra Juarez','25_Alondra Juarez','Casada y tiene dos hijas','2022-07-07 20:12:14','2022-07-07 20:12:14'),(26,'Alberto Escobedo','calle #2222','8711223529','laptop','26_Alberto Escobedo','26_Alberto Escobedo','Casado','2022-07-07 20:14:42','2022-07-07 20:14:42'),(27,'Carlos Esquivel','calle #1292','8711223529','Laptop','27_Carlos Esquivel','27_Carlos Esquivel','Casado','2022-07-07 20:20:38','2022-07-07 20:20:38'),(28,'Diego Dueñez','calle #1292','8711223529','celular','28_Diego Dueñez','28_Diego Dueñez','soltero','2022-07-07 20:23:45','2022-07-07 20:23:45'),(29,'Julio Dueñez','calle #2334','8711223529','laptop','29_Julio Dueñez','29_Julio Dueñez','casado','2022-07-07 20:31:28','2022-07-07 20:31:28'),(30,'Abel Sosa','calle #1292','8711223529','laptop','30_Abel Sosa','30_Abel Sosa','soltero','2022-07-07 20:33:56','2022-07-07 20:33:56'),(31,'Maria Gomez','calle #2222','8711223529','laptop','31_Maria Gomez','31_Maria Gomez','casada','2022-07-08 14:27:51','2022-07-08 14:27:51'),(32,'Andres Escobedo','calle #1292','8711223529','celular','32_Andres Escobedo','32_Andres Escobedo','casado','2022-07-08 14:31:45','2022-07-08 14:31:45'),(33,'Luis Romero','calle #1292','8711223529','celular','33_Luis Romero','33_Luis Romero','casado','2022-07-08 14:45:26','2022-07-08 14:45:26'),(34,'Juan Juarez','calle #1292','8711223529','laptop','34_Juan Juarez','34_Juan Juarez','soltero y dos hijos','2022-07-08 14:49:39','2022-07-08 14:49:39'),(35,'Vianey Campa','calle #1292','8711223529','tele','35_Vianey Campa','35_Vianey Campa','casada','2022-07-08 14:55:05','2022-07-08 14:55:05'),(36,'Luis Romero','calle #121','8711223529','refrigerador','36_Luis Romero','36_Luis Romero','soltero','2022-07-08 15:03:19','2022-07-08 15:03:19'),(37,'Alberto Escobedo','calle #1292','8711223529','celular','37_Alberto Escobedo','37_Alberto Escobedo','casado','2022-07-08 15:06:50','2022-07-08 15:06:50'),(38,'Alberto Escobedo','calle #1292','8711223529','celular','38_Alberto Escobedo','38_Alberto Escobedo','soltero','2022-07-08 15:09:04','2022-07-08 15:09:04'),(39,'Alondra Juarez','calle #1292','8711223529','celular','39_Alondra Juarez','39_Alondra Juarez','Soltera','2022-07-08 15:13:07','2022-07-08 15:13:07'),(40,'Carolina Medina','calle #1212','8711223529','celular','40_Carolina Medina','40_Carolina Medina','soltero','2022-07-08 15:15:28','2022-07-08 15:15:28'),(41,'Melisa Rojas','calle #1292','8711223545','refrigerador','41_Melisa Rojas','41_Melisa Rojas','soltera','2022-07-08 15:24:47','2022-07-08 15:24:47'),(42,NULL,NULL,NULL,'celular','Christian Lagos','calle #1292',NULL,'2022-07-08 15:33:58','2022-07-08 15:33:58'),(43,'Kevin Lagos','calle #2334','8711223529','refrigerador y laptop','43_Kevin Lagos','43_Kevin Lagos','soltero','2022-07-08 15:37:47','2022-07-08 15:37:47'),(44,'Leonel Perez','calle #1292','8711223529','laptop y refrigerador','44_Leonel Perez','44_Leonel Perez','soltero','2022-07-08 15:42:56','2022-07-08 15:42:56'),(45,'Vianey Lopez','calle #1292','8711223529','Refrigerador','45_Vianey Lopez','45_Vianey Lopez','casada y dos hijos','2022-07-08 15:49:38','2022-07-08 15:49:38'),(46,'Isabela Gomez','calle #7787','8711223529','celular','46_Isabela Gomez','46_Isabela Gomez','soltera','2022-07-08 16:08:37','2022-07-08 16:08:37'),(47,'Jesus Vaquera','calle #1292','8711223529','laptop','47_Jesus Vaquera','47_Jesus Vaquera','soltero','2022-07-08 16:20:58','2022-07-08 16:20:58'),(48,'Jimena Perez','calle #1292','8711223529','Celular','48_Jimena Perez','48_Jimena Perez','Casada','2022-07-08 18:04:57','2022-07-08 18:04:57'),(49,'Maria Salas','calle #9999','8711223529','celular, laptop  y television','49_Maria Salas','49_Maria Salas','casada','2022-07-08 19:25:41','2022-07-08 19:25:41');
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (24,'Diego Dueñez','calle #191001','8711223529','laptop','24_Diego Dueñez','24_Diego Dueñez','Soltero',1,1,1,'2022-07-06 17:28:22','2022-07-06 17:28:22'),(27,'Eduardo Corona','calle #111','8711223529','Refrigerador','27_Eduardo Corona','27_Eduardo Corona','Casado',2,3,18,'2022-07-06 20:34:58','2022-07-06 20:34:58'),(28,'Kevin Perez','calle #1111','8711223529','Celular','28_Kevin Perez','28_Kevin Perez','Casado',1,1,1,'2022-07-06 20:41:28','2022-07-06 20:41:28'),(29,'Carla Sosa','calle #191001','8711223529','refrigerador','29_Carla Sosa','29_Carla Sosa','Casada y dos hijas',1,1,1,'2022-07-07 15:22:29','2022-07-07 15:22:29'),(30,'mario rivera','torreon','8711536427','celular','30_mario rivera','30_mario rivera','vive frente al colegio la luz',1,1,1,'2022-07-07 15:50:02','2022-07-07 15:50:02'),(31,'Jesus Vazquez','calle #222','8711223529','Celular','31_Jesus Vazquez','31_Jesus Vazquez','Casado y dos hijos',1,1,1,'2022-07-07 17:41:19','2022-07-07 17:41:19'),(32,'Mariana Castillo','calle #1111','8711223529','','32_Mariana Castillo','32_Mariana Castillo','Casada y 3 hijos',1,1,1,'2022-07-07 17:42:09','2022-07-07 17:42:09'),(33,'Isabela Mora','calle #1111','8711223529','iphone','33_Isabela Mora','33_Isabela Mora','Soltera',1,1,1,'2022-07-07 17:42:59','2022-07-07 17:42:59'),(34,'Andres Mejia','calle #1111','8711223529','celular','34_Andres Mejia','34_Andres Mejia','Soltero',NULL,NULL,NULL,'2022-07-07 17:44:08','2022-07-07 17:44:08'),(35,'Gerardo Martino','calle #131','8711223531','Laptop','35_Gerardo Martino','35_Gerardo Martino','Casado',1,1,1,'2022-07-07 18:17:15','2022-07-07 18:17:15'),(36,'Brayan Romero ','calle #101','8711223529','celular','36_Brayan Romero ','36_Brayan Romero ','Soltero',1,1,1,'2022-07-07 20:33:56','2022-07-07 20:33:56'),(38,'Francisco Escobedo','calle #111','8711223529','celular','38_Francisco Escobedo','38_Francisco Escobedo','casado',2,3,18,'2022-07-08 14:55:05','2022-07-08 14:55:05'),(39,'Luis Romero','calle #99','8711223530','','39_Luis Romero','39_Luis Romero','casada',1,1,1,'2022-07-08 15:13:07','2022-07-08 15:13:07'),(40,'Alejandro Romero','calle #1000','8711223530','Laptop','40_Alejandro Romero','40_Alejandro Romero','soltero',1,1,1,'2022-07-08 15:22:55','2022-07-08 15:22:55'),(41,'Arturo Limon','calle #991','8711223521','celular','41_Arturo Limon','41_Arturo Limon','casado',1,2,17,'2022-07-08 16:20:58','2022-07-08 16:20:58'),(42,'Gerardo Lopez','calle #8888','8711223529','celular y laptop ','42_Gerardo Lopez','42_Gerardo Lopez','Casado',2,3,18,'2022-07-08 18:03:33','2022-07-08 18:03:33');
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
INSERT INTO `poblaciones` VALUES (1,'Poblacion1','14:00:00','18:59:59','Lunes',300.00,1,1,'2022-07-06 17:27:54','2022-07-06 17:27:54'),(2,'Poblacion2','10:00:00','14:30:00','Lunes',50.00,1,1,'2022-07-07 17:32:20','2022-07-07 17:32:20'),(3,'Hormiguero','15:00:00','18:59:59','Lunes',50.00,1,2,'2022-07-07 20:27:54','2022-07-07 20:27:54');
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
  `pago_semanal` double(10,2) NOT NULL,
  `fecha_prestamo` datetime NOT NULL,
  `modalidad_semanas` int(10) DEFAULT 15,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamos`
--

LOCK TABLES `prestamos` WRITE;
/*!40000 ALTER TABLE `prestamos` DISABLE KEYS */;
INSERT INTO `prestamos` VALUES (2,35,'calle #111','8711223529',1,2,1,21,5600.00,200.00,'2022-07-07 00:00:00',15,'2022-07-07 19:51:33','2022-07-07 14:53:41'),(3,35,'calle #120','8711223529',1,2,0,22,4000.00,150.00,'2022-07-07 00:00:00',15,'2022-07-07 19:58:15','2022-07-07 14:58:15'),(4,35,'calle #130','8711223529',1,2,17,23,4000.00,100.00,'2022-07-07 00:00:00',15,'2022-07-07 20:02:07','2022-07-07 15:02:07'),(5,35,'calle #130','8711223529',1,1,1,24,6000.00,300.00,'2022-07-07 00:00:00',15,'2022-07-07 20:08:30','2022-07-07 15:08:30'),(6,34,'calle #111','8711223529',1,2,17,25,9000.00,300.00,'2022-07-07 00:00:00',15,'2022-07-07 20:12:14','2022-07-07 15:12:14'),(7,33,'calle #1111','8711223529',1,1,1,26,5000.00,200.00,'2022-07-07 00:00:00',15,'2022-07-07 20:14:42','2022-07-07 15:14:42'),(8,31,'calle #222','8711223529',1,1,1,27,6000.00,100.00,'2022-07-07 00:00:00',15,'2022-07-07 20:20:38','2022-07-07 15:20:38'),(9,30,'torreon','8711536427',1,1,1,28,5000.00,100.00,'2022-07-07 00:00:00',15,'2022-07-07 20:23:45','2022-07-07 15:23:45'),(10,27,'calle #111','8711223529',2,3,18,29,3000.00,100.00,'2022-07-07 00:00:00',15,'2022-07-07 20:31:29','2022-07-07 15:31:29'),(14,37,'calle #111','8711223529',2,3,18,33,3000.00,150.00,'2022-07-08 00:00:00',15,'2022-07-08 14:45:26','2022-07-08 09:45:26'),(16,38,'calle #111','8711223529',2,3,18,35,2000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 14:55:05','2022-07-08 09:55:05'),(17,0,'calle #100','8711223529',1,1,1,36,8000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 15:03:19','2022-07-08 10:03:19'),(18,0,'calle #100','8711223529',1,1,1,37,8000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 15:06:50','2022-07-08 10:06:50'),(19,36,'calle #101','8711223529',1,1,1,38,8000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 15:09:04','2022-07-08 10:09:04'),(20,39,'calle #899','8711223529',1,2,17,39,2000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 15:13:08','2022-07-08 10:13:08'),(21,39,'calle #99','8711223529',1,1,1,40,1000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 15:15:28','2022-07-08 10:15:28'),(22,40,NULL,NULL,NULL,NULL,NULL,41,6000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 15:24:47','2022-07-08 10:24:47'),(23,40,'calle #999','8711223530',1,1,1,44,3000.00,200.00,'2022-07-08 00:00:00',15,'2022-07-08 15:42:56','2022-07-08 10:42:56'),(24,40,'calle #1000','8711223530',1,1,1,45,8000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 15:49:38','2022-07-08 10:49:38'),(25,35,'calle #131','8711223531',1,1,1,46,9000.00,100.00,'2022-07-08 00:00:00',20,'2022-07-08 16:08:37','2022-07-08 11:08:37'),(26,41,'calle #991','8711223521',1,2,17,47,2000.00,100.00,'2022-07-08 00:00:00',20,'2022-07-08 16:20:59','2022-07-08 11:20:59'),(27,42,'calle #8888','8711223529',1,2,17,48,80000.00,100.00,'2022-07-08 00:00:00',20,'2022-07-08 18:04:57','2022-07-08 13:04:57'),(28,41,'calle #991','8711223521',1,2,17,49,5000.00,100.00,'2022-07-08 00:00:00',15,'2022-07-08 19:25:42','2022-07-08 14:25:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Diego Dueñez','diego03',1,'$2y$10$SuXZ7k7.FZZtXc56XhxoHuzgjMMrj3HW3Nj0un6JojK5iq6tswxXW',1,'2022-06-13 16:56:23','2022-06-13 16:56:23'),(3,'Diego Dueñez','diego05',1,'$2y$10$Vvfd/0sm5OmN1Z4CMznyGewHh9Xe7daYM2m3uYoqa0LJPIBGinC9G',1,'2022-06-13 20:43:30','2022-06-13 20:43:30'),(19,'Diego Dueñez','diego06',1,'$2y$10$SB8/zX5.VbQImBEiV1y7HeppXB.KIj5OaGVleMYAzha8lFupXMJJG',1,'2022-06-13 20:54:30','2022-06-13 20:54:30'),(23,'Diego Dueñez','dduenez',1,'$2y$10$lRRKhrzCuRn3.g4X5khpne86BdrqW20qi0ILFoIi5p5lCgtVTDW2i',1,'2022-06-14 17:15:49','2022-06-14 17:15:49'),(24,'Otro Usuario','ousuario',1,'$2y$10$MZ4KPNb5Xtg7IVM5yUDCM.p5F7KjVmklEmWQR5ZflGYMq2DG82nYS',1,'2022-06-14 17:30:07','2022-06-14 17:30:07'),(43,'Nuevo Usuario','nusuario',3,'$2y$10$VoXYpvFo4mvwLIVTejEkieHsetOv5uy8mfqry2FvaZSczyxxch8uO',1,'2022-06-23 16:13:41','2022-06-23 16:13:41'),(44,'Cobrador','cobrador',3,'$2y$10$h65NWRhXvGpPJ.ub7gk6eeFg1gx6QNhMbmO7u/qWI1VMku2ZyAFHS',1,'2022-06-23 16:14:01','2022-06-23 16:14:01'),(45,'Christian Lopéz','clopez',1,'$2y$10$zfQVM0m4jicjRO5sChAVd.NbTc6sAeQNDAxVicVDRjKS7xxgX1Oom',1,'2022-06-23 16:15:25','2022-06-23 16:15:25'),(46,'Francisco Escobedo','fescobedo',1,'$2y$10$7aReu/Sjz3bU1HESO.GhDeRvMRuYDdYUH9i9CSjjxX3arhYcjjNE6',1,'2022-06-23 16:17:08','2022-06-23 16:17:08'),(47,'Ariadna Vargas','avargas',1,'$2y$10$X1SeFx0b1HSf0FNYYt.wwOlKwQ7nQs9ya3FHCJvtzbkyCyz0GnwdW',1,'2022-06-23 16:17:32','2022-06-23 16:17:32'),(48,'Gerardo Arteaga','garteaga',1,'$2y$10$KWk36zOhbdpjl7MBYu/Gc.rxNCUh8AigT5seXqi8o7BFrJiiAbrKu',1,'2022-06-24 20:32:51','2022-06-24 20:32:51'),(49,'Mariana Lopéz','mlopez',1,'$2y$10$3elZCxJdKuUIIaTzgikTvupkyxnn6OCyZ2VKTqspqKY8ssjnvqp..',1,'2022-07-05 16:03:31','2022-07-05 16:03:31');
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

-- Dump completed on 2022-07-08 15:33:04
