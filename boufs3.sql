-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 29 avr. 2026 à 21:01
-- Version du serveur : 9.1.0
-- Version de PHP : 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boufs3`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_produit`
--

DROP TABLE IF EXISTS `categorie_produit`;
CREATE TABLE IF NOT EXISTS `categorie_produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_produit`
--

INSERT INTO `categorie_produit` (`id`, `nom`) VALUES
(5, 'Fruits'),
(4, 'Produits Laitiers'),
(6, 'Poissons'),
(7, 'Sauces et Huiles'),
(8, 'Pâtes et céreales'),
(9, 'Condiments et épices'),
(10, 'Viandes'),
(11, 'Fromages'),
(12, 'Légumes'),
(13, 'Autres'),
(14, 'Charcuterie'),
(15, 'Fruits secs'),
(16, 'Herbes Aromatiques'),
(17, 'Hygiène'),
(18, 'Entretien'),
(19, 'Pâtisserie'),
(20, 'Frais');

-- --------------------------------------------------------

--
-- Structure de la table `categorie_recette`
--

DROP TABLE IF EXISTS `categorie_recette`;
CREATE TABLE IF NOT EXISTS `categorie_recette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_recette`
--

INSERT INTO `categorie_recette` (`id`, `nom`) VALUES
(5, 'tartes et pizzas'),
(4, 'salades'),
(6, 'chaud'),
(7, 'froid'),
(8, 'végétarien'),
(9, 'dessert'),
(10, 'poisson'),
(11, 'one pot');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260419171113', '2026-04-19 17:11:17', 101),
('DoctrineMigrations\\Version20260426195629', '2026-04-26 19:56:37', 160),
('DoctrineMigrations\\Version20260426195747', '2026-04-26 19:57:52', 149),
('DoctrineMigrations\\Version20260426200118', '2026-04-26 20:01:24', 125),
('DoctrineMigrations\\Version20260426201239', '2026-04-26 20:12:44', 193),
('DoctrineMigrations\\Version20260426201825', '2026-04-26 20:18:30', 223),
('DoctrineMigrations\\Version20260426203712', '2026-04-26 20:37:16', 162),
('DoctrineMigrations\\Version20260427203225', '2026-04-27 20:32:35', 265),
('DoctrineMigrations\\Version20260428211032', '2026-04-28 21:10:41', 240),
('DoctrineMigrations\\Version20260429085138', '2026-04-29 08:51:48', 219);

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `quantite` double NOT NULL,
  `recette_id` int NOT NULL,
  `produit_id` int NOT NULL,
  `unitee_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6BAF787089312FE9` (`recette_id`),
  KEY `IDX_6BAF7870F347EFB` (`produit_id`),
  KEY `IDX_6BAF7870D3EB8572` (`unitee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `quantite`, `recette_id`, `produit_id`, `unitee_id`) VALUES
(1, 3, 1, 1, 1),
(2, 4, 1, 2, 6),
(3, 1, 1, 3, 1),
(4, 1, 1, 4, 1),
(5, 2, 1, 22, 1),
(6, 150, 1, 40, 2),
(7, 2, 1, 46, 5),
(8, 2, 1, 47, 4),
(9, 1, 1, 48, 4),
(10, 1, 1, 69, 5),
(11, 2, 2, 9, 1),
(12, 4, 2, 10, 1),
(13, 1, 2, 8, 1),
(14, 2, 2, 23, 1),
(15, 150, 2, 40, 2),
(16, 2.5, 2, 79, 1),
(17, 2, 3, 1, 1),
(18, 2, 3, 14, 1),
(19, 2, 3, 24, 1),
(20, 1, 3, 37, 9),
(21, 200, 3, 42, 2),
(22, 1, 3, 62, 1),
(23, 100, 4, 13, 2),
(24, 15, 4, 12, 1),
(25, 6, 4, 67, 1),
(26, 2, 4, 24, 1),
(27, 200, 4, 43, 2),
(28, 100, 4, 60, 3),
(29, 80, 4, 80, 2),
(30, 1, 5, 11, 1),
(31, 250, 5, 81, 2),
(32, 1, 5, 18, 1),
(33, 3, 5, 1, 1),
(34, 1, 5, 25, 9),
(35, 150, 5, 82, 2),
(36, 200, 5, 43, 2),
(37, 200, 5, 60, 3),
(38, 1, 6, 65, 1),
(39, 2, 6, 8, 1),
(40, 3, 6, 1, 1),
(41, 10, 6, 5, 2),
(42, 1, 6, 53, 10),
(43, 150, 6, 66, 2),
(44, 2, 6, 29, 1),
(45, 1, 6, 57, 4),
(46, 10, 7, 54, 6),
(47, 1, 7, 8, 1),
(48, 2, 7, 24, 1),
(49, 2, 7, 84, 1),
(55, 50, 7, 35, 2),
(51, 320, 7, 44, 2),
(52, 1, 7, 63, 1),
(53, 100, 7, 77, 2),
(54, 20, 7, 78, 2),
(56, 150, 7, 86, 3),
(57, 20, 7, 70, 2),
(58, 80, 7, 87, 3),
(59, 2, 8, 1, 1),
(60, 10, 8, 5, 2),
(61, 1, 8, 21, 10),
(62, 350, 8, 30, 2),
(63, 150, 8, 40, 2),
(64, 2, 8, 47, 5),
(65, 1, 8, 48, 5),
(66, 1, 8, 71, 5),
(67, 1, 8, 69, 5),
(68, 2, 9, 16, 1),
(69, 2, 9, 1, 1),
(70, 1, 9, 17, 1),
(71, 1, 9, 26, 1),
(72, 1, 9, 38, 1),
(73, 200, 9, 40, 2),
(74, 1, 10, 8, 1),
(75, 100, 10, 13, 2),
(76, 150, 10, 40, 2),
(77, 1, 10, 46, 4),
(78, 2, 10, 50, 5),
(79, 2, 10, 51, 5),
(80, 250, 10, 88, 2),
(81, 100, 10, 60, 3),
(82, 2, 11, 9, 1),
(83, 1, 11, 89, 11),
(84, 1, 11, 8, 1),
(85, 3, 11, 1, 1),
(86, 4, 11, 31, 1),
(87, 1, 11, 25, 9),
(88, 300, 11, 45, 2),
(89, 1, 11, 62, 1),
(90, 2, 12, 9, 1),
(91, 1, 12, 8, 1),
(92, 1, 12, 16, 1),
(93, 1, 12, 90, 1),
(94, 2, 12, 41, 1),
(95, 2, 13, 16, 1),
(96, 3, 13, 1, 1),
(97, 1, 13, 25, 9),
(98, 1, 13, 85, 1),
(99, 4, 13, 55, 4),
(100, 2, 13, 57, 5),
(101, 100, 13, 60, 3),
(102, 1, 13, 73, 1),
(103, 1, 14, 9, 1),
(104, 1, 14, 64, 1),
(105, 1, 14, 4, 1),
(106, 8, 14, 92, 1),
(107, 2, 14, 33, 1),
(108, 150, 14, 40, 2),
(109, 2, 14, 47, 5),
(110, 1, 14, 58, 5),
(111, 2, 14, 48, 5),
(112, 1, 14, 91, 4),
(113, 1, 14, 93, 5),
(114, 2, 15, 6, 1),
(115, 100, 15, 13, 2),
(116, 1, 15, 26, 1),
(117, 10, 15, 35, 2),
(118, 150, 15, 42, 2),
(119, 1, 15, 63, 1),
(120, 100, 15, 60, 3),
(121, 2, 16, 14, 1),
(122, 250, 16, 81, 2),
(123, 1, 16, 94, 9),
(124, 1, 16, 39, 1),
(125, 2, 16, 52, 4),
(126, 1, 16, 47, 4),
(127, 1, 16, 59, 4),
(128, 1, 16, 73, 1),
(129, 10, 16, 76, 2),
(130, 3, 16, 56, 4),
(131, 1, 16, 72, 5),
(132, 4, 17, 3, 1),
(133, 10, 17, 59, 3),
(134, 1, 17, 74, 1),
(135, 4, 17, 55, 4),
(136, 2, 18, 4, 1),
(137, 1, 18, 17, 1),
(138, 1, 18, 20, 10),
(139, 1, 18, 94, 9),
(140, 2, 18, 57, 5),
(141, 1, 18, 73, 1),
(142, 1, 18, 34, 1),
(143, 15, 19, 12, 1),
(144, 1, 19, 8, 1),
(145, 2, 19, 24, 1),
(146, 200, 19, 43, 2),
(147, 1, 19, 63, 1),
(148, 100, 19, 86, 3),
(149, 200, 19, 60, 3),
(150, 2, 19, 47, 4),
(151, 1, 20, 8, 1),
(152, 2, 20, 3, 1),
(153, 2, 20, 24, 1),
(154, 1, 20, 62, 1),
(155, 2, 20, 95, 4),
(156, 150, 20, 60, 3),
(157, 2, 21, 1, 1),
(158, 10, 21, 5, 2),
(159, 1, 21, 6, 1),
(160, 1, 21, 7, 1),
(161, 1, 21, 8, 1),
(162, 1, 21, 32, 1),
(163, 150, 21, 40, 2),
(164, 2, 21, 49, 4),
(165, 1, 21, 46, 5),
(166, 100, 21, 60, 3),
(167, 4, 22, 10, 1),
(168, 1, 22, 8, 1),
(169, 100, 22, 19, 2),
(170, 1, 22, 25, 9),
(171, 1, 22, 75, 1),
(172, 100, 22, 60, 3),
(173, 10, 22, 59, 3);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `id` int NOT NULL AUTO_INCREMENT,
  `note_aspect` int NOT NULL,
  `note_odeur` int NOT NULL,
  `note_gout` int NOT NULL,
  `note_texture` int NOT NULL,
  `recette_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CFBDFA1489312FE9` (`recette_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `note_aspect`, `note_odeur`, `note_gout`, `note_texture`, `recette_id`) VALUES
