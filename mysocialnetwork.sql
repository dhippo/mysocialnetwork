-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 27 mars 2023 à 17:12
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mysocialnetwork`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `archived_notifications`
--

CREATE TABLE `archived_notifications` (
  `id_archived_notification` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id_request` int(11) NOT NULL,
  `request_date` datetime NOT NULL,
  `status` enum('accepted','refused','pending') NOT NULL,
  `inviter_user_id` int(11) NOT NULL,
  `invited_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id_message` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `sent_at` datetime NOT NULL,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `points_of_interest`
--

CREATE TABLE `points_of_interest` (
  `id_poi` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `inside_school` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `creator_email` varchar(80) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) DEFAULT NULL,
  `category` enum('event','news','other') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `visibility` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id_post`, `creator_email`, `title`, `image`, `content`, `likes`, `dislikes`, `url`, `category`, `created_at`, `updated_at`, `visibility`) VALUES
(1, 'professor@edu.ece.fr', 'Nouvelle formation en Intelligence Artificielle', NULL, 'L\'école propose une nouvelle formation en intelligence artificielle à partir de la rentrée prochaine. Cette formation couvrira les dernières avancées dans le domaine de l\'IA et préparera les étudiants à des carrières dans ce domaine en croissance.', 0, 0, NULL, 'event', '2023-03-27 17:07:18', NULL, 'public'),
(2, 'event@omneseducation.com', 'Hackathon organisé par l\'association de sécurité informatique', NULL, 'L\'association de sécurité informatique organise un hackathon de 24 heures pour les étudiants de l\'école. Le hackathon portera sur la sécurité informatique et les gagnants auront l\'opportunité de travailler sur des projets avec des professionnels de la sécurité informatique.', 0, 0, NULL, 'event', '2023-03-27 17:07:18', NULL, 'public'),
(3, 'student1@ece.fr', 'Nouvelle application de sécurité développée par les étudiants', NULL, 'Un groupe d\'étudiants de l\'école a développé une nouvelle application de sécurité pour protéger les utilisateurs en ligne. L\'application a été présentée à un panel de professionnels de la sécurité informatique et a reçu des critiques positives.', 0, 0, NULL, 'news', '2023-03-27 17:07:18', NULL, 'public'),
(4, 'admin@ece.fr', 'Changement de programme d\'études', NULL, 'Le programme d\'études de l\'école va subir des changements importants à partir de la rentrée prochaine. Les étudiants auront la possibilité de choisir entre des cours avancés en intelligence artificielle, développement web et objets connectés.', 0, 0, NULL, 'news', '2023-03-27 17:07:18', NULL, 'public'),
(5, 'professor2@edu.ece.fr', 'Conférence sur la cyber sécurité', NULL, 'Le professeur de cyber sécurité organisera une conférence pour les étudiants de l\'école sur les dernières menaces en matière de sécurité informatique et les moyens de s\'en protéger. La conférence aura lieu dans deux semaines.', 0, 0, NULL, 'event', '2023-03-27 17:07:18', NULL, 'public'),
(6, 'researcher@ece.fr', 'Nouvelle collaboration de recherche en cybersécurité', NULL, 'L\'école a établi une nouvelle collaboration de recherche avec une entreprise de cybersécurité de renom. Cette collaboration permettra aux étudiants et aux chercheurs de l\'école de travailler sur des projets de recherche en cybersécurité innovants et pertinents.', 0, 0, NULL, 'news', '2023-03-25 10:00:00', NULL, 'public'),
(7, 'association@ece.fr', 'Conférence sur les objets connectés', NULL, 'L\'association étudiante d\'objets connectés organise une conférence pour les étudiants de l\'école sur les dernières tendances en matière d\'objets connectés et les perspectives d\'avenir. La conférence aura lieu la semaine prochaine.', 0, 0, NULL, 'event', '2023-03-26 14:00:00', NULL, 'public'),
(8, 'professor2@edu.ece.fr', 'Nouvelle formation en développement web', NULL, 'L\'école propose une nouvelle formation en développement web qui couvrira les dernières tendances en matière de développement web. Les étudiants auront l\'opportunité de travailler sur des projets concrets en développement web et de développer des compétences en demandes sur le marché du travail.', 0, 0, NULL, 'event', '2023-03-27 11:00:00', NULL, 'public'),
(9, 'event2@omneseducation.com', 'Événement de networking pour les étudiants et les professionnels', NULL, 'L\'école organise un événement de networking pour les étudiants et les professionnels du domaine du numérique. Les étudiants auront l\'opportunité de rencontrer des professionnels de l\'industrie et de se connecter avec eux pour des opportunités professionnelles futures.', 0, 0, NULL, 'event', '2023-03-28 15:00:00', NULL, 'public');

-- --------------------------------------------------------

--
-- Structure de la table `post_dislikes`
--

CREATE TABLE `post_dislikes` (
  `id_dislike` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `post_likes`
--

CREATE TABLE `post_likes` (
  `id_like` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `post_mentions`
--

CREATE TABLE `post_mentions` (
  `id_mention` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `promo` varchar(50) NOT NULL,
  `statut` varchar(25) NOT NULL,
  `bio` text NOT NULL,
  `birth_date` date NOT NULL,
  `profile_picture` varchar(50) NOT NULL,
  `interests` varchar(255) NOT NULL,
  `validated` tinyint(1) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `first_name`, `last_name`, `promo`, `statut`, `bio`, `birth_date`, `profile_picture`, `interests`, `validated`, `is_blocked`) VALUES
(1, 'test@test', 'test', 'test', 'test', 'test', 'test', 'test', '1111-12-12', 'test', 'test', 0, 0),
(2, 'azerty@azerty', '$2y$10$71XMH2dyr9FSzuASeDW...iwDUc6ccSlu4RaLVc6t2s7LHR9rZyGG', 'azerty', 'azerty', 'azerty', 'azerty', 'azerty', '1222-12-12', 'azerty', 'azerty', 0, 0),
(3, 'aqwzsx@aqwzsx', '$2y$10$3j9G96o5WLUlZ12Y3KDJluReet1isepqhVTnUHgrXOfZdOWuNVI1K', 'aqwzsx', 'aqwzsx', 'aqwzsx', 'aqwzsx', 'aqwzsx', '1212-12-12', 'aqwzsx', 'aqwzsx', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `archived_notifications`
--
ALTER TABLE `archived_notifications`
  ADD PRIMARY KEY (`id_archived_notification`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `inviter_user_id` (`inviter_user_id`),
  ADD KEY `invited_user_id` (`invited_user_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `points_of_interest`
