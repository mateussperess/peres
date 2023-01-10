CREATE DATABASE IF NOT EXISTS `bd-peres` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd-peres`;
-- MySQL dump 10.13 Distrib 5.7.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1 Database: bd-mocitec-manha-tarde
-- ------------------------------------------------------
-- Server version 5.5.5-10.4.24-MariaDB

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
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addresses` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`street` varchar(45) NOT NULL,
`number` varchar(45) NOT NULL,
`complement` varchar(45) NOT NULL,
`city` varchar(45) NOT NULL,
`state` varchar(45) NOT NULL,
`zipCode` varchar(45) NOT NULL,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
`udated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addresses`
--

LOCK TABLES `addresses` WRITE;
/*!40000 ALTER TABLE `addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`type` varchar(255) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES 
                              (1, 'Apartamento'),
                              (2,'Casa'),
                              (3,'Terreno');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `properties` (
                            `id` int(11) NOT NULL AUTO_INCREMENT,
                            `title` varchar(255) NOT NULL,
                            `price` int(100) NOT NULL,
                            `image` varchar(64000) NOT NULL,
                            `description` varchar(255) NOT NULL,
                            `idCategory` int(11) NOT NULL,
                            `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
                            `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
                            PRIMARY KEY (`id`),
                            KEY `fk_properties_category1_idx` (`idCategory`),
                            CONSTRAINT `fk_properties_category1` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `properties`
--


LOCK TABLES `properties` WRITE;
/*!40000 ALTER TABLE `properties` DISABLE KEYS */;
INSERT INTO `properties` VALUES (13,'Apartamento', 250000,
                                                          'https://images.unsplash.com/photo-1604014237800-1c9102c219da?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
                                                              'Apto beira-mar', 1, '2022-08-09 20:02:16', NULL),
                                (14,'Casa', 400000, 
                                                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80',
                                                        'Casa de dois andares', 2, '2022-08-09 20:10:39', NULL),
                                (15,'Terreno',30000, 
                                                    'https://images.unsplash.com/photo-1604014238312-ccb88904fa7c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
                                                        'Terreno Baldio', 3, '2022-09-08 13:31:10', NULL);
/*!40000 ALTER TABLE `properties` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Table structure for table `create_propertie`
--

DROP TABLE IF EXISTS `create_propertie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `create_propertie` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `idCategory` int(11) NOT NULL,
                                  `idUser` int(11) NOT NULL,
                                  PRIMARY KEY (`id`),
                                  KEY `fk_user_create_propertie_properties1_idx` (`idCategory`),
                                  KEY `fk_write_project_users1_idx` (`idUser`),
                                  CONSTRAINT `fk_user_create_propertie_properties1` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
                                  CONSTRAINT `fk_create_propertie_users1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `create_propertie`
--

LOCK TABLES `create_propertie` WRITE;
/*!40000 ALTER TABLE `create_propertie` DISABLE KEYS */;
INSERT INTO `create_propertie` VALUES (1,13,1),(2,13,2),(3,13,3),(4,14,1);
/*!40000 ALTER TABLE `create_propertie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(45) NOT NULL,
`email` varchar(45) NOT NULL,
`password` varchar(255) NOT NULL,
`photo` varchar(255) DEFAULT NULL,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
`updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
PRIMARY KEY (`id`),
UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

-- LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
-- INSERT INTO `users` VALUES 
-- (1,'Fábio','fabio@gmail.com','12345678','2022-07-15 11:50:25',NULL),
-- (2,'Aluno01','aluno@gmail.com','12345678','2022-07-25 11:36:46',NULL),
-- (3,'Avaliador01','avaliador@gmail.com','12345678','2022-07-25 12:01:15',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
