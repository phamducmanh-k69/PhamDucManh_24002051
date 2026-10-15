<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
</head>
<body>
<?php if (isset($_SESSION['username'])): ?>
    <p>
        Xin chào, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> |
        <a href="logout.php">Đăng xuất</a>
    </p>
    <hr>
<?php endif; ?>