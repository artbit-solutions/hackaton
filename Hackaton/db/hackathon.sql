SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `hackathon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `hackathon`;

-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `node`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `node` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `class` VARCHAR(2) NOT NULL ,
  `taken` BOOLEAN NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `user_x_node`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `user_x_node` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fk_user` INT NOT NULL ,
  `fk_node` INT NOT NULL ,
  `lat` DOUBLE NOT NULL ,
  `long` DOUBLE NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_user_x_node_user` (`fk_user` ASC) ,
  INDEX `fk_user_x_node_node` (`fk_node` ASC) ,
  CONSTRAINT `fk_user_x_node_user`
    FOREIGN KEY (`fk_user` )
    REFERENCES `mydb`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_x_node_node`
    FOREIGN KEY (`fk_node` )
    REFERENCES `mydb`.`node` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
