#
# TABLE STRUCTURE FOR: cc_action
#

DROP TABLE IF EXISTS `cc_action`;

CREATE TABLE `cc_action` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(12) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表';

INSERT INTO `cc_action` (`id`, `name`, `title`, `status`) VALUES ('1', 'user_login', '用户登录', '1');
INSERT INTO `cc_action` (`id`, `name`, `title`, `status`) VALUES ('2', 'role_add', '添加角色', '1');
INSERT INTO `cc_action` (`id`, `name`, `title`, `status`) VALUES ('3', 'menu_add', '添加节点', '0');


#
# TABLE STRUCTURE FOR: cc_action_log
#

DROP TABLE IF EXISTS `cc_action_log`;

CREATE TABLE `cc_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `ip` varchar(16) NOT NULL COMMENT '执行行为者ip',
  `remark` varchar(32) NOT NULL DEFAULT '' COMMENT '日志备注',
  `time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`ip`) USING BTREE,
  KEY `action_id_ix` (`action_id`) USING BTREE,
  KEY `user_id_ix` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('6', '2', '1', '127.0.0.1', '添加角色', '1440213489');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('7', '1', '1', '127.0.0.1', '用户登录', '1440213519');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('8', '1', '1', '127.0.0.1', '用户登录', '1440225248');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('9', '1', '2', '127.0.0.1', '用户登录', '1440228468');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('10', '1', '1', '127.0.0.1', '用户登录', '1440229152');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('11', '2', '1', '127.0.0.1', '添加角色', '1440234965');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('12', '1', '1', '127.0.0.1', '用户登录', '1440400505');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('13', '1', '1', '127.0.0.1', '用户登录', '1440465745');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('14', '1', '1', '127.0.0.1', '用户登录', '1440490725');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('15', '1', '1', '127.0.0.1', '用户登录', '1440492749');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('16', '1', '1', '127.0.0.1', '用户登录', '1440493009');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('17', '1', '1', '127.0.0.1', '用户登录', '1440493537');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('18', '1', '1', '127.0.0.1', '用户登录', '1440550636');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('19', '2', '1', '127.0.0.1', '添加角色', '1440551319');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('20', '2', '1', '127.0.0.1', '添加角色', '1440551408');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('21', '1', '1', '127.0.0.1', '用户登录', '1440574227');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('22', '1', '1', '127.0.0.1', '用户登录', '1440576924');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('23', '1', '1', '127.0.0.1', '用户登录', '1440636639');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('24', '1', '1', '127.0.0.1', '用户登录', '1440661829');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('25', '2', '1', '127.0.0.1', '添加角色', '1440662223');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('26', '1', '1', '127.0.0.1', '用户登录', '1440727281');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('27', '1', '1', '127.0.0.1', '用户登录', '1440738640');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('28', '1', '1', '127.0.0.1', '用户登录', '1440751345');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('29', '1', '1', '127.0.0.1', '用户登录', '1440751500');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('30', '1', '1', '127.0.0.1', '用户登录', '1440752200');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('31', '1', '1', '127.0.0.1', '用户登录', '1440753248');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('32', '1', '1', '127.0.0.1', '用户登录', '1440753424');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('33', '1', '1', '127.0.0.1', '用户登录', '1440753789');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('34', '1', '2', '127.0.0.1', '用户登录', '1440754769');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('35', '1', '2', '127.0.0.1', '用户登录', '1440754919');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('36', '1', '1', '127.0.0.1', '用户登录', '1440810691');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('37', '1', '1', '127.0.0.1', '用户登录', '1440810895');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('38', '1', '2', '127.0.0.1', '用户登录', '1440811480');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('39', '1', '1', '127.0.0.1', '用户登录', '1440811491');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('40', '1', '2', '127.0.0.1', '用户登录', '1440812105');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('42', '1', '1', '::1', '用户登录', '1476084099');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('43', '1', '1', '::1', '用户登录', '1476146155');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('44', '1', '1', '::1', '用户登录', '1476166663');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('45', '1', '1', '::1', '用户登录', '1476232687');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('46', '1', '1', '::1', '用户登录', '1476232744');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('47', '1', '1', '222.87.166.55', '用户登录', '1476234926');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('48', '1', '1', '::1', '用户登录', '1476242358');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('49', '1', '1', '222.87.166.55', '用户登录', '1476242663');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('50', '1', '1', '::1', '用户登录', '1476254120');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('51', '1', '1', '::1', '用户登录', '1476256784');
