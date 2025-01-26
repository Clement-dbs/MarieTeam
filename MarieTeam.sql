-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 23 jan. 2025 à 10:11
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `marieteam`
--

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `id` int(11) NOT NULL,
  `nom` char(50) DEFAULT NULL,
  `A` int(11) NOT NULL DEFAULT 0,
  `B` int(11) NOT NULL DEFAULT 0,
  `C` int(11) NOT NULL DEFAULT 0,
  `A_Max` int(11) NOT NULL DEFAULT 0,
  `B_Max` int(11) NOT NULL DEFAULT 0,
  `C_Max` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`id`, `nom`, `A`, `B`, `C`, `A_Max`, `B_Max`, `C_Max`) VALUES
(1, 'Poseidon', 214, 54, 24, 2000, 500, 100),
(2, 'Titan', 58, 60, 10, 70, 60, 25),
(3, 'Viking', 105, 20, 5, 120, 50, 15);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `lettre` char(50) NOT NULL,
  `libelle` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`lettre`, `libelle`) VALUES
('A', 'Passager'),
('B', 'Veh_inf_2m'),
('C', 'Veh_sup_2m');

-- --------------------------------------------------------

--
-- Structure de la table `enregistrer`
--

CREATE TABLE `enregistrer` (
  `id` int(11) NOT NULL,
  `quantité` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `liaison`
--

CREATE TABLE `liaison` (
  `code` int(11) NOT NULL,
  `distance` double DEFAULT NULL,
  `secteur` int(11) NOT NULL,
  `port_depart` char(50) DEFAULT NULL,
  `port_arrivee` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `liaison`
--

INSERT INTO `liaison` (`code`, `distance`, `secteur`, `port_depart`, `port_arrivee`) VALUES
(1, 15, 1, 'Quiberon', 'Le Palais'),
(2, 15, 1, 'Le Palais', 'Quiberon'),
(3, 16, 5, 'Quiberon', 'Sauzon'),
(4, 16, 5, 'Sauzon', 'Quiberon'),
(5, 19, 5, 'Vannes', 'Le Palais'),
(6, 19, 5, 'Le Palais', 'Vannes'),
(7, 30, 5, 'Quiberon', 'Port St Gildas'),
(8, 30, 1, 'Port St Gildas', 'Quiberon'),
(9, 21, 5, 'Lorient', 'Port-Tudy'),
(10, 21, 5, 'Port-Tudy', 'Lorient');

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`id`, `debut`, `fin`) VALUES
(1, '2024-01-01', '2024-01-31'),
(2, '2024-02-01', '2024-02-29'),
(3, '2024-03-01', '2024-03-31'),
(4, '2024-11-01', '2024-11-30'),
(5, '2025-01-01', '2025-01-31'),
(6, '2025-02-01', '2025-02-28'),
(7, '2025-03-01', '2025-03-31');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `adulte` int(11) NOT NULL DEFAULT 0,
  `junior` int(11) NOT NULL DEFAULT 0,
  `enfant` int(11) NOT NULL DEFAULT 0,
  `voiture_4` int(11) NOT NULL DEFAULT 0,
  `voiture_5` int(11) NOT NULL DEFAULT 0,
  `fourgon` int(11) NOT NULL DEFAULT 0,
  `camping_car` int(11) NOT NULL DEFAULT 0,
  `camion` int(11) NOT NULL DEFAULT 0,
  `prix_total` int(11) NOT NULL DEFAULT 0,
  `id_1` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `adulte`, `junior`, `enfant`, `voiture_4`, `voiture_5`, `fourgon`, `camping_car`, `camion`, `prix_total`, `id_1`, `utilisateur_id`) VALUES
