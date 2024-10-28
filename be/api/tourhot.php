<?php
// Các header cho phép truy cập từ bên ngoài và định dạng dữ liệu JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once('../config/db.php');
include_once('../models/TourModel.php');

class Tourhot
{
    private $tourModel;

    // Khởi tạo đối tượng và inject model vào lớp
    public function __construct($db)
    {
        $this->tourModel = new TourModel($db);
    }

    // Hàm lấy danh sách các tour hot và trả về dạng JSON
    public function getHotTours()
    {
        $result = $this->tourModel->getHotTours();
        $num = $result->rowCount();

        if ($num > 0) {
            $tour_arr = array();
            $tour_arr['data'] = array();

            // Duyệt qua từng dòng dữ liệu từ truy vấn
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $tour_item = array(
                    'id' => $id,
                    'title' => $title,
                    'description' => $description,
                    'price' => $price,
                    'time_frame' => $time_frame,
                    'rate' => $rate,
                    'discount' => $discount,
                );

                array_push($tour_arr['data'], $tour_item);
            }

            // Trả về kết quả JSON
            echo json_encode($tour_arr);
        } else {
            // Nếu không tìm thấy tour nào
            echo json_encode(array('message' => 'No hot tours found.'));
        }
    }
}

// Khởi tạo kết nối DB
$db = new db();
$connect = $db->connect();

// Khởi tạo đối tượng Tourhot và gọi phương thức để lấy các tour hot
$tourHot = new Tourhot($connect);
$tourHot->getHotTours();
?>