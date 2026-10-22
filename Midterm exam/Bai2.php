<?php
$giaSanPham = [20000000, 15000, 15000, 30000, 59999, 13.456, 45000, 1000000, 1000000];
function calculateTotal($array){
    $sum = 0;
    foreach ($array as $price){
        $sum += $price;
    }
    return $sum;
}
function findMaxPrice($array){
    $maxPrice = $array[0];
    foreach ($array as $price){
        if ($maxPrice < $price){
            $maxPrice = $price;
        }
    }
    return $maxPrice;
}
echo "Tong gia san pham: " . calculateTotal($giaSanPham) . "<br>";
echo "Gia san pham cao nhat: " . findMaxPrice($giaSanPham);
?>