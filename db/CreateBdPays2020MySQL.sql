/*************************************************************************/
/* Blog des articles (BD MySQL) du cours M2203
//
// Création du script de la base de données BLOGART 
//
// @Martine Bornerie    Le 03/03/20 17:17:00
//
// nom script : CreateBdPays2020MySQL.sql
//
*/
/*************************************************************************/
--
-- Base de données: `BLOGART`
--
USE BLOGART20;

DROP TABLE IF EXISTS PAYS;
 
-- --------------------------------------------------------------------
--
-- Structure de la table `PAYS`
--
/*====================================================================*/
/* Table : PAYS                                                	  	  */
/*====================================================================*/
create table PAYS
(
   idPays int(11) not null auto_increment,	-- PK : id du pays
   cdPays char(2) not null,					-- code du pays
   numPays char(4) not null,				-- numéro du pays -> BLOGART202
   frPays varchar(255) not null,			-- nom du pays en français
   enPays varchar(255) default null,		-- nom du pays en anglais
   primary key (idPays)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*====================================================================*/
/* Index : PAYS_FK                                     			  	  */
/*====================================================================*/
create index PAYS_FK on PAYS
(
   idPays
);

-- ---------------------------------------------------------------------- --
-- ---------------------------------------------------------------------- --


