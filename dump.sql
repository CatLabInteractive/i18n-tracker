-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 21 mei 2015 om 00:52
-- Serverversie: 5.5.43-0ubuntu0.14.04.1
-- PHP-versie: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `i18n_tracker`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bundles`
--

CREATE TABLE IF NOT EXISTS `bundles` (
  `bundle_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `bundle_language` varchar(50) NOT NULL,
  PRIMARY KEY (`bundle_id`),
  UNIQUE KEY `project_id` (`project_id`,`bundle_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_token` varchar(50) NOT NULL,
  PRIMARY KEY (`project_id`),
  UNIQUE KEY `project_token` (`project_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `resources`
--

CREATE TABLE IF NOT EXISTS `resources` (
  `resource_id` int(11) NOT NULL AUTO_INCREMENT,
  `bundle_id` int(11) NOT NULL,
  `resource_token` varchar(255) NOT NULL,
  `resource_n` int(11) NOT NULL,
  `resource_text` text NOT NULL,
  PRIMARY KEY (`resource_id`),
  UNIQUE KEY `bundle_id` (`bundle_id`,`resource_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `set_time` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `bundles`
--
ALTER TABLE `bundles`
  ADD CONSTRAINT `bundles_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`project_id`);

--
-- Beperkingen voor tabel `resources`
--
ALTER TABLE `resources`
  ADD CONSTRAINT `resources_ibfk_1` FOREIGN KEY (`bundle_id`) REFERENCES `bundles` (`bundle_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;