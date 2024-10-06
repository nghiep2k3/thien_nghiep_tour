<?php
// Tệp chính để xử lý API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Bao gồm các file cấu hình và model cần thiết
include_once('../config/db.php');
include_once('../models/TourModel.php');

// Tạo lớp API để quản lý yêu cầu
class TourAPI {
    private $tourModel;

    // Hàm khởi tạo nhận đối tượng kết nối và khởi tạo model Tour
    public function __construct($db) {
        $this->tourModel = new TourModel($db);
    }

    // Hàm để sửa tour
    public function updateTour($id, $title, $description, $price, $time_frame, $rate, $discount) {
        // Kiểm tra tour có tồn tại không
        if (!$this->tourModel->tourExists($id)) {
            echo json_encode(['message' => 'No tour found with the given ID.']);
            return;
        }

        // Cập nhật tour
        if ($this->tourModel->updateTour($id, $title, $description, $price, $time_frame, $rate, $discount)) {
            echo json_encode(['message' => 'Tour updated successfully.']);
        } else {
            echo json_encode(['message' => 'Tour could not be updated.']);
        }
    }
}

// Khởi tạo đối tượng cơ sở dữ liệu và kết nối
$db = new db();
$connect = $db->connect();

// Lấy dữ liệu từ request body
$data = json_decode(file_get_contents("php://input"));

// Lấy các tham số cần thiết
$id = isset($data->id) ? $data->id : null;
$title = isset($data->title) ? $data->title : null;
$description = isset($data->description) ? $data->description : null;
$price = isset($data->price) ? $data->price : null;
$time_frame = isset($data->time_frame) ? $data->time_frame : null;
$rate = isset($data->rate) ? $data->rate : null;
$discount = isset($data->discount) ? $data->discount : null;

// Khởi tạo API và xử lý yêu cầu
$tourAPI = new TourAPI($connect);
$tourAPI->updateTour($id, $title, $description, $price, $time_frame, $rate, $discount);

?>
