<?php
require_once 'common/auth.php';
require_once 'model/product.php';
$errors = [];
$name = '';
$price = '';
$quantity = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = trim($_POST['name'] ?? '');
        // 2 giá trị lấy ở đây là chuỗi. Ở PHP 8, chuỗi so sánh vơi 0 được coi như so sánh với "0"
        $price = trim($_POST['price'] ?? '');
        $quantity = trim($_POST['quantity'] ?? '');


    if ($name === "" || mb_strlen($name) > 100){
        $errors[] = "Tên không được rỗng vaf tối đa 100 ký tự";
    }
    if (!is_numeric($price) || $price <= 0 || $price > 99999999.99) {
        $errors[] = "Giá phải là số lớn hơn 0 và không vượt quá 99.999.999,99.";
    }
    if (filter_var($quantity, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 2147483647]]) === false || $quantity < 0){
        $errors[] = "Số lượng phải là số nguyên từ 0 đến 2.147.483.647.";
    }
    if (empty($errors)){
        try {
        // khi INSERT/UPDATE dẩy "abc" vào cột DECIMAL/INT, MySQL ở strict mode báo lỗi và PDOException không được bắt.
        addProduct($name, $price, $quantity);
        header('Location: product_list.php');
        exit;
        } catch (PDOException $e){
            $errors[] = "Không thể lưu sản phẩm. Vui lòng kiểm tra lại dữ liệu.";
        }
    }
}
include 'view/header.php';
    foreach ($errors as $error){
        echo '<p style="color:red">' . htmlspecialchars($error) . '</p>';
    }
?>
<form method="POST">
    Tên sản phẩm: <input type="text" name="name" value="<?= htmlspecialchars($name) ?>"><br>
    Giá: <input type="number" step="0.01" name="price" value ="<?= htmlspecialchars($price) ?>"><br>
    Số lượng: <input type="number" name="quantity" value="<?= htmlspecialchars($quantity) ?>"><br>
    <button type="submit">Thêm</button>
</form>
<?php include 'view/footer.php'; ?>
