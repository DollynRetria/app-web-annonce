-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 21 Juillet 2014 à 06:04
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `immobilierbis`
--
CREATE DATABASE IF NOT EXISTS `immobilierbis` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `immobilierbis`;

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE IF NOT EXISTS `annonce` (
  `annonce_id` int(40) NOT NULL AUTO_INCREMENT,
  `annonce_titre` varchar(255) NOT NULL,
  `annonce_description` text NOT NULL,
  `annonce_date` date NOT NULL,
  `user_id` int(40) NOT NULL,
  `type_annonce_id` int(40) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `a_la_une` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'type boléen 1 = à la une, 0 = non à la une',
  PRIMARY KEY (`annonce_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Contenu de la table `annonce`
--

INSERT INTO `annonce` (`annonce_id`, `annonce_titre`, `annonce_description`, `annonce_date`, `user_id`, `type_annonce_id`, `categorie_id`, `a_la_une`) VALUES
(19, 'maison à louer', '<p>test test</p>', '2014-06-29', 5, 1, 1, 0),
(20, 'maison à louer', '<p>test</p>', '2014-06-29', 5, 3, 1, 0),
(21, 'Exemple via front', '<p>Exemple via front test</p>', '2014-06-29', 28, 3, 5, 0),
(23, 'Maison sis à Behoririka', '<p>Maisons dans un quartier tranquille et s&eacute;curis&eacute; de Hellville.Gardien de jour et de nuit.Avec acc&egrave;s &agrave; la piscine.</p>', '2014-06-30', 29, 2, 2, 0),
(24, 'Maison à louer', '<p>Grand immeuble &agrave; 3 &eacute;tages compos&eacute; d''un living et de 5 chambres&nbsp; &agrave; Antehiroka.</p>\r\n<p>&nbsp;</p>', '2014-07-01', 29, 2, 2, 0),
(25, 'Très belle Villa en bord de mer à Nosy Be Madagascar', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">A Nosy Be, Particulier loue villa en premi&egrave;re ligne meubl&eacute; dans un endroit paradisiaque avec une vue exceptionnelle au milieu d''une baie.</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Le r&ecirc;ve &agrave; petit prix le luxe a port&eacute;e de mains dans une r&eacute;sidence qui offre l''authenticit&eacute;, le confort, le charme et la simplicit&eacute;.</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">&nbsp;</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Une vraie source de d&eacute;paysement et un gage de repos et de bien &ecirc;tre.</p>', '2014-07-01', 29, 2, 2, 0),
(26, 'VILLA A ETAGE A LOUER A AMBOHIBAO ', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Une belle villa &agrave; &eacute;tage sise au bord de route, 1er plan, dispose d&rsquo;une grande cour munie d&rsquo;un jardin, accessible et bien cl&ocirc;tur&eacute;e incluant :</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">*A L&rsquo;EXTERIEUR : -Une maison de gardien - Une garage pour une voiture</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">*AU RDC : -Un grand s&eacute;jour en L de 42m&sup2; munie d&rsquo;une chemin&eacute;e -Une chambre de 20m&sup2; -Une cuisine -Une salle d&rsquo;eau munie d&rsquo;un receveur -Une toilette *</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">A L&rsquo;ETAGE : -Trois chambres dont 16m&sup2; chacune</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 2 000 000</p>', '2014-07-01', 29, 2, 2, 0),
(27, 'MAISON A LOUER A ANTSAHAMANITRA ', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Une maison &agrave; &eacute;tage situ&eacute;e au bord de route,accessible,dispose d&rsquo;une vue sur palais des sports,munie d&rsquo;un garage,incluant :*AU RDC :-Un s&eacute;jour de 12m&sup2;-Une cuisine-Une salle d&rsquo;eau et&nbsp; une toilette*AU 1er ETAGE :-Un s&eacute;jour de 24m&sup2;-Une salle d&rsquo;eau et une toilette*AU 2&egrave; ETAGE :-Un s&eacute;jour de 5mx4,5m ,carrel&eacute;-Une chambre de 4m&sup2;,placard&eacute;e-Une salle d&rsquo;eau munie d&rsquo;une cabine de douche*AU 3&egrave; ETAGE :</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 2 000 000</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">OCEANA IMMO - agence immobili&egrave;re:_droit premi&egrave;re visite: 10 000Ar, les suivantes seront gratuites_honoraire d&rsquo;agence : 80% du loyer mensuel, payable au comptant &agrave; la signature du bailSite: www.oceanaimmo.mg / Fb: facebook.com/oceana.immoEmail: location@oceanaimmo.mg,&nbsp;&nbsp; Skype: oceanaimmoPhone: +261 20 22 665 24 +261 33 12 11 669 +261 32 64 14 666Immeuble City center- Porte 207 (2e etage), Tananarive 101 Analakely</p>', '2014-07-01', 29, 2, 2, 0),
(28, 'MAISON A LOUER A ANDOHARANOFOTSY ', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Maison &agrave; &eacute;tage ,&nbsp; &agrave; usage mixte, situ&eacute;e au bord de route , accessible , ayant une vue imprenable , dans un quartier r&eacute;sidentiel , comprenant :RDC : Un s&eacute;jour de 7,5 m x 4,5mUne chambre de 4,5mx3,5mUne cuisineUne salle d&rsquo;eau et toilette1e &eacute;tage : Un s&eacute;jour de 7,5 m x 4,5mUne chambre de 4,5mx3,5mUne cuisine2e &eacute;tage : Un s&eacute;jour de 7,5 m x 4,5mUne chambre de 4,5mx3,5mUne cuisineUne salle d&rsquo;eau et toilette</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 2 000 000</p>', '2014-07-01', 29, 2, 2, 0),
(29, 'BELLE VILLA A LOUER A AMBOHIMIANDRA ', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Dans un quartier calme, une belle ville a &eacute;tage sise au bord de route, avec vue sur le Rova,accessible et bien cl&ocirc;tur&eacute;e, comprenant:*Au rez-de-chauss&eacute;e :-Un grand s&eacute;jour de 50m&sup2;-Deux chambres placard&eacute;es de 20m&sup2; chacune-Un bureau en L de (20m&sup2;+6m&sup2;)-Une buanderie-Une salle de bain avec eau chaude et une toilette*A l&rsquo;&eacute;tage :-Deux grandes chambres de 20m&sup2; chacune dont l&rsquo;une ouvrent sur un balcon-Une chambre en L de (16m&sup2; + 12m&sup2;) donnant sur un balcon- Une comble-Une salle d&rsquo;eau avec eau chaude et une toilette</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 1 900 000</p>', '2014-07-01', 29, 2, 2, 0),
(30, 'VILLA A LOUER A SOAVIMASOANDRO', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Bella villa &agrave; &eacute;tage, au 2&egrave;me plan, accessible, bien cl&ocirc;tur&eacute;,&nbsp; contenant : Au RDC :-Un s&eacute;jour de 9mx5m avec chemin&eacute;- Deux chambres de (4mx4m) et (3mx3m)-Cuisine-Salle d&rsquo;eau munie d&rsquo;une baignoire-ToiletteA l&rsquo;&eacute;tage :-Deux chambres de (5mx4m) chacune avec une petite v&eacute;randa-Deux chambres de (6mx4m)et de (3,5mx3m)-Salle d&rsquo;eau munie d&rsquo;un receveur de douche +eau chaude</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (n&eacute;gociable): 1 800 000</p>', '2014-07-01', 29, 2, 2, 0),
(31, 'LOCAL A USAGE COMMERCIAL A LOUER A MANDROSOA AMBOHIJATOVO ', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Dans un quartier anim&eacute;, situant au bord de route passante,&nbsp;&nbsp; un&nbsp; local au rez-de-chauss&eacute;e, id&eacute;al pour boutique ou autre,&nbsp; avec un pas de porte 14 000 000Ar (n&eacute;gociable) se comporte :-Une pi&egrave;ce de 30m&sup2; avec comptoir et baie vitr&eacute;e- Une toilette ext&eacute;rieure-Compteurs eau et &eacute;lectricit&eacute; communs</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 500 000</p>\r\n<p>&nbsp;</p>', '2014-07-01', 29, 1, 5, 0),
(32, 'LOCAL A USAGE MIXTE A LOUER A SOANIERANA', '<p><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Sis au bord de route, un local &agrave; usage mixte au rez-de-chauss&eacute;e dispose d&rsquo;un parking pour 02 voitures, comprenant :-Une pi&egrave;ce de 35m&sup2;-Une cuisine de 3m&sup2;-Une toiletteCompteurs eau et &eacute;lectricit&eacute; communsLoyer en ariary (ferme) : 500 000</span></p>', '2014-07-01', 29, 2, 5, 0),
(33, 'LOCAL A USAGE COMMERCIAL A LOUER A MANDROSOA AMBOHIJATOVO', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Dans un quartier anim&eacute;, situant au bord de route passante,&nbsp;&nbsp; un&nbsp; local au rez-de-chauss&eacute;e, id&eacute;al pour boutique ou autre,&nbsp; avec un pas de porte 14 000 000Ar (n&eacute;gociable) se comporte :-Une pi&egrave;ce de 30m&sup2; avec comptoir et baie vitr&eacute;e- Une toilette ext&eacute;rieure-Compteurs eau et &eacute;lectricit&eacute; communs</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 500 000</p>', '2014-07-01', 29, 2, 5, 0),
(34, 'LOCAL A LOUER A ANTSAHABE ', '<p><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Sis au bord de route, un local au rez-de-chauss&eacute;e &agrave; usage mixte, accessible, comprenant :-Une pi&egrave;ce de 40m&sup2;-Une cuisine de 03m&sup2;-Une toilette de 105m&sup2;Loyer en ariary (ferme) : 800 000 sans pas de porte</span></p>', '2014-07-01', 29, 2, 5, 0),
(35, 'LOCAUX USAGE BUREAU AU CHOIX A LOUER A ANALAKELY ', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">En plein centre ville, des locaux au choix au 1er &eacute;tage, incluant l&rsquo;internet haut d&eacute;bit, les services coursier, m&eacute;nage, s&eacute;curit&eacute; et secr&eacute;tariat, comprenant :*5 box de 25m&sup2; chacune : 1 800 000ar/ box*4box de 30m&sup2; chacune : 2 000 000ar/box*1bow de 32m&sup2; : 2 100 000Trois toilettesCharge eau incluse dans le loyer, compteur &eacute;lectricit&eacute; avec divisionnaire</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 1 800 000</p>', '2014-07-01', 29, 2, 5, 0),
(36, 'VILLA A LOUER A AMPASANIMALO', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Sise au 1er plan, une villa &agrave; &eacute;tage ayant une cour pour 03voitures et dispose d&rsquo;une maison de gardien, accessible et bien cl&ocirc;tur&eacute;e, comprenant :*Au rez-de-chauss&eacute;e :-Un s&eacute;jour de 60m&sup2;-Une cuisine &agrave; l&rsquo;am&eacute;ricaine placard&eacute;e*A l&rsquo;&eacute;tage :-Une chambre parentale avec baie vitr&eacute;e et munie d&rsquo;une salle d&rsquo;eau attenante-Deux chambres de 25m&sup2; et 16m&sup2;-Une salle de bain avec une lave main-Une toilette</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 2 400 000</p>\r\n<p>&nbsp;</p>', '2014-07-03', 29, 2, 2, 0),
(37, 'VILLA A ETAGE A LOUER A AMBOHIBAO', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Une belle villa &agrave; &eacute;tage sise au bord de route, 1er plan, dispose d&rsquo;une grande cour munie d&rsquo;un jardin, accessible et bien cl&ocirc;tur&eacute;e incluant :*A L&rsquo;EXTERIEUR :-Une maison de gardien- Une garage pour une voiture*AU RDC :-Un grand s&eacute;jour en L&nbsp; de 42m&sup2; munie d&rsquo;une chemin&eacute;e-Une chambre de 20m&sup2;-Une cuisine-Une salle d&rsquo;eau munie d&rsquo;un receveur-Une toilette*A L&rsquo;ETAGE :-Trois chambres dont 16m&sup2; chacune</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 2 000 000</p>', '2014-07-03', 29, 2, 2, 0),
(38, 'MAISON A 4 NIVEAUX A LOUER A NANISANA', '<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="margin: 0px; padding: 0px;"><span class="Apple-converted-space">&nbsp;</span></span></h1>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">A environ 10m de la route principale, une maison a usage mixte, comprenant :*Au sous-sol :-Un s&eacute;jour de 27m&sup2;-Deux chambres de 20m&sup2; et de 8m&sup2;-Une cuisine de placard&eacute;e de 12m&sup2;-Une salle d&rsquo;eau et une toilette*Au rez-de-chauss&eacute;e : un garage de 60m&sup2; pouvant contenir 6 voitures*Au 1er &eacute;tage :-Un s&eacute;jour de 40m&sup2; avec une chemin&eacute;e-Une chambre de 12m&sup2;-Une cuisine &agrave; l&rsquo;am&eacute;ricaine de 9m&sup2;*Au 2&egrave;me &eacute;tage :-Un s&eacute;jour de 25m&sup2;</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 2 000 000</p>', '2014-07-03', 29, 2, 2, 0),
(39, 'VILLA A ETAGE A LOUER A MANDROSEZA ', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Une belle villa ,situ&eacute;e au 3e plan, accessible,ayant un jardin,bien clotur&eacute;&nbsp; et dispose d&rsquo;une cour pour 3 voitures ,incluant :*AU RDC :-Un s&eacute;jour de 42m&sup2;-Deux chambres dont 12m&sup2; chacune-Une cuisine-Une salle d&rsquo;eau&nbsp; munie d&rsquo;une cabine et avec eau chaude-Une toilette*A L&rsquo;ETAGE :-Une chambre&nbsp; de 12m&sup2; munie d&rsquo;une chemin&eacute;e-Deux chambres de 15m&sup2; et 20m&sup2;-Deux salles d&rsquo;eau munie d&rsquo;une cabine et avec eau chaude*A L&rsquo;EXTERIEUR : Maison de gardien</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer/mois en ARIARY (ferme): 1 600 000</p>', '2014-07-03', 29, 2, 2, 1),
(40, 'VILLA A LOUER A MORONDAVA AMBOHIBAO', '<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="margin: 0px; padding: 0px;"><span class="Apple-converted-space">&nbsp;</span></span><br /><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">Dans un quartier calme, une villa &agrave; &eacute;tage, accessible et bien cl&ocirc;tur&eacute;e, comprenant :*Au rez-de-chauss&eacute;e :</span></h1>\r\n<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">-Un garage pour 02 voitures&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></h1>\r\n<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;"> -Une d&eacute;pendance gardien*A l&rsquo;&eacute;tage :-Un s&eacute;jour de 25m&sup2;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h1>\r\n<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">-Deux chambres de 10m&sup2; et 08m&sup2;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h1>\r\n<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">-Une cuisine &agrave; l&rsquo;am&eacute;ricaine placard&eacute;e&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h1>\r\n<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">-Une salle d&rsquo;eau avec eau chaude et lave main&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></h1>\r\n<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">-Une toilette avec lave main*A l&rsquo;ext&eacute;rieure :</span></h1>\r\n<h1 style="margin: 0px 0px 10px; padding: 0px; color: #333333; font-size: 1.6em; line-height: 1.6em; font-family: Arial, sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;"><span style="color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 23.515625px; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; display: inline !important; float: none;">-Un bassin, un terrain de basket, une cour pour 04 voituresLoyer en ariary (ferme) : 700 000</span></h1>', '2014-07-03', 29, 3, 5, 1),
(41, 'Belle villa à ambodivoanjo', '<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Belle villa &agrave; &eacute;tage F6 dans un quartier r&eacute;sidentiel &agrave; Ambodivoanjo.</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Loyer : 3 000&nbsp;000ar</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">Interm&eacute;diaire et curieux s&rsquo;abstenir</p>\r\n<p style="margin: 0px 0px 10px; padding: 0px; line-height: 1.4em; color: #444444; font-family: Arial, sans-serif; font-size: 17px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: auto; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff;">0202328881/ contact@koytchaimmopro.mg/</p>\r\n<p>&nbsp;</p>', '2014-07-03', 29, 3, 5, 1),
(42, 'Maison sis à bentongolo', '<p>Description de la maison</p>\r\n<p>contact : ....</p>\r\n<p>email : ....</p>', '2014-07-18', 30, 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `categorie_id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_type` varchar(255) NOT NULL,
  PRIMARY KEY (`categorie_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`categorie_id`, `categorie_type`) VALUES
(1, 'Terrain'),
(2, 'Maison, Villa'),
(3, 'Appartement'),
(4, 'Fond de commerce'),
(5, 'Locaux commerciaux');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(40) NOT NULL AUTO_INCREMENT,
  `image_nom` varchar(255) NOT NULL,
  `annonce_id` int(40) NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`image_id`, `image_nom`, `annonce_id`) VALUES
