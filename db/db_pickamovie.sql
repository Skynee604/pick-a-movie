-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 08 mai 2021 à 14:29
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_pickamovie`
--
CREATE DATABASE IF NOT EXISTS `db_pickamovie` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `db_pickamovie`;

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) NOT NULL,
  PRIMARY KEY (`idAdmin`),
  KEY `idClient` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`idAdmin`, `idClient`) VALUES
(6, 37);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nickNameClient` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nameClient` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `firstNameClient` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `pwdClient` varchar(150) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `emailClient` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idClient`),
  KEY `idClient` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nickNameClient`, `nameClient`, `firstNameClient`, `pwdClient`, `emailClient`) VALUES
(36, 'User', 'Doe', 'John', '$2y$10$bsS1Wm6Tmuxo45JEQT.VBuQ7cyKIKPc20x5kTXFrXdRzetWe02RFK', 'user@email.com'),
(37, 'Admin', 'Doe', 'John', '$2y$10$QRle2KbCLKozpxi2hcYmlOXZJwK62l5UZLQIDd31xrnEeU7nOHNQO', 'admin@email.com');

-- --------------------------------------------------------

--
-- Structure de la table `movie`
--

DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
  `idMovie` int(11) NOT NULL AUTO_INCREMENT,
  `titleMovie` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `director` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `summaryMovie` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `poster` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `header` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `thumbnail` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idMovie`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `movie`
--

