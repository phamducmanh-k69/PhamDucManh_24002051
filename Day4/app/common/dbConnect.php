<?php
$servername = "localhost";
$username = "root";
$password = "Cailamvai24!";
$dbname = "shopping_cart";
try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname; charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>