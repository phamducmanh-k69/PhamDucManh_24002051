<?php
session_start();
require_once 'model/user.php';

// Đã đăng nhập thì không cần đăng ký
if (isset($_SESSION['user_id'])) {
    header('Location: product_list.php');
    exit;
}

$errors = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '') {
        $errors[] = "Tên đăng nhập không được để trống.";
    } elseif (mb_strlen($username) > 50) {
        $errors[] = "Tên đăng nhập tối đa 50 ký tự.";
    } elseif (getUserByUserName($username)) {
        // Tên đăng nhập chưa tồn tại trong database
        $errors[] = "Tên đăng nhập đã tồn tại.";
    }
    if (trim($password) === '') {
        $errors[] = "Mật khẩu không được để trống.";
    }

    if (empty($errors)) {
        try {
            // password_hash() được gọi bên trong addUser()
            addUser($username, $password);
            // chuyển hướng sau khi đăng nhập thành công
            header('Location: login.php?registered=1');
            exit;
        } catch (PDOException $e) {
            $errors[] = "Đăng ký thất bại. Vui lòng thử lại.";
        }
    }
}

include 'view/header.php';
foreach ($errors as $error) {
    echo '<p style="color:red">' . htmlspecialchars($error) . '</p>';
}
?>
<h2>Đăng ký</h2>
<form method="POST">
    Tên đăng nhập: <input type="text" name="username" value="<?= htmlspecialchars($username) ?>"><br><br>
    Mật khẩu: <input type="password" name="password"><br><br>
    <button type="submit">Đăng ký</button>
</form>
<p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
<?php include 'view/footer.php'; ?>
