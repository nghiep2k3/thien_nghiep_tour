<?php
// Thiết lập các header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once('../config/db.php');
require_once('../models/TourModel.php');

class TourController
{
    private $tourModel;

    public function __construct($db)
    {
        $this->tourModel = new TourModel($db);
    }

    public function getTourDetail($tour_id)
    {
        // Gọi phương thức lấy thông tin tour với các comment
        $tourDetail = $this->tourModel->getTourDetails($tour_id);

        if ($tourDetail) {
            echo json_encode($tourDetail);
        } else {
            echo json_encode(['message' => 'Tour not found.']);
        }
    }
}

// Khởi tạo kết nối DB
$db = new db();
$connect = $db->connect();

// Lấy tour_id từ request
$tour_id = isset($_GET['tour_id']) ? $_GET['tour_id'] : null;

if ($tour_id) {
    // Khởi tạo TourController và gọi phương thức getTourDetail
    $tourController = new TourController($connect);
    $tourController->getTourDetail($tour_id);
} else {
    echo json_encode(['message' => 'No tour_id provided.']);
}
?>
