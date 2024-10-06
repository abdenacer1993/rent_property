-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 24 avr. 2024 à 05:06
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `rent_property`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `annonceID` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateurID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `categorie` varchar(15) NOT NULL,
  `taille` varchar(6) NOT NULL,
  `chambre` int(11) NOT NULL,
  `salle_bain` int(11) NOT NULL,
  `prix` float NOT NULL,
  `description` text NOT NULL,
  `nom_prenom` varchar(60) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `image` text NOT NULL,
  `etat` varchar(10) NOT NULL,
  `date_publication` varchar(20) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  PRIMARY KEY (`annonceID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`annonceID`, `utilisateurID`, `title`, `categorie`, `taille`, `chambre`, `salle_bain`, `prix`, `description`, `nom_prenom`, `email`, `telephone`, `image`, `etat`, `date_publication`, `adresse`) VALUES
(4, 1, 'house for rent ', 'House', '300', 3, 1, 800, 'rental house with 3 bedrooms and bathroom, price of the house 700 Tunisian dinars. In tunisia', 'admin  elhem', 'elhem@admin.com', '21345600', '65ed1c11c3d46-1710038033.jpeg', 'Refuse', '2024-03-10 23:26:01', 'tunis'),
(7, 1, 'house for student', 'Student housing', '300', 3, 1, 300, 'house for student ,3 bedromms and bathroom.In gafsa', 'admin  elhem', 'elhem@admin.com', '21345600', '65eddc66eccf6-1710087270.jpeg', 'Accept', '2024-03-10 23:24:04', 'gafsa'),
(9, 10, 'Secluded Forest Retreat: 2-Bedroom House for Rent', 'House', '300', 2, 1, 750, 'Escape the hustle and bustle of city life and immerse yourself in the tranquility of nature with this charming 2-bedroom house nestled within a pristine forest setting. Located amidst towering trees and lush greenery, this rental offers a unique opportunity to experience the serene beauty of the wilderness while enjoying modern comforts.\r\n\r\nInterior Features:\r\nUpon entering, you\'re greeted by a cozy living space adorned with rustic furnishings and large windows that frame picturesque views of the surrounding forest. The open floor plan seamlessly connects the living area to the fully-equipped kitchen, where you can prepare delicious meals using fresh ingredients sourced locally.\r\n\r\nThe house boasts two inviting bedrooms, each thoughtfully decorated to create a warm and inviting atmosphere. Soft linens, plush pillows, and ample storage space ensure a comfortable stay for guests. A well-appointed bathroom provides all the necessary amenities, including a refreshing shower, ensuring convenience and relaxation during your stay.\r\n\r\nOutdoor Oasis:\r\nStep outside onto the spacious deck and breathe in the crisp, clean air as you take in the sights and sounds of nature. Surrounded by towering trees and the gentle rustle of leaves, the deck offers the perfect spot for morning coffee or al fresco dining amidst the beauty of the forest.\r\n\r\nExplore the sprawling grounds, where winding pathways lead to hidden alcoves and serene spots ideal for meditation or simply unwinding in nature\'s embrace. Whether you\'re seeking adventure or a peaceful retreat, the forested landscape provides endless opportunities for exploration and relaxation.\r\n\r\nAmenities:\r\n\r\n    Fully-equipped kitchen\r\n    Comfortable living area with scenic views\r\n    Two cozy bedrooms with ample storage space\r\n    Well-appointed bathroom with shower\r\n    Spacious deck for outdoor enjoyment\r\n    Access to hiking trails and natural attractions\r\n\r\nLocation:\r\nTucked away in a secluded corner of the forest, this rental offers unparalleled privacy and tranquility, allowing you to disconnect from the stresses of everyday life and reconnect with nature. Despite its secluded location, the house is just a short drive away from nearby amenities, including shops, restaurants, and recreational activities.\r\n\r\nExperience the Magic of the Forest:\r\nWhether you\'re seeking a romantic getaway, a family adventure, or a solo retreat, this charming 2-bedroom house offers the perfect blend of comfort and nature. Escape to the forest and create unforgettable memories in this enchanting retreat. Book your stay today and embark on a journey of relaxation and rejuvenation amidst the beauty of the wilderness. In mtlaoui', 'abdenacer hasnaoui', 'abdenacer1993@gmail.com', '24587616', '65f5e3c3eb432-1710613443.jpg', 'Accept', '2024-03-16 18:24:03', 'metlaoui'),
(10, 2, 'apartment at Gafsa', 'Apartment', '250', 2, 1, 300, 'apartment at Gafsa with 2 bedroom and bathrooms price 300dt', 'admin2 admin2', 'admin2@admin.com', '12345678', '661f0a4aad9a1-1713310282.jpg', 'Accept', '2024-04-16 23:31:22', 'Gafsa'),
(11, 8, 'test', 'House', '123', 1, 1, 222, 'test', 'elhem elhem', 'elhem1@gmail.com', '23456789', '661f12e355a7c-1713312483.jpg', 'pending', '2024-04-17 00:11:47', 'tunis'),
(19, 10, 'nacer maison', 'House', '140', 2, 1, 2000, 'maison nacer', 'Abdenacer Hasnaoui', 'abdenacer1993@gmail.com', '24587616', '662889ef0707e-1713932783.webp', 'Accept', '2024-04-24 04:26:23', 'suisse'),
(13, 8, 'test test', 'House', '12', 1, 1, 123, 'tetetetetettets', 'elhem elhem', 'elhem1@gmail.com', '23456789', '661f164cd6924-1713313356.jpg', 'Accept', '2024-04-17 00:22:36', 'Gafsa'),
(17, 1, 'testAZAZ', 'House', '200', 2, 1, 700, 'testt', 'elhem   elhem', 'elhem@admin.com', '24587616', '6628715bebe65-1713926491.jpg', 'Refuse', '2024-04-24 02:41:31', 'Gafsa'),
(18, 1, 'testAZAZ', 'House', '200', 2, 1, 700, 'testt', 'elhem   elhem', 'elhem@admin.com', '24587616', '6628729841a92-1713926808.jpg', 'Accept', '2024-04-24 02:46:48', 'Gafsa');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `avisID` int(11) NOT NULL AUTO_INCREMENT,
  `annonceID` int(11) NOT NULL,
  `date` varchar(22) NOT NULL,
  `text` text NOT NULL,
  `utilisateurID` int(11) NOT NULL,
  `nom_prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `lu` int(11) NOT NULL,
  PRIMARY KEY (`avisID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`avisID`, `annonceID`, `date`, `text`, `utilisateurID`, `nom_prenom`, `email`, `lu`) VALUES
(1, 9, '2024-03-12 14:05:37', 'trtrtr', 10, 'admin  elhem', 'elhem@admin.com', 1),
(9, 18, '2024-04-24 04:22:00', 'yes yes', 10, 'Hasnaoui Abdenacer', 'abdenacer1993@gmail.com', 0),
(3, 7, '2024-03-18 07:21:29', 'test id 7', 10, 'hasnaoui abdenacer', 'abdenacer1993@gmail.com', 0),
(4, 7, '2024-03-18 07:22:28', 'test 2', 10, 'hasnaoui abdenacer', 'abdenacer1993@gmail.com', 1),
(5, 7, '2024-03-18 07:31:07', 'test 3', 10, 'hasnaoui abdenacer', 'abdenacer1993@gmail.com', 0),
(6, 9, '2024-03-18 09:18:54', 'great', 11, 'aziz aziz', 'aziz@gmail.com', 1),
(7, 9, '2024-03-18 12:37:35', 'great house please price ?', 11, 'aziz aziz', 'aziz@gmail.com', 0),
(8, 13, '2024-04-17 01:59:08', 'I like it ', 12, 'aziz aziz', 'aziz@gmail.com', 1),
(10, 19, '2024-04-24 04:50:49', 'test', 13, 'abdenacer abdenacer', 'abdenacer1@gmail.com', 0),
(11, 19, '2024-04-24 04:51:13', 'abdenacer', 13, 'abdenacer abdenacer', 'abdenacer1@gmail.com', 0);

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `contactID` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sujet` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `lu` int(11) NOT NULL,
  `lu_par` varchar(200) NOT NULL,
  PRIMARY KEY (`contactID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`contactID`, `nom_prenom`, `email`, `sujet`, `msg`, `date`, `lu`, `lu_par`) VALUES
(1, 'admin  elhem', 'elhem@admin.com', 'test', 'test test test test', '2024-03-11 14:08:13', 1, 'Readed by admin  elhem ,mail:elhem@admin.com'),
(2, 'admin  elhem', 'elhem@admin.com', 'problem', 'just for test deleted', '2024-03-11 15:26:13', 1, 'Readed by admin  elhem ,mail:elhem@admin.com'),
(3, 'admin  elhem', 'elhem@admin.com', 'testtttt', 'testttttt', '2024-03-11 15:30:29', 1, 'Readed by admin  elhem ,mail:elhem@admin.com'),
(6, 'elhem   elhem', 'elhem@admin.com', 'problem', 'test problm', '2024-04-24 03:23:52', 1, 'lu par elhem   elhem ,email:elhem@admin.com'),
(7, 'Abdenacer Hasnaoui', 'abdenacer1993@gmail.com', 'test', 'test', '2024-04-24 05:04:47', 0, 'No one');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `demandeID` int(11) NOT NULL AUTO_INCREMENT,
  `annonceID` int(11) NOT NULL,
  `locataireID` int(11) NOT NULL,
  `properietaireID` int(11) NOT NULL,
  `nom_prenom` varchar(50) NOT NULL,
  `telephone` varchar(14) NOT NULL,
  `etat` varchar(14) NOT NULL,
  `date_demande` varchar(23) NOT NULL,
  `date_entrer` varchar(22) NOT NULL,
  `date_sortier` varchar(22) NOT NULL,
  PRIMARY KEY (`demandeID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`demandeID`, `annonceID`, `locataireID`, `properietaireID`, `nom_prenom`, `telephone`, `etat`, `date_demande`, `date_entrer`, `date_sortier`) VALUES
(2, 9, 11, 10, 'aziz aziz', '24587616', 'Accepted', '2024-03-18 10:30:51', '2024-03-18', '2024-04-01'),
(4, 7, 11, 1, 'aziz aziz', '24587616', 'Pending', '2024-03-18 12:28:13', '2024-03-21', '2024-03-28'),
(7, 8, 5, 10, 'elhem elhem', '23456789', 'Pending', '2024-04-20 21:58:15', '2024-04-27', '2024-04-24'),
(6, 13, 12, 8, 'aziz aziz', '24587616', 'Accepted', '2024-04-17 02:16:15', '2024-04-17', '2024-04-18'),
(8, 19, 13, 10, 'abdenacer abdenacer', '23122312', 'Accepted', '2024-04-24 04:59:29', '2024-04-24', '2024-05-02');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `imagesID` int(11) NOT NULL AUTO_INCREMENT,
  `annonceId` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `categorie` varchar(100) NOT NULL,
  `urlImages` text NOT NULL,
  `date` varchar(24) NOT NULL,
  PRIMARY KEY (`imagesID`)
) ENGINE=MyISAM AUTO_INCREMENT=135 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`imagesID`, `annonceId`, `title`, `categorie`, `urlImages`, `date`) VALUES
(1, 7, 'house for student', 'Student housing', '65f1018f73ef7-1710293391.jpg', '2024-03-13 01:29:51'),
(2, 7, 'house for student', 'Student housing', '65f1018f764c9-1710293391.jpg', '2024-03-13 01:29:51'),
(3, 7, 'house for student', 'Student housing', '65f1018f77961-1710293391.webp', '2024-03-13 01:29:51'),
(4, 7, 'house for student', 'Student housing', '65f1018f7ad98-1710293391.jpeg', '2024-03-13 01:29:51'),
(5, 4, 'house for rent ', 'House', '65f1049d9e7e7-1710294173.jpg', '2024-03-13 01:42:53'),
(6, 4, 'house for rent ', 'House', '65f1049da0926-1710294173.jpg', '2024-03-13 01:42:53'),
(7, 4, 'house for rent ', 'House', '65f1049da1171-1710294173.webp', '2024-03-13 01:42:53'),
(8, 4, 'house for rent ', 'House', '65f1049da1d47-1710294173.jpeg', '2024-03-13 01:42:53'),
(9, 4, 'house for rent ', 'House', '65f1049da7b8b-1710294173.jpg', '2024-03-13 01:42:53'),
(10, 8, 'house for rent', 'House', '65f27e8833823-1710390920.jpg', '2024-03-14 04:35:20'),
(11, 8, 'house for rent', 'House', '65f27e883403d-1710390920.jpg', '2024-03-14 04:35:20'),
(12, 8, 'house for rent', 'House', '65f27e8834692-1710390920.webp', '2024-03-14 04:35:20'),
(13, 8, 'house for rent', 'House', '65f27e8834f6c-1710390920.jpeg', '2024-03-14 04:35:20'),
(14, 9, 'house for rent', 'House', '65f5c9dd56702-1710606813.jpg', '2024-03-16 16:33:33'),
(15, 9, 'house for rent', 'House', '65f5c9dd57571-1710606813.jpg', '2024-03-16 16:33:33'),
(16, 9, 'house for rent', 'House', '65f5c9dd580bb-1710606813.jpg', '2024-03-16 16:33:33'),
(17, 9, 'house for rent', 'House', '65f5c9dd58a49-1710606813.jpg', '2024-03-16 16:33:33'),
(18, 9, 'house for rent', 'House', '65f5c9dd592f7-1710606813.jpg', '2024-03-16 16:33:33'),
(19, 9, 'house for rent', 'House', '65f5c9dd59a52-1710606813.jpg', '2024-03-16 16:33:33'),
(20, 9, 'house for rent', 'House', '65f5c9dd5a130-1710606813.jpg', '2024-03-16 16:33:33'),
(21, 9, 'house for rent', 'House', '65f5c9dd5a80e-1710606813.jpg', '2024-03-16 16:33:33'),
(89, 14, 'test 22/04/2024', 'Apartment', '66267fd7b414f-1713799127.jpg', '2024-04-22 15:18:47'),
(88, 12, 'test test', 'House', '661f198f0e5e3-1713314191.jpg', '2024-04-17 00:36:31'),
(87, 12, 'test test', 'House', '661f198f0df82-1713314191.jpg', '2024-04-17 00:36:31'),
(86, 12, 'test test', 'House', '661f198f0d945-1713314191.jpg', '2024-04-17 00:36:31'),
(85, 12, 'test test', 'House', '661f198f0cfae-1713314191.webp', '2024-04-17 00:36:31'),
(84, 12, 'test test', 'House', '661f198f0c93d-1713314191.jpg', '2024-04-17 00:36:31'),
(83, 12, 'test test', 'House', '661f198f0c143-1713314191.jpg', '2024-04-17 00:36:31'),
(37, 13, 'test test', 'House', '661f16609809c-1713313376.jpg', '2024-04-17 00:22:56'),
(38, 13, 'test test', 'House', '661f166098768-1713313376.jpg', '2024-04-17 00:22:56'),
(39, 13, 'test test', 'House', '661f166099910-1713313376.webp', '2024-04-17 00:22:56'),
(40, 13, 'test test', 'House', '661f16609a323-1713313376.jpg', '2024-04-17 00:22:56'),
(41, 13, 'test test', 'House', '661f16609aa0c-1713313376.jpg', '2024-04-17 00:22:56'),
(42, 13, 'test test', 'House', '661f16609b17e-1713313376.jpg', '2024-04-17 00:22:56'),
(43, 13, 'test test', 'House', '661f16609b894-1713313376.jpg', '2024-04-17 00:22:56'),
(44, 13, 'test test', 'House', '661f16609bf76-1713313376.jpg', '2024-04-17 00:22:56'),
(45, 13, 'test test', 'House', '661f16609c7ac-1713313376.jpg', '2024-04-17 00:22:56'),
(46, 13, 'test test', 'House', '661f16609cee4-1713313376.jpg', '2024-04-17 00:22:56'),
(47, 13, 'test test', 'House', '661f16609d800-1713313376.jpg', '2024-04-17 00:22:56'),
(48, 13, 'test test', 'House', '661f16609e006-1713313376.jpg', '2024-04-17 00:22:56'),
(49, 13, 'test test', 'House', '661f16609eac0-1713313376.jpeg', '2024-04-17 00:22:56'),
(50, 13, 'test test', 'House', '661f16609f276-1713313376.jpg', '2024-04-17 00:22:56'),
(51, 13, 'test test', 'House', '661f16f7f1849-1713313527.jpg', '2024-04-17 00:25:27'),
(52, 13, 'test test', 'House', '661f16f7f203e-1713313527.jpg', '2024-04-17 00:25:27'),
(53, 13, 'test test', 'House', '661f16f7f305c-1713313527.webp', '2024-04-17 00:25:27'),
(54, 13, 'test test', 'House', '661f16f7f3734-1713313527.jpg', '2024-04-17 00:25:27'),
(55, 13, 'test test', 'House', '661f16f7f3eed-1713313527.jpg', '2024-04-17 00:25:27'),
(56, 13, 'test test', 'House', '661f16f800351-1713313528.jpg', '2024-04-17 00:25:27'),
(57, 13, 'test test', 'House', '661f16f800a2a-1713313528.jpg', '2024-04-17 00:25:27'),
(58, 13, 'test test', 'House', '661f16f801280-1713313528.jpg', '2024-04-17 00:25:27'),
(59, 13, 'test test', 'House', '661f16f801942-1713313528.jpg', '2024-04-17 00:25:27'),
(60, 13, 'test test', 'House', '661f16f8022a3-1713313528.jpg', '2024-04-17 00:25:27'),
(61, 13, 'test test', 'House', '661f16f802dfa-1713313528.jpg', '2024-04-17 00:25:27'),
(62, 13, 'test test', 'House', '661f16f8038eb-1713313528.jpg', '2024-04-17 00:25:27'),
(63, 13, 'test test', 'House', '661f16f80415e-1713313528.jpeg', '2024-04-17 00:25:27'),
(64, 13, 'test test', 'House', '661f16f804994-1713313528.jpg', '2024-04-17 00:25:27'),
(65, 13, 'test test', 'House', '661f179b6ff0a-1713313691.jpg', '2024-04-17 00:28:11'),
(66, 13, 'test test', 'House', '661f179b71880-1713313691.jpg', '2024-04-17 00:28:11'),
(67, 13, 'test test', 'House', '661f179b745c0-1713313691.webp', '2024-04-17 00:28:11'),
(68, 13, 'test test', 'House', '661f179b760be-1713313691.jpg', '2024-04-17 00:28:11'),
(69, 13, 'test test', 'House', '661f179b79043-1713313691.jpg', '2024-04-17 00:28:11'),
(70, 13, 'test test', 'House', '661f179b7a384-1713313691.jpg', '2024-04-17 00:28:11'),
(71, 13, 'test test', 'House', '661f179b7be7f-1713313691.jpg', '2024-04-17 00:28:11'),
(72, 13, 'test test', 'House', '661f179b7d4af-1713313691.jpg', '2024-04-17 00:28:11'),
(73, 13, 'test test', 'House', '661f179b7eb1e-1713313691.jpg', '2024-04-17 00:28:11'),
(74, 13, 'test test', 'House', '661f179b82179-1713313691.jpg', '2024-04-17 00:28:11'),
(75, 13, 'test test', 'House', '661f179b85944-1713313691.jpg', '2024-04-17 00:28:11'),
(76, 13, 'test test', 'House', '661f179b87100-1713313691.jpg', '2024-04-17 00:28:11'),
(77, 13, 'test test', 'House', '661f179b8a980-1713313691.jpeg', '2024-04-17 00:28:11'),
(78, 13, 'test test', 'House', '661f179b8cd1c-1713313691.jpg', '2024-04-17 00:28:11'),
(79, 11, 'test', 'House', '661f18469d85b-1713313862.jpg', '2024-04-17 00:31:02'),
(80, 11, 'test', 'House', '661f18469def1-1713313862.jpg', '2024-04-17 00:31:02'),
(81, 11, 'test', 'House', '661f18469e4d3-1713313862.jpg', '2024-04-17 00:31:02'),
(82, 11, 'test', 'House', '661f1846a0713-1713313862.jpg', '2024-04-17 00:31:02'),
(90, 14, 'test 22/04/2024', 'Apartment', '66267fd7b468a-1713799127.jpg', '2024-04-22 15:18:47'),
(91, 14, 'test 22/04/2024', 'Apartment', '66267fd7b4c87-1713799127.webp', '2024-04-22 15:18:47'),
(92, 14, 'test 22/04/2024', 'Apartment', '66267fd7b54f6-1713799127.jpg', '2024-04-22 15:18:47'),
(93, 14, 'test 22/04/2024', 'Apartment', '66267fd7b5a0b-1713799127.jpg', '2024-04-22 15:18:47'),
(94, 14, 'test 22/04/2024', 'Apartment', '66267fd7b5f97-1713799127.jpg', '2024-04-22 15:18:47'),
(95, 14, 'test 22/04/2024', 'Apartment', '66267fd7b6810-1713799127.jpg', '2024-04-22 15:18:47'),
(96, 14, 'test 22/04/2024', 'Apartment', '66267fd7b6f25-1713799127.jpg', '2024-04-22 15:18:47'),
(97, 14, 'test 22/04/2024', 'Apartment', '66267fd7b765b-1713799127.jpg', '2024-04-22 15:18:47'),
(98, 14, 'test 22/04/2024', 'Apartment', '66267fd7b7f3e-1713799127.jpg', '2024-04-22 15:18:47'),
(99, 14, 'test 22/04/2024', 'Apartment', '66267fd7b8708-1713799127.jpg', '2024-04-22 15:18:47'),
(100, 14, 'test 22/04/2024', 'Apartment', '66267fd7b8e56-1713799127.jpg', '2024-04-22 15:18:47'),
(101, 14, 'test 22/04/2024', 'Apartment', '66267fd7b9558-1713799127.jpeg', '2024-04-22 15:18:47'),
(102, 14, 'test 22/04/2024', 'Apartment', '66267fd7b9ca5-1713799127.jpg', '2024-04-22 15:18:47'),
(103, 9, 'Secluded Forest Retreat: 2-Bedroom House for Rent', 'House', '662875a90778e-1713927593.jpg', '2024-04-24 02:59:53'),
(104, 9, 'Secluded Forest Retreat: 2-Bedroom House for Rent', 'House', '662875a908ec3-1713927593.jpg', '2024-04-24 02:59:53'),
(105, 9, 'Secluded Forest Retreat: 2-Bedroom House for Rent', 'House', '662875a90add1-1713927593.jpg', '2024-04-24 02:59:53'),
(106, 9, 'Secluded Forest Retreat: 2-Bedroom House for Rent', 'House', '662875a90c2c5-1713927593.jpg', '2024-04-24 02:59:53'),
(107, 18, 'testAZAZ', 'House', '66287756ed176-1713928022.jpg', '2024-04-24 03:07:02'),
(108, 18, 'testAZAZ', 'House', '66287756ed8d0-1713928022.jpg', '2024-04-24 03:07:02'),
(109, 18, 'testAZAZ', 'House', '66287756edf4a-1713928022.webp', '2024-04-24 03:07:02'),
(110, 18, 'testAZAZ', 'House', '66287756ee904-1713928022.jpg', '2024-04-24 03:07:02'),
(111, 18, 'testAZAZ', 'House', '66287756eefb3-1713928022.jpg', '2024-04-24 03:07:02'),
(112, 18, 'testAZAZ', 'House', '66287756f055d-1713928022.jpg', '2024-04-24 03:07:02'),
(113, 18, 'testAZAZ', 'House', '66287756f13bb-1713928022.jpg', '2024-04-24 03:07:02'),
(114, 18, 'testAZAZ', 'House', '66287756f1af1-1713928022.jpg', '2024-04-24 03:07:02'),
(115, 18, 'testAZAZ', 'House', '66287756f2208-1713928022.jpg', '2024-04-24 03:07:02'),
(116, 18, 'testAZAZ', 'House', '66287756f28b6-1713928022.jpg', '2024-04-24 03:07:02'),
(117, 18, 'testAZAZ', 'House', '66287756f2f64-1713928022.jpg', '2024-04-24 03:07:02'),
(118, 18, 'testAZAZ', 'House', '66287756f3698-1713928022.jpg', '2024-04-24 03:07:02'),
(119, 18, 'testAZAZ', 'House', '6628775700978-1713928023.jpeg', '2024-04-24 03:07:02'),
(120, 18, 'testAZAZ', 'House', '6628775701249-1713928023.jpg', '2024-04-24 03:07:02'),
(121, 19, 'nacer maison', 'House', '66288a7c0b9c9-1713932924.jpg', '2024-04-24 04:28:44'),
(122, 19, 'nacer maison', 'House', '66288a7c0c05a-1713932924.jpg', '2024-04-24 04:28:44'),
(123, 19, 'nacer maison', 'House', '66288a7c0c715-1713932924.webp', '2024-04-24 04:28:44'),
(124, 19, 'nacer maison', 'House', '66288a7c0d0b7-1713932924.jpg', '2024-04-24 04:28:44'),
(125, 19, 'nacer maison', 'House', '66288a7c0d789-1713932924.jpg', '2024-04-24 04:28:44'),
(126, 19, 'nacer maison', 'House', '66288a7c0dedf-1713932924.jpg', '2024-04-24 04:28:44'),
(127, 19, 'nacer maison', 'House', '66288a7c0e6cf-1713932924.jpg', '2024-04-24 04:28:44'),
(128, 19, 'nacer maison', 'House', '66288a7c0ee21-1713932924.jpg', '2024-04-24 04:28:44'),
(129, 19, 'nacer maison', 'House', '66288a7c0f5c6-1713932924.jpg', '2024-04-24 04:28:44'),
(130, 19, 'nacer maison', 'House', '66288a7c0fc8a-1713932924.jpg', '2024-04-24 04:28:44'),
(131, 19, 'nacer maison', 'House', '66288a7c10338-1713932924.jpg', '2024-04-24 04:28:44'),
(132, 19, 'nacer maison', 'House', '66288a7c10b57-1713932924.jpg', '2024-04-24 04:28:44'),
(133, 19, 'nacer maison', 'House', '66288a7c11256-1713932924.jpeg', '2024-04-24 04:28:44'),
(134, 19, 'nacer maison', 'House', '66288a7c11c99-1713932924.jpg', '2024-04-24 04:28:44');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `utilisateurID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(35) NOT NULL,
  `prenom` varchar(35) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `date_naissance` varchar(10) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `password` varchar(70) NOT NULL,
  PRIMARY KEY (`utilisateurID`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateurID`, `nom`, `prenom`, `email`, `telephone`, `statut`, `date_naissance`, `cin`, `password`) VALUES
(1, 'elhem', '  elhem', 'elhem@admin.com', '24587616', 'administrateur', '2002-02-25', '21345678', 'adminadmin'),
(2, 'admin2', 'admin2', 'admin2@admin.com', '12345678', 'administrateur', '2002-01-01', '98765432', 'admin'),
(5, 'elhem', 'elhem', 'elhem@gmail.com', '23456789', 'locataire', '2002-01-01', '13456789', 'azerty12'),
(8, 'elhem', 'elhem', 'elhem1@gmail.com', '23456789', 'proprietaire', '2024-03-09', '13345612', 'user'),
(9, 'azerty', 'azerty', 'abdenacer@gmail.com', '12312312', 'administrateur', '2024-03-12', '123123123', '12345678'),
(10, 'Abdenacer', 'Hasnaoui', 'abdenacer1993@gmail.com', '24587616', 'proprietaire', '1993-07-16', '09876543', 'nacer123'),
(12, 'aziz', 'aziz', 'aziz@gmail.com', '24587616', 'locataire', '2000-06-20', '13456789', 'aziz1234'),
(13, 'abdenacer', 'abdenacer', 'abdenacer1@gmail.com', '23122312', 'locataire', '2024-04-25', '1231231', 'azerty12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
