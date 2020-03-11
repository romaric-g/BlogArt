/*************************************************************************/
/* Blog des articles (BD MySQL) du cours M2203
//
// Création du script de la base de données BLOGART 
//
// @Martine Bornerie    Le 03/03/20 17:17:00
//
// nom script : CreateDbBlogArt2020MySQL_OK.sql
//
*/
/*************************************************************************/
/*
** Format d'un article (détail tuple) :

	ILLUSTRATION / PHOTO ⇒ URL

	TITRE :			100 caractères

	CHAPEAU :		500 caractères

	PARAGRAPHE 1 :	ACCROCHE : 100 caractères
					   DÉTAIL : 1200 caractères

	SOUS-TITRE 1 :	100 caractères
	PARAGRAPHE 2 :	1200 caractères

	SOUS-TITRE 2 :	100 caractères
	PARAGRAPHE 3 :	1200 caractères

	CONCLUSION :	800 caractères

	MOTS-CLÉS :		60 caractères
**
*/

-- First we create the database

CREATE DATABASE `BLOGART20`
DEFAULT CHARACTER SET UTF8			-- Tous les formats de caractères
DEFAULT COLLATE utf8_general_ci ;	-- 

-- SHOW VARIABLES;					-- Voir les paramètres de la BD

-- Then we add a user to the database

GRANT ALL PRIVILEGES ON `BLOGART20`.* TO 'blogArt20_user'@'%' IDENTIFIED BY 'blogArt20_password';;
GRANT ALL PRIVILEGES ON `BLOGART20`.* TO 'blogArt20_user'@'LOCALHOST' IDENTIFIED BY 'blogArt20_password';;


-- Flush / Init all privileges
FLUSH PRIVILEGES;

-- Now we create the Database

-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 13 mars 2020 à 17:17
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `BLOGART`
--
USE BLOGART20;

