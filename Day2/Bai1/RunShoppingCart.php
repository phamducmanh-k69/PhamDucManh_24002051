<?php
require_once 'CartItem.php';
require_once 'ShoppingCart.php';
// Tạo object ShoppingCart
$cart = new ShoppingCart();

// Tạo 4 CartItem
$item1 = new CartItem("iPhone 15 Pro", 1200, 2);
$item2 = new CartItem("MacBook Air M3", 1500, 1);
$item3 = new CartItem("Sony WH-1000XM5", 350, 3);
$item4 = new CartItem("RTX Series", 20000, 3);
// Thêm sản phẩm vào giỏ bằng addItem()
echo "<h2>--- THÊM SẢN PHẨM VÀO GIỎ HÀNG ---<h2>";
$cart->addItem($item1);
$cart->addItem($item2);
$cart->addItem($item3);
$cart->addItem($item4);
echo "<hr>";
// Hiển thị giỏ hàng LẦN 1
echo "<h2>--- TRẠNG THÁI GIỎ HÀNG BAN ĐẦU ---</h2>";
$cart->displayCart();
echo "<hr>";
// Tổng tiền giỏ hàng lần 1
echo "<h2>Tổng tiền giỏ hàng: " . $cart->calculateTotal() . "</h2>";

// Thử nghiệm xóa sản phẩm "MacBook Air M3" bằng phương thức removeItem()
echo "<h2>--- THỰC HIỆN XÓA SẢN PHẨM ---</h2>";
$cart->removeItem("MacBook Air M3");
echo "<hr>";

// Hiển thị lại giỏ hàng LẦN 2 (Sau khi đã xóa)
echo "<h2>--- GIỎ HÀNG SAU KHI CẬP NHẬT ---</h2>";
$cart->displayCart();

// Tổng tiền giỏ hàng lần 2
echo "<h2>Tổng tiền giỏ hàng sau khi cập nhật: " . $cart->calculateTotal() . "</h2>";
echo "<hr>";

// Thêm sản phẩm không hợp lệ
echo "<h2>--- THỬ THÊM SẢN PHẨM KHÔNG HỢP LỆ ---<h2>";
$InvalidItem1 = new CartItem("Tai nghe không dây", 0, 2);
$cart->addItem($InvalidItem1);
$InvalidItem2 = new CartItem("Tai nge có dây", 200, -123);
$cart->addItem($InvalidItem2);

// Xoá sản phẩm không hợp lệ
$cart->removeItem("Samsung Galaxy S24");
?>