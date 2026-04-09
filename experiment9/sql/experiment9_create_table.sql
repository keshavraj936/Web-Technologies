-- Run this SQL in phpMyAdmin or MySQL CLI to create the products table
CREATE DATABASE IF NOT EXISTS wt_ecommerce;
USE wt_ecommerce;
CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  description TEXT,
  image_url VARCHAR(255)
);