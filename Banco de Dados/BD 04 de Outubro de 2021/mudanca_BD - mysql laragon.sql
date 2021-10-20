-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: mudanca_bd
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `area_atuacao`
--

DROP TABLE IF EXISTS `area_atuacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `area_atuacao` (
  `id_area_atuacao` int NOT NULL AUTO_INCREMENT,
  `cidade_atuacao` int NOT NULL,
  `motorista_id_motorista` int NOT NULL,
  PRIMARY KEY (`id_area_atuacao`),
  KEY `fk_area_atuacao_cidade1_idx` (`cidade_atuacao`),
  KEY `fk_area_atuacao_motorista1_idx` (`motorista_id_motorista`),
  CONSTRAINT `fk_area_atuacao_cidade1` FOREIGN KEY (`cidade_atuacao`) REFERENCES `cidade` (`id_cidade`),
  CONSTRAINT `fk_area_atuacao_motorista1` FOREIGN KEY (`motorista_id_motorista`) REFERENCES `motorista` (`id_motorista`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_atuacao`
--

LOCK TABLES `area_atuacao` WRITE;
/*!40000 ALTER TABLE `area_atuacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `area_atuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliacao` (
  `id_avaliacao` int NOT NULL AUTO_INCREMENT,
  `texto_avaliacao` text NOT NULL,
  `data_avaliacao` datetime NOT NULL,
  `resposta_avaliacao` text NOT NULL,
  `data_resposta` datetime NOT NULL,
  `cliente_avaliacao` int NOT NULL,
  `motorista_avaliacao` int NOT NULL,
  `proposta_avaliacao` int NOT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `fk_avaliacao_cliente1_idx` (`cliente_avaliacao`),
  KEY `fk_avaliacao_motorista1_idx` (`motorista_avaliacao`),
  KEY `fk_avaliacao_proposta1_idx` (`proposta_avaliacao`),
  CONSTRAINT `fk_avaliacao_cliente1` FOREIGN KEY (`cliente_avaliacao`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `fk_avaliacao_motorista1` FOREIGN KEY (`motorista_avaliacao`) REFERENCES `motorista` (`id_motorista`),
  CONSTRAINT `fk_avaliacao_proposta1` FOREIGN KEY (`proposta_avaliacao`) REFERENCES `proposta` (`id_proposta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cidade` (
  `id_cidade` int NOT NULL AUTO_INCREMENT,
  `nome_cidade` varchar(50) NOT NULL,
  `estado_cidade` int NOT NULL,
  PRIMARY KEY (`id_cidade`),
  KEY `fk_cidade_estado1_idx` (`estado_cidade`),
  CONSTRAINT `fk_cidade_estado1` FOREIGN KEY (`estado_cidade`) REFERENCES `estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidade`
--

LOCK TABLES `cidade` WRITE;
/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
INSERT INTO `cidade` VALUES (1,'cidade',1);
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorista`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(45) NOT NULL,
  `cpf_cliente` varchar(14) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `senha_cliente` varchar(40) NOT NULL,
  `telefone_cliente` varchar(20) NOT NULL,
  `cliente_ativo` tinyint DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `CPF_Cliente_UNIQUE` (`cpf_cliente`),
  UNIQUE KEY `E-Mail_Cliente_UNIQUE` (`email_cliente`),
  UNIQUE KEY `Telefone_Cliente_UNIQUE` (`telefone_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorista`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `motorista` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'teste','123','teste@teste','2e6f9b0d5885b6010f9167787445617f553a735f','123',1),(5,'oi','1234','oi@oi','ef67e0868c98e5f0b0e2fcd9b0c4a3bad808f551','1234',NULL);
/*!40000 ALTER TABLE `motorista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco_usuario`
--

DROP TABLE IF EXISTS `endereco_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco_usuario` (
  `id_enderco` int NOT NULL AUTO_INCREMENT,
  `pais` varchar(30) NOT NULL,
  `estado` int NOT NULL,
  `cidade` int NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cliente_endereco` int NOT NULL,
  PRIMARY KEY (`id_enderco`),
  KEY `fk_endereco_usuario_cliente1_idx` (`cliente_endereco`),
  KEY `fk_endereco_usuario_cidade1_idx` (`cidade`),
  KEY `endereco_usuario_estado_idx` (`estado`),
  CONSTRAINT `endereco_usuario_estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_endereco_usuario_cidade1` FOREIGN KEY (`cidade`) REFERENCES `cidade` (`id_cidade`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_endereco_usuario_cliente1` FOREIGN KEY (`cliente_endereco`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco_usuario`
--

LOCK TABLES `endereco_usuario` WRITE;
/*!40000 ALTER TABLE `endereco_usuario` DISABLE KEYS */;
INSERT INTO `endereco_usuario` VALUES (1,'pais',1,1,'bairro','rua',1,NULL,1);
/*!40000 ALTER TABLE `endereco_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id_estado` int NOT NULL AUTO_INCREMENT,
  `nome_estado` varchar(50) NOT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'estado');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `id_funcionario` int NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(45) NOT NULL,
  `cpf_funcionario` varchar(14) NOT NULL,
  `email_funcionario` varchar(100) NOT NULL,
  `senha_funcionario` varchar(40) NOT NULL,
  `telefone_funcionario` varchar(20) NOT NULL,
  PRIMARY KEY (`id_funcionario`),
  UNIQUE KEY `E-Mail_ADM_UNIQUE` (`email_funcionario`),
  UNIQUE KEY `CPF_ADM_UNIQUE` (`cpf_funcionario`),
  UNIQUE KEY `Telefone_ADM_UNIQUE` (`telefone_funcionario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionario`
--

LOCK TABLES `funcionario` WRITE;
/*!40000 ALTER TABLE `funcionario` DISABLE KEYS */;
INSERT INTO `funcionario` VALUES (1,'admin','123','admin@admin','d033e22ae348aeb5660fc2140aec35850c4da997','1234'),(2,'asd','12345','asd@asd','f10e2821bbbea527ea02200352313bc059445190','123456');
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorista`
--

DROP TABLE IF EXISTS `motorista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motorista` (
  `id_motorista` int NOT NULL AUTO_INCREMENT,
  `nome_motorista` varchar(45) NOT NULL,
  `cpf_motorista` varchar(14) NOT NULL,
  `email_motorista` varchar(100) NOT NULL,
  `senha_motorista` varchar(40) NOT NULL,
  `telefone_motorista` varchar(20) NOT NULL,
  `carteira_de_motorista` varchar(45) NOT NULL,
  `status_motorista` int DEFAULT NULL,
  PRIMARY KEY (`id_motorista`),
  UNIQUE KEY `E-Mail_Taxista_UNIQUE` (`email_motorista`),
  UNIQUE KEY `CPF_Taxista_UNIQUE` (`cpf_motorista`),
  UNIQUE KEY `Telefone_Taxista_UNIQUE` (`telefone_motorista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorista`
--

LOCK TABLES `motorista` WRITE;
/*!40000 ALTER TABLE `motorista` DISABLE KEYS */;
/*!40000 ALTER TABLE `motorista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orcamento` (
  `id_orcamento` int NOT NULL AUTO_INCREMENT,
  `data_e_horario` datetime NOT NULL,
  `inf_adicionais` varchar(200) DEFAULT NULL,
  `endereco_partida` int NOT NULL,
  `endereco_destino` int NOT NULL,
  PRIMARY KEY (`id_orcamento`),
  KEY `fk_orcamento_endereco_usuario1_idx` (`endereco_partida`),
  KEY `fk_orcamento_endereco_usuario2_idx` (`endereco_destino`),
  CONSTRAINT `fk_orcamento_endereco_usuario1` FOREIGN KEY (`endereco_partida`) REFERENCES `endereco_usuario` (`id_enderco`),
  CONSTRAINT `fk_orcamento_endereco_usuario2` FOREIGN KEY (`endereco_destino`) REFERENCES `endereco_usuario` (`id_enderco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamento`
--

LOCK TABLES `orcamento` WRITE;
/*!40000 ALTER TABLE `orcamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `orcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposta`
--

