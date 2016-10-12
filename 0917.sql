CREATE DATABASE  IF NOT EXISTS `homestead` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `homestead`;
-- MySQL dump 10.13  Distrib 5.6.17, for osx10.6 (i386)
--
-- Host: localhost    Database: homestead
-- ------------------------------------------------------
-- Server version	5.7.14

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `username` varchar(166) NOT NULL,
  `password` varchar(362) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(45) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES ('admin','admin','2016-08-01 21:20:39','管理员',1,NULL),('saler','saler','2016-08-01 21:52:26','销售人员',2,'2016-09-17 00:47:27'),('pm','123','2016-08-01 21:52:37','项目经理',3,'2016-09-02 00:45:33'),('designer','123','2016-08-01 21:52:48','设计师',4,'2016-09-02 00:45:48'),('xiangmujingli','123','2016-09-01 04:39:50','产品经理',10,'2016-09-01 04:39:50'),('ssssssss','sss','2016-09-01 04:40:46','产品经理',13,'2016-09-01 04:40:46'),('sssssssssssssss','sss','2016-09-01 04:41:50','产品经理',15,'2016-09-01 04:41:50');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_basic`
--

DROP TABLE IF EXISTS `customer_basic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_basic` (
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(415) NOT NULL,
  `company` varchar(145) NOT NULL,
  `phone` varchar(425) DEFAULT NULL,
  `description` varchar(445) DEFAULT NULL,
  `source` varchar(345) DEFAULT NULL,
  `principal` varchar(345) DEFAULT NULL,
  `status` varchar(345) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_basic`
--

