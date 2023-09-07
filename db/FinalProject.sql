DROP DATABASE IF EXISTS final_project;

CREATE DATABASE IF NOT EXISTS final_project;

USE final_project;

DROP TABLE IF EXISTS games;

DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pwd VARCHAR(255) NOT NULL,
    registrationTime DATETIME NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS games (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    tries INT NOT NULL,
    won BOOLEAN NOT NULL,
    levelCompleted INT NOT NULL,
    date DATETIME NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);