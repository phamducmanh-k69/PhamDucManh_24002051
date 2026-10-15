<?php 
    require_once 'common/dbConnect.php';
    $hash = password_hash('123456', PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:u, :p)");
    $stmt->execute(['u' => 'admin', 'p' => $hash]);
    echo "Đã tạo tài khoản admin";
?>