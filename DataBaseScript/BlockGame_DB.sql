-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: BlockGame_DB
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Create and use BlockGame_DB database
CREATE DATABASE IF NOT EXISTS BlockGame_DB;
USE BlockGame_DB;

--
-- Table structure for table `difficulty`
--
DROP TABLE IF EXISTS `difficulty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `difficulty` (
  `id` int NOT NULL AUTO_INCREMENT,
  `difficulty` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `difficulty` (`difficulty`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `difficulty`
--

LOCK TABLES `difficulty` WRITE;
/*!40000 ALTER TABLE `difficulty` DISABLE KEYS */;
INSERT INTO `difficulty` VALUES (1,'easy'),(3,'hard'),(2,'medium');
/*!40000 ALTER TABLE `difficulty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `games`
--

DROP TABLE IF EXISTS `games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `dif_id` int NOT NULL,
  `score` int NOT NULL,
  `finished_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `game_finished` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_difficulty` (`dif_id`),
  KEY `FK_user` (`user_id`),
  CONSTRAINT `FK_difficulty` FOREIGN KEY (`dif_id`) REFERENCES `difficulty` (`id`),
  CONSTRAINT `FK_user` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `games`
--

-- LOCK TABLES `games` WRITE;
-- /*!40000 ALTER TABLE `games` DISABLE KEYS */;
-- INSERT INTO `games` VALUES (1,8,1,60,'2024-02-19 15:20:19',1),(2,8,1,20,'2024-02-19 15:23:14',0),(3,9,1,70,'2024-02-19 15:25:15',1),(4,9,1,20,'2024-02-19 15:26:05',0),(5,9,1,200,'2024-02-19 15:32:04',1),(6,9,1,150,'2024-02-19 15:32:53',1),(7,9,1,200,'2024-02-19 15:35:01',1),(8,9,1,150,'2024-02-19 15:38:50',1),(9,9,1,190,'2024-02-19 15:40:31',1),(10,9,1,170,'2024-02-19 15:47:12',1),(11,9,1,150,'2024-02-19 15:47:56',1),(12,9,1,30,'2024-02-19 15:48:33',0),(13,9,1,130,'2024-02-19 15:51:49',0),(14,9,1,0,'2024-02-19 15:51:55',0),(15,9,1,100,'2024-02-19 15:56:44',0),(16,9,1,130,'2024-02-19 16:02:31',0),(17,9,1,0,'2024-02-19 16:02:48',0),(18,9,1,30,'2024-02-19 16:03:50',0),(19,9,1,160,'2024-02-19 16:05:00',1),(20,8,1,170,'2024-02-19 16:52:13',1),(21,9,1,150,'2024-02-22 14:46:06',1),(22,10,1,150,'2024-02-23 15:34:37',1),(23,10,1,160,'2024-02-23 15:35:17',0),(24,10,1,160,'2024-02-23 15:36:16',1),(25,10,1,150,'2024-02-23 15:38:03',1),(26,10,1,140,'2024-02-23 15:45:20',1),(27,10,1,170,'2024-02-23 15:48:26',1),(28,10,1,170,'2024-02-23 15:48:27',0),(29,10,1,180,'2024-02-23 15:49:34',1),(30,10,1,20,'2024-02-23 15:51:58',0),(31,10,1,70,'2024-02-23 16:14:18',1),(32,10,1,150,'2024-02-23 16:19:11',1),(33,10,1,70,'2024-02-23 16:20:26',0),(34,10,1,140,'2024-02-23 16:23:45',1),(35,10,1,90,'2024-02-23 16:42:22',1),(36,10,1,250,'2024-02-23 16:55:33',1),(37,8,1,270,'2024-03-01 14:51:44',1),(38,8,1,0,'2024-03-01 14:51:53',0),(39,8,1,0,'2024-03-01 16:36:42',0),(40,8,1,310,'2024-03-01 16:38:03',1),(41,11,1,240,'2024-03-02 12:28:01',1),(42,11,1,150,'2024-03-02 12:31:22',0),(43,11,1,0,'2024-03-02 12:34:55',0),(44,11,1,0,'2024-03-02 12:49:03',0),(45,11,1,0,'2024-03-02 13:02:02',0),(46,11,1,0,'2024-03-02 13:04:24',1);
-- /*!40000 ALTER TABLE `games` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_log` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

-- LOCK TABLES `usuarios` WRITE;
-- /*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
-- INSERT INTO `usuarios` VALUES (8,'miNombrateq','miOTRqemail@mail.com','$2y$10$0JtzNkl2Xb8OUoKLPpAW8e/PCI2GMZWzcylHT8oHXyYjWMjPfcpHK',0,'2024-02-18 16:45:08','2024-03-02 16:27:46'),(9,'nuevoNombre69','nuevoMail420@mail.com','$2y$10$9RvuCiJyvgkJ3.e36k0xsu9kLm9/4Llxu5IE8AgVngeCOAMiksgsO',0,'2024-02-19 15:24:48','2024-02-22 17:10:36'),(10,'meGustanLosViernes','viernes@mail.com','$2y$10$r3rcjsK99S1tlA6f7owfdeuKE4MFGl38rOppj6GLWyG9J75xkdX9S',0,'2024-02-23 15:28:28','2024-02-23 15:28:28'),(11,'hernesto69','hernestomail@gmail.com','$2y$10$BrF4W62oB3JdKO5mWoiRz.U8MS95kBAOT3kEMb7yPonRs/tboCf2q',0,'2024-03-02 12:25:38','2024-03-02 12:26:52');
-- /*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
-- UNLOCK TABLES;

--
-- Table structure for table `usuariosToken`
--

DROP TABLE IF EXISTS `usuariosToken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuariosToken` (
  `id` int NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `id_usuario` int NOT NULL,
  `caducidad` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`id_usuario`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuariosToken`
--

LOCK TABLES `usuariosToken` WRITE;
/*!40000 ALTER TABLE `usuariosToken` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuariosToken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'BlockGame_DB'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-03 17:14:17
