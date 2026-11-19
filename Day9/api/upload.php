<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(200);
    exit;
}
// hàm trả về JSON
function sendResponse($statusCode, $data){
    http_response_code($statusCode);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    sendResponse(405, [
        "success" => false,
        "message" => "Chỉ hỗ trợ phương thức POST."
        ]);
}
$host = 'localhost';
$dbname = 'product';
$username = 'root';
$password = 'Cailamvai24!';
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e){
    sendResponse(500, [
        "success" => false,
        "message" => "Lỗi kết nối cơ sở dữ liệu"
    ]);
}
// Kiểm tra mã id gửi lên từ formdata
$productId = isset($_POST['id']) ? filter_var($_POST['id'], FILTER_VALIDATE_INT) : false;
if ($productId === false || $productId <= 0){
    sendResponse(400,[
        "success" => false,
        "message" => "Mã sản phẩm không hợp lệ."
    ]);
}
// kiểm tra sản phẩm tồn tại trong DB và lấy đường dẫn ảnh cũ
$checkstmt = $pdo->prepare("SELECT id, image FROM products WHERE id = :id");
$checkstmt->execute([':id' => $productId]);
$product = $checkstmt->fetch();
if (!$product){
    sendResponse(404, [
        "success" => false,
        "message" => "Không tìm thấy sản phẩm"
    ]);
}
//Kiểm tra file tải lên
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK){
    sendResponse(400, [
        "success" => false,
        "message" => "Chưa chọn file hoặc đang bị gián đoạn."
    ]);
}
$file = $_FILES['image'];
$maxSize = 2 * 1024 * 1024; // 2MB
// kiểm tra dung lượng
if ($file['size'] > $maxSize){
    sendResponse(400, [
        "success" => false,
        "message" => "Dung lượng vượt quá cho phép"
    ]);
}
// kiểm tra loại ảnh băng finfo (đọc mã nhị phân của ảnh)
    // Tạo đối tượng finfo
 $finfo = new finfo(FILEINFO_MIME_TYPE);
    // đọc MIME type của file (MIME loại dữ liệu của file)
 $realMimeType = $finfo->file($file['tmp_name']);
    //định dạng cho phép
 $allowedMimeTypes = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png'
 ];
 if (!array_key_exists($realMimeType, $allowedMimeTypes)){
    sendResponse(400, [
        "success" => false,
        "message" => "Chỉ chấp nhận định dạng jpg, jpeg hoặc png."
    ]);
 }
    // Tạo tên file và lưu thư , mục hiện tại 
$uploadDir = __DIR__ . '/../uploads/';
if (!is_dir($uploadDir)){
    mkdir($uploadDir, 0777, true); // tạo uploads nếu chưa tồn tại
}
$extension = $allowedMimeTypes[$realMimeType];
    // tên file được tạo theo prod_mã id_chuỗi định danh_định dạng ảnh
$uniqueFileName = 'prod_' . $productId . '_' . uniqid() . '.' . $extension;
$destinationPath = $uploadDir . $uniqueFileName;
    // đường dẫn để lưu vào DB, thẻ <img src=""> tại html sẽ đọc được
$dbImagePath = 'uploads/' . $uniqueFileName;
if (!move_uploaded_file($file['tmp_name'], $destinationPath)){
    sendResponse(500, [
        "success" => false,
        "message" => "Không thể lưu file ảnh vào thư mục."
    ]);
}
// cập nhật đường dẫn vào csdl
try {
    $updateStmt = $pdo->prepare("UPDATE products SET image = :image WHERE id = :id");
    $updateStmt->execute([
        ':image' => $dbImagePath,
        ':id' => $productId
    ]);
    // xoá file ảnh cũ trên đĩa sau kh cập nhật vào db thành công
    if (!empty($product['image'])) {
        $oldFilePath = __DIR__ . '/../' . $product['image'];
        if (file_exists($oldFilePath)){
            @unlink($oldFilePath);
        }
    }
    sendResponse(200, [
        "success" => true,
        "message" => "Tải ảnh thành công",
        "image" => $dbImagePath
    ]);
} catch (PDOException $e){
    // lỗi db xoá file vừa upload
    if (file_exists($destinationPath)){
        @unlink($destinationPath);
    }
    sendResponse(500, [
        "success" => false,
        "message" => "Lỗi khi cập nhật vào csdl."
        ]);
}
?>