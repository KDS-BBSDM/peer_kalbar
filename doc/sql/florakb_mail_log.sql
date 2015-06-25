-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2014 at 06:56 PM
-- Server version: 5.5.37-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

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
-- Table structure for table `florakb_mail_log`
--

CREATE TABLE IF NOT EXISTS `florakb_mail_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt` varchar(50) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `encode` text,
  `send_date` datetime DEFAULT NULL,
  `n_status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `receipt` (`receipt`,`subject`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
