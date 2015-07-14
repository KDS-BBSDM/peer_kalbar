-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2015 at 02:51 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ft2_floraINA_peerkalbar_extra`
--

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_mail_log`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_mail_log` (
`id` int(11) NOT NULL,
  `receipt` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `encode` text,
  `send_date` datetime DEFAULT NULL,
  `n_status` int(11) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_person`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_person` (
  `id` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `salt` varchar(25) NOT NULL,
  `register_date` datetime NOT NULL,
  `verified_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `login_count` int(11) NOT NULL,
  `user_type` int(22) NOT NULL,
  `email_token` varchar(50) NOT NULL,
  `n_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_upload_log`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_upload_log` (
`id` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `filename` varchar(200) DEFAULT NULL,
  `desc` text,
  `upload_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `plantlist_kode` varchar(20) DEFAULT NULL,
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
  `local_name` varchar(200) DEFAULT NULL,
  `benefit` varchar(200) DEFAULT NULL,
  `tmp_location_key` varchar(20) DEFAULT NULL,
  `tmp_taxon_key` varchar(20) DEFAULT NULL,
  `tmp_person_key` varchar(20) DEFAULT NULL,
  `tmp_indiv_key` varchar(20) DEFAULT NULL,
  `tmp_coll_key` varchar(20) DEFAULT NULL,
  `tmp_creator_key` varchar(20) DEFAULT NULL
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
  `tmp_unique_key` varchar(200) DEFAULT NULL,
  `kewid` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peerkalbar_mail_log`
--
ALTER TABLE `peerkalbar_mail_log`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `receipt` (`receipt`,`subject`);

--
-- Indexes for table `peerkalbar_person`
--
ALTER TABLE `peerkalbar_person`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peerkalbar_upload_log`
--
ALTER TABLE `peerkalbar_upload_log`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peerkalbar_mail_log`
--
ALTER TABLE `peerkalbar_mail_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `peerkalbar_upload_log`
--
ALTER TABLE `peerkalbar_upload_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
