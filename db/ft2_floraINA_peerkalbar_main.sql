-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2015 at 02:28 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ft2_floraINA_peerkalbar_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_coll`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_coll` (
`id` int(11) NOT NULL,
  `collCode` varchar(50) NOT NULL,
  `dateColl` date DEFAULT NULL,
  `indivID` int(11) NOT NULL,
  `collReps` int(11) DEFAULT NULL,
  `dnaColl` enum('yes','no') DEFAULT NULL,
  `notes` varchar(1000) DEFAULT NULL,
  `deposit` varchar(200) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=540 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_collector`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_collector` (
`id` int(11) NOT NULL,
  `collID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=531 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_det`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_det` (
`id` int(11) NOT NULL,
  `indivID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `det_date` date NOT NULL,
  `taxonID` int(11) NOT NULL,
  `confid` enum('high','medium','low') NOT NULL,
  `using` varchar(1000) DEFAULT NULL,
  `notes` varchar(1500) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=634 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_img`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_img` (
`id` int(11) NOT NULL,
  `indivID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `md5sum` varchar(50) DEFAULT NULL,
  `filename` varchar(200) NOT NULL COMMENT 'Original file name',
  `directory` varchar(500) DEFAULT NULL COMMENT 'Directory structure in zip file',
  `plantpart` enum('whole twig with leaves (and inflorescence)','whole compound leaf','leaf upper surface','leaf lower surface','lower leafbase','leaf axil (w stipules petiole)','terminal bud','inflorescence','flower/fruit basal view','flower/fruit side view','flower/fruit apical view','flower/fruit longitudinal section','flower/fruit cross section','twig surface','twig cross section','trunk bark') DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL,
  `mimetype` varchar(50) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2116 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_indiv`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_indiv` (
`id` int(11) NOT NULL,
  `locnID` int(11) NOT NULL DEFAULT '0',
  `plot` varchar(100) DEFAULT NULL COMMENT 'The unique code for the sample plot (if any)',
  `tag` int(11) DEFAULT '0' COMMENT 'The plant/tree number within the sample plot',
  `personID` int(11) NOT NULL COMMENT 'The creator for this indiv record',
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=684 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_locn`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_locn` (
`id` int(11) NOT NULL,
  `longitude` float(9,5) NOT NULL COMMENT 'Longitude in decimal degrees, Datum WGS84',
  `latitude` float(8,5) NOT NULL COMMENT 'Latitude in decimal degrees, Datum WGS84',
  `elev` int(11) NOT NULL COMMENT 'Elevation ASL (m)',
  `geomorph` varchar(200) DEFAULT NULL,
  `locality` varchar(300) NOT NULL COMMENT 'Descriptive name of place',
  `county` varchar(300) DEFAULT NULL COMMENT 'Kabupaten',
  `province` varchar(300) NOT NULL DEFAULT 'Kalimantan Barat',
  `island` varchar(300) NOT NULL DEFAULT 'Borneo',
  `country` varchar(100) NOT NULL DEFAULT 'Indonesia',
  `notes` varchar(500) DEFAULT NULL COMMENT 'Other notes about place',
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=702 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_obs`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_obs` (
`id` int(11) NOT NULL,
  `indivID` int(11) NOT NULL,
  `date` date NOT NULL COMMENT 'Date of the observation',
  `personID` int(11) NOT NULL COMMENT 'Person making the observation',
  `microhab` varchar(500) DEFAULT NULL,
  `habit` enum('tree','shrub','liana','herb') NOT NULL,
  `dbh` decimal(10,1) DEFAULT '0.0',
  `height` decimal(10,2) DEFAULT '0.00',
  `bud` enum('no','yes') NOT NULL DEFAULT 'no',
  `flower` enum('no','yes') NOT NULL DEFAULT 'no',
  `fruit` enum('no','yes') NOT NULL DEFAULT 'no',
  `localname` varchar(100) DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL COMMENT 'General notes about this plant at time of observation',
  `char_lf_insert_alt` tinyint(1) DEFAULT NULL,
  `char_lf_insert_opp` tinyint(1) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=637 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_person`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_person` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `website` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `short_namecode` varchar(20) DEFAULT NULL,
  `institutions` varchar(100) DEFAULT NULL,
  `project` varchar(100) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=201 ;

-- --------------------------------------------------------

--
-- Table structure for table `peerkalbar_taxon`
--

CREATE TABLE IF NOT EXISTS `peerkalbar_taxon` (
`id` int(11) NOT NULL,
  `rank` enum('family','genus','species','subspecies') DEFAULT NULL,
  `morphotype` varchar(100) DEFAULT NULL,
  `kewid` varchar(20) DEFAULT NULL,
  `fam` varchar(100) DEFAULT NULL,
  `gen` varchar(100) DEFAULT NULL,
  `sp` varchar(100) DEFAULT NULL,
  `subtype` enum('var','ssp','forma') DEFAULT NULL,
  `ssp` varchar(100) DEFAULT NULL,
  `auth` varchar(200) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `n_status` int(11) NOT NULL DEFAULT '0',
  `fullname` varchar(200) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1213157 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peerkalbar_coll`
--
ALTER TABLE `peerkalbar_coll`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `collCode` (`collCode`), ADD KEY `indivID` (`indivID`);

--
-- Indexes for table `peerkalbar_collector`
--
ALTER TABLE `peerkalbar_collector`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `coll_order` (`collID`,`order`), ADD UNIQUE KEY `coll_person` (`collID`,`personID`), ADD KEY `personID` (`personID`);

--
-- Indexes for table `peerkalbar_det`
--
ALTER TABLE `peerkalbar_det`
 ADD PRIMARY KEY (`id`), ADD KEY `indivID` (`indivID`), ADD KEY `personID` (`personID`), ADD KEY `taxonID` (`taxonID`);

--
-- Indexes for table `peerkalbar_img`
--
ALTER TABLE `peerkalbar_img`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `unique_file_person` (`personID`,`filename`), ADD KEY `indivID` (`indivID`), ADD KEY `personID` (`personID`);

--
-- Indexes for table `peerkalbar_indiv`
--
ALTER TABLE `peerkalbar_indiv`
 ADD PRIMARY KEY (`id`), ADD KEY `locnID` (`locnID`);

--
-- Indexes for table `peerkalbar_locn`
--
ALTER TABLE `peerkalbar_locn`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peerkalbar_obs`
--
ALTER TABLE `peerkalbar_obs`
 ADD PRIMARY KEY (`id`), ADD KEY `personID` (`personID`), ADD KEY `indivID` (`indivID`);

--
-- Indexes for table `peerkalbar_person`
--
ALTER TABLE `peerkalbar_person`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`), ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `peerkalbar_taxon`
--
ALTER TABLE `peerkalbar_taxon`
 ADD PRIMARY KEY (`id`), ADD KEY `fullname` (`fullname`), ADD KEY `fam` (`fam`), ADD KEY `gen` (`gen`), ADD KEY `sp` (`sp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peerkalbar_coll`
--
ALTER TABLE `peerkalbar_coll`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=540;
--
-- AUTO_INCREMENT for table `peerkalbar_collector`
--
ALTER TABLE `peerkalbar_collector`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=531;
--
-- AUTO_INCREMENT for table `peerkalbar_det`
--
ALTER TABLE `peerkalbar_det`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=634;
--
-- AUTO_INCREMENT for table `peerkalbar_img`
--
ALTER TABLE `peerkalbar_img`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2116;
--
-- AUTO_INCREMENT for table `peerkalbar_indiv`
--
ALTER TABLE `peerkalbar_indiv`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=684;
--
-- AUTO_INCREMENT for table `peerkalbar_locn`
--
ALTER TABLE `peerkalbar_locn`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=702;
--
-- AUTO_INCREMENT for table `peerkalbar_obs`
--
ALTER TABLE `peerkalbar_obs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=637;
--
-- AUTO_INCREMENT for table `peerkalbar_person`
--
ALTER TABLE `peerkalbar_person`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT for table `peerkalbar_taxon`
--
ALTER TABLE `peerkalbar_taxon`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1213157;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `peerkalbar_coll`
--
ALTER TABLE `peerkalbar_coll`
ADD CONSTRAINT `peerkalbar_coll_ibfk_1` FOREIGN KEY (`indivID`) REFERENCES `peerkalbar_indiv` (`id`);

--
-- Constraints for table `peerkalbar_collector`
--
ALTER TABLE `peerkalbar_collector`
ADD CONSTRAINT `peerkalbar_collector_ibfk_1` FOREIGN KEY (`collID`) REFERENCES `peerkalbar_coll` (`id`),
ADD CONSTRAINT `peerkalbar_collector_ibfk_2` FOREIGN KEY (`personID`) REFERENCES `peerkalbar_person` (`id`);

--
-- Constraints for table `peerkalbar_det`
--
ALTER TABLE `peerkalbar_det`
ADD CONSTRAINT `peerkalbar_det_ibfk_1` FOREIGN KEY (`indivID`) REFERENCES `peerkalbar_indiv` (`id`),
ADD CONSTRAINT `peerkalbar_det_ibfk_3` FOREIGN KEY (`personID`) REFERENCES `peerkalbar_person` (`id`),
ADD CONSTRAINT `peerkalbar_det_ibfk_6` FOREIGN KEY (`taxonID`) REFERENCES `peerkalbar_taxon` (`id`);

--
-- Constraints for table `peerkalbar_img`
--
ALTER TABLE `peerkalbar_img`
ADD CONSTRAINT `peerkalbar_img_ibfk_1` FOREIGN KEY (`indivID`) REFERENCES `peerkalbar_indiv` (`id`),
ADD CONSTRAINT `peerkalbar_img_ibfk_2` FOREIGN KEY (`personID`) REFERENCES `peerkalbar_person` (`id`);

--
-- Constraints for table `peerkalbar_indiv`
--
ALTER TABLE `peerkalbar_indiv`
ADD CONSTRAINT `peerkalbar_indiv_ibfk_4` FOREIGN KEY (`locnID`) REFERENCES `peerkalbar_locn` (`id`);

--
-- Constraints for table `peerkalbar_obs`
--
ALTER TABLE `peerkalbar_obs`
ADD CONSTRAINT `peerkalbar_obs_ibfk_1` FOREIGN KEY (`indivID`) REFERENCES `peerkalbar_indiv` (`id`),
ADD CONSTRAINT `peerkalbar_obs_ibfk_2` FOREIGN KEY (`personID`) REFERENCES `peerkalbar_person` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
