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

    // Hàm để lấy tất cả các tour và trả về dưới dạng JSON
    public function getTours() {
        $stmt = $this->tourModel->getAllTours();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $tours_array = [];
            $tours_array['data'] = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $tour_item = array(
                    'id' => $id,
                    // 'id_comment' => $id_comment,
                    'title' => $title,
                    'description' => $description,
                    'price' => $price,
                    'time_frame' => $time_frame,
                    'rate' => $rate,
                    'discount' => $discount
                );

                // Thêm tour_item vào mảng data
                array_push($tours_array['data'], $tour_item);
            }

            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($tours_array);
        } else {
            // Nếu không có dữ liệu, trả về thông báo lỗi
            echo json_encode(['message' => 'No tours found.']);
        }
    }
}

// Khởi tạo đối tượng cơ sở dữ liệu và kết nối
$db = new db();
$connect = $db->connect();

// Khởi tạo API và xử lý yêu cầu
$tourAPI = new TourAPI($connect);
$tourAPI->getTours();

?>
