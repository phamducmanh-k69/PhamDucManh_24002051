<?php 
require_once __DIR__ . '/../common/dbConnect.php';
function getUserByUserName($username){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt ->execute(['username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>