--
ALTER TABLE `points_of_interest`
  ADD PRIMARY KEY (`id_poi`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`);

--
-- Index pour la table `post_dislikes`
--
ALTER TABLE `post_dislikes`
  ADD PRIMARY KEY (`id_dislike`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `post_mentions`
--
ALTER TABLE `post_mentions`
  ADD PRIMARY KEY (`id_mention`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `archived_notifications`
--
ALTER TABLE `archived_notifications`
  MODIFY `id_archived_notification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `points_of_interest`
--
ALTER TABLE `points_of_interest`
  MODIFY `id_poi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `post_dislikes`
--
ALTER TABLE `post_dislikes`
  MODIFY `id_dislike` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `post_mentions`
--
ALTER TABLE `post_mentions`
  MODIFY `id_mention` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `archived_notifications`
--
ALTER TABLE `archived_notifications`
  ADD CONSTRAINT `archived_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `friend_requests_ibfk_1` FOREIGN KEY (`inviter_user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friend_requests_ibfk_2` FOREIGN KEY (`invited_user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post_dislikes`
--
ALTER TABLE `post_dislikes`
  ADD CONSTRAINT `post_dislikes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_dislikes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `post_mentions`
--
ALTER TABLE `post_mentions`
  ADD CONSTRAINT `post_mentions_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_mentions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
