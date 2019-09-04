-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 07. März 2013 um 09:17
-- Server Version: 5.1.44
-- PHP-Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `sapperlot`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contentlinks`
--

CREATE TABLE `contentlinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) NOT NULL,
  `linkedcontent_id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `container` varchar(255) NOT NULL,
  `var1` text,
  `var2` text,
  `var3` text,
  `var4` text,
  `var5` text,
  UNIQUE KEY `id` (`id`),
  KEY `contentlinks_ibfk_1` (`content_id`),
  KEY `contentlinks_ibfk_2` (`linkedcontent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `contentlinks`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contentmodules`
--

CREATE TABLE `contentmodules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `viewfolder` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Daten für Tabelle `contentmodules`
--

INSERT INTO `contentmodules` VALUES(24, 'Text mit Bild', 'Ein Text mit einem Bild, das Standardcontentelement', 'templates/contents/textmitbild');
INSERT INTO `contentmodules` VALUES(25, 'Collection Auszug', 'Damit wird ein Auszug aus einer Sammlung dargestellt nach gewissen Filter- oder Ordnungskriterien. Zb. die neuesten 3 Newsartikel aus der Newssammlung.', 'templates/contents/collection_ex');
INSERT INTO `contentmodules` VALUES(26, 'Kunde', 'Das Contentmodule f&uuml;r die Kunden, wird vorallem auf der Kundenseite verwendet', 'templates/contents/kunde');
INSERT INTO `contentmodules` VALUES(27, 'Arbeit', 'Das Contentmodul f&uuml;r die Arbeitselemente', 'templates/contents/arbeit');
INSERT INTO `contentmodules` VALUES(28, 'Startseite', '', 'templates/contents/startseite');
INSERT INTO `contentmodules` VALUES(30, 'Newsartikel', 'Ein Artikel speziell f&uuml;r die News, das Datum ist wichtig', 'templates/contents/newsartikel');
INSERT INTO `contentmodules` VALUES(34, 'Tag', '', 'templates/contents/tag');
INSERT INTO `contentmodules` VALUES(36, 'Redirector', 'Leitet auf eine andere URL weiter.', 'templates/contents/redirector');
INSERT INTO `contentmodules` VALUES(37, 'Login Box', 'Ein Login-Formular für das Frontend', 'templates/contents/loginbox');
INSERT INTO `contentmodules` VALUES(38, 'User-Info Box', 'Box mit Informationen über den eingeloggten Frontend-User, Logout-Link, etc.', 'templates/contents/userinfobox');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shortname` varchar(255) NOT NULL,
  `node_id` int(11) DEFAULT NULL,
  `contentmodule_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `lang` varchar(100) DEFAULT NULL,
  `container` varchar(255) NOT NULL,
  `type` varchar(200) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `lead` text,
  `text` text,
  `tags` text,
  `code` text,
  `url` text,
  `date` varchar(255) DEFAULT NULL,
  `var1` text,
  `var2` text,
  `var3` text,
  `var4` text,
  `var5` text NOT NULL,
  `var6` text NOT NULL,
  `var7` text NOT NULL,
  `var8` text NOT NULL,
  `var9` text NOT NULL,
  `var10` text NOT NULL,
  `var11` text NOT NULL,
  `var12` text NOT NULL,
  `var13` text NOT NULL,
  `var14` text NOT NULL,
  `var15` text NOT NULL,
  `vars` text NOT NULL,
  `position` int(11) DEFAULT NULL,
  `created_on` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` varchar(255) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`shortname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=902 ;

--
-- Daten für Tabelle `contents`
--

