-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2011 at 07:37 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expense`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL auto_increment,
  `payee` varchar(200) NOT NULL,
  `amount` float NOT NULL,
  `datee` date NOT NULL,
  `type` varchar(8) NOT NULL,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `payee`, `amount`, `datee`, `type`, `username`) VALUES
(1, 'Exp1', 1000, '2011-11-13', 'expense', 'balan'),
(2, 'EXp2', 2000, '2011-11-13', 'expense', 'balan'),
(3, 'Income1', 50000, '2011-11-13', 'income', 'balan'),
(4, 'Exp3', 4000, '2011-11-13', 'expense', 'balan');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('balan', 'openthis'),
('rex', 'rex'),
('toota', 'toota');
