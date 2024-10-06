<?php
// Tệp chính để xử lý API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Bao gồm các file cấu hình và model cần thiết
include_once('../config/db.php');
include_once('../models/TourModel.php');

// Tạo lớp API để quản lý yêu cầu
class TourAPI
{
    private $tourModel;

    // Hàm khởi tạo nhận đối tượng kết nối và khởi tạo model Tour
    public function __construct($db)
    {
        $this->tourModel = new TourModel($db);
    }

    // Hàm để tạo tour mới
    public function createTour($title, $description, $price, $time_frame, $rate, $discount)
    {
        // Kiểm tra xem các tham số có hợp lệ không
        if (empty($title) || empty($description) || empty($price)) {
            echo json_encode(['message' => 'Title, description, and price are required.']);
            return;
        }

        // Thêm tour mới vào cơ sở dữ liệu
        if ($this->tourModel->createTour($title, $description, $price, $time_frame, $rate, $discount)) {
            echo json_encode(['message' => 'Tour created successfully.']);
        } else {
            echo json_encode(['message' => 'Tour could not be created.']);
        }
    }
}

// Khởi tạo đối tượng cơ sở dữ liệu và kết nối
$db = new db();
$connect = $db->connect();

// Lấy dữ liệu từ request body
$data = json_decode(file_get_contents("php://input"));

// Lấy các tham số cần thiết
$title = isset($data->title) ? $data->title : null;
$description = isset($data->description) ? $data->description : null;
$price = isset($data->price) ? $data->price : null;
$time_frame = isset($data->time_frame) ? $data->time_frame : null;
$rate = isset($data->rate) ? $data->rate : null;
$discount = isset($data->discount) ? $data->discount : null;

// Khởi tạo API và xử lý yêu cầu
$tourAPI = new TourAPI($connect);
$tourAPI->createTour($title, $description, $price, $time_frame, $rate, $discount);

?>