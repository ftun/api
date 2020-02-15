-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `auth_profile_view`
--

LOCK TABLES `auth_profile_view` WRITE;
/*!40000 ALTER TABLE `auth_profile_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_profile_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `auth_user`
--

LOCK TABLES `auth_user` WRITE;
/*!40000 ALTER TABLE `auth_user` DISABLE KEYS */;
INSERT INTO `auth_user` VALUES (1,'admin','admin',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(2,'operador','operador',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00');
/*!40000 ALTER TABLE `auth_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bit_entidad_bitacora`
--

LOCK TABLES `bit_entidad_bitacora` WRITE;
/*!40000 ALTER TABLE `bit_entidad_bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_entidad_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bit_valor_date`
--

LOCK TABLES `bit_valor_date` WRITE;
/*!40000 ALTER TABLE `bit_valor_date` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bit_valor_decimal`
--

LOCK TABLES `bit_valor_decimal` WRITE;
/*!40000 ALTER TABLE `bit_valor_decimal` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_decimal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bit_valor_fecha`
--

LOCK TABLES `bit_valor_fecha` WRITE;
/*!40000 ALTER TABLE `bit_valor_fecha` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_fecha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bit_valor_integer`
--

LOCK TABLES `bit_valor_integer` WRITE;
/*!40000 ALTER TABLE `bit_valor_integer` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_integer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bit_valor_text`
--

LOCK TABLES `bit_valor_text` WRITE;
/*!40000 ALTER TABLE `bit_valor_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `bit_valor_varchar`
--

LOCK TABLES `bit_valor_varchar` WRITE;
/*!40000 ALTER TABLE `bit_valor_varchar` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_varchar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_actividad`
--

LOCK TABLES `def_actividad` WRITE;
/*!40000 ALTER TABLE `def_actividad` DISABLE KEYS */;
INSERT INTO `def_actividad` VALUES (1,10,'kayak',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(2,9,'Nado delfines',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(3,10,'Buceo',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(4,9,'Surf',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(5,9,'Esqui acuatico',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(6,19,'Tirolesa',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(7,20,'Exploracion Arqueologica',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(8,21,'Paseo Trajinera',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(9,1,'caminata',0,'2020-02-14 16:42:43','admin',' ','2020-02-14 16:53:20'),(10,1,'Correr',1,'2020-02-14 16:53:39','admin',' ','2020-02-14 16:53:39'),(11,2,'Cenderismo',1,'2020-02-14 16:54:23','admin',' ','2020-02-14 16:54:23'),(12,6,'Act',1,'2020-02-14 16:57:01','admin',' ','2020-02-14 16:57:01'),(13,6,'Act2',1,'2020-02-14 16:57:03','admin',' ','2020-02-14 16:57:03'),(14,6,'Act3',1,'2020-02-14 16:57:06','admin',' ','2020-02-14 16:57:06'),(15,3,'Act1',1,'2020-02-15 10:22:39','admin',' ','2020-02-15 10:22:39'),(16,4,'Caminata',1,'2020-02-15 10:22:49','admin',' ','2020-02-15 10:22:49'),(17,5,'sssssss',1,'2020-02-15 10:24:05','admin',' ','2020-02-15 10:24:05'),(18,7,'JhgAUISUIHUA S',1,'2020-02-15 10:24:17','admin',' ','2020-02-15 10:24:17'),(19,8,'Act1',1,'2020-02-15 10:24:25','admin',' ','2020-02-15 10:24:25'),(20,11,'Nado',1,'2020-02-15 10:24:37','admin',' ','2020-02-15 10:24:37'),(21,12,'Correr',1,'2020-02-15 10:24:52','admin',' ','2020-02-15 10:24:52'),(22,13,'Ciclismo',1,'2020-02-15 10:25:05','admin',' ','2020-02-15 10:25:05'),(23,14,'Show',1,'2020-02-15 10:25:22','admin',' ','2020-02-15 10:25:22'),(24,15,'Kayac',1,'2020-02-15 10:25:33','admin',' ','2020-02-15 10:25:33'),(25,16,'Escalar',1,'2020-02-15 10:25:51','admin',' ','2020-02-15 10:25:51'),(26,17,'Cenderismo',1,'2020-02-15 10:26:02','admin',' ','2020-02-15 10:26:02'),(27,18,'Exploracion',1,'2020-02-15 10:26:10','admin',' ','2020-02-15 10:26:10'),(28,22,'Estancia confortable',1,'2020-02-15 10:26:45','admin',' ','2020-02-15 10:26:45'),(29,23,'Hospeaje',1,'2020-02-15 10:27:00','admin',' ','2020-02-15 10:27:00'),(30,30,'Caminata',1,'2020-02-15 10:28:17','admin',' ','2020-02-15 10:28:17');
/*!40000 ALTER TABLE `def_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_categoria`
--

LOCK TABLES `def_categoria` WRITE;
/*!40000 ALTER TABLE `def_categoria` DISABLE KEYS */;
INSERT INTO `def_categoria` VALUES (1,2,0,'Actividades Culturales',1,'2020-02-13 00:00:00','admin','admin','2020-02-14 14:44:08'),(2,2,0,'Actividades Naturaleza',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(3,2,0,'Actividedes Acuatica',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(4,2,0,'Actividades niños',1,'2020-02-13 00:00:00','admin','admin','2020-02-14 14:43:29'),(5,2,0,'Eventos',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(6,2,0,'Espectaculos',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(7,2,0,'Xcaret',1,'2020-02-13 00:00:00','admin','admin','2020-02-14 14:44:17'),(8,2,0,'Opcionales',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(9,2,3,'Playa',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(10,2,3,'Cenotes',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(11,2,2,'Liberacion de tortugas',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(12,2,2,'Andar en bicicleta',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(13,2,6,'Danza Prehispanica',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(14,2,5,'Conciertos',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(15,2,3,'Lagunas',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(16,3,0,'Aventura',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(17,3,0,'Expedicion',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(18,3,0,'Diversion',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(19,3,16,'Explor',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(20,3,17,'Xichen',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(21,3,18,'Xoximilco',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(22,1,0,'Todo Incluido',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(23,1,0,'Basico',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(24,1,23,'sdsdsds',1,'2020-02-14 14:02:55','admin','admin','2020-02-15 10:27:33'),(25,1,2,'TSTSTS',0,'2020-02-14 14:03:34','admin',' ','2020-02-14 14:03:34'),(26,1,3,'sdsdsdsdsd',0,'2020-02-14 14:04:08','admin','admin','2020-02-14 16:44:37'),(27,3,3,'ddddddd',1,'2020-02-14 14:04:33','admin','admin','2020-02-14 16:47:04'),(28,1,0,'sadsdsd',0,'2020-02-14 14:06:47','admin','admin','2020-02-15 09:49:35'),(29,2,0,'Eventos',0,'2020-02-14 14:33:38','admin','admin','2020-02-15 09:49:32'),(30,1,22,'Caminata',1,'2020-02-14 14:44:41','admin',' ','2020-02-14 14:44:41');
/*!40000 ALTER TABLE `def_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_horario`
--

LOCK TABLES `def_horario` WRITE;
/*!40000 ALTER TABLE `def_horario` DISABLE KEYS */;
INSERT INTO `def_horario` VALUES (1,1,'9 - 10',1,'2020-02-15 09:22:12','admin',' ','2020-02-15 09:22:12'),(2,1,'9 - 10',0,'2020-02-15 09:23:43','admin','admin','2020-02-15 09:37:51'),(3,2,'9-10 AM',1,'2020-02-15 11:00:57','admin',' ','2020-02-15 11:00:57'),(4,2,'2-3 PM',1,'2020-02-15 11:01:15','admin',' ','2020-02-15 11:01:15'),(5,16,'Caminata',1,'2020-02-15 11:07:00','admin',' ','2020-02-15 11:07:00');
/*!40000 ALTER TABLE `def_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_paquete`
--

LOCK TABLES `def_paquete` WRITE;
/*!40000 ALTER TABLE `def_paquete` DISABLE KEYS */;
/*!40000 ALTER TABLE `def_paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_paquete_categoria`
--

LOCK TABLES `def_paquete_categoria` WRITE;
/*!40000 ALTER TABLE `def_paquete_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `def_paquete_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_restriccion`
--

LOCK TABLES `def_restriccion` WRITE;
/*!40000 ALTER TABLE `def_restriccion` DISABLE KEYS */;
INSERT INTO `def_restriccion` VALUES (1,1,'Hipertencion',1,'2020-02-15 09:25:04','admin','admin','2020-02-15 09:35:54'),(2,2,'Mayores 18 años',1,'2020-02-15 11:01:27','admin',' ','2020-02-15 11:01:27'),(3,16,'No embarazo',1,'2020-02-15 11:07:13','admin',' ','2020-02-15 11:07:13');
/*!40000 ALTER TABLE `def_restriccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_servicio`
--

LOCK TABLES `def_servicio` WRITE;
/*!40000 ALTER TABLE `def_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `def_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `def_unidad_negocio`
--

LOCK TABLES `def_unidad_negocio` WRITE;
/*!40000 ALTER TABLE `def_unidad_negocio` DISABLE KEYS */;
INSERT INTO `def_unidad_negocio` VALUES (1,'Hotel',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(2,'Parque',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(3,'Tour',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00');
/*!40000 ALTER TABLE `def_unidad_negocio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-15 13:04:03