INSERT INTO `contents` VALUES(896, '', 379, 37, NULL, 1, 'de', 'content', 'content', 'Login (user: ''frontend_user'', Passwort im Admin-Bereich neu setzen)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '378', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 10, '2013-03-06 16:11:54', 1, '2013-03-07 09:15:35', 1);
INSERT INTO `contents` VALUES(897, '', 379, 37, NULL, 1, 'en', 'content', 'content', 'Login (user: ''frontend_user'', set new password in admin-panel)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '378', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, '2013-03-06 16:12:14', 1, '2013-03-07 09:15:56', 1);
INSERT INTO `contents` VALUES(898, '', 378, 24, NULL, 1, 'de', 'content', 'content', 'Willkommen im internen Bereich', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 10, '2013-03-06 16:15:55', 1, '2013-03-06 16:16:14', 1);
INSERT INTO `contents` VALUES(899, '', 378, 24, NULL, 1, 'en', 'content', 'content', 'Welcome to the restricted area', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, '2013-03-06 16:16:14', 1, '2013-03-06 16:16:25', 1);
INSERT INTO `contents` VALUES(900, '', 378, 38, NULL, 1, 'en', 'footer', 'content', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '379', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 10, '2013-03-06 16:16:29', 1, '2013-03-06 16:16:43', 1);
INSERT INTO `contents` VALUES(901, '', 378, 38, NULL, 1, 'de', 'footer', 'content', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '379', NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', 0, '2013-03-06 16:16:43', 1, '2013-03-06 16:16:50', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `medialinks`
--

CREATE TABLE `medialinks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) unsigned NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `container` varchar(255) NOT NULL,
  `url` varchar(512) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `mimetype` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `text` text,
  `alttag` varchar(255) NOT NULL,
  `media_parameters` text,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`,`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `medialinks`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodemetaobjects`
--

CREATE TABLE `nodemetaobjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_id` int(11) DEFAULT NULL,
  `lang` varchar(200) DEFAULT NULL,
  `menutitle` varchar(200) DEFAULT NULL,
  `windowtitle` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `var1` text NOT NULL,
  `var2` text NOT NULL,
  `var3` text NOT NULL,
  `var4` text NOT NULL,
  `var5` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=264 ;

--
-- Daten für Tabelle `nodemetaobjects`
--

INSERT INTO `nodemetaobjects` VALUES(185, 340, 'de', 'Home', 'Window title', 'description', 'some words, go here, yes.', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(194, 340, 'en', 'Home (en)', 'Home (en)', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(195, 262, 'en', 'Main Menu', 'Main Menu', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(196, 262, 'de', 'Hauptmenü', 'Hauptmenü', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(204, 351, 'de', 'Footermenü', '', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(208, 351, 'en', 'Footer Menu', '', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(213, 355, 'de', 'Disclaimer', 'page_355', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(214, 356, 'de', 'Impressum', 'page_356', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(215, 357, 'de', 'Kontakt', 'Kontakt', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(217, 357, 'en', 'Contact', 'page_357', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(218, 356, 'en', 'Impressum', 'page_356', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(219, 355, 'en', 'Disclaimer', 'page_355', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(220, 358, 'de', 'Arbeiten', 'page_358', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(222, 358, 'en', 'Work', 'Work', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(229, 363, 'de', 'Collection', 'collection_363', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(230, 363, 'en', 'Collection', 'Collection_Tables', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(244, 375, 'de', 'Home', '', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(249, 375, 'en', 'Home', '', '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(257, 378, 'en', 'Restricted Area', NULL, '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(258, 378, 'de', 'Interner Bereich', NULL, '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(259, 379, 'de', 'Login', NULL, '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(260, 379, 'en', 'Login', NULL, '', '', '', '', '', '', '');
INSERT INTO `nodemetaobjects` VALUES(263, NULL, 'en', NULL, NULL, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodes`
--

CREATE TABLE `nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `scope` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `nodetemplate_id` int(11) DEFAULT NULL,
  `shortname` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) DEFAULT NULL,
  `displayhook` varchar(255) DEFAULT NULL,
  `title` text,
  `loginpage` text,
  `created_on` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_on` varchar(255) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`shortname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=380 ;

--
-- Daten für Tabelle `nodes`
--

INSERT INTO `nodes` VALUES(262, 0, 1, 16, 1, 1, 0, 4, '_262', 1, 'navitree', 'mainnavi', 'Hauptmenü', '', '0000-00-00 00:00:00', 0, '2013-03-06 16:50:33', 1);
INSERT INTO `nodes` VALUES(340, 262, 2, 3, 2, 1, 0, 1, 'home', 1, 'page', 'startpage', 'Homepage', '', '0000-00-00 00:00:00', 0, '2013-03-06 16:21:03', 1);
INSERT INTO `nodes` VALUES(351, 0, 1, 8, 1, 3, 10, 4, '_351', 1, 'navitree', 'footernavi', 'footernavi', '', '0000-00-00 00:00:00', 0, '2012-09-13 11:29:44', 0);
INSERT INTO `nodes` VALUES(355, 351, 4, 5, 2, 3, 0, 1, 'disclaimer', 1, 'page', '', 'page_355', '', '', 0, '2012-09-13 15:33:30', 0);
INSERT INTO `nodes` VALUES(356, 351, 2, 3, 2, 3, 0, 1, 'Impressum', 1, 'page', '', 'page_356', '', '', 0, '2012-09-22 14:38:18', 1);
INSERT INTO `nodes` VALUES(357, 262, 6, 7, 2, 1, 0, 1, 'kontakt', 1, 'page', '', 'page_357', '', '', 0, '2013-03-06 16:21:03', 1);
INSERT INTO `nodes` VALUES(358, 262, 4, 5, 2, 1, 0, 1, 'arbeiten', 1, 'page', '', 'page_358', '', '', 0, '2013-03-06 16:21:03', 1);
INSERT INTO `nodes` VALUES(363, 0, 1, 2, 1, 5, 30, 14, 'collection363', 1, 'collection', '', 'Collection', '', '', 0, '2012-09-22 12:52:42', 1);
INSERT INTO `nodes` VALUES(375, 351, 6, 7, 2, 3, 0, 15, 'home2', 1, 'page', '', 'page_375', '', '', 0, '2012-09-22 19:11:56', 1);
INSERT INTO `nodes` VALUES(378, 262, 8, 9, 2, 1, 0, 1, 'intern', 1, 'page', NULL, 'page_378', '379', '2013-03-06 16:09:20', NULL, '2013-03-06 16:21:03', 1);
INSERT INTO `nodes` VALUES(379, 262, 10, 11, 2, 1, 0, 1, 'intern_login', 0, 'page', NULL, 'page_379', NULL, '2013-03-06 16:10:08', NULL, '2013-03-06 16:21:03', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodetemplates`
--

CREATE TABLE `nodetemplates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) DEFAULT NULL,
  `description` text,
  `type` varchar(255) NOT NULL,
  `containers` text NOT NULL,
  `viewfolder` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Daten für Tabelle `nodetemplates`
--

INSERT INTO `nodetemplates` VALUES(1, 'Eine Standardseite', 'Das Standardtemplate, welches normalerweise angewendet werden sollte.', 'page', 'content,footer', 'templates/pages/standard');
INSERT INTO `nodetemplates` VALUES(2, 'Collection Arbeiten /  Kunden', 'Das Template zur Darstellung von Inhalten, die direkt aus einer Collection gewonnen werden.', 'collection', 'arbeiten,kunden,tags', 'templates/collections/standard');
INSERT INTO `nodetemplates` VALUES(4, 'Navigationsbaum', 'Der Normale Navigationsbaum', 'navitree', '', '');
INSERT INTO `nodetemplates` VALUES(14, 'Collection DataTables', '', 'collection', 'arbeiten,kunden,tags', 'templates/collections/tables');
INSERT INTO `nodetemplates` VALUES(15, 'Weiterleitung', '<p>Pages mit diesem Template haben keinen Inhalt, sondern leiten einfach auf eine andere Page weiter.</p>', 'page', 'redirect', 'templates/pages/redirect');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `nodetemplates_contentmodules`
--

CREATE TABLE `nodetemplates_contentmodules` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nodetemplate_id` int(11) NOT NULL,
  `contentmodule_id` int(11) NOT NULL,
  `container` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_nodetemplate_id` (`nodetemplate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=681 ;

--
-- Daten für Tabelle `nodetemplates_contentmodules`
--

INSERT INTO `nodetemplates_contentmodules` VALUES(661, 2, 27, 'arbeiten');
INSERT INTO `nodetemplates_contentmodules` VALUES(662, 2, 26, 'kunden');
INSERT INTO `nodetemplates_contentmodules` VALUES(665, 2, 34, 'tags');
INSERT INTO `nodetemplates_contentmodules` VALUES(670, 15, 36, 'redirect');
INSERT INTO `nodetemplates_contentmodules` VALUES(671, 14, 26, 'kunden');
INSERT INTO `nodetemplates_contentmodules` VALUES(672, 14, 34, 'tags');
INSERT INTO `nodetemplates_contentmodules` VALUES(674, 14, 27, 'arbeiten');
INSERT INTO `nodetemplates_contentmodules` VALUES(675, 1, 37, 'content');
INSERT INTO `nodetemplates_contentmodules` VALUES(676, 1, 24, 'content');
INSERT INTO `nodetemplates_contentmodules` VALUES(677, 1, 38, 'content');
INSERT INTO `nodetemplates_contentmodules` VALUES(678, 1, 37, 'footer');
INSERT INTO `nodetemplates_contentmodules` VALUES(679, 1, 24, 'footer');
INSERT INTO `nodetemplates_contentmodules` VALUES(680, 1, 38, 'footer');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles`
--

CREATE TABLE `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `roles`
--

INSERT INTO `roles` VALUES(1, 'login', 'Darf sich einloggen');
INSERT INTO `roles` VALUES(2, 'admin', 'Hauptadministrator, darf alles');
INSERT INTO `roles` VALUES(3, 'contentadmin', 'Kann Contents bearbeiten, aber nicht die Struktur der Seite verÃƒÂ¤ndern');
INSERT INTO `roles` VALUES(4, 'frontend-login', 'Beispiel-Rolle für den Frontend-Login');
INSERT INTO `roles` VALUES(5, 'backend-login', 'Rolle für User, die sich im Backend anmelden dürfen. (ausser User ''admin'', dieser darf sich sowieso im Backend anmelden)');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles_nodes`
--

CREATE TABLE `roles_nodes` (
  `node_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `roles_nodes`
--

INSERT INTO `roles_nodes` VALUES(378, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `roles_users`
--

CREATE TABLE `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `roles_users`
--

INSERT INTO `roles_users` VALUES(1, 1);
INSERT INTO `roles_users` VALUES(2, 1);
INSERT INTO `roles_users` VALUES(3, 1);
INSERT INTO `roles_users` VALUES(1, 2);
INSERT INTO `roles_users` VALUES(2, 3);
INSERT INTO `roles_users` VALUES(3, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` varchar(64) NOT NULL,
  `hasglobalrights` tinyint(1) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` VALUES(1, 'm.rohrbach@robandrose.ch', 'admin', '297e9643b98aec449ad5d8e8ddd5c3f1f8e806fd1b2fcd7182e9f8ade17b4946', 1, 253, 1362586347);
INSERT INTO `users` VALUES(2, 'b.rufer@robandrose.ch', 'client', 'b25464e5ce6acea5471c3e03b8a2409d3167e950507dc6a80f7c993cad23cbdc', 1, 12, 1329050850);
INSERT INTO `users` VALUES(3, 'the_password_is@user123456.com', 'frontend_user', 'c1db7a1266642814f2f8e2515440ed604e3ad9d94ba1c082082daa9d4c2396dc', 0, 13, 1362644214);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users_nodes`
--

CREATE TABLE `users_nodes` (
  `user_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `users_nodes`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(40) NOT NULL,
  `type` varchar(100) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  KEY `expires` (`expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `user_tokens`
--


--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

