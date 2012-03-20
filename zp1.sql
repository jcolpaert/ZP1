-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 20 Mar 2012 om 19:47
-- Serverversie: 5.5.9
-- PHP-Versie: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `zp1`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `languageID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `charset` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`languageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `language`
--

INSERT INTO `language` VALUES(1, 'nl', 'UTF-8');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `pageID` int(11) NOT NULL AUTO_INCREMENT,
  `creationDate` datetime DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT NULL,
  `pageFK` int(11) DEFAULT NULL,
  PRIMARY KEY (`pageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `page`
--

INSERT INTO `page` VALUES(1, '2012-03-20 19:14:08', 'active', 1);
INSERT INTO `page` VALUES(2, '2012-03-20 19:15:54', 'active', 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pageLang`
--

DROP TABLE IF EXISTS `pageLang`;
CREATE TABLE IF NOT EXISTS `pageLang` (
  `pageLangID` int(11) NOT NULL,
  `titel` varchar(255) DEFAULT NULL,
  `teaser` varchar(255) DEFAULT NULL,
  `content` text,
  `pageFK` int(11) DEFAULT NULL COMMENT '		',
  `languageFK` int(11) NOT NULL,
  PRIMARY KEY (`pageLangID`),
  KEY `fk_pageLang_page` (`pageFK`),
  KEY `fk_pageLang_language1` (`languageFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `pageLang`
--

INSERT INTO `pageLang` VALUES(1, 'Home', 'Home teaser', 'Lorem ipsum dolor sit amet.', 1, 1);
INSERT INTO `pageLang` VALUES(2, 'Over', 'Over baseline', 'Lorem ipsum dolor sit amet.', 2, 1);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `pageLang`
--
ALTER TABLE `pageLang`
  ADD CONSTRAINT `fk_pageLang_language1` FOREIGN KEY (`languageFK`) REFERENCES `language` (`languageID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pageLang_page` FOREIGN KEY (`pageFK`) REFERENCES `page` (`pageID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
