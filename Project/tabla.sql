CREATE DATABASE `gallerysystem`; 

CREATE TABLE `gallerysystem`.`users`(  
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255),
  `password` VARCHAR(255),
  `first_name` VARCHAR(255),
  `last_name` VARCHAR(255),
  PRIMARY KEY (`id`),
  UNIQUE INDEX `user_password` (`username`, `password`)
) CHARSET=utf8 COLLATE=utf8_hungarian_ci;