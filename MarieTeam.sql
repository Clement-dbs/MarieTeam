-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 03 mai 2025 à 14:55
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
-- Base de données : `marieteam`
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
  `place_passager_max` int(11) DEFAULT NULL,
  `place_vehicule_leger_max` int(11) DEFAULT NULL,
  `place_vehicule_lourd_max` int(11) DEFAULT NULL,
  `id_port` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`id`, `nom`, `longueur`, `largeur`, `vitesse`, `place_passager_max`, `place_vehicule_leger_max`, `place_vehicule_lourd_max`, `id_port`) VALUES
(1, 'Ferry Méditerranée', '180', '30', '25', 250, 60, 15, 1),
(2, 'Atlantique Express', '150', '28', '22', 220, 50, 10, 4);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `libelle` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`) VALUES
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
(2, 450.80, 5, 4, 2, 2),
(3, 30.00, 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `quantite` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_type_passager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id_type_passager` int(11) DEFAULT NULL,
  `id_type_vehicule` int(11) DEFAULT NULL,
  `tarif` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id`, `id_liaison`, `id_periode`, `id_type_passager`, `id_type_vehicule`, `tarif`) VALUES
(4, 1, 1, 1, NULL, 22.00),
(5, 1, 1, 2, NULL, 12.00),
(6, 1, 1, 3, NULL, 5.00),
(7, 1, 1, NULL, 4, 86.00),
(8, 1, 1, NULL, 5, 129.00),
(9, 1, 1, NULL, 6, 189.00),
(10, 1, 1, NULL, 7, 205.00),
(11, 1, 1, NULL, 8, 268.00);

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
(2, '2025-04-29 10:44:12', '2025-06-11 13:00:00', 1),
(3, '2025-06-11 07:00:00', '2025-06-11 13:00:00', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type_passager`
--

CREATE TABLE `type_passager` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_passager`
--

INSERT INTO `type_passager` (`id`, `libelle`, `id_categorie`) VALUES
(1, 'Adulte', 1),
(2, 'Junior', 1),
(3, 'Enfant', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_vehicule`
--

CREATE TABLE `type_vehicule` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_vehicule`
--

INSERT INTO `type_vehicule` (`id`, `libelle`, `id_categorie`) VALUES
(4, 'Voiture inférieur à 4 m', 2),
(5, 'Voiture inférieur à 5 m', 2),
(6, 'Fourgon', 3),
(7, 'Camping Car', 3),
(8, 'Camion', 3);

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
  `isAdmin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `telephone`, `isAdmin`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'hashed_mdp', '0601020304', 0),
