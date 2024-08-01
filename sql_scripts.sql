--Create a database
CREATE DATABASE minimart_catalog;

--Create a table
CREATE TABLE users (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) NOT NULL,
    `username` varchar(15) NOT NULL,
    `password` varchar(255) NOT NULL,
    `photo` varchar(255) DEFAULT NULL,
    PRIMARY KEY(`id`)
);

--Create a table
CREATE TABLE products (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    `description` text NOT NULL,
    `price`decimal(5,2) NOT NULL,
    `section_id` int(11) NOT NULL,
    PRIMARY KEY(`id`)
);

--Create a table
CREATE TABLE sections (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(50) NOT NULL,
    PRIMARY KEY(`id`)
);