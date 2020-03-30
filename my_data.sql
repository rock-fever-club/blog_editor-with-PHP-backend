-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: blog_admin
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-0ubuntu0.19.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Blogs`
--

DROP TABLE IF EXISTS `Blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Blogs` (
  `body` varchar(255) NOT NULL,
  `thumb` varchar(70) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `comments` int(11) DEFAULT NULL,
  `likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Blogs`
--

LOCK TABLES `Blogs` WRITE;
/*!40000 ALTER TABLE `Blogs` DISABLE KEYS */;
INSERT INTO `Blogs` VALUES ('./blogs/blog_.html','./blogs/blog__thumb.txt','Eminem','2020/03/29',5,6),('./blogs/blog_1.html','./blogs/blog_1_thumb.txt','Value Of The Time You Have Will Not Last Forever','2020/03/30',1,2),('./blogs/blog_2.html','./blogs/blog_2_thumb.txt','How It Works: Automatic transmissions','2020/03/30',1,1);
/*!40000 ALTER TABLE `Blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('amit','Rawat');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_0_comments`
--

DROP TABLE IF EXISTS `blog_0_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_0_comments` (
  `body` varchar(255) NOT NULL,
  `email` varchar(70) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_0_comments`
--

LOCK TABLES `blog_0_comments` WRITE;
/*!40000 ALTER TABLE `blog_0_comments` DISABLE KEYS */;
INSERT INTO `blog_0_comments` VALUES ('test comment','ab@example.com','amit','2020/03/30'),('test2 Comment','amitsrawat2000@gmail.com','amit','2020/03/30'),('test3 comment','amitssrawat2000@gmail.com','amit','2020/03/30'),('test4 comment','amitsrawat2000@gmail.com','amit','2020/03/30'),('hola test5','amitssrawat2000@gmail.com','ami','2020/03/30');
/*!40000 ALTER TABLE `blog_0_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_1_comments`
--

DROP TABLE IF EXISTS `blog_1_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_1_comments` (
  `body` varchar(255) NOT NULL,
  `email` varchar(70) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_1_comments`
--

LOCK TABLES `blog_1_comments` WRITE;
/*!40000 ALTER TABLE `blog_1_comments` DISABLE KEYS */;
INSERT INTO `blog_1_comments` VALUES ('Its just a test comment!','amitssrawat2000@gmail.com','amit','2020/03/30');
/*!40000 ALTER TABLE `blog_1_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog_2_comments`
--

DROP TABLE IF EXISTS `blog_2_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog_2_comments` (
  `body` varchar(255) NOT NULL,
  `email` varchar(70) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog_2_comments`
--

LOCK TABLES `blog_2_comments` WRITE;
/*!40000 ALTER TABLE `blog_2_comments` DISABLE KEYS */;
INSERT INTO `blog_2_comments` VALUES ('Test1 comment','amitsssrawat2000@gmail.com','RF','2020/03/30');
/*!40000 ALTER TABLE `blog_2_comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-30 17:58:41
