-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           8.0.19 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para algo
CREATE DATABASE IF NOT EXISTS `algo` /*!40100 DEFAULT CHARACTER SET utf8mb4  */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `algo`;

-- Copiando estrutura para tabela algo.atendente
CREATE TABLE IF NOT EXISTS `atendente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `funcao` varchar(45) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.atendente: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `atendente` DISABLE KEYS */;
INSERT INTO `atendente` (`id`, `nome`, `funcao`, `telefone`) VALUES
	(1, 'Nome ate', 'Funcao', 'Telefone');
/*!40000 ALTER TABLE `atendente` ENABLE KEYS */;

-- Copiando estrutura para tabela algo.atendimento
CREATE TABLE IF NOT EXISTS `atendimento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idcliente` int NOT NULL,
  `idatendente` int NOT NULL,
  `desconto` decimal(8,2) NOT NULL DEFAULT '0.00',
  `valortotal` decimal(10,0) NOT NULL DEFAULT '0',
  `data` datetime NOT NULL,
  `formapagamento` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_atendimento_atendente1_idx` (`idatendente`),
  KEY `fk_atendimento_cliente1_idx` (`idcliente`),
  CONSTRAINT `fk_atendimento_atendente1` FOREIGN KEY (`idatendente`) REFERENCES `atendente` (`id`),
  CONSTRAINT `fk_atendimento_cliente1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.atendimento: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `atendimento` DISABLE KEYS */;
INSERT INTO `atendimento` (`id`, `idcliente`, `idatendente`, `desconto`, `valortotal`, `data`, `formapagamento`) VALUES
	(1, 1, 1, 111.00, 111, '2020-11-19 15:15:18', NULL),
	(2, 1, 1, 0.00, 0, '2020-11-19 15:24:35', NULL),
	(3, 1, 1, 0.00, 0, '2020-11-19 16:39:40', NULL),
	(4, 1, 1, 0.00, 0, '2020-11-19 16:48:01', NULL),
	(5, 1, 1, 0.00, 0, '2020-11-19 16:49:47', NULL);
/*!40000 ALTER TABLE `atendimento` ENABLE KEYS */;

-- Copiando estrutura para tabela algo.atendimento_produto
CREATE TABLE IF NOT EXISTS `atendimento_produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idproduto` int NOT NULL,
  `idatendimento` int NOT NULL,
  `valorproduto` decimal(8,2) NOT NULL,
  `quantidade` tinyint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_atendimento_produto_produto1_idx` (`idproduto`),
  KEY `fk_atendimento_produto_atendimento1_idx` (`idatendimento`),
  CONSTRAINT `fk_atendimento_produto_atendimento1` FOREIGN KEY (`idatendimento`) REFERENCES `atendimento` (`id`),
  CONSTRAINT `fk_atendimento_produto_produto1` FOREIGN KEY (`idproduto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.atendimento_produto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `atendimento_produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimento_produto` ENABLE KEYS */;

-- Copiando estrutura para tabela algo.atendimento_servico
CREATE TABLE IF NOT EXISTS `atendimento_servico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idservico` int NOT NULL,
  `idatendimento` int NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_atendimento_servico_servico_idx` (`idservico`),
  KEY `fk_atendimento_servico_atendimento1_idx` (`idatendimento`),
  CONSTRAINT `fk_atendimento_servico_atendimento1` FOREIGN KEY (`idatendimento`) REFERENCES `atendimento` (`id`),
  CONSTRAINT `fk_atendimento_servico_servico` FOREIGN KEY (`idservico`) REFERENCES `servico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.atendimento_servico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `atendimento_servico` DISABLE KEYS */;
/*!40000 ALTER TABLE `atendimento_servico` ENABLE KEYS */;

-- Copiando estrutura para procedure algo.atualiza_valor_total
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `atualiza_valor_total`(
	IN `inAtendimento` INT
)
    MODIFIES SQL DATA
    SQL SECURITY INVOKER
BEGIN
 DECLARE valorTotal, valorTotalServico, valorTotalProduto, valorDesconto DECIMAL(8,2);
  select ifNULL(sum(valor), 0) into valorTotalServico FROM atendimento_servico WHERE idatendimento=inAtendimento;
  select ifNULL(sum(valorproduto*quantidade), 0) into valorTotalProduto FROM atendimento_produto WHERE idatendimento=inAtendimento;
  select ifNULL(desconto, 0) into valorDesconto FROM atendimento WHERE id=inAtendimento;
  
  SET valorTotal = valorTotalServico + valorTotalProduto - valorDesconto;
  
  update atendimento set valortotal=valorTotal where id=inAtendimento;
END//
DELIMITER ;

-- Copiando estrutura para tabela algo.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `datanascimento` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.cliente: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `nome`, `email`, `telefone`, `cpf`, `datanascimento`) VALUES
	(1, 'Nome cli', 'Email@email', 'Telefone', 'Cpf', '2020-01-01');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando estrutura para tabela algo.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` text,
  `valor` decimal(8,2) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.produto: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` (`id`, `nome`, `descricao`, `valor`, `foto`) VALUES
	(1, 'fgdg', 'dgsfg', 545.00, NULL),
	(2, 'fgdgjh', '111hg', 26.00, NULL);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;

-- Copiando estrutura para tabela algo.servico
CREATE TABLE IF NOT EXISTS `servico` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.servico: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` (`id`, `nome`, `descricao`, `valor`) VALUES
	(1, 'corte de muie', 'corte feminino', 30.00),
	(2, 'barbear', '', 30.00),
	(3, 'corte de home', 'corte masculino', 30.00),
	(4, 'tintura f1kkkk', '', 11.00),
	(6, 'fgdg', '564', 657.00);
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;

-- Copiando estrutura para tabela algo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `ativo` tinyint NOT NULL DEFAULT '1',
  `usuario` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela algo.usuario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `ativo`, `usuario`) VALUES
	(1, 'adelmo', 'adelm3GMAIL.COM', 'adelmo', 1, 'adelmo');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Copiando estrutura para trigger algo.atendimento_produto_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `atendimento_produto_after_delete` AFTER DELETE ON `atendimento_produto` FOR EACH ROW BEGIN
CALL atualiza_valor_total(OLD.idatendimento);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger algo.atendimento_produto_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `atendimento_produto_after_update` AFTER UPDATE ON `atendimento_produto` FOR EACH ROW BEGIN
CALL atualiza_valor_total(NEW.idatendimento);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger algo.atendimento_produto_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `atendimento_produto_before_insert` AFTER INSERT ON `atendimento_produto` FOR EACH ROW BEGIN
CALL atualiza_valor_total(NEW.idatendimento);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger algo.atendimento_servico_after_delete
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `atendimento_servico_after_delete` AFTER DELETE ON `atendimento_servico` FOR EACH ROW BEGIN
CALL atualiza_valor_total(OLD.idatendimento);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger algo.atendimento_servico_after_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `atendimento_servico_after_insert` AFTER INSERT ON `atendimento_servico` FOR EACH ROW BEGIN
CALL atualiza_valor_total(NEW.idatendimento);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Copiando estrutura para trigger algo.atendimento_servico_after_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `atendimento_servico_after_update` AFTER UPDATE ON `atendimento_servico` FOR EACH ROW BEGIN
CALL atualiza_valor_total(NEW.idatendimento);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
