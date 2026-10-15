<?php
session_start();
// file phân quyền, chỉ cho người đã đăng nhập truy cập vào, nếu chưa trở lại trang login
// sử dụng để require trong cả 4 file
if (!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}
?>