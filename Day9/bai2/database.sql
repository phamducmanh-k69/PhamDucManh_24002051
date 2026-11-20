CREATE DATABASE IF NOT EXISTS product;
USE product;
CREATE TABLE IF NOT EXISTS products (
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
ALTER TABLE products
ADD COLUMN image VARCHAR(225) NULL AFTER stock;

USE product;

INSERT INTO products (name, price, stock) VALUES
(N'Bút bi xanh Thiên Long', 5000, 100),
(N'Vở kẻ ngang 120 trang', 12000, 80),
(N'Thước kẻ nhựa 20cm', 6000, 45),
(N'Băng keo trong cuộn nhỏ', 8000, 30),
(N'Kẹp bướm sắt 25mm hộp 12 cái', 14000, 20),
(N'Giấy note vàng 3x3 inch', 9000, 55),
(N'Bút xóa nước', 16000, 28),
(N'Túi đựng bút vải canvas', 35000, 15),
(N'Sổ tay lò xo A5', 24000, 22),
(N'Gọt bút chì 2 lỗ', 5000, 40),
(N'Bút lông dầu đen', 13000, 32),
(N'Bút chì 2B', 4000, 50),
(N'Tẩy gôm trắng', 3000, 40),
(N'Compa kim loại', 25000, 12),
(N'Bút dạ quang vàng', 10000, 30),
(N'Kéo thủ công', 18000, 15),
(N'Hồ dán khô', 7000, 25),
(N'Giấy kiểm tra A4', 15000, 60),
(N'Bìa kẹp hồ sơ', 9000, 35),
(N'Bảng con học sinh', 22000, 10),
(N'Phấn không bụi hộp 10 viên', 11000, 18);