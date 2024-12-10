-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 10 déc. 2024 à 12:33
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
-- Base de données : `dpl`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `id_a` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `id_resp` int(11) NOT NULL,
  `date_d` date NOT NULL,
  `date_f` date NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id_a`, `description`, `id_resp`, `date_d`, `date_f`, `expired`) VALUES
(1, 'activite', 1, '2024-12-04', '2024-12-11', 0),
(2, 'activite_1', 2, '2024-12-08', '2024-12-13', 0),
(3, 'activite_2', 3, '2024-11-16', '2024-11-21', 0),
(4, 'activite_3', 2, '2024-12-25', '2024-12-30', 0),
(5, 'activite_4', 2, '2024-11-26', '2024-12-01', 1),
(6, 'activite_5', 1, '2024-12-19', '2024-12-24', 0),
(7, 'activite_6', 3, '2024-12-20', '2024-12-25', 0),
(8, 'activite_7', 4, '2024-11-25', '2024-11-30', 1),
(9, 'activite_8', 1, '2024-11-05', '2024-11-10', 0),
(10, 'activite_9', 3, '2024-12-05', '2024-12-10', 0),
(11, 'activite_10', 4, '2024-11-12', '2024-11-17', 0),
(12, 'activite_11', 3, '2024-12-17', '2024-12-22', 0),
(13, 'activite_12', 4, '2024-11-08', '2024-11-13', 0),
(14, 'activite_13', 2, '2024-12-24', '2024-12-29', 0),
(15, 'activite_14', 2, '2024-11-19', '2024-11-24', 0),
(16, 'activite_15', 4, '2024-11-29', '2024-12-04', 0),
(17, 'activite_16', 4, '2024-11-07', '2024-11-12', 0),
(18, 'activite_17', 1, '2024-11-25', '2024-11-30', 0),
(19, 'activite_18', 4, '2024-11-28', '2024-12-03', 0),
(20, 'activite_19', 4, '2024-12-07', '2024-12-12', 0),
(21, 'activite_20', 2, '2024-12-10', '2024-12-15', 0),
(22, 'activite_21', 2, '2024-12-24', '2024-12-29', 0),
(23, 'activite_22', 3, '2024-12-01', '2024-12-06', 0),
(24, 'activite_23', 3, '2024-12-14', '2024-12-19', 0),
(25, 'activite_24', 1, '2024-11-22', '2024-11-27', 0),
(26, 'activite_25', 1, '2024-12-08', '2024-12-13', 0),
(27, 'activite_26', 1, '2024-11-26', '2024-12-01', 1),
(28, 'activite_27', 1, '2024-11-02', '2024-11-07', 0),
(29, 'activite_28', 2, '2024-12-22', '2024-12-27', 0),
(30, 'activite_29', 4, '2024-11-01', '2024-11-06', 0),
(31, 'activite_30', 1, '2024-12-28', '2025-01-02', 0),
(32, 'activite_31', 2, '2024-12-26', '2024-12-31', 0),
(33, 'activite_32', 3, '2024-11-10', '2024-11-15', 0),
(34, 'activite_33', 1, '2024-11-02', '2024-11-07', 0),
(35, 'activite_34', 2, '2024-11-28', '2024-12-03', 0),
(36, 'activite_35', 2, '2024-12-01', '2024-12-06', 0),
(37, 'activite_36', 4, '2024-11-20', '2024-11-25', 0),
(38, 'activite_37', 3, '2024-11-22', '2024-11-27', 0),
(39, 'activite_38', 4, '2024-12-23', '2024-12-28', 0),
(40, 'activite_39', 3, '2024-11-04', '2024-11-09', 0),
(41, 'activite_40', 2, '2024-11-26', '2024-12-01', 1),
(42, 'activite_41', 2, '2024-12-04', '2024-12-09', 0),
(43, 'activite_42', 4, '2024-11-17', '2024-11-22', 0),
(44, 'activite_43', 2, '2024-11-24', '2024-11-29', 0),
(45, 'activite_44', 1, '2024-12-27', '2025-01-01', 0),
(46, 'activite_45', 3, '2024-12-14', '2024-12-19', 0),
(47, 'activite_46', 2, '2024-11-08', '2024-11-13', 0),
(48, 'activite_47', 1, '2024-12-21', '2024-12-26', 0),
(49, 'activite_48', 3, '2024-12-09', '2024-12-14', 0),
(50, 'activite_49', 1, '2024-11-07', '2024-11-12', 0),
(51, 'activite_50', 3, '2024-12-22', '2024-12-27', 0),
(52, 'activite_1', 2, '2024-11-13', '2024-11-18', 0),
(53, 'activite_2', 3, '2024-12-15', '2024-12-20', 0),
(54, 'activite_3', 1, '2024-12-13', '2024-12-18', 0),
(55, 'activite_4', 4, '2024-11-11', '2024-11-16', 0),
(56, 'activite_5', 2, '2024-11-03', '2024-11-08', 0),
(57, 'activite_6', 3, '2024-12-02', '2024-12-07', 0),
(58, 'activite_7', 3, '2024-12-13', '2024-12-18', 0),
(59, 'activite_8', 2, '2024-11-20', '2024-11-25', 0),
(60, 'activite_9', 1, '2024-12-12', '2024-12-17', 0),
(61, 'activite_10', 4, '2024-12-23', '2024-12-28', 0),
(62, 'activite_11', 2, '2024-11-21', '2024-11-26', 0),
(63, 'activite_12', 4, '2024-11-20', '2024-11-25', 0),
(64, 'activite_13', 2, '2024-12-15', '2024-12-20', 0),
(65, 'activite_14', 1, '2024-11-19', '2024-11-24', 0),
(66, 'activite_15', 2, '2024-11-23', '2024-11-28', 0),
(67, 'activite_16', 3, '2024-12-21', '2024-12-26', 0),
(68, 'activite_17', 4, '2024-11-26', '2024-12-01', 0),
(69, 'activite_18', 3, '2024-11-23', '2024-11-28', 0),
(70, 'activite_19', 4, '2024-11-14', '2024-11-19', 0),
(71, 'activite_20', 4, '2024-11-17', '2024-11-22', 0),
(72, 'activite_21', 3, '2024-11-21', '2024-11-26', 0),
(73, 'activite_22', 3, '2024-12-03', '2024-12-08', 0),
(74, 'activite_23', 1, '2024-11-13', '2024-11-18', 0),
(75, 'activite_24', 4, '2024-12-19', '2024-12-24', 0),
(76, 'activite_25', 3, '2024-11-16', '2024-11-21', 0),
(77, 'activite_26', 2, '2024-12-01', '2024-12-06', 0),
(78, 'activite_27', 3, '2024-11-11', '2024-11-16', 0),
(79, 'activite_28', 1, '2024-11-07', '2024-11-12', 0),
(80, 'activite_29', 1, '2024-12-29', '2025-01-03', 0),
(81, 'activite_30', 3, '2024-12-08', '2024-12-13', 0),
(82, 'activite_31', 4, '2024-11-24', '2024-11-29', 0),
(83, 'activite_32', 3, '2024-12-07', '2024-12-12', 0),
(84, 'activite_33', 4, '2024-12-06', '2024-12-11', 0),
(85, 'activite_34', 3, '2024-12-02', '2024-12-07', 0),
(86, 'activite_35', 4, '2024-12-10', '2024-12-15', 0),
(87, 'activite_36', 2, '2024-11-03', '2024-11-08', 0),
(88, 'activite_37', 3, '2024-12-11', '2024-12-16', 0),
(89, 'activite_38', 4, '2024-11-26', '2024-12-01', 1),
(90, 'activite_39', 3, '2024-12-29', '2025-01-03', 0),
(91, 'activite_40', 3, '2024-12-05', '2024-12-10', 0),
(92, 'activite_41', 4, '2024-12-05', '2024-12-10', 0),
(93, 'activite_42', 4, '2024-12-24', '2024-12-29', 0),
(94, 'activite_43', 4, '2024-11-28', '2024-12-03', 0),
(95, 'activite_44', 1, '2024-12-12', '2024-12-17', 0),
(96, 'activite_45', 4, '2024-12-06', '2024-12-11', 0),
(97, 'activite_46', 2, '2024-11-18', '2024-11-23', 0),
(98, 'activite_47', 2, '2024-11-05', '2024-11-10', 0),
(99, 'activite_48', 4, '2024-12-08', '2024-12-13', 0),
(100, 'activite_49', 1, '2024-12-24', '2024-12-29', 0),
(101, 'activite_50', 3, '2024-11-01', '2024-11-06', 0),
(102, 'activite_7', 5, '2024-12-12', '2024-12-25', 0);

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id_l` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id_l`, `nom_utilisateur`, `password`, `token`) VALUES
(2, 'admin', '$2y$10$AuTAvTXdCJdAjfYy0WOqZuPwUE3sMDcMTF2IHwbYxh0oTB1NiM3LK', NULL),
(3, 'personnel_2', '$2y$10$0tSFQBxALNNzPIJz32sJSO7GmwFz08D0SaNKKcyxOt./vMtxcylXe', NULL),
(4, 'personnel_3', '$2y$10$A63YFV/Gz.qGZTarTGP9ZuiFUMjn3uKrJ2E1uNttNrSIr.CwNFaze', NULL),
(5, 'personnel_4', '$2y$10$Qf69kJ3FMxVGqh8HG6paWewgnQ8Fqmb3tIuQQECg/YEvnN12ch1ei', NULL),
(6, 'personnel_5', '$2y$10$YviuuzZorRwkurTzllIjTesakQqG5pyEY8h1Zpqr9Tt3odoorZ46O', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE `permission` (
  `id_p` int(11) NOT NULL,
  `nom_p` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `permission`
--

INSERT INTO `permission` (`id_p`, `nom_p`) VALUES
(1, 'create_post'),
(2, 'edit_post'),
(3, 'delete_post'),
(4, 'view_post');

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE `personnel` (
  `id_p` int(11) NOT NULL,
  `nom_p` varchar(255) NOT NULL,
  `id_login` int(11) DEFAULT NULL,
  `service` int(11) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id_p`, `nom_p`, `id_login`, `service`, `mail`) VALUES