(6, 2, 0, 0, 0, 0, 0, 0, 0, 190, 1, 1),
(7, 2, 0, 0, 0, 0, 0, 0, 0, 190, 1, 1),
(8, 2, 0, 0, 0, 0, 0, 0, 0, 190, 1, 1),
(9, 2, 1, 1, 2, 1, 4, 2, 7, 2840, 1, 1),
(10, 2, 1, 1, 1, 0, 0, 1, 0, 690, 1, 1),
(11, 2, 2, 0, 0, 0, 0, 0, 0, 400, 8, 1),
(12, 2, 2, 0, 0, 0, 0, 0, 0, 400, 8, 1),
(13, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(14, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(15, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(16, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(17, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(18, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(19, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(20, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(21, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(22, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(23, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(24, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(25, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(26, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1),
(27, 1, 0, 0, 0, 0, 0, 0, 0, 95, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `id` int(11) NOT NULL,
  `nom` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`id`, `nom`) VALUES
(1, 'Aix'),
(2, 'Batz'),
(3, 'Belle-ile-en-mer'),
(4, 'Bréhat'),
(5, 'Houat'),
(6, 'Ile de groix'),
(7, 'Molène'),
(8, 'Ouessant'),
(9, 'Sein'),
(10, 'Yeu');

-- --------------------------------------------------------

--
-- Structure de la table `tarifer`
--

CREATE TABLE `tarifer` (
  `debut` date NOT NULL,
  `num` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `tarif` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `tarifer`
--

INSERT INTO `tarifer` (`debut`, `num`, `code`, `tarif`) VALUES
('2024-01-01', 1, 1, '50.00'),
('2024-01-01', 2, 1, '60.00'),
('2024-01-01', 3, 1, '70.00'),
('2024-01-01', 4, 1, '80.00'),
('2024-01-01', 5, 1, '90.00'),
('2024-01-01', 6, 1, '100.00'),
('2024-01-01', 7, 1, '110.00'),
('2024-01-01', 8, 1, '120.00'),
('2024-02-01', 1, 2, '55.00'),
('2024-02-01', 2, 2, '65.00'),
('2024-02-01', 3, 2, '75.00'),
('2024-02-01', 4, 2, '85.00'),
('2024-02-01', 5, 2, '95.00'),
('2024-02-01', 6, 2, '105.00'),
('2024-02-01', 7, 2, '115.00'),
('2024-02-01', 8, 2, '125.00'),
('2024-03-01', 1, 3, '60.00'),
('2024-03-01', 2, 3, '70.00'),
('2024-03-01', 3, 3, '80.00'),
('2024-03-01', 4, 3, '90.00'),
('2024-03-01', 5, 3, '100.00'),
('2024-03-01', 6, 3, '110.00'),
('2024-03-01', 7, 3, '120.00'),
('2024-03-01', 8, 3, '130.00'),
('2024-11-01', 1, 4, '70.00'),
('2024-11-01', 2, 4, '80.00'),
('2024-11-01', 3, 4, '90.00'),
('2024-11-01', 4, 4, '90.00'),
('2024-11-01', 5, 4, '120.00'),
('2024-11-01', 6, 4, '140.00'),
('2024-11-01', 7, 4, '140.00'),
('2024-11-01', 8, 4, '150.00'),
('2025-01-01', 1, 5, '95.00'),
('2025-01-01', 2, 5, '105.00'),
('2025-01-01', 3, 5, '115.00'),
('2025-01-01', 4, 5, '125.00'),
('2025-01-01', 5, 5, '135.00'),
('2025-01-01', 6, 5, '145.00'),
('2025-01-01', 7, 5, '155.00'),
('2025-01-01', 8, 5, '165.00'),
('2025-02-01', 1, 6, '100.00'),
('2025-02-01', 2, 6, '110.00'),
('2025-02-01', 3, 6, '120.00'),
('2025-02-01', 4, 6, '130.00'),
('2025-02-01', 5, 6, '140.00'),
('2025-02-01', 6, 6, '150.00'),
('2025-02-01', 7, 6, '160.00'),
('2025-02-01', 8, 6, '170.00'),
('2025-03-01', 1, 7, '105.00'),
('2025-03-01', 2, 7, '115.00'),
('2025-03-01', 3, 7, '125.00'),
('2025-03-01', 4, 7, '135.00'),
('2025-03-01', 5, 7, '145.00'),
('2025-03-01', 6, 7, '155.00'),
('2025-03-01', 7, 7, '165.00'),
('2025-03-01', 8, 7, '175.00');

-- --------------------------------------------------------

--
-- Structure de la table `traversee`
--

CREATE TABLE `traversee` (
  `id` int(11) NOT NULL,
  `codeLiaison` int(11) NOT NULL,
  `heureDepart` time DEFAULT NULL,
  `heureArrivee` time DEFAULT NULL,
  `jour` date DEFAULT NULL,
  `bateau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `traversee`
--

INSERT INTO `traversee` (`id`, `codeLiaison`, `heureDepart`, `heureArrivee`, `jour`, `bateau`) VALUES
(1, 1, '06:00:00', '07:30:00', '2024-11-15', 1),
(2, 1, '08:00:00', '09:30:00', '2024-11-15', 2),
(3, 1, '10:00:00', '11:30:00', '2024-11-15', 3),
(4, 1, '12:00:00', '13:30:00', '2024-11-15', 2),
(5, 1, '14:00:00', '15:30:00', '2024-11-15', 3),
(6, 1, '16:00:00', '17:30:00', '2024-11-15', 1),
(7, 1, '18:00:00', '19:30:00', '2024-11-15', 3),
(8, 2, '09:00:00', '10:30:00', '2024-11-15', 2),
(9, 3, '10:30:00', '12:00:00', '2024-11-15', 3);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `libelle` char(50) DEFAULT NULL,
  `lettre` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `libelle`, `lettre`) VALUES
(1, 'Adulte', 'A'),
(2, 'Junior 8-18 ans', 'A'),
(3, 'Enfant 0-7 ans', 'A'),
(4, 'Voiture longueur < 4m', 'B'),
(5, 'Voiture longueur < 5m', 'B'),
(6, 'Fourgon', 'C'),
(7, 'Camping Car', 'C'),
(8, 'Camion', 'C');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mdp` varchar(150) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `telephone`, `isAdmin`) VALUES
(1, 'Bastien', 'Guillemet', 'bastien.guillemet@test.com', '$2y$10$99XTXgQZP/oySBjAJ7/o..1tbWeqTkgyl5H/M6Sp1ayL3rzTC59o6', '0653649875', 1),
(2, 'Dubois', 'Clement', 'clement.dubois@test.fr', '$2y$10$nWbkuS/aMBFWJZHzRUrurO8gOPy4jOb9Clr2FiumhQGaA4nGm0DsC', '0702364589', 1),
(3, 'Dubosc', 'Franck', 'franck.dubosc@test.fr', '$2y$10$.GWhnPDPPtrX.j53dpIWA.PMNUP5ZszTxn8yLnxUqISlTh41BRezy', '0625143698', 0),
(4, 'Cavil', 'Henry', 'henry.cavil@test.com', '$2y$10$ewDomzSF96KbQPpVbxqWyO6Kn7SECQdWtvDP7OIpIw.3TPoFQmcG.', '0603374817', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`lettre`);

--
-- Index pour la table `enregistrer`
--
ALTER TABLE `enregistrer`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD PRIMARY KEY (`code`),
  ADD KEY `secteur` (`secteur`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `debut` (`debut`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_1` (`id_1`),
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tarifer`
--
ALTER TABLE `tarifer`
  ADD PRIMARY KEY (`debut`,`num`,`code`),
  ADD KEY `num` (`num`),
  ADD KEY `code` (`code`);

--
-- Index pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bateau` (`bateau`),
  ADD KEY `codeLiaison` (`codeLiaison`);

--
-- Index pour la table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bateau`
--
ALTER TABLE `bateau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `liaison`
--
ALTER TABLE `liaison`
  MODIFY `code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `traversee`
--
ALTER TABLE `traversee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enregistrer`
--
ALTER TABLE `enregistrer`
  ADD CONSTRAINT `enregistrer_ibfk_1` FOREIGN KEY (`id`) REFERENCES `reservation` (`id`);

--
-- Contraintes pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD CONSTRAINT `liaison_ibfk_1` FOREIGN KEY (`secteur`) REFERENCES `secteur` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_1`) REFERENCES `traversee` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `tarifer`
--
ALTER TABLE `tarifer`
  ADD CONSTRAINT `tarifer_ibfk_1` FOREIGN KEY (`debut`) REFERENCES `periode` (`debut`),
  ADD CONSTRAINT `tarifer_ibfk_2` FOREIGN KEY (`num`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `tarifer_ibfk_3` FOREIGN KEY (`code`) REFERENCES `liaison` (`code`);

--
-- Contraintes pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD CONSTRAINT `traversee_ibfk_1` FOREIGN KEY (`bateau`) REFERENCES `bateau` (`id`),
  ADD CONSTRAINT `traversee_ibfk_2` FOREIGN KEY (`codeLiaison`) REFERENCES `liaison` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
