# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: 127.0.0.1 (MySQL 5.5.5-10.2.8-MariaDB)
# Base de données: codeweek-migration
# Temps de génération: 2018-08-10 13:11:28 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
                             `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `parent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `population` int(11) DEFAULT NULL,
                             `position` int(11) DEFAULT 0,
                             `active` tinyint(1) DEFAULT 1,
                             `continent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             `longitude` double DEFAULT NULL,
                             `latitude` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;

INSERT INTO `countries` (`code`, `parent`, `name`, `population`, `continent`, `facebook`, `website`, `created_at`, `updated_at`,`longitude`,`latitude`)
VALUES
('AD','','Andorra',84000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',1.56054377918, 42.5422910219),
('AE','','United Arab Emirates',4975593,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',54.3001671016,23.9052818785),
('AF','','Afghanistan',29121286,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',66.0047336558,33.8352307278),
('AG','','Antigua and Barbuda',86754,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-61.794693427,17.2774995986),
('AI','GB','Anguilla',13254,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-63.0649892654,18.2239595023),
('AL','','Albania',2986952,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',20.0498339611,41.1424498947),
('AM','','Armenia',2968000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',44.9299327564,40.2895256919),
('AN','NL','Netherlands Antilles',136197,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('AO','','Angola',13068161,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',17.5373676815,-12.2933605438),
('AQ','','Antarctica',NULL,'AN','','','2018-08-10 13:06:16','2018-08-10 13:06:16',19.9210895122,-80.5085791311),
('AR','','Argentina',41343201,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-65.179806925,-35.3813487953),
('AS','US','American Samoa',57881,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-170.718025746,-14.3044599708),
('AT','','Austria',8205000,'EU','https://www.facebook.com/CodeWeek-Austria-151277175428538/','','2018-08-10 13:06:16','2018-08-10 13:06:16',14.1264760996,47.585494392),
('AU','','Australia',21515754,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',134.491000082,-25.7328870417),
('AW','NL','Aruba',71566,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-69.9826771125,12.5208803838),
('AX','FI','Aland Islands',26711,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',19.953287676,60.2148868756),
('AZ','','Azerbaijan',8303512,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',47.5459987892,40.2882723471),
('BA','','Bosnia and Herzegovina',4590000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',17.76876733,44.17450125),
('BB','','Barbados',285653,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-59.559797,13.18145428),
('BD','','Bangladesh',156118464,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',90.23812743,23.86731158),
('BE','','Belgium',10403000,'EU','https://www.facebook.com/eucodeweekbelgium/','','2018-08-10 13:06:16','2018-08-10 13:06:16',4.64065114,50.63981576),
('BF','','Burkina Faso',16241811,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-1.75456601,12.26953846),
('BG','','Bulgaria',7148785,'EU','https://www.facebook.com/EU-Code-Week-Bulgaria-699640040127398/','','2018-08-10 13:06:16','2018-08-10 13:06:16',25.21552909,42.76890318),
('BH','','Bahrain',1493000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',50.54196932,26.04205135),
('BI','','Burundi',9863117,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',29.87512156,-3.35939666),
('BJ','','Benin',9056010,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',2.32785254,9.6417597),
('BL','FR','Saint Barthelemy',8450,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-62.84067779,17.89880451),
('BM','GB','Bermuda',65365,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-64.7545589,32.31367802),
('BN','','Brunei',395027,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',114.72203035,4.51968958),
('BO','','Bolivia',9947418,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-64.68538645,-16.70814787),
('BQ','NL','Bonaire, Saint Eustatius and Saba ',18012,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('BR','','Brazil',201103330,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-53.09783113,-10.78777702),
('BS','','Bahamas',301790,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-76.62843038,24.29036702),
('BT','','Bhutan',699847,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',90.40188155,27.41106589),
('BV','','Bouvet Island',NULL,'AN','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('BW','','Botswana',2029307,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',23.79853368,-22.18403213),
('BY','','Belarus',9685000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',28.03209307,53.53131377),
('BZ','','Belize',314522,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-88.71010486,17.20027509),
('CA','','Canada',33679000,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-98.30777028,61.36206324),
('CC','AU','Cocos Islands',628,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('CD','','Democratic Republic of the Congo',70916439,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',23.64396107,-2.87746289),
('CF','','Central African Republic',4844927,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',20.46826831,6.56823297),
('CG','','Republic of the Congo',3039126,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',15.21965762,-0.83787463),
('CH','','Switzerland',7581000,'EU','https://www.facebook.com/codeweekswitzerland/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',8.20867471,46.79785878),
('CI','','Ivory Coast',21058798,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-5.5692157,7.6284262),
('CK','','Cook Islands',21388,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-159.78724218,-21.21927288),
('CL','','Chile',16746491,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-71.38256213,-37.73070989),
('CM','','Cameroon',19294149,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-5.5692157,7.6284262),
('CN','','China',1330044000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',103.81907349,36.56176546),
('CO','','Colombia',44205293,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-73.08114582,3.91383431),
('CR','','Costa Rica',4516220,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-84.19208768,9.97634464),
('CU','','Cuba',11423000,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-79.01605384,21.62289528),
('CV','','Cape Verde',508659,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-23.9598882,15.95523324),
('CW','NL','Curacao',141766,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-68.97119369,12.19551675),
('CX','AU','Christmas Island',1500,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('CY','','Cyprus',1102677,'EU','https://www.facebook.com/profile.php?id=572555376146147&ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',33.0060022,34.91667211),
('CZ','','Czech Republic',10476000,'EU','https://www.facebook.com/codeweekcz/','','2018-08-10 13:06:16','2018-08-10 13:06:16',15.31240163,49.73341233),
('DE','','Germany',81802257,'EU','https://www.facebook.com/codeweekgermany/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',10.38578051,51.10698181),
('DJ','','Djibouti',740528,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',42.5606754,11.74871806),
('DK','','Denmark',5484000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',10.02800992,55.98125296),
('DM','','Dominica',72813,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-61.357726,15.4394702),
('DO','','Dominican Republic',9823821,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-70.50568896,18.89433082),
('DZ','','Algeria',34586184,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',2.61732301,28.15893849),
('EC','','Ecuador',14790608,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-78.75201922,-1.42381612),
('EE','','Estonia',1291170,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',25.54248537,58.67192972),
('EG','','Egypt',80471869,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',29.86190099,26.49593311),
('EH','','Western Sahara',273008,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-12.21982755,24.22956739),
('ER','','Eritrea',5792984,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',38.84617011,15.36186618),
('ES','','Spain',46505963,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-3.64755047,40.24448698),
('ET','','Ethiopia',88013491,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',39.60080098,8.62278679),
('FI','','Finland',5244000,'EU','https://www.facebook.com/codeweekfinland/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',26.2746656,64.49884603),
('FJ','','Fiji',875983,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',165.45195432,-17.42858032),
('FK','GB','Falkland Islands',2638,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-59.35238956,-51.74483954),
('FM','','Micronesia',107708,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',153.23943792,7.45246814),
('FO','DK','Faroe Islands',48228,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-6.88095423,62.05385403),
('FR','','France',64768389,'EU','https://www.facebook.com/CodeWeekFrance/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',2.824354,46.980252),
('GA','','Gabon',1545255,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',11.7886287,-0.58660025),
('GB','','United Kingdom',62348447,'EU','https://www.facebook.com/Codeweekuk-475492319315384/','','2018-08-10 13:06:16','2018-08-10 13:06:16',-2.86563164,54.12387156),
('GD','','Grenada',107818,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-61.68220189,12.11725044),
('GE','','Georgia',4630000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',43.50780252,42.16855755),
('GF','FR','French Guiana',195506,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('GG','GB','Guernsey',65228,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-2.57239064,49.46809761),
('GH','','Ghana',24339838,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-1.21676566,7.95345644),
('GI','GB','Gibraltar',27884,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('GL','DK','Greenland',56375,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-41.34191127,74.71051289),
('GM','','Gambia',1593256,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-15.39601295,13.44965244),
('GN','','Guinea',10324025,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-10.94066612,10.43621593),
('GP','FR','Guadeloupe',443000,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('GQ','','Equatorial Guinea',1014999,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',10.34137924,1.70555135),
('GR','','Greece',11000000,'EU','https://www.facebook.com/codeEUGreece/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',22.95555794,39.07469623),
('GS','GB','South Georgia and the South Sandwich Islands',30,'AN','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-36.43318388,-54.46488248),
('GT','','Guatemala',13550440,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-90.36482009,15.69403664),
('GU','US','Guam',159358,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',144.76791022,13.44165626),
('GW','','Guinea-Bissau',1565126,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-14.94972445,12.04744948),
('GY','','Guyana',748486,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-58.98202459,4.79378034),
('HK','','Hong Kong',6898686,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',114.11380454,22.39827737),
('HM','AU','Heard Island and McDonald Islands',NULL,'AN','','','2018-08-10 13:06:16','2018-08-10 13:06:16',73.5205171,-53.08724656),
('HN','','Honduras',7989415,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-86.6151661,14.82688165),
('HR','','Croatia',4491000,'EU','https://www.facebook.com/CodeWeekHr/','','2018-08-10 13:06:16','2018-08-10 13:06:16',16.40412899,45.08047631),
('HT','','Haiti',9648924,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-72.68527509,18.93502563),
('HU','','Hungary',9982000,'EU','https://www.facebook.com/codeweekHU/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',19.39559116,47.16277506),
('ID','','Indonesia',242968342,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',117.24011366,-2.21505456),
('IE','','Ireland',4622917,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-8.13793569,53.1754487),
('IL','','Israel',7353985,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',35.00444693,31.46110101),
('IM','GB','Isle of Man',75049,'EU','https://www.facebook.com/EU-Code-Week-Isle-of-Man-120990338533752/','','2018-08-10 13:06:16','2018-08-10 13:06:16',-4.53873952,54.22418911),
('IN','','India',1173108018,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',79.6119761,22.88578212),
('IO','GB','British Indian Ocean Territory',4000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',72.44541229,-7.33059751),
('IQ','','Iraq',29671605,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',43.74353149,33.03970582),
('IR','','Iran',76923300,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',54.27407004,32.57503292),
('IS','','Iceland',308910,'EU','https://www.facebook.com/CodeWeekIS/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',-18.57396167,64.99575386),
('IT','','Italy',60590000,'EU','https://www.facebook.com/CodeWeekIT','','2018-08-10 13:06:16','2018-08-10 13:06:16',12.07001339,42.79662641),
('JE','GB','Jersey',90812,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-2.12689938,49.21837377),
('JM','','Jamaica',2847232,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',12.07001339,42.79662641),
('JO','','Jordan',6407085,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',36.77136104,31.24579091),
('JP','','Japan',127288000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',138.03089558,37.59230135),
('KE','','Kenya',40046566,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',37.79593973,0.59988022),
('KG','','Kyrgyzstan',5508626,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',74.54165513,41.46221943),
('KH','','Cambodia',14453680,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',104.90694325,12.72004786),
('KI','','Kiribati',92533,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-45.61110513,0.86001503),
('KM','','Comoros',773407,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',43.68253968,-11.87783444),
('KN','','Saint Kitts and Nevis',49898,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-62.68755265,17.2645995),
('KP','','North Korea',22912177,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',127.19247973,40.15350311),
('KR','','South Korea',48422644,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',127.83916086,36.38523983),
('KW','','Kuwait',2789132,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',47.58700459,29.33431262),
('KY','GB','Cayman Islands',44270,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-80.91213321,19.42896497),
('KZ','','Kazakhstan',15340000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',67.29149357,48.15688067),
('LA','','Laos',6368162,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',103.73772412,18.50217433),
('LB','','Lebanon',4125247,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',35.88016072,33.92306631),
('LC','','Saint Lucia',160922,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-60.96969923,13.89479481),
('LI','','Liechtenstein',35000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',9.53574312,47.13665835),
('LK','','Sri Lanka',21513990,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',80.70108238,7.61266509),
('LR','','Liberia',3685076,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-9.32207573,6.45278492),
('LS','','Lesotho',1919552,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',28.22723131,-29.58003188),
('LT','','Lithuania',3565000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',23.88719355,55.32610984),
('LU','','Luxembourg',497538,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',6.07182201,49.76725361),
('LV','','Latvia',2217969,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',24.91235983,56.85085163),
('LY','','Libya',6461454,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',18.00866169,27.03094495),
('MA','','Morocco',31627428,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-8.45615795,29.83762955),
('MC','','Monaco',32965,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',7.40627677,43.75274627),
('MD','','Moldova',4324000,'EU','https://www.facebook.com/codeweekMD/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',28.45673372,47.19498804),
('ME','','Montenegro',622471,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',19.23883939,42.78890259),
('MF','FR','Saint Martin',35925,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-63.05972851,18.08888611),
('MG','','Madagascar',21281844,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',46.70473674,-19.37189587),
('MH','','Marshall Islands',65859,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',170.33976122,7.00376358),
('MK','','Macedonia',2061000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',21.68211346,41.59530893),
('ML','','Mali',13796354,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-3.54269065,17.34581581),
('MM','','Myanmar',53414374,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',96.48843321,21.18566599),
('MN','','Mongolia',3086918,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',103.05299765,46.82681544),
('MO','CN','Macao',449198,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',113.50932116,22.22311688),
('MP','US','Northern Mariana Islands',53883,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',145.61969651,15.82927563),
('MQ','FR','Martinique',432900,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-61.024174,14.641528),
('MR','','Mauritania',3205060,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-10.34779815,20.25736706),
('MS','GB','Montserrat',9341,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-62.18518546,16.73941406),
('MT','','Malta',460297,'EU','https://www.facebook.com/CodeEUMalta/','','2018-08-10 13:06:16','2018-08-10 13:06:16',14.40523316,35.92149632),
('MU','','Mauritius',1294104,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',57.57120551,-20.27768704),
('MV','','Maldives',395650,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',73.45713004,3.7287092),
('MW','','Malawi',15447500,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',34.28935599,-13.21808088),
('MX','','Mexico',112468855,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-102.52345169,23.94753724),
('MY','','Malaysia',28274729,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',109.69762284,3.78986846),
('MZ','','Mozambique',22061451,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',35.53367543,-17.27381643),
('NA','','Namibia',2128471,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',17.20963567,-22.13032568),
('NC','FR','New Caledonia',216494,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',165.68492374,-21.29991806),
('NE','','Niger',15878271,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',9.38545882,17.41912493),
('NF','AU','Norfolk Island',1828,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',167.94921678,-29.0514609),
('NG','','Nigeria',154000000,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',8.08943895,9.59411452),
('NI','','Nicaragua',5995928,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-85.0305297,12.84709429),
('NL','','Netherlands',16645000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',5.28144793,52.1007899),
('NO','','Norway',5009150,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',15.34834656,68.75015572),
('NP','','Nepal',28951852,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',83.9158264,28.24891365),
('NR','','Nauru',10065,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',166.93256823,-0.51912639),
('NU','','Niue',2166,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-169.86994682,-19.04945708),
('NZ','','New Zealand',4252277,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',171.48492347,-41.81113557),
('OM','','Oman',2967717,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',56.09166155,20.60515333),
('PA','','Panama',3410676,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-80.11915156,8.51750797),
('PE','','Peru',29907003,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-74.38242685,-9.15280381),
('PF','FR','French Polynesia',270485,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-144.90494387,-14.72227409),
('PG','','Papua New Guinea',6064515,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',145.20744752,-6.46416646),
('PH','','Philippines',99900177,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',122.88393253,11.77536778),
('PK','','Pakistan',184404791,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',69.33957937,29.9497515),
('PL','','Poland',38430000,'EU','https://www.facebook.com/CodeWeekPL/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',19.39012835,52.12759564),
('PM','FR','Saint Pierre and Miquelon',7012,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-56.30319779,46.91918789),
('PN','GB','Pitcairn',46,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-128.31704202,-24.36500535),
('PR','','Puerto Rico',3916632,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-66.47307604,18.22813055),
('PS','','Palestine',3800000,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',35.19628705,31.91613893),
('PT','','Portugal',10676000,'EU','https://www.facebook.com/codeweekPT/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',-8.50104361,39.59550671),
('PW','','Palau',19907,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',134.40807966,7.28742784),
('PY','','Paraguay',6375830,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-58.40013703,-23.22823913),
('QA','','Qatar',840926,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',51.18479632,25.30601188),
('RE','FR','Reunion',776948,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',55.450020,-20.882980),
('RO','','Romania',21959278,'EU','https://www.facebook.com/EUCodeWeekRomania/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',24.97293039,45.85243127),
('RS','','Serbia',7344847,'EU','https://www.facebook.com/CodeWeekSerbia/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',20.78958334,44.2215032),
('RU','','Russia',140702000,'EU','https://www.facebook.com/%D0%9B%D0%B0%D0%B1%D0%BE%D1%80%D0%B0%D1%82%D0%BE%D1%80%D0%B8%D1%8F-%D0%BA%D1%80%D0%B5%D0%B0%D1%82%D0%B8%D0%B2%D0%BD%D0%BE%D0%B3%D0%BE-%D0%BF%D1%80%D0%BE%D0%B3%D1%80%D0%B0%D0%BC%D0%BC%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D1%8F','','2018-08-10 13:06:16','2018-08-10 13:06:16',96.68656112,61.98052209),
('RW','','Rwanda',11055976,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',29.91988515,-1.99033832),
('SA','','Saudi Arabia',25731776,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',44.53686271,24.12245841),
('SB','','Solomon Islands',559198,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',159.63287668,-8.92178022),
('SC','','Seychelles',88340,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',55.47603279,-4.66099094),
('SD','','Sudan',35000000,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',29.94046812,15.99035669),
('SE','','Sweden',9555893,'EU','https://www.facebook.com/codeweeksweden/?ref=br_rs','','2018-08-10 13:06:16','2018-08-10 13:06:16',16.74558049,62.77966519),
('SG','','Singapore',4701069,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',103.81725592,1.35876087),
('SH','GB','Saint Helena',7460,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-9.54779416,-12.40355951),
('SI','','Slovenia',2007000,'EU','https://www.facebook.com/codeweek.si','','2018-08-10 13:06:16','2018-08-10 13:06:16',14.80444238,46.11554772),
('SJ','NO','Svalbard and Jan Mayen',2550,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('SK','','Slovakia',5455000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',19.47905218,48.70547528),
('SL','','Sierra Leone',5245695,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-11.79271247,8.56329593),
('SM','','San Marino',31477,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',12.45922334,43.94186747),
('SN','','Senegal',12323252,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-14.4734924,14.36624173),
('SO','','Somalia',10112453,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',45.70714487,4.75062876),
('SR','','Suriname',492829,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-55.9123457,4.13055413),
('SS','','South Sudan',8260490,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',30.24790002,7.30877945),
('ST','','Sao Tome and Principe',175808,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',6.72429658,0.44391445),
('SV','','El Salvador',6052064,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-88.87164469,13.73943744),
('SX','NL','Sint Maarten',37429,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-63.05713363,18.05081728),
('SY','','Syria',22198110,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',38.50788204,35.02547389),
('SZ','','Eswatini',1354051,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('TC','GB','Turks and Caicos Islands',20556,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-71.97387881,21.83047572),
('TD','','Chad',10543464,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',18.64492513,15.33333758),
('TF','FR','French Southern Territories',140,'AN','','','2018-08-10 13:06:16','2018-08-10 13:06:16', 69.2266675845,-49.2489548494),
('TG','','Togo',6587239,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0.96232845,8.52531356),
('TH','','Thailand',67089500,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',101.0028813,15.11815794),
('TJ','','Tajikistan',7487489,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',71.01362631,38.5304539),
('TK','','Tokelau',1466,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('TL','','East Timor',1154625,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',125.84438982,-8.82889162),
('TM','','Turkmenistan',4940916,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',59.37100021,39.11554137),
('TN','','Tunisia',10589025,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',9.55288359,34.11956246),
('TO','','Tonga',122580,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-174.80987341,-20.42843174),
('TR','','Turkey',79810000,'AS','https://www.facebook.com/groups/1448094125469237/','','2018-08-10 13:06:16','2018-08-10 13:06:16',35.16895346,39.0616029),
('TT','','Trinidad and Tobago',1228691,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-61.26567923,10.45733408),
('TV','','Tuvalu',10472,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('TW','','Taiwan',22894384,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',120.95427281,23.7539928),
('TZ','','Tanzania',41892895,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',34.81309981,-6.27565408),
('UA','','Ukraine',45415596,'EU','https://www.facebook.com/groups/1179293055426737/','','2018-08-10 13:06:16','2018-08-10 13:06:16',31.38326469,48.99656673),
('UG','','Uganda',33398682,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',32.36907971,1.27469299),
('UM','US','United States Minor Outlying Islands',NULL,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',0,0),
('US','','United States',310232863,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-112.4616737,45.6795472),
('UY','','Uruguay',3477000,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-56.01807053,-32.79951534),
('UZ','','Uzbekistan',27865738,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',63.14001528,41.75554225),
('VA','','Vatican',921,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',12.43387177,41.90174985),
('VC','','Saint Vincent and the Grenadines',104217,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-61.20129695,13.22472269),
('VE','','Venezuela',27223228,'SA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-66.18184123,7.12422421),
('VG','GB','British Virgin Islands',21730,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-64.47146992,18.52585755),
('VI','US','U.S. Virgin Islands',108708,'NA','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-64.80301538,17.95500624),
('VN','','Vietnam',89571130,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',106.29914698,16.6460167),
('VU','','Vanuatu',221552,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',167.68644636,-16.22640909),
('WF','FR','Wallis and Futuna',16025,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-177.34834825,-13.88737039),
('WS','','Samoa',192001,'OC','','','2018-08-10 13:06:16','2018-08-10 13:06:16',-172.16485064,-13.75324346),
('XK','','Kosovo',1800000,'EU','','','2018-08-10 13:06:16','2018-08-10 13:06:16',20.87249811,42.57078707),
('YE','','Yemen',23495361,'AS','','','2018-08-10 13:06:16','2018-08-10 13:06:16',47.58676189,15.90928005),
('YT','FR','Mayotte',159042,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',45.166245,-12.827500),
('ZA','','South Africa',49000000,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',25.08390093,-29.00034095),
('ZM','','Zambia',13460305,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',27.77475946,-13.45824152),
('ZW','','Zimbabwe',11651858,'AF','','','2018-08-10 13:06:16','2018-08-10 13:06:16',29.8514412,-19.00420419);

/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
