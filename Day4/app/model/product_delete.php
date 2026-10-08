<?php
require_once __DIR__ . '/../model/product.php';
$id = $_GET['id'] ?? null;
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['confirm']) && $_POST['confirm'] === 'yes'){
        deleteProduct($id);
    }
    header('Location: product_list.php');
    exit;
}
include __DIR__ . '/../view/header.php';
?>
<form method="POST">
    <p>Xác nhận xóa sản phẩm ?</p>
    <button type="submit" name = "confirm" value="yes">Xác nhận</button>
</form>
<?php include __DIR__ . '/../view/footer.php'; ?>