-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 13 avr. 2021 à 00:11
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
  AUTOCOMMIT = 0;
START TRANSACTION;
SET
  time_zone = "+00:00";
  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;
--
  -- Base de données :  `db_pickamovie`
  --
  DROP DATABASE db_pickamovie;
CREATE DATABASE IF NOT EXISTS db_pickamovie CHARACTER SET utf8 COLLATE utf8_bin;
USE db_pickamovie;
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
  ) ENGINE = InnoDB AUTO_INCREMENT = 5 DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
--
  -- Déchargement des données de la table `admin`
  --
INSERT INTO
  `admin` (`idAdmin`, `idClient`)
VALUES
  (4, 15);
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
  ) ENGINE = InnoDB AUTO_INCREMENT = 33 DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
--
  -- Déchargement des données de la table `client`
  --
INSERT INTO
  `client` (
    `idClient`,
    `nickNameClient`,
    `nameClient`,
    `firstNameClient`,
    `pwdClient`,
    `emailClient`
  )
VALUES
  (
    15,
    'Loova',
    'Valentin',
    'Durieux',
    '$2y$10$ka8iPVSJcWFynaGrrbQl5ONzhtJuZe40jJV1j9YR2PIkWyRvuSbue',
    'test@email.com'
  ),
  (
    25,
    'r',
    'r',
    'r',
    '$2y$10$rdOy3g3pJgP/fQm7fkOZ7.04y/TGqJN4uvXVr6bXOs47M1SEXid4e',
    'valentin.durieux@gmail.com'
  ),
  (
    28,
    'voiture',
    'stylo',
    'velo',
    '$2y$10$7z54N6Uhb7SrK7LxIDYK2.TelISXSUeywV76FV2SR3ji.ji9qG4uu',
    'test4@email.com'
  ),
  (
    29,
    'test',
    'test',
    'test',
    '$2y$10$vSfcrRQLxPOxDPbrcRDQv.tzisoUN0twGg8/j9vPcyXsEWwkocLGu',
    'test@emai.com'
  ),
  (
    30,
    'kurtJMH',
    'Durieux',
    'Valentin',
    '$2y$10$AuXRs/IW1xaR3g9N0Z551u3mUNWjI07OhSHzj69HaVLTjgS.LlAZm',
    'val@val.com'
  ),
  (
    31,
    'bite',
    'durieux',
    'valentin',
    '$2y$10$Ozk/KkOwNa/yRUbCFaqF4.hK043iyp3vOhcge1wE5/s/1PW/y85Ge',
    'a@test.com'
  ),
  (
    32,
    'Math1970',
    'Daix',
    'Mathilde',
    '$2y$10$.AbU8THnMREz/0MA2gxEpOaWesOF1wsBYR30a/juFEurqdU3B0/G6',
    'mathilde@email.com'
  );
-- --------------------------------------------------------
  --
  -- Structure de la table `movie`
  --
  DROP TABLE IF EXISTS `movie`;
