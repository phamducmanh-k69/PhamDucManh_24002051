<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Header: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    http_response_code(200);
    exit;
}
$host = 'localhost';
$dbname = 'product';
$username = 'root';
$password = '';
try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e){
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Lỗi kết nối cơ sở dữ liệu."
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
// hàm định dạng JSON
function sendResponse($statusCode, $data){
    http_response_code($statusCode);
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}
// kiểm tra dữ liệu đầu vào hợp lệ
function validateProductInput($input){
    // lỗi
    if (!is_array($input)){
        return ["valid" => false, "message" => "Dữ liệu phải được định dạng JSON"];
    }
    $name = isset($input['name']) ? trim((string)$input['name']) : '';
    $length = mb_strlen($name, 'UTF-8');
    if ($length < 1 || $length > 100){
        return ["valid" => false, "message" => "Tên sản phẩm tron khoảng 1-100 ký tự."];
    }
    if (!isset($input['price']) || filter_var($input['price'], FILTER_VALIDATE_INT) === false || (int)($input['price']) <= 0){
        return ["valid" => false, "message" => "Giá tiền phải lơn hơn 0"];
    }
    if (!isset($input['stock']) || filter_var($input['stock'], FILTER_VALIDATE_INT) === false || (int)($input['stock']) < 0){
        return ["valid" => false, "message" => "Số lượng hàng không được âm"];
    }
    // thành công
    return [
        "valid" => true,
        "data" => [
            "name" => $name,
            "price" => (int)($input['price']),
            "stock" => (int)($input['stock'])
        ]
    ];
}
// lấy phương thức API
$method = $_SERVER['REQUEST_METHOD'];
// xử lý phương thức
switch ($method) {
    case 'GET': // trả về danh sách
        try {
            $stmt = $pdo->query("SELECT id, name, price, stock FROM products ORDER BY id ASC");
            $products = $stmt->fetchAll();
            foreach ($products as &$item){
                $item['id'] = (int)$item['id'];
                $item['price'] = (int)$item['price'];
                $item['stock'] = (int)$item['stock'];
            }
            sendResponse(200, [
                "success" => true,
                "data" => $products
            ]);
        } catch (PDOException $e){
            sendResponse(500, [
                "success" => false,
                "message" => "Lỗi khi lấy danh sách sản phẩm"
            ]);
        }
    case 'POST': // thêm sản phẩm mới
        $rawInput = file_get_contents("php://input"); // đọc dữ liệu thô từ request, không thể đọc $_POST thông thường
        $input = json_decode($rawInput, true); // decode rawInput thành mảng hợp lệ
        $validation = validateProductInput($input);
        if (!$validation['valid']){
            sendResponse(400, [
                "success" => false,
                "message" => $validation['message']
            ]);
        }
        $data = $validation['data'];
        try {
            $sql = "INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $data['name'],
                ':price' => $data['price'],
                ':stock' => $data['stock']
            ]);
            sendResponse(201, [
                "success" => true,
                "message" => "Thêm sản phẩm thành công",
                "id" => (int)$pdo->lastInsertId()
            ]);
        } catch (PDOException $e){
            sendResponse(500, [
                "success" => false,
                "message" => "Lỗi khi thêm sản phẩm"
            ]);
        }
        case 'PUT': // cập nhật sản phẩm
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : false;
        if ($id === false || $id <= 0){
            sendResponse(400, [
                "success" => false,
                "messange" => "ID sản phẩm không hợp lệ"
            ]);
        }
        $rawInput = file_get_contents("php://input");
        $input = json_decode($rawInput, true);
        $validation = validateProductInput($input);
        if (!$validation['valid']){
            sendResponse(400, [
                "success" => false,
                "message" => $validation["message"]
            ]);
        }
        $data = $validation['data'];
        try {
            // kiểm tra sản phẩm có tồn tại ?
            $checkstmt = $pdo->prepare("SELECT id FROM products WHERE id = :id");
            $checkstmt->execute([':id' => $id]);
            if (!$checkstmt->fetch()){
                sendResponse(404, [
                    "success" => false,
                    "message" => "Lỗi không tìm thấy sản phẩm có ID = $id"
                ]);
            }
            $sql = "UPDATE products SET name = :name, price = :price, stock = :stock WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $data['name'],
                ':price' => $data['price'],
                ':stock' => $data['stock'],
                ':id' => $id
            ]);
            sendResponse(200, [
                "success" => true,
                "message" => "Cập nhật sản phẩm thành công"
            ]);
        } catch (PDOException $e){
            sendResponse(500, [
                "success" => false,
                "message" => "Lỗi khi xoá sản phẩm"
            ]);
        }
        break;
    case 'DELETE':
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : false;
        if ($id === false || $id <= 0){
            sendResponse(400, [
                "success" => false,
                "message" => "ID sản phẩm không hợp lệ"
            ]);
        }
        try {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            if ($stmt->rowCount() === 0){
                sendResponse(404, [
                    "success" => false,
                    "message" => "Không tìm thấy sản phẩm ID= $id" 
                ]);
            }
            sendResponse(200, [
                "success" => true,
                "message" => "Xoá sản phẩm thành công"
            ]);
        } catch (PDOException $e){
            sendResponse(500, [
                "success" => false,
                "message" => "Lỗi khi xoá sản phẩm"
            ]);
        }
        break;
}
?>