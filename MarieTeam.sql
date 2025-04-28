-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 28 avr. 2025 à 18:11
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

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
  `nom` varchar(255) NOT NULL,
  `longueur` varchar(255) NOT NULL,
  `largeur` varchar(255) NOT NULL,
  `A` int(11) DEFAULT 0,
  `A_Max` int(11) DEFAULT NULL,
  `B` int(11) DEFAULT 0,
  `B_Max` int(11) DEFAULT NULL,
  `C` int(11) DEFAULT 0,
  `C_Max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`id`, `nom`, `longueur`, `largeur`, `A`, `A_Max`, `B`, `B_Max`, `C`, `C_Max`) VALUES
(1, 'Le Vendéen', '120m', '20m', 105, 150, 82, 100, 60, 80),
(2, 'Le Méditerranéen', '140m', '22m', 120, 180, 90, 120, 70, 90);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_equipement`
--

CREATE TABLE `categorie_equipement` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie_equipement`
--

INSERT INTO `categorie_equipement` (`id`, `libelle`) VALUES
(1, 'Restauration'),
(2, 'Jeux enfants'),
(3, 'Salle de repos');

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `id_equipement` int(11) NOT NULL,
  `id_bateau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `liaison`
--

CREATE TABLE `liaison` (
  `id` int(11) NOT NULL,
  `distance` decimal(15,2) DEFAULT NULL,
  `port_arrive` int(11) NOT NULL,
  `port_depart` int(11) NOT NULL,
  `id_secteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liaison`
--

INSERT INTO `liaison` (`id`, `distance`, `port_arrive`, `port_depart`, `id_secteur`) VALUES
(1, 35.50, 2, 1, 1),
(2, 150.00, 4, 3, 2);

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
(1, 'La Rochelle', 1),
(2, 'Île de Ré', 1),
(3, 'Nice', 2),
(4, 'Ajaccio', 2);

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
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_traversee` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL
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
(1, 'Atlantique Ouest'),
(2, 'Méditerranée Nord');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE `tarif` (
  `id_liaison` int(11) NOT NULL,
  `id_periode` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `tarif` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tarif`
--

INSERT INTO `tarif` (`id_liaison`, `id_periode`, `id_type`, `tarif`) VALUES
(1, 3, 1, 120.00),
(1, 3, 2, 150.00),
(1, 3, 3, 180.00),
(1, 3, 4, 110.00),
(1, 3, 5, 130.00),
(1, 3, 6, 160.00),
(1, 3, 7, 190.00),
(1, 3, 8, 120.00),
(2, 2, 1, 125.00),
(2, 2, 2, 155.00),
(2, 2, 3, 185.00),
(2, 2, 4, 115.00),
(2, 2, 5, 135.00),
(2, 2, 6, 165.00),
(2, 2, 7, 195.00),
(2, 2, 8, 125.00);

-- --------------------------------------------------------

--
-- Structure de la table `traversee`
--

CREATE TABLE `traversee` (
  `id` int(11) NOT NULL,
  `depart` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `arrive` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_bateau` int(11) NOT NULL,
  `id_liaison` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `traversee`
--

INSERT INTO `traversee` (`id`, `depart`, `arrive`, `id_bateau`, `id_liaison`) VALUES
(7, '2025-05-01 06:00:00', '2025-05-01 10:00:00', 1, 2),
(8, '2025-05-01 12:00:00', '2025-05-01 16:30:00', 2, 1),
(9, '2025-05-02 07:00:00', '2025-05-02 11:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  `lettre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `libelle`, `lettre`) VALUES
(1, 'Adulte', 'A'),
(2, 'Junior', 'A'),
(3, 'Enfant', 'A'),
(4, 'Voiture -4m', 'B'),
(5, 'Voiture +5m', 'B'),
(6, 'Fourgon', 'C'),
(7, 'Camping Car', 'C'),
(8, 'Camion', 'C');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `email`, `mdp`, `telephone`, `isAdmin`) VALUES
(4, 'Guillemet', 'Bastien', 'bastien.guillemet3064@gmail.com', '$2y$10$T4ZJcuPERW4fBsG6tf.kQO090It/lOgsNP9hG.t3xJlkqsns1aZPS', '0626436430', 1);

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
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_tarifs`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_tarifs` (
`id_liaison` int(11)
,`id_periode` int(11)
,`id_type` int(11)
,`tarif` decimal(15,2)
,`distance` decimal(15,2)
,`periode_nom` varchar(50)
,`dateDebut` date
,`dateFin` date
,`type_libelle` varchar(50)
,`type_lettre` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_traversees`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_traversees` (
`id_traversee` int(11)
,`depart` timestamp
,`arrive` timestamp
,`id_bateau` int(11)
,`nom_bateau` varchar(255)
,`longueur_bateau` varchar(255)
,`largeur_bateau` varchar(255)
,`A_passager` int(11)
,`B_veh_inf_2m` int(11)
,`C_veh_sup_2m` int(11)
,`distance_liaison` decimal(15,2)
,`port_depart` varchar(50)
,`port_arrivee` varchar(50)
,`secteur` varchar(50)
,`id_liaison` int(11)
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_liaisons`
--
DROP TABLE IF EXISTS `vue_liaisons`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_liaisons`  AS SELECT `l`.`id` AS `id_liaison`, `l`.`distance` AS `distance`, `p_depart`.`nom` AS `port_depart`, `p_arrive`.`nom` AS `port_arrive`, `l`.`id_secteur` AS `id_secteur` FROM (((`liaison` `l` join `port` `p_depart` on(`l`.`port_depart` = `p_depart`.`id`)) join `port` `p_arrive` on(`l`.`port_arrive` = `p_arrive`.`id`)) join `secteur` `s` on(`l`.`id_secteur` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_tarifs`
--
DROP TABLE IF EXISTS `vue_tarifs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_tarifs`  AS SELECT `t`.`id_liaison` AS `id_liaison`, `t`.`id_periode` AS `id_periode`, `t`.`id_type` AS `id_type`, `t`.`tarif` AS `tarif`, `l`.`distance` AS `distance`, `p`.`nom` AS `periode_nom`, `p`.`dateDebut` AS `dateDebut`, `p`.`dateFin` AS `dateFin`, `ty`.`libelle` AS `type_libelle`, `ty`.`lettre` AS `type_lettre` FROM (((`tarif` `t` join `liaison` `l` on(`t`.`id_liaison` = `l`.`id`)) join `periode` `p` on(`t`.`id_periode` = `p`.`id`)) join `type` `ty` on(`t`.`id_type` = `ty`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_traversees`
--
DROP TABLE IF EXISTS `vue_traversees`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_traversees`  AS SELECT `t`.`id` AS `id_traversee`, `t`.`depart` AS `depart`, `t`.`arrive` AS `arrive`, `b`.`id` AS `id_bateau`, `b`.`nom` AS `nom_bateau`, `b`.`longueur` AS `longueur_bateau`, `b`.`largeur` AS `largeur_bateau`, `b`.`A` AS `A_passager`, `b`.`B` AS `B_veh_inf_2m`, `b`.`C` AS `C_veh_sup_2m`, `l`.`distance` AS `distance_liaison`, `p1`.`nom` AS `port_depart`, `p2`.`nom` AS `port_arrivee`, `s`.`nom` AS `secteur`, `t`.`id_liaison` AS `id_liaison` FROM (((((`traversee` `t` join `bateau` `b` on(`t`.`id_bateau` = `b`.`id`)) join `liaison` `l` on(`t`.`id_liaison` = `l`.`id`)) join `port` `p1` on(`l`.`port_depart` = `p1`.`id`)) join `port` `p2` on(`l`.`port_arrive` = `p2`.`id`)) join `secteur` `s` on(`l`.`id_secteur` = `s`.`id`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bateau`
--
ALTER TABLE `bateau`
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
  ADD KEY `id_equipement` (`id_equipement`),
  ADD KEY `id_bateau` (`id_bateau`);

--
-- Index pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD PRIMARY KEY (`id`),
  ADD KEY `port_arrive` (`port_arrive`),
  ADD KEY `port_depart` (`port_depart`),
  ADD KEY `id_secteur` (`id_secteur`);

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
  ADD KEY `utilisateur_id` (`utilisateur_id`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_liaison`,`id_periode`,`id_type`),
  ADD KEY `id_periode` (`id_periode`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_bateau` (`id_bateau`),
  ADD KEY `id_liaison` (`id_liaison`);

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
-- AUTO_INCREMENT pour la table `categorie_equipement`
--
ALTER TABLE `categorie_equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `liaison`
--
ALTER TABLE `liaison`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `equipement_ibfk_1` FOREIGN KEY (`id_equipement`) REFERENCES `categorie_equipement` (`id`),
  ADD CONSTRAINT `equipement_ibfk_2` FOREIGN KEY (`id_bateau`) REFERENCES `bateau` (`id`);

--
-- Contraintes pour la table `liaison`
--
ALTER TABLE `liaison`
  ADD CONSTRAINT `liaison_ibfk_1` FOREIGN KEY (`port_arrive`) REFERENCES `port` (`id`),
  ADD CONSTRAINT `liaison_ibfk_2` FOREIGN KEY (`port_depart`) REFERENCES `port` (`id`),
  ADD CONSTRAINT `liaison_ibfk_3` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id`);

--
-- Contraintes pour la table `port`
--
ALTER TABLE `port`
  ADD CONSTRAINT `port_ibfk_1` FOREIGN KEY (`id_secteur`) REFERENCES `secteur` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_traversee`) REFERENCES `traversee` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`id_liaison`) REFERENCES `liaison` (`id`),
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`id_periode`) REFERENCES `periode` (`id`),
  ADD CONSTRAINT `tarif_ibfk_3` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`);

--
-- Contraintes pour la table `traversee`
--
ALTER TABLE `traversee`
  ADD CONSTRAINT `traversee_ibfk_1` FOREIGN KEY (`id_bateau`) REFERENCES `bateau` (`id`),
  ADD CONSTRAINT `traversee_ibfk_2` FOREIGN KEY (`id_liaison`) REFERENCES `liaison` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