(1, 0, 0, 0, 0, 1),
(2, 0, 0, 0, 0, 2),
(3, 0, 0, 0, 0, 3),
(4, 0, 0, 0, 0, 4),
(5, 0, 0, 0, 0, 5),
(6, 0, 0, 0, 0, 6),
(7, 0, 0, 0, 0, 7),
(8, 0, 0, 0, 0, 8),
(9, 0, 0, 0, 0, 9),
(10, 0, 0, 0, 0, 10),
(11, 0, 0, 0, 0, 11),
(12, 0, 0, 0, 0, 12),
(13, 0, 0, 0, 0, 13),
(14, 0, 0, 0, 0, 14),
(15, 0, 0, 0, 0, 15),
(16, 0, 0, 0, 0, 16),
(17, 0, 0, 0, 0, 17),
(18, 0, 0, 0, 0, 18),
(19, 0, 0, 0, 0, 19),
(20, 0, 0, 0, 0, 20),
(21, 0, 0, 0, 0, 21),
(22, 0, 0, 0, 0, 22);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC27BCF5E72D` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `nom`, `categorie_id`) VALUES
(1, 'gousse d\'ail', 12),
(2, 'salade', 12),
(3, 'tomate', 12),
(4, 'concombre', 12),
(5, 'gimgembre', 12),
(6, 'poivron jaune', 12),
(7, 'poivron rouge', 12),
(8, 'oignon', 12),
(9, 'carotte', 12),
(10, 'pomme de terre', 12),
(11, 'brocoli', 12),
(12, 'champignon', 12),
(13, 'épinard', 12),
(14, 'courgette', 12),
(89, 'céleri', 12),
(16, 'poireau', 12),
(17, 'échalote', 12),
(18, 'oignon rouge', 12),
(19, 'roquette', 12),
(20, 'ciboulette', 16),
(21, 'cébette', 16),
(22, 'pavé de boeuf', 10),
(23, 'échine de porc', 10),
(24, 'filet de poulet', 10),
(25, 'lardon', 14),
(26, 'chorizo', 14),
(27, 'merguez', 10),
(28, 'cuisse de poulet', 10),
(29, 'cuisse de poulet jaune', 10),
(30, 'viande hachée', 10),
(31, 'saucisse', 10),
(32, 'longe de thon', 6),
(33, 'pavé de saumon', 6),
(34, 'boîte de thon', 6),
(35, 'parmesan', 11),
(37, 'boursin', 11),
(38, 'chèvre frais', 11),
(39, 'bûche de chèvre', 11),
(40, 'riz', 8),
(41, 'nouille chinoises', 8),
(42, 'orzo', 8),
(43, 'pâtes', 8),
(44, 'riz à risotto', 8),
(45, 'lentilles', 8),
(46, 'concentré de tomates', 9),
(47, 'sauce soja', 7),
(48, 'sauce huitre', 7),
(49, 'épice à colombo', 9),
(50, 'paprika', 9),
(51, 'curry', 9),
(52, 'thym', 16),
(53, 'persil', 16),
(54, 'basilic', 16),
(55, 'pesto', 9),
(56, 'pesto rosso', 9),
(57, 'moutarde', 9),
(58, 'huile de sésame', 7),
(59, 'vinaigre balsamique', 7),
(60, 'crème liquide', 4),
(61, 'crème fraîche', 4),
(62, 'cube de bouillon de légumes', 9),
(63, 'cube de bouillon de poulet', 9),
(64, 'avocat', 12),
(65, 'citron', 5),
(66, 'olives', 12),
(67, 'noix', 15),
(68, 'farine', 19),
(69, 'maïzena', 19),
(70, 'beurre', 4),
(71, 'sucre roux', 19),
(72, 'miel', 9),
(73, 'pâte brisée', 20),
(74, 'pâte feuilletée', 20),
(75, 'pinsa', 19),
(76, 'chapelure', 19),
(77, 'pistache', 15),
(78, 'amandes', 15),
(79, 'golden curry', 9),
(80, 'gorgonzola', 11),
(81, 'tomates cerise', 12),
(82, 'feta', 11),
(84, 'burrata petite', 11),
(85, 'burrata grande', 11),
(86, 'vin blanc', 9),
(87, 'huile d\'olive', 7),
(88, 'pois chiche', 12),
(90, 'poulet entier', 10),
(91, 'oignon frit', 9),
(92, 'radis', 12),
(93, 'sésame grillé', 9),
(94, 'fromage frais', 11),
(95, 'curry korma', 9);

-- --------------------------------------------------------

--
-- Structure de la table `recette`
--

DROP TABLE IF EXISTS `recette`;
CREATE TABLE IF NOT EXISTS `recette` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `instruction` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette`
--

