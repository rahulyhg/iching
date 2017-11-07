/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.1.37 : Database - astro
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`astro` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `astro`;

/*Table structure for table `birth_info` */

DROP TABLE IF EXISTS `birth_info`;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*Table structure for table `cities` */

DROP TABLE IF EXISTS `cities`;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*Table structure for table `member_info` */

DROP TABLE IF EXISTS `member_info`;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*Table structure for table `reports` */

DROP TABLE IF EXISTS `reports`;

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

/*Table structure for table `scores` */

DROP TABLE IF EXISTS `scores`;

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
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*Table structure for table `timezones` */

DROP TABLE IF EXISTS `timezones`;

CREATE TABLE `timezones` (
  `ID` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `tt` smallint(4) unsigned NOT NULL DEFAULT '1',
  `date_time` datetime NOT NULL,
  `timezone` tinyint(2) NOT NULL,
  `time_type` tinyint(1) unsigned NOT NULL,
  `time_type_literal` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