(2, 'Martin', 'Lucie', 'lucie.martin@example.com', '1', '0605060708', 1),
(3, 'Dubois', 'Clément', 'contact.clementdbs@gmail.com', '$2y$10$MgEJI6OKor1Mi05iceDFTOUQ/D46njsRtYn0dqtiMML3qwh3t2KHS', '0642852548', NULL),
(4, 'Dubois', 'Clement', 'contact.clement@gmail.com', '$2y$10$CQK2aUaE3dgUhsrPkpdTiu1n8w/JS7ItR.D62fLQk.DAc0AAMFwt2', '0642852548', 1),
(5, 'Guillemet', 'Bastien', 'bastien.guillemet3064@gmail.com', '$2y$10$Uk.04uAaPxX7r7Hc1W9aUuFNbol9BnsutYLrRdo9AECewslLU/S76', '0626436430', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `quantite` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_type_vehicule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_liaisons`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_liaisons` (
`id_liaison` int(11)
,`distance` decimal(15,2)
,`port_depart` varchar(50)
,`port_arrive` varchar(50)
,`id_secteur` int(11)
,`nom_secteur` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_reservation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_reservation` (
`id_reservation` int(11)
,`date` timestamp
,`prix_total` int(11)
,`id_utilisateur` int(11)
,`id_traversee` int(11)
,`port_depart` varchar(50)
,`port_arrive` varchar(50)
,`id_type_passager` int(11)
,`quantite_passager` int(11)
,`id_type_vehicule` int(11)
,`quantite_vehicule` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_tarifs`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_tarifs` (
`id_tarif` int(11)
,`tarif` decimal(10,2)
,`id_liaison` int(11)
,`distance` decimal(15,2)
,`port_depart` varchar(50)
,`port_arrive` varchar(50)
,`secteur_nom` varchar(50)
,`nom_bateau` varchar(30)
,`longueur_bateau` varchar(30)
,`largeur_bateau` varchar(30)
,`vitesse_bateau` varchar(30)
,`place_passager_max` int(11)
,`place_vehicule_leger_max` int(11)
,`place_vehicule_lourd_max` int(11)
,`id_periode` int(11)
,`periode_nom` varchar(50)
,`dateDebut` date
,`dateFin` date
,`type_passager_libelle` varchar(50)
,`type_vehicule_libelle` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_traversee`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_traversee` (
`id_traversee` int(11)
,`date_depart` timestamp
,`date_arrive` timestamp
,`id_liaison` int(11)
,`depart` varchar(50)
,`arrive` varchar(50)
,`id_bateau` int(11)
,`places_passager_restantes` decimal(33,0)
,`places_vehicule_leger_restantes` decimal(33,0)
,`places_vehicule_lourd_restantes` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_liaisons`
--
DROP TABLE IF EXISTS `vue_liaisons`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_liaisons`  AS SELECT `l`.`id` AS `id_liaison`, `l`.`distance` AS `distance`, `p_depart`.`nom` AS `port_depart`, `p_arrive`.`nom` AS `port_arrive`, `l`.`id_secteur` AS `id_secteur`, `s`.`nom` AS `nom_secteur` FROM (((`liaison` `l` join `port` `p_depart` on(`l`.`port_depart` = `p_depart`.`id`)) join `port` `p_arrive` on(`l`.`port_arrive` = `p_arrive`.`id`)) join `secteur` `s` on(`l`.`id_secteur` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_reservation`
--
DROP TABLE IF EXISTS `vue_reservation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_reservation`  AS SELECT `r`.`id` AS `id_reservation`, `r`.`date` AS `date`, `r`.`prix_total` AS `prix_total`, `r`.`id_utilisateur` AS `id_utilisateur`, `r`.`id_traversee` AS `id_traversee`, `port_depart`.`nom` AS `port_depart`, `port_arrive`.`nom` AS `port_arrive`, `p`.`id_type_passager` AS `id_type_passager`, `p`.`quantite` AS `quantite_passager`, `v`.`id_type_vehicule` AS `id_type_vehicule`, `v`.`quantite` AS `quantite_vehicule` FROM ((((((`reservation` `r` left join `passager` `p` on(`r`.`id` = `p`.`id_reservation`)) left join `vehicule` `v` on(`r`.`id` = `v`.`id_reservation`)) join `traversee` `t` on(`r`.`id_traversee` = `t`.`id`)) join `liaison` `l` on(`t`.`id_liaison` = `l`.`id`)) join `port` `port_depart` on(`l`.`port_depart` = `port_depart`.`id`)) join `port` `port_arrive` on(`l`.`port_arrive` = `port_arrive`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_tarifs`
--
DROP TABLE IF EXISTS `vue_tarifs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_tarifs`  AS SELECT `t`.`id` AS `id_tarif`, `t`.`tarif` AS `tarif`, `l`.`id` AS `id_liaison`, `l`.`distance` AS `distance`, `p_depart`.`nom` AS `port_depart`, `p_arrive`.`nom` AS `port_arrive`, `s`.`nom` AS `secteur_nom`, `b`.`nom` AS `nom_bateau`, `b`.`longueur` AS `longueur_bateau`, `b`.`largeur` AS `largeur_bateau`, `b`.`vitesse` AS `vitesse_bateau`, `b`.`place_passager_max` AS `place_passager_max`, `b`.`place_vehicule_leger_max` AS `place_vehicule_leger_max`, `b`.`place_vehicule_lourd_max` AS `place_vehicule_lourd_max`, `p`.`id` AS `id_periode`, `p`.`nom` AS `periode_nom`, `p`.`dateDebut` AS `dateDebut`, `p`.`dateFin` AS `dateFin`, `tp`.`libelle` AS `type_passager_libelle`, `tv`.`libelle` AS `type_vehicule_libelle` FROM ((((((((`tarif` `t` join `liaison` `l` on(`t`.`id_liaison` = `l`.`id`)) join `periode` `p` on(`t`.`id_periode` = `p`.`id`)) join `port` `p_depart` on(`l`.`port_depart` = `p_depart`.`id`)) join `port` `p_arrive` on(`l`.`port_arrive` = `p_arrive`.`id`)) join `secteur` `s` on(`l`.`id_secteur` = `s`.`id`)) left join `bateau` `b` on(`l`.`id_bateau` = `b`.`id`)) left join `type_passager` `tp` on(`t`.`id_type_passager` = `tp`.`id`)) left join `type_vehicule` `tv` on(`t`.`id_type_vehicule` = `tv`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_traversee`
--
DROP TABLE IF EXISTS `vue_traversee`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_traversee`  AS SELECT `t`.`id` AS `id_traversee`, `t`.`depart` AS `date_depart`, `t`.`arrive` AS `date_arrive`, `t`.`id_liaison` AS `id_liaison`, `pd`.`nom` AS `depart`, `pa`.`nom` AS `arrive`, `l`.`id_bateau` AS `id_bateau`, `b`.`place_passager_max`- coalesce((select sum(`p`.`quantite`) from (((`reservation` `r` join `passager` `p` on(`r`.`id` = `p`.`id_reservation`)) join `type_passager` `tp` on(`p`.`id_type_passager` = `tp`.`id`)) join `categorie` `c` on(`tp`.`id_categorie` = `c`.`id`)) where `r`.`id_traversee` = `t`.`id` and `c`.`libelle` = 'A'),0) AS `places_passager_restantes`, `b`.`place_vehicule_leger_max`- coalesce((select sum(`v`.`quantite`) from (((`reservation` `r` join `vehicule` `v` on(`r`.`id` = `v`.`id_reservation`)) join `type_vehicule` `tv` on(`v`.`id_type_vehicule` = `tv`.`id`)) join `categorie` `c` on(`tv`.`id_categorie` = `c`.`id`)) where `r`.`id_traversee` = `t`.`id` and `c`.`libelle` = 'B'),0) AS `places_vehicule_leger_restantes`, `b`.`place_vehicule_lourd_max`- coalesce((select sum(`v`.`quantite`) from (((`reservation` `r` join `vehicule` `v` on(`r`.`id` = `v`.`id_reservation`)) join `type_vehicule` `tv` on(`v`.`id_type_vehicule` = `tv`.`id`)) join `categorie` `c` on(`tv`.`id_categorie` = `c`.`id`)) where `r`.`id_traversee` = `t`.`id` and `c`.`libelle` = 'C'),0) AS `places_vehicule_lourd_restantes` FROM ((((`traversee` `t` join `liaison` `l` on(`t`.`id_liaison` = `l`.`id`)) join `bateau` `b` on(`l`.`id_bateau` = `b`.`id`)) join `port` `pd` on(`l`.`port_depart` = `pd`.`id`)) join `port` `pa` on(`l`.`port_arrive` = `pa`.`id`)) ;

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
  ADD KEY `passager_ibfk_2` (`id_type_passager`),
  ADD KEY `passager_ibfk_1` (`id_reservation`);

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
  ADD KEY `id_liaison` (`id_liaison`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `tarif_ibfk_4` (`id_type_vehicule`),
  ADD KEY `tarif_ibfk_2` (`id_type_passager`);

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
  ADD KEY `categorie_ibfk_1` (`id_categorie`);

--
-- Index pour la table `type_vehicule`
--
ALTER TABLE `type_vehicule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `libelle` (`libelle`),
  ADD KEY `categorie_ibfk_2` (`id_categorie`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `traversee`
--
ALTER TABLE `traversee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_passager`
--
ALTER TABLE `type_passager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_vehicule`
--
ALTER TABLE `type_vehicule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `passager_ibfk_1` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`id_liaison`) REFERENCES `liaison` (`id`),
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`id_type_passager`) REFERENCES `type_passager` (`id`),
  ADD CONSTRAINT `tarif_ibfk_3` FOREIGN KEY (`id_type_passager`) REFERENCES `type_passager` (`id`),
  ADD CONSTRAINT `tarif_ibfk_4` FOREIGN KEY (`id_type_vehicule`) REFERENCES `type_vehicule` (`id`),
  ADD CONSTRAINT `tarif_ibfk_5` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`);

--
-- Contraintes pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD CONSTRAINT `traversee_ibfk_1` FOREIGN KEY (`id_liaison`) REFERENCES `liaison` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `type_passager`
--
ALTER TABLE `type_passager`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `type_vehicule`
--
ALTER TABLE `type_vehicule`
  ADD CONSTRAINT `categorie_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id`);

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
