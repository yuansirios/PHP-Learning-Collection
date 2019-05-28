-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `zh` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `zh`;

DROP TABLE IF EXISTS `zh_article`;
CREATE TABLE `zh_article` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(255) NOT NULL COMMENT '文档标题',
  `title_img` varchar(200) NOT NULL COMMENT '标题图片',
  `is_hot` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否热门1是0否',
  `is_top` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否置顶1是0否',
  `cate_id` int(10) NOT NULL COMMENT '栏目主键',
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `content` text NOT NULL COMMENT '文档内容',
  `pv` int(10) NOT NULL DEFAULT '0' COMMENT '阅读量',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1显示0隐藏',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文档表';

INSERT INTO `zh_article` (`id`, `title`, `title_img`, `is_hot`, `is_top`, `cate_id`, `user_id`, `content`, `pv`, `status`, `create_time`, `update_time`) VALUES
(17,	'PHP与Ajax操作',	'20180201/a083fc5c50b549844adc3be2cf5a74ca.jpg',	0,	0,	1,	4,	'<font color=\"#cc9933\">PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作                   \r\n                </font>',	3,	1,	1517470513,	1517470513),
(18,	'自己动手写框架教程',	'20180201/eb196196fd9ceb31015df573cabcc306.jpg',	0,	0,	1,	1,	'<font color=\"#993399\">自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程                   \r\n                </font>',	2,	1,	1517470568,	1517470568),
(19,	'PHP模糊查询技术',	'20180201/ffd37728ade39db69a11cb4cbb1273a8.jpg',	0,	0,	2,	4,	'<font color=\"#009999\">PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术                   \r\n                </font>',	0,	1,	1517470648,	1517470648),
(20,	'ThinkPHP5企业站点开发指南',	'20180201/56f40395769ffb6f5650977f75a8131c.jpg',	0,	0,	3,	4,	'ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南                   \r\n                ',	1,	1,	1517470769,	1517470769),
(21,	'ThinkPHP5经典视频教程',	'20180201/2fe5ea182cccbc277c7680a39664bc21.jpg',	0,	0,	3,	4,	'<font color=\"#993300\">ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程                   \r\n                </font>',	0,	1,	1517470868,	1517470868),
(22,	'新闻发布系统教程',	'20180201/2e49e3bd16cfbc759b47ebf5a2fa0b3e.jpg',	0,	0,	2,	4,	'<font color=\"#009966\">新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程                   \r\n                </font>',	5,	1,	1517470943,	1517470943),
(23,	'PDO极速入门教程',	'20180201/945dad56d6649a3bb32f9f3b33b85f82.jpg',	0,	0,	1,	4,	'<font color=\"#009999\" size=\"4\">PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程                   \r\n                </font>',	0,	1,	1517470444,	1517470444),
(24,	'PHP与Ajax操作',	'20180201/a083fc5c50b549844adc3be2cf5a74ca.jpg',	0,	0,	1,	1,	'<font color=\"#cc9933\">PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作                   \r\n                </font>',	0,	1,	1517470513,	1517470513),
(25,	'自己动手写框架教程',	'20180201/eb196196fd9ceb31015df573cabcc306.jpg',	0,	0,	1,	4,	'<font color=\"#993399\">自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程                   \r\n                </font>',	2,	1,	1517470568,	1517470568),
(26,	'PHP模糊查询技术',	'20180201/ffd37728ade39db69a11cb4cbb1273a8.jpg',	0,	0,	2,	4,	'<font color=\"#009999\">PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术                   \r\n                </font>',	1,	1,	1517470648,	1517470648),
(27,	'ThinkPHP5企业站点开发指南',	'20180201/56f40395769ffb6f5650977f75a8131c.jpg',	0,	0,	3,	4,	'ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南                   \r\n                ',	0,	1,	1517470769,	1517470769),
(28,	'ThinkPHP5经典视频教程',	'20180201/2fe5ea182cccbc277c7680a39664bc21.jpg',	0,	0,	3,	4,	'<font color=\"#993300\">ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程                   \r\n                </font>',	0,	1,	1517470868,	1517470868),
(29,	'新闻发布系统教程',	'20180201/2e49e3bd16cfbc759b47ebf5a2fa0b3e.jpg',	0,	0,	2,	4,	'<font color=\"#009966\">新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程                   \r\n                </font>',	0,	1,	1517470943,	1517470943),
(30,	'PDO极速入门教程',	'20180201/945dad56d6649a3bb32f9f3b33b85f82.jpg',	0,	0,	1,	4,	'<font color=\"#009999\" size=\"4\">PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程                   \r\n                </font>',	0,	1,	1517470444,	1517470444),
(31,	'PHP与Ajax操作',	'20180201/a083fc5c50b549844adc3be2cf5a74ca.jpg',	0,	0,	1,	1,	'<font color=\"#cc9933\">PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作                   \r\n                </font>',	0,	1,	1517470513,	1517470513),
(32,	'自己动手写框架教程',	'20180201/eb196196fd9ceb31015df573cabcc306.jpg',	0,	0,	1,	4,	'<font color=\"#993399\">自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程                   \r\n                </font>',	2,	1,	1517470568,	1517470568),
(33,	'PHP模糊查询技术',	'20180201/ffd37728ade39db69a11cb4cbb1273a8.jpg',	0,	0,	2,	4,	'<font color=\"#009999\">PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术                   \r\n                </font>',	0,	1,	1517470648,	1517470648),
(34,	'ThinkPHP5企业站点开发指南',	'20180201/56f40395769ffb6f5650977f75a8131c.jpg',	0,	0,	3,	4,	'ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南                   \r\n                ',	0,	1,	1517470769,	1517470769),
(35,	'ThinkPHP5经典视频教程',	'20180201/2fe5ea182cccbc277c7680a39664bc21.jpg',	0,	0,	3,	4,	'<font color=\"#993300\">ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程                   \r\n                </font>',	0,	1,	1517470868,	1517470868),
(36,	'新闻发布系统教程',	'20180201/2e49e3bd16cfbc759b47ebf5a2fa0b3e.jpg',	0,	0,	2,	4,	'<font color=\"#009966\">新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程新闻发布系统教程                   \r\n                </font>',	0,	1,	1517470943,	1517470943),
(37,	'PDO极速入门教程',	'20180201/945dad56d6649a3bb32f9f3b33b85f82.jpg',	0,	0,	1,	4,	'<font color=\"#009999\" size=\"4\">PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程PDO极速入门教程                   \r\n                </font>',	0,	1,	1517470444,	1517470444),
(38,	'PHP与Ajax操作',	'20180201/a083fc5c50b549844adc3be2cf5a74ca.jpg',	0,	0,	1,	4,	'<font color=\"#cc9933\">PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作PHP与Ajax操作                   \r\n                </font>',	0,	1,	1517470513,	1517470513),
(39,	'自己动手写框架教程',	'20180201/eb196196fd9ceb31015df573cabcc306.jpg',	0,	0,	1,	1,	'<font color=\"#993399\">自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程自己动手写框架教程                   \r\n                </font>',	2,	1,	1517470568,	1517470568),
(40,	'PHP模糊查询技术',	'20180201/ffd37728ade39db69a11cb4cbb1273a8.jpg',	0,	0,	2,	4,	'<font color=\"#009999\">PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术PHP模糊查询技术                   \r\n                </font>',	0,	1,	1517470648,	1517470648),
(41,	'ThinkPHP5企业站点开发指南',	'20180201/56f40395769ffb6f5650977f75a8131c.jpg',	0,	0,	3,	1,	'ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南ThinkPHP5企业站点开发指南                   \r\n                ',	0,	1,	1517470769,	1517470769),
(42,	'ThinkPHP5经典视频教程',	'20180201/2fe5ea182cccbc277c7680a39664bc21.jpg',	0,	0,	3,	4,	'<font color=\"#993300\">ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程ThinkPHP5经典视频教程                   \r\n                </font>',	0,	1,	1517470868,	1517470868);

