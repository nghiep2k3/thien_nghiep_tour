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

    // Hàm để xóa tour theo ID
    public function deleteTour($id) {
        // Kiểm tra xem tour có tồn tại không
        if (!$this->tourModel->tourExists($id)) {
            echo json_encode(['message' => 'No tour found with the provided ID.']);
            return;
        }

        // Nếu tồn tại, tiến hành xóa
        if ($this->tourModel->deleteTour($id)) {
            echo json_encode(['message' => 'Tour deleted successfully.']);
        } else {
            echo json_encode(['message' => 'Tour could not be deleted.']);
        }
    }
}

// Khởi tạo đối tượng cơ sở dữ liệu và kết nối
$db = new db();
$connect = $db->connect();

// Lấy id từ query parameters
$id = isset($_GET['id']) ? $_GET['id'] : die(json_encode(['message' => 'No id provided.']));

// Khởi tạo API và xử lý yêu cầu
$tourAPI = new TourAPI($connect);
$tourAPI->deleteTour($id);

?>
