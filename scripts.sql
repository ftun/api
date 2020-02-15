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
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx_user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(4) NOT NULL DEFAULT '0' COMMENT '0 Default, 1 Rol, 2 Tareas, 3 Menu',
  `description` text NOT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `auth_item_ibfk_1_idx` (`rule_name`),
  KEY `estado` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_profile_view`
--

DROP TABLE IF EXISTS `auth_profile_view`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_profile_view` (
  `id_profile_view` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave primaria de la tabla',
  `auth_item` varchar(64) NOT NULL COMMENT 'Rol de Sistema',
  `modulo` varchar(64) NOT NULL DEFAULT '' COMMENT 'Modulo del Sistema',
  `controller` varchar(64) NOT NULL COMMENT 'Controlador del Sistema',
  `action` varchar(64) NOT NULL COMMENT 'Acción a la que se le da el permiso',
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`id_profile_view`),
  UNIQUE KEY `idx_profile_view_unique` (`auth_item`,`modulo`,`controller`,`action`),
  KEY `fk_profile_view` (`auth_item`),
  KEY `auth_item_idx` (`auth_item`),
  KEY `modulo_idx` (`modulo`),
  KEY `controller_idx` (`controller`),
  CONSTRAINT `fk_profile_view` FOREIGN KEY (`auth_item`) REFERENCES `auth_item` (`name`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_profile_view`
--

LOCK TABLES `auth_profile_view` WRITE;
/*!40000 ALTER TABLE `auth_profile_view` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_profile_view` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_user`
--

DROP TABLE IF EXISTS `auth_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_user` (
  `idauth_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL DEFAULT ' ',
  `password` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`idauth_user`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_user`
--

LOCK TABLES `auth_user` WRITE;
/*!40000 ALTER TABLE `auth_user` DISABLE KEYS */;
INSERT INTO `auth_user` VALUES (1,'admin','admin',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(2,'operador','operador',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00');
/*!40000 ALTER TABLE `auth_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bit_entidad_bitacora`
--

DROP TABLE IF EXISTS `bit_entidad_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bit_entidad_bitacora` (
  `idbit_entidad_bitacora` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tabla` varchar(100) NOT NULL DEFAULT '' COMMENT 'tabla',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`idbit_entidad_bitacora`),
  KEY `nombre_tabla` (`nombre_tabla`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bit_entidad_bitacora`
--

LOCK TABLES `bit_entidad_bitacora` WRITE;
/*!40000 ALTER TABLE `bit_entidad_bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_entidad_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bit_valor_date`
--

DROP TABLE IF EXISTS `bit_valor_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bit_valor_date` (
  `idbit_valor_date` int(11) NOT NULL AUTO_INCREMENT,
  `idbit_entidad_bitacora` int(11) NOT NULL DEFAULT '0',
  `atributo` varchar(60) NOT NULL DEFAULT '',
  `bit_valor` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `bit_valor_remplazo` datetime NOT NULL DEFAULT '1000-01-01 00:00:00',
  `llave_primaria` varchar(100) NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL DEFAULT 'UPDATE',
  `command` varchar(200) NOT NULL DEFAULT '',
  `usuario_modificacion` varchar(45) NOT NULL DEFAULT '',
  `fecha_modificacion` date NOT NULL DEFAULT '1000-01-01',
  `hora_modificacion` time NOT NULL DEFAULT '01:01:00',
  `pid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idbit_valor_date`),
  KEY `fk_bit_valor_date_entidad_idx` (`idbit_entidad_bitacora`),
  KEY `llave_primaria` (`llave_primaria`),
  CONSTRAINT `fk_bit_valor_date_entidad` FOREIGN KEY (`idbit_entidad_bitacora`) REFERENCES `bit_entidad_bitacora` (`idbit_entidad_bitacora`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5013 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bit_valor_date`
--

LOCK TABLES `bit_valor_date` WRITE;
/*!40000 ALTER TABLE `bit_valor_date` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_date` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bit_valor_decimal`
--

DROP TABLE IF EXISTS `bit_valor_decimal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bit_valor_decimal` (
  `idbit_valor_decimal` int(11) NOT NULL AUTO_INCREMENT,
  `idbit_entidad_bitacora` int(11) NOT NULL DEFAULT '0',
  `atributo` varchar(60) NOT NULL DEFAULT '',
  `bit_valor` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `bit_valor_remplazo` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `llave_primaria` varchar(100) NOT NULL DEFAULT '0',
  `usuario_modificacion` varchar(45) NOT NULL DEFAULT '',
  `fecha_modificacion` date NOT NULL DEFAULT '1000-01-01',
  `hora_modificacion` time NOT NULL DEFAULT '01:01:00',
  `pid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL DEFAULT 'UPDATE',
  `command` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`idbit_valor_decimal`),
  KEY `fk_bit_valor_decimal_entidad_idx` (`idbit_entidad_bitacora`),
  KEY `llave_primaria` (`llave_primaria`),
  CONSTRAINT `fk_bit_valor_decimal_entidad` FOREIGN KEY (`idbit_entidad_bitacora`) REFERENCES `bit_entidad_bitacora` (`idbit_entidad_bitacora`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bit_valor_decimal`
--

LOCK TABLES `bit_valor_decimal` WRITE;
/*!40000 ALTER TABLE `bit_valor_decimal` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_decimal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bit_valor_fecha`
--

DROP TABLE IF EXISTS `bit_valor_fecha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bit_valor_fecha` (
  `idbit_valor_fecha` int(11) NOT NULL AUTO_INCREMENT,
  `idbit_entidad_bitacora` int(11) NOT NULL DEFAULT '0',
  `atributo` varchar(60) NOT NULL DEFAULT '',
  `bit_valor` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `bit_valor_remplazo` decimal(18,4) NOT NULL DEFAULT '0.0000',
  `llave_primaria` varchar(100) NOT NULL DEFAULT '0',
  `usuario_modificacion` varchar(45) NOT NULL DEFAULT '',
  `fecha_modificacion` date NOT NULL DEFAULT '1000-01-01',
  `hora_modificacion` time NOT NULL DEFAULT '01:01:00',
  `pid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL DEFAULT 'UPDATE',
  `command` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`idbit_valor_fecha`),
  KEY `fk_bit_valor_fecha_entidad_idx` (`idbit_entidad_bitacora`),
  CONSTRAINT `fk_bit_valor_fecha_entidad` FOREIGN KEY (`idbit_entidad_bitacora`) REFERENCES `bit_entidad_bitacora` (`idbit_entidad_bitacora`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bit_valor_fecha`
--

LOCK TABLES `bit_valor_fecha` WRITE;
/*!40000 ALTER TABLE `bit_valor_fecha` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_fecha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bit_valor_integer`
--

DROP TABLE IF EXISTS `bit_valor_integer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bit_valor_integer` (
  `idbit_valor_integer` int(11) NOT NULL AUTO_INCREMENT,
  `idbit_entidad_bitacora` int(11) NOT NULL DEFAULT '0',
  `atributo` varchar(60) NOT NULL DEFAULT '',
  `bit_valor` int(11) NOT NULL DEFAULT '0',
  `bit_valor_remplazo` int(11) NOT NULL DEFAULT '0',
  `llave_primaria` varchar(100) NOT NULL DEFAULT '0',
  `usuario_modificacion` varchar(45) NOT NULL DEFAULT '',
  `fecha_modificacion` date NOT NULL DEFAULT '1000-01-01',
  `hora_modificacion` time NOT NULL DEFAULT '01:01:00',
  `pid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL DEFAULT 'UPDATE',
  `command` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`idbit_valor_integer`),
  KEY `fk_bit_valor_integer_entidad_idx` (`idbit_entidad_bitacora`),
  KEY `llave_primaria` (`llave_primaria`),
  CONSTRAINT `fk_bit_valor_integer_entidad` FOREIGN KEY (`idbit_entidad_bitacora`) REFERENCES `bit_entidad_bitacora` (`idbit_entidad_bitacora`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=45685 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bit_valor_integer`
--

LOCK TABLES `bit_valor_integer` WRITE;
/*!40000 ALTER TABLE `bit_valor_integer` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_integer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bit_valor_text`
--

DROP TABLE IF EXISTS `bit_valor_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bit_valor_text` (
  `idbit_valor_text` int(11) NOT NULL AUTO_INCREMENT,
  `idbit_entidad_bitacora` int(11) NOT NULL DEFAULT '0',
  `atributo` varchar(60) NOT NULL DEFAULT '',
  `bit_valor` text NOT NULL,
  `bit_valor_remplazo` text NOT NULL,
  `llave_primaria` varchar(200) NOT NULL DEFAULT '0',
  `usuario_modificacion` varchar(45) NOT NULL DEFAULT '',
  `fecha_modificacion` date NOT NULL DEFAULT '1000-01-01',
  `hora_modificacion` time NOT NULL DEFAULT '01:01:00',
  `pid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL DEFAULT 'UPDATE',
  `command` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`idbit_valor_text`),
  KEY `fk_bit_varlor_text_entidad_idx` (`idbit_entidad_bitacora`),
  KEY `llave_primaria` (`llave_primaria`),
  CONSTRAINT `fk_bit_varlor_text_entidad` FOREIGN KEY (`idbit_entidad_bitacora`) REFERENCES `bit_entidad_bitacora` (`idbit_entidad_bitacora`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=86299 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bit_valor_text`
--

LOCK TABLES `bit_valor_text` WRITE;
/*!40000 ALTER TABLE `bit_valor_text` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bit_valor_varchar`
--

DROP TABLE IF EXISTS `bit_valor_varchar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bit_valor_varchar` (
  `idbit_valor_varchar` int(11) NOT NULL AUTO_INCREMENT,
  `idbit_entidad_bitacora` int(11) NOT NULL DEFAULT '0',
  `atributo` varchar(60) NOT NULL DEFAULT '' COMMENT 'attt',
  `bit_valor` varchar(256) NOT NULL DEFAULT '',
  `bit_valor_remplazo` varchar(256) NOT NULL DEFAULT '',
  `llave_primaria` varchar(200) NOT NULL DEFAULT '0',
  `usuario_modificacion` varchar(45) NOT NULL DEFAULT '',
  `fecha_modificacion` date NOT NULL DEFAULT '1000-01-01',
  `hora_modificacion` time NOT NULL DEFAULT '01:01:00',
  `pid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(45) NOT NULL DEFAULT 'UPDATE',
  `command` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`idbit_valor_varchar`),
  KEY `fk_bit_valor_varchar_entidad_idx` (`idbit_entidad_bitacora`),
  KEY `llave_primaria` (`llave_primaria`),
  CONSTRAINT `fk_bit_valor_varchar_entidad` FOREIGN KEY (`idbit_entidad_bitacora`) REFERENCES `bit_entidad_bitacora` (`idbit_entidad_bitacora`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=70881 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bit_valor_varchar`
--

LOCK TABLES `bit_valor_varchar` WRITE;
/*!40000 ALTER TABLE `bit_valor_varchar` DISABLE KEYS */;
/*!40000 ALTER TABLE `bit_valor_varchar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_actividad`
--

DROP TABLE IF EXISTS `def_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_actividad` (
  `iddef_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `iddef_categoria` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_actividad`),
  KEY `fk_def_actividad_1_idx` (`iddef_categoria`),
  CONSTRAINT `fk_def_actividad_1` FOREIGN KEY (`iddef_categoria`) REFERENCES `def_categoria` (`iddef_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `def_actividad`
--

LOCK TABLES `def_actividad` WRITE;
/*!40000 ALTER TABLE `def_actividad` DISABLE KEYS */;
INSERT INTO `def_actividad` VALUES (1,10,'kayak',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(2,9,'Nado delfines',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(3,10,'Buceo',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(4,9,'Surf',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(5,9,'Esqui acuatico',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(6,19,'Tirolesa',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(7,20,'Exploracion Arqueologica',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(8,21,'Paseo Trajinera',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(9,1,'caminata',0,'2020-02-14 16:42:43','admin',' ','2020-02-14 16:53:20'),(10,1,'Correr',1,'2020-02-14 16:53:39','admin',' ','2020-02-14 16:53:39'),(11,2,'Cenderismo',1,'2020-02-14 16:54:23','admin',' ','2020-02-14 16:54:23'),(12,6,'Act',1,'2020-02-14 16:57:01','admin',' ','2020-02-14 16:57:01'),(13,6,'Act2',1,'2020-02-14 16:57:03','admin',' ','2020-02-14 16:57:03'),(14,6,'Act3',1,'2020-02-14 16:57:06','admin',' ','2020-02-14 16:57:06'),(15,3,'Act1',1,'2020-02-15 10:22:39','admin',' ','2020-02-15 10:22:39'),(16,4,'Caminata',1,'2020-02-15 10:22:49','admin',' ','2020-02-15 10:22:49'),(17,5,'sssssss',1,'2020-02-15 10:24:05','admin',' ','2020-02-15 10:24:05'),(18,7,'JhgAUISUIHUA S',1,'2020-02-15 10:24:17','admin',' ','2020-02-15 10:24:17'),(19,8,'Act1',1,'2020-02-15 10:24:25','admin',' ','2020-02-15 10:24:25'),(20,11,'Nado',1,'2020-02-15 10:24:37','admin',' ','2020-02-15 10:24:37'),(21,12,'Correr',1,'2020-02-15 10:24:52','admin',' ','2020-02-15 10:24:52'),(22,13,'Ciclismo',1,'2020-02-15 10:25:05','admin',' ','2020-02-15 10:25:05'),(23,14,'Show',1,'2020-02-15 10:25:22','admin',' ','2020-02-15 10:25:22'),(24,15,'Kayac',1,'2020-02-15 10:25:33','admin',' ','2020-02-15 10:25:33'),(25,16,'Escalar',1,'2020-02-15 10:25:51','admin',' ','2020-02-15 10:25:51'),(26,17,'Cenderismo',1,'2020-02-15 10:26:02','admin',' ','2020-02-15 10:26:02'),(27,18,'Exploracion',1,'2020-02-15 10:26:10','admin',' ','2020-02-15 10:26:10'),(28,22,'Estancia confortable',1,'2020-02-15 10:26:45','admin',' ','2020-02-15 10:26:45'),(29,23,'Hospeaje',1,'2020-02-15 10:27:00','admin',' ','2020-02-15 10:27:00'),(30,30,'Caminata',1,'2020-02-15 10:28:17','admin',' ','2020-02-15 10:28:17');
/*!40000 ALTER TABLE `def_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_categoria`
--

DROP TABLE IF EXISTS `def_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_categoria` (
  `iddef_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `iddef_unidad_negocio` int(11) NOT NULL DEFAULT '0',
  `iddef_categoria_padre` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_categoria`),
  KEY `fk_def_categoria_1_idx` (`iddef_unidad_negocio`),
  CONSTRAINT `fk_def_categoria_1` FOREIGN KEY (`iddef_unidad_negocio`) REFERENCES `def_unidad_negocio` (`iddef_unidad_negocio`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `def_categoria`
--

LOCK TABLES `def_categoria` WRITE;
/*!40000 ALTER TABLE `def_categoria` DISABLE KEYS */;
INSERT INTO `def_categoria` VALUES (1,2,0,'Actividades Culturales',1,'2020-02-13 00:00:00','admin','admin','2020-02-14 14:44:08'),(2,2,0,'Actividades Naturaleza',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(3,2,0,'Actividedes Acuatica',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(4,2,0,'Actividades niños',1,'2020-02-13 00:00:00','admin','admin','2020-02-14 14:43:29'),(5,2,0,'Eventos',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(6,2,0,'Espectaculos',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(7,2,0,'Xcaret',1,'2020-02-13 00:00:00','admin','admin','2020-02-14 14:44:17'),(8,2,0,'Opcionales',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(9,2,3,'Playa',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(10,2,3,'Cenotes',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(11,2,2,'Liberacion de tortugas',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(12,2,2,'Andar en bicicleta',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(13,2,6,'Danza Prehispanica',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(14,2,5,'Conciertos',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(15,2,3,'Lagunas',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(16,3,0,'Aventura',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(17,3,0,'Expedicion',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(18,3,0,'Diversion',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(19,3,16,'Explor',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(20,3,17,'Xichen',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(21,3,18,'Xoximilco',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(22,1,0,'Todo Incluido',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(23,1,0,'Basico',1,'2020-02-13 00:00:00','admin',' ','1000-01-01 00:00:00'),(24,1,23,'sdsdsds',1,'2020-02-14 14:02:55','admin','admin','2020-02-15 10:27:33'),(25,1,2,'TSTSTS',0,'2020-02-14 14:03:34','admin',' ','2020-02-14 14:03:34'),(26,1,3,'sdsdsdsdsd',0,'2020-02-14 14:04:08','admin','admin','2020-02-14 16:44:37'),(27,3,3,'ddddddd',1,'2020-02-14 14:04:33','admin','admin','2020-02-14 16:47:04'),(28,1,0,'sadsdsd',0,'2020-02-14 14:06:47','admin','admin','2020-02-15 09:49:35'),(29,2,0,'Eventos',0,'2020-02-14 14:33:38','admin','admin','2020-02-15 09:49:32'),(30,1,22,'Caminata',1,'2020-02-14 14:44:41','admin',' ','2020-02-14 14:44:41');
/*!40000 ALTER TABLE `def_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_horario`
--

DROP TABLE IF EXISTS `def_horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_horario` (
  `iddef_horario` int(11) NOT NULL AUTO_INCREMENT,
  `iddef_actividad` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_horario`),
  KEY `fk_def_horario_1_idx` (`iddef_actividad`),
  CONSTRAINT `fk_def_horario_1` FOREIGN KEY (`iddef_actividad`) REFERENCES `def_actividad` (`iddef_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `def_horario`
--

LOCK TABLES `def_horario` WRITE;
/*!40000 ALTER TABLE `def_horario` DISABLE KEYS */;
INSERT INTO `def_horario` VALUES (1,1,'9 - 10',1,'2020-02-15 09:22:12','admin',' ','2020-02-15 09:22:12'),(2,1,'9 - 10',0,'2020-02-15 09:23:43','admin','admin','2020-02-15 09:37:51'),(3,2,'9-10 AM',1,'2020-02-15 11:00:57','admin',' ','2020-02-15 11:00:57'),(4,2,'2-3 PM',1,'2020-02-15 11:01:15','admin',' ','2020-02-15 11:01:15'),(5,16,'Caminata',1,'2020-02-15 11:07:00','admin',' ','2020-02-15 11:07:00');
/*!40000 ALTER TABLE `def_horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_paquete`
--

DROP TABLE IF EXISTS `def_paquete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_paquete` (
  `iddef_paquete` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_paquete`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `def_paquete`
--

LOCK TABLES `def_paquete` WRITE;
/*!40000 ALTER TABLE `def_paquete` DISABLE KEYS */;
/*!40000 ALTER TABLE `def_paquete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_paquete_categoria`
--

DROP TABLE IF EXISTS `def_paquete_categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_paquete_categoria` (
  `iddef_paquete_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `iddef_paquete` int(11) NOT NULL DEFAULT '0',
  `iddef_categoria` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_paquete_categoria`),
  KEY `fk_def_paquete_categoria_1_idx` (`iddef_paquete`),
  KEY `fk_def_paquete_categoria_2_idx` (`iddef_categoria`),
  CONSTRAINT `fk_def_paquete_categoria_1` FOREIGN KEY (`iddef_paquete`) REFERENCES `def_paquete` (`iddef_paquete`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_def_paquete_categoria_2` FOREIGN KEY (`iddef_categoria`) REFERENCES `def_categoria` (`iddef_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `def_paquete_categoria`
--

LOCK TABLES `def_paquete_categoria` WRITE;
/*!40000 ALTER TABLE `def_paquete_categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `def_paquete_categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_restriccion`
--

DROP TABLE IF EXISTS `def_restriccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_restriccion` (
  `iddef_restriccion` int(11) NOT NULL AUTO_INCREMENT,
  `iddef_actividad` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_restriccion`),
  KEY `fk_def_restriccion_1_idx` (`iddef_actividad`),
  CONSTRAINT `fk_def_restriccion_1` FOREIGN KEY (`iddef_actividad`) REFERENCES `def_actividad` (`iddef_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `def_restriccion`
--

LOCK TABLES `def_restriccion` WRITE;
/*!40000 ALTER TABLE `def_restriccion` DISABLE KEYS */;
INSERT INTO `def_restriccion` VALUES (1,1,'Hipertencion',1,'2020-02-15 09:25:04','admin','admin','2020-02-15 09:35:54'),(2,2,'Mayores 18 años',1,'2020-02-15 11:01:27','admin',' ','2020-02-15 11:01:27'),(3,16,'No embarazo',1,'2020-02-15 11:07:13','admin',' ','2020-02-15 11:07:13'),(4,2,'No embarzadas',1,'2020-02-15 13:14:22','admin','admin','2020-02-15 13:15:05');
/*!40000 ALTER TABLE `def_restriccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_servicio`
--

DROP TABLE IF EXISTS `def_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_servicio` (
  `iddef_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `iddef_actividad` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_servicio`),
  KEY `fk_def_servicio_1_idx` (`iddef_actividad`),
  CONSTRAINT `fk_def_servicio_1` FOREIGN KEY (`iddef_actividad`) REFERENCES `def_actividad` (`iddef_actividad`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `def_servicio`
--

LOCK TABLES `def_servicio` WRITE;
/*!40000 ALTER TABLE `def_servicio` DISABLE KEYS */;
INSERT INTO `def_servicio` VALUES (1,2,'Baño',1,'2020-02-15 13:15:16','admin','admin','2020-02-15 13:15:20'),(2,2,'Toallas',1,'2020-02-15 13:15:26','admin',' ','2020-02-15 13:15:26');
/*!40000 ALTER TABLE `def_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `def_unidad_negocio`
--

DROP TABLE IF EXISTS `def_unidad_negocio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `def_unidad_negocio` (
  `iddef_unidad_negocio` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL DEFAULT ' ',
  `estado` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 => inactivo\n1 => Activo\n2 => cancelado\n',
  `fecha_creacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de Creación',
  `usuario_creacion` varchar(45) NOT NULL DEFAULT ' ',
  `usuario_ultima_modificacion` varchar(45) NOT NULL DEFAULT ' ',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '1000-01-01 00:00:00' COMMENT 'Fecha de la ultima modificación',
  PRIMARY KEY (`iddef_unidad_negocio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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

-- Dump completed on 2020-02-15 13:17:49
