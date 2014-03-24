-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2014 at 09:15 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `milton`
--
CREATE DATABASE IF NOT EXISTS `milton` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `milton`;

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE IF NOT EXISTS `courier` (
  `idCourier` int(11) NOT NULL AUTO_INCREMENT,
  `Couriername` text NOT NULL,
  `Courierinfo` text,
  PRIMARY KEY (`idCourier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`idCourier`, `Couriername`, `Courierinfo`) VALUES
(21, 'Sample 1', 'Sample 21'),
(22, 'Sample 2', 'Sample text&#10;&#10;22 The Street&#10;AA3 BB4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `pass` char(32) DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `name` (`name`(6))
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUser`, `name`, `pass`) VALUES
(14, 'lukasz', '642ced05f95bc38e53967987f82c9700'),
(17, 'administrator', '5c90c58d69c1ae8513e84f631f4598cd'),
(18, 'admin', 'b2d63acd4055b9c9bc6a38e72d661b5a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
