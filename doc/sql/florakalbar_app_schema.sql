-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2014 at 06:43 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `florakalbar_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `adm_member`
--

CREATE TABLE IF NOT EXISTS `adm_member` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  `n_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `code_activity`
--

CREATE TABLE IF NOT EXISTS `code_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activityId` int(11) NOT NULL,
  `activityValue` varchar(50) NOT NULL,
  `n_status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `code_activity_log`
--

CREATE TABLE IF NOT EXISTS `code_activity_log` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `activityId` int(11) NOT NULL,
  `activityDesc` varchar(250) NOT NULL,
  `source` varchar(20) NOT NULL,
  `datetimes` datetime NOT NULL,
  `n_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `code_url_redirect`
--

CREATE TABLE IF NOT EXISTS `code_url_redirect` (
  `id` int(11) NOT NULL,
  `articleId` int(11) DEFAULT NULL,
  `shortUrl` varchar(100) DEFAULT NULL,
  `friendlyUrl` varchar(300) DEFAULT NULL,
  `datetimes` datetime DEFAULT NULL,
  `n_status` int(1) NOT NULL,
  UNIQUE KEY `shortUrl` (`shortUrl`),
  UNIQUE KEY `friendlyUrl` (`friendlyUrl`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `florakb_news_content`
--

CREATE TABLE IF NOT EXISTS `florakb_news_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `brief` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `thumbnailimage` varchar(100) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `articletype` int(11) NOT NULL,
  `tags` text NOT NULL,
  `createdate` datetime NOT NULL,
  `postdate` datetime NOT NULL,
  `expiredate` datetime NOT NULL,
  `fromwho` int(11) NOT NULL,
  `authorid` int(11) NOT NULL,
  `n_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `florakb_news_content_category`
--

CREATE TABLE IF NOT EXISTS `florakb_news_content_category` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `n_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `florakb_news_content_type`
--

CREATE TABLE IF NOT EXISTS `florakb_news_content_type` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `n_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `florakb_person`
--

CREATE TABLE IF NOT EXISTS `florakb_person` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `salt` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_location`
--

CREATE TABLE IF NOT EXISTS `tmp_location` (
  `unique_key` varchar(200) DEFAULT NULL,
  `long` varchar(200) DEFAULT NULL,
  `lat` varchar(200) DEFAULT NULL,
  `elev` varchar(200) DEFAULT NULL,
  `geomorphology` varchar(200) DEFAULT NULL,
  `locality` varchar(200) DEFAULT NULL,
  `kabupaten` varchar(200) DEFAULT NULL,
  `province` varchar(200) DEFAULT NULL,
  `island` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `tmp_unique_key` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_person`
--

CREATE TABLE IF NOT EXISTS `tmp_person` (
  `unique_key` varchar(200) DEFAULT NULL,
  `db_id` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `twitter` varchar(200) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `tmp_unique_key` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_photo`
--

CREATE TABLE IF NOT EXISTS `tmp_photo` (
  `filename` varchar(200) DEFAULT NULL,
  `tree_id` varchar(200) DEFAULT NULL,
  `photographer` varchar(200) DEFAULT NULL,
  `plant_part` varchar(200) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `tmp_person_key` varchar(20) DEFAULT NULL,
  `tmp_indiv_key` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_plant`
--

CREATE TABLE IF NOT EXISTS `tmp_plant` (
  `unique_key` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `obs_by` varchar(200) DEFAULT NULL,
  `locn` varchar(200) DEFAULT NULL,
  `microhab` varchar(200) DEFAULT NULL,
  `plot` varchar(200) DEFAULT NULL,
  `tag` varchar(200) DEFAULT NULL,
  `habit` varchar(200) DEFAULT NULL,
  `dbh` varchar(200) DEFAULT NULL,
  `height` varchar(200) DEFAULT NULL,
  `bud` varchar(200) DEFAULT NULL,
  `flower` varchar(200) DEFAULT NULL,
  `fruit` varchar(200) DEFAULT NULL,
  `indiv_notes` varchar(200) DEFAULT NULL,
  `det` varchar(200) DEFAULT NULL,
  `confid` varchar(200) DEFAULT NULL,
  `det_by` varchar(200) DEFAULT NULL,
  `det_date` varchar(200) DEFAULT NULL,
  `det_using` varchar(200) DEFAULT NULL,
  `det_notes` varchar(200) DEFAULT NULL,
  `tmp_location_key` varchar(20) DEFAULT NULL,
  `tmp_taxon_key` varchar(20) DEFAULT NULL,
  `tmp_person_key` varchar(20) DEFAULT NULL,
  `tmp_indiv_key` varchar(20) DEFAULT NULL,
  `tmp_coll_key` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_taxon`
--

CREATE TABLE IF NOT EXISTS `tmp_taxon` (
  `unique_key` varchar(200) NOT NULL,
  `db_id` varchar(200) DEFAULT NULL,
  `morphotype` varchar(200) DEFAULT NULL,
  `fam` varchar(200) DEFAULT NULL,
  `gen` varchar(200) DEFAULT NULL,
  `sp` varchar(200) DEFAULT NULL,
  `subtype` varchar(200) DEFAULT NULL,
  `ssp` varchar(200) DEFAULT NULL,
  `ssp_auth` varchar(200) DEFAULT NULL,
  `tmp_unique_key` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_member`
--

CREATE TABLE IF NOT EXISTS `user_member` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(46) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified_date` datetime NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `image_profile` varchar(200) NOT NULL,
  `username` varchar(46) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `sex` varchar(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `description` text,
  `middle_name` varchar(46) DEFAULT NULL,
  `last_name` varchar(46) DEFAULT NULL,
  `StreetName` varchar(150) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `n_status` int(3) NOT NULL DEFAULT '0' COMMENT ' pending , approved, verified, rejected ',
  `login_count` int(11) NOT NULL DEFAULT '0',
  `verified` tinyint(3) DEFAULT '0',
  `usertype` int(11) NOT NULL COMMENT '0:online;1:offline;2;existing',
  `salt` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
