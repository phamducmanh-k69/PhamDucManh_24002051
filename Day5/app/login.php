<?php
session_start();
require_once 'model/user.php';
require_once 'common/dbConnect.php';
if (isset($_SESSION['user_id'])){
    header('Location: product_list.php');
    exit;
}
$errors = '';
$username = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $user = getUserByUserName($username);
    if ($user && password_verify($password, $user['password'])){
        // đổi mã phiên sau khi đăng nhập
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: product_list.php');
        exit;
    }
    $errors = "Tên đăng nhập hoặc mật khẩu không đúng";
}
include 'view/header.php';
if($errors !== ''){
    echo '<p style="color:red">' . htmlspecialchars($errors) . '</p>';
}
?>
<h2>Đăng nhập</h2>
<form method="POST">
    Tên đăng nhập: <input type="text" name = "username" value="<?= htmlspecialchars($username) ?>"><br><br>
    Mật khẩu: <input type="password" name="password"><br><br>
    <button type="submit"> Đăng nhập </button>
    <p> Chưa có tài khoản ?<a href="register.php">Đăng ký</a></p>
</form>
<?php include 'view/footer.php'; ?>
