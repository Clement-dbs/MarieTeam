-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 29 avr. 2025 à 00:18
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `marieteamwebcorrection`
--

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `longueur` varchar(30) NOT NULL,
  `largeur` varchar(30) NOT NULL,
  `vitesse` varchar(30) NOT NULL,
  `place_passager` int(11) DEFAULT 0,
  `place_passager_max` int(11) DEFAULT NULL,
  `place_vehicule_leger` int(11) DEFAULT 0,
  `place_vehicule_leger_max` int(11) DEFAULT NULL,
  `place_vehicule_lourd` int(11) DEFAULT 0,
  `place_vehicule_lourd_max` int(11) DEFAULT NULL,
  `id_port` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`id`, `nom`, `longueur`, `largeur`, `vitesse`, `place_passager`, `place_passager_max`, `place_vehicule_leger`, `place_vehicule_leger_max`, `place_vehicule_lourd`, `place_vehicule_lourd_max`, `id_port`) VALUES
(1, 'Ferry Méditerranée', '180', '30', '25', 200, 250, 50, 60, 10, 15, 1),
(2, 'Atlantique Express', '150', '28', '22', 180, 220, 40, 50, 8, 10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `lettre` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `lettre`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_equipement`
--

CREATE TABLE `categorie_equipement` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie_equipement`
--

INSERT INTO `categorie_equipement` (`id`, `libelle`) VALUES
(1, 'Confort'),
(2, 'Restauration'),
(3, 'Divertissement');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `id_categorie_equipement` int(11) NOT NULL,
  `id_bateau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `id_categorie_equipement`, `id_bateau`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `liaison`
--

CREATE TABLE `liaison` (
  `id` int(11) NOT NULL,
  `distance` decimal(15,2) DEFAULT NULL,
  `port_arrive` int(11) NOT NULL,
  `port_depart` int(11) NOT NULL,
  `id_secteur` int(11) NOT NULL,
  `id_bateau` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liaison`
--

INSERT INTO `liaison` (`id`, `distance`, `port_arrive`, `port_depart`, `id_secteur`, `id_bateau`) VALUES
(1, 300.50, 2, 1, 1, 1),
(2, 450.80, 5, 4, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `id` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_type_passager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`id`, `id_reservation`, `id_type_passager`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `periode`
--

INSERT INTO `periode` (`id`, `nom`, `dateDebut`, `dateFin`) VALUES
(1, 'Été 2025', '2025-06-01', '2025-08-31'),
(2, 'Hiver 2025', '2025-12-01', '2026-02-28'),
(3, 'Printemps 2025', '2025-03-01', '2025-05-31'),
(4, 'Automne 2025', '2025-09-01', '2025-11-30');

-- --------------------------------------------------------

--
-- Structure de la table `port`
--

CREATE TABLE `port` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `id_secteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `port`
--

INSERT INTO `port` (`id`, `nom`, `id_secteur`) VALUES
(1, 'Marseille', 1),
(2, 'Toulon', 1),
(3, 'Nice', 1),
(4, 'Brest', 2),
(5, 'Nantes', 2),
(6, 'Cherbourg', 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `prix_total` int(11) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_traversee` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `prix_total`, `date`, `id_traversee`, `id_utilisateur`) VALUES
(1, 100, '2025-06-01 08:00:00', 1, 1),
(2, 110, '2025-04-28 22:16:30', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `secteur`
--

INSERT INTO `secteur` (`id`, `nom`) VALUES
(1, 'Méditerranée'),
(2, 'Atlantique'),
(3, 'Manche');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE `tarif` (
  `id` int(11) NOT NULL,
  `id_liaison` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `tarif` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id`, `id_liaison`, `id_periode`, `id_categorie`, `tarif`) VALUES
(1, 1, 1, 1, 50),
(2, 1, 1, 2, 30),
(3, 2, 2, 1, 70);

-- --------------------------------------------------------

--
-- Structure de la table `traversee`
--

CREATE TABLE `traversee` (
  `id` int(11) NOT NULL,
  `depart` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `arrive` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_liaison` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `traversee`
--

INSERT INTO `traversee` (`id`, `depart`, `arrive`, `id_liaison`) VALUES
(1, '2025-06-10 06:00:00', '2025-06-10 12:00:00', 1),
(2, '2025-06-11 07:00:00', '2025-06-11 13:00:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_passager`
--

CREATE TABLE `type_passager` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_passager`
--

INSERT INTO `type_passager` (`id`, `libelle`, `id_categorie`) VALUES
(1, 'enfant', 1),
(2, 'junior', 1),
(3, 'adulte', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_vehicule`
--

CREATE TABLE `type_vehicule` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_vehicule`
--

INSERT INTO `type_vehicule` (`id`, `libelle`, `id_categorie`) VALUES
(1, 'voiture_inf_4m', 2),
(2, 'voiture_inf_5m', 2),
(3, 'fourgon', 3),
(4, 'camping_car', 3),
(5, 'camion', 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `telephone`, `isAdmin`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'hashed_mdp', '0601020304', 0),
(2, 'Martin', 'Lucie', 'lucie.martin@example.com', 'hashed_mdp', '0605060708', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_type_vehicule` int(11) NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`id`, `id_reservation`, `id_type_vehicule`, `quantite`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bateau_ibfk_1` (`id_port`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_equipement`
--
ALTER TABLE `categorie_equipement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_equipement` (`id_categorie_equipement`),
  ADD KEY `id_bateau` (`id_bateau`);

--
-- Index pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `port_arrive` (`port_arrive`),
  ADD KEY `port_depart` (`port_depart`),
  ADD KEY `id_secteur` (`id_secteur`),
  ADD KEY `liaison_ibfk_4` (`id_bateau`);

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `passager_ibfk_2` (`id_type_passager`);

--
-- Index pour la table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_secteur` (`id_secteur`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_traversee` (`id_traversee`),
  ADD KEY `utilisateur_id` (`id_utilisateur`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarif_ibfk_1` (`id_categorie`),
  ADD KEY `tarif_ibfk_2` (`id_liaison`),
  ADD KEY `tarif_ibfk_3` (`id_periode`);

--
-- Index pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_liaison` (`id_liaison`);

--
-- Index pour la table `type_passager`
--
ALTER TABLE `type_passager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `libelle` (`libelle`),
  ADD KEY `fk_type_passager_categorie` (`id_categorie`);

--
-- Index pour la table `type_vehicule`
--
ALTER TABLE `type_vehicule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `libelle` (`libelle`),
  ADD KEY `fk_type_vehicule_categorie` (`id_categorie`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_reservation` (`id_reservation`),
  ADD KEY `id_type_vehicule` (`id_type_vehicule`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bateau`
--
ALTER TABLE `bateau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `categorie_equipement`
--
ALTER TABLE `categorie_equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `liaison`
--
ALTER TABLE `liaison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `passager`
--
ALTER TABLE `passager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `port`
--
ALTER TABLE `port`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `traversee`
--
ALTER TABLE `traversee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_passager`
--
ALTER TABLE `type_passager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_vehicule`
--
ALTER TABLE `type_vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD CONSTRAINT `bateau_ibfk_1` FOREIGN KEY (`id_port`) REFERENCES `port` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `equipement_ibfk_1` FOREIGN KEY (`id_categorie_equipement`) REFERENCES `categorie_equipement` (`id`),
  ADD CONSTRAINT `equipement_ibfk_2` FOREIGN KEY (`id_bateau`) REFERENCES `bateau` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD CONSTRAINT `liaison_ibfk_1` FOREIGN KEY (`port_arrive`) REFERENCES `port` (`id`),
  ADD CONSTRAINT `liaison_ibfk_2` FOREIGN KEY (`port_depart`) REFERENCES `port` (`id`),
  ADD CONSTRAINT `liaison_ibfk_3` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id`),
  ADD CONSTRAINT `liaison_ibfk_4` FOREIGN KEY (`id_bateau`) REFERENCES `bateau` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `passager`
--
ALTER TABLE `passager`
  ADD CONSTRAINT `passager_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `passager_ibfk_2` FOREIGN KEY (`id_type_passager`) REFERENCES `type_passager` (`id`);

--
-- Contraintes pour la table `port`
--
ALTER TABLE `port`
  ADD CONSTRAINT `port_ibfk_1` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_traversee`) REFERENCES `traversee` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`id_liaison`) REFERENCES `liaison` (`id`),
  ADD CONSTRAINT `tarif_ibfk_3` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`);

--
-- Contraintes pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD CONSTRAINT `traversee_ibfk_1` FOREIGN KEY (`id_liaison`) REFERENCES `liaison` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `type_passager`
--
ALTER TABLE `type_passager`
  ADD CONSTRAINT `fk_type_passager_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `type_vehicule`
--
ALTER TABLE `type_vehicule`
  ADD CONSTRAINT `fk_type_vehicule_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `vehicule_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicule_ibfk_2` FOREIGN KEY (`id_type_vehicule`) REFERENCES `type_vehicule` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
