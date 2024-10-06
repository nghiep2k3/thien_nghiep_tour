<?php
// Tệp chính để xử lý API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Bao gồm các file cấu hình và model cần thiết
include_once('../config/db.php');
include_once('../models/getprofile.php');

// Tạo lớp ProfileAPI để quản lý yêu cầu
class ProfileAPI {
    private $profileModel;

    // Hàm khởi tạo nhận đối tượng kết nối và khởi tạo model Profile
    public function __construct($db) {
        $this->profileModel = new ProfileModel($db);
    }

    // Hàm để lấy thông tin profile theo user_id và trả về dưới dạng JSON
    public function getProfile($user_id) {
        $profileData = $this->profileModel->getProfileByUserId($user_id);

        // Sử dụng fetch để lấy dữ liệu dưới dạng mảng kết hợp
        if ($profileData && $row = $profileData->fetch(PDO::FETCH_ASSOC)) {
            // Tạo mảng profile để trả về
            $profile_array = array(
                'id' => $row['profile_id'],
                'user_id' => $row['user_id'],
                'name' => $row['name'],
                'username' => $row['username'],
                'password' => $row['password'], // Password đã mã hóa
                'address' => $row['address'],
                'role' => $row['role'],
                'create_id' => $row['create_id']
            );

            // Trả về dữ liệu profile dưới dạng JSON
            echo json_encode($profile_array);
        } else {
            // Nếu không tìm thấy profile, trả về thông báo lỗi
            echo json_encode(['message' => 'Profile not found.']);
        }
    }
}

// Khởi tạo đối tượng cơ sở dữ liệu và kết nối
$db = new db();
$connect = $db->connect();

// Lấy user_id từ query parameters
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die(json_encode(['message' => 'No user_id provided.']));

// Khởi tạo API và xử lý yêu cầu
$profileAPI = new ProfileAPI($connect);
$profileAPI->getProfile($user_id);

?>
