<?php
// Kết nối tới database
require_once '../config/db.php';
require_once '../models/CommentModel.php';

// Thiết lập các header
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

class CommentController
{
    private $commentModel;

    public function __construct($db)
    {
        $this->commentModel = new CommentModel($db);
    }

    public function addComment()
    {
        // Kiểm tra nếu có tệp được tải lên
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
            // Nhận dữ liệu từ form
            $tour_id = $_POST['tour_id'];
            $description = $_POST['description'];
            $username = $_POST['username'];
            $image = $_FILES['image'];

            // Kiểm tra tệp hình ảnh
            if ($image['error'] === UPLOAD_ERR_OK) {
                $targetDir = '../uploads/'; // Thư mục lưu trữ ảnh
                $targetFile = $targetDir . basename($image['name']);
                // Di chuyển tệp tới thư mục mong muốn
                if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                    // Thêm comment vào cơ sở dữ liệu
                    if ($this->commentModel->addComment($tour_id, $description, $targetFile, $username)) {
                        echo json_encode(["message" => "Comment added successfully."]);
                    } else {
                        echo json_encode(["message" => "Failed to add comment."]);
                    }
                } else {
                    echo json_encode(["message" => "Failed to upload image."]);
                }
            } else {
                echo json_encode(["message" => "Image upload error."]);
            }
        } else {
            echo json_encode(["message" => "Invalid input."]);
        }
    }
}

// Khởi tạo kết nối database
$db = new db();
$conn = $db->connect();

// Khởi tạo CommentController và gọi phương thức addComment
$commentController = new CommentController($conn);
$commentController->addComment();
?>
