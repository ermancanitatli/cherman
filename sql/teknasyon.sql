/*
 Navicat Premium Data Transfer

 Source Server         : 172.23.0.4
 Source Server Type    : MySQL
 Source Server Version : 100412
 Source Host           : 127.0.0.1:3306
 Source Schema         : teknasyon

 Target Server Type    : MySQL
 Target Server Version : 100412
 File Encoding         : 65001

 Date: 05/02/2020 13:48:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cities
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities`  (
  `city_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_code` char(3) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`city_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- ----------------------------
-- Records of cities
-- ----------------------------
BEGIN;
INSERT INTO `cities` VALUES (1, 'TR', 'Bursa', '2020-02-05 02:53:38', '2020-02-05 02:53:38'), (2, 'TR', 'Bayburt', '2020-02-05 02:53:49', '2020-02-05 02:53:49'), (3, 'TR', 'Ankara', '2020-02-05 02:54:08', '2020-02-05 02:56:45');
COMMIT;

-- ----------------------------
-- Table structure for gift_code
-- ----------------------------
DROP TABLE IF EXISTS `gift_code`;
CREATE TABLE `gift_code`  (
  `gift_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `user_id` int(8) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`gift_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- ----------------------------
-- Records of gift_code
-- ----------------------------
BEGIN;
INSERT INTO `gift_code` VALUES (1, '123123', 3, '2020-02-05 03:02:11', '2020-02-05 04:20:34'), (6, '1111', 8, NULL, '2020-02-05 05:14:54');
COMMIT;

-- ----------------------------
-- Table structure for premium_status
-- ----------------------------
DROP TABLE IF EXISTS `premium_status`;
CREATE TABLE `premium_status`  (
  `premium_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`premium_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- ----------------------------
-- Records of premium_status
-- ----------------------------
BEGIN;
INSERT INTO `premium_status` VALUES (10, 8, 1, '2020-02-05 10:14:08', NULL);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `lang` char(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `notification_token` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `city_id` int(10) NULL DEFAULT NULL,
  `timezone` tinyint(8) NULL DEFAULT 0,
  `os_type` tinyint(2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` VALUES (1, 'TR', 'ASD', 'ASASD', 'ASDAS', 1, 0, NULL, '2020-02-05 09:48:27', '2020-02-05 09:48:33'), (2, NULL, NULL, NULL, NULL, 1, 0, NULL, '2020-02-05 09:49:45', '2020-02-05 09:49:45'), (3, 'tr', NULL, NULL, NULL, NULL, 0, NULL, '2020-02-05 09:53:28', '2020-02-05 09:53:28'), (4, 'tr', NULL, NULL, NULL, NULL, 0, NULL, '2020-02-05 09:53:45', '2020-02-05 09:53:45'), (5, NULL, NULL, NULL, 'erman', NULL, 0, NULL, '2020-02-05 10:09:57', '2020-02-05 10:09:57'), (6, NULL, NULL, NULL, 'asdasasdasd', NULL, 0, NULL, '2020-02-05 10:10:25', '2020-02-05 10:10:25'), (7, NULL, NULL, NULL, '249abf8d13b89afe5c38404c68bf04a1', NULL, 0, NULL, '2020-02-05 10:10:55', '2020-02-05 10:10:55'), (8, 'FR', '1DSADASD111', 'ermancanitatli@gmail.com', NULL, 5, 3, 1, NULL, NULL);
COMMIT;

-- ----------------------------
-- Table structure for weather
-- ----------------------------
DROP TABLE IF EXISTS `weather`;
CREATE TABLE `weather`  (
  `weather_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `precipitation` double NOT NULL,
  `moisture` double NOT NULL,
  `wind` double NOT NULL,
  `temperature` double NOT NULL,
  `date` datetime(0) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_at` timestamp(0) NULL DEFAULT current_timestamp(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`weather_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- ----------------------------
-- Records of weather
-- ----------------------------
BEGIN;
INSERT INTO `weather` VALUES (1, 1, 12.3, 13.4, 14, 15, '2020-02-05 05:58:08', '2020-02-05 02:58:12', '2020-02-05 02:58:12'), (2, 1, 12, 12.4, 12, 11, '2020-02-04 05:58:08', '2020-02-05 02:58:12', '2020-02-05 02:58:12');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
