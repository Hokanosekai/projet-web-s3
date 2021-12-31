-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 31 déc. 2021 à 14:55
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webticket`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id_evt` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `img_path` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `places` int DEFAULT NULL,
  `type` int NOT NULL,
  PRIMARY KEY (`id_evt`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id_evt`, `titre`, `description`, `lieu`, `img_path`, `date_start`, `date_end`, `places`, `type`) VALUES
(1, 'Le lac des cygnes', 'Le Lac des cygnes (en russe : Лебединое озеро / Lebedinoïe ozero) est un ballet en quatre actes sur une musique de Piotr Ilitch Tchaïkovski (opus 20) et un livret de Vladimir Begitchev inspiré d\'une légende allemande. ', 'Zenith Nantes', 'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.KSxa_El5h837CnlxnA94zwHaEK%26pid%3DApi&f=1', '2021-10-01', '2021-10-31', 1000, 1),
(2, 'Le Bourgeois gentilhomme', 'Le Bourgeois gentilhomme est une comédie-ballet de Molière, en trois puis cinq actes (comportant respectivement 2, 5, 16, 5 et 6 scènes)1 en prose (sauf les entrées de ballet qui sont en vers), représentée pour la première fois le 14 octobre 1670, devant la cour de Louis XIV, au château de Chambord par la troupe de Molière. La musique est de Jean-Baptiste Lully, les ballets de Pierre Beauchamp, les décors de Carlo Vigarani et les costumes turcs du chevalier d\'Arvieux. ', 'Zenith Paris', 'https://i.imgur.com/USWVZmk.png', '2021-10-13', '2021-10-20', 3000, 1),
(3, 'Soupe Miso', 'Dès que l\'homme a pu formuler sa pensée et profitant de sa force physique, il n\'a eu de cesse que d\'opprimer le \"sexe faible\" et de le réduire à l\'état d\'esclave, de victime et d\'être inférieur.\r\nPendant des millénaires les femmes furent soumises, battues, brûlées, lapidées et torturées et c\'est toujours le cas aujourd\'hui dans nombre de pays.\r\nLe sujet n\'étant pas drôle, l\'auteur a décidé d\'en rire.\r\n\r\nAidé par trois excellentes comédiennes, il passe en revue les états généraux de la misogynie à travers l\'histoire, la littérature, la religion et tout autre support qui ont permis à l\'homme de rabaisser celle qu\'il aurait dû chérir depuis la nuit des temps. Toute ressemblance avec des mecs présents dans la salle serait purement fortuite !', 'Theatre De Dix Heures , 36 Boulevard De Clichy 75018 Paris ', 'https://i.imgur.com/byYuRva.png', '2021-12-29', '2022-01-02', 200, 1),
(4, 'ORELSAN - TOURNEE 2022', 'Après sa tournée sold out ayant remporté la Victoire de la Musique du meilleur live en 2019, Orelsan revient investir la scène mythique de l\'Accor Arena.\r\nOrelsan et son équipe s’y installeront 4 soirs du 16 au 19 mars 2022 pour vous présenter un live inédit.', 'Accor Arena , 8 Boulevard De Bercy 75012 Paris', 'https://i.imgur.com/RH01qtZ.png', '2022-03-16', '2022-03-19', 2000, 2),
(5, 'PAUL MIRABEL - ZEBRE', 'DRÔLE DE ZÈBRE : \r\n\r\nSignification :\r\nQuelqu\'un d\'étrange, bizarre, un peu hors norme, anticonformiste. \r\n\r\nOrigine :\r\nL\'expression constitue une métaphore permettant de mettre l\'accent sur la singularité d\'un individu par rapport à la norme sociale à laquelle il s\'oppose. La métaphore du zèbre est ici intéressante, puisque l\'animal fait partie de la famille des équidés, mais se différencie grandement des chevaux et des ânes par son pelage original.\r\n\r\nExemple : \r\nUn drôle de zèbre, ce type là.\r\n\r\nOriginaire de Montpellier, Paul Mirabel s’installe à Paris en 2013 pour suivre des études de commerce. Après l’obtention de son Master 2 et d’une formation de 2 ans au Cours Florent, il commence à écumer les scènes ouvertes parisiennes. Il écrit et rode son spectacle à la Petite Loge puis au Théâtre du Marais, à Paris. Paul Mirabel jouera en 2021 au Théâtre du Rond-Point, au Splendid à partir du 21 avril les mercredis, jeudis et vendredi à 19h, mais également les 20, 21, 22 et 23 décembre à 20h à La Cigale. Il partira en tournée dans toute la France en 2022 !', 'Theatre Des Mathurins , 36, Rue Des Mathurins 75008 Paris ', 'https://i.imgur.com/thujwVy.png', '2021-11-15', '2021-12-18', 1000, 3),
(6, 'TOURNEE ALBAN IVANOV \"VEDETTE\"', 'Après avoir perturbé la France avec plus de 300 représentations, 3 Olympia, le tout à guichets fermés avec son tout 1er spectacle « Élément Perturbateur », retrouvez Alban Ivanov dans son tout nouveau spectacle prochainement dans votre ville.', ' La Cigale , 120, Bld Rochechouart 75018 Paris ', 'https://i.imgur.com/k2X20I5.png', '2020-03-31', '2021-10-23', 300, 3),
(7, 'PAUL TAYLOR ', 'Je m’appelle Paul, je suis Anglais et j’habite en France.\r\n\r\nJ’ai fait un premier spectacle de stand-up intitulé “#FRANGLAIS” which was half in English and half in French. It went pretty well, so I’ve decided to do another show called “So British (ou presque)”. It’s the same concept. A show that is in both languages but with brand new jokes and stories that you’ve never seen before.\r\n\r\nEt si tu te poses la question: “Est-ce que je vais comprendre son anglais?”, j’ai une astuce: si t’as compris cette description, c’est bon. Sinon, j’ai un pote qui peut t’aider à préparer le TOEIC. Si tu ne sais pas ce que c’est le TOEIC, là, je peux vraiment pas t’aider. If your French is good enough to understand this description, you’ll bee laughing.\r\n\r\nSee you on stage!\r\n\r\n', 'Grand Rex , 1, Bd Poissonnière 75002 Paris ', 'https://i.imgur.com/Mbp0yJE.png', '2020-06-06', '2021-10-20', 200, 3),
(8, 'HAROUN', 'Avec son style impeccable et son analyse des failles de notre société, Haroun a cassé les codes de l\'humour. Sur internet ses vidéos iconiques font des millions de vues. Il aime proposer de la nouveauté et surprendre son public. Après le succès incontesté de ses pasquinades, il est de retour sur scène avec son nouveau spectacle “Seuls”.', ' Theatre Édouard Vii , 10, Place Édouard Vii 75009 Paris ', 'https://i.imgur.com/XMaXLO3.png', '2021-01-09', '2022-01-02', 500, 3),
(9, 'ENTRÉE - MUSÉE D\'ORSAY', 'Exposition(s):\r\nDu 28 septembre 2021 au 16 janvier 2022\r\n« Enfin le cinéma ! Arts, images et spectacles en France (1833- 1907) »\r\n\r\nÀ l’aube du XXème siècle, le cinéma est tout autant, sinon plus, une manière de s’approprier le monde, les corps et les représentations, qu’une machine ou un média. Nouveau regard éminemment social et populaire, il est le produit d’une culture urbaine fascinée par le mouvement des êtres et des choses et désireuse de faire de la « modernité » un spectacle.\r\n\r\nL’exposition rassemble près de 300 œuvres, objets et films aussi bien anonymes que signés de noms bien connus du grand public, de Pierre Bonnard à Auguste Rodin en passant par Gustave Caillebotte, Loïe Fuller, Léon Gaumont, Jean Léon Gérôme, Alice Guy, Auguste et Louis Lumière, Jules Etienne Marey, Georges Méliès, Claude Monet, Berthe Morisot, Charles Pathé ou Henri Rivière.', 'Musee D\'orsay , Esplanade Valéry Giscard D\'estaing 75007 Paris ', 'https://i.imgur.com/2vzb7iv.png', '2021-05-19', '2022-01-16', 400, 4),
(10, 'DESTINATION COSMOS, L\'ULTIME DÉFI', 'Culturespaces s’associe au Centre National d’Études Spatiales (CNES) pour présenter lors de soirées exceptionnelles DESTINATION COSMOS, une création originale pour l’Atelier des Lumières. À cette occasion, le premier centre d’art numérique à Paris, ouvre ses portes en soirée à partir des vacances de la Toussaint. \r\n\r\nDes premiers peuples à avoir observé les étoiles en passant par l’alunissage d’Apollo 11, l’envie de découverte spatiale de l’humanité ne cesse de croître. « Destination Cosmos, l’ultime défi » plonge le public dans un dédale d’étoiles, de planètes, nébuleuses et supernova. \r\nUn voyage unique qui débute au cœur de la forêt tropicale guyanaise et prend fin aux confins de l’univers. \r\n\r\nLe visiteur, après avoir quitté la terre, est invité a sillonner les canyons martiens aux côtés des rovers (véhicule conçu pour explorer la surface d’un corps céleste), plonger au cœur de Jupiter, survoler les anneaux de Saturne puis dépasser les frontières de notre système solaire afin d’explorer l’immensité de notre univers. Totalement immergé dans l’image et la musique, « Destination Cosmos » emporte le public dans une aventure spatiale inédite !', 'Atelier Des Lumières , 38 Rue Saint-maur 75011 Paris ', 'https://i.imgur.com/vRt35ZP.png', '2021-10-22', '2021-11-20', 540, 4),
(11, 'ANNE IMHOF, NATURES MORTES', 'Après avoir pris possession de l’ensemble du Palais de Tokyo, pour y composer le premier acte de Natures Mortes, œuvre totale et polyphonique, Anne Imhof, récompensée par le Lion d’or à la Biennale de Venise pour son opus Faust (2017) compose une nouvelle œuvre performative qui capte les pulsations du cycle fugace de la vie et les déflagrations du temps présent.\r\n\r\nLa dimension performative de l’œuvre d’Anne Imhof qui infusait toute l’exposition, des œuvres plastiques aux compositions sonores, de l’architecture aux corps, s’expose en symbiose avec l’espace. Même dépouillée de la présence humaine, au-delà de tout spectacle, l’acte 1 de l’exposition portait en creux l’empreinte des corps évanouis, les traces de leur présence, faisait résonner leur voix se déplaçant sans fin dans l’espace.\r\n\r\nLes performeurs, ses complices de longue date, s’emparent de l’espace, des Rooms qui ménagent des haltes d’intimité, des High Beds et Diving Boards, où les corps au repos reprennent leur souffle avant de s’engager dans des pas de deux, où les identités se dissolvent, en des processions rituelles d’une nouvelle ère, en des échappées où les frontières entre l’espace intérieur et la rue sont rendues caduques.\r\n\r\nL’espace d’exposition, la rue intérieure, le labyrinthe impulsent leurs rythmes intrinsèques, canalisent les corps, les invitent à ralentir, alors que les courbes, comme des pistes de course appellent le mouvement, la vitesse. Comme animés par l’urgence de soulèvements à venir, les corps se rassemblent, se mêlent, s’entrechoquent, avant de se disperser et de s’échapper, de générer de nouvelles images d’un instant.', 'Palais De Tokyo , 13, Av. Du Président Wilson 75116 Paris ', 'https://i.imgur.com/Lw5nri7.png', '2021-10-14', '2021-10-24', 650, 4),
(12, 'ENTRÉE - MUSÉE DE L\'ORANGERIE', 'Le musée de l’Orangerie présente une exposition faisant dialoguer les œuvres de Chaïm Soutine (1893–1943), peintre de l’École de Paris d’origine russe (actuelle Biélorussie) et de Willem de Kooning (1904-1997), expressionniste abstrait américain d’origine néerlandaise. Cette exposition s’attachera plus spécifiquement à explorer l’impact de la peinture de Soutine sur la vision picturale du grand peintre américain.', 'Musee De L\'orangerie , Jardin Des Tuileries -cote Seine Place De La Concorde 75001 Paris ', 'https://i.imgur.com/o05m2p8.png', '2021-06-09', '2022-01-10', 250, 4),
(13, 'PARIS-ATHÈNES', 'Organisée à l’occasion du bicentenaire de la Révolution grecque de 1821, l’exposition souhaite mettre en valeur les liens unissant la Grèce et la culture européenne, en  suivant notamment le fil des relations entre Paris et Athènes.\r\n\r\nAux 17e et 18e siècles, les ambassadeurs en route vers la Sublime Porte découvrent en Grèce une province ottomane, qui intéresse vivement les artistes et les  intellectuels. En 1821, la guerre d’Indépendance grecque, soutenue militairement et financièrement par certains pays européens, suscite un enthousiasme populaire. Libérée en 1829, la Grèce proclame Athènes comme capitale en 1834. Influencé par la présence allemande et française sur son territoire, le nouvel État grec construit son identité culturelle moderne en puisant aux sources du néoclassicisme français et allemand. La défense du patrimoine national et la collaboration européenne marquée par la création d’instituts archéologiques, comme l’École française d’Athènes en 1846, sont à l’origine d’un bouleversement des connaissances sur le passé matériel de la Grèce.\r\n\r\nL’exposition entend pour la première fois croiser cette histoire de l’archéologie avec l’histoire du développement de l’État grec et des arts modernes. Les fouilles de Délos,  Delphes ou de l’Acropole sont à l’origine de la redécouverte d’une Grèce colorée très éloignée des canons du néoclassicisme. À la fin du 19e siècle, les grandes  expositions universelles donnent à voir un nouvel art grec moderne, marqué par la reconnaissance de l’identité byzantine et orthodoxe de la Grèce.', 'Musee Du Louvre , 162 Rue De Rivoli 75001 Paris ', 'https://i.imgur.com/91vlMRz.png', '2021-09-30', '2022-02-07', 100, 4),
(19, 'TEST NEW UI', 'dsfhsdfhsdkhf', 'Nantes 44200', 'https://i.imgur.com/ge4qp03.png', '2021-12-24', '2021-12-31', 899, 1);

-- --------------------------------------------------------

--
-- Structure de la table `evt_types`
--

DROP TABLE IF EXISTS `evt_types`;
CREATE TABLE IF NOT EXISTS `evt_types` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `evt_types`
--

INSERT INTO `evt_types` (`id_type`, `name`) VALUES
(1, 'theatre'),
(2, 'concert'),
(3, 'humour'),
(4, 'exposition');

-- --------------------------------------------------------

--
-- Structure de la table `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE IF NOT EXISTS `prices` (
  `id_price` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `evt_id` int NOT NULL,
  PRIMARY KEY (`id_price`),
  KEY `evt_id` (`evt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prices`
--

INSERT INTO `prices` (`id_price`, `titre`, `prix`, `evt_id`) VALUES
(1, 'Etudiant', 9, 1),
(2, 'Enfant', 5, 1),
(3, 'Adulte', 14.5, 1),
(4, 'Enfant', 5, 19),
(9, 'Etudiant', 9, 2),
(10, 'Adulte', 12, 2),
(11, 'Enfant', 5, 2),
(12, 'Normale', 12.99, 3),
(13, 'Adulte', 13, 19),
(16, 'Adulte', 12.99, 7),
(17, 'Etudiant', 7.5, 7),
(18, 'Enfant', 4, 7),
(19, 'Normal', 5, 8),
(20, 'Fosse', 57, 4),
(21, 'Gradins', 28, 4),
(22, 'Loge', 45, 4);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_res` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `evt_id` int NOT NULL,
  `prix` double NOT NULL,
  `date` date NOT NULL,
  `create_at` date DEFAULT (curdate()),
  `hour` int DEFAULT NULL,
  PRIMARY KEY (`id_res`),
  KEY `evt_id` (`evt_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id_res`, `user_id`, `evt_id`, `prix`, `date`, `create_at`, `hour`) VALUES
(31, 1, 1, 143.5, '2021-10-14', '2021-12-29', 11),
(32, 1, 3, 51.96, '2021-12-30', '2021-12-31', 12),
(33, 1, 4, 159, '2022-03-17', '2021-12-31', 17);

-- --------------------------------------------------------

--
-- Structure de la table `reservations_prices`
--

DROP TABLE IF EXISTS `reservations_prices`;
CREATE TABLE IF NOT EXISTS `reservations_prices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `count` int NOT NULL,
  `total` text COLLATE utf8mb4_general_ci NOT NULL,
  `price_id` int DEFAULT NULL,
  `reservation_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `price_id` (`price_id`),
  KEY `reservation_id` (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservations_prices`
--

INSERT INTO `reservations_prices` (`id`, `count`, `total`, `price_id`, `reservation_id`) VALUES
(8, 3, '27', 1, 31),
(9, 3, '15', 2, 31),
(10, 7, '101.5', 3, 31),
(11, 4, '51.96', 12, 32),
(12, 2, '114', 20, 33),
(13, 1, '45', 22, 33);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('admin','user') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'user',
  `create_at` date DEFAULT (curdate()),
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nom`, `prenom`, `mail`, `password`, `type`, `create_at`) VALUES
(1, 'root', 'root', 'root@root.com', '$2y$10$mpGpY.RdDO4X8ucE5w7UKeP.IGobez6YL6eUhs3iccE4IXC13UXNO', 'admin', '2021-12-01'),
(6, 'raillard', 'arsene', 'arsene.raillard@gmail.com', '$2y$10$T4c96t3iIJNxRWayH6c2Rem4T7PZOOtf9USiKcEoXKzxN1l9I2Xja', 'user', '2021-12-22'),
(7, 'raillard', 'arsene', 'arsene.raillard44@gmail.com', '$2y$10$FZAxFpBHqEhH9Vu2zTIrQe6rQ7e4LfjhyVbvwMu90HpcaLGrkkvui', 'user', '2021-12-13');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_ibfk_1` FOREIGN KEY (`type`) REFERENCES `evt_types` (`id_type`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`evt_id`) REFERENCES `evenements` (`id_evt`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`evt_id`) REFERENCES `evenements` (`id_evt`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `reservations_prices`
--
ALTER TABLE `reservations_prices`
  ADD CONSTRAINT `reservations_prices_prices_id_price_fk` FOREIGN KEY (`price_id`) REFERENCES `prices` (`id_price`),
  ADD CONSTRAINT `reservations_prices_reservations_id_res_fk` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id_res`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
