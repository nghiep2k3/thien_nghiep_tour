<?php
// Headers (thiết lập cho API trả về JSON)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Bao gồm các file cần thiết
include_once '../config/db.php';
include_once '../models/AccountModel.php';

// Khởi tạo kết nối cơ sở dữ liệu
$database = new db();
$db = $database->connect();

// Khởi tạo model
$account = new AccountModel($db);

// Nhận dữ liệu từ yêu cầu POST (JSON)
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra nếu username và password được gửi qua API
if (!empty($data->username) && !empty($data->password)) {
    // Gán các thuộc tính của model bằng dữ liệu đầu vào
    $account->username = $data->username;
    $account->password = $data->password;
    
    // Thực hiện kiểm tra đăng nhập
    $result = $account->login();
    
    if ($result) {
        // Nếu đăng nhập thành công, trả về thông tin người dùng kèm theo dữ liệu từ bảng profile
        echo json_encode(array(
            'message' => 'Login successful',
            'account_id' => $result['account_id'],
            'username' => $result['username'],
            'profile' => array(
                'id' => $result['profile_id'],
                'number_phone' => $result['number'],
                'password' => $result['password'],
                'address' => $result['address'],
                'create_id' => $result['create_id'],
                'role' => $result['role']
            )
        ));
    } else {
        // Nếu đăng nhập thất bại, trả về thông báo lỗi
        echo json_encode(array('message' => 'Login failed. Incorrect username or password.'));
    }
} else {
    // Nếu không nhận được dữ liệu đầu vào, trả về thông báo lỗi
    echo json_encode(array('message' => 'Incomplete data.'));
}
