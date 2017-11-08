-- MySQL dump 10.16  Distrib 10.1.28-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: iching
-- ------------------------------------------------------
-- Server version	10.1.28-MariaDB

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
-- Table structure for table `desc_positions`
--

DROP TABLE IF EXISTS `desc_positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `desc_positions` (
  `position` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revrole` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revtao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revcreation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `poles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planet` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `hexagrams`
--

DROP TABLE IF EXISTS `hexagrams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hexagrams` (
  `fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proofed` int(11) DEFAULT '0',
  `fmtOK` int(11) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filename` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseq` int(11) DEFAULT NULL,
  `bseq` int(11) NOT NULL,
  `oseq` int(11) DEFAULT NULL,
  `binary` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `title` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trigrams` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_upper` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_upper_bin` int(11) DEFAULT NULL,
  `tri_lower` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_lower_bin` int(32) DEFAULT NULL,
  `iq32_dir` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci,
  `judge_old` text COLLATE utf8mb4_unicode_ci,
  `judge_exp` text COLLATE utf8mb4_unicode_ci,
  `image_old` text COLLATE utf8mb4_unicode_ci,
  `image_exp` text COLLATE utf8mb4_unicode_ci,
  `line_1` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_1_org` text COLLATE utf8mb4_unicode_ci,
  `line_1_exp` text COLLATE utf8mb4_unicode_ci,
  `line_2` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_2_org` text COLLATE utf8mb4_unicode_ci,
  `line_2_exp` text COLLATE utf8mb4_unicode_ci,
  `line_3` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_3_org` text COLLATE utf8mb4_unicode_ci,
  `line_3_exp` text COLLATE utf8mb4_unicode_ci,
  `line_4` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_4_org` text COLLATE utf8mb4_unicode_ci,
  `line_4_exp` text COLLATE utf8mb4_unicode_ci,
  `line_5` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_5_org` text COLLATE utf8mb4_unicode_ci,
  `line_5_exp` text COLLATE utf8mb4_unicode_ci,
  `line_6` varchar(48) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `line_6_org` text COLLATE utf8mb4_unicode_ci,
  `line_6_exp` text COLLATE utf8mb4_unicode_ci,
  `updated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`bseq`),
  FULLTEXT KEY `comment` (`comment`),
  FULLTEXT KEY `title` (`title`),
  FULLTEXT KEY `trans` (`trans`),
  FULLTEXT KEY `trigrams` (`trigrams`),
  FULLTEXT KEY `tri_upper` (`tri_upper`),
  FULLTEXT KEY `tri_lower` (`tri_lower`),
  FULLTEXT KEY `iq32_dir` (`iq32_dir`),
  FULLTEXT KEY `iq32_theme` (`iq32_theme`),
  FULLTEXT KEY `iq32_desc` (`iq32_desc`),
  FULLTEXT KEY `explanation` (`explanation`),
  FULLTEXT KEY `judge_old` (`judge_old`),
  FULLTEXT KEY `judge_exp` (`judge_exp`),
  FULLTEXT KEY `image_old` (`image_old`),
  FULLTEXT KEY `image_exp` (`image_exp`),
  FULLTEXT KEY `line_1_org` (`line_1_org`),
  FULLTEXT KEY `line_1_exp` (`line_1_exp`),
  FULLTEXT KEY `line_2_org` (`line_2_org`),
  FULLTEXT KEY `line_2_exp` (`line_2_exp`),
  FULLTEXT KEY `line_3_org` (`line_3_org`),
  FULLTEXT KEY `line_3_exp` (`line_3_exp`),
  FULLTEXT KEY `line_4_org` (`line_4_org`),
  FULLTEXT KEY `line_4_exp` (`line_4_exp`),
  FULLTEXT KEY `line_5_org` (`line_5_org`),
  FULLTEXT KEY `line_5_exp` (`line_5_exp`),
  FULLTEXT KEY `line_6_org` (`line_6_org`),
  FULLTEXT KEY `line_6_exp` (`line_6_exp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ichinglines`
--

DROP TABLE IF EXISTS `ichinglines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ichinglines` (
  `hex` int(11) NOT NULL DEFAULT '0',
  `line` int(11) NOT NULL DEFAULT '0',
  `trans` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`hex`,`line`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `xref_32pairs`
--

DROP TABLE IF EXISTS `xref_32pairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_32pairs` (
  `pathnum` int(11) NOT NULL,
  `num` int(11) DEFAULT NULL,
  `title` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assiah` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarot_num` int(11) DEFAULT NULL,
  `tarot` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_pseq` int(11) DEFAULT NULL,
  `des_bseq` int(11) DEFAULT NULL,
  `des_binary` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_balance` int(11) DEFAULT NULL,
  `des_balance_desc` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `des_meaning` text COLLATE utf8mb4_unicode_ci,
  `asc_name` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_pseq` int(11) DEFAULT NULL,
  `asc_bseq` int(11) DEFAULT NULL,
  `asc_binary` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_balance` int(11) DEFAULT NULL,
  `asc_balance_desc` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_meaning` text COLLATE utf8mb4_unicode_ci,
  `theme` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`pathnum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `xref_notes`
--

DROP TABLE IF EXISTS `xref_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_notes` (
  `fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proofed` int(11) DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `filename` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseq` int(11) DEFAULT NULL,
  `bseq` int(11) NOT NULL,
  `oseq` int(11) DEFAULT NULL,
  `binary` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `trans` text COLLATE utf8mb4_unicode_ci,
  `trigrams` text COLLATE utf8mb4_unicode_ci,
  `tri_upper` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_upper_bin` int(11) DEFAULT NULL,
  `tri_lower` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_lower_bin` int(32) DEFAULT NULL,
  `iq32_dir` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci,
  `judge_old` text COLLATE utf8mb4_unicode_ci,
  `judge_exp` text COLLATE utf8mb4_unicode_ci,
  `image_old` text COLLATE utf8mb4_unicode_ci,
  `image_exp` text COLLATE utf8mb4_unicode_ci,
  `line_1` text COLLATE utf8mb4_unicode_ci,
  `line_1_org` text COLLATE utf8mb4_unicode_ci,
  `line_1_exp` text COLLATE utf8mb4_unicode_ci,
  `line_2` text COLLATE utf8mb4_unicode_ci,
  `line_2_org` text COLLATE utf8mb4_unicode_ci,
  `line_2_exp` text COLLATE utf8mb4_unicode_ci,
  `line_3` text COLLATE utf8mb4_unicode_ci,
  `line_3_org` text COLLATE utf8mb4_unicode_ci,
  `line_3_exp` text COLLATE utf8mb4_unicode_ci,
  `line_4` text COLLATE utf8mb4_unicode_ci,
  `line_4_org` text COLLATE utf8mb4_unicode_ci,
  `line_4_exp` text COLLATE utf8mb4_unicode_ci,
  `line_5` text COLLATE utf8mb4_unicode_ci,
  `line_5_org` text COLLATE utf8mb4_unicode_ci,
  `line_5_exp` text COLLATE utf8mb4_unicode_ci,
  `line_6` text COLLATE utf8mb4_unicode_ci,
  `line_6_org` text COLLATE utf8mb4_unicode_ci,
  `line_6_exp` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`bseq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `xref_short`
--

DROP TABLE IF EXISTS `xref_short`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_short` (
  `fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proofed` int(11) DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `filename` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseq` int(11) DEFAULT NULL,
  `bseq` int(11) NOT NULL,
  `oseq` int(11) DEFAULT NULL,
  `binary` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `trans` text COLLATE utf8mb4_unicode_ci,
  `trigrams` text COLLATE utf8mb4_unicode_ci,
  `tri_upper` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_upper_bin` int(11) DEFAULT NULL,
  `tri_lower` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_lower_bin` int(32) DEFAULT NULL,
  `iq32_dir` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci,
  `judge_old` text COLLATE utf8mb4_unicode_ci,
  `judge_exp` text COLLATE utf8mb4_unicode_ci,
  `image_old` text COLLATE utf8mb4_unicode_ci,
  `image_exp` text COLLATE utf8mb4_unicode_ci,
  `line_1` text COLLATE utf8mb4_unicode_ci,
  `line_1_org` text COLLATE utf8mb4_unicode_ci,
  `line_1_exp` text COLLATE utf8mb4_unicode_ci,
  `line_2` text COLLATE utf8mb4_unicode_ci,
  `line_2_org` text COLLATE utf8mb4_unicode_ci,
  `line_2_exp` text COLLATE utf8mb4_unicode_ci,
  `line_3` text COLLATE utf8mb4_unicode_ci,
  `line_3_org` text COLLATE utf8mb4_unicode_ci,
  `line_3_exp` text COLLATE utf8mb4_unicode_ci,
  `line_4` text COLLATE utf8mb4_unicode_ci,
  `line_4_org` text COLLATE utf8mb4_unicode_ci,
  `line_4_exp` text COLLATE utf8mb4_unicode_ci,
  `line_5` text COLLATE utf8mb4_unicode_ci,
  `line_5_org` text COLLATE utf8mb4_unicode_ci,
  `line_5_exp` text COLLATE utf8mb4_unicode_ci,
  `line_6` text COLLATE utf8mb4_unicode_ci,
  `line_6_org` text COLLATE utf8mb4_unicode_ci,
  `line_6_exp` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`bseq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `xref_structured`
--

DROP TABLE IF EXISTS `xref_structured`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_structured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proofed` int(11) DEFAULT '0',
  `comment` text COLLATE utf8mb4_unicode_ci,
  `filename` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pseq` int(11) DEFAULT NULL,
  `bseq` int(11) NOT NULL,
  `oseq` int(11) DEFAULT NULL,
  `binary` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci,
  `trans` text COLLATE utf8mb4_unicode_ci,
  `trigrams` text COLLATE utf8mb4_unicode_ci,
  `tri_upper` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_upper_bin` int(11) DEFAULT NULL,
  `tri_lower` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tri_lower_bin` int(32) DEFAULT NULL,
  `iq32_dir` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iq32_desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation` text COLLATE utf8mb4_unicode_ci,
  `judge_old` text COLLATE utf8mb4_unicode_ci,
  `judge_exp` text COLLATE utf8mb4_unicode_ci,
  `image_old` text COLLATE utf8mb4_unicode_ci,
  `image_exp` text COLLATE utf8mb4_unicode_ci,
  `line_1` text COLLATE utf8mb4_unicode_ci,
  `line_1_org` text COLLATE utf8mb4_unicode_ci,
  `line_1_exp` text COLLATE utf8mb4_unicode_ci,
  `line_2` text COLLATE utf8mb4_unicode_ci,
  `line_2_org` text COLLATE utf8mb4_unicode_ci,
  `line_2_exp` text COLLATE utf8mb4_unicode_ci,
  `line_3` text COLLATE utf8mb4_unicode_ci,
  `line_3_org` text COLLATE utf8mb4_unicode_ci,
  `line_3_exp` text COLLATE utf8mb4_unicode_ci,
  `line_4` text COLLATE utf8mb4_unicode_ci,
  `line_4_org` text COLLATE utf8mb4_unicode_ci,
  `line_4_exp` text COLLATE utf8mb4_unicode_ci,
  `line_5` text COLLATE utf8mb4_unicode_ci,
  `line_5_org` text COLLATE utf8mb4_unicode_ci,
  `line_5_exp` text COLLATE utf8mb4_unicode_ci,
  `line_6` text COLLATE utf8mb4_unicode_ci,
  `line_6_org` text COLLATE utf8mb4_unicode_ci,
  `line_6_exp` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8794 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `xref_trigrams`
--

DROP TABLE IF EXISTS `xref_trigrams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_trigrams` (
  `bseq` int(11) NOT NULL,
  `pseq` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trans` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t_element` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `polarity` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planet` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `archetype` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `explanation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`bseq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `positions`
--

DROP TABLE IF EXISTS `positions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `positions` (
  `position` int(11) NOT NULL,
  `tao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_tao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_creation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_poles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asc_quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_revrole` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_tao` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_creation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_revcreation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_poles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc_quality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `t4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `site_stopwords`
--

DROP TABLE IF EXISTS `site_stopwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_stopwords` (
  `value` varchar(18) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `site_suggestions`
--

DROP TABLE IF EXISTS `site_suggestions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_suggestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suggestion` text COLLATE utf8mb4_unicode_ci,
  `dtstamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `site_user`
--

DROP TABLE IF EXISTS `site_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `astro_birth_info`
--

DROP TABLE IF EXISTS `astro_birth_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astro_birth_info` (
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
-- Table structure for table `astro_cities`
--

DROP TABLE IF EXISTS `astro_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astro_cities` (
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
-- Table structure for table `astro_member_info`
--

DROP TABLE IF EXISTS `astro_member_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astro_member_info` (
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
-- Table structure for table `astro_reports`
--

DROP TABLE IF EXISTS `astro_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astro_reports` (
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
-- Table structure for table `astro_scores`
--

DROP TABLE IF EXISTS `astro_scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astro_scores` (
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
-- Table structure for table `astro_timezones`
--

DROP TABLE IF EXISTS `astro_timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astro_timezones` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `tt` smallint(4) unsigned NOT NULL DEFAULT '1',
  `date_time` datetime NOT NULL,
  `timezone` tinyint(2) NOT NULL,
  `time_type` tinyint(1) unsigned NOT NULL,
  `time_type_literal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-07 16:29:28
