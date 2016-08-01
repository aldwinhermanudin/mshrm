-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 01, 2016 at 10:50 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mshrm_server`
--

-- --------------------------------------------------------

--
-- Table structure for table `device_information`
--

CREATE TABLE IF NOT EXISTS `device_information` (
  `no` int(8) NOT NULL AUTO_INCREMENT,
  `configuration` varchar(32) NOT NULL,
  `value` varchar(32) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `device_information`
--

INSERT INTO `device_information` (`no`, `configuration`, `value`) VALUES
(1, 'admin_password', '1995');

-- --------------------------------------------------------

--
-- Table structure for table `employee_data`
--

CREATE TABLE IF NOT EXISTS `employee_data` (
  `uid` varchar(8) NOT NULL,
  `name` varchar(35) NOT NULL,
  `short_name` varchar(24) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_data`
--

INSERT INTO `employee_data` (`uid`, `name`, `short_name`) VALUES
('cf994312', 'Yudi Andrean', 'Yudi');

-- --------------------------------------------------------

--
-- Table structure for table `work_log`
--

CREATE TABLE IF NOT EXISTS `work_log` (
  `no` int(15) NOT NULL AUTO_INCREMENT,
  `uid` varchar(8) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
