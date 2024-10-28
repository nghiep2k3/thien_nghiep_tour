<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

require_once '../config/db.php';
require_once '../models/CommentModel.php';

class CommentController
{
    private $commentModel;

    public function __construct($db)
    {
        $this->commentModel = new CommentModel($db);
    }

    public function updateComment()
    {
        // Nhận dữ liệu từ request
        $data = json_decode(file_get_contents("php://input"));

        // Kiểm tra dữ liệu
        if (isset($data->id) && isset($data->description) && isset($data->username)) {
            $id = $data->id; // ID của comment cần sửa
            $description = $data->description; // Nội dung mới
            $username = $data->username; // Tên người dùng

            // Thực hiện cập nhật comment
            if ($this->commentModel->updateComment($id, $description, $username)) {
                echo json_encode(["message" => "Comment updated successfully."]);
            } else {
                echo json_encode(["message" => "Failed to update comment or username does not match."]);
            }
        } else {
            echo json_encode(["message" => "Invalid input."]);
        }
    }
}

// Khởi tạo kết nối database
$db = new db();
$conn = $db->connect();

// Khởi tạo CommentController và gọi phương thức updateComment
$commentController = new CommentController($conn);
$commentController->updateComment();
?>