DROP TABLE IF EXISTS `zh_article_category`;
CREATE TABLE `zh_article_category` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `name` varchar(100) NOT NULL COMMENT '栏目名称',
  `sort` int(4) NOT NULL COMMENT '栏目排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1启用0禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文档栏目表';

INSERT INTO `zh_article_category` (`id`, `user_id`, `name`, `sort`, `status`, `create_time`, `update_time`) VALUES
(1,	0,	'PHP',	5,	1,	0,	0),
(2,	0,	'MySQL',	1,	1,	0,	0),
(3,	0,	'ThinkPHP',	2,	1,	0,	0),
(5,	0,	'html',	7,	0,	0,	0);

DROP TABLE IF EXISTS `zh_site`;
CREATE TABLE `zh_site` (
  `id` int(4) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `title` varchar(100) NOT NULL DEFAULT '默认站点' COMMENT '网站名称',
  `keywords` text NOT NULL COMMENT '关键字',
  `desc` text NOT NULL COMMENT '网站描述',
  `is_open` tinyint(4) NOT NULL DEFAULT '1' COMMENT '开启状态1开0关',
  `is_comment` tinyint(4) NOT NULL DEFAULT '1' COMMENT '允许评论1开0关',
  `is_reg` tinyint(4) NOT NULL DEFAULT '1' COMMENT '允许注册1开0关',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1允许0禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='网站信息';

INSERT INTO `zh_site` (`id`, `title`, `keywords`, `desc`, `is_open`, `is_comment`, `is_reg`, `status`, `create_time`, `update_time`) VALUES
(1,	'我的网站',	'PHP中文网',	'网站描述',	1,	1,	0,	1,	0,	0);

DROP TABLE IF EXISTS `zh_user`;
CREATE TABLE `zh_user` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `is_admin` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '是否管理员1是0否',
  `name` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `email` varchar(200) NOT NULL COMMENT '邮箱',
  `mobile` varchar(20) NOT NULL COMMENT '手机',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1启用0禁用',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

INSERT INTO `zh_user` (`id`, `is_admin`, `name`, `password`, `email`, `mobile`, `status`, `create_time`, `update_time`) VALUES
(1,	0,	'peter',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'peter@php.cn',	'18955132304',	1,	1516947541,	1516947541),
(4,	1,	'admin',	'7c4a8d09ca3762af61e59520943dc26494f8941b',	'admin@php.cn',	'15899977665',	1,	0,	0);

DROP TABLE IF EXISTS `zh_user_comments`;
CREATE TABLE `zh_user_comments` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `article_id` int(10) NOT NULL COMMENT '文档主键',
  `content` text NOT NULL COMMENT '文档内容',
  `reply_id` int(10) NOT NULL DEFAULT '0' COMMENT '回复ID',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态1显示0隐藏',
  `create_time` int(10) NOT NULL COMMENT '创建时间',
  `update_time` int(10) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文档评论表';


DROP TABLE IF EXISTS `zh_user_fav`;
CREATE TABLE `zh_user_fav` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `article_id` int(10) NOT NULL COMMENT '文档主键',
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户收藏表';


DROP TABLE IF EXISTS `zh_user_like`;
CREATE TABLE `zh_user_like` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `user_id` int(10) NOT NULL COMMENT '用户主键',
  `art_id` int(10) NOT NULL COMMENT '文档主键',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户点赞表';


-- 2018-02-02 14:04:13