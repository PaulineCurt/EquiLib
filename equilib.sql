-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 18 mai 2023 à 14:39
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `equilib`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(2, 'admin@admin.fr', '$2y$10$k86aZ4VY5lo9Xl7IZyqpPuKzZRTFOLxxs9g8w9VW0yKeV65uxaJwy');

-- --------------------------------------------------------

--
-- Structure de la table `appointment`
--

CREATE TABLE `appointment` (
  `ID` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_id` int NOT NULL,
  `patient_id` int NOT NULL,
  `professionnal_id` int NOT NULL,
  `date` date NOT NULL,
  `hours` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `appointment`
--

INSERT INTO `appointment` (`ID`, `message`, `status_id`, `patient_id`, `professionnal_id`, `date`, `hours`) VALUES
(29, 'iugiug', 2, 46, 9, '2023-06-01', '12:00:00'),
(31, 'Hello', 2, 46, 9, '2023-05-19', '12:30:00'),
(32, 'Bonjour', 2, 46, 10, '2023-05-20', '12:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `breed`
--

CREATE TABLE `breed` (
  `id` int NOT NULL,
  `breed_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `breed`
--

INSERT INTO `breed` (`id`, `breed_name`) VALUES
(1, 'Akhal-Teke'),
(2, 'Anglo-Arabe'),
(3, 'Appaloosa'),
(4, 'Arabe'),
(5, 'Arabo-frison'),
(6, 'Barbe'),
(7, 'Boulonnais'),
(8, 'Camarillo White'),
(9, 'Clydesdale'),
(10, 'Connemara'),
(11, 'Criollo'),
(12, 'Demi-sang arabe'),
(13, 'Espagnol'),
(14, 'Fjord'),
(15, 'Frison'),
(16, 'Gypsy Cob'),
(17, 'Hanovrien'),
(18, 'Holsteiner'),
(19, 'Irish Cob'),
(20, 'Knabstrup'),
(21, 'Lipizzan'),
(22, 'Lusitanien'),
(23, 'Morgan'),
(24, 'Mustang'),
(25, 'Oldenbourg'),
(26, 'Paint Horse'),
(27, 'Percheron'),
(28, 'Poney français de selle'),
(29, 'Pottok'),
(30, 'Pur-sang'),
(31, 'Pur-sang anglais'),
(32, 'Quarter Horse'),
(33, 'Selle français'),
(34, 'Shetland'),
(35, 'Shire'),
(36, 'Tennessee Walker'),
(37, 'Trotteur français'),
(38, 'Welsh Cob'),
(39, 'Westphalien'),
(40, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `horse`
--

CREATE TABLE `horse` (
  `id_horse` int NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `breed_id` int NOT NULL,
  `age` int NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `patient_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `horse`
--

INSERT INTO `horse` (`id_horse`, `name`, `breed_id`, `age`, `image`, `description`, `patient_id`) VALUES
(1, 'Nom du cheval', 1, 7, '', 'Description du cheval', 46),
(28, 'Jelyson', 10, 1, 'horseea3de3c04abf97b1bcf72e5b7cecf7c7242bd9a3.jpg', 'cc', 46),
(29, 'coucou', 8, 1, NULL, '', 46),
(30, 'Coco', 37, 1, '72082e47674e7d7cf58f1fa4383d31dae204c3a60cfd71a1c1928a6d5a2243.jpg', '2454', 46);

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phoneNumber` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`id_patient`, `firstname`, `lastname`, `email`, `address`, `phoneNumber`, `password`) VALUES
(46, 'Pauline', 'Curt', 'curtpauline@gmail.com', '3 rue kikoulol', '0123456789', '$2y$10$3P7uxpTCvtizMomsiyRVE.5gMACSBMmgnNGVtzVUmZex3xiLsDule'),
(48, 'Mélodie', 'Janvier', 'melodiejanvier@gmail.com', '3 rue du love', '0707070707', '$2y$10$qn5Rdu1or3Xo22s/jui/Be8LyBYAuLNAyvqfxUoRl12jvNtGTq2pG'),
(54, 'toto', 'toto', 'toto@toto.com', 'coucou', '0707070707', '$2y$10$JCTGaeTkFC4QwEAqJCkkTepUkSxq68VhVOEyslBFQEWDlrPSwvATq');

-- --------------------------------------------------------

--
-- Structure de la table `professionnal`
--

CREATE TABLE `professionnal` (
  `id_professionnal` int NOT NULL,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `postalCode` int NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `speciality` int NOT NULL,
  `veterinaryNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phoneNumber` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `professionnal`
--

INSERT INTO `professionnal` (`id_professionnal`, `firstname`, `lastname`, `email`, `postalCode`, `city`, `address`, `password`, `speciality`, `veterinaryNumber`, `phoneNumber`) VALUES
(9, 'Michel', 'Cheval', 'michelcheval@gmail.com', 0, '', '3 rue kikoulol', '$2y$10$brDGh.uNF6169nxEouXqt.jBSkrNf.plo31l3YYMGv0RVjfnZViia', 5, '12345', '0123456789'),
(10, 'Mélodie', 'Janvier', 'curtpauline@gmail.com', 13100, 'AIX EN PROVENCE', '3 rue du love', '$2y$10$viejodn3CYIgvrK0v8Hef.buZp2OWvEO2uIr3HEmMRSqJmcLoiD0G', 5, '12321', '0707070707');

-- --------------------------------------------------------

--
-- Structure de la table `speciality`
--

CREATE TABLE `speciality` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `speciality`
--

INSERT INTO `speciality` (`id`, `name`) VALUES
(1, 'Pathologie locomotrice (muscles et squelette)'),
(2, 'Médecine interne (appareil respiratoire, cœur…)'),
(3, 'Pathologie infectieuse (maladies dues à des virus, bactéries)'),
(4, 'Gynécologie (échographie, suivi des chaleurs, insémination…)'),
(5, 'Chirurgie (castration, plaies, fractures, coliques…)'),
(6, 'Dentisterie'),
(7, 'Ophtalmologie'),
(8, 'Médecine alternative (acupuncture, ostéopathie, phytothérapie, physiothérapie)'),
(9, 'Nutrition');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`id`, `status`) VALUES
(1, 'Confirmé'),
(2, 'En attente'),
(5, 'Annulé');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `professionnel_id` (`professionnal_id`),
  ADD KEY `fk_patient_id` (`patient_id`);

--
-- Index pour la table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `horse`
--
ALTER TABLE `horse`
  ADD PRIMARY KEY (`id_horse`),
  ADD KEY `breed_id` (`breed_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `professionnal`
--
ALTER TABLE `professionnal`
  ADD PRIMARY KEY (`id_professionnal`),
  ADD UNIQUE KEY `veterinaryNumber` (`veterinaryNumber`),
  ADD KEY `fk_professionnel_speciality` (`speciality`);

--
-- Index pour la table `speciality`
--
ALTER TABLE `speciality`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `horse`
--
ALTER TABLE `horse`
  MODIFY `id_horse` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `professionnal`
--
ALTER TABLE `professionnal`
  MODIFY `id_professionnal` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `speciality`
--
ALTER TABLE `speciality`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_patient_id` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`id_patient`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_professionnel_id` FOREIGN KEY (`professionnal_id`) REFERENCES `professionnal` (`id_professionnal`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `horse`
--
ALTER TABLE `horse`
  ADD CONSTRAINT `horse_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `breed` (`id`);

--
-- Contraintes pour la table `professionnal`
--
ALTER TABLE `professionnal`
  ADD CONSTRAINT `fk_professionnel_speciality` FOREIGN KEY (`speciality`) REFERENCES `speciality` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
