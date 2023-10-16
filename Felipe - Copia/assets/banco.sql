CREATE DATABASE IF NOT EXISTS `equacao`;
USE `equacao`;

-- -----------------------------------------------------
-- Table `equacao`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equacao`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `data_nascimento` DATE NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `pontuacao` INT DEFAULT 0,
  `tipo_usuario` INT DEFAULT 2,
  PRIMARY KEY (`idUsuario`)
) ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `equacao`.`contato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equacao`.`contato` (
  `idContato` INT NOT NULL AUTO_INCREMENT,
  `usuario_idUsuario` INT NOT NULL,
  `mensagem` TEXT NOT NULL,
  PRIMARY KEY (`idContato`),
  INDEX `fk_contato_usuario_idx` (`usuario_idUsuario`),
  CONSTRAINT `fk_contato_usuario`
    FOREIGN KEY (`usuario_idUsuario`)
    REFERENCES `usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equacao`.`questao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equacao`.`questao` (
  `idQuestao` INT NOT NULL AUTO_INCREMENT,
  `enunciado` TEXT NOT NULL,
  `resposta` VARCHAR(10) NOT NULL,
  `tipo_equacao` VARCHAR(30) NOT NULL,
  `dificuldade` INT NOT NULL,

  PRIMARY KEY (`idQuestao`)
) ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equacao`.`alternativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `equacao`.`alternativa` (
  `idAlternativa` INT NOT NULL AUTO_INCREMENT,
  `idQuestao` INT NOT NULL,
  `texto` TEXT NOT NULL,
  PRIMARY KEY (`idAlternativa`),
  INDEX `fk_alternativa_questao_idx` (`idQuestao`),
  CONSTRAINT `fk_alternativa_questao`
    FOREIGN KEY (`idQuestao`)
    REFERENCES `questao` (`idQuestao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
) ENGINE = InnoDB;