(44, '3723d41c3d5f1f281d6131662bc492f0.jpg', 16),
(45, 'b9e61196ae967a941441a70dcfb503e5.jpg', 16),
(46, 'dce10cb6ff2c1feb4ed3bda86a76d86f.jpg', 17),
(48, '804c0a13ec4311bad36178de722b8ae6.jpg', 19),
(49, '40520dbaa9b0d9ddb859a2887db9457a.jpg', 20),
(50, '011fdcaae82698d19db9604b0255f39b.jpg', 21),
(52, '5fff1b66c9907f6e5e5b277de88346e5.JPG', 23),
(53, '502463a1ce9c3509b1d133d1cbafa75a.JPG', 24),
(54, 'fdf1c57f217b6fa8668033becbc7d883.JPG', 25),
(55, '1559a8ef918fb2cb0078a849d91d66b4.jpg', 26),
(56, '7249d6d5d10825c97f5b44690db5ebd2.jpg', 27),
(57, 'ab3817bbae1fa3fa0f529d11e11af9f4.jpg', 28),
(58, 'fce8e6e998ec25e15d55c179294d9c2a.jpg', 29),
(59, '00a95f065142120c4d5691226ce055d9.jpg', 30),
(60, 'a8382fa55d63c239d534b32553d10ad2.jpg', 31),
(61, '4c502e6dd2d20899752680a88ed29896.jpg', 32),
(62, '6a504db851e255b8d4ceec3e003133ab.jpg', 33),
(63, '726d46eabb8ec2fd8ca053559feec538.jpg', 34),
(64, '12cff17f4c5f4c3e741aff0f7c3683ab.jpg', 35),
(65, '0d7460be53293076570a1eb633539ed6.jpg', 36),
(66, 'baaf945f1d8359f21e0541aa4223435f.jpg', 37),
(67, '147ef818a2be3c99667fe50a7da1ef45.jpg', 38),
(68, 'bb75807f49d45c34c94368bee86f2940.jpg', 39),
(69, '15c87e43b3ce3f31067819fac1824fe8.jpg', 40),
(70, 'dad9ff2011957b236e346c319ac00aad.jpg', 41),
(71, '39f5b29a01ecfad3be705fcc232e946b.jpg', 42);

