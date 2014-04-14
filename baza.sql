-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2014 at 07:18 PM
-- Server version: 5.5.36-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pulsir_hulkweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(140) COLLATE utf8_slovenian_ci NOT NULL,
  `content` text COLLATE utf8_slovenian_ci NOT NULL,
  `type` varchar(140) COLLATE utf8_slovenian_ci NOT NULL,
  `status` varchar(140) COLLATE utf8_slovenian_ci NOT NULL,
  `author` int(11) NOT NULL,
  `cucss` longtext COLLATE utf8_slovenian_ci NOT NULL,
  `cujs` longtext COLLATE utf8_slovenian_ci NOT NULL,
  `featured` varchar(140) COLLATE utf8_slovenian_ci NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(140) NOT NULL AUTO_INCREMENT,
  `user` int(140) NOT NULL,
  `ip` varchar(140) NOT NULL,
  `time` int(140) NOT NULL,
  `exptime` int(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE IF NOT EXISTS `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(140) NOT NULL,
  `text` mediumtext NOT NULL,
  `status` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(140) NOT NULL,
  `password` longtext NOT NULL,
  `salt` longtext NOT NULL,
  `realname` varchar(140) NOT NULL,
  `rank` varchar(140) NOT NULL,
  `email` varchar(140) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `realname`, `rank`, `email`) VALUES
(1, 'iweb', '$2a$12$W50Mz3HxplcbBjVyeknNBOLkDM.l7AZ.OrYyDVHLs67HVFnEbPtHe', '$2a$12$W50Mz3HxplcbBjVyeknNBQwPfRao8qMHFNYfomXh', 'Mario Borna Mjertan', 'superadmin', 'iweb@plsr.tk');
