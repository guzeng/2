
/*Table structure for table `yx_account` */

DROP TABLE IF EXISTS `yx_account`;

CREATE TABLE `yx_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `pwd` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `phone` int(11) NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `gender` enum('male','female') NOT NULL DEFAULT 'male',
  `create_time` int(10) NOT NULL DEFAULT '0',
  `last_login` int(10) NOT NULL DEFAULT '0',
  `login_num` int(11) NOT NULL DEFAULT '0' COMMENT '登录次数',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1,admin;0,user',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0，锁定（禁止登录）',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `yx_account` */

insert  into `yx_account`(`id`,`username`,`pwd`,`email`,`phone`,`name`,`gender`,`create_time`,`last_login`,`login_num`,`type`,`active`) values (1,'admin','$2y$10$BhVLXBh4xldLbFvX7EjMGORs9XkUPdFkDDGEgbRIRa5ss1edbMxNO','',0,'管理员','male',0,1408091405,7,1,1);

/*Table structure for table `yx_airport` */

DROP TABLE IF EXISTS `yx_airport`;

CREATE TABLE `yx_airport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `yx_airport` */

/*Table structure for table `yx_city` */

DROP TABLE IF EXISTS `yx_city`;

CREATE TABLE `yx_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `code` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `yx_city` */

/*Table structure for table `yx_log` */

DROP TABLE IF EXISTS `yx_log`;

CREATE TABLE `yx_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增主键ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `time` int(10) NOT NULL DEFAULT '0' COMMENT '操作时间',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '类型',
  `object_type` varchar(30) NOT NULL DEFAULT '' COMMENT '操作对象',
  `object_id` int(11) NOT NULL DEFAULT '0' COMMENT '对象ID',
  `object_name` varchar(100) NOT NULL DEFAULT '' COMMENT '对象名称',
  `message` text NOT NULL COMMENT '操作内容',
  `ip` varchar(15) NOT NULL COMMENT '操作者IP',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type`,`object_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='操作日志表';

/*Table structure for table `yx_news` */

DROP TABLE IF EXISTS `yx_news`;

CREATE TABLE `yx_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1发布',
  `create_by` int(11) NOT NULL DEFAULT '0' COMMENT '创建人ID',
  `open_time` int(11) NOT NULL DEFAULT '0' COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='资讯表';

/*Data for the table `yx_news` */

/*Table structure for table `yx_order` */

DROP TABLE IF EXISTS `yx_order`;

CREATE TABLE `yx_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(20) NOT NULL COMMENT '订单号',
  `flight_num` varchar(6) NOT NULL COMMENT '航班号',
  `type` tinyint(3) NOT NULL COMMENT '1,机场到目的地；2，到机场',
  `time` int(10) NOT NULL DEFAULT '0' COMMENT '托运时间',
  `city_id` int(11) NOT NULL DEFAULT '0' COMMENT '托运地点，城市',
  `address` varchar(200) NOT NULL COMMENT '地址',
  `airport_id` int(11) NOT NULL DEFAULT '0' COMMENT '机场',
  `normal_luggage_num` int(10) NOT NULL DEFAULT '0' COMMENT '普通行李数',
  `special_luggage_num` int(10) NOT NULL DEFAULT '0' COMMENT '特殊行李数',
  `shipper` varchar(50) NOT NULL COMMENT '托运人',
  `gender` enum('male','female') NOT NULL DEFAULT 'male' COMMENT '性别',
  `phone` int(11) NOT NULL COMMENT '手机',
  `create_time` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `distance` int(11) NOT NULL DEFAULT '0' COMMENT '距离',
  `money` float NOT NULL DEFAULT '0' COMMENT '金额',
  `pay` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否已付款',
  `pay_time` int(10) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_code` varchar(50) NOT NULL COMMENT '支付单号',
  `pay_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1,支付宝；2，银联',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `yx_order` */

/*Table structure for table `yx_setting` */

DROP TABLE IF EXISTS `yx_setting`;

CREATE TABLE `yx_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable` varchar(50) NOT NULL DEFAULT '' COMMENT '变量名',
  `value` text COMMENT '变量值',
  `value_en` text COMMENT '变量值(english)',
  `comment` varchar(50) NOT NULL DEFAULT '' COMMENT '说明',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='系统设置';

/*Data for the table `yx_setting` */

insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (1,'website_title','asdf4567',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (2,'website_keyword','asdf4674',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (3,'website_description','asdfa45674',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (4,'copyright','sdfas674',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (5,'phone','asdf4567',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (6,'icp','dfasdf467',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (7,'address','asdfa467',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (8,'post','asdfasdf4567',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (9,'email','467@345.ff',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (10,'hotline','asdf467',NULL,'');
insert  into `yx_setting`(`id`,`variable`,`value`,`value_en`,`comment`) values (11,'website_name','sdfa4567',NULL,'');

/*Table structure for table `yx_user_login` */

DROP TABLE IF EXISTS `yx_user_login`;

CREATE TABLE `yx_user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `login_time` int(10) NOT NULL DEFAULT '0' COMMENT '登录时间',
  `out_time` int(10) NOT NULL DEFAULT '0' COMMENT '登出时间',
  `ip` varchar(20) NOT NULL DEFAULT '' COMMENT 'IP',
  `brower` varchar(50) NOT NULL DEFAULT '' COMMENT '浏览器类型',
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`,`ip`),
  KEY `login_time` (`login_time`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='用户登录记录表';


/*Table structure for table `yx_validation` */

DROP TABLE IF EXISTS `yx_validation`;

CREATE TABLE `yx_validation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `create_time` int(10) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
