<?php
require_once 'Movie.php';
// Yêu cầu Thực hiện
$movie1 = new Movie(1, "Avengers", 100000, 100);
$movie2 = new Movie(2, "Avatar", 120000, 80);
$movie3 = new Movie(3, "Batman", 90000, 120);
$movies = [$movie1, $movie2, $movie3];

// đặt vé Avengers
echo "<h2>--- ĐẶT VÉ AVENGERS ---</h2>";
$movie1->bookTicket(30);
$movie1->bookTicket(101); // vượt quá số ghế còn lại

// đặt vé Avatar
echo "<h2>--- ĐẶT VÉ AVATAR ---</h2>";
$movie2->bookTicket(50);

// Huỷ một số vé đã đặt Avenger
echo "<h2>--- HỦY VÉ AVENGERS ---</h2>";
$movie1->cancelTicket(29);

echo "<h2>--- THỬ CÁC TRƯỜNG HỢP KHÔNG HỢP LỆ ---</h2>";
// Đặt số vé <= 0
$movie1->bookTicket(0);
$movie1->bookTicket(-5);
// Hủy số vé <= 0
$movie1->cancelTicket(0);
$movie1->cancelTicket(-2);
// Hủy vé nhiều hơn số vé đã bán
$movie2->cancelTicket(1000);
// Tìm phim không tồn tại
$notFound = findMovieById($movies, 999);
if ($notFound === null){
    echo "Không tìm thấy phim ID = 999 <br>";
} else {
    $notFound->displayInfo();
}
// Danh sách phim rỗng khi gọi các function xử lý danh sách
$emptyMovies = [];
echo "Tổng doanh thu: " . getTotalRevenue($emptyMovies) . "<br>";
$bestOfEmpty = getBestSellingMovie($emptyMovies);
if ($bestOfEmpty === null){
    echo "Danh sách phim rỗng, không có phim bán chạy nhất <br>";
}
echo "<hr>";

// Hiển thị thông tin
echo "<h2>--- THÔNG TIN TẤT CẢ CÁC PHIM ---</h2>";
foreach($movies as $movie){
    $movie->displayInfo();
}
echo "<hr>";

// Tổng doanh thu của tất cả phim
echo "<h2>Tổng doanh thu:" . getTotalRevenue($movies) . "</h2>";
$bestMovie = getBestSellingMovie($movies);

// Phim bán chạy nhất
echo "<h2>--- Phim bán chạy nhất: ---</h2>";
if ($bestMovie !== null){
   $bestMovie->displayInfo();
} else {
    echo "Không có thông tin về phim <br>";
}
?>