-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 02 juin 2025 à 08:53
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
  `nom` varchar(30) NOT NULL,
  `nom_image` varchar(50) NOT NULL,
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

INSERT INTO `bateau` (`id`, `nom`, `nom_image`, `longueur`, `largeur`, `vitesse`, `place_passager_max`, `place_vehicule_leger_max`, `place_vehicule_lourd_max`, `id_port`) VALUES
(1, 'Ferry Méditerranée', 'legende_marine', '180', '30', '25', 250, 60, 15, 1),
(2, 'Atlantique Express', 'legende_marine', '150', '28', '22', 220, 50, 10, 4),
(3, 'Beaucoup Express', 'legende_marine', '137', '25', '23', 197, 32, 18, 4),
(4, 'Promettre Express', 'legende_marine', '108', '22', '30', 183, 39, 11, 1),
(5, 'Gros Express', 'vague_agile', '189', '32', '28', 220, 63, 17, 2),
(6, 'Trois Express', 'vague_agile', '186', '33', '29', 220, 58, 25, 6),
(7, 'Importance Express', 'vague_agile', '182', '31', '21', 233, 69, 13, 4),
(8, 'Envie Express', 'vague_agile', '175', '30', '23', 212, 31, 18, 1),
(9, 'Maintenant Express', 'vague_agile', '190', '27', '25', 193, 51, 23, 1);

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
(1, 430.55, 3, 4, 2, 1),
(2, 309.04, 6, 5, 3, 2),
(3, 311.04, 6, 1, 3, 3),
(4, 197.67, 1, 4, 2, 4),
(5, 113.40, 1, 5, 1, 5),
(6, 121.08, 5, 4, 1, 6),
(7, 224.30, 6, 4, 3, 7),
(8, 126.00, 1, 3, 1, 8),
(9, 106.55, 5, 3, 1, 9),
(10, 68.44, 6, 1, 3, 2),
(11, 454.11, 4, 3, 2, 7),
(12, 354.89, 2, 5, 1, 7),
(13, 425.80, 6, 1, 3, 5),
(14, 306.46, 1, 3, 1, 6),
(15, 246.38, 1, 2, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `quantite` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_type_passager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`quantite`, `id_reservation`, `id_type_passager`) VALUES
(2, 167, 1),
(4, 167, 3),
(1, 168, 2),
(2, 168, 3),
(1, 169, 1),
(3, 169, 2),
(4, 169, 3);

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
(167, 258, '2025-06-02 06:32:09', 1, 1),
(168, 166, '2025-06-02 06:51:50', 3, 2),
(169, 169, '2025-06-02 06:51:59', 34, 3);

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
(1, 1, 1, 1, NULL, 5.00),
(2, 1, 1, 2, NULL, 12.00),
(3, 1, 1, 3, NULL, 22.00),
(4, 2, 1, 1, NULL, 6.00),
(5, 2, 1, 2, NULL, 13.00),
(6, 2, 1, 3, NULL, 23.00),
(7, 3, 1, 1, NULL, 7.00),
(8, 3, 1, 2, NULL, 14.00),
(9, 3, 1, 3, NULL, 24.00),
(10, 4, 1, 1, NULL, 8.00),
(11, 4, 1, 2, NULL, 15.00),
(12, 4, 1, 3, NULL, 25.00),
(13, 5, 1, 1, NULL, 9.00),
(14, 5, 1, 2, NULL, 16.00),
(15, 5, 1, 3, NULL, 26.00),
(16, 6, 1, 1, NULL, 10.00),
(17, 6, 1, 2, NULL, 17.00),
(18, 6, 1, 3, NULL, 27.00),
(19, 7, 1, 1, NULL, 11.00),
(20, 7, 1, 2, NULL, 18.00),
(21, 7, 1, 3, NULL, 28.00),
(22, 8, 1, 1, NULL, 12.00),
(23, 8, 1, 2, NULL, 19.00),
(24, 8, 1, 3, NULL, 29.00),
(25, 9, 1, 1, NULL, 13.00),
(26, 9, 1, 2, NULL, 20.00),
(27, 9, 1, 3, NULL, 30.00),
(28, 10, 1, 1, NULL, 14.00),
(29, 10, 1, 2, NULL, 21.00),
(30, 10, 1, 3, NULL, 31.00),
(31, 11, 1, 1, NULL, 15.00),
(32, 11, 1, 2, NULL, 22.00),
(33, 11, 1, 3, NULL, 32.00),
(34, 12, 1, 1, NULL, 16.00),
(35, 12, 1, 2, NULL, 23.00),
(36, 12, 1, 3, NULL, 33.00),
(37, 13, 1, 1, NULL, 17.00),
(38, 13, 1, 2, NULL, 24.00),
(39, 13, 1, 3, NULL, 34.00),
(40, 14, 1, 1, NULL, 18.00),
(41, 14, 1, 2, NULL, 25.00),
(42, 14, 1, 3, NULL, 35.00),
(43, 15, 1, 1, NULL, 19.00),
(44, 15, 1, 2, NULL, 26.00),
(45, 15, 1, 3, NULL, 36.00),
(46, 1, 2, 1, NULL, 4.00),
(47, 1, 2, 2, NULL, 10.00),
(48, 1, 2, 3, NULL, 20.00),
(49, 2, 2, 1, NULL, 5.00),
(50, 2, 2, 2, NULL, 11.00),
(51, 2, 2, 3, NULL, 21.00),
(52, 3, 2, 1, NULL, 6.00),
(53, 3, 2, 2, NULL, 12.00),
(54, 3, 2, 3, NULL, 22.00),
(55, 4, 2, 1, NULL, 7.00),
(56, 4, 2, 2, NULL, 13.00),
(57, 4, 2, 3, NULL, 23.00),
(58, 5, 2, 1, NULL, 8.00),
(59, 5, 2, 2, NULL, 14.00),
(60, 5, 2, 3, NULL, 24.00),
(61, 6, 2, 1, NULL, 9.00),
(62, 6, 2, 2, NULL, 15.00),
(63, 6, 2, 3, NULL, 25.00),
(64, 7, 2, 1, NULL, 10.00),
(65, 7, 2, 2, NULL, 16.00),
(66, 7, 2, 3, NULL, 26.00),
(67, 8, 2, 1, NULL, 11.00),
(68, 8, 2, 2, NULL, 17.00),
(69, 8, 2, 3, NULL, 27.00),
(70, 9, 2, 1, NULL, 12.00),
(71, 9, 2, 2, NULL, 18.00),
(72, 9, 2, 3, NULL, 28.00),
(73, 10, 2, 1, NULL, 13.00),
(74, 10, 2, 2, NULL, 19.00),
(75, 10, 2, 3, NULL, 29.00),
(76, 11, 2, 1, NULL, 14.00),
(77, 11, 2, 2, NULL, 20.00),
(78, 11, 2, 3, NULL, 30.00),
(79, 12, 2, 1, NULL, 15.00),
(80, 12, 2, 2, NULL, 21.00),
(81, 12, 2, 3, NULL, 31.00),
(82, 13, 2, 1, NULL, 16.00),
(83, 13, 2, 2, NULL, 22.00),
(84, 13, 2, 3, NULL, 32.00),
(85, 14, 2, 1, NULL, 17.00),
(86, 14, 2, 2, NULL, 23.00),
(87, 14, 2, 3, NULL, 33.00),
(88, 15, 2, 1, NULL, 18.00),
(89, 15, 2, 2, NULL, 24.00),
(90, 15, 2, 3, NULL, 34.00),
(91, 1, 3, 1, NULL, 4.50),
(92, 1, 3, 2, NULL, 11.00),
(93, 1, 3, 3, NULL, 21.00),
(94, 2, 3, 1, NULL, 5.50),
(95, 2, 3, 2, NULL, 12.00),
(96, 2, 3, 3, NULL, 22.00),
(97, 3, 3, 1, NULL, 6.50),
(98, 3, 3, 2, NULL, 13.00),
(99, 3, 3, 3, NULL, 23.00),
(100, 4, 3, 1, NULL, 7.50),
(101, 4, 3, 2, NULL, 14.00),
(102, 4, 3, 3, NULL, 24.00),
(103, 5, 3, 1, NULL, 8.50),
(104, 5, 3, 2, NULL, 15.00),
(105, 5, 3, 3, NULL, 25.00),
(106, 6, 3, 1, NULL, 9.50),
(107, 6, 3, 2, NULL, 16.00),
(108, 6, 3, 3, NULL, 26.00),
(109, 7, 3, 1, NULL, 10.50),
(110, 7, 3, 2, NULL, 17.00),
(111, 7, 3, 3, NULL, 27.00),
(112, 8, 3, 1, NULL, 11.50),
(113, 8, 3, 2, NULL, 18.00),
(114, 8, 3, 3, NULL, 28.00),
(115, 9, 3, 1, NULL, 12.50),
(116, 9, 3, 2, NULL, 19.00),
(117, 9, 3, 3, NULL, 29.00),
(118, 10, 3, 1, NULL, 13.50),
(119, 10, 3, 2, NULL, 20.00),
(120, 10, 3, 3, NULL, 30.00),
(121, 11, 3, 1, NULL, 14.50),
(122, 11, 3, 2, NULL, 21.00),
(123, 11, 3, 3, NULL, 31.00),
(124, 12, 3, 1, NULL, 15.50),
(125, 12, 3, 2, NULL, 22.00),
(126, 12, 3, 3, NULL, 32.00),
(127, 13, 3, 1, NULL, 16.50),
(128, 13, 3, 2, NULL, 23.00),
(129, 13, 3, 3, NULL, 33.00),
(130, 14, 3, 1, NULL, 17.50),
(131, 14, 3, 2, NULL, 24.00),
(132, 14, 3, 3, NULL, 34.00),
(133, 15, 3, 1, NULL, 18.50),
(134, 15, 3, 2, NULL, 25.00),
(135, 15, 3, 3, NULL, 35.00),
(136, 1, 4, 1, NULL, 4.25),
(137, 1, 4, 2, NULL, 10.50),
(138, 1, 4, 3, NULL, 20.50),
(139, 2, 4, 1, NULL, 5.25),
(140, 2, 4, 2, NULL, 11.50),
(141, 2, 4, 3, NULL, 21.50),
(142, 3, 4, 1, NULL, 6.25),
(143, 3, 4, 2, NULL, 12.50),
(144, 3, 4, 3, NULL, 22.50),
(145, 4, 4, 1, NULL, 7.25),
(146, 4, 4, 2, NULL, 13.50),
(147, 4, 4, 3, NULL, 23.50),
(148, 5, 4, 1, NULL, 8.25),
(149, 5, 4, 2, NULL, 14.50),
(150, 5, 4, 3, NULL, 24.50),
(151, 6, 4, 1, NULL, 9.25),
(152, 6, 4, 2, NULL, 15.50),
(153, 6, 4, 3, NULL, 25.50),
(154, 7, 4, 1, NULL, 10.25),
(155, 7, 4, 2, NULL, 16.50),
(156, 7, 4, 3, NULL, 26.50),
(157, 8, 4, 1, NULL, 11.25),
(158, 8, 4, 2, NULL, 17.50),
(159, 8, 4, 3, NULL, 27.50),
(160, 9, 4, 1, NULL, 12.25),
(161, 9, 4, 2, NULL, 18.50),
(162, 9, 4, 3, NULL, 28.50),
(163, 10, 4, 1, NULL, 13.25),
(164, 10, 4, 2, NULL, 19.50),
(165, 10, 4, 3, NULL, 29.50),
(166, 11, 4, 1, NULL, 14.25),
(167, 11, 4, 2, NULL, 20.50),
(168, 11, 4, 3, NULL, 30.50),
(169, 12, 4, 1, NULL, 15.25),
(170, 12, 4, 2, NULL, 21.50),
(171, 12, 4, 3, NULL, 31.50),
(172, 13, 4, 1, NULL, 16.25),
(173, 13, 4, 2, NULL, 22.50),
(174, 13, 4, 3, NULL, 32.50),
(175, 14, 4, 1, NULL, 17.25),
(176, 14, 4, 2, NULL, 23.50),
(177, 14, 4, 3, NULL, 33.50),
(178, 15, 4, 1, NULL, 18.25),
(179, 15, 4, 2, NULL, 24.50),
(180, 15, 4, 3, NULL, 34.50),
(181, 1, 1, NULL, 4, 40.00),
(182, 1, 1, NULL, 5, 50.00),
(183, 1, 1, NULL, 6, 60.00),
(184, 1, 1, NULL, 7, 70.00),
(185, 1, 1, NULL, 8, 80.00),
(186, 1, 2, NULL, 4, 35.00),
(187, 1, 2, NULL, 5, 45.00),
(188, 1, 2, NULL, 6, 55.00),
(189, 1, 2, NULL, 7, 65.00),
(190, 1, 2, NULL, 8, 75.00),
(191, 1, 3, NULL, 4, 38.00),
(192, 1, 3, NULL, 5, 48.00),
(193, 1, 3, NULL, 6, 58.00),
(194, 1, 3, NULL, 7, 68.00),
(195, 1, 3, NULL, 8, 78.00),
(196, 1, 4, NULL, 4, 36.00),
(197, 1, 4, NULL, 5, 46.00),
(198, 1, 4, NULL, 6, 56.00),
(199, 1, 4, NULL, 7, 66.00),
(200, 1, 4, NULL, 8, 76.00),
(201, 2, 1, NULL, 4, 41.00),
(202, 2, 1, NULL, 5, 51.00),
(203, 2, 1, NULL, 6, 61.00),
(204, 2, 1, NULL, 7, 71.00),
(205, 2, 1, NULL, 8, 81.00),
(206, 2, 2, NULL, 4, 36.00),
(207, 2, 2, NULL, 5, 46.00),
(208, 2, 2, NULL, 6, 56.00),
(209, 2, 2, NULL, 7, 66.00),
(210, 2, 2, NULL, 8, 76.00),
(211, 2, 3, NULL, 4, 39.00),
(212, 2, 3, NULL, 5, 49.00),
(213, 2, 3, NULL, 6, 59.00),
(214, 2, 3, NULL, 7, 69.00),
(215, 2, 3, NULL, 8, 79.00),
(216, 2, 4, NULL, 4, 37.00),
(217, 2, 4, NULL, 5, 47.00),
(218, 2, 4, NULL, 6, 57.00),
(219, 2, 4, NULL, 7, 67.00),
(220, 2, 4, NULL, 8, 77.00),
(221, 3, 1, NULL, 4, 42.00),
(222, 3, 1, NULL, 5, 52.00),
(223, 3, 1, NULL, 6, 62.00),
(224, 3, 1, NULL, 7, 72.00),
(225, 3, 1, NULL, 8, 82.00),
(226, 3, 2, NULL, 4, 37.00),
(227, 3, 2, NULL, 5, 47.00),
(228, 3, 2, NULL, 6, 57.00),
(229, 3, 2, NULL, 7, 67.00),
(230, 3, 2, NULL, 8, 77.00),
(231, 3, 3, NULL, 4, 40.00),
(232, 3, 3, NULL, 5, 50.00),
(233, 3, 3, NULL, 6, 60.00),
(234, 3, 3, NULL, 7, 70.00),
(235, 3, 3, NULL, 8, 80.00),
(236, 3, 4, NULL, 4, 38.00),
(237, 3, 4, NULL, 5, 48.00),
(238, 3, 4, NULL, 6, 58.00),
(239, 3, 4, NULL, 7, 68.00),
(240, 3, 4, NULL, 8, 78.00),
(241, 4, 1, NULL, 4, 43.00),
(242, 4, 1, NULL, 5, 53.00),
(243, 4, 1, NULL, 6, 63.00),
(244, 4, 1, NULL, 7, 73.00),
(245, 4, 1, NULL, 8, 83.00),
(246, 4, 2, NULL, 4, 38.00),
(247, 4, 2, NULL, 5, 48.00),
(248, 4, 2, NULL, 6, 58.00),
(249, 4, 2, NULL, 7, 68.00),
(250, 4, 2, NULL, 8, 78.00),
(251, 4, 3, NULL, 4, 41.00),
(252, 4, 3, NULL, 5, 51.00),
(253, 4, 3, NULL, 6, 61.00),
(254, 4, 3, NULL, 7, 71.00),
(255, 4, 3, NULL, 8, 81.00),
(256, 4, 4, NULL, 4, 39.00),
(257, 4, 4, NULL, 5, 49.00),
(258, 4, 4, NULL, 6, 59.00),
(259, 4, 4, NULL, 7, 69.00),
(260, 4, 4, NULL, 8, 79.00),
(261, 5, 1, NULL, 4, 44.00),
(262, 5, 1, NULL, 5, 54.00),
(263, 5, 1, NULL, 6, 64.00),
(264, 5, 1, NULL, 7, 74.00),
(265, 5, 1, NULL, 8, 84.00),
(266, 5, 2, NULL, 4, 39.00),
(267, 5, 2, NULL, 5, 49.00),
(268, 5, 2, NULL, 6, 59.00),
(269, 5, 2, NULL, 7, 69.00),
(270, 5, 2, NULL, 8, 79.00),
(271, 5, 3, NULL, 4, 42.00),
(272, 5, 3, NULL, 5, 52.00),
(273, 5, 3, NULL, 6, 62.00),
(274, 5, 3, NULL, 7, 72.00),
(275, 5, 3, NULL, 8, 82.00),
(276, 5, 4, NULL, 4, 40.00),
(277, 5, 4, NULL, 5, 50.00),
(278, 5, 4, NULL, 6, 60.00),
(279, 5, 4, NULL, 7, 70.00),
(280, 5, 4, NULL, 8, 80.00),
(281, 6, 1, NULL, 4, 45.00),
(282, 6, 1, NULL, 5, 55.00),
(283, 6, 1, NULL, 6, 65.00),
(284, 6, 1, NULL, 7, 75.00),
(285, 6, 1, NULL, 8, 85.00),
(286, 6, 2, NULL, 4, 40.00),
(287, 6, 2, NULL, 5, 50.00),
(288, 6, 2, NULL, 6, 60.00),
(289, 6, 2, NULL, 7, 70.00),
(290, 6, 2, NULL, 8, 80.00),
(291, 6, 3, NULL, 4, 43.00),
(292, 6, 3, NULL, 5, 53.00),
(293, 6, 3, NULL, 6, 63.00),
(294, 6, 3, NULL, 7, 73.00),
(295, 6, 3, NULL, 8, 83.00),
(296, 6, 4, NULL, 4, 41.00),
(297, 6, 4, NULL, 5, 51.00),
(298, 6, 4, NULL, 6, 61.00),
(299, 6, 4, NULL, 7, 71.00),
(300, 6, 4, NULL, 8, 81.00),
(301, 7, 1, NULL, 4, 46.00),
(302, 7, 1, NULL, 5, 56.00),
(303, 7, 1, NULL, 6, 66.00),
(304, 7, 1, NULL, 7, 76.00),
(305, 7, 1, NULL, 8, 86.00),
(306, 7, 2, NULL, 4, 41.00),
(307, 7, 2, NULL, 5, 51.00),
(308, 7, 2, NULL, 6, 61.00),
(309, 7, 2, NULL, 7, 71.00),
(310, 7, 2, NULL, 8, 81.00),
(311, 7, 3, NULL, 4, 44.00),
(312, 7, 3, NULL, 5, 54.00),
(313, 7, 3, NULL, 6, 64.00),
(314, 7, 3, NULL, 7, 74.00),
(315, 7, 3, NULL, 8, 84.00),
(316, 7, 4, NULL, 4, 42.00),
(317, 7, 4, NULL, 5, 52.00),
(318, 7, 4, NULL, 6, 62.00),
(319, 7, 4, NULL, 7, 72.00),
(320, 7, 4, NULL, 8, 82.00),
(321, 8, 1, NULL, 4, 47.00),
(322, 8, 1, NULL, 5, 57.00),
(323, 8, 1, NULL, 6, 67.00),
(324, 8, 1, NULL, 7, 77.00),
(325, 8, 1, NULL, 8, 87.00),
(326, 8, 2, NULL, 4, 42.00),
(327, 8, 2, NULL, 5, 52.00),
(328, 8, 2, NULL, 6, 62.00),
(329, 8, 2, NULL, 7, 72.00),
(330, 8, 2, NULL, 8, 82.00),
(331, 8, 3, NULL, 4, 45.00),
(332, 8, 3, NULL, 5, 55.00),
(333, 8, 3, NULL, 6, 65.00),
(334, 8, 3, NULL, 7, 75.00),
(335, 8, 3, NULL, 8, 85.00),
(336, 8, 4, NULL, 4, 43.00),
(337, 8, 4, NULL, 5, 53.00),
(338, 8, 4, NULL, 6, 63.00),
(339, 8, 4, NULL, 7, 73.00),
(340, 8, 4, NULL, 8, 83.00),
(341, 9, 1, NULL, 4, 48.00),
(342, 9, 1, NULL, 5, 58.00),
(343, 9, 1, NULL, 6, 68.00),
(344, 9, 1, NULL, 7, 78.00),
(345, 9, 1, NULL, 8, 88.00),
(346, 9, 2, NULL, 4, 43.00),
(347, 9, 2, NULL, 5, 53.00),
(348, 9, 2, NULL, 6, 63.00),
(349, 9, 2, NULL, 7, 73.00),
(350, 9, 2, NULL, 8, 83.00),
(351, 9, 3, NULL, 4, 46.00),
(352, 9, 3, NULL, 5, 56.00),
(353, 9, 3, NULL, 6, 66.00),
(354, 9, 3, NULL, 7, 76.00),
(355, 9, 3, NULL, 8, 86.00),
(356, 9, 4, NULL, 4, 44.00),
(357, 9, 4, NULL, 5, 54.00),
(358, 9, 4, NULL, 6, 64.00),
(359, 9, 4, NULL, 7, 74.00),
(360, 9, 4, NULL, 8, 84.00),
(361, 10, 1, NULL, 4, 49.00),
(362, 10, 1, NULL, 5, 59.00),
(363, 10, 1, NULL, 6, 69.00),
(364, 10, 1, NULL, 7, 79.00),
(365, 10, 1, NULL, 8, 89.00),
(366, 10, 2, NULL, 4, 44.00),
(367, 10, 2, NULL, 5, 54.00),
(368, 10, 2, NULL, 6, 64.00),
(369, 10, 2, NULL, 7, 74.00),
(370, 10, 2, NULL, 8, 84.00),
(371, 10, 3, NULL, 4, 47.00),
(372, 10, 3, NULL, 5, 57.00),
(373, 10, 3, NULL, 6, 67.00),
(374, 10, 3, NULL, 7, 77.00),
(375, 10, 3, NULL, 8, 87.00),
(376, 10, 4, NULL, 4, 45.00),
(377, 10, 4, NULL, 5, 55.00),
(378, 10, 4, NULL, 6, 65.00),
(379, 10, 4, NULL, 7, 75.00),
(380, 10, 4, NULL, 8, 85.00),
(381, 11, 1, NULL, 4, 50.00),
(382, 11, 1, NULL, 5, 60.00),
(383, 11, 1, NULL, 6, 70.00),
(384, 11, 1, NULL, 7, 80.00),
(385, 11, 1, NULL, 8, 90.00),
(386, 11, 2, NULL, 4, 45.00),
(387, 11, 2, NULL, 5, 55.00),
(388, 11, 2, NULL, 6, 65.00),
(389, 11, 2, NULL, 7, 75.00),
(390, 11, 2, NULL, 8, 85.00),
(391, 11, 3, NULL, 4, 48.00),
(392, 11, 3, NULL, 5, 58.00),
(393, 11, 3, NULL, 6, 68.00),
(394, 11, 3, NULL, 7, 78.00),
(395, 11, 3, NULL, 8, 88.00),
(396, 11, 4, NULL, 4, 46.00),
(397, 11, 4, NULL, 5, 56.00),
(398, 11, 4, NULL, 6, 66.00),
(399, 11, 4, NULL, 7, 76.00),
(400, 11, 4, NULL, 8, 86.00),
(401, 12, 1, NULL, 4, 51.00),
(402, 12, 1, NULL, 5, 61.00),
(403, 12, 1, NULL, 6, 71.00),
(404, 12, 1, NULL, 7, 81.00),
(405, 12, 1, NULL, 8, 91.00),
(406, 12, 2, NULL, 4, 46.00),
(407, 12, 2, NULL, 5, 56.00),
(408, 12, 2, NULL, 6, 66.00),
(409, 12, 2, NULL, 7, 76.00),
(410, 12, 2, NULL, 8, 86.00),
(411, 12, 3, NULL, 4, 49.00),
(412, 12, 3, NULL, 5, 59.00),
(413, 12, 3, NULL, 6, 69.00),
(414, 12, 3, NULL, 7, 79.00),
(415, 12, 3, NULL, 8, 89.00),
(416, 12, 4, NULL, 4, 47.00),
(417, 12, 4, NULL, 5, 57.00),
(418, 12, 4, NULL, 6, 67.00),
(419, 12, 4, NULL, 7, 77.00),
(420, 12, 4, NULL, 8, 87.00),
(421, 13, 1, NULL, 4, 52.00),
(422, 13, 1, NULL, 5, 62.00),
(423, 13, 1, NULL, 6, 72.00),
(424, 13, 1, NULL, 7, 82.00),
(425, 13, 1, NULL, 8, 92.00),
(426, 13, 2, NULL, 4, 47.00),
(427, 13, 2, NULL, 5, 57.00),
(428, 13, 2, NULL, 6, 67.00),
(429, 13, 2, NULL, 7, 77.00),
(430, 13, 2, NULL, 8, 87.00),
(431, 13, 3, NULL, 4, 50.00),
(432, 13, 3, NULL, 5, 60.00),
(433, 13, 3, NULL, 6, 70.00),
(434, 13, 3, NULL, 7, 80.00),
(435, 13, 3, NULL, 8, 90.00),
(436, 13, 4, NULL, 4, 48.00),
(437, 13, 4, NULL, 5, 58.00),
(438, 13, 4, NULL, 6, 68.00),
(439, 13, 4, NULL, 7, 78.00),
(440, 13, 4, NULL, 8, 88.00),
(441, 14, 1, NULL, 4, 53.00),
(442, 14, 1, NULL, 5, 63.00),
(443, 14, 1, NULL, 6, 73.00),
(444, 14, 1, NULL, 7, 83.00),
(445, 14, 1, NULL, 8, 93.00),
(446, 14, 2, NULL, 4, 48.00),
(447, 14, 2, NULL, 5, 58.00),
(448, 14, 2, NULL, 6, 68.00),
(449, 14, 2, NULL, 7, 78.00),
(450, 14, 2, NULL, 8, 88.00),
(451, 14, 3, NULL, 4, 51.00),
(452, 14, 3, NULL, 5, 61.00),
(453, 14, 3, NULL, 6, 71.00),
(454, 14, 3, NULL, 7, 81.00),
(455, 14, 3, NULL, 8, 91.00),
(456, 14, 4, NULL, 4, 49.00),
(457, 14, 4, NULL, 5, 59.00),
(458, 14, 4, NULL, 6, 69.00),
(459, 14, 4, NULL, 7, 79.00),
(460, 14, 4, NULL, 8, 89.00),
(461, 15, 1, NULL, 4, 54.00),
(462, 15, 1, NULL, 5, 64.00),
(463, 15, 1, NULL, 6, 74.00),
(464, 15, 1, NULL, 7, 84.00),
(465, 15, 1, NULL, 8, 94.00),
(466, 15, 2, NULL, 4, 49.00),
(467, 15, 2, NULL, 5, 59.00),
(468, 15, 2, NULL, 6, 69.00),
(469, 15, 2, NULL, 7, 79.00),
(470, 15, 2, NULL, 8, 89.00),
(471, 15, 3, NULL, 4, 52.00),
(472, 15, 3, NULL, 5, 62.00),
(473, 15, 3, NULL, 6, 72.00),
(474, 15, 3, NULL, 7, 82.00),
(475, 15, 3, NULL, 8, 92.00),
(476, 15, 4, NULL, 4, 50.00),
(477, 15, 4, NULL, 5, 60.00),
(478, 15, 4, NULL, 6, 70.00),
(479, 15, 4, NULL, 7, 80.00),
(480, 15, 4, NULL, 8, 90.00);

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
(2, '2025-05-29 17:31:00', '2025-05-29 18:33:00', 3),
(3, '2025-07-29 04:01:00', '2025-07-29 05:23:00', 14),
(4, '2025-07-24 17:34:00', '2025-07-24 20:34:00', 9),
(5, '2025-08-15 05:22:00', '2025-08-15 22:35:00', 15),
(6, '2025-07-17 14:50:00', '2025-07-17 17:50:00', 5),
(7, '2025-07-24 10:12:00', '2025-07-24 11:55:00', 11),
(8, '2025-08-15 18:21:00', '2025-08-15 21:21:00', 6),
(9, '2025-06-13 12:21:00', '2025-06-13 21:54:00', 7),
(10, '2025-06-05 21:04:00', '2025-06-05 00:04:00', 14),
(11, '2025-06-18 21:25:00', '2025-06-18 00:25:00', 11),
(12, '2025-07-16 22:48:00', '2025-07-16 01:48:00', 5),
(13, '2025-08-04 12:37:00', '2025-08-04 19:22:00', 3),
(14, '2025-08-08 01:46:00', '2025-08-08 09:15:00', 9),
(15, '2025-08-10 10:47:00', '2025-08-10 13:47:00', 12),
(16, '2025-07-27 01:57:00', '2025-07-27 07:36:00', 1),
(17, '2025-07-29 10:31:00', '2025-07-29 16:47:00', 8),
(18, '2025-07-27 14:13:00', '2025-07-27 15:02:00', 12),
(19, '2025-07-25 09:39:00', '2025-07-25 12:39:00', 2),
(20, '2025-07-12 18:16:00', '2025-07-12 21:16:00', 6),
(21, '2025-06-19 14:03:00', '2025-06-19 17:03:00', 12),
(22, '2025-06-13 11:56:00', '2025-06-13 19:24:00', 1),
(23, '2025-08-15 11:15:00', '2025-08-15 14:15:00', 9),
(24, '2025-07-21 02:41:00', '2025-07-21 14:01:00', 5),
(25, '2025-08-19 21:31:00', '2025-08-19 00:31:00', 3),
(26, '2025-06-11 02:33:00', '2025-06-11 03:22:00', 4),
(27, '2025-08-05 23:40:00', '2025-08-05 02:40:00', 13),
(28, '2025-08-13 22:36:00', '2025-08-13 01:36:00', 8),
(29, '2025-06-03 08:34:00', '2025-06-03 15:36:00', 6),
(30, '2025-06-28 06:29:00', '2025-06-28 13:52:00', 10),
(31, '2025-06-22 10:07:00', '2025-06-22 23:07:00', 5),
(32, '2025-08-01 19:22:00', '2025-08-01 22:22:00', 11),
(33, '2025-07-31 04:50:00', '2025-07-31 23:37:00', 6),
(34, '2025-07-01 07:57:00', '2025-07-01 18:55:00', 10),
(35, '2025-06-27 22:53:00', '2025-06-27 01:53:00', 15),
(36, '2025-07-23 16:13:00', '2025-07-23 19:13:00', 11),
(37, '2025-08-08 14:48:00', '2025-08-08 17:48:00', 14),
(38, '2025-07-02 11:52:00', '2025-07-02 12:47:00', 10),
(39, '2025-07-28 04:37:00', '2025-07-28 13:24:00', 3),
(40, '2025-06-21 13:37:00', '2025-06-21 16:37:00', 12),
(41, '2025-06-19 04:44:00', '2025-06-19 08:58:00', 5),
(42, '2025-06-04 02:29:00', '2025-06-04 05:52:00', 7);

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
(1, 'Enfant', 1),
(2, 'Junior', 1),
(3, 'Adulte', 1);

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
(1, 'Guillemet', 'Bastien', 'bastien.guillemet3064@gmail.com', '$2y$10$Uk.04uAaPxX7r7Hc1W9aUuFNbol9BnsutYLrRdo9AECewslLU/S76', '0626436430', 1),
(2, 'Dubois', 'Clément', 'contact.clementdbs@gmail.com', '$2y$10$MgEJI6OKor1Mi05iceDFTOUQ/D46njsRtYn0dqtiMML3qwh3t2KHS', '0642852548', 1),
(3, 'Martin', 'Lucie', 'lucie.martin@example.com', '1', '0605060708', 0);

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `quantite` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `id_type_vehicule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vehicule`
--