CREATE TABLE IF NOT EXISTS `movie` (
    `idMovie` int(11) NOT NULL AUTO_INCREMENT,
    `titleMovie` varchar(100) COLLATE utf8_bin NOT NULL,
    `director` varchar(60) COLLATE utf8_bin NOT NULL,
    `summaryMovie` text COLLATE utf8_bin NOT NULL,
    `poster` varchar(200) COLLATE utf8_bin NOT NULL,
    `header` varchar(200) COLLATE utf8_bin DEFAULT NULL,
    `thumbnail` varchar(200) COLLATE utf8_bin NOT NULL,
    PRIMARY KEY (`idMovie`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 19 DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
--
  -- Déchargement des données de la table `movie`
  --
INSERT INTO
  `movie` (
    `idMovie`,
    `titleMovie`,
    `director`,
    `summaryMovie`,
    `poster`,
    `header`,
    `thumbnail`
  )
VALUES
  (
    2,
    'Star Wars : l\'empire contre attaque',
    'Georges Lucas',
    'Les Rebelles sont dispersés après l’attaque de leur base. Han et Leia sont poursuivis tandis que Luke s’entraîne avec maître Yoda. Mais quand Luke affronte Vador, il découvre la vérité sur son passé.',
    'images/posters/starwars.jpg',
    'images/headers/StarWarsHeader.jpg',
    'images/miniatures/StarWars.jpg'
  ),
  (
    3,
    'Alien',
    'Ridley Scott',
    'Réalisé par Ridley Scott, ce classique de la science-fiction raconte l\'histoire de Ripley (Sigourney Weaver) qui enquête sur un appel de détresse provenant d\'une planète lointaine et fait une découverte effroyable.',
    'images/posters/alien.jpg',
    'images/headers/alienHeader.jpg',
    'images/miniatures/Alien.jpg'
  ),
  (
    4,
    'Bob l\'éponge : le film',
    'Stephen Hillenburg ',
    'Quand son meilleur ami est kidnappé, Bob l\'éponge entraîne Patrick dans une folle aventure loin de Bikini Bottom pour sauver leur compagnon à coquille rose.',
    'images/posters/bobleponge.jpg',
    'images/headers/2017_SpongeBob_Collection_Header.webp',
    'images/miniatures/BobLeponge.jpg'
  ),
  (
    5,
    'The Darjeeling Limited',
    'Wes Anderson',
    'Francis, Jack et Peter, trois frères qui ne se sont pas vus depuis la mort de leur père, décident de faire un grand voyage en train à travers l\'Inde pour renouer les liens fraternels. Mais très vite, la \"quête spirituelle\" va dérailler : ils vont se retrouver seuls, perdus au milieu du désert avec onze valises, une imprimante, une machine à plastifier et beaucoup de comptes à régler avec la vie...',
    'images/posters/darjeelinglimited.jpg',
    NULL,
    'images/miniatures/DarjeelingLimited.jpg'
  ),
  (
    6,
    'DeadPool',
    'Tim Miller',
    'Basé sur l\'antihéros le moins conventionnel de l\'univers Marvel, Deadpool raconte l\'histoire des origines de Wade Wilson, un mercenaire qui traque l\'homme qui a presque anéanti sa vie.',
    'images/posters/deadpool.jpg',
    'images/headers/deadPoolHeader.jpg',
    'images/miniatures/DeadPool.jpg'
  ),
  (
    7,
    'ET, l’extraterrestre',
    'Steven Spielberg',
    'Pour devenir l\'ami d\'une créature de l\'espace qui veut rentrer chez elle, il faut de la patience et beaucoup de bonbons.',
    'images/posters/E.T.jpg',
    NULL,
    'images/miniatures/ET.jpg'
  ),
  (
    8,
    'India Jones et la dernière croisade',
    'Steven Spielberg',
    'Accompagné de son père pour sa troisième aventure, Indiana Jones part explorer le berceau de la civilisation dans une nouvelle quête du Graal.',
    'images/posters/IndianaJones.jpg',
    'images/headers/indianaJonesHeader.jpg',
    'images/miniatures/IndianaJones.jpg'
  ),
  (
    9,
    'Iron Man',
    'Jon Favreau',
    'Survivant d\'une attaque en territoire ennemi, l\'homme d\'affaires Tony Stark fabrique une armure high-tech pour défendre le monde sous le nom de Iron Man.',
    'images/posters/ironman.jpg',
    NULL,
    'images/miniatures/IronMan.jpg'
  ),
  (
    10,
    'Big Trouble in Little China',
    'John Carpenter',
    'Un camionneur macho est plongé dans un monde étrange, quand la fiancée de son ami est kidnappée par des forces mystérieuses dans le quartier de Chinatown, à San Francisco.',
    'images/posters/jackburton.jpg',
    'images/headers/jackBurtonHeader.jpg',
    'images/miniatures/JackBurton.jpg'
  ),
  (
    11,
    'Jurassic Park',
    'Steven Spielberg',
    'À moins que vous ne soyez prêts à lutter pour votre survie, il vaut mieux ne pas toucher à l\'ADN de dinosaure fossilisé.',
    'images/posters/jurassicpark.jpg',
    'images/headers/jurassicParkHeader.jpg',
    'images/miniatures/JurassicPark.jpg'
  ),
  (
    12,
    'La vie aquatique',
    'Wes Anderson',
    'Steve Zissou (Bill Murray) et son équipe traquent le mystérieux requin-jaguar, une créature quasi-mythique qui a tué le coéquipier de Steve pendant le tournage d’un documentaire.',
    'images/posters/lavieaquatique.png',
    NULL,
    'images/miniatures/LaVieAquatique.jpg'
  ),
  (
    13,
    'Scooby-Doo',
    'Raja Gosnell',
    'La bande de Scooby-Doo se retrouve sur Spooky Island pour comprendre la cause d\'une série d\'incidents paranormaux.',
    'images/posters/scoobydoo.jpg',
    NULL,
    'images/miniatures/ScoobyDoo.jpg'
  ),
  (
    14,
    'Soul',
    'Pete Docter',
    'Les studios Pixar Animation vous propulsent depuis les rues de New York dans des dimensions cosmiques, en quête de réponses à de grandes questions existentielles.',
    'images/posters/soul.png',
    'images/headers/soulHeader.jpg',
    'images/miniatures/Soul.jpg'
  ),
  (
    15,
    'Spider-Man : far from home',
    'Jon Watts',
    'Même les super-héros ont parfois besoin de vacances, mais une nouvelle menace oblige Peter Parker à passer à l\'action lors d\'un voyage scolaire en Europe.',
    'images/posters/spiderman.png',
    NULL,
    'images/miniatures/SpiderMan.jpg'
  ),
  (
    16,
    'Toy Story',
    'John Lasseter',
    'Bienvenue dans un monde épatant où les jouets jouent quand leurs propriétaires ne sont pas là. Rencontrez Woody, Buzz et tous leurs amis dans une aventure remplie d’humour, de cœur et d’amitié.',
    'images/posters/toystory.jpg',
    'images/headers/toyStoryHeader.jpg',
    'images/miniatures/ToyStory.jpg'
  );
-- --------------------------------------------------------
  --
  -- Structure de la table `price`
  --
  DROP TABLE IF EXISTS `price`;
CREATE TABLE IF NOT EXISTS `price` (
    `idPrix` int(11) NOT NULL AUTO_INCREMENT,
    `prix` double NOT NULL,
    PRIMARY KEY (`idPrix`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
-- --------------------------------------------------------
  --
  -- Structure de la table `purchase`
  --
  DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
    `idPurchase` int(11) NOT NULL AUTO_INCREMENT,
    `idClient` int(11) NOT NULL,
    `idTicket` int(11) NOT NULL,
    `idTicket2` int(11) DEFAULT NULL,
    `idTicket3` int(11) DEFAULT NULL,
    `idTicket4` int(11) DEFAULT NULL,
    `idTicket5` int(11) DEFAULT NULL,
    `idTicket6` int(11) DEFAULT NULL,
    `idTicket7` int(11) DEFAULT NULL,
    `idTicket8` int(11) DEFAULT NULL,
    `idTicket9` int(11) DEFAULT NULL,
    `idTicket10` int(11) DEFAULT NULL,
    PRIMARY KEY (`idPurchase`),
    KEY `fk_purchaseClient` (`idClient`),
    KEY `fk_purchaseTicket` (`idTicket`),
    KEY `fk_purchaseTicket2` (`idTicket2`),
    KEY `fk_purchaseTicket3` (`idTicket3`),
    KEY `fk_purchaseTicket4` (`idTicket4`),
    KEY `fk_purchaseTicket5` (`idTicket5`),
    KEY `fk_purchaseTicket6` (`idTicket6`),
    KEY `fk_purchaseTicket7` (`idTicket7`),
    KEY `fk_purchaseTicket8` (`idTicket8`),
    KEY `fk_purchaseTicket9` (`idTicket9`),
    KEY `fk_purchaseTicket10` (`idTicket10`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
-- --------------------------------------------------------
  --
  -- Structure de la table `review`
  --
  DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
    `idReview` int(11) NOT NULL AUTO_INCREMENT,
    `textReview` text COLLATE utf8_bin NOT NULL,
    `dateReview` datetime NOT NULL,
    `noteReview` int(1) NOT NULL,
    `idClient` int(11) NOT NULL,
    `idMovie` int(11) NOT NULL,
    PRIMARY KEY (`idReview`),
    KEY `fk_reviewMovie` (`idMovie`),
    KEY `fk_reviewClient` (`idClient`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
--
  -- Déchargement des données de la table `review`
  --
INSERT INTO
  `review` (
    `idReview`,
    `textReview`,
    `dateReview`,
    `noteReview`,
    `idClient`,
    `idMovie`
  )
VALUES
  (
    1,
    'Ce film est génial je kiff lol',
    '2021-04-12 21:25:00',
    4,
    15,
    2
  ),
  (
    2,
    'Ce film est trop cool j\'ai passé un bon moment',
    '2021-04-12 21:26:00',
    5,
    15,
    2
  ),
  (
    3,
    'C\'est bon film sympathique!!',
    '2021-04-12 21:27:00',
    3,
    15,
    10
  );
-- --------------------------------------------------------
  --
  -- Structure de la table `session`
  --
  DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
    `idSession` int(11) NOT NULL AUTO_INCREMENT,
    `dateTimeSession` datetime NOT NULL,
    `idMovie` int(11) NOT NULL,
    `adultPrice` double NOT NULL,
    `childPrice` double DEFAULT NULL,
    `studentPrice` double DEFAULT NULL,
    PRIMARY KEY (`idSession`),
    KEY `fk_sessionMovie` (`idMovie`)
  ) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
-- --------------------------------------------------------
  --
  -- Structure de la table `ticket`
  --
  DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
    `idTicket` int(11) NOT NULL AUTO_INCREMENT,
    `idSession` int(11) NOT NULL,
    `idPrice` int(11) NOT NULL,
    PRIMARY KEY (`idTicket`),
    KEY `fkTicketSession` (`idSession`),
    KEY `fk_ticketPrice` (`idPrice`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_bin;
--
  -- Contraintes pour les tables déchargées
  --
  --
  -- Contraintes pour la table `admin`
  --
ALTER TABLE
  `admin`
ADD
  CONSTRAINT `fk_adminClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`);
--
  -- Contraintes pour la table `purchase`
  --
ALTER TABLE
  `purchase`
ADD
  CONSTRAINT `fk_purchaseClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket` FOREIGN KEY (`idTicket`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket10` FOREIGN KEY (`idTicket10`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket2` FOREIGN KEY (`idTicket2`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket3` FOREIGN KEY (`idTicket3`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket4` FOREIGN KEY (`idTicket4`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket5` FOREIGN KEY (`idTicket5`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket6` FOREIGN KEY (`idTicket6`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket7` FOREIGN KEY (`idTicket7`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket8` FOREIGN KEY (`idTicket8`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `fk_purchaseTicket9` FOREIGN KEY (`idTicket9`) REFERENCES `ticket` (`idTicket`) ON DELETE CASCADE ON UPDATE CASCADE;
--
  -- Contraintes pour la table `review`
  --
ALTER TABLE
  `review`
ADD
  CONSTRAINT `fk_reviewClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `fk_reviewMovie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
  -- Contraintes pour la table `session`
  --
ALTER TABLE
  `session`
ADD
  CONSTRAINT `fk_sessionMovie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
  -- Contraintes pour la table `ticket`
  --
ALTER TABLE
  `ticket`
ADD
  CONSTRAINT `fkTicketSession` FOREIGN KEY (`idSession`) REFERENCES `session` (`idSession`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD
  CONSTRAINT `fk_ticketPrice` FOREIGN KEY (`idPrice`) REFERENCES `price` (`idPrix`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;
  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;