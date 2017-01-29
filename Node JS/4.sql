-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 06 Janvier 2017 à 05:02
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sweet_follow`
--
CREATE DATABASE IF NOT EXISTS `sweet_follow` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sweet_follow`;

-- --------------------------------------------------------

--
-- Structure de la table `aime_commentaire`
--

CREATE TABLE `aime_commentaire` (
  `id_commentaire_aime_commentaire` int(255) NOT NULL,
  `id_utilisateur_aime_commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `aime_commentaire`
--

INSERT INTO `aime_commentaire` (`id_commentaire_aime_commentaire`, `id_utilisateur_aime_commentaire`) VALUES
(1, 'bt.bassem@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `aime_pub`
--

CREATE TABLE `aime_pub` (
  `id_publication_aime_pub` int(255) NOT NULL,
  `id_utilisateur_aime_pub` varchar(255) NOT NULL,
  `emoji_aime_pub` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `aime_pub`
--

INSERT INTO `aime_pub` (`id_publication_aime_pub`, `id_utilisateur_aime_pub`, `emoji_aime_pub`) VALUES
(1, 'anas.saoudi@gmail.com', 'j\'aime'),
(1, 'zeddini.safa@gmail.com', 'j\'aime'),
(2, 'bt.bassem@gmail.com', 'j\'aime'),
(4, 'bt.bassem@gmail.com', 'j\'aime'),
(10, 'zeddini.safa@gmail.com', 'j\'aime'),
(11, 'anas.saoudi@gmail.com', 'j\'aime'),
(11, 'bt.bassem@gmail.com', 'j\'aime'),
(11, 'nadhem.lamin@gmail.com', 'j\'aime'),
(12, 'anas.saoudi@gmail.com', 'j\'aime'),
(12, 'zeddini.safa@gmail.com', 'j\'aime'),
(13, 'bt.bassem@gmail.com', 'j\'aime'),
(19, 'anas.saoudi@gmail.com', 'j\'aime'),
(19, 'bt.bassem@gmail.com', 'j\'aime');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(255) NOT NULL,
  `admin_commentaire` varchar(255) NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu_commentaire` text NOT NULL,
  `publication_commentaire` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `admin_commentaire`, `date_commentaire`, `contenu_commentaire`, `publication_commentaire`) VALUES
(1, 'zeddini.safa@gmail.com', '2016-11-22 00:00:00', 'oui !', 1),
(5, 'bt.bassem@gmail.com', '2016-12-31 00:14:03', 'qsdqsd', 11),
(13, 'anas.saoudi@gmail.com', '2017-01-02 06:38:31', 'bel7a9 !?', 1),
(14, 'anas.saoudi@gmail.com', '2017-01-02 10:59:37', 'hkjghjhgb', 1),
(16, 'anas.saoudi@gmail.com', '2017-01-02 10:59:49', 'bhjbhn', 13),
(17, 'anas.saoudi@gmail.com', '2017-01-02 10:59:58', 'l,kl', 13),
(30, 'bt.bassem@gmail.com', '2017-01-04 02:10:03', 'sqcqsc', 9),
(33, 'bt.bassem@gmail.com', '2017-01-04 03:34:31', 'azdazdzad', 11),
(38, 'bt.bassem@gmail.com', '2017-01-04 04:24:36', 'rtfgh', 2),
(40, 'bt.bassem@gmail.com', '2017-01-06 03:09:07', 'qscqscqscqs', 12),
(41, 'bt.bassem@gmail.com', '2017-01-06 03:10:28', 'dvsdv', 19),
(42, 'bt.bassem@gmail.com', '2017-01-06 03:27:49', 'QSCSQC', 19),
(43, 'anas.saoudi@gmail.com', '2017-01-06 04:46:14', 'dfvfdvdfv', 19);

-- --------------------------------------------------------

--
-- Structure de la table `confidentialite`
--