INSERT INTO `recette` (`id`, `nom`, `duree`, `date`, `instruction`) VALUES
(1, 'Boeuf loc lac', 0, '2026-04-28', 'Couper la viande et faire mariner avec la sauce soja, la sauce huître, de maïzena et de l\'ail\r\nFaire revenir du riz avec de l\'ail et du concentré de tomates\r\nFaire cuire la viande \r\nServir avec de la salade, des rondelles de concombre et de tomates'),
(2, 'Curry Japonais', 0, '2026-04-28', 'Couper la viande et les légumes\r\nFaire dorer la viande avec les légumes\r\nMouiller à hauteur avec du bouillon de légumes\r\nQuand les pommes de terre sont cuite ajouter 2.5 cubes de golden curry\r\nServir avec du riz'),
(3, 'Orzo courgette Boursin', 0, '2026-04-28', 'Faire cuire le poulet (ou saumon, ou végétarien)\r\nAjouter l\'ail et les courgettes râpées et égouttées\r\nAjouter l\'orzo (200g) et faire nacrer\r\nAjouter petit à petit l\'eau (700mL) mélangée au cube de légume\r\nAjouter le boursin\r\n'),
(4, 'Pâtes au Gorgonzola', NULL, '2026-04-28', 'Faire cuire le poulet puis les champignons\r\nAjouter les épinards puis le gorgonzola et de la crème\r\nAjouter des pâtes et assaisonner\r\nRajouter des noix'),
(5, 'Pâtes feta brocoli', NULL, '2026-04-28', 'Dans un plat mettre la feta puis les légumes ( lardon optionnelles )\r\nAjouter de la crème liquide de l\'huile d\'olive et assaisonner\r\nMettre au four 30 min à 200°C\r\nFaire des pâtes et mélanger au plat à la sortie du four'),
(6, 'Poulet Yassa', 0, '2026-04-28', 'Tailler, saler, poivrer le poulet\r\nAjouter la marinade (1 citron, 1 oignon, 3 gousses d\'ail, un morceau de gingembre, persil, huile de tournesol)\r\nFaire dorer le poulet puis mettre au four 20 min à 200 °C\r\nCouper le dernier oignon et le faire cuire à la poêle\r\nAjouter moutarde, olive, marinade et laisser compoter\r\nServir avec du riz'),
(7, 'Risotto de pistaches', 0, '2026-04-28', 'Faire le pesto en mixant les pistaches (100 g), basilic (10 feuilles), parmesan (30 g), amande (20 g), et huile d\'olive (8 cl)\r\nFaire bouillir 1 L d\'eau avec un cube de bouillon\r\nCouper et faire revenir le poulet et mettre de côté\r\nCouper et faire revenir l\'oignon\r\nAjouter le riz (320 g) et faire nacrer\r\nAjouter 15 cl de vin blanc et mélanger jusqu\'à ce que ce soit absorbé\r\nAjouter les louches de bouillon 2 par 2 et mélanger jusqu\'à ce que ce soit absorbé\r\nAjouter sel, poivre, beurre (20g), parmesan (20g) puis le pesto\r\nDresser avec une burrata et des pistaches concassées'),
(8, 'Riz boeuf mongole', NULL, '2026-04-28', 'Faire cuire la viande puis ajouter l\'ail et le gingembre haché avec cébette\r\nAjouter la sauce soja, sauce huître, sucre roux et mélange d\'eau maïzena\r\nServir avec du riz'),
(9, 'Riz crémeux poireaux /chorizo', NULL, '2026-04-28', 'Dans un plat mettre 200g de riz puis le chèvre frais\r\nMettre  les poireaux, l\'ail, l\'échalote, le chorizo, sel, poivre autour du fromage\r\nAjouter 500mL d\'eau bouillante\r\nMettre au four 40 min à 200°C\r\nATTENTION ! remuer de temps en temps, le chorizo grille vite !!!'),
(10, 'Riz pois chiche épinards', NULL, '2026-04-28', 'Couper et faire revenir l\'oignon\r\nAjouter les épinards dans la poêle et faire cuire\r\nAjouter sel, poivre, paprika, curry, pois chiches, concentrés de tomates et crème\r\nServir avec du riz'),
(11, 'Saucisses lentille', NULL, '2023-04-12', 'Faire cuire les saucisses dans une marmite et mettre de côté\r\nFaire cuire les lardons puis ajouter les légumes coupés en dés\r\nFaire dorer puis ajouter 300 g de lentille, 1 L d\'eau, un cube de bouillon de légume et l\'ail\r\nLaisser cuire à couvert 40min'),
(12, 'Bouillon de poulet ', 0, '2026-04-28', 'Désossé le poulet et ne garder que la carcasse et les ailes (les cuisses et les escalopes peuvent aller au congélateur ou dans d\'autre recette du site)\r\nFaire dorer la carcasse dans une marmite chaude et huilé puis y ajouter les légumes\r\nMouiller à hauteur et ajouter du sel\r\nLaisser cuire à couvert pendant 2h\r\nSortir la carcasse et les ailes, récupérer toute la viande en grattant avec une fourchette\r\nRemettre la viande dans le bouillon\r\nMettre les nouilles dans un bol, y ajouter du bouillon et laisser cuire 3 minutes\r\n'),
(13, 'Tarte aux poireaux', 0, '2026-04-28', '(optionnelles) Faire cuire les lardons dans une poêle et mettre de côté (optionnelles)\r\nFaire cuire les poireaux avec de l\'ail puis ajouter la crème les lardon et de la moutarde\r\nÉtaler du pesto sur la pâte puis ajouter les poireaux\r\nMettre au four 30 min à 180°C\r\nAjouter une burrata'),
(14, 'Poke bowl', NULL, '2026-04-28', 'Faire cuire le riz en avance pour le laisser refroidir\r\nFaire mariner le saumon avec la sauce soja, la sauce huître et l\'huile de sésame\r\nServir cuit ou cru avec le riz, des tranches d\'avocat, de concombre de radis et de carotte\r\nAjout optionnel en topping , sésame, oignon frit'),
(15, 'Orzo poivron chorizo', NULL, '2026-04-28', 'Dans un plat, mettre 150g d\'orzo, les poivrons, chorizo, épinard coupées en morceaux\r\nAjouter 10cL de crème et 400mL de bouillon de légumes\r\nFaire cuire au four 35min à 200°C\r\nAjouter du parmesan'),
(16, 'Tarte caramélisée légume pesto rosso', NULL, '2026-04-28', 'Étaler du fromage frais, du pesto, de la chapelure, du thym sur la pâte\r\nDisposer une rangée de courgette, une rangée de tomate cerise, une rangée de courgette/chevre, tomate\r\nMélanger la sauce soja, vinaigre balsamique, miel, huile d\'olive et badigeonner la tarte avec '),
(17, 'Tarte froide à la tomate', 0, '2026-04-28', 'Étaler la pâte sur une plaque, rabattre les bord et faire des trous\r\nFaire cuire la pâte au four 15 min\r\nÉtaler du pesto sur la pâte cuite\r\nDisposer des rondelles de tomate sur la pâte (le mieux est de prendre des tomates de plusieurs couleurs)\r\nAjouter du vinaigre balsamique'),
(18, 'Tarte aux concombres', NULL, '2026-04-28', 'Faire cuire la pâte dans un plat (percer la pâte pour éviter qu\'elle gonfle)\r\nFaire une rillettes de thon (thon, ciboulette, échalote, moutarde, fromage frais)\r\nÉtaler la rillettes sur la pâte et disposer le concombre coupées en rondelles'),
(19, 'Poulet aux champignons', NULL, '2026-04-28', 'Couper et faire cuire le poulet puis le mettre de côté\r\nFaire cuire les oignons puis les champignons\r\nDéglacer avec du vin blanc puis avec du bouillon de poulet \r\nLaisser réduire puis ajouter la crème avec un peu de sauce soja, le poulet et les pâtes'),
(20, 'Curry Korma', NULL, '2026-04-28', 'Faire cuire le poulet et les oignons dans une poêle \r\nAjouter les tomates, de l\'eau avec le bouillon et laisser réduire \r\nAjouter la crème et le curry\r\nServir avec du riz'),
(21, 'Colombo de thon', NULL, '2026-04-28', 'Faire dorer le poisson dans une poêle et mettre de côté.\r\nFaire revenir l\'ail et le gingembre puis ajouter les poivrons et l\'oignon.\r\nLaisser cuire puis ajouter les épices et le concentré de tomates.\r\nAjouter de la crème et le thon.\r\nServir avec du riz'),
(22, 'Pinsa gourmande', NULL, '2026-04-28', 'Éplucher, couper en rondelles et faire cuire les pommes de terre\r\nFaire cuire les lardons et les oignons\r\nÉtaler la crème fraîche sur la pinsa puis salée et poivré\r\nAjouter la moitié des oignons et lardons puis les pommes de terre\r\nAjouter le reste de lardons oignon\r\nMettre au four 10 min à 220°C\r\nAjouter de la roquette et du vinaigre balsamique');

