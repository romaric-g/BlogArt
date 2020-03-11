/*************************************************************************/
/* Blog des articles (BD MySQL) du cours M2203
//
// Jeu d'essai SQL du cours M2203
//
// @Martine Bornerie		Le 03/03/20 22:07:00
//
// nom script : JeuEssaiBlogArt2020MySQL_OK.sql
//
*/
/*************************************************************************/
/* 
--	Gestion des articles de Blog en respectant les contraintes d'intégrité référentielle
--	Base de données MySQL
*/
--
-- Base de données: `BLOGART`
--
USE BLOGART20;

-- --------------------------------------------------------------------
/*
-- Respectant les contraintes d'intégrité référentielle
*/
-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table PAYS
--
-- (<idPays, cdPays, numPays, frPays, enPays,>)
--
-- IMPORTER LE SCRIPT DE CREATION DES PAYS (PEU IMPORTE L'ORDRE)
-- (JeuEssaiPays2020MySQL_OK.sql)
--
*/
-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table DATE
--
-- (<DtJour, datetime,>)
*/
INSERT INTO DATE (DtJour) VALUES ('2018-11-09 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2018-12-01 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2018-12-12 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2018-12-12 09:00:00');
INSERT INTO DATE (DtJour) VALUES ('2018-12-12 11:00:00');
INSERT INTO DATE (DtJour) VALUES ('2018-12-13 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2018-12-17 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2018-12-18 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2019-01-11 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2019-01-13 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2019-01-17 00:00:00');
INSERT INTO DATE (DtJour) VALUES ('2019-02-22 14:30:00');
INSERT INTO DATE (DtJour) VALUES ('2017-12-12 00:00:00');

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table USER
--
-- (<Login, char(30),>, <Pass, char(15),>, <LastName, char(30),>, 
-- <FirstName, char(30),>, <EMail, char(50),>)
*/
INSERT INTO USER (Login, Pass, LastName, FirstName, EMail) VALUES
('Chris45', "Ut!D5?h0", "Dupont", "Jean", "cricri@srf.fr");
INSERT INTO USER (Login, Pass, LastName, FirstName, EMail) VALUES
('PitouF', "G0_f2;A", "Durand", "Joe", "JoeStarr@free.fr");
INSERT INTO USER (Login, Pass, LastName, FirstName, EMail) VALUES
('BarbieS9', "P9#7xL", "La Rousse", "Julie", "titou@gmail.com");
INSERT INTO USER (Login, Pass, LastName, FirstName, EMail) VALUES
('Cruella', "qL:5R!1", "Mercury", "Freddy", "Cruella@free.fr");

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table LANGUE
--
-- (<NumLang, char(8),>, <Lib1Lang, char(25),>, <Lib2Lang, char(45),>)
*/
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("FRAN01",	"Français(e)",   "Langue française", "FRAN");
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("ANGL01", 	"Anglais(e)",   "Langue anglaise", "ANGL");
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("ALLE01",	"Allemand(e)",   "Langue allemande", "ALLE");
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("ESPA01", 	"Espagnol(e)",   "Langue espagnole", "ESPA");
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("ITAL01",	"Italien(ne)",   "Langue italienne", "ITAL");
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("BULG01",	"Bulgare",   "Langue bulgare", "BULG");
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("UKRA01",	"Ukrainien(ne)",   "Langue ukrainienne", "UKRA");
INSERT INTO LANGUE (NumLang, Lib1Lang, Lib2Lang, NumPays)
	VALUES ("RUSS01",	"Russe",   "Langue russe", "RUSS");

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table ANGLE
--
-- (<NumAngl, char(6),>, <LibAngl, char(60),>, <NumLang, char(8),>)
*/
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0101",	"Handicap",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0102",	"Handicap",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0103",	"Handikap",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0201", 	"Grandes figures littéraires",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0202", 	"Great literary figures",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0203", 	"Große literarische Persönlichkeiten",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0301",	"Happy hours",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0302",	"Happy hours",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0303",	"Happy hours",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0401", 	"Histoire médiévale",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0402", 	"Medieval History",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0403", 	"Mittelalterliche Geschichte",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0501",	"Intelligence collective",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0502",	"Collective Intelligence",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0503",	"Gemeinsame Intelligenz",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0601",	"Expérience 3.0",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0602",	"Experience 3.0",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0603",	"Erfahrung 3.0",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0701",	"Chatbot et IA",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0702",	"Chatbot and IA",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0703",	"Chatbot und KI",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0801",	"Stories",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0802",	"Stories",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0803",	"Geschichten",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0901",	"Secret",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0902",	"Secret",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL0903",	"Geheimnis",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1001",	"We heart it",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1002",	"We heart it",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1003",	"Wir lieben es",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1101",	"Yik Yak",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1102",	"Yik Yak",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1103",	"Yik Yak",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1201",	"Shots",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1202",	"Shots",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1203",	"Aufnahmen",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1301",	"Tik Tok",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1302",	"Tik Tok",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1303",	"Tik Tok",  "ALLE01");
--
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1401",	"Recherche vocale",  "FRAN01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1402",	"Voice search",  "ANGL01");
INSERT INTO ANGLE (NumAngl, LibAngl, NumLang)
	VALUES ("ANGL1403",	"Sprachsuche",  "ALLE01");

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table THEMATIQUE
--
-- (<NumThem, char(6),>, <LibThem, char(60),>, <NumLang, char(8),>)
*/
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0101', "L'événement", "FRAN01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0102', "L'acteur-clé", "FRAN01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0103', "Le mouvement émergeant", "FRAN01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0104', "L'insolite / le clin d'oeil", "FRAN01");
--
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0201', "The event", "ANGL01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0202', "The key player", "ANGL01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0203', "The emerging movement", "ANGL01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0204', "The unusual / the wink", "ANGL01");
--
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0301', "Die Veranstaltung", "ALLE01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0302', "Der Schlüsselakteur", "ALLE01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0303', "Die entstehende Bewegung", "ALLE01");
INSERT INTO THEMATIQUE (NumThem, LibThem, NumLang)
VALUES
		('THE0304', "Das Ungewöhnliche / das Augenzwinkern", "ALLE01");