(1, 'personnel_1', 2, 1, 'personnel1@gmail.com'),
(2, 'personnel_2', 3, 2, 'personnel2@gmail.com'),
(3, 'personnel_3', 4, 2, 'personnel3@gmail.com'),
(4, 'personnel_4', 5, 1, 'personnel4@gmail.com'),
(5, 'personnel_5', 6, 2, 'personnel5@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_r` int(11) NOT NULL,
  `nom_r` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_r`, `nom_r`) VALUES
(1, 'admin'),
(2, 'editor'),
(3, 'viewer');

-- --------------------------------------------------------

--
-- Structure de la table `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 4),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `role_utilisateur`
--

CREATE TABLE `role_utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role_utilisateur`
--

INSERT INTO `role_utilisateur` (`id_utilisateur`, `id_role`) VALUES
(2, 1),
(3, 3),
(4, 2),
(5, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id_s` int(11) NOT NULL,
  `nom_s` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_s`, `nom_s`) VALUES
(1, 'service_1'),
(2, 'service_2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
  ADD PRIMARY KEY (`id_a`),
  ADD KEY `id_resp` (`id_resp`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_l`);

--
-- Index pour la table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id_p`);

--
-- Index pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id_p`),
  ADD KEY `id_login` (`id_login`),
  ADD KEY `id_login_2` (`id_login`),
  ADD KEY `id_login_3` (`id_login`),
  ADD KEY `service` (`service`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_r`);

--
-- Index pour la table `role_permission`
--
ALTER TABLE `role_permission`
  ADD KEY `role_id` (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Index pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  ADD KEY `id_utilisateur` (`id_utilisateur`,`id_role`),
  ADD KEY `id_role` (`id_role`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_s`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id_l` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `permission`
--
ALTER TABLE `permission`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `activite_ibfk_1` FOREIGN KEY (`id_resp`) REFERENCES `personnel` (`id_p`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_l`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`service`) REFERENCES `service` (`id_s`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id_r`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id_p`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `role_utilisateur`
--
ALTER TABLE `role_utilisateur`
  ADD CONSTRAINT `role_utilisateur_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `login` (`id_l`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_utilisateur_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_r`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
