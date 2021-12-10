CREATE TABLE `vendas`.`fabricante` (
  `id_fabricante` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  PRIMARY KEY (`id_fabricante`));

  CREATE TABLE `vendas`.`marca` (
  `id_marca` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `id_fabricante` INT NULL,
  PRIMARY KEY (`id_marca`),
  FOREIGN KEY (`id_fabricante`) REFERENCES `vendas`.`fabricante` (`id_fabricante`));

  CREATE TABLE `vendas`.`vendedor` (
  `id_vendedor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `cpf` VARCHAR(45) NULL,
  'telefone' VARCHAR (45) NULL, 
  'vendas_mes' DOUBLE NULL,
  PRIMARY KEY (`id_vendedor`));

  CREATE TABLE `vendas`.`cliente` (
  `id_cliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `cfp` VARCHAR(45) NULL,
  'telefone' VARCHAR (45) NULL, 
  'endereco' VARCHAR (45) NULL,
  `id_vendedor` INT NULL,
  PRIMARY KEY (`id_cliente`),
  FOREIGN KEY (`id_vendedor`) REFERENCES `vendas`.`vendedor` (`id_vendedor`));

CREATE TABLE `vendas`.`produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `valor` DOUBLE NULL,
  `id_fabricante` INT NULL,
  `id_marca` INT NULL,
  PRIMARY KEY (`id_produto`),
  FOREIGN KEY (`id_fabricante`) REFERENCES `vendas`.`fabricante` (`id_fabricante`),
  FOREIGN KEY (`id_marca`) REFERENCES `vendas`.`marca` (`id_marca`));

CREATE TABLE `vendas`.`venda` (
  `id_venda` INT NOT NULL AUTO_INCREMENT,
  'data_venda' DATE NULL, 
  `data_pagamento` DATE NULL,
  'id_vendedor' INT NULL,
   PRIMARY KEY ('id_venda'),
   FOREIGN KEY (`id_vendedor`) REFERENCES `vendas`.`vendedor` (`id_vendedor`));

CREATE TABLE `vendas`.`produto_has_venda` (
  `id_produto` INT NOT NULL,
  'id_venda' INT NULL, 
  'quantidade' INT NULL,
   FOREIGN KEY (`id_produto`) REFERENCES `vendas`.`produto` (`id_produto`),
   FOREIGN KEY (`id_venda`) REFERENCES `vendas`.`venda` (`id_venda`));

   



