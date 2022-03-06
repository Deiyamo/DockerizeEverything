-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 26 jan. 2022 à 16:23
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `MesBouquins`
--

-- --------------------------------------------------------

--
-- Structure de la table `Book`
--

CREATE TABLE `Book` (
  `isbn` varchar(13) NOT NULL,
  `title` varchar(200) NOT NULL,
  `author` varchar(150) NOT NULL,
  `overview` text,
  `picture` blob,
  `read_count` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Book`
--

INSERT INTO `Book` (`isbn`, `title`, `author`, `overview`, `picture`, `read_count`) VALUES
('12', 'Tim', 'Voss', NULL, NULL, 1),
('4U34B', 'Tim', 'Voss', NULL, NULL, 1),
('B34B', 'Tim', 'Voss', NULL, NULL, 1),
('BO34B', 'Tim', 'Voss', NULL, NULL, 1),
('BOB', 'Test', 'test', NULL, NULL, 1),
('BOB34B', 'Tim', 'Voss', NULL, NULL, 1),
('BOBI', 'patrick', 'jean', NULL, NULL, 11),
('BOBOB', 'Test', 'test', 'lorem ipsum', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
