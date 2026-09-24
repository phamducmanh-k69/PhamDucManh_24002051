<?php
// 1 Class Movie
class Movie{
    public $id;
    public $title;
    public $price;
    public $totalSeats;
    public $availableSeats;
    public function __construct($id, $title, $price, $totalSeats){
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->totalSeats = $totalSeats;
        $this->availableSeats = $totalSeats;
    }
// 2 Các method của Movie
    public function bookTicket($quantity){
        if ($quantity <= 0){
            echo "Số vé không được nhỏ hơn 0" . "<br>";
            return false;
        }
        if ($quantity > $this->availableSeats){
            echo "Số vé quá số chỗ ngồi hiện tại" . "<br>";
            return false;
        }
        $this->availableSeats -= $quantity;
        echo "Đặt vé ". $this->title . " với số lượng: ". $quantity . " thành công <br>";
        return true;
    }
    public function cancelTicket($quantity){
        if ($quantity <= 0){
            echo "Số vé phải lớn hơn 0" . "<br>";
            return false;
        }
        if ($quantity > $this->getSoldSeats()){
            echo "Số huỷ vượt quá số vé đã bán <br>";
            return false;
        }
        $this->availableSeats += $quantity;
         echo "Huỷ vé ". $this->title . " với số lượng: ". $quantity . " thành công <br>";
        return true;
    }
    public function getSoldSeats(){
        return $this->totalSeats - $this->availableSeats;
    }
    public function getRevenue(){
        return $this->getSoldSeats()*$this->price;

    }
    public function displayInfo(){
        echo " | ID: " . $this->id . " | Title: " . $this->title . " | Price: " . $this->price . " | Total seats: " . $this->totalSeats . " | Available seats: " . $this->availableSeats . "<br>" .
        "Số vé đã bán: " . $this->getSoldSeats() . "<br>" . "Doanh thu: " . $this->getRevenue() . "<br>";
    }
}
// 3 Function xử lý danh sách phim
function findMovieById($movies, $id){
    foreach($movies as $movie){
        if ($movie->id == $id){
            return $movie;
        } 
    }
    return null;
}
function getTotalRevenue($movies){
    if (empty($movies)){
        return 0;
    }
    $totalRevenue = 0;
    foreach($movies as $movie){
        $totalRevenue += $movie->getRevenue();
    }
    return $totalRevenue;
}
function getBestSellingMovie($movies){
    if (empty($movies)){
        return null;
    }
    $bestSelling = $movies[0];
    foreach($movies as $movie){
        if ($movie->getSoldSeats() > $bestSelling->getSoldSeats()){
            $bestSelling = $movie;
        }
    }
    return $bestSelling;
}
?>