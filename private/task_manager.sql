CREATE DATABASE db_task_manager;

GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON task_manager.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE task_manager;

CREATE TABLE IF NOT EXISTS 'user' (
    'user_id' INT(10) NOT NULL AUTO_INCREMENT,
    'firstName' VARCHAR(50) NOT NULL,
    'lastName' VARCHAR(50) NOT NULL,
    'email' VARCHAR(100) NOT NULL,
    'username' VARCHAR (30) NOT NULL,
    'password' VARCHAR(50) NOT NULL,
    PRIMARY KEY('id');
);