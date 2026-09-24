<?php
require_once 'CartItem.php';
class ShoppingCart{
    public array $items = [];
    public function addItem($item){
        if ($item->price <= 0){
            echo "Sản phẩm " . $item->name . " không hợp lệ! <br> Giá sản phầm phải lớn hơn 0 <br>";
            return false;
        }
        if ($item->quantity <= 0){
            echo "Sản phẩm " . $item->name . " không hợp lệ! <br> Số lượng sản phầm phải lớn hơn 0 <br>";
            return false;
        }
        $this->items[] = $item;
        echo "Thêm sản phẩm " . $item->name . " thành công. <br>";
        return true;
    }
    public function removeItem($name){
        foreach($this->items as $key=>$item){
            if (strcasecmp($item->name, $name) === 0){
                unset($this->items[$key]);
                $this->items = array_values($this->items);
                echo "Đã xóa thành công sản phẩm" . $name;
                return true;
            }
        }    
        echo "Không tìm thấy sản phẩm" . $name;
        return false;    
        
    }
    public function calculateTotal(){
        $total = 0;
        foreach($this->items as $item){
            $total += $item->getTotal();
        }
        return $total;
    }
    public function displayCart(){
        echo "Danh sách các sản phẩm";
        if (empty($this->items)){
            echo "Danh sách trống". "<br>";
        }
        foreach($this->items as $item){
            echo $item->name . " | Giá: " . $item->price . " | Số lượng: " . $item->quantity . " (Thành tiền: " . $item->getTotal() . ")<br>";
        }
        echo "Tổng tiền: " . $this->calculateTotal(); 
    }

}
?>
