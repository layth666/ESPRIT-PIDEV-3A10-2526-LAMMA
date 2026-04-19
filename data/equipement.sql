-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 avr. 2026 à 15:20
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
-- Base de données : `gestion_equipement`
--

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `type` varchar(20) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `statut` varchar(20) DEFAULT 'DISPONIBLE',
  `date_ajout` timestamp NULL DEFAULT current_timestamp(),
  `mail` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `equipement`
--

INSERT INTO `equipement` (`id`, `nom`, `description`, `categorie`, `type`, `prix`, `ville`, `statut`, `date_ajout`, `mail`) VALUES
(2, 'tente', '488888', 'Matelas', 'VENTE', 20.00, 'ariena', 'VENDU', '2026-02-18 20:07:45', NULL),
(9, 'tente', 'efefefefefffefklef655', 'Tente', 'LOCATION', 50.00, 'ariana', 'LOUE', '2026-02-26 00:46:51', NULL),
(13, 'tente', 'd	ezfezfezfe	f', 'Lunettes', 'VENTE', 40.00, 'ariana', 'LOUE', '2026-02-26 01:38:50', NULL),
(14, 'tente', 'zrfzrfzfezf', 'Lunettes', 'VENTE', 50.00, 'ariana', 'LOUE', '2026-02-26 01:41:39', NULL),
(12, 'iugiuk', 'ghcfcbvjv', 'Sac de couchage', 'LOCATION', 50.00, 'ariana', 'LOUE', '2026-02-26 01:23:19', NULL),
(15, 'mouheb', 'aaaaaa', 'Réchaud', 'VENTE', 50.00, 'ariana', 'LOUE', '2026-02-26 01:52:53', NULL),
(16, 'tenteeeeeee', 'reggrgrg', 'Chaise', 'VENTE', 50.00, 'ariana', 'LOUE', '2026-02-26 01:57:42', NULL),
(17, 'sac de couchage', 'dffefZF', 'Sac de couchage', 'LOCATION', 50.00, 'ariana', 'LOUE', '2026-02-26 11:49:26', NULL),
(18, 'azizzzzzzzzzzzzzzz', 'srgrgsrgrg', 'Matelas', 'LOCATION', 510.00, 'ariana', 'LOUE', '2026-03-03 02:10:30', NULL),
(19, 'tente', 'sssjsinnsjsis', 'Tente', 'LOCATION', 50.00, 'ariana', 'VENDU', '2026-03-03 07:02:20', NULL),
(20, 'tente', 'ksdnzidhzd', 'Sac de couchage', 'VENTE', 50.00, 'ariana', 'VENDU', '2026-03-04 07:50:58', NULL),
(21, 'lamaaaaaaaaaaaaaa', 'zrfrzfezfref', 'Matelas', 'LOCATION', 50.00, 'ariana', 'LOUE', '2026-03-04 07:53:10', NULL),
(22, 'tente', 'jhkiygk', 'Tente', 'LOCATION', 500.00, 'tunis', 'DISPONIBLE', '2026-03-04 09:14:06', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
