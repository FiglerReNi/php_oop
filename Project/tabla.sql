usersCREATE DATABASE `gallerysystem`; 

CREATE TABLE `gallerysystem`.`users`(  
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255),
  `password` VARCHAR(255),
  `first_name` VARCHAR(255),
  `last_name` VARCHAR(255),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_password` (`username`, `password`)
) CHARSET=utf8 COLLATE=utf8_hungarian_ci;

CREATE TABLE `gallerysystem`.`photos`(  
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255),
  `description` TEXT,
  `filename` VARCHAR(255),
  `type` VARCHAR(255),
  `size` INT(11),
  PRIMARY KEY (`id`)
) CHARSET=utf8 COLLATE=utf8_hungarian_ci;

ALTER TABLE `gallerysystem`.`photos`   
  ADD COLUMN `caption` VARCHAR(255) NULL AFTER `title`,
  ADD COLUMN `alternate_text` VARCHAR(255) NULL AFTER `description`;