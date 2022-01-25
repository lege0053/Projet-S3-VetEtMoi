-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le :  jeu. 20 jan. 2022 à 19:40
-- Version du serveur :  10.2.25-MariaDB
-- Version de PHP :  7.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `infs3_prj11`
--
CREATE DATABASE IF NOT EXISTS `infs3_prj11` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `infs3_prj11`;

-- --------------------------------------------------------

--
-- Structure de la table `ActeOuProduit`
--

CREATE TABLE `ActeOuProduit` (
  `id` int(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `PU_TTC` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ActeOuProduit`
--

INSERT INTO `ActeOuProduit` (`id`, `name`, `PU_TTC`) VALUES
(1, 'CONSULTATION PRE-OPERATOIRE', 26),
(2, 'BILAN SANGUIN PRE-OPERATOIRE CHIEN', 68),
(3, 'AMPUTATION DOIGT OU QUEUE', 184),
(4, 'ANESTHÉSIE GÉNÉRALE CHAT', 69),
(5, 'ANESTHÉSIE GÉNÉRALE CHIEN -10KG', 80),
(6, 'ANESTHÉSIE GÉNÉRALE CHIEN 10-20KG', 89),
(7, 'ANESTHÉSIE GÉNÉRALE CHIEN 20-45KG', 103),
(8, 'ANESTHÉSIE GÉNÉRALE CHIEN +45KG', 120),
(9, 'ANESTHÉSIE GÉNÉRALE NAC', 71),
(10, 'ANESTHÉSIE LOCALE', 20),
(11, 'BILAN 17 PARAMÈTRES', 70),
(12, 'BILAN BIOCHIMIE 10 PARAMÈTRES', 43),
(13, 'BIOPSIE', 50),
(14, 'CASTRATION CHAT', 23),
(15, 'CASTRATION CHAT CRYPTORCHIDE ABDOMEN', 111),
(16, 'CASTRATION CHIEN', 96),
(17, 'CÉSARIENNE CHATTE', 151),
(18, 'CÉSARIENNE CHIENNE -10KG', 135),
(19, 'CÉSARIENNE CHIENNE 10-20KG', 233),
(20, 'CÉSARIENNE CHIENNE +20KG', 260),
(21, 'CONSULTATION DE SUIVI', 28),
(22, 'COUPE GRIFFE CHAT', 10),
(23, 'COUPE GRIFFE CHIEN', 13),
(24, 'COUPE GRIFFE LAPIN/COCHON D INDE', 10),
(25, 'DÉBRIDEMENT ABCÈS', 55),
(26, 'DÉMÊLAGE CHAT À POILS LONGS HORS ANESTHÉSIE', 55),
(27, 'DÉTARTRAGE CHAT', 28),
(28, 'DÉTARTRAGE CHIEN', 33),
(29, 'DUPLICATA CARTE IDENTIFICATION', 9),
(30, 'ECHOGRAPHIE ABDOMINALE OU CARDIAQUE UVCET', 160),
(31, 'EUTHANASIE -5KG', 70),
(32, 'EUTHANASIE 5-20KG', 86),
(33, 'EUTHANASIE +20KG', 86),
(34, 'EUTHANASIE NAC', 36),
(35, 'HERNIE OMBILICALE', 54),
(36, 'HOSPITALISATION JOUR CHAT', 46),
(37, 'HOSPITALISATION JOUR CHIEN -10KG', 50),
(38, 'HOSPITALISATION JOUR CHIEN 10-20 KG', 55),
(39, 'HOSPITALISATION JOUR CHIEN + 20 KG', 60),
(40, 'HOSPITALISATION JOUR NAC', 44),
(41, 'INCINÉRATION COLLECTIVE CHAT', 73),
(42, 'INCINÉRATION COLLECTIVE CHIEN', 73),
(43, 'INCINÉRATION COLLECTIVE NAC', 73),
(44, 'INCINÉRATION INDIVIDUELLE CHAT', 227),
(45, 'INCINÉRATION INDIVIDUELLE CHIEN', 227),
(46, 'INCINÉRATION INDIVIDUELLE NAC', 153),
(47, 'LAVEMENT RECTAL', 107),
(48, 'MISE SOUS PERFUSION (CATHÉTER,TUBULURE)', 42),
(49, 'NUMÉRATION FORMULE SANGUINE', 30),
(50, 'OVARIECTOMIE CHATTE', 75),
(51, 'OVARIOHYSTÉRECTOMIE CHATTE', 136),
(52, 'OVARIOHYSTÉRECTOMIE LAPINE', 82),
(53, 'OXYGÉNOTHÉRAPIE', 22),
(54, 'PANSEMENT SIMPLE', 12),
(55, 'PASSEPORT ', 17),
(56, 'PENSION CHAT', 14),
(57, 'PENSION CHIEN - 10 KG', 18),
(58, 'PENSION CHIEN 10-20 KG', 20),
(59, 'PENSION CHIEN + 20 KG', 22),
(60, 'PENSION NAC ET OISEAU', 12),
(61, 'PERFUSION CHAT', 30),
(62, 'PERFUSION CHIEN - 10 KG', 32),
(63, 'PERFUSION CHIEN 10-20 KG', 33),
(64, 'PERFUSION CHIEN + 20 KG', 34),
(65, 'PERFUSION NAC/JOUR', 17),
(66, 'PRISE DE SANG', 10),
(67, 'PUCE ÉLECTRONIQUE', 74),
(68, 'RENOUVELLEMENT ORDONNANCE (POUR 6 MOIS)', 16),
(69, 'SONDAGE CHAT SUF', 88),
(70, 'SONDAGE URINAIRE CHIEN', 22),
(71, 'SPRAY ANTIPUCE ICI/KG', 2),
(72, 'SUPPLÉMENT OVARIECTOMIE (PYOMÈTRE OU GESTATION)', 82),
(73, 'TATOUAGE', 26),
(74, 'TONTE PETIT CHIEN OU CHAT', 54),
(75, 'TRANQUILLISATION CHAT', 69),
(76, 'TRANQUILLISATION CHIEN - 10 KG', 80),
(77, 'TRANQUILLISATION CHIEN 10-20 KG:', 89),
(78, 'TRANQUILLISATION CHIEN 20-45 KG:', 103),
(79, 'TRANQUILLISATION CHIEN + 45 KG', 120),
(80, 'TRANSFUSION', 134),
(81, 'VACCIN CARRÉ+HÉPATITE+PARVOVIROSE', 15),
(82, 'VACCIN CARRÉ+HÉPATITE+PARVOVIROSE+LEPTOSPIROSE', 21),
(83, 'VACCIN LAPIN VHD+MYXOMATOSE', 28),
(84, 'VACCIN LEPTOSPIROSE', 6),
(85, 'VACCIN LEUCOSE', 23),
(86, 'VACCIN RAGE', 4),
(87, 'VACCIN TYPHUS+CORYZA', 12),
(88, 'VACCIN TYPHUS+CORYZA+LEUCOSE', 35),
(89, 'CÉSARIENNE CHIENNE 10-20KG', 233);

-- --------------------------------------------------------

--
-- Structure de la table `Animal`
--

CREATE TABLE `Animal` (
  `animalId` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `birthDay` date NOT NULL,
  `deathDay` date DEFAULT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `userId` varchar(50) NOT NULL,
  `threatId` int(11) NOT NULL,
  `genderId` int(11) NOT NULL,
  `raceId` int(11) NOT NULL,
  `dress` varchar(255) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `tatoo` varchar(6) DEFAULT NULL,
  `chip` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Animal`
--

INSERT INTO `Animal` (`animalId`, `name`, `birthDay`, `deathDay`, `comment`, `userId`, `threatId`, `genderId`, `raceId`, `dress`, `weight`, `tatoo`, `chip`) VALUES
('001', 'Luna', '2016-11-09', NULL, 'anxieuse', 'mRgEkL0tHguy', 1, 1, 1, 'Sable', '25.2 kg', '304UJB', NULL),
('002', 'Gribouille', '2020-11-19', NULL, 'Ouvre les portes du chenil.', 'mRgEkL0tHguy', 2, 2, 2, 'Tortie', '5 kg', NULL, '250 268 267 203 154'),
('003', 'PanPan', '2020-07-20', NULL, 'Dents qui poussent vite', 'mRgEkL0tHguy', 1, 1, 31, NULL, NULL, NULL, NULL),
('004', 'Kuzo', '2021-02-09', NULL, NULL, 'mRgEkL0tHguy', 3, 1, 20, NULL, NULL, NULL, NULL),
('005', 'Bouboule', '2020-11-03', NULL, NULL, 'mRgEkL0tHguy', 1, 2, 22, NULL, NULL, NULL, NULL),
('006', 'Plume', '2019-11-09', NULL, NULL, 'mRgEkL0tHguy', 1, 1, 34, NULL, NULL, NULL, NULL),
('007', 'Vanille', '2021-08-16', NULL, NULL, 'mRgEkL0tHguy', 1, 1, 27, NULL, NULL, NULL, NULL),
('008', 'Ratatouille', '2021-10-14', NULL, 'Adore manger les câbles de la télévision.', 'mRgEkL0tHguy', 2, 2, 25, NULL, NULL, NULL, NULL),
('009', 'Stuart', '2021-07-05', NULL, NULL, 'mRgEkL0tHguy', 1, 2, 35, NULL, NULL, NULL, NULL),
('010', 'Juarez', '2021-07-11', NULL, 'Acteur: A joué dans le film MISSION-G (2009)', 'mRgEkL0tHguy', 1, 1, 38, NULL, NULL, NULL, NULL),
('011', 'Crevette', '2021-06-14', NULL, NULL, 'mRgEkL0tHguy', 1, 1, 41, NULL, NULL, NULL, NULL),
('012', 'Gizmo', '2019-07-14', NULL, NULL, 'mRgEkL0tHguy', 3, 2, 42, NULL, NULL, NULL, NULL),
('013', 'Stuart', '2021-05-10', NULL, NULL, 'vvhJjXx5rneJ', 1, 2, 6, NULL, NULL, NULL, NULL),
('014', 'Lucky', '2016-11-16', NULL, NULL, 'vvhJjXx5rneJ', 1, 2, 6, NULL, NULL, NULL, NULL),
('015', 'Parro', '2015-03-12', NULL, 'Becte les doigts des Vétérinaires', 'uB4Hnzq8MBzW', 3, 2, 34, NULL, NULL, NULL, NULL),
('016', 'Rattus', '2021-11-15', NULL, NULL, '9hlzWFmmfmfG', 1, 1, 25, NULL, NULL, NULL, NULL),
('017', 'Bonita', '2006-05-05', NULL, NULL, '9hlzWFmmfmfG', 1, 2, 26, NULL, NULL, NULL, NULL),
('018', 'Leonardo', '2019-05-21', NULL, NULL, 'VQ6pxc8iPZ4N', 2, 2, 27, NULL, NULL, NULL, NULL),
('019', 'Rahaelo', '2019-05-21', NULL, NULL, 'VQ6pxc8iPZ4N', 3, 2, 27, NULL, NULL, NULL, NULL),
('020', 'Michelangelo', '2019-05-21', NULL, NULL, 'VQ6pxc8iPZ4N', 1, 2, 27, NULL, NULL, NULL, NULL),
('021', 'Donatello', '2019-05-21', NULL, NULL, 'VQ6pxc8iPZ4N', 1, 2, 27, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Command`
--

CREATE TABLE `Command` (
  `commandId` varchar(50) NOT NULL,
  `commandPrice` decimal(15,2) NOT NULL,
  `commandDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Concern`
--

CREATE TABLE `Concern` (
  `meetingId` varchar(50) NOT NULL,
  `timeSlotId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Concern`
--

INSERT INTO `Concern` (`meetingId`, `timeSlotId`) VALUES
('0OyxyDYRdZJH', 55),
('1jU8tVG0Bf5I', 140),
('2dHIpykKEE2g', 52),
('3', 60),
('4', 6),
('4ahos2tjMzwS', 2),
('4uue9aPy6xRu', 212),
('5', 50),
('58t8dxbwzoIP', 36),
('6eRLQUforOu5', 173),
('6k7tbMPoHo3O', 87),
('6oajdHJiy93y', 105),
('6TbHUapdTKB5', 88),
('95uGPp8iIobB', 154),
('ah5mD0QrfbgF', 172),
('azOoN8bkBC7A', 105),
('AZXzZM3FVJP0', 173),
('Bq62k2Ak6zTk', 89),
('bRqJCQ5nanEY', 59),
('brXmHbutLDJt', 42),
('bzf0rqglwFVs', 2),
('c10G8fgr6', 127),
('cF4gr6F8', 118),
('CkkEzFJm0I0i', 36),
('d1wQFIqQtfCI', 39),
('d8311uq84fLL', 172),
('dcockDhxFWnU', 104),
('Dg1nLYCwqjod', 8),
('DX9jMrr6pWr8', 105),
('ev3Ow8LoaExM', 88),
('fkorPTi8XD3H', 40),
('FWSmtSCF1EWO', 91),
('G0YTKGfkgECU', 139),
('GBfAyjbrazhh', 144),
('hUVqQZcXEi8t', 145),
('Jr1NtGs35mDX', 52),
('k2cCzvNssFvk', 173),
('KDkC0yJWI4ZO', 89),
('KNcZdWedCKue', 1),
('kP37pPNuIw9l', 54),
('KqNfsiANvL3B', 211),
('kyz4qeZ40tsW', 57),
('KyZRlG4OCkhW', 140),
('lnazTUmJC9Mi', 86),
('LvU28AebHNZ7', 143),
('LYeCuMun2BvJ', 43),
('LyiMRzOJzjTT', 147),
('lyrUKfCFom19', 140),
('M3p7PQoQoXPu', 95),
('MKud08o2G8Na', 173),
('mr0G7NU3Gsyv', 38),
('N5DqdTAIhIqQ', 144),
('NB6Dc307lQca', 37),
('NDothq9qMRcN', 36),
('NTgyaeBh98zx', 90),
('Odea5kSqBMd4', 6),
('Oj05NpjveQpk', 172),
('OM4VMy9cCovO', 139),
('oRbbkasphGY5', 53),
('ppFktHyveZSF', 104),
('PvZCdnKiyng2', 138),
('q8wM9jCHJBvA', 53),
('Q9BKz9UVyB75', 4),
('qu1NaCISU8aP', 38),
('rG0jzSxj9X23', 145),
('s0PdwGOAlfFo', 146),
('s5E7zdfDNNhr', 211),
('sEzCbm1SGUj7', 36),
('sfqQ1CGsZe3s', 1),
('srVsLnGm9EGW', 172),
('tOMbeUvpFo41', 36),
('TwhVOSPrsA1w', 8),
('uEv4853WDCcs', 87),
('UT2x30VyhA39', 173),
('vjolcDV98HPK', 141),
('vM9s4NsYTdNJ', 211),
('vMPCStXJEXeS', 55),
('vU5m83FaQBK8', 7),
('w9WyJMmh77GU', 215),
('wqfdG68fgr', 138),
('x2F4fn6gF', 104),
('x5X6sayeUO2C', 40),
('xf8F465fe', 172),
('xZgbdYZ4LNWS', 1),
('ygKVZh5LpuRC', 89),
('YLsh7QsRFFD2', 56),
('YVYKeKOp0hbm', 102),
('Z0uyTSS4ud10', 105),
('z4vbn1jiVSbA', 88);

-- --------------------------------------------------------

--
-- Structure de la table `Content`
--

CREATE TABLE `Content` (
  `productId` int(11) NOT NULL,
  `commandId` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `GenderStatus`
--

CREATE TABLE `GenderStatus` (
  `genderId` int(11) NOT NULL,
  `genderName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `GenderStatus`
--

INSERT INTO `GenderStatus` (`genderId`, `genderName`) VALUES
(1, 'Femelle'),
(2, 'Mâle'),
(3, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `Horaire`
--

CREATE TABLE `Horaire` (
  `userId` varchar(50) NOT NULL,
  `timeSlotId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Horaire`
--

INSERT INTO `Horaire` (`userId`, `timeSlotId`) VALUES
('6rh5PoFBxyl7', 1),
('6rh5PoFBxyl7', 2),
('6rh5PoFBxyl7', 3),
('6rh5PoFBxyl7', 4),
('6rh5PoFBxyl7', 5),
('6rh5PoFBxyl7', 6),
('6rh5PoFBxyl7', 7),
('6rh5PoFBxyl7', 8),
('6rh5PoFBxyl7', 9),
('6rh5PoFBxyl7', 10),
('6rh5PoFBxyl7', 11),
('6rh5PoFBxyl7', 12),
('6rh5PoFBxyl7', 13),
('6rh5PoFBxyl7', 14),
('6rh5PoFBxyl7', 15),
('6rh5PoFBxyl7', 16),
('6rh5PoFBxyl7', 17),
('6rh5PoFBxyl7', 18),
('6rh5PoFBxyl7', 19),
('6rh5PoFBxyl7', 20),
('6rh5PoFBxyl7', 21),
('6rh5PoFBxyl7', 22),
('6rh5PoFBxyl7', 23),
('6rh5PoFBxyl7', 24),
('6rh5PoFBxyl7', 25),
('6rh5PoFBxyl7', 26),
('6rh5PoFBxyl7', 27),
('6rh5PoFBxyl7', 28),
('6rh5PoFBxyl7', 29),
('6rh5PoFBxyl7', 30),
('6rh5PoFBxyl7', 31),
('6rh5PoFBxyl7', 32),
('6rh5PoFBxyl7', 33),
('6rh5PoFBxyl7', 34),
('6rh5PoFBxyl7', 35),
('6rh5PoFBxyl7', 36),
('6rh5PoFBxyl7', 37),
('6rh5PoFBxyl7', 38),
('6rh5PoFBxyl7', 39),
('6rh5PoFBxyl7', 40),
('6rh5PoFBxyl7', 41),
('6rh5PoFBxyl7', 42),
('6rh5PoFBxyl7', 43),
('6rh5PoFBxyl7', 44),
('6rh5PoFBxyl7', 45),
('6rh5PoFBxyl7', 46),
('6rh5PoFBxyl7', 209),
('6rh5PoFBxyl7', 210),
('6rh5PoFBxyl7', 211),
('6rh5PoFBxyl7', 212),
('6rh5PoFBxyl7', 213),
('6rh5PoFBxyl7', 214),
('6rh5PoFBxyl7', 215),
('6rh5PoFBxyl7', 216),
('6rh5PoFBxyl7', 217),
('6rh5PoFBxyl7', 218),
('6rh5PoFBxyl7', 219),
('6rh5PoFBxyl7', 220),
('qgF86R2fL4r5', 1),
('qgF86R2fL4r5', 2),
('qgF86R2fL4r5', 3),
('qgF86R2fL4r5', 4),
('qgF86R2fL4r5', 5),
('qgF86R2fL4r5', 6),
('qgF86R2fL4r5', 7),
('qgF86R2fL4r5', 8),
('qgF86R2fL4r5', 9),
('qgF86R2fL4r5', 10),
('qgF86R2fL4r5', 11),
('qgF86R2fL4r5', 12),
('qgF86R2fL4r5', 13),
('qgF86R2fL4r5', 14),
('qgF86R2fL4r5', 15),
('qgF86R2fL4r5', 16),
('qgF86R2fL4r5', 52),
('qgF86R2fL4r5', 53),
('qgF86R2fL4r5', 54),
('qgF86R2fL4r5', 55),
('qgF86R2fL4r5', 56),
('qgF86R2fL4r5', 57),
('qgF86R2fL4r5', 58),
('qgF86R2fL4r5', 59),
('qgF86R2fL4r5', 60),
('qgF86R2fL4r5', 61),
('qgF86R2fL4r5', 62),
('qgF86R2fL4r5', 63),
('qgF86R2fL4r5', 64),
('qgF86R2fL4r5', 65),
('qgF86R2fL4r5', 66),
('qgF86R2fL4r5', 67),
('qgF86R2fL4r5', 68),
('qgF86R2fL4r5', 69),
('qgF86R2fL4r5', 86),
('qgF86R2fL4r5', 87),
('qgF86R2fL4r5', 88),
('qgF86R2fL4r5', 89),
('qgF86R2fL4r5', 90),
('qgF86R2fL4r5', 91),
('qgF86R2fL4r5', 92),
('qgF86R2fL4r5', 93),
('qgF86R2fL4r5', 94),
('qgF86R2fL4r5', 95),
('qgF86R2fL4r5', 96),
('qgF86R2fL4r5', 97),
('qgF86R2fL4r5', 98),
('qgF86R2fL4r5', 99),
('qgF86R2fL4r5', 100),
('qgF86R2fL4r5', 101),
('qgF86R2fL4r5', 102),
('qgF86R2fL4r5', 103),
('qgF86R2fL4r5', 104),
('qgF86R2fL4r5', 105),
('qgF86R2fL4r5', 138),
('qgF86R2fL4r5', 139),
('qgF86R2fL4r5', 140),
('qgF86R2fL4r5', 141),
('qgF86R2fL4r5', 142),
('qgF86R2fL4r5', 143),
('qgF86R2fL4r5', 144),
('qgF86R2fL4r5', 145),
('qgF86R2fL4r5', 146),
('qgF86R2fL4r5', 147),
('qgF86R2fL4r5', 148),
('qgF86R2fL4r5', 149),
('qgF86R2fL4r5', 150),
('qgF86R2fL4r5', 151),
('qgF86R2fL4r5', 152),
('qgF86R2fL4r5', 153),
('qgF86R2fL4r5', 154),
('qgF86R2fL4r5', 155),
('qgF86R2fL4r5', 156),
('qgF86R2fL4r5', 157),
('qgF86R2fL4r5', 158),
('qgF86R2fL4r5', 159),
('qgF86R2fL4r5', 160),
('qgF86R2fL4r5', 161),
('qgF86R2fL4r5', 162),
('qgF86R2fL4r5', 163),
('qgF86R2fL4r5', 164),
('qgF86R2fL4r5', 165),
('qgF86R2fL4r5', 166),
('qgF86R2fL4r5', 167),
('qgF86R2fL4r5', 168),
('qgF86R2fL4r5', 169),
('qgF86R2fL4r5', 170),
('qgF86R2fL4r5', 171),
('qgF86R2fL4r5', 172),
('qgF86R2fL4r5', 173),
('qgF86R2fL4r5', 209),
('qgF86R2fL4r5', 210),
('qgF86R2fL4r5', 211),
('qgF86R2fL4r5', 212);

-- --------------------------------------------------------

--
-- Structure de la table `Meeting`
--

CREATE TABLE `Meeting` (
  `meetingId` varchar(50) NOT NULL,
  `meetingDate` date NOT NULL,
  `isPayed` int(11) NOT NULL DEFAULT 0,
  `price` double(25,2) DEFAULT NULL,
  `userId` varchar(50) NOT NULL,
  `animalId` varchar(50) DEFAULT NULL,
  `vetoId` varchar(50) NOT NULL,
  `speciesId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Meeting`
--

INSERT INTO `Meeting` (`meetingId`, `meetingDate`, `isPayed`, `price`, `userId`, `animalId`, `vetoId`, `speciesId`) VALUES
('0OyxyDYRdZJH', '2021-12-21', 0, NULL, 'VQ6pxc8iPZ4N', '020', 'qgF86R2fL4r5', 7),
('1jU8tVG0Bf5I', '2021-12-17', 0, NULL, 'mRgEkL0tHguy', '006', 'qgF86R2fL4r5', 6),
('2dHIpykKEE2g', '2022-04-12', 0, NULL, 'vvhJjXx5rneJ', '014', 'qgF86R2fL4r5', 1),
('3', '2021-11-16', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', NULL),
('4', '2021-11-15', 1, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', NULL),
('4ahos2tjMzwS', '2021-12-13', 0, NULL, 'VQ6pxc8iPZ4N', NULL, '6rh5PoFBxyl7', 4),
('4uue9aPy6xRu', '2021-12-21', 0, NULL, '9hlzWFmmfmfG', '016', 'qgF86R2fL4r5', 8),
('5', '2021-11-16', 1, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', NULL),
('58t8dxbwzoIP', '2022-02-15', 0, NULL, 'VQ6pxc8iPZ4N', NULL, '6rh5PoFBxyl7', 4),
('6eRLQUforOu5', '2021-12-18', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', 1),
('6k7tbMPoHo3O', '2022-01-12', 0, NULL, 'vvhJjXx5rneJ', '013', 'qgF86R2fL4r5', 1),
('6oajdHJiy93y', '2021-12-09', 0, NULL, 'mRgEkL0tHguy', '009', 'qgF86R2fL4r5', 9),
('6TbHUapdTKB5', '2022-01-12', 0, NULL, 'vvhJjXx5rneJ', '014', 'qgF86R2fL4r5', 1),
('95uGPp8iIobB', '2021-12-10', 0, NULL, 'mRgEkL0tHguy', '007', 'qgF86R2fL4r5', 7),
('aDf6e84F6', '2022-02-21', 0, NULL, 'mRgEkL0tHguy', '003', 'qgF86R2fL4r5', NULL),
('ah5mD0QrfbgF', '2021-12-18', 0, NULL, 'EaX3tYZQfAo6', NULL, 'qgF86R2fL4r5', 6),
('azOoN8bkBC7A', '2021-12-16', 0, NULL, '9hlzWFmmfmfG', NULL, 'qgF86R2fL4r5', 6),
('AZXzZM3FVJP0', '2021-12-25', 0, NULL, 'uB4Hnzq8MBzW', '015', 'qgF86R2fL4r5', 6),
('Bq62k2Ak6zTk', '2022-05-25', 0, NULL, 'uB4Hnzq8MBzW', '015', 'qgF86R2fL4r5', 6),
('bRqJCQ5nanEY', '2021-12-21', 0, NULL, 'mRgEkL0tHguy', '003', 'qgF86R2fL4r5', 5),
('brXmHbutLDJt', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', '006', '6rh5PoFBxyl7', 6),
('bzf0rqglwFVs', '2022-01-10', 0, NULL, 'VQ6pxc8iPZ4N', '020', 'qgF86R2fL4r5', 7),
('c10G8fgr6', '2021-11-11', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', NULL),
('cF4gr6F8', '2022-02-17', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', NULL),
('CkkEzFJm0I0i', '2022-01-11', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('d1wQFIqQtfCI', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', '003', '6rh5PoFBxyl7', 5),
('d8311uq84fLL', '2021-11-11', 0, NULL, 'mRgEkL0tHguy', '012', 'qgF86R2fL4r5', 12),
('dcockDhxFWnU', '2022-01-27', 0, NULL, 'mRgEkL0tHguy', '007', 'qgF86R2fL4r5', 7),
('Dg1nLYCwqjod', '2021-12-13', 0, NULL, 'VQ6pxc8iPZ4N', '021', 'qgF86R2fL4r5', 7),
('DX9jMrr6pWr8', '2021-11-10', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('ev3Ow8LoaExM', '2021-12-22', 0, NULL, '9hlzWFmmfmfG', '016', 'qgF86R2fL4r5', 8),
('f9OiOhdkfGRv', '2021-11-10', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', 1),
('fgG9f56F', '2021-12-28', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', NULL),
('fkorPTi8XD3H', '2022-01-04', 0, NULL, 'qgF86R2fL4r5', NULL, '6rh5PoFBxyl7', 4),
('FWSmtSCF1EWO', '2021-12-15', 0, NULL, '9hlzWFmmfmfG', '017', 'qgF86R2fL4r5', 7),
('G0YTKGfkgECU', '2021-12-24', 0, NULL, 'vvhJjXx5rneJ', '014', 'qgF86R2fL4r5', 1),
('GBfAyjbrazhh', '2021-12-24', 0, NULL, 'mRgEkL0tHguy', '010', 'qgF86R2fL4r5', 10),
('hUVqQZcXEi8t', '2021-12-10', 0, NULL, 'mRgEkL0tHguy', '009', 'qgF86R2fL4r5', 9),
('HzKfdEgbeRyi', '2021-11-10', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', 1),
('Jr1NtGs35mDX', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', '007', 'qgF86R2fL4r5', 7),
('k2cCzvNssFvk', '2021-11-11', 0, NULL, 'mRgEkL0tHguy', '004', 'qgF86R2fL4r5', 3),
('KDkC0yJWI4ZO', '2022-01-12', 0, NULL, 'VQ6pxc8iPZ4N', '021', 'qgF86R2fL4r5', 7),
('KNcZdWedCKue', '2021-12-13', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('kP37pPNuIw9l', '2021-12-21', 0, NULL, 'VQ6pxc8iPZ4N', '019', 'qgF86R2fL4r5', 7),
('KqNfsiANvL3B', '2022-01-25', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', 1),
('kshTF6nsMIm2', '2021-11-09', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('kyz4qeZ40tsW', '2022-01-18', 0, NULL, 'VQ6pxc8iPZ4N', '020', 'qgF86R2fL4r5', 7),
('KyZRlG4OCkhW', '2021-12-24', 0, NULL, 'vvhJjXx5rneJ', '013', 'qgF86R2fL4r5', 1),
('lnazTUmJC9Mi', '2021-12-08', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('lNsYrjJCgNsf', '2021-11-10', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('LvU28AebHNZ7', '2022-01-14', 0, NULL, 'VQ6pxc8iPZ4N', '020', 'qgF86R2fL4r5', 7),
('LYeCuMun2BvJ', '2022-01-18', 0, NULL, 'EaX3tYZQfAo6', NULL, '6rh5PoFBxyl7', 5),
('LyiMRzOJzjTT', '2021-12-24', 0, NULL, '9hlzWFmmfmfG', '016', 'qgF86R2fL4r5', 8),
('lyrUKfCFom19', '2021-12-10', 0, NULL, 'mRgEkL0tHguy', '005', 'qgF86R2fL4r5', 4),
('M3p7PQoQoXPu', '2021-12-15', 0, NULL, 'mRgEkL0tHguy', '011', 'qgF86R2fL4r5', 11),
('MKud08o2G8Na', '2022-01-22', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', 1),
('mr0G7NU3Gsyv', '2021-12-14', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('N5DqdTAIhIqQ', '2021-12-17', 0, NULL, 'EaX3tYZQfAo6', NULL, 'qgF86R2fL4r5', 7),
('NB6Dc307lQca', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('NDothq9qMRcN', '2021-12-28', 0, NULL, 'VQ6pxc8iPZ4N', '018', '6rh5PoFBxyl7', 7),
('NTgyaeBh98zx', '2021-12-08', 0, NULL, 'mRgEkL0tHguy', '005', 'qgF86R2fL4r5', 4),
('Odea5kSqBMd4', '2021-12-13', 0, NULL, 'VQ6pxc8iPZ4N', '019', 'qgF86R2fL4r5', 7),
('Oj05NpjveQpk', '2021-12-25', 0, NULL, 'mRgEkL0tHguy', '003', 'qgF86R2fL4r5', 5),
('OM4VMy9cCovO', '2022-01-07', 0, NULL, '9hlzWFmmfmfG', '016', 'qgF86R2fL4r5', 8),
('OO0yx3rVWi5W', '2021-11-10', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('oRbbkasphGY5', '2022-04-12', 0, NULL, 'vvhJjXx5rneJ', '013', 'qgF86R2fL4r5', 1),
('ppFktHyveZSF', '2022-01-06', 0, NULL, 'xE7lwx9SdS89', NULL, 'qgF86R2fL4r5', 6),
('PvZCdnKiyng2', '2022-01-28', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', 1),
('q8wM9jCHJBvA', '2021-12-21', 0, NULL, 'VQ6pxc8iPZ4N', '018', 'qgF86R2fL4r5', 7),
('Q9BKz9UVyB75', '2021-12-13', 0, NULL, 'VQ6pxc8iPZ4N', '018', 'qgF86R2fL4r5', 7),
('qu1NaCISU8aP', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', 1),
('rG0jzSxj9X23', '2021-12-17', 0, NULL, 'uB4Hnzq8MBzW', '015', 'qgF86R2fL4r5', 6),
('s0PdwGOAlfFo', '2021-12-17', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('s5E7zdfDNNhr', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', NULL, '6rh5PoFBxyl7', 6),
('sEzCbm1SGUj7', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', '004', 'qgF86R2fL4r5', 3),
('sfqQ1CGsZe3s', '2021-12-13', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('srVsLnGm9EGW', '2021-12-11', 0, NULL, 'mRgEkL0tHguy', '004', 'qgF86R2fL4r5', 3),
('sYYXk9WJJKTc', '2021-11-10', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('tOMbeUvpFo41', '2022-01-04', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('TwhVOSPrsA1w', '2021-12-13', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('uEv4853WDCcs', '2021-12-08', 0, NULL, 'mRgEkL0tHguy', '009', 'qgF86R2fL4r5', 9),
('UT2x30VyhA39', '2021-12-11', 0, NULL, 'mRgEkL0tHguy', '012', 'qgF86R2fL4r5', 12),
('vjolcDV98HPK', '2021-12-17', 0, NULL, '9hlzWFmmfmfG', '016', 'qgF86R2fL4r5', 8),
('vM9s4NsYTdNJ', '2021-12-28', 0, NULL, '9hlzWFmmfmfG', '016', '6rh5PoFBxyl7', 8),
('vMPCStXJEXeS', '2021-12-14', 0, NULL, 'uB4Hnzq8MBzW', '015', 'qgF86R2fL4r5', 6),
('vU5m83FaQBK8', '2021-12-13', 0, NULL, 'VQ6pxc8iPZ4N', '020', 'qgF86R2fL4r5', 7),
('w9WyJMmh77GU', '2021-12-17', 0, NULL, 'mRgEkL0tHguy', NULL, '6rh5PoFBxyl7', 5),
('wqfdG68fgr', '2021-12-10', 0, NULL, 'mRgEkL0tHguy', '003', 'qgF86R2fL4r5', NULL),
('x2F4fn6gF', '2022-01-20', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', NULL),
('x5X6sayeUO2C', '2021-12-07', 0, NULL, 'mRgEkL0tHguy', '011', '6rh5PoFBxyl7', 11),
('XCJ3Lo1rxZyw', '2021-11-10', 0, NULL, 'mRgEkL0tHguy', '002', 'qgF86R2fL4r5', 2),
('xf8F465fe', '2022-01-22', 0, NULL, 'mRgEkL0tHguy', '001', 'qgF86R2fL4r5', NULL),
('xZgbdYZ4LNWS', '2021-12-13', 0, NULL, 'mRgEkL0tHguy', '001', '6rh5PoFBxyl7', 1),
('ygKVZh5LpuRC', '2021-12-15', 0, NULL, '0aWlxVCXCi8Q', NULL, 'qgF86R2fL4r5', 5),
('YLsh7QsRFFD2', '2021-12-21', 0, NULL, 'VQ6pxc8iPZ4N', '021', 'qgF86R2fL4r5', 7),
('YVYKeKOp0hbm', '2021-12-08', 0, NULL, 'mRgEkL0tHguy', '003', 'qgF86R2fL4r5', 5),
('Z0uyTSS4ud10', '2022-01-20', 0, NULL, 'CLtgWy7AlWAP', NULL, 'qgF86R2fL4r5', 3),
('z4vbn1jiVSbA', '2021-12-08', 0, NULL, 'mRgEkL0tHguy', '008', 'qgF86R2fL4r5', 8);

-- --------------------------------------------------------

--
-- Structure de la table `News`
--

CREATE TABLE `News` (
  `newsId` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `dateNews` date NOT NULL,
  `userId` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Products`
--

CREATE TABLE `Products` (
  `productId` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `quantityLimit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Race`
--

CREATE TABLE `Race` (
  `raceId` int(11) NOT NULL,
  `raceName` varchar(50) NOT NULL,
  `speciesId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Race`
--

INSERT INTO `Race` (`raceId`, `raceName`, `speciesId`) VALUES
(1, 'Labrador', 1),
(2, 'Sacré de birmanie', 2),
(3, 'Chihuahua', 1),
(4, 'Jack Russell terrier', 1),
(5, 'Bull Terrier', 1),
(6, 'Berger allemand', 1),
(7, 'Golden retriever', 1),
(8, 'Dogue allemand', 1),
(9, 'Cavalier king charles', 1),
(10, 'Spitz nain allemand', 1),
(11, 'Shiba-inu', 1),
(12, 'Boxer', 1),
(13, 'Maine coon', 2),
(14, 'British shorthair', 2),
(15, 'Chartreux', 2),
(16, 'Sphynx', 2),
(17, 'American curl', 2),
(18, 'Norvégien', 2),
(19, 'Persan', 2),
(20, 'Albinos', 3),
(21, 'Hamster Doré', 4),
(22, 'Hamster Russe', 4),
(23, 'Hamster Chinois', 4),
(24, 'Hamster Sibérien', 4),
(25, 'Rat Noir', 8),
(26, 'Tortue égyptienne', 7),
(27, 'Tortue marginale', 7),
(28, 'Rex', 5),
(29, 'Polonais', 5),
(30, 'Géant papillon français', 5),
(31, 'Nain bélier', 5),
(32, 'Fermier', 5),
(33, 'Alaska', 5),
(34, 'Ara', 6),
(35, 'Souris grise', 9),
(36, 'Souris Yellow', 9),
(37, 'Péruvien', 10),
(38, 'Abyssinien', 10),
(39, 'Skinny', 10),
(40, 'Shelty', 10),
(41, 'Domestique', 11),
(42, 'Silver', 12);

-- --------------------------------------------------------

--
-- Structure de la table `Species`
--

CREATE TABLE `Species` (
  `speciesId` int(11) NOT NULL,
  `speciesName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Species`
--

INSERT INTO `Species` (`speciesId`, `speciesName`) VALUES
(1, 'Chien'),
(2, 'Chat'),
(3, 'Serpent'),
(4, 'Hamster'),
(5, 'Lapin'),
(6, 'Oiseau'),
(7, 'Tortue'),
(8, 'Rat'),
(9, 'Souris'),
(10, 'Cochon d\'Inde'),
(11, 'Chinchilla'),
(12, 'Furet');

-- --------------------------------------------------------

--
-- Structure de la table `Threat`
--

CREATE TABLE `Threat` (
  `threatId` int(11) NOT NULL,
  `threatName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Threat`
--

INSERT INTO `Threat` (`threatId`, `threatName`) VALUES
(1, 'Faible'),
(2, 'Moyen'),
(3, 'Elevé');

-- --------------------------------------------------------

--
-- Structure de la table `TimeSlot`
--

CREATE TABLE `TimeSlot` (
  `timeSlotId` int(11) NOT NULL,
  `startHour` time DEFAULT NULL,
  `endHour` time DEFAULT NULL,
  `dayName` varchar(50) NOT NULL,
  `typeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `TimeSlot`
--

INSERT INTO `TimeSlot` (`timeSlotId`, `startHour`, `endHour`, `dayName`, `typeId`) VALUES
(1, '08:00:00', '08:15:00', 'Lundi', 1),
(2, '08:15:00', '08:30:00', 'Lundi', 1),
(3, '08:30:00', '08:45:00', 'Lundi', 1),
(4, '08:45:00', '09:00:00', 'Lundi', 1),
(5, '09:00:00', '09:15:00', 'Lundi', 1),
(6, '09:15:00', '09:30:00', 'Lundi', 1),
(7, '09:30:00', '09:45:00', 'Lundi', 1),
(8, '09:45:00', '10:00:00', 'Lundi', 1),
(9, '10:00:00', '10:15:00', 'Lundi', 1),
(10, '10:15:00', '10:30:00', 'Lundi', 1),
(11, '10:30:00', '10:45:00', 'Lundi', 1),
(12, '10:45:00', '11:00:00', 'Lundi', 1),
(13, '11:00:00', '11:15:00', 'Lundi', 1),
(14, '11:15:00', '11:30:00', 'Lundi', 1),
(15, '11:30:00', '11:45:00', 'Lundi', 1),
(16, '11:45:00', '12:00:00', 'Lundi', 1),
(17, '13:30:00', '13:45:00', 'Lundi', 1),
(18, '13:45:00', '14:00:00', 'Lundi', 1),
(19, '14:00:00', '14:15:00', 'Lundi', 1),
(20, '14:15:00', '14:30:00', 'Lundi', 1),
(21, '14:30:00', '14:45:00', 'Lundi', 1),
(22, '14:45:00', '15:00:00', 'Lundi', 1),
(23, '15:00:00', '15:15:00', 'Lundi', 1),
(24, '15:15:00', '15:30:00', 'Lundi', 1),
(25, '15:30:00', '15:45:00', 'Lundi', 1),
(26, '15:45:00', '16:00:00', 'Lundi', 1),
(27, '16:00:00', '16:15:00', 'Lundi', 1),
(28, '16:15:00', '16:30:00', 'Lundi', 1),
(29, '16:30:00', '16:45:00', 'Lundi', 1),
(30, '16:45:00', '17:00:00', 'Lundi', 1),
(31, '17:00:00', '17:15:00', 'Lundi', 1),
(32, '17:15:00', '17:30:00', 'Lundi', 1),
(33, '17:30:00', '17:45:00', 'Lundi', 1),
(34, '17:45:00', '18:00:00', 'Lundi', 1),
(35, '18:00:00', '18:15:00', 'Lundi', 1),
(36, '08:00:00', '08:15:00', 'Mardi', 1),
(37, '08:15:00', '08:30:00', 'Mardi', 1),
(38, '08:30:00', '08:45:00', 'Mardi', 1),
(39, '08:45:00', '09:00:00', 'Mardi', 1),
(40, '09:00:00', '09:15:00', 'Mardi', 1),
(41, '09:15:00', '09:30:00', 'Mardi', 1),
(42, '09:30:00', '09:45:00', 'Mardi', 1),
(43, '09:45:00', '10:00:00', 'Mardi', 1),
(44, '10:00:00', '10:15:00', 'Mardi', 1),
(45, '10:15:00', '10:30:00', 'Mardi', 1),
(46, '10:30:00', '10:45:00', 'Mardi', 1),
(47, '10:45:00', '11:00:00', 'Mardi', 1),
(48, '11:00:00', '11:15:00', 'Mardi', 1),
(49, '11:15:00', '11:30:00', 'Mardi', 1),
(50, '11:30:00', '11:45:00', 'Mardi', 1),
(51, '11:45:00', '12:00:00', 'Mardi', 1),
(52, '13:30:00', '13:45:00', 'Mardi', 1),
(53, '13:45:00', '14:00:00', 'Mardi', 1),
(54, '14:00:00', '14:15:00', 'Mardi', 1),
(55, '14:15:00', '14:30:00', 'Mardi', 1),
(56, '14:30:00', '14:45:00', 'Mardi', 1),
(57, '14:45:00', '15:00:00', 'Mardi', 1),
(58, '15:00:00', '15:15:00', 'Mardi', 1),
(59, '15:15:00', '15:30:00', 'Mardi', 1),
(60, '15:30:00', '15:45:00', 'Mardi', 1),
(61, '15:45:00', '16:00:00', 'Mardi', 1),
(62, '16:00:00', '16:15:00', 'Mardi', 1),
(63, '16:15:00', '16:30:00', 'Mardi', 1),
(64, '16:30:00', '16:45:00', 'Mardi', 1),
(65, '16:45:00', '17:00:00', 'Mardi', 1),
(66, '17:00:00', '17:15:00', 'Mardi', 1),
(67, '17:15:00', '17:30:00', 'Mardi', 1),
(68, '17:30:00', '17:45:00', 'Mardi', 1),
(69, '17:45:00', '18:00:00', 'Mardi', 1),
(70, '08:00:00', '08:15:00', 'Mercredi', 1),
(71, '08:15:00', '08:30:00', 'Mercredi', 1),
(72, '08:30:00', '08:45:00', 'Mercredi', 1),
(73, '08:45:00', '09:00:00', 'Mercredi', 1),
(74, '09:00:00', '09:15:00', 'Mercredi', 1),
(75, '09:15:00', '09:30:00', 'Mercredi', 1),
(76, '09:30:00', '09:45:00', 'Mercredi', 1),
(77, '09:45:00', '10:00:00', 'Mercredi', 1),
(78, '10:00:00', '10:15:00', 'Mercredi', 1),
(79, '10:15:00', '10:30:00', 'Mercredi', 1),
(80, '10:30:00', '10:45:00', 'Mercredi', 1),
(81, '10:45:00', '11:00:00', 'Mercredi', 1),
(82, '11:00:00', '11:15:00', 'Mercredi', 1),
(83, '11:15:00', '11:30:00', 'Mercredi', 1),
(84, '11:30:00', '11:45:00', 'Mercredi', 1),
(85, '11:45:00', '12:00:00', 'Mercredi', 1),
(86, '13:30:00', '13:45:00', 'Mercredi', 1),
(87, '13:45:00', '14:00:00', 'Mercredi', 1),
(88, '14:00:00', '14:15:00', 'Mercredi', 1),
(89, '14:15:00', '14:30:00', 'Mercredi', 1),
(90, '14:30:00', '14:45:00', 'Mercredi', 1),
(91, '14:45:00', '15:00:00', 'Mercredi', 1),
(92, '15:00:00', '15:15:00', 'Mercredi', 1),
(93, '15:15:00', '15:30:00', 'Mercredi', 1),
(94, '15:30:00', '15:45:00', 'Mercredi', 1),
(95, '15:45:00', '16:00:00', 'Mercredi', 1),
(96, '16:00:00', '16:15:00', 'Mercredi', 1),
(97, '16:15:00', '16:30:00', 'Mercredi', 1),
(98, '16:30:00', '16:45:00', 'Mercredi', 1),
(99, '16:45:00', '17:00:00', 'Mercredi', 1),
(100, '17:00:00', '17:15:00', 'Mercredi', 1),
(101, '17:15:00', '17:30:00', 'Mercredi', 1),
(102, '17:30:00', '17:45:00', 'Mercredi', 1),
(103, '17:45:00', '18:00:00', 'Mercredi', 1),
(104, '08:00:00', '08:15:00', 'Jeudi', 1),
(105, '08:15:00', '08:30:00', 'Jeudi', 1),
(106, '08:30:00', '08:45:00', 'Jeudi', 1),
(107, '08:45:00', '09:00:00', 'Jeudi', 1),
(108, '09:00:00', '09:15:00', 'Jeudi', 1),
(109, '09:15:00', '09:30:00', 'Jeudi', 1),
(110, '09:30:00', '09:45:00', 'Jeudi', 1),
(111, '09:45:00', '10:00:00', 'Jeudi', 1),
(112, '10:00:00', '10:15:00', 'Jeudi', 1),
(113, '10:15:00', '10:30:00', 'Jeudi', 1),
(114, '10:30:00', '10:45:00', 'Jeudi', 1),
(115, '10:45:00', '11:00:00', 'Jeudi', 1),
(116, '11:00:00', '11:15:00', 'Jeudi', 1),
(117, '11:15:00', '11:30:00', 'Jeudi', 1),
(118, '11:30:00', '11:45:00', 'Jeudi', 1),
(119, '11:45:00', '12:00:00', 'Jeudi', 1),
(120, '13:30:00', '13:45:00', 'Jeudi', 1),
(121, '13:45:00', '14:00:00', 'Jeudi', 1),
(122, '14:00:00', '14:15:00', 'Jeudi', 1),
(123, '14:15:00', '14:30:00', 'Jeudi', 1),
(124, '14:30:00', '14:45:00', 'Jeudi', 1),
(125, '14:45:00', '15:00:00', 'Jeudi', 1),
(126, '15:00:00', '15:15:00', 'Jeudi', 1),
(127, '15:15:00', '15:30:00', 'Jeudi', 1),
(128, '15:30:00', '15:45:00', 'Jeudi', 1),
(129, '15:45:00', '16:00:00', 'Jeudi', 1),
(130, '16:00:00', '16:15:00', 'Jeudi', 1),
(131, '16:15:00', '16:30:00', 'Jeudi', 1),
(132, '16:30:00', '16:45:00', 'Jeudi', 1),
(133, '16:45:00', '17:00:00', 'Jeudi', 1),
(134, '17:00:00', '17:15:00', 'Jeudi', 1),
(135, '17:15:00', '17:30:00', 'Jeudi', 1),
(136, '17:30:00', '17:45:00', 'Jeudi', 1),
(137, '17:45:00', '18:00:00', 'Jeudi', 1),
(138, '08:00:00', '08:15:00', 'Vendredi', 1),
(139, '08:15:00', '08:30:00', 'Vendredi', 1),
(140, '08:30:00', '08:45:00', 'Vendredi', 1),
(141, '08:45:00', '09:00:00', 'Vendredi', 1),
(142, '09:00:00', '09:15:00', 'Vendredi', 1),
(143, '09:15:00', '09:30:00', 'Vendredi', 1),
(144, '09:30:00', '09:45:00', 'Vendredi', 1),
(145, '09:45:00', '10:00:00', 'Vendredi', 1),
(146, '10:00:00', '10:15:00', 'Vendredi', 1),
(147, '10:15:00', '10:30:00', 'Vendredi', 1),
(148, '10:30:00', '10:45:00', 'Vendredi', 1),
(149, '10:45:00', '11:00:00', 'Vendredi', 1),
(150, '11:00:00', '11:15:00', 'Vendredi', 1),
(151, '11:15:00', '11:30:00', 'Vendredi', 1),
(152, '11:30:00', '11:45:00', 'Vendredi', 1),
(153, '11:45:00', '12:00:00', 'Vendredi', 1),
(154, '13:30:00', '13:45:00', 'Vendredi', 1),
(155, '13:45:00', '14:00:00', 'Vendredi', 1),
(156, '14:00:00', '14:15:00', 'Vendredi', 1),
(157, '14:15:00', '14:30:00', 'Vendredi', 1),
(158, '14:30:00', '14:45:00', 'Vendredi', 1),
(159, '14:45:00', '15:00:00', 'Vendredi', 1),
(160, '15:00:00', '15:15:00', 'Vendredi', 1),
(161, '15:15:00', '15:30:00', 'Vendredi', 1),
(162, '15:30:00', '15:45:00', 'Vendredi', 1),
(163, '15:45:00', '16:00:00', 'Vendredi', 1),
(164, '16:00:00', '16:15:00', 'Vendredi', 1),
(165, '16:15:00', '16:30:00', 'Vendredi', 1),
(166, '16:30:00', '16:45:00', 'Vendredi', 1),
(167, '16:45:00', '17:00:00', 'Vendredi', 1),
(168, '17:00:00', '17:15:00', 'Vendredi', 1),
(169, '17:15:00', '17:30:00', 'Vendredi', 1),
(170, '17:30:00', '17:45:00', 'Vendredi', 1),
(171, '17:45:00', '18:00:00', 'Vendredi', 1),
(172, '08:00:00', '08:15:00', 'Samedi', 1),
(173, '08:15:00', '08:30:00', 'Samedi', 1),
(174, '08:30:00', '08:45:00', 'Samedi', 1),
(175, '08:45:00', '09:00:00', 'Samedi', 1),
(176, '09:00:00', '09:15:00', 'Samedi', 1),
(177, '09:15:00', '09:30:00', 'Samedi', 1),
(178, '09:30:00', '09:45:00', 'Samedi', 1),
(179, '09:45:00', '10:00:00', 'Samedi', 1),
(180, '10:00:00', '10:15:00', 'Samedi', 1),
(181, '10:15:00', '10:30:00', 'Samedi', 1),
(182, '10:30:00', '10:45:00', 'Samedi', 1),
(183, '10:45:00', '11:00:00', 'Samedi', 1),
(184, '11:00:00', '11:15:00', 'Samedi', 1),
(185, '11:15:00', '11:30:00', 'Samedi', 1),
(186, '11:30:00', '11:45:00', 'Samedi', 1),
(187, '11:45:00', '12:00:00', 'Samedi', 1),
(188, '13:30:00', '13:45:00', 'Samedi', 1),
(189, '13:45:00', '14:00:00', 'Samedi', 1),
(190, '14:00:00', '14:15:00', 'Samedi', 1),
(191, '14:15:00', '14:30:00', 'Samedi', 1),
(192, '14:30:00', '14:45:00', 'Samedi', 1),
(193, '14:45:00', '15:00:00', 'Samedi', 1),
(194, '15:00:00', '15:15:00', 'Samedi', 1),
(195, '15:15:00', '15:30:00', 'Samedi', 1),
(196, '15:30:00', '15:45:00', 'Samedi', 1),
(197, '15:45:00', '16:00:00', 'Samedi', 1),
(209, '08:00:00', '08:30:00', 'Mardi', 2),
(210, '09:00:00', '09:30:00', 'Mardi', 2),
(211, '10:00:00', '10:30:00', 'Mardi', 2),
(212, '11:00:00', '11:30:00', 'Mardi', 2),
(213, '12:00:00', '12:30:00', 'Mardi', 2),
(214, '13:00:00', '13:30:00', 'Vendredi', 2),
(215, '14:00:00', '14:30:00', 'Vendredi', 2),
(216, '15:00:00', '15:30:00', 'Vendredi', 2),
(217, '16:00:00', '16:30:00', 'Vendredi', 2),
(218, '17:00:00', '17:30:00', 'Vendredi', 2),
(219, '09:30:00', '10:00:00', 'Jeudi', 2),
(220, '10:30:00', '11:00:00', 'Jeudi', 2);

-- --------------------------------------------------------

--
-- Structure de la table `TimeSlotType`
--

CREATE TABLE `TimeSlotType` (
  `typeId` int(11) NOT NULL,
  `typeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `TimeSlotType`
--

INSERT INTO `TimeSlotType` (`typeId`, `typeName`) VALUES
(1, 'CLINIQUE'),
(2, 'DOMICILE');

-- --------------------------------------------------------

--
-- Structure de la table `Users`
--

CREATE TABLE `Users` (
  `userId` varchar(50) NOT NULL,
  `cp` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `rue` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) CHARACTER SET utf8 NOT NULL,
  `isAdmin` int(11) NOT NULL DEFAULT 0,
  `isVeto` int(11) NOT NULL DEFAULT 0,
  `comment` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Users`
--

INSERT INTO `Users` (`userId`, `cp`, `city`, `rue`, `firstName`, `lastName`, `phone`, `email`, `password`, `isAdmin`, `isVeto`, `comment`) VALUES
('0aWlxVCXCi8Q', '51100', 'Reims', '30 rue paul rehnn', 'Junio', 'Spol', '0678463876', 'spolJunio@orange.fr', '0416a26ba554334286b1954918ecad7ba6c33575b49df915ff3367b5cef7ecd93b1f0b436636667b27b363011543971f1c81c3151d5ef72733501c1ff33c34af', 0, 0, NULL),
('2UcgaaYx3mUI', NULL, NULL, NULL, 'Bobby', 'BobJunior', '0689453569', 'bob-junior@bob.ink', '6aadf3fda700fad0fb2021b07d975a123336338f5b0333768ec4563698e7f828c9f8dcfac1e05e780791bfbf9e9153ca185123bae5854968e47752f91951db7a', 0, 0, NULL),
('5V7yDEtJX5c4', '51100', 'Reims', '30 rue bert', 'abc', 'abc', '0680974638', 'abc@orange.fr', 'ddaf35a193617abacc417349ae20413112e6fa4e89a97ea20a9eeee64b55d39a2192992a274fc1a836ba3c23a3feebbd454d4423643ce80e2a9ac94fa54ca49f', 0, 0, NULL),
('6rh5PoFBxyl7', NULL, 'Reims', 'Chemin des Rouliers', 'bob', 'bob', '0645356565', 'bob@bob.fr', '0416a26ba554334286b1954918ecad7ba6c33575b49df915ff3367b5cef7ecd93b1f0b436636667b27b363011543971f1c81c3151d5ef72733501c1ff33c34af', 1, 1, NULL),
('9hlzWFmmfmfG', '57100', 'Thionville', '76 rue du Faubourg National', 'Pedro', 'BERMUDA', '06 54 32 10 98', 'bermuda.pedro@bermuda.fr', '3f2a509e9a3d3bc35290604bc904a713d2e3999e907e02f297b31bfb603bbfdd866c17e4f6d87d4451c8eb0f88226a8d8fd10e8128fcd977e30d7a101a3053cd', 0, 0, NULL),
('bAkijbcEFg0Z', '51100', 'Reims', '3 avenue Paul', 'Bobba', 'JAZ', '0684935478', 'jazBobba@orange.fr', '0416a26ba554334286b1954918ecad7ba6c33575b49df915ff3367b5cef7ecd93b1f0b436636667b27b363011543971f1c81c3151d5ef72733501c1ff33c34af', 0, 0, NULL),
('CLtgWy7AlWAP', '51100', 'reims', '30 rue pasteur', 'abc3', 'abc3', '0678930567', 'abc3@orange.fr', '8ecdd19fb08ce231bb42a612e864208bdf74ac6861bb3ffd5190e261c4d5bd099e4acbe707fe326934c41a8601c8c46feae0ce489f6e17e228069cd2ff076944', 0, 0, NULL),
('EaX3tYZQfAo6', '02310', 'spartan', '38 hugo zbip', 'JACK', 'JEAN', '0698496632', 'jeanjack@jackja.fr', '0416a26ba554334286b1954918ecad7ba6c33575b49df915ff3367b5cef7ecd93b1f0b436636667b27b363011543971f1c81c3151d5ef72733501c1ff33c34af', 0, 0, NULL),
('exMzQcIgoGHB', '51100', 'Reims', '2 impasse tru', 'marine', 'legendre', '0687360506', 'marine.leg02@gmail.com', '0416a26ba554334286b1954918ecad7ba6c33575b49df915ff3367b5cef7ecd93b1f0b436636667b27b363011543971f1c81c3151d5ef72733501c1ff33c34af', 0, 0, NULL),
('mRgEkL0tHguy', '51100', 'MowtyCity', '32 Split', 'Rick', 'Sanchez', '0650563178', 'ricketmorty@orange.fr', 'c98e5f142b42ee73745d73a916b274cc4e3bd71df9099e6e3d7ae48a6cfe23e216c1666a3c16be6106a76d63d1aa43e90d83ffdf05d258c6d6f5af07892560d1', 0, 0, NULL),
('qgF86R2fL4r5', NULL, NULL, NULL, 'Ricardo', 'El Veto', '0745869563', 'ricardo@veto.fr', '0416a26ba554334286b1954918ecad7ba6c33575b49df915ff3367b5cef7ecd93b1f0b436636667b27b363011543971f1c81c3151d5ef72733501c1ff33c34af', 0, 1, NULL),
('t9UvXOzIa5Kf', NULL, NULL, NULL, 'Corentin', 'Levalet', '07 82 84 76 98', 'corentinlevalet@gmx.fr', 'a7117111e1222150ce902ca3cb25fa8b4e1ecb9a6c03d9e21fa7c110212b9e1ab467a7415fd1e57fecc7c2d8bd3dfe3d3af4cd2e8097ec611976bf39e82e0c9a', 0, 0, NULL),
('TrKiy6J26lqh', NULL, NULL, NULL, 'test', 'test', '0606060606', 'test@mail.fr', 'bbfd091454b4f71233daaa526ddc433d01c0b958ac29e3462299e1398b2bfa9a1aaa2ac4c6a318d0f288a9874f069043c33e60c97a808793abbd37b49de074b6', 0, 0, NULL),
('uB4Hnzq8MBzW', '69140', 'Rillieux-la-pape', '18 rue Gustave Eiffel', 'Alice', 'BARBIER', '07 85 46 59 63', 'barbier.alice@gmail.com', '408b27d3097eea5a46bf2ab6433a7234a33d5e49957b13ec7acc2ca08e1a13c75272c90c8d3385d47ede5420a7a9623aad817d9f8a70bd100a0acea7400daa59', 0, 0, NULL),
('VQ6pxc8iPZ4N', '52150', 'New York', '2 Avenue des ordures, égouts n°2', 'Splinter', 'LERAT', '01 01 01 01 01', 'lerat.splinter@tortue.fr', '86f82560a611a83625f54452f4e8c281bd595dfa73b113475b1a68bbfa82f9daf92f8bc0a1266327055763111ada61612c2e3494cef808bd2d5e08078d02ff0e', 0, 0, NULL),
('vvhJjXx5rneJ', '06700', 'Saint-laurent-du-var', '12 avenue du Marechal Juin', 'Robert', 'BOUCHON', '06 56 95 68 64', 'bonchon.robert@orange.fr', '5a3a208f91f046da16804b818b3b9e8612b0246ea5efbb7207620a8b4ca026392fcf05ad37f1883f09db46786711dbcc528483a0d6cc5e4d5ee18af9414210cb', 0, 0, NULL),
('xbpDuhzzl4Af', '11111', '12', '&lt;u&gt;Wééééé&lt;/u&gt;', 'test12', 'test12', '0102030405', 'test12@mail.fr', 'e6e8ba72bf2bab68c923599a08489c6f3a35018e870d490fa25b4c2a2d82361093b9a8f1d0cdd02e5a7dd5e714dc090263e2e90af3d3d861c056f28a4adb2d95', 0, 0, NULL),
('xE7lwx9SdS89', '51100', 'Reims', '36 rue abc', 'abc2', 'abc2', '0684963180', 'abc2@orange.fr', 'ddaf35a193617abacc417349ae20413112e6fa4e89a97ea20a9eeee64b55d39a2192992a274fc1a836ba3c23a3feebbd454d4423643ce80e2a9ac94fa54ca49f', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Vaccinated`
--

CREATE TABLE `Vaccinated` (
  `idVaccine` varchar(50) NOT NULL,
  `idAnimal` varchar(50) NOT NULL,
  `dateVaccine` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Vaccinated`
--

INSERT INTO `Vaccinated` (`idVaccine`, `idAnimal`, `dateVaccine`) VALUES
('1', '001', '2021-12-27'),
('2', '001', '2021-12-27'),
('3', '001', '2021-12-27');

-- --------------------------------------------------------

--
-- Structure de la table `Vaccine`
--

CREATE TABLE `Vaccine` (
  `idVaccine` varchar(50) NOT NULL,
  `idSpecies` varchar(50) NOT NULL,
  `vaccineName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Vaccine`
--

INSERT INTO `Vaccine` (`idVaccine`, `idSpecies`, `vaccineName`) VALUES
('1', '1', 'CH (Maladie carré et hépatite de rubarth)'),
('2', '1', 'P (parvovirose)'),
('3', '1', 'PI (parainfluenza)'),
('4', '1', 'L4 (leptospirose)'),
('5', '1', 'R (rage)'),
('6', '2', 'TC (Tyfus et Coriza)'),
('7', '2', 'L (leucose)'),
('8', '2', 'R (rage)'),
('9', '5', 'VHD (myxomatose et la maladie hémorragique)');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ActeOuProduit`
--
ALTER TABLE `ActeOuProduit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Animal`
--
ALTER TABLE `Animal`
  ADD PRIMARY KEY (`animalId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `ThreatId` (`threatId`),
  ADD KEY `genderId` (`genderId`),
  ADD KEY `raceId` (`raceId`);

--
-- Index pour la table `Command`
--
ALTER TABLE `Command`
  ADD PRIMARY KEY (`commandId`);

--
-- Index pour la table `Concern`
--
ALTER TABLE `Concern`
  ADD PRIMARY KEY (`meetingId`,`timeSlotId`),
  ADD KEY `concern_fk_timeslot` (`timeSlotId`);

--
-- Index pour la table `Content`
--
ALTER TABLE `Content`
  ADD PRIMARY KEY (`productId`,`commandId`),
  ADD KEY `commandId` (`commandId`);

--
-- Index pour la table `GenderStatus`
--
ALTER TABLE `GenderStatus`
  ADD PRIMARY KEY (`genderId`);

--
-- Index pour la table `Horaire`
--
ALTER TABLE `Horaire`
  ADD PRIMARY KEY (`userId`,`timeSlotId`),
  ADD KEY `timeSlotId` (`timeSlotId`);

--
-- Index pour la table `Meeting`
--
ALTER TABLE `Meeting`
  ADD PRIMARY KEY (`meetingId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `animalId` (`animalId`),
  ADD KEY `fk_vetoId` (`vetoId`),
  ADD KEY `speciesId` (`speciesId`);

--
-- Index pour la table `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`newsId`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`productId`);

--
-- Index pour la table `Race`
--
ALTER TABLE `Race`
  ADD PRIMARY KEY (`raceId`),
  ADD KEY `speciesId` (`speciesId`);

--
-- Index pour la table `Species`
--
ALTER TABLE `Species`
  ADD PRIMARY KEY (`speciesId`);

--
-- Index pour la table `Threat`
--
ALTER TABLE `Threat`
  ADD PRIMARY KEY (`threatId`);

--
-- Index pour la table `TimeSlot`
--
ALTER TABLE `TimeSlot`
  ADD PRIMARY KEY (`timeSlotId`),
  ADD KEY `typeId` (`typeId`);

--
-- Index pour la table `TimeSlotType`
--
ALTER TABLE `TimeSlotType`
  ADD PRIMARY KEY (`typeId`);

--
-- Index pour la table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userId`);

--
-- Index pour la table `Vaccinated`
--
ALTER TABLE `Vaccinated`
  ADD PRIMARY KEY (`idVaccine`,`idAnimal`);

--
-- Index pour la table `Vaccine`
--
ALTER TABLE `Vaccine`
  ADD PRIMARY KEY (`idVaccine`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ActeOuProduit`
--
ALTER TABLE `ActeOuProduit`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT pour la table `TimeSlot`
--
ALTER TABLE `TimeSlot`
  MODIFY `timeSlotId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Animal`
--
ALTER TABLE `Animal`
  ADD CONSTRAINT `Animal_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`),
  ADD CONSTRAINT `Animal_ibfk_2` FOREIGN KEY (`ThreatId`) REFERENCES `Threat` (`ThreatId`),
  ADD CONSTRAINT `Animal_ibfk_3` FOREIGN KEY (`genderId`) REFERENCES `GenderStatus` (`genderId`),
  ADD CONSTRAINT `Animal_ibfk_4` FOREIGN KEY (`raceId`) REFERENCES `Race` (`raceId`);

--
-- Contraintes pour la table `Concern`
--
ALTER TABLE `Concern`
  ADD CONSTRAINT `Concern_ibfk_1` FOREIGN KEY (`meetingId`) REFERENCES `Meeting` (`meetingId`),
  ADD CONSTRAINT `Concern_ibfk_2` FOREIGN KEY (`timeSlotId`) REFERENCES `TimeSlot` (`timeSlotId`),
  ADD CONSTRAINT `concern_fk_meeting` FOREIGN KEY (`meetingId`) REFERENCES `Meeting` (`meetingId`),
  ADD CONSTRAINT `concern_fk_timeslot` FOREIGN KEY (`timeSlotId`) REFERENCES `TimeSlot` (`timeSlotId`);

--
-- Contraintes pour la table `Content`
--
ALTER TABLE `Content`
  ADD CONSTRAINT `Content_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `Products` (`productId`),
  ADD CONSTRAINT `Content_ibfk_2` FOREIGN KEY (`commandId`) REFERENCES `Command` (`commandId`);

--
-- Contraintes pour la table `Horaire`
--
ALTER TABLE `Horaire`
  ADD CONSTRAINT `Horaire_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`),
  ADD CONSTRAINT `Horaire_ibfk_2` FOREIGN KEY (`timeSlotId`) REFERENCES `TimeSlot` (`timeSlotId`);

--
-- Contraintes pour la table `Meeting`
--
ALTER TABLE `Meeting`
  ADD CONSTRAINT `Meeting_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`),
  ADD CONSTRAINT `Meeting_ibfk_2` FOREIGN KEY (`animalId`) REFERENCES `Animal` (`animalId`),
  ADD CONSTRAINT `Meeting_ibfk_3` FOREIGN KEY (`speciesId`) REFERENCES `Species` (`speciesId`),
  ADD CONSTRAINT `fk_vetoId` FOREIGN KEY (`vetoId`) REFERENCES `Users` (`userId`);

--
-- Contraintes pour la table `News`
--
ALTER TABLE `News`
  ADD CONSTRAINT `News_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`userId`);

--
-- Contraintes pour la table `Race`
--
ALTER TABLE `Race`
  ADD CONSTRAINT `Race_ibfk_1` FOREIGN KEY (`speciesId`) REFERENCES `Species` (`speciesId`);

--
-- Contraintes pour la table `TimeSlot`
--
ALTER TABLE `TimeSlot`
  ADD CONSTRAINT `TimeSlot_ibfk_1` FOREIGN KEY (`typeId`) REFERENCES `TimeSlotType` (`typeId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
