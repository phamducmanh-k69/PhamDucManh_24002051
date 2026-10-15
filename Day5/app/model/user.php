<?php 
require_once __DIR__ . '/../common/dbConnect.php';
// kiểm tra user
function getUserByUserName($username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt ->execute(['username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// thêm user vào nếu chưa đăng nhập (đăng ký)
function addUser($username, $password) {
    global $conn;
    $hash = password_hash($password, PASSWORD_DEFAULT);   // mã hóa trước khi lưu
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    return $stmt->execute(['username' => $username, 'password' => $hash]);
}
?>