-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table MOTCLE
--
-- (<NumMoCle, char(8),>, <LibMoCle, char(30),>, <NumLang, char(8),>)
*/
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang)
VALUES
	('MTCL0101', "Mot1", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang)
VALUES
	('MTCL0102', "Mot2", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0103', "Mot3", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0104', "Mot4", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0105', "Mot5", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0106', "Mot6", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0107', "Mot7", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0108', "Mot8", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0109', "Mot9", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0110', "Mot10", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0111', "Mot11", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0112', "Mot12", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0113', "Mot13", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0114', "Mot14", "FRAN01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0115', "Mot15", "FRAN01");
--
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0201', "Word1", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0202', "Word2", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0203', "Word3", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0204', "Word4", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0205', "Word5", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0206', "Word6", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0207', "Word7", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0208', "Word8", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0209', "Word9", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0210', "Word10", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0211', "Word11", "ANGL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0212', "Word12", "ANGL01");
--
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0301', "Wort1", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0302', "Wort2", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0303', "Wort3", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0304', "Wort4", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0305', "Wort5", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0306', "Wort6", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0307', "Wort7", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0308', "Wort8", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0309', "Wort9", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0310', "Wort10", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0311', "Wort11", "ALLE01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0312', "Wort12", "ALLE01");
--
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0401', "дума 1", "BULG01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0402', "дума 2", "BULG01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0403', "дума 3", "BULG01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0404', "дума 4", "BULG01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0405', "дума 5", "BULG01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0406', "дума 6", "BULG01");
--
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0501', "Palabra 1", "ESPA01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0502', "Palabra 2", "ESPA01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0503', "Palabra 3", "ESPA01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0504', "Palabra 4", "ESPA01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0505', "Palabra 5", "ESPA01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0506', "Palabra 6", "ESPA01");
--
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0601', "Parola 1", "ITAL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0602', "Parola 2", "ITAL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0603', "Parola 3", "ITAL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0604', "Parola 4", "ITAL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0605', "Parola 5", "ITAL01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0606', "Parola 6", "ITAL01");
--
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0701', "Cлово 1", "RUSS01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0702', "Cлово 2", "RUSS01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0703', "Cлово 3", "RUSS01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0704', "Cлово 4", "RUSS01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0705', "Cлово 5", "RUSS01");
INSERT INTO MOTCLE (NumMoCle, LibMoCle, NumLang) 
VALUES
	('MTCL0706', "Cлово 6", "RUSS01");

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table ARTICLE
--
-- (<NumArt, char(10),>, <DtCreA, date,>, <LibTitrA, char(100),>, 
-- <LibChapoA char(500),>, <LibAccrochA text(100),>, <Parag1A, char(1200),>, 
-- <LibSsTitr1, char(100),>, <Parag2A, char(1200),>, <LibSsTitr2, char(100),>, 
-- <Parag3A, char(1200),>, <LibConclA, char(800),>, <UrlPhotA, char(32),>, 
-- <Likes, int(11) default null,>,
-- 3 FK :
-- <NumAngl, char(6) not null,>, <NumThem, char(6) not null,>, <NumLang, char(8) not null,>
-- )
*/
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('09', '2019-02-24 00:00:00', 'Lorem Ipsum : What is Lorem Ipsum?', 
	'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 
	'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..', 
	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 
	'Why do we use it?', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 
	'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 
	'Where can I get some?\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 
	'https://monsiteamoi.com/image.png', 6, 
	'ANGL0301', 'THE0102', 'FRAN01');
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('10', '2019-02-24 00:00:00', 'Lorem Ipsum : What is Lorem Ipsum?', 
	'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 
	'There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...', 
	'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 
	'Where does it come from?', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', 
	'Where can I get some?', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 
	'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 
	'https://monsiteamoi.com/image.png', 5, 
	'ANGL0301', 'THE0102', 'FRAN01');
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('11', '2019-01-09 00:00:00', 'Lorem Ipsum : Qu''est-ce que le Lorem Ipsum?', 
	'Il n''y a personne qui n''aime la souffrance pour elle-même, qui ne la recherche et qui ne la veuille pour elle-même...', 
	'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...', 
	'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l''imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n''a pas fait que survivre cinq siècles, mais s''est aussi adapté à la bureautique informatique, sans que son contenu n''en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.', 
	'Pourquoi l''utiliser?', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L''avantage du Lorem Ipsum sur un texte générique comme ''Du texte. Du texte. Du texte.'' est qu''il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour ''Lorem Ipsum'' vous conduira vers de nombreux sites qui n''en sont encore qu''à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d''y rajouter de petits clins d''oeil, voire des phrases embarassantes).\r\n\r\n', 
	'Où puis-je m''en procurer?', 'Plusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie d''entre elles a été altérée par l''addition d''humour ou de mots aléatoires qui ne ressemblent pas une seconde à du texte standard. Si vous voulez utiliser un passage du Lorem Ipsum, vous devez être sûr qu''il n''y a rien d''embarrassant caché dans le texte. Tous les générateurs de Lorem Ipsum sur Internet tendent à reproduire le même extrait sans fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches d''humour.', 
	'L''extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du "De Finibus Bonorum et Malorum" de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).', 
	'https://monsiteamoi.com/image.png', 0, 
	'ANGL0301', 'THE0104', 'FRAN01');
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('12', '2019-01-09 00:00:00', 'Lorem Ipsum : Qu''est-ce que le Lorem Ipsum?', 
	'Le passage de Lorem Ipsum standard, utilisé depuis 1500', 
	'« Lorem ipsum carottes, amélioré développeur de premier cycle, mais ils occaecat le temps et la vitalité, comme le travail et l''obésité. Au fil des ans viennent, qui exercent nostrud, le travail du district scolaire, à moins qu''ils aliquip d''avantage. ', 
	'Les devoirs si le consommateur cupidatat trouver plaisir veut être un cillum de football, il fuit la douleur, ne produit pas obtenu. excepteur cupidatat noirs ne sont pas excepteur, est apaisante pour l''âme, qui est, ils ont déserté les devoirs généraux de ceux qui sont à blâmer pour vos problèmes ".', 
	'Section du 10/01/32 « Le Extrêmes du Bien et du Mal » de CicSron (45 av.)', 
	'« Mais je dois vous expliquer comment tout cela fausse idée de dénoncer le plaisir et louant la douleur, le tout exposer les enseignements réels de la grande vérité et le maître-bâtisseur de bonheur humain suffisant. Aucun de plaisir lui-même, parce qu''il est la douleur ou évite, mais parce que conséquences de rencontre qui sont les douleurs de ceux qui sont à la recherche du plaisir rationnellement au courant. ni plus, toute personne appartenant à, ceux qui tranquillement ipsum quia dolor sit amet, consectetur, pour obtenir qu''elle veut, mais parce qu''ils ne jamais être attaché aux modes des temps de la chute afin que le travail et la douleur, un grand regard pour le plaisir. Télécharger l''information en tant que vCard E , quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur,ou celui qui évite une douleur qui ne produit aucun plaisir résultant? "', 
	'Section 1.10.33 du "Le Extrêmes du Bien et du Mal" de CicSron (45 av.)', 
	'« Mais la vérité d''entre eux, et ils accusent et il est juste la haine digne de l''ignominie, qui est le flatteries des plaisirs présents accusantium d''entre eux corrompus de ces douleurs, et pour lequel il trouble excepturi ils sont aveuglés par le désir de ne pas se réfugier, et dans le même chapitre en faute qui remplissent un bureau, ils ont déserté la faiblesse générale de l''esprit, qui est, de son travail et douloureux. Et ceux-ci, en effet, des choses simples et faciles aucune différence entre le. pour votre temps libre, et ils nous indépendants à le choix de l''option et lorsqu''ils ne sont pas perturbés par c''était pas, ce qui avant tout faire ce que nous aimons, tout le plaisir est d''être accueilli et toutes les douleurs évitées. Mais dans certaines circonstances, et ou de bons offices ou évite le plaisir des choses, il va souvent se produire ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."', 
	'Traduction de H. Rackham (1914)\r\n"D''un autre côté, nous dénonçons avec une indignation et une aversion justes des hommes qui sont tellement séduits et démoralisés par les charmes du plaisir du moment, si aveuglés par le désir, qu''ils ne peuvent pas prévoir la douleur et les ennuis qui doivent s''ensuivre; et égaux le blâme appartient à ceux qui manquent à leur devoir par faiblesse de volonté, ce qui revient à dire en reculant devant le labeur et la douleur. Ces cas sont parfaitement simples et faciles à distinguer. En une heure libre, lorsque notre pouvoir de choix est libre et quand rien n''empêche que nous puissions faire ce que nous aimons le mieux, chaque plaisir doit être accueilli et chaque douleur évitée. Mais dans certaines circonstances et en raison des droits ou des obligations des entreprises, il arrive fréquemment que les plaisirs soient répudiés et les désagréments acceptés.Le sage tient donc toujours en ces matières à ce principe de sélection: il rejette les plaisirs pour obtenir d''autres plaisirs plus grands, ou bien il endure des douleurs pour éviter des douleurs plus graves. "', 
	'https://monsiteamoi.com/image.png', 10, 
	'ANGL0301', 'THE0104', 'FRAN01');
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('13', '2019-01-09 00:00:00', 'Lorem ipsum 1 : Nulla facilisi morbi tempus iaculis urna id volutpat lacus laoreet.', 
	'Scelerisque eu ultrices vitae auctor eu augue ut. Malesuada pellentesque elit eget gravida. ', 
	'Lorem ipsum 1 : Sed enim ut sem viverra. Pretium viverra suspendisse potenti nullam ac tortor vitae purus. Lorem donec massa sapien faucibus et molestie. ', 
	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed velit dignissim sodales ut. Urna molestie at elementum eu facilisis sed odio morbi. Aliquam purus sit amet luctus. Sem nulla pharetra diam sit amet nisl. Netus et malesuada fames ac. Vel quam elementum pulvinar etiam. Leo a diam sollicitudin tempor id eu nisl. Venenatis tellus in metus vulputate eu scelerisque felis imperdiet. Ornare arcu dui vivamus arcu felis bibendum ut. Lorem ipsum dolor sit amet. Consectetur adipiscing elit ut aliquam purus sit amet luctus venenatis. Etiam tempor orci eu lobortis elementum. Nibh sit amet commodo nulla facilisi. Ante in nibh mauris cursus mattis molestie a.', 'Lorem ipsum : Odio morbi quis commodo odio aenean sed adipiscing diam donec. ', 
	'Lectus mauris ultrices eros in cursus turpis massa tincidunt. Interdum posuere lorem ipsum dolor sit amet consectetur adipiscing elit. Consectetur adipiscing elit duis tristique sollicitudin nibh sit amet. Habitant morbi tristique senectus et. Nisi vitae suscipit tellus mauris a diam. Duis convallis convallis tellus id interdum velit laoreet. Sollicitudin nibh sit amet commodo. Cras pulvinar mattis nunc sed blandit. Eu nisl nunc mi ipsum faucibus vitae aliquet nec. Id porta nibh venenatis cras sed felis eget velit aliquet.', 
	'Lorem ipsum 2 : Tempus quam pellentesque nec nam. Tortor consequat id porta nibh. Sociis natoque penatibus et magnis dis. ', 
	'Dolor sed viverra ipsum nunc. Tincidunt augue interdum velit euismod. Elementum curabitur vitae nunc sed velit dignissim sodales ut eu. Nulla porttitor massa id neque aliquam vestibulum. Risus in hendrerit gravida rutrum quisque. Tortor pretium viverra suspendisse potenti nullam ac tortor vitae. Consectetur purus ut faucibus pulvinar elementum integer enim neque. Habitasse platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper dignissim. Nisl nisi scelerisque eu ultrices vitae auctor eu. Sit amet mauris commodo quis. A diam sollicitudin tempor id eu nisl nunc mi ipsum. Nullam eget felis eget nunc lobortis. Facilisis gravida neque convallis a cras. Ullamcorper a lacus vestibulum sed arcu. At imperdiet dui accumsan sit amet nulla facilisi morbi tempus. Tincidunt vitae semper quis lectus nulla at volutpat.', 
	'Sed turpis tincidunt id aliquet. Non diam phasellus vestibulum lorem sed. Scelerisque eleifend donec pretium vulputate sapien nec sagittis. Quis risus sed vulputate odio. Malesuada bibendum arcu vitae elementum curabitur vitae nunc sed. Nulla facilisi morbi tempus iaculis. Ac ut consequat semper viverra nam. Nisl nunc mi ipsum faucibus. Justo nec ultrices dui sapien eget mi proin sed libero. Donec massa sapien faucibus et molestie. Leo integer malesuada nunc vel risus. Consectetur adipiscing elit duis tristique. At elementum eu facilisis sed odio morbi quis commodo odio.', 
	'https://monsiteamoi.com/image.png', 8, 
	'ANGL0301', 'THE0104', 'FRAN01');
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('14', '2019-01-09 00:00:00', 'Lorem Ipsum: utilisation', 
	'Lorem ipsum : Il n''y a personne qui n''aime la souffrance pour elle-même, qui ne la recherche et qui ne la veuille pour elle-même...', 
	'Il n''est pas plus loin, parce que ce sont les carottes de la douleur, Minneapolis, veut obtenir ... »', 
	'Lorem ipsum est un texte pseudo-latin utilisé dans la conception Web, la typographie, la mise en page et l''impression à la place de l''anglais pour mettre l''accent sur les éléments de conception plutôt que sur le contenu. Il est également appelé texte d''espace réservé (ou de remplissage). C''est un outil pratique pour les maquettes. Il aide à définir les éléments visuels d''un document ou d''une présentation, par exemple la typographie, la police ou la mise en page. ', 
	'Sous-titre 1', 'Lorem ipsum fait principalement partie d''un texte latin de l''auteur et philosophe classique Cicéron. Ses mots et lettres ont été modifiés par ajout ou suppression, afin de rendre délibérément son contenu insensé; ce n''est plus du latin authentique, correct ou compréhensible. Alors que lorem ipsumCela ressemble toujours au latin classique, il n''a en fait aucune signification. Comme le texte de Cicéron ne contient pas les lettres K, W ou Z, étrangères au latin, celles-ci et d''autres sont souvent insérées au hasard pour imiter l''apparence typographique des langues européennes, de même que les digraphes qui ne figurent pas dans l''original.', 
	'Sous-titre 2', 'Dans un contexte professionnel, il arrive souvent que des clients privés ou d''entreprise rédigent une publication à faire et à présenter avec le contenu réel qui n''est toujours pas prêt. Pensez à un blog d''actualités rempli de contenu toutes les heures le jour de sa mise en ligne. Cependant, les examinateurs ont tendance à être distraits par un contenu compréhensible, par exemple, un texte aléatoire copié à partir d''un journal ou d''Internet. ', 
	'Ils sont susceptibles de se concentrer sur le texte, sans tenir compte de la mise en page et de ses éléments. En outre, le texte aléatoire risque d''être involontairement humoristique ou offensant, un risque inacceptable dans les environnements d''entreprise. Le Lorem ipsum et ses nombreuses variantes sont utilisés depuis le début des années 60 et très probablement depuis le XVIe siècle.', 
	'https://monsiteamoi.com/image.png', 20, 
	'ANGL0301', 'THE0101', 'FRAN01');
