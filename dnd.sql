-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 19 2014 г., 06:26
-- Версия сервера: 5.6.12-log
-- Версия PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `dnd`
--
CREATE DATABASE IF NOT EXISTS `dnd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dnd`;

-- --------------------------------------------------------

--
-- Структура таблицы `characters`
--

CREATE TABLE IF NOT EXISTS `characters` (
  `uid` varchar(13) DEFAULT NULL,
  `cid` varchar(13) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  `size` varchar(5) DEFAULT NULL,
  `cur_hp` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `characters`
--

INSERT INTO `characters` (`uid`, `cid`, `name`, `size`, `cur_hp`) VALUES
('537323f7dbe75', '537323f7dbe75', 'roman', '1', 20),
('537324003b99a', '537324003b99a', 'olga', '2', 30);

-- --------------------------------------------------------

--
-- Структура таблицы `monsters`
--

CREATE TABLE IF NOT EXISTS `monsters` (
  `mid` varchar(13) NOT NULL DEFAULT '',
  `name` varchar(30) DEFAULT NULL,
  `size` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `monsters`
--

INSERT INTO `monsters` (`mid`, `name`, `size`) VALUES
('53798880cab81', 'orc', '3'),
('53798a1ad6d7d', 'river goblin', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `tables`
--

CREATE TABLE IF NOT EXISTS `tables` (
  `dm` varchar(30) DEFAULT NULL,
  `tid` varchar(13) NOT NULL DEFAULT '',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `tables`
--

INSERT INTO `tables` (`dm`, `tid`) VALUES
('a', '5397b7f8eb769');

-- --------------------------------------------------------

--
-- Структура таблицы `units`
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
-- Дамп данных таблицы `units`
--

INSERT INTO `units` (`uid`, `status`, `type`, `user_id`, `monster_id`, `user_name`, `name`, `size`, `max_hp`, `actual_hp`) VALUES
('538f37e2378d5', '1', 'monster', '537323b23a6f2', NULL, 'a', 'Fox', 'G', 667, 5),
('5397fcbea6c18', '1', 'monster', '537323b23a6f2', NULL, 'a', 'Orc', 'G', 87, 7),
('5397fcd0e7782', '1', 'monster', '537323b23a6f2', NULL, 'a', 'river goblin', 'M', 50, 50),
('539840d0f2472', '1', 'monster', '537323b23a6f2', '538f37e2378d5', 'a', 'Fox', 'G', 667, 5),
('539840d18e97c', '1', 'monster', '537323b23a6f2', '5397fcbea6c18', 'a', 'Orc', 'G', 87, 7),
('539840d23d23c', '1', 'monster', '537323b23a6f2', '5397fcd0e7782', 'a', 'river goblin', 'M', 50, 50);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` varchar(13) NOT NULL DEFAULT '',
  `email` varchar(50) DEFAULT NULL,
  `pswd` varchar(32) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`uid`, `email`, `pswd`, `type`) VALUES
('537323b23a6f2', 'a', 'b0baee9d279d34fa1dfd71aadb908c3f', 'dm'),
('537323e71eb77', 'b', 'b0baee9d279d34fa1dfd71aadb908c3f', 'player'),
('537323f7dbe75', 'c', 'b0baee9d279d34fa1dfd71aadb908c3f', 'player'),
('537324003b99a', 'd', 'b0baee9d279d34fa1dfd71aadb908c3f', 'player'),
('53732406dcbb0', 'e', 'b0baee9d279d34fa1dfd71aadb908c3f', 'player'),
('5373240e67a7e', 'f', 'b0baee9d279d34fa1dfd71aadb908c3f', 'player');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
