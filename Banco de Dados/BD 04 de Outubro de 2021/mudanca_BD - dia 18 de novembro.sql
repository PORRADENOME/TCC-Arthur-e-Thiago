-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mudanca_bd
-- ------------------------------------------------------
-- Server version	5.7.24

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
  `id_area_atuacao` int(11) NOT NULL AUTO_INCREMENT,
  `cidade_atuacao` int(11) NOT NULL,
  `motorista_atuacao` int(11) NOT NULL,
  PRIMARY KEY (`id_area_atuacao`),
  KEY `fk_area_atuacao_cidade1_idx` (`cidade_atuacao`),
  KEY `motorista_atuacao_idx` (`motorista_atuacao`),
  CONSTRAINT `fk_area_atuacao_cidade1` FOREIGN KEY (`cidade_atuacao`) REFERENCES `cidade` (`id_cidade`),
  CONSTRAINT `motorista_atuacao` FOREIGN KEY (`motorista_atuacao`) REFERENCES `motorista` (`id_motorista`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `area_atuacao`
--

LOCK TABLES `area_atuacao` WRITE;
/*!40000 ALTER TABLE `area_atuacao` DISABLE KEYS */;
INSERT INTO `area_atuacao` VALUES (1,2,1),(2,1,1),(3,4,1);
/*!40000 ALTER TABLE `area_atuacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacao`
--

DROP TABLE IF EXISTS `avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliacao` (
  `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT,
  `texto_avaliacao` text,
  `data_avaliacao` datetime DEFAULT NULL,
  `cliente_avaliacao` int(11) DEFAULT NULL,
  `motorista_avaliacao` int(11) DEFAULT NULL,
  `proposta_avaliacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_avaliacao`),
  KEY `fk_avaliacao_cliente1_idx` (`cliente_avaliacao`),
  KEY `fk_avaliacao_motorista1_idx` (`motorista_avaliacao`),
  KEY `fk_avaliacao_proposta1_idx` (`proposta_avaliacao`),
  CONSTRAINT `fk_avaliacao_cliente1` FOREIGN KEY (`cliente_avaliacao`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `fk_avaliacao_motorista1` FOREIGN KEY (`motorista_avaliacao`) REFERENCES `motorista` (`id_motorista`),
  CONSTRAINT `fk_avaliacao_proposta1` FOREIGN KEY (`proposta_avaliacao`) REFERENCES `proposta` (`id_proposta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacao`
--

LOCK TABLES `avaliacao` WRITE;
/*!40000 ALTER TABLE `avaliacao` DISABLE KEYS */;
INSERT INTO `avaliacao` VALUES (1,'1','2021-10-28 12:07:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cidade`
--

DROP TABLE IF EXISTS `cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cidade` varchar(50) NOT NULL,
  `cidade_ativa` varchar(45) NOT NULL DEFAULT '1',
  `estado_cidade` int(11) NOT NULL,
  PRIMARY KEY (`id_cidade`),
  KEY `fk_cidade_estado1_idx` (`estado_cidade`),
  CONSTRAINT `fk_cidade_estado1` FOREIGN KEY (`estado_cidade`) REFERENCES `estado` (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cidade`
--

LOCK TABLES `cidade` WRITE;
/*!40000 ALTER TABLE `cidade` DISABLE KEYS */;
INSERT INTO `cidade` VALUES (1,'Porto UniÃ£o','1',3),(2,'UniÃ£o da VitÃ³ria','1',2),(4,'Porto VitÃ³ria','1',2),(5,'Belo Horizonte','1',6),(6,'Ouro Preto','1',6),(7,'Rio de Janeiro','1',4);
/*!40000 ALTER TABLE `cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(45) NOT NULL,
  `cpf_cliente` varchar(14) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `senha_cliente` varchar(40) NOT NULL,
  `telefone_cliente` varchar(20) NOT NULL,
  `cliente_ativo` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `CPF_Cliente_UNIQUE` (`cpf_cliente`),
  UNIQUE KEY `E-Mail_Cliente_UNIQUE` (`email_cliente`),
  UNIQUE KEY `Telefone_Cliente_UNIQUE` (`telefone_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'teste','123','teste@teste','2e6f9b0d5885b6010f9167787445617f553a735f','(00) 0000-0000',1),(5,'oi','1234','oi@oi','ef67e0868c98e5f0b0e2fcd9b0c4a3bad808f551','1234',1),(6,'Jennifer','125.985.008-00','jenny@gmail.com','c6080a4c5ab5d831ad3dc3d39cd0f5ad27c25bbd','42 99925-3227',1),(7,'123','111.111.111-11','123@asdf','40bd001563085fc35165329ea1ff5c5ecbdbbeef','(42) 99761-181',2),(8,'asdf','132.132.132-13','231@asdf','17ba0791499db908433b80f37c5fbc89b870084b','(42) 9997611',2),(10,'Arthur Daniel Giacomini','123.321.123-01','arthur@gmail.com','7751a23fa55170a57e90374df13a3ab78efe0e99','(11) 988888888',1),(11,'editar','475.762.568-50','editar@editar','c9c43bc17ce2233c4627e7c580c6600ab831d5b0','(12) 314234543',1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endereco`
--

DROP TABLE IF EXISTS `endereco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `nome_endereco` varchar(45) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `estado` int(11) NOT NULL,
  `cidade` int(11) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `cliente_endereco` int(11) NOT NULL,
  `endereco_ativo` varchar(45) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_endereco`),
  KEY `fk_endereco_usuario_cliente1_idx` (`cliente_endereco`),
  KEY `fk_endereco_usuario_cidade1_idx` (`cidade`),
  KEY `endereco_usuario_estado_idx` (`estado`),
  CONSTRAINT `endereco_usuario_estado` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`),
  CONSTRAINT `fk_endereco_usuario_cidade1` FOREIGN KEY (`cidade`) REFERENCES `cidade` (`id_cidade`),
  CONSTRAINT `fk_endereco_usuario_cliente1` FOREIGN KEY (`cliente_endereco`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endereco`
--

LOCK TABLES `endereco` WRITE;
/*!40000 ALTER TABLE `endereco` DISABLE KEYS */;
INSERT INTO `endereco` VALUES (1,'Casa','Brasil',2,2,'Bairro','Rua',123,'',1,'1'),(2,'Casa Nova','Brasil',3,1,'Cidade Nova','Guilherme Gaertner',167,'',1,'2'),(3,'Casa Antiga','Brasil',2,2,'Navegantes','Desembargador Costa Carvalho',122,'Fundos',1,'1'),(4,'Casa Antiga','Brasil',2,2,'Navegantes','Desembargador Costa Carvalho',122,'fundos',10,'1'),(5,'Casa Nova','Brasil',3,1,'Cidade Nova','Guilherme Gaertner',167,'',10,'1'),(6,'Casa Antiga','Brasil',3,1,'aaa','aaa',11233,'',1,'1');
/*!40000 ALTER TABLE `endereco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nome_estado` varchar(50) NOT NULL,
  `estado_ativo` varchar(45) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'SÃ£o Paulo','1'),(2,'ParanÃ¡','1'),(3,'Santa Catarina','1'),(4,'Rio de Janeiro','1'),(5,'Rio Grande do Sul','1'),(6,'Minas Gerais','1'),(7,'Mato Grosso do Sul','1');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionario` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome_funcionario` varchar(45) NOT NULL,
  `cpf_funcionario` varchar(14) NOT NULL,
  `email_funcionario` varchar(100) NOT NULL,
  `senha_funcionario` varchar(40) NOT NULL,
  `telefone_funcionario` varchar(20) NOT NULL,
  `valor_admin` int(11) NOT NULL,
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
INSERT INTO `funcionario` VALUES (1,'admin','106.527.809-89','admin@gmail.com','d033e22ae348aeb5660fc2140aec35850c4da997','(42) 37008589',1),(2,'FuncionÃ¡rio','801.220.859-81','funcionario@gmail.com','3802bbe7c14128ebd50dbfdd4db95c1ffdc8425b','(42) 99884591',0),(3,'Elias Giovanni CauÃª Ferreira','262.856.800-43','eliasgiovannicaueferreira_@gmail.com','7751a23fa55170a57e90374df13a3ab78efe0e99','(82) 98134198',2),(4,'Tatiane Alice Malu Campos','753.396.748-86','tatiane@yahoo.com.br','7751a23fa55170a57e90374df13a3ab78efe0e99','(92) 26008827',1),(5,'Mariane Andreia Sarah da ConceiÃ§Ã£o','348.921.016-64','mariane@gmail.com','7751a23fa55170a57e90374df13a3ab78efe0e99','(95) 98251116',2);
/*!40000 ALTER TABLE `funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motorista`
--

DROP TABLE IF EXISTS `motorista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `motorista` (
  `id_motorista` int(11) NOT NULL AUTO_INCREMENT,
  `nome_motorista` varchar(45) NOT NULL,
  `cpf_motorista` varchar(14) NOT NULL,
  `email_motorista` varchar(100) NOT NULL,
  `senha_motorista` varchar(40) NOT NULL,
  `telefone_motorista` varchar(20) NOT NULL,
  `carteira_de_motorista` varchar(400) DEFAULT NULL,
  `motorista_ativo` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_motorista`),
  UNIQUE KEY `E-Mail_Taxista_UNIQUE` (`email_motorista`),
  UNIQUE KEY `CPF_Taxista_UNIQUE` (`cpf_motorista`),
  UNIQUE KEY `Telefone_Taxista_UNIQUE` (`telefone_motorista`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motorista`
--

LOCK TABLES `motorista` WRITE;
/*!40000 ALTER TABLE `motorista` DISABLE KEYS */;
INSERT INTO `motorista` VALUES (1,'Mot','543.543.543-5','mot@gmail.com','984ac749fe8b492e8407bb6fa3d0d8f6eb153baf','(54) 35435435','900e2b07e42883be41a60712130cd11d.jpg',1),(2,'a','982.475.874-27','oi@oi','86f7e437faa5a7fce15d1ddcb9eaeaea377667b8','(42) 9997-61134','12321353456',1),(3,'Motorista','417.552.748-66','Motorista@gmail.com','a61e38f3910fba1d8e1fb97f4b3561df07ab0d81','(42) 988888888','0ecbc17c37e3a3d70150b2bc8a730cc9.jpg',1),(4,'Gustavo LuÃ­s Hugo Porto','586.821.412-99','gustavo@gmail.com','7751a23fa55170a57e90374df13a3ab78efe0e99','(81) 9826-58335','44b08e94b1232f8171bd35d9ba79f4dc.jpg',1),(5,'Luzia Francisca Amanda Fernandes','555.682.126-78','luziafranciscaamandafernandes-89@gmail.com','7751a23fa55170a57e90374df13a3ab78efe0e99','(19) 9942-23399','97a91bd3b923e28ecec5919002f1e343.jpg',0),(6,'Kaique CÃ©sar Calebe Silva','786.095.011-16','kaiquecesarcalebesilva__kaiquecesarcalebesilva@gmail.com','111991cc05cbe8a3cec2776d0c4d099f0c72a6de','(63) 9931-97466','da100eb7aedd5587faebe5b2f1c1472b.jpg',0),(7,'Catarina VitÃ³ria Isis dos Santos','047.170.646-90','catarinavitoriaisisdossantos..catarinavitoriaisisdossantos@eton.com.br','7751a23fa55170a57e90374df13a3ab78efe0e99','(79) 2567-7893','d812d9530e5972b627e4436aa135f34b.jpg',1),(10,'Murilo Carlos Eduardo Heitor Moreira','672.736.514-86','murilocarloseduardoheitormoreira_@arysta.com.br','7751a23fa55170a57e90374df13a3ab78efe0e99','(67) 9929-84850','14a8f702b3898733c1e1fd78fc8fda20.jpg',0);
/*!40000 ALTER TABLE `motorista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orcamento`
--

DROP TABLE IF EXISTS `orcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orcamento` (
  `id_orcamento` int(11) NOT NULL AUTO_INCREMENT,
  `data_e_horario` datetime NOT NULL,
  `orcamento_ativo` varchar(45) DEFAULT '1',
  `inf_adicionais` varchar(200) DEFAULT NULL,
  `endereco_partida` int(11) NOT NULL,
  `endereco_destino` int(11) NOT NULL,
  `cliente_orcamento` int(11) NOT NULL,
  PRIMARY KEY (`id_orcamento`),
  KEY `fk_orcamento_endereco_usuario1_idx` (`endereco_partida`),
  KEY `fk_orcamento_endereco_usuario2_idx` (`endereco_destino`),
  KEY `cliente_orcamento_idx` (`cliente_orcamento`),
  CONSTRAINT `cliente_orcamento` FOREIGN KEY (`cliente_orcamento`) REFERENCES `cliente` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_orcamento_endereco_usuario1` FOREIGN KEY (`endereco_partida`) REFERENCES `endereco` (`id_endereco`),
  CONSTRAINT `fk_orcamento_endereco_usuario2` FOREIGN KEY (`endereco_destino`) REFERENCES `endereco` (`id_endereco`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orcamento`
--

LOCK TABLES `orcamento` WRITE;
/*!40000 ALTER TABLE `orcamento` DISABLE KEYS */;
INSERT INTO `orcamento` VALUES (1,'2021-10-31 16:00:00','1','            MudanÃ§a mÃ©dia',3,2,1),(2,'2021-10-26 14:45:00','2','            ',1,1,1),(3,'2021-11-20 15:30:00','1','            MudanÃ§a mediana',4,5,10),(4,'2021-11-20 10:11:00','1','bora passear',4,5,10);
/*!40000 ALTER TABLE `orcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposta`
--

DROP TABLE IF EXISTS `proposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proposta` (
  `id_proposta` int(11) NOT NULL AUTO_INCREMENT,
  `preco` decimal(8,2) NOT NULL,
  `proposta_aprovada` int(11) DEFAULT '0',
  `informacoes_adicionais` varchar(200) DEFAULT NULL,
  `motorista_proposta` int(11) NOT NULL,
  `orcamento_proposta` int(11) NOT NULL,
  PRIMARY KEY (`id_proposta`),
  KEY `motorista_proposta_idx` (`motorista_proposta`),
  KEY `fk_proposta_orcamento1_idx` (`orcamento_proposta`),
  CONSTRAINT `fk_proposta_motorista1` FOREIGN KEY (`motorista_proposta`) REFERENCES `motorista` (`id_motorista`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_proposta_orcamento1` FOREIGN KEY (`orcamento_proposta`) REFERENCES `orcamento` (`id_orcamento`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposta`
--

LOCK TABLES `proposta` WRITE;
/*!40000 ALTER TABLE `proposta` DISABLE KEYS */;
INSERT INTO `proposta` VALUES (1,1100.00,2,'a',1,1),(2,120.00,2,'',1,1),(3,122.00,1,'',1,1),(4,1000.00,2,'ola',1,2),(5,111.00,2,'111',1,1),(6,1000.00,0,'inf',1,1);
/*!40000 ALTER TABLE `proposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resposta`
--

DROP TABLE IF EXISTS `resposta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resposta` (
  `id_resposta` int(11) NOT NULL AUTO_INCREMENT,
  `texto_resposta` text,
  `data_resposta` datetime DEFAULT NULL,
  `cliente_resposta` int(11) DEFAULT NULL,
  `motorista_resposta` int(11) DEFAULT NULL,
  `avaliacao_resposta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_resposta`),
  KEY `cliente_resposta_idx` (`cliente_resposta`),
  KEY `motorista_resposta_idx` (`motorista_resposta`),
  KEY `avaliacao_resposta_idx` (`avaliacao_resposta`),
  CONSTRAINT `avaliacao_resposta` FOREIGN KEY (`avaliacao_resposta`) REFERENCES `avaliacao` (`id_avaliacao`),
  CONSTRAINT `cliente_resposta` FOREIGN KEY (`cliente_resposta`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `motorista_resposta` FOREIGN KEY (`motorista_resposta`) REFERENCES `motorista` (`id_motorista`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resposta`
--

LOCK TABLES `resposta` WRITE;
/*!40000 ALTER TABLE `resposta` DISABLE KEYS */;
INSERT INTO `resposta` VALUES (1,'AvaliaÃ§Ã£o IncrÃ­vel!','2021-10-28 13:15:00',NULL,NULL,NULL);
/*!40000 ALTER TABLE `resposta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veiculos`
--

DROP TABLE IF EXISTS `veiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `veiculos` (
  `id_veiculo` int(11) NOT NULL AUTO_INCREMENT,
  `numero_chassi_veiculo` int(11) NOT NULL,
  `marca_veiculo` varchar(45) NOT NULL,
  `modelo_veiculo` varchar(45) NOT NULL,
  `ano_veiculo` varchar(45) NOT NULL,
  `placa_veiculo` varchar(45) NOT NULL,
  `tipo_veiculo` varchar(45) NOT NULL,
  `status_veiculo` int(11) DEFAULT NULL,
  `motorista_veiculo` int(11) NOT NULL,
  PRIMARY KEY (`id_veiculo`),
  UNIQUE KEY `Placa_Veículo_UNIQUE` (`placa_veiculo`),
  UNIQUE KEY `Número_Chassi_UNIQUE` (`numero_chassi_veiculo`),
  KEY `fk_veículo_motorista1_idx` (`motorista_veiculo`),
  CONSTRAINT `fk_veículo_motorista1` FOREIGN KEY (`motorista_veiculo`) REFERENCES `motorista` (`id_motorista`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veiculos`
--

LOCK TABLES `veiculos` WRITE;
/*!40000 ALTER TABLE `veiculos` DISABLE KEYS */;
INSERT INTO `veiculos` VALUES (1,1,'1','1','1','1','1',NULL,1),(6,123123,'asda','asdaas','asd','asdasd','asdasd',NULL,1);
/*!40000 ALTER TABLE `veiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-18 14:07:33