-- --------------------------------------------------------

--
-- Structure de la table `recette_categorie_recette`
--

DROP TABLE IF EXISTS `recette_categorie_recette`;
CREATE TABLE IF NOT EXISTS `recette_categorie_recette` (
  `recette_id` int NOT NULL,
  `categorie_recette_id` int NOT NULL,
  PRIMARY KEY (`recette_id`,`categorie_recette_id`),
  KEY `IDX_319D227989312FE9` (`recette_id`),
  KEY `IDX_319D227917F8E545` (`categorie_recette_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recette_categorie_recette`
--

INSERT INTO `recette_categorie_recette` (`recette_id`, `categorie_recette_id`) VALUES
(1, 6),
(2, 6),
(3, 6),
(3, 8),
(3, 11),
(4, 6),
(5, 6),
(5, 8),
(6, 6),
(7, 6),
(8, 6),
(9, 11),
(10, 6),
(10, 8),
(11, 6),
(11, 11),
(12, 6),
(13, 5),
(13, 6),
(14, 4),
(14, 7),
(14, 10),
(15, 6),
(15, 11),
(16, 5),
(16, 6),
(16, 8),
(17, 5),
(17, 7),
(17, 8),
(18, 5),
(18, 7),
(19, 6),
(20, 6),
(21, 6),
(21, 10),
(22, 5),
(22, 6);

-- --------------------------------------------------------

--
-- Structure de la table `unitee`
--

DROP TABLE IF EXISTS `unitee`;
CREATE TABLE IF NOT EXISTS `unitee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `unitee`
--

INSERT INTO `unitee` (`id`, `nom`) VALUES
(1, 'pièce(s)'),
(2, 'g'),
(3, 'mL'),
(4, 'c. à soupe'),
(5, 'c. à café'),
(6, 'feuille(s)'),
(7, 'L'),
(8, 'kg'),
(9, 'pot(s)'),
(10, 'botte'),
(11, 'branche');

-- --------------------------------------------------------

--
-- Structure de la table `version`
--

DROP TABLE IF EXISTS `version`;
CREATE TABLE IF NOT EXISTS `version` (
  `id` int NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
