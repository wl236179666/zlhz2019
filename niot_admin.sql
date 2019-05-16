/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50724
Source Host           : localhost:3306
Source Database       : niot_admin

Target Server Type    : MYSQL
Target Server Version : 50724
File Encoding         : 65001

Date: 2019-05-16 13:43:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for niot_articles
-- ----------------------------
DROP TABLE IF EXISTS `niot_articles`;
CREATE TABLE `niot_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(155) NOT NULL COMMENT '文章标题',
  `description` varchar(255) NOT NULL COMMENT '文章描述',
  `keywords` varchar(155) NOT NULL COMMENT '文章关键字',
  `thumbnail` varchar(255) NOT NULL COMMENT '文章缩略图',
  `content` text NOT NULL COMMENT '文章内容',
  `add_time` datetime NOT NULL COMMENT '发布时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of niot_articles
-- ----------------------------
INSERT INTO `niot_articles` VALUES ('2', '文章标题', '文章描述', '关键字1,关键字2,关键字3', '/upload/20170916/1e915c70dbb9d3e8a07bede7b64e4cff.png', '<p><img src=\"/upload/image/20170916/1505555254.png\" title=\"1505555254.png\" alt=\"QQ截图20170916174651.png\"/></p><p>测试文章内容</p><p>测试内容</p>', '2017-09-16 17:47:44');

-- ----------------------------
-- Table structure for niot_company_user
-- ----------------------------
DROP TABLE IF EXISTS `niot_company_user`;
CREATE TABLE `niot_company_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(35) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `pic` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '代理id',
  `check_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '审核状态  1未审核   2审核',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of niot_company_user
-- ----------------------------
INSERT INTO `niot_company_user` VALUES ('71', 'zhangjizhong111', '84386805f4fa719c7023544210fea50c', '1', '1557977755', '/static/admin/images/profile_small.jpg', '1', '1');

-- ----------------------------
-- Table structure for niot_node
-- ----------------------------
DROP TABLE IF EXISTS `niot_node`;
CREATE TABLE `niot_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `node_name` varchar(155) NOT NULL DEFAULT '' COMMENT '节点名称',
  `control_name` varchar(155) NOT NULL DEFAULT '' COMMENT '控制器名',
  `action_name` varchar(155) NOT NULL COMMENT '方法名',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是菜单项 1不是 2是',
  `type_id` int(11) NOT NULL COMMENT '父级节点id',
  `style` varchar(155) DEFAULT '' COMMENT '菜单样式',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of niot_node