--
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('15', '2019-03-04 00:00:00', 'Lorem Ipsum: common examples', 
	'Most of its text is made up from sections 1.10.32–3 of Cicero''s De finibus bonorum et malorum (On the Boundaries of Goods and Evils; finibus may also be translated as purposes). ', 
	'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit is the first known version ("Neither is there anyone who loves grief itself since it is grief and thus wants to obtain it"). ', 
	'It was found by Richard McClintock, a philologist, director of publications at Hampden-Sydney College in Virginia; he searched for citings of consectetur in classical Latin literature, a term of remarkably low frequency in that literary corpus.\r\nCicero famously orated against his political opponent Lucius Sergius Catilina. Occasionally the first Oration against Catiline is taken for type specimens: Quo usque tandem abutere, Catilina, patientia nostra? Quam diu etiam furor iste tuus nos eludet? (How long, O Catiline, will you abuse our patience? And for how long will that madness of yours mock us?)', 
	'Cicero''s version of Liber Primus (first Book), sections 1.10.32–3 (fragments included in most Lorem Ipsum variants in red):', 
	'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit amet, consectetur, adipisci[ng] velit, sed quia non numquam [do] eius modi tempora inci[di]dunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?', 
	'Lorem Ipsum: translation\r\nThe Latin scholar H. Rackham translated the above in 1914:', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', 
	'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 
	'https://mywebsite.com/image.png', 3, 
	'ANGL0602', 'THE0203', 'ANGL01');
