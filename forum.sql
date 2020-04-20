-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;

-- Listage de la structure de la table forum. postblog
CREATE TABLE IF NOT EXISTS `postblog` (
  `id_postblog` int(11) NOT NULL AUTO_INCREMENT,
  `post` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `postdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userblog_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `datemodif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_postblog`),
  KEY `user_id` (`userblog_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `postblog_ibfk_1` FOREIGN KEY (`userblog_id`) REFERENCES `userblog` (`id_userblog`),
  CONSTRAINT `postblog_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.postblog : ~9 rows (environ)
/*!40000 ALTER TABLE `postblog` DISABLE KEYS */;
INSERT INTO `postblog` (`id_postblog`, `post`, `postdate`, `userblog_id`, `topic_id`, `datemodif`) VALUES
	(1, 'Non papa on en a trop besoin', '2020-03-25 16:07:46', 2, 1, '2020-04-14 19:08:44'),
	(2, 'Oui vas-y tu pourras les jouer au poker...', '2020-03-25 16:07:45', 3, 1, '2020-04-14 19:08:54'),
	(3, 'On y va Ninjadada, faut que papa paye de toute nos privations...', '2020-03-25 16:07:29', 2, 3, '2020-04-15 01:41:53'),
	(4, 'T\'as raison mais on est en confinement on fait comment?', '2020-03-25 16:08:02', 3, 2, '2020-04-14 19:08:56'),
	(5, 'Lulu un mois de plus...', '2020-03-25 16:10:20', 1, 2, '2020-04-14 19:08:57'),
	(6, 'Ninja 30 jour de plus', '2020-03-25 16:12:04', 1, 3, '2020-04-15 01:45:37'),
	(11, 'j y vais', '2020-04-15 19:22:12', 47, 3, '2020-04-15 19:22:12'),
	(14, 'bande de nouilles plus on va vouloir y aller plus il te rajoutera des jours Ninjadada', '2020-04-15 19:31:50', 48, 3, '2020-04-15 19:31:50'),
	(43, 'tchou tchou', '2020-04-18 20:04:25', 1, 1, '2020-04-18 20:04:25');
/*!40000 ALTER TABLE `postblog` ENABLE KEYS */;

-- Listage de la structure de la table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `topicdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userblog_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  UNIQUE KEY `title` (`title`),
  KEY `user_id` (`userblog_id`),
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`userblog_id`) REFERENCES `userblog` (`id_userblog`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.topic : ~4 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `title`, `content`, `topicdate`, `userblog_id`) VALUES
	(1, 'Papier toilette', 'Dois-je revendre à prix d\'or mon papier toilette', '2020-03-25 16:00:55', 1),
	(2, 'Privé de téléphone portable ', 'Dois-je dénoncer mon père à la police pour harcèlement moral', '2020-03-25 16:02:48', 2),
	(3, 'Privé de console de jeux', 'Dois-je aller avec ma soeur pour dénoncer mon père', '2020-03-25 16:03:37', 3),
	(34, 'Le travail c&#39;est la santé', 'Ne rien faire c&#39;est la conserver', '2020-04-17 15:29:32', 1);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum. userblog
CREATE TABLE IF NOT EXISTS `userblog` (
  `id_userblog` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` json DEFAULT NULL,
  `email` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mdp` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userblogdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_userblog`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

-- Listage des données de la table forum.userblog : ~6 rows (environ)
/*!40000 ALTER TABLE `userblog` DISABLE KEYS */;
INSERT INTO `userblog` (`id_userblog`, `pseudo`, `role`, `email`, `mdp`, `userblogdate`, `avatar`) VALUES
	(1, 'Kleenexx', '["ROLE USER", "ROLE ADMIN"]', 'kleenexx@gmail.com', '$2y$10$16zJa4uXnAGezuePlQ22U.tvlmWTaS2ql0QWKZHrkP5gfYud73FZO', '2020-04-14 12:58:46', '1.jpg'),
	(2, 'Lulu27', '["ROLE USER"]', 'lulu27gamil.com', '$2y$10$NIT1ylkuTN.ndd69M9gWyuonlqab0h5H1LGGYq5NTqIuDmoDPKXnO', '2020-04-14 12:23:16', '2.jpg'),
	(3, 'NinjaDada', '["ROLE USER"]', 'ninjad@gamil.com', '$2y$10$wuW8Vj4MSRQBF6V.vRN3YO8kWIQe2S0SYymWLDiaF2m9RhdE1EhUm', '2020-04-13 18:15:18', '3.jpg'),
	(45, 'Hulk', '["ROLE USER"]', 'hulk@gmail.com', '$2y$10$16zJa4uXnAGezuePlQ22U.tvlmWTaS2ql0QWKZHrkP5gfYud73FZO', '2020-04-15 16:07:28', '45.jpg'),
	(47, 'dani leelee', '["ROLE USER"]', 'bonbon@dada.com', '$2y$10$qkS4vowc7nroWreCYEx4Oevoz6MJ6ufWcy3H9wyg1AlD39MJDmMJe', '2020-04-15 19:20:24', NULL),
	(48, 'LULU', '["ROLE USER"]', 'lulusmiley27@gmail.com', '$2y$10$h74YqN8RBdVxbCgLN/uPvemHiLf/VfN2gCmhJ958YJgmeAyzp9ZSG', '2020-04-15 19:27:47', NULL);
/*!40000 ALTER TABLE `userblog` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
