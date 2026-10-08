<?php
require_once __DIR__ . '/../model/product.php';
$id = $_GET['id'] ?? null;
if (!$id){
    header('Location: product_list.php');
    exit;
}
$product = getProductById($id);
if (!$product){
    echo "Sản phẩm không tồn tại";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $errors = [];
        if (empty($name)){
            $errors[] = "Tên không được rỗng";
        }
        if ($price <= 0){
            $errors[] =  "Sản phẩm " . $name . " không hợp lệ! <br> Giá sản phầm phải lớn hơn 0 <br>";
        }
        if ($quantity < 0){
            $errors[] = "Sản phẩm " . $name . " không hợp lệ! <br> Số lượng sản phầm phải lớn hơn 0 <br>";
        }
    if (empty($errors)){
        updateProduct($id, $name, $price, $quantity);
        header('Location: product_list.php');
        exit;
    } else {
        foreach ($errors as $error){
            echo $error . "<br>";
        }
    }
    // $product['name'] = $name;
    // $product['price'] = $price;
    // $product['quantity'] = $quantity;

}
include __DIR__ . '/../view/header.php';
?>
<form method="POST">
    Tên sản phẩm: <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>"><br><br>
    Giá: <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>"><br><br>
    Số lượng: <input type="number" name="quantity" value="<?= $product['quantity'] ?>"><br><br>
    <button type="submit">Cập nhật</button>
    <a href="product_list.php">Hủy</a>
</form>
<?php include __DIR__ . '/../view/footer.php'; ?>