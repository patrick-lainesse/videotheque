-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 24 juil. 2020 à 21:32
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.6

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
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `idConnexion` int(11) NOT NULL,
  `mdp` varchar(30) NOT NULL,
  `role` enum('admin','membre') NOT NULL,
  `idMembre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`idConnexion`, `mdp`, `role`, `idMembre`) VALUES
(1, 'patrick', 'membre', 1),
(2, 'admin@gmail.com', 'admin', 2),
(3, 'membre@gmail.com', 'membre', 3),
(4, 'violette', 'membre', 4),
(5, 'ouch', 'membre', 5),
(6, 'samuel', 'membre', 6),
(7, 'avion', 'membre', 7),
(8, 'maude', 'membre', 8),
(9, 'gadg', 'membre', 9);

-- --------------------------------------------------------

--
-- Structure de la table `films`
--
-- DATE, ne fonctionne pas sur MYSQL: DEFAULT current_timestamp()
CREATE TABLE `films` (
  `id` int(11) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `realisateur` varchar(60) NOT NULL,
  `categorie` varchar(20) NOT NULL,
  `duree` int(11) NOT NULL,
  `prix` decimal(6,2) NOT NULL,
  `image` varchar(60) NOT NULL,
  `youtube` varchar(20) DEFAULT NULL,
  `sortie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `titre`, `realisateur`, `categorie`, `duree`, `prix`, `image`, `youtube`, `sortie`) VALUES
(1, 'Adaptation', 'Charlie Kaufman', 'Drame', 115, '10.99', '4f503c2f92450416e7636fd85d4f7529bb1e419e.jpg', '5VfPmhAiVXs', '2003-02-14'),
(2, 'Arrival', 'Denis Villeneuve', 'Science-fiction', 116, '17.99', 'b5a92c3fa8c65d20774ce2a64c0e95ab45d41986.jpg', 'tFMo3UJ4B4g', '2016-09-09'),
(3, 'Léolo', 'Jean-Claude Lauzon', 'Drame', 107, '15.99', 'b0b37a0f9e490afc75483400bbf1e7b4d374e626.jpg', 'nTfqKG--JwQ', '1992-05-17'),
(4, 'Stalker', 'Andrei Tarkovsky', 'Science-fiction', 162, '21.99', '13d7f25d9235d8adf20389e8680d6d725782d6ec.jpg', 'sMGA2wMuiP4', '2007-03-20'),
(5, 'Swiss Army Man', 'Dan Kwan', 'Comédie', 97, '9.99', 'f7bc247bb7cec112b94a84cdc61ffa6ac1f0051c.jpg', '4v92gXetGqA', '2016-01-22'),
(6, 'Lost in Translation', 'Sofia Coppola', 'Romance', 102, '12.99', '88ae6029f1b82e8d066aa45c891adecd49c5a3a4.jpg', 'W6iVPCRflQM', '2003-08-29'),
(7, 'Wild At Heart', 'David Lynch', 'Action', 125, '9.99', 'a15c586c0b774cbe73dbe73509fc865820a71f78.jpg', 'dQIdBfrF0Ik', '1990-05-19'),
(8, 'Becky', 'Jonathan Milot', 'Horreur', 93, '20.99', '9a29205e93ecc929871e0b2b53d8ec2491c0a813.jpg', 'WTD6ZXH7Xqc', '2020-06-05'),
(9, 'Princesse Mononoké', 'Hayao Miyazaki', 'Animation', 134, '13.99', 'c59d801ac039b9c29e78af9e38b45d4dfb870c9b.jpg', '4OiMOHRDs14', '1999-11-26'),
(17, 'Spirited Away', 'Hayao Miyazaki', 'Animation', 125, '14.99', '2cfd1349ac654891b6940a01665e4e764ceebbfc.jpg', 'ByXuk9QqQkk', '2001-07-20'),
(23, 'The Grand Budapest Hotel', 'Wes Anderson', 'Action', 99, '12.99', '38b0666c27801997ab60e9122bf9257d0d864fe0.jpg', '1Fg5iWmQjwk', '2014-03-14'),
(24, 'Edge of Tomorrow', 'Doug Liman', 'Science-fiction', 113, '7.99', 'f63ba65bc69d4144cdec0c629cc20047550852fb.jpg', 'vw61gCe2oqI', '2014-05-28'),
(25, '2001: A Space Odyssey', 'Stanley Kubric', 'Science-fiction', 149, '11.99', 'bc26017b4650978e70eebf129304610456530458.jpg', 'oR_e9y-bka0', '1968-04-02'),
(26, 'Marriage Story', 'Noah Baumbach', 'Drame', 137, '17.99', 'a071dd8f3cf632d141471fbb66a9d25d45735604.jpg', 'BHi-a1n8t7M', '2019-08-29'),
(27, 'Mission Impossible', 'Brian De Palma', 'Action', 110, '4.99', '7c0ee6d5b281b6315aabff3593a34d7f94f51093.jpg', 'Ohws8y572KE', '1996-05-22'),
(28, 'The Dark Crystal', 'Jim Henson', 'Animation', 93, '11.99', '02dfc9db80bfae3129afd69e990ea13107e27d27.jpg', '9PTjIWyRmls', '1982-12-17'),
(29, 'Vacation', 'John Francis Daley', 'Comédie', 99, '8.99', '96aae621927a162ad5efd8a0da1657a14c2a212c.jpg', 'kleG7XCqOb4', '2015-07-29'),
(30, 'Little Miss Sunshine', 'Jonathan Dayton', 'Comédie', 101, '12.99', 'f9d13b37041c38fd757fa44af36aa24688a9a698.jpg', 'wvwVkllXT80', '2006-01-20'),
(31, '28 Days Later', 'Danny Boyle', 'Horreur', 113, '7.99', '2c3fb968a4b06de0447f141bb96359132895b568.jpg', 'c7ynwAgQlDQ', '2003-06-27'),
(32, 'As Above, So Below', 'John Erick Dowdle', 'Horreur', 93, '3.99', 'bdeb64cbcfaeffdeadbdcd6ac6d2b636a0a0d0d9.jpg', 'X_BaqNzdGXY', '2014-08-29'),
(33, 'Love Actually', 'Richard Curtis', 'Romance', 135, '3.13', 'cf802e9090189aa96e87d67d1644316fa07bc8b3.jpg', 'g8M-wa9SEuw', '2020-06-04'),
(34, 'La La Land', 'Damien Chazelle', 'Romance', 128, '11.99', '405c3774d5e4f54a7d491c9ef8f09a5d33a1ae93.jpg', '0pdqf4P9MB8', '2016-12-16');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `idMembre` int(11) NOT NULL,
  `courriel` varchar(60) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `age` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`idMembre`, `courriel`, `nom`, `age`) VALUES
