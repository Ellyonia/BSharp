SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `BSharp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `BSharp` ;

-- -----------------------------------------------------
-- Table `BSharp`.`Users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BSharp`.`Users` (
  `fname` VARCHAR(20) NOT NULL ,
  `lname` VARCHAR(20) NOT NULL ,
  `user_id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`user_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BSharp`.`Band`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BSharp`.`Band` (
  `band_id` INT NOT NULL AUTO_INCREMENT,
  `band_name` VARCHAR(45) NOT NULL ,
  `band_phone` VARCHAR(15) NOT NULL ,
  `band_info` VARCHAR(2000) NULL ,
  `events` VARCHAR(2000) NULL ,
  PRIMARY KEY (`band_id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BSharp`.`Pieces`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BSharp`.`Pieces` (
  `piece_id` INT NOT NULL AUTO_INCREMENT,
  `piece_name` VARCHAR(45) NOT NULL ,
  `band_id` INT NOT NULL ,
  PRIMARY KEY (`piece_id`) ,
  INDEX `band_id` (`band_id` ASC) ,
  CONSTRAINT `band_id`
    FOREIGN KEY (`band_id` )
    REFERENCES `BSharp`.`Band` (`band_id` )
    ON DELETE CASCADE 
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `BSharp`.`BandsIn`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `BSharp`.`BandsIn` (
  `band_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `instrument` VARCHAR(45) NOT NULL ,
  `part_id` INT NOT NULL ,
  `directorFlag` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`band_id`, `user_id`) ,
  INDEX `band_id` (`band_id` ASC) ,
  INDEX `user_id` (`user_id` ASC) ,
  INDEX `part_id` (`part_id` ASC) ,
  CONSTRAINT `bandid`
    FOREIGN KEY (`band_id` )
    REFERENCES `BSharp`.`Band` (`band_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id` )
    REFERENCES `BSharp`.`Users` (`user_id` )
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

