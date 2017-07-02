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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autors`
--

LOCK TABLES `autors` WRITE;
/*!40000 ALTER TABLE `autors` DISABLE KEYS */;
INSERT INTO `autors` VALUES (1,'Charles','Dickens'),(2,'Jack','London'),(3,'Ivan','MArkov'),(4,'Aaaa','ddddd'),(5,'Jhon','Keyhoe'),(6,'Jasen','Angelov'),(7,'Ivan','Markov'),(8,'God','The'),(10,'Jhon','Atanasov'),(11,'aaaaa','aaaaa'),(12,'Jasen','Borkov'),(13,'Kite','Milic'),(14,'James','Franko');
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
  `Cover_url` varchar(160) NOT NULL,
  `Book_url` varchar(160) NOT NULL,
  `Pages` int(11) NOT NULL,
  `Autor_Id` int(11) NOT NULL,
  `Uploader_Id` int(11) NOT NULL,
  PRIMARY KEY (`ISBN`),
  UNIQUE KEY `Id_UNIQUE` (`ISBN`),
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
INSERT INTO `books` VALUES (1231231111,'Biografia','Mi da','1988-01-10','./assets/images/user_pics/142b9cfa12f57eed77f45be2ef6bf7ad07f755d1.jpg','./assets/books/d855c76cf0619786bb612cca96fa44f7b9e23c4f.pdf',156,13,1),(1231231231,'Biografia','Mi da','1988-01-10','./assets/images/user_pics/142b9cfa12f57eed77f45be2ef6bf7ad07f755d1.jpg','./assets/books/d855c76cf0619786bb612cca96fa44f7b9e23c4f.pdf',156,13,1),(1233211222,'The devil','asdadfdaf','0000-00-00','./assets/images/user_pics/0b5ad617512a71034817b8818792a9d6bfdf9cd5.jpg','./assets/books/678b0aca2419fc7e314508302c500a0f88fc15fd.pdf',875,14,1),(1233211231,'The devil','asdadfdaf','0000-00-00','./assets/images/user_pics/0b5ad617512a71034817b8818792a9d6bfdf9cd5.jpg','./assets/books/678b0aca2419fc7e314508302c500a0f88fc15fd.pdf',875,14,1),(1478982333,'Bohemi','Mi da','1988-01-10','./assets/images/user_pics/d8607c80e1f0d47c985afd3c45017a0850aa30d3.jpg','./assets/books/c91752ef9f9e5fbcec3b6346256304ce7e20ad0c.pdf',225,13,1),(1478982581,'Bohemi','Mi da','1988-01-10','./assets/images/user_pics/d8607c80e1f0d47c985afd3c45017a0850aa30d3.jpg','./assets/books/c91752ef9f9e5fbcec3b6346256304ce7e20ad0c.pdf',225,13,1),(1515154112,'Trimata musketari','asdsdfsdfgshg','1802-01-01','./assets/images/user_pics/50774eeef4546f824ee3051c01ea81b031088c60.jpg','./assets/books/2b29a32f97d205d03a30ca1a9530a7b8e4f7d385.pdf',2456,6,1),(1515154444,'Trimata musketari','asdsdfsdfgshg','1802-01-01','./assets/images/user_pics/50774eeef4546f824ee3051c01ea81b031088c60.jpg','./assets/books/2b29a32f97d205d03a30ca1a9530a7b8e4f7d385.pdf',2456,6,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Jhon','Atanasov','a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3','$2y$10$CVWC/3AG3ylNoSedGbvatuDnY94pyXHP9X/ZjjwSU8ENm/D22HRCO'),(2,'Jasen','Angelov','f016f4cd18ff51c04b968e187e42d7bc205e4cbaa812e4241e2c148eeb4cc464','$2y$10$PaEa8qopwbLGOHZ1sZSeveJFQTWMlXmavBTgiTdxGDyxiCOGzVL9G');
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

-- Dump completed on 2017-07-02 12:39:26