--
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('16', '2019-02-20 00:00:00', 'Lorem Ipsum: variants and technical information', 
	'In 1985 Aldus Corporation launched its first desktop publishing program Aldus PageMaker for Apple Macintosh computers, released in 1987 for PCs running Windows 1.0.', 
	'Both contained the variant lorem ipsum most common today. Laura Perry, then art director with Aldus, modified prior versions of Lorem Ipsum text from typographical specimens; in the 1960s and 1970s it appeared often in lettering catalogs by Letraset. ', 
	'Anecdotal evidence has it that Letraset used Lorem ipsum already from 1970 onwards, eg. for grids (page layouts) for ad agencies. Many early desktop publishing programs, eg. Adobe PageMaker, used it to create template.', 
	'Lorem Ipsum: when, and when not to use it', 'Do you like Cheese Whiz? Spray tan? Fake eyelashes? That''s what is Lorem Ipsum to many—it rubs them the wrong way, all the way. It''s unreal, uncanny, makes you wonder if something is wrong, it seems to seek your attention for all the wrong reasons. Usually, we prefer the real thing, wine without sulfur based preservatives, real butter, not margarine, and so we''d like our layouts and designs to be filled with real words, with thoughts that count, information that has value.\r\nThe toppings you may chose for that TV dinner pizza slice when you forgot to shop for foods, the paint you may slap on your face to impress the new boss is your business. But what about your daily bread? Design comps, layouts, wireframes—will your clients accept that you go about things the facile way? Authorities in our business will tell in no uncertain terms that Lorem Ipsum is that huge, huge no no to forswear forever. Not so fast, I''d say, there are some redeeming factors in favor of greeking text, as its use is merely the symptom of a worse problem to take into consideration.', 
	'Lorem Ipsum: when, and when not to use it', 'You begin with a text, you sculpt information, you chisel away what''s not needed, you come to the point, make things clear, add value, you''re a content person, you like words. Design is no afterthought, far from it, but it comes in a deserved second. Anyway, you still use Lorem Ipsum and rightly so, as it will always have a place in the web workers toolbox, as things happen, not always the way you like it, not always in the preferred order. Even if your less into design and more into content strategy you may find some redeeming value with, wait for it, dummy copy, no less.\r\n\r\nConsider this: You made all the required mock ups for commissioned layout, got all the approvals, built a tested code base or had them built, you decided on a content management system, got a license for it or adapted open source software for your client''s needs. Then the question arises: where''s the content? Not there yet? That''s not so bad, there''s dummy copy to the rescue. But worse, what if the fish doesn''t fit in the can, the foot''s to big for the boot? Or to small? To short sentences, to many headings, images too large for the proposed design, or too small, or they fit in but it looks iffy for reasons the folks in the meeting can''t quite tell right now, but they''re unhappy, somehow. A client that''s unhappy for a reason is a problem, a client that''s unhappy though he or her can''t quite put a finger on it is worse.', 
	'But. A big but: Lorem Ipsum is not t the root of the problem, it just shows what''s going wrong. Chances are there wasn''t collaboration, communication, and checkpoints, there wasn''t a process agreed upon or specified with the granularity required. It''s content strategy gone awry right from the start. Forswearing the use of Lorem Ipsum wouldn''t have helped, won''t help now. It''s like saying you''re a bad designer, use less bold text, don''t use italics in every other paragraph. True enough, but that''s not all that it takes to get things back on track.', 
	'https://meinsite.com/image.png', 4, 
	'ANGL0703', 'THE0302', 'ALLE01');
