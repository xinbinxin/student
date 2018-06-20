/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : hou

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-25 19:19:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `grade`
-- ----------------------------
DROP TABLE IF EXISTS `grade`;
CREATE TABLE `grade` (
  `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of grade
-- ----------------------------
INSERT INTO `grade` VALUES ('1', '52期');
INSERT INTO `grade` VALUES ('2', '83期');
INSERT INTO `grade` VALUES ('3', '85期');

-- ----------------------------
-- Table structure for `stu`
-- ----------------------------
DROP TABLE IF EXISTS `stu`;
CREATE TABLE `stu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `sex` enum('女','男') NOT NULL DEFAULT '男',
  `hobby` set('乒乓球','足球','篮球') NOT NULL DEFAULT '篮球',
  `gid` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stu
-- ----------------------------
INSERT INTO `stu` VALUES ('10', '刘佳', '2019-05-29', '女', '足球,篮球', '3');
INSERT INTO `stu` VALUES ('9', '张龙', '2018-05-10', '男', '乒乓球', '2');
INSERT INTO `stu` VALUES ('11', '张姐', '2018-05-24', '女', '足球,篮球', '3');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(5) NOT NULL,
  `password` char(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '7fef6171469e80d32c0559f88b377245');
