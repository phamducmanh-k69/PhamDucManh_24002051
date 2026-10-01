USE thuchanh;
CREATE TABLE movies(
	id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    price  DECIMAL(10,2) NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL
);

-- 1
INSERT INTO movies (title, price, total_seats, available_seats) VALUES 
('Đào, Phở và Piano', 60000.00, 150, 45),
('Mai', 85000.00, 200, 0),
('Lật Mặt 7: Một Điều Ước', 90000.00, 180, 12),
('Kẻ Trộm Mặt Trăng 4', 75000.00, 120, 85),
('Thám Tử Lừng Danh Conan', 80000.00, 150, 30),
('Hành Tinh Cát: Phần Hai', 110000.00, 250, 140),
('Godzilla x Kong: Đế Chế Mới', 95000.00, 220, 65),
('Deadpool & Wolverine', 120000.00, 200, 98),
('Inside Out 2', 75000.00, 160, 50),
('Kung Fu Panda 4', 70000.00, 140, 22);

-- 2
SELECT * FROM movies;

-- 3
SELECT * FROM movies
WHERE price > 100000;

-- 4
SELECT * FROM movies
WHERE total_seats > 50;

-- 5
SELECT * FROM movies
ORDER BY price DESC;

-- 6
-- Cập nhật số ghế còn lại của phim 'Mai'
UPDATE movies
SET available_seats = 10
WHERE title = 'Mai';

-- 7
DELETE FROM movies
WHERE title = 'Deadpool & Wolverine';

-- 8
SELECT title, price, total_seats, available_seats, (total_seats - available_seats) AS ticketSold FROM movies;

-- 9
SELECT title, price, total_seats, available_seats, (total_seats - available_seats) * price AS turnover FROM movies;

-- 10
SELECT SUM((total_seats - available_seats) * price) AS turnover FROM movies;

-- 11
SELECT title, price, total_seats, available_seats, (total_seats - available_seats) AS ticketSold FROM movies
WHERE (total_seats - available_seats) = (SELECT MAX(total_seats - available_seats) FROM movies);