CREATE TABLE `confidentialite` (
  `nom_confidentialité` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `confidentialite`
--

INSERT INTO `confidentialite` (`nom_confidentialité`) VALUES
('Amis'),
('Privé'),
('Public'),
('Secret');

-- --------------------------------------------------------

--
-- Structure de la table `emoji`
--

CREATE TABLE `emoji` (
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `emoji`
--

INSERT INTO `emoji` (`nom`) VALUES
(':\'('),
('Grrr'),
('Haha'),
('j\'aime');

-- --------------------------------------------------------

--
-- Structure de la table `entite`
--

CREATE TABLE `entite` (
  `id_entite` int(255) NOT NULL,
  `nom_entite` varchar(255) NOT NULL,
  `photo_entite` varchar(255) NOT NULL DEFAULT 'default.png',
  `photo_journal_entite` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `date_creation_entite` date DEFAULT NULL,
  `adresse_entite` varchar(255) DEFAULT NULL,
  `numero_tele_entite` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `entite`
--

INSERT INTO `entite` (`id_entite`, `nom_entite`, `photo_entite`, `photo_journal_entite`, `date_creation_entite`, `adresse_entite`, `numero_tele_entite`) VALUES
(1, 'Ben Tili', 'photo_principal_bentili.jpg', 'photo_journal_bentili.jpg', '2016-11-01', 'Mornaguia', 52726127),
(2, 'Saoudi', 'photo_principal_anas.png', 'photo_journal_anas.jpg', '2016-11-02', 'Jdaida', 50807184),
(3, 'Lamin', 'photo_principal_nadhem.png', 'photo_journal_nadhem.jpg', '2016-11-03', 'Ibn Khaldoun', 55676978),
(4, 'Zeddini', 'photo_principal_safa.png', 'photo_journal_safa.jpg', '2016-11-05', 'Mhamdia', 52041629),
(5, 'FailArmy', 'https://fb-s-a-a.akamaihd.net/h-ak-xaf1/v/t1.0-1/p200x200/11078204_783564458407385_5030416413522004247_n.jpg?oh=77cb835c20ddd6534327048a3ca5ad75&oe=58CC2021&__gda__=1489374460_a6ae27a8fbccefaff7703e63e1fd9e7b', 'https://scontent-cdg2-1.xx.fbcdn.net/v/t1.0-9/13962644_1073418339421994_7236849870197204162_n.png?oh=e4af3c79015da3796e18b3c5a9738fd8&oe=58B94C77', '2016-11-01', 'US', 0),
(6, 'Groupe Inrev', 'image_groupe_inrev.jpg', 'image_journal_groupe_inrev.jpg', '2016-11-01', 'Manouba', 0);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(255) NOT NULL,
  `admin_groupe` varchar(255) NOT NULL,
  `confidentialite_groupe` varchar(255) NOT NULL,
  `nature_groupe` varchar(255) NOT NULL,
  `entite_groupe` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `admin_groupe`, `confidentialite_groupe`, `nature_groupe`, `entite_groupe`) VALUES
(1, 'nadhem.lamin@gmail.com', 'Public', 'Évènements et projets', 6);

-- --------------------------------------------------------

--
-- Structure de la table `liste_amis`
--

CREATE TABLE `liste_amis` (
  `id_utilisateur_liste_amis` varchar(255) NOT NULL,
  `id_ami_liste_amis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `liste_amis`
--

INSERT INTO `liste_amis` (`id_utilisateur_liste_amis`, `id_ami_liste_amis`) VALUES
('bt.bassem@gmail.com', 'anas.saoudi@gmail.com'),
('nadhem.lamin@gmail.com', 'anas.saoudi@gmail.com'),
('bt.bassem@gmail.com', 'zeddini.safa@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `liste_attente`
--

CREATE TABLE `liste_attente` (
  `id_demandeur_liste_attente` varchar(255) NOT NULL,
  `id_recepteur_liste_attente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `liste_attente`
--

INSERT INTO `liste_attente` (`id_demandeur_liste_attente`, `id_recepteur_liste_attente`) VALUES
('bt.bassem@gmail.com', 'nadhem.lamin@gmail.com'),
('anas.saoudi@gmail.com', 'zeddini.safa@gmail.com'),
('nadhem.lamin@gmail.com', 'zeddini.safa@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `liste_groupe`
--

CREATE TABLE `liste_groupe` (
  `id_groupe_liste_groupe` int(255) NOT NULL,
  `id_utilisateur_liste_groupe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `liste_groupe`
--

INSERT INTO `liste_groupe` (`id_groupe_liste_groupe`, `id_utilisateur_liste_groupe`) VALUES
(1, 'anas.saoudi@gmail.com'),
(1, 'bt.bassem@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `liste_page`
--

CREATE TABLE `liste_page` (
  `id_page_liste_page` int(255) NOT NULL,
  `id_utilisateur_liste_page` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `liste_page`
--

INSERT INTO `liste_page` (`id_page_liste_page`, `id_utilisateur_liste_page`) VALUES
(1, 'bt.bassem@gmail.com'),
(1, 'zeddini.safa@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_message` int(255) NOT NULL,
  `expediteur_message` varchar(255) NOT NULL,
  `recepteur_message` varchar(255) NOT NULL,
  `date_message` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `message`
--

INSERT INTO `message` (`id_message`, `expediteur_message`, `recepteur_message`, `date_message`, `contenu_message`) VALUES
(101, 'bt.bassem@gmail.com', 'anas.saoudi@gmail.com', '2016-12-30 06:33:43', 'Bonjour ! :D'),
(102, 'bt.bassem@gmail.com', 'zeddini.safa@gmail.com', '2016-12-30 06:33:52', 'Hello ! :)'),
(103, 'zeddini.safa@gmail.com', 'bt.bassem@gmail.com', '2016-12-30 22:38:59', 'rthfgb'),
(104, 'zeddini.safa@gmail.com', 'bt.bassem@gmail.com', '2016-12-30 22:39:07', 'bassem ! :)'),
(105, 'zeddini.safa@gmail.com', 'bt.bassem@gmail.com', '2016-12-30 22:39:20', ':) :( XD :p'),
(106, 'zeddini.safa@gmail.com', 'bt.bassem@gmail.com', '2016-12-30 22:40:13', ':o'),
(107, 'bt.bassem@gmail.com', 'zeddini.safa@gmail.com', '2017-01-02 04:29:00', 'jhgfd'),
(108, 'bt.bassem@gmail.com', 'bt.bassem@gmail.com', '2017-01-02 07:11:15', 'dsfsdf'),
(109, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-02 10:57:18', ' fgbfgbfg'),
(110, 'bt.bassem@gmail.com', 'anas.saoudi@gmail.com', '2017-01-02 10:57:20', 'fgbfgbf'),
(111, 'bt.bassem@gmail.com', 'anas.saoudi@gmail.com', '2017-01-02 10:57:21', 'fgbfgbf'),
(112, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-02 10:57:24', 'fgbfgbgfb :p'),
(113, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-02 10:57:38', ':o'),
(114, 'bt.bassem@gmail.com', 'anas.saoudi@gmail.com', '2017-01-02 10:57:49', 'jubuh :)'),
(115, 'bt.bassem@gmail.com', 'anas.saoudi@gmail.com', '2017-01-02 10:57:57', 'gvuyb'),
(116, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-02 10:58:00', 'ijiojio'),
(117, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-02 10:58:42', 'fghgfh :)'),
(118, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-02 10:58:45', 'ftft'),
(119, 'bt.bassem@gmail.com', 'anas.saoudi@gmail.com', '2017-01-02 10:58:47', 'bkbhhjk'),
(120, 'bt.bassem@gmail.com', 'zeddini.safa@gmail.com', '2017-01-06 03:11:10', 'sdcsdc :p'),
(121, 'bt.bassem@gmail.com', 'anas.saoudi@gmail.com', '2017-01-06 04:44:16', 'eddfvsdfvw '),
(122, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-06 04:44:18', 'sdcdscds'),
(123, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-06 04:44:55', ':p'),
(124, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-06 04:45:04', ':)'),
(125, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-06 04:45:07', ':o'),
(126, 'anas.saoudi@gmail.com', 'bt.bassem@gmail.com', '2017-01-06 04:45:13', ':D');

-- --------------------------------------------------------

--
-- Structure de la table `nature_groupe`
--

CREATE TABLE `nature_groupe` (
  `nom_nature_groupe` varchar(255) NOT NULL,
  `icon_nature_groupe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `nature_groupe`
--

INSERT INTO `nature_groupe` (`nom_nature_groupe`, `icon_nature_groupe`) VALUES
('Achats/Ventes', 'https://fb-s-c-a.akamaihd.net/h-ak-xal1/v/t1.0-0/p64x64/11870885_10150022838999021_529246704519500013_n.png?oh=0d701298da3c4729c7dc56e1319a2c7f&oe=58B9D4E9&__gda__=1490349764_e27330c1a0cc6326c04479356ff3db26'),
('Équipe', 'https://fbcdn-photos-d-a.akamaihd.net/hphotos-ak-xtp1/v/t1.0-0/p64x64/10610864_10150002652610157_4143904235430677071_n.png?oh=0850517ed86346583cad985f02f43836&oe=58B9A408&__gda__=1490111647_c69a5bd056fcd06a15b0d01b9a044912'),
('Évènements et projets', 'https://fb-s-d-a.akamaihd.net/h-ak-xpa1/v/t1.0-0/p64x64/10624668_10150002652607835_4766239670896801975_n.png?oh=024b3c141fcbea452ff50eb031bf7959&oe=58BB3EB8&__gda__=1488758116_4cfc16464f4f43eb8cfab51806299d50'),
('Voyages', 'https://fb-s-a-a.akamaihd.net/h-ak-xfp1/v/t1.0-0/p64x64/10364212_10150002652609014_2524896271698885525_n.png?oh=8c94d1b475c422b5aa76747687f5a3c5&oe=58CBAC66&__gda__=1488533356_549841f0f469288acd4acf7085786af1');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id_notification_notification` int(255) NOT NULL,
  `acteur_notification` varchar(255) NOT NULL,
  `id_publication_notification` varchar(255) DEFAULT NULL,
  `date_notification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_notification` varchar(255) NOT NULL,
  `etat_notification` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `page`
--

CREATE TABLE `page` (
  `id_page` int(255) NOT NULL,
  `admin_page` varchar(255) NOT NULL,
  `entite_page` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `page`
--

INSERT INTO `page` (`id_page`, `admin_page`, `entite_page`) VALUES
(1, 'anas.saoudi@gmail.com', 5);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id_publication` int(255) NOT NULL,
  `contenu_publication` text NOT NULL,
  `date_publication` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `admin_publication` int(255) NOT NULL,
  `multimedia_publication` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`id_publication`, `contenu_publication`, `date_publication`, `admin_publication`, `multimedia_publication`) VALUES
(1, 'bonjour je suis Bassem', '2016-11-20 23:16:20', 1, ''),
(2, 'bonjour je suis safa', '2016-12-26 03:15:27', 4, 'young-couple-in-love.jpg'),
(3, 'Bonjour je suis anas', '2016-12-25 02:15:56', 2, ''),
(4, 'bonjour je suis nadhem', '2016-12-25 02:16:32', 3, ''),
(9, 'dsfdsf', '2016-12-30 18:47:36', 1, ''),
(10, 'Bonjour :', '2016-12-30 22:36:48', 1, ''),
(11, 'bassem !!!', '2016-12-30 22:37:50', 4, ''),
(12, 'gh,hg', '2016-12-30 22:50:05', 2, ''),
(13, 'rregeer', '2016-12-30 22:51:18', 1, ''),
(14, 'wxcwxwxc', '2017-01-03 23:41:41', 1, ''),
(15, 'dfsdf', '2017-01-04 01:24:53', 1, ''),
(16, 'qscqscqsc', '2017-01-04 01:26:04', 1, ''),
(17, 'qscqsc', '2017-01-04 01:26:38', 1, ''),
(18, 'qscqsc', '2017-01-04 01:27:58', 1, ''),
(19, 'qscqsc', '2017-01-04 01:28:02', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

CREATE TABLE `sexe` (
  `nom_sexe` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `sexe`
--

INSERT INTO `sexe` (`nom_sexe`) VALUES
('Femme'),
('Homme');

-- --------------------------------------------------------

--
-- Structure de la table `type_notification`
--

CREATE TABLE `type_notification` (
  `nom_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `type_notification`
--

INSERT INTO `type_notification` (`nom_type`) VALUES
('accepter votre invitation'),
('commentaire'),
('envoyer une invitation'),
('j\'aime'),
('partage');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `email_utilisateur` varchar(255) NOT NULL,
  `prenom_utilisateur` varchar(255) NOT NULL,
  `password_utilisateur` varchar(255) NOT NULL,
  `date_naissance_utilisateur` date DEFAULT NULL,
  `origine_utilisateur` varchar(255) DEFAULT NULL,
  `entite_utilisateur` int(255) DEFAULT NULL,
  `sexe` varchar(5) DEFAULT 'Homme'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email_utilisateur`, `prenom_utilisateur`, `password_utilisateur`, `date_naissance_utilisateur`, `origine_utilisateur`, `entite_utilisateur`, `sexe`) VALUES
('anas.saoudi@gmail.com', 'Anas', '0000', '1992-05-20', 'Tunis', 2, 'Homme'),
('bt.bassem@gmail.com', 'Bassem', '0000', '1992-10-15', 'Djerba', 1, 'Homme'),
('nadhem.lamin@gmail.com', 'Nadhem', '0000', '1992-06-14', 'Tunis', 3, 'Homme'),
('zeddini.safa@gmail.com', 'Safa', '0000', '1992-10-02', 'Tunis', 4, 'Femme');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `aime_commentaire`
--
ALTER TABLE `aime_commentaire`
  ADD PRIMARY KEY (`id_commentaire_aime_commentaire`,`id_utilisateur_aime_commentaire`),
  ADD KEY `id_utilisateur_aime_commentaire` (`id_utilisateur_aime_commentaire`);

--
-- Index pour la table `aime_pub`
--
ALTER TABLE `aime_pub`
  ADD PRIMARY KEY (`id_publication_aime_pub`,`id_utilisateur_aime_pub`,`emoji_aime_pub`),
  ADD KEY `emoji_aime_pub` (`emoji_aime_pub`),
  ADD KEY `aime_pub_ibfk_4` (`id_utilisateur_aime_pub`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `proprietaire_commentaire` (`admin_commentaire`),
  ADD KEY `publication_commentaire` (`publication_commentaire`);

--
-- Index pour la table `confidentialite`
--
ALTER TABLE `confidentialite`
  ADD PRIMARY KEY (`nom_confidentialité`);

--
-- Index pour la table `emoji`
--
ALTER TABLE `emoji`
  ADD PRIMARY KEY (`nom`);

--
-- Index pour la table `entite`
--
ALTER TABLE `entite`
  ADD PRIMARY KEY (`id_entite`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id_groupe`),
  ADD UNIQUE KEY `entite_groupe` (`entite_groupe`),
  ADD KEY `proprietaire_groupe` (`admin_groupe`),
  ADD KEY `confidentialite_groupe` (`confidentialite_groupe`),
  ADD KEY `nature_groupe` (`nature_groupe`);

--
-- Index pour la table `liste_amis`
--
ALTER TABLE `liste_amis`
  ADD PRIMARY KEY (`id_utilisateur_liste_amis`,`id_ami_liste_amis`),
  ADD KEY `id_ami_liste_amis` (`id_ami_liste_amis`);

--
-- Index pour la table `liste_attente`
--
ALTER TABLE `liste_attente`
  ADD PRIMARY KEY (`id_demandeur_liste_attente`,`id_recepteur_liste_attente`),
  ADD KEY `id_recepteur_liste_attente` (`id_recepteur_liste_attente`);

--
-- Index pour la table `liste_groupe`
--
ALTER TABLE `liste_groupe`
  ADD PRIMARY KEY (`id_groupe_liste_groupe`,`id_utilisateur_liste_groupe`),
  ADD KEY `id_utilisateur_liste_groupe` (`id_utilisateur_liste_groupe`);

--
-- Index pour la table `liste_page`
--
ALTER TABLE `liste_page`
  ADD PRIMARY KEY (`id_page_liste_page`,`id_utilisateur_liste_page`),
  ADD KEY `id_utilisateur_liste_page` (`id_utilisateur_liste_page`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `expediteur_message` (`expediteur_message`),
  ADD KEY `recepteur_message` (`recepteur_message`),
  ADD KEY `expediteur_message_2` (`expediteur_message`),
  ADD KEY `recepteur_message_2` (`recepteur_message`);

--
-- Index pour la table `nature_groupe`
--
ALTER TABLE `nature_groupe`
  ADD PRIMARY KEY (`nom_nature_groupe`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification_notification`),
  ADD KEY `id_utilisateur_notification` (`acteur_notification`),
  ADD KEY `id_publication_notification` (`id_publication_notification`),
  ADD KEY `type_notification` (`type_notification`);

--
-- Index pour la table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`),
  ADD UNIQUE KEY `entite_page` (`entite_page`),
  ADD KEY `proprietaire_page` (`admin_page`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id_publication`),
  ADD KEY `proprietaire_publication` (`admin_publication`);

--
-- Index pour la table `sexe`
--
ALTER TABLE `sexe`
  ADD PRIMARY KEY (`nom_sexe`);

--
-- Index pour la table `type_notification`
--
ALTER TABLE `type_notification`
  ADD PRIMARY KEY (`nom_type`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`email_utilisateur`),
  ADD UNIQUE KEY `entite_utilisateur` (`entite_utilisateur`),
  ADD KEY `sexe` (`sexe`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `entite`
--
ALTER TABLE `entite`
  MODIFY `id_entite` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id_groupe` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification_notification` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT pour la table `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id_publication` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `aime_commentaire`
--
ALTER TABLE `aime_commentaire`
  ADD CONSTRAINT `aime_commentaire_ibfk_1` FOREIGN KEY (`id_commentaire_aime_commentaire`) REFERENCES `commentaire` (`id_commentaire`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aime_commentaire_ibfk_2` FOREIGN KEY (`id_utilisateur_aime_commentaire`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `aime_pub`
--
ALTER TABLE `aime_pub`
  ADD CONSTRAINT `aime_pub_ibfk_1` FOREIGN KEY (`id_publication_aime_pub`) REFERENCES `publication` (`id_publication`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aime_pub_ibfk_3` FOREIGN KEY (`emoji_aime_pub`) REFERENCES `emoji` (`nom`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aime_pub_ibfk_4` FOREIGN KEY (`id_utilisateur_aime_pub`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`admin_commentaire`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`publication_commentaire`) REFERENCES `publication` (`id_publication`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `groupe_ibfk_1` FOREIGN KEY (`admin_groupe`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_ibfk_2` FOREIGN KEY (`confidentialite_groupe`) REFERENCES `confidentialite` (`nom_confidentialité`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_ibfk_3` FOREIGN KEY (`nature_groupe`) REFERENCES `nature_groupe` (`nom_nature_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `groupe_ibfk_4` FOREIGN KEY (`entite_groupe`) REFERENCES `entite` (`id_entite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `liste_amis`
--
ALTER TABLE `liste_amis`
  ADD CONSTRAINT `liste_amis_ibfk_1` FOREIGN KEY (`id_utilisateur_liste_amis`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `liste_amis_ibfk_2` FOREIGN KEY (`id_ami_liste_amis`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `liste_attente`
--
ALTER TABLE `liste_attente`
  ADD CONSTRAINT `liste_attente_ibfk_1` FOREIGN KEY (`id_demandeur_liste_attente`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `liste_attente_ibfk_2` FOREIGN KEY (`id_recepteur_liste_attente`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `liste_groupe`
--
ALTER TABLE `liste_groupe`
  ADD CONSTRAINT `liste_groupe_ibfk_1` FOREIGN KEY (`id_groupe_liste_groupe`) REFERENCES `groupe` (`id_groupe`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `liste_groupe_ibfk_2` FOREIGN KEY (`id_utilisateur_liste_groupe`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `liste_page`
--
ALTER TABLE `liste_page`
  ADD CONSTRAINT `liste_page_ibfk_1` FOREIGN KEY (`id_page_liste_page`) REFERENCES `page` (`id_page`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `liste_page_ibfk_2` FOREIGN KEY (`id_utilisateur_liste_page`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`expediteur_message`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`recepteur_message`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`acteur_notification`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`type_notification`) REFERENCES `type_notification` (`nom_type`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `page_ibfk_1` FOREIGN KEY (`admin_page`) REFERENCES `utilisateur` (`email_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `page_ibfk_2` FOREIGN KEY (`entite_page`) REFERENCES `entite` (`id_entite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`admin_publication`) REFERENCES `entite` (`id_entite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`entite_utilisateur`) REFERENCES `entite` (`id_entite`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`sexe`) REFERENCES `sexe` (`nom_sexe`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
