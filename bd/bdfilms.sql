-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 13 juin 2020 à 01:33
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.6
/*TODO: Mettre à jour ce fichier avant la remise*/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdfilms`
--

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `realisateur` varchar(60) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `duree` int(11) NOT NULL,
  `prix` decimal(6,2) NOT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `realisateur`, `categorie`, `duree`, `prix`, `image`) VALUES
(1, 'Adaptation', 'Charlie Kaufman', 'Drame', 115, '10.99', 'adaptation.jpg'),/*TODO: enlever le commentaire 0*/
(2, 'Arrival', 'Denis Villeneuve', 'Science-fiction', 116, '17.99', 'arrival.jpg'),
(3, 'Léolo', 'Jean-Claude Lauzon', 'Drame', 107, '15.99', 'leolo.jpg'),
(4, 'Stalker', 'Andrei Tarkovsky', 'Science-fiction', 162, '21.99', 'stalker.jpg'),
(5, 'Swiss Army Man', 'Dan Kwan', 'Comédie', 97, '9.99', 'swiss_army_man');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