(1, 'patrick.lainesse@umontreal.ca', 'Patrick Lainesse', '1984-06-10'),
(2, 'admin@gmail.com', 'Administrateur', '1960-02-29'),
(3, 'membre@gmail.com', 'Membre Alpha', '2020-04-14'),
(4, 'gustave@gmal.ca', 'Gustave', '2016-07-29'),
(5, 'mongenou@gmal.com', 'Violette Lainesse', '2018-05-18'),
(6, 'alex@gmail.com', 'Alex Richard', '2020-06-23'),
(7, 'ron@gmail.com', 'Ron Tuggay', '2020-06-15'),
(8, 'maude@allo.ca', 'Maude LB', '1980-02-01'),
(9, 'agag@gad.ca', 'ga agd', '1980-02-01');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `idPanier` int(11) NOT NULL,
  `quantite` tinyint(3) UNSIGNED NOT NULL,
  `idMembre` int(11) NOT NULL,
  `idFilm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`idPanier`, `quantite`, `idMembre`, `idFilm`) VALUES
(1, 11, 5, 4),
(17, 2, 5, 7),
(23, 57, 5, 2),
(24, 3, 5, 6),
(25, 50, 5, 1),
(26, 6, 5, 17),
(27, 3, 5, 9),
(28, 3, 5, 5),
(29, 3, 5, 8),
(33, 4, 5, 30);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`idConnexion`),
  ADD KEY `foreign` (`idMembre`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`idMembre`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`idPanier`),
  ADD KEY `foreignFilm` (`idFilm`),
  ADD KEY `foreignMembre` (`idMembre`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `idConnexion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `idMembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `idPanier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `foreignFilm` FOREIGN KEY (`idFilm`) REFERENCES `films` (`id`),
  ADD CONSTRAINT `foreignMembre` FOREIGN KEY (`idMembre`) REFERENCES `membres` (`idMembre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
