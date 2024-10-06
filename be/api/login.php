<?php
// Headers (thiết lập cho API trả về JSON)
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Bao gồm các file cần thiết
include_once '../config/db.php';
include_once '../models/login.php';

// Khởi tạo kết nối cơ sở dữ liệu
$database = new db();
$db = $database->connect();

// Khởi tạo model
$account = new Login($db);

// Nhận dữ liệu từ yêu cầu POST (JSON)
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra nếu username và password được gửi qua API
if (!empty($data->username) && !empty($data->password)) {
    // Gán các thuộc tính của model bằng dữ liệu đầu vào
    $account->username = $data->username;
    
    // Thực hiện truy vấn để lấy dữ liệu người dùng
    $result = $account->login();
    
    if ($result) {
        // Kiểm tra mật khẩu người dùng đã gửi có trùng khớp với mật khẩu đã mã hóa trong cơ sở dữ liệu không
        if (password_verify($data->password, $result['password'])) {
            // Nếu mật khẩu trùng khớp, trả về thông tin người dùng
            echo json_encode(array(
                'message' => 'Login successful',
                'profile' => array(
                    'id' => $result['sign_up_id'],  // Lấy từ bảng sign_up
                    'user_id' => $result['user_id'],  // Lấy từ bảng profile
                    'name' => $result['real_name'],  // Lấy từ bảng sign_up
                    'username' => $result['username'],  // Lấy từ bảng sign_up
                    'password' => $result['password'],  // Lấy từ bảng sign_up (mã hóa)
                    'address' => $result['address'],  // Lấy từ bảng profile
                    'number' => $result['number'],  // Số điện thoại lấy từ bảng profile
                    'role' => $result['role'],  // Lấy từ bảng sign_up
                    'create_id' => $result['create_id']  // Lấy từ bảng sign_up
                )
            ));
        } else {
            // Nếu mật khẩu không trùng khớp, trả về thông báo lỗi
            echo json_encode(array('message' => 'Login failed. Incorrect password.'));
        }
    } else {
        // Nếu không tìm thấy username, trả về thông báo lỗi
        echo json_encode(array('message' => 'Login failed. Username not found.'));
    }
} else {
    // Nếu không nhận được dữ liệu đầu vào, trả về thông báo lỗi
    echo json_encode(array('message' => 'Incomplete data.'));
}
