CREATE DATABASE  IF NOT EXISTS `livrariav2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `livrariav2`;
-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: livrariav2
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tab_autores`
--

DROP TABLE IF EXISTS `tab_autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_autores` (
  `autor_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `autor_name` varchar(50) NOT NULL,
  PRIMARY KEY (`autor_id`),
  UNIQUE KEY `autor_id` (`autor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_autores`
--

LOCK TABLES `tab_autores` WRITE;
/*!40000 ALTER TABLE `tab_autores` DISABLE KEYS */;
INSERT INTO `tab_autores` VALUES (2,'Machado de assis'),(3,'Olavo bilac'),(7,'Teste'),(8,'J.R.R. Tolkien');
/*!40000 ALTER TABLE `tab_autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_categorias`
--

DROP TABLE IF EXISTS `tab_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_categorias` (
  `categoria_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `categoria_name` varchar(50) NOT NULL,
  PRIMARY KEY (`categoria_id`),
  UNIQUE KEY `categoria_id` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_categorias`
--

LOCK TABLES `tab_categorias` WRITE;
/*!40000 ALTER TABLE `tab_categorias` DISABLE KEYS */;
INSERT INTO `tab_categorias` VALUES (1,'Ficção'),(2,'Ação'),(4,'Aventura');
/*!40000 ALTER TABLE `tab_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_editoras`
--

DROP TABLE IF EXISTS `tab_editoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_editoras` (
  `editora_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `editora_name` varchar(50) NOT NULL,
  PRIMARY KEY (`editora_id`),
  UNIQUE KEY `editora_id` (`editora_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_editoras`
--

LOCK TABLES `tab_editoras` WRITE;
/*!40000 ALTER TABLE `tab_editoras` DISABLE KEYS */;
INSERT INTO `tab_editoras` VALUES (1,'Harper Collins'),(2,'saraiva');
/*!40000 ALTER TABLE `tab_editoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_livros`
--

DROP TABLE IF EXISTS `tab_livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_livros` (
  `livro_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `livro_title` varchar(50) NOT NULL,
  `livro_description` text NOT NULL,
  `livro_ano` int DEFAULT NULL,
  `livro_paginas` int DEFAULT NULL,
  `livro_image` text,
  PRIMARY KEY (`livro_id`),
  UNIQUE KEY `livro_id` (`livro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_livros`
--

LOCK TABLES `tab_livros` WRITE;
/*!40000 ALTER TABLE `tab_livros` DISABLE KEYS */;
INSERT INTO `tab_livros` VALUES (5,'Violetas na Janela','Patrícia desencarnou aos dezenove anos. No mundo dos espíritos, recorda que despertou tranquilamente no plano espiritual, sentindo-se entre amigos. Feliz com a acolhida, adaptou-se à nova vida auxiliada por espíritos benfeitores que a receberam na Colônia São Sebastião. Em Violetas na janela, Patrícia explica o que é a desencarnação. Descreve as belezas do plano espiritual, onde não faltam trabalho, estudo e diversão. No início, estava cheia de dúvidas... Do que se alimentaria? O que vestiria? Sentiria as mesmas necessidades? Enfrentaria o calor, o frio? Aos poucos, tudo se esclareceu ao conviver com outros jovens desencarnados. Conheça o outro lado da vida: entenda como devemos proceder diante da morte de um ente querido – o que fazer para superar a separação e confortar aquele que partiu. Patrícia exemplifica a lição, relembrando a inesquecível ajuda que recebeu de familiares espíritas. (Livro 1 da Coleção Patrícia)',1992,293,'https://livrariadavila.vteximg.com.br/arquivos/ids/1122117-642-930/9788572532129.jpg?v=637668102420300000https://livrariadavila.vteximg.com.br/arquivos/ids/1122117-642-930/9788572532129.jpg?v=637668102420300000'),(6,'Grandes Mestres do Estoicismo - Meditações','&#13;&#10;&#13;&#10;Estas são anotações pessoais do imperador romano Marco Aurélio escritas entre os anos de 170 a 180.&#13;&#10;&#13;&#10;Também conhecidas como Meditações a mim mesmo, reúnem aforismos que orientaram o governante pela perspectiva do estoicismo – o controle das emoções para que se evitem os erros de julgamento.&#13;&#10;&#13;&#10;Suas meditações formam um manual de comportamento ainda atual sobre como podemos melhorar nosso comportamento e o relacionamento com o próximo.&#13;&#10;&#13;&#10;Marco Aurélio trava um diálogo interior em busca de verdades fundamentais por meio da razão sem deixar de lado a sensibilidade.&#13;&#10;&#13;&#10;Sem inclinação a qualquer crença religiosa, Meditações apela para ordens universais nas quais até mesmo os acontecimentos ruins ocorrem para o bem de todos.&#13;&#10;&#13;&#10;O imperador assume o papel do filósofo que instrui o aluno e dá conselhos ao amigo.&#13;&#10;&#13;&#10;Por seu caráter íntimo, Meditações tornou-se um dos escritos mais reveladores e inspiradores a respeito do pensamento de um grande líder.&#13;&#10;&#13;&#10;Apresenta ensinamentos sobre as virtudes, a felicidade, a morte, as paixões e a harmonia com a natureza e a aceitação de suas leis.&#13;&#10;&#13;&#10;Figura ainda entre as obras fundamentais para os estudiosos da filosofia estoica, mesmo milênios depois de sua composição.&#13;&#10;',123,123,'https://a-static.mlcdn.com.br/800x560/livro-grandes-mestres-do-estoicismo-meditacoes/livrosnainternet/130864-130865/5850322bbb3a3c588cfa6a06c1eb8aef.jpg'),(10,'Ikigai',' Viver uma vida plena, longa e feliz? Sim, é possível. A fórmula, segundo os japoneses, é encontrar o seu próprio ikigai, que vai ajudar você a definir e apreciar os prazeres da vida. Aqui, você irá descobrir os cinco passos para alcançá-lo e, assim, encontrar satisfação e alegria em tudo aquilo que faz. Esse antigo segredo dos japoneses pode fazer você viver mais, ter mais saúde, ser menos estressado e, principalmente, mais realizado com a sua vida.  Viver uma vida plena, longa e feliz? Sim, é possível. A fórmula, segundo os japoneses, é encontrar o seu próprio ikigai, que vai ajudar você a definir e apreciar os prazeres da vida. Aqui, você irá descobrir os cinco passos para alcançá-lo e, assim, encontrar satisfação e alegria em tudo aquilo que faz. Esse antigo segredo dos japoneses pode fazer você viver mais, ter mais saúde, ser menos estressado e, principalmente, mais realizado com a sua vida. ',2018,224,'https://m.media-amazon.com/images/I/71Ywn5J6XNL.jpg'),(13,'teste','teste',123123,123,'https://m.media-amazon.com/images/I/81MoknVer8L.jpg');
/*!40000 ALTER TABLE `tab_livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_livros_autores`
--

DROP TABLE IF EXISTS `tab_livros_autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_livros_autores` (
  `livro_autor_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fk_livro_id` bigint unsigned DEFAULT NULL,
  `fk_autor_id` bigint unsigned DEFAULT NULL,
  UNIQUE KEY `livro_autor_id` (`livro_autor_id`),
  KEY `tab_livros_autores_ibfk_2` (`fk_autor_id`),
  KEY `tab_livros_autores_ibfk_1` (`fk_livro_id`),
  CONSTRAINT `tab_livros_autores_ibfk_1` FOREIGN KEY (`fk_livro_id`) REFERENCES `tab_livros` (`livro_id`) ON DELETE CASCADE,
  CONSTRAINT `tab_livros_autores_ibfk_2` FOREIGN KEY (`fk_autor_id`) REFERENCES `tab_autores` (`autor_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_livros_autores`
--

LOCK TABLES `tab_livros_autores` WRITE;
/*!40000 ALTER TABLE `tab_livros_autores` DISABLE KEYS */;
INSERT INTO `tab_livros_autores` VALUES (2,5,2),(3,6,2),(5,10,7),(8,13,8);
/*!40000 ALTER TABLE `tab_livros_autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_livros_categorias`
--

DROP TABLE IF EXISTS `tab_livros_categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_livros_categorias` (
  `livro_categoria_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fk_livro_id` bigint unsigned DEFAULT NULL,
  `fk_categoria_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`livro_categoria_id`),
  UNIQUE KEY `livro_categoria_id` (`livro_categoria_id`),
  KEY `tab_livros_categorias_ibfk_2` (`fk_categoria_id`),
  KEY `tab_livros_categorias_ibfk_1` (`fk_livro_id`),
  CONSTRAINT `tab_livros_categorias_ibfk_1` FOREIGN KEY (`fk_livro_id`) REFERENCES `tab_livros` (`livro_id`) ON DELETE CASCADE,
  CONSTRAINT `tab_livros_categorias_ibfk_2` FOREIGN KEY (`fk_categoria_id`) REFERENCES `tab_categorias` (`categoria_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_livros_categorias`
--

LOCK TABLES `tab_livros_categorias` WRITE;
/*!40000 ALTER TABLE `tab_livros_categorias` DISABLE KEYS */;
INSERT INTO `tab_livros_categorias` VALUES (1,5,1),(2,5,2),(3,6,1),(10,13,1);
/*!40000 ALTER TABLE `tab_livros_categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_livros_editoras`
--

DROP TABLE IF EXISTS `tab_livros_editoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_livros_editoras` (
  `livro_autor_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fk_livro_id` bigint unsigned DEFAULT NULL,
  `fk_editora_id` bigint unsigned DEFAULT NULL,
  UNIQUE KEY `livro_autor_id` (`livro_autor_id`),
  KEY `tab_livros_editoras_ibfk_2` (`fk_editora_id`),
  KEY `tab_livros_editoras_ibfk_1` (`fk_livro_id`),
  CONSTRAINT `tab_livros_editoras_ibfk_1` FOREIGN KEY (`fk_livro_id`) REFERENCES `tab_livros` (`livro_id`) ON DELETE CASCADE,
  CONSTRAINT `tab_livros_editoras_ibfk_2` FOREIGN KEY (`fk_editora_id`) REFERENCES `tab_editoras` (`editora_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_livros_editoras`
--

LOCK TABLES `tab_livros_editoras` WRITE;
/*!40000 ALTER TABLE `tab_livros_editoras` DISABLE KEYS */;
INSERT INTO `tab_livros_editoras` VALUES (8,13,1);
/*!40000 ALTER TABLE `tab_livros_editoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_livros_usuarios`
--

DROP TABLE IF EXISTS `tab_livros_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_livros_usuarios` (
  `livro_user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fk_livro_id` bigint unsigned DEFAULT NULL,
  `fk_user_id` bigint unsigned DEFAULT NULL,
  UNIQUE KEY `livro_user_id` (`livro_user_id`),
  KEY `tab_livros_usuarios_ibfk_1` (`fk_livro_id`),
  KEY `tab_livros_usuarios_ibfk_2` (`fk_user_id`),
  CONSTRAINT `tab_livros_usuarios_ibfk_1` FOREIGN KEY (`fk_livro_id`) REFERENCES `tab_livros` (`livro_id`) ON DELETE CASCADE,
  CONSTRAINT `tab_livros_usuarios_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `tab_usuarios` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_livros_usuarios`
--

LOCK TABLES `tab_livros_usuarios` WRITE;
/*!40000 ALTER TABLE `tab_livros_usuarios` DISABLE KEYS */;
INSERT INTO `tab_livros_usuarios` VALUES (2,5,12),(3,6,12),(5,10,1),(8,13,1);
/*!40000 ALTER TABLE `tab_livros_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tab_usuarios`
--

DROP TABLE IF EXISTS `tab_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tab_usuarios` (
  `user_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_password` text,
  `user_joined_at` date NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_permissions` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tab_usuarios`
--

LOCK TABLES `tab_usuarios` WRITE;
/*!40000 ALTER TABLE `tab_usuarios` DISABLE KEYS */;
INSERT INTO `tab_usuarios` VALUES (1,'Admin','$2y$10$ZN7GzNyX55RPE2TyvQYJ0uHr5As0DqoXedr3t58wpOsT.CPyX6Rqi','2023-02-26','',2),(12,'teste','$2y$10$Mz1B6LV2fcjMyHYO5c8afuCydBWXOVjHGpvrNjK3aCfU0DYlkgokW','2023-02-24','',1);
/*!40000 ALTER TABLE `tab_usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-05 06:52:49
