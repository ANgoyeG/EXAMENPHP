-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 17 mars 2024 à 22:18
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `examphp`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrators`
--

CREATE TABLE `administrators` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordd` varchar(255) NOT NULL,
  `other_admin_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `administrators`:
--

--
-- Déchargement des données de la table `administrators`
--

INSERT INTO `administrators` (`admin_id`, `username`, `passwordd`, `other_admin_details`) VALUES
(220213, 'Mboup', 'juin123', NULL),
(220214, 'Dione', 'juin123', NULL),
(220215, 'Guissé', 'juin123', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `domains`
--

CREATE TABLE `domains` (
  `domain_id` int(11) NOT NULL,
  `domain_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `domains`:
--

--
-- Déchargement des données de la table `domains`
--

INSERT INTO `domains` (`domain_id`, `domain_name`) VALUES
(1, 'Informatique'),
(2, 'Markeeting'),
(3, 'Agriculture');

-- --------------------------------------------------------

--
-- Structure de la table `memories`
--

CREATE TABLE `memories` (
  `memo_id` int(11) NOT NULL,
  `memo_title` varchar(100) NOT NULL,
  `memo_description` text DEFAULT NULL,
  `theme_id` int(11) NOT NULL,
  `domain_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `memories`:
--   `theme_id`
--       `themes` -> `theme_id`
--   `user_id`
--       `users` -> `user_id`
--

--
-- Déchargement des données de la table `memories`
--

INSERT INTO `memories` (`memo_id`, `memo_title`, `memo_description`, `theme_id`, `domain_id`, `user_id`) VALUES
(9, 'AGRIC', 'sdfghjklm', 9, 2, NULL),
(14, 'ETQEGSEG', 'ZRQEFGSRFHDGJHFK', 5, 1, NULL),
(21, 'ETQEGSEG', 'ZRQEFGSRFHDGJHFK', 5, 1, NULL),
(22, 'AGRIC', 'RYXTUCYI', 7, 2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordd` varchar(255) NOT NULL,
  `other_student_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `students`:
--

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`student_id`, `username`, `passwordd`, `other_student_details`) VALUES
(220234, 'Mara', 'juin123', NULL),
(220257, 'Adja', 'juin2003', NULL),
(220278, 'Alpha', 'juin123', NULL),
(220310, 'Docteur', 'aout2000', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `theme_id` int(11) NOT NULL,
  `theme_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `themes`:
--

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`theme_id`, `theme_name`) VALUES
(2, 'Réseaux informatiques et télécommunications'),
(3, 'Intelligence artificielle et big data'),
(4, 'Sécurité informatique'),
(5, 'La communication comme levier de fidélisation de l'),
(6, 'Marketing en ligne et budget modéré'),
(7, 'Influenceurs et marketing digital'),
(8, 'Impact de l’agriculture sur la croissance économiq'),
(9, 'Durabilité et pratiques agricoles'),
(10, 'Changement climatique et adaptation agricole');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passwordd` varchar(255) NOT NULL,
  `user_type` enum('admin','student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONS POUR LA TABLE `users`:
--

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `passwordd`, `user_type`) VALUES
(220213, 'Mboup', 'juin123', 'admin'),
(220214, 'Dione', 'juin123', 'admin'),
(220234, 'Mara', 'juin123', 'student'),
(220257, 'Adja', 'juin2003', 'student'),
(220278, 'Alpha', 'juin123', 'student'),
(220310, 'Docteur', 'aout2000', 'student'),
(220312, 'Guissé', '$2y$10$L.kO1KC7IHFOmBuswnH1neDRfjnohCSaSoy6a4RCEamduKh4Mn.pW', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `domains`
--
ALTER TABLE `domains`
  ADD PRIMARY KEY (`domain_id`);

--
-- Index pour la table `memories`
--
ALTER TABLE `memories`
  ADD PRIMARY KEY (`memo_id`),
  ADD KEY `theme_id` (`theme_id`),
  ADD KEY `domain_id` (`domain_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`theme_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220216;

--
-- AUTO_INCREMENT pour la table `domains`
--
ALTER TABLE `domains`
  MODIFY `domain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `memories`
--
ALTER TABLE `memories`
  MODIFY `memo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220311;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `theme_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220313;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `memories`
--
ALTER TABLE `memories`
  ADD CONSTRAINT `memories_ibfk_1` FOREIGN KEY (`theme_id`) REFERENCES `themes` (`theme_id`),
  ADD CONSTRAINT `memories_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);


--
-- Métadonnées
--
USE `phpmyadmin`;

--
-- Métadonnées pour la table administrators
--

--
-- Métadonnées pour la table domains
--

--
-- Métadonnées pour la table memories
--

--
-- Métadonnées pour la table students
--

--
-- Métadonnées pour la table themes
--

--
-- Métadonnées pour la table users
--

--
-- Déchargement des données de la table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'examphp', 'users', '{\"sorted_col\":\"`users`.`user_type` DESC\"}', '2024-03-13 22:46:45');

--
-- Métadonnées pour la base de données examphp
--

--
-- Déchargement des données de la table `pma__bookmark`
--

INSERT INTO `pma__bookmark` (`dbase`, `user`, `label`, `query`) VALUES
('examphp', 'root', 'Adja', 'SELECT * FROM `users`'),
('examphp', 'root', 'Adja', 'SELECT * FROM `users`;'),
('examphp', 'root', '1', 'SELECT * FROM `users`'),
('examphp', 'root', '2', 'SELECT * FROM `users`'),
('examphp', 'root', '6', 'SELECT * FROM `administrators`'),
('examphp', 'root', '6', 'SELECT * FROM `administrators`'),
('examphp', 'root', '7', 'SELECT * FROM `administrators`');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