--
INSERT INTO ARTICLE (NumArt, DtCreA, LibTitrA, LibChapoA, LibAccrochA, Parag1A,
   LibSsTitr1, Parag2A, LibSsTitr2, Parag3A, LibConclA, UrlPhotA, Likes,
   NumAngl, NumThem, NumLang)
VALUES
	('17', '2020-03-05 00:00:00', 'So Lorem Ipsum is bad (not necessarily)\r\n\r\n', 
	'There''s lot of hate out there for a text that amounts to little more than garbled words in an old language. ', 
	'The villagers are out there with a vengeance to get that Frankenstein, wielding torches and pitchforks, wanting to tar and feather it at the least, running it out of town in shame.', 
	'One of the villagers, Kristina Halvorson from Adaptive Path, holds steadfastly to the notion that design can’t be tested without real content:\r\n\r\nI’ve heard the argument that “lorem ipsum” is effective in wireframing or design because it helps people focus on the actual layout, or color scheme, or whatever. What kills me here is that we’re talking about creating a user experience that will (whether we like it or not) be DRIVEN by words. The entire structure of the page or app flow is FOR THE WORDS.', 
	'If that''s what you think how bout the other way around? How can you evaluate content without design? ', 
	'No typography, no colors, no layout, no styles, all those things that convey the important signals that go beyond the mere textual, hierarchies of information, weight, emphasis, oblique stresses, priorities, all those subtle cues that also have visual and emotional appeal to the reader. Rigid proponents of content strategy may shun the use of dummy copy but then designers might want to ask them to provide style sheets with the copy decks they supply that are in tune with the design direction they require.\r\n\r\nOr else, an alternative route: set checkpoints, networks, processes, junctions between content and layout. Depending on the state of affairs it may be fine to concentrate either on design or content, reversing gears when needed.\r\n\r\nOr maybe not. How about this: build in appropriate intersections and checkpoints between design and content. Accept that it’s sometimes okay to focus just on the content or just on the design.', 
	'Luke Wroblewski, currently a Product Director at Google, holds that fake data can break down in real life.', 
	'Using dummy content or fake information in the Web design process can result in products with unrealistic assumptions and potentially serious design flaws. A seemingly elegant design can quickly begin to bloat with unexpected content or break under the weight of actual activity. Fake data can ensure a nice looking layout but it doesn’t reflect what a living, breathing application must endure. Real data does.\r\nWebsites in professional use templating systems. Commercial publishing platforms and content management systems ensure that you can show different text, different data using the same template. When it''s about controlling hundreds of articles, product pages for web shops, or user profiles in social networks, all of them potentially with different sizes, formats, rules for differing elements things can break, designs agreed upon can have unintended consequences and look much different than expected.\r\n\r\nThis is quite a problem to solve, but just doing without greeking text won''t fix it. Using test items of real content and data in designs will help, but there''s no guarantee that every oddity will be found and corrected. Do you want to be sure? Then a prototype or beta site with real content published from the real CMS is needed—but you’re not going that far until you go through an initial design cycle.', 
	'Lorem Ipsum actually is usefull in the design stage as it focuses our attention on places where the content is a dynamic block coming from the CMS (unlike static content elements that will always stay the same.) Blocks of Lorem Ipsum with a character count range provide a obvious reminder to check and re-check that the design and the content model match up.\r\n\r\nKyle Fiedler from the Design Informer feels that distracting copy is your fault:\r\n\r\nIf the copy becomes distracting in the design then you are doing something wrong or they are discussing copy changes. It might be a bit annoying but you could tell them that that discussion would be best suited for another time. At worst the discussion is at least working towards the final goal of your site where questions about lorem ipsum don’t.', 
	'https://meinsite.com/nice.png', 50, 
	'ANGL0703', 'THE0303', 'BULG01');
