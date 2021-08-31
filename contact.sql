-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 21 juin 2021 à 13:09
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `contact`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone1` varchar(50) NOT NULL,
  `telephone2` varchar(50) NOT NULL,
  `emailPersonnel` varchar(70) NOT NULL,
  `emailProfessionnel` varchar(70) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `genre` varchar(10) NOT NULL,
  `photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `nom`, `prenom`, `telephone1`, `telephone2`, `emailPersonnel`, `emailProfessionnel`, `adresse`, `genre`, `photo`) VALUES
(39, 'Salim', 'Ahmed', '1234567567', '123456789', 'ahmedsalim@gmail.com', 'salim.ahmed@etu.uae.ac.ma', 'Imzouren', 'homme', 'photo_73256786342021_06_12_14_23_31_000000image4.jpg'),
(40, 'Salmane', 'Nomane', '002693406121', '002693610461', 'salmane@nomane.com', 'nomane.salmane@gmail.com', 'Bacha', 'homme', 'photo_34718683882021_06_12_14_25_12_000000images.jpg'),
(41, 'Fatima', 'Soidik', '00336789845', '00337543217', 'fatima@gmai.com', 'soidikfatima@yahoo.fr', 'Lyon', 'femme', 'photo_70497086992021_06_12_14_26_34_000000téléchargement.jpg'),
(42, 'Khadija', 'Khouylid', '123456789', '987654321', 'khadkh@gmail.com', 'khouaylidkhadija@gmail.fr', 'reims', 'femme', 'photo_28035485362021_06_12_14_28_18_000000image1.jpg'),
(43, 'Mohamed', 'Akil', '5555555555554', '54321678', 'akilmohamed@gmail.com', 'mohamed.akil@gmail.fr', 'boukidan', 'homme', 'photo_62730872182021_06_12_15_13_57_000000image6.jpg'),
(44, 'Salma', 'Ali', '0987654', '34567789', 'salma@ali.com', 'alisalma@gmail.com', 'haySalam', 'femme', 'photo_97144687152021_06_12_15_15_28_000000img2.jpg'),
(45, 'maryam', 'saandi', '123456789', '098765432', 'maryam1919@gmail.com', 'saandimaryam@yahoo.fr', 'HayNajah', 'femme', 'photo_28119379982021_06_12_15_45_40_000000img3.png'),
(46, 'Moussa', 'Youssouf', '44444443333', '33333333333', 'youssouf@gmail.com', 'moussa@gmail.com', 'rue Mohamed 5', 'homme', 'photo_90365750112021_06_13_12_04_47_000000image.jpg'),
(47, 'HAFSOIT', 'SAID', '55555555555554', '4444444444445', 'hafsoitsaid@gmail.com', 'saidhafsoit@gmail.com', 'iconi', 'femme', 'photo_73226763722021_06_13_12_06_33_000000portrait.jpg'),
(48, 'Samira', 'Samir', '002693376121', '002693256121', 'samira@gmail.com', 'samirasmir@gmail.com', 'Casa', 'femme', 'photo_49283393812021_06_13_12_14_07_00000064770.jpg'),
(52, 'Housna', 'Housni', '002693458576', '002694458576', 'housna13@gmail.com', 'housnihousna@gmail.com', 'HousnaHouse', 'femme', 'photo_28930564772021_06_13_21_09_58_000000images.png');

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `image`) VALUES
(24, 'Famille', 'photo_48432700712021_06_13_12_07_26_000000nat3.jpg'),
(25, 'Amis', 'photo_38683090942021_06_13_12_07_41_000000amis.jpg'),
(26, 'PromoEcole', 'photo_73514025012021_06_13_12_08_06_000000image1.png'),
(27, 'AideHumanitaire', 'photo_86348133602021_06_13_12_08_30_000000nature.jpg'),
(28, 'GEE', 'photo_12274174212021_06_13_12_08_55_000000nat.jpg'),
(29, 'raappel', 'photo_24469985532021_06_13_12_09_31_000000nat2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `groupecontact`
--

CREATE TABLE `groupecontact` (
  `id` int(11) NOT NULL,
  `idContact` int(11) NOT NULL,
  `idGroupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `groupecontact`
--

INSERT INTO `groupecontact` (`id`, `idContact`, `idGroupe`) VALUES
(32, 49, 24),
(34, 40, 24),
(35, 43, 25),
(37, 39, 25),
(38, 39, 26),
(39, 48, 26),
(40, 43, 26),
(41, 42, 26),
(42, 41, 27),
(43, 46, 27),
(44, 40, 27),
(46, 45, 27),
(47, 39, 28),
(48, 41, 28),
(49, 42, 28),
(50, 44, 28),
(51, 45, 28),
(52, 49, 28),
(53, 39, 29),
(54, 40, 29),
(55, 41, 29),
(56, 42, 29),
(57, 43, 29),
(58, 44, 29),
(59, 45, 29),
(60, 46, 29),
(61, 49, 29),
(62, 48, 29),
(63, 47, 29),
(64, 39, 24),
(65, 45, 25),
(66, 52, 24),
(67, 52, 29),
(70, 55, 24),
(73, 54, 24),
(77, 48, 24),
(78, 55, 29),
(79, 55, 26),
(82, 58, 24),
(83, 42, 24);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupecontact`
--
ALTER TABLE `groupecontact`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `groupecontact`
--
ALTER TABLE `groupecontact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
