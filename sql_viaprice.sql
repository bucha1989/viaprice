
CREATE TABLE `load_convert` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ind_load` int(3) DEFAULT NULL,
  `value_load` int(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=utf8;


INSERT INTO `load_convert` VALUES ('186', '65', '290');
INSERT INTO `load_convert` VALUES ('187', '66', '300');
INSERT INTO `load_convert` VALUES ('188', '67', '307');
INSERT INTO `load_convert` VALUES ('189', '68', '315');
INSERT INTO `load_convert` VALUES ('190', '69', '325');
INSERT INTO `load_convert` VALUES ('191', '70', '335');
INSERT INTO `load_convert` VALUES ('192', '71', '345');
INSERT INTO `load_convert` VALUES ('193', '72', '355');
INSERT INTO `load_convert` VALUES ('194', '73', '365');
INSERT INTO `load_convert` VALUES ('195', '74', '375');
INSERT INTO `load_convert` VALUES ('196', '75', '387');
INSERT INTO `load_convert` VALUES ('197', '76', '400');
INSERT INTO `load_convert` VALUES ('198', '77', '412');
INSERT INTO `load_convert` VALUES ('199', '78', '425');
INSERT INTO `load_convert` VALUES ('200', '79', '437');
INSERT INTO `load_convert` VALUES ('201', '80', '450');
INSERT INTO `load_convert` VALUES ('202', '81', '462');
INSERT INTO `load_convert` VALUES ('203', '82', '475');
INSERT INTO `load_convert` VALUES ('204', '83', '487');
INSERT INTO `load_convert` VALUES ('205', '84', '500');
INSERT INTO `load_convert` VALUES ('206', '85', '515');
INSERT INTO `load_convert` VALUES ('207', '86', '530');
INSERT INTO `load_convert` VALUES ('208', '87', '545');
INSERT INTO `load_convert` VALUES ('209', '88', '560');
INSERT INTO `load_convert` VALUES ('210', '89', '580');
INSERT INTO `load_convert` VALUES ('211', '90', '600');
INSERT INTO `load_convert` VALUES ('212', '91', '615');
INSERT INTO `load_convert` VALUES ('213', '92', '630');
INSERT INTO `load_convert` VALUES ('214', '93', '650');
INSERT INTO `load_convert` VALUES ('215', '94', '670');
INSERT INTO `load_convert` VALUES ('216', '95', '690');
INSERT INTO `load_convert` VALUES ('217', '96', '710');
INSERT INTO `load_convert` VALUES ('218', '97', '730');
INSERT INTO `load_convert` VALUES ('219', '98', '750');
INSERT INTO `load_convert` VALUES ('220', '99', '775');
INSERT INTO `load_convert` VALUES ('221', '100', '800');
INSERT INTO `load_convert` VALUES ('222', '101', '825');
INSERT INTO `load_convert` VALUES ('223', '102', '850');
INSERT INTO `load_convert` VALUES ('224', '103', '875');
INSERT INTO `load_convert` VALUES ('225', '104', '900');
INSERT INTO `load_convert` VALUES ('226', '105', '925');
INSERT INTO `load_convert` VALUES ('227', '106', '950');
INSERT INTO `load_convert` VALUES ('228', '107', '975');
INSERT INTO `load_convert` VALUES ('229', '108', '1000');
INSERT INTO `load_convert` VALUES ('230', '109', '1030');
INSERT INTO `load_convert` VALUES ('231', '110', '1060');
INSERT INTO `load_convert` VALUES ('232', '111', '1090');
INSERT INTO `load_convert` VALUES ('233', '112', '1120');
INSERT INTO `load_convert` VALUES ('234', '113', '1150');
INSERT INTO `load_convert` VALUES ('235', '114', '1180');
INSERT INTO `load_convert` VALUES ('236', '115', '1215');
INSERT INTO `load_convert` VALUES ('237', '116', '1250');
INSERT INTO `load_convert` VALUES ('238', '117', '1285');
INSERT INTO `load_convert` VALUES ('239', '118', '1320');
INSERT INTO `load_convert` VALUES ('240', '119', '1360');
INSERT INTO `load_convert` VALUES ('241', '120', '1400');
INSERT INTO `load_convert` VALUES ('242', '121', '1450');
INSERT INTO `load_convert` VALUES ('243', '122', '1500');
INSERT INTO `load_convert` VALUES ('244', '123', '1550');
INSERT INTO `load_convert` VALUES ('245', '124', '1600');
INSERT INTO `load_convert` VALUES ('246', '125', '1650');

CREATE TABLE `speed_convert` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `ind_speed` varchar(2) DEFAULT NULL,
  `value_speed` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


INSERT INTO `speed_convert` VALUES ('1', 'Q', '160');
INSERT INTO `speed_convert` VALUES ('2', 'R', '170');
INSERT INTO `speed_convert` VALUES ('3', 'S', '180');
INSERT INTO `speed_convert` VALUES ('4', 'T', '190');
INSERT INTO `speed_convert` VALUES ('5', 'H', '210');
INSERT INTO `speed_convert` VALUES ('6', 'V', '240');
INSERT INTO `speed_convert` VALUES ('7', 'W', '270');
INSERT INTO `speed_convert` VALUES ('8', 'Y', '300');
INSERT INTO `speed_convert` VALUES ('9', 'ZR', '>240');
INSERT INTO `speed_convert` VALUES ('10', 'M', '130');
INSERT INTO `speed_convert` VALUES ('11', 'N', '140');
INSERT INTO `speed_convert` VALUES ('12', 'P', '150');
INSERT INTO `speed_convert` VALUES ('13', 'VR', '<210');
INSERT INTO `speed_convert` VALUES ('14', 'J', '100');
INSERT INTO `speed_convert` VALUES ('15', 'K', '110');
INSERT INTO `speed_convert` VALUES ('16', 'L', '120');


CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `private` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


