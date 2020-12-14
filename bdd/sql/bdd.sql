CREATE DATABASE IF NOT EXISTS `turnirix`

USE `turnirix`;

DROP TABLE IF EXISTS `equipe`;
CREATE TABLE `equipe` (
  `nomEq` varchar(50) NOT NULL,
  `niveauEq` tinyint NOT NULL,
  `nomT` varchar(50) NOT NULL,
  `dateT` date NOT NULL,
  `lieuT` varchar(50) NOT NULL,
  PRIMARY KEY (`nomEq`,`nomT`,`dateT`,`lieuT`)
  /*
  Avec PRIMARY KEY (`nomEq`,`dateT`,`lieuT`), on ne peut pas utiliser le même nom d'équipe pour cette date et ce lieu
  Avec PRIMARY KEY (`nomT`,`nomEq`,`dateT`,`lieuT`), le nom de cette équipe peut être utiliser pour un autre tournoi.
  Celà entraine l'ajout de nomT dans JOUEUR
  */
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE `evenement` (
  `dateEv` date NOT NULL,
  `lieuEv` varchar(50) NOT NULL,
  `nomEv` varchar(50) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `nbTournois` tinyint NOT NULL,
  `statutEv` tinyint NOT NULL DEFAULT '0',
  `idO` bigint NOT NULL,
  PRIMARY KEY (`dateEv`,`lieuEv`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE `joueur` (
  `nomJ` varchar(50) NOT NULL,
  `niveauJ` tinyint NOT NULL,
  `nomEq` varchar(50) NOT NULL,
  `nomT` varchar(50) NOT NULL,
  `dateT` date NOT NULL,
  `lieuT` varchar(50) NOT NULL,
  PRIMARY KEY (`nomJ`,`nomEq`,`nomT`,`dateT`,`lieuT`)
  /*
  Avec PRIMARY KEY (`nomJ`,`nomEq`,`dateT`,`lieuT`), le nom deu joueur ne peut pas être utilisé pour une autre équipe du même tournois
  Avec PRIMARY KEY (`nomJ`,`nomEq`,`nomT`,`dateT`,`lieuT`) on a donc la véritable clé.
  */
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
  `tour` tinyint NOT NULL,
  `nombreEq` tinyint NOT NULL,
  PRIMARY KEY (`idP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `repartir`;
CREATE TABLE `repartir` (
  `nomEq` varchar(50) NOT NULL,
  `nomT` varchar(50) NOT NULL,
  `dateT` date NOT NULL,
  `lieuT` varchar(50) NOT NULL,
  `idP` bigint NOT NULL,
  `rang`tinyint NOT NULL,
  PRIMARY KEY (`nomEq`,`nomT`,`dateT`,`lieuT`,`idP`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `tournois`;
CREATE TABLE `tournois` (
  `nomT` varchar(50) NOT NULL,
  `typeJeu` tinyint NOT NULL,
  `frais` decimal(10,0) NOT NULL,
  `dateT` date NOT NULL,
  `lieuT` varchar(50) NOT NULL,
  PRIMARY KEY (`nomT`,`dateT`,`lieuT`)
  /*Avec PRIMARY KEY (`dateT`,`lieuT`), on ne peut pas créer un autre tournois à la même date et au mêeme lieu
    Avec PRIMARY KEY (`nomT`,`dateT`,`lieuT`) on a la véritable clé
    Celà entraine l'ajout de nomT dans EQUIPE*/
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;