INSERT INTO `cc_action_log` (`id`, `action_id`, `user_id`, `ip`, `remark`, `time`) VALUES ('52', '1', '1', '::1', '用户登录', '1476261365');


#
# TABLE STRUCTURE FOR: cc_member
#

DROP TABLE IF EXISTS `cc_member`;

CREATE TABLE `cc_member` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '微信用户名',
  `phone` varchar(13) NOT NULL COMMENT '手机',
  `address` varchar(250) NOT NULL COMMENT '地址',
  `creattime` int(11) NOT NULL COMMENT '创建时间(首次关注时间)',
  `logintime` int(11) NOT NULL COMMENT '登录时间',
  `usertype` int(1) NOT NULL COMMENT '0.普通会员，1开店商家',
  `score` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `cost` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '账号余额',
  `loginip` varchar(30) DEFAULT NULL COMMENT '登录ip',
  `logo` varchar(255) DEFAULT NULL COMMENT '头像地址',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0 禁止 1 可用',
  `safepwd` varchar(100) DEFAULT NULL COMMENT '支付密码',
  `group` int(2) DEFAULT '5',
  `is_bang` int(1) NOT NULL DEFAULT '0' COMMENT '是否绑定',
  `parent_id` int(20) DEFAULT '0',
  `total` int(6) DEFAULT '0',
  `admin_id` int(20) NOT NULL DEFAULT '0',
  `sex` int(11) NOT NULL COMMENT '性别',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户信息表';

INSERT INTO `cc_member` (`uid`, `password`, `email`, `username`, `phone`, `address`, `creattime`, `logintime`, `usertype`, `score`, `cost`, `loginip`, `logo`, `status`, `safepwd`, `group`, `is_bang`, `parent_id`, `total`, `admin_id`, `sex`) VALUES ('1', 'f988ffa08ace86bccd42c46dc06fed93', '', 'oyFX8vkqg7N-yl0b2mSKnx6XwVkY', '', '', '1472657439', '1472657439', '0', '0', '0.00', '', '', '1', NULL, '10', '0', '0', '0', '0', '0');


#
# TABLE STRUCTURE FOR: cc_menu
#

DROP TABLE IF EXISTS `cc_menu`;

CREATE TABLE `cc_menu` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) NOT NULL,
  `url` varchar(32) NOT NULL,
  `title` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('1', '0', '0', '用户管理');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('2', '1', 'user/index', '用户列表');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('3', '1', 'user/add', '添加用户');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('4', '0', '0', '角色管理');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('5', '4', 'role/index', '角色列表');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('6', '4', 'role/add', '添加角色');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('7', '0', '0', '节点管理');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('8', '7', 'menu/index', '节点列表');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('9', '7', 'menu/add', '添加节点');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('10', '0', '0', '行为管理');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('11', '10', 'action/index', '行为列表');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('12', '10', 'action/add', '添加行为');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('13', '1', 'user/action', '用户行为');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('14', '0', '0', '系统管理');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('15', '14', 'system/clear', '更新缓存');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('16', '0', '0', '微信管理');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('17', '16', 'wx/wxset', '微信基础设置');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('18', '16', 'wx/wxmenu', '微信菜单');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('19', '16', 'wx/wxback', '微信自动回复');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('20', '16', 'wx/wxuser', '微信用户');
INSERT INTO `cc_menu` (`id`, `pid`, `url`, `title`) VALUES ('22', '14', 'system/dbback', '数据库备份');


#
# TABLE STRUCTURE FOR: cc_role
#

DROP TABLE IF EXISTS `cc_role`;

CREATE TABLE `cc_role` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) NOT NULL,
  `action_list` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `cc_role` (`id`, `role_name`, `action_list`) VALUES ('1', '管理', '2,3');
INSERT INTO `cc_role` (`id`, `role_name`, `action_list`) VALUES ('2', '编辑', '2,5,8,15');
INSERT INTO `cc_role` (`id`, `role_name`, `action_list`) VALUES ('3', '财务', '2,3');
INSERT INTO `cc_role` (`id`, `role_name`, `action_list`) VALUES ('4', '测试', '');


#
# TABLE STRUCTURE FOR: cc_user
#

DROP TABLE IF EXISTS `cc_user`;

