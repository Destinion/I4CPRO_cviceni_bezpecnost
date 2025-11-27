CREATE DATABASE IF NOT EXISTS security_demo;
USE security_demo;


CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
role ENUM('user','admin') DEFAULT 'user'
);


-- Vložení administrátora (heslo: admin123 jako příklad - po nasazení změňte)
-- Heslo je zde uloženo jako bcrypt hash - Nahradit hash svým vlastním pomocí PHP password_hash
INSERT INTO users (username, password, role) VALUES
('admin', '$2y$10$e0NRf0kqO9a6bYq7J8s1E.OzW8YwQG5Q0g4f9s6yR0qSxk0u1b2mW', 'admin');


CREATE TABLE comments (
id INT AUTO_INCREMENT PRIMARY KEY,
author VARCHAR(50) NOT NULL,
content TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);