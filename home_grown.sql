-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: home_grown
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

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

--
-- Current Database: `home_grown`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `home_grown` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `home_grown`;

--
-- Table structure for table `culture`
--

DROP TABLE IF EXISTS `culture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `culture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plant_type_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `soil_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seeds_qty` int NOT NULL,
  `harvested` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6A99CEBBFC546EA` (`plant_type_id`),
  CONSTRAINT `FK_B6A99CEBBFC546EA` FOREIGN KEY (`plant_type_id`) REFERENCES `plant_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `culture`
--

LOCK TABLES `culture` WRITE;
/*!40000 ALTER TABLE `culture` DISABLE KEYS */;
INSERT INTO `culture` VALUES (4,3,'Early Spring Basil ','2019-06-04','soil',6,1),(5,11,'Outdoor Parsley','2021-06-15','hydro',6,0),(8,9,'April Tulips','2021-04-29','soil',14,0),(9,3,'Thaï Basil','2021-07-01','soil',7,0),(10,12,'Orange Bud','2021-07-13','hydro',4,0);
/*!40000 ALTER TABLE `culture` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20210721085901','2021-07-21 10:59:07',453),('DoctrineMigrations\\Version20210721091020','2021-07-21 11:10:27',116),('DoctrineMigrations\\Version20210721091932','2021-07-21 11:19:34',122),('DoctrineMigrations\\Version20210721110103','2021-07-21 13:01:08',60),('DoctrineMigrations\\Version20210721162526','2021-07-21 18:25:33',54),('DoctrineMigrations\\Version20210721162829','2021-07-21 18:28:32',94),('DoctrineMigrations\\Version20210721165323','2021-07-21 18:53:31',114),('DoctrineMigrations\\Version20210722124316','2021-07-22 14:43:22',107),('DoctrineMigrations\\Version20210722124421','2021-07-22 14:44:23',142),('DoctrineMigrations\\Version20210722184324','2021-07-22 20:43:32',50);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plant_needs`
--

DROP TABLE IF EXISTS `plant_needs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plant_needs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plant_type_id` int NOT NULL,
  `light` int DEFAULT NULL,
  `water_per_day` double DEFAULT NULL,
  `culture_stage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_temperature` int DEFAULT NULL,
  `target_ph` double DEFAULT NULL,
  `target_ec` double DEFAULT NULL,
  `max_temperature` double DEFAULT NULL,
  `min_humidity` int DEFAULT NULL,
  `max_humidity` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_99832766BFC546EA` (`plant_type_id`),
  CONSTRAINT `FK_99832766BFC546EA` FOREIGN KEY (`plant_type_id`) REFERENCES `plant_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plant_needs`
--

LOCK TABLES `plant_needs` WRITE;
/*!40000 ALTER TABLE `plant_needs` DISABLE KEYS */;
INSERT INTO `plant_needs` VALUES (5,3,0,0,'sprout',2,7,1,24,30,40),(6,3,15,0.3,'growth',2,7,1,24,30,40),(7,3,15,0.8,'flowering',2,7,NULL,24,30,40),(11,9,12,NULL,'sprout',NULL,NULL,NULL,NULL,NULL,NULL),(12,9,NULL,NULL,'growth',NULL,NULL,NULL,NULL,NULL,NULL),(13,9,NULL,NULL,'flowering',NULL,NULL,NULL,NULL,NULL,NULL),(14,10,NULL,NULL,'sprout',NULL,NULL,NULL,NULL,NULL,NULL),(15,10,NULL,NULL,'growth',NULL,NULL,NULL,NULL,NULL,NULL),(16,10,NULL,NULL,'flowering',NULL,NULL,NULL,NULL,NULL,NULL),(17,11,4,0.2,'sprout',8,6,1,30,20,60),(18,11,16,1,'growth',9,6.4,1,34,20,60),(19,11,14,1.2,'flowering',12,6.4,1,31,20,64),(20,12,0,0.2,'sprout',12,6.2,1.1,25,40,70),(21,12,12,0.8,'growth',12,6.7,1.2,32,20,50),(22,12,16,1.3,'flowering',19,7,1.2,38,17,39),(23,13,NULL,NULL,'sprout',NULL,NULL,NULL,NULL,NULL,NULL),(24,13,NULL,NULL,'growth',NULL,NULL,NULL,NULL,NULL,NULL),(25,13,NULL,NULL,'flowering',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `plant_needs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plant_type`
--

DROP TABLE IF EXISTS `plant_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plant_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days_to_growth` int NOT NULL,
  `days_to_flowering` int NOT NULL,
  `days_to_harvest` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plant_type`
--

LOCK TABLES `plant_type` WRITE;
/*!40000 ALTER TABLE `plant_type` DISABLE KEYS */;
INSERT INTO `plant_type` VALUES (3,'Basil',14,48,50),(9,'Tulip',8,43,140),(10,'Arbre',3,3,2),(11,'Parsley',8,40,60),(12,'CBD',7,45,84),(13,'Carrot',15,70,70);
/*!40000 ALTER TABLE `plant_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-25 14:29:03
