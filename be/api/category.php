<?php
// Tệp chính để xử lý API
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once('../config/db.php');
include_once('../models/category.php');

// Tạo lớp API để quản lý yêu cầu
class CategoryAPI {
    private $category;

    // Hàm khởi tạo nhận đối tượng kết nối và khởi tạo model Category
    public function __construct($db) {
        $this->category = new Category($db);
    }

    // Hàm để đọc và trả về danh mục dưới dạng JSON
    public function getCategories() {
        $read = $this->category->getCategory();
        $num = $read->rowCount();

        if ($num > 0) {
            $category_array = [];
            $category_array['data'] = [];

            while ($row = $read->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $category_item = array(
                    'id' => $id,
                    'title' => $title,
                    'metaTitle' => $metaTitle,
                    'type' => $type
                );

                // Thêm category_item vào mảng data
                array_push($category_array['data'], $category_item);
            }

            // Trả về dữ liệu dưới dạng JSON
            echo json_encode($category_array);
        } else {
            // Nếu không có dữ liệu, trả về thông báo lỗi
            echo json_encode(['message' => 'No categories found.']);
        }
    }
}

// Khởi tạo đối tượng cơ sở dữ liệu và kết nối
$db = new db();
$connect = $db->connect();

// Khởi tạo API và xử lý yêu cầu
$categoryAPI = new CategoryAPI($connect);
$categoryAPI->getCategories();

?>
