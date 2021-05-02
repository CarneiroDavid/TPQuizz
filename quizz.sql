-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 02 mai 2021 à 20:18
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `categoriequizz`
--

DROP TABLE IF EXISTS `categoriequizz`;
CREATE TABLE IF NOT EXISTS `categoriequizz` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categoriequizz`
--

INSERT INTO `categoriequizz` (`idCategorie`, `nom`) VALUES
(1, 'Anime'),
(3, 'Sports'),
(4, 'Serie'),
(5, 'Jeux'),
(6, 'test'),
(7, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `idQuestion` int(11) NOT NULL,
  `idReponse` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `lier`
--

DROP TABLE IF EXISTS `lier`;
CREATE TABLE IF NOT EXISTS `lier` (
  `idUser` int(11) NOT NULL,
  `pseudoEnvoyeur` varchar(100) NOT NULL,
  `idAmis` int(11) NOT NULL,
  `Etat` varchar(100) NOT NULL DEFAULT 'En attente'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `lier`
--

INSERT INTO `lier` (`idUser`, `pseudoEnvoyeur`, `idAmis`, `Etat`) VALUES
(2, 'Bastoz', 1, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

DROP TABLE IF EXISTS `participer`;
CREATE TABLE IF NOT EXISTS `participer` (
  `idUser` int(11) NOT NULL,
  `idQuizz` int(11) NOT NULL,
  `Score` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `idQuizz` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(100) NOT NULL,
  PRIMARY KEY (`idQuestion`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`idQuizz`, `idQuestion`, `Titre`) VALUES
(1, 1, 'Quelle est la couleur du cheval blanc d\'Henri IV'),
(1, 2, 'Quel est le résultat de l\'opération : \"2 + 2\" '),
(1, 3, 'Quel est la capital de la France'),
(1, 4, 'quel est la date du  couronnement de charlemagne'),
(1, 5, 'Ou se situe le Golden Gate Bridge'),
(1, 6, 'Combien de fois la France a t\'elle gagné la coupe du Monde de football'),
(1, 7, 'Qui est l\'inventeur de l\'ampoule'),
(1, 8, 'Quel est la première personne du singulier du verbe manger au présent'),
(1, 9, 'Qui a marché pour la première fois sur la Lune'),
(1, 10, 'Qui est l\'artiste a l\'origine de la Joconde');

-- --------------------------------------------------------

--
-- Structure de la table `questionsecrete`
--

DROP TABLE IF EXISTS `questionsecrete`;
CREATE TABLE IF NOT EXISTS `questionsecrete` (
  `idQuestionSecrete` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) NOT NULL,
  PRIMARY KEY (`idQuestionSecrete`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `questionsecrete`
--

INSERT INTO `questionsecrete` (`idQuestionSecrete`, `intitule`) VALUES
(1, 'test'),
(2, 'test2');

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

DROP TABLE IF EXISTS `quizz`;
CREATE TABLE IF NOT EXISTS `quizz` (
  `idQuizz` int(11) NOT NULL AUTO_INCREMENT,
  `idCategorie` int(11) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `idUser` int(11) NOT NULL,
  `statut` varchar(100) NOT NULL DEFAULT 'attente',
  PRIMARY KEY (`idQuizz`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quizz`
--

INSERT INTO `quizz` (`idQuizz`, `idCategorie`, `Titre`, `idUser`, `statut`) VALUES
(1, 1, 'Dragon ball', 1, 'true'),
(2, 1, 'One Piece', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `idReponse` int(11) NOT NULL AUTO_INCREMENT,
  `idQuestion` int(11) NOT NULL,
  `reponse` varchar(100) NOT NULL,
  `verification` varchar(100) NOT NULL,
  PRIMARY KEY (`idReponse`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`idReponse`, `idQuestion`, `reponse`, `verification`) VALUES
(1, 1, 'rouge', '4'),
(2, 1, 'noir', '4'),
(3, 1, 'blanc', '4'),
(4, 1, 'gris', '4'),
(5, 2, '4', '5'),
(6, 2, '5', '5'),
(7, 2, '22', '5'),
(8, 2, '3', '5'),
(9, 3, 'Londre', '12'),
(10, 3, 'Pékin', '12'),
(11, 3, 'Berlin', '12'),
(12, 3, 'Paris', '12'),
(13, 4, '800', '13'),
(14, 4, '790', '13'),
(15, 4, '1978', '13'),
(16, 4, '1889', '13'),
(17, 5, 'New York', '18'),
(18, 5, 'San Francisco', '18'),
(19, 5, 'Las Vegas', '18'),
(20, 5, 'Miami', '18'),
(21, 6, '2 fois', '21'),
(22, 6, '0 fois', '21'),
(23, 6, '1 fois', '21'),
(24, 6, '6 fois', '21'),
(29, 7, 'Nikola Tesla', '27'),
(26, 7, 'Albert Einstein', '27'),
(27, 7, 'Thomas Edison', '27'),
(28, 7, 'Gustave Eiffel', '27'),
(33, 8, 'Il mange', '34'),
(34, 8, 'Je mange', '34'),
(35, 8, 'Je mangeai', '34'),
(36, 8, 'Il mangera', '34'),
(37, 9, 'Vercingétorix', '40'),
(38, 9, 'Mark Zuckerberg', '40'),
(39, 9, 'Napoléon Bonaparte', '40'),
(40, 9, 'Neil Armstrong', '40'),
(41, 10, 'Vincent van Gogh', '42'),
(42, 10, 'Léonard de Vinci', '42'),
(43, 10, 'Claude Monet', '42'),
(44, 10, 'Arthur Rimbaud', '42');

-- --------------------------------------------------------

--
-- Structure de la table `selectionner`
--

DROP TABLE IF EXISTS `selectionner`;
CREATE TABLE IF NOT EXISTS `selectionner` (
  `idUser` int(11) NOT NULL,
  `idReponse` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `idQuizz` int(11) NOT NULL,
  PRIMARY KEY (`idUser`,`idQuestion`,`idQuizz`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(100) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `MDP` varchar(100) NOT NULL,
  `MDP2` varchar(100) NOT NULL,
  `statut` varchar(100) NOT NULL DEFAULT 'Membre',
  `idQuestionSecrete` int(11) NOT NULL,
  `repQuestionSecrete` varchar(100) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `identifiant` (`identifiant`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `identifiant`, `pseudo`, `nom`, `prenom`, `email`, `MDP`, `MDP2`, `statut`, `idQuestionSecrete`, `repQuestionSecrete`) VALUES
(1, 'carneirod1', 'niceluu', 'Carneiro', 'David', 'davidfoot7850@gmail.com', 'testtest', '$2y$10$qOieMM7AAlmbpm1CeiYJbu8xWTe0Y4Jt6AUQyznBAp8h1I04MhtZ2', 'Admin', 1, 'TestQuestion'),
(2, 'BLeraut72', 'Bastoz', 'Leraut', 'Bastien', 'test2@gmail.com', 'testtest', '$2y$10$m594aU6VM6FT.FIjBTyR2Ox4Dn6nWznHYpSk4UkQ9oNQ5TrfEhmdK', 'Membre', 2, 'LeTest');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
