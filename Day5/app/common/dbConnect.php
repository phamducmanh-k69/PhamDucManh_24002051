<?php
$servername = "localhost";
$username = "root";
$password = ""; // Cần để trống nếu chạy trên DB của XAMPP
$dbname = "shopping_cart";
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname; charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    // catch chỉ echo rồi chạy tiếp $conn không được gán
    // echo "Kết nối thất bại: " . htmlspecialchars($e->getMessage());
    // Trường hợp thất bại phải dừng hẳn chương trình
    die("Kết nối thất bại: " . htmlspecialchars($e->getMessage()));
}
?>
