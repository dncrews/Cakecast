SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `podcast`
--

-- --------------------------------------------------------

--
-- Table structure for table `podcasts`
--

CREATE TABLE IF NOT EXISTS `casts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `summary` text COLLATE utf8_swedish_ci,
  `keywords` text COLLATE utf8_swedish_ci NOT NULL,
  `filename` text COLLATE utf8_swedish_ci,
  `created` datetime DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `duration` varchar(11) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
  `mime_type` varchar(25) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=58 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
  `subtitle` text COLLATE utf8_swedish_ci NOT NULL,
  `summary` longtext COLLATE utf8_swedish_ci NOT NULL,
  `description` longtext COLLATE utf8_swedish_ci NOT NULL,
  `category` text COLLATE utf8_swedish_ci NOT NULL,
  `owner_name` text COLLATE utf8_swedish_ci NOT NULL,
  `owner_email` text COLLATE utf8_swedish_ci NOT NULL,
  `album_art` text COLLATE utf8_swedish_ci NOT NULL,
  `copyright` text COLLATE utf8_swedish_ci NOT NULL,
  `author` text COLLATE utf8_swedish_ci NOT NULL,
  `site_url` varchar(255) COLLATE utf8_swedish_ci NOT NULL DEFAULT '',
  `explicit` varchar(5) COLLATE utf8_swedish_ci NOT NULL,
  `autoplay` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=4 ;
