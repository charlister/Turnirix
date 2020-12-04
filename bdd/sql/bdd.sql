CREATE DATABASE IF NOT EXISTS `turnirix`

USE `turnirix`;

/*J'ai essayé de mettre en majuscule la 
première lettre des relations, mais ça 
revient toujours en miniscule.*/
DROP TABLE IF EXISTS `equipe`;
CREATE TABLE `equipe` (
  `nomEq` varchar(50) NOT NULL,
  `nomT` varchar(50) NOT NULL,
  PRIMARY KEY (`nomEq`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE `evenement` (
  `dateEv` date NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `nomEv` varchar(50) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `idO` bigint NOT NULL,
  PRIMARY KEY (`dateEv`,`lieu`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE `joueur` (
  `idJ` bigint NOT NULL,
  `nomJ` varchar(50) NOT NULL,
  `niveau` tinyint NOT NULL,
  `nomEq` varchar(50) NOT NULL,
  PRIMARY KEY (`idJ`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `organisateur`;
CREATE TABLE `organisateur` (
  `idO` bigint NOT NULL AUTO_INCREMENT,
  `nomO` varchar(50) NOT NULL,
  `prenomO` varchar(50) NOT NULL,
  `courriel` varchar(100) NOT NULL,
  `mdp` text NOT NULL,
  `anniv` date NOT NULL,
  `sexe` char(1) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` tinyint NOT NULL DEFAULT '0',
  `cleVerif` varchar(45) NOT NULL,
  PRIMARY KEY (`idO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `poule`;
CREATE TABLE `poule` (
  `idP` bigint NOT NULL,
  PRIMARY KEY (`idP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `repartir`;
CREATE TABLE `repartir` (
  `nomEq` varchar(50) NOT NULL,
  `idP` bigint NOT NULL,
  `tour` tinyint NOT NULL,
  PRIMARY KEY (`nomEq`,`idP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `tournois`;
CREATE TABLE `tournois` (
  `nomT` varchar(50) NOT NULL,
  `typeJeu` tinyint NOT NULL,
  `dateEv` date NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `frais` decimal(10,0) NOT NULL,
  PRIMARY KEY (`nomT`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;