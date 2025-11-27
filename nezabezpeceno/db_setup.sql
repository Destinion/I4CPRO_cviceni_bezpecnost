CREATE DATABASE IF NOT EXISTS security_demo;
USE security_demo;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL -- schválně jako plaintext v začáteční verzi
);

INSERT INTO users (username, password)
VALUES ('admin', 'admin123'); -- záměrně slabé heslo

CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(50),
    content TEXT
);