INSERT INTO `movie` (`idMovie`, `titleMovie`, `director`, `summaryMovie`, `poster`, `header`, `thumbnail`) VALUES
(2, 'Star Wars : l\'empire contre attaque', 'Georges Lucas', 'Les Rebelles sont dispers&eacute;s apr&egrave;s l\'attaque de leur base. Han et Leia sont poursuivis tandis que Luke s\'entra&icirc;ne avec ma&icirc;tre Yoda. Mais quand Luke affronte Vador, il d&eacute;couvre la v&eacute;rit&eacute; sur son pass&eacute;.', 'images/posters/starwars.jpg', 'images/headers/StarWarsHeader.jpg', 'images/miniatures/StarWars.jpg'),
(3, 'Alien', 'Ridley Scott', 'R&eacute;alis&eacute; par Ridley Scott, ce classique de la science-fiction raconte l\'histoire de Ripley (Sigourney Weaver) qui enqu&ecirc;te sur un appel de d&eacute;tresse provenant d\'une plan&egrave;te lointaine et fait une d&eacute;couverte effroyable.\r\n', 'images/posters/alien.jpg', 'images/headers/alienHeader.jpg', 'images/miniatures/Alien.jpg'),
(4, 'Bob l\'&eacute;ponge : le film', 'Stephen Hillenburg ', 'A Bikini Bottom, quelqu\'un a vol&eacute; la couronne du roi Neptune, et le patron de Bob l\'&eacute;ponge, M. Krabs, figure en t&ecirc;te des suspects. Convaincus de son innocence, Bob et Patrick partent pour Shell City avec l\'intention de le disculper et de restituer sa couronne &agrave; Neptune. ', 'images/posters/bobleponge.jpg', 'images/headers/2017_SpongeBob_Collection_Header.webp', 'images/miniatures/BobLeponge.jpg'),
(5, 'The Darjeeling Limited', 'Wes Anderson', 'Francis, Jack et Peter, trois fr&egrave;res qui ne se sont pas vus depuis la mort de leur p&egrave;re, d&eacute;cident de faire un grand voyage en train &agrave; travers l\'Inde pour renouer les liens fraternels. Mais tr&egrave;s vite, la &quot;qu&ecirc;te spirituelle&quot; va d&eacute;railler : ils vont se retrouver seuls, perdus au milieu du d&eacute;sert avec onze valises, une imprimante, une machine &agrave; plastifier et beaucoup de comptes &agrave; r&eacute;gler avec la vie...', 'images/posters/darjeelinglimited.jpg', NULL, 'images/miniatures/DarjeelingLimited.jpg'),
(6, 'DeadPool', 'Tim Miller', 'Basé sur l\'antihéros le moins conventionnel de l\'univers Marvel, Deadpool raconte l\'histoire des origines de Wade Wilson, un mercenaire qui traque l\'homme qui a presque anéanti sa vie.', 'images/posters/deadpool.jpg', 'images/headers/deadPoolHeader.jpg', 'images/miniatures/DeadPool.jpg'),
(7, 'ET, l\'extraterrestre', 'Steven Spielberg', 'Pour devenir l\'ami d\'une créature de l\'espace qui veut rentrer chez elle, il faut de la patience et beaucoup de bonbons.', 'images/posters/E.T.jpg', NULL, 'images/miniatures/ET.jpg'),
(8, 'Indiana Jones et la dernière croisade', 'Steven Spielberg', 'Accompagné de son père pour sa troisième aventure, Indiana Jones part explorer le berceau de la civilisation dans une nouvelle quête du Graal.', 'images/posters/IndianaJones.jpg', 'images/headers/indianaJonesHeader.jpg', 'images/miniatures/IndianaJones.jpg'),
(9, 'Iron Man', 'Jon Favreau', 'Survivant d\'une attaque en territoire ennemi, l\'homme d\'affaires Tony Stark fabrique une armure high-tech pour d&eacute;fendre le monde sous le nom de Iron Man.', 'images/posters/ironman.jpg', NULL, 'images/miniatures/IronMan.jpg'),
(10, 'Big Trouble in Little China', 'John Carpenter', 'Un camionneur macho est plongé dans un monde étrange, quand la fiancée de son ami est kidnappée par des forces mystérieuses dans le quartier de Chinatown, à San Francisco.', 'images/posters/jackburton.jpg', 'images/headers/jackBurtonHeader.jpg', 'images/miniatures/JackBurton.jpg'),
(11, 'Jurassic Park', 'Steven Spielberg', '&Agrave; moins que vous ne soyez pr&ecirc;ts &agrave; lutter pour votre survie, il vaut mieux ne pas toucher &agrave; l\'ADN de dinosaure fossilis&eacute;.', 'images/posters/jurassicpark.jpg', 'images/headers/jurassicParkHeader.jpg', 'images/miniatures/JurassicPark.jpg'),
(12, 'La vie aquatique', 'Wes Anderson', 'Steve Zissou (Bill Murray) et son équipe traquent le mystérieux requin-jaguar, une créature quasi-mythique qui a tué le coéquipier de Steve pendant le tournage d\'un documentaire.', 'images/posters/lavieaquatique.png', NULL, 'images/miniatures/LaVieAquatique.jpg'),
(13, 'Scooby-Doo', 'Raja Gosnell', 'La bande de Scooby-Doo se retrouve sur Spooky Island pour comprendre la cause d\'une série d\'incidents paranormaux.', 'images/posters/scoobydoo.jpg', NULL, 'images/miniatures/ScoobyDoo.jpg'),
(14, 'Soul', 'Pete Docter', 'Les studios Pixar Animation vous propulsent depuis les rues de New York dans des dimensions cosmiques, en qu&ecirc;te de r&eacute;ponses &agrave; de grandes questions existentielles.', 'images/posters/soul.png', 'images/headers/soulHeader.jpg', 'images/miniatures/Soul.jpg'),
(15, 'Spider-Man : far from home', 'Jon Watts', 'M?me les super-héros ont parfois besoin de vacances, mais une nouvelle menace oblige Peter Parker à passer à l\'action lors d\'un voyage scolaire en Europe.', 'images/posters/spiderman.png', NULL, 'images/miniatures/SpiderMan.jpg'),
(16, 'Toy Story', 'John Lasseter', 'Bienvenue dans un monde épatant où les jouets jouent quand leurs propriétaires ne sont pas là. Rencontrez Woody, Buzz et tous leurs amis dans une aventure remplie d\'humour, de coeur et d\'amitié.', 'images/posters/toystory.jpg', 'images/headers/toyStoryHeader.jpg', 'images/miniatures/ToyStory.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `price`
--

DROP TABLE IF EXISTS `price`;
CREATE TABLE IF NOT EXISTS `price` (
  `idPrix` int(11) NOT NULL AUTO_INCREMENT,
  `namePrix` varchar(50) COLLATE utf8_bin NOT NULL,
  `prix` double NOT NULL,
  PRIMARY KEY (`idPrix`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `price`
--

INSERT INTO `price` (`idPrix`, `namePrix`, `prix`) VALUES
(1, 'Adulte', 9),
(2, 'Enfant', 6.5),
(3, 'Etudiant', 8);

-- --------------------------------------------------------

--
-- Structure de la table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `idReview` int(11) NOT NULL AUTO_INCREMENT,
  `textReview` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `dateReview` datetime NOT NULL,
  `noteReview` int(1) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idMovie` int(11) NOT NULL,
  PRIMARY KEY (`idReview`),
  KEY `fk_reviewMovie` (`idMovie`),
  KEY `fk_reviewClient` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `idSession` int(11) NOT NULL AUTO_INCREMENT,
  `dateSession` date NOT NULL,
  `timeSession` time NOT NULL,
  `idMovie` int(11) NOT NULL,
  PRIMARY KEY (`idSession`),
  KEY `fk_sessionMovie` (`idMovie`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `session`
--

INSERT INTO `session` (`idSession`, `dateSession`, `timeSession`, `idMovie`) VALUES
(6, '2021-05-29', '15:00:00', 2),
(7, '2021-05-29', '20:00:00', 2),
(10, '2021-05-29', '22:00:00', 2),
(11, '2021-06-05', '15:00:00', 2),
(12, '2021-06-05', '20:00:00', 2),
(13, '2021-06-05', '22:00:00', 2),
(14, '2021-06-12', '15:00:00', 2),
(15, '2021-06-12', '20:00:00', 2),
(16, '2021-06-12', '22:00:00', 2),
(20, '2021-05-30', '01:00:00', 3),
(21, '2021-05-29', '20:00:00', 3),
(22, '2021-05-29', '22:00:00', 3),
(23, '2021-06-05', '15:00:00', 3),
(24, '2021-06-05', '20:00:00', 3),
(25, '2021-06-05', '22:00:00', 3),
(26, '2021-06-12', '15:00:00', 3),
(27, '2021-06-12', '20:00:00', 3),
(28, '2021-06-12', '22:00:00', 3),
(29, '2021-05-29', '15:00:00', 4),
(30, '2021-05-29', '20:00:00', 4),
(31, '2021-05-29', '22:00:00', 4),
(32, '2021-06-05', '15:00:00', 4),
(33, '2021-06-05', '20:00:00', 4),
(34, '2021-06-05', '22:00:00', 4),
(35, '2021-06-12', '15:00:00', 4),
(36, '2021-06-12', '20:00:00', 4),
(37, '2021-06-12', '22:00:00', 4),
(38, '2021-05-29', '15:00:00', 5),
(39, '2021-05-29', '20:00:00', 5),
(40, '2021-05-29', '22:00:00', 5),
(41, '2021-06-05', '15:00:00', 5),
(42, '2021-06-05', '20:00:00', 5),
(43, '2021-06-05', '22:00:00', 5),
(44, '2021-06-12', '15:00:00', 5),
(45, '2021-06-12', '20:00:00', 5),
(46, '2021-06-12', '22:00:00', 5),
(56, '2021-05-29', '15:00:00', 6),
(57, '2021-05-29', '20:00:00', 6),
(58, '2021-05-29', '22:00:00', 6),
(59, '2021-05-29', '18:00:00', 6),
(60, '2021-06-05', '20:00:00', 6),
(61, '2021-06-05', '22:00:00', 6),
(62, '2021-06-12', '15:00:00', 6),
(63, '2021-06-12', '20:00:00', 6),
(64, '2021-06-12', '22:00:00', 6),
(65, '2021-05-29', '15:00:00', 7),
(66, '2021-05-29', '20:00:00', 7),
(67, '2021-05-29', '22:00:00', 7),
(68, '2021-06-05', '15:00:00', 7),
(69, '2021-06-05', '20:00:00', 7),
(70, '2021-06-05', '22:00:00', 7),
(71, '2021-06-12', '15:00:00', 7),
(72, '2021-06-12', '20:00:00', 7),
(73, '2021-06-12', '22:00:00', 7),
(74, '2021-05-29', '15:00:00', 8),
(75, '2021-05-29', '20:00:00', 8),
(76, '2021-05-29', '22:00:00', 8),
(77, '2021-06-05', '15:00:00', 8),
(78, '2021-06-05', '20:00:00', 8),
(79, '2021-06-05', '22:00:00', 8),
(80, '2021-06-12', '15:00:00', 8),
(81, '2021-06-12', '20:00:00', 8),
(82, '2021-06-12', '22:00:00', 8),
(83, '2021-05-29', '15:00:00', 9),
(84, '2021-05-29', '20:00:00', 9),
(85, '2021-05-29', '22:00:00', 9),
(86, '2021-06-05', '15:00:00', 9),
(87, '2021-06-05', '20:00:00', 9),
(88, '2021-06-05', '22:00:00', 9),
(89, '2021-06-12', '15:00:00', 9),
(90, '2021-06-12', '20:00:00', 9),
(91, '2021-06-12', '22:00:00', 9),
(92, '2021-05-29', '15:00:00', 10),
(93, '2021-05-29', '20:00:00', 10),
(94, '2021-05-29', '22:00:00', 10),
(95, '2021-06-05', '15:00:00', 10),
(96, '2021-06-05', '20:00:00', 10),
(97, '2021-06-05', '22:00:00', 10),
(98, '2021-06-12', '15:00:00', 10),
(99, '2021-06-12', '20:00:00', 10),
(100, '2021-06-12', '22:00:00', 10),
(101, '2021-05-29', '15:00:00', 11),
(102, '2021-05-29', '20:00:00', 11),
(103, '2021-05-29', '22:00:00', 11),
(104, '2021-06-05', '15:00:00', 11),
(105, '2021-06-05', '20:00:00', 11),
(106, '2021-06-05', '22:00:00', 11),
(107, '2021-06-12', '15:00:00', 11),
(108, '2021-06-12', '20:00:00', 11),
(109, '2021-06-12', '22:00:00', 11),
(110, '2021-05-29', '15:00:00', 12),
(111, '2021-05-29', '20:00:00', 12),
(112, '2021-05-29', '22:00:00', 12),
(113, '2021-06-05', '18:00:00', 12),
(114, '2021-06-05', '20:00:00', 12),
(115, '2021-06-05', '22:00:00', 12),
(116, '2021-06-12', '15:00:00', 12),
(117, '2021-06-12', '20:00:00', 12),
(118, '2021-06-12', '22:00:00', 12),
(119, '2021-05-29', '15:00:00', 13),
(120, '2021-05-29', '20:00:00', 13),
(121, '2021-05-29', '22:00:00', 13),
(122, '2021-05-07', '18:52:00', 13),
(123, '2021-06-05', '20:00:00', 13),
(124, '2021-06-05', '22:00:00', 13),
(125, '2021-06-12', '18:00:00', 13),
(126, '2021-06-12', '20:00:00', 13),
(127, '2021-06-12', '22:00:00', 13),
(128, '2021-05-29', '15:00:00', 14),
(129, '2021-05-29', '20:00:00', 14),
(130, '2021-05-29', '22:00:00', 14),
(131, '2021-06-09', '18:00:00', 14),
(132, '2021-06-05', '20:00:00', 14),
(133, '2021-06-05', '22:00:00', 14),
(134, '2021-05-08', '12:00:00', 14),
(135, '2021-06-12', '20:00:00', 14),
(136, '2021-06-12', '22:00:00', 14),
(137, '2021-05-29', '15:00:00', 15),
(138, '2021-05-29', '20:00:00', 15),
(139, '2021-05-29', '22:00:00', 15),
(140, '2021-06-05', '15:00:00', 15),
(141, '2021-06-05', '20:00:00', 15),
(142, '2021-06-05', '22:00:00', 15),
(143, '2021-06-12', '15:00:00', 15),
(144, '2021-06-12', '20:00:00', 15),
(145, '2021-06-12', '22:00:00', 15);

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `idTicket` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) NOT NULL,
  `idSession` int(11) NOT NULL,
  `idPrice` int(11) NOT NULL,
  `quant` int(3) NOT NULL,
  PRIMARY KEY (`idTicket`) USING BTREE,
  KEY `fk_ticketClient` (`idClient`) USING BTREE,
  KEY `fk_ticketPrice` (`idPrice`) USING BTREE,
  KEY `fkTicketSession` (`idSession`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_reviewClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviewMovie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_sessionMovie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `fkTicketSession` FOREIGN KEY (`idSession`) REFERENCES `session` (`idSession`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticketClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticketPrice` FOREIGN KEY (`idPrice`) REFERENCES `price` (`idPrix`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
