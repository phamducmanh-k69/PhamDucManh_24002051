<?php
require_once __DIR__ . '/../model/product.php';
$errors = [];
$name = '';
$price = '';
$quantity = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];


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
        addProduct($name, $price, $quantity);
        header('Location: product_list.php');
        exit;
    } else {
        foreach ($errors as $error){
            echo $error . "<br>";
        }
    }
}
include __DIR__ . '/../view/header.php';
?>
<form method="POST">
    Tên sản phẩm: <input type="text" name="name"><br>
    Giá: <input type="number" name="price"><br>
    Số lượng: <input type="number" name="quantity"><br>
    <button type="submit">Thêm</button>
</form>
<?php include __DIR__ . '/../view/footer.php'; ?>