-- --------------------------------------------------------

--
-- Structure de la table `type_annonce`
--

CREATE TABLE IF NOT EXISTS `type_annonce` (
  `type_annonce_id` int(40) NOT NULL AUTO_INCREMENT,
  `type_annonce_type` varchar(255) NOT NULL,
  PRIMARY KEY (`type_annonce_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_annonce`
--

INSERT INTO `type_annonce` (`type_annonce_id`, `type_annonce_type`) VALUES
(1, 'A vendre'),
(2, 'A louer'),
(3, 'Cherche');

-- --------------------------------------------------------

--
-- Structure de la table `type_user`
--

CREATE TABLE IF NOT EXISTS `type_user` (
  `type_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_user_libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_user`
--

INSERT INTO `type_user` (`type_user_id`, `type_user_libelle`) VALUES
(1, 'professionnel'),
(2, 'particulier');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(40) NOT NULL AUTO_INCREMENT,
  `type_user_id` int(11) DEFAULT NULL,
  `user_genre` enum('Mr','Mme','Mlle') NOT NULL,
  `user_nom` varchar(255) NOT NULL,
  `user_prenom` varchar(255) NOT NULL,
  `user_date_de_naissance` varchar(255) NOT NULL,
  `user_telephone` varchar(255) NOT NULL,
  `user_pseudo` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_mot_de_passe` varchar(255) NOT NULL,
  `user_photo` varchar(255) NOT NULL,
  `user_date_inscription` varchar(255) NOT NULL,
  `user_active` enum('oui','non') NOT NULL DEFAULT 'non',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `type_user_id`, `user_genre`, `user_nom`, `user_prenom`, `user_date_de_naissance`, `user_telephone`, `user_pseudo`, `user_email`, `user_mot_de_passe`, `user_photo`, `user_date_inscription`, `user_active`) VALUES
(29, 2, 'Mr', 'retria', 'famatanantsoa dollyn', '662688000', '0337121088', 'nirvana', 'rakoto@yahoo.fr', 'taratara', 'e5d88a8267424e9c2527812c43c572d9.jpg', '1405900800', 'non');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
