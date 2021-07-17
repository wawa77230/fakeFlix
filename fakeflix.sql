-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 17 juil. 2021 à 22:39
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `fakeflix`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Dessin animé'),
(2, 'Action'),
(3, 'Comédie'),
(4, 'Horreur');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(11) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iframe` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `name`, `rank`, `description`, `year`, `picture`, `iframe`, `categoryId`) VALUES
(1, 'SOUL', 3, 'Passionné de jazz et professeur de musique dans un collège, Joe Gardner a enfin l’opportunité de réaliser son rêve : jouer dans le meilleur club de jazz de New York. Mais un malencontreux faux pas le précipite dans le « Grand Avant » – un endroit fantastique où les nouvelles âmes acquièrent leur personnalité, leur caractère et leur spécificité avant d’être envoyées sur Terre. Bien décidé à retrouver sa vie, Joe fait équipe avec 22, une âme espiègle et pleine d’esprit, qui n’a jamais saisi l’intérêt de vivre une vie humaine. En essayant désespérément de montrer à 22 à quel point l’existence est formidable, Joe pourrait bien découvrir les réponses aux questions les plus importantes sur le sens de la vie.', 2020, '50206_soul.jpg', 'https://www.youtube.com/embed/xOsLIiBStEs', 1),
(2, 'Fast & Furious 8', 5, 'Fast and Furious 8 (The Fate of the Furious), ou Le Destin des dangereux au Québec, est un film d\'action américano-sino-japonais réalisé par F. Gary Gray, sorti en 2017.. Il est le 8 e opus de la franchise Fast and Furious et le premier depuis Fast and Furious: Tokyo Drift sans Paul Walker, mort pendant le tournage de Fast and Furious 7, ni Jordana Brewster.', 2020, '98470_fast.jpg', 'https://www.youtube.com/embed/xFO-pKB13mw', 2),
(3, 'Deadpool', 4, 'Deadpool, est l\'anti-héros le plus atypique de l\'univers Marvel. A l\'origine, il s\'appelle Wade Wilson : un ancien militaire des Forces Spéciales devenu mercenaire. Après avoir subi une expérimentation hors norme qui va accélérer ses pouvoirs de guérison, il va devenir Deadpool. Armé de ses nouvelles capacités et d\'un humour noir survolté, Deadpool va traquer l\'homme qui a bien failli anéantir sa vie.', 2017, '98990_deadpool.jpg', 'https://www.youtube.com/embed/XWtH7anz7io', 3),
(4, 'Cars 3', 3, 'Dépassé par une nouvelle génération de bolides ultra‐rapides, le célèbre Flash McQueen se retrouve mis sur la touche d’un sport qu’il adore. Pour revenir dans la course et prouver, en souvenir de Doc Hudson, que le n°95 a toujours sa place dans la Piston Cup, il devra faire preuve d’ingéniosité. L’aide d’une jeune mécanicienne pleine d’enthousiasme, Cruz Ramirez, qui rêve elle aussi de victoire, lui sera d’un précieux secours…', 2016, '47053_cars3.jpg', 'https://www.youtube.com/embed/rhNy0h-Hrps', 1),
(5, 'Ca', 2, 'À Derry, dans le Maine, sept gamins ayant du mal à s\'intégrer se sont regroupés au sein du \"Club des Ratés\". Rejetés par leurs camarades, ils sont les cibles favorites des gros durs de l\'école. Ils ont aussi en commun d\'avoir éprouvé leur plus grande terreur face à un terrible prédateur métamorphe qu\'ils appellent \"Ça\"…\r\nCar depuis toujours, Derry est en proie à une créature qui émerge des égouts tous les 27 ans pour se nourrir des terreurs de ses victimes de choix : les enfants. Bien décidés à rester soudés, les Ratés tentent de surmonter leurs peurs pour enrayer un nouveau cycle meurtrier. Un cycle qui a commencé un jour de pluie lorsqu\'un petit garçon poursuivant son bateau en papier s\'est retrouvé face-à-face avec le Clown Grippe-Sou …', 2017, '23300_ca.jpg', 'https://www.youtube.com/embed/Tw3yT-qAbvc', 4),
(6, 'Luca', 3, 'Dans une très jolie petite ville côtière de la Riviera italienne, un jeune garçon, Luca, vit un été inoubliable, ponctué de délicieux gelato, de savoureuses pasta et de longues balades en scooter. Il partage ses aventures avec son nouveau meilleur ami, mais ce bonheur est menacé par un secret bien gardé : tous deux sont en réalité des monstres marins venus d’un autre monde, situé juste au-dessous de la surface de l’eau…', 2021, '76777_Luca_final.jpg', 'https://www.youtube.com/embed/3z6hlUMYUnQ', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pwd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createAt` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_uindex` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `pwd`, `isAdmin`, `secret`, `createAt`) VALUES
(1, 'Warenn', 'Neves', 'fake@mail.fr', '$2y$10$tYMoPI72xffgV6RXSh7eNOMNC5pYsTn/eSZ.GBcXVnIyFx23J2Ym6', 1, '$2y$10$KQ442ZhU4XBe339Z9/AFUu.lziMGP2M4bLWn4MFg8URYQdeA.YjfS', '2021-06-02 14:42:08');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
