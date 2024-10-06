<?php
// Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// Bao gồm các file cấu hình và model cần thiết
include_once('../config/db.php');
include_once('../models/getprofile.php');

// Tạo lớp ProfileAPI để quản lý yêu cầu
class ProfileAPI
{
    private $profileModel;

    // Hàm khởi tạo nhận đối tượng kết nối và khởi tạo model Profile
    public function __construct($db)
    {
        $this->profileModel = new ProfileModel($db);
    }

    // Hàm để cập nhật thông tin profile
    public function updateProfile($user_id, $address, $number, $name, $username, $password)
    {
        // Cập nhật thông tin profile
        $profileUpdated = $this->profileModel->updateProfile($user_id, $address, $number);

        // Cập nhật thông tin đăng ký
        $signupUpdated = $this->profileModel->updateSignup($user_id, $name, $username, $password);

        // Kiểm tra xem cả hai cập nhật có thành công không
        if ($profileUpdated && $signupUpdated) {
            echo json_encode(array('message' => 'Profile updated successfully.'));
        } else {
            echo json_encode(array('message' => 'Profile update failed.'));
        }
    }
}

// Khởi tạo đối tượng cơ sở dữ liệu và kết nối
$db = new db();
$connect = $db->connect();

// Nhận dữ liệu từ yêu cầu POST
$data = json_decode(file_get_contents("php://input"));

// Kiểm tra xem dữ liệu có đầy đủ không
if (!empty($data->user_id) && !empty($data->address) && !empty($data->number) && !empty($data->name) && !empty($data->username) && !empty($data->password)) {
    // Khởi tạo API và cập nhật profile
    $profileAPI = new ProfileAPI($connect);
    $profileAPI->updateProfile($data->user_id, $data->address, $data->number, $data->name, $data->username, $data->password);
} else {
    // Nếu dữ liệu không đầy đủ, trả về thông báo lỗi
    echo json_encode(array('message' => 'Incomplete data.'));
}
?>