<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once('../config/db.php');
include_once('../models/OrderTourModel.php');

class OrderController {
    private $orderModel;

    public function __construct($db) {
        $this->orderModel = new OrderTourModel($db);
    }

    public function getOrders($user_id) {
        $orders = $this->orderModel->getOrdersByUserId($user_id);

        if ($orders) {
            // Chuyển đổi dữ liệu thành định dạng JSON
            echo json_encode($orders);
        } else {
            echo json_encode(['message' => 'No orders found for this user.']);
        }
    }
}

// Khởi tạo kết nối DB
$db = new db();
$connect = $db->connect();

// Lấy user_id từ tham số GET
$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die(json_encode(['message' => 'No user_id provided.']));

// Khởi tạo controller và gọi phương thức getOrders
$orderController = new OrderController($connect);
$orderController->getOrders($user_id);
?>
