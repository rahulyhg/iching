-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: iching
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB

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
-- Table structure for table `hexagrams`
--

DROP TABLE IF EXISTS `hexagrams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hexagrams` (
  `id` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trigrams` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judge_old` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judge_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_old` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_1_org` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_1_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_2_org` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_2_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_3_org` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_3_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_4` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_4_org` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_4_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_5` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_5_org` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_5_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_6` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_6_org` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_6_exp` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hexagrams`
--

LOCK TABLES `hexagrams` WRITE;
/*!40000 ALTER TABLE `hexagrams` DISABLE KEYS */;
/*!40000 ALTER TABLE `hexagrams` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-06  3:39:31