--

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table COMMENT
--
-- (<NumCom, char(6),>, <DtCreC, datetime,>, <PseudoAuteur, char(20),>, <EmailAuteur, char(60),>,
-- <TitrCom, text(60),> <LibCom, text(600),>, <NumArt, char(10) not null,>)
*/
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('001', '2020-01-09 10:13:43', "Phil09", "Phil09@me.com", "Trop cool comme article", "Trop cool comme article", '10');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt)
VALUES
	('002', '2020-01-02 13:18:42', "TomyBl", "TomyBl@me.com", "Trop cool comme article", "Trop cool comme article", '10');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('003', '2020-01-04 16:21:12', "Chouchou", "Chouchou@me.com", "Trop cool comme article", "Trop cool comme article", '10');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('004', '2020-01-05 03:15:38', "Titi", "Titi@me.com", "Trop cool comme article", "Trop cool comme article", '10');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('005', '2020-01-06 21:16:36', "Kiss", "Kiss@me.com", "Trop cool comme article", "Trop cool comme article", '10');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('006', '2020-01-06 11:20:31', "Biss", "Biss@me.com", "Trop cool comme article", "Trop cool comme article", '10');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('007', '2020-01-08 08:41:12', "Silou", "silou@me.com", "Trop cool comme article", "Trop cool comme article", '10');
