SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Users` (
  `fname` VARCHAR(20) NULL ,
  `lname` VARCHAR(20) NULL ,
  `user_id` INT NOT NULL ,
  `username` VARCHAR(45) NULL ,
  `password` VARCHAR(45) NULL ,
  PRIMARY KEY (`user_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Band`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Band` (
  `band_id` INT NOT NULL ,
  `band_name` VARCHAR(45) NULL ,
  PRIMARY KEY (`band_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Song`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Song` (
  `song_id` INT NOT NULL ,
  `song_name` VARCHAR(45) NULL ,
  `band_id` INT NULL ,
  PRIMARY KEY (`song_id`) ,
  INDEX `band_id` (`band_id` ASC) ,
  CONSTRAINT `band_id`
    FOREIGN KEY (`band_id` )
    REFERENCES `mydb`.`Band` (`band_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Part`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`Part` (
  `part_id` INT NOT NULL ,
  `location` VARCHAR(45) NULL ,
  `song_id` INT NULL ,
  PRIMARY KEY (`part_id`) ,
  INDEX `song_id` (`song_id` ASC) ,
  CONSTRAINT `song_id`
    FOREIGN KEY (`song_id` )
    REFERENCES `mydb`.`Song` (`song_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`BandsIn`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`BandsIn` (
  `band_id` INT NULL ,
  `user_id` INT NULL ,
  `instrument` INT NULL ,
  `part_id` INT NULL ,
  `directorFlag` TINYINT(1) NULL ,
  INDEX `band_id` (`band_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  INDEX `part_id` (`part_id` ASC) ,
  CONSTRAINT `band_id`
    FOREIGN KEY (`band_id` )
    REFERENCES `mydb`.`Band` (`band_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `mydb`.`Users` (`user_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `part_id`
    FOREIGN KEY (`part_id` )
    REFERENCES `mydb`.`Part` (`part_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
