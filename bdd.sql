CREATE DATABASE IF NOT EXISTS evalphp2025 CHARSET utf8mb4;
USE evalphp2025;

CREATE TABLE IF NOT EXISTS users (
    id_users INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(50) NOT NULL,
    lastname VARCHAR(50) NOT NULL,
    email VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS category (
    id_category INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) UNIQUE NOT NULL
)ENGINE=innoDB;

CREATE TABLE IF NOT EXISTS book (
    id_book INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    publication_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    author VARCHAR(50),
    id_category INT,
    id_users INT,
    CONSTRAINT fk_book_category FOREIGN KEY(id_category) REFERENCES category(id_category) ON DELETE CASCADE,
    CONSTRAINT fk_book_user FOREIGN KEY(id_users) REFERENCES users(id_users) ON DELETE CASCADE
)ENGINE=innoDB;