INSERT INTO `vehicule` (`quantite`, `id_reservation`, `id_type_vehicule`) VALUES
(2, 167, 5),
(1, 167, 6),
(1, 168, 4),
(1, 168, 7),
(1, 169, 4);

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
-- Doublure de structure pour la vue `vue_ports`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_ports` (
`id_port` int(11)
,`nom_port` varchar(50)
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
,`nom_bateau` varchar(30)
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
-- Structure de la vue `vue_ports`
--
DROP TABLE IF EXISTS `vue_ports`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_ports`  AS SELECT `p`.`id` AS `id_port`, `p`.`nom` AS `nom_port`, `s`.`id` AS `id_secteur`, `s`.`nom` AS `nom_secteur` FROM (`port` `p` join `secteur` `s` on(`p`.`id_secteur` = `s`.`id`)) ;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_traversee`  AS SELECT `t`.`id` AS `id_traversee`, `t`.`depart` AS `date_depart`, `t`.`arrive` AS `date_arrive`, `t`.`id_liaison` AS `id_liaison`, `pd`.`nom` AS `depart`, `pa`.`nom` AS `arrive`, `l`.`id_bateau` AS `id_bateau`, `b`.`nom` AS `nom_bateau`, `b`.`place_passager_max`- coalesce((select sum(`p`.`quantite`) from (((`reservation` `r` join `passager` `p` on(`r`.`id` = `p`.`id_reservation`)) join `type_passager` `tp` on(`p`.`id_type_passager` = `tp`.`id`)) join `categorie` `c` on(`tp`.`id_categorie` = `c`.`id`)) where `r`.`id_traversee` = `t`.`id` and `c`.`libelle` = 'A'),0) AS `places_passager_restantes`, `b`.`place_vehicule_leger_max`- coalesce((select sum(`v`.`quantite`) from (((`reservation` `r` join `vehicule` `v` on(`r`.`id` = `v`.`id_reservation`)) join `type_vehicule` `tv` on(`v`.`id_type_vehicule` = `tv`.`id`)) join `categorie` `c` on(`tv`.`id_categorie` = `c`.`id`)) where `r`.`id_traversee` = `t`.`id` and `c`.`libelle` = 'B'),0) AS `places_vehicule_leger_restantes`, `b`.`place_vehicule_lourd_max`- coalesce((select sum(`v`.`quantite`) from (((`reservation` `r` join `vehicule` `v` on(`r`.`id` = `v`.`id_reservation`)) join `type_vehicule` `tv` on(`v`.`id_type_vehicule` = `tv`.`id`)) join `categorie` `c` on(`tv`.`id_categorie` = `c`.`id`)) where `r`.`id_traversee` = `t`.`id` and `c`.`libelle` = 'C'),0) AS `places_vehicule_lourd_restantes` FROM ((((`traversee` `t` join `liaison` `l` on(`t`.`id_liaison` = `l`.`id`)) join `bateau` `b` on(`l`.`id_bateau` = `b`.`id`)) join `port` `pd` on(`l`.`port_depart` = `pd`.`id`)) join `port` `pa` on(`l`.`port_arrive` = `pa`.`id`)) ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `port`
--
ALTER TABLE `port`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT pour la table `secteur`
--
ALTER TABLE `secteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;

--
-- AUTO_INCREMENT pour la table `traversee`
--
ALTER TABLE `traversee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

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
