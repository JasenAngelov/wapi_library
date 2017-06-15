CREATE DATABASE  IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `library`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: library
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

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
-- Table structure for table `autors`
--

DROP TABLE IF EXISTS `autors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autors` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `F_name` varchar(45) NOT NULL,
  `L_name` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autors`
--

LOCK TABLES `autors` WRITE;
/*!40000 ALTER TABLE `autors` DISABLE KEYS */;
INSERT INTO `autors` VALUES (1,'Charles','Dickens'),(2,'Jack','London'),(3,'Ivan','MArkov');
/*!40000 ALTER TABLE `autors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `ISBN` int(13) NOT NULL,
  `Book_Title` varchar(45) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Published` date NOT NULL,
  `Cover_url` varchar(60) NOT NULL,
  `Book_url` varchar(60) NOT NULL,
  `Pages` int(11) NOT NULL,
  `Autor_Id` int(11) NOT NULL,
  `Uploader_Id` int(11) NOT NULL,
  PRIMARY KEY (`ISBN`),
  UNIQUE KEY `Id_UNIQUE` (`ISBN`),
  UNIQUE KEY `Book_url_UNIQUE` (`Book_url`),
  UNIQUE KEY `Cover_url_UNIQUE` (`Cover_url`),
  KEY `fk_Books_Autors_idx` (`Autor_Id`),
  KEY `fk_Books_Users1_idx` (`Uploader_Id`),
  CONSTRAINT `fk_Books_Autors` FOREIGN KEY (`Autor_Id`) REFERENCES `autors` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Books_Users1` FOREIGN KEY (`Uploader_Id`) REFERENCES `users` (`Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1234235365,'The Sea-Wolf','assadasd','1903-01-01','/user_pics/seawolf.jpg','https://www.helikon.bg/books/11/-%D0%94%D0%B8%D0%B2%D0%BE%D1',128,2,1),(1853260045,'The Great Expectations','asdasdasdasdasd','1861-07-01','/user_pics/greatexpx.jpg','https://en.wikipedia.org/w/index.php?title=Special:Book&book',544,1,1),(2114748388,'The Reminders ','Perfect for fans of J. Courtney Sullivan\'s The Engagement or Graeme Simpson\'s The Rosie Project, The Reminders follows what happens when a girl who can\'t forget befriends a man who\'s desperate to remember.','2013-01-01','/user_pics/HERECOMESTHESWIRL.jpg','asddasada',512,1,1),(2127483777,'Buy Buy Baby','asdasdaaa','2013-01-01','/user_pics/1welcometonightvale400.jpg','asdasdad',112,1,1),(2141234513,'The God delusions','asdasdasdasdasd','1913-01-01','/user_pics/The_God_Delusion_UK.jpg','asdasdasd',122,2,1),(2142483999,'Call','asdddddddddd','2013-01-01','/user_pics/art_bookcover.png','asdasd',256,1,1),(2147483647,'The call of the wild','asdasdasdasdasdasdasd','1913-01-01','/user_pics/The_Call_of_the_Wild.jpg','https://en.wikipedia.org/wiki/The_Sea-Wol1f',365,2,1);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `F_name` varchar(45) NOT NULL,
  `L_name` varchar(45) NOT NULL,
  `Email` varchar(80) NOT NULL,
  `Pass` varchar(80) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Id_UNIQUE` (`Id`),
  UNIQUE KEY `Email_UNIQUE` (`Email`),
  UNIQUE KEY `Pass_UNIQUE` (`Pass`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jhon','Atanasov','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','$2y$10$CVWC/3AG3ylNoSedGbvatuDnY94pyXHP9X/ZjjwSU8ENm/D22HRCO');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'library'
--

--
-- Dumping routines for database 'library'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-15 22:25:45