--
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('008', '2020-01-09 18:24:21', "Phil09", "Phil09@me.com", "Trop cool comme article", "Trop cool comme article", '12');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('009', '2020-01-02 16:29:16', "TomyBl", "TomyBl@me.com", "Trop cool comme article", "Trop cool comme article", '12');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('010', '2020-01-04 08:16:44', "Chouchou", "Chouchou@me.com", "Trop cool comme article", "Trop cool comme article", '12');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('011', '2020-01-05 14:27:39', "Titi", "Titi@me.com", "Trop cool comme article", "Trop cool comme article", '12');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('012', '2020-01-06 06:31:42', "Kiss", "Kiss@me.com", "Trop cool comme article", "Trop cool comme article", '12');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('013', '2020-01-06 23:50:27', "Biss", "Biss@me.com", "Trop cool comme article", "Trop cool comme article", '12');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('014', '2020-01-08 10:37:23', "Silou", "silou@me.com", "Trop cool comme article", "Trop cool comme article", '12');
--
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('015', '2020-01-09 15:31:17', "Phil09", "Phil09@me.com", "Trop cool comme article", "Trop cool comme article", '09');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('016', '2020-02-15 08:31:23', "TomyBl", "TomyBl@me.com", "Trop cool comme article", "Trop cool comme article", '09');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('017', '2020-02-19 06:28:00', "Counter99", "Counter99@me.com", "Trop cool comme article", "Trop cool comme article", '09');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('018', '2020-02-28 07:30:21', "Sisley33", "Sisley33@me.com", "Trop cool comme article", "Trop cool comme article", '09');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('019', '2020-02-29 17:31:38', "Archie", "Archie@me.com", "Trop cool comme article", "Trop cool comme article", '09');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('020', '2020-02-29 09:31:27', "Will's", "Wills@me.com", "Trop cool comme article", "Trop cool comme article", '14');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('021', '2020-03-02 16:33:41', "Kiss29", "Kiss29@me.com", "Trop cool comme article", "Trop cool comme article", '10');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('022', '2020-03-03 12:41:47', "Will's", "Wills@me.com", "Trop cool comme article", "Trop cool comme article", '13');
INSERT INTO COMMENT (NumCom, DtCreC, PseudoAuteur, EmailAuteur, TitrCom, LibCom, NumArt) 
VALUES
	('023', '2020-03-04 10:33:42', "Silou", "silou@me.com", "Trop cool comme article", "Trop cool comme article", '14');
--

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------
/*
--
-- Table MOTCLEARTICLE (Table de jointure)
--
-- (<NumArt, char(10),>, <NumMoCle, char(8),>)
*/
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('10', "MTCL0101");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('10', "MTCL0102");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('10', "MTCL0104");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('10', "MTCL0106");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('10', "MTCL0108");
--
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('11', "MTCL0104");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('11', "MTCL0107");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('11', "MTCL0108");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('11', "MTCL0109");
--
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('15', "MTCL0203");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('15', "MTCL0208");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('15', "MTCL0210");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('15', "MTCL0211");
--
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0301");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0303");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0305");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0307");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0308");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0310");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0311");
INSERT INTO MOTCLEARTICLE (NumArt, NumMoCle) VALUES ('16', "MTCL0312");
--

-- --------------------------------------------------------------------

-- --------------------------------------------------------------------