CREATE TABLE `cc_user` (
  `uid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `head` varchar(64) DEFAULT NULL,
  `role_id` smallint(5) NOT NULL DEFAULT '4',
  `add_time` int(10) NOT NULL,
  `salt` char(10) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `cc_user` (`uid`, `username`, `password`, `head`, `role_id`, `add_time`, `salt`) VALUES ('1', 'admin', '3fea2f5bd220276042d2f27864711ecaf5858da3', 'upload_pic/thumbnail_1440812092.jpg', '0', '1438878226', 'a6dc1febba');
INSERT INTO `cc_user` (`uid`, `username`, `password`, `head`, `role_id`, `add_time`, `salt`) VALUES ('2', 'jason', '3fea2f5bd220276042d2f27864711ecaf5858da3', 'upload_pic/thumbnail_1440812120.jpg', '1', '1438878226', 'a6dc1febba');
INSERT INTO `cc_user` (`uid`, `username`, `password`, `head`, `role_id`, `add_time`, `salt`) VALUES ('4', 'tom', '3fea2f5bd220276042d2f27864711ecaf5858da3', '', '2', '1438941470', 'a6dc1febba');
INSERT INTO `cc_user` (`uid`, `username`, `password`, `head`, `role_id`, `add_time`, `salt`) VALUES ('5', 'tom2', '3fea2f5bd220276042d2f27864711ecaf5858da3', '', '3', '1438941503', 'a6dc1febba');
INSERT INTO `cc_user` (`uid`, `username`, `password`, `head`, `role_id`, `add_time`, `salt`) VALUES ('6', 'tom3', '3fea2f5bd220276042d2f27864711ecaf5858da3', '', '4', '1438941575', 'a6dc1febba');
INSERT INTO `cc_user` (`uid`, `username`, `password`, `head`, `role_id`, `add_time`, `salt`) VALUES ('7', 'tom4', '3fea2f5bd220276042d2f27864711ecaf5858da3', '', '4', '1438941655', 'a6dc1febba');
INSERT INTO `cc_user` (`uid`, `username`, `password`, `head`, `role_id`, `add_time`, `salt`) VALUES ('9', 'haha', '3fea2f5bd220276042d2f27864711ecaf5858da3', '', '4', '1439020217', 'a6dc1febba');


#
# TABLE STRUCTURE FOR: cc_wxback
#

DROP TABLE IF EXISTS `cc_wxback`;

CREATE TABLE `cc_wxback` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `msgtype` int(1) NOT NULL DEFAULT '1',
  `values` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO `cc_wxback` (`id`, `code`, `msgtype`, `values`) VALUES ('1', 'testzzw', '1', 'a:2:{s:8:\"lj_title\";s:15:\"迈乐保测试\";s:7:\"lj_link\";s:20:\"http://www.gchoo.cn/\";}');
INSERT INTO `cc_wxback` (`id`, `code`, `msgtype`, `values`) VALUES ('8', 'test123', '2', 'test123');
INSERT INTO `cc_wxback` (`id`, `code`, `msgtype`, `values`) VALUES ('3', 'zzwtest', '1', 'a:2:{s:8:\"lj_title\";s:18:\"周伟本地测试\";s:7:\"lj_link\";s:20:\"http://192.168.31.22\";}');
INSERT INTO `cc_wxback` (`id`, `code`, `msgtype`, `values`) VALUES ('4', 'testmlb', '1', 'a:2:{s:8:\"lj_title\";s:51:\"迈乐保商城正在测试中，点击进行测试\";s:7:\"lj_link\";s:62:\"http://www.qxnmlb.com?openid=oOwuWwwom_8GBe08x-547pH2U8jA-test\";}');
INSERT INTO `cc_wxback` (`id`, `code`, `msgtype`, `values`) VALUES ('5', 'bxzx', '2', '欢迎您使用迈乐保平台\n中国人民保险: 95518\n中国平安保险: 95500\n太平洋保险: 95510\n祝您平安！【迈乐保商城】');
INSERT INTO `cc_wxback` (`id`, `code`, `msgtype`, `values`) VALUES ('6', 'dd', '2', 'dddd');


#
# TABLE STRUCTURE FOR: cc_wxmenu
#

DROP TABLE IF EXISTS `cc_wxmenu`;

CREATE TABLE `cc_wxmenu` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL COMMENT 'view表示连接，click事件',
  `name` varchar(255) NOT NULL COMMENT 'an钮事件名称',
  `values` text COMMENT '当type为view时跳转连接，当click为则为内容',
  `parent_id` int(20) NOT NULL DEFAULT '0' COMMENT '0一级菜单',
  `sort` int(3) NOT NULL,
  `msgtype` int(1) NOT NULL DEFAULT '0' COMMENT '0:连接1文本2图文',
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='微信菜单表';

INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('1', 'view', '商城首页', 'a:2:{s:7:\"lj_link\";s:21:\"http://www.qxnmlb.com\";s:8:\"lj_title\";s:12:\"商城首页\";}', '0', '11', '0', 'index');
INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('2', 'view', '热门分类', NULL, '0', '12', '0', 'group');
INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('3', 'view', '酒类', 'a:2:{s:7:\"lj_link\";s:49:\"http://www.qxnmlb.com/mlbshop/grouplist/groupid/1\";s:8:\"lj_title\";s:6:\"酒类\";}', '2', '0', '0', 'wine');
INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('4', 'view', '汽车用品', 'a:2:{s:7:\"lj_link\";s:49:\"http://www.qxnmlb.com/mlbshop/grouplist/groupid/6\";s:8:\"lj_title\";s:12:\"汽车用品\";}', '2', '1', '0', 'car');
INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('8', 'click', '我的服务', NULL, '0', '10', '1', 'help');
INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('9', 'view', '保险公司', 'a:2:{s:7:\"lj_link\";s:45:\"http://www.qxnmlb.com/mlbshop/company/comid/0\";s:8:\"lj_title\";s:12:\"保险公司\";}', '8', '0', '0', 'gs');
INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('12', 'view', '我的保单', 'a:2:{s:7:\"lj_link\";s:39:\"http://www.qxnmlb.com/insure/insurelist\";s:8:\"lj_title\";s:12:\"我的保单\";}', '8', '3', '0', 'insure');
INSERT INTO `cc_wxmenu` (`id`, `type`, `name`, `values`, `parent_id`, `sort`, `msgtype`, `code`) VALUES ('13', 'click', '客服电话', '客服电话08598886666\n感谢您的关注，祝您生活愉快！【迈乐保商城】', '8', '4', '1', 'tel');


#
# TABLE STRUCTURE FOR: cc_wxset
#

DROP TABLE IF EXISTS `cc_wxset`;

CREATE TABLE `cc_wxset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `appid` varchar(100) NOT NULL,
  `appsecret` varchar(100) NOT NULL,
  `autime` int(11) NOT NULL DEFAULT '0',
  `aucount` int(11) NOT NULL DEFAULT '0',
  `wx_time` int(11) NOT NULL DEFAULT '0',
  `ticket` varchar(255) NOT NULL DEFAULT '',
  `wcx_time` int(11) NOT NULL DEFAULT '0',
  `access_token` varchar(1000) NOT NULL DEFAULT '',
  `atendtime` int(11) NOT NULL DEFAULT '0' COMMENT 'access_token结束时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `cc_wxset` (`id`, `token`, `appid`, `appsecret`, `autime`, `aucount`, `wx_time`, `ticket`, `wcx_time`, `access_token`, `atendtime`) VALUES ('1', 'qwert', 'wxf77b7d6ea535b038', 'cfb45f2cce36d19a3bc42ca53d8817d8', '0', '0', '0', '', '0', 'wbnJPr6AP7yZqHWnEBUgs9FmDdBMvadhELU8iNPViJQrsZpDzNqQRUDhgIshvBTC6lMf1l6MGDyC0wfO0BbAae_iGj3NOgOvyLXmynvkqKURDGZ_U2SiMX0h6BaCRaCHEYXbABANHG', '1476261140');


#
# TABLE STRUCTURE FOR: cc_wxuser
#

DROP TABLE IF EXISTS `cc_wxuser`;

CREATE TABLE `cc_wxuser` (
  `openid` varchar(255) NOT NULL,
  `uid` int(20) NOT NULL,
  `is_bang` int(1) NOT NULL DEFAULT '0',
  `wxlat` varchar(255) DEFAULT NULL,
  `wxlng` varchar(255) DEFAULT NULL,
  `access_token` varchar(100) DEFAULT NULL,
  `expires_in` int(12) DEFAULT NULL,
  `refresh_token` varchar(255) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cc_wxuser` (`openid`, `uid`, `is_bang`, `wxlat`, `wxlng`, `access_token`, `expires_in`, `refresh_token`, `add_date`) VALUES ('oyFX8vkqg7N-yl0b2mSKnx6XwVkY', '1', '1', NULL, NULL, '', '0', '', '2016-08-31 23:30:39');


