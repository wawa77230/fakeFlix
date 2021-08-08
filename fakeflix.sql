-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 08 août 2021 à 21:52
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Dessin-animé'),
(2, 'Action'),
(3, 'Comédie'),
(4, 'Horreur'),
(7, 'Comédie'),
(8, 'Thriller'),
(9, 'Drame');

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
  `categoryId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoryId` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `name`, `rank`, `description`, `year`, `picture`, `iframe`, `categoryId`) VALUES
(1, 'SOUL', 3, 'Passionné de jazz et professeur de musique dans un collège, Joe Gardner a enfin l’opportunité de réaliser son rêve : jouer dans le meilleur club de jazz de New York. Mais un malencontreux faux pas le précipite dans le « Grand Avant » – un endroit fantastique où les nouvelles âmes acquièrent leur personnalité, leur caractère et leur spécificité avant d’être envoyées sur Terre. Bien décidé à retrouver sa vie, Joe fait équipe avec 22, une âme espiègle et pleine d’esprit, qui n’a jamais saisi l’intérêt de vivre une vie humaine. En essayant désespérément de montrer à 22 à quel point l’existence est formidable, Joe pourrait bien découvrir les réponses aux questions les plus importantes sur le sens de la vie.', 2020, '50206_soul.jpg', 'https://www.youtube.com/embed/xOsLIiBStEs', 1),
(2, 'Fast & Furious 8', 5, 'Fast and Furious 8 (The Fate of the Furious), ou Le Destin des dangereux au Québec, est un film d\'action américano-sino-japonais réalisé par F. Gary Gray, sorti en 2017.. Il est le 8 e opus de la franchise Fast and Furious et le premier depuis Fast and Furious: Tokyo Drift sans Paul Walker, mort pendant le tournage de Fast and Furious 7, ni Jordana Brewster.', 2020, '98470_fast.jpg', 'https://www.youtube.com/embed/xFO-pKB13mw', 2),
(3, 'Deadpool', 4, 'Deadpool, est l\'anti-héros le plus atypique de l\'univers Marvel. A l\'origine, il s\'appelle Wade Wilson : un ancien militaire des Forces Spéciales devenu mercenaire. Après avoir subi une expérimentation hors norme qui va accélérer ses pouvoirs de guérison, il va devenir Deadpool. Armé de ses nouvelles capacités et d\'un humour noir survolté, Deadpool va traquer l\'homme qui a bien failli anéantir sa vie.', 2017, '98990_deadpool.jpg', 'https://www.youtube.com/embed/XWtH7anz7io', 3),
(4, 'Cars 3', 3, 'Dépassé par une nouvelle génération de bolides ultra‐rapides, le célèbre Flash McQueen se retrouve mis sur la touche d’un sport qu’il adore. Pour revenir dans la course et prouver, en souvenir de Doc Hudson, que le n°95 a toujours sa place dans la Piston Cup, il devra faire preuve d’ingéniosité. L’aide d’une jeune mécanicienne pleine d’enthousiasme, Cruz Ramirez, qui rêve elle aussi de victoire, lui sera d’un précieux secours…', 2016, '47053_cars3.jpg', 'https://www.youtube.com/embed/rhNy0h-Hrps', 1),
(5, 'Ca', 2, 'À Derry, dans le Maine, sept gamins ayant du mal à s\'intégrer se sont regroupés au sein du \"Club des Ratés\". Rejetés par leurs camarades, ils sont les cibles favorites des gros durs de l\'école. Ils ont aussi en commun d\'avoir éprouvé leur plus grande terreur face à un terrible prédateur métamorphe qu\'ils appellent \"Ça\"…\r\nCar depuis toujours, Derry est en proie à une créature qui émerge des égouts tous les 27 ans pour se nourrir des terreurs de ses victimes de choix : les enfants. Bien décidés à rester soudés, les Ratés tentent de surmonter leurs peurs pour enrayer un nouveau cycle meurtrier. Un cycle qui a commencé un jour de pluie lorsqu\'un petit garçon poursuivant son bateau en papier s\'est retrouvé face-à-face avec le Clown Grippe-Sou …', 2017, '23300_ca.jpg', 'https://www.youtube.com/embed/Tw3yT-qAbvc', 4),
(6, 'Luca', 3, 'Dans une très jolie petite ville côtière de la Riviera italienne, un jeune garçon, Luca, vit un été inoubliable, ponctué de délicieux gelato, de savoureuses pasta et de longues balades en scooter. Il partage ses aventures avec son nouveau meilleur ami, mais ce bonheur est menacé par un secret bien gardé : tous deux sont en réalité des monstres marins venus d’un autre monde, situé juste au-dessous de la surface de l’eau…', 2021, '76777_Luca_final.jpg', 'https://www.youtube.com/embed/3z6hlUMYUnQ', 1),
(7, 'BIRD BOX', 4, 'Alors qu\'une mystérieuse force décime la population mondiale, une seule chose est sûre : ceux qui ont gardé les yeux ouverts ont perdu la vie. Malgré la situation, Malorie trouve l\'amour, l\'espoir et un nouveau départ avant de tout voir s\'envoler. Désormais, elle doit prendre la fuite avec ses deux enfants, suivre une rivière périlleuse jusqu\'au seul endroit où ils peuvent encore se réfugier. Mais pour survivre, ils devront entreprendre ce voyage difficile les yeux bandés.', 2018, '71165_bird-box-challenge-inquiète-netfli.jpg', 'https://www.youtube.com/embed/o2AsIXSh2xo', 9),
(8, 'Bright', 2, 'Dans un monde contemporain alternatif, humains, orcs, elfes et fées coexistent depuis le début des temps. Défiant les genres, Bright est un film d\'action qui suit deux policiers issus de milieux différents, Ward et Jakoby. Confrontés aux ténèbres lors d\'une patrouille nocturne de routine, ils voient leur avenir et leur monde se métamorphoser à jamais.', 2017, '90749_bright.jpg', 'https://www.youtube.com/embed/ZKzvjeqmxuY', 2),
(9, 'Daredevil', 3, 'Aveugle depuis l’enfance, mais doté de sens incroyablement développés, Matt combat l’injustice le jour en tant qu’avocat et la nuit en surveillant les rue de Hell’s Kitchen, à New York, dans le costume du super-héros Daredevil.\r\nAdaptation du comic book Marvel homonyme.', 2015, '38947_daredevil-netflix-190285.jpg', 'https://www.youtube.com/embed/mGEWftxFX3M', 2),
(10, 'Dragon ball Super : Broly', 4, 'Goku et Vegeta font face à un nouvel ennemi, le Super Saïyen Légendaire Broly, dans un combat explosif pour sauver notre planète.', 2018, '68629_Dossier_DBS_Broly_000-650x412.jpg', 'https://www.youtube.com/embed/8ABbs3ryZoI', 1),
(11, 'Kingsman 3', 4, 'KINGSMAN, l’élite du renseignement britannique en costume trois pièces, fait face à une menace sans précédent. Alors qu’une bombe s’abat et détruit leur quartier général, les agents font la découverte d’une puissante organisation alliée nommée Statesman, fondée il y a bien longtemps aux Etats-Unis.\r\nFace à cet ultime danger, les deux services d’élite n’auront d’autre choix que de réunir leurs forces pour sauver le monde des griffes d’un impitoyable ennemi, qui ne reculera devant rien dans sa quête destructrice.', 2017, '51891_99438978.jpg', 'https://www.youtube.com/embed/QImgyRave8c', 2),
(12, 'Toy story 3', 3, 'Les créateurs des très populaires films Toy Story ouvrent à nouveau le coffre à jouets et invitent les spectateurs à retrouver le monde délicieusement magique de Woody et Buzz au moment où Andy s\'apprête à partir pour l\'université. Délaissée, la plus célèbre bande de jouets se retrouve... à la crèche ! Les bambins déchaînés et leurs petits doigts capables de tout arracher sont une vraie menace pour nos amis ! Il devient urgent d\'échafauder un plan pour leur échapper au plus vite. Quelques nouveaux venus vont se joindre à la Grande évasion, dont l\'éternel séducteur et célibataire Ken, compagnon de Barbie, un hérisson comédien nommé Larosse, et un ours rose parfumé à la fraise appelé Lotso.', 2010, '79663_les-10-ans-de-toy-story-3-retour-sur-le-meilleur-film-de-la-saga-2.jpg', 'https://www.youtube.com/embed/Q9vWyuAX954', 1),
(13, 'Le loup de Wallstreet', 4, 'L’argent. Le pouvoir. Les femmes. La drogue. Les tentations étaient là, à portée de main, et les autorités n’avaient aucune prise. Aux yeux de Jordan et de sa meute, la modestie était devenue complètement inutile. Trop n’était jamais assez…', 2013, '43928_maxresdefault.jpg', 'https://www.youtube.com/embed/GT9UfSqBz9o', 3),
(14, 'Zootopie', 4, 'Zootopia est une ville qui ne ressemble à aucune autre : seuls les animaux y habitent ! On y trouve des quartiers résidentiels élégants comme le très chic Sahara Square, et d’autres moins hospitaliers comme le glacial Tundratown. Dans cette incroyable métropole, chaque espèce animale cohabite avec les autres. Qu’on soit un immense éléphant ou une minuscule souris, tout le monde a sa place à Zootopia !\r\nLorsque Judy Hopps fait son entrée dans la police, elle découvre qu’il est bien difficile de s’imposer chez les gros durs en uniforme, surtout quand on est une adorable lapine. Bien décidée à faire ses preuves, Judy s’attaque à une épineuse affaire, même si cela l’oblige à faire équipe avec Nick Wilde, un renard à la langue bien pendue et véritable virtuose de l’arnaque …', 2016, '31380_scale (1).jpg', 'https://www.youtube.com/embed/F0OYU4TSOfk', 1),
(15, 'Taken', 5, 'Que peut-on imaginer de pire pour un père que d\'assister impuissant à l\'enlèvement de sa fille via un téléphone portable ? C\'est le cauchemar vécu par Bryan, ancien agent des services secrets américains, qui n\'a que quelques heures pour arracher Kim des mains d\'un redoutable gang spécialisé dans la traite des femmes. Premier problème à résoudre : il est à Los Angeles, elle vient de se faire enlever à Paris.', 2008, '20662_scale.jpg', 'https://www.youtube.com/embed/UX_71dbzJIw', 2),
(16, '007 Skyfall', 4, 'Lorsque la dernière mission de Bond tourne mal, plusieurs agents infiltrés se retrouvent exposés dans le monde entier. Le MI6 est attaqué, et M est obligée de relocaliser l’Agence. Ces événements ébranlent son autorité, et elle est remise en cause par Mallory, le nouveau président de l’ISC, le comité chargé du renseignement et de la sécurité. Le MI6 est à présent sous le coup d’une double menace, intérieure et extérieure. Il ne reste à M qu’un seul allié de confiance vers qui se tourner : Bond. Plus que jamais, 007 va devoir agir dans l’ombre. Avec l’aide d’Eve, un agent de terrain, il se lance sur la piste du mystérieux Silva, dont il doit identifier coûte que coûte l’objectif secret et mortel…', 2012, '27895_skyfall.jpg', 'https://www.youtube.com/embed/WKzm6AZFbdc', 2),
(17, 'Bienvenue chez les Ch\'tis', 4, 'Philippe Abrams est directeur de la poste de Salon-de-Provence. Il est marié à Julie, dont le caractère dépressif lui rend la vie impossible. Pour lui faire plaisir, Philippe fraude afin d\'obtenir une mutation sur la Côte d\'Azur. Mais il est démasqué: il sera muté à Bergues, petite ville du Nord.\r\nPour les Abrams, sudistes pleins de préjugés, le Nord c\'est l\'horreur, une région glacée, peuplée d\'êtres rustres, éructant un langage incompréhensible, le \"cheutimi\". Philippe ira seul. A sa grande surprise, il découvre un endroit charmant, une équipe chaleureuse, des gens accueillants, et se fait un ami : Antoine, le facteur et le carillonneur du village, à la mère possessive et aux amours contrariées. Quand Philippe revient à Salon, Julie refuse de croire qu\'il se plait dans le Nord. Elle pense même qu\'il lui ment pour la ménager. Pour la satisfaire et se simplifier la vie, Philippe lui fait croire qu\'en effet, il vit un enfer à Bergues. Dès lors, sa vie s\'enfonce dans un mensonge confortable...', 2008, '63407_tchj.pg.jpg', 'https://www.youtube.com/embed/OycTfchnopU', 3),
(18, 'The Expendables', 4, 'Ce ne sont ni des mercenaires, ni des agents secrets. Ils choisissent eux-mêmes leurs missions et n\'obéissent à aucun gouvernement. Ils ne le font ni pour l\'argent, ni pour la gloire, mais parce qu\'ils aident les cas désespérés.\r\nDepuis dix ans, Izzy Hands, de la CIA, est sur les traces du chef de ces hommes, Barney Ross. Parce qu\'ils ne sont aux ordres de personne, il devient urgent de les empêcher d\'agir. Eliminer un général sud-américain n\'est pas le genre de job que Barney Ross accepte, mais lorsqu\'il découvre les atrocités commises sur des enfants, il ne peut refuser. Avec son équipe d\'experts, Ross débarque sur l\'île paradisiaque où sévit le tyran. Lorsque l\'embuscade se referme sur eux, il comprend que dans son équipe, il y a un traître.\r\nAprès avoir échappé de justesse à la mort, ils reviennent aux Etats-Unis, où chaque membre de l\'équipe est attendu. Il faudra que chacun atteigne les sommets de son art pour en sortir et démasquer celui qui a trahi...', 2010, '71665_téléchargement (1).jpg', 'https://www.youtube.com/embed/8KtYRALe-xo', 2),
(19, 'Le Crocodile du Botswanga ', 4, 'Leslie Konda, jeune footballeur français talentueux, repéré à son adolescence par Didier, un agent de faible envergure qui a su le prendre sous sa coupe, vient de signer son premier contrat d’attaquant dans un grand club espagnol. Dans le même temps, sa notoriété grandissante et ses origines du Botswanga, petit état pauvre d’Afrique centrale, lui valent une invitation par le Président de la République en personne : Bobo Babimbi, un passionné de football, fraîchement installé au pouvoir après un coup d’état militaire. Leslie se rend donc pour la première fois dans le pays de ses ancêtres accompagné par Didier pour être décoré par le Président Bobo qui s’avère rapidement, malgré ses grands discours humanistes, être un dictateur mégalomane et paranoïaque sous l’influence néfaste de son épouse. À peine ont-ils débarqué que Bobo conclut un deal crapuleux avec Didier : faire pression sur son joueur afin que celui-ci joue pour l’équipe nationale : les Crocodiles du Botswanga…', 2014, '25316_téléchargement.jpg', 'https://www.youtube.com/embed/asslHRWJPEA', 3),
(20, 'Les Trolls 2 - Tournée mondiale', 4, 'Reine Barb, membre de la royauté hard-rock, aidée de son père Roi Thrash, veut détruire tous les autres genres de musique pour laisser le rock régner en maître. Le destin du monde en jeu, Poppy et Branch, accompagnés de leurs amis – Biggie, Chenille, Satin, Cooper  et Guy Diamond – partent visiter tous les autres territoires pour unifier les Trolls contre Barb, qui cherche à tous les reléguer au second-plan.', 2020, '29288_troll2.jpg', 'https://www.youtube.com/embed/P37FEn5DFpk', 1),
(21, 'Intouchable', 4, 'A la suite d’un accident de parapente, Philippe, riche aristocrate, engage comme aide à domicile Driss, un jeune de banlieue tout juste sorti de prison. Bref la personne la moins adaptée pour le job. Ensemble ils vont faire cohabiter Vivaldi et Earth Wind and Fire, le verbe et la vanne, les costumes et les bas de survêtement... Deux univers vont se télescoper, s’apprivoiser, pour donner naissance à une amitié aussi dingue, drôle et forte qu’inattendue, une relation unique qui fera des étincelles et qui les rendra... Intouchables.', 2011, '98906_29ddbdb402491a6aa97964a8139a1356-1417187477.jpg', 'https://www.youtube.com/embed/cXu2MhWYUuE', 3),
(22, 'Saw 4', 3, 'Le Tueur au puzzle et sa protégée, Amanda, ont disparu, mais la partie continue. Après le meurtre de l\'inspectrice Kerry, deux profileurs chevronnés du FBI, les agents Strahm et Perez, viennent aider le détective Hoffman à réunir les pièces du dernier puzzle macabre laissé par le Tueur pour essayer, enfin, de comprendre. C\'est alors que le commandant du SWAT, Rigg, est enlevé... Forcé de participer au jeu mortel, il n\'a que 90 minutes pour triompher d\'une série de pièges machiavéliques et sauver sa vie.\r\nEn cherchant Rigg à travers la ville, le détective Hoffman et les deux profileurs vont découvrir des cadavres et des indices qui vont les conduire à l\'ex-femme du Tueur, Jill. L\'histoire et les véritables intentions du Tueur au puzzle vont peu à peu être dévoilées, ainsi que ses plans sinistres pour ses victimes passées, présentes... et futures.', 2007, '56308_unnamed.jpg', 'https://www.youtube.com/embed/Qe8ZSX2NW0A', 4);

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
  `isBlocked` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_uindex` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `pwd`, `isAdmin`, `secret`, `createAt`, `isBlocked`) VALUES
(1, 'Warenn', 'Neves', 'fake@mail.fr', '$2y$10$tYMoPI72xffgV6RXSh7eNOMNC5pYsTn/eSZ.GBcXVnIyFx23J2Ym6', 1, '$2y$10$KQ442ZhU4XBe339Z9/AFUu.lziMGP2M4bLWn4MFg8URYQdeA.YjfS', '2021-06-02 12:42:08', 0),
(2, 'Tom', 'Test', 'fake@mail.com', '$2y$10$.QXwnVPKFvX0kqPh82mANOBV5VNxfIFgBaiT1em7UWWrGwNmVLyv.', 0, '$2y$10$b2hBZ/.XvIJwVr4ak7mDEeIgAS543M3SRzvi5IO9khk4qgZ2VzrhK', '2021-07-19 08:20:10', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `update Cat movie` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
