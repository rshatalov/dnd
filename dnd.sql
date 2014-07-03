-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2014 at 08:31 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `dm_uid` varchar(13) DEFAULT NULL,
  `dm_user_name` varchar(30) DEFAULT NULL,
  `tid` varchar(13) NOT NULL DEFAULT '',
  `table_name` varchar(30) DEFAULT NULL,
  `table_desc` text,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`dm_uid`, `dm_user_name`, `tid`, `table_name`, `table_desc`) VALUES
('53b1fd5a3e6d2', 'olga', '53b248bef3c71', '1st battle', 'battle desc');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE IF NOT EXISTS `units` (
  `uid` varchar(13) NOT NULL DEFAULT '',
  `status` varchar(20) DEFAULT NULL,
  `type` varchar(15) DEFAULT NULL,
  `user_id` varchar(13) DEFAULT NULL,
  `monster_id` varchar(13) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `size` varchar(3) DEFAULT NULL,
  `max_hp` int(11) DEFAULT NULL,
  `actual_hp` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`uid`, `status`, `type`, `user_id`, `monster_id`, `user_name`, `name`, `size`, `max_hp`, `actual_hp`) VALUES
('53b3501ecf5ce', '1', 'monster', '53b1fd5a3e6d2', NULL, 'olga', 'Orc', 'S', 56, 565),
('53b350543c212', '1', 'monster', '53b1fd5a3e6d2', '53b3501ecf5ce', 'olga', 'Orc', 'S', 56, 565),
('53b35054dfcb1', '1', 'monster', '53b1fd5a3e6d2', '53b3501ecf5ce', 'olga', 'Orc', 'S', 56, 565),
('53b35055243fe', '1', 'monster', '53b1fd5a3e6d2', '53b3501ecf5ce', 'olga', 'Orc', 'S', 56, 565);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` varchar(13) NOT NULL DEFAULT '',
  `email` varchar(50) DEFAULT NULL,
  `pswd` varchar(32) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `email`, `pswd`, `type`, `user_name`) VALUES
('53b1fd5a3e6d2', 'vasilenin@mail.ru', 'b0baee9d279d34fa1dfd71aadb908c3f', 'dm', 'olga');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
