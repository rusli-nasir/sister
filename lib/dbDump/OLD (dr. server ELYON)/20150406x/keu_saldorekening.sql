﻿# Host: localhost  (Version: 5.5.36)
# Date: 2015-04-08 14:35:30
# Generator: MySQL-Front 5.3  (Build 2.16)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

#
# Source for table "keu_saldorekening"
#

DROP TABLE IF EXISTS `keu_saldorekening`;
CREATE TABLE `keu_saldorekening` (
  `replid` int(10) NOT NULL AUTO_INCREMENT,
  `rekening` int(10) DEFAULT NULL,
  `tahunbuku` int(10) DEFAULT NULL,
  `nominal` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=InnoDB AUTO_INCREMENT=493 DEFAULT CHARSET=latin1;

#
# Data for table "keu_saldorekening"
#

INSERT INTO `keu_saldorekening` VALUES (155,1,1,0),(156,2,1,90000),(157,3,1,0),(158,4,1,455555),(159,5,1,0),(160,6,1,0),(161,7,1,0),(162,8,1,0),(163,9,1,0),(164,10,1,0),(165,11,1,0),(166,12,1,0),(167,13,1,0),(168,14,1,0),(169,15,1,0),(170,16,1,0),(171,17,1,0),(172,18,1,0),(173,19,1,0),(174,20,1,0),(175,21,1,0),(176,22,1,0),(177,23,1,0),(178,24,1,0),(179,25,1,0),(180,26,1,0),(181,27,1,0),(182,28,1,0),(183,29,1,0),(184,30,1,0),(185,31,1,0),(186,32,1,0),(187,33,1,0),(188,34,1,0),(189,35,1,0),(190,36,1,0),(191,37,1,0),(192,38,1,0),(193,39,1,0),(194,40,1,0),(195,41,1,0),(196,42,1,0),(197,43,1,0),(198,44,1,0),(199,45,1,0),(200,46,1,0),(201,47,1,0),(202,48,1,0),(203,49,1,0),(204,50,1,0),(205,61,1,0),(206,62,1,0),(207,63,1,0),(208,64,1,0),(209,65,1,0),(210,66,1,0),(211,67,1,0),(212,68,1,0),(213,69,1,0),(214,70,1,0),(215,71,1,0),(216,72,1,0),(217,73,1,0),(218,74,1,0),(219,75,1,0),(220,76,1,0),(221,77,1,0),(222,78,1,0),(223,79,1,0),(224,80,1,0),(225,331,1,0),(226,332,1,0),(227,333,1,0),(228,334,1,0),(229,335,1,0),(230,336,1,0),(231,337,1,0),(232,340,1,0),(233,53,1,0),(234,54,1,0),(235,55,1,0),(236,56,1,0),(237,57,1,0),(238,58,1,0),(239,59,1,0),(240,60,1,0),(241,81,1,0),(242,82,1,0),(243,323,1,0),(244,324,1,0),(245,325,1,0),(246,326,1,0),(247,327,1,0),(248,328,1,0),(249,329,1,0),(250,330,1,0),(251,315,1,0),(252,316,1,0),(253,317,1,0),(254,318,1,0),(255,319,1,0),(256,320,1,0),(257,321,1,0),(258,322,1,0),(259,307,1,0),(260,308,1,0),(261,309,1,0),(262,310,1,0),(263,311,1,0),(264,312,1,0),(265,313,1,0),(266,314,1,0),(267,299,1,0),(268,300,1,0),(269,301,1,0),(270,302,1,0),(271,303,1,0),(272,304,1,0),(273,305,1,0),(274,306,1,0),(275,291,1,0),(276,292,1,0),(277,293,1,0),(278,294,1,0),(279,295,1,0),(280,296,1,0),(281,297,1,0),(282,298,1,0),(283,283,1,0),(284,284,1,0),(285,285,1,0),(286,286,1,0),(287,287,1,0),(288,288,1,0),(289,289,1,0),(290,290,1,0),(291,275,1,0),(292,276,1,0),(293,277,1,0),(294,278,1,0),(295,279,1,0),(296,280,1,0),(297,281,1,0),(298,282,1,0),(299,267,1,0),(300,268,1,0),(301,269,1,0),(302,270,1,0),(303,271,1,0),(304,272,1,0),(305,273,1,0),(306,274,1,0),(307,259,1,0),(308,260,1,0),(309,261,1,0),(310,262,1,0),(311,263,1,0),(312,264,1,0),(313,265,1,0),(314,266,1,0),(315,251,1,0),(316,252,1,0),(317,253,1,0),(318,254,1,0),(319,255,1,0),(320,256,1,0),(321,257,1,0),(322,258,1,0),(323,243,1,0),(324,244,1,0),(325,245,1,0),(326,246,1,0),(327,247,1,0),(328,248,1,0),(329,249,1,0),(330,250,1,0),(331,235,1,0),(332,236,1,0),(333,237,1,0),(334,238,1,0),(335,239,1,0),(336,240,1,0),(337,241,1,0),(338,242,1,0),(339,227,1,0),(340,228,1,0),(341,229,1,0),(342,230,1,0),(343,231,1,0),(344,232,1,0),(345,233,1,0),(346,234,1,0),(347,219,1,0),(348,220,1,0),(349,221,1,0),(350,222,1,0),(351,223,1,0),(352,224,1,0),(353,225,1,0),(354,226,1,0),(355,211,1,0),(356,212,1,0),(357,213,1,0),(358,214,1,0),(359,215,1,0),(360,216,1,0),(361,217,1,0),(362,218,1,0),(363,203,1,0),(364,204,1,0),(365,205,1,0),(366,206,1,0),(367,207,1,0),(368,208,1,0),(369,209,1,0),(370,210,1,0),(371,195,1,0),(372,196,1,0),(373,197,1,0),(374,198,1,0),(375,199,1,0),(376,200,1,0),(377,201,1,0),(378,202,1,0),(379,187,1,0),(380,188,1,0),(381,189,1,0),(382,190,1,0),(383,191,1,0),(384,192,1,0),(385,193,1,0),(386,194,1,0),(387,179,1,0),(388,180,1,0),(389,181,1,0),(390,182,1,0),(391,183,1,0),(392,184,1,0),(393,185,1,0),(394,186,1,0),(395,171,1,0),(396,172,1,0),(397,173,1,0),(398,174,1,0),(399,175,1,0),(400,176,1,0),(401,177,1,0),(402,178,1,0),(403,163,1,0),(404,164,1,0),(405,165,1,0),(406,166,1,0),(407,167,1,0),(408,168,1,0),(409,169,1,0),(410,170,1,0),(411,155,1,0),(412,156,1,0),(413,157,1,0),(414,158,1,0),(415,159,1,0),(416,160,1,0),(417,161,1,0),(418,162,1,0),(419,147,1,0),(420,148,1,0),(421,149,1,0),(422,150,1,0),(423,151,1,0),(424,152,1,0),(425,153,1,0),(426,154,1,0),(427,139,1,0),(428,140,1,0),(429,141,1,0),(430,142,1,0),(431,143,1,0),(432,144,1,0),(433,145,1,0),(434,146,1,0),(435,131,1,0),(436,132,1,0),(437,133,1,0),(438,134,1,0),(439,135,1,0),(440,136,1,0),(441,137,1,0),(442,138,1,0),(443,123,1,0),(444,124,1,0),(445,125,1,0),(446,126,1,0),(447,127,1,0),(448,128,1,0),(449,129,1,0),(450,130,1,0),(451,115,1,0),(452,116,1,0),(453,117,1,0),(454,118,1,0),(455,119,1,0),(456,120,1,0),(457,121,1,0),(458,122,1,0),(459,107,1,0),(460,108,1,0),(461,109,1,0),(462,110,1,0),(463,111,1,0),(464,112,1,0),(465,113,1,0),(466,114,1,0),(467,99,1,0),(468,100,1,0),(469,101,1,0),(470,102,1,0),(471,103,1,0),(472,104,1,0),(473,105,1,0),(474,106,1,0),(475,91,1,0),(476,92,1,0),(477,93,1,0),(478,94,1,0),(479,95,1,0),(480,96,1,0),(481,97,1,0),(482,98,1,0),(483,83,1,0),(484,84,1,0),(485,85,1,0),(486,86,1,0),(487,87,1,0),(488,88,1,0),(489,89,1,0),(490,90,1,0),(491,51,1,0),(492,52,1,0);

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
