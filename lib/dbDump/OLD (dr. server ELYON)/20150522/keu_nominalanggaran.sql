/*
Navicat MySQL Data Transfer

Source Server         : lumba2
Source Server Version : 50616
Source Host           : 127.0.0.1:3306
Source Database       : sister_siadu

Target Server Type    : MYSQL
Target Server Version : 50616
File Encoding         : 65001

Date: 2015-05-26 12:08:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for keu_nominalanggaran
-- ----------------------------
DROP TABLE IF EXISTS `keu_nominalanggaran`;
CREATE TABLE `keu_nominalanggaran` (
  `replid` int(10) NOT NULL AUTO_INCREMENT,
  `detilanggaran` int(10) NOT NULL,
  `bulan` int(2) NOT NULL,
  `nominal` double(14,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`replid`)
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of keu_nominalanggaran
-- ----------------------------
INSERT INTO `keu_nominalanggaran` VALUES ('203', '37', '1', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('204', '37', '2', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('205', '37', '3', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('206', '37', '4', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('207', '37', '5', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('208', '37', '6', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('209', '37', '7', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('210', '37', '8', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('211', '37', '9', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('212', '37', '10', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('213', '37', '11', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('214', '37', '12', '10000000000');
INSERT INTO `keu_nominalanggaran` VALUES ('231', '39', '1', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('232', '39', '2', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('233', '39', '3', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('234', '39', '4', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('235', '39', '5', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('236', '39', '6', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('237', '39', '7', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('238', '39', '8', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('239', '39', '9', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('240', '39', '10', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('241', '39', '11', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('242', '39', '12', '46250');
INSERT INTO `keu_nominalanggaran` VALUES ('243', '40', '1', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('244', '40', '2', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('245', '40', '3', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('246', '40', '4', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('247', '40', '5', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('248', '40', '6', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('249', '40', '7', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('250', '40', '8', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('251', '40', '9', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('252', '40', '10', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('253', '40', '11', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('254', '40', '12', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('255', '41', '1', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('256', '41', '2', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('257', '41', '3', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('258', '41', '4', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('259', '41', '5', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('260', '41', '6', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('261', '41', '7', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('262', '41', '8', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('263', '41', '9', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('264', '41', '10', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('265', '41', '11', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('266', '41', '12', '30000');
INSERT INTO `keu_nominalanggaran` VALUES ('267', '42', '1', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('268', '42', '2', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('269', '42', '3', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('270', '42', '4', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('271', '42', '5', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('272', '42', '6', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('273', '42', '7', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('274', '42', '8', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('275', '42', '9', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('276', '42', '10', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('277', '42', '11', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('278', '42', '12', '1000000');
INSERT INTO `keu_nominalanggaran` VALUES ('279', '43', '1', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('280', '43', '2', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('281', '43', '3', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('282', '43', '4', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('283', '43', '5', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('284', '43', '6', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('285', '43', '7', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('286', '43', '8', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('287', '43', '9', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('288', '43', '10', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('289', '43', '11', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('290', '43', '12', '20833333');
INSERT INTO `keu_nominalanggaran` VALUES ('291', '44', '1', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('292', '44', '2', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('293', '44', '3', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('294', '44', '4', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('295', '44', '5', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('296', '44', '6', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('297', '44', '7', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('298', '44', '8', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('299', '44', '9', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('300', '44', '10', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('301', '44', '11', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('302', '44', '12', '416667');
INSERT INTO `keu_nominalanggaran` VALUES ('303', '45', '1', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('304', '45', '2', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('305', '45', '3', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('306', '45', '4', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('307', '45', '5', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('308', '45', '6', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('309', '45', '7', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('310', '45', '8', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('311', '45', '9', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('312', '45', '10', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('313', '45', '11', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('314', '45', '12', '10000');
INSERT INTO `keu_nominalanggaran` VALUES ('315', '46', '1', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('316', '46', '2', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('317', '46', '3', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('318', '46', '4', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('319', '46', '5', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('320', '46', '6', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('321', '46', '7', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('322', '46', '8', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('323', '46', '9', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('324', '46', '10', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('325', '46', '11', '1250000');
INSERT INTO `keu_nominalanggaran` VALUES ('326', '46', '12', '1250000');
