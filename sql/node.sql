-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 04 Avril 2016 à 17:51
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `idroid`
--

-- --------------------------------------------------------

--
-- Structure de la table `node`
--

CREATE TABLE IF NOT EXISTS `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questions` varchar(255) DEFAULT NULL,
  `results` varchar(255) DEFAULT NULL,
  `id_left_node_children` int(11) DEFAULT NULL,
  `id_right_node_children` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `date_insert` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=104 ;

--
-- Contenu de la table `node`
--

INSERT INTO `node` (`id`, `questions`, `results`, `id_left_node_children`, `id_right_node_children`, `id_user`, `date_insert`) VALUES
(1, 'Etes vous un homme ?', NULL, 2, 3, 2, '2016-02-09 15:33:48'),
(2, 'Etes vous un artiste ?', NULL, 4, 5, 2, '2016-02-09 15:33:48'),
(3, 'Etes vous Française ?', NULL, 6, 7, 2, '2016-02-09 15:33:48'),
(4, 'Etes vous un chanteur ?', NULL, 8, 9, 2, '2016-02-09 15:33:48'),
(5, 'Etes vous dans la politique', NULL, 10, 11, 2, '2016-02-09 15:33:48'),
(6, 'Etes vous connu ?', NULL, 12, 13, 2, '2016-02-09 15:33:48'),
(7, 'Etes vous dans le cinéma ?', NULL, 14, 15, 2, '2016-02-09 15:33:48'),
(8, 'Etes vous surnommé le King ?', NULL, 102, 103, 1, '2016-03-25 18:16:39'),
(9, NULL, 'Will Smith', NULL, NULL, 2, '2016-02-09 15:33:48'),
(10, NULL, 'Nicolas Sarkozy', NULL, NULL, 2, '2016-02-09 15:33:48'),
(11, NULL, 'Geoffrey Dubois', NULL, NULL, 2, '2016-02-09 16:16:09'),
(12, NULL, 'Martine Aubry', NULL, NULL, 2, '2016-02-09 15:33:48'),
(13, NULL, 'La Boulangère', NULL, NULL, 2, '2016-02-09 15:33:48'),
(14, NULL, 'Jessica Biel', NULL, NULL, 2, '2016-02-09 15:34:05'),
(102, NULL, 'Elvis Presley', NULL, NULL, 1, '2016-03-25 18:16:39'),
(103, NULL, 'Michael Jackson', NULL, NULL, 1, '2016-03-25 18:16:39');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `node`
--
ALTER TABLE `node`
  ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