DROP TABLE IF EXISTS `proposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proposta` (
  `id_proposta` int NOT NULL AUTO_INCREMENT,
  `preco` decimal(8,2) DEFAULT NULL,
  `proposta_aprovada` tinyint DEFAULT NULL,
  `informacoes_adicionais` varchar(200) DEFAULT NULL,
  `elaborando` int NOT NULL,
  `motorista_proposta` int NOT NULL,
  `orcamento_proposta` int NOT NULL,
  PRIMARY KEY (`id_proposta`),
  KEY `motorista_proposta_idx` (`motorista_proposta`),
  KEY `fk_proposta_orcamento1_idx` (`orcamento_proposta`),
  CONSTRAINT `fk_proposta_orcamento1` FOREIGN KEY (`orcamento_proposta`) REFERENCES `orcamento` (`id_orcamento`),
  CONSTRAINT `motorista_proposta` FOREIGN KEY (`motorista_proposta`) REFERENCES `motorista` (`id_motorista`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposta`
--

LOCK TABLES `proposta` WRITE;
/*!40000 ALTER TABLE `proposta` DISABLE KEYS */;
/*!40000 ALTER TABLE `proposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veículo`
--

DROP TABLE IF EXISTS `veículo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veículo` (
  `id_veiculo` int NOT NULL AUTO_INCREMENT,
  `numero_chassi` int NOT NULL,
  `marca_veiculo` varchar(45) NOT NULL,
  `modelo_veiculo` varchar(45) NOT NULL,
  `ano_veiculo` varchar(45) NOT NULL,
  `placa_veiculo` varchar(45) NOT NULL,
  `tipo_veiculo` varchar(45) NOT NULL,
  `status_veiculo` int DEFAULT NULL,
  `motorista_veiculo` int NOT NULL,
  PRIMARY KEY (`id_veiculo`),
  UNIQUE KEY `Placa_Veículo_UNIQUE` (`placa_veiculo`),
  UNIQUE KEY `Número_Chassi_UNIQUE` (`numero_chassi`),
  KEY `fk_veículo_motorista1_idx` (`motorista_veiculo`),
  CONSTRAINT `fk_veículo_motorista1` FOREIGN KEY (`motorista_veiculo`) REFERENCES `motorista` (`id_motorista`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veículo`
--

LOCK TABLES `veículo` WRITE;
/*!40000 ALTER TABLE `veículo` DISABLE KEYS */;
/*!40000 ALTER TABLE `veículo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'mudanca_bd'
--

--
-- Dumping routines for database 'mudanca_bd'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-07  7:51:18
