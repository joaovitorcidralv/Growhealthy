-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema growhealthy
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema growhealthy
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `growhealthy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `growhealthy` ;

-- -----------------------------------------------------
-- Table `growhealthy`.`academia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `growhealthy`.`academia` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nomeFantasia` VARCHAR(100) NULL DEFAULT NULL,
  `cnpj` VARCHAR(14) NULL DEFAULT NULL,
  `login` VARCHAR(50) NULL DEFAULT NULL,
  `senha` VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cnpj_UNIQUE` (`cnpj` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `growhealthy`.`personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `growhealthy`.`personal` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `cref` VARCHAR(20) NULL DEFAULT NULL,
  `login` VARCHAR(50) NULL DEFAULT NULL,
  `senha` VARCHAR(50) NULL DEFAULT NULL,
  `celular` VARCHAR(14) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `dt_nasc` VARCHAR(45) NULL DEFAULT NULL,
  `genero` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NULL DEFAULT NULL,
  `academia_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cref` (`cref` ASC) VISIBLE,
  INDEX `academia_id` (`academia_id` ASC) VISIBLE,
  CONSTRAINT `personal_ibfk_1`
    FOREIGN KEY (`academia_id`)
    REFERENCES `growhealthy`.`academia` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `growhealthy`.`nutricionista`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `growhealthy`.`nutricionista` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `crn` VARCHAR(20) NULL DEFAULT NULL,
  `login` VARCHAR(50) NULL DEFAULT NULL,
  `senha` VARCHAR(50) NULL DEFAULT NULL,
  `celular` VARCHAR(14) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `dt_nasc` VARCHAR(45) NULL DEFAULT NULL,
  `genero` VARCHAR(45) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NULL DEFAULT NULL,
  `academia_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `crn` (`crn` ASC) VISIBLE,
  INDEX `academia_id` (`academia_id` ASC) VISIBLE,
  CONSTRAINT `nutricionista_ibfk_1`
    FOREIGN KEY (`academia_id`)
    REFERENCES `growhealthy`.`academia` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `growhealthy`.`aluno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `growhealthy`.`aluno` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL DEFAULT NULL,
  `cpf` VARCHAR(11) NULL DEFAULT NULL,
  `login` VARCHAR(50) NULL DEFAULT NULL,
  `senha` VARCHAR(50) NULL DEFAULT NULL,
  `celular` VARCHAR(14) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `dt_nasc` VARCHAR(45) NULL DEFAULT NULL,
  `genero` VARCHAR(45) NULL DEFAULT NULL,
  `peso` FLOAT NULL DEFAULT NULL,
  `altura` FLOAT NULL DEFAULT NULL,
  `restricoesFisicas` TEXT NULL DEFAULT NULL,
  `restricoesAlimentares` TEXT NULL DEFAULT NULL,
  `personal_id` INT NULL DEFAULT NULL,
  `nutricionista_id` INT NULL DEFAULT NULL,
  `academia_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf` (`cpf` ASC) VISIBLE,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE,
  INDEX `academia_id` (`academia_id` ASC) VISIBLE,
  INDEX `personal_id` (`personal_id` ASC) VISIBLE,
  INDEX `nutricionista_id` (`nutricionista_id` ASC) VISIBLE,
  CONSTRAINT `aluno_ibfk_1`
    FOREIGN KEY (`academia_id`)
    REFERENCES `growhealthy`.`academia` (`id`),
  CONSTRAINT `aluno_ibfk_2`
    FOREIGN KEY (`personal_id`)
    REFERENCES `growhealthy`.`personal` (`id`),
  CONSTRAINT `aluno_ibfk_3`
    FOREIGN KEY (`nutricionista_id`)
    REFERENCES `growhealthy`.`nutricionista` (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `growhealthy`.`dieta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `growhealthy`.`dieta` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` TEXT NULL DEFAULT NULL,
  `aluno_id` INT NULL DEFAULT NULL,
  `nutricionista_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `aluno_id` (`aluno_id` ASC) VISIBLE,
  INDEX `nutricionista_id` (`nutricionista_id` ASC) VISIBLE,
  CONSTRAINT `dieta_ibfk_1`
    FOREIGN KEY (`aluno_id`)
    REFERENCES `growhealthy`.`aluno` (`id`),
  CONSTRAINT `dieta_ibfk_2`
    FOREIGN KEY (`nutricionista_id`)
    REFERENCES `growhealthy`.`nutricionista` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `growhealthy`.`treino`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `growhealthy`.`treino` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` TEXT NULL DEFAULT NULL,
  `aluno_id` INT NULL DEFAULT NULL,
  `personal_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `aluno_id` (`aluno_id` ASC) VISIBLE,
  INDEX `personal_id` (`personal_id` ASC) VISIBLE,
  CONSTRAINT `treino_ibfk_1`
    FOREIGN KEY (`aluno_id`)
    REFERENCES `growhealthy`.`aluno` (`id`),
  CONSTRAINT `treino_ibfk_2`
    FOREIGN KEY (`personal_id`)
    REFERENCES `growhealthy`.`personal` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
