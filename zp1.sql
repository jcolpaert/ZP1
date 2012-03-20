-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 20 Mar 2012 om 20:30
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
-- Tabelstructuur voor tabel `nieuws`
--

DROP TABLE IF EXISTS `nieuws`;
CREATE TABLE IF NOT EXISTS `nieuws` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `titel` varchar(150) COLLATE utf8_bin NOT NULL,
  `omschrijving` text COLLATE utf8_bin NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `nieuws`
--

INSERT INTO `nieuws` VALUES(1, 'Nieuwsbericht 1', 0x4c6f72656d20697073756d20646f6c6f722073697420616d65742e, '2012-03-08');
INSERT INTO `nieuws` VALUES(2, 'Nieuwsbericht 2', 0x4c6f72656d20697073756d2e, '2012-03-09');
INSERT INTO `nieuws` VALUES(3, 'Nieuwsbericht 3', 0x4c6f72656d20697073756d20646f6c6f722e, '2012-03-06');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `page`
--

INSERT INTO `page` VALUES(1, '2012-03-20 19:14:08', 'active', 1);
INSERT INTO `page` VALUES(2, '2012-03-20 19:15:54', 'active', 2);
INSERT INTO `page` VALUES(3, '2012-03-20 20:13:14', 'active', 3);
INSERT INTO `page` VALUES(4, '2012-03-20 20:19:48', 'active', 4);

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
  `controller` varchar(25) NOT NULL,
  `action` varchar(25) NOT NULL,
  `pageFK` int(11) DEFAULT NULL COMMENT '		',
  `languageFK` int(11) NOT NULL,
  PRIMARY KEY (`pageLangID`),
  KEY `fk_pageLang_page` (`pageFK`),
  KEY `fk_pageLang_language1` (`languageFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden uitgevoerd voor tabel `pageLang`
--

INSERT INTO `pageLang` VALUES(1, 'Home', 'Home teaser', 'Lorem ipsum dolor sit amet.', 'index', 'index', 1, 1);
INSERT INTO `pageLang` VALUES(2, 'Over', 'Over baseline', 'Lorem ipsum dolor sit amet.', 'page', 'index', 2, 1);
INSERT INTO `pageLang` VALUES(3, 'Contact', 'Contact ons voor meer informatie', 'Lorem ipsum dolor sit amet amai mijne frak.', 'page', 'contact', 3, 1);
INSERT INTO `pageLang` VALUES(4, 'Nieuws', 'Alle nieuwtjes', 'Lees hier alle nieuwtjes.', 'nieuws', 'index', 4, 1);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `pageLang`
--
ALTER TABLE `pageLang`
  ADD CONSTRAINT `fk_pageLang_language1` FOREIGN KEY (`languageFK`) REFERENCES `language` (`languageID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pageLang_page` FOREIGN KEY (`pageFK`) REFERENCES `page` (`pageID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
