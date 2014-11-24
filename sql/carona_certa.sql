SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `carona_certa` ;
CREATE SCHEMA IF NOT EXISTS `carona_certa` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `carona_certa` ;

-- -----------------------------------------------------
-- Table `carona_certa`.`usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`usuario` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NULL,
  `senha` VARCHAR(255) NULL,
  `nome` VARCHAR(1024) NULL,
  `data_nascimento` DATE NULL,
  `telefone` VARCHAR(128) NULL,
  `endereco` VARCHAR(1024) NULL,
  `cidade` VARCHAR(512) NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `id_usuario_UNIQUE` (`id_usuario` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `carona_certa`.`motorista`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`motorista` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`motorista` (
  `id_motorista` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `numero_habilitacao` VARCHAR(128) NULL,
  `data_habilitacao` DATE NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_motorista`),
  INDEX `fk_motorista_usuario_idx` (`id_usuario` ASC),
  UNIQUE INDEX `id_motorista_UNIQUE` (`id_motorista` ASC),
  UNIQUE INDEX `id_usuario_UNIQUE` (`id_usuario` ASC),
  CONSTRAINT `fk_motorista_usuario`
  FOREIGN KEY (`id_usuario`)
  REFERENCES `carona_certa`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `carona_certa`.`carro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`carro` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`carro` (
  `id_carro` INT NOT NULL AUTO_INCREMENT,
  `id_motorista` INT NOT NULL,
  `modelo` VARCHAR(255) NULL,
  `descricao` VARCHAR(1024) NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_carro`),
  INDEX `fk_carro_motorista_idx` (`id_motorista` ASC),
  UNIQUE INDEX `id_carro_UNIQUE` (`id_carro` ASC),
  CONSTRAINT `fk_carro_motorista`
  FOREIGN KEY (`id_motorista`)
  REFERENCES `carona_certa`.`motorista` (`id_motorista`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `carona_certa`.`carona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`carona` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`carona` (
  `id_carona` INT NOT NULL AUTO_INCREMENT,
  `id_carro` INT NOT NULL,
  `data` DATE NULL,
  `lugar_saida` VARCHAR(512) NULL,
  `lugar_destino` VARCHAR(512) NULL,
  `lugares_disponiveis` INT NULL,
  `observacoes` VARCHAR(1024) NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_carona`),
  INDEX `fk_carona_carro_idx` (`id_carro` ASC),
  UNIQUE INDEX `id_carona_UNIQUE` (`id_carona` ASC),
  CONSTRAINT `fk_carona_carro`
  FOREIGN KEY (`id_carro`)
  REFERENCES `carona_certa`.`carro` (`id_carro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `carona_certa`.`passageiro`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`passageiro` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`passageiro` (
  `id_passageiro` INT NOT NULL AUTO_INCREMENT,
  `id_carona` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_passageiro`),
  INDEX `fk_passageiro_carona_idx` (`id_carona` ASC),
  INDEX `fk_passageiro_usuario_idx` (`id_usuario` ASC),
  UNIQUE INDEX `id_passageiro_UNIQUE` (`id_passageiro` ASC),
  CONSTRAINT `fk_passageiro_carona`
  FOREIGN KEY (`id_carona`)
  REFERENCES `carona_certa`.`carona` (`id_carona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_passageiro_usuario`
  FOREIGN KEY (`id_usuario`)
  REFERENCES `carona_certa`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `carona_certa`.`atributo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`atributo` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`atributo` (
  `id_atributo` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_atributo`),
  UNIQUE INDEX `id_atributo_UNIQUE` (`id_atributo` ASC))
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `carona_certa`.`avaliacao`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`avaliacao` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`avaliacao` (
  `id_avaliacao` INT NOT NULL AUTO_INCREMENT,
  `id_atributo` INT NOT NULL,
  `id_carona` INT NOT NULL,
  `id_usuario_avaliador` INT NOT NULL,
  `id_usuario_avaliado` INT NOT NULL,
  `papel` TINYINT(1) NOT NULL,
  `nota` ENUM('0','1','2','3','4','5') NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_avaliacao`, `papel`),
  INDEX `fk_avaliacao_atributo_idx` (`id_atributo` ASC),
  INDEX `fk_avaliacao_carona_idx` (`id_carona` ASC),
  INDEX `fk_avaliacao_usuario_avaliador_idx` (`id_usuario_avaliador` ASC),
  INDEX `fk_avaliacao_usuario_avaliado_idx` (`id_usuario_avaliado` ASC),
  UNIQUE INDEX `avaliador_avaliado_UNIQUE` (`id_usuario_avaliador` ASC, `id_usuario_avaliado` ASC, `id_carona` ASC),
  UNIQUE INDEX `id_avaliacao_UNIQUE` (`id_avaliacao` ASC),
  CONSTRAINT `fk_avaliacao_atributo`
  FOREIGN KEY (`id_atributo`)
  REFERENCES `carona_certa`.`atributo` (`id_atributo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliacao_carona`
  FOREIGN KEY (`id_carona`)
  REFERENCES `carona_certa`.`carona` (`id_carona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliacao_usuario_avaliador`
  FOREIGN KEY (`id_usuario_avaliador`)
  REFERENCES `carona_certa`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_avaliacao_usuario_avaliado`
  FOREIGN KEY (`id_usuario_avaliado`)
  REFERENCES `carona_certa`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
  ENGINE = InnoDB
  DEFAULT CHARACTER SET = utf8
  COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `carona_certa`.`session`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `carona_certa`.`session` ;

CREATE TABLE IF NOT EXISTS `carona_certa`.`session` (
  `id_session` INT NOT NULL AUTO_INCREMENT,
  `key` VARCHAR(255) NULL,
  `id_usuario` INT NOT NULL,
  `created_at` DATE NULL,
  `updated_at` DATE NULL,
  PRIMARY KEY (`id_session`),
  INDEX `fk_session_usuario_idx` (`id_usuario` ASC),
  UNIQUE INDEX `id_session_UNIQUE` (`id_session` ASC),
  CONSTRAINT `fk_session_usuario`
  FOREIGN KEY (`id_usuario`)
  REFERENCES `carona_certa`.`usuario` (`id_usuario`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
