-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 16 Janvier 2014 à 10:27
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `api-film`
--
CREATE DATABASE IF NOT EXISTS `api-film` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `api-film`;

-- --------------------------------------------------------

--
-- Structure de la table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `idFilm` int(11) NOT NULL AUTO_INCREMENT,
  `nomFilm` varchar(255) NOT NULL,
  `descFilm` text,
  `imageFilm` varchar(255) DEFAULT NULL,
  `datesortieFilm` date DEFAULT NULL,
  `dureeFilm` varchar(255) DEFAULT NULL,
  `auteurFilm` varchar(255) DEFAULT NULL,
  `nationnaliteFilm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idFilm`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `film`
--

INSERT INTO `film` (`idFilm`, `nomFilm`, `descFilm`, `imageFilm`, `datesortieFilm`, `dureeFilm`, `auteurFilm`, `nationnaliteFilm`) VALUES
(18, 'Horreur', 'Film qui fait vachement peur', NULL, NULL, NULL, NULL, NULL),
(19, 'Action', 'YA DES GENS QUI SE TAPENT §', NULL, NULL, NULL, NULL, NULL),
(20, 'action/comédie', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'TestUpdate', 'on teste la modif d''article 1', NULL, NULL, NULL, NULL, NULL),
(23, 'test suppr', 'on teste la suppr d''article', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `film_genre`
--

CREATE TABLE IF NOT EXISTS `film_genre` (
  `idFilm` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `film_genre`
--

INSERT INTO `film_genre` (`idFilm`, `idGenre`) VALUES
(18, 3),
(19, 1),
(20, 1),
(20, 4);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `idGenre` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) NOT NULL,
  PRIMARY KEY (`idGenre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `genre`
--

INSERT INTO `genre` (`idGenre`, `genre`) VALUES
(1, 'action'),
(2, 'aventure'),
(3, 'horreur'),
(4, 'comédie');

-- --------------------------------------------------------

--
-- Structure de la table `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `idUser` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `like`
--

INSERT INTO `like` (`idUser`, `idFilm`) VALUES
(36, 20),
(36, 18);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `token` varchar(255) DEFAULT NULL,
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `pseudoUser` varchar(255) NOT NULL,
  `mdpUser` varchar(255) NOT NULL,
  `emailUser` varchar(255) NOT NULL,
  `droitUser` varchar(255) NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`token`, `idUser`, `pseudoUser`, `mdpUser`, `emailUser`, `droitUser`) VALUES
('7fe4771c008a22eb763df47d19e2c6aa', 29, 'ben', '25f9e794323b453885f5181f1b624d0b', 'ben@ben.fr', '1'),
('f53643d8791a81f0421949222bd30b0c', 34, 'ben3', '6725ad6431b3c93ee1ed55a6185954cb"123456789', '', '1'),
('2ee5fc6f8bab8da907aa2391e45fca26', 36, 'ben5', 'f6a64e8511256911f22f9cf0074c27ac"123456789', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
