-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 31 Mai 2016 à 02:10
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `jcue`
--

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

CREATE TABLE IF NOT EXISTS `cv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `langueParlee` varchar(25) NOT NULL,
  `langueEcrite` varchar(25) NOT NULL,
  `centreInterets` varchar(100) NOT NULL,
  `competences` varchar(100) NOT NULL,
  `urlVideo` varchar(100) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_cv_id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `experiencepro`
--

CREATE TABLE IF NOT EXISTS `experiencepro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lieu` varchar(50) NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `duree` varchar(50) NOT NULL,
  `posteOccupe` varchar(100) NOT NULL,
  `descriptionMission` longtext NOT NULL,
  `id_cv` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_experiencePro_id_cv` (`id_cv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(100) NOT NULL,
  `anneeDebut` year(4) NOT NULL,
  `anneeFin` year(4) NOT NULL,
  `nomEtablissement` varchar(100) NOT NULL,
  `villeEtablissement` varchar(50) NOT NULL,
  `diplomeVise` varchar(100) NOT NULL,
  `diplomeObtenu` tinyint(1) NOT NULL,
  `id_cv` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_formation_id_cv` (`id_cv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` longtext NOT NULL,
  `lu` tinyint(1) DEFAULT NULL,
  `id_expediteur` int(11) NOT NULL,
  `id_destinataire` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_message_id_utilisateur` (`id_expediteur`),
  KEY `FK_message_id_utilisateur_1` (`id_destinataire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE IF NOT EXISTS `offre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `duree` varchar(100) NOT NULL,
  `descriptionMission` longtext NOT NULL,
  `dateDebut` date NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_typeContrat` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_offre_id_utilisateur` (`id_utilisateur`),
  KEY `FK_offre_id_typeContrat` (`id_typeContrat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `postuler`
--

CREATE TABLE IF NOT EXISTS `postuler` (
  `id_offre` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_offre`,`id_utilisateur`),
  KEY `FK_postuler_id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `typecontrat`
--

CREATE TABLE IF NOT EXISTS `typecontrat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `typecontrat`
--

INSERT INTO `typecontrat` (`id`, `libelle`) VALUES
(1, 'CDI'),
(2, 'CDD'),
(3, 'Intérim'),
(4, 'Alternance');

-- --------------------------------------------------------

--
-- Structure de la table `typeutilisateur`
--

CREATE TABLE IF NOT EXISTS `typeutilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `typeutilisateur`
--

INSERT INTO `typeutilisateur` (`id`, `libelle`) VALUES
(1, 'Particulier'),
(2, 'Entreprise'),
(3, 'Personnel');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telephone` char(10) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `raisonSociale` varchar(50) DEFAULT NULL,
  `numeroSIRET` varchar(50) DEFAULT NULL,
  `id_typeutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_utilisateur_id_typeutilisateur` (`id_typeutilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `adresse`, `codePostal`, `ville`, `mail`, `telephone`, `login`, `password`, `raisonSociale`, `numeroSIRET`, `id_typeutilisateur`) VALUES
(7, 'VAY', 'Johann', '24 rue des lilas', '85000', 'La Roche sur Yon', 'test@test.fr', '0251423652', 'johann.vay', '471543673214bcb960a0bddfde8886c783ae64d273dc3a7d1ba0a46b2f3a353b', NULL, NULL, 1),
(8, 'test', 'test', 'zz', '888', 'test', 'test', '1222222', 'test.test', '471543673214bcb960a0bddfde8886c783ae64d273dc3a7d1ba0a46b2f3a353b', NULL, NULL, 3);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `cv`
--
ALTER TABLE `cv`
  ADD CONSTRAINT `FK_cv_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `experiencepro`
--
ALTER TABLE `experiencepro`
  ADD CONSTRAINT `FK_experiencePro_id_cv` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_formation_id_cv` FOREIGN KEY (`id_cv`) REFERENCES `cv` (`id`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FK_message_id_utilisateur_1` FOREIGN KEY (`id_destinataire`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `FK_message_id_utilisateur` FOREIGN KEY (`id_expediteur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `FK_offre_id_typeContrat` FOREIGN KEY (`id_typeContrat`) REFERENCES `typecontrat` (`id`),
  ADD CONSTRAINT `FK_offre_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `postuler`
--
ALTER TABLE `postuler`
  ADD CONSTRAINT `FK_postuler_id_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `FK_postuler_id` FOREIGN KEY (`id_offre`) REFERENCES `offre` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_utilisateur_id_typeutilisateur` FOREIGN KEY (`id_typeutilisateur`) REFERENCES `typeutilisateur` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
