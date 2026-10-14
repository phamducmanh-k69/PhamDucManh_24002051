<?php
require_once 'model/product.php';
$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
$product = $id ? getProductById($id) : false; // kiểm tra id sản phẩm
if ($product && $_SERVER['REQUEST_METHOD'] === 'POST'){
    if($_POST['confirm'] === 'yes'){
        deleteProduct($id);
    }
    header('Location: product_list.php');
    exit;
}
include 'view/header.php';
if (!$product):
?>
    <p>Sản phẩm không tồn tại.</p>
    <a href="product_list.php">Quay lại danh sách</a>
<?php else: ?>
    <form method="POST">
        <p>Xác nhận xóa sản phẩm "<?=htmlspecialchars($product['name']) ?>" ?</p>
        <button type="submit" name = "confirm" value="yes">Xác nhận</button>
        <a href="product_list.php">Huỷ</a>
    </form>
<?php endif; include 'view/footer.php'; ?>
