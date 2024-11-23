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

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    priority ENUM('high', 'medium', 'low') DEFAULT 'medium',
    due_date DATE NOT NULL,
    status ENUM('pending', 'in-progress', 'completed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);