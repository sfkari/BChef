-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 mai 2024 à 18:58
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
-- Base de données : `bchef_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `blogs`
--

CREATE TABLE `blogs` (
  `id_blog` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `auteur` varchar(100) NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `blogs`
--

INSERT INTO `blogs` (`id_blog`, `titre`, `objet`, `contenu`, `auteur`, `date_creation`) VALUES
(1, 'Conseils pour réussir votre barbecue estival', 'Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.', 'Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues. Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues. Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues. Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.', 'Jeanne', '2024-04-25 09:00:00'),
(2, 'Recettes de cocktails rafraîchissants pour l\'été', 'Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.', 'Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.\r\nLe barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues. Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues. Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues. Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.', 'Pierre Martin', '2024-04-20 14:30:00'),
(3, 'Les bienfaits des légumes de saison', 'Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.', 'Les légumes de saison sont non seulement délicieux, mais ils sont également bénéfiques pour la santé. Découvrez pourquoi il est important de consommer des légumes de saison et quels sont leurs bienfaits.', 'Sophie Lambert', '2024-04-15 08:45:00'),
(4, 'Idées de recettes pour un pique-nique parfait', 'Le barbecue est un incontournable de l\'été. Voici quelques conseils pour réussir vos grillades et épater vos convives lors de vos prochains barbecues.', 'Organisez un pique-nique inoubliable avec nos idées de recettes faciles à préparer et à transporter. Des salades fraîches aux sandwiches gourmands, découvrez nos suggestions pour un repas en plein air réussi.', 'Marc Dubois', '2024-04-10 12:15:00');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL,
  `nom_utilisateur` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `id_recette`, `nom_utilisateur`, `email`, `commentaire`, `date_commentaire`) VALUES
(3, 2, 'karima', 'karima@gmail.com', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et perferendis quisquam qui, corrupti maxime enim vel, reiciendis dolores harum sed eligendi tenetur aliquam voluptate quasi expedita ad velit nihil! Explicabo.\r\n', '2024-05-03 16:49:50');

-- --------------------------------------------------------

--
-- Structure de la table `faqs`
--

CREATE TABLE `faqs` (
  `id_faq` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reponse` text NOT NULL,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `faqs`
--

INSERT INTO `faqs` (`id_faq`, `question`, `reponse`, `date_creation`) VALUES
(1, 'Qu\'est-ce que BChef ?', 'BChef est une plateforme en ligne qui permet aux utilisateurs de partager et de découvrir des recettes de cuisine.', '2024-05-04 15:30:45'),
(2, 'Comment puis-je ajouter une recette ?', 'Pour ajouter une recette, vous devez d\'abord vous inscrire sur BChef. Ensuite, vous pouvez vous connecter à votre compte et utiliser le formulaire de soumission de recette pour télécharger les détails de votre recette.', '2024-05-04 15:30:45'),
(3, 'Est-ce que BChef est gratuit ?', 'Oui, BChef est entièrement gratuit pour les utilisateurs.', '2024-05-04 15:30:45');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id_favorite` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_recette` int(11) DEFAULT NULL,
  `cote` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`id_favorite`, `id_utilisateur`, `id_recette`, `cote`) VALUES