-- ----------------------------
INSERT INTO `niot_node` VALUES ('1', '用户管理', '#', '#', '2', '0', 'fa fa-users');
INSERT INTO `niot_node` VALUES ('2', '管理员管理', 'user', 'index', '2', '1', '');
INSERT INTO `niot_node` VALUES ('3', '添加管理员', 'user', 'useradd', '1', '2', '');
INSERT INTO `niot_node` VALUES ('4', '编辑管理员', 'user', 'useredit', '1', '2', '');
INSERT INTO `niot_node` VALUES ('5', '删除管理员', 'user', 'userdel', '1', '2', '');
INSERT INTO `niot_node` VALUES ('6', '角色管理', 'role', 'index', '2', '1', '');
INSERT INTO `niot_node` VALUES ('7', '添加角色', 'role', 'roleadd', '1', '6', '');
INSERT INTO `niot_node` VALUES ('8', '编辑角色', 'role', 'roleedit', '1', '6', '');
INSERT INTO `niot_node` VALUES ('9', '删除角色', 'role', 'roledel', '1', '6', '');
INSERT INTO `niot_node` VALUES ('10', '分配权限', 'role', 'giveaccess', '1', '6', '');
INSERT INTO `niot_node` VALUES ('11', '系统管理', '#', '#', '2', '0', 'fa fa-desktop');
INSERT INTO `niot_node` VALUES ('12', '数据备份/还原', 'data', 'index', '2', '11', '');
INSERT INTO `niot_node` VALUES ('13', '备份数据', 'data', 'importdata', '1', '12', '');
INSERT INTO `niot_node` VALUES ('14', '还原数据', 'data', 'backdata', '1', '12', '');
INSERT INTO `niot_node` VALUES ('15', '节点管理', 'node', 'index', '2', '1', '');
INSERT INTO `niot_node` VALUES ('16', '添加节点', 'node', 'nodeadd', '1', '15', '');
INSERT INTO `niot_node` VALUES ('17', '编辑节点', 'node', 'nodeedit', '1', '15', '');
INSERT INTO `niot_node` VALUES ('18', '删除节点', 'node', 'nodedel', '1', '15', '');
INSERT INTO `niot_node` VALUES ('19', '文章管理', 'articles', 'index', '2', '0', 'fa fa-book');
INSERT INTO `niot_node` VALUES ('20', '文章列表', 'articles', 'index', '2', '19', '');
INSERT INTO `niot_node` VALUES ('21', '添加文章', 'articles', 'articleadd', '1', '19', '');
INSERT INTO `niot_node` VALUES ('22', '编辑文章', 'articles', 'articleedit', '1', '19', '');
INSERT INTO `niot_node` VALUES ('23', '删除文章', 'articles', 'articledel', '1', '19', '');
INSERT INTO `niot_node` VALUES ('24', '上传图片', 'articles', 'uploadImg', '1', '19', '');
INSERT INTO `niot_node` VALUES ('25', '个人中心', '#', '#', '1', '0', '');
INSERT INTO `niot_node` VALUES ('26', '编辑信息', 'profile', 'index', '1', '25', '');
INSERT INTO `niot_node` VALUES ('27', '编辑头像', 'profile', 'headedit', '1', '25', '');
INSERT INTO `niot_node` VALUES ('28', '上传头像', 'profile', 'uploadheade', '1', '25', '');
INSERT INTO `niot_node` VALUES ('29', '省级代理', '#', '#', '2', '0', 'fa fa-bars');
INSERT INTO `niot_node` VALUES ('30', '新增省代', 'pagents', 'addpagents', '2', '29', '');
INSERT INTO `niot_node` VALUES ('31', '省代列表', 'pagents', 'indexpagents', '2', '29', '');
INSERT INTO `niot_node` VALUES ('32', '编辑省代', 'pagents', 'updatepagents', '1', '29', '');
INSERT INTO `niot_node` VALUES ('33', '删除省代', 'pagents', 'delpagents', '1', '29', '');
INSERT INTO `niot_node` VALUES ('34', '市级代理', '#', '#', '2', '0', 'fa fa-bars');
INSERT INTO `niot_node` VALUES ('35', '新增市代', 'cagents', 'addcagents', '2', '34', '');
INSERT INTO `niot_node` VALUES ('36', '市代列表', 'cagents', 'indexcagents', '2', '34', '');
INSERT INTO `niot_node` VALUES ('37', '编辑市代', 'cagents', 'updatecagents', '1', '34', '');
INSERT INTO `niot_node` VALUES ('38', '删除市代', 'cagents', 'delcagents', '1', '34', '');
INSERT INTO `niot_node` VALUES ('39', '县级代理', '#', '#', '2', '0', 'fa fa-bars');
INSERT INTO `niot_node` VALUES ('40', '新增县代', 'tagents', 'addtagents', '2', '39', '');
INSERT INTO `niot_node` VALUES ('41', '县代列表', 'tagents', 'indextagents', '2', '39', '');
INSERT INTO `niot_node` VALUES ('42', '编辑县代', 'tagents', 'updatetagents', '1', '39', '');
INSERT INTO `niot_node` VALUES ('43', '删除县代', 'tagents', 'deltagents', '1', '39', '');
INSERT INTO `niot_node` VALUES ('44', '企业管理', '#', '#', '2', '0', 'fa fa-users');
INSERT INTO `niot_node` VALUES ('45', '新增企业账号', 'company', 'add', '2', '44', '');
INSERT INTO `niot_node` VALUES ('46', '企业账号列表', 'company', 'index', '2', '44', '');
INSERT INTO `niot_node` VALUES ('47', '编辑企业账号', 'company', 'edit', '1', '44', '');
INSERT INTO `niot_node` VALUES ('49', '企业审核', 'company', 'check', '1', '44', '');

-- ----------------------------
-- Table structure for niot_role
-- ----------------------------
DROP TABLE IF EXISTS `niot_role`;
CREATE TABLE `niot_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `role_name` varchar(155) NOT NULL COMMENT '角色名称',
  `rule` varchar(255) DEFAULT '' COMMENT '权限节点数据',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of niot_role
-- ----------------------------
INSERT INTO `niot_role` VALUES ('1', '超级管理员', '*');
INSERT INTO `niot_role` VALUES ('2', '省级代理', '1,2,3,4,5,6,7,8,9,10');
INSERT INTO `niot_role` VALUES ('3', '市级代理', '');
INSERT INTO `niot_role` VALUES ('4', '县级代理', '');

-- ----------------------------
-- Table structure for niot_user
-- ----------------------------
DROP TABLE IF EXISTS `niot_user`;
CREATE TABLE `niot_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '密码',
  `head` varchar(255) COLLATE utf8_bin DEFAULT '' COMMENT '头像',
  `login_times` int(11) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `last_login_ip` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '最后登录时间',
  `real_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '真实姓名',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT '用户角色id',
  `role_status` tinyint(255) NOT NULL DEFAULT '1' COMMENT '1 后台管理员   2代理 ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of niot_user
-- ----------------------------
INSERT INTO `niot_user` VALUES ('1', 'admin', 'a9ddd2e7bdff202e3e9bca32765e9ba0', '/static/admin/images/profile_small.jpg', '49', '127.0.0.1', '1557973167', 'admin', '1', '1', '1');
INSERT INTO `niot_user` VALUES ('2', 'niot_henan', '84386805f4fa719c7023544210fea50c', '/static/admin/images/profile_small.jpg', '0', '', '0', '张三', '1', '2', '2');
INSERT INTO `niot_user` VALUES ('5', 'niot_luoyang', '84386805f4fa719c7023544210fea50c', '/static/admin/images/profile_small.jpg', '0', '', '0', '李四33333', '1', '3', '2');
