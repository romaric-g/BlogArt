/*************************************************************************/
/* Blog des articles (BD MySQL) du cours M2203
//
// Création du script de la base de données BLOGART 
//
// @Martine Bornerie    Le 03/03/20 17:17:00
//
// nom script : JeuEssaiPays2020MySQL_OK.sql
//
*/
/*************************************************************************/
--
-- Base de données: `BLOGART`
--
USE BLOGART20;

-- ---------------------------------------------------------------------- --
-- ---------------------------------------------------------------------- --
--
-- Data/tuples de la table `PAYS`
--
-- ---------------------------------------------------------------------- --
-- ---------------------------------------------------------------------- --

INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (1,'AF', 'AFGH', 'Afghanistan','Afghanistan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (2,'ZA', 'AFRI', 'Afrique du Sud','South Africa');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (3,'AL', 'ALBA', 'Albanie','Albania');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (4,'DZ', 'ALGE', 'Algérie','Algeria');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (5,'DE', 'ALLE', 'Allemagne','Germany');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (6,'AD', 'ANDO', 'Andorre','Andorra');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (7,'AO', 'ANGO', 'Angola','Angola');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (8,'AI', 'ANGU', 'Anguilla','Anguilla');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (9,'AQ', 'ARTA', 'Antarctique','Antarctica');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (10,'AG', 'ANTG', 'Antigua-et-Barbuda','Antigua & Barbuda');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (11,'AN', 'ANTI', 'Antilles néerlandaises','Netherlands Antilles');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (12,'SA', 'ARAB', 'Arabie saoudite','Saudi Arabia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (13,'AR', 'ARGE', 'Argentine','Argentina');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (14,'AM', 'ARME', 'Arménie','Armenia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (15,'AW', 'ARUB', 'Aruba','Aruba');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (16,'AU', 'AUST', 'Australie','Australia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (17,'AT', 'AUTR', 'Autriche','Austria');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (18,'AZ', 'AZER', 'Azerbaïdjan','Azerbaijan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (19,'BJ', 'BENI', 'Bénin','Benin');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (20,'BS', 'BAHA', 'Bahamas','Bahamas, The');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (21,'BH', 'BAHR', 'Bahreïn','Bahrain');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (22,'BD', 'BANG', 'Bangladesh','Bangladesh');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (23,'BB', 'BARB', 'Barbade','Barbados');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (24,'PW', 'BELA', 'Belau','Palau');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (25,'BE', 'BELG', 'Belgique','Belgium');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (26,'BZ', 'BELI', 'Belize','Belize');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (27,'BM', 'BERM', 'Bermudes','Bermuda');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (28,'BT', 'BHOU', 'Bhoutan','Bhutan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (29,'BY', 'BIEL', 'Biélorussie','Belarus');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (30,'MM', 'BIRM', 'Birmanie','Myanmar (ex-Burma)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (31,'BO', 'BOLV', 'Bolivie','Bolivia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (32,'BA', 'BOSN', 'Bosnie-Herzégovine','Bosnia and Herzegovina');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (33,'BW', 'BOTS', 'Botswana','Botswana');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (34,'BR', 'BRES', 'Brésil','Brazil');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (35,'BN', 'BRUN', 'Brunei','Brunei Darussalam');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (36,'BG', 'BULG', 'Bulgarie','Bulgaria');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (37,'BF', 'BURK', 'Burkina Faso','Burkina Faso');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (38,'BI', 'BURU', 'Burundi','Burundi');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (39,'CI', 'IVOIR', 'Côte d\'Ivoire','Ivory Coast (see Cote d\'Ivoire)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (40,'KH', 'CAMB', 'Cambodge','Cambodia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (41,'CM', 'CAME', 'Cameroun','Cameroon');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (42,'CA', 'CANA', 'Canada','Canada');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (43,'CV', 'CVER', 'Cap-Vert','Cape Verde');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (44,'CL', 'CHIL', 'Chili','Chile');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (45,'CN', 'CHIN', 'Chine','China');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (46,'CY', 'CHYP', 'Chypre','Cyprus');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (47,'CO', 'COLO', 'Colombie','Colombia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (48,'KM', 'COMO', 'Comores','Comoros');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (49,'CG', 'CONG', 'Congo','Congo');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (50,'KP', 'CNOR', 'Corée du Nord','Korea, Demo. People s Rep. of');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (51,'KR', 'CSUD', 'Corée du Sud','Korea, (South) Republic of');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (52,'CR', 'RICA', 'Costa Rica','Costa Rica');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (53,'HR', 'CROA', 'Croatie','Croatia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (54,'CU', 'CUBA', 'Cuba','Cuba');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (55,'DK', 'DANE', 'Danemark','Denmark');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (56,'DJ', 'DJIB', 'Djibouti','Djibouti');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (57,'DM', 'DOMI', 'Dominique','Dominica');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (58,'EG', 'EGYP', 'Égypte','Egypt');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (59,'AE', 'EMIR', 'Émirats arabes unis','United Arab Emirates');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (60,'EC', 'EQUA', 'Équateur','Ecuador');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (61,'ER', 'ERYT', 'Érythrée','Eritrea');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (62,'ES', 'ESPA', 'Espagne','Spain');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (63,'EE', 'ESTO', 'Estonie','Estonia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (64,'US', 'USA_', 'États-Unis','United States');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (65,'ET', 'ETHO', 'Éthiopie','Ethiopia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (66,'FI', 'FINL', 'Finlande','Finland');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (67,'FR', 'FRAN', 'France','France');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (68,'GE', 'GEOR', 'Géorgie','Georgia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (69,'GA', 'GABO', 'Gabon','Gabon');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (70,'GM', 'GAMB', 'Gambie','Gambia, the');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (71,'GH', 'GANA', 'Ghana','Ghana');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (72,'GI', 'GIBR', 'Gibraltar','Gibraltar');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (73,'GR', 'GREC', 'Grèce','Greece');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (74,'GD', 'GREN', 'Grenade','Grenada');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (75,'GL', 'GROE', 'Groenland','Greenland');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (76,'GP', 'GUAD', 'Guadeloupe','Guinea, Equatorial');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (77,'GU', 'GUAM', 'Guam','Guam');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (78,'GT', 'GUAT', 'Guatemala','Guatemala');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (79,'GN', 'GUIN', 'Guinée','Guinea');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (80,'GQ', 'GUIE', 'Guinée équatoriale','Equatorial Guinea');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (81,'GW', 'GUIB', 'Guinée-Bissao','Guinea-Bissau');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (82,'GY', 'GUYA', 'Guyana','Guyana');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (83,'GF', 'GUYF', 'Guyane française','Guiana, French');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (84,'HT', 'HAIT', 'Haïti','Haiti');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (85,'HN', 'HOND', 'Honduras','Honduras');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (86,'HK', 'KONG', 'Hong Kong','Hong Kong, (China)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (87,'HU', 'HONG', 'Hongrie','Hungary');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (88,'BV', 'BOUV', 'Ile Bouvet','Bouvet Island');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (89,'CX', 'CHRI', 'Ile Christmas','Christmas Island');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (90,'NF', 'NORF', 'Ile Norfolk','Norfolk Island');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (91,'KY', 'CAYM', 'Iles Cayman','Cayman Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (92,'CK', 'COOK', 'Iles Cook','Cook Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (93,'FO', 'FERO', 'Iles Féroé','Faroe Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (94,'FK', 'FALK', 'Iles Falkland','Falkland Islands (Malvinas)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (95,'FJ', 'FIDJ', 'Iles Fidji','Fiji');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (96,'GS', 'GEOR', 'Iles Géorgie du Sud et Sandwich du Sud','S. Georgia and S. Sandwich Is.');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (97,'HM', 'HEAR', 'Iles Heard et McDonald','Heard and McDonald Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (98,'MH', 'MARS', 'Iles Marshall','Marshall Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (99,'PN', 'PITC', 'Iles Pitcairn','Pitcairn Island');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (100,'SB', 'SALO', 'Iles Salomon','Solomon Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (101,'SJ', 'SVAL', 'Iles Svalbard et Jan Mayen','Svalbard and Jan Mayen Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (102,'TC', 'TURK', 'Iles Turks-et-Caicos','Turks and Caicos Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (103,'VI', 'VIEA', 'Iles Vierges américaines','Virgin Islands, U.S.');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (104,'VG', 'VIEB', 'Iles Vierges britanniques','Virgin Islands, British');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (105,'CC', 'COCO', 'Iles des Cocos (Keeling)','Cocos (Keeling) Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (106,'UM', 'MINE', 'Iles mineures éloignées des États-Unis','US Minor Outlying Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (107,'IN', 'INDE', 'Inde','India');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (108,'ID', 'INDO', 'Indonésie','Indonesia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (109,'IR', 'IRAN', 'Iran','Iran, Islamic Republic of');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (110,'IQ', 'IRAQ', 'Iraq','Iraq');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (111,'IE', 'IRLA', 'Irlande','Ireland');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (112,'IS', 'ISLA', 'Islande','Iceland');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (113,'IL', 'ISRA', 'Israël','Israel');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (114,'IT', 'ITAL', 'Italie','Italy');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (115,'JM', 'JAMA', 'Jamaïque','Jamaica');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (116,'JP', 'JAPO', 'Japon','Japan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (117,'JO', 'JORD', 'Jordanie','Jordan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (118,'KZ', 'KAZA', 'Kazakhstan','Kazakhstan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (119,'KE', 'KNYA', 'Kenya','Kenya');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (120,'KG', 'KIRG', 'Kirghizistan','Kyrgyzstan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (121,'KI', 'KIRI', 'Kiribati','Kiribati');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (122,'KW', 'KWEI', 'Koweït','Kuwait');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (123,'LA', 'LAOS', 'Laos','Lao People s Democratic Republic');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (124,'LS', 'LESO', 'Lesotho','Lesotho');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (125,'LV', 'LETT', 'Lettonie','Latvia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (126,'LB', 'LIBA', 'Liban','Lebanon');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (127,'LR', 'LIBE', 'Liberia','Liberia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (128,'LY', 'LIBY', 'Libye','Libyan Arab Jamahiriya');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (129,'LI', 'LIEC', 'Liechtenstein','Liechtenstein');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (130,'LT', 'LITU', 'Lituanie','Lithuania');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (131,'LU', 'LUXE', 'Luxembourg','Luxembourg');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (132,'MO', 'MACA', 'Macao','Macao, (China)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (133,'MG', 'MADA', 'Madagascar','Madagascar');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (134,'MY', 'MALA', 'Malaisie','Malaysia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (135,'MW', 'MALW', 'Malawi','Malawi');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (136,'MV', 'MALD', 'Maldives','Maldives');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (137,'ML', 'MALI', 'Mali','Mali');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (138,'MT', 'MALT', 'Malte','Malta');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (139,'MP', 'MARI', 'Mariannes du Nord','Northern Mariana Islands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (140,'MA', 'MARO', 'Maroc','Morocco');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (141,'MQ', 'MART', 'Martinique','Martinique');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (142,'MU', 'MAUC', 'Maurice','Mauritius');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (143,'MR', 'MAUR', 'Mauritanie','Mauritania');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (144,'YT', 'MAYO', 'Mayotte','Mayotte');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (145,'MX', 'MEXI', 'Mexique','Mexico');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (146,'FM', 'MICRO', 'Micronésie','Micronesia, Federated States of');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (147,'MD', 'MOLD', 'Moldavie','Moldova, Republic of');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (148,'MC', 'MONA', 'Monaco','Monaco');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (149,'MN', 'MONG', 'Mongolie','Mongolia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (150,'MS', 'MONS', 'Montserrat','Montserrat');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (151,'MZ', 'MOZA', 'Mozambique','Mozambique');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (152,'NP', 'NEPA', 'Népal','Nepal');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (153,'NA', 'NAMI', 'Namibie','Namibia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (154,'NR', 'NAUR', 'Nauru','Nauru');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (155,'NI', 'NICA', 'Nicaragua','Nicaragua');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (156,'NE', 'NIGE', 'Niger','Niger');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (157,'NG', 'NIGA', 'Nigeria','Nigeria');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (158,'NU', 'NIOU', 'Nioué','Niue');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (159,'NO', 'NORV', 'Norvège','Norway');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (160,'NC', 'NOUC', 'Nouvelle-Calédonie','New Caledonia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (161,'NZ', 'NOUZ', 'Nouvelle-Zélande','New Zealand');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (162,'OM', 'OMAN', 'Oman','Oman');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (163,'UG', 'OUGA', 'Ouganda','Uganda');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (164,'UZ', 'OUZE', 'Ouzbékistan','Uzbekistan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (165,'PE', 'PERO', 'Pérou','Peru');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (166,'PK', 'PAKI', 'Pakistan','Pakistan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (167,'PA', 'PANA', 'Panama','Panama');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (168,'PG', 'PAPU', 'Papouasie-Nouvelle-Guinée','Papua New Guinea');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (169,'PY', 'PARA', 'Paraguay','Paraguay');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (170,'NL', 'PBAS', 'pays-Bas','Netherlands');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (171,'PH', 'PHIL', 'Philippines','Philippines');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (172,'PL', 'POLO', 'Pologne','Poland');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (173,'PF', 'POLY', 'Polynésie française','French Polynesia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (174,'PR', 'RICO', 'Porto Rico','Puerto Rico');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (175,'PT', 'PORT', 'Portugal','Portugal');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (176,'QA', 'QATA', 'Qatar','Qatar');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (177,'CF', 'CAFR', 'République centrafricaine','Central African Republic');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (178,'CD', 'CONG', 'République démocratique du Congo','Congo, Democratic Rep. of the');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (179,'DO', 'DOMI', 'République dominicaine','Dominican Republic');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (180,'CZ', 'TCHE', 'République tchèque','Czech Republic');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (181,'RE', 'REUN', 'Réunion','Reunion');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (182,'RO', 'ROUM', 'Roumanie','Romania');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (183,'GB', 'MIQU', 'Royaume-Uni','Saint Pierre and Miquelon');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (184,'RU', 'RUSS', 'Russie','Russia (Russian Federation)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (185,'RW', 'RWAN', 'Rwanda','Rwanda');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (186,'SN', 'SENE', 'Sénégal','Senegal');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (187,'EH', 'SAHA', 'Sahara occidental','Western Sahara');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (188,'KN', 'NIEV', 'Saint-Christophe-et-Niévès','Saint Kitts and Nevis');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (189,'SM', 'SMAR', 'Saint-Marin','San Marino');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (190,'PM', 'SPIE', 'Saint-Pierre-et-Miquelon','Saint Pierre and Miquelon');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (191,'VA', 'SSIE', 'Saint-Siège ','Vatican City State (Holy See)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (192,'VC', 'SVIN', 'Saint-Vincent-et-les-Grenadines','Saint Vincent and the Grenadines');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (193,'SH', 'SLN_', 'Sainte-Hélène','Saint Helena');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (194,'LC', 'SLUC', 'Sainte-Lucie','Saint Lucia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (195,'SV', 'SALV', 'Salvador','El Salvador');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (196,'WS', 'SAMO', 'Samoa','Samoa');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (197,'AS', 'SAMA', 'Samoa américaines','American Samoa');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (198,'ST', 'TOME', 'Sao Tomé-et-Principe','Sao Tome and Principe');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (199,'SC', 'SEYC', 'Seychelles','Seychelles');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (200,'SL', 'LEON', 'Sierra Leone','Sierra Leone');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (201,'SG', 'SING', 'Singapour','Singapore');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (202,'SI', 'SLOV', 'Slovénie','Slovenia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (203,'SK', 'SLOQ', 'Slovaquie','Slovakia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (204,'SO', 'SOMA', 'Somalie','Somalia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (205,'SD', 'SOUD', 'Soudan','Sudan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (206,'LK', 'SRIL', 'Sri Lanka','Sri Lanka (ex-Ceilan)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (207,'SE', 'SUED', 'Suède','Sweden');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (208,'CH', 'SUIS', 'Suisse','Switzerland');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (209,'SR', 'SURI', 'Suriname','Suriname');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (210,'SZ', 'SWAZ', 'Swaziland','Swaziland');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (211,'SY', 'SYRI', 'Syrie','Syrian Arab Republic');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (212,'TW', 'TAIW', 'Taïwan','Taiwan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (213,'TJ', 'TADJ', 'Tadjikistan','Tajikistan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (214,'TZ', 'TANZ', 'Tanzanie','Tanzania, United Republic of');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (215,'TD', 'TCHA', 'Tchad','Chad');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (216,'TF', 'TERR', 'Terres australes françaises','French Southern Territories - TF');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (217,'IO', 'BOIN', 'Territoire britannique de l Océan Indien','British Indian Ocean Territory');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (218,'TH', 'THAI', 'Thaïlande','Thailand');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (219,'TL', 'TIMO', 'Timor Oriental','Timor-Leste (East Timor)');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (220,'TG', 'TOGO', 'Togo','Togo');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (221,'TK', 'TOKE', 'Tokélaou','Tokelau');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (222,'TO', 'TONGA', 'Tonga','Tonga');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (223,'TT', 'TOBA', 'Trinité-et-Tobago','Trinidad & Tobago');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (224,'TN', 'TUNI', 'Tunisie','Tunisia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (225,'TM', 'TURK', 'Turkménistan','Turkmenistan');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (226,'TR', 'TURQ', 'Turquie','Turkey');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (227,'TV', 'TUVA', 'Tuvalu','Tuvalu');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (228,'UA', 'UKRA', 'Ukraine','Ukraine');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (229,'UY', 'URUG', 'Uruguay','Uruguay');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (230,'VU', 'VANU', 'Vanuatu','Vanuatu');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (231,'VE', 'VENE', 'Venezuela','Venezuela');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (232,'VN', 'VIET', 'Viêt Nam','Viet Nam');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (233,'WF', 'WALI', 'Wallis-et-Futuna','Wallis and Futuna');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (234,'YE', 'YEME', 'Yémen','Yemen');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (235,'YU', 'YOUG', 'Yougoslavie','Saint Pierre and Miquelon');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (236,'ZM', 'ZAMB', 'Zambie','Zambia');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (237,'ZW', 'ZIMB', 'Zimbabwe','Zimbabwe');
INSERT INTO PAYS (idPays, cdPays, numPays, frPays, enPays) 
	VALUES (238,'MK', 'MACE', 'ex-République yougoslave de Macédoine','Macedonia, TFYR');

-- ---------------------------------------------------------------------- --
-- ---------------------------------------------------------------------- --