(1, 1, 1, 0),
(2, 5, 3, 0),
(3, 3, 2, 0),
(4, 5, 2, 0),
(5, 5, 3, 0),
(6, 5, 3, 0),
(7, 5, 1, 0),
(8, 5, 1, 0),
(9, 5, 1, 0),
(10, 5, 2, 0),
(11, 5, 2, 0),
(12, 5, 2, 0),
(13, 5, 3, 0),
(14, 5, 3, 0),
(15, 5, 3, 0),
(16, 5, 1, 0),
(17, 5, 1, 0),
(18, 5, 1, 0),
(19, 5, 2, 0),
(20, 5, 2, 0),
(21, 5, 1, 0),
(22, 5, 1, 0),
(23, 5, 1, 0),
(24, 5, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nom_expediteur` varchar(255) NOT NULL,
  `email_expediteur` varchar(255) NOT NULL,
  `contenu_message` text NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `nom_expediteur`, `email_expediteur`, `contenu_message`, `date_envoi`) VALUES
(1, 'karima', 'karima@gmail.com', 'mlkjhtrsqgggfgfgf', '2024-05-04 10:58:20'),
(2, 'karima', 'karima@gmail.com', 'mlkjhtrsqgggfgfgf', '2024-05-04 10:59:44');

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id_recette` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `url_image` varchar(255) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `cree_le` timestamp NOT NULL DEFAULT current_timestamp(),
  `temps` int(11) DEFAULT NULL,
  `calorie` int(11) DEFAULT NULL,
  `difficulte` varchar(50) DEFAULT NULL,
  `note` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id_recette`, `titre`, `description`, `ingredients`, `instructions`, `url_image`, `categorie`, `cree_le`, `temps`, `calorie`, `difficulte`, `note`) VALUES
(1, 'Assiette de fruits de mer', 'Une délicieuse salade croustillante avec une vinaigrette crémeuse.', 'Laitue romaine, croûtons, parmesan, poulet grillé', '1. Laver et hacher la laitue romaine. 2. Ajouter les croûtons et le parmesan. 3. Ajouter le poulet grillé coupé en dés. 4. Verser la vinaigrette. 5. Mélanger et servir.', 'plat.png', 'Entrée', '2024-04-30 23:24:56', 46, 630, 'Moyen', 4),
(2, 'Lemon Butter', 'Un plat italien classique avec une sauce crémeuse à base de lardons et de fromage.', 'Spaghetti, lardons, œufs, parmesan, crème fraîche', '1. Cuire les pâtes al dente. 2. Faire revenir les lardons dans une poêle. 3. Mélanger les œufs, le parmesan et la crème. 4. Ajouter les pâtes cuites et mélanger.', 'plat2.png', 'Plat principal', '2024-04-30 23:24:56', 26, 500, 'Facile', 3),
(3, 'Tarte aux pommes', 'Une tarte sucrée et savoureuse avec des pommes fraîches et une croûte croustillante.', 'Pommes, sucre, cannelle, pâte brisée', '1. Éplucher et couper les pommes en tranches. 2. Disposer les pommes sur la pâte brisée. 3. Saupoudrer de sucre et de cannelle. 4. Cuire au four jusqu\'à ce que la croûte soit dorée.', 'plat3.png', 'Dessert', '2024-04-30 23:24:56', 45, 700, 'Débutant', 0),
(16, 'karima', 'kjhgfd', 'hhhhaaaaaaaaaaaaaaa', 'hgf', 'plat7.png', 'hgfd', '2024-05-02 20:02:17', 45, 7, 'Moyen', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cree_le` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','utilisateur') NOT NULL DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `mot_de_passe`, `email`, `cree_le`, `role`) VALUES
(1, 'john_doe', '$2y$10$TFYB6H20Aah.VAiKZyx5PuZq.Y4RdpDZyjE0bLILLwNhkNITZv/TK', 'john@example.com', '2024-04-30 23:25:13', 'utilisateur'),
(2, 'alice_smith', '$2y$10$9AMchy40GMhL5hj.Ledz9OnHua486L6Lib1QHkEksX9nQtq6AzCui', 'alice@example.com', '2024-04-30 23:25:13', 'utilisateur'),
(3, 'bob_joness', '$2y$10$0hzQ9/0IwuY/mY4UNELNOu.F48V5Pe20lmp3x7qhY1.JCmfNin1s2', 'bob@example.com', '2024-04-30 23:25:13', 'utilisateur'),
(4, 'admin', '$2y$10$brSc4T16enc0eqzUakhwV.FSczTzfa2H1AhVdEDA3xIwIfpbD4FKG', 'admin@example.com', '2024-05-01 12:13:29', 'admin'),
(5, 'user1', '$2y$10$IvBEstmFvpYob5B5WzYnlegZInDDPOU1QYAg/ILkWQi46jOF6Lzry', 'user1@example.com', '2024-05-01 12:13:29', 'utilisateur'),
(14, 'karima', '$2y$10$mLXslhN/w3DET9Oxh/Q.iu755fW8m/IraXF/H/z.Q6aRtN/G2CNF6', 'karima@gmail.com', '2024-05-05 15:08:42', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id_blog`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_recette` (`id_recette`);

--
-- Index pour la table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id_faq`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id_favorite`),
  ADD KEY `fk_recette_id` (`id_recette`),
  ADD KEY `nouvelle_contrainte_ibfk_1` (`id_utilisateur`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id_recette`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id_faq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id_favorite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id_recette` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id_recette`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_ibfk_2` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id_recette`),
  ADD CONSTRAINT `fk_recette_id` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id_recette`) ON DELETE CASCADE,
  ADD CONSTRAINT `nouvelle_contrainte_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
