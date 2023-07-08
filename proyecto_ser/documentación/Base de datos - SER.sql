-- MySQL Script generated by MySQL Workbench
-- Wed Jul  5 13:24:26 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ser
-- -----------------------------------------------------
CREATE DATABASE ser;
USE ser;
-- -----------------------------------------------------
-- Table `persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `persona` (
  `id_persona` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(45) NULL,
  `apellidos` VARCHAR(45) NULL,
  `fecha_nacimiento` DATE NULL,
  `numero_documento` VARCHAR(45) NULL,
  `tipo_documento` VARCHAR(45) NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`id_persona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `id_persona` INT NOT NULL,
  `email` VARCHAR(45) NULL,
  `password` VARCHAR(45) NULL,
  `rol` VARCHAR(45) NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`id_usuario`, `id_persona`),
  CONSTRAINT `fk_usuario_persona`
    FOREIGN KEY (`id_persona`)
    REFERENCES `persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `servicio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `servicio` (
  `id_servicio` INT NOT NULL AUTO_INCREMENT,
  `id_categoria` INT NOT NULL,
  `id_persona` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `descripcion` VARCHAR(500) NULL,
  `precio` DOUBLE NULL,
  `fecha_publicacion` DATETIME NULL,
  `fecha_modificacion` DATETIME NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`id_servicio`, `id_categoria`, `id_persona`),
  CONSTRAINT `fk_servicio_categoria1`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `categoria` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_servicio_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `chat` (
  `id_chat` INT NOT NULL AUTO_INCREMENT,
  `id_servicio` INT NOT NULL,
  `fecha_creacion` DATETIME NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id_chat`, `id_servicio`),
  CONSTRAINT `fk_chat_servicio1`
    FOREIGN KEY (`id_servicio`)
    REFERENCES `servicio` (`id_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `conversacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `conversacion` (
  `id_conversacion` INT NOT NULL AUTO_INCREMENT,
  `id_persona` INT NOT NULL,
  `id_chat` INT NOT NULL,
  `fecha` DATETIME NULL,
  `mensaje` VARCHAR(200) NULL,
  PRIMARY KEY (`id_conversacion`, `id_persona`, `id_chat`),
  CONSTRAINT `fk_conversacion_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_conversacion_chat1`
    FOREIGN KEY (`id_chat`)
    REFERENCES `chat` (`id_chat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `persona_chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `persona_chat` (
  `id_persona_chat` INT NOT NULL AUTO_INCREMENT,
  `id_persona` INT NOT NULL,
  `id_chat` INT NOT NULL,
  PRIMARY KEY (`id_persona_chat`, `id_persona`, `id_chat`),
  CONSTRAINT `fk_persona_has_chat_persona1`
    FOREIGN KEY (`id_persona`)
    REFERENCES `persona` (`id_persona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_persona_has_chat_chat1`
    FOREIGN KEY (`id_chat`)
    REFERENCES `chat` (`id_chat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `calificacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `calificacion` (
  `id_calificacion` INT NOT NULL AUTO_INCREMENT,
  `id_servicio` INT NOT NULL,
  `id_chat` INT NOT NULL,
  `porcentaje` INT NULL,
  `fecha` DATETIME NULL,
  `estado` TINYINT NULL,
  PRIMARY KEY (`id_calificacion`, `id_servicio`, `id_chat`),
  CONSTRAINT `fk_calificacion_servicio1`
    FOREIGN KEY (`id_servicio`)
    REFERENCES `servicio` (`id_servicio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_calificacion_chat1`
    FOREIGN KEY (`id_chat`)
    REFERENCES `chat` (`id_chat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
