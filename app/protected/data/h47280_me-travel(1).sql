-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Апр 05 2013 г., 18:45
-- Версия сервера: 5.1.67
-- Версия PHP: 5.3.6-13ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `h47280_me-travel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `blog`
--

REPLACE INTO `blog` (`id`, `title`, `fio`, `user_id`, `deleted`) VALUES
(1, 'Удивительное рядом', 'Лемнев Сергей Владимирович', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `text` text NOT NULL,
  `blog_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `ip`
--

CREATE TABLE IF NOT EXISTS `ip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `attempt` int(2) unsigned NOT NULL,
  `last_date_attempt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `travel`
--

CREATE TABLE IF NOT EXISTS `travel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `maps_label` varchar(255) NOT NULL,
  `date` int(10) unsigned NOT NULL,
  `text` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `private` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `travel`
--

REPLACE INTO `travel` (`id`, `title`, `maps_label`, `date`, `text`, `user_id`, `private`) VALUES
(1, 'Москва', '55.76, 37.64', 1345679888, 'Был в москве понравилось очень :)', 1, 0),
(2, 'Санкт-Петербург', '30.306631,59.930261', 1345679999, 'И в Питере тоже ничего', 1, 0),
(3, 'Прага', '38.66, 61.33', 1364456434, 'Офигительно, но нету ничего', 1, 0),
(4, 'Где то там', '55.16, 30.67', 1369456434, 'Тут будет лес', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(32) NOT NULL,
  `roleId` tinyint(3) unsigned NOT NULL,
  `blocked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `user`
--

REPLACE INTO `user` (`id`, `name`, `email`, `password`, `roleId`, `blocked`, `deleted`) VALUES
(1, 'enot', 'enot@yandex.ru', 'g7akTYJMHBRTA', 1, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