LOCK TABLES `customer_basic` WRITE;
/*!40000 ALTER TABLE `customer_basic` DISABLE KEYS */;
INSERT INTO `customer_basic` VALUES ('2016-08-02 01:13:01','2016-09-02 13:44:45',1,'nex','自由','110','修改样式\n                            ','事实上收拾收拾是','saler','未联系',0),('2016-08-02 01:13:03','2016-08-25 18:39:06',2,'powman','唯品会','13683462564','测试\n换行\n换行\n换行','s','saaaa','未联系',2),('2016-08-02 05:29:12','2016-08-20 14:25:54',3,'aaa','途牛','12345678910','一二三四五六七','s','saaaa','未联系',1),('2016-08-05 04:35:58','2016-08-05 04:35:58',5,'saler','哇哈哈','18990183890','是一家饮料公司','线下','saler','沟通中',2),('2016-08-10 14:41:01','2016-08-10 14:41:01',14,'啊啊是说','','','','小传单','saler','未联系',2),('2016-08-25 21:39:42','2016-08-25 21:39:42',24,'','','','','事实上','saler','未联系',2),('2016-09-01 03:55:18','2016-09-01 03:55:39',29,'最后两次测试','最后两次测试','110','最后两次测试最后两次测试\n最后两次测试最后两次测试\n最后两次测试最后两次测试','线下','saaaa','未联系',2),('2016-09-01 04:00:05','2016-09-01 04:00:05',32,'客户名称','光明','110','介绍','','saaaa','未联系',1),('2016-09-01 04:01:38','2016-09-01 04:01:38',33,'藤原拓海','二二二','222','厄尔厄尔厄尔厄尔','事实上','saler','沟通中',1),('2016-09-01 04:02:53','2016-09-01 04:02:53',34,'路劲','屁屁哦','233','批交批结骷髅精灵;接口','other','saaaa','沟通中',1),('2016-09-01 04:03:23','2016-09-01 04:03:23',35,'撒旦法撒旦法','地方都是','23423','地方撒旦法撒旦法水电费水电费吊死扶伤东方时代','事实上','saaaa','未联系',1),('2016-09-01 04:30:17','2016-09-01 04:30:17',44,'偶尔我日老司机废了','时代封俊了','上飞机了','SD 浪费精力老司机废了','小传单','saaaa','未联系',1),('2016-09-01 04:30:54','2016-09-01 04:30:54',45,'手段','是否','水电费','水电费水电费','小传单','saaaa','未联系',1),('2016-09-01 04:31:14','2016-09-01 04:31:14',46,'双方的水电费','水电费地方','水电费水电费','水电费水电费','啊啊啊啊','saler','未联系',1);
/*!40000 ALTER TABLE `customer_basic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_list_filter`
--

DROP TABLE IF EXISTS `customer_list_filter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_list_filter` (
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `filter` varchar(45) DEFAULT NULL,
  `value` varchar(45) DEFAULT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_list_filter`
--

LOCK TABLES `customer_list_filter` WRITE;
/*!40000 ALTER TABLE `customer_list_filter` DISABLE KEYS */;
INSERT INTO `customer_list_filter` VALUES ('2016-08-12 10:56:59','2016-09-03 10:22:39','all','',1);
/*!40000 ALTER TABLE `customer_list_filter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_log`
--

DROP TABLE IF EXISTS `customer_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer_log` (
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `content` varchar(445) DEFAULT NULL,
  `submitter` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_log`
--

LOCK TABLES `customer_log` WRITE;
/*!40000 ALTER TABLE `customer_log` DISABLE KEYS */;
INSERT INTO `customer_log` VALUES ('2016-08-09 20:30:32','2016-08-09 20:30:32',24,3,'啧啧啧啧啧在','admin'),('2016-09-02 01:54:10','2016-09-02 01:54:10',27,5,'saler添加 log','saler'),('2016-09-02 02:09:44','2016-09-03 05:14:18',31,1,'活该自己天天改 bug\n','admin'),('2016-09-02 05:15:36','2016-09-02 05:15:36',32,1,'有 bug?','admin'),('2016-09-02 05:25:15','2016-09-02 05:25:15',33,1,'存储','admin'),('2016-09-02 05:25:39','2016-09-02 05:25:39',34,1,'赛事','admin'),('2016-09-02 05:26:17','2016-09-02 05:26:17',35,1,'ss','admin'),('2016-09-02 05:26:25','2016-09-02 05:26:25',36,1,'可以了','admin'),('2016-09-02 05:26:56','2016-09-02 05:26:56',37,1,'可以了','admin'),('2016-09-02 05:27:30','2016-09-02 05:27:30',38,1,'沙沙','admin'),('2016-09-02 05:30:46','2016-09-02 05:30:46',39,1,'谢谢','admin');
/*!40000 ALTER TABLE `customer_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `url` varchar(145) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `stage` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(45) DEFAULT NULL,
  `name` varchar(145) DEFAULT NULL,
  `area` float DEFAULT NULL,
  `address` varchar(545) DEFAULT NULL,
  `meal_type` varchar(145) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `quote` float DEFAULT NULL,
  `stage` varchar(145) DEFAULT NULL,
  `saler_id` int(11) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `pm_name` varchar(45) DEFAULT NULL,
  `completion_time` varchar(145) DEFAULT NULL,
  `houseSituation` varchar(945) DEFAULT NULL,
  `houseType` varchar(45) DEFAULT NULL,
  `workforce` int(11) DEFAULT NULL,
  `requirements` varchar(1145) DEFAULT NULL,
  `designer_id` int(11) DEFAULT NULL,
  `designer_name` varchar(45) DEFAULT NULL,
  `budget` float DEFAULT NULL,
  `saler_name` varchar(45) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ownclound` varchar(445) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `profit` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES ('2016-08-02 19:59:33','2016-09-17 00:40:29',1,1,'啊啊是说','啊啊啊啊',55,'江油市五建司','标准',2,600,'合同',2,3,'pm','2016-08-26','房屋','商铺',222,'保存成功保存成功保存\n成功保存成功保存成功\n保存成功保存成功保存\n小王八羔子',4,'designer',30000.5,'saler',0,'http://www.house.com',22.59,55.59),('2016-08-02 19:59:37','2016-08-09 20:36:15',2,1,'powman','嘎嘎嘎',2,NULL,'标准',NULL,NULL,'平图',NULL,NULL,NULL,'2015年10月20日',NULL,'自建房',22,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL),('2016-08-02 19:59:42',NULL,3,1,'aaa','啧啧啧',2,NULL,'标准',NULL,NULL,'沟通',NULL,NULL,NULL,NULL,NULL,'自建房',44,NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL),('2016-08-09 11:08:27','2016-08-09 23:23:28',4,NULL,'nex','测试',2,'','标准',2,0,'沟通',NULL,NULL,'pm','','','商铺',0,'                    \n                        \n                        ',NULL,'designer',0,'saler',NULL,NULL,NULL,NULL),('2016-08-09 13:46:53','2016-08-09 13:46:53',5,NULL,'','adsfsdfsdfsfdfsf',2,'','标准',2,0,'沟通',NULL,NULL,'pm','','','商铺',0,'                    ',NULL,'designer',0,'saler',NULL,NULL,NULL,NULL),('2016-08-09 20:12:20','2016-08-09 23:23:45',6,NULL,'nex','项目哈哈',2,'江油市中坝镇','标准',2,0,'沟通',NULL,NULL,'pm','','','商铺',0,'                    \n                        \n                        ',NULL,'designer',0,'saler',NULL,NULL,NULL,NULL),('2016-08-09 20:46:57','2016-08-09 20:47:21',7,NULL,'powman','分',2,'','标准',2,0,'见面/量房',NULL,NULL,'pm','','','商铺',0,'                    ',NULL,'designer',0,'saler',NULL,NULL,NULL,NULL),('2016-08-09 23:01:41','2016-08-09 23:01:41',8,NULL,'nex','项目销售创建',2,'','标准',2,0,'沟通',NULL,NULL,'pm','','','商铺',0,'                    ',NULL,'designer',0,'saler',NULL,NULL,NULL,NULL),('2016-08-26 00:05:59','2016-08-26 00:05:59',27,NULL,'nex','时间测试',0,'','标准',2,0,'沟通',NULL,NULL,'pm','2016-08-27','','商铺',0,'                    ',NULL,'designer',0,'saler',0,NULL,NULL,NULL),('2016-09-01 05:19:27','2016-09-01 05:19:27',28,NULL,'客户名称','测试一次',2223,'江油市中坝镇','标准',2,33334,'平图',NULL,NULL,'pm','2016-09-30','测试一次测试一次测试一次测试一次测试一次\n测试一次测试一次测试一次测试一次测试一次\n测试一次测试一次测试一次测试一次测试一次','写字楼',2222,'测试一次测试一次测试一次\n测试一次测试一次测试一次\n测试一次测试一次测试一次',NULL,'designer',3333,'saler',1,NULL,NULL,NULL),('2016-09-02 01:06:14','2016-09-02 01:06:14',29,NULL,'powman','哈哈还沙沙事实上',0,'江油市中坝镇','非标准',2,2222,'见面/量房',NULL,NULL,'pm','2016-09-30','收拾收拾是','写字楼',22,'啧啧啧啧啧在真真正正',NULL,'designer',2222,'saler',1,NULL,NULL,NULL),('2016-09-17 00:48:38','2016-09-17 00:48:38',30,NULL,'手段','销售创建',22,'销售创建','非标准',0,22,'沟通',NULL,NULL,'pm','2016-9-13','销售创建\n销售创建\n销售创建','商住两用',22,'销售创建销售创建',NULL,'designer',22,'saler',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_log`
--

DROP TABLE IF EXISTS `project_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_log` (
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `content` varchar(444) DEFAULT NULL,
  `submitter` varchar(45) DEFAULT NULL,
  `stage` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_log`
--

LOCK TABLES `project_log` WRITE;
/*!40000 ALTER TABLE `project_log` DISABLE KEYS */;
INSERT INTO `project_log` VALUES ('2016-08-09 08:26:17',NULL,2,1,'哈哈','powman','见面/量房'),('2016-08-09 08:26:19',NULL,3,2,NULL,NULL,NULL),('2016-08-09 08:26:24',NULL,4,2,NULL,NULL,NULL),('2016-08-09 08:27:16',NULL,5,1,'打啊','nex','平图'),('2016-08-09 18:11:43','2016-08-09 18:11:43',6,1,'平图的log','admin','平图'),('2016-08-09 18:15:26','2016-08-09 18:15:26',10,1,'这是合同的 log','admin','合同'),('2016-08-09 20:34:33','2016-08-09 20:34:33',11,2,'沟通中呢','admin','沟通'),('2016-08-09 20:35:31','2016-08-09 20:35:31',12,2,'见面中','admin','见面/量房'),('2016-08-09 20:47:29','2016-08-09 20:47:29',14,7,'sdfasdf','admin','沟通'),('2016-08-13 11:25:34','2016-08-13 11:25:34',19,1,'da','pm','沟通'),('2016-08-25 14:22:16','2016-08-25 14:22:16',23,1,'可以换行\n可以换行\n可以换行\n','admin','合同'),('2016-08-25 14:22:56','2016-08-25 14:22:56',24,1,'可以换行\n可以换行\n可以换行\n可以换行\n','admin','开工'),('2016-08-25 14:25:40','2016-09-02 00:51:43',27,1,'啧啧啧','pm','打款'),('2016-08-25 19:01:36','2016-08-25 19:01:36',28,1,'换行的工作\n换行的工作\n换行的工作\n换行的工作','admin','沟通'),('2016-08-25 19:10:28','2016-08-25 19:10:28',30,1,'http://www.baidu.com','admin','设计图'),('2016-09-01 08:55:21','2016-09-02 01:20:56',33,1,'沟通,删除了之后依然没有问题','admin','沟通'),('2016-09-01 08:56:30','2016-09-01 08:56:30',35,1,'为什么只有 admin 提交记录','admin','设计图'),('2016-09-01 08:57:10','2016-09-02 01:04:04',36,1,'只是PM是啊','pm','开工'),('2016-09-01 21:16:07','2016-09-02 01:18:44',41,1,'测试哈哈Designer','designer','设计'),('2016-09-01 21:17:08','2016-09-02 01:12:10',42,1,'测试设计人员修改的','designer','设计'),('2016-09-01 21:20:03','2016-09-17 01:56:43',44,1,'cool','admin','报价'),('2016-09-02 00:58:26','2016-09-02 00:58:26',55,1,'PM','pm','报价'),('2016-09-16 23:09:17','2016-09-16 23:09:17',56,1,'fuckDan','admin','沟通'),('2016-09-17 01:58:33','2016-09-17 01:58:33',57,1,'测试','admin','沟通'),('2016-09-17 02:03:24','2016-09-17 02:04:10',58,1,'cool测试','admin','日报');
/*!40000 ALTER TABLE `project_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timestamps`
--

DROP TABLE IF EXISTS `timestamps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `timestamps` (
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timestamps`
--

LOCK TABLES `timestamps` WRITE;
/*!40000 ALTER TABLE `timestamps` DISABLE KEYS */;
/*!40000 ALTER TABLE `timestamps` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-17 21:37:27
