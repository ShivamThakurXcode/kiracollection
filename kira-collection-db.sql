-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: kira_collection
-- ------------------------------------------------------
-- Server version	5.7.24

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'admin',NULL,'admin@kiracollection.com','$2y$10$1pvh1xA/1v8.QBprGEU7qepqmqfFhUnDvXRPsuee1fudU0yM7Bv6K','2026-05-13 23:15:29');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_tags`
--

DROP TABLE IF EXISTS `blog_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) NOT NULL,
  `tag` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `blog_tags_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_tags`
--

LOCK TABLES `blog_tags` WRITE;
/*!40000 ALTER TABLE `blog_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `category_color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'primary',
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `author` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `author_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `date` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `reading_time` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `comments` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_messages`
--

LOCK TABLES `contact_messages` WRITE;
/*!40000 ALTER TABLE `contact_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_additional_info`
--

DROP TABLE IF EXISTS `product_additional_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_additional_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `info_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_value` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_additional_info_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_additional_info`
--

LOCK TABLES `product_additional_info` WRITE;
/*!40000 ALTER TABLE `product_additional_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_additional_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_colors`
--

DROP TABLE IF EXISTS `product_colors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `color_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_hex` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `color_image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_colors_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_colors`
--

LOCK TABLES `product_colors` WRITE;
/*!40000 ALTER TABLE `product_colors` DISABLE KEYS */;
INSERT INTO `product_colors` VALUES (154,1,'Natural White','#F5F0E8',''),(155,1,'Cream Beige','#E8D5B7',''),(156,1,'Terracotta','#C67B5C',''),(157,2,'Natural White','#F5F0E8',''),(158,2,'Cream Beige','#E8D5B7',''),(159,2,'Terracotta','#C67B5C',''),(160,3,'Natural White','#F5F0E8',''),(161,3,'Cream Beige','#E8D5B7',''),(162,3,'Terracotta','#C67B5C',''),(163,4,'Natural White','#F5F0E8',''),(164,4,'Cream Beige','#E8D5B7',''),(165,4,'Terracotta','#C67B5C',''),(166,5,'Natural White','#F5F0E8',''),(167,5,'Cream Beige','#E8D5B7',''),(168,5,'Terracotta','#C67B5C',''),(169,6,'Natural White','#F5F0E8',''),(170,6,'Cream Beige','#E8D5B7',''),(171,6,'Terracotta','#C67B5C',''),(172,7,'Natural White','#F5F0E8',''),(173,7,'Cream Beige','#E8D5B7',''),(174,7,'Terracotta','#C67B5C',''),(175,8,'Natural White','#F5F0E8',''),(176,8,'Cream Beige','#E8D5B7',''),(177,8,'Terracotta','#C67B5C',''),(178,9,'Natural White','#F5F0E8',''),(179,9,'Cream Beige','#E8D5B7',''),(180,9,'Terracotta','#C67B5C',''),(181,10,'Natural White','#F5F0E8',''),(182,10,'Cream Beige','#E8D5B7',''),(183,10,'Terracotta','#C67B5C',''),(184,11,'Natural White','#F5F0E8',''),(185,11,'Cream Beige','#E8D5B7',''),(186,11,'Terracotta','#C67B5C',''),(187,12,'Natural White','#F5F0E8',''),(188,12,'Cream Beige','#E8D5B7',''),(189,12,'Terracotta','#C67B5C',''),(190,13,'Natural White','#F5F0E8',''),(191,13,'Cream Beige','#E8D5B7',''),(192,13,'Terracotta','#C67B5C',''),(193,14,'Natural White','#F5F0E8',''),(194,14,'Cream Beige','#E8D5B7',''),(195,14,'Terracotta','#C67B5C',''),(196,15,'Natural White','#F5F0E8',''),(197,15,'Cream Beige','#E8D5B7',''),(198,15,'Terracotta','#C67B5C',''),(199,16,'Natural White','#F5F0E8',''),(200,16,'Cream Beige','#E8D5B7',''),(201,16,'Terracotta','#C67B5C',''),(202,17,'Natural White','#F5F0E8',''),(203,17,'Cream Beige','#E8D5B7',''),(204,17,'Terracotta','#C67B5C',''),(205,18,'Natural White','#F5F0E8',''),(206,18,'Cream Beige','#E8D5B7',''),(207,18,'Terracotta','#C67B5C',''),(208,19,'Natural White','#F5F0E8',''),(209,19,'Cream Beige','#E8D5B7',''),(210,19,'Terracotta','#C67B5C',''),(211,20,'Natural White','#F5F0E8',''),(212,20,'Cream Beige','#E8D5B7',''),(213,20,'Terracotta','#C67B5C',''),(214,21,'Natural White','#F5F0E8',''),(215,21,'Cream Beige','#E8D5B7',''),(216,21,'Terracotta','#C67B5C',''),(217,22,'Natural White','#F5F0E8',''),(218,22,'Cream Beige','#E8D5B7',''),(219,22,'Terracotta','#C67B5C',''),(220,23,'Natural White','#F5F0E8',''),(221,23,'Cream Beige','#E8D5B7',''),(222,23,'Terracotta','#C67B5C',''),(223,24,'Natural White','#F5F0E8',''),(224,24,'Cream Beige','#E8D5B7',''),(225,24,'Terracotta','#C67B5C',''),(226,25,'Natural White','#F5F0E8',''),(227,25,'Cream Beige','#E8D5B7',''),(228,25,'Terracotta','#C67B5C',''),(229,26,'Natural White','#F5F0E8',''),(230,26,'Cream Beige','#E8D5B7',''),(231,26,'Terracotta','#C67B5C',''),(232,27,'Natural White','#F5F0E8',''),(233,27,'Cream Beige','#E8D5B7',''),(234,27,'Terracotta','#C67B5C',''),(235,28,'Natural White','#F5F0E8',''),(236,28,'Cream Beige','#E8D5B7',''),(237,28,'Terracotta','#C67B5C',''),(238,29,'Natural White','#F5F0E8',''),(239,29,'Cream Beige','#E8D5B7',''),(240,29,'Terracotta','#C67B5C',''),(241,30,'Natural White','#F5F0E8',''),(242,30,'Cream Beige','#E8D5B7',''),(243,30,'Terracotta','#C67B5C',''),(244,31,'Natural White','#F5F0E8',''),(245,31,'Cream Beige','#E8D5B7',''),(246,31,'Terracotta','#C67B5C',''),(247,32,'Natural White','#F5F0E8',''),(248,32,'Cream Beige','#E8D5B7',''),(249,32,'Terracotta','#C67B5C',''),(250,33,'Natural White','#F5F0E8',''),(251,33,'Cream Beige','#E8D5B7',''),(252,33,'Terracotta','#C67B5C',''),(253,34,'Natural White','#F5F0E8',''),(254,34,'Cream Beige','#E8D5B7',''),(255,34,'Terracotta','#C67B5C',''),(256,35,'Natural White','#F5F0E8',''),(257,35,'Cream Beige','#E8D5B7',''),(258,35,'Terracotta','#C67B5C',''),(259,36,'Natural White','#F5F0E8',''),(260,36,'Cream Beige','#E8D5B7',''),(261,36,'Terracotta','#C67B5C',''),(262,37,'Natural White','#F5F0E8',''),(263,37,'Cream Beige','#E8D5B7',''),(264,37,'Terracotta','#C67B5C',''),(265,38,'Natural White','#F5F0E8',''),(266,38,'Cream Beige','#E8D5B7',''),(267,38,'Terracotta','#C67B5C',''),(268,39,'Natural White','#F5F0E8',''),(269,39,'Cream Beige','#E8D5B7',''),(270,39,'Terracotta','#C67B5C',''),(271,40,'Natural White','#F5F0E8',''),(272,40,'Cream Beige','#E8D5B7',''),(273,40,'Terracotta','#C67B5C',''),(274,41,'Natural White','#F5F0E8',''),(275,41,'Cream Beige','#E8D5B7',''),(276,41,'Terracotta','#C67B5C',''),(277,42,'Natural White','#F5F0E8',''),(278,42,'Cream Beige','#E8D5B7',''),(279,42,'Terracotta','#C67B5C',''),(280,43,'Natural White','#F5F0E8',''),(281,43,'Cream Beige','#E8D5B7',''),(282,43,'Terracotta','#C67B5C',''),(283,44,'Natural White','#F5F0E8',''),(284,44,'Cream Beige','#E8D5B7',''),(285,44,'Terracotta','#C67B5C',''),(286,45,'Natural White','#F5F0E8',''),(287,45,'Cream Beige','#E8D5B7',''),(288,45,'Terracotta','#C67B5C',''),(289,46,'Natural White','#F5F0E8',''),(290,46,'Cream Beige','#E8D5B7',''),(291,46,'Terracotta','#C67B5C',''),(292,47,'Natural White','#F5F0E8',''),(293,47,'Cream Beige','#E8D5B7',''),(294,47,'Terracotta','#C67B5C',''),(295,48,'Natural White','#F5F0E8',''),(296,48,'Cream Beige','#E8D5B7',''),(297,48,'Terracotta','#C67B5C',''),(298,49,'Natural White','#F5F0E8',''),(299,49,'Cream Beige','#E8D5B7',''),(300,49,'Terracotta','#C67B5C',''),(301,50,'Natural White','#F5F0E8',''),(302,50,'Cream Beige','#E8D5B7',''),(303,50,'Terracotta','#C67B5C',''),(304,51,'Natural White','#F5F0E8',''),(305,51,'Cream Beige','#E8D5B7',''),(306,51,'Terracotta','#C67B5C','');
/*!40000 ALTER TABLE `product_colors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `size_label` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimension` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `price_multiplier` decimal(3,1) DEFAULT '1.0',
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=413 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_sizes`
--

LOCK TABLES `product_sizes` WRITE;
/*!40000 ALTER TABLE `product_sizes` DISABLE KEYS */;
INSERT INTO `product_sizes` VALUES (206,1,'Small','6\" - 8\"',0.6),(207,1,'Medium','10\" - 14\"',1.0),(208,1,'Large','16\" - 24\"',1.6),(209,1,'Extra Large','30\" - 36\"',2.4),(210,2,'Small','6\" - 8\"',0.6),(211,2,'Medium','10\" - 14\"',1.0),(212,2,'Large','16\" - 24\"',1.6),(213,2,'Extra Large','30\" - 36\"',2.4),(214,3,'Small','6\" - 8\"',0.6),(215,3,'Medium','10\" - 14\"',1.0),(216,3,'Large','16\" - 24\"',1.6),(217,3,'Extra Large','30\" - 36\"',2.4),(218,4,'Small','6\" - 8\"',0.6),(219,4,'Medium','10\" - 14\"',1.0),(220,4,'Large','16\" - 24\"',1.6),(221,4,'Extra Large','30\" - 36\"',2.4),(222,5,'Small','6\" - 8\"',0.6),(223,5,'Medium','10\" - 14\"',1.0),(224,5,'Large','16\" - 24\"',1.6),(225,5,'Extra Large','30\" - 36\"',2.4),(226,6,'Small','6\" - 8\"',0.6),(227,6,'Medium','10\" - 14\"',1.0),(228,6,'Large','16\" - 24\"',1.6),(229,6,'Extra Large','30\" - 36\"',2.4),(230,7,'Small','6\" - 8\"',0.6),(231,7,'Medium','10\" - 14\"',1.0),(232,7,'Large','16\" - 24\"',1.6),(233,7,'Extra Large','30\" - 36\"',2.4),(234,8,'Small','6\" - 8\"',0.6),(235,8,'Medium','10\" - 14\"',1.0),(236,8,'Large','16\" - 24\"',1.6),(237,8,'Extra Large','30\" - 36\"',2.4),(238,9,'Small','6\" - 8\"',0.6),(239,9,'Medium','10\" - 14\"',1.0),(240,9,'Large','16\" - 24\"',1.6),(241,9,'Extra Large','30\" - 36\"',2.4),(242,10,'Small','6\" - 8\"',0.6),(243,10,'Medium','10\" - 14\"',1.0),(244,10,'Large','16\" - 24\"',1.6),(245,10,'Extra Large','30\" - 36\"',2.4),(246,11,'Small','6\" - 8\"',0.6),(247,11,'Medium','10\" - 14\"',1.0),(248,11,'Large','16\" - 24\"',1.6),(249,11,'Extra Large','30\" - 36\"',2.4),(250,12,'Small','6\" - 8\"',0.6),(251,12,'Medium','10\" - 14\"',1.0),(252,12,'Large','16\" - 24\"',1.6),(253,12,'Extra Large','30\" - 36\"',2.4),(254,13,'Small','6\" - 8\"',0.6),(255,13,'Medium','10\" - 14\"',1.0),(256,13,'Large','16\" - 24\"',1.6),(257,13,'Extra Large','30\" - 36\"',2.4),(258,14,'Small','6\" - 8\"',0.6),(259,14,'Medium','10\" - 14\"',1.0),(260,14,'Large','16\" - 24\"',1.6),(261,14,'Extra Large','30\" - 36\"',2.4),(262,15,'Small','6\" - 8\"',0.6),(263,15,'Medium','10\" - 14\"',1.0),(264,15,'Large','16\" - 24\"',1.6),(265,15,'Extra Large','30\" - 36\"',2.4),(266,16,'Small','6\" - 8\"',0.6),(267,16,'Medium','10\" - 14\"',1.0),(268,16,'Large','16\" - 24\"',1.6),(269,16,'Extra Large','30\" - 36\"',2.4),(270,17,'Small','6\" - 8\"',0.6),(271,17,'Medium','10\" - 14\"',1.0),(272,17,'Large','16\" - 24\"',1.6),(273,17,'Extra Large','30\" - 36\"',2.4),(274,18,'Small','6\" - 8\"',0.6),(275,18,'Medium','10\" - 14\"',1.0),(276,18,'Large','16\" - 24\"',1.6),(277,18,'Extra Large','30\" - 36\"',2.4),(278,19,'Small','6\" - 8\"',0.6),(279,19,'Medium','10\" - 14\"',1.0),(280,19,'Large','16\" - 24\"',1.6),(281,19,'Extra Large','30\" - 36\"',2.4),(282,20,'Small','6\" - 8\"',0.6),(283,20,'Medium','10\" - 14\"',1.0),(284,20,'Large','16\" - 24\"',1.6),(285,20,'Extra Large','30\" - 36\"',2.4),(286,21,'Small','6\" - 8\"',0.6),(287,21,'Medium','10\" - 14\"',1.0),(288,21,'Large','16\" - 24\"',1.6),(289,21,'Extra Large','30\" - 36\"',2.4),(290,22,'Small','6\" - 8\"',0.6),(291,22,'Medium','10\" - 14\"',1.0),(292,22,'Large','16\" - 24\"',1.6),(293,22,'Extra Large','30\" - 36\"',2.4),(294,23,'Small','6\" - 8\"',0.6),(295,23,'Medium','10\" - 14\"',1.0),(296,23,'Large','16\" - 24\"',1.6),(297,23,'Extra Large','30\" - 36\"',2.4),(298,24,'Small','6\" - 8\"',0.6),(299,24,'Medium','10\" - 14\"',1.0),(300,24,'Large','16\" - 24\"',1.6),(301,24,'Extra Large','30\" - 36\"',2.4),(302,25,'Small','6\" - 8\"',0.6),(303,25,'Medium','10\" - 14\"',1.0),(304,25,'Large','16\" - 24\"',1.6),(305,25,'Extra Large','30\" - 36\"',2.4),(306,26,'Small','6\" - 8\"',0.6),(307,26,'Medium','10\" - 14\"',1.0),(308,26,'Large','16\" - 24\"',1.6),(309,26,'Extra Large','30\" - 36\"',2.4),(310,27,'Small','6\" - 8\"',0.6),(311,27,'Medium','10\" - 14\"',1.0),(312,27,'Large','16\" - 24\"',1.6),(313,27,'Extra Large','30\" - 36\"',2.4),(314,28,'Small','6\" - 8\"',0.6),(315,28,'Medium','10\" - 14\"',1.0),(316,28,'Large','16\" - 24\"',1.6),(317,28,'Extra Large','30\" - 36\"',2.4),(318,29,'Small','6\" - 8\"',0.6),(319,29,'Medium','10\" - 14\"',1.0),(320,29,'Large','16\" - 24\"',1.6),(321,29,'Extra Large','30\" - 36\"',2.4),(322,30,'Small','6\" - 8\"',0.6),(323,30,'Medium','10\" - 14\"',1.0),(324,30,'Large','16\" - 24\"',1.6),(325,30,'Extra Large','30\" - 36\"',2.4),(326,31,'Small','6\" - 8\"',0.6),(327,31,'Medium','10\" - 14\"',1.0),(328,31,'Large','16\" - 24\"',1.6),(329,31,'Extra Large','30\" - 36\"',2.4),(330,32,'Small','6\" - 8\"',0.6),(331,32,'Medium','10\" - 14\"',1.0),(332,32,'Large','16\" - 24\"',1.6),(333,32,'Extra Large','30\" - 36\"',2.4),(334,33,'Small','6\" - 8\"',0.6),(335,33,'Medium','10\" - 14\"',1.0),(336,33,'Large','16\" - 24\"',1.6),(337,33,'Extra Large','30\" - 36\"',2.4),(338,34,'Small','6\" - 8\"',0.6),(339,34,'Medium','10\" - 14\"',1.0),(340,34,'Large','16\" - 24\"',1.6),(341,34,'Extra Large','30\" - 36\"',2.4),(342,35,'Small','6\" - 8\"',0.6),(343,35,'Medium','10\" - 14\"',1.0),(344,35,'Large','16\" - 24\"',1.6),(345,35,'Extra Large','30\" - 36\"',2.4),(346,36,'Small','6\" - 8\"',0.6),(347,36,'Medium','10\" - 14\"',1.0),(348,36,'Large','16\" - 24\"',1.6),(349,36,'Extra Large','30\" - 36\"',2.4),(350,37,'Small','6\" - 8\"',0.6),(351,37,'Medium','10\" - 14\"',1.0),(352,37,'Large','16\" - 24\"',1.6),(353,37,'Extra Large','30\" - 36\"',2.4),(354,38,'Small','6\" - 8\"',0.6),(355,38,'Medium','10\" - 14\"',1.0),(356,38,'Large','16\" - 24\"',1.6),(357,38,'Extra Large','30\" - 36\"',2.4),(358,39,'Small','6\" - 8\"',0.6),(359,39,'Medium','10\" - 14\"',1.0),(360,39,'Large','16\" - 24\"',1.6),(361,39,'Extra Large','30\" - 36\"',2.4),(362,40,'Small','6\" - 8\"',0.6),(363,40,'Medium','10\" - 14\"',1.0),(364,40,'Large','16\" - 24\"',1.6),(365,40,'Extra Large','30\" - 36\"',2.4),(366,41,'Small','6\" - 8\"',0.6),(367,41,'Medium','10\" - 14\"',1.0),(368,41,'Large','16\" - 24\"',1.6),(369,41,'Extra Large','30\" - 36\"',2.4),(370,42,'Small','6\" - 8\"',0.6),(371,42,'Medium','10\" - 14\"',1.0),(372,42,'Large','16\" - 24\"',1.6),(373,42,'Extra Large','30\" - 36\"',2.4),(374,43,'Small','6\" - 8\"',0.6),(375,43,'Medium','10\" - 14\"',1.0),(376,43,'Large','16\" - 24\"',1.6),(377,43,'Extra Large','30\" - 36\"',2.4),(378,44,'Small','6\" - 8\"',0.6),(379,44,'Medium','10\" - 14\"',1.0),(380,44,'Large','16\" - 24\"',1.6),(381,44,'Extra Large','30\" - 36\"',2.4),(382,45,'Small','6\" - 8\"',0.6),(383,45,'Medium','10\" - 14\"',1.0),(384,45,'Large','16\" - 24\"',1.6),(385,45,'Extra Large','30\" - 36\"',2.4),(386,46,'Small','6\" - 8\"',0.6),(387,46,'Medium','10\" - 14\"',1.0),(388,46,'Large','16\" - 24\"',1.6),(389,46,'Extra Large','30\" - 36\"',2.4),(390,47,'Small','6\" - 8\"',0.6),(391,47,'Medium','10\" - 14\"',1.0),(392,47,'Large','16\" - 24\"',1.6),(393,47,'Extra Large','30\" - 36\"',2.4),(394,48,'Small','6\" - 8\"',0.6),(395,48,'Medium','10\" - 14\"',1.0),(396,48,'Large','16\" - 24\"',1.6),(397,48,'Extra Large','30\" - 36\"',2.4),(398,49,'Small','6\" - 8\"',0.6),(399,49,'Medium','10\" - 14\"',1.0),(400,49,'Large','16\" - 24\"',1.6),(401,49,'Extra Large','30\" - 36\"',2.4),(402,50,'Small','6\" - 8\"',0.6),(403,50,'Medium','10\" - 14\"',1.0),(404,50,'Large','16\" - 24\"',1.6),(405,50,'Extra Large','30\" - 36\"',2.4),(406,51,'Small','6\" - 8\"',0.6),(407,51,'Medium','10\" - 14\"',1.0),(408,51,'Large','16\" - 24\"',1.6),(409,51,'Extra Large','30\" - 36\"',2.4);
/*!40000 ALTER TABLE `product_sizes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Lippan Art',
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `current_price` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `old_price` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `discount_percentage` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `discount_badge` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `rating` decimal(2,1) DEFAULT '0.0',
  `reviews` int(11) DEFAULT '0',
  `sold` int(11) DEFAULT '0',
  `available` int(11) DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `materials` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `dimensions` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `weight` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `care_instructions` text COLLATE utf8mb4_unicode_ci,
  `sku` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Traditional Lippan Art Mirror Frame - Peacock Design','Lippan Art','images/product/p-1.jpeg','₹2,499','₹3,199','22% OFF','BESTSELLER',5.0,234,89,45,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-001','2026-05-17 01:53:38','2026-05-17 01:53:38'),(2,'Sacred Geometry Mandala Wall Art - Lotus','Mandala Art','images/product/p-2.png','₹1,899','₹2,499','24% OFF','SALES',4.5,178,67,60,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-002','2026-05-17 01:53:38','2026-05-17 01:53:38'),(3,'Handcrafted Lippan Art Wall Panel - Tree of Life','Lippan Art','images/product/p-3.jpeg','₹4,999','','','NEW',5.0,56,12,20,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-003','2026-05-17 01:53:38','2026-05-17 01:53:38'),(4,'Dot Mandala Coaster Set - Pack of 6','Mandala Art','images/product/p-1.jpeg','₹699','₹899','22% OFF','SALES',4.5,312,145,200,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-004','2026-05-17 01:53:38','2026-05-17 01:53:38'),(5,'Lippan Art Decorative Plate - Circular Motif','Lippan Art','images/product/p-2.png','₹999','','','',4.0,98,54,80,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-005','2026-05-17 01:53:38','2026-05-17 01:53:38'),(6,'Large Mandala Canvas Print - Cosmic Spiral (24\")','Mandala Art','images/product/p-3.jpeg','₹3,499','₹4,299','19% OFF','POPULAR',5.0,456,123,35,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-006','2026-05-17 01:53:38','2026-05-17 01:53:38'),(7,'Lippan Art Room Divider Panel - 3 Panel Set','Lippan Art','images/product/p-1.jpeg','₹8,999','','','PREMIUM',5.0,89,18,10,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-007','2026-05-17 01:53:38','2026-05-17 01:53:38'),(8,'Mandala Wooden Wall Clock - 16\" Diameter','Mandala Art','images/product/p-2.png','₹2,199','₹2,799','21% OFF','SALES',4.5,267,78,40,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-008','2026-05-17 01:53:38','2026-05-17 01:53:38'),(9,'Mini Lippan Art Frame Set - Pack of 3 (8\" each)','Lippan Art','images/product/p-3.jpeg','₹1,499','','','',4.5,198,92,110,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-009','2026-05-17 01:53:38','2026-05-17 01:53:38'),(10,'Mandala Dreamcatcher Wall Hanging - Feather Design','Mandala Art','images/product/p-1.jpeg','₹1,299','₹1,699','24% OFF','SALES',4.5,334,156,75,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-010','2026-05-17 01:53:38','2026-05-17 01:53:38'),(11,'Lippan Art Photo Frame - 12\" x 16\" with Mirror Work','Lippan Art','images/product/p-2.png','₹1,799','','','',4.0,145,63,55,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-011','2026-05-17 01:53:39','2026-05-17 01:53:39'),(12,'Lippan Art Round Wall Plate - 18\" with Traditional Motifs','Lippan Art','images/product/p-3.jpeg','₹2,299','₹2,999','23% OFF','HOT',5.0,289,167,50,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-012','2026-05-17 01:53:39','2026-05-17 01:53:39'),(13,'Dot Mandala Painted Tray - Serving & Decor (14\")','Mandala Art','images/product/p-1.jpeg','₹899','','','',4.5,213,134,90,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-013','2026-05-17 01:53:39','2026-05-17 01:53:39'),(14,'Lippan Art Entrance Door Frame Decor - 36\" x 80\"','Lippan Art','images/product/p-2.png','₹6,499','₹8,499','24% OFF','SALES',5.0,76,28,15,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-014','2026-05-17 01:53:39','2026-05-17 01:53:39'),(15,'Mandala String Art - Heart Pattern (12\")','Mandala Art','images/product/p-3.jpeg','₹1,199','','','TRENDING',5.0,423,201,120,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-015','2026-05-17 01:53:39','2026-05-17 01:53:39'),(16,'Lippan Art Pooja Room Panel - Om & Swastik Design','Lippan Art','images/product/p-1.jpeg','₹3,799','₹4,999','24% OFF','SALES',5.0,167,74,30,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-016','2026-05-17 01:53:39','2026-05-17 01:53:39'),(17,'Mandala LED Backlit Wall Art - Glowing Spiral (20\")','Mandala Art','images/product/p-2.png','₹2,999','','','NEW',4.5,92,41,35,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-017','2026-05-17 01:53:39','2026-05-17 01:53:39'),(18,'Grand Lippan Art Feature Wall Kit - 8ft x 10ft','Lippan Art','images/product/p-3.jpeg','₹14,999','₹19,999','25% OFF','DEAL',5.0,34,8,10,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-018','2026-05-17 01:53:39','2026-05-17 01:53:39'),(19,'Mandala MDF Cutout Set - DIY Painting (6\" Set of 8)','Mandala Art','images/product/p-1.jpeg','₹599','','','',4.0,156,234,300,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-019','2026-05-17 01:53:39','2026-05-17 01:53:39'),(20,'Lippan Art TV Unit Backdrop Panel - 6ft x 4ft','Lippan Art','images/product/p-2.png','₹9,999','₹12,999','23% OFF','SALES',5.0,45,14,12,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-020','2026-05-17 01:53:39','2026-05-17 01:53:39'),(21,'Mandala Stained Glass Suncatcher - Rainbow (10\")','Mandala Art','images/product/p-3.jpeg','₹1,599','','','',4.5,189,87,65,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-021','2026-05-17 01:53:39','2026-05-17 01:53:39'),(22,'Lippan Art Mirror Frame - Floral Border Design (12\" Round)','Lippan Art','images/product/p-1.jpeg','₹1,899','₹2,399','21% OFF','',5.0,367,189,70,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-022','2026-05-17 01:53:39','2026-05-17 01:53:39'),(23,'Mandala Wall Painting - Acrylic on Canvas (18\" Square)','Mandala Art','images/product/p-2.png','₹2,799','₹3,499','20% OFF','',5.0,298,145,40,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-023','2026-05-17 01:53:39','2026-05-17 01:53:39'),(24,'Lippan Art Rectangle Panel - Elephant Motif (24\" x 18\")','Lippan Art','images/product/p-3.jpeg','₹3,299','₹4,199','21% OFF','',4.5,234,112,35,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-024','2026-05-17 01:53:39','2026-05-17 01:53:39'),(25,'Mandala Table Lamp - Ceramic Handpainted (8\" Height)','Mandala Art','images/product/p-1.jpeg','₹1,499','₹1,899','21% OFF','',4.5,421,198,55,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-025','2026-05-17 01:53:39','2026-05-17 01:53:39'),(26,'Lippan Art Key Holder - Multi Hook with Mirror (16\")','Lippan Art','images/product/p-2.png','₹999','₹1,299','23% OFF','',4.5,345,223,90,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-026','2026-05-17 01:53:39','2026-05-17 01:53:39'),(27,'Mandala Bookmark Set - Handpainted Metal (Set of 5)','Mandala Art','images/product/p-3.jpeg','₹399','₹499','20% OFF','',5.0,512,389,250,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-027','2026-05-17 01:53:39','2026-05-17 01:53:39'),(28,'Lippan Art Square Mirror - Geometric Pattern (10\")','Lippan Art','images/product/p-1.jpeg','₹1,599','₹1,999','20% OFF','',4.5,178,76,65,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-028','2026-05-17 01:53:40','2026-05-17 01:53:40'),(29,'Mandala Wall Decal - Removable Vinyl (30\" Circle)','Mandala Art','images/product/p-2.png','₹799','₹999','20% OFF','',4.0,234,156,180,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-029','2026-05-17 01:53:40','2026-05-17 01:53:40'),(30,'Lippan Art Circle Frame - Abstract Waves (14\" Round)','Lippan Art','images/product/p-3.jpeg','₹2,099','','','',4.5,145,58,45,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-030','2026-05-17 01:53:40','2026-05-17 01:53:40'),(31,'Mandala Stone Painting Set - River Rock Art (Set of 4)','Mandala Art','images/product/p-1.jpeg','₹849','₹1,099','23% OFF','',5.0,267,134,100,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-031','2026-05-17 01:53:40','2026-05-17 01:53:40'),(32,'Lippan Art Headboard Panel - King Size (6ft Width)','Lippan Art','images/product/p-2.png','₹7,999','₹9,999','20% OFF','',5.0,67,19,12,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-032','2026-05-17 01:53:40','2026-05-17 01:53:40'),(33,'Mandala Wind Chime - Bamboo & Metal (22\" Length)','Mandala Art','images/product/p-3.jpeg','₹699','','','',4.0,189,98,120,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-033','2026-05-17 01:53:40','2026-05-17 01:53:40'),(34,'Lippan Art Tray - Serving with Handles (16\" Oval)','Lippan Art','images/product/p-1.jpeg','₹1,299','₹1,699','24% OFF','',4.5,156,72,55,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-034','2026-05-17 01:53:40','2026-05-17 01:53:40'),(35,'Mandala Journal - Handbound Leather (6\" x 8\")','Mandala Art','images/product/p-2.png','₹599','','','',4.5,298,167,140,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-035','2026-05-17 01:53:40','2026-05-17 01:53:40'),(36,'Lippan Art Console Table Top - Inlay Work (36\" x 18\")','Lippan Art','images/product/p-3.jpeg','₹5,499','₹6,999','21% OFF','',5.0,45,11,18,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-036','2026-05-17 01:53:40','2026-05-17 01:53:40'),(37,'Mandala Phone Stand - Resin Handmade (4\" Base)','Mandala Art','images/product/p-1.jpeg','₹449','₹599','25% OFF','',4.0,378,245,200,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-037','2026-05-17 01:53:40','2026-05-17 01:53:40'),(38,'Lippan Art Hexagon Shelf Set - Wall Mounted (3 Pieces, 8\" each)','Lippan Art','images/product/p-2.png','₹1,799','₹2,499','28% OFF','FLASH',4.5,198,87,25,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-038','2026-05-17 01:53:40','2026-05-17 01:53:40'),(39,'Mandala Tapestry - Cotton Printed (60\" x 90\")','Mandala Art','images/product/p-3.jpeg','₹899','₹1,499','40% OFF','FLASH',4.5,345,178,40,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-039','2026-05-17 01:53:40','2026-05-17 01:53:40'),(40,'Lippan Art Clock - Round with Mirror Pieces (16\")','Lippan Art','images/product/p-1.jpeg','₹1,999','₹2,799','29% OFF','FLASH',5.0,223,98,20,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-040','2026-05-17 01:53:40','2026-05-17 01:53:40'),(41,'Mandala Candle Holder Set - Iron Craft (Set of 3, 4\"/6\"/8\")','Mandala Art','images/product/p-2.png','₹1,099','₹1,699','35% OFF','FLASH',4.5,267,134,35,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-041','2026-05-17 01:53:40','2026-05-17 01:53:40'),(42,'Lippan Art Coaster Set - Pack of 4 with Holder (4\" each)','Lippan Art','images/product/p-3.jpeg','₹599','₹999','40% OFF','FLASH',4.0,412,267,60,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-042','2026-05-17 01:53:41','2026-05-17 01:53:41'),(43,'Mandala Floating Shelf - Wooden Cutout (12\" x 12\")','Mandala Art','images/product/p-1.jpeg','₹799','₹1,199','33% OFF','FLASH',4.0,156,78,30,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-043','2026-05-17 01:53:41','2026-05-17 01:53:41'),(44,'Lippan Art Name Plate - Customizable (18\" x 6\")','Lippan Art','images/product/p-2.png','₹899','₹1,399','36% OFF','FLASH',5.0,534,312,80,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-044','2026-05-17 01:53:41','2026-05-17 01:53:41'),(45,'Mandala Table Runner - Handblock Printed (72\" x 14\")','Mandala Art','images/product/p-3.jpeg','₹649','₹999','35% OFF','FLASH',4.5,289,145,70,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-045','2026-05-17 01:53:41','2026-05-17 01:53:41'),(46,'Lippan Art Pendant Lamp Shade - Dome Shape (10\" Diameter)','Lippan Art','images/product/p-1.jpeg','₹1,499','₹2,199','32% OFF','FLASH',4.5,134,56,22,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-046','2026-05-17 01:53:41','2026-05-17 01:53:41'),(47,'Mandala Pot Set - Terracotta Handpainted (4\"/6\"/8\")','Mandala Art','images/product/p-2.png','₹1,199','₹1,899','37% OFF','FLASH',4.5,198,89,40,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-047','2026-05-17 01:53:41','2026-05-17 01:53:41'),(48,'Premium Lippan Art Wall Mural - Desert Scene (4ft x 6ft)','Lippan Art','images/product/p-3.jpeg','₹11,999','₹15,999','25% OFF','PREMIUM',5.0,23,6,8,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-048','2026-05-17 01:53:41','2026-05-17 01:53:41'),(49,'Sacred Mandala Thangka Style Painting - Gold Leaf (24\")','Mandala Art','images/product/p-1.jpeg','₹5,499','₹6,999','21% OFF','PREMIUM',5.0,67,28,15,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-049','2026-05-17 01:53:41','2026-05-17 01:53:41'),(50,'Lippan Art Ceiling Medallion - Circular Rosette (24\" Diameter)','Lippan Art','images/product/p-2.png','₹3,999','₹5,199','23% OFF','PREMIUM',5.0,34,9,12,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-050','2026-05-17 01:53:41','2026-05-17 01:53:41'),(51,'Mandala Floor Rug - Handwoven Jute (5ft Diameter Round)','Mandala Art','images/product/p-3.jpeg','₹3,299','₹4,499','27% OFF','PREMIUM',4.5,112,45,25,'This beautiful handcrafted piece showcases traditional artistry with modern design. Each piece is carefully crafted by skilled artisans using time-honored techniques passed down through generations.','POP Clay, Mirror Work, Natural Colors','12\" x 12\" x 1\"','1.2 kg','Dust with soft cloth. Keep away from direct sunlight and moisture. Handle with care.','SKU-051','2026-05-17 01:53:41','2026-05-17 01:53:41');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `rating` int(11) DEFAULT '5',
  `is_active` tinyint(1) DEFAULT '1',
  `sort_order` int(11) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (2,'Rahul Rajput','Customer','Absolutely beautiful craftsmanship! The mandala detailing looks even more elegant in real life. It completely transformed my living room wall and gives such a premium artistic vibe. Everyone who visits asks where I bought it from.','uploads/testimonials/test_1778961052_3c6d41a8.jpeg',5,1,0,'2026-05-17 01:20:52','2026-05-17 19:48:36'),(3,'Mohan Singh','customer','The quality and finishing are amazing. The colors, mirror work, and handmade detailing feel very luxurious and authentic. Packaging was also very secure. Perfect decor piece for anyone who loves traditional art with a modern touch.','uploads/testimonials/test_1779024953_7ee48a13.jpeg',5,1,0,'2026-05-17 19:05:53','2026-05-17 19:48:57'),(4,'Savita kumari','Customer','I purchased this for my studio entrance and it instantly became the highlight of the space. The design feels calming, classy, and very unique. You can clearly see the handmade effort in every detail','uploads/testimonials/test_1779024977_da00e904.jpeg',5,1,0,'2026-05-17 19:06:17','2026-05-17 19:49:28');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-17 20:41:17
