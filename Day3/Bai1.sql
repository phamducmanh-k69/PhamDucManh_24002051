USE thuchanh;
CREATE TABLE cart_items(
	id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL
);
-- 1
INSERT INTO cart_items (name, price, quantity) VALUES
('iPhone 15 Pro', 12000000, 2),
('MacBook Air M3', 15000000, 1),
('Sony WH-1000XM5', 3500000, 3),
('RTX Series', 20000000, 3),
('Tai nghe AirPods Pro', 550000, 2),
('Sạc dự phòng Anker', 850000, 3),
('Dell XPS 13', 6990000, 5),
('Tai nghe có dây KKV', 79000, 10);
-- 2
SELECT * FROM cart_item;

-- 3
SELECT * FROM cart_item
WHERE price > 100000;

-- 4
SELECT * FROM cart_item
WHERE quantity > 5;

-- 5
SELECT * FROM cart_item
ORDER BY price DESC;

-- 6 
-- Cập nhật giá sản phẩm "Sạc dự phòng Anker"
UPDATE cart_item
SET price = 79000
WHERE name = "Sạc dự phòng Anker";

-- 7
-- Cập nhật số lượng của "MacBook Air M3"
UPDATE cart_item
SET quantity = 6
WHERE name = "MacBook Air M3";

-- 8
-- Xóa sản phẩm "Dell XPS 13"
DELETE FROM cart_item WHERE name = "Dell XPS 13";

-- 9
SELECT name, price, quantity, price*quantity as total FROM cart_item;

-- 10
SELECT SUM(price*quantity) as totalAmount FROM cart_item;