<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Bao gồm các file cần thiết
include_once '../config/db.php';
include_once '../models/sign_up.php';

// Khởi tạo kết nối cơ sở dữ liệu
$database = new db();
$db = $database->connect();

// Khởi tạo model
$signUp = new SignUpModel($db);

// Nhận dữ liệu từ yêu cầu POST
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra nếu dữ liệu hợp lệ
if (!empty($data->name) && !empty($data->username) && !empty($data->password)) {

    // Gán các giá trị cho model
    $signUp->name = $data->name;
    $signUp->username = $data->username;
    $signUp->password = $data->password;
    $signUp->create_id = date('Y-m-d H:i:s');
    $signUp->role = "user";

    // Kiểm tra nếu username đã tồn tại
    if ($signUp->checkUsername()) {
        echo json_encode(array('message' => 'Username already exists.'));
    } else {
        // Tạo user mới
        if ($signUp->create()) {
            // Sau khi tạo user thành công, tạo profile với user_id
            if ($signUp->createProfile()) {
                echo json_encode(array('message' => 'User and profile created successfully.'));
            } else {
                echo json_encode(array('message' => 'User created, but profile could not be created.'));
            }
        } else {
            echo json_encode(array('message' => 'User could not be created.'));
        }
    }
} else {
    echo json_encode(array('message' => 'Incomplete data.'));
}
?>
