/*
SQLyog 企业版 - MySQL GUI v8.14 
MySQL - 5.6.17 : Database - stourwebcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stourwebcms` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `stourwebcms`;

/*Table structure for table `sline_admin` */

DROP TABLE IF EXISTS `sline_admin`;

CREATE TABLE `sline_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `logintime` int(10) unsigned DEFAULT NULL,
  `loginip` varchar(255) DEFAULT NULL,
  `roleid` int(6) DEFAULT NULL,
  `realname` varchar(30) DEFAULT NULL,
  `beizu` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sline_admin` */

insert  into `sline_admin`(`id`,`username`,`password`,`logintime`,`loginip`,`roleid`,`realname`,`beizu`) values (1,'admin','e10adc3949ba59abbe56e057f20f883e',1447147745,'127.0.0.1',1,NULL,NULL);

/*Table structure for table `sline_advertise` */

DROP TABLE IF EXISTS `sline_advertise`;

CREATE TABLE `sline_advertise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT '0' COMMENT 'sline网站标识用于区分多网站',
  `typeid` int(3) DEFAULT '0' COMMENT '栏目标识',
  `tagname` varchar(255) DEFAULT NULL COMMENT '广告关联名称',
  `adposition` varchar(255) DEFAULT NULL COMMENT '广告位置',
  `normalbody` text,
  `expirebody` varchar(255) DEFAULT NULL COMMENT '过期广告显示内容',
  `starttime` int(10) unsigned DEFAULT NULL,
  `endtime` int(11) unsigned DEFAULT NULL COMMENT '广告结束时间',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加广告时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '广告更新时间',
  `picurl` varchar(255) DEFAULT NULL COMMENT '广告图片路径',
  `linkurl` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `adtype` int(3) DEFAULT '0' COMMENT '广告类型，0为全局，1为首页，2为栏目，',
  `litpic` varchar(255) DEFAULT NULL COMMENT '缩略图地址',
  `linktext` varchar(255) DEFAULT NULL,
  `displayorder` int(11) DEFAULT NULL,
  `kindlist` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_advertise` */

insert  into `sline_advertise`(`id`,`webid`,`typeid`,`tagname`,`adposition`,`normalbody`,`expirebody`,`starttime`,`endtime`,`addtime`,`modtime`,`picurl`,`linkurl`,`adtype`,`litpic`,`linktext`,`displayorder`,`kindlist`) values (2,0,0,'HotelRollingAd','酒店首页轮播广告','<a href=\'/hotels/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/eebcb699b27ad2f72cd883e5471a970d.jpg\" alt=\"热门旅游酒店\" width=\"725\" height=\"304\" /></a>',NULL,NULL,NULL,1393827296,1393827296,'/uploads/2015/0918/eebcb699b27ad2f72cd883e5471a970d.jpg','/hotels/',2,'/uploads/main/adimg/20140303/20140303141445.jpg','热门旅游酒店',NULL,NULL),(4,0,0,'CarRollingAd','租车首页轮播广告','<a href=\'/cars/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/395db9d176682fdf846d703c60fd8942.jpg\" alt=\"旅游租车\" width=\"710\" height=\"238\" /></a>',NULL,NULL,NULL,1393828380,1393828446,'/uploads/2015/0918/395db9d176682fdf846d703c60fd8942.jpg','/cars/',2,'/uploads/main/adimg/20140303/20140303143254.jpg','旅游租车',NULL,NULL),(6,0,0,'TuanRollingAd','团购首页轮播广告','<a href=\'/tuan/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/57e35a8c2c540503fffdbc07e86ed8f7.jpg\" alt=\"热门团购\" width=\"960\" height=\"342\" /></a>',NULL,NULL,NULL,1393828667,1393828667,'/uploads/2015/0918/57e35a8c2c540503fffdbc07e86ed8f7.jpg','/tuan/',2,'/uploads/main/adimg/20140303/20140303143740.jpg','热门团购',NULL,NULL),(12,0,0,'DestIndexAd1','目的地首页广告1','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152756.gif\" alt=\"\" width=\"190\" height=\"401\" /></a>',NULL,NULL,NULL,1393831678,1393831678,'/uploads/main/adimg/20140303/20140303152756.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152756.gif','',NULL,NULL),(13,0,0,'DestIndexAd2','目的地首页广告2','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152808.gif\" alt=\"\" width=\"379\" height=\"195\" /></a>',NULL,NULL,NULL,1393831691,1393831691,'/uploads/main/adimg/20140303/20140303152808.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152808.gif','',NULL,NULL),(14,0,0,'DestIndexAd3','目的地首页广告3','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152817.gif\" alt=\"\" width=\"188\" height=\"195\" /></a>',NULL,NULL,NULL,1393831701,1393831701,'/uploads/main/adimg/20140303/20140303152817.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152817.gif','',NULL,NULL),(15,0,0,'DestIndexAd4','目的地首页广告4','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152828.gif\" alt=\"\" width=\"187\" height=\"202\" /></a>',NULL,NULL,NULL,1393831712,1393831712,'/uploads/main/adimg/20140303/20140303152828.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152828.gif','',NULL,NULL),(16,0,0,'DestIndexAd5','目的地首页广告5','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152845.gif\" alt=\"\" width=\"190\" height=\"394\" /></a>',NULL,NULL,NULL,1393831732,1393831732,'/uploads/main/adimg/20140303/20140303152845.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152845.gif','',NULL,NULL),(17,0,0,'DestIndexAd6','目的地首页广告6','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152901.gif\" alt=\"\" width=\"190\" height=\"195\" /></a>',NULL,NULL,NULL,1393831746,1393831746,'/uploads/main/adimg/20140303/20140303152901.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152901.gif','',NULL,NULL),(18,0,0,'DestIndexAd7','目的地首页广告7','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152915.gif\" alt=\"\" width=\"190\" height=\"195\" /></a>',NULL,NULL,NULL,1393831760,1393831760,'/uploads/main/adimg/20140303/20140303152915.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152915.gif','',NULL,NULL),(19,0,0,'DestIndexAd8','目的地首页广告8','<a href=\'http://#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303152928.gif\" alt=\"\" width=\"383\" height=\"203\" /></a>',NULL,NULL,NULL,1393831773,1393831773,'/uploads/main/adimg/20140303/20140303152928.gif','http://#',4,'/uploads/main/adimg/20140303/20140303152928.gif','',NULL,NULL),(20,0,0,'VisaRollingAd','签证首页轮播广告','<a href=\'http://#\' style=\"padding-bottom:10px;\" class=\"fl clearfix\" target=\"_blank\"><img src=\"http://www.travel.com/uploads/main/adimg/20140303/20140303153401.gif\" alt=\"#\" width=\"745\" height=\'325\' /></a>',NULL,NULL,NULL,1393832048,1393832048,'/uploads/main/adimg/20140303/20140303153401.gif','http://#',2,'/uploads/main/adimg/20140303/20140303153401.gif','#',NULL,NULL),(21,0,0,'index2RollingAd','首页2轮播广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0909/f9e0e5f3883b40acc7e67067fc5f8c84.jpg\" alt=\"XXX热门线路\" width=\"1920\" height=\"320\" /></a>',NULL,NULL,NULL,1441794788,NULL,'/uploads/2015/0909/f9e0e5f3883b40acc7e67067fc5f8c84.jpg','#',1,NULL,'XXX热门线路',NULL,NULL),(22,0,0,'index2RollingAd','首页2轮播广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0909/ed753fe20810c09186e8f3fbf465bb4b.jpg\" alt=\"世界那么大，一定要去旅游！\" width=\"1920\" height=\"320\" /></a>',NULL,NULL,NULL,1441794991,NULL,'/uploads/2015/0909/ed753fe20810c09186e8f3fbf465bb4b.jpg','#',1,NULL,'世界那么大，一定要去旅游！',NULL,NULL),(28,0,0,'IndexRollingAd','首页滚动图片广告','<a href=\'/lines/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/88fd44a1d9fbe515c2b962d742c49a9d.jpg\" alt=\"跟我去旅行吧！感受真纯玩！真旅行！\" width=\"573\" height=\"380\" /></a>',NULL,NULL,NULL,1442542989,NULL,'/uploads/2015/0918/88fd44a1d9fbe515c2b962d742c49a9d.jpg','/lines/',1,NULL,'跟我去旅行吧！感受真纯玩！真旅行！',NULL,NULL),(29,0,0,'IndexAd1','首页顶部广告1','<a href=\'/lines/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/7ef98128656e2fc7c2d6242183f123de.jpg\" alt=\"热门旅行线路\" width=\"368\" height=\"228\" /></a>',NULL,NULL,NULL,1442543096,NULL,'/uploads/2015/0918/7ef98128656e2fc7c2d6242183f123de.jpg','/lines/',1,NULL,'热门旅行线路',NULL,NULL),(30,0,0,'IndexLeftAd1','首页目的地左侧广告1','<a href=\'/lines/sichuan/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/c760d6fe9e686d7a22c122c91ae29683.jpg\" alt=\"周边旅游\" width=\"200\" height=\"380\" /></a>',NULL,NULL,NULL,1442543175,NULL,'/uploads/2015/0918/c760d6fe9e686d7a22c122c91ae29683.jpg','/lines/sichuan/',1,NULL,'周边旅游',NULL,NULL),(31,0,0,'IndexLeftAd2','首页目的地左侧广告2','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/395f047af509ace4a65ee718d8a6d15e.jpg\" alt=\"周边\" width=\"200\" height=\"380\" /></a>',NULL,NULL,NULL,1442543276,NULL,'/uploads/2015/0918/395f047af509ace4a65ee718d8a6d15e.jpg','#',1,NULL,'周边',NULL,NULL),(32,0,0,'IndexLeftAd3','首页目的地左侧广告3','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/3026b45874abe0cab3e03de911963526.jpg\" alt=\"出境热门线路\" width=\"200\" height=\"380\" /></a>',NULL,NULL,NULL,1442543511,NULL,'/uploads/2015/0918/3026b45874abe0cab3e03de911963526.jpg','#',1,NULL,'出境热门线路',NULL,NULL),(33,0,0,'IndexAd2','首页顶部广告2','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/05348153d57707590e2c7238fc315f6a.jpg\" alt=\"游玩\" width=\"183\" height=\"150\" /></a>',NULL,NULL,NULL,1442545414,NULL,'/uploads/2015/0918/05348153d57707590e2c7238fc315f6a.jpg','#',1,NULL,'游玩',NULL,NULL),(34,0,0,'IndexAd3','首页顶部广告3','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0918/de2dfa219a5339ab1036748d5971afcc.jpg\" alt=\"户外旅游\" width=\"183\" height=\"150\" /></a>',NULL,NULL,NULL,1442545433,NULL,'/uploads/2015/0918/de2dfa219a5339ab1036748d5971afcc.jpg','#',1,NULL,'户外旅游',NULL,NULL),(35,0,0,'index2LineAd','首页2线路广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0924/a7c0420fd7005bce3cc99b069da0825c.jpg\" alt=\"热门线路\" width=\"247\" height=\"490\" /></a>',NULL,NULL,NULL,1443071672,NULL,'/uploads/2015/0924/a7c0420fd7005bce3cc99b069da0825c.jpg','#',1,NULL,'热门线路',NULL,NULL),(36,0,0,'index2SpotAd','首页2景点广告','<a href=\'/spots/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0924/29397c0a5698bd5abeea4d2098d97993.jpg\" alt=\"旅游景点\" width=\"247\" height=\"490\" /></a>',NULL,NULL,NULL,1443071877,NULL,'/uploads/2015/0924/29397c0a5698bd5abeea4d2098d97993.jpg','/spots/',1,NULL,'旅游景点',NULL,NULL),(37,0,0,'index2HotelAd','首页2酒店广告','<a href=\'/hotels/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0924/ce664f3b21c7e75f9f3f0464384a9c41.jpg\" alt=\"酒店\" width=\"247\" height=\"490\" /></a>',NULL,NULL,NULL,1443071960,NULL,'/uploads/2015/0924/ce664f3b21c7e75f9f3f0464384a9c41.jpg','/hotels/',1,NULL,'酒店',NULL,NULL),(38,0,0,'index2TuanAd','首页2团购广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0924/78c17e1b6eb0f6a10f21cb037b99e117.jpg\" alt=\"团购\" width=\"240\" height=\"190\" /></a>',NULL,NULL,NULL,1443073722,NULL,'/uploads/2015/0924/78c17e1b6eb0f6a10f21cb037b99e117.jpg','#',1,NULL,'团购',NULL,NULL),(39,0,0,'index2CarAd','首页2租车广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/0924/03f30ff6c925a727f08f6abe02c4d12c.jpg\" alt=\"租车\" width=\"240\" height=\"190\" /></a>',NULL,NULL,NULL,1443073746,NULL,'/uploads/2015/0924/03f30ff6c925a727f08f6abe02c4d12c.jpg','#',1,NULL,'租车',NULL,NULL),(40,0,0,'index3RollingAd','首页3轮播广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1008/7b41ff85087d1344579b09af15b83676.jpg\" alt=\"旅游\" width=\"1920\" height=\"320\" /></a>',NULL,NULL,NULL,1444281448,NULL,'/uploads/2015/1008/7b41ff85087d1344579b09af15b83676.jpg','#',1,NULL,'旅游',NULL,NULL),(41,0,0,'index3RollingAd','首页3轮播广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1008/f245ee13fb851d44e9870bf9044553e2.jpg\" alt=\"旅游\" width=\"1920\" height=\"320\" /></a>',NULL,NULL,NULL,1444281526,NULL,'/uploads/2015/1008/f245ee13fb851d44e9870bf9044553e2.jpg','#',1,NULL,'旅游',NULL,NULL),(42,0,0,'index3LineAd','首页3线路广告','<a href=\'/lines/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1008/be2fbaa0771ca8f8d5319a57f0c4e285.jpg\" alt=\"旅游线路\" width=\"247\" height=\"490\" /></a>',NULL,NULL,NULL,1444281669,NULL,'/uploads/2015/1008/be2fbaa0771ca8f8d5319a57f0c4e285.jpg','/lines/',1,NULL,'旅游线路',NULL,NULL),(43,0,0,'index3HotelAd','首页3酒店广告','<a href=\'/hotels/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1008/c7f748d47175fe1283a6aecec7f59368.jpg\" alt=\"热门酒店\" width=\"247\" height=\"490\" /></a>',NULL,NULL,NULL,1444281776,NULL,'/uploads/2015/1008/c7f748d47175fe1283a6aecec7f59368.jpg','/hotels/',1,NULL,'热门酒店',NULL,NULL),(44,0,0,'index3SpotAd','首页3景点广告','<a href=\'/spots/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1008/6373b488fa2a3778e1484ee49ceea17b.jpg\" alt=\"旅游热门景点门票\" width=\"247\" height=\"490\" /></a>',NULL,NULL,NULL,1444281934,NULL,'/uploads/2015/1008/6373b488fa2a3778e1484ee49ceea17b.jpg','/spots/',1,NULL,'旅游热门景点门票',NULL,NULL),(45,0,0,'index3CarAd','首页3租车广告','<a href=\'/cars/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1008/fcde597d881235f4cf9b4ce7c8a7a445.jpg\" alt=\"热门租车\" width=\"240\" height=\"190\" /></a>',NULL,NULL,NULL,1444281979,NULL,'/uploads/2015/1008/fcde597d881235f4cf9b4ce7c8a7a445.jpg','/cars/',1,NULL,'热门租车',NULL,NULL),(46,0,0,'index3TuanAd','首页3团购广告','<a href=\'/tuan/\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1008/d2bafdaea8c39347587a5d95511efda6.jpg\" alt=\"热门旅游团购\" width=\"240\" height=\"190\" /></a>',NULL,NULL,NULL,1444282085,NULL,'/uploads/2015/1008/d2bafdaea8c39347587a5d95511efda6.jpg','/tuan/',1,NULL,'热门旅游团购',NULL,NULL),(47,0,0,'CarRightAd','租车首页右侧广告','<a href=\'#\' style=\"margin-bottom:10px;\" class=\"fl clearfix\"><img src=\"http://testdata.souxw.com/uploads/2015/1010/6de59723491709b9583c21f6488bfc06.jpg\" alt=\"旅游租车\" width=\"240\" height=\"283\" /></a>',NULL,NULL,NULL,1444457321,NULL,'/uploads/2015/1010/6de59723491709b9583c21f6488bfc06.jpg','#',2,NULL,'旅游租车',NULL,NULL);

/*Table structure for table `sline_advertise_type` */

DROP TABLE IF EXISTS `sline_advertise_type`;

CREATE TABLE `sline_advertise_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` varchar(255) DEFAULT '0',
  `position` varchar(255) DEFAULT NULL COMMENT '广告位置',
  `tagname` varchar(255) DEFAULT NULL COMMENT '标识',
  `width` int(11) DEFAULT NULL COMMENT '宽度',
  `height` int(11) DEFAULT NULL COMMENT '高度',
  `type` int(1) DEFAULT NULL COMMENT '广告类型 1,首页广告,2,栏目广告,3,自定义广告',
  `issystem` int(11) DEFAULT '0' COMMENT '是否是系统广告',
  `addtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COMMENT='广告分类表';

/*Data for the table `sline_advertise_type` */

insert  into `sline_advertise_type`(`id`,`webid`,`position`,`tagname`,`width`,`height`,`type`,`issystem`,`addtime`) values (2,'0','首页滚动图片广告','IndexRollingAd',573,380,1,1,1406712135),(5,'0','线路首页轮播广告','LineRollingAd',956,275,2,1,1406712135),(7,'0','首页目的地左侧广告1','IndexLeftAd1',200,0,1,1,1410397842),(8,'0','首页目的地左侧广告2','IndexLeftAd2',200,0,1,1,1410397868),(9,'0','首页目的地左侧广告3','IndexLeftAd3',200,0,1,1,1410397883),(10,'0','首页目的地左侧广告4','IndexLeftAd4',200,0,1,1,1410397895),(11,'0','首页目的地左侧广告5','IndexLeftAd5',200,0,1,1,1410397911),(12,'0','首页目的地中间广告1','IndexMiddleAd1',960,0,1,1,1410397927),(13,'0','首页目的地中间广告2','IndexMiddleAd2',960,0,1,1,1410397943),(14,'0','首页目的地中间广告3','IndexMiddleAd3',960,0,1,1,1410397959),(15,'0','首页目的地中间广告4','IndexMiddleAd4',960,0,1,1,1410397978),(16,'0','首页目的地中间广告5','IndexMiddleAd5',960,0,1,1,1410397991),(17,'0','右侧广告1','GlobalRightA',240,0,3,1,1410398038),(18,'0','右侧广告2','GlobalRightB',240,0,3,1,1410398062),(19,'0','右侧广告3','GlobalRightC',240,0,3,1,1410398082),(20,'0','右侧广告4','GlobalRightD',240,0,3,1,1410398099),(21,'0','右侧广告5','GlobalRightE',240,240,3,1,1410398117),(22,'0','右侧广告6','GlobalRightF',240,0,3,1,1410398132),(23,'0','右侧广告7','GlobalRightG',240,0,3,1,1410398144),(24,'0','右侧广告8','GlobalRightH',240,0,3,1,1410398158),(25,'0','酒店首页轮播广告','HotelRollingAd',800,0,2,1,1410398205),(26,'0','租车首页轮播广告','CarRollingAd',710,238,2,1,1410398228),(27,'0','租车首页右侧广告','CarRightAd',240,0,2,1,1410398245),(28,'0','团购首页轮播广告','TuanRollingAd',960,342,2,1,1410398263),(29,'0','目的地首页广告','DestIndexAd1',190,401,2,1,1410398303),(30,'0','目的地首页广告2','DestIndexAd2',379,195,2,1,1410398320),(31,'0','目的地首页广告3','DestIndexAd3',188,202,2,1,1410398336),(32,'0','目的地首页广告4','DestIndexAd4',187,202,2,1,1410398353),(33,'0','目的地首页广告5','DestIndexAd5',190,394,2,1,1410398372),(34,'0','目的地首页广告6','DestIndexAd6',190,195,2,1,1410398394),(35,'0','目的地首页广告7','DestIndexAd7',190,195,2,1,1410398414),(36,'0','目的地首页广告8','DestIndexAd8',383,203,2,1,1410398433),(37,'0','攻略详细页广告1','RaiderShowAd1',960,0,2,1,1410398454),(38,'0','攻略详细页广告2','RaiderShowAd2',960,0,2,1,1410398475),(39,'0','攻略首页中间广告1','IndexRaiderMiddleNavAd1',960,0,2,1,1410398490),(40,'0','攻略首页中间广告2','IndexRaiderMiddleNavAd2',960,0,2,1,1410398506),(41,'0','攻略首页中间广告3','IndexRaiderMiddleNavAd3',960,0,2,1,1410398520),(42,'0','攻略首页中间广告4','IndexRaiderMiddleNavAd4',960,0,2,1,1410398534),(43,'0','攻略首页中间广告5','IndexRaiderMiddleNavAd5',960,0,2,1,1410398550),(45,'0','手机首页轮播广告','MobileIndexRollAd',320,200,1,0,1416981629),(46,'0','首页顶部广告1','IndexAd1',368,228,1,0,1421112936),(47,'0','首页顶部广告2','IndexAd2',183,150,1,0,1421113023),(48,'0','首页顶部广告3','IndexAd3',183,150,1,0,1421112976),(49,'0','新版签证首页顶部','visatopad',1920,430,2,1,1426661019),(50,'0','会员登陆页广告','loginAd',537,372,2,0,1427968318),(51,'0','新版签证首页顶部','visatopad',1920,430,2,1,1426661019),(52,'0','会员登陆页广告','loginAd',537,372,2,0,1427968318),(53,'0','首页2轮播广告','index2RollingAd',1920,320,1,0,1429091171),(54,'0','首页2团购广告','index2TuanAd',210,190,1,0,1429085851),(55,'0','首页2景点广告','index2SpotAd',210,490,1,0,1429085714),(56,'0','首页2租车广告','index2CarAd',210,190,1,0,1429085662),(57,'0','首页2酒店广告','index2HotelAd',210,400,1,0,1429085625),(58,'0','首页2线路广告','index2LineAd',210,400,1,0,1429085557),(59,'0','首页3团购广告','index3TuanAd',247,190,1,0,1443149840),(60,'0','首页3景点广告','index3SpotAd',247,490,1,0,1443149891),(61,'0','首页3租车广告','index3CarAd',247,190,1,0,1443149928),(62,'0','首页3线路广告','index3LineAd',247,490,1,0,1443149974),(63,'0','首页3轮播广告','index3RollingAd',1920,320,1,0,1443150032),(64,'0','首页3酒店广告','index3HotelAd',247,490,1,0,1443150069);

/*Table structure for table `sline_allorderlist` */

DROP TABLE IF EXISTS `sline_allorderlist`;

CREATE TABLE `sline_allorderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `typeid` int(1) unsigned DEFAULT NULL COMMENT '栏目类型',
  `aid` int(11) DEFAULT NULL COMMENT '文章的aid',
  `classid` int(11) DEFAULT NULL COMMENT '分类id',
  `displayorder` int(11) unsigned DEFAULT '9999' COMMENT '排序ID',
  `istejia` int(1) unsigned DEFAULT '0' COMMENT '特惠',
  `isding` int(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `isjian` int(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`),
  KEY `classid` (`classid`),
  KEY `IDX_AID_TYPEID` (`aid`,`typeid`) USING BTREE,
  KEY `IDX_AI_WE_TY` (`aid`,`webid`,`typeid`) USING BTREE,
  KEY `IDX_TYPEID_AID` (`typeid`,`aid`) USING BTREE,
  KEY `IDX_TY_AI_WE` (`typeid`,`aid`,`webid`) USING BTREE,
  KEY `IDX_typeid_aid_displayorder` (`typeid`,`aid`,`displayorder`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ssmall全局排序表';

/*Data for the table `sline_allorderlist` */

/*Table structure for table `sline_article` */

DROP TABLE IF EXISTS `sline_article`;

CREATE TABLE `sline_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `seotitle` varchar(255) DEFAULT NULL,
  `comefrom` varchar(255) DEFAULT NULL,
  `fromsite` varchar(70) DEFAULT NULL COMMENT '来源站点',
  `author` varchar(30) DEFAULT NULL COMMENT '作者',
  `content` longtext COMMENT '文章内容',
  `litpic` longtext,
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `shownum` int(11) DEFAULT NULL COMMENT '浏览次数',
  `tagword` varchar(50) DEFAULT NULL COMMENT '文章相关词',
  `keyword` varchar(50) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL,
  `kindlist` varchar(255) DEFAULT NULL,
  `themelist` varchar(255) DEFAULT NULL,
  `attrid` varchar(255) DEFAULT NULL,
  `ad_productid` varchar(255) DEFAULT NULL,
  `ad_kindid` varchar(255) DEFAULT NULL,
  `redirecturl` varchar(255) DEFAULT NULL,
  `ishidden` tinyint(4) DEFAULT '0',
  `iconlist` varchar(255) DEFAULT NULL,
  `templet` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL COMMENT '摘要',
  `isoffical` int(1) unsigned DEFAULT '0' COMMENT '是否是官方攻略',
  `piclist` text COMMENT '图片列表',
  `attachment` varchar(255) DEFAULT NULL COMMENT '附件',
  `downnum` int(10) unsigned DEFAULT '10' COMMENT '下载次数',
  PRIMARY KEY (`id`),
  KEY `kindlist` (`kindlist`),
  KEY `attrid` (`attrid`),
  KEY `IDX_AID` (`aid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_article` */

insert  into `sline_article`(`id`,`webid`,`aid`,`title`,`seotitle`,`comefrom`,`fromsite`,`author`,`content`,`litpic`,`addtime`,`modtime`,`shownum`,`tagword`,`keyword`,`description`,`kindlist`,`themelist`,`attrid`,`ad_productid`,`ad_kindid`,`redirecturl`,`ishidden`,`iconlist`,`templet`,`summary`,`isoffical`,`piclist`,`attachment`,`downnum`) values (1,0,1,'稻城亚丁有哪些景点','稻城亚丁有哪些景点？_稻城亚丁有什么景点？','XXX旅游网','','基础数据库','<p>亚丁是我国保存最完整的一处自然生态系统，被誉为&amp;ldquo;水蓝色星球上的最后一片净土&amp;rdquo;，三座神山和镶嵌其间的明镜般的湖泊，静谧而圣洁。所以稻城亚丁历来都收到旅游者的追捧。</p><p style=\"text-align: center;\"><strong style=\"text-align: center; white-space: normal;\"><img title=\"56_副本_副本.jpg\" border=\"0\" hspace=\"0\" src=\"http://ys.stourweb.com/uploads/arcimgs/20140625/2014062503504250.jpg\" alt=\"\" style=\"float: none;\"/>​</strong></p><p>1、牛奶海</p><p>牛奶海，又叫俄绒措，古冰川湖，状如水滴，四周雪山环绕。牛奶海位于央迈勇山脚下，是一个古冰川湖，面积0.5公顷，海拔4500米，四周雪山环绕，湖水清莹碧蓝，山上成瀑，以其玲珑秀雅水色翠蓝而著名，牛奶海上方有大片的冰川。传说每年春暖花开之时，湖水会像牛奶一样洁白如琼浆，并因此得名牛奶海。湖水清莹碧蓝，山止成瀑，以其玲珑秀雅水色翠蓝而著名。</p><p>2、夏诺多吉</p><p>夏诺多吉位于四川省甘孜州稻城县，意为&amp;ldquo;金刚手菩萨&amp;rdquo;，是&amp;ldquo;三怙主&amp;rdquo;雪山的东峰，海拔5958米，在&amp;ldquo;三怙主雪山&amp;rdquo;佛位第三，夏诺多吉山峰耸立在天地之间，在佛教中除暴安良的神甚，他勇猛的刚烈，神采奕奕，跨下围斑斓的虎皮，腰间绕着罪恶的大蟒，洛克先生把它形容为展开巨翅蓄抛待飞的蝙蝠，将它比喻成西腊神话中的雷神，神山左边绿色，大理石山头为布鲁财神，右下方为马头金刚，马头金刚下方&amp;ldquo;丹霞地貌风林为八百罗汉&amp;rdquo;，神山脚下洛绒牛场是当年洛克先生宿营处 。</p><p>3、央迈勇</p><p>央迈勇，藏语意为&amp;ldquo;文殊菩萨&amp;rdquo;，为&amp;ldquo;三怙主&amp;rdquo;雪山的南峰，海拔高度为5958米。文殊菩萨在佛教中是智慧的化身，央迈勇山形就像是文殊菩萨手中的智慧之剑直指云霄，傲立于天地间。神峰下由群山环绕着宽阔峡谷，森林、草地、溪流各守一方，气势莽莽，恰似人间仙境。&nbsp;</p><p>4、仙乃日</p><p>仙乃日是中国最美的、令人震撼的十大名山之一。仙乃日意为&amp;ldquo;观世音菩萨&amp;rdquo;（6032米，据说若藏民能够朝拜三次神山，便能实现今生之所愿。仙乃日，藏语意为&amp;ldquo;观世音菩萨&amp;rdquo;，为&amp;ldquo;三怙主&amp;rdquo;雪山的北峰，是亚丁景区三神山之首，海拔6032米。巍峨伟丽，端庄祥瑞，顶峰终年积雪不化，其山形酷似一个身体后仰的大佛。她前面的那座山是金刚亥母，左边像金字塔一样的山峰是白度母，右边摇曳着无数经幡的山峰是绿度母，绿度母旁边林立的冰蚀角峰是众多降香母和妙音仙女。</p><p><br/></p>','/uploads/main/litimg/20150909/20150909185227.jpg',1441795913,1444373989,205,'','稻城亚丁有哪些景点','','36,38',NULL,'13',NULL,NULL,'',0,NULL,'','亚丁是我国保存最完整的一处自然生态系统，被誉为“水蓝色星球上的最后一片净土”，三座神山和镶嵌其间的明镜般的湖泊，静谧而圣洁。所以稻城亚丁历来都收到旅游者的追捧。\n\n1、牛奶海\n牛奶海，又叫俄绒措，古冰川湖，状如水滴，四周雪山环绕。牛奶海位于...',0,'/uploads/main/litimg/20150909/20150909185227.jpg','',10),(3,0,2,'九寨沟门票价格','九寨沟门票价格_九寨沟门票多少钱？','九寨沟旅游','','四川省中国青年旅行社','<p>&nbsp;九寨沟，&quot;人间天堂,童话世界&quot;，是众多人向往的旅游之地，前往九寨沟旅游，大家可能想了解一下九寨沟门票价格，下面小编详细为大家介绍一下：</p><p>&nbsp;</p><p>九寨沟门票有淡旺季之分：</p><p>&nbsp;</p><p>旺季（4月1日-11月） 门票价格为220元/人 &nbsp;观光车票为80元/人</p><p>&nbsp;</p><p>淡季（11月16日-次年3月31日） 门票价格为80元/人，观光车为80元/人，淡季九寨沟二次进沟门票是免费的，但是需要购买观光车票。</p><p>&nbsp;</p><p>温馨提示：旺季的时候，景区每天早上7:00开始售票，淡季每天8:30开始售票</p><p>&nbsp;</p><p>同时九寨沟管理局还对部分人群实行：</p><p>&nbsp;</p><p>九寨沟门票优惠政策</p><p>&nbsp;</p><p>九寨沟门票免费政策</p><p>&nbsp;</p><p>温馨提示2：一般前往九寨沟的游客比较多，经常需要排长队购票，建议大家选择九寨沟跟团线路，这样您就不用担心交通、住宿、餐饮、门票等事宜。省事、省心游玩，非常舒适。</p><p>&nbsp;</p><p><br/></p>','/uploads/main/litimg/20150910/20150910094853.jpg',1441849736,1442905801,312,'','九寨沟门票价格,九寨沟门票多少钱','','36,38,40',NULL,'4,11',NULL,NULL,'',0,NULL,'',' 九寨沟，\"人间天堂,童话世界\"，是众多人向往的旅游之地，前往九寨沟旅游，大家可能想了解一下九寨沟门票价格，下面小编详细为大家介绍一下：\n \n九寨沟门票有淡旺季之分：\n \n旺季（4月1日-11月） 门票价格为220元/人',0,'/uploads/main/litimg/20150910/20150910094853.jpg','',10);

/*Table structure for table `sline_article_attr` */

DROP TABLE IF EXISTS `sline_article_attr`;

CREATE TABLE `sline_article_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `attrname` varchar(255) DEFAULT NULL,
  `displayorder` int(11) unsigned DEFAULT NULL,
  `isopen` int(11) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `issystem` int(1) DEFAULT '0' COMMENT '是否是系统属性',
  PRIMARY KEY (`id`),
  KEY `IDX_PID_ID` (`pid`,`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `sline_article_attr` */

insert  into `sline_article_attr`(`id`,`webid`,`aid`,`attrname`,`displayorder`,`isopen`,`pid`,`destid`,`litpic`,`description`,`issystem`) values (1,0,NULL,'线路攻略',NULL,0,0,NULL,NULL,NULL,1),(2,0,NULL,'酒店攻略',NULL,0,0,NULL,NULL,NULL,1),(3,0,NULL,'租车攻略',NULL,0,0,NULL,NULL,NULL,1),(4,0,NULL,'景点攻略',NULL,1,0,NULL,NULL,NULL,1),(5,0,NULL,'团购攻略',NULL,0,0,NULL,NULL,NULL,1),(6,0,NULL,'签证攻略',NULL,0,0,NULL,NULL,NULL,1),(7,6,NULL,'签证常见问题',NULL,0,0,NULL,NULL,NULL,1),(8,6,NULL,'签证新闻动态',NULL,0,0,NULL,NULL,NULL,1),(9,6,NULL,'签证办理流程',NULL,0,0,NULL,NULL,NULL,1),(11,0,NULL,'门票价格',NULL,1,4,NULL,NULL,NULL,0),(12,0,NULL,'攻略',NULL,1,0,NULL,NULL,NULL,0),(13,0,NULL,'旅游地图',NULL,1,12,NULL,NULL,NULL,0),(14,0,NULL,'美食购物',NULL,1,12,NULL,NULL,NULL,0);

/*Table structure for table `sline_article_extend_field` */

DROP TABLE IF EXISTS `sline_article_extend_field`;

CREATE TABLE `sline_article_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='文章字段扩展表';

/*Data for the table `sline_article_extend_field` */

/*Table structure for table `sline_article_kindlist` */

DROP TABLE IF EXISTS `sline_article_kindlist`;

CREATE TABLE `sline_article_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kindid` (`kindid`),
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='ssmall线路分类总表';

/*Data for the table `sline_article_kindlist` */

insert  into `sline_article_kindlist`(`id`,`kindid`,`seotitle`,`keyword`,`description`,`tagword`,`jieshao`,`isfinishseo`,`displayorder`,`isnav`,`ishot`,`shownum`,`templetpath`) values (36,36,'','','','','',0,2,1,0,0,''),(37,37,'','','','','',0,3,1,0,0,'');

/*Table structure for table `sline_attrorderlist` */

DROP TABLE IF EXISTS `sline_attrorderlist`;

CREATE TABLE `sline_attrorderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `typeid` int(1) unsigned DEFAULT NULL COMMENT '栏目类型',
  `aid` varchar(255) DEFAULT NULL COMMENT '文章的aid',
  `classid` int(11) DEFAULT NULL COMMENT '分类id',
  `displayorder` int(11) unsigned DEFAULT '9999' COMMENT '排序ID',
  `istejia` int(1) unsigned DEFAULT '0' COMMENT '特惠',
  `isding` int(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `isjian` int(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  `destid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性分类排序表';

/*Data for the table `sline_attrorderlist` */

/*Table structure for table `sline_car` */

DROP TABLE IF EXISTS `sline_car`;

CREATE TABLE `sline_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT NULL COMMENT 'sline编号',
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `seatnum` int(11) DEFAULT NULL COMMENT '座位数',
  `maxseatnum` int(11) DEFAULT NULL COMMENT '建议座位数',
  `sellpoint` varchar(255) DEFAULT NULL COMMENT '卖点',
  `displayorder` int(11) DEFAULT '9999' COMMENT '车务编号排序',
  `litpic` varchar(255) DEFAULT NULL,
  `content` longtext COMMENT '车务介绍',
  `shownum` int(11) DEFAULT '0' COMMENT '浏览次数',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `tagword` varchar(255) DEFAULT NULL COMMENT '文章相关词',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` longtext COMMENT '信息描述',
  `seotitle` varchar(255) DEFAULT NULL COMMENT 'seo标题',
  `usedyears` int(3) DEFAULT NULL COMMENT '使用年限',
  `kindlist` varchar(255) DEFAULT NULL,
  `themelist` varchar(255) DEFAULT NULL,
  `attrid` varchar(50) DEFAULT NULL,
  `ishidden` int(3) DEFAULT '0',
  `unit` varchar(255) DEFAULT NULL,
  `piclist` text,
  `tanknum` int(11) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `notice` mediumtext,
  `iconlist` varchar(255) DEFAULT NULL,
  `satisfyscore` int(11) DEFAULT NULL,
  `bookcount` varchar(11) DEFAULT NULL,
  `supplierlist` varchar(255) DEFAULT NULL,
  `templet` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `carkindid` int(11) DEFAULT NULL,
  `recommendnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_AID` (`aid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='车务表';

/*Data for the table `sline_car` */

insert  into `sline_car`(`id`,`webid`,`aid`,`title`,`seatnum`,`maxseatnum`,`sellpoint`,`displayorder`,`litpic`,`content`,`shownum`,`addtime`,`modtime`,`tagword`,`keyword`,`description`,`seotitle`,`usedyears`,`kindlist`,`themelist`,`attrid`,`ishidden`,`unit`,`piclist`,`tanknum`,`phone`,`notice`,`iconlist`,`satisfyscore`,`bookcount`,`supplierlist`,`templet`,`price`,`carkindid`,`recommendnum`) values (1,0,1,'三菱帕杰罗V74',0,0,'安全舒适',9999,'/uploads/2015/0910/6c4ceff91f78487e0ab2c7de4cb60fee.jpg','<p>介绍：三菱帕杰罗是由日本三菱汽车公司1982年开发生产的首款小型三门四驱越野车。帕杰罗第一代原型车是L系列(1982年-1990年);第二代帕杰罗是V系列(1991年-1999车);第三代帕杰罗V系列(1999年9月-至今)，目前已发展并派生出四大类车型，即帕杰罗原型越野车V系、SUV运动车系帕杰罗SPORT、小型SUV运动休闲车系帕杰罗iO，微型SUV运动休闲车系帕杰罗MINI。目前，帕杰罗四大类各种车型已在世界上170多个国家累计销售量超过200万辆。&nbsp;</p><p><br/></p><p>&nbsp; &nbsp; 配置：发动机：125kw V6</p><p><br/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 长/宽/高：4610/1699/1720</p><p><br/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 最小离地间隙：235mm</p><p><br/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 油耗：12L/100km&nbsp;</p><p><br/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 乘员人数：7人</p><p><br/></p><p>&nbsp; &nbsp;优势：该越野车性能优越，扭力强劲，非常识适合高原、山地较崎岖路面行驶。</p><p><br/></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 三菱帕杰罗V73越野车适合九寨沟、峨眉山、成都周边短线以及川藏南北线、川西线、甘南线、青滇藏线、云南、稻城亚丁等。</p><p><br/></p><p>&nbsp; &nbsp; 提供服务：会议租车、旅游租车、机场接送。四川省中国青年旅行社为您提供三菱帕杰罗V73租车服务，欢迎咨询。</p><p><br/></p>',23,1441870855,1441862454,'三菱帕杰罗V73','三菱帕杰罗V73','三菱帕杰罗V73','三菱帕杰罗V73',0,'',NULL,'6,3,4,8',0,NULL,'/uploads/2015/0910/6c4ceff91f78487e0ab2c7de4cb60fee.jpg||',NULL,'0','<p>请提前预订车辆！</p>',NULL,95,'59',NULL,'',0,NULL,0),(3,0,2,'金龙旅游大巴车30座',30,29,'舒适，安全！',9999,'/uploads/2015/0910/7a43adc9504d5fd77901e399e9337c1d.jpg','<p>特点：该旅游大巴性能优越，车内空间较大，豪华舒适，适合在路面较为平坦的路面行驶。载客数位30人，建议载客人数为29人。</p><p><br/></p><p>适合线路：30座金龙旅游大巴非常适合团队包车出行，还适合成都双流机场接送机，成都市区周边郊线包车服务，四川省内各旅游线路包车，为公司、团体、提供优质的会议租车服务。</p><p><br/></p><p>提供服务：会议租车、旅游租车、机场接送。该旅游大巴性能优越，车内空间较大，豪华舒适，适合在路面较为平坦的路面行驶。载客数位30人，建议载客人数为29人。</p><p><br/></p><p>四川省中国青年旅行社提供金龙大巴30座租车包车服务，签订正规合同，欢迎咨询！</p><p><br/></p>',17,1442904916,1441863253,'大巴','大巴','金龙旅游大巴车30座','金龙旅游大巴车30座',0,'',NULL,'9,6,3,5,7,12',0,NULL,'/uploads/2015/0910/7a43adc9504d5fd77901e399e9337c1d.jpg||122',NULL,'0','','5',90,'59',NULL,'',0,1,0),(4,0,3,'金龙旅游大巴',40,39,'安全舒适',9999,'/uploads/2015/0923/280754ab47a3afcd5a193c089134d040.jpg','<p><strong>特点：</strong>该旅游大巴性能优越，车内空间较大，豪华舒适，适合在路面较为平坦的路面行驶。载客数位30人，建议载客人数为29人。<br/></p><p><strong>适合线路：</strong>30座金龙旅游大巴非常适合团队包车出行，还适合成都双流机场接送机，成都市区周边郊线包车服务，四川省内各旅游线路包车，为公司、团体、提供优质的会议租车服务。</p><p><strong>提供服务：</strong>会议租车、旅游租车、机场接送。该旅游大巴性能优越，车内空间较大，豪华舒适，适合在路面较为平坦的路面行驶。载客数位30人，建议载客人数为29人。</p><p>四川省中国青年旅行社提供金龙大巴30座租车包车服务，签订正规合同，欢迎咨询！</p><p><br/></p>',5,1442992330,1442992092,'','','','',2,'36,38,40',NULL,NULL,0,NULL,'/uploads/2015/0923/280754ab47a3afcd5a193c089134d040.jpg||',NULL,'4006-0999-27','<p>详情请电话咨询。<br/></p>',NULL,92,'88',NULL,'',0,4,0);

/*Table structure for table `sline_car_attr` */

DROP TABLE IF EXISTS `sline_car_attr`;

CREATE TABLE `sline_car_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `attrname` varchar(255) DEFAULT NULL,
  `displayorder` int(11) unsigned DEFAULT NULL,
  `isopen` int(11) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  `issystem` int(1) DEFAULT '0' COMMENT '是否是系统属性',
  `litpic` varchar(255) DEFAULT NULL COMMENT '缩略图',
  PRIMARY KEY (`id`),
  KEY `IDX_PID_ID` (`pid`,`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `sline_car_attr` */

insert  into `sline_car_attr`(`id`,`webid`,`aid`,`attrname`,`displayorder`,`isopen`,`pid`,`destid`,`issystem`,`litpic`) values (1,0,NULL,'租车类型',NULL,1,0,NULL,1,NULL),(2,0,NULL,'厢型',NULL,1,0,NULL,1,NULL),(4,0,NULL,'自驾',NULL,1,1,NULL,0,NULL),(5,0,NULL,'代驾',NULL,1,1,NULL,0,NULL),(6,0,NULL,'租车城市',NULL,1,0,NULL,0,NULL),(7,0,NULL,'成都',NULL,1,6,NULL,0,NULL),(8,0,NULL,'云南',NULL,1,6,NULL,0,NULL),(9,0,NULL,'品牌',NULL,1,0,NULL,0,NULL),(10,0,NULL,'丰田',NULL,1,9,NULL,0,NULL),(11,0,NULL,'瑞风',NULL,1,9,NULL,0,NULL),(12,0,NULL,'金龙',NULL,1,9,NULL,0,NULL);

/*Table structure for table `sline_car_content` */

DROP TABLE IF EXISTS `sline_car_content`;

CREATE TABLE `sline_car_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '使用的字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL COMMENT '是否系统字段',
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isrealfield` int(1) unsigned DEFAULT '1' COMMENT '是否真实字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类表';

/*Data for the table `sline_car_content` */

insert  into `sline_car_content`(`id`,`webid`,`columnname`,`chinesename`,`displayorder`,`issystem`,`isopen`,`isrealfield`) values (1,0,'content','车辆信息',1,1,1,1),(2,0,'notice','温馨提示',2,1,1,1),(3,0,'tupian','图片',0,1,0,0);

/*Table structure for table `sline_car_extend_field` */

DROP TABLE IF EXISTS `sline_car_extend_field`;

CREATE TABLE `sline_car_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  `e_cartext` varchar(255) DEFAULT NULL COMMENT '车辆描述',
  `e_xinneng` mediumtext COMMENT '性能描述',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='租车字段扩展表';

/*Data for the table `sline_car_extend_field` */

/*Table structure for table `sline_car_kind` */

DROP TABLE IF EXISTS `sline_car_kind`;

CREATE TABLE `sline_car_kind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL COMMENT 'sline对应ID',
  `aid` int(11) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `title` varchar(255) DEFAULT NULL COMMENT '分类标题',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `tagword` varchar(255) DEFAULT NULL COMMENT '文章相关词',
  `description` mediumtext COMMENT '信息描述',
  `orderid` varchar(255) DEFAULT NULL COMMENT '排序',
  `displayorder` int(11) unsigned DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='车务类别表';

/*Data for the table `sline_car_kind` */

insert  into `sline_car_kind`(`id`,`webid`,`aid`,`kindname`,`title`,`keyword`,`tagword`,`description`,`orderid`,`displayorder`) values (1,0,1,'越野车','越野车旅游租车价格','','','','',1),(2,0,2,'商务车','商务车旅游租车价格','','','','',2),(3,0,3,'小轿车','小轿车旅游租车价格','','','','',3),(4,0,NULL,'大巴车','大巴车旅游租车价格',NULL,NULL,NULL,NULL,4);

/*Table structure for table `sline_car_kindlist` */

DROP TABLE IF EXISTS `sline_car_kindlist`;

CREATE TABLE `sline_car_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_KINDID` (`kindid`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

/*Data for the table `sline_car_kindlist` */

insert  into `sline_car_kindlist`(`id`,`kindid`,`seotitle`,`keyword`,`description`,`tagword`,`jieshao`,`isfinishseo`,`displayorder`,`isnav`,`ishot`,`shownum`,`templetpath`) values (36,36,'','','','','',0,2,1,0,0,''),(37,37,'','','','','',0,3,1,0,0,'');

/*Table structure for table `sline_car_pricelist` */

DROP TABLE IF EXISTS `sline_car_pricelist`;

CREATE TABLE `sline_car_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) DEFAULT NULL COMMENT '最小值',
  `max` int(11) DEFAULT NULL COMMENT '最大值',
  `webid` int(11) DEFAULT NULL COMMENT 'sline编号',
  `aid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='报价区间分类';

/*Data for the table `sline_car_pricelist` */

/*Table structure for table `sline_car_suit` */

DROP TABLE IF EXISTS `sline_car_suit`;

CREATE TABLE `sline_car_suit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carid` int(11) DEFAULT NULL,
  `suitname` varchar(255) DEFAULT NULL,
  `content` text,
  `unit` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `jifenbook` int(11) DEFAULT '0',
  `jifentprice` int(11) DEFAULT NULL,
  `jifencomment` int(11) DEFAULT NULL,
  `paytype` int(1) unsigned DEFAULT '1',
  `dingjin` varchar(255) DEFAULT NULL COMMENT '定金',
  `suittypeid` int(11) DEFAULT '0' COMMENT '套餐类型id',
  `displayorder` int(11) DEFAULT '9999',
  `number` int(11) DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `sline_car_suit` */

insert  into `sline_car_suit`(`id`,`carid`,`suitname`,`content`,`unit`,`price`,`jifenbook`,`jifentprice`,`jifencomment`,`paytype`,`dingjin`,`suittypeid`,`displayorder`,`number`) values (1,1,'租车','<p>更多租车线路定制服务欢迎拨打：400-609-9927</p>','',NULL,10,1,3,1,'0',1,9999,0),(2,3,'金龙旅游大巴车30座','<p>特点：该旅游大巴性能优越，车内空间较大，豪华舒适，适合在路面较为平坦的路面行驶。载客数位30人，建议载客人数为29人。</p><p><br/></p><p>适合线路：30座金龙旅游大巴非常适合团队包车出行，还适合成都双流机场接送机，成都市区周边郊线包车服务，四川省内各旅游线路包车，为公司、团体、提供优质的会议租车服务。</p><p><br/></p><p>提供服务：会议租车、旅游租车、机场接送。该旅游大巴性能优越，车内空间较大，豪华舒适，适合在路面较为平坦的路面行驶。载客数位30人，建议载客人数为29人。</p><p><br/></p><p>四川省中国青年旅行社提供金龙大巴30座租车包车服务，签订正规合同，欢迎咨询！</p><p>​<br/></p>','',NULL,50,5,5,1,'0',2,9999,0),(3,4,'包车',NULL,'',NULL,10,1,2,1,'0',3,9999,0),(5,4,'套餐2','','',NULL,0,0,0,1,'0',3,9999,0);

/*Table structure for table `sline_car_suit_price` */

DROP TABLE IF EXISTS `sline_car_suit_price`;

CREATE TABLE `sline_car_suit_price` (
  `carid` int(11) NOT NULL,
  `suitid` int(11) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0',
  `adultprofit` int(11) DEFAULT NULL,
  `adultbasicprice` int(11) DEFAULT NULL,
  `adultprice` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`suitid`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_car_suit_price` */

insert  into `sline_car_suit_price`(`carid`,`suitid`,`day`,`adultprofit`,`adultbasicprice`,`adultprice`,`description`,`number`) values (1,1,1441900800,200,1000,1200,'',-1),(1,1,1441987200,200,1000,1200,'',-1),(1,1,1442073600,200,1000,1200,'',-1),(1,1,1442160000,200,1000,1200,'',-1),(1,1,1442246400,200,1000,1200,'',-1),(1,1,1442332800,200,1000,1200,'',-1),(1,1,1442419200,200,1000,1200,'',-1),(1,1,1442505600,200,1000,1200,'',-1),(1,1,1442592000,200,1000,1200,'',-1),(1,1,1442678400,200,1000,1200,'',-1),(1,1,1442764800,200,1000,1200,'',-1),(1,1,1442851200,200,1000,1200,'',-1),(1,1,1442937600,200,1000,1200,'',-1),(1,1,1443024000,200,1000,1200,'',-1),(1,1,1443110400,200,1000,1200,'',-1),(1,1,1443196800,200,1000,1200,'',-1),(1,1,1443283200,200,1000,1200,'',-1),(1,1,1443369600,200,1000,1200,'',-1),(1,1,1443456000,200,1000,1200,'',-1),(1,1,1443542400,200,1000,1200,'',-1),(3,2,1441900800,280,700,980,'',-1),(3,2,1441987200,280,700,980,'',-1),(3,2,1442073600,280,700,980,'',-1),(3,2,1442160000,280,700,980,'',-1),(3,2,1442246400,280,700,980,'',-1),(3,2,1442332800,280,700,980,'',-1),(3,2,1442419200,280,700,980,'',-1),(3,2,1442505600,280,700,980,'',-1),(3,2,1442592000,280,700,980,'',-1),(3,2,1442678400,280,700,980,'',-1),(3,2,1442764800,280,700,980,'',-1),(3,2,1442851200,280,700,980,'',-1),(3,2,1442937600,280,700,980,'',-1),(3,2,1443024000,280,700,980,'',-1),(3,2,1443110400,280,700,980,'',-1),(3,2,1443196800,280,700,980,'',-1),(3,2,1443283200,280,700,980,'',-1),(3,2,1443369600,280,700,980,'',-1),(3,2,1443456000,280,700,980,'',-1),(3,2,1443542400,280,700,980,'',-1),(4,3,1442937600,399,800,1199,'',-1),(4,3,1443024000,399,800,1199,'',-1),(4,3,1443110400,399,800,1199,'',-1),(4,3,1443196800,399,800,1199,'',-1),(4,3,1443283200,399,800,1199,'',-1),(4,3,1443369600,399,800,1199,'',-1),(4,3,1443456000,399,800,1199,'',-1),(4,3,1443542400,399,800,1199,'',-1),(4,3,1443628800,399,800,1199,'',-1),(4,3,1443715200,399,800,1199,'',-1),(4,3,1443801600,399,800,1199,'',-1),(4,3,1443888000,399,800,1199,'',-1),(4,3,1443974400,399,800,1199,'',-1),(4,3,1444060800,399,800,1199,'',-1),(4,3,1444147200,399,800,1199,'',-1),(4,3,1444233600,399,800,1199,'',-1),(4,3,1444320000,399,800,1199,'',-1),(4,3,1444406400,399,800,1199,'',-1),(4,3,1444492800,399,800,1199,'',-1),(4,3,1444579200,399,800,1199,'',-1),(4,3,1444665600,399,800,1199,'',-1),(4,3,1444752000,399,800,1199,'',-1),(4,3,1444838400,399,800,1199,'',-1),(4,3,1444924800,399,800,1199,'',-1),(4,3,1445011200,399,800,1199,'',-1),(4,3,1445097600,399,800,1199,'',-1),(4,3,1445184000,399,800,1199,'',-1),(4,3,1445270400,399,800,1199,'',-1),(4,3,1445356800,399,800,1199,'',-1),(4,3,1445443200,399,800,1199,'',-1),(4,3,1445529600,399,800,1199,'',-1),(4,3,1445616000,399,800,1199,'',-1),(4,3,1445702400,399,800,1199,'',-1),(4,3,1445788800,399,800,1199,'',-1),(4,3,1445875200,399,800,1199,'',-1),(4,3,1445961600,399,800,1199,'',-1),(4,3,1446048000,399,800,1199,'',-1),(4,3,1446134400,399,800,1199,'',-1),(4,3,1446220800,399,800,1199,'',-1),(4,3,1446307200,399,800,1199,'',-1),(4,3,1446393600,399,800,1199,'',-1),(4,3,1446480000,399,800,1199,'',-1),(4,3,1446566400,399,800,1199,'',-1),(4,3,1446652800,399,800,1199,'',-1),(4,3,1446739200,399,800,1199,'',-1),(4,3,1446825600,399,800,1199,'',-1),(4,3,1446912000,399,800,1199,'',-1),(4,3,1446998400,399,800,1199,'',-1),(4,3,1447084800,399,800,1199,'',-1),(4,3,1447171200,399,800,1199,'',-1),(4,3,1447257600,399,800,1199,'',-1),(4,3,1447344000,399,800,1199,'',-1),(4,3,1447430400,399,800,1199,'',-1),(4,3,1447516800,399,800,1199,'',-1),(4,3,1447603200,399,800,1199,'',-1),(4,3,1447689600,399,800,1199,'',-1),(4,3,1447776000,399,800,1199,'',-1),(4,3,1447862400,399,800,1199,'',-1),(4,3,1447948800,399,800,1199,'',-1),(4,3,1448035200,399,800,1199,'',-1),(4,3,1448121600,399,800,1199,'',-1),(4,3,1448208000,399,800,1199,'',-1),(4,3,1448294400,399,800,1199,'',-1),(4,3,1448380800,399,800,1199,'',-1),(4,3,1448467200,399,800,1199,'',-1),(4,3,1448553600,399,800,1199,'',-1),(4,3,1448640000,399,800,1199,'',-1),(4,3,1448726400,399,800,1199,'',-1),(4,3,1448812800,399,800,1199,'',-1),(4,3,1448899200,399,800,1199,'',-1),(4,3,1448985600,399,800,1199,'',-1),(4,3,1449072000,399,800,1199,'',-1),(4,3,1449158400,399,800,1199,'',-1),(4,3,1449244800,399,800,1199,'',-1),(4,3,1449331200,399,800,1199,'',-1),(4,3,1449417600,399,800,1199,'',-1),(4,3,1449504000,399,800,1199,'',-1),(4,3,1449590400,399,800,1199,'',-1),(4,3,1449676800,399,800,1199,'',-1),(4,3,1449763200,399,800,1199,'',-1),(4,3,1449849600,399,800,1199,'',-1),(4,3,1449936000,399,800,1199,'',-1),(4,3,1450022400,399,800,1199,'',-1),(4,3,1450108800,399,800,1199,'',-1),(4,3,1450195200,399,800,1199,'',-1),(4,3,1450281600,399,800,1199,'',-1),(4,3,1450368000,399,800,1199,'',-1),(4,3,1450454400,399,800,1199,'',-1),(4,3,1450540800,399,800,1199,'',-1),(4,3,1450627200,399,800,1199,'',-1),(4,3,1450713600,399,800,1199,'',-1),(4,3,1450800000,399,800,1199,'',-1),(4,3,1450886400,399,800,1199,'',-1),(4,3,1450972800,399,800,1199,'',-1),(4,3,1451059200,399,800,1199,'',-1),(4,3,1451145600,399,800,1199,'',-1),(4,3,1451232000,399,800,1199,'',-1),(4,3,1451318400,399,800,1199,'',-1),(4,3,1451404800,399,800,1199,'',-1),(4,3,1451491200,399,800,1199,'',-1),(4,3,1451577600,399,800,1199,'',-1),(4,3,1451664000,399,800,1199,'',-1),(4,3,1451750400,399,800,1199,'',-1),(4,3,1451836800,399,800,1199,'',-1),(4,3,1451923200,399,800,1199,'',-1),(4,3,1452009600,399,800,1199,'',-1),(4,3,1452096000,399,800,1199,'',-1),(4,3,1452182400,399,800,1199,'',-1),(4,3,1452268800,399,800,1199,'',-1),(4,3,1452355200,399,800,1199,'',-1),(4,3,1452441600,399,800,1199,'',-1),(4,3,1452528000,399,800,1199,'',-1),(4,3,1452614400,399,800,1199,'',-1),(4,3,1452700800,399,800,1199,'',-1),(4,3,1452787200,399,800,1199,'',-1),(4,3,1452873600,399,800,1199,'',-1),(4,3,1452960000,399,800,1199,'',-1),(4,3,1453046400,399,800,1199,'',-1),(4,3,1453132800,399,800,1199,'',-1),(4,3,1453219200,399,800,1199,'',-1),(4,3,1453305600,399,800,1199,'',-1),(4,3,1453392000,399,800,1199,'',-1),(4,3,1453478400,399,800,1199,'',-1),(4,3,1453564800,399,800,1199,'',-1),(4,3,1453651200,399,800,1199,'',-1),(4,3,1453737600,399,800,1199,'',-1),(4,3,1453824000,399,800,1199,'',-1),(4,3,1453910400,399,800,1199,'',-1),(4,3,1453996800,399,800,1199,'',-1),(4,3,1454083200,399,800,1199,'',-1),(4,3,1454169600,399,800,1199,'',-1),(4,3,1454256000,399,800,1199,'',-1),(4,3,1454342400,399,800,1199,'',-1),(4,3,1454428800,399,800,1199,'',-1),(4,3,1454515200,399,800,1199,'',-1),(4,3,1454601600,399,800,1199,'',-1),(4,3,1454688000,399,800,1199,'',-1),(4,3,1454774400,399,800,1199,'',-1),(4,3,1454860800,399,800,1199,'',-1),(4,3,1454947200,399,800,1199,'',-1),(4,3,1455033600,399,800,1199,'',-1),(4,3,1455120000,399,800,1199,'',-1),(4,3,1455206400,399,800,1199,'',-1),(4,3,1455292800,399,800,1199,'',-1),(4,3,1455379200,399,800,1199,'',-1),(4,3,1455465600,399,800,1199,'',-1),(4,3,1455552000,399,800,1199,'',-1),(4,3,1455638400,399,800,1199,'',-1),(4,3,1455724800,399,800,1199,'',-1),(4,3,1455811200,399,800,1199,'',-1),(4,3,1455897600,399,800,1199,'',-1),(4,3,1455984000,399,800,1199,'',-1),(4,3,1456070400,399,800,1199,'',-1),(4,3,1456156800,399,800,1199,'',-1),(4,3,1456243200,399,800,1199,'',-1),(4,3,1456329600,399,800,1199,'',-1),(4,3,1456416000,399,800,1199,'',-1),(4,3,1456502400,399,800,1199,'',-1),(4,3,1456588800,399,800,1199,'',-1),(4,3,1456675200,399,800,1199,'',-1),(4,3,1456761600,399,800,1199,'',-1),(4,3,1456848000,399,800,1199,'',-1),(4,3,1456934400,399,800,1199,'',-1),(4,3,1457020800,399,800,1199,'',-1),(4,3,1457107200,399,800,1199,'',-1),(4,3,1457193600,399,800,1199,'',-1),(4,3,1457280000,399,800,1199,'',-1),(4,3,1457366400,399,800,1199,'',-1),(4,3,1457452800,399,800,1199,'',-1),(4,3,1457539200,399,800,1199,'',-1),(4,3,1457625600,399,800,1199,'',-1),(4,3,1457712000,399,800,1199,'',-1),(4,3,1457798400,399,800,1199,'',-1),(4,3,1457884800,399,800,1199,'',-1),(4,3,1457971200,399,800,1199,'',-1),(4,3,1458057600,399,800,1199,'',-1),(4,3,1458144000,399,800,1199,'',-1),(4,3,1458230400,399,800,1199,'',-1),(4,3,1458316800,399,800,1199,'',-1),(4,3,1458403200,399,800,1199,'',-1),(4,3,1458489600,399,800,1199,'',-1),(4,3,1458576000,399,800,1199,'',-1),(4,3,1458662400,399,800,1199,'',-1),(4,3,1458748800,399,800,1199,'',-1),(4,3,1458835200,399,800,1199,'',-1),(4,3,1458921600,399,800,1199,'',-1),(4,3,1459008000,399,800,1199,'',-1),(4,3,1459094400,399,800,1199,'',-1),(4,3,1459180800,399,800,1199,'',-1),(4,3,1459267200,399,800,1199,'',-1),(4,3,1459353600,399,800,1199,'',-1),(4,3,1459440000,399,800,1199,'',-1),(4,3,1459526400,399,800,1199,'',-1),(4,3,1459612800,399,800,1199,'',-1),(4,3,1459699200,399,800,1199,'',-1),(4,3,1459785600,399,800,1199,'',-1),(4,3,1459872000,399,800,1199,'',-1),(4,3,1459958400,399,800,1199,'',-1),(4,3,1460044800,399,800,1199,'',-1),(4,3,1460131200,399,800,1199,'',-1),(4,3,1460217600,399,800,1199,'',-1),(4,3,1460304000,399,800,1199,'',-1),(4,3,1460390400,399,800,1199,'',-1),(4,3,1460476800,399,800,1199,'',-1),(4,3,1460563200,399,800,1199,'',-1),(4,3,1460649600,399,800,1199,'',-1),(4,3,1460736000,399,800,1199,'',-1),(4,3,1460822400,399,800,1199,'',-1),(4,3,1460908800,399,800,1199,'',-1),(4,3,1460995200,399,800,1199,'',-1),(4,3,1461081600,399,800,1199,'',-1),(4,3,1461168000,399,800,1199,'',-1),(4,3,1461254400,399,800,1199,'',-1),(4,3,1461340800,399,800,1199,'',-1),(4,3,1461427200,399,800,1199,'',-1),(4,3,1461513600,399,800,1199,'',-1),(4,3,1461600000,399,800,1199,'',-1),(4,3,1461686400,399,800,1199,'',-1),(4,3,1461772800,399,800,1199,'',-1),(4,3,1461859200,399,800,1199,'',-1),(4,3,1461945600,399,800,1199,'',-1),(4,3,1462032000,399,800,1199,'',-1),(4,3,1462118400,399,800,1199,'',-1),(4,3,1462204800,399,800,1199,'',-1),(4,3,1462291200,399,800,1199,'',-1),(4,3,1462377600,399,800,1199,'',-1),(4,3,1462464000,399,800,1199,'',-1),(4,3,1462550400,399,800,1199,'',-1),(4,3,1462636800,399,800,1199,'',-1),(4,3,1462723200,399,800,1199,'',-1),(4,3,1462809600,399,800,1199,'',-1),(4,3,1462896000,399,800,1199,'',-1),(4,3,1462982400,399,800,1199,'',-1),(4,3,1463068800,399,800,1199,'',-1),(4,3,1463155200,399,800,1199,'',-1),(4,3,1463241600,399,800,1199,'',-1),(4,3,1463328000,399,800,1199,'',-1),(4,3,1463414400,399,800,1199,'',-1),(4,3,1463500800,399,800,1199,'',-1),(4,3,1463587200,399,800,1199,'',-1),(4,3,1463673600,399,800,1199,'',-1),(4,3,1463760000,399,800,1199,'',-1),(4,3,1463846400,399,800,1199,'',-1),(4,3,1463932800,399,800,1199,'',-1),(4,3,1464019200,399,800,1199,'',-1),(4,3,1464105600,399,800,1199,'',-1),(4,3,1464192000,399,800,1199,'',-1),(4,3,1464278400,399,800,1199,'',-1),(4,3,1464364800,399,800,1199,'',-1),(4,3,1464451200,399,800,1199,'',-1),(4,3,1464537600,399,800,1199,'',-1),(4,3,1464624000,399,800,1199,'',-1),(4,3,1464710400,399,800,1199,'',-1),(4,3,1464796800,399,800,1199,'',-1),(4,3,1464883200,399,800,1199,'',-1),(4,3,1464969600,399,800,1199,'',-1),(4,3,1465056000,399,800,1199,'',-1),(4,3,1465142400,399,800,1199,'',-1),(4,3,1465228800,399,800,1199,'',-1),(4,3,1465315200,399,800,1199,'',-1),(4,3,1465401600,399,800,1199,'',-1),(4,3,1465488000,399,800,1199,'',-1),(4,3,1465574400,399,800,1199,'',-1),(4,3,1465660800,399,800,1199,'',-1),(4,3,1465747200,399,800,1199,'',-1),(4,3,1465833600,399,800,1199,'',-1),(4,3,1465920000,399,800,1199,'',-1),(4,3,1466006400,399,800,1199,'',-1),(4,3,1466092800,399,800,1199,'',-1),(4,3,1466179200,399,800,1199,'',-1),(4,3,1466265600,399,800,1199,'',-1),(4,3,1466352000,399,800,1199,'',-1),(4,3,1466438400,399,800,1199,'',-1),(4,3,1466524800,399,800,1199,'',-1),(4,3,1466611200,399,800,1199,'',-1),(4,3,1466697600,399,800,1199,'',-1),(4,3,1466784000,399,800,1199,'',-1),(4,3,1466870400,399,800,1199,'',-1),(4,3,1466956800,399,800,1199,'',-1),(4,3,1467043200,399,800,1199,'',-1),(4,3,1467129600,399,800,1199,'',-1),(4,3,1467216000,399,800,1199,'',-1),(4,3,1467302400,399,800,1199,'',-1),(4,3,1467388800,399,800,1199,'',-1),(4,3,1467475200,399,800,1199,'',-1),(4,3,1467561600,399,800,1199,'',-1),(4,3,1467648000,399,800,1199,'',-1),(4,3,1467734400,399,800,1199,'',-1),(4,3,1467820800,399,800,1199,'',-1),(4,3,1467907200,399,800,1199,'',-1),(4,3,1467993600,399,800,1199,'',-1),(4,3,1468080000,399,800,1199,'',-1),(4,3,1468166400,399,800,1199,'',-1),(4,3,1468252800,399,800,1199,'',-1),(4,3,1468339200,399,800,1199,'',-1),(4,3,1468425600,399,800,1199,'',-1),(4,3,1468512000,399,800,1199,'',-1),(4,3,1468598400,399,800,1199,'',-1),(4,3,1468684800,399,800,1199,'',-1),(4,3,1468771200,399,800,1199,'',-1),(4,3,1468857600,399,800,1199,'',-1),(4,3,1468944000,399,800,1199,'',-1),(4,3,1469030400,399,800,1199,'',-1),(4,3,1469116800,399,800,1199,'',-1),(4,3,1469203200,399,800,1199,'',-1),(4,3,1469289600,399,800,1199,'',-1),(4,3,1469376000,399,800,1199,'',-1),(4,3,1469462400,399,800,1199,'',-1),(4,3,1469548800,399,800,1199,'',-1),(4,3,1469635200,399,800,1199,'',-1),(4,3,1469721600,399,800,1199,'',-1),(4,3,1469808000,399,800,1199,'',-1),(4,3,1469894400,399,800,1199,'',-1),(4,3,1469980800,399,800,1199,'',-1),(4,3,1470067200,399,800,1199,'',-1),(4,3,1470153600,399,800,1199,'',-1),(4,3,1470240000,399,800,1199,'',-1),(4,3,1470326400,399,800,1199,'',-1),(4,3,1470412800,399,800,1199,'',-1),(4,3,1470499200,399,800,1199,'',-1),(4,3,1470585600,399,800,1199,'',-1),(4,3,1470672000,399,800,1199,'',-1),(4,3,1470758400,399,800,1199,'',-1),(4,3,1470844800,399,800,1199,'',-1),(4,3,1470931200,399,800,1199,'',-1),(4,3,1471017600,399,800,1199,'',-1),(4,3,1471104000,399,800,1199,'',-1),(4,3,1471190400,399,800,1199,'',-1),(4,3,1471276800,399,800,1199,'',-1),(4,3,1471363200,399,800,1199,'',-1),(4,3,1471449600,399,800,1199,'',-1),(4,3,1471536000,399,800,1199,'',-1),(4,3,1471622400,399,800,1199,'',-1),(4,3,1471708800,399,800,1199,'',-1),(4,3,1471795200,399,800,1199,'',-1),(4,3,1471881600,399,800,1199,'',-1),(4,3,1471968000,399,800,1199,'',-1),(4,3,1472054400,399,800,1199,'',-1),(4,3,1472140800,399,800,1199,'',-1),(4,3,1472227200,399,800,1199,'',-1),(4,3,1472313600,399,800,1199,'',-1),(4,3,1472400000,399,800,1199,'',-1),(4,3,1472486400,399,800,1199,'',-1),(4,3,1472572800,399,800,1199,'',-1),(4,3,1472659200,399,800,1199,'',-1),(4,3,1472745600,399,800,1199,'',-1),(4,3,1472832000,399,800,1199,'',-1),(4,3,1472918400,399,800,1199,'',-1),(4,3,1473004800,399,800,1199,'',-1),(4,3,1473091200,399,800,1199,'',-1),(4,3,1473177600,399,800,1199,'',-1),(4,3,1473264000,399,800,1199,'',-1),(4,3,1473350400,399,800,1199,'',-1),(4,3,1473436800,399,800,1199,'',-1),(4,3,1473523200,399,800,1199,'',-1),(4,3,1473609600,399,800,1199,'',-1),(4,3,1473696000,399,800,1199,'',-1),(4,3,1473782400,399,800,1199,'',-1),(4,3,1473868800,399,800,1199,'',-1),(4,3,1473955200,399,800,1199,'',-1),(4,3,1474041600,399,800,1199,'',-1),(4,3,1474128000,399,800,1199,'',-1),(4,3,1474214400,399,800,1199,'',-1),(4,3,1474300800,399,800,1199,'',-1),(4,3,1474387200,399,800,1199,'',-1),(4,3,1474473600,399,800,1199,'',-1),(4,3,1474560000,399,800,1199,'',-1),(4,3,1474646400,399,800,1199,'',-1),(4,3,1474732800,399,800,1199,'',-1),(4,3,1474819200,399,800,1199,'',-1),(4,3,1474905600,399,800,1199,'',-1),(4,3,1474992000,399,800,1199,'',-1),(4,3,1475078400,399,800,1199,'',-1),(4,3,1475164800,399,800,1199,'',-1),(4,3,1475251200,399,800,1199,'',-1),(4,3,1475337600,399,800,1199,'',-1),(4,3,1475424000,399,800,1199,'',-1),(4,3,1475510400,399,800,1199,'',-1),(4,3,1475596800,399,800,1199,'',-1),(4,3,1475683200,399,800,1199,'',-1),(4,3,1475769600,399,800,1199,'',-1),(4,3,1475856000,399,800,1199,'',-1),(4,3,1475942400,399,800,1199,'',-1),(4,3,1476028800,399,800,1199,'',-1),(4,3,1476115200,399,800,1199,'',-1),(4,3,1476201600,399,800,1199,'',-1),(4,3,1476288000,399,800,1199,'',-1),(4,3,1476374400,399,800,1199,'',-1),(4,3,1476460800,399,800,1199,'',-1),(4,3,1476547200,399,800,1199,'',-1),(4,3,1476633600,399,800,1199,'',-1),(4,3,1476720000,399,800,1199,'',-1),(4,3,1476806400,399,800,1199,'',-1),(4,3,1476892800,399,800,1199,'',-1),(4,3,1476979200,399,800,1199,'',-1),(4,3,1477065600,399,800,1199,'',-1),(4,3,1477152000,399,800,1199,'',-1),(4,3,1477238400,399,800,1199,'',-1),(4,3,1477324800,399,800,1199,'',-1),(4,3,1477411200,399,800,1199,'',-1),(4,3,1477497600,399,800,1199,'',-1),(4,3,1477584000,399,800,1199,'',-1),(4,3,1477670400,399,800,1199,'',-1),(4,3,1477756800,399,800,1199,'',-1),(4,3,1477843200,399,800,1199,'',-1),(4,3,1477929600,399,800,1199,'',-1),(4,3,1478016000,399,800,1199,'',-1),(4,3,1478102400,399,800,1199,'',-1),(4,3,1478188800,399,800,1199,'',-1),(4,3,1478275200,399,800,1199,'',-1),(4,3,1478361600,399,800,1199,'',-1),(4,3,1478448000,399,800,1199,'',-1),(4,3,1478534400,399,800,1199,'',-1),(4,3,1478620800,399,800,1199,'',-1),(4,3,1478707200,399,800,1199,'',-1),(4,3,1478793600,399,800,1199,'',-1),(4,3,1478880000,399,800,1199,'',-1),(4,3,1478966400,399,800,1199,'',-1),(4,3,1479052800,399,800,1199,'',-1),(4,3,1479139200,399,800,1199,'',-1),(4,3,1479225600,399,800,1199,'',-1),(4,3,1479312000,399,800,1199,'',-1),(4,3,1479398400,399,800,1199,'',-1),(4,3,1479484800,399,800,1199,'',-1),(4,3,1479571200,399,800,1199,'',-1),(4,3,1479657600,399,800,1199,'',-1),(4,3,1479744000,399,800,1199,'',-1),(4,3,1479830400,399,800,1199,'',-1),(4,3,1479916800,399,800,1199,'',-1),(4,3,1480003200,399,800,1199,'',-1),(4,3,1480089600,399,800,1199,'',-1),(4,3,1480176000,399,800,1199,'',-1),(4,3,1480262400,399,800,1199,'',-1),(4,3,1480348800,399,800,1199,'',-1),(4,3,1480435200,399,800,1199,'',-1),(4,3,1480521600,399,800,1199,'',-1),(4,3,1480608000,399,800,1199,'',-1),(4,3,1480694400,399,800,1199,'',-1),(4,3,1480780800,399,800,1199,'',-1),(4,3,1480867200,399,800,1199,'',-1),(4,3,1480953600,399,800,1199,'',-1),(4,3,1481040000,399,800,1199,'',-1),(4,3,1481126400,399,800,1199,'',-1),(4,3,1481212800,399,800,1199,'',-1),(4,3,1481299200,399,800,1199,'',-1),(4,3,1481385600,399,800,1199,'',-1),(4,3,1481472000,399,800,1199,'',-1),(4,3,1481558400,399,800,1199,'',-1),(4,3,1481644800,399,800,1199,'',-1),(4,3,1481731200,399,800,1199,'',-1),(4,3,1481817600,399,800,1199,'',-1),(4,3,1481904000,399,800,1199,'',-1),(4,3,1481990400,399,800,1199,'',-1),(4,3,1482076800,399,800,1199,'',-1),(4,3,1482163200,399,800,1199,'',-1),(4,3,1482249600,399,800,1199,'',-1),(4,3,1482336000,399,800,1199,'',-1),(4,3,1482422400,399,800,1199,'',-1),(4,3,1482508800,399,800,1199,'',-1),(4,3,1482595200,399,800,1199,'',-1),(4,3,1482681600,399,800,1199,'',-1),(4,3,1482768000,399,800,1199,'',-1),(4,3,1482854400,399,800,1199,'',-1),(4,3,1482940800,399,800,1199,'',-1),(4,3,1483027200,399,800,1199,'',-1),(4,3,1483113600,399,800,1199,'',-1);

/*Table structure for table `sline_car_suit_type` */

DROP TABLE IF EXISTS `sline_car_suit_type`;

CREATE TABLE `sline_car_suit_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kindname` varchar(255) DEFAULT NULL COMMENT '套餐类型名称',
  `carid` varchar(255) DEFAULT NULL COMMENT '车辆id',
  `description` varchar(255) DEFAULT NULL COMMENT '类型描述',
  `displayorder` int(11) unsigned DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `sline_car_suit_type` */

insert  into `sline_car_suit_type`(`id`,`kindname`,`carid`,`description`,`displayorder`) values (1,'套餐一','1',NULL,1),(2,'套餐一','3',NULL,1),(3,'包车出游','4',NULL,0);

/*Table structure for table `sline_comment` */

DROP TABLE IF EXISTS `sline_comment`;

CREATE TABLE `sline_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(2) unsigned DEFAULT NULL COMMENT '栏目类型',
  `orderid` int(11) unsigned DEFAULT NULL COMMENT '订单id',
  `articleid` varchar(50) DEFAULT NULL COMMENT '文章产品自增id',
  `memberid` int(11) unsigned DEFAULT NULL COMMENT '会员id',
  `pid` int(11) unsigned DEFAULT '0' COMMENT '是否是第一级评论',
  `content` mediumtext COMMENT '评论内容',
  `dockid` int(10) unsigned DEFAULT NULL COMMENT '停靠id',
  `score1` float(2,1) DEFAULT '0.0' COMMENT '评分1',
  `score2` float(2,1) DEFAULT NULL COMMENT '评分2',
  `score3` float(2,1) DEFAULT NULL COMMENT '评分3',
  `score4` float(2,1) DEFAULT '0.0' COMMENT '评分4',
  `isshow` int(1) DEFAULT '0' COMMENT '前台是否显示',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '评论时间',
  `level` int(1) unsigned DEFAULT '0' COMMENT '1:好评 2:中评 3 差评',
  `kindlist` varchar(255) DEFAULT NULL COMMENT '所属目的地',
  PRIMARY KEY (`id`),
  KEY `IDX_TYPEID_ARTICLEID` (`typeid`,`articleid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_comment` */

insert  into `sline_comment`(`id`,`typeid`,`orderid`,`articleid`,`memberid`,`pid`,`content`,`dockid`,`score1`,`score2`,`score3`,`score4`,`isshow`,`addtime`,`level`,`kindlist`) values (1,1,1,'2',1,0,'玩的非常开心，导游非常给力，整个旅程都比较满意！',NULL,4.5,4.5,4.5,4.5,1,1441857797,1,NULL),(2,1,2,'2',1,0,'真纯玩，价格实惠，满意的一次旅行！',NULL,4.5,4.5,4.5,3.5,1,1441862091,1,NULL),(3,4,NULL,'3',2,0,'攻略做得很详细，值得收藏！',0,0.0,NULL,NULL,0.0,1,1441865008,0,NULL),(4,2,3,'2',3,0,'酒店干净卫生，非常不错！设施也不错！',NULL,5.0,4.5,4.5,5.0,1,1441958744,1,NULL),(5,5,5,'3',4,0,'价格不错，网上买要便宜点！',NULL,5.0,4.5,5.0,0.0,1,1443066201,2,NULL);

/*Table structure for table `sline_customize` */

DROP TABLE IF EXISTS `sline_customize`;

CREATE TABLE `sline_customize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dest` varchar(80) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `startplace` varchar(80) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `adultnum` int(11) DEFAULT NULL,
  `childnum` int(11) DEFAULT NULL,
  `planerank` varchar(30) DEFAULT NULL,
  `hotelrank` varchar(30) DEFAULT NULL,
  `room` varchar(30) DEFAULT NULL,
  `food` varchar(30) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contacttime` varchar(50) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `contactname` varchar(30) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `content` text,
  `viewstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_customize` */

/*Table structure for table `sline_destinations` */

DROP TABLE IF EXISTS `sline_destinations`;

CREATE TABLE `sline_destinations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindname` varchar(255) DEFAULT NULL COMMENT '分类名称',
  `pid` int(11) DEFAULT '0' COMMENT '本表从属关系父id',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `kindtype` int(1) unsigned DEFAULT NULL COMMENT '1:栏目分类 2:其它分类',
  `isopen` int(1) unsigned DEFAULT '1' COMMENT '是否开启',
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0',
  `templetpath` varchar(255) DEFAULT NULL,
  `ishot` int(1) unsigned DEFAULT '0',
  `litpic` varchar(255) DEFAULT NULL,
  `piclist` text,
  `istopnav` tinyint(3) DEFAULT '0',
  `pinyin` varchar(255) DEFAULT NULL,
  `templet` varchar(255) DEFAULT NULL,
  `iswebsite` int(1) DEFAULT '0' COMMENT '是否开启子站',
  `weburl` varchar(50) DEFAULT NULL COMMENT '子站域名',
  `webroot` varchar(50) DEFAULT NULL COMMENT '子站目录',
  `webprefix` varchar(50) DEFAULT NULL COMMENT '子站主机头',
  `opentypeids` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_PINYIN` (`pinyin`) USING BTREE,
  KEY `IDX_PID` (`pid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

/*Data for the table `sline_destinations` */

insert  into `sline_destinations`(`id`,`kindname`,`pid`,`seotitle`,`keyword`,`description`,`tagword`,`jieshao`,`kindtype`,`isopen`,`isfinishseo`,`displayorder`,`isnav`,`templetpath`,`ishot`,`litpic`,`piclist`,`istopnav`,`pinyin`,`templet`,`iswebsite`,`weburl`,`webroot`,`webprefix`,`opentypeids`) values (36,'国内游',0,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,0,NULL,NULL,0,'guoneiyou',NULL,0,NULL,NULL,NULL,NULL),(37,'出境游',0,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,0,NULL,NULL,0,'chujingyou',NULL,0,NULL,NULL,NULL,NULL),(38,'四川',36,NULL,NULL,NULL,NULL,NULL,NULL,1,0,1,1,NULL,1,NULL,NULL,0,'sichuan',NULL,0,NULL,NULL,NULL,'1,2,4'),(39,'贵州',36,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,1,NULL,NULL,0,'guizhou',NULL,0,NULL,NULL,NULL,'1,2'),(40,'九寨沟',38,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,1,NULL,NULL,0,'jiuzhaigou',NULL,0,NULL,NULL,NULL,'1,2'),(41,'峨眉山',38,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,1,NULL,NULL,0,'emeishan',NULL,0,NULL,NULL,NULL,'1'),(42,'泰国',37,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,1,NULL,NULL,0,'taiguo',NULL,0,NULL,NULL,NULL,'1'),(43,'马尔代夫',37,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,1,NULL,NULL,0,'maerdaifu',NULL,0,NULL,NULL,NULL,'1'),(44,'北京',36,NULL,NULL,NULL,NULL,NULL,NULL,1,0,9999,0,NULL,1,NULL,NULL,0,'beijing',NULL,0,NULL,NULL,NULL,'1');

/*Table structure for table `sline_destinations_attr` */

DROP TABLE IF EXISTS `sline_destinations_attr`;

CREATE TABLE `sline_destinations_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(1) unsigned DEFAULT '0',
  `attrname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `displayorder` int(11) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `issystem` int(1) unsigned DEFAULT '0',
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_destinations_attr` */

/*Table structure for table `sline_dzorder` */

DROP TABLE IF EXISTS `sline_dzorder`;

CREATE TABLE `sline_dzorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordersn` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `dingjin` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `travelnum` int(11) DEFAULT NULL,
  `description` text,
  `addtime` int(11) DEFAULT NULL,
  `finishtime` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `viewstatus` tinyint(1) DEFAULT '0',
  `paysource` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_dzorder` */

/*Table structure for table `sline_email_msg` */

DROP TABLE IF EXISTS `sline_email_msg`;

CREATE TABLE `sline_email_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgtype` char(30) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `isopen` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_email_msg` */

/*Table structure for table `sline_extend_field` */

DROP TABLE IF EXISTS `sline_extend_field`;

CREATE TABLE `sline_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '类别',
  `fieldname` varchar(50) NOT NULL DEFAULT '0' COMMENT '字段名称',
  `fieldtype` varchar(50) NOT NULL DEFAULT '0' COMMENT '字段类型',
  `description` varchar(50) NOT NULL DEFAULT '0' COMMENT '字段描述',
  `tips` varchar(255) NOT NULL DEFAULT '0' COMMENT '填写描述',
  `isopen` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可用',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `modtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `isunique` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否唯一',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品字段扩展表';

/*Data for the table `sline_extend_field` */

/*Table structure for table `sline_feedback` */

DROP TABLE IF EXISTS `sline_feedback`;

CREATE TABLE `sline_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(255) DEFAULT NULL COMMENT '用户名',
  `mobile` varchar(20) DEFAULT NULL,
  `content` text COMMENT '反馈内容',
  `addtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_feedback` */

/*Table structure for table `sline_help` */

DROP TABLE IF EXISTS `sline_help`;

CREATE TABLE `sline_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '帮助标题',
  `kindid` int(2) unsigned DEFAULT NULL COMMENT '帮助所属分类',
  `body` longtext COMMENT '帮助详细内容',
  `displayorder` int(5) DEFAULT NULL,
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `type_id` varchar(255) DEFAULT NULL COMMENT '显示到',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='帮助信息表';

/*Data for the table `sline_help` */

insert  into `sline_help`(`id`,`webid`,`aid`,`title`,`kindid`,`body`,`displayorder`,`addtime`,`modtime`,`type_id`) values (1,0,1,'纯玩是什么意思？',1,'<p class=\\\"\\\\&quot;paragraph\\\\&quot;\\\">部分旅游线路在行程中会进一些购物店消费，纯玩的旅游线路则意味着不进购物店。</p>',1,1299116267,1348889811,'1,2'),(2,0,3,'什么是自由人？',1,'<p>当代旅游术语，指旅行社只负责安排旅行目的地的交通、住宿和总行程，而目的地旅游和饮食由游客自由安排的一种相对自由、经济的旅游形式。<br />\r\n&nbsp;</p>',2,1305579408,1318819322,'1,2,3'),(3,0,4,'什么是自助游？',1,'<p>近年来兴起的一种旅游方式，就像自选商场，所有产品（服务）都明码标价，由游人根据自身条件（包括时间、预算、身体状况等等）自由选择服务组合的旅游类型。</p>',3,1305579592,1318819338,'1,2,3'),(4,0,6,'预订线路支付定金的原因？',3,'<p>在签定好合同后，旅行社都会按照比例收取旅游团费的定金。交纳定金以后合同方可生效，就可以保证出团时间、出团的标准。杜绝了现在预定的价格便宜，到出团时间价格涨了，旅行社临时上调价格，或者是临时取消出团计划。</p>',5,1305581380,1342838519,'1'),(5,0,7,'本地游客如何付款？',10,'<p>如果你是本地游客（即本市市民），可通过以下方式支付团款：</p>\r\n<p><span>1、网上银行在线转帐；</span><br />\r\n<span>2、银行营业网点转帐：</span>请通过QQ/MSN/短信/电话等方式把转帐银行及金额告知联系您的工作人员，进行核对。公司工作人员经过核对后会立即通知您是否到帐。如果您有传真机，我们可为您传真收款凭证。<br />\r\n<span>3、公司派工作人员上门收取团款：</span>成都市区内，我公司可安排工作人员上门收取团款，收取团款后，工作人员开据收款凭据，换取发票时间，请提前告知。<br />\r\n<span>4、客户到公司支付团款：</span>您可以到公司支付团款。</p>',7,1305582007,1366867125,'on,0,1,2,3,4,5,6,7,8,9,10'),(6,0,8,'外地游客怎样付款？',3,'<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 因为是外地游客，上门收费或客服到公司缴费是行不通的，所以，我们建议游客选择以下两种方式支付团款：</p>\r\n<p><span style=\"color: #ff0000\">1、网上银行在线转帐；<br />\r\n2、银行营业网点转帐。</span></p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 以上2种方式，请通过QQ/MSN/短信/电话等方式把转帐银行及金额告知联系您的工作人员，进行核对。公司工作人员经过核对后会立即通知您是否到帐。如果您有传真机，我们可为您传真收款凭证。</p>',8,1305582313,1318819504,'1,2,3'),(7,0,9,'定金支付比例如何？',3,'<p><span style=\\\"color: #ff0000\\\">1、规旅游团散客参团：</span></p>\r\n<p>&nbsp; 汽车团-收取200元/人的定金；<br />\r\n&nbsp; 飞机团-收取往返的航空票款做为定金。</p>\r\n<p><span style=\\\"color: #ff0000\\\">2、规旅游团独立成团：</span></p>\r\n<p>&nbsp; 根据具体团队情况一团一议，以书面商定（包括：QQ/MSN/短信/传真/收据等方式）为准。</p>\r\n<p><span style=\\\"color: #ff0000\\\">3、种旅行团散客参团：</span></p>\r\n<p>&nbsp; 如川藏线带驾租车，定金500元/人。</p>\r\n<p><span style=\\\"color: #ff0000\\\">4、种旅行团独立成团：</span></p>\r\n<p>&nbsp; 根据具体团队情况一团一议，以书面商定（包括：QQ/MSN/短信/传真/收据等方式）为准。</p>',6,1305582510,1342838510,'1'),(8,0,10,'对于支付团款的建议',3,'<p><span style=\\\"color: #ff0000\\\">1、建议使用个人银行帐户：</span></p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 相对于公帐，个人帐户灵活方便，提供多家银行帐户，可减少客户跨行转帐手续费用；支持网银转帐/ATM机转帐/银行柜台转帐等方式；相较于公帐1～3天的到帐日期，同一银行的个人银行转帐能即时到帐，不会产生打了定金不能及时确定出团计划的风险；</p>\r\n<p><span style=\\\"color: #ff0000\\\">2、使用公司账户付款：</span>如果您所交定金在壹万元以上并且预订时间在10天以上，您又是公司帐户，我们建议您汇入我社公司账户。</p>\r\n<p><span style=\\\"color: #ff0000\\\">3、支付方式：</span></p>\r\n<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (1)提前10天以内预定，金额在10000以内请汇入个人帐户；<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (2)采用支付宝账户：<font color=\\\"#0000ee\\\"><u>2355240937@qq.com</u></font>；<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (3)提前10天以上预定，金额达到10000以上请使用公帐汇款。<br />\r\n&nbsp;</p>',9,1305583162,1348821533,'1,2'),(9,0,11,'传真能签合同吗？',4,'<p>如果您不方便到旅行社签署合同，且您身边有传真机，可以选择通过传真方式签署旅游合同。</p>\r\n<p>&nbsp;</p>\r\n<div class=\"&quot;dl_gs&quot;\">\r\n<p><img alt=\"&quot;预订流程&quot;\" width=\"&quot;928&quot;\" height=\"&quot;84&quot;\" src=\"&quot;http://www.jiuzhaitrip.com/uploads/arcimgs/lct.gif&quot;\" /></p>\r\n</div>\r\n<div class=\"dl_gs\">\r\n<p><img alt=\"预订流程\" width=\"928\" height=\"84\" src=\"http://www.jiuzhaitrip.com/uploads/arcimgs/lct.gif\" /></p>\r\n</div>\r\n<p>&nbsp;</p>',0,1305583305,1331542851,''),(10,0,12,'旅游合同范本',4,'<div align=\\\"center\\\"><b>2011</b><b>版北京统一旅游合同</b></div>\r\n<div align=\\\"left\\\">&nbsp;</div>\r\n<div>\r\n<table border=\\\"0\\\" cellspacing=\\\"1\\\" cellpadding=\\\"0\\\" width=\\\"550\\\">\r\n    <tbody>\r\n        <tr>\r\n            <td valign=\\\"top\\\">\r\n            <p align=\\\"left\\\"><b>合同编号</b></p>\r\n            <div>&nbsp;</div>\r\n            <div align=\\\"left\\\"><br />\r\n            <b>北京国内旅游合同</b></div>\r\n            <div align=\\\"center\\\"><br />\r\n            <b>使</b><b>用</b><b>说</b><b>明</b></div>\r\n            <div align=\\\"left\\\"><br />\r\n            依据有关法律、法规的规定，旅行社在提供旅游服务前应当与旅游者签订书面合同。本合同事根据《中华人民共和国合同法》和《旅行社条例》及有关法律、法规制定，供双方当事人约定采用。签订合同前请仔细阅读。</div>\r\n   <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">1.&nbsp;&nbsp; 本合同为示范文本，适用于住所地在本省行政区域内旅行社与旅游者之间订立的国内组团旅游服务关系。</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">2.&nbsp;&nbsp; 旅游者参加国内旅游应选择具有合法经营旅游业务资格的旅行社。旅行社应具有旅游行政管理部门统一颁发的《旅行社业务经营许可证》和工商行政管理部门统一颁发的《营业执照》。</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">3.&nbsp;&nbsp; 旅游者在交纳费用后，旅行社应开具发票。旅游者请保存好旅游活动中的有关票据，证明和资料，以便当合法权益受到侵害时作为投诉凭据，索赔证据。</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">4.&nbsp;&nbsp; 旅行社对旅游过程中可能危及旅游者人身、财产安全的事项以及其他须注意的问题，应当事先向旅游者作真实说明和明确警示，并采取防止危害发生的必要措施。旅游者应结合自身状况选择旅游项目。</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">5.&nbsp;&nbsp; 旅行社因故将旅游者转交给其他旅行社组织、接待时，须事先告知并征得旅游者的同意。</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">6.&nbsp;&nbsp; 旅行社在签订合同同时应真实注明该旅游项目所包含的景点门票及住宿、餐饮、交通标准、导游服务等相关内容。自选项目应安排在自由活动时间，并不得影响旅游整体行程。旅行社不得强制旅游者参加其安排的自选项目。</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">7.&nbsp;&nbsp; 双方当事人在签订本示范合同范本时，对本格式条款存在争议、不明确或需另行补充约定事项的，经双方协商，另行签订的补充条款均为合同的组成部分。</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">8.&nbsp;&nbsp; 旅游服务监督、投诉机构：</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            <div align=\\\"left\\\">&nbsp;</div>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>\r\n</div>\r\n<p>&nbsp;</p>',1,1305583455,1348822110,'1,2'),(11,0,13,'范本是正规旅游合同吗？',4,'<p>我社从事多年旅游服务，我们提供的旅游合同绝对是正规旅游合同。</p>',2,1305583623,1366867220,'2'),(12,0,14,'出门旅游买什么保险较好？',5,'<p>不管长短假，<font face=\"Verdana\">外出旅游开始成为人们的新时尚选择。出门在外，风险增大，买一份合适的保险，就可以将风险降到最低限度。 </font></p>\r\n<p><font face=\"Verdana\">1、旅游救助保险</font><br />\r\n<font face=\"Verdana\">2、旅客意外伤害保险</font><br />\r\n<font face=\"Verdana\">3、旅游人身意外伤害保险</font><br />\r\n<font face=\"Verdana\">4、住宿旅客人身保险<br />\r\n</font></p>',0,1305583781,1318819693,'1,2,3'),(13,0,15,'退团、退款的相关问题',5,'<p class=\"paragraph\">1、出发前不足4天（不含双休日及法定假日）的，提出退订、人数减少或其它项目改变，将根据实际情况收取车位损失费用，退还扣除车位损失的剩余团款；</p>\r\n<p class=\"paragraph\">2、特殊人群如有门票优惠政策（以当地政策为准），您可持有相关证件，由导游协助在景区门口做相应退款。</p>\r\n<p class=\"paragraph\">3、行程中如您自愿取消部分景点，将不退还相应费用。赠送项目如不能成行，不做任何退款。</p>\r\n<p class=\"paragraph\">4、如有需要，请与导游或<a href=\"http://www.jiuzhaitrip.com/\">九寨沟旅游网</a>客服专员确认相关事宜。</p>',0,1305583930,1318819717,'1,2,3'),(14,0,16,'预订酒店的问题',12,'<p>有关预订酒店的问题，我们的在线客服可以为你详细解答，欢迎你联系我们。</p>',0,1305584048,1366867355,'2'),(25,0,27,'常规问题解答',1,'<p>1.纯玩是什么意思？<br />\r\n一般旅游线路都有购物点，纯玩的团就不会再去购物点（除特殊线路外）<br />\r\n2.单房差是什么？<br />\r\n旅游过程中的住宿一般是标准间，即两个床位，您出游的人数（成人）为奇数时，有可能需要补足另外一个床位的费用。您也可以选择接受与其他人拼房，当无法拼房时再补单房差。<br />\r\n3. 双飞、双卧都是什么意思？<br />\r\n这是旅游的常用语，双飞是指往返交通都是飞机，双卧是指往返交通都是火车。所以也有单飞单卧之类的说法。<br />\r\n4. 独立成团可以吗？<br />\r\n如果您出游人数比较多的情况下，比如公司出游，可以选择独立成团（即不与其他游客拼团）详情请拨打4006&mdash;199&mdash;129北京青旅，期待您的来电。<br />\r\n5. 出国饮食吃不惯怎么办？<br />\r\n团体餐厅部分都以中餐为主（特殊情况除外）。<br />\r\n6. 老人出游需要哪些证明？<br />\r\n60岁以上需要医院（二级以上）提供身体健康证明和家人子女签字同意书。<br />\r\n7．行程太紧能不能缩减行程？<br />\r\n每个行程都不同，视情况而定，（具体需要领队或导游跟公司沟通而定）<br />\r\n8. 自助游和跟团的区别？<br />\r\n团队游：通过旅行社和相关旅游服务中介机构，以旅游报价的形式，按照一定的旅游行程进行的有组织的旅游活动；自助游：只向旅游者提供大交通（如航空票、火车票、船票）加上酒店预订等单项业务或几项业务组合的委托服务。<br />\r\n9. 有学生证，残疾证，军人证能否有优惠?<br />\r\n这些政策主要看景区的优惠办法,部分景区会有这种政策,部分景区则没有.(请在签署合前询问工作人员)<br />\r\n10.你们所谓的纯玩团和常规团报价不一样,有什么区别呀？<br />\r\n所谓纯玩团是指不含团队购物的旅行方式。特点是游览内容丰富，行程比较舒缓，接待标准也比较高，所以价格也会比常规团队贵一些；如果您不希望过多的购物影响您的游览时间，价格也在您的预算之内，我们建议您参加纯玩团。<br />\r\n11. 请问我们一家子3个成人想住在一间房间里，能这么安排吗？<br />\r\n大多数酒店都是双人标准间，如果酒店房间面积较大，应该可以安排加床。但是如果酒店无法加床，您就只能与其它客人拼住或者支付单间差费用。<br />\r\n12. 我到了国外是否可以脱团？<br />\r\n您参加的是团队旅游，期间发生问题，我们是要负责任的。因此，原则上我们是不允许游客在境外脱团活动的。如果您有要事办理，您可以选择我们的自由行产品，签署单项委托合同。（具体事项须提前告知工作人员）<br />\r\n13. 我在外地你们怎么收资料？<br />\r\n您可以选择快递的方式，或者本人递送。在此提醒您在邮递资料的过程中一定要选择正规快递公司，如发生资料丢失我们将不承担相应责任。<br />\r\n14. 行程上写6天游，可实际才4天，游览的时间上有所欺骗？/飞机是夜里起飞到达酒店都是第二天的凌晨了，为什么还要算一天？<br />\r\n根据国际惯例和旅游局规定，行程天数包括往返交通时间，并且都是以自然天来计算。<br />\r\n15. 我们临时改动餐，或者不吃可以退钱吗？<br />\r\n按照国际惯例，出发前的变动是可以实现的；在当地临时提出改动餐食是不能退餐费的。如果是特殊情况，也需要和当地导游和旅行社说明后，按照当地的标准执行。<br />\r\n16.在旅途中发生紧急事件怎么办？<br />\r\n请立即与导游或领队联系告知情况。<br />\r\n17.旅途中生病了怎么办？<br />\r\n病情严重的情况下，请立即联系当地医院或拨打120急救电话。在境外需要医疗救助时，可以联系领队或当地接待负责人，直接拨打当地急救电话，或联系中国驻所在国大使馆。北京青年旅行社社建议，对于年纪稍大的旅客，出国前一定要备齐日常服用的药物和急救药物；年过60岁的老人，在出国前，最好进行系统全面的全身检查，以减少境外旅游时生病的概率。</p>',0,1342776873,1342777591,''),(37,0,28,'签证问题解释',6,'<p>1. 什么是签证？<br />\r\n签证是一个主权国家发给申请出入该国的外国公民或本国公民的出入境许可证明，即在申请出入境人员持有的护照或其他有效的旅行证件上签注盖印，以示准许其出入境或经过该国国境。签证通常由前往国的驻外领使馆签发。<br />\r\n2. 什么是旅游签证？<br />\r\n旅游签证是签证的一种，一般是为了方便游客而开发旅游资源而设立的一种快速办理签证方式，相应的，受限制也大，一般来说有效期和停留期都较短，且只能够用来从事旅游相关的活动。<br />\r\n3. 旅游签证的特点？<br />\r\n来访目的为旅游、且签证有效期及停留期比较短。<br />\r\n4. 什么是多次往返签证？<br />\r\n是一般签证能多次使用（期限规定之内）；签证是一个国家的主权机关在本国或外国公民所持的护照或其他旅行证件上的签注、盖印，以表示允许其出入本国国境或者经过国境的手续。<br />\r\n5. 什么是商务签证？<br />\r\n商务签证主要指有关人员因公务或者个人原因去目的地国家从事投资、贸易、会议、展览、劳务等方面事务所进行的实地考察或洽谈。这类人员进入目的地国时需持商务访问签证。一般来说，去目的地国商务考察者在该国只能作短期逗留，考察人员应该在签证固定的时间内离开该国家。<br />\r\n6. 什么是销签？<br />\r\n销签是为证明您的出境旅游已经按时完成归国的程序。<br />\r\n7. 什么是拒签？<br />\r\n签证拒签后一般会在护照最后一页盖上使馆的印章，俗称拒签章，以表明此本护照使馆受理后没有发给签证。<br />\r\n8. 一般拒签都有哪些原因？<br />\r\n1材料不真实，2材料不齐全，3出国目的不明确 <br />\r\n9. 拒签后还可以继续申请签证吗？<br />\r\n驻海外使领馆对任何签证的申请，都有绝对的决定权。如果签证申请被使领馆以某种理由拒绝，申请人可以提交重新申请的权利。但是如果之前有过拒签记录，短期内不建议再次申请同一国签证。<br />\r\n10. 签证是否能保证通过呢？<br />\r\n所有的签证都不能保证通过，都是根据客人自己提供的材料由使馆去决定是否可以获得签证的。<br />\r\n11. 怎样才能提高出签率？<br />\r\n申请签证之前一定要准备好详细真实的签证材料，另外，最好详细叙述你的出行目的及行程安排，以便提高获签率，顺利拿到签证。<br />\r\n12. 签证到期了应该怎么处理？<br />\r\n重新办理签证，如果有的使馆规定可以办理延期也可以办理。<br />\r\n13. 为什么要尽可能多提供资产证明？<br />\r\n多提供丰厚的资产，有利于提高出签率。如果申请在国内的职位和收入太低，或者家庭经济状况不好，太年轻，无亲无故，很有可能会被国外的工作或者生活的条件所吸引，而导致拒签。<br />\r\n14. 办理签证是不是都要去领馆面试的？<br />\r\n部分欧洲国家和美国需要面试，其他国家不需要。<br />\r\n17. 护照、签证、港澳通行证、入台证等的办理？<br />\r\n护照、港澳通行证要在户口所在地的出入境管理中心办理，具体可以拨打电话咨询。入台证要拿着旅行社开具的参团发票去出入境管理中心办理。签证适由大使馆签发，由于各国大使馆要求不一样，所以请在参团时咨询客服人员。<br />\r\n18. 我们有护照能报名出境参团吗?<br />\r\n您有护照可以报名，但是不同的目的地还需要办理相关的签证，所以在此提醒您护照只是您出境游得基本条件，我们还需要您提供与签证相关的其他资料。<br />\r\n19. 护照销签要几天时间？我回国后2-3天后要再次出境。<br />\r\n护照销签时间主要是使馆掌控，建议您合理安排你的再次出境时间。<br />\r\n20.护照的有效期？<br />\r\n为了保证您能正常的出入境，我们建议您的护照要在归国后有半年以上有效期。</p>',2,1342777635,1348890356,'1,2'),(38,0,29,'关于旅游合同问题解答',11,'<p>1.能不能传真签合同?<br />\r\n传真签约，门市签约，或者快递签约都是可以。<br />\r\n2. 以不签合同吗？<br />\r\n为了保障您的权益，建议您签署正规的旅游合同。<br />\r\n3. 有旅游合同范本下载吗？<br />\r\n网站上有专属的范本，直接下载就可以。</p>',3,1342777677,1366867386,'on,0,1,2,3,4,5,6,7,8,9,10'),(39,0,30,'付款类问题解答',5,'<p>1.签约可以刷卡吗？<br />\r\n可以刷卡的，但是需要收取手续费千分之四（根据不同门市收取标准）<br />\r\n2. 付款方式有哪些？<br />\r\n目前可以选择网银，支付宝，门市可以现金支付，刷卡，或者支票转账。<br />\r\n3. 是否可提供发票？<br />\r\n严格按照国家税务规定提供发票。<br />\r\n4. 发票内容可以选择吗，比如说开会务费或住宿费等？<br />\r\n独立成团，提供会务服务，签订会务合同，可以开具会务费发票。除此之外，只可以开具旅游费发票。<br />\r\n5. 如何获取发票？<br />\r\n可以再门市索取发票，也可以通过邮政快递发票。</p>\r\n<p>&nbsp;</p>',1,1342777722,0,''),(40,0,31,'意大利ADS签证须知',6,'<p>签证领区划分<br />\r\n北京领区：除上海，广州领区之外的其他省份<br />\r\n上海领区：安徽、江苏、浙江、上海<br />\r\n广州领区：广东、广西、福建、海南&nbsp;&nbsp; <br />\r\n持三个月年前发放的北京领区所属城市暂住证者可以在北京办理签证</p>\r\n<p>受理时间<br />\r\n意大利使馆签证受理时间为5－10个工作日；需要提前一个月预约&nbsp;&nbsp;&nbsp;</p>\r\n<p>贴示</p>\r\n<p>对于未成年人的要求比较苛刻，不接受未成年人单独出行<br />\r\n提供的照片必须是近期3个月的照片，不能是翻拍照片<br />\r\n暂住证要求：至少为三个月前办理<br />\r\n所提供的公证书都需为意大利语译文<br />\r\n特别提醒：意大利签证的认证服务是有领区限制的，只能办理北京所属领区的公证书的认证服务，当客人所属上海或广州领区时，客人的公证书须在当地做好认证<br />\r\n特别提醒：在欧盟有亲属的客人，需要提供该亲属的护照首页，有效签证页，学生证/工作证复印件以及居住证（卡）的复印件及联系方式等资料；对于有同行人随团办理签证的自备签客人，需要提供护照首页，有效签证页以及与该同行人的关系证明</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p><br />\r\n&nbsp;</p>',0,1342777843,1342939330,''),(54,0,39,'预定常见问题',1,'<p>&nbsp;1.为什么网站上没有产品打电话和在线咨询却有呢？<br />\r\n您好，因为网络延迟的问题，有部分产品没有即时的显示在网站前台，因此如果网页上的产品不能满足您的需求时，顾问会给您推荐其他的产品。<br />\r\n2.为什么网站的价格和实际咨询的价格有误差呢？<br />\r\n答：网站的价格是固定的套餐搭配，如果套餐搭配发生变化，价格也会随之变化，如入住天数，餐标，房型这些都是导致价格变化的因素。<br />\r\n3. 行程上写6天游，可实际才4天，游览的时间上有所欺骗？/飞机是夜里起飞到达酒店都是第二天的凌晨了，为什么还要算一天？<br />\r\n根据国际惯例和旅游局规定，行程天数包括往返交通时间，并且都是以自然天来计算。<br />\r\n行程的天数都是固定的吗？可以根据自己的情况改变么？<br />\r\n您好，我们的行程都是灵活的，您可以根据自身的需求，告知顾问，由顾问给您一个适合您的行程推荐。<br />\r\n5.什么是单程票和往返票？<br />\r\n单程票：指点到点去程票。 往返票：指点到点来回程票。<br />\r\n6.什么是联程票？<br />\r\n始发地到目的地之间经另一个或几个机场中转，含有两个（及以上）乘机联、使用两个（及以上）不同航班号的航班抵达目的地的航空票。如：从呼和浩特到三亚，中间从北京中转。购买的从呼和浩特到北京、北京再到三亚的航空票就是联程航空票。<br />\r\n7.联程票可以安排提前到达中转城市么？<br />\r\n您好，联程票可以提前安排到中转城市的。您只需要告知顾问你的需求即可。<br />\r\n8.可以预定往返中转城市不一样的航班么？<br />\r\n您好，可以的。但是出于经济的考虑的话这样中转的费用可能会比一般的要高些。<br />\r\n9.国外转机可以出机场去玩么？<br />\r\n您好，国际转机的话一般是不允许出机场的，如果您有出机场的需求的话，您可以办理中转地的签证。<br />\r\n飞机上座位是如何划分的？<br />\r\n民航客机的座位排数是从前舱往后舱编的，其编号在行李箱的边缘。以每排6座的机型普通舱而言，前舱门登机座位从右至左编号为A、B、C、D、E、F。如果您持 座位是12排A座的登机牌，由前舱门登机，那么您的座位就是第12排靠右边舷窗的位置。头等舱的座位编排方法也相同。<br />\r\n11.飞机可以选座位么？<br />\r\n&nbsp;您好，飞机可以选座的。<br />\r\n12.飞机的座位哪的比较好<br />\r\n您好，一般机翼前面的靠窗的位子比较好，仅供参考您可以根据自己的喜好去选择。<br />\r\n13.飞机上东西随便吃吗<br />\r\n您好，飞机上的东西是可以随便享用的，但是也有航班有部分商品是要收费的。<br />\r\n14.哪个航班的服务最好？<br />\r\n您好，因为目的地的不同所以航班和服务也是有差距的，建议您告知顾问你的需求，我们会推荐给您的。<br />\r\n15.什么是正价票与特价票？<br />\r\n正价票 指旅客购买的是航空公司正常票价，允许进行签转和更改，一年有效。此类价 格高于特价票。 -特价票 指旅客购买的是航空公司特殊优惠票价，不允许签转，有很多限制条件，有效期各异，但较便宜。<br />\r\n16.一般在哪可以买到特价票，<br />\r\n您好，一般我们会在我们的媒介上发布特价票，如没有发布您可以咨询顾问。<br />\r\n17.你们是独立成团么？<br />\r\n您好，对于散客来说北京目前的情况都是散客拼团 国内的在当地拼的 出境团是在北京拼。</p>\r\n<p>&nbsp;18.你们会把客人转给其他旅行社么<br />\r\n您好，如果是散拼的话，我们会和组团社合作，由组团社执行合同内容。</p>',0,1342837338,0,''),(55,0,40,'合同的签订',4,'<p class=\\\"\\\\&quot;\\\\\\\\&quot;p15\\\\\\\\&quot;\\\\&quot;\\\"><span>1.</span><span>合同的签订有哪些渠道？</span><span><o:p></o:p></span></p>\r\n<p class=\\\"\\\\&quot;\\\\\\\\&quot;p15\\\\\\\\&quot;\\\\&quot;\\\"><span>签订合同的方式可以根据您自身情况选择传真签约，门市签约，或者快递签约。成都当地较远的顾客和外地的顾客建议选择传真签约和快递签约。</span><span><o:p></o:p></span></p>\r\n<p class=\\\"\\\\&quot;\\\\\\\\&quot;p15\\\\\\\\&quot;\\\\&quot;\\\"><span>2.</span><span>&nbsp;签约后赠送旅游保险么？</span><span><o:p></o:p></span></p>\r\n<p class=\\\"\\\\&quot;\\\\\\\\&quot;p15\\\\\\\\&quot;\\\\&quot;\\\"><span>&nbsp;</span><span>根据国家相关规定</span><span>签订旅游合同&nbsp;合同生效&nbsp;合同本身就含&nbsp;旅行社责任险，旅行社责任险是指游客在旅行途中出了问题时，旅行社有义务进行协调。&nbsp;</span><span><o:p></o:p></span></p>\r\n<p class=\\\"\\\\&quot;\\\\\\\\&quot;p15\\\\\\\\&quot;\\\\&quot;\\\"><span>&nbsp;&nbsp;此外我们还</span><span>建议客人购买旅游意外险&nbsp;国内</span><span>游是免费送旅游意外险，</span><span>&nbsp;</span><span>出境旅游由游客自行</span><span>购买&nbsp;保险公司的赔偿标准&nbsp;以保险公司</span></p>',0,1342837652,1366867301,''),(56,0,41,'关于门市付款',3,'<p>门市可以刷卡么？<br />\r\n&nbsp; 您好门市可以接受刷卡的。<br />\r\n&nbsp;&nbsp; <br />\r\n刷卡的手续费是多少？<br />\r\n&nbsp; 门市刷卡的手续费是消费金额的千分之六</p>\r\n<p>可以刷信用卡么？<br />\r\n&nbsp; 任何银行的信用卡借贷卡都是可以刷的</p>\r\n<p>刷卡有无手续费？<br />\r\n&nbsp;&nbsp; 刷信用卡的手续费参考刷卡手续费。<br />\r\n　　　<br />\r\n门市签约的时间段是什么？</p>\r\n<p>&nbsp;&nbsp; 为了减少您在门市等候的时间，请您提前与顾问专员确定好预订的信息；门市工作时间：周一至周日，9:00-18:00（如遇国家法定节假日，请与客服专员提前联系）。</p>',0,1342837854,0,''),(57,0,42,'关于门市签约',4,'<p>门市签约后多久能收到酒店的回复呢？&nbsp; <br />\r\n&nbsp;&nbsp;&nbsp; 您好一般门市签约后3--5天得到酒店的书面（PDF）回复，书面回复由旅行社转交顾客</p>\r\n<p>预定成功后怎么跟酒店确认预定信息呢？<br />\r\n&nbsp;&nbsp;&nbsp; 预定成功后顾客可以通过邮件和电话跟酒店进行预定信息确认。</p>\r\n<p>门市可以提供发票和收据么？<br />\r\n&nbsp; 您好在签约付款后 我们会给你出示 正规收据 发票我们将在您出行回来以后一个月内开出 。</p>',0,1342837855,1342837924,''),(58,0,43,'如何获取发票？',12,'<p>发票怎么给我？<br />\r\n&nbsp;您好，您出行回来 一个月内出具正式发票 拿收据 换发票 可以提供地址给你快递.</p>\r\n<p>发票和收据可以开什么项目？<br />\r\n&nbsp;&nbsp; 您好，发票的项目可以开旅游费 团款 会议费 考察费 代收航空票款 代收房费 代收租车费 综合服务费 签证费</p>',0,1342837945,1342838046,'on,0,1,2,3,4,5,6,7,8,9,10'),(59,0,44,'关于护照',6,'<p>1、我现在没有护照能预定么？<br />\r\n可以，但是您需在出行前10天内，正确提交您的护照信息，根据出行线路的不同，提交时间会有所不同，详细请您咨询*******<span style=\\\"color: #ff0000\\\">提示</span>：国内旅游需要您的身份证，港澳旅游需要您自行办理港澳通行证及有效签注，台湾旅游需要您办理台湾往来通行证，出境旅游需要您办理护照，以上都为报名时持有的基本证件。<br />\r\n2、护照、签证、港澳通行证、入台证等的办理。护照、港澳通行证要在户口所在地的出入境管理中心办理，具体可以拨打电话咨询。入台证要拿着旅行社开具的参团发票去出入境管理中心办理。签证适由大使馆签发，由于各国大使馆要求不一样，所以请在参团时咨询客服人员。<br />\r\n3、办理护照或者签证需要多久呢<br />\r\n您好，办理护照需要15个有效工作日，办理签证会根据目的地不同时间也不一样，详情可以咨询顾问。<br />\r\n4、护照的有效期是多久？<br />\r\n您好根据相关规定护照不是永久性的证件, 都有一定的有效期限。护照在有效期内是具有法律效力的证明,即为有效护照,否则即为无效护照,不具备法律效力。我国的护照有效期是10年。<br />\r\n5、空白护照可以出境旅游么？<br />\r\n您好，如无特别注明空白护照也是可以出境的，您可以放心报名。<br />\r\n&nbsp;</p>',0,1342838106,1348900420,'1,2'),(60,0,45,'行程中常见问题',5,'<p>1.出境旅游需要带多少美金？<br />\r\n您好，由于出境旅游目的地的不同和自身的情况不同都会有差别，您可以告知顾问你的情况，顾问会给出一个符合您自身情况的建议。<br />\r\n2.每个人携带的美金上限是多少<br />\r\n按照规定，中国居民因私旅游可以携带等值5000美元的外汇出境。如果携带金额超过5000美元，小于10000美元的可以在银行办理外汇携带证明。 据了解，在银行办理外汇携带证明并不困难。<br />\r\n3.国外刷卡有没有手续费呢？手续费的标准时怎么样的。<br />\r\n您好，海外刷卡手续费包含了两种费用，一种由信用卡国际组织收取，一种是付给银行的手续费。VISA和MasterCard目前都是收1%，American Express是1.5%，只有JCB完全不收取任何费用，但发卡银行是否对持卡人收费，则授权给各发卡银行自行决定。<br />\r\n4.如果想在国外购物银联的卡可以用么？<br />\r\n您好，一般出境旅游的话我们建议您携带国际信用卡（VISA、MASTER、JCB。）但是有些地方不接受JCB因此我们建议携带前两种出境。<br />\r\n旅行中行李丢失了怎么办？<br />\r\n外出旅行，一定要保管好随身物品。如果在机场丢了行李，应携带行李证和航空票到该航空公司的&quot;行李遗失处理柜台&quot;填写遗失申请书，向航空公司申请遗失期间的日用品购买费用，大约的标准是每日一件，记着要确认对方调查到何时、何时可以申请损害赔偿等。　　一般来说，航空公司对于行李遗失、迟到或损毁，除乘客预先申报较高之价值并预付额外之保值费用外，皆有赔偿限额。　　大多数的国际旅程（包括国际旅行中的国内行程部分），托运行李的赔偿限额约为每公斤２０美元；随身行李的赔偿限额为每位乘客４００美元；不过，若干航空公司对于易损、贵重或易腐烂物品一概不负赔偿责任。详细资料，应向航空公司咨询，航空票上亦会印有简则。　　行李在飞机或机场上遗失或被窃，可以向航空公司申请赔偿，若在酒店的保险箱遗失，酒店只会赔偿与失物等价的金额。不过，在酒店房间遗失的话，一般不会有赔偿。<br />\r\n&nbsp;<br />\r\n6.中途转机我们的行李怎么办<br />\r\n&nbsp;您好，您中途转机行李可以一次托运到目的地<br />\r\n&nbsp;7.在旅游途中护照丢失该如何处理<br />\r\n&nbsp;您好，如果您在履行途中护照丢失应该联系当地中华人民共和国大使馆或者办事处寻求帮助，同时要告知我们，我们会协助处理<br />\r\n&nbsp;8.旅行中出现生病和一些突发状况该如何应对<br />\r\n&nbsp; 您好如果您在，旅行中出现生病如果确实无法继续行程可以提前借宿行程就近就医。同时要告知我们，我们会告知家人 并协助处理<br />\r\n9.不宜乘飞机的人有哪些？<br />\r\n飞机是当今较理想的交通工具，随着人们生活水平的提高，出差、旅游、探亲、访友等乘飞机的人越来越多。但医学研究认为，以下人不宜乘飞机。一、传染性疾病患者。如传染性肝炎、活动期肺结核、伤寒等传染病患者，在国家规定的隔离期内，不能乘坐飞机。其中水痘病人在损害部位未痊愈，不能乘飞机。二、精神病患者。如癫痫及各种精神病人，因航空气氛容易诱发疾病急性发作，故不宜乘飞机。三、心血管疾病患者。因空中轻度缺氧，可能使心血管病人旧病复发或加重病情，特别是心功能不全、心肌缺氧、心肌梗塞及严重高血压病人，通常认为不宜乘飞机。四、脑血管病人。如脑栓塞、脑出血、脑肿瘤这类病人，由于飞机起降的轰鸣、震动及缺氧等，可使病情加重，禁止乘飞机。五、呼吸系统疾病患者。如肺气肿、肺心病等患者，因不适应环境，如果有气胸、肺大炮等，飞行途中可能因气体膨胀而加重病情。六、做过胃肠手术的病人，一般在手术十天内不能乘坐飞机。消化道出血病人要在出血停止三周后才能乘飞机。七、严重贫血的病人。血红蛋白量水平在５０克/升以下者，不宜乘飞机。八、耳鼻疾病患者。耳鼻有急性渗出性炎症，及近期做过中耳手术的病人，不宜空中旅行。九、临近产期的孕妇。由于空中气压的变化，可能致胎儿提早分娩，尤其是妊娠３５周后的孕妇，更不宜乘飞机。<br />\r\n旅行中常见药物有哪些？<br />\r\n分 类&nbsp; 药 名&nbsp; 作 用&nbsp; 注意事项&nbsp; 呼吸系统常用药物 速效伤风胶囊 清热解毒、用于感冒发热 轻度嗜睡 六神丸 消肿解毒、用于急性扁桃体炎、咽炎等 孕妇禁服 消化系统常用药物 胃舒平 抗酸、保护溃疡面，用于胃溃疡、胃酸过多、胃痛等 青光眼患者禁服 胃复安 止吐、消除胃涨 避光保存 抗过敏、预防运动症药 物 扑尔敏 过敏性疾病、伤风流涕、药物过敏等 轻度嗜睡 乘晕宁 镇吐、防晕，用于孕妇、运动症 行前半小时服 止痛药 牙痛一粒丸 治牙痛 填牙痛处 防暑药 仁丹 防暑 　 外用药 创可贴 止血、防止创口发炎 贴于创口面 紫药水 杀菌，用于皮肤、粘膜感染及溃疡 涂于创口面 另：哮喘、冠心病患者应随身携带应急药物；如硝酸甘油片等。&nbsp;<br />\r\n11.到达目的地后会有人接送么？<br />\r\n您好，您到达目的地后会有专门的工作人员接送的，您不用担心。<br />\r\n12.如果没人接送我们该如何应对？<br />\r\n您好，如果您到达之后没有人接机的话，您可以跟我们出团通知上面的紧急联系人联系，我们会在第一时间去处理。<br />\r\n13.在国外旅游目的地遭到歧视如何处理？<br />\r\n您好，我们国家的综合实力上升很快，所以在国外遭受歧视的情况稍有发生，如果发生了此类事件的话，您应当即时和当地大使馆或驻当地办事处联系，同时也要告知我们，进行进一步的处理。<br />\r\n11.***（目的地）的民俗和民风怎么样呢？<br />\r\n您好因为目的地的不同，当地的风俗业不一样，因此您可以根据自己的目的地来咨询顾问。<br />\r\n如果出现酒店超售该怎么办呢？<br />\r\n您好，一般情况下酒店是不会超售的，但是不幸发生了超售的情况的话，我们会在第一时间进行三方（游客 酒店 旅行社）协商处理。<br />\r\n15.如果酒店和餐标和合同描述不相符怎么办？<br />\r\n您好，如果酒店和餐标和合同描述不相符，您可以跟旅行社进行协商处理，如处理不满意您可以向上级部门进行投诉维权。<br />\r\n16.酒店的服务员需要给小费么？<br />\r\n您好，如果您对服务生的服务满意的话您可以给他一些消费，对他的工作给予肯定。<br />\r\n17.东西忘在国外酒店怎么办？<br />\r\n您好，如果您不小心行李和重要物品落在酒店，您可以直接联系酒店进行沟通解决，也可以告知我们，由我们和酒店进行沟通。<br />\r\n售后以及退款。<br />\r\n退款退团政策。<br />\r\n退团、退款政策<br />\r\n周边旅游线路退款、退团政策出发前不足4天（不含双休日及法定假日）的，提出退订、人数减少或其它项目改变，将根据实际情况收取车位损失费用，退还扣除车位损失的剩余团款；特殊人群如有门票优惠政策（以当地政策为准），您可持有相关证件，由导游协助在景区门口做相应退款。行程中如您自愿取消部分景点，将不退还相应费用。赠送项目如不能成行，不做任何退款。如有需要，请与导游或中国国旅旅游网客服专员确认相关事宜 国内长线退款、退团政策以下情况可全额退款：出发日期7日以外（周末、节假日等旅游旺季除外），或因旅行社原因不能成团。以下情况可部分退款：出发日期3日以外、不足7日的，扣除航空票损失及代办业务等各项已产生费用；出发日期1日以外、不足3日的，扣除航空票全款及代办业务等各项已产生费用；行程中因老年证、军官证、学生证、教师证等证件产生优惠的，将退还成本价与优惠价之间差额；行程中所含景点、用餐、住宿等项目如不参加需提前告知导游，未产生的费用当地现退；因不可抗力因素或者您自身原因造成行程不能进行，未产生的费用当地现退。以下情况不退款：出发前1日以内退团，费用不退；项目如遇天气、航班时间等不可抗力因素不能成行，费用不退；航空票为团队折扣票，开票后不得签转、更改、退票。旅游者未能按照合同约定及时参加旅游项目或未能及时搭乘交通工具的，视为自愿放弃，费用不退；<br />\r\n海南、云南等地由于当地旅游接待费用的特殊性，以下情况费用不退：云南的常规团，老年证、军官证、学生证、教师证等证件无效；丽江段大玉龙景区含：玉龙雪山进山费、玉水寨、玉峰寺、玉柱擎天、东巴谷、东巴万神园、东巴王国，以上6个景点为套票赠游景点，行程中因游览时间不够的原因，除玉水寨外，其他景点不作游览，费用无法退还，所有证件发生的优惠也一律不退；因当地旅游局规定团队必须制卡操作，退餐必须提前二天以上，否则不予退费；若您自愿取消行程或中途离团，一律视为自动放弃，车费、餐费、景点门票均无法退还；如因特殊情况需离团，需补收离团费100元/天/人，行程内任何优惠一律不退。<br />\r\n以上退款标准如遇周末、节假日等旅游旺季特殊情况，需按实际产生损失核计。<br />\r\n出境旅游线路退款、退团政策以下情况可全额退款：出发日期7日以外（周末、节假日等旅游旺季除外），因旅行社原因不能成团。以下情况可部分退款：签证被拒签，扣除签证办理所产生费用，退还剩余团款。（给旅行社造成损失的，还应当承担赔偿责任）以下情况不退款：支付订金以后，因客人个人原因取消者（包括报名后无法提供齐全的有效证件、签证材料者；签证完毕后不能根据要求支付相应的保证金者或无法在旅行社指定日期前支付团款及保证金者）订金不予退还，并承担其他相关损失费用；赠送项目如遇天气、航班时间等不可抗力因素不能成行，费用不退；旅游者未能按照合同约定及时参加旅游项目或未能及时搭乘交通工具的，视为自愿放弃，费用不退。<br />\r\n2.退款方式；<br />\r\n退款到账时间：<br />\r\n退款方式&nbsp;退款到账时间&nbsp;如超过退款到账时间仍未到账可咨询<br />\r\n现金&nbsp;3个工作日内&nbsp;北京青年旅行社超凡假期客人专属客服顾问<br />\r\n对私汇款&nbsp;7个工作日内&nbsp;退款信息中银行的客服电话/北京青年旅行社超凡假期客人专属客服顾问<br />\r\n对公汇款&nbsp;7个工作日内&nbsp;7个工作日内<br />\r\n刷卡&nbsp;借记卡：财务完成退款后的5-7个工作日信用卡：财务完成退款后的7-15个工作日&nbsp;95516银联客服电话（除中行和工行外的退款都可以查询是否退到客人的开户行）<br />\r\n北京青年旅行社超凡假期客人专属客服顾问<br />\r\n在线支付（支付宝/淘宝网店支付）&nbsp;客人使用支付宝账户里的钱付款的财务完成退款后款项即时到客人的支付宝账户&nbsp;0571-88156688 支付宝客服中心/北京青年旅行社超凡假期客人专属客服顾问<br />\r\n&nbsp;客人使用银行卡通过支付宝平台付款的按银行卡的退款流程操作借记卡：财务完成退款后的5-7个工作日 信用卡：财务完成退款后的7-15个工作日&nbsp;&nbsp;<br />\r\n说明：我司财务完成退款时间为7个工作日内<br />\r\n3.维权投诉及建议投诉、建议请拨打北京青年旅行社股份有限公司 客服电话：********，我们的客服人员会记录并受理。<br />\r\n&nbsp;</p>',0,1342838228,1342838239,''),(61,0,46,'单房差是什么？',1,'<p class=\\\"paragraph\\\"><span style=\\\"font-size: larger\\\"><span style=\\\"font-family: Tahoma\\\">因旅游过程中的住宿一般是标准间，即两个床位，如果您的出游人数（成人）为奇数时，有可能需要补足另外一个床位的费用。您也可以选择接受与其他人拼房，当无法拼房时再补单房差。</span></span></p>',0,1348889562,0,'1,2'),(62,0,47,'如何办理护照',9,'<p>&nbsp;</p>\r\n<h3>1.1.首次申请护照办理流程</h3>\r\n<p>首次申请护照必须本人到户籍所在地的公安局出入境管理处办理，军人在部队或工作单位驻地的公安局出入境管理处办理。关于在外地上学、工作是否可就近在学校、工作单位所在地办理，可向当地公安局出入境管理处咨询办理方法。</p>\r\n<h3>1.2.申请护照材料准备：</h3>\r\n<p>&nbsp;1)2寸近期正面免冠彩色照片2张，国家公职人员不着制式服装，儿童不系红领巾，背景色以各地出入境管理处规定为准;</p>\r\n<p>2)已满16周岁的居民携带本人户口簿(集体户口提交《常住人口登记表》)、居民身份证(或者临时身份证);</p>\r\n<p>3)未满16周岁的居民携带本人户口簿(集体户口提交《常住人口登记表》)、其监护人居民身份证原件以及能证明监护关系材料的原件(如户口簿、出生证等)，并由其监护人陪同前往办理;</p>\r\n<p>4)部队院校在读无军籍学员还须提交所在院校出具的无军籍证明;</p>\r\n<p>5)军人携带军官证(或者离退休证)、部队《因私事出国(境)人员审查批件》原件，所在部队须在《中国公民因私出国申请审批表》上出具意见并盖章，负责人要亲笔签名确认;</p>\r\n<p>6)出示单位意见人员证明。</p>\r\n<h3>1.3.凡属于登记备案的国家工作人员申办因私护照必须由单位在《中国公民因私出国申请审批表》上出具意见，负责人签名并加盖公章，具体人员范围如下：</h3>\r\n<p>1)各级党政机关、人大、政协、人民法院、人民检察院、人民团体、事业单位在职的县(处)级以上的领导干部，离(退)休的厅(局)级以上干部;</p>\r\n<p>2)金融机构，国有企业的法人代表，金融机构分支行(分支公司)以上领导成员及其相应职级的领导干部，国有大中型企业中层以上管理人员，国有控股企业中的国有股权代表;</p>\r\n<p>3)中国人民解放军军人、人民武装警察(含离退休人员);</p>\r\n<p>4)各部门、行业中涉及国家安全及国有资产安全、行业机密人员;</p>\r\n<p>5)其他在公安机关出入境管理部门登记备案的人员;</p>\r\n<p>注：申请出入境证件时，如居民身份证在领取、换领、补领期间应提交临时居民身份证。</p>\r\n<p>携带上述材料去户籍所在地的公安局出入境管理处填写《中国公民因私出国申请审批表》、复印相关证明材料、拍照照相(须穿深色衣服)</p>\r\n<p>注：《中国公民因私出国申请审批表》也可到公安局出入境管理处网站下载、打印、填写。</p>\r\n<h3>1.4.申请材料递交：</h3>\r\n<p>将填写好的贴好照片的申请表格和所需材料递交到受理窗口，待工作人员审核完毕后，领取《因私出国(境)证件申请回执》单，核对回执单内容确认无误后签名</p>\r\n<h3>1.5.缴费：</h3>\r\n<p>申请人在递交完申请后须立即持《因私出国(境)证件申请回执》到收费处交费 (申请人须在受理当日交费。未按时限交费，领取证件日期将另行通知。若申请后一个月内未交费，视为自动放弃申请，申请材料不再退还本人)。</p>\r\n<h3>1.6. 办理时限：</h3>\r\n<p>&sect; 北京：市局出入境管理处、东城分局、西城分局、崇文分局、宣武分局、朝阳分局、海淀分局、丰台分局、石景山分局、通州分局、顺义分局、昌平分局、大兴分局、门头沟分局、房山分局、平谷分局为7个工作日;怀柔分局、密云县局和延庆县局为10个工作日;取证日期自递交申请后第二个工作日开始计算。</p>\r\n<p>&sect; 上海：10个工作日</p>\r\n<p>&sect; 南京：自受理之日起15日内办结</p>\r\n<p>&sect; 天津：受理交费之日起10个工作日</p>\r\n<p>&sect; 杭州：自收到申请材料之日起15日</p>\r\n<p>&sect; 苏州：15个工作日</p>\r\n<p>&sect; 深圳：15日</p>\r\n<p>&sect; 成都：15个工作日</p>\r\n<p>&sect; 武汉：自受理之日起15日内</p>\r\n<p>&sect; 重庆：受理申请后5个工作日内办结(需要核查或调查的时间不计算在内)</p>\r\n<h3>1.7.护照领取</h3>\r\n<p>&sect; 本人领取：申请人本人须按照《因私出国(境)证件申请回执》上注明的取证日期或出入境管理部门通知的取证日期按时领取证件。取证当日，申请人本人凭《因私出国(境)证件申请回执》及缴费收据，并携带居民身份证或户口簿，到受理申请的出入境接待大厅领取证件。领取证件后，请仔细核对证件内容，发现差错，及时改正。</p>\r\n<p>&sect; 他人代领：代领人携带《因私出国(境)证件申请回执》、本人身份证、护照申请人身份证复印件到出入境管理处领取护照。</p>\r\n<p>&sect; 快递上门：若想选择快递上门，须在办理护照当天凭《因私出国(境)证件申请回执》到出入境管理处内的邮政速递柜台办理手续并缴纳快递费。快递范围以当地出入境管理处的规定为准。</p>\r\n<p>办理签证前请在护照最后一页的持证人签名栏用黑色签字笔签署本人姓名</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>',0,1348891046,1348900265,'on,0,1,2,3,4,5,6,7,8,9,10'),(63,0,48,'能不能脱团自己玩？',5,'<p>1. 针对出境、国内云南、海南、东北(太原、青岛、长沙、重庆、成都出发)、华东旅游线路，出于对您安全的考虑，除行程中已经安排的自由活动时间外，须在规定的范围内活动，不得离团，如果您需要更多的自由活动时间，请考虑自助游业务。</p>\r\n<p>2. 针对国内(除1中的方向)、深圳到港澳旅游线路，您预订的是跟团旅游打包产品，若中途离团，未发生的费用无法单独核算退还;在您离团前需同导游签署离团协议。</p>',0,1348900606,0,'1,2'),(64,0,49,'签订旅游合同',1,'<p> </p><p><span style=\\\"font-size:\\\\\\\\&quot;\\\\&quot;\\\"><strong>1.书面签署：</strong></span></p><p>1.1.门店：您可以到悠哉旅游网指定报名网点进行付款并签署合同。</p><p>1.2.传真：我们把盖章后的合同传真或扫描件发邮件给您，在合同发送后24小时内或我司要求时间内，您签字回传后合同即时生效。</p><p><span style=\\\"font-size:\\\\\\\\&quot;\\\\&quot;\\\"><strong>2.网上签署：</strong></span></p><p>如您在我司网站支付费用，在您付费前可阅读合同条款、补充条款等内容，在您选择&quot;阅读并接受以上合同条款、补充条款、保险条款和其他所有内容&quot;并付费后，视为双方默认合同实际履行。</p><p><span style=\\\"font-size:\\\\\\\\&quot;\\\\&quot;\\\"><strong>3.其他方式：</strong></span></p><p>如您在我们合同发送后24小时或我司要求时间内，无法与我们书面往来确认合同，我们提供电话、短信或电子邮件等方式进行确认;您付费后，视为双方默认合同实际履行。</p><p><strong><span style=\\\"font-size:\\\\\\\\&quot;\\\\&quot;\\\">4.关于订单修改、退团、退款问题</span></strong></p><p>如果您提交订单后需要修改或取消订单，请与我们的客服专员联系。订单一旦付款成功后有任何的变更或取消，我们将按合同约定办理退团及退款。采用现金支付的客人，将退还现金。采用银行转账或支付宝支付的客人，一般在3至7个工作日内，将相关款项退回原账户。采用信用卡支付的客人，一般在5至10个工作日内，将通过信用卡将款项退回原卡。因个人原因修改或取消订单，办理退款时产生的相关手续费，请客人自理(包括跨行转账手续费、支付宝所扣除手续费等等)。</p>',0,1348900936,0,'1,2,3,5,8'),(67,3,1,'对于支付团款的建议',1,'<p>&nbsp;<span style=\\\"color: rgb(70, 70, 70); font-size: 14px; line-height: 25px; text-align: left; \\\">1、建议使用个人银行帐户：</span></p>\r\n<p style=\\\"margin: 0px; padding: 0px; color: rgb(70, 70, 70); font-size: 14px; line-height: 25px; text-align: left; \\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 相对于公帐，个人帐户灵活方便，提供多家银行帐户，可减少客户跨行转帐手续费用；支持网银转帐/ATM机转帐/银行柜台转帐等方式；相较于公帐1～3天的到帐日期，同一银行的个人银行转帐能即时到帐，不会产生打了定金不能及时确定出团计划的风险；</p>\r\n<p style=\\\"margin: 0px; padding: 0px; color: rgb(70, 70, 70); font-size: 14px; line-height: 25px; text-align: left; \\\"><span style=\\\"margin: 0px; padding: 0px; \\\">2、使用公司账户付款：</span>如果您所交定金在壹万元以上并且预订时间在10天以上，您又是公司帐户，我们建议您汇入我社公司账户。</p>\r\n<p style=\\\"margin: 0px; padding: 0px; color: rgb(70, 70, 70); font-size: 14px; line-height: 25px; text-align: left; \\\"><span style=\\\"margin: 0px; padding: 0px; \\\">3、支付方式：</span></p>\r\n<p style=\\\"margin: 0px; padding: 0px; color: rgb(70, 70, 70); font-size: 14px; line-height: 25px; text-align: left; \\\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (1)提前10天以内预定，金额在10000以内请汇入个人帐户；<br style=\\\"margin: 0px; padding: 0px; \\\" />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (2)采用支付宝账户：<br style=\\\"margin: 0px; padding: 0px; \\\" />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (3)提前10天以上预定，金额达到10000以上请使用公帐汇款。</p>',NULL,1382693532,NULL,'1,2,3');

/*Table structure for table `sline_help_kind` */

DROP TABLE IF EXISTS `sline_help_kind`;

CREATE TABLE `sline_help_kind` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(2) DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL COMMENT '帮助分类名称',
  `litpic` varchar(255) DEFAULT NULL COMMENT '标识图片',
  `displayorder` int(11) unsigned DEFAULT NULL COMMENT '显示顺序',
  `isopen` int(1) unsigned DEFAULT '1' COMMENT '是否启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='帮助类型分类表';

/*Data for the table `sline_help_kind` */

insert  into `sline_help_kind`(`id`,`webid`,`aid`,`kindname`,`litpic`,`displayorder`,`isopen`) values (9,0,1,'预订常见问题','',0,1),(10,0,2,'付款方式','',0,1),(11,0,3,'签订合同','',0,1),(12,0,4,'其它问题','',0,1),(14,3,1,'关于付款','',0,1),(15,3,2,'关于品质','',0,1);

/*Table structure for table `sline_hotel` */

DROP TABLE IF EXISTS `sline_hotel`;

CREATE TABLE `sline_hotel` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webid` int(3) NOT NULL DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `seotitle` varchar(100) DEFAULT NULL COMMENT 'seo标题',
  `sellpoint` varchar(255) DEFAULT NULL COMMENT '卖点',
  `hotelrankid` int(6) DEFAULT NULL,
  `telephone` varchar(13) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `postcode` int(6) DEFAULT NULL,
  `content` longtext,
  `address` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `shownum` int(11) DEFAULT NULL,
  `addtime` int(11) unsigned DEFAULT NULL,
  `modtime` int(11) unsigned DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` longtext,
  `tagword` varchar(255) DEFAULT NULL,
  `litpic` varchar(100) DEFAULT NULL COMMENT '封面图片',
  `kindlist` varchar(255) DEFAULT NULL,
  `themelist` varchar(255) DEFAULT NULL,
  `attrid` varchar(255) DEFAULT NULL,
  `ishidden` int(3) DEFAULT '0',
  `traffic` text,
  `aroundspots` text,
  `notice` text,
  `equipment` text,
  `piclist` text,
  `opentime` varchar(255) DEFAULT NULL COMMENT '开业时间',
  `decoratetime` varchar(255) DEFAULT NULL COMMENT '装修时间',
  `iconlist` varchar(255) DEFAULT NULL,
  `satisfyscore` int(11) DEFAULT NULL COMMENT '满意度',
  `bookcount` varchar(5) DEFAULT NULL COMMENT '预订数量',
  `supplierlist` varchar(255) DEFAULT NULL,
  `templet` varchar(255) DEFAULT NULL,
  `recommendnum` int(11) DEFAULT '0',
  `lng` varchar(50) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `fuwu` text,
  PRIMARY KEY (`id`),
  KEY `IDX_AID` (`aid`) USING BTREE,
  KEY `IDX_HOTELPRICE_WEBID` (`price`,`webid`) USING BTREE,
  KEY `IDX_WEBID` (`webid`) USING BTREE,
  KEY `IDX_HOTELRANKID_WEBID` (`hotelrankid`,`webid`) USING BTREE,
  KEY `IDX_MO_AD_HO_WE` (`modtime`,`addtime`,`hotelrankid`,`webid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_hotel` */

insert  into `sline_hotel`(`id`,`webid`,`aid`,`title`,`seotitle`,`sellpoint`,`hotelrankid`,`telephone`,`postcode`,`content`,`address`,`price`,`shownum`,`addtime`,`modtime`,`keyword`,`description`,`tagword`,`litpic`,`kindlist`,`themelist`,`attrid`,`ishidden`,`traffic`,`aroundspots`,`notice`,`equipment`,`piclist`,`opentime`,`decoratetime`,`iconlist`,`satisfyscore`,`bookcount`,`supplierlist`,`templet`,`recommendnum`,`lng`,`lat`,`fuwu`) values (1,0,1,'九寨沟红宝石大酒店','九寨沟红宝石大酒店','富丽堂皇的奢华享受!',3,'028-6652382',NULL,'<p style=\"text-align: center;\">&nbsp;<img title=\"\" alt=\"\" src=\"/uploads/2015/0909/b7a4bbee66395c165e9bd247dd73965d.png\"/></p><p>　　九寨沟红宝石大酒店是一家准四星级宾馆，截止2010年10月酒店为挂三星级标准，酒店坐落于世界著名自然遗产九寨沟风景区，距景区两公里。红宝石大酒店所处地理位置优越、环境优美、依山傍水、景色秀丽，是休闲度假、消遣娱乐、旅游观光的理想下塌之处。</p><p>&nbsp;</p><p><br/>&nbsp;　　红宝石大酒店外观气势恢宏，店内清爽高雅，具有浓郁的藏羌风情和源源流长藏族历史文化氛围。</p><p style=\"text-align: center;\">&nbsp;<img title=\"\" alt=\"\" src=\"/uploads/2015/0909/548a005929307ce5bd29629e7053fdb9.png\"/></p><p>　　红宝石大酒店拥有各类豪华贵宾间，豪华标准间220间，标准间50间，中式客房温馨舒适，内设中央空调、国际卫星闭路电视、全自动消防喷淋系统、IC电子门锁系统等现代化设施，布局典雅、大方、美观、集现代化风格与民族特色于一体。</p><p>&nbsp;</p><p><br/>&nbsp;　　红宝石大酒店拥有可供400人同时就餐的宴会厅、中餐厅及雅间等，九寨特色餐饮美味可口，可提供川、粤和当地各种无污染野生菌类等精制菜肴数百余品。&nbsp; <br/>　　<br/>&nbsp;　　红宝石大酒店以&amp;ldquo;宾客至上、服务第一&amp;rdquo;为服务宗旨，竭诚为中外宾客提供尽善尽美的服务。&amp;ldquo;有朋自远方来，不亦乐乎&amp;rdquo;，九寨沟红宝石大酒店笑迎八方佳宾.​</p>','hhhh',1080,NULL,1441794549,1442905011,'红宝石','红宝石','九寨沟红宝石大酒店','/uploads/2015/0910/96d1fc1ab489db3856019958e1124bd7.png','36,38,40',NULL,NULL,0,NULL,NULL,NULL,NULL,'/uploads/2015/0910/96d1fc1ab489db3856019958e1124bd7.png,/uploads/2015/0910/de1238074f702b09d7284f816eae6091.png','2010年','2010年','1',90,'60',NULL,'',0,NULL,NULL,NULL),(2,0,2,'九寨沟星宇国际大酒店','','宾至如归的温馨酒店',3,'028-6652382',NULL,'<p>　　星宇国际大酒店座落于素有&amp;ldquo;人间仙境&amp;rdquo;美誉的世界级自然风景区&amp;mdash;九寨沟。酒店占地23亩，建筑面积23170平方米，距沟口仅1.5公里，外观造型独具藏式宫廷建筑特色。居停其间，可环眺一年四季变幻莫测的群山风光，并可尽享国际四星级酒店（待评）之特色服务。<br/>　　酒店由一、二、三号楼组合而成。一、三号楼为客房，均为四层楼。一号楼有客房78间，并拥有美容美发厅、足浴房、商务中心、购物中心等设施；三号楼有客房115间；二号楼为中餐厅、多功能宴会厅、会议室、民族歌舞表演厅。</p><p style=\"text-align: center;\"><img title=\"\" alt=\"\" src=\"/uploads/2015/0909/6d3c8056748b059e58ec7ed8bd30b10c.png\"/></p><p>　　酒店拥有各式豪华、标准客房共193套，其中标准间190套，普通套间2套，豪华套间1套；特色餐厅可同时容纳400人就餐，能为您提供正宗川、粤、藏式等多种精美菜式；大型民族歌舞表演厅，能同时容纳300人观看演出，让您感悟藏羌风情文化；酒店还拥有能容纳300人的多功能宴会厅和容纳100人的商务会议室，为您提供各类会议、培训、商务洽谈服务。</p><p style=\"text-align: center;\"><img title=\"\" alt=\"\" src=\"/uploads/2015/0909/0c2a794dce15465b654ae4226e679a9a.png\"/></p><p style=\"text-align: center;\">　　酒店通讯设施设备先进、服务配套，可提供商务中心、民俗风情购物中心、酒吧、棋牌、美容美发、保健按摩、足浴、彩扩、图书借阅、票务代理等各项服务。<br/>　　酒店服务专案齐全，为您提供预订、结帐、留言、大堂副理、礼宾、邮件、客房送餐等服务！<br/><img title=\"\" alt=\"\" src=\"/uploads/2015/0909/fb17b7e3060474e38d30184e26c49ef4.png\"/></p>','',1680,NULL,1441796648,1441870946,'','','','/uploads/2015/0910/45efa2adae3fd15fd1914a905cfadbe8.png','36,38,40',NULL,NULL,0,NULL,NULL,NULL,NULL,'/uploads/2015/0910/45efa2adae3fd15fd1914a905cfadbe8.png,/uploads/2015/0910/d53e4c89ec1f1d6575ef9be1d4f31cb2.png','2010年','2010年',NULL,90,'500',NULL,'',0,NULL,NULL,NULL),(3,0,3,'九寨沟山河国际大酒店','','舒适的环境，全方位高品质的服务',5,'4006-0999-27',NULL,'<p>&nbsp;九寨沟山河国际大酒店是九寨沟风景区首家国际五星级酒店，地处川西高原，坐落于九寨沟的碧水青山之间。以阳光、绿野、民风和宾至如归的温情服务，将大自然的瑰丽风光与藏羌风情、人文氛围完美融合，是中外宾客旅游观光和度假休闲的理想下榻之处。</p><p><img src=\"/uploads/2015/0923/32fb73145736d271318cd1fec809ddb1.jpg\" alt=\"\" title=\"\" style=\"width: 629px; height: 361px;\"/></p><p>酒店总建筑面积6万余平方米，餐饮、娱乐、会议、休闲、购物设施齐备。酒店拥有各类客房，视野开阔，房间内布置精美。另设有无烟楼层和残疾人士专用客房。风格各异的餐厅和酒吧为客人提供各种中西式美味佳肴。这里有源于古老文明的标志塔，世界级的十二生肖艺术广场，神秘奔放的藏羌民族歌舞晚会。每位光临人间仙境的来宾，在这里都将享有一个美丽温暖的家。&nbsp;</p><p>酒店开业时间2015年，2014年全面装修，东楼高6层，西楼高5层，客房总数482间（套）。&nbsp;</p><p><img src=\"/uploads/2015/0910/45efa2adae3fd15fd1914a905cfadbe8.png\" alt=\"\" title=\"\" style=\"width: 627px; height: 319px;\"/>​</p><p><br/></p>','九寨沟风景区',999,NULL,1442989866,1443442173,'','','','/uploads/2015/0923/298c188644bc41b60f00e86528b3f69a.jpg','36,38,40',NULL,NULL,0,'<p><span style=\"color: rgb(85, 85, 85); font-family: arial, Verdana, Geneva, Helvetica; font-size: 12px; line-height: 20px;\">酒店地处川西高原，步行可至边边街，邻近九寨沟沟口，地理位置优越。</span></p>','<p>九寨沟风景区</p>','<p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">酒店电话<br style=\"padding: 0px; margin: 0px;\"/></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">总台电话：4006-0999-27</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">酒店地址</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">九寨沟 樟扎镇 甘海子</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">特别优惠</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">连住三晚送梦幻九寨晚会票一张</p><p><br/></p>',NULL,'/uploads/2015/0923/32fb73145736d271318cd1fec809ddb1.jpg,/uploads/2015/0923/298c188644bc41b60f00e86528b3f69a.jpg','2015年1月','2014年8月','1',100,'625',NULL,'',0,'116.453137','39.949459',NULL);

/*Table structure for table `sline_hotel_attr` */

DROP TABLE IF EXISTS `sline_hotel_attr`;

CREATE TABLE `sline_hotel_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(1) unsigned DEFAULT '0',
  `attrname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `displayorder` int(11) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `issystem` int(1) unsigned DEFAULT '0',
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_PID_ID` (`pid`,`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8 COMMENT='车务品牌表';

/*Data for the table `sline_hotel_attr` */

insert  into `sline_hotel_attr`(`id`,`webid`,`attrname`,`displayorder`,`isopen`,`pid`,`issystem`,`destid`,`litpic`,`description`) values (190,0,'品牌',9999,1,0,0,NULL,NULL,NULL),(191,0,'品牌1',9999,1,190,0,NULL,NULL,NULL),(200,0,'连锁酒店',9999,1,0,0,NULL,NULL,NULL),(201,0,'七天连锁',9999,1,200,0,NULL,NULL,NULL),(202,0,'特色服务',9999,1,0,0,NULL,NULL,NULL),(203,0,'叫醒服务',9999,1,202,0,NULL,NULL,NULL),(204,0,'洗衣服务',9999,1,202,0,NULL,NULL,NULL),(205,0,'叫醒服务',9999,1,202,0,NULL,NULL,NULL),(206,0,'免费停车',9999,1,202,0,NULL,NULL,NULL);

/*Table structure for table `sline_hotel_content` */

DROP TABLE IF EXISTS `sline_hotel_content`;

CREATE TABLE `sline_hotel_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '使用的字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL COMMENT '是否系统字段',
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isrealfield` int(1) unsigned DEFAULT '1' COMMENT '是否是真实字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类表';

/*Data for the table `sline_hotel_content` */

insert  into `sline_hotel_content`(`id`,`webid`,`columnname`,`chinesename`,`displayorder`,`issystem`,`isopen`,`isrealfield`) values (1,0,'content','酒店详细',2,1,1,1),(2,0,'fuwu','服务项目',3,1,1,1),(3,0,'traffic','交通指南',4,1,1,1),(4,0,'notice','注意事项',5,1,1,1),(5,0,'aroundspots','周边景点',6,1,1,1),(7,0,'tupian','酒店图片',6,1,1,0);

/*Table structure for table `sline_hotel_extend_field` */

DROP TABLE IF EXISTS `sline_hotel_extend_field`;

CREATE TABLE `sline_hotel_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  `e_engname` varchar(255) DEFAULT NULL COMMENT '酒店英文名',
  `e_newcontent` mediumtext COMMENT '新的测试',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='酒店字段扩展表';

/*Data for the table `sline_hotel_extend_field` */

/*Table structure for table `sline_hotel_kindlist` */

DROP TABLE IF EXISTS `sline_hotel_kindlist`;

CREATE TABLE `sline_hotel_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_KINDID` (`kindid`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COMMENT='ssmall线路分类总表';

/*Data for the table `sline_hotel_kindlist` */

insert  into `sline_hotel_kindlist`(`id`,`kindid`,`seotitle`,`keyword`,`description`,`tagword`,`jieshao`,`isfinishseo`,`displayorder`,`isnav`,`ishot`,`shownum`,`templetpath`) values (36,36,'','','','','',0,2,1,0,0,''),(37,37,'','','','','',0,3,1,0,0,''),(38,40,NULL,NULL,NULL,NULL,NULL,0,9999,0,1,NULL,NULL);

/*Table structure for table `sline_hotel_pricelist` */

DROP TABLE IF EXISTS `sline_hotel_pricelist`;

CREATE TABLE `sline_hotel_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL COMMENT 'WEBID',
  `aid` int(11) unsigned DEFAULT NULL,
  `min` int(11) DEFAULT NULL COMMENT '最小酒店价格',
  `max` int(11) DEFAULT NULL COMMENT '最大酒店价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=gb2312 ROW_FORMAT=FIXED;

/*Data for the table `sline_hotel_pricelist` */

insert  into `sline_hotel_pricelist`(`id`,`webid`,`aid`,`min`,`max`) values (1,0,NULL,0,500),(2,0,NULL,501,1000),(3,0,NULL,1001,2000);

/*Table structure for table `sline_hotel_rank` */

DROP TABLE IF EXISTS `sline_hotel_rank`;

CREATE TABLE `sline_hotel_rank` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webid` int(3) NOT NULL DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `hotelrank` varchar(255) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AID_WEBID` (`aid`,`webid`) USING BTREE,
  KEY `IDX_ORDERID` (`orderid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_hotel_rank` */

insert  into `sline_hotel_rank`(`id`,`webid`,`aid`,`hotelrank`,`orderid`) values (1,0,1,'一星级酒店',1),(2,0,2,'二星级酒店',2),(3,0,3,'三星级酒店',3),(4,0,4,'四星级酒店',4),(5,0,5,'五星级酒店',5),(6,0,6,'六星级酒店',6);

/*Table structure for table `sline_hotel_room` */

DROP TABLE IF EXISTS `sline_hotel_room`;

CREATE TABLE `sline_hotel_room` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webid` int(3) NOT NULL DEFAULT '1',
  `hotelid` int(11) DEFAULT NULL,
  `roomname` text,
  `price` int(11) unsigned DEFAULT NULL,
  `sellprice` int(11) unsigned DEFAULT NULL,
  `breakfirst` varchar(255) DEFAULT NULL,
  `computer` varchar(255) DEFAULT NULL,
  `otherprice` varchar(255) DEFAULT NULL,
  `displayorder` int(11) DEFAULT NULL,
  `otherroom` varchar(255) DEFAULT NULL COMMENT '暂时不用',
  `otherroomurl` varchar(255) DEFAULT NULL COMMENT '暂时不用',
  `nightdays` varchar(255) DEFAULT NULL COMMENT '暂时不用',
  `roomids` varchar(255) DEFAULT NULL COMMENT '暂时不用',
  `roomstyle` varchar(255) DEFAULT NULL COMMENT '床型',
  `roomarea` varchar(255) DEFAULT NULL COMMENT '房间面积',
  `roomfloor` varchar(255) DEFAULT NULL COMMENT '楼层',
  `roomwindow` varchar(255) DEFAULT NULL COMMENT '窗户',
  `piclist` text COMMENT '房间图片列表',
  `number` int(11) DEFAULT '0',
  `jifencomment` int(11) DEFAULT '0' COMMENT '评论送积分',
  `jifentprice` int(11) DEFAULT '0' COMMENT '积分抵现金',
  `jifenbook` int(11) DEFAULT '0' COMMENT '预订送积分',
  `paytype` int(1) unsigned DEFAULT '1' COMMENT '支付类型:1全额支付,2,定金支付 3,二次确认支付',
  `dingjin` varchar(255) DEFAULT NULL COMMENT '定金',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_hotel_room` */

insert  into `sline_hotel_room`(`id`,`webid`,`hotelid`,`roomname`,`price`,`sellprice`,`breakfirst`,`computer`,`otherprice`,`displayorder`,`otherroom`,`otherroomurl`,`nightdays`,`roomids`,`roomstyle`,`roomarea`,`roomfloor`,`roomwindow`,`piclist`,`number`,`jifencomment`,`jifentprice`,`jifenbook`,`paytype`,`dingjin`) values (1,1,1,'标准间',1080,1290,'早晚餐','WIFI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',NULL,'',0,2,1,10,1,''),(2,1,2,'标准间',1480,1680,'三餐','WIFI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'','',NULL,'',0,2,1,10,1,''),(3,1,3,'商务间',999,1099,'早餐','含',NULL,NULL,NULL,NULL,NULL,NULL,'大床2米','40','6','有窗','',2,2,1,10,1,'');

/*Table structure for table `sline_hotel_room_price` */

DROP TABLE IF EXISTS `sline_hotel_room_price`;

CREATE TABLE `sline_hotel_room_price` (
  `hotelid` int(11) NOT NULL,
  `suitid` int(11) NOT NULL DEFAULT '0' COMMENT '户型id',
  `day` int(11) NOT NULL DEFAULT '0',
  `profit` int(11) DEFAULT NULL,
  `basicprice` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL COMMENT '库存',
  UNIQUE KEY `suitid` (`suitid`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_hotel_room_price` */

insert  into `sline_hotel_room_price`(`hotelid`,`suitid`,`day`,`profit`,`basicprice`,`price`,`description`,`number`) values (1,1,1442160000,280,800,1080,'',-1),(1,1,1442246400,490,800,1290,NULL,NULL),(1,1,1442332800,280,800,1080,'',-1),(1,1,1442419200,490,800,1290,NULL,NULL),(1,1,1442505600,280,800,1080,'',-1),(1,1,1442592000,490,800,1290,NULL,NULL),(1,1,1442678400,280,800,1080,'',-1),(1,1,1442764800,490,800,1290,NULL,NULL),(1,1,1442851200,280,800,1080,'',-1),(1,1,1442937600,490,800,1290,NULL,NULL),(1,1,1443024000,280,800,1080,'',-1),(1,1,1443110400,490,800,1290,NULL,NULL),(1,1,1443196800,280,800,1080,'',-1),(1,1,1443283200,490,800,1290,NULL,NULL),(1,1,1443369600,280,800,1080,'',-1),(1,1,1443456000,490,800,1290,NULL,NULL),(1,1,1443542400,280,800,1080,'',-1),(2,2,1441814400,480,1200,1680,'',-1),(2,2,1441900800,480,1200,1680,'',-1),(2,2,1441987200,480,1200,1680,'',-1),(2,2,1442073600,480,1200,1680,'',-1),(2,2,1442160000,480,1200,1680,'',-1),(2,2,1442246400,480,1200,1680,'',-1),(2,2,1442332800,480,1200,1680,'',-1),(2,2,1442419200,480,1200,1680,'',-1),(2,2,1442505600,480,1200,1680,'',-1),(2,2,1442592000,480,1200,1680,'',-1),(2,2,1442678400,480,1200,1680,'',-1),(2,2,1442764800,480,1200,1680,'',-1),(2,2,1442851200,480,1200,1680,'',-1),(2,2,1442937600,480,1200,1680,'',-1),(2,2,1443024000,480,1200,1680,'',-1),(2,2,1443110400,480,1200,1680,'',-1),(2,2,1443196800,480,1200,1680,'',-1),(2,2,1443283200,480,1200,1680,'',-1),(2,2,1443369600,480,1200,1680,'',-1),(2,2,1443456000,480,1200,1680,'',-1),(2,2,1443542400,480,1200,1680,'',-1),(3,3,1442937600,399,600,999,'',-1),(3,3,1443024000,399,600,999,'',-1),(3,3,1443110400,399,600,999,'',-1),(3,3,1443196800,399,600,999,'',-1),(3,3,1443283200,399,600,999,'',-1),(3,3,1443369600,399,600,999,'',-1),(3,3,1443456000,399,600,999,'',-1),(3,3,1443542400,399,600,999,'',-1),(3,3,1443628800,399,600,999,'',-1),(3,3,1443715200,399,600,999,'',-1),(3,3,1443801600,399,600,999,'',-1),(3,3,1443888000,399,600,999,'',-1),(3,3,1443974400,399,600,999,'',-1),(3,3,1444060800,399,600,999,'',-1),(3,3,1444147200,399,600,999,'',-1),(3,3,1444233600,399,600,999,'',-1),(3,3,1444320000,399,600,999,'',-1),(3,3,1444406400,399,600,999,'',-1),(3,3,1444492800,399,600,999,'',-1),(3,3,1444579200,399,600,999,'',-1),(3,3,1444665600,399,600,999,'',-1),(3,3,1444752000,399,600,999,'',-1),(3,3,1444838400,399,600,999,'',-1),(3,3,1444924800,399,600,999,'',-1),(3,3,1445011200,399,600,999,'',-1),(3,3,1445097600,399,600,999,'',-1),(3,3,1445184000,399,600,999,'',-1),(3,3,1445270400,399,600,999,'',-1),(3,3,1445356800,399,600,999,'',-1),(3,3,1445443200,399,600,999,'',-1),(3,3,1445529600,399,600,999,'',-1),(3,3,1445616000,399,600,999,'',-1),(3,3,1445702400,399,600,999,'',-1),(3,3,1445788800,399,600,999,'',-1),(3,3,1445875200,399,600,999,'',-1),(3,3,1445961600,399,600,999,'',-1),(3,3,1446048000,399,600,999,'',-1),(3,3,1446134400,399,600,999,'',-1),(3,3,1446220800,399,600,999,'',-1),(3,3,1446307200,399,600,999,'',-1),(3,3,1446393600,399,600,999,'',-1),(3,3,1446480000,399,600,999,'',-1),(3,3,1446566400,399,600,999,'',-1),(3,3,1446652800,399,600,999,'',-1),(3,3,1446739200,399,600,999,'',-1),(3,3,1446825600,399,600,999,'',-1),(3,3,1446912000,399,600,999,'',-1),(3,3,1446998400,399,600,999,'',-1),(3,3,1447084800,399,600,999,'',-1),(3,3,1447171200,399,600,999,'',-1),(3,3,1447257600,399,600,999,'',-1),(3,3,1447344000,399,600,999,'',-1),(3,3,1447430400,399,600,999,'',-1),(3,3,1447516800,399,600,999,'',-1),(3,3,1447603200,399,600,999,'',-1),(3,3,1447689600,399,600,999,'',-1),(3,3,1447776000,399,600,999,'',-1),(3,3,1447862400,399,600,999,'',-1),(3,3,1447948800,399,600,999,'',-1),(3,3,1448035200,399,600,999,'',-1),(3,3,1448121600,399,600,999,'',-1),(3,3,1448208000,399,600,999,'',-1),(3,3,1448294400,399,600,999,'',-1),(3,3,1448380800,399,600,999,'',-1),(3,3,1448467200,399,600,999,'',-1),(3,3,1448553600,399,600,999,'',-1),(3,3,1448640000,399,600,999,'',-1),(3,3,1448726400,399,600,999,'',-1),(3,3,1448812800,399,600,999,'',-1),(3,3,1448899200,399,600,999,'',-1),(3,3,1448985600,399,600,999,'',-1),(3,3,1449072000,399,600,999,'',-1),(3,3,1449158400,399,600,999,'',-1),(3,3,1449244800,399,600,999,'',-1),(3,3,1449331200,399,600,999,'',-1),(3,3,1449417600,399,600,999,'',-1),(3,3,1449504000,399,600,999,'',-1),(3,3,1449590400,399,600,999,'',-1),(3,3,1449676800,399,600,999,'',-1),(3,3,1449763200,399,600,999,'',-1),(3,3,1449849600,399,600,999,'',-1),(3,3,1449936000,399,600,999,'',-1),(3,3,1450022400,399,600,999,'',-1),(3,3,1450108800,399,600,999,'',-1),(3,3,1450195200,399,600,999,'',-1),(3,3,1450281600,399,600,999,'',-1),(3,3,1450368000,399,600,999,'',-1),(3,3,1450454400,399,600,999,'',-1),(3,3,1450540800,399,600,999,'',-1),(3,3,1450627200,399,600,999,'',-1),(3,3,1450713600,399,600,999,'',-1),(3,3,1450800000,399,600,999,'',-1),(3,3,1450886400,399,600,999,'',-1),(3,3,1450972800,399,600,999,'',-1),(3,3,1451059200,399,600,999,'',-1),(3,3,1451145600,399,600,999,'',-1),(3,3,1451232000,399,600,999,'',-1),(3,3,1451318400,399,600,999,'',-1),(3,3,1451404800,399,600,999,'',-1),(3,3,1451491200,399,600,999,'',-1),(3,3,1451577600,399,600,999,'',-1),(3,3,1451664000,399,600,999,'',-1),(3,3,1451750400,399,600,999,'',-1),(3,3,1451836800,399,600,999,'',-1),(3,3,1451923200,399,600,999,'',-1),(3,3,1452009600,399,600,999,'',-1),(3,3,1452096000,399,600,999,'',-1),(3,3,1452182400,399,600,999,'',-1),(3,3,1452268800,399,600,999,'',-1),(3,3,1452355200,399,600,999,'',-1),(3,3,1452441600,399,600,999,'',-1),(3,3,1452528000,399,600,999,'',-1),(3,3,1452614400,399,600,999,'',-1),(3,3,1452700800,399,600,999,'',-1),(3,3,1452787200,399,600,999,'',-1),(3,3,1452873600,399,600,999,'',-1),(3,3,1452960000,399,600,999,'',-1),(3,3,1453046400,399,600,999,'',-1),(3,3,1453132800,399,600,999,'',-1),(3,3,1453219200,399,600,999,'',-1),(3,3,1453305600,399,600,999,'',-1),(3,3,1453392000,399,600,999,'',-1),(3,3,1453478400,399,600,999,'',-1),(3,3,1453564800,399,600,999,'',-1),(3,3,1453651200,399,600,999,'',-1),(3,3,1453737600,399,600,999,'',-1),(3,3,1453824000,399,600,999,'',-1),(3,3,1453910400,399,600,999,'',-1),(3,3,1453996800,399,600,999,'',-1),(3,3,1454083200,399,600,999,'',-1),(3,3,1454169600,399,600,999,'',-1),(3,3,1454256000,399,600,999,'',-1),(3,3,1454342400,399,600,999,'',-1),(3,3,1454428800,399,600,999,'',-1),(3,3,1454515200,399,600,999,'',-1),(3,3,1454601600,399,600,999,'',-1),(3,3,1454688000,399,600,999,'',-1),(3,3,1454774400,399,600,999,'',-1),(3,3,1454860800,399,600,999,'',-1),(3,3,1454947200,399,600,999,'',-1),(3,3,1455033600,399,600,999,'',-1),(3,3,1455120000,399,600,999,'',-1),(3,3,1455206400,399,600,999,'',-1),(3,3,1455292800,399,600,999,'',-1),(3,3,1455379200,399,600,999,'',-1),(3,3,1455465600,399,600,999,'',-1),(3,3,1455552000,399,600,999,'',-1),(3,3,1455638400,399,600,999,'',-1),(3,3,1455724800,399,600,999,'',-1),(3,3,1455811200,399,600,999,'',-1),(3,3,1455897600,399,600,999,'',-1),(3,3,1455984000,399,600,999,'',-1),(3,3,1456070400,399,600,999,'',-1),(3,3,1456156800,399,600,999,'',-1),(3,3,1456243200,399,600,999,'',-1),(3,3,1456329600,399,600,999,'',-1),(3,3,1456416000,399,600,999,'',-1),(3,3,1456502400,399,600,999,'',-1),(3,3,1456588800,399,600,999,'',-1),(3,3,1456675200,399,600,999,'',-1),(3,3,1456761600,399,600,999,'',-1),(3,3,1456848000,399,600,999,'',-1),(3,3,1456934400,399,600,999,'',-1),(3,3,1457020800,399,600,999,'',-1),(3,3,1457107200,399,600,999,'',-1),(3,3,1457193600,399,600,999,'',-1),(3,3,1457280000,399,600,999,'',-1),(3,3,1457366400,399,600,999,'',-1),(3,3,1457452800,399,600,999,'',-1),(3,3,1457539200,399,600,999,'',-1),(3,3,1457625600,399,600,999,'',-1),(3,3,1457712000,399,600,999,'',-1),(3,3,1457798400,399,600,999,'',-1),(3,3,1457884800,399,600,999,'',-1),(3,3,1457971200,399,600,999,'',-1),(3,3,1458057600,399,600,999,'',-1),(3,3,1458144000,399,600,999,'',-1),(3,3,1458230400,399,600,999,'',-1),(3,3,1458316800,399,600,999,'',-1),(3,3,1458403200,399,600,999,'',-1),(3,3,1458489600,399,600,999,'',-1),(3,3,1458576000,399,600,999,'',-1),(3,3,1458662400,399,600,999,'',-1),(3,3,1458748800,399,600,999,'',-1),(3,3,1458835200,399,600,999,'',-1),(3,3,1458921600,399,600,999,'',-1),(3,3,1459008000,399,600,999,'',-1),(3,3,1459094400,399,600,999,'',-1),(3,3,1459180800,399,600,999,'',-1),(3,3,1459267200,399,600,999,'',-1),(3,3,1459353600,399,600,999,'',-1),(3,3,1459440000,399,600,999,'',-1),(3,3,1459526400,399,600,999,'',-1),(3,3,1459612800,399,600,999,'',-1),(3,3,1459699200,399,600,999,'',-1),(3,3,1459785600,399,600,999,'',-1),(3,3,1459872000,399,600,999,'',-1),(3,3,1459958400,399,600,999,'',-1),(3,3,1460044800,399,600,999,'',-1),(3,3,1460131200,399,600,999,'',-1),(3,3,1460217600,399,600,999,'',-1),(3,3,1460304000,399,600,999,'',-1),(3,3,1460390400,399,600,999,'',-1),(3,3,1460476800,399,600,999,'',-1),(3,3,1460563200,399,600,999,'',-1),(3,3,1460649600,399,600,999,'',-1),(3,3,1460736000,399,600,999,'',-1),(3,3,1460822400,399,600,999,'',-1),(3,3,1460908800,399,600,999,'',-1),(3,3,1460995200,399,600,999,'',-1),(3,3,1461081600,399,600,999,'',-1),(3,3,1461168000,399,600,999,'',-1),(3,3,1461254400,399,600,999,'',-1),(3,3,1461340800,399,600,999,'',-1),(3,3,1461427200,399,600,999,'',-1),(3,3,1461513600,399,600,999,'',-1),(3,3,1461600000,399,600,999,'',-1),(3,3,1461686400,399,600,999,'',-1),(3,3,1461772800,399,600,999,'',-1),(3,3,1461859200,399,600,999,'',-1),(3,3,1461945600,399,600,999,'',-1),(3,3,1462032000,399,600,999,'',-1),(3,3,1462118400,399,600,999,'',-1),(3,3,1462204800,399,600,999,'',-1),(3,3,1462291200,399,600,999,'',-1),(3,3,1462377600,399,600,999,'',-1),(3,3,1462464000,399,600,999,'',-1),(3,3,1462550400,399,600,999,'',-1),(3,3,1462636800,399,600,999,'',-1),(3,3,1462723200,399,600,999,'',-1),(3,3,1462809600,399,600,999,'',-1),(3,3,1462896000,399,600,999,'',-1),(3,3,1462982400,399,600,999,'',-1),(3,3,1463068800,399,600,999,'',-1),(3,3,1463155200,399,600,999,'',-1),(3,3,1463241600,399,600,999,'',-1),(3,3,1463328000,399,600,999,'',-1),(3,3,1463414400,399,600,999,'',-1),(3,3,1463500800,399,600,999,'',-1),(3,3,1463587200,399,600,999,'',-1),(3,3,1463673600,399,600,999,'',-1),(3,3,1463760000,399,600,999,'',-1),(3,3,1463846400,399,600,999,'',-1),(3,3,1463932800,399,600,999,'',-1),(3,3,1464019200,399,600,999,'',-1),(3,3,1464105600,399,600,999,'',-1),(3,3,1464192000,399,600,999,'',-1),(3,3,1464278400,399,600,999,'',-1),(3,3,1464364800,399,600,999,'',-1),(3,3,1464451200,399,600,999,'',-1),(3,3,1464537600,399,600,999,'',-1),(3,3,1464624000,399,600,999,'',-1),(3,3,1464710400,399,600,999,'',-1),(3,3,1464796800,399,600,999,'',-1),(3,3,1464883200,399,600,999,'',-1),(3,3,1464969600,399,600,999,'',-1),(3,3,1465056000,399,600,999,'',-1),(3,3,1465142400,399,600,999,'',-1),(3,3,1465228800,399,600,999,'',-1),(3,3,1465315200,399,600,999,'',-1),(3,3,1465401600,399,600,999,'',-1),(3,3,1465488000,399,600,999,'',-1),(3,3,1465574400,399,600,999,'',-1),(3,3,1465660800,399,600,999,'',-1),(3,3,1465747200,399,600,999,'',-1),(3,3,1465833600,399,600,999,'',-1),(3,3,1465920000,399,600,999,'',-1),(3,3,1466006400,399,600,999,'',-1),(3,3,1466092800,399,600,999,'',-1),(3,3,1466179200,399,600,999,'',-1),(3,3,1466265600,399,600,999,'',-1),(3,3,1466352000,399,600,999,'',-1),(3,3,1466438400,399,600,999,'',-1),(3,3,1466524800,399,600,999,'',-1),(3,3,1466611200,399,600,999,'',-1),(3,3,1466697600,399,600,999,'',-1),(3,3,1466784000,399,600,999,'',-1),(3,3,1466870400,399,600,999,'',-1),(3,3,1466956800,399,600,999,'',-1),(3,3,1467043200,399,600,999,'',-1),(3,3,1467129600,399,600,999,'',-1),(3,3,1467216000,399,600,999,'',-1),(3,3,1467302400,399,600,999,'',-1),(3,3,1467388800,399,600,999,'',-1),(3,3,1467475200,399,600,999,'',-1),(3,3,1467561600,399,600,999,'',-1),(3,3,1467648000,399,600,999,'',-1),(3,3,1467734400,399,600,999,'',-1),(3,3,1467820800,399,600,999,'',-1),(3,3,1467907200,399,600,999,'',-1),(3,3,1467993600,399,600,999,'',-1),(3,3,1468080000,399,600,999,'',-1),(3,3,1468166400,399,600,999,'',-1),(3,3,1468252800,399,600,999,'',-1),(3,3,1468339200,399,600,999,'',-1),(3,3,1468425600,399,600,999,'',-1),(3,3,1468512000,399,600,999,'',-1),(3,3,1468598400,399,600,999,'',-1),(3,3,1468684800,399,600,999,'',-1),(3,3,1468771200,399,600,999,'',-1),(3,3,1468857600,399,600,999,'',-1),(3,3,1468944000,399,600,999,'',-1),(3,3,1469030400,399,600,999,'',-1),(3,3,1469116800,399,600,999,'',-1),(3,3,1469203200,399,600,999,'',-1),(3,3,1469289600,399,600,999,'',-1),(3,3,1469376000,399,600,999,'',-1),(3,3,1469462400,399,600,999,'',-1),(3,3,1469548800,399,600,999,'',-1),(3,3,1469635200,399,600,999,'',-1),(3,3,1469721600,399,600,999,'',-1),(3,3,1469808000,399,600,999,'',-1),(3,3,1469894400,399,600,999,'',-1),(3,3,1469980800,399,600,999,'',-1),(3,3,1470067200,399,600,999,'',-1),(3,3,1470153600,399,600,999,'',-1),(3,3,1470240000,399,600,999,'',-1),(3,3,1470326400,399,600,999,'',-1),(3,3,1470412800,399,600,999,'',-1),(3,3,1470499200,399,600,999,'',-1),(3,3,1470585600,399,600,999,'',-1),(3,3,1470672000,399,600,999,'',-1),(3,3,1470758400,399,600,999,'',-1),(3,3,1470844800,399,600,999,'',-1),(3,3,1470931200,399,600,999,'',-1),(3,3,1471017600,399,600,999,'',-1),(3,3,1471104000,399,600,999,'',-1),(3,3,1471190400,399,600,999,'',-1),(3,3,1471276800,399,600,999,'',-1),(3,3,1471363200,399,600,999,'',-1),(3,3,1471449600,399,600,999,'',-1),(3,3,1471536000,399,600,999,'',-1),(3,3,1471622400,399,600,999,'',-1),(3,3,1471708800,399,600,999,'',-1),(3,3,1471795200,399,600,999,'',-1),(3,3,1471881600,399,600,999,'',-1),(3,3,1471968000,399,600,999,'',-1),(3,3,1472054400,399,600,999,'',-1),(3,3,1472140800,399,600,999,'',-1),(3,3,1472227200,399,600,999,'',-1),(3,3,1472313600,399,600,999,'',-1),(3,3,1472400000,399,600,999,'',-1),(3,3,1472486400,399,600,999,'',-1),(3,3,1472572800,399,600,999,'',-1),(3,3,1472659200,399,600,999,'',-1),(3,3,1472745600,399,600,999,'',-1),(3,3,1472832000,399,600,999,'',-1),(3,3,1472918400,399,600,999,'',-1),(3,3,1473004800,399,600,999,'',-1),(3,3,1473091200,399,600,999,'',-1),(3,3,1473177600,399,600,999,'',-1),(3,3,1473264000,399,600,999,'',-1),(3,3,1473350400,399,600,999,'',-1),(3,3,1473436800,399,600,999,'',-1),(3,3,1473523200,399,600,999,'',-1),(3,3,1473609600,399,600,999,'',-1),(3,3,1473696000,399,600,999,'',-1),(3,3,1473782400,399,600,999,'',-1),(3,3,1473868800,399,600,999,'',-1),(3,3,1473955200,399,600,999,'',-1),(3,3,1474041600,399,600,999,'',-1),(3,3,1474128000,399,600,999,'',-1),(3,3,1474214400,399,600,999,'',-1),(3,3,1474300800,399,600,999,'',-1),(3,3,1474387200,399,600,999,'',-1),(3,3,1474473600,399,600,999,'',-1),(3,3,1474560000,399,600,999,'',-1),(3,3,1474646400,399,600,999,'',-1),(3,3,1474732800,399,600,999,'',-1),(3,3,1474819200,399,600,999,'',-1),(3,3,1474905600,399,600,999,'',-1),(3,3,1474992000,399,600,999,'',-1),(3,3,1475078400,399,600,999,'',-1),(3,3,1475164800,399,600,999,'',-1),(3,3,1475251200,399,600,999,'',-1),(3,3,1475337600,399,600,999,'',-1),(3,3,1475424000,399,600,999,'',-1),(3,3,1475510400,399,600,999,'',-1),(3,3,1475596800,399,600,999,'',-1),(3,3,1475683200,399,600,999,'',-1),(3,3,1475769600,399,600,999,'',-1),(3,3,1475856000,399,600,999,'',-1),(3,3,1475942400,399,600,999,'',-1),(3,3,1476028800,399,600,999,'',-1),(3,3,1476115200,399,600,999,'',-1),(3,3,1476201600,399,600,999,'',-1),(3,3,1476288000,399,600,999,'',-1),(3,3,1476374400,399,600,999,'',-1),(3,3,1476460800,399,600,999,'',-1),(3,3,1476547200,399,600,999,'',-1),(3,3,1476633600,399,600,999,'',-1),(3,3,1476720000,399,600,999,'',-1),(3,3,1476806400,399,600,999,'',-1),(3,3,1476892800,399,600,999,'',-1),(3,3,1476979200,399,600,999,'',-1),(3,3,1477065600,399,600,999,'',-1),(3,3,1477152000,399,600,999,'',-1),(3,3,1477238400,399,600,999,'',-1),(3,3,1477324800,399,600,999,'',-1),(3,3,1477411200,399,600,999,'',-1),(3,3,1477497600,399,600,999,'',-1),(3,3,1477584000,399,600,999,'',-1),(3,3,1477670400,399,600,999,'',-1),(3,3,1477756800,399,600,999,'',-1),(3,3,1477843200,399,600,999,'',-1),(3,3,1477929600,399,600,999,'',-1),(3,3,1478016000,399,600,999,'',-1),(3,3,1478102400,399,600,999,'',-1),(3,3,1478188800,399,600,999,'',-1),(3,3,1478275200,399,600,999,'',-1),(3,3,1478361600,399,600,999,'',-1),(3,3,1478448000,399,600,999,'',-1),(3,3,1478534400,399,600,999,'',-1),(3,3,1478620800,399,600,999,'',-1),(3,3,1478707200,399,600,999,'',-1),(3,3,1478793600,399,600,999,'',-1),(3,3,1478880000,399,600,999,'',-1),(3,3,1478966400,399,600,999,'',-1),(3,3,1479052800,399,600,999,'',-1),(3,3,1479139200,399,600,999,'',-1),(3,3,1479225600,399,600,999,'',-1),(3,3,1479312000,399,600,999,'',-1),(3,3,1479398400,399,600,999,'',-1),(3,3,1479484800,399,600,999,'',-1),(3,3,1479571200,399,600,999,'',-1),(3,3,1479657600,399,600,999,'',-1),(3,3,1479744000,399,600,999,'',-1),(3,3,1479830400,399,600,999,'',-1),(3,3,1479916800,399,600,999,'',-1),(3,3,1480003200,399,600,999,'',-1),(3,3,1480089600,399,600,999,'',-1),(3,3,1480176000,399,600,999,'',-1),(3,3,1480262400,399,600,999,'',-1),(3,3,1480348800,399,600,999,'',-1),(3,3,1480435200,399,600,999,'',-1),(3,3,1480521600,399,600,999,'',-1),(3,3,1480608000,399,600,999,'',-1),(3,3,1480694400,399,600,999,'',-1),(3,3,1480780800,399,600,999,'',-1),(3,3,1480867200,399,600,999,'',-1),(3,3,1480953600,399,600,999,'',-1),(3,3,1481040000,399,600,999,'',-1),(3,3,1481126400,399,600,999,'',-1),(3,3,1481212800,399,600,999,'',-1),(3,3,1481299200,399,600,999,'',-1),(3,3,1481385600,399,600,999,'',-1),(3,3,1481472000,399,600,999,'',-1),(3,3,1481558400,399,600,999,'',-1),(3,3,1481644800,399,600,999,'',-1),(3,3,1481731200,399,600,999,'',-1),(3,3,1481817600,399,600,999,'',-1),(3,3,1481904000,399,600,999,'',-1),(3,3,1481990400,399,600,999,'',-1),(3,3,1482076800,399,600,999,'',-1),(3,3,1482163200,399,600,999,'',-1),(3,3,1482249600,399,600,999,'',-1),(3,3,1482336000,399,600,999,'',-1),(3,3,1482422400,399,600,999,'',-1),(3,3,1482508800,399,600,999,'',-1),(3,3,1482595200,399,600,999,'',-1),(3,3,1482681600,399,600,999,'',-1),(3,3,1482768000,399,600,999,'',-1),(3,3,1482854400,399,600,999,'',-1),(3,3,1482940800,399,600,999,'',-1),(3,3,1483027200,399,600,999,'',-1),(3,3,1483113600,399,600,999,'',-1);

/*Table structure for table `sline_huiyi_kindlist` */

DROP TABLE IF EXISTS `sline_huiyi_kindlist`;

CREATE TABLE `sline_huiyi_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kindid` (`kindid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='模型目的地表';

/*Data for the table `sline_huiyi_kindlist` */

/*Table structure for table `sline_icon` */

DROP TABLE IF EXISTS `sline_icon`;

CREATE TABLE `sline_icon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL,
  `kind` char(50) NOT NULL,
  `picurl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `sline_icon` */

insert  into `sline_icon`(`id`,`webid`,`kind`,`picurl`) values (1,0,'热门','/uploads/icon/hot.png'),(2,0,'促销','/uploads/icon/chuxiao.png'),(3,0,'打折','/uploads/icon/discount.png'),(4,0,'活动','/uploads/icon/huodong.png'),(5,0,'特价','/uploads/icon/special.png'),(6,0,'抢购','/uploads/icon/buy.png');

/*Table structure for table `sline_image` */

DROP TABLE IF EXISTS `sline_image`;

CREATE TABLE `sline_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '分组ID',
  `image_name` varchar(60) DEFAULT NULL COMMENT '图片名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片路径',
  `size` int(11) NOT NULL DEFAULT '0',
  `is_hidden` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8 COMMENT='图片库分组';

/*Data for the table `sline_image` */

insert  into `sline_image`(`id`,`group_id`,`image_name`,`url`,`size`,`is_hidden`) values (39,1,'','/uploads/2015/0909/6576cb3bfd961a0e13e6cc203b4ce012.jpg',440287,'0'),(40,1,'','/uploads/2015/0909/42d30afa4170fd1c776c649735e2e13a.jpg',45744,'0'),(41,1,'','/uploads/2015/0909/0a24ba847fda58ef4933fe05e69db4cc.jpg',4375,'0'),(42,1,'','/uploads/2015/0909/9b72029bbc942ed48f9711374a84497f.jpg',4724,'0'),(44,1,'','/uploads/2015/0909/f9e0e5f3883b40acc7e67067fc5f8c84.jpg',372177,'0'),(45,1,'','/uploads/2015/0909/9f3ad962f487d0b5e809ad2ebd5a69dc.png',296631,'0'),(46,1,'','/uploads/2015/0909/b7a4bbee66395c165e9bd247dd73965d.png',296631,'0'),(47,1,'','/uploads/2015/0909/ed753fe20810c09186e8f3fbf465bb4b.jpg',275873,'0'),(48,1,'','/uploads/2015/0909/d4648d457f025dd76e8d7806899b8bfa.png',352236,'0'),(49,1,'','/uploads/2015/0909/548a005929307ce5bd29629e7053fdb9.png',352236,'0'),(50,1,'','/uploads/2015/0909/9ebb6cec496ce3f407596ea5721e5a37.png',284474,'0'),(51,1,'','/uploads/2015/0909/a001f6c60a8975fbc7603d7be1a0ce0b.png',29343,'0'),(52,1,'','/uploads/2015/0909/975d863260d1e78f523116bdf824795d.jpg',3617,'0'),(53,1,'','/uploads/2015/0909/ca3dea63e14a45ba4a33da45c7df01c8.jpg',36926,'0'),(54,1,'','/uploads/2015/0909/6d3c8056748b059e58ec7ed8bd30b10c.png',141781,'0'),(55,1,'','/uploads/2015/0909/0c2a794dce15465b654ae4226e679a9a.png',142651,'0'),(56,1,'','/uploads/2015/0909/dee8953aae0a1e7ba7e012daa1fac018.png',200957,'0'),(57,1,'','/uploads/2015/0909/bbf664682299877ff9965c512122fab5.png',200957,'0'),(58,1,'','/uploads/2015/0909/fb17b7e3060474e38d30184e26c49ef4.png',200957,'0'),(59,1,'','/uploads/2015/0909/c5c8c0230841ec1a31064ba9951daeb3.png',30228,'0'),(60,1,'','/uploads/2015/0909/308465df2b302d6001fb2abb1fa6e239.jpg',4530,'0'),(61,1,'','/uploads/2015/0909/11c3fcf55907e55dd058a5a3f403e708.png',141781,'0'),(62,1,'','/uploads/2015/0909/66d5d33f3d7488d446f2f2d03f5ab9ad.png',142651,'0'),(63,1,'','/uploads/2015/0909/e58cefdbfeacd1e2ac0a5a786e51f0db.png',200957,'0'),(64,1,'','/uploads/2015/0909/15749e11d9ad91d530088342fd9a4612.png',30228,'0'),(65,1,'','/uploads/2015/0909/243269dacc430c5066ed5b56c0cb5a21.jpg',4530,'0'),(67,1,'','/uploads/2015/0910/176e08735a00fdb7c0feb376b7630003.jpg',16705,'0'),(68,1,'','/uploads/2015/0910/6a906fd00c04b754068adb0e750369a7.jpg',284706,'0'),(69,1,'','/uploads/2015/0910/7da460a9d352b9dbdd2be8e97a1167f4.png',414960,'0'),(70,1,'','/uploads/2015/0910/fc5ac0bbd89e69e9c61557aa95f3c010.png',451610,'0'),(71,1,'','/uploads/2015/0910/6758b2d2e5035389ac019e4a746974f6.png',411113,'0'),(72,1,'','/uploads/2015/0910/4925b80c6ee0a0488040f22b52015870.png',537977,'0'),(73,1,'','/uploads/2015/0910/9dd3b5ad907ceea9b5cb83b70dcf13cd.png',460148,'0'),(74,1,'','/uploads/2015/0910/e9e44e6baed2e1a8893ddb2073815f40.jpg',33040,'0'),(75,1,'','/uploads/2015/0910/d073263693fd19510d4a49a7804f44b6.png',195552,'0'),(76,1,'','/uploads/2015/0910/45efa2adae3fd15fd1914a905cfadbe8.png',199201,'0'),(77,1,'','/uploads/2015/0910/aa8a7fcba4560c3276ccee6932e967d8.png',202378,'0'),(78,1,'','/uploads/2015/0910/f5ca8cafdda992576fb417883244e97b.png',141024,'0'),(79,1,'','/uploads/2015/0910/49d82470842cb4fd683d21bb686f93fc.png',141781,'0'),(80,1,'','/uploads/2015/0910/d71ac6d353237f386e75027b351692a9.jpg',27484,'0'),(81,1,'','/uploads/2015/0910/a1f0a755d7f83366fbcaf881c7f07c83.jpg',30314,'0'),(82,1,'','/uploads/2015/0910/fddd8cf6e4a176570e5874635f7ab50d.jpg',30314,'0'),(83,1,'','/uploads/2015/0910/31a34e7ebbbf7894d75f37e13c99be11.jpg',30314,'0'),(84,1,'','/uploads/2015/0910/d949e9310ceb3a8a2ee2209f6d9a9d0e.png',186185,'0'),(85,1,'','/uploads/2015/0910/fd8a0bb8a79c2002fceb3f01a6bdc784.png',186185,'0'),(86,1,'','/uploads/2015/0910/55ceff8f708c8b118f0b37cd08dd86b9.png',186185,'0'),(87,1,'','/uploads/2015/0910/ca6ae1b66556ef0fc7012ae145a17c7b.png',186185,'0'),(88,1,'','/uploads/2015/0910/795aa982f7c168287568194ecaeb37dc.jpg',4530,'0'),(89,1,'','/uploads/2015/0910/45bc40914a2c41506a224984d8eca5b7.png',182465,'0'),(90,1,'','/uploads/2015/0910/44886c395dbbc1acc243b77e4a100d25.jpg',53897,'0'),(91,1,'','/uploads/2015/0910/13d69f3fe9f461ebd7ca602d967fa2c7.jpg',69650,'0'),(92,1,'','/uploads/2015/0910/411c9865e6280f9cde65237d347b71ed.jpg',86491,'0'),(93,1,'','/uploads/2015/0910/6005239092e2ab3ba779661fc4ace10a.jpg',24780,'0'),(94,1,'','/uploads/2015/0910/6c4ceff91f78487e0ab2c7de4cb60fee.jpg',24780,'0'),(95,1,'','/uploads/2015/0910/40103a990f2bceb3feb42ea56bb7c949.jpg',93384,'0'),(96,1,'','/uploads/2015/0910/56771e33bccf59ebf3d897e0c7f15e84.jpg',93247,'0'),(97,1,'','/uploads/2015/0910/7a43adc9504d5fd77901e399e9337c1d.jpg',93384,'0'),(98,1,'','/uploads/2015/0910/2ecb50391cf4b4d6c1b20f19fe5413ee.jpg',39416,'0'),(99,1,'','/uploads/2015/0910/793211edb14e904767627a60066c1f9c.jpg',81549,'0'),(100,1,'','/uploads/2015/0910/87eaa4abac754a5b4b8a7cb3d79ff977.jpg',7686,'0'),(101,1,'','/uploads/2015/0910/062dde7cd00420f4d9934b8213ddf13b.jpg',6782,'0'),(102,1,'','/uploads/2015/0910/b7eb8adc8170e7d06487d41d4b322ae9.png',141024,'0'),(103,1,'','/uploads/2015/0910/b47e44b33245aad6a3b1cb8d58dff6eb.png',138096,'0'),(104,1,'','/uploads/2015/0910/f69d6edf2faedee5420e09a6aa17fcc4.png',383519,'0'),(105,1,'','/uploads/2015/0910/198c5ecefb4e7c916dc89c3a96b71cc3.png',383519,'0'),(106,1,'','/uploads/2015/0910/d53e4c89ec1f1d6575ef9be1d4f31cb2.png',383519,'0'),(107,1,'','/uploads/2015/0910/4f40ec92f58ada29dfa2bfc1034250ce.png',383519,'0'),(108,1,'','/uploads/2015/0910/4ae04371f43693fea6696cdcb0653731.png',477934,'0'),(109,1,'','/uploads/2015/0910/96d1fc1ab489db3856019958e1124bd7.png',477934,'0'),(110,1,'','/uploads/2015/0910/481507a54700bf8c7847313fa2b01d15.png',383519,'0'),(111,1,'','/uploads/2015/0910/de1238074f702b09d7284f816eae6091.png',353804,'0'),(112,1,'','/uploads/2015/0915/170881ec816ec5ce8127d408dfc5ea2c.jpg',390409,'0'),(113,1,'','/uploads/2015/0918/a79e6a8fb48db052a62f6d2fbfc25a61.jpg',13937,'0'),(114,1,'','/uploads/2015/0918/f3e1a78221a2279590615211fcb42287.jpg',48151,'0'),(115,1,'','/uploads/2015/0918/ff23939425091d799b1aebdb582912a7.jpg',25773,'0'),(116,1,'','/uploads/2015/0918/6981b1c98fe2a363caf456e351360186.jpg',17315,'0'),(117,1,'','/uploads/2015/0918/07d2df3127f3c756115840884224c242.jpg',11230,'0'),(118,1,'','/uploads/2015/0918/eebcb699b27ad2f72cd883e5471a970d.jpg',49959,'0'),(119,1,'','/uploads/2015/0918/395db9d176682fdf846d703c60fd8942.jpg',40658,'0'),(120,1,'','/uploads/2015/0918/57e35a8c2c540503fffdbc07e86ed8f7.jpg',41340,'0'),(121,1,'','/uploads/2015/0918/88fd44a1d9fbe515c2b962d742c49a9d.jpg',51312,'0'),(122,1,'','/uploads/2015/0918/7ef98128656e2fc7c2d6242183f123de.jpg',17920,'0'),(123,1,'','/uploads/2015/0918/181f914e3e9dc901d79db9d4e089c2cd.jpg',136483,'0'),(124,1,'','/uploads/2015/0918/b3f96f7e65cf8e9db928fe5b159a2661.jpg',136483,'0'),(125,1,'','/uploads/2015/0918/c760d6fe9e686d7a22c122c91ae29683.jpg',132306,'0'),(126,1,'','/uploads/2015/0918/c878cbf2d982aaa039081fae67335617.jpg',136483,'0'),(127,1,'','/uploads/2015/0918/395f047af509ace4a65ee718d8a6d15e.jpg',34220,'0'),(128,1,'','/uploads/2015/0918/3026b45874abe0cab3e03de911963526.jpg',98524,'0'),(129,1,'','/uploads/2015/0918/05348153d57707590e2c7238fc315f6a.jpg',16587,'0'),(130,1,'','/uploads/2015/0918/de2dfa219a5339ab1036748d5971afcc.jpg',12509,'0'),(131,1,'','/uploads/2015/0923/bb540b97caf6ed11d0b3067c5715c1a1.jpg',1066531,'0'),(132,1,'','/uploads/2015/0923/32fb73145736d271318cd1fec809ddb1.jpg',81866,'0'),(133,1,'','/uploads/2015/0923/298c188644bc41b60f00e86528b3f69a.jpg',52144,'0'),(134,1,'','/uploads/2015/0923/344174b32952465050d07ce707a7a2c5.jpg',93384,'0'),(135,1,'','/uploads/2015/0923/280754ab47a3afcd5a193c089134d040.jpg',116333,'0'),(136,1,'','/uploads/2015/0923/b9eca56686a67ee01c3e22991c28bd68.png',434783,'0'),(137,1,'','/uploads/2015/0924/75e3b7da6c95b35c01782dd9541d6e7c.jpg',150046,'0'),(138,1,'','/uploads/2015/0924/94d59aa731fa5c5dc89a1ceb206649b3.jpg',13937,'0'),(139,1,'','/uploads/2015/0924/a7c0420fd7005bce3cc99b069da0825c.jpg',13937,'0'),(140,1,'','/uploads/2015/0924/29397c0a5698bd5abeea4d2098d97993.jpg',25773,'0'),(141,1,'','/uploads/2015/0924/ce664f3b21c7e75f9f3f0464384a9c41.jpg',48151,'0'),(142,1,'','/uploads/2015/0924/5ee0416ec4092bd90853d48a5a85736c.jpg',2087955,'0'),(143,1,'','/uploads/2015/0924/6d1e5e93d6c1a77d336095467158abb8.jpg',33255,'0'),(144,1,'','/uploads/2015/0924/f396fe9a2c1bae362e9932c340f1cf31.jpg',11230,'0'),(145,1,'','/uploads/2015/0924/78c17e1b6eb0f6a10f21cb037b99e117.jpg',11230,'0'),(146,1,'','/uploads/2015/0924/03f30ff6c925a727f08f6abe02c4d12c.jpg',17235,'0'),(147,1,'','/uploads/2015/1008/7b41ff85087d1344579b09af15b83676.jpg',275873,'0'),(148,1,'','/uploads/2015/1008/ce607f8e9226dd7f09da04e01d7f6ee9.jpg',372177,'0'),(149,1,'','/uploads/2015/1008/fca378474f41d63f52aa6a8e5c358633.jpg',372177,'0'),(150,1,'','/uploads/2015/1008/87f2d0193b673867f17063038c806945.jpg',275873,'0'),(151,1,'','/uploads/2015/1008/f245ee13fb851d44e9870bf9044553e2.jpg',372177,'0'),(152,1,'','/uploads/2015/1008/be2fbaa0771ca8f8d5319a57f0c4e285.jpg',13937,'0'),(153,1,'','/uploads/2015/1008/c7f748d47175fe1283a6aecec7f59368.jpg',48151,'0'),(154,1,'','/uploads/2015/1008/6373b488fa2a3778e1484ee49ceea17b.jpg',25773,'0'),(155,1,'','/uploads/2015/1008/fcde597d881235f4cf9b4ce7c8a7a445.jpg',17235,'0'),(156,1,'','/uploads/2015/1008/d2bafdaea8c39347587a5d95511efda6.jpg',11230,'0'),(157,1,'','/uploads/2015/1008/b1fa4db3db990dd2a07fa1a92911b118.jpg',16587,'0'),(158,1,'','/uploads/2015/1010/04487603bae416d9a3a5e56dd82beb60.jpg',51312,'0'),(159,1,'','/uploads/2015/1010/6de59723491709b9583c21f6488bfc06.jpg',22767,'0');

/*Table structure for table `sline_image_group` */

DROP TABLE IF EXISTS `sline_image_group`;

CREATE TABLE `sline_image_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分组Id',
  `group_name` varchar(60) NOT NULL DEFAULT '' COMMENT '分组名称',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `do_not` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='图片库';

/*Data for the table `sline_image_group` */

insert  into `sline_image_group`(`group_id`,`group_name`,`description`,`do_not`) values (1,'系统目录',NULL,'1');

/*Table structure for table `sline_insurance` */

DROP TABLE IF EXISTS `sline_insurance`;

CREATE TABLE `sline_insurance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `companykey` varchar(50) DEFAULT NULL COMMENT '接口提供商标识',
  `productcode` varchar(255) DEFAULT NULL COMMENT '产品代码',
  `productname` varchar(255) DEFAULT NULL,
  `defaultprice` decimal(10,2) DEFAULT '0.00' COMMENT '默认价格',
  `ourprice` decimal(10,2) DEFAULT '0.00',
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_insurance` */

/*Table structure for table `sline_insurance_booking` */

DROP TABLE IF EXISTS `sline_insurance_booking`;

CREATE TABLE `sline_insurance_booking` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bookordersn` varchar(255) NOT NULL DEFAULT '0' COMMENT '所属性产品订单号',
  `booktype` int(255) DEFAULT NULL COMMENT '订单类型，比如线路1',
  `memberid` bigint(20) DEFAULT '0' COMMENT '会员ID',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '是否是子订单',
  `productcasecode` varchar(255) DEFAULT NULL COMMENT '保险方案号',
  `type` tinyint(2) NOT NULL DEFAULT '0' COMMENT '类型',
  `insurednum` int(11) NOT NULL DEFAULT '0' COMMENT '被保人数量',
  `price` float(10,2) NOT NULL COMMENT '总价',
  `payprice` float(10,2) DEFAULT NULL COMMENT '客户支付价格',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '付款状态 , 0客户未付, 1,客户已付款, 2.购买成功',
  `applicationdate` date DEFAULT NULL COMMENT '投保时间',
  `begindate` date NOT NULL COMMENT '投保开始时间',
  `enddate` date NOT NULL COMMENT '投保结束时间',
  `destination` varchar(255) DEFAULT NULL COMMENT '出行目的地',
  `trippurposeid` varchar(100) DEFAULT NULL COMMENT '出行目的地代码',
  `visacity` varchar(100) DEFAULT NULL COMMENT '签证办理城市',
  `ordersn` varchar(255) NOT NULL COMMENT '订单号',
  `insureno` varchar(255) DEFAULT NULL COMMENT '投保单号',
  `policyno` varchar(255) DEFAULT NULL COMMENT '保险公司保单号  ',
  `policyfileid` varchar(255) DEFAULT NULL COMMENT '保单ID',
  `addtime` int(11) DEFAULT NULL,
  `modtime` int(11) DEFAULT NULL,
  `payedtime` int(11) DEFAULT NULL,
  `viewstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_insurance_booking` */

/*Table structure for table `sline_insurance_booking_tourer` */

DROP TABLE IF EXISTS `sline_insurance_booking_tourer`;

CREATE TABLE `sline_insurance_booking_tourer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `pinyin` varchar(255) DEFAULT NULL COMMENT '拼音',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别,0女， 1男',
  `cardtype` varchar(5) DEFAULT NULL COMMENT '证件类型',
  `cardcode` varchar(255) DEFAULT NULL COMMENT '证件号',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `mobile` varchar(50) DEFAULT NULL COMMENT '电话',
  `jobcode` varchar(10) DEFAULT NULL COMMENT '职业代码，慧择提供',
  `joblevel` tinyint(4) DEFAULT NULL COMMENT '职业水平',
  `job` varchar(100) DEFAULT NULL COMMENT '工作名称',
  `fltno` varchar(100) DEFAULT NULL COMMENT '航班号',
  `city` varchar(100) DEFAULT NULL COMMENT '所在地区',
  `insurantrelation` varchar(20) DEFAULT NULL COMMENT '与投保人关系 ',
  `count` int(11) DEFAULT NULL COMMENT '购买份数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_insurance_booking_tourer` */

/*Table structure for table `sline_jieban` */

DROP TABLE IF EXISTS `sline_jieban`;

CREATE TABLE `sline_jieban` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kindlist` varchar(255) DEFAULT '0' COMMENT '目的地',
  `dest_mainid` int(6) DEFAULT '0' COMMENT '主目的地',
  `dest_childid` int(6) DEFAULT '0' COMMENT '子目的地',
  `day` tinyint(3) DEFAULT '0' COMMENT '天数',
  `attrid` varchar(255) DEFAULT '0' COMMENT '属性id',
  `childnum` int(3) DEFAULT '0' COMMENT '儿童数量',
  `adultnum` int(3) DEFAULT '0' COMMENT '成人数量',
  `vartime` varchar(255) DEFAULT '0' COMMENT '机动时间',
  `lineid` varchar(255) DEFAULT '0' COMMENT '相关线路id',
  `memo` text COMMENT '行程安排',
  `startdate` varchar(255) DEFAULT '0' COMMENT '出发日期',
  `addtime` int(10) DEFAULT '0' COMMENT '添加时间',
  `memberid` varchar(255) DEFAULT '0' COMMENT '会员id',
  `ishidden` int(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `iconlist` varchar(50) DEFAULT '0' COMMENT '图标',
  `status` tinyint(1) DEFAULT '0' COMMENT '约伴状态,0:关闭1:开启2:已成团',
  `userdest` varchar(255) DEFAULT '0' COMMENT '用户自定义目的地',
  `usertheme` varchar(500) DEFAULT '0' COMMENT '用户主题',
  `shownum` int(4) DEFAULT '0' COMMENT '查看次数',
  `title` varchar(255) DEFAULT '' COMMENT '标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='结伴表';

/*Data for the table `sline_jieban` */

/*Table structure for table `sline_jieban_attr` */

DROP TABLE IF EXISTS `sline_jieban_attr`;

CREATE TABLE `sline_jieban_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(1) unsigned DEFAULT '0',
  `attrname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `displayorder` int(11) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `issystem` int(1) unsigned DEFAULT '0',
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_PID_ID` (`pid`,`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='结伴属性表';

/*Data for the table `sline_jieban_attr` */

/*Table structure for table `sline_jieban_join` */

DROP TABLE IF EXISTS `sline_jieban_join`;

CREATE TABLE `sline_jieban_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jiebanid` int(10) NOT NULL COMMENT '结伴id',
  `linkman` varchar(50) DEFAULT NULL COMMENT '联系人',
  `mobile` varchar(50) DEFAULT NULL COMMENT '联系人手机',
  `memberid` tinyint(10) DEFAULT NULL COMMENT '联系人会员id',
  `adultnum` tinyint(10) DEFAULT '1' COMMENT '大人数量',
  `childnum` tinyint(10) DEFAULT '0' COMMENT '小孩数量',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='结伴加入人员信息表';

/*Data for the table `sline_jieban_join` */

/*Table structure for table `sline_jieban_kindlist` */

DROP TABLE IF EXISTS `sline_jieban_kindlist`;

CREATE TABLE `sline_jieban_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_KINDID` (`kindid`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='ssmall线路分类总表';

/*Data for the table `sline_jieban_kindlist` */

/*Table structure for table `sline_keyword` */

DROP TABLE IF EXISTS `sline_keyword`;

CREATE TABLE `sline_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `linkurl` varchar(255) NOT NULL,
  `webid` int(3) DEFAULT '1',
  `keyword` varchar(255) DEFAULT NULL COMMENT '具体长尾词语',
  `aid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_keyword` */

/*Table structure for table `sline_kindorderlist` */

DROP TABLE IF EXISTS `sline_kindorderlist`;

CREATE TABLE `sline_kindorderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `typeid` int(1) unsigned DEFAULT NULL COMMENT '栏目类型',
  `aid` varchar(255) DEFAULT NULL COMMENT '文章的aid',
  `classid` int(11) DEFAULT NULL COMMENT '分类id',
  `displayorder` int(11) unsigned DEFAULT '9999' COMMENT '排序ID',
  `istejia` int(1) unsigned DEFAULT '0' COMMENT '特惠',
  `isding` int(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `isjian` int(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `displayorder` (`displayorder`),
  KEY `isding` (`isding`),
  KEY `IDX_AI_WE_CL_TY` (`aid`,`webid`,`classid`,`typeid`) USING BTREE,
  KEY `IDX_AI_TY_CL` (`aid`,`typeid`,`classid`) USING BTREE,
  KEY `IDX_CL_TY_AI_WE` (`classid`,`typeid`,`aid`,`webid`) USING BTREE,
  KEY `IDX_TY_CL_AI` (`typeid`,`classid`,`aid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ssmall分类排序表';

/*Data for the table `sline_kindorderlist` */

/*Table structure for table `sline_leave` */

DROP TABLE IF EXISTS `sline_leave`;

CREATE TABLE `sline_leave` (
  `id` int(13) NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned NOT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL COMMENT '留言者IP地址',
  `leavename` varchar(50) DEFAULT NULL COMMENT '留言者昵称',
  `qq` varchar(50) DEFAULT NULL COMMENT '留言者QQ或MSN等联系方式',
  `msn` varchar(50) DEFAULT NULL,
  `telephone` varchar(50) DEFAULT NULL COMMENT '留言者电话（座机）',
  `phone` varchar(11) DEFAULT NULL COMMENT '留言者手机',
  `email` varchar(50) DEFAULT NULL COMMENT '留言人邮箱',
  `title` varchar(50) DEFAULT NULL COMMENT '留言主题',
  `headimg` varchar(50) DEFAULT NULL COMMENT '选择头像',
  `content` longtext COMMENT '留言内容',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `reply` longtext COMMENT '管理员回复内容',
  `retime` int(10) unsigned DEFAULT NULL COMMENT '管理员回复时间',
  `approval` int(1) unsigned DEFAULT NULL COMMENT '是否通过',
  `ishidden` int(1) DEFAULT NULL COMMENT '留言人是否隐藏',
  `leaveip` varchar(50) DEFAULT NULL COMMENT '留言者IP',
  `listarea` varchar(255) DEFAULT NULL COMMENT '分类区域',
  `listspot` varchar(255) DEFAULT NULL COMMENT '问题的对应景区',
  `ismaill` int(1) DEFAULT '0',
  `tagword` varchar(255) DEFAULT NULL,
  `typeid` int(11) unsigned DEFAULT NULL,
  `ismust` int(1) unsigned NOT NULL DEFAULT '0',
  `kind` varchar(255) DEFAULT NULL COMMENT '所属分类ID',
  `kindlist` varchar(255) DEFAULT NULL COMMENT '所属目的地',
  `postid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`ismust`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='(暂时不使用)';

/*Data for the table `sline_leave` */

/*Table structure for table `sline_line` */

DROP TABLE IF EXISTS `sline_line`;

CREATE TABLE `sline_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL COMMENT '文章ID',
  `title` varchar(255) DEFAULT NULL,
  `wholesalel` varchar(255) DEFAULT NULL COMMENT '批发商联系方式',
  `seotitle` varchar(100) DEFAULT NULL COMMENT 'seo标题',
  `startcity` varchar(255) DEFAULT NULL COMMENT '出发城市',
  `overcity` varchar(255) DEFAULT NULL COMMENT '目的城市',
  `linedate` varchar(255) DEFAULT NULL COMMENT '出团日期',
  `price` int(11) DEFAULT NULL,
  `lineday` int(3) unsigned DEFAULT NULL COMMENT '线路天数',
  `linenight` int(5) DEFAULT NULL COMMENT '多少晚',
  `litpic` varchar(255) DEFAULT NULL,
  `linedoc` varchar(255) DEFAULT NULL COMMENT '线路行程word版地址',
  `tagword` varchar(255) DEFAULT NULL COMMENT 'tag词',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `jieshao` longtext COMMENT '线路行程',
  `biaozhun` longtext COMMENT '服务标准',
  `beizu` longtext COMMENT '温鑫提示(备注)',
  `payment` longtext COMMENT '付款方式',
  `feeinclude` longtext COMMENT '费用包含',
  `features` longtext COMMENT '行程特色',
  `description` varchar(700) DEFAULT NULL COMMENT '描述',
  `shownum` int(11) DEFAULT '1' COMMENT '浏览次数',
  `seatleft` int(11) DEFAULT NULL COMMENT '空位数',
  `storeprice` int(11) DEFAULT NULL COMMENT '门市价',
  `transport` longtext COMMENT '交通方式',
  `linebefore` int(11) DEFAULT NULL COMMENT '提前报名天数',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `reserved1` longtext COMMENT '线路内容自定义1',
  `reserved2` longtext COMMENT '线路内容自定义2',
  `reserved3` longtext COMMENT '线路内容自定义3',
  `color` varchar(255) DEFAULT NULL COMMENT '标题颜色',
  `childrule` varchar(255) NOT NULL DEFAULT '' COMMENT '小孩说明',
  `kindlist` varchar(255) DEFAULT NULL COMMENT '所属目的地',
  `themelist` varchar(255) DEFAULT NULL COMMENT '主题',
  `attrid` varchar(255) DEFAULT NULL COMMENT '主站属性',
  `satisfyscore` int(11) DEFAULT NULL COMMENT '满意度',
  `bookcount` int(11) unsigned DEFAULT NULL COMMENT '预订次数',
  `ishidden` int(3) DEFAULT '0',
  `isstyle` varchar(255) DEFAULT NULL,
  `sellpoint` varchar(255) DEFAULT NULL COMMENT '卖点',
  `piclist` text,
  `distance` int(6) DEFAULT NULL,
  `zijiaseat` varchar(255) DEFAULT NULL,
  `zijiaprice` varchar(255) DEFAULT NULL,
  `zijiacar` varchar(255) DEFAULT NULL COMMENT '车辆名称(类型)',
  `showrepast` int(1) DEFAULT '1' COMMENT '是否显示餐饮',
  `paytype` int(1) DEFAULT '1' COMMENT '支付方式',
  `templet` varchar(255) DEFAULT 'line_show.htm' COMMENT '使用模板',
  `iconlist` varchar(255) DEFAULT NULL,
  `supplierlist` varchar(255) DEFAULT NULL,
  `insuranceids` varchar(255) DEFAULT NULL COMMENT '保险id',
  `islinebefore` tinyint(1) DEFAULT '0',
  `recommendnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kindlist` (`kindlist`),
  KEY `searchkey` (`kindlist`(50),`attrid`(50)),
  KEY `lineday` (`lineday`),
  KEY `lineprice` (`price`),
  KEY `attrid` (`attrid`),
  KEY `IDX_AID` (`aid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `sline_line` */

insert  into `sline_line`(`id`,`webid`,`aid`,`title`,`wholesalel`,`seotitle`,`startcity`,`overcity`,`linedate`,`price`,`lineday`,`linenight`,`litpic`,`linedoc`,`tagword`,`keyword`,`jieshao`,`biaozhun`,`beizu`,`payment`,`feeinclude`,`features`,`description`,`shownum`,`seatleft`,`storeprice`,`transport`,`linebefore`,`addtime`,`modtime`,`reserved1`,`reserved2`,`reserved3`,`color`,`childrule`,`kindlist`,`themelist`,`attrid`,`satisfyscore`,`bookcount`,`ishidden`,`isstyle`,`sellpoint`,`piclist`,`distance`,`zijiaseat`,`zijiaprice`,`zijiacar`,`showrepast`,`paytype`,`templet`,`iconlist`,`supplierlist`,`insuranceids`,`islinebefore`,`recommendnum`) values (1,0,1,'峨眉山乐山二日游',NULL,'峨眉山乐山二日游','75',NULL,NULL,520,2,1,'/uploads/2015/0909/6576cb3bfd961a0e13e6cc203b4ce012.jpg','','','峨眉山乐山二日游','','','<p>1、所有优惠票均以实际优惠为准。</p><p>2、3岁以下、70岁以上老人不含意外险</p><p>3、为了使行程更加丰富，游客可参观东方佛都景区或根据自身兴趣自愿游览东方佛都景区、乌木博物馆或参加观看巴蜀绝技川剧变脸晚会，吐火、滚灯、手影戏、峨眉武术等巴蜀绝活，感受丰富多彩的四川文化。</p><p>4、为了更好地让客人深入了解当地的佛教文化，乐山景区和峨眉山景区分别更换景区导游，全陪导游不陪同进景区</p><p>5、住宿酒店无电梯，空调双人标间特色酒店，房间基本设施：彩色电视、挂机空调、梳妆台等，淋浴房、马桶等绝对干净卫生。</p><p>6、散客团（非独立成团）在行程中若有变动，导游会征求客人意见，客人签字更改，若您不同意更改行程请拒绝签字，我们将按照原定行程完成</p><p>7、最少成团人数16人（特殊情况除外）</p><p>8、雷洞坪至金顶可自行登山或乘坐索道，为了保障游览时间及观光顺畅，建议客人乘坐索道，全山索道185元（未收取）。因考虑游客宗教信仰不同，万年寺10元小门票旅行社未收取。客人根据个人需求自行购买或导游代购。</p><p>9、安全说明：旅行社的导游人员和其他工作人员无法为游客提供一对一的服务，旅行社工作人员在接待游客报名时已经充分告知本行程中的注意事项和对游客身体健康的要求，旅游活动中游客必须注意自身安全和随行未成年人的安全，保管好个人财务，贵重物品随身携带。景区所在地区为著名佛教文化圣地，在旅游中请尊重宗教习俗；为了您的安全，请入夜后避免单独出行，个别思想开放者请不要在景区有所作为以免造成不必要的重大损失！自由活动期间，请注意保护自身人生安全及财物安全，过马路请小心；沿途停车加水或上厕所等任何一个停留地点，请你上下车及索道时注意脚下、头顶及周边安全，不要在汽车道公路边崖边活动停留，沿途上厕所大部份都有当地人收费，请主动付费，不要与当地人发生无谓的争吵；峨眉山猴子成群结队，逗猴是峨眉山游程一大特色，但峨眉青弥猴是野生猴类，并非人工饲养。特提醒游客在进入猴区前仔细阅读逗猴须知，进入后遵守猴区规定。游客与旅行社签订旅游合同生效日起，旅行社已为游客购买旅游意外保险。但此保险并未包括峨眉山猴区险，在进入猴区前管委会设有猴区意外险销售处（5元／位）客人可根据个人需求自行购买。（猴群因季节或天气因素会躲进山里，导致无法戏猴非旅行社责任）。 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p>10、此价格为包价旅游费用，由于旅游者自身原因导致包价旅游合同不能履行或不能按照约定履行，或者造成旅游者人身损害、财产损失的，旅行社不承担责任。 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p>乐山、峨眉山景区温馨提示：</p><p>在乐山景区及峨眉山景区内会有很多土特产及朝佛纪念品出售，凡在景区内的类似购物店形式的卖场均为景区的附加设施（如禅缘堂），如若产生质量及其他投诉，由景区负责解释，均与我社无关。请游客根据实际情况消费。如有景区讲解员违规操作请当即致电我公司业务员（请认真填写旅游质量跟踪表，回程后以填写旅游团队质量表为准）。感谢游客的支持！</p><p><br/></p>','<p>网上预订：直接通过网站下单，在线选择产品并填写相关信息后，提交订单。</p><p>在线预订：拨打咨询/预订电话，由客服帮助您完成信息的确认和下单操作。</p><p><br/></p>','<p>1、交通：正规旅游车（确保一人一个正座）</p><p>2、住宿：酒店双人间。</p><p>3、用餐：八菜一汤，十人一桌，三正一早。</p><p>4、门票：乐山90元、峨眉山185元、观光车90元</p><p>5、导游全程持证导游服务（分段服务） &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p>6、保险：旅行社提供旅行社责任险、内宾意外伤害保险，旅行社可代购猴区意外险。</p><p>7、儿童含往返旅游车位费、餐费、保险，不占床位，不含门票、不含观光车</p><p><br/></p>','<p>特价游乐山，祈福于峨眉。</p>','峨眉山乐山二日游',13,NULL,560,'汽车',1,1441786773,1442980963,'<p>第一天：成都（128KM）乐山大佛（37KM）峨眉山</p><p>第二天：峨眉山（180KM）成都</p>','<p>1、保险：财产保险</p><p>2、住宿：单房差</p><p>3、用餐：不含酒水</p><p>4、消费：个人消费</p><p>5、其他：如因人力不可抗拒因素而额外产生的其他费用。</p><p>6、景区：金顶索道往返120元/人，万年寺索道单程60元/人，万年寺小门票10元/人。</p><p>7、娱乐：东方佛都80元/人、川剧变脸晚会200元/人、乌木博物馆120元/人、熊猫馆150元/人</p><p><br/></p>','','#FF0000','','36,38,41',NULL,'45,1',90,1200,0,'2','精品纯玩游，热门特价线路','/uploads/2015/0909/6576cb3bfd961a0e13e6cc203b4ce012.jpg||,/uploads/2015/0909/42d30afa4170fd1c776c649735e2e13a.jpg||',NULL,NULL,NULL,NULL,1,1,'line_new/line_show.htm','5',NULL,'',0,0),(2,0,2,'峨眉山乐山二日游',NULL,'峨眉山乐山二日游','75',NULL,NULL,640,2,1,'/uploads/2015/0909/2015090916295839.jpg','','','峨眉山乐山二日游','','','<p>1、所有优惠票均以实际优惠为准。</p><p>2、3岁以下、70岁以上老人不含意外险</p><p>3、为了使行程更加丰富，游客可参观东方佛都景区或根据自身兴趣自愿游览东方佛都景区、乌木博物馆或参加观看巴蜀绝技川剧变脸晚会，吐火、滚灯、手影戏、峨眉武术等巴蜀绝活，感受丰富多彩的四川文化。</p><p>4、为了更好地让客人深入了解当地的佛教文化，乐山景区和峨眉山景区分别更换景区导游，全陪导游不陪同进景区</p><p>5、住宿酒店无电梯，空调双人标间特色酒店，房间基本设施：彩色电视、挂机空调、梳妆台等，淋浴房、马桶等绝对干净卫生。</p><p>6、散客团（非独立成团）在行程中若有变动，导游会征求客人意见，客人签字更改，若您不同意更改行程请拒绝签字，我们将按照原定行程完成</p><p>7、最少成团人数16人（特殊情况除外）</p><p>8、雷洞坪至金顶可自行登山或乘坐索道，为了保障游览时间及观光顺畅，建议客人乘坐索道，全山索道185元（未收取）。因考虑游客宗教信仰不同，万年寺10元小门票旅行社未收取。客人根据个人需求自行购买或导游代购。</p><p>9、安全说明：旅行社的导游人员和其他工作人员无法为游客提供一对一的服务，旅行社工作人员在接待游客报名时已经充分告知本行程中的注意事项和对游客身体健康的要求，旅游活动中游客必须注意自身安全和随行未成年人的安全，保管好个人财务，贵重物品随身携带。景区所在地区为著名佛教文化圣地，在旅游中请尊重宗教习俗；为了您的安全，请入夜后避免单独出行，个别思想开放者请不要在景区有所作为以免造成不必要的重大损失！自由活动期间，请注意保护自身人生安全及财物安全，过马路请小心；沿途停车加水或上厕所等任何一个停留地点，请你上下车及索道时注意脚下、头顶及周边安全，不要在汽车道公路边崖边活动停留，沿途上厕所大部份都有当地人收费，请主动付费，不要与当地人发生无谓的争吵；峨眉山猴子成群结队，逗猴是峨眉山游程一大特色，但峨眉青弥猴是野生猴类，并非人工饲养。特提醒游客在进入猴区前仔细阅读逗猴须知，进入后遵守猴区规定。游客与旅行社签订旅游合同生效日起，旅行社已为游客购买旅游意外保险。但此保险并未包括峨眉山猴区险，在进入猴区前管委会设有猴区意外险销售处（5元／位）客人可根据个人需求自行购买。（猴群因季节或天气因素会躲进山里，导致无法戏猴非旅行社责任）。 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p>10、此价格为包价旅游费用，由于旅游者自身原因导致包价旅游合同不能履行或不能按照约定履行，或者造成旅游者人身损害、财产损失的，旅行社不承担责任。 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p>乐山、峨眉山景区温馨提示：</p><p>在乐山景区及峨眉山景区内会有很多土特产及朝佛纪念品出售，凡在景区内的类似购物店形式的卖场均为景区的附加设施（如禅缘堂），如若产生质量及其他投诉，由景区负责解释，均与我社无关。请游客根据实际情况消费。如有景区讲解员违规操作请当即致电我公司业务员（请认真填写旅游质量跟踪表，回程后以填写旅游团队质量表为准）。感谢游客的支持！</p><p><br/></p>','<p>网上预订：直接通过网站下单，在线选择产品并填写相关信息后，提交订单。</p><p>在线预订：拨打咨询/预订电话，由客服帮助您完成信息的确认和下单操作。</p><p><br/></p>','<p>1、交通：正规旅游车（确保一人一个正座）</p><p>2、住宿：酒店双人间。</p><p>3、用餐：八菜一汤，十人一桌，三正一早。</p><p>4、门票：乐山90元、峨眉山185元、观光车90元</p><p>5、导游全程持证导游服务（分段服务） &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p><p>6、保险：旅行社提供旅行社责任险、内宾意外伤害保险，旅行社可代购猴区意外险。</p><p>7、儿童含往返旅游车位费、餐费、保险，不占床位，不含门票、不含观光车</p><p><br/></p>','<p>特价游乐山，祈福于峨眉。</p>','峨眉山乐山二日游',29,NULL,780,'汽车',1,1441787398,1441850385,'<p>第一天：成都（128KM）乐山大佛（37KM）峨眉山</p><p>第二天：峨眉山（180KM）成都</p>','<p>1、保险：财产保险</p><p>2、住宿：单房差</p><p>3、用餐：不含酒水</p><p>4、消费：个人消费</p><p>5、其他：如因人力不可抗拒因素而额外产生的其他费用。</p><p>6、景区：金顶索道往返120元/人，万年寺索道单程60元/人，万年寺小门票10元/人。</p><p>7、娱乐：东方佛都80元/人、川剧变脸晚会200元/人、乌木博物馆120元/人、熊猫馆150元/人</p><p><br/></p>','','','','36,38,41',NULL,'45,1',90,1200,0,'2','精品纯玩游，热门特价线路','/uploads/2015/0909/2015090916295849.jpg||,/uploads/2015/0909/2015090916295839.jpg||',NULL,NULL,NULL,NULL,1,1,'line_new/line_show.htm','5',NULL,'',0,0),(4,0,3,'泰国曼谷+芭提雅6日跟团游·成都直飞 0自费 探秘唐人街',NULL,'泰国曼谷+芭提雅6日跟团游·成都直飞 0自费 探秘唐人街','75',NULL,NULL,3599,6,5,'/uploads/2015/0910/13d69f3fe9f461ebd7ca602d967fa2c7.jpg','','','泰国曼谷，芭提雅6日跟团游,探秘唐人街','','','','<p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; white-space: normal;\"><img alt=\"\" width=\"710\" height=\"84\" src=\"http://jiuzhaigou.stourweb.com/uploads/arcimgs/140910023013_024287_9rvkxgaeii3n.gif\" style=\"padding: 0px; margin: 0px; border: 0px; vertical-align: middle;\"/></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; white-space: normal;\">&nbsp;<span id=\"1348816711927E\" style=\"padding: 0px; margin: 0px;\"><span style=\"padding: 0px; margin: 0px; font-size: larger;\">网上预订：直接通过网站下单，在线选择产品并填写相关信息后，提交订单。</span></span></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 20px; white-space: normal;\">&nbsp;<span style=\"padding: 0px; margin: 0px; font-size: larger;\">在线预订：拨打咨询/预订电话，由客服帮助您完成信息的确认和下单操作。</span></p><p><br/></p>','<ol class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\"><li><p>​往返经济舱机票、燃油附加费（以实际收费标准为准）、机票税</p></li><li><p>行程所列酒店住宿费用</p></li><li><p>酒店标准2人间</p></li><li><p>行程内所列餐食（飞机餐及行程中注明的自理餐除外）。</p></li><li><p>领队和当地中文导游服务。</p></li><li><p>跟团游期间用车费用自由活动除外。</p></li><li><p>行程中所列景点首道大门票，详见行程描述。</p></li><li><p>落地签证200/人落地签、旅游签证费用。</p></li><li><p>此团一律做泰国落地签，不用寄护照原件，只需提前7个工作日将护照首页扫描件发送至邮箱2863286205@qq.com即可。出团当天带上护照原件+1张两寸彩照做落地签用即可。请知晓！</p></li><li><p>导游服务小费300元。</p></li><li><p>年龄2--12周岁（不含）,不占床,服务标准同成人</p></li></ol><p><br/></p>','<p>一价出游 全程0自费</p>','',15,NULL,3999,'飞机',5,1441857836,1441863176,'','<ol class=\" list-paddingleft-2\" style=\"list-style-type: decimal;\"><li><p>出入境个人物品海关征税，超重行李的托运费、保管费。</p></li><li><p>因交通延阻、罢工、天气、飞机、机器故障、航班取消或更改时间等不可抗力原因所导致的额外费用。</p></li><li><p>酒店内洗衣、理发、电话、传真、收费电视、饮品、烟酒等个人消费。</p></li><li><p>以上“费用包含”中不包含的其它项目。</p></li><li><p>单房差</p></li><li><p>泰国落地签，请客人自备20元/人快速通关小费。 如有不便，敬请谅解！</p></li></ol><p><br/></p>','','#3399FF','','37',NULL,'84,45,1,85',98,196,0,'2','','/uploads/2015/0910/44886c395dbbc1acc243b77e4a100d25.jpg||,/uploads/2015/0910/13d69f3fe9f461ebd7ca602d967fa2c7.jpg||,/uploads/2015/0910/411c9865e6280f9cde65237d347b71ed.jpg||',NULL,NULL,NULL,NULL,1,1,'line_new/line_show.htm','',NULL,'',0,0),(5,0,4,'贵州荔波大小七孔双飞三日游',NULL,'','75',NULL,NULL,1500,3,2,'/uploads/2015/0910/2ecb50391cf4b4d6c1b20f19fe5413ee.jpg','','','','','','<p><span style=\"color: rgb(255, 192, 0);\">温馨提示</span><span style=\"color: rgb(255, 192, 0);\">：</span>行程中规定的出发、游览、参观时间为大约时间，特殊情况导游可与游客协商进行调整。为便于散客中心通知游客的乘车时间及接人地点、导游和车牌号，请游客在出行前一天随时保持手机畅通！</p><p><br/></p><p><span style=\"color: rgb(255, 192, 0);\">重要提示</span><span style=\"color: rgb(255, 192, 0);\">：</span></p><p>1、贵州酒店标准比较偏低，请旅游者提前做好心理准备。如遇旺季酒店资源紧张或政府临时征用等特殊情况，我社有权调整为同等级标准酒店。<br/></p><p>2、请成人带好有效的证件（身份证），儿童带好户口本；<br/></p><p>3、贵州用餐口味较重，且普通团队餐厅菜式比较雷同。建议旅游者可自带些面包等干粮佐餐。<br/></p><p>4、如遇人力不可抗拒因素或政策性调整导致无法游览的景点（堵车、封路、塌方等），我社有权取消或更换为其它等价景点，赠送景点费用不退，并有权将景点及住宿顺序做相应调整；部分景区及酒店为方便旅游者有自设的商场及购物场所，并非我社安排的旅游购物店，此类投诉我社无法受理，敬请谅解；<br/></p><p>5、贵州的气候温暖湿润，属亚热带湿润季风气候。气温变化小，冬暖夏凉，气候宜人。受大气环流及地形等影响，贵州气候呈多样性，“一山分四季，十里不同天”。另外，气候不稳定，灾害性天气种类较多，干旱、秋风、凌冻、冰雹等频度大。 在贵州高原旅行需备雨具。3～8月是雨季，9月入秋后至次年3月仍然有雨。<br/></p><p>6、夜间或自由活动期间宜结伴同行并告知导游，记好导游手机号备用，注意人身和财物安全。贵重物品可寄存在酒店前台保险柜，下榻的酒店的名称位置也要记牢，不要随便相信陌生人，特别是三轮摩托车、街头发小广告者，天下没有免费的午餐。<br/></p><p>7、文明旅游、文明出行，自觉爱护景区的花草树木和文物古迹，不随意在景区、古迹上乱涂乱画、不乱丢垃圾、尊重当地少数民族风俗等。很多景区和酒店周边有小摊小贩，如无意购买请不要与其讲价还价，一旦讲好价格不购买的话容易产生矛盾。出游请保持平常的心态，遇事切勿急躁，大家互相体谅、互相帮助。<br/></p><p>8、请配合导游如实填写当地《游客意见书》，游客的投诉诉求以在贵州当地，旅游者自行填写的意见单为主要依据。不填或虚填者归来后的投诉将无法受理，如在行程进行中对旅行社的服务标准有异议，请尽量在当地解决。如在旅游期间在当地解决不了，可在当地备案，提醒：旅游投诉时效为返回出发地起30天内有效。<br/></p><p>9、行程不含的其他当地特色旅游项目及告知内容，如有需求可与当团导游联系，合理安排时间，不给旅游留下遗憾。体验项目当地导游可根据体验的最佳时间进行合理安排；<br/></p><p>10、部分景区由于交通工具的特殊性，故对旅游者的年龄和身体条件有相应的要求。（详见细化行程单中景点介绍）<br/></p><p><br/></p>','','<p>接待标准：</p><p>交 &nbsp;通：往返飞机经济舱、含机建燃油。<br/></p><p>用 &nbsp;车：当地空调旅游大巴；接送机根据人员安排不是旅游车接机无导游。 &nbsp;&nbsp;<br/></p><p>接待标准：<br/></p><p>交 &nbsp;通：往返飞机经济舱、含机建燃油。</p><p>用 &nbsp;车：当地空调旅游大巴；接送机根据人员安排不是旅游车接机无导游。 &nbsp;&nbsp;</p><p>导 &nbsp;游：地接持证优秀国语导游服务； &nbsp;&nbsp;</p><p>门 &nbsp;票：行程所列景点首道大门票； &nbsp; &nbsp;&nbsp;</p><p>用 &nbsp;餐：3正2早（正餐八菜一汤，十人一桌，不含酒水）特殊饮食习惯游客，须提前告知 &nbsp;&nbsp;</p><p>保 &nbsp;险：旅行社责任险、建议游客购买旅游人身伤害意外险；</p><p>住 &nbsp;宿：2-3人标准间（如出现单男单女由客人协助导游安排三人间或客人自补单房差）；</p><p>儿 &nbsp;童：（2-12岁）车位费、半价餐费，不含门票、不占床。小孩超过1.2米或12岁以上，则按成人操作。</p>','<p><br/></p><p>行程特色：为贵州旅游代言，全程不进店、不加点、高餐标、充足的游玩时间</p><p><br/></p><p>感受山水林城贵阳魅力 &nbsp;爽爽贵阳欢迎您</p><p><br/></p><p>地球腰带上的绿宝石，国家级风景名胜区；AAAA级景区；中国最美丽的地方之一；中国最美的森林；世界遗产——中国南方喀斯特；国际王牌旅游目的地。东方凯旋门</p><p><br/></p>','',12,NULL,1600,'飞机',3,1441866702,1441867701,'','','','','','37,36',NULL,'45,1,84,85,91,98',0,0,0,'2','','/uploads/2015/0910/2ecb50391cf4b4d6c1b20f19fe5413ee.jpg||,/uploads/2015/0910/793211edb14e904767627a60066c1f9c.jpg||,/uploads/2015/0910/87eaa4abac754a5b4b8a7cb3d79ff977.jpg||,/uploads/2015/0910/062dde7cd00420f4d9934b8213ddf13b.jpg||',NULL,NULL,NULL,NULL,1,1,'line_show.htm','4',NULL,'',0,0),(6,0,5,'贵州荔波大小七孔双飞三日游(畅享)',NULL,'','75',NULL,NULL,1500,3,2,'/uploads/2015/0910/2015091514110715.jpg','','','','','','<p><span style=\"color: rgb(255, 192, 0);\">温馨提示</span><span style=\"color: rgb(255, 192, 0);\">：</span>行程中规定的出发、游览、参观时间为大约时间，特殊情况导游可与游客协商进行调整。为便于散客中心通知游客的乘车时间及接人地点、导游和车牌号，请游客在出行前一天随时保持手机畅通！</p><p><br/></p><p><span style=\"color: rgb(255, 192, 0);\">重要提示</span><span style=\"color: rgb(255, 192, 0);\">：</span></p><p>1、贵州酒店标准比较偏低，请旅游者提前做好心理准备。如遇旺季酒店资源紧张或政府临时征用等特殊情况，我社有权调整为同等级标准酒店。<br/></p><p>2、请成人带好有效的证件（身份证），儿童带好户口本；<br/></p><p>3、贵州用餐口味较重，且普通团队餐厅菜式比较雷同。建议旅游者可自带些面包等干粮佐餐。<br/></p><p>4、如遇人力不可抗拒因素或政策性调整导致无法游览的景点（堵车、封路、塌方等），我社有权取消或更换为其它等价景点，赠送景点费用不退，并有权将景点及住宿顺序做相应调整；部分景区及酒店为方便旅游者有自设的商场及购物场所，并非我社安排的旅游购物店，此类投诉我社无法受理，敬请谅解；<br/></p><p>5、贵州的气候温暖湿润，属亚热带湿润季风气候。气温变化小，冬暖夏凉，气候宜人。受大气环流及地形等影响，贵州气候呈多样性，“一山分四季，十里不同天”。另外，气候不稳定，灾害性天气种类较多，干旱、秋风、凌冻、冰雹等频度大。 在贵州高原旅行需备雨具。3～8月是雨季，9月入秋后至次年3月仍然有雨。<br/></p><p>6、夜间或自由活动期间宜结伴同行并告知导游，记好导游手机号备用，注意人身和财物安全。贵重物品可寄存在酒店前台保险柜，下榻的酒店的名称位置也要记牢，不要随便相信陌生人，特别是三轮摩托车、街头发小广告者，天下没有免费的午餐。<br/></p><p>7、文明旅游、文明出行，自觉爱护景区的花草树木和文物古迹，不随意在景区、古迹上乱涂乱画、不乱丢垃圾、尊重当地少数民族风俗等。很多景区和酒店周边有小摊小贩，如无意购买请不要与其讲价还价，一旦讲好价格不购买的话容易产生矛盾。出游请保持平常的心态，遇事切勿急躁，大家互相体谅、互相帮助。<br/></p><p>8、请配合导游如实填写当地《游客意见书》，游客的投诉诉求以在贵州当地，旅游者自行填写的意见单为主要依据。不填或虚填者归来后的投诉将无法受理，如在行程进行中对旅行社的服务标准有异议，请尽量在当地解决。如在旅游期间在当地解决不了，可在当地备案，提醒：旅游投诉时效为返回出发地起30天内有效。<br/></p><p>9、行程不含的其他当地特色旅游项目及告知内容，如有需求可与当团导游联系，合理安排时间，不给旅游留下遗憾。体验项目当地导游可根据体验的最佳时间进行合理安排；<br/></p><p>10、部分景区由于交通工具的特殊性，故对旅游者的年龄和身体条件有相应的要求。（详见细化行程单中景点介绍）<br/></p><p><br/></p>','','<p>接待标准：</p><p>交 &nbsp;通：往返飞机经济舱、含机建燃油。<br/></p><p>用 &nbsp;车：当地空调旅游大巴；接送机根据人员安排不是旅游车接机无导游。 &nbsp;&nbsp;<br/></p><p>接待标准：<br/></p><p>交 &nbsp;通：往返飞机经济舱、含机建燃油。</p><p>用 &nbsp;车：当地空调旅游大巴；接送机根据人员安排不是旅游车接机无导游。 &nbsp;&nbsp;</p><p>导 &nbsp;游：地接持证优秀国语导游服务； &nbsp;&nbsp;</p><p>门 &nbsp;票：行程所列景点首道大门票； &nbsp; &nbsp;&nbsp;</p><p>用 &nbsp;餐：3正2早（正餐八菜一汤，十人一桌，不含酒水）特殊饮食习惯游客，须提前告知 &nbsp;&nbsp;</p><p>保 &nbsp;险：旅行社责任险、建议游客购买旅游人身伤害意外险；</p><p>住 &nbsp;宿：2-3人标准间（如出现单男单女由客人协助导游安排三人间或客人自补单房差）；</p><p>儿 &nbsp;童：（2-12岁）车位费、半价餐费，不含门票、不占床。小孩超过1.2米或12岁以上，则按成人操作。</p>','<p><br/></p><p>行程特色：为贵州旅游代言，全程不进店、不加点、高餐标、充足的游玩时间</p><p><br/></p><p>感受山水林城贵阳魅力 &nbsp;爽爽贵阳欢迎您</p><p><br/></p><p>地球腰带上的绿宝石，国家级风景名胜区；AAAA级景区；中国最美丽的地方之一；中国最美的森林；世界遗产——中国南方喀斯特；国际王牌旅游目的地。东方凯旋门</p><p><br/></p>','',15,NULL,0,'飞机',3,1442297467,1442298418,'','','','','','37',NULL,'91,84,45,1,85,98',0,0,0,'2','','/uploads/2015/0910/2015091514110715.jpg||,/uploads/2015/0910/2015091514110778.jpg||,/uploads/2015/0910/2015091514110747.jpg||,/uploads/2015/0910/2015091514110779.jpg||',NULL,NULL,NULL,NULL,1,1,'line_show.htm','4',NULL,'',0,0),(7,0,6,'九寨沟—黄龙双汽三日游',NULL,'','75',NULL,NULL,NULL,3,2,'/uploads/2015/0915/170881ec816ec5ce8127d408dfc5ea2c.jpg','','','','','<p>【用车说明】：行程内用车为旅游交通巴士，散客拼团全程可能非同一台车；因延线有行车公里数限制或部分路段维修，易发生堵车，发车时间均较早，行程内标注出发及行车时间均为预计，具体情况略有不同；为保证车辆制动性能，行车延途均需停车加水；行程内所有自由活动期间及行程外均不含用车。请予以理解。四川旅游车均按每人一正座提前一天定车，根据同团人数安排车型，空调限时开放（主要争对坡路上行中为保证动力，无法开放）；保证一人一座，不提供座次要求；若因大交通（如：航班、火车等）延误、取消、造成无法按时参加我社旅游出团计划者，需向我社交已经产生的旅游车位损失费及行程及合同约定的其它已产生费用。</p><p><br/></p><p>【餐饮说明】：景区段所含早、晚餐均在所住酒店就餐，中餐在沿路指定餐厅就餐（九寨沟沟内餐未含），但当地饮食与游客饮食习惯有一定的差异，且九寨沟菜品均由成都运进，餐饮条件相当有限，请做好心理准备，旅行社已尽心安排特色菜品，希望能合你的味口，建议您自备榨菜，香辣酱等合适自己品味的佐料；为了保证顺利用餐，行程中所有用餐均为提前预定，如若你在行程中取消用餐，费用一律不退；因路途遥远，有可能不能按时用餐，请带好巧克力、饼干等干粮。</p><p><br/></p><p><br/></p><p>【住宿说明】：九寨沟沿线住宿硬件和软件条件都有限，请不要以城市的标准来衡量，敬请谅解！（为提倡绿色环保，酒店基本不提供一次性洗漱用品，游客需自备）；行程中提到的酒店名称，为经济舒适型住宿，是非国家旅游局授牌的星级酒店，仅指旅行社行业内部评称，特别告知！；地区特殊，酒店服务人员未经过专业培训上岗；因特殊气候酒店易潮湿，电力供应无法24小时开启（主要是空调），热水限时供应，一般为早06：30-08：00，晚20：00—24：00，太阳能热水器根据天气和使用人数决定水温，不稳定。如遇临时断水断电等因素造成部分设施无法使用，敬请谅解。同等级酒店的设施因地区不同而有较大差距，遇特殊原因（如天气，交通，地面，酒店接待能力），可能变更住宿地点，客人不可指定住任何酒店，须随团安排，标准不变。2人及以下出行（1大，1大1小，2大要求分房的）必须补房差。3人以上可补房差亦可安排加床（加床为钢丝床或床垫），旅行社不在行程中提供自然单间和拼房服务，亦不接受楼层及特殊房型指定；因计划用房，房差需于出行前团款中付清；行程内酒店住宿押金均为客人自付自退。</p><p>我社常住酒店：</p><p>九寨沟：金江国际、牙扎藏寨、金龙人家、满驿卡仓、龙康藏寨、雪山大酒店、星光大酒店、大藏风酒店、西北酒店、达吉宾馆、雪山人家、蓝天宾馆、九寨沟宾馆、鑫源大酒店、雄狮山庄贵宾楼、九州宾馆、九宫宾馆、鑫隆宾馆、金龙山庄、龙达酒店、东藏阳光、九缘情、香巴拉、平安客栈、藏之韵、松赞林卡、瑞西、银丰宾馆、同九山庄、雪域天居、长青宾馆、神山宾馆、扎西宾馆、九凤宾馆、九波尔沙迦、安多人家、云庭酒店、龙康大酒店、锦绣宾馆、金鹰山庄、奕丰宾馆、新福鑫、藏寨人间、九安宾馆、永竹林卡、友贵宾馆或同级酒店及藏寨客栈。</p><p>川主寺：圣地山庄、圣地贵宾楼、西部瑶池、新良酒店、邮电宾馆、富贵林酒店、川龙山庄、荣达鑫池、川主寺大酒店、纳玛宾馆、亚日酒店、大草原酒店、黄龙宾馆、岷江源二期、岷源山庄、阳光酒店、新良大酒店、义德大酒店或同级酒店。</p><p>注：以上酒店未挂星，当日住宿酒店为其中一家（由于旺季期间客多酒店少，可能为同级酒店或藏寨、羌寨客栈）。</p><p><br/></p><p><br/></p><p>【门票说明】：含九寨沟门票及观光车和黄龙门票，1.1米以下儿童免门票，但需大人带领进入景区。持各类特殊有效证件（如：军官证、老年证、学生证、残疾证等优惠证件）由导游现退，（如：军残、70以上老人等免票证件）由导游现退。</p><p><br/></p><p>【小孩标准】：小孩12岁以下含汽车车位、半餐费、导游服务、保险。</p><p><br/></p><p>【购物和自费游览活动说明】：川主寺镇雪宝顶超市。</p><p><br/></p>','','','','','',15,NULL,0,'汽车',2,1442298727,1442980898,'','<p>&nbsp;住宿）：单房差（若产生单男单女或自然单间我社有权安排三人间，或客人自付单房差）。</p><p>（其他）：其它个人消费，成都食宿、各地至成都往返大交通、景区便民设施，交通保险、行程 中约定的自理自费内容、酒水、个人消费、景区内索道、沿途小门票、行程中备注未含的餐及住宿等！请当地现付，备有说明除外。</p><p><br/></p>','','','','36,38,40',NULL,'45,146',0,0,0,'2','九寨沟—黄龙双汽三日','/uploads/2015/0915/170881ec816ec5ce8127d408dfc5ea2c.jpg||',NULL,NULL,NULL,NULL,1,1,'line_show.htm','',NULL,'',0,0),(8,0,7,'九寨沟、黄龙自由行三日游',NULL,'','75',NULL,NULL,260,3,2,'/uploads/2015/0923/bb540b97caf6ed11d0b3067c5715c1a1.jpg','','','','','<p><span style=\"color: rgb(0, 0, 0);\">【交通】：鉴于山路崎岖、弯道多，我社提供的车辆以动力强劲，安全性高、舒适性好的小型车为主，拼车根据人数定车型，车型以轿车、商务车为主。小型车还有一个优点在于将沿途坐车的时间缩短，可以有更多的时间欣赏沿途风光和下车照相</span></p><p><span style=\"color: rgb(0, 0, 0);\">【司机】：全程技艺高超，经验丰富的司机为您服务</span></p><p><span style=\"color: rgb(0, 0, 0);\">【住宿】：沿途均入住标准双人间，带独立卫生间，有热水，干净整洁（由于地处高原藏区，住宿条件不能和大城市的酒店比，敬请客人理解）</span></p><p><span style=\"color: rgb(0, 0, 0);\">【保险】：代办旅游意外保险最高赔付10万元/人。因道路交通事故造成的客人意外伤害，按《道路交通事故处理方法》由保险公司赔偿。本公司不承担另外的赔偿责任</span></p><p><br/></p>','','','<p>【交通】：鉴于山路崎岖、弯道多，我社提供的车辆以动力强劲，安全性高、舒适性好的小型车为主，拼车根据人数定车型，车型以轿车、商务车为主。小型车还有一个优点在于将沿途坐车的时间缩短，可以有更多的时间欣赏沿途风光和下车照相</p><p>【司机】：全程技艺高超，经验丰富的司机为您服务</p><p>【住宿】：沿途均入住标准双人间，带独立卫生间，有热水，干净整洁（由于地处高原藏区，住宿条件不能和大城市的酒店比，敬请客人理解）</p><p>【保险】：代办旅游意外保险最高赔付10万元/人。因道路交通事故造成的客人意外伤害，按《道路交通事故处理方法》由保险公司赔偿。本公司不承担另外的赔偿责任。</p><p><br/></p>','','',27,NULL,450,'汽车',2,1442986301,1443072105,'','<p>【导 游】：无导游（九寨沟景区观光车上里有导游）</p><p>【用 餐】：全程不含餐，随心所欲自行安排（司机会在用餐时间、选择最佳特色餐厅停靠） (司机的用餐由客人负责，若不 负责餐则为60元/天，由全车人平摊)</p><p>【门 票】：九寨沟门票220元/人，观光车费90元/人，黄龙门票200元/人，黄龙索道上行80元/人，下行40元/人，九寨沟晚会120元/人；走进臧家烤羊晚会烤羊80元/人</p><p>【其 它】个人消费及自娱自乐费用；</p><p><br/></p>','','#990099','','36,38,40',NULL,'91,84,45,147,86,98',95,2663,0,'2','全程自己安排旅途时间，不用跟团一起起早贪黑！','/uploads/2015/0910/d71ac6d353237f386e75027b351692a9.jpg||,/uploads/2015/0923/bb540b97caf6ed11d0b3067c5715c1a1.jpg||',NULL,NULL,NULL,NULL,1,1,'line_new/line_show.htm','',NULL,'',1,0);

/*Table structure for table `sline_line_attr` */

DROP TABLE IF EXISTS `sline_line_attr`;

CREATE TABLE `sline_line_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `attrname` varchar(255) DEFAULT NULL,
  `displayorder` int(11) unsigned DEFAULT NULL,
  `isopen` int(11) unsigned DEFAULT '0',
  `issystem` int(11) unsigned DEFAULT '0',
  `channeldispaly` int(1) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_PID_ID` (`pid`,`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8;

/*Data for the table `sline_line_attr` */

insert  into `sline_line_attr`(`id`,`webid`,`aid`,`attrname`,`displayorder`,`isopen`,`issystem`,`channeldispaly`,`pid`,`destid`,`litpic`,`description`) values (1,0,1,'跟团游',1,1,0,0,45,NULL,NULL,NULL),(45,0,42,'旅行方式',1,1,0,0,0,'4149',NULL,NULL),(84,0,81,'交通选择',2,1,0,0,0,NULL,NULL,NULL),(85,0,82,'飞机团',2,1,0,0,84,NULL,NULL,NULL),(86,0,83,'汽车团',1,1,0,0,84,NULL,NULL,NULL),(88,0,85,'游轮',6,0,0,0,84,NULL,NULL,NULL),(89,0,86,'双卧',3,0,0,0,84,NULL,NULL,NULL),(90,0,87,'单卧单飞',4,0,0,0,84,NULL,NULL,NULL),(91,0,88,'节日特惠',3,1,0,0,0,NULL,NULL,NULL),(92,0,89,'元旦',1,0,0,0,91,NULL,NULL,NULL),(93,0,90,'春节',2,1,0,0,91,NULL,NULL,NULL),(94,0,91,'端午',5,0,0,0,91,NULL,NULL,NULL),(95,0,92,'五一',4,1,0,0,91,NULL,NULL,NULL),(96,0,93,'清明',5,1,0,0,91,NULL,NULL,NULL),(97,0,94,'中秋',6,1,0,0,91,NULL,NULL,NULL),(98,0,95,'国庆',7,1,0,0,91,NULL,NULL,NULL),(142,0,136,'自由人',2,0,0,NULL,45,NULL,NULL,NULL),(143,0,137,'半自由人',3,0,0,NULL,45,NULL,NULL,NULL),(144,0,138,'自驾游',4,0,0,NULL,45,NULL,NULL,NULL),(145,0,139,'代驾游',5,1,0,NULL,45,NULL,NULL,NULL),(146,0,NULL,'自助游',NULL,1,0,NULL,45,NULL,NULL,NULL),(147,0,NULL,'自由行',NULL,1,0,NULL,45,NULL,NULL,NULL),(148,0,NULL,'包车游',NULL,0,0,NULL,45,NULL,NULL,NULL);

/*Table structure for table `sline_line_content` */

DROP TABLE IF EXISTS `sline_line_content`;

CREATE TABLE `sline_line_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '1',
  `columnname` varchar(30) DEFAULT NULL COMMENT '在线路中使用的字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL,
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isline` int(1) DEFAULT '0',
  `isrealfield` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='线路内容分类表';

/*Data for the table `sline_line_content` */

insert  into `sline_line_content`(`id`,`webid`,`columnname`,`chinesename`,`displayorder`,`issystem`,`isopen`,`isline`,`isrealfield`) values (2,0,'jieshao','行程安排',3,1,1,0,0),(3,0,'biaozhun','标准',4,0,1,0,1),(4,0,'beizu','备注',8,0,1,0,1),(5,0,'payment','签约付款',7,1,1,0,1),(6,0,'feeinclude','费用包含',5,0,1,0,1),(7,0,'features','线路特色',2,1,1,0,1),(8,0,'reserved1','简要行程',1,0,1,0,1),(9,0,'reserved2','费用不含',6,0,1,0,1),(10,0,'reserved3','签证',9,0,1,0,1),(11,0,'tupian','图片',0,1,0,0,0);

/*Table structure for table `sline_line_day` */

DROP TABLE IF EXISTS `sline_line_day`;

CREATE TABLE `sline_line_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `word` int(3) unsigned DEFAULT NULL COMMENT '天数(只能输入数字)',
  `isdisplay` int(1) unsigned DEFAULT '0' COMMENT '是否在前台显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='线路天数分类表';

/*Data for the table `sline_line_day` */

insert  into `sline_line_day`(`id`,`webid`,`aid`,`word`,`isdisplay`) values (1,0,1,1,0),(2,0,2,2,0),(3,0,3,3,0),(4,0,4,4,0),(5,0,5,5,0),(6,0,6,6,0),(7,0,7,7,0),(8,0,8,8,0),(9,0,9,9,0),(10,0,10,10,0);

/*Table structure for table `sline_line_dayspot` */

DROP TABLE IF EXISTS `sline_line_dayspot`;

CREATE TABLE `sline_line_dayspot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned NOT NULL DEFAULT '1',
  `lineid` int(11) unsigned DEFAULT NULL COMMENT '线路id',
  `spotname` varchar(255) DEFAULT '' COMMENT '景点名称',
  `spotid` int(11) DEFAULT NULL COMMENT '景点id',
  `litpic` mediumtext COMMENT '缩略图',
  `displayorder` int(11) DEFAULT '9999' COMMENT '显示顺序',
  `day` int(11) unsigned DEFAULT '0' COMMENT '显示在第几天',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='线路途径景点表';

/*Data for the table `sline_line_dayspot` */

/*Table structure for table `sline_line_extend` */

DROP TABLE IF EXISTS `sline_line_extend`;

CREATE TABLE `sline_line_extend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '标识',
  `lineid` int(11) NOT NULL COMMENT '线路ID',
  `istemplets` int(2) NOT NULL,
  `relativeraider` varchar(50) NOT NULL,
  `relativehotel` varchar(50) NOT NULL COMMENT '关联酒店',
  `relativeticket` varchar(50) NOT NULL COMMENT '关联机票',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_line_extend` */

/*Table structure for table `sline_line_extend_field` */

DROP TABLE IF EXISTS `sline_line_extend_field`;

CREATE TABLE `sline_line_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='线路字段扩展表';

/*Data for the table `sline_line_extend_field` */

/*Table structure for table `sline_line_jieshao` */

DROP TABLE IF EXISTS `sline_line_jieshao`;

CREATE TABLE `sline_line_jieshao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lineid` int(11) unsigned DEFAULT NULL,
  `day` int(11) unsigned DEFAULT NULL COMMENT '第N天',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `breakfirsthas` tinyint(1) DEFAULT '0' COMMENT '早餐是否选择',
  `breakfirst` varchar(255) DEFAULT NULL,
  `transport` varchar(255) DEFAULT NULL COMMENT '交通',
  `hotel` varchar(255) DEFAULT NULL COMMENT '住宿',
  `jieshao` text COMMENT '行程内容',
  `lunchhas` tinyint(1) DEFAULT '0',
  `lunch` varchar(255) DEFAULT NULL COMMENT '午餐描述',
  `supperhas` tinyint(1) unsigned DEFAULT '0' COMMENT '是否有晚餐',
  `supper` varchar(255) DEFAULT NULL COMMENT '晚餐描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `sline_line_jieshao` */

insert  into `sline_line_jieshao`(`id`,`lineid`,`day`,`title`,`breakfirsthas`,`breakfirst`,`transport`,`hotel`,`jieshao`,`lunchhas`,`lunch`,`supperhas`,`supper`) values (1,1,1,'成都（128KM）乐山大佛（37KM）峨眉山',0,'','汽车','峨眉山','<p>早上6:00左右由成都统一出发(128KM)沿途欣赏四川平原优美的田园风光，经双流，新津，彭山，东坡故里眉山，国家5A级景区---乐山大佛风景区,参观岷江,青衣江大渡河的三江汇合后跟随导游进入神秘的大佛景区参观中国三大千年古刹之一的乐山凌云寺。登唐朝时期的古栈道---九曲古栈道在瞻仰乐山大佛宏伟气势的同时，体验“蜀道难、难于上青天的感觉”，抱千年佛脚后，游漫山的石刻佛像，在佛家圣地洗净心灵。</p><p>​之后游览东方佛像雕刻瑰宝---东方佛（自理80+10讲解费元/人），体验世界最长卧佛之神秘与雄伟，现有各类大小佛像雕塑3000余尊，均为四川美院教授们的群雕，既传承了几千年来传统佛文化的神韵，又注重了现代雕塑造型的完美，留下了现代人摩崖造像的痕迹，之后前往“禅缘/福晶堂/万馥楼”(通过讲解员专业的佛教知识介绍，从而体会和感受博大精深佛教文化的魅力所在，客人根据自己的信仰和需求观佛、礼佛、请佛。）之后乘车前往乌木博物馆（自理180+10讲解费元/人)和仙芝竹尖熊猫馆（自理80+10讲解费元/人）之后前往佛教圣地休闲天堂—峨眉山，入住酒店休息,之后观赏集四川各地绝活为一体的巴蜀绝技盛宴晚会（自理200元/起），节目包括：吐火、滚灯、变脸、峨眉童子功等精彩绝活。饱完眼福后回酒店休息。<br/></p><p><br/></p>',1,'',1,''),(2,1,2,'峨眉山（180KM）成都',0,'','汽车','温馨的家','<p>早上大约6：00左右出发游览峨眉山风景区, 乘坐峨眉山景区观光车（车程2小时左右）上雷洞坪，步行1.5公里（30分钟左右)到接引殿乘坐金顶索道（自理120元/人往返）。上【金顶】，游华藏寺、金殿、银殿、铜殿、大型观景台等，观世界最高佛教朝拜中心。登摄身崖，充分感受峨眉“雄，秀，奇，险，幽”的五大特色。之后原路返回，从雷洞坪停车场乘观光车到万年寺停车场，乘索道（自理65元/人上行）至万年索道上站，步行至道普贤菩萨道场——万年寺（自理10元/人），之后沿山路步行至白蛇修道成精的白龙洞、清音阁、清音平湖、黑龙江栈道、一线天，自然生态区、原路返回到清音阁，然后至五显岗，下午约18：30分从峨眉山乘车返回成都，结速愉快的旅程！</p>',0,'',NULL,''),(3,2,1,'成都（128KM）乐山大佛（37KM）峨眉山',0,'','汽车','峨眉山','<p>早上6:00左右由成都统一出发(128KM)沿途欣赏四川平原优美的田园风光，经双流，新津，彭山，东坡故里眉山，国家5A级景区---乐山大佛风景区,参观岷江,青衣江大渡河的三江汇合后跟随导游进入神秘的大佛景区参观中国三大千年古刹之一的乐山凌云寺。登唐朝时期的古栈道---九曲古栈道在瞻仰乐山大佛宏伟气势的同时，体验“蜀道难、难于上青天的感觉”，抱千年佛脚后，游漫山的石刻佛像，在佛家圣地洗净心灵。</p><p>​之后游览东方佛像雕刻瑰宝---东方佛（自理80+10讲解费元/人），体验世界最长卧佛之神秘与雄伟，现有各类大小佛像雕塑3000余尊，均为四川美院教授们的群雕，既传承了几千年来传统佛文化的神韵，又注重了现代雕塑造型的完美，留下了现代人摩崖造像的痕迹，之后前往“禅缘/福晶堂/万馥楼”(通过讲解员专业的佛教知识介绍，从而体会和感受博大精深佛教文化的魅力所在，客人根据自己的信仰和需求观佛、礼佛、请佛。）之后乘车前往乌木博物馆（自理180+10讲解费元/人)和仙芝竹尖熊猫馆（自理80+10讲解费元/人）之后前往佛教圣地休闲天堂—峨眉山，入住酒店休息,之后观赏集四川各地绝活为一体的巴蜀绝技盛宴晚会（自理200元/起），节目包括：吐火、滚灯、变脸、峨眉童子功等精彩绝活。饱完眼福后回酒店休息。<br/></p><p><br/></p>',1,'',1,''),(4,2,2,'峨眉山（180KM）成都',0,'','汽车','温馨的家','<p>早上大约6：00左右出发游览峨眉山风景区, 乘坐峨眉山景区观光车（车程2小时左右）上雷洞坪，步行1.5公里（30分钟左右)到接引殿乘坐金顶索道（自理120元/人往返）。上【金顶】，游华藏寺、金殿、银殿、铜殿、大型观景台等，观世界最高佛教朝拜中心。登摄身崖，充分感受峨眉“雄，秀，奇，险，幽”的五大特色。之后原路返回，从雷洞坪停车场乘观光车到万年寺停车场，乘索道（自理65元/人上行）至万年索道上站，步行至道普贤菩萨道场——万年寺（自理10元/人），之后沿山路步行至白蛇修道成精的白龙洞、清音阁、清音平湖、黑龙江栈道、一线天，自然生态区、原路返回到清音阁，然后至五显岗，下午约18：30分从峨眉山乘车返回成都，结速愉快的旅程！</p>',0,'',NULL,''),(7,4,1,'成都——曼谷',0,'','飞机','','<p>14:00&nbsp;</p><p>于指定时间在成都双流国际机场航站楼集合，由领队带领办理相关出国手续。搭乘班机自成都直飞“天使之都”—曼谷（约3小时）</p><p>17：00</p><p>行程距离: 约1871公里 | 飞行时间: 约3小时</p><p>航班: 参考航班：MU5035 17:00/19:10或泰国航空 TG619 16:05/18:10 具体航班时间以出团通知书为准</p><p>19：10</p><p>行驶距离: 约0公里 | 行驶时间: 约20分钟 | 活动时间: 约30分钟</p><p>抵达后泰国机场，后入住酒店休息。</p><p>20：50</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟</p><p>前往酒店: Royal River Hotel Bangkok（曼谷皇家河畔酒店）&nbsp;</p><p><br/></p>',0,'',1,''),(8,4,2,'曼谷',1,'','汽车','','<p>07：30</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约40分钟</p><p>早餐: 酒店自助餐</p><p>08：30</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 游览时间: 约1小时</p><p>北榄鳄鱼湖动物园</p><p>世界上最大的人工养殖鳄鱼场，有16万条鳄鱼，有淡水、咸水和尖嘴三大类外，还有来自世界各国的名鳄，如中国的扬子鳄、南美巴拉圭凯门鳄、新几内亚鳄、美国密西西比河鳄鱼等。</p><p>北揽鳄鱼湖动物园是泰国著名游览胜地，离曼谷市区10公里动物园占地500亩，是世界著名的鳄鱼养殖场。养殖场内分池饲养着泰国以及世界各地20多种大小鳄鱼，其中包括南美、非洲和澳洲的各类咸淡水鳄鱼以及印度的尖嘴鳄、中国扬子鳄等，共计4万多条。大的重千斤，小的才孵化出来不到一尺，从灰褐色鳄鱼到珍贵的白色鳄鱼，应有尽有。</p><p>11：30</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 用餐时间: 约1小时</p><p>午餐: A-ONE HOTEL 自助餐</p><p>13：30</p><p>行驶距离: 约45公里 | 行驶时间: 约30分钟 | 游览时间: 约50分钟</p><p>&nbsp;大皇宫</p><p>大皇宫</p><p>是曼谷保存最完美、最壮观、规模最大、最有民族特色的王宫，汇集了泰国建筑、绘画、雕刻和园林艺术的精粹。</p><p>&nbsp;玉佛寺</p><p>玉佛寺</p><p>玉佛寺以尖顶装饰、建筑装饰、回廊壁画三大特色名扬天下，体现了泰国佛教建筑、雕刻、绘画的艺术瑰宝。镀金佛塔、漆成绿色的屋顶瓦片和嵌有马赛克柱子是其代表作品。</p><p>15：00</p><p>行驶距离: 约20公里 | 行驶时间: 约30分钟 | 游览时间: 约1小时</p><p>郑王庙是泰国皇家寺庙之一，是纪念泰国第41代君王、民族英雄郑昭的寺庙。规模庞大，仅次于大皇宫和玉佛寺。主塔庙堂现供有郑昭王像及遗物，殿内悬有中国式的灯笼。</p><p>湄南河流经大城，贯穿曼谷市区，在城市交通运输及岸边居民生活中扮演着重要角色。在过去，曼谷曾被称为“东方威尼斯”。湄南河白天有水上市场，运输船只往来；待天色渐暗，沿岸的灯光纷纷亮起，穿梭在河面上的观光游船纷纷出航，湄南河又展现出另一种风情。</p><p>18：30</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 用餐时间: 约1小时</p><p>晚餐: 76层白玉楼空中餐厅</p><p>20：00</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟</p><p>前往酒店: Royal River Hotel Bangkok（曼谷皇家河畔酒店）&nbsp;</p><p><br/></p>',1,'',1,''),(9,4,3,'曼谷—芭堤雅',1,'','汽车','','<p>07：30</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约40分钟</p><p>早餐: 酒店自助餐</p><p>08：00</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 购物时间: 约1小时</p><p>泰国皇家珠宝展示中心</p><p>营业产品:红、黄、蓝宝石</p><p>12：00</p><p>行驶距离: 约120公里 | 行驶时间: 约1小时 | 用餐时间: 约40分钟</p><p>午餐: 是拉差美味餐</p><p>13：30</p><p>行驶距离: 约20公里 | 行驶时间: 约20分钟 | 活动时间: 约30分钟</p><p>骑大象</p><p>大象是泰国最著名的吉祥动物之一，骑在大象上沾沾好运气。</p><p>14：00</p><p>行驶距离: 约60公里 | 行驶时间: 约1小时 | 游览时间: 约3小时</p><p>九世王御园</p><p>九世王御园是泰国最大的公园和植物园，是为庆祝拉玛九世国王普密蓬·阿杜德的60寿辰，于1987年兴建的。</p><p>蜡像馆</p><p>蜡像馆内供奉的20尊塑像，都是泰国历史上的著名高僧。这些蜡像与真人一般大小，神态各异，精细得连面部皱纹、眉毛都与真人毫无二至，个个慈眉善目端庄自然，栩栩如生。</p><p>七珍佛山</p><p>16：30</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 游览时间: 约1小时30分钟</p><p>&nbsp;四合镇水乡</p><p>四合镇水乡</p><p>古色古香的传统泰式木屋兴建在迂回的河道上，形成独特的水上人家，岸边是贩卖琳琅商货的水上市场，同时这里也是电影《杜拉拉升职记》的实景拍摄地之一。</p><p>芭堤雅的水上四季村市场被称为泰国的威尼斯水城。水上四季村市场是电影《杜拉拉升职记》的取景点之一。拥有泰国传统特色的水上四季村体现了淳朴的泰国风情，里面有供娱乐的游船,有穿越水域的索道，也有泰国的特产。带着斗笠的泰国妇女摇桨缓慢前行在错落的绿色运河上，沿岸有几百家各色商铺。在这里你可以体验到纯真的萨瓦迪卡！</p><p>18：30</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约1小时</p><p>晚餐: 敬请自理</p><p>19：30</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 游览时间: 约1小时</p><p>芭堤雅罗马金剧场人妖秀</p><p>秀场以仿罗马神鬼战士斗兽场为主题的外观设计，厅内欧式巴洛克装潢；亮丽典雅。在芭提雅人妖秀场场爆满，更是吸引一批批客人蜂拥来至。</p><p>20：30</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟</p><p>前往酒店: Sigma Resort Jomtien(芭堤雅西格玛乔木提恩度假村)&nbsp;</p><p><br/></p>',1,'',1,''),(10,4,4,'芭堤雅——金沙岛（又名阁兰岛）——芭堤雅',1,'','汽车','','<p>07：30</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约40分钟</p><p>早餐: 酒店自助餐</p><p>08：00</p><p>行驶距离: 约20公里 | 行驶时间: 约30分钟 | 游览时间: 约3小时</p><p>金沙岛是芭堤雅海湾最大的离岛。金沙岛海滩呈月牙形，靠海的一圈是沙滩，沙子很细腻，是晒日光浴的绝佳去处，还可以游泳。岛上有提供海鲜大餐的餐厅，还有按摩中心。</p><p>又名阁兰岛，该岛素以“海中有岛，岛中有湖，湖中有岛”而闻名，风景秀丽，沙子洁白细幼，海水清澈见底，构成了罕见的海上奇观，随着潮水的涨落，岛的宽度不断变化，使得整岛仪态万千。在这里，你可以自由自在的欣赏芭堤雅的美景，惬意享受沙滩日光浴</p><p>12：00</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约1小时</p><p>午餐: 阁兰岛海鲜餐</p><p>13：00</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 游览时间: 约1小时30分钟</p><p>自由活动:</p><p>指定时间14:30集合</p><p>15：00</p><p>行驶距离: 约20公里 | 行驶时间: 约30分钟</p><p>快艇返回芭堤雅</p><p>16：00</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 游览时间: 约1小时</p><p>泰式古法按摩及养生茶</p><p>17：00</p><p>行驶距离: 约15公里 | 行驶时间: 约35分钟 | 购物时间: 约30分钟</p><p>原石博物馆</p><p>营业产品:参观红黄蓝宝石</p><p>18：00</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约1小时</p><p>晚餐: 酒店或泰式BBQ</p><p>19：30</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟</p><p>前往酒店: Sigma Resort Jomtien(芭堤雅西格玛乔木提恩度假村)</p><p><br/></p>',1,'',1,''),(11,4,5,'芭堤雅——曼谷',1,'',NULL,'','<p style=\"white-space: normal;\">07：30</p><p style=\"white-space: normal;\">行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约40分钟</p><p style=\"white-space: normal;\">早餐: 酒店自助餐</p><p style=\"white-space: normal;\">09：00</p><p style=\"white-space: normal;\">行驶距离: 约20公里 | 行驶时间: 约40分钟 | 游览时间: 约1小时</p><p style=\"white-space: normal;\">芭堤雅神殿寺</p><p style=\"white-space: normal;\">神殿寺位于芭堤雅与曼谷之间，寺内供奉有一尊四面佛，据说神殿寺的四面佛非常灵验，人称“有求必应佛”，所以香火一直很旺。该佛有四尊佛面，从正面开始顺时针依次为：健康平安、事业有成、婚姻美满、财运亨通。此佛可掌管人世间的一切事物，是泰国香火最旺的佛像之一。对于信奉佛教的人来说，到曼谷不到神殿寺拜四面佛，就如同入庙不拜神一样。</p><p style=\"white-space: normal;\">12：00</p><p style=\"white-space: normal;\">行驶距离: 约20公里 | 行驶时间: 约40分钟 | 用餐时间: 约40分钟</p><p style=\"white-space: normal;\">午餐: 泰式火锅</p><p style=\"white-space: normal;\">13：00</p><p style=\"white-space: normal;\">行驶距离: 约20公里 | 行驶时间: 约40分钟 | 购物时间: 约30分钟</p><p style=\"white-space: normal;\">曼谷精品皮具中心</p><p style=\"white-space: normal;\">营业产品:曼谷精品皮具中心</p><p style=\"white-space: normal;\">14：00</p><p style=\"white-space: normal;\">行驶距离: 约20公里 | 行驶时间: 约40分钟 | 游览时间: 约2小时</p><p style=\"white-space: normal;\">King Power国际免税店</p><p style=\"white-space: normal;\">17：30</p><p style=\"white-space: normal;\">行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约1小时</p><p style=\"white-space: normal;\">晚餐: 敬请自理</p><p style=\"white-space: normal;\">18：30</p><p style=\"white-space: normal;\">行驶距离: 约50公里 | 行驶时间: 约1小时30分钟 | 游览时间: 约2小时</p><p style=\"white-space: normal;\">曼谷唐人街在曼谷市区西部，是城区最繁华的商业区之一，由Th Sampeng（三聘街）、Th Yaowarat（耀华路）、Th Charoen Krung（石龙军路）三条大街以及许多街巷连接而成。其规模及繁华程度，在东南亚各地的唐人街中，堪称魁首。</p><p style=\"white-space: normal;\">20：00</p><p style=\"white-space: normal;\">行驶距离: 约20公里 | 行驶时间: 约40分钟</p><p style=\"white-space: normal;\">前往酒店: Royal River Hotel Bangkok（曼谷皇家河畔酒店） 或 Royal City Hotel Bangkok（曼谷皇家城市酒店） 或 Luxor Bangkok（曼谷拉克索酒店） 或 Jazzotel Hotel Bangkok(爵士特酒店) 或 Town in Town Hotel Bangkok(曼谷城中城酒店) 或 H2DO RESORT&amp;HOTEL (H2DO度假酒店)</p><p><br/></p>',1,'',1,''),(12,4,6,'曼谷——成都',1,'','汽车,火车','','<p>00：20</p><p>行驶距离: 约0公里 | 行驶时间: 约20分钟 | 活动时间: 约30分钟</p><p>返回成都双流国际机场，散团，结束愉快行程！</p><p>07：30</p><p>行驶距离: 约0公里 | 行驶时间: 约10分钟 | 用餐时间: 约40分钟</p><p>早餐: 酒店自助餐</p><p>08：00</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 购物时间: 约30分钟</p><p>皇家毒蛇研究中心</p><p>营业产品:解毒丹，调经丸，风湿丸等</p><p>11：00</p><p>行驶距离: 约20公里 | 行驶时间: 约40分钟 | 用餐时间: 约40分钟</p><p>午餐: 泰式围餐</p><p>14：00</p><p>指定时间集合，乘车前往曼谷国际机场</p><p>17：20</p><p>行程距离: 约1871公里 | 飞行时间: 约3小时</p><p>航班: 参考航班：MU5036 20:20/00:20 或泰国航空 TG618 10:55/15:05 具体航班时间以出团通知书为准</p><p><br/></p>',1,'',NULL,''),(13,5,1,' 成都——贵阳',0,'',NULL,'贵阳','<p>​成都双流机场集合乘机前往林城贵阳抵达后接机入住酒店</p>',0,'',NULL,''),(14,5,2,'贵阳—荔波',0,'','飞机','','<p>早抵达后贵阳火车站通达饭店门口集合出发，乘空调旅游车（大约3.5小时）11:00左右抵达麻尾用中餐，后乘车（约40分钟）12:40左右到达中国最美丽的地方——荔波【小七孔】景区。换成景区观光车浏览景点主要景点有：小七孔古桥、拉雅瀑布、68级叠水瀑布、水上森林、卧龙潭、翠谷瀑布等。满眼的绿色，满身的清凉，满心的欢悦，让自己的疲惫身心在天堂般的美景中完全地放松，尽情地享受。（全程游览3.5个小时左右）  晚饭后8.00观看大型水上实景演出《水韵樟江》（观看1小时10分钟）</p>',0,'',NULL,''),(15,5,3,'荔波——贵阳',0,'',NULL,'','<p>早餐后从荔波下榻的酒店前往【大七孔景区】（车程30分钟），步行游览以原始森林、峡谷、地下河为主体的大七孔，主要景点有：恐怖峡、天生桥、妖风洞等美景，传说游人到此不能高声叫喊，否则恐怖峡就会飞沙走石，妖风洞就会旋起狂风，洪水突然袭来，水春河就见不着鱼的影子。令游人感到大七孔景区的神秘莫测（全程游览2个小时）。中餐后返贵阳，结束愉快的荔波之行。晚乘机返成都结束愉快旅程。返回温馨的家。</p>',0,'',NULL,''),(16,6,1,' 成都——贵阳',0,'',NULL,'贵阳','<p>​成都双流机场集合乘机前往林城贵阳抵达后接机入住酒店</p>',0,'',NULL,''),(17,6,2,'贵阳—荔波',0,'','飞机','','<p>早抵达后贵阳火车站通达饭店门口集合出发，乘空调旅游车（大约3.5小时）11:00左右抵达麻尾用中餐，后乘车（约40分钟）12:40左右到达中国最美丽的地方——荔波【小七孔】景区。换成景区观光车浏览景点主要景点有：小七孔古桥、拉雅瀑布、68级叠水瀑布、水上森林、卧龙潭、翠谷瀑布等。满眼的绿色，满身的清凉，满心的欢悦，让自己的疲惫身心在天堂般的美景中完全地放松，尽情地享受。（全程游览3.5个小时左右）  晚饭后8.00观看大型水上实景演出《水韵樟江》（观看1小时10分钟）</p>',0,'',NULL,''),(18,6,3,'荔波——贵阳',0,'',NULL,'','<p>早餐后从荔波下榻的酒店前往【大七孔景区】（车程30分钟），步行游览以原始森林、峡谷、地下河为主体的大七孔，主要景点有：恐怖峡、天生桥、妖风洞等美景，传说游人到此不能高声叫喊，否则恐怖峡就会飞沙走石，妖风洞就会旋起狂风，洪水突然袭来，水春河就见不着鱼的影子。令游人感到大七孔景区的神秘莫测（全程游览2个小时）。中餐后返贵阳，结束愉快的荔波之行。晚乘机返成都结束愉快旅程。返回温馨的家。</p>',0,'',NULL,''),(19,7,1,'成都—汶川—黄龙—川主寺或九寨沟',0,'','汽车','九寨沟或川主寺','<p>成都—汶川—黄龙—川主寺或九寨沟</p><p>早上成都指定时间与地点集合，统一出发，一路沿岷江逆流而上，沿途观赏成都平原风光。途径汶川、茂县、松潘，沿途可看到藏族、羌族的独特民居、碉楼等建筑物。全程约400多公里，需8小时左右，途中可停留休息、上洗手间（全程洗手间均收费1-2元）。午餐后前往松潘县境内的“人间瑶池”黄龙，黄龙的数千个钙化彩池形态各异，流光泛彩，长达2500米的钙化硫是世界之最。沿途主要景点有【洗身洞、金沙铺地、盆景池、黄龙洞、黄龙寺、石塔镇海、五彩池】等，后乘车抵达川主寺或九寨沟。晚餐后自愿参加走进藏家活动，品尝当地手抓肉及爽口的青稞酒、酥油茶。</p><p><br/></p><p>温馨提示——游览黄龙推荐采用以下二种方式：</p><p><br/></p><p>（黄龙风景区为龙形的一条沟，沟内有两条栈道，一条上山栈道，一条下山栈道。黄龙景区所有景点位于下山栈道两边）</p><p><br/></p><p>步行沿上山栈道上，下山栈道下。往返8.5KM，均为山路。海拔3010米-3930米。</p><p><br/></p><p>选择乘索道上行（80元/人，自理），索道将游客送至与最高点五彩池景区海拔持平的地方，走平路（栈道）2900米到达黄龙主景区五彩池，游览后沿下山栈道，一路观看黄龙景点。返回黄龙景区大门口。</p><p><br/></p>',1,'',1,''),(20,7,2,'九寨沟一日游',1,'',NULL,'','<p style=\"white-space: normal;\">早餐后前往九寨沟景区，换乘景区内观光车，游览世界遗产、世界级风景区：【日则沟的箭竹海、熊猫海、五花海、珍珠滩、珍珠滩瀑布、镜海；游览则渣洼沟的长海、五彩池；树正沟的诺日朗瀑布、犀牛海、老虎海、树正瀑布、树正群海、卧龙海、火花海、芦苇海、盆景滩】等全部景点。晚餐后自愿参加藏羌民族风情歌舞晚会。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">九寨沟内推荐游览路线：沟口乘车---原始森林乘车---箭竹海观倒影走栈道或乘车---熊猫海乘车---五花海乘车---珍珠滩走栈道看完瀑布后走栈道至镜海停车场乘车---诺日朗旅游服务中心乘车---长海步行---五彩池乘车---诺日朗瀑布乘车---老虎海走栈道---树正瀑布、水磨房步行至树正群海走栈道---火花海乘车---芦苇海乘车---盆景滩乘车---宝镜岩乘车---出沟。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">行程小贴士</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">1九寨沟分为三条沟，单程35公里，沟内每个景点都有一个观光车上下的车站，凭观光车票当日可在任一站点自由换乘，每辆观光车都有讲解导游。游览景区内三条沟的先后顺序，完全根据观光车调度人员临时安排分沟游览，这样也能更好的分散游客，让您在拍照的时候舒心一些。观光车一般是到每条沟最高景点下车，然后往下走游览，所以走路也不会觉得累。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">2九寨沟景区最佳的游览方式还是自由活动，乘坐的观光车运行方式和城里的公交车是一样的，因此导游也无法全程陪同到每一个客人。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">3九寨沟天气变化频繁；请备好保暖衣物、雨伞、防晒霜，太阳镜等物品；可自备感冒药、治腹泻和创口贴等药品。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">4九寨沟景区内诺日朗餐厅用餐，自助餐60元/人起（费用未含），用餐比较简单，而且会影响您的游览时间，建议您自带干粮进沟。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">5九寨景区禁止吸烟，有吸烟习惯的客人请忍耐，或是到专门的吸烟区，否则会受到高额罚款。九寨沟是世界自然遗产，爱它您就保护它。 </p><p style=\"white-space: normal;\">​</p><p>​<br/></p>',0,'',1,''),(21,7,3,'九寨沟—成都',1,'',NULL,'','<p>早餐后从九寨沟出发前往川主寺，途中游览正规改革寒盼藏寨——主题宣传藏族村寨文化，体验民族地区文化特色及经济建设成就，真正感受藏族人民的风土人情。随后参观川主寺镇雪宝顶超市，在川主寺用午餐，午餐后前往茂县，途中游览具有羌族文化特色、风景秀美的牟托羌寨，后返回成都结束此次愉快的旅途！</p><p><br/></p><p>行程小贴士</p><p><br/></p><p>1、当天返回成都时间比较晚，正常情况下大约在下午的19：00左右，由于高原路段有可能堵车，如果您当天有返程计划，请您尽量谨慎考虑，我们建议不要预定行程结束当天的火车票或是飞机票，以免因为堵车给您带来没有必要的损失。</p><p><br/></p><p>2、今天是本次九黄之旅游程的最后一站，如若你对此次行程有任何异议，请告诉我们，我们会在第一时间根据你反馈的情况落实调查并及时处理；这次旅程是一次心灵的洗礼，是人生观的再次升华，回家后分享给大家吧。</p><p><br/></p><p>3、特别说明：因此当日返回成都的时间较晚，建议游客不要订当日离成都返程票。</p><p><br/></p>',1,'',NULL,''),(22,8,1,'成都---都江堰--映秀镇---汶川县----川主寺----九寨沟沟口',1,'','汽车','当地四星酒店或同级','<p>早晨从成都出发，途径都江堰、“5•12断桥”、震中映秀，叠溪海子，抵达九寨沟。</p><p>景点介绍：叠溪海子实际上就是岷江主流的一段，是地震形成的堰塞湖。湖面宽只有大约1公里，但是长却有10公里之多，海子由上下两处接连而成，形如肠状。海子周围青山环抱，湖岸翠草丛生，湖水碧波荡漾，景色优美迷人。海子出水口十分狭窄，水流湍急，浪花飞溅，似颗颗珍珠闪跃。每当前往著名风景区九寨沟、黄龙寺的游客们路过这里，便不由自主地被这里的湖光山色吸引，停车游览。据当地人说，海子最深处有98米，平均深度82米，蓄水量达1.25亿立方米，湖面面积有350多万平方米。晚上到达九寨沟沟口。</p><p>​<br/></p>',1,'',1,''),(23,8,2,'九寨沟景区一日游',1,'','汽车','当地四星酒店或同级','<p>早上，前往九寨沟景区，感受\'\'童话世界’‘般的美景。</p><p>景点介绍：尽享童话世界、人间天堂的美景，游览无时间限制.早餐后换乘观光车前往整个行程的游览重点--九寨沟，世界级自然遗产保护区。九寨沟是由翠海、叠瀑、彩林、烟云、雪峰以及奇异多彩的藏族风情组成格调自然风韵独具的仙境。九寨沟的景观主要分布在树正沟、日则沟、则查洼沟三条主沟内，景区内有最宽、最高、最雄伟壮观的三大瀑布；珍珠滩瀑布、诺日朗瀑布、熊猫海瀑布，108个高山湖泊及数十处流泉飞瀑等景观。最美最奇特的是九寨沟的水，清冽透底，变幻无穷；细细体味“黄山归来不看山，九寨归来不看水”的意境约。尤其九寨沟珍珠滩景色非常美丽！</p><p>温馨提示：户外游览时间较长，日照充足，紫外线较强，请准备好雨伞，防晒霜，太阳镜等物品。</p><p>​<br/></p>',1,'',1,''),(24,8,3,'九寨沟--黄龙---川主寺---汶川地震遗址----成都',1,'','汽车','当地四星酒店或同级','<p>前往黄龙景区。游览“人间仙境”黄龙风景区。</p><p>景点介绍：黄龙是海拔在3000米以上的中国最高的风景名胜区之一。黄龙景区入口处海拔3070米，到黄龙寺海拔3558米。近500米的高度，要走约4200米的距离。所以去黄龙玩的时候一定要注意高原反应哦。</p><p>在返回成都的途中，经过川主寺，川主寺是阿坝州的重要交通转折点，后返回成都。</p><p><br/></p>',1,'',1,'');

/*Table structure for table `sline_line_kindlist` */

DROP TABLE IF EXISTS `sline_line_kindlist`;

CREATE TABLE `sline_line_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kindid` (`kindid`),
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='ssmall线路分类总表';

/*Data for the table `sline_line_kindlist` */

insert  into `sline_line_kindlist`(`id`,`kindid`,`seotitle`,`keyword`,`description`,`tagword`,`jieshao`,`isfinishseo`,`displayorder`,`isnav`,`ishot`,`shownum`,`templetpath`) values (36,36,'','','','','',0,2,1,0,0,''),(37,37,'','','','','',0,3,1,0,0,''),(38,40,NULL,NULL,NULL,NULL,NULL,0,9999,0,1,NULL,NULL),(39,41,NULL,NULL,NULL,NULL,NULL,0,9999,0,1,NULL,NULL);

/*Table structure for table `sline_line_pricelist` */

DROP TABLE IF EXISTS `sline_line_pricelist`;

CREATE TABLE `sline_line_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT '0',
  `aid` int(11) unsigned DEFAULT NULL,
  `lowerprice` int(11) DEFAULT NULL,
  `highprice` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='线路价格分段表';

/*Data for the table `sline_line_pricelist` */

insert  into `sline_line_pricelist`(`id`,`webid`,`aid`,`lowerprice`,`highprice`) values (1,0,1,NULL,200),(2,0,NULL,201,500),(3,0,2,501,2000),(4,0,3,2001,5000),(5,0,4,5001,10000),(6,0,5,10001,NULL);

/*Table structure for table `sline_line_suit` */

DROP TABLE IF EXISTS `sline_line_suit`;

CREATE TABLE `sline_line_suit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lineid` int(11) NOT NULL,
  `suitname` varchar(255) DEFAULT NULL,
  `description` text,
  `displayorder` int(11) DEFAULT '999999',
  `jifenbook` int(11) DEFAULT '0',
  `jifentprice` int(11) DEFAULT '0',
  `jifencomment` int(11) DEFAULT '0',
  `propgroup` varchar(6) DEFAULT NULL,
  `paytype` tinyint(1) unsigned DEFAULT '1',
  `dingjin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lineid` (`lineid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `sline_line_suit` */

insert  into `sline_line_suit`(`id`,`lineid`,`suitname`,`description`,`displayorder`,`jifenbook`,`jifentprice`,`jifencomment`,`propgroup`,`paytype`,`dingjin`) values (1,2,'跟团游','',999999,10,1,1,'2,1,3',2,'200'),(2,4,'双人游','',999999,10,1,1,'2,1',1,''),(3,5,'套餐一','<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 30px; background-color: rgb(255, 255, 255);\">贵州荔波大小七孔双飞三日游</span></p>',999999,10,1,2,'2,1',1,''),(4,1,'跟团游','',999999,10,1,1,'2,1',1,''),(5,8,'自由行','',999999,10,1,2,'2,1',1,'');

/*Table structure for table `sline_line_suit_price` */

DROP TABLE IF EXISTS `sline_line_suit_price`;

CREATE TABLE `sline_line_suit_price` (
  `lineid` int(11) NOT NULL,
  `suitid` int(11) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0',
  `childprofit` int(11) DEFAULT NULL,
  `childbasicprice` int(11) DEFAULT NULL,
  `childprice` int(11) DEFAULT NULL,
  `oldprofit` int(11) DEFAULT NULL,
  `oldbasicprice` int(11) DEFAULT NULL,
  `oldprice` int(11) DEFAULT NULL,
  `adultprofit` int(11) DEFAULT NULL,
  `adultbasicprice` int(11) DEFAULT NULL,
  `adultprice` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL COMMENT '描述',
  `number` int(11) DEFAULT NULL COMMENT '库存',
  `roombalance` int(11) DEFAULT '0',
  PRIMARY KEY (`suitid`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_line_suit_price` */

insert  into `sline_line_suit_price`(`lineid`,`suitid`,`day`,`childprofit`,`childbasicprice`,`childprice`,`oldprofit`,`oldbasicprice`,`oldprice`,`adultprofit`,`adultbasicprice`,`adultprice`,`description`,`number`,`roombalance`) values (2,1,1441814400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1441900800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1442246400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1442419200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1442505600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1442851200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1443024000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1443110400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1443456000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1443628800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1443715200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1444060800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1444233600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1444320000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1444665600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1444838400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1444924800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1445270400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1445443200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1445529600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1445875200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1446048000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1446134400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1446480000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1446652800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1446739200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1447084800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1447257600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1447344000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1447689600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1447862400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1447948800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1448294400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1448467200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1448553600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1448899200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1449072000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1449158400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1449504000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1449676800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1449763200,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1450108800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1450281600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1450368000,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1450713600,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1450886400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1450972800,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1451318400,80,500,580,80,500,580,80,560,640,'',-1,30),(2,1,1451491200,80,500,580,80,500,580,80,560,640,'',-1,30),(4,2,1441814400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1441900800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1441987200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442073600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442160000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442246400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442332800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442419200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442505600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442592000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442678400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442764800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442851200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1442937600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443024000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443110400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443196800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443283200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443369600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443456000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443542400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443628800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443715200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443801600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443888000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1443974400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444060800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444147200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444233600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444320000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444406400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444492800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444579200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444665600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444752000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444838400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1444924800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445011200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445097600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445184000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445270400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445356800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445443200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445529600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445616000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445702400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445788800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445875200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1445961600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446048000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446134400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446220800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446307200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446393600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446480000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446566400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446652800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446739200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446825600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446912000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1446998400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447084800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447171200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447257600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447344000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447430400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447516800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447603200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447689600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447776000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447862400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1447948800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448035200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448121600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448208000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448294400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448380800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448467200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448553600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448640000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448726400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448812800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448899200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1448985600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449072000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449158400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449244800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449331200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449417600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449504000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449590400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449676800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449763200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449849600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1449936000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450022400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450108800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450195200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450281600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450368000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450454400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450540800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450627200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450713600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450800000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450886400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1450972800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451059200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451145600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451232000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451318400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451404800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451491200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451577600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451664000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451750400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451836800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1451923200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452009600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452096000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452182400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452268800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452355200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452441600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452528000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452614400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452700800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452787200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452873600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1452960000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453046400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453132800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453219200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453305600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453392000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453478400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453564800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453651200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453737600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453824000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453910400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1453996800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454083200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454169600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454256000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454342400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454428800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454515200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454601600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454688000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454774400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454860800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1454947200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455033600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455120000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455206400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455292800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455379200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455465600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455552000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455638400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455724800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455811200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455897600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1455984000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456070400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456156800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456243200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456329600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456416000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456502400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456588800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456675200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456761600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456848000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1456934400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457020800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457107200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457193600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457280000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457366400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457452800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457539200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457625600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457712000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457798400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457884800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1457971200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458057600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458144000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458230400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458316800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458403200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458489600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458576000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458662400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458748800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458835200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1458921600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459008000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459094400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459180800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459267200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459353600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459440000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459526400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459612800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459699200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459785600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459872000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1459958400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460044800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460131200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460217600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460304000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460390400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460476800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460563200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460649600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460736000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460822400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460908800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1460995200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461081600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461168000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461254400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461340800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461427200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461513600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461600000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461686400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461772800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461859200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1461945600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462032000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462118400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462204800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462291200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462377600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462464000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462550400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462636800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462723200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462809600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462896000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1462982400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463068800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463155200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463241600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463328000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463414400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463500800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463587200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463673600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463760000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463846400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1463932800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464019200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464105600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464192000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464278400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464364800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464451200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464537600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464624000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464710400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464796800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464883200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1464969600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465056000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465142400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465228800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465315200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465401600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465488000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465574400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465660800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465747200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465833600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1465920000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466006400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466092800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466179200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466265600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466352000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466438400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466524800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466611200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466697600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466784000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466870400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1466956800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467043200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467129600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467216000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467302400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467388800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467475200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467561600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467648000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467734400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467820800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467907200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1467993600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468080000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468166400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468252800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468339200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468425600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468512000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468598400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468684800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468771200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468857600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1468944000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469030400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469116800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469203200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469289600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469376000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469462400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469548800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469635200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469721600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469808000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469894400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1469980800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470067200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470153600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470240000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470326400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470412800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470499200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470585600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470672000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470758400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470844800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1470931200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471017600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471104000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471190400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471276800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471363200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471449600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471536000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471622400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471708800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471795200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471881600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1471968000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472054400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472140800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472227200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472313600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472400000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472486400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472572800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472659200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472745600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472832000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1472918400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1473004800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1473091200,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1473177600,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1473264000,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1473350400,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(4,2,1473436800,500,2899,3399,0,0,0,500,3099,3599,'',-1,200),(5,3,1441900800,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1441987200,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442073600,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442160000,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442246400,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442332800,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442419200,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442505600,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442592000,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442678400,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442764800,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442851200,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1442937600,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1443024000,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1443110400,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1443196800,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1443283200,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1443369600,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1443456000,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(5,3,1443542400,300,1000,1300,0,0,0,300,1200,1500,'<p>​<span style=\"font-family: 微软雅黑, 黑体, Arial, Hel',-1,0),(1,4,1441814400,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1441900800,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1441987200,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442073600,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442160000,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442246400,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442332800,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442419200,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442505600,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442592000,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442678400,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442764800,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442851200,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1442937600,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1443024000,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1443110400,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1443196800,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1443283200,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1443369600,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1443456000,120,380,500,0,0,0,120,400,520,'',-1,0),(1,4,1443542400,120,380,500,0,0,0,120,400,520,'',-1,0),(8,5,1442937600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443024000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443110400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443196800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443283200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443456000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443542400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443628800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443715200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443801600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1443888000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444060800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444147200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444233600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444320000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444406400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444492800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444665600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444752000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444838400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1444924800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445011200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445097600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445270400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445356800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445443200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445529600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445616000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445702400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445875200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1445961600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446048000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446134400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446220800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446307200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446480000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446566400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446652800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446739200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446825600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1446912000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447084800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447171200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447257600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447344000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447430400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447516800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447689600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447776000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447862400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1447948800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448035200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448121600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448294400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448380800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448467200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448553600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448640000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448726400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448899200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1448985600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449072000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449158400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449244800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449331200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449504000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449590400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449676800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449763200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449849600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1449936000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450108800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450195200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450281600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450368000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450454400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450540800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450713600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450800000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450886400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1450972800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451059200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451145600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451318400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451404800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451491200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451577600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451664000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451750400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1451923200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452009600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452096000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452182400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452268800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452355200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452528000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452614400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452700800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452787200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452873600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1452960000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453132800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453219200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453305600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453392000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453478400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453564800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453737600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453824000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453910400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1453996800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454083200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454169600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454342400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454428800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454515200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454601600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454688000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454774400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1454947200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455033600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455120000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455206400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455292800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455379200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455552000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455638400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455724800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455811200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455897600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1455984000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456156800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456243200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456329600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456416000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456502400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456588800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456761600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456848000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1456934400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457020800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457107200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457193600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457366400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457452800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457539200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457625600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457712000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457798400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1457971200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458057600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458144000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458230400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458316800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458403200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458576000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458662400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458748800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458835200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1458921600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459008000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459180800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459267200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459353600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459440000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459526400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459612800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459785600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459872000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1459958400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460044800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460131200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460217600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460390400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460476800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460563200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460649600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460736000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460822400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1460995200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461081600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461168000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461254400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461340800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461427200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461600000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461686400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461772800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461859200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1461945600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462032000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462204800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462291200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462377600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462464000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462550400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462636800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462809600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462896000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1462982400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463068800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463155200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463241600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463414400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463500800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463587200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463673600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463760000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1463846400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464019200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464105600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464192000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464278400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464364800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464451200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464624000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464710400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464796800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464883200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1464969600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465056000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465228800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465315200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465401600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465488000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465574400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465660800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465833600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1465920000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466006400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466092800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466179200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466265600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466438400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466524800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466611200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466697600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466784000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1466870400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467043200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467129600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467216000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467302400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467388800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467475200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467648000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467734400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467820800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467907200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1467993600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468080000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468252800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468339200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468425600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468512000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468598400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468684800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468857600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1468944000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469030400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469116800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469203200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469289600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469462400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469548800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469635200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469721600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469808000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1469894400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470067200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470153600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470240000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470326400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470412800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470499200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470672000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470758400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470844800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1470931200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471017600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471104000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471276800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471363200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471449600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471536000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471622400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471708800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471881600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1471968000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472054400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472140800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472227200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472313600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472486400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472572800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472659200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472745600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472832000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1472918400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473091200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473177600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473264000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473350400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473436800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473523200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473696000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473782400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473868800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1473955200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474041600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474128000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474300800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474387200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474473600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474560000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474646400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474732800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474905600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1474992000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475078400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475164800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475251200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475337600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475510400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475596800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475683200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475769600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475856000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1475942400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476115200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476201600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476288000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476374400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476460800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476547200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476720000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476806400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476892800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1476979200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477065600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477152000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477324800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477411200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477497600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477584000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477670400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477756800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1477929600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478016000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478102400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478188800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478275200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478361600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478534400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478620800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478707200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478793600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478880000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1478966400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479139200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479225600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479312000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479398400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479484800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479571200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479744000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479830400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1479916800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480003200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480089600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480176000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480348800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480435200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480521600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480608000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480694400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480780800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1480953600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481040000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481126400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481212800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481299200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481385600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481558400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481644800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481731200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481817600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481904000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1481990400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482163200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482249600,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482336000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482422400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482508800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482595200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482768000,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482854400,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1482940800,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1483027200,100,100,200,0,0,0,100,160,260,'',-1,50),(8,5,1483113600,100,100,200,0,0,0,100,160,260,'',-1,50);

/*Table structure for table `sline_member` */

DROP TABLE IF EXISTS `sline_member`;

CREATE TABLE `sline_member` (
  `mid` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `mtype` varchar(20) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  `pwd` char(32) NOT NULL DEFAULT '',
  `truename` varchar(36) NOT NULL DEFAULT '' COMMENT '真实姓名',
  `sex` enum('男','女','保密') NOT NULL DEFAULT '保密',
  `rank` smallint(5) unsigned NOT NULL DEFAULT '0',
  `money` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `email` char(50) NOT NULL DEFAULT '',
  `mobile` varchar(15) NOT NULL DEFAULT '',
  `jifen` mediumint(8) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `litpic` varchar(255) NOT NULL DEFAULT '' COMMENT '会员头像',
  `safequestion` varchar(255) NOT NULL DEFAULT '0' COMMENT '安全问题',
  `safeanswer` char(30) NOT NULL DEFAULT '' COMMENT '安全答案',
  `jointime` int(10) unsigned NOT NULL DEFAULT '0',
  `joinip` char(16) NOT NULL DEFAULT '',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0',
  `loginip` char(16) NOT NULL DEFAULT '',
  `checkmail` smallint(6) NOT NULL DEFAULT '0' COMMENT 'email是否通过验证',
  `checkphone` int(1) unsigned DEFAULT '0' COMMENT '手机是否验证',
  `province` varchar(50) DEFAULT NULL COMMENT '省份',
  `city` varchar(50) DEFAULT NULL COMMENT '城市',
  `cardid` varchar(20) DEFAULT NULL COMMENT '身份证号',
  `address` varchar(200) DEFAULT NULL COMMENT '地址',
  `postcode` varchar(8) DEFAULT NULL COMMENT '邮政编码',
  `connectid` varchar(255) DEFAULT '' COMMENT '第三方登陆连接id',
  `from` varchar(255) DEFAULT '' COMMENT '新浪/QQ登陆',
  `regtype` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`mid`),
  KEY `logintime` (`logintime`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `sline_member` */

insert  into `sline_member`(`mid`,`mtype`,`nickname`,`pwd`,`truename`,`sex`,`rank`,`money`,`email`,`mobile`,`jifen`,`litpic`,`safequestion`,`safeanswer`,`jointime`,`joinip`,`logintime`,`loginip`,`checkmail`,`checkphone`,`province`,`city`,`cardid`,`address`,`postcode`,`connectid`,`from`,`regtype`) values (1,NULL,'18682***','a3cc84a3af724e0f05b94f4fcc2e3995','','保密',0,0,'','18682752879',0,'','0','',1442990646,'222.209.124.250',1442990647,'222.209.124.250',0,0,NULL,NULL,NULL,NULL,NULL,'','',0),(2,NULL,'18228***','8ff6adcecc3861aaba9f0e54a060d60a','','保密',0,0,'','18228011758',0,'','0','',1441864925,'222.209.124.195',1441864925,'222.209.124.195',0,0,NULL,NULL,NULL,NULL,NULL,'','',0),(3,NULL,'13545***','030451b908a6e4ef7523dd9539b23d37','','保密',0,0,'','13545691111',22,'','0','',1441958565,'222.209.124.195',1441958565,'222.209.124.195',0,0,NULL,NULL,NULL,NULL,NULL,'','',0),(4,NULL,'13551***','de23cf74b5cfe70838fc322bd1d91cda','','保密',0,0,'','13551891211',12,'','0','',1443066079,'222.209.124.250',1443066079,'222.209.124.250',0,0,NULL,NULL,NULL,NULL,NULL,'','',0),(5,NULL,'13551***','905e818d60b1d55c61750b1d9bb0524e','','保密',0,0,'','13551893416',10,'','0','',1444284414,'222.209.124.56',1444284414,'222.209.124.56',0,0,NULL,NULL,NULL,NULL,NULL,'','',0),(6,NULL,'13538***','e24fb0666cb543fb53d6fa9ba2f224a8','','保密',0,0,'','13538287645',1,'','0','',1447301132,'127.0.0.1',1447301132,'127.0.0.1',0,0,NULL,NULL,NULL,NULL,NULL,'','',0);

/*Table structure for table `sline_member_jifen_log` */

DROP TABLE IF EXISTS `sline_member_jifen_log`;

CREATE TABLE `sline_member_jifen_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) DEFAULT NULL,
  `content` text COMMENT '积分描述',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `type` int(1) unsigned DEFAULT NULL COMMENT '消息类型,1,使用,2,获取',
  `jifen` int(11) unsigned DEFAULT NULL COMMENT '本次操作的积分数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='会员积分使用记录表';

/*Data for the table `sline_member_jifen_log` */

insert  into `sline_member_jifen_log`(`id`,`memberid`,`content`,`addtime`,`type`,`jifen`) values (1,5,'预订乐山一日游(跟团)获得积分10',1444284587,2,10),(2,5,'预订线路九寨沟、黄龙自由行三日游(自由行)消费积分0分',1444285075,1,0),(3,5,'预订线路九寨沟、黄龙自由行三日游(自由行)消费积分0分',1444285129,1,0),(4,5,'预订产品{$productname}消费积分{$needjifen}',1444286012,1,0),(5,6,'登陆赠送积分1分',1447301132,2,1);

/*Table structure for table `sline_member_order` */

DROP TABLE IF EXISTS `sline_member_order`;

CREATE TABLE `sline_member_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordersn` varchar(255) DEFAULT NULL COMMENT '订单号',
  `memberid` int(11) unsigned DEFAULT NULL COMMENT '会员id',
  `typeid` int(3) unsigned DEFAULT NULL COMMENT '订单类型',
  `webid` int(3) unsigned DEFAULT NULL COMMENT '所属站点',
  `productaid` int(11) unsigned DEFAULT NULL COMMENT '产品aid',
  `productname` varchar(255) DEFAULT NULL COMMENT '产品名称',
  `productautoid` int(11) unsigned DEFAULT NULL COMMENT '对应产品表自增id(第三方后台用)',
  `litpic` varchar(255) DEFAULT NULL COMMENT '产品图片',
  `price` float(10,2) unsigned DEFAULT NULL COMMENT '价格(单价)',
  `childprice` float(10,2) unsigned DEFAULT NULL COMMENT '小孩报价',
  `usedate` varchar(255) DEFAULT NULL COMMENT '使用日期',
  `dingnum` int(3) unsigned DEFAULT NULL COMMENT '数量',
  `childnum` int(11) unsigned DEFAULT '0' COMMENT '儿童数量',
  `ispay` int(10) unsigned DEFAULT '0' COMMENT '是否已经付款',
  `status` int(1) unsigned DEFAULT '0' COMMENT '订单状态',
  `linkman` varchar(255) DEFAULT NULL COMMENT '订单联系人',
  `linktel` varchar(255) DEFAULT NULL COMMENT '订单联系电话',
  `linkemail` varchar(100) DEFAULT NULL COMMENT '联系人邮件',
  `linkqq` varchar(16) DEFAULT NULL COMMENT '联系人QQ',
  `isneedpiao` int(1) unsigned DEFAULT '0' COMMENT '是否需要发票',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '预订时间',
  `finishtime` int(10) unsigned DEFAULT NULL COMMENT '成交时间',
  `ispinlun` int(1) unsigned DEFAULT '0' COMMENT '是否已经评论,1:已评论,0:未评论',
  `jifencomment` int(11) DEFAULT '0' COMMENT '评论送积分',
  `jifentprice` int(11) DEFAULT '0' COMMENT '积分抵现金',
  `jifenbook` int(11) DEFAULT '0' COMMENT '预订送积分',
  `dingjin` int(11) DEFAULT '0' COMMENT '是否支持定金',
  `suitid` int(11) DEFAULT '0' COMMENT '用于预订产品有子分类时',
  `paytype` int(1) DEFAULT '1' COMMENT '支付方式',
  `oldnum` int(11) DEFAULT '0' COMMENT '老人数量',
  `oldprice` float(10,2) DEFAULT '0.00' COMMENT '老人价格',
  `usejifen` int(1) unsigned DEFAULT '0' COMMENT '是否使用积分',
  `needjifen` int(11) unsigned DEFAULT NULL COMMENT '需要的积分',
  `pid` int(11) DEFAULT '0' COMMENT '父级订单id',
  `haschild` int(1) unsigned DEFAULT '0' COMMENT '是否有子级订单',
  `remark` mediumtext,
  `kindlist` varchar(255) DEFAULT '' COMMENT '所属目的地',
  `viewstatus` tinyint(1) DEFAULT '0',
  `roombalance` int(11) DEFAULT '0',
  `roombalancenum` int(11) DEFAULT '0',
  `paysource` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `sline_member_order` */

insert  into `sline_member_order`(`id`,`ordersn`,`memberid`,`typeid`,`webid`,`productaid`,`productname`,`productautoid`,`litpic`,`price`,`childprice`,`usedate`,`dingnum`,`childnum`,`ispay`,`status`,`linkman`,`linktel`,`linkemail`,`linkqq`,`isneedpiao`,`addtime`,`finishtime`,`ispinlun`,`jifencomment`,`jifentprice`,`jifenbook`,`dingjin`,`suitid`,`paytype`,`oldnum`,`oldprice`,`usejifen`,`needjifen`,`pid`,`haschild`,`remark`,`kindlist`,`viewstatus`,`roombalance`,`roombalancenum`,`paysource`) values (1,'0209232343',1,2,0,3,'九寨沟山河国际大酒店(商务间)',3,NULL,NULL,0.00,NULL,NULL,0,0,1,'','18682752879','','',0,1442990646,NULL,0,2,1,10,0,3,1,0,0.00,0,NULL,0,1,'','36,38,40',0,0,0,NULL),(2,'0209230187',1,2,0,3,'九寨沟山河国际大酒店(商务间)',3,NULL,999.00,0.00,'2015-9-25',1,0,0,1,'','18682752879','','',0,1442990646,NULL,0,2,1,10,0,3,1,0,0.00,0,0,1,0,'','36,38,40',0,0,0,NULL),(3,'0309235961',1,3,0,3,'金龙旅游大巴(包车)',4,NULL,1199.00,NULL,'2015-10-1',1,0,0,1,'','18682752879','','',0,1442996158,NULL,0,2,1,10,0,0,1,0,0.00,0,0,0,0,'','36,38,40',0,0,0,NULL),(4,'0509239093',1,5,0,3,'九寨沟犀牛海(犀牛海门票)',3,NULL,100.00,0.00,'2015-09-23',1,0,0,1,'','18682752879','','',0,1442999148,NULL,0,2,1,10,0,4,1,0,0.00,0,0,0,0,'','36,38,40',0,0,0,NULL),(5,'0509248622',4,5,0,3,'九寨沟犀牛海(犀牛海门票)',3,NULL,100.00,0.00,'2015-09-24',1,0,1,2,'','13551891211','','',0,1443066079,NULL,1,2,1,10,0,4,1,0,0.00,0,0,0,0,'','36,38,40',0,0,0,'后台'),(6,'1309247388',1,13,0,3,'九寨沟珍珠滩门票团购特卖',3,NULL,35.00,NULL,'2015-09-24',1,0,0,1,'','18682752879','','',0,1443074938,NULL,0,2,1,10,0,0,1,0,0.00,0,0,0,0,'','36,38,40',0,0,0,NULL),(10,'0210080531',5,2,0,3,'九寨沟山河国际大酒店(商务间)',3,NULL,NULL,0.00,NULL,NULL,0,0,1,'','13551893416','','',0,1444286003,NULL,0,2,1,10,0,3,1,0,0.00,0,NULL,0,1,'','36,38,40',0,0,0,NULL),(11,'0210087938',5,2,0,3,'九寨沟山河国际大酒店(商务间)',3,NULL,999.00,0.00,'2015-10-8',1,0,0,1,'','13551893416','','',0,1444286003,NULL,0,2,1,10,0,3,1,0,0.00,1,0,10,0,'','36,38,40',1,0,0,NULL),(12,'0111128939',6,1,0,7,'九寨沟、黄龙自由行三日游(自由行)',8,NULL,260.00,200.00,'2015-12-2',1,0,0,1,'','13538287645','',NULL,0,1447301132,NULL,0,2,1,10,0,5,1,0,0.00,0,0,0,0,'34324343','36,38,40',0,50,0,NULL);

/*Table structure for table `sline_member_order_tourer` */

DROP TABLE IF EXISTS `sline_member_order_tourer`;

CREATE TABLE `sline_member_order_tourer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(255) DEFAULT '0' COMMENT '订单编号',
  `tourername` varchar(255) DEFAULT '0' COMMENT '游客姓名',
  `sex` enum('男','女') DEFAULT '男',
  `cardtype` varchar(255) DEFAULT '0' COMMENT '证件类型',
  `cardnumber` varchar(255) DEFAULT '0' COMMENT '证件号码',
  `mobile` varchar(15) DEFAULT '0' COMMENT '手机',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='订单游客表';

/*Data for the table `sline_member_order_tourer` */

insert  into `sline_member_order_tourer`(`id`,`orderid`,`tourername`,`sex`,`cardtype`,`cardnumber`,`mobile`) values (1,'12','3434','男','身份证','','43434343');

/*Table structure for table `sline_model` */

DROP TABLE IF EXISTS `sline_model`;

CREATE TABLE `sline_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型id',
  `modulename` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `pinyin` varchar(255) DEFAULT NULL COMMENT '拼音标识',
  `maintable` varchar(255) DEFAULT NULL COMMENT '主表',
  `addtable` varchar(255) DEFAULT NULL COMMENT '附加表',
  `attrtable` varchar(255) DEFAULT 'model_attr' COMMENT '属性表',
  `issystem` int(1) DEFAULT '0' COMMENT '是否系统',
  `isopen` int(1) DEFAULT '1' COMMENT '是否开启',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pinyin` (`pinyin`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='思途模型表';

/*Data for the table `sline_model` */

insert  into `sline_model`(`id`,`modulename`,`pinyin`,`maintable`,`addtable`,`attrtable`,`issystem`,`isopen`) values (1,'线路','line','line','line_extend_field','line_attr',1,1),(2,'酒店','hotel','hotel','hotel_extend_field','hotel_attr',1,1),(3,'租车','car','car','car_extend_field','car_attr',1,1),(4,'文章','article','article','article_extend_field','article_attr',1,1),(5,'景点','spot','spot','spot_extend_field','spot_attr',1,1),(6,'相册','photo','photo','photo_extend_field','photo_attr',1,1),(7,'保险','insurance','insurance',NULL,'model_attr',0,1),(8,'签证','visa','visa','visa_extend_field','null',1,1),(10,'问答','wenda','question',NULL,'model_attr',1,1),(11,'结伴','jieban','jieban','jieban_extend_field','jieban_attr',1,1),(13,'团购','tuan','tuan','tuan_extend_field','tuan_attr',1,1);

/*Table structure for table `sline_model_archive` */

DROP TABLE IF EXISTS `sline_model_archive`;

CREATE TABLE `sline_model_archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `webid` int(11) NOT NULL DEFAULT '1' COMMENT '站点ID',
  `aid` int(11) unsigned DEFAULT NULL COMMENT '前台访问aid',
  `typeid` int(11) unsigned DEFAULT NULL COMMENT '模型id',
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `seotitle` varchar(255) DEFAULT NULL COMMENT '优化标题',
  `content` longtext COMMENT '文章内容',
  `piclist` text COMMENT '图片列表',
  `price` varchar(255) DEFAULT '0' COMMENT '价格',
  `litpic` varchar(255) DEFAULT NULL COMMENT '封面图片',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `shownum` int(11) DEFAULT NULL COMMENT '浏览次数',
  `tagword` varchar(50) DEFAULT NULL COMMENT 'tag词',
  `keyword` varchar(50) DEFAULT NULL COMMENT '关键词',
  `description` varchar(500) DEFAULT NULL COMMENT '描述',
  `kindlist` varchar(255) DEFAULT NULL COMMENT '目的地id',
  `themelist` varchar(255) DEFAULT NULL COMMENT '专题id',
  `attrid` varchar(255) DEFAULT NULL COMMENT '属性id',
  `ishidden` tinyint(4) DEFAULT '0' COMMENT '是否隐藏',
  `iconlist` varchar(255) DEFAULT NULL COMMENT '图标id',
  `templet` varchar(255) DEFAULT NULL COMMENT '使用模板',
  `satisfyscore` int(11) DEFAULT NULL COMMENT '满意度',
  `sellpoint` varchar(255) DEFAULT NULL COMMENT '卖点',
  `supplierlist` varchar(255) DEFAULT NULL COMMENT '供应商',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='扩展信息表';

/*Data for the table `sline_model_archive` */

/*Table structure for table `sline_model_attr` */

DROP TABLE IF EXISTS `sline_model_attr`;

CREATE TABLE `sline_model_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL DEFAULT '0' COMMENT '站点id',
  `typeid` int(11) NOT NULL COMMENT '模型id',
  `attrname` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isopen` int(11) unsigned DEFAULT '0',
  `issystem` int(11) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='扩展模块属性表';

/*Data for the table `sline_model_attr` */

/*Table structure for table `sline_model_content` */

DROP TABLE IF EXISTS `sline_model_content`;

CREATE TABLE `sline_model_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '1',
  `typeid` int(4) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL,
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isline` int(1) DEFAULT '0',
  `isrealfield` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类';

/*Data for the table `sline_model_content` */

insert  into `sline_model_content`(`id`,`webid`,`typeid`,`columnname`,`chinesename`,`displayorder`,`issystem`,`isopen`,`isline`,`isrealfield`) values (1,0,7,'tupian','图片',0,1,1,0,0);

/*Table structure for table `sline_model_suit` */

DROP TABLE IF EXISTS `sline_model_suit`;

CREATE TABLE `sline_model_suit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) NOT NULL COMMENT '产品id',
  `suitname` varchar(255) DEFAULT NULL COMMENT '套餐名称',
  `description` text COMMENT '描述',
  `displayorder` int(11) DEFAULT '9999' COMMENT '排序',
  `jifenbook` int(11) DEFAULT '0' COMMENT '预订送积分',
  `jifentprice` int(11) DEFAULT '0' COMMENT '积分抵现金',
  `jifencomment` int(11) DEFAULT '0' COMMENT '评论送积分',
  `paytype` tinyint(1) unsigned DEFAULT '1' COMMENT '支付类型',
  `number` int(11) DEFAULT '-1' COMMENT '库存',
  `dingjin` varchar(255) DEFAULT NULL COMMENT '定金',
  `sellprice` varchar(255) DEFAULT NULL COMMENT '市场价格',
  `ourprice` varchar(255) DEFAULT NULL COMMENT '本站价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_model_suit` */

/*Table structure for table `sline_module_config` */

DROP TABLE IF EXISTS `sline_module_config`;

CREATE TABLE `sline_module_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL COMMENT '页面ID',
  `pagename` varchar(255) DEFAULT NULL,
  `shortname` varchar(255) DEFAULT NULL COMMENT '前台调用标识',
  `typeid` int(11) unsigned DEFAULT '0',
  `moduleids` varchar(255) DEFAULT NULL COMMENT '存储需要显示模块id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='模块配置表';

/*Data for the table `sline_module_config` */

insert  into `sline_module_config`(`id`,`webid`,`aid`,`pagename`,`shortname`,`typeid`,`moduleids`) values (1,0,1,'栏目首页','index',1,'4,6,9,15'),(2,0,2,'栏目详细页','show',1,'15,11,8,25,1,9,19'),(3,0,3,'栏目搜索页','search',1,'11,8,9,6,25,14,10'),(5,0,5,'栏目首页','index',2,'6,11,,8,9,4'),(6,0,6,'栏目详细页','show',2,'1,11,8,4'),(7,0,7,'栏目搜索页','search',2,'11,8,9,6'),(9,0,9,'栏目首页','index',3,'6,8,9,4'),(10,0,10,'栏目详细页','show',3,'3,1,11,8,2,4'),(11,0,11,'栏目搜索页','search',3,'6,11,8,9,4'),(13,0,13,'栏目首页','index',4,'6,11,8,4'),(14,0,14,'栏目详细页','show',4,'6,11,1,2,4'),(15,0,15,'栏目搜索页','search',4,'6,11,8,4'),(16,0,17,'栏目首页','index',5,'6,11,8,4'),(17,0,18,'栏目详细页','show',5,'5,11,8,4'),(18,0,19,'栏目搜索页','search',5,'6,11,8,4'),(19,0,21,'栏目首页','index',6,'1,8,11,4'),(20,0,22,'栏目详细页','show',6,'1,3,11,2'),(21,0,23,'栏目搜索页','search',6,'1,8,11,4'),(24,0,27,'网站首页','index',0,'3,15,9,12'),(25,0,28,'栏目首页','index',8,'20,6,9,10'),(26,0,29,'栏目详细页','show',8,'1,11,8,9,3,2'),(27,0,30,'栏目搜索页','search',8,'6,11,8,9,4'),(28,0,31,'栏目预订页','booking',8,'2,3,12,4,6,19'),(30,0,32,'栏目首页','index',13,'1,11,8,4,20,7,15,28,21,24,27,26'),(31,0,33,'详细页面','show',13,'14,6,15,4,5,8,9,13'),(32,0,34,'栏目搜索页','search',13,'14,6,15,4,5,8,9,13'),(161,0,35,'目的地首页','index',12,'15,4,8,5'),(162,0,36,'目的地引导页','boot',12,'6,4,15'),(163,0,37,'机票首页','index',9,'6,4,15'),(164,0,38,'栏目首页','index',14,''),(165,0,39,'栏目列表页','search',14,''),(166,0,40,'栏目详细页','show',14,'');

/*Table structure for table `sline_module_list` */

DROP TABLE IF EXISTS `sline_module_list`;

CREATE TABLE `sline_module_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned DEFAULT NULL COMMENT '模块id',
  `webid` int(2) unsigned DEFAULT '1',
  `modulename` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `body` mediumtext COMMENT '模块内容',
  `issystem` int(1) unsigned DEFAULT '0',
  `type` int(1) DEFAULT '0' COMMENT '模块类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='右侧模块列表';

/*Data for the table `sline_module_list` */

insert  into `sline_module_list`(`id`,`aid`,`webid`,`modulename`,`body`,`issystem`,`type`) values (1,1,0,'满意度(小)',' <!--边栏满意度(小)开始-->\r\n        <div class=\"dos\">\r\n      <div class=\"dos_pic\">\r\n        <p>客户满意度</p>\r\n        <span><s style=\" width:100%\"></s></span>\r\n      </div>\r\n      <div class=\"peo_data\">已为<span>3008374</span>位客户提供旅游服务！</div>\r\n      <div class=\"dis_list\">\r\n         {sline:getcommentlist flag=\'all\' row=\'3\'}\r\n            	<dl>\r\n              	<dt><b>[field:nickname/]</b><strong>满意度：</strong><span><s style=\" width:[field:percent/]\"></s></span></dt>\r\n                <dd>[field:content/]</dd>\r\n              </dl>\r\n         {/sline:getcommentlist}\r\n      </div>\r\n    </div>\r\n    <!--边栏满意度(小)结束-->',0,0),(2,2,0,'满意度(大)',' <!--边栏满意度(大)开始-->\r\n       <div id=\"dos_vip\" class=\"dos\">\r\n      <div class=\"dos_pic\">\r\n        <p>客户满意度</p>\r\n        <span><s style=\" width:100%\"></s></span>\r\n      </div>\r\n      <div class=\"peo_data\">已为<span>3008374</span>位客户提供旅游服务！</div>\r\n      <div class=\"fl\"><img src=\"{sline:global.cfg_templets_skin/}/images/serve_pic.png\" alt=\"\" title=\"\" /></div>\r\n      <div class=\"dis_list\">\r\n          {sline:getcommentlist flag=\'all\' row=\'6\'}\r\n            	<dl>\r\n              	<dt><b>[field:nickname/]</b><strong>满意度：</strong><span><s style=\" width:[field:percent/]\"></s></span></dt>\r\n                <dd>[field:content/]</dd>\r\n              </dl>\r\n            {/sline:getcommentlist}\r\n      </div>\r\n    </div>\r\n    <!--边栏满意度结束-->',0,0),(3,3,0,'热门团购','   <!--热门团购产品开始-->                                 \n       <div class=\"hot_pro\">\n      <h3>热门团购产品</h3>\n      <div class=\"side_plb_list tuan_list\">\n        {sline:gettuanlist flag=\"hot\" row=\"2\"}\n          <dl class=\"dl_list\">\n            	<dt><a class=\"fl\" href=\"[field:url/]\" target=\"_blank\"><img class=\"fl\" src=\"[field:lit240/]\" width=\"218\" height=\"130\" alt=\"[field:litpic/]\" /></a></dt>\n              <dd class=\"dd1\"><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\n              <dd class=\"dd2\">\n              	<span class=\"sp_1\">¥[field:price/]</span>\n                <span class=\"sp_2\">[field:discount/]折</span>\n                <a href=\"/tuan/book.php?tuanaid=[field:aid/]\" target=\"_blank\">抢购</a>\n              </dd>\n            </dl>\n        {/sline:gettuanlist}\n       \n      </div>\n      <script language=\"javascript\">\n         $(function(){\n		     $(\".tuan_list\").find(\'.dl_list\').last().addClass(\'bor_bot_0\');\n		 })\n      </script>\n    </div>\n    <!--热门团购产品结束-->',0,0),(4,4,0,'推荐团购','<!--推荐团购产品开始-->                                 \n        <div class=\"hot_pro\">\n      <h3>推荐团购产品</h3>\n      <div class=\"side_plb_list tuan_list\">\n        {sline:gettuanlist flag=\"recommend\" row=\"2\"}\n          <dl class=\"dl_list\">\n            	<dt><a class=\"fl\" href=\"[field:url/]\" target=\"_blank\"><img class=\"fl\" src=\"[field:lit240/]\" width=\"218\" height=\"130\" alt=\"[field:litpic/]\" /></a></dt>\n              <dd class=\"dd1\"><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\n              <dd class=\"dd2\">\n              	<span class=\"sp_1\">¥[field:price/]</span>\n                <span class=\"sp_2\">[field:discount/]折</span>\n                <a href=\"/tuan/book.php?tuanaid=[field:aid/]\" target=\"_blank\">抢购</a>\n              </dd>\n            </dl>\n        {/sline:gettuanlist}\n   \n      </div>\n      <script language=\"javascript\">\n         $(function(){\n		     $(\".tuan_list\").find(\'.dl_list\').last().addClass(\'bor_bot_0\');\n		 })\n      </script>\n    </div>\n    <!--推荐团购产品结束-->',0,0),(5,5,0,'最新团购',' <!--最新团购产品开始-->                                 \n       <div class=\"hot_pro\">\n      <h3>最新团购产品</h3>\n      <div class=\"side_plb_list tuan_list\">\n        {sline:gettuanlist flag=\"new\" row=\"2\"}\n          <dl class=\"dl_list\">\n            	<dt><a class=\"fl\" href=\"[field:url/]\" target=\"_blank\"><img class=\"fl\" src=\"[field:lit240/]\" width=\"218\" height=\"130\" alt=\"[field:litpic/]\" /></a></dt>\n              <dd class=\"dd1\"><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\n              <dd class=\"dd2\">\n              	<span class=\"sp_1\">¥[field:price/]</span>\n                <span class=\"sp_2\">[field:discount/]折</span>\n                <a href=\"/tuan/book.php?tuanaid=[field:aid/]\" target=\"_blank\">抢购</a>\n              </dd>\n            </dl>\n        {/sline:gettuanlist}\n       \n      </div>\n      <script language=\"javascript\">\n         $(function(){\n		     $(\".tuan_list\").find(\'.dl_list\').last().addClass(\'bor_bot_0\');\n		 })\n      </script>\n    </div>\n    <!--最新团购产品结束-->',0,0),(6,6,0,'热卖线路','<!--热卖线路产品开始-->\r\n    <div class=\"hot_pro\">\r\n      <h3>热卖产品</h3>\r\n      <div class=\"side_plb_list line_hot_list\">\r\n         {sline:getlinelist type=\"top\" flag=\"hot\" row=\"2\"}\r\n            <dl class=\"dl_list\">\r\n            	<dt><a class=\"fl\" href=\"[field:url/]\" target=\"_blank\"><img class=\"fl\" src=\"[field:lit240/]\" width=\"218\" height=\"130\" alt=\"[field:title/]\" /></a></dt>\r\n              <dd class=\"dd1\"><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\r\n            </dl>\r\n          {/sline:getlinelist} \r\n      </div>\r\n        <script language=\"javascript\">\r\n         $(function(){\r\n		     $(\".line_hot_list\").find(\'.dl_list\').last().addClass(\'bor_bot_0\');\r\n		 })\r\n      </script>\r\n    </div>\r\n    <!--热卖线路产品结束-->',0,0),(7,7,0,'热卖酒店','<!--热卖酒店产品开始-->\r\n      <div class=\"hot_pro\">\r\n      <h3>热卖产品(酒店)</h3>\r\n      <div class=\"side_plb_list hotel_hot_list\">\r\n         {sline:gethotellist type=\"top\" flag=\"hot\" row=\"2\"}\r\n            <dl class=\"dl_list\">\r\n            	<dt><a class=\"fl\" href=\"[field:url/]\" target=\"_blank\"><img class=\"fl\" src=\"[field:lit240/]\" width=\"218\" height=\"130\" alt=\"[field:title/]\" /></a></dt>\r\n              <dd class=\"dd1\"><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\r\n            </dl>\r\n          {/sline:gethotellist} \r\n      </div>\r\n        <script language=\"javascript\">\r\n         $(function(){\r\n		     $(\".hotel_hot_list\").find(\'.dl_list\').last().addClass(\'bor_bot_0\');\r\n		 })\r\n        </script>\r\n    </div>\r\n    <!--热卖酒店产品结束-->',0,0),(8,8,0,'好评产品','  <!--产品好评开始-->\r\n      <div class=\"hot_pro\">\r\n      <h3>好评产品排行</h3>\r\n      <div class=\"side_plb_list good_list\">\r\n       {sline:getcommentlist flag=\'all\' level=\'1\'}\r\n        	<dl class=\"pro_ph\">\r\n            	<dt><s>[field:global.autoindex/]</s>[field:productname/]</dt>\r\n              <dd><span>好评度：</span><b><s style=\" width:[field:percent/]\"></s></b>已售：[field:sellnum/]</dd>\r\n            </dl>\r\n       {/sline:getcommentlist}\r\n       <script language=\"javascript\">\r\n         $(function(){\r\n		     $(\".good_list\").find(\'dl\').last().addClass(\'bor_bot_0\');\r\n		 })\r\n        </script>\r\n       \r\n      </div>\r\n    </div>\r\n    <!--产品好评结束-->',0,0),(9,9,0,'客户评论','    <div class=\"discuss\">\n      <h3>客户评论</h3>\n      <div class=\"dis_list\">\n         {sline:getcommentlist flag=\"all\" row=\"5\"}\n              <dl>\n                <dt><b>[field:nickname/]</b><strong>满意度：</strong><span class=\"comment_star\" data-score=\"[field:score/]\"><s style=\"width:[field:percent/]\"></s></span></dt>\n                <dd>[field:content/]</dd>\n              </dl>\n         {/sline:getcommentlist}\n\n      </div>\n    </div>',0,0),(10,10,0,'相关酒店',' <!--相关酒店开始-->\n    <div class=\"h_side_list\">\n      <h3><s></s>相关酒店</h3>\n      <div class=\"h_side_con\" id=\"r_h_list\">\n        {sline:gethotellist flag=\'relative\' row=\'4\'}\n          	<dl>\n            	<dt><s>[field:global.autoindex/]</s><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dt>\n              <dd><p><label class=\"fl\">星级:</label>[field:hotelrank/]</p><span>[field:sellprice runphp=\'yes\']\n         if(empty(@me))\n             @me=\'<strong>电询</strong>\';\n         else\n            @me=\'<strong>¥\'.@me.\'</strong>起\';  \n\n\n[/field:sellprice]</span></dd>\n            </dl>\n        {/sline:gethotellist}\n         <script language=\"javascript\">\n				 $(function(){\n					 $(\".r_h_list\").find(\'dl\').last().addClass(\'bor_bot_none\');\n				 })\n         </script>\n      </div>\n    </div>\n    <!--相关酒店结束-->',0,0),(11,11,0,'推荐景点',' <!--推荐景点开始-->\r\n    <div class=\"rig_side_list\">\r\n      <h3>推荐景点</h3>\r\n      <div class=\"list_all\">\r\n        {sline:getspotlist flag=\'recommend\' row=\'6\'}\r\n          <dl>\r\n            <dt><a class=\"fl\" href=\"[field:url/]\" target=\"_blank\"><img class=\"fl\" src=\"[field:lit160/]\" width=\"80\" height=\"60\" alt=\"[field:title/]\" /></a></dt>\r\n            <dd><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\r\n            <dd>优惠价：[field:price/]</dd>\r\n          </dl>\r\n        {/sline:getspotlist}\r\n       \r\n      </div>\r\n    </div>\r\n    <!--推荐景点结束-->',0,0),(12,12,0,'最新攻略(图文)',' <div class=\"rig_list\">\r\n      <h3>最新旅游攻略(图文)<s></s></h3>\r\n      <dl>\r\n        {sline:getarclist flag=\'new\' row=\'1\'}\r\n        <dt><a class=\"fl\" href=\"[field:url/]\" target=\"_blank\"><img class=\"fl\" src=\"[field:lit240/]\" width=\"240\" height=\"156\" alt=\"[field:title/]\" /></a><span></span><a class=\"img_title\" href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dt>\r\n        {/sline:getarclist}\r\n        {sline:getarclist flag=\'new\' row=\'7\' limit=\'1\'}\r\n          <dd><a class=\"a_mdd\" href=\"/raiders/search.php?dest_id=[field:destid/]\" target=\"_blank\">[field:destname/]</a><a class=\"a_title\" href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\r\n        {/sline:getarclist}\r\n      </dl>\r\n    </div>',0,0),(13,13,0,'预订动态',' <!--预定动态开始-->\r\n      <div class=\"now_book\">\r\n      <h3>预订动态</h3>\r\n      <div class=\"book_con\">\r\n        {sline:getorderlist flag=\'all\' row=\'6\'}\r\n          <dl>\r\n            <dt><span class=\"name\">用户&nbsp;&nbsp;[field:nickname/]</span><span class=\"time\">[field:dingtime/]</span>预定了</dt>\r\n            <dd>[field:productname/]</dd>\r\n          </dl>	\r\n        {/sline:getorderlist}\r\n      </div>\r\n    </div>\r\n    <!--预定动态结束-->',0,0),(14,14,0,'相关线路',' <!--相关线路开始-->\r\n    <div class=\"l_side_list\">\r\n      <h3><s></s>相关线路</h3>\r\n      <div class=\"l_side_con r_line\">\r\n        {sline:getlinelist flag=\'relative\' row=\'4\'}\r\n        <dl>\r\n          <dt><a href=\"[field:url/]\" target=\"_blank\"><img src=\"[field:lit160/]\" width=\"105\" height=\"80\" alt=\"[field:title/]\" /></a></dt>\r\n          <dd class=\"dd_1\"><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a>[field:sellpoint/]</dd>\r\n          <dd class=\"dd_2\">[field:price/]</dd>\r\n        </dl>\r\n       {/sline:getlinelist}\r\n        <script language=\"javascript\">\r\n				 $(function(){\r\n					 $(\".r_line\").find(\'dl\').last().addClass(\'bor_bot_none\');\r\n				 })\r\n         </script>\r\n      \r\n      </div>\r\n    </div>\r\n    <!--相关线路结束-->',0,0),(15,15,0,'客户咨询(蓝色)',' <!--客户咨询蓝色开始-->\r\n    <div class=\"k_side_list\">\r\n      <h3>客户提问</h3>\r\n      <div class=\"k_side_con\">\r\n        {sline:getquestion row=\'8\'}\r\n          <dl>\r\n            <dt><strong class=\"yk\">游客</strong>[field:content/]</dt>\r\n            <dd><strong class=\"kf\">回复</strong>先生/小姐：您好！[field:replycontent/]</dd>\r\n          </dl>\r\n       {/sline:getquestion}\r\n      </div>\r\n    </div>\r\n    <!--客户咨询蓝色结束-->',0,0),(16,16,0,'客户咨询(橙色)','<!--客户咨询橙色开始-->\r\n    <div class=\"k_side_list2\">\r\n      <h3>客户提问</h3>\r\n      <div class=\"k_side_con2\">\r\n         {sline:getquestion row=\'8\'}\r\n          <dl>\r\n            <dt><strong class=\"yk2\">游客</strong>[field:content/]</dt>\r\n            <dd><strong class=\"kf2\">回复</strong>先生/小姐：您好！[field:replycontent/]</dd>\r\n          </dl>\r\n       {/sline:getquestion}\r\n      </div>\r\n    </div>\r\n    <!--客户咨询橙色结束-->',0,0),(17,17,0,'租车文章',' <!--租车文章开始-->\r\n    <div class=\"side_strategy\">\r\n      <h3>租车信息</h3>\r\n      <dl>\r\n        {sline:getarclist flag=\'byattr\' attrid=\'3\' row=\'6\'}\r\n          <dd><a href=\"[field:url/]\" target=\"_blank\">[field:title/]</a></dd>\r\n        {/sline:getarclist}\r\n      </dl>\r\n    </div>\r\n    <!--租车文章结束-->',0,0),(18,18,0,'签证常见问题',' <div class=\"car_atc\">\r\n      <h3>签证常见问题</h3>\r\n      <div class=\"atc_list\">\r\n        <ul>\r\n          {sline:getarclist flag=\'byattr\' attrid=\'7\'}\r\n           <li><a href=\"[field:url/]\">[field:title/]</a></li>\r\n          {/sline:getarclist}\r\n         \r\n        </ul>\r\n      </div>\r\n    </div>',0,0),(19,19,0,'签证新闻动态','  <!--签证新闻动态开始-->\r\n    <div class=\"car_atc\">\r\n      <h3>签证新闻动态</h3>\r\n      <div class=\"atc_list\">\r\n        <ul>\r\n          {sline:getarclist flag=\'byattr\' attrid=\'8\'}\r\n           <li><a href=\"[field:url/]\">[field:title/]</a></li>\r\n          {/sline:getarclist}\r\n         \r\n        </ul>\r\n      </div>\r\n    </div>\r\n    <!--签证新闻动态开始-->',0,0),(20,20,0,'签证办理流程',' <!--签证新闻动态开始-->\r\n    <div class=\"car_atc\">\r\n      <h3>签证办理流程</h3>\r\n      <div class=\"atc_list\">\r\n        <ul>\r\n          {sline:getarclist flag=\'byattr\' attrid=\'9\'}\r\n           <li><a href=\"[field:url/]\">[field:title/]</a></li>\r\n          {/sline:getarclist}\r\n         \r\n        </ul>\r\n      </div>\r\n    </div>\r\n    <!--签证输程开始-->',0,0),(21,21,0,'右侧广告1','<div class=\"adment\">\r\n        {sline:myad name=\'GlobalRightA\'/}\r\n</div>',0,0),(22,22,0,'右侧广告2','<div class=\"adment\">\r\n        {sline:myad name=\'GlobalRightB\'/}\r\n</div>',0,0),(23,23,0,'右侧广告3','<div class=\"adment\">\r\n        {sline:myad name=\'GlobalRightC\'/}\r\n</div>',0,0),(24,24,0,'右侧广告4','<div class=\"adment\">\r\n     {sline:myad name=\'GlobalRightD\'/}\r\n</div>',0,0),(25,25,0,'右侧广告5','<div class=\"adment\">\r\n        {sline:myad name=\'GlobalRightE\'/}\r\n</div>',0,0),(26,26,0,'右侧广告6','<div class=\"adment\">\r\n        {sline:myad name=\'GlobalRightF\'/}\r\n</div>',0,0),(27,27,0,'右侧广告7','<div class=\"adment\">\r\n        {sline:myad name=\'GlobalRightG\'/}\r\n</div>',0,0),(28,28,0,'右侧广告8','<div class=\"adment\">\r\n        {sline:myad name=\'GlobalRightH\'/}\r\n</div>',0,0),(29,29,0,'登录注册',' <!--登陆注册模块开始-->\n    <div class=\"user_con\">\n        <a class=\"register\" href=\"/member/reg.php\">注册</a>\n        <a class=\"login\" href=\"/member/login.php\">登录</a>\n    </div>\n <!--登陆注册结束-->',0,0);

/*Table structure for table `sline_nav` */

DROP TABLE IF EXISTS `sline_nav`;

CREATE TABLE `sline_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT '0' COMMENT '用于区分多个sline系统',
  `aid` int(11) unsigned DEFAULT NULL,
  `typeid` int(1) DEFAULT NULL COMMENT '栏目ID',
  `pid` smallint(6) unsigned DEFAULT '0' COMMENT '父栏目ID',
  `typename` varchar(255) DEFAULT NULL COMMENT '栏目名称',
  `shortname` varchar(255) DEFAULT NULL COMMENT '栏目名称简写',
  `seotitle` varchar(255) DEFAULT NULL COMMENT 'seo标题',
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `jieshao` mediumtext COMMENT '栏目介绍',
  `tagword` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `linktype` int(1) DEFAULT NULL COMMENT '1,站内链接,0:站外链接',
  `isopen` int(1) DEFAULT '1' COMMENT '是否开放1,开放,0关闭',
  `displayorder` int(5) DEFAULT '9999',
  `issystem` int(1) unsigned DEFAULT '0' COMMENT '是否系统栏目',
  `linktitle` varchar(255) DEFAULT NULL,
  `isfinishseo` int(11) unsigned DEFAULT '0',
  `shownum` int(2) DEFAULT '5',
  `templetpath` varchar(255) DEFAULT NULL,
  `kind` tinyint(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

/*Data for the table `sline_nav` */

insert  into `sline_nav`(`id`,`webid`,`aid`,`typeid`,`pid`,`typename`,`shortname`,`seotitle`,`keyword`,`description`,`jieshao`,`tagword`,`url`,`linktype`,`isopen`,`displayorder`,`issystem`,`linktitle`,`isfinishseo`,`shownum`,`templetpath`,`kind`) values (1,0,2,1,0,'','线路','XXX旅游线路价格_XXX热门线路推荐','XXX旅游线路价格,XXX热门线路推荐','XXX网为您提供旅游线路大全，热卖旅游线路报价，热卖旅游线路价格等信息,欢迎咨询！',NULL,'线路','/lines/',1,1,1,1,'旅游线路',0,6,NULL,1),(2,0,3,2,0,'','酒店','XXX特价酒店预订_酒店住宿价格','XXX特价酒店预订,XXX酒店住宿价格','XXXX酒店频道提供3-8折国内经济酒店/连锁酒店/星级宾馆/四川景区酒店优惠预订服务，旅行社预订酒店价格有优势.',NULL,'酒店','/hotels/',1,1,6,1,'热门酒店',0,6,NULL,0),(3,0,4,3,0,'','租车','XXX旅游租车_XXX代驾租车','XXX旅游租车,XXX代驾租车','XXX租车频道提供旅游租车信息,为游客提供越野车,商务车,旅游大巴等旅游租车常用车辆的租赁,让您的包车旅行轻轻松松',NULL,'租车','/cars/',1,1,7,1,'旅游租车',0,6,NULL,0),(4,0,5,5,0,'','景点','旅游景点大全_旅游景点介绍_旅游景图片','旅游景点大全,旅游景点介绍,旅游景图片','XXX景点频道为您提供国内，境外旅游景点大全，著名旅游景点介绍，旅游景点推荐，旅游景点图片等信息。告诉你有哪些好玩的景点！',NULL,'旅游景点','/spots/',1,1,10,1,'旅游景点',0,6,NULL,0),(6,0,7,4,0,'','攻略','旅游攻略大全_自助游攻略_游记攻略','旅游攻略大全,自助游攻略,游记攻略','XXX攻略频道为游客提供全面和详细的旅行攻略大全，您可以详细了解到、游记、指南、地图、门票、美食、特产、交通灯信息。',NULL,'旅游攻略','/raiders/',1,1,11,1,'旅游攻略',0,6,NULL,2),(7,0,8,6,0,'','相册','旅游风景图片_旅游景点图片_旅行图片库','旅游风景图片,旅游景点图片,旅行图片库','XXX相册频道提供旅游风景图片，高清风景图片下载，让您通过丰富多彩的图片了解旅游景点的相关信息。',NULL,'旅游相册','/photos/',1,1,12,1,'旅游相册',0,6,NULL,0),(8,0,89,8,0,'签证','签证','旅游签证_签证办理','旅游签证,签证办理','XXX提供旅游签证办理，价格实惠，欢迎大家前来咨询预订！',NULL,'','/visa/',1,1,8,1,'签证',0,5,NULL,0),(9,0,90,12,0,'','目的地','热门旅游目的地','','','','','/destination/',1,0,5,1,'旅游目的地',0,5,NULL,0),(10,0,NULL,13,0,'团购','团购','热门团购','热门团购','XXX提供热门团购！','','','/tuan/',1,1,9,1,'团购',0,5,NULL,0),(11,0,NULL,14,0,'私人定制','私人定制','专属自己的私人定制','专属自己的私人定制','专属自己的私人定制','','','/customize/',1,0,13,1,'私人定制',0,5,NULL,0),(12,0,NULL,9,0,'机票','机票','特价机票_机票购买','特价机票,机票购买','XXX提供特价机票，机票购买请咨询我们！','','','/ticket/',1,0,15,1,'机票',0,5,NULL,0),(13,0,10,10,0,'','问答','旅游在线咨询问答','旅游在线咨询问答','旅游在线咨询问答',NULL,'问答','/questions/',1,0,14,1,'问答',0,5,NULL,0),(14,0,NULL,NULL,0,NULL,'成都周边',NULL,NULL,NULL,NULL,NULL,'/lines/sichuan/',0,1,2,0,'四川线路',0,5,NULL,2),(15,0,NULL,NULL,0,NULL,'国内游',NULL,NULL,NULL,NULL,NULL,'/lines/guoneiyou/',0,1,3,0,'国内旅游线路',0,5,NULL,0),(16,0,NULL,NULL,0,NULL,'出境游',NULL,NULL,NULL,NULL,NULL,'/lines/chujingyou/',0,1,4,0,'出境旅游线路',0,5,NULL,0),(18,0,NULL,11,0,NULL,'结伴','结伴','结伴','结伴',NULL,'结伴','/jieban/',1,0,9999,1,'结伴',0,5,NULL,0),(20,0,NULL,14,0,'导游','导游',NULL,NULL,NULL,NULL,NULL,'/daoyou/',1,0,9999,1,'/',0,5,NULL,0);

/*Table structure for table `sline_page` */

DROP TABLE IF EXISTS `sline_page`;

CREATE TABLE `sline_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL COMMENT '页面名称',
  `pagename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='思途页面模块列表';

/*Data for the table `sline_page` */

insert  into `sline_page`(`id`,`pid`,`kindname`,`pagename`) values (1,'0','公共模块',''),(2,'1','网页头部','header'),(3,'1','网页底部','footer'),(4,'0','首页模块',''),(5,'4','网站首页','index'),(6,'0','线路模块',NULL),(7,'0','酒店模块',NULL),(8,'6','线路首页','line_index'),(9,'6','线路列表页','line_list'),(10,'6','线路详细页','line_show'),(11,'7','酒店首页','hotel_index'),(12,'7','酒店列表页','hotel_list'),(13,'7','酒店详细页','hotel_show'),(14,'0','租车模块',NULL),(15,'14','租车首页','car_index'),(16,'14','租车列表页','car_list'),(17,'14','租车详细页','car_show'),(18,'0','攻略模块',NULL),(19,'18','攻略首页','article_index'),(20,'18','攻略列表页','article_list'),(21,'18','攻略详细页','article_show'),(22,'0','门票模块',NULL),(23,'22','门票首页','menpiao_index'),(24,'22','门票列表页','menpiao_list'),(25,'22','门票详细页','menpiao_shoa'),(26,'0','景点模块',NULL),(27,'26','景点首页','spot_index'),(28,'26','景点列表页','spot_list'),(29,'26','景点详细页','spot_show'),(30,'0','相册模块',NULL),(31,'30','相册首页','photo_index'),(32,'30','相册列表页','photo_list'),(33,'30','相册详细页','photo_show'),(34,'0','签证模块',NULL),(35,'34','签证首页','visa_index'),(36,'34','签证列表页','visa_list'),(37,'34','签证详细页','visa_show'),(38,'0','团购模块',NULL),(39,'38','团购首页','tuan_index'),(40,'38','团购列表页','tuan_list'),(41,'38','团购详细页','tuan_show'),(42,'0','目的地模块',NULL),(43,'42','目的地引导页','dest_boot'),(44,'42','目的地首页','dest_index'),(45,'0','帮助模块',NULL),(46,'45','帮助显示页','help_show'),(47,'0','底部导航模块',NULL),(48,'47','底部导航显示页','footer_show'),(49,'0','专题模块',NULL),(50,'1','登陆页面','member_login'),(51,'1','注册页面','member_reg'),(52,'1','全局搜索页面','cloudsearch_index'),(53,'49','专题显示页','zhuanti_show'),(54,'1','底部FAQ栏','help'),(55,'1','底部友情连接','flink');

/*Table structure for table `sline_page_config` */

DROP TABLE IF EXISTS `sline_page_config`;

CREATE TABLE `sline_page_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pageid` int(11) unsigned DEFAULT NULL COMMENT '页面id',
  `path` varchar(255) DEFAULT NULL COMMENT '模板路径',
  `isuse` tinyint(1) unsigned DEFAULT '0' COMMENT '是否使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='页面配置表';

/*Data for the table `sline_page_config` */

/*Table structure for table `sline_photo` */

DROP TABLE IF EXISTS `sline_photo`;

CREATE TABLE `sline_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `seotitle` varchar(255) DEFAULT NULL,
  `litpic` varchar(200) DEFAULT NULL COMMENT '相册封面',
  `author` varchar(50) DEFAULT NULL COMMENT '作者',
  `content` longtext,
  `tagword` varchar(200) DEFAULT NULL COMMENT '文章相关词',
  `shownum` int(11) DEFAULT NULL COMMENT '浏览数',
  `modtime` int(10) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `kindlist` varchar(255) DEFAULT NULL,
  `themelist` varchar(255) DEFAULT NULL,
  `attrid` varchar(255) DEFAULT NULL,
  `headimgid` int(11) unsigned DEFAULT NULL,
  `addtime` int(10) NOT NULL DEFAULT '0',
  `favorite` int(10) DEFAULT '0',
  `ishidden` tinyint(4) DEFAULT '0',
  `templet` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AID` (`aid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_photo` */

insert  into `sline_photo`(`id`,`webid`,`aid`,`title`,`seotitle`,`litpic`,`author`,`content`,`tagword`,`shownum`,`modtime`,`keyword`,`description`,`kindlist`,`themelist`,`attrid`,`headimgid`,`addtime`,`favorite`,`ishidden`,`templet`) values (1,0,1,'九寨沟','九寨沟美景相册','/uploads/main/litimg/20150909/20150909180911.jpg','九寨沟美景',NULL,'',NULL,1441793489,'九寨沟相册,九寨沟美景','','',NULL,'1',NULL,1442905970,1,0,NULL);

/*Table structure for table `sline_photo_attr` */

DROP TABLE IF EXISTS `sline_photo_attr`;

CREATE TABLE `sline_photo_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `attrname` varchar(255) DEFAULT NULL,
  `displayorder` int(11) unsigned DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `issystem` int(1) NOT NULL DEFAULT '0',
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_PID_ID` (`pid`,`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `sline_photo_attr` */

insert  into `sline_photo_attr`(`id`,`webid`,`aid`,`attrname`,`displayorder`,`isopen`,`pid`,`issystem`,`litpic`,`description`,`destid`) values (1,0,1,'名山名景',1,1,6,0,NULL,NULL,NULL),(2,0,2,'冰川',2,0,6,0,NULL,NULL,NULL),(3,0,3,'海岛',3,1,6,0,NULL,NULL,NULL),(4,0,4,'城市',4,1,6,0,NULL,NULL,NULL),(5,0,5,'古城建筑',2,1,6,0,NULL,NULL,NULL),(6,0,6,'默认',0,1,0,0,NULL,NULL,NULL),(7,0,7,'公园',6,1,6,0,NULL,NULL,NULL),(8,0,8,'教堂',7,1,6,0,NULL,NULL,NULL),(9,0,9,'海湾',8,1,6,0,NULL,NULL,NULL),(10,0,10,'文化馆',9,1,6,0,NULL,NULL,NULL),(11,0,11,'寺庙',10,1,6,0,NULL,NULL,NULL),(12,0,12,'广场',11,1,6,0,NULL,NULL,NULL);

/*Table structure for table `sline_photo_extend_field` */

DROP TABLE IF EXISTS `sline_photo_extend_field`;

CREATE TABLE `sline_photo_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='相册字段扩展表';

/*Data for the table `sline_photo_extend_field` */

/*Table structure for table `sline_photo_kindlist` */

DROP TABLE IF EXISTS `sline_photo_kindlist`;

CREATE TABLE `sline_photo_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_KINDID` (`kindid`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='ssmall线路分类总表';

/*Data for the table `sline_photo_kindlist` */

insert  into `sline_photo_kindlist`(`id`,`kindid`,`seotitle`,`keyword`,`description`,`tagword`,`jieshao`,`isfinishseo`,`displayorder`,`isnav`,`ishot`,`shownum`,`templetpath`) values (36,36,'','','','','',0,2,1,0,0,''),(37,37,'','','','','',0,3,1,0,0,'');

/*Table structure for table `sline_photo_picture` */

DROP TABLE IF EXISTS `sline_photo_picture`;

CREATE TABLE `sline_photo_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL,
  `pid` int(11) NOT NULL COMMENT '所属相册id',
  `litpic` varchar(100) DEFAULT NULL COMMENT '小图连接地址',
  `bigpic` varchar(100) DEFAULT NULL COMMENT '大图连接地址',
  `description` varchar(200) DEFAULT NULL,
  `isindex` int(1) DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `displayorder` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_photo_picture` */

insert  into `sline_photo_picture`(`id`,`webid`,`pid`,`litpic`,`bigpic`,`description`,`isindex`,`modtime`,`displayorder`) values (13,NULL,1,'/uploads/main/litimg/20150909/20150909180906.jpg',NULL,'九寨沟',NULL,NULL,NULL),(14,NULL,1,'/uploads/main/litimg/20150909/2015090918090650.jpg',NULL,'九寨沟',NULL,NULL,NULL),(15,NULL,1,'/uploads/main/litimg/20150909/20150909180911.jpg',NULL,'九寨沟',NULL,NULL,NULL),(16,NULL,1,'/uploads/main/litimg/20150909/20150909180936.jpg',NULL,'九寨沟',NULL,NULL,NULL),(17,NULL,1,'/uploads/main/litimg/20150909/20150909180937.jpg',NULL,'九寨沟',NULL,NULL,NULL),(18,NULL,1,'/uploads/main/litimg/20150909/20150909180947.jpg',NULL,'九寨沟',NULL,NULL,NULL);

/*Table structure for table `sline_plugin_autotitle` */

DROP TABLE IF EXISTS `sline_plugin_autotitle`;

CREATE TABLE `sline_plugin_autotitle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `sline_plugin_autotitle` */

insert  into `sline_plugin_autotitle`(`id`,`name`,`value`) values (1,'cfg_dest_title','XXX旅游报价_周边线路、酒店、租车以及景点、攻略推荐'),(2,'cfg_dest_desc','XXX为您提供XXX旅游专业报价，提供周边经典线路，酒店预订，旅行租车以及XXX旅游攻略等详细旅游信息，是帮助您前往XXX旅游的首选参考网站，欢迎访问！'),(3,'cfg_line_title','XXX旅游线路报价_XXX热门线路推荐'),(4,'cfg_line_desc','XXX为广大网友提供成都到XXX旅游线路网上特价预订，一站式服务，专业透明的旅游价格。更有XXX自由行、特色游、半自助游、小包团、跟团游和套餐酒店等产品量身定制，品质卓越。'),(5,'cfg_hotel_title','XXX预订_酒店房型、设施介绍_酒店报价'),(6,'cfg_hotel_desc','XXX为您提供XXX专业详细的房型、设施介绍，提供XXX专业酒店报价。旅行社预订XXX，价格优惠有优势，欢迎咨询！'),(7,'cfg_car_title','XXX旅游租车服务_租车电话'),(8,'cfg_car_desc','XXX为企业和个人提供XXX租车,为游客提供XXX旅游越野车,商务车,旅游大巴等常用车辆的租赁,让您的XXX旅行轻轻松松，欢迎咨询。'),(9,'cfg_article_title','XXX最新旅游攻略大全_住宿、美食、游记和旅行帮助'),(10,'cfg_article_desc','XXX最新旅游攻略大全_住宿、美食、游记和旅行帮助'),(11,'cfg_spot_title','XXX景点介绍与推荐_人文历史、景观建筑、风景图片等详细信息'),(12,'cfg_spot_desc','XXX景点介绍与推荐_人文历史、景观建筑、风景图片等详细信息'),(13,'cfg_photo_title','XXX风景图片摄影与欣赏'),(14,'cfg_photo_desc','XXX展示最美最全XXX风景图片，XXX清晰摄影照片，向您全面展示XXX的独特风景。欢迎您来XXX留下您的摄影旅行足迹。');

/*Table structure for table `sline_plugin_leftnav` */

DROP TABLE IF EXISTS `sline_plugin_leftnav`;

CREATE TABLE `sline_plugin_leftnav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL,
  `pid` int(11) unsigned DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned NOT NULL DEFAULT '9999',
  `isopen` int(1) unsigned NOT NULL DEFAULT '1',
  `litpic` varchar(200) DEFAULT NULL COMMENT '图标',
  `remark` varchar(200) DEFAULT NULL COMMENT '自定义说明',
  PRIMARY KEY (`id`),
  KEY `IDX_PID_DISPLAYORDER` (`pid`,`displayorder`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_plugin_leftnav` */

/*Table structure for table `sline_plugin_nav` */

DROP TABLE IF EXISTS `sline_plugin_nav`;

CREATE TABLE `sline_plugin_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL,
  `pid` int(11) unsigned DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned NOT NULL DEFAULT '9999',
  `isopen` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_plugin_nav` */

/*Table structure for table `sline_qq_group` */

DROP TABLE IF EXISTS `sline_qq_group`;

CREATE TABLE `sline_qq_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(30) DEFAULT NULL,
  `groupdes` varchar(150) DEFAULT NULL,
  `isopen` tinyint(1) DEFAULT '1',
  `webid` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_qq_group` */

/*Table structure for table `sline_qq_kefu` */

DROP TABLE IF EXISTS `sline_qq_kefu`;

CREATE TABLE `sline_qq_kefu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0',
  `qqname` varchar(50) DEFAULT NULL,
  `qqnum` varchar(20) DEFAULT NULL,
  `isopen` tinyint(3) DEFAULT '1',
  `displayorder` int(4) DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_qq_kefu` */

/*Table structure for table `sline_question` */

DROP TABLE IF EXISTS `sline_question`;

CREATE TABLE `sline_question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(2) unsigned DEFAULT NULL COMMENT '栏目类型',
  `productid` int(11) DEFAULT NULL COMMENT '文章所在表的id',
  `content` text COMMENT '提问内容',
  `replycontent` mediumtext COMMENT '回复内容',
  `replytime` int(10) unsigned DEFAULT NULL COMMENT '回复日期',
  `nickname` varchar(25) DEFAULT '' COMMENT '评论人昵称',
  `ip` varchar(23) DEFAULT NULL COMMENT '评论人ip地址',
  `status` int(2) unsigned DEFAULT '0' COMMENT '回复状态',
  `memberid` int(11) unsigned DEFAULT NULL COMMENT '会员id',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `kindlist` varchar(255) DEFAULT NULL COMMENT '目的地',
  `qq` varchar(50) DEFAULT NULL,
  `webid` int(11) DEFAULT '0',
  `phone` varchar(255) DEFAULT NULL,
  `weixin` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `questype` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_productid` (`productid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='问答表';

/*Data for the table `sline_question` */

insert  into `sline_question`(`id`,`typeid`,`productid`,`content`,`replycontent`,`replytime`,`nickname`,`ip`,`status`,`memberid`,`addtime`,`kindlist`,`qq`,`webid`,`phone`,`weixin`,`email`,`title`,`questype`) values (1,NULL,NULL,'请问去九寨沟旅游玩几天最好？我们一共5个人，准备国庆出行','<p>您好，去九寨沟游玩两天就可以，鉴于您国庆出行，可以再顺便游玩周边景点。建议您选择我们的九寨沟黄龙双汽四日游。祝您旅途愉快<img src=\"http://img.baidu.com/hi/ldw/w_0014.gif\"/>​</p>',1441793247,'匿名','222.209.124.195',1,NULL,1441793046,NULL,'1745231723',0,'','','','请问去九寨沟旅游玩几天最好？',1),(3,NULL,NULL,'请问到九寨游玩，需要提前多久时间租车最好？','<p>您好，租车的话至少提前一天预定好。祝您旅途愉快！</p>',1441865695,'夏天','222.209.124.195',1,NULL,1441865505,NULL,'481543532',0,'','','','请问到九寨游玩，需要提前多久时间租车最好？',1),(4,1,2,'峨眉山什么时候去好玩？','<p>游客您好！峨眉山一年四季都可以游玩，每个季节都有独特的景色！</p>',1441954826,'匿名','222.209.124.195',1,0,1441954778,'1,5',NULL,0,NULL,NULL,NULL,NULL,0);

/*Table structure for table `sline_question_kindlist` */

DROP TABLE IF EXISTS `sline_question_kindlist`;

CREATE TABLE `sline_question_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  PRIMARY KEY (`id`),
  KEY `IDX_KINDID` (`kindid`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ssmall线路分类总表';

/*Data for the table `sline_question_kindlist` */

/*Table structure for table `sline_role` */

DROP TABLE IF EXISTS `sline_role`;

CREATE TABLE `sline_role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `masterid` int(11) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `isoptn` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `sline_role` */

insert  into `sline_role`(`roleid`,`rolename`,`description`,`masterid`,`createdate`,`isoptn`) values (1,'系统管理员','',0,0,1);

/*Table structure for table `sline_role_module` */

DROP TABLE IF EXISTS `sline_role_module`;

CREATE TABLE `sline_role_module` (
  `roleid` int(11) NOT NULL,
  `moduleid` char(15) DEFAULT NULL,
  `slook` tinyint(1) NOT NULL DEFAULT '0',
  `smodify` tinyint(1) NOT NULL DEFAULT '0',
  `sadd` tinyint(1) NOT NULL DEFAULT '0',
  `sdelete` tinyint(1) NOT NULL DEFAULT '0',
  `sall` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_role_module` */

/*Table structure for table `sline_search_keyword` */

DROP TABLE IF EXISTS `sline_search_keyword`;

CREATE TABLE `sline_search_keyword` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL,
  `keynumber` int(11) unsigned DEFAULT '1',
  `displayorder` int(4) DEFAULT '9999' COMMENT '排序',
  `isopen` int(1) DEFAULT '0' COMMENT '是否开启',
  `addtime` int(10) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='搜索词表';

/*Data for the table `sline_search_keyword` */

/*Table structure for table `sline_serverlist` */

DROP TABLE IF EXISTS `sline_serverlist`;

CREATE TABLE `sline_serverlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `servername` varchar(20) DEFAULT NULL COMMENT '名称',
  `keywords` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` longtext COMMENT '详细内容',
  `addtime` int(11) unsigned DEFAULT NULL,
  `modtime` int(11) unsigned DEFAULT NULL,
  `isdisplay` int(1) unsigned DEFAULT '1' COMMENT '是否显示',
  `isauto` int(1) DEFAULT '0' COMMENT '是否默认分类',
  `displayorder` int(5) DEFAULT '9999',
  `sline_yqlj` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='副导航表';

/*Data for the table `sline_serverlist` */

insert  into `sline_serverlist`(`id`,`webid`,`aid`,`servername`,`keywords`,`description`,`content`,`addtime`,`modtime`,`isdisplay`,`isauto`,`displayorder`,`sline_yqlj`) values (1,0,1,'关于我们','','','',1316158745,1367044106,1,0,1,0),(2,0,2,'联系我们','','','',1316158745,1366856417,1,0,2,0),(4,0,4,'支付方式','','','',1316158745,1366861192,1,0,9,0),(7,0,7,'法律声明','','','',1317209943,1366861216,1,0,10,0),(10,0,10,'隐私保护','','','<p><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></p>\r\n<p><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt; mso-font-kerning: 1.0pt; mso-ansi-language: EN-US; mso-fareast-language: ZH-CN; mso-bidi-language: AR-SA; mso-fareast-font-family: 宋体\"><v:shapetype id=\"_x0000_t75\" coordsize=\"21600,21600\" o:spt=\"75\" o:preferrelative=\"t\" path=\"m@4@5l@4@11@9@11@9@5xe\" filled=\"f\" stroked=\"f\">&nbsp;<v:stroke joinstyle=\"miter\"></v:stroke><v:formulas><v:f eqn=\"if lineDrawn pixelLineWidth 0\"></v:f><v:f eqn=\"sum @0 1 0\"></v:f><v:f eqn=\"sum 0 0 @1\"></v:f><v:f eqn=\"prod @2 1 2\"></v:f><v:f eqn=\"prod @3 21600 pixelWidth\"></v:f><v:f eqn=\"prod @3 21600 pixelHeight\"></v:f><v:f eqn=\"sum @0 0 1\"></v:f><v:f eqn=\"prod @6 1 2\"></v:f><v:f eqn=\"prod @7 21600 pixelWidth\"></v:f><v:f eqn=\"sum @8 21600 0\"></v:f><v:f eqn=\"prod @7 21600 pixelHeight\"></v:f><v:f eqn=\"sum @10 21600 0\"></v:f></v:formulas><v:path o:extrusionok=\"f\" gradientshapeok=\"t\" o:connecttype=\"rect\"></v:path><o:lock v:ext=\"edit\" aspectratio=\"t\"></o:lock></v:shapetype></span></span><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">1</span></b><font face=\"宋体\"><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">、使用者非个人化信息</span></b><b><span lang=\"EN-US\" style=\"font-family: Arial; color: #88c22c; font-size: 9.5pt\"><o:p></o:p></span></b></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">我们将通过您的</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">IP</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">地址来收集非个人化的信息，例如您的浏览器性质、操作系统种类、给您提供接入服务的</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">ISP</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">的域名等，以优化在您计算机屏幕上显示的页面。通过收集上述信息，我们亦进行客流量统计，从而改进网站的管理和服务。</span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">2</span></b><font face=\"宋体\"><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">、个人资料</span></b></font></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">当您在网站进行用户注册登记、定制业务或参与公共论坛等活动时，在您的同意及确认下，本网站将通过注册表格、订单等形式要求您提供一些个人资料。这些个人资料包括：、</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span style=\"font-size: larger\"><span style=\"color: #c89340; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">个人识别资料：如姓名、性别、年龄、出生日期、身份证号码、电话、通信地址、住址、电子邮件地址等情况；</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340\"><br />\r\n</span><span style=\"color: #c89340; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">个人背景：</font></span><span style=\"font-family: Arial; color: #c89340\"> </span><font face=\"宋体\"><span style=\"color: #c89340; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">职业、教育程度、收入状况、婚姻、家庭状况。</span></font></span><font face=\"宋体\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">请了解，在未经您同意及确认之前，本网站不会将您为参加本网站之特定活动所提供的资料利用于其它目的。惟按下列第</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">6</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">条规定应政府及法律要求披露时不在此限。</span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">3</span></b><font face=\"宋体\"><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">、信息安全</span></b></font></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">本网站将对您所提供的资料进行严格的管理及保护，本网站将使用相应的技术，防止您的个人资料丢失、被盗用或遭窜改。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">本网站得在必要时委托专业技术人员代为对该类资料进行电脑处理，以符合专业分工时代的需求。如本网站将电脑处理之通知送达予您，而您未在通知规定的时间内主动明示反对，本网站将推定您已同意。惟在其后您仍然有权如下述第</font></span><st1:chsdate year=\"1899\" month=\"12\" day=\"30\" islunardate=\"False\" isrocdate=\"False\" w:st=\"on\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">4.1.4</span></st1:chsdate><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">条之规定，请求停止电脑处理。</span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">4</span></b><font face=\"宋体\"><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">、用户权利</span></b></font></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">您对于自己的个人资料享有以下权利：</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp; ●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">随时查询及请求阅览；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">随时请求补充或更正；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp; ●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">随时请求删除；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp; ●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">请求停止电脑处理及利用。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">限制利用原则</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">本网站惟在符合下列条件之一，方对收集之个人资料进行必要范围以外之利用：</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: red; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">已取得您的书面同意；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">为免除您在生命、身体或财产方面之急迫危险；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><spanlang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">为防止他人权益之重大危害；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">为增进公共利益，</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">且无害于您的重大利益。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><b><span lang=\"EN-US\" style=\"font-family: Arial; color: #88c22c; font-size: 9.5pt\">&nbsp;<o:p></o:p></span></b></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">3</span></b><font face=\"宋体\"><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">、个人资料之披露</span></b></font></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">当政府机关依照法定程序要求本网站披露个人资料时，本网站将根据执法单位之要求或为公共安全之目的提供个人资料。在此情况下之任何披露，本网站均得免责。</span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">4</span></b><font face=\"宋体\"><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">、未成年人隐私权的保护</span></b></font></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">本网站将建立和维持一合理的程序，以保护未成年人个人资料的保密性及安全性。本网站郑重声明：任何</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">16</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">岁以下的未成年人参加网上活动应事先得到家长或其法定监护人（以下统称为</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&quot;</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">监护人</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&quot;</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">）的可经查证的同意。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">监护人应承担保护未成年人在网络环境下的隐私权的首要责任。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">本网站收集未成年人的个人资料，仅为回覆未成人特定要求的目的，一俟回复完毕即从记录中删除，而不会保留这些资料做进一步的利用。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">未经监护人之同意，本网站将不会使用未成年人之个人资料，亦不会向任何第三方披露或传送可识别该未成人的个人资料。本网站如收集监护人或未成年人的姓名或其它网络通讯资料之目的仅是为获得监护人同意，则在经过一段合理时间仍未获得同意时，将主动从记录中删除此类资料。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><strong><span style=\"font-family: 宋体; color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">若经未成人之监护人同意，本网站可对未成年人之个人资料进行收集，本网站将向监护人提供：</span></strong><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></p>\r\n<p><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\">&nbsp; &nbsp; &nbsp;&gt;&gt;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">审视自其子女或被监护人收集之资料的机会；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #333333; font-size: 8pt\"><o:p></o:p></span></font></p>\r\n<p><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\">&nbsp; &nbsp; &nbsp;&gt;&gt;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">拒绝其子女或被监护人的个人资料被进一步的收集或利用的机会；</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #333333; font-size: 8pt\"><o:p></o:p></span></font></p>\r\n<p><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\">&nbsp; &nbsp; &nbsp;&gt;&gt;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">变更或删除其子女或被监护人个人资料的方式。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #333333; font-size: 8pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">监护人有权拒绝本网站与其子女或被监护人做进一步的联络。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">本网站收集未成年人的个人资料，这些资料只是单纯作为保护未成年人参与网络活动时的安全，而非作为其它目的之利用。本网站保证不会要求未成年人提供额外的个人资料，以作为允许其参与网上活动的条件。</span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">5</span></b><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">、</font></span></b><b><span lang=\"EN-US\" style=\"font-family: Arial; color: black; font-size: 9.5pt\">Cookies</span></b></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;Cookies</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">是指一种技术，当使用者访问设有</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">Cookies</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">装置的本网站时，本网站之服务器会自动发送</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">Cookies</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">至阁下浏览器内，并储存到您的电脑硬盘内，此</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">Cookies</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">便负责记录日后您到访本网站的种种活动、个人资料、浏览习惯、消费习惯甚至信用记录。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">&nbsp; &nbsp; &nbsp;&nbsp;</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">运用</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">Cookies</span><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">技术，本网站能够为您提供更加周到的个性化服务。本网站将会运用</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">Cookies</span><font face=\"宋体\"><span style=\"color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">追访您的购物喜好，从而向您提供感兴趣的信息资料或储存密码，以便您造访本网站时不必每次重复输入密码。</span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><font face=\"宋体\"><b><span style=\"color: black; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">免责</span></b></font></p>\r\n<p class=\"liname\" style=\"line-height: 16.3pt; margin: 0cm0cm 0pt\">&nbsp;</p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\"><strong><span style=\"font-family: 宋体; color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">除上述第</span></strong><strong><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\">6</span></strong><strong><span style=\"font-family: 宋体; color: #666666; font-size: 9.5pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">条规定属免责外，下列情况时本网站亦毋需承担任何责任：</span></strong><span lang=\"EN-US\" style=\"font-family: Arial; color: #666666; font-size: 9.5pt\"><o:p></o:p></span></p>\r\n<p><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\">&nbsp; &nbsp; &nbsp; ● </span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">由于您将用户密码告知他人或与他人共享注册帐户，由此导致的任何个人资料泄露。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #333333; font-size: 8pt\"><o:p></o:p></span></font></p>\r\n<p><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\">&nbsp; &nbsp; &nbsp; ●&nbsp;</span><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">任何由于计算机</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\">2000</span><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\"><font face=\"宋体\">年问题、黑客政击、计算机病毒侵入或发作、因政府管制而造成的暂时性关闭等影响网络</font></span><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">正常经营之不可抗力而造成的个人资料泄露、丢失、被盗用或被窜改等。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #333333; font-size: 8pt\"><o:p></o:p></span></font></p>\r\n<p><span lang=\"EN-US\" style=\"font-family: Arial; color: #c89340; font-size: 8pt\">&nbsp; &nbsp; &nbsp; ●&nbsp;</span><font face=\"宋体\"><span style=\"color: #c89340; font-size: 8pt; mso-ascii-font-family: Arial; mso-hansi-font-family: Arial; mso-bidi-font-family: Arial\">由于与本网站链接的其它网站所造成之个人资料泄露及由此而导致的任何法律争议和后果。</span><span lang=\"EN-US\" style=\"font-family: Arial; color: #333333; font-size: 8pt\"><o:p></o:p></span></font></p>\r\n<p style=\"line-height: 16.3pt; margin: 0cm 0cm 0pt\">&nbsp;</p>',1342921194,1366861308,1,0,4,0),(14,1,1,'法律声明 ',NULL,NULL,'<p>&nbsp;法律声明</p>',1379472199,1379472199,1,0,1,NULL);

/*Table structure for table `sline_site_page` */

DROP TABLE IF EXISTS `sline_site_page`;

CREATE TABLE `sline_site_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL COMMENT '页面名称',
  `pagename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COMMENT='思途子站页面模块列表';

/*Data for the table `sline_site_page` */

insert  into `sline_site_page`(`id`,`pid`,`kindname`,`pagename`) values (1,'0','公共模块',''),(2,'1','网页头部','header'),(3,'1','网页底部','footer'),(4,'0','首页模块',''),(5,'4','网站首页','index'),(6,'0','线路模块',NULL),(7,'0','酒店模块',NULL),(9,'6','线路列表页','line_list'),(10,'6','线路详细页','line_show'),(12,'7','酒店列表页','hotel_list'),(13,'7','酒店详细页','hotel_show'),(14,'0','租车模块',NULL),(16,'14','租车列表页','car_list'),(17,'14','租车详细页','car_show'),(18,'0','攻略模块',NULL),(20,'18','攻略列表页','article_list'),(21,'18','攻略详细页','article_show'),(22,'0','门票模块',NULL),(24,'22','门票列表页','menpiao_list'),(25,'22','门票详细页','menpiao_shoa'),(26,'0','景点模块',NULL),(28,'26','景点列表页','spot_list'),(29,'26','景点详细页','spot_show'),(30,'0','相册模块',NULL),(32,'30','相册列表页','photo_list'),(33,'30','相册详细页','photo_show'),(34,'0','签证模块',NULL),(36,'34','签证列表页','visa_list'),(37,'34','签证详细页','visa_show'),(38,'0','团购模块',NULL),(40,'38','团购列表页','tuan_list'),(41,'38','团购详细页','tuan_show'),(47,'0','底部导航模块',NULL),(48,'47','底部导航显示页','footer_show'),(54,'1','底部FAQ栏','help'),(55,'1','底部友情连接','flink');

/*Table structure for table `sline_site_page_config` */

DROP TABLE IF EXISTS `sline_site_page_config`;

CREATE TABLE `sline_site_page_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT NULL COMMENT '子站id',
  `pageid` int(11) unsigned DEFAULT NULL COMMENT '页面id',
  `path` varchar(255) DEFAULT NULL COMMENT '模板路径',
  `isuse` tinyint(1) unsigned DEFAULT '0' COMMENT '是否使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='子站用户页面配置表';

/*Data for the table `sline_site_page_config` */

/*Table structure for table `sline_sms_msg` */

DROP TABLE IF EXISTS `sline_sms_msg`;

CREATE TABLE `sline_sms_msg` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msgtype` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `sline_sms_msg` */

insert  into `sline_sms_msg`(`id`,`msgtype`,`msg`,`isopen`) values (1,'reg','恭喜您注册成功为{#WEBNAME#}会员，帐号：{#LOGINNAME#}密码：{#PASSWORD#}，您也可通过手机为帐号登陆网站。',0),(2,'line_order_msg1','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品,我们将于30分钟内尽快确认您的预订.',0),(3,'line_order_msg2','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品 数量:{#NUMBER#},总价格:{#TOTALPRICE#}已经提交成功,请你尽快进行支付.',1),(4,'line_order_msg3','尊敬的会员{#MEMBERNAME#}:您已成功预订{#PRODUCTNAME#}产品 数量{#NUMBER#},请凭{#WEBNAME#}提示短信前住消费.',0),(5,'line_order_msg4','尊敬的会员{#MEMBERNAME#}:您已预订{#PRODUCTNAME#}产品因系统原因被取消.',0),(6,'hotel_order_msg1','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品,我们将于30分钟内尽快确认您的预订.',0),(7,'hotel_order_msg2','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品 数量:{#NUMBER#},总价格:{#TOTALPRICE#}已经提交成功,请你尽快进行支付.',0),(8,'hotel_order_msg3','尊敬的会员{#MEMBERNAME#}:您已成功预订{#PRODUCTNAME#}产品 数量{#NUMBER#},请凭{#WEBNAME#}提示短信前住消费.',0),(9,'hotel_order_msg4','尊敬的会员{#MEMBERNAME#}:您已预订{#PRODUCTNAME#}产品因系统原因被取消.',0),(10,'car_order_msg1','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品,我们将于30分钟内尽快确认您的预订.',0),(11,'car_order_msg2','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品 数量:{#NUMBER#},总价格:{#TOTALPRICE#}已经提交成功,请你尽快进行支付.',0),(12,'car_order_msg3','尊敬的会员{#MEMBERNAME#}:您已成功预订{#PRODUCTNAME#}产品 数量{#NUMBER#},请凭{#WEBNAME#}提示短信前住消费.',0),(13,'car_order_msg4','尊敬的会员{#MEMBERNAME#}:您已预订{#PRODUCTNAME#}产品因系统原因被取消.',0),(14,'spot_order_msg1','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品,我们将于30分钟内尽快确认您的预订.',0),(15,'spot_order_msg2','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品 数量:{#NUMBER#},总价格:{#TOTALPRICE#}已经提交成功,请你尽快进行支付.',0),(16,'spot_order_msg3','尊敬的会员{#MEMBERNAME#}:您已成功预订{#PRODUCTNAME#}产品 数量{#NUMBER#},请凭{#WEBNAME#}提示短信前住消费.',0),(17,'spot_order_msg4','尊敬的会员{#MEMBERNAME#}:您已预订{#PRODUCTNAME#}产品因系统原因被取消.',0),(18,'visa_order_msg1','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品,我们将于30分钟内尽快确认您的预订.',0),(19,'visa_order_msg2','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品 数量:{#NUMBER#},总价格:{#TOTALPRICE#}已经提交成功,请你尽快进行支付.',0),(20,'visa_order_msg3','尊敬的会员{#MEMBERNAME#}:您已成功预订{#PRODUCTNAME#}产品 数量{#NUMBER#},请凭{#WEBNAME#}提示短信前住消费.',0),(21,'visa_order_msg4','尊敬的会员{#MEMBERNAME#}:您已预订{#PRODUCTNAME#}产品因系统原因被取消.',0),(22,'tuan_order_msg1','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品,我们将于30分钟内尽快确认您的预订.',0),(23,'tuan_order_msg2','尊敬的会员{#MEMBERNAME#}:您预订的{#PRODUCTNAME#}产品 数量:{#NUMBER#},总价格:{#TOTALPRICE#}已经提交成功,请你尽快进行支付.',0),(24,'tuan_order_msg3','尊敬的会员{#MEMBERNAME#}:您已成功预订{#PRODUCTNAME#}产品 数量{#NUMBER#},请凭{#WEBNAME#}提示短信前住消费.',0),(25,'tuan_order_msg4','尊敬的会员{#MEMBERNAME#}:您已预订{#PRODUCTNAME#}产品因系统原因被取消.',0),(26,'reg_msgcode','尊敬的会员,请您在{#WEBNAME#}中输入以下验证码:{#CODE#},完成用户注册.',0),(27,'reg_findpwd','尊敬的会员,请您在{#WEBNAME#}中输入以下验证码:{#CODE#},完成密码找回验证.',0);

/*Table structure for table `sline_spot` */

DROP TABLE IF EXISTS `sline_spot`;

CREATE TABLE `sline_spot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `shortname` varchar(20) DEFAULT NULL,
  `seotitle` varchar(255) DEFAULT NULL,
  `isspotarea` int(1) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `content` longtext COMMENT '景区介绍',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '更新时间',
  `shownum` int(11) DEFAULT '1' COMMENT '浏览量',
  `author` varchar(20) DEFAULT NULL COMMENT '添加人',
  `tagword` varchar(200) DEFAULT NULL COMMENT '文章相关词',
  `keyword` varchar(200) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL,
  `lng` double DEFAULT NULL COMMENT '经度坐标',
  `lat` double DEFAULT NULL COMMENT '纬度坐标',
  `kindlist` varchar(255) DEFAULT NULL,
  `themelist` varchar(255) DEFAULT NULL,
  `attrid` varchar(255) DEFAULT NULL,
  `piclist` text,
  `booknotice` text COMMENT '预订说明',
  `friendtip` varchar(255) DEFAULT NULL COMMENT '友情提示',
  `getway` varchar(255) DEFAULT NULL COMMENT '取票方式',
  `sellpoint` varchar(255) DEFAULT NULL COMMENT '卖点',
  `address` varchar(255) DEFAULT NULL COMMENT '景区地址',
  `iconlist` varchar(255) DEFAULT NULL,
  `ishidden` tinyint(1) DEFAULT '0',
  `satisfyscore` int(11) DEFAULT NULL,
  `bookcount` varchar(255) DEFAULT NULL,
  `supplierlist` varchar(255) DEFAULT NULL,
  `templet` varchar(255) DEFAULT NULL,
  `recommendnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_DOORPRICE_WEBID` (`price`,`webid`) USING BTREE,
  KEY `IDX_WEBID` (`webid`) USING BTREE,
  KEY `IDX_AID` (`aid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_spot` */

insert  into `sline_spot`(`id`,`webid`,`aid`,`title`,`shortname`,`seotitle`,`isspotarea`,`price`,`litpic`,`content`,`addtime`,`modtime`,`shownum`,`author`,`tagword`,`keyword`,`description`,`lng`,`lat`,`kindlist`,`themelist`,`attrid`,`piclist`,`booknotice`,`friendtip`,`getway`,`sellpoint`,`address`,`iconlist`,`ishidden`,`satisfyscore`,`bookcount`,`supplierlist`,`templet`,`recommendnum`) values (1,0,1,'九寨沟珍珠滩','九寨沟','九寨沟珍珠滩',0,65,'/uploads/2015/0910/e9e44e6baed2e1a8893ddb2073815f40.jpg','<p>​&nbsp;珍珠滩布满了坑洞，沿坡而下的激流在坑洞中撞击，溅起无数朵水花，在阳光照射下，点点水珠似珍珠洒落，&amp;ldquo;珍珠滩&amp;rdquo;之名由此而来。横跨珍珠滩有一道栈桥，栈桥的南侧水滩上布满了灌木丛，激流从桥下通过后，在北侧的浅滩上激起了一串串、一片片滚动跳跃的珍珠。迅猛的激流在斜滩上前行200米，就到了斜滩的悬崖尽头，冲出悬崖跌落在深谷之中，形成了雄伟壮观的珍珠滩瀑布。</p><p style=\"text-align: center;\"><img title=\"\" alt=\"\" src=\"/uploads/2015/0910/7da460a9d352b9dbdd2be8e97a1167f4.png\"/></p><p style=\"text-align: center;\">&nbsp;</p><p style=\"text-align: left;\">九寨沟珍珠滩据说,很久以前,一位过路的女神爱上了一位藏族青年,小伙子送她一串珍珠项链,女神回赠她一把开山斧。青年用开山斧开水渠引水,被天神知道后,勃然大怒,派兵来捉拿女神,一把扯断了她脖子上的项链,珍珠纷纷落地,化作美丽的珍珠滩。</p><p style=\"text-align: center;\"><img title=\"\" alt=\"\" src=\"/uploads/2015/0910/6758b2d2e5035389ac019e4a746974f6.png\"/><img title=\"\" alt=\"\" src=\"/uploads/2015/0910/4925b80c6ee0a0488040f22b52015870.png\"/></p><p style=\"text-align: center;\"><img title=\"\" alt=\"\" src=\"/uploads/2015/0910/9dd3b5ad907ceea9b5cb83b70dcf13cd.png\"/>​</p>',1441852586,1443075932,27,'','九寨沟珍珠滩','珍珠滩','九寨沟珍珠滩',0,0,'36,38,40','','24','/uploads/2015/0910/e9e44e6baed2e1a8893ddb2073815f40.jpg',NULL,NULL,'景点售票处自取','森林 AAAAA','四川省九寨沟景区','2',0,92,'35',NULL,NULL,0),(2,0,2,'海螺沟冰川','海螺沟','海螺沟冰川',0,85,'/uploads/2015/0910/31a34e7ebbbf7894d75f37e13c99be11.jpg','<p>　　加拿大冰川国家公园以其落差1100米的冰瀑布而闻名于世。海螺沟内的大冰瀑布足堪与其匹敌。海螺沟冰川众多，较大的冰川就有三条，最大的称为一号冰川，长约14公理，也就是平常所说的大冰瀑布。沿冰川上行三公里，绕过黑松林，即可望见这条大冰瀑布。冰瀑布宽达1100米，落差1080米，由无数极其巨大的光芒四射的冰块组成，仿佛从蓝天直泄而下的一道银河。除非你亲眼见到，没有任何词汇能形容它的瑰丽笥伟大。冰川最高点的海拨为6750米，而最下端的海拨高度仅为2850米，它不但是低纬度低海拨的冰川，而且是落差最大的冰川。由于冰体组成的冰瀑布不象水瀑布那样流动，但由于冰体融冻作用，它不断产生冰崩。冰川活动剧烈的春夏季，一天可达上千次，最多时一次可塌垮上百万立方米的冰体。冰崩时，冰体间剧烈的撞击与磨擦会产生放电现象，一时蓝光闪烁、大地震颤、山谷轰呜，千千万万的冰块滑落着、飞溅着，扬起漫天雪雾。冰瀑布的观景点是通过多次观察与计算选择的，远在冰瀑布数公里外，因此，既使是最大规模的冰崩也不会给游客的安全带来威胁。</p><p style=\"text-align: center;\"><img src=\"/uploads/2015/0910/d71ac6d353237f386e75027b351692a9.jpg\" alt=\"\" title=\"\"/></p><p>​　　海螺沟冰川常人最容易进入的冰川，一般体力者可亲身登上冰体厚度为100米左右的冰川，但一般是不允许游客自行前往大冰瀑布的，因为在冰层覆盖下有暗河，稍不留意，就有可能酿成大错，曾经有一位登山者就掉入暗河。如果要上冰川，一定要当地的导游带领才可以进入。　海螺沟的二、三号冰川分别长为4.8、4.2公理，在一号冰川之侧面，但他们的最低点的海拨也在3650米以上，常人很难到达，仅供专业登山者攀登。</p>',1441857003,1443163459,16,'','海螺沟冰川','海螺沟','海螺沟冰川',0,0,'36,38',NULL,NULL,'/uploads/2015/0910/31a34e7ebbbf7894d75f37e13c99be11.jpg','<p>该门票需在线支付</p><p>支持退款该门票支持退款。其他规定，详见退款说明。</p><p><br/></p><p>演示系统请勿在线付款。</p>',NULL,'景区门口取票','雪山 AAAAA ','海螺沟冰川',NULL,0,95,'20',NULL,NULL,NULL),(3,0,3,'九寨沟犀牛海','九寨沟','',0,100,'/uploads/2015/0923/b9eca56686a67ee01c3e22991c28bd68.png','<p style=\"white-space: normal;\">&nbsp; &nbsp; &nbsp; &nbsp; 犀牛海是一座长约2.2千米，水深17米，海拔高度2400米，最深的地方可以达到40多米。是树正沟最大的海子。犀牛海的南端有一座栈桥通过对岸。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\"><img width=\"690\" height=\"441\" alt=\"\" src=\"http://ys.stourweb.com/uploads/arcimgs/20140526/2014052605520232.png\"/><br/><br/>　&nbsp;&nbsp;&nbsp; 犀牛海是<a href=\"http://ys.stourweb.com/jiuzhaigou/\" target=\"_blank\">九寨沟</a>中景色变化最多的海子之一，犀牛海是九寨沟的第二大海，其倒影几乎是众海之冠。每天清晨去雾飘渺时的云雾倒影，亦幻亦真，让人分不清哪里是天，哪里是海。湖岸四周的彩叶也是亮丽多姿，艳冠群芳。犀牛海水域开阔，北岸的尽头是生意盎然的芦苇丛，南岸的出口既有树林，又有银瀑，中间一大片是蓝得醉人的湖面。犀牛海的这一片山光水色，能让游客留连忘返。</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\"><img width=\"690\" height=\"474\" alt=\"\" src=\"http://ys.stourweb.com/uploads/arcimgs/20140526/2014052605520335.png\"/></p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">&nbsp;</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\"><img width=\"690\" height=\"449\" alt=\"\" src=\"http://ys.stourweb.com/uploads/arcimgs/20140526/2014052605520430.png\"/><br/><br/>　&nbsp;&nbsp;&nbsp; 传说古时候，有一位身患重病、奄奄一息的藏族老喇嘛，骑着犀牛来到这里。当他饮用了这里的湖水后，病症竟然奇迹似的康复了。于时老喇嘛日夜饮这里的湖水，舍不得离开，最后更骑着犀牛进入海中，永久定居于此，这个海子便称为犀牛海。<img width=\"690\" height=\"434\" alt=\"\" src=\"http://ys.stourweb.com/uploads/arcimgs/20140526/2014052605520930.png\"/></p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\">&nbsp;</p><p style=\"white-space: normal;\"><br/></p><p style=\"white-space: normal;\"><img width=\"690\" height=\"486\" alt=\"\" src=\"http://ys.stourweb.com/uploads/arcimgs/20140526/2014052605521124.png\"/>&nbsp;</p><p><br/></p>',1442997459,1443000375,1021,'','','','',0,0,'36,38,40','','1,23','/uploads/2015/0923/b9eca56686a67ee01c3e22991c28bd68.png',NULL,NULL,'景点自取','','九寨沟风景区','1',0,98,'357',NULL,NULL,0);

/*Table structure for table `sline_spot_attr` */

DROP TABLE IF EXISTS `sline_spot_attr`;

CREATE TABLE `sline_spot_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL COMMENT 'sline对应ID',
  `attrname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `displayorder` int(11) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  `issystem` int(1) DEFAULT '0',
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='车务品牌表';

/*Data for the table `sline_spot_attr` */

insert  into `sline_spot_attr`(`id`,`webid`,`attrname`,`displayorder`,`isopen`,`pid`,`destid`,`issystem`,`litpic`,`description`) values (1,0,'森林',1,1,13,NULL,0,NULL,NULL),(2,0,'草原',2,1,13,NULL,0,NULL,NULL),(3,0,'购物',3,1,13,NULL,0,NULL,NULL),(4,0,'亲子',4,1,13,NULL,0,NULL,NULL),(5,0,'雪山',5,1,13,NULL,0,NULL,NULL),(6,0,'海岛',9999,1,13,NULL,0,NULL,NULL),(7,0,'蜜月',9999,1,13,NULL,0,NULL,NULL),(8,0,'美食',9999,1,13,NULL,0,NULL,NULL),(9,0,'都市',9999,1,13,NULL,0,NULL,NULL),(10,0,'古城古镇',9999,1,13,NULL,0,NULL,NULL),(11,0,'亲子',9999,1,13,NULL,0,NULL,NULL),(12,0,'高原',6,1,13,NULL,0,NULL,NULL),(13,0,'景点主题',1,1,0,'',0,NULL,NULL),(19,0,'景点等级',9999,1,0,NULL,0,NULL,NULL),(20,0,'A',9999,1,19,NULL,0,NULL,NULL),(21,0,'AA',9999,1,19,NULL,0,NULL,NULL),(22,0,'AAA',9999,1,19,NULL,0,NULL,NULL),(23,0,'AAAA',9999,1,19,NULL,0,NULL,NULL),(24,0,'AAAAA',9999,1,19,NULL,0,NULL,NULL);

/*Table structure for table `sline_spot_content` */

DROP TABLE IF EXISTS `sline_spot_content`;

CREATE TABLE `sline_spot_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '使用的字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL COMMENT '是否系统字段',
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isrealfield` int(1) unsigned DEFAULT '1' COMMENT '是否真实字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类表';

/*Data for the table `sline_spot_content` */

insert  into `sline_spot_content`(`id`,`webid`,`columnname`,`chinesename`,`displayorder`,`issystem`,`isopen`,`isrealfield`) values (1,0,'booknotice','预订须知',2,1,1,1),(2,0,'content','景点介绍',1,1,1,1),(3,0,'tupian','图片',0,1,0,0);

/*Table structure for table `sline_spot_extend_field` */

DROP TABLE IF EXISTS `sline_spot_extend_field`;

CREATE TABLE `sline_spot_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='景点字段扩展表';

/*Data for the table `sline_spot_extend_field` */

/*Table structure for table `sline_spot_kindlist` */

DROP TABLE IF EXISTS `sline_spot_kindlist`;

CREATE TABLE `sline_spot_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_KINDID` (`kindid`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COMMENT='ssmall线路分类总表';

/*Data for the table `sline_spot_kindlist` */

insert  into `sline_spot_kindlist`(`id`,`kindid`,`seotitle`,`keyword`,`description`,`tagword`,`jieshao`,`isfinishseo`,`displayorder`,`isnav`,`ishot`,`shownum`,`templetpath`) values (36,36,'','','','','',0,2,1,0,0,''),(37,37,'','','','','',0,3,1,0,0,'');

/*Table structure for table `sline_spot_pricelist` */

DROP TABLE IF EXISTS `sline_spot_pricelist`;

CREATE TABLE `sline_spot_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL COMMENT 'WEBID',
  `aid` int(11) unsigned DEFAULT NULL,
  `min` int(11) DEFAULT NULL COMMENT '最小酒店价格',
  `max` int(11) DEFAULT NULL COMMENT '最大酒店价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=gb2312 ROW_FORMAT=FIXED;

/*Data for the table `sline_spot_pricelist` */

insert  into `sline_spot_pricelist`(`id`,`webid`,`aid`,`min`,`max`) values (1,0,1,NULL,100),(2,0,3,101,200),(3,0,5,201,300),(4,0,6,301,400),(5,0,7,401,500),(6,0,8,501,600),(8,0,12,701,800),(9,0,13,801,NULL);

/*Table structure for table `sline_spot_ticket` */

DROP TABLE IF EXISTS `sline_spot_ticket`;

CREATE TABLE `sline_spot_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `spotid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '门票名称',
  `tickettypeid` int(11) unsigned DEFAULT NULL COMMENT '门票类型id',
  `sellprice` varchar(255) DEFAULT NULL COMMENT '票面价格',
  `ourprice` varchar(255) DEFAULT NULL COMMENT '优惠价格',
  `memberdayprice` varchar(255) DEFAULT NULL,
  `paytype` varchar(255) DEFAULT NULL COMMENT '支付方式',
  `award` int(11) unsigned DEFAULT NULL COMMENT '会员预订返现奖金',
  `description` varchar(255) DEFAULT NULL COMMENT '门票描述',
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `displayorder` int(11) unsigned DEFAULT '9999',
  `number` int(11) DEFAULT NULL COMMENT '门票数量(库存)',
  `bnum` varchar(255) DEFAULT NULL COMMENT '已被预订数量',
  `mnum` varchar(255) DEFAULT NULL COMMENT '会员限制预订数量',
  `startdate` varchar(255) DEFAULT NULL COMMENT '限制开始日期',
  `enddate` varchar(255) DEFAULT NULL COMMENT '限制结束时间',
  `jifencomment` int(11) DEFAULT '0' COMMENT '评论送积分',
  `jifentprice` int(11) DEFAULT '0' COMMENT '积分抵现金',
  `jifenbook` int(11) DEFAULT '0' COMMENT '预订送积分',
  `dingjin` varchar(255) DEFAULT NULL COMMENT '定金',
  PRIMARY KEY (`id`),
  KEY `IDX_SPOTID_OURPRICE` (`spotid`,`ourprice`) USING BTREE,
  KEY `IDX_SPOTID_SELLPRICE` (`spotid`,`sellprice`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `sline_spot_ticket` */

insert  into `sline_spot_ticket`(`id`,`spotid`,`title`,`tickettypeid`,`sellprice`,`ourprice`,`memberdayprice`,`paytype`,`award`,`description`,`addtime`,`modtime`,`displayorder`,`number`,`bnum`,`mnum`,`startdate`,`enddate`,`jifencomment`,`jifentprice`,`jifenbook`,`dingjin`) values (1,1,'九寨沟珍珠滩',1,'80','65',NULL,'1',NULL,'九寨沟珍珠滩（九寨沟珍珠滩门票），超划算！',NULL,NULL,9999,100,NULL,NULL,NULL,NULL,2,5,10,'0'),(2,2,'海螺沟门票',2,'120','102',NULL,'1',NULL,'',NULL,NULL,9999,100,NULL,NULL,NULL,NULL,2,1,10,'0'),(3,2,'冰川索道',3,'90','85',NULL,'1',NULL,'',NULL,NULL,9999,100,NULL,NULL,NULL,NULL,2,1,10,'0'),(4,3,'犀牛海门票',14,'150','100',NULL,'1',NULL,'',NULL,NULL,9999,-1,NULL,NULL,NULL,NULL,2,1,10,'0');

/*Table structure for table `sline_spot_ticket_type` */

DROP TABLE IF EXISTS `sline_spot_ticket_type`;

CREATE TABLE `sline_spot_ticket_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kindname` varchar(255) DEFAULT NULL COMMENT '门票类型名称',
  `spotid` varchar(255) DEFAULT NULL COMMENT '景点id',
  `description` varchar(255) DEFAULT NULL COMMENT '类型描述',
  `displayorder` int(11) unsigned DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*Data for the table `sline_spot_ticket_type` */

insert  into `sline_spot_ticket_type`(`id`,`kindname`,`spotid`,`description`,`displayorder`) values (1,'九寨沟珍珠滩门票','1',NULL,1),(2,'成人','2',NULL,0),(3,'索道','2',NULL,0),(4,'成人','2',NULL,0),(5,'索道','2',NULL,0),(6,'成人','2',NULL,0),(7,'索道','2',NULL,0),(8,'成人','2',NULL,0),(9,'索道','2',NULL,0),(14,'成人票','3',NULL,1),(15,'成人票','4',NULL,1);

/*Table structure for table `sline_startplace` */

DROP TABLE IF EXISTS `sline_startplace`;

CREATE TABLE `sline_startplace` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destid` int(11) DEFAULT NULL COMMENT '目的地ID',
  `cityname` varchar(255) DEFAULT NULL,
  `isdefault` int(1) unsigned DEFAULT '0' COMMENT '是否默认',
  `isopen` int(1) unsigned DEFAULT '0',
  `displayorder` int(11) DEFAULT '9999',
  `domain` varchar(255) DEFAULT NULL COMMENT '域名',
  `pid` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

/*Data for the table `sline_startplace` */

insert  into `sline_startplace`(`id`,`destid`,`cityname`,`isdefault`,`isopen`,`displayorder`,`domain`,`pid`) values (29,1201,'西南',0,1,9999,NULL,0),(75,NULL,'成都',0,1,9999,NULL,29);

/*Table structure for table `sline_stats` */

DROP TABLE IF EXISTS `sline_stats`;

CREATE TABLE `sline_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access_time` int(10) unsigned NOT NULL DEFAULT '0',
  `ip_address` varchar(15) NOT NULL DEFAULT '',
  `visit_times` smallint(5) unsigned NOT NULL DEFAULT '1',
  `browser` varchar(60) NOT NULL DEFAULT '',
  `system` varchar(20) NOT NULL DEFAULT '',
  `language` varchar(20) NOT NULL DEFAULT '',
  `referer_domain` varchar(100) NOT NULL DEFAULT '',
  `referer_path` varchar(200) NOT NULL DEFAULT '',
  `access_url` varchar(255) NOT NULL DEFAULT '',
  `searchengine` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `keynum` int(10) NOT NULL DEFAULT '0',
  `webid` int(3) NOT NULL DEFAULT '0',
  `timemark` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '页面标题',
  PRIMARY KEY (`id`),
  KEY `access_time` (`access_time`),
  KEY `keynum` (`keynum`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_stats` */

/*Table structure for table `sline_supplier` */

DROP TABLE IF EXISTS `sline_supplier`;

CREATE TABLE `sline_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliername` varchar(255) DEFAULT NULL COMMENT '供应商名称',
  `linkman` varchar(100) DEFAULT NULL COMMENT '联系人',
  `telephone` varchar(100) DEFAULT NULL COMMENT '联系电话',
  `mobile` varchar(100) DEFAULT NULL COMMENT '手机',
  `fax` varchar(50) DEFAULT NULL COMMENT '传真',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `litpic` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商表';

/*Data for the table `sline_supplier` */

/*Table structure for table `sline_sysconfig` */

DROP TABLE IF EXISTS `sline_sysconfig`;

CREATE TABLE `sline_sysconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT NULL,
  `varname` varchar(30) DEFAULT NULL COMMENT '变量名称',
  `info` varchar(255) DEFAULT NULL COMMENT '参数描述',
  `value` mediumtext COMMENT '变量值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统变量配置表';

/*Data for the table `sline_sysconfig` */

insert  into `sline_sysconfig`(`id`,`webid`,`varname`,`info`,`value`) values (1,0,'cfg_medias_dir','上传路径','/uploads'),(2,0,'cfg_cmspath','网站路径',''),(3,0,'cfg_cli_time','时差值','8'),(5,0,'cfg_webname','网站名称','旅游'),(6,0,'cfg_keywords','关键词','XXXX旅游网'),(7,0,'cfg_description','描述','XXXX旅游网'),(8,0,'cfg_indextitle','首页标题','XXXX旅游网'),(9,0,'cfg_index_zhuti','首页主题',''),(10,0,'cfg_indexcode','首页代码',''),(11,0,'cfg_gonggao','公告','<p><span style=\"color: #808080\">四川门户电子商务网站系统，用于快速建设旅游网站：订购网站<a href=\"http://www.stourweb.com\">www.stourweb.com</a>，电话：4006-0999-27</span></p>'),(12,0,'cfg_tongjicode','统计代码 ',''),(13,0,'cfg_df_style','网站样式','orange'),(14,0,'cfg_weathcode','天气代码','  '),(16,0,'cfg_beian','网站备案号',''),(17,0,'cfg_powerby','网站版权信息','思途旅游网'),(18,0,'cfg_indexname','主页链接名','首页'),(21,0,'cfg_notallowstr','评论禁用词语','她妈|它妈|他妈|你妈|去死|贱人|SB|航空票|飞航空票'),(22,0,'cfg_feedback_time','评论间隔时间','0'),(25,0,'cfg_tplcache_dir','缓存目录','/data/tplcache'),(26,0,'cfg_taposition','客服位置','0'),(27,0,'cfg_taindex','是否在中间弹出','1'),(28,0,'cfg_logo','logo图片','/uploads/main/adimg/20140303/20140303104231.gif'),(29,0,'cfg_logourl','logo连接位置','http://www.stourweb.com'),(30,0,'cfg_logoalt','logo alt标识','思途旅游CMS'),(31,0,'cfg_lxslogo','旅行社标识','/uploads/main/adimg/20130918/20130918175433.gif'),(32,0,'cfg_lxslogoalt','lxglogo alt标识','jjf'),(33,0,'cfg_lxslogourl','旅行社logo连接地址','http://www.suv.com'),(35,0,'cfg_Email139','默认139邮箱','d@139.com'),(36,0,'cfg_lineEmail','线路139Email',''),(37,0,'cfg_carEmail','车务139Email',''),(38,0,'cfg_hotelEmail','酒店139Email',''),(39,0,'cfg_indexphoto','相册首页滚动情况','0'),(40,0,'cfg_payment','签约付款','\n<p>&nbsp;<span id=\"1348816711927E\"><span style=\"font-size: larger\">网上预订：直接通过网站下单，在线选择产品并填写相关信息后，提交订单。</span></span></p>\n<p>&nbsp;<span style=\"font-size: larger\">在线预订：拨打咨询/预订电话，由客服帮助您完成信息的确认和下单操作。</span></p>'),(41,0,'cfg_qsmaillcontent','邮件内容设置','<p>我们已经收到并处理了您的提问，欢迎回来访问本站，查看我们的回复；如果您还有疑问，欢迎您提问，我们将尽快回复您！</p>'),(42,0,'cfg_corephrases','核心词组','旅游,思途旅游,思途旅游CMS'),(45,0,'cfg_wenda_open','是否开启问答','0'),(46,0,'cfg_logodisplay','网站LOGO显示栏目',''),(47,0,'cfg_color','线路字体颜色','1'),(48,0,'cfg_wenEmail','提问139email',''),(49,0,'cfg_indexlinktitle','首页连接title',''),(60,0,'cfg_html_kefu','客服代码',''),(61,0,'cfg_html_editor','使用的编辑器','slineeditor'),(64,0,'cfg_df_img','默认图片','/uploads/main/allimg/20150923/20150923143441.jpg'),(65,0,'cfg_alipay_account','支付宝帐号',''),(66,0,'cfg_alipay_signtype','支付宝签约类型','cash'),(67,0,'cfg_alipay_pid','合作者身份ID','FFF'),(68,0,'cfg_alipay_key','交易安全校验码','FFF'),(69,0,'cfg_web_open','网站开关','1'),(70,0,'cfg_logoalt','logo标识','思途旅游CMS'),(71,0,'cfg_alipay_signtype','签约类型','cash'),(72,0,'cfg_py_open','评论','1'),(74,0,'cfg_supplier_msg','客户{#LINKMAN#}预订{#PRODUCTNAME#}产品,联系电话:{#PHONE#},人数:{#NUMBER#},单价:{#PRICE#},总价:{#TOTALPRICE#},请尽快处理.','1'),(75,0,'cfg_index_templet',NULL,'index_3.htm'),(76,0,'cfg_auto_time',NULL,''),(77,0,'cfg_phone',NULL,'4006-0999-27'),(78,0,'cfg_mobile_phone',NULL,'4006-0999-27'),(79,0,'alipay',NULL,'1'),(80,0,'cfg_bill_account',NULL,''),(81,0,'cfg_bill_key',NULL,''),(82,0,'cfg_huicao_account',NULL,''),(83,0,'cfg_huicao_key',NULL,''),(84,0,'cfg_qianbao_merchno',NULL,''),(85,0,'cfg_qianbao_key',NULL,''),(86,0,'cfg_paypal_key',NULL,''),(87,0,'cfg_paypal_currency',NULL,''),(88,0,'cfg_wxpay_appid',NULL,''),(89,0,'cfg_wxpay_mchid',NULL,''),(90,0,'cfg_wxpay_key',NULL,''),(91,0,'cfg_wxpay_appsecret',NULL,''),(92,0,'cfg_yinlian_type',NULL,'0'),(93,0,'cfg_yinlian_merid',NULL,''),(94,0,'cfg_yinlian_mername',NULL,''),(95,0,'cfg_yinlian_securitykey',NULL,''),(96,0,'cfg_yinlian_new_name',NULL,''),(97,0,'cfg_yinlian_new_securitykey',NULL,''),(98,0,'cfg_pay_type',NULL,'6,11'),(99,0,'cfg_pay_xianxia',NULL,''),(100,0,'alipay_cash',NULL,'11'),(101,0,'xianxia',NULL,'6'),(102,0,'cfg_logotitle',NULL,''),(103,0,'cfg_m_logo',NULL,'/uploads/main/allimg/20150924/20150924160228.gif'),(104,0,'cfg_qq_appid',NULL,''),(105,0,'cfg_qq_appkey',NULL,''),(106,0,'cfg_sina_appkey',NULL,''),(107,0,'cfg_sina_appsecret',NULL,''),(108,0,'cfg_weixi_appkey',NULL,''),(109,0,'cfg_weixi_appsecret',NULL,''),(110,0,'cfg_mobile_open',NULL,'1'),(111,0,'cfg_startcity_open',NULL,'1'),(112,0,'cfg_login_jifen',NULL,'1'),(113,0,'cfg_reg_jifen',NULL,'2'),(114,0,'cfg_exchange_jifen',NULL,'10');

/*Table structure for table `sline_tagword` */

DROP TABLE IF EXISTS `sline_tagword`;

CREATE TABLE `sline_tagword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '1',
  `typeid` int(11) DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL COMMENT '具体词语',
  `aid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='相关词总汇';

/*Data for the table `sline_tagword` */

/*Table structure for table `sline_templet` */

DROP TABLE IF EXISTS `sline_templet`;

CREATE TABLE `sline_templet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tempname` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `zippath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `sline_templet` */

insert  into `sline_templet`(`id`,`tempname`,`description`,`addtime`,`zippath`) values (45,'orange','',1376615102,''),(46,'green','',1376615102,'');

/*Table structure for table `sline_theme` */

DROP TABLE IF EXISTS `sline_theme`;

CREATE TABLE `sline_theme` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` varchar(255) DEFAULT NULL,
  `webid` int(2) unsigned DEFAULT '0',
  `ztname` varchar(255) DEFAULT NULL,
  `seotitle` varchar(255) DEFAULT NULL COMMENT 'seo标题',
  `shortname` varchar(255) DEFAULT NULL COMMENT '专题简短主题',
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL COMMENT '主题游LOGO',
  `jieshao` text COMMENT '专题介绍',
  `bgcolor` varchar(255) DEFAULT NULL COMMENT '背景颜色',
  `bgimage` varchar(255) DEFAULT NULL COMMENT '专题背景',
  `templetpath` varchar(255) DEFAULT NULL COMMENT '自定义模板名称',
  `kindlist` varchar(255) DEFAULT NULL COMMENT '专题所属目的地',
  `tagword` varchar(255) DEFAULT NULL,
  `shownum` int(11) unsigned DEFAULT NULL,
  `displayorder` int(11) unsigned DEFAULT '9999',
  `addtime` int(11) unsigned DEFAULT NULL,
  `modtime` varchar(255) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '1',
  `templet` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='主题游';

/*Data for the table `sline_theme` */

/*Table structure for table `sline_ticket` */

DROP TABLE IF EXISTS `sline_ticket`;

CREATE TABLE `sline_ticket` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `startcity` varchar(50) DEFAULT NULL COMMENT '起飞城市',
  `midcity` varchar(50) DEFAULT NULL COMMENT '中转城市',
  `overcity` varchar(50) DEFAULT NULL COMMENT '到达城市',
  `tickettype` int(1) unsigned DEFAULT NULL COMMENT '机票类型 1,单程,2联程,3往返',
  `taketime` varchar(255) DEFAULT NULL COMMENT '起飞时间',
  `arrivetime` varchar(255) DEFAULT NULL COMMENT '到达时间',
  `company` varchar(255) DEFAULT NULL COMMENT '航空公司',
  `planenum` varchar(255) DEFAULT NULL COMMENT '航班号',
  `flighttypeid` varchar(255) DEFAULT NULL COMMENT '机型id',
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `ismiddle` int(2) NOT NULL,
  `timerate` varchar(255) DEFAULT NULL COMMENT '准点率',
  `hasrepast` int(1) DEFAULT '0' COMMENT '是否有餐饮',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='票务表';

/*Data for the table `sline_ticket` */

/*Table structure for table `sline_ticket_airport` */

DROP TABLE IF EXISTS `sline_ticket_airport`;

CREATE TABLE `sline_ticket_airport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destid` int(11) DEFAULT NULL COMMENT '目的地ID(扩展)',
  `planename` varchar(255) DEFAULT NULL,
  `isdefault` int(1) unsigned DEFAULT '0' COMMENT '是否默认',
  `isopen` int(1) unsigned DEFAULT '0',
  `displayorder` int(11) DEFAULT '9999',
  `domain` varchar(255) DEFAULT NULL COMMENT '域名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_ticket_airport` */

/*Table structure for table `sline_ticket_booking` */

DROP TABLE IF EXISTS `sline_ticket_booking`;

CREATE TABLE `sline_ticket_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fatherid` int(11) NOT NULL COMMENT '机票ID',
  `name` varchar(50) NOT NULL COMMENT '订票人',
  `ordernum` int(11) NOT NULL COMMENT '预定机票张数',
  `planedate` int(10) NOT NULL COMMENT '航班日期',
  `cell` varchar(50) NOT NULL COMMENT '联系电话',
  `qqmsn` varchar(50) NOT NULL COMMENT 'QQ',
  `emaill` varchar(50) NOT NULL COMMENT '邮箱',
  `status` int(1) unsigned NOT NULL DEFAULT '0',
  `webid` int(11) NOT NULL DEFAULT '1',
  `ordersn` varchar(255) DEFAULT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_ticket_booking` */

/*Table structure for table `sline_ticket_company` */

DROP TABLE IF EXISTS `sline_ticket_company`;

CREATE TABLE `sline_ticket_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destid` int(11) DEFAULT NULL COMMENT '目的地ID(扩展)',
  `companyname` varchar(255) DEFAULT NULL,
  `isdefault` int(1) unsigned DEFAULT '0' COMMENT '是否默认',
  `isopen` int(1) unsigned DEFAULT '0',
  `displayorder` int(11) DEFAULT '9999',
  `domain` varchar(255) DEFAULT NULL COMMENT '域名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_ticket_company` */

/*Table structure for table `sline_tool_link` */

DROP TABLE IF EXISTS `sline_tool_link`;

CREATE TABLE `sline_tool_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` int(1) DEFAULT '2' COMMENT '1,重要目标关键词,2,长尾关键词',
  `linkurl` varchar(500) DEFAULT NULL COMMENT '链接地址',
  `linelink` int(6) DEFAULT '0' COMMENT '线路链接数量',
  `addtime` int(10) unsigned DEFAULT '0',
  `hotellink` int(6) unsigned DEFAULT '0',
  `carlink` int(6) unsigned DEFAULT '0',
  `articlelink` int(6) unsigned DEFAULT '0',
  `spotlink` int(6) unsigned DEFAULT '0',
  `photolink` int(6) unsigned DEFAULT '0',
  `visalink` int(6) unsigned DEFAULT '0',
  `questionlink` int(6) unsigned DEFAULT '0',
  `tuanlink` int(6) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='智能链接优化表';

/*Data for the table `sline_tool_link` */

/*Table structure for table `sline_tuan` */

DROP TABLE IF EXISTS `sline_tuan`;

CREATE TABLE `sline_tuan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned DEFAULT NULL,
  `webid` int(2) unsigned DEFAULT '0',
  `title` varchar(600) DEFAULT NULL,
  `shortname` varchar(255) DEFAULT NULL,
  `seotitle` varchar(600) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `sellprice` int(11) DEFAULT NULL COMMENT '原价',
  `price` int(11) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `starttime` int(10) unsigned DEFAULT NULL COMMENT '团购开始时间',
  `endtime` int(10) unsigned DEFAULT NULL COMMENT '团购结束时间',
  `bookcount` int(11) unsigned DEFAULT '0' COMMENT '预订单数',
  `content` mediumtext COMMENT '团购内容介绍',
  `kindlist` varchar(255) DEFAULT NULL,
  `attrid` varchar(255) DEFAULT NULL,
  `shownum` int(11) unsigned DEFAULT NULL,
  `displayorder` int(11) unsigned DEFAULT '9999',
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `totalnum` varchar(50) DEFAULT NULL COMMENT '产品总数量',
  `virtualnum` varchar(255) DEFAULT NULL COMMENT '虚拟购买数量',
  `validdate` varchar(255) DEFAULT NULL COMMENT '券使用的有效期',
  `piclist` text,
  `ishidden` int(1) unsigned DEFAULT '0',
  `jifenbook` int(11) DEFAULT '0',
  `jifentprice` int(11) DEFAULT '0',
  `jifencomment` int(11) DEFAULT '0',
  `sellpoint` varchar(255) DEFAULT NULL COMMENT '卖点',
  `dingjin` varchar(255) DEFAULT NULL COMMENT '定金',
  `paytype` int(1) DEFAULT '1' COMMENT '支付方式',
  `themelist` varchar(255) DEFAULT NULL,
  `iconlist` varchar(255) DEFAULT NULL,
  `supplierlist` varchar(255) DEFAULT NULL,
  `templet` varchar(255) DEFAULT NULL,
  `satisfyscore` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_AID` (`aid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='团购表';

/*Data for the table `sline_tuan` */

insert  into `sline_tuan`(`id`,`aid`,`webid`,`title`,`shortname`,`seotitle`,`keyword`,`tagword`,`description`,`sellprice`,`price`,`litpic`,`starttime`,`endtime`,`bookcount`,`content`,`kindlist`,`attrid`,`shownum`,`displayorder`,`addtime`,`modtime`,`totalnum`,`virtualnum`,`validdate`,`piclist`,`ishidden`,`jifenbook`,`jifentprice`,`jifencomment`,`sellpoint`,`dingjin`,`paytype`,`themelist`,`iconlist`,`supplierlist`,`templet`,`satisfyscore`) values (1,1,0,'九寨沟旅游蜜月婚纱纯拍','九寨沟婚纱摄影','','','','',8999,7999,'/uploads/2015/0910/6a906fd00c04b754068adb0e750369a7.jpg',1441814400,1483113600,0,'','','199,0,199,200',NULL,9999,1441851620,1441851750,'60','35','','/uploads/2015/0910/6a906fd00c04b754068adb0e750369a7.jpg||',0,10,2,2,'在童话世界九寨沟拍摄最美最漂亮的婚纱照，为自己的人生留下最美的回忆。','0',1,NULL,NULL,NULL,'',0),(2,2,0,'峨眉乐山超值二日跟团游','峨眉乐山二日游','峨眉乐山超值二日跟团游','峨眉乐山跟团游','','',640,300,'/uploads/2015/0910/56771e33bccf59ebf3d897e0c7f15e84.jpg',1441814400,1475164800,0,'','','199,200',NULL,9999,1441863792,1442905540,'15','6','','/uploads/2015/0910/56771e33bccf59ebf3d897e0c7f15e84.jpg||',0,10,1,2,'三百元玩遍峨眉乐山，周末超值旅游，带上亲人，相约好友，周末跟我走！','0',1,NULL,NULL,NULL,'',0),(3,3,0,'九寨沟珍珠滩门票团购特卖','珍珠滩门票团购','九寨沟珍珠滩门票','珍珠滩,门票','','',80,35,'/uploads/2015/0924/6d1e5e93d6c1a77d336095467158abb8.jpg',1443024000,1483113600,0,'<p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; list-style-type: none; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">珍珠滩布满了坑洞，沿坡而下的激流在坑洞中撞击，溅起无数朵水花，在阳光照射下，点点水珠似珍珠洒落，&amp;ldquo;珍珠滩&amp;rdquo;之名由此而来。横跨珍珠滩有一道栈桥，栈桥的南侧水滩上布满了灌木丛，激流从桥下通过后，在北侧的浅滩上激起了一串串、一片片滚动跳跃的珍珠。迅猛的激流在斜滩上前行200米，就到了斜滩的悬崖尽头，冲出悬崖跌落在深谷之中，形成了雄伟壮观的珍珠滩瀑布。</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; list-style-type: none; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal; text-align: center;\"><img title=\"\" alt=\"\" src=\"http://testdata.souxw.com/uploads/2015/0910/7da460a9d352b9dbdd2be8e97a1167f4.png\" style=\"padding: 0px; margin: 0px; list-style-type: none; border: 0px;\"/></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; list-style-type: none; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal; text-align: center;\">&nbsp;</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; list-style-type: none; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal;\">九寨沟珍珠滩据说,很久以前,一位过路的女神爱上了一位藏族青年,小伙子送她一串珍珠项链,女神回赠她一把开山斧。青年用开山斧开水渠引水,被天神知道后,勃然大怒,派兵来捉拿女神,一把扯断了她脖子上的项链,珍珠纷纷落地,化作美丽的珍珠滩。</p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; list-style-type: none; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal; text-align: center;\"><img title=\"\" alt=\"\" src=\"http://testdata.souxw.com/uploads/2015/0910/6758b2d2e5035389ac019e4a746974f6.png\" style=\"padding: 0px; margin: 0px; list-style-type: none; border: 0px;\"/><img title=\"\" alt=\"\" src=\"http://testdata.souxw.com/uploads/2015/0910/4925b80c6ee0a0488040f22b52015870.png\" style=\"padding: 0px; margin: 0px; list-style-type: none; border: 0px;\"/></p><p style=\"padding: 0px; margin-top: 0px; margin-bottom: 0px; list-style-type: none; color: rgb(85, 85, 85); font-family: 微软雅黑, Arial, Helvetica, sans-serif; font-size: 12px; line-height: 24px; white-space: normal; text-align: center;\"><img title=\"\" alt=\"\" src=\"http://testdata.souxw.com/uploads/2015/0910/9dd3b5ad907ceea9b5cb83b70dcf13cd.png\" style=\"padding: 0px; margin: 0px; list-style-type: none; border: 0px;\"/></p><p><br/></p>','36,38,40',NULL,NULL,9999,1443072729,1443234528,'100','65','30天','/uploads/2015/0924/6d1e5e93d6c1a77d336095467158abb8.jpg||',0,10,1,2,'九寨沟最美的景色之一，去九寨沟玩必去珍珠滩！绝妙的美景让你顿时忘记所有烦恼，感受大自然的神奇魔力！','0',1,NULL,'1',NULL,'',500);

/*Table structure for table `sline_tuan_attr` */

DROP TABLE IF EXISTS `sline_tuan_attr`;

CREATE TABLE `sline_tuan_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(1) unsigned DEFAULT '0',
  `attrname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `displayorder` int(11) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `issystem` int(1) unsigned DEFAULT '0',
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_PID_ID` (`pid`,`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='团购属性表';

/*Data for the table `sline_tuan_attr` */

/*Table structure for table `sline_tuan_booking` */

DROP TABLE IF EXISTS `sline_tuan_booking`;

CREATE TABLE `sline_tuan_booking` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webid` int(3) unsigned NOT NULL DEFAULT '0',
  `tuanid` int(11) DEFAULT NULL,
  `dingnum` varchar(100) DEFAULT NULL COMMENT '预订数量',
  `price` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL COMMENT '其它备注信息',
  `dingname` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL COMMENT '性别',
  `dingtel` varchar(255) DEFAULT NULL COMMENT '预订联系人电话',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '处理时间',
  `status` int(1) unsigned DEFAULT '0' COMMENT '处理状态',
  `ordersn` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `memberid` int(11) DEFAULT NULL COMMENT '会员ID',
  `validdate` varchar(255) DEFAULT NULL COMMENT '有效期',
  `ispay` int(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_tuan_booking` */

/*Table structure for table `sline_tuan_content` */

DROP TABLE IF EXISTS `sline_tuan_content`;

CREATE TABLE `sline_tuan_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '使用的字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL COMMENT '是否系统字段',
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isrealfield` int(1) unsigned DEFAULT '1' COMMENT '是否真实字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类表';

/*Data for the table `sline_tuan_content` */

insert  into `sline_tuan_content`(`id`,`webid`,`columnname`,`chinesename`,`displayorder`,`issystem`,`isopen`,`isrealfield`) values (1,0,'content','产品介绍',1,1,1,1),(2,0,'tupian','图片',0,1,0,0);

/*Table structure for table `sline_tuan_extend_field` */

DROP TABLE IF EXISTS `sline_tuan_extend_field`;

CREATE TABLE `sline_tuan_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='团购字段扩展表';

/*Data for the table `sline_tuan_extend_field` */

/*Table structure for table `sline_tuan_kindlist` */

DROP TABLE IF EXISTS `sline_tuan_kindlist`;

CREATE TABLE `sline_tuan_kindlist` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `kindid` int(11) unsigned NOT NULL DEFAULT '0',
  `seotitle` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `jieshao` text,
  `isfinishseo` int(1) unsigned NOT NULL DEFAULT '0',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isnav` int(1) unsigned DEFAULT '0' COMMENT '是否导航',
  `ishot` int(1) unsigned DEFAULT '0' COMMENT '是否热门',
  `shownum` int(8) DEFAULT NULL,
  `templetpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_KINDID` (`kindid`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDID` (`displayorder`,`kindid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ssmall线路分类总表';

/*Data for the table `sline_tuan_kindlist` */

/*Table structure for table `sline_user_log` */

DROP TABLE IF EXISTS `sline_user_log`;

CREATE TABLE `sline_user_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `logtime` int(11) unsigned NOT NULL,
  `uid` int(6) unsigned NOT NULL,
  `username` char(50) NOT NULL,
  `loginfo` varchar(100) NOT NULL,
  `logip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

/*Data for the table `sline_user_log` */

insert  into `sline_user_log`(`id`,`logtime`,`uid`,`username`,`loginfo`,`logip`) values (1,1447147746,1,'admin','用户admin在2015-11-10 17:29:06执行index->index操作','127.0.0.1'),(2,1447147748,1,'admin','用户admin在2015-11-10 17:29:08执行index->ajax_clear_log操作','127.0.0.1'),(3,1447147748,1,'admin','用户admin在2015-11-10 17:29:08执行index->index2操作','127.0.0.1'),(4,1447147749,1,'admin','用户admin在2015-11-10 17:29:09执行index->ajax_order_num操作','127.0.0.1'),(5,1447147750,1,'admin','用户admin在2015-11-10 17:29:10执行index->ajax_visit_list操作','127.0.0.1'),(6,1447147750,1,'admin','用户admin在2015-11-10 17:29:10执行upgrade->ajax_check_update操作','127.0.0.1'),(7,1447147750,1,'admin','用户admin在2015-11-10 17:29:10执行index->ajax_get_last_article操作','127.0.0.1'),(8,1447147751,1,'admin','用户admin在2015-11-10 17:29:11执行upgrade->ajax_version操作','127.0.0.1'),(9,1447147751,1,'admin','用户admin在2015-11-10 17:29:11执行index->ajax_order_num_graph操作','127.0.0.1'),(10,1447147752,1,'admin','用户admin在2015-11-10 17:29:12执行index->ajax_member_num操作','127.0.0.1'),(11,1447147752,1,'admin','用户admin在2015-11-10 17:29:12执行index->ajax_ippv_num操作','127.0.0.1'),(12,1447147752,1,'admin','用户admin在2015-11-10 17:29:12执行upgrade->ajax_check_right操作','127.0.0.1'),(13,1447147753,1,'admin','用户admin在2015-11-10 17:29:13执行index->ajax_clearcache操作','127.0.0.1'),(14,1447147756,1,'admin','用户admin在2015-11-10 17:29:16执行order->index操作','127.0.0.1'),(15,1447147758,1,'admin','用户admin在2015-11-10 17:29:18执行order->ajax_sell_info操作','127.0.0.1'),(16,1447147781,1,'admin','用户admin在2015-11-10 17:29:41执行order->index操作','127.0.0.1'),(17,1447147781,1,'admin','用户admin在2015-11-10 17:29:41执行order->ajax_sell_info操作','127.0.0.1'),(18,1447147782,1,'admin','用户admin在2015-11-10 17:29:42执行order->index->read操作','127.0.0.1'),(19,1447147788,1,'admin','用户admin在2015-11-10 17:29:48执行order->index操作','127.0.0.1'),(20,1447147789,1,'admin','用户admin在2015-11-10 17:29:49执行order->ajax_sell_info操作','127.0.0.1'),(21,1447147789,1,'admin','用户admin在2015-11-10 17:29:49执行order->index->read操作','127.0.0.1'),(22,1447147791,1,'admin','用户admin在2015-11-10 17:29:51执行order->index操作','127.0.0.1'),(23,1447147792,1,'admin','用户admin在2015-11-10 17:29:52执行order->ajax_sell_info操作','127.0.0.1'),(24,1447147792,1,'admin','用户admin在2015-11-10 17:29:52执行order->index->read操作','127.0.0.1');

/*Table structure for table `sline_visa` */

DROP TABLE IF EXISTS `sline_visa`;

CREATE TABLE `sline_visa` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT '0',
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '签证名称',
  `seotitle` varchar(255) DEFAULT NULL,
  `sellpoint` varchar(255) DEFAULT NULL COMMENT '卖点',
  `keyword` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `tagword` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `visatype` int(2) unsigned DEFAULT NULL COMMENT '签证类型',
  `handleday` varchar(255) DEFAULT NULL COMMENT '办理时间',
  `validday` varchar(255) DEFAULT NULL COMMENT '有效时间',
  `needinterview` int(1) DEFAULT '0' COMMENT '是否需要面签',
  `needletter` int(1) unsigned DEFAULT '0' COMMENT '是否需要邀请函',
  `price` varchar(255) DEFAULT NULL COMMENT '网站报价',
  `marketprice` varchar(255) DEFAULT NULL COMMENT '市场价',
  `feeinclude` longtext COMMENT '费用包含',
  `content` longtext COMMENT '内容介绍',
  `handlerange` varchar(255) DEFAULT NULL COMMENT '受理范围',
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `shownum` int(11) unsigned DEFAULT NULL,
  `areaid` varchar(255) DEFAULT NULL COMMENT '区域id',
  `nationid` varchar(255) DEFAULT NULL COMMENT '国家id',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `partday` varchar(255) DEFAULT NULL COMMENT '停留时间',
  `acceptday` varchar(255) DEFAULT NULL COMMENT '受理时间',
  `handlepeople` varchar(255) DEFAULT NULL COMMENT '受理人群',
  `belongconsulate` varchar(255) DEFAULT NULL COMMENT '所属领事管',
  `enternum` varchar(255) DEFAULT NULL COMMENT '入境次数',
  `specialtip` longtext COMMENT '特别提示',
  `bookingtip` longtext COMMENT '预定须知',
  `material1` longtext COMMENT '所需材料-在职人员',
  `material2` longtext COMMENT '自由职业',
  `material3` longtext COMMENT '退休人员',
  `material4` longtext COMMENT '学龄前儿童',
  `material5` longtext COMMENT '学生',
  `ishidden` int(1) DEFAULT '0',
  `satisfyscore` int(255) DEFAULT NULL,
  `bookcount` varchar(255) DEFAULT NULL,
  `jifenbook` int(11) DEFAULT NULL,
  `jifentprice` int(11) DEFAULT NULL,
  `jifencomment` int(11) DEFAULT NULL,
  `iconlist` varchar(255) DEFAULT NULL,
  `themelist` varchar(255) DEFAULT NULL,
  `supplierlist` varchar(255) DEFAULT NULL,
  `templet` varchar(255) DEFAULT NULL,
  `cityid` int(11) DEFAULT NULL,
  `material` longtext,
  `booknotice` longtext,
  `circuit` longtext COMMENT '办理流程',
  `friendtip` longtext COMMENT '温馨提示',
  `paytype` int(1) unsigned DEFAULT '0',
  `dingjin` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT '-1',
  `recommendnum` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_AID` (`aid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `sline_visa` */

insert  into `sline_visa`(`id`,`webid`,`aid`,`title`,`seotitle`,`sellpoint`,`keyword`,`description`,`tagword`,`litpic`,`visatype`,`handleday`,`validday`,`needinterview`,`needletter`,`price`,`marketprice`,`feeinclude`,`content`,`handlerange`,`addtime`,`modtime`,`shownum`,`areaid`,`nationid`,`displayorder`,`partday`,`acceptday`,`handlepeople`,`belongconsulate`,`enternum`,`specialtip`,`bookingtip`,`material1`,`material2`,`material3`,`material4`,`material5`,`ishidden`,`satisfyscore`,`bookcount`,`jifenbook`,`jifentprice`,`jifencomment`,`iconlist`,`themelist`,`supplierlist`,`templet`,`cityid`,`material`,`booknotice`,`circuit`,`friendtip`,`paytype`,`dingjin`,`number`,`recommendnum`) values (1,0,1,'新加坡旅游签证[北京领区]','办理新加坡旅游签证[北京领区]_代办新加坡旅游签证_费用_价格 ','','办理新加坡旅游签证','','','/uploads/2015/0910/176e08735a00fdb7c0feb376b7630003.jpg',6,'预计5个工作日为使馆受理的工作日','35天',1,1,'300','500',NULL,'<p>1. 具体材料清单和签证服务费请咨询客服；</p><p>2. 使馆的签证费和申请时间以申请时使领馆的相关规定为准；</p><p>3. 受理全国护照，外国人护照和港澳台护照；</p><p>4. 签证需至少提前2周预约(旺季需更早)，如需加急预约请咨询客服。</p><p><br/></p>','适用于短期出行旅游的申请人',1441793881,1442905519,1,'1','4',9999,'20','','','新加坡',NULL,NULL,NULL,NULL,'<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p><br/></p><p>​<br/></p>',0,95,'568',0,0,0,'1',NULL,NULL,'',1,'<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px;\">1.签证的有效期是从资料齐全进入使馆后开始起算，建议申请人离出行前15天办理签证。</span><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px;\">2.签证的停留期由入境新加坡时的入境官员进行现场签发，多为30天，但也有7天、14天、28天的情况,请您入境时注意务必留意入境章上签注允许停留的时间期限。</span><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px;\">3.所有签证资料的复印件一定要清晰，否则我司不予受理，敬请谅解！</span><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal;\"/><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal;\"/><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px;\">**特别提示**:两年内办理过新加坡签证的客人，请务必确认好自己已有的新加坡签证是否在有效期内，如在有效期内重新送签，使馆会拒签。由此导致的拒签，我司不负责任，不予退费。</span><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal;\"/><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal;\"/><br/></p>',NULL,'<p><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px;\">​收到护照之后，请务必核实一下您的签证信息（护照号、姓名、签证有效期、出生年月及使馆圆章和签名章等等），若有问题，在收到护照后1个工作日内与销售联系，过期概不负责。</span></p>',1,'',-1,0),(2,0,2,'英国商务签证[北京领区]','办理英国商务签证[北京领区]_代办新加坡旅游签证_费用_价格 ','','办理英国商务签证','','','/uploads/2015/0909/ca3dea63e14a45ba4a33da45c7df01c8.jpg',7,'预计5个工作日为使馆受理的工作日','365天',1,1,'500','600',NULL,'<p>1. 具体材料清单和签证服务费请咨询客服；</p><p>2. 使馆的签证费和申请时间以申请时使领馆的相关规定为准；</p><p>3. 受理全国护照，外国人护照和港澳台护照；</p><p>4. 签证需至少提前2周预约(旺季需更早)，如需加急预约请咨询客服。&nbsp;</p><p><br/></p>','适用于长期工作地为英国的申请人',1441795530,1441795714,4,'2','5',9999,'90天','','','英国领事馆',NULL,NULL,NULL,NULL,'<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>',0,99,'452',10,1,2,NULL,NULL,NULL,'',1,'<p>护照</p><p><br/></p><p>有效期超过6个月的因私护照（首页、尾页以及欧美国家签证页清晰的复印件）</p><p>照片</p><p><br/></p><p>1.2寸白底彩色近照3张.&nbsp;</p><p>2.照片尺寸要求35&amp;times;45mm.&nbsp;</p><p>3.请在照片背面用铅笔写上自己的姓名.</p><p>申请表</p><p><br/></p><p>填写完整的个人资料表。</p><p>车产证明</p><p><br/></p><p>机动车所有权证或行驶证复印件。（可选）</p><p>房产证明</p><p><br/></p><p>房产证复印件（可选）</p><p>在职证明</p><p><br/></p><p>1.中文或英文在职证明一份.&nbsp;</p><p>2.使用公司正规抬头纸打印,加盖公司红章.</p><p>3.在职证明必须包括申请人姓名，护照号，具体职务，旅行时间、费用由谁承担，申请人入职时间，并保证按期回国，在职证明部门电话，在职证明部门名称和联系人，出具在职证明具体时间（年月日）.</p><p>4.如无法提供&quot;在职证明&quot;,请提供公司空白抬头纸4张,并加盖公司红章.</p><p>5.使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>户口本</p><p><br/></p><p>全家户口本整本的清晰的复印件（包括迁出、注销页），若配偶及子女不在同一户口本，请一同提供配偶及子女户口本整本复印件。</p><p>身份证</p><p><br/></p><p>身份证正反面的清晰的复印件。</p><p>​</p><p><br/></p>','<p>1.签证的有效期是从资料齐全进入使馆后开始起算，建议申请人离出行前15天办理签证。</p><p>2.签证的停留期由入境新加坡时的入境官员进行现场签发，多为30天，但也有7天、14天、28天的情况,请您入境时注意务必留意入境章上签注允许停留的时间期限。</p><p>3.所有签证资料的复印件一定要清晰，否则我司不予受理，敬请谅解！</p><p>​<br/></p>','','<p>​收到护照之后，请务必核实一下您的签证信息（护照号、姓名、签证有效期、出生年月及使馆圆章和签名章等等），若有问题，在收到护照后1个工作日内与销售联系，过期概不负责。</p>',1,'',-1,0),(3,0,3,'韩国旅游签证','韩国签证办理','','韩国签证,办理','','','/uploads/2015/0924/75e3b7da6c95b35c01782dd9541d6e7c.jpg',6,'预计15个工作日','30天',0,0,'300','500',NULL,'<p><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; widows: auto;\">1.&nbsp;具体材料清单和签证服务费请咨询客服；</span><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal; widows: auto;\"/><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; widows: auto;\">2.&nbsp;使馆的签证费和申请时间以申请时使领馆的相关规定为准；</span><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal; widows: auto;\"/><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; widows: auto;\">3.&nbsp;受理全国护照，外国人护照和港澳台护照；</span><br style=\"padding: 0px; margin: 0px; color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; white-space: normal; widows: auto;\"/><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px; widows: auto;\">4.&nbsp;签证需至少提前2周预约(旺季需更早)，如需加急预约请咨询客服</span></p>','适用于短期到韩国出行旅游的申请人',1443065590,1443066609,0,'1','6',9999,'20天','','','韩国领事馆',NULL,NULL,NULL,NULL,NULL,'<p>*个人信息表 (原件)</p><p>•真实完整填写（出行时间真实，填写的联系电话需保持畅通），并由本人中文签字</p><p>身份证明</p><p>*户口本 (复印件)</p><p>•①申请人本人整本户口本信息 ②如是集体户口，提供集体户口首页和本人页 ③如丢失，请开户派出所出具的户籍证明</p><p>*身份证 (原件)</p><p>•身份证原件，16周岁以下如没有，可无需提供</p><p>•暂不接受临时身份证</p><p>•自送签后至少还有1个月有效期</p><p>*退休证明 (复印件)</p><p>•①提供退休证或退休证明 ②内容涵盖申请人姓名、退休日期、退休单位名称</p><p>*因私护照 (原件)</p><p>•护照完整无破损、无水渍</p><p>•有效期离出发日期应至少还有6个月</p><p>•至少有两页完整连续的空白页，不包含备注页</p><p>*照片 (原件)</p><p>•近6个月内拍摄彩色照片2张，请在照片反面写上名字</p><p>•规格：35mmX45mm 长方形</p><p>•白色背景</p><p>资产证明</p><p>*工资卡或退休金或活期银行卡对账单 (原件)</p><p>•本人名下近1年交易记录的工资卡或储蓄卡对帐单（盖银行公章）</p><p>•摘要文字描述如有工资字样或每月固定时间段的收入为最佳</p><p>•最后一笔交易日期在送签日期前30天内</p><p>查看样图</p><p>*社保缴费证明 (原件)</p><p>•①本人社保卡正反面清晰复印件及查询密码 ②社保交纳凭证，登陆社保网上服务平台(仅限北京、天津缴纳社保的申请人，其他地区请咨询当地社保局)http://www.bjld.gov.cn/csibiz/home/提供上一年整年度至今（出行前连续12个月）本人社保记录明细（需包含个人信息页、养老、医疗三项）</p><p><br/></p>','<p>*个人信息表 (原件)</p><p>•真实完整填写（出行时间真实，填写的联系电话需保持畅通），并由本人中文签字</p><p>下载模板</p><p>身份证明</p><p>*出生证或出生医学证明 (复印件)</p><p>•内容涵盖申请人名字及父母信息</p><p>*户口本 (复印件)</p><p>•①申请人本人整本户口本信息 ②如是集体户口，提供集体户口首页和本人页 ③如丢失，请开户派出所出具的户籍证明</p><p>*身份证 (原件)</p><p>•身份证原件，16周岁以下如没有，可无需提供</p><p>•暂不接受临时身份证</p><p>•自送签后至少还有1个月有效期</p><p>*学生证 (复印件)</p><p>•还在有效期内的学生证或学籍卡； 升学阶段，可提供毕业证书或录取通知书，同时提供情况说明并签字</p><p>*因私护照 (原件)</p><p>•护照完整无破损、无水渍</p><p>•有效期离出发日期应至少还有6个月</p><p>•至少有两页完整连续的空白页，不包含备注页</p><p>*照片 (原件)</p><p>•近6个月内拍摄彩色照片2张，请在照片反面写上名字</p><p>•规格：35mmX45mm 长方形</p><p>•白色背景</p><p>*中文在校证明 (原件)</p><p>•①使用学校抬头纸打印，盖学校公章，班主任或学校领导签字 ②内容需包括：学校名称，地址和电话，学生所学专业或所在班级，学校假期时间，班主任或学校领导名字及职务</p><p>生活证明</p><p>*在线学籍或学历证明 (原件)</p><p>•①在校大学生提供； ②下载流程：登陆学信网（http://www.chsi.com.cn/，需支付2元短信查询费）</p><p><br/></p>','<p><br/></p><p>*个人信息表 (原件)</p><p>•真实完整填写（出行时间真实，填写的联系电话需保持畅通），并由本人中文签字</p><p>身份证明</p><p>*出生证或出生医学证明 (复印件)</p><p>•内容涵盖申请人名字及父母信息</p><p>*户口本 (复印件)</p><p>•①申请人本人整本户口本信息 ②如是集体户口，提供集体户口首页和本人页 ③如丢失，请开户派出所出具的户籍证明</p><p>*身份证 (原件)</p><p>•身份证原件，16周岁以下如没有，可无需提供</p><p>•暂不接受临时身份证</p><p>•自送签后至少还有1个月有效期</p><p>*因私护照 (原件)</p><p>•护照完整无破损、无水渍</p><p>•有效期离出发日期应至少还有6个月</p><p>•至少有两页完整连续的空白页，不包含备注页</p><p>*照片 (原件)</p><p>•近6个月内拍摄彩色照片2张，请在照片反面写上名字</p><p>•规格：35mmX45mm 长方形</p><p>•白色背景</p><p>​<br/></p>',0,98,'2003',10,1,2,NULL,NULL,NULL,'',1,'<p>*个人信息表 (原件)</p><p>•真实完整填写（出行时间真实，填写的联系电话需保持畅通），并由本人中文签字</p><p>身份证明</p><p>*户口本 (复印件)</p><p>•①申请人本人整本户口本信息 ②如是集体户口，提供集体户口首页和本人页 ③如丢失，请开户派出所出具的户籍证明</p><p>*身份证 (原件)</p><p>•身份证原件，16周岁以下如没有，可无需提供</p><p>•暂不接受临时身份证</p><p>•自送签后至少还有1个月有效期</p><p>*因私护照 (原件)</p><p>•护照完整无破损、无水渍</p><p>•有效期离出发日期应至少还有6个月</p><p>•至少有两页完整连续的空白页，不包含备注页</p><p>*照片 (原件)</p><p>•近6个月内拍摄彩色照片2张，请在照片反面写上名字</p><p>•规格：35mmX45mm 长方形</p><p>•白色背景</p><p>工作证明</p><p>*营业执照副本或组织机构代码证 (复印件)</p><p>•如申请人所在单位为企业单位,请提供营业执照副本的清晰复印件,用A4纸复印（需加盖公司红色印章）</p><p>•如申请人所在单位为事业单位,请提供组织机构代码证副本的清晰复印件,用A4纸复印（需加盖公司红色印章）</p><p>•新版营业执照，用A4纸复印,加盖公司红色公章</p><p>•营业执照与组织机构代码证任选其一提供即可</p><p>查看样图</p><p>*中文在职证明 (原件)</p><p>•①需用公司正规抬头纸打印，领导签字并加盖公章 ②内容包含： 申请人姓名、护照号、任职时间、职务及工资、公司同意其休假保留职位、旅行时间、费用由谁承担，公司名称、地址、开具在职证明的部门名称、电话、联系人及职务</p><p>•注意：使领馆可能会致电单位电话或本人手机，请提交资料后注意接听，如有未接或不属实情况，可能会造成拒签</p><p>下载模板</p><p>资产证明</p><p>*工资卡或退休金或活期银行卡对账单 (原件)</p><p>•本人名下近1年交易记录的工资卡或储蓄卡对帐单（盖银行公章）</p><p>•摘要文字描述如有工资字样或每月固定时间段的收入为最佳</p><p>•最后一笔交易日期在送签日期前30天内</p><p>查看样图</p><p>*社保缴费证明 (原件)</p><p>•①本人社保卡正反面清晰复印件及查询密码 ②社保交纳凭证，登陆社保网上服务平台(仅限北京、天津缴纳社保的申请人，其他地区请咨询当地社保局)http://www.bjld.gov.cn/csibiz/home/提供上一年整年度至今（出行前连续12个月）本人社保记录明细（需包含个人信息页、养老、医疗三项）</p><p><br/></p>','<p><br/></p><p>A. 签证属于特殊商品，我司会按使领馆的要求为客人准备最合适的送签材料，确保您的材料有最高出签可能，但所申请的签证是否成功，取决于使领馆对资料的审核，若发生拒签，请申请人自然接受结果，并放弃追究本公司任何责任的权利</p><p>B. 我司在收取申请人资料后，经二次审核发现不符合签证申请资格的，保留作出不予受理申请人签证申请决定的权利</p><p>C. 申请人需保证提供材料的真实性，有效性，如因隐瞒曾有不良记录，或从事非法活动，被相关部门查处或有滞留倾向拒签，我司不承担责任。请申请人特别注意诚实信用的原则</p><p>D. 获得签证前切勿先行支付机票、酒店费用，以免因签证问题产生费用损失，否则损失将由您自行承担；如您提供了机票、酒店预订单申请签证，请勿在获得签证前取消或修改预订，否则可能对签证结果产生影响&nbsp;</p><p>E. 如果您的护照在百程网办理过程中丢失，百程每本赔付1000元</p><p>F. 订单生效后如欲中途取消签证申请，则在百程旅行网已经将您的签证申请送交使领馆的情况下，您已经支付的订单款项将不予退还</p><p>G. 依据使馆要求，签证申请人在送签或归国后，如被使领馆要求参加面试或面试销签，签证申请人必须配合使领馆完成面试工作。如因个人原因未按时参加面试或面试销签，一切后果由签证申请人自行承担</p><p>重要提醒 ：在办理签证期间，护照持有人未在中华人民共和国境内(即不在中国大陆）或办理人所要办理的国家（地区）签证在有效期内、签证逾期未进行签证注销、没有出入境章（和出入境记录）的情形下，我公司一律不予办理，如遇此情况我们将提交有关部门处理，敬请见谅。</p><p><br/></p>',NULL,'<p><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑; font-size: 14px; line-height: 24px;\">​收到护照之后，请务必核实一下您的签证信息（护照号、姓名、签证有效期、出生年月及使馆圆章和签名章等等），若有问题，在收到护照后1个工作日内与销售联系，过期概不负责。</span></p>',1,'',-1,0);

/*Table structure for table `sline_visa_area` */

DROP TABLE IF EXISTS `sline_visa_area`;

CREATE TABLE `sline_visa_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `pid` int(4) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isopen` int(1) unsigned DEFAULT '1',
  `litpic` varchar(255) DEFAULT NULL COMMENT '国家封面图片',
  `bigpic` varchar(255) DEFAULT NULL COMMENT '国家栏目页顶部图片',
  `countrypic` varchar(255) DEFAULT NULL COMMENT '国家国旗',
  `jieshao` text COMMENT '国家介绍',
  `pinyin` varchar(255) DEFAULT NULL COMMENT '国家拼音',
  `seotitle` varchar(255) DEFAULT NULL COMMENT '优化标题',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `ishot` int(1) DEFAULT '0' COMMENT '是否热门',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `sline_visa_area` */

insert  into `sline_visa_area`(`id`,`webid`,`pid`,`kindname`,`displayorder`,`isopen`,`litpic`,`bigpic`,`countrypic`,`jieshao`,`pinyin`,`seotitle`,`keyword`,`description`,`ishot`) values (1,0,0,'亚洲',9999,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(2,0,0,'欧洲',9999,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(3,0,0,'美洲',9999,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(4,0,1,'新加坡',9999,1,'/uploads/main/allimg/20150925/20150925132538.jpg','','/uploads/main/allimg/20150910/20150910100445.jpg','<p>1.新加坡签证为另纸电子签证，为一张A4纸，出签后打印，随护照原件一同使用</p><p>2.签证有效期最长为2年，最短为35天，建议最早提前30天申请即可&nbsp;</p><p>3.该国移民官在入境时决定入境者停留天数</p><p>4.申请者入境时请留意护照上入境章及批准的停留期</p><p><br/></p>','xinjiapo','新加坡签证办理','','',1),(5,0,2,'英国',9999,1,'/uploads/main/allimg/20150911/20150911142141.jpg','/uploads/main/allimg/20150911/20150911142159.jpg','/uploads/main/allimg/20150909/20150909184030.jpg','<p>1.所有申请者需前往签证中心递交资料&nbsp;</p><p>2.申请短期个人旅游、探亲访友、商务均属于短期general visitor签证类别&nbsp;</p><p>3.在符合英国使馆规定的申请人可以在英国签证中心申请5个工作日的加急通道&nbsp;</p><p>4.如有必要，领馆有权要求申请人进一步提供其他材料，补充信息或进行面谈&nbsp;</p><p><br/></p>','yingguo','英国签证办理','','',0),(6,0,1,'韩国',9999,1,'/uploads/main/allimg/20150925/20150925132454.jpg','','/uploads/main/allimg/20150924/20150924111402.jpg','<p>1.所有申请者均需提供身份证原件（未成年人可由户口本原件代替）&nbsp;</p><p>2.请提供完好身份证原件，如因消磁或折损，使馆将无法读取信息&nbsp;</p><p>3.使馆不受理6个月内有韩国拒签记录的签证申请</p><p><br/></p>','hanguo','韩国签证办理','韩国签证','',1);

/*Table structure for table `sline_visa_booking` */

DROP TABLE IF EXISTS `sline_visa_booking`;

CREATE TABLE `sline_visa_booking` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT '0',
  `visaid` int(11) NOT NULL,
  `visaname` varchar(255) DEFAULT NULL COMMENT '酒店名称',
  `dingnum` varchar(100) DEFAULT NULL COMMENT '预订数量',
  `price` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL COMMENT '其它备注信息',
  `dingname` varchar(255) DEFAULT NULL,
  `dingtel` varchar(255) DEFAULT NULL COMMENT '预订联系人电话',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '处理时间',
  `status` int(1) unsigned DEFAULT NULL COMMENT '处理状态',
  `ordersn` varchar(255) DEFAULT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

/*Data for the table `sline_visa_booking` */

/*Table structure for table `sline_visa_city` */

DROP TABLE IF EXISTS `sline_visa_city`;

CREATE TABLE `sline_visa_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kindname` varchar(255) DEFAULT NULL COMMENT '签证类型',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isopen` int(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `sline_visa_city` */

/*Table structure for table `sline_visa_content` */

DROP TABLE IF EXISTS `sline_visa_content`;

CREATE TABLE `sline_visa_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '使用的字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL COMMENT '是否系统字段',
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isrealfield` int(1) unsigned DEFAULT '1' COMMENT '是否真实字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类表';

/*Data for the table `sline_visa_content` */

insert  into `sline_visa_content`(`id`,`webid`,`columnname`,`chinesename`,`displayorder`,`issystem`,`isopen`,`isrealfield`) values (1,0,'content','签证介绍',1,1,1,1),(2,0,'material','所需材料',2,1,1,0),(3,0,'booknotice','预订须知',3,1,1,1),(4,0,'circuit','办理流程',4,1,1,1),(5,0,'friendtip','温馨提示',5,1,1,1),(6,0,'tupian','图片',0,1,0,0);

/*Table structure for table `sline_visa_extend_field` */

DROP TABLE IF EXISTS `sline_visa_extend_field`;

CREATE TABLE `sline_visa_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='签证字段扩展表';

/*Data for the table `sline_visa_extend_field` */

/*Table structure for table `sline_visa_kind` */

DROP TABLE IF EXISTS `sline_visa_kind`;

CREATE TABLE `sline_visa_kind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kindname` varchar(255) DEFAULT NULL COMMENT '签证类型',
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isopen` int(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_KINDNAME` (`kindname`) USING BTREE,
  KEY `IDX_DISPLAYORDER_KINDNAME` (`displayorder`,`kindname`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `sline_visa_kind` */

insert  into `sline_visa_kind`(`id`,`kindname`,`displayorder`,`isopen`) values (6,'旅游签证',2,1),(7,'商务签证',9999,1),(8,'留学签证',9999,1),(9,'探亲签证',9999,1);

/*Table structure for table `sline_weblist` */

DROP TABLE IF EXISTS `sline_weblist`;

CREATE TABLE `sline_weblist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webname` varchar(255) DEFAULT NULL COMMENT '网站名称',
  `weburl` varchar(255) DEFAULT NULL COMMENT '网站地址',
  `webid` int(11) DEFAULT NULL,
  `webroot` varchar(255) DEFAULT NULL,
  `webprefix` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_WEBID_WEBPREFIX` (`webid`,`webprefix`) USING BTREE,
  KEY `IDX_WEBID_WEBURL` (`webid`,`weburl`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='sline网站列表';

/*Data for the table `sline_weblist` */

insert  into `sline_weblist`(`id`,`webname`,`weburl`,`webid`,`webroot`,`webprefix`) values (1,'主站','http://stourwebcms.com',0,'stourwebcms','stourwebcms');

/*Table structure for table `sline_yqlj` */

DROP TABLE IF EXISTS `sline_yqlj`;

CREATE TABLE `sline_yqlj` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '1',
  `sitename` varchar(50) DEFAULT NULL COMMENT '网站名字',
  `siteurl` varchar(255) DEFAULT NULL COMMENT '链接地址',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `address` varchar(50) DEFAULT NULL COMMENT '显示栏目',
  `displayorder` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='友情链接';

/*Data for the table `sline_yqlj` */

/*Table structure for table `sline_search` */

DROP TABLE IF EXISTS `sline_search`;

/*!50001 DROP VIEW IF EXISTS `sline_search` */;
/*!50001 DROP TABLE IF EXISTS `sline_search` */;

/*!50001 CREATE TABLE  `sline_search`(
 `channelname` varchar(2) NOT NULL  default '' ,
 `webid` int(11) unsigned NULL ,
 `aid` int(11) unsigned NULL ,
 `typeid` bigint(20) NOT NULL  default '0' ,
 `title` text NULL ,
 `description` longtext NULL ,
 `litpic` longtext NULL ,
 `shownum` int(11) NULL ,
 `kindlist` varchar(255) NULL ,
 `attrid` varchar(255) NULL ,
 `headimgid` bigint(20) NULL ,
 `tid` int(11) NOT NULL  default '0' ,
 `ishidden` int(11) NULL 
)*/;

/*View structure for view sline_search */

/*!50001 DROP TABLE IF EXISTS `sline_search` */;
/*!50001 DROP VIEW IF EXISTS `sline_search` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sline_search` AS select '线路' AS `channelname`,`sline_line`.`webid` AS `webid`,`sline_line`.`aid` AS `aid`,1 AS `typeid`,`sline_line`.`title` AS `title`,`sline_line`.`features` AS `description`,`sline_line`.`litpic` AS `litpic`,`sline_line`.`shownum` AS `shownum`,`sline_line`.`kindlist` AS `kindlist`,`sline_line`.`attrid` AS `attrid`,0 AS `headimgid`,`sline_line`.`id` AS `tid`,`sline_line`.`ishidden` AS `ishidden` from `sline_line` union select '酒店' AS `酒店`,`sline_hotel`.`webid` AS `webid`,`sline_hotel`.`aid` AS `aid`,2 AS `2`,`sline_hotel`.`title` AS `title`,`sline_hotel`.`content` AS `content`,`sline_hotel`.`litpic` AS `litpic`,`sline_hotel`.`shownum` AS `shownum`,`sline_hotel`.`kindlist` AS `kindlist`,`sline_hotel`.`attrid` AS `attrid`,0 AS `0`,`sline_hotel`.`id` AS `id`,`sline_hotel`.`ishidden` AS `ishidden` from `sline_hotel` union select '车辆' AS `车辆`,`sline_car`.`webid` AS `webid`,`sline_car`.`aid` AS `aid`,3 AS `3`,`sline_car`.`title` AS `title`,`sline_car`.`content` AS `content`,`sline_car`.`litpic` AS `litpic`,`sline_car`.`shownum` AS `shownum`,`sline_car`.`kindlist` AS `kindlist`,`sline_car`.`attrid` AS `attrid`,0 AS `0`,`sline_car`.`id` AS `id`,`sline_car`.`ishidden` AS `ishidden` from `sline_car` union select '攻略' AS `攻略`,`sline_article`.`webid` AS `webid`,`sline_article`.`aid` AS `aid`,4 AS `4`,`sline_article`.`title` AS `title`,`sline_article`.`content` AS `content`,`sline_article`.`litpic` AS `litpic`,`sline_article`.`shownum` AS `shownum`,`sline_article`.`kindlist` AS `kindlist`,`sline_article`.`attrid` AS `attrid`,0 AS `0`,`sline_article`.`id` AS `id`,`sline_article`.`ishidden` AS `ishidden` from `sline_article` union select '景点' AS `景点`,`sline_spot`.`webid` AS `webid`,`sline_spot`.`aid` AS `aid`,5 AS `5`,`sline_spot`.`title` AS `title`,`sline_spot`.`content` AS `content`,`sline_spot`.`litpic` AS `litpic`,`sline_spot`.`shownum` AS `shownum`,`sline_spot`.`kindlist` AS `kindlist`,`sline_spot`.`attrid` AS `attrid`,0 AS `0`,`sline_spot`.`id` AS `id`,`sline_spot`.`ishidden` AS `ishidden` from `sline_spot` union select '相册' AS `相册`,`sline_photo`.`webid` AS `webid`,`sline_photo`.`aid` AS `aid`,6 AS `6`,`sline_photo`.`title` AS `title`,`sline_photo`.`content` AS `content`,`sline_photo`.`litpic` AS `litpic`,`sline_photo`.`shownum` AS `shownum`,`sline_photo`.`kindlist` AS `kindlist`,`sline_photo`.`attrid` AS `attrid`,`sline_photo`.`headimgid` AS `headimgid`,`sline_photo`.`id` AS `id`,`sline_photo`.`ishidden` AS `ishidden` from `sline_photo` union select '签证' AS `签证`,`sline_visa`.`webid` AS `webid`,`sline_visa`.`aid` AS `aid`,8 AS `8`,`sline_visa`.`title` AS `title`,`sline_visa`.`content` AS `content`,`sline_visa`.`litpic` AS `litpic`,`sline_visa`.`shownum` AS `shownum`,'' AS ``,'' AS ``,0 AS `0`,`sline_visa`.`id` AS `id`,`sline_visa`.`ishidden` AS `ishidden` from `sline_visa` union select '团购' AS `团购`,`sline_tuan`.`webid` AS `webid`,`sline_tuan`.`aid` AS `aid`,13 AS `13`,`sline_tuan`.`title` AS `title`,`sline_tuan`.`content` AS `content`,`sline_tuan`.`litpic` AS `litpic`,`sline_tuan`.`shownum` AS `shownum`,`sline_tuan`.`kindlist` AS `kindlist`,`sline_tuan`.`attrid` AS `attrid`,0 AS `0`,`sline_tuan`.`id` AS `id`,`sline_tuan`.`ishidden` AS `ishidden` from `sline_tuan` */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
