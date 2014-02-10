-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2014 at 02:46 AM
-- Server version: 5.1.72
-- PHP Version: 5.3.3-7+squeeze18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c6_abelardo`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_entered` datetime NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(48) NOT NULL,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Used to keep track of all the blog authors' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `date_entered`, `first_name`, `last_name`, `email`) VALUES
(1, '2014-02-07 23:44:47', 'John', 'Doe', 'john@doe.com'),
(2, '2014-02-08 00:54:39', 'Alice', 'Isnthere', 'alice@isnthere.com');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(5) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`) VALUES
(1, 'Estáticas'),
(3, 'Blog');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('Draft','Published') NOT NULL,
  `display_order` int(5) unsigned NOT NULL,
  `date_entered` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `category_id` int(5) unsigned NOT NULL DEFAULT '0',
  `tags` varchar(254) DEFAULT NULL,
  `title` varchar(48) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `display_order` (`display_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Used to keep track of all the blog posts' AUTO_INCREMENT=8 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `status`, `display_order`, `date_entered`, `last_updated`, `author_id`, `category_id`, `tags`, `title`, `body`) VALUES
(1, 'Published', 0, '2014-02-08 00:55:32', '2014-02-10 02:32:48', 1, 3, 'primera entrada blog', 'Primera entrada de blog', '<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.</p>\r\n'),
(2, 'Published', 0, '2014-02-09 00:54:23', '2014-02-10 02:33:55', 2, 3, 'entrada html', 'Entrada con html', '<p>Se puede poner HTML con el editor wysiwyg.</p>\r\n\r\n<p>Esto est&aacute; en&nbsp;<strong>negrita</strong>. Y esto&nbsp;<s>tachado</s>.</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(3, 'Published', 0, '2014-02-09 01:20:02', '2014-02-10 02:34:39', 1, 3, 'entrada', 'Tercera entrada del blog', '<p>Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.</p>\r\n'),
(7, 'Published', 0, '2014-02-10 02:40:03', '2014-02-10 02:46:16', 1, 1, 'instrucciones leeme', 'Léeme', '<p>Para funcionar:</p>\r\n\r\n<ol>\r\n	<li>Crear base de datos</li>\r\n	<li>Importar<em>&nbsp;setup_with_examples.sql</em></li>\r\n	<li>Editar <em>inc/define.php</em></li>\r\n</ol>\r\n\r\n<pre>\r\n// Database Connection Options\r\ndefine(&#39;DB_USER&#39;, &#39;usuario&#39;);\r\ndefine(&#39;DB_PASS&#39;, &#39;contrase&ntilde;a&#39;);\r\ndefine(&#39;DB_HOST&#39;, &#39;servidor&#39;);\r\ndefine(&#39;DB_DEFAULT&#39;, &#39;nombre_base_de_datos&#39;);</pre>\r\n\r\n<p><span style="line-height:1.6">Se debe proteger el acceso a /manager mediante </span><em style="line-height:1.6">.htaccess</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_tag_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(5) unsigned NOT NULL,
  `tag_id` int(5) unsigned NOT NULL,
  PRIMARY KEY (`post_tag_id`),
  KEY `post_id` (`post_id`,`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `post_tag`
--

INSERT INTO `post_tag` (`post_tag_id`, `post_id`, `tag_id`) VALUES
(9, 5, 4),
(15, 7, 8),
(14, 3, 7),
(13, 2, 6),
(8, 4, 3),
(12, 1, 5),
(11, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `ses_id` varchar(32) NOT NULL,
  `last_access` int(12) unsigned NOT NULL,
  `ses_start` int(12) unsigned NOT NULL,
  `ses_value` text NOT NULL,
  PRIMARY KEY (`ses_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Used to store the sessions data';

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`ses_id`, `last_access`, `ses_start`, `ses_value`) VALUES
('esrk56u85h9r8lj1dtej212h15', 1391996779, 1391993020, 's:192:"ytgMAZAzvO1rbNOJmBSRir_wgocFSjQyxoafJiXfB3pJ7tHgplwjzJnbwblv5IKEETshzT3-5XgSjSNB9W_4Qty45CLcnvRR6YaOCiCGJkYd-Y8wuCHyXUmNEevrrQQXnWeDBoMpsU_9dTQwTEeTr_bkXFo47tQbsOPhC25rcFfpeJn0shtShbQvgmY9W2D_";'),
('b0ok4477nhfgoagv5k47f4okg4', 1391995378, 1391995331, 's:108:"LUOOGHYvW1M6k5m3YOk59ZQZQRdaVug7zoMP_vvMh9szXVwkozVfa4GBBQ4nhne4f_nfNHlC12T_O_PgfpUeGbv6MjFNJGNR8vA9RRDyi2A.";');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(24) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag` (`tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag`) VALUES
(1, 'prueba'),
(2, 'php'),
(3, 'html'),
(4, 'imagenes'),
(5, 'primera entrada blog'),
(6, 'entrada html'),
(7, 'entrada'),
(8, 'instrucciones leeme');
