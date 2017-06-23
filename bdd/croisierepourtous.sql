-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 02 Juin 2017 à 16:27
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `croisierepourtous`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `idCroisiere` int(11) NOT NULL,
  `nomCategorie` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `stockInitial` int(250) NOT NULL,
  `stockRestantParCat` int(11) NOT NULL,
  PRIMARY KEY (`idCategorie`),
  KEY `idCroisiere` (`idCroisiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `idCroisiere`, `nomCategorie`, `stockInitial`, `stockRestantParCat`) VALUES
(1, 1, 'A', 5, 5),
(2, 1, 'B', 5, 5),
(3, 1, 'C', 4, 4),
(4, 2, 'A', 4, 4),
(5, 2, 'B', 8, 8),
(6, 2, 'C', 5, 5),
(7, 2, 'D', 4, 4);

-- --------------------------------------------------------

--
-- Structure de la table `clientpart`
--

CREATE TABLE IF NOT EXISTS `clientpart` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `idDonBanc` int(11) NOT NULL,
  PRIMARY KEY (`idPersonne`),
  KEY `idDonBanc` (`idDonBanc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `clientpro`
--

CREATE TABLE IF NOT EXISTS `clientpro` (
  `idClientPro` int(11) NOT NULL AUTO_INCREMENT,
  `raisonSociale` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `siret` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `adresse1` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idDonBanc` int(11) NOT NULL,
  PRIMARY KEY (`idClientPro`),
  KEY `idDonBanc` (`idDonBanc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `idClientPart` int(11) NOT NULL,
  `idClientPro` int(11) NOT NULL,
  `paiementOK` tinyint(1) NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `idClientPart` (`idClientPart`),
  KEY `idClientPro` (`idClientPro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `conjoint`
--

CREATE TABLE IF NOT EXISTS `conjoint` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `conjointDeQui` int(11) NOT NULL,
  PRIMARY KEY (`idPersonne`),
  KEY `conjointDeQui` (`conjointDeQui`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `croisiere`
--

CREATE TABLE IF NOT EXISTS `croisiere` (
  `idCroisiere` int(11) NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `nbCategorie` int(11) NOT NULL,
  `nomCroisiere` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idCroisiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `croisiere`
--

INSERT INTO `croisiere` (`idCroisiere`, `dateDebut`, `dateFin`, `nbCategorie`, `nomCroisiere`) VALUES
(1, '2017-05-02', '2017-05-25', 3, 'Asie du Sud-Est'),
(2, '2018-02-01', '2018-02-16', 4, 'Canal de Panama');

-- --------------------------------------------------------

--
-- Structure de la table `description`
--

CREATE TABLE IF NOT EXISTS `description` (
  `idDescription` int(11) NOT NULL AUTO_INCREMENT,
  `idCroisiere` int(11) NOT NULL,
  `termesAssocies` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `resume` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idDescription`),
  KEY `idCroisiere` (`idCroisiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Contenu de la table `description`
--

INSERT INTO `description` (`idDescription`, `idCroisiere`, `termesAssocies`, `resume`) VALUES
(4, 1, 'Asie, SudEst, Hong Kong, Vietnam', 'Venez decouvrir avec nous les merveilles d''Hong Kong, du Vietnam, de la ThaÃ¯lande et de Singapour Ã  bord du Celebrity Millennium.\r\nIncluant le forfait boisson classique, les vols aller-retour, 1 nuit Ã  Hong Kong, 2 nuits Ã  Hong Kong.'),
(5, 2, 'Panama, Canal, San Diego, Mexique, Guatemala', 'En croisiere sur le Canal de Panama vous pourrez voir le soleil se lever au-dessus d''un ocÃ©an, puis plonger dans l''autre. Accompagnez-nous dans notre prochaine aventure, imaginez-vous en train de naviguer.');

-- --------------------------------------------------------

--
-- Structure de la table `donneesbancaire`
--

CREATE TABLE IF NOT EXISTS `donneesbancaire` (
  `idDonBanc` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonne` int(11) NOT NULL,
  `idClientPro` int(11) NOT NULL,
  PRIMARY KEY (`idDonBanc`),
  KEY `idPersonne` (`idPersonne`),
  KEY `idClientPro` (`idClientPro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `idImage` int(11) NOT NULL AUTO_INCREMENT,
  `idDescription` int(11) NOT NULL,
  `type` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `lien` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idImage`),
  KEY `idDescription` (`idDescription`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`idImage`, `idDescription`, `type`, `lien`) VALUES
(1, 4, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Asie du Sud Est/pdfEnJpg/1.jpg'),
(2, 4, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Asie du Sud Est/pdfEnJpg/2.jpg'),
(3, 4, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Asie du Sud Est/pdfEnJpg/3.jpg'),
(4, 4, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Asie du Sud Est/pdfEnJpg/4.jpg'),
(5, 4, 'logo', './images/donneesSurLesCroisieres/Croisiere Asie du Sud Est/vyletna-lod-more-bazen-lehatka-kominy-176843.jpg'),
(7, 5, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Canal de Panama/pdfToJpg/1.jpg'),
(8, 5, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Canal de Panama/pdfToJpg/2.jpg'),
(9, 5, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Canal de Panama/pdfToJpg/3.jpg'),
(10, 5, 'logo', './images/donneesSurLesCroisieres/Croisiere Canal de Panama/mediterranee-costa-croisieres-51571.jpg'),
(11, 5, 'imgComplet', 'images/donneesSurLesCroisieres/Croisiere Canal de Panama/pdfToJpg/4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `idPanier` int(11) NOT NULL AUTO_INCREMENT,
  `idCommande` int(11) DEFAULT NULL,
  `idPlace` int(11) DEFAULT NULL,
  `idPromotion` int(11) DEFAULT NULL,
  `montantAvantPromo` decimal(8,2) DEFAULT NULL,
  `montantApresPromo` decimal(8,2) DEFAULT NULL,
  `nbPlaces` int(11) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL,
  `idPersonne` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPanier`),
  KEY `idCommande` (`idCommande`),
  KEY `idPlace` (`idPlace`),
  KEY `idPromotion` (`idPromotion`),
  KEY `idCategorie` (`idCategorie`),
  KEY `idPersonne` (`idPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`idPanier`, `idCommande`, `idPlace`, `idPromotion`, `montantAvantPromo`, `montantApresPromo`, `nbPlaces`, `idCategorie`, `idPersonne`) VALUES
(23, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL),
(24, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL),
(25, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL),
(26, NULL, NULL, NULL, NULL, NULL, 3, 1, NULL),
(27, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL),
(28, NULL, NULL, NULL, NULL, NULL, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `partenaire`
--

CREATE TABLE IF NOT EXISTS `partenaire` (
  `idPartenariat` int(11) NOT NULL AUTO_INCREMENT,
  `idPartenaire` int(11) NOT NULL,
  `idCroisiere` int(11) NOT NULL,
  `nomPartenaire` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPartenariat`),
  KEY `idCroisiere` (`idCroisiere`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Contenu de la table `partenaire`
--

INSERT INTO `partenaire` (`idPartenariat`, `idPartenaire`, `idCroisiere`, `nomPartenaire`) VALUES
(19, 1, 1, 'Partenaire Go Voyages'),
(20, 2, 2, 'Partenaire Opodo');

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE IF NOT EXISTS `participant` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idPersonne`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `adminOuPas` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nom` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresseEmail` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `adresse1` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse2` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse3` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse4` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codePostal` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pays` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNumber` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroPasseport` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroCarteId` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`idPersonne`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100001 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`idPersonne`, `adminOuPas`, `nom`, `prenom`, `adresseEmail`, `dateNaissance`, `adresse1`, `adresse2`, `adresse3`, `adresse4`, `codePostal`, `ville`, `pays`, `phoneNumber`, `numeroPasseport`, `numeroCarteId`, `password`, `join_date`, `last_login`) VALUES
(1, 'admin,editor', 'ardehali', 'sina', '123', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$buIYKXhNA8QmelpfXPONXO7ClS9o8shFJ26TIjRm5hJ0wzUgpq84O', '2017-06-02 13:25:01', '0000-00-00 00:00:00'),
(100000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-02 14:11:06', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `piecesjustificatifs`
--

CREATE TABLE IF NOT EXISTS `piecesjustificatifs` (
  `idPiecesJustificatifs` int(11) NOT NULL AUTO_INCREMENT,
  `idPromotion` int(11) NOT NULL,
  `listePiecesAfournir` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPiecesJustificatifs`),
  KEY `idPromotion` (`idPromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `piecesjustificatifs`
--

INSERT INTO `piecesjustificatifs` (`idPiecesJustificatifs`, `idPromotion`, `listePiecesAfournir`) VALUES
(1, 1, 'carte d''identité.'),
(2, 2, 'carte d''identité des deux conjoints, justificatifs de mariage.'),
(3, 3, 'carte d''identité des parents'),
(4, 4, 'carte d''identité des parents'),
(5, 5, 'piece d''identite de tous les membres du groupe'),
(6, 6, 'justificatif de mariage'),
(7, 7, 'carte d''identite');

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `idPlace` int(11) NOT NULL AUTO_INCREMENT,
  `idCategorie` int(11) NOT NULL,
  `numeroPlace` int(11) NOT NULL,
  `prixUnitaire` int(11) NOT NULL,
  PRIMARY KEY (`idPlace`),
  KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `place`
--

INSERT INTO `place` (`idPlace`, `idCategorie`, `numeroPlace`, `prixUnitaire`) VALUES
(1, 1, 1, 800),
(2, 1, 2, 800),
(3, 1, 3, 800),
(4, 1, 4, 800),
(5, 1, 5, 800),
(6, 2, 6, 750),
(7, 2, 7, 750),
(8, 2, 8, 750),
(9, 2, 9, 750),
(10, 2, 10, 750);

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE IF NOT EXISTS `promotion` (
  `idPromotion` int(11) NOT NULL AUTO_INCREMENT,
  `pourcentagePromo` decimal(5,4) NOT NULL,
  `descriptionPromo` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `nomPromotion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPromotion`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Contenu de la table `promotion`
--

INSERT INTO `promotion` (`idPromotion`, `pourcentagePromo`, `descriptionPromo`, `nomPromotion`) VALUES
(1, '0.1500', 'les personnes acceptant de partager leurs cabines beneficieront d''une prime de 15%', 'PromoPersonnesPartageantCabine'),
(2, '0.1500', 'promotion dont beneficient les personnes en couple', 'PromoCouple'),
(3, '0.1500', 'Promotion famille nombreuse dont beneficient les Parents', 'PromoFamilleNombreuseParent'),
(4, '0.2500', 'Promotion Famille Nombreuse dont beneficient les enfants de moins de 16 ans.', 'PromoFamilleNombreuseEnfant'),
(5, '0.2500', 'Promotion Groupe de 20 personnes', 'PromoGroupe20personnes'),
(6, '0.1500', 'Promotion Groupe de 20 personnes', 'PromotionVoyageNoce'),
(7, '0.1500', 'Les Personnes ont egalement droit à une bouteille de champagne et un diner à la table du capitaine.', 'PromotionSenior');

-- --------------------------------------------------------

--
-- Structure de la table `representant`
--

CREATE TABLE IF NOT EXISTS `representant` (
  `idPersonne` int(11) NOT NULL AUTO_INCREMENT,
  `idClientPro` int(11) NOT NULL,
  PRIMARY KEY (`idPersonne`),
  KEY `idClientPro` (`idClientPro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `categorie_ibfk_1` FOREIGN KEY (`idCroisiere`) REFERENCES `croisiere` (`idCroisiere`);

--
-- Contraintes pour la table `clientpart`
--
ALTER TABLE `clientpart`
  ADD CONSTRAINT `clientpart_ibfk_1` FOREIGN KEY (`idDonBanc`) REFERENCES `donneesbancaire` (`idDonBanc`),
  ADD CONSTRAINT `clientpart_ibfk_2` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

--
-- Contraintes pour la table `clientpro`
--
ALTER TABLE `clientpro`
  ADD CONSTRAINT `clientpro_ibfk_1` FOREIGN KEY (`idDonBanc`) REFERENCES `donneesbancaire` (`idDonBanc`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idClientPart`) REFERENCES `clientpart` (`idPersonne`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`idClientPro`) REFERENCES `representant` (`idPersonne`);

--
-- Contraintes pour la table `conjoint`
--
ALTER TABLE `conjoint`
  ADD CONSTRAINT `conjoint_ibfk_1` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`),
  ADD CONSTRAINT `conjoint_ibfk_2` FOREIGN KEY (`conjointDeQui`) REFERENCES `clientpart` (`idPersonne`);

--
-- Contraintes pour la table `description`
--
ALTER TABLE `description`
  ADD CONSTRAINT `description_ibfk_1` FOREIGN KEY (`idCroisiere`) REFERENCES `croisiere` (`idCroisiere`);

--
-- Contraintes pour la table `donneesbancaire`
--
ALTER TABLE `donneesbancaire`
  ADD CONSTRAINT `donneesbancaire_ibfk_1` FOREIGN KEY (`idPersonne`) REFERENCES `representant` (`idPersonne`),
  ADD CONSTRAINT `donneesbancaire_ibfk_2` FOREIGN KEY (`idClientPro`) REFERENCES `clientpro` (`idClientPro`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`idDescription`) REFERENCES `description` (`idDescription`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_panier_personne` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`),
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `panier_ibfk_2` FOREIGN KEY (`idPlace`) REFERENCES `place` (`idPlace`),
  ADD CONSTRAINT `panier_ibfk_3` FOREIGN KEY (`idPromotion`) REFERENCES `promotion` (`idPromotion`);

--
-- Contraintes pour la table `partenaire`
--
ALTER TABLE `partenaire`
  ADD CONSTRAINT `partenaire_ibfk_1` FOREIGN KEY (`idCroisiere`) REFERENCES `croisiere` (`idCroisiere`);

--
-- Contraintes pour la table `participant`
--
ALTER TABLE `participant`
  ADD CONSTRAINT `participant_ibfk_1` FOREIGN KEY (`idPersonne`) REFERENCES `personne` (`idPersonne`);

--
-- Contraintes pour la table `piecesjustificatifs`
--
ALTER TABLE `piecesjustificatifs`
  ADD CONSTRAINT `piecesjustificatifs_ibfk_1` FOREIGN KEY (`idPromotion`) REFERENCES `promotion` (`idPromotion`);

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `place_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);

--
-- Contraintes pour la table `representant`
--
ALTER TABLE `representant`
  ADD CONSTRAINT `representant_ibfk_1` FOREIGN KEY (`idClientPro`) REFERENCES `clientpro` (`idClientPro`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
