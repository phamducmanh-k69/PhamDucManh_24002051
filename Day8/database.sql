CREATE DATABASE product;
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price INT CHECK (price > 0),
    stock INT CHECK (stock >= 0)
);
USE product;
INSERT INTO products (name, price, stock) VALUES
(N'Bút bi', 5000, 20),
(N'Vở ô ly', 12000, 15),
(N'Thước kẻ', 8000, 0);