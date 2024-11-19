CREATE DATABASE db_task_manager;

CREATE USER 'appuser'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON db_task_manager.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;


USE db_task_manager;

CREATE TABLE IF NOT EXISTS `user` (
    `user_id` INT(10) NOT NULL AUTO_INCREMENT, 
    `firstName` VARCHAR(50) NOT NULL,
    `lastName` VARCHAR(50) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `username` VARCHAR (30) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    PRIMARY KEY(`user_id`)
);