-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: phone_book
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (12,'Руслан','Юсупов','89068512201','yrm.10111990@gmail.com','instagram.png',1),(25,'Руслан','Юсупов','123123123123','yrm.10111990@gmail.com','instagram.png',12);
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `hash` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` varchar(1024) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (46,12,'9332b0e25db2ee08522feac2caff43502b204817a1ab45e7d3b3cc22d7e7e98b','238377059dd2fac69ba9cfbca5f32a97c735f387bfacafd0f454b29b7e6f9f00');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_uindex` (`email`),
  UNIQUE KEY `users_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'test','test@test.com','$2y$10$FsciKZLBc2.EMN26b9.feOeYpqb7mTOCNsYFf84DjtAzPUt/iQJSG'),(2,'tester','tester@test.com','$2y$10$f8V18wdNFTIqiLephT8UJ.XW9uYszjknU/vz0E8YWKvQueQ8Ryzba'),(3,'super','super@email.com','$2y$10$iRp2ZQdfRP1mqUkM9uw1vOjQnbMRdE5seaXTTqMdOdUvqrZG.X5dq'),(4,'user','user@mail.ru','$2y$10$HbLpv1fKeVy4vpRuTNBodOi9TqDDNRJ5zAF.g6ViErQeVnWDRYI9S'),(5,'tester1','tester1@test.com','$2y$10$baY6OT4XwplXnMv.UC3R3ek6Mo3sUdzrUtP9ZYNCh.NbzI0loetZi'),(6,'tester2','tester2@test.com','$2y$10$5iHyrpsVBwaadlbgbDrqcez2KKyVJEsU3tGHXUJgR.5ur0C/kA8xW'),(7,'super_tester','supertest@mail.com','$2y$10$nqzolSV/YDS64gh91mGlIOX1sjakvKGML54HvRyLoafjkD0n2qwIy'),(8,'tester3','tester3@test.com','$2y$10$V0oj3uqY8wt/mCKkhvJoGeFl5aBsFGBwwxXa5TIwFhAjqbWB6u.hO'),(9,'yusupov-r-m','yrm.10111990@gmail.com','$2y$10$/HoqWXutzitQ10OiFfyd0.FnGSY6juJTJMjIdBDMvvGCQmIJjcmE6'),(10,'tester123','wertwertwert@retrwert.ru','$2y$10$K2lf5Sp6vyWXjxGgySaJsuSUzTG38ezIPwwW9g4OhmdY5idHGkdAe'),(12,'tester12345','test12345@test.com','$2y$10$9QxO7S1kTU/TSTgVhXwPkegKKWOM/5/6ApfqMJEgAw382rJzsX4RO');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-05 21:06:18
