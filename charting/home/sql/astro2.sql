-- MySQL dump 10.13  Distrib 5.6.38, for Linux (x86_64)
--
-- Host: localhost    Database: astro
-- ------------------------------------------------------
-- Server version	5.6.38

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
-- Table structure for table `birth_info`
--

DROP TABLE IF EXISTS `birth_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `birth_info` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `entered_by` varchar(12) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `sex` char(1) NOT NULL DEFAULT '',
  `month` char(2) NOT NULL DEFAULT '',
  `day` char(2) NOT NULL DEFAULT '',
  `year` varchar(4) NOT NULL DEFAULT '',
  `hour` char(2) NOT NULL DEFAULT '',
  `minute` char(2) NOT NULL DEFAULT '',
  `timezone` varchar(10) NOT NULL DEFAULT '',
  `long_deg` char(3) NOT NULL DEFAULT '',
  `long_min` char(2) NOT NULL DEFAULT '',
  `ew` char(2) NOT NULL DEFAULT '',
  `lat_deg` char(2) NOT NULL DEFAULT '',
  `lat_min` char(2) NOT NULL DEFAULT '',
  `ns` char(2) NOT NULL DEFAULT '',
  `comments` text,
  `entry_date` date NOT NULL DEFAULT '2000-01-01',
  `admin_response` text,
  `respond_date` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `birth_info`
--

LOCK TABLES `birth_info` WRITE;
/*!40000 ALTER TABLE `birth_info` DISABLE KEYS */;
INSERT INTO `birth_info` VALUES (1,'jw','Jeff_Milton','m','6','17','1956','2','17','-4','74','36','-1','40','34','1',NULL,'2017-11-06',NULL,NULL),(2,'a_edwall','Allen','m','9','22','1949','10','43','-6','95','23','-1','29','45','1',NULL,'2017-11-06',NULL,NULL);
/*!40000 ALTER TABLE `birth_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(50) NOT NULL DEFAULT '',
  `county` varchar(50) NOT NULL DEFAULT '',
  `state` varchar(2) NOT NULL DEFAULT '',
  `long_deg` tinyint(3) unsigned NOT NULL DEFAULT '90',
  `ew` varchar(1) NOT NULL DEFAULT 'W',
  `long_min` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `lat_deg` tinyint(2) unsigned NOT NULL DEFAULT '41',
  `ns` varchar(1) NOT NULL DEFAULT 'N',
  `lat_min` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `tt` smallint(4) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_info`
--

DROP TABLE IF EXISTS `member_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_info` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `comments` text,
  `num_recs_to_display` mediumint(9) unsigned NOT NULL DEFAULT '15',
  `my_sort_by` varchar(25) NOT NULL DEFAULT 'name',
  `orig_email` varchar(40) NOT NULL DEFAULT '',
  `account_opened` date NOT NULL DEFAULT '2000-01-01',
  `last_login` date NOT NULL DEFAULT '2000-01-01',
  `last_transaction` date NOT NULL DEFAULT '2000-01-01',
  `admin_response` text,
  `respond_date` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_info`
--

LOCK TABLES `member_info` WRITE;
/*!40000 ALTER TABLE `member_info` DISABLE KEYS */;
INSERT INTO `member_info` VALUES (1,'jw','3fde6bb0541387e4ebdadf7c2ff31123','jeff.milton@gmail.com',NULL,15,'name','jeff.milton@gmail.com','2017-11-06','2017-11-06','2017-11-06',NULL,NULL),(2,'a_edwall','5a05a7e4e29711946023c90e9b01bdea','pch@astrowin.org',NULL,15,'name','pch@astrowin.org','2017-11-06','2017-11-06','2017-11-06',NULL,NULL);
/*!40000 ALTER TABLE `member_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `natal_reports` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `natal_midpoints` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `natal_cosmodynes` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `vocational_analysis` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `solar_arcs` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `solar_arcs_and_transits` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `progressions` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `progressions_and_transits` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `solar_returns` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `lunar_returns` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `transit_to_natal_interps` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `dual_cosmodynes` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `dc_with_report` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `synastry` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `synastry_reports` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `composites` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `davison_relationships` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `planetary_hours` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `transits_any_date` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `transits_right_now` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `transits_at_your_ISP` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `moon_aspects_and_voc` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `view_all_dc_scores` mediumint(9) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scores` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `entered_by` varchar(12) NOT NULL,
  `id_f` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `name_f` varchar(40) NOT NULL,
  `id_m` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `name_m` varchar(40) NOT NULL,
  `power` float NOT NULL DEFAULT '-1',
  `harmony` float NOT NULL DEFAULT '0',
  `mrs` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scores`
--

LOCK TABLES `scores` WRITE;
/*!40000 ALTER TABLE `scores` DISABLE KEYS */;
/*!40000 ALTER TABLE `scores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timezones`
--

DROP TABLE IF EXISTS `timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timezones` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `tt` smallint(4) unsigned NOT NULL DEFAULT '1',
  `date_time` datetime NOT NULL,
  `timezone` tinyint(2) NOT NULL,
  `time_type` tinyint(1) unsigned NOT NULL,
  `time_type_literal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timezones`
--

LOCK TABLES `timezones` WRITE;
/*!40000 ALTER TABLE `timezones` DISABLE KEYS */;
/*!40000 ALTER TABLE `timezones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-06 14:04:48