-- --------------------------------------------------------------------
--
-- Structure de la table `ANGLE`
--
/*====================================================================*/
/* Table : ANGLE                                                	  */
/*====================================================================*/
create table ANGLE
(
   NumAngl char(8) not null,	-- PK numéro de l'angle
   LibAngl char(60),			   -- nom de l'angle
   NumLang char(8) not null,	-- FK numéro de la langue
   primary key (NumAngl)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : ANGLE_FK                                     			  */
/*====================================================================*/
create index ANGLE_FK on ANGLE
(
   NumAngl
);

-- --------------------------------------------------------------------
--
-- Structure de la table `THEMATIQUE`
--
/*====================================================================*/
/* Table : THEMATIQUE                                           	  */
/*====================================================================*/
create table THEMATIQUE
(
   NumThem char(8) not null,	-- PK numéro de la thématique
   LibThem char(60),			   -- nom de la thèmatique
   NumLang char(8) not null,	-- FK numéro de la langue
   primary key (NumThem)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : THEMATIQUE_FK                                     		  */
/*====================================================================*/
create index THEMATIQUE_FK on THEMATIQUE
(
   NumThem
);

-- --------------------------------------------------------------------
--
-- Structure de la table `ARTICLE`
--
/*====================================================================*/
/* Table : ARTICLE                                              	  */
/*====================================================================*/
create table ARTICLE
(
   NumArt char(10) not null,	-- PK numéro de l'article
   -- Date de création article :	MM/JJ/AAAA
   DtCreA date,					-- Date de création de l'article
   -- TITRE :			100 caractères
   LibTitrA text(100),			-- Titre de l'article
   -- CHAPEAU :		500 caractères
   LibChapoA text(500),			-- Titre du chapeau
   -- PARAGRAPHE 1 :	ACCROCHE : 100 caractères
   LibAccrochA text(100),			-- Accroche du paragraphe 1
   -- PARAGRAPHE 1 :	DÉTAIL : 1200 caractères
   Parag1A text(1200),			-- Paragraphe 1 du chapeau
   -- SOUS-TITRE 1 :	100 caractères
   LibSsTitr1 text(100),		-- Titre du sous-titre 1
   -- PARAGRAPHE 2 :	1200 caractères
   Parag2A text(1200),			-- Paragraphe 2 du sous-titre 1
   -- SOUS-TITRE 2 :	100 caractères 
   LibSsTitr2 text(100),		-- Titre du sous-titre 2
   -- PARAGRAPHE 3 :	1200 caractères
   Parag3A text(1200),			-- Paragraphe 3 du sous-titre 2
   -- CONCLUSION :	800 caractères
   LibConclA text(800),			-- Conclusion : Paragraphe de la conclusion
   -- ILLUSTRATION / PHOTO ⇒ URL
   UrlPhotA char(62),			-- url de la photo de l'article
   -- Nombre de likes sur l'article
   Likes int(11) default null,	-- likes de l'article
   -- FK : Angle, Thématique, Langue
   NumAngl char(8) not null,	-- FK numéro de l'angle
   NumThem char(8) not null,	-- FK numéro de la thématique
   NumLang char(8) not null,	-- FK numéro de langue
   primary key (NumArt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : ARTICLE_FK                                     			  */
/*====================================================================*/
create index ARTICLE_FK on ARTICLE
(
   NumArt
);

-- --------------------------------------------------------------------
--
-- Structure de la table `COMMENT`
--
/*====================================================================*/
/* Table : COMMENT                                              	  */
/*====================================================================*/
create table COMMENT
(
   NumCom char(6) not null,         -- PK numéro du commentaire
   DtCreC datetime,                 -- Date jour à la création du commentaire
   PseudoAuteur char(20) not null,  -- meme anonyme : pseudo obligatoire
   EmailAuteur char(60) not null,   -- Mail de l'auteur du commentaire 
   TitrCom char(60) not null,       -- Au moins un caractère :-)
   LibCom text(600) not null,       -- Au moins un caractère :-)
   NumArt char(10) not null,        -- FK numéro de l'article
   primary key (NumCom)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : COMMENT_FK                                     			  */
/*====================================================================*/
create index COMMENT_FK on COMMENT
(
   NumCom
);

-- --------------------------------------------------------------------
--
-- Structure de la table `MOTCLE`
--
/*====================================================================*/
/* Table : MOTCLE                                               	  */
/*====================================================================*/
create table MOTCLE
(
   NumMoCle char(8) not null,	-- PK numéro du mot clé
   LibMoCle char(30),			-- nom du mot clé
   NumLang char(8) not null,	-- FK numéro de la langue
   primary key (NumMoCle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : MOTCLE_FK                                     			  */
/*====================================================================*/
create index MOTCLE_FK on MOTCLE
(
   NumMoCle
);

-- --------------------------------------------------------------------
--
-- Structure de la table `MOTCLEARTICLE`   (Table de jointure)
--
/*====================================================================*/
/* Table : MOTCLEARTICLE                                        	  */
/*====================================================================*/
create table MOTCLEARTICLE
(
   NumArt char(10) not null,	-- PK numéro de l'article (FK)
   NumMoCle char(8) not null,	-- PK numéro du mot clé (FK)
   primary key (NumArt, NumMoCle)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : MOTCLEARTICLE_FK                                      	  */
/*====================================================================*/
create index MOTCLEARTICLE_FK on MOTCLEARTICLE
(
   NumArt
);

/*====================================================================*/
/* Index : MOTCLEARTICLE2_FK                                     	  */
/*====================================================================*/
create index MOTCLEARTICLE2_FK on MOTCLEARTICLE
(
   NumMoCle
);

-- --------------------------------------------------------------------
--
-- Structure de la table `LANGUE`
--
/*====================================================================*/
/* Table : LANGUE                                               	  */
/*====================================================================*/
create table LANGUE
(
   NumLang char(8) not null,	-- PK numéro de la langue
   Lib1Lang char(25),			-- Libellé court de la langue
   Lib2Lang char(45),			-- Libellé long de la langue
   NumPays char(4) null,      -- FK sans CIR du code pays de la langue
   primary key (NumLang)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : LANGUE_FK                                     			  */
/*====================================================================*/
create index LANGUE_FK on LANGUE
(
   NumLang
);

-- --------------------------------------------------------------------
--
-- Structure de la table `USER`
--
/*====================================================================*/
/* Table : USER                                                 	  */
/*====================================================================*/
create table USER
(
   Login char(30) not null,		-- PK login de l'utilisateur
   Pass char(15) not null,		   -- PK password de l'utilisateur 
   LastName char(30) null,		   -- Nom facultatif de l'utilisateur
   FirstName char(30) null,		-- Prénom facultatif de l'utilisateur
   EMail char(50) not null,		-- e-mail de l'utilisateur
   primary key (Login, Pass)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : USER_FK                                     				  */
/*====================================================================*/
create index USER_FK on USER
(
   Login, 
   Pass
);

-- --------------------------------------------------------------------
--
-- Structure de la table `DATE`
--
/*====================================================================*/
/* Table : DATE                                                 	  */
/*====================================================================*/
create table DATE
(
   DtJour DATETIME not null,	-- PK date du jour 
   primary key (DtJour)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : DATE_FK                                     				  */
/*====================================================================*/
create index DATE_FK on DATE
(
   DtJour
);

-- --------------------------------------------------------------------


-- --------------------------------------------------------------------
--
-- CIR : contraintes pour les tables exportées (ON RESTRICT)
--
-- --------------------------------------------------------------------

alter table ARTICLE add constraint FK_ASSOCIATION_1 foreign key (NumAngl)
      references ANGLE (NumAngl) on delete restrict on update restrict;

alter table ARTICLE add constraint FK_ASSOCIATION_2 foreign key (NumThem)
      references THEMATIQUE (NumThem) on delete restrict on update restrict;

alter table ARTICLE add constraint FK_ASSOCIATION_3 foreign key (NumLang)
      references LANGUE (NumLang) on delete restrict on update restrict;

alter table THEMATIQUE add constraint FK_ASSOCIATION_4 foreign key (NumLang)
      references LANGUE (NumLang) on delete restrict on update restrict;

alter table MOTCLE add constraint FK_ASSOCIATION_5 foreign key (NumLang)
      references LANGUE (NumLang) on delete restrict on update restrict;

alter table ANGLE add constraint FK_ASSOCIATION_6 foreign key (NumLang)
      references LANGUE (NumLang) on delete restrict on update restrict;

-- --------------------------------------------------------------------

alter table COMMENT add constraint FK_ASSOCIATION_7 foreign key (NumArt)
      references ARTICLE (NumArt) on delete restrict on update restrict;

-- --------------------------------------------------------------------

alter table MOTCLEARTICLE add constraint FK_MotCleArt1 foreign key (NumMoCle)
      references MOTCLE (NumMoCle) on delete restrict on update restrict;

alter table MOTCLEARTICLE add constraint FK_MotCleArt2 foreign key (NumArt)
      references ARTICLE (NumArt) on delete restrict on update restrict;

-- --------------------------------------------------------------------
-- --------------------------------------------------------------------


